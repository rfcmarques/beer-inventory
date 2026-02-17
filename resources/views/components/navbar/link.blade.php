@props(['isActive' => false])

<a {{ $attributes->class([
    'relative inline-block w-full h-full px-4 py-5 mx-2 font-medium leading-tight text-center group md:py-2 md:w-auto md:px-2 lg:mx-3 md:text-center',
    'text-white' => $isActive,
    'duration-300 ease-out hover:text-white' => !$isActive,
]) }}
    {{ $attributes->except('class') }}>

    <span>{{ $slot }}</span>

    <span @class([
        'absolute bottom-0 h-px duration-300 ease-out translate-y-px bg-gradient-to-r md:from-gray-700 md:via-gray-400 md:to-gray-700 from-gray-900 via-gray-600 to-gray-900',
        'w-full left-0' => $isActive,
        'w-0 left-1/2 group-hover:w-full group-hover:left-0' => !$isActive,
    ])></span>
</a>
