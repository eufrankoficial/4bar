<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ route('menu.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Menu') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Menu') }}" name="menu" value="{{ old('menu', request()->get('menu')) }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Fathers') }}</label>
                        <div class="multiselect_div">
                            <select name="parent_id" class="multiselect-custom multiselect">
                                <option value="">{{ __('Choose') }}</option>
                                @foreach($fathers as $father)
                                    <option value="{{ $father->id }}" @if(request()->get('parent_id') && $father->id == request()->get('parent_id')) selected @endif>{{ $father->menu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 text-left">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i> {{ __('Search') }}
                    </button>
                    <a href="{{ route('menu.index') }}" class="btn btn-warning">
                        <i class="fa fa-close"></i> {{ __('Clear search') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
