<x-mail::message>
# Out Of Stock
<br>
The Following are running out of stock:(
    <br>
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
