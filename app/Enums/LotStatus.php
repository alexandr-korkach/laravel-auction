<?php

namespace App\Enums;

enum LotStatus: int
{
    case Created = 1;
    case InProgress = 5;
    case Success = 10;
    case Archive = 15;

    public const VALUES = [
        'Created' => 1,
        'InProgress' => 5,
        'Success' => 10,
        'Archive' => 15,
    ];

    public function textForHtml(): string {
        return match($this) {
            LotStatus::Created => 'primary',
            LotStatus::InProgress => 'success',
            LotStatus::Success => 'secondary',
            LotStatus::Archive => 'dark',

        };
    }

    public function text(): string {
        return match($this) {
            LotStatus::Created => __('statuses.created'),
            LotStatus::InProgress => __('statuses.in_progress'),
            LotStatus::Success => __('statuses.success'),
            LotStatus::Archive => __('statuses.archive'),

        };
    }





}
