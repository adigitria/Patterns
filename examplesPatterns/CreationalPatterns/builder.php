<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 15/07/2018
 * Time: 02:13
 */

namespace Patterns\CreationalPatterns\Builder;

/*
 * Вкратце
 * Шаблон позволяет создавать разные свойства объекта, избегая загрязнения конструктора (constructor pollution).
 * Это полезно, когда у объекта может быть несколько свойств. Или когда создание объекта состоит из большого количества этапов.
 * Шаблон «Строитель» предназначен для поиска решения проблемы антипаттерна Telescoping constructor.
 *
 * Когда использовать?
 * Когда у объекта может быть несколько свойств и когда нужно избежать Telescoping constructor.
 * Ключевое отличие от шаблона «Простая фабрика»: он используется в одноэтапном создании, а «Строитель» — в многоэтапном.
 */

// Add builder for entity CheeseBurger
/**
 * Class CheeseBurgerBuilder
 * @package Patterns\CreationalPatterns\Builder
 */
class CheeseBurgerBuilder
{
    /**
     * @var int
     */
    public $size;

    /**
     * @var bool
     */
    public $cheese = false;
    /**
     * @var bool
     */
    public $pepperoni = false;
    /**
     * @var bool
     */
    public $lettuce = false;
    /**
     * @var bool
     */
    public $tomato = false;

    /**
     * CheeseBurgerBuilder constructor.
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return $this
     */
    public function addPepperoni()
    {
        $this->pepperoni = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function addLettuce()
    {
        $this->lettuce = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function addCheese()
    {
        $this->cheese = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function addTomato()
    {
        $this->tomato = true;
        return $this;
    }

    /**
     * @return CheeseBurger
     */
    public function build(): CheeseBurger
    {
        return new CheeseBurger($this);
    }
}

//Add class CheeseBurger, that use builder

/**
 * Class CheeseBurger
 * @package Patterns\CreationalPatterns\Builder
 */
class CheeseBurger
{
    /**
     * @var int
     */
    protected $size;

    /**
     * @var bool
     */
    protected $cheese = false;
    /**
     * @var bool
     */
    protected $pepperoni = false;
    /**
     * @var bool
     */
    protected $lettuce = false;
    /**
     * @var bool
     */
    protected $tomato = false;

    /**
     * CheeseBurger constructor.
     * @param CheeseBurgerBuilder $builder
     */
    public function __construct(CheeseBurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }
}

//Using
$burger = (new CheeseBurgerBuilder(14))
    ->addPepperoni()
    ->addLettuce()
    ->addTomato()
    ->build();

