<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="col-md-pffset-1 col-md-10">
            <a href="/" id="logo">Sample Demo</a>
            <nav>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('users.index') }}">
                            <b>user list</b>
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <b>{{ Auth::user()->name }}</b><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('users.show' , Auth::user()->id) }}">user center</a></li>
                                <li><a href="{{ route('users.edit' , Auth::user()->id) }}">edit</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#" id="logout">
                                        <form action="{{ route('logout') }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-block btn-danger type="submit" name="button">log out</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"><b>log in</b></a>
                        </li>

                    @endif
                    <li>
                        <a href="{{ route('help')}}"><b>help</b></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>