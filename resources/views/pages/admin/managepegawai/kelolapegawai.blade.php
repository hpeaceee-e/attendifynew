@extends('layout.main')
@section('title')
    Kelola Pegawai
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Pegawai</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Kamu mempunyai {{ count($data) }} Pegawai.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ route('admin.print-kelolapegawai') }}" class="btn btn-secondary"
                                                    target="_blank"><em
                                                        class="icon ni ni-printer"></em><span>Cetak</span></a></li>
                                            <a href="{{ route('admin.tambahpegawai') }}" class="btn btn-icon btn-secondary">
                                                <em class="icon ni ni-plus"></em>
                                            </a>
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
                                            {{-- <th>Role</th> --}}
                                            <th>Email</th>
                                            <th>Bergabung</th>
                                            <th>Jadwal</th>
                                            <th>Avatar</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $d)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $d->name }}</td>
                                                {{-- <td>{{ $d->role }}</td> --}}
                                                <td>{{ $d->email }}</td>
                                                <td>{{ $d->created_at->format('d M Y') }}</td>
                                                <td>
                                                    @if (is_object($d->schedule))
                                                        {{ $d->schedule->clock_in->format('H:i') }} -
                                                        {{ $d->schedule->clock_out->format('H:i') }}
                                                    @else
                                                        No Schedule
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-secondary">
                                                            <img src="{{ asset($d->avatar) }}" class="img-fluid"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="tb-status {{ $d->status == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $d->status == 0 ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
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
                                                                                href="{{ route('admin.pegawaidetail', ['id' => $d->id]) }}"><em
                                                                                    class="icon ni ni-eye"></em><span>Detail</span></a>
                                                                        </li>
                                                                        <li><a
                                                                                href="{{ route('admin.editpegawai', ['id' => $d->id]) }}"><em
                                                                                    class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                        </li>
                                                                        {{-- <li><a
                                                                                href="{{ route('admin.deletepegawai', ['id' => $d->id]) }}"><em
                                                                                    class="icon ni ni-na"></em><span>Hapus</span></a>
                                                                        </li> --}}
                                                                        <li>
                                                                            <a href="#"
                                                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $d->id }}').submit();">
                                                                                <em
                                                                                    class="icon ni ni-na"></em><span>Hapus</span>
                                                                            </a>
                                                                            <form id="delete-form-{{ $d->id }}"
                                                                                action="{{ route('admin.deletepegawai', ['id' => $d->id]) }}"
                                                                                method="POST" style="display: none;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                            </form>

                                                                        </li>

                                                                        {{-- <li>
                                                                            <a
                                                                                href="{{ route('admin.deletepegawai', ['id' => $d->id]) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <em
                                                                                    class="icon ni ni-na"></em><span>Hapus</span>
                                                                            </a>
                                                                        </li> --}}


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
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Content Code -->
    {{-- <div class="modal fade" tabindex="-1" id="tambahpegawai">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="{{ route('admin.kelolapegawai') }}" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Pegawai</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pegawai.store') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="preview-block">

                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ str_pad($nextUserId, 5, '0', STR_PAD_LEFT) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nama</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="role">Role</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="role" name="role_id" required>
                                                <option value="">Pilih Role</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Pegawai</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="status">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="avatar">Avatar</label>
                                        <div class="form-control-wrap">
                                            <input type="file" class="form-file-input" id="avatar" name="avatar"
                                                required>
                                            <label class="form-file-label" for="avatar">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule">Jadwal</label>
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="schedule" name="schedule" required>
                                                <option value="">Pilih Jadwal</option>
                                                <option value="1">08:00 - 17:00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr class="preview-hr">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Pegawai</span>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
