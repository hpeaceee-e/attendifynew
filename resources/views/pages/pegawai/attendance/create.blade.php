@extends('layout.pegawai.main')
@section('title')
    Absensi
@endsection
@section('content-pegawai')
    <div class="container">
        <h1>Absen Masuk/Pulang</h1>

        <form action="{{ route('pegawai.store-attendance') }}" method="POST" id="attendanceForm">
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

            <!-- Lokasi absensi -->
            <div class="mt-3">
                <div id="locationStatus" class="alert alert-info">Mendeteksi lokasi Anda...</div>
            </div>

            <!-- Tombol submit absensi -->
            <div class="mt-3" id="submitContainer" style="display: none;">
                <button type="submit" class="btn btn-secondary">Simpan Kehadiran</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.557553, 107.4416366], 18); // Lokasi PT. Pratama Solusi Teknologi
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            // Koordinat untuk menggambar kotak area absensi
            var allowedLatLng = [-6.557553, 107.4416366]; // Koordinat pusat
            var allowedRadius = 30; // Radius 30 meter

            // Hitung sudut-sudut kotak area yang diizinkan (30 meter ke semua sisi)
            var latOffset = allowedRadius / 111320; // 1 derajat latitude = ~111320 meter
            var lngOffset = allowedRadius / (111320 * Math.cos(allowedLatLng[0] * Math.PI / 180)); // Sesuaikan dengan latitude

            var southWest = [allowedLatLng[0] - latOffset, allowedLatLng[1] - lngOffset];
            var northEast = [allowedLatLng[0] + latOffset, allowedLatLng[1] + lngOffset];
            var allowedBounds = L.latLngBounds(southWest, northEast);

            // Gambar kotak area absensi
            var allowedRectangle = L.rectangle(allowedBounds, {
                color: 'green',
                weight: 1,
                fillOpacity: 0.3
            }).addTo(map);

            // Minta izin untuk mengakses lokasi pengguna
            if (navigator.geolocation) {
                map.locate({
                    setView: true,
                    maxZoom: 16,
                    watch: false
                });
            } else {
                alert("Geolokasi tidak didukung oleh browser ini.");
            }

            function onLocationFound(e) {
                var radius = e.accuracy;

                // Cek apakah lokasi pengguna berada dalam area yang diizinkan
                if (allowedBounds.contains(e.latlng)) {
                    // Jika dalam area yang diizinkan
                    L.marker(e.latlng).addTo(map)
                        .bindPopup("Lokasi Anda dalam radius " + radius + " meter.").openPopup();
                    document.getElementById('coordinate').value = e.latlng.lat + "," + e.latlng.lng;

                    // Update status dan tampilkan tombol submit
                    document.getElementById('locationStatus').classList.remove('alert-info');
                    document.getElementById('locationStatus').classList.add('alert-success');
                    document.getElementById('locationStatus').innerText = "Anda berada di lokasi yang diizinkan untuk absen.";
                    document.getElementById('submitContainer').style.display = "block"; // Tampilkan tombol submit
                } else {
                    // Jika di luar area yang diizinkan
                    document.getElementById('locationStatus').classList.remove('alert-info');
                    document.getElementById('locationStatus').classList.add('alert-danger');
                    document.getElementById('locationStatus').innerText = "Anda berada di luar lokasi yang diizinkan untuk absen.";
                    document.getElementById('submitContainer').style.display = "none"; // Sembunyikan tombol submit
                }
            }

            map.on('locationfound', onLocationFound);

            map.on('locationerror', function(e) {
                document.getElementById('locationStatus').classList.remove('alert-info');
                document.getElementById('locationStatus').classList.add('alert-danger');
                document.getElementById('locationStatus').innerText = "Gagal mendapatkan lokasi Anda. Silakan periksa izin lokasi dan coba lagi.";
                alert("Gagal mendapatkan lokasi Anda. Silakan periksa izin lokasi dan coba lagi.");
            });
        });
    </script>
@endsection
