@extends('layouts.master')
@section('title', 'Betalingen')

@section('content')

    @if (! $payments->count())
        <div class="text-center">
            Nothing to see here ;)
        </div>
    @endif

    @foreach($payments as $payment)
        <div class="panel panel-default">
            <div class="panel-body p-sm">
                <div class="row">
                    <div class="col-md-1">
                        @if ($payment->paid())
                            <div class="avatar avatar-icon avatar-success">
                                <i class="fa fa-fw fa-check"></i>
                            </div>
                        @else
                            <div class="avatar avatar-icon avatar-warning">
                                <i class="fa fa-fw fa-dollar"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 l-20">
                        <strong>{{ $payment->description }}</strong><br>
                        <span class="small">
                            #{{ $payment->id }}
                        </span>
                    </div>

                    <div class="col-md-2 l-40">
                        <strong>&euro; {{ $payment->amount }}</strong><br>
                    </div>

                    <div class="col-md-3 l-40 text-right">
                        <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-link">Details</a>
                        @if ($payment->paid())
                            <a href="{{ route('payment.invoice', $payment->id) }}" class="btn btn-link"><strong>Factuur</strong></a>
                        @else
                            <a href="{{ route('payment.pay', $payment->id) }}" class="btn btn-link"><strong>Betalen</strong></a>
                        @endif
                    </div>

                    {{-- <div class="col-md-3 l-40">
                        <strong>&euro; {{ $payment->amount }}</strong><br>
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach

@endsection
