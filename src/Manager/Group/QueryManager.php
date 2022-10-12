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

namespace Evrinoma\PackingListBundle\Manager\Group;

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\Group\GroupProxyException;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;
use Evrinoma\PackingListBundle\Repository\Group\GroupQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private GroupQueryRepositoryInterface $repository;

    public function __construct(GroupQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws GroupNotFoundException
     */
    public function criteria(GroupApiDtoInterface $dto): array
    {
        try {
            $group = $this->repository->findByCriteria($dto);
        } catch (GroupNotFoundException $e) {
            throw $e;
        }

        return $group;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     *
     * @throws GroupProxyException
     */
    public function proxy(GroupApiDtoInterface $dto): GroupInterface
    {
        try {
            if ($dto->hasId()) {
                $group = $this->repository->proxy($dto->idToString());
            } else {
                throw new GroupProxyException('Id value is not set while trying get proxy object');
            }
        } catch (GroupProxyException $e) {
            throw $e;
        }

        return $group;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     *
     * @throws GroupNotFoundException
     */
    public function get(GroupApiDtoInterface $dto): GroupInterface
    {
        try {
            $group = $this->repository->find($dto->idToString());
        } catch (GroupNotFoundException $e) {
            throw $e;
        }

        return $group;
    }
}
