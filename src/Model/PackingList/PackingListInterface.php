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

    public function getItems();

    /**
     * @param $items
     *
     * @return PackingListInterface
     */
    public function setItems($items): PackingListInterface;
}
