<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class budget_list extends budget
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'budget';

	// Page object name
	public $PageObjName = "budget_list";

	// Grid form hidden field names
	public $FormName = "fbudgetlist";
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

		// Table object (budget)
		if (!isset($GLOBALS["budget"]) || get_class($GLOBALS["budget"]) == PROJECT_NAMESPACE . "budget") {
			$GLOBALS["budget"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["budget"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "budgetadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "budgetdelete.php";
		$this->MultiUpdateUrl = "budgetupdate.php";

		// Table object (detailed_action)
		if (!isset($GLOBALS['detailed_action']))
			$GLOBALS['detailed_action'] = new detailed_action();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'budget');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fbudgetlistsrch";

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
		global $budget;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($budget);
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
			$key .= @$ar['BudgetLine'];
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
			$this->BudgetLine->Visible = FALSE;
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
		$this->OutcomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ActionCode->setVisibility();
		$this->DetailedActionCode->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->AccountCode->setVisibility();
		$this->ItemCode->Visible = FALSE;
		$this->MeansOfImplementation->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Quantity->setVisibility();
		$this->PeriodType->Visible = FALSE;
		$this->PeriodLength->Visible = FALSE;
		$this->Frequency->setVisibility();
		$this->UnitCost->setVisibility();
		$this->BudgetEstimate->setVisibility();
		$this->ActualAmount->Visible = FALSE;
		$this->Status->Visible = FALSE;
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->BudgetLine->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->ApprovedBudget->setVisibility();
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
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ActionCode);
		$this->setupLookupOptions($this->DetailedActionCode);
		$this->setupLookupOptions($this->FinancialYear);
		$this->setupLookupOptions($this->AccountCode);
		$this->setupLookupOptions($this->MeansOfImplementation);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PeriodType);
		$this->setupLookupOptions($this->Status);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);

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

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "detailed_action") {
			global $detailed_action;
			$rsmaster = $detailed_action->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("detailed_actionlist.php"); // Return to master page
			} else {
				$detailed_action->loadListRowValues($rsmaster);
				$detailed_action->RowType = ROWTYPE_MASTER; // Master row
				$detailed_action->renderListRow();
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
		$this->Quantity->FormValue = ""; // Clear form value
		$this->Frequency->FormValue = ""; // Clear form value
		$this->UnitCost->FormValue = ""; // Clear form value
		$this->BudgetEstimate->FormValue = ""; // Clear form value
		$this->ApprovedBudget->FormValue = ""; // Clear form value
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
			$this->BudgetLine->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->BudgetLine->OldValue))
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
					$key .= $this->BudgetLine->CurrentValue;

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
		if ($CurrentForm->hasValue("x_OutcomeCode") && $CurrentForm->hasValue("o_OutcomeCode") && $this->OutcomeCode->CurrentValue != $this->OutcomeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputCode") && $CurrentForm->hasValue("o_OutputCode") && $this->OutputCode->CurrentValue != $this->OutputCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActionCode") && $CurrentForm->hasValue("o_ActionCode") && $this->ActionCode->CurrentValue != $this->ActionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DetailedActionCode") && $CurrentForm->hasValue("o_DetailedActionCode") && $this->DetailedActionCode->CurrentValue != $this->DetailedActionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FinancialYear") && $CurrentForm->hasValue("o_FinancialYear") && $this->FinancialYear->CurrentValue != $this->FinancialYear->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountCode") && $CurrentForm->hasValue("o_AccountCode") && $this->AccountCode->CurrentValue != $this->AccountCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MeansOfImplementation") && $CurrentForm->hasValue("o_MeansOfImplementation") && $this->MeansOfImplementation->CurrentValue != $this->MeansOfImplementation->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitOfMeasure") && $CurrentForm->hasValue("o_UnitOfMeasure") && $this->UnitOfMeasure->CurrentValue != $this->UnitOfMeasure->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Quantity") && $CurrentForm->hasValue("o_Quantity") && $this->Quantity->CurrentValue != $this->Quantity->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Frequency") && $CurrentForm->hasValue("o_Frequency") && $this->Frequency->CurrentValue != $this->Frequency->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitCost") && $CurrentForm->hasValue("o_UnitCost") && $this->UnitCost->CurrentValue != $this->UnitCost->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BudgetEstimate") && $CurrentForm->hasValue("o_BudgetEstimate") && $this->BudgetEstimate->CurrentValue != $this->BudgetEstimate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LACode") && $CurrentForm->hasValue("o_LACode") && $this->LACode->CurrentValue != $this->LACode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepartmentCode") && $CurrentForm->hasValue("o_DepartmentCode") && $this->DepartmentCode->CurrentValue != $this->DepartmentCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SectionCode") && $CurrentForm->hasValue("o_SectionCode") && $this->SectionCode->CurrentValue != $this->SectionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProgramCode") && $CurrentForm->hasValue("o_ProgramCode") && $this->ProgramCode->CurrentValue != $this->ProgramCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SubProgramCode") && $CurrentForm->hasValue("o_SubProgramCode") && $this->SubProgramCode->CurrentValue != $this->SubProgramCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ApprovedBudget") && $CurrentForm->hasValue("o_ApprovedBudget") && $this->ApprovedBudget->CurrentValue != $this->ApprovedBudget->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fbudgetlistsrch");
		$filterList = Concat($filterList, $this->OutcomeCode->AdvancedSearch->toJson(), ","); // Field OutcomeCode
		$filterList = Concat($filterList, $this->OutputCode->AdvancedSearch->toJson(), ","); // Field OutputCode
		$filterList = Concat($filterList, $this->ActionCode->AdvancedSearch->toJson(), ","); // Field ActionCode
		$filterList = Concat($filterList, $this->DetailedActionCode->AdvancedSearch->toJson(), ","); // Field DetailedActionCode
		$filterList = Concat($filterList, $this->FinancialYear->AdvancedSearch->toJson(), ","); // Field FinancialYear
		$filterList = Concat($filterList, $this->AccountCode->AdvancedSearch->toJson(), ","); // Field AccountCode
		$filterList = Concat($filterList, $this->MeansOfImplementation->AdvancedSearch->toJson(), ","); // Field MeansOfImplementation
		$filterList = Concat($filterList, $this->UnitOfMeasure->AdvancedSearch->toJson(), ","); // Field UnitOfMeasure
		$filterList = Concat($filterList, $this->Quantity->AdvancedSearch->toJson(), ","); // Field Quantity
		$filterList = Concat($filterList, $this->PeriodType->AdvancedSearch->toJson(), ","); // Field PeriodType
		$filterList = Concat($filterList, $this->PeriodLength->AdvancedSearch->toJson(), ","); // Field PeriodLength
		$filterList = Concat($filterList, $this->Frequency->AdvancedSearch->toJson(), ","); // Field Frequency
		$filterList = Concat($filterList, $this->UnitCost->AdvancedSearch->toJson(), ","); // Field UnitCost
		$filterList = Concat($filterList, $this->BudgetEstimate->AdvancedSearch->toJson(), ","); // Field BudgetEstimate
		$filterList = Concat($filterList, $this->ActualAmount->AdvancedSearch->toJson(), ","); // Field ActualAmount
		$filterList = Concat($filterList, $this->Status->AdvancedSearch->toJson(), ","); // Field Status
		$filterList = Concat($filterList, $this->LACode->AdvancedSearch->toJson(), ","); // Field LACode
		$filterList = Concat($filterList, $this->DepartmentCode->AdvancedSearch->toJson(), ","); // Field DepartmentCode
		$filterList = Concat($filterList, $this->SectionCode->AdvancedSearch->toJson(), ","); // Field SectionCode
		$filterList = Concat($filterList, $this->BudgetLine->AdvancedSearch->toJson(), ","); // Field BudgetLine
		$filterList = Concat($filterList, $this->ProgramCode->AdvancedSearch->toJson(), ","); // Field ProgramCode
		$filterList = Concat($filterList, $this->SubProgramCode->AdvancedSearch->toJson(), ","); // Field SubProgramCode
		$filterList = Concat($filterList, $this->ApprovedBudget->AdvancedSearch->toJson(), ","); // Field ApprovedBudget
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fbudgetlistsrch", $filters);
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

		// Field OutcomeCode
		$this->OutcomeCode->AdvancedSearch->SearchValue = @$filter["x_OutcomeCode"];
		$this->OutcomeCode->AdvancedSearch->SearchOperator = @$filter["z_OutcomeCode"];
		$this->OutcomeCode->AdvancedSearch->SearchCondition = @$filter["v_OutcomeCode"];
		$this->OutcomeCode->AdvancedSearch->SearchValue2 = @$filter["y_OutcomeCode"];
		$this->OutcomeCode->AdvancedSearch->SearchOperator2 = @$filter["w_OutcomeCode"];
		$this->OutcomeCode->AdvancedSearch->save();

		// Field OutputCode
		$this->OutputCode->AdvancedSearch->SearchValue = @$filter["x_OutputCode"];
		$this->OutputCode->AdvancedSearch->SearchOperator = @$filter["z_OutputCode"];
		$this->OutputCode->AdvancedSearch->SearchCondition = @$filter["v_OutputCode"];
		$this->OutputCode->AdvancedSearch->SearchValue2 = @$filter["y_OutputCode"];
		$this->OutputCode->AdvancedSearch->SearchOperator2 = @$filter["w_OutputCode"];
		$this->OutputCode->AdvancedSearch->save();

		// Field ActionCode
		$this->ActionCode->AdvancedSearch->SearchValue = @$filter["x_ActionCode"];
		$this->ActionCode->AdvancedSearch->SearchOperator = @$filter["z_ActionCode"];
		$this->ActionCode->AdvancedSearch->SearchCondition = @$filter["v_ActionCode"];
		$this->ActionCode->AdvancedSearch->SearchValue2 = @$filter["y_ActionCode"];
		$this->ActionCode->AdvancedSearch->SearchOperator2 = @$filter["w_ActionCode"];
		$this->ActionCode->AdvancedSearch->save();

		// Field DetailedActionCode
		$this->DetailedActionCode->AdvancedSearch->SearchValue = @$filter["x_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchOperator = @$filter["z_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchCondition = @$filter["v_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchValue2 = @$filter["y_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchOperator2 = @$filter["w_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->save();

		// Field FinancialYear
		$this->FinancialYear->AdvancedSearch->SearchValue = @$filter["x_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchOperator = @$filter["z_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchCondition = @$filter["v_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchValue2 = @$filter["y_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchOperator2 = @$filter["w_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->save();

		// Field AccountCode
		$this->AccountCode->AdvancedSearch->SearchValue = @$filter["x_AccountCode"];
		$this->AccountCode->AdvancedSearch->SearchOperator = @$filter["z_AccountCode"];
		$this->AccountCode->AdvancedSearch->SearchCondition = @$filter["v_AccountCode"];
		$this->AccountCode->AdvancedSearch->SearchValue2 = @$filter["y_AccountCode"];
		$this->AccountCode->AdvancedSearch->SearchOperator2 = @$filter["w_AccountCode"];
		$this->AccountCode->AdvancedSearch->save();

		// Field MeansOfImplementation
		$this->MeansOfImplementation->AdvancedSearch->SearchValue = @$filter["x_MeansOfImplementation"];
		$this->MeansOfImplementation->AdvancedSearch->SearchOperator = @$filter["z_MeansOfImplementation"];
		$this->MeansOfImplementation->AdvancedSearch->SearchCondition = @$filter["v_MeansOfImplementation"];
		$this->MeansOfImplementation->AdvancedSearch->SearchValue2 = @$filter["y_MeansOfImplementation"];
		$this->MeansOfImplementation->AdvancedSearch->SearchOperator2 = @$filter["w_MeansOfImplementation"];
		$this->MeansOfImplementation->AdvancedSearch->save();

		// Field UnitOfMeasure
		$this->UnitOfMeasure->AdvancedSearch->SearchValue = @$filter["x_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator = @$filter["z_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchCondition = @$filter["v_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchValue2 = @$filter["y_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator2 = @$filter["w_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->save();

		// Field Quantity
		$this->Quantity->AdvancedSearch->SearchValue = @$filter["x_Quantity"];
		$this->Quantity->AdvancedSearch->SearchOperator = @$filter["z_Quantity"];
		$this->Quantity->AdvancedSearch->SearchCondition = @$filter["v_Quantity"];
		$this->Quantity->AdvancedSearch->SearchValue2 = @$filter["y_Quantity"];
		$this->Quantity->AdvancedSearch->SearchOperator2 = @$filter["w_Quantity"];
		$this->Quantity->AdvancedSearch->save();

		// Field PeriodType
		$this->PeriodType->AdvancedSearch->SearchValue = @$filter["x_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchOperator = @$filter["z_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchCondition = @$filter["v_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchValue2 = @$filter["y_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchOperator2 = @$filter["w_PeriodType"];
		$this->PeriodType->AdvancedSearch->save();

		// Field PeriodLength
		$this->PeriodLength->AdvancedSearch->SearchValue = @$filter["x_PeriodLength"];
		$this->PeriodLength->AdvancedSearch->SearchOperator = @$filter["z_PeriodLength"];
		$this->PeriodLength->AdvancedSearch->SearchCondition = @$filter["v_PeriodLength"];
		$this->PeriodLength->AdvancedSearch->SearchValue2 = @$filter["y_PeriodLength"];
		$this->PeriodLength->AdvancedSearch->SearchOperator2 = @$filter["w_PeriodLength"];
		$this->PeriodLength->AdvancedSearch->save();

		// Field Frequency
		$this->Frequency->AdvancedSearch->SearchValue = @$filter["x_Frequency"];
		$this->Frequency->AdvancedSearch->SearchOperator = @$filter["z_Frequency"];
		$this->Frequency->AdvancedSearch->SearchCondition = @$filter["v_Frequency"];
		$this->Frequency->AdvancedSearch->SearchValue2 = @$filter["y_Frequency"];
		$this->Frequency->AdvancedSearch->SearchOperator2 = @$filter["w_Frequency"];
		$this->Frequency->AdvancedSearch->save();

		// Field UnitCost
		$this->UnitCost->AdvancedSearch->SearchValue = @$filter["x_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchOperator = @$filter["z_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchCondition = @$filter["v_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchValue2 = @$filter["y_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchOperator2 = @$filter["w_UnitCost"];
		$this->UnitCost->AdvancedSearch->save();

		// Field BudgetEstimate
		$this->BudgetEstimate->AdvancedSearch->SearchValue = @$filter["x_BudgetEstimate"];
		$this->BudgetEstimate->AdvancedSearch->SearchOperator = @$filter["z_BudgetEstimate"];
		$this->BudgetEstimate->AdvancedSearch->SearchCondition = @$filter["v_BudgetEstimate"];
		$this->BudgetEstimate->AdvancedSearch->SearchValue2 = @$filter["y_BudgetEstimate"];
		$this->BudgetEstimate->AdvancedSearch->SearchOperator2 = @$filter["w_BudgetEstimate"];
		$this->BudgetEstimate->AdvancedSearch->save();

		// Field ActualAmount
		$this->ActualAmount->AdvancedSearch->SearchValue = @$filter["x_ActualAmount"];
		$this->ActualAmount->AdvancedSearch->SearchOperator = @$filter["z_ActualAmount"];
		$this->ActualAmount->AdvancedSearch->SearchCondition = @$filter["v_ActualAmount"];
		$this->ActualAmount->AdvancedSearch->SearchValue2 = @$filter["y_ActualAmount"];
		$this->ActualAmount->AdvancedSearch->SearchOperator2 = @$filter["w_ActualAmount"];
		$this->ActualAmount->AdvancedSearch->save();

		// Field Status
		$this->Status->AdvancedSearch->SearchValue = @$filter["x_Status"];
		$this->Status->AdvancedSearch->SearchOperator = @$filter["z_Status"];
		$this->Status->AdvancedSearch->SearchCondition = @$filter["v_Status"];
		$this->Status->AdvancedSearch->SearchValue2 = @$filter["y_Status"];
		$this->Status->AdvancedSearch->SearchOperator2 = @$filter["w_Status"];
		$this->Status->AdvancedSearch->save();

		// Field LACode
		$this->LACode->AdvancedSearch->SearchValue = @$filter["x_LACode"];
		$this->LACode->AdvancedSearch->SearchOperator = @$filter["z_LACode"];
		$this->LACode->AdvancedSearch->SearchCondition = @$filter["v_LACode"];
		$this->LACode->AdvancedSearch->SearchValue2 = @$filter["y_LACode"];
		$this->LACode->AdvancedSearch->SearchOperator2 = @$filter["w_LACode"];
		$this->LACode->AdvancedSearch->save();

		// Field DepartmentCode
		$this->DepartmentCode->AdvancedSearch->SearchValue = @$filter["x_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchOperator = @$filter["z_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchCondition = @$filter["v_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchValue2 = @$filter["y_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchOperator2 = @$filter["w_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->save();

		// Field SectionCode
		$this->SectionCode->AdvancedSearch->SearchValue = @$filter["x_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchOperator = @$filter["z_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchCondition = @$filter["v_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchValue2 = @$filter["y_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchOperator2 = @$filter["w_SectionCode"];
		$this->SectionCode->AdvancedSearch->save();

		// Field BudgetLine
		$this->BudgetLine->AdvancedSearch->SearchValue = @$filter["x_BudgetLine"];
		$this->BudgetLine->AdvancedSearch->SearchOperator = @$filter["z_BudgetLine"];
		$this->BudgetLine->AdvancedSearch->SearchCondition = @$filter["v_BudgetLine"];
		$this->BudgetLine->AdvancedSearch->SearchValue2 = @$filter["y_BudgetLine"];
		$this->BudgetLine->AdvancedSearch->SearchOperator2 = @$filter["w_BudgetLine"];
		$this->BudgetLine->AdvancedSearch->save();

		// Field ProgramCode
		$this->ProgramCode->AdvancedSearch->SearchValue = @$filter["x_ProgramCode"];
		$this->ProgramCode->AdvancedSearch->SearchOperator = @$filter["z_ProgramCode"];
		$this->ProgramCode->AdvancedSearch->SearchCondition = @$filter["v_ProgramCode"];
		$this->ProgramCode->AdvancedSearch->SearchValue2 = @$filter["y_ProgramCode"];
		$this->ProgramCode->AdvancedSearch->SearchOperator2 = @$filter["w_ProgramCode"];
		$this->ProgramCode->AdvancedSearch->save();

		// Field SubProgramCode
		$this->SubProgramCode->AdvancedSearch->SearchValue = @$filter["x_SubProgramCode"];
		$this->SubProgramCode->AdvancedSearch->SearchOperator = @$filter["z_SubProgramCode"];
		$this->SubProgramCode->AdvancedSearch->SearchCondition = @$filter["v_SubProgramCode"];
		$this->SubProgramCode->AdvancedSearch->SearchValue2 = @$filter["y_SubProgramCode"];
		$this->SubProgramCode->AdvancedSearch->SearchOperator2 = @$filter["w_SubProgramCode"];
		$this->SubProgramCode->AdvancedSearch->save();

		// Field ApprovedBudget
		$this->ApprovedBudget->AdvancedSearch->SearchValue = @$filter["x_ApprovedBudget"];
		$this->ApprovedBudget->AdvancedSearch->SearchOperator = @$filter["z_ApprovedBudget"];
		$this->ApprovedBudget->AdvancedSearch->SearchCondition = @$filter["v_ApprovedBudget"];
		$this->ApprovedBudget->AdvancedSearch->SearchValue2 = @$filter["y_ApprovedBudget"];
		$this->ApprovedBudget->AdvancedSearch->SearchOperator2 = @$filter["w_ApprovedBudget"];
		$this->ApprovedBudget->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->OutcomeCode, $default, FALSE); // OutcomeCode
		$this->buildSearchSql($where, $this->OutputCode, $default, FALSE); // OutputCode
		$this->buildSearchSql($where, $this->ActionCode, $default, FALSE); // ActionCode
		$this->buildSearchSql($where, $this->DetailedActionCode, $default, FALSE); // DetailedActionCode
		$this->buildSearchSql($where, $this->FinancialYear, $default, FALSE); // FinancialYear
		$this->buildSearchSql($where, $this->AccountCode, $default, FALSE); // AccountCode
		$this->buildSearchSql($where, $this->MeansOfImplementation, $default, FALSE); // MeansOfImplementation
		$this->buildSearchSql($where, $this->UnitOfMeasure, $default, FALSE); // UnitOfMeasure
		$this->buildSearchSql($where, $this->Quantity, $default, FALSE); // Quantity
		$this->buildSearchSql($where, $this->PeriodType, $default, FALSE); // PeriodType
		$this->buildSearchSql($where, $this->PeriodLength, $default, FALSE); // PeriodLength
		$this->buildSearchSql($where, $this->Frequency, $default, FALSE); // Frequency
		$this->buildSearchSql($where, $this->UnitCost, $default, FALSE); // UnitCost
		$this->buildSearchSql($where, $this->BudgetEstimate, $default, FALSE); // BudgetEstimate
		$this->buildSearchSql($where, $this->ActualAmount, $default, FALSE); // ActualAmount
		$this->buildSearchSql($where, $this->Status, $default, FALSE); // Status
		$this->buildSearchSql($where, $this->LACode, $default, FALSE); // LACode
		$this->buildSearchSql($where, $this->DepartmentCode, $default, FALSE); // DepartmentCode
		$this->buildSearchSql($where, $this->SectionCode, $default, FALSE); // SectionCode
		$this->buildSearchSql($where, $this->BudgetLine, $default, FALSE); // BudgetLine
		$this->buildSearchSql($where, $this->ProgramCode, $default, FALSE); // ProgramCode
		$this->buildSearchSql($where, $this->SubProgramCode, $default, FALSE); // SubProgramCode
		$this->buildSearchSql($where, $this->ApprovedBudget, $default, FALSE); // ApprovedBudget

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->OutcomeCode->AdvancedSearch->save(); // OutcomeCode
			$this->OutputCode->AdvancedSearch->save(); // OutputCode
			$this->ActionCode->AdvancedSearch->save(); // ActionCode
			$this->DetailedActionCode->AdvancedSearch->save(); // DetailedActionCode
			$this->FinancialYear->AdvancedSearch->save(); // FinancialYear
			$this->AccountCode->AdvancedSearch->save(); // AccountCode
			$this->MeansOfImplementation->AdvancedSearch->save(); // MeansOfImplementation
			$this->UnitOfMeasure->AdvancedSearch->save(); // UnitOfMeasure
			$this->Quantity->AdvancedSearch->save(); // Quantity
			$this->PeriodType->AdvancedSearch->save(); // PeriodType
			$this->PeriodLength->AdvancedSearch->save(); // PeriodLength
			$this->Frequency->AdvancedSearch->save(); // Frequency
			$this->UnitCost->AdvancedSearch->save(); // UnitCost
			$this->BudgetEstimate->AdvancedSearch->save(); // BudgetEstimate
			$this->ActualAmount->AdvancedSearch->save(); // ActualAmount
			$this->Status->AdvancedSearch->save(); // Status
			$this->LACode->AdvancedSearch->save(); // LACode
			$this->DepartmentCode->AdvancedSearch->save(); // DepartmentCode
			$this->SectionCode->AdvancedSearch->save(); // SectionCode
			$this->BudgetLine->AdvancedSearch->save(); // BudgetLine
			$this->ProgramCode->AdvancedSearch->save(); // ProgramCode
			$this->SubProgramCode->AdvancedSearch->save(); // SubProgramCode
			$this->ApprovedBudget->AdvancedSearch->save(); // ApprovedBudget
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
		$this->buildBasicSearchSql($where, $this->AccountCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->UnitOfMeasure, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PeriodType, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Status, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LACode, $arKeywords, $type);
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
		if ($this->OutcomeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->OutputCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DetailedActionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FinancialYear->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AccountCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MeansOfImplementation->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Quantity->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PeriodType->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PeriodLength->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Frequency->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UnitCost->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BudgetEstimate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActualAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Status->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LACode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DepartmentCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SectionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BudgetLine->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProgramCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SubProgramCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ApprovedBudget->AdvancedSearch->issetSession())
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
		$this->OutcomeCode->AdvancedSearch->unsetSession();
		$this->OutputCode->AdvancedSearch->unsetSession();
		$this->ActionCode->AdvancedSearch->unsetSession();
		$this->DetailedActionCode->AdvancedSearch->unsetSession();
		$this->FinancialYear->AdvancedSearch->unsetSession();
		$this->AccountCode->AdvancedSearch->unsetSession();
		$this->MeansOfImplementation->AdvancedSearch->unsetSession();
		$this->UnitOfMeasure->AdvancedSearch->unsetSession();
		$this->Quantity->AdvancedSearch->unsetSession();
		$this->PeriodType->AdvancedSearch->unsetSession();
		$this->PeriodLength->AdvancedSearch->unsetSession();
		$this->Frequency->AdvancedSearch->unsetSession();
		$this->UnitCost->AdvancedSearch->unsetSession();
		$this->BudgetEstimate->AdvancedSearch->unsetSession();
		$this->ActualAmount->AdvancedSearch->unsetSession();
		$this->Status->AdvancedSearch->unsetSession();
		$this->LACode->AdvancedSearch->unsetSession();
		$this->DepartmentCode->AdvancedSearch->unsetSession();
		$this->SectionCode->AdvancedSearch->unsetSession();
		$this->BudgetLine->AdvancedSearch->unsetSession();
		$this->ProgramCode->AdvancedSearch->unsetSession();
		$this->SubProgramCode->AdvancedSearch->unsetSession();
		$this->ApprovedBudget->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->OutcomeCode->AdvancedSearch->load();
		$this->OutputCode->AdvancedSearch->load();
		$this->ActionCode->AdvancedSearch->load();
		$this->DetailedActionCode->AdvancedSearch->load();
		$this->FinancialYear->AdvancedSearch->load();
		$this->AccountCode->AdvancedSearch->load();
		$this->MeansOfImplementation->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->Quantity->AdvancedSearch->load();
		$this->PeriodType->AdvancedSearch->load();
		$this->PeriodLength->AdvancedSearch->load();
		$this->Frequency->AdvancedSearch->load();
		$this->UnitCost->AdvancedSearch->load();
		$this->BudgetEstimate->AdvancedSearch->load();
		$this->ActualAmount->AdvancedSearch->load();
		$this->Status->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->BudgetLine->AdvancedSearch->load();
		$this->ProgramCode->AdvancedSearch->load();
		$this->SubProgramCode->AdvancedSearch->load();
		$this->ApprovedBudget->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->OutcomeCode); // OutcomeCode
			$this->updateSort($this->OutputCode); // OutputCode
			$this->updateSort($this->ActionCode); // ActionCode
			$this->updateSort($this->DetailedActionCode); // DetailedActionCode
			$this->updateSort($this->FinancialYear); // FinancialYear
			$this->updateSort($this->AccountCode); // AccountCode
			$this->updateSort($this->MeansOfImplementation); // MeansOfImplementation
			$this->updateSort($this->UnitOfMeasure); // UnitOfMeasure
			$this->updateSort($this->Quantity); // Quantity
			$this->updateSort($this->Frequency); // Frequency
			$this->updateSort($this->UnitCost); // UnitCost
			$this->updateSort($this->BudgetEstimate); // BudgetEstimate
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->SectionCode); // SectionCode
			$this->updateSort($this->BudgetLine); // BudgetLine
			$this->updateSort($this->ProgramCode); // ProgramCode
			$this->updateSort($this->SubProgramCode); // SubProgramCode
			$this->updateSort($this->ApprovedBudget); // ApprovedBudget
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->LACode->setSessionValue("");
				$this->DepartmentCode->setSessionValue("");
				$this->FinancialYear->setSessionValue("");
				$this->ActionCode->setSessionValue("");
				$this->OutcomeCode->setSessionValue("");
				$this->OutputCode->setSessionValue("");
				$this->DetailedActionCode->setSessionValue("");
				$this->ProgramCode->setSessionValue("");
				$this->SubProgramCode->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->OutcomeCode->setSort("");
				$this->OutputCode->setSort("");
				$this->ActionCode->setSort("");
				$this->DetailedActionCode->setSort("");
				$this->FinancialYear->setSort("");
				$this->AccountCode->setSort("");
				$this->MeansOfImplementation->setSort("");
				$this->UnitOfMeasure->setSort("");
				$this->Quantity->setSort("");
				$this->Frequency->setSort("");
				$this->UnitCost->setSort("");
				$this->BudgetEstimate->setSort("");
				$this->LACode->setSort("");
				$this->DepartmentCode->setSort("");
				$this->SectionCode->setSort("");
				$this->BudgetLine->setSort("");
				$this->ProgramCode->setSort("");
				$this->SubProgramCode->setSort("");
				$this->ApprovedBudget->setSort("");
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"budget\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
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

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->BudgetLine->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->BudgetLine->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fbudgetlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fbudgetlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fbudgetlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->OutcomeCode->CurrentValue = NULL;
		$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
		$this->OutputCode->CurrentValue = NULL;
		$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
		$this->ActionCode->CurrentValue = NULL;
		$this->ActionCode->OldValue = $this->ActionCode->CurrentValue;
		$this->DetailedActionCode->CurrentValue = NULL;
		$this->DetailedActionCode->OldValue = $this->DetailedActionCode->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->AccountCode->CurrentValue = NULL;
		$this->AccountCode->OldValue = $this->AccountCode->CurrentValue;
		$this->ItemCode->CurrentValue = NULL;
		$this->ItemCode->OldValue = $this->ItemCode->CurrentValue;
		$this->MeansOfImplementation->CurrentValue = NULL;
		$this->MeansOfImplementation->OldValue = $this->MeansOfImplementation->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->Quantity->CurrentValue = NULL;
		$this->Quantity->OldValue = $this->Quantity->CurrentValue;
		$this->PeriodType->CurrentValue = "A";
		$this->PeriodType->OldValue = $this->PeriodType->CurrentValue;
		$this->PeriodLength->CurrentValue = 1;
		$this->PeriodLength->OldValue = $this->PeriodLength->CurrentValue;
		$this->Frequency->CurrentValue = 1;
		$this->Frequency->OldValue = $this->Frequency->CurrentValue;
		$this->UnitCost->CurrentValue = NULL;
		$this->UnitCost->OldValue = $this->UnitCost->CurrentValue;
		$this->BudgetEstimate->CurrentValue = 0;
		$this->BudgetEstimate->OldValue = $this->BudgetEstimate->CurrentValue;
		$this->ActualAmount->CurrentValue = 0;
		$this->ActualAmount->OldValue = $this->ActualAmount->CurrentValue;
		$this->Status->CurrentValue = NULL;
		$this->Status->OldValue = $this->Status->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->BudgetLine->CurrentValue = NULL;
		$this->BudgetLine->OldValue = $this->BudgetLine->CurrentValue;
		$this->ProgramCode->CurrentValue = NULL;
		$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
		$this->SubProgramCode->CurrentValue = NULL;
		$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
		$this->ApprovedBudget->CurrentValue = 0;
		$this->ApprovedBudget->OldValue = $this->ApprovedBudget->CurrentValue;
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

		// OutcomeCode
		if (!$this->isAddOrEdit() && $this->OutcomeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->OutcomeCode->AdvancedSearch->SearchValue != "" || $this->OutcomeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// OutputCode
		if (!$this->isAddOrEdit() && $this->OutputCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->OutputCode->AdvancedSearch->SearchValue != "" || $this->OutputCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ActionCode
		if (!$this->isAddOrEdit() && $this->ActionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ActionCode->AdvancedSearch->SearchValue != "" || $this->ActionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DetailedActionCode
		if (!$this->isAddOrEdit() && $this->DetailedActionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DetailedActionCode->AdvancedSearch->SearchValue != "" || $this->DetailedActionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// FinancialYear
		if (!$this->isAddOrEdit() && $this->FinancialYear->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FinancialYear->AdvancedSearch->SearchValue != "" || $this->FinancialYear->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AccountCode
		if (!$this->isAddOrEdit() && $this->AccountCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AccountCode->AdvancedSearch->SearchValue != "" || $this->AccountCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MeansOfImplementation
		if (!$this->isAddOrEdit() && $this->MeansOfImplementation->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MeansOfImplementation->AdvancedSearch->SearchValue != "" || $this->MeansOfImplementation->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// UnitOfMeasure
		if (!$this->isAddOrEdit() && $this->UnitOfMeasure->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UnitOfMeasure->AdvancedSearch->SearchValue != "" || $this->UnitOfMeasure->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Quantity
		if (!$this->isAddOrEdit() && $this->Quantity->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Quantity->AdvancedSearch->SearchValue != "" || $this->Quantity->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PeriodType
		if (!$this->isAddOrEdit() && $this->PeriodType->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PeriodType->AdvancedSearch->SearchValue != "" || $this->PeriodType->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PeriodLength
		if (!$this->isAddOrEdit() && $this->PeriodLength->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PeriodLength->AdvancedSearch->SearchValue != "" || $this->PeriodLength->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Frequency
		if (!$this->isAddOrEdit() && $this->Frequency->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Frequency->AdvancedSearch->SearchValue != "" || $this->Frequency->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// UnitCost
		if (!$this->isAddOrEdit() && $this->UnitCost->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UnitCost->AdvancedSearch->SearchValue != "" || $this->UnitCost->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BudgetEstimate
		if (!$this->isAddOrEdit() && $this->BudgetEstimate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BudgetEstimate->AdvancedSearch->SearchValue != "" || $this->BudgetEstimate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ActualAmount
		if (!$this->isAddOrEdit() && $this->ActualAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ActualAmount->AdvancedSearch->SearchValue != "" || $this->ActualAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Status
		if (!$this->isAddOrEdit() && $this->Status->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Status->AdvancedSearch->SearchValue != "" || $this->Status->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LACode
		if (!$this->isAddOrEdit() && $this->LACode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LACode->AdvancedSearch->SearchValue != "" || $this->LACode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DepartmentCode
		if (!$this->isAddOrEdit() && $this->DepartmentCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DepartmentCode->AdvancedSearch->SearchValue != "" || $this->DepartmentCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SectionCode
		if (!$this->isAddOrEdit() && $this->SectionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SectionCode->AdvancedSearch->SearchValue != "" || $this->SectionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BudgetLine
		if (!$this->isAddOrEdit() && $this->BudgetLine->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BudgetLine->AdvancedSearch->SearchValue != "" || $this->BudgetLine->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ProgramCode
		if (!$this->isAddOrEdit() && $this->ProgramCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProgramCode->AdvancedSearch->SearchValue != "" || $this->ProgramCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SubProgramCode
		if (!$this->isAddOrEdit() && $this->SubProgramCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SubProgramCode->AdvancedSearch->SearchValue != "" || $this->SubProgramCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ApprovedBudget
		if (!$this->isAddOrEdit() && $this->ApprovedBudget->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ApprovedBudget->AdvancedSearch->SearchValue != "" || $this->ApprovedBudget->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'OutputCode' first before field var 'x_OutputCode'
		$val = $CurrentForm->hasValue("OutputCode") ? $CurrentForm->getValue("OutputCode") : $CurrentForm->getValue("x_OutputCode");
		if (!$this->OutputCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutputCode->Visible = FALSE; // Disable update for API request
			else
				$this->OutputCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OutputCode"))
			$this->OutputCode->setOldValue($CurrentForm->getValue("o_OutputCode"));

		// Check field name 'ActionCode' first before field var 'x_ActionCode'
		$val = $CurrentForm->hasValue("ActionCode") ? $CurrentForm->getValue("ActionCode") : $CurrentForm->getValue("x_ActionCode");
		if (!$this->ActionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionCode->Visible = FALSE; // Disable update for API request
			else
				$this->ActionCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ActionCode"))
			$this->ActionCode->setOldValue($CurrentForm->getValue("o_ActionCode"));

		// Check field name 'DetailedActionCode' first before field var 'x_DetailedActionCode'
		$val = $CurrentForm->hasValue("DetailedActionCode") ? $CurrentForm->getValue("DetailedActionCode") : $CurrentForm->getValue("x_DetailedActionCode");
		if (!$this->DetailedActionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DetailedActionCode->Visible = FALSE; // Disable update for API request
			else
				$this->DetailedActionCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DetailedActionCode"))
			$this->DetailedActionCode->setOldValue($CurrentForm->getValue("o_DetailedActionCode"));

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

		// Check field name 'MeansOfImplementation' first before field var 'x_MeansOfImplementation'
		$val = $CurrentForm->hasValue("MeansOfImplementation") ? $CurrentForm->getValue("MeansOfImplementation") : $CurrentForm->getValue("x_MeansOfImplementation");
		if (!$this->MeansOfImplementation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MeansOfImplementation->Visible = FALSE; // Disable update for API request
			else
				$this->MeansOfImplementation->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MeansOfImplementation"))
			$this->MeansOfImplementation->setOldValue($CurrentForm->getValue("o_MeansOfImplementation"));

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

		// Check field name 'Frequency' first before field var 'x_Frequency'
		$val = $CurrentForm->hasValue("Frequency") ? $CurrentForm->getValue("Frequency") : $CurrentForm->getValue("x_Frequency");
		if (!$this->Frequency->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Frequency->Visible = FALSE; // Disable update for API request
			else
				$this->Frequency->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Frequency"))
			$this->Frequency->setOldValue($CurrentForm->getValue("o_Frequency"));

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

		// Check field name 'BudgetEstimate' first before field var 'x_BudgetEstimate'
		$val = $CurrentForm->hasValue("BudgetEstimate") ? $CurrentForm->getValue("BudgetEstimate") : $CurrentForm->getValue("x_BudgetEstimate");
		if (!$this->BudgetEstimate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BudgetEstimate->Visible = FALSE; // Disable update for API request
			else
				$this->BudgetEstimate->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BudgetEstimate"))
			$this->BudgetEstimate->setOldValue($CurrentForm->getValue("o_BudgetEstimate"));

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

		// Check field name 'BudgetLine' first before field var 'x_BudgetLine'
		$val = $CurrentForm->hasValue("BudgetLine") ? $CurrentForm->getValue("BudgetLine") : $CurrentForm->getValue("x_BudgetLine");
		if (!$this->BudgetLine->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->BudgetLine->setFormValue($val);

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

		// Check field name 'ApprovedBudget' first before field var 'x_ApprovedBudget'
		$val = $CurrentForm->hasValue("ApprovedBudget") ? $CurrentForm->getValue("ApprovedBudget") : $CurrentForm->getValue("x_ApprovedBudget");
		if (!$this->ApprovedBudget->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ApprovedBudget->Visible = FALSE; // Disable update for API request
			else
				$this->ApprovedBudget->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ApprovedBudget"))
			$this->ApprovedBudget->setOldValue($CurrentForm->getValue("o_ApprovedBudget"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->ActionCode->CurrentValue = $this->ActionCode->FormValue;
		$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->FormValue;
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		$this->AccountCode->CurrentValue = $this->AccountCode->FormValue;
		$this->MeansOfImplementation->CurrentValue = $this->MeansOfImplementation->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->Quantity->CurrentValue = $this->Quantity->FormValue;
		$this->Frequency->CurrentValue = $this->Frequency->FormValue;
		$this->UnitCost->CurrentValue = $this->UnitCost->FormValue;
		$this->BudgetEstimate->CurrentValue = $this->BudgetEstimate->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->BudgetLine->CurrentValue = $this->BudgetLine->FormValue;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->SubProgramCode->CurrentValue = $this->SubProgramCode->FormValue;
		$this->ApprovedBudget->CurrentValue = $this->ApprovedBudget->FormValue;
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
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->ActionCode->setDbValue($row['ActionCode']);
		$this->DetailedActionCode->setDbValue($row['DetailedActionCode']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->AccountCode->setDbValue($row['AccountCode']);
		$this->ItemCode->setDbValue($row['ItemCode']);
		$this->MeansOfImplementation->setDbValue($row['MeansOfImplementation']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->Quantity->setDbValue($row['Quantity']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->PeriodLength->setDbValue($row['PeriodLength']);
		$this->Frequency->setDbValue($row['Frequency']);
		$this->UnitCost->setDbValue($row['UnitCost']);
		$this->BudgetEstimate->setDbValue($row['BudgetEstimate']);
		$this->ActualAmount->setDbValue($row['ActualAmount']);
		$this->Status->setDbValue($row['Status']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->BudgetLine->setDbValue($row['BudgetLine']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->ApprovedBudget->setDbValue($row['ApprovedBudget']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['OutcomeCode'] = $this->OutcomeCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['ActionCode'] = $this->ActionCode->CurrentValue;
		$row['DetailedActionCode'] = $this->DetailedActionCode->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['AccountCode'] = $this->AccountCode->CurrentValue;
		$row['ItemCode'] = $this->ItemCode->CurrentValue;
		$row['MeansOfImplementation'] = $this->MeansOfImplementation->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['Quantity'] = $this->Quantity->CurrentValue;
		$row['PeriodType'] = $this->PeriodType->CurrentValue;
		$row['PeriodLength'] = $this->PeriodLength->CurrentValue;
		$row['Frequency'] = $this->Frequency->CurrentValue;
		$row['UnitCost'] = $this->UnitCost->CurrentValue;
		$row['BudgetEstimate'] = $this->BudgetEstimate->CurrentValue;
		$row['ActualAmount'] = $this->ActualAmount->CurrentValue;
		$row['Status'] = $this->Status->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['BudgetLine'] = $this->BudgetLine->CurrentValue;
		$row['ProgramCode'] = $this->ProgramCode->CurrentValue;
		$row['SubProgramCode'] = $this->SubProgramCode->CurrentValue;
		$row['ApprovedBudget'] = $this->ApprovedBudget->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("BudgetLine")) != "")
			$this->BudgetLine->OldValue = $this->getKey("BudgetLine"); // BudgetLine
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

		// Convert decimal values if posted back
		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Frequency->FormValue == $this->Frequency->CurrentValue && is_numeric(ConvertToFloatString($this->Frequency->CurrentValue)))
			$this->Frequency->CurrentValue = ConvertToFloatString($this->Frequency->CurrentValue);

		// Convert decimal values if posted back
		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BudgetEstimate->FormValue == $this->BudgetEstimate->CurrentValue && is_numeric(ConvertToFloatString($this->BudgetEstimate->CurrentValue)))
			$this->BudgetEstimate->CurrentValue = ConvertToFloatString($this->BudgetEstimate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ApprovedBudget->FormValue == $this->ApprovedBudget->CurrentValue && is_numeric(ConvertToFloatString($this->ApprovedBudget->CurrentValue)))
			$this->ApprovedBudget->CurrentValue = ConvertToFloatString($this->ApprovedBudget->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// OutcomeCode
		// OutputCode
		// ActionCode
		// DetailedActionCode
		// FinancialYear
		// AccountCode
		// ItemCode
		// MeansOfImplementation
		// UnitOfMeasure
		// Quantity
		// PeriodType
		// PeriodLength
		// Frequency
		// UnitCost
		// BudgetEstimate
		// ActualAmount
		// Status
		// LACode
		// DepartmentCode
		// SectionCode
		// BudgetLine
		// ProgramCode
		// SubProgramCode
		// ApprovedBudget
		// Accumulate aggregate value

		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->BudgetEstimate->CurrentValue))
				$this->BudgetEstimate->Total += $this->BudgetEstimate->CurrentValue; // Accumulate total
			if (is_numeric($this->ActualAmount->CurrentValue))
				$this->ActualAmount->Total += $this->ActualAmount->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// OutputCode
			$curVal = strval($this->OutputCode->CurrentValue);
			if ($curVal != "") {
				$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
					}
				}
			} else {
				$this->OutputCode->ViewValue = NULL;
			}
			$this->OutputCode->ViewCustomAttributes = "";

			// ActionCode
			$curVal = strval($this->ActionCode->CurrentValue);
			if ($curVal != "") {
				$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
					}
				}
			} else {
				$this->ActionCode->ViewValue = NULL;
			}
			$this->ActionCode->ViewCustomAttributes = "";

			// DetailedActionCode
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
			$curVal = strval($this->DetailedActionCode->CurrentValue);
			if ($curVal != "") {
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
				if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
					}
				}
			} else {
				$this->DetailedActionCode->ViewValue = NULL;
			}
			$this->DetailedActionCode->ViewCustomAttributes = "";

			// FinancialYear
			$curVal = strval($this->FinancialYear->CurrentValue);
			if ($curVal != "") {
				$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
					}
				}
			} else {
				$this->FinancialYear->ViewValue = NULL;
			}
			$this->FinancialYear->ViewCustomAttributes = "";

			// AccountCode
			$curVal = strval($this->AccountCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
				if ($this->AccountCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
					}
				}
			} else {
				$this->AccountCode->ViewValue = NULL;
			}
			$this->AccountCode->ViewCustomAttributes = "";

			// MeansOfImplementation
			$curVal = strval($this->MeansOfImplementation->CurrentValue);
			if ($curVal != "") {
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
				if ($this->MeansOfImplementation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`moimp_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->CurrentValue;
					}
				}
			} else {
				$this->MeansOfImplementation->ViewValue = NULL;
			}
			$this->MeansOfImplementation->ViewCustomAttributes = "";

			// UnitOfMeasure
			$curVal = strval($this->UnitOfMeasure->CurrentValue);
			if ($curVal != "") {
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
				if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
					}
				}
			} else {
				$this->UnitOfMeasure->ViewValue = NULL;
			}
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 4, -2, -2, -2);
			$this->Quantity->CellCssStyle .= "text-align: right;";
			$this->Quantity->ViewCustomAttributes = "";

			// Frequency
			$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
			$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Frequency->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->CellCssStyle .= "text-align: right;";
			$this->UnitCost->ViewCustomAttributes = "";

			// BudgetEstimate
			$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
			$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
			$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
			$this->BudgetEstimate->ViewCustomAttributes = "";

			// ActualAmount
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->CellCssStyle .= "text-align: right;";
			$this->ActualAmount->ViewCustomAttributes = "";

			// Status
			$this->Status->ViewValue = $this->Status->CurrentValue;
			$curVal = strval($this->Status->CurrentValue);
			if ($curVal != "") {
				$this->Status->ViewValue = $this->Status->lookupCacheOption($curVal);
				if ($this->Status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Status->ViewValue = $this->Status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Status->ViewValue = $this->Status->CurrentValue;
					}
				}
			} else {
				$this->Status->ViewValue = NULL;
			}
			$this->Status->ViewCustomAttributes = "";

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

			// BudgetLine
			$this->BudgetLine->ViewValue = $this->BudgetLine->CurrentValue;
			$this->BudgetLine->ViewCustomAttributes = "";

			// ProgramCode
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

			// ApprovedBudget
			$this->ApprovedBudget->ViewValue = $this->ApprovedBudget->CurrentValue;
			$this->ApprovedBudget->ViewValue = FormatNumber($this->ApprovedBudget->ViewValue, 2, -2, -2, -2);
			$this->ApprovedBudget->ViewCustomAttributes = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";
			$this->ActionCode->TooltipValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";
			$this->DetailedActionCode->TooltipValue = "";
			if (!$this->isExport())
				$this->DetailedActionCode->ViewValue = $this->highlightValue($this->DetailedActionCode);

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";
			$this->AccountCode->TooltipValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";
			$this->MeansOfImplementation->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";
			$this->Frequency->TooltipValue = "";
			if (!$this->isExport())
				$this->Frequency->ViewValue = $this->highlightValue($this->Frequency);

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";
			$this->BudgetEstimate->TooltipValue = "";

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

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";
			$this->BudgetLine->TooltipValue = "";
			if (!$this->isExport())
				$this->BudgetLine->ViewValue = $this->highlightValue($this->BudgetLine);

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
			$this->ApprovedBudget->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// OutputCode
			$this->OutputCode->EditCustomAttributes = "";
			if ($this->OutputCode->getSessionValue() != "") {
				$this->OutputCode->CurrentValue = $this->OutputCode->getSessionValue();
				$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
				$curVal = strval($this->OutputCode->CurrentValue);
				if ($curVal != "") {
					$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
					if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
						}
					}
				} else {
					$this->OutputCode->ViewValue = NULL;
				}
				$this->OutputCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->OutputCode->CurrentValue));
				if ($curVal != "")
					$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				else
					$this->OutputCode->ViewValue = $this->OutputCode->Lookup !== NULL && is_array($this->OutputCode->Lookup->Options) ? $curVal : NULL;
				if ($this->OutputCode->ViewValue !== NULL) { // Load from cache
					$this->OutputCode->EditValue = array_values($this->OutputCode->Lookup->Options);
					if ($this->OutputCode->ViewValue == "")
						$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`OutputCode`" . SearchString("=", $this->OutputCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->OutputCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
					} else {
						$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->OutputCode->EditValue = $arwrk;
				}
			}

			// ActionCode
			$this->ActionCode->EditAttrs["class"] = "form-control";
			$this->ActionCode->EditCustomAttributes = "";
			if ($this->ActionCode->getSessionValue() != "") {
				$this->ActionCode->CurrentValue = $this->ActionCode->getSessionValue();
				$this->ActionCode->OldValue = $this->ActionCode->CurrentValue;
				$curVal = strval($this->ActionCode->CurrentValue);
				if ($curVal != "") {
					$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
					if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
						}
					}
				} else {
					$this->ActionCode->ViewValue = NULL;
				}
				$this->ActionCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ActionCode->CurrentValue));
				if ($curVal != "")
					$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				else
					$this->ActionCode->ViewValue = $this->ActionCode->Lookup !== NULL && is_array($this->ActionCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ActionCode->ViewValue !== NULL) { // Load from cache
					$this->ActionCode->EditValue = array_values($this->ActionCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ActionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ActionCode->EditValue = $arwrk;
				}
			}

			// DetailedActionCode
			$this->DetailedActionCode->EditAttrs["class"] = "form-control";
			$this->DetailedActionCode->EditCustomAttributes = "";
			if ($this->DetailedActionCode->getSessionValue() != "") {
				$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->getSessionValue();
				$this->DetailedActionCode->OldValue = $this->DetailedActionCode->CurrentValue;
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
				$curVal = strval($this->DetailedActionCode->CurrentValue);
				if ($curVal != "") {
					$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
					if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
						}
					}
				} else {
					$this->DetailedActionCode->ViewValue = NULL;
				}
				$this->DetailedActionCode->ViewCustomAttributes = "";
			} else {
				$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->CurrentValue);
				$curVal = strval($this->DetailedActionCode->CurrentValue);
				if ($curVal != "") {
					$this->DetailedActionCode->EditValue = $this->DetailedActionCode->lookupCacheOption($curVal);
					if ($this->DetailedActionCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->DetailedActionCode->EditValue = $this->DetailedActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->CurrentValue);
						}
					}
				} else {
					$this->DetailedActionCode->EditValue = NULL;
				}
				$this->DetailedActionCode->PlaceHolder = RemoveHtml($this->DetailedActionCode->caption());
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			if ($this->FinancialYear->getSessionValue() != "") {
				$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
				$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
				$curVal = strval($this->FinancialYear->CurrentValue);
				if ($curVal != "") {
					$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
					if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
						}
					}
				} else {
					$this->FinancialYear->ViewValue = NULL;
				}
				$this->FinancialYear->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->FinancialYear->CurrentValue));
				if ($curVal != "")
					$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				else
					$this->FinancialYear->ViewValue = $this->FinancialYear->Lookup !== NULL && is_array($this->FinancialYear->Lookup->Options) ? $curVal : NULL;
				if ($this->FinancialYear->ViewValue !== NULL) { // Load from cache
					$this->FinancialYear->EditValue = array_values($this->FinancialYear->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`Year`" . SearchString("=", $this->FinancialYear->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->FinancialYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->FinancialYear->EditValue = $arwrk;
				}
			}

			// AccountCode
			$this->AccountCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountCode->CurrentValue));
			if ($curVal != "")
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
			else
				$this->AccountCode->ViewValue = $this->AccountCode->Lookup !== NULL && is_array($this->AccountCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountCode->ViewValue !== NULL) { // Load from cache
				$this->AccountCode->EditValue = array_values($this->AccountCode->Lookup->Options);
				if ($this->AccountCode->ViewValue == "")
					$this->AccountCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
				} else {
					$this->AccountCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountCode->EditValue = $arwrk;
			}

			// MeansOfImplementation
			$this->MeansOfImplementation->EditCustomAttributes = "";
			$curVal = trim(strval($this->MeansOfImplementation->CurrentValue));
			if ($curVal != "")
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
			else
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->Lookup !== NULL && is_array($this->MeansOfImplementation->Lookup->Options) ? $curVal : NULL;
			if ($this->MeansOfImplementation->ViewValue !== NULL) { // Load from cache
				$this->MeansOfImplementation->EditValue = array_values($this->MeansOfImplementation->Lookup->Options);
				if ($this->MeansOfImplementation->ViewValue == "")
					$this->MeansOfImplementation->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`moimp_code`" . SearchString("=", $this->MeansOfImplementation->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
				} else {
					$this->MeansOfImplementation->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MeansOfImplementation->EditValue = $arwrk;
			}

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
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
			

			// Frequency
			$this->Frequency->EditAttrs["class"] = "form-control";
			$this->Frequency->EditCustomAttributes = "";
			$this->Frequency->EditValue = HtmlEncode($this->Frequency->CurrentValue);
			$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
			if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue)) {
				$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -1, -2, 0);
				$this->Frequency->OldValue = $this->Frequency->EditValue;
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
			

			// BudgetEstimate
			$this->BudgetEstimate->EditAttrs["class"] = "form-control";
			$this->BudgetEstimate->EditCustomAttributes = "";
			$this->BudgetEstimate->EditValue = HtmlEncode($this->BudgetEstimate->CurrentValue);
			$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());
			if (strval($this->BudgetEstimate->EditValue) != "" && is_numeric($this->BudgetEstimate->EditValue)) {
				$this->BudgetEstimate->EditValue = FormatNumber($this->BudgetEstimate->EditValue, -2, -2, -2, -2);
				$this->BudgetEstimate->OldValue = $this->BudgetEstimate->EditValue;
			}
			

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
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// BudgetLine
			// ProgramCode

			$this->ProgramCode->EditCustomAttributes = "";
			if ($this->ProgramCode->getSessionValue() != "") {
				$this->ProgramCode->CurrentValue = $this->ProgramCode->getSessionValue();
				$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
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
			} else {
				$curVal = trim(strval($this->ProgramCode->CurrentValue));
				if ($curVal != "")
					$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				else
					$this->ProgramCode->ViewValue = $this->ProgramCode->Lookup !== NULL && is_array($this->ProgramCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProgramCode->ViewValue !== NULL) { // Load from cache
					$this->ProgramCode->EditValue = array_values($this->ProgramCode->Lookup->Options);
					if ($this->ProgramCode->ViewValue == "")
						$this->ProgramCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProgramCode`" . SearchString("=", $this->ProgramCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
					} else {
						$this->ProgramCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProgramCode->EditValue = $arwrk;
				}
			}

			// SubProgramCode
			$this->SubProgramCode->EditCustomAttributes = "";
			if ($this->SubProgramCode->getSessionValue() != "") {
				$this->SubProgramCode->CurrentValue = $this->SubProgramCode->getSessionValue();
				$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
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
			} else {
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
			}

			// ApprovedBudget
			$this->ApprovedBudget->EditAttrs["class"] = "form-control";
			$this->ApprovedBudget->EditCustomAttributes = "";
			$this->ApprovedBudget->EditValue = HtmlEncode($this->ApprovedBudget->CurrentValue);
			$this->ApprovedBudget->PlaceHolder = RemoveHtml($this->ApprovedBudget->caption());
			if (strval($this->ApprovedBudget->EditValue) != "" && is_numeric($this->ApprovedBudget->EditValue)) {
				$this->ApprovedBudget->EditValue = FormatNumber($this->ApprovedBudget->EditValue, -2, -2, -2, -2);
				$this->ApprovedBudget->OldValue = $this->ApprovedBudget->EditValue;
			}
			

			// Add refer script
			// OutcomeCode

			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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

			// OutputCode
			$this->OutputCode->EditCustomAttributes = "";
			if ($this->OutputCode->getSessionValue() != "") {
				$this->OutputCode->CurrentValue = $this->OutputCode->getSessionValue();
				$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
				$curVal = strval($this->OutputCode->CurrentValue);
				if ($curVal != "") {
					$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
					if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
						}
					}
				} else {
					$this->OutputCode->ViewValue = NULL;
				}
				$this->OutputCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->OutputCode->CurrentValue));
				if ($curVal != "")
					$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				else
					$this->OutputCode->ViewValue = $this->OutputCode->Lookup !== NULL && is_array($this->OutputCode->Lookup->Options) ? $curVal : NULL;
				if ($this->OutputCode->ViewValue !== NULL) { // Load from cache
					$this->OutputCode->EditValue = array_values($this->OutputCode->Lookup->Options);
					if ($this->OutputCode->ViewValue == "")
						$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`OutputCode`" . SearchString("=", $this->OutputCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->OutputCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
					} else {
						$this->OutputCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->OutputCode->EditValue = $arwrk;
				}
			}

			// ActionCode
			$this->ActionCode->EditAttrs["class"] = "form-control";
			$this->ActionCode->EditCustomAttributes = "";
			if ($this->ActionCode->getSessionValue() != "") {
				$this->ActionCode->CurrentValue = $this->ActionCode->getSessionValue();
				$this->ActionCode->OldValue = $this->ActionCode->CurrentValue;
				$curVal = strval($this->ActionCode->CurrentValue);
				if ($curVal != "") {
					$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
					if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
						}
					}
				} else {
					$this->ActionCode->ViewValue = NULL;
				}
				$this->ActionCode->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ActionCode->CurrentValue));
				if ($curVal != "")
					$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				else
					$this->ActionCode->ViewValue = $this->ActionCode->Lookup !== NULL && is_array($this->ActionCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ActionCode->ViewValue !== NULL) { // Load from cache
					$this->ActionCode->EditValue = array_values($this->ActionCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ActionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ActionCode->EditValue = $arwrk;
				}
			}

			// DetailedActionCode
			$this->DetailedActionCode->EditAttrs["class"] = "form-control";
			$this->DetailedActionCode->EditCustomAttributes = "";
			if ($this->DetailedActionCode->getSessionValue() != "") {
				$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->getSessionValue();
				$this->DetailedActionCode->OldValue = $this->DetailedActionCode->CurrentValue;
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
				$curVal = strval($this->DetailedActionCode->CurrentValue);
				if ($curVal != "") {
					$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
					if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
						}
					}
				} else {
					$this->DetailedActionCode->ViewValue = NULL;
				}
				$this->DetailedActionCode->ViewCustomAttributes = "";
			} else {
				$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->CurrentValue);
				$curVal = strval($this->DetailedActionCode->CurrentValue);
				if ($curVal != "") {
					$this->DetailedActionCode->EditValue = $this->DetailedActionCode->lookupCacheOption($curVal);
					if ($this->DetailedActionCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->DetailedActionCode->EditValue = $this->DetailedActionCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->CurrentValue);
						}
					}
				} else {
					$this->DetailedActionCode->EditValue = NULL;
				}
				$this->DetailedActionCode->PlaceHolder = RemoveHtml($this->DetailedActionCode->caption());
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			if ($this->FinancialYear->getSessionValue() != "") {
				$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
				$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
				$curVal = strval($this->FinancialYear->CurrentValue);
				if ($curVal != "") {
					$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
					if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
						}
					}
				} else {
					$this->FinancialYear->ViewValue = NULL;
				}
				$this->FinancialYear->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->FinancialYear->CurrentValue));
				if ($curVal != "")
					$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				else
					$this->FinancialYear->ViewValue = $this->FinancialYear->Lookup !== NULL && is_array($this->FinancialYear->Lookup->Options) ? $curVal : NULL;
				if ($this->FinancialYear->ViewValue !== NULL) { // Load from cache
					$this->FinancialYear->EditValue = array_values($this->FinancialYear->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`Year`" . SearchString("=", $this->FinancialYear->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->FinancialYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->FinancialYear->EditValue = $arwrk;
				}
			}

			// AccountCode
			$this->AccountCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountCode->CurrentValue));
			if ($curVal != "")
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
			else
				$this->AccountCode->ViewValue = $this->AccountCode->Lookup !== NULL && is_array($this->AccountCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountCode->ViewValue !== NULL) { // Load from cache
				$this->AccountCode->EditValue = array_values($this->AccountCode->Lookup->Options);
				if ($this->AccountCode->ViewValue == "")
					$this->AccountCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
				} else {
					$this->AccountCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountCode->EditValue = $arwrk;
			}

			// MeansOfImplementation
			$this->MeansOfImplementation->EditCustomAttributes = "";
			$curVal = trim(strval($this->MeansOfImplementation->CurrentValue));
			if ($curVal != "")
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
			else
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->Lookup !== NULL && is_array($this->MeansOfImplementation->Lookup->Options) ? $curVal : NULL;
			if ($this->MeansOfImplementation->ViewValue !== NULL) { // Load from cache
				$this->MeansOfImplementation->EditValue = array_values($this->MeansOfImplementation->Lookup->Options);
				if ($this->MeansOfImplementation->ViewValue == "")
					$this->MeansOfImplementation->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`moimp_code`" . SearchString("=", $this->MeansOfImplementation->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
				} else {
					$this->MeansOfImplementation->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MeansOfImplementation->EditValue = $arwrk;
			}

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
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
			

			// Frequency
			$this->Frequency->EditAttrs["class"] = "form-control";
			$this->Frequency->EditCustomAttributes = "";
			$this->Frequency->EditValue = HtmlEncode($this->Frequency->CurrentValue);
			$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
			if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue)) {
				$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -1, -2, 0);
				$this->Frequency->OldValue = $this->Frequency->EditValue;
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
			

			// BudgetEstimate
			$this->BudgetEstimate->EditAttrs["class"] = "form-control";
			$this->BudgetEstimate->EditCustomAttributes = "";
			$this->BudgetEstimate->EditValue = HtmlEncode($this->BudgetEstimate->CurrentValue);
			$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());
			if (strval($this->BudgetEstimate->EditValue) != "" && is_numeric($this->BudgetEstimate->EditValue)) {
				$this->BudgetEstimate->EditValue = FormatNumber($this->BudgetEstimate->EditValue, -2, -2, -2, -2);
				$this->BudgetEstimate->OldValue = $this->BudgetEstimate->EditValue;
			}
			

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
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->CurrentValue));
			if ($curVal != "")
				$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// BudgetLine
			$this->BudgetLine->EditAttrs["class"] = "form-control";
			$this->BudgetLine->EditCustomAttributes = "";
			$this->BudgetLine->EditValue = $this->BudgetLine->CurrentValue;
			$this->BudgetLine->ViewCustomAttributes = "";

			// ProgramCode
			$this->ProgramCode->EditCustomAttributes = "";
			if ($this->ProgramCode->getSessionValue() != "") {
				$this->ProgramCode->CurrentValue = $this->ProgramCode->getSessionValue();
				$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
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
			} else {
				$curVal = trim(strval($this->ProgramCode->CurrentValue));
				if ($curVal != "")
					$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				else
					$this->ProgramCode->ViewValue = $this->ProgramCode->Lookup !== NULL && is_array($this->ProgramCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProgramCode->ViewValue !== NULL) { // Load from cache
					$this->ProgramCode->EditValue = array_values($this->ProgramCode->Lookup->Options);
					if ($this->ProgramCode->ViewValue == "")
						$this->ProgramCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProgramCode`" . SearchString("=", $this->ProgramCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
					} else {
						$this->ProgramCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProgramCode->EditValue = $arwrk;
				}
			}

			// SubProgramCode
			$this->SubProgramCode->EditCustomAttributes = "";
			if ($this->SubProgramCode->getSessionValue() != "") {
				$this->SubProgramCode->CurrentValue = $this->SubProgramCode->getSessionValue();
				$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
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
			} else {
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
			}

			// ApprovedBudget
			$this->ApprovedBudget->EditAttrs["class"] = "form-control";
			$this->ApprovedBudget->EditCustomAttributes = "";
			$this->ApprovedBudget->EditValue = HtmlEncode($this->ApprovedBudget->CurrentValue);
			$this->ApprovedBudget->PlaceHolder = RemoveHtml($this->ApprovedBudget->caption());
			if (strval($this->ApprovedBudget->EditValue) != "" && is_numeric($this->ApprovedBudget->EditValue)) {
				$this->ApprovedBudget->EditValue = FormatNumber($this->ApprovedBudget->EditValue, -2, -2, -2, -2);
				$this->ApprovedBudget->OldValue = $this->ApprovedBudget->EditValue;
			}
			

			// Edit refer script
			// OutcomeCode

			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->BudgetEstimate->Total = 0; // Initialize total
			$this->ActualAmount->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->BudgetEstimate->CurrentValue = $this->BudgetEstimate->Total;
			$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
			$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
			$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
			$this->BudgetEstimate->ViewCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = ""; // Clear href value
			$this->ActualAmount->CurrentValue = $this->ActualAmount->Total;
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->CellCssStyle .= "text-align: right;";
			$this->ActualAmount->ViewCustomAttributes = "";
			$this->ActualAmount->HrefValue = ""; // Clear href value
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
		if ($this->OutcomeCode->Required) {
			if (!$this->OutcomeCode->IsDetailKey && $this->OutcomeCode->FormValue != NULL && $this->OutcomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeCode->caption(), $this->OutcomeCode->RequiredErrorMessage));
			}
		}
		if ($this->OutputCode->Required) {
			if (!$this->OutputCode->IsDetailKey && $this->OutputCode->FormValue != NULL && $this->OutputCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutputCode->caption(), $this->OutputCode->RequiredErrorMessage));
			}
		}
		if ($this->ActionCode->Required) {
			if (!$this->ActionCode->IsDetailKey && $this->ActionCode->FormValue != NULL && $this->ActionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionCode->caption(), $this->ActionCode->RequiredErrorMessage));
			}
		}
		if ($this->DetailedActionCode->Required) {
			if (!$this->DetailedActionCode->IsDetailKey && $this->DetailedActionCode->FormValue != NULL && $this->DetailedActionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DetailedActionCode->caption(), $this->DetailedActionCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->DetailedActionCode->FormValue)) {
			AddMessage($FormError, $this->DetailedActionCode->errorMessage());
		}
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if ($this->AccountCode->Required) {
			if (!$this->AccountCode->IsDetailKey && $this->AccountCode->FormValue != NULL && $this->AccountCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountCode->caption(), $this->AccountCode->RequiredErrorMessage));
			}
		}
		if ($this->MeansOfImplementation->Required) {
			if (!$this->MeansOfImplementation->IsDetailKey && $this->MeansOfImplementation->FormValue != NULL && $this->MeansOfImplementation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MeansOfImplementation->caption(), $this->MeansOfImplementation->RequiredErrorMessage));
			}
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->Quantity->Required) {
			if (!$this->Quantity->IsDetailKey && $this->Quantity->FormValue != NULL && $this->Quantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Quantity->caption(), $this->Quantity->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Quantity->FormValue)) {
			AddMessage($FormError, $this->Quantity->errorMessage());
		}
		if ($this->Frequency->Required) {
			if (!$this->Frequency->IsDetailKey && $this->Frequency->FormValue != NULL && $this->Frequency->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Frequency->caption(), $this->Frequency->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Frequency->FormValue)) {
			AddMessage($FormError, $this->Frequency->errorMessage());
		}
		if ($this->UnitCost->Required) {
			if (!$this->UnitCost->IsDetailKey && $this->UnitCost->FormValue != NULL && $this->UnitCost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitCost->caption(), $this->UnitCost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->UnitCost->FormValue)) {
			AddMessage($FormError, $this->UnitCost->errorMessage());
		}
		if ($this->BudgetEstimate->Required) {
			if (!$this->BudgetEstimate->IsDetailKey && $this->BudgetEstimate->FormValue != NULL && $this->BudgetEstimate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BudgetEstimate->caption(), $this->BudgetEstimate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BudgetEstimate->FormValue)) {
			AddMessage($FormError, $this->BudgetEstimate->errorMessage());
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
		if ($this->BudgetLine->Required) {
			if (!$this->BudgetLine->IsDetailKey && $this->BudgetLine->FormValue != NULL && $this->BudgetLine->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BudgetLine->caption(), $this->BudgetLine->RequiredErrorMessage));
			}
		}
		if ($this->ProgramCode->Required) {
			if (!$this->ProgramCode->IsDetailKey && $this->ProgramCode->FormValue != NULL && $this->ProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgramCode->caption(), $this->ProgramCode->RequiredErrorMessage));
			}
		}
		if ($this->SubProgramCode->Required) {
			if (!$this->SubProgramCode->IsDetailKey && $this->SubProgramCode->FormValue != NULL && $this->SubProgramCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubProgramCode->caption(), $this->SubProgramCode->RequiredErrorMessage));
			}
		}
		if ($this->ApprovedBudget->Required) {
			if (!$this->ApprovedBudget->IsDetailKey && $this->ApprovedBudget->FormValue != NULL && $this->ApprovedBudget->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ApprovedBudget->caption(), $this->ApprovedBudget->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ApprovedBudget->FormValue)) {
			AddMessage($FormError, $this->ApprovedBudget->errorMessage());
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
				$thisKey .= $row['BudgetLine'];
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

			// OutcomeCode
			$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, $this->OutcomeCode->ReadOnly);

			// OutputCode
			$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, $this->OutputCode->ReadOnly);

			// ActionCode
			$this->ActionCode->setDbValueDef($rsnew, $this->ActionCode->CurrentValue, 0, $this->ActionCode->ReadOnly);

			// DetailedActionCode
			$this->DetailedActionCode->setDbValueDef($rsnew, $this->DetailedActionCode->CurrentValue, 0, $this->DetailedActionCode->ReadOnly);

			// FinancialYear
			$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, $this->FinancialYear->ReadOnly);

			// AccountCode
			$this->AccountCode->setDbValueDef($rsnew, $this->AccountCode->CurrentValue, "", $this->AccountCode->ReadOnly);

			// MeansOfImplementation
			$this->MeansOfImplementation->setDbValueDef($rsnew, $this->MeansOfImplementation->CurrentValue, NULL, $this->MeansOfImplementation->ReadOnly);

			// UnitOfMeasure
			$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, $this->UnitOfMeasure->ReadOnly);

			// Quantity
			$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, 0, $this->Quantity->ReadOnly);

			// Frequency
			$this->Frequency->setDbValueDef($rsnew, $this->Frequency->CurrentValue, 0, $this->Frequency->ReadOnly);

			// UnitCost
			$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, 0, $this->UnitCost->ReadOnly);

			// BudgetEstimate
			$this->BudgetEstimate->setDbValueDef($rsnew, $this->BudgetEstimate->CurrentValue, 0, $this->BudgetEstimate->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, $this->SectionCode->ReadOnly);

			// ProgramCode
			$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, 0, $this->ProgramCode->ReadOnly);

			// SubProgramCode
			$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, 0, $this->SubProgramCode->ReadOnly);

			// ApprovedBudget
			$this->ApprovedBudget->setDbValueDef($rsnew, $this->ApprovedBudget->CurrentValue, 0, $this->ApprovedBudget->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('OutcomeCode')); // OutcomeCode
		$hash .= GetFieldHash($rs->fields('OutputCode')); // OutputCode
		$hash .= GetFieldHash($rs->fields('ActionCode')); // ActionCode
		$hash .= GetFieldHash($rs->fields('DetailedActionCode')); // DetailedActionCode
		$hash .= GetFieldHash($rs->fields('FinancialYear')); // FinancialYear
		$hash .= GetFieldHash($rs->fields('AccountCode')); // AccountCode
		$hash .= GetFieldHash($rs->fields('MeansOfImplementation')); // MeansOfImplementation
		$hash .= GetFieldHash($rs->fields('UnitOfMeasure')); // UnitOfMeasure
		$hash .= GetFieldHash($rs->fields('Quantity')); // Quantity
		$hash .= GetFieldHash($rs->fields('Frequency')); // Frequency
		$hash .= GetFieldHash($rs->fields('UnitCost')); // UnitCost
		$hash .= GetFieldHash($rs->fields('BudgetEstimate')); // BudgetEstimate
		$hash .= GetFieldHash($rs->fields('LACode')); // LACode
		$hash .= GetFieldHash($rs->fields('DepartmentCode')); // DepartmentCode
		$hash .= GetFieldHash($rs->fields('SectionCode')); // SectionCode
		$hash .= GetFieldHash($rs->fields('ProgramCode')); // ProgramCode
		$hash .= GetFieldHash($rs->fields('SubProgramCode')); // SubProgramCode
		$hash .= GetFieldHash($rs->fields('ApprovedBudget')); // ApprovedBudget
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// OutcomeCode
		$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, FALSE);

		// OutputCode
		$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, FALSE);

		// ActionCode
		$this->ActionCode->setDbValueDef($rsnew, $this->ActionCode->CurrentValue, 0, FALSE);

		// DetailedActionCode
		$this->DetailedActionCode->setDbValueDef($rsnew, $this->DetailedActionCode->CurrentValue, 0, FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, FALSE);

		// AccountCode
		$this->AccountCode->setDbValueDef($rsnew, $this->AccountCode->CurrentValue, "", FALSE);

		// MeansOfImplementation
		$this->MeansOfImplementation->setDbValueDef($rsnew, $this->MeansOfImplementation->CurrentValue, NULL, FALSE);

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, FALSE);

		// Quantity
		$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, 0, FALSE);

		// Frequency
		$this->Frequency->setDbValueDef($rsnew, $this->Frequency->CurrentValue, 0, strval($this->Frequency->CurrentValue) == "");

		// UnitCost
		$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, 0, FALSE);

		// BudgetEstimate
		$this->BudgetEstimate->setDbValueDef($rsnew, $this->BudgetEstimate->CurrentValue, 0, strval($this->BudgetEstimate->CurrentValue) == "");

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// ProgramCode
		$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, 0, FALSE);

		// SubProgramCode
		$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, 0, FALSE);

		// ApprovedBudget
		$this->ApprovedBudget->setDbValueDef($rsnew, $this->ApprovedBudget->CurrentValue, 0, strval($this->ApprovedBudget->CurrentValue) == "");

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
		$this->OutcomeCode->AdvancedSearch->load();
		$this->OutputCode->AdvancedSearch->load();
		$this->ActionCode->AdvancedSearch->load();
		$this->DetailedActionCode->AdvancedSearch->load();
		$this->FinancialYear->AdvancedSearch->load();
		$this->AccountCode->AdvancedSearch->load();
		$this->MeansOfImplementation->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->Quantity->AdvancedSearch->load();
		$this->PeriodType->AdvancedSearch->load();
		$this->PeriodLength->AdvancedSearch->load();
		$this->Frequency->AdvancedSearch->load();
		$this->UnitCost->AdvancedSearch->load();
		$this->BudgetEstimate->AdvancedSearch->load();
		$this->ActualAmount->AdvancedSearch->load();
		$this->Status->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->BudgetLine->AdvancedSearch->load();
		$this->ProgramCode->AdvancedSearch->load();
		$this->SubProgramCode->AdvancedSearch->load();
		$this->ApprovedBudget->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fbudgetlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fbudgetlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fbudgetlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_budget" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_budget\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fbudgetlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fbudgetlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"budgetsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"budget\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'budgetsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fbudgetlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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

		// Export master record
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "detailed_action") {
			global $detailed_action;
			if (!isset($detailed_action))
				$detailed_action = new detailed_action();
			$rsmaster = $detailed_action->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$detailed_action;
					$detailed_action->exportDocument($doc, $rsmaster);
					$doc->exportEmptyRow();
					$doc->Table = &$this;
				}
				$rsmaster->close();
			}
		}
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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "detailed_action") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["detailed_action"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["detailed_action"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["detailed_action"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_FinancialYear", Get("FinancialYear"))) !== NULL) {
					$GLOBALS["detailed_action"]->FinancialYear->setQueryStringValue($parm);
					$this->FinancialYear->setQueryStringValue($GLOBALS["detailed_action"]->FinancialYear->QueryStringValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->FinancialYear->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ActionCode", Get("ActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ActionCode->setQueryStringValue($parm);
					$this->ActionCode->setQueryStringValue($GLOBALS["detailed_action"]->ActionCode->QueryStringValue);
					$this->ActionCode->setSessionValue($this->ActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutcomeCode", Get("OutcomeCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutcomeCode->setQueryStringValue($parm);
					$this->OutcomeCode->setQueryStringValue($GLOBALS["detailed_action"]->OutcomeCode->QueryStringValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutcomeCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutputCode", Get("OutputCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutputCode->setQueryStringValue($parm);
					$this->OutputCode->setQueryStringValue($GLOBALS["detailed_action"]->OutputCode->QueryStringValue);
					$this->OutputCode->setSessionValue($this->OutputCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutputCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DetailedActionCode", Get("DetailedActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DetailedActionCode->setQueryStringValue($parm);
					$this->DetailedActionCode->setQueryStringValue($GLOBALS["detailed_action"]->DetailedActionCode->QueryStringValue);
					$this->DetailedActionCode->setSessionValue($this->DetailedActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DetailedActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProgramCode", Get("ProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ProgramCode->setQueryStringValue($parm);
					$this->ProgramCode->setQueryStringValue($GLOBALS["detailed_action"]->ProgramCode->QueryStringValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ProgramCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_SubProgramCode", Get("SubProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->SubProgramCode->setQueryStringValue($parm);
					$this->SubProgramCode->setQueryStringValue($GLOBALS["detailed_action"]->SubProgramCode->QueryStringValue);
					$this->SubProgramCode->setSessionValue($this->SubProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["detailed_action"]->SubProgramCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "detailed_action") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["detailed_action"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["detailed_action"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["detailed_action"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_FinancialYear", Post("FinancialYear"))) !== NULL) {
					$GLOBALS["detailed_action"]->FinancialYear->setFormValue($parm);
					$this->FinancialYear->setFormValue($GLOBALS["detailed_action"]->FinancialYear->FormValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->FinancialYear->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ActionCode", Post("ActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ActionCode->setFormValue($parm);
					$this->ActionCode->setFormValue($GLOBALS["detailed_action"]->ActionCode->FormValue);
					$this->ActionCode->setSessionValue($this->ActionCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutcomeCode", Post("OutcomeCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutcomeCode->setFormValue($parm);
					$this->OutcomeCode->setFormValue($GLOBALS["detailed_action"]->OutcomeCode->FormValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutcomeCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutputCode", Post("OutputCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->OutputCode->setFormValue($parm);
					$this->OutputCode->setFormValue($GLOBALS["detailed_action"]->OutputCode->FormValue);
					$this->OutputCode->setSessionValue($this->OutputCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->OutputCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DetailedActionCode", Post("DetailedActionCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->DetailedActionCode->setFormValue($parm);
					$this->DetailedActionCode->setFormValue($GLOBALS["detailed_action"]->DetailedActionCode->FormValue);
					$this->DetailedActionCode->setSessionValue($this->DetailedActionCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->DetailedActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProgramCode", Post("ProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->ProgramCode->setFormValue($parm);
					$this->ProgramCode->setFormValue($GLOBALS["detailed_action"]->ProgramCode->FormValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->ProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_SubProgramCode", Post("SubProgramCode"))) !== NULL) {
					$GLOBALS["detailed_action"]->SubProgramCode->setFormValue($parm);
					$this->SubProgramCode->setFormValue($GLOBALS["detailed_action"]->SubProgramCode->FormValue);
					$this->SubProgramCode->setSessionValue($this->SubProgramCode->FormValue);
					if (!is_numeric($GLOBALS["detailed_action"]->SubProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Update URL
			$this->AddUrl = $this->addMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "detailed_action") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->FinancialYear->CurrentValue == "")
					$this->FinancialYear->setSessionValue("");
				if ($this->ActionCode->CurrentValue == "")
					$this->ActionCode->setSessionValue("");
				if ($this->OutcomeCode->CurrentValue == "")
					$this->OutcomeCode->setSessionValue("");
				if ($this->OutputCode->CurrentValue == "")
					$this->OutputCode->setSessionValue("");
				if ($this->DetailedActionCode->CurrentValue == "")
					$this->DetailedActionCode->setSessionValue("");
				if ($this->ProgramCode->CurrentValue == "")
					$this->ProgramCode->setSessionValue("");
				if ($this->SubProgramCode->CurrentValue == "")
					$this->SubProgramCode->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_OutcomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ActionCode":
					break;
				case "x_DetailedActionCode":
					break;
				case "x_FinancialYear":
					break;
				case "x_AccountCode":
					break;
				case "x_MeansOfImplementation":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PeriodType":
					break;
				case "x_Status":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProgramCode":
					break;
				case "x_SubProgramCode":
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
						case "x_OutcomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ActionCode":
							break;
						case "x_DetailedActionCode":
							break;
						case "x_FinancialYear":
							break;
						case "x_AccountCode":
							break;
						case "x_MeansOfImplementation":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PeriodType":
							break;
						case "x_Status":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProgramCode":
							break;
						case "x_SubProgramCode":
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