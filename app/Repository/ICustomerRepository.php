<?php

namespace App\Repository;
interface ICustomerRepository
{
    public function getCustomerList();

    public function getCustomerById($id);

    public function createOrUpdate($id = null, $collection = []);

    public function deleteCustomer($id);
}
