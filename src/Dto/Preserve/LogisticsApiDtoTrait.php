<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PackingListBundle\Dto\Preserve;

use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\DepartTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\PackingListTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\UserTrait;

trait LogisticsApiDtoTrait
{
    use DepartTrait;
    use PackingListTrait;
    use UserTrait;
}
