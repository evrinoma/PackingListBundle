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

use Evrinoma\PackingListBundle\Model\Group\GroupInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;
use Evrinoma\UtilsBundle\Entity\NameInterface;

interface DepartInterface extends IdInterface, NameInterface
{
    /**
     * @param int|null $id
     *
     * @return DepartInterface
     */
    public function setId(?int $id): DepartInterface;

    /**
     * @return string
     */
    public function getPoint(): string;

    /**
     * @param string $point
     *
     * @return DepartInterface
     */
    public function setPoint(string $point): DepartInterface;

    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @param string $address
     *
     * @return DepartInterface
     */
    public function setAddress(string $address): DepartInterface;

    /**
     * @return bool
     */
    public function isFinal(): bool;

    /**
     * @param bool $final
     *
     * @return DepartInterface
     */
    public function setFinal(bool $final): DepartInterface;

    /**
     * @return PackingListInterface
     */
    public function getPackingList(): PackingListInterface;

    /**
     * @param PackingListInterface $packingList
     *
     * @return DepartInterface
     */
    public function setPackingList(PackingListInterface $packingList): DepartInterface;

    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface;

    /**
     * @param GroupInterface $group
     *
     * @return DepartInterface
     */
    public function setGroup(GroupInterface $group): DepartInterface;

    /**
     * @return string
     */
    public function getWarehouse(): string;

    /**
     * @param string $warehouse
     *
     * @return DepartInterface
     */
    public function setWarehouse(string $warehouse): DepartInterface;
}
