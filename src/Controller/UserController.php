<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ImageServiceInterface;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private UserServiceInterface $userService;
    private ImageServiceInterface $imageService;
    public function __construct(UserServiceInterface $userService, ImageServiceInterface $imageService)
    {
       $this->userService = $userService;
       $this->imageService = $imageService;
    }

    public function index(): Response
    {
        return $this->render('user/registerUser.html.twig');
    }
    
    public function list(): Response
    {
        $users = $this->userService->list();
        return $this->render('user/list.html.twig', [
            'user_list' => $users
         ]);
    }
        

    public function updateForm(Request $request): Response
    {
        $user = $this->userService->viewUser($request->get('id'));
        $dateString = $user->getBirthDate();
        $newDate = date("Y-m-d", strtotime($dateString));
        return $this->render('user/updateUser.html.twig', [
           'user' => $user, 'new_date' => $newDate,
        ]);
    }    
    
    public function edit(Request $request): Response
    {
        $id = $request->get('id');
        $user = $this->userService->viewUser($id);
        if (!$user)
        {
            throw $this->createNotFoundException();
        }
        $avatarPath = $user->getAvatarPath();
        if ($request->files->get('avatar_path') !== null)
        {
            $newAvatar = $this->imageService->moveImageToUploads($request->files->get('avatar_path'));
            $this->userService->editUser(
                $request->get('id'),
                $request->get('first_name'),
                $request->get('last_name'),
                $request->get('middle_name'),
                $request->get('gender'),
                $request->get('birth_date'),
                $request->get('email'),
                $request->get('phone'),
                $newAvatar,
            );
        } else 
        {
            $this->userService->editUser(
                $request->get('id'),
                $request->get('first_name'),
                $request->get('last_name'),
                $request->get('middle_name'),
                $request->get('gender'),
                $request->get('birth_date'),
                $request->get('email'),
                $request->get('phone'),
                $avatarPath,
            );
        } 
        return $this->redirectToRoute('view_user', ['id' => $id], Response::HTTP_SEE_OTHER);  
    }

    public function registerUser(Request $request): Response
    {
        $avatarPath = $this->imageService->moveImageToUploads($request->files->get('avatar_path'));
        $id = $this->userService->registerUser(
            $request->get('first_name'), 
            $request->get('last_name'), 
            $request->get('middle_name'), 
            $request->get('gender'), 
            $request->get('birth_date'), 
            $request->get('email'), 
            $request->get('phone'), $avatarPath);
        
        return $this->redirectToRoute('view_user', ['id' => $id], Response::HTTP_SEE_OTHER);    
    }

    public function viewUser($id): Response
    {
        $user = $this->userService->viewUser($id);
        if (!$user)
        {
            throw $this->createNotFoundException();
        }

        return $this->render('user/userPage.html.twig', [
            'user' => $user
         ]);
    }

    public function deleteUser(Request $request): Response
    {
        $user = $this->userService->viewUser($request->get('id'));
        if (!$user)
        {
            throw $this->createNotFoundException();
        }
        $this->imageService->deleteFileFromUploads($request->get('avatar_path'));
        $this->userService->deleteUser($user);
        return $this->redirectToRoute('user_list', ['id' => $request->get('id')], Response::HTTP_SEE_OTHER);
    }
}
?>