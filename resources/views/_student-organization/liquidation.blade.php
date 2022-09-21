<x-app-layout>
    <div class="pt-12" x-data="set_session_storage_data('lf')"> {{-- lf = Liqiudation Form --}}
        <div class="max-w-screen mx-auto px-4 lg:px-8" x-data="get_session_storage_data('lf')">
            <div class="flex justify-between flex-wrap">
                <h1 class="flex items-center text-xl">
                    <span>
                        <x-svg width="7" height="7" color="bland-600">
                            <path d="M6 22q-.825 0-1.412-.587Q4 20.825 4 20V4q0-.825.588-1.413Q5.175 2 6 2h8l6 6v4h-2V9h-5V4H6v16h6v2Zm0-2V4v16Zm12.3-5.475 1.075 1.075-3.875 3.85v1.05h1.05l3.875-3.85 1.05 1.05-4.3 4.3H14v-3.175Zm3.175 3.175L18.3 14.525l1.45-1.45q.275-.275.7-.275.425 0 .7.275l1.775 1.775q.275.275.275.7 0 .425-.275.7Z"/>
                        </x-svg>
                    </span> 
                    Narrative Report
                </h1>
                <x-button @click="clear_form_session_storage('lf', true), loading(true)">
                    <x-svg width="5" height="5">
                        <path d="M11 20.95q-3.025-.375-5.012-2.638Q4 16.05 4 13q0-1.65.65-3.163Q5.3 8.325 6.5 7.2l1.425 1.425q-.95.85-1.437 1.975Q6 11.725 6 13q0 2.2 1.4 3.887 1.4 1.688 3.6 2.063Zm2 0v-2q2.175-.4 3.587-2.075Q18 15.2 18 13q0-2.5-1.75-4.25T12 7h-.075l1.1 1.1-1.4 1.4-3.5-3.5 3.5-3.5 1.4 1.4-1.1 1.1H12q3.35 0 5.675 2.325Q20 9.65 20 13q0 3.025-1.987 5.288Q16.025 20.55 13 20.95Z"/>
                    </x-svg>
                    {{ __('Reset') }}
                </x-button>
            </div>
            <hr class="mt-3">
            <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">
                <form action="{{ route('test') }}" method="POST">
                    @csrf

                     {{-- Row #1 --}}                 
                     <div class="grid grid-flow-row auto-rows-max gap-6 md:grid-cols-3">

                        {{-- Event Title --}}
                        <div>
                            <x-label for="event_title" :value="__('Event Title')" />

                            <x-select class="mt-1" id="event_title" name="event_title" aria-label="Default select example" @change="storeInput($el)">
                                <option value='' selected disabled>--select option--</option>
                            </x-select>
                        </div>

                        {{-- End Date --}}
                        <div>
                            <x-label for="end_date" :value="__('End Date')" />
                            
                            <x-input id="end_date" class="mt-1 w-full" type="date" name="end_date" required autofocus @change="storeInput($el)"/>
                        </div>

                        {{-- Cash Advance --}}
                        <div>
                            <x-label for="cash_advance" :value="__('Cash Advance (₱)')" />

                            <x-input id="cash_advance" class="mt-1 w-full" type="number" min="1" name="cash_advance" required autofocus @keyup="storeInput($el)"/>
                        </div>

                    </div>


                     {{-- Row #2 --}}                 
                     <div class="grid grid-flow-row auto-rows-max gap-6 md:grid-cols-3 mt-4">

                        {{-- CV Number --}}
                        <div>
                            <x-label for="cv_number" :value="__('CV Number')" />

                            <x-input id="cv_number" class="mt-1 w-full" type="text" name="cv_number" required autofocus @keyup="storeInput($el)"/>
                        </div>

                        {{-- Deduct --}}
                        <div>
                            <x-label for="deduct" :value="__('Deduct (₱)')" />

                            <x-input id="deduct" class="mt-1 w-full" type="number" min="1" name="deduct" required autofocus @keyup="storeInput($el)"/>
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
                        <div class="w-full p-3 border-2 border-dashed hover:border-primary-blue">

                            <div>
                                <h1 class="text-lg text-bland-600 my-2">Proof of Payments</h1>
                                <livewire:multiple-upload />
                            </div>

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