@extends('layout.pegawai.main')
@section('title')
    Attendance
@endsection
@section('content-pegawai')

<div class="container">


<!-- Tombol Absen Masuk/Pulang -->
<div class="mb-3">
    <a href="{{ route('pegawai.tambah-attendance') }}" class="btn btn-primary">Absen Masuk/Pulang</a>
</div>
<div class="container mt-5">
<div class="card card-bordered card-full">
    <h4 class="card-title text-center mt-1"> Your Attendance </h4>
    <!-- Tabel Kehadiran -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Coordinate</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->time }}</td>
                    <td>
                        @if($attendance->status == 0)
                            Masuk
                        @else
                            Pulang
                        @endif
                    </td>
                    <td>{{ $attendance->coordinate }}</td>
                    <td>
                        <!-- Tombol Print -->
                        <a href="{{ route('pegawai.print-attendance', $attendance->id) }}" class="btn btn-info btn-sm">Print</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>


    <!-- Tempat Kalender -->
    <div class="card">
<h4 class="card-title mt-5 text-center">Calendar</h4>
    <div  id="calendar"></div>
</div>
</div>

<!-- Modal Print -->
<div id="printModal" style="display:none;">
    <div id="printContent"></div>
</div>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($attendances->map(function($att) {
                return [
                    'title' => ucfirst($att->status == 0 ? 'Masuk' : 'Pulang'),
                    'start' => $att->date
                ];
            })),
        });
        calendar.render();
    });

    function printAttendance(id) {
        // Ambil data kehadiran berdasarkan ID
        var attendance = @json($attendances->keyBy('id'));
        var data = attendance[id];

        // Format konten cetak
        var printContent = `
            <h2>Detail Kehadiran</h2>
            <p><strong>Tanggal:</strong> ${data.date}</p>
            <p><strong>Waktu:</strong> ${data.time}</p>
            <p><strong>Status:</strong> ${data.status == 0 ? 'Masuk' : 'Pulang'}</p>
            <p><strong>Latitude:</strong> ${data.latitude}</p>
            <p><strong>Longitude:</strong> ${data.longitude}</p>
            <p><strong>Koordinat:</strong> ${data.coordinate}</p>
            <div id="mapPrint" style="height: 300px;"></div>
        `;

        // Tampilkan konten cetak dalam modal
        document.getElementById('printContent').innerHTML = printContent;
        document.getElementById('printModal').style.display = 'block';

        // Cetak konten modal
        var map = L.map('mapPrint').setView([data.latitude, data.longitude], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);
        L.marker([data.latitude, data.longitude]).addTo(map);

        window.print();
        document.getElementById('printModal').style.display = 'none';
    }
</script>
@endsection

