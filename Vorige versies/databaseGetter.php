<?php
 
require_once 'etappe.php';
require_once 'etapperegel.php';
require_once 'land.php';
require_once 'ploeg.php';
require_once 'renner.php';
require_once 'rennerpunten.php';
require_once 'totospeler.php';
require_once 'totospelerploeg.php';
require_once 'databaseSetter.php';
require_once 'databaseConnector.php';

 class databaseGetter{
    

     
     
     public function getEtappe($id){
         $etappe = new etappe($id);
         
         
         return $etappe;
     }
     
     public function getEtapperegel($id){
         $etapperegel = new etapperegel();
         
          
                  return $etapperegel;

     }
     
     public function getLand($id){
         $land = new land();
         
          
                  return $land;

     }
     
     public function getPloeg($id){
         $ploeg = new ploeg();
         
          
                  return $ploeg;

     }
     
     public function getRenner($id){
         $renner = new renner();
        
         return $renner;

     }
     
     public function getTotospeler($id){
         $totospeler = new totospeler();
         
          
          return $totospeler;

     }
     
     public function getTotospelerploeg($id){
         $totospelerploeg = new totospelerploeg();
         
          
         return $totospelerploeg;

     }
     
     
 }
 
 ?>
