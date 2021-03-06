<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 10:58
 */
include_once 'Employees.php';

/**
 * Echoes the employee menu to the user
 */
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

/**
 * Echoes the statistics menu to the user
 */
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

/**
 * Function is used to create new instance of class Employee. Entered input is checked instantly to match whats required
*/
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

/**
 * @param $employeeArray Employees[]
 */
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

/**
 * @param $var
 * @return mixed
 * Checks if name contains only english letters
 */
function nameCheck($var)
{
    if(empty($var) || preg_match('/[^A-Za-z]/', $var)) {
        echo "Please insert only english letters: ";
        return nameCheck(readline());
    } else {
        return $var;
    }
}

/**
 * @param $var
 * @return mixed
 * This functions checks if given variable contains 'm' or 'f', nothing else passes through
 */
function genderCheck($var)
{
    if(empty($var) || ($var != "m" && $var != "f")) {
        echo "Please insert only 'm' for male or 'f' for female: ";
        return genderCheck(readline());
    } else {
        return $var;
    }
}

/**
 * @param $var
 * @return float
 * Function checks if the amount is a float and contains only numbers and '.'
 */
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

/**
 * @param $var
 * @return mixed
 * This function will check if the date is inserted in correct format which is dd.MM.YYYY
 * The Date can't be bigger than current date.
 */
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

/**
 * @param $employeeArray Employees[]
 * @param $employeeId
 * @return mixed
 * This function uses id and array of the employees, checks if ID exists in array and then gives the user
 * the ability to choose which information of the employee to change. It shows old value and gives option to insert new value
 */
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

/**
 * @param $employeeArray Employees[]
 * @param $chosenId
 * @return bool
 * Function is checking if given param id exists in array
 */
function checkIfIdExists($employeeArray, $chosenId)
{
    foreach ($employeeArray as $employee) {
        if (isset($employee) && $employee->getId() == $chosenId) {
            return true;
        }
    }
    return false;
}

/**
 * @param $employeeArray Employees[]
 * @param $employeeId
 * @return mixed
 * This function will take 2 params, array and id of employee that needs to be deleted. First it checks if the id exists
 * in the array and then removes it.
 */
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

/**
 * @param $employeeArray Employees[]
 * @throws
 * Function check how old each employee is and adds the age of them together to variable $totalDays that stores how old
 * they are in days. It will echo out total years, months and days of all employees.
 */
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
    echo 'Our employees total years: ' . $years . ', months: ' . $month . ', days: ' . $days . "\n";
}

/**
 * @param $employeeArray Employees[]
 * @throws
 * This function will check how old every employee is, add their ages together and divide by number of employees
 * Then it shows only average year of the employee. Echoes the average year.
 */
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

    // Echo all information set
    echo "The average employee is " . $years . " years old \n";
}

/**
 * @param $employeeArray Employees[]
 * @throws
 * This function counts the total amount of monthly payment in 4 groups (employees younger than 20 years, between
 * 20-30 years, between 30-40 years and older than 40 years) than echoes them out.
 */
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

    echo "Employees younger than 20 earn total of: " . $arrayAmount[0] . "\n";
    echo "Employees between 20 and 30 years earn total of: " . $arrayAmount[1] . "\n";
    echo "Employees between 30 and 40 years earn total of: " . $arrayAmount[2] . "\n";
    echo "Employees older than 40 earn total of: " . $arrayAmount[3] . "\n";
}

/**
 * @param $employeeArray Employees[]
 * This function counts the amount of each gender and how many employees are that gender, divides the number
 * and we get the average amount of monthly payment per gender.
 * Function does not return anything, it just echoes average amount per gender and the difference between them.
 */
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
    echo "Male employees average earn is: " . $arrayBack[0] . "\n";
    echo "Female employees average earn is: " . $arrayBack[1] . "\n";
    if($arrayBack[0] > $arrayBack[1]) {
        echo "Difference between genders is: " . ($arrayBack[0] - $arrayBack[1]) . " in favor of males \n";
    } elseif($arrayBack[0] < $arrayBack[1]) {
        echo "Difference between genders is: " . ($arrayBack[1] - $arrayBack[0]) . " in favor of females \n";
    } elseif($arrayBack[0] == $arrayBack[1]) {
        echo "They earn the same amount: " . $arrayBack[0] . "\n";
    }
}
