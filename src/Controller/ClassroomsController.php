<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class ClassroomsController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/classrooms", name="classrooms")
     */
    public function getAction()
    {
        return $this->json(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/ClassroomsController.php',
            ]
        );
    }
}
