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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;

trait ItemsApiDtoTrait
{
    /**
     * @param ListItemApiDtoInterface[] $itemsApiDto
     *
     * @return DtoInterface
     */
    public function setItemsApiDto(array $itemsApiDto): DtoInterface
    {
        return parent::setItemsApiDto($itemsApiDto);
    }
}
