<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
                <div class="nk-block-head nk-block-head-lg wide-sm">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><a class="back-to" href="html/components.html"><em
                                    class="icon ni ni-arrow-left"></em><span>Components</span></a></div>
                        <h2 class="nk-block-title fw-normal">DataTable Example</h2>
                        <div class="nk-block-des">
                            <p class="lead">Using <a href="https://datatables.net/" target="_blank">DataTables</a>,
                                add advanced interaction controls to your HTML tables. It is a highly flexible tool and
                                all advanced features allow you to display table instantly and nice way.</p>
                            <p>Check out the <a href="https://datatables.net/" target="_blank">documentation</a> for a
                                full overview.</p>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Data Table</h4>
                            <div class="nk-block-des">
                                <p>Using the most basic table markup, here’s how <code class="code-class">.table</code>
                                    based tables look by default.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
            </div><!-- .components-preview -->
        </div>
    </div>
</div>

<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Pegawai</h3>
                        <div class="nk-block-des text-soft">
                            <p>Kamu mempunyai {{ count($data) }} Pegawai.</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li><a href="#" class="btn btn-white btn-outline-light"><em
                                                class="icon ni ni-download"></em><span>Cetak</span></a></li>
                                    <li class="nk-block-tools-opt">
                                        <div class="drodown">
                                            <button type="button" class="btn btn-primary"
                                                class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#tambahpegawai"><em
                                                    class="icon ni ni-plus"></em></button>
                                            {{-- <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('admin.tambahpegawai') }}"><span>Tambah
                                                                Pegawai</span></a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner position-relative card-tools-toggle">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap gx-3">
                                        <div class="btn-wrap">
                                        </div>
                                    </div><!-- .form-inline -->
                                </div><!-- .card-tools -->
                                <div class="card-tools me-n1">
                                    <ul class="btn-toolbar gx-1">
                                        <li>
                                            <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                data-target="search"><em class="icon ni ni-search"></em></a>
                                        </li><!-- li -->
                                        <li class="btn-toolbar-sep"></li><!-- li -->
                                        <li>
                                            <div class="toggle-wrap">
                                                <a href="/admin/kelolapegawai" class="btn btn-icon btn-trigger toggle"
                                                    data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                                <div class="toggle-content" data-content="cardTools">
                                                    <ul class="btn-toolbar gx-1">
                                                        <li class="toggle-close">
                                                            <a href="/admin/kelolapegawai"
                                                                class="btn btn-icon btn-trigger toggle"
                                                                data-target="cardTools"><em
                                                                    class="icon ni ni-arrow-left"></em></a>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    class="btn btn-trigger btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-setting"></em>
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                    <ul class="link-check">
                                                                        <li><span>Show</span></li>
                                                                        <li class="active"><a href="#">10</a>
                                                                        </li>
                                                                        <li><a href="#">20</a></li>
                                                                        <li><a href="#">50</a></li>
                                                                    </ul>
                                                                    <ul class="link-check">
                                                                        <li><span>Order</span></li>
                                                                        <li class="active"><a href="#">DESC</a>
                                                                        </li>
                                                                        <li><a href="#">ASC</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div><!-- .dropdown -->
                                                        </li><!-- li -->
                                                    </ul><!-- .btn-toolbar -->
                                                </div><!-- .toggle-content -->
                                            </div><!-- .toggle-wrap -->
                                        </li><!-- li -->
                                    </ul><!-- .btn-toolbar -->
                                </div><!-- .card-tools -->
                            </div><!-- .card-title-group -->
                            <div class="card-search search-wrap" data-search="search">
                                <div class="card-body">
                                    <div class="search-content">
                                        <a href="#" class="search-back btn btn-icon toggle-search"
                                            data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                        <input type="text" class="form-control border-transparent form-focus-none"
                                            placeholder="Search by user or email">
                                        <button class="search-submit btn btn-icon"><em
                                                class="icon ni ni-search"></em></button>
                                    </div>
                                </div>
                            </div><!-- .card-search -->
                        </div><!-- .card-inner -->
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col"><span class="sub-text">Username</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Nama Pegawai</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Role</span></div>
                                    <div class="nk-tb-col tb-col-sm"><span class="sub-text">Email</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Tanggal</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Jadwal</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="tabsub-text">Avatar</span></div>
                                    <div class="nk-tb-col "><span class="sub-text">Status</span></div>
                                    <div class="nk-tb-col "><span class="sub-text">Action</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools text-end">
                                    </div>
                                </div>
                                @foreach ($data as $d)
                                    <!-- .nk-tb-item -->
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="uid1">
                                                <label class="custom-control-label" for="uid1"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span>{{ $d->username }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span>{{ $d->name }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $d->role }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $d->email }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $d->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $d->schedule }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar xs bg-primary">
                                                    <span>AB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-status text-success">Active</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-2">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-trigger dropdown-toggle"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-eye"></em><span>Edit
                                                                        </span></a></li>
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-na"></em><span>Hapus</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                @endforeach
                            </div><!-- .nk-tb-list -->
                        </div><!-- .card-inner -->
                        <div class="card-inner">
                            <ul class="pagination justify-content-center justify-content-md-start">
                                <li class="page-item"><a class="page-link" href="/admin/kelolapegawai">Prev</a></li>
                                <li class="page-item"><a class="page-link" href="/admin/kelolapegawai">1</a></li>
                                <li class="page-item"><a class="page-link" href="/admin/kelolapegawai">Next</a></li>
                            </ul><!-- .pagination -->
                        </div><!-- .card-inner -->
                    </div><!-- .card-inner-group -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>


tolong ubah tampilannya memakai tampilan yg awal tabel
