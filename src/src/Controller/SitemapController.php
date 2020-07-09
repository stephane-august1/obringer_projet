<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use App\Repository\BlogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap",defaults={"_format"="xml"})
     */
    public function index(Request $request, BlogRepository $blogRepository, AvisRepository $aviRepository)
    {
        //récupère le nom de hote depuis l'url
        $hostname = $request->getSchemeAndHttpHost();
        //dd($hostname);

        //on initialise un tableau pour lister es URLs
        $urls = [];
        // ajout des URLs ""statiques push
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        $urls[] = ['loc' => $this->generateUrl('registration')];
        //dd($urls);

        // ajout des URLs ""dynamiques 

        //le blog
        $blog = $blogRepository->findAll();
        foreach ($blog as $article) {
            $images = [
                'loc' => '/uploads/images/' . $article->getImagesrc(),
                'title' => $article->getImagesrc()
            ];
            $textes = [
                'loc' => $article->getTexte()
            ];


            //on push le tous dans le tableau d'URLs
            $urls[] = [

                'loc' => $this->generateUrl('blog'),
                'image' => $images,
                'title' => $article->getTitle(),
                'texte' => $textes,
                'lastmod' => $article->getCreatedAt()->format('d-m-Y')
            ];
        }

        //les avis
        $avi = $aviRepository->findAll();
        foreach ($avi as $avis) {
            $urls[] = [
                'loc' => $this->generateUrl('avi', [
                    'id' =>   $avis->getId()
                ]),

            ];
        }
        // dd($urls);

        //Fabrication de la réponse
        $response = new Response(

            $this->renderView(
                'sitemap/index.html.twig',
                [
                    'urls' => $urls,
                    'hostname' => $hostname,
                ]
            ),

        );
        //ajout des entêtes HTTP
        $response->headers->set('Content-Type', 'text/xml');

        //on renvoi la reponse

        return $response;
    }
}
