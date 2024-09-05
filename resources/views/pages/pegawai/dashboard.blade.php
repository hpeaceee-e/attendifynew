@extends('layout.pegawai.main')
@section('title')
    Dashboard {{ auth()->user()->name }}
@endsection
@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-content p-0">
                    <div class="nk-content-inner">
                        <div class="nk-content-body p-0">
                            <div class="nk-block">
                                <div class="card bg-transparent">
                                    <div class="card-inner py-3 border-bottom border-light rounded-0">
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-between">
                                                <div class="nk-block-head-content">
                                                    <h3 class="nk-block-title page-title">Calendar</h3>
                                                </div><!-- .nk-block-head-content -->
                                            </div><!-- .nk-block-between -->
                                        </div><!-- .nk-block-head -->
                                    </div>
                                </div>
                                <div class="card mt-0">
                                    <div class="card-inner">
                                        <div id="calendar" class="nk-calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json(
                    $attendances->map(function ($att) {
                        return [
                            'title' => ucfirst($att->status == 0 ? 'Masuk' : 'Pulang'),
                            'start' => $att->date,
                        ];
                    })),
            });
            calendar.render();
        });

        function printAttendance(id) {
            var attendance = @json($attendances->keyBy('id'));
            var data = attendance[id];

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

            document.getElementById('printContent').innerHTML = printContent;
            document.getElementById('printModal').style.display = 'block';

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
