@extends('layouts.app')

@section('title', 'Check your answers before sending your application')

@section('content')
    @include('partials.answers.service')
    @include('partials.answers.user')
    <h2 class="govuk-heading-m">Now send your service record request</h2>
    @if(Session::get('your_details')['payment_required'])
        <p class="govuk-body">By submitting this notification you are confirming that, to the best of your knowledge, the details you are providing are correct.A payment of £30 is required.
            By selecting accept &amp; pay below, you will be taken to the .Gov.Pay pages to complete the payment process.</p>
        <a class="govuk-button" href="/pay">Accept and pay</a>
    @else
        <p class="govuk-body">By submitting this notification you are confirming that, to the best of your knowledge, the
        details you are providing are correct.</p>
        <a class="govuk-button" href="/confirmation">Accept and send</a>
    @endif
@endsection
