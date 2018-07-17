<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Based on: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
* Tweaked by: Moving.Paper June 2013
*/

class Export
{
    function to_excel($array, $filename)
    {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=' . $filename . '.xls');

        // Filter all keys, they'll be table headers
        $h = array();
        foreach ($array as $row) {
            foreach ($row as $key => $val) {
                $h[] = strtoupper(str_replace('_', ' ', $key));
            }
            break;
        }
        //echo the entire table headers
        echo '<table border="1"><tr>';
        foreach ($h as $key) {
            $key = ucwords($key);
            echo '<th>' . $key . '</th>';
        }
        echo '</tr>';

        foreach ($array as $row) {
            echo '<tr>';
            foreach ($row as $val)
                $this->writeRow($val);
        }
        echo '</tr>';
        echo '</table>';


    }

    function writeRow($val)
    {
        echo '<td>' . utf8_decode($val) . '</td>';
    }

}