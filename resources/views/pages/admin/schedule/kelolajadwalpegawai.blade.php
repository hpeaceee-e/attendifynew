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
                                            <li><a href="{{ route('admin.print-jadwal') }}"
                                                    class="btn btn-white btn-outline-light" target="_blank"><em
                                                        class="icon ni ni-printer"></em><span>Cetak</span></a></li>
                                            <a href="{{ route('admin.tambahjadwal') }}" class="btn btn-icon btn-primary">
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
                                            <th>No</th>
                                            <th>Shift</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Istirahat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->id }}</td>
                                                <td>Shift A</td>
                                                <td>{{ \Carbon\Carbon::parse($schedule->clock_in)->format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($schedule->clock_out)->format('H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($schedule->break)->format('H:i') }}</td>
                                                <td>
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a
                                                                                href="{{ route('admin.editjadwal', ['id' => $schedule->id]) }}"><em
                                                                                    class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                        </li>
                                                                        <li><a href="#"><em
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

                </div>
            </div>
        </div>
    </div>
@endsection
