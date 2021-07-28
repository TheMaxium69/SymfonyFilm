<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/telephone/create/", name="telephoneCreate")
     * @Route ("/telephone/edit/{id}", name="telephoneEdit")
     */
    public function new(Telephone $telephone = null, Request $laRequete, EntityManagerInterface $manager) : Response
    {
        $modeCreate = false;

        if (!$telephone) {
            $telephone = new Telephone();
            $modeCreate = true;
        }

        $form = $this->createForm(TelephoneType::class, $telephone);

        $form->handleRequest($laRequete);
        if ($form->isSubmitted() && $form->isValid())
        {

            $manager->persist($telephone);
            $manager->flush();

            return $this->redirectToRoute('telephoneShow', [
                "id" => $telephone->getId()
            ]);
        }else {
            return $this->render('telephone/form.html.twig', [
                'formTelephone' => $form->createView(),
                'isCreate' => $modeCreate
            ]);
        }

    }

}
