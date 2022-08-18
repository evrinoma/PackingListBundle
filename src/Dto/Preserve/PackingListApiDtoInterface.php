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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractDescriptionInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractorNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\LabelInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ProjectNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\SubContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ItemsApiDtoInterface;

interface PackingListApiDtoInterface extends IdInterface, LabelInterface, ContractInterface, ContractDescriptionInterface, ProjectNameInterface, ContractorNameInterface, SubContractInterface, ItemsApiDtoInterface
{
}
