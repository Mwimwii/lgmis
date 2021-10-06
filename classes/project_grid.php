<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class project_grid extends project
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'project';

	// Page object name
	public $PageObjName = "project_grid";

	// Grid form hidden field names
	public $FormName = "fprojectgrid";
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

		// Table object (project)
		if (!isset($GLOBALS["project"]) || get_class($GLOBALS["project"]) == PROJECT_NAMESPACE . "project") {
			$GLOBALS["project"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["project"];

		}
		$this->AddUrl = "projectadd.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'project');

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
		global $project;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($project);
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
			$key .= @$ar['ProjectCode'];
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
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->Visible = FALSE;
		$this->SectionCode->Visible = FALSE;
		$this->ProjectCode->setVisibility();
		$this->ProjectName->setVisibility();
		$this->ProjectType->setVisibility();
		$this->ProjectSector->setVisibility();
		$this->Contractors->setVisibility();
		$this->Projectdescription->Visible = FALSE;
		$this->PlannedStartDate->setVisibility();
		$this->PlannedEndDate->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->ActualEndDate->setVisibility();
		$this->Budget->setVisibility();
		$this->ExpenditureTodate->Visible = FALSE;
		$this->FundsReleased->Visible = FALSE;
		$this->FundingSource->Visible = FALSE;
		$this->ProjectDocs->Visible = FALSE;
		$this->ProgressStatus->setVisibility();
		$this->OutstandingTasks->setVisibility();
		$this->LastUpdated->Visible = FALSE;
		$this->CommnentsOnStatus->Visible = FALSE;
		$this->MoreDocs->Visible = FALSE;
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
		$this->setupLookupOptions($this->ProjectType);
		$this->setupLookupOptions($this->ProjectSector);
		$this->setupLookupOptions($this->FundingSource);
		$this->setupLookupOptions($this->ProgressStatus);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "local_authority") {
			global $local_authority;
			$rsmaster = $local_authority->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("local_authoritylist.php"); // Return to master page
			} else {
				$local_authority->loadListRowValues($rsmaster);
				$local_authority->RowType = ROWTYPE_MASTER; // Master row
				$local_authority->renderListRow();
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
		$this->Budget->FormValue = ""; // Clear form value
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
			$this->ProjectCode->setOldValue($arKeyFlds[0]);
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
					$key .= $this->ProjectCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_ProjectCode") && $CurrentForm->hasValue("o_ProjectCode") && $this->ProjectCode->CurrentValue != $this->ProjectCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProjectName") && $CurrentForm->hasValue("o_ProjectName") && $this->ProjectName->CurrentValue != $this->ProjectName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProjectType") && $CurrentForm->hasValue("o_ProjectType") && $this->ProjectType->CurrentValue != $this->ProjectType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProjectSector") && $CurrentForm->hasValue("o_ProjectSector") && $this->ProjectSector->CurrentValue != $this->ProjectSector->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Contractors") && $CurrentForm->hasValue("o_Contractors") && $this->Contractors->CurrentValue != $this->Contractors->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PlannedStartDate") && $CurrentForm->hasValue("o_PlannedStartDate") && $this->PlannedStartDate->CurrentValue != $this->PlannedStartDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PlannedEndDate") && $CurrentForm->hasValue("o_PlannedEndDate") && $this->PlannedEndDate->CurrentValue != $this->PlannedEndDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActualStartDate") && $CurrentForm->hasValue("o_ActualStartDate") && $this->ActualStartDate->CurrentValue != $this->ActualStartDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActualEndDate") && $CurrentForm->hasValue("o_ActualEndDate") && $this->ActualEndDate->CurrentValue != $this->ActualEndDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Budget") && $CurrentForm->hasValue("o_Budget") && $this->Budget->CurrentValue != $this->Budget->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProgressStatus") && $CurrentForm->hasValue("o_ProgressStatus") && $this->ProgressStatus->CurrentValue != $this->ProgressStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutstandingTasks") && $CurrentForm->hasValue("o_OutstandingTasks") && $this->OutstandingTasks->CurrentValue != $this->OutstandingTasks->OldValue)
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
				$this->LACode->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ProjectCode->CurrentValue . "\">";
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
		$key .= $rs->fields('ProjectCode');
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
		$sqlwrk = "`ProvinceCode`=" . AdjustSql($this->ProvinceCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";
		$sqlwrk = $sqlwrk . " AND " . "`DepartmentCode`=" . AdjustSql($this->DepartmentCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`SectionCode`=" . AdjustSql($this->SectionCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`ProjectCode`='" . AdjustSql($this->ProjectCode->CurrentValue, $this->Dbid) . "'";

		// Column "detail_activity"
		if ($this->DetailPages && $this->DetailPages["activity"] && $this->DetailPages["activity"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_activity"];
			$url = "activitypreview.php?t=project&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"activity\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'project')) {
				$label = $Language->TablePhrase("activity", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"activity\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("activitylist.php?" . Config("TABLE_SHOW_MASTER") . "=project&fk_ProvinceCode=" . urlencode(strval($this->ProvinceCode->CurrentValue)) . "&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "&fk_DepartmentCode=" . urlencode(strval($this->DepartmentCode->CurrentValue)) . "&fk_SectionCode=" . urlencode(strval($this->SectionCode->CurrentValue)) . "&fk_ProjectCode=" . urlencode(strval($this->ProjectCode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("activity", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["activity_grid"]))
				$GLOBALS["activity_grid"] = new activity_grid();
			if ($GLOBALS["activity_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'project')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=activity");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["activity_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'project')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=activity");
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
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->ProjectCode->CurrentValue = NULL;
		$this->ProjectCode->OldValue = $this->ProjectCode->CurrentValue;
		$this->ProjectName->CurrentValue = NULL;
		$this->ProjectName->OldValue = $this->ProjectName->CurrentValue;
		$this->ProjectType->CurrentValue = 1;
		$this->ProjectType->OldValue = $this->ProjectType->CurrentValue;
		$this->ProjectSector->CurrentValue = NULL;
		$this->ProjectSector->OldValue = $this->ProjectSector->CurrentValue;
		$this->Contractors->CurrentValue = NULL;
		$this->Contractors->OldValue = $this->Contractors->CurrentValue;
		$this->Projectdescription->CurrentValue = NULL;
		$this->Projectdescription->OldValue = $this->Projectdescription->CurrentValue;
		$this->PlannedStartDate->CurrentValue = NULL;
		$this->PlannedStartDate->OldValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedEndDate->CurrentValue = NULL;
		$this->PlannedEndDate->OldValue = $this->PlannedEndDate->CurrentValue;
		$this->ActualStartDate->CurrentValue = NULL;
		$this->ActualStartDate->OldValue = $this->ActualStartDate->CurrentValue;
		$this->ActualEndDate->CurrentValue = NULL;
		$this->ActualEndDate->OldValue = $this->ActualEndDate->CurrentValue;
		$this->Budget->CurrentValue = NULL;
		$this->Budget->OldValue = $this->Budget->CurrentValue;
		$this->ExpenditureTodate->CurrentValue = NULL;
		$this->ExpenditureTodate->OldValue = $this->ExpenditureTodate->CurrentValue;
		$this->FundsReleased->CurrentValue = NULL;
		$this->FundsReleased->OldValue = $this->FundsReleased->CurrentValue;
		$this->FundingSource->CurrentValue = NULL;
		$this->FundingSource->OldValue = $this->FundingSource->CurrentValue;
		$this->ProjectDocs->Upload->DbValue = NULL;
		$this->ProjectDocs->OldValue = $this->ProjectDocs->Upload->DbValue;
		$this->ProjectDocs->Upload->Index = $this->RowIndex;
		$this->ProgressStatus->CurrentValue = NULL;
		$this->ProgressStatus->OldValue = $this->ProgressStatus->CurrentValue;
		$this->OutstandingTasks->CurrentValue = NULL;
		$this->OutstandingTasks->OldValue = $this->OutstandingTasks->CurrentValue;
		$this->LastUpdated->CurrentValue = NULL;
		$this->LastUpdated->OldValue = $this->LastUpdated->CurrentValue;
		$this->CommnentsOnStatus->CurrentValue = NULL;
		$this->CommnentsOnStatus->OldValue = $this->CommnentsOnStatus->CurrentValue;
		$this->MoreDocs->Upload->DbValue = NULL;
		$this->MoreDocs->OldValue = $this->MoreDocs->Upload->DbValue;
		$this->MoreDocs->Upload->Index = $this->RowIndex;
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

		// Check field name 'ProjectCode' first before field var 'x_ProjectCode'
		$val = $CurrentForm->hasValue("ProjectCode") ? $CurrentForm->getValue("ProjectCode") : $CurrentForm->getValue("x_ProjectCode");
		if (!$this->ProjectCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProjectCode"))
			$this->ProjectCode->setOldValue($CurrentForm->getValue("o_ProjectCode"));

		// Check field name 'ProjectName' first before field var 'x_ProjectName'
		$val = $CurrentForm->hasValue("ProjectName") ? $CurrentForm->getValue("ProjectName") : $CurrentForm->getValue("x_ProjectName");
		if (!$this->ProjectName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectName->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProjectName"))
			$this->ProjectName->setOldValue($CurrentForm->getValue("o_ProjectName"));

		// Check field name 'ProjectType' first before field var 'x_ProjectType'
		$val = $CurrentForm->hasValue("ProjectType") ? $CurrentForm->getValue("ProjectType") : $CurrentForm->getValue("x_ProjectType");
		if (!$this->ProjectType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectType->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProjectType"))
			$this->ProjectType->setOldValue($CurrentForm->getValue("o_ProjectType"));

		// Check field name 'ProjectSector' first before field var 'x_ProjectSector'
		$val = $CurrentForm->hasValue("ProjectSector") ? $CurrentForm->getValue("ProjectSector") : $CurrentForm->getValue("x_ProjectSector");
		if (!$this->ProjectSector->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProjectSector->Visible = FALSE; // Disable update for API request
			else
				$this->ProjectSector->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProjectSector"))
			$this->ProjectSector->setOldValue($CurrentForm->getValue("o_ProjectSector"));

		// Check field name 'Contractors' first before field var 'x_Contractors'
		$val = $CurrentForm->hasValue("Contractors") ? $CurrentForm->getValue("Contractors") : $CurrentForm->getValue("x_Contractors");
		if (!$this->Contractors->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Contractors->Visible = FALSE; // Disable update for API request
			else
				$this->Contractors->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Contractors"))
			$this->Contractors->setOldValue($CurrentForm->getValue("o_Contractors"));

		// Check field name 'PlannedStartDate' first before field var 'x_PlannedStartDate'
		$val = $CurrentForm->hasValue("PlannedStartDate") ? $CurrentForm->getValue("PlannedStartDate") : $CurrentForm->getValue("x_PlannedStartDate");
		if (!$this->PlannedStartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PlannedStartDate->Visible = FALSE; // Disable update for API request
			else
				$this->PlannedStartDate->setFormValue($val);
			$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_PlannedStartDate"))
			$this->PlannedStartDate->setOldValue($CurrentForm->getValue("o_PlannedStartDate"));

		// Check field name 'PlannedEndDate' first before field var 'x_PlannedEndDate'
		$val = $CurrentForm->hasValue("PlannedEndDate") ? $CurrentForm->getValue("PlannedEndDate") : $CurrentForm->getValue("x_PlannedEndDate");
		if (!$this->PlannedEndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PlannedEndDate->Visible = FALSE; // Disable update for API request
			else
				$this->PlannedEndDate->setFormValue($val);
			$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_PlannedEndDate"))
			$this->PlannedEndDate->setOldValue($CurrentForm->getValue("o_PlannedEndDate"));

		// Check field name 'ActualStartDate' first before field var 'x_ActualStartDate'
		$val = $CurrentForm->hasValue("ActualStartDate") ? $CurrentForm->getValue("ActualStartDate") : $CurrentForm->getValue("x_ActualStartDate");
		if (!$this->ActualStartDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualStartDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActualStartDate->setFormValue($val);
			$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_ActualStartDate"))
			$this->ActualStartDate->setOldValue($CurrentForm->getValue("o_ActualStartDate"));

		// Check field name 'ActualEndDate' first before field var 'x_ActualEndDate'
		$val = $CurrentForm->hasValue("ActualEndDate") ? $CurrentForm->getValue("ActualEndDate") : $CurrentForm->getValue("x_ActualEndDate");
		if (!$this->ActualEndDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualEndDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActualEndDate->setFormValue($val);
			$this->ActualEndDate->CurrentValue = UnFormatDateTime($this->ActualEndDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_ActualEndDate"))
			$this->ActualEndDate->setOldValue($CurrentForm->getValue("o_ActualEndDate"));

		// Check field name 'Budget' first before field var 'x_Budget'
		$val = $CurrentForm->hasValue("Budget") ? $CurrentForm->getValue("Budget") : $CurrentForm->getValue("x_Budget");
		if (!$this->Budget->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Budget->Visible = FALSE; // Disable update for API request
			else
				$this->Budget->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Budget"))
			$this->Budget->setOldValue($CurrentForm->getValue("o_Budget"));

		// Check field name 'ProgressStatus' first before field var 'x_ProgressStatus'
		$val = $CurrentForm->hasValue("ProgressStatus") ? $CurrentForm->getValue("ProgressStatus") : $CurrentForm->getValue("x_ProgressStatus");
		if (!$this->ProgressStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProgressStatus->Visible = FALSE; // Disable update for API request
			else
				$this->ProgressStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProgressStatus"))
			$this->ProgressStatus->setOldValue($CurrentForm->getValue("o_ProgressStatus"));

		// Check field name 'OutstandingTasks' first before field var 'x_OutstandingTasks'
		$val = $CurrentForm->hasValue("OutstandingTasks") ? $CurrentForm->getValue("OutstandingTasks") : $CurrentForm->getValue("x_OutstandingTasks");
		if (!$this->OutstandingTasks->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutstandingTasks->Visible = FALSE; // Disable update for API request
			else
				$this->OutstandingTasks->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutstandingTasks"))
			$this->OutstandingTasks->setOldValue($CurrentForm->getValue("o_OutstandingTasks"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->ProjectCode->CurrentValue = $this->ProjectCode->FormValue;
		$this->ProjectName->CurrentValue = $this->ProjectName->FormValue;
		$this->ProjectType->CurrentValue = $this->ProjectType->FormValue;
		$this->ProjectSector->CurrentValue = $this->ProjectSector->FormValue;
		$this->Contractors->CurrentValue = $this->Contractors->FormValue;
		$this->PlannedStartDate->CurrentValue = $this->PlannedStartDate->FormValue;
		$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		$this->PlannedEndDate->CurrentValue = $this->PlannedEndDate->FormValue;
		$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0);
		$this->ActualStartDate->CurrentValue = $this->ActualStartDate->FormValue;
		$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		$this->ActualEndDate->CurrentValue = $this->ActualEndDate->FormValue;
		$this->ActualEndDate->CurrentValue = UnFormatDateTime($this->ActualEndDate->CurrentValue, 0);
		$this->Budget->CurrentValue = $this->Budget->FormValue;
		$this->ProgressStatus->CurrentValue = $this->ProgressStatus->FormValue;
		$this->OutstandingTasks->CurrentValue = $this->OutstandingTasks->FormValue;
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->ProjectCode->setDbValue($row['ProjectCode']);
		$this->ProjectName->setDbValue($row['ProjectName']);
		$this->ProjectType->setDbValue($row['ProjectType']);
		$this->ProjectSector->setDbValue($row['ProjectSector']);
		$this->Contractors->setDbValue($row['Contractors']);
		$this->Projectdescription->setDbValue($row['Projectdescription']);
		$this->PlannedStartDate->setDbValue($row['PlannedStartDate']);
		$this->PlannedEndDate->setDbValue($row['PlannedEndDate']);
		$this->ActualStartDate->setDbValue($row['ActualStartDate']);
		$this->ActualEndDate->setDbValue($row['ActualEndDate']);
		$this->Budget->setDbValue($row['Budget']);
		$this->ExpenditureTodate->setDbValue($row['ExpenditureTodate']);
		$this->FundsReleased->setDbValue($row['FundsReleased']);
		$this->FundingSource->setDbValue($row['FundingSource']);
		$this->ProjectDocs->Upload->DbValue = $row['ProjectDocs'];
		if (is_array($this->ProjectDocs->Upload->DbValue) || is_object($this->ProjectDocs->Upload->DbValue)) // Byte array
			$this->ProjectDocs->Upload->DbValue = BytesToString($this->ProjectDocs->Upload->DbValue);
		$this->ProjectDocs->Upload->Index = $this->RowIndex;
		$this->ProgressStatus->setDbValue($row['ProgressStatus']);
		$this->OutstandingTasks->setDbValue($row['OutstandingTasks']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->CommnentsOnStatus->setDbValue($row['CommnentsOnStatus']);
		$this->MoreDocs->Upload->DbValue = $row['MoreDocs'];
		if (is_array($this->MoreDocs->Upload->DbValue) || is_object($this->MoreDocs->Upload->DbValue)) // Byte array
			$this->MoreDocs->Upload->DbValue = BytesToString($this->MoreDocs->Upload->DbValue);
		$this->MoreDocs->Upload->Index = $this->RowIndex;
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['ProjectCode'] = $this->ProjectCode->CurrentValue;
		$row['ProjectName'] = $this->ProjectName->CurrentValue;
		$row['ProjectType'] = $this->ProjectType->CurrentValue;
		$row['ProjectSector'] = $this->ProjectSector->CurrentValue;
		$row['Contractors'] = $this->Contractors->CurrentValue;
		$row['Projectdescription'] = $this->Projectdescription->CurrentValue;
		$row['PlannedStartDate'] = $this->PlannedStartDate->CurrentValue;
		$row['PlannedEndDate'] = $this->PlannedEndDate->CurrentValue;
		$row['ActualStartDate'] = $this->ActualStartDate->CurrentValue;
		$row['ActualEndDate'] = $this->ActualEndDate->CurrentValue;
		$row['Budget'] = $this->Budget->CurrentValue;
		$row['ExpenditureTodate'] = $this->ExpenditureTodate->CurrentValue;
		$row['FundsReleased'] = $this->FundsReleased->CurrentValue;
		$row['FundingSource'] = $this->FundingSource->CurrentValue;
		$row['ProjectDocs'] = $this->ProjectDocs->Upload->DbValue;
		$row['ProgressStatus'] = $this->ProgressStatus->CurrentValue;
		$row['OutstandingTasks'] = $this->OutstandingTasks->CurrentValue;
		$row['LastUpdated'] = $this->LastUpdated->CurrentValue;
		$row['CommnentsOnStatus'] = $this->CommnentsOnStatus->CurrentValue;
		$row['MoreDocs'] = $this->MoreDocs->Upload->DbValue;
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
				$this->ProjectCode->OldValue = strval($keys[0]); // ProjectCode
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
		if ($this->Budget->FormValue == $this->Budget->CurrentValue && is_numeric(ConvertToFloatString($this->Budget->CurrentValue)))
			$this->Budget->CurrentValue = ConvertToFloatString($this->Budget->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// ProjectCode
		// ProjectName
		// ProjectType
		// ProjectSector
		// Contractors
		// Projectdescription
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Budget
		// ExpenditureTodate
		// FundsReleased
		// FundingSource
		// ProjectDocs
		// ProgressStatus
		// OutstandingTasks
		// LastUpdated
		// CommnentsOnStatus
		// MoreDocs

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// ProjectCode
			$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
			$this->ProjectCode->ViewCustomAttributes = "";

			// ProjectName
			$this->ProjectName->ViewValue = $this->ProjectName->CurrentValue;
			$this->ProjectName->ViewCustomAttributes = "";

			// ProjectType
			$curVal = strval($this->ProjectType->CurrentValue);
			if ($curVal != "") {
				$this->ProjectType->ViewValue = $this->ProjectType->lookupCacheOption($curVal);
				if ($this->ProjectType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProjectType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectType->ViewValue = $this->ProjectType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectType->ViewValue = $this->ProjectType->CurrentValue;
					}
				}
			} else {
				$this->ProjectType->ViewValue = NULL;
			}
			$this->ProjectType->ViewCustomAttributes = "";

			// ProjectSector
			$curVal = strval($this->ProjectSector->CurrentValue);
			if ($curVal != "") {
				$this->ProjectSector->ViewValue = $this->ProjectSector->lookupCacheOption($curVal);
				if ($this->ProjectSector->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectSector`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProjectSector->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectSector->ViewValue = $this->ProjectSector->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectSector->ViewValue = $this->ProjectSector->CurrentValue;
					}
				}
			} else {
				$this->ProjectSector->ViewValue = NULL;
			}
			$this->ProjectSector->ViewCustomAttributes = "";

			// Contractors
			$this->Contractors->ViewValue = $this->Contractors->CurrentValue;
			$this->Contractors->ViewCustomAttributes = "";

			// PlannedStartDate
			$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
			$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
			$this->PlannedStartDate->ViewCustomAttributes = "";

			// PlannedEndDate
			$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
			$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 0);
			$this->PlannedEndDate->ViewCustomAttributes = "";

			// ActualStartDate
			$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
			$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
			$this->ActualStartDate->ViewCustomAttributes = "";

			// ActualEndDate
			$this->ActualEndDate->ViewValue = $this->ActualEndDate->CurrentValue;
			$this->ActualEndDate->ViewValue = FormatDateTime($this->ActualEndDate->ViewValue, 0);
			$this->ActualEndDate->ViewCustomAttributes = "";

			// Budget
			$this->Budget->ViewValue = $this->Budget->CurrentValue;
			$this->Budget->ViewValue = FormatNumber($this->Budget->ViewValue, 2, -2, -2, -2);
			$this->Budget->CellCssStyle .= "text-align: right;";
			$this->Budget->ViewCustomAttributes = "";

			// ExpenditureTodate
			$this->ExpenditureTodate->ViewValue = $this->ExpenditureTodate->CurrentValue;
			$this->ExpenditureTodate->ViewValue = FormatNumber($this->ExpenditureTodate->ViewValue, 2, -2, -2, -2);
			$this->ExpenditureTodate->CellCssStyle .= "text-align: right;";
			$this->ExpenditureTodate->ViewCustomAttributes = "";

			// FundsReleased
			$this->FundsReleased->ViewValue = $this->FundsReleased->CurrentValue;
			$this->FundsReleased->ViewValue = FormatNumber($this->FundsReleased->ViewValue, 2, -2, -2, -2);
			$this->FundsReleased->CellCssStyle .= "text-align: right;";
			$this->FundsReleased->ViewCustomAttributes = "";

			// FundingSource
			$curVal = strval($this->FundingSource->CurrentValue);
			if ($curVal != "") {
				$this->FundingSource->ViewValue = $this->FundingSource->lookupCacheOption($curVal);
				if ($this->FundingSource->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`FundingSource`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->FundingSource->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FundingSource->ViewValue = $this->FundingSource->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FundingSource->ViewValue = $this->FundingSource->CurrentValue;
					}
				}
			} else {
				$this->FundingSource->ViewValue = NULL;
			}
			$this->FundingSource->ViewCustomAttributes = "";

			// ProgressStatus
			$curVal = strval($this->ProgressStatus->CurrentValue);
			if ($curVal != "") {
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
				if ($this->ProgressStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgressStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgressStatus->ViewValue = $this->ProgressStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgressStatus->ViewValue = $this->ProgressStatus->CurrentValue;
					}
				}
			} else {
				$this->ProgressStatus->ViewValue = NULL;
			}
			$this->ProgressStatus->ViewCustomAttributes = "";

			// OutstandingTasks
			$this->OutstandingTasks->ViewValue = $this->OutstandingTasks->CurrentValue;
			$this->OutstandingTasks->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";
			$this->ProjectCode->TooltipValue = "";

			// ProjectName
			$this->ProjectName->LinkCustomAttributes = "";
			$this->ProjectName->HrefValue = "";
			$this->ProjectName->TooltipValue = "";

			// ProjectType
			$this->ProjectType->LinkCustomAttributes = "";
			$this->ProjectType->HrefValue = "";
			$this->ProjectType->TooltipValue = "";

			// ProjectSector
			$this->ProjectSector->LinkCustomAttributes = "";
			$this->ProjectSector->HrefValue = "";
			$this->ProjectSector->TooltipValue = "";

			// Contractors
			$this->Contractors->LinkCustomAttributes = "";
			$this->Contractors->HrefValue = "";
			$this->Contractors->TooltipValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";
			$this->PlannedStartDate->TooltipValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";
			$this->PlannedEndDate->TooltipValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";
			$this->ActualStartDate->TooltipValue = "";

			// ActualEndDate
			$this->ActualEndDate->LinkCustomAttributes = "";
			$this->ActualEndDate->HrefValue = "";
			$this->ActualEndDate->TooltipValue = "";

			// Budget
			$this->Budget->LinkCustomAttributes = "";
			$this->Budget->HrefValue = "";
			$this->Budget->TooltipValue = "";

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";
			$this->ProgressStatus->TooltipValue = "";

			// OutstandingTasks
			$this->OutstandingTasks->LinkCustomAttributes = "";
			$this->OutstandingTasks->HrefValue = "";
			$this->OutstandingTasks->TooltipValue = "";
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
			$this->LACode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// ProjectCode
			$this->ProjectCode->EditAttrs["class"] = "form-control";
			$this->ProjectCode->EditCustomAttributes = "";
			if (!$this->ProjectCode->Raw)
				$this->ProjectCode->CurrentValue = HtmlDecode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());

			// ProjectName
			$this->ProjectName->EditAttrs["class"] = "form-control";
			$this->ProjectName->EditCustomAttributes = "";
			if (!$this->ProjectName->Raw)
				$this->ProjectName->CurrentValue = HtmlDecode($this->ProjectName->CurrentValue);
			$this->ProjectName->EditValue = HtmlEncode($this->ProjectName->CurrentValue);
			$this->ProjectName->PlaceHolder = RemoveHtml($this->ProjectName->caption());

			// ProjectType
			$this->ProjectType->EditAttrs["class"] = "form-control";
			$this->ProjectType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectType->CurrentValue));
			if ($curVal != "")
				$this->ProjectType->ViewValue = $this->ProjectType->lookupCacheOption($curVal);
			else
				$this->ProjectType->ViewValue = $this->ProjectType->Lookup !== NULL && is_array($this->ProjectType->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectType->ViewValue !== NULL) { // Load from cache
				$this->ProjectType->EditValue = array_values($this->ProjectType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectType`" . SearchString("=", $this->ProjectType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProjectType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectType->EditValue = $arwrk;
			}

			// ProjectSector
			$this->ProjectSector->EditAttrs["class"] = "form-control";
			$this->ProjectSector->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectSector->CurrentValue));
			if ($curVal != "")
				$this->ProjectSector->ViewValue = $this->ProjectSector->lookupCacheOption($curVal);
			else
				$this->ProjectSector->ViewValue = $this->ProjectSector->Lookup !== NULL && is_array($this->ProjectSector->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectSector->ViewValue !== NULL) { // Load from cache
				$this->ProjectSector->EditValue = array_values($this->ProjectSector->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectSector`" . SearchString("=", $this->ProjectSector->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProjectSector->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectSector->EditValue = $arwrk;
			}

			// Contractors
			$this->Contractors->EditAttrs["class"] = "form-control";
			$this->Contractors->EditCustomAttributes = "";
			$this->Contractors->EditValue = HtmlEncode($this->Contractors->CurrentValue);
			$this->Contractors->PlaceHolder = RemoveHtml($this->Contractors->caption());

			// PlannedStartDate
			$this->PlannedStartDate->EditAttrs["class"] = "form-control";
			$this->PlannedStartDate->EditCustomAttributes = "";
			$this->PlannedStartDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedStartDate->CurrentValue, 8));
			$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

			// PlannedEndDate
			$this->PlannedEndDate->EditAttrs["class"] = "form-control";
			$this->PlannedEndDate->EditCustomAttributes = "";
			$this->PlannedEndDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedEndDate->CurrentValue, 8));
			$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

			// ActualStartDate
			$this->ActualStartDate->EditAttrs["class"] = "form-control";
			$this->ActualStartDate->EditCustomAttributes = "";
			$this->ActualStartDate->EditValue = HtmlEncode(FormatDateTime($this->ActualStartDate->CurrentValue, 8));
			$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

			// ActualEndDate
			$this->ActualEndDate->EditAttrs["class"] = "form-control";
			$this->ActualEndDate->EditCustomAttributes = "";
			$this->ActualEndDate->EditValue = HtmlEncode(FormatDateTime($this->ActualEndDate->CurrentValue, 8));
			$this->ActualEndDate->PlaceHolder = RemoveHtml($this->ActualEndDate->caption());

			// Budget
			$this->Budget->EditAttrs["class"] = "form-control";
			$this->Budget->EditCustomAttributes = "";
			$this->Budget->EditValue = HtmlEncode($this->Budget->CurrentValue);
			$this->Budget->PlaceHolder = RemoveHtml($this->Budget->caption());
			if (strval($this->Budget->EditValue) != "" && is_numeric($this->Budget->EditValue)) {
				$this->Budget->EditValue = FormatNumber($this->Budget->EditValue, -2, -2, -2, -2);
				$this->Budget->OldValue = $this->Budget->EditValue;
			}
			

			// ProgressStatus
			$this->ProgressStatus->EditAttrs["class"] = "form-control";
			$this->ProgressStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProgressStatus->CurrentValue));
			if ($curVal != "")
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
			else
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->Lookup !== NULL && is_array($this->ProgressStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->ProgressStatus->ViewValue !== NULL) { // Load from cache
				$this->ProgressStatus->EditValue = array_values($this->ProgressStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectStatusCode`" . SearchString("=", $this->ProgressStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProgressStatus->EditValue = $arwrk;
			}

			// OutstandingTasks
			$this->OutstandingTasks->EditAttrs["class"] = "form-control";
			$this->OutstandingTasks->EditCustomAttributes = "";
			$this->OutstandingTasks->EditValue = HtmlEncode($this->OutstandingTasks->CurrentValue);
			$this->OutstandingTasks->PlaceHolder = RemoveHtml($this->OutstandingTasks->caption());

			// Add refer script
			// ProvinceCode

			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";

			// ProjectName
			$this->ProjectName->LinkCustomAttributes = "";
			$this->ProjectName->HrefValue = "";

			// ProjectType
			$this->ProjectType->LinkCustomAttributes = "";
			$this->ProjectType->HrefValue = "";

			// ProjectSector
			$this->ProjectSector->LinkCustomAttributes = "";
			$this->ProjectSector->HrefValue = "";

			// Contractors
			$this->Contractors->LinkCustomAttributes = "";
			$this->Contractors->HrefValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";

			// ActualEndDate
			$this->ActualEndDate->LinkCustomAttributes = "";
			$this->ActualEndDate->HrefValue = "";

			// Budget
			$this->Budget->LinkCustomAttributes = "";
			$this->Budget->HrefValue = "";

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";

			// OutstandingTasks
			$this->OutstandingTasks->LinkCustomAttributes = "";
			$this->OutstandingTasks->HrefValue = "";
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
			$this->LACode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// ProjectCode
			$this->ProjectCode->EditAttrs["class"] = "form-control";
			$this->ProjectCode->EditCustomAttributes = "";
			if (!$this->ProjectCode->Raw)
				$this->ProjectCode->CurrentValue = HtmlDecode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->CurrentValue);
			$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());

			// ProjectName
			$this->ProjectName->EditAttrs["class"] = "form-control";
			$this->ProjectName->EditCustomAttributes = "";
			if (!$this->ProjectName->Raw)
				$this->ProjectName->CurrentValue = HtmlDecode($this->ProjectName->CurrentValue);
			$this->ProjectName->EditValue = HtmlEncode($this->ProjectName->CurrentValue);
			$this->ProjectName->PlaceHolder = RemoveHtml($this->ProjectName->caption());

			// ProjectType
			$this->ProjectType->EditAttrs["class"] = "form-control";
			$this->ProjectType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectType->CurrentValue));
			if ($curVal != "")
				$this->ProjectType->ViewValue = $this->ProjectType->lookupCacheOption($curVal);
			else
				$this->ProjectType->ViewValue = $this->ProjectType->Lookup !== NULL && is_array($this->ProjectType->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectType->ViewValue !== NULL) { // Load from cache
				$this->ProjectType->EditValue = array_values($this->ProjectType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectType`" . SearchString("=", $this->ProjectType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProjectType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectType->EditValue = $arwrk;
			}

			// ProjectSector
			$this->ProjectSector->EditAttrs["class"] = "form-control";
			$this->ProjectSector->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProjectSector->CurrentValue));
			if ($curVal != "")
				$this->ProjectSector->ViewValue = $this->ProjectSector->lookupCacheOption($curVal);
			else
				$this->ProjectSector->ViewValue = $this->ProjectSector->Lookup !== NULL && is_array($this->ProjectSector->Lookup->Options) ? $curVal : NULL;
			if ($this->ProjectSector->ViewValue !== NULL) { // Load from cache
				$this->ProjectSector->EditValue = array_values($this->ProjectSector->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectSector`" . SearchString("=", $this->ProjectSector->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProjectSector->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProjectSector->EditValue = $arwrk;
			}

			// Contractors
			$this->Contractors->EditAttrs["class"] = "form-control";
			$this->Contractors->EditCustomAttributes = "";
			$this->Contractors->EditValue = HtmlEncode($this->Contractors->CurrentValue);
			$this->Contractors->PlaceHolder = RemoveHtml($this->Contractors->caption());

			// PlannedStartDate
			$this->PlannedStartDate->EditAttrs["class"] = "form-control";
			$this->PlannedStartDate->EditCustomAttributes = "";
			$this->PlannedStartDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedStartDate->CurrentValue, 8));
			$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

			// PlannedEndDate
			$this->PlannedEndDate->EditAttrs["class"] = "form-control";
			$this->PlannedEndDate->EditCustomAttributes = "";
			$this->PlannedEndDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedEndDate->CurrentValue, 8));
			$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

			// ActualStartDate
			$this->ActualStartDate->EditAttrs["class"] = "form-control";
			$this->ActualStartDate->EditCustomAttributes = "";
			$this->ActualStartDate->EditValue = HtmlEncode(FormatDateTime($this->ActualStartDate->CurrentValue, 8));
			$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

			// ActualEndDate
			$this->ActualEndDate->EditAttrs["class"] = "form-control";
			$this->ActualEndDate->EditCustomAttributes = "";
			$this->ActualEndDate->EditValue = HtmlEncode(FormatDateTime($this->ActualEndDate->CurrentValue, 8));
			$this->ActualEndDate->PlaceHolder = RemoveHtml($this->ActualEndDate->caption());

			// Budget
			$this->Budget->EditAttrs["class"] = "form-control";
			$this->Budget->EditCustomAttributes = "";
			$this->Budget->EditValue = HtmlEncode($this->Budget->CurrentValue);
			$this->Budget->PlaceHolder = RemoveHtml($this->Budget->caption());
			if (strval($this->Budget->EditValue) != "" && is_numeric($this->Budget->EditValue)) {
				$this->Budget->EditValue = FormatNumber($this->Budget->EditValue, -2, -2, -2, -2);
				$this->Budget->OldValue = $this->Budget->EditValue;
			}
			

			// ProgressStatus
			$this->ProgressStatus->EditAttrs["class"] = "form-control";
			$this->ProgressStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProgressStatus->CurrentValue));
			if ($curVal != "")
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
			else
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->Lookup !== NULL && is_array($this->ProgressStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->ProgressStatus->ViewValue !== NULL) { // Load from cache
				$this->ProgressStatus->EditValue = array_values($this->ProgressStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProjectStatusCode`" . SearchString("=", $this->ProgressStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProgressStatus->EditValue = $arwrk;
			}

			// OutstandingTasks
			$this->OutstandingTasks->EditAttrs["class"] = "form-control";
			$this->OutstandingTasks->EditCustomAttributes = "";
			$this->OutstandingTasks->EditValue = HtmlEncode($this->OutstandingTasks->CurrentValue);
			$this->OutstandingTasks->PlaceHolder = RemoveHtml($this->OutstandingTasks->caption());

			// Edit refer script
			// ProvinceCode

			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";

			// ProjectName
			$this->ProjectName->LinkCustomAttributes = "";
			$this->ProjectName->HrefValue = "";

			// ProjectType
			$this->ProjectType->LinkCustomAttributes = "";
			$this->ProjectType->HrefValue = "";

			// ProjectSector
			$this->ProjectSector->LinkCustomAttributes = "";
			$this->ProjectSector->HrefValue = "";

			// Contractors
			$this->Contractors->LinkCustomAttributes = "";
			$this->Contractors->HrefValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";

			// ActualEndDate
			$this->ActualEndDate->LinkCustomAttributes = "";
			$this->ActualEndDate->HrefValue = "";

			// Budget
			$this->Budget->LinkCustomAttributes = "";
			$this->Budget->HrefValue = "";

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";

			// OutstandingTasks
			$this->OutstandingTasks->LinkCustomAttributes = "";
			$this->OutstandingTasks->HrefValue = "";
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
		if ($this->ProjectCode->Required) {
			if (!$this->ProjectCode->IsDetailKey && $this->ProjectCode->FormValue != NULL && $this->ProjectCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectCode->caption(), $this->ProjectCode->RequiredErrorMessage));
			}
		}
		if ($this->ProjectName->Required) {
			if (!$this->ProjectName->IsDetailKey && $this->ProjectName->FormValue != NULL && $this->ProjectName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectName->caption(), $this->ProjectName->RequiredErrorMessage));
			}
		}
		if ($this->ProjectType->Required) {
			if (!$this->ProjectType->IsDetailKey && $this->ProjectType->FormValue != NULL && $this->ProjectType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectType->caption(), $this->ProjectType->RequiredErrorMessage));
			}
		}
		if ($this->ProjectSector->Required) {
			if (!$this->ProjectSector->IsDetailKey && $this->ProjectSector->FormValue != NULL && $this->ProjectSector->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProjectSector->caption(), $this->ProjectSector->RequiredErrorMessage));
			}
		}
		if ($this->Contractors->Required) {
			if (!$this->Contractors->IsDetailKey && $this->Contractors->FormValue != NULL && $this->Contractors->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Contractors->caption(), $this->Contractors->RequiredErrorMessage));
			}
		}
		if ($this->PlannedStartDate->Required) {
			if (!$this->PlannedStartDate->IsDetailKey && $this->PlannedStartDate->FormValue != NULL && $this->PlannedStartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PlannedStartDate->caption(), $this->PlannedStartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PlannedStartDate->FormValue)) {
			AddMessage($FormError, $this->PlannedStartDate->errorMessage());
		}
		if ($this->PlannedEndDate->Required) {
			if (!$this->PlannedEndDate->IsDetailKey && $this->PlannedEndDate->FormValue != NULL && $this->PlannedEndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PlannedEndDate->caption(), $this->PlannedEndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PlannedEndDate->FormValue)) {
			AddMessage($FormError, $this->PlannedEndDate->errorMessage());
		}
		if ($this->ActualStartDate->Required) {
			if (!$this->ActualStartDate->IsDetailKey && $this->ActualStartDate->FormValue != NULL && $this->ActualStartDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualStartDate->caption(), $this->ActualStartDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActualStartDate->FormValue)) {
			AddMessage($FormError, $this->ActualStartDate->errorMessage());
		}
		if ($this->ActualEndDate->Required) {
			if (!$this->ActualEndDate->IsDetailKey && $this->ActualEndDate->FormValue != NULL && $this->ActualEndDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualEndDate->caption(), $this->ActualEndDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActualEndDate->FormValue)) {
			AddMessage($FormError, $this->ActualEndDate->errorMessage());
		}
		if ($this->Budget->Required) {
			if (!$this->Budget->IsDetailKey && $this->Budget->FormValue != NULL && $this->Budget->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Budget->caption(), $this->Budget->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Budget->FormValue)) {
			AddMessage($FormError, $this->Budget->errorMessage());
		}
		if ($this->ProgressStatus->Required) {
			if (!$this->ProgressStatus->IsDetailKey && $this->ProgressStatus->FormValue != NULL && $this->ProgressStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgressStatus->caption(), $this->ProgressStatus->RequiredErrorMessage));
			}
		}
		if ($this->OutstandingTasks->Required) {
			if (!$this->OutstandingTasks->IsDetailKey && $this->OutstandingTasks->FormValue != NULL && $this->OutstandingTasks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutstandingTasks->caption(), $this->OutstandingTasks->RequiredErrorMessage));
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
				$thisKey .= $row['ProjectCode'];
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
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// ProjectCode
			$this->ProjectCode->setDbValueDef($rsnew, $this->ProjectCode->CurrentValue, "", $this->ProjectCode->ReadOnly);

			// ProjectName
			$this->ProjectName->setDbValueDef($rsnew, $this->ProjectName->CurrentValue, "", $this->ProjectName->ReadOnly);

			// ProjectType
			$this->ProjectType->setDbValueDef($rsnew, $this->ProjectType->CurrentValue, 0, $this->ProjectType->ReadOnly);

			// ProjectSector
			$this->ProjectSector->setDbValueDef($rsnew, $this->ProjectSector->CurrentValue, 0, $this->ProjectSector->ReadOnly);

			// Contractors
			$this->Contractors->setDbValueDef($rsnew, $this->Contractors->CurrentValue, NULL, $this->Contractors->ReadOnly);

			// PlannedStartDate
			$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), $this->PlannedStartDate->ReadOnly);

			// PlannedEndDate
			$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0), CurrentDate(), $this->PlannedEndDate->ReadOnly);

			// ActualStartDate
			$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, $this->ActualStartDate->ReadOnly);

			// ActualEndDate
			$this->ActualEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEndDate->CurrentValue, 0), NULL, $this->ActualEndDate->ReadOnly);

			// Budget
			$this->Budget->setDbValueDef($rsnew, $this->Budget->CurrentValue, 0, $this->Budget->ReadOnly);

			// ProgressStatus
			$this->ProgressStatus->setDbValueDef($rsnew, $this->ProgressStatus->CurrentValue, NULL, $this->ProgressStatus->ReadOnly);

			// OutstandingTasks
			$this->OutstandingTasks->setDbValueDef($rsnew, $this->OutstandingTasks->CurrentValue, NULL, $this->OutstandingTasks->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "local_authority") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// ProjectCode
		$this->ProjectCode->setDbValueDef($rsnew, $this->ProjectCode->CurrentValue, "", FALSE);

		// ProjectName
		$this->ProjectName->setDbValueDef($rsnew, $this->ProjectName->CurrentValue, "", FALSE);

		// ProjectType
		$this->ProjectType->setDbValueDef($rsnew, $this->ProjectType->CurrentValue, 0, strval($this->ProjectType->CurrentValue) == "");

		// ProjectSector
		$this->ProjectSector->setDbValueDef($rsnew, $this->ProjectSector->CurrentValue, 0, FALSE);

		// Contractors
		$this->Contractors->setDbValueDef($rsnew, $this->Contractors->CurrentValue, NULL, FALSE);

		// PlannedStartDate
		$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), FALSE);

		// PlannedEndDate
		$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0), CurrentDate(), FALSE);

		// ActualStartDate
		$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, FALSE);

		// ActualEndDate
		$this->ActualEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEndDate->CurrentValue, 0), NULL, FALSE);

		// Budget
		$this->Budget->setDbValueDef($rsnew, $this->Budget->CurrentValue, 0, FALSE);

		// ProgressStatus
		$this->ProgressStatus->setDbValueDef($rsnew, $this->ProgressStatus->CurrentValue, NULL, FALSE);

		// OutstandingTasks
		$this->OutstandingTasks->setDbValueDef($rsnew, $this->OutstandingTasks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ProjectCode']) == "") {
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
		if ($masterTblVar == "local_authority") {
			$this->ProvinceCode->Visible = FALSE;
			if ($GLOBALS["local_authority"]->EventCancelled)
				$this->EventCancelled = TRUE;
			$this->LACode->Visible = FALSE;
			if ($GLOBALS["local_authority"]->EventCancelled)
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
				case "x_ProjectType":
					break;
				case "x_ProjectSector":
					break;
				case "x_FundingSource":
					break;
				case "x_ProgressStatus":
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
						case "x_ProjectType":
							break;
						case "x_ProjectSector":
							break;
						case "x_FundingSource":
							break;
						case "x_ProgressStatus":
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