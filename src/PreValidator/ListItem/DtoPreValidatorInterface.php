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

namespace Evrinoma\PackingListBundle\PreValidator\ListItem;

use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @throws ListItemInvalidException
     */
    public function onPost(ListItemApiDtoInterface $dto): void;

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @throws ListItemInvalidException
     */
    public function onPut(ListItemApiDtoInterface $dto): void;

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @throws ListItemInvalidException
     */
    public function onDelete(ListItemApiDtoInterface $dto): void;
}
