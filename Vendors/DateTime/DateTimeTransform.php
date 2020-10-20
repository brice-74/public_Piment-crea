<?php
namespace Vendors\DateTime;
use DateTime;

class DateTimeTransform {

	function transformDateTime($date){
		$datetime = new DateTime();
		$now = $datetime->format('Y-m-d H:i:s');

		list($Nyear,$Nmonth,$Nday) = explode("-",substr($now,0,10));
		list($Nheure,$Nminute,$Nseconde) = explode(":",substr($now,11,8));

		list($year,$month,$day) = explode("-",substr($date,0,10));
		list($heure,$minute,$seconde) = explode(":",substr($date,11,8));

		if($Nyear > $year){
			$val_y = $Nyear - $year;
			if($val_y == 1){
				return "Il y a ".$val_y." an";
				exit();
			}else{
				return "Il y a ".$val_y." ans";
				exit();
			}	
		}
		//var_dump('Nday : '.$Nday.'     day : '.$day);die();
		if($Nmonth > $month){
			$val_m = $Nmonth - $month;
			if($val_m == 1){
				$val_d = 30 + $Nday - $day;
				if($val_d >= 28){
					return "Il y a 1 mois";
					exit();
				}else if($val_d >= 21){
					return "Il y a 3 semaines";
					exit();
				}else if($val_d >= 14){
					return "Il y a 2 semaines";
					exit();
				}else if($val_d >= 7){
					return "Il y a 1 semaine";
					exit();
				}else{
					return "Il y a ".$val_d." jours";
					exit();
				}
			}else{
				return "Il y a ".$val_m." mois";
				exit();
			}
		}

		if($Nday > $day){
			$val_d = $Nday - $day;
			if($val_d == 1){
				return "Hier à ".$heure."h".$minute;
				exit();
			}else if(($val_d < 7)&&($val_d != 1)){
				return "Il y a ".$val_d." jours";
				exit();
			}else if($val_d >= 28){
				return "Il y a 4 semaine";
				exit();
			}else if($val_d >= 21){
				return "Il y a 3 semaine";
				exit();
			}else if($val_d >= 14){
				return "Il y a 2 semaine";
				exit();
			}else if($val_d >= 7){
				return "Il y a 1 semaine";
				exit();
			}
		}

		if($Nheure > $heure){
			$val_h = $Nheure - $heure;
			if(($val_h == 1)&&($Nminute < $minute)){
				return "Il y a < ".$val_h." heure";
				exit();
			}else if($val_h == 1){
				return "Il y a ".$val_h." heure";
				exit();
			}else{
				return "Il y a ".$val_h." heures";
				exit();
			}
		}

		if($Nminute > $minute){
			$val_m = $Nminute - $minute;
			if(($val_m  == 1) && ($Nseconde - $seconde < 60)){
				return "À l'instant";
				exit();
			}else{
				if($val_m == 1){
					return "Il y a ".$val_m." minute";
					exit();
				}else{
					return "Il y a ".$val_m." minutes";
					exit();
				}
			}
		}

		if($Nseconde >= $seconde){
			return "À l'instant";
			exit();
		}


		
	}

}

?>