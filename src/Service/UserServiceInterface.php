<?php
namespace App\Service;

use App\Entity\User;
use App\Service\Data\UserData;

interface UserServiceInterface
{
    public function registerUser(string $firstName, string $lastName, ?string $middleName, string $gender, ?string $birth_date, string $email, ?string $phone, ?string $avatarPath): int; 
    public function viewUser(int $id): ?UserData;
    public function deleteUser($user): void;
    // public function uploadForm($id): ?User;
    public function editUser(string $id, string $firstName, string $lastName, ?string $middleName, string $gender, ?string $birth_date, string $email, ?string $phone, ?string $avatarPath): void;
    public function list(): array;
}