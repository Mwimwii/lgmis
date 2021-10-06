<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class employment_grid extends employment
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'employment';

	// Page object name
	public $PageObjName = "employment_grid";

	// Grid form hidden field names
	public $FormName = "femploymentgrid";
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

		// Table object (employment)
		if (!isset($GLOBALS["employment"]) || get_class($GLOBALS["employment"]) == PROJECT_NAMESPACE . "employment") {
			$GLOBALS["employment"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["employment"];

		}
		$this->AddUrl = "employmentadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'employment');

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
		global $employment;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($employment);
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
			$key .= @$ar['SubstantivePosition'];
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
		$this->EmployeeID->Visible = FALSE;
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->SubstantivePosition->setVisibility();
		$this->DateOfCurrentAppointment->setVisibility();
		$this->LastAppraisalDate->setVisibility();
		$this->AppraisalStatus->setVisibility();
		$this->DateOfExit->setVisibility();
		$this->SalaryScale->Visible = FALSE;
		$this->EmploymentType->setVisibility();
		$this->EmploymentStatus->setVisibility();
		$this->ExitReason->Visible = FALSE;
		$this->RetirementType->Visible = FALSE;
		$this->EmployeeNumber->setVisibility();
		$this->SalaryNotch->setVisibility();
		$this->BasicMonthlySalary->setVisibility();
		$this->ThirdParties->setVisibility();
		$this->PayrollCode->setVisibility();
		$this->DateOfConfirmation->setVisibility();
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
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->SubstantivePosition);
		$this->setupLookupOptions($this->AppraisalStatus);
		$this->setupLookupOptions($this->SalaryScale);
		$this->setupLookupOptions($this->EmploymentType);
		$this->setupLookupOptions($this->EmploymentStatus);
		$this->setupLookupOptions($this->ExitReason);
		$this->setupLookupOptions($this->RetirementType);
		$this->setupLookupOptions($this->SalaryNotch);
		$this->setupLookupOptions($this->ThirdParties);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "position_ref") {
			global $position_ref;
			$rsmaster = $position_ref->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("position_reflist.php"); // Return to master page
			} else {
				$position_ref->loadListRowValues($rsmaster);
				$position_ref->RowType = ROWTYPE_MASTER; // Master row
				$position_ref->renderListRow();
				$rsmaster->close();
			}
		}

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
		$this->BasicMonthlySalary->FormValue = ""; // Clear form value
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
		if (count($arKeyFlds) >= 2) {
			$this->EmployeeID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->EmployeeID->OldValue))
				return FALSE;
			$this->SubstantivePosition->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->SubstantivePosition->OldValue))
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
					$key .= $this->SubstantivePosition->CurrentValue;

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
		if ($CurrentForm->hasValue("x_ProvinceCode") && $CurrentForm->hasValue("o_ProvinceCode") && $this->ProvinceCode->CurrentValue != $this->ProvinceCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LACode") && $CurrentForm->hasValue("o_LACode") && $this->LACode->CurrentValue != $this->LACode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepartmentCode") && $CurrentForm->hasValue("o_DepartmentCode") && $this->DepartmentCode->CurrentValue != $this->DepartmentCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SectionCode") && $CurrentForm->hasValue("o_SectionCode") && $this->SectionCode->CurrentValue != $this->SectionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SubstantivePosition") && $CurrentForm->hasValue("o_SubstantivePosition") && $this->SubstantivePosition->CurrentValue != $this->SubstantivePosition->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfCurrentAppointment") && $CurrentForm->hasValue("o_DateOfCurrentAppointment") && $this->DateOfCurrentAppointment->CurrentValue != $this->DateOfCurrentAppointment->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LastAppraisalDate") && $CurrentForm->hasValue("o_LastAppraisalDate") && $this->LastAppraisalDate->CurrentValue != $this->LastAppraisalDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AppraisalStatus") && $CurrentForm->hasValue("o_AppraisalStatus") && $this->AppraisalStatus->CurrentValue != $this->AppraisalStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfExit") && $CurrentForm->hasValue("o_DateOfExit") && $this->DateOfExit->CurrentValue != $this->DateOfExit->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EmploymentType") && $CurrentForm->hasValue("o_EmploymentType") && $this->EmploymentType->CurrentValue != $this->EmploymentType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EmploymentStatus") && $CurrentForm->hasValue("o_EmploymentStatus") && $this->EmploymentStatus->CurrentValue != $this->EmploymentStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EmployeeNumber") && $CurrentForm->hasValue("o_EmployeeNumber") && $this->EmployeeNumber->CurrentValue != $this->EmployeeNumber->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SalaryNotch") && $CurrentForm->hasValue("o_SalaryNotch") && $this->SalaryNotch->CurrentValue != $this->SalaryNotch->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BasicMonthlySalary") && $CurrentForm->hasValue("o_BasicMonthlySalary") && $this->BasicMonthlySalary->CurrentValue != $this->BasicMonthlySalary->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ThirdParties") && $CurrentForm->hasValue("o_ThirdParties") && $this->ThirdParties->CurrentValue != $this->ThirdParties->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PayrollCode") && $CurrentForm->hasValue("o_PayrollCode") && $this->PayrollCode->CurrentValue != $this->PayrollCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfConfirmation") && $CurrentForm->hasValue("o_DateOfConfirmation") && $this->DateOfConfirmation->CurrentValue != $this->DateOfConfirmation->OldValue)
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
				$this->SubstantivePosition->setSessionValue("");
				$this->SectionCode->setSessionValue("");
				$this->DepartmentCode->setSessionValue("");
				$this->LACode->setSessionValue("");
				$this->ProvinceCode->setSessionValue("");
				$this->SalaryScale->setSessionValue("");
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

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->SubstantivePosition->CurrentValue . "\">";
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
		$key .= $rs->fields('SubstantivePosition');
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

		// Column "detail_leave_record"
		if ($this->DetailPages && $this->DetailPages["leave_record"] && $this->DetailPages["leave_record"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_leave_record"];
			$url = "leave_recordpreview.php?t=employment&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"leave_record\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'employment')) {
				$label = $Language->TablePhrase("leave_record", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"leave_record\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("leave_recordlist.php?" . Config("TABLE_SHOW_MASTER") . "=employment&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("leave_record", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["leave_record_grid"]))
				$GLOBALS["leave_record_grid"] = new leave_record_grid();
			if ($GLOBALS["leave_record_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=leave_record");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["leave_record_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=leave_record");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_leave_taken"
		if ($this->DetailPages && $this->DetailPages["leave_taken"] && $this->DetailPages["leave_taken"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_leave_taken"];
			$url = "leave_takenpreview.php?t=employment&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"leave_taken\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'employment')) {
				$label = $Language->TablePhrase("leave_taken", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"leave_taken\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("leave_takenlist.php?" . Config("TABLE_SHOW_MASTER") . "=employment&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("leave_taken", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["leave_taken_grid"]))
				$GLOBALS["leave_taken_grid"] = new leave_taken_grid();
			if ($GLOBALS["leave_taken_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=leave_taken");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["leave_taken_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=leave_taken");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_employee_obligation"
		if ($this->DetailPages && $this->DetailPages["employee_obligation"] && $this->DetailPages["employee_obligation"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_employee_obligation"];
			$url = "employee_obligationpreview.php?t=employment&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"employee_obligation\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'employment')) {
				$label = $Language->TablePhrase("employee_obligation", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"employee_obligation\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("employee_obligationlist.php?" . Config("TABLE_SHOW_MASTER") . "=employment&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("employee_obligation", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["employee_obligation_grid"]))
				$GLOBALS["employee_obligation_grid"] = new employee_obligation_grid();
			if ($GLOBALS["employee_obligation_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=employee_obligation");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["employee_obligation_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=employee_obligation");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_employee_income"
		if ($this->DetailPages && $this->DetailPages["employee_income"] && $this->DetailPages["employee_income"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_employee_income"];
			$url = "employee_incomepreview.php?t=employment&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"employee_income\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'employment')) {
				$label = $Language->TablePhrase("employee_income", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"employee_income\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("employee_incomelist.php?" . Config("TABLE_SHOW_MASTER") . "=employment&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("employee_income", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["employee_income_grid"]))
				$GLOBALS["employee_income_grid"] = new employee_income_grid();
			if ($GLOBALS["employee_income_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=employee_income");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["employee_income_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'employment')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=employee_income");
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
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->SubstantivePosition->CurrentValue = NULL;
		$this->SubstantivePosition->OldValue = $this->SubstantivePosition->CurrentValue;
		$this->DateOfCurrentAppointment->CurrentValue = NULL;
		$this->DateOfCurrentAppointment->OldValue = $this->DateOfCurrentAppointment->CurrentValue;
		$this->LastAppraisalDate->CurrentValue = NULL;
		$this->LastAppraisalDate->OldValue = $this->LastAppraisalDate->CurrentValue;
		$this->AppraisalStatus->CurrentValue = NULL;
		$this->AppraisalStatus->OldValue = $this->AppraisalStatus->CurrentValue;
		$this->DateOfExit->CurrentValue = NULL;
		$this->DateOfExit->OldValue = $this->DateOfExit->CurrentValue;
		$this->SalaryScale->CurrentValue = NULL;
		$this->SalaryScale->OldValue = $this->SalaryScale->CurrentValue;
		$this->EmploymentType->CurrentValue = NULL;
		$this->EmploymentType->OldValue = $this->EmploymentType->CurrentValue;
		$this->EmploymentStatus->CurrentValue = NULL;
		$this->EmploymentStatus->OldValue = $this->EmploymentStatus->CurrentValue;
		$this->ExitReason->CurrentValue = NULL;
		$this->ExitReason->OldValue = $this->ExitReason->CurrentValue;
		$this->RetirementType->CurrentValue = NULL;
		$this->RetirementType->OldValue = $this->RetirementType->CurrentValue;
		$this->EmployeeNumber->CurrentValue = NULL;
		$this->EmployeeNumber->OldValue = $this->EmployeeNumber->CurrentValue;
		$this->SalaryNotch->CurrentValue = NULL;
		$this->SalaryNotch->OldValue = $this->SalaryNotch->CurrentValue;
		$this->BasicMonthlySalary->CurrentValue = NULL;
		$this->BasicMonthlySalary->OldValue = $this->BasicMonthlySalary->CurrentValue;
		$this->ThirdParties->CurrentValue = NULL;
		$this->ThirdParties->OldValue = $this->ThirdParties->CurrentValue;
		$this->PayrollCode->CurrentValue = NULL;
		$this->PayrollCode->OldValue = $this->PayrollCode->CurrentValue;
		$this->DateOfConfirmation->CurrentValue = NULL;
		$this->DateOfConfirmation->OldValue = $this->DateOfConfirmation->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

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

		// Check field name 'SubstantivePosition' first before field var 'x_SubstantivePosition'
		$val = $CurrentForm->hasValue("SubstantivePosition") ? $CurrentForm->getValue("SubstantivePosition") : $CurrentForm->getValue("x_SubstantivePosition");
		if (!$this->SubstantivePosition->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SubstantivePosition->Visible = FALSE; // Disable update for API request
			else
				$this->SubstantivePosition->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SubstantivePosition"))
			$this->SubstantivePosition->setOldValue($CurrentForm->getValue("o_SubstantivePosition"));

		// Check field name 'DateOfCurrentAppointment' first before field var 'x_DateOfCurrentAppointment'
		$val = $CurrentForm->hasValue("DateOfCurrentAppointment") ? $CurrentForm->getValue("DateOfCurrentAppointment") : $CurrentForm->getValue("x_DateOfCurrentAppointment");
		if (!$this->DateOfCurrentAppointment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfCurrentAppointment->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfCurrentAppointment->setFormValue($val);
			$this->DateOfCurrentAppointment->CurrentValue = UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfCurrentAppointment"))
			$this->DateOfCurrentAppointment->setOldValue($CurrentForm->getValue("o_DateOfCurrentAppointment"));

		// Check field name 'LastAppraisalDate' first before field var 'x_LastAppraisalDate'
		$val = $CurrentForm->hasValue("LastAppraisalDate") ? $CurrentForm->getValue("LastAppraisalDate") : $CurrentForm->getValue("x_LastAppraisalDate");
		if (!$this->LastAppraisalDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastAppraisalDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastAppraisalDate->setFormValue($val);
			$this->LastAppraisalDate->CurrentValue = UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_LastAppraisalDate"))
			$this->LastAppraisalDate->setOldValue($CurrentForm->getValue("o_LastAppraisalDate"));

		// Check field name 'AppraisalStatus' first before field var 'x_AppraisalStatus'
		$val = $CurrentForm->hasValue("AppraisalStatus") ? $CurrentForm->getValue("AppraisalStatus") : $CurrentForm->getValue("x_AppraisalStatus");
		if (!$this->AppraisalStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AppraisalStatus->Visible = FALSE; // Disable update for API request
			else
				$this->AppraisalStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AppraisalStatus"))
			$this->AppraisalStatus->setOldValue($CurrentForm->getValue("o_AppraisalStatus"));

		// Check field name 'DateOfExit' first before field var 'x_DateOfExit'
		$val = $CurrentForm->hasValue("DateOfExit") ? $CurrentForm->getValue("DateOfExit") : $CurrentForm->getValue("x_DateOfExit");
		if (!$this->DateOfExit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfExit->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfExit->setFormValue($val);
			$this->DateOfExit->CurrentValue = UnFormatDateTime($this->DateOfExit->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfExit"))
			$this->DateOfExit->setOldValue($CurrentForm->getValue("o_DateOfExit"));

		// Check field name 'EmploymentType' first before field var 'x_EmploymentType'
		$val = $CurrentForm->hasValue("EmploymentType") ? $CurrentForm->getValue("EmploymentType") : $CurrentForm->getValue("x_EmploymentType");
		if (!$this->EmploymentType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmploymentType->Visible = FALSE; // Disable update for API request
			else
				$this->EmploymentType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmploymentType"))
			$this->EmploymentType->setOldValue($CurrentForm->getValue("o_EmploymentType"));

		// Check field name 'EmploymentStatus' first before field var 'x_EmploymentStatus'
		$val = $CurrentForm->hasValue("EmploymentStatus") ? $CurrentForm->getValue("EmploymentStatus") : $CurrentForm->getValue("x_EmploymentStatus");
		if (!$this->EmploymentStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmploymentStatus->Visible = FALSE; // Disable update for API request
			else
				$this->EmploymentStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmploymentStatus"))
			$this->EmploymentStatus->setOldValue($CurrentForm->getValue("o_EmploymentStatus"));

		// Check field name 'EmployeeNumber' first before field var 'x_EmployeeNumber'
		$val = $CurrentForm->hasValue("EmployeeNumber") ? $CurrentForm->getValue("EmployeeNumber") : $CurrentForm->getValue("x_EmployeeNumber");
		if (!$this->EmployeeNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeNumber->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeNumber->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmployeeNumber"))
			$this->EmployeeNumber->setOldValue($CurrentForm->getValue("o_EmployeeNumber"));

		// Check field name 'SalaryNotch' first before field var 'x_SalaryNotch'
		$val = $CurrentForm->hasValue("SalaryNotch") ? $CurrentForm->getValue("SalaryNotch") : $CurrentForm->getValue("x_SalaryNotch");
		if (!$this->SalaryNotch->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SalaryNotch->Visible = FALSE; // Disable update for API request
			else
				$this->SalaryNotch->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SalaryNotch"))
			$this->SalaryNotch->setOldValue($CurrentForm->getValue("o_SalaryNotch"));

		// Check field name 'BasicMonthlySalary' first before field var 'x_BasicMonthlySalary'
		$val = $CurrentForm->hasValue("BasicMonthlySalary") ? $CurrentForm->getValue("BasicMonthlySalary") : $CurrentForm->getValue("x_BasicMonthlySalary");
		if (!$this->BasicMonthlySalary->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BasicMonthlySalary->Visible = FALSE; // Disable update for API request
			else
				$this->BasicMonthlySalary->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BasicMonthlySalary"))
			$this->BasicMonthlySalary->setOldValue($CurrentForm->getValue("o_BasicMonthlySalary"));

		// Check field name 'ThirdParties' first before field var 'x_ThirdParties'
		$val = $CurrentForm->hasValue("ThirdParties") ? $CurrentForm->getValue("ThirdParties") : $CurrentForm->getValue("x_ThirdParties");
		if (!$this->ThirdParties->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ThirdParties->Visible = FALSE; // Disable update for API request
			else
				$this->ThirdParties->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ThirdParties"))
			$this->ThirdParties->setOldValue($CurrentForm->getValue("o_ThirdParties"));

		// Check field name 'PayrollCode' first before field var 'x_PayrollCode'
		$val = $CurrentForm->hasValue("PayrollCode") ? $CurrentForm->getValue("PayrollCode") : $CurrentForm->getValue("x_PayrollCode");
		if (!$this->PayrollCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PayrollCode->Visible = FALSE; // Disable update for API request
			else
				$this->PayrollCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PayrollCode"))
			$this->PayrollCode->setOldValue($CurrentForm->getValue("o_PayrollCode"));

		// Check field name 'DateOfConfirmation' first before field var 'x_DateOfConfirmation'
		$val = $CurrentForm->hasValue("DateOfConfirmation") ? $CurrentForm->getValue("DateOfConfirmation") : $CurrentForm->getValue("x_DateOfConfirmation");
		if (!$this->DateOfConfirmation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfConfirmation->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfConfirmation->setFormValue($val);
			$this->DateOfConfirmation->CurrentValue = UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfConfirmation"))
			$this->DateOfConfirmation->setOldValue($CurrentForm->getValue("o_DateOfConfirmation"));

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
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->SubstantivePosition->CurrentValue = $this->SubstantivePosition->FormValue;
		$this->DateOfCurrentAppointment->CurrentValue = $this->DateOfCurrentAppointment->FormValue;
		$this->DateOfCurrentAppointment->CurrentValue = UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0);
		$this->LastAppraisalDate->CurrentValue = $this->LastAppraisalDate->FormValue;
		$this->LastAppraisalDate->CurrentValue = UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0);
		$this->AppraisalStatus->CurrentValue = $this->AppraisalStatus->FormValue;
		$this->DateOfExit->CurrentValue = $this->DateOfExit->FormValue;
		$this->DateOfExit->CurrentValue = UnFormatDateTime($this->DateOfExit->CurrentValue, 0);
		$this->EmploymentType->CurrentValue = $this->EmploymentType->FormValue;
		$this->EmploymentStatus->CurrentValue = $this->EmploymentStatus->FormValue;
		$this->EmployeeNumber->CurrentValue = $this->EmployeeNumber->FormValue;
		$this->SalaryNotch->CurrentValue = $this->SalaryNotch->FormValue;
		$this->BasicMonthlySalary->CurrentValue = $this->BasicMonthlySalary->FormValue;
		$this->ThirdParties->CurrentValue = $this->ThirdParties->FormValue;
		$this->PayrollCode->CurrentValue = $this->PayrollCode->FormValue;
		$this->DateOfConfirmation->CurrentValue = $this->DateOfConfirmation->FormValue;
		$this->DateOfConfirmation->CurrentValue = UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0);
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->SubstantivePosition->setDbValue($row['SubstantivePosition']);
		$this->DateOfCurrentAppointment->setDbValue($row['DateOfCurrentAppointment']);
		$this->LastAppraisalDate->setDbValue($row['LastAppraisalDate']);
		$this->AppraisalStatus->setDbValue($row['AppraisalStatus']);
		$this->DateOfExit->setDbValue($row['DateOfExit']);
		$this->SalaryScale->setDbValue($row['SalaryScale']);
		$this->EmploymentType->setDbValue($row['EmploymentType']);
		$this->EmploymentStatus->setDbValue($row['EmploymentStatus']);
		$this->ExitReason->setDbValue($row['ExitReason']);
		$this->RetirementType->setDbValue($row['RetirementType']);
		$this->EmployeeNumber->setDbValue($row['EmployeeNumber']);
		$this->SalaryNotch->setDbValue($row['SalaryNotch']);
		$this->BasicMonthlySalary->setDbValue($row['BasicMonthlySalary']);
		$this->ThirdParties->setDbValue($row['ThirdParties']);
		$this->PayrollCode->setDbValue($row['PayrollCode']);
		$this->DateOfConfirmation->setDbValue($row['DateOfConfirmation']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['SubstantivePosition'] = $this->SubstantivePosition->CurrentValue;
		$row['DateOfCurrentAppointment'] = $this->DateOfCurrentAppointment->CurrentValue;
		$row['LastAppraisalDate'] = $this->LastAppraisalDate->CurrentValue;
		$row['AppraisalStatus'] = $this->AppraisalStatus->CurrentValue;
		$row['DateOfExit'] = $this->DateOfExit->CurrentValue;
		$row['SalaryScale'] = $this->SalaryScale->CurrentValue;
		$row['EmploymentType'] = $this->EmploymentType->CurrentValue;
		$row['EmploymentStatus'] = $this->EmploymentStatus->CurrentValue;
		$row['ExitReason'] = $this->ExitReason->CurrentValue;
		$row['RetirementType'] = $this->RetirementType->CurrentValue;
		$row['EmployeeNumber'] = $this->EmployeeNumber->CurrentValue;
		$row['SalaryNotch'] = $this->SalaryNotch->CurrentValue;
		$row['BasicMonthlySalary'] = $this->BasicMonthlySalary->CurrentValue;
		$row['ThirdParties'] = $this->ThirdParties->CurrentValue;
		$row['PayrollCode'] = $this->PayrollCode->CurrentValue;
		$row['DateOfConfirmation'] = $this->DateOfConfirmation->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->RowOldKey);
		$cnt = count($keys);
		if ($cnt >= 2) {
			if (strval($keys[0]) != "")
				$this->EmployeeID->OldValue = strval($keys[0]); // EmployeeID
			else
				$validKey = FALSE;
			if (strval($keys[1]) != "")
				$this->SubstantivePosition->OldValue = strval($keys[1]); // SubstantivePosition
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
		if ($this->BasicMonthlySalary->FormValue == $this->BasicMonthlySalary->CurrentValue && is_numeric(ConvertToFloatString($this->BasicMonthlySalary->CurrentValue)))
			$this->BasicMonthlySalary->CurrentValue = ConvertToFloatString($this->BasicMonthlySalary->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// SubstantivePosition
		// DateOfCurrentAppointment
		// LastAppraisalDate
		// AppraisalStatus
		// DateOfExit
		// SalaryScale
		// EmploymentType
		// EmploymentStatus
		// ExitReason
		// RetirementType
		// EmployeeNumber
		// SalaryNotch
		// BasicMonthlySalary
		// ThirdParties
		// PayrollCode
		// DateOfConfirmation

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

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

			// LACode
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

			// SubstantivePosition
			$curVal = strval($this->SubstantivePosition->CurrentValue);
			if ($curVal != "") {
				$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
				if ($this->SubstantivePosition->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubstantivePosition->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->CurrentValue;
					}
				}
			} else {
				$this->SubstantivePosition->ViewValue = NULL;
			}
			$this->SubstantivePosition->ViewCustomAttributes = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->ViewValue = $this->DateOfCurrentAppointment->CurrentValue;
			$this->DateOfCurrentAppointment->ViewValue = FormatDateTime($this->DateOfCurrentAppointment->ViewValue, 0);
			$this->DateOfCurrentAppointment->ViewCustomAttributes = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->ViewValue = $this->LastAppraisalDate->CurrentValue;
			$this->LastAppraisalDate->ViewValue = FormatDateTime($this->LastAppraisalDate->ViewValue, 0);
			$this->LastAppraisalDate->ViewCustomAttributes = "";

			// AppraisalStatus
			$curVal = strval($this->AppraisalStatus->CurrentValue);
			if ($curVal != "") {
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->lookupCacheOption($curVal);
				if ($this->AppraisalStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AppraisalStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AppraisalStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->CurrentValue;
					}
				}
			} else {
				$this->AppraisalStatus->ViewValue = NULL;
			}
			$this->AppraisalStatus->ViewCustomAttributes = "";

			// DateOfExit
			$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
			$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
			$this->DateOfExit->ViewCustomAttributes = "";

			// SalaryScale
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$curVal = strval($this->SalaryScale->CurrentValue);
			if ($curVal != "") {
				$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
				if ($this->SalaryScale->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SalaryScale->ViewValue = $this->SalaryScale->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
					}
				}
			} else {
				$this->SalaryScale->ViewValue = NULL;
			}
			$this->SalaryScale->ViewCustomAttributes = "";

			// EmploymentType
			$curVal = strval($this->EmploymentType->CurrentValue);
			if ($curVal != "") {
				$this->EmploymentType->ViewValue = $this->EmploymentType->lookupCacheOption($curVal);
				if ($this->EmploymentType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`EmploymentType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmploymentType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EmploymentType->ViewValue = $this->EmploymentType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmploymentType->ViewValue = $this->EmploymentType->CurrentValue;
					}
				}
			} else {
				$this->EmploymentType->ViewValue = NULL;
			}
			$this->EmploymentType->ViewCustomAttributes = "";

			// EmploymentStatus
			$curVal = strval($this->EmploymentStatus->CurrentValue);
			if ($curVal != "") {
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->lookupCacheOption($curVal);
				if ($this->EmploymentStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`EmploymentStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmploymentStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->CurrentValue;
					}
				}
			} else {
				$this->EmploymentStatus->ViewValue = NULL;
			}
			$this->EmploymentStatus->ViewCustomAttributes = "";

			// ExitReason
			$curVal = strval($this->ExitReason->CurrentValue);
			if ($curVal != "") {
				$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
				if ($this->ExitReason->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ExitCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ExitReason->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ExitReason->ViewValue = $this->ExitReason->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ExitReason->ViewValue = $this->ExitReason->CurrentValue;
					}
				}
			} else {
				$this->ExitReason->ViewValue = NULL;
			}
			$this->ExitReason->ViewCustomAttributes = "";

			// RetirementType
			$curVal = strval($this->RetirementType->CurrentValue);
			if ($curVal != "") {
				$this->RetirementType->ViewValue = $this->RetirementType->lookupCacheOption($curVal);
				if ($this->RetirementType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`RetirementCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->RetirementType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RetirementType->ViewValue = $this->RetirementType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RetirementType->ViewValue = $this->RetirementType->CurrentValue;
					}
				}
			} else {
				$this->RetirementType->ViewValue = NULL;
			}
			$this->RetirementType->ViewCustomAttributes = "";

			// EmployeeNumber
			$this->EmployeeNumber->ViewValue = $this->EmployeeNumber->CurrentValue;
			$this->EmployeeNumber->ViewCustomAttributes = "";

			// SalaryNotch
			$curVal = strval($this->SalaryNotch->CurrentValue);
			if ($curVal != "") {
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->lookupCacheOption($curVal);
				if ($this->SalaryNotch->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Notch`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SalaryNotch->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2);
						$this->SalaryNotch->ViewValue = $this->SalaryNotch->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SalaryNotch->ViewValue = $this->SalaryNotch->CurrentValue;
					}
				}
			} else {
				$this->SalaryNotch->ViewValue = NULL;
			}
			$this->SalaryNotch->ViewCustomAttributes = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->ViewValue = $this->BasicMonthlySalary->CurrentValue;
			$this->BasicMonthlySalary->ViewValue = FormatNumber($this->BasicMonthlySalary->ViewValue, 2, -2, -2, -2);
			$this->BasicMonthlySalary->ViewCustomAttributes = "";

			// ThirdParties
			$curVal = strval($this->ThirdParties->CurrentValue);
			if ($curVal != "") {
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
				if ($this->ThirdParties->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ThirdParties->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->ThirdParties->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->ThirdParties->ViewValue = $this->ThirdParties->CurrentValue;
					}
				}
			} else {
				$this->ThirdParties->ViewValue = NULL;
			}
			$this->ThirdParties->ViewCustomAttributes = "";

			// PayrollCode
			$this->PayrollCode->ViewValue = $this->PayrollCode->CurrentValue;
			$this->PayrollCode->ViewValue = FormatNumber($this->PayrollCode->ViewValue, 0, -2, -2, -2);
			$this->PayrollCode->ViewCustomAttributes = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->ViewValue = $this->DateOfConfirmation->CurrentValue;
			$this->DateOfConfirmation->ViewValue = FormatDateTime($this->DateOfConfirmation->ViewValue, 0);
			$this->DateOfConfirmation->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->LinkCustomAttributes = "";
			$this->SubstantivePosition->HrefValue = "";
			$this->SubstantivePosition->TooltipValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
			$this->DateOfCurrentAppointment->HrefValue = "";
			$this->DateOfCurrentAppointment->TooltipValue = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->LinkCustomAttributes = "";
			$this->LastAppraisalDate->HrefValue = "";
			$this->LastAppraisalDate->TooltipValue = "";

			// AppraisalStatus
			$this->AppraisalStatus->LinkCustomAttributes = "";
			$this->AppraisalStatus->HrefValue = "";
			$this->AppraisalStatus->TooltipValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";
			$this->DateOfExit->TooltipValue = "";

			// EmploymentType
			$this->EmploymentType->LinkCustomAttributes = "";
			$this->EmploymentType->HrefValue = "";
			$this->EmploymentType->TooltipValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";
			$this->EmploymentStatus->TooltipValue = "";

			// EmployeeNumber
			$this->EmployeeNumber->LinkCustomAttributes = "";
			$this->EmployeeNumber->HrefValue = "";
			$this->EmployeeNumber->TooltipValue = "";
			if (!$this->isExport())
				$this->EmployeeNumber->ViewValue = $this->highlightValue($this->EmployeeNumber);

			// SalaryNotch
			$this->SalaryNotch->LinkCustomAttributes = "";
			$this->SalaryNotch->HrefValue = "";
			$this->SalaryNotch->TooltipValue = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->LinkCustomAttributes = "";
			$this->BasicMonthlySalary->HrefValue = "";
			$this->BasicMonthlySalary->TooltipValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
			$this->ThirdParties->TooltipValue = "";

			// PayrollCode
			$this->PayrollCode->LinkCustomAttributes = "";
			$this->PayrollCode->HrefValue = "";
			$this->PayrollCode->TooltipValue = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->LinkCustomAttributes = "";
			$this->DateOfConfirmation->HrefValue = "";
			$this->DateOfConfirmation->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// LACode
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->OldValue = $this->LACode->CurrentValue;
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
				$curVal = trim(strval($this->LACode->CurrentValue));
				if ($curVal != "")
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				else
					$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
				if ($this->LACode->ViewValue !== NULL) { // Load from cache
					$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
					if ($this->LACode->ViewValue == "")
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
					} else {
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
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
			if ($this->SectionCode->getSessionValue() != "") {
				$this->SectionCode->CurrentValue = $this->SectionCode->getSessionValue();
				$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
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
			} else {
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
			}

			// SubstantivePosition
			$this->SubstantivePosition->EditCustomAttributes = "";
			if ($this->SubstantivePosition->getSessionValue() != "") {
				$this->SubstantivePosition->CurrentValue = $this->SubstantivePosition->getSessionValue();
				$this->SubstantivePosition->OldValue = $this->SubstantivePosition->CurrentValue;
				$curVal = strval($this->SubstantivePosition->CurrentValue);
				if ($curVal != "") {
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
					if ($this->SubstantivePosition->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->SubstantivePosition->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->CurrentValue;
						}
					}
				} else {
					$this->SubstantivePosition->ViewValue = NULL;
				}
				$this->SubstantivePosition->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->SubstantivePosition->CurrentValue));
				if ($curVal != "")
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
				else
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->Lookup !== NULL && is_array($this->SubstantivePosition->Lookup->Options) ? $curVal : NULL;
				if ($this->SubstantivePosition->ViewValue !== NULL) { // Load from cache
					$this->SubstantivePosition->EditValue = array_values($this->SubstantivePosition->Lookup->Options);
					if ($this->SubstantivePosition->ViewValue == "")
						$this->SubstantivePosition->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`PositionCode`" . SearchString("=", $this->SubstantivePosition->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->SubstantivePosition->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
					} else {
						$this->SubstantivePosition->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->SubstantivePosition->EditValue = $arwrk;
				}
			}

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->EditAttrs["class"] = "form-control";
			$this->DateOfCurrentAppointment->EditCustomAttributes = "";
			$this->DateOfCurrentAppointment->EditValue = HtmlEncode(FormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 8));
			$this->DateOfCurrentAppointment->PlaceHolder = RemoveHtml($this->DateOfCurrentAppointment->caption());

			// LastAppraisalDate
			$this->LastAppraisalDate->EditAttrs["class"] = "form-control";
			$this->LastAppraisalDate->EditCustomAttributes = "";
			$this->LastAppraisalDate->EditValue = HtmlEncode(FormatDateTime($this->LastAppraisalDate->CurrentValue, 8));
			$this->LastAppraisalDate->PlaceHolder = RemoveHtml($this->LastAppraisalDate->caption());

			// AppraisalStatus
			$this->AppraisalStatus->EditAttrs["class"] = "form-control";
			$this->AppraisalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AppraisalStatus->CurrentValue));
			if ($curVal != "")
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->lookupCacheOption($curVal);
			else
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->Lookup !== NULL && is_array($this->AppraisalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AppraisalStatus->ViewValue !== NULL) { // Load from cache
				$this->AppraisalStatus->EditValue = array_values($this->AppraisalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AppraisalStatus`" . SearchString("=", $this->AppraisalStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AppraisalStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AppraisalStatus->EditValue = $arwrk;
			}

			// DateOfExit
			$this->DateOfExit->EditAttrs["class"] = "form-control";
			$this->DateOfExit->EditCustomAttributes = "";
			$this->DateOfExit->EditValue = HtmlEncode(FormatDateTime($this->DateOfExit->CurrentValue, 8));
			$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

			// EmploymentType
			$this->EmploymentType->EditAttrs["class"] = "form-control";
			$this->EmploymentType->EditCustomAttributes = "";
			$curVal = trim(strval($this->EmploymentType->CurrentValue));
			if ($curVal != "")
				$this->EmploymentType->ViewValue = $this->EmploymentType->lookupCacheOption($curVal);
			else
				$this->EmploymentType->ViewValue = $this->EmploymentType->Lookup !== NULL && is_array($this->EmploymentType->Lookup->Options) ? $curVal : NULL;
			if ($this->EmploymentType->ViewValue !== NULL) { // Load from cache
				$this->EmploymentType->EditValue = array_values($this->EmploymentType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`EmploymentType`" . SearchString("=", $this->EmploymentType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EmploymentType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EmploymentType->EditValue = $arwrk;
			}

			// EmploymentStatus
			$this->EmploymentStatus->EditAttrs["class"] = "form-control";
			$this->EmploymentStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->EmploymentStatus->CurrentValue));
			if ($curVal != "")
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->lookupCacheOption($curVal);
			else
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->Lookup !== NULL && is_array($this->EmploymentStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->EmploymentStatus->ViewValue !== NULL) { // Load from cache
				$this->EmploymentStatus->EditValue = array_values($this->EmploymentStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`EmploymentStatus`" . SearchString("=", $this->EmploymentStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EmploymentStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EmploymentStatus->EditValue = $arwrk;
			}

			// EmployeeNumber
			$this->EmployeeNumber->EditAttrs["class"] = "form-control";
			$this->EmployeeNumber->EditCustomAttributes = "";
			if (!$this->EmployeeNumber->Raw)
				$this->EmployeeNumber->CurrentValue = HtmlDecode($this->EmployeeNumber->CurrentValue);
			$this->EmployeeNumber->EditValue = HtmlEncode($this->EmployeeNumber->CurrentValue);
			$this->EmployeeNumber->PlaceHolder = RemoveHtml($this->EmployeeNumber->caption());

			// SalaryNotch
			$this->SalaryNotch->EditCustomAttributes = "";
			$curVal = trim(strval($this->SalaryNotch->CurrentValue));
			if ($curVal != "")
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->lookupCacheOption($curVal);
			else
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->Lookup !== NULL && is_array($this->SalaryNotch->Lookup->Options) ? $curVal : NULL;
			if ($this->SalaryNotch->ViewValue !== NULL) { // Load from cache
				$this->SalaryNotch->EditValue = array_values($this->SalaryNotch->Lookup->Options);
				if ($this->SalaryNotch->ViewValue == "")
					$this->SalaryNotch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Notch`" . SearchString("=", $this->SalaryNotch->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SalaryNotch->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
					$arwrk[2] = HtmlEncode(FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2));
					$this->SalaryNotch->ViewValue = $this->SalaryNotch->displayValue($arwrk);
				} else {
					$this->SalaryNotch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatNumber($arwrk[$i][1], 0, -2, -2, -2);
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 2, -2, -2, -2);
				}
				$this->SalaryNotch->EditValue = $arwrk;
			}

			// BasicMonthlySalary
			$this->BasicMonthlySalary->EditAttrs["class"] = "form-control";
			$this->BasicMonthlySalary->EditCustomAttributes = "";
			$this->BasicMonthlySalary->EditValue = HtmlEncode($this->BasicMonthlySalary->CurrentValue);
			$this->BasicMonthlySalary->PlaceHolder = RemoveHtml($this->BasicMonthlySalary->caption());
			if (strval($this->BasicMonthlySalary->EditValue) != "" && is_numeric($this->BasicMonthlySalary->EditValue)) {
				$this->BasicMonthlySalary->EditValue = FormatNumber($this->BasicMonthlySalary->EditValue, -2, -2, -2, -2);
				$this->BasicMonthlySalary->OldValue = $this->BasicMonthlySalary->EditValue;
			}
			

			// ThirdParties
			$this->ThirdParties->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdParties->CurrentValue));
			if ($curVal != "")
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
			else
				$this->ThirdParties->ViewValue = $this->ThirdParties->Lookup !== NULL && is_array($this->ThirdParties->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdParties->ViewValue !== NULL) { // Load from cache
				$this->ThirdParties->EditValue = array_values($this->ThirdParties->Lookup->Options);
				if ($this->ThirdParties->ViewValue == "")
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ThirdParties->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ThirdParties->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdParties->EditValue = $arwrk;
			}

			// PayrollCode
			$this->PayrollCode->EditAttrs["class"] = "form-control";
			$this->PayrollCode->EditCustomAttributes = "";
			$this->PayrollCode->EditValue = HtmlEncode($this->PayrollCode->CurrentValue);
			$this->PayrollCode->PlaceHolder = RemoveHtml($this->PayrollCode->caption());

			// DateOfConfirmation
			$this->DateOfConfirmation->EditAttrs["class"] = "form-control";
			$this->DateOfConfirmation->EditCustomAttributes = "";
			$this->DateOfConfirmation->EditValue = HtmlEncode(FormatDateTime($this->DateOfConfirmation->CurrentValue, 8));
			$this->DateOfConfirmation->PlaceHolder = RemoveHtml($this->DateOfConfirmation->caption());

			// Add refer script
			// ProvinceCode

			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->LinkCustomAttributes = "";
			$this->SubstantivePosition->HrefValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
			$this->DateOfCurrentAppointment->HrefValue = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->LinkCustomAttributes = "";
			$this->LastAppraisalDate->HrefValue = "";

			// AppraisalStatus
			$this->AppraisalStatus->LinkCustomAttributes = "";
			$this->AppraisalStatus->HrefValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";

			// EmploymentType
			$this->EmploymentType->LinkCustomAttributes = "";
			$this->EmploymentType->HrefValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";

			// EmployeeNumber
			$this->EmployeeNumber->LinkCustomAttributes = "";
			$this->EmployeeNumber->HrefValue = "";

			// SalaryNotch
			$this->SalaryNotch->LinkCustomAttributes = "";
			$this->SalaryNotch->HrefValue = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->LinkCustomAttributes = "";
			$this->BasicMonthlySalary->HrefValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";

			// PayrollCode
			$this->PayrollCode->LinkCustomAttributes = "";
			$this->PayrollCode->HrefValue = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->LinkCustomAttributes = "";
			$this->DateOfConfirmation->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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

			// LACode
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->OldValue = $this->LACode->CurrentValue;
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
				$curVal = trim(strval($this->LACode->CurrentValue));
				if ($curVal != "")
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				else
					$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
				if ($this->LACode->ViewValue !== NULL) { // Load from cache
					$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
					if ($this->LACode->ViewValue == "")
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
					} else {
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
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
			if ($this->SectionCode->getSessionValue() != "") {
				$this->SectionCode->CurrentValue = $this->SectionCode->getSessionValue();
				$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
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
			} else {
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
			}

			// SubstantivePosition
			$this->SubstantivePosition->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubstantivePosition->CurrentValue));
			if ($curVal != "")
				$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
			else
				$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->Lookup !== NULL && is_array($this->SubstantivePosition->Lookup->Options) ? $curVal : NULL;
			if ($this->SubstantivePosition->ViewValue !== NULL) { // Load from cache
				$this->SubstantivePosition->EditValue = array_values($this->SubstantivePosition->Lookup->Options);
				if ($this->SubstantivePosition->ViewValue == "")
					$this->SubstantivePosition->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PositionCode`" . SearchString("=", $this->SubstantivePosition->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SubstantivePosition->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
				} else {
					$this->SubstantivePosition->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubstantivePosition->EditValue = $arwrk;
			}

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->EditAttrs["class"] = "form-control";
			$this->DateOfCurrentAppointment->EditCustomAttributes = "";
			$this->DateOfCurrentAppointment->EditValue = HtmlEncode(FormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 8));
			$this->DateOfCurrentAppointment->PlaceHolder = RemoveHtml($this->DateOfCurrentAppointment->caption());

			// LastAppraisalDate
			$this->LastAppraisalDate->EditAttrs["class"] = "form-control";
			$this->LastAppraisalDate->EditCustomAttributes = "";
			$this->LastAppraisalDate->EditValue = HtmlEncode(FormatDateTime($this->LastAppraisalDate->CurrentValue, 8));
			$this->LastAppraisalDate->PlaceHolder = RemoveHtml($this->LastAppraisalDate->caption());

			// AppraisalStatus
			$this->AppraisalStatus->EditAttrs["class"] = "form-control";
			$this->AppraisalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AppraisalStatus->CurrentValue));
			if ($curVal != "")
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->lookupCacheOption($curVal);
			else
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->Lookup !== NULL && is_array($this->AppraisalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AppraisalStatus->ViewValue !== NULL) { // Load from cache
				$this->AppraisalStatus->EditValue = array_values($this->AppraisalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AppraisalStatus`" . SearchString("=", $this->AppraisalStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AppraisalStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AppraisalStatus->EditValue = $arwrk;
			}

			// DateOfExit
			$this->DateOfExit->EditAttrs["class"] = "form-control";
			$this->DateOfExit->EditCustomAttributes = "";
			$this->DateOfExit->EditValue = HtmlEncode(FormatDateTime($this->DateOfExit->CurrentValue, 8));
			$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

			// EmploymentType
			$this->EmploymentType->EditAttrs["class"] = "form-control";
			$this->EmploymentType->EditCustomAttributes = "";
			$curVal = trim(strval($this->EmploymentType->CurrentValue));
			if ($curVal != "")
				$this->EmploymentType->ViewValue = $this->EmploymentType->lookupCacheOption($curVal);
			else
				$this->EmploymentType->ViewValue = $this->EmploymentType->Lookup !== NULL && is_array($this->EmploymentType->Lookup->Options) ? $curVal : NULL;
			if ($this->EmploymentType->ViewValue !== NULL) { // Load from cache
				$this->EmploymentType->EditValue = array_values($this->EmploymentType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`EmploymentType`" . SearchString("=", $this->EmploymentType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EmploymentType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EmploymentType->EditValue = $arwrk;
			}

			// EmploymentStatus
			$this->EmploymentStatus->EditAttrs["class"] = "form-control";
			$this->EmploymentStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->EmploymentStatus->CurrentValue));
			if ($curVal != "")
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->lookupCacheOption($curVal);
			else
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->Lookup !== NULL && is_array($this->EmploymentStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->EmploymentStatus->ViewValue !== NULL) { // Load from cache
				$this->EmploymentStatus->EditValue = array_values($this->EmploymentStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`EmploymentStatus`" . SearchString("=", $this->EmploymentStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EmploymentStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EmploymentStatus->EditValue = $arwrk;
			}

			// EmployeeNumber
			$this->EmployeeNumber->EditAttrs["class"] = "form-control";
			$this->EmployeeNumber->EditCustomAttributes = "";
			if (!$this->EmployeeNumber->Raw)
				$this->EmployeeNumber->CurrentValue = HtmlDecode($this->EmployeeNumber->CurrentValue);
			$this->EmployeeNumber->EditValue = HtmlEncode($this->EmployeeNumber->CurrentValue);
			$this->EmployeeNumber->PlaceHolder = RemoveHtml($this->EmployeeNumber->caption());

			// SalaryNotch
			$this->SalaryNotch->EditCustomAttributes = "";
			$curVal = trim(strval($this->SalaryNotch->CurrentValue));
			if ($curVal != "")
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->lookupCacheOption($curVal);
			else
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->Lookup !== NULL && is_array($this->SalaryNotch->Lookup->Options) ? $curVal : NULL;
			if ($this->SalaryNotch->ViewValue !== NULL) { // Load from cache
				$this->SalaryNotch->EditValue = array_values($this->SalaryNotch->Lookup->Options);
				if ($this->SalaryNotch->ViewValue == "")
					$this->SalaryNotch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Notch`" . SearchString("=", $this->SalaryNotch->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SalaryNotch->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
					$arwrk[2] = HtmlEncode(FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2));
					$this->SalaryNotch->ViewValue = $this->SalaryNotch->displayValue($arwrk);
				} else {
					$this->SalaryNotch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatNumber($arwrk[$i][1], 0, -2, -2, -2);
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 2, -2, -2, -2);
				}
				$this->SalaryNotch->EditValue = $arwrk;
			}

			// BasicMonthlySalary
			$this->BasicMonthlySalary->EditAttrs["class"] = "form-control";
			$this->BasicMonthlySalary->EditCustomAttributes = "";
			$this->BasicMonthlySalary->EditValue = HtmlEncode($this->BasicMonthlySalary->CurrentValue);
			$this->BasicMonthlySalary->PlaceHolder = RemoveHtml($this->BasicMonthlySalary->caption());
			if (strval($this->BasicMonthlySalary->EditValue) != "" && is_numeric($this->BasicMonthlySalary->EditValue)) {
				$this->BasicMonthlySalary->EditValue = FormatNumber($this->BasicMonthlySalary->EditValue, -2, -2, -2, -2);
				$this->BasicMonthlySalary->OldValue = $this->BasicMonthlySalary->EditValue;
			}
			

			// ThirdParties
			$this->ThirdParties->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdParties->CurrentValue));
			if ($curVal != "")
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
			else
				$this->ThirdParties->ViewValue = $this->ThirdParties->Lookup !== NULL && is_array($this->ThirdParties->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdParties->ViewValue !== NULL) { // Load from cache
				$this->ThirdParties->EditValue = array_values($this->ThirdParties->Lookup->Options);
				if ($this->ThirdParties->ViewValue == "")
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ThirdParties->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ThirdParties->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdParties->EditValue = $arwrk;
			}

			// PayrollCode
			$this->PayrollCode->EditAttrs["class"] = "form-control";
			$this->PayrollCode->EditCustomAttributes = "";
			$this->PayrollCode->EditValue = HtmlEncode($this->PayrollCode->CurrentValue);
			$this->PayrollCode->PlaceHolder = RemoveHtml($this->PayrollCode->caption());

			// DateOfConfirmation
			$this->DateOfConfirmation->EditAttrs["class"] = "form-control";
			$this->DateOfConfirmation->EditCustomAttributes = "";
			$this->DateOfConfirmation->EditValue = HtmlEncode(FormatDateTime($this->DateOfConfirmation->CurrentValue, 8));
			$this->DateOfConfirmation->PlaceHolder = RemoveHtml($this->DateOfConfirmation->caption());

			// Edit refer script
			// ProvinceCode

			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->LinkCustomAttributes = "";
			$this->SubstantivePosition->HrefValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
			$this->DateOfCurrentAppointment->HrefValue = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->LinkCustomAttributes = "";
			$this->LastAppraisalDate->HrefValue = "";

			// AppraisalStatus
			$this->AppraisalStatus->LinkCustomAttributes = "";
			$this->AppraisalStatus->HrefValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";

			// EmploymentType
			$this->EmploymentType->LinkCustomAttributes = "";
			$this->EmploymentType->HrefValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";

			// EmployeeNumber
			$this->EmployeeNumber->LinkCustomAttributes = "";
			$this->EmployeeNumber->HrefValue = "";

			// SalaryNotch
			$this->SalaryNotch->LinkCustomAttributes = "";
			$this->SalaryNotch->HrefValue = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->LinkCustomAttributes = "";
			$this->BasicMonthlySalary->HrefValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";

			// PayrollCode
			$this->PayrollCode->LinkCustomAttributes = "";
			$this->PayrollCode->HrefValue = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->LinkCustomAttributes = "";
			$this->DateOfConfirmation->HrefValue = "";
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
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
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
		if ($this->SubstantivePosition->Required) {
			if (!$this->SubstantivePosition->IsDetailKey && $this->SubstantivePosition->FormValue != NULL && $this->SubstantivePosition->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubstantivePosition->caption(), $this->SubstantivePosition->RequiredErrorMessage));
			}
		}
		if ($this->DateOfCurrentAppointment->Required) {
			if (!$this->DateOfCurrentAppointment->IsDetailKey && $this->DateOfCurrentAppointment->FormValue != NULL && $this->DateOfCurrentAppointment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfCurrentAppointment->caption(), $this->DateOfCurrentAppointment->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfCurrentAppointment->FormValue)) {
			AddMessage($FormError, $this->DateOfCurrentAppointment->errorMessage());
		}
		if ($this->LastAppraisalDate->Required) {
			if (!$this->LastAppraisalDate->IsDetailKey && $this->LastAppraisalDate->FormValue != NULL && $this->LastAppraisalDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastAppraisalDate->caption(), $this->LastAppraisalDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastAppraisalDate->FormValue)) {
			AddMessage($FormError, $this->LastAppraisalDate->errorMessage());
		}
		if ($this->AppraisalStatus->Required) {
			if (!$this->AppraisalStatus->IsDetailKey && $this->AppraisalStatus->FormValue != NULL && $this->AppraisalStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AppraisalStatus->caption(), $this->AppraisalStatus->RequiredErrorMessage));
			}
		}
		if ($this->DateOfExit->Required) {
			if (!$this->DateOfExit->IsDetailKey && $this->DateOfExit->FormValue != NULL && $this->DateOfExit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfExit->caption(), $this->DateOfExit->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfExit->FormValue)) {
			AddMessage($FormError, $this->DateOfExit->errorMessage());
		}
		if ($this->EmploymentType->Required) {
			if (!$this->EmploymentType->IsDetailKey && $this->EmploymentType->FormValue != NULL && $this->EmploymentType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmploymentType->caption(), $this->EmploymentType->RequiredErrorMessage));
			}
		}
		if ($this->EmploymentStatus->Required) {
			if (!$this->EmploymentStatus->IsDetailKey && $this->EmploymentStatus->FormValue != NULL && $this->EmploymentStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmploymentStatus->caption(), $this->EmploymentStatus->RequiredErrorMessage));
			}
		}
		if ($this->EmployeeNumber->Required) {
			if (!$this->EmployeeNumber->IsDetailKey && $this->EmployeeNumber->FormValue != NULL && $this->EmployeeNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeNumber->caption(), $this->EmployeeNumber->RequiredErrorMessage));
			}
		}
		if ($this->SalaryNotch->Required) {
			if (!$this->SalaryNotch->IsDetailKey && $this->SalaryNotch->FormValue != NULL && $this->SalaryNotch->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SalaryNotch->caption(), $this->SalaryNotch->RequiredErrorMessage));
			}
		}
		if ($this->BasicMonthlySalary->Required) {
			if (!$this->BasicMonthlySalary->IsDetailKey && $this->BasicMonthlySalary->FormValue != NULL && $this->BasicMonthlySalary->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BasicMonthlySalary->caption(), $this->BasicMonthlySalary->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BasicMonthlySalary->FormValue)) {
			AddMessage($FormError, $this->BasicMonthlySalary->errorMessage());
		}
		if ($this->ThirdParties->Required) {
			if ($this->ThirdParties->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ThirdParties->caption(), $this->ThirdParties->RequiredErrorMessage));
			}
		}
		if ($this->PayrollCode->Required) {
			if (!$this->PayrollCode->IsDetailKey && $this->PayrollCode->FormValue != NULL && $this->PayrollCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PayrollCode->caption(), $this->PayrollCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PayrollCode->FormValue)) {
			AddMessage($FormError, $this->PayrollCode->errorMessage());
		}
		if ($this->DateOfConfirmation->Required) {
			if (!$this->DateOfConfirmation->IsDetailKey && $this->DateOfConfirmation->FormValue != NULL && $this->DateOfConfirmation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfConfirmation->caption(), $this->DateOfConfirmation->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfConfirmation->FormValue)) {
			AddMessage($FormError, $this->DateOfConfirmation->errorMessage());
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
				$thisKey .= $row['SubstantivePosition'];
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

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, $this->SectionCode->ReadOnly);

			// SubstantivePosition
			$this->SubstantivePosition->setDbValueDef($rsnew, $this->SubstantivePosition->CurrentValue, 0, $this->SubstantivePosition->ReadOnly);

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0), CurrentDate(), $this->DateOfCurrentAppointment->ReadOnly);

			// LastAppraisalDate
			$this->LastAppraisalDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0), NULL, $this->LastAppraisalDate->ReadOnly);

			// AppraisalStatus
			$this->AppraisalStatus->setDbValueDef($rsnew, $this->AppraisalStatus->CurrentValue, NULL, $this->AppraisalStatus->ReadOnly);

			// DateOfExit
			$this->DateOfExit->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfExit->CurrentValue, 0), NULL, $this->DateOfExit->ReadOnly);

			// EmploymentType
			$this->EmploymentType->setDbValueDef($rsnew, $this->EmploymentType->CurrentValue, 0, $this->EmploymentType->ReadOnly);

			// EmploymentStatus
			$this->EmploymentStatus->setDbValueDef($rsnew, $this->EmploymentStatus->CurrentValue, 0, $this->EmploymentStatus->ReadOnly);

			// EmployeeNumber
			$this->EmployeeNumber->setDbValueDef($rsnew, $this->EmployeeNumber->CurrentValue, NULL, $this->EmployeeNumber->ReadOnly);

			// SalaryNotch
			$this->SalaryNotch->setDbValueDef($rsnew, $this->SalaryNotch->CurrentValue, 0, $this->SalaryNotch->ReadOnly);

			// BasicMonthlySalary
			$this->BasicMonthlySalary->setDbValueDef($rsnew, $this->BasicMonthlySalary->CurrentValue, 0, $this->BasicMonthlySalary->ReadOnly);

			// ThirdParties
			$this->ThirdParties->setDbValueDef($rsnew, $this->ThirdParties->CurrentValue, "", $this->ThirdParties->ReadOnly);

			// PayrollCode
			$this->PayrollCode->setDbValueDef($rsnew, $this->PayrollCode->CurrentValue, 0, $this->PayrollCode->ReadOnly);

			// DateOfConfirmation
			$this->DateOfConfirmation->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0), NULL, $this->DateOfConfirmation->ReadOnly);

			// Check referential integrity for master table 'position_ref'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_position_ref();
			$keyValue = isset($rsnew['SubstantivePosition']) ? $rsnew['SubstantivePosition'] : $rsold['SubstantivePosition'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@PositionCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['SectionCode']) ? $rsnew['SectionCode'] : $rsold['SectionCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@SectionCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['DepartmentCode']) ? $rsnew['DepartmentCode'] : $rsold['DepartmentCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@DepartmentCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['LACode']) ? $rsnew['LACode'] : $rsold['LACode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@LACode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['ProvinceCode']) ? $rsnew['ProvinceCode'] : $rsold['ProvinceCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@ProvinceCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['SalaryScale']) ? $rsnew['SalaryScale'] : $rsold['SalaryScale'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@SalaryScale@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["position_ref"]))
					$GLOBALS["position_ref"] = new position_ref();
				$rsmaster = $GLOBALS["position_ref"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "position_ref", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Check referential integrity for master table 'staff'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_staff();
			$keyValue = isset($rsnew['EmployeeID']) ? $rsnew['EmployeeID'] : $rsold['EmployeeID'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@EmployeeID@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["staff"]))
					$GLOBALS["staff"] = new staff();
				$rsmaster = $GLOBALS["staff"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "staff", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "position_ref") {
				$this->SubstantivePosition->CurrentValue = $this->SubstantivePosition->getSessionValue();
				$this->SectionCode->CurrentValue = $this->SectionCode->getSessionValue();
				$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$this->SalaryScale->CurrentValue = $this->SalaryScale->getSessionValue();
			}
			if ($this->getCurrentMasterTable() == "staff") {
				$this->EmployeeID->CurrentValue = $this->EmployeeID->getSessionValue();
			}

		// Check referential integrity for master table 'employment'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_position_ref();
		if (strval($this->SubstantivePosition->CurrentValue) != "") {
			$masterFilter = str_replace("@PositionCode@", AdjustSql($this->SubstantivePosition->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->SectionCode->CurrentValue) != "") {
			$masterFilter = str_replace("@SectionCode@", AdjustSql($this->SectionCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->DepartmentCode->CurrentValue) != "") {
			$masterFilter = str_replace("@DepartmentCode@", AdjustSql($this->DepartmentCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->LACode->CurrentValue) != "") {
			$masterFilter = str_replace("@LACode@", AdjustSql($this->LACode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->ProvinceCode->CurrentValue) != "") {
			$masterFilter = str_replace("@ProvinceCode@", AdjustSql($this->ProvinceCode->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($this->SalaryScale->getSessionValue() != "") {
			$masterFilter = str_replace("@SalaryScale@", AdjustSql($this->SalaryScale->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["position_ref"]))
				$GLOBALS["position_ref"] = new position_ref();
			$rsmaster = $GLOBALS["position_ref"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "position_ref", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}

		// Check referential integrity for master table 'employment'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_staff();
		if ($this->EmployeeID->getSessionValue() != "") {
			$masterFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["staff"]))
				$GLOBALS["staff"] = new staff();
			$rsmaster = $GLOBALS["staff"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "staff", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// SubstantivePosition
		$this->SubstantivePosition->setDbValueDef($rsnew, $this->SubstantivePosition->CurrentValue, 0, FALSE);

		// DateOfCurrentAppointment
		$this->DateOfCurrentAppointment->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0), CurrentDate(), FALSE);

		// LastAppraisalDate
		$this->LastAppraisalDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0), NULL, FALSE);

		// AppraisalStatus
		$this->AppraisalStatus->setDbValueDef($rsnew, $this->AppraisalStatus->CurrentValue, NULL, FALSE);

		// DateOfExit
		$this->DateOfExit->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfExit->CurrentValue, 0), NULL, FALSE);

		// EmploymentType
		$this->EmploymentType->setDbValueDef($rsnew, $this->EmploymentType->CurrentValue, 0, FALSE);

		// EmploymentStatus
		$this->EmploymentStatus->setDbValueDef($rsnew, $this->EmploymentStatus->CurrentValue, 0, FALSE);

		// EmployeeNumber
		$this->EmployeeNumber->setDbValueDef($rsnew, $this->EmployeeNumber->CurrentValue, NULL, FALSE);

		// SalaryNotch
		$this->SalaryNotch->setDbValueDef($rsnew, $this->SalaryNotch->CurrentValue, 0, FALSE);

		// BasicMonthlySalary
		$this->BasicMonthlySalary->setDbValueDef($rsnew, $this->BasicMonthlySalary->CurrentValue, 0, FALSE);

		// ThirdParties
		$this->ThirdParties->setDbValueDef($rsnew, $this->ThirdParties->CurrentValue, "", strval($this->ThirdParties->CurrentValue) == "");

		// PayrollCode
		$this->PayrollCode->setDbValueDef($rsnew, $this->PayrollCode->CurrentValue, 0, FALSE);

		// DateOfConfirmation
		$this->DateOfConfirmation->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0), NULL, FALSE);

		// EmployeeID
		if ($this->EmployeeID->getSessionValue() != "") {
			$rsnew['EmployeeID'] = $this->EmployeeID->getSessionValue();
		}

		// SalaryScale
		if ($this->SalaryScale->getSessionValue() != "") {
			$rsnew['SalaryScale'] = $this->SalaryScale->getSessionValue();
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
		if ($insertRow && $this->ValidateKey && strval($rsnew['SubstantivePosition']) == "") {
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
		if ($masterTblVar == "position_ref") {
			$this->SubstantivePosition->Visible = FALSE;
			if ($GLOBALS["position_ref"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->SectionCode->Visible = FALSE;
			if ($GLOBALS["position_ref"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->DepartmentCode->Visible = FALSE;
			if ($GLOBALS["position_ref"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->LACode->Visible = FALSE;
			if ($GLOBALS["position_ref"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->ProvinceCode->Visible = FALSE;
			if ($GLOBALS["position_ref"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->SalaryScale->Visible = FALSE;
			if ($GLOBALS["position_ref"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_SubstantivePosition":
					break;
				case "x_AppraisalStatus":
					break;
				case "x_SalaryScale":
					break;
				case "x_EmploymentType":
					break;
				case "x_EmploymentStatus":
					break;
				case "x_ExitReason":
					break;
				case "x_RetirementType":
					break;
				case "x_SalaryNotch":
					break;
				case "x_ThirdParties":
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
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_SubstantivePosition":
							break;
						case "x_AppraisalStatus":
							break;
						case "x_SalaryScale":
							break;
						case "x_EmploymentType":
							break;
						case "x_EmploymentStatus":
							break;
						case "x_ExitReason":
							break;
						case "x_RetirementType":
							break;
						case "x_SalaryNotch":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							$row[2] = FormatNumber($row[2], 2, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_ThirdParties":
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