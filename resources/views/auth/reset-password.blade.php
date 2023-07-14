@extends('layout.auth')
@section('title')
Login
@endsection
@section('custom-style')
<style>
    .custom-border {
        border: 1px solid blue !important;
    }

    .custom-text-color--dark-blue {
        color: #00005c !important;
    }

    .custom-text-color--white {
        color: #ffffff !important;
    }

    .custom-background-color--dark-blue {
        background-color: #00005c !important;
    }

    .custom-background-color--white {
        background-color: #ffffff !important;
    }

    .custom-border-color--dark-blue {
        border-color: #00005c !important;
    }

    .custom-border-color--white {
        border-color: #ffffff !important;
    }
</style>
@endsection


@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="d-none d-md-block col-md-12 text-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{asset('img/logokonek.png')}}" alt="Logo" style="width: 15rem;">
            </a>
        </div>
        <div class="col-md-12 text-center custom-text-color--dark-blue " >
            <h2 class="my-4 my-md-0 custom-text-color--dark-blue"><b>WMS</b></h2>
        </div>
        <div class="col-md-4">
            <div class="card custom-border">
                <div class="card-body">
                    <form method="POST" action="{{ route('doResetPassword') }}" id="form-login">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col-12 mb-2 text-center">
                                <p>Password Recovery</p>
                            </div>
                            <div class="col-12 mb-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-2">
                                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autofocus placeholder="Username">
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-2 text-end">
                                <button type="submit" id="btn_request_password" name="btn_request_password" class="btn custom-background-color--dark-blue custom-border-color--dark-blue custom-text-color--white">
                                    Request Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="application/javascript">
    $(document).ready(function () {

    });
</script>
@endsection
