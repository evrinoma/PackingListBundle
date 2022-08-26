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

use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface LogisticsInterface
{
    /**
     * @return PackingListInterface
     */
    public function getPackingList(): PackingListInterface;

    /**
     * @param PackingListInterface $packingList
     *
     * @return LogisticsInterface
     */
    public function setPackingList(PackingListInterface $packingList): LogisticsInterface;

    /**
     * @return DepartInterface
     */
    public function getDepart(): DepartInterface;

    /**
     * @param DepartInterface $depart
     *
     * @return LogisticsInterface
     */
    public function setDepart(DepartInterface $depart): LogisticsInterface;

    /**
     * @return string
     */
    public function getUser(): string;

    /**
     * @param string $user
     *
     * @return LogisticsInterface
     */
    public function setUser(string $user): LogisticsInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     *
     * @return LogisticsInterface
     */
    public function setEmail(string $email): LogisticsInterface;

    /**
     * @return string
     */
    public function getSurname(): string;

    /**
     * @param string $surname
     *
     * @return LogisticsInterface
     */
    public function setSurname(string $surname): LogisticsInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     *
     * @return LogisticsInterface
     */
    public function setName(string $name): LogisticsInterface;

    /**
     * @return string
     */
    public function getPatronymic(): string;

    /**
     * @param string $patronymic
     *
     * @return LogisticsInterface
     */
    public function setPatronymic(string $patronymic): LogisticsInterface;
}
