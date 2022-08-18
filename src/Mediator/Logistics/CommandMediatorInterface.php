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

namespace Evrinoma\PackingListBundle\Mediator\Logistics;

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;

interface CommandMediatorInterface
{
    /**
     * @param LogisticsApiDtoInterface $dto
     * @param LogisticsInterface       $entity
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsCannotBeSavedException
     */
    public function onUpdate(LogisticsApiDtoInterface $dto, LogisticsInterface $entity): LogisticsInterface;

    /**
     * @param LogisticsApiDtoInterface $dto
     * @param LogisticsInterface       $entity
     *
     * @throws LogisticsCannotBeRemovedException
     */
    public function onDelete(LogisticsApiDtoInterface $dto, LogisticsInterface $entity): void;

    /**
     * @param LogisticsApiDtoInterface $dto
     * @param LogisticsInterface       $entity
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsCannotBeSavedException
     * @throws LogisticsCannotBeCreatedException
     */
    public function onCreate(LogisticsApiDtoInterface $dto, LogisticsInterface $entity): LogisticsInterface;
}
