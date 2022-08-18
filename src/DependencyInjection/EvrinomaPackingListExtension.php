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

use Evrinoma\PackingListBundle\Dto\DepartApiDto;
use Evrinoma\PackingListBundle\Dto\ListItemApiDto;
use Evrinoma\PackingListBundle\Dto\PackingListApiDto;
use Evrinoma\PackingListBundle\EvrinomaPackingListBundle;
use Evrinoma\UtilsBundle\DependencyInjection\HelperTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class EvrinomaPackingListExtension extends Extension
{
    use HelperTrait;

    public const ENTITY = 'Evrinoma\PackingListBundle\Entity';
    public const ENTITY_FACTORY_PACKING_LIST = 'Evrinoma\PackingListBundle\Factory\PackingListFactory';
    public const ENTITY_BASE_PACKING_LIST = self::ENTITY.'\PackingList\BasePackingList';
    public const DTO_BASE_PACKING_LIST = PackingListApiDto::class;

    public const ENTITY_FACTORY_LIST_ITEM = 'Evrinoma\PackingListBundle\Factory\ListItemFactory';
    public const ENTITY_BASE_LIST_ITEM = self::ENTITY.'\ListItem\BaseListItem';
    public const DTO_BASE_LIST_ITEM = ListItemApiDto::class;

    public const ENTITY_FACTORY_DEPART = 'Evrinoma\PackingListBundle\Factory\DepartFactory';
    public const ENTITY_BASE_DEPART = self::ENTITY.'\Depart\BaseDepart';
    public const DTO_BASE_DEPART = DepartApiDto::class;

    public const ENTITY_FACTORY_LOGISTICS = 'Evrinoma\PackingListBundle\Factory\LogisticsFactory';
    public const ENTITY_BASE_LOGISTICS = self::ENTITY.'\Logistics\BaseLogistics';
    public const DTO_BASE_LOGISTICS = DepartApiDto::class;
    /**
     * @var array
     */
    private static array $doctrineDrivers = [
        'api' => [],
    ];

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ('test' === $container->getParameter('kernel.environment')) {
            $loader->load('tests.yml');
        }

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        if (self::ENTITY_FACTORY_PACKING_LIST !== $config['factory_packing_list']) {
            $this->wireFactory($container, 'packing_list', $config['factory_packing_list'], $config['entity_packing_list']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.packing_list.factory');
            $definitionFactory->setArgument(0, $config['entity_packing_list']);
        }

        if (self::ENTITY_FACTORY_PACKING_LIST !== $config['factory_list_item']) {
            $this->wireFactory($container, 'list_item', $config['factory_list_item'], $config['entity_list_item']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.list_item.factory');
            $definitionFactory->setArgument(0, $config['entity_list_item']);
        }

        if (self::ENTITY_FACTORY_PACKING_LIST !== $config['factory_depart']) {
            $this->wireFactory($container, 'depart', $config['factory_depart'], $config['entity_depart']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.depart.factory');
            $definitionFactory->setArgument(0, $config['entity_depart']);
        }

        if (self::ENTITY_FACTORY_PACKING_LIST !== $config['factory_logistics']) {
            $this->wireFactory($container, 'logistics', $config['factory_logistics'], $config['entity_logistics']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.logistics.factory');
            $definitionFactory->setArgument(0, $config['entity_logistics']);
        }

        $this->remapParametersNamespaces(
            $container,
            $config,
            [
                '' => [
                    'db_driver' => 'evrinoma.'.$this->getAlias().'.storage',
                    'entity_packing_list' => 'evrinoma.'.$this->getAlias().'.entity_packing_list',
                    'entity_list_item' => 'evrinoma.'.$this->getAlias().'.entity_list_item',
                    'entity_depart' => 'evrinoma.'.$this->getAlias().'.entity_depart',
                    'entity_logistics' => 'evrinoma.'.$this->getAlias().'.entity_logistics',
                ],
            ]
        );

        $this->wireRepository($container, 'packing_list', $config['entity_packing_list']);

        $this->wireController($container, 'packing_list', $config['dto_packing_list']);

        $this->wireValidator($container, 'packing_list', $config['entity_packing_list']);

        $this->wireRepository($container, 'list_item', $config['entity_list_item']);

        $this->wireController($container, 'list_item', $config['dto_list_item']);

        $this->wireValidator($container, 'list_item', $config['entity_list_item']);

        $this->wireRepository($container, 'depart', $config['entity_depart']);

        $this->wireController($container, 'depart', $config['dto_depart']);

        $this->wireValidator($container, 'depart', $config['entity_depart']);

        $this->wireRepository($container, 'logistics', $config['entity_logistics']);

        $this->wireController($container, 'logistics', $config['dto_logistics']);

        $this->wireValidator($container, 'logistics', $config['entity_logistics']);

        if ($config['constraints']) {
            $loader->load('validation.yml');
        }

        if ($config['decorates']) {
            $remap = [];
            foreach ($config['decorates'] as $key => $service) {
                if (null !== $service) {
                    switch ($key) {
                        case 'command_packing_list':
                            $remap['command_packing_list'] = 'evrinoma.'.$this->getAlias().'.decorates.packing_list.command';
                            break;
                        case 'query_packing_list':
                            $remap['query_packing_list'] = 'evrinoma.'.$this->getAlias().'.decorates.packing_list.query';
                            break;
                        case 'command_list_item':
                            $remap['command_list_item'] = 'evrinoma.'.$this->getAlias().'.decorates.list_item.command';
                            break;
                        case 'query_list_item':
                            $remap['query_list_item'] = 'evrinoma.'.$this->getAlias().'.decorates.list_item.query';
                            break;
                        case 'command_depart':
                            $remap['command_depart'] = 'evrinoma.'.$this->getAlias().'.decorates.depart.command';
                            break;
                        case 'query_depart':
                            $remap['query_depart'] = 'evrinoma.'.$this->getAlias().'.decorates.depart.query';
                            break;
                        case 'command_logistics':
                            $remap['command_logistics'] = 'evrinoma.'.$this->getAlias().'.decorates.logistics.command';
                            break;
                        case 'query_logistics':
                            $remap['query_logistics'] = 'evrinoma.'.$this->getAlias().'.decorates.logistics.query';
                            break;
                    }
                }
            }

            $this->remapParametersNamespaces(
                $container,
                $config['decorates'],
                ['' => $remap]
            );
        }

        if ($config['services']) {
            $remap = [];
            foreach ($config['services'] as $key => $service) {
                if (null !== $service) {
                    switch ($key) {
                        case 'pre_validator_packing_list':
                            $remap['pre_validator_packing_list'] = 'evrinoma.'.$this->getAlias().'.services.packing_list.pre.validator';
                            break;
                        case 'pre_validator_list_item':
                            $remap['pre_validator_list_item'] = 'evrinoma.'.$this->getAlias().'.services.list_item.pre.validator';
                            break;
                        case 'pre_validator_depart':
                            $remap['pre_validator_depart'] = 'evrinoma.'.$this->getAlias().'.services.depart.pre.validator';
                            break;
                        case 'pre_validator_logistics':
                            $remap['pre_validator_logistics'] = 'evrinoma.'.$this->getAlias().'.services.logistics.pre.validator';
                            break;
                    }
                }
            }

            $this->remapParametersNamespaces(
                $container,
                $config['services'],
                ['' => $remap]
            );
        }
    }

    private function wireRepository(ContainerBuilder $container, string $name, string $class): void
    {
        $definitionRepository = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.repository');

        $definition = $container->getDefinition('evrinoma.packing_list.persistence');

        switch ($name) {
            case 'packing_list':
            case 'list_item':
            case 'depart':
                $definitionQueryMediator = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.query.mediator');
                $definitionRepository->setArgument(2, $definitionQueryMediator);
                // no break
            default:
                $definitionRepository->setArgument(1, $class);
                $definitionRepository->setArgument(0, $definition);
        }
        $array = $definitionRepository->getArguments();
        ksort($array);
        $definitionRepository->setArguments($array);
    }

    private function wireFactory(ContainerBuilder $container, string $name, string $class, string $paramClass): void
    {
        $container->removeDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.factory');
        $definitionFactory = new Definition($class);
        $definitionFactory->addArgument($paramClass);
        $alias = new Alias('evrinoma.'.$this->getAlias().'.'.$name.'.factory');
        $container->addDefinitions(['evrinoma.'.$this->getAlias().'.'.$name.'.factory' => $definitionFactory]);
        $container->addAliases([$class => $alias]);
    }

    private function wireController(ContainerBuilder $container, string $name, string $class): void
    {
        $definitionApiController = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.api.controller');
        $definitionApiController->setArgument(6, $class);
    }

    private function wireValidator(ContainerBuilder $container, string $name, string $class): void
    {
        $definitionApiController = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.validator');
        $definitionApiController->setArgument(0, new Reference('validator'));
        $definitionApiController->setArgument(1, $class);
    }

    public function getAlias()
    {
        return EvrinomaPackingListBundle::BUNDLE;
    }
}
