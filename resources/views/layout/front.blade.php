<!DOCTYPE html>
<html lang="en">

<head>
    <title>DevBlog - Bootstrap 5 Blog Template For Developers</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('js/all.min.js') }}"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('css/theme-2.css') }}">
</head>

<body>
    <header class="header text-center">
        <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="index.html">Anthony's Blog</a></h1>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navigation" class="collapse navbar-collapse flex-column">
                <div class="profile-section pt-3 pt-lg-0">
                    <img class="profile-image mb-3 rounded-circle mx-auto" src="assets/images/profile.png" alt="image">

                    <div class="bio mb-3">Hi, my name is Anthony Doe. Briefly introduce yourself here. You can also
                        provide a link to the about page.<br><a href="about.html">Find out more about me</a></div>
                    <!--//bio-->
                    <ul class="social-list list-inline py-3 mx-auto">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-github-alt fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-codepen fa-fw"></i></a></li>
                    </ul>
                    <!--//social-list-->
                    <hr>
                </div>
                <!--//profile-section-->

                <ul class="navbar-nav flex-column text-start">
                    @php
                        $action = explode('@', Route::getCurrentRoute()->getActionName())[1];
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ $action == 'index' ? 'active' : '' }}"
                            href="{{ route('admin.home.index') }}"><i class="fas fa-home fa-fw me-2"></i>Blog Home
                            <span class="sr-only">(current)</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="blog-post.html"><i class="fas fa-bookmark fa-fw me-2"></i>Blog
                            Post</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ $action == 'about' ? 'active' : '' }}" 
                            href="{{ route('admin.about.index') }}"><i class="fas fa-user fa-fw me-2"></i>About Me</a>
                    </li>
                </ul>

                {{-- <div class="my-2 my-md-3">
                    <a class="btn btn-primary" href="https://themes.3rdwavemedia.com/" target="_blank">Get in Touch</a>
                </div> --}}
            </div>
        </nav>
    </header>

    <div class="main-wrapper">

        @yield('content')

        <footer class="footer text-center py-2 theme-bg-dark">

            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">Designed with <svg class="svg-inline--fa fa-heart fa-w-16"
                    style="color: #fb866a;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                    </path>
                </svg><!-- <i class="fas fa-heart" style="color: #fb866a;"></i> Font Awesome fontawesome.com --> by <a
                    href="https://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
        </footer>
    </div>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
