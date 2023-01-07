<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar />
    </x-slot>

    <div class="w-full px-2 md:px-12  my-4 relative">
        <x-cards.primary-card :default=false class="mt-0 px-8 py-7 flex flex-row-reverse">
            <div class="relative text-center min-h-fit">
                <img class="block relative w-full rounded-xl  object-cover shadow-md hover:shadow-sm h-[150px]  mb-2"
                    src="{{ $searchTag->coverImage() }}" alt="">
            </div>
            <div class="flex-1">
                <div class="text-2xl font-semibold text-gray-700 dark:text-white">
                    <x-tag :tag=$searchTag id="tag-{{ $searchTag->id }}" class="not-prose" />
                </div>
                <div class=" text-gray-700 last:rounded-b-lg ">
                    <p class="mb-3">{{ $searchTag->description }}</p>
                </div>
            </div>
        </x-cards.primary-card>
        <livewire:blogs.tagged :tag="$searchTag->title" />
    </div>

</x-app-layout>
