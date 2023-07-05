@if(isset($item->children))
    <li class="dropdown-submenu">
        <a class="dropdown-item dropdown-toggle" href="{{ $item->slug }}">{{ $item->title }}</a>
        <ul class="dropdown-menu">
            @foreach($item->children as $child)
                 @include('limpa::menu_item', ['item' => $child])
            @endforeach
        </ul>
    </li>
@else
    <li><a class="dropdown-item" href="{{ $item->slug }}">{{ $item->title }}</a></li>
@endif
