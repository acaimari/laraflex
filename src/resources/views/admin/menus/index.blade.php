@extends('laraflex::layouts.admin')
@auth
@section('content')

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestedSortable/2.0.0/jquery.mjs.nestedSortable.min.js" integrity="sha512-uAt5HkX8rwCV19v9HIeAocLUfQvQDfX0zuaMQr5HhGZc6GwhJoe9hzJYBxzsWTaDSMl4FazGovJwUbOA8rGuog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



  <!-- Start container select menu and menu creation -->

  <div class="container-fluid px-4">
  <h1 class="mt-4"><i class="fas fa-bars"></i> Menus</h1>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    </script>
@endif


<script>
  function validarGuardarMenu() {
    var tituloMenu = document.getElementById('titulo-menu').value;
    if (tituloMenu.trim() === '') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Please enter a name for the menu before saving.',
        showConfirmButton: true
      });
      return false; 
    }
    return true; 
  }
</script>



<!-- Start container select menu and menu creation -->
  <div class="content info-box">
  @if(count($menus) > 0)
    Select a menu to edit:
    <form action="{{ route('panel.menus') }}" class="form-inline">
      <select name="id">
        @foreach($menus as $menu)
          @if($desiredMenu != '')
            <option value="{{$menu->id}}" @if($menu->id == $desiredMenu->id) selected @endif>{{$menu->title}}</option>
          @else
            <option value="{{$menu->id}}">{{$menu->title}}</option>
          @endif
        @endforeach
      </select>
      <button class="btn btn-sm btn-default btn-menu-select">Select</button>
    </form>
  @endif

  @if($menuId == 'new' && count($menus) > 0) <!-- Agregar condición para mostrar el formulario solo si existen menús -->
  
  <div class="margin"></div>
  <h4>Create New Menu</h4>
    <form method="post" action="{{ route('create.menu') }}" onsubmit="return validarGuardarMenu()">
  {{csrf_field()}}
  <div class="row">
    <div class="col-sm-12">
      <label>Name</label>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <input type="text" name="title" class="form-control" id="titulo-menu">
      </div>
    </div>
    <div class="col-sm-6 text-left">
      <button type="submit" class="btn btn-sm btn-primary">Create Menu</button>
      <a href="{{ route('panel.menus') }}" class="btn btn-sm btn-secondary">Cancel</a>
    </div>
  </div>
</form>


  @else
    @if(count($menus) > 0) <!-- Agregar condición para mostrar el enlace solo si existen menús -->
    <a href="{{ route('panel.menus') }}?id=new">Create a new menu</a>


    @endif
  @endif
</div>
</div>
<!-- End container select menu and menu creation -->



<!----------------------------- NEW ---------------------------------------->

  <!-- Start principal container -->

  <div class="container-fluid">
  <div class="row" id="main-row">
    <div class="col-12 col-md-3 cat-form @if(count($menus) == 0) disabled @endif">

      <h4><span>Add Menu Items</span></h4>
      <div class="margin"></div>
      <div class="table-responsive">
      <div class="panel-group" id="menu-items">


<div class="accordion" id="pages-list">
    <div class="accordion-item">
        <h2 class="accordion-header" id="pages-list-heading">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pages-list-collapse" aria-expanded="true" aria-controls="pages-list-collapse">
                Pages
            </button>
        </h2>
        <div id="pages-list-collapse" class="accordion-collapse collapse" aria-labelledby="pages-list-heading">
            <div class="accordion-body">
                <div class="item-list-body">
                    @foreach($pages as $page)
                        <p><input type="checkbox" name="select-page[]" value="{{$page->id}}"> {{$page->title}}</p>
                    @endforeach
                </div>
                <div class="item-list-footer">
                    <label class="btn btn-sm btn-secondary">
                        <input type="checkbox" id="select-all-pages"> Select All
                    </label>
                    <button type="button" id="add-pages" class="btn btn-sm btn-primary float-end">Add to Menu</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#select-all-pages').click(function(event) {   
        if(this.checked) {
            $('#pages-list :checkbox').each(function() {
                this.checked = true;                        
            });
        }else{
            $('#pages-list :checkbox').each(function() {
                this.checked = false;                        
            });
        }
    });
