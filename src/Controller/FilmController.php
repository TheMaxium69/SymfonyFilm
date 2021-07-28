<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
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
        return $this->render('film/show.html.twig', [
            'showFilm' => $film,
        ]);
    }

    /**
     * @Route("/film/del/{id}", name="delFilm")
     */
    public function del(Film $film, EntityManagerInterface $manager) : Response
    {

        $manager->remove($film);
        $manager->flush();

        return $this->redirectToRoute('indexFilm');
    }

    /**
     * @Route("/film/create/", name="createFilm")
     * @Route ("/film/edit/{id}", name="editFilm")
     */
    public function new(Film $film = null, Request $laRequete, EntityManagerInterface $manager) : Response
    {
        $modeCreate = false;

        if (!$film) {
            $film = new Film();
            $modeCreate = true;
        }

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($laRequete);
        if ($form->isSubmitted() && $form->isValid())
        {

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

}
