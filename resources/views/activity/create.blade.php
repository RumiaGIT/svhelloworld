@extends('layouts.master')
@section('title', 'Activiteiten aanmaken')

@section('content')
    <p>
        Formulier om een evenement aan te maken.<br>
        Let op: als het evenement gratis is vul dan 0.00 in.<br>
        Wil je geen deelnemer limiet instellen? Laat dan het veld "Maximaal aantal leden" leeg.
    </p>

    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="{{ route('activity.store') }}" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="form-group {{ $errors->has('event_name') ? 'has-error' : ''}}">
                    <label for="event_name" class="control-label col-sm-2">Naam *</label>
                    <div class="col-sm-6">
                        <input type="text" name="event_name" id="event_name" value="{{ old('event_name') }}" class="form-control">
                        {!! $errors->first('event_name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label for="description" class="control-label col-sm-2">Beschrijving *</label>
                    <div class="col-sm-6">
                        <textarea type="text" name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('departure_location') ? 'has-error' : ''}}">
                    <label for="departure_location" class="control-label col-sm-2">Locatie van vertrek</label>
                    <div class="col-sm-6">
                        <input type="text" name="departure_location" id="departure_location" value="{{ old('departure_location') }}" class="form-control">
                        {!! $errors->first('departure_location', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('event_price_member') ? 'has-error' : ''}}">
                    <label for="event_price_member" class="control-label col-sm-2">Prijs leden *</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input type="int" name="event_price_member" id="event_price_member" value="{{ old('event_price_member') }}" class="form-control">
                        </div>
                        {!! $errors->first('event_price_member', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('event_price_non_member') ? 'has-error' : ''}}">
                    <label for="event_price_non_member" class="control-label col-sm-2">Prijs geen leden *</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input type="int" name="event_price_non_member" id="event_price_non_member" value="{{ old('event_price_non_member') }}" class="form-control">
                        </div>
                        {!! $errors->first('event_price_non_member', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('member_limit') ? 'has-error' : ''}}">
                    <label for="member_limit" class="control-label col-sm-2">Maximaal aantal deelnemers</label>
                    <div class="col-sm-6">
                            <input type="int" name="member_limit" id="member_limit" value="{{ old('member_limit') }}" class="form-control">
                        {!! $errors->first('member_limit', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('available_from') ? 'has-error' : ''}}">
                    <label for="available_from" class="control-label col-sm-2">Aanmeldingsperiode start *</label>
                    <div class="col-sm-6">
                        <input type="date" name="available_from" id="available_from" value="{{ old('available_from') }}" class="form-control">
                        {!! $errors->first('available_from', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('available_to') ? 'has-error' : ''}}">
                    <label for="available_to" class="control-label col-sm-2">Aanmeldingsperiode eind *</label>
                    <div class="col-sm-6">
                        <input type="date" name="available_to" id="available_to" value="{{ old('available_to') }}" class="form-control">
                        {!! $errors->first('available_to', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('starts_at') ? 'has-error' : ''}}">
                    <label for="starts_at" class="control-label col-sm-2">Evenement start *</label>
                    <div class="col-sm-6">
                        <input type="date" name="starts_at" id="starts_at" value="{{ old('starts_at') }}" class="form-control">
                        {!! $errors->first('starts_at', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('ends_at') ? 'has-error' : ''}}">
                    <label for="ends_at" class="control-label col-sm-2">Evenement eind *</label>
                    <div class="col-sm-6">
                        <input type="date" name="ends_at" id="ends_at" value="{{ old('ends_at') }}" class="form-control">
                        {!! $errors->first('ends_at', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Aanmaken</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
