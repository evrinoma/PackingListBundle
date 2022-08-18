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

namespace Evrinoma\PackingListBundle\Repository\PackingList;

use Evrinoma\PackingListBundle\Fetch\Description\PackingList\CriteriaDescription;
use Evrinoma\PackingListBundle\Fetch\Description\PackingList\GetDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;

abstract class PackingListRepositoryWrapper extends RepositoryWrapper
{
    public function persistWrapped($entity): void
    {
    }

    public function removeWrapped($entity): void
    {
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        $handler = $this->managerRegistry->getManager(BaseHandler::NAME, GetDescription::NAME);

        $handler->run();

        return $handler->getRaw();
    }

    protected function criteriaWrapped($dto): array
    {
        $handler = $this->managerRegistry->getManager(BaseHandler::NAME, CriteriaDescription::NAME);

        $handler->setDto($dto)->run();

        return $handler->getRaw();
    }
}
