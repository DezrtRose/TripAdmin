<?php

function get_display_price($discount, $cost)
{
    if(!isset($discount) || $discount == 0) {
        $display_price = "<i class='fa fa-tag'></i> $".$cost;
    } else {
        $offer_price = round($cost - ($cost * ($discount/100)), 2);
        $display_price = "<span style='text-decoration: line-through'>$".$cost."</span>
        <span>  <i class='fa fa-tag'></i> $".$offer_price."</span>";
    }
    return $display_price;
}

?>