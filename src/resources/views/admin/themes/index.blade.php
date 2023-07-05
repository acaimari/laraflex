@extends('laraflex::layouts.admin')

@section('content')
@auth

<div class="container-fluid px-4">
    <h1 class="mt-4">Themes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Themes</li>
    </ol>

    <div class="container">
  
                    <script>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ $error }}',
                                });
                            @endforeach
                        @endif
                    </script>


<form action="{{ route('panel.themes.install') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="theme">
                <button type="submit" class="btn btn-primary">Upload & Install</button>
            </form>

            <p></p>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($themes as $theme)
                        <tr>
                        <td> <input type="checkbox" class="theme-checkbox" name="theme_ids[]" value="{{ $theme->id }}"></td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#themeModal{{ $theme->id }}">
                                    {{ $theme->name }}
                                </a>
                            </td>

                            <td>{{ $theme->active ? 'Yes' : 'No' }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $theme->id }}">
                                    {{ $theme->active ? 'Deactivate' : 'Activate' }}
                                </button>

                                <!-- Activation/Deactivation Confirmation Modal -->
                                <div class="modal fade" id="confirmModal{{ $theme->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to {{ $theme->active ? 'deactivate' : 'activate' }} this theme?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('panel.themes.toggle', ['id' => $theme->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary">Yes, I'm sure</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                             <!-- Botón de eliminación -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $theme->id }}">
        Delete Theme
    </button><!-- Confirmación de eliminación Modal -->
<div class="modal fade" id="deleteModal{{ $theme->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        
            <form action="{{ route('panel.themes.destroy', ['id' => $theme->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <label for="adminPassword">Admin Password</label>
            <input type="password" id="adminPassword" name="adminPassword">
            <button type="submit" class="btn btn-primary">Yes, I'm sure</button>
            </form>

            </div>
 
        </div>
    </div>
</div>



                            </td>
                        </tr>

                        <!-- Theme Details Modal -->
                        <div class="modal fade" id="themeModal{{ $theme->id }}" tabindex="-1" aria-labelledby="themeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="themeModalLabel">{{ $theme->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Description:</strong> {{ $theme->description }}</p>
                                        <p><strong>Provider:</strong> {{ $theme->provider }}</p>
                                        <p><strong>Active:</strong> {{ $theme->active ? 'Yes' : 'No' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach
                    </tbody>
                </table>
            </div>

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




            <!-- Add a new form for the backup action -->
            <form action="{{ route('panel.themes.backup') }}" method="POST" id="backupForm">
    @csrf
    <input type="hidden" id="selectedThemes" name="selected_themes">
    <button type="submit" class="btn btn-secondary" id="backupButton" disabled>Backup selected themes</button>
</form>

        </div>

    </div>


    <script>
  document.getElementById('checkAll').addEventListener('change', function(e) {
    let checkboxes = document.querySelectorAll('.theme-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.checked = e.target.checked;
    });
    document.getElementById('selectedThemes').value = Array.from(checkboxes).filter(ch => ch.checked).map(ch => ch.value).join(',');
    document.getElementById('backupButton').disabled = checkboxes.length === 0;
  });

  let themeCheckboxes = document.querySelectorAll('.theme-checkbox');
  themeCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function(e) {
      document.getElementById('selectedThemes').value = Array.from(themeCheckboxes).filter(ch => ch.checked).map(ch => ch.value).join(',');
      document.getElementById('backupButton').disabled = Array.from(themeCheckboxes).filter(ch => ch.checked).length === 0;
    });
  });
</script>

@endauth
@endsection

