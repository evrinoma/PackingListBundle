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

namespace Evrinoma\PackingListBundle\Model\Depart;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Evrinoma\UtilsBundle\Entity\NameTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractDepart implements DepartInterface
{
    use IdTrait;
    use NameTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface")
     */
    protected PackingListInterface $packingList;

    /**
     * @var string
     *
     * @ORM\Column(name="point", type="string", length=255, nullable=true)
     */
    protected string $point = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected string $address = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="final", type="boolean")
     */
    protected bool $final = false;

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
     * @return DepartInterface
     */
    public function setPackingList(PackingListInterface $packingList): DepartInterface
    {
        $this->packingList = $packingList;

        return $this;
    }

    /**
     * @param int|null $id
     *
     * @return DepartInterface
     */
    public function setId(?int $id): DepartInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPoint(): string
    {
        return $this->point;
    }

    /**
     * @param string $point
     *
     * @return DepartInterface
     */
    public function setPoint(string $point): DepartInterface
    {
        $this->point = $point;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return DepartInterface
     */
    public function setAddress(string $address): DepartInterface
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->final;
    }

    /**
     * @param bool $final
     *
     * @return DepartInterface
     */
    public function setFinal(bool $final): DepartInterface
    {
        $this->final = $final;

        return $this;
    }
}
