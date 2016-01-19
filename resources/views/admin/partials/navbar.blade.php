<ul class="nav navbar-nav">
  @if (Auth::check())
    <li @if (Request::is('admin/move') || Request::is('admin/move/*')) class="active" @endif>
      <a href="/admin/move">Moves</a>
    </li>
    <li @if (Request::is('admin/truck*')) class="active" @endif>
      <a href="/admin/truck">Trucks</a>
    </li>
    <li @if (Request::is('admin/mover*')) class="active" @endif>
      <a href="/admin/mover">Movers</a>
    </li>
    <li @if (Request::is('admin/crew*')) class="active" @endif>
      <a href="/admin/crew"></a>
    </li>
  @endif
</ul>

<ul class="nav navbar-nav navbar-right">
  @if (Auth::guest())
    <li><a href="/login">Login</a></li>
  @else
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
         aria-expanded="false">{{ Auth::user()->name }}
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="/logout">Logout</a></li>
      </ul>
    </li>
  @endif
</ul>