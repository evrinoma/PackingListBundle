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

use Evrinoma\PackingListBundle\Fetch\Description\Logistics\PutDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;

abstract class LogisticsRepositoryWrapper extends RepositoryWrapper
{
    public function persistWrapped($entity): void
    {
        $handler = $this->managerRegistry->getManager(BaseHandler::NAME, PutDescription::NAME);

        $json = $handler->setEntity($entity)->run();
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
