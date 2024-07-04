<x-mail::message>
# Mensagem de {{$data['name']}}

<p>Mensagem: <br>
    {{$data['message']}}
</p>

<x-mail::button :url="'https://www.instagram.com/p/C1kLAFZsa3q/'">
    Acess my site
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
