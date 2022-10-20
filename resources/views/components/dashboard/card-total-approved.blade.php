@props(['name', 'number'])

@php

 if($name === 'APF'){
  $title = 'Activity Proposal Form';
  $bg = 'bg-green-100';
  $color = 'bg-semantic-success';
  $textColor = 'text-semantic-success';
  $fill = 'fill-green-100';
 }

 if($name === 'BRF'){
  $title = 'Budget Requisition Form';
  $bg = 'bg-blue-100';
  $color = 'bg-semantic-info';
  $textColor = 'text-semantic-info';
  $fill = 'fill-blue-100';
 }

 if($name === 'NR'){
  $title = 'Narrative Report';
  $bg = 'bg-yellow-100';
  $color = 'bg-primary-yellow';
  $textColor = 'text-primary-yellow';
  $fill = 'fill-yellow-100';
 }

 if($name === 'LF'){
  $title = 'Liquidation Form';
  $bg = 'bg-rose-100';
  $color = 'bg-semantic-warning';
  $textColor = 'text-semantic-warning';
  $fill = 'fill-rose-100';
 }

@endphp
<div class="{{ $bg }} px-4 py-4 mb-4 rounded-sm shadow lg:mr-0 lg:mb-0">
    <div class="flex items-center space-x-4">
      <div class="{{ $color }} rounded-full p-2 hover:animate-pulse">
        <x-svg width="w-7" height="w-7" color="{{ $fill }}" marginRight="mr-0">
            {{ $slot }}
        </x-svg>
      </div>
      <p class="text-xs {{ $textColor }} tracking-wide font-bold uppercase">{{ $title }}</p>
    </div>
    <div class="text-center py-2">
      <p class="{{ $textColor }}"><span class="text-xs">Total Approved:</span> <span class="text-sm font-bold">{{ $number }}</span></p>
    </div>
  </div>