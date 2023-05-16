<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ isset($org) ? route('orgs.branchs.index', $org) : route('branchs.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', request()->get('name')) }}">
                    </div>
                </div>

                @if(current_user()->hasRole('SuperAdmin'))
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>{{ __('Organization') }}</label>
                            <div class="multiselect_div">
                                <select name="org[]" class="multiselect-custom multiselect" multiple="multiple">
                                    @foreach($orgs as $or)
                                        <option value="{{ $or->slug }}" @if(is_array(request()->get('org')) && in_array($or->slug, request()->get('org'))) selected @endif>{{ $or->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12 col-sm-12 text-left">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i> {{ __('Search') }}
                    </button>
                    <a href="{{ isset($org) ? route('orgs.branchs.index', $org) : route('branchs.index') }}" class="btn btn-warning">
                        <i class="fa fa-close"></i> {{ __('Clear search') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
