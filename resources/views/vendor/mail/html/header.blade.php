<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Medinformer')
<img src="https://practitioner.medinformer.co.za/images/Cipla_logo.svg_-.png" class="logo" alt="Medinfomer Logo" style="width: 230px !important; height: auto;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
