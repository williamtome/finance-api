<?php

namespace FinanceApp\Models;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, Table, ManyToOne};
/**
 * @Entity
 * @Table(name="expense")
 */
class Expense implements \JsonSerializable
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

    /**
     * @ManyToOne(targetEntity="Category", inversedBy="expense")
     */
    private Category $category;

    public function setDescription(string|null $description): void
    {
        if (!is_null($description)) {
            $this->description = $description;
        }
    }

    public function setAmount(float|null $amount): void
    {
        if (!is_null($amount)) {
            $this->amount = $amount;
        }
    }

    public function setDate(string|null $date): void
    {
        if (!is_null($date)) {
            $this->date = $date;
        }
    }

    public function jsonSerialize()
    {
        return [
            'id' => (int) $this->id,
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
        ];
    }
}
