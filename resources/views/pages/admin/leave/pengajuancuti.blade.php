@extends('layout.main')
@section('title')
    Kelola Cuti dan Izin
@endsection
@section('content')
    <div class="container">
        <h1>Konfirmasi Cuti</h1>

        <form action="{{ route('admin.store-cuti') }}" method="POST">
            @csrf

            {{-- <!-- Menyimpan ID pengajuan cuti -->
            <input type="hidden" name="id" value="{{ $item->id }}"> --}}


            <!-- Tombol untuk memilih status pengajuan cuti -->
            <div class="form-group">
                <label for="status">Status Pengajuan Cuti</label>
                <select name="status" id="status" class="form-control" onchange="toggleReasonField()" required>
                    <option value="" disabled selected>Diterima/Ditolak</option>
                    <option value="0">Diterima</option>
                    <option value="1">Ditolak</option>
                </select>
            </div>

            <!-- Input Alasan, hanya muncul ketika status ditolak -->
            <div class="form-group" id="reason-group" style="display: none;">
                <label for="reason">Alasan Penolakan</label>
                <input type="text" name="reason" id="reason" class="form-control form-control-lg"
                    placeholder="Masukkan alasan penolakan">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan Persetujuan</button>
            </div>
        </form>
    </div>

    <script>
        function toggleReasonField() {
            var status = document.getElementById('status').value;
            var reasonGroup = document.getElementById('reason-group');
            var reasonInput = document.getElementById('reason');

            if (status == '1') { // 1 untuk 'Ditolak'
                reasonGroup.style.display = 'block';
                reasonInput.required = true;
            } else {
                reasonGroup.style.display = 'none';
                reasonInput.required = false;
            }
        }
    </script>
@endsection
