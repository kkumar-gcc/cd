@foreach ($archives as $key => $blogs)
    <div class="year lead">{{ $key }}</div>
    <ul class="list-unstyled">
        @foreach ($blogs as $blog)
            {{-- <x-cards.blog-card :blog="$blog" /> --}}
            <li>
                <span class="ml-1 tracking-widest">
                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d M') }}
                </span>
                <a href="/blogs/{{ $blog->slug }}" class="link link-secondary">
                    <h5 class="text-lg font-bold line-clamp-2  tracking-wide text-gray-900  dark:text-white ">
                        {{ $blog->title() }}
                    </h5>
                </a>
                <div class="flex-1 flex flex-row items-center">
                    <div class="mr-2 text-sm">
                        {{ $blog->readTime() }} <span>mins read</span>
                    </div>
                    <div class="mr-2 text-sm">
                        {{ $blog->blogviews->count() }} <span>views</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endforeach
