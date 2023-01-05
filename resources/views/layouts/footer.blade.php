
<footer class="p-4 border-t bg-white sm:p-6 ">
    <div>
        <div class="shrink-0 flex items-center justify-center flex-col">
            <div class="shrink-0 flex items-center justify-center p-4">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
            </div>
            <div class="flex flex-col sm:flex-row justify-center items-center">
                    <x-link :href="route('home')">
                        {{ __('Home') }}
                    </x-link>
                    <x-link :href="route('blogs')">
                        {{ __('Read') }}
                    </x-link>
                    <x-link :href="route('tags')">
                        {{ __('Tags') }}
                    </x-link>
                    <x-link :href="route('about')">
                        {{ __('About') }}
                    </x-link>
                    <x-link :href="route('contact')">
                        {{ __('Contact') }}
                    </x-link>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-center md:flex-row md:justify-between mt-8 md:mt-12 md:mb-4">
                <livewire:subscribe />
            <div>
                <h5 class="py-3 text-base font-semibold text-gray-700 tracking-wide flex flex-row items-center">
                   {{ svg('iconsax-lin-copyright', 'h-5 w-5') }}{{ now()->year }}
                   {{ __(' Coder\'s Dailybook.All rights reserved.') }}
                </h5>
            </div>
        </div>
    </div>

</footer>

