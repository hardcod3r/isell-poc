<?php


namespace Shop\User\Tasks;

use Shop\User\Models\User;
use Illuminate\Support\Str;

/**
 * @return User
 * @throws Exception
 */
class NewUser
{
    public function __construct(
        protected User $user
    ) {
    }
    public function run($data): User|string
    {
        try {
            if (!isset($data['password'])) {
                $data['password'] = bcrypt('password');
            }
            if (!isset($data['email'])) {
                $data['email'] = fake()->unique()->safeEmail();
            }
            $user = $this->user->create($data);
            return $user;
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            return  $exception->getMessage();
        }
    }
}
