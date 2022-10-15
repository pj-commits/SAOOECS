@php
  $forms = json_encode($pendingForms);
@endphp
<x-app-layout>
    <div x-data="{ listOfEventsModal: false, modal: true }" class="pt-16"> 
        <div class="w-auto h-auto m-2 lg:w-3/4">

            <div x-data="calendar()" x-init="[initDate(), getNoOfDays()]" x-cloak>
              <div class="container mx-auto px-4 lg:px-8" @load.window="addEvent({{ $forms }})">

                <div class="bg-white rounded-sm shadow overflow-hidden h-auto">
          
                  <div class="flex items-center justify-between py-2 px-6">
                    <div>
                      <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                      <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                    </div>
                    <div class="border rounded-lg px-1" style="padding-top: 2px;">
                      <button 
                        type="button"
                        class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
                        :class="{'cursor-not-allowed opacity-25': month == 0 }"
                        :disabled="month == 0 ? true : false"
                        @click="month--; getNoOfDays()">
                        <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>  
                      </button>
                      <div class="border-r inline-flex h-6"></div>		
                      <button 
                        type="button"
                        class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
                        :class="{'cursor-not-allowed opacity-25': month == 11 }"
                        :disabled="month == 11 ? true : false"
                        @click="month++; getNoOfDays()">
                        <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>									  
                      </button>
                    </div>
                  </div>	
          
                  <div class="-mx-1 -mb-1">
                    <div class="flex flex-wrap" style="margin-bottom: 10px;">
                      <template x-for="(day, index) in DAYS" :key="index">	
                        <div style="width: 14.26%" class="px-2 py-2">
                          <div
                            x-text="day" 
                            class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                        </div>
                      </template>
                    </div>
          
                    <div class="flex flex-wrap border-t border-l">
                      <template x-for="blankday in blankdays">
                        <div 
                          style="width: 14.28%; height:80px"
                          class="text-center border-r border-b px-4 pt-2"	
                        ></div>
                      </template>	
                      <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">	
                        <div style="width: 14.28%; height: 80px" class="px-4 pt-2 border-r border-b relative">
                          <div
                            x-text="date"
                            class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                            :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }">
                          </div>


                          <div style="height: 40px;" class="overflow-y-auto mt-1">

                            <template x-if="getEvents(date, 'getLength') > 0">
                              <div class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer border-blue-200 text-blue-800 bg-blue-100 hover:absolute hover:z-30" @click="listOfEventsModal = true, modal = true, getEvents(date, 'modalEvents')">
                                <p class="text-sm truncate leading-tight hover:text-clip"><span x-text="getEvents(date, 'getLength')"></span><span> Pending Form</span></p>
                              </div>
                            </template>
                          </div>

                        </div>
                      </template>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal List of Pending Forms -->
              <x-modal name="listOfEventsModal">
                <template x-for="event in listOfEvents">	
                  <div
                    @click="console.log(event.id)"
                    class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer"
                    :class="{
                      'border-blue-200 text-blue-800 bg-blue-100': event.form_type === 'APF',
                      'border-red-200 text-red-800 bg-red-100': event.form_type === 'BRF',
                      'border-yellow-200 text-yellow-800 bg-yellow-100': event.form_type === 'NR',
                      'border-green-200 text-green-800 bg-green-100': event.form_type === 'LF',
                    }"
                  >
                    <p class="text-sm truncate leading-tight"><span x-text="event.form_description"></span> - <span x-text="event.event_title"></span></p>
                  </div>
                </template>
              </x-modal>

            </div>
        </div>
    </div>
</x-app-layout>



{{-- <div class="max-w-screen mx-auto px-4 lg:px-8">
    <div class="bg-white mt-4 h-auto w-full rounded-sm px-6 py-4"> --}}
        