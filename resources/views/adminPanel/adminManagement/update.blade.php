@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">update your Details</h2>

                    @if (isset($success) && $success)
                        <div class="alert alert-success" role="alert">
                            {{$success}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    <form class="forms-sample" id="admin-form" method="post" action="{{'dashboard.admins.update-user', $user -> id}}" >
                        @csrf
                        <input type="hidden" value="{{$user -> id}}" name="user">
                        <div class="form-group">
                            <label for="exampleInputUsername1">First Name </label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="first_name" value="{{ old('first_name') ?? $user -> first_name }}" placeholder="First Name">
                            <div class="invalid-feedback error-container" id="first_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName">Last Name </label>
                            <input type="text" required class="form-control" name="last_name" id="exampleInputLastName" value="{{ old('last_name') ?? $user -> last_name  }}" placeholder="Last Name">
                            <div class="invalid-feedback error-container" id="last_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" required class="form-control" name="email" id="exampleInputEmail1" value="{{ old('email') ?? $user -> email  }}" placeholder="Email">
                            <div class="invalid-feedback error-container" id="email-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile Number </label>
                            <input type="text"  class="form-control" name="phone_number" id="exampleInputEmail1" value="{{ old('phone_number') ?? $user -> phone_number  }}" placeholder="phone_number">
                            <div class="invalid-feedback error-container" id="email-error"></div>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('dashboard.admins') }}" class="btn btn-light">Cancel</a>

                        <!-- Error container -->
                        <div id="error-container"></div>
                    </form>
                </div>
            </div>
        </div>

@endsection
