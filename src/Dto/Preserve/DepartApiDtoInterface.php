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

use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\NameInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\TypeInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\AddressInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\FinalInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\GroupInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PointInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\WarehouseInterface;

interface DepartApiDtoInterface extends IdInterface, NameInterface, AddressInterface, FinalInterface, PackingListInterface, PointInterface, TypeInterface, GroupInterface, WarehouseInterface
{
}