</script>



           
<div class="accordion" id="posts-list">
  <div class="accordion-item">
    <h2 class="accordion-header" id="posts-list-heading">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#posts-list-collapse" aria-expanded="true" aria-controls="posts-list-collapse">
        Posts
      </button>
    </h2>
    <div id="posts-list-collapse" class="accordion-collapse collapse" aria-labelledby="posts-list-heading">
      <div class="accordion-body">
        <div class="item-list-body">
          @foreach($posts as $post)
            <p><input type="checkbox" name="select-post[]" value="{{$post->id}}"> {{$post->title}}</p>
          @endforeach
        </div>
        <div class="item-list-footer">
          <label class="btn btn-sm btn-secondary">
            <input type="checkbox" id="select-all-posts"> Select All
          </label>
          <button type="button" id="add-posts" class="btn btn-sm btn-primary float-end">Add to Menu</button>
        </div>
      </div>
    </div>
  </div>
</div>



                    <script>
                    $('#select-all-posts').click(function(event) {   
                        if(this.checked) {
                        $('#posts-list :checkbox').each(function() {
                            this.checked = true;                        
                        });
                        }else{
                        $('#posts-list :checkbox').each(function() {
                            this.checked = false;                        
                        });
                        }
                    });
                    </script>
                    </div>

                
                <div class="panel panel-default">
                <div class="panel-heading">

                <!-- Categories-->
                <div class="accordion" id="categories-list">
  <div class="accordion-item">
    <h2 class="accordion-header" id="categories-list-heading">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#categories-list-collapse" aria-expanded="true" aria-controls="categories-list-collapse">
        Categories
      </button>
    </h2>
    <div id="categories-list-collapse" class="accordion-collapse collapse" aria-labelledby="categories-list-heading">
      <div class="accordion-body">
        <div class="item-list-body">
          @foreach($categories as $cat)
            <p><input type="checkbox" name="select-category[]" value="{{$cat->id}}"> {{$cat->title}}</p>
          @endforeach
        </div>
        <div class="item-list-footer">
          <label class="btn btn-sm btn-secondary">
            <input type="checkbox" id="select-all-categories"> Select All
          </label>
          <button type="button" id="add-categories" class="btn btn-sm btn-primary float-end">Add to Menu</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#select-all-categories').click(function(event) {
    if (this.checked) {
      $('#categories-list :checkbox').each(function() {
        this.checked = true;
      });
    } else {
      $('#categories-list :checkbox').each(function() {
        this.checked = false;
      });
    }
  });
</script>


                    </div>


                    <!-- Create Custom Links  -->
                    <div class="accordion" id="custom-links">
  <div class="accordion-item">
    <h2 class="accordion-header" id="custom-links-heading">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#custom-links-collapse" aria-expanded="false" aria-controls="custom-links-collapse">
        Custom Links
      </button>
    </h2>
    <div id="custom-links-collapse" class="accordion-collapse collapse" aria-labelledby="custom-links-heading">
      <div class="accordion-body">
        <div class="form-group">
          <label for="url">URL</label>
          <input type="url" id="url" class="form-control" placeholder="https://">
        </div>
        <div class="form-group">
          <label for="linktext">Link Text</label>
          <input type="text" id="linktext" class="form-control" placeholder="">
        </div>
        <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-sm btn-primary" id="add-custom-link">Add to Menu</button>
        </div>
      </div>
    </div>
  </div>
</div>


         <!-- End Custom Links  -->
                </div>	
                
      </div>
    </div>

    
    <div class="col-12 col-md-9">
      <div class="cat-view">
        <h4><span>Menu Structure</span></h4>
        <div class="table-responsive">
          <!-- NEW Estructura del menú -->
        

          @if($desiredMenu == '')
  <div class="overflow-hidden"> <!-- Agregar la clase "overflow-hidden" al contenedor padre -->
    <h4>Create New Menu</h4>
    <form method="post" action="{{ route('create.menu') }}" onsubmit="return validarGuardarMenu()">
      {{csrf_field()}}
      <div class="row">
        <div class="col-sm-12">
          <label>Name</label>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="titulo-menu"> <!-- Agregar el ID "titulo-menu" al campo de entrada -->
          </div>
        </div>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-sm btn-primary">Create Menu</button>
        </div>
      </div>
    </form>
  </div>
@else


                                  
<?php
$currentUrl = url()->current();

