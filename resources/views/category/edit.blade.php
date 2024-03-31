@extends('layouts.app')

@section('container')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Tambah Kategori Baru</p>
              </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Nama Kategori</label>
                          <input class="form-control" type="text" name="name" value="{{ old('name', $category->name) }}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection