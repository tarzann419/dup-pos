<x-mail::message>
# Introduction

# Expiry Notification
<br>
The Following are expiring soon :(
    <br>
{{ $data['message'] }}
<br>
Please Check Them Now!


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
