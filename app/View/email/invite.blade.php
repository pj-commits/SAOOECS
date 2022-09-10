@component('mail::message')

You are invited to {{$orgName}}
{{$position}} {{$role}}

@component('mail::button', ['url' => '{{ route('dashboard') }}'])
@endcomponent