function renderMenuItem($item)
{
    echo '<li class="ui-state-default" data-id="' . $item['id'] . '">';
    echo '<span class="menu-item-bar">';
    echo '<i class="fas fa-arrows-alt"></i>';
    echo '&nbsp;';
    echo empty($item['name']) ? $item['title'] : $item['name'];
    echo '&nbsp;';
    echo '<a href="#collapse' . $item['id'] . '" class="pull-right" data-bs-toggle="collapse" style="margin-right: 25px;">';
    echo '<i class="fas fa-caret-down"></i>';
    echo '</a>';
    echo '</span>';
    echo '<div class="collapse" id="collapse' . $item['id'] . '">';
    echo '<div class="input-box">';
    echo '<form method="post" action="' . route('update.menuitem', ['id' => $item['id']]) . '">';
    echo csrf_field();
    echo '<div class="form-group">';
    echo '<label>Label Name</label><p></p>';
    echo '<input type="text" name="name" value="' . (empty($item['name']) ? $item['title'] : $item['name']) . '" class="form-control">';
    echo '</div>';
    echo '<p>';
    if ($item['type'] == 'custom') {
        echo '<div class="form-group">';
        echo '<label>URL</label><p></p>';
        echo '<input type="text" name="slug" value="' . $item['slug'] . '" class="form-control">';
        echo '</div>';
        echo '<div class="form-group"><p></p>';
        echo '<input type="checkbox" name="target" value="_blank"' . ($item['target'] == '_blank' ? ' checked' : '') . '> Open in a new tab<p></p>';
        echo '</div>';
    }
    echo '<div class="form-group">';
    echo '<button class="btn btn-sm btn-primary">Save</button>';
    echo '&nbsp;';
    echo '<a href="' . route('delete.menuitem', ['id' => $item['id']]) . '" class="btn btn-sm btn-danger">Delete</a>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    if (isset($item['children']) && count($item['children']) > 0) {
        echo '<ul>';
        foreach ($item['children'] as $child) {
            renderMenuItem($child);  // llamada recursiva
        }
        echo '</ul>';
    }
    echo '</li>';
}

function printMenuItems($menuItems)
{
    foreach ($menuItems as $item) {
        renderMenuItem($item);
    }
}
?>



              <div id="result"></div>
                  <div style="min-height: 240px;">
                      <p>Select pages, posts, categories or add custom links to menus.</p>
                      <!-- Mostrar estructura del menú -->
                      <?php if($desiredMenu != ''): ?>
                          <ul class="menu ui-sortable" id="sortable">
                              <?php if(!empty($menuItems)): ?>
                                  <?php printMenuItems($menuItems); ?>
                              <?php endif; ?>
                          </ul>
                      <?php endif; ?>
                  </div>

                  <!--- End menu structure -->
        </div>

              <script>
                  $( function() {
                $( "#sortable" ).nestedSortable({
                  items: 'li',
                  listType: 'ul',
                });
              } );
              </script>





          


        </div>
        @if($desiredMenu != '')
          <div class="col-12">
            <!-- NEW Opciones de ubicación del menú -->
       

@php
$activeTheme = \Caimari\LaraFlex\Models\Theme::where('active', 1)->first();
$menuLocations = $activeTheme ? json_decode($activeTheme->menu_locations, true) : [];
@endphp

<!-- Dymanic Menu Location Options -->
<div class="form-group menulocation">
    <label><b>Menu Location</b></label>
    @if(is_array($menuLocations) && count($menuLocations) > 0)
        @foreach ($menuLocations as $location => $label)
            <p><label><input type="radio" name="location" value="{{ $location }}" @if($desiredMenu->location == $location) checked @endif> {{ $label }}</label></p>
        @endforeach
    @else
        <p>The selected theme does not have available positions for menu placement, or you do not have any active theme.</p>
    @endif
</div>

<!-- Save and Delete buttons -->
<div class="text-left">
  <button class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
  <a href="{{ route('delete.menu', ['id' => $desiredMenu->id]) }}" class="btn btn-sm btn-danger ml-2">Delete Menu</a>
</div>

						
</div>
@endif	




          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!------------------------------------------- END NEW --------------------------------------->

<!-- Scripts -->

<script>
$(document).ready(function() {
    var jsonString = '';

    var group = $("#sortable").sortable({
        group: 'serialization',
        onDrop: function ($item, container, _super) {
            console.log('onDrop triggered');
            var data = group.sortable("serialize").get();
            jsonString = JSON.stringify(data, null, ' ');
            $('#serialize_output').text(jsonString);
            console.log('serialize_output content:', $('#serialize_output').text());
            _super($item, container);
        }
    });
});
</script>

