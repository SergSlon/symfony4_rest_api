<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomsController extends AbstractController
{
    /**
     * @Route("/classrooms", name="classrooms")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClassroomsController.php',
        ]);
    }
}
