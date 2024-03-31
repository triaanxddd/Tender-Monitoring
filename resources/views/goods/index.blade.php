@extends('layouts.app')

@section('container')
@php 
    $iterationNumber = ($goods->currentPage() - 1) * $goods->perPage() + 1;
    use Carbon\Carbon;
    
@endphp 
<div class="container-fluid py-4">
    @if(session()->has('success'))
        <div class="alert alert-success text-white" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('danger'))
        <div class="alert alert-danger text-white" role="alert">
            {{ session('danger') }}
        </div>
    @endif
    <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <div class="row">
                    <div class="col">
                      <div class="d-flex">
                        <h6>Barang</h6>
                    </div>
                    <!-- buttons -->
                    <div class="col">
                      <div class="text-end">
                        <a href="{{ route('goods.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Barang</a>
                      </div>
                    </div>
                  </div>
                <!-- search bar -->
                @include('partials.search_name')
                
              </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive pb-5">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kuantitas</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Dibuat</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($goods as $good)
                            <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        {{ $iterationNumber++ }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-light">{{ $good->name }}</button>
                                    <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                      <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="{{ route('goods.show', [ 'good' => $good->id ]) }}">Permintaan Barang | <span class="badge bg-danger">{{ $good->demandedGoods->count() }}</span> </a></li>
                                    </ul>
                                  </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{  $good->total  }}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{Carbon::parse($good->created_at)->translatedFormat('l, d F Y');  }}</p>
                            </td>
                            <td class="align-middle">
                               <div class="d-flex">
                                <a href="{{ route('goods.edit', ['good' => $good->id]) }}" class="btn bg-gradient-secondary me-2" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                                </a>
                                <form action="{{ route('goods.destroy', ['good' => $good->id]) }}" method="post">
                                  @csrf 
                                  @method('delete')
                                  <button onclick="return confirm('Yakin mau delete?')" class="btn bg-gradient-danger">Delete</button>
                                </form>
                               </div>
                            </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                {{ $goods->links() }}
                </div>
              </div>
            </div>
    </div>
</div>

@endsection