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

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractLogistics implements LogisticsInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="packingListId", type="string", length=255, nullable=true)
     * @ORM\Id
     */
    protected string $packingListId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=true)
     */
    protected string $depart = '';

    /**
     * @return string
     */
    public function getPackingListId(): string
    {
        return $this->packingListId;
    }

    /**
     * @param string $packingListId
     *
     * @return LogisticsInterface
     */
    public function setPackingListId(string $packingListId): LogisticsInterface
    {
        $this->packingListId = $packingListId;

        return $this;
    }

    /**
     * @return string
     */
    public function getDepart(): string
    {
        return $this->depart;
    }

    /**
     * @param string $depart
     *
     * @return LogisticsInterface
     */
    public function setDepart(string $depart): LogisticsInterface
    {
        $this->depart = $depart;

        return $this;
    }
}
