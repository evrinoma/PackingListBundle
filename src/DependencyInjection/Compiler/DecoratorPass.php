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

namespace Evrinoma\PackingListBundle\DependencyInjection\Compiler;

use Evrinoma\PackingListBundle\EvrinomaPackingListBundle;
use Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DecoratorPass extends AbstractRecursivePass
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $decoratorQuery = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.depart.query');
        if ($decoratorQuery) {
            $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.depart.query');
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.depart.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.depart.command');
        if ($decoratorCommand) {
            $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.depart.command');
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.depart.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }

        $decoratorQuery = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.list_item.query');
        if ($decoratorQuery) {
            $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.list_item.query');
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.list_item.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.list_item.command');
        if ($decoratorCommand) {
            $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.list_item.command');
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.list_item.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }

        $decoratorQuery = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.logistics.query');
        if ($decoratorQuery) {
            $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.logistics.query');
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.logistics.command');
        if ($decoratorCommand) {
            $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.logistics.command');
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }

        $decoratorQuery = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list.query');
        if ($decoratorQuery) {
            $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list.query');
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list.command');
        if ($decoratorCommand) {
            $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list.command');
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }

        $decoratorQuery = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list_group.query');
        if ($decoratorQuery) {
            $decoratorQuery = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list_group.query');
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list_group.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list_group.command');
        if ($decoratorCommand) {
            $decoratorCommand = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.decorates.packing_list_group.command');
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list_group.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }
    }
}
