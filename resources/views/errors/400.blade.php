@extends('errors::minimal')

@section('title', __('badrequest'))
@section('code', '400')
@section('message', __($exception->getMessage()))
