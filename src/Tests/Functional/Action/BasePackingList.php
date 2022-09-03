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

namespace Evrinoma\PackingListBundle\Tests\Functional\Action;

use Evrinoma\PackingListBundle\Dto\ListItemApiDto;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BasePackingListTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use PHPUnit\Framework\Assert;

class BasePackingList extends AbstractServiceTest implements BasePackingListTestInterface
{
    use BasePackingListTestTrait;

    public const API_GET      = 'evrinoma/api/packing_list';
    public const API_CRITERIA = 'evrinoma/api/packing_list/criteria';
    public const API_DELETE   = 'evrinoma/api/packing_list/delete';
    public const API_PUT      = 'evrinoma/api/packing_list/save';
    public const API_POST     = 'evrinoma/api/packing_list/create';

    protected static function getDtoClass(): string
    {
        return ListItemApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            'class' => static::getDtoClass(),
            'id'    => Id::default(),
        ];
    }

    public function actionPost(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDelete(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionGet(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionGetNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDeleteNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDeleteUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPutNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPutUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionCriteriaNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionCriteria(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPut(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
}
