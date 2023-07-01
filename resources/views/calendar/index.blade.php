@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div id="app">
                <main-app :current-user="{{ json_encode(auth()->user()) }}"></main-app>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-calendar.js') }}"></script>
@endpush
