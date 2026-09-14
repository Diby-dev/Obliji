<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REVEAL SCHOOL</title>      
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- Ajout de Bootstrap Icons pour les icônes --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet"> 
    
    <style>
        body {
            /* Assurez-vous que l'URL de l'image est correcte sur votre serveur */
            background-image: url("{{ asset('images/fond_ecole.jpg') }}");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-color: #ffffffff; 
        }
        .welcome-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding-bottom: 70px; 
            font-weight: 700;
            text-shadow: 2px 14px 8px rgba(0, 0, 0, 0.29);
            font-family: 'Poppins', sans-serif;
        }
        .ansut-logo {
            width: 230px; 
            margin-bottom: -40px;
            margin-top: -105px;
            
        }
        .action-button {
            padding: 15px 30px;
            font-size: 1.2rem;
            margin: 10px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .action-button:hover {
            transform: scale(1.05); 
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
        }

        .welcome-container h1 {
            position: relative;
            font-weight: normal; 
            font-size: 1.7rem;
            top: 70px;
        }

        .btn-renseigner {
            position: relative;
            top: 55px;
            background-color: #ffc107; 
            border-color: #ffc107;
            color: #000000ff;
            font-weight: bold;
        }
        
        /* NOUVEAU STYLE POUR LE BOUTON DE CLASSE */
        .btn-classe {
            position: relative;
            top: 55px;
            background-color: #20c997; 
            border-color: #20c997;
            color: white;
            font-weight: bold;
        }
        .btn-classe:hover {
            background-color: #17a2b8 !important; 
            border-color: #17a2b8 !important;
            color: white !important;
        }
        
        .btn-liste {
            background-color: #007bff; 
            border-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .footer-bar {
            background-image: linear-gradient(to right, #030331ff, #1b0336ff);
            color: white;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 14%;
            font-size: 26px;
        }

        .btn-renseigner:hover {
            background-color: #ffc107 !important; 
            border-color: #ffc107 !important;
            color: #212529 !important;
        }

        .btn-liste:hover {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        
        <img src="{{ asset('images/revschool.png') }}" class="ansut-logo" alt="Logo REVEAL SCHOOL">

        <h1 class="mb-4">
            Bienvenue sur la plateforme d'enregistrement de REVEAL SCHOOL.
        </h1>

        <div class="mt-4">
            {{-- BOUTON 1 : ENREGISTRER UN ÉLÈVE (PUBLIC) --}}
            <a href="{{ route('eleve.create') }}" class="btn btn-renseigner action-button">
                <i class="bi bi-person-plus-fill"></i> ENREGISTRER UN ELEVE
            </a>
            
            {{-- BOUTON 2 : GÉRER LES CLASSES (ADMIN - Protégé par la route) --}}
            <a href="{{ route('classe.index') }}" class="btn btn-classe action-button">
                <i class="bi bi-gear-fill"></i> GÉRER LES CLASSES
            </a>

            {{-- BOUTON 3 : VOIR LISTE D'ÉLÈVES (PROTÉGÉ) --}}
            {{-- Si vous voulez réactiver cette route plus tard, elle doit mener à la liste index des élèves --}}
            {{-- <a href="{{ route('eleve.index') }}" class="btn btn-liste action-button">
                VOIR LISTE D'ÉLÈVES
            </a> --}}
        </div>
    </div>
    
    <div class="footer-bar">
        <div class="container text-center">
            © {{ date('Y') }} <a href="https://ya-consulting.com/" style="color: #242b94ff; text-decoration: none; font-weight: bold;">YA CONSULTING</a>. Tous droits réservés.
        </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>