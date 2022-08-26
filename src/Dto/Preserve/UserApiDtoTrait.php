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

use Evrinoma\DtoCommon\ValueObject\Preserve\EmailTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\NameTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\PatronymicTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\SurnameTrait;

trait UserApiDtoTrait
{
    use EmailTrait;
    use IdTrait;
    use NameTrait;
    use PatronymicTrait;
    use SurnameTrait;
}
