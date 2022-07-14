<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\SchoolYear;
use App\Entity\Student;
use App\Entity\Tag;
use App\Entity\Teacher;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DbTestController extends AbstractController
{
    #[Route('/db/test', name: 'app_db_test')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Tag::class);
        $tags = $repository->findAll();
        dump($tags);

        $repository = $doctrine->getRepository(SchoolYear::class);
        $schoolYears = $repository->findAll();
        dump($schoolYears);

        $repository = $doctrine->getRepository(Project::class);
        $projects = $repository->findAll();
        dump($projects);

        $repository = $doctrine->getRepository(Student::class);
        $students = $repository->findAll();
        dump($students);

        $repository = $doctrine->getRepository(Teacher::class);
        $teachers = $repository->findAll();
        dump($teachers);

        exit();
    }
}
