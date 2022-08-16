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

namespace Evrinoma\PackingListBundle\Repository\Depart;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartNotFoundException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartProxyException;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;

interface DepartQueryRepositoryInterface
{
    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return array
     *
     * @throws DepartNotFoundException
     */
    public function findByCriteria(DepartApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return DepartInterface
     *
     * @throws DepartNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): DepartInterface;

    /**
     * @param string $id
     *
     * @return DepartInterface
     *
     * @throws DepartProxyException
     * @throws ORMException
     */
    public function proxy(string $id): DepartInterface;
}
