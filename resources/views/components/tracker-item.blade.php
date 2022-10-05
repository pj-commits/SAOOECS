@props(['approver' => '', 'dateApproved' => '', 'orientation'])

@if($orientation === "vertical")
<div class="flex items-center space-x-6">
    @if($dateApproved === '')
    <div {{ $attributes->class(['w-3 h-3 rounded-full absolute -left-1 bg-primary-yellow' ])}}></div>
    @else
    <div class="w-6 h-6 rounded-full absolute -left-2.5 bg-white border-2 border-primary-yellow">
        <x-svg color="fill-primary-yellow" class="mr-0">
            <path d="m9.55 18-5.7-5.7 1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4Z"/>
        </x-svg>
    </div>
    @endif
    <div>
        <h1 class="font-bold tracking-wide"> {{ $approver }}</h1>
        <p class="text-sm text-bland-400"> {{ ($dateApproved === '') ? '' : "Date Approved: ".$dateApproved; }} </p>
    </div>
</div>
@elseif($orientation === 'horizontal')
<div class="flex flex-col justify-center space-y-5">
    @if($dateApproved === '')
    <div {{ $attributes->class(['w-3 h-3 self-center rounded-full absolute -top-1 bg-primary-yellow' ])}}></div>
    @else
    <div class="w-6 h-6 self-center rounded-full absolute -top-2.5 bg-white border-2 border-primary-yellow">
        <x-svg color="fill-primary-yellow" class="mr-0">
            <path d="m9.55 18-5.7-5.7 1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4Z"/>
        </x-svg>
    </div>
    @endif
    <div class="flex items-center flex-col">
        <h1 class="font-bold tracking-wide whitespace-nowrap"> {{ $approver }}</h1>
        @if($dateApproved === '')
        <p class="text-sm text-bland-400 absolute -bottom-10"></p>
        @else
        <p class="text-sm text-bland-400 text-center absolute -bottom-10">Date Approved: <br>{{ $dateApproved }}</p>
        @endif
    </div>
</div>
@endif