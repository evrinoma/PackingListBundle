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

namespace Evrinoma\UserBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Mutable\EmailInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\NameInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\PatronymicInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\SurnameInterface;

interface UserApiDtoInterface extends IdInterface, NameInterface, EmailInterface, SurnameInterface, PatronymicInterface
{
}
