@if($user->id !== Auth::user()->id)
    <div id="follow_form">
        @if(Auth::user()->isFollowing($user->id))
            <form action="{{ route('followers.destroy',$user->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="btn btn-sm" type="submit">unfollow</button>
            </form>
        @else
            <form action="{{ route('followers.store',$user->id) }}" method="post">
                {{ csrf_field() }}
                <button class="btn btn-sm btn-primary" type="submit">follow</button>
            </form>
        @endif
    </div>
@endif

<!-- <script>
    $(function(){
        $("button").click(function(){
            if($(".btn").html()=="unfollow")
        });
    });
</script> -->