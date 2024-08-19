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
                <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.200000, 106.816666], 13); // Default posisi Jakarta
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            // Mendapatkan lokasi pengguna
            map.locate({
                setView: true,
                maxZoom: 16
            });

            function onLocationFound(e) {
                var radius = e.accuracy;
                L.marker(e.latlng).addTo(map)
                    .bindPopup("Lokasi Anda dalam radius " + radius + " meter.").openPopup();
                document.getElementById('coordinate').value = e.latlng.lat + "," + e.latlng.lng;
            }

            map.on('locationfound', onLocationFound);

            map.on('locationerror', function(e) {
                alert("Gagal mendapatkan lokasi Anda.");
            });
        });
    </script>
@endsection
