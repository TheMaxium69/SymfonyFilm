<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}
