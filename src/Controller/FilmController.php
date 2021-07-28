<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Impression;
use App\Form\FilmType;
use App\Form\ImpressionType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="indexFilm")
     */
    public function index(FilmRepository $repoFilm): Response
    {
        $films = $repoFilm->findAll();

        return $this->render('film/index.html.twig', [
            'AllFilm' => $films,
        ]);
    }

    /**
     * @Route("/film/show/{id}", name="showFilm")
     */
    public function show(Film $film): Response
    {
        $impressions = $film->getImpressions();

        return $this->render('film/show.html.twig', [
            'AllImpressions' => $impressions,
            'showFilm' => $film,
        ]);
    }

    /**
     * @Route("/film/del/{id}", name="delFilm")
     */
    public function del(Film $film, EntityManagerInterface $manager) : Response
    {
        $user = $this->getUser();
        if ($user == $film->getUser()) {
            $manager->remove($film);
            $manager->flush();

            return $this->redirectToRoute('indexFilm');
        }else{
            die("Tu n'est pas le créateur du film");
        }
    }

    /**
     * @Route("/film/create/", name="createFilm")
     * @Route ("/film/edit/{id}", name="editFilm")
     */
    public function new(Film $film = null, Request $laRequete, EntityManagerInterface $manager) : Response
    {
        $user = $this->getUser();
        if (!$user){
            die("tu dois etre connecter");
        }

        $modeCreate = false;

        if (!$film) {
            $film = new Film();
            $modeCreate = true;
        }else if ($user != $film->getUser()){
            die("Tu n'est pas le créateur du film");
        }

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($laRequete);
        if ($form->isSubmitted() && $form->isValid())
        {
            $film->setUser($user);

            $manager->persist($film);
            $manager->flush();

            return $this->redirectToRoute('showFilm', [
                "id" => $film->getId()
            ]);
        }else {
            return $this->render('film/form.html.twig', [
                'formFilm' => $form->createView(),
                'isCreate' => $modeCreate
            ]);
        }

    }

    /**
     * @Route("/film/imp/del/{id}", name="delImp")
     */
    public function delImp(Impression $impression, EntityManagerInterface $manager) : Response
    {
        $user = $this->getUser();
        if ($user == $impression->getUser()) {
            $film = $impression->getFilm();

            $manager->remove($impression);
            $manager->flush();

            return $this->redirectToRoute('showFilm', [
                "id" => $film->getId()
            ]);
        }else{
            die("Tu n'est pas le créateur de l'impression");
        }
    }

    /**
     * @Route ("/film/imp/edit/{id}", name="editImp")
     */
    public function editImp(Impression $impression, Request $laRequete, EntityManagerInterface $manager) : Response
    {
        $user = $this->getUser();
        if ($user == $impression->getUser()) {
            $form = $this->createForm(ImpressionType::class, $impression);

            $film = $impression->getFilm();

            $form->handleRequest($laRequete);
            if ($form->isSubmitted() && $form->isValid())
            {

                $manager->persist($impression);
                $manager->flush();

                return $this->redirectToRoute('showFilm', [
                    "id" => $film->getId()
                ]);
            }else {
                return $this->render('film/imp.html.twig', [
                    'formImp' => $form->createView(),
                    'film' => $film,
                    'isCreate' => false
                ]);
            }
        }else{
            die("Tu n'est pas le créateur de l'impression");
        }
    }

    /**
     * @Route("/film/imp/create/{id}", name="createImp")
     */
    public function newImp(Film $film, Request $laRequete, EntityManagerInterface $manager) : Response
    {
        $user = $this->getUser();
        if (!$user){
            die("tu dois etre connecter");
        }

        $impression = new Impression();

        $form = $this->createForm(ImpressionType::class, $impression);

        $form->handleRequest($laRequete);
        if ($form->isSubmitted() && $form->isValid())
        {
            $date = new \DateTime();
            $impression->setFilm($film);
            $impression->setCreatedAt($date);
            $impression->setUser($user);
            $manager->persist($impression);
            $manager->flush();

            return $this->redirectToRoute('showFilm', [
                "id" => $film->getId()
            ]);

        }else {
            return $this->render('film/imp.html.twig', [
                'formImp' => $form->createView(),
                'film' => $film,
                'isCreate' => true
            ]);
        }

    }

}
