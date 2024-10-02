@extends('layout.pegawai.main')

@section('title')
    Pegawai {{ auth()->user()->name }}
@endsection

@section('content-pegawai')
    <div class="nk-block-head-content">
        <div class="toggle-wrap nk-block-tools-toggle">
            <div class="container" style="padding-top: 30px;">
                <!-- Tombol Absen Masuk/Pulang dan Cetak -->
                <div class="mt-5 d-flex align-items-center">
                    <a id="attendance-btn" href="{{ route('pegawai.tambah-attendance') }}"
                        class="btn btn-secondary d-inline-block">
                        Absen Masuk/Pulang
                    </a>

                    <!-- Spacer to push the print button to the right -->
                    <div class="ms-auto d-flex align-items-center">
                        <!-- Tombol Cetak -->
                        <a href="#" class="btn btn-secondary d-inline-block" data-bs-toggle="modal"
                            data-bs-target="#printModal">
                            <em class="icon ni ni-printer"></em> Cetak
                        </a>
                    </div>

                    <!-- Notifikasi Sukses -->
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Pesan di luar waktu absensi -->
                    <div id="message" style="display: none;">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <div>
                                <strong>Perhatian!</strong> Sudah tidak memasuki waktu absensi.
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Script Jam Absensi -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var now = new Date();
                        var hour = now.getHours();
                        if (hour >= 15 && hour < 16) {
                            document.getElementById('attendance-btn').style.display = 'none';
                            document.getElementById('message').style.display = 'block';
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Tabel Kehadiran -->
        <div class="container mt-2">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <h4 class="card-title text-center mt-1">Absensi Anda</h4>
                    <table class="datatable-init table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Koordinat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->time)->format('H:i') }}</td>
                                    <td>
                                        @if ($attendance->status == 0)
                                            Masuk
                                        @else
                                            Pulang
                                        @endif
                                    </td>
                                    <td>{{ $attendance->coordinate }}</td>
                                    <td>
                                        <a href="{{ route('pegawai.print-attendance', $attendance->id) }}"
                                            class="btn btn-secondary btn-sm" target="_blank">
                                            <em class="icon ni ni-printer"></em> Cetak
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Print -->
        <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="printModalLabel">Cetak Kehadiran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="printForm" action="#" method="GET">
                        <div class="modal-body">
                            <!-- Input Bulan -->
                            <div class="form-group">
                                <label class="form-label">Bulan</label>
                                <div class="form-control-wrap">
                                    <input type="month" class="form-control" name="month" required>
                                </div>
                            </div>

                            <!-- Input Tahun -->
                            <div class="form-group">
                                <label class="form-label">Tahun</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="year" placeholder="Tahun"
                                        pattern="\d{4}" required>
                                </div>
                            </div>

                            {{-- <!-- Filter Status Kehadiran -->
                            <div class="form-group">
                                <label for="status">Status Kehadiran</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Semua</option>
                                    <option value="Tepat Waktu">Tepat Waktu</option>
                                    <option value="Terlambat">Terlambat</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
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
        <p><strong>Koordinat:</strong> ${data.coordinate}</p>
        <div id="mapPrint" style="height: 300px;"></div>
    `;

            document.getElementById('printContent').innerHTML = printContent;
            document.getElementById('printModal').style.display = 'block';

            // Initialize map
            var map = L.map('mapPrint').setView([data.latitude, data.longitude], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);
            L.marker([data.latitude, data.longitude]).addTo(map);

            window.print(); // Use browser print dialog
            document.getElementById('printModal').style.display = 'none'; // Hide modal after printing
        }
    </script>
@endsection
