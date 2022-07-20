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
    #[Route('/db/test/fixtures', name: 'app_db_test_fixtures')]
    public function fixtures(ManagerRegistry $doctrine): Response
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

    #[Route('/db/test/orm', name: 'app_db_test_orm')]
    public function orm(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Tag::class);
        $tags = $repository->findAll();

        $repository = $doctrine->getRepository(SchoolYear::class);
        $schoolYears = $repository->findAll();

        $repository = $doctrine->getRepository(Project::class);
        $projects = $repository->findAll();

        $repository = $doctrine->getRepository(Student::class);
        $students = $repository->findAll();
        dump($students);

        $id = 16;
        $student = $repository->find($id);
        dump($student);

        $student = $repository->findOneBy(['firstname' => 'Roger']);
        dump($student);

        $manager = $doctrine->getManager();

        if ($student) {
            $manager->remove($student);
            $manager->flush();
        }

        $id = 19;
        $student = $repository->find($id);
        dump($student->getFirstname());

        $student->setFirstname('Toto');
        dump($student->getFirstname());

        $manager->flush();

        $student = new Student();
        $student->setFirstname('Foo');
        $student->setLastname('Bar');
        $student->setSchoolYear($schoolYears[0]);

        $studentProjects = [$projects[0],];

        foreach ($studentProjects as $project) {
            $student->addProject($project);
        }
        
        $studentTags = [$tags[0], $tags[1],];

        foreach ($studentTags as $tag) {
            $student->addTag($tag);
        }

        $manager->persist($student);
        $manager->flush();

        exit();
    }
}
