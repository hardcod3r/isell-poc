<?php

namespace Shop\Customer\Controllers;

use Shop\Customer\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shop\Customer\Services\CustomerService;

class CustomerController extends Controller
{

    public function __construct(private CustomerService $customerservice)
    {
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->customerservice->index();
    }
    /**
     * Display a listing collection only full names.
     */

    public function list()
    {
        return $this->customerservice->list();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        return $this->customerservice->store($id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->customerservice->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, Customer $customer)
    {
        $this->customerservice->update($data, $customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->customerservice->destroy($customer);
    }
}
