@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="calendarApp">
                    <calendar-app :current-user="{{ json_encode($user) }}" :event-types="{{ json_encode($eventTypes) }}">
                    </calendar-app>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/vue-calendar.js') }}" defer></script>
@endpush
