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

namespace Evrinoma\PackingListBundle\Repository\PackingListGroup;

use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

interface PackingListGroupCommandRepositoryInterface
{
    /**
     * @param PackingListGroupInterface $packingList
     *
     * @return bool
     *
     * @throws PackingListGroupCannotBeSavedException
     */
    public function save(PackingListGroupInterface $packingList): bool;

    /**
     * @param PackingListGroupInterface $packingList
     *
     * @return bool
     *
     * @throws PackingListGroupCannotBeRemovedException
     */
    public function remove(PackingListGroupInterface $packingList): bool;
}
