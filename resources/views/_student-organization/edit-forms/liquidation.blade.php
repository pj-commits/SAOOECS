<x-app-layout>
    <div class="pt-24" x-data="set_local_storage_data('lf')"> {{-- lf = Liqiudation Form --}}
        <div class="max-w-screen mx-auto px-4 lg:px-8" x-data="get_local_storage_data('lf')">
            <div class="flex justify-between flex-wrap">
                <h1 class="flex items-center text-xl">
                    <span>
                        <x-svg width="w-7" height="w-7" color="fill-bland-600">
                            <path d="M6 22q-.825 0-1.412-.587Q4 20.825 4 20V4q0-.825.588-1.413Q5.175 2 6 2h9l5 5v13q0 .825-.587 1.413Q18.825 22 18 22Zm0-2h12V8h-4V4H6v16Zm6-1q1.675 0 2.838-1.175Q16 16.65 16 15v-4h-2v4q0 .825-.575 1.413Q12.85 17 12 17q-.825 0-1.412-.587Q10 15.825 10 15V9.5q0-.225.15-.363Q10.3 9 10.5 9q.225 0 .363.137.137.138.137.363V15h2V9.5q0-1.05-.725-1.775Q11.55 7 10.5 7q-1.05 0-1.775.725Q8 8.45 8 9.5V15q0 1.65 1.175 2.825Q10.35 19 12 19ZM6 4v4-4 16V4Z"/>
                        </x-svg>
                    </span> 
                    Liquidation Form
                </h1>
            </div>
            <hr class="mt-3">

            <!-- Form Deinied - Message -->
            <x-edit-form-message message="Liquidation Form"/>

            <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">
                <form action="{{ route('test') }}" method="POST">
                    @csrf

                     {{-- Row #1 --}}                 
                     <div class="grid grid-flow-row auto-rows-max gap-6 md:grid-cols-3">

                        {{-- Event Title --}}
                        <div>
                            <x-label for="event_title" :value="__('Event Title')" />

                            <x-select class="mt-1" id="event_title" name="event_title" aria-label="Default select example">
                                <option value='' selected disabled>--select option--</option>
                            </x-select>
                        </div>

                        {{-- End Date --}}
                        <div>
                            <x-label for="end_date" :value="__('End Date')" />
                            
                            <x-input id="end_date" class="mt-1 w-full" type="date" name="end_date" required autofocus/>
                        </div>

                        {{-- Cash Advance --}}
                        <div>
                            <x-label for="cash_advance" :value="__('Cash Advance (₱)')" />

                            <x-input id="cash_advance" class="mt-1 w-full" type="number" min="1" name="cash_advance" required autofocus/>
                        </div>

                    </div>


                     {{-- Row #2 --}}                 
                     <div class="grid grid-flow-row auto-rows-max gap-6 md:grid-cols-3 mt-4">

                        {{-- CV Number --}}
                        <div>
                            <x-label for="cv_number" :value="__('CV Number')" />

                            <x-input id="cv_number" class="mt-1 w-full" type="text" name="cv_number" required autofocus/>
                        </div>

                        {{-- Deduct --}}
                        <div>
                            <x-label for="deduct" :value="__('Deduct (₱)')" />

                            <x-input id="deduct" class="mt-1 w-full" type="number" min="1" name="deduct" required autofocus/>
                        </div>

                    </div>


                    {{-- Row #3 Liquidation Items --}}
                    <hr class="mt-6 border-1 border-bland-300">

                    <h1 class="text-lg text-bland-600 font-bold my-4">Items</h1>

                    <div x-data="liquidation_items_handler()">
                        <x-table.main>
                            {{-- Table Head--}}
                            <x-table.head>
                                {{-- Insert Table Head Columns Here --}}
                                <x-table.head-col class="w-32 pr-12 sm:pr-3">Item No.</x-table.head-col>
                                <x-table.head-col class="pr-12 sm:pr-3">Date Bought</x-table.head-col>
                                <x-table.head-col>Particulars/Items</x-table.head-col>
                                <x-table.head-col class="pr-12 sm:pr-3">Price (₱)</x-table.head-col>
                                <x-table.head-col class="text-center">Action</x-table.head-col>
                                {{-- Table Head Columns Ends Here --}}
                            </x-table.head>
                            {{-- Table Body --}}
                            <tbody>
                                <template x-for="(field, index) in liquidations[0]" :key="index">
                                    <tr class="bg-white  hover:bg-bland-100">
                                        {{-- Insert Table Body Columns Here --}}
                                        <x-table.body-col>
                                            <x-input x-model="field.item_number"  id="item_number" class="mt-1 w-full" type="text" name="item_number[]"  readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                            <x-input x-model="field.date_bought"  id="date_bought" class="mt-1 w-full" type="date" name="date_bought[]"  readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                            <x-input x-model="field.item" id="item" class="mt-1 w-full" type="text" name="item[]"  readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                            <x-input x-model="field.price" id="price" class="mt-1 w-full" type="number" min="1" name="price[]" readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col class="text-center px-1">
                                            <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeLiquidation(index)">
                                                {{ __('Remove') }}
                                            </x-button>
                                        </x-table.body-col>
                                        {{-- Table Body Columns Ends Here --}}
                                    </tr>
                                </template>
                            </tbody>
                             {{-- Table Footer --}}
                            <tfoot class="border-t border-bland-100">
                                <tr>
                                    {{-- Insert Table Footer Columns Here --}}
                                    <x-table.footer-col>
                                        <x-input x-model="getItemNumber()" class="mt-1 w-full" type="text" readonly />
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        <x-input x-model="newLiquidations[0].date_bought" class="mt-1 w-full" type="date" autofocus />
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        <x-input x-model="newLiquidations[0].item" class="mt-1 w-full" type="text" autofocus />
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        <x-input x-model="newLiquidations[0].price" class="mt-1 w-full" type="number" min="1" autofocus />
                                    </x-table.footer-col>
                                    <x-table.footer-col class="px-1 text-center">
                                        <x-button @click="addLiquidation()">
                                            {{ __('Add Row') }}
                                        </x-button>
                                    </x-table.footer-col>
                                    {{-- Table Footer Columns Ends Here --}}
                                </tr>
                                <tr class="bg-bland-100">
                                    {{-- Insert Table Footer Columns Here --}}
                                    <x-table.footer-col>
                                        {{-- Empty Space --}}
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        {{-- Empty Space --}}
                                    </x-table.footer-col>
                                    <x-table.footer-col  class="text-right">
                                        <p>Total:</p>
                                    </x-table.footer-col>
                                    <x-table.footer-col class="pl-4">
                                        <span class="flex">₱ <p x-text="getTotal()"></p></span>
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        {{-- Empty Space --}}
                                    </x-table.footer-col>
                                    {{-- Table Footer Columns Ends Here --}}
                                </tr>
                            </tfoot>
                        </x-table.main>
                        <span x-show="error" class="flex text-sm text-semantic-danger font-light">*<p x-text="msg"></p></span>
                    </div>


                    {{-- Row #4 --}}
                    <div class="pt-3">
                        <!-- Proof of payments -->
                        {{-- <div class="w-full p-3 border-2 border-dashed hover:border-primary-blue">

                            <div>
                                <h1 class="text-lg text-bland-600 my-2">Proof of Payments</h1>
                                <livewire:multiple-upload />
                            </div>

                        </div> --}}

                    <hr class="mt-6 border-1 border-bland-300">

                    <h1 class="text-lg text-bland-600 font-bold my-4">Proof of Payment</h1>
                    
                    <div x-data="proof_of_payments()">
                        <x-table.main>
                            {{-- Table Head--}}
                            <x-table.head>
                                {{-- Insert Table Head Columns Here --}}
                                <x-table.head-col class="">Item From</x-table.head-col>
                                <x-table.head-col class="">Item To</x-table.head-col>
                                <x-table.head-col class="">Proof of Payment</x-table.head-col>
                                <x-table.head-col class="text-center">
                                    <x-button @click="addNewRow">
                                        <x-svg class="mr-0">
                                            <path d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4Zm-6 4q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h14q.825 0 1.413.587Q21 4.175 21 5v14q0 .825-.587 1.413Q19.825 21 19 21Zm0-2h14V5H5v14ZM5 5v14V5Z"/>
                                        </x-svg>
                                    </x-button>
                                </x-table.head-col>
                                {{-- Table Head Columns Ends Here --}}
                            </x-table.head>
                            {{-- Table Body --}}
                            <tbody>
                                <template x-for="(row, index) in rows" :key="index">
                                    <tr class="bg-white  hover:bg-bland-100">
                                        {{-- Insert Table Body Columns Here --}}
                                        <x-table.body-col>
                                            <x-input x-model="row.itemFrom"  id="itemFrom" class="mt-1 w-full" type="number" min="1" name="itemFrom[]"  required autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                            <x-input x-model="row.itemTo"  id="itemTo" class="mt-1 w-full" type="number" min="1" name="itemTo[]"  required autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                                <input x-model="row.image" class="form-control
                                                block
                                                w-full
                                                px-3
                                                py-1.5
                                                text-base
                                                font-normal
                                                text-gray-700
                                                bg-white bg-clip-padding
                                                border border-solid border-gray-300
                                                rounded
                                                transition
                                                ease-in-out
                                                m-0
                                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="image" name="image[]">
                                        </x-table.body-col>
                                        <x-table.body-col class="text-center px-1">
                                            <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeRow(index)">
                                                {{ __('Remove') }}
                                            </x-button>
                                        </x-table.body-col>
                                        {{-- Table Body Columns Ends Here --}}
                                    </tr>
                                </template>
                            </tbody>

                        </x-table.main>
                        
                    </div>


                    </div>

                    {{-- Submit Button--}}
                    <div class="mt-8">
                        <x-button type="submit" class="px-12">
                            {{ __('Submit') }}
                        </x-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>