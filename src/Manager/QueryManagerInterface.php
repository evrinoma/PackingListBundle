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

namespace Evrinoma\PackingListBundle\Manager;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingListProxyException;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface QueryManagerInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListNotFoundException
     */
    public function criteria(PackingListApiDtoInterface $dto): array;

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListNotFoundException
     */
    public function get(PackingListApiDtoInterface $dto): PackingListInterface;

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListProxyException
     */
    public function proxy(PackingListApiDtoInterface $dto): PackingListInterface;
}
