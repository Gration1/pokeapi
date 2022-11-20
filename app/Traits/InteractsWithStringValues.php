<?php

namespace App\Traits;

trait InteractsWithStringValues
{
    /**
     *
     * @return string[]
     */
    public static function toValues(): array
    {
        return array_map(fn(self $status) => $status->value, self::cases());
    }
}
