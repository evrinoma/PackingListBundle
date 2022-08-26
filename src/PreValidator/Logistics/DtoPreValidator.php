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
        $this->checkDepart($dto);
        $this->checkPackingList($dto);
        $this->checkUser($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this->checkDepart($dto);
        $this->checkPackingList($dto);
        $this->checkUser($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkDepart($dto);
        $this->checkPackingList($dto);
        $this->checkUser($dto);
    }

    private function checkUser(DtoInterface $dto): void
    {
        /** @var LogisticsApiDtoInterface $dto */
        if (!$dto->hasUserApiDto()) {
            throw new ListItemInvalidException('The Dto has\'t User');
        }
    }

    private function checkDepart(DtoInterface $dto): void
    {
        /** @var LogisticsApiDtoInterface $dto */
        if (!$dto->hasDepartApiDto()) {
            throw new ListItemInvalidException('The Dto has\'t Depart');
        }
    }

    private function checkPackingList(DtoInterface $dto): void
    {
        /** @var LogisticsApiDtoInterface $dto */
        if (!$dto->hasPackingListApiDto()) {
            throw new ListItemInvalidException('The Dto has\'t PackingList');
        }
    }
}
