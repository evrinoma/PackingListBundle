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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): ListItemInterface
    {
        /* @var $dto ListItemApiDtoInterface */
        $entity->setId($dto->getId());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): ListItemInterface
    {
        /* @var $dto ListItemApiDtoInterface */
        $entity->setId($dto->getId());

        return $entity;
    }
}
