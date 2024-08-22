@extends('layout.pegawai.main')
@section('title')
    Informasi Akun
@endsection
@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-sub">
                            <a class="back-to" href="{{ route('pegawai.pages.pegawai.dashboard') }}">
                                <em class="icon ni ni-chevron-left-circle-fill"></em><span>Back</span>
                            </a>
                        </div>
                        <h2 class="nk-block-title fw-normal"></h2>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview shadow-sm">
                            <div class="card-inner">
                                <div class="row">

                                    <!-- Kiri: Informasi Personal -->
                                    <div class="col-md-4">
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('storage/') }}" alt="Avatar"
                                                class="img-fluid rounded-circle shadow-sm" style="max-width: 150px;">
                                            <h5 class="mt-3">Faldi Reza</h5>
                                            <p class="text-muted">faldi@polsub</p>
                                        </div>
                                    </div>

                                    <!-- Kanan: Detail Informasi -->
                                    <div class="col-md-8">
                                        <!-- Tab Navigation -->
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab"
                                                    href="{{ route('pegawai.profilakun') }}">
                                                    Akun
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab"
                                                    href="{{ route('pegawai.profilbiodata') }}">Biodata</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab"
                                                    href="{{ route('pegawai.profilidentitas') }}">Identitas</a>
                                            </li>
                                            <!-- Add other tabs as necessary -->
                                        </ul>

                                        <div class="tab-content">
                                            <!-- Akun Tab -->
                                            <div class="tab-pane fade show active" id="account-info">
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Username</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Hak Akses</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Perangkat Seluler</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Status Akun</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Tanggal Dibuat</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Jadwal</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Biodata Tab -->
                                            <div class="tab-pane fade" id="biodata-info">
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Tempat Lahir</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Tanggal Lahir</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Jenis Kelamin</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Agama</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Identitas Tab -->
                                            <div class="tab-pane fade" id="identity-info">
                                                <div class="row gy-4">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Alamat</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Jabatan</label>
                                                            <input type="text" class="form-control" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Other tabs can be added here -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div><!-- .nk-content-body -->
        </div><!-- .container-xl -->
    </div><!-- .nk-content -->
@endsection
