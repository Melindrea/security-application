@extends('layouts.master')

@section('content')
    @if ($title)
    <h1>{{ $title }}</h1>
    @endif
    {{ $document }}
@stop
