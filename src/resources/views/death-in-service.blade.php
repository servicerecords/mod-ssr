@extends('layouts.app', ['title' => 'Did they die in Service - '])
@section('pageTitle', 'Details of the serviceperson')

@section('content')
    <form method="post" action="{{ route('death-in-service.save') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-radio-group label="Did they die in service?"
                       field="serviceperson-died-in-service"
                       :options="$options"></x-radio-group>
        <x-submit-form></x-submit-form>
    </form>
@endsection
