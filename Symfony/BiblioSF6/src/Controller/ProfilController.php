<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Repository\LivreRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
final class ProfilController extends AbstractController
{
    #[Route(name: 'app_profil')]
    // On va vouloir sur l'index du profil, afficher les informations de l'utilisateur et de ses emprunts 
    public function index(): Response
    {
        // La ligne ci dessous n'est pas utile dans le cas de Symfony
        $abonneConnecte = $this->getUser();
        // En effet, dans Symfony, tout comme dans notre menu, je peux récupérer l'entité user via app.user
        // Dans notre cas, c'est notre entité abonné qui est le user ! Je peux ainsi récupérer toutes ses informations dans app.user 
        // $listeEmprunts = $abonneConnecte->getEmprunts();

        return $this->render('profil/index.html.twig', []);
    }

    // Une route pour permettre à l'utilisateur d'emprunter un livre (fictivement, car on s'attend à ce qu'il soit présent à la bibliothèque avec un employé pour emprunter un livre, ensuite, libre à nous de réfléchir à des améliorations de notre système)

    #[Route('/emprunter/{id}', name: 'app_profil_emprunter')]
    public function emprunter(Livre $livre, EntityManagerInterface $em, LivreRepository $lr)
    {

        $livres_non_dispo = $lr->livresNonDisponibles();

        // dd($livres_non_dispo);

        if (!in_array($livre, $livres_non_dispo)) {

            $emprunt = new Emprunt;
            $emprunt->setAbonne($this->getUser());
            $emprunt->setDateEmprunt(new DateTimeImmutable("now"));
            $emprunt->setLivre($livre);

            $em->persist($emprunt);
            $em->flush();

            $this->addFlash("success", "Le livre " . $livre->getTitre() . " de " . $livre->getAuteur() . " a bien été emprunté");
            return $this->redirectToRoute("app_profil");
        } else {
            $this->addFlash("danger", "Le livre " . $livre->getTitre() . " de " . $livre->getAuteur() . " n'est pas disponible !");
            return $this->redirectToRoute("app_home");
        }
    }
}
