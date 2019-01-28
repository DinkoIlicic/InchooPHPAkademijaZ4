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
    foreach ($employeeArray as $employee) {
        if($employee->getId() == $employeeId) {
            $currentId = ($employee->getId())-1;
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
                    echo "Old first name: " . $employee->getFirstName() . "\n";
                    echo "Insert new first name: ";
                    $employeeArray[$currentId]->setFirstName(nameCheck(readline()));
                    break;
                case 2:
                    echo "Old last name: " . $employee->getLastName() . "\n";
                    echo "Insert new last name: ";
                    $employeeArray[$currentId]->setLastName(nameCheck(readline()));
                    break;
                case 3:
                    echo "Old date of birth: " . $employee->getDateOfBirth() . "\n";
                    echo "Insert new date of birth: ";
                    $employeeArray[$currentId]->setDateOfBirth(dateCheck(readline()));
                    break;
                case 4:
                    echo "Old gender: " . $employee->getGender() . "\n";
                    echo "Insert new gender: ";
                    $employeeArray[$currentId]->setGender(genderCheck(readline()));
                    break;
                case 5:
                    echo "Old amount of monthly payment: " . $employee->getAmount() . "\n";
                    echo "Insert new amount of monthly payment: ";
                    $employeeArray[$currentId]->setAmount(amountcheck(readline()));
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
    foreach ($employeeArray as $employee) {
        if (isset($employee) && $employee->getId() == $chosenId) {
            return true;
        }
    }
    return false;
}

function eraseEmployee($employeeArray, $employeeId)
{
    foreach ($employeeArray as $employee) {
        if(isset($employee) && $employee->getId()==$employeeId){
            $currentEmployee = ($employee->getId())-1;
            unset($employeeArray[$currentEmployee]);
        }
    }
    return $employeeArray;
}

function totalAge($employeeArray)
{
    $today = new DateTime(date('d.m.y'));
    $totalDays = 0;
    foreach ($employeeArray as $employee) {
        if(isset($employee)) {
            $singleAgeStr = new DateTime($employee->getDateOfBirth());
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
    foreach ($employeeArray as $employee) {
        if(isset($employee)) {
            $singleAgeStr = new DateTime($employee->getDateOfBirth());
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

function amountYearsDiff($employeeArray)
{
    $today = new DateTime(date('d.m.y'));
    $arrayAmount = [0,0,0,0];
    foreach ($employeeArray as $employee) {
        if(isset($employee)) {
            $employeeDate = $employee->getDateOfBirth();
            $testDate = new DateTime($employeeDate);
            $interval = $testDate->diff($today);
            if($interval->y < 20) {
                $arrayAmount[0] += $employee->getAmount();
            } elseif($interval->y >= 20 && $interval->y < 30) {
                $arrayAmount[1] += $employee->getAmount();
            } elseif($interval->y >= 30 && $interval->y < 40) {
                $arrayAmount[2] += $employee->getAmount();
            } elseif($interval->y >= 40) {
                $arrayAmount[3] += $employee->getAmount();
            }
        }
    }
    return $arrayAmount;
}

function amountGenderDiff($employeeArray)
{
    $arrayAmount = [0,0,0,0];
    foreach ($employeeArray as $employee) {
        if(isset($employee)) {
            if($employee->getGender() == "m") {
                $arrayAmount[0] += $employee->getAmount();
                $arrayAmount[1]++;
            } elseif($employee->getGender() == "f") {
                $arrayAmount[2] += $employee->getAmount();
                $arrayAmount[3]++;
            }
        }
    }
    if($arrayAmount[0] != 0) {
        $averageMale = $arrayAmount[0] / $arrayAmount[1];
    } else {
        $averageMale = 0;
    }

    if($arrayAmount[2] != 0) {
        $averageFemale = $arrayAmount[2] / $arrayAmount[3];
    } else {
        $averageFemale = 0;
    }

    $arrayBack = [$averageMale, $averageFemale];
    return $arrayBack;
}
