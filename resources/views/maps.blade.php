@extends('layouts.main')

@section('title', 'Maps')

@section('content')
    <h1 class="d-flex justify-content-center text-danger">Eventos por Localização</h1>
    <div id="map" style="height: 800px;"></div>
    <script id="events-data" type="application/json">
        @json($events)
    </script>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection
