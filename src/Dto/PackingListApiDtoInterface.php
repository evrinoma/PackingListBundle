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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractDescriptionInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ContractorNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ItemsApiDtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\LabelInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\ProjectNameInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\SubContractInterface;

interface PackingListApiDtoInterface extends DtoInterface, IdInterface, LabelInterface, ContractInterface, ContractDescriptionInterface, ProjectNameInterface, ContractorNameInterface, SubContractInterface, ItemsApiDtoInterface
{
    /**
     * @param DtoInterface $dto
     *
     * @return $this
     */
    public function addListItemApiDto(DtoInterface $dto): DtoInterface;
}
