@props(['tag'])

<a href="/blogs/tagged/{{ $tag->title }}" {{ $attributes->merge(['class' => 'text-[10px] no-underline tag-popover '.$tag->color]) }}  {{ $attributes['id']}}>
    <span
        class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-skin-200 uppercase  bg-skin-100 text-skin-600 before:content-['#'] before:mr-0.5 ">
        {{ $tag->title }}
    </span>
</a>
