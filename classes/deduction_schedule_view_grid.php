<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class deduction_schedule_view_grid extends deduction_schedule_view
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'deduction_schedule_view';

	// Page object name
	public $PageObjName = "deduction_schedule_view_grid";

	// Grid form hidden field names
	public $FormName = "fdeduction_schedule_viewgrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

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
		if ($this->TableName)
			return $Language->phrase($this->PageID);
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
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
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
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (deduction_schedule_view)
		if (!isset($GLOBALS["deduction_schedule_view"]) || get_class($GLOBALS["deduction_schedule_view"]) == PROJECT_NAMESPACE . "deduction_schedule_view") {
			$GLOBALS["deduction_schedule_view"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["deduction_schedule_view"];

		}
		$this->AddUrl = "deduction_schedule_viewadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'deduction_schedule_view');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $deduction_schedule_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($deduction_schedule_view);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['EmployeeID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAddOrEdit())
			$this->PeriodCode->Visible = FALSE;
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = ""; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->EmployeeID->setVisibility();
		$this->PayrollDate->setVisibility();
		$this->LAName->setVisibility();
		$this->DeductionName->setVisibility();
		$this->DeductionAmount->setVisibility();
		$this->PayrollRun->Visible = FALSE;
		$this->NRC->setVisibility();
		$this->Surname->setVisibility();
		$this->MiddleName->setVisibility();
		$this->FirstName->setVisibility();
		$this->PositionName->setVisibility();
		$this->PeriodCode->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->PeriodCode);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "payroll_period") {
			global $payroll_period;
			$rsmaster = $payroll_period->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("payroll_periodlist.php"); // Return to master page
			} else {
				$payroll_period->loadListRowValues($rsmaster);
				$payroll_period->RowType = ROWTYPE_MASTER; // Master row
				$payroll_period->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->DeductionAmount->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->EmployeeID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->EmployeeID->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->EmployeeID->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_EmployeeID") && $CurrentForm->hasValue("o_EmployeeID") && $this->EmployeeID->CurrentValue != $this->EmployeeID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PayrollDate") && $CurrentForm->hasValue("o_PayrollDate") && $this->PayrollDate->CurrentValue != $this->PayrollDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LAName") && $CurrentForm->hasValue("o_LAName") && $this->LAName->CurrentValue != $this->LAName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeductionName") && $CurrentForm->hasValue("o_DeductionName") && $this->DeductionName->CurrentValue != $this->DeductionName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeductionAmount") && $CurrentForm->hasValue("o_DeductionAmount") && $this->DeductionAmount->CurrentValue != $this->DeductionAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NRC") && $CurrentForm->hasValue("o_NRC") && $this->NRC->CurrentValue != $this->NRC->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Surname") && $CurrentForm->hasValue("o_Surname") && $this->Surname->CurrentValue != $this->Surname->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MiddleName") && $CurrentForm->hasValue("o_MiddleName") && $this->MiddleName->CurrentValue != $this->MiddleName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FirstName") && $CurrentForm->hasValue("o_FirstName") && $this->FirstName->CurrentValue != $this->FirstName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PositionName") && $CurrentForm->hasValue("o_PositionName") && $this->PositionName->CurrentValue != $this->PositionName->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->PeriodCode->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($this->CurrentMode == "view") { // View mode
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->EmployeeID->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('EmployeeID');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = FALSE;
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}

// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->PayrollDate->CurrentValue = "0000-00-00 00:00:00";
		$this->PayrollDate->OldValue = $this->PayrollDate->CurrentValue;
		$this->LAName->CurrentValue = NULL;
		$this->LAName->OldValue = $this->LAName->CurrentValue;
		$this->DeductionName->CurrentValue = NULL;
		$this->DeductionName->OldValue = $this->DeductionName->CurrentValue;
		$this->DeductionAmount->CurrentValue = 0;
		$this->DeductionAmount->OldValue = $this->DeductionAmount->CurrentValue;
		$this->PayrollRun->CurrentValue = NULL;
		$this->PayrollRun->OldValue = $this->PayrollRun->CurrentValue;
		$this->NRC->CurrentValue = NULL;
		$this->NRC->OldValue = $this->NRC->CurrentValue;
		$this->Surname->CurrentValue = NULL;
		$this->Surname->OldValue = $this->Surname->CurrentValue;
		$this->MiddleName->CurrentValue = NULL;
		$this->MiddleName->OldValue = $this->MiddleName->CurrentValue;
		$this->FirstName->CurrentValue = NULL;
		$this->FirstName->OldValue = $this->FirstName->CurrentValue;
		$this->PositionName->CurrentValue = NULL;
		$this->PositionName->OldValue = $this->PositionName->CurrentValue;
		$this->PeriodCode->CurrentValue = NULL;
		$this->PeriodCode->OldValue = $this->PeriodCode->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmployeeID"))
			$this->EmployeeID->setOldValue($CurrentForm->getValue("o_EmployeeID"));

		// Check field name 'PayrollDate' first before field var 'x_PayrollDate'
		$val = $CurrentForm->hasValue("PayrollDate") ? $CurrentForm->getValue("PayrollDate") : $CurrentForm->getValue("x_PayrollDate");
		if (!$this->PayrollDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PayrollDate->Visible = FALSE; // Disable update for API request
			else
				$this->PayrollDate->setFormValue($val);
			$this->PayrollDate->CurrentValue = UnFormatDateTime($this->PayrollDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_PayrollDate"))
			$this->PayrollDate->setOldValue($CurrentForm->getValue("o_PayrollDate"));

		// Check field name 'LAName' first before field var 'x_LAName'
		$val = $CurrentForm->hasValue("LAName") ? $CurrentForm->getValue("LAName") : $CurrentForm->getValue("x_LAName");
		if (!$this->LAName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LAName->Visible = FALSE; // Disable update for API request
			else
				$this->LAName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LAName"))
			$this->LAName->setOldValue($CurrentForm->getValue("o_LAName"));

		// Check field name 'DeductionName' first before field var 'x_DeductionName'
		$val = $CurrentForm->hasValue("DeductionName") ? $CurrentForm->getValue("DeductionName") : $CurrentForm->getValue("x_DeductionName");
		if (!$this->DeductionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionName->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeductionName"))
			$this->DeductionName->setOldValue($CurrentForm->getValue("o_DeductionName"));

		// Check field name 'DeductionAmount' first before field var 'x_DeductionAmount'
		$val = $CurrentForm->hasValue("DeductionAmount") ? $CurrentForm->getValue("DeductionAmount") : $CurrentForm->getValue("x_DeductionAmount");
		if (!$this->DeductionAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionAmount->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeductionAmount"))
			$this->DeductionAmount->setOldValue($CurrentForm->getValue("o_DeductionAmount"));

		// Check field name 'NRC' first before field var 'x_NRC'
		$val = $CurrentForm->hasValue("NRC") ? $CurrentForm->getValue("NRC") : $CurrentForm->getValue("x_NRC");
		if (!$this->NRC->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NRC->Visible = FALSE; // Disable update for API request
			else
				$this->NRC->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NRC"))
			$this->NRC->setOldValue($CurrentForm->getValue("o_NRC"));

		// Check field name 'Surname' first before field var 'x_Surname'
		$val = $CurrentForm->hasValue("Surname") ? $CurrentForm->getValue("Surname") : $CurrentForm->getValue("x_Surname");
		if (!$this->Surname->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Surname->Visible = FALSE; // Disable update for API request
			else
				$this->Surname->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Surname"))
			$this->Surname->setOldValue($CurrentForm->getValue("o_Surname"));

		// Check field name 'MiddleName' first before field var 'x_MiddleName'
		$val = $CurrentForm->hasValue("MiddleName") ? $CurrentForm->getValue("MiddleName") : $CurrentForm->getValue("x_MiddleName");
		if (!$this->MiddleName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MiddleName->Visible = FALSE; // Disable update for API request
			else
				$this->MiddleName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MiddleName"))
			$this->MiddleName->setOldValue($CurrentForm->getValue("o_MiddleName"));

		// Check field name 'FirstName' first before field var 'x_FirstName'
		$val = $CurrentForm->hasValue("FirstName") ? $CurrentForm->getValue("FirstName") : $CurrentForm->getValue("x_FirstName");
		if (!$this->FirstName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FirstName->Visible = FALSE; // Disable update for API request
			else
				$this->FirstName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FirstName"))
			$this->FirstName->setOldValue($CurrentForm->getValue("o_FirstName"));

		// Check field name 'PositionName' first before field var 'x_PositionName'
		$val = $CurrentForm->hasValue("PositionName") ? $CurrentForm->getValue("PositionName") : $CurrentForm->getValue("x_PositionName");
		if (!$this->PositionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PositionName->Visible = FALSE; // Disable update for API request
			else
				$this->PositionName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PositionName"))
			$this->PositionName->setOldValue($CurrentForm->getValue("o_PositionName"));

		// Check field name 'PeriodCode' first before field var 'x_PeriodCode'
		$val = $CurrentForm->hasValue("PeriodCode") ? $CurrentForm->getValue("PeriodCode") : $CurrentForm->getValue("x_PeriodCode");
		if (!$this->PeriodCode->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->PeriodCode->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->PayrollDate->CurrentValue = $this->PayrollDate->FormValue;
		$this->PayrollDate->CurrentValue = UnFormatDateTime($this->PayrollDate->CurrentValue, 0);
		$this->LAName->CurrentValue = $this->LAName->FormValue;
		$this->DeductionName->CurrentValue = $this->DeductionName->FormValue;
		$this->DeductionAmount->CurrentValue = $this->DeductionAmount->FormValue;
		$this->NRC->CurrentValue = $this->NRC->FormValue;
		$this->Surname->CurrentValue = $this->Surname->FormValue;
		$this->MiddleName->CurrentValue = $this->MiddleName->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->PositionName->CurrentValue = $this->PositionName->FormValue;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->PeriodCode->CurrentValue = $this->PeriodCode->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->PayrollDate->setDbValue($row['PayrollDate']);
		$this->LAName->setDbValue($row['LAName']);
		$this->DeductionName->setDbValue($row['DeductionName']);
		$this->DeductionAmount->setDbValue($row['DeductionAmount']);
		$this->PayrollRun->setDbValue($row['PayrollRun']);
		$this->NRC->setDbValue($row['NRC']);
		$this->Surname->setDbValue($row['Surname']);
		$this->MiddleName->setDbValue($row['MiddleName']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->PositionName->setDbValue($row['PositionName']);
		$this->PeriodCode->setDbValue($row['PeriodCode']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['PayrollDate'] = $this->PayrollDate->CurrentValue;
		$row['LAName'] = $this->LAName->CurrentValue;
		$row['DeductionName'] = $this->DeductionName->CurrentValue;
		$row['DeductionAmount'] = $this->DeductionAmount->CurrentValue;
		$row['PayrollRun'] = $this->PayrollRun->CurrentValue;
		$row['NRC'] = $this->NRC->CurrentValue;
		$row['Surname'] = $this->Surname->CurrentValue;
		$row['MiddleName'] = $this->MiddleName->CurrentValue;
		$row['FirstName'] = $this->FirstName->CurrentValue;
		$row['PositionName'] = $this->PositionName->CurrentValue;
		$row['PeriodCode'] = $this->PeriodCode->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->EmployeeID->OldValue = strval($keys[0]); // EmployeeID
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->DeductionAmount->FormValue == $this->DeductionAmount->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionAmount->CurrentValue)))
			$this->DeductionAmount->CurrentValue = ConvertToFloatString($this->DeductionAmount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// PayrollDate
		// LAName
		// DeductionName
		// DeductionAmount
		// PayrollRun
		// NRC
		// Surname
		// MiddleName
		// FirstName
		// PositionName
		// PeriodCode

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// PayrollDate
			$this->PayrollDate->ViewValue = $this->PayrollDate->CurrentValue;
			$this->PayrollDate->ViewValue = FormatDateTime($this->PayrollDate->ViewValue, 0);
			$this->PayrollDate->ViewCustomAttributes = "";

			// LAName
			$this->LAName->ViewValue = $this->LAName->CurrentValue;
			$this->LAName->ViewCustomAttributes = "";

			// DeductionName
			$this->DeductionName->ViewValue = $this->DeductionName->CurrentValue;
			$this->DeductionName->ViewCustomAttributes = "";

			// DeductionAmount
			$this->DeductionAmount->ViewValue = $this->DeductionAmount->CurrentValue;
			$this->DeductionAmount->ViewValue = FormatNumber($this->DeductionAmount->ViewValue, 2, -2, -2, -2);
			$this->DeductionAmount->ViewCustomAttributes = "";

			// NRC
			$this->NRC->ViewValue = $this->NRC->CurrentValue;
			$this->NRC->ViewCustomAttributes = "";

			// Surname
			$this->Surname->ViewValue = $this->Surname->CurrentValue;
			$this->Surname->ViewCustomAttributes = "";

			// MiddleName
			$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
			$this->MiddleName->ViewCustomAttributes = "";

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->ViewCustomAttributes = "";

			// PositionName
			$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
			$this->PositionName->ViewCustomAttributes = "";

			// PeriodCode
			$curVal = strval($this->PeriodCode->CurrentValue);
			if ($curVal != "") {
				$this->PeriodCode->ViewValue = $this->PeriodCode->lookupCacheOption($curVal);
				if ($this->PeriodCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PeriodCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PeriodCode->ViewValue = $this->PeriodCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PeriodCode->ViewValue = $this->PeriodCode->CurrentValue;
					}
				}
			} else {
				$this->PeriodCode->ViewValue = NULL;
			}
			$this->PeriodCode->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";
			if (!$this->isExport())
				$this->EmployeeID->ViewValue = $this->highlightValue($this->EmployeeID);

			// PayrollDate
			$this->PayrollDate->LinkCustomAttributes = "";
			$this->PayrollDate->HrefValue = "";
			$this->PayrollDate->TooltipValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";
			$this->LAName->TooltipValue = "";
			if (!$this->isExport())
				$this->LAName->ViewValue = $this->highlightValue($this->LAName);

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";
			$this->DeductionName->TooltipValue = "";
			if (!$this->isExport())
				$this->DeductionName->ViewValue = $this->highlightValue($this->DeductionName);

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";
			$this->DeductionAmount->TooltipValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";
			$this->NRC->TooltipValue = "";
			if (!$this->isExport())
				$this->NRC->ViewValue = $this->highlightValue($this->NRC);

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";
			$this->Surname->TooltipValue = "";
			if (!$this->isExport())
				$this->Surname->ViewValue = $this->highlightValue($this->Surname);

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";
			$this->MiddleName->TooltipValue = "";
			if (!$this->isExport())
				$this->MiddleName->ViewValue = $this->highlightValue($this->MiddleName);

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";
			if (!$this->isExport())
				$this->FirstName->ViewValue = $this->highlightValue($this->FirstName);

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";
			$this->PositionName->TooltipValue = "";
			if (!$this->isExport())
				$this->PositionName->ViewValue = $this->highlightValue($this->PositionName);

			// PeriodCode
			$this->PeriodCode->LinkCustomAttributes = "";
			$this->PeriodCode->HrefValue = "";
			$this->PeriodCode->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// PayrollDate
			$this->PayrollDate->EditAttrs["class"] = "form-control";
			$this->PayrollDate->EditCustomAttributes = "";
			$this->PayrollDate->EditValue = HtmlEncode(FormatDateTime($this->PayrollDate->CurrentValue, 8));
			$this->PayrollDate->PlaceHolder = RemoveHtml($this->PayrollDate->caption());

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->CurrentValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// DeductionName
			$this->DeductionName->EditAttrs["class"] = "form-control";
			$this->DeductionName->EditCustomAttributes = "";
			if (!$this->DeductionName->Raw)
				$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
			$this->DeductionName->EditValue = HtmlEncode($this->DeductionName->CurrentValue);
			$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

			// DeductionAmount
			$this->DeductionAmount->EditAttrs["class"] = "form-control";
			$this->DeductionAmount->EditCustomAttributes = "";
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->CurrentValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
			if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue)) {
				$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
				$this->DeductionAmount->OldValue = $this->DeductionAmount->EditValue;
			}
			

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->CurrentValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->CurrentValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->CurrentValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// PeriodCode
			// Add refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// PayrollDate
			$this->PayrollDate->LinkCustomAttributes = "";
			$this->PayrollDate->HrefValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";

			// PeriodCode
			$this->PeriodCode->LinkCustomAttributes = "";
			$this->PeriodCode->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// PayrollDate
			$this->PayrollDate->EditAttrs["class"] = "form-control";
			$this->PayrollDate->EditCustomAttributes = "";
			$this->PayrollDate->EditValue = HtmlEncode(FormatDateTime($this->PayrollDate->CurrentValue, 8));
			$this->PayrollDate->PlaceHolder = RemoveHtml($this->PayrollDate->caption());

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->CurrentValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// DeductionName
			$this->DeductionName->EditAttrs["class"] = "form-control";
			$this->DeductionName->EditCustomAttributes = "";
			if (!$this->DeductionName->Raw)
				$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
			$this->DeductionName->EditValue = HtmlEncode($this->DeductionName->CurrentValue);
			$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

			// DeductionAmount
			$this->DeductionAmount->EditAttrs["class"] = "form-control";
			$this->DeductionAmount->EditCustomAttributes = "";
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->CurrentValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
			if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue)) {
				$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
				$this->DeductionAmount->OldValue = $this->DeductionAmount->EditValue;
			}
			

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->CurrentValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->CurrentValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->CurrentValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// PeriodCode
			$this->PeriodCode->EditAttrs["class"] = "form-control";
			$this->PeriodCode->EditCustomAttributes = "";
			if ($this->PeriodCode->getSessionValue() != "") {
				$this->PeriodCode->CurrentValue = $this->PeriodCode->getSessionValue();
				$this->PeriodCode->OldValue = $this->PeriodCode->CurrentValue;
				$curVal = strval($this->PeriodCode->CurrentValue);
				if ($curVal != "") {
					$this->PeriodCode->ViewValue = $this->PeriodCode->lookupCacheOption($curVal);
					if ($this->PeriodCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->PeriodCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = $rswrk->fields('df3');
							$this->PeriodCode->ViewValue = $this->PeriodCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->PeriodCode->ViewValue = $this->PeriodCode->CurrentValue;
						}
					}
				} else {
					$this->PeriodCode->ViewValue = NULL;
				}
				$this->PeriodCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->PeriodCode->CurrentValue));
				if ($curVal != "")
					$this->PeriodCode->ViewValue = $this->PeriodCode->lookupCacheOption($curVal);
				else
					$this->PeriodCode->ViewValue = $this->PeriodCode->Lookup !== NULL && is_array($this->PeriodCode->Lookup->Options) ? $curVal : NULL;
				if ($this->PeriodCode->ViewValue !== NULL) { // Load from cache
					$this->PeriodCode->EditValue = array_values($this->PeriodCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`PeriodCode`" . SearchString("=", $this->PeriodCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->PeriodCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->PeriodCode->EditValue = $arwrk;
				}
			}

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// PayrollDate
			$this->PayrollDate->LinkCustomAttributes = "";
			$this->PayrollDate->HrefValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";

			// PeriodCode
			$this->PeriodCode->LinkCustomAttributes = "";
			$this->PeriodCode->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->PayrollDate->Required) {
			if (!$this->PayrollDate->IsDetailKey && $this->PayrollDate->FormValue != NULL && $this->PayrollDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PayrollDate->caption(), $this->PayrollDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PayrollDate->FormValue)) {
			AddMessage($FormError, $this->PayrollDate->errorMessage());
		}
		if ($this->LAName->Required) {
			if (!$this->LAName->IsDetailKey && $this->LAName->FormValue != NULL && $this->LAName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LAName->caption(), $this->LAName->RequiredErrorMessage));
			}
		}
		if ($this->DeductionName->Required) {
			if (!$this->DeductionName->IsDetailKey && $this->DeductionName->FormValue != NULL && $this->DeductionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionName->caption(), $this->DeductionName->RequiredErrorMessage));
			}
		}
		if ($this->DeductionAmount->Required) {
			if (!$this->DeductionAmount->IsDetailKey && $this->DeductionAmount->FormValue != NULL && $this->DeductionAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionAmount->caption(), $this->DeductionAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionAmount->FormValue)) {
			AddMessage($FormError, $this->DeductionAmount->errorMessage());
		}
		if ($this->NRC->Required) {
			if (!$this->NRC->IsDetailKey && $this->NRC->FormValue != NULL && $this->NRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NRC->caption(), $this->NRC->RequiredErrorMessage));
			}
		}
		if ($this->Surname->Required) {
			if (!$this->Surname->IsDetailKey && $this->Surname->FormValue != NULL && $this->Surname->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Surname->caption(), $this->Surname->RequiredErrorMessage));
			}
		}
		if ($this->MiddleName->Required) {
			if (!$this->MiddleName->IsDetailKey && $this->MiddleName->FormValue != NULL && $this->MiddleName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MiddleName->caption(), $this->MiddleName->RequiredErrorMessage));
			}
		}
		if ($this->FirstName->Required) {
			if (!$this->FirstName->IsDetailKey && $this->FirstName->FormValue != NULL && $this->FirstName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirstName->caption(), $this->FirstName->RequiredErrorMessage));
			}
		}
		if ($this->PositionName->Required) {
			if (!$this->PositionName->IsDetailKey && $this->PositionName->FormValue != NULL && $this->PositionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PositionName->caption(), $this->PositionName->RequiredErrorMessage));
			}
		}
		if ($this->PeriodCode->Required) {
			if (!$this->PeriodCode->IsDetailKey && $this->PeriodCode->FormValue != NULL && $this->PeriodCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodCode->caption(), $this->PeriodCode->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['EmployeeID'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		if ($this->NRC->CurrentValue != "") { // Check field with unique index
			$filterChk = "(`NRC` = '" . AdjustSql($this->NRC->CurrentValue, $this->Dbid) . "')";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = "";
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->NRC->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->NRC->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
			$rsChk->close();
		}
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// EmployeeID
			$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, $this->EmployeeID->ReadOnly);

			// PayrollDate
			$this->PayrollDate->setDbValueDef($rsnew, UnFormatDateTime($this->PayrollDate->CurrentValue, 0), NULL, $this->PayrollDate->ReadOnly);

			// LAName
			$this->LAName->setDbValueDef($rsnew, $this->LAName->CurrentValue, "", $this->LAName->ReadOnly);

			// DeductionName
			$this->DeductionName->setDbValueDef($rsnew, $this->DeductionName->CurrentValue, "", $this->DeductionName->ReadOnly);

			// DeductionAmount
			$this->DeductionAmount->setDbValueDef($rsnew, $this->DeductionAmount->CurrentValue, 0, $this->DeductionAmount->ReadOnly);

			// NRC
			$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", $this->NRC->ReadOnly);

			// Surname
			$this->Surname->setDbValueDef($rsnew, $this->Surname->CurrentValue, "", $this->Surname->ReadOnly);

			// MiddleName
			$this->MiddleName->setDbValueDef($rsnew, $this->MiddleName->CurrentValue, "", $this->MiddleName->ReadOnly);

			// FirstName
			$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", $this->FirstName->ReadOnly);

			// PositionName
			$this->PositionName->setDbValueDef($rsnew, $this->PositionName->CurrentValue, "", $this->PositionName->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "payroll_period") {
				$this->PeriodCode->CurrentValue = $this->PeriodCode->getSessionValue();
			}
		if ($this->NRC->CurrentValue != "") { // Check field with unique index
			$filter = "(`NRC` = '" . AdjustSql($this->NRC->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->NRC->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->NRC->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// PayrollDate
		$this->PayrollDate->setDbValueDef($rsnew, UnFormatDateTime($this->PayrollDate->CurrentValue, 0), NULL, FALSE);

		// LAName
		$this->LAName->setDbValueDef($rsnew, $this->LAName->CurrentValue, "", FALSE);

		// DeductionName
		$this->DeductionName->setDbValueDef($rsnew, $this->DeductionName->CurrentValue, "", FALSE);

		// DeductionAmount
		$this->DeductionAmount->setDbValueDef($rsnew, $this->DeductionAmount->CurrentValue, 0, strval($this->DeductionAmount->CurrentValue) == "");

		// NRC
		$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", FALSE);

		// Surname
		$this->Surname->setDbValueDef($rsnew, $this->Surname->CurrentValue, "", FALSE);

		// MiddleName
		$this->MiddleName->setDbValueDef($rsnew, $this->MiddleName->CurrentValue, "", FALSE);

		// FirstName
		$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", FALSE);

		// PositionName
		$this->PositionName->setDbValueDef($rsnew, $this->PositionName->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['EmployeeID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "payroll_period") {
			$this->PeriodCode->Visible = FALSE;
			if ($GLOBALS["payroll_period"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_PeriodCode":
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
						case "x_PeriodCode":
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>