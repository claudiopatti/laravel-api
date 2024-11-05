@extends('layouts.app')

@section('page-title', $technology->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $technology->name }}
                    </h1>
                    <h6 class="text-center">
                        Pubblicato il: {{ $technology->created_at }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-warning">
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
                            ID: {{ $technology->id }}
                        </li>
                        <li>
                            Slug: {{ $technology->slug }}
                        </li>
                        <li>
                            Tipi collegati:

                            @if ($technology->projects()->count() > 0)
                                <ul>
                                    @foreach ($technology->projects as $project)
                                        <li>
                                            <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">
                                                {{ $project->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>                                
                            @else
                                -
                            @endif

                        </li>
                    </ul>


                    <p>
                        {!! nl2br($technology->description) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection