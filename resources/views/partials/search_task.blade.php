<form action="" method="get">                  
    <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            <input class="form-control" type="text" name="search_name" value="{{ Request::get('search_name') }}" placeholder="Cari Nama">
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            <input class="form-control" type="month" name="search_month" value="{{ Request::get('search_month') }}">
        </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select name="search_category" class="form-select" id="search_category">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ Request::get('search_category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="col-md-2">
        <div class="form-group">
            <select name="search_status" class="form-select" id="search_status">
                <option value="">Pilih Status</option>
                <option value="2" {{ Request::get('search_status') == 2 ? 'selected' : '' }}>Kalah</option>
                <option value="1" {{ Request::get('search_status') == 1 ? 'selected' : '' }}>Menang / Berlanjut</option>
                <option value="3" {{ Request::get('search_status') == 3 ? 'selected' : '' }}>Selesai</option>

            </select>
        </div>
    </div>
        <div class="col">
        <button class="btn btn-success">Cari</button>
        </div>
    </div>
</form>