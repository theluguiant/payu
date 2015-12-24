<?php

namespace Savage\Payu;

use Savage\Payu\Classes\PayuBottom;

class Payu 
{
	public $payubottom;
    
    public function __construct()
    { 
        $this->payubottom  = new PayuBottom;
    }
	
	public function payuBottom(){
       return $this->payubottom;
    } 
	  
 }