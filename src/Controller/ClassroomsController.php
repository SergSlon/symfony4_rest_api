<?php

namespace App\Controller;

use App\Entity\Classroom;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class ClassroomsController extends AbstractFOSRestController
{
    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getClassroomsRepository()
    {
        return $this->getDoctrine()->getRepository(Classroom::class);
    }

    /**
     * @Rest\Get("/classrooms", name="classrooms")
     */
    public function getAction()
    {
        $classrooms = $this->getClassroomsRepository()->findAll();

        $view = $this->view($classrooms)
            ->setTemplate('classrooms/all.html.twig')
            ->setTemplateVar('classrooms')
        ;

        return $this->handleView($view);
    }
}
