<style>
    [data-kt-app-layout=dark-sidebar] .app-sidebar .menu .menu-item .menu-link.active {
        transition: color .2s ease;
        background-color: #2fb46c;
        color: var(--bs-primary-inverse);
    }
</style>
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="#">
            <img alt="Logo" src="{{asset('assets/media/logos/default-dark.svg')}}"
                 class="h-25px app-sidebar-logo-default"/>
            <img alt="Logo" src="{{asset('assets/media/logos/default-small.svg')}}"
                 class="h-20px app-sidebar-logo-minimize"/>
        </a>
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">

                @if(Auth::user()->hasRole('admin') == 'admin')
                    <div class="menu-item  menu-accordion">
                        <div class="menu-link">
                            <a class="menu-link @if(Route::is('dashboard')) active @endif"
                               href="{{route('dashboard')}}">
													<span class="menu-bullet">
														<span class="fa fa-home-user fs-3 ms-1 me-5"></span>
													</span>
                                <span class="menu-title">Dashboards</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="menu-item  menu-accordion">
                        <div class="menu-link">
                            <a class="menu-link @if(Route::is('home')) active @endif"
                               href="{{route('home')}}">
													<span class="menu-bullet">
														<span class="fa fa-home-user fs-3 ms-1 me-5"></span>
													</span>
                                <span class="menu-title">Dashboards</span>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Menus</span>
                    </div>
                </div>
                {{--                <div class="menu-item  menu-accordion @if(Route::is('users.*')) show @endif">--}}
                {{--                    <div class="menu-link">--}}
                {{--                        <a class="menu-link @if(Route::is('users.*')) active @endif"--}}
                {{--                           href="{{route('users.index')}}">--}}
                {{--													<span class="menu-bullet">--}}
                {{--														<span class="fa fa-user fs-3"></span>--}}
                {{--													</span>--}}
                {{--                            <span class="menu-title">User</span>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                @if(Auth::user()->hasRole('admin') == 'admin')
                    <div class="menu-item  menu-accordion @if(Route::is('tickets.*')) show @endif">
                        <div class="menu-link">
                            <a class="menu-link @if(Route::is('tickets.*')) active @endif"
                               href="{{route('tickets.admin')}}">
													<span class="menu-bullet">
														<span class="fa fa-ticket fs-3"></span>
													</span>
                                <span class="menu-title">Ticket</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="menu-item  menu-accordion @if(Route::is('tickets.*')) show @endif">
                        <div class="menu-link">
                            <a class="menu-link @if(Route::is('tickets.*')) active @endif"
                               href="{{route('tickets.index')}}">
													<span class="menu-bullet">
														<span class="fa fa-ticket fs-3"></span>
													</span>
                                <span class="menu-title">Ticket</span>
                            </a>
                        </div>
                    </div>
                @endif


                @if(Auth::user()->hasRole('user') == 'user')

                    <div class="menu-item  menu-accordion @if(Route::is('replies.*')) show @endif">
                        <div class="menu-link">
                            <a class="menu-link @if(Route::is('replies.*')) active @endif"
                               href="{{route('replies.index')}}">
													<span class="menu-bullet">
														<span class="fa fa-reply-all fs-3"></span>
													</span>
                                <span class="menu-title">Ticket Reply</span>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
