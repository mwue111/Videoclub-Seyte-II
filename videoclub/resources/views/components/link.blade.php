@props(['url'])

<a href=" {{ $url }}" {{ $attributes(['class' => 'link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover float-right mt-8']) }}>
    {{ $slot }}
</a>
