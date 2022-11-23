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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\DepartApiDto;
use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait DepartTrait
{
    /**
     * @var DepartApiDtoInterface|null
     */
    protected ?DepartApiDtoInterface $departApiDto = null;

    /**
     * @return \Generator
     */
    public function genRequestDepartApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $depart = $request->get(DepartInterface::DEPART);
            if ($depart) {
                $newRequest = $this->getCloneRequest();
                $depart[DtoInterface::DTO_CLASS] = DepartApiDto::class;
                $newRequest->request->add($depart);

                yield $newRequest;
            }
        }
    }

    public function hasDepartApiDto(): bool
    {
        return null !== $this->departApiDto;
    }

    public function getDepartApiDto(): DepartApiDtoInterface
    {
        return $this->departApiDto;
    }
}
