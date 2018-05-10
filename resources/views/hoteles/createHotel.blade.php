@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <a>Registrar hotel</a>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route'=>'hoteles.store', 'method'=>'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('Nombre del hotel') !!}
                            {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del hotel']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Costo del hotel') !!}
                            {!! Form::number('costo', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el costo del hotel']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Número de estrellas') !!}
                            {!!  Form::select('estrellas', ['Una estrella' => 'Una estrella', 'Dos estrellas' => 'Dos estrellas', 'Tres estrellas' => 'Tres estrellas', 'Cuatro estrellas' => 'Cuatro estrellas', 'Cinco estrellas' => 'Cinco estrellas'],  'Una estrella', ['class' => 'form-control' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Dirección') !!}
                            {!! Form::text('direccion', null, ['class'=>'form-control', 'placeholder'=>'Ingrese la dirección del hotel']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Ciudad') !!}
                            {!! Form::text('ciudad', null, ['class'=>'form-control', 'placeholder'=>'Ingrese la ciudad del hotel']) !!}
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
                        <button type="button" class="btn btn-pink1" onclick="window.location='{{ url("/home") }}'">Regresar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
