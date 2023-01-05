<x-guest-layout>
    <x-cards.primary-card :default=false>
        <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
            Search
        </header>
        <div
            class="px-4 py-3 text-gray-700 last:rounded-b-lg dark:text-gray-400 dark:hover:text-white dark:border-gray-700  hover:shadow dark:bg-gray-800 dark:hover:bg-gray-700">
            <form method="GET" action="{{ route('search') }}">
                {{-- @csrf --}}
                <div class="my-4">
                    <x-form.input-field type="text" id="title" name="query" value="{{ $query }}"
                        placeholder="Search . . . ." />
                    <x-error field="query" class="text-rose-500" />
                </div>
            </form>
        </div>
    </x-cards.primary-card>
    @if ($query)
        <h2 class="flex flex-col items-center justify-center my-8">
            <svg class="text-gray-700 h-6 opacity-10 w-20" role="img" viewBox="0 0 136 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.525 1.525a3.5 3.5 0 014.95 0L20 15.05 33.525 1.525a3.5 3.5 0 014.95 0L52 15.05 65.525 1.525a3.5 3.5 0 014.95 0L84 15.05 97.525 1.525a3.5 3.5 0 014.95 0L116 15.05l13.525-13.525a3.5 3.5 0 014.95 4.95l-16 16a3.5 3.5 0 01-4.95 0L100 8.95 86.475 22.475a3.5 3.5 0 01-4.95 0L68 8.95 54.475 22.475a3.5 3.5 0 01-4.95 0L36 8.95 22.475 22.475a3.5 3.5 0 01-4.95 0l-16-16a3.5 3.5 0 010-4.95z">
                </path>
            </svg>
        </h2>
        <div class="mb-16">
            <h3 class="py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                {{ __('Search Results for') }}
                <span class="font-bold">"{{ $query }}"</span>
            </h3>
            @if (count($searchBlogs) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($searchBlogs as $blog)
                        <x-cards.blog-card :blog=$blog vertical="true" />
                    @endforeach
                </div>
                {!! $searchBlogs->withQueryString()->links('pagination::tailwind') !!}
            @else
                <x-cards.primary-card :default=false>
                    <div
                        class="px-4 py-3 text-gray-700 text-center last:rounded-b-lg dark:text-gray-400 dark:hover:text-white dark:border-gray-700  hover:shadow dark:bg-gray-800 dark:hover:bg-gray-700">
                        <p class="px-4 py-3 text-base font-normal text-gray-700 dark:text-white">
                            <span class="text-skin-600 font-bold">Oops!</span> No results found.
                        </p>
                    </div>
                </x-cards.primary-card>
            @endif
        </div>
    @endif
</x-guest-layout>
