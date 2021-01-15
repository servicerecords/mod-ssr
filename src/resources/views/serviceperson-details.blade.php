@extends('layouts.app', ['title' => 'Serviceperson\'s Further Details - '])

@section('pageTitle', 'Details of the serviceperson')

@section('content')
    <form method="post" action="{{ route('serviceperson-details.save') }}" novalidate>
        <x-error-summary :errors="$errors"></x-error-summary>
        <x-textfield
            :label="session('service') === \App\Models\ServiceBranch::HOME_GUARD ? 'National Registration number' : 'Service number'"
            field="serviceperson-service-number" :mandatory="false"></x-textfield>
        @includeWhen((session('service') === \App\Models\ServiceBranch::ARMY),        'partials.army-serviceperson')
        @includeWhen((session('service') === \App\Models\ServiceBranch::NAVY),        'partials.navy-serviceperson')
        @includeWhen((session('service') === \App\Models\ServiceBranch::RAF),         'partials.raf-serviceperson')
        @includeWhen((session('service') === \App\Models\ServiceBranch::HOME_GUARD),  'partials.home-guard-serviceperson')
        <x-submit-form></x-submit-form>
    </form>
@endsection
