@php
\Log::info('Rendering Blade file');
@endphp

@foreach($items as $item)
    @php
    $menuItem = \Caimari\LaraFlex\Models\SiteMenuItem::find($item['id']);
    \Log::info('MenuItem:', ['menuItem' => $menuItem]); // Aquí lo insertas
    @endphp
	<li data-id="{{ isset($item['id']) ? $item['id'] : '' }}" class="menu-item">
		<span class="menu-item-bar">
			<i class="fa fa-arrows"></i> 
			{{ isset($menuItem->title) ? $menuItem->title : (isset($menuItem->name) ? $menuItem->name : '') }} 
			<a href="#collapse{{ isset($item['id']) ? $item['id'] : '' }}" class="pull-right" data-toggle="collapse">
				<i class="caret"></i>
			</a>
		</span>
        ...
		@if(!empty($item['children']))
			<ul>
				@foreach($item['children'][0] as $child)
					@include('admin.menus.items', ['items' => $child])
				@endforeach
			</ul>
		@endif
	</li>
@endforeach
