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

namespace Evrinoma\PackingListBundle\Model\LogisticsGroup;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PackingListBundle\Model\Common\UserTrait;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractLogisticsGroup implements LogisticsGroupInterface
{
    use UserTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\Group\GroupInterface")
     */
    protected GroupInterface $group;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\DepartInterface")
     */
    protected DepartInterface $depart;

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
     * @return LogisticsGroupInterface
     */
    public function setDepart(DepartInterface $depart): LogisticsGroupInterface
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface
    {
        return $this->group;
    }

    /**
     * @param GroupInterface $group
     */
    public function setGroup(GroupInterface $group): LogisticsGroupInterface
    {
        $this->group = $group;

        return $this;
    }
}
