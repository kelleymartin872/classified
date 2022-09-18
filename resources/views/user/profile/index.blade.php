@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('user.sidebar')
            </div>
            <div class="col-md-5">
                @include('user.alert')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>

                        </button>
                        @foreach ($errors->all() as $errorMessage)
                            <li>{{ $errorMessage }}</li>
                        @endforeach
                    </div>
                @endif
            <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header text-white" style="background-color: red">Update profile</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Fullname</label>
                            <input type="text" class="form-control" name="name"  value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ auth()->user()->address }}">
                        </div>
                        <div class="form-group">
                            <label for="">Profile picture</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update profile</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-md-4">
                <form action="{{ route('user.password.update')}} " method="post">@csrf
                    <div class="card">
                        <div class="card-header text-white" style="background-color: red">Change password</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Current pasword</label>
                                <input type="password" name="old_password" class="form-control">
                                @error('old_password')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>New pasword</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm pasword</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">Update password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
