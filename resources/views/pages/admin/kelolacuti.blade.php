@extends('layout.main')
@section('title')
    Kelola Cuti dan Izin
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Kelola Cuti & Izin Pegawai</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li><a href="#" class="btn btn-white btn-outline-light"><em
                                                    class="icon ni ni-download"></em><span>Cetak</span></a></li>
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
                                        <th>Tanggal Pengajuan</th>
                                        <th>Mulai</th>
                                        <th>Berakhir</th>
                                        <th>Alasan Verifikasi</th>
                                        <th>Status</th>
                                        <th>Persetujuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $d) --}}
                                    <tr>
                                        <td>1</td>
                                        <td>Hafizh Alfaris</td>
                                        <td></td>
                                        <td>13 Aug 2024</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-check"></em><span>Terima</span></a>
                                                                </li>
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-na"></em><span>Tolak</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

            </div>
        </div>
    </div>
@endsection
