@extends('adminPanel.layout.layout')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">


                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">delete User </h4>
                <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.users.delete-user', $user -> id)}}" >
                    @csrf
                    <input type="hidden" name="user" value="{{$user->id}}">
                    <div style=" border-bottom: 1px solid #e3e3e3;" class="form-group">
                        <p style="font-size: 13px;margin-left: 20px;">Are you sure you want to delete?</p>
                    </div>

                    <button style="background: red;border: none;"  class="btn btn-primary me-2">Delete</button>
                    <a href="{{route('dashboard.users')}}" class="btn btn-light">Cancel</a>
                </form>

            </div>
        </div>
    </div>
@endsection
