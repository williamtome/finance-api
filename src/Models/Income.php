<?php

namespace FinanceApp\Models;

use Doctrine\ORM\Mapping\{
    Column,
    Entity,
    GeneratedValue,
    Id,
    Table
};

/**
 * @Entity
 * @Table(name="income")
 */
class Income implements \JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private string $id;

    /**
     * @Column(type="text")
     */
    private string $description;

    /**
     * @Column(type="decimal")
     */
    private float $amount;

    /**
     * @Column(type="string")
     */
    private string $date;

    public function jsonSerialize(): array
    {
        return [
            'id' => (int) $this->id,
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
        ];
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
}
