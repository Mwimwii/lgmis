<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class local_authority_grid extends local_authority
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'local_authority';

	// Page object name
	public $PageObjName = "local_authority_grid";

	// Grid form hidden field names
	public $FormName = "flocal_authoritygrid";
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

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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

		// Table object (local_authority)
		if (!isset($GLOBALS["local_authority"]) || get_class($GLOBALS["local_authority"]) == PROJECT_NAMESPACE . "local_authority") {
			$GLOBALS["local_authority"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["local_authority"];

		}
		$this->AddUrl = "local_authorityadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'local_authority');

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
		global $local_authority;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($local_authority);
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
			$key .= @$ar['LACode'];
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
			$this->LastUpdated->Visible = FALSE;
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
		$this->LACode->Visible = FALSE;
		$this->LAName->setVisibility();
		$this->CouncilType->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->Created->Visible = FALSE;
		$this->OpeningDate->Visible = FALSE;
		$this->ClosedDate->Visible = FALSE;
		$this->OrgUnitLevel->Visible = FALSE;
		$this->Mandate->Visible = FALSE;
		$this->Strategy->Visible = FALSE;
		$this->Clients->setVisibility();
		$this->Beneficiaries->setVisibility();
		$this->ExecutiveAuthority->setVisibility();
		$this->ControllingOfficer->setVisibility();
		$this->Comment->setVisibility();
		$this->LastUpdated->Visible = FALSE;
		$this->LastUserId->Visible = FALSE;
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
		$this->setupLookupOptions($this->CouncilType);
		$this->setupLookupOptions($this->ProvinceCode);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "province") {
			global $province;
			$rsmaster = $province->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("provincelist.php"); // Return to master page
			} else {
				$province->loadListRowValues($rsmaster);
				$province->RowType = ROWTYPE_MASTER; // Master row
				$province->renderListRow();
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
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
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
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
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
			$this->LACode->setOldValue($arKeyFlds[0]);
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
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
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
					$key .= $this->LACode->CurrentValue;

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
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_LAName") && $CurrentForm->hasValue("o_LAName") && $this->LAName->CurrentValue != $this->LAName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CouncilType") && $CurrentForm->hasValue("o_CouncilType") && $this->CouncilType->CurrentValue != $this->CouncilType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProvinceCode") && $CurrentForm->hasValue("o_ProvinceCode") && $this->ProvinceCode->CurrentValue != $this->ProvinceCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Clients") && $CurrentForm->hasValue("o_Clients") && $this->Clients->CurrentValue != $this->Clients->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Beneficiaries") && $CurrentForm->hasValue("o_Beneficiaries") && $this->Beneficiaries->CurrentValue != $this->Beneficiaries->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ExecutiveAuthority") && $CurrentForm->hasValue("o_ExecutiveAuthority") && $this->ExecutiveAuthority->CurrentValue != $this->ExecutiveAuthority->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ControllingOfficer") && $CurrentForm->hasValue("o_ControllingOfficer") && $this->ControllingOfficer->CurrentValue != $this->ControllingOfficer->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Comment") && $CurrentForm->hasValue("o_Comment") && $this->Comment->CurrentValue != $this->Comment->OldValue)
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
				$this->ProvinceCode->setSessionValue("");
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

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

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
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($this->CurrentMode == "view") { // View mode

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->LACode->CurrentValue . "\">";
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
		$key .= $rs->fields('LACode');
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

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
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
				$item->Visible = $Security->canAdd();
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
		$links = "";
		$btngrps = "";
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";
		$sqlwrk = $sqlwrk . " AND " . "`ProvinceCode`=" . AdjustSql($this->ProvinceCode->CurrentValue, $this->Dbid) . "";

		// Column "detail_department"
		if ($this->DetailPages && $this->DetailPages["department"] && $this->DetailPages["department"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_department"];
			$url = "departmentpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"department\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("department", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"department\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("departmentlist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "&fk_ProvinceCode=" . urlencode(strval($this->ProvinceCode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("department", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["department_grid"]))
				$GLOBALS["department_grid"] = new department_grid();
			if ($GLOBALS["department_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=department");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["department_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=department");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_council_meeting"
		if ($this->DetailPages && $this->DetailPages["council_meeting"] && $this->DetailPages["council_meeting"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_council_meeting"];
			$url = "council_meetingpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"council_meeting\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("council_meeting", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"council_meeting\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("council_meetinglist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("council_meeting", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["council_meeting_grid"]))
				$GLOBALS["council_meeting_grid"] = new council_meeting_grid();
			if ($GLOBALS["council_meeting_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=council_meeting");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["council_meeting_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=council_meeting");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`ProvinceCode`=" . AdjustSql($this->ProvinceCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_asset"
		if ($this->DetailPages && $this->DetailPages["asset"] && $this->DetailPages["asset"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_asset"];
			$url = "assetpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"asset\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("asset", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"asset\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("assetlist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_ProvinceCode=" . urlencode(strval($this->ProvinceCode->CurrentValue)) . "&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("asset", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["asset_grid"]))
				$GLOBALS["asset_grid"] = new asset_grid();
			if ($GLOBALS["asset_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=asset");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["asset_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=asset");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`ProvinceCode`=" . AdjustSql($this->ProvinceCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_ward"
		if ($this->DetailPages && $this->DetailPages["ward"] && $this->DetailPages["ward"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_ward"];
			$url = "wardpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"ward\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("ward", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"ward\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("wardlist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_ProvinceCode=" . urlencode(strval($this->ProvinceCode->CurrentValue)) . "&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("ward", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["ward_grid"]))
				$GLOBALS["ward_grid"] = new ward_grid();
			if ($GLOBALS["ward_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=ward");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["ward_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=ward");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_budget_actual"
		if ($this->DetailPages && $this->DetailPages["budget_actual"] && $this->DetailPages["budget_actual"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_budget_actual"];
			$url = "budget_actualpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"budget_actual\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("budget_actual", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"budget_actual\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("budget_actuallist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("budget_actual", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["budget_actual_grid"]))
				$GLOBALS["budget_actual_grid"] = new budget_actual_grid();
			if ($GLOBALS["budget_actual_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=budget_actual");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["budget_actual_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=budget_actual");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";
		$sqlwrk = $sqlwrk . " AND " . "`ProvinceCode`=" . AdjustSql($this->ProvinceCode->CurrentValue, $this->Dbid) . "";

		// Column "detail_councillorship"
		if ($this->DetailPages && $this->DetailPages["councillorship"] && $this->DetailPages["councillorship"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_councillorship"];
			$url = "councillorshippreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"councillorship\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("councillorship", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"councillorship\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("councillorshiplist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "&fk_ProvinceCode=" . urlencode(strval($this->ProvinceCode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("councillorship", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["councillorship_grid"]))
				$GLOBALS["councillorship_grid"] = new councillorship_grid();
			if ($GLOBALS["councillorship_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=councillorship");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["councillorship_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=councillorship");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_monthly_run"
		if ($this->DetailPages && $this->DetailPages["monthly_run"] && $this->DetailPages["monthly_run"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_monthly_run"];
			$url = "monthly_runpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"monthly_run\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("monthly_run", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"monthly_run\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("monthly_runlist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("monthly_run", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["monthly_run_grid"]))
				$GLOBALS["monthly_run_grid"] = new monthly_run_grid();
			if ($GLOBALS["monthly_run_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=monthly_run");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["monthly_run_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=monthly_run");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`ProvinceCode`=" . AdjustSql($this->ProvinceCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_project"
		if ($this->DetailPages && $this->DetailPages["project"] && $this->DetailPages["project"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_project"];
			$url = "projectpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"project\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("project", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"project\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("projectlist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_ProvinceCode=" . urlencode(strval($this->ProvinceCode->CurrentValue)) . "&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("project", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["project_grid"]))
				$GLOBALS["project_grid"] = new project_grid();
			if ($GLOBALS["project_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=project");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["project_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=project");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_la_bank_account"
		if ($this->DetailPages && $this->DetailPages["la_bank_account"] && $this->DetailPages["la_bank_account"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_la_bank_account"];
			$url = "la_bank_accountpreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"la_bank_account\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("la_bank_account", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"la_bank_account\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("la_bank_accountlist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("la_bank_account", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["la_bank_account_grid"]))
				$GLOBALS["la_bank_account_grid"] = new la_bank_account_grid();
			if ($GLOBALS["la_bank_account_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=la_bank_account");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["la_bank_account_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=la_bank_account");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_strategic_objective"
		if ($this->DetailPages && $this->DetailPages["strategic_objective"] && $this->DetailPages["strategic_objective"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_strategic_objective"];
			$url = "strategic_objectivepreview.php?t=local_authority&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"strategic_objective\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'local_authority')) {
				$label = $Language->TablePhrase("strategic_objective", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"strategic_objective\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("strategic_objectivelist.php?" . Config("TABLE_SHOW_MASTER") . "=local_authority&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("strategic_objective", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["strategic_objective_grid"]))
				$GLOBALS["strategic_objective_grid"] = new strategic_objective_grid();
			if ($GLOBALS["strategic_objective_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=strategic_objective");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["strategic_objective_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'local_authority')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=strategic_objective");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}

		// Hide detail items if necessary
		$this->ListOptions->hideDetailItemsForDropDown();

		// Column "preview"
		$option = $this->ListOptions["preview"];
		if (!$option) { // Add preview column
			$option = &$this->ListOptions->add("preview");
			$option->OnLeft = TRUE;
			if ($option->OnLeft) {
				$option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
			} else {
				$option->moveTo($this->ListOptions->itemPos("checkbox"));
			}
			$option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
			$option->ShowInDropDown = FALSE;
			$option->ShowInButtonGroup = FALSE;
		}
		if ($option) {
			$option->Body = "<i class=\"ew-preview-row-btn ew-icon icon-expand\"></i>";
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}

		// Column "details" (Multiple details)
		$option = $this->ListOptions["details"];
		if ($option) {
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->LAName->CurrentValue = NULL;
		$this->LAName->OldValue = $this->LAName->CurrentValue;
		$this->CouncilType->CurrentValue = 1;
		$this->CouncilType->OldValue = $this->CouncilType->CurrentValue;
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->Created->CurrentValue = NULL;
		$this->Created->OldValue = $this->Created->CurrentValue;
		$this->OpeningDate->CurrentValue = NULL;
		$this->OpeningDate->OldValue = $this->OpeningDate->CurrentValue;
		$this->ClosedDate->CurrentValue = NULL;
		$this->ClosedDate->OldValue = $this->ClosedDate->CurrentValue;
		$this->OrgUnitLevel->CurrentValue = 5;
		$this->OrgUnitLevel->OldValue = $this->OrgUnitLevel->CurrentValue;
		$this->Mandate->CurrentValue = NULL;
		$this->Mandate->OldValue = $this->Mandate->CurrentValue;
		$this->Strategy->CurrentValue = NULL;
		$this->Strategy->OldValue = $this->Strategy->CurrentValue;
		$this->Clients->CurrentValue = NULL;
		$this->Clients->OldValue = $this->Clients->CurrentValue;
		$this->Beneficiaries->CurrentValue = NULL;
		$this->Beneficiaries->OldValue = $this->Beneficiaries->CurrentValue;
		$this->ExecutiveAuthority->CurrentValue = NULL;
		$this->ExecutiveAuthority->OldValue = $this->ExecutiveAuthority->CurrentValue;
		$this->ControllingOfficer->CurrentValue = NULL;
		$this->ControllingOfficer->OldValue = $this->ControllingOfficer->CurrentValue;
		$this->Comment->CurrentValue = NULL;
		$this->Comment->OldValue = $this->Comment->CurrentValue;
		$this->LastUpdated->CurrentValue = NULL;
		$this->LastUpdated->OldValue = $this->LastUpdated->CurrentValue;
		$this->LastUserId->CurrentValue = NULL;
		$this->LastUserId->OldValue = $this->LastUserId->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

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

		// Check field name 'CouncilType' first before field var 'x_CouncilType'
		$val = $CurrentForm->hasValue("CouncilType") ? $CurrentForm->getValue("CouncilType") : $CurrentForm->getValue("x_CouncilType");
		if (!$this->CouncilType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CouncilType->Visible = FALSE; // Disable update for API request
			else
				$this->CouncilType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CouncilType"))
			$this->CouncilType->setOldValue($CurrentForm->getValue("o_CouncilType"));

		// Check field name 'ProvinceCode' first before field var 'x_ProvinceCode'
		$val = $CurrentForm->hasValue("ProvinceCode") ? $CurrentForm->getValue("ProvinceCode") : $CurrentForm->getValue("x_ProvinceCode");
		if (!$this->ProvinceCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProvinceCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProvinceCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProvinceCode"))
			$this->ProvinceCode->setOldValue($CurrentForm->getValue("o_ProvinceCode"));

		// Check field name 'Clients' first before field var 'x_Clients'
		$val = $CurrentForm->hasValue("Clients") ? $CurrentForm->getValue("Clients") : $CurrentForm->getValue("x_Clients");
		if (!$this->Clients->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Clients->Visible = FALSE; // Disable update for API request
			else
				$this->Clients->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Clients"))
			$this->Clients->setOldValue($CurrentForm->getValue("o_Clients"));

		// Check field name 'Beneficiaries' first before field var 'x_Beneficiaries'
		$val = $CurrentForm->hasValue("Beneficiaries") ? $CurrentForm->getValue("Beneficiaries") : $CurrentForm->getValue("x_Beneficiaries");
		if (!$this->Beneficiaries->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Beneficiaries->Visible = FALSE; // Disable update for API request
			else
				$this->Beneficiaries->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Beneficiaries"))
			$this->Beneficiaries->setOldValue($CurrentForm->getValue("o_Beneficiaries"));

		// Check field name 'ExecutiveAuthority' first before field var 'x_ExecutiveAuthority'
		$val = $CurrentForm->hasValue("ExecutiveAuthority") ? $CurrentForm->getValue("ExecutiveAuthority") : $CurrentForm->getValue("x_ExecutiveAuthority");
		if (!$this->ExecutiveAuthority->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExecutiveAuthority->Visible = FALSE; // Disable update for API request
			else
				$this->ExecutiveAuthority->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ExecutiveAuthority"))
			$this->ExecutiveAuthority->setOldValue($CurrentForm->getValue("o_ExecutiveAuthority"));

		// Check field name 'ControllingOfficer' first before field var 'x_ControllingOfficer'
		$val = $CurrentForm->hasValue("ControllingOfficer") ? $CurrentForm->getValue("ControllingOfficer") : $CurrentForm->getValue("x_ControllingOfficer");
		if (!$this->ControllingOfficer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ControllingOfficer->Visible = FALSE; // Disable update for API request
			else
				$this->ControllingOfficer->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ControllingOfficer"))
			$this->ControllingOfficer->setOldValue($CurrentForm->getValue("o_ControllingOfficer"));

		// Check field name 'Comment' first before field var 'x_Comment'
		$val = $CurrentForm->hasValue("Comment") ? $CurrentForm->getValue("Comment") : $CurrentForm->getValue("x_Comment");
		if (!$this->Comment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Comment->Visible = FALSE; // Disable update for API request
			else
				$this->Comment->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Comment"))
			$this->Comment->setOldValue($CurrentForm->getValue("o_Comment"));

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey)
			$this->LACode->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->LAName->CurrentValue = $this->LAName->FormValue;
		$this->CouncilType->CurrentValue = $this->CouncilType->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->Clients->CurrentValue = $this->Clients->FormValue;
		$this->Beneficiaries->CurrentValue = $this->Beneficiaries->FormValue;
		$this->ExecutiveAuthority->CurrentValue = $this->ExecutiveAuthority->FormValue;
		$this->ControllingOfficer->CurrentValue = $this->ControllingOfficer->FormValue;
		$this->Comment->CurrentValue = $this->Comment->FormValue;
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
		$this->LACode->setDbValue($row['LACode']);
		$this->LAName->setDbValue($row['LAName']);
		$this->CouncilType->setDbValue($row['CouncilType']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->Created->setDbValue($row['Created']);
		$this->OpeningDate->setDbValue($row['OpeningDate']);
		$this->ClosedDate->setDbValue($row['ClosedDate']);
		$this->OrgUnitLevel->setDbValue($row['OrgUnitLevel']);
		$this->Mandate->setDbValue($row['Mandate']);
		$this->Strategy->setDbValue($row['Strategy']);
		$this->Clients->setDbValue($row['Clients']);
		$this->Beneficiaries->setDbValue($row['Beneficiaries']);
		$this->ExecutiveAuthority->setDbValue($row['ExecutiveAuthority']);
		$this->ControllingOfficer->setDbValue($row['ControllingOfficer']);
		$this->Comment->setDbValue($row['Comment']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->LastUserId->setDbValue($row['LastUserId']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['LAName'] = $this->LAName->CurrentValue;
		$row['CouncilType'] = $this->CouncilType->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['Created'] = $this->Created->CurrentValue;
		$row['OpeningDate'] = $this->OpeningDate->CurrentValue;
		$row['ClosedDate'] = $this->ClosedDate->CurrentValue;
		$row['OrgUnitLevel'] = $this->OrgUnitLevel->CurrentValue;
		$row['Mandate'] = $this->Mandate->CurrentValue;
		$row['Strategy'] = $this->Strategy->CurrentValue;
		$row['Clients'] = $this->Clients->CurrentValue;
		$row['Beneficiaries'] = $this->Beneficiaries->CurrentValue;
		$row['ExecutiveAuthority'] = $this->ExecutiveAuthority->CurrentValue;
		$row['ControllingOfficer'] = $this->ControllingOfficer->CurrentValue;
		$row['Comment'] = $this->Comment->CurrentValue;
		$row['LastUpdated'] = $this->LastUpdated->CurrentValue;
		$row['LastUserId'] = $this->LastUserId->CurrentValue;
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
				$this->LACode->OldValue = strval($keys[0]); // LACode
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LACode
		// LAName
		// CouncilType
		// ProvinceCode
		// Created
		// OpeningDate
		// ClosedDate
		// OrgUnitLevel
		// Mandate
		// Strategy
		// Clients
		// Beneficiaries
		// ExecutiveAuthority
		// ControllingOfficer
		// Comment
		// LastUpdated
		// LastUserId

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewCustomAttributes = "";

			// LAName
			$this->LAName->ViewValue = $this->LAName->CurrentValue;
			$this->LAName->ViewCustomAttributes = "";

			// CouncilType
			$curVal = strval($this->CouncilType->CurrentValue);
			if ($curVal != "") {
				$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
				if ($this->CouncilType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LAType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CouncilType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CouncilType->ViewValue = $this->CouncilType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CouncilType->ViewValue = $this->CouncilType->CurrentValue;
					}
				}
			} else {
				$this->CouncilType->ViewValue = NULL;
			}
			$this->CouncilType->ViewCustomAttributes = "";

			// ProvinceCode
			$curVal = strval($this->ProvinceCode->CurrentValue);
			if ($curVal != "") {
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
					}
				}
			} else {
				$this->ProvinceCode->ViewValue = NULL;
			}
			$this->ProvinceCode->ViewCustomAttributes = "";

			// Clients
			$this->Clients->ViewValue = $this->Clients->CurrentValue;
			$this->Clients->ViewCustomAttributes = "";

			// Beneficiaries
			$this->Beneficiaries->ViewValue = $this->Beneficiaries->CurrentValue;
			$this->Beneficiaries->ViewCustomAttributes = "";

			// ExecutiveAuthority
			$this->ExecutiveAuthority->ViewValue = $this->ExecutiveAuthority->CurrentValue;
			$this->ExecutiveAuthority->ViewCustomAttributes = "";

			// ControllingOfficer
			$this->ControllingOfficer->ViewValue = $this->ControllingOfficer->CurrentValue;
			$this->ControllingOfficer->ViewCustomAttributes = "";

			// Comment
			$this->Comment->ViewValue = $this->Comment->CurrentValue;
			$this->Comment->ViewCustomAttributes = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";
			$this->LAName->TooltipValue = "";
			if (!$this->isExport())
				$this->LAName->ViewValue = $this->highlightValue($this->LAName);

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";
			$this->CouncilType->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";
			$this->Clients->TooltipValue = "";
			if (!$this->isExport())
				$this->Clients->ViewValue = $this->highlightValue($this->Clients);

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";
			$this->Beneficiaries->TooltipValue = "";
			if (!$this->isExport())
				$this->Beneficiaries->ViewValue = $this->highlightValue($this->Beneficiaries);

			// ExecutiveAuthority
			$this->ExecutiveAuthority->LinkCustomAttributes = "";
			$this->ExecutiveAuthority->HrefValue = "";
			$this->ExecutiveAuthority->TooltipValue = "";
			if (!$this->isExport())
				$this->ExecutiveAuthority->ViewValue = $this->highlightValue($this->ExecutiveAuthority);

			// ControllingOfficer
			$this->ControllingOfficer->LinkCustomAttributes = "";
			$this->ControllingOfficer->HrefValue = "";
			$this->ControllingOfficer->TooltipValue = "";
			if (!$this->isExport())
				$this->ControllingOfficer->ViewValue = $this->highlightValue($this->ControllingOfficer);

			// Comment
			$this->Comment->LinkCustomAttributes = "";
			$this->Comment->HrefValue = "";
			$this->Comment->TooltipValue = "";
			if (!$this->isExport())
				$this->Comment->ViewValue = $this->highlightValue($this->Comment);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->CurrentValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// CouncilType
			$this->CouncilType->EditAttrs["class"] = "form-control";
			$this->CouncilType->EditCustomAttributes = "";
			$curVal = trim(strval($this->CouncilType->CurrentValue));
			if ($curVal != "")
				$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
			else
				$this->CouncilType->ViewValue = $this->CouncilType->Lookup !== NULL && is_array($this->CouncilType->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncilType->ViewValue !== NULL) { // Load from cache
				$this->CouncilType->EditValue = array_values($this->CouncilType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LAType`" . SearchString("=", $this->CouncilType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CouncilType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CouncilType->EditValue = $arwrk;
			}

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
				$curVal = strval($this->ProvinceCode->CurrentValue);
				if ($curVal != "") {
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
					if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
						}
					}
				} else {
					$this->ProvinceCode->ViewValue = NULL;
				}
				$this->ProvinceCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ProvinceCode->CurrentValue));
				if ($curVal != "")
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				else
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProvinceCode->ViewValue !== NULL) { // Load from cache
					$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProvinceCode->EditValue = $arwrk;
				}
			}

			// Clients
			$this->Clients->EditAttrs["class"] = "form-control";
			$this->Clients->EditCustomAttributes = "";
			$this->Clients->EditValue = HtmlEncode($this->Clients->CurrentValue);
			$this->Clients->PlaceHolder = RemoveHtml($this->Clients->caption());

			// Beneficiaries
			$this->Beneficiaries->EditAttrs["class"] = "form-control";
			$this->Beneficiaries->EditCustomAttributes = "";
			$this->Beneficiaries->EditValue = HtmlEncode($this->Beneficiaries->CurrentValue);
			$this->Beneficiaries->PlaceHolder = RemoveHtml($this->Beneficiaries->caption());

			// ExecutiveAuthority
			$this->ExecutiveAuthority->EditAttrs["class"] = "form-control";
			$this->ExecutiveAuthority->EditCustomAttributes = "";
			if (!$this->ExecutiveAuthority->Raw)
				$this->ExecutiveAuthority->CurrentValue = HtmlDecode($this->ExecutiveAuthority->CurrentValue);
			$this->ExecutiveAuthority->EditValue = HtmlEncode($this->ExecutiveAuthority->CurrentValue);
			$this->ExecutiveAuthority->PlaceHolder = RemoveHtml($this->ExecutiveAuthority->caption());

			// ControllingOfficer
			$this->ControllingOfficer->EditAttrs["class"] = "form-control";
			$this->ControllingOfficer->EditCustomAttributes = "";
			if (!$this->ControllingOfficer->Raw)
				$this->ControllingOfficer->CurrentValue = HtmlDecode($this->ControllingOfficer->CurrentValue);
			$this->ControllingOfficer->EditValue = HtmlEncode($this->ControllingOfficer->CurrentValue);
			$this->ControllingOfficer->PlaceHolder = RemoveHtml($this->ControllingOfficer->caption());

			// Comment
			$this->Comment->EditAttrs["class"] = "form-control";
			$this->Comment->EditCustomAttributes = "";
			$this->Comment->EditValue = HtmlEncode($this->Comment->CurrentValue);
			$this->Comment->PlaceHolder = RemoveHtml($this->Comment->caption());

			// Add refer script
			// LAName

			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";

			// ExecutiveAuthority
			$this->ExecutiveAuthority->LinkCustomAttributes = "";
			$this->ExecutiveAuthority->HrefValue = "";

			// ControllingOfficer
			$this->ControllingOfficer->LinkCustomAttributes = "";
			$this->ControllingOfficer->HrefValue = "";

			// Comment
			$this->Comment->LinkCustomAttributes = "";
			$this->Comment->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->CurrentValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// CouncilType
			$this->CouncilType->EditAttrs["class"] = "form-control";
			$this->CouncilType->EditCustomAttributes = "";
			$curVal = trim(strval($this->CouncilType->CurrentValue));
			if ($curVal != "")
				$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
			else
				$this->CouncilType->ViewValue = $this->CouncilType->Lookup !== NULL && is_array($this->CouncilType->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncilType->ViewValue !== NULL) { // Load from cache
				$this->CouncilType->EditValue = array_values($this->CouncilType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LAType`" . SearchString("=", $this->CouncilType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CouncilType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CouncilType->EditValue = $arwrk;
			}

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
				$curVal = strval($this->ProvinceCode->CurrentValue);
				if ($curVal != "") {
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
					if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
						}
					}
				} else {
					$this->ProvinceCode->ViewValue = NULL;
				}
				$this->ProvinceCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ProvinceCode->CurrentValue));
				if ($curVal != "")
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				else
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProvinceCode->ViewValue !== NULL) { // Load from cache
					$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProvinceCode->EditValue = $arwrk;
				}
			}

			// Clients
			$this->Clients->EditAttrs["class"] = "form-control";
			$this->Clients->EditCustomAttributes = "";
			$this->Clients->EditValue = HtmlEncode($this->Clients->CurrentValue);
			$this->Clients->PlaceHolder = RemoveHtml($this->Clients->caption());

			// Beneficiaries
			$this->Beneficiaries->EditAttrs["class"] = "form-control";
			$this->Beneficiaries->EditCustomAttributes = "";
			$this->Beneficiaries->EditValue = HtmlEncode($this->Beneficiaries->CurrentValue);
			$this->Beneficiaries->PlaceHolder = RemoveHtml($this->Beneficiaries->caption());

			// ExecutiveAuthority
			$this->ExecutiveAuthority->EditAttrs["class"] = "form-control";
			$this->ExecutiveAuthority->EditCustomAttributes = "";
			if (!$this->ExecutiveAuthority->Raw)
				$this->ExecutiveAuthority->CurrentValue = HtmlDecode($this->ExecutiveAuthority->CurrentValue);
			$this->ExecutiveAuthority->EditValue = HtmlEncode($this->ExecutiveAuthority->CurrentValue);
			$this->ExecutiveAuthority->PlaceHolder = RemoveHtml($this->ExecutiveAuthority->caption());

			// ControllingOfficer
			$this->ControllingOfficer->EditAttrs["class"] = "form-control";
			$this->ControllingOfficer->EditCustomAttributes = "";
			if (!$this->ControllingOfficer->Raw)
				$this->ControllingOfficer->CurrentValue = HtmlDecode($this->ControllingOfficer->CurrentValue);
			$this->ControllingOfficer->EditValue = HtmlEncode($this->ControllingOfficer->CurrentValue);
			$this->ControllingOfficer->PlaceHolder = RemoveHtml($this->ControllingOfficer->caption());

			// Comment
			$this->Comment->EditAttrs["class"] = "form-control";
			$this->Comment->EditCustomAttributes = "";
			$this->Comment->EditValue = HtmlEncode($this->Comment->CurrentValue);
			$this->Comment->PlaceHolder = RemoveHtml($this->Comment->caption());

			// Edit refer script
			// LAName

			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";

			// ExecutiveAuthority
			$this->ExecutiveAuthority->LinkCustomAttributes = "";
			$this->ExecutiveAuthority->HrefValue = "";

			// ControllingOfficer
			$this->ControllingOfficer->LinkCustomAttributes = "";
			$this->ControllingOfficer->HrefValue = "";

			// Comment
			$this->Comment->LinkCustomAttributes = "";
			$this->Comment->HrefValue = "";
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
		if ($this->LAName->Required) {
			if (!$this->LAName->IsDetailKey && $this->LAName->FormValue != NULL && $this->LAName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LAName->caption(), $this->LAName->RequiredErrorMessage));
			}
		}
		if ($this->CouncilType->Required) {
			if (!$this->CouncilType->IsDetailKey && $this->CouncilType->FormValue != NULL && $this->CouncilType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncilType->caption(), $this->CouncilType->RequiredErrorMessage));
			}
		}
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
		if ($this->Clients->Required) {
			if (!$this->Clients->IsDetailKey && $this->Clients->FormValue != NULL && $this->Clients->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Clients->caption(), $this->Clients->RequiredErrorMessage));
			}
		}
		if ($this->Beneficiaries->Required) {
			if (!$this->Beneficiaries->IsDetailKey && $this->Beneficiaries->FormValue != NULL && $this->Beneficiaries->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Beneficiaries->caption(), $this->Beneficiaries->RequiredErrorMessage));
			}
		}
		if ($this->ExecutiveAuthority->Required) {
			if (!$this->ExecutiveAuthority->IsDetailKey && $this->ExecutiveAuthority->FormValue != NULL && $this->ExecutiveAuthority->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExecutiveAuthority->caption(), $this->ExecutiveAuthority->RequiredErrorMessage));
			}
		}
		if ($this->ControllingOfficer->Required) {
			if (!$this->ControllingOfficer->IsDetailKey && $this->ControllingOfficer->FormValue != NULL && $this->ControllingOfficer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ControllingOfficer->caption(), $this->ControllingOfficer->RequiredErrorMessage));
			}
		}
		if ($this->Comment->Required) {
			if (!$this->Comment->IsDetailKey && $this->Comment->FormValue != NULL && $this->Comment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Comment->caption(), $this->Comment->RequiredErrorMessage));
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
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

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
				$thisKey .= $row['LACode'];
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

			// LAName
			$this->LAName->setDbValueDef($rsnew, $this->LAName->CurrentValue, "", $this->LAName->ReadOnly);

			// CouncilType
			$this->CouncilType->setDbValueDef($rsnew, $this->CouncilType->CurrentValue, NULL, $this->CouncilType->ReadOnly);

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, $this->ProvinceCode->ReadOnly);

			// Clients
			$this->Clients->setDbValueDef($rsnew, $this->Clients->CurrentValue, "", $this->Clients->ReadOnly);

			// Beneficiaries
			$this->Beneficiaries->setDbValueDef($rsnew, $this->Beneficiaries->CurrentValue, "", $this->Beneficiaries->ReadOnly);

			// ExecutiveAuthority
			$this->ExecutiveAuthority->setDbValueDef($rsnew, $this->ExecutiveAuthority->CurrentValue, "", $this->ExecutiveAuthority->ReadOnly);

			// ControllingOfficer
			$this->ControllingOfficer->setDbValueDef($rsnew, $this->ControllingOfficer->CurrentValue, "", $this->ControllingOfficer->ReadOnly);

			// Comment
			$this->Comment->setDbValueDef($rsnew, $this->Comment->CurrentValue, NULL, $this->Comment->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "province") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// LAName
		$this->LAName->setDbValueDef($rsnew, $this->LAName->CurrentValue, "", FALSE);

		// CouncilType
		$this->CouncilType->setDbValueDef($rsnew, $this->CouncilType->CurrentValue, NULL, strval($this->CouncilType->CurrentValue) == "");

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, FALSE);

		// Clients
		$this->Clients->setDbValueDef($rsnew, $this->Clients->CurrentValue, "", FALSE);

		// Beneficiaries
		$this->Beneficiaries->setDbValueDef($rsnew, $this->Beneficiaries->CurrentValue, "", FALSE);

		// ExecutiveAuthority
		$this->ExecutiveAuthority->setDbValueDef($rsnew, $this->ExecutiveAuthority->CurrentValue, "", FALSE);

		// ControllingOfficer
		$this->ControllingOfficer->setDbValueDef($rsnew, $this->ControllingOfficer->CurrentValue, "", FALSE);

		// Comment
		$this->Comment->setDbValueDef($rsnew, $this->Comment->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['LACode']) == "") {
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
		if ($masterTblVar == "province") {
			$this->ProvinceCode->Visible = FALSE;
			if ($GLOBALS["province"]->EventCancelled)
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
				case "x_CouncilType":
					break;
				case "x_ProvinceCode":
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
						case "x_CouncilType":
							break;
						case "x_ProvinceCode":
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