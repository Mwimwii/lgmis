<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class Vacancy_Report_summary extends Vacancy_Report
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'Vacancy Report';

	// Page object name
	public $PageObjName = "Vacancy_Report_summary";

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

		// Table object (Vacancy_Report)
		if (!isset($GLOBALS["Vacancy_Report"]) || get_class($GLOBALS["Vacancy_Report"]) == PROJECT_NAMESPACE . "Vacancy_Report") {
			$GLOBALS["Vacancy_Report"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Vacancy_Report"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";

		// Table object (local_authority)
		if (!isset($GLOBALS['local_authority']))
			$GLOBALS['local_authority'] = new local_authority();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Vacancy Report');

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
		$this->PositionCode->setVisibility();
		$this->SalaryScale->setVisibility();
		$this->PositionName->setVisibility();
		$this->RequisiteQualification->setVisibility();
		$this->FieldQualified->setVisibility();
		$this->DepartmentName->setVisibility();
		$this->SectionName->setVisibility();
		$this->CouncilType->setVisibility();
		$this->EmploymentStatus->setVisibility();
		$this->MonthsVacant->setVisibility();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Check if search command
		$this->SearchCommand = (Get("cmd", "") == "search");

		// Load custom filters
		$this->Page_FilterLoad();

		// Process filter list
		if ($this->processFilterList())
			$this->terminate();

		// Extended filter
		$extendedFilter = "";

		// Restore filter list
		$this->restoreFilterList();

		// Build extended filter
		$extendedFilter = $this->getExtendedFilter();
		AddFilter($this->SearchWhere, $extendedFilter);

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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Reset master/detail keys
		if (SameText(Get("cmd"), "resetall")) {
			$this->setCurrentMasterTable(""); // Clear master table
			$this->DbMasterFilter = "";
			$this->DbDetailFilter = "";
			$this->LACode->setSessionValue("");
		}

		// Add detail filter
		AddFilter($this->Filter, $this->DbDetailFilter);

		// Get total group count
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
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

		// Get group records
		if ($this->TotalGroups > 0) {
			$grpSort = UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
			$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $grpSort);
			$grpRs = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
			$this->GroupRecords = $grpRs->getRows(); // Get records of first grouping field
			$this->loadGroupRowValues();
			$this->GroupCount = 1;
		}

		// Init detail records
		$this->DetailRecords = [];
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

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Load group row values
	public function loadGroupRowValues()
	{
		$cnt = count($this->GroupRecords); // Get record count
		if ($this->GroupCount < $cnt)
			$this->ProvinceCode->setGroupValue($this->GroupRecords[$this->GroupCount][0]);
		else
			$this->ProvinceCode->setGroupValue("");
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["ProvinceCode"] = $record['ProvinceCode'];
			$data["LACode"] = $record['LACode'];
			$data["DepartmentCode"] = $record['DepartmentCode'];
			$data["SectionCode"] = $record['SectionCode'];
			$data["PositionCode"] = $record['PositionCode'];
			$data["SalaryScale"] = $record['SalaryScale'];
			$data["PositionName"] = $record['PositionName'];
			$data["RequisiteQualification"] = $record['RequisiteQualification'];
			$data["FieldQualified"] = $record['FieldQualified'];
			$data["DepartmentName"] = $record['DepartmentName'];
			$data["SectionName"] = $record['SectionName'];
			$data["CouncilType"] = $record['CouncilType'];
			$data["EmploymentStatus"] = $record['EmploymentStatus'];
			$data["MonthsVacant"] = $record['MonthsVacant'];
			$this->Rows[] = $data;
		}
		$this->ProvinceCode->setDbValue(GroupValue($this->ProvinceCode, $record['ProvinceCode']));
		$this->LACode->setDbValue($record['LACode']);
		$this->DepartmentCode->setDbValue($record['DepartmentCode']);
		$this->SectionCode->setDbValue($record['SectionCode']);
		$this->PositionCode->setDbValue($record['PositionCode']);
		$this->SalaryScale->setDbValue($record['SalaryScale']);
		$this->PositionName->setDbValue($record['PositionName']);
		$this->RequisiteQualification->setDbValue($record['RequisiteQualification']);
		$this->FieldQualified->setDbValue($record['FieldQualified']);
		$this->DepartmentName->setDbValue($record['DepartmentName']);
		$this->SectionName->setDbValue($record['SectionName']);
		$this->CouncilType->setDbValue($record['CouncilType']);
		$this->EmploymentStatus->setDbValue($record['EmploymentStatus']);
		$this->MonthsVacant->setDbValue($record['MonthsVacant']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total

			// Build detail SQL
			$firstGrpFld = &$this->ProvinceCode;
			$firstGrpFld->getDistinctValues($this->GroupRecords);
			$where = DetailFilterSql($firstGrpFld, $this->getSqlFirstGroupField(), $firstGrpFld->DistinctValues, $this->Dbid);
			if ($this->Filter != "")
				$where = "($this->Filter) AND ($where)";
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $where, $this->Sort);
			$rs = $this->getRecordset($sql);
			$records = $rs ? $rs->getRows() : [];
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

		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// PositionCode
		// SalaryScale
		// PositionName
		// RequisiteQualification
		// FieldQualified
		// DepartmentName
		// SectionName
		// CouncilType
		// EmploymentStatus
		// MonthsVacant

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProvinceCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ProvinceCode->AdvancedSearch->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			else
				$this->ProvinceCode->AdvancedSearch->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProvinceCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProvinceCode->EditValue = $arwrk;
			}

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$this->DepartmentCode->EditValue = HtmlEncode($this->DepartmentCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->DepartmentCode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->DepartmentCode->EditValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->EditValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->EditValue = HtmlEncode($this->DepartmentCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->DepartmentCode->EditValue = NULL;
			}
			$this->DepartmentCode->PlaceHolder = RemoveHtml($this->DepartmentCode->caption());

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->SectionCode->AdvancedSearch->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->AdvancedSearch->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// PositionCode
			$this->PositionCode->EditAttrs["class"] = "form-control";
			$this->PositionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->PositionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PositionCode->AdvancedSearch->ViewValue = $this->PositionCode->lookupCacheOption($curVal);
			else
				$this->PositionCode->AdvancedSearch->ViewValue = $this->PositionCode->Lookup !== NULL && is_array($this->PositionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->PositionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PositionCode->EditValue = array_values($this->PositionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PositionCode`" . SearchString("=", $this->PositionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PositionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PositionCode->EditValue = $arwrk;
			}
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->ProvinceCode->groupValue(); // Set up group attribute
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 2)
				$this->RowAttrs["data-group-2"] = $this->LACode->groupValue(); // Set up group attribute 2
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 3)
				$this->RowAttrs["data-group-3"] = $this->DepartmentCode->groupValue(); // Set up group attribute 3
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 4)
				$this->RowAttrs["data-group-4"] = $this->SectionCode->groupValue(); // Set up group attribute 4

			// ProvinceCode
			$curVal = strval($this->ProvinceCode->groupValue());
			if ($curVal != "") {
				$this->ProvinceCode->GroupViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->GroupViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->GroupViewValue = $this->ProvinceCode->groupValue();
					}
				}
			} else {
				$this->ProvinceCode->GroupViewValue = NULL;
			}
			$this->ProvinceCode->CellCssClass = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->ProvinceCode->ViewCustomAttributes = "";
			$this->ProvinceCode->GroupViewValue = DisplayGroupValue($this->ProvinceCode, $this->ProvinceCode->GroupViewValue);

			// LACode
			$curVal = strval($this->LACode->groupValue());
			if ($curVal != "") {
				$this->LACode->GroupViewValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LACode->GroupViewValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->GroupViewValue = $this->LACode->groupValue();
					}
				}
			} else {
				$this->LACode->GroupViewValue = NULL;
			}
			$this->LACode->CellCssClass = ($this->RowGroupLevel == 2 ? "ew-rpt-grp-summary-2" : "ew-rpt-grp-field-2");
			$this->LACode->ViewCustomAttributes = "";
			$this->LACode->GroupViewValue = DisplayGroupValue($this->LACode, $this->LACode->GroupViewValue);

			// DepartmentCode
			$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->groupValue();
			$curVal = strval($this->DepartmentCode->groupValue());
			if ($curVal != "") {
				$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->groupValue();
					}
				}
			} else {
				$this->DepartmentCode->GroupViewValue = NULL;
			}
			$this->DepartmentCode->CellCssClass = ($this->RowGroupLevel == 3 ? "ew-rpt-grp-summary-3" : "ew-rpt-grp-field-3");
			$this->DepartmentCode->ViewCustomAttributes = "";
			$this->DepartmentCode->GroupViewValue = DisplayGroupValue($this->DepartmentCode, $this->DepartmentCode->GroupViewValue);

			// SectionCode
			$curVal = strval($this->SectionCode->groupValue());
			if ($curVal != "") {
				$this->SectionCode->GroupViewValue = $this->SectionCode->lookupCacheOption($curVal);
				if ($this->SectionCode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SectionCode->GroupViewValue = $this->SectionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SectionCode->GroupViewValue = $this->SectionCode->groupValue();
					}
				}
			} else {
				$this->SectionCode->GroupViewValue = NULL;
			}
			$this->SectionCode->CellCssClass = ($this->RowGroupLevel == 4 ? "ew-rpt-grp-summary-4" : "ew-rpt-grp-field-4");
			$this->SectionCode->ViewCustomAttributes = "";
			$this->SectionCode->GroupViewValue = DisplayGroupValue($this->SectionCode, $this->SectionCode->GroupViewValue);

			// ProvinceCode
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->HrefValue = "";

			// PositionCode
			$this->PositionCode->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->HrefValue = "";

			// PositionName
			$this->PositionName->HrefValue = "";

			// RequisiteQualification
			$this->RequisiteQualification->HrefValue = "";

			// FieldQualified
			$this->FieldQualified->HrefValue = "";

			// DepartmentName
			$this->DepartmentName->HrefValue = "";

			// SectionName
			$this->SectionName->HrefValue = "";

			// CouncilType
			$this->CouncilType->HrefValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->HrefValue = "";

			// MonthsVacant
			$this->MonthsVacant->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->ProvinceCode->groupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->LACode->groupValue(); // Set up group attribute 2
			if ($this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->DepartmentCode->groupValue(); // Set up group attribute 3
			if ($this->RowGroupLevel >= 4) $this->RowAttrs["data-group-4"] = $this->SectionCode->groupValue(); // Set up group attribute 4
			} else {
			$this->RowAttrs["data-group"] = $this->ProvinceCode->groupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->LACode->groupValue(); // Set up group attribute 2
			$this->RowAttrs["data-group-3"] = $this->DepartmentCode->groupValue(); // Set up group attribute 3
			$this->RowAttrs["data-group-4"] = $this->SectionCode->groupValue(); // Set up group attribute 4
			}

			// ProvinceCode
			$curVal = strval($this->ProvinceCode->groupValue());
			if ($curVal != "") {
				$this->ProvinceCode->GroupViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->GroupViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->GroupViewValue = $this->ProvinceCode->groupValue();
					}
				}
			} else {
				$this->ProvinceCode->GroupViewValue = NULL;
			}
			$this->ProvinceCode->CellCssClass = "ew-rpt-grp-field-1";
			$this->ProvinceCode->ViewCustomAttributes = "";
			$this->ProvinceCode->GroupViewValue = DisplayGroupValue($this->ProvinceCode, $this->ProvinceCode->GroupViewValue);
			if (!$this->ProvinceCode->LevelBreak)
				$this->ProvinceCode->GroupViewValue = "&nbsp;";
			else
				$this->ProvinceCode->LevelBreak = FALSE;

			// LACode
			$curVal = strval($this->LACode->groupValue());
			if ($curVal != "") {
				$this->LACode->GroupViewValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LACode->GroupViewValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->GroupViewValue = $this->LACode->groupValue();
					}
				}
			} else {
				$this->LACode->GroupViewValue = NULL;
			}
			$this->LACode->CellCssClass = "ew-rpt-grp-field-2";
			$this->LACode->ViewCustomAttributes = "";
			$this->LACode->GroupViewValue = DisplayGroupValue($this->LACode, $this->LACode->GroupViewValue);
			if (!$this->LACode->LevelBreak)
				$this->LACode->GroupViewValue = "&nbsp;";
			else
				$this->LACode->LevelBreak = FALSE;

			// DepartmentCode
			$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->groupValue();
			$curVal = strval($this->DepartmentCode->groupValue());
			if ($curVal != "") {
				$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->GroupViewValue = $this->DepartmentCode->groupValue();
					}
				}
			} else {
				$this->DepartmentCode->GroupViewValue = NULL;
			}
			$this->DepartmentCode->CellCssClass = "ew-rpt-grp-field-3";
			$this->DepartmentCode->ViewCustomAttributes = "";
			$this->DepartmentCode->GroupViewValue = DisplayGroupValue($this->DepartmentCode, $this->DepartmentCode->GroupViewValue);
			if (!$this->DepartmentCode->LevelBreak)
				$this->DepartmentCode->GroupViewValue = "&nbsp;";
			else
				$this->DepartmentCode->LevelBreak = FALSE;

			// SectionCode
			$curVal = strval($this->SectionCode->groupValue());
			if ($curVal != "") {
				$this->SectionCode->GroupViewValue = $this->SectionCode->lookupCacheOption($curVal);
				if ($this->SectionCode->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SectionCode->GroupViewValue = $this->SectionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SectionCode->GroupViewValue = $this->SectionCode->groupValue();
					}
				}
			} else {
				$this->SectionCode->GroupViewValue = NULL;
			}
			$this->SectionCode->CellCssClass = "ew-rpt-grp-field-4";
			$this->SectionCode->ViewCustomAttributes = "";
			$this->SectionCode->GroupViewValue = DisplayGroupValue($this->SectionCode, $this->SectionCode->GroupViewValue);
			if (!$this->SectionCode->LevelBreak)
				$this->SectionCode->GroupViewValue = "&nbsp;";
			else
				$this->SectionCode->LevelBreak = FALSE;

			// PositionCode
			$curVal = strval($this->PositionCode->CurrentValue);
			if ($curVal != "") {
				$this->PositionCode->ViewValue = $this->PositionCode->lookupCacheOption($curVal);
				if ($this->PositionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PositionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->PositionCode->ViewValue = $this->PositionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PositionCode->ViewValue = $this->PositionCode->CurrentValue;
					}
				}
			} else {
				$this->PositionCode->ViewValue = NULL;
			}
			$this->PositionCode->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->PositionCode->ViewCustomAttributes = "";

			// SalaryScale
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$this->SalaryScale->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->SalaryScale->ViewCustomAttributes = "";

			// PositionName
			$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
			$this->PositionName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->PositionName->ViewCustomAttributes = "";

			// RequisiteQualification
			$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->CurrentValue;
			$this->RequisiteQualification->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->RequisiteQualification->ViewCustomAttributes = "";

			// FieldQualified
			$this->FieldQualified->ViewValue = $this->FieldQualified->CurrentValue;
			$this->FieldQualified->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->FieldQualified->ViewCustomAttributes = "";

			// DepartmentName
			$this->DepartmentName->ViewValue = $this->DepartmentName->CurrentValue;
			$this->DepartmentName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->DepartmentName->ViewCustomAttributes = "";

			// SectionName
			$this->SectionName->ViewValue = $this->SectionName->CurrentValue;
			$this->SectionName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->SectionName->ViewCustomAttributes = "";

			// CouncilType
			$this->CouncilType->ViewValue = $this->CouncilType->CurrentValue;
			$this->CouncilType->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->CouncilType->ViewCustomAttributes = "";

			// EmploymentStatus
			$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->CurrentValue;
			$this->EmploymentStatus->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->EmploymentStatus->ViewCustomAttributes = "";

			// MonthsVacant
			$this->MonthsVacant->ViewValue = $this->MonthsVacant->CurrentValue;
			$this->MonthsVacant->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->MonthsVacant->ViewCustomAttributes = "";

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

			// PositionCode
			$this->PositionCode->LinkCustomAttributes = "";
			$this->PositionCode->HrefValue = "";
			$this->PositionCode->TooltipValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";
			$this->SalaryScale->TooltipValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";
			$this->PositionName->TooltipValue = "";

			// RequisiteQualification
			$this->RequisiteQualification->LinkCustomAttributes = "";
			$this->RequisiteQualification->HrefValue = "";
			$this->RequisiteQualification->TooltipValue = "";

			// FieldQualified
			$this->FieldQualified->LinkCustomAttributes = "";
			$this->FieldQualified->HrefValue = "";
			$this->FieldQualified->TooltipValue = "";

			// DepartmentName
			$this->DepartmentName->LinkCustomAttributes = "";
			$this->DepartmentName->HrefValue = "";
			$this->DepartmentName->TooltipValue = "";

			// SectionName
			$this->SectionName->LinkCustomAttributes = "";
			$this->SectionName->HrefValue = "";
			$this->SectionName->TooltipValue = "";

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";
			$this->CouncilType->TooltipValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";
			$this->EmploymentStatus->TooltipValue = "";

			// MonthsVacant
			$this->MonthsVacant->LinkCustomAttributes = "";
			$this->MonthsVacant->HrefValue = "";
			$this->MonthsVacant->TooltipValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// ProvinceCode
			$currentValue = $this->ProvinceCode->GroupViewValue;
			$viewValue = &$this->ProvinceCode->GroupViewValue;
			$viewAttrs = &$this->ProvinceCode->ViewAttrs;
			$cellAttrs = &$this->ProvinceCode->CellAttrs;
			$hrefValue = &$this->ProvinceCode->HrefValue;
			$linkAttrs = &$this->ProvinceCode->LinkAttrs;
			$this->Cell_Rendered($this->ProvinceCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// LACode
			$currentValue = $this->LACode->GroupViewValue;
			$viewValue = &$this->LACode->GroupViewValue;
			$viewAttrs = &$this->LACode->ViewAttrs;
			$cellAttrs = &$this->LACode->CellAttrs;
			$hrefValue = &$this->LACode->HrefValue;
			$linkAttrs = &$this->LACode->LinkAttrs;
			$this->Cell_Rendered($this->LACode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DepartmentCode
			$currentValue = $this->DepartmentCode->GroupViewValue;
			$viewValue = &$this->DepartmentCode->GroupViewValue;
			$viewAttrs = &$this->DepartmentCode->ViewAttrs;
			$cellAttrs = &$this->DepartmentCode->CellAttrs;
			$hrefValue = &$this->DepartmentCode->HrefValue;
			$linkAttrs = &$this->DepartmentCode->LinkAttrs;
			$this->Cell_Rendered($this->DepartmentCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SectionCode
			$currentValue = $this->SectionCode->GroupViewValue;
			$viewValue = &$this->SectionCode->GroupViewValue;
			$viewAttrs = &$this->SectionCode->ViewAttrs;
			$cellAttrs = &$this->SectionCode->CellAttrs;
			$hrefValue = &$this->SectionCode->HrefValue;
			$linkAttrs = &$this->SectionCode->LinkAttrs;
			$this->Cell_Rendered($this->SectionCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// ProvinceCode
			$currentValue = $this->ProvinceCode->groupValue();
			$viewValue = &$this->ProvinceCode->GroupViewValue;
			$viewAttrs = &$this->ProvinceCode->ViewAttrs;
			$cellAttrs = &$this->ProvinceCode->CellAttrs;
			$hrefValue = &$this->ProvinceCode->HrefValue;
			$linkAttrs = &$this->ProvinceCode->LinkAttrs;
			$this->Cell_Rendered($this->ProvinceCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// LACode
			$currentValue = $this->LACode->groupValue();
			$viewValue = &$this->LACode->GroupViewValue;
			$viewAttrs = &$this->LACode->ViewAttrs;
			$cellAttrs = &$this->LACode->CellAttrs;
			$hrefValue = &$this->LACode->HrefValue;
			$linkAttrs = &$this->LACode->LinkAttrs;
			$this->Cell_Rendered($this->LACode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DepartmentCode
			$currentValue = $this->DepartmentCode->groupValue();
			$viewValue = &$this->DepartmentCode->GroupViewValue;
			$viewAttrs = &$this->DepartmentCode->ViewAttrs;
			$cellAttrs = &$this->DepartmentCode->CellAttrs;
			$hrefValue = &$this->DepartmentCode->HrefValue;
			$linkAttrs = &$this->DepartmentCode->LinkAttrs;
			$this->Cell_Rendered($this->DepartmentCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SectionCode
			$currentValue = $this->SectionCode->groupValue();
			$viewValue = &$this->SectionCode->GroupViewValue;
			$viewAttrs = &$this->SectionCode->ViewAttrs;
			$cellAttrs = &$this->SectionCode->CellAttrs;
			$hrefValue = &$this->SectionCode->HrefValue;
			$linkAttrs = &$this->SectionCode->LinkAttrs;
			$this->Cell_Rendered($this->SectionCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PositionCode
			$currentValue = $this->PositionCode->CurrentValue;
			$viewValue = &$this->PositionCode->ViewValue;
			$viewAttrs = &$this->PositionCode->ViewAttrs;
			$cellAttrs = &$this->PositionCode->CellAttrs;
			$hrefValue = &$this->PositionCode->HrefValue;
			$linkAttrs = &$this->PositionCode->LinkAttrs;
			$this->Cell_Rendered($this->PositionCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SalaryScale
			$currentValue = $this->SalaryScale->CurrentValue;
			$viewValue = &$this->SalaryScale->ViewValue;
			$viewAttrs = &$this->SalaryScale->ViewAttrs;
			$cellAttrs = &$this->SalaryScale->CellAttrs;
			$hrefValue = &$this->SalaryScale->HrefValue;
			$linkAttrs = &$this->SalaryScale->LinkAttrs;
			$this->Cell_Rendered($this->SalaryScale, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PositionName
			$currentValue = $this->PositionName->CurrentValue;
			$viewValue = &$this->PositionName->ViewValue;
			$viewAttrs = &$this->PositionName->ViewAttrs;
			$cellAttrs = &$this->PositionName->CellAttrs;
			$hrefValue = &$this->PositionName->HrefValue;
			$linkAttrs = &$this->PositionName->LinkAttrs;
			$this->Cell_Rendered($this->PositionName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// RequisiteQualification
			$currentValue = $this->RequisiteQualification->CurrentValue;
			$viewValue = &$this->RequisiteQualification->ViewValue;
			$viewAttrs = &$this->RequisiteQualification->ViewAttrs;
			$cellAttrs = &$this->RequisiteQualification->CellAttrs;
			$hrefValue = &$this->RequisiteQualification->HrefValue;
			$linkAttrs = &$this->RequisiteQualification->LinkAttrs;
			$this->Cell_Rendered($this->RequisiteQualification, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// FieldQualified
			$currentValue = $this->FieldQualified->CurrentValue;
			$viewValue = &$this->FieldQualified->ViewValue;
			$viewAttrs = &$this->FieldQualified->ViewAttrs;
			$cellAttrs = &$this->FieldQualified->CellAttrs;
			$hrefValue = &$this->FieldQualified->HrefValue;
			$linkAttrs = &$this->FieldQualified->LinkAttrs;
			$this->Cell_Rendered($this->FieldQualified, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DepartmentName
			$currentValue = $this->DepartmentName->CurrentValue;
			$viewValue = &$this->DepartmentName->ViewValue;
			$viewAttrs = &$this->DepartmentName->ViewAttrs;
			$cellAttrs = &$this->DepartmentName->CellAttrs;
			$hrefValue = &$this->DepartmentName->HrefValue;
			$linkAttrs = &$this->DepartmentName->LinkAttrs;
			$this->Cell_Rendered($this->DepartmentName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SectionName
			$currentValue = $this->SectionName->CurrentValue;
			$viewValue = &$this->SectionName->ViewValue;
			$viewAttrs = &$this->SectionName->ViewAttrs;
			$cellAttrs = &$this->SectionName->CellAttrs;
			$hrefValue = &$this->SectionName->HrefValue;
			$linkAttrs = &$this->SectionName->LinkAttrs;
			$this->Cell_Rendered($this->SectionName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// CouncilType
			$currentValue = $this->CouncilType->CurrentValue;
			$viewValue = &$this->CouncilType->ViewValue;
			$viewAttrs = &$this->CouncilType->ViewAttrs;
			$cellAttrs = &$this->CouncilType->CellAttrs;
			$hrefValue = &$this->CouncilType->HrefValue;
			$linkAttrs = &$this->CouncilType->LinkAttrs;
			$this->Cell_Rendered($this->CouncilType, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// EmploymentStatus
			$currentValue = $this->EmploymentStatus->CurrentValue;
			$viewValue = &$this->EmploymentStatus->ViewValue;
			$viewAttrs = &$this->EmploymentStatus->ViewAttrs;
			$cellAttrs = &$this->EmploymentStatus->CellAttrs;
			$hrefValue = &$this->EmploymentStatus->HrefValue;
			$linkAttrs = &$this->EmploymentStatus->LinkAttrs;
			$this->Cell_Rendered($this->EmploymentStatus, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MonthsVacant
			$currentValue = $this->MonthsVacant->CurrentValue;
			$viewValue = &$this->MonthsVacant->ViewValue;
			$viewAttrs = &$this->MonthsVacant->ViewAttrs;
			$cellAttrs = &$this->MonthsVacant->CellAttrs;
			$hrefValue = &$this->MonthsVacant->HrefValue;
			$linkAttrs = &$this->MonthsVacant->LinkAttrs;
			$this->Cell_Rendered($this->MonthsVacant, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
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
		if ($this->ProvinceCode->Visible)
			$this->GroupColumnCount += 1;
		if ($this->LACode->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->DepartmentCode->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->SectionCode->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->PositionCode->Visible)
			$this->DetailColumnCount += 1;
		if ($this->SalaryScale->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PositionName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->RequisiteQualification->Visible)
			$this->DetailColumnCount += 1;
		if ($this->FieldQualified->Visible)
			$this->DetailColumnCount += 1;
		if ($this->DepartmentName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->SectionName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->CouncilType->Visible)
			$this->DetailColumnCount += 1;
		if ($this->EmploymentStatus->Visible)
			$this->DetailColumnCount += 1;
		if ($this->MonthsVacant->Visible)
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
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_Vacancy_Report" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_Vacancy_Report\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
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

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : "";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fsummary\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["local_authority"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["local_authority"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Clear previous master key from Session
			if ($masterTblVar != "local_authority") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_PositionCode":
					break;
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
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_PositionCode":
							break;
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
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
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
			$this->ProvinceCode->setSort("");
			$this->LACode->setSort("");
			$this->DepartmentCode->setSort("");
			$this->SectionCode->setSort("");
			$this->PositionCode->setSort("");
			$this->SalaryScale->setSort("");
			$this->PositionName->setSort("");
			$this->RequisiteQualification->setSort("");
			$this->FieldQualified->setSort("");
			$this->DepartmentName->setSort("");
			$this->SectionName->setSort("");
			$this->CouncilType->setSort("");
			$this->EmploymentStatus->setSort("");
			$this->MonthsVacant->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->ProvinceCode); // ProvinceCode
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->SectionCode); // SectionCode
			$this->updateSort($this->PositionCode); // PositionCode
			$this->updateSort($this->SalaryScale); // SalaryScale
			$this->updateSort($this->PositionName); // PositionName
			$this->updateSort($this->RequisiteQualification); // RequisiteQualification
			$this->updateSort($this->FieldQualified); // FieldQualified
			$this->updateSort($this->DepartmentName); // DepartmentName
			$this->updateSort($this->SectionName); // SectionName
			$this->updateSort($this->CouncilType); // CouncilType
			$this->updateSort($this->EmploymentStatus); // EmploymentStatus
			$this->updateSort($this->MonthsVacant); // MonthsVacant
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Return extended filter
	protected function getExtendedFilter()
	{
		global $FormError;
		$filter = "";
		if ($this->DrillDown)
			return "";
		$restoreSession = FALSE;
		$restoreDefault = FALSE;

		// Reset search command
		if (Get("cmd", "") == "reset") {

			// Set default values
			$this->ProvinceCode->AdvancedSearch->unsetSession();
			$this->LACode->AdvancedSearch->unsetSession();
			$this->DepartmentCode->AdvancedSearch->unsetSession();
			$this->SectionCode->AdvancedSearch->unsetSession();
			$this->PositionCode->AdvancedSearch->unsetSession();
			$restoreDefault = TRUE;
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field ProvinceCode
			$this->getDropDownValue($this->ProvinceCode);

			// Field LACode
			$this->getDropDownValue($this->LACode);

			// Field DepartmentCode
			if ($this->DepartmentCode->AdvancedSearch->get()) {
				if (FieldDataType($this->DepartmentCode->Type) == DATATYPE_DATE) // Format default date format
					$this->DepartmentCode->AdvancedSearch->SearchValue = FormatDateTime($this->DepartmentCode->AdvancedSearch->SearchValue, 0);
			}

			// Field SectionCode
			$this->getDropDownValue($this->SectionCode);

			// Field PositionCode
			$this->getDropDownValue($this->PositionCode);
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$restoreDefault = TRUE;
			if ($this->ProvinceCode->AdvancedSearch->issetSession()) { // Field ProvinceCode
				$this->ProvinceCode->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->LACode->AdvancedSearch->issetSession()) { // Field LACode
				$this->LACode->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->DepartmentCode->AdvancedSearch->issetSession()) { // Field DepartmentCode
				$this->DepartmentCode->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->SectionCode->AdvancedSearch->issetSession()) { // Field SectionCode
				$this->SectionCode->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->PositionCode->AdvancedSearch->issetSession()) { // Field PositionCode
				$this->PositionCode->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
		}

		// Restore default
		if ($restoreDefault)
			$this->loadDefaultFilters();

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL and save to session
		$this->buildDropDownFilter($this->ProvinceCode, $filter, $this->ProvinceCode->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field ProvinceCode
		$this->ProvinceCode->AdvancedSearch->save();
		$this->buildDropDownFilter($this->LACode, $filter, $this->LACode->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field LACode
		$this->LACode->AdvancedSearch->save();
		$this->buildExtendedFilter($this->DepartmentCode, $filter, FALSE, TRUE); // Field DepartmentCode
		$this->DepartmentCode->AdvancedSearch->save();
		$this->buildDropDownFilter($this->SectionCode, $filter, $this->SectionCode->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field SectionCode
		$this->SectionCode->AdvancedSearch->save();
		$this->buildDropDownFilter($this->PositionCode, $filter, $this->PositionCode->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field PositionCode
		$this->PositionCode->AdvancedSearch->save();

		// Field ProvinceCode
		LoadDropDownList($this->ProvinceCode->EditValue, $this->ProvinceCode->AdvancedSearch->SearchValue);

		// Field LACode
		LoadDropDownList($this->LACode->EditValue, $this->LACode->AdvancedSearch->SearchValue);

		// Field SectionCode
		LoadDropDownList($this->SectionCode->EditValue, $this->SectionCode->AdvancedSearch->SearchValue);

		// Field PositionCode
		LoadDropDownList($this->PositionCode->EditValue, $this->PositionCode->AdvancedSearch->SearchValue);
		return $filter;
	}

	// Build dropdown filter
	protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = FALSE, $saveFilter = FALSE)
	{
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$sql = "";
		if (is_array($fldVal)) {
			foreach ($fldVal as $val) {
				$wrk = $this->getDropDownFilter($fld, $val, $fldOpr);

				// Call Page Filtering event
				if (!StartsString("@@", $val))
					$this->Page_Filtering($fld, $wrk, "dropdown", $fldOpr, $val);
				if ($wrk != "") {
					if ($sql != "")
						$sql .= " OR " . $wrk;
					else
						$sql = $wrk;
				}
			}
		} else {
			$sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr);

			// Call Page Filtering event
			if (!StartsString("@@", $fldVal))
				$this->Page_Filtering($fld, $sql, "dropdown", $fldOpr, $fldVal);
		}
		if ($sql != "") {
			AddFilter($filterClause, $sql);
			if ($saveFilter) $fld->CurrentFilter = $sql;
		}
	}

	// Get dropdown filter
	protected function getDropDownFilter(&$fld, $fldVal, $fldOpr)
	{
		$fldName = $fld->Name;
		$fldExpression = $fld->Expression;
		$fldDataType = $fld->DataType;
		$isMultiple = $fld->HtmlTag == "CHECKBOX" || $fld->HtmlTag == "SELECT" && $fld->SelectMultiple;
		$fldVal = strval($fldVal);
		if ($fldOpr == "") $fldOpr = "=";
		$wrk = "";
		if (SameString($fldVal, Config("NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NULL";
		} elseif (SameString($fldVal, Config("NOT_NULL_VALUE"))) {
			$wrk = $fldExpression . " IS NOT NULL";
		} elseif (SameString($fldVal, EMPTY_VALUE)) {
			$wrk = $fldExpression . " = ''";
		} elseif (SameString($fldVal, ALL_VALUE)) {
			$wrk = "1 = 1";
		} else {
			if ($fld->GroupSql != "") // Use grouping SQL for search if exists
				$fldExpression = str_replace("%s", $fldExpression, $fld->GroupSql);
			if (StartsString("@@", $fldVal)) {
				$wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
			} elseif ($isMultiple && IsMultiSearchOperator($fldOpr) && trim($fldVal) != "" && $fldVal != INIT_VALUE && ($fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
				$wrk = GetMultiSearchSql($fld, $fldOpr, trim($fldVal), $this->Dbid);
			} else {
				if ($fldVal != "" && $fldVal != INIT_VALUE) {
					if ($fldDataType == DATATYPE_DATE && $fld->GroupSql == "" && $fldOpr != "") {
						$wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
					} else {
						$wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
						if ($wrk != "") $wrk = $fldExpression . $wrk;
					}
				}
			}
		}
		return $wrk;
	}

	// Get custom filter
	protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
	{
		$wrk = "";
		if (is_array($fld->AdvancedFilters)) {
			foreach ($fld->AdvancedFilters as $filter) {
				if ($filter->ID == $fldVal && $filter->Enabled) {
					$fldExpr = $fld->Expression;
					$fn = $filter->FunctionName;
					$wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
					if ($fn != "") {
						$fn = PROJECT_NAMESPACE . $fn;
						$wrk = $fn($fldExpr, $dbid);
					} else
						$wrk = "";
					$this->Page_Filtering($fld, $wrk, "custom", $wrkid);
					break;
				}
			}
		}
		return $wrk;
	}

	// Build extended filter
	protected function buildExtendedFilter(&$fld, &$filterClause, $default = FALSE, $saveFilter = FALSE)
	{
		$wrk = GetExtendedFilter($fld, $default, $this->Dbid);
		if (!$default)
			$this->Page_Filtering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
		if ($wrk != "") {
			AddFilter($filterClause, $wrk);
			if ($saveFilter) $fld->CurrentFilter = $wrk;
		}
	}

	// Get drop down value from querystring
	protected function getDropDownValue(&$fld)
	{
		$parm = $fld->Param;
		if (IsPost())
			return FALSE; // Skip post back
		$opr = Get("z_$parm");
		if ($opr !== NULL)
			$fld->AdvancedSearch->SearchOperator = $opr;
		$val = Get("x_$parm");
		if ($val !== NULL) {
			if (is_array($val))
				$val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val); 
			$fld->AdvancedSearch->setSearchValue($val);
			return TRUE;
		}
		return FALSE;
	}

	// Dropdown filter exist
	protected function dropDownFilterExist(&$fld, $fldOpr)
	{
		$wrk = "";
		$this->buildDropDownFilter($fld, $wrk, $fldOpr);
		return ($wrk != "");
	}

	// Extended filter exist
	protected function extendedFilterExist(&$fld)
	{
		$extWrk = "";
		$this->buildExtendedFilter($fld, $extWrk);
		return ($extWrk != "");
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if (!CheckInteger($this->MonthsVacant->FormValue)) {
			AddMessage($FormError, $this->MonthsVacant->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			$FormError .= ($FormError != "") ? "<p>&nbsp;</p>" : "";
			$FormError .= $formCustomError;
		}
		return $validateForm;
	}

	// Load default value for filters
	protected function loadDefaultFilters()
	{

		/**
		* Set up default values for extended filters
		*/
		// Field ProvinceCode

		$this->ProvinceCode->AdvancedSearch->loadDefault();

		// Field LACode
		$this->LACode->AdvancedSearch->loadDefault();

		// Field DepartmentCode
		$this->DepartmentCode->AdvancedSearch->loadDefault();

		// Field SectionCode
		$this->SectionCode->AdvancedSearch->loadDefault();

		// Field PositionCode
		$this->PositionCode->AdvancedSearch->loadDefault();
	}

	// Show list of filters
	public function showFilterList()
	{
		global $Language;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field ProvinceCode
		$extWrk = "";
		$this->buildDropDownFilter($this->ProvinceCode, $extWrk, $this->ProvinceCode->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->ProvinceCode->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field LACode
		$extWrk = "";
		$this->buildDropDownFilter($this->LACode, $extWrk, $this->LACode->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->LACode->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field DepartmentCode
		$extWrk = "";
		$this->buildExtendedFilter($this->DepartmentCode, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->DepartmentCode->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field SectionCode
		$extWrk = "";
		$this->buildDropDownFilter($this->SectionCode, $extWrk, $this->SectionCode->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->SectionCode->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field PositionCode
		$extWrk = "";
		$this->buildDropDownFilter($this->PositionCode, $extWrk, $this->PositionCode->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->PositionCode->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Show Filters
		if ($filterList != "") {
			$message = "<div id=\"ew-filter-list\" class=\"alert alert-info d-table\"><div id=\"ew-current-filters\">" .
				$Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
			$this->Message_Showing($message, "");
			Write($message);
		}
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Load server side filters
		if (Config("SEARCH_FILTER_OPTION") == "Server" && isset($UserProfile))
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fsummary");

		// Field ProvinceCode
		$wrk = "";
		$wrk = ($this->ProvinceCode->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->ProvinceCode->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_ProvinceCode\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field LACode
		$wrk = "";
		$wrk = ($this->LACode->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->LACode->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_LACode\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field DepartmentCode
		$wrk = "";
		if ($this->DepartmentCode->AdvancedSearch->SearchValue != "" || $this->DepartmentCode->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_DepartmentCode\":\"" . JsEncode($this->DepartmentCode->AdvancedSearch->SearchValue) . "\"," .
				"\"z_DepartmentCode\":\"" . JsEncode($this->DepartmentCode->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_DepartmentCode\":\"" . JsEncode($this->DepartmentCode->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_DepartmentCode\":\"" . JsEncode($this->DepartmentCode->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_DepartmentCode\":\"" . JsEncode($this->DepartmentCode->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field SectionCode
		$wrk = "";
		$wrk = ($this->SectionCode->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->SectionCode->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_SectionCode\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field PositionCode
		$wrk = "";
		$wrk = ($this->PositionCode->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->PositionCode->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_PositionCode\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Return filter list in json
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fsummary", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd", "") != "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter", ""), TRUE);
		return $this->setupFilterList($filter);
	}

	// Setup list of filters
	protected function setupFilterList($filter)
	{
		if (!is_array($filter))
			return FALSE;

		// Field ProvinceCode
		if (!$this->ProvinceCode->AdvancedSearch->getFromArray($filter))
			$this->ProvinceCode->AdvancedSearch->loadDefault(); // Clear filter
		$this->ProvinceCode->AdvancedSearch->save();

		// Field LACode
		if (!$this->LACode->AdvancedSearch->getFromArray($filter))
			$this->LACode->AdvancedSearch->loadDefault(); // Clear filter
		$this->LACode->AdvancedSearch->save();

		// Field DepartmentCode
		if (!$this->DepartmentCode->AdvancedSearch->getFromArray($filter))
			$this->DepartmentCode->AdvancedSearch->loadDefault(); // Clear filter
		$this->DepartmentCode->AdvancedSearch->save();

		// Field SectionCode
		if (!$this->SectionCode->AdvancedSearch->getFromArray($filter))
			$this->SectionCode->AdvancedSearch->loadDefault(); // Clear filter
		$this->SectionCode->AdvancedSearch->save();

		// Field PositionCode
		if (!$this->PositionCode->AdvancedSearch->getFromArray($filter))
			$this->PositionCode->AdvancedSearch->loadDefault(); // Clear filter
		$this->PositionCode->AdvancedSearch->save();
		return TRUE;
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