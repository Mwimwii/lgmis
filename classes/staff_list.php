<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staff_list extends staff
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staff';

	// Page object name
	public $PageObjName = "staff_list";

	// Grid form hidden field names
	public $FormName = "fstafflist";
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

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (staff)
		if (!isset($GLOBALS["staff"]) || get_class($GLOBALS["staff"]) == PROJECT_NAMESPACE . "staff") {
			$GLOBALS["staff"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["staff"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "staffadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "staffdelete.php";
		$this->MultiUpdateUrl = "staffupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staff');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fstafflistsrch";

		// List actions
		$this->ListActions = new ListActions();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $staff;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staff);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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
			$key .= @$ar['EmployeeID'];
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
			$this->EmployeeID->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->LastUserID->Visible = FALSE;
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
	public $staffchildren_Count;
	public $staffdisciplinary_action_Count;
	public $staffdisciplinary_appeal_Count;
	public $staffdisciplinary_case_Count;
	public $staffexperience_Count;
	public $staffprofbodies_Count;
	public $staffqualifications_academic_Count;
	public $staffqualifications_prof_Count;
	public $employment_Count;
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
			if (!$Security->canList()) {
				SetStatus(401); // Unauthorized
				return;
			}
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

		// Create form object
		$CurrentForm = new HttpForm();

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->EmployeeID->setVisibility();
		$this->LACode->setVisibility();
		$this->FormerFileNumber->setVisibility();
		$this->NRC->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->Sex->setVisibility();
		$this->StaffPhoto->Visible = FALSE;
		$this->MaritalStatus->setVisibility();
		$this->MaidenName->setVisibility();
		$this->DateOfBirth->setVisibility();
		$this->AcademicQualification->setVisibility();
		$this->ProfessionalQualification->setVisibility();
		$this->MedicalCondition->setVisibility();
		$this->OtherMedicalConditions->setVisibility();
		$this->PhysicalChallenge->setVisibility();
		$this->PostalAddress->setVisibility();
		$this->PhysicalAddress->setVisibility();
		$this->TownOrVillage->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Fax->setVisibility();
		$this->_Email->setVisibility();
		$this->NumberOfBiologicalChildren->setVisibility();
		$this->NumberOfDependants->setVisibility();
		$this->NextOfKin->setVisibility();
		$this->RelationshipCode->setVisibility();
		$this->NextOfKinMobile->setVisibility();
		$this->NextOfKinEmail->setVisibility();
		$this->SpouseName->setVisibility();
		$this->SpouseNRC->setVisibility();
		$this->SpouseMobile->setVisibility();
		$this->SpouseEmail->setVisibility();
		$this->SpouseResidentialAddress->setVisibility();
		$this->AdditionalInformation->Visible = FALSE;
		$this->LastUserID->Visible = FALSE;
		$this->LastUpdated->Visible = FALSE;
		$this->BankAccountNo->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->BankBranchCode->setVisibility();
		$this->TaxNumber->setVisibility();
		$this->PensionNumber->setVisibility();
		$this->SocialSecurityNo->setVisibility();
		$this->ThirdParties->setVisibility();
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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->Title);
		$this->setupLookupOptions($this->Sex);
		$this->setupLookupOptions($this->MaritalStatus);
		$this->setupLookupOptions($this->AcademicQualification);
		$this->setupLookupOptions($this->ProfessionalQualification);
		$this->setupLookupOptions($this->MedicalCondition);
		$this->setupLookupOptions($this->OtherMedicalConditions);
		$this->setupLookupOptions($this->PhysicalChallenge);
		$this->setupLookupOptions($this->RelationshipCode);
		$this->setupLookupOptions($this->PaymentMethod);
		$this->setupLookupOptions($this->BankBranchCode);
		$this->setupLookupOptions($this->ThirdParties);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(Config("TABLE_START_REC")) !== NULL || Get(Config("TABLE_PAGE_NO")) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

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

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
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

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
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
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

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

		// Begin transaction
		$conn->beginTrans();
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
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
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
			$this->EmployeeID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->EmployeeID->OldValue))
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

		// Begin transaction
		$conn->beginTrans();

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
			$this->setFailureMessage($Language->phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
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
		if ($CurrentForm->hasValue("x_FormerFileNumber") && $CurrentForm->hasValue("o_FormerFileNumber") && $this->FormerFileNumber->CurrentValue != $this->FormerFileNumber->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NRC") && $CurrentForm->hasValue("o_NRC") && $this->NRC->CurrentValue != $this->NRC->OldValue)
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
		if ($CurrentForm->hasValue("x_MaritalStatus") && $CurrentForm->hasValue("o_MaritalStatus") && $this->MaritalStatus->CurrentValue != $this->MaritalStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MaidenName") && $CurrentForm->hasValue("o_MaidenName") && $this->MaidenName->CurrentValue != $this->MaidenName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfBirth") && $CurrentForm->hasValue("o_DateOfBirth") && $this->DateOfBirth->CurrentValue != $this->DateOfBirth->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AcademicQualification") && $CurrentForm->hasValue("o_AcademicQualification") && $this->AcademicQualification->CurrentValue != $this->AcademicQualification->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProfessionalQualification") && $CurrentForm->hasValue("o_ProfessionalQualification") && $this->ProfessionalQualification->CurrentValue != $this->ProfessionalQualification->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MedicalCondition") && $CurrentForm->hasValue("o_MedicalCondition") && $this->MedicalCondition->CurrentValue != $this->MedicalCondition->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OtherMedicalConditions") && $CurrentForm->hasValue("o_OtherMedicalConditions") && $this->OtherMedicalConditions->CurrentValue != $this->OtherMedicalConditions->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PhysicalChallenge") && $CurrentForm->hasValue("o_PhysicalChallenge") && $this->PhysicalChallenge->CurrentValue != $this->PhysicalChallenge->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PostalAddress") && $CurrentForm->hasValue("o_PostalAddress") && $this->PostalAddress->CurrentValue != $this->PostalAddress->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PhysicalAddress") && $CurrentForm->hasValue("o_PhysicalAddress") && $this->PhysicalAddress->CurrentValue != $this->PhysicalAddress->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TownOrVillage") && $CurrentForm->hasValue("o_TownOrVillage") && $this->TownOrVillage->CurrentValue != $this->TownOrVillage->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Telephone") && $CurrentForm->hasValue("o_Telephone") && $this->Telephone->CurrentValue != $this->Telephone->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Mobile") && $CurrentForm->hasValue("o_Mobile") && $this->Mobile->CurrentValue != $this->Mobile->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Fax") && $CurrentForm->hasValue("o_Fax") && $this->Fax->CurrentValue != $this->Fax->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x__Email") && $CurrentForm->hasValue("o__Email") && $this->_Email->CurrentValue != $this->_Email->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NumberOfBiologicalChildren") && $CurrentForm->hasValue("o_NumberOfBiologicalChildren") && $this->NumberOfBiologicalChildren->CurrentValue != $this->NumberOfBiologicalChildren->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NumberOfDependants") && $CurrentForm->hasValue("o_NumberOfDependants") && $this->NumberOfDependants->CurrentValue != $this->NumberOfDependants->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NextOfKin") && $CurrentForm->hasValue("o_NextOfKin") && $this->NextOfKin->CurrentValue != $this->NextOfKin->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RelationshipCode") && $CurrentForm->hasValue("o_RelationshipCode") && $this->RelationshipCode->CurrentValue != $this->RelationshipCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NextOfKinMobile") && $CurrentForm->hasValue("o_NextOfKinMobile") && $this->NextOfKinMobile->CurrentValue != $this->NextOfKinMobile->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NextOfKinEmail") && $CurrentForm->hasValue("o_NextOfKinEmail") && $this->NextOfKinEmail->CurrentValue != $this->NextOfKinEmail->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SpouseName") && $CurrentForm->hasValue("o_SpouseName") && $this->SpouseName->CurrentValue != $this->SpouseName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SpouseNRC") && $CurrentForm->hasValue("o_SpouseNRC") && $this->SpouseNRC->CurrentValue != $this->SpouseNRC->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SpouseMobile") && $CurrentForm->hasValue("o_SpouseMobile") && $this->SpouseMobile->CurrentValue != $this->SpouseMobile->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SpouseEmail") && $CurrentForm->hasValue("o_SpouseEmail") && $this->SpouseEmail->CurrentValue != $this->SpouseEmail->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SpouseResidentialAddress") && $CurrentForm->hasValue("o_SpouseResidentialAddress") && $this->SpouseResidentialAddress->CurrentValue != $this->SpouseResidentialAddress->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BankAccountNo") && $CurrentForm->hasValue("o_BankAccountNo") && $this->BankAccountNo->CurrentValue != $this->BankAccountNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentMethod") && $CurrentForm->hasValue("o_PaymentMethod") && $this->PaymentMethod->CurrentValue != $this->PaymentMethod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BankBranchCode") && $CurrentForm->hasValue("o_BankBranchCode") && $this->BankBranchCode->CurrentValue != $this->BankBranchCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TaxNumber") && $CurrentForm->hasValue("o_TaxNumber") && $this->TaxNumber->CurrentValue != $this->TaxNumber->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PensionNumber") && $CurrentForm->hasValue("o_PensionNumber") && $this->PensionNumber->CurrentValue != $this->PensionNumber->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SocialSecurityNo") && $CurrentForm->hasValue("o_SocialSecurityNo") && $this->SocialSecurityNo->CurrentValue != $this->SocialSecurityNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ThirdParties") && $CurrentForm->hasValue("o_ThirdParties") && $this->ThirdParties->CurrentValue != $this->ThirdParties->OldValue)
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

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Load server side filters
		if (Config("SEARCH_FILTER_OPTION") == "Server" && isset($UserProfile))
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fstafflistsrch");
		$filterList = Concat($filterList, $this->EmployeeID->AdvancedSearch->toJson(), ","); // Field EmployeeID
		$filterList = Concat($filterList, $this->LACode->AdvancedSearch->toJson(), ","); // Field LACode
		$filterList = Concat($filterList, $this->FormerFileNumber->AdvancedSearch->toJson(), ","); // Field FormerFileNumber
		$filterList = Concat($filterList, $this->NRC->AdvancedSearch->toJson(), ","); // Field NRC
		$filterList = Concat($filterList, $this->Title->AdvancedSearch->toJson(), ","); // Field Title
		$filterList = Concat($filterList, $this->Surname->AdvancedSearch->toJson(), ","); // Field Surname
		$filterList = Concat($filterList, $this->FirstName->AdvancedSearch->toJson(), ","); // Field FirstName
		$filterList = Concat($filterList, $this->MiddleName->AdvancedSearch->toJson(), ","); // Field MiddleName
		$filterList = Concat($filterList, $this->Sex->AdvancedSearch->toJson(), ","); // Field Sex
		$filterList = Concat($filterList, $this->MaritalStatus->AdvancedSearch->toJson(), ","); // Field MaritalStatus
		$filterList = Concat($filterList, $this->MaidenName->AdvancedSearch->toJson(), ","); // Field MaidenName
		$filterList = Concat($filterList, $this->DateOfBirth->AdvancedSearch->toJson(), ","); // Field DateOfBirth
		$filterList = Concat($filterList, $this->AcademicQualification->AdvancedSearch->toJson(), ","); // Field AcademicQualification
		$filterList = Concat($filterList, $this->ProfessionalQualification->AdvancedSearch->toJson(), ","); // Field ProfessionalQualification
		$filterList = Concat($filterList, $this->MedicalCondition->AdvancedSearch->toJson(), ","); // Field MedicalCondition
		$filterList = Concat($filterList, $this->OtherMedicalConditions->AdvancedSearch->toJson(), ","); // Field OtherMedicalConditions
		$filterList = Concat($filterList, $this->PhysicalChallenge->AdvancedSearch->toJson(), ","); // Field PhysicalChallenge
		$filterList = Concat($filterList, $this->PostalAddress->AdvancedSearch->toJson(), ","); // Field PostalAddress
		$filterList = Concat($filterList, $this->PhysicalAddress->AdvancedSearch->toJson(), ","); // Field PhysicalAddress
		$filterList = Concat($filterList, $this->TownOrVillage->AdvancedSearch->toJson(), ","); // Field TownOrVillage
		$filterList = Concat($filterList, $this->Telephone->AdvancedSearch->toJson(), ","); // Field Telephone
		$filterList = Concat($filterList, $this->Mobile->AdvancedSearch->toJson(), ","); // Field Mobile
		$filterList = Concat($filterList, $this->Fax->AdvancedSearch->toJson(), ","); // Field Fax
		$filterList = Concat($filterList, $this->_Email->AdvancedSearch->toJson(), ","); // Field Email
		$filterList = Concat($filterList, $this->NumberOfBiologicalChildren->AdvancedSearch->toJson(), ","); // Field NumberOfBiologicalChildren
		$filterList = Concat($filterList, $this->NumberOfDependants->AdvancedSearch->toJson(), ","); // Field NumberOfDependants
		$filterList = Concat($filterList, $this->NextOfKin->AdvancedSearch->toJson(), ","); // Field NextOfKin
		$filterList = Concat($filterList, $this->RelationshipCode->AdvancedSearch->toJson(), ","); // Field RelationshipCode
		$filterList = Concat($filterList, $this->NextOfKinMobile->AdvancedSearch->toJson(), ","); // Field NextOfKinMobile
		$filterList = Concat($filterList, $this->NextOfKinEmail->AdvancedSearch->toJson(), ","); // Field NextOfKinEmail
		$filterList = Concat($filterList, $this->SpouseName->AdvancedSearch->toJson(), ","); // Field SpouseName
		$filterList = Concat($filterList, $this->SpouseNRC->AdvancedSearch->toJson(), ","); // Field SpouseNRC
		$filterList = Concat($filterList, $this->SpouseMobile->AdvancedSearch->toJson(), ","); // Field SpouseMobile
		$filterList = Concat($filterList, $this->SpouseEmail->AdvancedSearch->toJson(), ","); // Field SpouseEmail
		$filterList = Concat($filterList, $this->SpouseResidentialAddress->AdvancedSearch->toJson(), ","); // Field SpouseResidentialAddress
		$filterList = Concat($filterList, $this->AdditionalInformation->AdvancedSearch->toJson(), ","); // Field AdditionalInformation
		$filterList = Concat($filterList, $this->LastUserID->AdvancedSearch->toJson(), ","); // Field LastUserID
		$filterList = Concat($filterList, $this->LastUpdated->AdvancedSearch->toJson(), ","); // Field LastUpdated
		$filterList = Concat($filterList, $this->BankAccountNo->AdvancedSearch->toJson(), ","); // Field BankAccountNo
		$filterList = Concat($filterList, $this->PaymentMethod->AdvancedSearch->toJson(), ","); // Field PaymentMethod
		$filterList = Concat($filterList, $this->BankBranchCode->AdvancedSearch->toJson(), ","); // Field BankBranchCode
		$filterList = Concat($filterList, $this->TaxNumber->AdvancedSearch->toJson(), ","); // Field TaxNumber
		$filterList = Concat($filterList, $this->PensionNumber->AdvancedSearch->toJson(), ","); // Field PensionNumber
		$filterList = Concat($filterList, $this->SocialSecurityNo->AdvancedSearch->toJson(), ","); // Field SocialSecurityNo
		$filterList = Concat($filterList, $this->ThirdParties->AdvancedSearch->toJson(), ","); // Field ThirdParties
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fstafflistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field EmployeeID
		$this->EmployeeID->AdvancedSearch->SearchValue = @$filter["x_EmployeeID"];
		$this->EmployeeID->AdvancedSearch->SearchOperator = @$filter["z_EmployeeID"];
		$this->EmployeeID->AdvancedSearch->SearchCondition = @$filter["v_EmployeeID"];
		$this->EmployeeID->AdvancedSearch->SearchValue2 = @$filter["y_EmployeeID"];
		$this->EmployeeID->AdvancedSearch->SearchOperator2 = @$filter["w_EmployeeID"];
		$this->EmployeeID->AdvancedSearch->save();

		// Field LACode
		$this->LACode->AdvancedSearch->SearchValue = @$filter["x_LACode"];
		$this->LACode->AdvancedSearch->SearchOperator = @$filter["z_LACode"];
		$this->LACode->AdvancedSearch->SearchCondition = @$filter["v_LACode"];
		$this->LACode->AdvancedSearch->SearchValue2 = @$filter["y_LACode"];
		$this->LACode->AdvancedSearch->SearchOperator2 = @$filter["w_LACode"];
		$this->LACode->AdvancedSearch->save();

		// Field FormerFileNumber
		$this->FormerFileNumber->AdvancedSearch->SearchValue = @$filter["x_FormerFileNumber"];
		$this->FormerFileNumber->AdvancedSearch->SearchOperator = @$filter["z_FormerFileNumber"];
		$this->FormerFileNumber->AdvancedSearch->SearchCondition = @$filter["v_FormerFileNumber"];
		$this->FormerFileNumber->AdvancedSearch->SearchValue2 = @$filter["y_FormerFileNumber"];
		$this->FormerFileNumber->AdvancedSearch->SearchOperator2 = @$filter["w_FormerFileNumber"];
		$this->FormerFileNumber->AdvancedSearch->save();

		// Field NRC
		$this->NRC->AdvancedSearch->SearchValue = @$filter["x_NRC"];
		$this->NRC->AdvancedSearch->SearchOperator = @$filter["z_NRC"];
		$this->NRC->AdvancedSearch->SearchCondition = @$filter["v_NRC"];
		$this->NRC->AdvancedSearch->SearchValue2 = @$filter["y_NRC"];
		$this->NRC->AdvancedSearch->SearchOperator2 = @$filter["w_NRC"];
		$this->NRC->AdvancedSearch->save();

		// Field Title
		$this->Title->AdvancedSearch->SearchValue = @$filter["x_Title"];
		$this->Title->AdvancedSearch->SearchOperator = @$filter["z_Title"];
		$this->Title->AdvancedSearch->SearchCondition = @$filter["v_Title"];
		$this->Title->AdvancedSearch->SearchValue2 = @$filter["y_Title"];
		$this->Title->AdvancedSearch->SearchOperator2 = @$filter["w_Title"];
		$this->Title->AdvancedSearch->save();

		// Field Surname
		$this->Surname->AdvancedSearch->SearchValue = @$filter["x_Surname"];
		$this->Surname->AdvancedSearch->SearchOperator = @$filter["z_Surname"];
		$this->Surname->AdvancedSearch->SearchCondition = @$filter["v_Surname"];
		$this->Surname->AdvancedSearch->SearchValue2 = @$filter["y_Surname"];
		$this->Surname->AdvancedSearch->SearchOperator2 = @$filter["w_Surname"];
		$this->Surname->AdvancedSearch->save();

		// Field FirstName
		$this->FirstName->AdvancedSearch->SearchValue = @$filter["x_FirstName"];
		$this->FirstName->AdvancedSearch->SearchOperator = @$filter["z_FirstName"];
		$this->FirstName->AdvancedSearch->SearchCondition = @$filter["v_FirstName"];
		$this->FirstName->AdvancedSearch->SearchValue2 = @$filter["y_FirstName"];
		$this->FirstName->AdvancedSearch->SearchOperator2 = @$filter["w_FirstName"];
		$this->FirstName->AdvancedSearch->save();

		// Field MiddleName
		$this->MiddleName->AdvancedSearch->SearchValue = @$filter["x_MiddleName"];
		$this->MiddleName->AdvancedSearch->SearchOperator = @$filter["z_MiddleName"];
		$this->MiddleName->AdvancedSearch->SearchCondition = @$filter["v_MiddleName"];
		$this->MiddleName->AdvancedSearch->SearchValue2 = @$filter["y_MiddleName"];
		$this->MiddleName->AdvancedSearch->SearchOperator2 = @$filter["w_MiddleName"];
		$this->MiddleName->AdvancedSearch->save();

		// Field Sex
		$this->Sex->AdvancedSearch->SearchValue = @$filter["x_Sex"];
		$this->Sex->AdvancedSearch->SearchOperator = @$filter["z_Sex"];
		$this->Sex->AdvancedSearch->SearchCondition = @$filter["v_Sex"];
		$this->Sex->AdvancedSearch->SearchValue2 = @$filter["y_Sex"];
		$this->Sex->AdvancedSearch->SearchOperator2 = @$filter["w_Sex"];
		$this->Sex->AdvancedSearch->save();

		// Field MaritalStatus
		$this->MaritalStatus->AdvancedSearch->SearchValue = @$filter["x_MaritalStatus"];
		$this->MaritalStatus->AdvancedSearch->SearchOperator = @$filter["z_MaritalStatus"];
		$this->MaritalStatus->AdvancedSearch->SearchCondition = @$filter["v_MaritalStatus"];
		$this->MaritalStatus->AdvancedSearch->SearchValue2 = @$filter["y_MaritalStatus"];
		$this->MaritalStatus->AdvancedSearch->SearchOperator2 = @$filter["w_MaritalStatus"];
		$this->MaritalStatus->AdvancedSearch->save();

		// Field MaidenName
		$this->MaidenName->AdvancedSearch->SearchValue = @$filter["x_MaidenName"];
		$this->MaidenName->AdvancedSearch->SearchOperator = @$filter["z_MaidenName"];
		$this->MaidenName->AdvancedSearch->SearchCondition = @$filter["v_MaidenName"];
		$this->MaidenName->AdvancedSearch->SearchValue2 = @$filter["y_MaidenName"];
		$this->MaidenName->AdvancedSearch->SearchOperator2 = @$filter["w_MaidenName"];
		$this->MaidenName->AdvancedSearch->save();

		// Field DateOfBirth
		$this->DateOfBirth->AdvancedSearch->SearchValue = @$filter["x_DateOfBirth"];
		$this->DateOfBirth->AdvancedSearch->SearchOperator = @$filter["z_DateOfBirth"];
		$this->DateOfBirth->AdvancedSearch->SearchCondition = @$filter["v_DateOfBirth"];
		$this->DateOfBirth->AdvancedSearch->SearchValue2 = @$filter["y_DateOfBirth"];
		$this->DateOfBirth->AdvancedSearch->SearchOperator2 = @$filter["w_DateOfBirth"];
		$this->DateOfBirth->AdvancedSearch->save();

		// Field AcademicQualification
		$this->AcademicQualification->AdvancedSearch->SearchValue = @$filter["x_AcademicQualification"];
		$this->AcademicQualification->AdvancedSearch->SearchOperator = @$filter["z_AcademicQualification"];
		$this->AcademicQualification->AdvancedSearch->SearchCondition = @$filter["v_AcademicQualification"];
		$this->AcademicQualification->AdvancedSearch->SearchValue2 = @$filter["y_AcademicQualification"];
		$this->AcademicQualification->AdvancedSearch->SearchOperator2 = @$filter["w_AcademicQualification"];
		$this->AcademicQualification->AdvancedSearch->save();

		// Field ProfessionalQualification
		$this->ProfessionalQualification->AdvancedSearch->SearchValue = @$filter["x_ProfessionalQualification"];
		$this->ProfessionalQualification->AdvancedSearch->SearchOperator = @$filter["z_ProfessionalQualification"];
		$this->ProfessionalQualification->AdvancedSearch->SearchCondition = @$filter["v_ProfessionalQualification"];
		$this->ProfessionalQualification->AdvancedSearch->SearchValue2 = @$filter["y_ProfessionalQualification"];
		$this->ProfessionalQualification->AdvancedSearch->SearchOperator2 = @$filter["w_ProfessionalQualification"];
		$this->ProfessionalQualification->AdvancedSearch->save();

		// Field MedicalCondition
		$this->MedicalCondition->AdvancedSearch->SearchValue = @$filter["x_MedicalCondition"];
		$this->MedicalCondition->AdvancedSearch->SearchOperator = @$filter["z_MedicalCondition"];
		$this->MedicalCondition->AdvancedSearch->SearchCondition = @$filter["v_MedicalCondition"];
		$this->MedicalCondition->AdvancedSearch->SearchValue2 = @$filter["y_MedicalCondition"];
		$this->MedicalCondition->AdvancedSearch->SearchOperator2 = @$filter["w_MedicalCondition"];
		$this->MedicalCondition->AdvancedSearch->save();

		// Field OtherMedicalConditions
		$this->OtherMedicalConditions->AdvancedSearch->SearchValue = @$filter["x_OtherMedicalConditions"];
		$this->OtherMedicalConditions->AdvancedSearch->SearchOperator = @$filter["z_OtherMedicalConditions"];
		$this->OtherMedicalConditions->AdvancedSearch->SearchCondition = @$filter["v_OtherMedicalConditions"];
		$this->OtherMedicalConditions->AdvancedSearch->SearchValue2 = @$filter["y_OtherMedicalConditions"];
		$this->OtherMedicalConditions->AdvancedSearch->SearchOperator2 = @$filter["w_OtherMedicalConditions"];
		$this->OtherMedicalConditions->AdvancedSearch->save();

		// Field PhysicalChallenge
		$this->PhysicalChallenge->AdvancedSearch->SearchValue = @$filter["x_PhysicalChallenge"];
		$this->PhysicalChallenge->AdvancedSearch->SearchOperator = @$filter["z_PhysicalChallenge"];
		$this->PhysicalChallenge->AdvancedSearch->SearchCondition = @$filter["v_PhysicalChallenge"];
		$this->PhysicalChallenge->AdvancedSearch->SearchValue2 = @$filter["y_PhysicalChallenge"];
		$this->PhysicalChallenge->AdvancedSearch->SearchOperator2 = @$filter["w_PhysicalChallenge"];
		$this->PhysicalChallenge->AdvancedSearch->save();

		// Field PostalAddress
		$this->PostalAddress->AdvancedSearch->SearchValue = @$filter["x_PostalAddress"];
		$this->PostalAddress->AdvancedSearch->SearchOperator = @$filter["z_PostalAddress"];
		$this->PostalAddress->AdvancedSearch->SearchCondition = @$filter["v_PostalAddress"];
		$this->PostalAddress->AdvancedSearch->SearchValue2 = @$filter["y_PostalAddress"];
		$this->PostalAddress->AdvancedSearch->SearchOperator2 = @$filter["w_PostalAddress"];
		$this->PostalAddress->AdvancedSearch->save();

		// Field PhysicalAddress
		$this->PhysicalAddress->AdvancedSearch->SearchValue = @$filter["x_PhysicalAddress"];
		$this->PhysicalAddress->AdvancedSearch->SearchOperator = @$filter["z_PhysicalAddress"];
		$this->PhysicalAddress->AdvancedSearch->SearchCondition = @$filter["v_PhysicalAddress"];
		$this->PhysicalAddress->AdvancedSearch->SearchValue2 = @$filter["y_PhysicalAddress"];
		$this->PhysicalAddress->AdvancedSearch->SearchOperator2 = @$filter["w_PhysicalAddress"];
		$this->PhysicalAddress->AdvancedSearch->save();

		// Field TownOrVillage
		$this->TownOrVillage->AdvancedSearch->SearchValue = @$filter["x_TownOrVillage"];
		$this->TownOrVillage->AdvancedSearch->SearchOperator = @$filter["z_TownOrVillage"];
		$this->TownOrVillage->AdvancedSearch->SearchCondition = @$filter["v_TownOrVillage"];
		$this->TownOrVillage->AdvancedSearch->SearchValue2 = @$filter["y_TownOrVillage"];
		$this->TownOrVillage->AdvancedSearch->SearchOperator2 = @$filter["w_TownOrVillage"];
		$this->TownOrVillage->AdvancedSearch->save();

		// Field Telephone
		$this->Telephone->AdvancedSearch->SearchValue = @$filter["x_Telephone"];
		$this->Telephone->AdvancedSearch->SearchOperator = @$filter["z_Telephone"];
		$this->Telephone->AdvancedSearch->SearchCondition = @$filter["v_Telephone"];
		$this->Telephone->AdvancedSearch->SearchValue2 = @$filter["y_Telephone"];
		$this->Telephone->AdvancedSearch->SearchOperator2 = @$filter["w_Telephone"];
		$this->Telephone->AdvancedSearch->save();

		// Field Mobile
		$this->Mobile->AdvancedSearch->SearchValue = @$filter["x_Mobile"];
		$this->Mobile->AdvancedSearch->SearchOperator = @$filter["z_Mobile"];
		$this->Mobile->AdvancedSearch->SearchCondition = @$filter["v_Mobile"];
		$this->Mobile->AdvancedSearch->SearchValue2 = @$filter["y_Mobile"];
		$this->Mobile->AdvancedSearch->SearchOperator2 = @$filter["w_Mobile"];
		$this->Mobile->AdvancedSearch->save();

		// Field Fax
		$this->Fax->AdvancedSearch->SearchValue = @$filter["x_Fax"];
		$this->Fax->AdvancedSearch->SearchOperator = @$filter["z_Fax"];
		$this->Fax->AdvancedSearch->SearchCondition = @$filter["v_Fax"];
		$this->Fax->AdvancedSearch->SearchValue2 = @$filter["y_Fax"];
		$this->Fax->AdvancedSearch->SearchOperator2 = @$filter["w_Fax"];
		$this->Fax->AdvancedSearch->save();

		// Field Email
		$this->_Email->AdvancedSearch->SearchValue = @$filter["x__Email"];
		$this->_Email->AdvancedSearch->SearchOperator = @$filter["z__Email"];
		$this->_Email->AdvancedSearch->SearchCondition = @$filter["v__Email"];
		$this->_Email->AdvancedSearch->SearchValue2 = @$filter["y__Email"];
		$this->_Email->AdvancedSearch->SearchOperator2 = @$filter["w__Email"];
		$this->_Email->AdvancedSearch->save();

		// Field NumberOfBiologicalChildren
		$this->NumberOfBiologicalChildren->AdvancedSearch->SearchValue = @$filter["x_NumberOfBiologicalChildren"];
		$this->NumberOfBiologicalChildren->AdvancedSearch->SearchOperator = @$filter["z_NumberOfBiologicalChildren"];
		$this->NumberOfBiologicalChildren->AdvancedSearch->SearchCondition = @$filter["v_NumberOfBiologicalChildren"];
		$this->NumberOfBiologicalChildren->AdvancedSearch->SearchValue2 = @$filter["y_NumberOfBiologicalChildren"];
		$this->NumberOfBiologicalChildren->AdvancedSearch->SearchOperator2 = @$filter["w_NumberOfBiologicalChildren"];
		$this->NumberOfBiologicalChildren->AdvancedSearch->save();

		// Field NumberOfDependants
		$this->NumberOfDependants->AdvancedSearch->SearchValue = @$filter["x_NumberOfDependants"];
		$this->NumberOfDependants->AdvancedSearch->SearchOperator = @$filter["z_NumberOfDependants"];
		$this->NumberOfDependants->AdvancedSearch->SearchCondition = @$filter["v_NumberOfDependants"];
		$this->NumberOfDependants->AdvancedSearch->SearchValue2 = @$filter["y_NumberOfDependants"];
		$this->NumberOfDependants->AdvancedSearch->SearchOperator2 = @$filter["w_NumberOfDependants"];
		$this->NumberOfDependants->AdvancedSearch->save();

		// Field NextOfKin
		$this->NextOfKin->AdvancedSearch->SearchValue = @$filter["x_NextOfKin"];
		$this->NextOfKin->AdvancedSearch->SearchOperator = @$filter["z_NextOfKin"];
		$this->NextOfKin->AdvancedSearch->SearchCondition = @$filter["v_NextOfKin"];
		$this->NextOfKin->AdvancedSearch->SearchValue2 = @$filter["y_NextOfKin"];
		$this->NextOfKin->AdvancedSearch->SearchOperator2 = @$filter["w_NextOfKin"];
		$this->NextOfKin->AdvancedSearch->save();

		// Field RelationshipCode
		$this->RelationshipCode->AdvancedSearch->SearchValue = @$filter["x_RelationshipCode"];
		$this->RelationshipCode->AdvancedSearch->SearchOperator = @$filter["z_RelationshipCode"];
		$this->RelationshipCode->AdvancedSearch->SearchCondition = @$filter["v_RelationshipCode"];
		$this->RelationshipCode->AdvancedSearch->SearchValue2 = @$filter["y_RelationshipCode"];
		$this->RelationshipCode->AdvancedSearch->SearchOperator2 = @$filter["w_RelationshipCode"];
		$this->RelationshipCode->AdvancedSearch->save();

		// Field NextOfKinMobile
		$this->NextOfKinMobile->AdvancedSearch->SearchValue = @$filter["x_NextOfKinMobile"];
		$this->NextOfKinMobile->AdvancedSearch->SearchOperator = @$filter["z_NextOfKinMobile"];
		$this->NextOfKinMobile->AdvancedSearch->SearchCondition = @$filter["v_NextOfKinMobile"];
		$this->NextOfKinMobile->AdvancedSearch->SearchValue2 = @$filter["y_NextOfKinMobile"];
		$this->NextOfKinMobile->AdvancedSearch->SearchOperator2 = @$filter["w_NextOfKinMobile"];
		$this->NextOfKinMobile->AdvancedSearch->save();

		// Field NextOfKinEmail
		$this->NextOfKinEmail->AdvancedSearch->SearchValue = @$filter["x_NextOfKinEmail"];
		$this->NextOfKinEmail->AdvancedSearch->SearchOperator = @$filter["z_NextOfKinEmail"];
		$this->NextOfKinEmail->AdvancedSearch->SearchCondition = @$filter["v_NextOfKinEmail"];
		$this->NextOfKinEmail->AdvancedSearch->SearchValue2 = @$filter["y_NextOfKinEmail"];
		$this->NextOfKinEmail->AdvancedSearch->SearchOperator2 = @$filter["w_NextOfKinEmail"];
		$this->NextOfKinEmail->AdvancedSearch->save();

		// Field SpouseName
		$this->SpouseName->AdvancedSearch->SearchValue = @$filter["x_SpouseName"];
		$this->SpouseName->AdvancedSearch->SearchOperator = @$filter["z_SpouseName"];
		$this->SpouseName->AdvancedSearch->SearchCondition = @$filter["v_SpouseName"];
		$this->SpouseName->AdvancedSearch->SearchValue2 = @$filter["y_SpouseName"];
		$this->SpouseName->AdvancedSearch->SearchOperator2 = @$filter["w_SpouseName"];
		$this->SpouseName->AdvancedSearch->save();

		// Field SpouseNRC
		$this->SpouseNRC->AdvancedSearch->SearchValue = @$filter["x_SpouseNRC"];
		$this->SpouseNRC->AdvancedSearch->SearchOperator = @$filter["z_SpouseNRC"];
		$this->SpouseNRC->AdvancedSearch->SearchCondition = @$filter["v_SpouseNRC"];
		$this->SpouseNRC->AdvancedSearch->SearchValue2 = @$filter["y_SpouseNRC"];
		$this->SpouseNRC->AdvancedSearch->SearchOperator2 = @$filter["w_SpouseNRC"];
		$this->SpouseNRC->AdvancedSearch->save();

		// Field SpouseMobile
		$this->SpouseMobile->AdvancedSearch->SearchValue = @$filter["x_SpouseMobile"];
		$this->SpouseMobile->AdvancedSearch->SearchOperator = @$filter["z_SpouseMobile"];
		$this->SpouseMobile->AdvancedSearch->SearchCondition = @$filter["v_SpouseMobile"];
		$this->SpouseMobile->AdvancedSearch->SearchValue2 = @$filter["y_SpouseMobile"];
		$this->SpouseMobile->AdvancedSearch->SearchOperator2 = @$filter["w_SpouseMobile"];
		$this->SpouseMobile->AdvancedSearch->save();

		// Field SpouseEmail
		$this->SpouseEmail->AdvancedSearch->SearchValue = @$filter["x_SpouseEmail"];
		$this->SpouseEmail->AdvancedSearch->SearchOperator = @$filter["z_SpouseEmail"];
		$this->SpouseEmail->AdvancedSearch->SearchCondition = @$filter["v_SpouseEmail"];
		$this->SpouseEmail->AdvancedSearch->SearchValue2 = @$filter["y_SpouseEmail"];
		$this->SpouseEmail->AdvancedSearch->SearchOperator2 = @$filter["w_SpouseEmail"];
		$this->SpouseEmail->AdvancedSearch->save();

		// Field SpouseResidentialAddress
		$this->SpouseResidentialAddress->AdvancedSearch->SearchValue = @$filter["x_SpouseResidentialAddress"];
		$this->SpouseResidentialAddress->AdvancedSearch->SearchOperator = @$filter["z_SpouseResidentialAddress"];
		$this->SpouseResidentialAddress->AdvancedSearch->SearchCondition = @$filter["v_SpouseResidentialAddress"];
		$this->SpouseResidentialAddress->AdvancedSearch->SearchValue2 = @$filter["y_SpouseResidentialAddress"];
		$this->SpouseResidentialAddress->AdvancedSearch->SearchOperator2 = @$filter["w_SpouseResidentialAddress"];
		$this->SpouseResidentialAddress->AdvancedSearch->save();

		// Field AdditionalInformation
		$this->AdditionalInformation->AdvancedSearch->SearchValue = @$filter["x_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchOperator = @$filter["z_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchCondition = @$filter["v_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchValue2 = @$filter["y_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchOperator2 = @$filter["w_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->save();

		// Field LastUserID
		$this->LastUserID->AdvancedSearch->SearchValue = @$filter["x_LastUserID"];
		$this->LastUserID->AdvancedSearch->SearchOperator = @$filter["z_LastUserID"];
		$this->LastUserID->AdvancedSearch->SearchCondition = @$filter["v_LastUserID"];
		$this->LastUserID->AdvancedSearch->SearchValue2 = @$filter["y_LastUserID"];
		$this->LastUserID->AdvancedSearch->SearchOperator2 = @$filter["w_LastUserID"];
		$this->LastUserID->AdvancedSearch->save();

		// Field LastUpdated
		$this->LastUpdated->AdvancedSearch->SearchValue = @$filter["x_LastUpdated"];
		$this->LastUpdated->AdvancedSearch->SearchOperator = @$filter["z_LastUpdated"];
		$this->LastUpdated->AdvancedSearch->SearchCondition = @$filter["v_LastUpdated"];
		$this->LastUpdated->AdvancedSearch->SearchValue2 = @$filter["y_LastUpdated"];
		$this->LastUpdated->AdvancedSearch->SearchOperator2 = @$filter["w_LastUpdated"];
		$this->LastUpdated->AdvancedSearch->save();

		// Field BankAccountNo
		$this->BankAccountNo->AdvancedSearch->SearchValue = @$filter["x_BankAccountNo"];
		$this->BankAccountNo->AdvancedSearch->SearchOperator = @$filter["z_BankAccountNo"];
		$this->BankAccountNo->AdvancedSearch->SearchCondition = @$filter["v_BankAccountNo"];
		$this->BankAccountNo->AdvancedSearch->SearchValue2 = @$filter["y_BankAccountNo"];
		$this->BankAccountNo->AdvancedSearch->SearchOperator2 = @$filter["w_BankAccountNo"];
		$this->BankAccountNo->AdvancedSearch->save();

		// Field PaymentMethod
		$this->PaymentMethod->AdvancedSearch->SearchValue = @$filter["x_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchOperator = @$filter["z_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchCondition = @$filter["v_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchValue2 = @$filter["y_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchOperator2 = @$filter["w_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->save();

		// Field BankBranchCode
		$this->BankBranchCode->AdvancedSearch->SearchValue = @$filter["x_BankBranchCode"];
		$this->BankBranchCode->AdvancedSearch->SearchOperator = @$filter["z_BankBranchCode"];
		$this->BankBranchCode->AdvancedSearch->SearchCondition = @$filter["v_BankBranchCode"];
		$this->BankBranchCode->AdvancedSearch->SearchValue2 = @$filter["y_BankBranchCode"];
		$this->BankBranchCode->AdvancedSearch->SearchOperator2 = @$filter["w_BankBranchCode"];
		$this->BankBranchCode->AdvancedSearch->save();

		// Field TaxNumber
		$this->TaxNumber->AdvancedSearch->SearchValue = @$filter["x_TaxNumber"];
		$this->TaxNumber->AdvancedSearch->SearchOperator = @$filter["z_TaxNumber"];
		$this->TaxNumber->AdvancedSearch->SearchCondition = @$filter["v_TaxNumber"];
		$this->TaxNumber->AdvancedSearch->SearchValue2 = @$filter["y_TaxNumber"];
		$this->TaxNumber->AdvancedSearch->SearchOperator2 = @$filter["w_TaxNumber"];
		$this->TaxNumber->AdvancedSearch->save();

		// Field PensionNumber
		$this->PensionNumber->AdvancedSearch->SearchValue = @$filter["x_PensionNumber"];
		$this->PensionNumber->AdvancedSearch->SearchOperator = @$filter["z_PensionNumber"];
		$this->PensionNumber->AdvancedSearch->SearchCondition = @$filter["v_PensionNumber"];
		$this->PensionNumber->AdvancedSearch->SearchValue2 = @$filter["y_PensionNumber"];
		$this->PensionNumber->AdvancedSearch->SearchOperator2 = @$filter["w_PensionNumber"];
		$this->PensionNumber->AdvancedSearch->save();

		// Field SocialSecurityNo
		$this->SocialSecurityNo->AdvancedSearch->SearchValue = @$filter["x_SocialSecurityNo"];
		$this->SocialSecurityNo->AdvancedSearch->SearchOperator = @$filter["z_SocialSecurityNo"];
		$this->SocialSecurityNo->AdvancedSearch->SearchCondition = @$filter["v_SocialSecurityNo"];
		$this->SocialSecurityNo->AdvancedSearch->SearchValue2 = @$filter["y_SocialSecurityNo"];
		$this->SocialSecurityNo->AdvancedSearch->SearchOperator2 = @$filter["w_SocialSecurityNo"];
		$this->SocialSecurityNo->AdvancedSearch->save();

		// Field ThirdParties
		$this->ThirdParties->AdvancedSearch->SearchValue = @$filter["x_ThirdParties"];
		$this->ThirdParties->AdvancedSearch->SearchOperator = @$filter["z_ThirdParties"];
		$this->ThirdParties->AdvancedSearch->SearchCondition = @$filter["v_ThirdParties"];
		$this->ThirdParties->AdvancedSearch->SearchValue2 = @$filter["y_ThirdParties"];
		$this->ThirdParties->AdvancedSearch->SearchOperator2 = @$filter["w_ThirdParties"];
		$this->ThirdParties->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->EmployeeID, $default, FALSE); // EmployeeID
		$this->buildSearchSql($where, $this->LACode, $default, FALSE); // LACode
		$this->buildSearchSql($where, $this->FormerFileNumber, $default, FALSE); // FormerFileNumber
		$this->buildSearchSql($where, $this->NRC, $default, FALSE); // NRC
		$this->buildSearchSql($where, $this->Title, $default, FALSE); // Title
		$this->buildSearchSql($where, $this->Surname, $default, FALSE); // Surname
		$this->buildSearchSql($where, $this->FirstName, $default, FALSE); // FirstName
		$this->buildSearchSql($where, $this->MiddleName, $default, FALSE); // MiddleName
		$this->buildSearchSql($where, $this->Sex, $default, FALSE); // Sex
		$this->buildSearchSql($where, $this->MaritalStatus, $default, FALSE); // MaritalStatus
		$this->buildSearchSql($where, $this->MaidenName, $default, FALSE); // MaidenName
		$this->buildSearchSql($where, $this->DateOfBirth, $default, FALSE); // DateOfBirth
		$this->buildSearchSql($where, $this->AcademicQualification, $default, FALSE); // AcademicQualification
		$this->buildSearchSql($where, $this->ProfessionalQualification, $default, FALSE); // ProfessionalQualification
		$this->buildSearchSql($where, $this->MedicalCondition, $default, FALSE); // MedicalCondition
		$this->buildSearchSql($where, $this->OtherMedicalConditions, $default, FALSE); // OtherMedicalConditions
		$this->buildSearchSql($where, $this->PhysicalChallenge, $default, FALSE); // PhysicalChallenge
		$this->buildSearchSql($where, $this->PostalAddress, $default, FALSE); // PostalAddress
		$this->buildSearchSql($where, $this->PhysicalAddress, $default, FALSE); // PhysicalAddress
		$this->buildSearchSql($where, $this->TownOrVillage, $default, FALSE); // TownOrVillage
		$this->buildSearchSql($where, $this->Telephone, $default, FALSE); // Telephone
		$this->buildSearchSql($where, $this->Mobile, $default, FALSE); // Mobile
		$this->buildSearchSql($where, $this->Fax, $default, FALSE); // Fax
		$this->buildSearchSql($where, $this->_Email, $default, FALSE); // Email
		$this->buildSearchSql($where, $this->NumberOfBiologicalChildren, $default, FALSE); // NumberOfBiologicalChildren
		$this->buildSearchSql($where, $this->NumberOfDependants, $default, FALSE); // NumberOfDependants
		$this->buildSearchSql($where, $this->NextOfKin, $default, FALSE); // NextOfKin
		$this->buildSearchSql($where, $this->RelationshipCode, $default, FALSE); // RelationshipCode
		$this->buildSearchSql($where, $this->NextOfKinMobile, $default, FALSE); // NextOfKinMobile
		$this->buildSearchSql($where, $this->NextOfKinEmail, $default, FALSE); // NextOfKinEmail
		$this->buildSearchSql($where, $this->SpouseName, $default, FALSE); // SpouseName
		$this->buildSearchSql($where, $this->SpouseNRC, $default, FALSE); // SpouseNRC
		$this->buildSearchSql($where, $this->SpouseMobile, $default, FALSE); // SpouseMobile
		$this->buildSearchSql($where, $this->SpouseEmail, $default, FALSE); // SpouseEmail
		$this->buildSearchSql($where, $this->SpouseResidentialAddress, $default, FALSE); // SpouseResidentialAddress
		$this->buildSearchSql($where, $this->AdditionalInformation, $default, FALSE); // AdditionalInformation
		$this->buildSearchSql($where, $this->LastUserID, $default, FALSE); // LastUserID
		$this->buildSearchSql($where, $this->LastUpdated, $default, FALSE); // LastUpdated
		$this->buildSearchSql($where, $this->BankAccountNo, $default, FALSE); // BankAccountNo
		$this->buildSearchSql($where, $this->PaymentMethod, $default, FALSE); // PaymentMethod
		$this->buildSearchSql($where, $this->BankBranchCode, $default, FALSE); // BankBranchCode
		$this->buildSearchSql($where, $this->TaxNumber, $default, FALSE); // TaxNumber
		$this->buildSearchSql($where, $this->PensionNumber, $default, FALSE); // PensionNumber
		$this->buildSearchSql($where, $this->SocialSecurityNo, $default, FALSE); // SocialSecurityNo
		$this->buildSearchSql($where, $this->ThirdParties, $default, TRUE); // ThirdParties

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->EmployeeID->AdvancedSearch->save(); // EmployeeID
			$this->LACode->AdvancedSearch->save(); // LACode
			$this->FormerFileNumber->AdvancedSearch->save(); // FormerFileNumber
			$this->NRC->AdvancedSearch->save(); // NRC
			$this->Title->AdvancedSearch->save(); // Title
			$this->Surname->AdvancedSearch->save(); // Surname
			$this->FirstName->AdvancedSearch->save(); // FirstName
			$this->MiddleName->AdvancedSearch->save(); // MiddleName
			$this->Sex->AdvancedSearch->save(); // Sex
			$this->MaritalStatus->AdvancedSearch->save(); // MaritalStatus
			$this->MaidenName->AdvancedSearch->save(); // MaidenName
			$this->DateOfBirth->AdvancedSearch->save(); // DateOfBirth
			$this->AcademicQualification->AdvancedSearch->save(); // AcademicQualification
			$this->ProfessionalQualification->AdvancedSearch->save(); // ProfessionalQualification
			$this->MedicalCondition->AdvancedSearch->save(); // MedicalCondition
			$this->OtherMedicalConditions->AdvancedSearch->save(); // OtherMedicalConditions
			$this->PhysicalChallenge->AdvancedSearch->save(); // PhysicalChallenge
			$this->PostalAddress->AdvancedSearch->save(); // PostalAddress
			$this->PhysicalAddress->AdvancedSearch->save(); // PhysicalAddress
			$this->TownOrVillage->AdvancedSearch->save(); // TownOrVillage
			$this->Telephone->AdvancedSearch->save(); // Telephone
			$this->Mobile->AdvancedSearch->save(); // Mobile
			$this->Fax->AdvancedSearch->save(); // Fax
			$this->_Email->AdvancedSearch->save(); // Email
			$this->NumberOfBiologicalChildren->AdvancedSearch->save(); // NumberOfBiologicalChildren
			$this->NumberOfDependants->AdvancedSearch->save(); // NumberOfDependants
			$this->NextOfKin->AdvancedSearch->save(); // NextOfKin
			$this->RelationshipCode->AdvancedSearch->save(); // RelationshipCode
			$this->NextOfKinMobile->AdvancedSearch->save(); // NextOfKinMobile
			$this->NextOfKinEmail->AdvancedSearch->save(); // NextOfKinEmail
			$this->SpouseName->AdvancedSearch->save(); // SpouseName
			$this->SpouseNRC->AdvancedSearch->save(); // SpouseNRC
			$this->SpouseMobile->AdvancedSearch->save(); // SpouseMobile
			$this->SpouseEmail->AdvancedSearch->save(); // SpouseEmail
			$this->SpouseResidentialAddress->AdvancedSearch->save(); // SpouseResidentialAddress
			$this->AdditionalInformation->AdvancedSearch->save(); // AdditionalInformation
			$this->LastUserID->AdvancedSearch->save(); // LastUserID
			$this->LastUpdated->AdvancedSearch->save(); // LastUpdated
			$this->BankAccountNo->AdvancedSearch->save(); // BankAccountNo
			$this->PaymentMethod->AdvancedSearch->save(); // PaymentMethod
			$this->BankBranchCode->AdvancedSearch->save(); // BankBranchCode
			$this->TaxNumber->AdvancedSearch->save(); // TaxNumber
			$this->PensionNumber->AdvancedSearch->save(); // PensionNumber
			$this->SocialSecurityNo->AdvancedSearch->save(); // SocialSecurityNo
			$this->ThirdParties->AdvancedSearch->save(); // ThirdParties
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr))
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 != "")
				$wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE"))
			return $fldVal;
		$value = $fldVal;
		if ($fld->isBoolean()) {
			if ($fldVal != "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal != "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->LACode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->FormerFileNumber, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->NRC, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Title, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Surname, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->FirstName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->MiddleName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Sex, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->MaidenName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AcademicQualification, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ProfessionalQualification, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->MedicalCondition, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->OtherMedicalConditions, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PhysicalChallenge, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PostalAddress, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PhysicalAddress, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->TownOrVillage, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Telephone, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Mobile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Fax, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->_Email, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->NextOfKin, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->NextOfKinMobile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->NextOfKinEmail, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SpouseName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SpouseNRC, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SpouseMobile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SpouseEmail, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SpouseResidentialAddress, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AdditionalInformation, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LastUserID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->BankAccountNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PaymentMethod, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->BankBranchCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->TaxNumber, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PensionNumber, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SocialSecurityNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ThirdParties, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->EmployeeID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LACode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FormerFileNumber->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NRC->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Title->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Surname->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FirstName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MiddleName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Sex->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MaritalStatus->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MaidenName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DateOfBirth->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AcademicQualification->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProfessionalQualification->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MedicalCondition->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->OtherMedicalConditions->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PhysicalChallenge->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PostalAddress->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PhysicalAddress->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TownOrVillage->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Telephone->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Mobile->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Fax->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->_Email->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NumberOfBiologicalChildren->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NumberOfDependants->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NextOfKin->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RelationshipCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NextOfKinMobile->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NextOfKinEmail->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SpouseName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SpouseNRC->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SpouseMobile->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SpouseEmail->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SpouseResidentialAddress->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AdditionalInformation->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastUserID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastUpdated->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BankAccountNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PaymentMethod->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BankBranchCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TaxNumber->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PensionNumber->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SocialSecurityNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ThirdParties->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->EmployeeID->AdvancedSearch->unsetSession();
		$this->LACode->AdvancedSearch->unsetSession();
		$this->FormerFileNumber->AdvancedSearch->unsetSession();
		$this->NRC->AdvancedSearch->unsetSession();
		$this->Title->AdvancedSearch->unsetSession();
		$this->Surname->AdvancedSearch->unsetSession();
		$this->FirstName->AdvancedSearch->unsetSession();
		$this->MiddleName->AdvancedSearch->unsetSession();
		$this->Sex->AdvancedSearch->unsetSession();
		$this->MaritalStatus->AdvancedSearch->unsetSession();
		$this->MaidenName->AdvancedSearch->unsetSession();
		$this->DateOfBirth->AdvancedSearch->unsetSession();
		$this->AcademicQualification->AdvancedSearch->unsetSession();
		$this->ProfessionalQualification->AdvancedSearch->unsetSession();
		$this->MedicalCondition->AdvancedSearch->unsetSession();
		$this->OtherMedicalConditions->AdvancedSearch->unsetSession();
		$this->PhysicalChallenge->AdvancedSearch->unsetSession();
		$this->PostalAddress->AdvancedSearch->unsetSession();
		$this->PhysicalAddress->AdvancedSearch->unsetSession();
		$this->TownOrVillage->AdvancedSearch->unsetSession();
		$this->Telephone->AdvancedSearch->unsetSession();
		$this->Mobile->AdvancedSearch->unsetSession();
		$this->Fax->AdvancedSearch->unsetSession();
		$this->_Email->AdvancedSearch->unsetSession();
		$this->NumberOfBiologicalChildren->AdvancedSearch->unsetSession();
		$this->NumberOfDependants->AdvancedSearch->unsetSession();
		$this->NextOfKin->AdvancedSearch->unsetSession();
		$this->RelationshipCode->AdvancedSearch->unsetSession();
		$this->NextOfKinMobile->AdvancedSearch->unsetSession();
		$this->NextOfKinEmail->AdvancedSearch->unsetSession();
		$this->SpouseName->AdvancedSearch->unsetSession();
		$this->SpouseNRC->AdvancedSearch->unsetSession();
		$this->SpouseMobile->AdvancedSearch->unsetSession();
		$this->SpouseEmail->AdvancedSearch->unsetSession();
		$this->SpouseResidentialAddress->AdvancedSearch->unsetSession();
		$this->AdditionalInformation->AdvancedSearch->unsetSession();
		$this->LastUserID->AdvancedSearch->unsetSession();
		$this->LastUpdated->AdvancedSearch->unsetSession();
		$this->BankAccountNo->AdvancedSearch->unsetSession();
		$this->PaymentMethod->AdvancedSearch->unsetSession();
		$this->BankBranchCode->AdvancedSearch->unsetSession();
		$this->TaxNumber->AdvancedSearch->unsetSession();
		$this->PensionNumber->AdvancedSearch->unsetSession();
		$this->SocialSecurityNo->AdvancedSearch->unsetSession();
		$this->ThirdParties->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->EmployeeID->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->FormerFileNumber->AdvancedSearch->load();
		$this->NRC->AdvancedSearch->load();
		$this->Title->AdvancedSearch->load();
		$this->Surname->AdvancedSearch->load();
		$this->FirstName->AdvancedSearch->load();
		$this->MiddleName->AdvancedSearch->load();
		$this->Sex->AdvancedSearch->load();
		$this->MaritalStatus->AdvancedSearch->load();
		$this->MaidenName->AdvancedSearch->load();
		$this->DateOfBirth->AdvancedSearch->load();
		$this->AcademicQualification->AdvancedSearch->load();
		$this->ProfessionalQualification->AdvancedSearch->load();
		$this->MedicalCondition->AdvancedSearch->load();
		$this->OtherMedicalConditions->AdvancedSearch->load();
		$this->PhysicalChallenge->AdvancedSearch->load();
		$this->PostalAddress->AdvancedSearch->load();
		$this->PhysicalAddress->AdvancedSearch->load();
		$this->TownOrVillage->AdvancedSearch->load();
		$this->Telephone->AdvancedSearch->load();
		$this->Mobile->AdvancedSearch->load();
		$this->Fax->AdvancedSearch->load();
		$this->_Email->AdvancedSearch->load();
		$this->NumberOfBiologicalChildren->AdvancedSearch->load();
		$this->NumberOfDependants->AdvancedSearch->load();
		$this->NextOfKin->AdvancedSearch->load();
		$this->RelationshipCode->AdvancedSearch->load();
		$this->NextOfKinMobile->AdvancedSearch->load();
		$this->NextOfKinEmail->AdvancedSearch->load();
		$this->SpouseName->AdvancedSearch->load();
		$this->SpouseNRC->AdvancedSearch->load();
		$this->SpouseMobile->AdvancedSearch->load();
		$this->SpouseEmail->AdvancedSearch->load();
		$this->SpouseResidentialAddress->AdvancedSearch->load();
		$this->AdditionalInformation->AdvancedSearch->load();
		$this->LastUserID->AdvancedSearch->load();
		$this->LastUpdated->AdvancedSearch->load();
		$this->BankAccountNo->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->BankBranchCode->AdvancedSearch->load();
		$this->TaxNumber->AdvancedSearch->load();
		$this->PensionNumber->AdvancedSearch->load();
		$this->SocialSecurityNo->AdvancedSearch->load();
		$this->ThirdParties->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->EmployeeID); // EmployeeID
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->FormerFileNumber); // FormerFileNumber
			$this->updateSort($this->NRC); // NRC
			$this->updateSort($this->Title); // Title
			$this->updateSort($this->Surname); // Surname
			$this->updateSort($this->FirstName); // FirstName
			$this->updateSort($this->MiddleName); // MiddleName
			$this->updateSort($this->Sex); // Sex
			$this->updateSort($this->MaritalStatus); // MaritalStatus
			$this->updateSort($this->MaidenName); // MaidenName
			$this->updateSort($this->DateOfBirth); // DateOfBirth
			$this->updateSort($this->AcademicQualification); // AcademicQualification
			$this->updateSort($this->ProfessionalQualification); // ProfessionalQualification
			$this->updateSort($this->MedicalCondition); // MedicalCondition
			$this->updateSort($this->OtherMedicalConditions); // OtherMedicalConditions
			$this->updateSort($this->PhysicalChallenge); // PhysicalChallenge
			$this->updateSort($this->PostalAddress); // PostalAddress
			$this->updateSort($this->PhysicalAddress); // PhysicalAddress
			$this->updateSort($this->TownOrVillage); // TownOrVillage
			$this->updateSort($this->Telephone); // Telephone
			$this->updateSort($this->Mobile); // Mobile
			$this->updateSort($this->Fax); // Fax
			$this->updateSort($this->_Email); // Email
			$this->updateSort($this->NumberOfBiologicalChildren); // NumberOfBiologicalChildren
			$this->updateSort($this->NumberOfDependants); // NumberOfDependants
			$this->updateSort($this->NextOfKin); // NextOfKin
			$this->updateSort($this->RelationshipCode); // RelationshipCode
			$this->updateSort($this->NextOfKinMobile); // NextOfKinMobile
			$this->updateSort($this->NextOfKinEmail); // NextOfKinEmail
			$this->updateSort($this->SpouseName); // SpouseName
			$this->updateSort($this->SpouseNRC); // SpouseNRC
			$this->updateSort($this->SpouseMobile); // SpouseMobile
			$this->updateSort($this->SpouseEmail); // SpouseEmail
			$this->updateSort($this->SpouseResidentialAddress); // SpouseResidentialAddress
			$this->updateSort($this->BankAccountNo); // BankAccountNo
			$this->updateSort($this->PaymentMethod); // PaymentMethod
			$this->updateSort($this->BankBranchCode); // BankBranchCode
			$this->updateSort($this->TaxNumber); // TaxNumber
			$this->updateSort($this->PensionNumber); // PensionNumber
			$this->updateSort($this->SocialSecurityNo); // SocialSecurityNo
			$this->updateSort($this->ThirdParties); // ThirdParties
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->EmployeeID->setSort("");
				$this->LACode->setSort("");
				$this->FormerFileNumber->setSort("");
				$this->NRC->setSort("");
				$this->Title->setSort("");
				$this->Surname->setSort("");
				$this->FirstName->setSort("");
				$this->MiddleName->setSort("");
				$this->Sex->setSort("");
				$this->MaritalStatus->setSort("");
				$this->MaidenName->setSort("");
				$this->DateOfBirth->setSort("");
				$this->AcademicQualification->setSort("");
				$this->ProfessionalQualification->setSort("");
				$this->MedicalCondition->setSort("");
				$this->OtherMedicalConditions->setSort("");
				$this->PhysicalChallenge->setSort("");
				$this->PostalAddress->setSort("");
				$this->PhysicalAddress->setSort("");
				$this->TownOrVillage->setSort("");
				$this->Telephone->setSort("");
				$this->Mobile->setSort("");
				$this->Fax->setSort("");
				$this->_Email->setSort("");
				$this->NumberOfBiologicalChildren->setSort("");
				$this->NumberOfDependants->setSort("");
				$this->NextOfKin->setSort("");
				$this->RelationshipCode->setSort("");
				$this->NextOfKinMobile->setSort("");
				$this->NextOfKinEmail->setSort("");
				$this->SpouseName->setSort("");
				$this->SpouseNRC->setSort("");
				$this->SpouseMobile->setSort("");
				$this->SpouseEmail->setSort("");
				$this->SpouseResidentialAddress->setSort("");
				$this->BankAccountNo->setSort("");
				$this->PaymentMethod->setSort("");
				$this->BankBranchCode->setSort("");
				$this->TaxNumber->setSort("");
				$this->PensionNumber->setSort("");
				$this->SocialSecurityNo->setSort("");
				$this->ThirdParties->setSort("");
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

		// "detail_staffchildren"
		$item = &$this->ListOptions->add("detail_staffchildren");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffchildren') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffchildren_grid"]))
			$GLOBALS["staffchildren_grid"] = new staffchildren_grid();

		// "detail_staffdisciplinary_action"
		$item = &$this->ListOptions->add("detail_staffdisciplinary_action");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffdisciplinary_action') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
			$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();

		// "detail_staffdisciplinary_appeal"
		$item = &$this->ListOptions->add("detail_staffdisciplinary_appeal");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffdisciplinary_appeal') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
			$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();

		// "detail_staffdisciplinary_case"
		$item = &$this->ListOptions->add("detail_staffdisciplinary_case");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffdisciplinary_case') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
			$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();

		// "detail_staffexperience"
		$item = &$this->ListOptions->add("detail_staffexperience");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffexperience') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffexperience_grid"]))
			$GLOBALS["staffexperience_grid"] = new staffexperience_grid();

		// "detail_staffprofbodies"
		$item = &$this->ListOptions->add("detail_staffprofbodies");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffprofbodies') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffprofbodies_grid"]))
			$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();

		// "detail_staffqualifications_academic"
		$item = &$this->ListOptions->add("detail_staffqualifications_academic");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffqualifications_academic') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffqualifications_academic_grid"]))
			$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();

		// "detail_staffqualifications_prof"
		$item = &$this->ListOptions->add("detail_staffqualifications_prof");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffqualifications_prof') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["staffqualifications_prof_grid"]))
			$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();

		// "detail_employment"
		$item = &$this->ListOptions->add("detail_employment");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'employment') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["employment_grid"]))
			$GLOBALS["employment_grid"] = new employment_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("staffchildren");
		$pages->add("staffdisciplinary_action");
		$pages->add("staffdisciplinary_appeal");
		$pages->add("staffdisciplinary_case");
		$pages->add("staffexperience");
		$pages->add("staffprofbodies");
		$pages->add("staffqualifications_academic");
		$pages->add("staffqualifications_prof");
		$pages->add("employment");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
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
			if ($this->isGridAdd() || $this->isGridEdit()) {
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

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_staffchildren"
		$opt = $this->ListOptions["detail_staffchildren"];
		if ($Security->allowList(CurrentProjectID() . 'staffchildren')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffchildren", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffchildren_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffchildrenlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffchildren_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffchildren";
			}
			if ($GLOBALS["staffchildren_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffchildren";
			}
			if ($GLOBALS["staffchildren_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffchildren";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffdisciplinary_action"
		$opt = $this->ListOptions["detail_staffdisciplinary_action"];
		if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_action')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffdisciplinary_action", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffdisciplinary_action_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffdisciplinary_actionlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffdisciplinary_action";
			}
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffdisciplinary_action";
			}
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffdisciplinary_action";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffdisciplinary_appeal"
		$opt = $this->ListOptions["detail_staffdisciplinary_appeal"];
		if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_appeal')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffdisciplinary_appeal", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffdisciplinary_appeal_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffdisciplinary_appeallist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffdisciplinary_appeal";
			}
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffdisciplinary_appeal";
			}
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffdisciplinary_appeal";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffdisciplinary_case"
		$opt = $this->ListOptions["detail_staffdisciplinary_case"];
		if ($Security->allowList(CurrentProjectID() . 'staffdisciplinary_case')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffdisciplinary_case", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffdisciplinary_case_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffdisciplinary_caselist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffdisciplinary_case_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffdisciplinary_case";
			}
			if ($GLOBALS["staffdisciplinary_case_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffdisciplinary_case";
			}
			if ($GLOBALS["staffdisciplinary_case_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffdisciplinary_case";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffexperience"
		$opt = $this->ListOptions["detail_staffexperience"];
		if ($Security->allowList(CurrentProjectID() . 'staffexperience')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffexperience", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffexperience_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffexperiencelist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffexperience_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffexperience";
			}
			if ($GLOBALS["staffexperience_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffexperience";
			}
			if ($GLOBALS["staffexperience_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffexperience";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffprofbodies"
		$opt = $this->ListOptions["detail_staffprofbodies"];
		if ($Security->allowList(CurrentProjectID() . 'staffprofbodies')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffprofbodies", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffprofbodies_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffprofbodieslist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffprofbodies_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffprofbodies";
			}
			if ($GLOBALS["staffprofbodies_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffprofbodies";
			}
			if ($GLOBALS["staffprofbodies_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffprofbodies";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffqualifications_academic"
		$opt = $this->ListOptions["detail_staffqualifications_academic"];
		if ($Security->allowList(CurrentProjectID() . 'staffqualifications_academic')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffqualifications_academic", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffqualifications_academic_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffqualifications_academiclist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffqualifications_academic_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffqualifications_academic";
			}
			if ($GLOBALS["staffqualifications_academic_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffqualifications_academic";
			}
			if ($GLOBALS["staffqualifications_academic_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffqualifications_academic";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_staffqualifications_prof"
		$opt = $this->ListOptions["detail_staffqualifications_prof"];
		if ($Security->allowList(CurrentProjectID() . 'staffqualifications_prof')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("staffqualifications_prof", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->staffqualifications_prof_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffqualifications_proflist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["staffqualifications_prof_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "staffqualifications_prof";
			}
			if ($GLOBALS["staffqualifications_prof_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "staffqualifications_prof";
			}
			if ($GLOBALS["staffqualifications_prof_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "staffqualifications_prof";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}

		// "detail_employment"
		$opt = $this->ListOptions["detail_employment"];
		if ($Security->allowList(CurrentProjectID() . 'employment')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("employment", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->employment_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("employmentlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["employment_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=employment");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "employment";
			}
			if ($GLOBALS["employment_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=employment");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "employment";
			}
			if ($GLOBALS["employment_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=employment");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "employment";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = $this->ListOptions["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->EmployeeID->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->EmployeeID->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = $this->GridAddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_staffchildren");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
		if (!isset($GLOBALS["staffchildren"]))
			$GLOBALS["staffchildren"] = new staffchildren();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffchildren"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffchildren"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffchildren";
		}
		$item = &$option->add("detailadd_staffdisciplinary_action");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
		if (!isset($GLOBALS["staffdisciplinary_action"]))
			$GLOBALS["staffdisciplinary_action"] = new staffdisciplinary_action();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffdisciplinary_action"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffdisciplinary_action"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffdisciplinary_action";
		}
		$item = &$option->add("detailadd_staffdisciplinary_appeal");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
		if (!isset($GLOBALS["staffdisciplinary_appeal"]))
			$GLOBALS["staffdisciplinary_appeal"] = new staffdisciplinary_appeal();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffdisciplinary_appeal"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffdisciplinary_appeal"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffdisciplinary_appeal";
		}
		$item = &$option->add("detailadd_staffdisciplinary_case");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
		if (!isset($GLOBALS["staffdisciplinary_case"]))
			$GLOBALS["staffdisciplinary_case"] = new staffdisciplinary_case();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffdisciplinary_case"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffdisciplinary_case"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffdisciplinary_case";
		}
		$item = &$option->add("detailadd_staffexperience");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience");
		if (!isset($GLOBALS["staffexperience"]))
			$GLOBALS["staffexperience"] = new staffexperience();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffexperience"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffexperience"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffexperience";
		}
		$item = &$option->add("detailadd_staffprofbodies");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies");
		if (!isset($GLOBALS["staffprofbodies"]))
			$GLOBALS["staffprofbodies"] = new staffprofbodies();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffprofbodies"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffprofbodies"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffprofbodies";
		}
		$item = &$option->add("detailadd_staffqualifications_academic");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic");
		if (!isset($GLOBALS["staffqualifications_academic"]))
			$GLOBALS["staffqualifications_academic"] = new staffqualifications_academic();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffqualifications_academic"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffqualifications_academic"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffqualifications_academic";
		}
		$item = &$option->add("detailadd_staffqualifications_prof");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof");
		if (!isset($GLOBALS["staffqualifications_prof"]))
			$GLOBALS["staffqualifications_prof"] = new staffqualifications_prof();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["staffqualifications_prof"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["staffqualifications_prof"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffqualifications_prof";
		}
		$item = &$option->add("detailadd_employment");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=employment");
		if (!isset($GLOBALS["employment"]))
			$GLOBALS["employment"] = new employment();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["employment"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["employment"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'staff') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "employment";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = $detailTableLink != "" && $Security->canAdd();

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = $option["detailadd_" . $ar[$i]])
					$item->Visible = FALSE;
			}
		}

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("GridEditLink") . "</a>";
		$item->Visible = $this->GridEditUrl != "" && $Security->canEdit();
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = TRUE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fstafflistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fstafflistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fstafflist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as $option)
				$option->hideAllOptions();

			// Grid-Add
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}

			// Grid-Edit
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = $options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = $options["action"];
				$option->UseDropDownButton = FALSE;
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" href=\"#\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
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

		// Column "detail_staffchildren"
		if ($this->DetailPages && $this->DetailPages["staffchildren"] && $this->DetailPages["staffchildren"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffchildren"];
			$url = "staffchildrenpreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffchildren\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffchildren", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffchildren_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffchildren\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffchildrenlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffchildren", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffchildren_grid"]))
				$GLOBALS["staffchildren_grid"] = new staffchildren_grid();
			if ($GLOBALS["staffchildren_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffchildren_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffchildren_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffdisciplinary_action"
		if ($this->DetailPages && $this->DetailPages["staffdisciplinary_action"] && $this->DetailPages["staffdisciplinary_action"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffdisciplinary_action"];
			$url = "staffdisciplinary_actionpreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffdisciplinary_action\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffdisciplinary_action", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffdisciplinary_action_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffdisciplinary_action\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffdisciplinary_actionlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffdisciplinary_action", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
				$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_action_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
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
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffdisciplinary_appeal"
		if ($this->DetailPages && $this->DetailPages["staffdisciplinary_appeal"] && $this->DetailPages["staffdisciplinary_appeal"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffdisciplinary_appeal"];
			$url = "staffdisciplinary_appealpreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffdisciplinary_appeal\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffdisciplinary_appeal", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffdisciplinary_appeal_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffdisciplinary_appeal\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffdisciplinary_appeallist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffdisciplinary_appeal", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
				$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
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

		// Column "detail_staffdisciplinary_case"
		if ($this->DetailPages && $this->DetailPages["staffdisciplinary_case"] && $this->DetailPages["staffdisciplinary_case"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffdisciplinary_case"];
			$url = "staffdisciplinary_casepreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffdisciplinary_case\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffdisciplinary_case", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffdisciplinary_case_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffdisciplinary_case\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffdisciplinary_caselist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffdisciplinary_case", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
				$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();
			if ($GLOBALS["staffdisciplinary_case_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_case_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffdisciplinary_case_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffexperience"
		if ($this->DetailPages && $this->DetailPages["staffexperience"] && $this->DetailPages["staffexperience"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffexperience"];
			$url = "staffexperiencepreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffexperience\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffexperience", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffexperience_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffexperience\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffexperiencelist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffexperience", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffexperience_grid"]))
				$GLOBALS["staffexperience_grid"] = new staffexperience_grid();
			if ($GLOBALS["staffexperience_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffexperience_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffprofbodies"
		if ($this->DetailPages && $this->DetailPages["staffprofbodies"] && $this->DetailPages["staffprofbodies"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffprofbodies"];
			$url = "staffprofbodiespreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffprofbodies\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffprofbodies", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffprofbodies_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffprofbodies\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffprofbodieslist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffprofbodies", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffprofbodies_grid"]))
				$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();
			if ($GLOBALS["staffprofbodies_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffprofbodies_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffqualifications_academic"
		if ($this->DetailPages && $this->DetailPages["staffqualifications_academic"] && $this->DetailPages["staffqualifications_academic"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffqualifications_academic"];
			$url = "staffqualifications_academicpreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffqualifications_academic\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffqualifications_academic", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffqualifications_academic_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffqualifications_academic\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffqualifications_academiclist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffqualifications_academic", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffqualifications_academic_grid"]))
				$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();
			if ($GLOBALS["staffqualifications_academic_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffqualifications_academic_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_staffqualifications_prof"
		if ($this->DetailPages && $this->DetailPages["staffqualifications_prof"] && $this->DetailPages["staffqualifications_prof"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_staffqualifications_prof"];
			$url = "staffqualifications_profpreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"staffqualifications_prof\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("staffqualifications_prof", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->staffqualifications_prof_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"staffqualifications_prof\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("staffqualifications_proflist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("staffqualifications_prof", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["staffqualifications_prof_grid"]))
				$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();
			if ($GLOBALS["staffqualifications_prof_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["staffqualifications_prof_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}
		$sqlwrk = "`EmployeeID`=" . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . "";

		// Column "detail_employment"
		if ($this->DetailPages && $this->DetailPages["employment"] && $this->DetailPages["employment"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_employment"];
			$url = "employmentpreview.php?t=staff&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"employment\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'staff')) {
				$label = $Language->TablePhrase("employment", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->employment_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"employment\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("employmentlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("employment", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["employment_grid"]))
				$GLOBALS["employment_grid"] = new employment_grid();
			if ($GLOBALS["employment_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=employment");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["employment_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=employment");
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

	// Load default values
	protected function loadDefaultValues()
	{
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->FormerFileNumber->CurrentValue = NULL;
		$this->FormerFileNumber->OldValue = $this->FormerFileNumber->CurrentValue;
		$this->NRC->CurrentValue = NULL;
		$this->NRC->OldValue = $this->NRC->CurrentValue;
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
		$this->StaffPhoto->Upload->DbValue = NULL;
		$this->StaffPhoto->OldValue = $this->StaffPhoto->Upload->DbValue;
		$this->MaritalStatus->CurrentValue = NULL;
		$this->MaritalStatus->OldValue = $this->MaritalStatus->CurrentValue;
		$this->MaidenName->CurrentValue = NULL;
		$this->MaidenName->OldValue = $this->MaidenName->CurrentValue;
		$this->DateOfBirth->CurrentValue = NULL;
		$this->DateOfBirth->OldValue = $this->DateOfBirth->CurrentValue;
		$this->AcademicQualification->CurrentValue = NULL;
		$this->AcademicQualification->OldValue = $this->AcademicQualification->CurrentValue;
		$this->ProfessionalQualification->CurrentValue = NULL;
		$this->ProfessionalQualification->OldValue = $this->ProfessionalQualification->CurrentValue;
		$this->MedicalCondition->CurrentValue = NULL;
		$this->MedicalCondition->OldValue = $this->MedicalCondition->CurrentValue;
		$this->OtherMedicalConditions->CurrentValue = NULL;
		$this->OtherMedicalConditions->OldValue = $this->OtherMedicalConditions->CurrentValue;
		$this->PhysicalChallenge->CurrentValue = NULL;
		$this->PhysicalChallenge->OldValue = $this->PhysicalChallenge->CurrentValue;
		$this->PostalAddress->CurrentValue = NULL;
		$this->PostalAddress->OldValue = $this->PostalAddress->CurrentValue;
		$this->PhysicalAddress->CurrentValue = NULL;
		$this->PhysicalAddress->OldValue = $this->PhysicalAddress->CurrentValue;
		$this->TownOrVillage->CurrentValue = NULL;
		$this->TownOrVillage->OldValue = $this->TownOrVillage->CurrentValue;
		$this->Telephone->CurrentValue = NULL;
		$this->Telephone->OldValue = $this->Telephone->CurrentValue;
		$this->Mobile->CurrentValue = NULL;
		$this->Mobile->OldValue = $this->Mobile->CurrentValue;
		$this->Fax->CurrentValue = NULL;
		$this->Fax->OldValue = $this->Fax->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->NumberOfBiologicalChildren->CurrentValue = 0;
		$this->NumberOfBiologicalChildren->OldValue = $this->NumberOfBiologicalChildren->CurrentValue;
		$this->NumberOfDependants->CurrentValue = NULL;
		$this->NumberOfDependants->OldValue = $this->NumberOfDependants->CurrentValue;
		$this->NextOfKin->CurrentValue = NULL;
		$this->NextOfKin->OldValue = $this->NextOfKin->CurrentValue;
		$this->RelationshipCode->CurrentValue = NULL;
		$this->RelationshipCode->OldValue = $this->RelationshipCode->CurrentValue;
		$this->NextOfKinMobile->CurrentValue = NULL;
		$this->NextOfKinMobile->OldValue = $this->NextOfKinMobile->CurrentValue;
		$this->NextOfKinEmail->CurrentValue = NULL;
		$this->NextOfKinEmail->OldValue = $this->NextOfKinEmail->CurrentValue;
		$this->SpouseName->CurrentValue = NULL;
		$this->SpouseName->OldValue = $this->SpouseName->CurrentValue;
		$this->SpouseNRC->CurrentValue = NULL;
		$this->SpouseNRC->OldValue = $this->SpouseNRC->CurrentValue;
		$this->SpouseMobile->CurrentValue = NULL;
		$this->SpouseMobile->OldValue = $this->SpouseMobile->CurrentValue;
		$this->SpouseEmail->CurrentValue = NULL;
		$this->SpouseEmail->OldValue = $this->SpouseEmail->CurrentValue;
		$this->SpouseResidentialAddress->CurrentValue = NULL;
		$this->SpouseResidentialAddress->OldValue = $this->SpouseResidentialAddress->CurrentValue;
		$this->AdditionalInformation->CurrentValue = NULL;
		$this->AdditionalInformation->OldValue = $this->AdditionalInformation->CurrentValue;
		$this->LastUserID->CurrentValue = NULL;
		$this->LastUserID->OldValue = $this->LastUserID->CurrentValue;
		$this->LastUpdated->CurrentValue = NULL;
		$this->LastUpdated->OldValue = $this->LastUpdated->CurrentValue;
		$this->BankAccountNo->CurrentValue = NULL;
		$this->BankAccountNo->OldValue = $this->BankAccountNo->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
		$this->BankBranchCode->CurrentValue = NULL;
		$this->BankBranchCode->OldValue = $this->BankBranchCode->CurrentValue;
		$this->TaxNumber->CurrentValue = NULL;
		$this->TaxNumber->OldValue = $this->TaxNumber->CurrentValue;
		$this->PensionNumber->CurrentValue = NULL;
		$this->PensionNumber->OldValue = $this->PensionNumber->CurrentValue;
		$this->SocialSecurityNo->CurrentValue = NULL;
		$this->SocialSecurityNo->OldValue = $this->SocialSecurityNo->CurrentValue;
		$this->ThirdParties->CurrentValue = NULL;
		$this->ThirdParties->OldValue = $this->ThirdParties->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// EmployeeID
		if (!$this->isAddOrEdit() && $this->EmployeeID->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->EmployeeID->AdvancedSearch->SearchValue != "" || $this->EmployeeID->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LACode
		if (!$this->isAddOrEdit() && $this->LACode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LACode->AdvancedSearch->SearchValue != "" || $this->LACode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FormerFileNumber
		if (!$this->isAddOrEdit() && $this->FormerFileNumber->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FormerFileNumber->AdvancedSearch->SearchValue != "" || $this->FormerFileNumber->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NRC
		if (!$this->isAddOrEdit() && $this->NRC->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NRC->AdvancedSearch->SearchValue != "" || $this->NRC->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Title
		if (!$this->isAddOrEdit() && $this->Title->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Title->AdvancedSearch->SearchValue != "" || $this->Title->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Surname
		if (!$this->isAddOrEdit() && $this->Surname->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Surname->AdvancedSearch->SearchValue != "" || $this->Surname->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FirstName
		if (!$this->isAddOrEdit() && $this->FirstName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FirstName->AdvancedSearch->SearchValue != "" || $this->FirstName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MiddleName
		if (!$this->isAddOrEdit() && $this->MiddleName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MiddleName->AdvancedSearch->SearchValue != "" || $this->MiddleName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Sex
		if (!$this->isAddOrEdit() && $this->Sex->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Sex->AdvancedSearch->SearchValue != "" || $this->Sex->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MaritalStatus
		if (!$this->isAddOrEdit() && $this->MaritalStatus->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MaritalStatus->AdvancedSearch->SearchValue != "" || $this->MaritalStatus->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MaidenName
		if (!$this->isAddOrEdit() && $this->MaidenName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MaidenName->AdvancedSearch->SearchValue != "" || $this->MaidenName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DateOfBirth
		if (!$this->isAddOrEdit() && $this->DateOfBirth->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DateOfBirth->AdvancedSearch->SearchValue != "" || $this->DateOfBirth->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AcademicQualification
		if (!$this->isAddOrEdit() && $this->AcademicQualification->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AcademicQualification->AdvancedSearch->SearchValue != "" || $this->AcademicQualification->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ProfessionalQualification
		if (!$this->isAddOrEdit() && $this->ProfessionalQualification->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProfessionalQualification->AdvancedSearch->SearchValue != "" || $this->ProfessionalQualification->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MedicalCondition
		if (!$this->isAddOrEdit() && $this->MedicalCondition->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MedicalCondition->AdvancedSearch->SearchValue != "" || $this->MedicalCondition->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// OtherMedicalConditions
		if (!$this->isAddOrEdit() && $this->OtherMedicalConditions->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->OtherMedicalConditions->AdvancedSearch->SearchValue != "" || $this->OtherMedicalConditions->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PhysicalChallenge
		if (!$this->isAddOrEdit() && $this->PhysicalChallenge->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PhysicalChallenge->AdvancedSearch->SearchValue != "" || $this->PhysicalChallenge->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PostalAddress
		if (!$this->isAddOrEdit() && $this->PostalAddress->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PostalAddress->AdvancedSearch->SearchValue != "" || $this->PostalAddress->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PhysicalAddress
		if (!$this->isAddOrEdit() && $this->PhysicalAddress->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PhysicalAddress->AdvancedSearch->SearchValue != "" || $this->PhysicalAddress->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TownOrVillage
		if (!$this->isAddOrEdit() && $this->TownOrVillage->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TownOrVillage->AdvancedSearch->SearchValue != "" || $this->TownOrVillage->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Telephone
		if (!$this->isAddOrEdit() && $this->Telephone->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Telephone->AdvancedSearch->SearchValue != "" || $this->Telephone->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Mobile
		if (!$this->isAddOrEdit() && $this->Mobile->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Mobile->AdvancedSearch->SearchValue != "" || $this->Mobile->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Fax
		if (!$this->isAddOrEdit() && $this->Fax->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Fax->AdvancedSearch->SearchValue != "" || $this->Fax->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Email
		if (!$this->isAddOrEdit() && $this->_Email->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->_Email->AdvancedSearch->SearchValue != "" || $this->_Email->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NumberOfBiologicalChildren
		if (!$this->isAddOrEdit() && $this->NumberOfBiologicalChildren->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NumberOfBiologicalChildren->AdvancedSearch->SearchValue != "" || $this->NumberOfBiologicalChildren->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NumberOfDependants
		if (!$this->isAddOrEdit() && $this->NumberOfDependants->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NumberOfDependants->AdvancedSearch->SearchValue != "" || $this->NumberOfDependants->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NextOfKin
		if (!$this->isAddOrEdit() && $this->NextOfKin->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NextOfKin->AdvancedSearch->SearchValue != "" || $this->NextOfKin->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RelationshipCode
		if (!$this->isAddOrEdit() && $this->RelationshipCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RelationshipCode->AdvancedSearch->SearchValue != "" || $this->RelationshipCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NextOfKinMobile
		if (!$this->isAddOrEdit() && $this->NextOfKinMobile->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NextOfKinMobile->AdvancedSearch->SearchValue != "" || $this->NextOfKinMobile->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NextOfKinEmail
		if (!$this->isAddOrEdit() && $this->NextOfKinEmail->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NextOfKinEmail->AdvancedSearch->SearchValue != "" || $this->NextOfKinEmail->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SpouseName
		if (!$this->isAddOrEdit() && $this->SpouseName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SpouseName->AdvancedSearch->SearchValue != "" || $this->SpouseName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SpouseNRC
		if (!$this->isAddOrEdit() && $this->SpouseNRC->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SpouseNRC->AdvancedSearch->SearchValue != "" || $this->SpouseNRC->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SpouseMobile
		if (!$this->isAddOrEdit() && $this->SpouseMobile->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SpouseMobile->AdvancedSearch->SearchValue != "" || $this->SpouseMobile->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SpouseEmail
		if (!$this->isAddOrEdit() && $this->SpouseEmail->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SpouseEmail->AdvancedSearch->SearchValue != "" || $this->SpouseEmail->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SpouseResidentialAddress
		if (!$this->isAddOrEdit() && $this->SpouseResidentialAddress->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SpouseResidentialAddress->AdvancedSearch->SearchValue != "" || $this->SpouseResidentialAddress->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AdditionalInformation
		if (!$this->isAddOrEdit() && $this->AdditionalInformation->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AdditionalInformation->AdvancedSearch->SearchValue != "" || $this->AdditionalInformation->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LastUserID
		if (!$this->isAddOrEdit() && $this->LastUserID->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LastUserID->AdvancedSearch->SearchValue != "" || $this->LastUserID->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LastUpdated
		if (!$this->isAddOrEdit() && $this->LastUpdated->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LastUpdated->AdvancedSearch->SearchValue != "" || $this->LastUpdated->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BankAccountNo
		if (!$this->isAddOrEdit() && $this->BankAccountNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BankAccountNo->AdvancedSearch->SearchValue != "" || $this->BankAccountNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PaymentMethod
		if (!$this->isAddOrEdit() && $this->PaymentMethod->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PaymentMethod->AdvancedSearch->SearchValue != "" || $this->PaymentMethod->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BankBranchCode
		if (!$this->isAddOrEdit() && $this->BankBranchCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BankBranchCode->AdvancedSearch->SearchValue != "" || $this->BankBranchCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TaxNumber
		if (!$this->isAddOrEdit() && $this->TaxNumber->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TaxNumber->AdvancedSearch->SearchValue != "" || $this->TaxNumber->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PensionNumber
		if (!$this->isAddOrEdit() && $this->PensionNumber->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PensionNumber->AdvancedSearch->SearchValue != "" || $this->PensionNumber->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SocialSecurityNo
		if (!$this->isAddOrEdit() && $this->SocialSecurityNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SocialSecurityNo->AdvancedSearch->SearchValue != "" || $this->SocialSecurityNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ThirdParties
		if (!$this->isAddOrEdit() && $this->ThirdParties->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ThirdParties->AdvancedSearch->SearchValue != "" || $this->ThirdParties->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ThirdParties->AdvancedSearch->SearchValue))
			$this->ThirdParties->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ThirdParties->AdvancedSearch->SearchValue);
		if (is_array($this->ThirdParties->AdvancedSearch->SearchValue2))
			$this->ThirdParties->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ThirdParties->AdvancedSearch->SearchValue2);
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->EmployeeID->setFormValue($val);

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

		// Check field name 'FormerFileNumber' first before field var 'x_FormerFileNumber'
		$val = $CurrentForm->hasValue("FormerFileNumber") ? $CurrentForm->getValue("FormerFileNumber") : $CurrentForm->getValue("x_FormerFileNumber");
		if (!$this->FormerFileNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FormerFileNumber->Visible = FALSE; // Disable update for API request
			else
				$this->FormerFileNumber->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_FormerFileNumber"))
			$this->FormerFileNumber->setOldValue($CurrentForm->getValue("o_FormerFileNumber"));

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

		// Check field name 'MaritalStatus' first before field var 'x_MaritalStatus'
		$val = $CurrentForm->hasValue("MaritalStatus") ? $CurrentForm->getValue("MaritalStatus") : $CurrentForm->getValue("x_MaritalStatus");
		if (!$this->MaritalStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaritalStatus->Visible = FALSE; // Disable update for API request
			else
				$this->MaritalStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MaritalStatus"))
			$this->MaritalStatus->setOldValue($CurrentForm->getValue("o_MaritalStatus"));

		// Check field name 'MaidenName' first before field var 'x_MaidenName'
		$val = $CurrentForm->hasValue("MaidenName") ? $CurrentForm->getValue("MaidenName") : $CurrentForm->getValue("x_MaidenName");
		if (!$this->MaidenName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaidenName->Visible = FALSE; // Disable update for API request
			else
				$this->MaidenName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MaidenName"))
			$this->MaidenName->setOldValue($CurrentForm->getValue("o_MaidenName"));

		// Check field name 'DateOfBirth' first before field var 'x_DateOfBirth'
		$val = $CurrentForm->hasValue("DateOfBirth") ? $CurrentForm->getValue("DateOfBirth") : $CurrentForm->getValue("x_DateOfBirth");
		if (!$this->DateOfBirth->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfBirth->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfBirth->setFormValue($val);
			$this->DateOfBirth->CurrentValue = UnFormatDateTime($this->DateOfBirth->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfBirth"))
			$this->DateOfBirth->setOldValue($CurrentForm->getValue("o_DateOfBirth"));

		// Check field name 'AcademicQualification' first before field var 'x_AcademicQualification'
		$val = $CurrentForm->hasValue("AcademicQualification") ? $CurrentForm->getValue("AcademicQualification") : $CurrentForm->getValue("x_AcademicQualification");
		if (!$this->AcademicQualification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AcademicQualification->Visible = FALSE; // Disable update for API request
			else
				$this->AcademicQualification->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AcademicQualification"))
			$this->AcademicQualification->setOldValue($CurrentForm->getValue("o_AcademicQualification"));

		// Check field name 'ProfessionalQualification' first before field var 'x_ProfessionalQualification'
		$val = $CurrentForm->hasValue("ProfessionalQualification") ? $CurrentForm->getValue("ProfessionalQualification") : $CurrentForm->getValue("x_ProfessionalQualification");
		if (!$this->ProfessionalQualification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProfessionalQualification->Visible = FALSE; // Disable update for API request
			else
				$this->ProfessionalQualification->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProfessionalQualification"))
			$this->ProfessionalQualification->setOldValue($CurrentForm->getValue("o_ProfessionalQualification"));

		// Check field name 'MedicalCondition' first before field var 'x_MedicalCondition'
		$val = $CurrentForm->hasValue("MedicalCondition") ? $CurrentForm->getValue("MedicalCondition") : $CurrentForm->getValue("x_MedicalCondition");
		if (!$this->MedicalCondition->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MedicalCondition->Visible = FALSE; // Disable update for API request
			else
				$this->MedicalCondition->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MedicalCondition"))
			$this->MedicalCondition->setOldValue($CurrentForm->getValue("o_MedicalCondition"));

		// Check field name 'OtherMedicalConditions' first before field var 'x_OtherMedicalConditions'
		$val = $CurrentForm->hasValue("OtherMedicalConditions") ? $CurrentForm->getValue("OtherMedicalConditions") : $CurrentForm->getValue("x_OtherMedicalConditions");
		if (!$this->OtherMedicalConditions->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OtherMedicalConditions->Visible = FALSE; // Disable update for API request
			else
				$this->OtherMedicalConditions->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OtherMedicalConditions"))
			$this->OtherMedicalConditions->setOldValue($CurrentForm->getValue("o_OtherMedicalConditions"));

		// Check field name 'PhysicalChallenge' first before field var 'x_PhysicalChallenge'
		$val = $CurrentForm->hasValue("PhysicalChallenge") ? $CurrentForm->getValue("PhysicalChallenge") : $CurrentForm->getValue("x_PhysicalChallenge");
		if (!$this->PhysicalChallenge->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicalChallenge->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicalChallenge->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PhysicalChallenge"))
			$this->PhysicalChallenge->setOldValue($CurrentForm->getValue("o_PhysicalChallenge"));

		// Check field name 'PostalAddress' first before field var 'x_PostalAddress'
		$val = $CurrentForm->hasValue("PostalAddress") ? $CurrentForm->getValue("PostalAddress") : $CurrentForm->getValue("x_PostalAddress");
		if (!$this->PostalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PostalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PostalAddress->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PostalAddress"))
			$this->PostalAddress->setOldValue($CurrentForm->getValue("o_PostalAddress"));

		// Check field name 'PhysicalAddress' first before field var 'x_PhysicalAddress'
		$val = $CurrentForm->hasValue("PhysicalAddress") ? $CurrentForm->getValue("PhysicalAddress") : $CurrentForm->getValue("x_PhysicalAddress");
		if (!$this->PhysicalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicalAddress->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PhysicalAddress"))
			$this->PhysicalAddress->setOldValue($CurrentForm->getValue("o_PhysicalAddress"));

		// Check field name 'TownOrVillage' first before field var 'x_TownOrVillage'
		$val = $CurrentForm->hasValue("TownOrVillage") ? $CurrentForm->getValue("TownOrVillage") : $CurrentForm->getValue("x_TownOrVillage");
		if (!$this->TownOrVillage->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TownOrVillage->Visible = FALSE; // Disable update for API request
			else
				$this->TownOrVillage->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TownOrVillage"))
			$this->TownOrVillage->setOldValue($CurrentForm->getValue("o_TownOrVillage"));

		// Check field name 'Telephone' first before field var 'x_Telephone'
		$val = $CurrentForm->hasValue("Telephone") ? $CurrentForm->getValue("Telephone") : $CurrentForm->getValue("x_Telephone");
		if (!$this->Telephone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Telephone->Visible = FALSE; // Disable update for API request
			else
				$this->Telephone->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Telephone"))
			$this->Telephone->setOldValue($CurrentForm->getValue("o_Telephone"));

		// Check field name 'Mobile' first before field var 'x_Mobile'
		$val = $CurrentForm->hasValue("Mobile") ? $CurrentForm->getValue("Mobile") : $CurrentForm->getValue("x_Mobile");
		if (!$this->Mobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Mobile->Visible = FALSE; // Disable update for API request
			else
				$this->Mobile->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Mobile"))
			$this->Mobile->setOldValue($CurrentForm->getValue("o_Mobile"));

		// Check field name 'Fax' first before field var 'x_Fax'
		$val = $CurrentForm->hasValue("Fax") ? $CurrentForm->getValue("Fax") : $CurrentForm->getValue("x_Fax");
		if (!$this->Fax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Fax->Visible = FALSE; // Disable update for API request
			else
				$this->Fax->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Fax"))
			$this->Fax->setOldValue($CurrentForm->getValue("o_Fax"));

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o__Email"))
			$this->_Email->setOldValue($CurrentForm->getValue("o__Email"));

		// Check field name 'NumberOfBiologicalChildren' first before field var 'x_NumberOfBiologicalChildren'
		$val = $CurrentForm->hasValue("NumberOfBiologicalChildren") ? $CurrentForm->getValue("NumberOfBiologicalChildren") : $CurrentForm->getValue("x_NumberOfBiologicalChildren");
		if (!$this->NumberOfBiologicalChildren->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NumberOfBiologicalChildren->Visible = FALSE; // Disable update for API request
			else
				$this->NumberOfBiologicalChildren->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NumberOfBiologicalChildren"))
			$this->NumberOfBiologicalChildren->setOldValue($CurrentForm->getValue("o_NumberOfBiologicalChildren"));

		// Check field name 'NumberOfDependants' first before field var 'x_NumberOfDependants'
		$val = $CurrentForm->hasValue("NumberOfDependants") ? $CurrentForm->getValue("NumberOfDependants") : $CurrentForm->getValue("x_NumberOfDependants");
		if (!$this->NumberOfDependants->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NumberOfDependants->Visible = FALSE; // Disable update for API request
			else
				$this->NumberOfDependants->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NumberOfDependants"))
			$this->NumberOfDependants->setOldValue($CurrentForm->getValue("o_NumberOfDependants"));

		// Check field name 'NextOfKin' first before field var 'x_NextOfKin'
		$val = $CurrentForm->hasValue("NextOfKin") ? $CurrentForm->getValue("NextOfKin") : $CurrentForm->getValue("x_NextOfKin");
		if (!$this->NextOfKin->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NextOfKin->Visible = FALSE; // Disable update for API request
			else
				$this->NextOfKin->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NextOfKin"))
			$this->NextOfKin->setOldValue($CurrentForm->getValue("o_NextOfKin"));

		// Check field name 'RelationshipCode' first before field var 'x_RelationshipCode'
		$val = $CurrentForm->hasValue("RelationshipCode") ? $CurrentForm->getValue("RelationshipCode") : $CurrentForm->getValue("x_RelationshipCode");
		if (!$this->RelationshipCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RelationshipCode->Visible = FALSE; // Disable update for API request
			else
				$this->RelationshipCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RelationshipCode"))
			$this->RelationshipCode->setOldValue($CurrentForm->getValue("o_RelationshipCode"));

		// Check field name 'NextOfKinMobile' first before field var 'x_NextOfKinMobile'
		$val = $CurrentForm->hasValue("NextOfKinMobile") ? $CurrentForm->getValue("NextOfKinMobile") : $CurrentForm->getValue("x_NextOfKinMobile");
		if (!$this->NextOfKinMobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NextOfKinMobile->Visible = FALSE; // Disable update for API request
			else
				$this->NextOfKinMobile->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NextOfKinMobile"))
			$this->NextOfKinMobile->setOldValue($CurrentForm->getValue("o_NextOfKinMobile"));

		// Check field name 'NextOfKinEmail' first before field var 'x_NextOfKinEmail'
		$val = $CurrentForm->hasValue("NextOfKinEmail") ? $CurrentForm->getValue("NextOfKinEmail") : $CurrentForm->getValue("x_NextOfKinEmail");
		if (!$this->NextOfKinEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NextOfKinEmail->Visible = FALSE; // Disable update for API request
			else
				$this->NextOfKinEmail->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NextOfKinEmail"))
			$this->NextOfKinEmail->setOldValue($CurrentForm->getValue("o_NextOfKinEmail"));

		// Check field name 'SpouseName' first before field var 'x_SpouseName'
		$val = $CurrentForm->hasValue("SpouseName") ? $CurrentForm->getValue("SpouseName") : $CurrentForm->getValue("x_SpouseName");
		if (!$this->SpouseName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseName->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SpouseName"))
			$this->SpouseName->setOldValue($CurrentForm->getValue("o_SpouseName"));

		// Check field name 'SpouseNRC' first before field var 'x_SpouseNRC'
		$val = $CurrentForm->hasValue("SpouseNRC") ? $CurrentForm->getValue("SpouseNRC") : $CurrentForm->getValue("x_SpouseNRC");
		if (!$this->SpouseNRC->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseNRC->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseNRC->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SpouseNRC"))
			$this->SpouseNRC->setOldValue($CurrentForm->getValue("o_SpouseNRC"));

		// Check field name 'SpouseMobile' first before field var 'x_SpouseMobile'
		$val = $CurrentForm->hasValue("SpouseMobile") ? $CurrentForm->getValue("SpouseMobile") : $CurrentForm->getValue("x_SpouseMobile");
		if (!$this->SpouseMobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseMobile->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseMobile->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SpouseMobile"))
			$this->SpouseMobile->setOldValue($CurrentForm->getValue("o_SpouseMobile"));

		// Check field name 'SpouseEmail' first before field var 'x_SpouseEmail'
		$val = $CurrentForm->hasValue("SpouseEmail") ? $CurrentForm->getValue("SpouseEmail") : $CurrentForm->getValue("x_SpouseEmail");
		if (!$this->SpouseEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseEmail->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseEmail->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SpouseEmail"))
			$this->SpouseEmail->setOldValue($CurrentForm->getValue("o_SpouseEmail"));

		// Check field name 'SpouseResidentialAddress' first before field var 'x_SpouseResidentialAddress'
		$val = $CurrentForm->hasValue("SpouseResidentialAddress") ? $CurrentForm->getValue("SpouseResidentialAddress") : $CurrentForm->getValue("x_SpouseResidentialAddress");
		if (!$this->SpouseResidentialAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SpouseResidentialAddress->Visible = FALSE; // Disable update for API request
			else
				$this->SpouseResidentialAddress->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SpouseResidentialAddress"))
			$this->SpouseResidentialAddress->setOldValue($CurrentForm->getValue("o_SpouseResidentialAddress"));

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

		// Check field name 'TaxNumber' first before field var 'x_TaxNumber'
		$val = $CurrentForm->hasValue("TaxNumber") ? $CurrentForm->getValue("TaxNumber") : $CurrentForm->getValue("x_TaxNumber");
		if (!$this->TaxNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TaxNumber->Visible = FALSE; // Disable update for API request
			else
				$this->TaxNumber->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TaxNumber"))
			$this->TaxNumber->setOldValue($CurrentForm->getValue("o_TaxNumber"));

		// Check field name 'PensionNumber' first before field var 'x_PensionNumber'
		$val = $CurrentForm->hasValue("PensionNumber") ? $CurrentForm->getValue("PensionNumber") : $CurrentForm->getValue("x_PensionNumber");
		if (!$this->PensionNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PensionNumber->Visible = FALSE; // Disable update for API request
			else
				$this->PensionNumber->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PensionNumber"))
			$this->PensionNumber->setOldValue($CurrentForm->getValue("o_PensionNumber"));

		// Check field name 'SocialSecurityNo' first before field var 'x_SocialSecurityNo'
		$val = $CurrentForm->hasValue("SocialSecurityNo") ? $CurrentForm->getValue("SocialSecurityNo") : $CurrentForm->getValue("x_SocialSecurityNo");
		if (!$this->SocialSecurityNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SocialSecurityNo->Visible = FALSE; // Disable update for API request
			else
				$this->SocialSecurityNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SocialSecurityNo"))
			$this->SocialSecurityNo->setOldValue($CurrentForm->getValue("o_SocialSecurityNo"));

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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->FormerFileNumber->CurrentValue = $this->FormerFileNumber->FormValue;
		$this->NRC->CurrentValue = $this->NRC->FormValue;
		$this->Title->CurrentValue = $this->Title->FormValue;
		$this->Surname->CurrentValue = $this->Surname->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->MiddleName->CurrentValue = $this->MiddleName->FormValue;
		$this->Sex->CurrentValue = $this->Sex->FormValue;
		$this->MaritalStatus->CurrentValue = $this->MaritalStatus->FormValue;
		$this->MaidenName->CurrentValue = $this->MaidenName->FormValue;
		$this->DateOfBirth->CurrentValue = $this->DateOfBirth->FormValue;
		$this->DateOfBirth->CurrentValue = UnFormatDateTime($this->DateOfBirth->CurrentValue, 0);
		$this->AcademicQualification->CurrentValue = $this->AcademicQualification->FormValue;
		$this->ProfessionalQualification->CurrentValue = $this->ProfessionalQualification->FormValue;
		$this->MedicalCondition->CurrentValue = $this->MedicalCondition->FormValue;
		$this->OtherMedicalConditions->CurrentValue = $this->OtherMedicalConditions->FormValue;
		$this->PhysicalChallenge->CurrentValue = $this->PhysicalChallenge->FormValue;
		$this->PostalAddress->CurrentValue = $this->PostalAddress->FormValue;
		$this->PhysicalAddress->CurrentValue = $this->PhysicalAddress->FormValue;
		$this->TownOrVillage->CurrentValue = $this->TownOrVillage->FormValue;
		$this->Telephone->CurrentValue = $this->Telephone->FormValue;
		$this->Mobile->CurrentValue = $this->Mobile->FormValue;
		$this->Fax->CurrentValue = $this->Fax->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->NumberOfBiologicalChildren->CurrentValue = $this->NumberOfBiologicalChildren->FormValue;
		$this->NumberOfDependants->CurrentValue = $this->NumberOfDependants->FormValue;
		$this->NextOfKin->CurrentValue = $this->NextOfKin->FormValue;
		$this->RelationshipCode->CurrentValue = $this->RelationshipCode->FormValue;
		$this->NextOfKinMobile->CurrentValue = $this->NextOfKinMobile->FormValue;
		$this->NextOfKinEmail->CurrentValue = $this->NextOfKinEmail->FormValue;
		$this->SpouseName->CurrentValue = $this->SpouseName->FormValue;
		$this->SpouseNRC->CurrentValue = $this->SpouseNRC->FormValue;
		$this->SpouseMobile->CurrentValue = $this->SpouseMobile->FormValue;
		$this->SpouseEmail->CurrentValue = $this->SpouseEmail->FormValue;
		$this->SpouseResidentialAddress->CurrentValue = $this->SpouseResidentialAddress->FormValue;
		$this->BankAccountNo->CurrentValue = $this->BankAccountNo->FormValue;
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->BankBranchCode->CurrentValue = $this->BankBranchCode->FormValue;
		$this->TaxNumber->CurrentValue = $this->TaxNumber->FormValue;
		$this->PensionNumber->CurrentValue = $this->PensionNumber->FormValue;
		$this->SocialSecurityNo->CurrentValue = $this->SocialSecurityNo->FormValue;
		$this->ThirdParties->CurrentValue = $this->ThirdParties->FormValue;
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
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
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
		$this->LACode->setDbValue($row['LACode']);
		$this->FormerFileNumber->setDbValue($row['FormerFileNumber']);
		$this->NRC->setDbValue($row['NRC']);
		$this->Title->setDbValue($row['Title']);
		$this->Surname->setDbValue($row['Surname']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->MiddleName->setDbValue($row['MiddleName']);
		$this->Sex->setDbValue($row['Sex']);
		$this->StaffPhoto->Upload->DbValue = $row['StaffPhoto'];
		if (is_array($this->StaffPhoto->Upload->DbValue) || is_object($this->StaffPhoto->Upload->DbValue)) // Byte array
			$this->StaffPhoto->Upload->DbValue = BytesToString($this->StaffPhoto->Upload->DbValue);
		$this->MaritalStatus->setDbValue($row['MaritalStatus']);
		$this->MaidenName->setDbValue($row['MaidenName']);
		$this->DateOfBirth->setDbValue($row['DateOfBirth']);
		$this->AcademicQualification->setDbValue($row['AcademicQualification']);
		$this->ProfessionalQualification->setDbValue($row['ProfessionalQualification']);
		$this->MedicalCondition->setDbValue($row['MedicalCondition']);
		$this->OtherMedicalConditions->setDbValue($row['OtherMedicalConditions']);
		$this->PhysicalChallenge->setDbValue($row['PhysicalChallenge']);
		$this->PostalAddress->setDbValue($row['PostalAddress']);
		$this->PhysicalAddress->setDbValue($row['PhysicalAddress']);
		$this->TownOrVillage->setDbValue($row['TownOrVillage']);
		$this->Telephone->setDbValue($row['Telephone']);
		$this->Mobile->setDbValue($row['Mobile']);
		$this->Fax->setDbValue($row['Fax']);
		$this->_Email->setDbValue($row['Email']);
		$this->NumberOfBiologicalChildren->setDbValue($row['NumberOfBiologicalChildren']);
		$this->NumberOfDependants->setDbValue($row['NumberOfDependants']);
		$this->NextOfKin->setDbValue($row['NextOfKin']);
		$this->RelationshipCode->setDbValue($row['RelationshipCode']);
		$this->NextOfKinMobile->setDbValue($row['NextOfKinMobile']);
		$this->NextOfKinEmail->setDbValue($row['NextOfKinEmail']);
		$this->SpouseName->setDbValue($row['SpouseName']);
		$this->SpouseNRC->setDbValue($row['SpouseNRC']);
		$this->SpouseMobile->setDbValue($row['SpouseMobile']);
		$this->SpouseEmail->setDbValue($row['SpouseEmail']);
		$this->SpouseResidentialAddress->setDbValue($row['SpouseResidentialAddress']);
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->LastUserID->setDbValue($row['LastUserID']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->BankAccountNo->setDbValue($row['BankAccountNo']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->BankBranchCode->setDbValue($row['BankBranchCode']);
		$this->TaxNumber->setDbValue($row['TaxNumber']);
		$this->PensionNumber->setDbValue($row['PensionNumber']);
		$this->SocialSecurityNo->setDbValue($row['SocialSecurityNo']);
		$this->ThirdParties->setDbValue($row['ThirdParties']);
		if (!isset($GLOBALS["staffchildren_grid"]))
			$GLOBALS["staffchildren_grid"] = new staffchildren_grid();
		$detailFilter = $GLOBALS["staffchildren"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffchildren"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffchildren"]->applyUserIDFilters($detailFilter);
		$this->staffchildren_Count = $GLOBALS["staffchildren"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
			$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
		$detailFilter = $GLOBALS["staffdisciplinary_action"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffdisciplinary_action"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffdisciplinary_action"]->applyUserIDFilters($detailFilter);
		$this->staffdisciplinary_action_Count = $GLOBALS["staffdisciplinary_action"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
			$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
		$detailFilter = $GLOBALS["staffdisciplinary_appeal"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffdisciplinary_appeal"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffdisciplinary_appeal"]->applyUserIDFilters($detailFilter);
		$this->staffdisciplinary_appeal_Count = $GLOBALS["staffdisciplinary_appeal"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
			$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();
		$detailFilter = $GLOBALS["staffdisciplinary_case"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffdisciplinary_case"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffdisciplinary_case"]->applyUserIDFilters($detailFilter);
		$this->staffdisciplinary_case_Count = $GLOBALS["staffdisciplinary_case"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffexperience_grid"]))
			$GLOBALS["staffexperience_grid"] = new staffexperience_grid();
		$detailFilter = $GLOBALS["staffexperience"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffexperience"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffexperience"]->applyUserIDFilters($detailFilter);
		$this->staffexperience_Count = $GLOBALS["staffexperience"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffprofbodies_grid"]))
			$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();
		$detailFilter = $GLOBALS["staffprofbodies"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffprofbodies"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffprofbodies"]->applyUserIDFilters($detailFilter);
		$this->staffprofbodies_Count = $GLOBALS["staffprofbodies"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffqualifications_academic_grid"]))
			$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();
		$detailFilter = $GLOBALS["staffqualifications_academic"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffqualifications_academic"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffqualifications_academic"]->applyUserIDFilters($detailFilter);
		$this->staffqualifications_academic_Count = $GLOBALS["staffqualifications_academic"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffqualifications_prof_grid"]))
			$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();
		$detailFilter = $GLOBALS["staffqualifications_prof"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffqualifications_prof"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffqualifications_prof"]->applyUserIDFilters($detailFilter);
		$this->staffqualifications_prof_Count = $GLOBALS["staffqualifications_prof"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["employment_grid"]))
			$GLOBALS["employment_grid"] = new employment_grid();
		$detailFilter = $GLOBALS["employment"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["employment"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["employment"]->applyUserIDFilters($detailFilter);
		$this->employment_Count = $GLOBALS["employment"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['FormerFileNumber'] = $this->FormerFileNumber->CurrentValue;
		$row['NRC'] = $this->NRC->CurrentValue;
		$row['Title'] = $this->Title->CurrentValue;
		$row['Surname'] = $this->Surname->CurrentValue;
		$row['FirstName'] = $this->FirstName->CurrentValue;
		$row['MiddleName'] = $this->MiddleName->CurrentValue;
		$row['Sex'] = $this->Sex->CurrentValue;
		$row['StaffPhoto'] = $this->StaffPhoto->Upload->DbValue;
		$row['MaritalStatus'] = $this->MaritalStatus->CurrentValue;
		$row['MaidenName'] = $this->MaidenName->CurrentValue;
		$row['DateOfBirth'] = $this->DateOfBirth->CurrentValue;
		$row['AcademicQualification'] = $this->AcademicQualification->CurrentValue;
		$row['ProfessionalQualification'] = $this->ProfessionalQualification->CurrentValue;
		$row['MedicalCondition'] = $this->MedicalCondition->CurrentValue;
		$row['OtherMedicalConditions'] = $this->OtherMedicalConditions->CurrentValue;
		$row['PhysicalChallenge'] = $this->PhysicalChallenge->CurrentValue;
		$row['PostalAddress'] = $this->PostalAddress->CurrentValue;
		$row['PhysicalAddress'] = $this->PhysicalAddress->CurrentValue;
		$row['TownOrVillage'] = $this->TownOrVillage->CurrentValue;
		$row['Telephone'] = $this->Telephone->CurrentValue;
		$row['Mobile'] = $this->Mobile->CurrentValue;
		$row['Fax'] = $this->Fax->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['NumberOfBiologicalChildren'] = $this->NumberOfBiologicalChildren->CurrentValue;
		$row['NumberOfDependants'] = $this->NumberOfDependants->CurrentValue;
		$row['NextOfKin'] = $this->NextOfKin->CurrentValue;
		$row['RelationshipCode'] = $this->RelationshipCode->CurrentValue;
		$row['NextOfKinMobile'] = $this->NextOfKinMobile->CurrentValue;
		$row['NextOfKinEmail'] = $this->NextOfKinEmail->CurrentValue;
		$row['SpouseName'] = $this->SpouseName->CurrentValue;
		$row['SpouseNRC'] = $this->SpouseNRC->CurrentValue;
		$row['SpouseMobile'] = $this->SpouseMobile->CurrentValue;
		$row['SpouseEmail'] = $this->SpouseEmail->CurrentValue;
		$row['SpouseResidentialAddress'] = $this->SpouseResidentialAddress->CurrentValue;
		$row['AdditionalInformation'] = $this->AdditionalInformation->CurrentValue;
		$row['LastUserID'] = $this->LastUserID->CurrentValue;
		$row['LastUpdated'] = $this->LastUpdated->CurrentValue;
		$row['BankAccountNo'] = $this->BankAccountNo->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		$row['BankBranchCode'] = $this->BankBranchCode->CurrentValue;
		$row['TaxNumber'] = $this->TaxNumber->CurrentValue;
		$row['PensionNumber'] = $this->PensionNumber->CurrentValue;
		$row['SocialSecurityNo'] = $this->SocialSecurityNo->CurrentValue;
		$row['ThirdParties'] = $this->ThirdParties->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("EmployeeID")) != "")
			$this->EmployeeID->OldValue = $this->getKey("EmployeeID"); // EmployeeID
		else
			$validKey = FALSE;

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
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// LACode
		// FormerFileNumber
		// NRC
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// StaffPhoto
		// MaritalStatus
		// MaidenName
		// DateOfBirth
		// AcademicQualification
		// ProfessionalQualification
		// MedicalCondition
		// OtherMedicalConditions
		// PhysicalChallenge
		// PostalAddress
		// PhysicalAddress
		// TownOrVillage
		// Telephone
		// Mobile
		// Fax
		// Email
		// NumberOfBiologicalChildren
		// NumberOfDependants
		// NextOfKin
		// RelationshipCode
		// NextOfKinMobile
		// NextOfKinEmail
		// SpouseName
		// SpouseNRC
		// SpouseMobile
		// SpouseEmail
		// SpouseResidentialAddress
		// AdditionalInformation
		// LastUserID
		// LastUpdated
		// BankAccountNo
		// PaymentMethod
		// BankBranchCode
		// TaxNumber
		// PensionNumber
		// SocialSecurityNo
		// ThirdParties

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// FormerFileNumber
			$this->FormerFileNumber->ViewValue = $this->FormerFileNumber->CurrentValue;
			$this->FormerFileNumber->ViewCustomAttributes = "";

			// NRC
			$this->NRC->ViewValue = $this->NRC->CurrentValue;
			$this->NRC->ViewCustomAttributes = "";

			// Title
			$curVal = strval($this->Title->CurrentValue);
			if ($curVal != "") {
				$this->Title->ViewValue = $this->Title->lookupCacheOption($curVal);
				if ($this->Title->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Title`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Title->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Title->ViewValue = $this->Title->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Title->ViewValue = $this->Title->CurrentValue;
					}
				}
			} else {
				$this->Title->ViewValue = NULL;
			}
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
			$curVal = strval($this->Sex->CurrentValue);
			if ($curVal != "") {
				$this->Sex->ViewValue = $this->Sex->lookupCacheOption($curVal);
				if ($this->Sex->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Sex`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Sex->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Sex->ViewValue = $this->Sex->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Sex->ViewValue = $this->Sex->CurrentValue;
					}
				}
			} else {
				$this->Sex->ViewValue = NULL;
			}
			$this->Sex->ViewCustomAttributes = "";

			// MaritalStatus
			$curVal = strval($this->MaritalStatus->CurrentValue);
			if ($curVal != "") {
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
				if ($this->MaritalStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MaritalStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MaritalStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MaritalStatus->ViewValue = $this->MaritalStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MaritalStatus->ViewValue = $this->MaritalStatus->CurrentValue;
					}
				}
			} else {
				$this->MaritalStatus->ViewValue = NULL;
			}
			$this->MaritalStatus->ViewCustomAttributes = "";

			// MaidenName
			$this->MaidenName->ViewValue = $this->MaidenName->CurrentValue;
			$this->MaidenName->ViewCustomAttributes = "";

			// DateOfBirth
			$this->DateOfBirth->ViewValue = $this->DateOfBirth->CurrentValue;
			$this->DateOfBirth->ViewValue = FormatDateTime($this->DateOfBirth->ViewValue, 0);
			$this->DateOfBirth->ViewCustomAttributes = "";

			// AcademicQualification
			$curVal = strval($this->AcademicQualification->CurrentValue);
			if ($curVal != "") {
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
				if ($this->AcademicQualification->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AcademicQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AcademicQualification->ViewValue = $this->AcademicQualification->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AcademicQualification->ViewValue = $this->AcademicQualification->CurrentValue;
					}
				}
			} else {
				$this->AcademicQualification->ViewValue = NULL;
			}
			$this->AcademicQualification->ViewCustomAttributes = "";

			// ProfessionalQualification
			$curVal = strval($this->ProfessionalQualification->CurrentValue);
			if ($curVal != "") {
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
				if ($this->ProfessionalQualification->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->CurrentValue;
					}
				}
			} else {
				$this->ProfessionalQualification->ViewValue = NULL;
			}
			$this->ProfessionalQualification->ViewCustomAttributes = "";

			// MedicalCondition
			$curVal = strval($this->MedicalCondition->CurrentValue);
			if ($curVal != "") {
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
				if ($this->MedicalCondition->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MedicalCondition`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->MedicalCondition->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MedicalCondition->ViewValue = $this->MedicalCondition->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MedicalCondition->ViewValue = $this->MedicalCondition->CurrentValue;
					}
				}
			} else {
				$this->MedicalCondition->ViewValue = NULL;
			}
			$this->MedicalCondition->ViewCustomAttributes = "";

			// OtherMedicalConditions
			$curVal = strval($this->OtherMedicalConditions->CurrentValue);
			if ($curVal != "") {
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
				if ($this->OtherMedicalConditions->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MedicalCondition`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->OtherMedicalConditions->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->CurrentValue;
					}
				}
			} else {
				$this->OtherMedicalConditions->ViewValue = NULL;
			}
			$this->OtherMedicalConditions->ViewCustomAttributes = "";

			// PhysicalChallenge
			$curVal = strval($this->PhysicalChallenge->CurrentValue);
			if ($curVal != "") {
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
				if ($this->PhysicalChallenge->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PhysicalChallenge->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->CurrentValue;
					}
				}
			} else {
				$this->PhysicalChallenge->ViewValue = NULL;
			}
			$this->PhysicalChallenge->ViewCustomAttributes = "";

			// PostalAddress
			$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
			$this->PostalAddress->ViewCustomAttributes = "";

			// PhysicalAddress
			$this->PhysicalAddress->ViewValue = $this->PhysicalAddress->CurrentValue;
			$this->PhysicalAddress->ViewCustomAttributes = "";

			// TownOrVillage
			$this->TownOrVillage->ViewValue = $this->TownOrVillage->CurrentValue;
			$this->TownOrVillage->ViewCustomAttributes = "";

			// Telephone
			$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
			$this->Telephone->ViewCustomAttributes = "";

			// Mobile
			$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
			$this->Mobile->ViewCustomAttributes = "";

			// Fax
			$this->Fax->ViewValue = $this->Fax->CurrentValue;
			$this->Fax->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->ViewValue = $this->NumberOfBiologicalChildren->CurrentValue;
			$this->NumberOfBiologicalChildren->ViewValue = FormatNumber($this->NumberOfBiologicalChildren->ViewValue, 0, -2, -2, -2);
			$this->NumberOfBiologicalChildren->ViewCustomAttributes = "";

			// NumberOfDependants
			$this->NumberOfDependants->ViewValue = $this->NumberOfDependants->CurrentValue;
			$this->NumberOfDependants->ViewValue = FormatNumber($this->NumberOfDependants->ViewValue, 0, -2, -2, -2);
			$this->NumberOfDependants->ViewCustomAttributes = "";

			// NextOfKin
			$this->NextOfKin->ViewValue = $this->NextOfKin->CurrentValue;
			$this->NextOfKin->ViewCustomAttributes = "";

			// RelationshipCode
			$curVal = strval($this->RelationshipCode->CurrentValue);
			if ($curVal != "") {
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
				if ($this->RelationshipCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`RelationshipCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->RelationshipCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RelationshipCode->ViewValue = $this->RelationshipCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RelationshipCode->ViewValue = $this->RelationshipCode->CurrentValue;
					}
				}
			} else {
				$this->RelationshipCode->ViewValue = NULL;
			}
			$this->RelationshipCode->ViewCustomAttributes = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->ViewValue = $this->NextOfKinMobile->CurrentValue;
			$this->NextOfKinMobile->ViewCustomAttributes = "";

			// NextOfKinEmail
			$this->NextOfKinEmail->ViewValue = $this->NextOfKinEmail->CurrentValue;
			$this->NextOfKinEmail->ViewCustomAttributes = "";

			// SpouseName
			$this->SpouseName->ViewValue = $this->SpouseName->CurrentValue;
			$this->SpouseName->ViewCustomAttributes = "";

			// SpouseNRC
			$this->SpouseNRC->ViewValue = $this->SpouseNRC->CurrentValue;
			$this->SpouseNRC->ViewCustomAttributes = "";

			// SpouseMobile
			$this->SpouseMobile->ViewValue = $this->SpouseMobile->CurrentValue;
			$this->SpouseMobile->ViewCustomAttributes = "";

			// SpouseEmail
			$this->SpouseEmail->ViewValue = $this->SpouseEmail->CurrentValue;
			$this->SpouseEmail->ViewCustomAttributes = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->ViewValue = $this->SpouseResidentialAddress->CurrentValue;
			$this->SpouseResidentialAddress->ViewCustomAttributes = "";

			// BankAccountNo
			$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
			$this->BankAccountNo->ViewCustomAttributes = "";

			// PaymentMethod
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

			// BankBranchCode
			$curVal = strval($this->BankBranchCode->CurrentValue);
			if ($curVal != "") {
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
				if ($this->BankBranchCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->BankBranchCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
					}
				}
			} else {
				$this->BankBranchCode->ViewValue = NULL;
			}
			$this->BankBranchCode->ViewCustomAttributes = "";

			// TaxNumber
			$this->TaxNumber->ViewValue = $this->TaxNumber->CurrentValue;
			$this->TaxNumber->ViewCustomAttributes = "";

			// PensionNumber
			$this->PensionNumber->ViewValue = $this->PensionNumber->CurrentValue;
			$this->PensionNumber->ViewCustomAttributes = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->ViewValue = $this->SocialSecurityNo->CurrentValue;
			$this->SocialSecurityNo->ViewCustomAttributes = "";

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

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";
			if (!$this->isExport())
				$this->EmployeeID->ViewValue = $this->highlightValue($this->EmployeeID);

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// FormerFileNumber
			$this->FormerFileNumber->LinkCustomAttributes = "";
			$this->FormerFileNumber->HrefValue = "";
			$this->FormerFileNumber->TooltipValue = "";
			if (!$this->isExport())
				$this->FormerFileNumber->ViewValue = $this->highlightValue($this->FormerFileNumber);

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";
			$this->NRC->TooltipValue = "";
			if (!$this->isExport())
				$this->NRC->ViewValue = $this->highlightValue($this->NRC);

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";
			$this->Title->TooltipValue = "";

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

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";
			$this->MaritalStatus->TooltipValue = "";

			// MaidenName
			$this->MaidenName->LinkCustomAttributes = "";
			$this->MaidenName->HrefValue = "";
			$this->MaidenName->TooltipValue = "";
			if (!$this->isExport())
				$this->MaidenName->ViewValue = $this->highlightValue($this->MaidenName);

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";
			$this->DateOfBirth->TooltipValue = "";

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";
			$this->AcademicQualification->TooltipValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";
			$this->ProfessionalQualification->TooltipValue = "";

			// MedicalCondition
			$this->MedicalCondition->LinkCustomAttributes = "";
			$this->MedicalCondition->HrefValue = "";
			$this->MedicalCondition->TooltipValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";
			$this->OtherMedicalConditions->TooltipValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->LinkCustomAttributes = "";
			$this->PhysicalChallenge->HrefValue = "";
			$this->PhysicalChallenge->TooltipValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";
			$this->PostalAddress->TooltipValue = "";
			if (!$this->isExport())
				$this->PostalAddress->ViewValue = $this->highlightValue($this->PostalAddress);

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";
			$this->PhysicalAddress->TooltipValue = "";
			if (!$this->isExport())
				$this->PhysicalAddress->ViewValue = $this->highlightValue($this->PhysicalAddress);

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";
			$this->TownOrVillage->TooltipValue = "";
			if (!$this->isExport())
				$this->TownOrVillage->ViewValue = $this->highlightValue($this->TownOrVillage);

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";
			$this->Telephone->TooltipValue = "";
			if (!$this->isExport())
				$this->Telephone->ViewValue = $this->highlightValue($this->Telephone);

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";
			$this->Mobile->TooltipValue = "";
			if (!$this->isExport())
				$this->Mobile->ViewValue = $this->highlightValue($this->Mobile);

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";
			$this->Fax->TooltipValue = "";
			if (!$this->isExport())
				$this->Fax->ViewValue = $this->highlightValue($this->Fax);

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";
			if (!$this->isExport())
				$this->_Email->ViewValue = $this->highlightValue($this->_Email);

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->LinkCustomAttributes = "";
			$this->NumberOfBiologicalChildren->HrefValue = "";
			$this->NumberOfBiologicalChildren->TooltipValue = "";

			// NumberOfDependants
			$this->NumberOfDependants->LinkCustomAttributes = "";
			$this->NumberOfDependants->HrefValue = "";
			$this->NumberOfDependants->TooltipValue = "";

			// NextOfKin
			$this->NextOfKin->LinkCustomAttributes = "";
			$this->NextOfKin->HrefValue = "";
			$this->NextOfKin->TooltipValue = "";
			if (!$this->isExport())
				$this->NextOfKin->ViewValue = $this->highlightValue($this->NextOfKin);

			// RelationshipCode
			$this->RelationshipCode->LinkCustomAttributes = "";
			$this->RelationshipCode->HrefValue = "";
			$this->RelationshipCode->TooltipValue = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->LinkCustomAttributes = "";
			$this->NextOfKinMobile->HrefValue = "";
			$this->NextOfKinMobile->TooltipValue = "";
			if (!$this->isExport())
				$this->NextOfKinMobile->ViewValue = $this->highlightValue($this->NextOfKinMobile);

			// NextOfKinEmail
			$this->NextOfKinEmail->LinkCustomAttributes = "";
			$this->NextOfKinEmail->HrefValue = "";
			$this->NextOfKinEmail->TooltipValue = "";
			if (!$this->isExport())
				$this->NextOfKinEmail->ViewValue = $this->highlightValue($this->NextOfKinEmail);

			// SpouseName
			$this->SpouseName->LinkCustomAttributes = "";
			$this->SpouseName->HrefValue = "";
			$this->SpouseName->TooltipValue = "";
			if (!$this->isExport())
				$this->SpouseName->ViewValue = $this->highlightValue($this->SpouseName);

			// SpouseNRC
			$this->SpouseNRC->LinkCustomAttributes = "";
			$this->SpouseNRC->HrefValue = "";
			$this->SpouseNRC->TooltipValue = "";
			if (!$this->isExport())
				$this->SpouseNRC->ViewValue = $this->highlightValue($this->SpouseNRC);

			// SpouseMobile
			$this->SpouseMobile->LinkCustomAttributes = "";
			$this->SpouseMobile->HrefValue = "";
			$this->SpouseMobile->TooltipValue = "";
			if (!$this->isExport())
				$this->SpouseMobile->ViewValue = $this->highlightValue($this->SpouseMobile);

			// SpouseEmail
			$this->SpouseEmail->LinkCustomAttributes = "";
			$this->SpouseEmail->HrefValue = "";
			$this->SpouseEmail->TooltipValue = "";
			if (!$this->isExport())
				$this->SpouseEmail->ViewValue = $this->highlightValue($this->SpouseEmail);

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->LinkCustomAttributes = "";
			$this->SpouseResidentialAddress->HrefValue = "";
			$this->SpouseResidentialAddress->TooltipValue = "";
			if (!$this->isExport())
				$this->SpouseResidentialAddress->ViewValue = $this->highlightValue($this->SpouseResidentialAddress);

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
			$this->BankAccountNo->TooltipValue = "";
			if (!$this->isExport())
				$this->BankAccountNo->ViewValue = $this->highlightValue($this->BankAccountNo);

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";
			$this->BankBranchCode->TooltipValue = "";

			// TaxNumber
			$this->TaxNumber->LinkCustomAttributes = "";
			$this->TaxNumber->HrefValue = "";
			$this->TaxNumber->TooltipValue = "";
			if (!$this->isExport())
				$this->TaxNumber->ViewValue = $this->highlightValue($this->TaxNumber);

			// PensionNumber
			$this->PensionNumber->LinkCustomAttributes = "";
			$this->PensionNumber->HrefValue = "";
			$this->PensionNumber->TooltipValue = "";
			if (!$this->isExport())
				$this->PensionNumber->ViewValue = $this->highlightValue($this->PensionNumber);

			// SocialSecurityNo
			$this->SocialSecurityNo->LinkCustomAttributes = "";
			$this->SocialSecurityNo->HrefValue = "";
			$this->SocialSecurityNo->TooltipValue = "";
			if (!$this->isExport())
				$this->SocialSecurityNo->ViewValue = $this->highlightValue($this->SocialSecurityNo);

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
			$this->ThirdParties->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// EmployeeID
			// LACode

			$this->LACode->EditCustomAttributes = "";
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
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
				} else {
					$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// FormerFileNumber
			$this->FormerFileNumber->EditAttrs["class"] = "form-control";
			$this->FormerFileNumber->EditCustomAttributes = "";
			if (!$this->FormerFileNumber->Raw)
				$this->FormerFileNumber->CurrentValue = HtmlDecode($this->FormerFileNumber->CurrentValue);
			$this->FormerFileNumber->EditValue = HtmlEncode($this->FormerFileNumber->CurrentValue);
			$this->FormerFileNumber->PlaceHolder = RemoveHtml($this->FormerFileNumber->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			$curVal = trim(strval($this->Title->CurrentValue));
			if ($curVal != "")
				$this->Title->ViewValue = $this->Title->lookupCacheOption($curVal);
			else
				$this->Title->ViewValue = $this->Title->Lookup !== NULL && is_array($this->Title->Lookup->Options) ? $curVal : NULL;
			if ($this->Title->ViewValue !== NULL) { // Load from cache
				$this->Title->EditValue = array_values($this->Title->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Title`" . SearchString("=", $this->Title->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Title->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Title->EditValue = $arwrk;
			}

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
			$curVal = trim(strval($this->Sex->CurrentValue));
			if ($curVal != "")
				$this->Sex->ViewValue = $this->Sex->lookupCacheOption($curVal);
			else
				$this->Sex->ViewValue = $this->Sex->Lookup !== NULL && is_array($this->Sex->Lookup->Options) ? $curVal : NULL;
			if ($this->Sex->ViewValue !== NULL) { // Load from cache
				$this->Sex->EditValue = array_values($this->Sex->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Sex`" . SearchString("=", $this->Sex->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Sex->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Sex->EditValue = $arwrk;
			}

			// MaritalStatus
			$this->MaritalStatus->EditAttrs["class"] = "form-control";
			$this->MaritalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->MaritalStatus->CurrentValue));
			if ($curVal != "")
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
			else
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->Lookup !== NULL && is_array($this->MaritalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->MaritalStatus->ViewValue !== NULL) { // Load from cache
				$this->MaritalStatus->EditValue = array_values($this->MaritalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MaritalStatusCode`" . SearchString("=", $this->MaritalStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MaritalStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MaritalStatus->EditValue = $arwrk;
			}

			// MaidenName
			$this->MaidenName->EditAttrs["class"] = "form-control";
			$this->MaidenName->EditCustomAttributes = "";
			if (!$this->MaidenName->Raw)
				$this->MaidenName->CurrentValue = HtmlDecode($this->MaidenName->CurrentValue);
			$this->MaidenName->EditValue = HtmlEncode($this->MaidenName->CurrentValue);
			$this->MaidenName->PlaceHolder = RemoveHtml($this->MaidenName->caption());

			// DateOfBirth
			$this->DateOfBirth->EditAttrs["class"] = "form-control";
			$this->DateOfBirth->EditCustomAttributes = "";
			$this->DateOfBirth->EditValue = HtmlEncode(FormatDateTime($this->DateOfBirth->CurrentValue, 8));
			$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

			// AcademicQualification
			$this->AcademicQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->AcademicQualification->CurrentValue));
			if ($curVal != "")
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
			else
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->Lookup !== NULL && is_array($this->AcademicQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->AcademicQualification->ViewValue !== NULL) { // Load from cache
				$this->AcademicQualification->EditValue = array_values($this->AcademicQualification->Lookup->Options);
				if ($this->AcademicQualification->ViewValue == "")
					$this->AcademicQualification->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $this->AcademicQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AcademicQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AcademicQualification->ViewValue = $this->AcademicQualification->displayValue($arwrk);
				} else {
					$this->AcademicQualification->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AcademicQualification->EditValue = $arwrk;
			}

			// ProfessionalQualification
			$this->ProfessionalQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProfessionalQualification->CurrentValue));
			if ($curVal != "")
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
			else
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->Lookup !== NULL && is_array($this->ProfessionalQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->ProfessionalQualification->ViewValue !== NULL) { // Load from cache
				$this->ProfessionalQualification->EditValue = array_values($this->ProfessionalQualification->Lookup->Options);
				if ($this->ProfessionalQualification->ViewValue == "")
					$this->ProfessionalQualification->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->ProfessionalQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
				} else {
					$this->ProfessionalQualification->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProfessionalQualification->EditValue = $arwrk;
			}

			// MedicalCondition
			$this->MedicalCondition->EditAttrs["class"] = "form-control";
			$this->MedicalCondition->EditCustomAttributes = "";
			$curVal = trim(strval($this->MedicalCondition->CurrentValue));
			if ($curVal != "")
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
			else
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->Lookup !== NULL && is_array($this->MedicalCondition->Lookup->Options) ? $curVal : NULL;
			if ($this->MedicalCondition->ViewValue !== NULL) { // Load from cache
				$this->MedicalCondition->EditValue = array_values($this->MedicalCondition->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->MedicalCondition->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->MedicalCondition->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MedicalCondition->EditValue = $arwrk;
			}

			// OtherMedicalConditions
			$this->OtherMedicalConditions->EditAttrs["class"] = "form-control";
			$this->OtherMedicalConditions->EditCustomAttributes = "";
			$curVal = trim(strval($this->OtherMedicalConditions->CurrentValue));
			if ($curVal != "")
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
			else
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->Lookup !== NULL && is_array($this->OtherMedicalConditions->Lookup->Options) ? $curVal : NULL;
			if ($this->OtherMedicalConditions->ViewValue !== NULL) { // Load from cache
				$this->OtherMedicalConditions->EditValue = array_values($this->OtherMedicalConditions->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->OtherMedicalConditions->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->OtherMedicalConditions->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OtherMedicalConditions->EditValue = $arwrk;
			}

			// PhysicalChallenge
			$this->PhysicalChallenge->EditAttrs["class"] = "form-control";
			$this->PhysicalChallenge->EditCustomAttributes = "";
			$curVal = trim(strval($this->PhysicalChallenge->CurrentValue));
			if ($curVal != "")
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
			else
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->Lookup !== NULL && is_array($this->PhysicalChallenge->Lookup->Options) ? $curVal : NULL;
			if ($this->PhysicalChallenge->ViewValue !== NULL) { // Load from cache
				$this->PhysicalChallenge->EditValue = array_values($this->PhysicalChallenge->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $this->PhysicalChallenge->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PhysicalChallenge->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PhysicalChallenge->EditValue = $arwrk;
			}

			// PostalAddress
			$this->PostalAddress->EditAttrs["class"] = "form-control";
			$this->PostalAddress->EditCustomAttributes = "";
			if (!$this->PostalAddress->Raw)
				$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

			// PhysicalAddress
			$this->PhysicalAddress->EditAttrs["class"] = "form-control";
			$this->PhysicalAddress->EditCustomAttributes = "";
			if (!$this->PhysicalAddress->Raw)
				$this->PhysicalAddress->CurrentValue = HtmlDecode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->EditValue = HtmlEncode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->PlaceHolder = RemoveHtml($this->PhysicalAddress->caption());

			// TownOrVillage
			$this->TownOrVillage->EditAttrs["class"] = "form-control";
			$this->TownOrVillage->EditCustomAttributes = "";
			if (!$this->TownOrVillage->Raw)
				$this->TownOrVillage->CurrentValue = HtmlDecode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->EditValue = HtmlEncode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->CurrentValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->CurrentValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Fax
			$this->Fax->EditAttrs["class"] = "form-control";
			$this->Fax->EditCustomAttributes = "";
			if (!$this->Fax->Raw)
				$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
			$this->Fax->EditValue = HtmlEncode($this->Fax->CurrentValue);
			$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->EditAttrs["class"] = "form-control";
			$this->NumberOfBiologicalChildren->EditCustomAttributes = "";
			$this->NumberOfBiologicalChildren->EditValue = HtmlEncode($this->NumberOfBiologicalChildren->CurrentValue);
			$this->NumberOfBiologicalChildren->PlaceHolder = RemoveHtml($this->NumberOfBiologicalChildren->caption());

			// NumberOfDependants
			$this->NumberOfDependants->EditAttrs["class"] = "form-control";
			$this->NumberOfDependants->EditCustomAttributes = "";
			$this->NumberOfDependants->EditValue = HtmlEncode($this->NumberOfDependants->CurrentValue);
			$this->NumberOfDependants->PlaceHolder = RemoveHtml($this->NumberOfDependants->caption());

			// NextOfKin
			$this->NextOfKin->EditAttrs["class"] = "form-control";
			$this->NextOfKin->EditCustomAttributes = "";
			if (!$this->NextOfKin->Raw)
				$this->NextOfKin->CurrentValue = HtmlDecode($this->NextOfKin->CurrentValue);
			$this->NextOfKin->EditValue = HtmlEncode($this->NextOfKin->CurrentValue);
			$this->NextOfKin->PlaceHolder = RemoveHtml($this->NextOfKin->caption());

			// RelationshipCode
			$this->RelationshipCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->RelationshipCode->CurrentValue));
			if ($curVal != "")
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
			else
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->Lookup !== NULL && is_array($this->RelationshipCode->Lookup->Options) ? $curVal : NULL;
			if ($this->RelationshipCode->ViewValue !== NULL) { // Load from cache
				$this->RelationshipCode->EditValue = array_values($this->RelationshipCode->Lookup->Options);
				if ($this->RelationshipCode->ViewValue == "")
					$this->RelationshipCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`RelationshipCode`" . SearchString("=", $this->RelationshipCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->RelationshipCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->RelationshipCode->ViewValue = $this->RelationshipCode->displayValue($arwrk);
				} else {
					$this->RelationshipCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RelationshipCode->EditValue = $arwrk;
			}

			// NextOfKinMobile
			$this->NextOfKinMobile->EditAttrs["class"] = "form-control";
			$this->NextOfKinMobile->EditCustomAttributes = "";
			if (!$this->NextOfKinMobile->Raw)
				$this->NextOfKinMobile->CurrentValue = HtmlDecode($this->NextOfKinMobile->CurrentValue);
			$this->NextOfKinMobile->EditValue = HtmlEncode($this->NextOfKinMobile->CurrentValue);
			$this->NextOfKinMobile->PlaceHolder = RemoveHtml($this->NextOfKinMobile->caption());

			// NextOfKinEmail
			$this->NextOfKinEmail->EditAttrs["class"] = "form-control";
			$this->NextOfKinEmail->EditCustomAttributes = "";
			if (!$this->NextOfKinEmail->Raw)
				$this->NextOfKinEmail->CurrentValue = HtmlDecode($this->NextOfKinEmail->CurrentValue);
			$this->NextOfKinEmail->EditValue = HtmlEncode($this->NextOfKinEmail->CurrentValue);
			$this->NextOfKinEmail->PlaceHolder = RemoveHtml($this->NextOfKinEmail->caption());

			// SpouseName
			$this->SpouseName->EditAttrs["class"] = "form-control";
			$this->SpouseName->EditCustomAttributes = "";
			if (!$this->SpouseName->Raw)
				$this->SpouseName->CurrentValue = HtmlDecode($this->SpouseName->CurrentValue);
			$this->SpouseName->EditValue = HtmlEncode($this->SpouseName->CurrentValue);
			$this->SpouseName->PlaceHolder = RemoveHtml($this->SpouseName->caption());

			// SpouseNRC
			$this->SpouseNRC->EditAttrs["class"] = "form-control";
			$this->SpouseNRC->EditCustomAttributes = "";
			if (!$this->SpouseNRC->Raw)
				$this->SpouseNRC->CurrentValue = HtmlDecode($this->SpouseNRC->CurrentValue);
			$this->SpouseNRC->EditValue = HtmlEncode($this->SpouseNRC->CurrentValue);
			$this->SpouseNRC->PlaceHolder = RemoveHtml($this->SpouseNRC->caption());

			// SpouseMobile
			$this->SpouseMobile->EditAttrs["class"] = "form-control";
			$this->SpouseMobile->EditCustomAttributes = "";
			if (!$this->SpouseMobile->Raw)
				$this->SpouseMobile->CurrentValue = HtmlDecode($this->SpouseMobile->CurrentValue);
			$this->SpouseMobile->EditValue = HtmlEncode($this->SpouseMobile->CurrentValue);
			$this->SpouseMobile->PlaceHolder = RemoveHtml($this->SpouseMobile->caption());

			// SpouseEmail
			$this->SpouseEmail->EditAttrs["class"] = "form-control";
			$this->SpouseEmail->EditCustomAttributes = "";
			if (!$this->SpouseEmail->Raw)
				$this->SpouseEmail->CurrentValue = HtmlDecode($this->SpouseEmail->CurrentValue);
			$this->SpouseEmail->EditValue = HtmlEncode($this->SpouseEmail->CurrentValue);
			$this->SpouseEmail->PlaceHolder = RemoveHtml($this->SpouseEmail->caption());

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->EditAttrs["class"] = "form-control";
			$this->SpouseResidentialAddress->EditCustomAttributes = "";
			if (!$this->SpouseResidentialAddress->Raw)
				$this->SpouseResidentialAddress->CurrentValue = HtmlDecode($this->SpouseResidentialAddress->CurrentValue);
			$this->SpouseResidentialAddress->EditValue = HtmlEncode($this->SpouseResidentialAddress->CurrentValue);
			$this->SpouseResidentialAddress->PlaceHolder = RemoveHtml($this->SpouseResidentialAddress->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PaymentMethod->CurrentValue));
			if ($curVal != "")
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			else
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->PaymentMethod->ViewValue !== NULL) { // Load from cache
				$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PaymentMethod->EditValue = $arwrk;
			}

			// BankBranchCode
			$this->BankBranchCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BankBranchCode->CurrentValue));
			if ($curVal != "")
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
			else
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->Lookup !== NULL && is_array($this->BankBranchCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BankBranchCode->ViewValue !== NULL) { // Load from cache
				$this->BankBranchCode->EditValue = array_values($this->BankBranchCode->Lookup->Options);
				if ($this->BankBranchCode->ViewValue == "")
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BranchCode`" . SearchString("=", $this->BankBranchCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->BankBranchCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
				} else {
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BankBranchCode->EditValue = $arwrk;
			}

			// TaxNumber
			$this->TaxNumber->EditAttrs["class"] = "form-control";
			$this->TaxNumber->EditCustomAttributes = "";
			if (!$this->TaxNumber->Raw)
				$this->TaxNumber->CurrentValue = HtmlDecode($this->TaxNumber->CurrentValue);
			$this->TaxNumber->EditValue = HtmlEncode($this->TaxNumber->CurrentValue);
			$this->TaxNumber->PlaceHolder = RemoveHtml($this->TaxNumber->caption());

			// PensionNumber
			$this->PensionNumber->EditAttrs["class"] = "form-control";
			$this->PensionNumber->EditCustomAttributes = "";
			if (!$this->PensionNumber->Raw)
				$this->PensionNumber->CurrentValue = HtmlDecode($this->PensionNumber->CurrentValue);
			$this->PensionNumber->EditValue = HtmlEncode($this->PensionNumber->CurrentValue);
			$this->PensionNumber->PlaceHolder = RemoveHtml($this->PensionNumber->caption());

			// SocialSecurityNo
			$this->SocialSecurityNo->EditAttrs["class"] = "form-control";
			$this->SocialSecurityNo->EditCustomAttributes = "";
			if (!$this->SocialSecurityNo->Raw)
				$this->SocialSecurityNo->CurrentValue = HtmlDecode($this->SocialSecurityNo->CurrentValue);
			$this->SocialSecurityNo->EditValue = HtmlEncode($this->SocialSecurityNo->CurrentValue);
			$this->SocialSecurityNo->PlaceHolder = RemoveHtml($this->SocialSecurityNo->caption());

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

			// Add refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// FormerFileNumber
			$this->FormerFileNumber->LinkCustomAttributes = "";
			$this->FormerFileNumber->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

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

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";

			// MaidenName
			$this->MaidenName->LinkCustomAttributes = "";
			$this->MaidenName->HrefValue = "";

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";

			// MedicalCondition
			$this->MedicalCondition->LinkCustomAttributes = "";
			$this->MedicalCondition->HrefValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->LinkCustomAttributes = "";
			$this->PhysicalChallenge->HrefValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->LinkCustomAttributes = "";
			$this->NumberOfBiologicalChildren->HrefValue = "";

			// NumberOfDependants
			$this->NumberOfDependants->LinkCustomAttributes = "";
			$this->NumberOfDependants->HrefValue = "";

			// NextOfKin
			$this->NextOfKin->LinkCustomAttributes = "";
			$this->NextOfKin->HrefValue = "";

			// RelationshipCode
			$this->RelationshipCode->LinkCustomAttributes = "";
			$this->RelationshipCode->HrefValue = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->LinkCustomAttributes = "";
			$this->NextOfKinMobile->HrefValue = "";

			// NextOfKinEmail
			$this->NextOfKinEmail->LinkCustomAttributes = "";
			$this->NextOfKinEmail->HrefValue = "";

			// SpouseName
			$this->SpouseName->LinkCustomAttributes = "";
			$this->SpouseName->HrefValue = "";

			// SpouseNRC
			$this->SpouseNRC->LinkCustomAttributes = "";
			$this->SpouseNRC->HrefValue = "";

			// SpouseMobile
			$this->SpouseMobile->LinkCustomAttributes = "";
			$this->SpouseMobile->HrefValue = "";

			// SpouseEmail
			$this->SpouseEmail->LinkCustomAttributes = "";
			$this->SpouseEmail->HrefValue = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->LinkCustomAttributes = "";
			$this->SpouseResidentialAddress->HrefValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";

			// TaxNumber
			$this->TaxNumber->LinkCustomAttributes = "";
			$this->TaxNumber->HrefValue = "";

			// PensionNumber
			$this->PensionNumber->LinkCustomAttributes = "";
			$this->PensionNumber->HrefValue = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->LinkCustomAttributes = "";
			$this->SocialSecurityNo->HrefValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// LACode
			$this->LACode->EditCustomAttributes = "";
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
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
				} else {
					$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// FormerFileNumber
			$this->FormerFileNumber->EditAttrs["class"] = "form-control";
			$this->FormerFileNumber->EditCustomAttributes = "";
			if (!$this->FormerFileNumber->Raw)
				$this->FormerFileNumber->CurrentValue = HtmlDecode($this->FormerFileNumber->CurrentValue);
			$this->FormerFileNumber->EditValue = HtmlEncode($this->FormerFileNumber->CurrentValue);
			$this->FormerFileNumber->PlaceHolder = RemoveHtml($this->FormerFileNumber->caption());

			// NRC
			$this->NRC->EditAttrs["class"] = "form-control";
			$this->NRC->EditCustomAttributes = "";
			if (!$this->NRC->Raw)
				$this->NRC->CurrentValue = HtmlDecode($this->NRC->CurrentValue);
			$this->NRC->EditValue = HtmlEncode($this->NRC->CurrentValue);
			$this->NRC->PlaceHolder = RemoveHtml($this->NRC->caption());

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			$curVal = trim(strval($this->Title->CurrentValue));
			if ($curVal != "")
				$this->Title->ViewValue = $this->Title->lookupCacheOption($curVal);
			else
				$this->Title->ViewValue = $this->Title->Lookup !== NULL && is_array($this->Title->Lookup->Options) ? $curVal : NULL;
			if ($this->Title->ViewValue !== NULL) { // Load from cache
				$this->Title->EditValue = array_values($this->Title->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Title`" . SearchString("=", $this->Title->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Title->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Title->EditValue = $arwrk;
			}

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
			$curVal = trim(strval($this->Sex->CurrentValue));
			if ($curVal != "")
				$this->Sex->ViewValue = $this->Sex->lookupCacheOption($curVal);
			else
				$this->Sex->ViewValue = $this->Sex->Lookup !== NULL && is_array($this->Sex->Lookup->Options) ? $curVal : NULL;
			if ($this->Sex->ViewValue !== NULL) { // Load from cache
				$this->Sex->EditValue = array_values($this->Sex->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Sex`" . SearchString("=", $this->Sex->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Sex->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Sex->EditValue = $arwrk;
			}

			// MaritalStatus
			$this->MaritalStatus->EditAttrs["class"] = "form-control";
			$this->MaritalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->MaritalStatus->CurrentValue));
			if ($curVal != "")
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
			else
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->Lookup !== NULL && is_array($this->MaritalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->MaritalStatus->ViewValue !== NULL) { // Load from cache
				$this->MaritalStatus->EditValue = array_values($this->MaritalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MaritalStatusCode`" . SearchString("=", $this->MaritalStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MaritalStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MaritalStatus->EditValue = $arwrk;
			}

			// MaidenName
			$this->MaidenName->EditAttrs["class"] = "form-control";
			$this->MaidenName->EditCustomAttributes = "";
			if (!$this->MaidenName->Raw)
				$this->MaidenName->CurrentValue = HtmlDecode($this->MaidenName->CurrentValue);
			$this->MaidenName->EditValue = HtmlEncode($this->MaidenName->CurrentValue);
			$this->MaidenName->PlaceHolder = RemoveHtml($this->MaidenName->caption());

			// DateOfBirth
			$this->DateOfBirth->EditAttrs["class"] = "form-control";
			$this->DateOfBirth->EditCustomAttributes = "";
			$this->DateOfBirth->EditValue = HtmlEncode(FormatDateTime($this->DateOfBirth->CurrentValue, 8));
			$this->DateOfBirth->PlaceHolder = RemoveHtml($this->DateOfBirth->caption());

			// AcademicQualification
			$this->AcademicQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->AcademicQualification->CurrentValue));
			if ($curVal != "")
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
			else
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->Lookup !== NULL && is_array($this->AcademicQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->AcademicQualification->ViewValue !== NULL) { // Load from cache
				$this->AcademicQualification->EditValue = array_values($this->AcademicQualification->Lookup->Options);
				if ($this->AcademicQualification->ViewValue == "")
					$this->AcademicQualification->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $this->AcademicQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AcademicQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AcademicQualification->ViewValue = $this->AcademicQualification->displayValue($arwrk);
				} else {
					$this->AcademicQualification->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AcademicQualification->EditValue = $arwrk;
			}

			// ProfessionalQualification
			$this->ProfessionalQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProfessionalQualification->CurrentValue));
			if ($curVal != "")
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
			else
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->Lookup !== NULL && is_array($this->ProfessionalQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->ProfessionalQualification->ViewValue !== NULL) { // Load from cache
				$this->ProfessionalQualification->EditValue = array_values($this->ProfessionalQualification->Lookup->Options);
				if ($this->ProfessionalQualification->ViewValue == "")
					$this->ProfessionalQualification->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->ProfessionalQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
				} else {
					$this->ProfessionalQualification->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProfessionalQualification->EditValue = $arwrk;
			}

			// MedicalCondition
			$this->MedicalCondition->EditAttrs["class"] = "form-control";
			$this->MedicalCondition->EditCustomAttributes = "";
			$curVal = trim(strval($this->MedicalCondition->CurrentValue));
			if ($curVal != "")
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
			else
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->Lookup !== NULL && is_array($this->MedicalCondition->Lookup->Options) ? $curVal : NULL;
			if ($this->MedicalCondition->ViewValue !== NULL) { // Load from cache
				$this->MedicalCondition->EditValue = array_values($this->MedicalCondition->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->MedicalCondition->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->MedicalCondition->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MedicalCondition->EditValue = $arwrk;
			}

			// OtherMedicalConditions
			$this->OtherMedicalConditions->EditAttrs["class"] = "form-control";
			$this->OtherMedicalConditions->EditCustomAttributes = "";
			$curVal = trim(strval($this->OtherMedicalConditions->CurrentValue));
			if ($curVal != "")
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
			else
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->Lookup !== NULL && is_array($this->OtherMedicalConditions->Lookup->Options) ? $curVal : NULL;
			if ($this->OtherMedicalConditions->ViewValue !== NULL) { // Load from cache
				$this->OtherMedicalConditions->EditValue = array_values($this->OtherMedicalConditions->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MedicalCondition`" . SearchString("=", $this->OtherMedicalConditions->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->OtherMedicalConditions->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OtherMedicalConditions->EditValue = $arwrk;
			}

			// PhysicalChallenge
			$this->PhysicalChallenge->EditAttrs["class"] = "form-control";
			$this->PhysicalChallenge->EditCustomAttributes = "";
			$curVal = trim(strval($this->PhysicalChallenge->CurrentValue));
			if ($curVal != "")
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
			else
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->Lookup !== NULL && is_array($this->PhysicalChallenge->Lookup->Options) ? $curVal : NULL;
			if ($this->PhysicalChallenge->ViewValue !== NULL) { // Load from cache
				$this->PhysicalChallenge->EditValue = array_values($this->PhysicalChallenge->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $this->PhysicalChallenge->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PhysicalChallenge->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PhysicalChallenge->EditValue = $arwrk;
			}

			// PostalAddress
			$this->PostalAddress->EditAttrs["class"] = "form-control";
			$this->PostalAddress->EditCustomAttributes = "";
			if (!$this->PostalAddress->Raw)
				$this->PostalAddress->CurrentValue = HtmlDecode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->EditValue = HtmlEncode($this->PostalAddress->CurrentValue);
			$this->PostalAddress->PlaceHolder = RemoveHtml($this->PostalAddress->caption());

			// PhysicalAddress
			$this->PhysicalAddress->EditAttrs["class"] = "form-control";
			$this->PhysicalAddress->EditCustomAttributes = "";
			if (!$this->PhysicalAddress->Raw)
				$this->PhysicalAddress->CurrentValue = HtmlDecode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->EditValue = HtmlEncode($this->PhysicalAddress->CurrentValue);
			$this->PhysicalAddress->PlaceHolder = RemoveHtml($this->PhysicalAddress->caption());

			// TownOrVillage
			$this->TownOrVillage->EditAttrs["class"] = "form-control";
			$this->TownOrVillage->EditCustomAttributes = "";
			if (!$this->TownOrVillage->Raw)
				$this->TownOrVillage->CurrentValue = HtmlDecode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->EditValue = HtmlEncode($this->TownOrVillage->CurrentValue);
			$this->TownOrVillage->PlaceHolder = RemoveHtml($this->TownOrVillage->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->CurrentValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->CurrentValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Fax
			$this->Fax->EditAttrs["class"] = "form-control";
			$this->Fax->EditCustomAttributes = "";
			if (!$this->Fax->Raw)
				$this->Fax->CurrentValue = HtmlDecode($this->Fax->CurrentValue);
			$this->Fax->EditValue = HtmlEncode($this->Fax->CurrentValue);
			$this->Fax->PlaceHolder = RemoveHtml($this->Fax->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->EditAttrs["class"] = "form-control";
			$this->NumberOfBiologicalChildren->EditCustomAttributes = "";
			$this->NumberOfBiologicalChildren->EditValue = HtmlEncode($this->NumberOfBiologicalChildren->CurrentValue);
			$this->NumberOfBiologicalChildren->PlaceHolder = RemoveHtml($this->NumberOfBiologicalChildren->caption());

			// NumberOfDependants
			$this->NumberOfDependants->EditAttrs["class"] = "form-control";
			$this->NumberOfDependants->EditCustomAttributes = "";
			$this->NumberOfDependants->EditValue = HtmlEncode($this->NumberOfDependants->CurrentValue);
			$this->NumberOfDependants->PlaceHolder = RemoveHtml($this->NumberOfDependants->caption());

			// NextOfKin
			$this->NextOfKin->EditAttrs["class"] = "form-control";
			$this->NextOfKin->EditCustomAttributes = "";
			if (!$this->NextOfKin->Raw)
				$this->NextOfKin->CurrentValue = HtmlDecode($this->NextOfKin->CurrentValue);
			$this->NextOfKin->EditValue = HtmlEncode($this->NextOfKin->CurrentValue);
			$this->NextOfKin->PlaceHolder = RemoveHtml($this->NextOfKin->caption());

			// RelationshipCode
			$this->RelationshipCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->RelationshipCode->CurrentValue));
			if ($curVal != "")
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
			else
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->Lookup !== NULL && is_array($this->RelationshipCode->Lookup->Options) ? $curVal : NULL;
			if ($this->RelationshipCode->ViewValue !== NULL) { // Load from cache
				$this->RelationshipCode->EditValue = array_values($this->RelationshipCode->Lookup->Options);
				if ($this->RelationshipCode->ViewValue == "")
					$this->RelationshipCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`RelationshipCode`" . SearchString("=", $this->RelationshipCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->RelationshipCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->RelationshipCode->ViewValue = $this->RelationshipCode->displayValue($arwrk);
				} else {
					$this->RelationshipCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RelationshipCode->EditValue = $arwrk;
			}

			// NextOfKinMobile
			$this->NextOfKinMobile->EditAttrs["class"] = "form-control";
			$this->NextOfKinMobile->EditCustomAttributes = "";
			if (!$this->NextOfKinMobile->Raw)
				$this->NextOfKinMobile->CurrentValue = HtmlDecode($this->NextOfKinMobile->CurrentValue);
			$this->NextOfKinMobile->EditValue = HtmlEncode($this->NextOfKinMobile->CurrentValue);
			$this->NextOfKinMobile->PlaceHolder = RemoveHtml($this->NextOfKinMobile->caption());

			// NextOfKinEmail
			$this->NextOfKinEmail->EditAttrs["class"] = "form-control";
			$this->NextOfKinEmail->EditCustomAttributes = "";
			if (!$this->NextOfKinEmail->Raw)
				$this->NextOfKinEmail->CurrentValue = HtmlDecode($this->NextOfKinEmail->CurrentValue);
			$this->NextOfKinEmail->EditValue = HtmlEncode($this->NextOfKinEmail->CurrentValue);
			$this->NextOfKinEmail->PlaceHolder = RemoveHtml($this->NextOfKinEmail->caption());

			// SpouseName
			$this->SpouseName->EditAttrs["class"] = "form-control";
			$this->SpouseName->EditCustomAttributes = "";
			if (!$this->SpouseName->Raw)
				$this->SpouseName->CurrentValue = HtmlDecode($this->SpouseName->CurrentValue);
			$this->SpouseName->EditValue = HtmlEncode($this->SpouseName->CurrentValue);
			$this->SpouseName->PlaceHolder = RemoveHtml($this->SpouseName->caption());

			// SpouseNRC
			$this->SpouseNRC->EditAttrs["class"] = "form-control";
			$this->SpouseNRC->EditCustomAttributes = "";
			if (!$this->SpouseNRC->Raw)
				$this->SpouseNRC->CurrentValue = HtmlDecode($this->SpouseNRC->CurrentValue);
			$this->SpouseNRC->EditValue = HtmlEncode($this->SpouseNRC->CurrentValue);
			$this->SpouseNRC->PlaceHolder = RemoveHtml($this->SpouseNRC->caption());

			// SpouseMobile
			$this->SpouseMobile->EditAttrs["class"] = "form-control";
			$this->SpouseMobile->EditCustomAttributes = "";
			if (!$this->SpouseMobile->Raw)
				$this->SpouseMobile->CurrentValue = HtmlDecode($this->SpouseMobile->CurrentValue);
			$this->SpouseMobile->EditValue = HtmlEncode($this->SpouseMobile->CurrentValue);
			$this->SpouseMobile->PlaceHolder = RemoveHtml($this->SpouseMobile->caption());

			// SpouseEmail
			$this->SpouseEmail->EditAttrs["class"] = "form-control";
			$this->SpouseEmail->EditCustomAttributes = "";
			if (!$this->SpouseEmail->Raw)
				$this->SpouseEmail->CurrentValue = HtmlDecode($this->SpouseEmail->CurrentValue);
			$this->SpouseEmail->EditValue = HtmlEncode($this->SpouseEmail->CurrentValue);
			$this->SpouseEmail->PlaceHolder = RemoveHtml($this->SpouseEmail->caption());

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->EditAttrs["class"] = "form-control";
			$this->SpouseResidentialAddress->EditCustomAttributes = "";
			if (!$this->SpouseResidentialAddress->Raw)
				$this->SpouseResidentialAddress->CurrentValue = HtmlDecode($this->SpouseResidentialAddress->CurrentValue);
			$this->SpouseResidentialAddress->EditValue = HtmlEncode($this->SpouseResidentialAddress->CurrentValue);
			$this->SpouseResidentialAddress->PlaceHolder = RemoveHtml($this->SpouseResidentialAddress->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->CurrentValue = HtmlDecode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->CurrentValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PaymentMethod->CurrentValue));
			if ($curVal != "")
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			else
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->PaymentMethod->ViewValue !== NULL) { // Load from cache
				$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PaymentMethod->EditValue = $arwrk;
			}

			// BankBranchCode
			$this->BankBranchCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BankBranchCode->CurrentValue));
			if ($curVal != "")
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
			else
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->Lookup !== NULL && is_array($this->BankBranchCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BankBranchCode->ViewValue !== NULL) { // Load from cache
				$this->BankBranchCode->EditValue = array_values($this->BankBranchCode->Lookup->Options);
				if ($this->BankBranchCode->ViewValue == "")
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`BranchCode`" . SearchString("=", $this->BankBranchCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->BankBranchCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
				} else {
					$this->BankBranchCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BankBranchCode->EditValue = $arwrk;
			}

			// TaxNumber
			$this->TaxNumber->EditAttrs["class"] = "form-control";
			$this->TaxNumber->EditCustomAttributes = "";
			if (!$this->TaxNumber->Raw)
				$this->TaxNumber->CurrentValue = HtmlDecode($this->TaxNumber->CurrentValue);
			$this->TaxNumber->EditValue = HtmlEncode($this->TaxNumber->CurrentValue);
			$this->TaxNumber->PlaceHolder = RemoveHtml($this->TaxNumber->caption());

			// PensionNumber
			$this->PensionNumber->EditAttrs["class"] = "form-control";
			$this->PensionNumber->EditCustomAttributes = "";
			if (!$this->PensionNumber->Raw)
				$this->PensionNumber->CurrentValue = HtmlDecode($this->PensionNumber->CurrentValue);
			$this->PensionNumber->EditValue = HtmlEncode($this->PensionNumber->CurrentValue);
			$this->PensionNumber->PlaceHolder = RemoveHtml($this->PensionNumber->caption());

			// SocialSecurityNo
			$this->SocialSecurityNo->EditAttrs["class"] = "form-control";
			$this->SocialSecurityNo->EditCustomAttributes = "";
			if (!$this->SocialSecurityNo->Raw)
				$this->SocialSecurityNo->CurrentValue = HtmlDecode($this->SocialSecurityNo->CurrentValue);
			$this->SocialSecurityNo->EditValue = HtmlEncode($this->SocialSecurityNo->CurrentValue);
			$this->SocialSecurityNo->PlaceHolder = RemoveHtml($this->SocialSecurityNo->caption());

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

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// FormerFileNumber
			$this->FormerFileNumber->LinkCustomAttributes = "";
			$this->FormerFileNumber->HrefValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";

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

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";

			// MaidenName
			$this->MaidenName->LinkCustomAttributes = "";
			$this->MaidenName->HrefValue = "";

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";

			// MedicalCondition
			$this->MedicalCondition->LinkCustomAttributes = "";
			$this->MedicalCondition->HrefValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->LinkCustomAttributes = "";
			$this->PhysicalChallenge->HrefValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->LinkCustomAttributes = "";
			$this->NumberOfBiologicalChildren->HrefValue = "";

			// NumberOfDependants
			$this->NumberOfDependants->LinkCustomAttributes = "";
			$this->NumberOfDependants->HrefValue = "";

			// NextOfKin
			$this->NextOfKin->LinkCustomAttributes = "";
			$this->NextOfKin->HrefValue = "";

			// RelationshipCode
			$this->RelationshipCode->LinkCustomAttributes = "";
			$this->RelationshipCode->HrefValue = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->LinkCustomAttributes = "";
			$this->NextOfKinMobile->HrefValue = "";

			// NextOfKinEmail
			$this->NextOfKinEmail->LinkCustomAttributes = "";
			$this->NextOfKinEmail->HrefValue = "";

			// SpouseName
			$this->SpouseName->LinkCustomAttributes = "";
			$this->SpouseName->HrefValue = "";

			// SpouseNRC
			$this->SpouseNRC->LinkCustomAttributes = "";
			$this->SpouseNRC->HrefValue = "";

			// SpouseMobile
			$this->SpouseMobile->LinkCustomAttributes = "";
			$this->SpouseMobile->HrefValue = "";

			// SpouseEmail
			$this->SpouseEmail->LinkCustomAttributes = "";
			$this->SpouseEmail->HrefValue = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->LinkCustomAttributes = "";
			$this->SpouseResidentialAddress->HrefValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";

			// TaxNumber
			$this->TaxNumber->LinkCustomAttributes = "";
			$this->TaxNumber->HrefValue = "";

			// PensionNumber
			$this->PensionNumber->LinkCustomAttributes = "";
			$this->PensionNumber->HrefValue = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->LinkCustomAttributes = "";
			$this->SocialSecurityNo->HrefValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->FormerFileNumber->Required) {
			if (!$this->FormerFileNumber->IsDetailKey && $this->FormerFileNumber->FormValue != NULL && $this->FormerFileNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FormerFileNumber->caption(), $this->FormerFileNumber->RequiredErrorMessage));
			}
		}
		if ($this->NRC->Required) {
			if (!$this->NRC->IsDetailKey && $this->NRC->FormValue != NULL && $this->NRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NRC->caption(), $this->NRC->RequiredErrorMessage));
			}
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
		if ($this->MaritalStatus->Required) {
			if (!$this->MaritalStatus->IsDetailKey && $this->MaritalStatus->FormValue != NULL && $this->MaritalStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaritalStatus->caption(), $this->MaritalStatus->RequiredErrorMessage));
			}
		}
		if ($this->MaidenName->Required) {
			if (!$this->MaidenName->IsDetailKey && $this->MaidenName->FormValue != NULL && $this->MaidenName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaidenName->caption(), $this->MaidenName->RequiredErrorMessage));
			}
		}
		if ($this->DateOfBirth->Required) {
			if (!$this->DateOfBirth->IsDetailKey && $this->DateOfBirth->FormValue != NULL && $this->DateOfBirth->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfBirth->caption(), $this->DateOfBirth->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfBirth->FormValue)) {
			AddMessage($FormError, $this->DateOfBirth->errorMessage());
		}
		if ($this->AcademicQualification->Required) {
			if (!$this->AcademicQualification->IsDetailKey && $this->AcademicQualification->FormValue != NULL && $this->AcademicQualification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AcademicQualification->caption(), $this->AcademicQualification->RequiredErrorMessage));
			}
		}
		if ($this->ProfessionalQualification->Required) {
			if (!$this->ProfessionalQualification->IsDetailKey && $this->ProfessionalQualification->FormValue != NULL && $this->ProfessionalQualification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProfessionalQualification->caption(), $this->ProfessionalQualification->RequiredErrorMessage));
			}
		}
		if ($this->MedicalCondition->Required) {
			if (!$this->MedicalCondition->IsDetailKey && $this->MedicalCondition->FormValue != NULL && $this->MedicalCondition->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MedicalCondition->caption(), $this->MedicalCondition->RequiredErrorMessage));
			}
		}
		if ($this->OtherMedicalConditions->Required) {
			if (!$this->OtherMedicalConditions->IsDetailKey && $this->OtherMedicalConditions->FormValue != NULL && $this->OtherMedicalConditions->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OtherMedicalConditions->caption(), $this->OtherMedicalConditions->RequiredErrorMessage));
			}
		}
		if ($this->PhysicalChallenge->Required) {
			if (!$this->PhysicalChallenge->IsDetailKey && $this->PhysicalChallenge->FormValue != NULL && $this->PhysicalChallenge->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicalChallenge->caption(), $this->PhysicalChallenge->RequiredErrorMessage));
			}
		}
		if ($this->PostalAddress->Required) {
			if (!$this->PostalAddress->IsDetailKey && $this->PostalAddress->FormValue != NULL && $this->PostalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PostalAddress->caption(), $this->PostalAddress->RequiredErrorMessage));
			}
		}
		if ($this->PhysicalAddress->Required) {
			if (!$this->PhysicalAddress->IsDetailKey && $this->PhysicalAddress->FormValue != NULL && $this->PhysicalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicalAddress->caption(), $this->PhysicalAddress->RequiredErrorMessage));
			}
		}
		if ($this->TownOrVillage->Required) {
			if (!$this->TownOrVillage->IsDetailKey && $this->TownOrVillage->FormValue != NULL && $this->TownOrVillage->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TownOrVillage->caption(), $this->TownOrVillage->RequiredErrorMessage));
			}
		}
		if ($this->Telephone->Required) {
			if (!$this->Telephone->IsDetailKey && $this->Telephone->FormValue != NULL && $this->Telephone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Telephone->caption(), $this->Telephone->RequiredErrorMessage));
			}
		}
		if ($this->Mobile->Required) {
			if (!$this->Mobile->IsDetailKey && $this->Mobile->FormValue != NULL && $this->Mobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Mobile->caption(), $this->Mobile->RequiredErrorMessage));
			}
		}
		if ($this->Fax->Required) {
			if (!$this->Fax->IsDetailKey && $this->Fax->FormValue != NULL && $this->Fax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fax->caption(), $this->Fax->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->_Email->FormValue)) {
			AddMessage($FormError, $this->_Email->errorMessage());
		}
		if ($this->NumberOfBiologicalChildren->Required) {
			if (!$this->NumberOfBiologicalChildren->IsDetailKey && $this->NumberOfBiologicalChildren->FormValue != NULL && $this->NumberOfBiologicalChildren->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NumberOfBiologicalChildren->caption(), $this->NumberOfBiologicalChildren->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->NumberOfBiologicalChildren->FormValue)) {
			AddMessage($FormError, $this->NumberOfBiologicalChildren->errorMessage());
		}
		if ($this->NumberOfDependants->Required) {
			if (!$this->NumberOfDependants->IsDetailKey && $this->NumberOfDependants->FormValue != NULL && $this->NumberOfDependants->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NumberOfDependants->caption(), $this->NumberOfDependants->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->NumberOfDependants->FormValue)) {
			AddMessage($FormError, $this->NumberOfDependants->errorMessage());
		}
		if ($this->NextOfKin->Required) {
			if (!$this->NextOfKin->IsDetailKey && $this->NextOfKin->FormValue != NULL && $this->NextOfKin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NextOfKin->caption(), $this->NextOfKin->RequiredErrorMessage));
			}
		}
		if ($this->RelationshipCode->Required) {
			if (!$this->RelationshipCode->IsDetailKey && $this->RelationshipCode->FormValue != NULL && $this->RelationshipCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RelationshipCode->caption(), $this->RelationshipCode->RequiredErrorMessage));
			}
		}
		if ($this->NextOfKinMobile->Required) {
			if (!$this->NextOfKinMobile->IsDetailKey && $this->NextOfKinMobile->FormValue != NULL && $this->NextOfKinMobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NextOfKinMobile->caption(), $this->NextOfKinMobile->RequiredErrorMessage));
			}
		}
		if ($this->NextOfKinEmail->Required) {
			if (!$this->NextOfKinEmail->IsDetailKey && $this->NextOfKinEmail->FormValue != NULL && $this->NextOfKinEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NextOfKinEmail->caption(), $this->NextOfKinEmail->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->NextOfKinEmail->FormValue)) {
			AddMessage($FormError, $this->NextOfKinEmail->errorMessage());
		}
		if ($this->SpouseName->Required) {
			if (!$this->SpouseName->IsDetailKey && $this->SpouseName->FormValue != NULL && $this->SpouseName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseName->caption(), $this->SpouseName->RequiredErrorMessage));
			}
		}
		if ($this->SpouseNRC->Required) {
			if (!$this->SpouseNRC->IsDetailKey && $this->SpouseNRC->FormValue != NULL && $this->SpouseNRC->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseNRC->caption(), $this->SpouseNRC->RequiredErrorMessage));
			}
		}
		if ($this->SpouseMobile->Required) {
			if (!$this->SpouseMobile->IsDetailKey && $this->SpouseMobile->FormValue != NULL && $this->SpouseMobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseMobile->caption(), $this->SpouseMobile->RequiredErrorMessage));
			}
		}
		if ($this->SpouseEmail->Required) {
			if (!$this->SpouseEmail->IsDetailKey && $this->SpouseEmail->FormValue != NULL && $this->SpouseEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseEmail->caption(), $this->SpouseEmail->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->SpouseEmail->FormValue)) {
			AddMessage($FormError, $this->SpouseEmail->errorMessage());
		}
		if ($this->SpouseResidentialAddress->Required) {
			if (!$this->SpouseResidentialAddress->IsDetailKey && $this->SpouseResidentialAddress->FormValue != NULL && $this->SpouseResidentialAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SpouseResidentialAddress->caption(), $this->SpouseResidentialAddress->RequiredErrorMessage));
			}
		}
		if ($this->BankAccountNo->Required) {
			if (!$this->BankAccountNo->IsDetailKey && $this->BankAccountNo->FormValue != NULL && $this->BankAccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankAccountNo->caption(), $this->BankAccountNo->RequiredErrorMessage));
			}
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
		if ($this->TaxNumber->Required) {
			if (!$this->TaxNumber->IsDetailKey && $this->TaxNumber->FormValue != NULL && $this->TaxNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TaxNumber->caption(), $this->TaxNumber->RequiredErrorMessage));
			}
		}
		if ($this->PensionNumber->Required) {
			if (!$this->PensionNumber->IsDetailKey && $this->PensionNumber->FormValue != NULL && $this->PensionNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PensionNumber->caption(), $this->PensionNumber->RequiredErrorMessage));
			}
		}
		if ($this->SocialSecurityNo->Required) {
			if (!$this->SocialSecurityNo->IsDetailKey && $this->SocialSecurityNo->FormValue != NULL && $this->SocialSecurityNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SocialSecurityNo->caption(), $this->SocialSecurityNo->RequiredErrorMessage));
			}
		}
		if ($this->ThirdParties->Required) {
			if ($this->ThirdParties->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ThirdParties->caption(), $this->ThirdParties->RequiredErrorMessage));
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

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// FormerFileNumber
			$this->FormerFileNumber->setDbValueDef($rsnew, $this->FormerFileNumber->CurrentValue, NULL, $this->FormerFileNumber->ReadOnly);

			// NRC
			$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", $this->NRC->ReadOnly);

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

			// MaritalStatus
			$this->MaritalStatus->setDbValueDef($rsnew, $this->MaritalStatus->CurrentValue, 0, $this->MaritalStatus->ReadOnly);

			// MaidenName
			$this->MaidenName->setDbValueDef($rsnew, $this->MaidenName->CurrentValue, NULL, $this->MaidenName->ReadOnly);

			// DateOfBirth
			$this->DateOfBirth->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfBirth->CurrentValue, 0), CurrentDate(), $this->DateOfBirth->ReadOnly);

			// AcademicQualification
			$this->AcademicQualification->setDbValueDef($rsnew, $this->AcademicQualification->CurrentValue, NULL, $this->AcademicQualification->ReadOnly);

			// ProfessionalQualification
			$this->ProfessionalQualification->setDbValueDef($rsnew, $this->ProfessionalQualification->CurrentValue, NULL, $this->ProfessionalQualification->ReadOnly);

			// MedicalCondition
			$this->MedicalCondition->setDbValueDef($rsnew, $this->MedicalCondition->CurrentValue, NULL, $this->MedicalCondition->ReadOnly);

			// OtherMedicalConditions
			$this->OtherMedicalConditions->setDbValueDef($rsnew, $this->OtherMedicalConditions->CurrentValue, NULL, $this->OtherMedicalConditions->ReadOnly);

			// PhysicalChallenge
			$this->PhysicalChallenge->setDbValueDef($rsnew, $this->PhysicalChallenge->CurrentValue, NULL, $this->PhysicalChallenge->ReadOnly);

			// PostalAddress
			$this->PostalAddress->setDbValueDef($rsnew, $this->PostalAddress->CurrentValue, NULL, $this->PostalAddress->ReadOnly);

			// PhysicalAddress
			$this->PhysicalAddress->setDbValueDef($rsnew, $this->PhysicalAddress->CurrentValue, NULL, $this->PhysicalAddress->ReadOnly);

			// TownOrVillage
			$this->TownOrVillage->setDbValueDef($rsnew, $this->TownOrVillage->CurrentValue, NULL, $this->TownOrVillage->ReadOnly);

			// Telephone
			$this->Telephone->setDbValueDef($rsnew, $this->Telephone->CurrentValue, NULL, $this->Telephone->ReadOnly);

			// Mobile
			$this->Mobile->setDbValueDef($rsnew, $this->Mobile->CurrentValue, NULL, $this->Mobile->ReadOnly);

			// Fax
			$this->Fax->setDbValueDef($rsnew, $this->Fax->CurrentValue, NULL, $this->Fax->ReadOnly);

			// Email
			$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, $this->_Email->ReadOnly);

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->setDbValueDef($rsnew, $this->NumberOfBiologicalChildren->CurrentValue, NULL, $this->NumberOfBiologicalChildren->ReadOnly);

			// NumberOfDependants
			$this->NumberOfDependants->setDbValueDef($rsnew, $this->NumberOfDependants->CurrentValue, NULL, $this->NumberOfDependants->ReadOnly);

			// NextOfKin
			$this->NextOfKin->setDbValueDef($rsnew, $this->NextOfKin->CurrentValue, NULL, $this->NextOfKin->ReadOnly);

			// RelationshipCode
			$this->RelationshipCode->setDbValueDef($rsnew, $this->RelationshipCode->CurrentValue, NULL, $this->RelationshipCode->ReadOnly);

			// NextOfKinMobile
			$this->NextOfKinMobile->setDbValueDef($rsnew, $this->NextOfKinMobile->CurrentValue, NULL, $this->NextOfKinMobile->ReadOnly);

			// NextOfKinEmail
			$this->NextOfKinEmail->setDbValueDef($rsnew, $this->NextOfKinEmail->CurrentValue, NULL, $this->NextOfKinEmail->ReadOnly);

			// SpouseName
			$this->SpouseName->setDbValueDef($rsnew, $this->SpouseName->CurrentValue, NULL, $this->SpouseName->ReadOnly);

			// SpouseNRC
			$this->SpouseNRC->setDbValueDef($rsnew, $this->SpouseNRC->CurrentValue, NULL, $this->SpouseNRC->ReadOnly);

			// SpouseMobile
			$this->SpouseMobile->setDbValueDef($rsnew, $this->SpouseMobile->CurrentValue, NULL, $this->SpouseMobile->ReadOnly);

			// SpouseEmail
			$this->SpouseEmail->setDbValueDef($rsnew, $this->SpouseEmail->CurrentValue, NULL, $this->SpouseEmail->ReadOnly);

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->setDbValueDef($rsnew, $this->SpouseResidentialAddress->CurrentValue, NULL, $this->SpouseResidentialAddress->ReadOnly);

			// BankAccountNo
			$this->BankAccountNo->setDbValueDef($rsnew, $this->BankAccountNo->CurrentValue, NULL, $this->BankAccountNo->ReadOnly);

			// PaymentMethod
			$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, NULL, $this->PaymentMethod->ReadOnly);

			// BankBranchCode
			$this->BankBranchCode->setDbValueDef($rsnew, $this->BankBranchCode->CurrentValue, NULL, $this->BankBranchCode->ReadOnly);

			// TaxNumber
			$this->TaxNumber->setDbValueDef($rsnew, $this->TaxNumber->CurrentValue, NULL, $this->TaxNumber->ReadOnly);

			// PensionNumber
			$this->PensionNumber->setDbValueDef($rsnew, $this->PensionNumber->CurrentValue, NULL, $this->PensionNumber->ReadOnly);

			// SocialSecurityNo
			$this->SocialSecurityNo->setDbValueDef($rsnew, $this->SocialSecurityNo->CurrentValue, NULL, $this->SocialSecurityNo->ReadOnly);

			// ThirdParties
			$this->ThirdParties->setDbValueDef($rsnew, $this->ThirdParties->CurrentValue, NULL, $this->ThirdParties->ReadOnly);

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

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('LACode')); // LACode
		$hash .= GetFieldHash($rs->fields('FormerFileNumber')); // FormerFileNumber
		$hash .= GetFieldHash($rs->fields('NRC')); // NRC
		$hash .= GetFieldHash($rs->fields('Title')); // Title
		$hash .= GetFieldHash($rs->fields('Surname')); // Surname
		$hash .= GetFieldHash($rs->fields('FirstName')); // FirstName
		$hash .= GetFieldHash($rs->fields('MiddleName')); // MiddleName
		$hash .= GetFieldHash($rs->fields('Sex')); // Sex
		$hash .= GetFieldHash($rs->fields('MaritalStatus')); // MaritalStatus
		$hash .= GetFieldHash($rs->fields('MaidenName')); // MaidenName
		$hash .= GetFieldHash($rs->fields('DateOfBirth')); // DateOfBirth
		$hash .= GetFieldHash($rs->fields('AcademicQualification')); // AcademicQualification
		$hash .= GetFieldHash($rs->fields('ProfessionalQualification')); // ProfessionalQualification
		$hash .= GetFieldHash($rs->fields('MedicalCondition')); // MedicalCondition
		$hash .= GetFieldHash($rs->fields('OtherMedicalConditions')); // OtherMedicalConditions
		$hash .= GetFieldHash($rs->fields('PhysicalChallenge')); // PhysicalChallenge
		$hash .= GetFieldHash($rs->fields('PostalAddress')); // PostalAddress
		$hash .= GetFieldHash($rs->fields('PhysicalAddress')); // PhysicalAddress
		$hash .= GetFieldHash($rs->fields('TownOrVillage')); // TownOrVillage
		$hash .= GetFieldHash($rs->fields('Telephone')); // Telephone
		$hash .= GetFieldHash($rs->fields('Mobile')); // Mobile
		$hash .= GetFieldHash($rs->fields('Fax')); // Fax
		$hash .= GetFieldHash($rs->fields('Email')); // Email
		$hash .= GetFieldHash($rs->fields('NumberOfBiologicalChildren')); // NumberOfBiologicalChildren
		$hash .= GetFieldHash($rs->fields('NumberOfDependants')); // NumberOfDependants
		$hash .= GetFieldHash($rs->fields('NextOfKin')); // NextOfKin
		$hash .= GetFieldHash($rs->fields('RelationshipCode')); // RelationshipCode
		$hash .= GetFieldHash($rs->fields('NextOfKinMobile')); // NextOfKinMobile
		$hash .= GetFieldHash($rs->fields('NextOfKinEmail')); // NextOfKinEmail
		$hash .= GetFieldHash($rs->fields('SpouseName')); // SpouseName
		$hash .= GetFieldHash($rs->fields('SpouseNRC')); // SpouseNRC
		$hash .= GetFieldHash($rs->fields('SpouseMobile')); // SpouseMobile
		$hash .= GetFieldHash($rs->fields('SpouseEmail')); // SpouseEmail
		$hash .= GetFieldHash($rs->fields('SpouseResidentialAddress')); // SpouseResidentialAddress
		$hash .= GetFieldHash($rs->fields('BankAccountNo')); // BankAccountNo
		$hash .= GetFieldHash($rs->fields('PaymentMethod')); // PaymentMethod
		$hash .= GetFieldHash($rs->fields('BankBranchCode')); // BankBranchCode
		$hash .= GetFieldHash($rs->fields('TaxNumber')); // TaxNumber
		$hash .= GetFieldHash($rs->fields('PensionNumber')); // PensionNumber
		$hash .= GetFieldHash($rs->fields('SocialSecurityNo')); // SocialSecurityNo
		$hash .= GetFieldHash($rs->fields('ThirdParties')); // ThirdParties
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
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

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// FormerFileNumber
		$this->FormerFileNumber->setDbValueDef($rsnew, $this->FormerFileNumber->CurrentValue, NULL, FALSE);

		// NRC
		$this->NRC->setDbValueDef($rsnew, $this->NRC->CurrentValue, "", FALSE);

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

		// MaritalStatus
		$this->MaritalStatus->setDbValueDef($rsnew, $this->MaritalStatus->CurrentValue, 0, FALSE);

		// MaidenName
		$this->MaidenName->setDbValueDef($rsnew, $this->MaidenName->CurrentValue, NULL, FALSE);

		// DateOfBirth
		$this->DateOfBirth->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfBirth->CurrentValue, 0), CurrentDate(), FALSE);

		// AcademicQualification
		$this->AcademicQualification->setDbValueDef($rsnew, $this->AcademicQualification->CurrentValue, NULL, FALSE);

		// ProfessionalQualification
		$this->ProfessionalQualification->setDbValueDef($rsnew, $this->ProfessionalQualification->CurrentValue, NULL, FALSE);

		// MedicalCondition
		$this->MedicalCondition->setDbValueDef($rsnew, $this->MedicalCondition->CurrentValue, NULL, FALSE);

		// OtherMedicalConditions
		$this->OtherMedicalConditions->setDbValueDef($rsnew, $this->OtherMedicalConditions->CurrentValue, NULL, FALSE);

		// PhysicalChallenge
		$this->PhysicalChallenge->setDbValueDef($rsnew, $this->PhysicalChallenge->CurrentValue, NULL, FALSE);

		// PostalAddress
		$this->PostalAddress->setDbValueDef($rsnew, $this->PostalAddress->CurrentValue, NULL, FALSE);

		// PhysicalAddress
		$this->PhysicalAddress->setDbValueDef($rsnew, $this->PhysicalAddress->CurrentValue, NULL, FALSE);

		// TownOrVillage
		$this->TownOrVillage->setDbValueDef($rsnew, $this->TownOrVillage->CurrentValue, NULL, FALSE);

		// Telephone
		$this->Telephone->setDbValueDef($rsnew, $this->Telephone->CurrentValue, NULL, FALSE);

		// Mobile
		$this->Mobile->setDbValueDef($rsnew, $this->Mobile->CurrentValue, NULL, FALSE);

		// Fax
		$this->Fax->setDbValueDef($rsnew, $this->Fax->CurrentValue, NULL, FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, FALSE);

		// NumberOfBiologicalChildren
		$this->NumberOfBiologicalChildren->setDbValueDef($rsnew, $this->NumberOfBiologicalChildren->CurrentValue, NULL, strval($this->NumberOfBiologicalChildren->CurrentValue) == "");

		// NumberOfDependants
		$this->NumberOfDependants->setDbValueDef($rsnew, $this->NumberOfDependants->CurrentValue, NULL, FALSE);

		// NextOfKin
		$this->NextOfKin->setDbValueDef($rsnew, $this->NextOfKin->CurrentValue, NULL, FALSE);

		// RelationshipCode
		$this->RelationshipCode->setDbValueDef($rsnew, $this->RelationshipCode->CurrentValue, NULL, FALSE);

		// NextOfKinMobile
		$this->NextOfKinMobile->setDbValueDef($rsnew, $this->NextOfKinMobile->CurrentValue, NULL, FALSE);

		// NextOfKinEmail
		$this->NextOfKinEmail->setDbValueDef($rsnew, $this->NextOfKinEmail->CurrentValue, NULL, FALSE);

		// SpouseName
		$this->SpouseName->setDbValueDef($rsnew, $this->SpouseName->CurrentValue, NULL, FALSE);

		// SpouseNRC
		$this->SpouseNRC->setDbValueDef($rsnew, $this->SpouseNRC->CurrentValue, NULL, FALSE);

		// SpouseMobile
		$this->SpouseMobile->setDbValueDef($rsnew, $this->SpouseMobile->CurrentValue, NULL, FALSE);

		// SpouseEmail
		$this->SpouseEmail->setDbValueDef($rsnew, $this->SpouseEmail->CurrentValue, NULL, FALSE);

		// SpouseResidentialAddress
		$this->SpouseResidentialAddress->setDbValueDef($rsnew, $this->SpouseResidentialAddress->CurrentValue, NULL, FALSE);

		// BankAccountNo
		$this->BankAccountNo->setDbValueDef($rsnew, $this->BankAccountNo->CurrentValue, NULL, FALSE);

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, NULL, FALSE);

		// BankBranchCode
		$this->BankBranchCode->setDbValueDef($rsnew, $this->BankBranchCode->CurrentValue, NULL, FALSE);

		// TaxNumber
		$this->TaxNumber->setDbValueDef($rsnew, $this->TaxNumber->CurrentValue, NULL, FALSE);

		// PensionNumber
		$this->PensionNumber->setDbValueDef($rsnew, $this->PensionNumber->CurrentValue, NULL, FALSE);

		// SocialSecurityNo
		$this->SocialSecurityNo->setDbValueDef($rsnew, $this->SocialSecurityNo->CurrentValue, NULL, FALSE);

		// ThirdParties
		$this->ThirdParties->setDbValueDef($rsnew, $this->ThirdParties->CurrentValue, NULL, FALSE);

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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->EmployeeID->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->FormerFileNumber->AdvancedSearch->load();
		$this->NRC->AdvancedSearch->load();
		$this->Title->AdvancedSearch->load();
		$this->Surname->AdvancedSearch->load();
		$this->FirstName->AdvancedSearch->load();
		$this->MiddleName->AdvancedSearch->load();
		$this->Sex->AdvancedSearch->load();
		$this->MaritalStatus->AdvancedSearch->load();
		$this->MaidenName->AdvancedSearch->load();
		$this->DateOfBirth->AdvancedSearch->load();
		$this->AcademicQualification->AdvancedSearch->load();
		$this->ProfessionalQualification->AdvancedSearch->load();
		$this->MedicalCondition->AdvancedSearch->load();
		$this->OtherMedicalConditions->AdvancedSearch->load();
		$this->PhysicalChallenge->AdvancedSearch->load();
		$this->PostalAddress->AdvancedSearch->load();
		$this->PhysicalAddress->AdvancedSearch->load();
		$this->TownOrVillage->AdvancedSearch->load();
		$this->Telephone->AdvancedSearch->load();
		$this->Mobile->AdvancedSearch->load();
		$this->Fax->AdvancedSearch->load();
		$this->_Email->AdvancedSearch->load();
		$this->NumberOfBiologicalChildren->AdvancedSearch->load();
		$this->NumberOfDependants->AdvancedSearch->load();
		$this->NextOfKin->AdvancedSearch->load();
		$this->RelationshipCode->AdvancedSearch->load();
		$this->NextOfKinMobile->AdvancedSearch->load();
		$this->NextOfKinEmail->AdvancedSearch->load();
		$this->SpouseName->AdvancedSearch->load();
		$this->SpouseNRC->AdvancedSearch->load();
		$this->SpouseMobile->AdvancedSearch->load();
		$this->SpouseEmail->AdvancedSearch->load();
		$this->SpouseResidentialAddress->AdvancedSearch->load();
		$this->AdditionalInformation->AdvancedSearch->load();
		$this->LastUserID->AdvancedSearch->load();
		$this->LastUpdated->AdvancedSearch->load();
		$this->BankAccountNo->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->BankBranchCode->AdvancedSearch->load();
		$this->TaxNumber->AdvancedSearch->load();
		$this->PensionNumber->AdvancedSearch->load();
		$this->SocialSecurityNo->AdvancedSearch->load();
		$this->ThirdParties->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fstafflist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fstafflist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fstafflist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_staff" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_staff\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fstafflist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : "";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fstafflistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"staffsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"staff\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'staffsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fstafflistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != "" && $this->TotalRecords > 0);

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
			$this->DisplayRecords = $this->TotalRecords;
			$this->StopRecord = $this->TotalRecords;
		} else { // Export one page only
			$this->setupStartRecord(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecords <= 0) {
				$this->StopRecord = $this->TotalRecords;
			} else {
				$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
				case "x_Title":
					break;
				case "x_Sex":
					break;
				case "x_MaritalStatus":
					break;
				case "x_AcademicQualification":
					break;
				case "x_ProfessionalQualification":
					break;
				case "x_MedicalCondition":
					break;
				case "x_OtherMedicalConditions":
					break;
				case "x_PhysicalChallenge":
					break;
				case "x_RelationshipCode":
					break;
				case "x_PaymentMethod":
					break;
				case "x_BankBranchCode":
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
						case "x_LACode":
							break;
						case "x_Title":
							break;
						case "x_Sex":
							break;
						case "x_MaritalStatus":
							break;
						case "x_AcademicQualification":
							break;
						case "x_ProfessionalQualification":
							break;
						case "x_MedicalCondition":
							break;
						case "x_OtherMedicalConditions":
							break;
						case "x_PhysicalChallenge":
							break;
						case "x_RelationshipCode":
							break;
						case "x_PaymentMethod":
							break;
						case "x_BankBranchCode":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>