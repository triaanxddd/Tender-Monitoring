@php 
    use Illuminate\Support\Carbon;
@endphp
<div class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
    <div class="d-flex flex-column">
        <h6 class="mb-3 text-sm">{{ $title }}</h6>

        @foreach($items as $item)
            @php
                $directory = asset('storage') .'/' . $item->file;
            @endphp
            <div class="d-flex">
                <div class="m-2">
                    <span class="btn btn-success" onclick="popUp('{{ $title }}', '{{ $directory }}', '{{ $item->user_name }}')">File</span>
                    <a href="{{ route('deleteFileSubTask', ['subtask' => $attribute, 'id' => $item->id]) }}" onclick="return confirm('Yakin mau hapus?')" class="btn btn-danger">Delete</a>
                </div>
                <div class="m-2">
                    <div>
                        <span>Diupload oleh : {{ $item->user_name }}</span>
                    </div>
                    <div>
                        <span style="font-size:13px;">{{ Carbon::parse($item->created_at)->translatedFormat('l, d F Y, H:i:s') }} </span>
                    </div>
                </div>
            </div>  
        @endforeach
        <div>
            <input type="file" name="{{ $attribute }}[]" multiple class="form-control">
            @error('{$attribute}.*')
                <div style="color:red;">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>