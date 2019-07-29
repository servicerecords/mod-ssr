@extends('layouts.app')

@section('back', '')

@section('title', 'Check your answers before sending your application')

@section('content')
    @include('partials.answers.service')
    @include('partials.answers.user')
    <h2 class="govuk-heading-m">Now send your service records request</h2>
    @if(Session::get('your_details')['payment_required'])
        <p class="govuk-body">A payment of £30 is required. Details will be provided following submission. By submitting
            this notification you are confirming that, to the best of your knowledge, the details you are providing are correct.</p>
        <a class="govuk-button" href="/pay">Accept and pay</a>
    @else
        <p class="govuk-body">By submitting this notification you are confirming that, to the best of your knowledge, the
        details you are providing are correct.</p>
        <a class="govuk-button" href="/confirmation">Accept and send</a>
    @endif
@endsection