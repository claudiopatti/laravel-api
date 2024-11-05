@extends('layouts.app')

@section('page-title', $type->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $type->name }}
                    </h1>
                    <h6 class="text-center">
                        Pubblicato il: {{ $type->created_at }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.types.edit', ['type' => $type->id]) }}" class="btn btn-warning">
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
                            ID: {{ $type->id }}
                        </li>
                        <li>
                            Slug: {{ $type->slug }}
                        </li>
                        <li>
                            Tipi collegati:

                            @if ($type->projects()->count() > 0)
                                <ul>
                                    @foreach ($type->projects as $project)
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
                        {!! nl2br($type->description) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection