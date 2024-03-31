@extends('layouts.app')

@section('container')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
          @if(session()->has('danger'))
            <div class="alert alert-danger text-white" role="alert">
                {{ session('danger') }}
            </div>
        @endif
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Tambah Member Baru</p>
              </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name" class="form-control-label">Nama Member</label>
                          <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                          @error('name') 
                                <div style="color:red;">
                                    {{ $message }}
                                </div>
                         @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email" class="form-control-label">Email</label>
                          <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                          @error('email') 
                                <div style="color:red;">
                                    {{ $message }}
                                </div>
                         @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group" id="show_hide_password">
                          <label for="password" class="form-control-label">Password</label>
                          <input class="form-control" type="password" name="password" value="{{ old('password') }}">
                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                          @error('password') 
                                <div style="color:red;">
                                    {{ $message }}
                                </div>
                         @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group" id="show_hide_password">
                          <label for="repassword" class="form-control-label">Password Ketik Ulang</label>
                          <input class="form-control" type="password" name="repassword" value="{{ old('repassword') }}">
                          @error('repassword') 
                                <div style="color:red;">
                                    {{ $message }}
                                </div>
                         @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="repassword" class="form-control-label">Role</label>
                          <select class="form-select" aria-label="Default select example" id="role" name="role">
                            <option selected>Pilih</option>
                            <option value="0" {{ old('role') == '0' ? 'selected':'' }}>Member Biasa</option>
                            <option value="1"  {{ old('role') == '1' ? 'selected':'' }}>Admin</option>

                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            console.log('aku jalan');
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
</script>
@endsection
