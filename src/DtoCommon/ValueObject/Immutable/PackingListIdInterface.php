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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable;

interface PackingListIdInterface
{
    public const PACKING_LIST_ID = 'packing_list_id';

    /**
     * @return bool
     */
    public function hasPackingListId(): bool;

    /**
     * @return string
     */
    public function getPackingListId(): string;
}
