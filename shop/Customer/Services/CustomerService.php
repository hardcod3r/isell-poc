<?php

namespace Shop\Customer\Services;

use Shop\Customer\Models\Customer;
use Shop\User\Tasks\NewUser;

class CustomerService
{
    public function index(): array
    {
        $customers = Customer::latest()->take(5)->get(['id', 'first_name', 'last_name', 'created_at'])->toArray();
        return $customers;
    }
    public function show(int $id): Customer
    {
        $customer = Customer::where('id', $id)->first();
        return $customer;
    }

    public function store(array $customerData): Customer
    {
        isset($customerData['last_name']) ?? fake()->lastName();
        isset($customerData['first_name']) ?? fake()->firstName();
        $user = app(NewUser::class)->run($customerData);
        $customerData['user_id'] = $user->id;
        $customer = Customer::create($customerData);
        return $customer;
    }

    public function update(array $customerData, Customer $customer): Customer
    {
        $customer->update($customerData);
        return $customer;
    }
    public function destroy(Customer $customer): bool
    {
        return $customer->delete();
    }

    public function list(): array
    {
        $customers = Customer::all()->pluck('full_name', 'id')->toArray();
        return $customers;
    }
}
