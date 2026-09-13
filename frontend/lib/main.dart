import 'package:flutter/material.dart';
import 'core/theme/app_theme.dart';
import 'screens/admin/admin_dashboard_screen.dart';
import 'screens/login_screen.dart';
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

class OblijiApp extends StatelessWidget {
  final AuthService authService;

  const OblijiApp({super.key, required this.authService});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Obliji Tasks',
      debugShowCheckedModeBanner: false,
      theme: AppTheme.darkTheme,
      home: ListenableBuilder(
        listenable: authService,
        builder: (context, _) {
          if (!authService.isAuthenticated) {
            return LoginScreen(authService: authService);
          }

          final user = authService.currentUser;
          if (user != null && user.isAdmin) {
            return AdminDashboardScreen(authService: authService);
          } else {
            return MenagerDashboardScreen(authService: authService);
          }
        },
      ),
    );
  }
}
