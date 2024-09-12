<x-mail::message>
# {{$subject}}

<x-mail::table>
|   |           |
|:-------|----------------|
| Name  |: {{ $name }}             |
| Contact No.|: {{ $contact }}          |
| Email  |: {{ $email }}    |
| Message  |: {{ $message }}    |
</x-mail::table>

<x-mail::button :url="'https://main.dbiphils.com/admin/main-responses'" color="success">
View Details
</x-mail::button>
<x-mail::footer>
    This message is auto-generated. Reply is set to the user's email address. ズイ
</x-mail::footer>
</x-mail::message>

