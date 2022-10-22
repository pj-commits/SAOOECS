<x-app-layout>
    <div class="pt-24"> 
        <div class="max-w-screen mx-auto px-4 lg:px-8">
            <div class="flex justify-between flex-wrap">
                <h1 class="flex items-center text-xl">
                    <span>
                        <x-svg width="w-7" height="w-7" color="fill-bland-600">
                            <path d="M6 22q-.825 0-1.412-.587Q4 20.825 4 20V4q0-.825.588-1.413Q5.175 2 6 2h8l6 6v4h-2V9h-5V4H6v16h6v2Zm0-2V4v16Zm12.3-5.475 1.075 1.075-3.875 3.85v1.05h1.05l3.875-3.85 1.05 1.05-4.3 4.3H14v-3.175Zm3.175 3.175L18.3 14.525l1.45-1.45q.275-.275.7-.275.425 0 .7.275l1.775 1.775q.275.275.275.7 0 .425-.275.7Z"/>
                        </x-svg>
                    </span> 
                    Budget Requisition Form
                </h1>
            </div>

            <!-- Tracker large Screen -->
            <div class="py-4 hidden xl:block">
                <x-tracker orientation="horizontal">
                    <x-tracker-item orientation="horizontal" approver="Adviser" dateApproved="{{$forms->adviser_date_approved ? \Carbon\Carbon::parse($forms->adviser_date_approved)->format('M d, Y') : null}}"/>
                    <x-tracker-item orientation="horizontal" approver="SAO" dateApproved="{{$forms->sao_date_approved ? \Carbon\Carbon::parse($forms->sao_date_approved)->format('M d, Y') : null}}"/>
                    <x-tracker-item orientation="horizontal" approver="Academic Services" dateApproved="{{$forms->acadserv_date_approved ? \Carbon\Carbon::parse($forms->acadserv_date_approved)->format('M d, Y') : null}}"/>
                    <x-tracker-item orientation="horizontal" approver="Finance and Accounting Office" dateApproved="{{$forms->finance_date_approved ? \Carbon\Carbon::parse($forms->finance_date_approved)->format('M d, Y') : null}}"/>
                </x-tracker>
            </div>

            <hr class="mt-3">
            <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">
                
                {{-- Row #1 --}}
                <div class="grid grid-flow-row auto-rows-max gap-6 my-4 md:grid-cols-4">
                       <p class="font-bold">Event Title: <span class="font-normal"> {{$forms->event_title}}</span></p>
                       <p class="font-bold md:col-start-4">Date Submitted: <span class="font-normal"> {{date('M d, Y', strtotime($forms->created_at))}}</span></p>
                </div>

                <hr>

                {{-- Row #2 --}}
                <div class="grid grid-flow-row auto-rows-max gap-6 my-4 md:grid-cols-4">
                    <p class="font-bold">Control Number: <span class="font-normal"> {{$forms->control_number}}</span></p>
                    <p class="font-bold md:col-start-4">Date Needed: <span class="font-normal">{{date('M d, Y', strtotime($requisition->date_needed))}}</span></p>
                </div>

                {{-- Row #3 --}}
                <div class="grid grid-flow-row auto-rows-max gap-6 my-4 md:grid-cols-4">
                    <p class="font-bold">Type: <span class="font-normal"> {{ucfirst($requisition->payment)}}</span></p>
                    <p class="font-bold md:col-start-4">Charged Department: <span class="font-normal"> {{$requisition->dept->name}}</span></p>
                </div>

                <hr>

                 {{-- Row #4 --}}
                 <h1 class="text-lg text-bland-600 font-bold my-4">Proposed Items</h1>
                 <div class="bg-white mt-4 h-auto w-full border-b border-gray-200 shadow-sm">
                     <div id="participant-container" class="overflow-auto block max-h-[420px] rounded-sm scroll-smooth">
                         <table class="table-auto w-full border-collapse border text-left">
                 
                             {{-- Table Head--}}
                             <thead class="border-b bg-bland-200 sticky top-0 z-10">
                                 {{-- Insert Table Head Columns Here --}}
                                 <x-table.head-col>#</x-table.head-col>
                                 <x-table.head-col>Quantity</x-table.head-col>
                                 <x-table.head-col>Particular</x-table.head-col>
                                 <x-table.head-col>Price</x-table.head-col>
                                 {{-- Table Head Columns Ends Here --}}
                             </thead>
                             {{-- Table Body --}}
                             <tbody>
                                @php $i = 1; @endphp
                                @foreach($requisitionItems as $item)
                                 <tr class="bg-white  hover:bg-bland-100 border-b border-bland-20">
                                    <x-table.body-col>
                                        <p class="pl-2">{{$i++}}</p>
                                    </x-table.body-col>
                                     <x-table.body-col>
                                         <p class="pl-2">{{$item->quantity}}</p>
                                     </x-table.body-col>
                                     <x-table.body-col>
                                         <p class="pl-2">{{$item->purposes}}</p>
                                     </x-table.body-col>
                                     <x-table.body-col>
                                         <p class="pl-2"><span>&#8369; </span> {{$item->price}}</p>
                                     </x-table.body-col>
                                 </tr>
                                 @endforeach
                             </tbody>
                             <tfoot>
                                <tr class="bg-bland-100">
                                    {{-- Insert Table Footer Columns Here --}}
                                    <x-table.footer-col>.
                                        {{-- Empty Space --}}
                                    </x-table.footer-col>
                                   <x-table.footer-col>.
                                       {{-- Empty Space --}}
                                   </x-table.footer-col>
                                   <x-table.footer-col  class="text-right">
                                       <p>Total:</p>
                                   </x-table.footer-col>
                                   <x-table.footer-col class="pl-4">
                                       <p>{Data Here}</p>                                   
                                    </x-table.footer-col>
                                   {{-- Table Footer Columns Ends Here --}}
                                </tr>
                             </tfoot>
                         </table>
                     </div>
                 </div>

                 <hr class="mt-4">
                 
                {{-- Row #5 --}}
                <div class="flex my-4 space-x-2">
                    <p class="font-bold">Remarks: </p>
                    <p>{{$requisition->remarks}}</p>
                </div>

              

                <hr class="mt-4">

                <div class="mt-8 mb-2">
                    <x-button class="px-8">
                        {{ __('Approve') }}
                    </x-button>
                    <x-button class="px-12" bg="bg-semantic-danger" hover="hover:bg-rose-600">
                        {{ __('Deny') }}
                    </x-button>
                </div>

                <!-- Tracker Small Screen-->
                <div class="py-4 block xl:hidden">
                    <x-tracker orientation="vertical">
                        <x-tracker-item orientation="vertical" approver="Adviser" dateApproved="{{$forms->adviser_date_approved ? \Carbon\Carbon::parse($forms->adviser_date_approved)->format('M d, Y') : null}}"/>
                        <x-tracker-item orientation="vertical" approver="SAO" dateApproved="{{$forms->sao_date_approved ? \Carbon\Carbon::parse($forms->sao_date_approved)->format('M d, Y') : null}}"/>
                        <x-tracker-item orientation="vertical" approver="Academic Services" dateApproved="{{$forms->acadserv_date_approved ? \Carbon\Carbon::parse($forms->acadserv_date_approved)->format('M d, Y') : null}}"/>
                        <x-tracker-item orientation="vertical" approver="Finance and Accounting Office" dateApproved="{{$forms->finance_date_approved ? \Carbon\Carbon::parse($forms->finance_date_approved)->format('M d, Y') : null}}"/>
                    </x-tracker>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>












