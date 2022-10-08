<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductStatusEnum extends Enum
{
    const Active = 0;
    const Inactive = 1;
    const Waiting = 2;
}
