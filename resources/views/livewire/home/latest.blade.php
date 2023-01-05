<div>

    <h3 class="py-3 text-2xl font-semibold text-gray-700 dark:text-white">
        <a href="/blogs">{{ __("Latest Posts") }}</a>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            <x-cards.blog-card :blog=$blog vertical="true" />
        @endforeach
    </div>
</div>
