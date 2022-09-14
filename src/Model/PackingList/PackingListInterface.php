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

interface PackingListInterface extends IdInterface
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
    public function getLabel(): string;

    /**
     * @param string $label
     *
     * @return PackingListInterface
     */
    public function setLabel(string $label): PackingListInterface;

    /**
     * @return string
     */
    public function getContract(): string;

    /**
     * @param string $contract
     *
     * @return PackingListInterface
     */
    public function setContract(string $contract): PackingListInterface;

    /**
     * @return string
     */
    public function getContractDescription(): string;

    /**
     * @param string $contractDescription
     *
     * @return PackingListInterface
     */
    public function setContractDescription(string $contractDescription): PackingListInterface;

    /**
     * @return string
     */
    public function getProjectName(): string;

    /**
     * @param string $projectName
     *
     * @return PackingListInterface
     */
    public function setProjectName(string $projectName): PackingListInterface;

    /**
     * @return string
     */
    public function getContractorName(): string;

    /**
     * @param string $contractorName
     *
     * @return PackingListInterface
     */
    public function setContractorName(string $contractorName): PackingListInterface;

    /**
     * @return string
     */
    public function getSubContracts(): string;

    /**
     * @param string $subContracts
     *
     * @return PackingListInterface
     */
    public function setSubContracts(string $subContracts): PackingListInterface;

    /**
     * @return string
     */
    public function getWeight(): string;

    /**
     * @param string $weight
     *
     * @return PackingListInterface
     */
    public function setWeight(string $weight): PackingListInterface;

    /**
     * @return string
     */
    public function getFormFactor(): string;

    /**
     * @param string $formFactor
     *
     * @return PackingListInterface
     */
    public function setFormFactor(string $formFactor): PackingListInterface;

    /**
     * @return string
     */
    public function getDimensions(): string;

    /**
     * @param string $dimensions
     *
     * @return PackingListInterface
     */
    public function setDimensions(string $dimensions): PackingListInterface;

    /**
     * @return string
     */
    public function getCurrentDept(): string;

    /**
     * @param string $currentDept
     *
     * @return PackingListInterface
     */
    public function setCurrentDept(string $currentDept): PackingListInterface;

    /**
     * @return ?\DateTimeImmutable
     */
    public function getDateTTN(): ?\DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $dateTTN
     *
     * @return PackingListInterface
     */
    public function setDateTTN(\DateTimeImmutable $dateTTN): PackingListInterface;

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
    public function getConsignee(): string;

    /**
     * @param string $consignee
     *
     * @return PackingListInterface
     */
    public function setConsignee(string $consignee): PackingListInterface;

    /**
     * @return string
     */
    public function getLinkFile(): string;

    /**
     * @param string $linkFile
     *
     * @return PackingListInterface
     */
    public function setLinkFile(string $linkFile): PackingListInterface;
}
