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

use Evrinoma\PackingListBundle\Validator\LogisticsValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class LogisticsPass extends AbstractConstraint implements CompilerPassInterface
{
    public const LOGISTICS_CONSTRAINT = 'evrinoma.contract.constraint.property.logistics';

    protected static string $alias = self::LOGISTICS_CONSTRAINT;
    protected static string $class = LogisticsValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
