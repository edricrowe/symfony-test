<?php

namespace App\Controller;

use App\Entity\Groups;
use App\Entity\Users;
use App\Service\RandomNumber;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    public function provaTwig($name)
    {
        return $this->render('main/index.html.twig', [
            'name' => $name,
        ]);
    }

    public function createUsers()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $group = new Groups();
        $group->setNome('Gruppo');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($group);

        $array = [
            [
                "nome" => "Federico",
                "cognome" => "Cicala",
                "email" => 'cicala.federico@gmail.com'
            ],
            [
                "nome" => "Emanuele",
                "cognome" => "Rossi",
                "email" => 'asdas@gmail.com'
            ],
            [
                "nome" => "Paolo",
                "cognome" => "Mutti",
                "email" => 'mutti@gmail.com'
            ]
        ];
        foreach ($array as $item){
            $user = new Users();
            $user->setNome($item['nome']);
            $user->setCognome($item['cognome']);
            $user->setEmail($item['email']);
            $user->setGroupId($group);

            $entityManager->persist($user);
        }

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('OK');
    }

    public function provaDoctrine()
    {
        $users = $this->getDoctrine()
            ->getRepository(Users::class)
            ->getRandomUsers();

        return $this->render('main/utenti.html.twig', [
            'users' => $users,
        ]);
    }

    public function provaSymfony(RandomNumber $number)
    {
        return $this->render('main/stampa.html.twig', [
            'number' => $number->getRandomNumber()
        ]);
    }
}
