import 'package:flutter/material.dart';
import '../core/theme/app_theme.dart';
import 'tache_model.dart';
import 'user_model.dart';

class AssignationModel {
  final int id;
  /// Identifiant du ménager, colonne `menager_id` dans PostgreSQL.
  final int menagerId;
  final int tacheId;
  String statut; // 'a_faire', 'en_cours', 'termine'
  final DateTime? dateEcheance;
  final DateTime? dateCompletion;
  final String? commentaires;
  final UserModel? user;
  final TacheModel? tache;

  AssignationModel({
    required this.id,
    required this.menagerId,
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
      menagerId: json['menager_id'] is int
          ? json['menager_id']
          : int.parse(json['menager_id'].toString()),
      tacheId: json['tache_id'] is int
          ? json['tache_id']
          : int.parse(json['tache_id'].toString()),
      statut: json['statut'] as String? ?? 'a_faire',
      dateEcheance: json['date_echeance'] != null
          ? DateTime.tryParse(json['date_echeance'].toString())
          : null,
      commentaires: json['commentaire_realisation'] as String?,
      user: json['menager'] != null && json['menager'] is Map<String, dynamic>
          ? UserModel.fromJson(json['menager'] as Map<String, dynamic>)
          : null,
      tache: json['tache'] != null && json['tache'] is Map<String, dynamic>
          ? TacheModel.fromJson(json['tache'] as Map<String, dynamic>)
          : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'menager_id': menagerId,
      'tache_id': tacheId,
      'statut': statut,
      'date_echeance': dateEcheance?.toIso8601String(),
      'commentaire_realisation': commentaires,
    };
  }
}
