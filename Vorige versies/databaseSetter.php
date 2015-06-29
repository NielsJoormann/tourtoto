<?php

require_once 'etappe.php';
require_once 'etapperegel.php';
require_once 'land.php';
require_once 'ploeg.php';
require_once 'renner.php';
require_once 'rennerpunten.php';
require_once 'totospeler.php';
require_once 'totospelerploeg.php';
require_once 'databaseGetter.php';
require_once 'databaseConnector.php';


 class databaseSetter{
     
 
     
     public function setEtappe($id){
         $etappe->setId($id);
        
         return $etappe;
     }
     
     public function setEtapperegel($id){
          
         $etapperegel->setId($etapperegel);
         
                  return $etapperegel;

     }
     
     public function setLand($id){
          
         $land->setId($land);
         
                  return $land;

     }
     
     public function setPloeg($id){
          
         $ploeg->setId($ploeg);
         
                  return $ploeg;

     }
     
     public function setRenner($id){
          
         $renner->setId($renner);
         
                  return $renner;

     }
     
     public function setTotospeler($id){
          
         $totospeler->setId($totospeler);
         
                  return $totospeler;

     }
     
     public function setTotospelerploeg($id){
          
         $totospelerploeg->setId($totospelerploeg);
         
                  return $totospelerploeg;

     }
     
     
 }
 
 ?>
