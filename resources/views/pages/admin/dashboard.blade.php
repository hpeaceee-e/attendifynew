@extends('layout.main')
@section('title')
    Dashboard Admin
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                {{-- UNTUK MENAMPILKAN BAHWA DISINI SUDAH LOGIN TAMPILAN ADMIN --}}
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Total Pegawai</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-users"></em>
                                            <div class="info">
                                                <span class="amount">{{ count($data) }}</span>
                                                <span class="title">Direct Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                        <div class="col-xl-4 col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Total Cuti dan Izin</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-calendar-alt"></em>
                                            <div class="info">
                                                <span class="amount">{{ count($cuti) }}</span>
                                                <span class="title">Pegawai yang melakukan Cuti/Izin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                        <div class="col-xl-4 col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Total Hadir & Terlambat</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-check-circle"></em>
                                            <div class="info">
                                                <span class="amount">
                                                    {{-- {{ $hadir }} --}}1
                                                </span>
                                                <span class="title">Total Hadir</span>
                                            </div>
                                        </div>
                                        <div class="user-activity">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <div class="info">
                                                <span class="amount">
                                                    {{-- {{ $terlambat }} --}}2
                                                </span>
                                                <span class="title">Total Terlambat</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                        <div class="col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Daftar Pegawai Terlambat [Hari Ini]</h6>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($terlambat as $index => $pegawai) --}}
                                                @foreach ($telat as $tel)
                                                    
                                                <tr>
                                                    <td>{{$loop->iteration
                                                    }}</td>
                                                    <td>{{$tel->time}}</td>
                                                    <td>
                                                        @php
                                                            $name = \App\Models\User::where('id', $tel->enhancer)->value('name');
                                                        @endphp
                                                        {{$name}}</td>
                                                    <td><span class="badge bg-danger">Absen Terlambat</span></td>
                                                </tr>
                                                @endforeach

                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                        <div class="col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Daftar Pegawai Hadir [Hari Ini]</h6>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Waktu Datang</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($hadir as $index => $pegawai) --}}
                                                    @foreach ($tepat as $tel)
                                                    
                                                <tr>
                                                    <td>{{$loop->iteration
                                                    }}</td>
                                                    <td>{{$tel->time}}</td>
                                                    <td>
                                                        @php
                                                            $name = \App\Models\User::where('id', $tel->enhancer)->value('name');
                                                        @endphp
                                                        {{$name}}</td>
                                                    <td><span class="badge bg-success">Sudah Absen</span></td>
                                                </tr>
                                                @endforeach
                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
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
@endsection
