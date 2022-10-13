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

namespace Evrinoma\PackingListBundle\Serializer;

interface GroupInterface
{
    public const API_POST_DEPART = 'API_POST_DEPART';
    public const API_PUT_DEPART = 'API_PUT_DEPART';
    public const API_GET_DEPART = 'API_GET_DEPART';
    public const API_CRITERIA_DEPART = self::API_GET_DEPART;

    public const API_POST_LIST_ITEM = 'API_POST_LIST_ITEM';
    public const API_PUT_LIST_ITEM = 'API_PUT_LIST_ITEM';
    public const API_GET_LIST_ITEM = 'API_GET_LIST_ITEM';
    public const API_CRITERIA_LIST_ITEM = self::API_GET_LIST_ITEM;

    public const API_POST_LOGISTICS = 'API_POST_LOGISTICS';
    public const API_PUT_LOGISTICS = 'API_PUT_LOGISTICS';
    public const API_GET_LOGISTICS = 'API_GET_LOGISTICS';
    public const API_CRITERIA_LOGISTICS = self::API_GET_LOGISTICS;

    public const API_POST_LOGISTICS_GROUP = 'API_POST_LOGISTICS_GROUP';
    public const API_PUT_LOGISTICS_GROUP = 'API_PUT_LOGISTICS_GROUP';
    public const API_GET_LOGISTICS_GROUP = 'API_GET_LOGISTICS_GROUP';
    public const API_CRITERIA_LOGISTICS_GROUP = self::API_GET_LOGISTICS_GROUP;

    public const API_POST_PACKING_LIST = 'API_POST_PACKING_LIST';
    public const API_PUT_PACKING_LIST = 'API_PUT_PACKING_LIST';
    public const API_GET_PACKING_LIST = 'API_GET_PACKING_LIST';
    public const API_CRITERIA_PACKING_LIST = self::API_GET_PACKING_LIST;

    public const API_POST_PACKING_LIST_GROUP = 'API_POST_PACKING_LIST_GROUP';
    public const API_PUT_PACKING_LIST_GROUP = 'API_PUT_PACKING_LIST_GROUP';
    public const API_GET_PACKING_LIST_GROUP = 'API_GET_PACKING_LIST_GROUP';
    public const API_CRITERIA_PACKING_LIST_GROUP = self::API_GET_PACKING_LIST_GROUP;

    public const API_POST_GROUP = 'API_POST_GROUP';
    public const API_PUT_GROUP = 'API_PUT_GROUP';
    public const API_GET_GROUP = 'API_GET_GROUP';
    public const API_CRITERIA_GROUP = self::API_GET_GROUP;
}
