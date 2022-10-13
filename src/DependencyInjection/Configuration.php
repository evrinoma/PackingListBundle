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
            ->scalarNode('factory_packing_list_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_PACKING_LIST_GROUP)->end()
            ->scalarNode('entity_packing_list_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_PACKING_LIST_GROUP)->end()
            ->scalarNode('factory_logistics_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_LOGISTICS_GROUP)->end()
            ->scalarNode('entity_logistics_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_LOGISTICS_GROUP)->end()
            ->scalarNode('factory_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_PACKING_LIST)->end()
            ->scalarNode('entity_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_PACKING_LIST)->end()
            ->scalarNode('factory_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_LIST_ITEM)->end()
            ->scalarNode('entity_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_LIST_ITEM)->end()
            ->scalarNode('factory_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_DEPART)->end()
            ->scalarNode('entity_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_DEPART)->end()
            ->scalarNode('factory_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_LOGISTICS)->end()
            ->scalarNode('entity_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_LOGISTICS)->end()
            ->scalarNode('factory_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_FACTORY_GROUP)->end()
            ->scalarNode('entity_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::ENTITY_BASE_GROUP)->end()
            ->scalarNode('constraints_packing_list_group')->defaultTrue()->info('This option is used to enable/disable basic packing list constraints')->end()
            ->scalarNode('constraints_packing_list')->defaultTrue()->info('This option is used to enable/disable basic packing list constraints')->end()
            ->scalarNode('constraints_list_item')->defaultTrue()->info('This option is used to enable/disable basic list item constraints')->end()
            ->scalarNode('constraints_depart')->defaultTrue()->info('This option is used to enable/disable basic depart list constraints')->end()
            ->scalarNode('constraints_group')->defaultTrue()->info('This option is used to enable/disable basic group list constraints')->end()
            ->scalarNode('constraints_logistics_group')->defaultTrue()->info('This option is used to enable/disable basic logistics group list constraints')->end()
            ->scalarNode('constraints_logistics')->defaultTrue()->info('This option is used to enable/disable basic logistics list constraints')->end()
            ->scalarNode('dto_packing_list_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_PACKING_LIST_GROUP)->info('This option is used to dto class override')->end()
            ->scalarNode('dto_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_PACKING_LIST)->info('This option is used to dto class override')->end()
            ->scalarNode('dto_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_LIST_ITEM)->info('This option is used to dto class override')->end()
            ->scalarNode('dto_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_DEPART)->info('This option is used to dto class override')->end()
            ->scalarNode('dto_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_GROUP)->info('This option is used to dto class override')->end()
            ->scalarNode('dto_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_LOGISTICS)->info('This option is used to dto class override')->end()
            ->scalarNode('dto_logistics_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::DTO_BASE_LOGISTICS_GROUP)->info('This option is used to dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command_packing_list_group')->defaultNull()->info('This option is used to command packing list group decoration')->end()
            ->scalarNode('query_packing_list_group')->defaultNull()->info('This option is used to query packing list group decoration')->end()
            ->scalarNode('command_packing_list')->defaultNull()->info('This option is used to command packing list decoration')->end()
            ->scalarNode('query_packing_list')->defaultNull()->info('This option is used to query packing list decoration')->end()
            ->scalarNode('command_list_item')->defaultNull()->info('This option is used to command list item decoration')->end()
            ->scalarNode('query_list_item')->defaultNull()->info('This option is used to query list item decoration')->end()
            ->scalarNode('command_depart')->defaultNull()->info('This option is used to command depart decoration')->end()
            ->scalarNode('query_depart')->defaultNull()->info('This option is used to query depart decoration')->end()
            ->scalarNode('command_group')->defaultNull()->info('This option is used to command group decoration')->end()
            ->scalarNode('query_group')->defaultNull()->info('This option is used to query group decoration')->end()
            ->scalarNode('command_logistics')->defaultNull()->info('This option is used to command logistics decoration')->end()
            ->scalarNode('query_logistics')->defaultNull()->info('This option is used to query logistics decoration')->end()
            ->scalarNode('command_logistics_group')->defaultNull()->info('This option is used to command logistics group decoration')->end()
            ->scalarNode('query_logistics_group')->defaultNull()->info('This option is used to query logistics group decoration')->end()
            ->end()->end()
            ->arrayNode('services')->addDefaultsIfNotSet()->children()
            ->scalarNode('pre_validator_packing_list')->defaultNull()->info('This option is used to pre_validator_packing_list overriding')->end()
            ->scalarNode('pre_validator_packing_list_group')->defaultNull()->info('This option is used to pre_validator_packing_list_group overriding')->end()
            ->scalarNode('pre_validator_list_item')->defaultNull()->info('This option is used to pre_validator_list_item overriding')->end()
            ->scalarNode('pre_validator_depart')->defaultNull()->info('This option is used to pre_validator_depart overriding')->end()
            ->scalarNode('pre_validator_group')->defaultNull()->info('This option is used to pre_validator_group overriding')->end()
            ->scalarNode('pre_validator_logistics')->defaultNull()->info('This option is used to pre_validator_logistics overriding')->end()
            ->scalarNode('pre_validator_logistics_group')->defaultNull()->info('This option is used to pre_validator_logistics_group overriding')->end()
            ->scalarNode('handler_packing_list')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler packing list override')->end()
            ->scalarNode('handler_packing_list_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler packing list group override')->end()
            ->scalarNode('handler_list_item')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler list item override')->end()
            ->scalarNode('handler_depart')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler depart override')->end()
            ->scalarNode('handler_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler group override')->end()
            ->scalarNode('handler_logistics')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler logistics override')->end()
            ->scalarNode('handler_logistics_group')->cannotBeEmpty()->defaultValue(EvrinomaPackingListExtension::HANDLER)->info('This option is used to handler logistics group override')->end()
            ->end()->end()
                ->arrayNode('fetch')
                ->beforeNormalization()
                ->ifString()
                ->then(function ($v) {
                    if (!('enabled' !== $v ^ 'disabled' !== $v)) {
                        throw new \InvalidArgumentException(sprintf('"enabled/disabled" Option is missing  [%s]', $v));
                    }

                    return [
                        'enabled' => 'enabled' === $v,
                    ];
                })
                ->end()
                ->canBeDisabled()
                ->children()
                    ->scalarNode('host')->defaultValue('http://cmp.ite-ng.ru')->end()
                    ->arrayNode('urls')->addDefaultsIfNotSet()->children()
                        ->arrayNode('depart')->addDefaultsIfNotSet()->children()
                        ->scalarNode('criteria')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/departs')->end()
                        ->scalarNode('get')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/depart')->end()
                        ->end()->end()
                        ->arrayNode('group')->addDefaultsIfNotSet()->children()
                        ->scalarNode('criteria')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/group/infos')->end()
                        ->end()->end()
                        ->arrayNode('list_item')->addDefaultsIfNotSet()->children()
                        ->scalarNode('criteria')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/items')->end()
                        ->scalarNode('get')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/item')->end()
                        ->end()->end()
                        ->arrayNode('logistics')->addDefaultsIfNotSet()->children()
                        ->scalarNode('post')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/logistics')->end()
                        ->end()->end()
                        ->arrayNode('logistics_group')->addDefaultsIfNotSet()->children()
                        ->scalarNode('post')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/logistics/group')->end()
                        ->end()->end()
                        ->arrayNode('packing_list')->addDefaultsIfNotSet()->children()
                        ->scalarNode('criteria')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_lists')->end()
                        ->scalarNode('get')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list')->end()
                        ->end()->end()
                        ->arrayNode('packing_list_group')->addDefaultsIfNotSet()->children()
                        ->scalarNode('criteria')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/groups')->end()
                        ->scalarNode('get')->isRequired()->cannotBeEmpty()->defaultValue('/api/packing_list/group')->end()
                        ->end()->end()
                    ->end()->end()
                ->end()
                ->end()

            ->end()
            ->end();

        return $treeBuilder;
    }
}
