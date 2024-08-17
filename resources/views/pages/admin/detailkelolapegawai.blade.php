@extends('layout.main')
@section('title')
    Detail Pegawai
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-sub">
                            <a class="back-to" href="{{ route('admin.kelolapegawai') }}">
                                <em class="icon ni ni-arrow-left"></em><span>Back</span>
                            </a>
                        </div>
                        <h2 class="nk-block-title fw-normal">Detail Pegawai</h2>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview shadow-sm">
                            <div class="card-inner">
                                <div class="row">
                                    <!-- Kiri: Informasi Personal -->
                                    <div class="col-md-4">
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('storage/' . $data->avatar) }}" alt="Avatar"
                                                class="img-fluid rounded-circle shadow-sm" style="max-width: 150px;">
                                            <h5 class="mt-3">{{ $data->name }}</h5>
                                            <p class="text-muted">{{ $data->email }}</p>
                                        </div>
                                    </div>

                                    <!-- Kanan: Detail Informasi -->
                                    <div class="col-md-8">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="basic-info">

                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Username</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->username }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Role/Hak Akses</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->role }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->status == 0 ? 'Aktif' : 'Tidak Aktif' }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Tanggal Dibuat</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->created_at->format('d M Y') }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Jadwal</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $data->schedule }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Other tabs can be added here -->
                                        </div>
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
