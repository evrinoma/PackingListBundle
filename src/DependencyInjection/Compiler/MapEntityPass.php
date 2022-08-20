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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListIdInterface;
use Evrinoma\PackingListBundle\EvrinomaPackingListBundle;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
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
            $this->addResolveTargetEntity([$entityContract => [PackingListIdInterface::class => []]], false);

            $entityContract = $container->getParameter('evrinoma.'.EvrinomaPackingListBundle::BUNDLE.'.entity_logistics');
            if (false !== strpos($entityContract, EvrinomaPackingListExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Logistics', '%s/Entity/Logistics');
            }
            $this->addResolveTargetEntity([$entityContract => [LogisticsInterface::class => []]], false);
        }
    }
}
