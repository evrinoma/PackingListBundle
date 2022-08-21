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

use Evrinoma\FetchBundle\Manager\FetchManagerInterface;
use Evrinoma\PackingListBundle\Fetch\Description\Depart\CriteriaDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;

abstract class DepartRepositoryWrapper extends RepositoryWrapper
{
    protected function criteriaWrapped($entity): array
    {
        /** @var FetchManagerInterface $manager */
        $manager = $this->managerRegistry->getManager(FetchManagerInterface::class);
        $handler = $manager->getHandler(BaseHandler::NAME, CriteriaDescription::NAME);
        $rows = $handler->setEntity($entity)->run()->getRaw();

        return $this->managerRegistry->hydrateRowData($rows, $this->entityClass);
    }

    public function persistWrapped($entity): void
    {
    }

    public function removeWrapped($entity): void
    {
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        return null;
    }
}
