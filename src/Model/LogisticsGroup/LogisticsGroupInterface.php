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

use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

interface LogisticsGroupInterface
{
    /**
     * @return DepartInterface
     */
    public function getDepart(): DepartInterface;

    /**
     * @param DepartInterface $depart
     *
     * @return LogisticsGroupInterface
     */
    public function setDepart(DepartInterface $depart): LogisticsGroupInterface;

    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface;

    /**
     * @param GroupInterface $group
     */
    public function setGroup(GroupInterface $group): LogisticsGroupInterface;

    /**
     * @return string
     */
    public function getUser(): string;

    /**
     * @param string $user
     *
     * @return LogisticsGroupInterface
     */
    public function setUser(string $user): LogisticsGroupInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     *
     * @return LogisticsGroupInterface
     */
    public function setEmail(string $email): LogisticsGroupInterface;

    /**
     * @return string
     */
    public function getSurname(): string;

    /**
     * @param string $surname
     *
     * @return LogisticsGroupInterface
     */
    public function setSurname(string $surname): LogisticsGroupInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     *
     * @return LogisticsGroupInterface
     */
    public function setName(string $name): LogisticsGroupInterface;

    /**
     * @return string
     */
    public function getPatronymic(): string;

    /**
     * @param string $patronymic
     *
     * @return LogisticsGroupInterface
     */
    public function setPatronymic(string $patronymic): LogisticsGroupInterface;
}
