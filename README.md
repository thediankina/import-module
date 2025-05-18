# City import module

This module is an example of data import. The process is enclosed inside a task, which is sent as a message
to the Apache Kafka section. The module plays message producer and consumer roles at the same time.

## Database

The `city` table has the following attributes:

| Field      | Type                     | Description           |
|------------|--------------------------|-----------------------|
| id         | bigint unsigned not null | ID                    |
| name       | varchar(255) not null    | Name                  |
| created_at | timestamp(0) not null    | Created at (datetime) |
| updated_at | timestamp(0) null        | Updated at (datetime) |
