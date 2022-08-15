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

namespace Evrinoma\PackingListBundle\Mediator\ListItem;

use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

interface CommandMediatorInterface
{
    /**
     * @param ListItemApiDtoInterface $dto
     * @param ListItemInterface       $entity
     *
     * @return ListItemInterface
     *
     * @throws ListItemCannotBeSavedException
     */
    public function onUpdate(ListItemApiDtoInterface $dto, ListItemInterface $entity): ListItemInterface;

    /**
     * @param ListItemApiDtoInterface $dto
     * @param ListItemInterface       $entity
     *
     * @throws ListItemCannotBeRemovedException
     */
    public function onDelete(ListItemApiDtoInterface $dto, ListItemInterface $entity): void;

    /**
     * @param ListItemApiDtoInterface $dto
     * @param ListItemInterface       $entity
     *
     * @return ListItemInterface
     *
     * @throws ListItemCannotBeSavedException
     * @throws ListItemCannotBeCreatedException
     */
    public function onCreate(ListItemApiDtoInterface $dto, ListItemInterface $entity): ListItemInterface;
}
