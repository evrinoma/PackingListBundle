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
     * @ORM\Column(name="packing_List", type="string", length=255, nullable=true)
     * @ORM\Id
     */
    protected string $packingList = '';

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=true)
     */
    protected string $depart = '';

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
     * @return string
     */
    public function getPackingList(): string
    {
        return $this->packingList;
    }

    /**
     * @param string $packingList
     *
     * @return LogisticsInterface
     */
    public function setPackingList(string $packingList): LogisticsInterface
    {
        $this->packingList = $packingList;

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
