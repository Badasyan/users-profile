<?php

namespace App\Http\Controllers;

use App\DTO\User\ProfileUserDTO;
use App\DTO\User\UserCreateDTO;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserStoreRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{

    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'status' => 'success',
            'data'   => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {

        $dto = new UserCreateDTO(
            name: $request->validated()['name'],
            email: $request->validated()['email'],
            password: $request->validated()['password'],
            gender: $request->validated()['gender'],
        );

        $data = $this->userService->registerUser($dto);
        $user = $data['user'];

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
                'gender' => $user['gender'],
                'token'  => $data['token'],
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfileRequest $userProfileRequest): JsonResponse
    {
        $dto =new ProfileUserDTO(
            id: $userProfileRequest->getUserId(),
        );

        $user = $this->userService->getUserById((int)$dto->id);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
                'gender' => $user['gender']
            ]
        ], 200);
    }
}
