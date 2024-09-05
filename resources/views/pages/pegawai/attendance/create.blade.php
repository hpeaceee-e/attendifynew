@extends('layout.pegawai.main')
@section('title')
    Absensi
@endsection
@section('content-pegawai')
    <div class="container">
        <h1>Absen Masuk/Pulang</h1>

        <form action="{{ route('pegawai.store-attendance') }}" method="POST">
            @csrf

            <!-- Tombol untuk memilih status kehadiran -->
            <div class="form-group">
                <label for="status">Status Kehadiran</label>
                <select name="status" id="status" class="form-control">
                    <option value="0">Masuk</option>
                    <option value="1">Pulang</option>
                </select>
            </div>

            <!-- Map -->
            <div id="map" style="height: 400px;"></div>
            <input type="hidden" name="coordinate" id="coordinate">

            <div class="mt-3">
                <button type="submit" class="btn btn-secondary">Simpan Kehadiran</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.200000, 106.816666], 13); // Default ke Jakarta
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            // Mencoba untuk mendapatkan lokasi pengguna
            map.locate({
                setView: true,
                maxZoom: 16,
                watch: false // Menonaktifkan pelacakan berkelanjutan untuk akurasi yang lebih baik di awal
            });

            // Saat lokasi ditemukan
            function onLocationFound(e) {
                var radius = e.accuracy;
                L.marker(e.latlng).addTo(map)
                    .bindPopup("Lokasi Anda dalam radius " + radius + " meter.").openPopup();
                document.getElementById('coordinate').value = e.latlng.lat + "," + e.latlng.lng;
            }

            // Tambahkan handler untuk lokasi ditemukan
            map.on('locationfound', onLocationFound);

            // Jika terjadi kesalahan dalam mendapatkan lokasi
            map.on('locationerror', function(e) {
                alert("Gagal mendapatkan lokasi Anda. Silakan periksa izin lokasi dan coba lagi.");
            });
        });
    </script>
@endsection
