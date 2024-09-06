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
                                                <h6 class="title">Jangan Lupa Untuk Absensi</h6>
                                            </div>
                                        </div>
                                        <div class="user-activity-group g-4">
                                            <div class="user-activity">
                                                <em class="icon ni ni-calendar-check"></em>
                                                <div class="info">
                                                    <a href="{{ route('pegawai.attendance') }}"
                                                        class="btn btn-secondary">Absensi</a>
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

                        </div><!-- .row -->

                        <!-- Section: Calendar -->


                    </div><!-- .nk-content-inner -->
                </div><!-- .nk-content -->
            </div><!-- .container-xl -->
        </div><!-- .nk-content-fluid -->
    </div><!-- .nk-content -->
@endsection
