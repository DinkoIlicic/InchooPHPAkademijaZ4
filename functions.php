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

function changeDataEmployee($employeeArray, $employeeId)
{
    echo "****************************************************\n";
    for ($i = 0; $i < count($employeeArray); $i++) {
        if($employeeArray[$i]->getId() == $employeeId) {
            echo "Choose which data will be changed by typing the number next to it. \n";
            echo "First Name: 1 \n";
            echo "Last Name: 2 \n";
            echo "Date of birth: 3 \n";
            echo "Gender: 4 \n";
            echo "Amount of monthly payment: 5 \n";
            echo "Return to employee menu: r \n";
            echo "****************************************************\n";

            switch(readline()) {
                case 1:
                    echo "Old first name: " . $employeeArray[$i]->getFirstName() . "\n";
                    echo "Insert new first name: ";
                    $employeeArray[$i]->setFirstName(nameCheck(readline()));
                    break;
                case 2:
                    echo "Old last name: " . $employeeArray[$i]->getLastName() . "\n";
                    echo "Insert new last name: ";
                    $employeeArray[$i]->setLastName(nameCheck(readline()));
                    break;
                case 3:
                    echo "Old date of birth: " . $employeeArray[$i]->getDateOfBirth() . "\n";
                    echo "Insert new date of birth: ";
                    $employeeArray[$i]->setDateOfBirth(dateCheck(readline()));
                    break;
                case 4:
                    echo "Old gender: " . $employeeArray[$i]->getGender() . "\n";
                    echo "Insert new gender: ";
                    $employeeArray[$i]->setGender(genderCheck(readline()));
                    break;
                case 5:
                    echo "Old amount of monthly payment: " . $employeeArray[$i]->getAmount() . "\n";
                    echo "Insert new amount of monthly payment: ";
                    $employeeArray[$i]->setAmount(amountcheck(readline()));
                    break;
                case "r":
                    break 2;
                default:
                    echo "Wrong input inserted";
                    break;
            }
        }
    }
    return $employeeArray;
}

function checkIfIdExists($employeeArray, $chosenId)
{
    for ($i = 0; $i < count($employeeArray); $i++) {
        if (isset($employeeArray[$i]) && $employeeArray[$i]->getId() == $chosenId) {
            return true;
        }
    }
    return false;
}

function eraseEmployee($employeeArray, $employeeId)
{
    for ($i = 0; $i < count($employeeArray); $i++) {
        if(isset($employeeArray[$i]) && $employeeArray[$i]->getId()==$employeeId){
            unset($employeeArray[$i]);
        }
    }
    return $employeeArray;
}

function totalAge($employeeArray)
{
    $today = new DateTime(date('d.m.y'));
    $totalDays = 0;
    for ($i = 0; $i < count($employeeArray); $i++) {
        if(isset($employeeArray[$i])) {
            $singleAgeStr = new DateTime($employeeArray[$i]->getDateOfBirth());
            $diff = date_diff($singleAgeStr, $today);
            $totalDays += $diff->days;
        }
    }

    $years = ($totalDays / 365) ; // days / 365 days
    $years = floor($years); // Remove all decimals

    $month = ($totalDays % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
    $month = floor($month); // Remove all decimals

    $days = ($totalDays % 365) % 30.5; // the rest of days

    // Echo all information set
    return 'Our employees total years: ' . $years . ', months: ' . $month . ', days: ' . $days . "\n";
}

function averageAge($employeeArray)
{
    $today = new DateTime(date('d.m.y'));
    $totalDays = 0;
    $employeeCount = 0;
    for ($i = 0; $i < count($employeeArray); $i++) {
        if(isset($employeeArray[$i])) {
            $singleAgeStr = new DateTime($employeeArray[$i]->getDateOfBirth());
            $diff = date_diff($singleAgeStr, $today);
            $totalDays += $diff->days;
            $employeeCount++;
        }
    }

    $averageDays = $totalDays / $employeeCount;
    $years = ($averageDays / 365) ; // days / 365 days
    $years = floor($years); // Remove all decimals

    $month = ($averageDays % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
    $month = floor($month); // Remove all decimals

    $days = ($averageDays % 365) % 30.5; // the rest of days

    // Echo all information set
    return 'Our employees average years: ' . $years . ', months: ' . $month . ', days: ' . $days . "\n";
}
