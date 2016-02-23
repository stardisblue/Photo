<?php

namespace Rave\Core\Database\Driver;

interface GenericDriver
{

    public function query(string $statement, array $values = []): array;

    public function queryOne(string $statement, array $values = []);

    public function execute(string $statement, array $values = []);

    public function lastInsertId(): string;

}
