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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Evrinoma\UtilsBundle\Entity\NameTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractListItem implements PackingListInterface
{
    use IdTrait;
    use NameTrait;
    /**
     * @var string
     *
     * @ORM\Column(name="stateStandard", type="string", length=255, nullable=true)
     */
    protected string $stateStandard;
    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="decimal", precision=20, scale=2)
     */
    protected float $quantity;
    /**
     * @var string
     *
     * @ORM\Column(name="measure", type="string", length=255, nullable=true)
     */
    protected string $measure;
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    protected string $comment;
    /**
     * @var string
     *
     * @ORM\Column(name="subContract", type="string", length=255, nullable=true)
     */
    protected string $subContract;
    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=true)
     */
    protected string $number;
    /**
     * @var string
     *
     * @ORM\Column(name="stamp", type="string", length=255, nullable=true)
     */
    protected string $stamp;

    /**
     * @param int|null $id
     *
     * @return PackingListInterface
     */
    public function setId(?int $id): PackingListInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getStateStandard(): string
    {
        return $this->stateStandard;
    }

    /**
     * @param string $stateStandard
     *
     * @return PackingListInterface
     */
    public function setStateStandard(string $stateStandard): PackingListInterface
    {
        $this->stateStandard = $stateStandard;

        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     *
     * @return PackingListInterface
     */
    public function setQuantity(float $quantity): PackingListInterface
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeasure(): string
    {
        return $this->measure;
    }

    /**
     * @param string $measure
     *
     * @return PackingListInterface
     */
    public function setMeasure(string $measure): PackingListInterface
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return PackingListInterface
     */
    public function setComment(string $comment): PackingListInterface
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubContract(): string
    {
        return $this->subContract;
    }

    /**
     * @param string $subContract
     *
     * @return PackingListInterface
     */
    public function setSubContract(string $subContract): PackingListInterface
    {
        $this->subContract = $subContract;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return PackingListInterface
     */
    public function setNumber(string $number): PackingListInterface
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getStamp(): string
    {
        return $this->stamp;
    }

    /**
     * @param string $stamp
     *
     * @return PackingListInterface
     */
    public function setStamp(string $stamp): PackingListInterface
    {
        $this->stamp = $stamp;

        return $this;
    }

}
