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

function enterEmployeeInfo() {

    echo "Enter employees first name: ";
    $fName = trim( fgets(STDIN) );

    echo "Enter employees last name: ";
    $lName = trim( fgets(STDIN) );

    echo "Enter employees gender: ";
    $gender = trim( fgets(STDIN) );

    echo "Enter employees amount of monthly income: ";
    $amount = trim( fgets(STDIN) );

    $x = new Employees($fName, $lName, $gender, $amount);
    return $x;
}

function showEmployeeInfo($employeeArray) {
    echo "****************************************************\n";
    foreach ($employeeArray as $id) {
        echo "Employee id: " . $id->getId() . "\n";
        echo "First name: " . $id->getFirstName() . "\n";
        echo "Last name: " . $id->getLastName() . "\n";
        echo "Gender: " . $id->getGender() . "\n";
        echo "Amount of monthly payment: " . $id->getAmount() . "\n";
        echo "****************************************************\n";
    }
}