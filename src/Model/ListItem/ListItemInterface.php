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

namespace Evrinoma\PackingListBundle\Model\PackingList;

use Evrinoma\UtilsBundle\Entity\IdInterface;
use Evrinoma\UtilsBundle\Entity\NameInterface;

interface ListItemInterface extends IdInterface, NameInterface
{
    /**
     * @param int|null $id
     *
     * @return PackingListInterface
     */
    public function setId(?int $id): PackingListInterface;

    /**
     * @return string
     */
    public function getStateStandard(): string;

    /**
     * @param string $stateStandard
     *
     * @return PackingListInterface
     */
    public function setStateStandard(string $stateStandard): PackingListInterface;

    /**
     * @return float
     */
    public function getQuantity(): float;

    /**
     * @param float $quantity
     *
     * @return PackingListInterface
     */
    public function setQuantity(float $quantity): PackingListInterface;

    /**
     * @return string
     */
    public function getMeasure(): string;

    /**
     * @param string $measure
     *
     * @return PackingListInterface
     */
    public function setMeasure(string $measure): PackingListInterface;

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @param string $comment
     *
     * @return PackingListInterface
     */
    public function setComment(string $comment): PackingListInterface;

    /**
     * @return string
     */
    public function getSubContract(): string;

    /**
     * @param string $subContract
     *
     * @return PackingListInterface
     */
    public function setSubContract(string $subContract): PackingListInterface;

    /**
     * @return string
     */
    public function getNumber(): string;

    /**
     * @param string $number
     *
     * @return PackingListInterface
     */
    public function setNumber(string $number): PackingListInterface;

    /**
     * @return string
     */
    public function getStamp(): string;

    /**
     * @param string $stamp
     *
     * @return PackingListInterface
     */
    public function setStamp(string $stamp): PackingListInterface;
}
