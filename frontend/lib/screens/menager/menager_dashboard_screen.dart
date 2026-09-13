import 'package:flutter/material.dart';
import '../../core/theme/app_theme.dart';
import '../../models/assignation_model.dart';
import '../../services/api_service.dart';
import '../../services/auth_service.dart';
import '../login_screen.dart';

/// Interface Ménager : espace pour consulter ses tâches assignées et basculer leur statut.
class MenagerDashboardScreen extends StatefulWidget {
  final AuthService authService;

  const MenagerDashboardScreen({super.key, required this.authService});

  @override
  State<MenagerDashboardScreen> createState() => _MenagerDashboardScreenState();
}

class _MenagerDashboardScreenState extends State<MenagerDashboardScreen> {
  final ApiService _apiService = ApiService();
  bool _isLoading = true;
  String? _errorMessage;
  List<AssignationModel> _assignations = [];
  Map<String, dynamic> _statistiques = {};
  String _filtreActif = 'toutes'; // 'toutes', 'a_faire', 'en_cours', 'termine'

  @override
  void initState() {
    super.initState();
    _apiService.setToken(widget.authService.token);
    _loadTasks();
  }

  Future<void> _loadTasks() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    try {
      final res = await _apiService.getMenagerDashboard();
      setState(() {
        _statistiques = res['statistiques'] as Map<String, dynamic>;
        _assignations = res['assignations'] as List<AssignationModel>;
        _isLoading = false;
      });
    } catch (e) {
      setState(() {
        _errorMessage = e.toString();
        _isLoading = false;
      });
    }
  }

  Future<void> _handleUpdateStatut(AssignationModel assignation, String nouveauStatut) async {
    if (assignation.statut == nouveauStatut) return;

    final ancienStatut = assignation.statut;

    // Mise à jour optimiste de l'interface
    setState(() {
      assignation.statut = nouveauStatut;
    });

    try {
      await _apiService.updateStatut(assignation.id, nouveauStatut);

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Tâche passée en "${_formatStatut(nouveauStatut)}"'),
          backgroundColor: AppTheme.surfaceElevated,
          duration: const Duration(seconds: 2),
        ),
      );
      // Rechargement des stats
      _loadTasks();
    } catch (e) {
      // Rollback en cas d'échec
      setState(() {
        assignation.statut = ancienStatut;
      });
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Échec de la mise à jour : $e'),
          backgroundColor: AppTheme.error,
        ),
      );
    }
  }

  Future<void> _handleLogout() async {
    await widget.authService.logout();
    if (mounted) {
      Navigator.of(context).pushReplacement(
        MaterialPageRoute(
          builder: (_) => LoginScreen(authService: widget.authService),
        ),
      );
    }
  }

  String _formatStatut(String statut) {
    switch (statut) {
      case 'termine':
        return 'Terminé';
      case 'en_cours':
        return 'En cours';
      case 'a_faire':
      default:
        return 'À faire';
    }
  }

  List<AssignationModel> get _assignationsFiltrees {
    if (_filtreActif == 'toutes') return _assignations;
    return _assignations.where((a) => a.statut == _filtreActif).toList();
  }

  @override
  Widget build(BuildContext context) {
    final user = widget.authService.currentUser;

    return Scaffold(
      appBar: AppBar(
        title: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Mes Tâches Ménagères',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.w700),
            ),
            Text(
              'Bonjour ${user?.name ?? "Ménager"}',
              style: const TextStyle(fontSize: 12, color: AppTheme.textSecondary),
            ),
          ],
        ),
        actions: [
          IconButton(
            tooltip: 'Actualiser',
            icon: const Icon(Icons.refresh_rounded),
            onPressed: _loadTasks,
          ),
          IconButton(
            tooltip: 'Déconnexion',
            icon: const Icon(Icons.logout_rounded, color: AppTheme.textSecondary),
            onPressed: _handleLogout,
          ),
        ],
      ),
      body: RefreshIndicator(
        onRefresh: _loadTasks,
        color: AppTheme.primary,
        backgroundColor: AppTheme.surfaceElevated,
        child: _isLoading
            ? const Center(
                child: CircularProgressIndicator(
                  valueColor: AlwaysStoppedAnimation<Color>(AppTheme.primary),
                ),
              )
            : _errorMessage != null
                ? _buildErrorView()
                : _buildContent(),
      ),
    );
  }

  Widget _buildErrorView() {
    return ListView(
      padding: const EdgeInsets.all(24),
      children: [
        const SizedBox(height: 60),
        Center(
          child: Container(
            padding: const EdgeInsets.all(24),
            decoration: BoxDecoration(
              color: AppTheme.surface,
              borderRadius: BorderRadius.circular(16),
              border: Border.all(color: AppTheme.border),
            ),
            child: Column(
              children: [
                const Icon(Icons.cloud_off_rounded, color: AppTheme.error, size: 48),
                const SizedBox(height: 16),
                const Text(
                  'Erreur de synchronisation',
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 8),
                Text(
                  _errorMessage ?? 'Erreur inconnue',
                  textAlign: TextAlign.center,
                  style: const TextStyle(color: AppTheme.textSecondary, fontSize: 13),
                ),
                const SizedBox(height: 20),
                ElevatedButton.icon(
                  onPressed: _loadTasks,
                  icon: const Icon(Icons.replay_rounded, size: 18),
                  label: const Text('Réessayer'),
                ),
              ],
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildContent() {
    final terminees = _statistiques['terminees'] ?? 0;
    final total = _statistiques['total_assignees'] ?? _assignations.length;
    final pct = _statistiques['pourcentage_progression'] ?? (total > 0 ? (terminees / total * 100).round() : 0);

    return ListView(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 20),
      children: [
        // Carte résumé de progression personnelle
        Container(
          padding: const EdgeInsets.all(20),
          decoration: BoxDecoration(
            color: AppTheme.surface,
            borderRadius: BorderRadius.circular(20),
            border: Border.all(color: AppTheme.border),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  const Text(
                    'Progression aujourd\'hui',
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.w600,
                      color: AppTheme.textSecondary,
                    ),
                  ),
                  Container(
                    padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                    decoration: BoxDecoration(
                      color: AppTheme.success.withValues(alpha: 0.15),
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Text(
                      '$pct%',
                      style: const TextStyle(
                        fontSize: 14,
                        fontWeight: FontWeight.w800,
                        color: AppTheme.success,
                      ),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 12),
              ClipRRect(
                borderRadius: BorderRadius.circular(8),
                child: LinearProgressIndicator(
                  value: total > 0 ? (terminees / total).clamp(0.0, 1.0) : 0.0,
                  minHeight: 8,
                  backgroundColor: AppTheme.surfaceElevated,
                  valueColor: const AlwaysStoppedAnimation<Color>(AppTheme.success),
                ),
              ),
              const SizedBox(height: 14),
              Text(
                '$terminees tâche(s) validée(s) sur $total au total',
                style: const TextStyle(fontSize: 13, color: AppTheme.textSecondary),
              ),
            ],
          ),
        ),
        const SizedBox(height: 20),

        // Filtres par statut
        SingleChildScrollView(
          scrollDirection: Axis.horizontal,
          child: Row(
            children: [
              _buildFilterChip('Toutes', 'toutes'),
              _buildFilterChip('À faire', 'a_faire'),
              _buildFilterChip('En cours', 'en_cours'),
              _buildFilterChip('Terminées', 'termine'),
            ],
          ),
        ),
        const SizedBox(height: 16),

        // Liste des tâches
        if (_assignationsFiltrees.isEmpty)
          Container(
            padding: const EdgeInsets.all(36),
            decoration: BoxDecoration(
              color: AppTheme.surface,
              borderRadius: BorderRadius.circular(16),
              border: Border.all(color: AppTheme.border),
            ),
            child: const Center(
              child: Text(
                'Aucune tâche dans cette catégorie.',
                style: TextStyle(color: AppTheme.textSecondary),
              ),
            ),
          )
        else
          ..._assignationsFiltrees.map((assignation) => _buildTaskCard(assignation)),
      ],
    );
  }

  Widget _buildFilterChip(String label, String value) {
    final isSelected = _filtreActif == value;
    return Padding(
      padding: const EdgeInsets.only(right: 8),
      child: ChoiceChip(
        label: Text(label),
        selected: isSelected,
        onSelected: (_) => setState(() => _filtreActif = value),
        selectedColor: AppTheme.primary,
        backgroundColor: AppTheme.surface,
        labelStyle: TextStyle(
          color: isSelected ? const Color(0xFF001E2B) : AppTheme.textSecondary,
          fontWeight: isSelected ? FontWeight.w700 : FontWeight.w500,
          fontSize: 13,
        ),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(10),
          side: BorderSide(
            color: isSelected ? AppTheme.primary : AppTheme.border,
          ),
        ),
      ),
    );
  }

  /// Carte d'une tâche assignée avec sélecteur de statut interactif
  Widget _buildTaskCard(AssignationModel assignation) {
    final tache = assignation.tache;
    final dateStr = assignation.dateEcheance != null
        ? '${assignation.dateEcheance!.day.toString().padLeft(2, "0")}/${assignation.dateEcheance!.month.toString().padLeft(2, "0")}/${assignation.dateEcheance!.year}'
        : 'Aujourd\'hui';

    return Card(
      margin: const EdgeInsets.only(bottom: 14),
      child: Padding(
        padding: const EdgeInsets.all(18),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Titre de la tâche et badge de statut actuel
            Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Icône par défaut selon la pièce (gestion d'image vide)
                Container(
                  padding: const EdgeInsets.all(10),
                  decoration: BoxDecoration(
                    color: AppTheme.surfaceElevated,
                    borderRadius: BorderRadius.circular(10),
                    border: Border.all(color: AppTheme.border),
                  ),
                  child: const Icon(
                    Icons.task_alt_rounded,
                    color: AppTheme.primary,
                    size: 22,
                  ),
                ),
                const SizedBox(width: 14),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        tache?.titre ?? 'Tâche assignée',
                        style: const TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.w700,
                          color: AppTheme.textPrimary,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Row(
                        children: [
                          Icon(Icons.room_outlined, size: 14, color: AppTheme.textMuted),
                          const SizedBox(width: 4),
                          Text(
                            tache?.piece ?? 'Général',
                            style: const TextStyle(
                              fontSize: 12,
                              color: AppTheme.textSecondary,
                            ),
                          ),
                          const SizedBox(width: 12),
                          Icon(Icons.calendar_today_outlined, size: 14, color: AppTheme.textMuted),
                          const SizedBox(width: 4),
                          Text(
                            dateStr,
                            style: const TextStyle(
                              fontSize: 12,
                              color: AppTheme.textSecondary,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
                // Badge de statut
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                  decoration: BoxDecoration(
                    color: assignation.statutColor.withValues(alpha: 0.15),
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(color: assignation.statutColor.withValues(alpha: 0.4)),
                  ),
                  child: Text(
                    assignation.statutLabel,
                    style: TextStyle(
                      fontSize: 11,
                      fontWeight: FontWeight.w700,
                      color: assignation.statutColor,
                    ),
                  ),
                ),
              ],
            ),

            if (tache?.description != null && tache!.description!.isNotEmpty) ...[
              const SizedBox(height: 12),
              Text(
                tache.description!,
                style: const TextStyle(fontSize: 13, color: AppTheme.textSecondary),
              ),
            ],

            const SizedBox(height: 16),
            const Divider(height: 1),
            const SizedBox(height: 12),

            // Sélecteur d'action rapide pour changer le statut ('a_faire', 'en_cours', 'termine')
            Row(
              children: [
                const Text(
                  'Modifier le statut :',
                  style: TextStyle(
                    fontSize: 12,
                    fontWeight: FontWeight.w600,
                    color: AppTheme.textSecondary,
                  ),
                ),
                const Spacer(),
                _buildStatutActionButton(
                  assignation: assignation,
                  targetStatut: 'a_faire',
                  label: 'À faire',
                  color: AppTheme.error,
                ),
                const SizedBox(width: 6),
                _buildStatutActionButton(
                  assignation: assignation,
                  targetStatut: 'en_cours',
                  label: 'En cours',
                  color: AppTheme.warning,
                ),
                const SizedBox(width: 6),
                _buildStatutActionButton(
                  assignation: assignation,
                  targetStatut: 'termine',
                  label: 'Terminé',
                  color: AppTheme.success,
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildStatutActionButton({
    required AssignationModel assignation,
    required String targetStatut,
    required String label,
    required Color color,
  }) {
    final isActive = assignation.statut == targetStatut;

    return InkWell(
      onTap: () => _handleUpdateStatut(assignation, targetStatut),
      borderRadius: BorderRadius.circular(8),
      child: AnimatedContainer(
        duration: const Duration(milliseconds: 200),
        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
        decoration: BoxDecoration(
          color: isActive ? color.withValues(alpha: 0.2) : AppTheme.surfaceElevated,
          borderRadius: BorderRadius.circular(8),
          border: Border.all(
            color: isActive ? color : AppTheme.border,
            width: isActive ? 1.5 : 1.0,
          ),
        ),
        child: Text(
          label,
          style: TextStyle(
            fontSize: 11,
            fontWeight: isActive ? FontWeight.w700 : FontWeight.w500,
            color: isActive ? color : AppTheme.textSecondary,
          ),
        ),
      ),
    );
  }
}
