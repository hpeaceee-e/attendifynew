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
    <title>Cetak Pegawai</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
    <link rel="stylesheet" type="text/css" href="./assets/css/libs/fontawesome-icons.css">


</head>

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('demo5/src/images/kehadiranmantap.png') }}"
                        srcset="{{ asset('demo5/src/images/kehadiranmantap.png 2x') }}" alt="">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Report</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">Kelola Data Pegawai</h4>
                            {{-- <ul class="list-plain">
                                <li><em class="icon ni ni-map-pin-fill fs-18px"></em><span>House #65, 4328 Marion
                                        Street<br>Newbury, VT 05051</span></li>
                                <li><em class="icon ni ni-call-fill fs-14px"></em><span>+012 8764 556</span></li>
                            </ul> --}}
                        </div>
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Pegawai</th>
                                    <th>Email</th>
                                    {{-- <th>Password</th> --}}
                                    <th>Role</th>
                                    <th>Tanggal Verifikasi</th>
                                    <th>Jadwal</th>
                                    <th>Avatar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->username }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->email }}</td>
                                        {{-- <td>{{ $d->password }}</td> --}}
                                        <td>{{ $d->role_name }}</td>
                                        <td>{{ $d->created_at->format('d M Y') }}</td>
                                        <td>{{ $d->shift_name }}</td>
                                        <td>
                                            <div class="user-card">
                                                <div class="user-avatar bg-secondary">
                                                    <img src="{{ asset($d->avatar) }}" class="img-fluid"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge  {{ $d->status == 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $d->status == 0 ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                    </tr>
                            </tbody>
                            @endforeach

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
