<x-mail::message>
# Out Of Stock

The following Products are running out of stock in the Store:
<br>
<span style="color: red;">{{ $data['message'] }}</span>
    <br>
Please Update them as soon as possible!

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
