import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import '../core/constants/api_constants.dart';
import '../models/assignation_model.dart';
import '../models/menager_progress_model.dart';
import '../models/tache_model.dart';

/// Exception personnalisée pour les erreurs API
class ApiException implements Exception {
  final String message;
  final int? statusCode;

  ApiException(this.message, {this.statusCode});

  @override
  String toString() => message;
}

/// Service de communication HTTP pour consommer l'API Laravel Obliji.
class ApiService {
  String? _token;

  void setToken(String? token) {
    _token = token;
  }

  Map<String, String> _buildHeaders() {
    final headers = <String, String>{
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    };
    if (_token != null && _token!.isNotEmpty) {
      headers['Authorization'] = 'Bearer $_token';
    }
    return headers;
  }

  /// Indique si l'instance vide doit encore recevoir son premier administrateur.
  Future<bool> initialisationRequise() async {
    final response = await http
        .get(Uri.parse('${ApiConstants.baseUrl}${ApiConstants.initialisationEndpoint}'), headers: _buildHeaders())
        .timeout(ApiConstants.timeoutDuration);
    final data = jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode == 200 && data['success'] == true) {
      return (data['data'] as Map<String, dynamic>)['requise'] == true;
    }
    throw ApiException(data['message']?.toString() ?? 'Impossible de vérifier l\'initialisation.', statusCode: response.statusCode);
  }

  /// Crée le premier administrateur. Le backend refuse cette action après initialisation.
  Future<void> creerPremierAdmin({
    required String nom,
    required String prenom,
    required String email,
    required String password,
  }) async {
    final response = await http
        .post(
          Uri.parse('${ApiConstants.baseUrl}${ApiConstants.initialAdminEndpoint}'),
          headers: _buildHeaders(),
          body: jsonEncode({'nom': nom.trim(), 'prenom': prenom.trim(), 'email': email.trim(), 'password': password, 'password_confirmation': password}),
        )
        .timeout(ApiConstants.timeoutDuration);
    final data = jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode != 201 || data['success'] != true) {
      throw ApiException(data['message']?.toString() ?? 'Création de l\'administrateur impossible.', statusCode: response.statusCode);
    }
  }

  /// Authentification de l'utilisateur
  Future<Map<String, dynamic>> login(String email, String password) async {
    final url = Uri.parse('${ApiConstants.baseUrl}${ApiConstants.loginEndpoint}');

    try {
      final response = await http
          .post(
            url,
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: jsonEncode({
              'email': email.trim(),
              'password': password,
            }),
          )
          .timeout(ApiConstants.timeoutDuration);

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success'] == true) {
        return data['data'] as Map<String, dynamic>;
      } else {
        throw ApiException(
          data['message']?.toString() ?? 'Erreur d\'authentification',
          statusCode: response.statusCode,
        );
      }
    } on SocketException {
      throw ApiException('Impossible de joindre le serveur. Vérifiez votre connexion Internet.');
    } on TimeoutException {
      throw ApiException('Le serveur met trop de temps à répondre. Veuillez réessayer.');
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Une erreur inattendue est survenue : $e');
    }
  }

  /// Vérifie que le jeton restauré localement est toujours valide et renvoie le profil courant.
  Future<Map<String, dynamic>> getMe() async {
    final url = Uri.parse('${ApiConstants.baseUrl}${ApiConstants.meEndpoint}');

    try {
      final response = await http
          .get(url, headers: _buildHeaders())
          .timeout(ApiConstants.timeoutDuration);
      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success'] == true) {
        return data['data'] as Map<String, dynamic>;
      }

      throw ApiException(
        data['message']?.toString() ?? 'Session invalide ou expirée.',
        statusCode: response.statusCode,
      );
    } on SocketException {
      throw ApiException('Impossible de joindre le serveur. Vérifiez votre connexion Internet.');
    } on TimeoutException {
      throw ApiException('Le serveur met trop de temps à répondre. Veuillez réessayer.');
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Une erreur inattendue est survenue : $e');
    }
  }

  /// Récupération des données du Dashboard Administrateur (métriques + progression par ménager)
  Future<Map<String, dynamic>> getAdminDashboard() async {
    final url = Uri.parse('${ApiConstants.baseUrl}${ApiConstants.adminDashboardEndpoint}');

    try {
      final response = await http
          .get(url, headers: _buildHeaders())
          .timeout(ApiConstants.timeoutDuration);

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success'] == true) {
        final payload = data['data'] as Map<String, dynamic>;
        final rawMenagers = payload['menagers'] as List<dynamic>? ?? [];

        final menagers = rawMenagers
            .map((item) => MenagerProgressModel.fromJson(item as Map<String, dynamic>))
            .toList();

        return {
          'vue_d_ensemble': payload['vue_d_ensemble'] as Map<String, dynamic>? ?? {},
          'menagers': menagers,
        };
      } else {
        throw ApiException(
          data['message']?.toString() ?? 'Impossible de charger le dashboard admin.',
          statusCode: response.statusCode,
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erreur lors du chargement des statistiques admin : $e');
    }
  }

  /// Récupération des données du Dashboard Ménager (ses propres tâches)
  Future<Map<String, dynamic>> getMenagerDashboard() async {
    final url = Uri.parse('${ApiConstants.baseUrl}${ApiConstants.menagerDashboardEndpoint}');

    try {
      final response = await http
          .get(url, headers: _buildHeaders())
          .timeout(ApiConstants.timeoutDuration);

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success'] == true) {
        final payload = data['data'] as Map<String, dynamic>;
        final rawAssignations = payload['assignations'] as List<dynamic>? ?? [];

        final assignations = rawAssignations
            .map((item) => AssignationModel.fromJson(item as Map<String, dynamic>))
            .toList();

        return {
          'statistiques': payload['statistiques'] as Map<String, dynamic>? ?? {},
          'assignations': assignations,
        };
      } else {
        throw ApiException(
          data['message']?.toString() ?? 'Impossible de charger le dashboard ménager.',
          statusCode: response.statusCode,
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erreur lors du chargement des tâches ménagères : $e');
    }
  }

  /// Mise à jour du statut d'une assignation ('a_faire', 'en_cours', 'termine')
  Future<AssignationModel> updateStatut(int assignationId, String statut) async {
    final url = Uri.parse(
      '${ApiConstants.baseUrl}${ApiConstants.updateStatutEndpoint(assignationId)}',
    );

    try {
      final response = await http
          .patch(
            url,
            headers: _buildHeaders(),
            body: jsonEncode({'statut': statut}),
          )
          .timeout(ApiConstants.timeoutDuration);

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success'] == true) {
        return AssignationModel.fromJson(data['data'] as Map<String, dynamic>);
      } else {
        throw ApiException(
          data['message']?.toString() ?? 'Impossible de modifier le statut.',
          statusCode: response.statusCode,
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erreur lors du changement de statut : $e');
    }
  }

  /// Liste des tâches modèles disponibles
  Future<List<TacheModel>> getTaches() async {
    final url = Uri.parse('${ApiConstants.baseUrl}${ApiConstants.tachesEndpoint}');

    try {
      final response = await http
          .get(url, headers: _buildHeaders())
          .timeout(ApiConstants.timeoutDuration);

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success'] == true) {
        final list = data['data'] as List<dynamic>? ?? [];
        return list.map((item) => TacheModel.fromJson(item as Map<String, dynamic>)).toList();
      } else {
        throw ApiException(
          data['message']?.toString() ?? 'Impossible de récupérer les tâches.',
          statusCode: response.statusCode,
        );
      }
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException('Erreur lors de la récupération des tâches : $e');
    }
  }

  /// Déconnexion
  Future<void> logout() async {
    final url = Uri.parse('${ApiConstants.baseUrl}${ApiConstants.logoutEndpoint}');

    try {
      await http.post(url, headers: _buildHeaders()).timeout(ApiConstants.timeoutDuration);
    } catch (_) {
      // Nettoyage local prioritaire même en cas d'échec réseau
    } finally {
      _token = null;
    }
  }
}
