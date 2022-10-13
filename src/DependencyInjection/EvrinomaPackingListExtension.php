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
use Evrinoma\PackingListBundle\Dto\GroupApiDto;
use Evrinoma\PackingListBundle\Dto\ListItemApiDto;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDto;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto;
use Evrinoma\PackingListBundle\Dto\PackingListApiDto;
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto;
use Evrinoma\PackingListBundle\Entity\Depart\BaseDepart;
use Evrinoma\PackingListBundle\Entity\Group\BaseGroup;
use Evrinoma\PackingListBundle\Entity\ListItem\BaseListItem;
use Evrinoma\PackingListBundle\Entity\Logistics\BaseLogistics;
use Evrinoma\PackingListBundle\Entity\LogisticsGroup\BaseLogisticsGroup;
use Evrinoma\PackingListBundle\Entity\PackingList\BasePackingList;
use Evrinoma\PackingListBundle\Entity\PackingListGroup\BasePackingListGroup;
use Evrinoma\PackingListBundle\EvrinomaPackingListBundle;
use Evrinoma\PackingListBundle\Factory\DepartFactory;
use Evrinoma\PackingListBundle\Factory\GroupFactory;
use Evrinoma\PackingListBundle\Factory\ListItemFactory;
use Evrinoma\PackingListBundle\Factory\LogisticsFactory;
use Evrinoma\PackingListBundle\Factory\LogisticsGroupFactory;
use Evrinoma\PackingListBundle\Factory\PackingListFactory;
use Evrinoma\PackingListBundle\Factory\PackingListGroupFactory;
use Evrinoma\UtilsBundle\DependencyInjection\HelperTrait;
use Evrinoma\UtilsBundle\Handler\BaseHandler;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
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
    public const MODEL = 'Evrinoma\PackingListBundle\Model';

    public const ENTITY_FACTORY_PACKING_LIST_GROUP = PackingListGroupFactory::class;
    public const ENTITY_BASE_PACKING_LIST_GROUP = BasePackingListGroup::class;
    public const DTO_BASE_PACKING_LIST_GROUP = PackingListGroupApiDto::class;

    public const ENTITY_FACTORY_PACKING_LIST = PackingListFactory::class;
    public const ENTITY_BASE_PACKING_LIST = BasePackingList::class;
    public const DTO_BASE_PACKING_LIST = PackingListApiDto::class;

    public const ENTITY_FACTORY_LIST_ITEM = ListItemFactory::class;
    public const ENTITY_BASE_LIST_ITEM = BaseListItem::class;
    public const DTO_BASE_LIST_ITEM = ListItemApiDto::class;

    public const ENTITY_FACTORY_DEPART = DepartFactory::class;
    public const ENTITY_BASE_DEPART = BaseDepart::class;
    public const DTO_BASE_DEPART = DepartApiDto::class;

    public const ENTITY_FACTORY_GROUP = GroupFactory::class;
    public const ENTITY_BASE_GROUP = BaseGroup::class;
    public const DTO_BASE_GROUP = GroupApiDto::class;

    public const ENTITY_FACTORY_LOGISTICS = LogisticsFactory::class;
    public const ENTITY_BASE_LOGISTICS = BaseLogistics::class;
    public const DTO_BASE_LOGISTICS = LogisticsApiDto::class;

    public const ENTITY_FACTORY_LOGISTICS_GROUP = LogisticsGroupFactory::class;
    public const ENTITY_BASE_LOGISTICS_GROUP = BaseLogisticsGroup::class;
    public const DTO_BASE_LOGISTICS_GROUP = LogisticsGroupApiDto::class;

    public const HANDLER = BaseHandler::class;

    /**
     * @var array
     */
    private static array $doctrineDrivers = [
        'api' => [],
        'orm' => [
            'registry' => 'doctrine',
            'tag' => 'doctrine.event_subscriber',
        ],
    ];

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ('prod' !== $container->getParameter('kernel.environment')) {
            $loader->load('fixtures.yml');
        }

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

        if (self::ENTITY_FACTORY_PACKING_LIST_GROUP !== $config['factory_packing_list_group']) {
            $this->wireFactory($container, 'packing_list_group', $config['factory_packing_list_group'], $config['entity_packing_list_group']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.packing_list_group.factory');
            $definitionFactory->setArgument(0, $config['entity_packing_list_group']);
        }

        if (self::ENTITY_FACTORY_LIST_ITEM !== $config['factory_list_item']) {
            $this->wireFactory($container, 'list_item', $config['factory_list_item'], $config['entity_list_item']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.list_item.factory');
            $definitionFactory->setArgument(0, $config['entity_list_item']);
        }

        if (self::ENTITY_FACTORY_DEPART !== $config['factory_depart']) {
            $this->wireFactory($container, 'depart', $config['factory_depart'], $config['entity_depart']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.depart.factory');
            $definitionFactory->setArgument(0, $config['entity_depart']);
        }

        if (self::ENTITY_FACTORY_GROUP !== $config['factory_group']) {
            $this->wireFactory($container, 'group', $config['factory_group'], $config['entity_group']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.group.factory');
            $definitionFactory->setArgument(0, $config['entity_group']);
        }

        if (self::ENTITY_FACTORY_LOGISTICS !== $config['factory_logistics']) {
            $this->wireFactory($container, 'logistics', $config['factory_logistics'], $config['entity_logistics']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.logistics.factory');
            $definitionFactory->setArgument(0, $config['entity_logistics']);
        }

        if (self::ENTITY_FACTORY_LOGISTICS_GROUP !== $config['factory_logistics_group']) {
            $this->wireFactory($container, 'logistics_group', $config['factory_logistics_group'], $config['entity_logistics_group']);
        } else {
            $definitionFactory = $container->getDefinition('evrinoma.'.$this->getAlias().'.logistics_group.factory');
            $definitionFactory->setArgument(0, $config['entity_logistics_group']);
        }

        $registry = null;

        if (isset(self::$doctrineDrivers[$config['db_driver']]) && 'api' === $config['db_driver']) {
            $registry = new Reference(ManagerRegistryInterface::class);

            if (true === $config['fetch']['enabled']) {
                $loader->load('api.yml');
                foreach ($config['fetch']['urls'] as $name => $methods) {
                    foreach ($methods as $method => $url) {
                        $this->wireFetch($container, $name, $method, $config['fetch']['host'], $url);
                    }
                }
            }
        }

        if (isset(self::$doctrineDrivers[$config['db_driver']]) && 'orm' === $config['db_driver']) {
            $loader->load('doctrine.yml');
            $container->setAlias('evrinoma.'.$this->getAlias().'.doctrine_registry', new Alias(self::$doctrineDrivers[$config['db_driver']]['registry'], false));
            $registry = new Reference('evrinoma.'.$this->getAlias().'.doctrine_registry');
            $container->setParameter('evrinoma.'.$this->getAlias().'.backend_type_'.$config['db_driver'], true);
            $objectManager = $container->getDefinition('evrinoma.'.$this->getAlias().'.object_manager');
            $objectManager->setFactory([$registry, 'getManager']);
        }

        $this->remapParametersNamespaces(
            $container,
            $config,
            [
                '' => [
                    'db_driver' => 'evrinoma.'.$this->getAlias().'.storage',
                    'entity_packing_list' => 'evrinoma.'.$this->getAlias().'.entity_packing_list',
                    'entity_packing_list_group' => 'evrinoma.'.$this->getAlias().'.entity_packing_list_group',
                    'entity_list_item' => 'evrinoma.'.$this->getAlias().'.entity_list_item',
                    'entity_depart' => 'evrinoma.'.$this->getAlias().'.entity_depart',
                    'entity_group' => 'evrinoma.'.$this->getAlias().'.entity_group',
                    'entity_logistics' => 'evrinoma.'.$this->getAlias().'.entity_logistics',
                    'entity_logistics_group' => 'evrinoma.'.$this->getAlias().'.entity_logistics_group',
                ],
            ]
        );

        if ($registry instanceof Reference && 'api' === $config['db_driver']) {
            $this->wireRepository($container, $registry, 'packing_list', $config['entity_packing_list']);
            $this->wireRepository($container, $registry, 'packing_list_group', $config['entity_packing_list_group']);
            $this->wireRepository($container, $registry, 'list_item', $config['entity_list_item']);
            $this->wireRepository($container, $registry, 'depart', $config['entity_depart']);
            $this->wireRepository($container, $registry, 'group', $config['entity_group']);
            $this->wireRepository($container, $registry, 'logistics', $config['entity_logistics']);
            $this->wireRepository($container, $registry, 'logistics_group', $config['entity_logistics_group']);
        }

        $this->wireController($container, 'packing_list', $config['dto_packing_list']);
        $this->wireController($container, 'packing_list_group', $config['dto_packing_list_group']);
        $this->wireController($container, 'list_item', $config['dto_list_item']);
        $this->wireController($container, 'depart', $config['dto_depart']);
        $this->wireController($container, 'group', $config['dto_group']);
        $this->wireController($container, 'logistics', $config['dto_logistics']);
        $this->wireController($container, 'logistics_group', $config['dto_logistics_group']);

        $this->wireValidator($container, 'packing_list', $config['entity_packing_list']);
        $this->wireValidator($container, 'packing_list_group', $config['entity_packing_list_group']);
        $this->wireValidator($container, 'list_item', $config['entity_list_item']);
        $this->wireValidator($container, 'depart', $config['entity_depart']);
        $this->wireValidator($container, 'group', $config['entity_group']);
        $this->wireValidator($container, 'logistics', $config['entity_logistics']);
        $this->wireValidator($container, 'logistics_group', $config['entity_logistics_group']);

        if ($config['constraints_packing_list']) {
            $loader->load('constraint/packing_list.yml');
        }

        if ($config['constraints_list_item']) {
            $loader->load('constraint/list_item.yml');
        }

        if ($config['constraints_depart']) {
            $loader->load('constraint/depart.yml');
        }

        if ($config['constraints_group']) {
            $loader->load('constraint/group.yml');
        }

        if ($config['constraints_logistics']) {
            $loader->load('constraint/logistics.yml');
        }

        if ($config['constraints_packing_list_group']) {
            $loader->load('constraint/packing_list_group.yml');
        }

        if ($config['constraints_logistics_group']) {
            $loader->load('constraint/logistics_group.yml');
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
                        case 'command_packing_list_group':
                            $remap['command_packing_list_group'] = 'evrinoma.'.$this->getAlias().'.decorates.packing_list_group.command';
                            break;
                        case 'query_packing_list_group':
                            $remap['query_packing_list_group'] = 'evrinoma.'.$this->getAlias().'.decorates.packing_list_group.query';
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
                        case 'command_group':
                            $remap['command_group'] = 'evrinoma.'.$this->getAlias().'.decorates.group.command';
                            break;
                        case 'query_group':
                            $remap['query_group'] = 'evrinoma.'.$this->getAlias().'.decorates.group.query';
                            break;
                        case 'command_logistics':
                            $remap['command_logistics'] = 'evrinoma.'.$this->getAlias().'.decorates.logistics.command';
                            break;
                        case 'query_logistics':
                            $remap['query_logistics'] = 'evrinoma.'.$this->getAlias().'.decorates.logistics.query';
                            break;
                        case 'command_logistics_group':
                            $remap['command_logistics_group'] = 'evrinoma.'.$this->getAlias().'.decorates.logistics_group.command';
                            break;
                        case 'query_logistics_group':
                            $remap['query_logistics_group'] = 'evrinoma.'.$this->getAlias().'.decorates.logistics_group.query';
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
                        case 'pre_validator_packing_list_group':
                            $remap['pre_validator_packing_list_group'] = 'evrinoma.'.$this->getAlias().'.services.packing_list_group.pre.validator';
                            break;
                        case 'pre_validator_depart':
                            $remap['pre_validator_depart'] = 'evrinoma.'.$this->getAlias().'.services.depart.pre.validator';
                            break;
                        case 'pre_validator_group':
                            $remap['pre_validator_group'] = 'evrinoma.'.$this->getAlias().'.services.group.pre.validator';
                            break;
                        case 'pre_validator_logistics':
                            $remap['pre_validator_logistics'] = 'evrinoma.'.$this->getAlias().'.services.logistics.pre.validator';
                            break;
                        case 'pre_validator_logistics_group':
                            $remap['pre_validator_logistics_group'] = 'evrinoma.'.$this->getAlias().'.services.logistics_group.pre.validator';
                            break;

                        case 'handler_packing_list':
                            $remap['handler_packing_list'] = 'evrinoma.'.$this->getAlias().'.services.packing_list.handler';
                            break;
                        case 'handler_list_item':
                            $remap['handler_list_item'] = 'evrinoma.'.$this->getAlias().'.services.list_item.handler';
                            break;
                        case 'handler_packing_list_group':
                            $remap['handler_packing_list_group'] = 'evrinoma.'.$this->getAlias().'.services.packing_list_group.pre.handler';
                            break;
                        case 'handler_depart':
                            $remap['handler_depart'] = 'evrinoma.'.$this->getAlias().'.services.depart.handler';
                            break;
                        case 'handler_group':
                            $remap['handler_group'] = 'evrinoma.'.$this->getAlias().'.services.group.handler';
                            break;
                        case 'handler_logistics':
                            $remap['handler_logistics'] = 'evrinoma.'.$this->getAlias().'.services.logistics.handler';
                            break;
                        case 'handler_logistics_group':
                            $remap['handler_logistics_group'] = 'evrinoma.'.$this->getAlias().'.services.logistics_group.handler';
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

    private function wireFetch(ContainerBuilder $container, string $name, string $method, string $host, string $route): void
    {
        $definitionFetch = $container->getDefinition((string) $container->getAlias('evrinoma.'.$this->getAlias().'.'.$name.'.fetch.'.$method));
        $definitionFetch->setArgument(0, $host);
        $definitionFetch->setArgument(1, $route);
    }

    private function wireRepository(ContainerBuilder $container, Reference $registry, string $name, string $class): void
    {
        $definitionRepository = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.repository');
        $definitionQueryMediator = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.query.mediator');
        $definitionRepository->setArgument(0, $registry);
        $definitionRepository->setArgument(1, $class);
        $definitionRepository->setArgument(2, $definitionQueryMediator);
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
        $definitionApiController->setArgument(4, $class);
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
