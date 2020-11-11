@extends('layouts.app')

@section('pageTitle', 'Sorry, there is a problem with the service')

@section('content')
    @if($message)
        <p class="govuk-body">{{ $message }}</p>
    @endif
    <p class="govuk-body">Try again later.</p>
@endsection
