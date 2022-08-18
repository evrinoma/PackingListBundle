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
use Evrinoma\UtilsBundle\Persistence\ManagerRegistry;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class LogisticsRepository extends LogisticsRepositoryWrapper implements LogisticsRepositoryInterface, RepositoryWrapperInterface
{
    private QueryMediatorInterface $mediator;

    /**
     * @param ManagerRegistry        $managerRegistry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $managerRegistry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($managerRegistry);
        $this->mediator = $mediator;
        $this->entityClass = $entityClass;
    }

    /**
     * @param LogisticsInterface $listItem
     *
     * @return bool
     *
     * @throws LogisticsCannotBeSavedException
     * @throws ORMException
     */
    public function save(LogisticsInterface $listItem): bool
    {
        try {
            $this->persistWrapped($listItem);
        } catch (ORMInvalidArgumentException $e) {
            throw new LogisticsCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param LogisticsInterface $listItem
     *
     * @return bool
     */
    public function remove(LogisticsInterface $listItem): bool
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

        $listItems = $this->mediator->getResult($dto, $builder);

        if (0 === \count($listItems)) {
            throw new LogisticsNotFoundException('Cannot find depart by findByCriteria');
        }

        return $listItems;
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
        /** @var LogisticsInterface $listItem */
        $listItem = $this->findWrapped($id);

        if (null === $listItem) {
            throw new LogisticsNotFoundException("Cannot find depart with id $id");
        }

        return $listItem;
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
        $listItem = $this->referenceWrapped($id);

        if (!$this->containsWrapped($listItem)) {
            throw new LogisticsProxyException("Proxy doesn't exist with $id");
        }

        return $listItem;
    }
}
