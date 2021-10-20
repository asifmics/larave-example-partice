<?php

namespace App\Repository;
use App\Models\Customer;

Class CustomerRepository implements ICustomerRepository{
    protected $customer = [];
    public function getCustomerList()
    {
        // TODO: Implement getCustomerList() method.
       return Customer::all();
    }
    public function getCustomerById($id)
    {
        // TODO: Implement getCustomerById() method.
    }
    public function createOrUpdate($id = null, $collection = [])
    {
        // TODO: Implement createOrUpdate() method.
    }

    public function deleteCustomer($id)
    {
        // TODO: Implement deleteCustomer() method.
    }
}
