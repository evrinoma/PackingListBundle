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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): LogisticsInterface
    {
        /* @var $dto LogisticsApiDtoInterface */
        $entity
            ->setUser($dto->getUserApiDto()->idToString())
            ->setEmail($dto->getUserApiDto()->getEmail())
            ->setSurname($dto->getUserApiDto()->getSurname())
            ->setName($dto->getUserApiDto()->getName())
            ->setPatronymic($dto->getUserApiDto()->getPatronymic());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): LogisticsInterface
    {
        /* @var $dto LogisticsApiDtoInterface */
        $entity
            ->setUser($dto->getUserApiDto()->idToString())
            ->setEmail($dto->getUserApiDto()->getEmail())
            ->setSurname($dto->getUserApiDto()->getSurname())
            ->setName($dto->getUserApiDto()->getName())
            ->setPatronymic($dto->getUserApiDto()->getPatronymic());

        return $entity;
    }
}
