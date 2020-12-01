<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand mb-2">
      <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('/assets/img/home.svg') }}" width="50"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('/assets/img/home.svg') }}" width="50"></a>
    </div>
    <ul class="sidebar-menu">
      @foreach(config('qualitare.modules') as $module)
        @foreach($module as $header)
          @can($header['permission'])
            <li class="menu-header">{{ $header['header'] }}</li>
          @endcan
          @foreach($header['items'] as $item)
            @if(!isset($item['submodules']))
              @can($item['permission'])
                <li class="{{ (Route::currentRouteName() == $item['route']) ? 'active' : '' }}">
                  <a class="{{ (Route::currentRouteName() == $item['route']) ? 'actived' : '' }} nav-link" href="{{ route($item['route']) }}" title="{{ $item['name'] }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <span>{{ $item['name'] }}</span>
                  </a>
                </li>
              @endcan
            @endif
            @if(isset($item['submodules']))
              @can($item['permission'])
                <li class="dropdown {{ (strpos(Route::currentRouteName(), $item['path']) == 0) ? '' : 'active' }}">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="{{ $item['icon'] }}"></i>
                    <span>{{ $item['name'] }}</span>
                  </a>
                  <ul class="dropdown-menu">
                    @foreach($item['submodules'] as $submodule)
                      @can($submodule['permission'])
                        <li>
                          <a class="{{ (Route::currentRouteName() == $submodule['route']) ? 'actived' : '' }} nav-link" href="{{ route($submodule['route']) }}" title="{{ $submodule['name'] }}">
                            {{ $submodule['name'] }}
                          </a>
                        </li>
                      @endcan
                    @endforeach
                  </ul>
                </li>
              @endcan
            @endif
          @endforeach
        @endforeach
      @endforeach
    </ul>
  </aside>
</div>
