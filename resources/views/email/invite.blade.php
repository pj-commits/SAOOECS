@component('mail::message')

You are invited to {{$currOrgName}}
{{$position}} {{$role}}

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
COME IN
@endcomponent