<?php

namespace App\Enums;

enum LocalizationEnum: string
{
    case Ukrainian = 'uk';
    case English = 'en';





    public function text(): string {
        return match($this) {
            LocalizationEnum::Ukrainian => 'Українська',
            LocalizationEnum::English => 'English',


        };
    }





}
