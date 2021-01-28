@extends('layouts.app')

@section('pageTitle', 'Sorry, there is a problem with the service')

@section('content')
    <p class="govuk-body">{{ $payment->message ?? 'Something went wrong when processing your payment' }}.</p>
    <p class="govuk-body">Try again later.</p>
@endsection
