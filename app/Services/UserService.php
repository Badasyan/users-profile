<?php

namespace App\Services;

use App\DTO\User\UserCreateDTO;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function registerUser(UserCreateDTO $dto): array
    {
        $hashedPassword = Hash::make($dto->password);

        $user =  $this->userRepository->create([
            'name'     => $dto->name,
            'email'    => $dto->email,
            'password' => $hashedPassword,
            'gender' => $dto->gender,
        ]);
        $token = $user->createToken('API Token')->plainTextToken;

        return ['user' => $user, 'token' => $token];

    }

    public function getUserById(int $userId): ?User
    {
        return $this->userRepository->findById($userId);
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }
}
