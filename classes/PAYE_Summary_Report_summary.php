<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class PAYE_Summary_Report_summary extends PAYE_Summary_Report
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'PAYE Summary Report';

	// Page object name
	public $PageObjName = "PAYE_Summary_Report_summary";

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

		// Table object (PAYE_Summary_Report)
		if (!isset($GLOBALS["PAYE_Summary_Report"]) || get_class($GLOBALS["PAYE_Summary_Report"]) == PROJECT_NAMESPACE . "PAYE_Summary_Report") {
			$GLOBALS["PAYE_Summary_Report"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["PAYE_Summary_Report"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'PAYE Summary Report');

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
		$this->EmployeeID->setVisibility();
		$this->EmployeeNames->setVisibility();
		$this->EmploymentTypeDesc->setVisibility();
		$this->NRC->setVisibility();
		$this->GrossIncome->setVisibility();
		$this->TaxableIncome->setVisibility();
		$this->PAYE->setVisibility();
		$this->TaxCredit->setVisibility();
		$this->Adjustment->setVisibility();

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
			$data["DepartmentName"] = $record['DepartmentName'];
			$data["SectionName"] = $record['SectionName'];
			$data["EmployeeID"] = $record['EmployeeID'];
			$data["EmploymentTypeDesc"] = $record['EmploymentTypeDesc'];
			$data["NRC"] = $record['NRC'];
			$data["Year"] = $record['Year'];
			$data["MonthShort"] = $record['MonthShort'];
			$data["PayrollPeriod"] = $record['PayrollPeriod'];
			$data["GrossIncome"] = $record['GrossIncome'];
			$data["TaxableIncome"] = $record['TaxableIncome'];
			$data["PAYE"] = $record['PAYE'];
			$data["TaxCredit"] = $record['TaxCredit'];
			$data["Adjustment"] = $record['Adjustment'];
			$this->Rows[] = $data;
		}
		$this->LocalAuthority->setDbValue(GroupValue($this->LocalAuthority, $record['LocalAuthority']));
		$this->DepartmentName->setDbValue($record['DepartmentName']);
		$this->SectionName->setDbValue($record['SectionName']);
		$this->EmployeeID->setDbValue($record['EmployeeID']);
		$this->EmployeeNames->setDbValue($record['EmployeeNames']);
		$this->EmploymentTypeDesc->setDbValue($record['EmploymentTypeDesc']);
		$this->NRC->setDbValue($record['NRC']);
		$this->Year->setDbValue($record['Year']);
		$this->MonthShort->setDbValue($record['MonthShort']);
		$this->PayrollPeriod->setDbValue($record['PayrollPeriod']);
		$this->GrossIncome->setDbValue($record['GrossIncome']);
		$this->TaxableIncome->setDbValue($record['TaxableIncome']);
		$this->PAYE->setDbValue($record['PAYE']);
		$this->TaxCredit->setDbValue($record['TaxCredit']);
		$this->Adjustment->setDbValue($record['Adjustment']);
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
			$this->GrossIncome->getSum($records);
			$this->TaxableIncome->getSum($records);
			$this->PAYE->getSum($records);
			$this->TaxCredit->getSum($records);
			$this->Adjustment->getSum($records);
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
				$this->EmployeeID->Count = $this->TotalCount;
				$this->EmployeeNames->Count = $this->TotalCount;
				$this->EmploymentTypeDesc->Count = $this->TotalCount;
				$this->NRC->Count = $this->TotalCount;
				$this->GrossIncome->Count = $this->TotalCount;
				$this->GrossIncome->SumValue = $rsagg->fields("sum_grossincome");
				$this->TaxableIncome->Count = $this->TotalCount;
				$this->TaxableIncome->SumValue = $rsagg->fields("sum_taxableincome");
				$this->PAYE->Count = $this->TotalCount;
				$this->PAYE->SumValue = $rsagg->fields("sum_paye");
				$this->TaxCredit->Count = $this->TotalCount;
				$this->TaxCredit->SumValue = $rsagg->fields("sum_taxcredit");
				$this->Adjustment->Count = $this->TotalCount;
				$this->Adjustment->SumValue = $rsagg->fields("sum_adjustment");
				$rsagg->close();
				$hasSummary = TRUE;
			}

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			$this->GrossIncome->getSum($this->DetailRecords);
			$this->TaxableIncome->getSum($this->DetailRecords);
			$this->PAYE->getSum($this->DetailRecords);
			$this->TaxCredit->getSum($this->DetailRecords);
			$this->Adjustment->getSum($this->DetailRecords);
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// LocalAuthority
		// DepartmentName
		// SectionName
		// Year
		// MonthShort
		// EmployeeID
		// EmployeeNames
		// EmploymentTypeDesc
		// NRC
		// GrossIncome
		// TaxableIncome
		// PAYE
		// TaxCredit
		// Adjustment

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->LocalAuthority->groupValue(); // Set up group attribute
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 2)
				$this->RowAttrs["data-group-2"] = $this->DepartmentName->groupValue(); // Set up group attribute 2
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 3)
				$this->RowAttrs["data-group-3"] = $this->SectionName->groupValue(); // Set up group attribute 3
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 4)
				$this->RowAttrs["data-group-4"] = $this->Year->groupValue(); // Set up group attribute 4
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowGroupLevel >= 5)
				$this->RowAttrs["data-group-5"] = $this->MonthShort->groupValue(); // Set up group attribute 5

			// LocalAuthority
			$this->LocalAuthority->GroupViewValue = $this->LocalAuthority->groupValue();
			$this->LocalAuthority->CellCssClass = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->LocalAuthority->ViewCustomAttributes = "";
			$this->LocalAuthority->GroupViewValue = DisplayGroupValue($this->LocalAuthority, $this->LocalAuthority->GroupViewValue);

			// DepartmentName
			$this->DepartmentName->GroupViewValue = $this->DepartmentName->groupValue();
			$this->DepartmentName->CellCssClass = ($this->RowGroupLevel == 2 ? "ew-rpt-grp-summary-2" : "ew-rpt-grp-field-2");
			$this->DepartmentName->ViewCustomAttributes = "";
			$this->DepartmentName->GroupViewValue = DisplayGroupValue($this->DepartmentName, $this->DepartmentName->GroupViewValue);

			// SectionName
			$this->SectionName->GroupViewValue = $this->SectionName->groupValue();
			$this->SectionName->CellCssClass = ($this->RowGroupLevel == 3 ? "ew-rpt-grp-summary-3" : "ew-rpt-grp-field-3");
			$this->SectionName->ViewCustomAttributes = "";
			$this->SectionName->GroupViewValue = DisplayGroupValue($this->SectionName, $this->SectionName->GroupViewValue);

			// Year
			$this->Year->GroupViewValue = $this->Year->groupValue();
			$this->Year->CellCssClass = ($this->RowGroupLevel == 4 ? "ew-rpt-grp-summary-4" : "ew-rpt-grp-field-4");
			$this->Year->ViewCustomAttributes = "";
			$this->Year->GroupViewValue = DisplayGroupValue($this->Year, $this->Year->GroupViewValue);

			// MonthShort
			$this->MonthShort->GroupViewValue = $this->MonthShort->groupValue();
			$this->MonthShort->CellCssClass = ($this->RowGroupLevel == 5 ? "ew-rpt-grp-summary-5" : "ew-rpt-grp-field-5");
			$this->MonthShort->ViewCustomAttributes = "";
			$this->MonthShort->GroupViewValue = DisplayGroupValue($this->MonthShort, $this->MonthShort->GroupViewValue);

			// GrossIncome
			$this->GrossIncome->SumViewValue = $this->GrossIncome->SumValue;
			$this->GrossIncome->SumViewValue = FormatNumber($this->GrossIncome->SumViewValue, 2, -2, -2, -2);
			$this->GrossIncome->CellCssStyle .= "text-align: right;";
			$this->GrossIncome->ViewCustomAttributes = "";
			$this->GrossIncome->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// TaxableIncome
			$this->TaxableIncome->SumViewValue = $this->TaxableIncome->SumValue;
			$this->TaxableIncome->SumViewValue = FormatNumber($this->TaxableIncome->SumViewValue, 2, -2, -2, -2);
			$this->TaxableIncome->CellCssStyle .= "text-align: right;";
			$this->TaxableIncome->ViewCustomAttributes = "";
			$this->TaxableIncome->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// PAYE
			$this->PAYE->SumViewValue = $this->PAYE->SumValue;
			$this->PAYE->SumViewValue = FormatNumber($this->PAYE->SumViewValue, 2, -2, -2, -2);
			$this->PAYE->CellCssStyle .= "text-align: right;";
			$this->PAYE->ViewCustomAttributes = "";
			$this->PAYE->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// TaxCredit
			$this->TaxCredit->SumViewValue = $this->TaxCredit->SumValue;
			$this->TaxCredit->SumViewValue = FormatNumber($this->TaxCredit->SumViewValue, 2, -2, -2, -2);
			$this->TaxCredit->CellCssStyle .= "text-align: right;";
			$this->TaxCredit->ViewCustomAttributes = "";
			$this->TaxCredit->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// Adjustment
			$this->Adjustment->SumViewValue = $this->Adjustment->SumValue;
			$this->Adjustment->SumViewValue = FormatNumber($this->Adjustment->SumViewValue, 0, -2, -2, -2);
			$this->Adjustment->ViewCustomAttributes = "";
			$this->Adjustment->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// LocalAuthority
			$this->LocalAuthority->HrefValue = "";

			// DepartmentName
			$this->DepartmentName->HrefValue = "";

			// SectionName
			$this->SectionName->HrefValue = "";

			// Year
			$this->Year->HrefValue = "";

			// MonthShort
			$this->MonthShort->HrefValue = "";

			// EmployeeID
			$this->EmployeeID->HrefValue = "";

			// EmployeeNames
			$this->EmployeeNames->HrefValue = "";

			// EmploymentTypeDesc
			$this->EmploymentTypeDesc->HrefValue = "";

			// NRC
			$this->NRC->HrefValue = "";

			// GrossIncome
			$this->GrossIncome->HrefValue = "";

			// TaxableIncome
			$this->TaxableIncome->HrefValue = "";

			// PAYE
			$this->PAYE->HrefValue = "";

			// TaxCredit
			$this->TaxCredit->HrefValue = "";

			// Adjustment
			$this->Adjustment->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->LocalAuthority->groupValue(); // Set up group attribute
			if ($this->RowGroupLevel >= 2) $this->RowAttrs["data-group-2"] = $this->DepartmentName->groupValue(); // Set up group attribute 2
			if ($this->RowGroupLevel >= 3) $this->RowAttrs["data-group-3"] = $this->SectionName->groupValue(); // Set up group attribute 3
			if ($this->RowGroupLevel >= 4) $this->RowAttrs["data-group-4"] = $this->Year->groupValue(); // Set up group attribute 4
			if ($this->RowGroupLevel >= 5) $this->RowAttrs["data-group-5"] = $this->MonthShort->groupValue(); // Set up group attribute 5
			} else {
			$this->RowAttrs["data-group"] = $this->LocalAuthority->groupValue(); // Set up group attribute
			$this->RowAttrs["data-group-2"] = $this->DepartmentName->groupValue(); // Set up group attribute 2
			$this->RowAttrs["data-group-3"] = $this->SectionName->groupValue(); // Set up group attribute 3
			$this->RowAttrs["data-group-4"] = $this->Year->groupValue(); // Set up group attribute 4
			$this->RowAttrs["data-group-5"] = $this->MonthShort->groupValue(); // Set up group attribute 5
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

			// DepartmentName
			$this->DepartmentName->GroupViewValue = $this->DepartmentName->groupValue();
			$this->DepartmentName->CellCssClass = "ew-rpt-grp-field-2";
			$this->DepartmentName->ViewCustomAttributes = "";
			$this->DepartmentName->GroupViewValue = DisplayGroupValue($this->DepartmentName, $this->DepartmentName->GroupViewValue);
			if (!$this->DepartmentName->LevelBreak)
				$this->DepartmentName->GroupViewValue = "&nbsp;";
			else
				$this->DepartmentName->LevelBreak = FALSE;

			// SectionName
			$this->SectionName->GroupViewValue = $this->SectionName->groupValue();
			$this->SectionName->CellCssClass = "ew-rpt-grp-field-3";
			$this->SectionName->ViewCustomAttributes = "";
			$this->SectionName->GroupViewValue = DisplayGroupValue($this->SectionName, $this->SectionName->GroupViewValue);
			if (!$this->SectionName->LevelBreak)
				$this->SectionName->GroupViewValue = "&nbsp;";
			else
				$this->SectionName->LevelBreak = FALSE;

			// Year
			$this->Year->GroupViewValue = $this->Year->groupValue();
			$this->Year->CellCssClass = "ew-rpt-grp-field-4";
			$this->Year->ViewCustomAttributes = "";
			$this->Year->GroupViewValue = DisplayGroupValue($this->Year, $this->Year->GroupViewValue);
			if (!$this->Year->LevelBreak)
				$this->Year->GroupViewValue = "&nbsp;";
			else
				$this->Year->LevelBreak = FALSE;

			// MonthShort
			$this->MonthShort->GroupViewValue = $this->MonthShort->groupValue();
			$this->MonthShort->CellCssClass = "ew-rpt-grp-field-5";
			$this->MonthShort->ViewCustomAttributes = "";
			$this->MonthShort->GroupViewValue = DisplayGroupValue($this->MonthShort, $this->MonthShort->GroupViewValue);
			if (!$this->MonthShort->LevelBreak)
				$this->MonthShort->GroupViewValue = "&nbsp;";
			else
				$this->MonthShort->LevelBreak = FALSE;

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->EmployeeID->ViewCustomAttributes = "";

			// EmployeeNames
			$this->EmployeeNames->ViewValue = $this->EmployeeNames->CurrentValue;
			$this->EmployeeNames->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->EmployeeNames->ViewCustomAttributes = "";

			// EmploymentTypeDesc
			$this->EmploymentTypeDesc->ViewValue = $this->EmploymentTypeDesc->CurrentValue;
			$this->EmploymentTypeDesc->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->EmploymentTypeDesc->ViewCustomAttributes = "";

			// NRC
			$this->NRC->ViewValue = $this->NRC->CurrentValue;
			$this->NRC->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->NRC->ViewCustomAttributes = "";

			// GrossIncome
			$this->GrossIncome->ViewValue = $this->GrossIncome->CurrentValue;
			$this->GrossIncome->ViewValue = FormatNumber($this->GrossIncome->ViewValue, 2, -2, -2, -2);
			$this->GrossIncome->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->GrossIncome->CellCssStyle .= "text-align: right;";
			$this->GrossIncome->ViewCustomAttributes = "";

			// TaxableIncome
			$this->TaxableIncome->ViewValue = $this->TaxableIncome->CurrentValue;
			$this->TaxableIncome->ViewValue = FormatNumber($this->TaxableIncome->ViewValue, 2, -2, -2, -2);
			$this->TaxableIncome->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->TaxableIncome->CellCssStyle .= "text-align: right;";
			$this->TaxableIncome->ViewCustomAttributes = "";

			// PAYE
			$this->PAYE->ViewValue = $this->PAYE->CurrentValue;
			$this->PAYE->ViewValue = FormatNumber($this->PAYE->ViewValue, 2, -2, -2, -2);
			$this->PAYE->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->PAYE->CellCssStyle .= "text-align: right;";
			$this->PAYE->ViewCustomAttributes = "";

			// TaxCredit
			$this->TaxCredit->ViewValue = $this->TaxCredit->CurrentValue;
			$this->TaxCredit->ViewValue = FormatNumber($this->TaxCredit->ViewValue, 2, -2, -2, -2);
			$this->TaxCredit->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->TaxCredit->CellCssStyle .= "text-align: right;";
			$this->TaxCredit->ViewCustomAttributes = "";

			// Adjustment
			$this->Adjustment->ViewValue = $this->Adjustment->CurrentValue;
			$this->Adjustment->ViewValue = FormatNumber($this->Adjustment->ViewValue, 0, -2, -2, -2);
			$this->Adjustment->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->Adjustment->ViewCustomAttributes = "";

			// LocalAuthority
			$this->LocalAuthority->LinkCustomAttributes = "";
			$this->LocalAuthority->HrefValue = "";
			$this->LocalAuthority->TooltipValue = "";

			// DepartmentName
			$this->DepartmentName->LinkCustomAttributes = "";
			$this->DepartmentName->HrefValue = "";
			$this->DepartmentName->TooltipValue = "";

			// SectionName
			$this->SectionName->LinkCustomAttributes = "";
			$this->SectionName->HrefValue = "";
			$this->SectionName->TooltipValue = "";

			// Year
			$this->Year->LinkCustomAttributes = "";
			$this->Year->HrefValue = "";
			$this->Year->TooltipValue = "";

			// MonthShort
			$this->MonthShort->LinkCustomAttributes = "";
			$this->MonthShort->HrefValue = "";
			$this->MonthShort->TooltipValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// EmployeeNames
			$this->EmployeeNames->LinkCustomAttributes = "";
			$this->EmployeeNames->HrefValue = "";
			$this->EmployeeNames->TooltipValue = "";

			// EmploymentTypeDesc
			$this->EmploymentTypeDesc->LinkCustomAttributes = "";
			$this->EmploymentTypeDesc->HrefValue = "";
			$this->EmploymentTypeDesc->TooltipValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";
			$this->NRC->TooltipValue = "";

			// GrossIncome
			$this->GrossIncome->LinkCustomAttributes = "";
			$this->GrossIncome->HrefValue = "";
			$this->GrossIncome->TooltipValue = "";

			// TaxableIncome
			$this->TaxableIncome->LinkCustomAttributes = "";
			$this->TaxableIncome->HrefValue = "";
			$this->TaxableIncome->TooltipValue = "";

			// PAYE
			$this->PAYE->LinkCustomAttributes = "";
			$this->PAYE->HrefValue = "";
			$this->PAYE->TooltipValue = "";

			// TaxCredit
			$this->TaxCredit->LinkCustomAttributes = "";
			$this->TaxCredit->HrefValue = "";
			$this->TaxCredit->TooltipValue = "";

			// Adjustment
			$this->Adjustment->LinkCustomAttributes = "";
			$this->Adjustment->HrefValue = "";
			$this->Adjustment->TooltipValue = "";
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

			// DepartmentName
			$currentValue = $this->DepartmentName->GroupViewValue;
			$viewValue = &$this->DepartmentName->GroupViewValue;
			$viewAttrs = &$this->DepartmentName->ViewAttrs;
			$cellAttrs = &$this->DepartmentName->CellAttrs;
			$hrefValue = &$this->DepartmentName->HrefValue;
			$linkAttrs = &$this->DepartmentName->LinkAttrs;
			$this->Cell_Rendered($this->DepartmentName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SectionName
			$currentValue = $this->SectionName->GroupViewValue;
			$viewValue = &$this->SectionName->GroupViewValue;
			$viewAttrs = &$this->SectionName->ViewAttrs;
			$cellAttrs = &$this->SectionName->CellAttrs;
			$hrefValue = &$this->SectionName->HrefValue;
			$linkAttrs = &$this->SectionName->LinkAttrs;
			$this->Cell_Rendered($this->SectionName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Year
			$currentValue = $this->Year->GroupViewValue;
			$viewValue = &$this->Year->GroupViewValue;
			$viewAttrs = &$this->Year->ViewAttrs;
			$cellAttrs = &$this->Year->CellAttrs;
			$hrefValue = &$this->Year->HrefValue;
			$linkAttrs = &$this->Year->LinkAttrs;
			$this->Cell_Rendered($this->Year, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MonthShort
			$currentValue = $this->MonthShort->GroupViewValue;
			$viewValue = &$this->MonthShort->GroupViewValue;
			$viewAttrs = &$this->MonthShort->ViewAttrs;
			$cellAttrs = &$this->MonthShort->CellAttrs;
			$hrefValue = &$this->MonthShort->HrefValue;
			$linkAttrs = &$this->MonthShort->LinkAttrs;
			$this->Cell_Rendered($this->MonthShort, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// GrossIncome
			$currentValue = $this->GrossIncome->SumValue;
			$viewValue = &$this->GrossIncome->SumViewValue;
			$viewAttrs = &$this->GrossIncome->ViewAttrs;
			$cellAttrs = &$this->GrossIncome->CellAttrs;
			$hrefValue = &$this->GrossIncome->HrefValue;
			$linkAttrs = &$this->GrossIncome->LinkAttrs;
			$this->Cell_Rendered($this->GrossIncome, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// TaxableIncome
			$currentValue = $this->TaxableIncome->SumValue;
			$viewValue = &$this->TaxableIncome->SumViewValue;
			$viewAttrs = &$this->TaxableIncome->ViewAttrs;
			$cellAttrs = &$this->TaxableIncome->CellAttrs;
			$hrefValue = &$this->TaxableIncome->HrefValue;
			$linkAttrs = &$this->TaxableIncome->LinkAttrs;
			$this->Cell_Rendered($this->TaxableIncome, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PAYE
			$currentValue = $this->PAYE->SumValue;
			$viewValue = &$this->PAYE->SumViewValue;
			$viewAttrs = &$this->PAYE->ViewAttrs;
			$cellAttrs = &$this->PAYE->CellAttrs;
			$hrefValue = &$this->PAYE->HrefValue;
			$linkAttrs = &$this->PAYE->LinkAttrs;
			$this->Cell_Rendered($this->PAYE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// TaxCredit
			$currentValue = $this->TaxCredit->SumValue;
			$viewValue = &$this->TaxCredit->SumViewValue;
			$viewAttrs = &$this->TaxCredit->ViewAttrs;
			$cellAttrs = &$this->TaxCredit->CellAttrs;
			$hrefValue = &$this->TaxCredit->HrefValue;
			$linkAttrs = &$this->TaxCredit->LinkAttrs;
			$this->Cell_Rendered($this->TaxCredit, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Adjustment
			$currentValue = $this->Adjustment->SumValue;
			$viewValue = &$this->Adjustment->SumViewValue;
			$viewAttrs = &$this->Adjustment->ViewAttrs;
			$cellAttrs = &$this->Adjustment->CellAttrs;
			$hrefValue = &$this->Adjustment->HrefValue;
			$linkAttrs = &$this->Adjustment->LinkAttrs;
			$this->Cell_Rendered($this->Adjustment, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// LocalAuthority
			$currentValue = $this->LocalAuthority->groupValue();
			$viewValue = &$this->LocalAuthority->GroupViewValue;
			$viewAttrs = &$this->LocalAuthority->ViewAttrs;
			$cellAttrs = &$this->LocalAuthority->CellAttrs;
			$hrefValue = &$this->LocalAuthority->HrefValue;
			$linkAttrs = &$this->LocalAuthority->LinkAttrs;
			$this->Cell_Rendered($this->LocalAuthority, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// DepartmentName
			$currentValue = $this->DepartmentName->groupValue();
			$viewValue = &$this->DepartmentName->GroupViewValue;
			$viewAttrs = &$this->DepartmentName->ViewAttrs;
			$cellAttrs = &$this->DepartmentName->CellAttrs;
			$hrefValue = &$this->DepartmentName->HrefValue;
			$linkAttrs = &$this->DepartmentName->LinkAttrs;
			$this->Cell_Rendered($this->DepartmentName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// SectionName
			$currentValue = $this->SectionName->groupValue();
			$viewValue = &$this->SectionName->GroupViewValue;
			$viewAttrs = &$this->SectionName->ViewAttrs;
			$cellAttrs = &$this->SectionName->CellAttrs;
			$hrefValue = &$this->SectionName->HrefValue;
			$linkAttrs = &$this->SectionName->LinkAttrs;
			$this->Cell_Rendered($this->SectionName, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Year
			$currentValue = $this->Year->groupValue();
			$viewValue = &$this->Year->GroupViewValue;
			$viewAttrs = &$this->Year->ViewAttrs;
			$cellAttrs = &$this->Year->CellAttrs;
			$hrefValue = &$this->Year->HrefValue;
			$linkAttrs = &$this->Year->LinkAttrs;
			$this->Cell_Rendered($this->Year, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// MonthShort
			$currentValue = $this->MonthShort->groupValue();
			$viewValue = &$this->MonthShort->GroupViewValue;
			$viewAttrs = &$this->MonthShort->ViewAttrs;
			$cellAttrs = &$this->MonthShort->CellAttrs;
			$hrefValue = &$this->MonthShort->HrefValue;
			$linkAttrs = &$this->MonthShort->LinkAttrs;
			$this->Cell_Rendered($this->MonthShort, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// EmployeeID
			$currentValue = $this->EmployeeID->CurrentValue;
			$viewValue = &$this->EmployeeID->ViewValue;
			$viewAttrs = &$this->EmployeeID->ViewAttrs;
			$cellAttrs = &$this->EmployeeID->CellAttrs;
			$hrefValue = &$this->EmployeeID->HrefValue;
			$linkAttrs = &$this->EmployeeID->LinkAttrs;
			$this->Cell_Rendered($this->EmployeeID, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// EmployeeNames
			$currentValue = $this->EmployeeNames->CurrentValue;
			$viewValue = &$this->EmployeeNames->ViewValue;
			$viewAttrs = &$this->EmployeeNames->ViewAttrs;
			$cellAttrs = &$this->EmployeeNames->CellAttrs;
			$hrefValue = &$this->EmployeeNames->HrefValue;
			$linkAttrs = &$this->EmployeeNames->LinkAttrs;
			$this->Cell_Rendered($this->EmployeeNames, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// EmploymentTypeDesc
			$currentValue = $this->EmploymentTypeDesc->CurrentValue;
			$viewValue = &$this->EmploymentTypeDesc->ViewValue;
			$viewAttrs = &$this->EmploymentTypeDesc->ViewAttrs;
			$cellAttrs = &$this->EmploymentTypeDesc->CellAttrs;
			$hrefValue = &$this->EmploymentTypeDesc->HrefValue;
			$linkAttrs = &$this->EmploymentTypeDesc->LinkAttrs;
			$this->Cell_Rendered($this->EmploymentTypeDesc, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// NRC
			$currentValue = $this->NRC->CurrentValue;
			$viewValue = &$this->NRC->ViewValue;
			$viewAttrs = &$this->NRC->ViewAttrs;
			$cellAttrs = &$this->NRC->CellAttrs;
			$hrefValue = &$this->NRC->HrefValue;
			$linkAttrs = &$this->NRC->LinkAttrs;
			$this->Cell_Rendered($this->NRC, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// GrossIncome
			$currentValue = $this->GrossIncome->CurrentValue;
			$viewValue = &$this->GrossIncome->ViewValue;
			$viewAttrs = &$this->GrossIncome->ViewAttrs;
			$cellAttrs = &$this->GrossIncome->CellAttrs;
			$hrefValue = &$this->GrossIncome->HrefValue;
			$linkAttrs = &$this->GrossIncome->LinkAttrs;
			$this->Cell_Rendered($this->GrossIncome, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// TaxableIncome
			$currentValue = $this->TaxableIncome->CurrentValue;
			$viewValue = &$this->TaxableIncome->ViewValue;
			$viewAttrs = &$this->TaxableIncome->ViewAttrs;
			$cellAttrs = &$this->TaxableIncome->CellAttrs;
			$hrefValue = &$this->TaxableIncome->HrefValue;
			$linkAttrs = &$this->TaxableIncome->LinkAttrs;
			$this->Cell_Rendered($this->TaxableIncome, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// PAYE
			$currentValue = $this->PAYE->CurrentValue;
			$viewValue = &$this->PAYE->ViewValue;
			$viewAttrs = &$this->PAYE->ViewAttrs;
			$cellAttrs = &$this->PAYE->CellAttrs;
			$hrefValue = &$this->PAYE->HrefValue;
			$linkAttrs = &$this->PAYE->LinkAttrs;
			$this->Cell_Rendered($this->PAYE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// TaxCredit
			$currentValue = $this->TaxCredit->CurrentValue;
			$viewValue = &$this->TaxCredit->ViewValue;
			$viewAttrs = &$this->TaxCredit->ViewAttrs;
			$cellAttrs = &$this->TaxCredit->CellAttrs;
			$hrefValue = &$this->TaxCredit->HrefValue;
			$linkAttrs = &$this->TaxCredit->LinkAttrs;
			$this->Cell_Rendered($this->TaxCredit, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// Adjustment
			$currentValue = $this->Adjustment->CurrentValue;
			$viewValue = &$this->Adjustment->ViewValue;
			$viewAttrs = &$this->Adjustment->ViewAttrs;
			$cellAttrs = &$this->Adjustment->CellAttrs;
			$hrefValue = &$this->Adjustment->HrefValue;
			$linkAttrs = &$this->Adjustment->LinkAttrs;
			$this->Cell_Rendered($this->Adjustment, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
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
		if ($this->DepartmentName->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->SectionName->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->Year->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->MonthShort->Visible) {
			$this->GroupColumnCount += 1;
			$this->SubGroupColumnCount += 1;
		}
		if ($this->EmployeeID->Visible)
			$this->DetailColumnCount += 1;
		if ($this->EmployeeNames->Visible)
			$this->DetailColumnCount += 1;
		if ($this->EmploymentTypeDesc->Visible)
			$this->DetailColumnCount += 1;
		if ($this->NRC->Visible)
			$this->DetailColumnCount += 1;
		if ($this->GrossIncome->Visible)
			$this->DetailColumnCount += 1;
		if ($this->TaxableIncome->Visible)
			$this->DetailColumnCount += 1;
		if ($this->PAYE->Visible)
			$this->DetailColumnCount += 1;
		if ($this->TaxCredit->Visible)
			$this->DetailColumnCount += 1;
		if ($this->Adjustment->Visible)
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
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_PAYE_Summary_Report" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_PAYE_Summary_Report\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
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
			$this->LocalAuthority->setSort("");
			$this->DepartmentName->setSort("");
			$this->SectionName->setSort("");
			$this->EmployeeID->setSort("");
			$this->EmployeeNames->setSort("");
			$this->EmploymentTypeDesc->setSort("");
			$this->NRC->setSort("");
			$this->Year->setSort("");
			$this->MonthShort->setSort("");
			$this->GrossIncome->setSort("");
			$this->TaxableIncome->setSort("");
			$this->PAYE->setSort("");
			$this->TaxCredit->setSort("");
			$this->Adjustment->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->LocalAuthority); // LocalAuthority
			$this->updateSort($this->DepartmentName); // DepartmentName
			$this->updateSort($this->SectionName); // SectionName
			$this->updateSort($this->EmployeeID); // EmployeeID
			$this->updateSort($this->EmployeeNames); // EmployeeNames
			$this->updateSort($this->EmploymentTypeDesc); // EmploymentTypeDesc
			$this->updateSort($this->NRC); // NRC
			$this->updateSort($this->Year); // Year
			$this->updateSort($this->MonthShort); // MonthShort
			$this->updateSort($this->GrossIncome); // GrossIncome
			$this->updateSort($this->TaxableIncome); // TaxableIncome
			$this->updateSort($this->PAYE); // PAYE
			$this->updateSort($this->TaxCredit); // TaxCredit
			$this->updateSort($this->Adjustment); // Adjustment
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