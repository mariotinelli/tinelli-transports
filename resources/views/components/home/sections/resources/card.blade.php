@props([
    'title',
    'description',
    'icon',
])

<div class="flex flex-col xl:flex-row items-center gap-6 py-12" >

    <div class="min-w-[35%] 2xl:min-w-[30%] flex items-center gap-2 text-xl sm:text-2xl font-bold text-gray-600 dark:text-zinc-200" >

        <x-dynamic-component
            :component="'icons.'.$icon"
            class="w-8 h-8"
        />

        <p > {{ $title }}</p >

    </div >

    <p class="text-md sm:text-lg font-medium text-gray-600 dark:text-zinc-200 text-justify" >
        {{ $description }}
    </p >

</div >
