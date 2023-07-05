@extends('laraflex::layouts.admin')

@section('content')
@auth

<!-- Mostrar mensajes de error -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Mostrar mensaje de estado -->
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<!-- Mostrar mensaje de error -->
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<h2> Theme Converter </h2>
<!-- Formulario de subida -->
<form action="{{ route('theme.process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="zipFile">
    <input type="text" name="oldValueLower" placeholder="Valor antiguo en minúsculas">
    <input type="text" name="oldValueUpper" placeholder="Valor antiguo en mayúsculas">
    <input type="text" name="newValueLower" placeholder="Nuevo valor en minúsculas">
    <input type="text" name="newValueUpper" placeholder="Nuevo valor en mayúsculas">
    <button type="submit">Subir y procesar</button>
</form>


@if (isset($processedZipPath))
        <a href="{{ url($processedZipPath) }}" download>Descargar archivo procesado</a>
    @endif

@endauth
@endsection
