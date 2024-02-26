@component('mail::message')
# {{ $details['title'] }}
Your message body.
@component('mail::button', ['url' => $details['url']])
Verify
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent