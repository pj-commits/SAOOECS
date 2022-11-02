@component('mail::message')
# <p class="suc">Congratulations!</p>
<br>
You have been added to <b>{orgName[0]}</b> 
<br>

@component('mail::panel')
Position: <b>{emailData['position']}</b>
<br>
Role: <b>{emailData['role']}</b>
<br>
<br>
<br>
To view your student organization, kindly click the button below:
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/roles'])
View Organization
@endcomponent

Thanks,<br>
SAO Online Event Creation System
@endcomponent
