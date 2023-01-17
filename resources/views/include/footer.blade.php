<div class="container ">
    <div class="row ">
        <div class="col ">
            <div class="row text-center mt-5 " style="width:80%; margin:auto; ">
                @if(app()->getLocale() =='en')
                <div class="owl-carousel owl-theme carousel-center-active-item " data-plugin-options="{ 'responsive': { '0': { 'items': 1}, '476': { 'items': 1}, '768': { 'items': 5}, '992': { 'items': 6}, '1200': { 'items': 6}}, 'autoplay':
                                                            true, 'autoplayTimeout': 3000, 'dots': false} ">
                    @else
                        <div class="owl-carousel owl-theme carousel-center-active-item "    data-plugin-options="{'items': 4, 'margin': 10, 'loop': false, 'nav': false,'rtl':true, 'dots': false, 'stagePadding': 10}"
                             style="height: auto;">
                    @endif
                    <div>
                        <img class="img-fluid " src="img/partners/partner1.png " style="width: 47%; " alt=" ">
                    </div>
                    <div>
                        <img class="img-fluid " src="img/partners/partner2.png " style="width: 47%; " alt=" ">
                    </div>
                    <div>
                        <img class="img-fluid " src="img/partners/partner3.png " style="width: 47%; " alt=" ">
                    </div>
                    <div>
                        <img class="img-fluid " src="img/partners/partner4.png " style="width: 47%; " alt=" ">
                    </div>
                    <div>
                        <img class="img-fluid " src="img/partners/partner5.png " style="width: 47%; " alt=" ">
                    </div>
                    <div>
                        <img class="img-fluid " src="img/partners/partner6.png " style="width: 47%; " alt=" ">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<footer id="footer " style="background-color:#001448; border-top: 8px solid #f28427; ">
    <div class="container ">

        <div class="row pt-3 mt-3 "  style="font: size 12px !important;">
            <div class="col-lg-12 text-end mb-5" style="text-align:right; ">
                @if(app()->getLocale() =='en')
                <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">
                    @else
                        <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean" style="margin-right: 91%;">
                    @endif
                    <li class="changeLang" data-value="ar"><img src="img/Egypt copy 2.png" style="width:26px; height:20px;"></li>
                    <li class="changeLang" data-value="en"><img src="img/America (USA) copy 2.png" style="width:27px; height:21px;"></li>
                    <li class="changeLang" data-value="en"><img src="img/France copy 2.png" style="width:28px; height:21px;"></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-lg-0 ">
                <h5 class="custom-border text-5 text-uppercase text-color-light alternative-font-2 mb-4 pb-3 ">{{  __("message.Main Links")  }}</h5>
                <p class="mb-3 " style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Home")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.About O6u")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Library")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Hospital")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Transportation")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Hotel & Restaurant")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Archived News")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Archived Events")  }}</a></p>
                <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Contact Us")  }}</a></p>

            </div>
            <div class="col-12 col-md-8 col-lg-6 mb-5 mb-lg-0 ">
                <h5 class="custom-border text-5 text-uppercase text-color-light alternative-font-2 mb-4 pb-3 ">{{  __("message.faculties")  }}</h5>
                <div class="row ">
                    <div class="col-6 col-md-4 col-lg-6 mb-5 mb-lg-0 ">
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Engineering")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Medicine")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Pharmacy")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Dentistry")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Applied Health")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Physical Therapy")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Information")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Applied Arts")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Media & Mass")  }}</a></p>
                    </div>
                    <div class="col-6 col-md-4 col-lg-6 mb-5 mb-lg-0 ">
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Economics")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Education")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Tourism")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Faculty of Nursing")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Postgraduate Studies")  }}</a></p>
                        <p class="mb-3 "style="font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.University")  }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 ">
                <h5 class="custom-border text-5 text-uppercase text-color-light alternative-font-2 mb-4 pb-3 ">{{  __("message.Contact Us")  }}</h5>
                <p class="  mb-0 " style="color:white; "><a href=" " class="  link-hover-style-1 " style="color:white;font-family: Raleway;letter-spacing: 2px; ">{{  __("message.Contact Us")  }}</a></p>
                <p class="  mb-0 " style="color:white; font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Address")  }}</a></p>
                <p class="  mb-0 " style="color:white;font-family: Raleway ;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.6th Of October City, Giza Government")  }}</a></p>
                <p class="  mb-0 " style="color:white; font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">{{  __("message.Email")  }}</a></p>
                <p class="  mb-0 " style="color:white; font-family: Raleway;letter-spacing: 2px;"><a href=" " class="  link-hover-style-1 " style="color:white; ">adminoct@o6u.edu.eg</a></p>
                <p class="  mb-0 " style="color:white;font-family: Raleway;letter-spacing: 2px; "><a href=" " class="  link-hover-style-1 " style="color:white; ">President-office@o6u.edu.eg</a></p>
                <div class="d-flex  align-items-baseline  justify-content-between">
                    <div><h5 class=" text-4  text-color-light alternative-font-2 mb-0 pb-0 " style="font-family: Raleway;letter-spacing: 2px;">{{  __("message.HOTLINE")  }}</h5>
                        <h5 class=" text-9  text-color-light alternative-font-2 mb-4 pb-3 pt-3 "style="font-family: Raleway;letter-spacing: 2px;" >16704</h5>
                    </div>
                    <div class="pt-3">
                        <img src="img/logo1.png"  class="FooterLogo">
                    </div>
                </div>


            </div>

        </div>
    </div>

</footer>
