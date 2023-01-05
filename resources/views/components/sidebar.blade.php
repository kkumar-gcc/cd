@props(['topBlogs' => false, 'topUsers' => true, 'topTags' => true])
<article>
    {{ $slot }}
    @if ($topBlogs)
      <livewire:top-blogs />
    @endif
    @if ($topTags)
        <livewire:top-tags />
    @endif
</article>
