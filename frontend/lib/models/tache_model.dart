class TacheModel {
  final int id;
  final String titre;
  final String? description;
  final String piece;
  final String? frequence;
  final int? dureeEstimee; // en minutes
  final String? difficulte; // facile, moyen, difficile
  final String imageUrl; // Volontairement vide selon les spécifications

  TacheModel({
    required this.id,
    required this.titre,
    this.description,
    required this.piece,
    this.frequence,
    this.dureeEstimee,
    this.difficulte,
    this.imageUrl = '',
  });

  factory TacheModel.fromJson(Map<String, dynamic> json) {
    return TacheModel(
      id: json['id'] is int ? json['id'] : int.parse(json['id'].toString()),
      titre: json['titre'] as String? ?? 'Sans titre',
      description: json['description'] as String?,
      piece: json['piece'] as String? ?? 'Général',
      frequence: json['frequence'] as String?,
      dureeEstimee: json['duree_estimee'] is int
          ? json['duree_estimee']
          : (json['duree_estimee'] != null
              ? int.tryParse(json['duree_estimee'].toString())
              : null),
      difficulte: json['difficulte'] as String?,
      imageUrl: json['imageUrl'] as String? ?? '',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'titre': titre,
      'description': description,
      'piece': piece,
      'frequence': frequence,
      'duree_estimee': dureeEstimee,
      'difficulte': difficulte,
      'imageUrl': imageUrl,
    };
  }
}
