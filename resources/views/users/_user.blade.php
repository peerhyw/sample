@if(!Auth::check() || Auth::user()->id !== $user->id)
<li>
    <div class="nameblock">
        <div class="imgblock">
            <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
        </div>
        <div class="nametext">
            <a href="{{ route('users.show',$user->id) }}" class="username">{{ $user->name }}</a>
        </div>
    </div>
    <div class="buttonblock">
        <!-- 授权判断 -->
        @can('destroy',$user)
            <form action="{{ route('users.destroy',$user->id) }}" method="post">
                {{ csrf_field() }}

                <!-- <input type="hidden" name="_method" value="DELETE"> -->
                {{ method_field('DELETE') }}
                <button class="btn btn-sm btn-danger delete-btn">delete</button>
            </form>
        @endcan
    </div>
</li>
@endif