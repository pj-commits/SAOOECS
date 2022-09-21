@props(['bg' => "bg-primary-blue", 'hover' => "hover:bg-blue-800" , 'type' => 'button'])

<button {{ $attributes->class(['inline-flex', 'items-center', 'px-4', 'py-2', $bg, 'border-transparent', 'rounded-md', 
                                'font-semibold', 'text-xs', 'text-white', 'tracking-widest', $hover, 'focus:outline-none', 
                                'focus:ring', 'ring-bland-200', 'disabled:opacity-25', 'transition', 'ease-in-out', 'duration-150'])
                        ->merge(['type' => $type]) }}>
                                        {{ $slot }}
</button>


