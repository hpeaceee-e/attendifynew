<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Kehadiran</title>
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                padding: 20px;
            }
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Kehadiran</h1>
        <p><strong>Tanggal:</strong> {{ $attendance->date }}</p>
        <p><strong>Waktu:</strong> {{ $attendance->time }}</p>
        <p><strong>Status:</strong> {{ $attendance->status == 0 ? 'Masuk' : 'Pulang' }}</p>
        <p><strong>Koordinat:</strong> {{ $attendance->coordinate }}</p>
        
        <!-- Tambahkan Peta jika diperlukan -->
        <div id="mapPrint" style="height: 300px;"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var latitude = {{ $latitude }};
            var longitude = {{ $longitude }};
            
            if (latitude && longitude) {
                var map = L.map('mapPrint').setView([latitude, longitude], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                }).addTo(map);
                L.marker([latitude, longitude]).addTo(map);
            } else {
                document.getElementById('mapPrint').innerText = "Koordinat tidak tersedia.";
            }
        });
    </script>
</body>
</html>
