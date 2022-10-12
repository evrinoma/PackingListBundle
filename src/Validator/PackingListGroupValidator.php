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

namespace Evrinoma\PackingListBundle\Validator;

use Evrinoma\PackingListBundle\Entity\PackingList\BasePackingList;
use Evrinoma\PackingListBundle\Entity\PackingListGroup\BasePackingListGroup;
use Evrinoma\UtilsBundle\Validator\AbstractValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class PackingListGroupValidator extends AbstractValidator
{
    /**
     * @var string|null
     */
    protected static ?string $entityClass = BasePackingListGroup::class;

    /**
     * @param ValidatorInterface $validator
     * @param string             $entityClass
     */
    public function __construct(ValidatorInterface $validator, string $entityClass)
    {
        parent::__construct($validator, $entityClass);
    }
}
