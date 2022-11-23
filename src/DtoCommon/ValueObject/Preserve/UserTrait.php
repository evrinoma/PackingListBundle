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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\UserApiDtoInterface;

trait UserTrait
{
    /**
     * @param UserApiDtoInterface $userApiDto
     *
     * @return DtoInterface
     */
    public function setUserApiDto(UserApiDtoInterface $userApiDto): DtoInterface
    {
        return parent::setUserApiDto($userApiDto);
    }
}
