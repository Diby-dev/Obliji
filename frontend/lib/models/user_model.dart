class UserModel {
  final int id;
  final String name;
  final String email;
  final String role; // 'admin' ou 'menager'
  final String? telephone;
  final String imageUrl; // Volontairement vide selon les spécifications

  UserModel({
    required this.id,
    required this.name,
    required this.email,
    required this.role,
    this.telephone,
    this.imageUrl = '',
  });

  bool get isAdmin => role == 'admin';
  bool get isMenager => role == 'menager';

  /// Initiales calculées pour l'avatar par défaut (ex: "Alexandre Dumas" -> "AD")
  String get initials {
    if (name.trim().isEmpty) return '?';
    final parts = name.trim().split(RegExp(r'\s+'));
    if (parts.length == 1) {
      return parts[0].substring(0, parts[0].length >= 2 ? 2 : 1).toUpperCase();
    }
    return '${parts[0][0]}${parts[1][0]}'.toUpperCase();
  }

  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'] is int ? json['id'] : int.parse(json['id'].toString()),
      name: json['name'] as String? ?? '',
      email: json['email'] as String? ?? '',
      role: json['role'] as String? ?? 'menager',
      telephone: json['telephone'] as String?,
      imageUrl: json['imageUrl'] as String? ?? '',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'email': email,
      'role': role,
      'telephone': telephone,
      'imageUrl': imageUrl,
    };
  }
}
