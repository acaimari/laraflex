@extends('laraflex::layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <ol class="breadcrumb mb-4">
    </ol>
                        
    <div class="row">
  <div class="col-xl-4 col-md-6">
    <div class="card bg-primary text-white mb-4">
      <div class="card-body">
        Pages
        <div class="mt-3">
          <span class="badge bg-light text-dark">Number of pages: {{ $numberOfPages }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6">
    <div class="card bg-secondary text-white mb-4">
      <div class="card-body">
        Posts
        <div class="mt-3">
          <span class="badge bg-light text-dark">Number of posts: {{ $numberOfPosts }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6">
    <div class="card bg-success text-white mb-4">
      <div class="card-body">
        Users
        <div class="mt-3">
          <span class="badge bg-light text-dark">Number of users: {{ $numberOfUsers }}</span>
        </div>
      </div>
    </div>
  </div>
</div>


@if (session('defaultCredentials'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('defaultCredentials') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if ($hasRootRoute)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    To ensure LaraFlex themes work correctly, please comment out the root route line in the routes/web.php file, which typically corresponds to the root path ("/").
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="accordion" id="systemRoutesAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="systemRoutesHeading">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#systemRoutesCollapse" aria-expanded="false" aria-controls="systemRoutesCollapse">
                System Routes
            </button>
        </h2>
        <div id="systemRoutesCollapse" class="accordion-collapse collapse" aria-labelledby="systemRoutesHeading" data-bs-parent="#systemRoutesAccordion">
            <div class="accordion-body">
                <ul class="list-group">
                    @foreach ($systemRoutes as $route)
                        <li class="list-group-item">
                            <span class="me-3">{{ $route['uri'] }}</span>
                            <small class="text-muted">{{ $route['action'] }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>





@endsection
