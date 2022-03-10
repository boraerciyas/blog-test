@unless(empty($recentPosts))
    <div class="col-lg-12">
        <div class="sidebar-item recent-posts">
            <div class="sidebar-heading">
                <h2>Recent Posts</h2>
            </div>
            <div class="content">
                <ul>
                    @foreach($recentPosts as $key => $value)
                        <li><a href="{{ route('post', ['post' => $post->slug]) }}">
                                <h5>{{ $value->title }}</h5>
                                <span>{{ $value->created_at->isoFormat('MMM Do YYYY hh:mm:ss') }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endunless
