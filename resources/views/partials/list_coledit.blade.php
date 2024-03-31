@php 
    use Illuminate\Support\Carbon;

@endphp
<li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
    <div class="d-flex flex-column">
    <h6 class="mb-3 text-sm">{{ $label }}</h6>
    <span class="mb-2 text-xs">Diupload oleh: <span class="text-dark font-weight-bold ms-sm-2">{{ $uploader }}</span></span>
    <span class="mb-2 text-xs">Diupload tanggal: <span class="text-dark ms-sm-2 font-weight-bold">
        @if($tanggal)
            {{ Carbon::parse($tanggal)->translatedFormat('l, d F Y H:i:s'); }}
        @endif
    </span></span>
    </div>
    <div class="ms-auto text-end">
        <span class="btn btn-success" onclick="popUp('{{ $label }}', '{{ $directory }}', '{{ $uploader }}')">File</span>                         
            <a href="{{ $url }}" class="btn btn-danger" onclick="return confirm('Yakin mau delete?')">Delete</a>
    </div>
</li>