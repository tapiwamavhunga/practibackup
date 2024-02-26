@component('mail::message')
# New Registration 

A new user has been registered. <br>

Name : {{$user->name}}
<br>
Email : {{$user->email}}

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
