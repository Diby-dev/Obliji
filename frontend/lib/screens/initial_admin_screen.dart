import 'package:flutter/material.dart';

import '../core/theme/app_theme.dart';
import '../services/api_service.dart';
import '../services/auth_service.dart';

/// Temporary first screen while the application is being initialized.
class InitialAdminScreen extends StatefulWidget {
  final AuthService authService;

  const InitialAdminScreen({super.key, required this.authService});

  @override
  State<InitialAdminScreen> createState() => _InitialAdminScreenState();
}

class _InitialAdminScreenState extends State<InitialAdminScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nom = TextEditingController();
  final _prenom = TextEditingController();
  final _email = TextEditingController();
  final _password = TextEditingController();
  final _api = ApiService();
  bool _loading = false;
  String? _error;
  bool _created = false;

  @override
  void dispose() {
    _nom.dispose();
    _prenom.dispose();
    _email.dispose();
    _password.dispose();
    super.dispose();
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;
    setState(() { _loading = true; _error = null; });
    try {
      await _api.creerPremierAdmin(nom: _nom.text, prenom: _prenom.text, email: _email.text, password: _password.text);
      if (mounted) setState(() => _created = true);
    } on ApiException catch (e) {
      if (mounted) setState(() => _error = e.message);
    } catch (_) {
      if (mounted) setState(() => _error = 'Une erreur est survenue. Vérifiez votre connexion.');
    } finally {
      if (mounted) setState(() => _loading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(28),
            child: ConstrainedBox(
              constraints: const BoxConstraints(maxWidth: 440),
              child: Form(
                key: _formKey,
                child: Column(crossAxisAlignment: CrossAxisAlignment.stretch, children: [
                  const Icon(Icons.admin_panel_settings_rounded, size: 64, color: AppTheme.primary),
                  const SizedBox(height: 20),
                  const Text('Configurer Obliji', textAlign: TextAlign.center, style: TextStyle(fontSize: 27, fontWeight: FontWeight.w800)),
                  const SizedBox(height: 8),
                  const Text('Créez le premier compte administrateur. Cette étape n’apparaît que pour une base vide.', textAlign: TextAlign.center, style: TextStyle(color: AppTheme.textSecondary)),
                  const SizedBox(height: 28),
                  if (_created)
                    const Padding(
                      padding: EdgeInsets.only(top: 18),
                      child: Column(children: [
                        Icon(Icons.check_circle_rounded, size: 52, color: AppTheme.success),
                        SizedBox(height: 12),
                        Text('Administrateur enregistré avec succès.', textAlign: TextAlign.center, style: TextStyle(fontWeight: FontWeight.w700)),
                        SizedBox(height: 8),
                        Text('Le formulaire de connexion sera réactivé à la prochaine étape.', textAlign: TextAlign.center, style: TextStyle(color: AppTheme.textSecondary)),
                      ]),
                    )
                  else ...[
                    if (_error != null) Padding(padding: const EdgeInsets.only(bottom: 16), child: Text(_error!, textAlign: TextAlign.center, style: const TextStyle(color: AppTheme.error))),
                    _field(_prenom, 'Prénom', Icons.person_outline),
                    const SizedBox(height: 14),
                    _field(_nom, 'Nom', Icons.badge_outlined),
                    const SizedBox(height: 14),
                    _field(_email, 'Adresse e-mail', Icons.mail_outline, email: true),
                    const SizedBox(height: 14),
                    _field(_password, 'Mot de passe (8 caractères minimum)', Icons.lock_outline, password: true),
                    const SizedBox(height: 26),
                    ElevatedButton(
                      onPressed: _loading ? null : _submit,
                      child: _loading ? const SizedBox(width: 20, height: 20, child: CircularProgressIndicator(strokeWidth: 2)) : const Text('Créer l’administrateur'),
                    ),
                  ],
                ]),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _field(TextEditingController controller, String label, IconData icon, {bool email = false, bool password = false}) {
    return TextFormField(
      controller: controller,
      keyboardType: email ? TextInputType.emailAddress : TextInputType.text,
      obscureText: password,
      decoration: InputDecoration(labelText: label, prefixIcon: Icon(icon)),
      validator: (value) {
        final text = value?.trim() ?? '';
        if (text.isEmpty) return 'Ce champ est requis';
        if (email && !text.contains('@')) return 'Adresse e-mail invalide';
        if (password && text.length < 8) return 'Le mot de passe doit contenir 8 caractères';
        return null;
      },
    );
  }
}
