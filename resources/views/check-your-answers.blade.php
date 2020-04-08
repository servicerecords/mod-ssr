@extends('layouts.app')

@section('title', 'Check your answers')

@section('content')
    @include('partials.answers.service')
    @include('partials.answers.user')
    <h2 class="govuk-heading-m">Submit your request</h2>
    @if(Session::get('your_details')['payment_required'])
        <ul class="govuk-list govuk-list--bullet">
            <li>By submitting you are confirming that the details are correct.</li>
            <li>A payment of £30 is required.</li>
        </ul>
        <a class="govuk-button" href="/pay">Accept and pay</a>
    @else
        <p class="govuk-body">By submitting this notification you are confirming that, to the best of your knowledge, the
        details you are providing are correct.</p>
        <a class="govuk-button" href="/confirmation">Accept and send</a>
    @endif
@endsection
