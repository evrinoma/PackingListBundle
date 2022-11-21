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

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Point;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingListGroup\Id as PackingListGroupId;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryTestInterface;
use Evrinoma\UtilsBundle\Model\Rest\ErrorModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

trait BaseDepartTestTrait
{
    protected string $content = '';
    protected ?\Exception $exception = null;

    protected function contentActionGet(): void
    {
        $id = Id::value();
        $this->content = <<< EOF
{
"id":{$id},
"warehouse":64,
"point":"\u0427\u0413\u0420\u041a \u21161.2",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u041c\u0443\u0440\u043c\u0430\u043d\u0441\u043a",
"final":false
}
EOF;
    }

    protected function exceptionActionGetNotFound(): void
    {
        $this->exception = new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?id='.Id::wrong().'"');
    }

    protected function contentActionCriteria(): \Generator
    {
        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
               'query' => $query,
               'content' => <<< EOF
[{
"id":49,
"warehouse":64,
"packingList":
    {
    "id":2,
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a \u21161.2",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u041c\u0443\u0440\u043c\u0430\u043d\u0441\u043a",
"final":false
},
{
"id":52,
"warehouse":61,
"packingList":
    {
    "id":2,
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a_\u21161.1",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u0410\u0440\u0445\u0430\u043d\u0433\u0435\u043b\u044c\u0441\u043a",
"final":true
}]
EOF,
               'call' => function ($args) {
                   Assert::assertCount(2, $args[PayloadModel::PAYLOAD]);
                   foreach ($args[PayloadModel::PAYLOAD] as $depart) {
                       $this->checkGetDepart($depart);
                   }
               },
        ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
               'query' => $query,
            'content' => <<< EOF
[{
"id":52,
"warehouse":61,
"packingList":
    {
    "id":2,
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a_\u21161.1",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u0410\u0440\u0445\u0430\u043d\u0433\u0435\u043b\u044c\u0441\u043a",
"final":true
}]
EOF,
               'call' => function ($args) {
                   Assert::assertCount(1, $args[PayloadModel::PAYLOAD]);
                   foreach ($args[PayloadModel::PAYLOAD] as $depart) {
                       $this->checkGetDepart($depart);
                   }
               },
           ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::PACKING_LIST]);

        $content[] = [
            'query' => $query,
            'content' => <<< EOF
[{
"id":52,
"warehouse":61,
"packingList":
    {
    "id":2,
    "label":"",
    "weight":"",
    "formFactor":"",
    "contract":"948",
    "projectName":"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0441\u043a\u0430\u044f \u0422\u042d\u0426",
    "contractorName":"SIEMENS",
    "subContracts":"",
    "dimensions":""
    },
"point":"\u0427\u0413\u0420\u041a_\u21161.1",
"name":"\u041f\u0443\u043d\u043a\u0442 \u21161",
"address":"\u0410\u0440\u0445\u0430\u043d\u0433\u0435\u043b\u044c\u0441\u043a",
"final":true
}]
EOF,
            'call' => function ($args) {
                Assert::assertCount(1, $args[PayloadModel::PAYLOAD]);
                foreach ($args[PayloadModel::PAYLOAD] as $depart) {
                    $this->checkGetDepart($depart);
                }
            },
        ];

        foreach ($content as $value) {
            $this->content = $value['content'];
            yield ['query' => $value['query'], 'call' => $value['call']];
        }
    }

    protected function contentActionCriteriaNotFound(): \Generator
    {
        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
            'query' => $query,
            'exception' => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?packingListId='.PackingListId::wrong().'"'),
            'call' => function ($args) {
                $this->hasError($args);
            },
        ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::TYPE]);
        unset($query[DepartApiDtoInterface::GROUP]);

        $content[] = [
            'query' => $query,
            'exception' => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?packingListId='.PackingListId::wrong().'&point='.Point::wrong().'"'),
            'call' => function ($args) {
                $this->hasError($args);
            },
        ];

        $query = static::getDefault();
        unset($query[DepartApiDtoInterface::POINT]);
        unset($query[DepartApiDtoInterface::ID]);
        unset($query[DepartApiDtoInterface::PACKING_LIST]);

        $content[] = [
            'query' => $query,
            'exception' => new \RuntimeException('HTTP/1.1 404 Not Found returned for "'.ApiRepositoryTestInterface::HOST.static::API_GET.'?groupId='.PackingListGroupId::wrong().'&type=PACKING_LIST_GROUP_INFO"'),
            'call' => function ($args) {
                $this->hasError($args);
            },
        ];

        foreach ($content as $value) {
            $this->exception = $value['exception'];
            yield ['query' => $value['query'], 'call' => $value['call']];
        }
    }

    protected function assertGet(string $id, int $status = Response::HTTP_OK): array
    {
        $find = $this->get($id);

        switch ($status) {
            case Response::HTTP_OK:
                $this->testResponseStatusOK();
                Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
                break;
            case Response::HTTP_BAD_REQUEST:
                $this->testResponseStatusBadRequest();
                Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
                Assert::assertCount(0, $find[PayloadModel::PAYLOAD]);
                Assert::assertCount(1, $find[ErrorModel::ERROR]);
                break;
            case Response::HTTP_NOT_FOUND:
                $this->testResponseStatusNotFound();
                Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
                Assert::assertCount(0, $find[PayloadModel::PAYLOAD]);
                Assert::assertCount(1, $find[ErrorModel::ERROR]);
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

    protected function createDepart(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkGetDepart($entity): void
    {
        Assert::assertArrayHasKey(DepartApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::NAME, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::ADDRESS, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::POINT, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::WAREHOUSE, $entity);
        Assert::assertArrayHasKey(DepartApiDtoInterface::FINAL, $entity);
    }
}
