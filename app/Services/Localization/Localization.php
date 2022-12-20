<?php


namespace App\Services\Localization;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Localization
{
    public function locale() {
        $locale = request()->segment(1);
        if($locale && in_array($locale, config('app.additional_locales'))) {

            App::setLocale($locale);
            return $locale;
        }

        return '';
    }

    public function localizedUrl($locale){
        $currentLocale = App::getLocale();
        $currentUrl = Request::url();

        if(!$locale || $currentLocale == $locale){
            return $currentUrl;
        }

        if(in_array($locale, config('app.additional_locales')) || $locale == config('app.default_locale') ){
            $domen = Request::server('SERVER_NAME');
            $localeStr = $locale == config('app.default_locale') ? "" : "/$locale";
            if(in_array($currentLocale, config('app.additional_locales'))){
                return Str::replace("$domen/$currentLocale", $domen.$localeStr, $currentUrl);
            }elseif ($currentLocale == config('app.default_locale')){
                return Str::replace("$domen", $domen.$localeStr, $currentUrl);
            }
        }
        return $currentUrl;

    }


}
