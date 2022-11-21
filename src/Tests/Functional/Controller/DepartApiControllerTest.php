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

namespace Evrinoma\PackingListBundle\Tests\Functional\Controller;

use Evrinoma\PackingListBundle\Fetch\Description\Depart\CriteriaDescription;
use Evrinoma\PackingListBundle\Fetch\Description\Depart\GetDescription;
use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Functional\Api\AbstractFunctionalTest;
use Psr\Container\ContainerInterface;

/**
 * @group functional
 */
final class DepartApiControllerTest extends AbstractFunctionalTest
{
    protected array $serviceDescriptionName = [GetDescription::class, CriteriaDescription::class];

    protected string $actionServiceName = 'evrinoma.packing_list.test.functional.action.depart';

    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }
}
