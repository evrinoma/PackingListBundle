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

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Functional\AbstractFunctionalTest;
use Psr\Container\ContainerInterface;

/**
 * @group functional
 */
final class LogisticsGroupApiControllerTest extends AbstractFunctionalTest
{
    protected string $actionServiceName = 'evrinoma.packing_list.test.functional.action.logistics_group';

    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }

    public static function getFixtures(): array
    {
        return [];
    }

    protected function setUpEntityManager($container): void
    {
    }

    protected function setUpSchemaTool(): void
    {
    }

    protected function setUpFixtures($container): void
    {
    }

    protected function purgeSchema(): void
    {
    }
}
