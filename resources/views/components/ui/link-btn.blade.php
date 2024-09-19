@props([
    'icon' => true,
    'href' => '#',
    'color' => 'gray',
    'label' => 'Read more',
    'mb' => 2,
])

<a href="{{ $href }}"
    class="inline-flex text-nowrap items-center px-3 py-2 mb-{{ $mb }} text-sm font-medium text-white bg-{{ $color }}-800 rounded-lg hover:bg-{{ $color }}-900 focus:outline-none focus:ring-4 focus:ring-{{ $color }}-300 me-2 dark:bg-{{ $color }}-800 dark:hover:bg-{{ $color }}-700 dark:focus:ring-{{ $color }}-700 dark:border-{{ $color }}-700">
    {{ $label }}
    @if ($icon)
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
    @endif
</a>
