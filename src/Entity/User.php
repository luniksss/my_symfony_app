<?php
declare(strict_types=1);
namespace App\Entity;

class User
{
   public function __construct(
    private ?int $id,  
    private string $firstName, 
    private string $lastName, 
    private ?string $middleName, 
    private string $gender, 
    private ?string $birth_date, 
    private string $email, 
    private ?string $phone, 
    private ?string $avatarPath)
   {
   }

   public function getUserId(): ?int
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

   public function setUserId(int $id): void
   {
       $this->id = $id;
   }

   public function setFirstName(string $firstName): void
   {
        $this->firstName = $firstName;
   }

   public function setLastName(string $lastName): void
   {
       $this->lastName = $lastName;
   }
   public function setMiddleName(string $middleName): void
   {
       $this->middleName = $middleName;
   }
   public function setGender(string $gender): void
   {
       $this->gender = $gender;
   }
   public function setBirthDate(string $birth_date): void
   {
       $this->birth_date = $birth_date;
   }
   public function setEmail(string $email): void
   {
       $this->email = $email;
   }
   public function setPhone(string $phone): void
   {
       $this->phone = $phone;
   }
   public function setAvatarPath(string $avatarPath): void
   {
        $this->avatarPath = $avatarPath;
   }
}

?>