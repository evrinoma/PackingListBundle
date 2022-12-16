# Configuration

преопределение штатного класса сущности

    packing_list:
        db_driver: api модель данных либо orm (пока не реализованна)
        factory_packing_list: App\PackingList\Factory\PackingListFactory фабрика для создания объекта упаковочного листа, 
                 не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        factory_packing_list_group: App\PackingList\Factory\PackingListGroupFactory фабрика для создания объекта группы упаковочных листов, 
                 не достающие значения можно разрешить на уровне Mediator или переопределив фабрику 
        factory_list_item: App\PackingList\Factory\ListItemFactory фабрика для создания объекта единцы входящей в упаковочный лист, 
                 не достающие значения можно разрешить на уровне Mediator или переопределив фабрику 
        factory_depart: App\PackingList\Factory\DepartFactory фабрика для создания объекта склада,
                не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        factory_group: App\PackingList\Factory\GroupFactory фабрика для создания объекта группы,
                не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        factory_logistics: App\PackingList\Factory\LogisticsFactory фабрика для создания объекта логистики,
                не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        factory_logistics_group: App\PackingList\Factory\LogisticsGroupFactory фабрика для создания объекта логистики группы,
                не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        entity_packing_list: App\PackingList\Entity\PackingList сущность паковочного листа
        entity_packing_list_group: App\PackingList\Entity\PackingListGroup сущность группы упаковочных листов
        entity_list_item: App\PackingList\Entity\ListItem сущность единцы входящей в упаковочный лист
        entity_depart: App\PackingList\Entity\Depart сущность склада
        entity_group: App\PackingList\Entity\Group сущность группы
        entity_logistics: App\PackingList\Entity\Logistics сущность логистики
        entity_logistics_group: App\PackingList\Entity\LogisticsGroup сущность логистики группы
        constraints_packing_list: - включить валидацию по умолчанию для упаковочного листа
        constraints_packing_list_group: - включить валидацию по умолчанию для группы упаковочных листов
        constraints_list_item: - включить валидацию по умолчанию для единцы входящей в упаковочный лист
        constraints_depart: - включить валидацию по умолчанию для склада
        constraints_group: - включить валидацию по умолчанию для группы
        constraints_logistics: - включить валидацию по умолчанию для логистики
        constraints_logistics_group: - включить валидацию по умолчанию для логистики группы
        dto_packing_list: App\PackingList\Dto\PackingListDto класс dto с которым работает сущность упаковочного листа
        dto_packing_list_group: App\PackingList\Dto\PackingListGroupDto класс dto с которым работает сущность группы упаковочных листов
        dto_list_item: App\PackingList\Dto\ListItemDto класс dto с которым работает сущность единцы входящей в упаковочный лист
        dto_depart: App\PackingList\Dto\DepartDto класс dto с которым работает сущность склада
        dto_group: App\PackingList\Dto\GroupDto класс dto с которым работает сущность группы
        dto_logistics: App\PackingList\Dto\LogisticsDto класс dto с которым работает сущность логистики
        dto_logistics_group: App\PackingList\Dto\LogisticsGroupDto класс dto с которым работает сущность логистики группы
        decorates:
            command_packing_list - декоратор команд упаковочного листа
            query_packing_list - декоратор запросов упаковочного листа
            command_packing_list_group - декоратор команд группы упаковочных листов
            query_packing_list_group - декоратор запросов группы упаковочных листов
            command_list_item - декоратор команд связи единцы входящей в упаковочный лист
            query_list_item - декоратор запросов единцы входящей в упаковочный лист
            command_depart - декоратор команд склада
            query_depart - декоратор запросов склада
            command_group - декоратор команд группы
            query_group - декоратор запросов группы
            command_logistics - декоратор команд логистики
            query_logistics - декоратор запросов логистики
            command_logistics_group - декоратор команд логистики группы
            query_logistics_group - декоратор запросов логистики группы
        services:
            pre_validator_packing_list - переопределение сервиса валидатора упаковочного листа
            pre_validator_list_item - переопределение сервиса валидатора единцы входящей в упаковочный лист
            pre_validator_depart - переопределение сервиса валидатора склада
            pre_validator_group - переопределение сервиса валидатора группы
            pre_validator_logistics - переопределение сервиса валидатора логистики
            pre_validator_logistics_group - переопределение сервиса валидатора группы упаковочных листов
            handler_packing_list - переопределение сервиса обработчика упаковочного листа
            handler_packing_list_group - переопределение сервиса обработчика группы упаковочных листов
            handler_list_item - переопределение сервиса обработчика единцы входящей в упаковочный лист
            handler_depart - переопределение сервиса обработчика склада
            handler_logistics - переопределение сервиса обработчика логистики
            handler_logistics_group - переопределение сервиса обработчика логистики группы
        fetch:  - можно включить или выключить (disabled/enabled)
            host: настройка host
            urls: настйрока api routes
                group:
                 criteria: /api/packing_list/group/infos
                depart:
                 criteria: /api/packing_list/departs
                 get: /api/packing_list/depart
                list_item:
                 criteria: /api/packing_list/items
                 get: /api/packing_list/item
                packing_list_group:
                 criteria: /api/packing_list/groups
                 get: /api/packing_list/group
                logistics:
                 post: /api/packing_list/logistics
                logistics_group:
                 post: /api/packing_list/logistics/group
                packing_list:
                 criteria: /api/packing/lists
                 get: /api/packing_list

