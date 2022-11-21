<?php
namespace App\Data;

use Spatie\LaravelData\Data;

class PaginationMetaData extends Data
{
    public function __construct(public ?string $next, public ?string $previous, public int $total, public int $pages, public int $page)
    {
    }
}
