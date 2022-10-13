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

namespace Evrinoma\PackingListBundle\Factory;

use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Entity\LogisticsGroup\BaseLogisticsGroup;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;

class LogisticsGroupFactory implements LogisticsGroupFactoryInterface
{
    private static string $entityClass = BaseLogisticsGroup::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     */
    public function create(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface
    {
        return new self::$entityClass();
    }
}
