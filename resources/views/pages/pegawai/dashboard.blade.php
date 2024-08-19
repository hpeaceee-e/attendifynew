@extends('layout.pegawai.main')
@section('title')
    Dashboard User
@endsection
@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                {{-- UNTUK MENAMPILKAN BAHWA DISINI SUDAH LOGIN TAMPILAN ADMIN --}}
                DASHBOARD USER
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
                                            <h6 class="title">Total Izin</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-users"></em>
                                            <div class="info">
                                                <span class="amount">345</span>
                                                <span class="title">Direct Join</span>
                                            </div>
                                        </div>
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
