@extends('layouts.app')

@section('page-title', 'Modifica Progetto')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Modifica Progetto: {{ $project->name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert—danger mb—4 bg-white">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required minlength="3" maxlength="128" value="{{ old('name', $project->name) }}" placeholder="Inserisci il nome del progetto....">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required minlength="3"  maxlength="4096" placeholder="Inserisci la descrizione...">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="delivery_time" class="form-label">Tempo per il progetto in giorni</label>
                            <input type="number" class="form-control" id="delivery_time" name="delivery_time" value="{{ old('delivery_time', $project->delivery_time) }}" min='0' max='2000'  >
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Costo Del Progetto</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" value="{{ old('price', $project->price) }}">
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label">Immagine di copertina </label>
                            <input type="file" class="form-control" id="cover" name="cover" placeholder="Inserisci l'immagine di copertina del progetto....">

                            @if ($project->cover)
                                <div class="mt-3">
                                    <h5>Immagine attualmente impostata:</h5>
                                    <img src="{{ asset('storage/'.$project->cover) }}" alt="{{ $project->name }}" style="height: 175px;">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="remove_cover" id="remove_cover">
                                        <label class="form-check-label" for="remove_cover">
                                            Rimuovi la copertina attualmente impostata
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Tipo</label>
                            <select id="type_id" name="type_id" class="form-select">
                                <option
                                    @if (old('type_id', $project->type_id) == null)
                                        selected
                                    @endif 
                                    value="">Seleziona il Tipo</option>
                                @foreach ($types as $type)
                                    <option 
                                    @if (old('type_id', $project->type_id) == $type->id)
                                        selected
                                    @endif 
                                    value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <div>
                                <label class="form-label">Tecnologia</label>
                            </div>
                            @foreach ($technologies as $technology)
                                <div class="form-check form-check-inline">
                                    <input 
                                        @if ($project->technologies->contains($technology->id))
                                            checked
                                        @endif
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="technology-{{ $technology->id }}" 
                                        name="technologies[]" 
                                        value="{{ $technology->id }}">
                                    <label class="form-check-label" for="technology-{{ $technology->id }}">
                                        {{ $technology->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="complete" name="complete"
                                @if (old('complete', $project->complete) != null)
                                    checked
                                @endif
                            >
                            <label class="form-check-label" for="complete">
                                Completato<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-75 text-center">
                                Aggiorna
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection