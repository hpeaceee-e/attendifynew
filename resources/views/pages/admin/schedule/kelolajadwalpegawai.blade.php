@extends('layout.main')
@section('title')
    Kelola Jadwal Pegawai
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Jadwal Pegawai</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ route('admin.print-jadwal') }}" class="btn btn-secondary"
                                                    target="_blank"><em
                                                        class="icon ni ni-printer"></em><span>Cetak</span></a></li>
                                            <a href="{{ route('admin.tambahjadwal') }}" class="btn btn-icon btn-secondary">
                                                <em class="icon ni ni-plus"></em>
                                            </a>
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
                    <div class="nk-block ">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Shift</th>
                                            <th>Waktu Kerja</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            @php
                                                $clockIn = \Carbon\Carbon::parse($schedule->clock_in);
                                                $break = \Carbon\Carbon::parse($schedule->break);
                                                $clockOut = \Carbon\Carbon::parse($schedule->clock_out);

                                                // Calculate total work hours
                                                $workHours =
                                                    $clockOut->diffInHours($clockIn) - $break->diffInHours($clockIn);
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
                                                <td>
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-more-h"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('admin.editjadwal', ['id' => $schedule->id]) }}">
                                                                                <em
                                                                                    class="icon ni ni-edit"></em><span>Edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('admin.delete-jadwal', $schedule->id) }}"><em
                                                                                    class="icon ni ni-trash"></em><span>Hapus</span></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
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
                    <div class="nk-block">
                        <h3 class="nk-block-title page-title">Pembagian Jadwal Pegawai</h3>
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jadwal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            @php
                                                $name = \App\Models\Schedule::where('id', $d->schedule)->value(
                                                    'shift_name',
                                                );
                                                $day = \App\Models\Schedule::all();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->name }}</td>
                                                <td>
                                                    <select name="schedule" class="form-control schedule-select"
                                                        data-id="{{ $d->id }}">
                                                        <option value="shift" disabled>--Pilih Shift--</option>
                                                        @foreach ($day as $dd)
                                                            <option value="{{ $dd->id }}"
                                                                {{ $d->schedule == $dd->id ? 'selected' : '' }}>
                                                                {{ $dd->shift_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-secondary" id="save-schedule">Simpan
                                        Jadwal</button>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->

                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        $(document).ready(function() {
                            // Attach change event listener to select elements
                            $('select.schedule-select').change(function() {
                                var selectedValue = $(this).val();
                                var employeeId = $(this).data('id');

                                // Send AJAX request to update the schedule
                                $.ajax({
                                    url: "{{ route('admin.update.sch-jadwal') }}",
                                    method: "POST",
                                    data: {
                                        id: employeeId,
                                        schedule_id: selectedValue,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil!',
                                                text: 'Data jadwal berhasil diupdate!',
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal!',
                                                text: 'Gagal mengupdate jadwal. Coba lagi.',
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        }
                                    },
                                    error: function(xhr) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Terjadi kesalahan saat mengupdate data.',
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                    }
                                });
                            });

                            // Handle form submission (if you want to save multiple schedules at once)
                            $('#save-schedule').click(function() {
                                $('select.schedule-select').each(function() {
                                    var selectedValue = $(this).val();
                                    var employeeId = $(this).data('id');

                                    // Send AJAX request to update each schedule
                                    $.ajax({
                                        url: "{{ route('admin.update.sch-jadwal') }}",
                                        method: "POST",
                                        data: {
                                            id: employeeId,
                                            schedule_id: selectedValue,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil!',
                                                    text: 'Jadwal berhasil diperbarui!',
                                                    timer: 2000,
                                                    showConfirmButton: false
                                                });
                                            }
                                        },
                                        error: function(xhr) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: 'Kesalahan saat mengupdate jadwal.',
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        }
                                    });
                                });
                            });
                        });
                    </script>




                </div>
            </div>
        </div>
    </div>
@endsection
