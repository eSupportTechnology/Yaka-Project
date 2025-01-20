@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Admin</h4>

                    @if (isset($usersuccess) && $usersuccess)
                        <div class="alert alert-success" role="alert">
                            {{$usersuccess}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                   {{ $error }}</li>
                                @endforeach
                        </div>
                    @endif

                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.admins.store')}}" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">First Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                            <div class="invalid-feedback error-container" id="first_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName">Last Name <span style="color: red">*</span></label>
                            <input type="text" required class="form-control" name="last_name" id="exampleInputLastName" value="{{ old('last_name') }}" placeholder="Last Name">
                            <div class="invalid-feedback error-container" id="last_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number <span style="color: red">*</span></label>
                            <input type="text" required class="form-control" name="number" id="exampleInputEmail1" value="{{ old('number') }}" placeholder="Phone Number ">
                            <div class="invalid-feedback error-container" id="email-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Roles <span style="color: red">*</span></label>
                            <select class="form-control" name="role" id="exampleFormControlSelect2">
                                <option value="{{ADMIN}}">Admin</option>
                                <option value="{{USER}}">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password <span style="color: red">*</span></label>
                            <input type="password" required class="form-control" name="password" id="exampleInputPassword1" value="{{ old('password') }}" placeholder="Password">
                            <div class="invalid-feedback error-container" id="password-error"></div>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('dashboard.admins') }}" class="btn btn-light">Cancel</a>

                        <!-- Error container -->
                        <div id="error-container"></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-6 grid-margin stretch-card" style="height: 315px;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">give admin access to user</h4>


                    @if (isset($success) && $success)
                        <div class="alert alert-success" role="alert">
                            {{$success}}
                        </div>
                    @endif
                    @if (isset($unsuccess) && $unsuccess)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endif

                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.admins.give-access')}}" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Users</label>
                            <select class="form-control" name="user" id="exampleFormControlSelect2">
                                <option>select user</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ." ".$user->last_name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Roles</label>
                            <select class="form-control" name="role" id="exampleFormControlSelect2">

                                <option value="{{ADMIN}}">Admin</option>
                                <option value="{{USER}}">User</option>
                            </select>
                        </div>
                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('dashboard.admins') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
