@extends('layout.main')
@section('title')
    Kelola Kehadiran Pegawai
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Kelola Kehadiran Pegawai</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">

                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li><a href="#" class="btn btn-secondary" target="_blank"
                                                data-bs-toggle="modal" data-bs-target="#filterModal"><em
                                                    class="icon ni ni-filter"></em><span>Filter</span></a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn btn-secondary" target="_blank"
                                                data-bs-toggle="modal" data-bs-target="#printModal">
                                                <em class="icon ni ni-printer"></em><span>Cetak</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pegawai</th>
                                        <th>Tanggal</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Kehadiran</th>
                                        {{-- <th>Lokasi</th> --}}
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $attendancesGrouped = $attendances->groupBy('date');
                                    @endphp

                                    @foreach ($attendancesGrouped as $date => $group)
                                        @php
                                            // Initialize variables
                                            $clockIn = null;
                                            $clockOut = null;
                                            $coordinate = null;
                                            $status = '-'; // Default status

                                            foreach ($group as $attendance) {
                                                if ($attendance->status == 0) {
                                                    $clockIn = \Carbon\Carbon::parse($attendance->time)->format('H:i');
                                                    $coordinate = $attendance->coordinate;
                                                } elseif ($attendance->status == 1) {
                                                    $clockOut = \Carbon\Carbon::parse($attendance->time)->format('H:i');
                                                }
                                            }

                                            if ($clockIn && $group->first()->schedule) {
                                                $actualTime = \Carbon\Carbon::parse($clockIn);
                                                $scheduledTime = \Carbon\Carbon::parse(
                                                    $group->first()->schedule->clock_in,
                                                );
                                                $status = $actualTime <= $scheduledTime ? 'Tepat Waktu' : 'Terlambat';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $group->first()->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</td>
                                            <td>{{ $clockIn ?: '-' }}</td>
                                            <td>{{ $clockOut ?: '-' }}</td>
                                            <td>

                                                @php
                                                    $clockInTime = strtotime($clockIn);
                                                    $clockInTime = strtotime($clockIn); // Assuming $clockIn is a time string like '08:30'
                                                    $comparisonTime = strtotime('08:00');
                                                    $differenceInMinutes =
                                                        $clockInTime > $comparisonTime
                                                            ? round(($clockInTime - $comparisonTime) / 60)
                                                            : 0;
                                                    $difference = round(abs($clockInTime - $comparisonTime) / 60);
                                                @endphp

                                                @if ($clockInTime > $comparisonTime)
                                                    <span class="badge bg-danger">Terlambat</span><br>
                                                    {{ $differenceInMinutes }} Menit <br> after 08.00
                                                @else
                                                    <span class="badge bg-success">Tepat waktu</span> <br>
                                                    {{ $difference }} Menit <br> before 08.00
                                                @endif
                                            </td>

                                            {{-- <td>{{ $coordinate ?: '-' }}</td> --}}
                                            <td>
                                                <ul class="nk-tb-actions gx-2">
                                                    {{-- <li> --}}
                                                    {{-- <div class="dropdown">
                                                            <a href="#"
                                                                class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                                data-bs-toggle="dropdown">
                                                                <em class="icon ni ni-more-h"></em>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr"> --}}
                                                    {{-- <li><a href="#"><em
                                                                                class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                    </li>
                                                                    <li><a href="#"><em
                                                                                class="icon ni ni-na"></em><span>Hapus</span></a>
                                                                    </li> --}}
                                                    @if ($clockIn == null && $clockOut == null)
                                                    @elseif($clockIn == null)
                                                        <li><a href="{{ route('admin.print-kelolakehadiranpegawai-keluar', ['id' => $group->first()->id]) }}"
                                                                target="_blank" class="btn btn-secondary btn-sm"><em
                                                                    class="icon ni ni-printer"></em><span>Keluar</span></a>
                                                        </li>
                                                    @elseif ($clockOut == null)
                                                        <li><a href="{{ route('admin.print-kelolakehadiranpegawai-masuk', ['id' => $group->first()->id]) }}"
                                                                target="_blank" class="btn btn-secondary btn-sm"><em
                                                                    class="icon ni ni-printer"></em><span>Masuk</span></a>
                                                        </li>
                                                    @else
                                                        <li><a href="{{ route('admin.print-kelolakehadiranpegawai-masuk', ['id' => $group->first()->id]) }}"
                                                                target="_blank" class="btn btn-secondary btn-sm"><em
                                                                    class="icon ni ni-printer"></em><span>Masuk</span></a>
                                                        </li>
                                                        <li><a href="{{ route('admin.print-kelolakehadiranpegawai-keluar', ['id' => $group->first()->id]) }}"
                                                                target="_blank" class="btn btn-secondary btn-sm"><em
                                                                    class="icon ni ni-printer"></em><span>Keluar</span></a>
                                                        </li>
                                                    @endif

                                                    {{-- @if ($clockOut) --}}

                                                    {{-- @endif --}}
                                                    {{-- </ul>
                                                            </div>
                                                        </div> --}}
                                                    {{-- </li> --}}
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
                <!-- Modal Cetak -->
                <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="printModalLabel">Cetak Kehadiran Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="printForm" action="#" method="GET">
                                <div class="modal-body">
                                    <!-- Dropdown Pilihan Cetak -->
                                    <div class="form-group">
                                        <label for="printOption">Pilih Opsi Cetak</label>
                                        <select name="printOption" id="printOption" class="form-control"
                                            onchange="toggleDateInputs()">
                                            <option value="all" selected>Cetak Semua</option>
                                            <option value="byDate">Cetak Sesuai Tanggal</option>
                                            <option value="byMonth">Cetak Sesuai Bulan</option>
                                            <option value="byYear">Cetak Sesuai Tahun</option>
                                        </select>
                                    </div>

                                    <!-- Input Tanggal -->
                                    <div class="form-group" id="dateInput" style="display:none;">
                                        <label class="form-label">Tanggal</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" data-date-format="dd M yyyy"
                                                class="form-control date-picker" name="date">
                                        </div>
                                    </div>

                                    <!-- Input Bulan -->
                                    <div class="form-group" id="monthInput" style="display:none;">
                                        <label class="form-label">Bulan</label>
                                        <div class="form-control-wrap">
                                            <input type="month" class="form-control" name="month">
                                            {{-- <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar"></em>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <!-- Input Tahun -->
                                    <div class="form-group" id="yearInput" style="display:none;">
                                        <label class="form-label">Tahun</label>
                                        <div class="form-control-wrap">
                                            <input type="year" class="form-control" name="year"
                                                placeholder="Tahun">
                                            {{-- <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar"></em>
                                            </div> --}}
                                        </div>
                                    </div>


                                    <!-- Filter Status Kehadiran -->
                                    <div class="form-group">
                                        <label for="status">Status Kehadiran</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected>Semua</option>
                                            <option value="Tepat Waktu">Tepat Waktu</option>
                                            <option value="Terlambat">Terlambat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Filter -->
                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">Filter Kehadiran Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="filterForm" action="#" method="GET">
                                <div class="modal-body">
                                    <!-- Filter Tanggal -->
                                    {{-- <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="text" name="date" id="date" class="form-control date-picker"
                                            data-date-format="dd M yyyy">
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="form-label">Tanggal</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-calendar-alt"></em>
                                            </div>
                                            <input type="text" data-date-format="dd M yyyy"
                                                class="form-control date-picker" id="date" name="date" required>
                                        </div>
                                    </div>

                                    <!-- Filter Status Kehadiran -->
                                    <div class="form-group">
                                        <label for="status">Status Kehadiran</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected>Semua</option>
                                            <option value="Tepat Waktu">Tepat Waktu</option>
                                            <option value="Terlambat">Terlambat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Fungsi untuk menampilkan input berdasarkan opsi cetak
        function toggleDateInputs() {
            var printOption = document.getElementById("printOption").value;
            document.getElementById("dateInput").style.display = (printOption === "byDate") ? "block" : "none";
            document.getElementById("monthInput").style.display = (printOption === "byMonth") ? "block" : "none";
            document.getElementById("yearInput").style.display = (printOption === "byYear") ? "block" : "none";
        }
    </script>
@endsection
