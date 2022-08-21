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

namespace Evrinoma\PackingListBundle\Repository\Depart;

use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;

interface DepartCommandRepositoryInterface
{
    /**
     * @param DepartInterface $depart
     *
     * @return bool
     *
     * @throws DepartCannotBeSavedException
     */
    public function save(DepartInterface $depart): bool;

    /**
     * @param DepartInterface $depart
     *
     * @return bool
     *
     * @throws DepartCannotBeRemovedException
     */
    public function remove(DepartInterface $depart): bool;
}
