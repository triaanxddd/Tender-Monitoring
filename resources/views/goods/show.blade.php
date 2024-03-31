@extends('layouts.app')

@section('container')
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
    
    <div class="card">
        <div class="card-header pb-0">
            <div>
                <a href="{{ route('goods.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <h6>{{ $good->name }}</h6>
            <span class="text-md">Total: <b>{{ $good->total }}</b> </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Permintaan</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demandedGoods as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->task->name }}</td>
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
                                        $idValue = ['id' => $item->id]
                                    @endphp
                                    <form action="{{ $item->approval == 1 ? route('goods-disapprove', $idValue) : route('goods-approve', $idValue) }}" method="post">
                                        @csrf
                                        <button type="submit" href="" class="btn btn-secondary py-1 px-3" onclick="return confirm('Yakin ingin ubah?')">
                                            {{ $item->approval == 1 ? 'Batalkan' : 'Setujui'  }}
                                        </button>
                                    </form>
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
            {{ $demandedGoods->links() }}
        </div>
    </div>
</div>
@endsection