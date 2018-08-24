<li id="status-{{ $status->id }}">
    <a href="{{ route('users.show',$user->id) }}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    </a>
    <span class="user">
        <a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a>
    </span>
    <span class="timestamp">
        {{ $status->created_at->diffForHumans() }}
    </span>
    <span class="content">
        {{ $status->content }}
    </span>
    <!-- 授权判断 -->
    @can('destroy',$status)
        <form action="{{ route('statuses.destroy',$status->id) }}" method="post">
            {{ csrf_field() }}

            <!-- <input type="hidden" name="_method" value="DELETE"> -->
            {{ method_field('DELETE') }}
            <button class="btn btn-sm btn-danger status-delete-btn" type="submit">delete</button>
        </form>
    @endcan
</li>