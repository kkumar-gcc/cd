<div>
    <x-cards.primary-card :default=false>
        <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
            Tags
        </header>
        <div
            class="px-4 py-3 text-gray-700 last:rounded-b-lg dark:text-gray-400 dark:hover:text-white dark:border-gray-700  hover:shadow dark:bg-gray-800 dark:hover:bg-gray-700">
            @foreach ($tags as $tag)
                <x-tag :tag=$tag id="tag-{{ $tag->id }}" />
            @endforeach
        </div>
    </x-cards.primary-card>
</div>
