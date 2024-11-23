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
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/logo-shorcut-kehadiran.png') }}">
    <!-- Page Title  -->
    <title>
        Cetak Rekapitulasi Pegawai
    </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
</head>

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('demo5/src/images/kehadiranmantap.png') }}"
                        srcset="{{ asset('demo5/src/images/kehadiranmantap.png') }}" alt="">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Report</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">Rekapitulasi Kehadiran Pegawai</h4>
                        </div>
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="datatable-init table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama Pegawai</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                    <th>Lebih Awal</th>
                                    <th>Terlambat</th>
                                    <th>Tidak Masuk</th>
                                    <th>Cuti</th>
                                    <th>Sanksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example rows, hardcoded -->
                                <tr>
                                    <td>1</td>
                                    <td>Hafizh Alfaris</td>
                                    <td>20</td>
                                    <td>20</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>0</td>
                                    <td>3</td>
                                    <td><span class="badge bg-success">Aman</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ali Rahman</td>
                                    <td>18</td>
                                    <td>18</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td><span class="badge bg-success">Aman</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Siti Nurhayati</td>
                                    <td>16</td>
                                    <td>16</td>
                                    <td>0</td>
                                    <td>4</td>
                                    <td>3</td>
                                    <td>0</td>
                                    <td><span class="badge bg-warning">Perlu Perhatian</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Indra Wijaya</td>
                                    <td>14</td>
                                    <td>14</td>
                                    <td>3</td>
                                    <td>5</td>
                                    <td>4</td>
                                    <td>1</td>
                                    <td><span class="badge bg-danger">Sanksi</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->
    <script>
        function printPromot() {
            window.print();
        }
    </script>
</body>

</html>
