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
<h1>{{ $task->name }}</h1>
<div>
    <b>Dibuat oleh: </b><span>{{ $task->user->name }}</span>
</div>
<div>
    <span> {{ Carbon::parse($task->tanggal_upload)->translatedFormat('l, d F Y');  }}</span>
</div>

<div>
    <span>{{ $task->category->name }}</span>
</div>
<hr>
<div>
    <h2>1. Penjelasan</h2>
    @if($penjelasanData != null)
    <div>
        <span>
            Diupload oleh:
            {{ $penjelasanData ? $penjelasanData['user_name'] : '' }}
        </span>
    </div>
    <div>
        <span>
            Tanggal Upload:
            {{ $penjelasanData ? $penjelasanData['date_uploaded'] : '' }}
        </span>
    </div>
    @else 
     <span>Dokument Belum diupload</span>
    @endif
</div>