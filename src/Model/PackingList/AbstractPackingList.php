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
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
     */
    protected string $weight = '';

    /**
     * @var string
     *
     * @ORM\Column(name="formFactor", type="string", length=255, nullable=true)
     */
    protected string $formFactor = '';

    /**
     * @var string
     *
     * @ORM\Column(name="dimensions", type="string", length=255, nullable=true)
     */
    protected string $dimensions = '';

    /**
     * @var string
     *
     * @ORM\Column(name="currentDept", type="string", length=255, nullable=true)
     */
    protected string $currentDept = '';

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="dateTTN", type="datetime_immutable", nullable=true)
     */
    protected $dateTTN;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    protected string $comment = '';

    /**
     * @var string
     *
     * @ORM\Column(name="consignee", type="string", length=255, nullable=true)
     */
    protected string $consignee = '';

    /**
     * @return string
     */
    public function getWeight(): string
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     *
     * @return PackingListInterface
     */
    public function setWeight(string $weight): PackingListInterface
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormFactor(): string
    {
        return $this->formFactor;
    }

    /**
     * @param string $formFactor
     *
     * @return PackingListInterface
     */
    public function setFormFactor(string $formFactor): PackingListInterface
    {
        $this->formFactor = $formFactor;

        return $this;
    }

    /**
     * @return string
     */
    public function getDimensions(): string
    {
        return $this->dimensions;
    }

    /**
     * @param string $dimensions
     *
     * @return PackingListInterface
     */
    public function setDimensions(string $dimensions): PackingListInterface
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentDept(): string
    {
        return $this->currentDept;
    }

    /**
     * @param string $currentDept
     *
     * @return PackingListInterface
     */
    public function setCurrentDept(string $currentDept): PackingListInterface
    {
        $this->currentDept = $currentDept;

        return $this;
    }

    /**
     * @return ?\DateTimeImmutable
     */
    public function getDateTTN(): ?\DateTimeImmutable
    {
        return $this->dateTTN;
    }

    /**
     * @param \DateTimeImmutable $dateTTN
     *
     * @return PackingListInterface
     */
    public function setDateTTN(\DateTimeImmutable $dateTTN): PackingListInterface
    {
        $this->dateTTN = $dateTTN;

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
    public function getConsignee(): string
    {
        return $this->consignee;
    }

    /**
     * @param string $consignee
     *
     * @return PackingListInterface
     */
    public function setConsignee(string $consignee): PackingListInterface
    {
        $this->consignee = $consignee;

        return $this;
    }
























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
}
