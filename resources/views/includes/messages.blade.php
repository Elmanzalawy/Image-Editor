@if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif

@if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif

@if(session('errors'))
    @if(is_array(session('errors')))
        @foreach(session('errors') as $error)
            <div class="alert alert-danger">
                {{-- sometimes single error messages are returned as array because of request validation, the following if statement handles the issue. --}}
                @if(is_array($error))
                {{$error[0]}}
                @else
                {{$error}}
                @endif
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach

        @else
        <div class="alert alert-danger">
            {{session('errors')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endif
