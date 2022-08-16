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
use Evrinoma\PackingListBundle\Exception\Depart\DepartNotFoundException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartProxyException;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;

interface QueryManagerInterface
{
    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return array
     *
     * @throws DepartNotFoundException
     */
    public function criteria(DepartApiDtoInterface $dto): array;

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartNotFoundException
     */
    public function get(DepartApiDtoInterface $dto): DepartInterface;

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartProxyException
     */
    public function proxy(DepartApiDtoInterface $dto): DepartInterface;
}
