@extends('layout.main')
@section('title')
    Dashboard Admin
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                {{-- UNTUK MENAMPILKAN BAHWA DISINI SUDAH LOGIN TAMPILAN ADMIN --}}
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="card-head text-center">
                                        <h6 class="title">Total Pegawai</h6>
                                    </div>
                                    <div class="nk-ck-sm">
                                        <canvas class="pie-chart" id="pieChartData"></canvas>
                                    </div>
                                </div>
                            </div><!-- .card-preview -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="card-head text-center">
                                        <h6 class="title">Statistik Kehadiran</h6>
                                    </div>
                                    <div class="nk-ck-sm">
                                        <canvas class="pie-chart" id="pieChartData2"></canvas>
                                    </div>
                                </div>
                            </div><!-- .card-preview -->
                        </div>
                        {{-- <div class="col-xl-4 col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Total Pegawai</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-users"></em>
                                            <div class="info">
                                                <span class="amount">{{ count($data) }}</span>
                                                <span class="title">Direct Join</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col --> --}}

                        {{-- <div class="col-xl-4 col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Total Cuti dan Izin</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-calendar-alt"></em>
                                            <div class="info">
                                                <span class="amount">{{ count($cuti) }}</span>
                                                <span class="title">Pegawai yang melakukan Cuti/Izin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col --> --}}

                        {{-- <div class="col-xl-4 col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Total Hadir & Terlambat</h6>
                                        </div>
                                    </div>
                                    <div class="user-activity-group g-4">
                                        <div class="user-activity">
                                            <em class="icon ni ni-check-circle"></em>
                                            <div class="info">
                                                <span class="amount">
                                                    {{ $totalTepat }}
                                                </span>
                                                <span class="title">Total Hadir</span>
                                            </div>
                                        </div>
                                        <div class="user-activity">
                                            <em class="icon ni ni-alert-circle"></em>
                                            <div class="info">
                                                <span class="amount">
                                                    {{ $totalTelat }}
                                                </span>
                                                <span class="title">Total Terlambat</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col --> --}}

                        <div class="col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Daftar Pegawai Terlambat :
                                                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', 'id') }}</h6>

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Waktu Masuk</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($terlambat as $index => $pegawai) --}}
                                                @foreach ($telatHariIni as $tel)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @php
                                                                $name = \App\Models\User::where(
                                                                    'id',
                                                                    $tel->enhancer,
                                                                )->value('name');
                                                            @endphp
                                                            {{ $name }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($tel->time)->format('H:i') }}</td>
                                                        <td><span class="badge bg-danger">Absen Terlambat</span></td>
                                                    </tr>
                                                @endforeach

                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                        <div class="col-md-6">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Daftar Pegawai Tepat Waktu :
                                                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y', 'id') }}</h6>

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Waktu Masuk</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($hadir as $index => $pegawai) --}}
                                                @foreach ($tepatHariIni as $tep)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @php
                                                                $name = \App\Models\User::where(
                                                                    'id',
                                                                    $tep->enhancer,
                                                                )->value('name');
                                                            @endphp
                                                            {{ $name }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($tep->time)->format('H:i') }}</td>
                                                        <td><span class="badge bg-success">Sudah Absen</span></td>
                                                    </tr>
                                                @endforeach
                                                {{-- @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->

                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
            <div class="nk-content p-0">
                <div class="nk-content-inner">
                    <div class="nk-content-body p-0">
                        <div class="nk-block">
                            <div class="card bg-transparent">
                                <div class="card-inner py-3 border-bottom border-light rounded-0">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Calendar</h3>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                </div>
                            </div>
                            <div class="card mt-0">
                                <div class="card-inner">
                                    <div id="calendar" class="nk-calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('pieChartData').getContext('2d');
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Laki-Laki', 'Perempuan'], // Sesuaikan label
                    datasets: [{
                        data: [10, 2], // Sesuaikan data
                        backgroundColor: ['#b695ff', '#f4aaa4'], // Sesuaikan warna
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            enabled: true,
                            backgroundColor: '#eff6ff',
                            titleFont: {
                                size: 13,
                                color: '#6783b8'
                            },
                            titleMarginBottom: 6,
                            bodyFont: {
                                color: '#9eaecf',
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                title: function(tooltipItem) {
                                    return tooltipItem[0].label;
                                },
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + ' BTC';
                                }
                            }
                        }
                    },
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('pieChartData2').getContext('2d');
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Cuti', 'Tidak Hadir', 'Masuk', 'Pulang', 'Absen'], // Sesuaikan label
                    datasets: [{
                        data: [10, 2, 200, 200, 400], // Sesuaikan data
                        backgroundColor: ['#b695ff', '#f4aaa4', '#39e369', '#cce339',
                            '#5fc2b5'
                        ], // Sesuaikan warna
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            enabled: true,
                            backgroundColor: '#eff6ff',
                            titleFont: {
                                size: 13,
                                color: '#6783b8'
                            },
                            titleMarginBottom: 6,
                            bodyFont: {
                                color: '#9eaecf',
                                size: 12
                            },
                            bodySpacing: 4,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                title: function(tooltipItem) {
                                    return tooltipItem[0].label;
                                },
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + ' BTC';
                                }
                            }
                        }
                    },
                }
            });
        });
    </script>
@endsection
