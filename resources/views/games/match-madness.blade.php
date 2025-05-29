@extends('layouts.app')

@section('content')
<div id="vue-app">
    <match-madness-game></match-madness-game>
</div>
@endsection

@push('styles')
<style>
    /* Remove default padding for game view */
    .py-12 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }
    
    /* Full screen game container */
    #vue-app {
        min-height: 100vh;
        background-color: #f5f5f5;
    }
</style>
@endpush