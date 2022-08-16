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
use Evrinoma\PackingListBundle\Repository\Depart\DepartQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private DepartQueryRepositoryInterface $repository;

    public function __construct(DepartQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return array
     *
     * @throws DepartNotFoundException
     */
    public function criteria(DepartApiDtoInterface $dto): array
    {
        try {
            $packingList = $this->repository->findByCriteria($dto);
        } catch (DepartNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartProxyException
     */
    public function proxy(DepartApiDtoInterface $dto): DepartInterface
    {
        try {
            if ($dto->hasId()) {
                $packingList = $this->repository->proxy($dto->idToString());
            } else {
                throw new DepartProxyException('Id value is not set while trying get proxy object');
            }
        } catch (DepartProxyException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartNotFoundException
     */
    public function get(DepartApiDtoInterface $dto): DepartInterface
    {
        try {
            $packingList = $this->repository->find($dto->idToString());
        } catch (DepartNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }
}
