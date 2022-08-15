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

namespace Evrinoma\PackingListBundle\Manager\PackingList;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListProxyException;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\PackingListBundle\Repository\PackingList\PackingListQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private PackingListQueryRepositoryInterface $repository;

    public function __construct(PackingListQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListNotFoundException
     */
    public function criteria(PackingListApiDtoInterface $dto): array
    {
        try {
            $packingList = $this->repository->findByCriteria($dto);
        } catch (PackingListNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListProxyException
     */
    public function proxy(PackingListApiDtoInterface $dto): PackingListInterface
    {
        try {
            if ($dto->hasId()) {
                $packingList = $this->repository->proxy($dto->idToString());
            } else {
                throw new PackingListProxyException('Id value is not set while trying get proxy object');
            }
        } catch (PackingListProxyException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListNotFoundException
     */
    public function get(PackingListApiDtoInterface $dto): PackingListInterface
    {
        try {
            $packingList = $this->repository->find($dto->idToString());
        } catch (PackingListNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }
}
