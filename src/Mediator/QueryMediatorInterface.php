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

namespace Evrinoma\PackingListBundle\Mediator;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param QueryBuilder               $builder
     *
     * @return mixed
     */
    public function createQuery(PackingListApiDtoInterface $dto, QueryBuilder $builder): void;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param QueryBuilder               $builder
     *
     * @return array
     */
    public function getResult(PackingListApiDtoInterface $dto, QueryBuilder $builder): array;
}
