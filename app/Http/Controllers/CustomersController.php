<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\CustomersService;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.cd
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            Customer::$GENDER => 'required',
            Customer::$FIRST_NAME => 'required',
            Customer::$LAST_NAME => 'required',
            Customer::$COUNTRY => 'required',
            Customer::$EMAIL => 'email',
        ]);

        $customersService = new CustomersService();

        return $customersService->addCustomer($request[Customer::$GENDER], $request[Customer::$FIRST_NAME],
            $request[Customer::$LAST_NAME], $request[Customer::$COUNTRY], $request[Customer::$EMAIL]);
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customersService = new CustomersService();
        return $customersService->getCustomer($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            Customer::$GENDER => 'required',
            Customer::$FIRST_NAME => 'required',
            Customer::$LAST_NAME => 'required',
            Customer::$COUNTRY => 'required',
            Customer::$EMAIL => 'required|email',
        ]);

        $customersService = new CustomersService();
        return $customersService->updateCustomer($id, $request[Customer::$GENDER], $request[Customer::$FIRST_NAME],
            $request[Customer::$LAST_NAME], $request[Customer::$COUNTRY], $request[Customer::$EMAIL]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Create the CustomerTable
     *
     * @return \Illuminate\Http\Response
     */
    public function createTable()
    {
        $customerService = new CustomersService();
        return $customerService->createCustomersTable();
    }

    /**
     * @param \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function depositMoney(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);
        $customerService = new CustomersService();
        return $customerService->depositAmount($id, $request['amount']);
    }

    /**
     * @param \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function withdrawMoney(Request $request, $id)
    {
        $customerService = new CustomersService();
        return $customerService->withdrawAmount($id, $request['amount']);
    }

    /**
     * @param int $timeFrameDate
     * @return \Illuminate\Http\Response
     */
    public function customersReport($timeFrameDate = 7)
    {
        $customerService = new CustomersService();
        return $customerService->customerReports($timeFrameDate);
    }



}
