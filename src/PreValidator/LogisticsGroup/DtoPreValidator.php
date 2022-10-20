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

namespace Evrinoma\PackingListBundle\PreValidator\LogisticsGroup;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this->checkDepart($dto);
        $this->checkGroup($dto);
        $this->checkUser($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this->checkDepart($dto);
        $this->checkGroup($dto);
        $this->checkUser($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkDepart($dto);
        $this->checkGroup($dto);
        $this->checkUser($dto);
    }

    private function checkUser(DtoInterface $dto): void
    {
        /** @var LogisticsGroupApiDtoInterface $dto */
        if (!$dto->hasUserApiDto()) {
            throw new LogisticsGroupInvalidException('The Dto has\'t User');
        }
    }

    private function checkDepart(DtoInterface $dto): void
    {
        /** @var LogisticsGroupApiDtoInterface $dto */
        if (!$dto->hasDepartApiDto() || !$dto->getDepartApiDto()->hasId() || !$dto->getDepartApiDto()->hasWarehouse()) {
            throw new LogisticsGroupInvalidException('The Dto has\'t Depart');
        }
    }

    private function checkGroup(DtoInterface $dto): void
    {
        /** @var LogisticsGroupApiDtoInterface $dto */
        if (!$dto->hasGroupApiDto()) {
            throw new LogisticsGroupInvalidException('The Dto has\'t Group');
        }
    }
}
