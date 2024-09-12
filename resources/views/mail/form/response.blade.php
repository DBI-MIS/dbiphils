<x-mail::message>
# New Job Application for {{$job_title}}

<x-mail::table>
|   |           |
|:-------|----------------|
| Applied for|: {{ $job_title }}             |
| Name|: {{ $name }}             |
| Contact No.|: {{ $contact }}          |
| Email|: {{ $email_address }}    |
</x-mail::table>

<x-mail::button :url="'https://main.dbiphils.com/admin/job-responses'" color="success">
View Details
</x-mail::button>

<x-mail::footer>
    This message is auto-generated. Reply is set to the applicant's email address. ズイ
</x-mail::footer>
</x-mail::message>
