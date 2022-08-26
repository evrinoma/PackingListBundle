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

use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DepartInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\UserInterface;

interface LogisticsApiDtoInterface extends DepartInterface, PackingListInterface, UserInterface
{
}
