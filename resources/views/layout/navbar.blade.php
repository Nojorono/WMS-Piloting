<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky bg-white" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="me-3">
            <div class="text-xs">Welcome ,</div>
            <div class="text-xs">
                {{ @session("fullname") }}
            </div>
        </div>
        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none">
            <a href="javascript:;" class="nav-link text-body p-0">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-auto justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
                </a>
            </li>
            <li class="nav-item px-3">
                <!-- <div class="dropdown-center">
                    <div data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" role="button" style="font-size: 1.5rem;" id="btn_dropdown_message">
                        <i class="bi bi-chat-right-dots-fill"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border shadow-lg overflow-auto p-3 py-0" style="width: 400px; max-height: 35vh;" role="menu" id="dropdown_message_container" >
                        {{-- @for($i = 0; $i < 3; $i++)
                        <li class="border-top border-bottom py-2">
                            <div class="row" style="{{ ($i==0) ? 'background-color: rgba(203, 12, 159, .1)' : '' }}">
                                <div class="col">
                                    <span>
                                        <span>Please inbound for details of this item</span> </br>
                                        <span>Client Project Name: Toshiba</span> </br>
                                        <span>Supplier Name: test</span> </br>
                                        <span>SKU: ABC123</span> </br>
                                        <span>Available Qty: 33</span>
                                    </span>
                                </div>
                                <div class="col-3 d-flex flex-column-reverse justify-content-between">
                                    <span class="text-end">
                                        10/05/2023
                                    </span>
                                    @if ($i == 0)
                                    <div class="text-end pt-1">
                                        <span class="badge bg-primary rounded-circle" style="width: 20px; height:20px;">

                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endfor --}}
                    </ul>
                </div> -->
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
                <!-- <select name="client_project_id" id="client_project_id" class="form-select py-0">
                    @if (count(session('arr_client_project')) > 0 && !empty(session('current_client_project_id')))
                    @foreach ( session('arr_client_project') as $client_project )
                    @php
                        $selected_client_project_id = "";
                        if($client_project->client_project_id == session('current_client_project_id')){
                            $selected_client_project_id = "selected";
                        }
                    @endphp
                        <option value="{{ $client_project->client_project_id }}" {{ $selected_client_project_id}}> {{ $client_project->client_project_name }}</option>
                    @endforeach
                    @endif
                    
                </select> -->
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="{{ route('getLogout') }}" class="nav-link text-body p-0 ">
                    <span class="text-xs">
                        Logout
                    </span>
                </a>
            </li>
            </ul>
            
        </div>
    </div>
</nav>
<!-- End Navbar -->