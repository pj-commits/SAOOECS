@component('mail::message')
# <p class="suc">The <b>{formType} Form</b> was forwarded to the <b>{nextApprover}</b>.</p>

@component('mail::panel')
<h2>Please wait for 1-3 days for approval.</h2>
<br>
To view your <b>{formType} Form</b> status, please click the button below:
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/submittedForms'])
View Status
@endcomponent

Thanks,<br>
SAO Online Event Creation System
@endcomponent
