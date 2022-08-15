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

namespace Evrinoma\PackingListBundle\Repository\PackingList;

use Evrinoma\PackingListBundle\Exception\PackingList\PackingListCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface PackingListCommandRepositoryInterface
{
    /**
     * @param PackingListInterface $packingList
     *
     * @return bool
     *
     * @throws PackingListCannotBeSavedException
     */
    public function save(PackingListInterface $packingList): bool;

    /**
     * @param PackingListInterface $packingList
     *
     * @return bool
     *
     * @throws PackingListCannotBeRemovedException
     */
    public function remove(PackingListInterface $packingList): bool;
}
