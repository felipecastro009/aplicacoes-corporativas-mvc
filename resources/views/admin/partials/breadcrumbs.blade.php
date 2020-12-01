@if(Agent::isDesktop())
@if (count($breadcrumbs))
  <div class="section-header-breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
      @if ($breadcrumb->url && !$loop->last)
        <div class="breadcrumb-item">
          <a href="{{ $breadcrumb->url }}" title="{{ $breadcrumb->title }}">{{ $breadcrumb->title }}</a>
        </div>
      @else
        <div class="breadcrumb-item breadcrumb-active">
          <a href="{{ $breadcrumb->url }}" title="{{ $breadcrumb->title }}">{{ $breadcrumb->title }}</a>
        </div>
      @endif
    @endforeach
  </div>
@endif
@endif
