@extends('layout.pegawai.main')
@section('title')
    Absensi
@endsection
@section('content-pegawai')
    <div class="container">
        <h1>Absen Masuk/Pulang</h1>

        <!-- Alert untuk diluar area yang diizinkan -->
        <div id="outOfAreaAlert" class="alert alert-pro alert-danger" style="display: none;">
            <div class="alert-text">
                <h6>Diluar Area yang Diizinkan</h6>
                <p>Anda berada di luar lokasi yang diizinkan untuk absen</p>
            </div>
        </div>

        <!-- Alert untuk dalam area yang diizinkan -->
        <div id="inAreaAlert" class="alert alert-pro alert-success" style="display: none;">
            <div class="alert-text">
                <h6>Lokasi Ditemukan</h6>
                <p>Anda berada di lokasi yang diizinkan untuk absen.</p>
            </div>
        </div>

        <!-- Alert untuk gagal mendapatkan lokasi -->
        <div id="locationErrorAlert" class="alert alert-pro alert-danger" style="display: none;">
            <div class="alert-text">
                <h6>Gagal mendapatkan lokasi</h6>
                <p>Silakan periksa izin lokasi dan coba lagi.</p>
            </div>
        </div>

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

            <!-- Tombol submit absensi -->
            <div class="mt-3" id="submitContainer" style="display: none;">
                <button type="submit" class="btn btn-secondary">Simpan Kehadiran</button>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.557553, 107.4416366], 18); // Lokasi PT. Pratama Solusi Teknologi
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            var allowedLatLng = [-6.557553, 107.4416366]; // Koordinat pusat PT Pratama Solusi Teknologi
            var allowedRadius = 30; // Radius 30 meter

            // Tambahkan lingkaran dengan radius yang lebih besar untuk tes
            var allowedCircle = L.circle(allowedLatLng, {
                color: '#32cd32', // Warna hijau
                fillColor: '#32cd32',
                fillOpacity: 0.5, // Lebih transparan untuk melihat detail peta di bawahnya
                radius: 100 // Ubah radius untuk memastikan lingkaran muncul
            }).addTo(map);

            // Lingkaran di luar area yang diizinkan (untuk menunjukkan batas luar)
            // var outsideCircle = L.circle(allowedLatLng, {
            //     color: 'red',
            //     fillColor: 'red', // Warna merah solid tanpa transparansi
            //     fillOpacity: 1, // Tidak transparan
            //     radius: allowedRadius * 2 // Radius lebih besar dari yang diizinkan
            // }).addTo(map);

            // Hitung batas koordinat berdasarkan radius
            var latOffset = allowedRadius / 111320;
            var lngOffset = allowedRadius / (111320 * Math.cos(allowedLatLng[0] * Math.PI / 180));

            var southWest = [allowedLatLng[0] - latOffset, allowedLatLng[1] - lngOffset];
            var northEast = [allowedLatLng[0] + latOffset, allowedLatLng[1] + lngOffset];
            var allowedBounds = L.latLngBounds(southWest, northEast);


            if (navigator.geolocation) {
                Swal.fire({
                    icon: 'info',
                    title: 'Mendeteksi lokasi Anda...',
                    text: 'Silakan tunggu beberapa saat.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                map.locate({
                    setView: true,
                    maxZoom: 16,
                    watch: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Geolokasi tidak didukung oleh browser ini.'
                });
            }

            function onLocationFound(e) {
                var radius = e.accuracy;

                // Cek apakah pengguna berada dalam area yang diizinkan
                if (allowedCircle.getBounds().contains(e.latlng)) {
                    L.marker(e.latlng).addTo(map)
                        .bindPopup("Lokasi Anda dalam radius " + radius + " meter.").openPopup();
                    document.getElementById('coordinate').value = e.latlng.lat + "," + e.latlng.lng;

                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Lokasi Ditemukan',
                        text: 'Anda berada di lokasi yang diizinkan untuk absen.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Sembunyikan alert gagal dan tampilkan alert berhasil
                    document.getElementById('outOfAreaAlert').style.display = "none";
                    document.getElementById('inAreaAlert').style.display = "block";

                    document.getElementById('submitContainer').style.display = "block";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Diluar Area yang Diizinkan',
                        text: 'Anda berada di luar lokasi yang diizinkan untuk absen.',
                        confirmButtonColor: '#2c3e50',
                    });

                    // Sembunyikan alert berhasil dan tampilkan alert gagal
                    document.getElementById('inAreaAlert').style.display = "none";
                    document.getElementById('outOfAreaAlert').style.display = "block";

                    document.getElementById('submitContainer').style.display = "none";
                }
            }

            map.on('locationfound', onLocationFound);

            map.on('locationerror', function(e) {
                // Tampilkan alert gagal mendapatkan lokasi
                document.getElementById('locationErrorAlert').style.display = 'block';

                // Sembunyikan tombol submit absensi jika lokasi gagal ditemukan
                document.getElementById('submitContainer').style.display = "none";

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mendapatkan lokasi',
                    text: 'Silakan periksa izin lokasi dan coba lagi.',
                    confirmButtonColor: '#2c3e50',
                });
            });
        });
    </script>
@endsection
