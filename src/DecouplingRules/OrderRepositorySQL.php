<?php

namespace Beerphp\Examples\DecouplingRules;

use PDO;

class OrderRepositorySQL
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=pdo', 'root', 'password');
    }

    public function save(Order $order): void
    {
        $statement = $this->connection->prepare('INSERT INTO `orders` (`id`, `name`) VALUES (:id, :name)');
        $statement->execute($order->asArray());
    }

    public function getById(OrderId $orderId): Order
    {
        $statement = $this->connection->prepare('SELECT * FROM orders WHERE `id` = :id');
        $statement->execute(['id' => (string) $orderId]);
        $data = $statement->fetch(PDO::FETCH_LAZY);

        return Order::fromState($data);
    }
}