@extends('layouts.master')
@section('title', 'Activiteiten')

@section('content')
    @if ($activities->count())
        <div class="row">
            @foreach($activities as $activity)
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <a class="show panel-body" href="{{ route('activity.show', $activity->id) }}">
                            <div class="row">
                                <div class="h3 col-sm-9 col-xs-12">
                                    {{ $activity->title }}
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    @php
                                        $spotsLeft = $activity->member_limit - $activity->entries->count();
                                    @endphp
                                    @if ($activity->member_limit === NULL || $spotsLeft >= 10)
                                        <span class="label label-success pull-right">Inschrijving geopend</span>
                                    @elseif ($spotsLeft > 0 && $spotsLeft < 10)
                                        <span class="label label-danger pull-right">Nog {{ $spotsLeft }} {{ $spotsLeft === 1 ? 'plek' : 'plekken'}}</span>
                                    @else
                                        <span class="label label-default pull-right">Uitverkocht</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <p>
                                @if ($activity->starts_at->format('d M Y') === $activity->ends_at->format('d M Y'))
                                    {{ $activity->starts_at->format('d M Y') }}, {{ $activity->starts_at->format('H:i') }} - {{ $activity->ends_at->format('H:i') }}
                                @else
                                    {{ $activity->starts_at->format('d M Y') }}, {{ $activity->starts_at->format('H:i') }} - {{ $activity->ends_at  ->format('d M Y') }}, {{ $activity->ends_at->format('H:i') }}
                                @endif
                            </p>
                            <div class="row">
                                <div class="col-xs-9 h5 text-info">
                                    Lees meer
                                </div>
                                <div class="col-xs-3 h6 text-info text-right">
                                    <i class="fa fa-fw fa-chevron-right"></i>
                                </div>
                            </div>
                        </a>
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
