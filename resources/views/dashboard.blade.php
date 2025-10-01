@extends('layouts.app')

@section('title', 'Dashboard - LuxVerum')

@section('content')
    <h1>Dashboard</h1>
    <div id="datetime" style="font-size: 1.5rem; font-weight: 600; color: #b30000;"></div>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <script>
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = now.toLocaleDateString('id-ID', options);
            const timeStr = now.toLocaleTimeString('id-ID');
            document.getElementById('datetime').textContent = dateStr + ' ' + timeStr;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
@endsection
