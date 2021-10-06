<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class valuation_roll_list extends valuation_roll
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'valuation_roll';

	// Page object name
	public $PageObjName = "valuation_roll_list";

	// Grid form hidden field names
	public $FormName = "fvaluation_rolllist";
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

		// Table object (valuation_roll)
		if (!isset($GLOBALS["valuation_roll"]) || get_class($GLOBALS["valuation_roll"]) == PROJECT_NAMESPACE . "valuation_roll") {
			$GLOBALS["valuation_roll"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["valuation_roll"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "valuation_rolladd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "valuation_rolldelete.php";
		$this->MultiUpdateUrl = "valuation_rollupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'valuation_roll');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fvaluation_rolllistsrch";

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
		global $valuation_roll;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($valuation_roll);
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
			$key .= @$ar['PropertyNo'];
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
		$this->PropertyNo->setVisibility();
		$this->Description->setVisibility();
		$this->Location->setVisibility();
		$this->Leaseholder->setVisibility();
		$this->PropertyUse->setVisibility();
		$this->LandExtent->setVisibility();
		$this->LandValue->setVisibility();
		$this->ImprovementsValue->setVisibility();
		$this->RateableValue->setVisibility();
		$this->Remarks->setVisibility();
		$this->ValuationDate->setVisibility();
		$this->ValuationReference->setVisibility();
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

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

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
		$this->LandExtent->FormValue = ""; // Clear form value
		$this->LandValue->FormValue = ""; // Clear form value
		$this->ImprovementsValue->FormValue = ""; // Clear form value
		$this->RateableValue->FormValue = ""; // Clear form value
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
			$this->PropertyNo->setOldValue($arKeyFlds[0]);
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
					$key .= $this->PropertyNo->CurrentValue;

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
		if ($CurrentForm->hasValue("x_PropertyNo") && $CurrentForm->hasValue("o_PropertyNo") && $this->PropertyNo->CurrentValue != $this->PropertyNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Description") && $CurrentForm->hasValue("o_Description") && $this->Description->CurrentValue != $this->Description->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Location") && $CurrentForm->hasValue("o_Location") && $this->Location->CurrentValue != $this->Location->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Leaseholder") && $CurrentForm->hasValue("o_Leaseholder") && $this->Leaseholder->CurrentValue != $this->Leaseholder->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PropertyUse") && $CurrentForm->hasValue("o_PropertyUse") && $this->PropertyUse->CurrentValue != $this->PropertyUse->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LandExtent") && $CurrentForm->hasValue("o_LandExtent") && $this->LandExtent->CurrentValue != $this->LandExtent->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LandValue") && $CurrentForm->hasValue("o_LandValue") && $this->LandValue->CurrentValue != $this->LandValue->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ImprovementsValue") && $CurrentForm->hasValue("o_ImprovementsValue") && $this->ImprovementsValue->CurrentValue != $this->ImprovementsValue->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RateableValue") && $CurrentForm->hasValue("o_RateableValue") && $this->RateableValue->CurrentValue != $this->RateableValue->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Remarks") && $CurrentForm->hasValue("o_Remarks") && $this->Remarks->CurrentValue != $this->Remarks->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ValuationDate") && $CurrentForm->hasValue("o_ValuationDate") && $this->ValuationDate->CurrentValue != $this->ValuationDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ValuationReference") && $CurrentForm->hasValue("o_ValuationReference") && $this->ValuationReference->CurrentValue != $this->ValuationReference->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fvaluation_rolllistsrch");
		$filterList = Concat($filterList, $this->PropertyNo->AdvancedSearch->toJson(), ","); // Field PropertyNo
		$filterList = Concat($filterList, $this->Description->AdvancedSearch->toJson(), ","); // Field Description
		$filterList = Concat($filterList, $this->Location->AdvancedSearch->toJson(), ","); // Field Location
		$filterList = Concat($filterList, $this->Leaseholder->AdvancedSearch->toJson(), ","); // Field Leaseholder
		$filterList = Concat($filterList, $this->PropertyUse->AdvancedSearch->toJson(), ","); // Field PropertyUse
		$filterList = Concat($filterList, $this->LandExtent->AdvancedSearch->toJson(), ","); // Field LandExtent
		$filterList = Concat($filterList, $this->LandValue->AdvancedSearch->toJson(), ","); // Field LandValue
		$filterList = Concat($filterList, $this->ImprovementsValue->AdvancedSearch->toJson(), ","); // Field ImprovementsValue
		$filterList = Concat($filterList, $this->RateableValue->AdvancedSearch->toJson(), ","); // Field RateableValue
		$filterList = Concat($filterList, $this->Remarks->AdvancedSearch->toJson(), ","); // Field Remarks
		$filterList = Concat($filterList, $this->ValuationDate->AdvancedSearch->toJson(), ","); // Field ValuationDate
		$filterList = Concat($filterList, $this->ValuationReference->AdvancedSearch->toJson(), ","); // Field ValuationReference
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fvaluation_rolllistsrch", $filters);
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

		// Field PropertyNo
		$this->PropertyNo->AdvancedSearch->SearchValue = @$filter["x_PropertyNo"];
		$this->PropertyNo->AdvancedSearch->SearchOperator = @$filter["z_PropertyNo"];
		$this->PropertyNo->AdvancedSearch->SearchCondition = @$filter["v_PropertyNo"];
		$this->PropertyNo->AdvancedSearch->SearchValue2 = @$filter["y_PropertyNo"];
		$this->PropertyNo->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyNo"];
		$this->PropertyNo->AdvancedSearch->save();

		// Field Description
		$this->Description->AdvancedSearch->SearchValue = @$filter["x_Description"];
		$this->Description->AdvancedSearch->SearchOperator = @$filter["z_Description"];
		$this->Description->AdvancedSearch->SearchCondition = @$filter["v_Description"];
		$this->Description->AdvancedSearch->SearchValue2 = @$filter["y_Description"];
		$this->Description->AdvancedSearch->SearchOperator2 = @$filter["w_Description"];
		$this->Description->AdvancedSearch->save();

		// Field Location
		$this->Location->AdvancedSearch->SearchValue = @$filter["x_Location"];
		$this->Location->AdvancedSearch->SearchOperator = @$filter["z_Location"];
		$this->Location->AdvancedSearch->SearchCondition = @$filter["v_Location"];
		$this->Location->AdvancedSearch->SearchValue2 = @$filter["y_Location"];
		$this->Location->AdvancedSearch->SearchOperator2 = @$filter["w_Location"];
		$this->Location->AdvancedSearch->save();

		// Field Leaseholder
		$this->Leaseholder->AdvancedSearch->SearchValue = @$filter["x_Leaseholder"];
		$this->Leaseholder->AdvancedSearch->SearchOperator = @$filter["z_Leaseholder"];
		$this->Leaseholder->AdvancedSearch->SearchCondition = @$filter["v_Leaseholder"];
		$this->Leaseholder->AdvancedSearch->SearchValue2 = @$filter["y_Leaseholder"];
		$this->Leaseholder->AdvancedSearch->SearchOperator2 = @$filter["w_Leaseholder"];
		$this->Leaseholder->AdvancedSearch->save();

		// Field PropertyUse
		$this->PropertyUse->AdvancedSearch->SearchValue = @$filter["x_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchOperator = @$filter["z_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchCondition = @$filter["v_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchValue2 = @$filter["y_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->save();

		// Field LandExtent
		$this->LandExtent->AdvancedSearch->SearchValue = @$filter["x_LandExtent"];
		$this->LandExtent->AdvancedSearch->SearchOperator = @$filter["z_LandExtent"];
		$this->LandExtent->AdvancedSearch->SearchCondition = @$filter["v_LandExtent"];
		$this->LandExtent->AdvancedSearch->SearchValue2 = @$filter["y_LandExtent"];
		$this->LandExtent->AdvancedSearch->SearchOperator2 = @$filter["w_LandExtent"];
		$this->LandExtent->AdvancedSearch->save();

		// Field LandValue
		$this->LandValue->AdvancedSearch->SearchValue = @$filter["x_LandValue"];
		$this->LandValue->AdvancedSearch->SearchOperator = @$filter["z_LandValue"];
		$this->LandValue->AdvancedSearch->SearchCondition = @$filter["v_LandValue"];
		$this->LandValue->AdvancedSearch->SearchValue2 = @$filter["y_LandValue"];
		$this->LandValue->AdvancedSearch->SearchOperator2 = @$filter["w_LandValue"];
		$this->LandValue->AdvancedSearch->save();

		// Field ImprovementsValue
		$this->ImprovementsValue->AdvancedSearch->SearchValue = @$filter["x_ImprovementsValue"];
		$this->ImprovementsValue->AdvancedSearch->SearchOperator = @$filter["z_ImprovementsValue"];
		$this->ImprovementsValue->AdvancedSearch->SearchCondition = @$filter["v_ImprovementsValue"];
		$this->ImprovementsValue->AdvancedSearch->SearchValue2 = @$filter["y_ImprovementsValue"];
		$this->ImprovementsValue->AdvancedSearch->SearchOperator2 = @$filter["w_ImprovementsValue"];
		$this->ImprovementsValue->AdvancedSearch->save();

		// Field RateableValue
		$this->RateableValue->AdvancedSearch->SearchValue = @$filter["x_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchOperator = @$filter["z_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchCondition = @$filter["v_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchValue2 = @$filter["y_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchOperator2 = @$filter["w_RateableValue"];
		$this->RateableValue->AdvancedSearch->save();

		// Field Remarks
		$this->Remarks->AdvancedSearch->SearchValue = @$filter["x_Remarks"];
		$this->Remarks->AdvancedSearch->SearchOperator = @$filter["z_Remarks"];
		$this->Remarks->AdvancedSearch->SearchCondition = @$filter["v_Remarks"];
		$this->Remarks->AdvancedSearch->SearchValue2 = @$filter["y_Remarks"];
		$this->Remarks->AdvancedSearch->SearchOperator2 = @$filter["w_Remarks"];
		$this->Remarks->AdvancedSearch->save();

		// Field ValuationDate
		$this->ValuationDate->AdvancedSearch->SearchValue = @$filter["x_ValuationDate"];
		$this->ValuationDate->AdvancedSearch->SearchOperator = @$filter["z_ValuationDate"];
		$this->ValuationDate->AdvancedSearch->SearchCondition = @$filter["v_ValuationDate"];
		$this->ValuationDate->AdvancedSearch->SearchValue2 = @$filter["y_ValuationDate"];
		$this->ValuationDate->AdvancedSearch->SearchOperator2 = @$filter["w_ValuationDate"];
		$this->ValuationDate->AdvancedSearch->save();

		// Field ValuationReference
		$this->ValuationReference->AdvancedSearch->SearchValue = @$filter["x_ValuationReference"];
		$this->ValuationReference->AdvancedSearch->SearchOperator = @$filter["z_ValuationReference"];
		$this->ValuationReference->AdvancedSearch->SearchCondition = @$filter["v_ValuationReference"];
		$this->ValuationReference->AdvancedSearch->SearchValue2 = @$filter["y_ValuationReference"];
		$this->ValuationReference->AdvancedSearch->SearchOperator2 = @$filter["w_ValuationReference"];
		$this->ValuationReference->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->PropertyNo, $default, FALSE); // PropertyNo
		$this->buildSearchSql($where, $this->Description, $default, FALSE); // Description
		$this->buildSearchSql($where, $this->Location, $default, FALSE); // Location
		$this->buildSearchSql($where, $this->Leaseholder, $default, FALSE); // Leaseholder
		$this->buildSearchSql($where, $this->PropertyUse, $default, FALSE); // PropertyUse
		$this->buildSearchSql($where, $this->LandExtent, $default, FALSE); // LandExtent
		$this->buildSearchSql($where, $this->LandValue, $default, FALSE); // LandValue
		$this->buildSearchSql($where, $this->ImprovementsValue, $default, FALSE); // ImprovementsValue
		$this->buildSearchSql($where, $this->RateableValue, $default, FALSE); // RateableValue
		$this->buildSearchSql($where, $this->Remarks, $default, FALSE); // Remarks
		$this->buildSearchSql($where, $this->ValuationDate, $default, FALSE); // ValuationDate
		$this->buildSearchSql($where, $this->ValuationReference, $default, FALSE); // ValuationReference

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->PropertyNo->AdvancedSearch->save(); // PropertyNo
			$this->Description->AdvancedSearch->save(); // Description
			$this->Location->AdvancedSearch->save(); // Location
			$this->Leaseholder->AdvancedSearch->save(); // Leaseholder
			$this->PropertyUse->AdvancedSearch->save(); // PropertyUse
			$this->LandExtent->AdvancedSearch->save(); // LandExtent
			$this->LandValue->AdvancedSearch->save(); // LandValue
			$this->ImprovementsValue->AdvancedSearch->save(); // ImprovementsValue
			$this->RateableValue->AdvancedSearch->save(); // RateableValue
			$this->Remarks->AdvancedSearch->save(); // Remarks
			$this->ValuationDate->AdvancedSearch->save(); // ValuationDate
			$this->ValuationReference->AdvancedSearch->save(); // ValuationReference
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
		$this->buildBasicSearchSql($where, $this->PropertyNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Description, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Location, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Leaseholder, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PropertyUse, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->RateableValue, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Remarks, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ValuationReference, $arKeywords, $type);
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
		if ($this->PropertyNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Description->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Location->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Leaseholder->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PropertyUse->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LandExtent->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LandValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ImprovementsValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RateableValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Remarks->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ValuationDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ValuationReference->AdvancedSearch->issetSession())
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
		$this->PropertyNo->AdvancedSearch->unsetSession();
		$this->Description->AdvancedSearch->unsetSession();
		$this->Location->AdvancedSearch->unsetSession();
		$this->Leaseholder->AdvancedSearch->unsetSession();
		$this->PropertyUse->AdvancedSearch->unsetSession();
		$this->LandExtent->AdvancedSearch->unsetSession();
		$this->LandValue->AdvancedSearch->unsetSession();
		$this->ImprovementsValue->AdvancedSearch->unsetSession();
		$this->RateableValue->AdvancedSearch->unsetSession();
		$this->Remarks->AdvancedSearch->unsetSession();
		$this->ValuationDate->AdvancedSearch->unsetSession();
		$this->ValuationReference->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->PropertyNo->AdvancedSearch->load();
		$this->Description->AdvancedSearch->load();
		$this->Location->AdvancedSearch->load();
		$this->Leaseholder->AdvancedSearch->load();
		$this->PropertyUse->AdvancedSearch->load();
		$this->LandExtent->AdvancedSearch->load();
		$this->LandValue->AdvancedSearch->load();
		$this->ImprovementsValue->AdvancedSearch->load();
		$this->RateableValue->AdvancedSearch->load();
		$this->Remarks->AdvancedSearch->load();
		$this->ValuationDate->AdvancedSearch->load();
		$this->ValuationReference->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->PropertyNo); // PropertyNo
			$this->updateSort($this->Description); // Description
			$this->updateSort($this->Location); // Location
			$this->updateSort($this->Leaseholder); // Leaseholder
			$this->updateSort($this->PropertyUse); // PropertyUse
			$this->updateSort($this->LandExtent); // LandExtent
			$this->updateSort($this->LandValue); // LandValue
			$this->updateSort($this->ImprovementsValue); // ImprovementsValue
			$this->updateSort($this->RateableValue); // RateableValue
			$this->updateSort($this->Remarks); // Remarks
			$this->updateSort($this->ValuationDate); // ValuationDate
			$this->updateSort($this->ValuationReference); // ValuationReference
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
				$this->PropertyNo->setSort("");
				$this->Description->setSort("");
				$this->Location->setSort("");
				$this->Leaseholder->setSort("");
				$this->PropertyUse->setSort("");
				$this->LandExtent->setSort("");
				$this->LandValue->setSort("");
				$this->ImprovementsValue->setSort("");
				$this->RateableValue->setSort("");
				$this->Remarks->setSort("");
				$this->ValuationDate->setSort("");
				$this->ValuationReference->setSort("");
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
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->PropertyNo->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = $this->GridAddUrl != "" && $Security->canAdd();
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fvaluation_rolllistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fvaluation_rolllistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fvaluation_rolllist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
					$item->Visible = FALSE;
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
		$this->PropertyNo->CurrentValue = NULL;
		$this->PropertyNo->OldValue = $this->PropertyNo->CurrentValue;
		$this->Description->CurrentValue = NULL;
		$this->Description->OldValue = $this->Description->CurrentValue;
		$this->Location->CurrentValue = NULL;
		$this->Location->OldValue = $this->Location->CurrentValue;
		$this->Leaseholder->CurrentValue = NULL;
		$this->Leaseholder->OldValue = $this->Leaseholder->CurrentValue;
		$this->PropertyUse->CurrentValue = NULL;
		$this->PropertyUse->OldValue = $this->PropertyUse->CurrentValue;
		$this->LandExtent->CurrentValue = NULL;
		$this->LandExtent->OldValue = $this->LandExtent->CurrentValue;
		$this->LandValue->CurrentValue = NULL;
		$this->LandValue->OldValue = $this->LandValue->CurrentValue;
		$this->ImprovementsValue->CurrentValue = NULL;
		$this->ImprovementsValue->OldValue = $this->ImprovementsValue->CurrentValue;
		$this->RateableValue->CurrentValue = NULL;
		$this->RateableValue->OldValue = $this->RateableValue->CurrentValue;
		$this->Remarks->CurrentValue = NULL;
		$this->Remarks->OldValue = $this->Remarks->CurrentValue;
		$this->ValuationDate->CurrentValue = NULL;
		$this->ValuationDate->OldValue = $this->ValuationDate->CurrentValue;
		$this->ValuationReference->CurrentValue = NULL;
		$this->ValuationReference->OldValue = $this->ValuationReference->CurrentValue;
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

		// PropertyNo
		if (!$this->isAddOrEdit() && $this->PropertyNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyNo->AdvancedSearch->SearchValue != "" || $this->PropertyNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Description
		if (!$this->isAddOrEdit() && $this->Description->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Description->AdvancedSearch->SearchValue != "" || $this->Description->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Location
		if (!$this->isAddOrEdit() && $this->Location->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Location->AdvancedSearch->SearchValue != "" || $this->Location->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Leaseholder
		if (!$this->isAddOrEdit() && $this->Leaseholder->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Leaseholder->AdvancedSearch->SearchValue != "" || $this->Leaseholder->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PropertyUse
		if (!$this->isAddOrEdit() && $this->PropertyUse->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyUse->AdvancedSearch->SearchValue != "" || $this->PropertyUse->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LandExtent
		if (!$this->isAddOrEdit() && $this->LandExtent->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LandExtent->AdvancedSearch->SearchValue != "" || $this->LandExtent->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LandValue
		if (!$this->isAddOrEdit() && $this->LandValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LandValue->AdvancedSearch->SearchValue != "" || $this->LandValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ImprovementsValue
		if (!$this->isAddOrEdit() && $this->ImprovementsValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ImprovementsValue->AdvancedSearch->SearchValue != "" || $this->ImprovementsValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RateableValue
		if (!$this->isAddOrEdit() && $this->RateableValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RateableValue->AdvancedSearch->SearchValue != "" || $this->RateableValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Remarks
		if (!$this->isAddOrEdit() && $this->Remarks->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Remarks->AdvancedSearch->SearchValue != "" || $this->Remarks->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ValuationDate
		if (!$this->isAddOrEdit() && $this->ValuationDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ValuationDate->AdvancedSearch->SearchValue != "" || $this->ValuationDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ValuationReference
		if (!$this->isAddOrEdit() && $this->ValuationReference->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ValuationReference->AdvancedSearch->SearchValue != "" || $this->ValuationReference->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'PropertyNo' first before field var 'x_PropertyNo'
		$val = $CurrentForm->hasValue("PropertyNo") ? $CurrentForm->getValue("PropertyNo") : $CurrentForm->getValue("x_PropertyNo");
		if (!$this->PropertyNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyNo->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PropertyNo"))
			$this->PropertyNo->setOldValue($CurrentForm->getValue("o_PropertyNo"));

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Description"))
			$this->Description->setOldValue($CurrentForm->getValue("o_Description"));

		// Check field name 'Location' first before field var 'x_Location'
		$val = $CurrentForm->hasValue("Location") ? $CurrentForm->getValue("Location") : $CurrentForm->getValue("x_Location");
		if (!$this->Location->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Location->Visible = FALSE; // Disable update for API request
			else
				$this->Location->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Location"))
			$this->Location->setOldValue($CurrentForm->getValue("o_Location"));

		// Check field name 'Leaseholder' first before field var 'x_Leaseholder'
		$val = $CurrentForm->hasValue("Leaseholder") ? $CurrentForm->getValue("Leaseholder") : $CurrentForm->getValue("x_Leaseholder");
		if (!$this->Leaseholder->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Leaseholder->Visible = FALSE; // Disable update for API request
			else
				$this->Leaseholder->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Leaseholder"))
			$this->Leaseholder->setOldValue($CurrentForm->getValue("o_Leaseholder"));

		// Check field name 'PropertyUse' first before field var 'x_PropertyUse'
		$val = $CurrentForm->hasValue("PropertyUse") ? $CurrentForm->getValue("PropertyUse") : $CurrentForm->getValue("x_PropertyUse");
		if (!$this->PropertyUse->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyUse->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyUse->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PropertyUse"))
			$this->PropertyUse->setOldValue($CurrentForm->getValue("o_PropertyUse"));

		// Check field name 'LandExtent' first before field var 'x_LandExtent'
		$val = $CurrentForm->hasValue("LandExtent") ? $CurrentForm->getValue("LandExtent") : $CurrentForm->getValue("x_LandExtent");
		if (!$this->LandExtent->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LandExtent->Visible = FALSE; // Disable update for API request
			else
				$this->LandExtent->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LandExtent"))
			$this->LandExtent->setOldValue($CurrentForm->getValue("o_LandExtent"));

		// Check field name 'LandValue' first before field var 'x_LandValue'
		$val = $CurrentForm->hasValue("LandValue") ? $CurrentForm->getValue("LandValue") : $CurrentForm->getValue("x_LandValue");
		if (!$this->LandValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LandValue->Visible = FALSE; // Disable update for API request
			else
				$this->LandValue->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LandValue"))
			$this->LandValue->setOldValue($CurrentForm->getValue("o_LandValue"));

		// Check field name 'ImprovementsValue' first before field var 'x_ImprovementsValue'
		$val = $CurrentForm->hasValue("ImprovementsValue") ? $CurrentForm->getValue("ImprovementsValue") : $CurrentForm->getValue("x_ImprovementsValue");
		if (!$this->ImprovementsValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ImprovementsValue->Visible = FALSE; // Disable update for API request
			else
				$this->ImprovementsValue->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ImprovementsValue"))
			$this->ImprovementsValue->setOldValue($CurrentForm->getValue("o_ImprovementsValue"));

		// Check field name 'RateableValue' first before field var 'x_RateableValue'
		$val = $CurrentForm->hasValue("RateableValue") ? $CurrentForm->getValue("RateableValue") : $CurrentForm->getValue("x_RateableValue");
		if (!$this->RateableValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RateableValue->Visible = FALSE; // Disable update for API request
			else
				$this->RateableValue->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RateableValue"))
			$this->RateableValue->setOldValue($CurrentForm->getValue("o_RateableValue"));

		// Check field name 'Remarks' first before field var 'x_Remarks'
		$val = $CurrentForm->hasValue("Remarks") ? $CurrentForm->getValue("Remarks") : $CurrentForm->getValue("x_Remarks");
		if (!$this->Remarks->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Remarks->Visible = FALSE; // Disable update for API request
			else
				$this->Remarks->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Remarks"))
			$this->Remarks->setOldValue($CurrentForm->getValue("o_Remarks"));

		// Check field name 'ValuationDate' first before field var 'x_ValuationDate'
		$val = $CurrentForm->hasValue("ValuationDate") ? $CurrentForm->getValue("ValuationDate") : $CurrentForm->getValue("x_ValuationDate");
		if (!$this->ValuationDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ValuationDate->Visible = FALSE; // Disable update for API request
			else
				$this->ValuationDate->setFormValue($val);
			$this->ValuationDate->CurrentValue = UnFormatDateTime($this->ValuationDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_ValuationDate"))
			$this->ValuationDate->setOldValue($CurrentForm->getValue("o_ValuationDate"));

		// Check field name 'ValuationReference' first before field var 'x_ValuationReference'
		$val = $CurrentForm->hasValue("ValuationReference") ? $CurrentForm->getValue("ValuationReference") : $CurrentForm->getValue("x_ValuationReference");
		if (!$this->ValuationReference->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ValuationReference->Visible = FALSE; // Disable update for API request
			else
				$this->ValuationReference->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ValuationReference"))
			$this->ValuationReference->setOldValue($CurrentForm->getValue("o_ValuationReference"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PropertyNo->CurrentValue = $this->PropertyNo->FormValue;
		$this->Description->CurrentValue = $this->Description->FormValue;
		$this->Location->CurrentValue = $this->Location->FormValue;
		$this->Leaseholder->CurrentValue = $this->Leaseholder->FormValue;
		$this->PropertyUse->CurrentValue = $this->PropertyUse->FormValue;
		$this->LandExtent->CurrentValue = $this->LandExtent->FormValue;
		$this->LandValue->CurrentValue = $this->LandValue->FormValue;
		$this->ImprovementsValue->CurrentValue = $this->ImprovementsValue->FormValue;
		$this->RateableValue->CurrentValue = $this->RateableValue->FormValue;
		$this->Remarks->CurrentValue = $this->Remarks->FormValue;
		$this->ValuationDate->CurrentValue = $this->ValuationDate->FormValue;
		$this->ValuationDate->CurrentValue = UnFormatDateTime($this->ValuationDate->CurrentValue, 0);
		$this->ValuationReference->CurrentValue = $this->ValuationReference->FormValue;
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
		$this->PropertyNo->setDbValue($row['PropertyNo']);
		$this->Description->setDbValue($row['Description']);
		$this->Location->setDbValue($row['Location']);
		$this->Leaseholder->setDbValue($row['Leaseholder']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
		$this->LandExtent->setDbValue($row['LandExtent']);
		$this->LandValue->setDbValue($row['LandValue']);
		$this->ImprovementsValue->setDbValue($row['ImprovementsValue']);
		$this->RateableValue->setDbValue($row['RateableValue']);
		$this->Remarks->setDbValue($row['Remarks']);
		$this->ValuationDate->setDbValue($row['ValuationDate']);
		$this->ValuationReference->setDbValue($row['ValuationReference']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['PropertyNo'] = $this->PropertyNo->CurrentValue;
		$row['Description'] = $this->Description->CurrentValue;
		$row['Location'] = $this->Location->CurrentValue;
		$row['Leaseholder'] = $this->Leaseholder->CurrentValue;
		$row['PropertyUse'] = $this->PropertyUse->CurrentValue;
		$row['LandExtent'] = $this->LandExtent->CurrentValue;
		$row['LandValue'] = $this->LandValue->CurrentValue;
		$row['ImprovementsValue'] = $this->ImprovementsValue->CurrentValue;
		$row['RateableValue'] = $this->RateableValue->CurrentValue;
		$row['Remarks'] = $this->Remarks->CurrentValue;
		$row['ValuationDate'] = $this->ValuationDate->CurrentValue;
		$row['ValuationReference'] = $this->ValuationReference->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("PropertyNo")) != "")
			$this->PropertyNo->OldValue = $this->getKey("PropertyNo"); // PropertyNo
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
		if ($this->LandExtent->FormValue == $this->LandExtent->CurrentValue && is_numeric(ConvertToFloatString($this->LandExtent->CurrentValue)))
			$this->LandExtent->CurrentValue = ConvertToFloatString($this->LandExtent->CurrentValue);

		// Convert decimal values if posted back
		if ($this->LandValue->FormValue == $this->LandValue->CurrentValue && is_numeric(ConvertToFloatString($this->LandValue->CurrentValue)))
			$this->LandValue->CurrentValue = ConvertToFloatString($this->LandValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ImprovementsValue->FormValue == $this->ImprovementsValue->CurrentValue && is_numeric(ConvertToFloatString($this->ImprovementsValue->CurrentValue)))
			$this->ImprovementsValue->CurrentValue = ConvertToFloatString($this->ImprovementsValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RateableValue->FormValue == $this->RateableValue->CurrentValue && is_numeric(ConvertToFloatString($this->RateableValue->CurrentValue)))
			$this->RateableValue->CurrentValue = ConvertToFloatString($this->RateableValue->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// PropertyNo
		// Description
		// Location
		// Leaseholder
		// PropertyUse
		// LandExtent
		// LandValue
		// ImprovementsValue
		// RateableValue
		// Remarks
		// ValuationDate
		// ValuationReference

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PropertyNo
			$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
			$this->PropertyNo->ViewCustomAttributes = "";

			// Description
			$this->Description->ViewValue = $this->Description->CurrentValue;
			$this->Description->ViewCustomAttributes = "";

			// Location
			$this->Location->ViewValue = $this->Location->CurrentValue;
			$this->Location->ViewCustomAttributes = "";

			// Leaseholder
			$this->Leaseholder->ViewValue = $this->Leaseholder->CurrentValue;
			$this->Leaseholder->ViewCustomAttributes = "";

			// PropertyUse
			$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
			$this->PropertyUse->ViewCustomAttributes = "";

			// LandExtent
			$this->LandExtent->ViewValue = $this->LandExtent->CurrentValue;
			$this->LandExtent->ViewValue = FormatNumber($this->LandExtent->ViewValue, 2, -2, -2, -2);
			$this->LandExtent->ViewCustomAttributes = "";

			// LandValue
			$this->LandValue->ViewValue = $this->LandValue->CurrentValue;
			$this->LandValue->ViewValue = FormatNumber($this->LandValue->ViewValue, 2, -2, -2, -2);
			$this->LandValue->ViewCustomAttributes = "";

			// ImprovementsValue
			$this->ImprovementsValue->ViewValue = $this->ImprovementsValue->CurrentValue;
			$this->ImprovementsValue->ViewValue = FormatNumber($this->ImprovementsValue->ViewValue, 2, -2, -2, -2);
			$this->ImprovementsValue->ViewCustomAttributes = "";

			// RateableValue
			$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
			$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->RateableValue->ViewCustomAttributes = "";

			// Remarks
			$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
			$this->Remarks->ViewCustomAttributes = "";

			// ValuationDate
			$this->ValuationDate->ViewValue = $this->ValuationDate->CurrentValue;
			$this->ValuationDate->ViewValue = FormatDateTime($this->ValuationDate->ViewValue, 0);
			$this->ValuationDate->ViewCustomAttributes = "";

			// ValuationReference
			$this->ValuationReference->ViewValue = $this->ValuationReference->CurrentValue;
			$this->ValuationReference->ViewCustomAttributes = "";

			// PropertyNo
			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";
			$this->PropertyNo->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyNo->ViewValue = $this->highlightValue($this->PropertyNo);

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";
			$this->Description->TooltipValue = "";
			if (!$this->isExport())
				$this->Description->ViewValue = $this->highlightValue($this->Description);

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";
			if (!$this->isExport())
				$this->Location->ViewValue = $this->highlightValue($this->Location);

			// Leaseholder
			$this->Leaseholder->LinkCustomAttributes = "";
			$this->Leaseholder->HrefValue = "";
			$this->Leaseholder->TooltipValue = "";
			if (!$this->isExport())
				$this->Leaseholder->ViewValue = $this->highlightValue($this->Leaseholder);

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyUse->ViewValue = $this->highlightValue($this->PropertyUse);

			// LandExtent
			$this->LandExtent->LinkCustomAttributes = "";
			$this->LandExtent->HrefValue = "";
			$this->LandExtent->TooltipValue = "";

			// LandValue
			$this->LandValue->LinkCustomAttributes = "";
			$this->LandValue->HrefValue = "";
			$this->LandValue->TooltipValue = "";

			// ImprovementsValue
			$this->ImprovementsValue->LinkCustomAttributes = "";
			$this->ImprovementsValue->HrefValue = "";
			$this->ImprovementsValue->TooltipValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";
			$this->RateableValue->TooltipValue = "";
			if (!$this->isExport())
				$this->RateableValue->ViewValue = $this->highlightValue($this->RateableValue);

			// Remarks
			$this->Remarks->LinkCustomAttributes = "";
			$this->Remarks->HrefValue = "";
			$this->Remarks->TooltipValue = "";
			if (!$this->isExport())
				$this->Remarks->ViewValue = $this->highlightValue($this->Remarks);

			// ValuationDate
			$this->ValuationDate->LinkCustomAttributes = "";
			$this->ValuationDate->HrefValue = "";
			$this->ValuationDate->TooltipValue = "";

			// ValuationReference
			$this->ValuationReference->LinkCustomAttributes = "";
			$this->ValuationReference->HrefValue = "";
			$this->ValuationReference->TooltipValue = "";
			if (!$this->isExport())
				$this->ValuationReference->ViewValue = $this->highlightValue($this->ValuationReference);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// PropertyNo
			$this->PropertyNo->EditAttrs["class"] = "form-control";
			$this->PropertyNo->EditCustomAttributes = "";
			if (!$this->PropertyNo->Raw)
				$this->PropertyNo->CurrentValue = HtmlDecode($this->PropertyNo->CurrentValue);
			$this->PropertyNo->EditValue = HtmlEncode($this->PropertyNo->CurrentValue);
			$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			if (!$this->Description->Raw)
				$this->Description->CurrentValue = HtmlDecode($this->Description->CurrentValue);
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// Location
			$this->Location->EditAttrs["class"] = "form-control";
			$this->Location->EditCustomAttributes = "";
			if (!$this->Location->Raw)
				$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
			$this->Location->EditValue = HtmlEncode($this->Location->CurrentValue);
			$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

			// Leaseholder
			$this->Leaseholder->EditAttrs["class"] = "form-control";
			$this->Leaseholder->EditCustomAttributes = "";
			if (!$this->Leaseholder->Raw)
				$this->Leaseholder->CurrentValue = HtmlDecode($this->Leaseholder->CurrentValue);
			$this->Leaseholder->EditValue = HtmlEncode($this->Leaseholder->CurrentValue);
			$this->Leaseholder->PlaceHolder = RemoveHtml($this->Leaseholder->caption());

			// PropertyUse
			$this->PropertyUse->EditAttrs["class"] = "form-control";
			$this->PropertyUse->EditCustomAttributes = "";
			if (!$this->PropertyUse->Raw)
				$this->PropertyUse->CurrentValue = HtmlDecode($this->PropertyUse->CurrentValue);
			$this->PropertyUse->EditValue = HtmlEncode($this->PropertyUse->CurrentValue);
			$this->PropertyUse->PlaceHolder = RemoveHtml($this->PropertyUse->caption());

			// LandExtent
			$this->LandExtent->EditAttrs["class"] = "form-control";
			$this->LandExtent->EditCustomAttributes = "";
			$this->LandExtent->EditValue = HtmlEncode($this->LandExtent->CurrentValue);
			$this->LandExtent->PlaceHolder = RemoveHtml($this->LandExtent->caption());
			if (strval($this->LandExtent->EditValue) != "" && is_numeric($this->LandExtent->EditValue)) {
				$this->LandExtent->EditValue = FormatNumber($this->LandExtent->EditValue, -2, -2, -2, -2);
				$this->LandExtent->OldValue = $this->LandExtent->EditValue;
			}
			

			// LandValue
			$this->LandValue->EditAttrs["class"] = "form-control";
			$this->LandValue->EditCustomAttributes = "";
			$this->LandValue->EditValue = HtmlEncode($this->LandValue->CurrentValue);
			$this->LandValue->PlaceHolder = RemoveHtml($this->LandValue->caption());
			if (strval($this->LandValue->EditValue) != "" && is_numeric($this->LandValue->EditValue)) {
				$this->LandValue->EditValue = FormatNumber($this->LandValue->EditValue, -2, -2, -2, -2);
				$this->LandValue->OldValue = $this->LandValue->EditValue;
			}
			

			// ImprovementsValue
			$this->ImprovementsValue->EditAttrs["class"] = "form-control";
			$this->ImprovementsValue->EditCustomAttributes = "";
			$this->ImprovementsValue->EditValue = HtmlEncode($this->ImprovementsValue->CurrentValue);
			$this->ImprovementsValue->PlaceHolder = RemoveHtml($this->ImprovementsValue->caption());
			if (strval($this->ImprovementsValue->EditValue) != "" && is_numeric($this->ImprovementsValue->EditValue)) {
				$this->ImprovementsValue->EditValue = FormatNumber($this->ImprovementsValue->EditValue, -2, -2, -2, -2);
				$this->ImprovementsValue->OldValue = $this->ImprovementsValue->EditValue;
			}
			

			// RateableValue
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue = HtmlEncode($this->RateableValue->CurrentValue);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
			if (strval($this->RateableValue->EditValue) != "" && is_numeric($this->RateableValue->EditValue)) {
				$this->RateableValue->EditValue = FormatNumber($this->RateableValue->EditValue, -2, -1, -2, 0);
				$this->RateableValue->OldValue = $this->RateableValue->EditValue;
			}
			

			// Remarks
			$this->Remarks->EditAttrs["class"] = "form-control";
			$this->Remarks->EditCustomAttributes = "";
			if (!$this->Remarks->Raw)
				$this->Remarks->CurrentValue = HtmlDecode($this->Remarks->CurrentValue);
			$this->Remarks->EditValue = HtmlEncode($this->Remarks->CurrentValue);
			$this->Remarks->PlaceHolder = RemoveHtml($this->Remarks->caption());

			// ValuationDate
			$this->ValuationDate->EditAttrs["class"] = "form-control";
			$this->ValuationDate->EditCustomAttributes = "";
			$this->ValuationDate->EditValue = HtmlEncode(FormatDateTime($this->ValuationDate->CurrentValue, 8));
			$this->ValuationDate->PlaceHolder = RemoveHtml($this->ValuationDate->caption());

			// ValuationReference
			$this->ValuationReference->EditAttrs["class"] = "form-control";
			$this->ValuationReference->EditCustomAttributes = "";
			if (!$this->ValuationReference->Raw)
				$this->ValuationReference->CurrentValue = HtmlDecode($this->ValuationReference->CurrentValue);
			$this->ValuationReference->EditValue = HtmlEncode($this->ValuationReference->CurrentValue);
			$this->ValuationReference->PlaceHolder = RemoveHtml($this->ValuationReference->caption());

			// Add refer script
			// PropertyNo

			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";

			// Leaseholder
			$this->Leaseholder->LinkCustomAttributes = "";
			$this->Leaseholder->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";

			// LandExtent
			$this->LandExtent->LinkCustomAttributes = "";
			$this->LandExtent->HrefValue = "";

			// LandValue
			$this->LandValue->LinkCustomAttributes = "";
			$this->LandValue->HrefValue = "";

			// ImprovementsValue
			$this->ImprovementsValue->LinkCustomAttributes = "";
			$this->ImprovementsValue->HrefValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";

			// Remarks
			$this->Remarks->LinkCustomAttributes = "";
			$this->Remarks->HrefValue = "";

			// ValuationDate
			$this->ValuationDate->LinkCustomAttributes = "";
			$this->ValuationDate->HrefValue = "";

			// ValuationReference
			$this->ValuationReference->LinkCustomAttributes = "";
			$this->ValuationReference->HrefValue = "";
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
		if ($this->PropertyNo->Required) {
			if (!$this->PropertyNo->IsDetailKey && $this->PropertyNo->FormValue != NULL && $this->PropertyNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyNo->caption(), $this->PropertyNo->RequiredErrorMessage));
			}
		}
		if ($this->Description->Required) {
			if (!$this->Description->IsDetailKey && $this->Description->FormValue != NULL && $this->Description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Description->caption(), $this->Description->RequiredErrorMessage));
			}
		}
		if ($this->Location->Required) {
			if (!$this->Location->IsDetailKey && $this->Location->FormValue != NULL && $this->Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Location->caption(), $this->Location->RequiredErrorMessage));
			}
		}
		if ($this->Leaseholder->Required) {
			if (!$this->Leaseholder->IsDetailKey && $this->Leaseholder->FormValue != NULL && $this->Leaseholder->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Leaseholder->caption(), $this->Leaseholder->RequiredErrorMessage));
			}
		}
		if ($this->PropertyUse->Required) {
			if (!$this->PropertyUse->IsDetailKey && $this->PropertyUse->FormValue != NULL && $this->PropertyUse->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyUse->caption(), $this->PropertyUse->RequiredErrorMessage));
			}
		}
		if ($this->LandExtent->Required) {
			if (!$this->LandExtent->IsDetailKey && $this->LandExtent->FormValue != NULL && $this->LandExtent->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LandExtent->caption(), $this->LandExtent->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LandExtent->FormValue)) {
			AddMessage($FormError, $this->LandExtent->errorMessage());
		}
		if ($this->LandValue->Required) {
			if (!$this->LandValue->IsDetailKey && $this->LandValue->FormValue != NULL && $this->LandValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LandValue->caption(), $this->LandValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LandValue->FormValue)) {
			AddMessage($FormError, $this->LandValue->errorMessage());
		}
		if ($this->ImprovementsValue->Required) {
			if (!$this->ImprovementsValue->IsDetailKey && $this->ImprovementsValue->FormValue != NULL && $this->ImprovementsValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ImprovementsValue->caption(), $this->ImprovementsValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ImprovementsValue->FormValue)) {
			AddMessage($FormError, $this->ImprovementsValue->errorMessage());
		}
		if ($this->RateableValue->Required) {
			if (!$this->RateableValue->IsDetailKey && $this->RateableValue->FormValue != NULL && $this->RateableValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RateableValue->caption(), $this->RateableValue->RequiredErrorMessage));
			}
		}
		if ($this->Remarks->Required) {
			if (!$this->Remarks->IsDetailKey && $this->Remarks->FormValue != NULL && $this->Remarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Remarks->caption(), $this->Remarks->RequiredErrorMessage));
			}
		}
		if ($this->ValuationDate->Required) {
			if (!$this->ValuationDate->IsDetailKey && $this->ValuationDate->FormValue != NULL && $this->ValuationDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ValuationDate->caption(), $this->ValuationDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ValuationDate->FormValue)) {
			AddMessage($FormError, $this->ValuationDate->errorMessage());
		}
		if ($this->ValuationReference->Required) {
			if (!$this->ValuationReference->IsDetailKey && $this->ValuationReference->FormValue != NULL && $this->ValuationReference->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ValuationReference->caption(), $this->ValuationReference->RequiredErrorMessage));
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
				$thisKey .= $row['PropertyNo'];
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

		// PropertyNo
		$this->PropertyNo->setDbValueDef($rsnew, $this->PropertyNo->CurrentValue, "", FALSE);

		// Description
		$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, "", FALSE);

		// Location
		$this->Location->setDbValueDef($rsnew, $this->Location->CurrentValue, "", FALSE);

		// Leaseholder
		$this->Leaseholder->setDbValueDef($rsnew, $this->Leaseholder->CurrentValue, "", FALSE);

		// PropertyUse
		$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, "", FALSE);

		// LandExtent
		$this->LandExtent->setDbValueDef($rsnew, $this->LandExtent->CurrentValue, 0, FALSE);

		// LandValue
		$this->LandValue->setDbValueDef($rsnew, $this->LandValue->CurrentValue, 0, FALSE);

		// ImprovementsValue
		$this->ImprovementsValue->setDbValueDef($rsnew, $this->ImprovementsValue->CurrentValue, 0, FALSE);

		// RateableValue
		$this->RateableValue->setDbValueDef($rsnew, $this->RateableValue->CurrentValue, 0, FALSE);

		// Remarks
		$this->Remarks->setDbValueDef($rsnew, $this->Remarks->CurrentValue, NULL, FALSE);

		// ValuationDate
		$this->ValuationDate->setDbValueDef($rsnew, UnFormatDateTime($this->ValuationDate->CurrentValue, 0), NULL, FALSE);

		// ValuationReference
		$this->ValuationReference->setDbValueDef($rsnew, $this->ValuationReference->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['PropertyNo']) == "") {
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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->PropertyNo->AdvancedSearch->load();
		$this->Description->AdvancedSearch->load();
		$this->Location->AdvancedSearch->load();
		$this->Leaseholder->AdvancedSearch->load();
		$this->PropertyUse->AdvancedSearch->load();
		$this->LandExtent->AdvancedSearch->load();
		$this->LandValue->AdvancedSearch->load();
		$this->ImprovementsValue->AdvancedSearch->load();
		$this->RateableValue->AdvancedSearch->load();
		$this->Remarks->AdvancedSearch->load();
		$this->ValuationDate->AdvancedSearch->load();
		$this->ValuationReference->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fvaluation_rolllist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fvaluation_rolllist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fvaluation_rolllist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_valuation_roll" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_valuation_roll\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fvaluation_rolllist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fvaluation_rolllistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"valuation_rollsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"valuation_roll\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'valuation_rollsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fvaluation_rolllistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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