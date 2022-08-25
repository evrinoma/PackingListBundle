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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CommentInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ConsigneeInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractDescriptionInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractorNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CurrentDeptInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DateTTNInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DimensionsInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\FormFactorInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\LabelInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ProjectNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\SubContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\WeightInterface;

interface PackingListApiDtoInterface extends IdInterface, LabelInterface, ContractInterface, ContractDescriptionInterface, ProjectNameInterface, ContractorNameInterface, SubContractInterface, WeightInterface, FormFactorInterface, DimensionsInterface, CurrentDeptInterface, DateTTNInterface, CommentInterface, ConsigneeInterface
{
}
