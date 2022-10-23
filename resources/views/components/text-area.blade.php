@props(['rows' => '5'])

<textarea cols="30" rows="{{ $rows }}" {{ $attributes->merge([ 'class' => 'block w-full text-sm font-medium mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}></textarea>