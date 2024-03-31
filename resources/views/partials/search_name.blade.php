<form action="" method="get">                  
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <input class="form-control" type="text" name="search_name" value="{{ Request::get('search_name') }}" placeholder="Cari Nama">
        </div>
        </div>
        <div class="col">
        <button class="btn btn-success">Cari</button>
        </div>
    </div>
</form>