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

namespace Evrinoma\PackingListBundle\Manager\LogisticsGroup;

use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupProxyException;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;
use Evrinoma\PackingListBundle\Repository\LogisticsGroup\LogisticsGroupQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private LogisticsGroupQueryRepositoryInterface $repository;

    public function __construct(LogisticsGroupQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function criteria(LogisticsGroupApiDtoInterface $dto): array
    {
        try {
            $logistics = $this->repository->findByCriteria($dto);
        } catch (LogisticsGroupNotFoundException $e) {
            throw $e;
        }

        return $logistics;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupProxyException
     */
    public function proxy(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface
    {
        try {
            if ($dto->hasGroupApiDto()) {
                $logistics = $this->repository->proxy($dto->getGroupApiDto()->idToString());
            } else {
                throw new LogisticsGroupProxyException('Id value is not set while trying get proxy object');
            }
        } catch (LogisticsGroupProxyException $e) {
            throw $e;
        }

        return $logistics;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function get(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface
    {
        try {
            $logistics = $this->repository->find($dto->getGroupApiDto()->idToString());
        } catch (LogisticsGroupNotFoundException $e) {
            throw $e;
        }

        return $logistics;
    }
}
