@extends('public.template')

@section('styles')
    <link rel='stylesheet' id='dashicons-css' href='{{asset('assets/public/styles/css/dashicons.min.css?ver=4.9.12')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='menu-icons-extra-css' href='{{asset('assets/public/styles/css/extra.min.css?ver=0.10.2')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='hrw-css' href='{{asset('assets/public/styles/css/css.css')}}' type='text/css' media='' />
    <link rel='stylesheet' id='contact-form-7-css' href='{{asset('assets/public/styles/css/styles.css?ver=4.9.2')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='menu-image-css' href='{{asset('assets/public/styles/css/menu-image.css?ver=1.1')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='ot-vertical-menu-css' href='{{asset('assets/public/styles/css/ot-vertical-menu.css?ver=1.1.0')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-icons-css' href='{{asset('assets/public/styles/css/fl-icons.css?ver=3.3')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-main-css' href='{{asset('assets/public/styles/css/flatsome.css?ver=3.4.2')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-shop-css' href='{{asset('assets/public/styles/css/flatsome-shop.css?ver=3.4.2')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-style-css' href='{{asset('assets/public/styles/css/style.css?ver=3.4.2')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-style-css' href='{{asset('assets/public/styles/css/custom-menu.css')}}' type='text/css' media='all' />
@endsection

@section('content')
<body class="home page-template page-template-page-blank page-template-page-blank-php page page-id-16 lightbox nav-dropdown-has-arrow">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    <div id="wrapper">
        {{--header--}}
            @include('public.layout.header')
        {{--endheader--}}
        <main id="main" class="">

            <div id="content" role="main" class="content-area">

                <section class="section" id="section_1476062529">
                    <div class="bg section-bg fill bg-fill  bg-loaded">

                    </div>
                    <!-- .section-bg -->

                    <div class="section-content relative">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.9037990122606!2d108.18955331452244!3d16.070481143673835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421855960f7dfd%3A0x114e37562d3e9efb!2zMzg4LCAyNCBIw6AgSHV5IFThuq1wLCBYdcOibiBIw6AsIFRoYW5oIEtow6osIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1575565762753!5m2!1sen!2s" width="1600" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        <div class="gap-element" style="display:block; height:auto; padding-top:50px" class="clearfix"></div>
                        <div class="row row-collapse" id="row-48992529">
                            <div class="col small-12 large-12" data-animate="fadeInLeft">
                                <div class="col-inner">
                                    <h2 class="headtitle">LIÊN HỆ</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row row-collapse" id="row-371835647">
                            <div class="col medium-5 small-12 large-5" data-animate="fadeInLeft">
                                <div class="col-inner" style="padding:0px 30px 0px 0px;">
                                    <h3>MONA MEDIA</h3>
                                    <ul class="contact-info">
                                        <li>151 Hồ Bá Kiện, Phường 15, Quận 10, Tp.Hồ Chí Minh.</li>
                                        <li>Email: <a href="mailto:demonhunter@gmail.com">demonhunter@gmail.com</a></li>
                                        <li>Điện thoại: <a href="tel:0126 922 0162">0126 922 0162</a></li>
                                        <li>Skype: <a href="skype:demonhunterp?chat">demonhunterp</a></li>
                                    </ul>
                                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#8217;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> --}}
                                </div>
                            </div>
                            <div class="col medium-7 small-12 large-7" data-animate="fadeInRight">
                                <div class="col-inner">
                                    <div role="form" class="wpcf7" id="wpcf7-f5-p20-o1" lang="vi" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="lien-he" method="POST" >
                                            {{ csrf_field() }}
                                            <p>
                                                <label> Tên của bạn (*)
                                                    <br />
                                                    <span  class="wpcf7-form-control-wrap your-name"><input type="text" name="contact[full_name]"  /></span> 
                                                </label>
                                            </p>
                                            <p>
                                                <label> Email (*)
                                                    <br />
                                                    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="contact[email]" /></span> 
                                                </label>
                                            </p>
                                            <p>
                                                <label> Phone (*)
                                                    <br />
                                                    <span class="wpcf7-form-control-wrap your-email"><input type="text" name="contact[phone]" /></span> 
                                                </label>
                                            </p>
                                            <p>
                                                <label> Tiêu đề
                                                    <br />
                                                    <span class="wpcf7-form-control-wrap your-subject"><input type="text" name="contact[title]" /></span> 
                                                </label>
                                            </p>
                                            <p>
                                                <label> Nội dung
                                                    <br />
                                                    <span class="wpcf7-form-control-wrap your-message"><textarea name="contact[content]"></textarea></span> 
                                                </label>
                                            </p>
                                            <p>
                                                <input type="submit" value="Gửi liên hệ" />
                                            </p>
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gap-element" style="display:block; height:auto; padding-top:30px" class="clearfix"></div>
                    </div>
                    <!-- .section-content -->
                    <style scope="scope">
                        #section_1476062529 {
                            padding-top: 0px;
                            padding-bottom: 0px;
                            background-color: rgb(247, 247, 247);
                        }
                    </style>
                </section>
            </div>
        </main>
        {{--footer--}}
            @include('public.layout.footer')
        {{--endfooter--}}
    </div>
    <!-- #wrapper -->
    <!-- Mobile Sidebar -->   
        @include('public.layout.mobile-sidebar')
    {{--end--}}

@endsection

@section('scripts')
    <script type='text/javascript' src='{{asset('assets/public/styles/js/scripts.js?ver=4.9.2')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/index.js?ver=4.9.12')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/ot-vertical-menu.js?ver=1.1.0')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/add-to-cart.min.js?ver=3.2.6')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/jquery.blockUI.min.js?ver=2.70')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/js.cookie.min.js?ver=2.1.4')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/woocommerce.min.js?ver=3.2.6')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/cart-fragments.min.js?ver=3.2.6')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/flatsome-live-search.js?ver=3.4.2')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/hoverIntent.min.js?ver=1.8.1')}}'></script>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var flatsomeVars = {
            "ajaxurl": "",
            "rtl": "",
            "sticky_height": "70"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/flatsome.js?ver=3.4.2')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/woocommerce.js?ver=3.4.2')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/wp-embed.min.js?ver=4.9.12')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/zxcvbn-async.min.js?ver=1.0')}}'></script>
    <script type='text/javascript' src='{{asset('assets/public/styles/js/password-strength-meter.min.js?ver=3.2.6')}}'></script>
@endsection