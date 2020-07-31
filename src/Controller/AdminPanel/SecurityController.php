<?php

namespace App\Controller\AdminPanel;

use App\Entity\User;
use App\Form\AdminPanel\Security\ForgotPasswordType;
use App\Form\AdminPanel\Security\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="crm_login")
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('adminPanel/security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="crm_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/forgot-password", name="crm-forgot-password")
     * @param Request                $request
     *
     * @param EntityManagerInterface $em
     *
     * @param \Swift_Mailer          $mailer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function forgotPassword(Request $request, EntityManagerInterface $em, \Swift_Mailer $mailer, AuthenticationUtils $authenticationUtils)
    {
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $email = $form->getData();
            $user = $em->getRepository(User::class)->findOneBy(['email' => $email->getEmail()]);
            $token = $request->request->get('forgot_password')['_token'];

            if (!empty($user) && $token) {
                $local = $_SERVER['SITE_BASE_URL'];
                $suffix = "/mb-crm/admin/reset-password?user=" . "&token=" . $token . '';
                $url = "<a href='$local . $suffix'>'Create new password'<a>";

                $message = (new \Swift_Message('New Password'))
                    ->setFrom($_SERVER['EMAIL'])
                    ->setTo($user->getEmail())
                    ->setBody($url, 'text/html');

                $mailer->send($message);

            $user->setToken($token);
            $em->persist($user);
            $em->flush();

               return $this->render('adminPanel/security/goChangePassword.html.twig');
            }


            $this->addFlash('error', 'Oh no! It doesn\'t look like that email exists!');
        }



        return $this->render('adminPanel/security/forgotPassword.html.twig', [
            'formForgotPassword' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reset-password", name="crm-reset-password")
     * @param Request                      $request
     * @param EntityManagerInterface       $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function resetPassword(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $email = $request->get('user');
        $token = $request->get('token');

        if (!empty($email) && !empty($token)) {

            $user = $em->getRepository(User::class)->findOneBy(['email' => $email, 'token' => $token]);

            if (!empty($user)) {

                $form = $this->createForm(ResetPasswordType::class);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $passwordModel = $form->getData();
                        $user->setPassword(
                            $passwordEncoder->encodePassword(
                                $user,
                                $passwordModel->plainPassword
                            )
                        );
                        $user->setToken(null);

                        $em->persist($user);
                        $em->flush();

                        return $this->redirectToRoute('crm_login');
                    }

                return $this->render('adminPanel/security/resetPassword.html.twig', [
                    'formResetPassword' => $form->createView(),
                ]);
            }

        }

        return $this->redirectToRoute('crm-forgot-password');
    }

}