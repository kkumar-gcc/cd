<div>

    <h3 class="py-3 text-2xl font-semibold text-gray-900 dark:text-white">
        <a href="/blogs">{{ __('Latest Posts') }}</a>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            <x-cards.blog-card :blog=$blog vertical="true" />
        @endforeach
    </div>
    <h2 class="flex flex-col items-center justify-center mt-16">
        <svg class="text-gray-700 h-6 opacity-10 w-20" role="img" viewBox="0 0 136 24"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1.525 1.525a3.5 3.5 0 014.95 0L20 15.05 33.525 1.525a3.5 3.5 0 014.95 0L52 15.05 65.525 1.525a3.5 3.5 0 014.95 0L84 15.05 97.525 1.525a3.5 3.5 0 014.95 0L116 15.05l13.525-13.525a3.5 3.5 0 014.95 4.95l-16 16a3.5 3.5 0 01-4.95 0L100 8.95 86.475 22.475a3.5 3.5 0 01-4.95 0L68 8.95 54.475 22.475a3.5 3.5 0 01-4.95 0L36 8.95 22.475 22.475a3.5 3.5 0 01-4.95 0l-16-16a3.5 3.5 0 010-4.95z">
            </path>
        </svg>
    </h2>
</div>
