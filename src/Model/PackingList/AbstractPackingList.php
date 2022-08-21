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

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractPackingList implements PackingListInterface
{
    use IdTrait;
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    protected string $label = '';
    /**
     * @var string
     *
     * @ORM\Column(name="contract", type="string", length=255, nullable=true)
     */
    protected string $contract = '';
    /**
     * @var string
     *
     * @ORM\Column(name="contractDescription", type="string", length=255, nullable=true)
     */
    protected string $contractDescription = '';
    /**
     * @var string
     *
     * @ORM\Column(name="projectName", type="string", length=255, nullable=true)
     */
    protected string $projectName = '';
    /**
     * @var string
     *
     * @ORM\Column(name="contractorName", type="string", length=255, nullable=true)
     */
    protected string $contractorName = '';
    /**
     * @var string
     *
     * @ORM\Column(name="subContracts", type="string", length=255, nullable=true)
     */
    protected string $subContracts = '';

    /**
     * @ORM\OneToMany(targetEntity="Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface", mappedBy="id")
     */
    protected $items = null;

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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return PackingListInterface
     */
    public function setLabel(string $label): PackingListInterface
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getContract(): string
    {
        return $this->contract;
    }

    /**
     * @param string $contract
     *
     * @return PackingListInterface
     */
    public function setContract(string $contract): PackingListInterface
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * @return string
     */
    public function getContractDescription(): string
    {
        return $this->contractDescription;
    }

    /**
     * @param string $contractDescription
     *
     * @return PackingListInterface
     */
    public function setContractDescription(string $contractDescription): PackingListInterface
    {
        $this->contractDescription = $contractDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getProjectName(): string
    {
        return $this->projectName;
    }

    /**
     * @param string $projectName
     *
     * @return PackingListInterface
     */
    public function setProjectName(string $projectName): PackingListInterface
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * @return string
     */
    public function getContractorName(): string
    {
        return $this->contractorName;
    }

    /**
     * @param string $contractorName
     *
     * @return PackingListInterface
     */
    public function setContractorName(string $contractorName): PackingListInterface
    {
        $this->contractorName = $contractorName;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubContracts(): string
    {
        return $this->subContracts;
    }

    /**
     * @param string $subContracts
     *
     * @return PackingListInterface
     */
    public function setSubContracts(string $subContracts): PackingListInterface
    {
        $this->subContracts = $subContracts;

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $items
     *
     * @return PackingListInterface
     */
    public function setItems($items): PackingListInterface
    {
        $this->items = $items;

        return $this;
    }
}
