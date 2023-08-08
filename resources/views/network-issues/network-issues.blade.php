@if (isset($network_issues) && $network_issues->isNotEmpty())
  @if ($network_issues->first()->status == 'Scheduled')
    @include('network-issues/network-info')
  @else 
    @include('network-issues/network-warning')
  @endif
@endif