# CQRS model

Actions в контроллере разбиты на две группы создание, редактирование, удаление данных

        1. putAction(PUT), postAction(POST), deleteAction(DELETE)

получение данных

        2. getAction(GET), criteriaAction(GET)

каждый метод работает со своим менеджером

        1. CommandManagerInterface
        2. QueryManagerInterface

При преопределении штатного класса сущности, дополнение данными осуществляется декорированием, с помощью MediatorInterface Медиатор доступен только для Depart, ListItem, Logistics и PackingList сущностей

группы сериализации

    API_PUT_DEPART, API_POST_DEPART, API_GET_DEPART
    API_PUT_GROUP, API_POST_GROUP, API_GET_GROUP
    API_PUT_LIST_ITEM, API_POST_LIST_ITEM, API_GET_LIST_ITEM
    API_PUT_LOGISTICS, API_POST_LOGISTICS, API_GET_LOGISTICS
    API_PUT_PACKING_LIST, API_POST_PACKING_LIST, API_GET_PACKING_LIST   
    API_PUT_PACKING_LIST_GROUP, API_POST_PACKING_LIST_GROUP, API_GET_PACKING_LIST_GROUP
    API_PUT_LOGISTICS, API_POST_LOGISTICS, API_GET_LOGISTICS

# Статусы:

сущность Depart

    создание:
        склад создан HTTP_CREATED 201 - не доступен, статус ответа 501
    обновление:
        склад обновление HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        склад удален HTTP_ACCEPTED 202 - не доступен, статус ответа 501
    получение:
        склад(ы) найдены HTTP_OK 200
    ошибки:
        если склад не найден DepartNotFoundException возвращает HTTP_NOT_FOUND 404
        если склад не уникален UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если склад не прошел валидацию DepartInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если склад не может быть сохранен DepartCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если склад не может быть создан DepartCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

сущность Group

    создание:
        склад создан HTTP_CREATED 201 - не доступен, статус ответа 501
    обновление:
        склад обновление HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        склад удален HTTP_ACCEPTED 202 - не доступен, статус ответа 501
    получение:
        склад(ы) найдены HTTP_OK 200
    ошибки:
        если группа не найдена GroupNotFoundException возвращает HTTP_NOT_FOUND 404
        если группа не уникальна UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если группа не прошела валидацию GroupInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если группа не может быть сохранена GroupCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если группа не может быть создана GroupCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

сущность ListItem

    создание:
        единца входящей в упаковочный лист создана HTTP_CREATED 201 - не доступен, статус ответа 501
    обновление:
        единца входящей в упаковочный лист обновлена HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        единца входящей в упаковочный лист удалена HTTP_ACCEPTED 202  - не доступен, статус ответа 501
    получение:
        единца(ы) входящей в упаковочный лист найдены HTTP_OK 200 - не доступен, статус ответа 501
    ошибки:
        если единца входящей в упаковочный лист не найдена ListItemNotFoundException возвращает HTTP_NOT_FOUND 404
        если единца входящей в упаковочный лист не уникалена UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если единца входящей в упаковочный лист не прошла валидацию ListItemInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если единца входящей в упаковочный лист не может быть сохранен ListItemCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если единца входящей в упаковочный лист не может быть создана ListItemCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

сущность Logistics

    создание:
        логистика создан HTTP_CREATED 201
    обновление:
        логистика обновление HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        логистика удален HTTP_ACCEPTED 202 - не доступен, статус ответа 501
    получение:
        логистика(и) найдены HTTP_OK 200 - не доступен, статус ответа 501
    ошибки:
        если логистика не найдена LogisticsNotFoundException возвращает HTTP_NOT_FOUND 404
        если логистика не уникалена UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если логистика не прошла валидацию LogisticsInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если логистика не может быть создана LogisticsCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если логистика не может быть сохранен LogisticsCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если логистика не может быть создана LogisticsCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

сущность LogisticsGroup

    создание:
        логистика группы создан HTTP_CREATED 201
    обновление:
        логистика группы обновление HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        логистика группы удален HTTP_ACCEPTED 202 - не доступен, статус ответа 501
    получение:
        логистика(и) группы найдены HTTP_OK 200 - не доступен, статус ответа 501
    ошибки:
        если логистика группы не найдена LogisticsGroupNotFoundException возвращает HTTP_NOT_FOUND 404
        если логистика группы не уникалена UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если логистика группы не прошла валидацию LogisticsGroupInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если логистика группы не может быть создана LogisticsGroupCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если логистика группы не может быть сохранен LogisticsGroupCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если логистика группы не может быть создана LogisticsGroupCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

сущность PackingList

    создание:
        упаковочный лист создан HTTP_CREATED 201 - не доступен, статус ответа 501
    обновление:
        упаковочный лист обновление HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        упаковочный лист удален HTTP_ACCEPTED 202 - не доступен, статус ответа 501
    получение:
        упаковочный лист(ы) найдены HTTP_OK 200
    ошибки:
        если упаковочный лист не найден PackingListNotFoundException возвращает HTTP_NOT_FOUND 404
        если упаковочный лист не уникален UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если упаковочный лист не прошел валидацию PackingListInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если упаковочный лист не может быть сохранен PackingListCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если упаковочный лист не может быть создан PackingListCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

сущность PackingListGroup

    создание:
        группы упаковочных лист создан HTTP_CREATED 201 - не доступен, статус ответа 501
    обновление:
        группы упаковочных лист обновление HTTP_OK 200 - не доступен, статус ответа 501
    удаление:
        группы упаковочных лист удален HTTP_ACCEPTED 202 - не доступен, статус ответа 501
    получение:
        группы упаковочных лист(ы) найдены HTTP_OK 200
    ошибки:
        если группа упаковочных листов не найдена PackingListGroupNotFoundException возвращает HTTP_NOT_FOUND 404
        если группа упаковочных листов не уникальна UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если группа упаковочных листов не прошла валидацию PackingListGroupInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если группа упаковочных листов не может быть сохранена PackingListGroupCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        если группа упаковочных листов не может быть создана PackingListGroupCannotBeCreatedException возвращает HTTP_BAD_REQUEST 400
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

# Constraint

Для добавления проверки поля сущности depart нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.depart

    evrinoma.packing_list.constraint.property.depart.custom:
        class: App\PackingList\Constraint\Property\DepartCustom
        tags: [ 'evrinoma.packing_list.constraint.property.depart' ]

Для добавления проверки поля сущности list_item нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.list_item

    evrinoma.packing_list.constraint.property.list_item.custom:
        class: App\PackingList\Constraint\Property\ListItemCustom
        tags: [ 'evrinoma.packing_list.constraint.property.list_item' ]

Для добавления проверки поля сущности logistics нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.logistics

    evrinoma.packing_list.constraint.property.logistics.custom:
        class: App\PackingList\Constraint\Property\LogisticsCustom
        tags: [ 'evrinoma.packing_list.constraint.property.logistics' ]

Для добавления проверки поля сущности packing_list нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.packing_list

    evrinoma.packing_list.constraint.property.packing_list.custom:
        class: App\PackingList\Constraint\Property\PackingListCustom
        tags: [ 'evrinoma.packing_list.constraint.property.packing_list' ]

Для добавления проверки поля сущности packing_list_group нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.packing_list_group

    evrinoma.packing_list.constraint.property.packing_list_group.custom:
        class: App\PackingList\Constraint\Property\PackingListGroupCustom
        tags: [ 'evrinoma.packing_list.constraint.property.packing_list_group' ]

Для добавления проверки поля сущности group нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.group

    evrinoma.packing_list.constraint.property.group.custom:
        class: App\PackingList\Constraint\Property\GroupCustom
        tags: [ 'evrinoma.packing_list.constraint.property.group' ]

Для добавления проверки поля сущности logistics_group нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.packing_list.constraint.property.logistics_group

    evrinoma.packing_list.constraint.property.logistics_group.custom:
        class: App\PackingList\Constraint\Property\LogisticsGroupCustom
        tags: [ 'evrinoma.packing_list.constraint.property.logistics_group' ]

## Description

Формат ответа от сервера содержит статус код и имеет следующий стандартный формат

```text
    [
        TypeModel::TYPE => string,
        PayloadModel::PAYLOAD => array,
        MessageModel::MESSAGE => string,
    ];
```

где TYPE - типа ответа

    ERROR - ошибка
    NOTICE - уведомление
    INFO - информация
    DEBUG - отладка

MESSAGE - от кого пришло сообщение PAYLOAD - массив данных

## Notice

показать проблемы кода

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --verbose --diff --dry-run
```

применить исправления

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
```

# Тесты:

    composer install --dev

### run all tests

    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests --teamcity

### run personal test for example testPost

    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests/Functional/Controller/ApiControllerTest.php --filter "/::testPost( .*)?$/" 

## Thanks

## Done

## License
    PROPRIETARY