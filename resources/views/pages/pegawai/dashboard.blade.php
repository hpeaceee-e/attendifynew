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
                        <div class="row g-gs">

                            <!-- Card: Absensi -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Selamat Datang</h6>
                                            </div>
                                        </div>
                                        <div class="user-activity-group g-4">
                                            <div class="user-activity">
                                                <div class="info">
                                                    <span class="amount"> {{ auth()->user()->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->

                            <!-- Card: Total Pegawai -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Saldo Cuti Anda</h6>
                                            </div>
                                        </div>
                                        <div class="user-activity-group g-4">
                                            <div class="user-activity">
                                                <em class="icon ni ni-growth"></em>
                                                <div class="info">
                                                    <span class="amount">{{ count($data) }}</span>
                                                    <span class="title">Gunakan Sebaik - baiknya</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->

                            <!-- Card: Jabatan -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Jabatan Anda</h6>
                                            </div>
                                        </div>
                                        <div class="user-activity-group g-4">
                                            <div class="user-activity">
                                                <em class="icon ni ni-user"></em>
                                                <div class="info">
                                                    <span class="amount">Web Developer</span>
                                                    <span class="title"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-md-4">
                                <div class="card card-bordered card-full bg-secondary">
                                    <div class="card-inner">
                                        <div class="row">
                                            <!-- Left section: Welcome message and attendance button -->
                                            <div class="col-6 d-flex flex-column justify-content-center">
                                                <div class="card-title-group align-start mb-3">
                                                    <div class="card-title">
                                                        <h6 class="title text-white">Selamat Datang di Sistem Kehadiran
                                                            Pegawai</h6>
                                                    </div>
                                                </div>
                                                <div class="user-activity-group g-4">
                                                    <div class="user-activity">
                                                        <div class="info">
                                                            <a href="{{ route('pegawai.attendance') }}"
                                                                class="btn btn-light">Absensi</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->

                                            <!-- Right section: Display image -->
                                            <div class="col-6 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('demo5/src/images/background/attendance5.png') }}"
                                                    alt="Attendance Image" class="img-fluid" style="max-width: 100%;">
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card -->
                            </div><!-- .col -->


                            <div class="col-md-8">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Pengumuman</h6>
                                            </div>
                                        </div>
                                        <div class="user-activity-group g-4">
                                            <div class="user-activity">
                                                <div class="info">
                                                    <span class="tittle">Selamat anda menjadi bagian dari perusahaan Kami,
                                                        Mohon atas kerja sama nya</span>
                                                    <span class="title">Dimohon ketika memasuki Kantor absen terlebih
                                                        dahulu dan Gunakan Cuti dengan sebaik baiknya, disaat genting
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .col -->
                        </div><!-- .row -->

                        <!-- Section: Calendar -->
                    </div><!-- .nk-content-inner -->
                </div><!-- .nk-content -->
            </div><!-- .container-xl -->
        </div><!-- .nk-content-fluid -->
    </div><!-- .nk-content -->
@endsection
