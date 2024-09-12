@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'DBI')
<img src="{{ asset('/DB_LOGO__.png') }}" alt="Logo" class="logo" style="width: 150px; height: auto;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
