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

use Evrinoma\PackingListBundle\Validator\GroupValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class GroupPass extends AbstractConstraint implements CompilerPassInterface
{
    public const GROUP_CONSTRAINT = 'evrinoma.packing_list.constraint.property.group';

    protected static string $alias = self::GROUP_CONSTRAINT;
    protected static string $class = GroupValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
