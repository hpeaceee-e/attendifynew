<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('demo5/src/images/faviconlogo.png') }}">
    <!-- Page Title  -->
    <title>Cuti & Izin </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('demo5/src/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('demo5/src/assets/css/theme.css?ver=3.0.3') }}">
</head>

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img src="{{ asset('demo5/src/images/logonew1.png') }}"
                        srcset="{{ asset('demo5/src/images/logonew1.png') }}" alt="">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Report</span>
                        <div class="invoice-contact-info">
                            <h4 class="title">Data Riwayat Cuti : {{ auth()->user()->name }}</h4>
                            {{-- <ul class="list-plain">
                                <li><em class="icon ni ni-map-pin-fill fs-18px"></em><span>House #65, 4328 Marion
                                        Street<br>Newbury, VT 05051</span></li>
                                <li><em class="icon ni ni-call-fill fs-14px"></em><span>+012 8764 556</span></li>
                            </ul> --}}
                        </div>
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    {{-- <th>Nama Pegawai</th> --}}
                                    <th>Alasan</th>
                                    <th>Subkategori</th>
                                    {{-- <th>Pengajuan</th> --}}
                                    <th>Mulai</th>
                                    <th>Berakhir</th>
                                    <th>Verifikasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>

                                            @if ($item->category == 'annual')
                                                Tahunan
                                            @elseif ($item->category == 'other')
                                                Lain-lain
                                            @endif
                                        </td>
                                        {{-- <td>{{ $item->user->name }}</td> --}}
                                        <td>{{ $item->reason }}</td>
                                        <td>
                                            @if (empty($item->subcategory))
                                                Tahunan
                                            @elseif ($item->subcategory == 'sick')
                                                Sakit
                                            @elseif ($item->subcategory == 'married')
                                                Menikah
                                            @elseif ($item->subcategory == 'important_reason')
                                                Beralasan Penting
                                            @elseif ($item->subcategory == 'pilgrimage')
                                                Beribadah Haji
                                            @endif
                                        </td>
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
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->
    <script>
        function printPromot() {
            window.print();
        }
    </script>
</body>

</html>
