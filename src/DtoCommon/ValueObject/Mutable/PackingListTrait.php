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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\PackingListTrait as PackingListImmutableTrait;

trait PackingListTrait
{
    use PackingListImmutableTrait;

    /**
     * @param PackingListApiDtoInterface $packingListApiDto
     *
     * @return DtoInterface
     */
    public function setPackingListApiDto(PackingListApiDtoInterface $packingListApiDto): DtoInterface
    {
        $this->packingListApiDto = $packingListApiDto;

        return $this;
    }
}
