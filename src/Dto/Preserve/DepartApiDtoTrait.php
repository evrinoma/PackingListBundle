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

namespace Evrinoma\PackingListBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\NameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\AddressTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\IdDepartTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\IsFinalTrait;

trait DepartApiDtoTrait
{
    use AddressTrait;
    use IdDepartTrait;
    use IdTrait;
    use IsFinalTrait;
    use NameTrait;
}
