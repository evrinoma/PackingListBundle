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

namespace Evrinoma\PackingListBundle\Mediator\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

interface CommandMediatorInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     * @param PackingListGroupInterface  $entity
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupCannotBeSavedException
     */
    public function onUpdate(PackingListApiDtoInterface $dto, PackingListGroupInterface $entity): PackingListGroupInterface;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param PackingListGroupInterface  $entity
     *
     * @throws PackingListGroupCannotBeRemovedException
     */
    public function onDelete(PackingListApiDtoInterface $dto, PackingListGroupInterface $entity): void;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param PackingListGroupInterface  $entity
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupCannotBeSavedException
     * @throws PackingListGroupCannotBeCreatedException
     */
    public function onCreate(PackingListApiDtoInterface $dto, PackingListGroupInterface $entity): PackingListGroupInterface;
}
