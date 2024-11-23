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
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/faviconlogo.png') }}">
    <!-- Page Title  -->
    <title>Jadwal Pegawai</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
</head>

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('demo5/src/images/logonew1.png') }}"
                        srcset="{{ asset('demo5/src/images/logonew1.png 2x') }}" alt="">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Report</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">Kelola Jadwal Pegawai</h4>
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
                                    <th>Shift</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    @php
                                        $clockIn = \Carbon\Carbon::parse($schedule->clock_in);
                                        $break = \Carbon\Carbon::parse($schedule->break);
                                        $clockOut = \Carbon\Carbon::parse($schedule->clock_out);

                                        // Calculate total work hours
                                        $workHours = $clockOut->diffInHours($clockIn) - $break->diffInHours($clockIn);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->shift_name }}</td>
                                        <td>
                                            @php
                                                $datasd = \App\Models\ScheduleDayM::where(
                                                    'schedule_id',
                                                    $schedule->id,
                                                )->get();
                                            @endphp

                                            <table style="width: 100%;">
                                                @foreach ($datasd as $sd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td>{{ $sd->days }}</td>
                                                        <td style="padding-left: 20px;">{{ $sd->clock_in }} -
                                                            {{ $sd->clock_out }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <div style="padding-left: 20px;">Total : ____ jam</div>
                                        </td>
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
