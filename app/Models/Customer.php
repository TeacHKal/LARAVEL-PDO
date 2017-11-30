<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\PDOhelper;
use App\Classes\Response;
use PDO;

class Customer extends Model
{
    // Table name
    protected $TABLE = 'customers';

    private $MIN_BONUS_PCT = 5;
    private $MAX_BONUS_PCT = 20;

    private $id;
    private $created_at;
    private $amount_changed_at;
    private $gender;
    private $first_name;
    private $last_name;
    private $country;
    private $email;
    private $current_amount;
    private $bonus_amount;
    private $deposit_amount;
    private $withdrawal_amount;
    private $no_of_deposits;
    private $no_of_withdrawals;
    private $bonus_pct;


    /**
     * Every constant represent one column in the database
     */
    public static $ID = 'id';
    public static $CREATED_AT = 'created_at';
    public static $AMOUNT_CHANGED_AT = 'amount_changed_at';
    public static $GENDER = 'gender';
    public static $FIRST_NAME = 'first_name';
    public static $LAST_NAME = 'last_name';
    public static $COUNTRY = 'country';
    public static $EMAIL = 'email';
    public static $AMOUNT = 'amount';
    public static $BONUS_AMOUNT = 'bonus_amount';
    public static $DEPOSIT_AMOUNT = 'deposit_amount';
    public static $WITHDRAWAL_AMOUNT = 'withdrawal_amount';
    public static $NO_OF_DEPOSITS = 'no_of_deposits';
    public static $NO_OF_WITHDRAWALS = 'no_of_withdrawals';
    public static $BONUS_PCT = "bonus_pct";

    /**
     * Constant strings for reports
     */
    public static $DATE_STR = "Date";
    public static $COUNTRY_STR = "Country";
    public static $UNIQUE_CUSTOMERS_STR = "Unique Customers";
    public static $NO_OF_DEPOSITS_STR = "No of Deposits";
    public static $TOTAL_DEPOSIT_AMOUNT_STR = "Total Deposit Amount";
    public static $NO_OF_WITHDRAWALS_STR = "No of Withdrawals";
    public static $TOTAL_WITHDRAWAL_AMOUNT_STR = "Total Withdrawal Amount";


    /**
     * Customer constructor.
     * @param null $data
     * @param null $id
     */
    public function __construct($data = null, $id = null)
    {
        if($data == null){
            return;
        }
        $this->id = $id;
        $this->created_at = $data[self::$CREATED_AT];
        $this->amount_changed_at = $data[self::$AMOUNT_CHANGED_AT];
        $this->gender = $data[self::$GENDER];
        $this->first_name = $data[self::$FIRST_NAME];
        $this->last_name = $data[self::$LAST_NAME];
        $this->country = $data[self::$COUNTRY];
        $this->email = $data[self::$EMAIL];
        $this->current_amount = $data[self::$AMOUNT];
        $this->bonus_amount = $data[self::$BONUS_AMOUNT];
        $this->deposit_amount = $data[self::$DEPOSIT_AMOUNT];
        $this->withdrawal_amount = $data[self::$WITHDRAWAL_AMOUNT];
        $this->no_of_deposits = $data[self::$NO_OF_DEPOSITS];
        $this->no_of_withdrawals = $data[self::$NO_OF_WITHDRAWALS];
        $this->bonus_pct = $data[self::$BONUS_PCT];
    }


    /**
     * store
     *
     * Create new customer
     *
     * @param $gender
     * @param $firstName
     * @param $lastName
     * @param $country
     * @param $email
     * @return array
     */
    public function store($gender, $firstName, $lastName, $country, $email)
    {

        $pdo = PDOhelper::instance()->getPDOObject();

        if(!$this->isEmailTaken($email)){
            return Response::response(false, "Email is already in use");
        }

        $sql = "INSERT INTO `{$this->TABLE}` ( `" .
                self::$GENDER  . "`, `" .
                self::$FIRST_NAME  . "`, `" .
                self::$LAST_NAME  . "`, `" .
                self::$COUNTRY  . "`, `" .
                self::$BONUS_PCT  . "`, `" .
                self::$EMAIL  . "`) 
            VALUES (:genderValue, :firstNameValue, :lastNameValue, :countryValue, :bonusPctValue, :emailValue)";

        $statement = $pdo->prepare($sql);

        $statement->bindValue(':genderValue', $gender);
        $statement->bindValue(':firstNameValue', $firstName);
        $statement->bindValue(':lastNameValue', $lastName);
        $statement->bindValue(':countryValue', $country);
        $statement->bindValue(':bonusPctValue', rand($this->MIN_BONUS_PCT, $this->MAX_BONUS_PCT));
        $statement->bindValue(':emailValue', $email);

        $inserted = $statement->execute();

        if($inserted){
            return Response::response(true, "Customer added");
        }
        return Response::response(false, "Customer is NOT added");

    }


