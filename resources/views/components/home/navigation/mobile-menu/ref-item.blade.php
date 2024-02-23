@props([
    'ref',
    'text'
])


<a
    href="#{{ $ref }}"
    @click="$refs.{{ $ref }}.scrollIntoView({ top: $refs.{{ $ref }}.scrollHeight, behavior: 'smooth' })"
    {{ $attributes->merge([
        'class' => 'block w-full pl-1 text-start text-lg leading-5 text-gray-700
        dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none
        focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out'
    ]) }}
>
    {{ $text }}
</a >
