import 'package:flutter/material.dart';
import '../core/theme/app_theme.dart';
import 'tache_model.dart';
import 'user_model.dart';

class AssignationModel {
  final int id;
  final int userId;
  final int tacheId;
  String statut; // 'a_faire', 'en_cours', 'termine'
  final DateTime? dateEcheance;
  final DateTime? dateCompletion;
  final String? commentaires;
  final UserModel? user;
  final TacheModel? tache;

  AssignationModel({
    required this.id,
    required this.userId,
    required this.tacheId,
    required this.statut,
    this.dateEcheance,
    this.dateCompletion,
    this.commentaires,
    this.user,
    this.tache,
  });

  bool get isTermine => statut == 'termine';
  bool get isEnCours => statut == 'en_cours';
  bool get isAFaire => statut == 'a_faire';

  String get statutLabel {
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

  Color get statutColor {
    switch (statut) {
      case 'termine':
        return AppTheme.success;
      case 'en_cours':
        return AppTheme.warning;
      case 'a_faire':
      default:
        return AppTheme.error;
    }
  }

  factory AssignationModel.fromJson(Map<String, dynamic> json) {
    return AssignationModel(
      id: json['id'] is int ? json['id'] : int.parse(json['id'].toString()),
      userId: json['user_id'] is int
          ? json['user_id']
          : int.parse(json['user_id'].toString()),
      tacheId: json['tache_id'] is int
          ? json['tache_id']
          : int.parse(json['tache_id'].toString()),
      statut: json['statut'] as String? ?? 'a_faire',
      dateEcheance: json['date_echeance'] != null
          ? DateTime.tryParse(json['date_echeance'].toString())
          : null,
      dateCompletion: json['date_completion'] != null
          ? DateTime.tryParse(json['date_completion'].toString())
          : null,
      commentaires: json['commentaires'] as String?,
      user: json['user'] != null && json['user'] is Map<String, dynamic>
          ? UserModel.fromJson(json['user'] as Map<String, dynamic>)
          : null,
      tache: json['tache'] != null && json['tache'] is Map<String, dynamic>
          ? TacheModel.fromJson(json['tache'] as Map<String, dynamic>)
          : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'user_id': userId,
      'tache_id': tacheId,
      'statut': statut,
      'date_echeance': dateEcheance?.toIso8601String(),
      'date_completion': dateCompletion?.toIso8601String(),
      'commentaires': commentaires,
    };
  }
}
