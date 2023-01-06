@foreach ($archives as $key => $blogs)
    <div class="grid gap-8 border-l-[3px] pt-4 pb-6 border-skin-600 ">
        <div>
            <span class="inline-block mb-5 time px-5 py-1 bg-skin-600 text-white text-xs font-bold uppercase">
                {{ $key }}
            </span>
            <div class="overflow-hidden py-1 grid gap-6 -z-[2]">
                @foreach ($blogs as $blog)
                    <div
                        class="relative before:content-[''] before:w-full before:h-[2px] before:-z-[0] before:bg-skin-600 before:absolute before:top-4 before:-left-[50%]">
                        <div
                            class="relative flex flex-col-reverse items-stretch justify-center md:flex-row ml-4 rounded-l-[2px] border border-l-[3px]  border-l-skin-600 rounded-r-lg shadow bg-white p-6 ">
                            <div class="basis-2/3 mt-2 md:mt-0">
                                <header>
                                    <time class="time px-5 py-1 bg-gray-100 text-xs font-bold uppercase text-black"
                                        datetime="2008-02-02">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M') }}
                                    </time>
                                </header>
                                <div class="mt-2">
                                    <a href="/blogs/{{ $blog->slug }}"
                                        class="text-2xl mb-1 font-semibold line-clamp-2 tracking-wide text-gray-900 ">
                                        {{ $blog->title() }}
                                    </a>
                                    @foreach ($blog->tags as $tag)
                                        <x-tag :tag=$tag id="tag{{ $blog->id }}-{{ $tag->id }}" />
                                    @endforeach
                                </div>
                            </div>
                            <div
                                class="basis-1/3 relative text-center min-h-fit {{ $blog->adult_warning ? 'prose prose-img:blur-lg' : '' }}">
                                <img class="block relative w-full min-h-[192px]  rounded-xl  object-cover shadow-md hover:shadow-sm md:absolute md:top-0 md:left-0 md:min-h-full"
                                    src="{{ $blog->coverImage() }}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
