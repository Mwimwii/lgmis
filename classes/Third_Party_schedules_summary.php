<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class Third_Party_schedules_summary extends Third_Party_schedules
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'Third Party schedules';

	// Page object name
	public $PageObjName = "Third_Party_schedules_summary";

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

		// Table object (Third_Party_schedules)
		if (!isset($GLOBALS["Third_Party_schedules"]) || get_class($GLOBALS["Third_Party_schedules"]) == PROJECT_NAMESPACE . "Third_Party_schedules") {
			$GLOBALS["Third_Party_schedules"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Third_Party_schedules"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Third Party schedules');

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
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->PositionName->setVisibility();
		$this->pCode->setVisibility();
		$this->pName->setVisibility();
		$this->Amount->setVisibility();
		$this->ThirdPartyAccount->setVisibility();

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
			$this->LocalAuthority->setGroupValue($this->GroupRecords[$this->GroupCount][0]);
		else
			$this->LocalAuthority->setGroupValue("");
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["LocalAuthority"] = $record['LocalAuthority'];
			$data["PayrollPeriod"] = $record['PayrollPeriod'];
			$data["Title"] = $record['Title'];
			$data["Surname"] = $record['Surname'];
			$data["FirstName"] = $record['FirstName'];
			$data["MiddleName"] = $record['MiddleName'];
			$data["PositionName"] = $record['PositionName'];
			$data["pCode"] = $record['pCode'];
			$data["pName"] = $record['pName'];
			$data["Amount"] = $record['Amount'];
			$data["PaymentMethod"] = $record['PaymentMethod'];
			$data["BankBranchCode"] = $record['BankBranchCode'];
			$data["BankAccountNo"] = $record['BankAccountNo'];
			$data["ThirdPartyPayMethod"] = $record['ThirdPartyPayMethod'];
			$data["ThirdPartyBank"] = $record['ThirdPartyBank'];
			$data["ThirdPartyAccount"] = $record['ThirdPartyAccount'];
			$this->Rows[] = $data;
		}
		$this->LocalAuthority->setDbValue(GroupValue($this->LocalAuthority, $record['LocalAuthority']));
		$this->PayrollPeriod->setDbValue($record['PayrollPeriod']);
		$this->Title->setDbValue($record['Title']);
		$this->Surname->setDbValue($record['Surname']);
		$this->FirstName->setDbValue($record['FirstName']);
		$this->MiddleName->setDbValue($record['MiddleName']);
		$this->PositionName->setDbValue($record['PositionName']);
		$this->pCode->setDbValue($record['pCode']);
		$this->pName->setDbValue($record['pName']);
		$this->Amount->setDbValue($record['Amount']);
		$this->PaymentMethod->setDbValue($record['PaymentMethod']);
		$this->BankBranchCode->setDbValue($record['BankBranchCode']);
		$this->BankAccountNo->setDbValue($record['BankAccountNo']);
		$this->ThirdPartyPayMethod->setDbValue($record['ThirdPartyPayMethod']);
		$this->ThirdPartyBank->setDbValue($record['ThirdPartyBank']);
		$this->ThirdPartyAccount->setDbValue($record['ThirdPartyAccount']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total

			// Build detail SQL
			$firstGrpFld = &$this->LocalAuthority;
			$firstGrpFld->getDistinctValues($this->GroupRecords);
			$where = DetailFilterSql($firstGrpFld, $this->getSqlFirstGroupField(), $firstGrpFld->DistinctValues, $this->Dbid);
			if ($this->Filter != "")
				$where = "($this->Filter) AND ($where)";
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $where, $this->Sort);
			$rs = $this->getRecordset($sql);
			$records = $rs ? $rs->getRows() : [];
			$this->Amount->getSum($records);
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

			// Get total from SQL directly
			$sql = BuildReportSql($this->getSqlSelectAggregate(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$sql = $this->getSqlAggregatePrefix() . $sql . $this->getSqlAggregateSuffix();
			$rsagg = $conn->execute($sql);
			if ($rsagg) {
				$this->Title->Count = $this->TotalCount;
				$this->Surname->Count = $this->TotalCount;
				$this->FirstName->Count = $this->TotalCount;
				$this->MiddleName->Count = $this->TotalCount;
				$this->PositionName->Count = $this->TotalCount;
				$this->pCode->Count = $this->TotalCount;
				$this->pName->Count = $this->TotalCount;
				$this->Amount->Count = $this->TotalCount;
				$this->Amount->SumValue = $rsagg->fields("sum_amount");
				$this->ThirdPartyAccount->Count = $this->TotalCount;
				$rsagg->close();
				$hasSummary = TRUE;
			}

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			$this->Amount->getSum($this->DetailRecords);
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// LocalAuthority
		// PayrollPeriod
		// ThirdPartyPayMethod
		// ThirdPartyBank
		// Title
		// Surname
		// FirstName
		// MiddleName
		// PositionName
		// pCode
		// pName
		// Amount
		// ThirdPartyAccount

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// LocalAuthority
			$this->LocalAuthority->EditAttrs["class"] = "form-control";
			$this->LocalAuthority->EditCustomAttributes = "";
			if (!$this->LocalAuthority->Raw)
				$this->LocalAuthority->AdvancedSearch->SearchValue = HtmlDecode($this->LocalAuthority->AdvancedSearch->SearchValue);
			$this->LocalAuthority->EditValue = HtmlEncode($this->LocalAuthority->AdvancedSearch->SearchValue);
			$this->LocalAuthority->PlaceHolder = RemoveHtml($this->LocalAuthority->caption());

			// PayrollPeriod
			$this->PayrollPeriod->EditAttrs["class"] = "form-control";
			$this->PayrollPeriod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PayrollPeriod->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PayrollPeriod->AdvancedSearch->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
			else
				$this->PayrollPeriod->AdvancedSearch->ViewValue = $this->PayrollPeriod->Lookup !== NULL && is_array($this->PayrollPeriod->Lookup->Options) ? $curVal : NULL;
			if ($this->PayrollPeriod->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PayrollPeriod->EditValue = array_values($this->PayrollPeriod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PeriodCode`" . SearchString("=", $this->PayrollPeriod->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PayrollPeriod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PayrollPeriod->EditValue = $arwrk;
			}

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->AdvancedSearch->SearchValue = HtmlDecode($this->Surname->AdvancedSearch->SearchValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->AdvancedSearch->SearchValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->AdvancedSearch->SearchValue = HtmlDecode($this->FirstName->AdvancedSearch->SearchValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->AdvancedSearch->SearchValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->AdvancedSearch->SearchValue = HtmlDecode($this->PositionName->AdvancedSearch->SearchValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->AdvancedSearch->SearchValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// pCode
			$this->pCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->pCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->pCode->AdvancedSearch->ViewValue = $this->pCode->lookupCacheOption($curVal);
			else
				$this->pCode->AdvancedSearch->ViewValue = $this->pCode->Lookup !== NULL && is_array($this->pCode->Lookup->Options) ? $curVal : NULL;
			if ($this->pCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->pCode->EditValue = array_values($this->pCode->Lookup->Options);
				if ($this->pCode->AdvancedSearch->ViewValue == "")
					$this->pCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`pName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->pCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->pCode->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->pCode->AdvancedSearch->ViewValue->add($this->pCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->pCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pCode->EditValue = $arwrk;
			}

			// ThirdPartyPayMethod
			$this->ThirdPartyPayMethod->EditAttrs["class"] = "form-control";
			$this->ThirdPartyPayMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdPartyPayMethod->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ThirdPartyPayMethod->AdvancedSearch->ViewValue = $this->ThirdPartyPayMethod->lookupCacheOption($curVal);
			else
				$this->ThirdPartyPayMethod->AdvancedSearch->ViewValue = $this->ThirdPartyPayMethod->Lookup !== NULL && is_array($this->ThirdPartyPayMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdPartyPayMethod->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ThirdPartyPayMethod->EditValue = array_values($this->ThirdPartyPayMethod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->ThirdPartyPayMethod->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ThirdPartyPayMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdPartyPayMethod->EditValue = $arwrk;
			}

			// ThirdPartyBank
			$this->ThirdPartyBank->EditAttrs["class"] = "form-control";
			$this->ThirdPartyBank->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdPartyBank->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ThirdPartyBank->AdvancedSearch->ViewValue = $this->ThirdPartyBank->lookupCacheOption($curVal);
			else
				$this->ThirdPartyBank->AdvancedSearch->ViewValue = $this->ThirdPartyBank->Lookup !== NULL && is_array($this->ThirdPartyBank->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdPartyBank->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ThirdPartyBank->EditValue = array_values($this->ThirdPartyBank->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BranchCode`" . SearchString("=", $this->ThirdPartyBank->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ThirdPartyBank->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdPartyBank->EditValue = $arwrk;
			}
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->LocalAuthority->groupValue(); // Set up group attribute
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 2)
				$this->RowAttrs["data-group-2"] = $this->PayrollPeriod->groupValue(); // Set up group attribute 2
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 3)
				$this->RowAttrs["data-group-3"] = $this->ThirdPartyPayMethod->groupValue(); // Set up group attribute 3
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 4)
				$this->RowAttrs["data-group-4"] = $this->ThirdPartyBank->groupValue(); // Set up group attribute 4

			// LocalAuthority
			$this->LocalAuthority->GroupViewValue = $this->LocalAuthority->groupValue();
			$this->LocalAuthority->CellCssClass = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->LocalAuthority->ViewCustomAttributes = "";
			$this->LocalAuthority->GroupViewValue = DisplayGroupValue($this->LocalAuthority, $this->LocalAuthority->GroupViewValue);

			// PayrollPeriod
			$curVal = strval($this->PayrollPeriod->groupValue());
			if ($curVal != "") {
				$this->PayrollPeriod->GroupViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
				if ($this->PayrollPeriod->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PayrollPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PayrollPeriod->GroupViewValue = $this->PayrollPeriod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PayrollPeriod->GroupViewValue = $this->PayrollPeriod->groupValue();
					}
				}
			} else {
				$this->PayrollPeriod->GroupViewValue = NULL;
			}
			$this->PayrollPeriod->CellCssClass = ($this->RowGroupLevel == 2 ? "ew-rpt-grp-summary-2" : "ew-rpt-grp-field-2");
			$this->PayrollPeriod->ViewCustomAttributes = "";
			$this->PayrollPeriod->GroupViewValue = DisplayGroupValue($this->PayrollPeriod, $this->PayrollPeriod->GroupViewValue);

			// ThirdPartyPayMethod
			$curVal = strval($this->ThirdPartyPayMethod->groupValue());
			if ($curVal != "") {
				$this->ThirdPartyPayMethod->GroupViewValue = $this->ThirdPartyPayMethod->lookupCacheOption($curVal);
				if ($this->ThirdPartyPayMethod->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ThirdPartyPayMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ThirdPartyPayMethod->GroupViewValue = $this->ThirdPartyPayMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ThirdPartyPayMethod->GroupViewValue = $this->ThirdPartyPayMethod->groupValue();
					}
				}
			} else {
				$this->ThirdPartyPayMethod->GroupViewValue = NULL;
			}
			$this->ThirdPartyPayMethod->CellCssClass = ($this->RowGroupLevel == 3 ? "ew-rpt-grp-summary-3" : "ew-rpt-grp-field-3");
			$this->ThirdPartyPayMethod->ViewCustomAttributes = "";
			$this->ThirdPartyPayMethod->GroupViewValue = DisplayGroupValue($this->ThirdPartyPayMethod, $this->ThirdPartyPayMethod->GroupViewValue);

			// ThirdPartyBank
			$curVal = strval($this->ThirdPartyBank->groupValue());
			if ($curVal != "") {
				$this->ThirdPartyBank->GroupViewValue = $this->ThirdPartyBank->lookupCacheOption($curVal);
				if ($this->ThirdPartyBank->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ThirdPartyBank->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ThirdPartyBank->GroupViewValue = $this->ThirdPartyBank->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ThirdPartyBank->GroupViewValue = $this->ThirdPartyBank->groupValue();
					}
				}
			} else {
				$this->ThirdPartyBank->GroupViewValue = NULL;
			}
			$this->ThirdPartyBank->CellCssClass = ($this->RowGroupLevel == 4 ? "ew-rpt-grp-summary-4" : "ew-rpt-grp-field-4");
			$this->ThirdPartyBank->ViewCustomAttributes = "";
			$this->ThirdPartyBank->GroupViewValue = DisplayGroupValue($this->ThirdPartyBank, $this->ThirdPartyBank->GroupViewValue);

			// Amount
			$this->Amount->SumViewValue = $this->Amount->SumValue;
			$this->Amount->SumViewValue = FormatNumber($this->Amount->SumViewValue, 2, -2, -2, -2);
			$this->Amount->CellCssStyle .= "text-align: right;";
			$this->Amount->ViewCustomAttributes = "";
			$this->Amount->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// LocalAuthority
			$this->LocalAuthority->HrefValue = "";

			// PayrollPeriod
			$this->PayrollPeriod->HrefValue = "";

			// ThirdPartyPayMethod
			$this->ThirdPartyPayMethod->HrefValue = "";

			// ThirdPartyBank
			$this->ThirdPartyBank->HrefValue = "";

			// Title
			$this->Title->HrefValue = "";

			// Surname
			$this->Surname->HrefValue = "";

			// FirstName
			$this->FirstName->HrefValue = "";

			// MiddleName
			$this->MiddleName->HrefValue = "";

			// PositionName
			$this->PositionName->HrefValue = "";

			// pCode
			$this->pCode->HrefValue = "";

			// pName
			$this->pName->HrefValue = "";

			// Amount
			$this->Amount->HrefValue = "";

			// ThirdPartyAccount
			$this->ThirdPartyAccount->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->LocalAuthority->groupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->PayrollPeriod->groupValue(); // Set up group attribute 2
			if ($this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->ThirdPartyPayMethod->groupValue(); // Set up group attribute 3
			if ($this->RowGroupLevel >= 4) $this->RowAttrs["data-group-4"] = $this->ThirdPartyBank->groupValue(); // Set up group attribute 4
			} else {
			$this->RowAttrs["data-group"] = $this->LocalAuthority->groupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->PayrollPeriod->groupValue(); // Set up group attribute 2
			$this->RowAttrs["data-group-3"] = $this->ThirdPartyPayMethod->groupValue(); // Set up group attribute 3
			$this->RowAttrs["data-group-4"] = $this->ThirdPartyBank->groupValue(); // Set up group attribute 4
			}

			// LocalAuthority
			$this->LocalAuthority->GroupViewValue = $this->LocalAuthority->groupValue();
			$this->LocalAuthority->CellCssClass = "ew-rpt-grp-field-1";
			$this->LocalAuthority->ViewCustomAttributes = "";
			$this->LocalAuthority->GroupViewValue = DisplayGroupValue($this->LocalAuthority, $this->LocalAuthority->GroupViewValue);
			if (!$this->LocalAuthority->LevelBreak)
				$this->LocalAuthority->GroupViewValue = "&nbsp;";
			else
				$this->LocalAuthority->LevelBreak = FALSE;

			// PayrollPeriod
			$curVal = strval($this->PayrollPeriod->groupValue());
			if ($curVal != "") {
				$this->PayrollPeriod->GroupViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
				if ($this->PayrollPeriod->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PayrollPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PayrollPeriod->GroupViewValue = $this->PayrollPeriod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PayrollPeriod->GroupViewValue = $this->PayrollPeriod->groupValue();
					}
				}
			} else {
				$this->PayrollPeriod->GroupViewValue = NULL;
			}
			$this->PayrollPeriod->CellCssClass = "ew-rpt-grp-field-2";
			$this->PayrollPeriod->ViewCustomAttributes = "";
			$this->PayrollPeriod->GroupViewValue = DisplayGroupValue($this->PayrollPeriod, $this->PayrollPeriod->GroupViewValue);
			if (!$this->PayrollPeriod->LevelBreak)
				$this->PayrollPeriod->GroupViewValue = "&nbsp;";
			else
				$this->PayrollPeriod->LevelBreak = FALSE;

			// ThirdPartyPayMethod
			$curVal = strval($this->ThirdPartyPayMethod->groupValue());
			if ($curVal != "") {
				$this->ThirdPartyPayMethod->GroupViewValue = $this->ThirdPartyPayMethod->lookupCacheOption($curVal);
				if ($this->ThirdPartyPayMethod->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ThirdPartyPayMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ThirdPartyPayMethod->GroupViewValue = $this->ThirdPartyPayMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ThirdPartyPayMethod->GroupViewValue = $this->ThirdPartyPayMethod->groupValue();
					}
				}
			} else {
				$this->ThirdPartyPayMethod->GroupViewValue = NULL;
			}
			$this->ThirdPartyPayMethod->CellCssClass = "ew-rpt-grp-field-3";
			$this->ThirdPartyPayMethod->ViewCustomAttributes = "";
			$this->ThirdPartyPayMethod->GroupViewValue = DisplayGroupValue($this->ThirdPartyPayMethod, $this->ThirdPartyPayMethod->GroupViewValue);
			if (!$this->ThirdPartyPayMethod->LevelBreak)
				$this->ThirdPartyPayMethod->GroupViewValue = "&nbsp;";
			else
				$this->ThirdPartyPayMethod->LevelBreak = FALSE;

			// ThirdPartyBank
			$curVal = strval($this->ThirdPartyBank->groupValue());
			if ($curVal != "") {
				$this->ThirdPartyBank->GroupViewValue = $this->ThirdPartyBank->lookupCacheOption($curVal);
				if ($this->ThirdPartyBank->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ThirdPartyBank->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ThirdPartyBank->GroupViewValue = $this->ThirdPartyBank->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ThirdPartyBank->GroupViewValue = $this->ThirdPartyBank->groupValue();
					}
				}
			} else {
				$this->ThirdPartyBank->GroupViewValue = NULL;
			}
			$this->ThirdPartyBank->CellCssClass = "ew-rpt-grp-field-4";
			$this->ThirdPartyBank->ViewCustomAttributes = "";
			$this->ThirdPartyBank->GroupViewValue = DisplayGroupValue($this->ThirdPartyBank, $this->ThirdPartyBank->GroupViewValue);
			if (!$this->ThirdPartyBank->LevelBreak)
				$this->ThirdPartyBank->GroupViewValue = "&nbsp;";
			else
				$this->ThirdPartyBank->LevelBreak = FALSE;

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

			// PositionName
			$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
			$this->PositionName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->PositionName->ViewCustomAttributes = "";

			// pCode
			$curVal = strval($this->pCode->CurrentValue);
			if ($curVal != "") {
				$this->pCode->ViewValue = $this->pCode->lookupCacheOption($curVal);
				if ($this->pCode->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`pName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->pCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->pCode->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->pCode->ViewValue->add($this->pCode->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->pCode->ViewValue = $this->pCode->CurrentValue;
					}
				}
			} else {
				$this->pCode->ViewValue = NULL;
			}
			$this->pCode->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->pCode->ViewCustomAttributes = "";

			// pName
			$this->pName->ViewValue = $this->pName->CurrentValue;
			$this->pName->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->pName->ViewCustomAttributes = "";

			// Amount
			$this->Amount->ViewValue = $this->Amount->CurrentValue;
			$this->Amount->ViewValue = FormatNumber($this->Amount->ViewValue, 2, -2, -2, -2);
			$this->Amount->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Amount->CellCssStyle .= "text-align: right;";
			$this->Amount->ViewCustomAttributes = "";

			// ThirdPartyAccount
			$this->ThirdPartyAccount->ViewValue = $this->ThirdPartyAccount->CurrentValue;
			$this->ThirdPartyAccount->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->ThirdPartyAccount->ViewCustomAttributes = "";

			// LocalAuthority
			$this->LocalAuthority->LinkCustomAttributes = "";
			$this->LocalAuthority->HrefValue = "";
			$this->LocalAuthority->TooltipValue = "";

			// PayrollPeriod
			$this->PayrollPeriod->LinkCustomAttributes = "";
			$this->PayrollPeriod->HrefValue = "";
			$this->PayrollPeriod->TooltipValue = "";

			// ThirdPartyPayMethod
			$this->ThirdPartyPayMethod->LinkCustomAttributes = "";
			$this->ThirdPartyPayMethod->HrefValue = "";
			$this->ThirdPartyPayMethod->TooltipValue = "";

			// ThirdPartyBank
			$this->ThirdPartyBank->LinkCustomAttributes = "";
			$this->ThirdPartyBank->HrefValue = "";
			$this->ThirdPartyBank->TooltipValue = "";

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

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";
			$this->PositionName->TooltipValue = "";

			// pCode
			$this->pCode->LinkCustomAttributes = "";
			$this->pCode->HrefValue = "";
			$this->pCode->TooltipValue = "";

			// pName
			$this->pName->LinkCustomAttributes = "";
			$this->pName->HrefValue = "";
			$this->pName->TooltipValue = "";

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";
			$this->Amount->TooltipValue = "";

			// ThirdPartyAccount
			$this->ThirdPartyAccount->LinkCustomAttributes = "";
			$this->ThirdPartyAccount->HrefValue = "";
			$this->ThirdPartyAccount->TooltipValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// LocalAuthority
			$currentValue = $this->LocalAuthority->GroupViewValue;
			$viewValue = &$this->LocalAuthority->GroupViewValue;
			$viewAttrs = &$this->LocalAuthority->ViewAttrs;
			$cellAttrs = &$this->LocalAuthority->CellAttrs;
			$hrefValue = &$this->LocalAuthority->HrefValue;
			$linkAttrs = &$this->LocalAuthority->LinkAttrs;
			$this->Cell_Rendered($this->LocalAuthority, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PayrollPeriod
			$currentValue = $this->PayrollPeriod->GroupViewValue;
			$viewValue = &$this->PayrollPeriod->GroupViewValue;
			$viewAttrs = &$this->PayrollPeriod->ViewAttrs;
			$cellAttrs = &$this->PayrollPeriod->CellAttrs;
			$hrefValue = &$this->PayrollPeriod->HrefValue;
			$linkAttrs = &$this->PayrollPeriod->LinkAttrs;
			$this->Cell_Rendered($this->PayrollPeriod, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ThirdPartyPayMethod
			$currentValue = $this->ThirdPartyPayMethod->GroupViewValue;
			$viewValue = &$this->ThirdPartyPayMethod->GroupViewValue;
			$viewAttrs = &$this->ThirdPartyPayMethod->ViewAttrs;
			$cellAttrs = &$this->ThirdPartyPayMethod->CellAttrs;
			$hrefValue = &$this->ThirdPartyPayMethod->HrefValue;
			$linkAttrs = &$this->ThirdPartyPayMethod->LinkAttrs;
			$this->Cell_Rendered($this->ThirdPartyPayMethod, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ThirdPartyBank
			$currentValue = $this->ThirdPartyBank->GroupViewValue;
			$viewValue = &$this->ThirdPartyBank->GroupViewValue;
			$viewAttrs = &$this->ThirdPartyBank->ViewAttrs;
			$cellAttrs = &$this->ThirdPartyBank->CellAttrs;
			$hrefValue = &$this->ThirdPartyBank->HrefValue;
			$linkAttrs = &$this->ThirdPartyBank->LinkAttrs;
			$this->Cell_Rendered($this->ThirdPartyBank, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Amount
			$currentValue = $this->Amount->SumValue;
			$viewValue = &$this->Amount->SumViewValue;
			$viewAttrs = &$this->Amount->ViewAttrs;
			$cellAttrs = &$this->Amount->CellAttrs;
			$hrefValue = &$this->Amount->HrefValue;
			$linkAttrs = &$this->Amount->LinkAttrs;
			$this->Cell_Rendered($this->Amount, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// LocalAuthority
			$currentValue = $this->LocalAuthority->groupValue();
			$viewValue = &$this->LocalAuthority->GroupViewValue;
			$viewAttrs = &$this->LocalAuthority->ViewAttrs;
			$cellAttrs = &$this->LocalAuthority->CellAttrs;
			$hrefValue = &$this->LocalAuthority->HrefValue;
			$linkAttrs = &$this->LocalAuthority->LinkAttrs;
			$this->Cell_Rendered($this->LocalAuthority, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PayrollPeriod
			$currentValue = $this->PayrollPeriod->groupValue();
			$viewValue = &$this->PayrollPeriod->GroupViewValue;
			$viewAttrs = &$this->PayrollPeriod->ViewAttrs;
			$cellAttrs = &$this->PayrollPeriod->CellAttrs;
			$hrefValue = &$this->PayrollPeriod->HrefValue;
			$linkAttrs = &$this->PayrollPeriod->LinkAttrs;
			$this->Cell_Rendered($this->PayrollPeriod, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ThirdPartyPayMethod
			$currentValue = $this->ThirdPartyPayMethod->groupValue();
			$viewValue = &$this->ThirdPartyPayMethod->GroupViewValue;
			$viewAttrs = &$this->ThirdPartyPayMethod->ViewAttrs;
			$cellAttrs = &$this->ThirdPartyPayMethod->CellAttrs;
			$hrefValue = &$this->ThirdPartyPayMethod->HrefValue;
			$linkAttrs = &$this->ThirdPartyPayMethod->LinkAttrs;
			$this->Cell_Rendered($this->ThirdPartyPayMethod, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ThirdPartyBank
			$currentValue = $this->ThirdPartyBank->groupValue();
			$viewValue = &$this->ThirdPartyBank->GroupViewValue;
			$viewAttrs = &$this->ThirdPartyBank->ViewAttrs;
			$cellAttrs = &$this->ThirdPartyBank->CellAttrs;
			$hrefValue = &$this->ThirdPartyBank->HrefValue;
			$linkAttrs = &$this->ThirdPartyBank->LinkAttrs;
			$this->Cell_Rendered($this->ThirdPartyBank, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

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

			// PositionName
			$currentValue = $this->PositionName->CurrentValue;
			$viewValue = &$this->PositionName->ViewValue;
			$viewAttrs = &$this->PositionName->ViewAttrs;
			$cellAttrs = &$this->PositionName->CellAttrs;
			$hrefValue = &$this->PositionName->HrefValue;
			$linkAttrs = &$this->PositionName->LinkAttrs;
			$this->Cell_Rendered($this->PositionName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// pCode
			$currentValue = $this->pCode->CurrentValue;
			$viewValue = &$this->pCode->ViewValue;
			$viewAttrs = &$this->pCode->ViewAttrs;
			$cellAttrs = &$this->pCode->CellAttrs;
			$hrefValue = &$this->pCode->HrefValue;
			$linkAttrs = &$this->pCode->LinkAttrs;
			$this->Cell_Rendered($this->pCode, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// pName
			$currentValue = $this->pName->CurrentValue;
			$viewValue = &$this->pName->ViewValue;
			$viewAttrs = &$this->pName->ViewAttrs;
			$cellAttrs = &$this->pName->CellAttrs;
			$hrefValue = &$this->pName->HrefValue;
			$linkAttrs = &$this->pName->LinkAttrs;
			$this->Cell_Rendered($this->pName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Amount
			$currentValue = $this->Amount->CurrentValue;
			$viewValue = &$this->Amount->ViewValue;
			$viewAttrs = &$this->Amount->ViewAttrs;
			$cellAttrs = &$this->Amount->CellAttrs;
			$hrefValue = &$this->Amount->HrefValue;
			$linkAttrs = &$this->Amount->LinkAttrs;
			$this->Cell_Rendered($this->Amount, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// ThirdPartyAccount
			$currentValue = $this->ThirdPartyAccount->CurrentValue;
			$viewValue = &$this->ThirdPartyAccount->ViewValue;
			$viewAttrs = &$this->ThirdPartyAccount->ViewAttrs;
			$cellAttrs = &$this->ThirdPartyAccount->CellAttrs;
			$hrefValue = &$this->ThirdPartyAccount->HrefValue;
			$linkAttrs = &$this->ThirdPartyAccount->LinkAttrs;
			$this->Cell_Rendered($this->ThirdPartyAccount, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
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
		if ($this->LocalAuthority->Visible)
			$this->GroupColumnCount += 1;
		if ($this->PayrollPeriod->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->ThirdPartyPayMethod->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->ThirdPartyBank->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->Title->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Surname->Visible)
			$this->DetailColumnCount += 1;
		if ($this->FirstName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->MiddleName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PositionName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->pCode->Visible)
			$this->DetailColumnCount += 1;
		if ($this->pName->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Amount->Visible)
			$this->DetailColumnCount += 1;
		if ($this->ThirdPartyAccount->Visible)
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
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_Third_Party_schedules" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_Third_Party_schedules\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
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
				case "x_PayrollPeriod":
					break;
				case "x_pCode":
					break;
				case "x_PaymentMethod":
					break;
				case "x_BankBranchCode":
					break;
				case "x_ThirdPartyPayMethod":
					break;
				case "x_ThirdPartyBank":
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
						case "x_PayrollPeriod":
							break;
						case "x_pCode":
							break;
						case "x_PaymentMethod":
							break;
						case "x_BankBranchCode":
							break;
						case "x_ThirdPartyPayMethod":
							break;
						case "x_ThirdPartyBank":
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
			return "`Surname` ASC,`FirstName` ASC";
		$resetSort = Param("cmd") === "resetsort";
		$orderBy = Param("order", "");
		$orderType = Param("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->LocalAuthority->setSort("");
			$this->PayrollPeriod->setSort("");
			$this->Title->setSort("");
			$this->Surname->setSort("");
			$this->FirstName->setSort("");
			$this->MiddleName->setSort("");
			$this->PositionName->setSort("");
			$this->pCode->setSort("");
			$this->pName->setSort("");
			$this->Amount->setSort("");
			$this->ThirdPartyPayMethod->setSort("");
			$this->ThirdPartyBank->setSort("");
			$this->ThirdPartyAccount->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->LocalAuthority); // LocalAuthority
			$this->updateSort($this->PayrollPeriod); // PayrollPeriod
			$this->updateSort($this->Title); // Title
			$this->updateSort($this->Surname); // Surname
			$this->updateSort($this->FirstName); // FirstName
			$this->updateSort($this->MiddleName); // MiddleName
			$this->updateSort($this->PositionName); // PositionName
			$this->updateSort($this->pCode); // pCode
			$this->updateSort($this->pName); // pName
			$this->updateSort($this->Amount); // Amount
			$this->updateSort($this->ThirdPartyPayMethod); // ThirdPartyPayMethod
			$this->updateSort($this->ThirdPartyBank); // ThirdPartyBank
			$this->updateSort($this->ThirdPartyAccount); // ThirdPartyAccount
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}

		// Set up default sort
		if ($this->getOrderBy() == "") {
			$this->setOrderBy("`Surname` ASC,`FirstName` ASC");
			$this->Surname->setSort("ASC");
			$this->FirstName->setSort("ASC");
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
			$this->LocalAuthority->AdvancedSearch->unsetSession();
			$this->PayrollPeriod->AdvancedSearch->unsetSession();
			$this->Surname->AdvancedSearch->unsetSession();
			$this->FirstName->AdvancedSearch->unsetSession();
			$this->PositionName->AdvancedSearch->unsetSession();
			$this->pCode->AdvancedSearch->unsetSession();
			$this->ThirdPartyPayMethod->AdvancedSearch->unsetSession();
			$this->ThirdPartyBank->AdvancedSearch->unsetSession();
			$restoreDefault = TRUE;
		} else {
			$restoreSession = !$this->SearchCommand;

			// Field LocalAuthority
			if ($this->LocalAuthority->AdvancedSearch->get()) {
			}

			// Field PayrollPeriod
			$this->getDropDownValue($this->PayrollPeriod);

			// Field Surname
			if ($this->Surname->AdvancedSearch->get()) {
			}

			// Field FirstName
			if ($this->FirstName->AdvancedSearch->get()) {
			}

			// Field PositionName
			if ($this->PositionName->AdvancedSearch->get()) {
			}

			// Field pCode
			$this->getDropDownValue($this->pCode);

			// Field ThirdPartyPayMethod
			$this->getDropDownValue($this->ThirdPartyPayMethod);

			// Field ThirdPartyBank
			$this->getDropDownValue($this->ThirdPartyBank);
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				return $filter;
			}
		}

		// Restore session
		if ($restoreSession) {
			$restoreDefault = TRUE;
			if ($this->LocalAuthority->AdvancedSearch->issetSession()) { // Field LocalAuthority
				$this->LocalAuthority->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->PayrollPeriod->AdvancedSearch->issetSession()) { // Field PayrollPeriod
				$this->PayrollPeriod->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->Surname->AdvancedSearch->issetSession()) { // Field Surname
				$this->Surname->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->FirstName->AdvancedSearch->issetSession()) { // Field FirstName
				$this->FirstName->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->PositionName->AdvancedSearch->issetSession()) { // Field PositionName
				$this->PositionName->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->pCode->AdvancedSearch->issetSession()) { // Field pCode
				$this->pCode->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->ThirdPartyPayMethod->AdvancedSearch->issetSession()) { // Field ThirdPartyPayMethod
				$this->ThirdPartyPayMethod->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
			if ($this->ThirdPartyBank->AdvancedSearch->issetSession()) { // Field ThirdPartyBank
				$this->ThirdPartyBank->AdvancedSearch->load();
				$restoreDefault = FALSE;
			}
		}

		// Restore default
		if ($restoreDefault)
			$this->loadDefaultFilters();

		// Call page filter validated event
		$this->Page_FilterValidated();

		// Build SQL and save to session
		$this->buildExtendedFilter($this->LocalAuthority, $filter, FALSE, TRUE); // Field LocalAuthority
		$this->LocalAuthority->AdvancedSearch->save();
		$this->buildDropDownFilter($this->PayrollPeriod, $filter, $this->PayrollPeriod->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field PayrollPeriod
		$this->PayrollPeriod->AdvancedSearch->save();
		$this->buildExtendedFilter($this->Surname, $filter, FALSE, TRUE); // Field Surname
		$this->Surname->AdvancedSearch->save();
		$this->buildExtendedFilter($this->FirstName, $filter, FALSE, TRUE); // Field FirstName
		$this->FirstName->AdvancedSearch->save();
		$this->buildExtendedFilter($this->PositionName, $filter, FALSE, TRUE); // Field PositionName
		$this->PositionName->AdvancedSearch->save();
		$this->buildDropDownFilter($this->pCode, $filter, $this->pCode->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field pCode
		$this->pCode->AdvancedSearch->save();
		$this->buildDropDownFilter($this->ThirdPartyPayMethod, $filter, $this->ThirdPartyPayMethod->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field ThirdPartyPayMethod
		$this->ThirdPartyPayMethod->AdvancedSearch->save();
		$this->buildDropDownFilter($this->ThirdPartyBank, $filter, $this->ThirdPartyBank->AdvancedSearch->SearchOperator, FALSE, TRUE); // Field ThirdPartyBank
		$this->ThirdPartyBank->AdvancedSearch->save();

		// Field PayrollPeriod
		LoadDropDownList($this->PayrollPeriod->EditValue, $this->PayrollPeriod->AdvancedSearch->SearchValue);

		// Field pCode
		LoadDropDownList($this->pCode->EditValue, $this->pCode->AdvancedSearch->SearchValue);

		// Field ThirdPartyPayMethod
		LoadDropDownList($this->ThirdPartyPayMethod->EditValue, $this->ThirdPartyPayMethod->AdvancedSearch->SearchValue);

		// Field ThirdPartyBank
		LoadDropDownList($this->ThirdPartyBank->EditValue, $this->ThirdPartyBank->AdvancedSearch->SearchValue);
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
		// Field LocalAuthority

		$this->LocalAuthority->AdvancedSearch->loadDefault();

		// Field PayrollPeriod
		$this->PayrollPeriod->AdvancedSearch->loadDefault();

		// Field Surname
		$this->Surname->AdvancedSearch->loadDefault();

		// Field FirstName
		$this->FirstName->AdvancedSearch->loadDefault();

		// Field PositionName
		$this->PositionName->AdvancedSearch->loadDefault();

		// Field pCode
		$this->pCode->AdvancedSearch->loadDefault();

		// Field ThirdPartyPayMethod
		$this->ThirdPartyPayMethod->AdvancedSearch->loadDefault();

		// Field ThirdPartyBank
		$this->ThirdPartyBank->AdvancedSearch->loadDefault();
	}

	// Show list of filters
	public function showFilterList()
	{
		global $Language;

		// Initialize
		$filterList = "";
		$captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
		$captionSuffix = $this->isExport("email") ? ": " : "";

		// Field LocalAuthority
		$extWrk = "";
		$this->buildExtendedFilter($this->LocalAuthority, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->LocalAuthority->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field PayrollPeriod
		$extWrk = "";
		$this->buildDropDownFilter($this->PayrollPeriod, $extWrk, $this->PayrollPeriod->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->PayrollPeriod->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field Surname
		$extWrk = "";
		$this->buildExtendedFilter($this->Surname, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->Surname->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field FirstName
		$extWrk = "";
		$this->buildExtendedFilter($this->FirstName, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->FirstName->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field PositionName
		$extWrk = "";
		$this->buildExtendedFilter($this->PositionName, $extWrk);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->PositionName->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field pCode
		$extWrk = "";
		$this->buildDropDownFilter($this->pCode, $extWrk, $this->pCode->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->pCode->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field ThirdPartyPayMethod
		$extWrk = "";
		$this->buildDropDownFilter($this->ThirdPartyPayMethod, $extWrk, $this->ThirdPartyPayMethod->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->ThirdPartyPayMethod->caption() . "</span>" . $captionSuffix . $filter . "</div>";

		// Field ThirdPartyBank
		$extWrk = "";
		$this->buildDropDownFilter($this->ThirdPartyBank, $extWrk, $this->ThirdPartyBank->AdvancedSearch->SearchOperator);
		$filter = "";
		if ($extWrk != "")
			$filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
		if ($filter != "")
			$filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->ThirdPartyBank->caption() . "</span>" . $captionSuffix . $filter . "</div>";

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

		// Field LocalAuthority
		$wrk = "";
		if ($this->LocalAuthority->AdvancedSearch->SearchValue != "" || $this->LocalAuthority->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_LocalAuthority\":\"" . JsEncode($this->LocalAuthority->AdvancedSearch->SearchValue) . "\"," .
				"\"z_LocalAuthority\":\"" . JsEncode($this->LocalAuthority->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_LocalAuthority\":\"" . JsEncode($this->LocalAuthority->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_LocalAuthority\":\"" . JsEncode($this->LocalAuthority->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_LocalAuthority\":\"" . JsEncode($this->LocalAuthority->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field PayrollPeriod
		$wrk = "";
		$wrk = ($this->PayrollPeriod->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->PayrollPeriod->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_PayrollPeriod\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field Surname
		$wrk = "";
		if ($this->Surname->AdvancedSearch->SearchValue != "" || $this->Surname->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_Surname\":\"" . JsEncode($this->Surname->AdvancedSearch->SearchValue) . "\"," .
				"\"z_Surname\":\"" . JsEncode($this->Surname->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_Surname\":\"" . JsEncode($this->Surname->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_Surname\":\"" . JsEncode($this->Surname->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_Surname\":\"" . JsEncode($this->Surname->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field FirstName
		$wrk = "";
		if ($this->FirstName->AdvancedSearch->SearchValue != "" || $this->FirstName->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_FirstName\":\"" . JsEncode($this->FirstName->AdvancedSearch->SearchValue) . "\"," .
				"\"z_FirstName\":\"" . JsEncode($this->FirstName->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_FirstName\":\"" . JsEncode($this->FirstName->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_FirstName\":\"" . JsEncode($this->FirstName->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_FirstName\":\"" . JsEncode($this->FirstName->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field PositionName
		$wrk = "";
		if ($this->PositionName->AdvancedSearch->SearchValue != "" || $this->PositionName->AdvancedSearch->SearchValue2 != "") {
			$wrk = "\"x_PositionName\":\"" . JsEncode($this->PositionName->AdvancedSearch->SearchValue) . "\"," .
				"\"z_PositionName\":\"" . JsEncode($this->PositionName->AdvancedSearch->SearchOperator) . "\"," .
				"\"v_PositionName\":\"" . JsEncode($this->PositionName->AdvancedSearch->SearchCondition) . "\"," .
				"\"y_PositionName\":\"" . JsEncode($this->PositionName->AdvancedSearch->SearchValue2) . "\"," .
				"\"w_PositionName\":\"" . JsEncode($this->PositionName->AdvancedSearch->SearchOperator2) . "\"";
		}
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field pCode
		$wrk = "";
		$wrk = ($this->pCode->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->pCode->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_pCode\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field ThirdPartyPayMethod
		$wrk = "";
		$wrk = ($this->ThirdPartyPayMethod->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->ThirdPartyPayMethod->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_ThirdPartyPayMethod\":\"" . JsEncode($wrk) . "\"";
		if ($wrk != "") {
			if ($filterList != "") $filterList .= ",";
			$filterList .= $wrk;
		}

		// Field ThirdPartyBank
		$wrk = "";
		$wrk = ($this->ThirdPartyBank->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->ThirdPartyBank->AdvancedSearch->SearchValue : "";
		if (is_array($wrk))
			$wrk = implode("||", $wrk);
		if ($wrk != "")
			$wrk = "\"x_ThirdPartyBank\":\"" . JsEncode($wrk) . "\"";
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

		// Field LocalAuthority
		if (!$this->LocalAuthority->AdvancedSearch->getFromArray($filter))
			$this->LocalAuthority->AdvancedSearch->loadDefault(); // Clear filter
		$this->LocalAuthority->AdvancedSearch->save();

		// Field PayrollPeriod
		if (!$this->PayrollPeriod->AdvancedSearch->getFromArray($filter))
			$this->PayrollPeriod->AdvancedSearch->loadDefault(); // Clear filter
		$this->PayrollPeriod->AdvancedSearch->save();

		// Field Surname
		if (!$this->Surname->AdvancedSearch->getFromArray($filter))
			$this->Surname->AdvancedSearch->loadDefault(); // Clear filter
		$this->Surname->AdvancedSearch->save();

		// Field FirstName
		if (!$this->FirstName->AdvancedSearch->getFromArray($filter))
			$this->FirstName->AdvancedSearch->loadDefault(); // Clear filter
		$this->FirstName->AdvancedSearch->save();

		// Field PositionName
		if (!$this->PositionName->AdvancedSearch->getFromArray($filter))
			$this->PositionName->AdvancedSearch->loadDefault(); // Clear filter
		$this->PositionName->AdvancedSearch->save();

		// Field pCode
		if (!$this->pCode->AdvancedSearch->getFromArray($filter))
			$this->pCode->AdvancedSearch->loadDefault(); // Clear filter
		$this->pCode->AdvancedSearch->save();

		// Field ThirdPartyPayMethod
		if (!$this->ThirdPartyPayMethod->AdvancedSearch->getFromArray($filter))
			$this->ThirdPartyPayMethod->AdvancedSearch->loadDefault(); // Clear filter
		$this->ThirdPartyPayMethod->AdvancedSearch->save();

		// Field ThirdPartyBank
		if (!$this->ThirdPartyBank->AdvancedSearch->getFromArray($filter))
			$this->ThirdPartyBank->AdvancedSearch->loadDefault(); // Clear filter
		$this->ThirdPartyBank->AdvancedSearch->save();
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