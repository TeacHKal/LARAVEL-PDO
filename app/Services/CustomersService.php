<?php
/**
 * Created by PhpStorm.
 * User: teach
 * Date: 11/29/2017
 * Time: 5:11 PM
 */

namespace App\Services;

use App\Models\Customer;
use App\Classes\CustomerCreateTable;

class CustomersService
{

    private $BONUS_RATE = 3;

    /**
     * CustomersService constructor.
     */
    public function __construct(){}

    /**
     * @param $id
     * @return array
     */
    public function getCustomer($id)
    {
        $customer = new Customer;
        return $customer->getCustomer($id);
    }


    /**
     * @param $gender
     * @param $firstName
     * @param $lastName
     * @param $country
     * @param $email
     * @return array
     */
    public function addCustomer($gender, $firstName, $lastName, $country, $email)
    {
        $customer = new Customer;
        return $customer->store($gender, $firstName, $lastName, $country, $email);
    }


    /**
     * @param $id
     * @param $gender
     * @param $firstName
     * @param $lastName
     * @param $country
     * @param $email
     * @return array
     */
    public function updateCustomer($id, $gender, $firstName, $lastName, $country, $email)
    {
        $customer = new Customer;
        return $customer->updateCustomer($id, $gender, $firstName, $lastName, $country, $email);

    }

    public function depositAmount($id, $amount)
    {
        $customer = new Customer;
        return $customer->depositAmount($id, $amount, $this->BONUS_RATE);
    }

    public function withdrawAmount($id, $amount)
    {
        $customer = new Customer;
        return $customer->withdrawAmount($id, $amount);
    }

    public function customerReports($timeFrameDate)
    {
        $customer = new Customer();
        return $customer->getCustomerTimeFrameReport($timeFrameDate);
    }

    public function createCustomersTable()
    {
        CustomerCreateTable::createCustomerTable();
    }


}