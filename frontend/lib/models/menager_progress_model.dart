import 'user_model.dart';

/// Modèle représentant la progression détaillée d'un ménager pour l'écran Administrateur.
class MenagerProgressModel {
  final UserModel user;
  final int totalAssignees;
  final int terminees;
  final int enCours;
  final int aFaire;
  final double pourcentageProgression; // Ex: 75.5 (%)
  final List<Map<String, dynamic>> tachesRecentes;

  MenagerProgressModel({
    required this.user,
    required this.totalAssignees,
    required this.terminees,
    required this.enCours,
    required this.aFaire,
    required this.pourcentageProgression,
    required this.tachesRecentes,
  });

  /// Ratio entre 0.0 et 1.0 destiné directement au LinearProgressIndicator
  double get progressRatio {
    if (totalAssignees <= 0) return 0.0;
    final ratio = terminees / totalAssignees;
    return ratio.clamp(0.0, 1.0);
  }

  factory MenagerProgressModel.fromJson(Map<String, dynamic> json) {
    final userJson = json['user'] as Map<String, dynamic>? ?? {};
    final statsJson = json['statistiques'] as Map<String, dynamic>? ?? {};
    final tachesList = json['taches_recentes'] as List<dynamic>? ?? [];

    return MenagerProgressModel(
      user: UserModel.fromJson(userJson),
      totalAssignees: statsJson['total_assignees'] is int
          ? statsJson['total_assignees']
          : int.tryParse(statsJson['total_assignees']?.toString() ?? '0') ?? 0,
      terminees: statsJson['terminees'] is int
          ? statsJson['terminees']
          : int.tryParse(statsJson['terminees']?.toString() ?? '0') ?? 0,
      enCours: statsJson['en_cours'] is int
          ? statsJson['en_cours']
          : int.tryParse(statsJson['en_cours']?.toString() ?? '0') ?? 0,
      aFaire: statsJson['a_faire'] is int
          ? statsJson['a_faire']
          : int.tryParse(statsJson['a_faire']?.toString() ?? '0') ?? 0,
      pourcentageProgression: statsJson['pourcentage_progression'] is num
          ? (statsJson['pourcentage_progression'] as num).toDouble()
          : double.tryParse(
                  statsJson['pourcentage_progression']?.toString() ?? '0.0') ??
              0.0,
      tachesRecentes: tachesList.map((t) => Map<String, dynamic>.from(t as Map)).toList(),
    );
  }
}
