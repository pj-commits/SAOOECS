@component('mail::message')
# <p class="suc">Submitted Successfully!</p>
<br>
The <b>Requisition Form</b> was submitted.

@component('mail::panel')
Kindly wait for its approval.
<br>
<br>
To view your <b>Requisition Form</b> status, please click the button below:
@endcomponent

@component('mail::button', ['url' => URL::route('dashboard')])
View Status
@endcomponent

Thanks,<br>
SAO Online Event Creation System
@endcomponent
