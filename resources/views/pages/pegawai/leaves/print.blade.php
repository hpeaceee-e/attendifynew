<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>
        Surat Cuti
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 0;
            padding: 0;
        }

        .content {
            margin: 20px;
        }

        .content p {
            margin: 5px 0;
        }

        .content .detail {
            display: flex;
            justify-content: space-between;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .employee-info {
            margin-top: 20px;
            margin-left: 20px;
        }

        .employee-info p {
            margin: 5px 0;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 20mm;
            }

            body {
                width: 100%;
            }
        }
    </style>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
</head>

<body class="bg-white" onload="printPromot()">
    <div class="header">
        <h2>PEMERINTAH PROVINSI KONOHA TIMUR</h2>
        <h3>BADAN PENDAPATAN DAERAH</h3>
        <h3>UPTB PENGELOLAAN PENDAPATAN DAERAH</h3>
        <h3>WILAYAH HOKAGE SELATAN</h3>
        <p>JL. NARUTO. KAYUBI HIYUKUMURA</p>
        <p>TELP. (+260) - 411121212 KONOHA</p>
        <hr>
    </div>

    <div class="content">
        <div class="detail">
            <p>Nomor: 020/30/Penda/2020</p>
            <p>Konoha, 05 Februari 2024</p>
        </div>
        <div class="detail">
            <p>Lampiran: 1 (satu) lembar</p>
        </div>
        <p>Perihal: <strong>cuti menikahi iyukui</strong></p>

        <p>Kepada</p>
        <p>Yth. Kepala UPTB Pengelolaan Pendapatan</p>
        <p>Daerah Provinsi Hokage Selatan</p>
        <p>Wilayah Kota Konoha Timur</p>
        <p>Di-</p>

        <p>Bersama ini diteruskan usul Cuti Karena Alasan Penting pegawai Kasi Pendataan pegawai Penagihan Provinsi
            Konoha Timur Wilayah Kota Hokage Barat, atas nama saudara: </p>

        <div class="employee-info">
            <p>Nama: kasep pegawai 1</p>
            <p>NIP: 1213231232123213</p>
            <p>Jabatan: staf</p>
        </div>

        <p>Dengan ini saya mengajukan Permohonan Cuti Karena Alasan Penting selama 2 hari kerja, yaitu terhitung mulai
            tanggal 2024-02-05 s.d 2024-02-07 yang akan dipergunakan untuk cuti menikah.</p>

        <p>Demikian permohonan ini saya ajukan, atas pertimbangan dan perhatian Bapak diucapkan terima kasih.</p>

        <div class="signature">
            <p>(Nama Pegawai)</p>
        </div>
    </div>
    <script>
        function printPromot() {
            window.print();
        }
    </script>
</body>

</html>
