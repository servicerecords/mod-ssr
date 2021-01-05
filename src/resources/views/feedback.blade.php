@extends('layouts.app', ['title' => 'Feedback - '])

@section('pageTitle', 'Give feedback')

@section('content')
    <form method="post" action="{{ route('feedback.send') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-radio-group label="Overall how do you feel about the service you received today?"
                       field="feedback-satisfaction"
                       :options="[
                           ['label' => 'Very satisfied', 'children' => []],
                           ['label' => 'Satisfied', 'children' => []],
                           ['label' => 'Neither satisfied or dissatisfied', 'children' => []],
                           ['label' => 'Dissatisfied', 'children' => []],
                           ['label' => 'Very dissatisfied', 'children' => []],
                       ]"></x-radio-group>

        <x-text-area label="How could we improve this service?"
                     field="feedback-improvement"
                     hint="Do not include personal or financial information, like your National Insurance number or credit card details."
                     :mandatory="false"
                     :character-limit="1200"></x-text-area>
        <x-submit-form submitLabel="Send feedback" :can-cancel="false"></x-submit-form>
    </form>
@endsection
