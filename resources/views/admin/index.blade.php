@extends('layouts.admin')

@section('content')
    @if (auth()->user()->hasRole('admin'))
        @include('admin.dashboard.admin')
    @elseif (auth()->user()->hasRole('doctor'))
        @include('admin.dashboard.doctor')
    @elseif (auth()->user()->hasRole('patient'))
        @include('admin.dashboard.patient')
    @endif
@endsection
