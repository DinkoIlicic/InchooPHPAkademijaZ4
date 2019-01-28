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
            echo "Write the ID of the employee: ";
            $chosenId = readline();
            $idExists = checkIfIdExists($employeeArray, $chosenId);
            if($idExists !== true) {
                echo "Employee by that ID not found \n";
            } else {
                changeDataEmployee($employeeArray, $chosenId);
            }
            break;
        case '4':

            break;
        case '5':
            statisticsMenu();
            $choice2 = trim( fgets(STDIN) );
            for(;$choice2 != 'r';) {
                switch ($choice2) {
                    case 'e':
                        exit();
                        break;
                    case '1':

                        break;
                    case '2':

                        break;
                    case '3':

                        break;
                    case '4':

                        break;
                    default:
                        echo "Not valid input \n";
                }

                $choice2 = trim( fgets(STDIN) );
            }
            break;
        default:
            echo "Not valid input \n";
    }
}
