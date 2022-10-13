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

class ServicePass extends AbstractRecursivePass
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.depart.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.depart.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.depart.facade');
            $facade->setArgument(3, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.group.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.group.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.group.facade');
            $facade->setArgument(3, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics.facade');
            $facade->setArgument(3, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics_group.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics_group.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics_group.facade');
            $facade->setArgument(3, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list.facade');
            $facade->setArgument(3, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list_group.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list_group.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list_group.facade');
            $facade->setArgument(3, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.list_item.pre.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.list_item.pre.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.list_item.facade');
            $facade->setArgument(3, $preValidator);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list.facade');
            $facade->setArgument(4, $handler);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list_group.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.packing_list_group.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list_group.facade');
            $facade->setArgument(4, $handler);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.list_item.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.list_item.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.list_item.facade');
            $facade->setArgument(4, $handler);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.depart.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.depart.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.depart.facade');
            $facade->setArgument(4, $handler);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.group.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.group.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.group.facade');
            $facade->setArgument(4, $handler);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics.facade');
            $facade->setArgument(4, $handler);
        }

        $serviceHandler = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics_group.handler');
        if ($serviceHandler) {
            $serviceHandler = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.logistics_group.handler');
            $handler = $container->getDefinition($serviceHandler);
            $facade = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics_group.facade');
            $facade->setArgument(4, $handler);
        }
    }
}
