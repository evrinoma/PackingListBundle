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

namespace Evrinoma\PackingListBundle\Factory\Depart;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;

interface FactoryInterface
{
    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     */
    public function create(DepartApiDtoInterface $dto): DepartInterface;
}
