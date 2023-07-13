<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset("/img/apple-icon.png") }}">
    <link rel="icon" type="image/png" href="{{ asset("/img/favicon.png") }}">
    <title>
        @yield('title')
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Fonts and icons End -->
    <!-- Nucleo Icons -->
    <link href="{{ asset("/css/nucleo-icons.css") }}" rel="stylesheet" />
    <link href="{{ asset("/css/nucleo-svg.css") }}" rel="stylesheet" />
    <!-- Nucleo Icons End-->
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset("/css/nucleo-svg.css") }}" rel="stylesheet" />
    <!-- Font Awesome Icons End-->
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset("/css/soft-ui-dashboard.css") }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons_1.8.3.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset("DataTables/datatables.min.css") }}"/> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset("DataTables/custom_with_softui_datatables.css") }}"/>
    <!-- CSS Files End-->
    @yield('custom-style')
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include("layout.sidebar")
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include("layout.navbar")
        <div class="container-fluid py-4">
            @yield("content")
        </div>
    </main>
    <!-- Core JS Files -->
    <script src="{{ asset("/js/core/popper.min.js") }}"></script>
    <script src="{{ asset("/js/core/bootstrap.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/perfect-scrollbar.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/smooth-scrollbar.min.js") }}"></script>
    <!-- End Core JS Files -->
    <!-- Kanban scripts -->
    <script src="{{ asset("/js/plugins/dragula/dragula.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/jkanban/jkanban.js") }}"></script>
    <script src="{{ asset("/js/plugins/chartjs.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/threejs.js") }}"></script>
    <script src="{{ asset("/js/plugins/orbit-controls.js") }}"></script>
    <!-- End Kanban scripts -->
    <!-- Additional Scripts -->
    <script src="{{ asset("/js/jquery-3.6.1.js") }}"></script>
    <!-- End Additional Scripts -->
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
        damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Github buttons End-->
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset("/js/soft-ui-dashboard.js") }}"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc End-->

    <!-- Javascript Datatables start -->
    <script src="{{ asset("DataTables/datatables.min.js") }}"></script>
    <!-- Javascript Datatables start -->
    <!-- Javascript sweetalert start -->
    <script src="{{ asset("/js/plugins/sweetalert.min.js") }}"></script>
    <!-- Javascript sweetalert start -->
    <script type="application/javascript">
        $("#client_project_id").on("change",function() {
            const client_project_id = $("#client_project_id").val();
            const _token = $("meta[name='csrf-token']").prop('content');
            $.ajax({
                url: "{{ route('change_client_project_id') }}",
                method: "POST",
                data: {
                    client_project_id : client_project_id,
                    _token : _token,
                },
                dataType: 'json',
                beforeSend: function () {
                    
                },
                error: function (error) {
                    alert('Something Wrong');
                },
                complete: function () { 

                },
                success: function (response) {
                    if(typeof response !== 'object'){
                        alert('Something Wrong');
                        window.location.reload();
                        return;
                    }

                    if(response.err){
                        alert(`${response.message}`);
                        window.location.reload();
                        return;
                    }

                    alert(response.message);
                    window.location.reload();
                    return;

                },
            });
        });
    </script>
    <script type="application/javascript">
        $(document).ready(function () {
            $("#btn_dropdown_message").on("click",function () {
                const _token = $("meta[name='csrf-token']").prop('content');
                const formData = new FormData();
                
                formData.append("_token",_token);
                
                $.ajax({
                    url: "{{ route('get_message') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend: function () {
                        $("#dropdown_message_container").html("");
                        $("#dropdown_message_container").html("Loading");
                    },
                    error: function (error) {
                        console.log('Something Wrong');
                    },
                    complete: function () { 

                    },
                    success: function (response) {
                        if(typeof response !== 'object'){
                            console.log('Something Wrong');
                            return;
                        }

                        if(response.err){
                            console.log(`${response.message}`);
                            return;
                        }

                        let html_dropdown_message_container = ``;
                        const html_badge = `
                        <div class="text-end pt-1">
                            <span class="badge bg-primary rounded-circle" style="width: 20px; height:20px;">

                            </span>
                        </div>`;
                        if('data' in response && response.data.length > 0){
                            response.data.forEach(element => {
                                html_dropdown_message_container +=`<li class="border-top border-bottom py-2">
                            <div class="row" style="${(element.is_read == "Y") ? "background-color: rgba(203, 12, 159, .1)": ""}">
                                <div class="col">
                                    <span>
                                       ${element.messages}
                                    </span>
                                </div>
                                <div class="col-3 d-flex flex-column-reverse justify-content-between">
                                    <span class="text-end">
                                        ${element.date_created}
                                    </span>
                                    ${(element.is_read == "Y") ? html_badge :""}
                                </div>
                            </div>
                        </li>`;
                            });
                        }
                       

                        $("#dropdown_message_container").html(html_dropdown_message_container);
                        return;

                    },
                });
            });
        });
    </script>
    @yield("javascript")
</body>

</html>