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

namespace Evrinoma\PackingListBundle\Tests\Functional\Helper;

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait BaseGroupTestTrait
{
    protected function contentActionCriteria(): \Generator
    {
        $query = static::getDefault();
        unset($query[GroupApiDtoInterface::ID]);
        unset($query[GroupApiDtoInterface::INFO]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[
    {
      "info": "Контейнер KRPU 1006942",
      "id": 3
    },
    {
      "info": "Контейнер KRPU 0196703",
      "id": 4
    },
    {
      "info": "Контейнер KRPU 0172933",
      "id": 5
    },
    {
      "info": "Контейнер KRPU 0417980",
      "id": 6
    },
    {
      "info": "Контейнер KRPU 1003579",
      "id": 7
    }
  ]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                Assert::assertCount(5, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $item) {
                    $this->checkGroup($item);
                }
            },
];

        foreach ($content as $value) {
            $this->content = $value[ApiRepositoryHelperTestInterface::CONTENT];
            yield [
                ApiRepositoryHelperTestInterface::QUERY => $value[ApiRepositoryHelperTestInterface::QUERY],
                ApiRepositoryHelperTestInterface::CALL => $value[ApiRepositoryHelperTestInterface::CALL],
            ];
        }
    }

    protected function contentActionCriteriaNotFound(): \Generator
    {
        $query = static::getDefault();
        unset($query[GroupApiDtoInterface::ID]);
        unset($query[GroupApiDtoInterface::INFO]);

        $content[] = [
            ApiRepositoryHelperTestInterface::QUERY => $query,
            ApiRepositoryHelperTestInterface::CONTENT => <<< EOF
[]
EOF,
            ApiRepositoryHelperTestInterface::CALL => function ($args) {
                $this->hasError($args);
            },
        ];

        foreach ($content as $value) {
            $this->content = $value[ApiRepositoryHelperTestInterface::CONTENT];
            yield [
                ApiRepositoryHelperTestInterface::QUERY => $value[ApiRepositoryHelperTestInterface::QUERY],
                ApiRepositoryHelperTestInterface::CALL => $value[ApiRepositoryHelperTestInterface::CALL],
            ];
        }
    }

    protected function assertGet(string $id, int $status = Response::HTTP_OK): array
    {
        $find = $this->get($id);

        switch ($status) {
            case Response::HTTP_OK:
                $this->testResponseStatusOK();
                $this->checkResult($find);
                break;
            case Response::HTTP_BAD_REQUEST:
                $this->testResponseStatusBadRequest();
                $this->hasError($find);
                break;
            case Response::HTTP_NOT_FOUND:
                $this->testResponseStatusNotFound();
                $this->hasError($find);
                break;
        }

        return $find;
    }

    protected function hasError($value)
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $value);
        Assert::assertCount(0, $value[PayloadModel::PAYLOAD]);
        Assert::assertCount(1, $value[ErrorModel::ERROR]);
    }

    protected function createGroup(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkGroup($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkGroup($entity): void
    {
        Assert::assertArrayHasKey(GroupApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(GroupApiDtoInterface::INFO, $entity);
    }
}