    /**
     * isEmailValid
     *
     * Check if email is already in use
     *
     * @param $email
     * @param $pdo
     * @return bool
     */
    private function isEmailTaken($email)
    {
        $pdo = PDOhelper::instance()->getPDOObject();
        try {
            $sql = "SELECT " . self::$EMAIL . " FROM {$this->TABLE} WHERE " . self::$EMAIL . " = '" . $email . "';";
            $rows = $pdo->query($sql)->fetch();
        }
        catch(Exception $e){
            return Response::response(false, "Couldn't verify email. Error: {$e->getMessage()}");
        }

        if($rows > 0)
        {
            return false;
        }
        return true;
    }


    /**
     * getCustomer
     *
     * Return a customer
     *
     * @param $id
     * @return array
     */
    public function getCustomer($id)
    {
        $pdo = PDOhelper::instance()->getPDOObject();
        try {
            $sql = "SELECT " .
                self::$ID . ", " .
                self::$CREATED_AT . ", " .
                self::$AMOUNT_CHANGED_AT . ", " .
                self::$GENDER . ", " .
                self::$FIRST_NAME . ", " .
                self::$LAST_NAME . ", " .
                self::$COUNTRY . ", " .
                self::$EMAIL . ", " .
                self::$AMOUNT . ", " .
                self::$BONUS_AMOUNT . ", " .
                self::$DEPOSIT_AMOUNT . ", " .
                self::$WITHDRAWAL_AMOUNT . ", " .
                self::$NO_OF_DEPOSITS . ", " .
                self::$NO_OF_WITHDRAWALS . ", " .
                self::$BONUS_PCT .
                " FROM {$this->TABLE} WHERE " . self::$ID . " = '" . $id . "' LIMIT 1;";


            $statement = $pdo->prepare($sql);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            return Response::response(false, "Customer data is returned. Error: {$e->getMessage()}");
        }
        if($row > 0){
            return Response::response(true, "Customer data is returned", $row);
        }
        return Response::response(false, "There is no customer with id = " . $id);
    }


    /**
     * updateCustomer
     *
     * Update customer details
     *
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
        $pdo = PDOhelper::instance()->getPDOObject();
        $isEmailTaken = $this->isEmailTaken($email);
        $customerEmailInDb = $this->getCustomerEmail($id);
        if($isEmailTaken && ($customerEmailInDb != $email) ){
            return Response::response(false, "Email is not valid");
        }

        try {
            $sql = "UPDATE `{$this->TABLE}` SET `" .
                self::$GENDER . "` = :genderValue, `" .
                self::$FIRST_NAME . "` = :firstNameValue, `" .
                self::$LAST_NAME . "` = :lastNameValue, `" .
                self::$COUNTRY . "` = :countryValue, `" .
                self::$EMAIL . "` = :emailValue 
             WHERE " . self::$ID . " = '" . $id . "'";

            $statement = $pdo->prepare($sql);

            $statement->bindValue(':genderValue', $gender);
            $statement->bindValue(':firstNameValue', $firstName);
            $statement->bindValue(':lastNameValue', $lastName);
            $statement->bindValue(':countryValue', $country);
            $statement->bindValue(':emailValue', $email);
            $statement->execute();
        }

        catch(Exception $e){
            return Response::response(false, "Customer details are NOT updated. Error: {$e->getMessage()}");
        }

        if ($statement->rowCount()){
            return Response::response(true, "Customer details are updated");
        } else{
            return Response::response(false, "Customer details are NOT updated");
        }
    }


    /**
     * depositAmount
     *
     * Deposit amount into customer's 'amount'
     * Deposit (if bonus is allowed) bonus into customer's 'bonus_amount'
     * Update time of last deposit 'amount_changed_at'
     *
     * @param $id
     * @param $amount
     * @param $bonusRate
     * @return array
     */
    public function depositAmount($id, $amount, $bonusRate)
    {
        $pdo = PDOhelper::instance()->getPDOObject();
        $pdo->beginTransaction();

        try {
            $bonusAmount = 0;
            $noOfCurrentDeposits = $this->getNoOfDeposits($id) + 1;
            $bonusPct = $this->getBonusPct($id);
            $bonusMultiplier = $bonusPct / 100;

            if ($noOfCurrentDeposits % $bonusRate == 0) {
                $bonusAmount = $amount * $bonusMultiplier;
            }

            $sql = "UPDATE {$this->TABLE} SET " .
                self::$AMOUNT . " = " . self::$AMOUNT . " + '{$amount}'," .
                self::$BONUS_AMOUNT . " = " . self::$BONUS_AMOUNT . " + '{$bonusAmount}'," .
                self::$NO_OF_DEPOSITS . " = " . self::$NO_OF_DEPOSITS . " + '1'," .
                self::$AMOUNT_CHANGED_AT . " = now()
             WHERE " . self::$ID . " = '{$id}'";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pdo->commit();

            return Response::response(true, "Money is deposited");
        }
    catch(Exception $e){
        $pdo->rollBack();
        return Response::response(false, "Amount is NOT deposited. Error: {$e->getMessage()}");
    }



    }

