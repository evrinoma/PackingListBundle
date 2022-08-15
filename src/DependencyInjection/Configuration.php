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

namespace Evrinoma\PackingListBundle\DependencyInjection;

use Evrinoma\PackingListBundle\EvrinomaPackingListBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaPackingListBundle::BUNDLE);
        $rootNode = $treeBuilder->getRootNode();
        $supportedDrivers = ['exchange'];

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('db_driver')
            ->validate()
            ->ifNotInArray($supportedDrivers)
            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
            ->end()
            ->cannotBeOverwritten()
            ->defaultValue('exchange')
            ->end()
            ->scalarNode('factory_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_PACKING_LIST)->end()
            ->scalarNode('entity_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_PACKING_LIST)->end()
            ->scalarNode('constraints')->defaultTrue()->info('This option is used for enable/disable basic packing list constraints')->end()
            ->scalarNode('dto_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_PACKING_LIST)->info('This option is used for dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command')->defaultNull()->info('This option is used for command packing list decoration')->end()
            ->scalarNode('query')->defaultNull()->info('This option is used for query packing list decoration')->end()
            ->end()->end()
            ->arrayNode('services')->addDefaultsIfNotSet()->children()
            ->scalarNode('pre_validator')->defaultNull()->info('This option is used for pre_validator overriding')->end()
            ->end()->end()
            ->end();

        return $treeBuilder;
    }
}
