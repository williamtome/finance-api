<?php

namespace FinanceApp\Models;

use Doctrine\ORM\Mapping\{Column, Id, GeneratedValue, Table, Entity, OneToMany};

/**
 * @Entity
 * @Table(name="category")
 */
class Category implements \JsonSerializable
{
    /**
     * @Id()
     * @GeneratedValue
     * @Column(type="integer")
     */
    private int $id;

    /**
     * @Column(type="string")
     */
    private string $name;

    /**
     * @OneToMany(targetEntity="Expense", mappedBy="category")
     */
    private Expense $expense;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
