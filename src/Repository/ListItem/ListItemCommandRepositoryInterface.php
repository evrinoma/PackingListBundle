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

namespace Evrinoma\PackingListBundle\Repository\ListItem;

use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

interface ListItemCommandRepositoryInterface
{
    /**
     * @param ListItemInterface $listItem
     *
     * @return bool
     *
     * @throws ListItemCannotBeSavedException
     */
    public function save(ListItemInterface $listItem): bool;

    /**
     * @param ListItemInterface $listItem
     *
     * @return bool
     *
     * @throws ListItemCannotBeRemovedException
     */
    public function remove(ListItemInterface $listItem): bool;
}