    /**
     * getNoOfDeposits
     *
     * Return customer's number of deposits
     *
     * @param $id
     * @return mixed
     */
    private function getNoOfDeposits($id)
    {
        $pdo = PDOhelper::instance()->getPDOObject();
        try {
            $sql = "SELECT " . self::$NO_OF_DEPOSITS . " FROM {$this->TABLE} WHERE " . self::$ID . " = '" . $id . "';";
            $result = $pdo->query($sql)->fetch();
        }
        catch(Exception $e){
            return Response::response(false, "Could not retrieve number of deposits. Error: {$e->getMessage()}");
        }

        return $result[self::$NO_OF_DEPOSITS];
    }


    /**
     * getBonusPct
     *
     * Return customer's bonus percent
     *
     * @param $id
     * @return mixed
     */
    private function getBonusPct($id)
    {
        $pdo = PDOhelper::instance()->getPDOObject();

        $sql = "SELECT " . self::$BONUS_PCT ." FROM {$this->TABLE} WHERE " . self::$ID . " = '" . $id . "';";
        $result = $pdo->query($sql)->fetch();

        return $result[self::$BONUS_PCT];
    }

    /**
     * @param $id
     * @param $amount
     * @return array
     */
    public function withdrawAmount($id, $amount)
    {
        $pdo = PDOhelper::instance()->getPDOObject();
        $pdo->beginTransaction();
        try {
            $sql = "UPDATE {$this->TABLE} SET " .
                self::$AMOUNT . " = " . self::$AMOUNT . " - '{$amount}'," .
                self::$WITHDRAWAL_AMOUNT . " = " . self::$WITHDRAWAL_AMOUNT . " - '{$amount}'," .
                self::$NO_OF_WITHDRAWALS . " = " . self::$NO_OF_WITHDRAWALS . " + '1'," .
                self::$AMOUNT_CHANGED_AT . " = now()
             WHERE " . self::$ID . " = '{$id}' AND " . self::$AMOUNT . " >= {$amount}";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pdo->commit();

            if ($stmt->rowCount()){
                return Response::response(true, "Money is withdrawn");
            } else{
                return Response::response(false, "Amount is NOT withdrawn. Possible not enough amount to withdraw");
            }
        }
        catch(Exception $e){
            $pdo->rollBack();
            return Response::response(false, "Amount is NOT withdrawn. Error: {$e->getMessage()}");
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomerEmail($id)
    {
        $pdo = PDOhelper::instance()->getPDOObject();

        $sql = "SELECT " . self::$EMAIL ." FROM {$this->TABLE} WHERE " . self::$ID . " = '" . $id . "';";
        $result = $pdo->query($sql)->fetch();

        return $result[self::$EMAIL];
    }

    /**
     * @param $timeFrameDate
     * @return array
     */
    public function getCustomerTimeFrameReport($timeFrameDate)
    {
        $pdo = PDOhelper::instance()->getPDOObject();

        $sql = "SELECT 
            DATE(NOW() - INTERVAL {$timeFrameDate} DAY)   as '" .   self::$DATE_STR . "', " .
            self::$COUNTRY . " as '".                      self::$COUNTRY_STR . "',
            COUNT(". self::$ID . ") as '".                  self::$UNIQUE_CUSTOMERS_STR . "',
            SUM(" .  self::$NO_OF_DEPOSITS . ") as '" .     self::$NO_OF_DEPOSITS_STR . "',
            SUM(" .  self::$AMOUNT . ") as '".              self::$TOTAL_DEPOSIT_AMOUNT_STR . "',
            SUM(" .  self::$NO_OF_WITHDRAWALS . ") as '" .  self::$NO_OF_WITHDRAWALS_STR . "',
            SUM(" .  self::$WITHDRAWAL_AMOUNT . ") as '" .  self::$TOTAL_WITHDRAWAL_AMOUNT_STR . "'
            FROM {$this->TABLE}
            WHERE " . Customer::$AMOUNT_CHANGED_AT . " >= DATE(NOW()) - INTERVAL {$timeFrameDate} DAY
            GROUP BY " . Customer::$COUNTRY;

        $resultArray = $pdo->query($sql)->fetchAll();

        return Response::response(true,"Report data has been returned.", $resultArray);
    }


}
