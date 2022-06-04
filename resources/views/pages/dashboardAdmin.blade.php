{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">






@endsection

{{-- Scripts Section --}}
@section('scripts')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
    @csrf
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
