@extends('layouts.master')
@section('title', 'Gebruikers')

@section('content')

    <p>
        <a class="btn btn-primary" href="{{ route('user.create') }}">Maak nieuwe gebruiker</a>
        <a class="btn btn-primary" href="{{ route('user.members') }}">Bekijk alle leden</a>
    </p>

    <div class="table-responsive">
        <table id="user-index-table" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Naam</th>
                <th>E-mailadres</th>
                <th>Registratiedatum</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td><img src="{{ Gravatar::src($user->email, 40) }}" alt="{{ $user->first_name }}" class="avatar">
                    </td>
                    <td><a href="{{ route('user.show', $user->id) }}">{{ $user->full_name() }} </a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{!! $user->verified ? '<span class="label label-success">Geverifieerd</a>' : '<span class="label label-warning">Niet geverifieerd</span>' !!}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs"><i
                                    class="fa fa-pencil"></i> Bewerk</a>
                        <a href="{{ route('payment.user', $user->id) }}" class="btn btn-primary btn-xs"><i
                                    class="fa fa-money"></i> Betalingen</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
