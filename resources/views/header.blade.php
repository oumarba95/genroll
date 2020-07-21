<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="/"><img src="/images/logov2.png" style="width:70px;height:60px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    @auth
    <ul class="navbar-nav mr-auto">
       <li class="nav-item">
          <a href="{{ __('/home') }}" class="nav-link">Home</a>
       </li>
       <li class="nav-item">
          <a href="{{ __('/referes') }}" class="nav-link">Procèdure de rèfèrè</a>
       </li>
       <li class="nav-item">
          <a href="{{ __('/civiles') }}" class="nav-link">Procèdure civile</a>
       </li>
       <li class="nav-item">
          <a href="{{ __('/audience/') }}" class="nav-link">Audience du jour</a>
       </li>
    </ul>
    @endauth
    <ul class="navbar-nav ml-auto">
     @if(!auth()->user())
      <li class="nav-item active">
        <a class="nav-link" href="/login">se connecter<span class="sr-only">(current)</span></a>
      </li>
     @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </div>
        </li>
      @endif
    </ul>
  </div>
</nav>