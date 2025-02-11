<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function findById(int $id): ?User;
    public function all(): Collection;
}
