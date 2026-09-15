/// Constantes réseau et endpoints pour l'API Laravel Obliji.
class ApiConstants {
  // Ajuster l'URL selon l'environnement de test ou production :
  // - Render : 'https://votre-app-render.onrender.com/api'
  // - Émulateur Android local : 'http://10.0.2.2:8000/api'
  // - Simulateur iOS / Navigateur Web : 'http://localhost:8000/api'
  static const String baseUrl = 'https://obliji.onrender.com/api';

  // Auth
  static const String loginEndpoint = '/login';
  static const String logoutEndpoint = '/logout';
  static const String meEndpoint = '/me';

  // Tâches
  static const String tachesEndpoint = '/taches';

  // Assignations
  static const String assignationsEndpoint = '/assignations';
  static String updateStatutEndpoint(int id) => '/assignations/$id/statut';

  // Dashboards
  static const String adminDashboardEndpoint = '/dashboard/admin';
  static const String menagerDashboardEndpoint = '/dashboard/menager';

  // Durée maximale d'attente d'une requête HTTP
  static const Duration timeoutDuration = Duration(seconds: 15);
}
