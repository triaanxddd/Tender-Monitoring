@extends('layouts.app')

@section('container')
@php 
    $iterationNumber = ($categories->currentPage() - 1) * $categories->perPage() + 1;
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
                        <h6>Kategori Pekerjaan</h6>
                      </div>
                    </div>
                    <!-- buttons -->
                    <div class="col">
                      <div class="text-end">
                        <a href="{{ route('categories.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Pekerjaan</a>
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
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kategori</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Dibuat</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
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
                                  <div class="dropdown">
                                      <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                      <div class="dropdown-content">
                                          <b style="font-size:10px;">List Pekerjaan dari Kategori ini:</b>
                                          @forelse($category->task->take(10) as $task)
                                            <p class="text-xs text-secondary mb-0">{{ $task->name }}</p>
                                          @empty
                                            <p class="text-xs text-danger mb-0">Kategori ini belum dipakai</p>
                                          @endforelse
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{Carbon::parse($category->created_at)->translatedFormat('l, d F Y');  }}</p>
                            </td>
                            <td class="align-middle">
                               <div class="d-flex">
                                <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn bg-gradient-secondary me-2" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                                </a>
                                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
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
                {{ $categories->links() }}
                </div>
              </div>
            </div>
    </div>
</div>

@endsection