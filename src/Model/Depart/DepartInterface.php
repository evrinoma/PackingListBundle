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
    public function getIdDepart(): string;

    /**
     * @param string $idDepart
     *
     * @return DepartInterface
     */
    public function setIdDepart(string $idDepart): DepartInterface;

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
     * @param bool $isFinal
     *
     * @return DepartInterface
     */
    public function setIsFinal(bool $isFinal): DepartInterface;
}
