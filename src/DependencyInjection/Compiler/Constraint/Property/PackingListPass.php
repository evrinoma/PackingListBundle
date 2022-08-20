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

namespace Evrinoma\PackingListBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\PackingListBundle\Validator\PackingListValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class PackingListPass extends AbstractConstraint implements CompilerPassInterface
{
    public const PACKING_LIST_CONSTRAINT = 'evrinoma.contract.constraint.property.packing_list';

    protected static string $alias = self::PACKING_LIST_CONSTRAINT;
    protected static string $class = PackingListValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
