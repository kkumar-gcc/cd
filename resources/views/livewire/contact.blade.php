<div class="mt-2 text-gray-700 sm:mt-6 md:px-20 mb-16 min-h-[calc(80vh-100px)]">
    <div class="fixed top-3 right-3 p-3 mt-4 z-20 bg-skin-base shadow flex flex-shrink-0 rounded-md"
        x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms x-init="@this.on('changed', () => {
            show = true;
            setTimeout(() => show = false, 10000)
        })" x-cloack
        style="display:none">
        <div tabindex="0" aria-label="group icon" role="img"
            class="focus:outline-none w-8 h-8 flex flex-shrink-0 items-center justify-center">
            {{ svg('iconsax-bul-tick-circle', 'h-6 w-6 text-skin-500') }}
        </div>
        <div class="pl-3 w-full flex items-center justify-center">
            @if (session()->has('message'))
                {{ session('message') }}
            @endif
            <div aria-label="close icon" @click="show=false" role="button"
                class="ml-3 focus:outline-none cursor-pointer">
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon">
            </div>
        </div>
    </div>
    <h1 class="text-3xl md:text-5xl font-semibold line-clamp-3  tracking-wide text-gray-800 mb-4">
        Love to hear from you,
        get in
        touch
    </h1>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="flex flex-col md:flex-row jus">
            <div class="my-4 md:mr-2 flex-1">
                <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                    for="name">Your name</label>
                <x-form.input-field type="text" id="name" wire:model="name" placeholder="Name . . . ." />
                <x-error field="name" class="text-rose-500" />
            </div>
            <div class="my-4 md:ml-2 flex-1">
                <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                    for="email">Your email</label>
                <x-form.input-field type="email" id="email" wire:model="email" placeholder="email . . . ." />
                <x-error field="email" class="text-rose-500" />
            </div>
        </div>
        <div class=" mb-5">
            <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                for="message">Message</label>
            <textarea id="message" name="message"
                class="border border-gray-300 text-gray-600 text-base font-semibold focus:shadow-md focus:ring-4 focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5"
                maxlength="200" rows="4" wire:model="shortBio" placeholder="Let tell us know your project about ..">{{ old('message') }}</textarea>
            <x-error field="message" class="text-rose-500"/>
        </div>
        <x-buttons.secondary type="submit">
            Just Send
        </x-buttons.secondary>
    </form>
</div>
