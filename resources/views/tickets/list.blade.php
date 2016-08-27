@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>
                    {{-- A través de currentRouteName va a retornarse la ruta de acceso a la página --}}
                    {!! trans(Route::currentRouteName().'_title') !!}
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                        Nueva solicitud
                    </a>
                </h1>

                <p class="label label-info news">
                    {{ Lang::choice(Route::currentRouteName().'_total', $tickets->total()) }}
                    {{--
                    Traer datos necesarios
                    Hay {{ $tickets->total() }} Solicitudes Populares --}}
                </p>

                @foreach($tickets as $ticket)
                  @include('tickets.partials.item',compact($ticket))
                @endforeach

                {!! $tickets->render() !!}
                {{-- <ul class="pagination"><li class="disabled"><span>&laquo;</span></li> <li class="active"><span>1</span></li><li><a href="http://teachme.static/populares/?page=2">2</a></li> <li><a href="http://teachme.static/populares/?page=2" rel="next">&raquo;</a></li></ul> --}}
            </div>

            <hr>

            <p><a href="http://duilio.me" target="_blank">duilio.me</a></p>

        </div>
    </div>
</div>

{!! Form::open(['id' => 'form-vote', 'route' => ['votes.submit', ':id'], 'method' => 'POST']) !!}
{!! Form::close() !!}

{!! Form::open(['id' => 'form-unvote', 'route' => ['votes.destroy', ':id'], 'method' => 'DELETE']) !!}
{!! Form::close() !!}
@endsection
