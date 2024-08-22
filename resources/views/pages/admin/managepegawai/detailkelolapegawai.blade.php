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
                                <em class="icon ni ni-chevron-left-circle-fill"></em><span>Back</span>
                            </a>
                        </div>
                        <h2 class="nk-block-title fw-normal">Detail Pegawai </h2>
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
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" class="form-control" value="{{ $data->username }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Hak Akses</label>
                                                    <input type="text" class="form-control" value="{{ $data->role }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Perangkat Seluler</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->telephone }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Status Akun</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->status == 0 ? 'Aktif' : 'Tidak Aktif' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Dibuat</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->created_at->format('d M Y') }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jadwal</label>
                                                    <input type="text" class="form-control" value="{{ $data->schedule }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" value="{{ $data->city }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->birthday }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" value="{{ $data->gender }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Agama</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->religion }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat</label>
                                                    {{-- <input type="text" class="form-control" value="{{ $data->address }}"
                                                        readonly> --}}
                                                    <textarea name="address" class="form-control" id="address" cols="30" value="{{ $data->address }}" rows="10"
                                                        placeholder="Aalamat" readonly></textarea>
                                                </div>
                                            </div>

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
