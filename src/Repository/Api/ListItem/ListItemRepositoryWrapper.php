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

namespace Evrinoma\PackingListBundle\Repository\Api\ListItem;

use Evrinoma\FetchBundle\Manager\FetchManagerInterface;
use Evrinoma\PackingListBundle\Fetch\Description\ListItem\CriteriaDescription;
use Evrinoma\PackingListBundle\Fetch\Description\ListItem\GetDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseGetHandler;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;

abstract class ListItemRepositoryWrapper extends RepositoryWrapper
{
    public function persistWrapped($entity): void
    {
    }

    public function removeWrapped($entity): void
    {
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        /** @var FetchManagerInterface $manager */
        $manager = $this->managerRegistry->getManager(FetchManagerInterface::class);
        $handler = $manager->getHandler(BaseGetHandler::NAME, GetDescription::NAME);

        $rows[] = $handler->setEntity($id)->run()->getRaw();
        $entities = $this->managerRegistry->hydrateRowData($rows, $this->entityClass);

        return (0 === \count($entities)) ? null : $entities[0];
    }

    protected function criteriaWrapped($entity): array
    {
        /** @var FetchManagerInterface $manager */
        $manager = $this->managerRegistry->getManager(FetchManagerInterface::class);
        $handler = $manager->getHandler(BaseGetHandler::NAME, CriteriaDescription::NAME);

        $rows = $handler->setEntity($entity)->run()->getRaw();

        return $this->managerRegistry->hydrateRowData($rows, $this->entityClass);
    }
}
