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

namespace Evrinoma\PackingListBundle;

use Evrinoma\PackingListBundle\DependencyInjection\Compiler\Constraint\Property\DepartPass as PropertyDepartPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\Constraint\Property\ListItemPass as PropertyListItemPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\Constraint\Property\LogisticsPass as PropertyLogisticsPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\Constraint\Property\PackingListPass as PropertyPackingListPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\Constraint\Property\PackingListGroupPass as PropertyPackingListGroupPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\PackingListBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\PackingListBundle\DependencyInjection\EvrinomaPackingListExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaPackingListBundle extends Bundle
{
    public const BUNDLE = 'packing_list';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new PropertyDepartPass())
            ->addCompilerPass(new PropertyListItemPass())
            ->addCompilerPass(new PropertyLogisticsPass())
            ->addCompilerPass(new PropertyPackingListPass())
            ->addCompilerPass(new PropertyPackingListGroupPass())
            ->addCompilerPass(new ServicePass());
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaPackingListExtension();
        }

        return $this->extension;
    }
}
