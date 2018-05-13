@extends('layouts.app')

@section('content')
    <img src="imgs/hotel.jpg" class="img-fluid" alt="Responsive image">
    <div class="fondo-footer">
        <br>
        {!! Form::open([ 'route' => 'hoteles.index', 'method' => 'GET' ]) !!}
        <div class="container d-flex justify-content-center">
            {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre o la ciudad del hotel para realizar la busqueda']) !!}
            {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
        </div>
        <br>
        <div class="container">
            {{ Form::radio('radio', true,'rnombre', ['class'=>'radio-inline']) }}<a>Buscar por nombre </a><br>
            {{ Form::radio('radio', false,'rciudads'), ['class'=>'radio-inline'] }}<a> Buscar por ciudad</a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
    <div class="buscar">
        <div class="container d-flex justify-content-center">
            <a class="text-center"><strong>¿Quieres crear un hotel?</strong></a>
            <button type="button" class="btn btn-pink1" onclick="window.location='{{ url("hoteles/create") }}'">
                Agregalo
            </button>
        </div>
    </div>
    @if(count($hoteles) > 0)
        <div class="fondo-items">
            <div class="container">
                @if ($hoteles -> total() === 1)
                    <p class="font-primary" style="margin-left: 2%">{{ $hoteles -> total() }} hotel encontrado.</p>
                @else
                    <p class="font-primary" style="margin-left: 2%">{{ $hoteles -> total() }} hoteles encontrados.</p>
                @endif
                @foreach($hoteles as $hotel)
                    <div class="item-box">
                        <div class="row">
                            <div class="col-md-8">
                                <h1>{{ $hotel -> nombre }}</h1>
                                <p class="font-primary">Dirección: {{ $hotel -> direccion }}<a>
                                        / {{ $hotel -> ciudad }}</a></p>
                                <p class="font-primary"><a id="fondo-azul1"><strong>{{ $hotel -> calificacion }} /
                                            5</strong></a> {{ $hotel -> estrellas }}</p>

                            </div>
                            <div class="col-md-4 verticalLine justify-content-center">
                                <br>
                                <p class="text-center"><strong>Precio por habitación</strong></p>
                                <p class="text-center font-costo">${{ number_format($hotel -> costo, 2, ',', '.') }}</p>

                                <p class="text-center">
                                    <button type="button" class="btn btn-green" onclick="window.location='{{ route('hoteles.show', $hotel-> id)}}'">Ver más ></button>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $hoteles -> appends(request()->input())->links() }}
            </div>
            <br>
        </div>
    @else
        <div class="container">
            <br>
            <p class="font-primary">No se encontraron resultados, pruebe nuevamente.</p>
        </div>
    @endif
@endsection
