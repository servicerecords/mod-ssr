@extends('layouts.app', ['title' => 'Page Expired - '])

@section('pageTitle', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))


@section('content')
    <p class="govuk-body">
        If you typed the web address, check it is correct.
    </p>
    <p class="govuk-body">
        If you pasted the web address, check you copied the entire address.
    </p>
    <p class="govuk-body">
        If the web address is correct or you selected a link or button,
        you will need to <a href="/service">restart your application</a>.
    </p>
@endsection
