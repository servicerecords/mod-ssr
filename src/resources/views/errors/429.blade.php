@extends('layouts.app', ['title' => 'Too many requests - '])

@section('pageTitle', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
