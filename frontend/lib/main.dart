import 'package:flutter/material.dart';
import 'core/theme/app_theme.dart';
import 'screens/admin/admin_dashboard_screen.dart';
import 'screens/initial_admin_screen.dart';
import 'screens/menager/menager_dashboard_screen.dart';
import 'services/api_service.dart';
import 'services/auth_service.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  final apiService = ApiService();
  final authService = AuthService(apiService: apiService);

  // Restauration de la session sauvegardée si disponible
  await authService.initSession();

  runApp(OblijiApp(authService: authService));
}

class OblijiApp extends StatefulWidget {
  final AuthService authService;

  const OblijiApp({super.key, required this.authService});

  @override
  State<OblijiApp> createState() => _OblijiAppState();
}

class _OblijiAppState extends State<OblijiApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Obliji Tasks',
      debugShowCheckedModeBanner: false,
      theme: AppTheme.darkTheme,
      home: ListenableBuilder(
        listenable: widget.authService,
        builder: (context, _) {
          if (!widget.authService.isAuthenticated) {
            // Phase temporaire : seul l'enregistrement du premier admin est affiché.
            return InitialAdminScreen(authService: widget.authService);
          }

          final user = widget.authService.currentUser;
          if (user != null && user.isAdmin) {
            return AdminDashboardScreen(authService: widget.authService);
          } else {
            return MenagerDashboardScreen(authService: widget.authService);
          }
        },
      ),
    );
  }
}
