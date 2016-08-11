<ul class="nav navbar-nav">
  @foreach ($items as $route => $text)
    <li role="presentation" {!! Html::classes(['active' => Route::is($route)]) !!}>
    {{-- <li role="presentation" @if(Route::is($route)) class="active" @endif> --}}
      <a href="{{ route($route) }}">{{ $text }}</a>
    </li>
  @endforeach
  {{-- Excelente forma para incluir datos centralizados --}}
  {{-- <li role="presentation" @if(route::is('tickets.closed')) class="active" @endif>
      <a href="{{route('tickets.closed')}}">Finalizadas</a>
  </li> --}}
</ul>
