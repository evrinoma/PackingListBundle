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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\AddressInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\IdDepartInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\IsFinalInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListIdInterface;

interface DepartApiDtoInterface extends IdInterface, NameInterface, AddressInterface, IdDepartInterface, IsFinalInterface, PackingListIdInterface
{
}
