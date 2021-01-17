<?php
namespace app\models;

use Yii;
use PDO;
use app\extensions\XModel;


class Sa extends XModel
{
	public $countryName;
	public $airportTaxCode;
	public $ccy;
	public $code;
	public $search;
	public $type;
	public $searchType;
	public $countryCode;
	public $cityName;
	public $utc;
	public $ccyName;
	public $city;
	public $airportName;
	public $code4;
	public $gmt;
	public $adminName;
	public $shortName;
	public $login;
	public $domain;
	public $phone;
	public $adminChangePass;
	public $companyName;
	public $companySName;
	public $companyDomain;
	public $companyNPWP;
	public $companyAddress1;
	public $companyAddress2;
	public $companyCity;
	public $companyState;
	public $companyStatus;
	public $adminContactId;
	public $companyZip;
	public $companyCountry;
	public $companyPhone;
	public $companyFax;
	public $companyWebsite;
	public $adminFirstName;
	public $adminLastName;
	public $adminGender;
	public $adminBirthdate;
	public $adminEmail;
	public $adminMobile;
	public $adminUserId;
	public $adminPassword;
	public $adminPasswordConfirm;
	public $officeName;
	public $officeCode;
	public $officeType;
	public $officeCity;
	public $officeCcy;
	public $officeStation;
	public $ownerId;
	public $ownerType;
	public $adminId;
	public $compId;
	public $companyApps;
	public $name;
	public $value;
	public $number;
	public $addrId;
	public $variableName;
	public $description;
	public $group;
	public $searchVariableName;
	public $searchDescription;
	public $searchGroup;

	// Airline
	public $code3;
	public $code2;
	public $airlineName;
	public $acctNo;
	public $airimpRmAddr;
	public $payNo;
	public $gdsAddr;
	public $gdsRouteAddr;
	public $broadcastAirimp;
	public $ibeUser;
	public $gdsUser;
	public $compCode;

	//system-log
	public $accessType;
	public $user;
	public $accessFrom;

	//user-activity
	public $userId;
	public $userName;
	public $status;
	public $contactId;

	// admin-log
	public $from;
	public $to;
	public $dateFrom;
	public $dateTo;
	public $timeFrom;
	public $timeTo;
	public $actionBy;
	public $actionFor;
	public $actionGroup;
	public $actionApp;
	public $actionType;
	public $requestId;

	// default-config
	public $regCode;
	public $oldRegCode;
	public $typeCode;
	public $yCabin;
	public $cCabin;
	public $fCabin;
	public $maxInfant;
	public $payload;
	public $cost;
	public $bgAllow;
	public $maxUmnr;
	public $maxDisability;
	public $maxPrepaidBaggage;
	public $doi;
	public $dow;
	public $maker;
	public $templateId;
	public $isEmptySeat;
	public $cabin;
	
	public $useFtp;

