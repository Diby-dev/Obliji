@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-danger text-white py-3 rounded-top-4">
                    <h4 class="mb-0 text-center font-weight-bold"><i class="fas fa-lock me-2"></i> Accès Restreint</h4>
                </div>
                
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-info text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <p class="text-center text-muted mb-4">Veuillez entrer le code administrateur pour accéder à la liste des élèves.</p>

                    <form method="POST" action="{{ route('eleve.code.verify') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="secret_code" class="form-label">Code Secret</label>
                            <input type="password" 
                                   class="form-control form-control-lg @error('secret_code') is-invalid @enderror" 
                                   id="secret_code" 
                                   name="secret_code" 
                                   required 
                                   autofocus>
                            @error('secret_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-danger btn-lg">
                                Déverrouiller l'Accès
                            </button>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Retour à l'Accueil</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection