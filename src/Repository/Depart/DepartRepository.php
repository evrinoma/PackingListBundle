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

namespace Evrinoma\PackingListBundle\Repository\Depart;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartNotFoundException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartProxyException;
use Evrinoma\PackingListBundle\Mediator\Depart\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class DepartRepository extends DepartRepositoryWrapper implements DepartRepositoryInterface, RepositoryWrapperInterface
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
     * @param DepartInterface $depart
     *
     * @return bool
     *
     * @throws DepartCannotBeSavedException
     * @throws ORMException
     */
    public function save(DepartInterface $depart): bool
    {
        try {
            $this->persistWrapped($depart);
        } catch (ORMInvalidArgumentException $e) {
            throw new DepartCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param DepartInterface $depart
     *
     * @return bool
     */
    public function remove(DepartInterface $depart): bool
    {
        return true;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return array
     *
     * @throws DepartNotFoundException
     */
    public function findByCriteria(DepartApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $departs = $this->mediator->getResult($dto, $builder);

        if (0 === \count($departs)) {
            throw new DepartNotFoundException('Cannot find depart by findByCriteria');
        }

        return $departs;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws DepartNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): DepartInterface
    {
        /** @var DepartInterface $depart */
        $depart = $this->findWrapped($id);

        if (null === $depart) {
            throw new DepartNotFoundException("Cannot find depart with id $id");
        }

        return $depart;
    }

    /**
     * @param string $id
     *
     * @return DepartInterface
     *
     * @throws DepartProxyException
     * @throws ORMException
     */
    public function proxy(string $id): DepartInterface
    {
        $depart = $this->referenceWrapped($id);

        if (!$this->containsWrapped($depart)) {
            throw new DepartProxyException("Proxy doesn't exist with $id");
        }

        return $depart;
    }
}
