<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ipc_tracking_grid extends ipc_tracking
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ipc_tracking';

	// Page object name
	public $PageObjName = "ipc_tracking_grid";

	// Grid form hidden field names
	public $FormName = "fipc_trackinggrid";
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

		// Table object (ipc_tracking)
		if (!isset($GLOBALS["ipc_tracking"]) || get_class($GLOBALS["ipc_tracking"]) == PROJECT_NAMESPACE . "ipc_tracking") {
			$GLOBALS["ipc_tracking"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["ipc_tracking"];

		}
		$this->AddUrl = "ipc_trackingadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ipc_tracking');

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
		global $ipc_tracking;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ipc_tracking);
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
			$key .= @$ar['IPCNo'];
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
			$this->IPCNo->Visible = FALSE;
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
		$this->IPCNo->setVisibility();
		$this->ContractNo->setVisibility();
		$this->ContractAuthorizedByAG->setVisibility();
		$this->VATApplied->setVisibility();
		$this->ArithmeticCheckDone->setVisibility();
		$this->VariationsApproved->setVisibility();
		$this->PerformanceBondValidUntil->setVisibility();
		$this->AdvancePaymentBondValidUntil->setVisibility();
		$this->RetentionDeductionClause->setVisibility();
		$this->RetentionDeducted->setVisibility();
		$this->LiquidatedDamagesDeducted->setVisibility();
		$this->LiquidatedPenaltiesDeducted->Visible = FALSE;
		$this->AdvancedPaymentDeducted->setVisibility();
		$this->CurrentProgressReportAttached->setVisibility();
		$this->CurrentProgressReport->Visible = FALSE;
		$this->DateOfSiteInspection->setVisibility();
		$this->TimeExtensionAuthorized->setVisibility();
		$this->LabResultsChecked->setVisibility();
		$this->LabResults->Visible = FALSE;
		$this->TerminationNoticeGiven->setVisibility();
		$this->CopiesEmailedToMLG->setVisibility();
		$this->ContractStillValid->setVisibility();
		$this->DeskOfficer->setVisibility();
		$this->DeskOfficerDate->setVisibility();
		$this->SupervisingEngineer->setVisibility();
		$this->EngineerDate->setVisibility();
		$this->CouncilSecretary->setVisibility();
		$this->CSDate->setVisibility();
		$this->MLGComments->Visible = FALSE;
		$this->ContractType->setVisibility();
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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "contract") {
			global $contract;
			$rsmaster = $contract->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("contractlist.php"); // Return to master page
			} else {
				$contract->loadListRowValues($rsmaster);
				$contract->RowType = ROWTYPE_MASTER; // Master row
				$contract->renderListRow();
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
			$this->IPCNo->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->IPCNo->OldValue))
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
					$key .= $this->IPCNo->CurrentValue;

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
		if ($CurrentForm->hasValue("x_ContractNo") && $CurrentForm->hasValue("o_ContractNo") && $this->ContractNo->CurrentValue != $this->ContractNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ContractAuthorizedByAG") && $CurrentForm->hasValue("o_ContractAuthorizedByAG") && ConvertToBool($this->ContractAuthorizedByAG->CurrentValue) != ConvertToBool($this->ContractAuthorizedByAG->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_VATApplied") && $CurrentForm->hasValue("o_VATApplied") && ConvertToBool($this->VATApplied->CurrentValue) != ConvertToBool($this->VATApplied->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ArithmeticCheckDone") && $CurrentForm->hasValue("o_ArithmeticCheckDone") && ConvertToBool($this->ArithmeticCheckDone->CurrentValue) != ConvertToBool($this->ArithmeticCheckDone->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_VariationsApproved") && $CurrentForm->hasValue("o_VariationsApproved") && ConvertToBool($this->VariationsApproved->CurrentValue) != ConvertToBool($this->VariationsApproved->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_PerformanceBondValidUntil") && $CurrentForm->hasValue("o_PerformanceBondValidUntil") && $this->PerformanceBondValidUntil->CurrentValue != $this->PerformanceBondValidUntil->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AdvancePaymentBondValidUntil") && $CurrentForm->hasValue("o_AdvancePaymentBondValidUntil") && $this->AdvancePaymentBondValidUntil->CurrentValue != $this->AdvancePaymentBondValidUntil->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RetentionDeductionClause") && $CurrentForm->hasValue("o_RetentionDeductionClause") && $this->RetentionDeductionClause->CurrentValue != $this->RetentionDeductionClause->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RetentionDeducted") && $CurrentForm->hasValue("o_RetentionDeducted") && ConvertToBool($this->RetentionDeducted->CurrentValue) != ConvertToBool($this->RetentionDeducted->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_LiquidatedDamagesDeducted") && $CurrentForm->hasValue("o_LiquidatedDamagesDeducted") && ConvertToBool($this->LiquidatedDamagesDeducted->CurrentValue) != ConvertToBool($this->LiquidatedDamagesDeducted->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_AdvancedPaymentDeducted") && $CurrentForm->hasValue("o_AdvancedPaymentDeducted") && ConvertToBool($this->AdvancedPaymentDeducted->CurrentValue) != ConvertToBool($this->AdvancedPaymentDeducted->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_CurrentProgressReportAttached") && $CurrentForm->hasValue("o_CurrentProgressReportAttached") && ConvertToBool($this->CurrentProgressReportAttached->CurrentValue) != ConvertToBool($this->CurrentProgressReportAttached->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfSiteInspection") && $CurrentForm->hasValue("o_DateOfSiteInspection") && $this->DateOfSiteInspection->CurrentValue != $this->DateOfSiteInspection->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TimeExtensionAuthorized") && $CurrentForm->hasValue("o_TimeExtensionAuthorized") && ConvertToBool($this->TimeExtensionAuthorized->CurrentValue) != ConvertToBool($this->TimeExtensionAuthorized->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_LabResultsChecked") && $CurrentForm->hasValue("o_LabResultsChecked") && ConvertToBool($this->LabResultsChecked->CurrentValue) != ConvertToBool($this->LabResultsChecked->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_TerminationNoticeGiven") && $CurrentForm->hasValue("o_TerminationNoticeGiven") && ConvertToBool($this->TerminationNoticeGiven->CurrentValue) != ConvertToBool($this->TerminationNoticeGiven->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_CopiesEmailedToMLG") && $CurrentForm->hasValue("o_CopiesEmailedToMLG") && ConvertToBool($this->CopiesEmailedToMLG->CurrentValue) != ConvertToBool($this->CopiesEmailedToMLG->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_ContractStillValid") && $CurrentForm->hasValue("o_ContractStillValid") && ConvertToBool($this->ContractStillValid->CurrentValue) != ConvertToBool($this->ContractStillValid->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_DeskOfficer") && $CurrentForm->hasValue("o_DeskOfficer") && $this->DeskOfficer->CurrentValue != $this->DeskOfficer->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeskOfficerDate") && $CurrentForm->hasValue("o_DeskOfficerDate") && $this->DeskOfficerDate->CurrentValue != $this->DeskOfficerDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SupervisingEngineer") && $CurrentForm->hasValue("o_SupervisingEngineer") && $this->SupervisingEngineer->CurrentValue != $this->SupervisingEngineer->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EngineerDate") && $CurrentForm->hasValue("o_EngineerDate") && $this->EngineerDate->CurrentValue != $this->EngineerDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CouncilSecretary") && $CurrentForm->hasValue("o_CouncilSecretary") && $this->CouncilSecretary->CurrentValue != $this->CouncilSecretary->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CSDate") && $CurrentForm->hasValue("o_CSDate") && $this->CSDate->CurrentValue != $this->CSDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ContractType") && $CurrentForm->hasValue("o_ContractType") && $this->ContractType->CurrentValue != $this->ContractType->OldValue)
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
				$this->ContractNo->setSessionValue("");
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-table=\"ipc_tracking\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("CopyLink") . "</a>";
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->IPCNo->CurrentValue . "\">";
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
		$key .= $rs->fields('IPCNo');
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
			if (IsMobile())
				$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			else
				$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"ipc_tracking\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
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
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->IPCNo->CurrentValue = NULL;
		$this->IPCNo->OldValue = $this->IPCNo->CurrentValue;
		$this->ContractNo->CurrentValue = NULL;
		$this->ContractNo->OldValue = $this->ContractNo->CurrentValue;
		$this->ContractAuthorizedByAG->CurrentValue = NULL;
		$this->ContractAuthorizedByAG->OldValue = $this->ContractAuthorizedByAG->CurrentValue;
		$this->VATApplied->CurrentValue = NULL;
		$this->VATApplied->OldValue = $this->VATApplied->CurrentValue;
		$this->ArithmeticCheckDone->CurrentValue = NULL;
		$this->ArithmeticCheckDone->OldValue = $this->ArithmeticCheckDone->CurrentValue;
		$this->VariationsApproved->CurrentValue = NULL;
		$this->VariationsApproved->OldValue = $this->VariationsApproved->CurrentValue;
		$this->PerformanceBondValidUntil->CurrentValue = NULL;
		$this->PerformanceBondValidUntil->OldValue = $this->PerformanceBondValidUntil->CurrentValue;
		$this->AdvancePaymentBondValidUntil->CurrentValue = NULL;
		$this->AdvancePaymentBondValidUntil->OldValue = $this->AdvancePaymentBondValidUntil->CurrentValue;
		$this->RetentionDeductionClause->CurrentValue = NULL;
		$this->RetentionDeductionClause->OldValue = $this->RetentionDeductionClause->CurrentValue;
		$this->RetentionDeducted->CurrentValue = NULL;
		$this->RetentionDeducted->OldValue = $this->RetentionDeducted->CurrentValue;
		$this->LiquidatedDamagesDeducted->CurrentValue = NULL;
		$this->LiquidatedDamagesDeducted->OldValue = $this->LiquidatedDamagesDeducted->CurrentValue;
		$this->LiquidatedPenaltiesDeducted->CurrentValue = NULL;
		$this->LiquidatedPenaltiesDeducted->OldValue = $this->LiquidatedPenaltiesDeducted->CurrentValue;
		$this->AdvancedPaymentDeducted->CurrentValue = NULL;
		$this->AdvancedPaymentDeducted->OldValue = $this->AdvancedPaymentDeducted->CurrentValue;
		$this->CurrentProgressReportAttached->CurrentValue = NULL;
		$this->CurrentProgressReportAttached->OldValue = $this->CurrentProgressReportAttached->CurrentValue;
		$this->CurrentProgressReport->Upload->DbValue = NULL;
		$this->CurrentProgressReport->OldValue = $this->CurrentProgressReport->Upload->DbValue;
		$this->CurrentProgressReport->Upload->Index = $this->RowIndex;
		$this->DateOfSiteInspection->CurrentValue = NULL;
		$this->DateOfSiteInspection->OldValue = $this->DateOfSiteInspection->CurrentValue;
		$this->TimeExtensionAuthorized->CurrentValue = NULL;
		$this->TimeExtensionAuthorized->OldValue = $this->TimeExtensionAuthorized->CurrentValue;
		$this->LabResultsChecked->CurrentValue = NULL;
		$this->LabResultsChecked->OldValue = $this->LabResultsChecked->CurrentValue;
		$this->LabResults->Upload->DbValue = NULL;
		$this->LabResults->OldValue = $this->LabResults->Upload->DbValue;
		$this->LabResults->Upload->Index = $this->RowIndex;
		$this->TerminationNoticeGiven->CurrentValue = NULL;
		$this->TerminationNoticeGiven->OldValue = $this->TerminationNoticeGiven->CurrentValue;
		$this->CopiesEmailedToMLG->CurrentValue = NULL;
		$this->CopiesEmailedToMLG->OldValue = $this->CopiesEmailedToMLG->CurrentValue;
		$this->ContractStillValid->CurrentValue = NULL;
		$this->ContractStillValid->OldValue = $this->ContractStillValid->CurrentValue;
		$this->DeskOfficer->CurrentValue = NULL;
		$this->DeskOfficer->OldValue = $this->DeskOfficer->CurrentValue;
		$this->DeskOfficerDate->CurrentValue = NULL;
		$this->DeskOfficerDate->OldValue = $this->DeskOfficerDate->CurrentValue;
		$this->SupervisingEngineer->CurrentValue = NULL;
		$this->SupervisingEngineer->OldValue = $this->SupervisingEngineer->CurrentValue;
		$this->EngineerDate->CurrentValue = NULL;
		$this->EngineerDate->OldValue = $this->EngineerDate->CurrentValue;
		$this->CouncilSecretary->CurrentValue = NULL;
		$this->CouncilSecretary->OldValue = $this->CouncilSecretary->CurrentValue;
		$this->CSDate->CurrentValue = NULL;
		$this->CSDate->OldValue = $this->CSDate->CurrentValue;
		$this->MLGComments->CurrentValue = NULL;
		$this->MLGComments->OldValue = $this->MLGComments->CurrentValue;
		$this->ContractType->CurrentValue = NULL;
		$this->ContractType->OldValue = $this->ContractType->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'IPCNo' first before field var 'x_IPCNo'
		$val = $CurrentForm->hasValue("IPCNo") ? $CurrentForm->getValue("IPCNo") : $CurrentForm->getValue("x_IPCNo");
		if (!$this->IPCNo->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->IPCNo->setFormValue($val);

		// Check field name 'ContractNo' first before field var 'x_ContractNo'
		$val = $CurrentForm->hasValue("ContractNo") ? $CurrentForm->getValue("ContractNo") : $CurrentForm->getValue("x_ContractNo");
		if (!$this->ContractNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractNo->Visible = FALSE; // Disable update for API request
			else
				$this->ContractNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ContractNo"))
			$this->ContractNo->setOldValue($CurrentForm->getValue("o_ContractNo"));

		// Check field name 'ContractAuthorizedByAG' first before field var 'x_ContractAuthorizedByAG'
		$val = $CurrentForm->hasValue("ContractAuthorizedByAG") ? $CurrentForm->getValue("ContractAuthorizedByAG") : $CurrentForm->getValue("x_ContractAuthorizedByAG");
		if (!$this->ContractAuthorizedByAG->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractAuthorizedByAG->Visible = FALSE; // Disable update for API request
			else
				$this->ContractAuthorizedByAG->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ContractAuthorizedByAG"))
			$this->ContractAuthorizedByAG->setOldValue($CurrentForm->getValue("o_ContractAuthorizedByAG"));

		// Check field name 'VATApplied' first before field var 'x_VATApplied'
		$val = $CurrentForm->hasValue("VATApplied") ? $CurrentForm->getValue("VATApplied") : $CurrentForm->getValue("x_VATApplied");
		if (!$this->VATApplied->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->VATApplied->Visible = FALSE; // Disable update for API request
			else
				$this->VATApplied->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_VATApplied"))
			$this->VATApplied->setOldValue($CurrentForm->getValue("o_VATApplied"));

		// Check field name 'ArithmeticCheckDone' first before field var 'x_ArithmeticCheckDone'
		$val = $CurrentForm->hasValue("ArithmeticCheckDone") ? $CurrentForm->getValue("ArithmeticCheckDone") : $CurrentForm->getValue("x_ArithmeticCheckDone");
		if (!$this->ArithmeticCheckDone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ArithmeticCheckDone->Visible = FALSE; // Disable update for API request
			else
				$this->ArithmeticCheckDone->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ArithmeticCheckDone"))
			$this->ArithmeticCheckDone->setOldValue($CurrentForm->getValue("o_ArithmeticCheckDone"));

		// Check field name 'VariationsApproved' first before field var 'x_VariationsApproved'
		$val = $CurrentForm->hasValue("VariationsApproved") ? $CurrentForm->getValue("VariationsApproved") : $CurrentForm->getValue("x_VariationsApproved");
		if (!$this->VariationsApproved->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->VariationsApproved->Visible = FALSE; // Disable update for API request
			else
				$this->VariationsApproved->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_VariationsApproved"))
			$this->VariationsApproved->setOldValue($CurrentForm->getValue("o_VariationsApproved"));

		// Check field name 'PerformanceBondValidUntil' first before field var 'x_PerformanceBondValidUntil'
		$val = $CurrentForm->hasValue("PerformanceBondValidUntil") ? $CurrentForm->getValue("PerformanceBondValidUntil") : $CurrentForm->getValue("x_PerformanceBondValidUntil");
		if (!$this->PerformanceBondValidUntil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PerformanceBondValidUntil->Visible = FALSE; // Disable update for API request
			else
				$this->PerformanceBondValidUntil->setFormValue($val);
			$this->PerformanceBondValidUntil->CurrentValue = UnFormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_PerformanceBondValidUntil"))
			$this->PerformanceBondValidUntil->setOldValue($CurrentForm->getValue("o_PerformanceBondValidUntil"));

		// Check field name 'AdvancePaymentBondValidUntil' first before field var 'x_AdvancePaymentBondValidUntil'
		$val = $CurrentForm->hasValue("AdvancePaymentBondValidUntil") ? $CurrentForm->getValue("AdvancePaymentBondValidUntil") : $CurrentForm->getValue("x_AdvancePaymentBondValidUntil");
		if (!$this->AdvancePaymentBondValidUntil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AdvancePaymentBondValidUntil->Visible = FALSE; // Disable update for API request
			else
				$this->AdvancePaymentBondValidUntil->setFormValue($val);
			$this->AdvancePaymentBondValidUntil->CurrentValue = UnFormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_AdvancePaymentBondValidUntil"))
			$this->AdvancePaymentBondValidUntil->setOldValue($CurrentForm->getValue("o_AdvancePaymentBondValidUntil"));

		// Check field name 'RetentionDeductionClause' first before field var 'x_RetentionDeductionClause'
		$val = $CurrentForm->hasValue("RetentionDeductionClause") ? $CurrentForm->getValue("RetentionDeductionClause") : $CurrentForm->getValue("x_RetentionDeductionClause");
		if (!$this->RetentionDeductionClause->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RetentionDeductionClause->Visible = FALSE; // Disable update for API request
			else
				$this->RetentionDeductionClause->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RetentionDeductionClause"))
			$this->RetentionDeductionClause->setOldValue($CurrentForm->getValue("o_RetentionDeductionClause"));

		// Check field name 'RetentionDeducted' first before field var 'x_RetentionDeducted'
		$val = $CurrentForm->hasValue("RetentionDeducted") ? $CurrentForm->getValue("RetentionDeducted") : $CurrentForm->getValue("x_RetentionDeducted");
		if (!$this->RetentionDeducted->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RetentionDeducted->Visible = FALSE; // Disable update for API request
			else
				$this->RetentionDeducted->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RetentionDeducted"))
			$this->RetentionDeducted->setOldValue($CurrentForm->getValue("o_RetentionDeducted"));

		// Check field name 'LiquidatedDamagesDeducted' first before field var 'x_LiquidatedDamagesDeducted'
		$val = $CurrentForm->hasValue("LiquidatedDamagesDeducted") ? $CurrentForm->getValue("LiquidatedDamagesDeducted") : $CurrentForm->getValue("x_LiquidatedDamagesDeducted");
		if (!$this->LiquidatedDamagesDeducted->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LiquidatedDamagesDeducted->Visible = FALSE; // Disable update for API request
			else
				$this->LiquidatedDamagesDeducted->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LiquidatedDamagesDeducted"))
			$this->LiquidatedDamagesDeducted->setOldValue($CurrentForm->getValue("o_LiquidatedDamagesDeducted"));

		// Check field name 'AdvancedPaymentDeducted' first before field var 'x_AdvancedPaymentDeducted'
		$val = $CurrentForm->hasValue("AdvancedPaymentDeducted") ? $CurrentForm->getValue("AdvancedPaymentDeducted") : $CurrentForm->getValue("x_AdvancedPaymentDeducted");
		if (!$this->AdvancedPaymentDeducted->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AdvancedPaymentDeducted->Visible = FALSE; // Disable update for API request
			else
				$this->AdvancedPaymentDeducted->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AdvancedPaymentDeducted"))
			$this->AdvancedPaymentDeducted->setOldValue($CurrentForm->getValue("o_AdvancedPaymentDeducted"));

		// Check field name 'CurrentProgressReportAttached' first before field var 'x_CurrentProgressReportAttached'
		$val = $CurrentForm->hasValue("CurrentProgressReportAttached") ? $CurrentForm->getValue("CurrentProgressReportAttached") : $CurrentForm->getValue("x_CurrentProgressReportAttached");
		if (!$this->CurrentProgressReportAttached->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrentProgressReportAttached->Visible = FALSE; // Disable update for API request
			else
				$this->CurrentProgressReportAttached->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CurrentProgressReportAttached"))
			$this->CurrentProgressReportAttached->setOldValue($CurrentForm->getValue("o_CurrentProgressReportAttached"));

		// Check field name 'DateOfSiteInspection' first before field var 'x_DateOfSiteInspection'
		$val = $CurrentForm->hasValue("DateOfSiteInspection") ? $CurrentForm->getValue("DateOfSiteInspection") : $CurrentForm->getValue("x_DateOfSiteInspection");
		if (!$this->DateOfSiteInspection->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfSiteInspection->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfSiteInspection->setFormValue($val);
			$this->DateOfSiteInspection->CurrentValue = UnFormatDateTime($this->DateOfSiteInspection->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfSiteInspection"))
			$this->DateOfSiteInspection->setOldValue($CurrentForm->getValue("o_DateOfSiteInspection"));

		// Check field name 'TimeExtensionAuthorized' first before field var 'x_TimeExtensionAuthorized'
		$val = $CurrentForm->hasValue("TimeExtensionAuthorized") ? $CurrentForm->getValue("TimeExtensionAuthorized") : $CurrentForm->getValue("x_TimeExtensionAuthorized");
		if (!$this->TimeExtensionAuthorized->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TimeExtensionAuthorized->Visible = FALSE; // Disable update for API request
			else
				$this->TimeExtensionAuthorized->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TimeExtensionAuthorized"))
			$this->TimeExtensionAuthorized->setOldValue($CurrentForm->getValue("o_TimeExtensionAuthorized"));

		// Check field name 'LabResultsChecked' first before field var 'x_LabResultsChecked'
		$val = $CurrentForm->hasValue("LabResultsChecked") ? $CurrentForm->getValue("LabResultsChecked") : $CurrentForm->getValue("x_LabResultsChecked");
		if (!$this->LabResultsChecked->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LabResultsChecked->Visible = FALSE; // Disable update for API request
			else
				$this->LabResultsChecked->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LabResultsChecked"))
			$this->LabResultsChecked->setOldValue($CurrentForm->getValue("o_LabResultsChecked"));

		// Check field name 'TerminationNoticeGiven' first before field var 'x_TerminationNoticeGiven'
		$val = $CurrentForm->hasValue("TerminationNoticeGiven") ? $CurrentForm->getValue("TerminationNoticeGiven") : $CurrentForm->getValue("x_TerminationNoticeGiven");
		if (!$this->TerminationNoticeGiven->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TerminationNoticeGiven->Visible = FALSE; // Disable update for API request
			else
				$this->TerminationNoticeGiven->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TerminationNoticeGiven"))
			$this->TerminationNoticeGiven->setOldValue($CurrentForm->getValue("o_TerminationNoticeGiven"));

		// Check field name 'CopiesEmailedToMLG' first before field var 'x_CopiesEmailedToMLG'
		$val = $CurrentForm->hasValue("CopiesEmailedToMLG") ? $CurrentForm->getValue("CopiesEmailedToMLG") : $CurrentForm->getValue("x_CopiesEmailedToMLG");
		if (!$this->CopiesEmailedToMLG->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CopiesEmailedToMLG->Visible = FALSE; // Disable update for API request
			else
				$this->CopiesEmailedToMLG->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CopiesEmailedToMLG"))
			$this->CopiesEmailedToMLG->setOldValue($CurrentForm->getValue("o_CopiesEmailedToMLG"));

		// Check field name 'ContractStillValid' first before field var 'x_ContractStillValid'
		$val = $CurrentForm->hasValue("ContractStillValid") ? $CurrentForm->getValue("ContractStillValid") : $CurrentForm->getValue("x_ContractStillValid");
		if (!$this->ContractStillValid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractStillValid->Visible = FALSE; // Disable update for API request
			else
				$this->ContractStillValid->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ContractStillValid"))
			$this->ContractStillValid->setOldValue($CurrentForm->getValue("o_ContractStillValid"));

		// Check field name 'DeskOfficer' first before field var 'x_DeskOfficer'
		$val = $CurrentForm->hasValue("DeskOfficer") ? $CurrentForm->getValue("DeskOfficer") : $CurrentForm->getValue("x_DeskOfficer");
		if (!$this->DeskOfficer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeskOfficer->Visible = FALSE; // Disable update for API request
			else
				$this->DeskOfficer->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeskOfficer"))
			$this->DeskOfficer->setOldValue($CurrentForm->getValue("o_DeskOfficer"));

		// Check field name 'DeskOfficerDate' first before field var 'x_DeskOfficerDate'
		$val = $CurrentForm->hasValue("DeskOfficerDate") ? $CurrentForm->getValue("DeskOfficerDate") : $CurrentForm->getValue("x_DeskOfficerDate");
		if (!$this->DeskOfficerDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeskOfficerDate->Visible = FALSE; // Disable update for API request
			else
				$this->DeskOfficerDate->setFormValue($val);
			$this->DeskOfficerDate->CurrentValue = UnFormatDateTime($this->DeskOfficerDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DeskOfficerDate"))
			$this->DeskOfficerDate->setOldValue($CurrentForm->getValue("o_DeskOfficerDate"));

		// Check field name 'SupervisingEngineer' first before field var 'x_SupervisingEngineer'
		$val = $CurrentForm->hasValue("SupervisingEngineer") ? $CurrentForm->getValue("SupervisingEngineer") : $CurrentForm->getValue("x_SupervisingEngineer");
		if (!$this->SupervisingEngineer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SupervisingEngineer->Visible = FALSE; // Disable update for API request
			else
				$this->SupervisingEngineer->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SupervisingEngineer"))
			$this->SupervisingEngineer->setOldValue($CurrentForm->getValue("o_SupervisingEngineer"));

		// Check field name 'EngineerDate' first before field var 'x_EngineerDate'
		$val = $CurrentForm->hasValue("EngineerDate") ? $CurrentForm->getValue("EngineerDate") : $CurrentForm->getValue("x_EngineerDate");
		if (!$this->EngineerDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EngineerDate->Visible = FALSE; // Disable update for API request
			else
				$this->EngineerDate->setFormValue($val);
			$this->EngineerDate->CurrentValue = UnFormatDateTime($this->EngineerDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_EngineerDate"))
			$this->EngineerDate->setOldValue($CurrentForm->getValue("o_EngineerDate"));

		// Check field name 'CouncilSecretary' first before field var 'x_CouncilSecretary'
		$val = $CurrentForm->hasValue("CouncilSecretary") ? $CurrentForm->getValue("CouncilSecretary") : $CurrentForm->getValue("x_CouncilSecretary");
		if (!$this->CouncilSecretary->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CouncilSecretary->Visible = FALSE; // Disable update for API request
			else
				$this->CouncilSecretary->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CouncilSecretary"))
			$this->CouncilSecretary->setOldValue($CurrentForm->getValue("o_CouncilSecretary"));

		// Check field name 'CSDate' first before field var 'x_CSDate'
		$val = $CurrentForm->hasValue("CSDate") ? $CurrentForm->getValue("CSDate") : $CurrentForm->getValue("x_CSDate");
		if (!$this->CSDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CSDate->Visible = FALSE; // Disable update for API request
			else
				$this->CSDate->setFormValue($val);
			$this->CSDate->CurrentValue = UnFormatDateTime($this->CSDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_CSDate"))
			$this->CSDate->setOldValue($CurrentForm->getValue("o_CSDate"));

		// Check field name 'ContractType' first before field var 'x_ContractType'
		$val = $CurrentForm->hasValue("ContractType") ? $CurrentForm->getValue("ContractType") : $CurrentForm->getValue("x_ContractType");
		if (!$this->ContractType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ContractType->Visible = FALSE; // Disable update for API request
			else
				$this->ContractType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ContractType"))
			$this->ContractType->setOldValue($CurrentForm->getValue("o_ContractType"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->IPCNo->CurrentValue = $this->IPCNo->FormValue;
		$this->ContractNo->CurrentValue = $this->ContractNo->FormValue;
		$this->ContractAuthorizedByAG->CurrentValue = $this->ContractAuthorizedByAG->FormValue;
		$this->VATApplied->CurrentValue = $this->VATApplied->FormValue;
		$this->ArithmeticCheckDone->CurrentValue = $this->ArithmeticCheckDone->FormValue;
		$this->VariationsApproved->CurrentValue = $this->VariationsApproved->FormValue;
		$this->PerformanceBondValidUntil->CurrentValue = $this->PerformanceBondValidUntil->FormValue;
		$this->PerformanceBondValidUntil->CurrentValue = UnFormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 0);
		$this->AdvancePaymentBondValidUntil->CurrentValue = $this->AdvancePaymentBondValidUntil->FormValue;
		$this->AdvancePaymentBondValidUntil->CurrentValue = UnFormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 0);
		$this->RetentionDeductionClause->CurrentValue = $this->RetentionDeductionClause->FormValue;
		$this->RetentionDeducted->CurrentValue = $this->RetentionDeducted->FormValue;
		$this->LiquidatedDamagesDeducted->CurrentValue = $this->LiquidatedDamagesDeducted->FormValue;
		$this->AdvancedPaymentDeducted->CurrentValue = $this->AdvancedPaymentDeducted->FormValue;
		$this->CurrentProgressReportAttached->CurrentValue = $this->CurrentProgressReportAttached->FormValue;
		$this->DateOfSiteInspection->CurrentValue = $this->DateOfSiteInspection->FormValue;
		$this->DateOfSiteInspection->CurrentValue = UnFormatDateTime($this->DateOfSiteInspection->CurrentValue, 0);
		$this->TimeExtensionAuthorized->CurrentValue = $this->TimeExtensionAuthorized->FormValue;
		$this->LabResultsChecked->CurrentValue = $this->LabResultsChecked->FormValue;
		$this->TerminationNoticeGiven->CurrentValue = $this->TerminationNoticeGiven->FormValue;
		$this->CopiesEmailedToMLG->CurrentValue = $this->CopiesEmailedToMLG->FormValue;
		$this->ContractStillValid->CurrentValue = $this->ContractStillValid->FormValue;
		$this->DeskOfficer->CurrentValue = $this->DeskOfficer->FormValue;
		$this->DeskOfficerDate->CurrentValue = $this->DeskOfficerDate->FormValue;
		$this->DeskOfficerDate->CurrentValue = UnFormatDateTime($this->DeskOfficerDate->CurrentValue, 0);
		$this->SupervisingEngineer->CurrentValue = $this->SupervisingEngineer->FormValue;
		$this->EngineerDate->CurrentValue = $this->EngineerDate->FormValue;
		$this->EngineerDate->CurrentValue = UnFormatDateTime($this->EngineerDate->CurrentValue, 0);
		$this->CouncilSecretary->CurrentValue = $this->CouncilSecretary->FormValue;
		$this->CSDate->CurrentValue = $this->CSDate->FormValue;
		$this->CSDate->CurrentValue = UnFormatDateTime($this->CSDate->CurrentValue, 0);
		$this->ContractType->CurrentValue = $this->ContractType->FormValue;
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
		$this->IPCNo->setDbValue($row['IPCNo']);
		$this->ContractNo->setDbValue($row['ContractNo']);
		$this->ContractAuthorizedByAG->setDbValue($row['ContractAuthorizedByAG']);
		$this->VATApplied->setDbValue($row['VATApplied']);
		$this->ArithmeticCheckDone->setDbValue($row['ArithmeticCheckDone']);
		$this->VariationsApproved->setDbValue($row['VariationsApproved']);
		$this->PerformanceBondValidUntil->setDbValue($row['PerformanceBondValidUntil']);
		$this->AdvancePaymentBondValidUntil->setDbValue($row['AdvancePaymentBondValidUntil']);
		$this->RetentionDeductionClause->setDbValue($row['RetentionDeductionClause']);
		$this->RetentionDeducted->setDbValue($row['RetentionDeducted']);
		$this->LiquidatedDamagesDeducted->setDbValue($row['LiquidatedDamagesDeducted']);
		$this->LiquidatedPenaltiesDeducted->setDbValue($row['LiquidatedPenaltiesDeducted']);
		$this->AdvancedPaymentDeducted->setDbValue($row['AdvancedPaymentDeducted']);
		$this->CurrentProgressReportAttached->setDbValue($row['CurrentProgressReportAttached']);
		$this->CurrentProgressReport->Upload->DbValue = $row['CurrentProgressReport'];
		if (is_array($this->CurrentProgressReport->Upload->DbValue) || is_object($this->CurrentProgressReport->Upload->DbValue)) // Byte array
			$this->CurrentProgressReport->Upload->DbValue = BytesToString($this->CurrentProgressReport->Upload->DbValue);
		$this->CurrentProgressReport->Upload->Index = $this->RowIndex;
		$this->DateOfSiteInspection->setDbValue($row['DateOfSiteInspection']);
		$this->TimeExtensionAuthorized->setDbValue($row['TimeExtensionAuthorized']);
		$this->LabResultsChecked->setDbValue($row['LabResultsChecked']);
		$this->LabResults->Upload->DbValue = $row['LabResults'];
		if (is_array($this->LabResults->Upload->DbValue) || is_object($this->LabResults->Upload->DbValue)) // Byte array
			$this->LabResults->Upload->DbValue = BytesToString($this->LabResults->Upload->DbValue);
		$this->LabResults->Upload->Index = $this->RowIndex;
		$this->TerminationNoticeGiven->setDbValue($row['TerminationNoticeGiven']);
		$this->CopiesEmailedToMLG->setDbValue($row['CopiesEmailedToMLG']);
		$this->ContractStillValid->setDbValue($row['ContractStillValid']);
		$this->DeskOfficer->setDbValue($row['DeskOfficer']);
		$this->DeskOfficerDate->setDbValue($row['DeskOfficerDate']);
		$this->SupervisingEngineer->setDbValue($row['SupervisingEngineer']);
		$this->EngineerDate->setDbValue($row['EngineerDate']);
		$this->CouncilSecretary->setDbValue($row['CouncilSecretary']);
		$this->CSDate->setDbValue($row['CSDate']);
		$this->MLGComments->setDbValue($row['MLGComments']);
		$this->ContractType->setDbValue($row['ContractType']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['IPCNo'] = $this->IPCNo->CurrentValue;
		$row['ContractNo'] = $this->ContractNo->CurrentValue;
		$row['ContractAuthorizedByAG'] = $this->ContractAuthorizedByAG->CurrentValue;
		$row['VATApplied'] = $this->VATApplied->CurrentValue;
		$row['ArithmeticCheckDone'] = $this->ArithmeticCheckDone->CurrentValue;
		$row['VariationsApproved'] = $this->VariationsApproved->CurrentValue;
		$row['PerformanceBondValidUntil'] = $this->PerformanceBondValidUntil->CurrentValue;
		$row['AdvancePaymentBondValidUntil'] = $this->AdvancePaymentBondValidUntil->CurrentValue;
		$row['RetentionDeductionClause'] = $this->RetentionDeductionClause->CurrentValue;
		$row['RetentionDeducted'] = $this->RetentionDeducted->CurrentValue;
		$row['LiquidatedDamagesDeducted'] = $this->LiquidatedDamagesDeducted->CurrentValue;
		$row['LiquidatedPenaltiesDeducted'] = $this->LiquidatedPenaltiesDeducted->CurrentValue;
		$row['AdvancedPaymentDeducted'] = $this->AdvancedPaymentDeducted->CurrentValue;
		$row['CurrentProgressReportAttached'] = $this->CurrentProgressReportAttached->CurrentValue;
		$row['CurrentProgressReport'] = $this->CurrentProgressReport->Upload->DbValue;
		$row['DateOfSiteInspection'] = $this->DateOfSiteInspection->CurrentValue;
		$row['TimeExtensionAuthorized'] = $this->TimeExtensionAuthorized->CurrentValue;
		$row['LabResultsChecked'] = $this->LabResultsChecked->CurrentValue;
		$row['LabResults'] = $this->LabResults->Upload->DbValue;
		$row['TerminationNoticeGiven'] = $this->TerminationNoticeGiven->CurrentValue;
		$row['CopiesEmailedToMLG'] = $this->CopiesEmailedToMLG->CurrentValue;
		$row['ContractStillValid'] = $this->ContractStillValid->CurrentValue;
		$row['DeskOfficer'] = $this->DeskOfficer->CurrentValue;
		$row['DeskOfficerDate'] = $this->DeskOfficerDate->CurrentValue;
		$row['SupervisingEngineer'] = $this->SupervisingEngineer->CurrentValue;
		$row['EngineerDate'] = $this->EngineerDate->CurrentValue;
		$row['CouncilSecretary'] = $this->CouncilSecretary->CurrentValue;
		$row['CSDate'] = $this->CSDate->CurrentValue;
		$row['MLGComments'] = $this->MLGComments->CurrentValue;
		$row['ContractType'] = $this->ContractType->CurrentValue;
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
				$this->IPCNo->OldValue = strval($keys[0]); // IPCNo
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
		// IPCNo
		// ContractNo
		// ContractAuthorizedByAG
		// VATApplied
		// ArithmeticCheckDone
		// VariationsApproved
		// PerformanceBondValidUntil
		// AdvancePaymentBondValidUntil
		// RetentionDeductionClause
		// RetentionDeducted
		// LiquidatedDamagesDeducted
		// LiquidatedPenaltiesDeducted
		// AdvancedPaymentDeducted
		// CurrentProgressReportAttached
		// CurrentProgressReport
		// DateOfSiteInspection
		// TimeExtensionAuthorized
		// LabResultsChecked
		// LabResults
		// TerminationNoticeGiven
		// CopiesEmailedToMLG
		// ContractStillValid
		// DeskOfficer
		// DeskOfficerDate
		// SupervisingEngineer
		// EngineerDate
		// CouncilSecretary
		// CSDate
		// MLGComments
		// ContractType

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IPCNo
			$this->IPCNo->ViewValue = $this->IPCNo->CurrentValue;
			$this->IPCNo->ViewCustomAttributes = "";

			// ContractNo
			$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->ViewCustomAttributes = "";

			// ContractAuthorizedByAG
			if (ConvertToBool($this->ContractAuthorizedByAG->CurrentValue)) {
				$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(1) != "" ? $this->ContractAuthorizedByAG->tagCaption(1) : "Yes";
			} else {
				$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(2) != "" ? $this->ContractAuthorizedByAG->tagCaption(2) : "No";
			}
			$this->ContractAuthorizedByAG->ViewCustomAttributes = "";

			// VATApplied
			if (ConvertToBool($this->VATApplied->CurrentValue)) {
				$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(1) != "" ? $this->VATApplied->tagCaption(1) : "Yes";
			} else {
				$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(2) != "" ? $this->VATApplied->tagCaption(2) : "No";
			}
			$this->VATApplied->ViewCustomAttributes = "";

			// ArithmeticCheckDone
			if (ConvertToBool($this->ArithmeticCheckDone->CurrentValue)) {
				$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(1) != "" ? $this->ArithmeticCheckDone->tagCaption(1) : "Yes";
			} else {
				$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(2) != "" ? $this->ArithmeticCheckDone->tagCaption(2) : "No";
			}
			$this->ArithmeticCheckDone->ViewCustomAttributes = "";

			// VariationsApproved
			if (ConvertToBool($this->VariationsApproved->CurrentValue)) {
				$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(1) != "" ? $this->VariationsApproved->tagCaption(1) : "Yes";
			} else {
				$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(2) != "" ? $this->VariationsApproved->tagCaption(2) : "No";
			}
			$this->VariationsApproved->ViewCustomAttributes = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->ViewValue = $this->PerformanceBondValidUntil->CurrentValue;
			$this->PerformanceBondValidUntil->ViewValue = FormatDateTime($this->PerformanceBondValidUntil->ViewValue, 0);
			$this->PerformanceBondValidUntil->ViewCustomAttributes = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->ViewValue = $this->AdvancePaymentBondValidUntil->CurrentValue;
			$this->AdvancePaymentBondValidUntil->ViewValue = FormatDateTime($this->AdvancePaymentBondValidUntil->ViewValue, 0);
			$this->AdvancePaymentBondValidUntil->ViewCustomAttributes = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->ViewValue = $this->RetentionDeductionClause->CurrentValue;
			$this->RetentionDeductionClause->ViewCustomAttributes = "";

			// RetentionDeducted
			if (ConvertToBool($this->RetentionDeducted->CurrentValue)) {
				$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(1) != "" ? $this->RetentionDeducted->tagCaption(1) : "Yes";
			} else {
				$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(2) != "" ? $this->RetentionDeducted->tagCaption(2) : "No";
			}
			$this->RetentionDeducted->ViewCustomAttributes = "";

			// LiquidatedDamagesDeducted
			if (ConvertToBool($this->LiquidatedDamagesDeducted->CurrentValue)) {
				$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(1) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(1) : "Yes";
			} else {
				$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(2) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(2) : "No";
			}
			$this->LiquidatedDamagesDeducted->ViewCustomAttributes = "";

			// AdvancedPaymentDeducted
			if (ConvertToBool($this->AdvancedPaymentDeducted->CurrentValue)) {
				$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(1) != "" ? $this->AdvancedPaymentDeducted->tagCaption(1) : "Yes";
			} else {
				$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(2) != "" ? $this->AdvancedPaymentDeducted->tagCaption(2) : "No";
			}
			$this->AdvancedPaymentDeducted->ViewCustomAttributes = "";

			// CurrentProgressReportAttached
			if (ConvertToBool($this->CurrentProgressReportAttached->CurrentValue)) {
				$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(1) != "" ? $this->CurrentProgressReportAttached->tagCaption(1) : "Yes";
			} else {
				$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(2) != "" ? $this->CurrentProgressReportAttached->tagCaption(2) : "No";
			}
			$this->CurrentProgressReportAttached->ViewCustomAttributes = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->ViewValue = $this->DateOfSiteInspection->CurrentValue;
			$this->DateOfSiteInspection->ViewValue = FormatDateTime($this->DateOfSiteInspection->ViewValue, 0);
			$this->DateOfSiteInspection->ViewCustomAttributes = "";

			// TimeExtensionAuthorized
			if (ConvertToBool($this->TimeExtensionAuthorized->CurrentValue)) {
				$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(1) != "" ? $this->TimeExtensionAuthorized->tagCaption(1) : "Yes";
			} else {
				$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(2) != "" ? $this->TimeExtensionAuthorized->tagCaption(2) : "No";
			}
			$this->TimeExtensionAuthorized->ViewCustomAttributes = "";

			// LabResultsChecked
			if (ConvertToBool($this->LabResultsChecked->CurrentValue)) {
				$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(1) != "" ? $this->LabResultsChecked->tagCaption(1) : "Yes";
			} else {
				$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(2) != "" ? $this->LabResultsChecked->tagCaption(2) : "No";
			}
			$this->LabResultsChecked->ViewCustomAttributes = "";

			// TerminationNoticeGiven
			if (ConvertToBool($this->TerminationNoticeGiven->CurrentValue)) {
				$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(1) != "" ? $this->TerminationNoticeGiven->tagCaption(1) : "Yes";
			} else {
				$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(2) != "" ? $this->TerminationNoticeGiven->tagCaption(2) : "No";
			}
			$this->TerminationNoticeGiven->ViewCustomAttributes = "";

			// CopiesEmailedToMLG
			if (ConvertToBool($this->CopiesEmailedToMLG->CurrentValue)) {
				$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(1) != "" ? $this->CopiesEmailedToMLG->tagCaption(1) : "Yes";
			} else {
				$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(2) != "" ? $this->CopiesEmailedToMLG->tagCaption(2) : "No";
			}
			$this->CopiesEmailedToMLG->ViewCustomAttributes = "";

			// ContractStillValid
			if (ConvertToBool($this->ContractStillValid->CurrentValue)) {
				$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(1) != "" ? $this->ContractStillValid->tagCaption(1) : "Yes";
			} else {
				$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(2) != "" ? $this->ContractStillValid->tagCaption(2) : "No";
			}
			$this->ContractStillValid->ViewCustomAttributes = "";

			// DeskOfficer
			$this->DeskOfficer->ViewValue = $this->DeskOfficer->CurrentValue;
			$this->DeskOfficer->ViewCustomAttributes = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->ViewValue = $this->DeskOfficerDate->CurrentValue;
			$this->DeskOfficerDate->ViewValue = FormatDateTime($this->DeskOfficerDate->ViewValue, 0);
			$this->DeskOfficerDate->ViewCustomAttributes = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->ViewValue = $this->SupervisingEngineer->CurrentValue;
			$this->SupervisingEngineer->ViewCustomAttributes = "";

			// EngineerDate
			$this->EngineerDate->ViewValue = $this->EngineerDate->CurrentValue;
			$this->EngineerDate->ViewValue = FormatDateTime($this->EngineerDate->ViewValue, 0);
			$this->EngineerDate->ViewCustomAttributes = "";

			// CouncilSecretary
			$this->CouncilSecretary->ViewValue = $this->CouncilSecretary->CurrentValue;
			$this->CouncilSecretary->ViewCustomAttributes = "";

			// CSDate
			$this->CSDate->ViewValue = $this->CSDate->CurrentValue;
			$this->CSDate->ViewValue = FormatDateTime($this->CSDate->ViewValue, 0);
			$this->CSDate->ViewCustomAttributes = "";

			// ContractType
			$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
			$this->ContractType->ViewValue = FormatNumber($this->ContractType->ViewValue, 0, -2, -2, -2);
			$this->ContractType->ViewCustomAttributes = "";

			// IPCNo
			$this->IPCNo->LinkCustomAttributes = "";
			$this->IPCNo->HrefValue = "";
			$this->IPCNo->TooltipValue = "";
			if (!$this->isExport())
				$this->IPCNo->ViewValue = $this->highlightValue($this->IPCNo);

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";
			$this->ContractNo->TooltipValue = "";
			if (!$this->isExport())
				$this->ContractNo->ViewValue = $this->highlightValue($this->ContractNo);

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->LinkCustomAttributes = "";
			$this->ContractAuthorizedByAG->HrefValue = "";
			$this->ContractAuthorizedByAG->TooltipValue = "";

			// VATApplied
			$this->VATApplied->LinkCustomAttributes = "";
			$this->VATApplied->HrefValue = "";
			$this->VATApplied->TooltipValue = "";

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->LinkCustomAttributes = "";
			$this->ArithmeticCheckDone->HrefValue = "";
			$this->ArithmeticCheckDone->TooltipValue = "";

			// VariationsApproved
			$this->VariationsApproved->LinkCustomAttributes = "";
			$this->VariationsApproved->HrefValue = "";
			$this->VariationsApproved->TooltipValue = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->LinkCustomAttributes = "";
			$this->PerformanceBondValidUntil->HrefValue = "";
			$this->PerformanceBondValidUntil->TooltipValue = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->LinkCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->HrefValue = "";
			$this->AdvancePaymentBondValidUntil->TooltipValue = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->LinkCustomAttributes = "";
			$this->RetentionDeductionClause->HrefValue = "";
			$this->RetentionDeductionClause->TooltipValue = "";
			if (!$this->isExport())
				$this->RetentionDeductionClause->ViewValue = $this->highlightValue($this->RetentionDeductionClause);

			// RetentionDeducted
			$this->RetentionDeducted->LinkCustomAttributes = "";
			$this->RetentionDeducted->HrefValue = "";
			$this->RetentionDeducted->TooltipValue = "";

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->LinkCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->HrefValue = "";
			$this->LiquidatedDamagesDeducted->TooltipValue = "";

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->LinkCustomAttributes = "";
			$this->AdvancedPaymentDeducted->HrefValue = "";
			$this->AdvancedPaymentDeducted->TooltipValue = "";

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->LinkCustomAttributes = "";
			$this->CurrentProgressReportAttached->HrefValue = "";
			$this->CurrentProgressReportAttached->TooltipValue = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->LinkCustomAttributes = "";
			$this->DateOfSiteInspection->HrefValue = "";
			$this->DateOfSiteInspection->TooltipValue = "";

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->LinkCustomAttributes = "";
			$this->TimeExtensionAuthorized->HrefValue = "";
			$this->TimeExtensionAuthorized->TooltipValue = "";

			// LabResultsChecked
			$this->LabResultsChecked->LinkCustomAttributes = "";
			$this->LabResultsChecked->HrefValue = "";
			$this->LabResultsChecked->TooltipValue = "";

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->LinkCustomAttributes = "";
			$this->TerminationNoticeGiven->HrefValue = "";
			$this->TerminationNoticeGiven->TooltipValue = "";

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->LinkCustomAttributes = "";
			$this->CopiesEmailedToMLG->HrefValue = "";
			$this->CopiesEmailedToMLG->TooltipValue = "";

			// ContractStillValid
			$this->ContractStillValid->LinkCustomAttributes = "";
			$this->ContractStillValid->HrefValue = "";
			$this->ContractStillValid->TooltipValue = "";

			// DeskOfficer
			$this->DeskOfficer->LinkCustomAttributes = "";
			$this->DeskOfficer->HrefValue = "";
			$this->DeskOfficer->TooltipValue = "";
			if (!$this->isExport())
				$this->DeskOfficer->ViewValue = $this->highlightValue($this->DeskOfficer);

			// DeskOfficerDate
			$this->DeskOfficerDate->LinkCustomAttributes = "";
			$this->DeskOfficerDate->HrefValue = "";
			$this->DeskOfficerDate->TooltipValue = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->LinkCustomAttributes = "";
			$this->SupervisingEngineer->HrefValue = "";
			$this->SupervisingEngineer->TooltipValue = "";
			if (!$this->isExport())
				$this->SupervisingEngineer->ViewValue = $this->highlightValue($this->SupervisingEngineer);

			// EngineerDate
			$this->EngineerDate->LinkCustomAttributes = "";
			$this->EngineerDate->HrefValue = "";
			$this->EngineerDate->TooltipValue = "";

			// CouncilSecretary
			$this->CouncilSecretary->LinkCustomAttributes = "";
			$this->CouncilSecretary->HrefValue = "";
			$this->CouncilSecretary->TooltipValue = "";
			if (!$this->isExport())
				$this->CouncilSecretary->ViewValue = $this->highlightValue($this->CouncilSecretary);

			// CSDate
			$this->CSDate->LinkCustomAttributes = "";
			$this->CSDate->HrefValue = "";
			$this->CSDate->TooltipValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
			$this->ContractType->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// IPCNo
			// ContractNo

			$this->ContractNo->EditAttrs["class"] = "form-control";
			$this->ContractNo->EditCustomAttributes = "";
			if ($this->ContractNo->getSessionValue() != "") {
				$this->ContractNo->CurrentValue = $this->ContractNo->getSessionValue();
				$this->ContractNo->OldValue = $this->ContractNo->CurrentValue;
				$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
				$this->ContractNo->ViewCustomAttributes = "";
			} else {
				if (!$this->ContractNo->Raw)
					$this->ContractNo->CurrentValue = HtmlDecode($this->ContractNo->CurrentValue);
				$this->ContractNo->EditValue = HtmlEncode($this->ContractNo->CurrentValue);
				$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());
			}

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->EditCustomAttributes = "";
			$this->ContractAuthorizedByAG->EditValue = $this->ContractAuthorizedByAG->options(FALSE);

			// VATApplied
			$this->VATApplied->EditCustomAttributes = "";
			$this->VATApplied->EditValue = $this->VATApplied->options(FALSE);

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->EditCustomAttributes = "";
			$this->ArithmeticCheckDone->EditValue = $this->ArithmeticCheckDone->options(FALSE);

			// VariationsApproved
			$this->VariationsApproved->EditCustomAttributes = "";
			$this->VariationsApproved->EditValue = $this->VariationsApproved->options(FALSE);

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->EditAttrs["class"] = "form-control";
			$this->PerformanceBondValidUntil->EditCustomAttributes = "";
			$this->PerformanceBondValidUntil->EditValue = HtmlEncode(FormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 8));
			$this->PerformanceBondValidUntil->PlaceHolder = RemoveHtml($this->PerformanceBondValidUntil->caption());

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentBondValidUntil->EditCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->EditValue = HtmlEncode(FormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 8));
			$this->AdvancePaymentBondValidUntil->PlaceHolder = RemoveHtml($this->AdvancePaymentBondValidUntil->caption());

			// RetentionDeductionClause
			$this->RetentionDeductionClause->EditAttrs["class"] = "form-control";
			$this->RetentionDeductionClause->EditCustomAttributes = "";
			if (!$this->RetentionDeductionClause->Raw)
				$this->RetentionDeductionClause->CurrentValue = HtmlDecode($this->RetentionDeductionClause->CurrentValue);
			$this->RetentionDeductionClause->EditValue = HtmlEncode($this->RetentionDeductionClause->CurrentValue);
			$this->RetentionDeductionClause->PlaceHolder = RemoveHtml($this->RetentionDeductionClause->caption());

			// RetentionDeducted
			$this->RetentionDeducted->EditCustomAttributes = "";
			$this->RetentionDeducted->EditValue = $this->RetentionDeducted->options(FALSE);

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->EditCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->EditValue = $this->LiquidatedDamagesDeducted->options(FALSE);

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->EditCustomAttributes = "";
			$this->AdvancedPaymentDeducted->EditValue = $this->AdvancedPaymentDeducted->options(FALSE);

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->EditCustomAttributes = "";
			$this->CurrentProgressReportAttached->EditValue = $this->CurrentProgressReportAttached->options(FALSE);

			// DateOfSiteInspection
			$this->DateOfSiteInspection->EditAttrs["class"] = "form-control";
			$this->DateOfSiteInspection->EditCustomAttributes = "";
			$this->DateOfSiteInspection->EditValue = HtmlEncode(FormatDateTime($this->DateOfSiteInspection->CurrentValue, 8));
			$this->DateOfSiteInspection->PlaceHolder = RemoveHtml($this->DateOfSiteInspection->caption());

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->EditCustomAttributes = "";
			$this->TimeExtensionAuthorized->EditValue = $this->TimeExtensionAuthorized->options(FALSE);

			// LabResultsChecked
			$this->LabResultsChecked->EditCustomAttributes = "";
			$this->LabResultsChecked->EditValue = $this->LabResultsChecked->options(FALSE);

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->EditCustomAttributes = "";
			$this->TerminationNoticeGiven->EditValue = $this->TerminationNoticeGiven->options(FALSE);

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->EditCustomAttributes = "";
			$this->CopiesEmailedToMLG->EditValue = $this->CopiesEmailedToMLG->options(FALSE);

			// ContractStillValid
			$this->ContractStillValid->EditCustomAttributes = "";
			$this->ContractStillValid->EditValue = $this->ContractStillValid->options(FALSE);

			// DeskOfficer
			$this->DeskOfficer->EditAttrs["class"] = "form-control";
			$this->DeskOfficer->EditCustomAttributes = "";
			if (!$this->DeskOfficer->Raw)
				$this->DeskOfficer->CurrentValue = HtmlDecode($this->DeskOfficer->CurrentValue);
			$this->DeskOfficer->EditValue = HtmlEncode($this->DeskOfficer->CurrentValue);
			$this->DeskOfficer->PlaceHolder = RemoveHtml($this->DeskOfficer->caption());

			// DeskOfficerDate
			$this->DeskOfficerDate->EditAttrs["class"] = "form-control";
			$this->DeskOfficerDate->EditCustomAttributes = "";
			$this->DeskOfficerDate->EditValue = HtmlEncode(FormatDateTime($this->DeskOfficerDate->CurrentValue, 8));
			$this->DeskOfficerDate->PlaceHolder = RemoveHtml($this->DeskOfficerDate->caption());

			// SupervisingEngineer
			$this->SupervisingEngineer->EditAttrs["class"] = "form-control";
			$this->SupervisingEngineer->EditCustomAttributes = "";
			if (!$this->SupervisingEngineer->Raw)
				$this->SupervisingEngineer->CurrentValue = HtmlDecode($this->SupervisingEngineer->CurrentValue);
			$this->SupervisingEngineer->EditValue = HtmlEncode($this->SupervisingEngineer->CurrentValue);
			$this->SupervisingEngineer->PlaceHolder = RemoveHtml($this->SupervisingEngineer->caption());

			// EngineerDate
			$this->EngineerDate->EditAttrs["class"] = "form-control";
			$this->EngineerDate->EditCustomAttributes = "";
			$this->EngineerDate->EditValue = HtmlEncode(FormatDateTime($this->EngineerDate->CurrentValue, 8));
			$this->EngineerDate->PlaceHolder = RemoveHtml($this->EngineerDate->caption());

			// CouncilSecretary
			$this->CouncilSecretary->EditAttrs["class"] = "form-control";
			$this->CouncilSecretary->EditCustomAttributes = "";
			if (!$this->CouncilSecretary->Raw)
				$this->CouncilSecretary->CurrentValue = HtmlDecode($this->CouncilSecretary->CurrentValue);
			$this->CouncilSecretary->EditValue = HtmlEncode($this->CouncilSecretary->CurrentValue);
			$this->CouncilSecretary->PlaceHolder = RemoveHtml($this->CouncilSecretary->caption());

			// CSDate
			$this->CSDate->EditAttrs["class"] = "form-control";
			$this->CSDate->EditCustomAttributes = "";
			$this->CSDate->EditValue = HtmlEncode(FormatDateTime($this->CSDate->CurrentValue, 8));
			$this->CSDate->PlaceHolder = RemoveHtml($this->CSDate->caption());

			// ContractType
			$this->ContractType->EditAttrs["class"] = "form-control";
			$this->ContractType->EditCustomAttributes = "";
			$this->ContractType->EditValue = HtmlEncode($this->ContractType->CurrentValue);
			$this->ContractType->PlaceHolder = RemoveHtml($this->ContractType->caption());

			// Add refer script
			// IPCNo

			$this->IPCNo->LinkCustomAttributes = "";
			$this->IPCNo->HrefValue = "";

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->LinkCustomAttributes = "";
			$this->ContractAuthorizedByAG->HrefValue = "";

			// VATApplied
			$this->VATApplied->LinkCustomAttributes = "";
			$this->VATApplied->HrefValue = "";

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->LinkCustomAttributes = "";
			$this->ArithmeticCheckDone->HrefValue = "";

			// VariationsApproved
			$this->VariationsApproved->LinkCustomAttributes = "";
			$this->VariationsApproved->HrefValue = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->LinkCustomAttributes = "";
			$this->PerformanceBondValidUntil->HrefValue = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->LinkCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->HrefValue = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->LinkCustomAttributes = "";
			$this->RetentionDeductionClause->HrefValue = "";

			// RetentionDeducted
			$this->RetentionDeducted->LinkCustomAttributes = "";
			$this->RetentionDeducted->HrefValue = "";

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->LinkCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->HrefValue = "";

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->LinkCustomAttributes = "";
			$this->AdvancedPaymentDeducted->HrefValue = "";

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->LinkCustomAttributes = "";
			$this->CurrentProgressReportAttached->HrefValue = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->LinkCustomAttributes = "";
			$this->DateOfSiteInspection->HrefValue = "";

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->LinkCustomAttributes = "";
			$this->TimeExtensionAuthorized->HrefValue = "";

			// LabResultsChecked
			$this->LabResultsChecked->LinkCustomAttributes = "";
			$this->LabResultsChecked->HrefValue = "";

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->LinkCustomAttributes = "";
			$this->TerminationNoticeGiven->HrefValue = "";

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->LinkCustomAttributes = "";
			$this->CopiesEmailedToMLG->HrefValue = "";

			// ContractStillValid
			$this->ContractStillValid->LinkCustomAttributes = "";
			$this->ContractStillValid->HrefValue = "";

			// DeskOfficer
			$this->DeskOfficer->LinkCustomAttributes = "";
			$this->DeskOfficer->HrefValue = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->LinkCustomAttributes = "";
			$this->DeskOfficerDate->HrefValue = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->LinkCustomAttributes = "";
			$this->SupervisingEngineer->HrefValue = "";

			// EngineerDate
			$this->EngineerDate->LinkCustomAttributes = "";
			$this->EngineerDate->HrefValue = "";

			// CouncilSecretary
			$this->CouncilSecretary->LinkCustomAttributes = "";
			$this->CouncilSecretary->HrefValue = "";

			// CSDate
			$this->CSDate->LinkCustomAttributes = "";
			$this->CSDate->HrefValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// IPCNo
			$this->IPCNo->EditAttrs["class"] = "form-control";
			$this->IPCNo->EditCustomAttributes = "";
			$this->IPCNo->EditValue = $this->IPCNo->CurrentValue;
			$this->IPCNo->ViewCustomAttributes = "";

			// ContractNo
			$this->ContractNo->EditAttrs["class"] = "form-control";
			$this->ContractNo->EditCustomAttributes = "";
			if ($this->ContractNo->getSessionValue() != "") {
				$this->ContractNo->CurrentValue = $this->ContractNo->getSessionValue();
				$this->ContractNo->OldValue = $this->ContractNo->CurrentValue;
				$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
				$this->ContractNo->ViewCustomAttributes = "";
			} else {
				if (!$this->ContractNo->Raw)
					$this->ContractNo->CurrentValue = HtmlDecode($this->ContractNo->CurrentValue);
				$this->ContractNo->EditValue = HtmlEncode($this->ContractNo->CurrentValue);
				$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());
			}

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->EditCustomAttributes = "";
			$this->ContractAuthorizedByAG->EditValue = $this->ContractAuthorizedByAG->options(FALSE);

			// VATApplied
			$this->VATApplied->EditCustomAttributes = "";
			$this->VATApplied->EditValue = $this->VATApplied->options(FALSE);

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->EditCustomAttributes = "";
			$this->ArithmeticCheckDone->EditValue = $this->ArithmeticCheckDone->options(FALSE);

			// VariationsApproved
			$this->VariationsApproved->EditCustomAttributes = "";
			$this->VariationsApproved->EditValue = $this->VariationsApproved->options(FALSE);

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->EditAttrs["class"] = "form-control";
			$this->PerformanceBondValidUntil->EditCustomAttributes = "";
			$this->PerformanceBondValidUntil->EditValue = HtmlEncode(FormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 8));
			$this->PerformanceBondValidUntil->PlaceHolder = RemoveHtml($this->PerformanceBondValidUntil->caption());

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentBondValidUntil->EditCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->EditValue = HtmlEncode(FormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 8));
			$this->AdvancePaymentBondValidUntil->PlaceHolder = RemoveHtml($this->AdvancePaymentBondValidUntil->caption());

			// RetentionDeductionClause
			$this->RetentionDeductionClause->EditAttrs["class"] = "form-control";
			$this->RetentionDeductionClause->EditCustomAttributes = "";
			if (!$this->RetentionDeductionClause->Raw)
				$this->RetentionDeductionClause->CurrentValue = HtmlDecode($this->RetentionDeductionClause->CurrentValue);
			$this->RetentionDeductionClause->EditValue = HtmlEncode($this->RetentionDeductionClause->CurrentValue);
			$this->RetentionDeductionClause->PlaceHolder = RemoveHtml($this->RetentionDeductionClause->caption());

			// RetentionDeducted
			$this->RetentionDeducted->EditCustomAttributes = "";
			$this->RetentionDeducted->EditValue = $this->RetentionDeducted->options(FALSE);

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->EditCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->EditValue = $this->LiquidatedDamagesDeducted->options(FALSE);

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->EditCustomAttributes = "";
			$this->AdvancedPaymentDeducted->EditValue = $this->AdvancedPaymentDeducted->options(FALSE);

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->EditCustomAttributes = "";
			$this->CurrentProgressReportAttached->EditValue = $this->CurrentProgressReportAttached->options(FALSE);

			// DateOfSiteInspection
			$this->DateOfSiteInspection->EditAttrs["class"] = "form-control";
			$this->DateOfSiteInspection->EditCustomAttributes = "";
			$this->DateOfSiteInspection->EditValue = HtmlEncode(FormatDateTime($this->DateOfSiteInspection->CurrentValue, 8));
			$this->DateOfSiteInspection->PlaceHolder = RemoveHtml($this->DateOfSiteInspection->caption());

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->EditCustomAttributes = "";
			$this->TimeExtensionAuthorized->EditValue = $this->TimeExtensionAuthorized->options(FALSE);

			// LabResultsChecked
			$this->LabResultsChecked->EditCustomAttributes = "";
			$this->LabResultsChecked->EditValue = $this->LabResultsChecked->options(FALSE);

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->EditCustomAttributes = "";
			$this->TerminationNoticeGiven->EditValue = $this->TerminationNoticeGiven->options(FALSE);

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->EditCustomAttributes = "";
			$this->CopiesEmailedToMLG->EditValue = $this->CopiesEmailedToMLG->options(FALSE);

			// ContractStillValid
			$this->ContractStillValid->EditCustomAttributes = "";
			$this->ContractStillValid->EditValue = $this->ContractStillValid->options(FALSE);

			// DeskOfficer
			$this->DeskOfficer->EditAttrs["class"] = "form-control";
			$this->DeskOfficer->EditCustomAttributes = "";
			if (!$this->DeskOfficer->Raw)
				$this->DeskOfficer->CurrentValue = HtmlDecode($this->DeskOfficer->CurrentValue);
			$this->DeskOfficer->EditValue = HtmlEncode($this->DeskOfficer->CurrentValue);
			$this->DeskOfficer->PlaceHolder = RemoveHtml($this->DeskOfficer->caption());

			// DeskOfficerDate
			$this->DeskOfficerDate->EditAttrs["class"] = "form-control";
			$this->DeskOfficerDate->EditCustomAttributes = "";
			$this->DeskOfficerDate->EditValue = HtmlEncode(FormatDateTime($this->DeskOfficerDate->CurrentValue, 8));
			$this->DeskOfficerDate->PlaceHolder = RemoveHtml($this->DeskOfficerDate->caption());

			// SupervisingEngineer
			$this->SupervisingEngineer->EditAttrs["class"] = "form-control";
			$this->SupervisingEngineer->EditCustomAttributes = "";
			if (!$this->SupervisingEngineer->Raw)
				$this->SupervisingEngineer->CurrentValue = HtmlDecode($this->SupervisingEngineer->CurrentValue);
			$this->SupervisingEngineer->EditValue = HtmlEncode($this->SupervisingEngineer->CurrentValue);
			$this->SupervisingEngineer->PlaceHolder = RemoveHtml($this->SupervisingEngineer->caption());

			// EngineerDate
			$this->EngineerDate->EditAttrs["class"] = "form-control";
			$this->EngineerDate->EditCustomAttributes = "";
			$this->EngineerDate->EditValue = HtmlEncode(FormatDateTime($this->EngineerDate->CurrentValue, 8));
			$this->EngineerDate->PlaceHolder = RemoveHtml($this->EngineerDate->caption());

			// CouncilSecretary
			$this->CouncilSecretary->EditAttrs["class"] = "form-control";
			$this->CouncilSecretary->EditCustomAttributes = "";
			if (!$this->CouncilSecretary->Raw)
				$this->CouncilSecretary->CurrentValue = HtmlDecode($this->CouncilSecretary->CurrentValue);
			$this->CouncilSecretary->EditValue = HtmlEncode($this->CouncilSecretary->CurrentValue);
			$this->CouncilSecretary->PlaceHolder = RemoveHtml($this->CouncilSecretary->caption());

			// CSDate
			$this->CSDate->EditAttrs["class"] = "form-control";
			$this->CSDate->EditCustomAttributes = "";
			$this->CSDate->EditValue = HtmlEncode(FormatDateTime($this->CSDate->CurrentValue, 8));
			$this->CSDate->PlaceHolder = RemoveHtml($this->CSDate->caption());

			// ContractType
			$this->ContractType->EditAttrs["class"] = "form-control";
			$this->ContractType->EditCustomAttributes = "";
			$this->ContractType->EditValue = HtmlEncode($this->ContractType->CurrentValue);
			$this->ContractType->PlaceHolder = RemoveHtml($this->ContractType->caption());

			// Edit refer script
			// IPCNo

			$this->IPCNo->LinkCustomAttributes = "";
			$this->IPCNo->HrefValue = "";

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->LinkCustomAttributes = "";
			$this->ContractAuthorizedByAG->HrefValue = "";

			// VATApplied
			$this->VATApplied->LinkCustomAttributes = "";
			$this->VATApplied->HrefValue = "";

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->LinkCustomAttributes = "";
			$this->ArithmeticCheckDone->HrefValue = "";

			// VariationsApproved
			$this->VariationsApproved->LinkCustomAttributes = "";
			$this->VariationsApproved->HrefValue = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->LinkCustomAttributes = "";
			$this->PerformanceBondValidUntil->HrefValue = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->LinkCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->HrefValue = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->LinkCustomAttributes = "";
			$this->RetentionDeductionClause->HrefValue = "";

			// RetentionDeducted
			$this->RetentionDeducted->LinkCustomAttributes = "";
			$this->RetentionDeducted->HrefValue = "";

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->LinkCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->HrefValue = "";

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->LinkCustomAttributes = "";
			$this->AdvancedPaymentDeducted->HrefValue = "";

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->LinkCustomAttributes = "";
			$this->CurrentProgressReportAttached->HrefValue = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->LinkCustomAttributes = "";
			$this->DateOfSiteInspection->HrefValue = "";

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->LinkCustomAttributes = "";
			$this->TimeExtensionAuthorized->HrefValue = "";

			// LabResultsChecked
			$this->LabResultsChecked->LinkCustomAttributes = "";
			$this->LabResultsChecked->HrefValue = "";

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->LinkCustomAttributes = "";
			$this->TerminationNoticeGiven->HrefValue = "";

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->LinkCustomAttributes = "";
			$this->CopiesEmailedToMLG->HrefValue = "";

			// ContractStillValid
			$this->ContractStillValid->LinkCustomAttributes = "";
			$this->ContractStillValid->HrefValue = "";

			// DeskOfficer
			$this->DeskOfficer->LinkCustomAttributes = "";
			$this->DeskOfficer->HrefValue = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->LinkCustomAttributes = "";
			$this->DeskOfficerDate->HrefValue = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->LinkCustomAttributes = "";
			$this->SupervisingEngineer->HrefValue = "";

			// EngineerDate
			$this->EngineerDate->LinkCustomAttributes = "";
			$this->EngineerDate->HrefValue = "";

			// CouncilSecretary
			$this->CouncilSecretary->LinkCustomAttributes = "";
			$this->CouncilSecretary->HrefValue = "";

			// CSDate
			$this->CSDate->LinkCustomAttributes = "";
			$this->CSDate->HrefValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
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
		if ($this->IPCNo->Required) {
			if (!$this->IPCNo->IsDetailKey && $this->IPCNo->FormValue != NULL && $this->IPCNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IPCNo->caption(), $this->IPCNo->RequiredErrorMessage));
			}
		}
		if ($this->ContractNo->Required) {
			if (!$this->ContractNo->IsDetailKey && $this->ContractNo->FormValue != NULL && $this->ContractNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractNo->caption(), $this->ContractNo->RequiredErrorMessage));
			}
		}
		if ($this->ContractAuthorizedByAG->Required) {
			if ($this->ContractAuthorizedByAG->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractAuthorizedByAG->caption(), $this->ContractAuthorizedByAG->RequiredErrorMessage));
			}
		}
		if ($this->VATApplied->Required) {
			if ($this->VATApplied->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->VATApplied->caption(), $this->VATApplied->RequiredErrorMessage));
			}
		}
		if ($this->ArithmeticCheckDone->Required) {
			if ($this->ArithmeticCheckDone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ArithmeticCheckDone->caption(), $this->ArithmeticCheckDone->RequiredErrorMessage));
			}
		}
		if ($this->VariationsApproved->Required) {
			if ($this->VariationsApproved->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->VariationsApproved->caption(), $this->VariationsApproved->RequiredErrorMessage));
			}
		}
		if ($this->PerformanceBondValidUntil->Required) {
			if (!$this->PerformanceBondValidUntil->IsDetailKey && $this->PerformanceBondValidUntil->FormValue != NULL && $this->PerformanceBondValidUntil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PerformanceBondValidUntil->caption(), $this->PerformanceBondValidUntil->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PerformanceBondValidUntil->FormValue)) {
			AddMessage($FormError, $this->PerformanceBondValidUntil->errorMessage());
		}
		if ($this->AdvancePaymentBondValidUntil->Required) {
			if (!$this->AdvancePaymentBondValidUntil->IsDetailKey && $this->AdvancePaymentBondValidUntil->FormValue != NULL && $this->AdvancePaymentBondValidUntil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AdvancePaymentBondValidUntil->caption(), $this->AdvancePaymentBondValidUntil->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->AdvancePaymentBondValidUntil->FormValue)) {
			AddMessage($FormError, $this->AdvancePaymentBondValidUntil->errorMessage());
		}
		if ($this->RetentionDeductionClause->Required) {
			if (!$this->RetentionDeductionClause->IsDetailKey && $this->RetentionDeductionClause->FormValue != NULL && $this->RetentionDeductionClause->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RetentionDeductionClause->caption(), $this->RetentionDeductionClause->RequiredErrorMessage));
			}
		}
		if ($this->RetentionDeducted->Required) {
			if ($this->RetentionDeducted->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RetentionDeducted->caption(), $this->RetentionDeducted->RequiredErrorMessage));
			}
		}
		if ($this->LiquidatedDamagesDeducted->Required) {
			if ($this->LiquidatedDamagesDeducted->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LiquidatedDamagesDeducted->caption(), $this->LiquidatedDamagesDeducted->RequiredErrorMessage));
			}
		}
		if ($this->AdvancedPaymentDeducted->Required) {
			if ($this->AdvancedPaymentDeducted->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AdvancedPaymentDeducted->caption(), $this->AdvancedPaymentDeducted->RequiredErrorMessage));
			}
		}
		if ($this->CurrentProgressReportAttached->Required) {
			if ($this->CurrentProgressReportAttached->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrentProgressReportAttached->caption(), $this->CurrentProgressReportAttached->RequiredErrorMessage));
			}
		}
		if ($this->DateOfSiteInspection->Required) {
			if (!$this->DateOfSiteInspection->IsDetailKey && $this->DateOfSiteInspection->FormValue != NULL && $this->DateOfSiteInspection->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfSiteInspection->caption(), $this->DateOfSiteInspection->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfSiteInspection->FormValue)) {
			AddMessage($FormError, $this->DateOfSiteInspection->errorMessage());
		}
		if ($this->TimeExtensionAuthorized->Required) {
			if ($this->TimeExtensionAuthorized->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TimeExtensionAuthorized->caption(), $this->TimeExtensionAuthorized->RequiredErrorMessage));
			}
		}
		if ($this->LabResultsChecked->Required) {
			if ($this->LabResultsChecked->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LabResultsChecked->caption(), $this->LabResultsChecked->RequiredErrorMessage));
			}
		}
		if ($this->TerminationNoticeGiven->Required) {
			if ($this->TerminationNoticeGiven->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TerminationNoticeGiven->caption(), $this->TerminationNoticeGiven->RequiredErrorMessage));
			}
		}
		if ($this->CopiesEmailedToMLG->Required) {
			if ($this->CopiesEmailedToMLG->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CopiesEmailedToMLG->caption(), $this->CopiesEmailedToMLG->RequiredErrorMessage));
			}
		}
		if ($this->ContractStillValid->Required) {
			if ($this->ContractStillValid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractStillValid->caption(), $this->ContractStillValid->RequiredErrorMessage));
			}
		}
		if ($this->DeskOfficer->Required) {
			if (!$this->DeskOfficer->IsDetailKey && $this->DeskOfficer->FormValue != NULL && $this->DeskOfficer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeskOfficer->caption(), $this->DeskOfficer->RequiredErrorMessage));
			}
		}
		if ($this->DeskOfficerDate->Required) {
			if (!$this->DeskOfficerDate->IsDetailKey && $this->DeskOfficerDate->FormValue != NULL && $this->DeskOfficerDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeskOfficerDate->caption(), $this->DeskOfficerDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DeskOfficerDate->FormValue)) {
			AddMessage($FormError, $this->DeskOfficerDate->errorMessage());
		}
		if ($this->SupervisingEngineer->Required) {
			if (!$this->SupervisingEngineer->IsDetailKey && $this->SupervisingEngineer->FormValue != NULL && $this->SupervisingEngineer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SupervisingEngineer->caption(), $this->SupervisingEngineer->RequiredErrorMessage));
			}
		}
		if ($this->EngineerDate->Required) {
			if (!$this->EngineerDate->IsDetailKey && $this->EngineerDate->FormValue != NULL && $this->EngineerDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EngineerDate->caption(), $this->EngineerDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->EngineerDate->FormValue)) {
			AddMessage($FormError, $this->EngineerDate->errorMessage());
		}
		if ($this->CouncilSecretary->Required) {
			if (!$this->CouncilSecretary->IsDetailKey && $this->CouncilSecretary->FormValue != NULL && $this->CouncilSecretary->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncilSecretary->caption(), $this->CouncilSecretary->RequiredErrorMessage));
			}
		}
		if ($this->CSDate->Required) {
			if (!$this->CSDate->IsDetailKey && $this->CSDate->FormValue != NULL && $this->CSDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CSDate->caption(), $this->CSDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->CSDate->FormValue)) {
			AddMessage($FormError, $this->CSDate->errorMessage());
		}
		if ($this->ContractType->Required) {
			if (!$this->ContractType->IsDetailKey && $this->ContractType->FormValue != NULL && $this->ContractType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ContractType->caption(), $this->ContractType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ContractType->FormValue)) {
			AddMessage($FormError, $this->ContractType->errorMessage());
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
				$thisKey .= $row['IPCNo'];
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

			// ContractNo
			$this->ContractNo->setDbValueDef($rsnew, $this->ContractNo->CurrentValue, NULL, $this->ContractNo->ReadOnly);

			// ContractAuthorizedByAG
			$tmpBool = $this->ContractAuthorizedByAG->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ContractAuthorizedByAG->setDbValueDef($rsnew, $tmpBool, NULL, $this->ContractAuthorizedByAG->ReadOnly);

			// VATApplied
			$tmpBool = $this->VATApplied->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->VATApplied->setDbValueDef($rsnew, $tmpBool, NULL, $this->VATApplied->ReadOnly);

			// ArithmeticCheckDone
			$tmpBool = $this->ArithmeticCheckDone->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ArithmeticCheckDone->setDbValueDef($rsnew, $tmpBool, NULL, $this->ArithmeticCheckDone->ReadOnly);

			// VariationsApproved
			$tmpBool = $this->VariationsApproved->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->VariationsApproved->setDbValueDef($rsnew, $tmpBool, NULL, $this->VariationsApproved->ReadOnly);

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->setDbValueDef($rsnew, UnFormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 0), NULL, $this->PerformanceBondValidUntil->ReadOnly);

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->setDbValueDef($rsnew, UnFormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 0), NULL, $this->AdvancePaymentBondValidUntil->ReadOnly);

			// RetentionDeductionClause
			$this->RetentionDeductionClause->setDbValueDef($rsnew, $this->RetentionDeductionClause->CurrentValue, NULL, $this->RetentionDeductionClause->ReadOnly);

			// RetentionDeducted
			$tmpBool = $this->RetentionDeducted->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->RetentionDeducted->setDbValueDef($rsnew, $tmpBool, NULL, $this->RetentionDeducted->ReadOnly);

			// LiquidatedDamagesDeducted
			$tmpBool = $this->LiquidatedDamagesDeducted->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->LiquidatedDamagesDeducted->setDbValueDef($rsnew, $tmpBool, NULL, $this->LiquidatedDamagesDeducted->ReadOnly);

			// AdvancedPaymentDeducted
			$tmpBool = $this->AdvancedPaymentDeducted->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->AdvancedPaymentDeducted->setDbValueDef($rsnew, $tmpBool, NULL, $this->AdvancedPaymentDeducted->ReadOnly);

			// CurrentProgressReportAttached
			$tmpBool = $this->CurrentProgressReportAttached->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->CurrentProgressReportAttached->setDbValueDef($rsnew, $tmpBool, NULL, $this->CurrentProgressReportAttached->ReadOnly);

			// DateOfSiteInspection
			$this->DateOfSiteInspection->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfSiteInspection->CurrentValue, 0), NULL, $this->DateOfSiteInspection->ReadOnly);

			// TimeExtensionAuthorized
			$tmpBool = $this->TimeExtensionAuthorized->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->TimeExtensionAuthorized->setDbValueDef($rsnew, $tmpBool, NULL, $this->TimeExtensionAuthorized->ReadOnly);

			// LabResultsChecked
			$tmpBool = $this->LabResultsChecked->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->LabResultsChecked->setDbValueDef($rsnew, $tmpBool, NULL, $this->LabResultsChecked->ReadOnly);

			// TerminationNoticeGiven
			$tmpBool = $this->TerminationNoticeGiven->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->TerminationNoticeGiven->setDbValueDef($rsnew, $tmpBool, NULL, $this->TerminationNoticeGiven->ReadOnly);

			// CopiesEmailedToMLG
			$tmpBool = $this->CopiesEmailedToMLG->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->CopiesEmailedToMLG->setDbValueDef($rsnew, $tmpBool, NULL, $this->CopiesEmailedToMLG->ReadOnly);

			// ContractStillValid
			$tmpBool = $this->ContractStillValid->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->ContractStillValid->setDbValueDef($rsnew, $tmpBool, NULL, $this->ContractStillValid->ReadOnly);

			// DeskOfficer
			$this->DeskOfficer->setDbValueDef($rsnew, $this->DeskOfficer->CurrentValue, NULL, $this->DeskOfficer->ReadOnly);

			// DeskOfficerDate
			$this->DeskOfficerDate->setDbValueDef($rsnew, UnFormatDateTime($this->DeskOfficerDate->CurrentValue, 0), NULL, $this->DeskOfficerDate->ReadOnly);

			// SupervisingEngineer
			$this->SupervisingEngineer->setDbValueDef($rsnew, $this->SupervisingEngineer->CurrentValue, NULL, $this->SupervisingEngineer->ReadOnly);

			// EngineerDate
			$this->EngineerDate->setDbValueDef($rsnew, UnFormatDateTime($this->EngineerDate->CurrentValue, 0), NULL, $this->EngineerDate->ReadOnly);

			// CouncilSecretary
			$this->CouncilSecretary->setDbValueDef($rsnew, $this->CouncilSecretary->CurrentValue, NULL, $this->CouncilSecretary->ReadOnly);

			// CSDate
			$this->CSDate->setDbValueDef($rsnew, UnFormatDateTime($this->CSDate->CurrentValue, 0), NULL, $this->CSDate->ReadOnly);

			// ContractType
			$this->ContractType->setDbValueDef($rsnew, $this->ContractType->CurrentValue, NULL, $this->ContractType->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "contract") {
				$this->ContractNo->CurrentValue = $this->ContractNo->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ContractNo
		$this->ContractNo->setDbValueDef($rsnew, $this->ContractNo->CurrentValue, NULL, FALSE);

		// ContractAuthorizedByAG
		$tmpBool = $this->ContractAuthorizedByAG->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ContractAuthorizedByAG->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// VATApplied
		$tmpBool = $this->VATApplied->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->VATApplied->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// ArithmeticCheckDone
		$tmpBool = $this->ArithmeticCheckDone->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ArithmeticCheckDone->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// VariationsApproved
		$tmpBool = $this->VariationsApproved->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->VariationsApproved->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// PerformanceBondValidUntil
		$this->PerformanceBondValidUntil->setDbValueDef($rsnew, UnFormatDateTime($this->PerformanceBondValidUntil->CurrentValue, 0), NULL, FALSE);

		// AdvancePaymentBondValidUntil
		$this->AdvancePaymentBondValidUntil->setDbValueDef($rsnew, UnFormatDateTime($this->AdvancePaymentBondValidUntil->CurrentValue, 0), NULL, FALSE);

		// RetentionDeductionClause
		$this->RetentionDeductionClause->setDbValueDef($rsnew, $this->RetentionDeductionClause->CurrentValue, NULL, FALSE);

		// RetentionDeducted
		$tmpBool = $this->RetentionDeducted->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->RetentionDeducted->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// LiquidatedDamagesDeducted
		$tmpBool = $this->LiquidatedDamagesDeducted->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->LiquidatedDamagesDeducted->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// AdvancedPaymentDeducted
		$tmpBool = $this->AdvancedPaymentDeducted->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->AdvancedPaymentDeducted->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// CurrentProgressReportAttached
		$tmpBool = $this->CurrentProgressReportAttached->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->CurrentProgressReportAttached->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// DateOfSiteInspection
		$this->DateOfSiteInspection->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfSiteInspection->CurrentValue, 0), NULL, FALSE);

		// TimeExtensionAuthorized
		$tmpBool = $this->TimeExtensionAuthorized->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->TimeExtensionAuthorized->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// LabResultsChecked
		$tmpBool = $this->LabResultsChecked->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->LabResultsChecked->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// TerminationNoticeGiven
		$tmpBool = $this->TerminationNoticeGiven->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->TerminationNoticeGiven->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// CopiesEmailedToMLG
		$tmpBool = $this->CopiesEmailedToMLG->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->CopiesEmailedToMLG->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// ContractStillValid
		$tmpBool = $this->ContractStillValid->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->ContractStillValid->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// DeskOfficer
		$this->DeskOfficer->setDbValueDef($rsnew, $this->DeskOfficer->CurrentValue, NULL, FALSE);

		// DeskOfficerDate
		$this->DeskOfficerDate->setDbValueDef($rsnew, UnFormatDateTime($this->DeskOfficerDate->CurrentValue, 0), NULL, FALSE);

		// SupervisingEngineer
		$this->SupervisingEngineer->setDbValueDef($rsnew, $this->SupervisingEngineer->CurrentValue, NULL, FALSE);

		// EngineerDate
		$this->EngineerDate->setDbValueDef($rsnew, UnFormatDateTime($this->EngineerDate->CurrentValue, 0), NULL, FALSE);

		// CouncilSecretary
		$this->CouncilSecretary->setDbValueDef($rsnew, $this->CouncilSecretary->CurrentValue, NULL, FALSE);

		// CSDate
		$this->CSDate->setDbValueDef($rsnew, UnFormatDateTime($this->CSDate->CurrentValue, 0), NULL, FALSE);

		// ContractType
		$this->ContractType->setDbValueDef($rsnew, $this->ContractType->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "contract") {
			$this->ContractNo->Visible = FALSE;
			if ($GLOBALS["contract"]->EventCancelled)
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
				case "x_ContractAuthorizedByAG":
					break;
				case "x_VATApplied":
					break;
				case "x_ArithmeticCheckDone":
					break;
				case "x_VariationsApproved":
					break;
				case "x_RetentionDeducted":
					break;
				case "x_LiquidatedDamagesDeducted":
					break;
				case "x_LiquidatedPenaltiesDeducted":
					break;
				case "x_AdvancedPaymentDeducted":
					break;
				case "x_CurrentProgressReportAttached":
					break;
				case "x_TimeExtensionAuthorized":
					break;
				case "x_LabResultsChecked":
					break;
				case "x_TerminationNoticeGiven":
					break;
				case "x_CopiesEmailedToMLG":
					break;
				case "x_ContractStillValid":
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