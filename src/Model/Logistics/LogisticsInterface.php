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

namespace Evrinoma\PackingListBundle\Model\Logistics;

interface LogisticsInterface
{
    /**
     * @return string
     */
    public function getPackingListId(): string;

    /**
     * @param string $packingListId
     *
     * @return LogisticsInterface
     */
    public function setPackingListId(string $packingListId): LogisticsInterface;

    /**
     * @return string
     */
    public function getIdDepart(): string;

    /**
     * @param string $idDepart
     *
     * @return LogisticsInterface
     */
    public function setIdDepart(string $idDepart): LogisticsInterface;
}
