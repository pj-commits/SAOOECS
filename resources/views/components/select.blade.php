<select {{ $attributes->merge(['class' => 'w-full text-sm p-2 border-gray-300 rounded-md
    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}> {{ $slot }} </select>