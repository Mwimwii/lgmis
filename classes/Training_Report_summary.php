<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class Training_Report_summary extends Training_Report
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'Training Report';

	// Page object name
	public $PageObjName = "Training_Report_summary";

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		return $url;
	}

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

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Training_Report)
		if (!isset($GLOBALS["Training_Report"]) || get_class($GLOBALS["Training_Report"]) == PROJECT_NAMESPACE . "Training_Report") {
			$GLOBALS["Training_Report"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Training_Report"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Training Report');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (musers)
		$UserTable = $UserTable ?: new musers();

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fsummary";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->isExport() && !$this->isExport("print") && $fn = Config("REPORT_EXPORT_FUNCTIONS." . $this->Export)) {
			$content = ob_get_clean();
			$this->$fn($content);
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection if not in dashboard
		if (!$DashboardReport)
			CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}

		// Exit if not in dashboard
		if (!$DashboardReport)
			exit();
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;
		if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar]))
			$lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
		$lookup->RenderEditFunc = ""; // Set up edit renderer

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}

	// Initialize common variables
	public $HideOptions = FALSE;
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Records
	public $GroupRecords = [];
	public $DetailRecords = [];
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count (start from 1 for each group)
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 1; // Groups per page
	public $GroupRange = 10;
	public $PageSizes = ""; // Page sizes (comma separated)
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = "";
	public $SearchPanelClass = "ew-search-panel collapse"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $DrillDownList = "";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $TotalCount;
	public $PageTotalCount;
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "ew-left";
	public $CenterContentClass = "col-sm-12 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb,
			$DashboardReport, $CustomExportType, $ReportExportType;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canReport()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header
		$ReportExportType = $ExportType; // Report export type, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Setup other options
		$this->setupOtherOptions();

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";

		// Set field visibility for detail fields
		$this->FormerFileNumber->setVisibility();
		$this->NRC->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->Sex->setVisibility();
		$this->MaritalStatus->setVisibility();
		$this->DateOfBirth->setVisibility();
		$this->AcademicQualification->setVisibility();
		$this->ProfessionalQualification->setVisibility();
		$this->MedicalCondition->setVisibility();
		$this->OtherMedicalConditions->setVisibility();
		$this->PhysicalChallenge->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->SubstantivePosition->setVisibility();
		$this->DateOfCurrentAppointment->setVisibility();
		$this->YearsOfService->setVisibility();
		$this->DateOfExit->setVisibility();
		$this->SalaryScale->setVisibility();
		$this->EmploymentType->setVisibility();
		$this->EmploymentStatus->setVisibility();
		$this->CouncilType->setVisibility();
		$this->FundingSource->setVisibility();
		$this->TrainingCost->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->TrainingType->setVisibility();
		$this->FieldOfTraining->setVisibility();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Load custom filters
		$this->Page_FilterLoad();

		// Extended filter
		$extendedFilter = "";

		// No filter
		$this->FilterOptions["savecurrentfilter"]->Visible = FALSE;
		$this->FilterOptions["deletefilter"]->Visible = FALSE;

		// Call Page Selecting event
		$this->Page_Selecting($this->SearchWhere);

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Get sort
		$this->Sort = $this->getSort();

		// Update filter
		AddFilter($this->Filter, $this->SearchWhere);

		// Get total count
		$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGroups > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
			if ($Security->canList()) {
				if ($this->SearchWhere == "0=101") {
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($Language->phrase("NoRecord"));
				}
			} else {
				$this->setWarningMessage(DeniedMessage());
			}
		}

		// Hide export options if export/dashboard report/hide options
		if ($this->isExport() || $DashboardReport || $this->HideOptions)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report/hide options
		if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Get current page records
		if ($this->TotalGroups > 0) {
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, $this->Sort);
			$rs = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
			$this->DetailRecords = $rs->getRows(); // Get records
			$this->GroupCount = 1;
		}
		$this->setupFieldCount();

		// Set the last group to display if not export all
		if ($this->ExportAll && $this->isExport()) {
			$this->StopGroup = $this->TotalGroups;
		} else {
			$this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
		}

		// Stop group <= total number of groups
		if (intval($this->StopGroup) > intval($this->TotalGroups))
			$this->StopGroup = $this->TotalGroups;
		$this->RecordCount = 0;
		$this->RecordIndex = 0;
		$this->setGroupCount($this->StopGroup - $this->StartGroup + 1, 1);

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["FormerFileNumber"] = $record['FormerFileNumber'];
			$data["NRC"] = $record['NRC'];
			$data["Title"] = $record['Title'];
			$data["Surname"] = $record['Surname'];
			$data["FirstName"] = $record['FirstName'];
			$data["MiddleName"] = $record['MiddleName'];
			$data["Sex"] = $record['Sex'];
			$data["MaritalStatus"] = $record['MaritalStatus'];
			$data["DateOfBirth"] = $record['DateOfBirth'];
			$data["AcademicQualification"] = $record['AcademicQualification'];
			$data["ProfessionalQualification"] = $record['ProfessionalQualification'];
			$data["MedicalCondition"] = $record['MedicalCondition'];
			$data["OtherMedicalConditions"] = $record['OtherMedicalConditions'];
			$data["PhysicalChallenge"] = $record['PhysicalChallenge'];
			$data["ProvinceCode"] = $record['ProvinceCode'];
			$data["LACode"] = $record['LACode'];
			$data["DepartmentCode"] = $record['DepartmentCode'];
			$data["SectionCode"] = $record['SectionCode'];
			$data["SubstantivePosition"] = $record['SubstantivePosition'];
			$data["DateOfCurrentAppointment"] = $record['DateOfCurrentAppointment'];
			$data["YearsOfService"] = $record['YearsOfService'];
			$data["DateOfExit"] = $record['DateOfExit'];
			$data["SalaryScale"] = $record['SalaryScale'];
			$data["EmploymentType"] = $record['EmploymentType'];
			$data["EmploymentStatus"] = $record['EmploymentStatus'];
			$data["CouncilType"] = $record['CouncilType'];
			$data["FundingSource"] = $record['FundingSource'];
			$data["TrainingCost"] = $record['TrainingCost'];
			$data["ActualStartDate"] = $record['ActualStartDate'];
			$data["TrainingType"] = $record['TrainingType'];
			$data["FieldOfTraining"] = $record['FieldOfTraining'];
			$this->Rows[] = $data;
		}
		$this->FormerFileNumber->setDbValue($record['FormerFileNumber']);
		$this->NRC->setDbValue($record['NRC']);
		$this->Title->setDbValue($record['Title']);
		$this->Surname->setDbValue($record['Surname']);
		$this->FirstName->setDbValue($record['FirstName']);
		$this->MiddleName->setDbValue($record['MiddleName']);
		$this->Sex->setDbValue($record['Sex']);
		$this->MaritalStatus->setDbValue($record['MaritalStatus']);
		$this->DateOfBirth->setDbValue($record['DateOfBirth']);
		$this->AcademicQualification->setDbValue($record['AcademicQualification']);
		$this->ProfessionalQualification->setDbValue($record['ProfessionalQualification']);
		$this->MedicalCondition->setDbValue($record['MedicalCondition']);
		$this->OtherMedicalConditions->setDbValue($record['OtherMedicalConditions']);
		$this->PhysicalChallenge->setDbValue($record['PhysicalChallenge']);
		$this->ProvinceCode->setDbValue($record['ProvinceCode']);
		$this->LACode->setDbValue($record['LACode']);
		$this->DepartmentCode->setDbValue($record['DepartmentCode']);
		$this->SectionCode->setDbValue($record['SectionCode']);
		$this->SubstantivePosition->setDbValue($record['SubstantivePosition']);
		$this->DateOfCurrentAppointment->setDbValue($record['DateOfCurrentAppointment']);
		$this->YearsOfService->setDbValue($record['YearsOfService']);
		$this->DateOfExit->setDbValue($record['DateOfExit']);
		$this->SalaryScale->setDbValue($record['SalaryScale']);
		$this->EmploymentType->setDbValue($record['EmploymentType']);
		$this->EmploymentStatus->setDbValue($record['EmploymentStatus']);
		$this->CouncilType->setDbValue($record['CouncilType']);
		$this->FundingSource->setDbValue($record['FundingSource']);
		$this->TrainingCost->setDbValue($record['TrainingCost']);
		$this->ActualStartDate->setDbValue($record['ActualStartDate']);
		$this->TrainingType->setDbValue($record['TrainingType']);
		$this->FieldOfTraining->setDbValue($record['FieldOfTraining']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total
			$records = &$this->DetailRecords;
			$this->PageTotalCount = count($records);
		} elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$cnt = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$cnt = 0;
			}
			$this->TotalCount = $cnt;
			$hasSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// FormerFileNumber
		// NRC
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// MaritalStatus
		// DateOfBirth
		// AcademicQualification
		// ProfessionalQualification
		// MedicalCondition
		// OtherMedicalConditions
		// PhysicalChallenge
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// SubstantivePosition
		// DateOfCurrentAppointment
		// YearsOfService
		// DateOfExit
		// SalaryScale
		// EmploymentType
		// EmploymentStatus
		// CouncilType
		// FundingSource
		// TrainingCost
		// ActualStartDate
		// TrainingType
		// FieldOfTraining

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class

			// FormerFileNumber
			$this->FormerFileNumber->HrefValue = "";

			// NRC
			$this->NRC->HrefValue = "";

			// Title
			$this->Title->HrefValue = "";

			// Surname
			$this->Surname->HrefValue = "";

			// FirstName
			$this->FirstName->HrefValue = "";

			// MiddleName
			$this->MiddleName->HrefValue = "";

			// Sex
			$this->Sex->HrefValue = "";

			// MaritalStatus
			$this->MaritalStatus->HrefValue = "";

			// DateOfBirth
			$this->DateOfBirth->HrefValue = "";

			// AcademicQualification
			$this->AcademicQualification->HrefValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->HrefValue = "";

			// MedicalCondition
			$this->MedicalCondition->HrefValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->HrefValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->HrefValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->HrefValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->HrefValue = "";

			// YearsOfService
			$this->YearsOfService->HrefValue = "";

			// DateOfExit
			$this->DateOfExit->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->HrefValue = "";

			// EmploymentType
			$this->EmploymentType->HrefValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->HrefValue = "";

			// CouncilType
			$this->CouncilType->HrefValue = "";

			// FundingSource
			$this->FundingSource->HrefValue = "";

			// TrainingCost
			$this->TrainingCost->HrefValue = "";

			// ActualStartDate
			$this->ActualStartDate->HrefValue = "";

			// TrainingType
			$this->TrainingType->HrefValue = "";

			// FieldOfTraining
			$this->FieldOfTraining->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			} else {
			}

			// FormerFileNumber
			$this->FormerFileNumber->ViewValue = $this->FormerFileNumber->CurrentValue;
			$this->FormerFileNumber->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->FormerFileNumber->ViewCustomAttributes = "";

			// NRC
			$this->NRC->ViewValue = $this->NRC->CurrentValue;
			$this->NRC->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->NRC->ViewCustomAttributes = "";

			// Title
			$this->Title->ViewValue = $this->Title->CurrentValue;
			$this->Title->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Title->ViewCustomAttributes = "";

			// Surname
			$this->Surname->ViewValue = $this->Surname->CurrentValue;
			$this->Surname->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Surname->ViewCustomAttributes = "";

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->FirstName->ViewCustomAttributes = "";

			// MiddleName
			$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
			$this->MiddleName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->MiddleName->ViewCustomAttributes = "";

			// Sex
			$this->Sex->ViewValue = $this->Sex->CurrentValue;
			$this->Sex->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Sex->ViewCustomAttributes = "";

			// MaritalStatus
			$this->MaritalStatus->ViewValue = $this->MaritalStatus->CurrentValue;
			$this->MaritalStatus->ViewValue = FormatNumber($this->MaritalStatus->ViewValue, 0, -2, -2, -2);
			$this->MaritalStatus->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->MaritalStatus->ViewCustomAttributes = "";

			// DateOfBirth
			$this->DateOfBirth->ViewValue = $this->DateOfBirth->CurrentValue;
			$this->DateOfBirth->ViewValue = FormatDateTime($this->DateOfBirth->ViewValue, 0);
			$this->DateOfBirth->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->DateOfBirth->ViewCustomAttributes = "";

			// AcademicQualification
			$this->AcademicQualification->ViewValue = $this->AcademicQualification->CurrentValue;
			$this->AcademicQualification->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->AcademicQualification->ViewCustomAttributes = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->CurrentValue;
			$this->ProfessionalQualification->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ProfessionalQualification->ViewCustomAttributes = "";

			// MedicalCondition
			$this->MedicalCondition->ViewValue = $this->MedicalCondition->CurrentValue;
			$this->MedicalCondition->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->MedicalCondition->ViewCustomAttributes = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->CurrentValue;
			$this->OtherMedicalConditions->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->OtherMedicalConditions->ViewCustomAttributes = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->CurrentValue;
			$this->PhysicalChallenge->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->PhysicalChallenge->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
			$this->ProvinceCode->ViewValue = FormatNumber($this->ProvinceCode->ViewValue, 0, -2, -2, -2);
			$this->ProvinceCode->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ProvinceCode->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->LACode->ViewCustomAttributes = "";

			// DepartmentCode
			$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
			$this->DepartmentCode->ViewValue = FormatNumber($this->DepartmentCode->ViewValue, 0, -2, -2, -2);
			$this->DepartmentCode->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->DepartmentCode->ViewCustomAttributes = "";

			// SectionCode
			$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
			$this->SectionCode->ViewValue = FormatNumber($this->SectionCode->ViewValue, 0, -2, -2, -2);
			$this->SectionCode->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->SectionCode->ViewCustomAttributes = "";

			// SubstantivePosition
			$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->CurrentValue;
			$this->SubstantivePosition->ViewValue = FormatNumber($this->SubstantivePosition->ViewValue, 0, -2, -2, -2);
			$this->SubstantivePosition->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->SubstantivePosition->ViewCustomAttributes = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->ViewValue = $this->DateOfCurrentAppointment->CurrentValue;
			$this->DateOfCurrentAppointment->ViewValue = FormatDateTime($this->DateOfCurrentAppointment->ViewValue, 0);
			$this->DateOfCurrentAppointment->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->DateOfCurrentAppointment->ViewCustomAttributes = "";

			// YearsOfService
			$this->YearsOfService->ViewValue = $this->YearsOfService->CurrentValue;
			$this->YearsOfService->ViewValue = FormatNumber($this->YearsOfService->ViewValue, 0, -2, -2, -2);
			$this->YearsOfService->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->YearsOfService->ViewCustomAttributes = "";

			// DateOfExit
			$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
			$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
			$this->DateOfExit->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->DateOfExit->ViewCustomAttributes = "";

			// SalaryScale
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$this->SalaryScale->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->SalaryScale->ViewCustomAttributes = "";

			// EmploymentType
			$this->EmploymentType->ViewValue = $this->EmploymentType->CurrentValue;
			$this->EmploymentType->ViewValue = FormatNumber($this->EmploymentType->ViewValue, 0, -2, -2, -2);
			$this->EmploymentType->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->EmploymentType->ViewCustomAttributes = "";

			// EmploymentStatus
			$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->CurrentValue;
			$this->EmploymentStatus->ViewValue = FormatNumber($this->EmploymentStatus->ViewValue, 0, -2, -2, -2);
			$this->EmploymentStatus->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->EmploymentStatus->ViewCustomAttributes = "";

			// CouncilType
			$this->CouncilType->ViewValue = $this->CouncilType->CurrentValue;
			$this->CouncilType->ViewValue = FormatNumber($this->CouncilType->ViewValue, 0, -2, -2, -2);
			$this->CouncilType->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->CouncilType->ViewCustomAttributes = "";

			// FundingSource
			$this->FundingSource->ViewValue = $this->FundingSource->CurrentValue;
			$this->FundingSource->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->FundingSource->ViewCustomAttributes = "";

			// TrainingCost
			$this->TrainingCost->ViewValue = $this->TrainingCost->CurrentValue;
			$this->TrainingCost->ViewValue = FormatNumber($this->TrainingCost->ViewValue, 2, -2, -2, -2);
			$this->TrainingCost->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->TrainingCost->ViewCustomAttributes = "";

			// ActualStartDate
			$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
			$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
			$this->ActualStartDate->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ActualStartDate->ViewCustomAttributes = "";

			// TrainingType
			$this->TrainingType->ViewValue = $this->TrainingType->CurrentValue;
			$this->TrainingType->ViewValue = FormatNumber($this->TrainingType->ViewValue, 0, -2, -2, -2);
			$this->TrainingType->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->TrainingType->ViewCustomAttributes = "";

			// FieldOfTraining
			$this->FieldOfTraining->ViewValue = $this->FieldOfTraining->CurrentValue;
			$this->FieldOfTraining->ViewValue = FormatNumber($this->FieldOfTraining->ViewValue, 0, -2, -2, -2);
			$this->FieldOfTraining->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->FieldOfTraining->ViewCustomAttributes = "";

			// FormerFileNumber
			$this->FormerFileNumber->LinkCustomAttributes = "";
			$this->FormerFileNumber->HrefValue = "";
			$this->FormerFileNumber->TooltipValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";
			$this->NRC->TooltipValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";
			$this->Title->TooltipValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";
			$this->Surname->TooltipValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";
			$this->MiddleName->TooltipValue = "";

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";
			$this->Sex->TooltipValue = "";

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";
			$this->MaritalStatus->TooltipValue = "";

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";
			$this->DateOfBirth->TooltipValue = "";

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";
			$this->AcademicQualification->TooltipValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";
			$this->ProfessionalQualification->TooltipValue = "";

			// MedicalCondition
			$this->MedicalCondition->LinkCustomAttributes = "";
			$this->MedicalCondition->HrefValue = "";
			$this->MedicalCondition->TooltipValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";
			$this->OtherMedicalConditions->TooltipValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->LinkCustomAttributes = "";
			$this->PhysicalChallenge->HrefValue = "";
			$this->PhysicalChallenge->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->LinkCustomAttributes = "";
			$this->SubstantivePosition->HrefValue = "";
			$this->SubstantivePosition->TooltipValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
			$this->DateOfCurrentAppointment->HrefValue = "";
			$this->DateOfCurrentAppointment->TooltipValue = "";

			// YearsOfService
			$this->YearsOfService->LinkCustomAttributes = "";
			$this->YearsOfService->HrefValue = "";
			$this->YearsOfService->TooltipValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";
			$this->DateOfExit->TooltipValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";
			$this->SalaryScale->TooltipValue = "";

			// EmploymentType
			$this->EmploymentType->LinkCustomAttributes = "";
			$this->EmploymentType->HrefValue = "";
			$this->EmploymentType->TooltipValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";
			$this->EmploymentStatus->TooltipValue = "";

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";
			$this->CouncilType->TooltipValue = "";

			// FundingSource
			$this->FundingSource->LinkCustomAttributes = "";
			$this->FundingSource->HrefValue = "";
			$this->FundingSource->TooltipValue = "";

			// TrainingCost
			$this->TrainingCost->LinkCustomAttributes = "";
			$this->TrainingCost->HrefValue = "";
			$this->TrainingCost->TooltipValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";
			$this->ActualStartDate->TooltipValue = "";

			// TrainingType
			$this->TrainingType->LinkCustomAttributes = "";
			$this->TrainingType->HrefValue = "";
			$this->TrainingType->TooltipValue = "";

			// FieldOfTraining
			$this->FieldOfTraining->LinkCustomAttributes = "";
			$this->FieldOfTraining->HrefValue = "";
			$this->FieldOfTraining->TooltipValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row
		} else {

			// FormerFileNumber
			$currentValue = $this->FormerFileNumber->CurrentValue;
			$viewValue = &$this->FormerFileNumber->ViewValue;
			$viewAttrs = &$this->FormerFileNumber->ViewAttrs;
			$cellAttrs = &$this->FormerFileNumber->CellAttrs;
			$hrefValue = &$this->FormerFileNumber->HrefValue;
			$linkAttrs = &$this->FormerFileNumber->LinkAttrs;
			$this->Cell_Rendered($this->FormerFileNumber, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// NRC
			$currentValue = $this->NRC->CurrentValue;
			$viewValue = &$this->NRC->ViewValue;
			$viewAttrs = &$this->NRC->ViewAttrs;
			$cellAttrs = &$this->NRC->CellAttrs;
			$hrefValue = &$this->NRC->HrefValue;
			$linkAttrs = &$this->NRC->LinkAttrs;
			$this->Cell_Rendered($this->NRC, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Title
			$currentValue = $this->Title->CurrentValue;
			$viewValue = &$this->Title->ViewValue;
			$viewAttrs = &$this->Title->ViewAttrs;
			$cellAttrs = &$this->Title->CellAttrs;
			$hrefValue = &$this->Title->HrefValue;
			$linkAttrs = &$this->Title->LinkAttrs;
			$this->Cell_Rendered($this->Title, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Surname
			$currentValue = $this->Surname->CurrentValue;
			$viewValue = &$this->Surname->ViewValue;
			$viewAttrs = &$this->Surname->ViewAttrs;
			$cellAttrs = &$this->Surname->CellAttrs;
			$hrefValue = &$this->Surname->HrefValue;
			$linkAttrs = &$this->Surname->LinkAttrs;
			$this->Cell_Rendered($this->Surname, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// FirstName
			$currentValue = $this->FirstName->CurrentValue;
			$viewValue = &$this->FirstName->ViewValue;
			$viewAttrs = &$this->FirstName->ViewAttrs;
			$cellAttrs = &$this->FirstName->CellAttrs;
			$hrefValue = &$this->FirstName->HrefValue;
			$linkAttrs = &$this->FirstName->LinkAttrs;
			$this->Cell_Rendered($this->FirstName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MiddleName
			$currentValue = $this->MiddleName->CurrentValue;
			$viewValue = &$this->MiddleName->ViewValue;
			$viewAttrs = &$this->MiddleName->ViewAttrs;
			$cellAttrs = &$this->MiddleName->CellAttrs;
			$hrefValue = &$this->MiddleName->HrefValue;
			$linkAttrs = &$this->MiddleName->LinkAttrs;
			$this->Cell_Rendered($this->MiddleName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Sex
			$currentValue = $this->Sex->CurrentValue;
			$viewValue = &$this->Sex->ViewValue;
			$viewAttrs = &$this->Sex->ViewAttrs;
			$cellAttrs = &$this->Sex->CellAttrs;
			$hrefValue = &$this->Sex->HrefValue;
			$linkAttrs = &$this->Sex->LinkAttrs;
			$this->Cell_Rendered($this->Sex, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MaritalStatus
			$currentValue = $this->MaritalStatus->CurrentValue;
			$viewValue = &$this->MaritalStatus->ViewValue;
			$viewAttrs = &$this->MaritalStatus->ViewAttrs;
			$cellAttrs = &$this->MaritalStatus->CellAttrs;
			$hrefValue = &$this->MaritalStatus->HrefValue;
			$linkAttrs = &$this->MaritalStatus->LinkAttrs;
			$this->Cell_Rendered($this->MaritalStatus, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DateOfBirth
			$currentValue = $this->DateOfBirth->CurrentValue;
			$viewValue = &$this->DateOfBirth->ViewValue;
			$viewAttrs = &$this->DateOfBirth->ViewAttrs;
			$cellAttrs = &$this->DateOfBirth->CellAttrs;
			$hrefValue = &$this->DateOfBirth->HrefValue;
			$linkAttrs = &$this->DateOfBirth->LinkAttrs;
			$this->Cell_Rendered($this->DateOfBirth, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// AcademicQualification
			$currentValue = $this->AcademicQualification->CurrentValue;
			$viewValue = &$this->AcademicQualification->ViewValue;
			$viewAttrs = &$this->AcademicQualification->ViewAttrs;
			$cellAttrs = &$this->AcademicQualification->CellAttrs;
			$hrefValue = &$this->AcademicQualification->HrefValue;
			$linkAttrs = &$this->AcademicQualification->LinkAttrs;
			$this->Cell_Rendered($this->AcademicQualification, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ProfessionalQualification
			$currentValue = $this->ProfessionalQualification->CurrentValue;
			$viewValue = &$this->ProfessionalQualification->ViewValue;
			$viewAttrs = &$this->ProfessionalQualification->ViewAttrs;
			$cellAttrs = &$this->ProfessionalQualification->CellAttrs;
			$hrefValue = &$this->ProfessionalQualification->HrefValue;
			$linkAttrs = &$this->ProfessionalQualification->LinkAttrs;
			$this->Cell_Rendered($this->ProfessionalQualification, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MedicalCondition
			$currentValue = $this->MedicalCondition->CurrentValue;
			$viewValue = &$this->MedicalCondition->ViewValue;
			$viewAttrs = &$this->MedicalCondition->ViewAttrs;
			$cellAttrs = &$this->MedicalCondition->CellAttrs;
			$hrefValue = &$this->MedicalCondition->HrefValue;
			$linkAttrs = &$this->MedicalCondition->LinkAttrs;
			$this->Cell_Rendered($this->MedicalCondition, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// OtherMedicalConditions
			$currentValue = $this->OtherMedicalConditions->CurrentValue;
			$viewValue = &$this->OtherMedicalConditions->ViewValue;
			$viewAttrs = &$this->OtherMedicalConditions->ViewAttrs;
			$cellAttrs = &$this->OtherMedicalConditions->CellAttrs;
			$hrefValue = &$this->OtherMedicalConditions->HrefValue;
			$linkAttrs = &$this->OtherMedicalConditions->LinkAttrs;
			$this->Cell_Rendered($this->OtherMedicalConditions, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PhysicalChallenge
			$currentValue = $this->PhysicalChallenge->CurrentValue;
			$viewValue = &$this->PhysicalChallenge->ViewValue;
			$viewAttrs = &$this->PhysicalChallenge->ViewAttrs;
			$cellAttrs = &$this->PhysicalChallenge->CellAttrs;
			$hrefValue = &$this->PhysicalChallenge->HrefValue;
			$linkAttrs = &$this->PhysicalChallenge->LinkAttrs;
			$this->Cell_Rendered($this->PhysicalChallenge, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ProvinceCode
			$currentValue = $this->ProvinceCode->CurrentValue;
			$viewValue = &$this->ProvinceCode->ViewValue;
			$viewAttrs = &$this->ProvinceCode->ViewAttrs;
			$cellAttrs = &$this->ProvinceCode->CellAttrs;
			$hrefValue = &$this->ProvinceCode->HrefValue;
			$linkAttrs = &$this->ProvinceCode->LinkAttrs;
			$this->Cell_Rendered($this->ProvinceCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// LACode
			$currentValue = $this->LACode->CurrentValue;
			$viewValue = &$this->LACode->ViewValue;
			$viewAttrs = &$this->LACode->ViewAttrs;
			$cellAttrs = &$this->LACode->CellAttrs;
			$hrefValue = &$this->LACode->HrefValue;
			$linkAttrs = &$this->LACode->LinkAttrs;
			$this->Cell_Rendered($this->LACode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DepartmentCode
			$currentValue = $this->DepartmentCode->CurrentValue;
			$viewValue = &$this->DepartmentCode->ViewValue;
			$viewAttrs = &$this->DepartmentCode->ViewAttrs;
			$cellAttrs = &$this->DepartmentCode->CellAttrs;
			$hrefValue = &$this->DepartmentCode->HrefValue;
			$linkAttrs = &$this->DepartmentCode->LinkAttrs;
			$this->Cell_Rendered($this->DepartmentCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SectionCode
			$currentValue = $this->SectionCode->CurrentValue;
			$viewValue = &$this->SectionCode->ViewValue;
			$viewAttrs = &$this->SectionCode->ViewAttrs;
			$cellAttrs = &$this->SectionCode->CellAttrs;
			$hrefValue = &$this->SectionCode->HrefValue;
			$linkAttrs = &$this->SectionCode->LinkAttrs;
			$this->Cell_Rendered($this->SectionCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SubstantivePosition
			$currentValue = $this->SubstantivePosition->CurrentValue;
			$viewValue = &$this->SubstantivePosition->ViewValue;
			$viewAttrs = &$this->SubstantivePosition->ViewAttrs;
			$cellAttrs = &$this->SubstantivePosition->CellAttrs;
			$hrefValue = &$this->SubstantivePosition->HrefValue;
			$linkAttrs = &$this->SubstantivePosition->LinkAttrs;
			$this->Cell_Rendered($this->SubstantivePosition, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DateOfCurrentAppointment
			$currentValue = $this->DateOfCurrentAppointment->CurrentValue;
			$viewValue = &$this->DateOfCurrentAppointment->ViewValue;
			$viewAttrs = &$this->DateOfCurrentAppointment->ViewAttrs;
			$cellAttrs = &$this->DateOfCurrentAppointment->CellAttrs;
			$hrefValue = &$this->DateOfCurrentAppointment->HrefValue;
			$linkAttrs = &$this->DateOfCurrentAppointment->LinkAttrs;
			$this->Cell_Rendered($this->DateOfCurrentAppointment, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// YearsOfService
			$currentValue = $this->YearsOfService->CurrentValue;
			$viewValue = &$this->YearsOfService->ViewValue;
			$viewAttrs = &$this->YearsOfService->ViewAttrs;
			$cellAttrs = &$this->YearsOfService->CellAttrs;
			$hrefValue = &$this->YearsOfService->HrefValue;
			$linkAttrs = &$this->YearsOfService->LinkAttrs;
			$this->Cell_Rendered($this->YearsOfService, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DateOfExit
			$currentValue = $this->DateOfExit->CurrentValue;
			$viewValue = &$this->DateOfExit->ViewValue;
			$viewAttrs = &$this->DateOfExit->ViewAttrs;
			$cellAttrs = &$this->DateOfExit->CellAttrs;
			$hrefValue = &$this->DateOfExit->HrefValue;
			$linkAttrs = &$this->DateOfExit->LinkAttrs;
			$this->Cell_Rendered($this->DateOfExit, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SalaryScale
			$currentValue = $this->SalaryScale->CurrentValue;
			$viewValue = &$this->SalaryScale->ViewValue;
			$viewAttrs = &$this->SalaryScale->ViewAttrs;
			$cellAttrs = &$this->SalaryScale->CellAttrs;
			$hrefValue = &$this->SalaryScale->HrefValue;
			$linkAttrs = &$this->SalaryScale->LinkAttrs;
			$this->Cell_Rendered($this->SalaryScale, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// EmploymentType
			$currentValue = $this->EmploymentType->CurrentValue;
			$viewValue = &$this->EmploymentType->ViewValue;
			$viewAttrs = &$this->EmploymentType->ViewAttrs;
			$cellAttrs = &$this->EmploymentType->CellAttrs;
			$hrefValue = &$this->EmploymentType->HrefValue;
			$linkAttrs = &$this->EmploymentType->LinkAttrs;
			$this->Cell_Rendered($this->EmploymentType, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// EmploymentStatus
			$currentValue = $this->EmploymentStatus->CurrentValue;
			$viewValue = &$this->EmploymentStatus->ViewValue;
			$viewAttrs = &$this->EmploymentStatus->ViewAttrs;
			$cellAttrs = &$this->EmploymentStatus->CellAttrs;
			$hrefValue = &$this->EmploymentStatus->HrefValue;
			$linkAttrs = &$this->EmploymentStatus->LinkAttrs;
			$this->Cell_Rendered($this->EmploymentStatus, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// CouncilType
			$currentValue = $this->CouncilType->CurrentValue;
			$viewValue = &$this->CouncilType->ViewValue;
			$viewAttrs = &$this->CouncilType->ViewAttrs;
			$cellAttrs = &$this->CouncilType->CellAttrs;
			$hrefValue = &$this->CouncilType->HrefValue;
			$linkAttrs = &$this->CouncilType->LinkAttrs;
			$this->Cell_Rendered($this->CouncilType, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// FundingSource
			$currentValue = $this->FundingSource->CurrentValue;
			$viewValue = &$this->FundingSource->ViewValue;
			$viewAttrs = &$this->FundingSource->ViewAttrs;
			$cellAttrs = &$this->FundingSource->CellAttrs;
			$hrefValue = &$this->FundingSource->HrefValue;
			$linkAttrs = &$this->FundingSource->LinkAttrs;
			$this->Cell_Rendered($this->FundingSource, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// TrainingCost
			$currentValue = $this->TrainingCost->CurrentValue;
			$viewValue = &$this->TrainingCost->ViewValue;
			$viewAttrs = &$this->TrainingCost->ViewAttrs;
			$cellAttrs = &$this->TrainingCost->CellAttrs;
			$hrefValue = &$this->TrainingCost->HrefValue;
			$linkAttrs = &$this->TrainingCost->LinkAttrs;
			$this->Cell_Rendered($this->TrainingCost, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ActualStartDate
			$currentValue = $this->ActualStartDate->CurrentValue;
			$viewValue = &$this->ActualStartDate->ViewValue;
			$viewAttrs = &$this->ActualStartDate->ViewAttrs;
			$cellAttrs = &$this->ActualStartDate->CellAttrs;
			$hrefValue = &$this->ActualStartDate->HrefValue;
			$linkAttrs = &$this->ActualStartDate->LinkAttrs;
			$this->Cell_Rendered($this->ActualStartDate, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// TrainingType
			$currentValue = $this->TrainingType->CurrentValue;
			$viewValue = &$this->TrainingType->ViewValue;
			$viewAttrs = &$this->TrainingType->ViewAttrs;
			$cellAttrs = &$this->TrainingType->CellAttrs;
			$hrefValue = &$this->TrainingType->HrefValue;
			$linkAttrs = &$this->TrainingType->LinkAttrs;
			$this->Cell_Rendered($this->TrainingType, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// FieldOfTraining
			$currentValue = $this->FieldOfTraining->CurrentValue;
			$viewValue = &$this->FieldOfTraining->ViewValue;
			$viewAttrs = &$this->FieldOfTraining->ViewAttrs;
			$cellAttrs = &$this->FieldOfTraining->CellAttrs;
			$hrefValue = &$this->FieldOfTraining->HrefValue;
			$linkAttrs = &$this->FieldOfTraining->LinkAttrs;
			$this->Cell_Rendered($this->FieldOfTraining, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}
	private $_groupCounts = [];

	// Get group count
	public function getGroupCount(...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "") {
			return -1;
		} elseif ($key == "0") { // Number of first level groups
			$i = 1;
			while (isset($this->_groupCounts[strval($i)]))
				$i++;
			return $i - 1;
		}
		return isset($this->_groupCounts[$key]) ? $this->_groupCounts[$key] : -1;
	}

	// Set group count
	public function setGroupCount($value, ...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "")
			return;
		$this->_groupCounts[$key] = $value;
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->FormerFileNumber->Visible)
			$this->DetailColumnCount += 1;
		if ($this->NRC->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Title->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Surname->Visible)
			$this->DetailColumnCount += 1;
		if ($this->FirstName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->MiddleName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Sex->Visible)
			$this->DetailColumnCount += 1;
		if ($this->MaritalStatus->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DateOfBirth->Visible)
			$this->DetailColumnCount += 1;
		if ($this->AcademicQualification->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ProfessionalQualification->Visible)
			$this->DetailColumnCount += 1;
		if ($this->MedicalCondition->Visible)
			$this->DetailColumnCount += 1;
		if ($this->OtherMedicalConditions->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PhysicalChallenge->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ProvinceCode->Visible)
			$this->DetailColumnCount += 1;
		if ($this->LACode->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DepartmentCode->Visible)
			$this->DetailColumnCount += 1;
		if ($this->SectionCode->Visible)
			$this->DetailColumnCount += 1;
		if ($this->SubstantivePosition->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DateOfCurrentAppointment->Visible)
			$this->DetailColumnCount += 1;
		if ($this->YearsOfService->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DateOfExit->Visible)
			$this->DetailColumnCount += 1;
		if ($this->SalaryScale->Visible)
			$this->DetailColumnCount += 1;
		if ($this->EmploymentType->Visible)
			$this->DetailColumnCount += 1;
		if ($this->EmploymentStatus->Visible)
			$this->DetailColumnCount += 1;
		if ($this->CouncilType->Visible)
			$this->DetailColumnCount += 1;
		if ($this->FundingSource->Visible)
			$this->DetailColumnCount += 1;
		if ($this->TrainingCost->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ActualStartDate->Visible)
			$this->DetailColumnCount += 1;
		if ($this->TrainingType->Visible)
			$this->DetailColumnCount += 1;
		if ($this->FieldOfTraining->Visible)
			$this->DetailColumnCount += 1;
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			return '<a class="ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportExcelUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToExcel") . '</a>';
		} elseif (SameText($type, "word")) {
			return '<a class="ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportWordUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToWord") . '</a>';
		} elseif (SameText($type, "pdf")) {
			return '<a class="ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportPdfUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToPDF") . '</a>';
		} elseif (SameText($type, "email")) {
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_Training_Report" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_Training_Report\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

// Export to Word
	public function exportReportWord($html)
	{
		global $ExportFileName;
		$doc = new \DOMDocument();
		$html = preg_replace('/<meta\b(?:[^"\'>]|"[^"]*"|\'[^\']*\')*>/i', "", $html); // Remove meta tags
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$tables = $doc->getElementsByTagName("table");
		$phpword = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpword->createSection(["orientation" => $this->ExportWordPageOrientation]);
		$cellwidth = $this->ExportWordColumnWidth;
		$div = $doc->getElementById("ew-filter-list");
		if ($div) {
			$parent = $div->parentNode;
			$cls = $parent->getAttribute("class");
			if (preg_match('/\bd-none\b/', $cls)) {
				$div2 = $doc->getElementById("ew-current-date");
				if ($div2) {
					$value = trim($div2->textContent);
					$section->addText($value);
				}
				$div2 = $doc->getElementById("ew-current-filters");
				if ($div2) {
					$value = trim($div2->textContent);
					$section->addText($value);
				}
				$spans = $div->getElementsByTagName("span");
				$spancnt = $spans->length;
				for ($i = 0; $i < $spancnt; $i++) {
					$span = $spans->item($i);
					$class = $span->getAttribute("class");
					if ($class == "ew-filter-caption") {
						$caption = trim($span->textContent);
						$i++;
						$span = $spans->item($i);
						$class = $span->getAttribute("class");
						if ($class == "ew-filter-value") {
							$value = trim($span->textContent);
							$section->addText($caption . ": " . $value);
						}
					}
				}
			}
		}
		foreach ($tables as $table) {
			$tableclass = $table->getAttribute("class");
			$type = "";
			if (ContainsText($tableclass, "ew-table"))
				$type = "table";
			elseif (ContainsText($tableclass, "ew-chart"))
				$type = "chart";
			if ($type == "table" || $type == "chart") {

				// Check page break for chart (before)
				if ($type == "chart" && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "before")
					$section->addPageBreak();
				if ($type == "chart") {
					$images = $table->getElementsByTagName("img");
					$cnt = $images->length;
					for ($z = 0; $z < $cnt; $z++) {
						$imagefn = $images->item($z)->getAttribute("src");
						if (file_exists($imagefn)) {
							$size = getimagesize($imagefn);
							if ($size[0] != 0) {
								$settings = $section->getSettings();
								$factor = \PhpOffice\PhpWord\Shared\Converter::INCH_TO_PIXEL / \PhpOffice\PhpWord\Shared\Converter::INCH_TO_TWIP; // 96/1440
								$w = min($size[0], ($settings->getPageSizeW() - $settings->getMarginLeft() - $settings->getMarginRight()) * $factor);
								$h = $w / $size[0] * $size[1];
								$section->addImage($imagefn, ["width" => $w, "height" => $h]);
							} else {
								$section->addImage($imagefn);
							}
						}
					}
				} elseif ($type == "table") {
					$styleTable = ["borderSize" => 6, "borderColor" => "A9A9A9", "cellMargin" => 60]; // Customize table cell styles here
					$phpword->addTableStyle("phpWord", $styleTable);
					$tbl = $section->addTable("phpWord");
					$rows = $table->getElementsByTagName("tr");
					$rowcnt = $rows->length;
					for ($i = 0; $i < $rowcnt; $i++) {
						$row = $rows->item($i);
						if (!($row->parentNode->tagName == "table" && $row->parentNode->getAttribute("class") == "ew-table-header-btn")) {
							$cells = $row->childNodes;
							$cellcnt = $cells->length;
							$tbl->addRow(0);
							for ($j = 0; $j < $cellcnt; $j++) {
								$cell = $cells->item($j);
								if ($cell->nodeType != XML_ELEMENT_NODE || $cell->tagName != "td" && $cell->tagName != "th")
									continue;
								$k = 1;
								if ($cell->hasAttribute("colspan"))
									$k = intval($cell->getAttribute("colspan"));
								$images = $cell->getElementsByTagName("img");
								if ($images->length >= 1) { // Image
									$cell = $tbl->addCell($cellwidth);
									$cnt = $images->length; 
									for ($z = 0; $z < $cnt; $z++) {
										$imagefn = $images->item($z)->getAttribute("src");
										if (file_exists($imagefn))
											$cell->addImage($imagefn);
									}
								} else { // Text
									$text = htmlspecialchars(trim($cell->textContent), ENT_NOQUOTES);
									$text = preg_replace(['/[\r\n\t]+:/', '/[\r\n\t]+\(/'], [":", " ("], trim($text)); // Replace extra whitespaces before ":" and "("
									if ($row->parentNode->tagName == "thead") { // Caption
										$tbl->addCell($cellwidth, ["gridSpan" => $k, "bgColor" => "E4E4E4"])->addText($text, ["bold" => TRUE]); // Customize table header cell styles here
									} else {
										$tbl->addCell($cellwidth, ["gridSpan" => $k])->addText($text);
									}
								}
							}
						}
					}
				}

				// Check page break for chart (after)
				if ($type == "chart" && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "after")
					$section->addPageBreak();

				// Check page break for table
				if ($type == "table") {
					$node = $table->parentNode;
					while ($node && $node->getAttribute("class") && !ContainsText($node->getAttribute("class"), "ew-grid"))
						$node = $node->parentNode;
					if ($node) {
						$node = $node->nextSibling;
						while ($node && $node->nodeType != XML_ELEMENT_NODE)
							$node = $node->nextSibling;
						if ($node && $node->getAttribute("class") && $node->getAttribute("class") == "ew-page-break")
							$section->addPageBreak();
					}
				}
			}
		}
		if (!Config("DEBUG") && ob_get_length())
			ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header('Content-Disposition: attachment; filename=' . $ExportFileName . '.docx');
		header('Cache-Control: max-age=0');
		header('Set-Cookie: fileDownload=true; path=/');
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, 'Word2007');
		@$objWriter->save('php://output');
		DeleteTempImages();
		exit();
	}

// Export report to Excel
	public function exportReportExcel($html, $format = "Excel5")
	{
		global $ExportFileName;
		$doc = new \DOMDocument();
		$html = preg_replace('/<meta\b(?:[^"\'>]|"[^"]*"|\'[^\']*\')*>/i', "", $html); // Remove meta tags
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$tables = $doc->getElementsByTagName("table");
		$phpspreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$phpspreadsheet->setActiveSheetIndex(0);
		$sheet = $phpspreadsheet->getActiveSheet();
		if ($this->ExportExcelPageOrientation != "")
			$sheet->getPageSetup()->setOrientation($this->ExportExcelPageOrientation);
		if ($this->ExportExcelPageSize != "")
			$sheet->getPageSetup()->setPaperSize($this->ExportExcelPageSize);
		if (function_exists("PhpSpreadsheet_Rendering")) // For user's own use only
			PhpSpreadsheet_Rendering($sheet);
		$maxImageWidth = ($format == "Excel5") ? ExportExcel5::$MaxImageWidth : ExportExcel2007::$MaxImageWidth; // Max image width <= 400 is recommended
		$widthMultiplier = ($format == "Excel5") ? ExportExcel5::$WidthMultiplier : ExportExcel2007::$WidthMultiplier; // Cell width multipler for image fields
		$heightMultiplier = ($format == "Excel5") ? ExportExcel5::$HeightMultiplier : ExportExcel2007::$HeightMultiplier; // Row height multipler for image fields
		$m = 1; $maxcellcnt = 1;
		foreach ($tables as $table) {
			$tableclass = $table->getAttribute("class");
			$isChart = ContainsText($tableclass, "ew-chart");
			$isTable = ContainsText($tableclass, "ew-table");
			if ($isTable || $isChart) {

				// Check page break for chart (before)
				if ($isChart && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "before") {
					$sheet->setBreak("A" . strval($m), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
					$m++;
				}
				$rows = $table->getElementsByTagName("tr");
				$rowcnt = $rows->length;
				for ($i = 0; $i < $rowcnt; $i++) {
					$row = $rows->item($i);
					$cells = $row->childNodes;
					$cellcnt = $cells->length;
					$k = 1;
					for ($j = 0; $j < $cellcnt; $j++) {
						$cell = $cells->item($j);
						if ($cell->nodeType != XML_ELEMENT_NODE || $cell->tagName != "td" && $cell->tagName != "th")
							continue;
						$letter =\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k);
						$images = $cell->getElementsByTagName("img");
						if ($images->length > 0) { // Images
							$totalW = 0;
							$maxH = 0;
							foreach ($images as $image) {
								$fn = $image->getAttribute("src");
								$path = parse_url($fn, PHP_URL_PATH);
								$ext = pathinfo($path, PATHINFO_EXTENSION);
								if (SameText($ext, "php")) { // Image by script
									$fn = FullUrl($fn);
									$data = file_get_contents($fn);
									$fn = TempImage($data);
								}
								if (!file_exists($fn) || is_dir($fn))
									continue;
								$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
								$objDrawing->setWorksheet($sheet);
								$objDrawing->setPath($fn);
								$objDrawing->setOffsetX($totalW);
								$objDrawing->setCoordinates($letter . strval($m));
								$size = [$objDrawing->getWidth(), $objDrawing->getHeight()]; // Get image size
								if ($size[0] > 0) // Width
									$totalW += $size[0];
								$maxH = max($maxH, $size[1]); // Height
							}
							if ($totalW > 0 && $isTable) // Width
								$sheet->getColumnDimension($letter)->setAutoSize(FALSE)->setWidth($totalW * $widthMultiplier); // Set column width, no auto size
							if ($maxH > 0) // Height
								$sheet->getRowDimension($m)->setRowHeight($maxH * $heightMultiplier); // Set row height
						} else { // Text
							$value = preg_replace(['/[\r\n\t]+:/', '/[\r\n\t]+\(/'], [":", " ("], trim($cell->textContent)); // Replace extra whitespaces before ":" and "("
							if (function_exists("PhpSpreadsheet_Cell_Rendering")) // For user's own use only
								PhpSpreadsheet_Cell_Rendering($k, $m, $value, $sheet);
							if ($format == "Excel2007" && $row->parentNode->tagName == "thead") { // Caption
								$objRichText = new \PhpOffice\PhpSpreadsheet\RichText\RichText(); // Rich Text
								$obj = $objRichText->createTextRun($value);
								$obj->getFont()->setBold(TRUE); // Bold

								//$obj->getFont()->setItalic(true);
								//$obj->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN)); // Set color

								$sheet->getCellByColumnAndRow($k, $m)->setValue($objRichText);
							} else {
								$sheet->setCellValueByColumnAndRow($k, $m, $value);
							}
							$sheet->getColumnDimension($letter)->setAutoSize(TRUE);
							if (function_exists("PhpSpreadsheet_Cell_Rendered")) // For user's own use only
								PhpSpreadsheet_Cell_Rendered($k, $m, $value, $sheet);
						}
						if ($cell->hasAttribute("colspan")) {
							$k += (int)$cell->getAttribute("colspan");
						} else {
							$k++;
						}
					}
					if ($k > $maxcellcnt)
						$maxcellcnt = $k;
					$m++;
				}

				// Check page break for chart (after)
				if ($isChart && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "after")
					$sheet->setBreak("A" . strval($m), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);

				// Check page break for table
				if ($isTable) {
					$node = $table->parentNode;
					while ($node && $node->getAttribute("class") && !ContainsText($node->getAttribute("class"), "ew-grid"))
						$node = $node->parentNode;
					if ($node) {
						$node = $node->nextSibling;
						while ($node && $node->nodeType != XML_ELEMENT_NODE)
							$node = $node->nextSibling;
						if ($node && $node->getAttribute("class") && $node->getAttribute("class") == "ew-page-break")
							$sheet->setBreak("A" . strval($m), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
					}
				}
				$m++;
			}
		}
		if (!Config("DEBUG") && ob_get_length())
			ob_end_clean();
		if ($format == "Excel5") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $ExportFileName . '.xls');
		} else { // Excel2007
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename=' . $ExportFileName . '.xlsx');
		}
		header('Cache-Control: max-age=0');
		header('Set-Cookie: fileDownload=true; path=/');
		$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($phpspreadsheet, ($format == "Excel5") ? "Xls" : "Xlsx");
		$objWriter->save('php://output');
		DeleteTempImages();
		exit();
	}

// Export PDF
	public function exportReportPdf($html)
	{
		global $ExportFileName;
		@ini_set("memory_limit", Config("PDF_MEMORY_LIMIT"));
		set_time_limit(Config("PDF_TIME_LIMIT"));
		$html = CheckHtml($html);
		if (Config("DEBUG")) // Add debug message
			$html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(["pdf_backend" => "CPDF"]);
		$doc = new \DOMDocument("1.0", "utf-8");
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			$classNames = $span->getAttribute("class");
			if ($classNames == "ew-filter-caption") // Insert colon
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
			elseif (preg_match('/\bicon\-\w+\b/', $classNames)) // Remove icons
				$span->parentNode->removeChild($span);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = $this->ExportPageSize;
		$pageOrientation = $this->ExportPageOrientation;
		$portrait = SameText($pageOrientation, "portrait");
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] != 0) {
					if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = $portrait ? 216 : 279;
					} elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = $portrait ? 216 : 356;
					} else {
						$w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * Config("PDF_IMAGE_SCALE_FACTOR")); // Resize image, adjust the scale factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		header('Set-Cookie: fileDownload=true; path=/');
		$exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
		$dompdf->stream($exportFile, ["Attachment" => 1]); // 0 to open in browser, 1 to download
		DeleteTempImages();
		exit();
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = Param(Config("TABLE_START_GROUP"), "");
		$pageNo = Param("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups != 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "";
		$resetSort = Param("cmd") === "resetsort";
		$orderBy = Param("order", "");
		$orderType = Param("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->FormerFileNumber->setSort("");
			$this->NRC->setSort("");
			$this->Title->setSort("");
			$this->Surname->setSort("");
			$this->FirstName->setSort("");
			$this->MiddleName->setSort("");
			$this->Sex->setSort("");
			$this->MaritalStatus->setSort("");
			$this->DateOfBirth->setSort("");
			$this->AcademicQualification->setSort("");
			$this->ProfessionalQualification->setSort("");
			$this->MedicalCondition->setSort("");
			$this->OtherMedicalConditions->setSort("");
			$this->PhysicalChallenge->setSort("");
			$this->ProvinceCode->setSort("");
			$this->LACode->setSort("");
			$this->DepartmentCode->setSort("");
			$this->SectionCode->setSort("");
			$this->SubstantivePosition->setSort("");
			$this->DateOfCurrentAppointment->setSort("");
			$this->YearsOfService->setSort("");
			$this->DateOfExit->setSort("");
			$this->SalaryScale->setSort("");
			$this->EmploymentType->setSort("");
			$this->EmploymentStatus->setSort("");
			$this->CouncilType->setSort("");
			$this->FundingSource->setSort("");
			$this->TrainingCost->setSort("");
			$this->ActualStartDate->setSort("");
			$this->TrainingType->setSort("");
			$this->FieldOfTraining->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->FormerFileNumber); // FormerFileNumber
			$this->updateSort($this->NRC); // NRC
			$this->updateSort($this->Title); // Title
			$this->updateSort($this->Surname); // Surname
			$this->updateSort($this->FirstName); // FirstName
			$this->updateSort($this->MiddleName); // MiddleName
			$this->updateSort($this->Sex); // Sex
			$this->updateSort($this->MaritalStatus); // MaritalStatus
			$this->updateSort($this->DateOfBirth); // DateOfBirth
			$this->updateSort($this->AcademicQualification); // AcademicQualification
			$this->updateSort($this->ProfessionalQualification); // ProfessionalQualification
			$this->updateSort($this->MedicalCondition); // MedicalCondition
			$this->updateSort($this->OtherMedicalConditions); // OtherMedicalConditions
			$this->updateSort($this->PhysicalChallenge); // PhysicalChallenge
			$this->updateSort($this->ProvinceCode); // ProvinceCode
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->SectionCode); // SectionCode
			$this->updateSort($this->SubstantivePosition); // SubstantivePosition
			$this->updateSort($this->DateOfCurrentAppointment); // DateOfCurrentAppointment
			$this->updateSort($this->YearsOfService); // YearsOfService
			$this->updateSort($this->DateOfExit); // DateOfExit
			$this->updateSort($this->SalaryScale); // SalaryScale
			$this->updateSort($this->EmploymentType); // EmploymentType
			$this->updateSort($this->EmploymentStatus); // EmploymentStatus
			$this->updateSort($this->CouncilType); // CouncilType
			$this->updateSort($this->FundingSource); // FundingSource
			$this->updateSort($this->TrainingCost); // TrainingCost
			$this->updateSort($this->ActualStartDate); // ActualStartDate
			$this->updateSort($this->TrainingType); // TrainingType
			$this->updateSort($this->FieldOfTraining); // FieldOfTraining
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
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
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>