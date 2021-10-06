<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staffdisciplinary_case_grid extends staffdisciplinary_case
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staffdisciplinary_case';

	// Page object name
	public $PageObjName = "staffdisciplinary_case_grid";

	// Grid form hidden field names
	public $FormName = "fstaffdisciplinary_casegrid";
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

		// Table object (staffdisciplinary_case)
		if (!isset($GLOBALS["staffdisciplinary_case"]) || get_class($GLOBALS["staffdisciplinary_case"]) == PROJECT_NAMESPACE . "staffdisciplinary_case") {
			$GLOBALS["staffdisciplinary_case"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["staffdisciplinary_case"];

		}
		$this->AddUrl = "staffdisciplinary_caseadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staffdisciplinary_case');

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
		global $staffdisciplinary_case;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staffdisciplinary_case);
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
			$key .= @$ar['CaseNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['OffenseCode'];
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
			$this->CaseNo->Visible = FALSE;
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
		$this->EmployeeID->Visible = FALSE;
		$this->CaseNo->setVisibility();
		$this->OffenseCode->setVisibility();
		$this->CaseDescription->Visible = FALSE;
		$this->ActionTaken->setVisibility();
		$this->OffenseDate->setVisibility();
		$this->ActionDate->setVisibility();
		$this->PenaltyQuantity->Visible = FALSE;
		$this->UnitOfMeasure->Visible = FALSE;
		$this->DateOfAppealLetter->setVisibility();
		$this->DateAppealReceived->setVisibility();
		$this->DateConcluded->setVisibility();
		$this->AppealStatus->setVisibility();
		$this->DiciplinaryHearing->Visible = FALSE;
		$this->AppealNotes->Visible = FALSE;
		$this->LastUpdate->Visible = FALSE;
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
		$this->setupLookupOptions($this->OffenseCode);
		$this->setupLookupOptions($this->ActionTaken);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->AppealStatus);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "staff") {
			global $staff;
			$rsmaster = $staff->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("stafflist.php"); // Return to master page
			} else {
				$staff->loadListRowValues($rsmaster);
				$staff->RowType = ROWTYPE_MASTER; // Master row
				$staff->renderListRow();
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
		if (count($arKeyFlds) >= 3) {
			$this->EmployeeID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->EmployeeID->OldValue))
				return FALSE;
			$this->CaseNo->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->CaseNo->OldValue))
				return FALSE;
			$this->OffenseCode->setOldValue($arKeyFlds[2]);
			if (!is_numeric($this->OffenseCode->OldValue))
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
					$key .= $this->EmployeeID->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->CaseNo->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->OffenseCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_OffenseCode") && $CurrentForm->hasValue("o_OffenseCode") && $this->OffenseCode->CurrentValue != $this->OffenseCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActionTaken") && $CurrentForm->hasValue("o_ActionTaken") && $this->ActionTaken->CurrentValue != $this->ActionTaken->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OffenseDate") && $CurrentForm->hasValue("o_OffenseDate") && $this->OffenseDate->CurrentValue != $this->OffenseDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActionDate") && $CurrentForm->hasValue("o_ActionDate") && $this->ActionDate->CurrentValue != $this->ActionDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfAppealLetter") && $CurrentForm->hasValue("o_DateOfAppealLetter") && $this->DateOfAppealLetter->CurrentValue != $this->DateOfAppealLetter->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateAppealReceived") && $CurrentForm->hasValue("o_DateAppealReceived") && $this->DateAppealReceived->CurrentValue != $this->DateAppealReceived->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateConcluded") && $CurrentForm->hasValue("o_DateConcluded") && $this->DateConcluded->CurrentValue != $this->DateConcluded->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AppealStatus") && $CurrentForm->hasValue("o_AppealStatus") && $this->AppealStatus->CurrentValue != $this->AppealStatus->OldValue)
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
				$this->EmployeeID->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CaseNo->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->OffenseCode->CurrentValue . "\">";
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
		$key .= $rs->fields('CaseNo');
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('OffenseCode');
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
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`CaseNo`=" . AdjustSql($this->CaseNo->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`OffenseCode`=" . AdjustSql($this->OffenseCode->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffdisciplinary_appeal"
		if ($this->DetailPages && $this->DetailPages["staffdisciplinary_appeal"] && $this->DetailPages["staffdisciplinary_appeal"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffdisciplinary_appeal"];
			$url = "staffdisciplinary_appealpreview.php?t=staffdisciplinary_case&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffdisciplinary_appeal\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_case')) {
				$label = $Language->TablePhrase("staffdisciplinary_appeal", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffdisciplinary_appeal\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffdisciplinary_appeallist.php?" . Config("TABLE_SHOW_MASTER") . "=staffdisciplinary_case&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "&fk_CaseNo=" . urlencode(strval($this->CaseNo->CurrentValue)) . "&fk_OffenseCode=" . urlencode(strval($this->OffenseCode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffdisciplinary_appeal", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
				$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staffdisciplinary_case')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staffdisciplinary_case')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staffdisciplinary_case')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`CaseNo`=" . AdjustSql($this->CaseNo->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffdisciplinary_action"
		if ($this->DetailPages && $this->DetailPages["staffdisciplinary_action"] && $this->DetailPages["staffdisciplinary_action"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffdisciplinary_action"];
			$url = "staffdisciplinary_actionpreview.php?t=staffdisciplinary_case&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffdisciplinary_action\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_case')) {
				$label = $Language->TablePhrase("staffdisciplinary_action", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffdisciplinary_action\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffdisciplinary_actionlist.php?" . Config("TABLE_SHOW_MASTER") . "=staffdisciplinary_case&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "&fk_CaseNo=" . urlencode(strval($this->CaseNo->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffdisciplinary_action", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
				$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staffdisciplinary_case')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staffdisciplinary_case')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staffdisciplinary_case')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
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
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->CaseNo->CurrentValue = NULL;
		$this->CaseNo->OldValue = $this->CaseNo->CurrentValue;
		$this->OffenseCode->CurrentValue = NULL;
		$this->OffenseCode->OldValue = $this->OffenseCode->CurrentValue;
		$this->CaseDescription->CurrentValue = NULL;
		$this->CaseDescription->OldValue = $this->CaseDescription->CurrentValue;
		$this->ActionTaken->CurrentValue = NULL;
		$this->ActionTaken->OldValue = $this->ActionTaken->CurrentValue;
		$this->OffenseDate->CurrentValue = NULL;
		$this->OffenseDate->OldValue = $this->OffenseDate->CurrentValue;
		$this->ActionDate->CurrentValue = NULL;
		$this->ActionDate->OldValue = $this->ActionDate->CurrentValue;
		$this->PenaltyQuantity->CurrentValue = NULL;
		$this->PenaltyQuantity->OldValue = $this->PenaltyQuantity->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->DateOfAppealLetter->CurrentValue = NULL;
		$this->DateOfAppealLetter->OldValue = $this->DateOfAppealLetter->CurrentValue;
		$this->DateAppealReceived->CurrentValue = NULL;
		$this->DateAppealReceived->OldValue = $this->DateAppealReceived->CurrentValue;
		$this->DateConcluded->CurrentValue = NULL;
		$this->DateConcluded->OldValue = $this->DateConcluded->CurrentValue;
		$this->AppealStatus->CurrentValue = NULL;
		$this->AppealStatus->OldValue = $this->AppealStatus->CurrentValue;
		$this->DiciplinaryHearing->CurrentValue = NULL;
		$this->DiciplinaryHearing->OldValue = $this->DiciplinaryHearing->CurrentValue;
		$this->AppealNotes->CurrentValue = NULL;
		$this->AppealNotes->OldValue = $this->AppealNotes->CurrentValue;
		$this->LastUpdate->CurrentValue = NULL;
		$this->LastUpdate->OldValue = $this->LastUpdate->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'CaseNo' first before field var 'x_CaseNo'
		$val = $CurrentForm->hasValue("CaseNo") ? $CurrentForm->getValue("CaseNo") : $CurrentForm->getValue("x_CaseNo");
		if (!$this->CaseNo->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->CaseNo->setFormValue($val);

		// Check field name 'OffenseCode' first before field var 'x_OffenseCode'
		$val = $CurrentForm->hasValue("OffenseCode") ? $CurrentForm->getValue("OffenseCode") : $CurrentForm->getValue("x_OffenseCode");
		if (!$this->OffenseCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OffenseCode->Visible = FALSE; // Disable update for API request
			else
				$this->OffenseCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OffenseCode"))
			$this->OffenseCode->setOldValue($CurrentForm->getValue("o_OffenseCode"));

		// Check field name 'ActionTaken' first before field var 'x_ActionTaken'
		$val = $CurrentForm->hasValue("ActionTaken") ? $CurrentForm->getValue("ActionTaken") : $CurrentForm->getValue("x_ActionTaken");
		if (!$this->ActionTaken->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionTaken->Visible = FALSE; // Disable update for API request
			else
				$this->ActionTaken->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ActionTaken"))
			$this->ActionTaken->setOldValue($CurrentForm->getValue("o_ActionTaken"));

		// Check field name 'OffenseDate' first before field var 'x_OffenseDate'
		$val = $CurrentForm->hasValue("OffenseDate") ? $CurrentForm->getValue("OffenseDate") : $CurrentForm->getValue("x_OffenseDate");
		if (!$this->OffenseDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OffenseDate->Visible = FALSE; // Disable update for API request
			else
				$this->OffenseDate->setFormValue($val);
			$this->OffenseDate->CurrentValue = UnFormatDateTime($this->OffenseDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_OffenseDate"))
			$this->OffenseDate->setOldValue($CurrentForm->getValue("o_OffenseDate"));

		// Check field name 'ActionDate' first before field var 'x_ActionDate'
		$val = $CurrentForm->hasValue("ActionDate") ? $CurrentForm->getValue("ActionDate") : $CurrentForm->getValue("x_ActionDate");
		if (!$this->ActionDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActionDate->setFormValue($val);
			$this->ActionDate->CurrentValue = UnFormatDateTime($this->ActionDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_ActionDate"))
			$this->ActionDate->setOldValue($CurrentForm->getValue("o_ActionDate"));

		// Check field name 'DateOfAppealLetter' first before field var 'x_DateOfAppealLetter'
		$val = $CurrentForm->hasValue("DateOfAppealLetter") ? $CurrentForm->getValue("DateOfAppealLetter") : $CurrentForm->getValue("x_DateOfAppealLetter");
		if (!$this->DateOfAppealLetter->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfAppealLetter->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfAppealLetter->setFormValue($val);
			$this->DateOfAppealLetter->CurrentValue = UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfAppealLetter"))
			$this->DateOfAppealLetter->setOldValue($CurrentForm->getValue("o_DateOfAppealLetter"));

		// Check field name 'DateAppealReceived' first before field var 'x_DateAppealReceived'
		$val = $CurrentForm->hasValue("DateAppealReceived") ? $CurrentForm->getValue("DateAppealReceived") : $CurrentForm->getValue("x_DateAppealReceived");
		if (!$this->DateAppealReceived->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateAppealReceived->Visible = FALSE; // Disable update for API request
			else
				$this->DateAppealReceived->setFormValue($val);
			$this->DateAppealReceived->CurrentValue = UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateAppealReceived"))
			$this->DateAppealReceived->setOldValue($CurrentForm->getValue("o_DateAppealReceived"));

		// Check field name 'DateConcluded' first before field var 'x_DateConcluded'
		$val = $CurrentForm->hasValue("DateConcluded") ? $CurrentForm->getValue("DateConcluded") : $CurrentForm->getValue("x_DateConcluded");
		if (!$this->DateConcluded->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateConcluded->Visible = FALSE; // Disable update for API request
			else
				$this->DateConcluded->setFormValue($val);
			$this->DateConcluded->CurrentValue = UnFormatDateTime($this->DateConcluded->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateConcluded"))
			$this->DateConcluded->setOldValue($CurrentForm->getValue("o_DateConcluded"));

		// Check field name 'AppealStatus' first before field var 'x_AppealStatus'
		$val = $CurrentForm->hasValue("AppealStatus") ? $CurrentForm->getValue("AppealStatus") : $CurrentForm->getValue("x_AppealStatus");
		if (!$this->AppealStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AppealStatus->Visible = FALSE; // Disable update for API request
			else
				$this->AppealStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AppealStatus"))
			$this->AppealStatus->setOldValue($CurrentForm->getValue("o_AppealStatus"));

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey)
			$this->EmployeeID->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->CaseNo->CurrentValue = $this->CaseNo->FormValue;
		$this->OffenseCode->CurrentValue = $this->OffenseCode->FormValue;
		$this->ActionTaken->CurrentValue = $this->ActionTaken->FormValue;
		$this->OffenseDate->CurrentValue = $this->OffenseDate->FormValue;
		$this->OffenseDate->CurrentValue = UnFormatDateTime($this->OffenseDate->CurrentValue, 0);
		$this->ActionDate->CurrentValue = $this->ActionDate->FormValue;
		$this->ActionDate->CurrentValue = UnFormatDateTime($this->ActionDate->CurrentValue, 0);
		$this->DateOfAppealLetter->CurrentValue = $this->DateOfAppealLetter->FormValue;
		$this->DateOfAppealLetter->CurrentValue = UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0);
		$this->DateAppealReceived->CurrentValue = $this->DateAppealReceived->FormValue;
		$this->DateAppealReceived->CurrentValue = UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0);
		$this->DateConcluded->CurrentValue = $this->DateConcluded->FormValue;
		$this->DateConcluded->CurrentValue = UnFormatDateTime($this->DateConcluded->CurrentValue, 0);
		$this->AppealStatus->CurrentValue = $this->AppealStatus->FormValue;
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
		$this->CaseNo->setDbValue($row['CaseNo']);
		$this->OffenseCode->setDbValue($row['OffenseCode']);
		$this->CaseDescription->setDbValue($row['CaseDescription']);
		$this->ActionTaken->setDbValue($row['ActionTaken']);
		$this->OffenseDate->setDbValue($row['OffenseDate']);
		$this->ActionDate->setDbValue($row['ActionDate']);
		$this->PenaltyQuantity->setDbValue($row['PenaltyQuantity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->DateOfAppealLetter->setDbValue($row['DateOfAppealLetter']);
		$this->DateAppealReceived->setDbValue($row['DateAppealReceived']);
		$this->DateConcluded->setDbValue($row['DateConcluded']);
		$this->AppealStatus->setDbValue($row['AppealStatus']);
		$this->DiciplinaryHearing->setDbValue($row['DiciplinaryHearing']);
		$this->AppealNotes->setDbValue($row['AppealNotes']);
		$this->LastUpdate->setDbValue($row['LastUpdate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['CaseNo'] = $this->CaseNo->CurrentValue;
		$row['OffenseCode'] = $this->OffenseCode->CurrentValue;
		$row['CaseDescription'] = $this->CaseDescription->CurrentValue;
		$row['ActionTaken'] = $this->ActionTaken->CurrentValue;
		$row['OffenseDate'] = $this->OffenseDate->CurrentValue;
		$row['ActionDate'] = $this->ActionDate->CurrentValue;
		$row['PenaltyQuantity'] = $this->PenaltyQuantity->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['DateOfAppealLetter'] = $this->DateOfAppealLetter->CurrentValue;
		$row['DateAppealReceived'] = $this->DateAppealReceived->CurrentValue;
		$row['DateConcluded'] = $this->DateConcluded->CurrentValue;
		$row['AppealStatus'] = $this->AppealStatus->CurrentValue;
		$row['DiciplinaryHearing'] = $this->DiciplinaryHearing->CurrentValue;
		$row['AppealNotes'] = $this->AppealNotes->CurrentValue;
		$row['LastUpdate'] = $this->LastUpdate->CurrentValue;
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
				$this->CaseNo->OldValue = strval($keys[1]); // CaseNo
			else
				$validKey = FALSE;
			if (strval($keys[2]) != "")
				$this->OffenseCode->OldValue = strval($keys[2]); // OffenseCode
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
		// EmployeeID
		// CaseNo
		// OffenseCode
		// CaseDescription
		// ActionTaken
		// OffenseDate
		// ActionDate
		// PenaltyQuantity
		// UnitOfMeasure
		// DateOfAppealLetter
		// DateAppealReceived
		// DateConcluded
		// AppealStatus
		// DiciplinaryHearing
		// AppealNotes
		// LastUpdate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// CaseNo
			$this->CaseNo->ViewValue = $this->CaseNo->CurrentValue;
			$this->CaseNo->ViewCustomAttributes = "";

			// OffenseCode
			$curVal = strval($this->OffenseCode->CurrentValue);
			if ($curVal != "") {
				$this->OffenseCode->ViewValue = $this->OffenseCode->lookupCacheOption($curVal);
				if ($this->OffenseCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OffenseCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OffenseCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->OffenseCode->ViewValue = $this->OffenseCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OffenseCode->ViewValue = $this->OffenseCode->CurrentValue;
					}
				}
			} else {
				$this->OffenseCode->ViewValue = NULL;
			}
			$this->OffenseCode->ViewCustomAttributes = "";

			// ActionTaken
			$curVal = strval($this->ActionTaken->CurrentValue);
			if ($curVal != "") {
				$this->ActionTaken->ViewValue = $this->ActionTaken->lookupCacheOption($curVal);
				if ($this->ActionTaken->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionTaken->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionTaken->ViewValue = $this->ActionTaken->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionTaken->ViewValue = $this->ActionTaken->CurrentValue;
					}
				}
			} else {
				$this->ActionTaken->ViewValue = NULL;
			}
			$this->ActionTaken->ViewCustomAttributes = "";

			// OffenseDate
			$this->OffenseDate->ViewValue = $this->OffenseDate->CurrentValue;
			$this->OffenseDate->ViewValue = FormatDateTime($this->OffenseDate->ViewValue, 0);
			$this->OffenseDate->ViewCustomAttributes = "";

			// ActionDate
			$this->ActionDate->ViewValue = $this->ActionDate->CurrentValue;
			$this->ActionDate->ViewValue = FormatDateTime($this->ActionDate->ViewValue, 0);
			$this->ActionDate->ViewCustomAttributes = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->ViewValue = $this->DateOfAppealLetter->CurrentValue;
			$this->DateOfAppealLetter->ViewValue = FormatDateTime($this->DateOfAppealLetter->ViewValue, 0);
			$this->DateOfAppealLetter->ViewCustomAttributes = "";

			// DateAppealReceived
			$this->DateAppealReceived->ViewValue = $this->DateAppealReceived->CurrentValue;
			$this->DateAppealReceived->ViewValue = FormatDateTime($this->DateAppealReceived->ViewValue, 0);
			$this->DateAppealReceived->ViewCustomAttributes = "";

			// DateConcluded
			$this->DateConcluded->ViewValue = $this->DateConcluded->CurrentValue;
			$this->DateConcluded->ViewValue = FormatDateTime($this->DateConcluded->ViewValue, 0);
			$this->DateConcluded->ViewCustomAttributes = "";

			// AppealStatus
			$curVal = strval($this->AppealStatus->CurrentValue);
			if ($curVal != "") {
				$this->AppealStatus->ViewValue = $this->AppealStatus->lookupCacheOption($curVal);
				if ($this->AppealStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AppealStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AppealStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AppealStatus->ViewValue = $this->AppealStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AppealStatus->ViewValue = $this->AppealStatus->CurrentValue;
					}
				}
			} else {
				$this->AppealStatus->ViewValue = NULL;
			}
			$this->AppealStatus->ViewCustomAttributes = "";

			// CaseNo
			$this->CaseNo->LinkCustomAttributes = "";
			$this->CaseNo->HrefValue = "";
			$this->CaseNo->TooltipValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";
			$this->OffenseCode->TooltipValue = "";

			// ActionTaken
			$this->ActionTaken->LinkCustomAttributes = "";
			$this->ActionTaken->HrefValue = "";
			$this->ActionTaken->TooltipValue = "";

			// OffenseDate
			$this->OffenseDate->LinkCustomAttributes = "";
			$this->OffenseDate->HrefValue = "";
			$this->OffenseDate->TooltipValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";
			$this->ActionDate->TooltipValue = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->LinkCustomAttributes = "";
			$this->DateOfAppealLetter->HrefValue = "";
			$this->DateOfAppealLetter->TooltipValue = "";

			// DateAppealReceived
			$this->DateAppealReceived->LinkCustomAttributes = "";
			$this->DateAppealReceived->HrefValue = "";
			$this->DateAppealReceived->TooltipValue = "";

			// DateConcluded
			$this->DateConcluded->LinkCustomAttributes = "";
			$this->DateConcluded->HrefValue = "";
			$this->DateConcluded->TooltipValue = "";

			// AppealStatus
			$this->AppealStatus->LinkCustomAttributes = "";
			$this->AppealStatus->HrefValue = "";
			$this->AppealStatus->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// CaseNo
			// OffenseCode

			$this->OffenseCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OffenseCode->CurrentValue));
			if ($curVal != "")
				$this->OffenseCode->ViewValue = $this->OffenseCode->lookupCacheOption($curVal);
			else
				$this->OffenseCode->ViewValue = $this->OffenseCode->Lookup !== NULL && is_array($this->OffenseCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OffenseCode->ViewValue !== NULL) { // Load from cache
				$this->OffenseCode->EditValue = array_values($this->OffenseCode->Lookup->Options);
				if ($this->OffenseCode->ViewValue == "")
					$this->OffenseCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OffenseCode`" . SearchString("=", $this->OffenseCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OffenseCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->OffenseCode->ViewValue = $this->OffenseCode->displayValue($arwrk);
				} else {
					$this->OffenseCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OffenseCode->EditValue = $arwrk;
			}

			// ActionTaken
			$this->ActionTaken->EditAttrs["class"] = "form-control";
			$this->ActionTaken->EditCustomAttributes = "";
			$curVal = trim(strval($this->ActionTaken->CurrentValue));
			if ($curVal != "")
				$this->ActionTaken->ViewValue = $this->ActionTaken->lookupCacheOption($curVal);
			else
				$this->ActionTaken->ViewValue = $this->ActionTaken->Lookup !== NULL && is_array($this->ActionTaken->Lookup->Options) ? $curVal : NULL;
			if ($this->ActionTaken->ViewValue !== NULL) { // Load from cache
				$this->ActionTaken->EditValue = array_values($this->ActionTaken->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionTaken->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ActionTaken->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ActionTaken->EditValue = $arwrk;
			}

			// OffenseDate
			$this->OffenseDate->EditAttrs["class"] = "form-control";
			$this->OffenseDate->EditCustomAttributes = "";
			$this->OffenseDate->EditValue = HtmlEncode(FormatDateTime($this->OffenseDate->CurrentValue, 8));
			$this->OffenseDate->PlaceHolder = RemoveHtml($this->OffenseDate->caption());

			// ActionDate
			$this->ActionDate->EditAttrs["class"] = "form-control";
			$this->ActionDate->EditCustomAttributes = "";
			$this->ActionDate->EditValue = HtmlEncode(FormatDateTime($this->ActionDate->CurrentValue, 8));
			$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

			// DateOfAppealLetter
			$this->DateOfAppealLetter->EditAttrs["class"] = "form-control";
			$this->DateOfAppealLetter->EditCustomAttributes = "";
			$this->DateOfAppealLetter->EditValue = HtmlEncode(FormatDateTime($this->DateOfAppealLetter->CurrentValue, 8));
			$this->DateOfAppealLetter->PlaceHolder = RemoveHtml($this->DateOfAppealLetter->caption());

			// DateAppealReceived
			$this->DateAppealReceived->EditAttrs["class"] = "form-control";
			$this->DateAppealReceived->EditCustomAttributes = "";
			$this->DateAppealReceived->EditValue = HtmlEncode(FormatDateTime($this->DateAppealReceived->CurrentValue, 8));
			$this->DateAppealReceived->PlaceHolder = RemoveHtml($this->DateAppealReceived->caption());

			// DateConcluded
			$this->DateConcluded->EditAttrs["class"] = "form-control";
			$this->DateConcluded->EditCustomAttributes = "";
			$this->DateConcluded->EditValue = HtmlEncode(FormatDateTime($this->DateConcluded->CurrentValue, 8));
			$this->DateConcluded->PlaceHolder = RemoveHtml($this->DateConcluded->caption());

			// AppealStatus
			$this->AppealStatus->EditAttrs["class"] = "form-control";
			$this->AppealStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AppealStatus->CurrentValue));
			if ($curVal != "")
				$this->AppealStatus->ViewValue = $this->AppealStatus->lookupCacheOption($curVal);
			else
				$this->AppealStatus->ViewValue = $this->AppealStatus->Lookup !== NULL && is_array($this->AppealStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AppealStatus->ViewValue !== NULL) { // Load from cache
				$this->AppealStatus->EditValue = array_values($this->AppealStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AppealStatusCode`" . SearchString("=", $this->AppealStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AppealStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AppealStatus->EditValue = $arwrk;
			}

			// Add refer script
			// CaseNo

			$this->CaseNo->LinkCustomAttributes = "";
			$this->CaseNo->HrefValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";

			// ActionTaken
			$this->ActionTaken->LinkCustomAttributes = "";
			$this->ActionTaken->HrefValue = "";

			// OffenseDate
			$this->OffenseDate->LinkCustomAttributes = "";
			$this->OffenseDate->HrefValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->LinkCustomAttributes = "";
			$this->DateOfAppealLetter->HrefValue = "";

			// DateAppealReceived
			$this->DateAppealReceived->LinkCustomAttributes = "";
			$this->DateAppealReceived->HrefValue = "";

			// DateConcluded
			$this->DateConcluded->LinkCustomAttributes = "";
			$this->DateConcluded->HrefValue = "";

			// AppealStatus
			$this->AppealStatus->LinkCustomAttributes = "";
			$this->AppealStatus->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// CaseNo
			$this->CaseNo->EditAttrs["class"] = "form-control";
			$this->CaseNo->EditCustomAttributes = "";
			$this->CaseNo->EditValue = $this->CaseNo->CurrentValue;
			$this->CaseNo->ViewCustomAttributes = "";

			// OffenseCode
			$this->OffenseCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OffenseCode->CurrentValue));
			if ($curVal != "")
				$this->OffenseCode->ViewValue = $this->OffenseCode->lookupCacheOption($curVal);
			else
				$this->OffenseCode->ViewValue = $this->OffenseCode->Lookup !== NULL && is_array($this->OffenseCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OffenseCode->ViewValue !== NULL) { // Load from cache
				$this->OffenseCode->EditValue = array_values($this->OffenseCode->Lookup->Options);
				if ($this->OffenseCode->ViewValue == "")
					$this->OffenseCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OffenseCode`" . SearchString("=", $this->OffenseCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OffenseCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->OffenseCode->ViewValue = $this->OffenseCode->displayValue($arwrk);
				} else {
					$this->OffenseCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OffenseCode->EditValue = $arwrk;
			}

			// ActionTaken
			$this->ActionTaken->EditAttrs["class"] = "form-control";
			$this->ActionTaken->EditCustomAttributes = "";
			$curVal = trim(strval($this->ActionTaken->CurrentValue));
			if ($curVal != "")
				$this->ActionTaken->ViewValue = $this->ActionTaken->lookupCacheOption($curVal);
			else
				$this->ActionTaken->ViewValue = $this->ActionTaken->Lookup !== NULL && is_array($this->ActionTaken->Lookup->Options) ? $curVal : NULL;
			if ($this->ActionTaken->ViewValue !== NULL) { // Load from cache
				$this->ActionTaken->EditValue = array_values($this->ActionTaken->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionTaken->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ActionTaken->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ActionTaken->EditValue = $arwrk;
			}

			// OffenseDate
			$this->OffenseDate->EditAttrs["class"] = "form-control";
			$this->OffenseDate->EditCustomAttributes = "";
			$this->OffenseDate->EditValue = HtmlEncode(FormatDateTime($this->OffenseDate->CurrentValue, 8));
			$this->OffenseDate->PlaceHolder = RemoveHtml($this->OffenseDate->caption());

			// ActionDate
			$this->ActionDate->EditAttrs["class"] = "form-control";
			$this->ActionDate->EditCustomAttributes = "";
			$this->ActionDate->EditValue = HtmlEncode(FormatDateTime($this->ActionDate->CurrentValue, 8));
			$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

			// DateOfAppealLetter
			$this->DateOfAppealLetter->EditAttrs["class"] = "form-control";
			$this->DateOfAppealLetter->EditCustomAttributes = "";
			$this->DateOfAppealLetter->EditValue = HtmlEncode(FormatDateTime($this->DateOfAppealLetter->CurrentValue, 8));
			$this->DateOfAppealLetter->PlaceHolder = RemoveHtml($this->DateOfAppealLetter->caption());

			// DateAppealReceived
			$this->DateAppealReceived->EditAttrs["class"] = "form-control";
			$this->DateAppealReceived->EditCustomAttributes = "";
			$this->DateAppealReceived->EditValue = HtmlEncode(FormatDateTime($this->DateAppealReceived->CurrentValue, 8));
			$this->DateAppealReceived->PlaceHolder = RemoveHtml($this->DateAppealReceived->caption());

			// DateConcluded
			$this->DateConcluded->EditAttrs["class"] = "form-control";
			$this->DateConcluded->EditCustomAttributes = "";
			$this->DateConcluded->EditValue = HtmlEncode(FormatDateTime($this->DateConcluded->CurrentValue, 8));
			$this->DateConcluded->PlaceHolder = RemoveHtml($this->DateConcluded->caption());

			// AppealStatus
			$this->AppealStatus->EditAttrs["class"] = "form-control";
			$this->AppealStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AppealStatus->CurrentValue));
			if ($curVal != "")
				$this->AppealStatus->ViewValue = $this->AppealStatus->lookupCacheOption($curVal);
			else
				$this->AppealStatus->ViewValue = $this->AppealStatus->Lookup !== NULL && is_array($this->AppealStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AppealStatus->ViewValue !== NULL) { // Load from cache
				$this->AppealStatus->EditValue = array_values($this->AppealStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AppealStatusCode`" . SearchString("=", $this->AppealStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AppealStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AppealStatus->EditValue = $arwrk;
			}

			// Edit refer script
			// CaseNo

			$this->CaseNo->LinkCustomAttributes = "";
			$this->CaseNo->HrefValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";

			// ActionTaken
			$this->ActionTaken->LinkCustomAttributes = "";
			$this->ActionTaken->HrefValue = "";

			// OffenseDate
			$this->OffenseDate->LinkCustomAttributes = "";
			$this->OffenseDate->HrefValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->LinkCustomAttributes = "";
			$this->DateOfAppealLetter->HrefValue = "";

			// DateAppealReceived
			$this->DateAppealReceived->LinkCustomAttributes = "";
			$this->DateAppealReceived->HrefValue = "";

			// DateConcluded
			$this->DateConcluded->LinkCustomAttributes = "";
			$this->DateConcluded->HrefValue = "";

			// AppealStatus
			$this->AppealStatus->LinkCustomAttributes = "";
			$this->AppealStatus->HrefValue = "";
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
		if ($this->CaseNo->Required) {
			if (!$this->CaseNo->IsDetailKey && $this->CaseNo->FormValue != NULL && $this->CaseNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CaseNo->caption(), $this->CaseNo->RequiredErrorMessage));
			}
		}
		if ($this->OffenseCode->Required) {
			if ($this->OffenseCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OffenseCode->caption(), $this->OffenseCode->RequiredErrorMessage));
			}
		}
		if ($this->ActionTaken->Required) {
			if (!$this->ActionTaken->IsDetailKey && $this->ActionTaken->FormValue != NULL && $this->ActionTaken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionTaken->caption(), $this->ActionTaken->RequiredErrorMessage));
			}
		}
		if ($this->OffenseDate->Required) {
			if (!$this->OffenseDate->IsDetailKey && $this->OffenseDate->FormValue != NULL && $this->OffenseDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OffenseDate->caption(), $this->OffenseDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->OffenseDate->FormValue)) {
			AddMessage($FormError, $this->OffenseDate->errorMessage());
		}
		if ($this->ActionDate->Required) {
			if (!$this->ActionDate->IsDetailKey && $this->ActionDate->FormValue != NULL && $this->ActionDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionDate->caption(), $this->ActionDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActionDate->FormValue)) {
			AddMessage($FormError, $this->ActionDate->errorMessage());
		}
		if ($this->DateOfAppealLetter->Required) {
			if (!$this->DateOfAppealLetter->IsDetailKey && $this->DateOfAppealLetter->FormValue != NULL && $this->DateOfAppealLetter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfAppealLetter->caption(), $this->DateOfAppealLetter->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfAppealLetter->FormValue)) {
			AddMessage($FormError, $this->DateOfAppealLetter->errorMessage());
		}
		if ($this->DateAppealReceived->Required) {
			if (!$this->DateAppealReceived->IsDetailKey && $this->DateAppealReceived->FormValue != NULL && $this->DateAppealReceived->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateAppealReceived->caption(), $this->DateAppealReceived->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateAppealReceived->FormValue)) {
			AddMessage($FormError, $this->DateAppealReceived->errorMessage());
		}
		if ($this->DateConcluded->Required) {
			if (!$this->DateConcluded->IsDetailKey && $this->DateConcluded->FormValue != NULL && $this->DateConcluded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateConcluded->caption(), $this->DateConcluded->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateConcluded->FormValue)) {
			AddMessage($FormError, $this->DateConcluded->errorMessage());
		}
		if ($this->AppealStatus->Required) {
			if (!$this->AppealStatus->IsDetailKey && $this->AppealStatus->FormValue != NULL && $this->AppealStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AppealStatus->caption(), $this->AppealStatus->RequiredErrorMessage));
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
				$thisKey .= $row['EmployeeID'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['CaseNo'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['OffenseCode'];
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

			// OffenseCode
			$this->OffenseCode->setDbValueDef($rsnew, $this->OffenseCode->CurrentValue, 0, $this->OffenseCode->ReadOnly);

			// ActionTaken
			$this->ActionTaken->setDbValueDef($rsnew, $this->ActionTaken->CurrentValue, NULL, $this->ActionTaken->ReadOnly);

			// OffenseDate
			$this->OffenseDate->setDbValueDef($rsnew, UnFormatDateTime($this->OffenseDate->CurrentValue, 0), CurrentDate(), $this->OffenseDate->ReadOnly);

			// ActionDate
			$this->ActionDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActionDate->CurrentValue, 0), NULL, $this->ActionDate->ReadOnly);

			// DateOfAppealLetter
			$this->DateOfAppealLetter->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0), NULL, $this->DateOfAppealLetter->ReadOnly);

			// DateAppealReceived
			$this->DateAppealReceived->setDbValueDef($rsnew, UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0), NULL, $this->DateAppealReceived->ReadOnly);

			// DateConcluded
			$this->DateConcluded->setDbValueDef($rsnew, UnFormatDateTime($this->DateConcluded->CurrentValue, 0), NULL, $this->DateConcluded->ReadOnly);

			// AppealStatus
			$this->AppealStatus->setDbValueDef($rsnew, $this->AppealStatus->CurrentValue, NULL, $this->AppealStatus->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "staff") {
				$this->EmployeeID->CurrentValue = $this->EmployeeID->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// OffenseCode
		$this->OffenseCode->setDbValueDef($rsnew, $this->OffenseCode->CurrentValue, 0, FALSE);

		// ActionTaken
		$this->ActionTaken->setDbValueDef($rsnew, $this->ActionTaken->CurrentValue, NULL, FALSE);

		// OffenseDate
		$this->OffenseDate->setDbValueDef($rsnew, UnFormatDateTime($this->OffenseDate->CurrentValue, 0), CurrentDate(), FALSE);

		// ActionDate
		$this->ActionDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActionDate->CurrentValue, 0), NULL, FALSE);

		// DateOfAppealLetter
		$this->DateOfAppealLetter->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0), NULL, FALSE);

		// DateAppealReceived
		$this->DateAppealReceived->setDbValueDef($rsnew, UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0), NULL, FALSE);

		// DateConcluded
		$this->DateConcluded->setDbValueDef($rsnew, UnFormatDateTime($this->DateConcluded->CurrentValue, 0), NULL, FALSE);

		// AppealStatus
		$this->AppealStatus->setDbValueDef($rsnew, $this->AppealStatus->CurrentValue, NULL, FALSE);

		// EmployeeID
		if ($this->EmployeeID->getSessionValue() != "") {
			$rsnew['EmployeeID'] = $this->EmployeeID->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['EmployeeID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['OffenseCode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
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
		if ($masterTblVar == "staff") {
			$this->EmployeeID->Visible = FALSE;
			if ($GLOBALS["staff"]->EventCancelled)
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
				case "x_OffenseCode":
					break;
				case "x_ActionTaken":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_AppealStatus":
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
						case "x_OffenseCode":
							break;
						case "x_ActionTaken":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_AppealStatus":
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