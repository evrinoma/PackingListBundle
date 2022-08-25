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

namespace Evrinoma\PackingListBundle\Model\ListItem;

use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;
use Evrinoma\UtilsBundle\Entity\NameInterface;

interface ListItemInterface extends IdInterface, NameInterface
{
    /**
     * @param int|null $id
     *
     * @return ListItemInterface
     */
    public function setId(?int $id): ListItemInterface;

    /**
     * @return string
     */
    public function getStateStandard(): string;

    /**
     * @param string $stateStandard
     *
     * @return ListItemInterface
     */
    public function setStateStandard(string $stateStandard): ListItemInterface;

    /**
     * @return float
     */
    public function getQuantity(): float;

    /**
     * @param float $quantity
     *
     * @return ListItemInterface
     */
    public function setQuantity(float $quantity): ListItemInterface;

    /**
     * @return string
     */
    public function getMeasure(): string;

    /**
     * @param string $measure
     *
     * @return ListItemInterface
     */
    public function setMeasure(string $measure): ListItemInterface;

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @param string $comment
     *
     * @return ListItemInterface
     */
    public function setComment(string $comment): ListItemInterface;

    /**
     * @return string
     */
    public function getSubContract(): string;

    /**
     * @param string $subContract
     *
     * @return ListItemInterface
     */
    public function setSubContract(string $subContract): ListItemInterface;

    /**
     * @return string
     */
    public function getNumber(): string;

    /**
     * @param string $number
     *
     * @return ListItemInterface
     */
    public function setNumber(string $number): ListItemInterface;

    /**
     * @return string
     */
    public function getStamp(): string;

    /**
     * @param string $stamp
     *
     * @return ListItemInterface
     */
    public function setStamp(string $stamp): ListItemInterface;

    /**
     * @return PackingListInterface
     */
    public function getPackingList(): PackingListInterface;

    /**
     * @param PackingListInterface $packingList
     *
     * @return ListItemInterface
     */
    public function setPackingList(PackingListInterface $packingList): ListItemInterface;
}
