@extends('layout.pegawai.main')
@section('title')
    Cuti {{ auth()->user()->name }}
@endsection
@section('content-pegawai')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Data Cuti</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li><a href="#filter" class="btn btn-secondary" target="_blank"><em
                                                    class="icon ni ni-filter"></em><span>Filter</span></a>
                                        </li>
                                        <li><a href="{{ route('pegawai.print-cuti') }}" class="btn btn-secondary"
                                                target="_blank"><em class="icon ni ni-printer"></em><span>Cetak</span></a>
                                        </li>
                                        <a href="{{ route('pegawai.create-cuti') }}" class="btn btn-icon btn-secondary">
                                            <em class="icon ni ni-plus"></em>
                                        </a>
                                    </ul>
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
                                        <th>Nama Pegawai</th>
                                        <th>Alasan</th>
                                        {{-- <th>Pengajuan</th> --}}
                                        <th>Mulai</th>
                                        <th>Berakhir</th>
                                        <th>Verifikasi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $item)
                                        {{-- @foreach ($data as $d) --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->reason_verification }}</td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</td>
                                            <td>
                                                @if ($item->status === null)
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif ($item->status == '1')
                                                    {{ $item->reason }}
                                                @else
                                                    Silahkan Cuti
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == null)
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif($item->status == '0')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($item->status == '1')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="nk-tb-actions gx-2">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#"
                                                                class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                                data-bs-toggle="dropdown">
                                                                <em class="icon ni ni-more-h"></em>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a
                                                                            href="{{ route('pegawai.edit-cuti', ['id' => $item->id]) }}"><em
                                                                                class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                    </li>
                                                                    {{-- <li><a href="#"><em
                                                                                class="icon ni ni-na"></em><span>Hapus</span></a>
                                                                    </li> --}}
                                                                    <li><a href="{{ route('pegawai.print-cuti') }}"
                                                                            target="_blank"><em
                                                                                class="icon ni ni-printer"></em><span>Cetak</span></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
                <div class="card mt-4 card-bordered card-preview">
                    <div class="card-inner py-3 border-bottom border-light ">
                        <h4 class="card-title text-center">Calendar</h4>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach ($leaves as $item)
                        {
                            title: '{{ $item->reason_verification }}',
                            start: '{{ $item->date }}',
                            end: '{{ \Carbon\Carbon::parse($item->end_date)->addDay()->format('Y-m-d') }}', // Tambahkan satu hari
                            backgroundColor: @if ($item->status === null)
                                '#f4bd0e'
                            @elseif ($item->status == '0')
                                '#1ee0ac'
                            @elseif ($item->status == '1')
                                '#e85347'
                            @endif ,
                            borderColor: @if ($item->status === null)
                                '#f4bd0e'
                            @elseif ($item->status == '0')
                                '#1ee0ac'
                            @elseif ($item->status == '1')
                                '#e85347'
                            @endif ,
                            textColor: '#ffffff'
                        },
                    @endforeach
                ],
                eventContent: function(info) {
                    // Menambahkan gaya inline untuk memusatkan teks
                    return {
                        html: `<div style="display: flex; justify-content: center; align-items: center; height: 100%; padding: 0;">${info.event.title}</div>`
                    };
                }
            });

            calendar.render();
        });
    </script>
@endsection
