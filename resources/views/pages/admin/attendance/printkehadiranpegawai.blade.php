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
        Cetak Kehadiran Pegawai
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
                    <img src="{{ asset('demo5/src/images/logo-dark.png') }}"
                        srcset="{{ asset('demo5/src/images/logo-dark2x.png 2x') }}" alt="">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Report</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">Kelola Data Kehadiran Pegawai</h4>
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
                                    <th>Pegawai</th>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Kehadiran</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $attendancesGrouped = $attendances->groupBy('date');
                                @endphp

                                @foreach ($attendancesGrouped as $date => $group)
                                    @php
                                        // Initialize variables
                                        $clockIn = null;
                                        $clockOut = null;
                                        $coordinate = null;
                                        $status = '-'; // Default status

                                        foreach ($group as $attendance) {
                                            if ($attendance->status == 0) {
                                                $clockIn = \Carbon\Carbon::parse($attendance->time)->format('H:i');
                                                $coordinate = $attendance->coordinate;
                                            } elseif ($attendance->status == 1) {
                                                $clockOut = \Carbon\Carbon::parse($attendance->time)->format('H:i');
                                            }
                                        }

                                        if ($clockIn && $group->first()->schedule) {
                                            $actualTime = \Carbon\Carbon::parse($clockIn);
                                            $scheduledTime = \Carbon\Carbon::parse($group->first()->schedule->clock_in);
                                            $status = $actualTime <= $scheduledTime ? 'Tepat Waktu' : 'Terlambat';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $group->first()->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</td>
                                        <td>{{ $clockIn ?: '-' }}</td>
                                        <td>{{ $clockOut ?: '-' }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $status == 'Tepat Waktu' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>{{ $coordinate ?: '-' }}</td>
                                    </tr>
                                @endforeach
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
