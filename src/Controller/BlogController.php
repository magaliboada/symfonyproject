<?php
// src/AppBundle/Controller/BlogController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
	/**
	* Matches /blog exactly
	*
	* @Route("/blog", name="blog_list")
	*/
	public function listAction()
	{
		return new Response(
	            '<html><body>Lucky number:</body></html>'
	        );
	}

    /**
     * Matches /blog/*
     * but not /blog/slug/extra-part
     *
     * @Route("/blog/{slug}", name="blog_show", requirements={"slug"="\d+"})
     * @param int $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function showAction($slug = 1)
	{
		return new Response(
	            $slug."1"
	        );
	}
	/**
	* Matches /blog/*
	* but not /blog/slug/extra-part
	*
	* @Route("/blog/{slug}/{second}", name="blog_show2")
	*/
	public function showAction2($slug, $second)
	{
		
		return new Response(
	            $slug.$second."2"
	        );
	}
}