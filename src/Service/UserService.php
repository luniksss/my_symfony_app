<?php
namespace App\Service;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Service\Data\UserData;
use App\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(string $firstName, string $lastName, ?string $middleName, string $gender, ?string $birth_date, string $email, ?string $phone, ?string $avatarPath): int 
    {
        $user = new User(
            null, 
            $firstName, 
            $lastName, 
            $middleName, 
            $gender, 
            $birth_date, 
            $email, 
            $phone, 
            $avatarPath);

        return $this->userRepository->store($user);
    }

    public function viewUser($id): ?UserData
    {
        $user = $this->userRepository->findById($id);
        return ($user === null) ? null: new UserData(
            $user->getUserId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getMiddleName(),
            $user->getGender(),
            $user->getBirthDate(),
            $user->getEmail(),
            $user->getPhone(),
            $user->getAvatarPath(),
        );
    }
    public function deleteUser($userData): void
    {
        $id = $userData->getUserId();
        $user = $this->userRepository->findById($id);
        $this->userRepository->delete($user);
    }

    public function editUser(string $id, string $firstName, string $lastName, ?string $middleName, string $gender, ?string $birth_date, string $email, ?string $phone, ?string $newAvatar): void
    {
        $user = $this->userRepository->findById($id);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setMiddleName($middleName);
        $user->setGender($gender);
        $user->setBirthDate($birth_date);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setAvatarPath($newAvatar); 
        $this->userRepository->store($user);       
    }

    public function list(): array
    {
        $users = $this->userRepository->listAll();
        $usersList = [];
        foreach ($users as $user)
        {
            $usersList[] = [
                'id' => $user->getUserId(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'middle_name' => $user->getMiddleName(),
                'gender' => $user->getGender(),
                'birth_date' => $user->getBirthDate(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'avatar_path' => $user->getAvatarPath(),
            ];
        }
        return $usersList;
    }
}
?>
