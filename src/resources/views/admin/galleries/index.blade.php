@extends('laraflex::layouts.admin')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="far fa-images"></i> Galleries</h1>
    <ol class="breadcrumb mb-4"></ol>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('galleries.create') }}" class="btn btn-primary mb-3">Create New Gallery</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Shortcode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($galleries as $gallery)
                <tr>
                    <td>{{ $gallery->name }}</td>
                    <td>{{ $gallery->description }}</td>
                    <td>
                        <div class="input-group">
                        <input type="text" class="form-control shortcode-field" value="[gallery id=&quot;{{ htmlspecialchars($gallery->id, ENT_QUOTES) }}&quot;]" readonly style="width: 10px;">

<button class="btn btn-outline-secondary copy-button" type="button" onclick="copyToClipboard(this)">Copy</button>


                        </div>
                    </td>
                    <td>
                        <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this gallery?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function copyToClipboard(button) {
        var input = button.parentNode.querySelector('.shortcode-field');
        input.select();
        document.execCommand("copy");
        button.innerHTML = "Copied!";
        setTimeout(function() {
            button.innerHTML = "Copy";
        }, 1000);
    }
</script>

@endsection

