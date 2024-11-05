@extends('layouts.app')

@section('page-title', $project->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $project->name }}
                    </h1>
                    <h6 class="text-center">
                        Pubblicato il: {{ $project->created_at }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning">
                Modifica
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $project->id }}
                        </li>
                        <li>
                            Slug: {{ $project->slug }}
                        </li>
                        <li>
                            Tempo di consegna: {{ $project->delivery_time }}
                        </li>
                        <li>
                            Prezzo: {{ $project->price }}
                        </li>
                        <li>
                            Completato: {{ $project->complete ? 'Si' : 'No' }}
                        </li>
                        <li>
                            Tipo collegato:

                            @if (isset($project->type))
                                <a href="{{ route('admin.types.show', ['type' => $project->type_id]) }}">
                                    {{ $project->type->name }}
                                </a>
                            @else
                                -
                            @endif
                        </li>
                        <li>
                            Tecnologia collegata:

                            <ul>
                                @if (isset($project->technologies))
                                    @foreach ($project->technologies as $technology)
                                        <li>
                                            <a href="{{ route('admin.technologies.show',[ 'technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                                                {{ $technology->name }} <br> 
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                         -   
                                    </li>
                                @endif
                                
                            </ul>

                        </li>
                    </ul>


                    <p>
                        {!! nl2br($project->description) !!}
                    </p>

                    <div>
                        @if ($project->cover)
                            <img src="{{ asset('storage/'.$project->cover) }}" alt="{{ $project->name }}" class="card-img-bottom"> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection