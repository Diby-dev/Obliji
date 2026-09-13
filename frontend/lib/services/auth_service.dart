import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../models/user_model.dart';
import 'api_service.dart';

/// Gestionnaire d'état de l'authentification et de la session utilisateur.
class AuthService extends ChangeNotifier {
  final ApiService _apiService;

  UserModel? _currentUser;
  String? _token;
  bool _isLoading = false;
  String? _errorMessage;

  AuthService({required ApiService apiService}) : _apiService = apiService;

  UserModel? get currentUser => _currentUser;
  String? get token => _token;
  bool get isAuthenticated => _token != null && _currentUser != null;
  bool get isLoading => _isLoading;
  String? get errorMessage => _errorMessage;

  /// Clés de stockage local
  static const String _keyToken = 'obliji_auth_token';
  static const String _keyUser = 'obliji_auth_user';

  /// Initialisation de la session au lancement de l'application
  Future<void> initSession() async {
    _isLoading = true;
    notifyListeners();

    try {
      final prefs = await SharedPreferences.getInstance();
      final savedToken = prefs.getString(_keyToken);
      final savedUserJson = prefs.getString(_keyUser);

      if (savedToken != null && savedUserJson != null) {
        _token = savedToken;
        _apiService.setToken(savedToken);
        _currentUser = UserModel.fromJson(jsonDecode(savedUserJson) as Map<String, dynamic>);
      }
    } catch (_) {
      // Ignorer l'échec et rester sur l'écran de login
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  /// Connexion utilisateur
  Future<bool> login(String email, String password) async {
    _isLoading = true;
    _errorMessage = null;
    notifyListeners();

    try {
      final data = await _apiService.login(email, password);
      final rawToken = data['token'] as String;
      final rawUser = data['user'] as Map<String, dynamic>;

      _token = rawToken;
      _currentUser = UserModel.fromJson(rawUser);
      _apiService.setToken(rawToken);

      // Persistance locale
      final prefs = await SharedPreferences.getInstance();
      await prefs.setString(_keyToken, rawToken);
      await prefs.setString(_keyUser, jsonEncode(rawUser));

      _isLoading = false;
      notifyListeners();
      return true;
    } on ApiException catch (e) {
      _errorMessage = e.message;
      _isLoading = false;
      notifyListeners();
      return false;
    } catch (e) {
      _errorMessage = 'Erreur inattendue : $e';
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  /// Déconnexion
  Future<void> logout() async {
    _isLoading = true;
    notifyListeners();

    try {
      await _apiService.logout();
      final prefs = await SharedPreferences.getInstance();
      await prefs.remove(_keyToken);
      await prefs.remove(_keyUser);
    } finally {
      _currentUser = null;
      _token = null;
      _apiService.setToken(null);
      _isLoading = false;
      notifyListeners();
    }
  }
}
