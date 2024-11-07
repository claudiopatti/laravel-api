@extends('layouts.app')

@section('page-title', 'Tutti i Progetti')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i Progetti
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-success w-100">
                Aggiungi
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Tecnologie</th>
                                <th scope="col">Descrizione</th>
                                <th scope="col">Completato</th>
                                <th scope="col">Gestione</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <th scope="row">{{ $project->id }}</th>
                                    <td>{{ $project->name }}</td>
                                    <td>
                                        @if (isset($project->type))
                                            <a href="{{ route('admin.types.show', ['type' => $project->type_id]) }}">
                                                {{ $project->type->name }} 
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($project->technologies))
                                            @foreach ($project->technologies as $technology)
                                                <a href="{{ route('admin.technologies.show',[ 'technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                                                    {{ $technology->name }} <br> 
                                                </a>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->complete ? 'Si' : 'No' }}</td>
                                    <td class="text-center ">
                                        <div class="d-flex">
                                            <a href="{{ route('admin.projects.show',[ 'project' => $project->id]) }}" class="btn btn-primary mx-2">
                                                Guarda
                                            </a><a href="{{ route('admin.projects.edit',[ 'project' => $project->id]) }}" class="btn btn-warning mx-2">
                                                Modifica
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', ['project'=> $project->id]) }}" method="POST"
                                                onsubmit="return confirm('Sei sicuro sicuro di voler eliminare il progetto: {{ $project->name }} ?')">
    
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Elimina
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection