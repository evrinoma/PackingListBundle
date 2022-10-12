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

namespace Evrinoma\PackingListBundle\Repository;

interface AliasInterface
{
    public const PACKING_LIST_GROUP = 'packing_list_group';
    public const PACKING_LIST = 'packing_list';
    public const LIST_ITEM = 'list_item';
    public const LOGISTICS = 'logistics';
    public const DEPART = 'depart';
    public const GROUP = 'group';
}
