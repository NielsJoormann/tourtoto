<?php

require_once('outputpage.class.php');

class outputEtappeUitslag extends outputPage
{
    public function showContent()
    {
        echo "Etappeuitslag";
        echo "<p><b>Print"."&nbsp".$this->tablename."&nbsp"."overzicht.</b><a href='../resources/library/controllers/printpdfEtappeuitslag.php' target='_blank's><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-download-alt'></span></a></p>";

    }
}

