<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ThePlatformController.
 */
class ThePlatformController extends AbstractController
{
   /**
    * @Route("/", name="home_page")
    */
    public function homePage(): Response
    {
        return $this->render('home-page/home.html.twig');
    }
}
