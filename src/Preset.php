<?php

namespace Abdelmoujoudaza\LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function install(){
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateMix();
        static::updateStyles();
        static::updateScripts();
    }

    public static function cleanSassDirectory(){
        File::cleanDirectory(resource_path('sass'));
    }

    public static function updatePackageArray($packages){
        return array_merge(['laravel-mix-tailwind' => '^0.1.0'], Arr::except($packages, [
            'jquery',
            'lodash',
            'poper.js'
        ]));
    }

    public static function updateMix(){
        copy(__DIR__.'/stubs/js/webpack.mix.js', base_path('webpack.mix.js'));
    }

    public static function updateScripts(){
        copy(__DIR__.'/stubs/js/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/stubs/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    public static function updateStyles(){
        copy(__DIR__.'/stubs/sass/app.scss', resource_path('sass/app.scss'));
    }
}
