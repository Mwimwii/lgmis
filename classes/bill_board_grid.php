<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class bill_board_grid extends bill_board
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'bill_board';

	// Page object name
	public $PageObjName = "bill_board_grid";

	// Grid form hidden field names
	public $FormName = "fbill_boardgrid";
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

		// Table object (bill_board)
		if (!isset($GLOBALS["bill_board"]) || get_class($GLOBALS["bill_board"]) == PROJECT_NAMESPACE . "bill_board") {
			$GLOBALS["bill_board"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["bill_board"];

		}
		$this->AddUrl = "bill_boardadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'bill_board');

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
		global $bill_board;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($bill_board);
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
			$key .= @$ar['BillBoardNo'];
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->BillBoardNo->Visible = FALSE;
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
		$this->BillBoardNo->setVisibility();
		$this->BoardStandNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->BoardLength->setVisibility();
		$this->BoardWidth->setVisibility();
		$this->BoardSize->setVisibility();
		$this->BoardType->setVisibility();
		$this->BoardLocation->setVisibility();
		$this->BoardStatus->setVisibility();
		$this->ExemptCode->setVisibility();
		$this->StreetAddress->setVisibility();
		$this->Longitude->setVisibility();
		$this->Latitude->setVisibility();
		$this->Incumberance->setVisibility();
		$this->StartDate->setVisibility();
		$this->EndDate->setVisibility();
		$this->LastUpdatedBy->Visible = FALSE;
		$this->LastUpdateDate->Visible = FALSE;
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
		$this->setupLookupOptions($this->ClientSerNo);
		$this->setupLookupOptions($this->BoardType);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "client") {
			global $client;
			$rsmaster = $client->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("clientlist.php"); // Return to master page
			} else {
				$client->loadListRowValues($rsmaster);
				$client->RowType = ROWTYPE_MASTER; // Master row
				$client->renderListRow();
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
		$this->BoardLength->FormValue = ""; // Clear form value
		$this->BoardWidth->FormValue = ""; // Clear form value
		$this->BoardSize->FormValue = ""; // Clear form value
		$this->Longitude->FormValue = ""; // Clear form value
		$this->Latitude->FormValue = ""; // Clear form value
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
			$this->BillBoardNo->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->BillBoardNo->OldValue))
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
					$key .= $this->BillBoardNo->CurrentValue;

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
		if ($CurrentForm->hasValue("x_BoardStandNo") && $CurrentForm->hasValue("o_BoardStandNo") && $this->BoardStandNo->CurrentValue != $this->BoardStandNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ClientSerNo") && $CurrentForm->hasValue("o_ClientSerNo") && $this->ClientSerNo->CurrentValue != $this->ClientSerNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ClientID") && $CurrentForm->hasValue("o_ClientID") && $this->ClientID->CurrentValue != $this->ClientID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BoardLength") && $CurrentForm->hasValue("o_BoardLength") && $this->BoardLength->CurrentValue != $this->BoardLength->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BoardWidth") && $CurrentForm->hasValue("o_BoardWidth") && $this->BoardWidth->CurrentValue != $this->BoardWidth->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BoardSize") && $CurrentForm->hasValue("o_BoardSize") && $this->BoardSize->CurrentValue != $this->BoardSize->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BoardType") && $CurrentForm->hasValue("o_BoardType") && $this->BoardType->CurrentValue != $this->BoardType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BoardLocation") && $CurrentForm->hasValue("o_BoardLocation") && $this->BoardLocation->CurrentValue != $this->BoardLocation->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BoardStatus") && $CurrentForm->hasValue("o_BoardStatus") && $this->BoardStatus->CurrentValue != $this->BoardStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ExemptCode") && $CurrentForm->hasValue("o_ExemptCode") && $this->ExemptCode->CurrentValue != $this->ExemptCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_StreetAddress") && $CurrentForm->hasValue("o_StreetAddress") && $this->StreetAddress->CurrentValue != $this->StreetAddress->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Longitude") && $CurrentForm->hasValue("o_Longitude") && $this->Longitude->CurrentValue != $this->Longitude->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Latitude") && $CurrentForm->hasValue("o_Latitude") && $this->Latitude->CurrentValue != $this->Latitude->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Incumberance") && $CurrentForm->hasValue("o_Incumberance") && $this->Incumberance->CurrentValue != $this->Incumberance->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_StartDate") && $CurrentForm->hasValue("o_StartDate") && $this->StartDate->CurrentValue != $this->StartDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EndDate") && $CurrentForm->hasValue("o_EndDate") && $this->EndDate->CurrentValue != $this->EndDate->OldValue)
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
				$this->ClientSerNo->setSessionValue("");
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

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
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

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->BillBoardNo->CurrentValue . "\">";
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
		$key .= $rs->fields('BillBoardNo');
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
		$sqlwrk = "`BillBoardNo`=" . AdjustSql($this->BillBoardNo->CurrentValue, $this->Dbid) . "";

		// Column "detail_bill_board_account"
		if ($this->DetailPages && $this->DetailPages["bill_board_account"] && $this->DetailPages["bill_board_account"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_bill_board_account"];
			$url = "bill_board_accountpreview.php?t=bill_board&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"bill_board_account\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'bill_board')) {
				$label = $Language->TablePhrase("bill_board_account", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"bill_board_account\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("bill_board_accountlist.php?" . Config("TABLE_SHOW_MASTER") . "=bill_board&fk_BillBoardNo=" . urlencode(strval($this->BillBoardNo->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("bill_board_account", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["bill_board_account_grid"]))
				$GLOBALS["bill_board_account_grid"] = new bill_board_account_grid();
			if ($GLOBALS["bill_board_account_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'bill_board')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=bill_board_account");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["bill_board_account_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'bill_board')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=bill_board_account");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["bill_board_account_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'bill_board')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=bill_board_account");
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
		$this->BillBoardNo->CurrentValue = NULL;
		$this->BillBoardNo->OldValue = $this->BillBoardNo->CurrentValue;
		$this->BoardStandNo->CurrentValue = NULL;
		$this->BoardStandNo->OldValue = $this->BoardStandNo->CurrentValue;
		$this->ClientSerNo->CurrentValue = NULL;
		$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
		$this->ClientID->CurrentValue = NULL;
		$this->ClientID->OldValue = $this->ClientID->CurrentValue;
		$this->BoardLength->CurrentValue = 0;
		$this->BoardLength->OldValue = $this->BoardLength->CurrentValue;
		$this->BoardWidth->CurrentValue = 0;
		$this->BoardWidth->OldValue = $this->BoardWidth->CurrentValue;
		$this->BoardSize->CurrentValue = 0;
		$this->BoardSize->OldValue = $this->BoardSize->CurrentValue;
		$this->BoardType->CurrentValue = 1;
		$this->BoardType->OldValue = $this->BoardType->CurrentValue;
		$this->BoardLocation->CurrentValue = NULL;
		$this->BoardLocation->OldValue = $this->BoardLocation->CurrentValue;
		$this->BoardStatus->CurrentValue = 1;
		$this->BoardStatus->OldValue = $this->BoardStatus->CurrentValue;
		$this->ExemptCode->CurrentValue = 0;
		$this->ExemptCode->OldValue = $this->ExemptCode->CurrentValue;
		$this->StreetAddress->CurrentValue = NULL;
		$this->StreetAddress->OldValue = $this->StreetAddress->CurrentValue;
		$this->Longitude->CurrentValue = NULL;
		$this->Longitude->OldValue = $this->Longitude->CurrentValue;
		$this->Latitude->CurrentValue = NULL;
		$this->Latitude->OldValue = $this->Latitude->CurrentValue;
		$this->Incumberance->CurrentValue = NULL;
		$this->Incumberance->OldValue = $this->Incumberance->CurrentValue;
		$this->StartDate->CurrentValue = NULL;
		$this->StartDate->OldValue = $this->StartDate->CurrentValue;
		$this->EndDate->CurrentValue = NULL;
		$this->EndDate->OldValue = $this->EndDate->CurrentValue;
		$this->LastUpdatedBy->CurrentValue = NULL;
		$this->LastUpdatedBy->OldValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdateDate->CurrentValue = NULL;
		$this->LastUpdateDate->OldValue = $this->LastUpdateDate->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'BillBoardNo' first before field var 'x_BillBoardNo'
		$val = $CurrentForm->hasValue("BillBoardNo") ? $CurrentForm->getValue("BillBoardNo") : $CurrentForm->getValue("x_BillBoardNo");
		if (!$this->BillBoardNo->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->BillBoardNo->setFormValue($val);

		// Check field name 'BoardStandNo' first before field var 'x_BoardStandNo'
		$val = $CurrentForm->hasValue("BoardStandNo") ? $CurrentForm->getValue("BoardStandNo") : $CurrentForm->getValue("x_BoardStandNo");
		if (!$this->BoardStandNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardStandNo->Visible = FALSE; // Disable update for API request
			else
				$this->BoardStandNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardStandNo"))
			$this->BoardStandNo->setOldValue($CurrentForm->getValue("o_BoardStandNo"));

		// Check field name 'ClientSerNo' first before field var 'x_ClientSerNo'
		$val = $CurrentForm->hasValue("ClientSerNo") ? $CurrentForm->getValue("ClientSerNo") : $CurrentForm->getValue("x_ClientSerNo");
		if (!$this->ClientSerNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientSerNo->Visible = FALSE; // Disable update for API request
			else
				$this->ClientSerNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ClientSerNo"))
			$this->ClientSerNo->setOldValue($CurrentForm->getValue("o_ClientSerNo"));

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ClientID"))
			$this->ClientID->setOldValue($CurrentForm->getValue("o_ClientID"));

		// Check field name 'BoardLength' first before field var 'x_BoardLength'
		$val = $CurrentForm->hasValue("BoardLength") ? $CurrentForm->getValue("BoardLength") : $CurrentForm->getValue("x_BoardLength");
		if (!$this->BoardLength->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardLength->Visible = FALSE; // Disable update for API request
			else
				$this->BoardLength->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardLength"))
			$this->BoardLength->setOldValue($CurrentForm->getValue("o_BoardLength"));

		// Check field name 'BoardWidth' first before field var 'x_BoardWidth'
		$val = $CurrentForm->hasValue("BoardWidth") ? $CurrentForm->getValue("BoardWidth") : $CurrentForm->getValue("x_BoardWidth");
		if (!$this->BoardWidth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardWidth->Visible = FALSE; // Disable update for API request
			else
				$this->BoardWidth->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardWidth"))
			$this->BoardWidth->setOldValue($CurrentForm->getValue("o_BoardWidth"));

		// Check field name 'BoardSize' first before field var 'x_BoardSize'
		$val = $CurrentForm->hasValue("BoardSize") ? $CurrentForm->getValue("BoardSize") : $CurrentForm->getValue("x_BoardSize");
		if (!$this->BoardSize->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardSize->Visible = FALSE; // Disable update for API request
			else
				$this->BoardSize->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardSize"))
			$this->BoardSize->setOldValue($CurrentForm->getValue("o_BoardSize"));

		// Check field name 'BoardType' first before field var 'x_BoardType'
		$val = $CurrentForm->hasValue("BoardType") ? $CurrentForm->getValue("BoardType") : $CurrentForm->getValue("x_BoardType");
		if (!$this->BoardType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardType->Visible = FALSE; // Disable update for API request
			else
				$this->BoardType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardType"))
			$this->BoardType->setOldValue($CurrentForm->getValue("o_BoardType"));

		// Check field name 'BoardLocation' first before field var 'x_BoardLocation'
		$val = $CurrentForm->hasValue("BoardLocation") ? $CurrentForm->getValue("BoardLocation") : $CurrentForm->getValue("x_BoardLocation");
		if (!$this->BoardLocation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardLocation->Visible = FALSE; // Disable update for API request
			else
				$this->BoardLocation->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardLocation"))
			$this->BoardLocation->setOldValue($CurrentForm->getValue("o_BoardLocation"));

		// Check field name 'BoardStatus' first before field var 'x_BoardStatus'
		$val = $CurrentForm->hasValue("BoardStatus") ? $CurrentForm->getValue("BoardStatus") : $CurrentForm->getValue("x_BoardStatus");
		if (!$this->BoardStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BoardStatus->Visible = FALSE; // Disable update for API request
			else
				$this->BoardStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BoardStatus"))
			$this->BoardStatus->setOldValue($CurrentForm->getValue("o_BoardStatus"));

		// Check field name 'ExemptCode' first before field var 'x_ExemptCode'
		$val = $CurrentForm->hasValue("ExemptCode") ? $CurrentForm->getValue("ExemptCode") : $CurrentForm->getValue("x_ExemptCode");
		if (!$this->ExemptCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExemptCode->Visible = FALSE; // Disable update for API request
			else
				$this->ExemptCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ExemptCode"))
			$this->ExemptCode->setOldValue($CurrentForm->getValue("o_ExemptCode"));

		// Check field name 'StreetAddress' first before field var 'x_StreetAddress'
		$val = $CurrentForm->hasValue("StreetAddress") ? $CurrentForm->getValue("StreetAddress") : $CurrentForm->getValue("x_StreetAddress");
		if (!$this->StreetAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StreetAddress->Visible = FALSE; // Disable update for API request
			else
				$this->StreetAddress->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_StreetAddress"))
			$this->StreetAddress->setOldValue($CurrentForm->getValue("o_StreetAddress"));

		// Check field name 'Longitude' first before field var 'x_Longitude'
		$val = $CurrentForm->hasValue("Longitude") ? $CurrentForm->getValue("Longitude") : $CurrentForm->getValue("x_Longitude");
		if (!$this->Longitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Longitude->Visible = FALSE; // Disable update for API request
			else
				$this->Longitude->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Longitude"))
			$this->Longitude->setOldValue($CurrentForm->getValue("o_Longitude"));

		// Check field name 'Latitude' first before field var 'x_Latitude'
		$val = $CurrentForm->hasValue("Latitude") ? $CurrentForm->getValue("Latitude") : $CurrentForm->getValue("x_Latitude");
		if (!$this->Latitude->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Latitude->Visible = FALSE; // Disable update for API request
			else
				$this->Latitude->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Latitude"))
			$this->Latitude->setOldValue($CurrentForm->getValue("o_Latitude"));

		// Check field name 'Incumberance' first before field var 'x_Incumberance'
		$val = $CurrentForm->hasValue("Incumberance") ? $CurrentForm->getValue("Incumberance") : $CurrentForm->getValue("x_Incumberance");
		if (!$this->Incumberance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Incumberance->Visible = FALSE; // Disable update for API request
			else
				$this->Incumberance->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Incumberance"))
			$this->Incumberance->setOldValue($CurrentForm->getValue("o_Incumberance"));

		// Check field name 'StartDate' first before field var 'x_StartDate'
		$val = $CurrentForm->hasValue("StartDate") ? $CurrentForm->getValue("StartDate") : $CurrentForm->getValue("x_StartDate");
		if (!$this->StartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StartDate->Visible = FALSE; // Disable update for API request
			else
				$this->StartDate->setFormValue($val);
			$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_StartDate"))
			$this->StartDate->setOldValue($CurrentForm->getValue("o_StartDate"));

		// Check field name 'EndDate' first before field var 'x_EndDate'
		$val = $CurrentForm->hasValue("EndDate") ? $CurrentForm->getValue("EndDate") : $CurrentForm->getValue("x_EndDate");
		if (!$this->EndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EndDate->Visible = FALSE; // Disable update for API request
			else
				$this->EndDate->setFormValue($val);
			$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_EndDate"))
			$this->EndDate->setOldValue($CurrentForm->getValue("o_EndDate"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->BillBoardNo->CurrentValue = $this->BillBoardNo->FormValue;
		$this->BoardStandNo->CurrentValue = $this->BoardStandNo->FormValue;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
		$this->BoardLength->CurrentValue = $this->BoardLength->FormValue;
		$this->BoardWidth->CurrentValue = $this->BoardWidth->FormValue;
		$this->BoardSize->CurrentValue = $this->BoardSize->FormValue;
		$this->BoardType->CurrentValue = $this->BoardType->FormValue;
		$this->BoardLocation->CurrentValue = $this->BoardLocation->FormValue;
		$this->BoardStatus->CurrentValue = $this->BoardStatus->FormValue;
		$this->ExemptCode->CurrentValue = $this->ExemptCode->FormValue;
		$this->StreetAddress->CurrentValue = $this->StreetAddress->FormValue;
		$this->Longitude->CurrentValue = $this->Longitude->FormValue;
		$this->Latitude->CurrentValue = $this->Latitude->FormValue;
		$this->Incumberance->CurrentValue = $this->Incumberance->FormValue;
		$this->StartDate->CurrentValue = $this->StartDate->FormValue;
		$this->StartDate->CurrentValue = UnFormatDateTime($this->StartDate->CurrentValue, 0);
		$this->EndDate->CurrentValue = $this->EndDate->FormValue;
		$this->EndDate->CurrentValue = UnFormatDateTime($this->EndDate->CurrentValue, 0);
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
		$this->BillBoardNo->setDbValue($row['BillBoardNo']);
		$this->BoardStandNo->setDbValue($row['BoardStandNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->BoardLength->setDbValue($row['BoardLength']);
		$this->BoardWidth->setDbValue($row['BoardWidth']);
		$this->BoardSize->setDbValue($row['BoardSize']);
		$this->BoardType->setDbValue($row['BoardType']);
		$this->BoardLocation->setDbValue($row['BoardLocation']);
		$this->BoardStatus->setDbValue($row['BoardStatus']);
		$this->ExemptCode->setDbValue($row['ExemptCode']);
		$this->StreetAddress->setDbValue($row['StreetAddress']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->Incumberance->setDbValue($row['Incumberance']);
		$this->StartDate->setDbValue($row['StartDate']);
		$this->EndDate->setDbValue($row['EndDate']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['BillBoardNo'] = $this->BillBoardNo->CurrentValue;
		$row['BoardStandNo'] = $this->BoardStandNo->CurrentValue;
		$row['ClientSerNo'] = $this->ClientSerNo->CurrentValue;
		$row['ClientID'] = $this->ClientID->CurrentValue;
		$row['BoardLength'] = $this->BoardLength->CurrentValue;
		$row['BoardWidth'] = $this->BoardWidth->CurrentValue;
		$row['BoardSize'] = $this->BoardSize->CurrentValue;
		$row['BoardType'] = $this->BoardType->CurrentValue;
		$row['BoardLocation'] = $this->BoardLocation->CurrentValue;
		$row['BoardStatus'] = $this->BoardStatus->CurrentValue;
		$row['ExemptCode'] = $this->ExemptCode->CurrentValue;
		$row['StreetAddress'] = $this->StreetAddress->CurrentValue;
		$row['Longitude'] = $this->Longitude->CurrentValue;
		$row['Latitude'] = $this->Latitude->CurrentValue;
		$row['Incumberance'] = $this->Incumberance->CurrentValue;
		$row['StartDate'] = $this->StartDate->CurrentValue;
		$row['EndDate'] = $this->EndDate->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
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
				$this->BillBoardNo->OldValue = strval($keys[0]); // BillBoardNo
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
		if ($this->BoardLength->FormValue == $this->BoardLength->CurrentValue && is_numeric(ConvertToFloatString($this->BoardLength->CurrentValue)))
			$this->BoardLength->CurrentValue = ConvertToFloatString($this->BoardLength->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BoardWidth->FormValue == $this->BoardWidth->CurrentValue && is_numeric(ConvertToFloatString($this->BoardWidth->CurrentValue)))
			$this->BoardWidth->CurrentValue = ConvertToFloatString($this->BoardWidth->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BoardSize->FormValue == $this->BoardSize->CurrentValue && is_numeric(ConvertToFloatString($this->BoardSize->CurrentValue)))
			$this->BoardSize->CurrentValue = ConvertToFloatString($this->BoardSize->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// BillBoardNo
		// BoardStandNo
		// ClientSerNo
		// ClientID
		// BoardLength
		// BoardWidth
		// BoardSize
		// BoardType
		// BoardLocation
		// BoardStatus
		// ExemptCode
		// StreetAddress
		// Longitude
		// Latitude
		// Incumberance
		// StartDate
		// EndDate
		// LastUpdatedBy
		// LastUpdateDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// BillBoardNo
			$this->BillBoardNo->ViewValue = $this->BillBoardNo->CurrentValue;
			$this->BillBoardNo->ViewCustomAttributes = "";

			// BoardStandNo
			$this->BoardStandNo->ViewValue = $this->BoardStandNo->CurrentValue;
			$this->BoardStandNo->ViewCustomAttributes = "";

			// ClientSerNo
			$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
			$curVal = strval($this->ClientSerNo->CurrentValue);
			if ($curVal != "") {
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
					}
				}
			} else {
				$this->ClientSerNo->ViewValue = NULL;
			}
			$this->ClientSerNo->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// BoardLength
			$this->BoardLength->ViewValue = $this->BoardLength->CurrentValue;
			$this->BoardLength->ViewValue = FormatNumber($this->BoardLength->ViewValue, 2, -2, -2, -2);
			$this->BoardLength->CellCssStyle .= "text-align: right;";
			$this->BoardLength->ViewCustomAttributes = "";

			// BoardWidth
			$this->BoardWidth->ViewValue = $this->BoardWidth->CurrentValue;
			$this->BoardWidth->ViewValue = FormatNumber($this->BoardWidth->ViewValue, 2, -2, -2, -2);
			$this->BoardWidth->CellCssStyle .= "text-align: right;";
			$this->BoardWidth->ViewCustomAttributes = "";

			// BoardSize
			$this->BoardSize->ViewValue = $this->BoardSize->CurrentValue;
			$this->BoardSize->ViewValue = FormatNumber($this->BoardSize->ViewValue, 2, -2, -2, -2);
			$this->BoardSize->CellCssStyle .= "text-align: right;";
			$this->BoardSize->ViewCustomAttributes = "";

			// BoardType
			$curVal = strval($this->BoardType->CurrentValue);
			if ($curVal != "") {
				$this->BoardType->ViewValue = $this->BoardType->lookupCacheOption($curVal);
				if ($this->BoardType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`BoardType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BoardType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->BoardType->ViewValue = $this->BoardType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BoardType->ViewValue = $this->BoardType->CurrentValue;
					}
				}
			} else {
				$this->BoardType->ViewValue = NULL;
			}
			$this->BoardType->ViewCustomAttributes = "";

			// BoardLocation
			$this->BoardLocation->ViewValue = $this->BoardLocation->CurrentValue;
			$this->BoardLocation->ViewCustomAttributes = "";

			// BoardStatus
			$this->BoardStatus->ViewValue = $this->BoardStatus->CurrentValue;
			$this->BoardStatus->ViewCustomAttributes = "";

			// ExemptCode
			$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
			$this->ExemptCode->ViewCustomAttributes = "";

			// StreetAddress
			$this->StreetAddress->ViewValue = $this->StreetAddress->CurrentValue;
			$this->StreetAddress->ViewCustomAttributes = "";

			// Longitude
			$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
			$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Longitude->ViewCustomAttributes = "";

			// Latitude
			$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
			$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Latitude->ViewCustomAttributes = "";

			// Incumberance
			$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
			$this->Incumberance->ViewCustomAttributes = "";

			// StartDate
			$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
			$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
			$this->StartDate->ViewCustomAttributes = "";

			// EndDate
			$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
			$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
			$this->EndDate->ViewCustomAttributes = "";

			// BillBoardNo
			$this->BillBoardNo->LinkCustomAttributes = "";
			$this->BillBoardNo->HrefValue = "";
			$this->BillBoardNo->TooltipValue = "";

			// BoardStandNo
			$this->BoardStandNo->LinkCustomAttributes = "";
			$this->BoardStandNo->HrefValue = "";
			$this->BoardStandNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// BoardLength
			$this->BoardLength->LinkCustomAttributes = "";
			$this->BoardLength->HrefValue = "";
			$this->BoardLength->TooltipValue = "";

			// BoardWidth
			$this->BoardWidth->LinkCustomAttributes = "";
			$this->BoardWidth->HrefValue = "";
			$this->BoardWidth->TooltipValue = "";

			// BoardSize
			$this->BoardSize->LinkCustomAttributes = "";
			$this->BoardSize->HrefValue = "";
			$this->BoardSize->TooltipValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";
			$this->BoardType->TooltipValue = "";

			// BoardLocation
			$this->BoardLocation->LinkCustomAttributes = "";
			$this->BoardLocation->HrefValue = "";
			$this->BoardLocation->TooltipValue = "";

			// BoardStatus
			$this->BoardStatus->LinkCustomAttributes = "";
			$this->BoardStatus->HrefValue = "";
			$this->BoardStatus->TooltipValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";
			$this->ExemptCode->TooltipValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";
			$this->StreetAddress->TooltipValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";
			$this->Longitude->TooltipValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";
			$this->Latitude->TooltipValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";
			$this->Incumberance->TooltipValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";
			$this->StartDate->TooltipValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
			$this->EndDate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// BillBoardNo
			// BoardStandNo

			$this->BoardStandNo->EditAttrs["class"] = "form-control";
			$this->BoardStandNo->EditCustomAttributes = "";
			if (!$this->BoardStandNo->Raw)
				$this->BoardStandNo->CurrentValue = HtmlDecode($this->BoardStandNo->CurrentValue);
			$this->BoardStandNo->EditValue = HtmlEncode($this->BoardStandNo->CurrentValue);
			$this->BoardStandNo->PlaceHolder = RemoveHtml($this->BoardStandNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			if ($this->ClientSerNo->getSessionValue() != "") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
				$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
				$curVal = strval($this->ClientSerNo->CurrentValue);
				if ($curVal != "") {
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
					if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = $rswrk->fields('df3');
							$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
						}
					}
				} else {
					$this->ClientSerNo->ViewValue = NULL;
				}
				$this->ClientSerNo->ViewCustomAttributes = "";
			} else {
				$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
				$curVal = strval($this->ClientSerNo->CurrentValue);
				if ($curVal != "") {
					$this->ClientSerNo->EditValue = $this->ClientSerNo->lookupCacheOption($curVal);
					if ($this->ClientSerNo->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
							$this->ClientSerNo->EditValue = $this->ClientSerNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
						}
					}
				} else {
					$this->ClientSerNo->EditValue = NULL;
				}
				$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// BoardLength
			$this->BoardLength->EditAttrs["class"] = "form-control";
			$this->BoardLength->EditCustomAttributes = "";
			$this->BoardLength->EditValue = HtmlEncode($this->BoardLength->CurrentValue);
			$this->BoardLength->PlaceHolder = RemoveHtml($this->BoardLength->caption());
			if (strval($this->BoardLength->EditValue) != "" && is_numeric($this->BoardLength->EditValue)) {
				$this->BoardLength->EditValue = FormatNumber($this->BoardLength->EditValue, -2, -2, -2, -2);
				$this->BoardLength->OldValue = $this->BoardLength->EditValue;
			}
			

			// BoardWidth
			$this->BoardWidth->EditAttrs["class"] = "form-control";
			$this->BoardWidth->EditCustomAttributes = "";
			$this->BoardWidth->EditValue = HtmlEncode($this->BoardWidth->CurrentValue);
			$this->BoardWidth->PlaceHolder = RemoveHtml($this->BoardWidth->caption());
			if (strval($this->BoardWidth->EditValue) != "" && is_numeric($this->BoardWidth->EditValue)) {
				$this->BoardWidth->EditValue = FormatNumber($this->BoardWidth->EditValue, -2, -2, -2, -2);
				$this->BoardWidth->OldValue = $this->BoardWidth->EditValue;
			}
			

			// BoardSize
			$this->BoardSize->EditAttrs["class"] = "form-control";
			$this->BoardSize->EditCustomAttributes = "";
			$this->BoardSize->EditValue = HtmlEncode($this->BoardSize->CurrentValue);
			$this->BoardSize->PlaceHolder = RemoveHtml($this->BoardSize->caption());
			if (strval($this->BoardSize->EditValue) != "" && is_numeric($this->BoardSize->EditValue)) {
				$this->BoardSize->EditValue = FormatNumber($this->BoardSize->EditValue, -2, -2, -2, -2);
				$this->BoardSize->OldValue = $this->BoardSize->EditValue;
			}
			

			// BoardType
			$this->BoardType->EditAttrs["class"] = "form-control";
			$this->BoardType->EditCustomAttributes = "";
			$curVal = trim(strval($this->BoardType->CurrentValue));
			if ($curVal != "")
				$this->BoardType->ViewValue = $this->BoardType->lookupCacheOption($curVal);
			else
				$this->BoardType->ViewValue = $this->BoardType->Lookup !== NULL && is_array($this->BoardType->Lookup->Options) ? $curVal : NULL;
			if ($this->BoardType->ViewValue !== NULL) { // Load from cache
				$this->BoardType->EditValue = array_values($this->BoardType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BoardType`" . SearchString("=", $this->BoardType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BoardType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BoardType->EditValue = $arwrk;
			}

			// BoardLocation
			$this->BoardLocation->EditAttrs["class"] = "form-control";
			$this->BoardLocation->EditCustomAttributes = "";
			if (!$this->BoardLocation->Raw)
				$this->BoardLocation->CurrentValue = HtmlDecode($this->BoardLocation->CurrentValue);
			$this->BoardLocation->EditValue = HtmlEncode($this->BoardLocation->CurrentValue);
			$this->BoardLocation->PlaceHolder = RemoveHtml($this->BoardLocation->caption());

			// BoardStatus
			$this->BoardStatus->EditAttrs["class"] = "form-control";
			$this->BoardStatus->EditCustomAttributes = "";
			$this->BoardStatus->EditValue = HtmlEncode($this->BoardStatus->CurrentValue);
			$this->BoardStatus->PlaceHolder = RemoveHtml($this->BoardStatus->caption());

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->CurrentValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// StreetAddress
			$this->StreetAddress->EditAttrs["class"] = "form-control";
			$this->StreetAddress->EditCustomAttributes = "";
			if (!$this->StreetAddress->Raw)
				$this->StreetAddress->CurrentValue = HtmlDecode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->EditValue = HtmlEncode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->CurrentValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
			if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue)) {
				$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
				$this->Longitude->OldValue = $this->Longitude->EditValue;
			}
			

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->CurrentValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
			if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue)) {
				$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
				$this->Latitude->OldValue = $this->Latitude->EditValue;
			}
			

			// Incumberance
			$this->Incumberance->EditAttrs["class"] = "form-control";
			$this->Incumberance->EditCustomAttributes = "";
			if (!$this->Incumberance->Raw)
				$this->Incumberance->CurrentValue = HtmlDecode($this->Incumberance->CurrentValue);
			$this->Incumberance->EditValue = HtmlEncode($this->Incumberance->CurrentValue);
			$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

			// StartDate
			$this->StartDate->EditAttrs["class"] = "form-control";
			$this->StartDate->EditCustomAttributes = "";
			$this->StartDate->EditValue = HtmlEncode(FormatDateTime($this->StartDate->CurrentValue, 8));
			$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

			// EndDate
			$this->EndDate->EditAttrs["class"] = "form-control";
			$this->EndDate->EditCustomAttributes = "";
			$this->EndDate->EditValue = HtmlEncode(FormatDateTime($this->EndDate->CurrentValue, 8));
			$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

			// Add refer script
			// BillBoardNo

			$this->BillBoardNo->LinkCustomAttributes = "";
			$this->BillBoardNo->HrefValue = "";

			// BoardStandNo
			$this->BoardStandNo->LinkCustomAttributes = "";
			$this->BoardStandNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// BoardLength
			$this->BoardLength->LinkCustomAttributes = "";
			$this->BoardLength->HrefValue = "";

			// BoardWidth
			$this->BoardWidth->LinkCustomAttributes = "";
			$this->BoardWidth->HrefValue = "";

			// BoardSize
			$this->BoardSize->LinkCustomAttributes = "";
			$this->BoardSize->HrefValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";

			// BoardLocation
			$this->BoardLocation->LinkCustomAttributes = "";
			$this->BoardLocation->HrefValue = "";

			// BoardStatus
			$this->BoardStatus->LinkCustomAttributes = "";
			$this->BoardStatus->HrefValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// BillBoardNo
			$this->BillBoardNo->EditAttrs["class"] = "form-control";
			$this->BillBoardNo->EditCustomAttributes = "";
			$this->BillBoardNo->EditValue = $this->BillBoardNo->CurrentValue;
			$this->BillBoardNo->ViewCustomAttributes = "";

			// BoardStandNo
			$this->BoardStandNo->EditAttrs["class"] = "form-control";
			$this->BoardStandNo->EditCustomAttributes = "";
			if (!$this->BoardStandNo->Raw)
				$this->BoardStandNo->CurrentValue = HtmlDecode($this->BoardStandNo->CurrentValue);
			$this->BoardStandNo->EditValue = HtmlEncode($this->BoardStandNo->CurrentValue);
			$this->BoardStandNo->PlaceHolder = RemoveHtml($this->BoardStandNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			if ($this->ClientSerNo->getSessionValue() != "") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
				$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
				$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
				$curVal = strval($this->ClientSerNo->CurrentValue);
				if ($curVal != "") {
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
					if ($this->ClientSerNo->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = $rswrk->fields('df3');
							$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ClientSerNo->ViewValue = $this->ClientSerNo->CurrentValue;
						}
					}
				} else {
					$this->ClientSerNo->ViewValue = NULL;
				}
				$this->ClientSerNo->ViewCustomAttributes = "";
			} else {
				$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
				$curVal = strval($this->ClientSerNo->CurrentValue);
				if ($curVal != "") {
					$this->ClientSerNo->EditValue = $this->ClientSerNo->lookupCacheOption($curVal);
					if ($this->ClientSerNo->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ClientSerNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ClientSerNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
							$this->ClientSerNo->EditValue = $this->ClientSerNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->CurrentValue);
						}
					}
				} else {
					$this->ClientSerNo->EditValue = NULL;
				}
				$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// BoardLength
			$this->BoardLength->EditAttrs["class"] = "form-control";
			$this->BoardLength->EditCustomAttributes = "";
			$this->BoardLength->EditValue = HtmlEncode($this->BoardLength->CurrentValue);
			$this->BoardLength->PlaceHolder = RemoveHtml($this->BoardLength->caption());
			if (strval($this->BoardLength->EditValue) != "" && is_numeric($this->BoardLength->EditValue)) {
				$this->BoardLength->EditValue = FormatNumber($this->BoardLength->EditValue, -2, -2, -2, -2);
				$this->BoardLength->OldValue = $this->BoardLength->EditValue;
			}
			

			// BoardWidth
			$this->BoardWidth->EditAttrs["class"] = "form-control";
			$this->BoardWidth->EditCustomAttributes = "";
			$this->BoardWidth->EditValue = HtmlEncode($this->BoardWidth->CurrentValue);
			$this->BoardWidth->PlaceHolder = RemoveHtml($this->BoardWidth->caption());
			if (strval($this->BoardWidth->EditValue) != "" && is_numeric($this->BoardWidth->EditValue)) {
				$this->BoardWidth->EditValue = FormatNumber($this->BoardWidth->EditValue, -2, -2, -2, -2);
				$this->BoardWidth->OldValue = $this->BoardWidth->EditValue;
			}
			

			// BoardSize
			$this->BoardSize->EditAttrs["class"] = "form-control";
			$this->BoardSize->EditCustomAttributes = "";
			$this->BoardSize->EditValue = HtmlEncode($this->BoardSize->CurrentValue);
			$this->BoardSize->PlaceHolder = RemoveHtml($this->BoardSize->caption());
			if (strval($this->BoardSize->EditValue) != "" && is_numeric($this->BoardSize->EditValue)) {
				$this->BoardSize->EditValue = FormatNumber($this->BoardSize->EditValue, -2, -2, -2, -2);
				$this->BoardSize->OldValue = $this->BoardSize->EditValue;
			}
			

			// BoardType
			$this->BoardType->EditAttrs["class"] = "form-control";
			$this->BoardType->EditCustomAttributes = "";
			$curVal = trim(strval($this->BoardType->CurrentValue));
			if ($curVal != "")
				$this->BoardType->ViewValue = $this->BoardType->lookupCacheOption($curVal);
			else
				$this->BoardType->ViewValue = $this->BoardType->Lookup !== NULL && is_array($this->BoardType->Lookup->Options) ? $curVal : NULL;
			if ($this->BoardType->ViewValue !== NULL) { // Load from cache
				$this->BoardType->EditValue = array_values($this->BoardType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BoardType`" . SearchString("=", $this->BoardType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BoardType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BoardType->EditValue = $arwrk;
			}

			// BoardLocation
			$this->BoardLocation->EditAttrs["class"] = "form-control";
			$this->BoardLocation->EditCustomAttributes = "";
			if (!$this->BoardLocation->Raw)
				$this->BoardLocation->CurrentValue = HtmlDecode($this->BoardLocation->CurrentValue);
			$this->BoardLocation->EditValue = HtmlEncode($this->BoardLocation->CurrentValue);
			$this->BoardLocation->PlaceHolder = RemoveHtml($this->BoardLocation->caption());

			// BoardStatus
			$this->BoardStatus->EditAttrs["class"] = "form-control";
			$this->BoardStatus->EditCustomAttributes = "";
			$this->BoardStatus->EditValue = HtmlEncode($this->BoardStatus->CurrentValue);
			$this->BoardStatus->PlaceHolder = RemoveHtml($this->BoardStatus->caption());

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->CurrentValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// StreetAddress
			$this->StreetAddress->EditAttrs["class"] = "form-control";
			$this->StreetAddress->EditCustomAttributes = "";
			if (!$this->StreetAddress->Raw)
				$this->StreetAddress->CurrentValue = HtmlDecode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->EditValue = HtmlEncode($this->StreetAddress->CurrentValue);
			$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->CurrentValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());
			if (strval($this->Longitude->EditValue) != "" && is_numeric($this->Longitude->EditValue)) {
				$this->Longitude->EditValue = FormatNumber($this->Longitude->EditValue, -2, -1, -2, 0);
				$this->Longitude->OldValue = $this->Longitude->EditValue;
			}
			

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->CurrentValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());
			if (strval($this->Latitude->EditValue) != "" && is_numeric($this->Latitude->EditValue)) {
				$this->Latitude->EditValue = FormatNumber($this->Latitude->EditValue, -2, -1, -2, 0);
				$this->Latitude->OldValue = $this->Latitude->EditValue;
			}
			

			// Incumberance
			$this->Incumberance->EditAttrs["class"] = "form-control";
			$this->Incumberance->EditCustomAttributes = "";
			if (!$this->Incumberance->Raw)
				$this->Incumberance->CurrentValue = HtmlDecode($this->Incumberance->CurrentValue);
			$this->Incumberance->EditValue = HtmlEncode($this->Incumberance->CurrentValue);
			$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

			// StartDate
			$this->StartDate->EditAttrs["class"] = "form-control";
			$this->StartDate->EditCustomAttributes = "";
			$this->StartDate->EditValue = HtmlEncode(FormatDateTime($this->StartDate->CurrentValue, 8));
			$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

			// EndDate
			$this->EndDate->EditAttrs["class"] = "form-control";
			$this->EndDate->EditCustomAttributes = "";
			$this->EndDate->EditValue = HtmlEncode(FormatDateTime($this->EndDate->CurrentValue, 8));
			$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

			// Edit refer script
			// BillBoardNo

			$this->BillBoardNo->LinkCustomAttributes = "";
			$this->BillBoardNo->HrefValue = "";

			// BoardStandNo
			$this->BoardStandNo->LinkCustomAttributes = "";
			$this->BoardStandNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";

			// BoardLength
			$this->BoardLength->LinkCustomAttributes = "";
			$this->BoardLength->HrefValue = "";

			// BoardWidth
			$this->BoardWidth->LinkCustomAttributes = "";
			$this->BoardWidth->HrefValue = "";

			// BoardSize
			$this->BoardSize->LinkCustomAttributes = "";
			$this->BoardSize->HrefValue = "";

			// BoardType
			$this->BoardType->LinkCustomAttributes = "";
			$this->BoardType->HrefValue = "";

			// BoardLocation
			$this->BoardLocation->LinkCustomAttributes = "";
			$this->BoardLocation->HrefValue = "";

			// BoardStatus
			$this->BoardStatus->LinkCustomAttributes = "";
			$this->BoardStatus->HrefValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
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
		if ($this->BillBoardNo->Required) {
			if (!$this->BillBoardNo->IsDetailKey && $this->BillBoardNo->FormValue != NULL && $this->BillBoardNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillBoardNo->caption(), $this->BillBoardNo->RequiredErrorMessage));
			}
		}
		if ($this->BoardStandNo->Required) {
			if (!$this->BoardStandNo->IsDetailKey && $this->BoardStandNo->FormValue != NULL && $this->BoardStandNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardStandNo->caption(), $this->BoardStandNo->RequiredErrorMessage));
			}
		}
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ClientSerNo->FormValue)) {
			AddMessage($FormError, $this->ClientSerNo->errorMessage());
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
			}
		}
		if ($this->BoardLength->Required) {
			if (!$this->BoardLength->IsDetailKey && $this->BoardLength->FormValue != NULL && $this->BoardLength->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardLength->caption(), $this->BoardLength->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BoardLength->FormValue)) {
			AddMessage($FormError, $this->BoardLength->errorMessage());
		}
		if ($this->BoardWidth->Required) {
			if (!$this->BoardWidth->IsDetailKey && $this->BoardWidth->FormValue != NULL && $this->BoardWidth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardWidth->caption(), $this->BoardWidth->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BoardWidth->FormValue)) {
			AddMessage($FormError, $this->BoardWidth->errorMessage());
		}
		if ($this->BoardSize->Required) {
			if (!$this->BoardSize->IsDetailKey && $this->BoardSize->FormValue != NULL && $this->BoardSize->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardSize->caption(), $this->BoardSize->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BoardSize->FormValue)) {
			AddMessage($FormError, $this->BoardSize->errorMessage());
		}
		if ($this->BoardType->Required) {
			if (!$this->BoardType->IsDetailKey && $this->BoardType->FormValue != NULL && $this->BoardType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardType->caption(), $this->BoardType->RequiredErrorMessage));
			}
		}
		if ($this->BoardLocation->Required) {
			if (!$this->BoardLocation->IsDetailKey && $this->BoardLocation->FormValue != NULL && $this->BoardLocation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardLocation->caption(), $this->BoardLocation->RequiredErrorMessage));
			}
		}
		if ($this->BoardStatus->Required) {
			if (!$this->BoardStatus->IsDetailKey && $this->BoardStatus->FormValue != NULL && $this->BoardStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BoardStatus->caption(), $this->BoardStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BoardStatus->FormValue)) {
			AddMessage($FormError, $this->BoardStatus->errorMessage());
		}
		if ($this->ExemptCode->Required) {
			if (!$this->ExemptCode->IsDetailKey && $this->ExemptCode->FormValue != NULL && $this->ExemptCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExemptCode->caption(), $this->ExemptCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ExemptCode->FormValue)) {
			AddMessage($FormError, $this->ExemptCode->errorMessage());
		}
		if ($this->StreetAddress->Required) {
			if (!$this->StreetAddress->IsDetailKey && $this->StreetAddress->FormValue != NULL && $this->StreetAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StreetAddress->caption(), $this->StreetAddress->RequiredErrorMessage));
			}
		}
		if ($this->Longitude->Required) {
			if (!$this->Longitude->IsDetailKey && $this->Longitude->FormValue != NULL && $this->Longitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Longitude->caption(), $this->Longitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Longitude->FormValue)) {
			AddMessage($FormError, $this->Longitude->errorMessage());
		}
		if ($this->Latitude->Required) {
			if (!$this->Latitude->IsDetailKey && $this->Latitude->FormValue != NULL && $this->Latitude->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Latitude->caption(), $this->Latitude->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Latitude->FormValue)) {
			AddMessage($FormError, $this->Latitude->errorMessage());
		}
		if ($this->Incumberance->Required) {
			if (!$this->Incumberance->IsDetailKey && $this->Incumberance->FormValue != NULL && $this->Incumberance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Incumberance->caption(), $this->Incumberance->RequiredErrorMessage));
			}
		}
		if ($this->StartDate->Required) {
			if (!$this->StartDate->IsDetailKey && $this->StartDate->FormValue != NULL && $this->StartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StartDate->caption(), $this->StartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->StartDate->FormValue)) {
			AddMessage($FormError, $this->StartDate->errorMessage());
		}
		if ($this->EndDate->Required) {
			if (!$this->EndDate->IsDetailKey && $this->EndDate->FormValue != NULL && $this->EndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EndDate->caption(), $this->EndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->EndDate->FormValue)) {
			AddMessage($FormError, $this->EndDate->errorMessage());
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
				$thisKey .= $row['BillBoardNo'];
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

			// BoardStandNo
			$this->BoardStandNo->setDbValueDef($rsnew, $this->BoardStandNo->CurrentValue, NULL, $this->BoardStandNo->ReadOnly);

			// ClientSerNo
			$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, NULL, $this->ClientSerNo->ReadOnly);

			// ClientID
			$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, $this->ClientID->ReadOnly);

			// BoardLength
			$this->BoardLength->setDbValueDef($rsnew, $this->BoardLength->CurrentValue, NULL, $this->BoardLength->ReadOnly);

			// BoardWidth
			$this->BoardWidth->setDbValueDef($rsnew, $this->BoardWidth->CurrentValue, NULL, $this->BoardWidth->ReadOnly);

			// BoardSize
			$this->BoardSize->setDbValueDef($rsnew, $this->BoardSize->CurrentValue, NULL, $this->BoardSize->ReadOnly);

			// BoardType
			$this->BoardType->setDbValueDef($rsnew, $this->BoardType->CurrentValue, NULL, $this->BoardType->ReadOnly);

			// BoardLocation
			$this->BoardLocation->setDbValueDef($rsnew, $this->BoardLocation->CurrentValue, NULL, $this->BoardLocation->ReadOnly);

			// BoardStatus
			$this->BoardStatus->setDbValueDef($rsnew, $this->BoardStatus->CurrentValue, NULL, $this->BoardStatus->ReadOnly);

			// ExemptCode
			$this->ExemptCode->setDbValueDef($rsnew, $this->ExemptCode->CurrentValue, NULL, $this->ExemptCode->ReadOnly);

			// StreetAddress
			$this->StreetAddress->setDbValueDef($rsnew, $this->StreetAddress->CurrentValue, NULL, $this->StreetAddress->ReadOnly);

			// Longitude
			$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, $this->Longitude->ReadOnly);

			// Latitude
			$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, $this->Latitude->ReadOnly);

			// Incumberance
			$this->Incumberance->setDbValueDef($rsnew, $this->Incumberance->CurrentValue, NULL, $this->Incumberance->ReadOnly);

			// StartDate
			$this->StartDate->setDbValueDef($rsnew, UnFormatDateTime($this->StartDate->CurrentValue, 0), NULL, $this->StartDate->ReadOnly);

			// EndDate
			$this->EndDate->setDbValueDef($rsnew, UnFormatDateTime($this->EndDate->CurrentValue, 0), NULL, $this->EndDate->ReadOnly);

			// Check referential integrity for master table 'client'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_client();
			$keyValue = isset($rsnew['ClientSerNo']) ? $rsnew['ClientSerNo'] : $rsold['ClientSerNo'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@ClientSerNo@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["client"]))
					$GLOBALS["client"] = new client();
				$rsmaster = $GLOBALS["client"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "client", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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
			if ($this->getCurrentMasterTable() == "client") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
			}

		// Check referential integrity for master table 'bill_board'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_client();
		if (strval($this->ClientSerNo->CurrentValue) != "") {
			$masterFilter = str_replace("@ClientSerNo@", AdjustSql($this->ClientSerNo->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["client"]))
				$GLOBALS["client"] = new client();
			$rsmaster = $GLOBALS["client"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "client", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// BoardStandNo
		$this->BoardStandNo->setDbValueDef($rsnew, $this->BoardStandNo->CurrentValue, NULL, FALSE);

		// ClientSerNo
		$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, NULL, FALSE);

		// ClientID
		$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, FALSE);

		// BoardLength
		$this->BoardLength->setDbValueDef($rsnew, $this->BoardLength->CurrentValue, NULL, strval($this->BoardLength->CurrentValue) == "");

		// BoardWidth
		$this->BoardWidth->setDbValueDef($rsnew, $this->BoardWidth->CurrentValue, NULL, strval($this->BoardWidth->CurrentValue) == "");

		// BoardSize
		$this->BoardSize->setDbValueDef($rsnew, $this->BoardSize->CurrentValue, NULL, strval($this->BoardSize->CurrentValue) == "");

		// BoardType
		$this->BoardType->setDbValueDef($rsnew, $this->BoardType->CurrentValue, NULL, strval($this->BoardType->CurrentValue) == "");

		// BoardLocation
		$this->BoardLocation->setDbValueDef($rsnew, $this->BoardLocation->CurrentValue, NULL, FALSE);

		// BoardStatus
		$this->BoardStatus->setDbValueDef($rsnew, $this->BoardStatus->CurrentValue, NULL, strval($this->BoardStatus->CurrentValue) == "");

		// ExemptCode
		$this->ExemptCode->setDbValueDef($rsnew, $this->ExemptCode->CurrentValue, NULL, strval($this->ExemptCode->CurrentValue) == "");

		// StreetAddress
		$this->StreetAddress->setDbValueDef($rsnew, $this->StreetAddress->CurrentValue, NULL, FALSE);

		// Longitude
		$this->Longitude->setDbValueDef($rsnew, $this->Longitude->CurrentValue, NULL, FALSE);

		// Latitude
		$this->Latitude->setDbValueDef($rsnew, $this->Latitude->CurrentValue, NULL, FALSE);

		// Incumberance
		$this->Incumberance->setDbValueDef($rsnew, $this->Incumberance->CurrentValue, NULL, FALSE);

		// StartDate
		$this->StartDate->setDbValueDef($rsnew, UnFormatDateTime($this->StartDate->CurrentValue, 0), NULL, FALSE);

		// EndDate
		$this->EndDate->setDbValueDef($rsnew, UnFormatDateTime($this->EndDate->CurrentValue, 0), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
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
		if ($masterTblVar == "client") {
			$this->ClientSerNo->Visible = FALSE;
			if ($GLOBALS["client"]->EventCancelled)
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
				case "x_ClientSerNo":
					break;
				case "x_BoardType":
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
						case "x_ClientSerNo":
							break;
						case "x_BoardType":
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