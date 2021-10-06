<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class _account_ref_master_grid extends _account_ref_master
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'account_ref_master';

	// Page object name
	public $PageObjName = "_account_ref_master_grid";

	// Grid form hidden field names
	public $FormName = "f_account_ref_mastergrid";
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

		// Table object (_account_ref_master)
		if (!isset($GLOBALS["_account_ref_master"]) || get_class($GLOBALS["_account_ref_master"]) == PROJECT_NAMESPACE . "_account_ref_master") {
			$GLOBALS["_account_ref_master"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["_account_ref_master"];

		}
		$this->AddUrl = "_account_ref_masteradd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'account_ref_master');

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
		global $_account_ref_master;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($_account_ref_master);
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
			$key .= @$ar['AccountCode'];
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
		$this->AccountCode->setVisibility();
		$this->AccountName->setVisibility();
		$this->AccountGroupCode->setVisibility();
		$this->AccountDesc->setVisibility();
		$this->Amount->setVisibility();
		$this->AccountType->setVisibility();
		$this->AccountSubGroupCode->setVisibility();
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
		$this->setupLookupOptions($this->AccountGroupCode);
		$this->setupLookupOptions($this->AccountType);
		$this->setupLookupOptions($this->AccountSubGroupCode);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "account_sub_group") {
			global $account_sub_group;
			$rsmaster = $account_sub_group->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("account_sub_grouplist.php"); // Return to master page
			} else {
				$account_sub_group->loadListRowValues($rsmaster);
				$account_sub_group->RowType = ROWTYPE_MASTER; // Master row
				$account_sub_group->renderListRow();
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
		if (count($arKeyFlds) >= 1) {
			$this->AccountCode->setOldValue($arKeyFlds[0]);
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
					$key .= $this->AccountCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_AccountCode") && $CurrentForm->hasValue("o_AccountCode") && $this->AccountCode->CurrentValue != $this->AccountCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountName") && $CurrentForm->hasValue("o_AccountName") && $this->AccountName->CurrentValue != $this->AccountName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountGroupCode") && $CurrentForm->hasValue("o_AccountGroupCode") && $this->AccountGroupCode->CurrentValue != $this->AccountGroupCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountDesc") && $CurrentForm->hasValue("o_AccountDesc") && $this->AccountDesc->CurrentValue != $this->AccountDesc->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Amount") && $CurrentForm->hasValue("o_Amount") && $this->Amount->CurrentValue != $this->Amount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountType") && $CurrentForm->hasValue("o_AccountType") && $this->AccountType->CurrentValue != $this->AccountType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountSubGroupCode") && $CurrentForm->hasValue("o_AccountSubGroupCode") && $this->AccountSubGroupCode->CurrentValue != $this->AccountSubGroupCode->OldValue)
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
				$this->AccountType->setSessionValue("");
				$this->AccountGroupCode->setSessionValue("");
				$this->AccountSubGroupCode->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->AccountCode->CurrentValue . "\">";
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
		$key .= $rs->fields('AccountCode');
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
		$this->AccountCode->CurrentValue = NULL;
		$this->AccountCode->OldValue = $this->AccountCode->CurrentValue;
		$this->AccountName->CurrentValue = NULL;
		$this->AccountName->OldValue = $this->AccountName->CurrentValue;
		$this->AccountGroupCode->CurrentValue = NULL;
		$this->AccountGroupCode->OldValue = $this->AccountGroupCode->CurrentValue;
		$this->AccountDesc->CurrentValue = NULL;
		$this->AccountDesc->OldValue = $this->AccountDesc->CurrentValue;
		$this->Amount->CurrentValue = NULL;
		$this->Amount->OldValue = $this->Amount->CurrentValue;
		$this->AccountType->CurrentValue = NULL;
		$this->AccountType->OldValue = $this->AccountType->CurrentValue;
		$this->AccountSubGroupCode->CurrentValue = NULL;
		$this->AccountSubGroupCode->OldValue = $this->AccountSubGroupCode->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'AccountCode' first before field var 'x_AccountCode'
		$val = $CurrentForm->hasValue("AccountCode") ? $CurrentForm->getValue("AccountCode") : $CurrentForm->getValue("x_AccountCode");
		if (!$this->AccountCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountCode->Visible = FALSE; // Disable update for API request
			else
				$this->AccountCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountCode"))
			$this->AccountCode->setOldValue($CurrentForm->getValue("o_AccountCode"));

		// Check field name 'AccountName' first before field var 'x_AccountName'
		$val = $CurrentForm->hasValue("AccountName") ? $CurrentForm->getValue("AccountName") : $CurrentForm->getValue("x_AccountName");
		if (!$this->AccountName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountName->Visible = FALSE; // Disable update for API request
			else
				$this->AccountName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountName"))
			$this->AccountName->setOldValue($CurrentForm->getValue("o_AccountName"));

		// Check field name 'AccountGroupCode' first before field var 'x_AccountGroupCode'
		$val = $CurrentForm->hasValue("AccountGroupCode") ? $CurrentForm->getValue("AccountGroupCode") : $CurrentForm->getValue("x_AccountGroupCode");
		if (!$this->AccountGroupCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountGroupCode->Visible = FALSE; // Disable update for API request
			else
				$this->AccountGroupCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountGroupCode"))
			$this->AccountGroupCode->setOldValue($CurrentForm->getValue("o_AccountGroupCode"));

		// Check field name 'AccountDesc' first before field var 'x_AccountDesc'
		$val = $CurrentForm->hasValue("AccountDesc") ? $CurrentForm->getValue("AccountDesc") : $CurrentForm->getValue("x_AccountDesc");
		if (!$this->AccountDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountDesc->Visible = FALSE; // Disable update for API request
			else
				$this->AccountDesc->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountDesc"))
			$this->AccountDesc->setOldValue($CurrentForm->getValue("o_AccountDesc"));

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

		// Check field name 'AccountType' first before field var 'x_AccountType'
		$val = $CurrentForm->hasValue("AccountType") ? $CurrentForm->getValue("AccountType") : $CurrentForm->getValue("x_AccountType");
		if (!$this->AccountType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountType->Visible = FALSE; // Disable update for API request
			else
				$this->AccountType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountType"))
			$this->AccountType->setOldValue($CurrentForm->getValue("o_AccountType"));

		// Check field name 'AccountSubGroupCode' first before field var 'x_AccountSubGroupCode'
		$val = $CurrentForm->hasValue("AccountSubGroupCode") ? $CurrentForm->getValue("AccountSubGroupCode") : $CurrentForm->getValue("x_AccountSubGroupCode");
		if (!$this->AccountSubGroupCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountSubGroupCode->Visible = FALSE; // Disable update for API request
			else
				$this->AccountSubGroupCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountSubGroupCode"))
			$this->AccountSubGroupCode->setOldValue($CurrentForm->getValue("o_AccountSubGroupCode"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->AccountCode->CurrentValue = $this->AccountCode->FormValue;
		$this->AccountName->CurrentValue = $this->AccountName->FormValue;
		$this->AccountGroupCode->CurrentValue = $this->AccountGroupCode->FormValue;
		$this->AccountDesc->CurrentValue = $this->AccountDesc->FormValue;
		$this->Amount->CurrentValue = $this->Amount->FormValue;
		$this->AccountType->CurrentValue = $this->AccountType->FormValue;
		$this->AccountSubGroupCode->CurrentValue = $this->AccountSubGroupCode->FormValue;
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
		$this->AccountCode->setDbValue($row['AccountCode']);
		$this->AccountName->setDbValue($row['AccountName']);
		$this->AccountGroupCode->setDbValue($row['AccountGroupCode']);
		$this->AccountDesc->setDbValue($row['AccountDesc']);
		$this->Amount->setDbValue($row['Amount']);
		$this->AccountType->setDbValue($row['AccountType']);
		$this->AccountSubGroupCode->setDbValue($row['AccountSubGroupCode']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['AccountCode'] = $this->AccountCode->CurrentValue;
		$row['AccountName'] = $this->AccountName->CurrentValue;
		$row['AccountGroupCode'] = $this->AccountGroupCode->CurrentValue;
		$row['AccountDesc'] = $this->AccountDesc->CurrentValue;
		$row['Amount'] = $this->Amount->CurrentValue;
		$row['AccountType'] = $this->AccountType->CurrentValue;
		$row['AccountSubGroupCode'] = $this->AccountSubGroupCode->CurrentValue;
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
				$this->AccountCode->OldValue = strval($keys[0]); // AccountCode
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
		// AccountCode
		// AccountName
		// AccountGroupCode
		// AccountDesc
		// Amount
		// AccountType
		// AccountSubGroupCode

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// AccountCode
			$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
			$this->AccountCode->ViewCustomAttributes = "";

			// AccountName
			$this->AccountName->ViewValue = $this->AccountName->CurrentValue;
			$this->AccountName->ViewCustomAttributes = "";

			// AccountGroupCode
			$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
			$curVal = strval($this->AccountGroupCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->lookupCacheOption($curVal);
				if ($this->AccountGroupCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
					}
				}
			} else {
				$this->AccountGroupCode->ViewValue = NULL;
			}
			$this->AccountGroupCode->ViewCustomAttributes = "";

			// AccountDesc
			$this->AccountDesc->ViewValue = $this->AccountDesc->CurrentValue;
			$this->AccountDesc->ViewCustomAttributes = "";

			// Amount
			$this->Amount->ViewValue = $this->Amount->CurrentValue;
			$this->Amount->ViewValue = FormatNumber($this->Amount->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Amount->ViewCustomAttributes = "";

			// AccountType
			$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
			$curVal = strval($this->AccountType->CurrentValue);
			if ($curVal != "") {
				$this->AccountType->ViewValue = $this->AccountType->lookupCacheOption($curVal);
				if ($this->AccountType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountType->ViewValue = $this->AccountType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
					}
				}
			} else {
				$this->AccountType->ViewValue = NULL;
			}
			$this->AccountType->ViewCustomAttributes = "";

			// AccountSubGroupCode
			$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
			$curVal = strval($this->AccountSubGroupCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->lookupCacheOption($curVal);
				if ($this->AccountSubGroupCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountSubGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AccountSubGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
					}
				}
			} else {
				$this->AccountSubGroupCode->ViewValue = NULL;
			}
			$this->AccountSubGroupCode->ViewCustomAttributes = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";
			$this->AccountCode->TooltipValue = "";
			if (!$this->isExport())
				$this->AccountCode->ViewValue = $this->highlightValue($this->AccountCode);

			// AccountName
			$this->AccountName->LinkCustomAttributes = "";
			$this->AccountName->HrefValue = "";
			$this->AccountName->TooltipValue = "";
			if (!$this->isExport())
				$this->AccountName->ViewValue = $this->highlightValue($this->AccountName);

			// AccountGroupCode
			$this->AccountGroupCode->LinkCustomAttributes = "";
			$this->AccountGroupCode->HrefValue = "";
			$this->AccountGroupCode->TooltipValue = "";
			if (!$this->isExport())
				$this->AccountGroupCode->ViewValue = $this->highlightValue($this->AccountGroupCode);

			// AccountDesc
			$this->AccountDesc->LinkCustomAttributes = "";
			$this->AccountDesc->HrefValue = "";
			$this->AccountDesc->TooltipValue = "";
			if (!$this->isExport())
				$this->AccountDesc->ViewValue = $this->highlightValue($this->AccountDesc);

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";
			$this->Amount->TooltipValue = "";
			if (!$this->isExport())
				$this->Amount->ViewValue = $this->highlightValue($this->Amount);

			// AccountType
			$this->AccountType->LinkCustomAttributes = "";
			$this->AccountType->HrefValue = "";
			$this->AccountType->TooltipValue = "";

			// AccountSubGroupCode
			$this->AccountSubGroupCode->LinkCustomAttributes = "";
			$this->AccountSubGroupCode->HrefValue = "";
			$this->AccountSubGroupCode->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// AccountCode
			$this->AccountCode->EditAttrs["class"] = "form-control";
			$this->AccountCode->EditCustomAttributes = "";
			if (!$this->AccountCode->Raw)
				$this->AccountCode->CurrentValue = HtmlDecode($this->AccountCode->CurrentValue);
			$this->AccountCode->EditValue = HtmlEncode($this->AccountCode->CurrentValue);
			$this->AccountCode->PlaceHolder = RemoveHtml($this->AccountCode->caption());

			// AccountName
			$this->AccountName->EditAttrs["class"] = "form-control";
			$this->AccountName->EditCustomAttributes = "";
			if (!$this->AccountName->Raw)
				$this->AccountName->CurrentValue = HtmlDecode($this->AccountName->CurrentValue);
			$this->AccountName->EditValue = HtmlEncode($this->AccountName->CurrentValue);
			$this->AccountName->PlaceHolder = RemoveHtml($this->AccountName->caption());

			// AccountGroupCode
			$this->AccountGroupCode->EditAttrs["class"] = "form-control";
			$this->AccountGroupCode->EditCustomAttributes = "";
			if ($this->AccountGroupCode->getSessionValue() != "") {
				$this->AccountGroupCode->CurrentValue = $this->AccountGroupCode->getSessionValue();
				$this->AccountGroupCode->OldValue = $this->AccountGroupCode->CurrentValue;
				$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
				$curVal = strval($this->AccountGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->lookupCacheOption($curVal);
					if ($this->AccountGroupCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
						}
					}
				} else {
					$this->AccountGroupCode->ViewValue = NULL;
				}
				$this->AccountGroupCode->ViewCustomAttributes = "";
			} else {
				$this->AccountGroupCode->EditValue = HtmlEncode($this->AccountGroupCode->CurrentValue);
				$curVal = strval($this->AccountGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountGroupCode->EditValue = $this->AccountGroupCode->lookupCacheOption($curVal);
					if ($this->AccountGroupCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->AccountGroupCode->EditValue = $this->AccountGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountGroupCode->EditValue = HtmlEncode($this->AccountGroupCode->CurrentValue);
						}
					}
				} else {
					$this->AccountGroupCode->EditValue = NULL;
				}
				$this->AccountGroupCode->PlaceHolder = RemoveHtml($this->AccountGroupCode->caption());
			}

			// AccountDesc
			$this->AccountDesc->EditAttrs["class"] = "form-control";
			$this->AccountDesc->EditCustomAttributes = "";
			if (!$this->AccountDesc->Raw)
				$this->AccountDesc->CurrentValue = HtmlDecode($this->AccountDesc->CurrentValue);
			$this->AccountDesc->EditValue = HtmlEncode($this->AccountDesc->CurrentValue);
			$this->AccountDesc->PlaceHolder = RemoveHtml($this->AccountDesc->caption());

			// Amount
			$this->Amount->EditAttrs["class"] = "form-control";
			$this->Amount->EditCustomAttributes = "";
			$this->Amount->EditValue = HtmlEncode($this->Amount->CurrentValue);
			$this->Amount->PlaceHolder = RemoveHtml($this->Amount->caption());
			if (strval($this->Amount->EditValue) != "" && is_numeric($this->Amount->EditValue)) {
				$this->Amount->EditValue = FormatNumber($this->Amount->EditValue, -2, -1, -2, 0);
				$this->Amount->OldValue = $this->Amount->EditValue;
			}
			

			// AccountType
			$this->AccountType->EditAttrs["class"] = "form-control";
			$this->AccountType->EditCustomAttributes = "";
			if ($this->AccountType->getSessionValue() != "") {
				$this->AccountType->CurrentValue = $this->AccountType->getSessionValue();
				$this->AccountType->OldValue = $this->AccountType->CurrentValue;
				$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
				$curVal = strval($this->AccountType->CurrentValue);
				if ($curVal != "") {
					$this->AccountType->ViewValue = $this->AccountType->lookupCacheOption($curVal);
					if ($this->AccountType->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->AccountType->ViewValue = $this->AccountType->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
						}
					}
				} else {
					$this->AccountType->ViewValue = NULL;
				}
				$this->AccountType->ViewCustomAttributes = "";
			} else {
				$this->AccountType->EditValue = HtmlEncode($this->AccountType->CurrentValue);
				$curVal = strval($this->AccountType->CurrentValue);
				if ($curVal != "") {
					$this->AccountType->EditValue = $this->AccountType->lookupCacheOption($curVal);
					if ($this->AccountType->EditValue === NULL) { // Lookup from database
						$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->AccountType->EditValue = $this->AccountType->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountType->EditValue = HtmlEncode($this->AccountType->CurrentValue);
						}
					}
				} else {
					$this->AccountType->EditValue = NULL;
				}
				$this->AccountType->PlaceHolder = RemoveHtml($this->AccountType->caption());
			}

			// AccountSubGroupCode
			$this->AccountSubGroupCode->EditAttrs["class"] = "form-control";
			$this->AccountSubGroupCode->EditCustomAttributes = "";
			if ($this->AccountSubGroupCode->getSessionValue() != "") {
				$this->AccountSubGroupCode->CurrentValue = $this->AccountSubGroupCode->getSessionValue();
				$this->AccountSubGroupCode->OldValue = $this->AccountSubGroupCode->CurrentValue;
				$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
				$curVal = strval($this->AccountSubGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->lookupCacheOption($curVal);
					if ($this->AccountSubGroupCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`AccountSubGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountSubGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
						}
					}
				} else {
					$this->AccountSubGroupCode->ViewValue = NULL;
				}
				$this->AccountSubGroupCode->ViewCustomAttributes = "";
			} else {
				$this->AccountSubGroupCode->EditValue = HtmlEncode($this->AccountSubGroupCode->CurrentValue);
				$curVal = strval($this->AccountSubGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountSubGroupCode->EditValue = $this->AccountSubGroupCode->lookupCacheOption($curVal);
					if ($this->AccountSubGroupCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`AccountSubGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountSubGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->AccountSubGroupCode->EditValue = $this->AccountSubGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountSubGroupCode->EditValue = HtmlEncode($this->AccountSubGroupCode->CurrentValue);
						}
					}
				} else {
					$this->AccountSubGroupCode->EditValue = NULL;
				}
				$this->AccountSubGroupCode->PlaceHolder = RemoveHtml($this->AccountSubGroupCode->caption());
			}

			// Add refer script
			// AccountCode

			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";

			// AccountName
			$this->AccountName->LinkCustomAttributes = "";
			$this->AccountName->HrefValue = "";

			// AccountGroupCode
			$this->AccountGroupCode->LinkCustomAttributes = "";
			$this->AccountGroupCode->HrefValue = "";

			// AccountDesc
			$this->AccountDesc->LinkCustomAttributes = "";
			$this->AccountDesc->HrefValue = "";

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";

			// AccountType
			$this->AccountType->LinkCustomAttributes = "";
			$this->AccountType->HrefValue = "";

			// AccountSubGroupCode
			$this->AccountSubGroupCode->LinkCustomAttributes = "";
			$this->AccountSubGroupCode->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// AccountCode
			$this->AccountCode->EditAttrs["class"] = "form-control";
			$this->AccountCode->EditCustomAttributes = "";
			if (!$this->AccountCode->Raw)
				$this->AccountCode->CurrentValue = HtmlDecode($this->AccountCode->CurrentValue);
			$this->AccountCode->EditValue = HtmlEncode($this->AccountCode->CurrentValue);
			$this->AccountCode->PlaceHolder = RemoveHtml($this->AccountCode->caption());

			// AccountName
			$this->AccountName->EditAttrs["class"] = "form-control";
			$this->AccountName->EditCustomAttributes = "";
			if (!$this->AccountName->Raw)
				$this->AccountName->CurrentValue = HtmlDecode($this->AccountName->CurrentValue);
			$this->AccountName->EditValue = HtmlEncode($this->AccountName->CurrentValue);
			$this->AccountName->PlaceHolder = RemoveHtml($this->AccountName->caption());

			// AccountGroupCode
			$this->AccountGroupCode->EditAttrs["class"] = "form-control";
			$this->AccountGroupCode->EditCustomAttributes = "";
			if ($this->AccountGroupCode->getSessionValue() != "") {
				$this->AccountGroupCode->CurrentValue = $this->AccountGroupCode->getSessionValue();
				$this->AccountGroupCode->OldValue = $this->AccountGroupCode->CurrentValue;
				$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
				$curVal = strval($this->AccountGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->lookupCacheOption($curVal);
					if ($this->AccountGroupCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountGroupCode->ViewValue = $this->AccountGroupCode->CurrentValue;
						}
					}
				} else {
					$this->AccountGroupCode->ViewValue = NULL;
				}
				$this->AccountGroupCode->ViewCustomAttributes = "";
			} else {
				$this->AccountGroupCode->EditValue = HtmlEncode($this->AccountGroupCode->CurrentValue);
				$curVal = strval($this->AccountGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountGroupCode->EditValue = $this->AccountGroupCode->lookupCacheOption($curVal);
					if ($this->AccountGroupCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`AccountGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->AccountGroupCode->EditValue = $this->AccountGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountGroupCode->EditValue = HtmlEncode($this->AccountGroupCode->CurrentValue);
						}
					}
				} else {
					$this->AccountGroupCode->EditValue = NULL;
				}
				$this->AccountGroupCode->PlaceHolder = RemoveHtml($this->AccountGroupCode->caption());
			}

			// AccountDesc
			$this->AccountDesc->EditAttrs["class"] = "form-control";
			$this->AccountDesc->EditCustomAttributes = "";
			if (!$this->AccountDesc->Raw)
				$this->AccountDesc->CurrentValue = HtmlDecode($this->AccountDesc->CurrentValue);
			$this->AccountDesc->EditValue = HtmlEncode($this->AccountDesc->CurrentValue);
			$this->AccountDesc->PlaceHolder = RemoveHtml($this->AccountDesc->caption());

			// Amount
			$this->Amount->EditAttrs["class"] = "form-control";
			$this->Amount->EditCustomAttributes = "";
			$this->Amount->EditValue = HtmlEncode($this->Amount->CurrentValue);
			$this->Amount->PlaceHolder = RemoveHtml($this->Amount->caption());
			if (strval($this->Amount->EditValue) != "" && is_numeric($this->Amount->EditValue)) {
				$this->Amount->EditValue = FormatNumber($this->Amount->EditValue, -2, -1, -2, 0);
				$this->Amount->OldValue = $this->Amount->EditValue;
			}
			

			// AccountType
			$this->AccountType->EditAttrs["class"] = "form-control";
			$this->AccountType->EditCustomAttributes = "";
			if ($this->AccountType->getSessionValue() != "") {
				$this->AccountType->CurrentValue = $this->AccountType->getSessionValue();
				$this->AccountType->OldValue = $this->AccountType->CurrentValue;
				$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
				$curVal = strval($this->AccountType->CurrentValue);
				if ($curVal != "") {
					$this->AccountType->ViewValue = $this->AccountType->lookupCacheOption($curVal);
					if ($this->AccountType->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->AccountType->ViewValue = $this->AccountType->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountType->ViewValue = $this->AccountType->CurrentValue;
						}
					}
				} else {
					$this->AccountType->ViewValue = NULL;
				}
				$this->AccountType->ViewCustomAttributes = "";
			} else {
				$this->AccountType->EditValue = HtmlEncode($this->AccountType->CurrentValue);
				$curVal = strval($this->AccountType->CurrentValue);
				if ($curVal != "") {
					$this->AccountType->EditValue = $this->AccountType->lookupCacheOption($curVal);
					if ($this->AccountType->EditValue === NULL) { // Lookup from database
						$filterWrk = "`AccountTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountType->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->AccountType->EditValue = $this->AccountType->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountType->EditValue = HtmlEncode($this->AccountType->CurrentValue);
						}
					}
				} else {
					$this->AccountType->EditValue = NULL;
				}
				$this->AccountType->PlaceHolder = RemoveHtml($this->AccountType->caption());
			}

			// AccountSubGroupCode
			$this->AccountSubGroupCode->EditAttrs["class"] = "form-control";
			$this->AccountSubGroupCode->EditCustomAttributes = "";
			if ($this->AccountSubGroupCode->getSessionValue() != "") {
				$this->AccountSubGroupCode->CurrentValue = $this->AccountSubGroupCode->getSessionValue();
				$this->AccountSubGroupCode->OldValue = $this->AccountSubGroupCode->CurrentValue;
				$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
				$curVal = strval($this->AccountSubGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->lookupCacheOption($curVal);
					if ($this->AccountSubGroupCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`AccountSubGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountSubGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountSubGroupCode->ViewValue = $this->AccountSubGroupCode->CurrentValue;
						}
					}
				} else {
					$this->AccountSubGroupCode->ViewValue = NULL;
				}
				$this->AccountSubGroupCode->ViewCustomAttributes = "";
			} else {
				$this->AccountSubGroupCode->EditValue = HtmlEncode($this->AccountSubGroupCode->CurrentValue);
				$curVal = strval($this->AccountSubGroupCode->CurrentValue);
				if ($curVal != "") {
					$this->AccountSubGroupCode->EditValue = $this->AccountSubGroupCode->lookupCacheOption($curVal);
					if ($this->AccountSubGroupCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`AccountSubGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->AccountSubGroupCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->AccountSubGroupCode->EditValue = $this->AccountSubGroupCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->AccountSubGroupCode->EditValue = HtmlEncode($this->AccountSubGroupCode->CurrentValue);
						}
					}
				} else {
					$this->AccountSubGroupCode->EditValue = NULL;
				}
				$this->AccountSubGroupCode->PlaceHolder = RemoveHtml($this->AccountSubGroupCode->caption());
			}

			// Edit refer script
			// AccountCode

			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";

			// AccountName
			$this->AccountName->LinkCustomAttributes = "";
			$this->AccountName->HrefValue = "";

			// AccountGroupCode
			$this->AccountGroupCode->LinkCustomAttributes = "";
			$this->AccountGroupCode->HrefValue = "";

			// AccountDesc
			$this->AccountDesc->LinkCustomAttributes = "";
			$this->AccountDesc->HrefValue = "";

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";

			// AccountType
			$this->AccountType->LinkCustomAttributes = "";
			$this->AccountType->HrefValue = "";

			// AccountSubGroupCode
			$this->AccountSubGroupCode->LinkCustomAttributes = "";
			$this->AccountSubGroupCode->HrefValue = "";
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
		if ($this->AccountCode->Required) {
			if (!$this->AccountCode->IsDetailKey && $this->AccountCode->FormValue != NULL && $this->AccountCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountCode->caption(), $this->AccountCode->RequiredErrorMessage));
			}
		}
		if ($this->AccountName->Required) {
			if (!$this->AccountName->IsDetailKey && $this->AccountName->FormValue != NULL && $this->AccountName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountName->caption(), $this->AccountName->RequiredErrorMessage));
			}
		}
		if ($this->AccountGroupCode->Required) {
			if (!$this->AccountGroupCode->IsDetailKey && $this->AccountGroupCode->FormValue != NULL && $this->AccountGroupCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountGroupCode->caption(), $this->AccountGroupCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->AccountGroupCode->FormValue)) {
			AddMessage($FormError, $this->AccountGroupCode->errorMessage());
		}
		if ($this->AccountDesc->Required) {
			if (!$this->AccountDesc->IsDetailKey && $this->AccountDesc->FormValue != NULL && $this->AccountDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountDesc->caption(), $this->AccountDesc->RequiredErrorMessage));
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
		if ($this->AccountType->Required) {
			if (!$this->AccountType->IsDetailKey && $this->AccountType->FormValue != NULL && $this->AccountType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountType->caption(), $this->AccountType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->AccountType->FormValue)) {
			AddMessage($FormError, $this->AccountType->errorMessage());
		}
		if ($this->AccountSubGroupCode->Required) {
			if (!$this->AccountSubGroupCode->IsDetailKey && $this->AccountSubGroupCode->FormValue != NULL && $this->AccountSubGroupCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountSubGroupCode->caption(), $this->AccountSubGroupCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->AccountSubGroupCode->FormValue)) {
			AddMessage($FormError, $this->AccountSubGroupCode->errorMessage());
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
				$thisKey .= $row['AccountCode'];
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

			// AccountCode
			$this->AccountCode->setDbValueDef($rsnew, $this->AccountCode->CurrentValue, "", $this->AccountCode->ReadOnly);

			// AccountName
			$this->AccountName->setDbValueDef($rsnew, $this->AccountName->CurrentValue, "", $this->AccountName->ReadOnly);

			// AccountGroupCode
			$this->AccountGroupCode->setDbValueDef($rsnew, $this->AccountGroupCode->CurrentValue, 0, $this->AccountGroupCode->ReadOnly);

			// AccountDesc
			$this->AccountDesc->setDbValueDef($rsnew, $this->AccountDesc->CurrentValue, NULL, $this->AccountDesc->ReadOnly);

			// Amount
			$this->Amount->setDbValueDef($rsnew, $this->Amount->CurrentValue, NULL, $this->Amount->ReadOnly);

			// AccountType
			$this->AccountType->setDbValueDef($rsnew, $this->AccountType->CurrentValue, 0, $this->AccountType->ReadOnly);

			// AccountSubGroupCode
			$this->AccountSubGroupCode->setDbValueDef($rsnew, $this->AccountSubGroupCode->CurrentValue, 0, $this->AccountSubGroupCode->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "account_sub_group") {
				$this->AccountType->CurrentValue = $this->AccountType->getSessionValue();
				$this->AccountGroupCode->CurrentValue = $this->AccountGroupCode->getSessionValue();
				$this->AccountSubGroupCode->CurrentValue = $this->AccountSubGroupCode->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// AccountCode
		$this->AccountCode->setDbValueDef($rsnew, $this->AccountCode->CurrentValue, "", FALSE);

		// AccountName
		$this->AccountName->setDbValueDef($rsnew, $this->AccountName->CurrentValue, "", FALSE);

		// AccountGroupCode
		$this->AccountGroupCode->setDbValueDef($rsnew, $this->AccountGroupCode->CurrentValue, 0, FALSE);

		// AccountDesc
		$this->AccountDesc->setDbValueDef($rsnew, $this->AccountDesc->CurrentValue, NULL, FALSE);

		// Amount
		$this->Amount->setDbValueDef($rsnew, $this->Amount->CurrentValue, NULL, FALSE);

		// AccountType
		$this->AccountType->setDbValueDef($rsnew, $this->AccountType->CurrentValue, 0, FALSE);

		// AccountSubGroupCode
		$this->AccountSubGroupCode->setDbValueDef($rsnew, $this->AccountSubGroupCode->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['AccountCode']) == "") {
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
		if ($masterTblVar == "account_sub_group") {
			$this->AccountType->Visible = FALSE;
			if ($GLOBALS["account_sub_group"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->AccountGroupCode->Visible = FALSE;
			if ($GLOBALS["account_sub_group"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->AccountSubGroupCode->Visible = FALSE;
			if ($GLOBALS["account_sub_group"]->EventCancelled)
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
				case "x_AccountGroupCode":
					break;
				case "x_AccountType":
					break;
				case "x_AccountSubGroupCode":
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
						case "x_AccountGroupCode":
							break;
						case "x_AccountType":
							break;
						case "x_AccountSubGroupCode":
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