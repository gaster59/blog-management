@extends('layout.front')

@section('content')
    <article class="blog-post px-3 py-5 p-md-5">
        <div class="container single-col-max-width">
            <header class="blog-post-header">
                <h2 class="title mb-2">{{ $post->title }}</h2>
                <div class="meta mb-3"><span class="date">Published 2 days ago</span><span
                        class="time">5 min read</span><span class="comment"><a class="text-link"
                            href="#">4 comments</a></span></div>
            </header>

            <div class="blog-post-body">
                {!! $post->content !!}
            </div>


            <nav class="blog-nav nav nav-justified my-5">
                @if ($detailPreviousPost)
                    <a class="nav-link-prev nav-item nav-link rounded-left"
                        href="{{ route('admin.detail-post.index', ['id' => $detailPreviousPost->id, 'slug' => $detailPreviousPost->slug]) }}">Previous<svg
                            class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 arrow-prev" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z">
                            </path>
                        </svg>
                        <!-- <i class="arrow-prev fas fa-long-arrow-alt-left"></i> Font Awesome fontawesome.com --></a>
                @endif

                @if ($detailNextPost)
                    <a class="nav-link-next nav-item nav-link rounded-right" 
                        href="{{ route('admin.detail-post.index', ['id' => $detailNextPost, 'slug' => $detailNextPost->slug]) }}">Next<svg
                            class="svg-inline--fa fa-long-arrow-alt-right fa-w-14 arrow-next" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="long-arrow-alt-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z">
                            </path>
                        </svg>
                        <!-- <i class="arrow-next fas fa-long-arrow-alt-right"></i> Font Awesome fontawesome.com --></a>
                @endif
            </nav>

            {{-- <div class="blog-comments-section">
                <div id="disqus_thread"><iframe id="dsq-app9150" name="dsq-app9150" allowtransparency="true" frameborder="0"
                        scrolling="no" tabindex="0" title="Disqus" width="100%"
                        src="https://disqus.com/embed/comments/?base=default&amp;f=3wmthemes&amp;t_u=file%3A%2F%2F%2FC%3A%2FUsers%2FAdmin%2FDownloads%2Fdevblog-bs5-v1.0%2Fdevblog-bs5-v1.0%2Fblog-post.html&amp;t_d=DevBlog%20-%20Bootstrap%205%20Blog%20Template%20For%20Developers&amp;t_t=DevBlog%20-%20Bootstrap%205%20Blog%20Template%20For%20Developers&amp;s_o=default#version=339ad07906d77081022b4931292cb95a"
                        style="width: 1px !important; min-width: 100% !important; border: none !important; overflow: hidden !important; height: 75px !important;"
                        horizontalscrolling="no" verticalscrolling="no"></iframe></div>
                <script>
                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT 
                     *  THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR 
                     *  PLATFORM OR CMS.
                     *  
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: 
                     *  https://disqus.com/admin/universalcode/#configuration-variables
                     */
                    /*
                    var disqus_config = function () {
                        // Replace PAGE_URL with your page's canonical URL variable
                        this.page.url = PAGE_URL;  
                        
                        // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        this.page.identifier = PAGE_IDENTIFIER; 
                    };
                    */

                    (function() { // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
                        var d = document,
                            s = d.createElement('script');

                        // IMPORTANT: Replace 3wmthemes with your forum shortname!
                        s.src = 'https://3wmthemes.disqus.com/embed.js';

                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>
                    Please enable JavaScript to view the
                    <a href="https://disqus.com/?ref_noscript" rel="nofollow">
                        comments powered by Disqus.
                    </a>
                </noscript>
            </div> --}}
            <!--//blog-comments-section-->

        </div>
        <!--//container-->
    </article>
@endsection
