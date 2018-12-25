@foreach(['danger','warning','success','info'] as $msg)
    {{--这里的has，是判断是否为空--}}
    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif
@endforeach