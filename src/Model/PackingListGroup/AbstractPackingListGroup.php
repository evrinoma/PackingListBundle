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

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractPackingListGroup implements PackingListGroupInterface
{
    use IdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\Group\GroupInterface")
     */
    protected GroupInterface $packingListGroup;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface")
     */
    protected PackingListInterface $packingList;

    /**
     * @param int|null $id
     *
     * @return PackingListGroupInterface
     */
    public function setId(?int $id): PackingListGroupInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return PackingListInterface
     */
    public function getPackingList(): PackingListInterface
    {
        return $this->packingList;
    }

    /**
     * @param PackingListInterface $packingList
     *
     * @return PackingListGroupInterface
     */
    public function setPackingList(PackingListInterface $packingList): PackingListGroupInterface
    {
        $this->packingList = $packingList;

        return $this;
    }

    /**
     * @return GroupInterface
     */
    public function getPackingListGroup(): GroupInterface
    {
        return $this->packingListGroup;
    }

    /**
     * @param GroupInterface $packingListGroup
     *
     * @return PackingListGroupInterface
     */
    public function setPackingListGroup(GroupInterface $packingListGroup): PackingListGroupInterface
    {
        $this->packingListGroup = $packingListGroup;

        return $this;
    }


}
