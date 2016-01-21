<?php
namespace Theluguiant\Payu\Classes;

class PayuBottom{
  
  private $_luQueryUrl; 
  private $_merchantId; //valor  numerico quitar caracteres y deja solo numeros quitar comillas
  private $_accountId; //valor numerico quitar caracteres y deja solo numeros quitar comillas
  private $_apiKey;
  private $_description;
  private $_referenceCode;
  private $_amount;
  private $_tax;
  private $_taxReturnBase;
  private $_shipmentValue;
  private $_currency;
  private $_lng;
  private $_sourceUrl;
  private $_buttonType;
  private $_signature;
  private $_test;
  private $_buyerEmail;
  private $_htmlFormCode;
  private $_htmlCode;
  private $_imagebtn='http://www.payulatam.com/img-secure-2015/boton_pagar_pequeno.png';
  private $_btnName;

  function __construct($accountid='',$url='',$apikey='',$test='',$description='',$referenceCode='',$amount='',$tax='',$taxReturnBase='',$shipmentValue='',$currency='',$lng='',$sourceUrl='',$buttonType='',$buyerEmail=''){
        if(!empty($description)){
            $this->setDescription($description);
        }
        if(!empty($referenceCode)){
            $this->setReferenceCode($referenceCode);
        }
        if(!empty($amount)){
             $this->setAmount($amount);
        }
        if(!empty($tax)){
             $this->setTax($tax);
        }
        if(!empty($taxReturnBase)){
        	$this->setTaxReturnBase($taxReturnBase);
        }
        if(!empty($shipmentValue)){
            $this->setShipmentValue($shipmentValue);
        }
        if(!empty($currency)){
        	$this->setCurrency($currency);
        }
        if(!empty($lng)){
           	$this->setLng($lng);
        }
        if(!empty($sourceUrl)){
            $this->setSourceUrl($sourceUrl);
        }
        if(!empty($buttonType)){
        	$this->setButtonType($buttonType);
        }
        if(!empty($buyerEmail)){
            $this->setBuyerEmail($buyerEmail);
        }
        if(!empty($test)){
            $this->setTest($test);
        }
        if(!empty($apikey)){
            $this->setApikey($apikey);
        }
        if(!empty($merchantid)){
            $this->setMerchantid($merchantid);
        }
        if(!empty($url)){
          $this->setUrlgate($url);
        }
        if(!empty($accountid)){
          $this->setAccountid($accountid);
        }
  }
  public function setBuyerEmail($buyerEmail){
  	   $this->_buyerEmail=$buyerEmail;
  } 

  public function setDescription($description) {
        $this->_description = $description;
  }

  public function setReferenceCode($referenceCode){
  	    $this->_referenceCode=$referenceCode;
  }
  public function setAmount($amount){
  	   $this->_amount=$amount;
  }
  public function setTax($tax){
  	   $this->_tax=$tax;
  }
  public function setTaxReturnBase($taxReturnBase){
  	   $this->_taxReturnBase = $taxReturnBase;
  } 
  public function setShipmentValue($shipmentValue){
  	   $this->_shipmentValue = $shipmentValue;
  } 
  public function setCurrency($currency){
  	   $this->_currency=$currency;
  }
  public function setLng($lng){
  	   $this->_lng=$lng;
  }
  public function setSourceUrl($sourceUrl){
  	   $this->_sourceUrl =$sourceUrl;
  }
  public function setButtonType($buttonType){
  	   $this->_buttonType = $buttonType;
  }
  public function setBtnName($btnName){
       $this->_btnName = $btnName;
  }
  public function setTest($test){
       $this->_test = $test;
  }
  public function setApikey($apikey){
       $this->_apiKey = $apikey;
  }
  public function setMerchantid($merchantid){
        $this->_merchantId = $merchantid;
  }
  public function setUrlgate($url){
        $this->_luQueryUrl=$url;
  }
  public function setAccountid($accountid){
        $this->_accountId = $accountid;
  }

  /**Agregar inputs**/
  private function _addInput($string, $value)
  {
        return '<input type="hidden" name="' .$string. '" value="' . htmlentities($value, ENT_COMPAT, 'UTF-8') . '"/>' . "\n";
  }

  public function _makeFields(){
        $this->_htmlFormCode.=$this->_addInput('merchantId',$this->_merchantId);
        $this->_htmlFormCode.=$this->_addInput('accountId',$this->_accountId);
        $this->_htmlFormCode.=$this->_addInput('description',$this->_description);
		$this->_htmlFormCode.=$this->_addInput('referenceCode',$this->_referenceCode);
		$this->_htmlFormCode.=$this->_addInput('amount',$this->_amount);
		$this->_htmlFormCode.=$this->_addInput('tax',$this->_tax);
		$this->_htmlFormCode.=$this->_addInput('taxReturnBase',$this->_taxReturnBase);
		$this->_htmlFormCode.=$this->_addInput('shipmentValue',$this->_shipmentValue);
		$this->_htmlFormCode.=$this->_addInput('currency',$this->_currency);
		$this->_htmlFormCode.=$this->_addInput('lng',$this->_lng);
		$this->_htmlFormCode.=$this->_addInput('test',$this->_test);
		$this->_htmlFormCode.=$this->_addInput('buyerEmail',$this->_buyerEmail);
		$this->_htmlFormCode.=$this->_addInput('sourceUrl',$this->_sourceUrl);
		$this->_htmlFormCode.=$this->_addInput('buttonType',$this->_buttonType);
		$this->_htmlFormCode.=$this->_addInput('signature',$this->_signature);
  }
  
  private function _makeForm()
  {
        $this->_htmlCode .= '<form action="' . $this->_luQueryUrl . '" method="POST" id="payForm" name="payForm"/>' . "\n";
        $this->_htmlCode .=$this->_htmlFormCode;
        $this->_htmlCode .='<input type="image" border="0" alt="" src="'.$this->_imagebtn.'" onClick="this.form.urlOrigen.value = window.location.href;"/>';
  }
 
  /**Render del html**/
  public function renderPaymentForm()
  {
        $time = time();
        error_log("---Payment page sampledan gelen loglar---".$time,0);
        $this->setSignature();
        $this->_makeFields();
        $this->_makeForm();

        return $this->_htmlCode;
  }

  public function setSignature(){
    $this->_signature = md5($this->_apiKey."~".$this->_merchantId."~".$this->_referenceCode."~".$this->_amount.'~'.$this->_currency);
  }
}