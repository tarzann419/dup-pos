@component('mail::message')
# Introduction

# Expiry Notification
<br>
The Following are expiring soon :(
<br>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Expiry Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['expiringSoon'] as $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['expiry_date'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- <span style="color: red;">{{ $data['message'] }}</span> --}}
<br>
Please Check Them Now!

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
