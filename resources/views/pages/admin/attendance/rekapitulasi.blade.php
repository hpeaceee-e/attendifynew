@extends('layout.main')
@section('title')
    Rekapitulasi Kehadiran
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Rekapitulasi Kehadiran</h3>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ route('admin.print-cetakrekapitulasi') }}"
                                                    class="btn btn-secondary" target="_blank"><em
                                                        class="icon ni ni-printer"></em><span>Cetak</span></a></li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif
                    @if (session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: '{{ session('error') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Masuk</th>
                                            <th>Pulang</th>
                                            <th>Lebih Awal</th>
                                            <th>Terlambat</th>
                                            <th>Tidak Masuk</th>
                                            <th>Cuti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($data as $index => $d) --}}
                                        <tr>
                                            <td>1</td>
                                            <td>Hafizh Alfaris</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>0</td>
                                            <td>3</td>
                                        </tr>
                                        {{-- @endforeach --}}
                                        <tr>
                                            <td>2</td>
                                            <td>Ali Rahman</td>
                                            <td>18</td>
                                            <td>18</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>1</td>
                                            <td>2</td>
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
                                        </tr>
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
