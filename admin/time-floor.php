<?php

function formatExecutionTime($executionTime) {
    if ($executionTime < 0.001) {
        return "<strong>" . number_format($executionTime * 1000000, 0) . "</strong>" . " mikrosekund";
    } elseif ($executionTime < 1) {
        return "<strong>" . number_format($executionTime * 1000, 2) . "</strong>" . " millisekund";
    } else {
        return "<strong>" . number_format($executionTime, 3) . "</strong>" . " sekund";
    }
}

?>