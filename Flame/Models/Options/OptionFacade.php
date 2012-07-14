<?php
/**
 * OptionFacade
 *
 * @author  Jiří Šifalda
 * @package Flame
 *
 * @date    09.07.12
 */

namespace Flame\Models\Options;

use \Flame\Models\Options\Option;

class OptionFacade
{
    private $repository;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRepository('\Flame\Models\Options\Option');
    }

    public function getOne($id)
    {
        return $this->repository->findOneBy(array('id' => $id));
    }

    public function getByName($name)
    {
        return $this->repository->findOneBy(array('name' => $name));
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function persist(Option $option)
    {
        return $this->repository->save($option);
    }

    public function delete(Option $option)
    {
        return $this->repository->delete($option);
    }

    public function getOptionValue($name)
    {
        $option = $this->repository->findOneBy(array('name' => $name));

        if($option){
            return $option->value;
        }else{
            return null;
        }
    }

}