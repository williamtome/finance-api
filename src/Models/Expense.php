<?php

namespace FinanceApp\Models;

use Doctrine\ORM\Mapping\{Column, Entity, GeneratedValue, Id, Table};

/**
 * @Entity
 * @Table(name="expense")
 */
class Expense
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
}
