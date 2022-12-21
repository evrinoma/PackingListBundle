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

namespace Evrinoma\PackingListBundle\Factory\PackingList;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface FactoryInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     */
    public function create(PackingListApiDtoInterface $dto): PackingListInterface;
}
