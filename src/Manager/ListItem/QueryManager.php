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

namespace Evrinoma\PackingListBundle\Manager\ListItem;

use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemProxyException;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;
use Evrinoma\PackingListBundle\Repository\ListItem\ListItemQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private ListItemQueryRepositoryInterface $repository;

    public function __construct(ListItemQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return array
     *
     * @throws ListItemNotFoundException
     */
    public function criteria(ListItemApiDtoInterface $dto): array
    {
        try {
            $packingList = $this->repository->findByCriteria($dto);
        } catch (ListItemNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemProxyException
     */
    public function proxy(ListItemApiDtoInterface $dto): ListItemInterface
    {
        try {
            if ($dto->hasId()) {
                $packingList = $this->repository->proxy($dto->idToString());
            } else {
                throw new ListItemProxyException('Id value is not set while trying get proxy object');
            }
        } catch (ListItemProxyException $e) {
            throw $e;
        }

        return $packingList;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemNotFoundException
     */
    public function get(ListItemApiDtoInterface $dto): ListItemInterface
    {
        try {
            $packingList = $this->repository->find($dto->idToString());
        } catch (ListItemNotFoundException $e) {
            throw $e;
        }

        return $packingList;
    }
}
