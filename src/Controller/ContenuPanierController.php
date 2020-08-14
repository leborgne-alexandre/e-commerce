<?php

namespace App\Controller;


use App\Entity\ContenuPanier;
use App\Form\ContenuPanierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/panier")
 */

class ContenuPanierController extends AbstractController
{
    /**
    * @Route("/", name="contenu_panier")
    */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $panier = $em->getRepository(ContenuPanier::class)->findAll();

        return $this->render('contenu_panier/index.html.twig', [
            'paniers'      => $panier
        ]);
    }


    /**
     * @Route("/delete/{id}", name="panier_delete")
     */
    public function delete(ContenuPanier $panier = null, TranslatorInterface $translator)
    {

        if ($panier != null) {

            $em = $this->getDoctrine()->getManager();
            $em->remove($panier);
            $em->flush();
            $this->addFlash('warning', $translator->trans('Produit supprimé'));
        } else {
            $this->addFlash('danger', $translator->trans('Produit introuvable'));
        }

        return $this->redirectToRoute('home');
    }
}
