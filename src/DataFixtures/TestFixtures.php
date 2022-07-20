<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\SchoolYear;
use App\Entity\Student;
use App\Entity\Tag;
use App\Entity\Teacher;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory  as FakerFactory;
use Faker\Generator  as FakerGenerator;

class TestFixtures extends Fixture
{
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        
    }

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');
        
        $this->loadTags($manager, $faker);
        $this->loadSchoolYears($manager, $faker);
        $this->loadProjects($manager, $faker);
        $this->loadStudents($manager, $faker);
        $this->loadTeachers($manager, $faker);
    }

    public function loadTags(ObjectManager $manager, FakerGenerator $faker): void
    {
        $tagNames = [
            'HTML5',
            'CSS3',
            'JavaScript',
            'Python3',
            'PHP8',
            'Wordpress6',
            'Symfony5',
            'VueJs3',
        ];
        
        foreach ($tagNames as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
        }

        // for ($i=0; $i < 10; $i++) { 
        //     $tag = new Tag();
        //     $tag->setName($faker->word());
        //     $manager->persist($tag);
        // }

        $manager->flush();
    }

    public function loadSchoolYears(ObjectManager $manager, FakerGenerator $faker): void
    {
        $schoolYearDatas = [
            [
                'name' => 'Promo Toto',
                'startdate' => DateTimeImmutable::createFromFormat('Y-m-d', '2022-02-21'),
                'enddate' => DateTimeImmutable::createFromFormat('Y-m-d', '2022-10-29'),
            ],
        ];

        foreach ($schoolYearDatas as $schoolYearData) {
            $schoolYear = new SchoolYear();
            $schoolYear->setName($schoolYearData['name']);
            $schoolYear->setStartdate($schoolYearData['startdate']);
            $schoolYear->setEnddate($schoolYearData['enddate']);

            $manager->persist($schoolYear);
        }

        // for ($i=0; $i < 5; $i++) { 
        //     $schoolYear = new SchoolYear();
        //     $schoolYear->setName($faker->sentence());
        //     $dateStart = $faker->dateTimeBetween('-5 years', '-1 year');
        //     $dateStart = DateTimeImmutable::createFromFormat('Y-m-d', "{$dateStart->format('Y-m-d')}");
        //     $schoolYear->setStartdate($dateStart);
        //     $dateEnd = $faker->dateTimeBetween('-5 years', '-1 year');
        //     $dateEnd = DateTimeImmutable::createFromFormat('Y-m-d', "{$dateEnd->format('Y-m-d')}");
        //     $schoolYear->setStartdate($dateEnd);

        //     $manager->persist($schoolYear);
        // }

        $manager->flush();
    }

    public function loadProjects(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repository = $this->doctrine->getRepository(Tag::class);
        $tags = $repository->findAll();

        $projectDatas = [
            [
                'name' => 'Student',
                'startdate' => DateTimeImmutable::createFromFormat('Y-m-d', '2022-07-04'),
                'enddate' => DateTimeImmutable::createFromFormat('Y-m-d', '2022-07-15'),
                'tags' => [$tags[0], $tags[1], $tags[4], $tags[5]],
            ],
        ];

        foreach ($projectDatas as $projectData) {
            $project = new Project();
            $project->setName($projectData['name']);
            $project->setStartdate($projectData['startdate']);
            $project->setEnddate($projectData['enddate']);
            
            foreach ($projectData['tags'] as $tag) {
                $project->addTag($tag);
            }

            $manager->persist($project);
        }

        // for ($i = 0; $i < 5; $i++) { 
        //     $project = new Project();
        //     $project->setName($faker->word());
            
        //     $count = random_int(0, 3);
        //     $projectTags = $faker->randomElements($tags, $count);

        //     foreach ($projectTags as $tag) {
        //         $project->addTag($tag);
        //     }

        //     $manager->persist($project);
        // }

        $manager->flush();
    }

    public function loadStudents(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repository = $this->doctrine->getRepository(Tag::class);
        $tags = $repository->findAll();

        $repository = $this->doctrine->getRepository(SchoolYear::class);
        $schoolYears = $repository->findAll();

        $repository = $this->doctrine->getRepository(Project::class);
        $projects = $repository->findAll();

        $studentDatas = [
            [
                'firstname' => 'Nicolas',
                'lastname' => 'BERNON',
                'schoolYear' => $schoolYears[0],
                'projects' => [$projects[0],],
                'tags' => [$tags[0], $tags[1],],
            ],
            [
                'firstname' => 'Quentin',
                'lastname' => 'FARINE',
                'schoolYear' => $schoolYears[0],
                'projects' => [$projects[0],],
                'tags' => [$tags[0], $tags[1],],
            ],
            [
                'firstname' => 'Alexandre',
                'lastname' => 'CHUFFART',
                'schoolYear' => $schoolYears[0],
                'projects' => [$projects[0],],
                'tags' => [$tags[0], $tags[1],],
            ],
            [
                'firstname' => 'Benoit',
                'lastname' => 'SACLEUX',
                'schoolYear' => $schoolYears[0],
                'projects' => [$projects[0],],
                'tags' => [$tags[0], $tags[1],],
            ],
            [
                'firstname' => 'Donatien',
                'lastname' => 'HOCHART',
                'schoolYear' => $schoolYears[0],
                'projects' => [$projects[0],],
                'tags' => [$tags[0], $tags[1],],
            ],
        ];

        foreach ($studentDatas as $studentData) {
            $student = new Student();
            $student->setFirstname($studentData['firstname']);
            $student->setLastname($studentData['lastname']);
            $student->setSchoolYear($studentData['schoolYear']);
            
            foreach ($studentData['projects'] as $project) {
                $student->addProject($project);
            }

            foreach ($studentData['tags'] as $tag) {
                $student->addTag($tag);
            }

            $manager->persist($student);
        }

        for ($i = 0; $i < 15; $i++) { 
            $student = new Student();
            $student->setFirstname($faker->firstName($gender = 'male'|'female'));
            $student->setLastname($faker->lastName());
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
        }

        $manager->flush();
    }

    public function loadTeachers(ObjectManager $manager, FakerGenerator $faker): void
    {
        $repository = $this->doctrine->getRepository(Tag::class);
        $tags = $repository->findAll();

        $repository = $this->doctrine->getRepository(SchoolYear::class);
        $schoolYears = $repository->findAll();

        $teacherDatas = [
            [
                'firstname' => 'Daishi',
                'lastname' => 'KASZER',
                'schoolYear' => $schoolYears[0],
                'tags' => [$tags[0], $tags[1], $tags[2], $tags[3], $tags[4], $tags[5], $tags[6]],
            ],
            [
                'firstname' => 'Philippe',
                'lastname' => 'PARY',
                'schoolYear' => $schoolYears[0],
                'tags' => [$tags[0], $tags[1], $tags[2], $tags[3], $tags[4], $tags[5], $tags[6], $tags[7]],
            ],
        ];

        foreach ($teacherDatas as $teacherData) {
            $teacher = new Teacher();
            $teacher->setFirstname($teacherData['firstname']);
            $teacher->setLastname($teacherData['lastname']);
            $teacher->setSchoolYear($teacherData['schoolYear']);

            foreach ($teacherData['tags'] as $tag) {
                $teacher->addTag($tag);
            }

            $manager->persist($teacher);
        }

        $manager->flush();
    }
}
