@extends('layouts.app')

@section('container')
@php
    use Illuminate\Support\Carbon;
    $penjelasanData = json_decode($task->penjelasan, true);
    $uploadDokumenData = json_decode($task->upload_dokumen, true);
    $undanganPelelangan = json_decode($task->undangan_pelelangan, true);
    $teknis = json_decode($task->teknis, true);
    $penawaran = json_decode($task->penawaran, true);
    $legal = json_decode($task->legal, true);

    $pengumumanPem = json_decode($task->pengumuman_pem, true);

@endphp

@if($task->penjelasan)
    <!-- <iframe src="{{ asset('storage').'/'. $penjelasanData['file_directory'] }}" frameborder="0"></iframe> -->
@endif
@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@elseif(session()->has('danger'))
    <div class="alert alert-danger text-white" role="alert">
        {{ session('danger') }}
    </div>
@endif
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card mt-4">
            <div class="card-header pb-0 p-3">
                <div>
                    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $task->name }}</h3>
                    </div>
                    <br>
                </div>
                <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="{{ route('tasks.edit', ['task' => $task->id ]) }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Edit</a>
                    <!-- <a id="download-pdf" target="_blank" href="{{ route('pdfDownload', ['id' => $task->id ]) }}" class="btn btn-danger mb-0"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a> -->
                </div>
                <div class="col-12">
                    <b>Dibuat oleh: </b><span>{{ $task->user->name }}</span>
                </div>
                <div class="col-6">
                    <span> {{ Carbon::parse($task->tanggal_upload)->translatedFormat('l, d F Y');  }}</span>
                </div>
                </div>
            </div>
            <div class="card-body p-3">

            </div>
            </div>
        </div>
        <div class="col-md-7 mt-4">
            <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Dokumen Pelelangan</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <!-- row and columns format inside blade file -->
                    @include('partials.list_col', [
                        'label' => 'Penjelasan', 
                        'uploader' => $penjelasanData ? $penjelasanData['user_name'] : '', 
                        'tanggal' => $penjelasanData ? $penjelasanData['date_uploaded'] : '', 
                        'directory' => $penjelasanData ? asset('storage').'/'.$penjelasanData['file_directory'] : ''
                    ])

                    @include('partials.show_row', [
                                'number' => '',
                                'title' => 'Pembuatan',
                                'items' => $pembuatans,
                                'attribute'=> 'pembuatan',
                                'disableCheck' => 0
                    ])


                    @include('partials.list_col', [
                        'label' => 'Upload Dokumen', 
                        'uploader' => $uploadDokumenData ? $uploadDokumenData['user_name'] : '', 
                        'tanggal' => $uploadDokumenData ? $uploadDokumenData['date_uploaded'] : '', 
                        'directory' => $uploadDokumenData ? asset('storage').'/'.$uploadDokumenData['file_directory'] : ''
                    ])

                    @include('partials.list_col', [
                        'label' => 'Undangan Pelelangan', 
                        'uploader' => $undanganPelelangan ? $undanganPelelangan['user_name'] : '', 
                        'tanggal' => $undanganPelelangan ? $undanganPelelangan['date_uploaded'] : '', 
                        'directory' => $undanganPelelangan ? asset('storage').'/'.$undanganPelelangan['file_directory'] : ''
                    ])

                    <h6>Data Harga</h6>
                        <div class="row">
                            <div class="col-7">Harga Kontrak: </div>
                            <div class="col-5 text-end"><b>Rp {{ $task->harga_kontrak }}</b> </div>
                        </div>
    
                        <div class="row">
                            <div class="col-7">Harga Perkiraan Sendiri: </div>
                            <div class="col-5 text-end"><b class="text-end">Rp {{ $task->harga_perkiraan_sendiri }}</b> </div>
                        </div>
    
                        <div class="row">
                            <div class="col-7">Harga Pagu: </div>
                            <div class="col-5 text-end"><b class="text-end">Rp {{ $task->harga_pagu }}</b> </div>
                        </div>
    
                        <div class="row">
                            <div class="col-7">Harga Upload: </div>
                            <div class="col-5 text-end"><b class="text-end">Rp {{ $task->harga_upload }}</b> </div>
                        </div>

                    <hr class="horizontal dark">
                    <h6>Menyampaikan Dokumen</h6>
                    @include('partials.list_col', [
                        'label' => 'Teknis', 
                        'uploader' => $teknis ? $teknis['user_name'] : '', 
                        'tanggal' => $teknis ? $teknis['date_uploaded'] : '', 
                        'directory' => $teknis ? asset('storage').'/'.$teknis['file_directory'] : ''
                    ])

                    @include('partials.list_col', [
                        'label' => 'Penawaran', 
                        'uploader' => $penawaran ? $penawaran['user_name'] : '', 
                        'tanggal' => $penawaran ? $penawaran['date_uploaded'] : '', 
                        'directory' => $penawaran ? asset('storage').'/'.$penawaran['file_directory'] : ''
                    ])

                    @include('partials.list_col', [
                        'label' => 'Legal', 
                        'uploader' => $legal ? $legal['user_name'] : '', 
                        'tanggal' => $legal ? $legal['date_uploaded'] : '', 
                        'directory' => $legal ? asset('storage').'/'.$legal['file_directory'] : ''
                    ])
                    <h6>Status Pelelangan</h6>
                    <hr class="horizontal dark">
                    
                    <div class="status_pelelangan mb-2">
                        <span>Status:
                            @if($task->status_pemenang == 1)
                                <span class="badge badge-sm bg-gradient-success">Menang</span>
                            @elseif($task->status_pemenang == 2)
                                <span class="badge badge-sm bg-gradient-danger">Kalah</span>
                            @else
                                <span class="badge badge-sm bg-gradient-secondary">Menunggu</span>
                            @endif
                        </span>
                    </div>

                    @include('partials.list_col', [
                        'label' => 'Pengumuman Pemenang', 
                        'uploader' => $pengumumanPem ? $pengumumanPem['user_name'] : '', 
                        'tanggal' => $pengumumanPem ? $pengumumanPem['date_uploaded'] : '', 
                        'directory' => $pengumumanPem ? asset('storage').'/'.$pengumumanPem['file_directory'] : ''
                    ])
                    
                    <hr class="horizontal dark">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Dokumen</th>
                                <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('partials.show_row', [
                                    'number' => '1',
                                    'title' => 'Uraian Pekerjaan',
                                    'items' => $uraians,
                                    'attribute'=> 'uraian',
                                    'disableCheck' => 1
    
                                ])
    
                                @include('partials.show_row', [
                                    'number' => '2',
                                    'title' => 'Laporan',
                                    'subTitle' => '(Harian, Bulanan, Tahunan)',
                                    'items' => $laporans,
                                    'attribute'=> 'laporan',
                                    'disableCheck' => 1
                                ])
    
                                @include('partials.show_row', [
                                    'number' => '3',
                                    'title' => 'Penagihan',
                                    'items' => $penagihans,
                                    'attribute'=> 'penagihan',
                                    'disableCheck' => 1
    
                                ])
    
                                @include('partials.show_row', [
                                    'number' => '4',
                                    'title' => 'Pembayaran',
                                    'subTitle' => ' (BPJS Ketenagakerjaan/Kesehatan)',
                                    'items' => $pembayarans,
                                    'attribute'=> 'pembayaran',
                                    'disableCheck' => 1
    
                                ])
                            </tbody>
                        </table>
                    </div>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-md-5 mt-4 ml-3">
            <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header pb-0 px-3">
                                <div class="title-name row">
                                    <div class="col">
                                        <h6 class="mb-0">List Permintaan Barang Pekerjaan ini</h6>
                                    </div>
                                    <div class="col">
                                        <i class="fa fa-angle-down float-end icon"></i>
                                    </div>
                                </div>
                                <div class="table-responsive sub-div">
                                        <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Barang</th>
                                                    <th scope="col">Kuantitas</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($demandedGoods as $item)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item->goods->name }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>
                                                            @if($item->approval == 1)
                                                                <span class="badge bg-gradient-success"> Disetujui</span>
                                                            @else 
                                                                <span class="badge bg-gradient-danger"> Belum Disetujui</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Kosong</td> 
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                        </table>
                                    </div>
                                <!-- <span class="text-end">t</span> -->
                            </div>
                            <div class="card-body pt-4 p-3 ">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>

@endsection