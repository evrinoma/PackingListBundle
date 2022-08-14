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
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface CommandManagerInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListInvalidException
     */
    public function post(PackingListApiDtoInterface $dto): PackingListInterface;

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListInvalidException
     * @throws PackingListNotFoundException
     */
    public function put(PackingListApiDtoInterface $dto): PackingListInterface;

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @throws PackingListCannotBeRemovedException
     * @throws PackingListNotFoundException
     */
    public function delete(PackingListApiDtoInterface $dto): void;
}
