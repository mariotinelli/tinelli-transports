@props([
    'ref',
    'text'
])

<a
    href="#{{ $ref }}"
    @click="$refs.{{ $ref }}.scrollIntoView({ top: $refs.{{ $ref }}.scrollHeight, behavior: 'smooth' })"
    {{ $attributes->merge([
        'class' => 'block text-start text-sm lg:text-lg leading-5 text-gray-700 border-b-2 border-transparent hover:border-b-2
        hover:border-primary-green pb-2 mt-3 dark:text-gray-300 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800
        transition duration-150 ease-in-out'
    ]) }}
>
    {{ $text }}
</a >
