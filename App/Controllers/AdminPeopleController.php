<?php


namespace App\Controllers;

use App\Models\People\People;
use App\Tools\Validation;
use MF\Controller\Action;
use MF\Model\Container;


class AdminPeopleController extends Action
{


    public function availableSex()
    {

        $People = Container::getModel('People\\People');
        echo json_encode($People->availableSex());
    }


    public function pcd()
    {

        $People = Container::getModel('People\\People');
        echo json_encode($People->pcd());
    }


    public function bloodType()
    {

        $People = Container::getModel('People\\People');
        echo json_encode($People->bloodType());
    }


    public function checkCpf()
    {

        $People = Container::getModel('People\\People');

        $cpf = preg_replace('/[^0-9]/', '', $_GET['cpf']);

        $People->__set('cpf', $cpf);

        echo json_encode($People->checkCpf()); 
    }
}
