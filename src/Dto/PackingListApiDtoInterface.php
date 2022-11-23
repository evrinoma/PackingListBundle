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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\CommentInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ConsigneeInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractDescriptionInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractorNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\CurrentDeptInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\DateTTNInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\DimensionsInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\FormFactorInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\LabelInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\LinkFileInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ProjectNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\SubContractsInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\WeightInterface;

interface PackingListApiDtoInterface extends DtoInterface, LinkFileInterface, IdInterface, LabelInterface, ContractInterface, ContractDescriptionInterface, ProjectNameInterface, ContractorNameInterface, SubContractsInterface, WeightInterface, FormFactorInterface, DimensionsInterface, CurrentDeptInterface, DateTTNInterface, CommentInterface, ConsigneeInterface
{
}
