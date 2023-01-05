<div>
    <x-modals.full modal="searchModal">
        <x-slot:header>
            search
        </x-slot:header>
        <x-slot:title>
            <button x-on:click="searchModal = true">
                <div x-on:click="searchModal = true"
                    class="w-48 md:w-56 border inline-flex justify-between relative items-center py-2.5 px-3 rounded-lg  text-center text-base font-medium leading-5 text-gray-600 ">
                    <span>Search....</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z">
                        </path>
                    </svg>
                </div>
            </button>
        </x-slot:title>
        <div>
            <form method="GET" action="{{ route('search') }}">
                {{-- @csrf --}}
                <div class="my-4">
                    <x-form.input-field type="text" id="title" name="query" wire:model.debounce.500ms="query" placeholder="Search . . . ." />
                    <x-error field="title" class="text-rose-500" />
                </div>
            </form>
        </div>
        {{-- search suggestions  --}}
        <div>
            @if (count($suggestions) > 0)
                @foreach($suggestions as $suggestion)
                    <x-cards.blog-card :blog=$suggestion />
                @endforeach
            @endif
        </div>
    </x-modals.full>
</div>
