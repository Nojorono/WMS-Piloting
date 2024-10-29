@extends('layout.app')

@section("title")
Change Password
@endsection

@section("custom-style")
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex mb-2">
                        <h5 class="me-auto">Change User Password</h5>
                    </div>
                    <form method="POST" action="{{ route('user_change_password.update', ['id' => @$user->username]) }}" id="form-update-password">
                        @csrf
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="user_id" class="form-label text-xs">User ID</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="user_id" name="user_id" value="{{ $user->username ?? 'null' }}" readonly>
                                                <div id="validation_user_id" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="fullname" class="form-label text-xs">Fullname</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="fullname" name="fullname"  value="{{ $user->fullname ?? 'null' }}"   readonly>
                                                    <div id="validation_fullname" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="email" class="form-label text-xs">Email</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="email" name="email" value="{{ $user->email ? $user->email : 'null' }}" readonly>
                                                    <div id="validation_fullname" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="password" class="form-label text-xs">New Password</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="password" autocomplete="off" class="form-control py-0" id="password" name="password" value="" required>
                                                    <div id="validation_password" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary py-1 mb-0">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section("javascript")
<script src="{{ asset('js/plugins/choices.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function () {
    $("#dropdown_toggle_setting").prop('aria-expanded',true);
    $("#dropdown_toggle_setting").addClass('active');
    $("#dropdown_setting").addClass('show');
    $("#logo_setting").addClass("d-none");
    $("#logo_white_setting").removeClass("d-none");
    $("#li_change_user_password").addClass("active");
    $("#a_user_change_password").addClass("active");

    $("#form-update-password").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function (response) {

                    console.log('response', response);

                    if (response.success) {
                        const msg = response.message
                        Swal.fire({
                                position: "center",
                                icon: "success",
                                title: msg,
                                showConfirmButton: false,
                                timer: 1100
                        });

                        setTimeout(function() {
                            window.location = "{{ route('getLogout') }}";
                        }, 1100); 
                                         
                    } else if (response.error) {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: response.message,
                            showConfirmButton: true,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    alert("Error to change password");
                }
            });
        });

});
</script>
@endsection
