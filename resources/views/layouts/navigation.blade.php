<nav x-data="{ open: false }" class=" bg-skin-base border-b border-gray-100 z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blogs')" :active="request()->routeIs('blogs')">
                        {{ __('Read') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tags')" :active="request()->routeIs('tags')">
                        {{ __('Tags') }}
                    </x-nav-link>
                    <x-nav-link :href="'/users'" :active="request()->routeIs('users')">
                        {{ __('Users') }}
                    </x-nav-link>
                    @can('admin access')
                        <x-nav-link :href="route('admin.')" :active="request()->routeIs('admin.')">
                            {{ __('Admin') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden lg:flex sm:items-center sm:ml-6">
                <div class="mr-6">
                    <x-modals.full modal="searchModal">
                        <x-slot:header>
                            search
                        </x-slot:header>
                        <x-slot:title>
                            <button x-on:click="searchModal = true">
                                <span x-on:click="searchModal = true"
                                    class="inline-flex relative items-center p-1 text-sm font-medium text-center text-gray-600">
                                    <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z">
                                        </path>
                                    </svg>
                                </span>
                            </button>
                        </x-slot:title>
                    </x-modals.full>
                </div>

                @auth
                    <div class="mr-6">
                        <livewire:notification-indicator />
                    </div>
                    @can('create blogs')
                        <div class="mr-6">
                            <x-buttons.secondary class="ml-4" href="/new-blog">{{ __('New Blog') }}
                            </x-buttons.secondary>
                        </div>
                    @endcan

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-avatar search="{{ auth()->user()->emailAddress() }}" :src="auth()->user()->avatarurl()"
                                class="h-12 w-12 bg-gray-50 rounded-full cursor-pointer" provider="gravatar" />
                        </x-slot>
                        <x-slot name="content">
                            <div class="py-3 px-4 text-sm text-gray-900 dark:text-white">
                                <div>{{ auth()->user()->username }}</div>
                                <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                            </div>
                            <ul>
                                <li>
                                    <x-dropdown-link href="/dashboard">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                </li>
                                <li>
                                    <x-dropdown-link href="/settings">
                                        {{ __('Settings') }}
                                    </x-dropdown-link>
                                </li>
                                <!-- Authentication -->
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>

                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex justify-center">
                        @if (Route::has('login'))
                            <div class="flex items-center ml-6 ">
                                <x-buttons.primary type="button" href="{{ route('login') }}">
                                    {{ __('Sign In') }}</x-buttons.primary>
                            </div>
                        @endif
                        @if (Route::has('register'))
                            <div class="flex items-center ml-6 ">
                                <x-buttons.secondary type="button" href="{{ route('register') }}">
                                    {{ __('Sign Up') }}</x-buttons.secondary>
                            </div>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center lg:hidden">
                <div class="mr-6">
                    <svg class="w-5 h-5 md:h-6 md:w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z">
                        </path>
                    </svg>
                </div>
                @auth
                    <div class="mr-4">
                        <livewire:notification-indicator />
                    </div>
                @endauth
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden lg:hidden fixed top-20 right-0 left-0 bottom-0 z-50 overflow-y-scroll h-[calc(100%-5rem)] overflow-x-hidden w-screen  py-5   bg-skin-base border-t border-gray-200 dark:border-gray-700 dark:bg-gray-800"
        x-show="open" x-transition.origin.top.right x-trap.noscroll="open">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blogs')" :active="request()->routeIs('blogs')">
                {{ __('Read') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tags')" :active="request()->routeIs('tags')">
                {{ __('Tags') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="'/users'" :active="request()->routeIs('users')">
                {{ __('Users') }}
            </x-responsive-nav-link>
            @can('admin access')
                <x-responsive-nav-link :href="route('admin.')" :active="request()->routeIs('admin.')">
                    {{ __('Admin') }}
                </x-responsive-nav-link>
            @endcan
        </div>
        @guest
            <div class="flex justify-center mt-4">
                @if (Route::has('login'))
                    <div class="flex items-center ml-6 ">
                        <x-buttons.primary type="button" href="{{ route('login') }}">
                            {{ __('Sign In') }}</x-buttons.primary>
                    </div>
                @endif
                @if (Route::has('register'))
                    <div class="flex items-center ml-6 ">
                        <x-buttons.secondary type="button" href="{{ route('register') }}">
                            {{ __('Sign Up') }}</x-buttons.secondary>
                    </div>
                @endif
            </div>
        @else
            <div class="flex justify-between py-3 font-medium translate-x-1 px-[4%]">

                <div class="flex items-center space-x-4">
                    <x-avatar search="{{ auth()->user()->emailAddress() }}" :src="auth()->user()->avatarUrl()"
                        class="h-12 w-12 bg-gray-50 rounded-full" provider="gravatar" />
                    <div class="space-y-1 font-medium dark:text-white">
                        <div>{{ Auth::user()->username }}</div>
                    </div>
                </div>
                @can('create blogs')
                    <div>
                        <x-buttons.secondary class="ml-4" href="/new-blog">
                            {{ svg('iconsax-lin-add', 'h-6 w-6') }}
                        </x-buttons.secondary>
                    </div>
                @endcan

            </div>
            <x-responsive-nav-link href="/users/{{ Auth::user()->username }}">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#!">
                {{ __('Work preferences') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/settings?tab=blogs">
                {{ __('My Blogs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/settings?tab=subscriber">
                {{ __('My Subscribers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/settings?tab=subscribed">
                {{ __('Subscribed') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/settings?tab=bookmarks">
                {{ __('My Bookmarks') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/settings?tab=profile">
                {{ __(' Account Settings') }}
            </x-responsive-nav-link>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Sign Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @endguest
        <!-- Responsive Settings Options -->

    </div>
</nav>
