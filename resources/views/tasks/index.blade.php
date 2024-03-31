@extends('layouts.app')

@section('container')
@php 
    use Illuminate\Support\Carbon;
    $iterationNumber = ($tasks->currentPage() - 1) * $tasks->perPage() + 1;

    $title = "Tabel Pekerjaan";

    if(!Route::is('tasks.index')){
        $title = "Sampah Pekerjaan";
    }

@endphp
<div class="container-fluid py-4">
  @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <div class="row">
                    <div class="col">
                      <div class="d-flex">
                        <h6>{{ $title }}</h6>
                        @if(!Route::is('tasks.index'))
                          <a href="{{ route('tasks.index') }}" class="btn btn-primary ms-2">Kembali</a>
                        @endif
                      </div>
                    </div>
                    <!-- buttons -->
                    <div class="col">
                      <div class="text-end">
                        @if(Route::is('tasks.index'))
                            <a href="{{ route('taskTrash') }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Sampah</a>

                            <a href="{{ route('tasks.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Pekerjaan</a>
                        @else 
                            <!-- <a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete Semua</a> -->

                            <a href="" class="btn btn-success"><i class="fa fa-recycle" aria-hidden="true"></i> Restore Semua</a>
                        @endif
                      </div>
                    </div>
                  </div>
                <!-- search bar -->
                @include('partials.search_task', ['categories' => $categories])
                
              </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Pekerjaan</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Upload</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($tasks as $task)
                            @php
                              $trackStatus = tracker($task->status_pemenang, $task);
                            @endphp
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
                                    <h6 class="mb-0 text-sm">{{ $task->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $task->category->name }}</p>
                                </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{Carbon::parse($task->tanggal_upload)->translatedFormat('l, d F Y');  }}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm 
                                  @if($trackStatus == 'Kalah Lelang')
                                    bg-gradient-danger
                                  @elseif($trackStatus == 'Pekerjaan Selesai')
                                    bg-gradient-success
                                  @else
                                    bg-gradient-info
                                  @endif
                                  ">

                                  {{ $trackStatus }}
                                </span>
                                <div>
                                  {{ $task->loss_statement > 0 ? 'Peringkat: '. $task->loss_statement : '' }}
                                </div>
                            </td>

                            <td class="align-middle">
                               <div class="d-flex">
                               @if(Route::is('tasks.index'))
                                <a href="{{ route('tasks.show', ['task' => $task->id ]) }}" class="btn bg-gradient-info me-2" data-toggle="tooltip" data-original-title="Edit user">
                                Detail
                                </a>
                                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn bg-gradient-secondary me-2" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                                </a>
                                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="post">
                                  @csrf 
                                  @method('delete')
                                  <button onclick="return confirm('Yakin mau delete?')" class="btn bg-gradient-danger">Delete</button>
                                </form>
                               @else 
                                <form action="{{ route('restoreTrash', ['id' => $task->id]) }}" class="me-2" method="post">
                                    @csrf 
                                    <button class="btn bg-gradient-success">Restore</button>
                                  </form>
                                <form action="{{ route('deleteTrash', ['id' => $task->id]) }}" method="post">
                                    @csrf 
                                    <button onclick="return confirm('Yakin ingin delete secara permanen?')" class="btn bg-gradient-danger">Delete Permanen</button>
                                  </form>

                               @endif
                               </div>
                            </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  {{ $tasks->links() }}
                </div>
              </div>
            </div>
    </div>
    
</div>
@endsection