@props(['share'])
<div class="flex flex-row flex-wrap">
    <x-buttons.primary class="mr-2 my-1 text-gray-600"  href="{{ $share['facebook'] }}">{{ __('facebook') }}</x-buttons.primary>
    <x-buttons.primary class="mr-2 my-1" href="{{ $share['twitter'] }}">{{ __('twitter') }}</x-buttons.primary>
    <x-buttons.primary class="mr-2 my-1" href="{{ $share['linkedin'] }}">{{ __('linkedin') }}</x-buttons.primary>
    <x-buttons.primary class="mr-2 my-1" href="{{ $share['reddit'] }}">{{ __('reddit') }}</x-buttons.primary>
    <x-buttons.primary class="mr-2 my-1" href="{{ $share['whatsapp'] }}">{{ __('whatsapp') }}</x-buttons.primary>
    <x-buttons.primary class="mr-2 my-1" href="{{ $share['telegram'] }}">{{ __('telegram') }}</x-buttons.primary>
</div>
