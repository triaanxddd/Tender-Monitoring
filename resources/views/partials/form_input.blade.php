<div class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
    <div class="{{ $columnSize }}">
        @if( $type == "select" )
        <div class="form-group">
            <label for="category_id">{{ $label }} <span style="color:red;">{{ $required ?? '' }}</span></label>
            <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                <option selected>Pilih Kategori</option>
                @foreach($items as $item)
                    @if($selected != null)
                        <option value="{{ $item->id }}" {{ $item->id == $selected ? 'selected' : '' }}>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @else
            <div class="form-group">
                <label for="{{ $name }}" class="form-control-label">{{ $label }} <span style="color:red;">{{ $required ?? '' }}</span></label>
                <input class="form-control @error($name) is-invalid  @enderror" 
                {{ $multiple ?? '' }} 
                type="{{ $type }}" 
                value="{{ $value ?? '' }}" 
                name="{{ $name }}" 
                id="{{ $name }}" 
                {{ $attribute ?? ''}}>
            </div>

        @endif
        @error($name) 
            <div style="color:red;">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>