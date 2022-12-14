<?php
/**
 * @package Unlimited Elements
 * @author unlimited-elements.com
 * @copyright (C) 2012 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('UNLIMITED_ELEMENTS_INC') or die('Restricted access');

class UniteCreatorSettingsMultisource{
	
	private $settings;
	private $objAddon;
	private $arrPostFields;
	private $arrTermsFields;
	private $arrUsersFields;
	private $arrMenuFields;
	private $arrInstaFields;
	private $paramsItems;
	
	const TYPE_JSONCSV = "jsoncsv";
	const TYPE_REPEATER = "repeater";
	const TYPE_POSTS = "posts";
	const TYPE_TERMS = "terms";
	const TYPE_USERS = "users";
	const TYPE_MENU = "menu";
	const TYPE_INSTAGRAM = "instagram";
	
	
	
	public function __construct(){
		
		//for autocomplete
		$this->objAddon	= new UniteCreatorAddon();
		
		$this->objAddon = null;
		
		
		//init posts fields
		
		$this->arrPostFields = array(
			"default"=>__("-- Item Default --","unlimited-elements-for-elementor"),
			"static_value"=>__("-- Static Value --","unlimited-elements-for-elementor"),
			"title"=>__("Post Title","unlimited-elements-for-elementor"),
			"alias"=>__("Post Name","unlimited-elements-for-elementor"),
			"intro"=>__("Post Intro","unlimited-elements-for-elementor") ,
			"content"=>__("Post Content","unlimited-elements-for-elementor"),
			"image"=>__("Post Featured Image","unlimited-elements-for-elementor"),
			"date"=>__("Post Date","unlimited-elements-for-elementor"),
			"link"=>__("Post Url","unlimited-elements-for-elementor"),
			"meta_field"=>__("Post Meta Field","unlimited-elements-for-elementor")
		);
		
		$this->arrPostFields = array_flip($this->arrPostFields);
		
		
		/**
		 * init terms fields
		 */
		$this->arrTermsFields = array(
			"default"=>__("-- Item Default --","unlimited-elements-for-elementor"),
			"static_value"=>__("-- Static Value --","unlimited-elements-for-elementor"),
			"name"=>__("Term Title","unlimited-elements-for-elementor"),
			"slug"=>__("Term Name","unlimited-elements-for-elementor"),
			"description"=>__("Term Description","unlimited-elements-for-elementor"),
			"link"=>__("Term Link","unlimited-elements-for-elementor"),
			"num_posts"=>__("Num Posts","unlimited-elements-for-elementor"),
			"meta_field"=>__("Term Meta Field","unlimited-elements-for-elementor")
		);
		
		$this->arrTermsFields = array_flip($this->arrTermsFields);
		
		
		/**
		 * init users fields
		 */
		$this->arrUsersFields = array(
			"default"=>__("-- Item Default --","unlimited-elements-for-elementor"),
			"static_value"=>__("-- Static Value --","unlimited-elements-for-elementor"),
			"name"=>__("Name","unlimited-elements-for-elementor"),
			"username"=>__("Username","unlimited-elements-for-elementor"),
			"email"=>__("Email","unlimited-elements-for-elementor"),
			"url_posts"=>__("User Posts Url","unlimited-elements-for-elementor"),
			"role"=>__("Role","unlimited-elements-for-elementor"),
			"website"=>__("Website","unlimited-elements-for-elementor"),
			"user_avatar_image"=>__("User Avatar Image","unlimited-elements-for-elementor"),
			"user_num_posts"=>__("User Num Posts","unlimited-elements-for-elementor"),
			"meta_field"=>__("User Meta Field","unlimited-elements-for-elementor")
		);
		
		$this->arrUsersFields = array_flip($this->arrUsersFields);
		
		
		/**
		 * init menu fields
		 */
		$this->arrMenuFields = array(
			"default"=>__("-- Item Default --","unlimited-elements-for-elementor"),
			"static_value"=>__("-- Static Value --","unlimited-elements-for-elementor"),
			"title"=>__("Title","unlimited-elements-for-elementor"),
			"url"=>__("Url","unlimited-elements-for-elementor"),
			"target"=>__("Target","unlimited-elements-for-elementor"),
			"title_attribute"=>__("Title Attribute","unlimited-elements-for-elementor"),
			"description"=>__("Description","unlimited-elements-for-elementor"),
			"classes"=>__("Classes","unlimited-elements-for-elementor"),
			"html_link"=>__("HTML Link","unlimited-elements-for-elementor"),
			"meta_field"=>__("Menu Meta Field","unlimited-elements-for-elementor")
		);
		
		$this->arrMenuFields = array_flip($this->arrMenuFields);
		
		/**
		 * init insta fields
		 */
		$this->arrInstaFields = array(
			"default"=>__("-- Item Default --","unlimited-elements-for-elementor"),
			"static_value"=>__("-- Static Value --","unlimited-elements-for-elementor"),
			"caption_text"=>__("Caption","unlimited-elements-for-elementor"),
			"image"=>__("Image Url","unlimited-elements-for-elementor"),
			"thumb"=>__("Thumb Url","unlimited-elements-for-elementor"),
			"link"=>__("Link","unlimited-elements-for-elementor"),
			"type"=>__("Type (image,video)","unlimited-elements-for-elementor"),
			"url_video"=>__("Video Url","unlimited-elements-for-elementor")
		);
		
		$this->arrInstaFields = array_flip($this->arrInstaFields);
		
	}
	
	
	/**
	 * set the settings
	 */
	public function setSettings(UniteCreatorSettings $settings){

		$this->settings = $settings;
		$this->objAddon = GlobalsProviderUC::$activeAddonForSettings;
		
	}
	
	
	/**
	 * add items multisource
	 */
	public function addItemsMultisourceSettings($name, $value, $title, $param){
		
		UniteFunctionsUC::validateNotEmpty($this->settings, "settings object");
		
		$includedAttributes = UniteFunctionsUC::getVal($param, "multisource_included_attributes");
		
		$includedAttributes = trim($includedAttributes);
		
		$arrIncludedAttributes = explode(",", $includedAttributes);
		
		$arrIncludedAttributes = UniteFunctionsUC::arrayToAssoc($arrIncludedAttributes);
		
		
		//------ items source ------
		
		$arrSource = array();
		
		$arrSource["items"] = __("Items", "unlimited-elements-for-elementor");
		$arrSource["posts"] = __("Posts", "unlimited-elements-for-elementor");
		
		$metaRepeaterTitle = __("Current Post Meta Repeater", "unlimited-elements-for-elementor");
		
		$isAcfExists = UniteCreatorAcfIntegrate::isAcfActive();
		
		if($isAcfExists == true)
			$metaRepeaterTitle = __("Current Post ACF Repeater", "unlimited-elements-for-elementor");
		
		$arrSource["repeater"] = $metaRepeaterTitle;
		$arrSource["json_csv"] = __("JSON or CSV", "unlimited-elements-for-elementor");
		$arrSource["terms"] = __("Terms", "unlimited-elements-for-elementor");
		$arrSource["users"] = __("Users", "unlimited-elements-for-elementor");
		$arrSource["menu"] = __("Menu", "unlimited-elements-for-elementor");

		$hasInstagram = HelperProviderCoreUC_EL::isInstagramSetUp();
		
		if($hasInstagram)
			$arrSource["instagram"] = __("Instagram", "unlimited-elements-for-elementor");
		
		/*
		$isWooActive = UniteCreatorWooIntegrate::isWooActive();
		if($isWooActive == true)
			$arrSource["products"] = __("Products", "unlimited-elements-for-elementor");
						
		
		*/
		
		$arrSource = array_flip($arrSource);

		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_DROPDOWN;
		
		$this->settings->addSelect($name."_source", $arrSource, __("Items Source", "unlimited-elements-for-elementor"), "items", $params);
		
		if(empty($this->objAddon))
			return(false);

		$hasItems = $this->objAddon->isHasItems();

		if($hasItems == false)
			return(false);
		
		
		$paramsItems = $this->objAddon->getParamsItems();
		
		$paramsItems = $this->filterParamItemsByIncludedAttributes($paramsItems, $arrIncludedAttributes);
		
		if(empty($paramsItems))
			return(false);
			
		$this->paramsItems = $paramsItems;
		
		
		//posts
		
		$this->addMultisourceConnectors_object($name, $arrIncludedAttributes, self::TYPE_POSTS);
				
		$this->addMultisourceConnectors_repeater($name, $arrIncludedAttributes);
		
		$this->addMultisourceConnectors_jsonCsv($name, $arrIncludedAttributes);
		
		//terms
		
		$this->addMultisourceConnectors_object($name, $arrIncludedAttributes, self::TYPE_TERMS);
		
		//users
		
		$this->addMultisourceConnectors_object($name, $arrIncludedAttributes, self::TYPE_USERS);
		
		//menu
		
		$this->addMultisourceConnectors_object($name, $arrIncludedAttributes, self::TYPE_MENU);
		
		//instagram
		
		$this->addMultisourceConnectors_instagram($name, $arrIncludedAttributes);
		
		
		//--------- h3 before meta ---------- 
		
		$conditionMeta = array($name."_source"=>array(self::TYPE_POSTS, self::TYPE_TERMS, self::TYPE_USERS, self::TYPE_MENU));
				
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_HR;
		$params["elementor_condition"] = $conditionMeta;
		
		$this->settings->addHr($name."_hr_before_debug",$params);

		//--------- debug input data ---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_RADIOBOOLEAN;
		//$params["description"] = __("Show the current object (posts, terms etc) raw input data", "unlimited-elements-for-elementor");
		
		$this->settings->addRadioBoolean($name."_show_input_data", __("Debug - Show Input Data", "unlimited-elements-for-elementor"), false, "Yes", "No", $params);
		
		
		//--------- debug meta - for objects---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_RADIOBOOLEAN;
		//$params["description"] = __("Show the current object (posts, terms etc) meta fields, turn off it after choose the right one", "unlimited-elements-for-elementor");
		
		
		$params["elementor_condition"] = $conditionMeta;
		
		$this->settings->addRadioBoolean($name."_show_metafields", __("Debug - Show Meta Fields", "unlimited-elements-for-elementor"), false, "Yes", "No", $params);
		
	}
	
	
	/**
	 * filter params by included attributes array
	 */
	private function filterParamItemsByIncludedAttributes($params, $arrIncludedAttributes){
		
		if(empty($params))
			return($params);
			
		if(empty($arrIncludedAttributes))
			return($params);
		
		$arrParamsNew = array();
		
		foreach($params as $param){
			
			$name = UniteFunctionsUC::getVal($param, "name");
			
			if(isset($arrIncludedAttributes[$name]) == false)
				continue;
				
			$arrParamsNew[] = $param;
		}
		
		return($arrParamsNew);
	}
	
	
	/**
	 * add multisource connectors
	 */
	private function addMultisourceConnectors_object($name, $arrIncludedAttributes, $type ){
		
		$condition = array($name."_source"=>$type);
				
		// --- items source select 
		
		foreach($this->paramsItems as $itemParam){
			
			$this->putParamConnector_object($name, $itemParam, $condition, $type);
		}
		
	}

	/**
	 * add multisource connectors - repeater
	 */
	private function addMultisourceConnectors_instagram($name, $arrIncludedAttributes){
		
		$paramsItems = $this->objAddon->getParamsItems();
		
		$paramsItems = $this->filterParamItemsByIncludedAttributes($paramsItems, $arrIncludedAttributes);
		
		if(empty($paramsItems))
			return(false);
		
		$condition = array($name."_source"=>self::TYPE_INSTAGRAM);
			
		// --- items source select 
		
		foreach($this->paramsItems as $itemParam){
			
			$this->putParamConnector_regular($name, $itemParam, $condition, self::TYPE_INSTAGRAM);
		}

	}
	
	
	
	/**
	 * add multisource connectors - repeater
	 */
	private function addMultisourceConnectors_repeater($name, $arrIncludedAttributes){
		
		$paramsItems = $this->objAddon->getParamsItems();
		
		$paramsItems = $this->filterParamItemsByIncludedAttributes($paramsItems, $arrIncludedAttributes);
		
		if(empty($paramsItems))
			return(false);
		
		$condition = array($name."_source"=>"repeater");
				
		//-------------- repeater meta name ----------------
				
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTFIELD;
		$params["elementor_condition"] = $condition;
		$params["description"] = __("Choose the current post repeater field name, you can choose the show current post meta to see the meta fields", "unlimited-elements-for-elementor");;
		
		$text = __("Repeater Field Name", "unlimited-elements-for-elementor");
		
		$this->settings->addTextBox($name."_repeater_name", "", $text, $params);
		
		// --- items source select 
		
		foreach($this->paramsItems as $itemParam){
			
			$this->putParamConnector_regular($name, $itemParam, $condition, self::TYPE_REPEATER);
		}

		//--------- h3 before meta ---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_HR;
		$params["elementor_condition"] = $condition;
		
		$this->settings->addHr($name."_hr_before_debug_current_meta",$params);
		
		
		//--------- debug meta ---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_RADIOBOOLEAN;
		$params["description"] = __("Show the current post meta fields, turn off it after choose the right one", "unlimited-elements-for-elementor");
		$params["elementor_condition"] = $condition;
		
		$this->settings->addRadioBoolean($name."_show_current_meta", __("Debug - Show Current Meta", "unlimited-elements-for-elementor"), false, "Yes", "No", $params);
		
	}
	
	
	
	
	/**
	 * add dynamic field
	 */
	private function addMultisourceConnectors_jsonCsv($name, $arrIncludedAttributes){
								
		$condition = array($name."_source"=>"json_csv");
		
		
		//-------------- dynamic field ----------------
				
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTAREA;
		$params["elementor_condition"] = $condition;
		$params["description"] = __("Put some JSON data or CSV data of array with the items, or choose from dynamic field", "unlimited-elements-for-elementor");;
		$params["add_dynamic"] = true;
		
		$text = __("JSON or CSV Items Data", "unlimited-elements-for-elementor");
		
		$this->settings->addTextBox($name."_json_csv_dynamic_field", "", $text, $params);
		
		
		// --- items source select 
		foreach($this->paramsItems as $itemParam){
			
			$this->putParamConnector_regular($name, $itemParam, $condition, self::TYPE_JSONCSV);
		}
		
		
		//--------- h3 before meta ---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_HR;
		$params["elementor_condition"] = $condition;
		
		$this->settings->addHr($name."_hr_before_debug_jsoncsv",$params);
		
		
		//--------- debug json csv ---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_RADIOBOOLEAN;
		$params["description"] = __("Debug the dynamic field data, turn off it after choose the right one", "unlimited-elements-for-elementor");
		$params["elementor_condition"] = $condition;
		
		$this->settings->addRadioBoolean($name."_debug_jsoncsv_data", __("Debug Dynamic Field Data", "unlimited-elements-for-elementor"), false, "Yes", "No", $params);

		//--------- show example ---------- 
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_RADIOBOOLEAN;
		$params["description"] = __("Here you can show the example data and test it in the textarea", "unlimited-elements-for-elementor");
		$params["elementor_condition"] = $condition;
		
		$this->settings->addRadioBoolean($name."_show_example_jsoncsv", __("Show Example JSON and CSV Data", "unlimited-elements-for-elementor"), false, "Yes", "No", $params);
		
		
	}
	
	
	private function _________SINGLE_PARAM_CONNECTOR__________(){}
	
	
	/**
	 * get post param connector
	 */
	private function putParamConnector_object($fieldName, $param, $condition, $type){
		
		$title = UniteFunctionsUC::getVal($param, "title");
		
		if(empty($title))
			return(false);
			
		$name = UniteFunctionsUC::getVal($param, "name");
		
		if(empty($name))
			return(false);
		
		//-------------- select param ----------------
		
		//get fields
		
		switch($type){
			case self::TYPE_POSTS:
				$arrFields = $this->arrPostFields;
			break;
			case self::TYPE_TERMS:
				$arrFields = $this->arrTermsFields;
			break;
			case self::TYPE_USERS:
				$arrFields = $this->arrUsersFields;
			break;
			case self::TYPE_MENU:
				$arrFields = $this->arrMenuFields;
			break;
			default:
				
				UniteFunctionsUC::throwError("putParamConnector_object error - Wrong type: $type");
			break;
		}
			
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_DROPDOWN;
		$params["elementor_condition"] = $condition;
		
		$text = $title. " ".__("Source", "unlimited-elements-for-elementor");
		
		$selectName = $fieldName."_{$type}_field_source_$name";
		
		$this->settings->addSelect($selectName, $arrFields, $text, "default", $params);
		
		
		//-------------- meta field ----------------
		
		$conditionMetaField = $condition;
		$conditionMetaField[$selectName] = "meta_field";
				
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTFIELD;
		$params["elementor_condition"] = $conditionMetaField;
		
		
		$text = $title. " ".__("Meta Field", "unlimited-elements-for-elementor");
		
		$this->settings->addTextBox($fieldName."_{$type}_field_meta_{$name}", "", $text, $params);
		
		
		//-------------- static value ----------------
		
		$conditionMetaField = $condition;
		$conditionStaticValue[$selectName] = "static_value";
				
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTFIELD;
		$params["elementor_condition"] = $conditionStaticValue;
		$params["label_block"] = true;
		
		$text = $title. " ".__("Static Value", "unlimited-elements-for-elementor");
		
		$this->settings->addTextBox($fieldName."_{$type}_field_value_{$name}", "", $text, $params);
		
		
	}
	
	/**
	 * get post param connector
	 */
	private function putParamConnector_regular($fieldName, $param, $condition, $type){
		
		switch($type){
			case self::TYPE_REPEATER:
			default:
				$paramName = $fieldName."_repeater";
			break;
			case self::TYPE_JSONCSV:
				$paramName = $fieldName."_json_csv";
			break;
			case self::TYPE_INSTAGRAM:
				$paramName = $fieldName."_instagram";
			break;
		}
		
				
		$title = UniteFunctionsUC::getVal($param, "title");
		
		if(empty($title))
			return(false);
			
		$name = UniteFunctionsUC::getVal($param, "name");
		
		if(empty($name))
			return(false);
		
		$fieldTitle = __("Repeater Field Name","unlimited-elements-for-elementor");
		
		if(self::TYPE_JSONCSV)
			$fieldTitle = __("Item Field Name","unlimited-elements-for-elementor");
		
		
		//-------------- select type ----------------
		
		if($type == self::TYPE_INSTAGRAM)
			$arrOptions = $this->arrInstaFields;
			
		else{		//for csv and repeater
			
			$arrOptions = array(
				"default"=>__("-- Item Default --","unlimited-elements-for-elementor"),
				"static_value"=>__("-- Static Value --","unlimited-elements-for-elementor"),
				"field"=>$fieldTitle
			);
			
			$arrOptions = array_flip($arrOptions);
		}
		
		
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_DROPDOWN;
		$params["elementor_condition"] = $condition;
		
		$text = $title. " ".__("Source", "unlimited-elements-for-elementor");
		
		$selectName = $paramName."_field_source_$name";
		
		$this->settings->addSelect($selectName, $arrOptions, $text, "default", $params);
		
		
		//-------------- repeater field ----------------
		
		if($type != self::TYPE_INSTAGRAM){
		
			$conditionDataField = $condition;
			$conditionDataField[$selectName] = "field";
			
			$params = array();
			$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTFIELD;
			$params["elementor_condition"] = $conditionDataField;
			
			$text = $title. " ".$fieldTitle;
			
			$this->settings->addTextBox($paramName."_field_name_{$name}", "", $text, $params);
			
		}
		
		
		//-------------- static value ----------------
		
		$conditionDataField = $condition;
		$conditionStaticValue[$selectName] = "static_value";
				
		$params = array();
		$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTFIELD;
		$params["elementor_condition"] = $conditionStaticValue;
		$params["label_block"] = true;
		
		$text = $title. " ".__("Static Value", "unlimited-elements-for-elementor");
		
		$this->settings->addTextBox($paramName."_field_value_{$name}", "", $text, $params);
		
		
	}
	
	
	
}