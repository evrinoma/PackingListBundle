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

namespace Evrinoma\PackingListBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\NameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\AddressInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\DepartInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\FinalInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\PackingListInterface;

interface DepartApiDtoInterface extends DtoInterface, IdInterface, NameInterface, AddressInterface, DepartInterface, FinalInterface, PackingListInterface
{
}
