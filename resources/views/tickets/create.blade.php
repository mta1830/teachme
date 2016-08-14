@extends('layout')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="row">
                  <h1>
                      Nueva Solicitud
                  </h1>
              </div>

              @include('partials.errors')

              {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
              <div class="form-group">
                {!! Form::label('title', 'Título') !!}
                {!!
                  Form::textarea('title', null, [
                    'rows' =>  2,
                    'class' => 'form-control',
                    'placeholder' => 'Describe brevemente de qué quieres que trate el tutorial'
                  ])
                !!}

              </div>
              <button type="submit" class="btn btn-primary">Enviar solicitud</button>
              {!! Form::close() !!}

              <hr>

              <p><a href="http://duilio.me" target="_blank">duilio.me</a></p>

          </div>
      </div>
  </div>

@endsection
