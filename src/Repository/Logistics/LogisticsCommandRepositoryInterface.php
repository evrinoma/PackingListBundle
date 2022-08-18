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

namespace Evrinoma\PackingListBundle\Repository\Logistics;

use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;

interface LogisticsCommandRepositoryInterface
{
    /**
     * @param LogisticsInterface $packingList
     *
     * @return bool
     *
     * @throws LogisticsCannotBeSavedException
     */
    public function save(LogisticsInterface $packingList): bool;

    /**
     * @param LogisticsInterface $packingList
     *
     * @return bool
     *
     * @throws LogisticsCannotBeRemovedException
     */
    public function remove(LogisticsInterface $packingList): bool;
}
