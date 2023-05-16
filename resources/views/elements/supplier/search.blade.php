<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ route('supplier.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', request()->get('name')) }}">
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('CPF/CNPJ') }}</label>
                        <input type="text" class="form-control cnpj_cpf" placeholder="{{ __('CPF/CNPJ') }}" name="cpf_cnpj" value="{{ old('cpf_cnpj', request()->get('cpf_cnpj')) }}">
                    </div>
                </div>

                @if(current_user()->hasRole('SuperAdmin'))
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>{{ __('Organization') }}</label>
                            <div class="multiselect_div">
                                <select name="organization[]" class="multiselect-custom multiselect" multiple="multiple">
                                    @foreach($orgs as $or)
                                        <option value="{{ $or->slug }}" @if(is_array(request()->get('organization')) && in_array($or->slug, request()->get('organization'))) selected @endif>{{ $or->name }}</option>
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
                    <a href="{{ route('supplier.index') }}" class="btn btn-warning">
                        <i class="fa fa-close"></i> {{ __('Clear search') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
