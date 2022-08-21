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

namespace Evrinoma\PackingListBundle\PreValidator\Logistics;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
    }

    public function onPut(DtoInterface $dto): void
    {
        $this->checkIdDepart($dto);
        $this->checkPackingListId($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkIdDepart($dto);
        $this->checkPackingListId($dto);
    }

    private function checkIdDepart(DtoInterface $dto): void
    {
        /** @var LogisticsApiDtoInterface $dto */
        if (!$dto->hasIdDepart()) {
            throw new ListItemInvalidException('The Dto has\'t IdDepart or class invalid');
        }
    }

    private function checkPackingListId(DtoInterface $dto): void
    {
        /** @var LogisticsApiDtoInterface $dto */
        if (!$dto->hasPackingListId()) {
            throw new ListItemInvalidException('The Dto has\'t PackingListId or class invalid');
        }
    }
}
