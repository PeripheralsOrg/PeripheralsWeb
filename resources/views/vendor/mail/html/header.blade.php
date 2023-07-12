@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Peripherals')
<img src="https://new-peripherals.s3.amazonaws.com/logo-peripherals.jpeg" class="logo" alt="Peripherals Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
