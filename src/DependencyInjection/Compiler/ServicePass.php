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
        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.depart.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.depart.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $apiController = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.depart.api.controller');
            $apiController->setArgument(5, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.logistics.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.logistics.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $apiController = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.logistics.api.controller');
            $apiController->setArgument(5, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.packing_list.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.packing_list.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $apiController = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.packing_list.api.controller');
            $apiController->setArgument(5, $preValidator);
        }

        $servicePreValidator = $container->hasParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.list_item.validator');
        if ($servicePreValidator) {
            $servicePreValidator = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.services.pre.list_item.validator');
            $preValidator = $container->getDefinition($servicePreValidator);
            $apiController = $container->getDefinition('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.list_item.api.controller');
            $apiController->setArgument(5, $preValidator);
        }
    }
}
