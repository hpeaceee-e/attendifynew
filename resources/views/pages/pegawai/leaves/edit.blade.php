@extends('layout.pegawai.main')
@section('title')
    Edit Cuti
@endsection
@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub">
                                <a class="back-to" href="{{ route('pegawai.leaves') }}">
                                    <em class="icon ni ni-chevron-left-circle-fill"></em><span>Back</span>
                                </a>
                            </div>
                            <h3 class="nk-block-title page-title">Edit Cuti</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                <div class="nk-block">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <form action="{{ route('pegawai.update-cuti', ['id' => $leave->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Form Edit Cuti</span>
                                    <div class="row gy-4">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="kategori">Kategori Cuti</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="kategori" name="category" disabled>
                                                        <option value="annual"
                                                            {{ $leave->category == 'annual' ? 'selected' : '' }}>Cuti
                                                            Tahunan</option>
                                                        <option value="other"
                                                            {{ $leave->category == 'other' ? 'selected' : '' }}>Cuti
                                                            Lain-lain</option>
                                                    </select>
                                                    <!-- Hidden input untuk mengirim nilai kategori -->
                                                    <input type="hidden" name="category" value="{{ $leave->category }}">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form untuk Cuti Lain-lain -->
                                        <div id="form-lain" style="display: none;">
                                            @if ($leave->category == 'other')
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="subkategori">Subkategori</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-control" id="subkategori" name="subcategory"
                                                                disabled>
                                                                <option value="sick"
                                                                    {{ $leave->subcategory == 'sick' ? 'selected' : '' }}>
                                                                    Sakit</option>
                                                                <option value="married"
                                                                    {{ $leave->subcategory == 'married' ? 'selected' : '' }}>
                                                                    Menikah</option>
                                                                <option value="important_reason"
                                                                    {{ $leave->subcategory == 'important_reason' ? 'selected' : '' }}>
                                                                    Beralasan Penting</option>
                                                                <option value="pilgrimage"
                                                                    {{ $leave->subcategory == 'pilgrimage' ? 'selected' : '' }}>
                                                                    Ibadah Haji</option>
                                                            </select>
                                                            <!-- Hidden input untuk mengirim nilai subkategori -->
                                                            <input type="hidden" name="subcategory"
                                                                value="{{ $leave->subcategory }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <br>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="leave_letter">Surat Cuti</label>
                                                    <div class="form-control-wrap">
                                                        <input type="file" class="form-control" id="leave_letter"
                                                            name="leave_letter">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Field Alasan Cuti (Ditampilkan pada kedua kategori) -->
                                        <div id="form-alasan">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="reason">Alasan Cuti</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="reason"
                                                            name="reason" value="{{ $leave->reason }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form untuk Mulai dan Berakhir -->
                                        <div id="form-tanggal">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Mulai Cuti</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-calendar-alt"></em>
                                                            </div>
                                                            <input type="text" data-date-format="dd M yyyy"
                                                                class="form-control date-picker" id="date"
                                                                name="date"
                                                                value="{{ \Carbon\Carbon::parse($leave->date)->format('d M Y') }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Berakhir Cuti</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-calendar-alt"></em>
                                                            </div>
                                                            <input type="text" data-date-format="dd M yyyy"
                                                                class="form-control date-picker" id="end_date"
                                                                name="end_date"
                                                                value="{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="preview-hr">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary">Update Cuti</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen-elemen form
            var kategoriSelect = document.getElementById('kategori');
            var formAlasan = document.getElementById('form-alasan');
            var formLain = document.getElementById('form-lain');
            var formTanggal = document.getElementById('form-tanggal');

            // Menampilkan form berdasarkan pilihan kategori
            function toggleForm() {
                var kategori = kategoriSelect.value;
                if (kategori === 'annual') {
                    formAlasan.style.display = 'block';
                    formLain.style.display = 'none';
                    formTanggal.style.display = 'block';
                } else if (kategori === 'other') {
                    formAlasan.style.display = 'block';
                    formLain.style.display = 'block';
                    formTanggal.style.display = 'block';
                } else {
                    formAlasan.style.display = 'none';
                    formLain.style.display = 'none';
                    formTanggal.style.display = 'none';
                }
            }

            // Panggil fungsi toggleForm saat halaman dimuat
            toggleForm();

            // Tambahkan event listener untuk memantau perubahan pada select kategori
            kategoriSelect.addEventListener('change', toggleForm);
        });
    </script>
@endsection
