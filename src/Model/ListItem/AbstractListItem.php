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

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Evrinoma\UtilsBundle\Entity\NameTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractListItem implements ListItemInterface
{
    use IdTrait;
    use NameTrait;
    /**
     * @var string
     *
     * @ORM\Column(name="stateStandard", type="string", length=255, nullable=true)
     */
    protected string $stateStandard = '';
    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="decimal", precision=20, scale=2)
     */
    protected float $quantity = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="measure", type="string", length=255, nullable=true)
     */
    protected string $measure = '';
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    protected string $comment = '';
    /**
     * @var string
     *
     * @ORM\Column(name="subContract", type="string", length=255, nullable=true)
     */
    protected string $subContract = '';
    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=true)
     */
    protected string $number = '';
    /**
     * @var string
     *
     * @ORM\Column(name="stamp", type="string", length=255, nullable=true)
     */
    protected string $stamp = '';

    /**
     * @param int|null $id
     *
     * @return ListItemInterface
     */
    public function setId(?int $id): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setStateStandard(string $stateStandard): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setQuantity(float $quantity): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setMeasure(string $measure): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setComment(string $comment): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setSubContract(string $subContract): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setNumber(string $number): ListItemInterface
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
     * @return ListItemInterface
     */
    public function setStamp(string $stamp): ListItemInterface
    {
        $this->stamp = $stamp;

        return $this;
    }
}
