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
<!--
<script type="text/javascript">
    function sub() {
        var url = document.getElementById("formid").action;
        $.ajax({
                cache: true,
                type: "POST",
                url:url,
                data:$('#formid').serialize(),// 你的formid
                async: false,
                error: function(request) {
                    alert("Connection error:"+request.error);
                },
                success: function(data) {
                    if(document.getElementById("formid").innerHtml === "unfollow"){
                        document.getElementById("formid").innerHtml = "follow";
                        url = "{{ route('followers.store',$user->id) }}";
                        document.getElementById("formid").action = url;
                    }
                    if(document.getElementById("formid").innerHtml === "follow"){
                        document.getElementById("formid").innerHtml = "unfollow";
                        url = "{{ route('followers.destroy',$user->id) }}";
                        document.getElementById("formid").action = url;
                    }
                }
            });
    }
</script> -->