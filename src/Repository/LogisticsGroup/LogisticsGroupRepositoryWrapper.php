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

use Evrinoma\FetchBundle\Manager\FetchManagerInterface;
use Evrinoma\PackingListBundle\Fetch\Description\LogisticsGroup\PostDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BasePostHandler;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;

abstract class LogisticsGroupRepositoryWrapper extends RepositoryWrapper
{
    public function persistWrapped($entity): void
    {
        /** @var FetchManagerInterface $manager */
        $manager = $this->managerRegistry->getManager(FetchManagerInterface::class);
        $handler = $manager->getHandler(BasePostHandler::NAME, PostDescription::NAME);

        $handler->setEntity($entity)->run();
    }

    public function removeWrapped($entity): void
    {
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        return null;
    }

    protected function criteriaWrapped($entity): array
    {
        return [];
    }
}
