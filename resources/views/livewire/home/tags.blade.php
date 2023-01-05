<div>
    <x-cards.primary-card :default=false>
        <header class="px-4 py-3 text-2xl font-semibold text-gray-900 dark:text-white">
            Tags
        </header>
        <div
            class="px-4 py-3 text-gray-700 last:rounded-b-lg dark:text-gray-400 dark:hover:text-white dark:border-gray-700  hover:shadow dark:bg-gray-800 dark:hover:bg-gray-700">
            @foreach ($tags as $tag)
                <x-tag :tag=$tag id="tag-{{ $tag->id }}" />
            @endforeach
        </div>
    </x-cards.primary-card>
    <h2 class="flex flex-col items-center justify-center mt-16">
        <svg class="text-gray-700 h-6 opacity-10 w-20" role="img" viewBox="0 0 136 24"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1.525 1.525a3.5 3.5 0 014.95 0L20 15.05 33.525 1.525a3.5 3.5 0 014.95 0L52 15.05 65.525 1.525a3.5 3.5 0 014.95 0L84 15.05 97.525 1.525a3.5 3.5 0 014.95 0L116 15.05l13.525-13.525a3.5 3.5 0 014.95 4.95l-16 16a3.5 3.5 0 01-4.95 0L100 8.95 86.475 22.475a3.5 3.5 0 01-4.95 0L68 8.95 54.475 22.475a3.5 3.5 0 01-4.95 0L36 8.95 22.475 22.475a3.5 3.5 0 01-4.95 0l-16-16a3.5 3.5 0 010-4.95z">
            </path>
        </svg>
    </h2>
</div>
