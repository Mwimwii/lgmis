<?php
namespace PHPMaker2020\lgmis20;

/**
 * Class for index
 */
class index
{

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Constructor
	public function __construct() {
		$this->CheckToken = Config("CHECK_TOKEN");
	}

	// Terminate page
	public function terminate($url = "")
	{

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Page Redirecting event
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url != "") {
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $Language, $UserProfile, $Security, $Breadcrumb;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// User profile
		$UserProfile = new UserProfile();

		// Security object
		$Security = new AdvancedSecurity();
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Breadcrumb
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level
		if ($Security->allowList(CurrentProjectID() . 'local_authority'))
			$this->terminate("local_authoritylist.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 'account_ref_master'))
			$this->terminate("_account_ref_masterlist.php");
		if ($Security->allowList(CurrentProjectID() . 'account_sub_group'))
			$this->terminate("account_sub_grouplist.php");
		if ($Security->allowList(CurrentProjectID() . 'account_sub_type'))
			$this->terminate("account_sub_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'account_type'))
			$this->terminate("account_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'accountgroup'))
			$this->terminate("accountgrouplist.php");
		if ($Security->allowList(CurrentProjectID() . 'acting_reasons'))
			$this->terminate("acting_reasonslist.php");
		if ($Security->allowList(CurrentProjectID() . 'acting_status'))
			$this->terminate("acting_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'acting_type'))
			$this->terminate("acting_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'action'))
			$this->terminate("_actionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'action_type'))
			$this->terminate("action_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'activity'))
			$this->terminate("activitylist.php");
		if ($Security->allowList(CurrentProjectID() . 'allowance'))
			$this->terminate("allowancelist.php");
		if ($Security->allowList(CurrentProjectID() . 'appeal_status'))
			$this->terminate("appeal_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'appraisal_status'))
			$this->terminate("appraisal_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'asset'))
			$this->terminate("assetlist.php");
		if ($Security->allowList(CurrentProjectID() . 'asset_status'))
			$this->terminate("asset_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'asset_type'))
			$this->terminate("asset_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'asset_view'))
			$this->terminate("_asset_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'assistant_accountants'))
			$this->terminate("assistant_accountantslist.php");
		if ($Security->allowList(CurrentProjectID() . 'assistant_director_hradmin'))
			$this->terminate("assistant_director_hradminlist.php");
		if ($Security->allowList(CurrentProjectID() . 'assistant_procurements_officers'))
			$this->terminate("assistant_procurements_officerslist.php");
		if ($Security->allowList(CurrentProjectID() . 'bank'))
			$this->terminate("banklist.php");
		if ($Security->allowList(CurrentProjectID() . 'bank_branch'))
			$this->terminate("bank_branchlist.php");
		if ($Security->allowList(CurrentProjectID() . 'basic_salary'))
			$this->terminate("basic_salarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'bill'))
			$this->terminate("billlist.php");
		if ($Security->allowList(CurrentProjectID() . 'bill_board'))
			$this->terminate("bill_boardlist.php");
		if ($Security->allowList(CurrentProjectID() . 'bill_board_account'))
			$this->terminate("bill_board_accountlist.php");
		if ($Security->allowList(CurrentProjectID() . 'board_type'))
			$this->terminate("board_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'board_zone'))
			$this->terminate("board_zonelist.php");
		if ($Security->allowList(CurrentProjectID() . 'budget'))
			$this->terminate("budgetlist.php");
		if ($Security->allowList(CurrentProjectID() . 'Budget Allocation by Economic Classification Summary'))
			$this->terminate("Budget_Allocation_by_Economic_Classification_Summaryctb.php");
		if ($Security->allowList(CurrentProjectID() . 'Budget Allocation By Programme'))
			$this->terminate("Budget_Allocation_By_Programmectb.php");
		if ($Security->allowList(CurrentProjectID() . 'Budget Allocation By Programme and Sub Programme'))
			$this->terminate("Budget_Allocation_By_Programme_and_Sub_Programmectb.php");
		if ($Security->allowList(CurrentProjectID() . 'Budget Dashboard'))
			$this->terminate("_Budget_Dashboarddsb.php");
		if ($Security->allowList(CurrentProjectID() . 'budget_actual'))
			$this->terminate("budget_actuallist.php");
		if ($Security->allowList(CurrentProjectID() . 'budget_allocate_prog_view'))
			$this->terminate("budget_allocate_prog_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'budget_period'))
			$this->terminate("budget_periodlist.php");
		if ($Security->allowList(CurrentProjectID() . 'business'))
			$this->terminate("businesslist.php");
		if ($Security->allowList(CurrentProjectID() . 'business_sector'))
			$this->terminate("business_sectorlist.php");
		if ($Security->allowList(CurrentProjectID() . 'business_type_contracts'))
			$this->terminate("business_type_contractslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Cashier History Summary Report'))
			$this->terminate("Cashier_History_Summary_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Cashier Summary report'))
			$this->terminate("Cashier_Summary_reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'cashier_eod_view'))
			$this->terminate("cashier_eod_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'cashier_history_summary_view'))
			$this->terminate("cashier_history_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'cashier_summary_view'))
			$this->terminate("cashier_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'category'))
			$this->terminate("categorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'charge_group'))
			$this->terminate("charge_grouplist.php");
		if ($Security->allowList(CurrentProjectID() . 'charge_type'))
			$this->terminate("charge_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'charges'))
			$this->terminate("chargeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'client'))
			$this->terminate("clientlist.php");
		if ($Security->allowList(CurrentProjectID() . 'client_type'))
			$this->terminate("client_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'committee'))
			$this->terminate("committeelist.php");
		if ($Security->allowList(CurrentProjectID() . 'committee_appointed'))
			$this->terminate("committee_appointedlist.php");
		if ($Security->allowList(CurrentProjectID() . 'committee_role'))
			$this->terminate("committee_rolelist.php");
		if ($Security->allowList(CurrentProjectID() . 'community_development_officers'))
			$this->terminate("community_development_officerslist.php");
		if ($Security->allowList(CurrentProjectID() . 'condition'))
			$this->terminate("conditionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'contract'))
			$this->terminate("contractlist.php");
		if ($Security->allowList(CurrentProjectID() . 'contract_status'))
			$this->terminate("contract_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'contract_type'))
			$this->terminate("contract_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'contract_variation'))
			$this->terminate("contract_variationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'contractor'))
			$this->terminate("contractorlist.php");
		if ($Security->allowList(CurrentProjectID() . 'contractor_type'))
			$this->terminate("contractor_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'core_function'))
			$this->terminate("core_functionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'council_meeting'))
			$this->terminate("council_meetinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'council_meeting_type'))
			$this->terminate("council_meeting_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'council_resolution'))
			$this->terminate("council_resolutionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'council_type'))
			$this->terminate("council_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'councillor'))
			$this->terminate("councillorlist.php");
		if ($Security->allowList(CurrentProjectID() . 'councillor_allowance'))
			$this->terminate("councillor_allowancelist.php");
		if ($Security->allowList(CurrentProjectID() . 'councillor_type'))
			$this->terminate("councillor_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'councillorship'))
			$this->terminate("councillorshiplist.php");
		if ($Security->allowList(CurrentProjectID() . 'councillorship_history'))
			$this->terminate("councillorship_historylist.php");
		if ($Security->allowList(CurrentProjectID() . 'councillorship_status'))
			$this->terminate("councillorship_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'country'))
			$this->terminate("countrylist.php");
		if ($Security->allowList(CurrentProjectID() . 'credit'))
			$this->terminate("creditlist.php");
		if ($Security->allowList(CurrentProjectID() . 'credit_debit'))
			$this->terminate("credit_debitlist.php");
		if ($Security->allowList(CurrentProjectID() . 'currency'))
			$this->terminate("currencylist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_ref'))
			$this->terminate("current_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_total_deductions'))
			$this->terminate("current_total_deductionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_total_incomes'))
			$this->terminate("current_total_incomeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_total_lasf'))
			$this->terminate("current_total_lasflist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_total_napsa'))
			$this->terminate("current_total_napsalist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_total_netpay'))
			$this->terminate("current_total_netpaylist.php");
		if ($Security->allowList(CurrentProjectID() . 'current_total_obligations'))
			$this->terminate("current_total_obligationslist.php");
		if ($Security->allowList(CurrentProjectID() . 'debit'))
			$this->terminate("debitlist.php");
		if ($Security->allowList(CurrentProjectID() . 'deduction_schedule_view'))
			$this->terminate("deduction_schedule_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'deduction_type'))
			$this->terminate("deduction_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'deductions'))
			$this->terminate("deductionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'department'))
			$this->terminate("departmentlist.php");
		if ($Security->allowList(CurrentProjectID() . 'department_type'))
			$this->terminate("department_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'dept_section'))
			$this->terminate("dept_sectionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'deputy_council_secretary'))
			$this->terminate("deputy_council_secretarylist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailed_action'))
			$this->terminate("detailed_actionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'disciplinary_action_ref'))
			$this->terminate("disciplinary_action_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'district'))
			$this->terminate("districtlist.php");
		if ($Security->allowList(CurrentProjectID() . 'division'))
			$this->terminate("divisionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'document_text'))
			$this->terminate("document_textlist.php");
		if ($Security->allowList(CurrentProjectID() . 'economic_class_budget_view'))
			$this->terminate("economic_class_budget_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'employee_employer_schedule_view'))
			$this->terminate("employee_employer_schedule_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'employee_income'))
			$this->terminate("employee_incomelist.php");
		if ($Security->allowList(CurrentProjectID() . 'employee_obligation'))
			$this->terminate("employee_obligationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'employee_total_deductions'))
			$this->terminate("employee_total_deductionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'employer_contribution'))
			$this->terminate("employer_contributionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'employment'))
			$this->terminate("employmentlist.php");
		if ($Security->allowList(CurrentProjectID() . 'employment_acting'))
			$this->terminate("employment_actinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'employment_history'))
			$this->terminate("employment_historylist.php");
		if ($Security->allowList(CurrentProjectID() . 'employment_status'))
			$this->terminate("employment_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'employment_trans'))
			$this->terminate("employment_translist.php");
		if ($Security->allowList(CurrentProjectID() . 'employment_type'))
			$this->terminate("employment_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'End Of Day Cashier Report'))
			$this->terminate("End_Of_Day_Cashier_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'equipment_type'))
			$this->terminate("equipment_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'exit_reasons'))
			$this->terminate("exit_reasonslist.php");
		if ($Security->allowList(CurrentProjectID() . 'fire_certificate'))
			$this->terminate("fire_certificatelist.php");
		if ($Security->allowList(CurrentProjectID() . 'funding_source'))
			$this->terminate("funding_sourcelist.php");
		if ($Security->allowList(CurrentProjectID() . 'funding_source_training'))
			$this->terminate("funding_source_traininglist.php");
		if ($Security->allowList(CurrentProjectID() . 'goal'))
			$this->terminate("goallist.php");
		if ($Security->allowList(CurrentProjectID() . 'grade'))
			$this->terminate("gradelist.php");
		if ($Security->allowList(CurrentProjectID() . 'gross_deduction'))
			$this->terminate("gross_deductionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gross_income'))
			$this->terminate("gross_incomelist.php");
		if ($Security->allowList(CurrentProjectID() . 'halfyear_ref'))
			$this->terminate("halfyear_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'health_certificate'))
			$this->terminate("health_certificatelist.php");
		if ($Security->allowList(CurrentProjectID() . 'id_type'))
			$this->terminate("id_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'income_schedule_view'))
			$this->terminate("income_schedule_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'income_type'))
			$this->terminate("income_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'incomes'))
			$this->terminate("incomeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'indicator_direction'))
			$this->terminate("indicator_directionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'indicator_frequency'))
			$this->terminate("indicator_frequencylist.php");
		if ($Security->allowList(CurrentProjectID() . 'indicator_measure'))
			$this->terminate("indicator_measurelist.php");
		if ($Security->allowList(CurrentProjectID() . 'indicator_ref'))
			$this->terminate("indicator_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'ipc_tracking'))
			$this->terminate("ipc_trackinglist.php");
		if ($Security->allowList(CurrentProjectID() . 'job'))
			$this->terminate("joblist.php");
		if ($Security->allowList(CurrentProjectID() . 'job_group'))
			$this->terminate("job_grouplist.php");
		if ($Security->allowList(CurrentProjectID() . 'jobs_district'))
			$this->terminate("jobs_districtlist.php");
		if ($Security->allowList(CurrentProjectID() . 'jobs_municipality'))
			$this->terminate("jobs_municipalitylist.php");
		if ($Security->allowList(CurrentProjectID() . 'la_bank_account'))
			$this->terminate("la_bank_accountlist.php");
		if ($Security->allowList(CurrentProjectID() . 'la_program'))
			$this->terminate("la_programlist.php");
		if ($Security->allowList(CurrentProjectID() . 'la_sub_program'))
			$this->terminate("la_sub_programlist.php");
		if ($Security->allowList(CurrentProjectID() . 'la_type'))
			$this->terminate("la_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'lasf'))
			$this->terminate("lasflist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_accrual_ref'))
			$this->terminate("leave_accrual_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_accrued_trans'))
			$this->terminate("leave_accrued_translist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_applications'))
			$this->terminate("leave_applicationslist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_booked'))
			$this->terminate("leave_bookedlist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_record'))
			$this->terminate("leave_recordlist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_taken'))
			$this->terminate("leave_takenlist.php");
		if ($Security->allowList(CurrentProjectID() . 'leave_type'))
			$this->terminate("leave_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'licence_account'))
			$this->terminate("licence_accountlist.php");
		if ($Security->allowList(CurrentProjectID() . 'marital_status'))
			$this->terminate("marital_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'market'))
			$this->terminate("marketlist.php");
		if ($Security->allowList(CurrentProjectID() . 'market_property'))
			$this->terminate("market_propertylist.php");
		if ($Security->allowList(CurrentProjectID() . 'market_trans'))
			$this->terminate("market_translist.php");
		if ($Security->allowList(CurrentProjectID() . 'means_of_application'))
			$this->terminate("means_of_applicationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'meansofimplement'))
			$this->terminate("meansofimplementlist.php");
		if ($Security->allowList(CurrentProjectID() . 'medical_condition'))
			$this->terminate("medical_conditionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'moim_account'))
			$this->terminate("moim_accountlist.php");
		if ($Security->allowList(CurrentProjectID() . 'month_ref'))
			$this->terminate("month_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'Monthly Journal Report'))
			$this->terminate("Monthly_Journal_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Monthly Payroll Summary Report'))
			$this->terminate("Monthly_Payroll_Summary_Reportctb.php");
		if ($Security->allowList(CurrentProjectID() . 'monthly_journal'))
			$this->terminate("monthly_journallist.php");
		if ($Security->allowList(CurrentProjectID() . 'monthly_payroll_detail_journal_view'))
			$this->terminate("monthly_payroll_detail_journal_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'monthly_payroll_journal_view'))
			$this->terminate("monthly_payroll_journal_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'monthly_payroll_summary_view'))
			$this->terminate("_monthly_payroll_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'monthly_run'))
			$this->terminate("monthly_runlist.php");
		if ($Security->allowList(CurrentProjectID() . 'musers'))
			$this->terminate("muserslist.php");
		if ($Security->allowList(CurrentProjectID() . 'napsa'))
			$this->terminate("napsalist.php");
		if ($Security->allowList(CurrentProjectID() . 'NAPSA Summary Report'))
			$this->terminate("NAPSA_Summary_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'napsa_summary_view'))
			$this->terminate("napsa_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'napsa_view'))
			$this->terminate("_napsa_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'nationality'))
			$this->terminate("nationalitylist.php");
		if ($Security->allowList(CurrentProjectID() . 'ndp'))
			$this->terminate("ndplist.php");
		if ($Security->allowList(CurrentProjectID() . 'netpay'))
			$this->terminate("netpaylist.php");
		if ($Security->allowList(CurrentProjectID() . 'netpay_schedule'))
			$this->terminate("netpay_schedulelist.php");
		if ($Security->allowList(CurrentProjectID() . 'nhis'))
			$this->terminate("nhislist.php");
		if ($Security->allowList(CurrentProjectID() . 'obligation_schedule_view'))
			$this->terminate("obligation_schedule_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'occupation'))
			$this->terminate("occupationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'offense_category'))
			$this->terminate("offense_categorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'offense_penalty'))
			$this->terminate("offense_penaltylist.php");
		if ($Security->allowList(CurrentProjectID() . 'outcome'))
			$this->terminate("outcomelist.php");
		if ($Security->allowList(CurrentProjectID() . 'output'))
			$this->terminate("outputlist.php");
		if ($Security->allowList(CurrentProjectID() . 'output_indicator'))
			$this->terminate("output_indicatorlist.php");
		if ($Security->allowList(CurrentProjectID() . 'output_type'))
			$this->terminate("output_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'paye'))
			$this->terminate("payelist.php");
		if ($Security->allowList(CurrentProjectID() . 'PAYE Summary Report'))
			$this->terminate("PAYE_Summary_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_rates'))
			$this->terminate("paye_rateslist.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_report_view'))
			$this->terminate("paye_report_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_schedule_2'))
			$this->terminate("paye_schedule_2list.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_summary_view'))
			$this->terminate("paye_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_view'))
			$this->terminate("_paye_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payflexi_netpay_schedule'))
			$this->terminate("payflexi_netpay_schedulelist.php");
		if ($Security->allowList(CurrentProjectID() . 'payflexi_netpay_schedule_2'))
			$this->terminate("payflexi_netpay_schedule_2list.php");
		if ($Security->allowList(CurrentProjectID() . 'payment_list_view'))
			$this->terminate("payment_list_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payment_method'))
			$this->terminate("payment_methodlist.php");
		if ($Security->allowList(CurrentProjectID() . 'Payoll_totals'))
			$this->terminate("Payoll_totalssmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Payrol schedule by bank'))
			$this->terminate("Payrol_schedule_by_banksmry.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll'))
			$this->terminate("payrolllist.php");
		if ($Security->allowList(CurrentProjectID() . 'Payroll Income summary Report'))
			$this->terminate("Payroll_Income_summary_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Payroll Net Schedule'))
			$this->terminate("Payroll_Net_Schedulesmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Payroll Schedules'))
			$this->terminate("Payroll_Schedulessmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Payroll Summary Report'))
			$this->terminate("Payroll_Summary_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_import'))
			$this->terminate("payroll_importlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_income_summary_view'))
			$this->terminate("payroll_income_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_net_schedule_view'))
			$this->terminate("_payroll_net_schedule_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_period'))
			$this->terminate("payroll_periodlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_schedule'))
			$this->terminate("payroll_schedulelist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_schedule_view'))
			$this->terminate("_payroll_schedule_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_summary_view'))
			$this->terminate("payroll_summary_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_total_view'))
			$this->terminate("payroll_total_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payroll_upload'))
			$this->terminate("payroll_uploadlist.php");
		if ($Security->allowList(CurrentProjectID() . 'payslips.php'))
			$this->terminate("payslips.php");
		if ($Security->allowList(CurrentProjectID() . 'performance_measure'))
			$this->terminate("performance_measurelist.php");
		if ($Security->allowList(CurrentProjectID() . 'period_type'))
			$this->terminate("period_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'physical_challenge'))
			$this->terminate("physical_challengelist.php");
		if ($Security->allowList(CurrentProjectID() . 'pillars'))
			$this->terminate("pillarslist.php");
		if ($Security->allowList(CurrentProjectID() . 'pivot_deductions'))
			$this->terminate("pivot_deductionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'pivot_incomes'))
			$this->terminate("pivot_incomeslist.php");
		if ($Security->allowList(CurrentProjectID() . 'political_party'))
			$this->terminate("political_partylist.php");
		if ($Security->allowList(CurrentProjectID() . 'position_councillor'))
			$this->terminate("position_councillorlist.php");
		if ($Security->allowList(CurrentProjectID() . 'position_ref'))
			$this->terminate("position_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'position_status'))
			$this->terminate("position_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Potential Promotion Report'))
			$this->terminate("Potential_Promotion_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'print_bill_view'))
			$this->terminate("print_bill_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'printing.php'))
			$this->terminate("printing.php");
		if ($Security->allowList(CurrentProjectID() . 'professional_body'))
			$this->terminate("professional_bodylist.php");
		if ($Security->allowList(CurrentProjectID() . 'professional_level'))
			$this->terminate("professional_levellist.php");
		if ($Security->allowList(CurrentProjectID() . 'Program Budget Allocation'))
			$this->terminate("Program_Budget_Allocationsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'Program Budget By Economic Classification'))
			$this->terminate("Program_Budget_By_Economic_Classificationctb.php");
		if ($Security->allowList(CurrentProjectID() . 'Program Outputs'))
			$this->terminate("Program_Outputsctb.php");
		if ($Security->allowList(CurrentProjectID() . 'program_budget_view'))
			$this->terminate("program_budget_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'programme'))
			$this->terminate("programmelist.php");
		if ($Security->allowList(CurrentProjectID() . 'Programme Outputs'))
			$this->terminate("Programme_Outputssmry.php");
		if ($Security->allowList(CurrentProjectID() . 'programme_ref'))
			$this->terminate("programme_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'programme_type'))
			$this->terminate("programme_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'progress_status'))
			$this->terminate("progress_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'project'))
			$this->terminate("projectlist.php");
		if ($Security->allowList(CurrentProjectID() . 'project_sector'))
			$this->terminate("project_sectorlist.php");
		if ($Security->allowList(CurrentProjectID() . 'project_status'))
			$this->terminate("project_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'project_type'))
			$this->terminate("project_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'property'))
			$this->terminate("propertylist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_account'))
			$this->terminate("property_accountlist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_account_position_view'))
			$this->terminate("property_account_position_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_account_view'))
			$this->terminate("_property_account_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_group'))
			$this->terminate("property_grouplist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_lookup_view'))
			$this->terminate("property_lookup_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_no_use'))
			$this->terminate("property_no_uselist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_type'))
			$this->terminate("property_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_use'))
			$this->terminate("property_uselist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_valuation_roll'))
			$this->terminate("property_valuation_rolllist.php");
		if ($Security->allowList(CurrentProjectID() . 'property_zone'))
			$this->terminate("property_zonelist.php");
		if ($Security->allowList(CurrentProjectID() . 'province'))
			$this->terminate("provincelist.php");
		if ($Security->allowList(CurrentProjectID() . 'qualification'))
			$this->terminate("qualificationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'qualification_type'))
			$this->terminate("qualification_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'qualificationds_academic'))
			$this->terminate("qualificationds_academiclist.php");
		if ($Security->allowList(CurrentProjectID() . 'qualifications_professional'))
			$this->terminate("qualifications_professionallist.php");
		if ($Security->allowList(CurrentProjectID() . 'quarter_ref'))
			$this->terminate("quarter_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'receipt'))
			$this->terminate("receiptlist.php");
		if ($Security->allowList(CurrentProjectID() . 'receipt_header'))
			$this->terminate("receipt_headerlist.php");
		if ($Security->allowList(CurrentProjectID() . 'receipt_header_reverse'))
			$this->terminate("receipt_header_reverselist.php");
		if ($Security->allowList(CurrentProjectID() . 'receipt_reverse'))
			$this->terminate("receipt_reverselist.php");
		if ($Security->allowList(CurrentProjectID() . 'receipts_view'))
			$this->terminate("receipts_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'relationship'))
			$this->terminate("relationshiplist.php");
		if ($Security->allowList(CurrentProjectID() . 'rent_account'))
			$this->terminate("rent_accountlist.php");
		if ($Security->allowList(CurrentProjectID() . 'resolution_category'))
			$this->terminate("resolution_categorylist.php");
		if ($Security->allowList(CurrentProjectID() . 'resolution_view'))
			$this->terminate("resolution_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'result_area'))
			$this->terminate("result_arealist.php");
		if ($Security->allowList(CurrentProjectID() . 'retirement_type'))
			$this->terminate("retirement_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'rms_measures'))
			$this->terminate("rms_measureslist.php");
		if ($Security->allowList(CurrentProjectID() . 'salary_notch'))
			$this->terminate("salary_notchlist.php");
		if ($Security->allowList(CurrentProjectID() . 'salary_scale'))
			$this->terminate("salary_scalelist.php");
		if ($Security->allowList(CurrentProjectID() . 'security_matrix'))
			$this->terminate("security_matrixlist.php");
		if ($Security->allowList(CurrentProjectID() . 'self_registration'))
			$this->terminate("self_registrationlist.php");
		if ($Security->allowList(CurrentProjectID() . 'service_provider'))
			$this->terminate("service_providerlist.php");
		if ($Security->allowList(CurrentProjectID() . 'serviceprovidertype'))
			$this->terminate("serviceprovidertypelist.php");
		if ($Security->allowList(CurrentProjectID() . 'severity_level'))
			$this->terminate("severity_levellist.php");
		if ($Security->allowList(CurrentProjectID() . 'sex'))
			$this->terminate("sexlist.php");
		if ($Security->allowList(CurrentProjectID() . 'staff'))
			$this->terminate("stafflist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffchildren'))
			$this->terminate("staffchildrenlist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_action'))
			$this->terminate("staffdisciplinary_actionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_appeal'))
			$this->terminate("staffdisciplinary_appeallist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_case'))
			$this->terminate("staffdisciplinary_caselist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffexperience'))
			$this->terminate("staffexperiencelist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffprofbodies'))
			$this->terminate("staffprofbodieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffqualifications_academic'))
			$this->terminate("staffqualifications_academiclist.php");
		if ($Security->allowList(CurrentProjectID() . 'staffqualifications_prof'))
			$this->terminate("staffqualifications_proflist.php");
		if ($Security->allowList(CurrentProjectID() . 'standard_rate'))
			$this->terminate("standard_ratelist.php");
		if ($Security->allowList(CurrentProjectID() . 'strategic_objective'))
			$this->terminate("strategic_objectivelist.php");
		if ($Security->allowList(CurrentProjectID() . 'termcouncil_term'))
			$this->terminate("termcouncil_termlist.php");
		if ($Security->allowList(CurrentProjectID() . 'Third Party schedules'))
			$this->terminate("Third_Party_schedulessmry.php");
		if ($Security->allowList(CurrentProjectID() . 'third_party'))
			$this->terminate("third_partylist.php");
		if ($Security->allowList(CurrentProjectID() . 'ticket'))
			$this->terminate("ticketlist.php");
		if ($Security->allowList(CurrentProjectID() . 'ticket_category_ref'))
			$this->terminate("ticket_category_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'ticket_status'))
			$this->terminate("ticket_statuslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ticket_type'))
			$this->terminate("ticket_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'ticketmessage'))
			$this->terminate("ticketmessagelist.php");
		if ($Security->allowList(CurrentProjectID() . 'time_measure'))
			$this->terminate("time_measurelist.php");
		if ($Security->allowList(CurrentProjectID() . 'title_ref'))
			$this->terminate("title_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'Training Report'))
			$this->terminate("Training_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'training_record'))
			$this->terminate("training_recordlist.php");
		if ($Security->allowList(CurrentProjectID() . 'transaction_type'))
			$this->terminate("transaction_typelist.php");
		if ($Security->allowList(CurrentProjectID() . 'union_contribution'))
			$this->terminate("union_contributionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'unit_of_measure'))
			$this->terminate("unit_of_measurelist.php");
		if ($Security->allowList(CurrentProjectID() . 'unpostedcouncillors_view'))
			$this->terminate("unpostedcouncillors_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'user_role'))
			$this->terminate("user_rolelist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevelpermissions'))
			$this->terminate("userlevelpermissionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevels'))
			$this->terminate("userlevelslist.php");
		if ($Security->allowList(CurrentProjectID() . 'vacancies'))
			$this->terminate("vacancieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'Vacancy Report'))
			$this->terminate("Vacancy_Reportsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'vacancy_view'))
			$this->terminate("vacancy_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'valid_income_view'))
			$this->terminate("valid_income_viewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'valuation_roll'))
			$this->terminate("valuation_rolllist.php");
		if ($Security->allowList(CurrentProjectID() . 'virtual_table'))
			$this->terminate("virtual_tablelist.php");
		if ($Security->allowList(CurrentProjectID() . 'ward'))
			$this->terminate("wardlist.php");
		if ($Security->allowList(CurrentProjectID() . 'years'))
			$this->terminate("yearslist.php");
		if ($Security->allowList(CurrentProjectID() . 'yesno'))
			$this->terminate("yesnolist.php");
		if ($Security->allowList(CurrentProjectID() . 'ytd_gross'))
			$this->terminate("ytd_grosslist.php");
		if ($Security->allowList(CurrentProjectID() . 'ytd_paye'))
			$this->terminate("ytd_payelist.php");
		if ($Security->allowList(CurrentProjectID() . 'basic_salaries'))
			$this->terminate("basic_salarieslist.php");
		if ($Security->allowList(CurrentProjectID() . 'currently_employed_staff'))
			$this->terminate("currently_employed_stafflist.php");
		if ($Security->allowList(CurrentProjectID() . 'dont_pay_paye'))
			$this->terminate("dont_pay_payelist.php");
		if ($Security->allowList(CurrentProjectID() . 'grand_total_deduction'))
			$this->terminate("grand_total_deductionlist.php");
		if ($Security->allowList(CurrentProjectID() . 'grand_total_income'))
			$this->terminate("grand_total_incomelist.php");
		if ($Security->allowList(CurrentProjectID() . 'house_rent'))
			$this->terminate("house_rentlist.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_2021'))
			$this->terminate("paye_2021list.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_final'))
			$this->terminate("paye_finallist.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_final1'))
			$this->terminate("paye_final1list.php");
		if ($Security->allowList(CurrentProjectID() . 'paye_final_old'))
			$this->terminate("paye_final_oldlist.php");
		if ($Security->allowList(CurrentProjectID() . 'pos_ref'))
			$this->terminate("pos_reflist.php");
		if ($Security->allowList(CurrentProjectID() . 'staff_copy'))
			$this->terminate("staff_copylist.php");
		if ($Security->allowList(CurrentProjectID() . 'taxable_income'))
			$this->terminate("taxable_incomelist.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>