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

namespace Evrinoma\PackingListBundle\Repository\Api\LogisticsGroup;

use Evrinoma\PackingListBundle\Mediator\LogisticsGroup\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Repository\LogisticsGroup\LogisticsGroupRepositoryInterface;
use Evrinoma\PackingListBundle\Repository\LogisticsGroup\LogisticsGroupRepositoryTrait;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class LogisticsGroupRepository extends LogisticsGroupRepositoryWrapper implements LogisticsGroupRepositoryInterface, RepositoryWrapperInterface
{
    use LogisticsGroupRepositoryTrait;

    /**
     * @param ManagerRegistryInterface $managerRegistry
     * @param string                   $entityClass
     * @param QueryMediatorInterface   $mediator
     */
    public function __construct(ManagerRegistryInterface $managerRegistry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($managerRegistry);
        $this->mediator = $mediator;
        $this->entityClass = $entityClass;
    }
}
