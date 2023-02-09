<?php

// return true if the food has at least 2 characters
    function validFood($food)
    {
            if ( strlen($food) <= 2 ) {
                return false;
            }
            else {
                return true;
            }
    }

    function validMeal($meal)
    {
        if( in_array($meal, getMeals()) ) {
            return true;
        }
        else {
            return false;
        }
    }