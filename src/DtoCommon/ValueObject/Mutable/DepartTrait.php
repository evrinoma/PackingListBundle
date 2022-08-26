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
use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\DepartTrait as DepartImmutableTrait;

trait DepartTrait
{
    use DepartImmutableTrait;

    /**
     * @param DepartApiDtoInterface $depart
     *
     * @return DtoInterface
     */
    public function setDepartApiDto(DepartApiDtoInterface $depart): DtoInterface
    {
        $this->depart = $depart;

        return $this;
    }
}
