@extends('layout.pegawai.main')

@section('title')
    Pegawai {{ auth()->user()->name }}
@endsection

@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <div class="mt-5 d-flex align-items-center">
                                <ul class="nk-block-tools g-3">
                                    <!-- Tombol Absen Masuk/Pulang -->
                                    @php
                                        // Mengambil data hari ini
                                        $today = \Carbon\Carbon::today();
                                        $days = \Carbon\Carbon::parse($today)->locale('id')->dayName;


                                        $jadwalin = $jadwal_detail->where('days', $days)->first();
                                        // dd($jadwalin);
                            
                                        
                                        if ($jadwalin) {
                                           // Mengambil jam clockin dan clockout sebagai objek Carbon
                                            $clockin = \Carbon\Carbon::parse($jadwalin->clock_in); // Mengambil sebagai objek Carbon
                                            $clockout = \Carbon\Carbon::parse($jadwalin->clock_out); // Mengambil sebagai objek Carbon
                                            $now = \Carbon\Carbon::now();

                                            // Menentukan waktu untuk absensi masuk dan pulang
                                            $satuJamDariClockin = $clockin->copy()->addHour(); // Menambahkan satu jam dari waktu clockin
                                            $jamEmpat = $clockin->copy()->setHour(16); // Jam 4 sore

                                            // dd($clockout); // Menampilkan satu jam dari clockin

                            
                                            // Menampilkan tombol berdasarkan kondisi
                                            if ($now <= $satuJamDariClockin) {
                                                // Menampilkan tombol untuk absen masuk
                                                echo '<li><a id="attendance-btn" href="' . route('pegawai.tambah-attendance') . '" class="btn btn-secondary d-inline-block">Absen Masuk</a></li>';
                                            } elseif ($now >= $clockout) {
                                                // Menampilkan tombol untuk absen pulang
                                                echo '<li><a id="attendance-btn" href="' . route('pegawai.tambah-attendance') . '" class="btn btn-secondary d-inline-block">Absen Pulang</a></li>';
                                            }
                                        }
                                    @endphp
                            
                                    <!-- Spacer to push the print button to the right -->
                                    <div class="ms-auto">
                                        <!-- Tombol Cetak -->
                                        <li>
                                            <a href="#" class="btn btn-secondary d-inline-block" data-bs-toggle="modal" data-bs-target="#printModal">
                                                <em class="icon ni ni-printer"></em> Cetak
                                            </a>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                            
                            <!-- Pesan Sukses/Error -->
                            @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('success') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                </script>
                            @endif
                            @if (session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: '{{ session('error') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                </script>
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
                </div>
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
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
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

        <!-- Kalender Kehadiran -->
        <div class="card mt-4 card-bordered card-preview">
            <div class="card-inner py-3 border-bottom border-light">
                <h4 class="card-title text-center">Calendar</h4>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
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
