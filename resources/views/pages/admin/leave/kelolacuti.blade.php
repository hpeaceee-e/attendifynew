@extends('layout.main')
@section('title')
    Kelola Cuti dan Izin
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <!-- Your existing content -->

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Kelola Cuti & Izin Pegawai</h3>
                            <div class="nk-block-des text-soft">
                                <p>Kamu mempunyai {{ count($leaves) }} Pengajuan Cuti dan Izin.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li><a href="{{ route('admin.print-kelolacuti') }}"
                                                class="btn btn-white btn-outline-light" data-bs-toggle="modal"
                                                data-bs-target="#printModal" target="_blank"><em
                                                    class="icon ni ni-printer"></em><span>Cetak</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}</div>
                @endif
                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Alasan</th>
                                        <th>Pengajuan</th>
                                        <th>Mulai</th>
                                        <th>Berakhir</th>
                                        <th>Verifikasi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->reason_verification }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</td>
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
                                                        <a href="#" class="btn btn-sm btn-icon btn-trigger"
                                                            data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                                            data-id="{{ $item->id }}"
                                                            data-status="{{ $item->status }}"
                                                            data-reason="{{ $item->reason }}">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

                <!-- Modal -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Cuti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            @foreach ($leaves as $item)
                                <form id="confirmationForm" action="{{ route('admin.update-cuti', ['id' => $item->id]) }}"
                                    method="POST">
                            @endforeach
                            @csrf
                            <input type="hidden" name="id" id="leave_id">
                            {{-- <input type="hidden" name="enhancer" id="enhancer_id"> --}}
                            <!-- Menambahkan hidden field untuk enhancer -->

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="status">Status Pengajuan Cuti</label>
                                    <select name="status" id="status" class="form-control"
                                        onchange="toggleReasonField()" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="0">Diterima</option>
                                        <option value="1">Ditolak</option>
                                    </select>
                                </div>

                                <div class="form-group" id="reason-group" style="display: none;">
                                    <label for="reason">Alasan Penolakan</label>
                                    <textarea name="reason" id="reason" class="form-control form-control-lg" placeholder="Alasan penolakan"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Persetujuan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Modal for printing single leave request -->
                <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="printModalLabel">Cetak Pengajuan Cuti</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="printForm" action="" method="GET" target="_blank">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="print_option">Pilih Jenis Cetak</label>
                                        <select name="print_option" id="print_option" class="form-control"
                                            onchange="togglePrintOptions()" required>
                                            <option value="" disabled selected>Pilih Jenis Cetak</option>
                                            <option value="all">Cetak Semua</option>
                                            <option value="individual">Cetak Individu</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="individual-option" style="display: none;">
                                        <label for="leave_id_print">Pilih Pengajuan Cuti</label>
                                        <select name="leave_id" id="leave_id_print" class="form-control">
                                            <option value="" disabled selected>Pilih Cuti</option>
                                            @foreach ($leaves as $item)
                                                <option value="{{ $item->id }}">{{ $item->user->name }} -
                                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePrintOptions() {
            var printOption = document.getElementById('print_option').value;
            var individualOption = document.getElementById('individual-option');
            var printForm = document.getElementById('printForm');

            if (printOption === 'individual') {
                individualOption.style.display = 'block';
                printForm.action = "#";
            } else {
                individualOption.style.display = 'none';
                printForm.action = "#";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var confirmationModal = document.getElementById('confirmationModal');
            confirmationModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var leaveId = button.getAttribute('data-id');
                var status = button.getAttribute('data-status');
                var reason = button.getAttribute('data-reason');
                // var enhancerId = button.getAttribute('data-enhancer'); // Ambil ID pengguna

                var form = confirmationModal.querySelector('form');
                form.action = form.action.replace(/\/\d+$/, '/' +
                    leaveId); // Update URL action dengan leaveId
                form.querySelector('#leave_id').value = leaveId;
                // form.querySelector('#enhancer_id').value = enhancerId; // Set enhancer ID

                var statusSelect = form.querySelector('#status');
                statusSelect.value = status;

                if (status === '1') {
                    form.querySelector('#reason-group').style.display = 'block';
                    form.querySelector('#reason').value = reason;
                } else {
                    form.querySelector('#reason-group').style.display = 'none';
                    form.querySelector('#reason').value = '';
                }
            });
        });



        function toggleReasonField() {
            var status = document.getElementById('status').value;
            var reasonGroup = document.getElementById('reason-group');
            if (status === '1') { // 1 untuk 'Ditolak'
                reasonGroup.style.display = 'block';
            } else {
                reasonGroup.style.display = 'none';
            }
        }
    </script>
@endsection
