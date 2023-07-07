@extends('layouts.admin')

@section('content')

<div class="container">

@if(Route::has('crud.' . str_replace('_', '-', $modelName) . '.create'))
    <a href="{{ route('crud.' . str_replace('_', '-', $modelName) . '.create') }}" class="btn btn-success">Create</a>
@endif


    <table class="table">
        <thead>
            <tr>
                {{-- Column headers --}}
                <th>id</th>
<th>name</th>
<th>ext</th>
<th>size</th>
<th>user_id</th>
<th>url</th>
<th>created_at</th>
<th>updated_at</th>

                <th>Actions</th> {{-- Nueva columna de acciones --}}
            </tr>
        </thead>
        <tbody>
            {{-- Rows --}}
            @foreach ($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
<td>{{$item->name}}</td>
<td>{{$item->ext}}</td>
<td>{{$item->size}}</td>
<td>{{$item->user_id}}</td>
<td>{{$item->url}}</td>
<td>{{$item->created_at}}</td>
<td>{{$item->updated_at}}</td>

                    <td>
@php
    $canEdit = Route::has('crud.' . $modelName . '.edit');
    $canDelete = Route::has('crud.' . $modelName . '.destroy');
@endphp

@if($canEdit)
    <a href="{{ route('crud.' . $modelName . '.edit', $item->id) }}" class="btn btn-primary">Edit</a>
@endif




@php
    $routeExists = Route::has("crud.fmanager-files.destroy");
@endphp

@if($routeExists)
    <form action="{{ route("crud.fmanager-files.destroy", $item->id) }}" method="POST" style="display:inline;">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
