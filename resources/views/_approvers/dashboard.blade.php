@php
$Forms = json_encode($forms);
$pendingFormCount = count($forms)   
@endphp
<x-app-layout>
  {{-- Row #1 --}}
  <div class="pt-24 px-4 lg:px-8 mb-4">
    <!-- Card - Pending Forms -->
    <x-dashboard.card-pending-forms>
      {{ $pendingFormCount }}
    </x-dashboard.card-pending-forms>
  </div>

    {{-- Row #2 --}}
    <div class="flex flex-col justify-between px-4 lg:space-x-4 lg:flex-row lg:px-8">
      <!-- Calendar -->
      <x-dashboard.calendar forms="{{!! $Forms !!}}"/>

      <!-- Cards - Total Approved -->
      @if($isAcadservOrFinance)
      <div class="flex flex-col justify-start space-y-8  w-1/4">
      @else
      <div class="grid grid-cols-1 mt-4 gap-x-4 sm:grid-cols-2 lg:w-1/4 lg:grid-cols-1 lg:gap-4 lg:mt-0">
      @endif      
          <x-dashboard.card-total-approved name="APF" number="100">
            <path d="M6 22q-.825 0-1.412-.587Q4 20.825 4 20V4q0-.825.588-1.413Q5.175 2 6 2h8l6 6v4h-2V9h-5V4H6v16h6v2Zm0-2V4v16Zm12.3-5.475 1.075 1.075-3.875 3.85v1.05h1.05l3.875-3.85 1.05 1.05-4.3 4.3H14v-3.175Zm3.175 3.175L18.3 14.525l1.45-1.45q.275-.275.7-.275.425 0 .7.275l1.775 1.775q.275.275.275.7 0 .425-.275.7Z"/>
          </x-dashboard.card-total-approved>

          <x-dashboard.card-total-approved name="BRF" number="200">
            <path d="M11 18h2v-1h1q.425 0 .713-.288Q15 16.425 15 16v-3q0-.425-.287-.713Q14.425 12 14 12h-3v-1h4V9h-2V8h-2v1h-1q-.425 0-.712.287Q9 9.575 9 10v3q0 .425.288.712Q9.575 14 10 14h3v1H9v2h2Zm-5 4q-.825 0-1.412-.587Q4 20.825 4 20V4q0-.825.588-1.413Q5.175 2 6 2h8l6 6v12q0 .825-.587 1.413Q18.825 22 18 22Zm0-2h12V8.85L13.15 4H6v16Zm0 0V4v16Z"/>
          </x-dashboard.card-total-approved>
          
          @if(!$isAcadservOrFinance)
          <x-dashboard.card-total-approved name="NR" number="300">
            <path d="M8 20q-.825 0-1.412-.587Q6 18.825 6 18v-3h3v-2.25q-.875-.05-1.662-.388-.788-.337-1.438-1.012v-1.1H4.75L1.5 7q.9-1.15 2.225-1.625Q5.05 4.9 6.4 4.9q.675 0 1.313.1.637.1 1.287.375V4h12v13q0 1.25-.875 2.125T18 20Zm3-5h6v2q0 .425.288.712.287.288.712.288t.712-.288Q19 17.425 19 17V6h-8v.6l6 6V14h-1.4l-2.85-2.85-.2.2q-.35.35-.738.625-.387.275-.812.425ZM5.6 8.25h2.3v2.15q.3.2.625.275.325.075.675.075.575 0 1.038-.175.462-.175.912-.625l.2-.2-1.4-1.4q-.725-.725-1.625-1.088Q7.425 6.9 6.4 6.9q-.5 0-.95.075-.45.075-.9.225ZM8 18h7.15q-.075-.225-.112-.475Q15 17.275 15 17H8Zm0 0v-1 1Z"/>
          </x-dashboard.card-total-approved>
          @endif

          <x-dashboard.card-total-approved name="LF" number="400">
            <path d="M6 22q-.825 0-1.412-.587Q4 20.825 4 20V4q0-.825.588-1.413Q5.175 2 6 2h9l5 5v13q0 .825-.587 1.413Q18.825 22 18 22Zm0-2h12V8h-4V4H6v16Zm6-1q1.675 0 2.838-1.175Q16 16.65 16 15v-4h-2v4q0 .825-.575 1.413Q12.85 17 12 17q-.825 0-1.412-.587Q10 15.825 10 15V9.5q0-.225.15-.363Q10.3 9 10.5 9q.225 0 .363.137.137.138.137.363V15h2V9.5q0-1.05-.725-1.775Q11.55 7 10.5 7q-1.05 0-1.775.725Q8 8.45 8 9.5V15q0 1.65 1.175 2.825Q10.35 19 12 19ZM6 4v4-4 16V4Z"/>
          </x-dashboard.card-total-approved>

      </div> 
  </div> 
</x-app-layout>