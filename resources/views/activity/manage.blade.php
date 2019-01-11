@extends('layouts.master')
@section('title', 'Activiteiten overzicht')

@section('content')
    @if ($activities->count())
        <p>Dit is een overzicht van alle activiteiten.</p>

        <div class="table-responsive">
            <table id="activity-manage-table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Datum en tijd</th>
                        <th>Aanmeldperiode</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>
                                <a href="{{ route('activity.show', $activity->id) }}">{{ $activity->title }}</a>
                            </td>
                            <td>
                                @datetime($activity->starts_at) t/m @datetime($activity->ends_at)
                            </td>
                            <td>
                                @date($activity->available_from) t/m @date($activity->available_to)
                            </td>
                            <td>
                                <a href="{{ route('activity.entries', $activity->id) }}" class="btn btn-primary btn-xs">Aanmeldingen</a>
                                <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-primary btn-xs">Activiteit informatie</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="alert alert-info">Er zijn op dit moment geen activiteiten.</p>
    @endif
@endsection
