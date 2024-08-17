@extends('layout.main')
@section('title')
    Kelola Kehadiran Pegawai
@endsection
@section('content')
    {{-- <div class="card card-bordered w-100">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509374!2d144.95373631531625!3d-37.81720997975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce6e0!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2sid!4v1623117382748!5m2!1sen!2sid"
            class="google-map border-0" allowfullscreen="" loading="lazy"></iframe>
    </div> --}}
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
                                        <li><a href="#" class="btn btn-white btn-outline-light"><em
                                                    class="icon ni ni-download"></em><span>Cetak</span></a></li>
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
                                        <th>Waktu Masuk</th>
                                        <th>Waktu Keluar</th>
                                        <th>Kehadiran</th>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendance->enhancer }}</td>
                                            <td>{{ $attendance->date }}</td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($attendance->time)->format('H:i') }}</td> --}}
                                            <td>{{ $attendance->status }}</td>
                                            <td>{{ $attendance->status }}</td>

                                            <td><span class="badge bg-success">Tepat Waktu</span><span
                                                    class="badge bg-danger">Terlambat</span></td>
                                            <td>{{ $attendance->coordinate }} (dijadikan link saja nanti)</td>
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
                                                                    <li><a href="#"><em
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
                                                {{-- <div class="nk-block-head-content d-flex">
                                                    <a class="link link-primary" data-bs-toggle="modal"
                                                        href="#addEventPopup"><em class="icon ni ni-plus"></em> <span>Add
                                                            Event</span></a>
                                                </div><!-- .nk-block-head-content --> --}}
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
@endsection
