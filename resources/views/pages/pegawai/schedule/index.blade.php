@extends('layout.pegawai.main')
@section('title')
    Jadwal {{ auth()->user()->name }}
@endsection
@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Jadwal Jam Kerja</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th class="text-center">Jam Masuk</th>
                                            <th class="text-center">Jam Istirahat</th>
                                            <th class="text-center">Jam Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            @foreach ($schedule->days as $day)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $day->days }}</td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($day->clock_in)->format('H:i') }}</td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($day->break)->format('H:i') }}</td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($day->clock_out)->format('H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->

                </div>
            </div>
        </div>
    </div>
@endsection
