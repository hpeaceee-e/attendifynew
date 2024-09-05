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
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a></div>
                            <h2 class="nk-block-title fw-normal">Edit Jadwal Pegawai</h2>
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <form action="{{ route('admin.updatejadwal', ['id' => $schedules->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="preview-block">
                                        <span class="preview-title-lg overline-title">Edit Jadwal Pegawai</span>
                                        <div class="row gy-4">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="clock_in">Jam Masuk</label>
                                                    <div class="form-control-wrap">
                                                        <input type="time" class="form-control" id="clock_in"
                                                            name="clock_in"
                                                            value="{{ \Carbon\Carbon::parse($schedules->clock_in)->format('H:i') }}">
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
                                                            name="clock_out"
                                                            value="{{ \Carbon\Carbon::parse($schedules->clock_out)->format('H:i') }}"
                                                            required>
                                                        @error('clock_out')
                                                            <small>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="break">Istirahat</label>
                                                    <div class="form-control-wrap">
                                                        <input type="time" class="form-control" id="break"
                                                            name="break"
                                                            value="{{ \Carbon\Carbon::parse($schedules->break)->format('H:i') }}"
                                                            required>
                                                        @error('break')
                                                            <small>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secondary">Update Jadwal</button>
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
