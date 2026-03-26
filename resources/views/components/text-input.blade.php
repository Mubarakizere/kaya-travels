@props(['disabled' => false])

<input {{ $attributes->merge([
    'class' => 'form-control block w-full rounded-md border-[#d1af65] bg-[#111] text-white shadow-sm focus:border-[#d1af65] focus:ring focus:ring-[#d1af65] focus:ring-opacity-30'
]) }} @disabled($disabled) />