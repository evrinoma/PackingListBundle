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

namespace Evrinoma\PackingListBundle\Mediator;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface CommandMediatorInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     * @param PackingListInterface       $entity
     *
     * @return PackingListInterface
     *
     * @throws PackingListCannotBeSavedException
     */
    public function onUpdate(PackingListApiDtoInterface $dto, PackingListInterface $entity): PackingListInterface;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param PackingListInterface       $entity
     *
     * @throws PackingListCannotBeRemovedException
     */
    public function onDelete(PackingListApiDtoInterface $dto, PackingListInterface $entity): void;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param PackingListInterface       $entity
     *
     * @return PackingListInterface
     *
     * @throws PackingListCannotBeSavedException
     * @throws PackingListCannotBeCreatedException
     */
    public function onCreate(PackingListApiDtoInterface $dto, PackingListInterface $entity): PackingListInterface;
}
