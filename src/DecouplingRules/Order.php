<?php


namespace Beerphp\Examples\DecouplingRules;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Order
{

    public function __construct(
        private int $id,
        private string $name
    ) {}

    #[Pure]
    public static function fromState(array $data): self
    {
        return new self($data['id'], $data['name']);
    }

    #[ArrayShape([
        'id' => 'int',
        'name' => 'string'
    ])]

    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}