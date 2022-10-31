@props(['forms'])
@php
    $forms = substr($forms, 1, -1);
@endphp
<div x-data="{ listOfEventsModal: false, modal: false }" class="w-auto h-auto lg:w-3/4">

    <div x-data="calendar()" x-init="[initDate(), getNoOfDays()]" x-cloak @load.window="addEvent({{ $forms }})">

      <div class="bg-white rounded-sm shadow overflow-hidden h-auto">

        <div class="flex items-center justify-between py-2 px-6">
          <div>
            <span x-text="MONTH_NAMES[month]" class="text-xl font-bold text-gray-800"></span>
            <span x-text="year" class="ml-1 text-sm text-gray-600 font-normal"></span>
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
                    <div x-data="{ num : getRandomNum() }" 
                          class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer hover:absolute hover:z-30" 
                          :class="{
                            'border-green-200 text-semantic-success bg-green-100': num === 1,
                            'border-blue-200 text-semantic-info bg-blue-100': num === 2,
                            'border-yellow-200 text-primary-yellow bg-yellow-100': num === 3,
                            'border-rose-200 text-semantic-warning bg-rose-100': num === 4,
                          }"
                          @click="listOfEventsModal = true, modal = true, getEvents(date, 'modalEvents')">
                      <p class="text-sm truncate leading-tight hover:text-clip"><span x-text="getEvents(date, 'getLength')"></span><span> Pending Form</span></p>
                    </div>
                  </template>
                </div>

              </div>
            </template>
          </div>
        </div>
      </div>

      <!-- Modal List of Pending Forms -->
      <x-modal name="listOfEventsModal">
        <div class="mt-2 space-y-2 max-h-72 overflow-y-auto">
          <template x-for="event in listOfEvents">	
            <div
              @click="viewForm(event.id)"
              class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer"
              :class="{
                'hover:border-green-200 text-semantic-success hover:bg-green-100 bg-green-50 border-green-300': event.form_type === 'APF',
                'hover:border-blue-200 text-semantic-info hover:bg-blue-100 bg-blue-50 border-blue-300': event.form_type === 'BRF',
                'hover:border-yellow-200 text-primary-yellow hover:bg-yellow-100 bg-yellow-50 border-yellow-300': event.form_type === 'NR',
                'hover:border-rose-200 text-semantic-warning hover:bg-rose-100 bg-rose-50 border-rose-300': event.form_type === 'LF',
              }"
            >
              <p class="text-sm leading-tight">
                <span class="font-bold">Organization: </span><span x-text="event.organization"></span><br>
                <span class="font-bold">Event Title: </span><span x-text="event.event_title"></span><br>
                <span class="font-bold">Form Type: </span><span x-text="event.description"></span>
              </p>

              
            </div>
          </template>
        </div>
      </x-modal>
      
  </div>
</div>