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

namespace Evrinoma\PackingListBundle\Repository\LogisticsGroup;

use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;

interface LogisticsGroupCommandRepositoryInterface
{
    /**
     * @param LogisticsGroupInterface $logistics
     *
     * @return bool
     *
     * @throws LogisticsGroupCannotBeSavedException
     */
    public function save(LogisticsGroupInterface $logistics): bool;

    /**
     * @param LogisticsGroupInterface $logistics
     *
     * @return bool
     *
     * @throws LogisticsGroupCannotBeRemovedException
     */
    public function remove(LogisticsGroupInterface $logistics): bool;
}
