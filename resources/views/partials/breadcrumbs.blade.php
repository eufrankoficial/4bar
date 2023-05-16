@if(count($breadcrumbs))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    @if(!$loop->last)
                        <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                    @else
                        {{ $breadcrumb->title }}
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
