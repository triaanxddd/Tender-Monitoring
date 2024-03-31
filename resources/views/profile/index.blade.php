@extends('layouts.app')

@section('container')
<div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ $user->name }}
              </h5>
            </div>
          </div>
        </div>
      </div>
</div>
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
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <form action="{{ route('profileChange') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nama</label>
                      <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Email</label>
                      <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-success ">Ubah Profile</button>
                  </div>
                </div>
              </form>
              <hr class="horizontal dark">

              <p class="text-uppercase text-sm">Password</p>
              <form action="{{ route('updatePassword') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="show_hide_password">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>

                            <label for="example-text-input" class="form-control-label">Password</label>
                            <input class="form-control" name="password" type="password">
                            @error('password') 
                                <div style="color:red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"  id="show_hide_password">
                            <label for="example-text-input" class="form-control-label">Ketik Ulang Password</label>
                            <input class="form-control" name="repassword" type="password">
                            @error('repassword') 
                                <div style="color:red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end">
                    <button type="submit" class="btn btn-success ">Ubah Profile</button>
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