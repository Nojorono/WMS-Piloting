<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('/') }}">
        <img src="{{ asset ('/img/logo-nojorono.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Nojorono</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 ">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {!! session('sidebar') !!}
            {{-- start dashboard --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}" id="dashboard">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center">
                        <img src="{{ asset ('/img/logo-nojorono.png')}}" width='21px' height='21px' alt="Logo">
                    </div>
                    <span class="nav-link-text ms-1">Dashboards</span>
                </a>
            </li> --}}
            {{-- end dashboard --}}

            {{-- start dashboard active --}}
            {{-- <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}" id="dashboard">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center">
                        <img src="{{ asset ('/img/logo-nojorono.png')}}" width='21px' height='21px' alt="Logo">
                    </div>
                    <span class="nav-link-text ms-1">Dashboards</span>
                </a>
            </li> --}}
            {{-- end dashboard active --}}

             {{-- start inbound  --}}
             {{-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dropdown_Inbound" class="nav-link" id="dropdown_toggle_Inbound" aria-controls="dropdown_Inbound" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center ">
                        <img src="{{ asset ('/img/logo-nojorono.png')}}" width='21px' height='21px' alt="Logo">
                    </div>
                    <span class="nav-link-text ms-1">Inbound</span>
                </a>
                <div class="collapse" id="dropdown_Inbound">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item" id="li_inbound_planning">
                            <a class="nav-link" href="#" id="a_inbound_planning">
                                <span class="sidenav-mini-icon">Inbound Planning</span>
                                <span class="sidenav-normal">Inbound Planning</span>
                            </a>
                        </li>
                        <li class="nav-item" id="li_goods_receiving">
                            <a class="nav-link" href="#" id="a_goods_receiving">
                                <span class="sidenav-mini-icon"> Goods Receiving </span>
                                <span class="sidenav-normal"> Goods Receiving </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{-- end inbound  --}}

            {{-- start inbound and inbound planning active --}}
            {{-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dropdown_Inbound" class="nav-link active" id="dropdown_toggle_Inbound" aria-controls="dropdown_Inbound" role="button" aria-expanded="true">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center ">
                        <img src="{{ asset ('/img/logo-nojorono.png')}}" width='21px' height='21px' alt="Logo">
                    </div>
                    <span class="nav-link-text ms-1">Inbound</span>
                </a>
                <div class="collapse  show " id="dropdown_Inbound">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item active" id="li_inbound_planning">
                            <a class="nav-link active" href="#" id="a_inbound_planning">
                                <span class="sidenav-mini-icon">Inbound Planning</span>
                                <span class="sidenav-normal">Inbound Planning</span>
                            </a>
                        </li>
                        <li class="nav-item " id="li_goods_receiving">
                            <a class="nav-link " href="#" id="a_goods_receiving">
                                <span class="sidenav-mini-icon"> Goods Receiving </span>
                                <span class="sidenav-normal"> Goods Receiving </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{-- end inbound and inbound planning active --}}

            {{-- start inbound and Goods Receiving active --}}
            {{-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dropdown_Inbound" class="nav-link active" id="dropdown_toggle_Inbound" aria-controls="dropdown_Inbound" role="button" aria-expanded="true">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center ">
                        <img src="{{ asset ('/img/logo-nojorono.png')}}" width='21px' height='21px' alt="Logo">
                    </div>
                    <span class="nav-link-text ms-1">Inbound</span>
                </a>
                <div class="collapse  show " id="dropdown_Inbound">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item" id="li_inbound_planning">
                            <a class="nav-link" href="#" id="a_inbound_planning">
                                <span class="sidenav-mini-icon">Inbound Planning</span>
                                <span class="sidenav-normal">Inbound Planning</span>
                            </a>
                        </li>
                        <li class="nav-item active" id="li_goods_receiving">
                            <a class="nav-link active" href="#" id="a_goods_receiving">
                                <span class="sidenav-mini-icon"> Goods Receiving </span>
                                <span class="sidenav-normal"> Goods Receiving </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{-- end inbound and Goods Receiving active --}}
        </ul>
    </div>
</aside>
