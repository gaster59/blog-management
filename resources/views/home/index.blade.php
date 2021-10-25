@extends('layout.front')

@section('content')
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center single-col-max-width">
            <h2 class="heading">DevBlog - A Blog Template Made For Developers</h2>
            <div class="intro">Welcome to my blog. Subscribe and get my latest blog post in your inbox.
            </div>
            <div class="single-form-max-width pt-3 mx-auto">
                <form class="signup-form row g-2 g-lg-2 align-items-center">
                    <div class="col-12 col-md-9">
                        <label class="sr-only" for="semail">Your email</label>
                        <input type="email" id="semail" name="semail1" class="form-control me-md-1 semail"
                            placeholder="Enter email">
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
                <!--//signup-form-->
            </div>
            <!--//single-form-max-width-->
        </div>
        <!--//container-->
    </section>
    <section class="blog-list px-3 py-5 p-md-5">
        <div class="container single-col-max-width">
            @php
                $index = 1;
            @endphp
            @foreach ($posts as $post)
                @php
                    $classItem = 'item mb-5';
                    $urlPost = route('admin.detail-post.index', ['id' => $post->id, 'slug' => $post->slug]);
                @endphp
                @if ($index % 5 == 0)
                    @php
                        $classItem = 'item';
                    @endphp
                @endif
                <div class="{{ $classItem }}">
                    <div class="row g-3 g-xl-0">
                        <div class="col-2 col-xl-3">
                            <img class="img-fluid post-thumb" alt="{{ $post->title }}" src={{ asset('post/'.$post->avatar) }} />
                        </div>
                        <div class="col">
                            <h3 class="title mb-1">
                                <a class="text-link" href="{{ $urlPost }}">{{ $post->title }}</a>
                            </h3>
                            <div class="meta mb-1">
                                <span class="date">Published 3 months ago</span>
                                <span class="time">3 min read</span>
                                <span class="comment">
                                    <a class="text-link" href="#">26 comments</a>
                                </span>
                            </div>
                            <div class="intro">
                                {!! $post->summary !!}
                            </div>
                            <a class="text-link" href="{{ $urlPost }}">Read more →</a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </section>

@endsection
