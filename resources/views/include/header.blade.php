<header id="header" class="header-effect-shrink"
        data-plugin-options="{'stickyEnabled': true, 'stickyEffect':
        'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true,
        'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0">
        <div class="header-top top-header-background">
            <div class="container">
                <div class="header-row py-2">
                    <div class="header-column justify-content-start">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                        <a style="letter-spacing: 1px;font-family:Montserrat;">{{  __('message.O6U COVID-19 CORONA VIRUS GUIDANCE')  }}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-column justify-content-end ">
                        <div class="header-row ">
                            <nav class="header-nav-top ">
                                <ul class="nav nav-pills ">
                                    <li class="nav-item nav-item-anim-icon d-none d-md-block ">
                                        <a class="btn btn-gradient btn-rounded font-weight-semibold px-4 ml-3 appear-animation " data-appear-animation="fadeIn " data-plugin-options="{ 'accY': 100} " href=" " target="_blank " style="font-family: Montserrat; font-weight: bold; font-size: 8pt;">{{  __('message.CORONA VIRUS UPDATES')  }}</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container container ">
            <div class="header-row ">
                <div class="header-column ">
                    <div class="header-row ">
                        <div class="header-logo ">
                            <a href="index.html ">
                                <img alt="O6U " width="100% " height="48 " data-sticky-height="40 " src="img/logo.png">
                            </a>
                        </div>

                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">
                    <li style="font-family:Montserrat; font-weight: 600; font-size:9pt; color:#093c71;">{{  __('message.Login')  }}</li>
                    <li class="changeLang" data-value="ar"><img src="img/Egypt copy 2.png" style="width:26px; height:20px;"></li>
                    <li class="changeLang" data-value="en"><img src="img/America (USA) copy 2.png" style="width:27px; height:21px;"></li>
                    <li class="changeLang" data-value="en"><img src="img/France copy 2.png" style="width:28px; height:21px;"></li>
                </ul>
                <script type="text/javascript">
                    var url = "{{ route('changeLang') }}";
                    $(".changeLang").on('click',function(){
                        window.location.href = url + "?lang="+ $(this).data('value');
                        console.log('%%%',$(this).data('value'))
                    });
                </script>
                <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">

                        <!-- Actual search box -->
                        <div class="form-group has-search" style="margin-bottom: 3px; ">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" >
                        </div>
                </div>
            </div>
        </div>
        <div class="header-nav-bar z-index-0" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'background-color': 'transparent'}" data-sticky-header-style-deactive="{'background-color': '#f7f7f7'}" style="background-color:#f28427;">
            <div class="container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row justify-content-end">
                            <div class="header-nav header-nav-stripe justify-content-start">
                                <div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills " id="mainNav ">
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle @yield('home')" href="{{url('/')}}">
                                                    {{  __('message.Home')  }}
                                                </a>
                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle" href="# ">
                                                    {{  __('message.About o6u')  }}
                                                </a>
                                                <ul class="dropdown-menu ">
                                                    <li>
                                                        <a class="dropdown-item " href="index.html ">
                                                            Landing Page
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item " href="index.html#demos ">
                                                            Demos
                                                        </a>
                                                    </li>

                                                    <li class="dropdown-submenu ">
                                                        <a class="dropdown-item " href="# ">Corporate <span class="tip tip-dark ">hot</span></a>
                                                        <ul class="dropdown-menu ">
                                                            <li><a class="dropdown-item " href=" ">Corporate - Version 1</a></li>
                                                            <li><a class="dropdown-item " href=" ">Corporate - Version 2</a></li>

                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown dropdown-mega ">
                                                <a class="dropdown-item dropdown-toggle " href="elements.html ">
                                                  {{  __('message.o6u Admission')  }}
                                                </a>
                                                <ul class="dropdown-menu ">
                                                    <li>
                                                        <div class="dropdown-mega-content ">
                                                            <div class="row ">
                                                                <div class="col-lg-3 ">
                                                                    <span class="dropdown-mega-sub-title ">Elements 1</span>
                                                                    <ul class="dropdown-mega-sub-nav ">
                                                                        <li><a class="dropdown-item " href=" ">Headings 1</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 2</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 3</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-3 ">
                                                                    <span class="dropdown-mega-sub-title ">Elements 2</span>
                                                                    <ul class="dropdown-mega-sub-nav ">
                                                                        <li><a class="dropdown-item " href=" ">Headings 1</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 2</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 3</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-3 ">
                                                                    <span class="dropdown-mega-sub-title ">Elements 3</span>
                                                                    <ul class="dropdown-mega-sub-nav ">
                                                                        <li><a class="dropdown-item " href=" ">Headings 1</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 2</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 3</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-3 ">
                                                                    <span class="dropdown-mega-sub-title ">Elements 4</span>
                                                                    <ul class="dropdown-mega-sub-nav ">
                                                                        <li><a class="dropdown-item " href=" ">Headings 1</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 2</a></li>
                                                                        <li><a class="dropdown-item " href=" ">Headings 3</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle @yield('faculty') " href="{{url('faculty')}}">
                                                      {{  __('message.Faculties')  }}
                                                </a>

                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle " href="# ">
                                                     {{  __('message.Student')  }}
                                                </a>

                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle " href="# ">
                                                     {{  __('message.Services')  }}
                                                </a>

                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle " href="# ">
                                                    {{  __('message.Credit Hours')  }}

                                                </a>

                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle " href="# ">
                                                    {{  __('message.Contact Us')  }}
                                                </a>

                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-item dropdown-toggle " href="# ">
                                                    {{  __('message.T.support')  }}
                                                </a>

                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
