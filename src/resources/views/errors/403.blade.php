@extends('layouts.app', ['title' => 'Forbidden - '])

@section('pageTitle', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
