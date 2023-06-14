<x-mail::message>
# Introduction

# Expiry Notification
<br>
The Following are expiring soon :(
    <br>

<span style="color: red;">{{ $data['message'] }}</span>
<br>
Please Check Them Now!


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
