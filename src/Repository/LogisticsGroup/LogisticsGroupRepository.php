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

namespace Evrinoma\PackingListBundle\Repository\LogisticsGroup;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupProxyException;
use Evrinoma\PackingListBundle\Mediator\LogisticsGroup\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class LogisticsGroupRepository extends LogisticsGroupRepositoryWrapper implements LogisticsGroupRepositoryInterface, RepositoryWrapperInterface
{
    private QueryMediatorInterface $mediator;

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

    /**
     * @param LogisticsGroupInterface $logistics
     *
     * @return bool
     *
     * @throws LogisticsGroupCannotBeSavedException
     * @throws ORMException
     */
    public function save(LogisticsGroupInterface $logistics): bool
    {
        try {
            $this->persistWrapped($logistics);
        } catch (ORMInvalidArgumentException $e) {
            throw new LogisticsGroupCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param LogisticsGroupInterface $logistics
     *
     * @return bool
     */
    public function remove(LogisticsGroupInterface $logistics): bool
    {
        return true;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function findByCriteria(LogisticsGroupApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $logistics = $this->mediator->getResult($dto, $builder);

        if (0 === \count($logistics)) {
            throw new LogisticsGroupNotFoundException('Cannot find logistics by findByCriteria');
        }

        return $logistics;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): LogisticsGroupInterface
    {
        /** @var LogisticsGroupInterface $logistics */
        $logistics = $this->findWrapped($id);

        if (null === $logistics) {
            throw new LogisticsGroupNotFoundException("Cannot find logistics with id $id");
        }

        return $logistics;
    }

    /**
     * @param string $id
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupProxyException
     * @throws ORMException
     */
    public function proxy(string $id): LogisticsGroupInterface
    {
        $logistics = $this->referenceWrapped($id);

        if (!$this->containsWrapped($logistics)) {
            throw new LogisticsGroupProxyException("Proxy doesn't exist with $id");
        }

        return $logistics;
    }
}
