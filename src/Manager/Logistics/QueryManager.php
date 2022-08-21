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

namespace Evrinoma\PackingListBundle\Manager\Logistics;

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsProxyException;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\PackingListBundle\Repository\Logistics\LogisticsQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private LogisticsQueryRepositoryInterface $repository;

    public function __construct(LogisticsQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsNotFoundException
     */
    public function criteria(LogisticsApiDtoInterface $dto): array
    {
        try {
            $logistics = $this->repository->findByCriteria($dto);
        } catch (LogisticsNotFoundException $e) {
            throw $e;
        }

        return $logistics;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsProxyException
     */
    public function proxy(LogisticsApiDtoInterface $dto): LogisticsInterface
    {
        try {
            if ($dto->hasPackingListId()) {
                $logistics = $this->repository->proxy($dto->getPackingListId());
            } else {
                throw new LogisticsProxyException('Id value is not set while trying get proxy object');
            }
        } catch (LogisticsProxyException $e) {
            throw $e;
        }

        return $logistics;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsNotFoundException
     */
    public function get(LogisticsApiDtoInterface $dto): LogisticsInterface
    {
        try {
            $logistics = $this->repository->find($dto->getPackingListId());
        } catch (LogisticsNotFoundException $e) {
            throw $e;
        }

        return $logistics;
    }
}
