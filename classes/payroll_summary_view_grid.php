<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class payroll_summary_view_grid extends payroll_summary_view
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'payroll_summary_view';

	// Page object name
	public $PageObjName = "payroll_summary_view_grid";

	// Grid form hidden field names
	public $FormName = "fpayroll_summary_viewgrid";
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

		// Table object (payroll_summary_view)
		if (!isset($GLOBALS["payroll_summary_view"]) || get_class($GLOBALS["payroll_summary_view"]) == PROJECT_NAMESPACE . "payroll_summary_view") {
			$GLOBALS["payroll_summary_view"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["payroll_summary_view"];

		}
		$this->AddUrl = "payroll_summary_viewadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'payroll_summary_view');

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
		global $payroll_summary_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($payroll_summary_view);
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
			$key .= @$ar['EmployeeID'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['PayrollPeriod'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['pCode'];
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
		$this->LocalAuthority->setVisibility();
		$this->DepartmentName->setVisibility();
		$this->SectionName->setVisibility();
		$this->EmployeeID->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->Sex->setVisibility();
		$this->NRC->setVisibility();
		$this->PositionName->setVisibility();
		$this->PayrollPeriod->setVisibility();
		$this->pCode->setVisibility();
		$this->pName->setVisibility();
		$this->Amount->setVisibility();
		$this->PayPeriod->setVisibility();
		$this->SalaryScale->setVisibility();
		$this->Division->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->BankBranchCode->setVisibility();
		$this->BankAccountNo->setVisibility();
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
		$this->setupLookupOptions($this->LocalAuthority);
		$this->setupLookupOptions($this->PayrollPeriod);

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
		$this->Amount->FormValue = ""; // Clear form value
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
		if (count($arKeyFlds) >= 3) {
			$this->EmployeeID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->EmployeeID->OldValue))
				return FALSE;
			$this->PayrollPeriod->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->PayrollPeriod->OldValue))
				return FALSE;
			$this->pCode->setOldValue($arKeyFlds[2]);
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
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->PayrollPeriod->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->pCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_LocalAuthority") && $CurrentForm->hasValue("o_LocalAuthority") && $this->LocalAuthority->CurrentValue != $this->LocalAuthority->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepartmentName") && $CurrentForm->hasValue("o_DepartmentName") && $this->DepartmentName->CurrentValue != $this->DepartmentName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SectionName") && $CurrentForm->hasValue("o_SectionName") && $this->SectionName->CurrentValue != $this->SectionName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EmployeeID") && $CurrentForm->hasValue("o_EmployeeID") && $this->EmployeeID->CurrentValue != $this->EmployeeID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Title") && $CurrentForm->hasValue("o_Title") && $this->Title->CurrentValue != $this->Title->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Surname") && $CurrentForm->hasValue("o_Surname") && $this->Surname->CurrentValue != $this->Surname->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FirstName") && $CurrentForm->hasValue("o_FirstName") && $this->FirstName->CurrentValue != $this->FirstName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MiddleName") && $CurrentForm->hasValue("o_MiddleName") && $this->MiddleName->CurrentValue != $this->MiddleName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Sex") && $CurrentForm->hasValue("o_Sex") && $this->Sex->CurrentValue != $this->Sex->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NRC") && $CurrentForm->hasValue("o_NRC") && $this->NRC->CurrentValue != $this->NRC->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PositionName") && $CurrentForm->hasValue("o_PositionName") && $this->PositionName->CurrentValue != $this->PositionName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PayrollPeriod") && $CurrentForm->hasValue("o_PayrollPeriod") && $this->PayrollPeriod->CurrentValue != $this->PayrollPeriod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_pCode") && $CurrentForm->hasValue("o_pCode") && $this->pCode->CurrentValue != $this->pCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_pName") && $CurrentForm->hasValue("o_pName") && $this->pName->CurrentValue != $this->pName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Amount") && $CurrentForm->hasValue("o_Amount") && $this->Amount->CurrentValue != $this->Amount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PayPeriod") && $CurrentForm->hasValue("o_PayPeriod") && $this->PayPeriod->CurrentValue != $this->PayPeriod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SalaryScale") && $CurrentForm->hasValue("o_SalaryScale") && $this->SalaryScale->CurrentValue != $this->SalaryScale->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Division") && $CurrentForm->hasValue("o_Division") && $this->Division->CurrentValue != $this->Division->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentMethod") && $CurrentForm->hasValue("o_PaymentMethod") && $this->PaymentMethod->CurrentValue != $this->PaymentMethod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BankBranchCode") && $CurrentForm->hasValue("o_BankBranchCode") && $this->BankBranchCode->CurrentValue != $this->BankBranchCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BankAccountNo") && $CurrentForm->hasValue("o_BankAccountNo") && $this->BankAccountNo->CurrentValue != $this->BankAccountNo->OldValue)
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
				$this->PayrollPeriod->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PayrollPeriod->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->pCode->CurrentValue . "\">";
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
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('PayrollPeriod');
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('pCode');
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
		$this->LocalAuthority->CurrentValue = NULL;
		$this->LocalAuthority->OldValue = $this->LocalAuthority->CurrentValue;
		$this->DepartmentName->CurrentValue = NULL;
		$this->DepartmentName->OldValue = $this->DepartmentName->CurrentValue;
		$this->SectionName->CurrentValue = NULL;
		$this->SectionName->OldValue = $this->SectionName->CurrentValue;
		$this->EmployeeID->CurrentValue = 0;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->Title->CurrentValue = NULL;
		$this->Title->OldValue = $this->Title->CurrentValue;
		$this->Surname->CurrentValue = NULL;
		$this->Surname->OldValue = $this->Surname->CurrentValue;
		$this->FirstName->CurrentValue = NULL;
		$this->FirstName->OldValue = $this->FirstName->CurrentValue;
		$this->MiddleName->CurrentValue = NULL;
		$this->MiddleName->OldValue = $this->MiddleName->CurrentValue;
		$this->Sex->CurrentValue = NULL;
		$this->Sex->OldValue = $this->Sex->CurrentValue;
		$this->NRC->CurrentValue = NULL;
		$this->NRC->OldValue = $this->NRC->CurrentValue;
		$this->PositionName->CurrentValue = NULL;
		$this->PositionName->OldValue = $this->PositionName->CurrentValue;
		$this->PayrollPeriod->CurrentValue = 0;
		$this->PayrollPeriod->OldValue = $this->PayrollPeriod->CurrentValue;
		$this->pCode->CurrentValue = NULL;
		$this->pCode->OldValue = $this->pCode->CurrentValue;
		$this->pName->CurrentValue = NULL;
		$this->pName->OldValue = $this->pName->CurrentValue;
		$this->Amount->CurrentValue = NULL;
		$this->Amount->OldValue = $this->Amount->CurrentValue;
		$this->PayPeriod->CurrentValue = NULL;
		$this->PayPeriod->OldValue = $this->PayPeriod->CurrentValue;
		$this->SalaryScale->CurrentValue = NULL;
		$this->SalaryScale->OldValue = $this->SalaryScale->CurrentValue;
		$this->Division->CurrentValue = 0;
		$this->Division->OldValue = $this->Division->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
		$this->BankBranchCode->CurrentValue = NULL;
		$this->BankBranchCode->OldValue = $this->BankBranchCode->CurrentValue;
		$this->BankAccountNo->CurrentValue = NULL;
		$this->BankAccountNo->OldValue = $this->BankAccountNo->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'LocalAuthority' first before field var 'x_LocalAuthority'
		$val = $CurrentForm->hasValue("LocalAuthority") ? $CurrentForm->getValue("LocalAuthority") : $CurrentForm->getValue("x_LocalAuthority");
		if (!$this->LocalAuthority->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LocalAuthority->Visible = FALSE; // Disable update for API request
			else
				$this->LocalAuthority->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LocalAuthority"))
			$this->LocalAuthority->setOldValue($CurrentForm->getValue("o_LocalAuthority"));

		// Check field name 'DepartmentName' first before field var 'x_DepartmentName'
		$val = $CurrentForm->hasValue("DepartmentName") ? $CurrentForm->getValue("DepartmentName") : $CurrentForm->getValue("x_DepartmentName");
		if (!$this->DepartmentName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepartmentName->Visible = FALSE; // Disable update for API request
			else
				$this->DepartmentName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DepartmentName"))
			$this->DepartmentName->setOldValue($CurrentForm->getValue("o_DepartmentName"));

		// Check field name 'SectionName' first before field var 'x_SectionName'
		$val = $CurrentForm->hasValue("SectionName") ? $CurrentForm->getValue("SectionName") : $CurrentForm->getValue("x_SectionName");
		if (!$this->SectionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SectionName->Visible = FALSE; // Disable update for API request
			else
				$this->SectionName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SectionName"))
			$this->SectionName->setOldValue($CurrentForm->getValue("o_SectionName"));

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

		// Check field name 'Title' first before field var 'x_Title'
		$val = $CurrentForm->hasValue("Title") ? $CurrentForm->getValue("Title") : $CurrentForm->getValue("x_Title");
		if (!$this->Title->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Title->Visible = FALSE; // Disable update for API request
			else
				$this->Title->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Title"))
			$this->Title->setOldValue($CurrentForm->getValue("o_Title"));

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

		// Check field name 'Sex' first before field var 'x_Sex'
		$val = $CurrentForm->hasValue("Sex") ? $CurrentForm->getValue("Sex") : $CurrentForm->getValue("x_Sex");
		if (!$this->Sex->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Sex->Visible = FALSE; // Disable update for API request
			else
				$this->Sex->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Sex"))
			$this->Sex->setOldValue($CurrentForm->getValue("o_Sex"));

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

		// Check field name 'PayrollPeriod' first before field var 'x_PayrollPeriod'
		$val = $CurrentForm->hasValue("PayrollPeriod") ? $CurrentForm->getValue("PayrollPeriod") : $CurrentForm->getValue("x_PayrollPeriod");
		if (!$this->PayrollPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PayrollPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->PayrollPeriod->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PayrollPeriod"))
			$this->PayrollPeriod->setOldValue($CurrentForm->getValue("o_PayrollPeriod"));

		// Check field name 'pCode' first before field var 'x_pCode'
		$val = $CurrentForm->hasValue("pCode") ? $CurrentForm->getValue("pCode") : $CurrentForm->getValue("x_pCode");
		if (!$this->pCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pCode->Visible = FALSE; // Disable update for API request
			else
				$this->pCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pCode"))
			$this->pCode->setOldValue($CurrentForm->getValue("o_pCode"));

		// Check field name 'pName' first before field var 'x_pName'
		$val = $CurrentForm->hasValue("pName") ? $CurrentForm->getValue("pName") : $CurrentForm->getValue("x_pName");
		if (!$this->pName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pName->Visible = FALSE; // Disable update for API request
			else
				$this->pName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pName"))
			$this->pName->setOldValue($CurrentForm->getValue("o_pName"));

		// Check field name 'Amount' first before field var 'x_Amount'
		$val = $CurrentForm->hasValue("Amount") ? $CurrentForm->getValue("Amount") : $CurrentForm->getValue("x_Amount");
		if (!$this->Amount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Amount->Visible = FALSE; // Disable update for API request
			else
				$this->Amount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Amount"))
			$this->Amount->setOldValue($CurrentForm->getValue("o_Amount"));

		// Check field name 'PayPeriod' first before field var 'x_PayPeriod'
		$val = $CurrentForm->hasValue("PayPeriod") ? $CurrentForm->getValue("PayPeriod") : $CurrentForm->getValue("x_PayPeriod");
		if (!$this->PayPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PayPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->PayPeriod->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PayPeriod"))
			$this->PayPeriod->setOldValue($CurrentForm->getValue("o_PayPeriod"));

		// Check field name 'SalaryScale' first before field var 'x_SalaryScale'
		$val = $CurrentForm->hasValue("SalaryScale") ? $CurrentForm->getValue("SalaryScale") : $CurrentForm->getValue("x_SalaryScale");
		if (!$this->SalaryScale->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SalaryScale->Visible = FALSE; // Disable update for API request
			else
				$this->SalaryScale->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SalaryScale"))
			$this->SalaryScale->setOldValue($CurrentForm->getValue("o_SalaryScale"));

		// Check field name 'Division' first before field var 'x_Division'
		$val = $CurrentForm->hasValue("Division") ? $CurrentForm->getValue("Division") : $CurrentForm->getValue("x_Division");
		if (!$this->Division->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Division->Visible = FALSE; // Disable update for API request
			else
				$this->Division->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Division"))
			$this->Division->setOldValue($CurrentForm->getValue("o_Division"));

		// Check field name 'PaymentMethod' first before field var 'x_PaymentMethod'
		$val = $CurrentForm->hasValue("PaymentMethod") ? $CurrentForm->getValue("PaymentMethod") : $CurrentForm->getValue("x_PaymentMethod");
		if (!$this->PaymentMethod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentMethod->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentMethod->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PaymentMethod"))
			$this->PaymentMethod->setOldValue($CurrentForm->getValue("o_PaymentMethod"));

		// Check field name 'BankBranchCode' first before field var 'x_BankBranchCode'
		$val = $CurrentForm->hasValue("BankBranchCode") ? $CurrentForm->getValue("BankBranchCode") : $CurrentForm->getValue("x_BankBranchCode");
		if (!$this->BankBranchCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankBranchCode->Visible = FALSE; // Disable update for API request
			else
				$this->BankBranchCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BankBranchCode"))
			$this->BankBranchCode->setOldValue($CurrentForm->getValue("o_BankBranchCode"));

		// Check field name 'BankAccountNo' first before field var 'x_BankAccountNo'
		$val = $CurrentForm->hasValue("BankAccountNo") ? $CurrentForm->getValue("BankAccountNo") : $CurrentForm->getValue("x_BankAccountNo");
		if (!$this->BankAccountNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankAccountNo->Visible = FALSE; // Disable update for API request
			else
				$this->BankAccountNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BankAccountNo"))
			$this->BankAccountNo->setOldValue($CurrentForm->getValue("o_BankAccountNo"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LocalAuthority->CurrentValue = $this->LocalAuthority->FormValue;
		$this->DepartmentName->CurrentValue = $this->DepartmentName->FormValue;
		$this->SectionName->CurrentValue = $this->SectionName->FormValue;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->Title->CurrentValue = $this->Title->FormValue;
		$this->Surname->CurrentValue = $this->Surname->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->MiddleName->CurrentValue = $this->MiddleName->FormValue;
		$this->Sex->CurrentValue = $this->Sex->FormValue;
		$this->NRC->CurrentValue = $this->NRC->FormValue;
		$this->PositionName->CurrentValue = $this->PositionName->FormValue;
		$this->PayrollPeriod->CurrentValue = $this->PayrollPeriod->FormValue;
		$this->pCode->CurrentValue = $this->pCode->FormValue;
		$this->pName->CurrentValue = $this->pName->FormValue;
		$this->Amount->CurrentValue = $this->Amount->FormValue;
		$this->PayPeriod->CurrentValue = $this->PayPeriod->FormValue;
		$this->SalaryScale->CurrentValue = $this->SalaryScale->FormValue;
		$this->Division->CurrentValue = $this->Division->FormValue;
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->BankBranchCode->CurrentValue = $this->BankBranchCode->FormValue;
		$this->BankAccountNo->CurrentValue = $this->BankAccountNo->FormValue;
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
		$this->LocalAuthority->setDbValue($row['LocalAuthority']);
		$this->DepartmentName->setDbValue($row['DepartmentName']);
		$this->SectionName->setDbValue($row['SectionName']);
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->Title->setDbValue($row['Title']);
		$this->Surname->setDbValue($row['Surname']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->MiddleName->setDbValue($row['MiddleName']);
		$this->Sex->setDbValue($row['Sex']);
		$this->NRC->setDbValue($row['NRC']);
		$this->PositionName->setDbValue($row['PositionName']);
		$this->PayrollPeriod->setDbValue($row['PayrollPeriod']);
		$this->pCode->setDbValue($row['pCode']);
		$this->pName->setDbValue($row['pName']);
		$this->Amount->setDbValue($row['Amount']);
		$this->PayPeriod->setDbValue($row['PayPeriod']);
		$this->SalaryScale->setDbValue($row['SalaryScale']);
		$this->Division->setDbValue($row['Division']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->BankBranchCode->setDbValue($row['BankBranchCode']);
		$this->BankAccountNo->setDbValue($row['BankAccountNo']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LocalAuthority'] = $this->LocalAuthority->CurrentValue;
		$row['DepartmentName'] = $this->DepartmentName->CurrentValue;
		$row['SectionName'] = $this->SectionName->CurrentValue;
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['Title'] = $this->Title->CurrentValue;
		$row['Surname'] = $this->Surname->CurrentValue;
		$row['FirstName'] = $this->FirstName->CurrentValue;
		$row['MiddleName'] = $this->MiddleName->CurrentValue;
		$row['Sex'] = $this->Sex->CurrentValue;
		$row['NRC'] = $this->NRC->CurrentValue;
		$row['PositionName'] = $this->PositionName->CurrentValue;
		$row['PayrollPeriod'] = $this->PayrollPeriod->CurrentValue;
		$row['pCode'] = $this->pCode->CurrentValue;
		$row['pName'] = $this->pName->CurrentValue;
		$row['Amount'] = $this->Amount->CurrentValue;
		$row['PayPeriod'] = $this->PayPeriod->CurrentValue;
		$row['SalaryScale'] = $this->SalaryScale->CurrentValue;
		$row['Division'] = $this->Division->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		$row['BankBranchCode'] = $this->BankBranchCode->CurrentValue;
		$row['BankAccountNo'] = $this->BankAccountNo->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->RowOldKey);
		$cnt = count($keys);
		if ($cnt >= 3) {
			if (strval($keys[0]) != "")
				$this->EmployeeID->OldValue = strval($keys[0]); // EmployeeID
			else
				$validKey = FALSE;
			if (strval($keys[1]) != "")
				$this->PayrollPeriod->OldValue = strval($keys[1]); // PayrollPeriod
			else
				$validKey = FALSE;
			if (strval($keys[2]) != "")
				$this->pCode->OldValue = strval($keys[2]); // pCode
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
		if ($this->Amount->FormValue == $this->Amount->CurrentValue && is_numeric(ConvertToFloatString($this->Amount->CurrentValue)))
			$this->Amount->CurrentValue = ConvertToFloatString($this->Amount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LocalAuthority
		// DepartmentName
		// SectionName
		// EmployeeID
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// NRC
		// PositionName
		// PayrollPeriod
		// pCode
		// pName
		// Amount
		// PayPeriod
		// SalaryScale
		// Division
		// PaymentMethod
		// BankBranchCode
		// BankAccountNo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LocalAuthority
			$curVal = strval($this->LocalAuthority->CurrentValue);
			if ($curVal != "") {
				$this->LocalAuthority->ViewValue = $this->LocalAuthority->lookupCacheOption($curVal);
				if ($this->LocalAuthority->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LocalAuthority->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LocalAuthority->ViewValue = $this->LocalAuthority->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LocalAuthority->ViewValue = $this->LocalAuthority->CurrentValue;
					}
				}
			} else {
				$this->LocalAuthority->ViewValue = NULL;
			}
			$this->LocalAuthority->ViewCustomAttributes = "";

			// DepartmentName
			$this->DepartmentName->ViewValue = $this->DepartmentName->CurrentValue;
			$this->DepartmentName->ViewCustomAttributes = "";

			// SectionName
			$this->SectionName->ViewValue = $this->SectionName->CurrentValue;
			$this->SectionName->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// Title
			$this->Title->ViewValue = $this->Title->CurrentValue;
			$this->Title->ViewCustomAttributes = "";

			// Surname
			$this->Surname->ViewValue = $this->Surname->CurrentValue;
			$this->Surname->ViewCustomAttributes = "";

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->ViewCustomAttributes = "";

			// MiddleName
			$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
			$this->MiddleName->ViewCustomAttributes = "";

			// Sex
			$this->Sex->ViewValue = $this->Sex->CurrentValue;
			$this->Sex->ViewCustomAttributes = "";

			// NRC
			$this->NRC->ViewValue = $this->NRC->CurrentValue;
			$this->NRC->ViewCustomAttributes = "";

			// PositionName
			$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
			$this->PositionName->ViewCustomAttributes = "";

			// PayrollPeriod
			$curVal = strval($this->PayrollPeriod->CurrentValue);
			if ($curVal != "") {
				$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
				if ($this->PayrollPeriod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PayrollPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
					}
				}
			} else {
				$this->PayrollPeriod->ViewValue = NULL;
			}
			$this->PayrollPeriod->ViewCustomAttributes = "";

			// pCode
			$this->pCode->ViewValue = $this->pCode->CurrentValue;
			$this->pCode->ViewCustomAttributes = "";

			// pName
			$this->pName->ViewValue = $this->pName->CurrentValue;
			$this->pName->ViewCustomAttributes = "";

			// Amount
			$this->Amount->ViewValue = $this->Amount->CurrentValue;
			$this->Amount->ViewValue = FormatNumber($this->Amount->ViewValue, 2, -2, -1, -2);
			$this->Amount->CellCssStyle .= "text-align: right;";
			$this->Amount->ViewCustomAttributes = "";

			// PayPeriod
			$this->PayPeriod->ViewValue = $this->PayPeriod->CurrentValue;
			$this->PayPeriod->ViewCustomAttributes = "";

			// SalaryScale
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$this->SalaryScale->ViewCustomAttributes = "";

			// Division
			$this->Division->ViewValue = $this->Division->CurrentValue;
			$this->Division->ViewValue = FormatNumber($this->Division->ViewValue, 0, -2, -2, -2);
			$this->Division->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
			$this->PaymentMethod->ViewCustomAttributes = "";

			// BankBranchCode
			$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
			$this->BankBranchCode->ViewCustomAttributes = "";

			// BankAccountNo
			$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
			$this->BankAccountNo->ViewCustomAttributes = "";

			// LocalAuthority
			$this->LocalAuthority->LinkCustomAttributes = "";
			$this->LocalAuthority->HrefValue = "";
			$this->LocalAuthority->TooltipValue = "";

			// DepartmentName
			$this->DepartmentName->LinkCustomAttributes = "";
			$this->DepartmentName->HrefValue = "";
			$this->DepartmentName->TooltipValue = "";
			if (!$this->isExport())
				$this->DepartmentName->ViewValue = $this->highlightValue($this->DepartmentName);

			// SectionName
			$this->SectionName->LinkCustomAttributes = "";
			$this->SectionName->HrefValue = "";
			$this->SectionName->TooltipValue = "";
			if (!$this->isExport())
				$this->SectionName->ViewValue = $this->highlightValue($this->SectionName);

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";
			$this->Title->TooltipValue = "";
			if (!$this->isExport())
				$this->Title->ViewValue = $this->highlightValue($this->Title);

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";
			$this->Surname->TooltipValue = "";
			if (!$this->isExport())
				$this->Surname->ViewValue = $this->highlightValue($this->Surname);

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";
			if (!$this->isExport())
				$this->FirstName->ViewValue = $this->highlightValue($this->FirstName);

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";
			$this->MiddleName->TooltipValue = "";
			if (!$this->isExport())
				$this->MiddleName->ViewValue = $this->highlightValue($this->MiddleName);

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";
			$this->Sex->TooltipValue = "";
			if (!$this->isExport())
				$this->Sex->ViewValue = $this->highlightValue($this->Sex);

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";
			$this->NRC->TooltipValue = "";
			if (!$this->isExport())
				$this->NRC->ViewValue = $this->highlightValue($this->NRC);

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";
			$this->PositionName->TooltipValue = "";
			if (!$this->isExport())
				$this->PositionName->ViewValue = $this->highlightValue($this->PositionName);

			// PayrollPeriod
			$this->PayrollPeriod->LinkCustomAttributes = "";
			$this->PayrollPeriod->HrefValue = "";
			$this->PayrollPeriod->TooltipValue = "";

			// pCode
			$this->pCode->LinkCustomAttributes = "";
			$this->pCode->HrefValue = "";
			$this->pCode->TooltipValue = "";
			if (!$this->isExport())
				$this->pCode->ViewValue = $this->highlightValue($this->pCode);

			// pName
			$this->pName->LinkCustomAttributes = "";
			$this->pName->HrefValue = "";
			$this->pName->TooltipValue = "";
			if (!$this->isExport())
				$this->pName->ViewValue = $this->highlightValue($this->pName);

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";
			$this->Amount->TooltipValue = "";

			// PayPeriod
			$this->PayPeriod->LinkCustomAttributes = "";
			$this->PayPeriod->HrefValue = "";
			$this->PayPeriod->TooltipValue = "";
			if (!$this->isExport())
				$this->PayPeriod->ViewValue = $this->highlightValue($this->PayPeriod);

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";
			$this->SalaryScale->TooltipValue = "";
			if (!$this->isExport())
				$this->SalaryScale->ViewValue = $this->highlightValue($this->SalaryScale);

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";
			$this->Division->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";
			if (!$this->isExport())
				$this->PaymentMethod->ViewValue = $this->highlightValue($this->PaymentMethod);

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";
			$this->BankBranchCode->TooltipValue = "";
			if (!$this->isExport())
				$this->BankBranchCode->ViewValue = $this->highlightValue($this->BankBranchCode);

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
			$this->BankAccountNo->TooltipValue = "";
			if (!$this->isExport())
				$this->BankAccountNo->ViewValue = $this->highlightValue($this->BankAccountNo);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LocalAuthority
			$this->LocalAuthority->EditCustomAttributes = "";
			$curVal = trim(strval($this->LocalAuthority->CurrentValue));
			if ($curVal != "")
				$this->LocalAuthority->ViewValue = $this->LocalAuthority->lookupCacheOption($curVal);
			else
				$this->LocalAuthority->ViewValue = $this->LocalAuthority->Lookup !== NULL && is_array($this->LocalAuthority->Lookup->Options) ? $curVal : NULL;
			if ($this->LocalAuthority->ViewValue !== NULL) { // Load from cache
				$this->LocalAuthority->EditValue = array_values($this->LocalAuthority->Lookup->Options);
				if ($this->LocalAuthority->ViewValue == "")
					$this->LocalAuthority->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LocalAuthority->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LocalAuthority->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->LocalAuthority->ViewValue = $this->LocalAuthority->displayValue($arwrk);
				} else {
					$this->LocalAuthority->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LocalAuthority->EditValue = $arwrk;
			}

			// DepartmentName
			$this->DepartmentName->EditAttrs["class"] = "form-control";
			$this->DepartmentName->EditCustomAttributes = "";
			if (!$this->DepartmentName->Raw)
				$this->DepartmentName->CurrentValue = HtmlDecode($this->DepartmentName->CurrentValue);
			$this->DepartmentName->EditValue = HtmlEncode($this->DepartmentName->CurrentValue);
			$this->DepartmentName->PlaceHolder = RemoveHtml($this->DepartmentName->caption());

			// SectionName
			$this->SectionName->EditAttrs["class"] = "form-control";
			$this->SectionName->EditCustomAttributes = "";
			if (!$this->SectionName->Raw)
				$this->SectionName->CurrentValue = HtmlDecode($this->SectionName->CurrentValue);
			$this->SectionName->EditValue = HtmlEncode($this->SectionName->CurrentValue);
			$this->SectionName->PlaceHolder = RemoveHtml($this->SectionName->caption());

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			if (!$this->Title->Raw)
				$this->Title->CurrentValue = HtmlDecode($this->Title->CurrentValue);
			$this->Title->EditValue = HtmlEncode($this->Title->CurrentValue);
			$this->Title->PlaceHolder = RemoveHtml($this->Title->caption());

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->CurrentValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->CurrentValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// Sex
			$this->Sex->EditAttrs["class"] = "form-control";
			$this->Sex->EditCustomAttributes = "";
			if (!$this->Sex->Raw)
				$this->Sex->CurrentValue = HtmlDecode($this->Sex->CurrentValue);
			$this->Sex->EditValue = HtmlEncode($this->Sex->CurrentValue);
			$this->Sex->PlaceHolder = RemoveHtml($this->Sex->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->CurrentValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// PayrollPeriod
			$this->PayrollPeriod->EditAttrs["class"] = "form-control";
			$this->PayrollPeriod->EditCustomAttributes = "";
			if ($this->PayrollPeriod->getSessionValue() != "") {
				$this->PayrollPeriod->CurrentValue = $this->PayrollPeriod->getSessionValue();
				$this->PayrollPeriod->OldValue = $this->PayrollPeriod->CurrentValue;
				$curVal = strval($this->PayrollPeriod->CurrentValue);
				if ($curVal != "") {
					$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
					if ($this->PayrollPeriod->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->PayrollPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = $rswrk->fields('df3');
							$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
						}
					}
				} else {
					$this->PayrollPeriod->ViewValue = NULL;
				}
				$this->PayrollPeriod->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->PayrollPeriod->CurrentValue));
				if ($curVal != "")
					$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
				else
					$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->Lookup !== NULL && is_array($this->PayrollPeriod->Lookup->Options) ? $curVal : NULL;
				if ($this->PayrollPeriod->ViewValue !== NULL) { // Load from cache
					$this->PayrollPeriod->EditValue = array_values($this->PayrollPeriod->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`PeriodCode`" . SearchString("=", $this->PayrollPeriod->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->PayrollPeriod->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->PayrollPeriod->EditValue = $arwrk;
				}
			}

			// pCode
			$this->pCode->EditAttrs["class"] = "form-control";
			$this->pCode->EditCustomAttributes = "";
			if (!$this->pCode->Raw)
				$this->pCode->CurrentValue = HtmlDecode($this->pCode->CurrentValue);
			$this->pCode->EditValue = HtmlEncode($this->pCode->CurrentValue);
			$this->pCode->PlaceHolder = RemoveHtml($this->pCode->caption());

			// pName
			$this->pName->EditAttrs["class"] = "form-control";
			$this->pName->EditCustomAttributes = "";
			if (!$this->pName->Raw)
				$this->pName->CurrentValue = HtmlDecode($this->pName->CurrentValue);
			$this->pName->EditValue = HtmlEncode($this->pName->CurrentValue);
			$this->pName->PlaceHolder = RemoveHtml($this->pName->caption());

			// Amount
			$this->Amount->EditAttrs["class"] = "form-control";
			$this->Amount->EditCustomAttributes = "";
			$this->Amount->EditValue = HtmlEncode($this->Amount->CurrentValue);
			$this->Amount->PlaceHolder = RemoveHtml($this->Amount->caption());
			if (strval($this->Amount->EditValue) != "" && is_numeric($this->Amount->EditValue)) {
				$this->Amount->EditValue = FormatNumber($this->Amount->EditValue, -2, -2, -2, -2);
				$this->Amount->OldValue = $this->Amount->EditValue;
			}
			

			// PayPeriod
			$this->PayPeriod->EditAttrs["class"] = "form-control";
			$this->PayPeriod->EditCustomAttributes = "";
			if (!$this->PayPeriod->Raw)
				$this->PayPeriod->CurrentValue = HtmlDecode($this->PayPeriod->CurrentValue);
			$this->PayPeriod->EditValue = HtmlEncode($this->PayPeriod->CurrentValue);
			$this->PayPeriod->PlaceHolder = RemoveHtml($this->PayPeriod->caption());

			// SalaryScale
			$this->SalaryScale->EditAttrs["class"] = "form-control";
			$this->SalaryScale->EditCustomAttributes = "";
			if (!$this->SalaryScale->Raw)
				$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->EditValue = HtmlEncode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());

			// Division
			$this->Division->EditAttrs["class"] = "form-control";
			$this->Division->EditCustomAttributes = "";
			$this->Division->EditValue = HtmlEncode($this->Division->CurrentValue);
			$this->Division->PlaceHolder = RemoveHtml($this->Division->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// BankBranchCode
			$this->BankBranchCode->EditAttrs["class"] = "form-control";
			$this->BankBranchCode->EditCustomAttributes = "";
			if (!$this->BankBranchCode->Raw)
				$this->BankBranchCode->CurrentValue = HtmlDecode($this->BankBranchCode->CurrentValue);
			$this->BankBranchCode->EditValue = HtmlEncode($this->BankBranchCode->CurrentValue);
			$this->BankBranchCode->PlaceHolder = RemoveHtml($this->BankBranchCode->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// Add refer script
			// LocalAuthority

			$this->LocalAuthority->LinkCustomAttributes = "";
			$this->LocalAuthority->HrefValue = "";

			// DepartmentName
			$this->DepartmentName->LinkCustomAttributes = "";
			$this->DepartmentName->HrefValue = "";

			// SectionName
			$this->SectionName->LinkCustomAttributes = "";
			$this->SectionName->HrefValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";

			// PayrollPeriod
			$this->PayrollPeriod->LinkCustomAttributes = "";
			$this->PayrollPeriod->HrefValue = "";

			// pCode
			$this->pCode->LinkCustomAttributes = "";
			$this->pCode->HrefValue = "";

			// pName
			$this->pName->LinkCustomAttributes = "";
			$this->pName->HrefValue = "";

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";

			// PayPeriod
			$this->PayPeriod->LinkCustomAttributes = "";
			$this->PayPeriod->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// LocalAuthority
			$this->LocalAuthority->EditCustomAttributes = "";
			$curVal = trim(strval($this->LocalAuthority->CurrentValue));
			if ($curVal != "")
				$this->LocalAuthority->ViewValue = $this->LocalAuthority->lookupCacheOption($curVal);
			else
				$this->LocalAuthority->ViewValue = $this->LocalAuthority->Lookup !== NULL && is_array($this->LocalAuthority->Lookup->Options) ? $curVal : NULL;
			if ($this->LocalAuthority->ViewValue !== NULL) { // Load from cache
				$this->LocalAuthority->EditValue = array_values($this->LocalAuthority->Lookup->Options);
				if ($this->LocalAuthority->ViewValue == "")
					$this->LocalAuthority->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LocalAuthority->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LocalAuthority->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->LocalAuthority->ViewValue = $this->LocalAuthority->displayValue($arwrk);
				} else {
					$this->LocalAuthority->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LocalAuthority->EditValue = $arwrk;
			}

			// DepartmentName
			$this->DepartmentName->EditAttrs["class"] = "form-control";
			$this->DepartmentName->EditCustomAttributes = "";
			if (!$this->DepartmentName->Raw)
				$this->DepartmentName->CurrentValue = HtmlDecode($this->DepartmentName->CurrentValue);
			$this->DepartmentName->EditValue = HtmlEncode($this->DepartmentName->CurrentValue);
			$this->DepartmentName->PlaceHolder = RemoveHtml($this->DepartmentName->caption());

			// SectionName
			$this->SectionName->EditAttrs["class"] = "form-control";
			$this->SectionName->EditCustomAttributes = "";
			if (!$this->SectionName->Raw)
				$this->SectionName->CurrentValue = HtmlDecode($this->SectionName->CurrentValue);
			$this->SectionName->EditValue = HtmlEncode($this->SectionName->CurrentValue);
			$this->SectionName->PlaceHolder = RemoveHtml($this->SectionName->caption());

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			if (!$this->Title->Raw)
				$this->Title->CurrentValue = HtmlDecode($this->Title->CurrentValue);
			$this->Title->EditValue = HtmlEncode($this->Title->CurrentValue);
			$this->Title->PlaceHolder = RemoveHtml($this->Title->caption());

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->CurrentValue = HtmlDecode($this->Surname->CurrentValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->CurrentValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->CurrentValue = HtmlDecode($this->MiddleName->CurrentValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->CurrentValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// Sex
			$this->Sex->EditAttrs["class"] = "form-control";
			$this->Sex->EditCustomAttributes = "";
			if (!$this->Sex->Raw)
				$this->Sex->CurrentValue = HtmlDecode($this->Sex->CurrentValue);
			$this->Sex->EditValue = HtmlEncode($this->Sex->CurrentValue);
			$this->Sex->PlaceHolder = RemoveHtml($this->Sex->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->CurrentValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// PayrollPeriod
			$this->PayrollPeriod->EditAttrs["class"] = "form-control";
			$this->PayrollPeriod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PayrollPeriod->CurrentValue));
			if ($curVal != "")
				$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
			else
				$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->Lookup !== NULL && is_array($this->PayrollPeriod->Lookup->Options) ? $curVal : NULL;
			if ($this->PayrollPeriod->ViewValue !== NULL) { // Load from cache
				$this->PayrollPeriod->EditValue = array_values($this->PayrollPeriod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PeriodCode`" . SearchString("=", $this->PayrollPeriod->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PayrollPeriod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PayrollPeriod->EditValue = $arwrk;
			}

			// pCode
			$this->pCode->EditAttrs["class"] = "form-control";
			$this->pCode->EditCustomAttributes = "";
			if (!$this->pCode->Raw)
				$this->pCode->CurrentValue = HtmlDecode($this->pCode->CurrentValue);
			$this->pCode->EditValue = HtmlEncode($this->pCode->CurrentValue);
			$this->pCode->PlaceHolder = RemoveHtml($this->pCode->caption());

			// pName
			$this->pName->EditAttrs["class"] = "form-control";
			$this->pName->EditCustomAttributes = "";
			if (!$this->pName->Raw)
				$this->pName->CurrentValue = HtmlDecode($this->pName->CurrentValue);
			$this->pName->EditValue = HtmlEncode($this->pName->CurrentValue);
			$this->pName->PlaceHolder = RemoveHtml($this->pName->caption());

			// Amount
			$this->Amount->EditAttrs["class"] = "form-control";
			$this->Amount->EditCustomAttributes = "";
			$this->Amount->EditValue = HtmlEncode($this->Amount->CurrentValue);
			$this->Amount->PlaceHolder = RemoveHtml($this->Amount->caption());
			if (strval($this->Amount->EditValue) != "" && is_numeric($this->Amount->EditValue)) {
				$this->Amount->EditValue = FormatNumber($this->Amount->EditValue, -2, -2, -2, -2);
				$this->Amount->OldValue = $this->Amount->EditValue;
			}
			

			// PayPeriod
			$this->PayPeriod->EditAttrs["class"] = "form-control";
			$this->PayPeriod->EditCustomAttributes = "";
			if (!$this->PayPeriod->Raw)
				$this->PayPeriod->CurrentValue = HtmlDecode($this->PayPeriod->CurrentValue);
			$this->PayPeriod->EditValue = HtmlEncode($this->PayPeriod->CurrentValue);
			$this->PayPeriod->PlaceHolder = RemoveHtml($this->PayPeriod->caption());

			// SalaryScale
			$this->SalaryScale->EditAttrs["class"] = "form-control";
			$this->SalaryScale->EditCustomAttributes = "";
			if (!$this->SalaryScale->Raw)
				$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->EditValue = HtmlEncode($this->SalaryScale->CurrentValue);
			$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());

			// Division
			$this->Division->EditAttrs["class"] = "form-control";
			$this->Division->EditCustomAttributes = "";
			$this->Division->EditValue = HtmlEncode($this->Division->CurrentValue);
			$this->Division->PlaceHolder = RemoveHtml($this->Division->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// BankBranchCode
			$this->BankBranchCode->EditAttrs["class"] = "form-control";
			$this->BankBranchCode->EditCustomAttributes = "";
			if (!$this->BankBranchCode->Raw)
				$this->BankBranchCode->CurrentValue = HtmlDecode($this->BankBranchCode->CurrentValue);
			$this->BankBranchCode->EditValue = HtmlEncode($this->BankBranchCode->CurrentValue);
			$this->BankBranchCode->PlaceHolder = RemoveHtml($this->BankBranchCode->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// Edit refer script
			// LocalAuthority

			$this->LocalAuthority->LinkCustomAttributes = "";
			$this->LocalAuthority->HrefValue = "";

			// DepartmentName
			$this->DepartmentName->LinkCustomAttributes = "";
			$this->DepartmentName->HrefValue = "";

			// SectionName
			$this->SectionName->LinkCustomAttributes = "";
			$this->SectionName->HrefValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";

			// PayrollPeriod
			$this->PayrollPeriod->LinkCustomAttributes = "";
			$this->PayrollPeriod->HrefValue = "";

			// pCode
			$this->pCode->LinkCustomAttributes = "";
			$this->pCode->HrefValue = "";

			// pName
			$this->pName->LinkCustomAttributes = "";
			$this->pName->HrefValue = "";

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";

			// PayPeriod
			$this->PayPeriod->LinkCustomAttributes = "";
			$this->PayPeriod->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
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
		if ($this->LocalAuthority->Required) {
			if (!$this->LocalAuthority->IsDetailKey && $this->LocalAuthority->FormValue != NULL && $this->LocalAuthority->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LocalAuthority->caption(), $this->LocalAuthority->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentName->Required) {
			if (!$this->DepartmentName->IsDetailKey && $this->DepartmentName->FormValue != NULL && $this->DepartmentName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentName->caption(), $this->DepartmentName->RequiredErrorMessage));
			}
		}
		if ($this->SectionName->Required) {
			if (!$this->SectionName->IsDetailKey && $this->SectionName->FormValue != NULL && $this->SectionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionName->caption(), $this->SectionName->RequiredErrorMessage));
			}
		}
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->Title->Required) {
			if (!$this->Title->IsDetailKey && $this->Title->FormValue != NULL && $this->Title->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Title->caption(), $this->Title->RequiredErrorMessage));
			}
		}
		if ($this->Surname->Required) {
			if (!$this->Surname->IsDetailKey && $this->Surname->FormValue != NULL && $this->Surname->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Surname->caption(), $this->Surname->RequiredErrorMessage));
			}
		}
		if ($this->FirstName->Required) {
			if (!$this->FirstName->IsDetailKey && $this->FirstName->FormValue != NULL && $this->FirstName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirstName->caption(), $this->FirstName->RequiredErrorMessage));
			}
		}
		if ($this->MiddleName->Required) {
			if (!$this->MiddleName->IsDetailKey && $this->MiddleName->FormValue != NULL && $this->MiddleName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MiddleName->caption(), $this->MiddleName->RequiredErrorMessage));
			}
		}
		if ($this->Sex->Required) {
			if (!$this->Sex->IsDetailKey && $this->Sex->FormValue != NULL && $this->Sex->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Sex->caption(), $this->Sex->RequiredErrorMessage));
			}
		}
		if ($this->NRC->Required) {
			if (!$this->NRC->IsDetailKey && $this->NRC->FormValue != NULL && $this->NRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NRC->caption(), $this->NRC->RequiredErrorMessage));
			}
		}
		if ($this->PositionName->Required) {
			if (!$this->PositionName->IsDetailKey && $this->PositionName->FormValue != NULL && $this->PositionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PositionName->caption(), $this->PositionName->RequiredErrorMessage));
			}
		}
		if ($this->PayrollPeriod->Required) {
			if (!$this->PayrollPeriod->IsDetailKey && $this->PayrollPeriod->FormValue != NULL && $this->PayrollPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PayrollPeriod->caption(), $this->PayrollPeriod->RequiredErrorMessage));
			}
		}
		if ($this->pCode->Required) {
			if (!$this->pCode->IsDetailKey && $this->pCode->FormValue != NULL && $this->pCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pCode->caption(), $this->pCode->RequiredErrorMessage));
			}
		}
		if ($this->pName->Required) {
			if (!$this->pName->IsDetailKey && $this->pName->FormValue != NULL && $this->pName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pName->caption(), $this->pName->RequiredErrorMessage));
			}
		}
		if ($this->Amount->Required) {
			if (!$this->Amount->IsDetailKey && $this->Amount->FormValue != NULL && $this->Amount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Amount->caption(), $this->Amount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Amount->FormValue)) {
			AddMessage($FormError, $this->Amount->errorMessage());
		}
		if ($this->PayPeriod->Required) {
			if (!$this->PayPeriod->IsDetailKey && $this->PayPeriod->FormValue != NULL && $this->PayPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PayPeriod->caption(), $this->PayPeriod->RequiredErrorMessage));
			}
		}
		if ($this->SalaryScale->Required) {
			if (!$this->SalaryScale->IsDetailKey && $this->SalaryScale->FormValue != NULL && $this->SalaryScale->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SalaryScale->caption(), $this->SalaryScale->RequiredErrorMessage));
			}
		}
		if ($this->Division->Required) {
			if (!$this->Division->IsDetailKey && $this->Division->FormValue != NULL && $this->Division->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Division->caption(), $this->Division->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Division->FormValue)) {
			AddMessage($FormError, $this->Division->errorMessage());
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
			}
		}
		if ($this->BankBranchCode->Required) {
			if (!$this->BankBranchCode->IsDetailKey && $this->BankBranchCode->FormValue != NULL && $this->BankBranchCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankBranchCode->caption(), $this->BankBranchCode->RequiredErrorMessage));
			}
		}
		if ($this->BankAccountNo->Required) {
			if (!$this->BankAccountNo->IsDetailKey && $this->BankAccountNo->FormValue != NULL && $this->BankAccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankAccountNo->caption(), $this->BankAccountNo->RequiredErrorMessage));
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
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['PayrollPeriod'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['pCode'];
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

			// LocalAuthority
			$this->LocalAuthority->setDbValueDef($rsnew, $this->LocalAuthority->CurrentValue, "", $this->LocalAuthority->ReadOnly);

			// DepartmentName
			$this->DepartmentName->setDbValueDef($rsnew, $this->DepartmentName->CurrentValue, "", $this->DepartmentName->ReadOnly);

			// SectionName
			$this->SectionName->setDbValueDef($rsnew, $this->SectionName->CurrentValue, "", $this->SectionName->ReadOnly);

			// EmployeeID
			$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, $this->EmployeeID->ReadOnly);

			// Title
			$this->Title->setDbValueDef($rsnew, $this->Title->CurrentValue, NULL, $this->Title->ReadOnly);

			// Surname
			$this->Surname->setDbValueDef($rsnew, $this->Surname->CurrentValue, "", $this->Surname->ReadOnly);

			// FirstName
			$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", $this->FirstName->ReadOnly);

			// MiddleName
			$this->MiddleName->setDbValueDef($rsnew, $this->MiddleName->CurrentValue, NULL, $this->MiddleName->ReadOnly);

			// Sex
			$this->Sex->setDbValueDef($rsnew, $this->Sex->CurrentValue, "", $this->Sex->ReadOnly);

			// NRC
			$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", $this->NRC->ReadOnly);

			// PositionName
			$this->PositionName->setDbValueDef($rsnew, $this->PositionName->CurrentValue, "", $this->PositionName->ReadOnly);

			// PayrollPeriod
			$this->PayrollPeriod->setDbValueDef($rsnew, $this->PayrollPeriod->CurrentValue, 0, $this->PayrollPeriod->ReadOnly);

			// pCode
			$this->pCode->setDbValueDef($rsnew, $this->pCode->CurrentValue, "", $this->pCode->ReadOnly);

			// pName
			$this->pName->setDbValueDef($rsnew, $this->pName->CurrentValue, "", $this->pName->ReadOnly);

			// Amount
			$this->Amount->setDbValueDef($rsnew, $this->Amount->CurrentValue, 0, $this->Amount->ReadOnly);

			// PayPeriod
			$this->PayPeriod->setDbValueDef($rsnew, $this->PayPeriod->CurrentValue, "", $this->PayPeriod->ReadOnly);

			// SalaryScale
			$this->SalaryScale->setDbValueDef($rsnew, $this->SalaryScale->CurrentValue, "", $this->SalaryScale->ReadOnly);

			// Division
			$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, 0, $this->Division->ReadOnly);

			// PaymentMethod
			$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, NULL, $this->PaymentMethod->ReadOnly);

			// BankBranchCode
			$this->BankBranchCode->setDbValueDef($rsnew, $this->BankBranchCode->CurrentValue, NULL, $this->BankBranchCode->ReadOnly);

			// BankAccountNo
			$this->BankAccountNo->setDbValueDef($rsnew, $this->BankAccountNo->CurrentValue, NULL, $this->BankAccountNo->ReadOnly);

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
				$this->PayrollPeriod->CurrentValue = $this->PayrollPeriod->getSessionValue();
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

		// LocalAuthority
		$this->LocalAuthority->setDbValueDef($rsnew, $this->LocalAuthority->CurrentValue, "", FALSE);

		// DepartmentName
		$this->DepartmentName->setDbValueDef($rsnew, $this->DepartmentName->CurrentValue, "", FALSE);

		// SectionName
		$this->SectionName->setDbValueDef($rsnew, $this->SectionName->CurrentValue, "", FALSE);

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// Title
		$this->Title->setDbValueDef($rsnew, $this->Title->CurrentValue, NULL, FALSE);

		// Surname
		$this->Surname->setDbValueDef($rsnew, $this->Surname->CurrentValue, "", FALSE);

		// FirstName
		$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", FALSE);

		// MiddleName
		$this->MiddleName->setDbValueDef($rsnew, $this->MiddleName->CurrentValue, NULL, FALSE);

		// Sex
		$this->Sex->setDbValueDef($rsnew, $this->Sex->CurrentValue, "", FALSE);

		// NRC
		$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", FALSE);

		// PositionName
		$this->PositionName->setDbValueDef($rsnew, $this->PositionName->CurrentValue, "", FALSE);

		// PayrollPeriod
		$this->PayrollPeriod->setDbValueDef($rsnew, $this->PayrollPeriod->CurrentValue, 0, FALSE);

		// pCode
		$this->pCode->setDbValueDef($rsnew, $this->pCode->CurrentValue, "", FALSE);

		// pName
		$this->pName->setDbValueDef($rsnew, $this->pName->CurrentValue, "", FALSE);

		// Amount
		$this->Amount->setDbValueDef($rsnew, $this->Amount->CurrentValue, 0, strval($this->Amount->CurrentValue) == "");

		// PayPeriod
		$this->PayPeriod->setDbValueDef($rsnew, $this->PayPeriod->CurrentValue, "", FALSE);

		// SalaryScale
		$this->SalaryScale->setDbValueDef($rsnew, $this->SalaryScale->CurrentValue, "", FALSE);

		// Division
		$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, 0, strval($this->Division->CurrentValue) == "");

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, NULL, FALSE);

		// BankBranchCode
		$this->BankBranchCode->setDbValueDef($rsnew, $this->BankBranchCode->CurrentValue, NULL, FALSE);

		// BankAccountNo
		$this->BankAccountNo->setDbValueDef($rsnew, $this->BankAccountNo->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['EmployeeID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['PayrollPeriod']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['pCode']) == "") {
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
			$this->PayrollPeriod->Visible = FALSE;
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
				case "x_LocalAuthority":
					break;
				case "x_PayrollPeriod":
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
						case "x_LocalAuthority":
							break;
						case "x_PayrollPeriod":
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