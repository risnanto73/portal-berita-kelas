<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ZenBlog Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="{{ url('frontend/assets/css/variables.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('frontend.includes.header')

    <main id="main">

        <!-- ======= Search Results ======= -->
        <section id="search-result" class="search-result">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="category-title">Search Results</h3>

                        @foreach ($news as $row)
                            <div class="d-md-flex post-entry-2 small-img">
                                <a href="single-post.html" class="me-4 thumbnail">
                                    <img src="{{ $row->image }}" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span
                                            class="mx-1">&bullet;</span> <span>{{ $row->created_at }}</span></div>
                                    <h3><a href="{{ route('detailNews', $row->slug) }}">{{$row->title}}</a></h3>
                                    <p>{!! Str::words($row->description, '25') !!}</p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ asset('frontend/assets/img/person-2.jpg') }}" alt=""
                                                class="img-fluid"></div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">Wade Warren</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- Paging -->
                        <div class="text-start py-4">
                            <div class="custom-pagination">
                                {{ $news->links('pagination::bootstrap-4') }}
                            </div>
                        </div><!-- End Paging -->

                    </div>

                    <div class="col-md-3">
                        @include('frontend.includes.sidebar')
                    </div>

                </div>
            </div>
        </section> 
        <!-- End Search Result -->

    </main><!-- End #main -->

    @include('frontend.includes.footer')

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ url('frontend/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('frontend/assets/js/main.js') }}"></script>

</body>

</html>
