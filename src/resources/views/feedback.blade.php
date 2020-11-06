@extends('layouts.app')

@section('pageTitle', 'Give feedback')

@section('content')
    <form method="post" action="{{ route('feedback.send') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-radio-group label="Overall how do you feel about the service you received today?"
                       field="feedback-satisfaction"
                       :options="[
                       'Very satisfied' => 'Very satisfied',
                       'Satisfied' => 'Satisfied',
                       'Neither satisfied or dissatisfied' => 'Neither satisfied or dissatisfied',
                       'Dissatisfied' => 'Dissatisfied',
                       'Very dissatisfied' => 'Very dissatisfied'
                       ]"></x-radio-group>

        <x-text-area label="Further information"
                     field="serviceperson-discharged"
                     hint="For example Ranks, Grades, Regiments, National Insurance number."
                     :mandatory="false"
                     :character-limit="200"></x-text-area>
        <x-submit-form submit="Send feedback"></x-submit-form>
    </form>
@endsection
