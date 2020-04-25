@component('mail::message')
# You have register successfully on Fad website.

Dear sir/madam, 

You have register in a clothes shopping- Fad. If it is you, please click under link to complete registation :

If it's not you, you dont need do anything.

@component('mail::button', ['url' => ''])
Continue shopping
@endcomponent

Thanks,<br>
Fad shop. 
{{ config('app.name') }}
@endcomponent
