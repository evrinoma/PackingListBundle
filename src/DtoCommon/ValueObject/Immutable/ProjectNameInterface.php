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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable;

interface ProjectNameInterface
{
    public const PROJECT_NAME = 'project_name';

    /**
     * @return bool
     */
    public function hasProjectName(): bool;

    /**
     * @return string
     */
    public function getProjectName(): string;
}
