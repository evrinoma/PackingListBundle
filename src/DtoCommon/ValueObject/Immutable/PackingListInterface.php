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

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;

interface PackingListInterface
{
    public const PACKING_LIST = 'packing_list';

    public function hasPackingListApiDto(): bool;

    public function getPackingListApiDto(): PackingListApiDtoInterface;
}
