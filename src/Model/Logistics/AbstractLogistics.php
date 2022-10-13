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

namespace Evrinoma\PackingListBundle\Model\Logistics;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PackingListBundle\Model\Common\UserTrait;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractLogistics implements LogisticsInterface
{
    use UserTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface")
     */
    protected PackingListInterface $packingList;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\DepartInterface")
     */
    protected DepartInterface $depart;

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
     * @return LogisticsInterface
     */
    public function setPackingList(PackingListInterface $packingList): LogisticsInterface
    {
        $this->packingList = $packingList;

        return $this;
    }

    /**
     * @return DepartInterface
     */
    public function getDepart(): DepartInterface
    {
        return $this->depart;
    }

    /**
     * @param DepartInterface $depart
     *
     * @return LogisticsInterface
     */
    public function setDepart(DepartInterface $depart): LogisticsInterface
    {
        $this->depart = $depart;

        return $this;
    }
}
