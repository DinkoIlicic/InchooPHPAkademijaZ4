<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 28.01.19.
 * Time: 10:42
 */

include_once 'functions.php';

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

            break;
        case '2':

            break;
        case '3':

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
                        continue;
                        break;
                    case '2':

                        break;
                    case '3':

                        break;
                    case '4':

                        break;
                    default:
                        echo "Not valid input";
                }

                $choice2 = trim( fgets(STDIN) );
            }
            break;
        default:
            echo "Not valid input";
    }
}
