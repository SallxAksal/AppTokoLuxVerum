@extends('layouts.app')

@section('title', 'Dashboard - LuxVerum')

@section('content')
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <div class="digital-clock-container" id="digitalClock"></div>
    </div>

    <script>
        function updateClock() {
            const clockElement = document.getElementById('digitalClock');
            const now = new Date();

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const dayName = days[now.getDay()];

            const day = now.getDate();
            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const month = monthNames[now.getMonth()];
            const year = now.getFullYear();

            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            const formattedTime = `${dayName}, ${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
            clockElement.textContent = formattedTime;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endsection
