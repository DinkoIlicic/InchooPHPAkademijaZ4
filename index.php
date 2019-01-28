<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 10:42
 */

include_once 'functions.php';
include_once 'Employees.php';
$employeeArray = [];
for(;;) {
    // Print the menu on console
    employeeMenu();

    // Read user choice
    $choice = trim( fgets(STDIN) );

    // Switch with employeeMenu
    switch($choice) {
        case 'e':
            exit();
            break;
        case '1':
            showEmployeeInfo($employeeArray);
            break;
        case '2':
            $employeeArray[] = enterEmployeeInfo();
            break;
        case '3':
            echo "Write the ID of the employee that You want to change: ";
            $chosenId = readline();
            $idExists = checkIfIdExists($employeeArray, $chosenId);
            if($idExists !== true) {
                echo "Employee by that ID not found! \n";
            } else {
                changeDataEmployee($employeeArray, $chosenId);
            }
            break;
        case '4':
            echo "Write the ID of the employee that You want to erase: ";
            $chosenId = readline();
            $idExists = checkIfIdExists($employeeArray, $chosenId);
            if($idExists !== true) {
                echo "Employee by that ID not found! \n";
            } else {
                echo "Are You sure that You want to erase the employee? (Yes/No) \n";
                if(readline() !== "Yes") {
                    echo "Employee has not been erased. \n";
                } else {
                    $employeeArray = eraseEmployee($employeeArray, $chosenId);
                    echo "Employee has been erased. \n";
                }
            }

            break;
        case '5':
            $choice2 = "";
            for(;$choice2 != 'r';) {
                statisticsMenu();
                $choice2 = trim( fgets(STDIN) );
                switch ($choice2) {
                    case 'e':
                        exit();
                        break;
                    case '1':
                        totalAge($employeeArray);
                        break;
                    case '2':
                        averageAge($employeeArray);
                        break;
                    case '3':
                        amountYearsDiff($employeeArray);
                        break;
                    case '4':
                        amountGenderDiff($employeeArray);
                        break;
                    default:
                        echo "Not valid input \n";
                }
            }
            break;
        default:
            echo "Not valid input \n";
    }
}
