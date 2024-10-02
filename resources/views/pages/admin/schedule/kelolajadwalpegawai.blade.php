@extends('layout.main')
@section('title')
    Kelola Jadwal Pegawai
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Jadwal Pegawai</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ route('admin.print-jadwal') }}" class="btn btn-secondary"
                                                    target="_blank"><em
                                                        class="icon ni ni-printer"></em><span>Cetak</span></a></li>
                                            <a href="{{ route('admin.tambahjadwal') }}" class="btn btn-icon btn-secondary">
                                                <em class="icon ni ni-plus"></em>
                                            </a>
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
                                            <th class="text-center">No</th>
                                            <th>Shift</th>
                                            <th class="text-center">Jam Kerja</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            @php
                                                $clockIn = \Carbon\Carbon::parse($schedule->clock_in);
                                                $break = \Carbon\Carbon::parse($schedule->break);
                                                $clockOut = \Carbon\Carbon::parse($schedule->clock_out);

                                                // Calculate total work hours
                                                $workHours =
                                                    $clockOut->diffInHours($clockIn) - $break->diffInHours($clockIn);
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $schedule->id }}</td>
                                                <td>Pegawai</td>
                                                <td>
                                                    {{ $clockIn->format('H:i') }} - {{ $break->format('H:i') }} (Istirahat)
                                                    - {{ $clockOut->format('H:i') }}
                                                    <br>
                                                    <small>Total Jam Kerja:
                                                        {{-- {{ $workHours }} --}} 1231231 Jam
                                                        jam</small>
                                                </td>
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
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('admin.editjadwal', ['id' => $schedule->id]) }}">
                                                                                <em
                                                                                    class="icon ni ni-edit"></em><span>Edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#"><em
                                                                                    class="icon ni ni-na"></em><span>Hapus</span></a>
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
                    <div class="nk-block">
                        <h3 class="nk-block-title page-title">Pembagian Jadwal Pegawai</h3>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Pegawai</th>
                                            <th class="text-center">Jadwal</th>
                                            {{-- <th class="text-center">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($schedules as $schedule) --}}
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Nama Pegawai</td>
                                            <!-- Adjust this line according to your model -->
                                            <td>
                                                <select name="schedule" class="form-control">
                                                    <option value="shift">Shift</option>
                                                    <option value="pegawai">Pegawai</option>
                                                    <option value="internship">Internship</option>
                                                    <option value="pkl_smk">PKL SMK</option>
                                                </select>
                                            </td>

                                            {{-- @endforeach --}}
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-secondary">Simpan Jadwal</button>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->

                </div>
            </div>
        </div>
    </div>
@endsection
