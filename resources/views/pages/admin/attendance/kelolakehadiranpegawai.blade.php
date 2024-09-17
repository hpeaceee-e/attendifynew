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
                                        <li><a href="{{ route('admin.print-kelolakehadiranpegawai') }}"
                                                class="btn btn-secondary" target="_blank"><em
                                                    class="icon ni ni-printer"></em><span>Cetak</span></a></li>
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
                                        <th>Lokasi</th>
                                        <th>Action</th>
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
                                                <span
                                                    class="badge {{ $status == 'Tepat Waktu' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $status }}
                                                </span>
                                            </td>
                                            <td>{{ $coordinate ?: '-' }}</td>
                                            <td>
                                                <ul class="nk-tb-actions gx-2">
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#"
                                                                class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                                data-bs-toggle="dropdown">
                                                                <em class="icon ni ni-more-h"></em>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><em
                                                                                class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                    </li>
                                                                    <li><a href="#"><em
                                                                                class="icon ni ni-na"></em><span>Hapus</span></a>
                                                                    </li>
                                                                    <li><a href="{{ route('admin.print-kelolakehadiranpegawai-orang', ['id' => $group->first()->id]) }}"
                                                                            target="_blank"><em
                                                                                class="icon ni ni-printer"></em><span>Cetak</span></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
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
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" name="date" id="date" class="form-control">
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
