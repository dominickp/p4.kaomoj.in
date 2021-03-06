<?php

namespace Dominick\ImageboardBundle\Controller;

// Stuff for DB insert
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dominick\ImageboardBundle\Entity\Thread;
use Dominick\ImageboardBundle\Entity\Reply;
use Dominick\ImageboardBundle\Image\ResizeImage;
use Dominick\ImageboardBundle\Entity\User;
use Dominick\ImageboardBundle\Entity\Role;
use Symfony\Component\HttpFoundation\Response;

// Login/Security
use Symfony\Component\Security\Core\SecurityContext;

// Forms
use Symfony\Component\HttpFoundation\Request;

class ReplyController extends Controller
{
	public function indexAction()
	{
		return 'Hello World';
	}

	public function newAction(Request $request, $id)
	{
		// = $this->container->get('request');
		$session = $request->getSession();
		$session->start();

		$reply = new Reply();

		$form = $this->createFormBuilder($reply)
			->add('message', 'textarea', array('required' => false))
			->add('image', 'file', array('required' => false))

			->add('Reply', 'submit')
			->getForm();

		$form->handleRequest($request);


		if ($form->isValid())
		{

			$reply = $form->getData();


			// Do these operations if image was submitted
			if(is_object($form['image']->getData())){
				// Move to this directory once upload is successful
				$dir =  $this->get('kernel')->getRootDir() . '/../web'.'/img_data/reply/';
				// Sanitize and keep the original file name
				$originalImageName = time().'_'.htmlspecialchars($form['image']->getData()->getClientOriginalName());
				// Move to the thread image directory
				$form['image']->getData()->move($dir, $originalImageName);
				// Set MD5 of the image
				$reply->setMd5(md5_file($dir.$originalImageName));
				// Set filesize of the image
				$reply->setSize(filesize($dir.$originalImageName));
				// Set the file name in the database
				$reply->setImage($originalImageName);

				// Now work on the thumbnail
				$resize = new ResizeImage($dir.$originalImageName);
				$resize->resizeTo(180, 180, 'maxWidth');
				$resize->saveImage($dir.'thumb_'.$originalImageName);

				// Save thumbnail name to the database
				$reply->setThumbnail('thumb_'.$originalImageName);

			}

			// Get and set the current thread
			$thread = $this->getDoctrine()
				->getRepository('DominickImageboardBundle:Thread')
				//    ->findAll();
				->findOneBy(
					array('id' => $id) // $where
				);
			$reply->setThread($thread);

			// Get and set the current user
			$currentUser = $this->getUser();
			$reply->setUser($currentUser);

            // Set thread as updated
            $reply->getThread()->setUpdated(new \DateTime("now"));

			$em = $this->getDoctrine()->getManager();

			// Save the new thread
			$em->persist($reply);
			$em->flush();

			return $this->redirect($this->generateUrl('imageboard_thread_view', array('id' => $id)));
		}

		return $this->render('DominickImageboardBundle:Reply:reply_new.html.twig', array(
			'form' => $form->createView(),
            'id' => $id,
		));
	}

	public function deleteAction($threadId, $replyId){
		$em = $this->getDoctrine()->getManager();
		$thread = $this->getDoctrine()->getRepository('DominickImageboardBundle:Reply')
			->findOneBy(array(
				'id'=>$replyId,
				'thread'=>$threadId
			));

		$em->remove($thread);
		$em->flush();

		return $this->redirect($this->generateUrl('imageboard_thread_view', array('id' => $threadId)));

	}

}