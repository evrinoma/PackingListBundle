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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\UserApiDtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable\UserTrait as UserImmutableTrait;

trait UserTrait
{
    use UserImmutableTrait;

    /**
     * @param UserApiDtoInterface $user
     *
     * @return DtoInterface
     */
    public function setUserApiDto(UserApiDtoInterface $user): DtoInterface
    {
        $this->user = $user;

        return $this;
    }
}
