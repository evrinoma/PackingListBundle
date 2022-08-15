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

namespace Evrinoma\PackingListBundle\Repository\ListItem;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemProxyException;
use Evrinoma\PackingListBundle\Mediator\ListItem\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;
use Evrinoma\PackingListBundle\Repository\Api\RepositoryWrapper;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class ListItemRepository extends RepositoryWrapper implements ListItemRepositoryInterface, RepositoryWrapperInterface
{
    private QueryMediatorInterface $mediator;
    protected string               $entityClass;

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
     * @param ListItemInterface $listItem
     *
     * @return bool
     *
     * @throws ListItemCannotBeSavedException
     * @throws ORMException
     */
    public function save(ListItemInterface $listItem): bool
    {
        try {
            $this->persistWrapped($listItem);
        } catch (ORMInvalidArgumentException $e) {
            throw new ListItemCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param ListItemInterface $listItem
     *
     * @return bool
     */
    public function remove(ListItemInterface $listItem): bool
    {
        return true;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return array
     *
     * @throws ListItemNotFoundException
     */
    public function findByCriteria(ListItemApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $listItems = $this->mediator->getResult($dto, $builder);

        if (0 === \count($listItems)) {
            throw new ListItemNotFoundException('Cannot find list item by findByCriteria');
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
     * @throws ListItemNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): ListItemInterface
    {
        /** @var ListItemInterface $listItem */
        $listItem = $this->findWrapped($id);

        if (null === $listItem) {
            throw new ListItemNotFoundException("Cannot find list item with id $id");
        }

        return $listItem;
    }

    /**
     * @param string $id
     *
     * @return ListItemInterface
     *
     * @throws ListItemProxyException
     * @throws ORMException
     */
    public function proxy(string $id): ListItemInterface
    {
        $listItem = $this->referenceWrapped($id);

        if (!$this->containsWrapped($listItem)) {
            throw new ListItemProxyException("Proxy doesn't exist with $id");
        }

        return $listItem;
    }
}
