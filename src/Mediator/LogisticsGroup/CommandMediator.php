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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): LogisticsGroupInterface
    {
        /* @var $dto LogisticsGroupApiDtoInterface */
        $entity
            ->setUser($dto->getUserApiDto()->idToString())
            ->setEmail($dto->getUserApiDto()->getEmail())
            ->setSurname($dto->getUserApiDto()->getSurname())
            ->setName($dto->getUserApiDto()->getName())
            ->setPatronymic($dto->getUserApiDto()->getPatronymic());

        $entity->getDepart()->setWarehouse($dto->getDepartApiDto()->getWarehouse());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): LogisticsGroupInterface
    {
        /* @var $dto LogisticsGroupApiDtoInterface */
        $entity
            ->setUser($dto->getUserApiDto()->idToString())
            ->setEmail($dto->getUserApiDto()->getEmail())
            ->setSurname($dto->getUserApiDto()->getSurname())
            ->setName($dto->getUserApiDto()->getName())
            ->setPatronymic($dto->getUserApiDto()->getPatronymic());

        $entity->getDepart()->setWarehouse($dto->getDepartApiDto()->getWarehouse());

        return $entity;
    }
}
