@extends('layout.main')
@section('title')
    Jadwal Pegawai
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="{{ route('admin.kelolajadwal') }}"><em
                                        class="icon ni ni-chevron-left-circle-fill"></em><span>Back</span></a></div>
                            <h2 class="nk-block-title fw-normal">Tambah Jadwal Pegawai</h2>
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <form action="{{ route('admin.tambahjadwalstore') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="preview-block">
                                        <span class="preview-title-lg overline-title">Tambah Jadwal Pegawai</span>
                                        <div class="row gy-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="break">Shift</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="shift"
                                                            name="shift" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="clock_in">Jam Masuk</label>
                                                    <div class="form-control-wrap">
                                                        <input type="time" class="form-control" id="clock_in"
                                                            name="clock_in" required>
                                                        @error('clock_in')
                                                            <small>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="clock_out">Jam Pulang</label>
                                                    <div class="form-control-wrap">
                                                        <input type="time" class="form-control" id="clock_out"
                                                            name="clock_out" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="break">Istirahat</label>
                                                    <div class="form-control-wrap">
                                                        <input type="time" class="form-control" id="break"
                                                            name="break" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .code-block -->
                </div><!-- .nk-block -->
            </div><!-- .nk-content-body -->
        </div><!-- .container-xl -->
    </div><!-- .nk-content -->
@endsection
