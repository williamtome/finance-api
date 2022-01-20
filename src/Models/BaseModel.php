<?php

namespace FinanceApp\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

abstract class BaseModel
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
