<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class output_grid extends output
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'output';

	// Page object name
	public $PageObjName = "output_grid";

	// Grid form hidden field names
	public $FormName = "foutputgrid";
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

		// Table object (output)
		if (!isset($GLOBALS["output"]) || get_class($GLOBALS["output"]) == PROJECT_NAMESPACE . "output") {
			$GLOBALS["output"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["output"];

		}
		$this->AddUrl = "outputadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'output');

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
		global $output;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($output);
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
			$key .= @$ar['OutputCode'];
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
			$this->OutputCode->Visible = FALSE;
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
	public $_action_Count;
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
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->OutcomeCode->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->OutputType->setVisibility();
		$this->OutputName->setVisibility();
		$this->DeliveryDate->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->OutputDescription->setVisibility();
		$this->OutputMeansOfVerification->setVisibility();
		$this->ResponsibleOfficer->setVisibility();
		$this->Clients->setVisibility();
		$this->Beneficiaries->setVisibility();
		$this->OutputStatus->setVisibility();
		$this->LockStatus->Visible = FALSE;
		$this->TargetAmount->setVisibility();
		$this->ActualAmount->setVisibility();
		$this->PercentAchieved->setVisibility();
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
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->OutputType);
		$this->setupLookupOptions($this->OutputStatus);
		$this->setupLookupOptions($this->LockStatus);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "outcome") {
			global $outcome;
			$rsmaster = $outcome->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("outcomelist.php"); // Return to master page
			} else {
				$outcome->loadListRowValues($rsmaster);
				$outcome->RowType = ROWTYPE_MASTER; // Master row
				$outcome->renderListRow();
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
		$this->TargetAmount->FormValue = ""; // Clear form value
		$this->ActualAmount->FormValue = ""; // Clear form value
		$this->PercentAchieved->FormValue = ""; // Clear form value
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
			$this->OutputCode->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->OutputCode->OldValue))
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
					$key .= $this->OutputCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_LACode") && $CurrentForm->hasValue("o_LACode") && $this->LACode->CurrentValue != $this->LACode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepartmentCode") && $CurrentForm->hasValue("o_DepartmentCode") && $this->DepartmentCode->CurrentValue != $this->DepartmentCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SectionCode") && $CurrentForm->hasValue("o_SectionCode") && $this->SectionCode->CurrentValue != $this->SectionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutcomeCode") && $CurrentForm->hasValue("o_OutcomeCode") && $this->OutcomeCode->CurrentValue != $this->OutcomeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProgramCode") && $CurrentForm->hasValue("o_ProgramCode") && $this->ProgramCode->CurrentValue != $this->ProgramCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SubProgramCode") && $CurrentForm->hasValue("o_SubProgramCode") && $this->SubProgramCode->CurrentValue != $this->SubProgramCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputType") && $CurrentForm->hasValue("o_OutputType") && $this->OutputType->CurrentValue != $this->OutputType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputName") && $CurrentForm->hasValue("o_OutputName") && $this->OutputName->CurrentValue != $this->OutputName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeliveryDate") && $CurrentForm->hasValue("o_DeliveryDate") && $this->DeliveryDate->CurrentValue != $this->DeliveryDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FinancialYear") && $CurrentForm->hasValue("o_FinancialYear") && $this->FinancialYear->CurrentValue != $this->FinancialYear->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputDescription") && $CurrentForm->hasValue("o_OutputDescription") && $this->OutputDescription->CurrentValue != $this->OutputDescription->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputMeansOfVerification") && $CurrentForm->hasValue("o_OutputMeansOfVerification") && $this->OutputMeansOfVerification->CurrentValue != $this->OutputMeansOfVerification->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ResponsibleOfficer") && $CurrentForm->hasValue("o_ResponsibleOfficer") && $this->ResponsibleOfficer->CurrentValue != $this->ResponsibleOfficer->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Clients") && $CurrentForm->hasValue("o_Clients") && $this->Clients->CurrentValue != $this->Clients->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Beneficiaries") && $CurrentForm->hasValue("o_Beneficiaries") && $this->Beneficiaries->CurrentValue != $this->Beneficiaries->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputStatus") && $CurrentForm->hasValue("o_OutputStatus") && $this->OutputStatus->CurrentValue != $this->OutputStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TargetAmount") && $CurrentForm->hasValue("o_TargetAmount") && $this->TargetAmount->CurrentValue != $this->TargetAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActualAmount") && $CurrentForm->hasValue("o_ActualAmount") && $this->ActualAmount->CurrentValue != $this->ActualAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PercentAchieved") && $CurrentForm->hasValue("o_PercentAchieved") && $this->PercentAchieved->CurrentValue != $this->PercentAchieved->OldValue)
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
				$this->OutcomeCode->setSessionValue("");
				$this->LACode->setSessionValue("");
				$this->DepartmentCode->setSessionValue("");
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"output\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->OutputCode->CurrentValue . "\">";
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
		$key .= $rs->fields('OutputCode');
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
		$sqlwrk = $sqlwrk . " AND " . "`DepartmentCode`=" . AdjustSql($this->DepartmentCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`OucomeCode`=" . AdjustSql($this->OutcomeCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`ProgramCode`=" . AdjustSql($this->ProgramCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`OutputCode`=" . AdjustSql($this->OutputCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`FinancialYear`=" . AdjustSql($this->FinancialYear->CurrentValue, $this->Dbid) . "";

		// Column "detail__action"
		if ($this->DetailPages && $this->DetailPages["_action"] && $this->DetailPages["_action"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail__action"];
			$url = "_actionpreview.php?t=output&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"_action\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'output')) {
				$label = $Language->TablePhrase("_action", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->_action_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"_action\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("_actionlist.php?" . Config("TABLE_SHOW_MASTER") . "=output&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "&fk_DepartmentCode=" . urlencode(strval($this->DepartmentCode->CurrentValue)) . "&fk_OutcomeCode=" . urlencode(strval($this->OutcomeCode->CurrentValue)) . "&fk_ProgramCode=" . urlencode(strval($this->ProgramCode->CurrentValue)) . "&fk_OutputCode=" . urlencode(strval($this->OutputCode->CurrentValue)) . "&fk_FinancialYear=" . urlencode(strval($this->FinancialYear->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("_action", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["_action_grid"]))
				$GLOBALS["_action_grid"] = new _action_grid();
			if ($GLOBALS["_action_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'output')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=_action");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["_action_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'output')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=_action");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["_action_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'output')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=_action");
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
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->OutcomeCode->CurrentValue = NULL;
		$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
		$this->ProgramCode->CurrentValue = NULL;
		$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
		$this->SubProgramCode->CurrentValue = NULL;
		$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
		$this->OutputCode->CurrentValue = NULL;
		$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
		$this->OutputType->CurrentValue = NULL;
		$this->OutputType->OldValue = $this->OutputType->CurrentValue;
		$this->OutputName->CurrentValue = NULL;
		$this->OutputName->OldValue = $this->OutputName->CurrentValue;
		$this->DeliveryDate->CurrentValue = NULL;
		$this->DeliveryDate->OldValue = $this->DeliveryDate->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->OutputDescription->CurrentValue = NULL;
		$this->OutputDescription->OldValue = $this->OutputDescription->CurrentValue;
		$this->OutputMeansOfVerification->CurrentValue = NULL;
		$this->OutputMeansOfVerification->OldValue = $this->OutputMeansOfVerification->CurrentValue;
		$this->ResponsibleOfficer->CurrentValue = NULL;
		$this->ResponsibleOfficer->OldValue = $this->ResponsibleOfficer->CurrentValue;
		$this->Clients->CurrentValue = NULL;
		$this->Clients->OldValue = $this->Clients->CurrentValue;
		$this->Beneficiaries->CurrentValue = NULL;
		$this->Beneficiaries->OldValue = $this->Beneficiaries->CurrentValue;
		$this->OutputStatus->CurrentValue = NULL;
		$this->OutputStatus->OldValue = $this->OutputStatus->CurrentValue;
		$this->LockStatus->CurrentValue = NULL;
		$this->LockStatus->OldValue = $this->LockStatus->CurrentValue;
		$this->TargetAmount->CurrentValue = NULL;
		$this->TargetAmount->OldValue = $this->TargetAmount->CurrentValue;
		$this->ActualAmount->CurrentValue = NULL;
		$this->ActualAmount->OldValue = $this->ActualAmount->CurrentValue;
		$this->PercentAchieved->CurrentValue = NULL;
		$this->PercentAchieved->OldValue = $this->PercentAchieved->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LACode"))
			$this->LACode->setOldValue($CurrentForm->getValue("o_LACode"));

		// Check field name 'DepartmentCode' first before field var 'x_DepartmentCode'
		$val = $CurrentForm->hasValue("DepartmentCode") ? $CurrentForm->getValue("DepartmentCode") : $CurrentForm->getValue("x_DepartmentCode");
		if (!$this->DepartmentCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepartmentCode->Visible = FALSE; // Disable update for API request
			else
				$this->DepartmentCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DepartmentCode"))
			$this->DepartmentCode->setOldValue($CurrentForm->getValue("o_DepartmentCode"));

		// Check field name 'SectionCode' first before field var 'x_SectionCode'
		$val = $CurrentForm->hasValue("SectionCode") ? $CurrentForm->getValue("SectionCode") : $CurrentForm->getValue("x_SectionCode");
		if (!$this->SectionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SectionCode->Visible = FALSE; // Disable update for API request
			else
				$this->SectionCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SectionCode"))
			$this->SectionCode->setOldValue($CurrentForm->getValue("o_SectionCode"));

		// Check field name 'OutcomeCode' first before field var 'x_OutcomeCode'
		$val = $CurrentForm->hasValue("OutcomeCode") ? $CurrentForm->getValue("OutcomeCode") : $CurrentForm->getValue("x_OutcomeCode");
		if (!$this->OutcomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutcomeCode"))
			$this->OutcomeCode->setOldValue($CurrentForm->getValue("o_OutcomeCode"));

		// Check field name 'ProgramCode' first before field var 'x_ProgramCode'
		$val = $CurrentForm->hasValue("ProgramCode") ? $CurrentForm->getValue("ProgramCode") : $CurrentForm->getValue("x_ProgramCode");
		if (!$this->ProgramCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProgramCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProgramCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProgramCode"))
			$this->ProgramCode->setOldValue($CurrentForm->getValue("o_ProgramCode"));

		// Check field name 'SubProgramCode' first before field var 'x_SubProgramCode'
		$val = $CurrentForm->hasValue("SubProgramCode") ? $CurrentForm->getValue("SubProgramCode") : $CurrentForm->getValue("x_SubProgramCode");
		if (!$this->SubProgramCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SubProgramCode->Visible = FALSE; // Disable update for API request
			else
				$this->SubProgramCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SubProgramCode"))
			$this->SubProgramCode->setOldValue($CurrentForm->getValue("o_SubProgramCode"));

		// Check field name 'OutputCode' first before field var 'x_OutputCode'
		$val = $CurrentForm->hasValue("OutputCode") ? $CurrentForm->getValue("OutputCode") : $CurrentForm->getValue("x_OutputCode");
		if (!$this->OutputCode->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->OutputCode->setFormValue($val);

		// Check field name 'OutputType' first before field var 'x_OutputType'
		$val = $CurrentForm->hasValue("OutputType") ? $CurrentForm->getValue("OutputType") : $CurrentForm->getValue("x_OutputType");
		if (!$this->OutputType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputType->Visible = FALSE; // Disable update for API request
			else
				$this->OutputType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutputType"))
			$this->OutputType->setOldValue($CurrentForm->getValue("o_OutputType"));

		// Check field name 'OutputName' first before field var 'x_OutputName'
		$val = $CurrentForm->hasValue("OutputName") ? $CurrentForm->getValue("OutputName") : $CurrentForm->getValue("x_OutputName");
		if (!$this->OutputName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputName->Visible = FALSE; // Disable update for API request
			else
				$this->OutputName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutputName"))
			$this->OutputName->setOldValue($CurrentForm->getValue("o_OutputName"));

		// Check field name 'DeliveryDate' first before field var 'x_DeliveryDate'
		$val = $CurrentForm->hasValue("DeliveryDate") ? $CurrentForm->getValue("DeliveryDate") : $CurrentForm->getValue("x_DeliveryDate");
		if (!$this->DeliveryDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeliveryDate->Visible = FALSE; // Disable update for API request
			else
				$this->DeliveryDate->setFormValue($val);
			$this->DeliveryDate->CurrentValue = UnFormatDateTime($this->DeliveryDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DeliveryDate"))
			$this->DeliveryDate->setOldValue($CurrentForm->getValue("o_DeliveryDate"));

		// Check field name 'FinancialYear' first before field var 'x_FinancialYear'
		$val = $CurrentForm->hasValue("FinancialYear") ? $CurrentForm->getValue("FinancialYear") : $CurrentForm->getValue("x_FinancialYear");
		if (!$this->FinancialYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FinancialYear->Visible = FALSE; // Disable update for API request
			else
				$this->FinancialYear->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FinancialYear"))
			$this->FinancialYear->setOldValue($CurrentForm->getValue("o_FinancialYear"));

		// Check field name 'OutputDescription' first before field var 'x_OutputDescription'
		$val = $CurrentForm->hasValue("OutputDescription") ? $CurrentForm->getValue("OutputDescription") : $CurrentForm->getValue("x_OutputDescription");
		if (!$this->OutputDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputDescription->Visible = FALSE; // Disable update for API request
			else
				$this->OutputDescription->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutputDescription"))
			$this->OutputDescription->setOldValue($CurrentForm->getValue("o_OutputDescription"));

		// Check field name 'OutputMeansOfVerification' first before field var 'x_OutputMeansOfVerification'
		$val = $CurrentForm->hasValue("OutputMeansOfVerification") ? $CurrentForm->getValue("OutputMeansOfVerification") : $CurrentForm->getValue("x_OutputMeansOfVerification");
		if (!$this->OutputMeansOfVerification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputMeansOfVerification->Visible = FALSE; // Disable update for API request
			else
				$this->OutputMeansOfVerification->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutputMeansOfVerification"))
			$this->OutputMeansOfVerification->setOldValue($CurrentForm->getValue("o_OutputMeansOfVerification"));

		// Check field name 'ResponsibleOfficer' first before field var 'x_ResponsibleOfficer'
		$val = $CurrentForm->hasValue("ResponsibleOfficer") ? $CurrentForm->getValue("ResponsibleOfficer") : $CurrentForm->getValue("x_ResponsibleOfficer");
		if (!$this->ResponsibleOfficer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ResponsibleOfficer->Visible = FALSE; // Disable update for API request
			else
				$this->ResponsibleOfficer->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ResponsibleOfficer"))
			$this->ResponsibleOfficer->setOldValue($CurrentForm->getValue("o_ResponsibleOfficer"));

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

		// Check field name 'OutputStatus' first before field var 'x_OutputStatus'
		$val = $CurrentForm->hasValue("OutputStatus") ? $CurrentForm->getValue("OutputStatus") : $CurrentForm->getValue("x_OutputStatus");
		if (!$this->OutputStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputStatus->Visible = FALSE; // Disable update for API request
			else
				$this->OutputStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutputStatus"))
			$this->OutputStatus->setOldValue($CurrentForm->getValue("o_OutputStatus"));

		// Check field name 'TargetAmount' first before field var 'x_TargetAmount'
		$val = $CurrentForm->hasValue("TargetAmount") ? $CurrentForm->getValue("TargetAmount") : $CurrentForm->getValue("x_TargetAmount");
		if (!$this->TargetAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TargetAmount->Visible = FALSE; // Disable update for API request
			else
				$this->TargetAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TargetAmount"))
			$this->TargetAmount->setOldValue($CurrentForm->getValue("o_TargetAmount"));

		// Check field name 'ActualAmount' first before field var 'x_ActualAmount'
		$val = $CurrentForm->hasValue("ActualAmount") ? $CurrentForm->getValue("ActualAmount") : $CurrentForm->getValue("x_ActualAmount");
		if (!$this->ActualAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualAmount->Visible = FALSE; // Disable update for API request
			else
				$this->ActualAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ActualAmount"))
			$this->ActualAmount->setOldValue($CurrentForm->getValue("o_ActualAmount"));

		// Check field name 'PercentAchieved' first before field var 'x_PercentAchieved'
		$val = $CurrentForm->hasValue("PercentAchieved") ? $CurrentForm->getValue("PercentAchieved") : $CurrentForm->getValue("x_PercentAchieved");
		if (!$this->PercentAchieved->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PercentAchieved->Visible = FALSE; // Disable update for API request
			else
				$this->PercentAchieved->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PercentAchieved"))
			$this->PercentAchieved->setOldValue($CurrentForm->getValue("o_PercentAchieved"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->SubProgramCode->CurrentValue = $this->SubProgramCode->FormValue;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->OutputType->CurrentValue = $this->OutputType->FormValue;
		$this->OutputName->CurrentValue = $this->OutputName->FormValue;
		$this->DeliveryDate->CurrentValue = $this->DeliveryDate->FormValue;
		$this->DeliveryDate->CurrentValue = UnFormatDateTime($this->DeliveryDate->CurrentValue, 0);
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->OutputDescription->CurrentValue = $this->OutputDescription->FormValue;
		$this->OutputMeansOfVerification->CurrentValue = $this->OutputMeansOfVerification->FormValue;
		$this->ResponsibleOfficer->CurrentValue = $this->ResponsibleOfficer->FormValue;
		$this->Clients->CurrentValue = $this->Clients->FormValue;
		$this->Beneficiaries->CurrentValue = $this->Beneficiaries->FormValue;
		$this->OutputStatus->CurrentValue = $this->OutputStatus->FormValue;
		$this->TargetAmount->CurrentValue = $this->TargetAmount->FormValue;
		$this->ActualAmount->CurrentValue = $this->ActualAmount->FormValue;
		$this->PercentAchieved->CurrentValue = $this->PercentAchieved->FormValue;
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
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->OutputType->setDbValue($row['OutputType']);
		$this->OutputName->setDbValue($row['OutputName']);
		$this->DeliveryDate->setDbValue($row['DeliveryDate']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->OutputDescription->setDbValue($row['OutputDescription']);
		$this->OutputMeansOfVerification->setDbValue($row['OutputMeansOfVerification']);
		$this->ResponsibleOfficer->setDbValue($row['ResponsibleOfficer']);
		$this->Clients->setDbValue($row['Clients']);
		$this->Beneficiaries->setDbValue($row['Beneficiaries']);
		$this->OutputStatus->setDbValue($row['OutputStatus']);
		$this->LockStatus->setDbValue($row['LockStatus']);
		$this->TargetAmount->setDbValue($row['TargetAmount']);
		$this->ActualAmount->setDbValue($row['ActualAmount']);
		$this->PercentAchieved->setDbValue($row['PercentAchieved']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['OutcomeCode'] = $this->OutcomeCode->CurrentValue;
		$row['ProgramCode'] = $this->ProgramCode->CurrentValue;
		$row['SubProgramCode'] = $this->SubProgramCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['OutputType'] = $this->OutputType->CurrentValue;
		$row['OutputName'] = $this->OutputName->CurrentValue;
		$row['DeliveryDate'] = $this->DeliveryDate->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['OutputDescription'] = $this->OutputDescription->CurrentValue;
		$row['OutputMeansOfVerification'] = $this->OutputMeansOfVerification->CurrentValue;
		$row['ResponsibleOfficer'] = $this->ResponsibleOfficer->CurrentValue;
		$row['Clients'] = $this->Clients->CurrentValue;
		$row['Beneficiaries'] = $this->Beneficiaries->CurrentValue;
		$row['OutputStatus'] = $this->OutputStatus->CurrentValue;
		$row['LockStatus'] = $this->LockStatus->CurrentValue;
		$row['TargetAmount'] = $this->TargetAmount->CurrentValue;
		$row['ActualAmount'] = $this->ActualAmount->CurrentValue;
		$row['PercentAchieved'] = $this->PercentAchieved->CurrentValue;
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
				$this->OutputCode->OldValue = strval($keys[0]); // OutputCode
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
		if ($this->TargetAmount->FormValue == $this->TargetAmount->CurrentValue && is_numeric(ConvertToFloatString($this->TargetAmount->CurrentValue)))
			$this->TargetAmount->CurrentValue = ConvertToFloatString($this->TargetAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ActualAmount->FormValue == $this->ActualAmount->CurrentValue && is_numeric(ConvertToFloatString($this->ActualAmount->CurrentValue)))
			$this->ActualAmount->CurrentValue = ConvertToFloatString($this->ActualAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->PercentAchieved->FormValue == $this->PercentAchieved->CurrentValue && is_numeric(ConvertToFloatString($this->PercentAchieved->CurrentValue)))
			$this->PercentAchieved->CurrentValue = ConvertToFloatString($this->PercentAchieved->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LACode
		// DepartmentCode
		// SectionCode
		// OutcomeCode
		// ProgramCode
		// SubProgramCode
		// OutputCode
		// OutputType
		// OutputName
		// DeliveryDate
		// FinancialYear
		// OutputDescription
		// OutputMeansOfVerification
		// ResponsibleOfficer
		// Clients
		// Beneficiaries
		// OutputStatus
		// LockStatus
		// TargetAmount
		// ActualAmount
		// PercentAchieved

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$curVal = strval($this->LACode->CurrentValue);
			if ($curVal != "") {
				$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->ViewValue = $this->LACode->CurrentValue;
					}
				}
			} else {
				$this->LACode->ViewValue = NULL;
			}
			$this->LACode->ViewCustomAttributes = "";

			// DepartmentCode
			$curVal = strval($this->DepartmentCode->CurrentValue);
			if ($curVal != "") {
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
					}
				}
			} else {
				$this->DepartmentCode->ViewValue = NULL;
			}
			$this->DepartmentCode->ViewCustomAttributes = "";

			// SectionCode
			$curVal = strval($this->SectionCode->CurrentValue);
			if ($curVal != "") {
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
				if ($this->SectionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SectionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SectionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SectionCode->ViewValue = $this->SectionCode->CurrentValue;
					}
				}
			} else {
				$this->SectionCode->ViewValue = NULL;
			}
			$this->SectionCode->ViewCustomAttributes = "";

			// OutcomeCode
			$curVal = strval($this->OutcomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
					}
				}
			} else {
				$this->OutcomeCode->ViewValue = NULL;
			}
			$this->OutcomeCode->ViewCustomAttributes = "";

			// ProgramCode
			$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
					}
				}
			} else {
				$this->ProgramCode->ViewValue = NULL;
			}
			$this->ProgramCode->ViewCustomAttributes = "";

			// SubProgramCode
			$curVal = strval($this->SubProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
				if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
					}
				}
			} else {
				$this->SubProgramCode->ViewValue = NULL;
			}
			$this->SubProgramCode->ViewCustomAttributes = "";

			// OutputCode
			$arwrk = [];
			$arwrk[1] = $this->OutputName->CurrentValue;
			$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
			$this->OutputCode->ViewCustomAttributes = "";

			// OutputType
			$curVal = strval($this->OutputType->CurrentValue);
			if ($curVal != "") {
				$this->OutputType->ViewValue = $this->OutputType->lookupCacheOption($curVal);
				if ($this->OutputType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->OutputType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputType->ViewValue = $this->OutputType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputType->ViewValue = $this->OutputType->CurrentValue;
					}
				}
			} else {
				$this->OutputType->ViewValue = NULL;
			}
			$this->OutputType->ViewCustomAttributes = "";

			// OutputName
			$this->OutputName->ViewValue = $this->OutputName->CurrentValue;
			$this->OutputName->ViewCustomAttributes = "";

			// DeliveryDate
			$this->DeliveryDate->ViewValue = $this->DeliveryDate->CurrentValue;
			$this->DeliveryDate->ViewValue = FormatDateTime($this->DeliveryDate->ViewValue, 0);
			$this->DeliveryDate->ViewCustomAttributes = "";

			// FinancialYear
			$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->ViewCustomAttributes = "";

			// OutputDescription
			$this->OutputDescription->ViewValue = $this->OutputDescription->CurrentValue;
			$this->OutputDescription->ViewCustomAttributes = "";

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->ViewValue = $this->OutputMeansOfVerification->CurrentValue;
			$this->OutputMeansOfVerification->ViewCustomAttributes = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->ViewValue = $this->ResponsibleOfficer->CurrentValue;
			$this->ResponsibleOfficer->ViewCustomAttributes = "";

			// Clients
			$this->Clients->ViewValue = $this->Clients->CurrentValue;
			$this->Clients->ViewCustomAttributes = "";

			// Beneficiaries
			$this->Beneficiaries->ViewValue = $this->Beneficiaries->CurrentValue;
			$this->Beneficiaries->ViewCustomAttributes = "";

			// OutputStatus
			$curVal = strval($this->OutputStatus->CurrentValue);
			if ($curVal != "") {
				$this->OutputStatus->ViewValue = $this->OutputStatus->lookupCacheOption($curVal);
				if ($this->OutputStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputStatus->ViewValue = $this->OutputStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputStatus->ViewValue = $this->OutputStatus->CurrentValue;
					}
				}
			} else {
				$this->OutputStatus->ViewValue = NULL;
			}
			$this->OutputStatus->ViewCustomAttributes = "";

			// LockStatus
			$curVal = strval($this->LockStatus->CurrentValue);
			if ($curVal != "") {
				$this->LockStatus->ViewValue = $this->LockStatus->lookupCacheOption($curVal);
				if ($this->LockStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->LockStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LockStatus->ViewValue = $this->LockStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LockStatus->ViewValue = $this->LockStatus->CurrentValue;
					}
				}
			} else {
				$this->LockStatus->ViewValue = NULL;
			}
			$this->LockStatus->ViewCustomAttributes = "";

			// TargetAmount
			$this->TargetAmount->ViewValue = $this->TargetAmount->CurrentValue;
			$this->TargetAmount->ViewValue = FormatNumber($this->TargetAmount->ViewValue, 2, -2, -2, -2);
			$this->TargetAmount->ViewCustomAttributes = "";

			// ActualAmount
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->ViewCustomAttributes = "";

			// PercentAchieved
			$this->PercentAchieved->ViewValue = $this->PercentAchieved->CurrentValue;
			$this->PercentAchieved->ViewValue = FormatNumber($this->PercentAchieved->ViewValue, 2, -2, -2, -2);
			$this->PercentAchieved->ViewCustomAttributes = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";
			if (!$this->isExport())
				$this->LACode->ViewValue = $this->highlightValue($this->LACode);

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";
			$this->OutputType->TooltipValue = "";

			// OutputName
			$this->OutputName->LinkCustomAttributes = "";
			$this->OutputName->HrefValue = "";
			$this->OutputName->TooltipValue = "";
			if (!$this->isExport())
				$this->OutputName->ViewValue = $this->highlightValue($this->OutputName);

			// DeliveryDate
			$this->DeliveryDate->LinkCustomAttributes = "";
			$this->DeliveryDate->HrefValue = "";
			$this->DeliveryDate->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";
			if (!$this->isExport())
				$this->FinancialYear->ViewValue = $this->highlightValue($this->FinancialYear);

			// OutputDescription
			$this->OutputDescription->LinkCustomAttributes = "";
			$this->OutputDescription->HrefValue = "";
			$this->OutputDescription->TooltipValue = "";
			if (!$this->isExport())
				$this->OutputDescription->ViewValue = $this->highlightValue($this->OutputDescription);

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->LinkCustomAttributes = "";
			$this->OutputMeansOfVerification->HrefValue = "";
			$this->OutputMeansOfVerification->TooltipValue = "";
			if (!$this->isExport())
				$this->OutputMeansOfVerification->ViewValue = $this->highlightValue($this->OutputMeansOfVerification);

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";
			$this->ResponsibleOfficer->TooltipValue = "";
			if (!$this->isExport())
				$this->ResponsibleOfficer->ViewValue = $this->highlightValue($this->ResponsibleOfficer);

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

			// OutputStatus
			$this->OutputStatus->LinkCustomAttributes = "";
			$this->OutputStatus->HrefValue = "";
			$this->OutputStatus->TooltipValue = "";

			// TargetAmount
			$this->TargetAmount->LinkCustomAttributes = "";
			$this->TargetAmount->HrefValue = "";
			$this->TargetAmount->TooltipValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";
			$this->ActualAmount->TooltipValue = "";

			// PercentAchieved
			$this->PercentAchieved->LinkCustomAttributes = "";
			$this->PercentAchieved->HrefValue = "";
			$this->PercentAchieved->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->OldValue = $this->LACode->CurrentValue;
				$this->LACode->ViewValue = $this->LACode->CurrentValue;
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->ViewValue = $this->LACode->CurrentValue;
						}
					}
				} else {
					$this->LACode->ViewValue = NULL;
				}
				$this->LACode->ViewCustomAttributes = "";
			} else {
				if (!$this->LACode->Raw)
					$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
				$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->EditValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->LACode->EditValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
						}
					}
				} else {
					$this->LACode->EditValue = NULL;
				}
				$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
			if ($this->DepartmentCode->getSessionValue() != "") {
				$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
				$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
				$curVal = strval($this->DepartmentCode->CurrentValue);
				if ($curVal != "") {
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
					if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
						}
					}
				} else {
					$this->DepartmentCode->ViewValue = NULL;
				}
				$this->DepartmentCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->DepartmentCode->CurrentValue));
				if ($curVal != "")
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				else
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
				if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
					$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
					if ($this->DepartmentCode->ViewValue == "")
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					} else {
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
				if ($this->SectionCode->ViewValue == "")
					$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
				} else {
					$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// OutcomeCode
			$this->OutcomeCode->EditCustomAttributes = "";
			if ($this->OutcomeCode->getSessionValue() != "") {
				$this->OutcomeCode->CurrentValue = $this->OutcomeCode->getSessionValue();
				$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
				$curVal = strval($this->OutcomeCode->CurrentValue);
				if ($curVal != "") {
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
					if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
						}
					}
				} else {
					$this->OutcomeCode->ViewValue = NULL;
				}
				$this->OutcomeCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->OutcomeCode->CurrentValue));
				if ($curVal != "")
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				else
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->Lookup !== NULL && is_array($this->OutcomeCode->Lookup->Options) ? $curVal : NULL;
				if ($this->OutcomeCode->ViewValue !== NULL) { // Load from cache
					$this->OutcomeCode->EditValue = array_values($this->OutcomeCode->Lookup->Options);
					if ($this->OutcomeCode->ViewValue == "")
						$this->OutcomeCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`OutcomeCode`" . SearchString("=", $this->OutcomeCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
					} else {
						$this->OutcomeCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->OutcomeCode->EditValue = $arwrk;
				}
			}

			// ProgramCode
			$this->ProgramCode->EditAttrs["class"] = "form-control";
			$this->ProgramCode->EditCustomAttributes = "";
			$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->EditValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgramCode->EditValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
					}
				}
			} else {
				$this->ProgramCode->EditValue = NULL;
			}
			$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());

			// SubProgramCode
			$this->SubProgramCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubProgramCode->CurrentValue));
			if ($curVal != "")
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
			else
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->Lookup !== NULL && is_array($this->SubProgramCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SubProgramCode->ViewValue !== NULL) { // Load from cache
				$this->SubProgramCode->EditValue = array_values($this->SubProgramCode->Lookup->Options);
				if ($this->SubProgramCode->ViewValue == "")
					$this->SubProgramCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SubProgramCode`" . SearchString("=", $this->SubProgramCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SubProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
				} else {
					$this->SubProgramCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubProgramCode->EditValue = $arwrk;
			}

			// OutputCode
			// OutputType

			$this->OutputType->EditAttrs["class"] = "form-control";
			$this->OutputType->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputType->CurrentValue));
			if ($curVal != "")
				$this->OutputType->ViewValue = $this->OutputType->lookupCacheOption($curVal);
			else
				$this->OutputType->ViewValue = $this->OutputType->Lookup !== NULL && is_array($this->OutputType->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputType->ViewValue !== NULL) { // Load from cache
				$this->OutputType->EditValue = array_values($this->OutputType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutputType`" . SearchString("=", $this->OutputType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->OutputType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputType->EditValue = $arwrk;
			}

			// OutputName
			$this->OutputName->EditAttrs["class"] = "form-control";
			$this->OutputName->EditCustomAttributes = "";
			$this->OutputName->EditValue = HtmlEncode($this->OutputName->CurrentValue);
			$this->OutputName->PlaceHolder = RemoveHtml($this->OutputName->caption());

			// DeliveryDate
			$this->DeliveryDate->EditAttrs["class"] = "form-control";
			$this->DeliveryDate->EditCustomAttributes = "";
			$this->DeliveryDate->EditValue = HtmlEncode(FormatDateTime($this->DeliveryDate->CurrentValue, 8));
			$this->DeliveryDate->PlaceHolder = RemoveHtml($this->DeliveryDate->caption());

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
			$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

			// OutputDescription
			$this->OutputDescription->EditAttrs["class"] = "form-control";
			$this->OutputDescription->EditCustomAttributes = "";
			$this->OutputDescription->EditValue = HtmlEncode($this->OutputDescription->CurrentValue);
			$this->OutputDescription->PlaceHolder = RemoveHtml($this->OutputDescription->caption());

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->EditAttrs["class"] = "form-control";
			$this->OutputMeansOfVerification->EditCustomAttributes = "";
			$this->OutputMeansOfVerification->EditValue = HtmlEncode($this->OutputMeansOfVerification->CurrentValue);
			$this->OutputMeansOfVerification->PlaceHolder = RemoveHtml($this->OutputMeansOfVerification->caption());

			// ResponsibleOfficer
			$this->ResponsibleOfficer->EditAttrs["class"] = "form-control";
			$this->ResponsibleOfficer->EditCustomAttributes = "";
			if (!$this->ResponsibleOfficer->Raw)
				$this->ResponsibleOfficer->CurrentValue = HtmlDecode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->EditValue = HtmlEncode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->PlaceHolder = RemoveHtml($this->ResponsibleOfficer->caption());

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

			// OutputStatus
			$this->OutputStatus->EditAttrs["class"] = "form-control";
			$this->OutputStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputStatus->CurrentValue));
			if ($curVal != "")
				$this->OutputStatus->ViewValue = $this->OutputStatus->lookupCacheOption($curVal);
			else
				$this->OutputStatus->ViewValue = $this->OutputStatus->Lookup !== NULL && is_array($this->OutputStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputStatus->ViewValue !== NULL) { // Load from cache
				$this->OutputStatus->EditValue = array_values($this->OutputStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProgressCode`" . SearchString("=", $this->OutputStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutputStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputStatus->EditValue = $arwrk;
			}

			// TargetAmount
			$this->TargetAmount->EditAttrs["class"] = "form-control";
			$this->TargetAmount->EditCustomAttributes = "";
			$this->TargetAmount->EditValue = HtmlEncode($this->TargetAmount->CurrentValue);
			$this->TargetAmount->PlaceHolder = RemoveHtml($this->TargetAmount->caption());
			if (strval($this->TargetAmount->EditValue) != "" && is_numeric($this->TargetAmount->EditValue)) {
				$this->TargetAmount->EditValue = FormatNumber($this->TargetAmount->EditValue, -2, -2, -2, -2);
				$this->TargetAmount->OldValue = $this->TargetAmount->EditValue;
			}
			

			// ActualAmount
			$this->ActualAmount->EditAttrs["class"] = "form-control";
			$this->ActualAmount->EditCustomAttributes = "";
			$this->ActualAmount->EditValue = HtmlEncode($this->ActualAmount->CurrentValue);
			$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
			if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue)) {
				$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
				$this->ActualAmount->OldValue = $this->ActualAmount->EditValue;
			}
			

			// PercentAchieved
			$this->PercentAchieved->EditAttrs["class"] = "form-control";
			$this->PercentAchieved->EditCustomAttributes = "";
			$this->PercentAchieved->EditValue = HtmlEncode($this->PercentAchieved->CurrentValue);
			$this->PercentAchieved->PlaceHolder = RemoveHtml($this->PercentAchieved->caption());
			if (strval($this->PercentAchieved->EditValue) != "" && is_numeric($this->PercentAchieved->EditValue)) {
				$this->PercentAchieved->EditValue = FormatNumber($this->PercentAchieved->EditValue, -2, -2, -2, -2);
				$this->PercentAchieved->OldValue = $this->PercentAchieved->EditValue;
			}
			

			// Add refer script
			// LACode

			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";

			// OutputName
			$this->OutputName->LinkCustomAttributes = "";
			$this->OutputName->HrefValue = "";

			// DeliveryDate
			$this->DeliveryDate->LinkCustomAttributes = "";
			$this->DeliveryDate->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// OutputDescription
			$this->OutputDescription->LinkCustomAttributes = "";
			$this->OutputDescription->HrefValue = "";

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->LinkCustomAttributes = "";
			$this->OutputMeansOfVerification->HrefValue = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";

			// OutputStatus
			$this->OutputStatus->LinkCustomAttributes = "";
			$this->OutputStatus->HrefValue = "";

			// TargetAmount
			$this->TargetAmount->LinkCustomAttributes = "";
			$this->TargetAmount->HrefValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";

			// PercentAchieved
			$this->PercentAchieved->LinkCustomAttributes = "";
			$this->PercentAchieved->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->OldValue = $this->LACode->CurrentValue;
				$this->LACode->ViewValue = $this->LACode->CurrentValue;
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->ViewValue = $this->LACode->CurrentValue;
						}
					}
				} else {
					$this->LACode->ViewValue = NULL;
				}
				$this->LACode->ViewCustomAttributes = "";
			} else {
				if (!$this->LACode->Raw)
					$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
				$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->EditValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->LACode->EditValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
						}
					}
				} else {
					$this->LACode->EditValue = NULL;
				}
				$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
			if ($this->DepartmentCode->getSessionValue() != "") {
				$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
				$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
				$curVal = strval($this->DepartmentCode->CurrentValue);
				if ($curVal != "") {
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
					if ($this->DepartmentCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`DepartmentCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DepartmentCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DepartmentCode->ViewValue = $this->DepartmentCode->CurrentValue;
						}
					}
				} else {
					$this->DepartmentCode->ViewValue = NULL;
				}
				$this->DepartmentCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->DepartmentCode->CurrentValue));
				if ($curVal != "")
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				else
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
				if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
					$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
					if ($this->DepartmentCode->ViewValue == "")
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					} else {
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
				if ($this->SectionCode->ViewValue == "")
					$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
				} else {
					$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// OutcomeCode
			$this->OutcomeCode->EditCustomAttributes = "";
			if ($this->OutcomeCode->getSessionValue() != "") {
				$this->OutcomeCode->CurrentValue = $this->OutcomeCode->getSessionValue();
				$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
				$curVal = strval($this->OutcomeCode->CurrentValue);
				if ($curVal != "") {
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
					if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
						}
					}
				} else {
					$this->OutcomeCode->ViewValue = NULL;
				}
				$this->OutcomeCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->OutcomeCode->CurrentValue));
				if ($curVal != "")
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				else
					$this->OutcomeCode->ViewValue = $this->OutcomeCode->Lookup !== NULL && is_array($this->OutcomeCode->Lookup->Options) ? $curVal : NULL;
				if ($this->OutcomeCode->ViewValue !== NULL) { // Load from cache
					$this->OutcomeCode->EditValue = array_values($this->OutcomeCode->Lookup->Options);
					if ($this->OutcomeCode->ViewValue == "")
						$this->OutcomeCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`OutcomeCode`" . SearchString("=", $this->OutcomeCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
					} else {
						$this->OutcomeCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->OutcomeCode->EditValue = $arwrk;
				}
			}

			// ProgramCode
			$this->ProgramCode->EditAttrs["class"] = "form-control";
			$this->ProgramCode->EditCustomAttributes = "";
			$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->EditValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgramCode->EditValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->EditValue = HtmlEncode($this->ProgramCode->CurrentValue);
					}
				}
			} else {
				$this->ProgramCode->EditValue = NULL;
			}
			$this->ProgramCode->PlaceHolder = RemoveHtml($this->ProgramCode->caption());

			// SubProgramCode
			$this->SubProgramCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubProgramCode->CurrentValue));
			if ($curVal != "")
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
			else
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->Lookup !== NULL && is_array($this->SubProgramCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SubProgramCode->ViewValue !== NULL) { // Load from cache
				$this->SubProgramCode->EditValue = array_values($this->SubProgramCode->Lookup->Options);
				if ($this->SubProgramCode->ViewValue == "")
					$this->SubProgramCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SubProgramCode`" . SearchString("=", $this->SubProgramCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SubProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
				} else {
					$this->SubProgramCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubProgramCode->EditValue = $arwrk;
			}

			// OutputCode
			$this->OutputCode->EditAttrs["class"] = "form-control";
			$this->OutputCode->EditCustomAttributes = "";
			$arwrk = [];
			$arwrk[1] = $this->OutputName->CurrentValue;
			$this->OutputCode->EditValue = $this->OutputCode->displayValue($arwrk);
			$this->OutputCode->ViewCustomAttributes = "";

			// OutputType
			$this->OutputType->EditAttrs["class"] = "form-control";
			$this->OutputType->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputType->CurrentValue));
			if ($curVal != "")
				$this->OutputType->ViewValue = $this->OutputType->lookupCacheOption($curVal);
			else
				$this->OutputType->ViewValue = $this->OutputType->Lookup !== NULL && is_array($this->OutputType->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputType->ViewValue !== NULL) { // Load from cache
				$this->OutputType->EditValue = array_values($this->OutputType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutputType`" . SearchString("=", $this->OutputType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->OutputType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputType->EditValue = $arwrk;
			}

			// OutputName
			$this->OutputName->EditAttrs["class"] = "form-control";
			$this->OutputName->EditCustomAttributes = "";
			$this->OutputName->EditValue = HtmlEncode($this->OutputName->CurrentValue);
			$this->OutputName->PlaceHolder = RemoveHtml($this->OutputName->caption());

			// DeliveryDate
			$this->DeliveryDate->EditAttrs["class"] = "form-control";
			$this->DeliveryDate->EditCustomAttributes = "";
			$this->DeliveryDate->EditValue = HtmlEncode(FormatDateTime($this->DeliveryDate->CurrentValue, 8));
			$this->DeliveryDate->PlaceHolder = RemoveHtml($this->DeliveryDate->caption());

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
			$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());

			// OutputDescription
			$this->OutputDescription->EditAttrs["class"] = "form-control";
			$this->OutputDescription->EditCustomAttributes = "";
			$this->OutputDescription->EditValue = HtmlEncode($this->OutputDescription->CurrentValue);
			$this->OutputDescription->PlaceHolder = RemoveHtml($this->OutputDescription->caption());

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->EditAttrs["class"] = "form-control";
			$this->OutputMeansOfVerification->EditCustomAttributes = "";
			$this->OutputMeansOfVerification->EditValue = HtmlEncode($this->OutputMeansOfVerification->CurrentValue);
			$this->OutputMeansOfVerification->PlaceHolder = RemoveHtml($this->OutputMeansOfVerification->caption());

			// ResponsibleOfficer
			$this->ResponsibleOfficer->EditAttrs["class"] = "form-control";
			$this->ResponsibleOfficer->EditCustomAttributes = "";
			if (!$this->ResponsibleOfficer->Raw)
				$this->ResponsibleOfficer->CurrentValue = HtmlDecode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->EditValue = HtmlEncode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->PlaceHolder = RemoveHtml($this->ResponsibleOfficer->caption());

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

			// OutputStatus
			$this->OutputStatus->EditAttrs["class"] = "form-control";
			$this->OutputStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputStatus->CurrentValue));
			if ($curVal != "")
				$this->OutputStatus->ViewValue = $this->OutputStatus->lookupCacheOption($curVal);
			else
				$this->OutputStatus->ViewValue = $this->OutputStatus->Lookup !== NULL && is_array($this->OutputStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputStatus->ViewValue !== NULL) { // Load from cache
				$this->OutputStatus->EditValue = array_values($this->OutputStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProgressCode`" . SearchString("=", $this->OutputStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutputStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputStatus->EditValue = $arwrk;
			}

			// TargetAmount
			$this->TargetAmount->EditAttrs["class"] = "form-control";
			$this->TargetAmount->EditCustomAttributes = "";
			$this->TargetAmount->EditValue = HtmlEncode($this->TargetAmount->CurrentValue);
			$this->TargetAmount->PlaceHolder = RemoveHtml($this->TargetAmount->caption());
			if (strval($this->TargetAmount->EditValue) != "" && is_numeric($this->TargetAmount->EditValue)) {
				$this->TargetAmount->EditValue = FormatNumber($this->TargetAmount->EditValue, -2, -2, -2, -2);
				$this->TargetAmount->OldValue = $this->TargetAmount->EditValue;
			}
			

			// ActualAmount
			$this->ActualAmount->EditAttrs["class"] = "form-control";
			$this->ActualAmount->EditCustomAttributes = "";
			$this->ActualAmount->EditValue = HtmlEncode($this->ActualAmount->CurrentValue);
			$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());
			if (strval($this->ActualAmount->EditValue) != "" && is_numeric($this->ActualAmount->EditValue)) {
				$this->ActualAmount->EditValue = FormatNumber($this->ActualAmount->EditValue, -2, -2, -2, -2);
				$this->ActualAmount->OldValue = $this->ActualAmount->EditValue;
			}
			

			// PercentAchieved
			$this->PercentAchieved->EditAttrs["class"] = "form-control";
			$this->PercentAchieved->EditCustomAttributes = "";
			$this->PercentAchieved->EditValue = HtmlEncode($this->PercentAchieved->CurrentValue);
			$this->PercentAchieved->PlaceHolder = RemoveHtml($this->PercentAchieved->caption());
			if (strval($this->PercentAchieved->EditValue) != "" && is_numeric($this->PercentAchieved->EditValue)) {
				$this->PercentAchieved->EditValue = FormatNumber($this->PercentAchieved->EditValue, -2, -2, -2, -2);
				$this->PercentAchieved->OldValue = $this->PercentAchieved->EditValue;
			}
			

			// Edit refer script
			// LACode

			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// OutputType
			$this->OutputType->LinkCustomAttributes = "";
			$this->OutputType->HrefValue = "";

			// OutputName
			$this->OutputName->LinkCustomAttributes = "";
			$this->OutputName->HrefValue = "";

			// DeliveryDate
			$this->DeliveryDate->LinkCustomAttributes = "";
			$this->DeliveryDate->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// OutputDescription
			$this->OutputDescription->LinkCustomAttributes = "";
			$this->OutputDescription->HrefValue = "";

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->LinkCustomAttributes = "";
			$this->OutputMeansOfVerification->HrefValue = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";

			// OutputStatus
			$this->OutputStatus->LinkCustomAttributes = "";
			$this->OutputStatus->HrefValue = "";

			// TargetAmount
			$this->TargetAmount->LinkCustomAttributes = "";
			$this->TargetAmount->HrefValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";

			// PercentAchieved
			$this->PercentAchieved->LinkCustomAttributes = "";
			$this->PercentAchieved->HrefValue = "";
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
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentCode->Required) {
			if (!$this->DepartmentCode->IsDetailKey && $this->DepartmentCode->FormValue != NULL && $this->DepartmentCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentCode->caption(), $this->DepartmentCode->RequiredErrorMessage));
			}
		}
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if ($this->OutcomeCode->Required) {
			if (!$this->OutcomeCode->IsDetailKey && $this->OutcomeCode->FormValue != NULL && $this->OutcomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeCode->caption(), $this->OutcomeCode->RequiredErrorMessage));
			}
		}
		if ($this->ProgramCode->Required) {
			if (!$this->ProgramCode->IsDetailKey && $this->ProgramCode->FormValue != NULL && $this->ProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgramCode->caption(), $this->ProgramCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ProgramCode->FormValue)) {
			AddMessage($FormError, $this->ProgramCode->errorMessage());
		}
		if ($this->SubProgramCode->Required) {
			if (!$this->SubProgramCode->IsDetailKey && $this->SubProgramCode->FormValue != NULL && $this->SubProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubProgramCode->caption(), $this->SubProgramCode->RequiredErrorMessage));
			}
		}
		if ($this->OutputCode->Required) {
			if (!$this->OutputCode->IsDetailKey && $this->OutputCode->FormValue != NULL && $this->OutputCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputCode->caption(), $this->OutputCode->RequiredErrorMessage));
			}
		}
		if ($this->OutputType->Required) {
			if (!$this->OutputType->IsDetailKey && $this->OutputType->FormValue != NULL && $this->OutputType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputType->caption(), $this->OutputType->RequiredErrorMessage));
			}
		}
		if ($this->OutputName->Required) {
			if (!$this->OutputName->IsDetailKey && $this->OutputName->FormValue != NULL && $this->OutputName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputName->caption(), $this->OutputName->RequiredErrorMessage));
			}
		}
		if ($this->DeliveryDate->Required) {
			if (!$this->DeliveryDate->IsDetailKey && $this->DeliveryDate->FormValue != NULL && $this->DeliveryDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeliveryDate->caption(), $this->DeliveryDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DeliveryDate->FormValue)) {
			AddMessage($FormError, $this->DeliveryDate->errorMessage());
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FinancialYear->FormValue)) {
			AddMessage($FormError, $this->FinancialYear->errorMessage());
		}
		if ($this->OutputDescription->Required) {
			if (!$this->OutputDescription->IsDetailKey && $this->OutputDescription->FormValue != NULL && $this->OutputDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputDescription->caption(), $this->OutputDescription->RequiredErrorMessage));
			}
		}
		if ($this->OutputMeansOfVerification->Required) {
			if (!$this->OutputMeansOfVerification->IsDetailKey && $this->OutputMeansOfVerification->FormValue != NULL && $this->OutputMeansOfVerification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputMeansOfVerification->caption(), $this->OutputMeansOfVerification->RequiredErrorMessage));
			}
		}
		if ($this->ResponsibleOfficer->Required) {
			if (!$this->ResponsibleOfficer->IsDetailKey && $this->ResponsibleOfficer->FormValue != NULL && $this->ResponsibleOfficer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ResponsibleOfficer->caption(), $this->ResponsibleOfficer->RequiredErrorMessage));
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
		if ($this->OutputStatus->Required) {
			if (!$this->OutputStatus->IsDetailKey && $this->OutputStatus->FormValue != NULL && $this->OutputStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputStatus->caption(), $this->OutputStatus->RequiredErrorMessage));
			}
		}
		if ($this->TargetAmount->Required) {
			if (!$this->TargetAmount->IsDetailKey && $this->TargetAmount->FormValue != NULL && $this->TargetAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TargetAmount->caption(), $this->TargetAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->TargetAmount->FormValue)) {
			AddMessage($FormError, $this->TargetAmount->errorMessage());
		}
		if ($this->ActualAmount->Required) {
			if (!$this->ActualAmount->IsDetailKey && $this->ActualAmount->FormValue != NULL && $this->ActualAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualAmount->caption(), $this->ActualAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ActualAmount->FormValue)) {
			AddMessage($FormError, $this->ActualAmount->errorMessage());
		}
		if ($this->PercentAchieved->Required) {
			if (!$this->PercentAchieved->IsDetailKey && $this->PercentAchieved->FormValue != NULL && $this->PercentAchieved->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PercentAchieved->caption(), $this->PercentAchieved->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->PercentAchieved->FormValue)) {
			AddMessage($FormError, $this->PercentAchieved->errorMessage());
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
				$thisKey .= $row['OutputCode'];
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

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, $this->SectionCode->ReadOnly);

			// OutcomeCode
			$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, $this->OutcomeCode->ReadOnly);

			// ProgramCode
			$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, NULL, $this->ProgramCode->ReadOnly);

			// SubProgramCode
			$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, NULL, $this->SubProgramCode->ReadOnly);

			// OutputType
			$this->OutputType->setDbValueDef($rsnew, $this->OutputType->CurrentValue, NULL, $this->OutputType->ReadOnly);

			// OutputName
			$this->OutputName->setDbValueDef($rsnew, $this->OutputName->CurrentValue, "", $this->OutputName->ReadOnly);

			// DeliveryDate
			$this->DeliveryDate->setDbValueDef($rsnew, UnFormatDateTime($this->DeliveryDate->CurrentValue, 0), NULL, $this->DeliveryDate->ReadOnly);

			// FinancialYear
			$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, NULL, $this->FinancialYear->ReadOnly);

			// OutputDescription
			$this->OutputDescription->setDbValueDef($rsnew, $this->OutputDescription->CurrentValue, NULL, $this->OutputDescription->ReadOnly);

			// OutputMeansOfVerification
			$this->OutputMeansOfVerification->setDbValueDef($rsnew, $this->OutputMeansOfVerification->CurrentValue, NULL, $this->OutputMeansOfVerification->ReadOnly);

			// ResponsibleOfficer
			$this->ResponsibleOfficer->setDbValueDef($rsnew, $this->ResponsibleOfficer->CurrentValue, NULL, $this->ResponsibleOfficer->ReadOnly);

			// Clients
			$this->Clients->setDbValueDef($rsnew, $this->Clients->CurrentValue, NULL, $this->Clients->ReadOnly);

			// Beneficiaries
			$this->Beneficiaries->setDbValueDef($rsnew, $this->Beneficiaries->CurrentValue, NULL, $this->Beneficiaries->ReadOnly);

			// OutputStatus
			$this->OutputStatus->setDbValueDef($rsnew, $this->OutputStatus->CurrentValue, NULL, $this->OutputStatus->ReadOnly);

			// TargetAmount
			$this->TargetAmount->setDbValueDef($rsnew, $this->TargetAmount->CurrentValue, NULL, $this->TargetAmount->ReadOnly);

			// ActualAmount
			$this->ActualAmount->setDbValueDef($rsnew, $this->ActualAmount->CurrentValue, NULL, $this->ActualAmount->ReadOnly);

			// PercentAchieved
			$this->PercentAchieved->setDbValueDef($rsnew, $this->PercentAchieved->CurrentValue, NULL, $this->PercentAchieved->ReadOnly);

			// Check referential integrity for master table 'outcome'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_outcome();
			$keyValue = isset($rsnew['OutcomeCode']) ? $rsnew['OutcomeCode'] : $rsold['OutcomeCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@OutcomeCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['LACode']) ? $rsnew['LACode'] : $rsold['LACode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@LACode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['DepartmentCode']) ? $rsnew['DepartmentCode'] : $rsold['DepartmentCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@DepartmentCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["outcome"]))
					$GLOBALS["outcome"] = new outcome();
				$rsmaster = $GLOBALS["outcome"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "outcome", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "outcome") {
				$this->OutcomeCode->CurrentValue = $this->OutcomeCode->getSessionValue();
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
			}

		// Check referential integrity for master table 'output'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_outcome();
		if (strval($this->OutcomeCode->CurrentValue) != "") {
			$masterFilter = str_replace("@OutcomeCode@", AdjustSql($this->OutcomeCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->LACode->CurrentValue) != "") {
			$masterFilter = str_replace("@LACode@", AdjustSql($this->LACode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->DepartmentCode->CurrentValue) != "") {
			$masterFilter = str_replace("@DepartmentCode@", AdjustSql($this->DepartmentCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["outcome"]))
				$GLOBALS["outcome"] = new outcome();
			$rsmaster = $GLOBALS["outcome"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "outcome", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// OutcomeCode
		$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, FALSE);

		// ProgramCode
		$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, NULL, FALSE);

		// SubProgramCode
		$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, NULL, FALSE);

		// OutputType
		$this->OutputType->setDbValueDef($rsnew, $this->OutputType->CurrentValue, NULL, FALSE);

		// OutputName
		$this->OutputName->setDbValueDef($rsnew, $this->OutputName->CurrentValue, "", FALSE);

		// DeliveryDate
		$this->DeliveryDate->setDbValueDef($rsnew, UnFormatDateTime($this->DeliveryDate->CurrentValue, 0), NULL, FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, NULL, FALSE);

		// OutputDescription
		$this->OutputDescription->setDbValueDef($rsnew, $this->OutputDescription->CurrentValue, NULL, FALSE);

		// OutputMeansOfVerification
		$this->OutputMeansOfVerification->setDbValueDef($rsnew, $this->OutputMeansOfVerification->CurrentValue, NULL, FALSE);

		// ResponsibleOfficer
		$this->ResponsibleOfficer->setDbValueDef($rsnew, $this->ResponsibleOfficer->CurrentValue, NULL, FALSE);

		// Clients
		$this->Clients->setDbValueDef($rsnew, $this->Clients->CurrentValue, NULL, FALSE);

		// Beneficiaries
		$this->Beneficiaries->setDbValueDef($rsnew, $this->Beneficiaries->CurrentValue, NULL, FALSE);

		// OutputStatus
		$this->OutputStatus->setDbValueDef($rsnew, $this->OutputStatus->CurrentValue, NULL, FALSE);

		// TargetAmount
		$this->TargetAmount->setDbValueDef($rsnew, $this->TargetAmount->CurrentValue, NULL, FALSE);

		// ActualAmount
		$this->ActualAmount->setDbValueDef($rsnew, $this->ActualAmount->CurrentValue, NULL, FALSE);

		// PercentAchieved
		$this->PercentAchieved->setDbValueDef($rsnew, $this->PercentAchieved->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "outcome") {
			$this->OutcomeCode->Visible = FALSE;
			if ($GLOBALS["outcome"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->LACode->Visible = FALSE;
			if ($GLOBALS["outcome"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->DepartmentCode->Visible = FALSE;
			if ($GLOBALS["outcome"]->EventCancelled)
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
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_OutcomeCode":
					break;
				case "x_ProgramCode":
					break;
				case "x_SubProgramCode":
					break;
				case "x_OutputCode":
					break;
				case "x_OutputType":
					break;
				case "x_OutputStatus":
					break;
				case "x_LockStatus":
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
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_OutcomeCode":
							break;
						case "x_ProgramCode":
							break;
						case "x_SubProgramCode":
							break;
						case "x_OutputCode":
							break;
						case "x_OutputType":
							break;
						case "x_OutputStatus":
							break;
						case "x_LockStatus":
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