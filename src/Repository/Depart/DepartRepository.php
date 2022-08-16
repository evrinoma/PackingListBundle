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
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class DepartRepository extends DepartRepositoryWrapper implements DepartRepositoryInterface, RepositoryWrapperInterface
{
    private QueryMediatorInterface $mediator;

    /**
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(string $entityClass, QueryMediatorInterface $mediator)
    {
        $this->mediator = $mediator;
        $this->entityClass = $entityClass;
    }

    /**
     * @param DepartInterface $listItem
     *
     * @return bool
     *
     * @throws DepartCannotBeSavedException
     * @throws ORMException
     */
    public function save(DepartInterface $listItem): bool
    {
        try {
            $this->persistWrapped($listItem);
        } catch (ORMInvalidArgumentException $e) {
            throw new DepartCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param DepartInterface $listItem
     *
     * @return bool
     */
    public function remove(DepartInterface $listItem): bool
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

        $listItems = $this->mediator->getResult($dto, $builder);

        if (0 === \count($listItems)) {
            throw new DepartNotFoundException('Cannot find depart by findByCriteria');
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
     * @throws DepartNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): DepartInterface
    {
        /** @var DepartInterface $listItem */
        $listItem = $this->findWrapped($id);

        if (null === $listItem) {
            throw new DepartNotFoundException("Cannot find depart with id $id");
        }

        return $listItem;
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
        $listItem = $this->referenceWrapped($id);

        if (!$this->containsWrapped($listItem)) {
            throw new DepartProxyException("Proxy doesn't exist with $id");
        }

        return $listItem;
    }
}
