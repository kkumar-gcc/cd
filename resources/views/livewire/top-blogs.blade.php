<div>
    @if ($topBlogs->count() > 3)
        <div class="relative mt-3 w-full  text-base text-left  rounded-xl font-normal">
            <header class="py-3 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
                <h3> Popular Posts </h3>
            </header>
            <ul class="p-0 list-none">
                @foreach ($topBlogs as $topBlog)
                    <li
                        class="py-3 flex flex-row">
                        <div
                            class=" w-16 h-16 relative text-center min-h-fit {{ $topBlog->adult_warning ? 'prose prose-img:blur-lg' : '' }}">
                            <img class="block relative w-16 h-16 rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0"
                                src="{{ $topBlog->coverImage() }}" alt="">
                        </div>
                        <div class="flex-1 ml-3">
                            <a href="/blogs/{{ $topBlog->slug }}" class="link link-secondary">
                                <h5
                                    class="text-base font-semibold line-clamp-2  tracking-wide text-gray-900  dark:text-white ">
                                    {{ $topBlog->title() }}
                                </h5>
                            </a>
                            <div class="flex-1 flex flex-row items-center">
                                <div class="mr-2 text-sm">
                                    {{ $topBlog->readTime() }} <span>mins read</span>
                                </div>
                                <div class="mr-2 text-sm">
                                    {{ $topBlog->blogviews->count() }} <span>views</span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
