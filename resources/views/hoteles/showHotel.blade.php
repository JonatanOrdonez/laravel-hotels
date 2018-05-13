@extends('layouts.app')

@section('content')
    <br>
    <div class="box-white">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="title">{{ $hotel -> nombre }}</p>
                    <p class="font-secondary">{{ $hotel -> ciudad }}</p>
                    <br>
                    <p class="font-secondary">{{ $hotel -> direccion }}</p>
                    <p class="font-secondary">{{ $hotel -> estrellas }}</p>
                </div>
                <div class="col-md-4">
                    <br>
                    <p class="text-right"><a id="font-costo2">${{ number_format($hotel -> costo, 2, ',', '.') }}</a></p>
                    <br>
                    <p class="font-primary text-right"><a id="fondo-azul1"><strong>{{ $hotel -> calificacion }} /
                                5</strong></a></p>
                </div>
            </div>
        </div>
        <br>
    </div>
    {!! Form::open(['route'=>'comentarios.store', 'method'=>'POST']) !!}
    <div class="fondo-items">
        <div class="container">
            <div class="item-box">
                <div class="row">
                    <div class="col-md-5">
                        <p class="font-tertiary text-center">{{ Auth::user()->name }}</p>
                        <p class="font-primary2 text-center">¿Conoces este hotel? Calificalo.</p>
                        {!!  Form::select('estrellas',['Una estrella' => 'Una estrella', 'Dos estrellas' => 'Dos estrellas', 'Tres estrellas' => 'Tres estrellas', 'Cuatro estrellas' => 'Cuatro estrellas', 'Cinco estrellas' => 'Cinco estrellas'],  'Una estrella', ['class' => 'form-control' ]) !!}
                    </div>
                    <div class="col-md-5">
                        {{ Form::textarea('mensaje', null,['class' => 'form-control', 'placeholder' => 'Ingrese un comentario sobre el hotel...', 'size' => '5x4']) }}
                    </div>
                    <div class="col-md-2 text-center">
                        {{ Form::hidden('hotel_inv', $hotel -> id) }}
                        {{ Form::hidden('usr_inv', Auth::user() -> id) }}
                        {!! Form::submit('Enviar', ['class'=>'btn btn-green2']) !!}
                    </div>
                </div>
                <br>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-dismissible  alert-danger fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <li>{{ $error }}</li>
                        </div>

                    @endforeach
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-dismissible  alert-success fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <li>{!! session()->get('success') !!}</li>
                    </div>
                @endif
            </div>
            {!! Form::close() !!}
            <div class="container">
                @if(count($hotel->comentarios) > 0)
                    @foreach($hotel->comentarios as $comentario)
                        <div class="item-box">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="font-tertiary">{{ $comentario -> user -> email }}</p>
                                    <p class="font-primary">{{ $comentario -> mensaje }}</p>
                                </div>
                                <div class="col-md-2 text-right">
                                    <p class="font-primary "><a id="fondo-azul2">{{ $comentario -> calificacion }}</a></p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <br>
    </div>
@endsection