<?php

if(!function_exists('current_user'))
{
    function current_user()
    {
        return auth()->user();
    }
}

if(!function_exists('branch'))
{
    function branch()
    {
        if(cache('current_branch_'.cache_key()))
            return cache('current_branch_'.cache_key());

        return [];
    }
}

if(!function_exists('cache_key'))
{
    function cache_key()
    {
        if(cache('key_'.auth()->user()->id))
            return cache('key_'.auth()->user()->id);

        return null;
    }
}

if(!function_exists('keg_volume'))
{
    function keg_volume($volume = null)
    {
        switch ($volume) {
            case 'Full':
                return asset('assets/core/images/barris/100.png');
            case 'Half':
                return asset('assets/core/images/barris/50.png');
            case 'Empty':
                return asset('assets/core/images/barris/0.png');
            default:
                return asset('assets/core/images/barris/100.png');
        }
    }
}


if(!function_exists('current_route'))
{
    function current_route($route = [])
    {

        return in_array(request()->route()->getName(), $route);
    }
}

if(!function_exists('get_current_route'))
{
    function get_current_route()
    {

        return request()->route()->getName();
    }
}

if(!function_exists('image_upload'))
{
    function image_upload($file, $dir, $request)
    {

        $imageName = time().'.'.$request->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads/' . $dir), $imageName);

        return [
            'image' => 'uploads/' . $dir . '/' . $imageName
        ];
    }
}

if(!function_exists('remove_file'))
{
    function remove_file($file)
    {
        return \File::delete($file);
    }
}

if(!function_exists('show_name'))
{
    function show_name()
    {
        if(current_user()->hasRole('SuperAdmin'))
            return config('app.name');

        if(current_user()->organization && !cache()->get('current_branch') && current_user()->hasRole('Admin'))
            return current_user()->organization->name;
        elseif(session()->get('current_branch'))
            return session()->get('current_branch')->name;
        elseif(current_user()->branchs->count())
            return current_user()->branchs->first()->name;

        return config('app.name');
    }
}


if(!function_exists('remove_file'))
{
    function remove_file($file)
    {
        return \File::delete($file);
    }
}

if(!function_exists('theme'))
{
    function theme()
    {
        if(current_user()->roles->count() && current_user()->roles->first()->theme) {
            return current_user()->roles->first()->theme;
        }

        return 'light_version';
    }
}

if(!function_exists('logo'))
{
    function logo()
    {
        $logo = 'logo_light.png';
        if(theme() != '') {
            $logo = 'logo_dark.png';
        }

        return asset('assets/core/images/'.$logo);
    }
}

if(!function_exists('keg_level'))
{
    function keg_level($capacity, $liters)
    {
        $calculation = keg_level_calculation($capacity, $liters);
        $image = $calculation['volume_available'];
        if($capacity == $liters && $capacity != 0 && $liters != 0) {
            $image = asset('assets/core/images/novo.png');
        } else {
            $image = asset('assets/core/images/barris/'. (int)$image . '.png');
        }

        return [
            'image' => $image,
            'mililiters' => number_format($liters, 2, ',', '.'),
            'percent' => number_format($calculation['percent'], 2, ',','.'),
            'capacity' => (int) $capacity
        ];
    }
}

if(!function_exists('keg_level_calculation'))
{
    function keg_level_calculation($capacity, $liters)
    {
        $percentAvailable = 0;
        $percentConsumed = 0;

        if($capacity > 0) { // volume consumido 100 - 99.99 = 1
            $percentConsumed  = $liters; // 99
            $percentConsumed = 1-($percentConsumed / $capacity); // aqui temos o volume disponivel em percent (0.99). Se multiplicar por 100 teremos 99% disponivel
            $percentConsumed = ($percentConsumed*100);
            $percentConsumed = number_format($percentConsumed, 1, '.', ','); // percent available
            $percentAvailable = 100-$percentConsumed;
        }

        return [
            'volume_available' => round($percentAvailable / 10) * 10,
            'percent' => $percentConsumed
        ];
    }
}

