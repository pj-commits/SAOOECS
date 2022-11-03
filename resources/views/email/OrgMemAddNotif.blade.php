@component('mail::message')
# <p class="successform">Congratulations!</p>
<br>
You have been added to <b>JISAA</b> as <b>Member</b>!
<br>
@component('mail::panel')
To view your student organization, kindly click the button below:
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/roles'])
View Organization
@endcomponent

Thanks,<br>
SAO Online Event Creation System
@endcomponent
