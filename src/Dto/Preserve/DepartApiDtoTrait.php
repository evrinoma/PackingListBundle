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
use Evrinoma\DtoCommon\ValueObject\Preserve\TypeTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\AddressTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\FinalTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\GroupTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\PackingListTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\PointTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\WarehouseTrait;

trait DepartApiDtoTrait
{
    use AddressTrait;
    use FinalTrait;
    use GroupTrait;
    use IdTrait;
    use NameTrait;
    use PackingListTrait;
    use PointTrait;
    use TypeTrait;
    use WarehouseTrait;
}
