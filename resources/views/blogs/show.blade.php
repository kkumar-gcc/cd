<x-base-layout :page="$blog">
    <main
        class="relative my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  prose-a:no-underline  dark:prose-invert prose-a:text-skin-600 dark:prose-a:text-skin-500 prose-table px-2">

        <div class="relative  pt-[60%] rounded-xl sm:pt-[50%] md:pt-[42%] ">
            <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-skin-base shadow hover:shadow-md object-fit rounded-xl dark:bg-gray-800"
                src="{{ $blog->coverImage() }}" alt="Cover image for {{ $blog->title }}" />
        </div>

        <div class="relative flex flex-col w-full mt-3 lg:flex-row ">
            <div class="flex-1 my-2 basis-2/3 lg:w-2/3">
                <div class="not-prose {{ $blog->adult_warning ? '' : 'hidden' }}">
                    <div
                        class="flex flex-col items-center justify-center  px-4 py-4 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-skin-200 bg-skin-50 rounded-xl dark:bg-[#fddfd8] ">
                        <p class="text-base">This blog contains adult content.<a href="#"
                                class="font-black text-skin-600 ml-2">learn more</a></p>
                    </div>
                </div>
                <div class="not-prose">
                    @foreach ($blog->tags as $tag)
                        <x-tag :tag=$tag />
                    @endforeach
                </div>
                <h5 class="text-3xl my-55 md:text-4xl lg:text-5xl dark:text-white">
                    {{ $blog->title }}
                </h5>
                @can('update', $blog)
                    <div class="flex justify-end not-prose">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-buttons.primary class="border hover:text-skin-600 ">
                                    {{ svg('iconsax-bul-setting-2', 'h-6 w-6') }}
                                </x-buttons.primary>
                            </x-slot>
                            <x-slot name="content">
                                <ul>
                                    <li>
                                        <x-dropdown-link href="/blogs/edit/{{ $blog->slug }}" class="flex ">
                                            {{ __(' Edit') }}
                                        </x-dropdown-link>
                                    </li>
                                    <li>
                                        <x-dropdown-link href="/blogs/manage/{{ $blog->slug }}" class="flex ">
                                            {{ __('Manage') }}
                                        </x-dropdown-link>
                                    </li>
                                    <li>
                                        <x-dropdown-link href="/blogs/stats/{{ $blog->slug }}" class="flex ">
                                            {{ __('Stats') }}
                                        </x-dropdown-link>
                                    </li>
                                </ul>

                            </x-slot>
                        </x-dropdown>
                    </div>
                @endcan
                {{-- table of contents --}}
                <div>
                    <h5 class="text-2xl font-semibold text-gray-700">
                        Table of Contents
                    </h5>
                    <div class="px-4 py-2 text-gray-700">
                        <x-toc>{!! $blog->body() !!}</x-toc>
                    </div>
                </div>
                <div class={{ $blog->adult_warning ? 'prose-img:blur-lg' : '' }}>
                    @if ($blog->access == 'follower')
                        @guest
                            <article class="w-full my-5 ">
                                {!! $blog->excerpt(50) !!}
                            </article>
                            <div class="">
                                <div
                                    class="flex flex-col items-center text-center justify-center px-8 py-16 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-skin-200 bg-skin-50 rounded-xl dark:bg-[#fddfd8] ">
                                    <h2 class="mb-8 text-2xl font-black md:text-3xl lg:text-4xl ">This Blog is for followers
                                        only
                                    </h2>
                                    <p class="text-base">Sign up now to read the blog and get access to the full library of
                                        blogs
                                        for followers only.</p>
                                    <div class="">
                                        <a class="flex items-center justify-center px-4 py-3 my-4 text-sm font-medium text-center text-white no-underline cursor-pointer rounded-xl whitespace-nowrap bg-gradient-to-br from-skin-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-skin-300 dark:focus:ring-skin-800"
                                            href="/register">
                                            {{ __('Sign up now') }}
                                        </a>
                                        <span class="text-sm">Already have an account? <a href="/login"
                                                class="font-black">Sign
                                                in</a></span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <article class="w-full my-5">
                                <x-markdown flavor="github" anchors theme="github-dark">
                                    {!! $blog->body() !!}
                                </x-markdown>
                            </article>
                        @endguest
                    @elseif($blog->access == 'public')
                        <article class="w-full my-5">
                            <x-markdown flavor="github" anchors theme="github-dark">
                                {!! $blog->body() !!}
                            </x-markdown>
                        </article>
                    @endif
                </div>
                {{-- related blogs --}}
                <livewire:blogs.related :blog="$blog"/>
            </div>
            <aside class="my-2 overflow-hidden basis-1/3 lg:pl-5 lg:py-5">

                <x-cards.primary-card :default=false>
                    <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                        Share this post
                    </header>
                    <div
                        class="px-4 py-3 text-gray-700 border-t border-gray-200 last:rounded-b-lg dark:text-gray-400 dark:hover:text-white dark:border-gray-700  hover:shadow dark:bg-gray-800 dark:hover:bg-gray-700">
                        <x-share :share="$shareBlog" />
                    </div>
                </x-cards.primary-card>

                <x-cards.primary-card>
                    <div class="px-4 py-3 rounded-xl not-prose dark:bg-gray-800 ">
                        <header class="">
                            <div class="flex items-center flex-1 ">
                                <x-avatar search="{{ $blog->user->emailAddress() }}" :src="$blog->user->avatarUrl()"
                                    class="h-10 w-10 bg-gray-50 rounded-full cursor-pointer" provider="gravatar" />
                                <div class="ml-2 font-medium">
                                    <div class="text-gray-900 dark:text-white">
                                        <a class="font-bold text-gray-900 truncate dark:text-white user-popover"
                                            href="/users/{{ $blog->user->username }}"
                                            id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                            {{ __($blog->user->username) }}
                                        </a>
                                    </div>
                                    <div class="text-sm">Joined in
                                        {{ \Carbon\Carbon::parse($blog->user->created_at)->format('F Y') }}
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="mt-3">
                            <x-markdown flavor="github" :anchors="true" theme="github-dark">
                                {{ $blog->user->shortBio() }}
                            </x-markdown>
                        </div>
                    </div>
                </x-cards.primary-card>
            </aside>
        </div>
    </main>
</x-base-layout>
