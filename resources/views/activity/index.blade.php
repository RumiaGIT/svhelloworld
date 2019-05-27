@extends('layouts.master')
@section('title', 'Activiteiten')

@section('content')
    @if ($activities->count())
        <div class="row">
            @foreach($activities as $activity)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="m-b-0">{{ $activity->title }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-info">
            Op dit moment zijn er geen activiteiten beschikbaar, kijk op een later moment nog eens!
        </p>
    @endif
@endsection
