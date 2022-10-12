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

namespace Evrinoma\PackingListBundle\Mediator\Group;

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

interface CommandMediatorInterface
{
    /**
     * @param GroupApiDtoInterface $dto
     * @param GroupInterface       $entity
     *
     * @return GroupInterface
     *
     * @throws GroupCannotBeSavedException
     */
    public function onUpdate(GroupApiDtoInterface $dto, GroupInterface $entity): GroupInterface;

    /**
     * @param GroupApiDtoInterface $dto
     * @param GroupInterface       $entity
     *
     * @throws GroupCannotBeRemovedException
     */
    public function onDelete(GroupApiDtoInterface $dto, GroupInterface $entity): void;

    /**
     * @param GroupApiDtoInterface $dto
     * @param GroupInterface       $entity
     *
     * @return GroupInterface
     *
     * @throws GroupCannotBeSavedException
     * @throws GroupCannotBeCreatedException
     */
    public function onCreate(GroupApiDtoInterface $dto, GroupInterface $entity): GroupInterface;
}
