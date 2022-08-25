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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\NumberInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\NameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CommentInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\MeasureInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\QuantityInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\StampInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\StateStandardInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\SubContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListInterface;


interface ListItemApiDtoInterface extends DtoInterface, IdInterface, NameInterface, NumberInterface, StateStandardInterface, QuantityInterface, MeasureInterface, CommentInterface, SubContractInterface, StampInterface, PackingListInterface
{
}
