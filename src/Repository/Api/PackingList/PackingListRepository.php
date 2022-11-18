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

namespace Evrinoma\PackingListBundle\Repository\Api\PackingList;

use Evrinoma\PackingListBundle\Mediator\PackingList\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Repository\PackingList\PackingListRepositoryInterface;
use Evrinoma\PackingListBundle\Repository\PackingList\PackingListRepositoryTrait;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class PackingListRepository extends PackingListRepositoryWrapper implements PackingListRepositoryInterface, RepositoryWrapperInterface
{
    use PackingListRepositoryTrait;

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
