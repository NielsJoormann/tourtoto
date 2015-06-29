<?php

require('basepage.class.php');

    class inputPage extends basePage
    {
       protected function showContent()
       {  
       }
       
       protected function showSubmenuItems()
       {
            $submenuitems= array();
            $submenuitems['totoploeg'] = 'Totoploeg';
            $submenuitems['etapperegel'] = 'Etapperegel';

            foreach ($submenuitems as $id => $title)
            {
                echo "<li><a href='index.php?page=input&id=".$id."'>".$title."</a></li>";
            }
       }
    }
