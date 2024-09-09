<table class="datatable-init table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
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
                <td>{{ $d->email }}</td>
                <td>{{ $d->created_at->format('d M Y') }}</td>
                <td>
                    @if (is_object($d->schedule))
                        {{ $d->schedule->clock_in->format('H:i') }} - {{ $d->schedule->clock_out->format('H:i') }}
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
                    </div>
                </td>
                <td>
                    <span class="tb-status text-danger">Dihapus</span>
                </td>
                <td>
                    <a href="{{ route('admin.restorepegawai', ['id' => $d->id]) }}"
                        class="btn btn-sm btn-primary">Restore</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
