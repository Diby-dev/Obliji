@extends('layouts.app') 

@section('content')
<style>
 body {
            /* Assurez-vous que l'URL de l'image est correcte sur votre serveur */
            background-image: url("{{ asset('images/fond_ecole.jpg') }}");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-color: #ffffffff; 
        }
</style>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">Gestion des Classes</h1>
        <a href="{{ route('classe.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Ajouter une Nouvelle Classe
        </a>
    </div>

    {{-- Messages de Session --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($classes->isEmpty())
        <div class="alert alert-info text-center mt-5 p-4">
            <i class="bi bi-info-circle-fill"></i> Aucune classe n'a été trouvée. Commencez par en <a href="{{ route('classe.create') }}">ajouter une</a>.
        </div>
    @else
        <div class="table-responsive bg-white rounded-3 shadow-sm">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Nom de la Classe</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $index => $classe)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $classe->nom_classe }}</td>
                        <td><span class="badge bg-secondary">{{ $classe->type_classe }}</span></td>
                        <td>{{ \Illuminate\Support\Str::limit($classe->description, 50, '...') ?? 'N/A' }}</td>
                        <td class="text-center">
                            <a href="{{ route('classe.edit', $classe) }}" class="btn btn-sm btn-info text-white me-2" title="Modifier">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $classe->id }}" title="Supprimer">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>

                            <!-- Modal de Confirmation de Suppression -->
                            <div class="modal fade" id="deleteModal{{ $classe->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $classe->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $classe->id }}">Confirmation de Suppression</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer la classe <strong>"{{ $classe->nom_classe }}"</strong> ?
                                            <br>
                                            <small class="text-danger">Cette action est irréversible et impossible si des élèves sont affectés à cette classe.</small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('classe.destroy', $classe) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Confirmer la Suppression</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection