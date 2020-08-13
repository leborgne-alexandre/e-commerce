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
    public function index(Request $request, TranslatorInterface $translator)
    {
        $em = $this->getDoctrine()->getManager();

        $panier = new ContenuPanier();
        $form = $this->createForm(ContenuPanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($panier);
            $em->flush();

            $this->addFlash('success', $translator->trans('Panier crée'));
        }
        $panier = $em->getRepository(ContenuPanier::class)->findAll();

        return $this->render('contenu_panier/index.html.twig', [
            'paniers' => $panier,
            'ajout_panier' => $form->createView()
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
