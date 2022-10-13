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

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Entity\Logistics\BaseLogistics;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;

class LogisticsFactory implements LogisticsFactoryInterface
{
    private static string $entityClass = BaseLogistics::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     */
    public function create(LogisticsApiDtoInterface $dto): LogisticsInterface
    {
        return new self::$entityClass();
    }
}
