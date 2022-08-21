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

use Evrinoma\PackingListBundle\DependencyInjection\EvrinomaPackingListExtension;
use Evrinoma\PackingListBundle\EvrinomaPackingListBundle;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Evrinoma\UtilsBundle\Exception\MetadataManagerNotFoundException;
use Evrinoma\UtilsBundle\Mapping\MetadataManagerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ('orm' === $container->getParameter('evrinoma.packing_list.storage')) {
            $this->setContainer($container);

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $referenceAnnotationReader = new Reference('annotations.reader');

            $this->cleanMetadata($driver, [EvrinomaPackingListExtension::ENTITY]);

            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_depart');
            if (false !== strpos($entityContract, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Depart', '%s/Entity/Depart');
            }
            $this->addResolveTargetEntity([$entityContract => [DepartInterface::class => []]], false);

            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_list_item');
            if (false !== strpos($entityContract, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/ListItem', '%s/Entity/ListItem');
            }
            $this->addResolveTargetEntity([$entityContract => [ListItemInterface::class => []]], false);

            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_packing_list');
            if (false !== strpos($entityContract, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/PackingListId', '%s/Entity/PackingListId');
            }
            $this->addResolveTargetEntity([$entityContract => [PackingListInterface::class => []]], false);

            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_logistics');
            if (false !== strpos($entityContract, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Logistics', '%s/Entity/Logistics');
            }
            $this->addResolveTargetEntity([$entityContract => [LogisticsInterface::class => []]], false);
        }
        if ('api' === $container->getParameter('evrinoma.packing_list.storage')) {
            if (!$container->has(MetadataManagerInterface::class)) {
                throw new MetadataManagerNotFoundException();
            }

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $this->cleanMetadata($driver, [EvrinomaPackingListExtension::ENTITY]);
            $this->cleanMetadata($driver, [EvrinomaPackingListExtension::MODEL]);

            $definition = $container->findDefinition(MetadataManagerInterface::class);

            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_depart');
            $definition->addMethodCall('registerEntity', [$entityContract, DepartInterface::class]);
            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_list_item');
            $definition->addMethodCall('registerEntity', [$entityContract, ListItemInterface::class]);
            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_packing_list');
            $definition->addMethodCall('registerEntity', [$entityContract, PackingListInterface::class]);
            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_logistics');
            $definition->addMethodCall('registerEntity', [$entityContract, LogisticsInterface::class]);
        }
    }
}
