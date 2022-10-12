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
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;
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

            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_depart');
            if (false !== strpos($entity, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Depart', '%s/Entity/Depart');
            }
            $this->addResolveTargetEntity([$entity => [DepartInterface::class => []]], false);

            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_list_item');
            if (false !== strpos($entity, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/ListItem', '%s/Entity/ListItem');
            }
            $this->addResolveTargetEntity([$entity => [ListItemInterface::class => []]], false);

            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_packing_list');
            if (false !== strpos($entity, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/PackingList', '%s/Entity/PackingList');
            }
            $this->addResolveTargetEntity([$entity => [PackingListInterface::class => []]], false);

            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_logistics');
            if (false !== strpos($entity, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Logistics', '%s/Entity/Logistics');
            }
            $this->addResolveTargetEntity([$entity => [LogisticsInterface::class => []]], false);

            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_packing_list_group');
            if (false !== strpos($entity, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/PackingListGroup', '%s/Entity/PackingListGroup');
            }
            $this->addResolveTargetEntity([$entity => [PackingListGroupInterface::class => []]], false);
        }
        if ('api' === $container->getParameter('evrinoma.packing_list.storage')) {
            if (!$container->has(MetadataManagerInterface::class)) {
                throw new MetadataManagerNotFoundException();
            }

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $this->cleanMetadata($driver, [EvrinomaPackingListExtension::ENTITY]);
            $this->cleanMetadata($driver, [EvrinomaPackingListExtension::MODEL]);

            $definition = $container->findDefinition(MetadataManagerInterface::class);

            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_depart');
            $definition->addMethodCall('registerEntity', [$entity, DepartInterface::class]);
            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_list_item');
            $definition->addMethodCall('registerEntity', [$entity, ListItemInterface::class]);
            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_packing_list');
            $definition->addMethodCall('registerEntity', [$entity, PackingListInterface::class]);
            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_logistics');
            $definition->addMethodCall('registerEntity', [$entity, LogisticsInterface::class]);
            $entity = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_packing_list_group');
            $definition->addMethodCall('registerEntity', [$entity, PackingListGroupInterface::class]);
        }
    }
}
