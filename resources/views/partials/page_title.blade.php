<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h1>{{ isset($pageTitle) ? $pageTitle : (branch() ? branch()->name : '4barSolutions') }}</h1>

            @if($breadcrumb)
                @if(empty($param))
                    {!! Breadcrumbs::render($breadcrumb) !!}
                @elseif(is_array($param))
                    {!! Breadcrumbs::render($breadcrumb, $param[0], $param[1], $param[1]) !!}
                @else
                    {!! Breadcrumbs::render($breadcrumb, $param) !!}
                @endif

            @endif
        </div>

        @if(isset($componentButtonAdd))

            @include($componentButtonAdd)

        @elseif(isset($modal) && isset($functionPermission) && current_user()->{$functionPermission}($permissions))
            <div class="col-md-6 col-sm-12 text-right">
                @if(isset($addButton))
                    <a href="{{ $addButton }}" class="btn btn-sm btn-success open-modal" alt="{{ __('New') }}" title="{{ __('New') }}">
                        <i class="icon-plus"></i> {{ __('New') }}
                    </a>
                @endif
            </div>
        @elseif(isset($functionPermission) && current_user()->{$functionPermission}($permissions))
            <div class="col-md-6 col-sm-12 text-right">
                @if(isset($addButton))
                    <a href="{{ $addButton }}" class="btn btn-sm btn-success">
                        <i class="icon-plus"></i> {{ __('New') }}
                    </a>
                @endif
                @if(isset($addButton2) && $addButton2)
                    <a href="{{ $addButton2 }}" class="btn btn-sm btn-warning">
                       {{ $addButton2Text }}
                    </a>
                @endif
            </div>
        @endif

    </div>
</div>
