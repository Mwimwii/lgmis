<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipts_view_grid extends receipts_view
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipts_view';

	// Page object name
	public $PageObjName = "receipts_view_grid";

	// Grid form hidden field names
	public $FormName = "freceipts_viewgrid";
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

		// Table object (receipts_view)
		if (!isset($GLOBALS["receipts_view"]) || get_class($GLOBALS["receipts_view"]) == PROJECT_NAMESPACE . "receipts_view") {
			$GLOBALS["receipts_view"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["receipts_view"];

		}
		$this->AddUrl = "receipts_viewadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipts_view');

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
		global $receipts_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipts_view);
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
			$key .= @$ar['ReceiptNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ClientSerNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ChargeCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ItemID'];
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
		$this->ReceiptNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->ItemID->setVisibility();
		$this->UnitCost->setVisibility();
		$this->Quantity->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->PaymentRef->setVisibility();
		$this->CashierNo->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->BillYear->setVisibility();
		$this->PaymentFor->setVisibility();
		$this->AdditionalInformation->Visible = FALSE;
		$this->ChargeGroup->setVisibility();
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
		$this->setupLookupOptions($this->ChargeCode);
		$this->setupLookupOptions($this->PaymentMethod);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "_property_account_view") {
			global $_property_account_view;
			$rsmaster = $_property_account_view->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("_property_account_viewlist.php"); // Return to master page
			} else {
				$_property_account_view->loadListRowValues($rsmaster);
				$_property_account_view->RowType = ROWTYPE_MASTER; // Master row
				$_property_account_view->renderListRow();
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
		$this->UnitCost->FormValue = ""; // Clear form value
		$this->Quantity->FormValue = ""; // Clear form value
		$this->AmountPaid->FormValue = ""; // Clear form value
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
		if (count($arKeyFlds) >= 4) {
			$this->ReceiptNo->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ReceiptNo->OldValue))
				return FALSE;
			$this->ClientSerNo->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->ClientSerNo->OldValue))
				return FALSE;
			$this->ChargeCode->setOldValue($arKeyFlds[2]);
			if (!is_numeric($this->ChargeCode->OldValue))
				return FALSE;
			$this->ItemID->setOldValue($arKeyFlds[3]);
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
					$key .= $this->ReceiptNo->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ClientSerNo->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ChargeCode->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ItemID->CurrentValue;

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
		if ($CurrentForm->hasValue("x_ReceiptNo") && $CurrentForm->hasValue("o_ReceiptNo") && $this->ReceiptNo->CurrentValue != $this->ReceiptNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ClientSerNo") && $CurrentForm->hasValue("o_ClientSerNo") && $this->ClientSerNo->CurrentValue != $this->ClientSerNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeCode") && $CurrentForm->hasValue("o_ChargeCode") && $this->ChargeCode->CurrentValue != $this->ChargeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ReceiptDate") && $CurrentForm->hasValue("o_ReceiptDate") && $this->ReceiptDate->CurrentValue != $this->ReceiptDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ItemID") && $CurrentForm->hasValue("o_ItemID") && $this->ItemID->CurrentValue != $this->ItemID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitCost") && $CurrentForm->hasValue("o_UnitCost") && $this->UnitCost->CurrentValue != $this->UnitCost->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Quantity") && $CurrentForm->hasValue("o_Quantity") && $this->Quantity->CurrentValue != $this->Quantity->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitOfMeasure") && $CurrentForm->hasValue("o_UnitOfMeasure") && $this->UnitOfMeasure->CurrentValue != $this->UnitOfMeasure->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AmountPaid") && $CurrentForm->hasValue("o_AmountPaid") && $this->AmountPaid->CurrentValue != $this->AmountPaid->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentMethod") && $CurrentForm->hasValue("o_PaymentMethod") && $this->PaymentMethod->CurrentValue != $this->PaymentMethod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentRef") && $CurrentForm->hasValue("o_PaymentRef") && $this->PaymentRef->CurrentValue != $this->PaymentRef->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CashierNo") && $CurrentForm->hasValue("o_CashierNo") && $this->CashierNo->CurrentValue != $this->CashierNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BillPeriod") && $CurrentForm->hasValue("o_BillPeriod") && $this->BillPeriod->CurrentValue != $this->BillPeriod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BillYear") && $CurrentForm->hasValue("o_BillYear") && $this->BillYear->CurrentValue != $this->BillYear->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentFor") && $CurrentForm->hasValue("o_PaymentFor") && $this->PaymentFor->CurrentValue != $this->PaymentFor->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeGroup") && $CurrentForm->hasValue("o_ChargeGroup") && $this->ChargeGroup->CurrentValue != $this->ChargeGroup->OldValue)
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
				$this->BillYear->setSessionValue("");
				$this->BillPeriod->setSessionValue("");
				$this->ItemID->setSessionValue("");
				$this->ClientSerNo->setSessionValue("");
				$this->ChargeCode->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ReceiptNo->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->ClientSerNo->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->ChargeCode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->ItemID->CurrentValue . "\">";
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
		$key .= $rs->fields('ReceiptNo');
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('ClientSerNo');
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('ChargeCode');
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('ItemID');
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
		$this->ReceiptNo->CurrentValue = 0;
		$this->ReceiptNo->OldValue = $this->ReceiptNo->CurrentValue;
		$this->ClientSerNo->CurrentValue = 0;
		$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
		$this->ChargeCode->CurrentValue = 0;
		$this->ChargeCode->OldValue = $this->ChargeCode->CurrentValue;
		$this->ReceiptDate->CurrentValue = NULL;
		$this->ReceiptDate->OldValue = $this->ReceiptDate->CurrentValue;
		$this->ItemID->CurrentValue = NULL;
		$this->ItemID->OldValue = $this->ItemID->CurrentValue;
		$this->UnitCost->CurrentValue = NULL;
		$this->UnitCost->OldValue = $this->UnitCost->CurrentValue;
		$this->Quantity->CurrentValue = NULL;
		$this->Quantity->OldValue = $this->Quantity->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->AmountPaid->CurrentValue = NULL;
		$this->AmountPaid->OldValue = $this->AmountPaid->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentRef->CurrentValue = NULL;
		$this->PaymentRef->OldValue = $this->PaymentRef->CurrentValue;
		$this->CashierNo->CurrentValue = NULL;
		$this->CashierNo->OldValue = $this->CashierNo->CurrentValue;
		$this->BillPeriod->CurrentValue = NULL;
		$this->BillPeriod->OldValue = $this->BillPeriod->CurrentValue;
		$this->BillYear->CurrentValue = NULL;
		$this->BillYear->OldValue = $this->BillYear->CurrentValue;
		$this->PaymentFor->CurrentValue = NULL;
		$this->PaymentFor->OldValue = $this->PaymentFor->CurrentValue;
		$this->AdditionalInformation->CurrentValue = NULL;
		$this->AdditionalInformation->OldValue = $this->AdditionalInformation->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'ReceiptNo' first before field var 'x_ReceiptNo'
		$val = $CurrentForm->hasValue("ReceiptNo") ? $CurrentForm->getValue("ReceiptNo") : $CurrentForm->getValue("x_ReceiptNo");
		if (!$this->ReceiptNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptNo->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ReceiptNo"))
			$this->ReceiptNo->setOldValue($CurrentForm->getValue("o_ReceiptNo"));

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

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeCode"))
			$this->ChargeCode->setOldValue($CurrentForm->getValue("o_ChargeCode"));

		// Check field name 'ReceiptDate' first before field var 'x_ReceiptDate'
		$val = $CurrentForm->hasValue("ReceiptDate") ? $CurrentForm->getValue("ReceiptDate") : $CurrentForm->getValue("x_ReceiptDate");
		if (!$this->ReceiptDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptDate->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptDate->setFormValue($val);
			$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_ReceiptDate"))
			$this->ReceiptDate->setOldValue($CurrentForm->getValue("o_ReceiptDate"));

		// Check field name 'ItemID' first before field var 'x_ItemID'
		$val = $CurrentForm->hasValue("ItemID") ? $CurrentForm->getValue("ItemID") : $CurrentForm->getValue("x_ItemID");
		if (!$this->ItemID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemID->Visible = FALSE; // Disable update for API request
			else
				$this->ItemID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ItemID"))
			$this->ItemID->setOldValue($CurrentForm->getValue("o_ItemID"));

		// Check field name 'UnitCost' first before field var 'x_UnitCost'
		$val = $CurrentForm->hasValue("UnitCost") ? $CurrentForm->getValue("UnitCost") : $CurrentForm->getValue("x_UnitCost");
		if (!$this->UnitCost->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitCost->Visible = FALSE; // Disable update for API request
			else
				$this->UnitCost->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_UnitCost"))
			$this->UnitCost->setOldValue($CurrentForm->getValue("o_UnitCost"));

		// Check field name 'Quantity' first before field var 'x_Quantity'
		$val = $CurrentForm->hasValue("Quantity") ? $CurrentForm->getValue("Quantity") : $CurrentForm->getValue("x_Quantity");
		if (!$this->Quantity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Quantity->Visible = FALSE; // Disable update for API request
			else
				$this->Quantity->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Quantity"))
			$this->Quantity->setOldValue($CurrentForm->getValue("o_Quantity"));

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_UnitOfMeasure"))
			$this->UnitOfMeasure->setOldValue($CurrentForm->getValue("o_UnitOfMeasure"));

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AmountPaid"))
			$this->AmountPaid->setOldValue($CurrentForm->getValue("o_AmountPaid"));

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

		// Check field name 'PaymentRef' first before field var 'x_PaymentRef'
		$val = $CurrentForm->hasValue("PaymentRef") ? $CurrentForm->getValue("PaymentRef") : $CurrentForm->getValue("x_PaymentRef");
		if (!$this->PaymentRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentRef->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentRef->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PaymentRef"))
			$this->PaymentRef->setOldValue($CurrentForm->getValue("o_PaymentRef"));

		// Check field name 'CashierNo' first before field var 'x_CashierNo'
		$val = $CurrentForm->hasValue("CashierNo") ? $CurrentForm->getValue("CashierNo") : $CurrentForm->getValue("x_CashierNo");
		if (!$this->CashierNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CashierNo->Visible = FALSE; // Disable update for API request
			else
				$this->CashierNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CashierNo"))
			$this->CashierNo->setOldValue($CurrentForm->getValue("o_CashierNo"));

		// Check field name 'BillPeriod' first before field var 'x_BillPeriod'
		$val = $CurrentForm->hasValue("BillPeriod") ? $CurrentForm->getValue("BillPeriod") : $CurrentForm->getValue("x_BillPeriod");
		if (!$this->BillPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->BillPeriod->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BillPeriod"))
			$this->BillPeriod->setOldValue($CurrentForm->getValue("o_BillPeriod"));

		// Check field name 'BillYear' first before field var 'x_BillYear'
		$val = $CurrentForm->hasValue("BillYear") ? $CurrentForm->getValue("BillYear") : $CurrentForm->getValue("x_BillYear");
		if (!$this->BillYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillYear->Visible = FALSE; // Disable update for API request
			else
				$this->BillYear->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BillYear"))
			$this->BillYear->setOldValue($CurrentForm->getValue("o_BillYear"));

		// Check field name 'PaymentFor' first before field var 'x_PaymentFor'
		$val = $CurrentForm->hasValue("PaymentFor") ? $CurrentForm->getValue("PaymentFor") : $CurrentForm->getValue("x_PaymentFor");
		if (!$this->PaymentFor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentFor->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentFor->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PaymentFor"))
			$this->PaymentFor->setOldValue($CurrentForm->getValue("o_PaymentFor"));

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeGroup"))
			$this->ChargeGroup->setOldValue($CurrentForm->getValue("o_ChargeGroup"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ReceiptNo->CurrentValue = $this->ReceiptNo->FormValue;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ReceiptDate->CurrentValue = $this->ReceiptDate->FormValue;
		$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 0);
		$this->ItemID->CurrentValue = $this->ItemID->FormValue;
		$this->UnitCost->CurrentValue = $this->UnitCost->FormValue;
		$this->Quantity->CurrentValue = $this->Quantity->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->PaymentRef->CurrentValue = $this->PaymentRef->FormValue;
		$this->CashierNo->CurrentValue = $this->CashierNo->FormValue;
		$this->BillPeriod->CurrentValue = $this->BillPeriod->FormValue;
		$this->BillYear->CurrentValue = $this->BillYear->FormValue;
		$this->PaymentFor->CurrentValue = $this->PaymentFor->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
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
		$this->ReceiptNo->setDbValue($row['ReceiptNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		$this->ReceiptDate->setDbValue($row['ReceiptDate']);
		$this->ItemID->setDbValue($row['ItemID']);
		$this->UnitCost->setDbValue($row['UnitCost']);
		$this->Quantity->setDbValue($row['Quantity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->PaymentRef->setDbValue($row['PaymentRef']);
		$this->CashierNo->setDbValue($row['CashierNo']);
		$this->BillPeriod->setDbValue($row['BillPeriod']);
		$this->BillYear->setDbValue($row['BillYear']);
		$this->PaymentFor->setDbValue($row['PaymentFor']);
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ReceiptNo'] = $this->ReceiptNo->CurrentValue;
		$row['ClientSerNo'] = $this->ClientSerNo->CurrentValue;
		$row['ChargeCode'] = $this->ChargeCode->CurrentValue;
		$row['ReceiptDate'] = $this->ReceiptDate->CurrentValue;
		$row['ItemID'] = $this->ItemID->CurrentValue;
		$row['UnitCost'] = $this->UnitCost->CurrentValue;
		$row['Quantity'] = $this->Quantity->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['AmountPaid'] = $this->AmountPaid->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		$row['PaymentRef'] = $this->PaymentRef->CurrentValue;
		$row['CashierNo'] = $this->CashierNo->CurrentValue;
		$row['BillPeriod'] = $this->BillPeriod->CurrentValue;
		$row['BillYear'] = $this->BillYear->CurrentValue;
		$row['PaymentFor'] = $this->PaymentFor->CurrentValue;
		$row['AdditionalInformation'] = $this->AdditionalInformation->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->RowOldKey);
		$cnt = count($keys);
		if ($cnt >= 4) {
			if (strval($keys[0]) != "")
				$this->ReceiptNo->OldValue = strval($keys[0]); // ReceiptNo
			else
				$validKey = FALSE;
			if (strval($keys[1]) != "")
				$this->ClientSerNo->OldValue = strval($keys[1]); // ClientSerNo
			else
				$validKey = FALSE;
			if (strval($keys[2]) != "")
				$this->ChargeCode->OldValue = strval($keys[2]); // ChargeCode
			else
				$validKey = FALSE;
			if (strval($keys[3]) != "")
				$this->ItemID->OldValue = strval($keys[3]); // ItemID
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
		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ReceiptNo
		// ClientSerNo
		// ChargeCode
		// ReceiptDate
		// ItemID
		// UnitCost
		// Quantity
		// UnitOfMeasure
		// AmountPaid
		// PaymentMethod
		// PaymentRef
		// CashierNo
		// BillPeriod
		// BillYear
		// PaymentFor
		// AdditionalInformation
		// ChargeGroup
		// Accumulate aggregate value

		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->AmountPaid->CurrentValue))
				$this->AmountPaid->Total += $this->AmountPaid->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$this->ReceiptNo->ViewCustomAttributes = "";

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

			// ChargeCode
			$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
			$curVal = strval($this->ChargeCode->CurrentValue);
			if ($curVal != "") {
				$this->ChargeCode->ViewValue = $this->ChargeCode->lookupCacheOption($curVal);
				if ($this->ChargeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
					}
				}
			} else {
				$this->ChargeCode->ViewValue = NULL;
			}
			$this->ChargeCode->ViewCustomAttributes = "";

			// ReceiptDate
			$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
			$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 0);
			$this->ReceiptDate->ViewCustomAttributes = "";

			// ItemID
			$this->ItemID->ViewValue = $this->ItemID->CurrentValue;
			$this->ItemID->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->ViewCustomAttributes = "";

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
			$this->Quantity->ViewCustomAttributes = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
					}
				}
			} else {
				$this->PaymentMethod->ViewValue = NULL;
			}
			$this->PaymentMethod->ViewCustomAttributes = "";

			// PaymentRef
			$this->PaymentRef->ViewValue = $this->PaymentRef->CurrentValue;
			$this->PaymentRef->ViewCustomAttributes = "";

			// CashierNo
			$this->CashierNo->ViewValue = $this->CashierNo->CurrentValue;
			$this->CashierNo->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewCustomAttributes = "";

			// BillYear
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewCustomAttributes = "";

			// PaymentFor
			$this->PaymentFor->ViewValue = $this->PaymentFor->CurrentValue;
			$this->PaymentFor->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";
			if (!$this->isExport())
				$this->ReceiptNo->ViewValue = $this->highlightValue($this->ReceiptNo);

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";
			$this->ItemID->TooltipValue = "";
			if (!$this->isExport())
				$this->ItemID->ViewValue = $this->highlightValue($this->ItemID);

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";
			if (!$this->isExport())
				$this->UnitOfMeasure->ViewValue = $this->highlightValue($this->UnitOfMeasure);

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";
			if (!$this->isExport())
				$this->PaymentMethod->ViewValue = $this->highlightValue($this->PaymentMethod);

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";
			$this->PaymentRef->TooltipValue = "";
			if (!$this->isExport())
				$this->PaymentRef->ViewValue = $this->highlightValue($this->PaymentRef);

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";
			$this->CashierNo->TooltipValue = "";
			if (!$this->isExport())
				$this->CashierNo->ViewValue = $this->highlightValue($this->CashierNo);

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";
			$this->BillPeriod->TooltipValue = "";
			if (!$this->isExport())
				$this->BillPeriod->ViewValue = $this->highlightValue($this->BillPeriod);

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";
			$this->BillYear->TooltipValue = "";
			if (!$this->isExport())
				$this->BillYear->ViewValue = $this->highlightValue($this->BillYear);

			// PaymentFor
			$this->PaymentFor->LinkCustomAttributes = "";
			$this->PaymentFor->HrefValue = "";
			$this->PaymentFor->TooltipValue = "";
			if (!$this->isExport())
				$this->PaymentFor->ViewValue = $this->highlightValue($this->PaymentFor);

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";
			if (!$this->isExport())
				$this->ChargeGroup->ViewValue = $this->highlightValue($this->ChargeGroup);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

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

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			if ($this->ChargeCode->getSessionValue() != "") {
				$this->ChargeCode->CurrentValue = $this->ChargeCode->getSessionValue();
				$this->ChargeCode->OldValue = $this->ChargeCode->CurrentValue;
				$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
				$curVal = strval($this->ChargeCode->CurrentValue);
				if ($curVal != "") {
					$this->ChargeCode->ViewValue = $this->ChargeCode->lookupCacheOption($curVal);
					if ($this->ChargeCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
						}
					}
				} else {
					$this->ChargeCode->ViewValue = NULL;
				}
				$this->ChargeCode->ViewCustomAttributes = "";
			} else {
				$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
				$curVal = strval($this->ChargeCode->CurrentValue);
				if ($curVal != "") {
					$this->ChargeCode->EditValue = $this->ChargeCode->lookupCacheOption($curVal);
					if ($this->ChargeCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
							$this->ChargeCode->EditValue = $this->ChargeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
						}
					}
				} else {
					$this->ChargeCode->EditValue = NULL;
				}
				$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());
			}

			// ReceiptDate
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue = HtmlEncode(FormatDateTime($this->ReceiptDate->CurrentValue, 8));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

			// ItemID
			$this->ItemID->EditAttrs["class"] = "form-control";
			$this->ItemID->EditCustomAttributes = "";
			if ($this->ItemID->getSessionValue() != "") {
				$this->ItemID->CurrentValue = $this->ItemID->getSessionValue();
				$this->ItemID->OldValue = $this->ItemID->CurrentValue;
				$this->ItemID->ViewValue = $this->ItemID->CurrentValue;
				$this->ItemID->ViewCustomAttributes = "";
			} else {
				if (!$this->ItemID->Raw)
					$this->ItemID->CurrentValue = HtmlDecode($this->ItemID->CurrentValue);
				$this->ItemID->EditValue = HtmlEncode($this->ItemID->CurrentValue);
				$this->ItemID->PlaceHolder = RemoveHtml($this->ItemID->caption());
			}

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->CurrentValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
			if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue)) {
				$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
				$this->UnitCost->OldValue = $this->UnitCost->EditValue;
			}
			

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->CurrentValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
			if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue)) {
				$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
				$this->Quantity->OldValue = $this->Quantity->EditValue;
			}
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			if (!$this->UnitOfMeasure->Raw)
				$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->EditValue = HtmlEncode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue)) {
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
				$this->AmountPaid->OldValue = $this->AmountPaid->EditValue;
			}
			

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->EditValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->EditValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PaymentMethod->EditValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
					}
				}
			} else {
				$this->PaymentMethod->EditValue = NULL;
			}
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// PaymentRef
			$this->PaymentRef->EditAttrs["class"] = "form-control";
			$this->PaymentRef->EditCustomAttributes = "";
			if (!$this->PaymentRef->Raw)
				$this->PaymentRef->CurrentValue = HtmlDecode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->EditValue = HtmlEncode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->PlaceHolder = RemoveHtml($this->PaymentRef->caption());

			// CashierNo
			$this->CashierNo->EditAttrs["class"] = "form-control";
			$this->CashierNo->EditCustomAttributes = "";
			if (!$this->CashierNo->Raw)
				$this->CashierNo->CurrentValue = HtmlDecode($this->CashierNo->CurrentValue);
			$this->CashierNo->EditValue = HtmlEncode($this->CashierNo->CurrentValue);
			$this->CashierNo->PlaceHolder = RemoveHtml($this->CashierNo->caption());

			// BillPeriod
			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			if ($this->BillPeriod->getSessionValue() != "") {
				$this->BillPeriod->CurrentValue = $this->BillPeriod->getSessionValue();
				$this->BillPeriod->OldValue = $this->BillPeriod->CurrentValue;
				$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
				$this->BillPeriod->ViewCustomAttributes = "";
			} else {
				$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->CurrentValue);
				$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());
			}

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			if ($this->BillYear->getSessionValue() != "") {
				$this->BillYear->CurrentValue = $this->BillYear->getSessionValue();
				$this->BillYear->OldValue = $this->BillYear->CurrentValue;
				$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
				$this->BillYear->ViewCustomAttributes = "";
			} else {
				$this->BillYear->EditValue = HtmlEncode($this->BillYear->CurrentValue);
				$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());
			}

			// PaymentFor
			$this->PaymentFor->EditAttrs["class"] = "form-control";
			$this->PaymentFor->EditCustomAttributes = "";
			if (!$this->PaymentFor->Raw)
				$this->PaymentFor->CurrentValue = HtmlDecode($this->PaymentFor->CurrentValue);
			$this->PaymentFor->EditValue = HtmlEncode($this->PaymentFor->CurrentValue);
			$this->PaymentFor->PlaceHolder = RemoveHtml($this->PaymentFor->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if (!$this->ChargeGroup->Raw)
				$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// Add refer script
			// ReceiptNo

			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";

			// PaymentFor
			$this->PaymentFor->LinkCustomAttributes = "";
			$this->PaymentFor->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
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

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
			$curVal = strval($this->ChargeCode->CurrentValue);
			if ($curVal != "") {
				$this->ChargeCode->EditValue = $this->ChargeCode->lookupCacheOption($curVal);
				if ($this->ChargeCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ChargeCode->EditValue = $this->ChargeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
					}
				}
			} else {
				$this->ChargeCode->EditValue = NULL;
			}
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ReceiptDate
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue = HtmlEncode(FormatDateTime($this->ReceiptDate->CurrentValue, 8));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

			// ItemID
			$this->ItemID->EditAttrs["class"] = "form-control";
			$this->ItemID->EditCustomAttributes = "";
			if (!$this->ItemID->Raw)
				$this->ItemID->CurrentValue = HtmlDecode($this->ItemID->CurrentValue);
			$this->ItemID->EditValue = HtmlEncode($this->ItemID->CurrentValue);
			$this->ItemID->PlaceHolder = RemoveHtml($this->ItemID->caption());

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->CurrentValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
			if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue)) {
				$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
				$this->UnitCost->OldValue = $this->UnitCost->EditValue;
			}
			

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->CurrentValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
			if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue)) {
				$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
				$this->Quantity->OldValue = $this->Quantity->EditValue;
			}
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			if (!$this->UnitOfMeasure->Raw)
				$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->EditValue = HtmlEncode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue)) {
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
				$this->AmountPaid->OldValue = $this->AmountPaid->EditValue;
			}
			

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->CurrentValue = HtmlDecode($this->PaymentMethod->CurrentValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->EditValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->EditValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PaymentMethod->EditValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->CurrentValue);
					}
				}
			} else {
				$this->PaymentMethod->EditValue = NULL;
			}
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// PaymentRef
			$this->PaymentRef->EditAttrs["class"] = "form-control";
			$this->PaymentRef->EditCustomAttributes = "";
			if (!$this->PaymentRef->Raw)
				$this->PaymentRef->CurrentValue = HtmlDecode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->EditValue = HtmlEncode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->PlaceHolder = RemoveHtml($this->PaymentRef->caption());

			// CashierNo
			$this->CashierNo->EditAttrs["class"] = "form-control";
			$this->CashierNo->EditCustomAttributes = "";
			if (!$this->CashierNo->Raw)
				$this->CashierNo->CurrentValue = HtmlDecode($this->CashierNo->CurrentValue);
			$this->CashierNo->EditValue = HtmlEncode($this->CashierNo->CurrentValue);
			$this->CashierNo->PlaceHolder = RemoveHtml($this->CashierNo->caption());

			// BillPeriod
			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			if ($this->BillPeriod->getSessionValue() != "") {
				$this->BillPeriod->CurrentValue = $this->BillPeriod->getSessionValue();
				$this->BillPeriod->OldValue = $this->BillPeriod->CurrentValue;
				$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
				$this->BillPeriod->ViewCustomAttributes = "";
			} else {
				$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->CurrentValue);
				$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());
			}

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			if ($this->BillYear->getSessionValue() != "") {
				$this->BillYear->CurrentValue = $this->BillYear->getSessionValue();
				$this->BillYear->OldValue = $this->BillYear->CurrentValue;
				$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
				$this->BillYear->ViewCustomAttributes = "";
			} else {
				$this->BillYear->EditValue = HtmlEncode($this->BillYear->CurrentValue);
				$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());
			}

			// PaymentFor
			$this->PaymentFor->EditAttrs["class"] = "form-control";
			$this->PaymentFor->EditCustomAttributes = "";
			if (!$this->PaymentFor->Raw)
				$this->PaymentFor->CurrentValue = HtmlDecode($this->PaymentFor->CurrentValue);
			$this->PaymentFor->EditValue = HtmlEncode($this->PaymentFor->CurrentValue);
			$this->PaymentFor->PlaceHolder = RemoveHtml($this->PaymentFor->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if (!$this->ChargeGroup->Raw)
				$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// Edit refer script
			// ReceiptNo

			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";

			// PaymentFor
			$this->PaymentFor->LinkCustomAttributes = "";
			$this->PaymentFor->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->AmountPaid->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->AmountPaid->CurrentValue = $this->AmountPaid->Total;
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->ViewCustomAttributes = "";
			$this->AmountPaid->HrefValue = ""; // Clear href value
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
		if ($this->ReceiptNo->Required) {
			if (!$this->ReceiptNo->IsDetailKey && $this->ReceiptNo->FormValue != NULL && $this->ReceiptNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptNo->caption(), $this->ReceiptNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ReceiptNo->FormValue)) {
			AddMessage($FormError, $this->ReceiptNo->errorMessage());
		}
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ClientSerNo->FormValue)) {
			AddMessage($FormError, $this->ClientSerNo->errorMessage());
		}
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ChargeCode->FormValue)) {
			AddMessage($FormError, $this->ChargeCode->errorMessage());
		}
		if ($this->ReceiptDate->Required) {
			if (!$this->ReceiptDate->IsDetailKey && $this->ReceiptDate->FormValue != NULL && $this->ReceiptDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptDate->caption(), $this->ReceiptDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ReceiptDate->FormValue)) {
			AddMessage($FormError, $this->ReceiptDate->errorMessage());
		}
		if ($this->ItemID->Required) {
			if (!$this->ItemID->IsDetailKey && $this->ItemID->FormValue != NULL && $this->ItemID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemID->caption(), $this->ItemID->RequiredErrorMessage));
			}
		}
		if ($this->UnitCost->Required) {
			if (!$this->UnitCost->IsDetailKey && $this->UnitCost->FormValue != NULL && $this->UnitCost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitCost->caption(), $this->UnitCost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->UnitCost->FormValue)) {
			AddMessage($FormError, $this->UnitCost->errorMessage());
		}
		if ($this->Quantity->Required) {
			if (!$this->Quantity->IsDetailKey && $this->Quantity->FormValue != NULL && $this->Quantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Quantity->caption(), $this->Quantity->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Quantity->FormValue)) {
			AddMessage($FormError, $this->Quantity->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
			}
		}
		if ($this->PaymentRef->Required) {
			if (!$this->PaymentRef->IsDetailKey && $this->PaymentRef->FormValue != NULL && $this->PaymentRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentRef->caption(), $this->PaymentRef->RequiredErrorMessage));
			}
		}
		if ($this->CashierNo->Required) {
			if (!$this->CashierNo->IsDetailKey && $this->CashierNo->FormValue != NULL && $this->CashierNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CashierNo->caption(), $this->CashierNo->RequiredErrorMessage));
			}
		}
		if ($this->BillPeriod->Required) {
			if (!$this->BillPeriod->IsDetailKey && $this->BillPeriod->FormValue != NULL && $this->BillPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillPeriod->caption(), $this->BillPeriod->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillPeriod->FormValue)) {
			AddMessage($FormError, $this->BillPeriod->errorMessage());
		}
		if ($this->BillYear->Required) {
			if (!$this->BillYear->IsDetailKey && $this->BillYear->FormValue != NULL && $this->BillYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillYear->caption(), $this->BillYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillYear->FormValue)) {
			AddMessage($FormError, $this->BillYear->errorMessage());
		}
		if ($this->PaymentFor->Required) {
			if (!$this->PaymentFor->IsDetailKey && $this->PaymentFor->FormValue != NULL && $this->PaymentFor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentFor->caption(), $this->PaymentFor->RequiredErrorMessage));
			}
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
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
				$thisKey .= $row['ReceiptNo'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ClientSerNo'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ChargeCode'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ItemID'];
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

			// ReceiptNo
			$this->ReceiptNo->setDbValueDef($rsnew, $this->ReceiptNo->CurrentValue, 0, $this->ReceiptNo->ReadOnly);

			// ClientSerNo
			$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, 0, $this->ClientSerNo->ReadOnly);

			// ChargeCode
			$this->ChargeCode->setDbValueDef($rsnew, $this->ChargeCode->CurrentValue, 0, $this->ChargeCode->ReadOnly);

			// ReceiptDate
			$this->ReceiptDate->setDbValueDef($rsnew, UnFormatDateTime($this->ReceiptDate->CurrentValue, 0), NULL, $this->ReceiptDate->ReadOnly);

			// ItemID
			$this->ItemID->setDbValueDef($rsnew, $this->ItemID->CurrentValue, "", $this->ItemID->ReadOnly);

			// UnitCost
			$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, NULL, $this->UnitCost->ReadOnly);

			// Quantity
			$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, NULL, $this->Quantity->ReadOnly);

			// UnitOfMeasure
			$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, $this->UnitOfMeasure->ReadOnly);

			// AmountPaid
			$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, $this->AmountPaid->ReadOnly);

			// PaymentMethod
			$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, "", $this->PaymentMethod->ReadOnly);

			// PaymentRef
			$this->PaymentRef->setDbValueDef($rsnew, $this->PaymentRef->CurrentValue, NULL, $this->PaymentRef->ReadOnly);

			// CashierNo
			$this->CashierNo->setDbValueDef($rsnew, $this->CashierNo->CurrentValue, NULL, $this->CashierNo->ReadOnly);

			// BillPeriod
			$this->BillPeriod->setDbValueDef($rsnew, $this->BillPeriod->CurrentValue, NULL, $this->BillPeriod->ReadOnly);

			// BillYear
			$this->BillYear->setDbValueDef($rsnew, $this->BillYear->CurrentValue, NULL, $this->BillYear->ReadOnly);

			// PaymentFor
			$this->PaymentFor->setDbValueDef($rsnew, $this->PaymentFor->CurrentValue, NULL, $this->PaymentFor->ReadOnly);

			// ChargeGroup
			$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, "", $this->ChargeGroup->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "_property_account_view") {
				$this->BillYear->CurrentValue = $this->BillYear->getSessionValue();
				$this->BillPeriod->CurrentValue = $this->BillPeriod->getSessionValue();
				$this->ItemID->CurrentValue = $this->ItemID->getSessionValue();
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
				$this->ChargeCode->CurrentValue = $this->ChargeCode->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ReceiptNo
		$this->ReceiptNo->setDbValueDef($rsnew, $this->ReceiptNo->CurrentValue, 0, FALSE);

		// ClientSerNo
		$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, 0, FALSE);

		// ChargeCode
		$this->ChargeCode->setDbValueDef($rsnew, $this->ChargeCode->CurrentValue, 0, FALSE);

		// ReceiptDate
		$this->ReceiptDate->setDbValueDef($rsnew, UnFormatDateTime($this->ReceiptDate->CurrentValue, 0), NULL, FALSE);

		// ItemID
		$this->ItemID->setDbValueDef($rsnew, $this->ItemID->CurrentValue, "", FALSE);

		// UnitCost
		$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, NULL, FALSE);

		// Quantity
		$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, NULL, strval($this->Quantity->CurrentValue) == "");

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, strval($this->UnitOfMeasure->CurrentValue) == "");

		// AmountPaid
		$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, FALSE);

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, "", FALSE);

		// PaymentRef
		$this->PaymentRef->setDbValueDef($rsnew, $this->PaymentRef->CurrentValue, NULL, FALSE);

		// CashierNo
		$this->CashierNo->setDbValueDef($rsnew, $this->CashierNo->CurrentValue, NULL, FALSE);

		// BillPeriod
		$this->BillPeriod->setDbValueDef($rsnew, $this->BillPeriod->CurrentValue, NULL, FALSE);

		// BillYear
		$this->BillYear->setDbValueDef($rsnew, $this->BillYear->CurrentValue, NULL, FALSE);

		// PaymentFor
		$this->PaymentFor->setDbValueDef($rsnew, $this->PaymentFor->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ReceiptNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ClientSerNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ChargeCode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ItemID']) == "") {
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
		if ($masterTblVar == "_property_account_view") {
			$this->BillYear->Visible = FALSE;
			if ($GLOBALS["_property_account_view"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->BillPeriod->Visible = FALSE;
			if ($GLOBALS["_property_account_view"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->ItemID->Visible = FALSE;
			if ($GLOBALS["_property_account_view"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->ClientSerNo->Visible = FALSE;
			if ($GLOBALS["_property_account_view"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->ChargeCode->Visible = FALSE;
			if ($GLOBALS["_property_account_view"]->EventCancelled)
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
				case "x_ChargeCode":
					break;
				case "x_PaymentMethod":
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
						case "x_ChargeCode":
							break;
						case "x_PaymentMethod":
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