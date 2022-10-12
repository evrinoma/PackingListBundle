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

namespace Evrinoma\PackingListBundle\Repository\Group;

use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

interface GroupCommandRepositoryInterface
{
    /**
     * @param GroupInterface $group
     *
     * @return bool
     *
     * @throws GroupCannotBeSavedException
     */
    public function save(GroupInterface $group): bool;

    /**
     * @param GroupInterface $group
     *
     * @return bool
     *
     * @throws GroupCannotBeRemovedException
     */
    public function remove(GroupInterface $group): bool;
}
