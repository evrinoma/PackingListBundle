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

namespace Evrinoma\PackingListBundle\Manager\Depart;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartInvalidException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartNotFoundException;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;

interface CommandManagerInterface
{
    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartInvalidException
     */
    public function post(DepartApiDtoInterface $dto): DepartInterface;

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartInvalidException
     * @throws DepartNotFoundException
     */
    public function put(DepartApiDtoInterface $dto): DepartInterface;

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @throws DepartCannotBeRemovedException
     * @throws DepartNotFoundException
     */
    public function delete(DepartApiDtoInterface $dto): void;
}
