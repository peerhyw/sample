<div class="stats">
    <a href="{{ route('users.followings',$user->id) }}">
        <strong class="stat" id="following">
            {{ count($user->followings) }}
        </strong>
        followings
    </a>
    <a href="{{ route('users.followers',$user->id) }}">
        <strong class="stat" id="followers">
            {{ count($user->followers) }}
        </strong>
        followers
    </a>
    <a href="{{ route('users.show',$user->id) }}">
        <strong class="stat" id="statuses">
            {{ $user->statuses()->count() }}
        </strong>
        weibo
    </a>
</div>