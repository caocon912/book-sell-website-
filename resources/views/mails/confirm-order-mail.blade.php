@component('mail::message')
# You have ordered successfully on Fad website.

Dear sir/madam, 

Your orders on Fad website was successfully. Your detail order:


@component('mail::button', ['url' => ''])
Continue shopping
@endcomponent

Thanks,<br>
Fad shop. 
{{ config('app.name') }}
@endcomponent
