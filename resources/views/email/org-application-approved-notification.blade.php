@component('mail::message')
# <p class="suc">Congratulations!</p>
<br>
Your <b>Student Organization Application</b> has been approved.
<br>

@component('mail::panel')
To view the Student Organization, kindly click the button below:
@endcomponent

@component('mail::button', ['url' => URL::route('dashboard')])
View Application
@endcomponent

Thanks,<br>
SAO Online Event Creation System
@endcomponent
