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

namespace Evrinoma\PackingListBundle\Repository\Logistics;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsProxyException;
use Evrinoma\PackingListBundle\Mediator\Logistics\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class LogisticsRepository extends LogisticsRepositoryWrapper implements LogisticsRepositoryInterface, RepositoryWrapperInterface
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
     * @param LogisticsInterface $logistics
     *
     * @return bool
     *
     * @throws LogisticsCannotBeSavedException
     * @throws ORMException
     */
    public function save(LogisticsInterface $logistics): bool
    {
        try {
            $this->persistWrapped($logistics);
        } catch (ORMInvalidArgumentException $e) {
            throw new LogisticsCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param LogisticsInterface $logistics
     *
     * @return bool
     */
    public function remove(LogisticsInterface $logistics): bool
    {
        return true;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsNotFoundException
     */
    public function findByCriteria(LogisticsApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $logistics = $this->mediator->getResult($dto, $builder);

        if (0 === \count($logistics)) {
            throw new LogisticsNotFoundException('Cannot find logistics by findByCriteria');
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
     * @throws LogisticsNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): LogisticsInterface
    {
        /** @var LogisticsInterface $logistics */
        $logistics = $this->findWrapped($id);

        if (null === $logistics) {
            throw new LogisticsNotFoundException("Cannot find logistics with id $id");
        }

        return $logistics;
    }

    /**
     * @param string $id
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsProxyException
     * @throws ORMException
     */
    public function proxy(string $id): LogisticsInterface
    {
        $logistics = $this->referenceWrapped($id);

        if (!$this->containsWrapped($logistics)) {
            throw new LogisticsProxyException("Proxy doesn't exist with $id");
        }

        return $logistics;
    }
}