<script>
$('#saveMenu').click(function() {
    @if($desiredMenu)
        var menuid = {{$desiredMenu->id}};
        var location = $('input[name="location"]:checked').val();

        // Recorrer la lista y agregar los campos adicionales a un array
        var items = [];

        $('#sortable li').each(function() {
            var title = $(this).data('title');
            var id = $(this).data('id');
            var parentId = $(this).parent().closest('li').data('id');
            var sort = $(this).index();
            var depth = $(this).parents('li').length;

            var item = {
                title: title,
                id: id,
                parentId: parentId,
                sort: sort,
                depth: depth
            };

            items.push(item);
        });

        // Combina todas las variables en un solo objeto
        var requestData = {
            menuid: menuid,
            location: location,
            items: items
        };

        // Imprimir los datos que se van a enviar al servidor
        console.log("Datos a enviar: ", requestData);

        // Imprimir los campos adicionales en la consola
        items.forEach(function(item) {
            console.log("Title:", item.title);
         //   console.log("ID:", item.id);
         //   console.log("Parent ID:", item.parentId);
         //   console.log("Sort:", item.sort);
        //  console.log("Depth:", item.depth);
        });

        $.ajax({
            type: "get",
            data: requestData,
            url: "{{ route('update.menu') }}",
            success: function(res) {
                window.location.reload();
            }
        });
    @endif
});

</script>

@if($desiredMenu)
<script>
$('#add-categories').click(function(){
  var menuid = <?=$desiredMenu->id?>;
  var n = $('input[name="select-category[]"]:checked').length;
  var array = $('input[name="select-category[]"]:checked');
  var ids = [];
  for(i=0;i<n;i++){
    ids[i] =  array.eq(i).val();
  }
  if(ids.length == 0){
	return false;
  }
  $.ajax({
	type:"get",
	data: {menuid:menuid,ids:ids},
	url: "{{ route('add.categories.menu') }}",			
	success:function(res){				
      location.reload();
	}
  })
})

$('#add-posts').click(function(){
  var menuid = <?=$desiredMenu->id?>;
  var n = $('input[name="select-post[]"]:checked').length;
  var array = $('input[name="select-post[]"]:checked');
  var ids = [];
  for(i=0;i<n;i++){
	ids[i] =  array.eq(i).val();
  }
  if(ids.length == 0){
	return false;
  }
  $.ajax({
	type:"get",
	data: {menuid:menuid,ids:ids},
	url: "{{ route('add.post.menu') }}",			
	success:function(res){
  	  location.reload();
	}
  })
})

$('#add-pages').click(function(){
        var menuid = <?=$desiredMenu->id?>;
        var n = $('input[name="select-page[]"]:checked').length;
        var array = $('input[name="select-page[]"]:checked');
        var ids = [];
        for(i=0;i<n;i++){
            ids[i] = array.eq(i).val();
        }
        if(ids.length == 0){
            return false;
        }
        $.ajax({
            type:"get",
            data: {menuid:menuid, ids:ids},
            url: "{{ route('add.page.menu') }}",
            success:function(res){
                location.reload();
            }
        })
    })


$("#add-custom-link").click(function(){
  var menuid = <?=$desiredMenu->id?>;
  var url = $('#url').val();
  var link = $('#linktext').val();
  if(url.length > 0 && link.length > 0){
	$.ajax({
	  type:"get",
	  data: {menuid:menuid,url:url,link:link},
	  url: "{{ route('add.custom.link.menu') }}",		
	  success:function(res){
	    location.reload();
	  }
	})
  }
})
</script>
@endif	


<style>   
  .item-list,.info-box{background: #fff;padding: 10px;}
  .item-list-body{max-height: 300px;overflow-y: scroll;}
  .panel-body p{margin-bottom: 5px;}
  .info-box{margin-bottom: 15px;}
  .item-list-footer{padding-top: 10px;}
  .panel-heading a{display: block;}
  .form-inline{display: inline;}
  .form-inline select{padding: 4px 10px;}
  .btn-menu-select{padding: 4px 10px}
  .disabled{pointer-events: none; opacity: 0.7;}
  .menu-item-bar{background: #eee;padding: 5px 10px;border:1px solid #d7d7d7;margin-bottom: 5px; width: 75%; cursor: move;display: block;}
  #serialize_output{display: block;}
  .menulocation label{font-weight: normal;display: block;}
  body.dragging, body.dragging * {cursor: move !important;}
  .dragged {position: absolute;z-index: 1;}
  ol.example li.placeholder {position: relative;}
  ol.example li.placeholder:before {position: absolute;}
  #menuitem{list-style: none;}
  #menuitem ul{list-style: none;}
  .input-box{width:75%;background:#fff;padding: 10px;box-sizing: border-box;margin-bottom: 5px;}
  .input-box .form-control{width: 50%} */
</style>	

<!-- <pre>{{ var_dump($desiredMenu) }}</pre> -->

@endsection
@endauth