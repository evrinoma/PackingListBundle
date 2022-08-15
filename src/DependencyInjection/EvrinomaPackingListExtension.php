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
    /**
     * @var array
     */
    private static array $doctrineDrivers = [
        'exchange' => [],
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

        $this->remapParametersNamespaces(
            $container,
            $config,
            [
                '' => [
                    'db_driver' => 'evrinoma.'.$this->getAlias().'.storage',
                    'entity' => 'evrinoma.'.$this->getAlias().'.entity_packing_list',
                ],
            ]
        );

        $this->wireRepository($container, 'packing_list', $config['entity_packing_list']);

        $this->wireController($container, 'packing_list', $config['dto_packing_list']);

        $this->wireValidator($container, 'packing_list', $config['entity_packing_list']);

        if ($config['constraints']) {
            $loader->load('validation.yml');
        }

        if ($config['decorates']) {
            $remap = [];
            foreach ($config['decorates'] as $key => $service) {
                if (null !== $service) {
                    switch ($key) {
                        case 'command':
                            $remap['command'] = 'evrinoma.'.$this->getAlias().'.decorates.packing_list.command';
                            break;
                        case 'query':
                            $remap['query'] = 'evrinoma.'.$this->getAlias().'.decorates.packing_list.query';
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

        switch ($name) {
            case 'packing_list':
                $definitionQueryMediator = $container->getDefinition('evrinoma.'.$this->getAlias().'.'.$name.'.query.mediator');
                $definitionRepository->setArgument(1, $definitionQueryMediator);
                // no break
            default:
                $definitionRepository->setArgument(0, $class);
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
