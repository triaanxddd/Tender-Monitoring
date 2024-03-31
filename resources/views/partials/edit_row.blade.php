@php 
    use Illuminate\Support\Carbon;
@endphp
<tr>
    <th scope="row">{{ $number }}</th>
    <td style="width: 100px;">
    <div>
        {{ $title }}
    </div>
    <span>
        {{ $subTitle ?? '' }}
    </span>
    </td>
    <td>           
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
    </td>
    <td>
        @if($items->isNotEmpty())
            <div class="success-circle">
                <i class="ni ni-check-bold text-white" style="font-size: 25px;"></i>
            </div>
        @else 
            <div class="danger-circle">
                <i class="ni ni-fat-remove text-white" style="font-size: 25px;"></i>
            </div>  
        @endif
    </td>
</tr>
