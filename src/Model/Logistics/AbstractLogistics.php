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
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractLogistics implements LogisticsInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface")
     */
    protected PackingListInterface $packingList;

    /**
     * @ORM\ManyToOne(targetEntity="Evrinoma\PackingListBundle\Model\PackingList\DepartInterface")
     */
    protected DepartInterface $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255, nullable=true)
     */
    protected string $user = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected string $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    protected string $surname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected string $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="patronymic", type="string", length=255, nullable=true)
     */
    protected string $patronymic = '';

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     *
     * @return LogisticsInterface
     */
    public function setUser(string $user): LogisticsInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return LogisticsInterface
     */
    public function setEmail(string $email): LogisticsInterface
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return LogisticsInterface
     */
    public function setSurname(string $surname): LogisticsInterface
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return LogisticsInterface
     */
    public function setName(string $name): LogisticsInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    /**
     * @param string $patronymic
     *
     * @return LogisticsInterface
     */
    public function setPatronymic(string $patronymic): LogisticsInterface
    {
        $this->patronymic = $patronymic;

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
