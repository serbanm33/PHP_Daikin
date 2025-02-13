<?PHP
class PHP_Daikin
{
	/**
	* Description:	Communication with Daikin BRP069B43 & BRP069B45 WiFi modules
	*				        This class can get data from AC unit and also send commends
	* Author: 		  Marius Șerban
	*/
	public $Unit_IP	=	null;
	
	private function cURL_Ex($URL)
	{
		/**
		* Description:	Execute cURL for provided URL
		* Return:		    ARRAY
		*/
		$CURL 					= curl_init($URL);
		curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($CURL, CURLOPT_RETURNTRANSFER , TRUE);
		$Return					= curl_exec($CURL);
		curl_close($CURL);
		
		return('{"'.str_replace('=', '":"', str_replace(',', '","', $Return)).'"}');
		
	}
	public function CustomURL ($URL = null)
	{
		/**
		* Description:	Return custom URL execution result
		* Return:		    ARRAY
		*/
		if ($URL	!= NULL) {
			$URL 	= $this->Unit_IP.$URL;
		}
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function BasicInfo ()
	{
		/**
		* Description:	Returns unit basic info
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/common/basic_info';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function GetRemoteMethod ()
	{
		/**
		* Description:	Return remote method result
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/common/get_remote_method';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function GetControlInfo ()
	{
		/**
		* Description:	Return
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_control_info';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function GetModelInfo ()
	{
		/**
		* Description:	Return model info result
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_model_info';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function GetSensorInfo ()
	{
		/**
		* Description:	Returns unit sensor info
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_sensor_info';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	
	}
	public function GetWeekPower()
	{
		/**
		* Description:	Returns week power info
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_week_power';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function GetYearPower ()
	{
		/**
		* Description:	Returns year power info
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_year_power';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
		
	}
	public function GetWeekPowerEx()
	{
		/**
		* Description:	Returns week power ex info
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_week_power_ex';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function GetYearPowerEx ()
	{
		/**
		* Description:	Returns year power ex info
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/aircon/get_year_power_ex';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function SetLED ($LED = TRUE)
	{
		/**
		* Description:	Set AC adaptor LED
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/common/set_led?ret=OK';
		//LED ON
		if (is_bool($LED) and $LED == TRUE)
		{
			$URL 	= 	$URL.'&led=1';
		}
		//LED OFF
		if(is_bool($LED) and $LED == FALSE)
		{
			$URL	=	$URL.'&led=0';
		}
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function Reboot ()
	{
		/**
		* Description:	Reboot AC adaptor
		* Return:		    ARRAY
		*/
		$URL 		= $this->Unit_IP.'/common/reboot';
		$Return 	= $this->cURL_Ex($URL);

		return (json_decode($Return,TRUE));
	}
	public function SetControlInfo ($Power = 1, $Mode = 7, $Set_Temp = 24.0, $Set_Hum = 'AUTO', $Fan_Rate = 'B', $Fan_Dir = 0)
	{
		/**
		* Description:	Return
		* $Power:
		* 					0 -> Device off
		* 					1 -> Device on
		* $Mode:
		* 					0,1,7 	-> Auto
		* 					2 		-> Dehumidificator
		* 					3 		-> Cold
		* 					4 		-> Hot
		* 					6 		-> Fan
		* $Set_Temp:
		* 					Min: 10
		*					  Max: 41
		* $Set_Hum:
		*					  AUTO
		*					  Min: 0
		*					  Max: 50
		* $Fan_Rate:
		* 					A -> Auto
		* 					B -> Silence
		* 					3 -> Level 1
		* 					4 -> Level 2
		* 					5 -> Level 3
		* 					6 -> Level 4
		* 					7 -> Level 5
		* $Fan_Dir:
		* 					0 -> All wings stopped
		* 					1 -> Vertical wings motion
		* 					2 -> Horizontal wings motion
		* 					3 -> Vertical and horizontal wings motion
		* Return:		ARRAY
		*/
		$URL 			= $this->Unit_IP.'/aircon/set_control_info?ret=OK';
		if (is_numeric($Power) and is_numeric($Mode) and is_numeric($Set_Temp) and (is_numeric($Set_Hum) or $Set_Hum == 'AUTO') and (is_numeric($Fan_Rate) or $Fan_Rate == 'A' or $Fan_Rate == 'B') and is_numeric($Fan_Dir))
		{
		//Power ON
			if ($Power 		== 0)
			{
				$URL 		= 	$URL.'&pow=0';
			}
		//Power OFF
			if($Power 		== 1)
			{
				$URL		=	$URL.'&pow=1';
			}
		//Mode AUTO
			if(($Mode 		== 0 or $Mode == 1 or $Mode == 7) and ($Set_Temp >= 18.0 and $Set_Temp <= 31.0) and is_numeric($Set_Temp))
			{
				$URL		=	$URL.'&mode='.$Mode.'&stemp='.$Set_Temp;
			}
		//Mode COLD
			if($Mode 		== 3 and $Set_Temp >= 18 and $Set_Temp <= 33 and is_numeric($Set_Temp))
			{
				$URL		=	$URL.'&mode='.$Mode.'&stemp='.$Set_Temp;
			}
		//Mode HOT
			if($Mode 		== 4 and $Set_Temp >= 10 and $Set_Temp <= 31 and is_numeric($Set_Temp))
			{
				$URL		=	$URL.'&mode='.$Mode.'&stemp='.$Set_Temp;
			}
		//Mode DEHUMIDIFICATOR or FAN
			if (($Mode 		== 2 or $Mode == 6) and ($Set_Temp >= 10 and $Set_Temp <= 41) and is_numeric($Set_Temp))
			{
				$URL		=	$URL.'&mode='.$Mode.'&stemp='.$Set_Temp;
			}
		//Humidity
			if($Set_Hum 	== 'AUTO' or (is_numeric($Set_Hum) and $Set_Hum >= 0 and $Set_Hum <= 50))
			{
				$URL		=	$URL.'&shum='.$Set_Hum;
			}
		//Fan rate
			if(($Fan_Rate 	== 'A' or $Fan_Rate == 'B') or (is_numeric($Fan_Rate) and $Fan_Rate >= 3 and $Fan_Rate <= 7))
			{
				$URL		=	$URL.'&f_rate='.$Fan_Rate;
			}
		//Fan direction
			if(is_numeric($Fan_Dir) and $Fan_Dir >= 0 and $Fan_Dir <= 3)
			{
				$URL		=	$URL.'&f_dir='.$Fan_Dir;
			}
		}
		$Return 	= $this->cURL_Ex($URL);
		
		return (json_decode($Return,TRUE));
	}
}
?>
