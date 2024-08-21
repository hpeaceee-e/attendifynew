@extends('layout.main')
@section('title')
    Kelola Cuti dan Izin
@endsection
@section('content')
    <div class="container">
        <h1>Absen Masuk/Pulang</h1>

        <form action="{{ route('pegawai.store-attendance') }}" method="POST">
            @csrf

            <!-- Tombol untuk memilih status kehadiran -->
            <div class="form-group">
                <label for="status">Pengajuan Cuti</label>
                <select name="status" id="status" class="form-control" onchange="toggleReasonField()">
                    <option value="0">Diterima</option>
                    <option value="1">Ditolak</option>
                </select>
            </div>

            <!-- Input Reason, hanya muncul ketika status diterima -->
            <div class="form-group" id="reason-group" style="display: none;">
                <label for="reason">Alasan</label>
                <input type="text" name="reason" id="reason" class="form-control form-control-lg"
                    placeholder="Masukkan alasan">
            </div>

            <!-- Map -->
            {{-- <div id="map" style="height: 400px;"></div>
            <input type="hidden" name="coordinate" id="coordinate"> --}}

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>
            </div>
        </form>
    </div>

    <script>
        function toggleReasonField() {
            var status = document.getElementById('status').value;
            var reasonGroup = document.getElementById('reason-group');
            if (status == '1') { // 1 for 'Ditolak'
                reasonGroup.style.display = 'block';
            } else {
                reasonGroup.style.display = 'none';
            }
        }
    </script>
@endsection
