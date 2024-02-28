@props([
    'ref',
    'text'
])

<a
    href="#{{ $ref }}"
    @click="
        $refs.{{ $ref }}.scrollIntoView({ top: $refs.{{ $ref }}.scrollHeight, behavior: 'smooth' });
        activeSection = '{{ $ref }}';
    "
    {{ $attributes->merge([
        'class' => 'block text-start text-sm lg:text-lg leading-5 text-gray-700
        border-b-2 hover:border-primary-green pb-2 mt-3 dark:text-gray-300 focus:outline-none
        transition duration-150 ease-in-out'
    ]) }}
    :class=" activeSection == '{{ $ref }}' ? 'border-primary-green' : 'border-transparent'"
>
    {{ $text }}
</a >
