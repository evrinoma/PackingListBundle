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
use Evrinoma\DtoCommon\ValueObject\Immutable\NumberInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\CommentInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\MeasureInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\PackingListInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\QuantityInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\StampInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\StateStandardInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\SubContractInterface;

interface ListItemApiDtoInterface extends DtoInterface, IdInterface, NameInterface, NumberInterface, StateStandardInterface, QuantityInterface, MeasureInterface, CommentInterface, SubContractInterface, StampInterface, PackingListInterface
{
}
