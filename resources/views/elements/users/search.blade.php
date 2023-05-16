<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ route('users.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', request()->get('name')) }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Email') }}" name="email" value="{{ old('email', request()->get('email')) }}">
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Groups') }}</label>
                        <div class="multiselect_div">
                            <select name="group[]" class="multiselect-custom multiselect" multiple="multiple">
                                @foreach($types as $type)
                                    <option value="{{ $type->slug }}" @if(is_array(request()->get('group')) && in_array($type->slug, request()->get('group'))) selected @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @if(current_user()->hasRole('SuperAdmin'))
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>{{ __('Organization') }}</label>
                            <div class="multiselect_div">
                                <select name="organization[]" class="multiselect-custom multiselect" multiple="multiple">
                                    @foreach($orgs as $org)
                                        <option value="{{ $org->slug }}" @if(is_array(request()->get('organization')) && in_array($org->slug, request()->get('organization'))) selected @endif>{{ $org->name }}</option>
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
                    <a href="{{ route('users.index') }}" class="btn btn-warning">
                        <i class="fa fa-close"></i> {{ __('Clear search') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
