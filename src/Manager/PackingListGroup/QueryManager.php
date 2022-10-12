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

namespace Evrinoma\PackingListBundle\Manager\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupProxyException;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;
use Evrinoma\PackingListBundle\Repository\PackingListGroup\PackingListGroupQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private PackingListGroupQueryRepositoryInterface $repository;

    public function __construct(PackingListGroupQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListGroupNotFoundException
     */
    public function criteria(PackingListGroupApiDtoInterface $dto): array
    {
        try {
            $packingList = $this->repository->findByCriteria($dto);
        } catch (PackingListGroupNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupProxyException
     */
    public function proxy(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface
    {
        try {
            if ($dto->hasId()) {
                $packingList = $this->repository->proxy($dto->idToString());
            } else {
                throw new PackingListGroupProxyException('Id value is not set while trying get proxy object');
            }
        } catch (PackingListGroupProxyException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupNotFoundException
     */
    public function get(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface
    {
        try {
            $packingList = $this->repository->find($dto->idToString());
        } catch (PackingListGroupNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }
}
