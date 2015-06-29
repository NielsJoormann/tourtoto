<?php

require_once ('outputpage.class.php');

class outputAlgemeenKlassement extends outputPage
{
    public function showContent()
    {
        echo "Algemeen Klassement";
        echo "<p><b>Print"."&nbsp".$this->tablename."&nbsp"."overzicht.</b><a href='../resources/library/controllers/printpdfAlgemeenKlassement.php' target='_blank's><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-download-alt'></span></a></p>";
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

