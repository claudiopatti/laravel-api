@extends('layouts.app')

@section('page-title', 'Tutte le Tecnologie')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutte le Tecnologie
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-success w-100">
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
                                <th scope="col" >Nome</th>
                                <th scope="col" class="text-center "># Progetti collegati</th>
                                <th scope="col" class="text-center">Gestione</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($technologies as $technology)
                                <tr>
                                    <th scope="row">{{ $technology->id }}</th>
                                    <td>{{ $technology->name }}</td>
                                    <td class="text-center ">{{ count($technology->projects) }}</td>
                                    <td class="d-flex justify-content-center ">
                                        <a href="{{ route('admin.technologies.show',[ 'technology' => $technology->id]) }}" class="btn btn-primary mx-2">
                                            Guarda
                                        </a>
                                        <a href="{{ route('admin.technologies.edit',[ 'technology' => $technology->id]) }}" class="btn btn-warning mx-2">
                                            Modifica
                                        </a>
                                        <form action="{{ route('admin.technologies.destroy', ['technology'=> $technology->id]) }}" method="POST"
                                            onsubmit="return confirm('Sei sicuro sicuro di voler eliminare il tipo: {{ $technology->name }} ?')">

                                            @csrf
                                            @method('DELETE')
                                            <button technology="submit" class="btn btn-danger">
                                                Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection