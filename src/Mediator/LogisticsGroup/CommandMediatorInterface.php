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

namespace Evrinoma\PackingListBundle\Mediator\LogisticsGroup;

use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;

interface CommandMediatorInterface
{
    /**
     * @param LogisticsGroupApiDtoInterface $dto
     * @param LogisticsGroupInterface       $entity
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupCannotBeSavedException
     */
    public function onUpdate(LogisticsGroupApiDtoInterface $dto, LogisticsGroupInterface $entity): LogisticsGroupInterface;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     * @param LogisticsGroupInterface       $entity
     *
     * @throws LogisticsGroupCannotBeRemovedException
     */
    public function onDelete(LogisticsGroupApiDtoInterface $dto, LogisticsGroupInterface $entity): void;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     * @param LogisticsGroupInterface       $entity
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupCannotBeSavedException
     * @throws LogisticsGroupCannotBeCreatedException
     */
    public function onCreate(LogisticsGroupApiDtoInterface $dto, LogisticsGroupInterface $entity): LogisticsGroupInterface;
}
