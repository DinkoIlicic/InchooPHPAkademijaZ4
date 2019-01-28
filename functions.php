<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 10:58
 */
include 'Employees.php';


function employeeMenu()
{
    echo "************ Employee Menu ******************\n";
    echo "1 - Employee overview\n";
    echo "2 - Entering a new employee\n";
    echo "3 - Change data to an existing employee\n";
    echo "4 - Deleting a employee\n";
    echo "5 - Statistics menu\n";
    echo "e - Exit\n";
    echo "************ Employee Menu ******************\n";
    echo "Enter your choice from 1 to 5 ::";
}

function statisticsMenu()
{
    echo "************ Statistics Menu ******************\n";
    echo "1 - Total age\n";
    echo "2 - Average age\n";
    echo "3 - Total income\n";
    echo "4 - Average income\n";
    echo "r - Return to employee menu\n";
    echo "e - Exit\n";
    echo "************ Statistics Menu ******************\n";
    echo "Enter your choice from 1 to 4 ::";
}

function enterEmployeeInfo()
{

    echo "Enter employees first name: ";
    $fName = nameCheck(readline());

    echo "Enter employees last name: ";
    $lName = nameCheck(readline());

    echo "Enter employees date of birth (dd.MM.YYYY): ";
    $date = dateCheck(readline());

    echo "Enter employees gender(m/f): ";
    $gender = genderCheck(readline());

    echo "Enter employees amount of monthly income (example 5000.00): ";
    $amount = amountCheck(readline());

    $x = new Employees($fName, $lName, $date, $gender, $amount);
    return $x;
}

function showEmployeeInfo($employeeArray)
{
    echo "****************************************************\n";
    foreach ($employeeArray as $id) {
        echo "Employee id: " . $id->getId() . "\n";
        echo "First name: " . $id->getFirstName() . "\n";
        echo "Last name: " . $id->getLastName() . "\n";
        echo "Date of birth: " . $id->getDateOfBirth() . "\n";
        echo "Gender: " . $id->getGender() . "\n";
        echo "Amount of monthly payment: " . $id->getAmount() . "\n";
        echo "****************************************************\n";
    }
}

function nameCheck($var)
{
    if(empty($var) || preg_match('/[^A-Za-z]/', $var)) {
        echo "Please insert only english letters: ";

        return nameCheck(readline());
    } else {
        return $var;
    }
}

function genderCheck($var)
{
    if(empty($var) || ($var != "m" && $var != "f")) {
        echo "Please insert only 'm' for male or 'f' for female: ";

        return genderCheck(readline());
    } else {
        return $var;
    }
}

function amountCheck($var)
{
    $var = floatval(str_replace(",", ".", $var));
    if(empty($var) || $var <= 0 || !is_float($var)) {
        echo "Please insert only numeric float value (example: 5000.00): ";

        return amountCheck(readline());
    } else {
        return $var;
    }
}


function dateCheck($var)
{
    $matches = array();
    $pattern = '/^([0-9]{2})\\.([0-9]{2})\\.([0-9]{4})$/';

    if (!preg_match($pattern, $var, $matches))  {
        echo "Please insert the date of birth in format dd.MM.YYYY (Example 10.05.1990): ";

        return dateCheck(readline());
    }

    if (!checkdate($matches[2], $matches[1], $matches[3])) {
        echo "Please insert the date of birth in format dd.MM.YYYY (Example 10.05.1990): ";

        return dateCheck(readline());
    }

    $testVar = strtotime($var);
    $testDate = strtotime(date('d.m.Y'));

    if($testDate < $testVar) {
        echo "Please insert the date of birth in format dd.MM.YYYY (Example 10.05.1990): ";

        return dateCheck(readline());
    } else {
        return $var;
    }
}