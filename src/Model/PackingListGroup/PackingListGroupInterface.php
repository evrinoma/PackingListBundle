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

namespace Evrinoma\PackingListBundle\Model\PackingListGroup;

use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface PackingListGroupInterface extends IdInterface
{
    /**
     * @param int|null $id
     *
     * @return PackingListGroupInterface
     */
    public function setId(?int $id): PackingListGroupInterface;

    /**
     * @return PackingListInterface
     */
    public function getPackingList(): PackingListInterface;

    /**
     * @param PackingListInterface $packingList
     *
     * @return PackingListGroupInterface
     */
    public function setPackingList(PackingListInterface $packingList): PackingListGroupInterface;

    /**
     * @return GroupInterface
     */
    public function getPackingListGroup(): GroupInterface;

    /**
     * @param GroupInterface $packingListGroup
     *
     * @return PackingListGroupInterface
     */
    public function setPackingListGroup(GroupInterface $packingListGroup): PackingListGroupInterface;
}
