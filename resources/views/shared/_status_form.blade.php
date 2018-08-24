<form action="{{ route('statuses.store') }}" method="post">
    @include('shared._errors')
    {{ csrf_field() }}
    <textarea name="content" class="form-control" placeholder="post something new and funny">{{ old('content') }}</textarea>
    <button class="btn btn-primary pull-right" type="submit">submit</button>
</form>