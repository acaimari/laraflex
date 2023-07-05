@extends('laraflex::layouts.admin')

@section('content')

@auth
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-columns"></i> General Settings</h1>
    <ol class="breadcrumb mb-4"></ol>

    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {!! session('error') !!}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-9">
            <!-- Contenido de la columna izquierda (ancho 9) -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">General Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.general-settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Site title</label>
                            <input type="text" class="form-control" id="site_title" name="site_title" value="{{ $settings->site_title }}">
                        </div>

                        <div class="mb-3">
                            <label for="site_email" class="form-label">Site email</label>
                            <input type="text" class="form-control" id="site_email" name="site_email" value="{{ $settings->site_email }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="site_description" rows="3">{{ $settings->site_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" value="{{ $settings->keywords }}">
                        </div>

                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $settings->twitter }}">
                        </div>

                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $settings->facebook }}">
                        </div>

                        <div class="mb-3">
                            <label for="pinterest" class="form-label">Pinterest</label>
                            <input type="text" class="form-control" id="pinterest" name="pinterest" value="{{ $settings->pinterest }}">
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $settings->instagram }}">
                        </div>

                        <div class="mb-3">
                            <label for="youtube" class="form-label">YouTube</label>
                            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $settings->youtube }}">
                        </div>

                        <div class="mb-3">
    <label for="github" class="form-label">GitHub</label>
    <input type="text" class="form-control" id="github" name="github" value="{{ $settings->github }}">
</div>

<!--
<div class="mb-3">
    <label for="number_posts_show" class="form-label">Number of Posts to Show</label>
    <input type="number" class="form-control" id="number_posts_show" name="number_posts_show" value="{{ $settings->number_posts_show }}">
</div>


<div class="mb-3">
    <label for="number_comments_show" class="form-label">Number of Comments to Show</label>
    <input type="number" class="form-control" id="number_comments_show" name="number_comments_show" value="{{ $settings->number_comments_show }}">
</div>

<div class="mb-3">
    <label for="registration_active" class="form-label">Registration Active</label>
    <select class="form-control" id="registration_active" name="registration_active">
        <option value="0" {{ $settings->registration_active == '0' ? 'selected' : '' }}>No</option>
        <option value="1" {{ $settings->registration_active == '1' ? 'selected' : '' }}>Yes</option>
    </select>
</div>

<div class="mb-3">
    <label for="account_verification" class="form-label">Account Verification</label>
    <select class="form-control" id="account_verification" name="account_verification">
        <option value="0" {{ $settings->account_verification == '0' ? 'selected' : '' }}>No</option>
        <option value="1" {{ $settings->account_verification == '1' ? 'selected' : '' }}>Yes</option>
    </select>
</div> -->


<button type="submit" class="btn btn-primary">Save</button>
</form>
</div>
</div>
</div>

<!-- Contenido de la columna derecha (ancho 3) -->
<div class="col-lg-3">
    <!-- Agrega aquí el contenido de la columna derecha -->
</div>
</div>

@endauth
@endsection
