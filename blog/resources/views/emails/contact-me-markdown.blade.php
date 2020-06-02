@component('mail::message')

# A Heading

Some random text here

- A list
- B list

@component('mail::button', ['url' => 'https://google.com'])
Say Hello
@endcomponent

Thanks, Best regards<br />
{{ config('app.name') }}

@endcomponent
