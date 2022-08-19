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
        $supportedDrivers = ['api'];

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('db_driver')
            ->validate()
            ->ifNotInArray($supportedDrivers)
            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
            ->end()
            ->cannotBeOverwritten()
            ->defaultValue('api')
            ->end()
            ->scalarNode('factory_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_PACKING_LIST)->end()
            ->scalarNode('entity_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_PACKING_LIST)->end()
            ->scalarNode('factory_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_LIST_ITEM)->end()
            ->scalarNode('entity_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_LIST_ITEM)->end()
            ->scalarNode('factory_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_DEPART)->end()
            ->scalarNode('entity_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_DEPART)->end()
            ->scalarNode('factory_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_LOGISTICS)->end()
            ->scalarNode('entity_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_LOGISTICS)->end()
            ->scalarNode('constraints')->defaultTrue()->info('This option is used for enable/disable basic packing list constraints')->end()
            ->scalarNode('fetch')->defaultTrue()->info('This option is used for enable/disable basic fetch')->end()
            ->scalarNode('dto_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_PACKING_LIST)->info('This option is used for dto class override')->end()
            ->scalarNode('dto_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_LIST_ITEM)->info('This option is used for dto class override')->end()
            ->scalarNode('dto_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_DEPART)->info('This option is used for dto class override')->end()
            ->scalarNode('dto_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_LOGISTICS)->info('This option is used for dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command_packing_list')->defaultNull()->info('This option is used for command packing list decoration')->end()
            ->scalarNode('query_packing_list')->defaultNull()->info('This option is used for query packing list decoration')->end()
            ->scalarNode('command_list_item')->defaultNull()->info('This option is used for command list item decoration')->end()
            ->scalarNode('query_list_item')->defaultNull()->info('This option is used for query list item decoration')->end()
            ->scalarNode('command_depart')->defaultNull()->info('This option is used for command depart decoration')->end()
            ->scalarNode('query_depart')->defaultNull()->info('This option is used for query depart decoration')->end()
            ->scalarNode('command_logistics')->defaultNull()->info('This option is used for command logistics decoration')->end()
            ->scalarNode('query_logistics')->defaultNull()->info('This option is used for query logistics decoration')->end()
            ->end()->end()
            ->arrayNode('services')->addDefaultsIfNotSet()->children()
            ->scalarNode('pre_validator_packing_list')->defaultNull()->info('This option is used for pre_validator_packing_list overriding')->end()
            ->scalarNode('pre_validator_list_item')->defaultNull()->info('This option is used for pre_validator_list_item overriding')->end()
            ->scalarNode('pre_validator_depart')->defaultNull()->info('This option is used for pre_validator_depart overriding')->end()
            ->scalarNode('pre_validator_logistics')->defaultNull()->info('This option is used for pre_validator_logistics overriding')->end()
            ->end()->end()
            ->end();

        return $treeBuilder;
    }
}
