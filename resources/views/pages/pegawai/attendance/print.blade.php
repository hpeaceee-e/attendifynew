<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/kehadirangacor.png') }}">
    <title>Print Kehadiran</title>
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            /* Tambahkan ini jika elemen peta melampaui container */
        }


        .invoice-brand {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-brand img {
            max-width: 150px;
        }

        .invoice-head {
            margin-bottom: 20px;
        }

        .invoice-head .invoice-contact {
            margin-bottom: 10px;
        }

        .invoice-head .invoice-contact-info h4,
        .invoice-head .invoice-desc h3 {
            margin: 0;
            color: #333;
        }

        .invoice-head .invoice-contact-info ul,
        .invoice-head .invoice-desc ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .invoice-head .invoice-contact-info ul li,
        .invoice-head .invoice-desc ul li {
            margin-bottom: 5px;
        }

        .invoice-head .invoice-contact-info ul li em,
        .invoice-head .invoice-desc ul li em {
            color: #555;
            font-size: 18px;
            margin-right: 10px;
        }

        .invoice-bills {
            margin-top: 20px;
        }

        .invoice-bills table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-bills table th,
        .invoice-bills table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-bills table th {
            background-color: #f4f4f4;
        }

        .invoice-bills table tfoot td {
            font-weight: bold;
        }

        .invoice-bills table tfoot tr:last-child td {
            border-top: 2px solid #ddd;
        }

        #mapPrint {
            height: 300px;
            width: 100%;
            margin-top: 20px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }


        @media print {
            .container {
                page-break-inside: avoid;
                border: none;
            }

            .leaflet-pane,
            .leaflet-tile,
            .leaflet-marker-icon,
            .leaflet-popup,
            .leaflet-control {
                visibility: visible !important;
                opacity: 1 !important;
            }

            .leaflet-container {
                height: 300px !important;
                /* atau sesuaikan dengan kebutuhan */
            }

            .leaflet-tile-container {
                filter: none !important;
                /* Pastikan tiles tidak di-filter dalam mode cetak */
            }

            #mapPrint {
                height: 300px;
                width: 100%;
                border: none;
                display: block !important;
            }

            .btn {
                display: none;
            }
        }
    </style>
</head>

<body onload="printPromot()">
    <div class="container">
        <div class="invoice-brand text-center">
            <img src="{{ asset('demo5/src/images/logo-dark.png') }}"
                srcset="{{ asset('demo5/src/images/logo-dark2x.png 2x') }}" alt="Logo">
        </div>
        <div class="invoice-head">
            <div class="invoice-contact">
                <span class="overline-title">Detail Kehadiran</span>
                <div class="invoice-contact-info">
                    <h4 class="title">Pegawai: {{ $name }}</h4>
                    <br>
                    <ul class="list-plain">
                        <li><em class="icon ni ni-calendar-fill fs-18px"></em><span>Tanggal:
                                {{ $attendance->date }}</span></li>
                        <li><em class="icon ni ni-clock-fill fs-14px"></em><span>Waktu: {{ $attendance->time }}</span>
                        </li>
                        <li><em class="icon ni ni-check-circle-fill fs-14px"></em><span>Status:
                                {{ $attendance->status == 0 ? 'Masuk' : 'Pulang' }}</span></li>
                        <li><em class="icon ni ni-map-pin-fill fs-14px"></em><span>Koordinat:
                                {{ $attendance->coordinate }}</span></li>
                    </ul>
                </div>
            </div>
        </div><!-- .invoice-head -->
        <div id="mapPrint"></div>
    </div><!-- .container -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map; // Deklarasi map di luar fungsi

        document.addEventListener('DOMContentLoaded', function() {
            var latitude = {{ $latitude }};
            var longitude = {{ $longitude }};

            if (latitude && longitude) {
                // Inisialisasi peta
                map = L.map('mapPrint').setView([latitude, longitude], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 15,
                }).addTo(map);
                L.marker([latitude, longitude]).addTo(map);

                // Memastikan peta di-render ulang setelah tiles dimuat
                map.on('tileload', function() {
                    map.invalidateSize();
                });
            } else {
                document.getElementById('mapPrint').innerText = "Koordinat tidak tersedia.";
            }
        });

        function printPromot() {
            // Tunggu sebentar hingga peta selesai dimuat, lalu cetak
            setTimeout(function() {
                if (map) {
                    map.invalidateSize(); // Memvalidasi ulang ukuran peta
                }
                window.print();
            }, 1500); // Penundaan 1.5 detik untuk memastikan peta dimuat
        }
    </script>


</body>

</html>
