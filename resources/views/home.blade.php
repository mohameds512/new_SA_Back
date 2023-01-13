@extends('app')
@section('home','active')
@section('content')
{{-- arabic section --}}
    <div role="main " class="main " id="main">
        <section class="page-header page-header-modern page-header-background page-header-background-md py-0     "
             id="main-section">
            <div class="container ">
                <div class="row ">
                    @if(app()->getLocale() =='ar')

                    <div class="col-sm-12 col-md-6  order-2 order-sm-1 align-self-center p-static" id="main-section-col1">

                        <div>

                            <h1 style="color:#f28427; font-family: Raleway; font-weight: bold; font-size:50px; " id="main-section-col1-div-h1"> جامعة
                            </h1>
                            &nbsp;
                            <h1 style="font-family: 'Raleway'; font-weight: bold; font-size:50px;" id="main-section-col1-div-h1"> 6 أكتوبر </h1>
                        </div>

                        {{-- <hr style="width:50%;text-align:right;margin-left:70%; background-color:white;"> --}}
                        <img src="img/faculties/rec.png" style="transform: scalex(-1);">

                        <div>
                            <span style=" color:white; font-size: 38px; font-weight:300;" id="main-section-col1-div-h1">رائد التعليم    </span>
                            <br>
                            <span style="font-weight:500; color:white; font-size:38px" id="main-section-col1-div-h1"> الجامعى الخاص في مصر</span>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-6 order-1 order-sm-2 align-items-end justify-content-start d-flex pt-5 " id="main-section-col2">
                        <div style="min-height: 350px; padding-top:13% !important;padding-right:0% !important; " class="overflow-hidden  w-100 ">
                                <form action="/" id="frmSignIn" method="post" class="needs-validation" novalidate="novalidate">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <input type="text" value="" class="form-control form-control-lg text-4" required="" 
                                            placeholder="{{  __('message.UserName*')  }}" id="input-sign">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <input type="password" value="" class="form-control form-control-lg text-4" required="" 
                                            placeholder="{{  __('message.Password*')  }}" id="input-sign" >
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <button type="submit" class="  btn-block  rounded-0  text-3  login-button" data-loading-text="Loading..." id="login">
                                                {{  __('message.Login')  }} &nbsp;<a><i class="icon-arrow-left icons" style="font-weight: bold; font-size:15px;"></i>
                                                    <span class="name"></span></a>
                                            </button>

                                        </div>

                                    </div>
                                </form>
                        </div>
                    </div>
                    @else
                    <div class="col-sm-12 col-md-6 order-2 order-sm-1 align-self-center p-static ">

                        <div>
                            <h1 style="font-family: Raleway; font-weight: bold; font-size:40px;" id="main-section-col1-div-h1">OCTOBER 6</h1>
                            &nbsp;
                            <h1 style="color:#f28427; font-family: Raleway; font-weight: bold; font-size:40px; " id="main-section-col1-div-h1"> UNIVERSITY
                            </h1>
                        </div>

                        <img src="img/faculties/rec.png" >

                        <div>
                            <span style=" color:white; font-size: 28px; font-weight:300; font-family: Raleway;" id="main-section-col1-div-h1">PIONEER OF PRIVATE </span>
                            <br>
                            <span style="font-weight:bold; color:white; font-size:27px;font-family: Raleway;" id="main-section-col1-div-h1"> UNIVERSITY EDUCATION IN EGYPT</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 order-1 order-sm-2 align-items-start justify-content-start d-flex pt-5 ">
                        <div style="min-height: 350px; padding-top:13% !important" class="overflow-hidden w-100">
                                <form action="/" id="frmSignIn" method="post" class="needs-validation w-100" novalidate="novalidate">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <input type="text" value="" class="form-control form-control-lg text-4" required="" 
                                            placeholder="{{  __('message.UserName*')  }}" id="input-sign" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <input type="password" value="" class="form-control form-control-lg text-4" required=""
                                             placeholder="{{  __('message.Password*')  }}" id="input-sign">
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col">
                                            <button type="submit" class="  btn-block  rounded-0  text-3  login-button" data-loading-text="Loading..." id="login">
                                                {{  __('message.Login')  }} &nbsp;<a><i class="icon-arrow-right icons" 
                                                    style="font-weight: bold; font-size:15px;"></i>
                                                    <span class="name"></span></a>
                                            </button>

                                        </div>
                                    </div>
                                </form>


                        </div>
                    </div>
                    @endif

                   
                </div>
            </div>

        </section>
    </div>
    {{-- end arabic section --}}
       

  {{------------------------slideeeeeeeeeeeeeeeeeeer faculties-----------------------------------------------------------}}

    {{--  arabic section slider --}}

    <div class="container" >
        <div class="row">
            <div class="col p-0">
                @if(app()->getLocale() =='ar')

                <div class="owl-carousel owl-theme stage-margin nav-style-1 owl-loaded owl-drag owl-carousel-init"
                    data-plugin-options="{'items': 4, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 10}"
                    style="height: auto;">
                @else
                <div class="owl-carousel owl-theme stage-margin nav-style-1 owl-loaded owl-drag owl-carousel-init"
                    data-plugin-options="{'items': 4, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}"
                    style="height: auto;">
                @endif

                    <div class="owl-stage-outer"  id="owl-stage-outer-faculties">
                        <div class="owl-stage">

                            <div class="owl-item active" id="owl-item-faculties"
                                style="width: 384.01px ! important; margin-right: 10px; height: 316px ! important;">
                                <div style="background-color:#093c71">
                                    <!-- <img style="height:131.01px; opacity: 50%;  position: absolute; top: 0px; left: 0px; background-color:#001448" alt="" class="img-fluid "> -->
                                    <div class="rectangle1"></div>
                                    <div class="rectangle"></div>
                                    <h4 id="owl-stage-h4">
                                        {{  __('message.Faculty of Applied Arts')  }}</h4>
                                    <img alt=" " class="img-fluid " src="img/faculties/fac1.png "
                                        style="height: 304px;">
                                </div>
                            </div>
                            <div class="owl-item active" id="owl-item-faculties">
                                <div style="background-color:#093c71">
                                    <!-- <img style="height:131.01px; opacity: 50%;  position: absolute; top: 0px; left: 0px; background-color:#001448" alt="" class="img-fluid "> -->
                                    <div class="rectangle1"></div>
                                    <div class="rectangle"></div>
                                    <h4 id="owl-stage-h4">
                                        {{  __('message.Faculty of Applied Health')  }}</h4>
                                    <img alt=" " class="img-fluid " src="img/faculties/fac2.png "
                                        style="height: 304px;">
                                </div>
                            </div>
                            <div class="owl-item active" id="owl-item-faculties">
                                <div style="background-color:#093c71">
                                    <!-- <img style="height:131.01px; opacity: 50%;  position: absolute; top: 0px; left: 0px; background-color:#001448" alt="" class="img-fluid "> -->
                                    <div class="rectangle1"></div>
                                    <div class="rectangle"></div>

                                    <h4 id="owl-stage-h4">
                                        {{  __('message.Faculty of Media & Mass')  }}
                                    </h4>
                                    <img alt=" " class="img-fluid " src="img/faculties/fac3.png "
                                        style="height: 304px;">
                                </div>
                            </div>
                            <div class="owl-item active" id="owl-item-faculties">
                                <div style="background-color:#093c71">
                                    <!-- <img style="height:131.01px; opacity: 50%;  position: absolute; top: 0px; left: 0px; background-color:#001448" alt="" class="img-fluid "> -->
                                    <div class="rectangle1"></div>
                                    <div class="rectangle"></div>
                                    <h4 id="owl-stage-h4">
                                        {{  __('message.Faculty of Medicine')  }} </h4>
                                    <img alt=" " class="img-fluid " src="img/faculties/fac4.png "
                                        style="height: 304px;">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="owl-nav " style="font-size:20px;">
                        <button type="button " role="presentation " class="owl-prev disabled "
                            style=" left: -34px;  "></button>
                        <button type="button " role="presentation " class="owl-next " style="right: -34px; "></button>
                    </div>
                    <div class="owl-dots disabled "></div>
                </div>
            </div>
        </div>
    </div>
    {{-- end arabic section --}}
    

  {{------------------------slideeeeeeeeeeeeeeeeeeer news-----------------------------------------------------------}}

    <div class="container">
        <div class="row mt-5 pb-0" style=" margin: auto; height: auto;" id="layout-news">
            <div class="col" style="height: 106%; background-color: antiquewhite;" id="layout-news-col" >

                <div class="owl-carousel owl-theme show-nav-title  mb-0 owl-loaded owl-drag owl-carousel-init custom_icon"
                    data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'items': 1, 'margin': 15, 'loop': false, 'nav': true, 'dots': false}"
                     id="owl-carousel-layout">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.25s ease 0s; width: 2614px;">

                            <div class="owl-item active " style="width: 100%;">
                                <div>
                                    <div class="row" id="news-row">
                                        <div class="col-4 col-sm-12 col-xs-12 col-md-4" id="news-img-div">
                                            <img src="img/faculties/dr.png">
                                        </div>
                                        <div class="col-lg-8 col-sm-12 col-xs-12 col-md-8" style="background-color:#093c71">
                                            <p style="" id="news-title">
                                           {{  __('message.Prof')  }}
                                            </p>
                                            <p  id="news-news">
                                              {{  __('message.prof_news')  }}
                                            </p>
                                            <button type="button" class="btn btn-primary rounded-0 mb-2" id="read-more-button"> {{  __('message.Read More')  }} <a>
                                                @if(app()->getLocale() =='ar')
                                                <i class="icon-arrow-left icons" style="font-weight: bold;"></i>
                                                @else
                                                <i class="icon-arrow-right icons" style="font-weight: bold;"></i>
                                                @endif
                                                <span class="name"></span></a></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
{{-- 
                            <div class="owl-item active " style="width: 100%; height: 504px;">
                                <div>
                                    <div class="row">
                                        <div class="col-4" id="news-img-div">
                                            <img src="img/faculties/dr.png">
                                        </div>
                                        <div class="col-8" style="background-color:#093c71">
                                            <p style="color:white; font-size: 21px;
                                            margin: 90px 85px 16px 30px;
                                            letter-spacing: 1px;
                                            font-family: fangsong;
                                            line-height: 35px;">
                                            Prof. Dr. Ahmed Zaki Badr: Chairman of the follow- up Committee of
                                                decision implementation of the Supreme Council of Private
                                                and National Universities
                                            </p>
                                            <p style="color:#d4d4d4; font-size: 15px;
                                                margin: 18px 40px 16px 30px;
                                                letter-spacing: 1px;
                                                font-family: fangsong;
                                                line-height: 18px;">
                                                The Supreme Council of Private and National Universities decided to form
                                                 a committee to follow up  the implementation of the council’s decisions.
                                                 The committee is headed by Prof. Dr. Ahmed Zaki Badr, former Minister of Education
                                                 and  Local Development and Chairman of the Board of Trustees of October 6 University and the membership of : Dr. Siddeek Abdel Salam,
                                                 Secretary of the Council of Private and National Universities (member and rapporteur),
                                                 Dr. Ashraf Al Shehhi, President of the Egyptian Chinese University,
                                                 Dr. Ahmed Sameh Farid, President of New Giza University, Dr. Obadah Sarhan, President of the  Future University ,
                                                 Dr. Muhammad Hassan Al Azazi, President of Misr University for Science and Technology, Dr. Yahya Al-Mashad,
                                                  President of Delta University for Science and Technology, Dr. Ahmed Hamad, President of the British University in Egypt, Dr. Mustafa Kamal,
                                                  President of Badr University, Dr. Mohamed Lotif, Secretary of theSupreme Council of Universities.
                                            </p>
                                            <button type="button" class="btn btn-primary rounded-0 mb-2" style="border-color: #001448 #001448 #001448 ! important; position: absolute;
                                            bottom:7%;
                                            right: 7%; font-size:18px;">Read More <a><i class="icon-arrow-right icons" style="font-weight: bold;"></i><span class="name"></span></a></button>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    <div class="owl-nav">
                        <button type="button " role="presentation " class="owl-prev disabled ">

                        </button><button type="button " role="presentation " class="owl-next  "></button>
                    </div>
                    <div  id="news-header">
                        {{  __('message.Keep up-to-date with all the latest O6U news')  }} 
                    </div>

                    <div class="owl-dots disabled "></div>
                </div>
            </div>
        </div>


    </div>

  {{------------------------cards-----------------------------------------------------------}}

    <div class="container  ">

        {{-- <div class="row ">
            <div class="col "> --}}
                <div class="row mt-5">
                    <div class="col">
                        <div class="row" >
                            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0"   id="info-card1">
                                <article class="post post-large pb-5">
                                    <div class="post-image">

                                        <div class="owl-carousel custom_dots owl-theme show-nav-hover dots-inside nav-inside nav-style-1 nav-light owl-loaded owl-drag owl-carousel-init"
                                            data-plugin-options="{'items': 1, 'margin': 10, 'loop': false, 'nav': false, 'dots': true}"
                                            style="height: auto;">

                                            <div class="owl-stage-outer">
                                                <div class="owl-stage"
                                                    style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1082px;">
                                                    <div class="owl-item active"
                                                        style="width: 350.344px; margin-right: 10px;">
                                                        <div>
                                                            <div class="post-image" style="margin-left:auto;">
                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                    <video class="embed-responsive-item" autoplay=""
                                                                        muted="" loop="" controls="">
                                                                        <source src="img/faculties/video.mp4"
                                                                            type="video/mp4">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="post-content">

                                                            <p class="ml-4 mr-3">{{  __('message.video1')  }}</p>
                                                            <br>
                                                            <p class="ml-4 mr-3"><strong
                                                                    style="font-size:19px; color:black;">{{  __('message.Dr.Gamal Samy')  }}</strong> &nbsp;
                                                                <a href="" class="text-decoration-none" style="font-size:13px;">
                                                                    {{  __('message.National Reading Programme')  }} </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="owl-item active"
                                                        style="width: 350.344px; margin-right: 10px;">
                                                        <div>
                                                            <div class="post-image" style="margin-left:auto;">
                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                    <video class="embed-responsive-item" autoplay=""
                                                                        muted="" loop="" controls="">
                                                                        <source src="img/faculties/video.mp4"
                                                                            type="video/mp4">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="post-content">

                                                            <p class="ml-4 mr-3">{{  __('message.video1')  }}</p>
                                                            <br>
                                                            <p class="ml-4 mr-3"><strong
                                                                    style="font-size:19px; color:black;">{{  __('message.Dr.Gamal Samy')  }}</strong> &nbsp;
                                                                <a href="" class="text-decoration-none" style="font-size:13px;">
                                                                    {{  __('message.National Reading Programme')  }} </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="owl-item "
                                                        style="width: 350.344px; margin-right: 10px;">
                                                        <div>
                                                            <div class="post-image" style="margin-left:auto;">
                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                    <video class="embed-responsive-item" autoplay=""
                                                                        muted="" loop="" controls="">
                                                                        <source src="img/faculties/video.mp4"
                                                                            type="video/mp4">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="post-content">

                                                            <p class="ml-4 mr-3">{{  __('message.video1')  }}</p>
                                                            <br>
                                                            <p class="ml-4 mr-3"><strong
                                                                    style="font-size:19px; color:black;">{{  __('message.Dr.Gamal Samy')  }}</strong> &nbsp;
                                                                <a href="" class="text-decoration-none" style="font-size:13px;">
                                                                    {{  __('message.National Reading Programme')  }} </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>

                                            <br>

                                            <div class="owl-dots "><button role="button "
                                                    class="owl-dot active "><span></span></button><button role="button "
                                                    class="owl-dot "><span></span></button><button role="button "
                                                    class="owl-dot "><span></span></button></div>
                                        </div>
                                    </div>


                                </article>
                            </div>
                            
                            {{-- <div class="col-md-6 col-lg-4 mb-5 mb-lg-0 " style="background-color:#001448;  border-bottom: 23px solid #f28427;" id="info-card2"
                                >
                               
                                <img src="img/faculties/net.png" id="info-card2-img">
                                <h4 style="color:white; margin:27px; font-size:25px; padding-top:20px; ">YEARS OF HIGHER
                                    <br>EDUCATION IN EGYPT </h4>
                                <p style="color:#f28427; margin:35px;  font-size: 70px;
                                        font-family: cursive; font-weight: bold; padding-top:15px;">26 </p>
                                <h4 style="color:white; margin:27px; font-size:25px; padding-top:20px;">STUDENTS GRADUATED
                                    SINCE 1996 </h4>
                                <p style="color:#f28427; margin:35px;  font-size: 70px;
                                        font-family: inherit;
                                            font-weight: bold;
                                            padding-top: 25px;
                                            letter-spacing: 2px;">100,000+ 
                                            </p>

                            </div> --}}
                            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0 " id="info-card2">
    
                                <div class="card border-radius-0  border-0 box-shadow-1" id="card2-style">
                                    <img src="img/faculties/net.png" id="info-card2-img">
                                    <p id="card2-title1">
                                        {{  __('message.YEARS OF HIGHER')  }}
                                        <br>{{  __('message.EDUCATION IN EGYPT')  }} 
                                    </p>
                                        <p  id="card2-num1">26 </p>
                                        <p id="card2-title2">
                                            {{  __('message.STUDENTS GRADUATED SINCE 1996')  }}
                                         </p>
                                            <p  id="card2-num2">100,000+ 
                                                </p>
                                        
                                </div>
    
                            </div>

                            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0  p-0" id="info-card3">
                                <div class=" mb-2 d-flex flex-column" id="card3-style1">
                                    <div class="d-flex pt-3 px-3 align-items-baseline  justify-content-between" >

                                        <div >
                                               <p id="card3-title1" >{{  __('message.ADMISSION REQUIREMENTS')  }}</p>

                                        </div>
                                        <div>
                                            <img src="img/faculties/university.png" id="card3-img1">
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <div id="card3-list" class="mb-3">{{  __('message.ADMISSION')  }}</div>
                                        <div id="card3-list" class="mb-3">{{  __('message.HOW TO APPLY')  }} </div>
                                        <div id="card3-list" class="mb-3">{{  __('message.SCHOLARSHIPS')  }}</div>
                                    </div>


                                </div>
                                <div class="col-lg-6 mb-4 " id="card3-style2">
                                    <p id="card3-title2">
                                        {{  __('message.SERVICES')  }} 
                                            <img src="img/faculties/client.png"  id="card3-img2">
                                    </p>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            {{-- </div>

        </div> --}}

    </div>
@endsection
