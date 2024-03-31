@extends('layouts.app')

@section('container')
<div class="card shadow-lg">
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary">Kembali</a>
              <div class="d-flex align-items-center">
                <p class="mb-0">Tambah Pekerjaan</p>
              </div>
            </div>
            <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Judul Pekerjaan', 'type' => 'text', 'name' => 'name', 'value' => old('name'), 'required' => '*'])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Tanggal Upload', 'type' => 'date', 'name' => 'tanggal_upload', 'value' => old('tanggal_upload'), 'required' => '*'])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Kategori', 'type' => 'select', 'items' => $categories, 'selected' => '', 'items' => $categories, 'name' => 'category_id', 'value' => old('category_id'), 'required' => '*'])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Penjelasan', 'type' => 'file', 'name' => 'penjelasan', 'value' => ''])

                        <!-- Pembuatan Lupa dimasukin disini -->
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Pembuatan Dokumen', 'type' => 'file', 'multiple' => 'multiple', 'name' => 'pembuatan[]', 'value' => ''])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Upload Dokumen', 'type' => 'file', 'name' => 'upload_dokumen', 'value' => ''])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Undangan Pelelangan', 'type' => 'file', 'name' => 'undangan_pelelangan', 'value' => ''])
    
                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Teknis', 'type' => 'file', 'name' => 'teknis', 'value' => ''])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Penawaran', 'type' => 'file', 'name' => 'penawaran', 'value' => ''])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Legal', 'type' => 'file', 'name' => 'legal', 'value' => ''])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Pengumuman Pemenang', 'type' => 'file', 'name' => 'pengumuman_pem', 'value' => ''])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Kontrak', 'type' => 'text', 'name' => 'harga_kontrak', 'value' => old('harga_kontrak'), 'attribute' => "type-currency=IDR"])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Perkiraan Sendiri', 'type' => 'text', 'name' => 'harga_perkiraan_sendiri', 'value' => old('harga_perkiraan_sendiri'), 'attribute' => "type-currency=IDR", 'required' => '*'])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Pagu', 'type' => 'text', 'name' => 'harga_pagu', 'value' => old('harga_pagu'), 'attribute' => "type-currency=IDR"])

                        @include('partials.form_input', ['columnSize' => 'col-md-7', 'label' => 'Harga Upload', 'type' => 'text', 'name' => 'harga_upload', 'value' => old('harga_upload'), 'attribute' => "type-currency=IDR"])

                        <hr class="horizontal dark">
                    </div>
                    <div class="row">
                      <button type="submit" class="btn btn-success">Tambah Data</button>
                    </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection