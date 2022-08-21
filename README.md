# Configuration

преопределение штатного класса сущности

    packing_list:
        db_driver: api модель данных либо orm (пока не реализованна)
        factory_packing_list: App\PackingList\Factory\PackingListFactory фабрика для создания объекта упаковочного листа, 
                 не достающие значения можно разрешить на уровне Mediator или переопределив фабрику 
        factory_list_item: App\PackingList\Factory\ListItemFactory фабрика для создания объекта единцы входящей в упаковочный лист, 
                 не достающие значения можно разрешить на уровне Mediator или переопределив фабрику 
        factory_depart: App\PackingList\Factory\DepartFactory фабрика для создания объекта склада,
                не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        factory_logistics: App\PackingList\Factory\LogisticsFactory фабрика для создания объекта логистики,
                не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        entity_packing_list: App\PackingList\Entity\PackingList сущность паковочного листа
        entity_list_item: App\PackingList\Entity\ListItem сущность единцы входящей в упаковочный лист
        entity_depart: App\PackingList\Entity\Depart сущность склада
        entity_logistics: App\PackingList\Entity\Logistics сущность логистики
        constraints_packing_list: - включить валидацию по умолчанию для упаковочного листа
        constraints_list_item: - включить валидацию по умолчанию для единцы входящей в упаковочный лист
        constraints_depart: - включить валидацию по умолчанию для склада
        constraints_logistics: - включить валидацию по умолчанию для логистики
        dto_packing_list: App\PackingList\Dto\PackingListDto класс dto с которым работает сущность упаковочного листа
        dto_list_item: App\PackingList\Dto\ListItemDto класс dto с которым работает сущность единцы входящей в упаковочный лист
        dto_depart: App\PackingList\Dto\DepartDto класс dto с которым работает сущность склада
        dto_logistics: App\PackingList\Dto\LogisticsDto класс dto с которым работает сущность логистики
        decorates:
          command_packing_list - декоратор команд упаковочного листа
          query_packing_list - декоратор запросов упаковочного листа
          command_list_item - декоратор команд связи единцы входящей в упаковочный лист
          command_list_item - декоратор запросов единцы входящей в упаковочный лист
          command_depart - декоратор команд склада
          query_depart - декоратор запросов склада
          command_logistics - декоратор команд логистики
          query_logistics - декоратор запросов логистики
        services:
          pre_validator_packing_list - переопределение сервиса валидатора упаковочного листа
          pre_validator_list_item - переопределение сервиса валидатора единцы входящей в упаковочный лист
          pre_validator_depart - переопределение сервиса валидатора склада
          pre_validator_logistics - переопределение сервиса валидатора логистики
        fetch:  - можно включить или выключить (disabled/enabled)
            host: настройка host
            urls: настйрока api routes
                depart:
                 criteria: /api/packing_list/departs
                list_item:
                 criteria: /api/packing_list/items
                 get: /api/packing_list/items
                logistics:
                 post: /api/packing_list_to_depart
                packing_list:
                 criteria: /api/packing/lists
                 get: /api/packing_lists

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

    api_put_depart, api_post_depart, api_get_depart
    api_put_list_item, api_post_list_item, api_get_list_item
    api_put_logistics, api_post_logistics, api_get_logistics
    api_put_packing_list, api_post_packing_list, api_get_packing_list    

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