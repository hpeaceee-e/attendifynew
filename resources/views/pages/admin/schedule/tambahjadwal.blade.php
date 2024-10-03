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
                            <div class="nk-block-head-sub">
                                <a class="back-to" href="{{ route('admin.kelolajadwal') }}">
                                    <em class="icon ni ni-chevron-left-circle-fill"></em>
                                    <span>Back</span>
                                </a>
                            </div>
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
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="shift" class="form-label">Shift</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="shift"
                                                            name="shift" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="abbreviation">Singkatan</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" name="abbreviation"
                                                            required>
                                                        @error('abbreviation.*')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="schedule-forms">
                                            <div class="row gy-4 schedule-form">
                                                <div class="col-sm-3 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="day">Nama Hari</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-control" name="day[]" id="" required>
                                                                <option value="Senin">Senin</option>
                                                                <option value="Selasa">Selasa</option>
                                                                <option value="Rabu">Rabu</option>
                                                                <option value="Kamis">Kamis</option>
                                                                <option value="Jumat">Jumat</option>
                                                            </select>
                                                            {{-- <input type="text" class="form-control" name="day[]"
                                                                required> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="clock_in">Jam Masuk</label>
                                                        <div class="form-control-wrap">
                                                            <input type="time" class="form-control" name="clock_in[]"
                                                                required>
                                                            @error('clock_in.*')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="break">Istirahat</label>
                                                        <div class="form-control-wrap">
                                                            <input type="time" class="form-control" name="break[]"
                                                                required>
                                                            @error('break.*')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="clock_out">Jam Pulang</label>
                                                        <div class="form-control-wrap">
                                                            <input type="time" class="form-control" name="clock_out[]"
                                                                required>
                                                            @error('clock_out.*')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" id="add-schedule">+</button>
                                        </div>

                                        <hr class="preview-hr">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secondary">Tambah Jadwal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->

                </div><!-- .components-preview -->
            </div><!-- .nk-content-body -->
        </div><!-- .container-xl -->
    </div><!-- .nk-content -->

    <script>
        document.getElementById('add-schedule').addEventListener('click', function() {
            const scheduleForms = document.getElementById('schedule-forms');
            const newForm = document.createElement('div');
            newForm.classList.add('row', 'gy-4', 'schedule-form');

            newForm.innerHTML = `
                <div class="col-sm-3 mb-3">
                    <div class="form-group">

                        <div class="form-control-wrap">
                            <select class="form-control" name="day[]" id="" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                    </div>
                </div>
               
                <div class="col-sm-3">
                    <div class="form-group">

                        <div class="form-control-wrap">
                            <input type="time" class="form-control" name="clock_in[]" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">

                        <div class="form-control-wrap">
                            <input type="time" class="form-control" name="break[]" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">

                        <div class="form-control-wrap">
                            <input type="time" class="form-control" name="clock_out[]" required>
                        </div>
                    </div>
                </div>
            `;
            scheduleForms.appendChild(newForm);
        });
    </script>
@endsection
