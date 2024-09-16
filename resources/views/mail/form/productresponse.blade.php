<x-mail::message>
# New Product Inquiry for {{$product}}

<x-mail::table>
|   |           |
|:-------|----------------|
| Inquiry for   |: {{ $product }}             |
| Name   |: {{ $name }}             |
| Contact No.|: {{ $contact }}          |
| Email |: {{ $email }}    |
| Message|: {{ $message }}    |
</x-mail::table>

<x-mail::button :url="'https://dbiphils.com/admin/product-responses'" color="success">
View Details
</x-mail::button>
<x-mail::footer>
    This message is auto-generated. Reply is set to the user's email address. ズイ
</x-mail::footer>
</x-mail::message>
