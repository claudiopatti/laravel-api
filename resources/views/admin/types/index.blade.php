@extends('layouts.app')

@section('page-title', 'Tutti i Tipi')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i Tipi
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.types.create') }}" class="btn btn-success w-100">
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
                            @foreach ($types as $type)
                                <tr>
                                    <th scope="row">{{ $type->id }}</th>
                                    <td>{{ $type->name }}</td>
                                    <td class="text-center ">{{ count($type->projects) }}</td>
                                    <td class="d-flex justify-content-center ">
                                        <a href="{{ route('admin.types.show',[ 'type' => $type->id]) }}" class="btn btn-primary mx-2">
                                            Guarda
                                        </a>
                                        <a href="{{ route('admin.types.edit',[ 'type' => $type->id]) }}" class="btn btn-warning mx-2">
                                            Modifica
                                        </a>
                                        <form action="{{ route('admin.types.destroy', ['type'=> $type->id]) }}" method="POST"
                                            onsubmit="return confirm('Sei sicuro sicuro di voler eliminare il tipo: {{ $type->name }} ?')">

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
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