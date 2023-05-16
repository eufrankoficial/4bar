@extends('layouts.default', ['pageTitle' => __('New maintenance'), 'breadcrumb' => 'maintenance.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <maintenance-form
                        types="{{ json_encode($types) }}"
                        coldchambers="{{ $coldChambers }}"
                        tapsprop="{{ $taps }}"
                        devicesprop="{{ $devices }}"
                        url="{{ route('maintenance.save.post') }}"
                    ></maintenance-form>
                </div>
            </div>
        </div>

    </div>
@endsection
