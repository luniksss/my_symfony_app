<?php
declare(strict_types=1);
namespace App\Service\Data;

class UserData
{
   public function __construct(
    private int $id,  
    private string $firstName, 
    private string $lastName, 
    private ?string $middleName, 
    private string $gender, 
    private ?string $birth_date, 
    private string $email, 
    private ?string $phone, 
    private ?string $avatarPath)
   {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->gender = $gender;
        $this->birth_date = $birth_date;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatarPath = $avatarPath;
   }

   public function getUserId(): int
   {
       return $this->id;
   }

   public function getFirstName(): string
   {
       return $this->firstName;
   }

   public function getLastName(): string
   {
       return $this->lastName;
   }
   public function getMiddleName(): ?string
   {
       return $this->middleName;
   }
   public function getGender(): string
   {
       return $this->gender;
   }
   public function getBirthDate(): ?string
   {
       return $this->birth_date;
   }
   public function getEmail(): string
   {
       return $this->email;
   }
   public function getPhone(): ?string
   {
       return $this->phone;
   }
   public function getAvatarPath(): ?string
   {
       return $this->avatarPath;
   }
}

?>