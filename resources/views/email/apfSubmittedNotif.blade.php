@component('mail::message')
# <p class="suc">Submitted Successfully!</p>
<br>
The <b>Activity Proposal Form</b> was submitted.

@component('mail::panel')
Kindly wait for its approval.
<br>
<br>
To view your <b>Activity Proposal Form</b> status, please click the button below:
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
View Status
@endcomponent

Thanks,<br>
SAO Online Event Creation System
@endcomponent
