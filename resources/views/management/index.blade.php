@extends('layouts.app')

@section('container')
    <div class="container-fluid py-4">
    <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0 mb-4">
                  <div class="row">
                    <div class="col">
                      <div class="d-flex">
                        <h4>Ringkasan Pekerjaan</h4>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @foreach($categories as $category)
                        <div class="px-4">
                            <div class="title-name row">
                                <div class="col headline">
                                    <h6 style="color:#6c757d;">{{ $category->name }}</h6> 
                                    <hr class="horizontal dark">
                                </div>
                                <div class="col">
                                    <i class="fa fa-angle-down float-end icon"></i>
                                </div>
                            </div>
                            
                            <div class="table-responsive pb-5 sub-div">
                                <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pekerjaan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->task as $task)
                                    @php
                                        $trackStatus = tracker($task->status_pemenang, $task);
                                    @endphp
                                        <tr>
                                        <td style="width: 10px;"> 
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    {{ $loop->iteration }}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 500px;">
                                            <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                            <div class="dropdown">
                                                <h6 class="mb-0 text-sm">{{ $task->name }}</h6>
                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                        <td class="text-sm">
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


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Display Pagination Links -->
                            {{ $category->task->links() }}
                        </div>
                        </div>
                    @endforeach
                </div>
              </div>
            </div>
    </div>

@endsection