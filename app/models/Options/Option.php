<?php
/**
 * Options
 *
 * @author  Jiří Šifalda
 * @package Flame
 *
 * @date    09.07.12
 */

namespace Flame\Models\Options;

/**
 * @Entity(repositoryClass="OptionRepository")
 * @Table(name="options")
 */

class Option extends \Flame\Models\Doctrine\Entity
{
    /**
     * @Column(type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @Column(type="string", length=250)
     */
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = (string) $value;
        return $this;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}