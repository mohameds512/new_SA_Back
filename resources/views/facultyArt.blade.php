@extends('app')
@section('faculty','active')
@section('content')
    <style>
        .nav-tabs li .nav-link:hover{
            border-top: none !important;
        }
        .nav-tabs li .nav-link, .nav-tabs li .nav-link:hover{
            background:#f28427 !important;
            border-left:none !important;
            border-right:none !important;
            border-top:none !important;
        }
    </style>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-end ">


    </section><!-- End Hero -->
    <main id=" main">

        <section class="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content">
                            <h3 style="color: white;">{{  __('message.About the College')  }}</h3>
                            <p style="color:honeydew;font-family: 'Raleway';">
                  {!!  __('message.artAbout')  !!}
                            </p>
<div class="text-center">
    <a href="#" class="more-btn ">
        <b class="Apply">{{  __('message.APPLY')  }}</b>
        <span class="" >{{  __('message.Submission is open')  }}</span>
    </a>
    <h2 class=" pt-3"><b style="font-family: 'Montserrat';font-size: 30px;color: white;letter-spacing: 2px;font-weight: bold;">{{  __('message.academic calendar')  }}</b></h2>

</div>
</div>

</div>
<div class="col-lg-6">

<div class="row">
<div class="col-lg-12 title" style="padding-bottom: 15%;margin: 4%">

    <h1 style="padding-top: 18px;font-family: 'Raleway'; line-height: 0px;font-size: 40px;letter-spacing: 3px;font-weight: bold;">{{  __('message.APPLIED ARTS')  }}</h1>
    <h2 style="font-family: 'Raleway';  line-height: 0px;">{{  __('message.OCTOBER 6 UNIVERSITY')  }} </h2>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="" srcset="">
    <p style="font-family: 'Raleway';">{{  __('message.PIONEER OF PRIVATE')  }}</p>
    <h2 style="font-family: 'Raleway';line-height: 0px;">
        {{  __('message.UNIVERSITY EDUCATION IN EGYPT')  }}
    </h2>
</div>
<div class="col-lg-4 layer firstImage">
    <div class="layers">
        <h2 class="">{{  __('message.ACADEMICS DEPARTMENTS')  }}</h2>
    </div>
</div>
<div class="col-lg-4 layer secondImage">
    <div class="layers ">
        <h2 class="title2">{{  __('message.GRADUATE PROGRAMS')  }}</h2>
    </div>
</div>
<div class="col-lg-4 layer thirdImage">
    <div class="layers ">
        <h2 class="">{{  __('message.FACULTY STAFF')  }}</h2>
    </div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ======= About Section ======= -->
<section id="" class="mb-3" style="margin-top: -307px;">
<div class="container">

<div class="row">
<div class=" col-lg-8 ">
<h1 class="pb-3"><b style="font-family: 'Raleway'; font-size: 40px;">{{  __("message.Dean's Message")  }}</b>
</h1>
<p class="pb-3  pt-3" style="margin-left: 3%;font-family: 'Raleway'; font-size: 17px;letter-spacing: 1px;">
{{  __("message.DeanWord")  }}
<br>
<br>
{{  __("message.Professor")  }}
<br>
{{  __("message.Mona Mostafa Abutabl")  }}
</p>
{{--                        <span class=" pt-3" style="margin-left: 3%;font-family: 'Raleway'; font-size: 17px;letter-spacing: 1px;">--}}
{{--                 {{  __("message.Professor")  }}--}}
{{--            </span>--}}
{{--                        <h5 style="margin-left: 3%;">--}}
{{--                            {{  __("message.Mona Mostafa Abutabl")  }}--}}
{{--                        </h5>--}}

</div>

<div class=" col-lg-4 ">
<img src="{{asset('img/e099fd05-e301-4092-b279-0338ffce96d8.png')}}" style=" width: 100%; " alt="">

</div>
</div>

</div>
</section><!-- End  Section -->

<!-- ======= Departments Section ======= -->
<section id=" departments" class="departments">
<div class="container">



<div class="row gy-4">

<div class="col-lg-9">
<div class="section-title">
<h2 style="font-family: 'Raleway';font-size: 22px;letter-spacing: 2px;"> {{  __("message.Latest News")  }}</h2>
<p class="keep-up-data" >{{  __("message.Keep up-to-date with all the latest O6U news")  }}
</p>
</div>
<div class="tab-content" style="border: none !important;background-color:#00123f">
<div class="tab-pane active show" id="tab-1">
    <div class="row gy-4">
        <div class="col-lg-6 details order-2 order-lg-1">

            <p style="font-family: 'Noto Seirf';letter-spacing: 1px;">{{  __("message.The Faculty of Applied Arts - October 6 University, sponsored by Prof. Gamal Samy")  }} <br>
                {{  __("message.(University President) and Prof. Mona Abu Tabl (Dean of the College)")  }}
                <br>
                {{  __("message.in (the visual image of the Administrative Capital)")  }}
            </p>
            <img src="{{asset('img/242213100_4340602712721977_2576652623109136343_n.png')}}" alt="" class="img-fluid">

        </div>
        <div class="col-lg-6  order-1 order-lg-2 ">
            <p class="pb-3" style="font-family: 'Noto Seirf';letter-spacing: 1px;">
                {{  __('message.The Community Service Sector')  }}
            </p>
            <img src="{{asset('img/270037454_4658043504311228_6008292088119052832_n.png')}}" alt="" class="img-fluid">
        </div>
    </div>
</div>
</div>
</div>
<dv class="col-lg-3">
<ul class="nav nav-tabs flex-column">
<li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">{{  __("message.Media Center")  }}
    </a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
<li class="nav-item">
    <a class="nav-link  active show" data-bs-toggle="tab" href="#tab-2">{{  __("message.Strategic goals and objectives")  }}
    </a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
<li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-3">{{  __("message.Latest Research")  }}
    </a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
<li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-4">{{  __("message.Results")  }}</a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
<li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-5">{{  __("message.Faculty Policies")  }}</a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
<li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-5">{{  __("message.NEWS")  }}</a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
<li class="nav-item">
    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-5">{{  __("message.DOWNLOADS")  }}</a>
    <img src="{{asset('img/Rectangle 528 copy 7.png')}}" alt="">
</li>
</ul>
</div>
</div>

</div>
</section><!-- End Departments Section -->


</main><!-- End #main -->
@endsection
