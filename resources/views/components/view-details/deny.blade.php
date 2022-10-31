@props(['id', 'eventTitle', 'formType'])

@php
    $formTypes = [ 'APF' => 'Activity Proposal Form', 'BRF' => 'Budget Requisition Form', 'NR' => 'Narrative Report', 'LF' => 'Liquidation Form'];
    
    $id = (substr($id, 1, -1));
    $eventTitle = (substr($eventTitle, 1, -1));
    $formType = (substr($formType, 1, -1));
@endphp

<x-modal name="denyForm" width="w-[600px]">
    <div class="text-sm text-bland-600 text-left py-5">
        I am rejecting the form <b>{{ $eventTitle }} - {{ $formTypes[$formType] }}</b> for these reasons:
    </div>
    <form action="{{ route('submitted-forms.deny', ['forms' => $id]) }}" method="POST">
        @csrf
        @method('PUT')
        <x-text-area rows="2" name="remarks" id="remarks" autfocus></x-text-area>

            <div class="flex justify-end space-x-2 mt-5">

            <x-button bg="bg-semantic-success" hover="hover:bg-green-600" type="submit" >
                {{ __('Confirm') }}
            </x-button>

            <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="denyForm = false, modal = false" >
                    {{ __('Cancel') }}
            </x-button>
        </div>
    <form>
</x-modal>