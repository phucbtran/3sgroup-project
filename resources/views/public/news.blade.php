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
<body class="post-template-default single single-post postid-84 single-format-standard lightbox nav-dropdown-has-arrow">
    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
    <div id="wrapper">
        {{--header--}}
            @include('public.layout.header')
        {{--endheader--}}
        <div class="page-title blog-featured-title featured-title no-overflow">
            <div class="page-title-bg fill">
                <div class="title-bg fill bg-fill bg-top" style="background-image: url('http://mauweb.monamedia.net/anphuoc/wp-content/uploads/2018/01/20namthuonghieu.jpg');" data-parallax-fade="true" data-parallax="-2" data-parallax-background data-parallax-container=".page-title"></div>
                <div class="title-overlay fill" style="background-color: rgba(0,0,0,.5)"></div>
            </div>
            <div class="page-title-inner container  flex-row  dark is-large" style="min-height: 300px">
                <div class="flex-col flex-center text-center">
                <h6 class="entry-category is-xsmall">
                    <a href="http://mauweb.monamedia.net/anphuoc/category/tin-tuc/" rel="category tag">Tin tức</a>
                </h6>
                <h1 class="entry-title">{{ $news['title_name'] }}</h1>
                <div class="entry-divider is-divider small"></div>
                </div>
            </div>
            <!-- flex-row -->
        </div>
        <main id="main" class="">
            <div id="content" class="blog-wrapper blog-single page-wrapper">
                <div class="row row-large row-divided ">
                <div class="large-9 col">
                    <article id="post-84" class="post-84 post type-post status-publish format-standard has-post-thumbnail hentry category-tin-tuc">
                        <div class="article-inner has-shadow box-shadow-1 box-shadow-2-hover">
                            <div class="entry-content single-page">
                                <div>
                                    <h2>{{ $news['meta_title'] }}</h2>
                                </div>
                                <div><img class="aligncenter" src="{{ $news['img_dir_path'] }}" alt="" /></div>
                                {!! $news['content'] !!}
                            </div>
                            <!-- .entry-content2 -->
                        </div>
                        <!-- .article-inner -->
                    </article>
                    <!-- #-84 -->
                    <div id="comments" class="comments-area">
                        <div id="respond" class="comment-respond">
                            <h3 id="reply-title" class="comment-reply-title">Trả lời <small><a rel="nofollow" id="cancel-comment-reply-link" href="/anphuoc/dau-an-20-nam-thuong-hieu-thoi-trang-an-phuoc/#respond" style="display:none;">Hủy</a></small></h3>
                            <form action="/commnets/create" method="post" id="commentform" class="comment-form">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $news['id'] }}" name="comment[post_id]"/>
                            <input type="hidden" value="1" name="comment[type_cmt_flg]"/>
                            <p class="comment-notes"><span id="email-notes">Email của bạn sẽ không được hiển thị công khai.</span> Các trường bắt buộc được đánh dấu <span class="required">*</span></p>
                            <p class="comment-form-comment"><label for="content">Bình luận</label> <textarea id="content" name="comment[content]" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>
                            <p class="comment-form-author"><label for="content">Tên <span class="required">*</span></label> <input name="comment[full_name]" id="content" type="text" value="" size="30" maxlength="245" required='required' /></p>
                            <p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input id="email" name="comment[email]" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" required='required' /></p>
                            <p class="comment-form-url"><label for="phone">Số điện thoại</label> <input id="phone" name="comment[phone]" type="text" value="" size="30" maxlength="200" /></p>
                            <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Phản hồi" /></p>
                            </form>
                        </div>
                        <!-- #respond -->
                    </div>
                    <!-- #comments -->
                </div>
                <!-- .large-9 -->
                <div class="post-sidebar large-3 col">
                    <div id="secondary" class="widget-area " role="complementary">
                        <aside id="flatsome_recent_posts-4" class="widget flatsome_recent_posts">
                            <span class="widget-title "><span>Bài viết mới</span></span>
                            <div class="is-divider small"></div>
                            <ul>
                            @foreach($newsTopFile as $obj)
                            <li class="recent-blog-posts-li">
                                <div class="flex-row recent-blog-posts align-top pt-half pb-half">
                                    <div class="flex-col mr-half">
                                        <div class="badge post-date  badge-outline">
                                        <div class="badge-inner bg-fill" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2) ), url('{{ $obj['img_dir_path'] }}'); color:#fff; text-shadow:1px 1px 0px rgba(0,0,0,.5); border:0;>
                                            <span class="post-date-day"></span><br>
                                            <span class="post-date-month is-xsmall"></span>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- .flex-col -->
                                    <div class="flex-col flex-grow">
                                        <a href="/tin-tuc/{{ $obj['id']}}" title="{{ $obj['title_name'] }}"> {{ $obj['title_name'] }} </a>
                                        <span class="post_comments oppercase op-7 block is-xsmall"><a href="/tin-tuc/{{ $obj['id'] }}"></a></span>
                                    </div>
                                </div>
                                <!-- .flex-row -->
                            </li>
                            @endforeach
                        </ul>
                        </aside>
                    </div>
                    <!-- #secondary -->
                </div>
                <!-- .post-sidebar -->
                </div>
                <!-- .row -->
            </div>
            <!-- #content .page-wrapper -->
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