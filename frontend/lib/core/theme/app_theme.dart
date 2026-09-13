import 'package:flutter/material.dart';

/// Thème Dark Mode Épuré haut de gamme pour l'application Obliji.
class AppTheme {
  // Palette de couleurs sombres modernes
  static const Color background = Color(0xFF0F1117);       // Fond principal profond
  static const Color surface = Color(0xFF1A1D26);          // Cartes et surfaces
  static const Color surfaceElevated = Color(0xFF232736);  // Modales et cartes au premier plan
  static const Color border = Color(0xFF2D3348);           // Bordures subtiles et séparateurs

  // Couleurs d'accentuation
  static const Color primary = Color(0xFF38BDF8);          // Cyan éclatant
  static const Color secondary = Color(0xFF818CF8);        // Indigo pastel
  static const Color success = Color(0xFF10B981);          // Émeraude (Terminé / progression haute)
  static const Color warning = Color(0xFFF59E0B);          // Ambre (En cours)
  static const Color error = Color(0xFFEF4444);            // Rouge (Retard / À faire)
  static const Color info = Color(0xFF0EA5E9);

  // Textes & contrastes
  static const Color textPrimary = Color(0xFFF8FAFC);      // Blanc cassé à fort contraste
  static const Color textSecondary = Color(0xFF94A3B8);    // Gris ardoise lisible
  static const Color textMuted = Color(0xFF64748B);        // Texte secondaire atténué

  /// Configuration du ThemeData complet
  static ThemeData get darkTheme {
    return ThemeData(
      brightness: Brightness.dark,
      scaffoldBackgroundColor: background,
      primaryColor: primary,
      colorScheme: const ColorScheme.dark(
        primary: primary,
        secondary: secondary,
        surface: surface,
        error: error,
        onPrimary: Color(0xFF001E2B),
        onSecondary: Colors.white,
        onSurface: textPrimary,
        onError: Colors.white,
      ),
      appBarTheme: const AppBarTheme(
        backgroundColor: background,
        elevation: 0,
        centerTitle: false,
        titleTextStyle: TextStyle(
          color: textPrimary,
          fontSize: 20,
          fontWeight: FontWeight.w700,
          letterSpacing: -0.5,
        ),
        iconTheme: IconThemeData(color: textPrimary),
      ),
      cardTheme: CardThemeData(
        color: surface,
        elevation: 0,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(16),
          side: const BorderSide(color: border, width: 1),
        ),
        margin: const EdgeInsets.symmetric(vertical: 8, horizontal: 0),
      ),
      inputDecorationTheme: InputDecorationTheme(
        filled: true,
        fillColor: surfaceElevated,
        contentPadding: const EdgeInsets.symmetric(horizontal: 18, vertical: 16),
        hintStyle: const TextStyle(color: textMuted, fontSize: 14),
        labelStyle: const TextStyle(color: textSecondary, fontSize: 14),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: border, width: 1),
        ),
        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: border, width: 1),
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: primary, width: 1.5),
        ),
        errorBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: error, width: 1),
        ),
      ),
      elevatedButtonTheme: ElevatedButtonThemeData(
        style: ElevatedButton.styleFrom(
          backgroundColor: primary,
          foregroundColor: const Color(0xFF001E2B),
          elevation: 0,
          padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          textStyle: const TextStyle(
            fontSize: 15,
            fontWeight: FontWeight.w600,
            letterSpacing: -0.2,
          ),
        ),
      ),
      dividerTheme: const DividerThemeData(
        color: border,
        thickness: 1,
        space: 24,
      ),
    );
  }
}