	public function rules()
	{
		return [
			['code', 'required', 'on' => 'render-edit'],
			['compId', 'required', 'on' => 'render-edit-airline'],
			[['code', 'countryName', 'ccy', 'airportTaxCode'], 'required', 'on' => ['insert-country', 'update-country']],
			[['code'], 'string', 'max' => 2 , 'on' => ['insert-country', 'update-country']],
			[['countryName'], 'string', 'max' => 64 , 'on' => ['insert-country', 'update-country']],
			[['ccy'], 'string', 'max' => 3 , 'on' => ['insert-country', 'update-country']],
			[['airportTaxCode'], 'string', 'max' => 3 , 'on' => ['insert-country', 'update-country']],
			[['code', 'cityName', 'countryCode', 'utc'], 'required', 'on' => ['insert-city', 'update-city']],
			[['code'], 'string', 'max' => 3, 'on' => ['insert-city', 'update-city']],
			[['cityName'], 'string', 'max' => 64, 'on' => ['insert-city', 'update-city']],
			[['countryCode'], 'string', 'max' => 2, 'on' => ['insert-city', 'update-city']],
			[['code', 'ccyName'], 'required', 'on' => ['insert-ccy', 'update-ccy']],
			[['code'], 'string', 'max' => 3, 'on' => ['insert-ccy', 'update-ccy']],
			[['ccyName'], 'string', 'max' => 32, 'on' => ['insert-ccy', 'update-ccy']],
			[['code', 'airportName', 'gmt', 'countryCode'], 'required', 'on' => ['insert-airport', 'update-airport']],
			[['compId'], 'required', 'on' => ['get-detail-company', 'edit-company-apps', 'update-global-variable']],
			[['variableName', 'description', 'group'], 'required', 'on' => ['insert-global-variable-desc', 'update-global-variable-desc']],
			[['variableName'], 'required', 'on' => ['render-edit-global-variable-desc']],
			[['compCode'], 'required', 'on' => ['insert-airline']],
			[['compId'], 'required', 'on' => ['update-airline']],
			[['code2'], 'string', 'max' => 4, 'on' => ['update-airline']],
			[['code3'], 'string', 'max' => 3, 'on' => ['update-airline']],
			[['name'], 'string', 'max' => 64, 'on' => ['update-airline']],
			[['shortName'], 'string', 'max' => 32, 'on' => ['update-airline']],
			[['code2', 'code3', 'shortName'], 'required', 'on' => ['update-airline']],
			[['dateFrom', 'dateTo', 'timeFrom', 'timeTo'], 'required', 'on' => ['search-ws-history','search-log']],
			['typeCode'		, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['yCabin'		, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['cCabin'		, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['fCabin'		, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['maxInfant'	, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['bgAllow'		, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['maxUmnr'		, 'required', 'on' 	=> ['insert-template', 'update-template']],
			['maxDisability', 'required', 'on' 	=> ['insert-template', 'update-template']],
			['payload'	, 'number', 'min' => '1', 'on' => ['insert-template', 'update-template']],
			['cost'		, 'number', 'min' => '1', 'on' => ['insert-template', 'update-template']],
			['bgAllow'	, 'number', 'min' => '1', 'on' => ['insert-template', 'update-template']]
		];
	}

	public function insertAirline()
	{
		// $this->ibeUser = '';

		// $sql = "
		// 	BEGIN
		// 		sp_ars_airline_insert
		// 		(
		// 			out_ret_code 		=> :outNum,
		// 		  	out_msg		 		=> :outMsg,
		// 		  	in_code_2 			=> :code2,
		// 		  	in_code_3			=> :code3,
		// 		  	in_name				=> :name,
		// 		  	in_short_name 		=> :shortName,
		// 		  	in_acct_no 			=> :acctNo,
		// 		  	--in_ibe_user_id 		=> :ibeUser,
		// 		  	in_airimp_rm_addr 	=> :airimpRmAddr,
		// 		  	in_pay_no 			=> :payNo,
		// 		  	in_gds_user_id 		=> :gdsUser,
		// 		  	in_gds_addr 		=> :gdsAddr,
		// 		  	in_gds_router_addr 	=> :gdsRouteAddr,
		// 		  	in_broadcast_airimp => :broadcastAirimp,
		// 		  	in_owner_id 		=> :ownerId
		// 		);
		// 	END;
		// ";

		/* check company */
		$sql = "
			SELECT 
				comp_id,
				comp_name,
				comp_code
			FROM 
				companies 
			WHERE 
				member_type = 1 
				AND comp_code = :compCode
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':compCode'		, $this->compCode);
		// $this->dd($st->getRawSql());
		$checkCompany = $st->queryOne();

		if (!$checkCompany)
		{
			return[
				'errNum' => 1,
				'errStr' => 'Company code not found',
			];
		}

		/* check duplicate airline */
		$sql = "
			SELECT 
				COUNT(*) 
			FROM 
				ars_airline 
			WHERE owner_id = :ownerId
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId'	, $checkCompany['COMP_ID']);
		// $this->dd($st->getRawSql());
		$duplicate = (int) $st->queryScalar();
		
		if ($duplicate > 0)
		{
			return[
				'errNum' => 1,
				'errStr' => 'Company code already exist',
			];
		}

		$sql = "
			BEGIN
				sp_sa_airline_add
				(
					:outNum, 
					:outMsg, 
					'', 
					'', 
					:name,
					:shortName,
					:ownerId,
					:adminId
				);
			END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':name' 				, $checkCompany['COMP_NAME']);
		$st->bindParam(':shortName' 		, $checkCompany['COMP_CODE']);
		$st->bindParam(':ownerId' 			, $checkCompany['COMP_ID']);
		$st->bindParam(':adminId' 		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function updateAirline()
	{
		$sql = "
			BEGIN
   				sp_sa_airline_update
   				(
   					:outNum, 
   					:outMsg, 
   					:code2, 
   					:code3,
   					:name,
   					:shortName,
   					:ownerId,
   					:adminId
   				);
   			END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code2'			, $this->code2);
		$st->bindParam(':code3'			, $this->code3);
		$st->bindParam(':name'			, $this->name);
		$st->bindParam(':shortName'	 	, $this->shortName);
		$st->bindParam(':ownerId'		, $this->compId);
		$st->bindParam(':adminId'		, $this->adminId);
		// $this->dd($st->getRawSql());
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function deleteAirline()
	{
		$sql = "
			BEGIN
   				sp_sa_airline_delete
   				(
   					:outNum, 
   					:outMsg, 
   					:ownerId,
   					:adminId
   				);
   			END;
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':ownerId'		, $this->compId);
		$st->bindParam(':adminId'		, $this->adminId);
		// $this->dd($st->getRawSql());
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}	

	public function getAirlineList()
	{
		$where = '1=1';
		
		if ($this->searchType)
		{
			$where .= " AND (UPPER(code_3) LIKE UPPER('%".$this->search."%'))";
		}
		else
		{
			if ($this->code3)
			{
				$where .= " AND UPPER(code_3) LIKE UPPER('%".$this->code3."%')";
			}

			if ($this->code2)
			{
				$where .= " AND UPPER(code_2) LIKE UPPER('%".$this->code2."%')";
			}

			if ($this->airlineName)
			{
				$where .= " AND UPPER(name) LIKE UPPER('%".$this->airlineName."%')";
			}

			if ($this->shortName)
			{
				$where .= " AND UPPER(short_name) LIKE UPPER('%".$this->shortName."%')";
			}
		}

		$sql = "
			SELECT
				code_2,
				code_3,
				name,
				short_name,
				owner_id
			FROM
				ars_airline
			WHERE 
				$where
		";

		$st = $this->db->createCommand($sql);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getAirlineDetail()
	{
		$sql = "
			SELECT
				code_2,
				code_3,
				name,
				short_name,
				owner_id
			FROM
				ars_airline
			WHERE
				owner_id = :ownerId
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':ownerId', $this->compId);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function insertGlobalVariableDesc()
	{
		$sql = "
			SELECT
				count(*)
			FROM
				global_variables_desc
			WHERE
				var_name = UPPER(:varName)
		";
		$st = $this->db->createCommand($sql);
		$st->bindParam(':varName', $this->variableName);

		$countVarName = $st->queryScalar();

		if ($countVarName == "0")
		{
			$sql = "
				BEGIN
	   				SP_GLOBAL_VARIABLE_INSERT
	   				(
	   					:outNum, 
	   					:outMsg, 
	   					UPPER(:varName), 
	   					:desc, 
	   					:group,
	   					:adminId,
	   					:ownerId
	   				);
	   			END;
			";

			$st = $this->db->createCommand( $sql );
			$st->bindParam(':outNum', $outNum, PDO::PARAM_INT, 3);
			$st->bindParam(':outMsg', $outMsg, PDO::PARAM_STR, 255);
			$st->bindParam(':varName', $this->variableName);
			$st->bindParam(':desc', $this->description);
			$st->bindParam(':group', $this->group);
			$st->bindParam(':adminId', $this->adminId);
			$st->bindParam(':ownerId', $this->ownerId);
			$st->execute();
		}
		else
		{
			$outNum = 1;
			$outMsg = 'Global Variable already exist !';
		}

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function updateGlobalVariableDesc()
	{
		$sql = "
			BEGIN
     			sp_global_variable_update
     			(
     				:outNum, 
     				:outMsg, 
     				:varName, 
     				:varName, 
     				:desc, 
     				:group,
     				:adminId,
     				:ownerId
     			);
     		END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum', $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg', $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':varName', $this->variableName);
		$st->bindParam(':desc', $this->description);
		$st->bindParam(':group', $this->group);
		$st->bindParam(':adminId', $this->adminId);
		$st->bindParam(':ownerId', $this->ownerId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function getGlobalVariableDescDetail()
	{
		$sql = "
			SELECT
				g.var_name,
				g.var_desc,
				g.var_group
			FROM
				global_variables_desc g
			WHERE 
				g.var_name = :varName
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':varName', $this->variableName);
		$result = $this->pagination($st->getRawSql());
		// $this->dd($st->getRawSql());

		return $result;
	}

	public function getGlobalVariableDescList()
	{
		$where = '1 = 1';
		
		if ($this->searchType)
		{
			$where .= " AND (UPPER(g.var_name) LIKE UPPER('%" . $this->search . "%'))";
		}
		else
		{
			if ($this->searchVariableName)
			{
				$where .= " AND UPPER(g.var_name) LIKE UPPER('%" . $this->searchVariableName . "%')";
			}

			if ($this->searchDescription)
			{
				$where .= " AND UPPER(g.var_desc) LIKE UPPER('%" . $this->searchDescription . "%')";
			}

			if ($this->searchGroup)
			{
				$where .= " AND UPPER(g.var_group) LIKE UPPER('%" . $this->searchGroup . "%')";
			}
		}

		$sql = "
			SELECT
				g.var_name,
				g.var_desc,
				g.var_group
			FROM
				global_variables_desc g
			WHERE 
				$where
			ORDER BY
				g.var_name ASC
		";

		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getChanges()
	{
		$sql = "
			SELECT
				action,
				old_value,
				new_value
			FROM 
				ars_admin_history
			WHERE 
				id = :id
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':id', $this->requestId);
		//die(var_dump($st->getRawSql()));
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function addCompany()
	{
		$password 			= '';
		$characters 		= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength 	= strlen($characters);
		$randomString 		= '';
		$passValidHour 		= Yii::$app->params['passwordPolicy']['temporary_password_valid_time'];

		if ($this->useFtp != 'true')
		{
			$password = password_hash($this->adminPassword, PASSWORD_DEFAULT);
		}
		else
		{
			for ($i = 0; $i < 8; $i++) 
			{
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}

			$password = password_hash($randomString, PASSWORD_DEFAULT);
		}

		if ($this->adminPassword == $this->adminPasswordConfirm)
		{
			if ($this->useFtp != 'true') 
			{
				$this->adminPassword = password_hash($this->adminPassword, PASSWORD_DEFAULT);
			}		
			else
			{
				$this->adminPassword = password_hash($randomString, PASSWORD_DEFAULT);
			}

			$passwordUserSqiva = password_hash('201007', PASSWORD_DEFAULT);
			
			$sql = "
				BEGIN
					sp_member_insert
					(
						out_num 				=> :retCode,
					  	out_str		 			=> :retMsg,
						in_company_name 		=> :compName,
						in_company_short_name 	=> :compShortName,
						in_company_domain 		=> :compDomain,
						in_company_npwp 		=> :compNpwp,
						in_company_website 		=> :compSite,
						in_addr_1 				=> :addr,
						in_city 				=> :city,
						in_state 				=> :state,
						in_zip 					=> :zip,
						in_country 				=> :country,
						in_phone 				=> :phone,
						in_fax 					=> :fax,
						in_first_name 			=> :firstName,
						in_last_name 			=> :lastName,
						in_sex 					=> :sex,
						in_birth_date 			=> :birthdate,
						in_email 				=> :email,
						in_mobile				=> :mobile,
						in_user_id 				=> :userId,
						in_user_pw 				=> :userPw,
						in_crypt_pass 			=> :cryptPass,
						in_office_code 			=> :officeCode,
						in_office_name 			=> :officeName,
						in_office_city 			=> :officeCity,
						in_office_type			=> :officeType,
						in_password_sqiva 		=> :passSqiva,
						in_ccy 					=> :ccy,
						in_airport 				=> :airport,
						in_admin_id				=> :adminId,
						in_owner_id				=> :ownerId,
						in_pass_valid_hour		=> :passValidHour,
						in_use_ftp				=> :useFtp
					);
				END;
			";

			$st = $this->db->createCommand($sql);
			$st->bindParam(':retCode', $retCode, PDO::PARAM_INT, 3);
			$st->bindParam(':retMsg', $retMsg, PDO::PARAM_STR, 255);
			$st->bindParam(':compName', $this->companyName);
			$st->bindParam(':compShortName', $this->companySName);
			$st->bindParam(':compDomain', $this->companyDomain);
			$st->bindParam(':compNpwp', $this->companyNPWP);
			$st->bindParam(':compSite', $this->companyWebsite);
			$st->bindParam(':addr', $this->companyAddress1);
			$st->bindParam(':city', $this->companyCity);
			$st->bindParam(':state', $this->companyState);
			$st->bindParam(':zip', $this->companyZip);
			$st->bindParam(':country', $this->companyCountry);
			$st->bindParam(':phone', $this->companyPhone);
			$st->bindParam(':fax', $this->companyFax);
			$st->bindParam(':firstName', $this->adminFirstName);
			$st->bindParam(':lastName', $this->adminLastName);
			$st->bindParam(':sex', $this->adminGender);
			$st->bindParam(':birthdate', $this->adminBirthdate);
			$st->bindParam(':email', $this->adminEmail);
			$st->bindParam(':mobile', $this->adminMobile);
			$st->bindParam(':userId', $this->adminUserId);
			$st->bindParam(':userPw', $this->adminPassword);
			$st->bindParam(':cryptPass', $password);
			$st->bindParam(':officeCode', $this->officeCode);
			$st->bindParam(':officeName', $this->officeName);
			$st->bindParam(':officeCity', $this->officeCity);
			$st->bindParam(':officeType', $this->officeType);
			$st->bindParam(':passSqiva', $passwordUserSqiva);
			$st->bindParam(':ccy', $this->officeCcy);
			$st->bindParam(':airport', $this->officeStation);
			$st->bindParam(':adminId', $this->adminId);
			$st->bindParam(':ownerId', $this->ownerId);
			$st->bindParam(':passValidHour', $passValidHour);
			$st->bindParam(':useFtp', $this->useFtp);
			$st->execute();
		}
		else
		{
			$retCode = 1;
			$retMsg = 'Please re-check your password confirmation.';
		}

		return [
			'errNum' 		=> $retCode,
			'errStr' 		=> $retMsg,
			'newPassword' 	=> $randomString,
			'passValidHour' => $passValidHour
		];
	}

	public function getCompanyList()
	{
		$where = '1 = 1';
		
		if ($this->searchType)
		{
			$where .= " AND (UPPER(t1.comp_code) LIKE UPPER('%" . $this->shortName . "%'))";
		}
		else
		{
			if ($this->companyName)
			{
				$where .= " AND UPPER(t1.comp_name) LIKE UPPER('%" . $this->companyName . "%')";
			}

			if ($this->shortName)
			{
				$where .= " AND UPPER(t1.comp_code) LIKE UPPER('%" . $this->shortName . "%')";
			}

			if ($this->domain)
			{
				$where .= " AND UPPER(t1.domain) LIKE UPPER('%" . $this->domain . "%')";
			}

			if ($this->phone)
			{
				$where .= " AND UPPER(t2.phone) LIKE UPPER('%" . $this->phone . "%')";
			}

			if ($this->login)
			{
				$where .= " AND UPPER(t3.user_id) LIKE UPPER('%" . $this->login . "%')";
			}

			if ($this->adminName)
			{
				$where .= " AND UPPER(t3.first_name) || ' ' || UPPER(t3.last_name) LIKE UPPER('%" . $this->adminName . "%')";
			}
		}

		if ($this->sort == 'STATUS')
        {
        	if ($this->order == "desc")
        	{
        		$this->sort = "DECODE(status, 0, 1, 2, 2, 1, 3)";
        	}
        	else if ($this->order == "asc")
        	{
        		$this->sort = "DECODE(status, 1, 3, 0, 1, 2, 2)";
        	}
        }

		$sql = "
			SELECT 
				t1.comp_id, 
				t1.comp_npwp, 
				t2.addr1 || ' ' || t2.addr2 AS comp_addr,
				t2.city, 
				t2.state, 
				t2.zip, 
				t1.comp_name, 
				t1.comp_code, 
				t1.update_time,
				t2.phone, 
				t2.fax, 
				t1.comp_website,
				t3.first_name || ' ' || t3.last_name AS full_name, 
				t2.addr_id, 
				t2.country, 
				t2.addr1, 
				t2.addr2, 
				t3.first_name, 
				t3.last_name, 
				t3.email, 
				t3.mobile, 
				t3.user_id, 
				t1.domain, 
				t3.sex, 
				TO_CHAR(t3.birth_date,'YYYYMMDD') AS birth_date,
				t3.contact_id, 
				t1.status, 
				t4.office_name, 
				t4.office_code, 
				t4.office_type, 
				t4.airport, 
				t4.city_code, 
				t4.ccy
			FROM 
				companies t1, 
				addresses t2, 
				contacts t3,
				comp_offices t4
			WHERE
				$where 
				AND t1.comp_addr = t2.addr_id 
				AND t1.member_type = 1 
				AND t1.comp_admin = t3.contact_id 
				AND t4.office_id = t3.office_id
		";

		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getAdminCompanyAppList()
	{
		$sql = "
			SELECT
				ccy_code
			FROM
				ref_ccy
			ORDER BY
				ccy_code
		";

		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getGroupList()
	{		
		$sql = "
			SELECT 
				group_id,
				name
			FROM 
				admin_groups
			WHERE 
				owner_id = :ownerId
				AND UPPER(owner_type) NOT LIKE 'SUB'
			ORDER BY 
				name
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId', $this->ownerId);
		$result = $st->queryAll();

		return $result;
	}

	public function getUserList()
	{
		$sql = "
			SELECT
				t1.contact_id contact_id,
				t1.owner_type owner_type,
				CONCAT(t1.first_name,t1.last_name) full_name,
				LOWER(t2.office_name) office_name,
				t1.user_id user_id
			FROM contacts t1,comp_offices t2
			WHERE
				t1.status=1
				AND t1.user_id is not null
				AND t1.office_id = t2.office_id
				AND t1.owner_type = 'CA'
				AND t1.comp_id = :ownerId
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId' , $this->ownerId);
		//die(var_dump($st->getRawSql()));
		
		$result = $st->queryAll();

		return $result;
	}

	public function getAppList()
	{
		$sql = "
			SELECT
				app_code,
				parent_code,
				name,
				always_on,
				is_menu,
				url,
				parent_code
			FROM 
				admin_apps 
			WHERE 
				app_code IN(
					SELECT 
						app_code 
					FROM 
						admin_company_apps 
					WHERE
						comp_id=:ownerId
					UNION
					SELECT 
						app_code 
					FROM 
						admin_apps 
					WHERE
						always_on=1
				)
				--AND parent_code LIKE 'PAXLINK%'
				AND (
						parent_code LIKE 'PAXLINK%' 
						OR app_code LIKE 'PAXLINK%'
						--OR parent_code LIKE '%DCS%'  
						--OR app_code LIKE '%DCS%'
						OR parent_code LIKE '%AWAN-WS%'  
						OR app_code LIKE '%AWAN-WS%'
						OR app_code LIKE '%CREW-APP%'
						OR parent_code LIKE '%CREW-APP%'
					)
				AND name NOT IN ('Control Panel','My Profile')
			ORDER BY 
				app_order
		";
		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId', $this->ownerId);
		// die($this->dd($st->getRawSql()));
		$result = $st->queryAll();

		return $result;
	}

	public function searchSystemLog()
	{
		$where = '';
		
		if($this->searchType)
		{
			$where .= " AND t1.access_type = LOWER(:accessType) ";
		}
		else
		{
			if (!empty($this->accessType)) 
			{
				$where .= " AND t1.access_type = LOWER(:accessType) ";
			}
			if(!empty($this->user))
			{
				$where .= " AND t2.user_id LIKE LOWER(:user) ";
			}
			if(!empty($this->accessFrom))
			{
				$where .= " AND t1.remote_addr = :accessFrom ";
			}
		}

		$sql = "
			SELECT
				t1.access_time,
				TO_CHAR(TO_DATE(TO_CHAR(t1.access_time,'dd-mm-yyyy hh24:mi:ss'),'DD-MM-YYYY HH24:MI:SS'),'DD-MM-YYYY HH24:MI:SS') time,
				t2.user_id,
				t1.remote_addr access_from,
				t1.access_type, 
				CASE
					WHEN t1.access_notes IS NULL THEN ''
					WHEN t1.access_type LIKE '%adm_%' THEN (SELECT user_id FROM contacts WHERE contact_id = to_number(t1.access_notes))
					ELSE t1.access_notes
				END CASE,
				t1.admin_id,
				t2.comp_id owner_id
			FROM 
				log_admin_access t1,
				contacts t2
			WHERE
				t2.contact_id = t1.admin_id
				AND t1.owner_type IN ('SSA', 'SA')
				AND t2.comp_id = :ownerId
				AND t1.access_time >= TO_DATE(:from,'YYYYMMDDHH24:MI') 
				AND t1.access_time <= TO_DATE(:to,'YYYYMMDDHH24:MI')
				AND t1.remote_addr NOT LIKE '::1'
				$where
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId' , $this->ownerId);
		$st->bindParam(':utc' , Yii::$app->params['utc']);
		$st->bindParam(':accessType' , $this->accessType);
		$st->bindParam(':accessFrom' , $this->accessFrom);
		$st->bindParam(':user' , $this->user);
		$st->bindParam(':dateFrom' , $this->dateFrom);
		$st->bindParam(':dateTo' , $this->dateTo);
		$st->bindParam(':timeFrom' , $this->timeFrom);
		$st->bindParam(':timeTo' , $this->timeTo);
		$st->bindParam(':from' , $this->from);
		$st->bindParam(':to' , $this->to);
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getServerUTC()
	{
		$sql = "
			SELECT
				SUBSTR(TZ_OFFSET(sessiontimezone), 1, 3) + SUBSTR(TZ_OFFSET(sessiontimezone), 5, 2) / 60
			FROM
				dual
		";

		$st = $this->db->createCommand($sql);
		$result = $st->queryScalar();

		return $result;
	}

	public function getAccessType()
	{
		$sql = "
			SELECT 
				access_type accessType
			FROM
				ref_log_access 
			ORDER BY
				access_type
		";

		$st = $this->db->createCommand($sql);
		$result = $st->queryAll();
		
		return $result;
	}

	public function getActionList()
	{
		$sql = "
			SELECT DISTINCT action 
			FROM ars_admin_history
		";

		$st = $this->db->createCommand( $sql );
		$result = $st->queryAll();
		return $result;
	}

	public function searchAdminLog()
	{
		$officeId = Yii::$app->session['OFFICE_ID'];

		// UTC + 9
		$timeDifference = 0;

		$search_sql	= "";
		$sql = "
			SELECT
				app_code,
				parent_code,
				name
			FROM admin_apps
			WHERE 1=1
				AND app_code IN (SELECT app_code FROM admin_company_apps t1 WHERE owner_id=:ownerId)
			ORDER BY app_order
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId' , $this->ownerId);
		$result = $st->queryAll();
		
		$app_parent = array();
		$app_name = array();
		
		for($i=0;$i<sizeof($result);$i++){
			array_push($app_parent, $result[$i]['PARENT_CODE']);
			array_push($app_name, $result[$i]['NAME']);
		}
		
		$where='';

		if($this->searchType){
			$where .= "AND UPPER(action) LIKE UPPER('%".$this->actionApp."%')";
		}
		else{
			if (!empty($this->actionBy)) 
			{
				$where .= "AND create_by = '".$this->actionBy."' ";
			}
			if(!empty($this->actionFor))
			{
				$where .= "AND action_to = '".$this->actionFor."' ";
			}
			if(!empty($this->actionType))
			{
				$where .= "AND action = '".$this->actionType."' ";
			}
			if(!empty($this->actionGroup))
			{
				$where .= "AND group_id = ".$this->actionGroup." ";
			}
			if(!empty($this->actionApp))
			{
				$where .= "AND t1.app_code = ".$this->actionApp." ";
			}
			if(!empty($this->from) && !empty($this->to))
			{
				$where .= "AND t1.create_time >= TO_DATE('".$this->from."','YYYYMMDDHH24:MI') AND t1.create_time <= TO_DATE('".$this->to."','YYYYMMDDHH24:MI')";
			}
		}

		$sql = "
			SELECT
				id,
				TO_CHAR(t1.create_time+(:timeDifference/24),'DD-MM-YYYY HH24:MI:SS') action_date,
				(SELECT user_id FROM contacts WHERE contact_id = t1.create_by) action_by,
				(	
					-- Company actions --
					CASE WHEN UPPER(action) LIKE '%MEMBER%' THEN
						NVL((SELECT UPPER(domain) FROM companies WHERE comp_id = action_to), 'N/A')
					WHEN upper(action) LIKE '%USER%' OR upper(action) LIKE '%PASSWORD%' THEN
						NVL((SELECT UPPER(user_id) FROM contacts WHERE contact_id = action_to),'N/A')
					ELSE
						'N/A'
					END
				) AS action_for,
				action,
				old_value,
				new_value
			FROM
				ars_admin_history t1
			WHERE 
				t1.owner_id = :ownerId
				AND t1.action NOT IN ('FTP PASSWORD')
				$where
			ORDER BY 
				action_date ASC
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':ownerId' , $this->ownerId);
		$st->bindParam(':timeDifference', $timeDifference);
		// $this->dd($st->getRawSql());
		$result = $this->pagination( $st->getRawSql() );
		
		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getAdminAppList()
	{
		$sql = "
			SELECT 
				a.*,
				length(a.parent_code) - length(replace(a.parent_code,'-','')) as counter
			FROM
				admin_apps a
			order by
				app_order
		";

		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function editCompany()
	{
		$password 	= '';
		$flag 		= 1;

		if ($this->adminChangePass == 1)
		{
			// get last 4 pass
			$sql = "		
				SELECT
					fn_get_last_fr_ps(:userId,:ownerId) AS lfp
				FROM
					DUAL
			";

			$st = $this->db->createCommand($sql);
			$st->bindParam(':ownerId' , $this->ownerId);
			$st->bindParam(':userId' , $this->adminId);
			$lfp = $st->queryOne()['LFP'];

			// if old pass not allowed
			if ($lfp != '')
			{
				$lfp = explode(',', $lfp);
				
				for ($h = 0; $h < sizeof($lfp); $h++)
				{
					// verify hash for match
					if (password_verify($this->adminPassword, $lfp[$h]) == true)
					{
						return [
							'errNum' => 1,
							'errStr' => 'New password must differ from any of your last four password'
						];
					}
				}
			}
			
			$password = password_hash($this->adminPassword, PASSWORD_DEFAULT);
		}

		if ($flag == 1)
		{
			$sql = "
				BEGIN
					sp_member_update
					(
						out_num 			=> :retCode,
					  	out_str		 		=> :retMsg,
						in_comp_id 				=> :compId,
						in_company_name 		=> :compName,
						in_company_short_name 	=> :compShortName,
						in_company_domain 		=> :compDomain,
						in_company_npwp 		=> :compNpwp,
						in_company_website 		=> :compSite,
						in_addr_id 				=> :addrId,
						in_addr_1 				=> :addr,
						in_city 				=> :city,
						in_state 				=> :state,
						in_status 				=> :status,
						in_zip 					=> :zip,
						in_country 				=> :country,
						in_phone 				=> :phone,
						in_fax 					=> :fax,
						in_contact_id 			=> :contactId,
						in_first_name 			=> :firstName,
						in_last_name 			=> :lastName,
						in_sex 					=> :sex,
						in_birth_date 			=> :birthdate,
						in_email 				=> :email,
						in_mobile				=> :mobile,
						in_crypt_pass 			=> :cryptPass,
						in_change_pass 			=> :changePass,
						in_admin_id				=> :adminId,
						in_owner_id				=> :ownerId
					);
				END;
			";

			$st = $this->db->createCommand($sql);
			$st->bindParam(':retCode', $retCode, PDO::PARAM_INT, 3);
			$st->bindParam(':retMsg', $retMsg, PDO::PARAM_STR, 255);
			$st->bindParam(':compId', $this->compId);
			$st->bindParam(':compName', $this->companyName);
			$st->bindParam(':compShortName', $this->companySName);
			$st->bindParam(':compDomain', $this->companyDomain);
			$st->bindParam(':compNpwp', $this->companyNPWP);
			$st->bindParam(':compSite', $this->companyWebsite);
			$st->bindParam(':addrId', $this->addrId);
			$st->bindParam(':addr', $this->companyAddress1);
			$st->bindParam(':city', $this->companyCity);
			$st->bindParam(':state', $this->companyState);
			$st->bindParam(':status', $this->companyStatus);
			$st->bindParam(':zip', $this->companyZip);
			$st->bindParam(':country', $this->companyCountry);
			$st->bindParam(':phone', $this->companyPhone);
			$st->bindParam(':fax', $this->companyFax);
			$st->bindParam(':contactId', $this->adminContactId);
			$st->bindParam(':firstName', $this->adminFirstName);
			$st->bindParam(':lastName', $this->adminLastName);
			$st->bindParam(':sex', $this->adminGender);
			$st->bindParam(':birthdate', $this->adminBirthdate);
			$st->bindParam(':email', $this->adminEmail);
			$st->bindParam(':mobile', $this->adminMobile);
			$st->bindParam(':cryptPass', $password);
			$st->bindParam(':changePass', $this->adminChangePass);
			$st->bindParam(':adminId', $this->adminId);
			$st->bindParam(':ownerId', $this->ownerId);
			$st->execute();
		}
		else
		{
			$retCode = 1;
			$retMsg = 'Please re-check your password confirmation.';
		}

		return [
			'errNum' => $retCode,
			'errStr' => $retMsg
		];
	}

	public function editCompanyApps()
	{		
		$tempCompanyApps = '';
		$newAppsList = '';
		$explodeData = explode(",", $this->companyApps);

		for ($i = 0; $i < sizeof($explodeData); $i++)
		{
			$tempCompanyApps .= "'" . $explodeData[$i] . "'" . ",";
			$newAppsList .= $explodeData[$i] . ",";
		}

		$dataCompanyAppList = substr($tempCompanyApps, 0, strlen($tempCompanyApps) - 1);
		$newAppsList = substr($newAppsList, 0, strlen($newAppsList) - 1);

		$sql = "
			DECLARE
				type array_t IS TABLE OF VARCHAR2(100);
				v_app_list array_t := array_t(". $dataCompanyAppList .");
				v_new_app CLOB := '". $newAppsList ."';
				v_comp_id NUMBER := ". $this->compId .";
				v_admin_id NUMBER := ". $this->adminId .";
				v_owner_id NUMBER := ". $this->ownerId .";
			BEGIN
				SP_MEMBER_APPS_HISTORY
				(
					:retCode,
					:retMsg,
					v_new_app,
					v_comp_id,
					v_admin_id,
					v_owner_id
				);

				DELETE 
				FROM
					admin_company_apps
				WHERE
					comp_id = v_comp_id;

				FOR i IN 1..v_app_list.COUNT
				LOOP
					SP_UPDATE_COMPANY_APPS
					(
						:retCode,
						:retMsg,
						v_app_list(i),
						v_comp_id,
						v_admin_id
					);
				END LOOP;
			END;	
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':retCode', $retCode, PDO::PARAM_INT, 3);
		$st->bindParam(':retMsg', $retMsg, PDO::PARAM_STR, 255);
		$st->execute();

		return [
			'errNum' => 0,
			'errStr' => 'Success'
		];
	}

	public function updateGlobalVariable()
	{
		$tempName = '';
		$tempValue = '';
		$tempNumber = '';
		$newGvList = '';

		for ($i = 0; $i < sizeof($this->name); $i++)
		{
			$tempName .= "'" . $this->name[$i] . "'" . ",";
			$tempValue .= "'" . $this->value[$i] . "'" . ",";
			$tempNumber .= "'" . $this->number[$i] . "'" . ",";
			
			if($this->value[$i] || $this->number[$i])
			{
				$nam = $this->name[$i]; 
				$val = $this->value[$i]?$this->value[$i]:'N/A';
				$num = $this->number[$i]?$this->number[$i]:'N/A';

				$newGvList .= $nam . " (" . $val . "-" . $num . ")" . ",";
			}
		}

		$dataName = substr($tempName, 0, strlen($tempName) - 1);
		$dataValue = substr($tempValue, 0, strlen($tempValue) - 1);
		$dataNumber = substr($tempNumber, 0, strlen($tempNumber) - 1);
		$newGvList = substr($newGvList, 0, strlen($newGvList) - 1);

		$sql = "
			DECLARE
				type array_t IS TABLE OF VARCHAR2(100);
				v_check NUMBER := 0;
				v_name array_t := array_t(". $dataName .");
				v_value array_t := array_t(". $dataValue .");
				v_number array_t := array_t(". $dataNumber .");
				v_new_gv CLOB := '". $newGvList ."';
				v_comp_id NUMBER := ". $this->compId .";
				v_admin_id NUMBER := ". $this->adminId .";
				v_owner_id NUMBER := ". $this->ownerId .";
			BEGIN
				SP_MEMBER_GV_HISTORY
				(
					:retCode,
					:retMsg,
					v_new_gv,
					v_comp_id,
					v_admin_id,
					v_owner_id
				);

				FOR i IN 1..v_name.COUNT
				LOOP
					SELECT 
						COUNT(var_name)
					INTO 
						v_check
					FROM   
						global_variables
					WHERE  
						var_name = v_name(i)
						AND owner_id = v_comp_id;

					IF v_check = 0 THEN
	  				
		  				INSERT INTO global_variables
		              	(
							var_name,
							var_value,
							owner_id,
							var_number
		              	)
		              	VALUES
		              	(
							v_name(i),
							v_value(i),
							v_comp_id,
							v_number(i)
		             	);

	             	ELSE
						UPDATE global_variables
						SET    
							var_number = v_number(i),
						 	var_value = v_value(i)
						WHERE  
							var_name = v_name(i)
							AND owner_id = v_comp_id;

					END IF;
				END LOOP;

			END;
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':retCode', $retCode, PDO::PARAM_INT, 3);
		$st->bindParam(':retMsg', $retMsg, PDO::PARAM_STR, 255);
		$st->execute();

		return [
			'errNum' => 0,
			'errStr' => 'Success'
		];
	}

	public function searchUserActivity()
	{
		$where = '';
		
		if($this->searchType)
		{
			$where .= "AND UPPER(first_name || ' ' || last_name) LIKE UPPER(:search)";
		}
		else
		{
			if ($this->userId)
			{
				$where .= "AND UPPER(user_id) LIKE UPPER(:userId)";
			}

			if ($this->userName)
			{
				$where .= "AND UPPER(first_name || ' ' || last_name) LIKE UPPER(:userName)";
			}
			
			if ($this->status)
			{
				if(strtoupper($this->status) == "NEVER ACTIVE")
				{
					$where .= "AND LAST_ACTIVITY IS NULL";
				}
				else if(strtoupper($this->status) == "INACTIVE")
				{
					$where .= "AND (SYSDATE-LAST_ACTIVITY) * 24 * 60 > 60";
				}
				else if(strtoupper($this->status) == "ACTIVE")
				{
					$where .= "AND (SYSDATE-LAST_ACTIVITY) * 24 * 60 <= 60";
				}
			}
		}

		$sql = "
			SELECT 
				CONTACT_ID,
				FIRST_NAME || '/' || LAST_NAME AS FULL_NAME,
				SEX,
				USER_ID,
				TO_CHAR(last_activity ,'DD-MON-YYYY HH24:MI') LAST_ACTIVITY,
				CASE 
					WHEN LAST_ACTIVITY IS NULL THEN 
						'NEVER ACTIVE' 
					WHEN (SYSDATE-LAST_ACTIVITY) * 24 * 60 > 60 THEN 
						'INACTIVE' 
					ELSE 'ACTIVE' 
				END AS STATUS
			FROM 
				CONTACTS 
			WHERE 
				COMP_ID = :ownerId 				
				AND owner_type IN ('SSA', 'SA')
				$where
		";

		$search = '%' . $this->search . '%';
		$userId = '%' . $this->userId . '%';
		$userName = '%' . $this->userName . '%';

		$st = $this->db->createCommand($sql);
		$st->bindParam(':ownerId', $this->ownerId);
		$st->bindParam(':search', $search);
		$st->bindParam(':userId', $userId);
		$st->bindParam(':userName', $userName);
		$allData = $st->queryAll();
		$result = $this->pagination( $st->getRawSql() );

		$sql = "
			SELECT 
				CONTACT_ID
			FROM 
				CONTACTS 
			WHERE 
				COMP_ID = :ownerId 
				AND owner_type IN('SSA', 'SA')
				AND (SYSDATE-LAST_ACTIVITY) * 24 * 60 <= 60
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':ownerId', $this->ownerId);
		$activeData = $st->queryAll();

		$countActive = count($activeData);

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total'],
			'active' => $countActive,
		];
	}

	public function getUserHistory()
	{
		$sql = "
			SELECT 
				ACTIVITY_ID,
				ADMIN_ID,
				ACTIVITY,
				TO_CHAR(create_time,'DD-MON-YYYY HH24:MI') time_activity
			FROM 
				ARS_ADMIN_ACTIVITY 
			WHERE 
				ADMIN_ID = :contactId 
			ORDER BY 
				ACTIVITY_ID DESC
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':contactId', $this->contactId);
		$result = $this->pagination( $st->getRawSql() );

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getCompanyDetail()
	{
		$sql = "
			SELECT 
				t1.comp_id,
				t1.comp_npwp,
				TRIM(t2.addr1 || ' ' || t2.addr2) AS comp_addr,
				t2.city,
				t2.state,
				t2.zip,
				t1.comp_name,
				t1.comp_code,
				t2.phone,
				t2.fax,
				t1.comp_website,
				t3.first_name || ' ' || t3.last_name AS full_name,
				t2.addr_id,
				t2.country,
				t2.addr1,
				t2.addr2,
				t3.first_name,
				t3.last_name,
				t3.email,
				t3.mobile,
				t3.user_id,
				t1.domain,
				t3.sex,
				TO_CHAR(t3.birth_date,'YYYYMMDD') AS birthdate,
				t3.contact_id,
				t1.status,
				t4.office_name,
				t4.office_code,
				t4.office_type,
				t4.airport,
				t4.city_code,
				t4.ccy
			FROM 
				companies t1, 
				addresses t2, 
				contacts t3,
				comp_offices t4
			WHERE
				t1.comp_id = :compId
				AND t1.comp_addr = t2.addr_id 
				AND t1.member_type = 1 
				AND t1.comp_admin = t3.contact_id 
				AND t4.office_id = t3.office_id 
			ORDER BY
				t1.update_time DESC
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':compId', $this->compId);
		$companyData = $this->pagination($st->getRawSql());

		$sql = "
			SELECT
				TRIM(',' FROM CLOBAGG(ada.app_code || ',')) AS app_list
			FROM 
				admin_company_apps ada
			WHERE 
				ada.comp_id = :compId
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':compId', $this->compId);
		$appCompanyList = $this->pagination($st->getRawSql());

		$sql = "
			SELECT 
				gv.var_name,
				gv.var_value,
				gv.var_number,
				gvd.var_desc 
			FROM 
				global_variables gv,
				global_variables_desc gvd 
			WHERE 
				gv.var_name = gvd.var_name
				AND owner_id = :compId
			ORDER BY
				gvd.var_group,
				gvd.var_name
		";

		$st = $this->db->createCommand($sql);
		$st->bindParam(':compId', $this->compId);
		$globalVariableList = $st->queryAll();

		return [
			'errNum' => 0,
			'errstr' => '',
			'company' => $companyData['result'],
			'companyAppList' => $appCompanyList['result'],
			'globalVariableList' => $globalVariableList
		];
	}

	public function getCityListForCompany()
	{
		$sql = "
			SELECT 
				code, 
				name, 
				country_code, 
				utc
			FROM 
				city
			ORDER BY
				code
		";
		
		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function insertAirport()
	{
		$sql = "
			BEGIN
				sp_sa_airport_insert
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_name				=> :name,
				  	in_gmt 				=> :gmt,
				  	in_country_code 	=> :countryCode,
				  	in_city 			=> :city,
				  	in_code_4 			=> :code4,
				  	in_admin_id			=> :adminId,
				  	in_owner_id 		=> :ownerId
				);
			END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':name'			, $this->airportName);
		$st->bindParam(':gmt'			, $this->gmt);
		$st->bindParam(':countryCode'	, $this->countryCode);
		$st->bindParam(':city' 			, $this->city);
		$st->bindParam(':code4' 		, $this->code4);
		$st->bindParam(':adminId' 		, $this->adminId);
		$st->bindParam(':ownerId' 		, $this->ownerId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function updateAirport()
	{
		$sql = "
			BEGIN
				sp_sa_airport_update
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_name				=> :name,
				  	in_gmt 				=> :gmt,
				  	in_country_code 	=> :countryCode,
				  	in_city 			=> :city,
				  	in_code_4 			=> :code4,
				  	in_admin_id			=> :adminId,
				  	in_owner_id 		=> :ownerId
				);
			END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':name'			, $this->airportName);
		$st->bindParam(':gmt'			, $this->gmt);
		$st->bindParam(':countryCode'	, $this->countryCode);
		$st->bindParam(':city' 			, $this->city);
		$st->bindParam(':code4' 		, $this->code4);
		$st->bindParam(':adminId' 		, $this->adminId);
		$st->bindParam(':ownerId' 		, $this->ownerId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function insertTemplate()
	{
		$sql = "
			BEGIN
				sp_aircraft_template_insert(
					out_code => :outCode,
					out_msg => :outMsg,
					in_type_code => UPPER(:typeCode),
					in_maker => UPPER(:maker),
					in_name => UPPER(:name),
					in_f_cabin => :fCabin,
					in_c_cabin => :cCabin,
					in_y_cabin => :yCabin,
					in_max_infant => :maxInfant,
					in_payload => :payload,
					in_cost => :cost,
					in_ac_bg_allow => :bgAllow,
					in_max_umnr => :maxUmnr,
					in_max_disability => :maxDisability,
					in_max_prepaid_baggage => :maxPrepaidBaggage,
					in_doi => :doi,
					in_dow => :dow,
					in_owner_id => :ownerId,
					in_admin_id => :adminId
				);
			END;
		";
		$st = $this->db->createCommand($sql);
		$st->bindParam(':outCode', $retCode, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg', $retMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':typeCode', $this->typeCode);
		$st->bindParam(':maker', $this->maker);
		$st->bindParam(':name', $this->name);
		$st->bindParam(':fCabin', $this->fCabin);
		$st->bindParam(':cCabin', $this->cCabin);
		$st->bindParam(':yCabin', $this->yCabin);
		$st->bindParam(':maxInfant', $this->maxInfant);
		$st->bindParam(':payload', $this->payload);
		$st->bindParam(':cost', $this->cost);
		$st->bindParam(':bgAllow', $this->bgAllow);
		$st->bindParam(':maxUmnr', $this->maxUmnr);
		$st->bindParam(':maxDisability', $this->maxDisability);
		$st->bindParam(':maxPrepaidBaggage', $this->maxPrepaidBaggage);
		$st->bindParam(':doi', $this->doi);
		$st->bindParam(':dow', $this->dow);
		$st->bindParam(':ownerId', $this->ownerId);
		$st->bindParam(':adminId', $this->adminId);
		$st->execute();

		return [
			'errNum' => $retCode,
			'errStr' => $retMsg
		];
	}

	public function updateTemplate()
	{
		$sql = "
			BEGIN
				sp_aircraft_template_update_2(
					out_code => :outCode,
					out_msg => :outMsg,
					in_id => :templateId,
					in_type_code => UPPER(:typeCode),
					in_maker => UPPER(:maker),
					in_name => UPPER(:name),
					in_f_cabin => :fCabin,
					in_c_cabin => :cCabin,
					in_y_cabin => :yCabin,
					in_max_infant => :maxInfant,
					in_payload => :payload,
					in_cost => :cost,
					in_ac_bg_allow => :bgAllow,
					in_max_umnr => :maxUmnr,
					in_max_disability => :maxDisability,
					in_max_prepaid_baggage => :maxPrepaidBaggage,
					in_doi => :doi,
					in_dow => :dow,
					in_owner_id => :ownerId,
					in_admin_id => :adminId
				);
			END;
		";
		$st = $this->db->createCommand($sql);
		$st->bindParam(':outCode', $retCode, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg', $retMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':templateId', $this->templateId);
		$st->bindParam(':typeCode', $this->typeCode);
		$st->bindParam(':maker', $this->maker);
		$st->bindParam(':name', $this->name);
		$st->bindParam(':fCabin', $this->fCabin);
		$st->bindParam(':cCabin', $this->cCabin);
		$st->bindParam(':yCabin', $this->yCabin);
		$st->bindParam(':maxInfant', $this->maxInfant);
		$st->bindParam(':payload', $this->payload);
		$st->bindParam(':cost', $this->cost);
		$st->bindParam(':bgAllow', $this->bgAllow);
		$st->bindParam(':maxUmnr', $this->maxUmnr);
		$st->bindParam(':maxDisability', $this->maxDisability);
		$st->bindParam(':maxPrepaidBaggage', $this->maxPrepaidBaggage);
		$st->bindParam(':doi', $this->doi);
		$st->bindParam(':dow', $this->dow);
		$st->bindParam(':ownerId', $this->ownerId);
		$st->bindParam(':adminId', $this->adminId);
		$st->execute();
	
		return [
			'errNum' => $retCode,
			'errStr' => $retMsg
		];
	}

	public function deleteTemplate()
	{
		$sql = "
			BEGIN
				sp_aircraft_template_remove(
					out_code => :outCode,
					out_msg => :outMsg,
					in_id => :templateId,
					in_owner_id => :ownerId,
					in_admin_id => :adminId
				);
			END;
		";
		$st = $this->db->createCommand($sql);
		$st->bindParam(':outCode', $retCode, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg', $retMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':templateId', $this->templateId);
		$st->bindParam(':ownerId', $this->ownerId);
		$st->bindParam(':adminId', $this->adminId);
		$st->execute();

		return [
			'errNum' => $retCode,
			'errStr' => $retMsg
		];
	}

	public function getCityListForAirport()
	{
		$sql = "
			SELECT DISTINCT
				t1.name, 
				t1.country_code, 
				t2.name as country_name
			FROM 
				city t1, 
				country t2
			WHERE 
				t1.country_code = t2.code
		";

		$st = $this->db->createCommand( $sql );
		$result = $st->queryAll();

		return $result;
	}

	public function getCountryListForAirport()
	{
		$sql = "
			SELECT
				code, 
				name
			FROM 
				country
		";

		$st = $this->db->createCommand( $sql );
		$result = $st->queryAll();

		return $result;
	}

	public function getAirportDetail()
	{
		$sql = "
			SELECT
				t1.code,
				t1.name,
				t1.gmt,
				t3.code as country_code,
				t1.city,
				t1.code_4
			FROM  
				ars_airport t1,
				country t3
			WHERE 
				t1.code = :code
				AND t1.country_code = t3.code
			ORDER BY t1.name DESC
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':code', $this->code);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getAirportList()
	{
		$where = '1=1';
		
		if ($this->searchType)
		{
			$where .= " AND (t1.code LIKE UPPER('%".$this->code."%'))";
		}
		else
		{
			if ($this->code)
			{
				$where .= " AND t1.code LIKE UPPER('%".$this->code."%')";
			}

			if ($this->airportName)
			{
				$where .= " AND t1.name LIKE UPPER('%".$this->airportName."%')";
			}

			if ($this->countryCode)
			{
				$where .= " AND t1.country_code LIKE UPPER('%".$this->countryCode."%')";
			}

			if ($this->city)
			{
				$where .= " AND t1.city LIKE UPPER('%".$this->city."%')";
			}
		}

		$sql = "
			SELECT
				t1.code,
				t1.name,
				t1.gmt,
				t3.code as country_code,
				t1.city,
				t1.code_4
			FROM  
				ars_airport t1,
				country t3
			WHERE 
				$where
				AND t1.country_code = t3.code
			ORDER BY t1.name DESC
		";

		$st = $this->db->createCommand($sql);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function updateCcy()
	{
		$sql = "
			BEGIN
				sp_sa_ccy_update
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_name				=> :name,
				  	in_admin_id 		=> :adminId
				);
			END;
		";
		
		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':name'			, $this->ccyName);
		$st->bindParam(':adminId'		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function insertCcy()
	{
		$sql = "
			BEGIN
				sp_sa_ccy_add
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_name				=> :name,
				  	in_admin_id 		=> :adminId
				);
			END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':name'			, $this->ccyName);
		$st->bindParam(':adminId'		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function getCcyDetail()
	{
		$sql = "
			SELECT
				ccy_code,
				ccy_name
			FROM
				ref_ccy
			WHERE
				ccy_code = :code
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':code', $this->code);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getCcyList()
	{
		$where = '1=1';
		
		if ($this->searchType)
		{
			$where .= " AND (ccy_code LIKE UPPER('%".$this->code."%'))";
		}
		else
		{
			if ($this->code)
			{
				$where .= " AND ccy_code LIKE UPPER('%".$this->code."%')";
			}

			if ($this->ccyName)
			{
				$where .= " AND ccy_name LIKE UPPER('%".$this->ccyName."%')";
			}	
		}

		$sql = "
			SELECT
				ccy_code,
				ccy_name
			FROM
				ref_ccy
			WHERE
				$where
			ORDER BY
				ccy_code
		";

		$st = $this->db->createCommand($sql);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function updateCity()
	{
		$sql = "
			BEGIN
				sp_sa_city_update
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_city_name		=> :cityName,
				  	in_country_code		=> :countryCode,
				  	in_utc 				=> :utc,
				  	in_admin_id 		=> :adminId
				);
			END;
		";
		
		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':cityName'		, $this->cityName);
		$st->bindParam(':countryCode'	, $this->countryCode);
		$st->bindParam(':utc'			, $this->utc);
		$st->bindParam(':adminId'		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function insertCity()
	{
		$sql = "
			BEGIN
				sp_sa_city_add
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_city_name		=> :cityName,
				  	in_country_code		=> :countryCode,
				  	in_utc 				=> :utc,
				  	in_admin_id 		=> :adminId
				);
			END;
		";

		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':cityName'		, $this->cityName);
		$st->bindParam(':countryCode'	, $this->countryCode);
		$st->bindParam(':utc'			, $this->utc);
		$st->bindParam(':adminId'		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function getCityList()
	{
		$where = '1=1';
		
		if ($this->searchType)
		{
			$where .= " AND (code LIKE UPPER('%".$this->code."%'))";
		}
		else
		{
			if ($this->code)
			{
				$where .= " AND code LIKE UPPER('%".$this->code."%')";
			}

			if ($this->cityName)
			{
				$where .= " AND name LIKE UPPER('%".$this->cityName."%')";
			}

			if ($this->countryCode)
			{
				$where .= " AND country_code LIKE UPPER('%".$this->countryCode."%')";
			}
		}

		$sql = "
			SELECT 
				code, 
				name, 
				country_code, 
				utc
			FROM 
				city 
			WHERE
				$where
			ORDER BY code
		";

		$st = $this->db->createCommand($sql);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

	public function getCityDetail()
	{
		$sql = "
			SELECT 
				code, 
				name, 
				country_code, 
				utc
			FROM 
				city 
			WHERE
				code = UPPER(:code)
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':code', $this->code);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getCountryDetail()
	{
		$sql = "
			SELECT
				code,
				name,
				ccy,
				airport_tax_code
			FROM
				country
			WHERE
				code = UPPER(:code)
		";
		
		$st = $this->db->createCommand($sql);
		$st->bindParam(':code', $this->code);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getCurrencyList()
	{
		$sql = "
			SELECT
				ccy_code
			FROM
				ref_ccy
			ORDER BY
				ccy_code
		";

		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getAirportListForCompany()
	{
		$sql = "
			SELECT
				t1.code,
				t1.name,
				t1.gmt,
				t3.code AS country_code,
				t1.city,
				t1.code_4
			FROM  
				ars_airport t1,
				country t3
			WHERE 
				t1.country_code = t3.code
			ORDER BY
				t1.code ASC
		";
		
		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function updateCountry()
	{
		$sql = "
			BEGIN
				sp_sa_country_update
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_country_name		=> :countryName,
				  	in_ccy				=> :ccy,
				  	in_airport_tax_code => :airportTaxCode,
				  	in_admin_id 		=> :adminId
				);
			END;
		";
		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':countryName'	, $this->countryName);
		$st->bindParam(':ccy'			, $this->ccy);
		$st->bindParam(':airportTaxCode', $this->airportTaxCode);
		$st->bindParam(':adminId'		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function insertCountry()
	{
		$sql = "
			BEGIN
				sp_sa_country_add
				(
					out_ret_code 		=> :outNum,
				  	out_msg		 		=> :outMsg,
				  	in_code	 			=> :code,
				  	in_country_name		=> :countryName,
				  	in_ccy				=> :ccy,
				  	in_airport_tax_code => :airportTaxCode,
				  	in_admin_id 		=> :adminId
				);
			END;
		";
		$st = $this->db->createCommand( $sql );
		$st->bindParam(':outNum' 		, $outNum, PDO::PARAM_INT, 3);
		$st->bindParam(':outMsg' 		, $outMsg, PDO::PARAM_STR, 255);
		$st->bindParam(':code'			, $this->code);
		$st->bindParam(':countryName'	, $this->countryName);
		$st->bindParam(':ccy'			, $this->ccy);
		$st->bindParam(':airportTaxCode', $this->airportTaxCode);
		$st->bindParam(':adminId'		, $this->adminId);
		$st->execute();

		return [
			'errNum' => $outNum,
			'errStr' => $outMsg,
		];
	}

	public function getGlobalVariableList()
	{
		$sql = "
			SELECT 
				gvd.var_group,
				gvd.var_name,
				gvd.var_desc 
			FROM  
				global_variables_desc gvd
			ORDER BY 
				gvd.var_group,
				gvd.var_name
		";
		
		$st = $this->db->createCommand($sql);
		$result = $this->pagination($st->getRawSql());

		return $result;
	}

	public function getCountryList()
	{
		$where = '1=1';
		
		if ($this->searchType)
		{
			$where .= " AND (code LIKE UPPER('%".$this->code."%'))";
		}
		else
		{
			if ($this->code)
			{
				$where .= " AND code LIKE UPPER('%".$this->code."%')";
			}

			if ($this->countryName)
			{
				$where .= " AND name LIKE UPPER('%".$this->countryName."%')";
			}
		}

		$sql = "
			SELECT
				code,
				name,
				ccy,
				airport_tax_code
			FROM 
				country t1
			WHERE
				$where
			ORDER BY 
				t1.code ASC
		";

		$st = $this->db->createCommand($sql);
		// $this->dd($st->getRawSql());
		$result = $this->pagination($st->getRawSql());

		return [
			'errNum' => 0,
			'errStr' => '',
			'data' => $result['result'],
			'total' => $result['total']
		];
	}

}
