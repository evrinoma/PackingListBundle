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

namespace Evrinoma\PackingListBundle\Mediator\Depart;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeSavedException;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;

interface CommandMediatorInterface
{
    /**
     * @param DepartApiDtoInterface $dto
     * @param DepartInterface       $entity
     *
     * @return DepartInterface
     *
     * @throws DepartCannotBeSavedException
     */
    public function onUpdate(DepartApiDtoInterface $dto, DepartInterface $entity): DepartInterface;

    /**
     * @param DepartApiDtoInterface $dto
     * @param DepartInterface       $entity
     *
     * @throws DepartCannotBeRemovedException
     */
    public function onDelete(DepartApiDtoInterface $dto, DepartInterface $entity): void;

    /**
     * @param DepartApiDtoInterface $dto
     * @param DepartInterface       $entity
     *
     * @return DepartInterface
     *
     * @throws DepartCannotBeSavedException
     * @throws DepartCannotBeCreatedException
     */
    public function onCreate(DepartApiDtoInterface $dto, DepartInterface $entity): DepartInterface;
}
