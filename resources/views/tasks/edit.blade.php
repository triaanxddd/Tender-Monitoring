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
<style>
    .sub-div {
        display: none;
        overflow: hidden; /* Hide the content that overflows the div */
    }
</style>

<div class="container-fluid py-4">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('danger'))
        <div class="alert alert-danger text-white" role="alert">
            {{ session('danger') }}
        </div>
    @endif

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
                        <a class="btn bg-gradient-dark mb-0" href="{{ route('tasks.show', ['task' => $task->id ]) }}"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
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
                
                <div class="col-md-7 mt-4 mr-2">
                    <form action="{{ route('tasks.update', [ 'task' => $task->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Dokumen Pelelangan</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Judul Pekerjaan', 'type' => 'text', 'name' => 'name', 'value' => old('name', $task->name), 'required' => '*'])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Tanggal Upload', 'type' => 'date', 'name' => 'tanggal_upload', 'value' => old('tanggal_upload', $task->tanggal_upload), 'required' => '*'])
                        
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Kategori', 'type' => 'select', 'items' => $categories, 'name' => 'category_id', 'value' => old('category_id', $task->category_id), 'selected' => $task->category_id, 'required' => '*'])
                        
                        <hr class="horizontal dark">
                        
                        <!-- file input -->
                        @include('utils.form_edit', [ 'taskColumn' => $task->penjelasan, 'label' => 'Penjelasan', 'name' => 'penjelasan', 'data' => $penjelasanData ])
    
                        @include('partials.edit_row2', [
                                'title' => 'Pembuatan Dokumen',
                                'items' => $pembuatans,
                                'attribute'=> 'pembuatan'
                        ])
    
    
                        @include('utils.form_edit', [ 'taskColumn' => $task->upload_dokumen, 'label' => 'Upload Dokumen', 'name' => 'upload_dokumen', 'data' => $uploadDokumenData ])
    
                        @include('utils.form_edit', [ 'taskColumn' => $task->undangan_pelelangan, 'label' => 'Undangan Pelelangan', 'name' => 'undangan_pelelangan', 'data' => $undanganPelelangan ])
    
                        @include('utils.form_edit', [ 'taskColumn' => $task->teknis, 'label' => 'Teknis', 'name' => 'teknis', 'data' => $undanganPelelangan ])
    
                        @include('utils.form_edit', [ 'taskColumn' => $task->penawaran, 'label' => 'Penawaran', 'name' => 'penawaran', 'data' => $penawaran ])
    
                        @include('utils.form_edit', [ 'taskColumn' => $task->legal, 'label' => 'Legal', 'name' => 'legal', 'data' => $legal ])
    
    
                        <h6>Data Harga</h6>
                        <hr class="horizontal dark">
    
                        <!-- price/harga input-->
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Kontrak', 'type' => 'text', 'name' => 'harga_kontrak', 'value' => old('harga_kontrak', $task->harga_kontrak), 'attribute' => "type-currency=IDR"])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Perkiraan Sendiri', 'type' => 'text', 'name' => 'harga_perkiraan_sendiri', 'value' => old('harga_perkiraan_sendiri', $task->harga_perkiraan_sendiri), 'attribute' => "type-currency=IDR"])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Pagu', 'type' => 'text', 'name' => 'harga_pagu', 'value' => old('harga_pagu', $task->harga_pagu), 'attribute' => "type-currency=IDR"])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Upload', 'type' => 'text', 'name' => 'harga_upload', 'value' => old('harga_upload', $task->harga_upload), 'attribute' => "type-currency=IDR"])
    
                        <h6>Status Pelelangan</h6>
                        <hr class="horizontal dark">
                        @include('utils.form_edit', [ 'taskColumn' => $task->pengumuman_pem, 'label' => 'Pengumuman Pemenang', 'name' => 'pengumuman_pem', 'data' => $pengumumanPem ])
                        
                        <div class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="radio" name="status_pemenang" value="0" id="option1" {{ ($task->status_pemenang == 0 ? 'checked' : '') }} >
                                    <label for="option1" class="form-control-label">Menunggu</label>
    
                                    <input type="radio" name="status_pemenang" value="1" id="option2" {{ ($task->status_pemenang == 1 ? 'checked' : '') }}>
                                    <label for="option2" class="form-control-label">Menang</label>
    
                                    <input type="radio" name="status_pemenang" value="2" id="option3" {{ ($task->status_pemenang == 2 ? 'checked' : '') }}>
                                    <label for="option3" class="form-control-label">Kalah</label>
                                </div>
                            </div>
                        </div>
    
                        <!-- dokumen setelah pelelangan -->
                          <div id="win" style="display: {{ $task->status_pemenang == '1' ? 'block' : 'none' }};">
                              <div class="table-responsive">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                          <th scope="col">No</th>
                                          <th scope="col-2" style="width: 50px;">Kegiatan</th>
                                          <th scope="col">Dokumen</th>
                                          <th scope="col">Status</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @include('partials.edit_row', [
                                              'number' => '1',
                                              'title' => 'Uraian Pekerjaan',
                                              'items' => $uraians,
                                              'attribute'=> 'uraian'
                                              ])
      
                                          @if($uraians->isNotEmpty())
                                              @include('partials.edit_row', [
                                              'number' => '2',
                                              'title' => 'Laporan',
                                              'items' => $laporans,
                                              'attribute'=> 'laporan'
                                              ])
                                          @endif
                                          
                                          @if($laporans->isNotEmpty())
                                              @include('partials.edit_row', [
                                              'number' => '3',
                                              'title' => 'Penagihan',
                                              'items' => $penagihans,
                                              'attribute'=> 'penagihan'
                                              ])
                                          @endif
      
                                          @if($penagihans->isNotEmpty())
                                              @include('partials.edit_row', [
                                              'number' => '4',
                                              'title' => 'Pembayaran',
                                              'subTitle' => ' (BPJS Ketenagakerjaan/Kesehatan)',
                                              'items' => $pembayarans,
                                              'attribute'=> 'pembayaran'
                                              ])
                                          @endif
                                      </tbody>
                                  </table>
      
                              </div>
                          </div>
    
                            <div id="lose" style="display: {{ $task->status_pemenang == '2' ? 'block' : 'none' }};">
                                <div class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg" >
                                    <div class="col-md-7" >
                                        <div class="form-group">
                                            <label for="loss_statement">Keterangan Kalah</label>
                                            <select class="form-select" aria-label="Default select example" name="loss_statement" id="loss_statement">
                                                <option value="0" selected>Pilih keterangan</option>
                                                <option value="2" {{ $task->loss_statement == 2 ? 'selected' : '' }}>Peringkat 2</option>
                                                <option value="3" {{ $task->loss_statement == 3 ? 'selected' : '' }}>Peringkat 3</option>
                                                <option value="4" {{ $task->loss_statement == 4 ? 'selected' : '' }}>Peringkat 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>        
                            </div>
                        <div class="row">
                            <button type="submit" class="btn btn-success">Ubah</button>
                        </div>
                    </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-5 mt-4 ml-3">
                    <form action="{{ route('demandedGoodsCreate') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-header pb-0 px-3">
                                        <h6 class="mb-0">Persiapan Barang yang dibutuhkan</h6>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                        <div class="row">
                                            <div class="form-group">
                                                <select name="goods_id" class="form-select @error('goods_id') is-invalid  @enderror" id="goods_id" name="goods_id">
                                                    <option selected>Pilih Barang</option>
                                                    @foreach($goods as $good)
                                                        <option value="{{ $good->id }}">{{ $good->name }} | total yang dimiliki: {{ $good->total }}</option>
                                                    @endforeach
                                                </select>
                                                @error('goods_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control @error('quantity') is-invalid  @enderror" name="quantity" placeholder="Kuantitas">
                                                @error('quantity') 
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">Ajukan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                                            <td>
                                                                @php 
                                                                    $idValue = ['id' => $item->id];
                                                                    $available = 0;

                                                                    if($item->user_id == auth()->user()->id){
                                                                        $available = 1;
                                                                    }
                                                                    elseif(auth()->user()->role == 1){
                                                                        $available = 1;
                                                                    }

                                                                @endphp
                                                                <div class="d-flex">
                                                                    @if(auth()->user()->role == 1)
                                                                        <form action="{{ $item->approval == 1 ? route('goods-disapprove', $idValue) : route('goods-approve', $idValue) }}" method="post">
                                                                            @csrf
                                                                            <button type="submit" href="" class="btn btn-secondary py-1 px-3 me-2" onclick="return confirm('Yakin ingin ubah?')">
                                                                                {{ $item->approval == 1 ? 'Batalkan' : 'Setujui'  }}
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    @if($available == 1)
                                                                        <form action="{{ route('goods-delete', $idValue) }}" method="post">
                                                                            @csrf
                                                                            <button type="submit" href="" class="btn btn-danger py-1 px-3" onclick="return confirm('Yakin ingin hapus?')">
                                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
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
<script>
    var winDiv = document.getElementById('win');
    var loseDiv = document.getElementById('lose');
    const option1 = document.getElementById('option1');
    const option2 = document.getElementById('option2');
    const option3 = document.getElementById('option3');


    // Function to handle radio button change
    function handleRadioButtonChange() {
        if (option2.checked) {
            winDiv.style.display = 'block'; // Show the win div
            loseDiv.style.display = 'none'; // Hide the lose div
        } 
        else if(option3.checked){
            winDiv.style.display = 'none'; // hide the win div
            loseDiv.style.display = 'block'; // show the lose div
        }
        
        else {
            winDiv.style.display = 'none'; // Hide the win div
            loseDiv.style.display = 'none'; // Hide the lose div
        }
    }

    // Attach change event listeners to radio buttons
    option1.addEventListener('change', handleRadioButtonChange);
    option2.addEventListener('change', handleRadioButtonChange);
    option3.addEventListener('change', handleRadioButtonChange);

</script>

@endsection