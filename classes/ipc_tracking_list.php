<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ipc_tracking_list extends ipc_tracking
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ipc_tracking';

	// Page object name
	public $PageObjName = "ipc_tracking_list";

	// Grid form hidden field names
	public $FormName = "fipc_trackinglist";
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

		// Table object (ipc_tracking)
		if (!isset($GLOBALS["ipc_tracking"]) || get_class($GLOBALS["ipc_tracking"]) == PROJECT_NAMESPACE . "ipc_tracking") {
			$GLOBALS["ipc_tracking"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ipc_tracking"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "ipc_trackingadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "ipc_trackingdelete.php";
		$this->MultiUpdateUrl = "ipc_trackingupdate.php";

		// Table object (contract)
		if (!isset($GLOBALS['contract']))
			$GLOBALS['contract'] = new contract();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fipc_trackinglistsrch";

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

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Load server side filters
		if (Config("SEARCH_FILTER_OPTION") == "Server" && isset($UserProfile))
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fipc_trackinglistsrch");
		$filterList = Concat($filterList, $this->IPCNo->AdvancedSearch->toJson(), ","); // Field IPCNo
		$filterList = Concat($filterList, $this->ContractNo->AdvancedSearch->toJson(), ","); // Field ContractNo
		$filterList = Concat($filterList, $this->ContractAuthorizedByAG->AdvancedSearch->toJson(), ","); // Field ContractAuthorizedByAG
		$filterList = Concat($filterList, $this->VATApplied->AdvancedSearch->toJson(), ","); // Field VATApplied
		$filterList = Concat($filterList, $this->ArithmeticCheckDone->AdvancedSearch->toJson(), ","); // Field ArithmeticCheckDone
		$filterList = Concat($filterList, $this->VariationsApproved->AdvancedSearch->toJson(), ","); // Field VariationsApproved
		$filterList = Concat($filterList, $this->PerformanceBondValidUntil->AdvancedSearch->toJson(), ","); // Field PerformanceBondValidUntil
		$filterList = Concat($filterList, $this->AdvancePaymentBondValidUntil->AdvancedSearch->toJson(), ","); // Field AdvancePaymentBondValidUntil
		$filterList = Concat($filterList, $this->RetentionDeductionClause->AdvancedSearch->toJson(), ","); // Field RetentionDeductionClause
		$filterList = Concat($filterList, $this->RetentionDeducted->AdvancedSearch->toJson(), ","); // Field RetentionDeducted
		$filterList = Concat($filterList, $this->LiquidatedDamagesDeducted->AdvancedSearch->toJson(), ","); // Field LiquidatedDamagesDeducted
		$filterList = Concat($filterList, $this->LiquidatedPenaltiesDeducted->AdvancedSearch->toJson(), ","); // Field LiquidatedPenaltiesDeducted
		$filterList = Concat($filterList, $this->AdvancedPaymentDeducted->AdvancedSearch->toJson(), ","); // Field AdvancedPaymentDeducted
		$filterList = Concat($filterList, $this->CurrentProgressReportAttached->AdvancedSearch->toJson(), ","); // Field CurrentProgressReportAttached
		$filterList = Concat($filterList, $this->DateOfSiteInspection->AdvancedSearch->toJson(), ","); // Field DateOfSiteInspection
		$filterList = Concat($filterList, $this->TimeExtensionAuthorized->AdvancedSearch->toJson(), ","); // Field TimeExtensionAuthorized
		$filterList = Concat($filterList, $this->LabResultsChecked->AdvancedSearch->toJson(), ","); // Field LabResultsChecked
		$filterList = Concat($filterList, $this->TerminationNoticeGiven->AdvancedSearch->toJson(), ","); // Field TerminationNoticeGiven
		$filterList = Concat($filterList, $this->CopiesEmailedToMLG->AdvancedSearch->toJson(), ","); // Field CopiesEmailedToMLG
		$filterList = Concat($filterList, $this->ContractStillValid->AdvancedSearch->toJson(), ","); // Field ContractStillValid
		$filterList = Concat($filterList, $this->DeskOfficer->AdvancedSearch->toJson(), ","); // Field DeskOfficer
		$filterList = Concat($filterList, $this->DeskOfficerDate->AdvancedSearch->toJson(), ","); // Field DeskOfficerDate
		$filterList = Concat($filterList, $this->SupervisingEngineer->AdvancedSearch->toJson(), ","); // Field SupervisingEngineer
		$filterList = Concat($filterList, $this->EngineerDate->AdvancedSearch->toJson(), ","); // Field EngineerDate
		$filterList = Concat($filterList, $this->CouncilSecretary->AdvancedSearch->toJson(), ","); // Field CouncilSecretary
		$filterList = Concat($filterList, $this->CSDate->AdvancedSearch->toJson(), ","); // Field CSDate
		$filterList = Concat($filterList, $this->MLGComments->AdvancedSearch->toJson(), ","); // Field MLGComments
		$filterList = Concat($filterList, $this->ContractType->AdvancedSearch->toJson(), ","); // Field ContractType
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fipc_trackinglistsrch", $filters);
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

		// Field IPCNo
		$this->IPCNo->AdvancedSearch->SearchValue = @$filter["x_IPCNo"];
		$this->IPCNo->AdvancedSearch->SearchOperator = @$filter["z_IPCNo"];
		$this->IPCNo->AdvancedSearch->SearchCondition = @$filter["v_IPCNo"];
		$this->IPCNo->AdvancedSearch->SearchValue2 = @$filter["y_IPCNo"];
		$this->IPCNo->AdvancedSearch->SearchOperator2 = @$filter["w_IPCNo"];
		$this->IPCNo->AdvancedSearch->save();

		// Field ContractNo
		$this->ContractNo->AdvancedSearch->SearchValue = @$filter["x_ContractNo"];
		$this->ContractNo->AdvancedSearch->SearchOperator = @$filter["z_ContractNo"];
		$this->ContractNo->AdvancedSearch->SearchCondition = @$filter["v_ContractNo"];
		$this->ContractNo->AdvancedSearch->SearchValue2 = @$filter["y_ContractNo"];
		$this->ContractNo->AdvancedSearch->SearchOperator2 = @$filter["w_ContractNo"];
		$this->ContractNo->AdvancedSearch->save();

		// Field ContractAuthorizedByAG
		$this->ContractAuthorizedByAG->AdvancedSearch->SearchValue = @$filter["x_ContractAuthorizedByAG"];
		$this->ContractAuthorizedByAG->AdvancedSearch->SearchOperator = @$filter["z_ContractAuthorizedByAG"];
		$this->ContractAuthorizedByAG->AdvancedSearch->SearchCondition = @$filter["v_ContractAuthorizedByAG"];
		$this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2 = @$filter["y_ContractAuthorizedByAG"];
		$this->ContractAuthorizedByAG->AdvancedSearch->SearchOperator2 = @$filter["w_ContractAuthorizedByAG"];
		$this->ContractAuthorizedByAG->AdvancedSearch->save();

		// Field VATApplied
		$this->VATApplied->AdvancedSearch->SearchValue = @$filter["x_VATApplied"];
		$this->VATApplied->AdvancedSearch->SearchOperator = @$filter["z_VATApplied"];
		$this->VATApplied->AdvancedSearch->SearchCondition = @$filter["v_VATApplied"];
		$this->VATApplied->AdvancedSearch->SearchValue2 = @$filter["y_VATApplied"];
		$this->VATApplied->AdvancedSearch->SearchOperator2 = @$filter["w_VATApplied"];
		$this->VATApplied->AdvancedSearch->save();

		// Field ArithmeticCheckDone
		$this->ArithmeticCheckDone->AdvancedSearch->SearchValue = @$filter["x_ArithmeticCheckDone"];
		$this->ArithmeticCheckDone->AdvancedSearch->SearchOperator = @$filter["z_ArithmeticCheckDone"];
		$this->ArithmeticCheckDone->AdvancedSearch->SearchCondition = @$filter["v_ArithmeticCheckDone"];
		$this->ArithmeticCheckDone->AdvancedSearch->SearchValue2 = @$filter["y_ArithmeticCheckDone"];
		$this->ArithmeticCheckDone->AdvancedSearch->SearchOperator2 = @$filter["w_ArithmeticCheckDone"];
		$this->ArithmeticCheckDone->AdvancedSearch->save();

		// Field VariationsApproved
		$this->VariationsApproved->AdvancedSearch->SearchValue = @$filter["x_VariationsApproved"];
		$this->VariationsApproved->AdvancedSearch->SearchOperator = @$filter["z_VariationsApproved"];
		$this->VariationsApproved->AdvancedSearch->SearchCondition = @$filter["v_VariationsApproved"];
		$this->VariationsApproved->AdvancedSearch->SearchValue2 = @$filter["y_VariationsApproved"];
		$this->VariationsApproved->AdvancedSearch->SearchOperator2 = @$filter["w_VariationsApproved"];
		$this->VariationsApproved->AdvancedSearch->save();

		// Field PerformanceBondValidUntil
		$this->PerformanceBondValidUntil->AdvancedSearch->SearchValue = @$filter["x_PerformanceBondValidUntil"];
		$this->PerformanceBondValidUntil->AdvancedSearch->SearchOperator = @$filter["z_PerformanceBondValidUntil"];
		$this->PerformanceBondValidUntil->AdvancedSearch->SearchCondition = @$filter["v_PerformanceBondValidUntil"];
		$this->PerformanceBondValidUntil->AdvancedSearch->SearchValue2 = @$filter["y_PerformanceBondValidUntil"];
		$this->PerformanceBondValidUntil->AdvancedSearch->SearchOperator2 = @$filter["w_PerformanceBondValidUntil"];
		$this->PerformanceBondValidUntil->AdvancedSearch->save();

		// Field AdvancePaymentBondValidUntil
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchValue = @$filter["x_AdvancePaymentBondValidUntil"];
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchOperator = @$filter["z_AdvancePaymentBondValidUntil"];
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchCondition = @$filter["v_AdvancePaymentBondValidUntil"];
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchValue2 = @$filter["y_AdvancePaymentBondValidUntil"];
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchOperator2 = @$filter["w_AdvancePaymentBondValidUntil"];
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->save();

		// Field RetentionDeductionClause
		$this->RetentionDeductionClause->AdvancedSearch->SearchValue = @$filter["x_RetentionDeductionClause"];
		$this->RetentionDeductionClause->AdvancedSearch->SearchOperator = @$filter["z_RetentionDeductionClause"];
		$this->RetentionDeductionClause->AdvancedSearch->SearchCondition = @$filter["v_RetentionDeductionClause"];
		$this->RetentionDeductionClause->AdvancedSearch->SearchValue2 = @$filter["y_RetentionDeductionClause"];
		$this->RetentionDeductionClause->AdvancedSearch->SearchOperator2 = @$filter["w_RetentionDeductionClause"];
		$this->RetentionDeductionClause->AdvancedSearch->save();

		// Field RetentionDeducted
		$this->RetentionDeducted->AdvancedSearch->SearchValue = @$filter["x_RetentionDeducted"];
		$this->RetentionDeducted->AdvancedSearch->SearchOperator = @$filter["z_RetentionDeducted"];
		$this->RetentionDeducted->AdvancedSearch->SearchCondition = @$filter["v_RetentionDeducted"];
		$this->RetentionDeducted->AdvancedSearch->SearchValue2 = @$filter["y_RetentionDeducted"];
		$this->RetentionDeducted->AdvancedSearch->SearchOperator2 = @$filter["w_RetentionDeducted"];
		$this->RetentionDeducted->AdvancedSearch->save();

		// Field LiquidatedDamagesDeducted
		$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue = @$filter["x_LiquidatedDamagesDeducted"];
		$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchOperator = @$filter["z_LiquidatedDamagesDeducted"];
		$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchCondition = @$filter["v_LiquidatedDamagesDeducted"];
		$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2 = @$filter["y_LiquidatedDamagesDeducted"];
		$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchOperator2 = @$filter["w_LiquidatedDamagesDeducted"];
		$this->LiquidatedDamagesDeducted->AdvancedSearch->save();

		// Field LiquidatedPenaltiesDeducted
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue = @$filter["x_LiquidatedPenaltiesDeducted"];
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchOperator = @$filter["z_LiquidatedPenaltiesDeducted"];
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchCondition = @$filter["v_LiquidatedPenaltiesDeducted"];
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2 = @$filter["y_LiquidatedPenaltiesDeducted"];
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchOperator2 = @$filter["w_LiquidatedPenaltiesDeducted"];
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->save();

		// Field AdvancedPaymentDeducted
		$this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue = @$filter["x_AdvancedPaymentDeducted"];
		$this->AdvancedPaymentDeducted->AdvancedSearch->SearchOperator = @$filter["z_AdvancedPaymentDeducted"];
		$this->AdvancedPaymentDeducted->AdvancedSearch->SearchCondition = @$filter["v_AdvancedPaymentDeducted"];
		$this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2 = @$filter["y_AdvancedPaymentDeducted"];
		$this->AdvancedPaymentDeducted->AdvancedSearch->SearchOperator2 = @$filter["w_AdvancedPaymentDeducted"];
		$this->AdvancedPaymentDeducted->AdvancedSearch->save();

		// Field CurrentProgressReportAttached
		$this->CurrentProgressReportAttached->AdvancedSearch->SearchValue = @$filter["x_CurrentProgressReportAttached"];
		$this->CurrentProgressReportAttached->AdvancedSearch->SearchOperator = @$filter["z_CurrentProgressReportAttached"];
		$this->CurrentProgressReportAttached->AdvancedSearch->SearchCondition = @$filter["v_CurrentProgressReportAttached"];
		$this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2 = @$filter["y_CurrentProgressReportAttached"];
		$this->CurrentProgressReportAttached->AdvancedSearch->SearchOperator2 = @$filter["w_CurrentProgressReportAttached"];
		$this->CurrentProgressReportAttached->AdvancedSearch->save();

		// Field DateOfSiteInspection
		$this->DateOfSiteInspection->AdvancedSearch->SearchValue = @$filter["x_DateOfSiteInspection"];
		$this->DateOfSiteInspection->AdvancedSearch->SearchOperator = @$filter["z_DateOfSiteInspection"];
		$this->DateOfSiteInspection->AdvancedSearch->SearchCondition = @$filter["v_DateOfSiteInspection"];
		$this->DateOfSiteInspection->AdvancedSearch->SearchValue2 = @$filter["y_DateOfSiteInspection"];
		$this->DateOfSiteInspection->AdvancedSearch->SearchOperator2 = @$filter["w_DateOfSiteInspection"];
		$this->DateOfSiteInspection->AdvancedSearch->save();

		// Field TimeExtensionAuthorized
		$this->TimeExtensionAuthorized->AdvancedSearch->SearchValue = @$filter["x_TimeExtensionAuthorized"];
		$this->TimeExtensionAuthorized->AdvancedSearch->SearchOperator = @$filter["z_TimeExtensionAuthorized"];
		$this->TimeExtensionAuthorized->AdvancedSearch->SearchCondition = @$filter["v_TimeExtensionAuthorized"];
		$this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2 = @$filter["y_TimeExtensionAuthorized"];
		$this->TimeExtensionAuthorized->AdvancedSearch->SearchOperator2 = @$filter["w_TimeExtensionAuthorized"];
		$this->TimeExtensionAuthorized->AdvancedSearch->save();

		// Field LabResultsChecked
		$this->LabResultsChecked->AdvancedSearch->SearchValue = @$filter["x_LabResultsChecked"];
		$this->LabResultsChecked->AdvancedSearch->SearchOperator = @$filter["z_LabResultsChecked"];
		$this->LabResultsChecked->AdvancedSearch->SearchCondition = @$filter["v_LabResultsChecked"];
		$this->LabResultsChecked->AdvancedSearch->SearchValue2 = @$filter["y_LabResultsChecked"];
		$this->LabResultsChecked->AdvancedSearch->SearchOperator2 = @$filter["w_LabResultsChecked"];
		$this->LabResultsChecked->AdvancedSearch->save();

		// Field TerminationNoticeGiven
		$this->TerminationNoticeGiven->AdvancedSearch->SearchValue = @$filter["x_TerminationNoticeGiven"];
		$this->TerminationNoticeGiven->AdvancedSearch->SearchOperator = @$filter["z_TerminationNoticeGiven"];
		$this->TerminationNoticeGiven->AdvancedSearch->SearchCondition = @$filter["v_TerminationNoticeGiven"];
		$this->TerminationNoticeGiven->AdvancedSearch->SearchValue2 = @$filter["y_TerminationNoticeGiven"];
		$this->TerminationNoticeGiven->AdvancedSearch->SearchOperator2 = @$filter["w_TerminationNoticeGiven"];
		$this->TerminationNoticeGiven->AdvancedSearch->save();

		// Field CopiesEmailedToMLG
		$this->CopiesEmailedToMLG->AdvancedSearch->SearchValue = @$filter["x_CopiesEmailedToMLG"];
		$this->CopiesEmailedToMLG->AdvancedSearch->SearchOperator = @$filter["z_CopiesEmailedToMLG"];
		$this->CopiesEmailedToMLG->AdvancedSearch->SearchCondition = @$filter["v_CopiesEmailedToMLG"];
		$this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2 = @$filter["y_CopiesEmailedToMLG"];
		$this->CopiesEmailedToMLG->AdvancedSearch->SearchOperator2 = @$filter["w_CopiesEmailedToMLG"];
		$this->CopiesEmailedToMLG->AdvancedSearch->save();

		// Field ContractStillValid
		$this->ContractStillValid->AdvancedSearch->SearchValue = @$filter["x_ContractStillValid"];
		$this->ContractStillValid->AdvancedSearch->SearchOperator = @$filter["z_ContractStillValid"];
		$this->ContractStillValid->AdvancedSearch->SearchCondition = @$filter["v_ContractStillValid"];
		$this->ContractStillValid->AdvancedSearch->SearchValue2 = @$filter["y_ContractStillValid"];
		$this->ContractStillValid->AdvancedSearch->SearchOperator2 = @$filter["w_ContractStillValid"];
		$this->ContractStillValid->AdvancedSearch->save();

		// Field DeskOfficer
		$this->DeskOfficer->AdvancedSearch->SearchValue = @$filter["x_DeskOfficer"];
		$this->DeskOfficer->AdvancedSearch->SearchOperator = @$filter["z_DeskOfficer"];
		$this->DeskOfficer->AdvancedSearch->SearchCondition = @$filter["v_DeskOfficer"];
		$this->DeskOfficer->AdvancedSearch->SearchValue2 = @$filter["y_DeskOfficer"];
		$this->DeskOfficer->AdvancedSearch->SearchOperator2 = @$filter["w_DeskOfficer"];
		$this->DeskOfficer->AdvancedSearch->save();

		// Field DeskOfficerDate
		$this->DeskOfficerDate->AdvancedSearch->SearchValue = @$filter["x_DeskOfficerDate"];
		$this->DeskOfficerDate->AdvancedSearch->SearchOperator = @$filter["z_DeskOfficerDate"];
		$this->DeskOfficerDate->AdvancedSearch->SearchCondition = @$filter["v_DeskOfficerDate"];
		$this->DeskOfficerDate->AdvancedSearch->SearchValue2 = @$filter["y_DeskOfficerDate"];
		$this->DeskOfficerDate->AdvancedSearch->SearchOperator2 = @$filter["w_DeskOfficerDate"];
		$this->DeskOfficerDate->AdvancedSearch->save();

		// Field SupervisingEngineer
		$this->SupervisingEngineer->AdvancedSearch->SearchValue = @$filter["x_SupervisingEngineer"];
		$this->SupervisingEngineer->AdvancedSearch->SearchOperator = @$filter["z_SupervisingEngineer"];
		$this->SupervisingEngineer->AdvancedSearch->SearchCondition = @$filter["v_SupervisingEngineer"];
		$this->SupervisingEngineer->AdvancedSearch->SearchValue2 = @$filter["y_SupervisingEngineer"];
		$this->SupervisingEngineer->AdvancedSearch->SearchOperator2 = @$filter["w_SupervisingEngineer"];
		$this->SupervisingEngineer->AdvancedSearch->save();

		// Field EngineerDate
		$this->EngineerDate->AdvancedSearch->SearchValue = @$filter["x_EngineerDate"];
		$this->EngineerDate->AdvancedSearch->SearchOperator = @$filter["z_EngineerDate"];
		$this->EngineerDate->AdvancedSearch->SearchCondition = @$filter["v_EngineerDate"];
		$this->EngineerDate->AdvancedSearch->SearchValue2 = @$filter["y_EngineerDate"];
		$this->EngineerDate->AdvancedSearch->SearchOperator2 = @$filter["w_EngineerDate"];
		$this->EngineerDate->AdvancedSearch->save();

		// Field CouncilSecretary
		$this->CouncilSecretary->AdvancedSearch->SearchValue = @$filter["x_CouncilSecretary"];
		$this->CouncilSecretary->AdvancedSearch->SearchOperator = @$filter["z_CouncilSecretary"];
		$this->CouncilSecretary->AdvancedSearch->SearchCondition = @$filter["v_CouncilSecretary"];
		$this->CouncilSecretary->AdvancedSearch->SearchValue2 = @$filter["y_CouncilSecretary"];
		$this->CouncilSecretary->AdvancedSearch->SearchOperator2 = @$filter["w_CouncilSecretary"];
		$this->CouncilSecretary->AdvancedSearch->save();

		// Field CSDate
		$this->CSDate->AdvancedSearch->SearchValue = @$filter["x_CSDate"];
		$this->CSDate->AdvancedSearch->SearchOperator = @$filter["z_CSDate"];
		$this->CSDate->AdvancedSearch->SearchCondition = @$filter["v_CSDate"];
		$this->CSDate->AdvancedSearch->SearchValue2 = @$filter["y_CSDate"];
		$this->CSDate->AdvancedSearch->SearchOperator2 = @$filter["w_CSDate"];
		$this->CSDate->AdvancedSearch->save();

		// Field MLGComments
		$this->MLGComments->AdvancedSearch->SearchValue = @$filter["x_MLGComments"];
		$this->MLGComments->AdvancedSearch->SearchOperator = @$filter["z_MLGComments"];
		$this->MLGComments->AdvancedSearch->SearchCondition = @$filter["v_MLGComments"];
		$this->MLGComments->AdvancedSearch->SearchValue2 = @$filter["y_MLGComments"];
		$this->MLGComments->AdvancedSearch->SearchOperator2 = @$filter["w_MLGComments"];
		$this->MLGComments->AdvancedSearch->save();

		// Field ContractType
		$this->ContractType->AdvancedSearch->SearchValue = @$filter["x_ContractType"];
		$this->ContractType->AdvancedSearch->SearchOperator = @$filter["z_ContractType"];
		$this->ContractType->AdvancedSearch->SearchCondition = @$filter["v_ContractType"];
		$this->ContractType->AdvancedSearch->SearchValue2 = @$filter["y_ContractType"];
		$this->ContractType->AdvancedSearch->SearchOperator2 = @$filter["w_ContractType"];
		$this->ContractType->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->IPCNo, $default, FALSE); // IPCNo
		$this->buildSearchSql($where, $this->ContractNo, $default, FALSE); // ContractNo
		$this->buildSearchSql($where, $this->ContractAuthorizedByAG, $default, FALSE); // ContractAuthorizedByAG
		$this->buildSearchSql($where, $this->VATApplied, $default, FALSE); // VATApplied
		$this->buildSearchSql($where, $this->ArithmeticCheckDone, $default, FALSE); // ArithmeticCheckDone
		$this->buildSearchSql($where, $this->VariationsApproved, $default, FALSE); // VariationsApproved
		$this->buildSearchSql($where, $this->PerformanceBondValidUntil, $default, FALSE); // PerformanceBondValidUntil
		$this->buildSearchSql($where, $this->AdvancePaymentBondValidUntil, $default, FALSE); // AdvancePaymentBondValidUntil
		$this->buildSearchSql($where, $this->RetentionDeductionClause, $default, FALSE); // RetentionDeductionClause
		$this->buildSearchSql($where, $this->RetentionDeducted, $default, FALSE); // RetentionDeducted
		$this->buildSearchSql($where, $this->LiquidatedDamagesDeducted, $default, FALSE); // LiquidatedDamagesDeducted
		$this->buildSearchSql($where, $this->LiquidatedPenaltiesDeducted, $default, FALSE); // LiquidatedPenaltiesDeducted
		$this->buildSearchSql($where, $this->AdvancedPaymentDeducted, $default, FALSE); // AdvancedPaymentDeducted
		$this->buildSearchSql($where, $this->CurrentProgressReportAttached, $default, FALSE); // CurrentProgressReportAttached
		$this->buildSearchSql($where, $this->DateOfSiteInspection, $default, FALSE); // DateOfSiteInspection
		$this->buildSearchSql($where, $this->TimeExtensionAuthorized, $default, FALSE); // TimeExtensionAuthorized
		$this->buildSearchSql($where, $this->LabResultsChecked, $default, FALSE); // LabResultsChecked
		$this->buildSearchSql($where, $this->TerminationNoticeGiven, $default, FALSE); // TerminationNoticeGiven
		$this->buildSearchSql($where, $this->CopiesEmailedToMLG, $default, FALSE); // CopiesEmailedToMLG
		$this->buildSearchSql($where, $this->ContractStillValid, $default, FALSE); // ContractStillValid
		$this->buildSearchSql($where, $this->DeskOfficer, $default, FALSE); // DeskOfficer
		$this->buildSearchSql($where, $this->DeskOfficerDate, $default, FALSE); // DeskOfficerDate
		$this->buildSearchSql($where, $this->SupervisingEngineer, $default, FALSE); // SupervisingEngineer
		$this->buildSearchSql($where, $this->EngineerDate, $default, FALSE); // EngineerDate
		$this->buildSearchSql($where, $this->CouncilSecretary, $default, FALSE); // CouncilSecretary
		$this->buildSearchSql($where, $this->CSDate, $default, FALSE); // CSDate
		$this->buildSearchSql($where, $this->MLGComments, $default, FALSE); // MLGComments
		$this->buildSearchSql($where, $this->ContractType, $default, FALSE); // ContractType

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->IPCNo->AdvancedSearch->save(); // IPCNo
			$this->ContractNo->AdvancedSearch->save(); // ContractNo
			$this->ContractAuthorizedByAG->AdvancedSearch->save(); // ContractAuthorizedByAG
			$this->VATApplied->AdvancedSearch->save(); // VATApplied
			$this->ArithmeticCheckDone->AdvancedSearch->save(); // ArithmeticCheckDone
			$this->VariationsApproved->AdvancedSearch->save(); // VariationsApproved
			$this->PerformanceBondValidUntil->AdvancedSearch->save(); // PerformanceBondValidUntil
			$this->AdvancePaymentBondValidUntil->AdvancedSearch->save(); // AdvancePaymentBondValidUntil
			$this->RetentionDeductionClause->AdvancedSearch->save(); // RetentionDeductionClause
			$this->RetentionDeducted->AdvancedSearch->save(); // RetentionDeducted
			$this->LiquidatedDamagesDeducted->AdvancedSearch->save(); // LiquidatedDamagesDeducted
			$this->LiquidatedPenaltiesDeducted->AdvancedSearch->save(); // LiquidatedPenaltiesDeducted
			$this->AdvancedPaymentDeducted->AdvancedSearch->save(); // AdvancedPaymentDeducted
			$this->CurrentProgressReportAttached->AdvancedSearch->save(); // CurrentProgressReportAttached
			$this->DateOfSiteInspection->AdvancedSearch->save(); // DateOfSiteInspection
			$this->TimeExtensionAuthorized->AdvancedSearch->save(); // TimeExtensionAuthorized
			$this->LabResultsChecked->AdvancedSearch->save(); // LabResultsChecked
			$this->TerminationNoticeGiven->AdvancedSearch->save(); // TerminationNoticeGiven
			$this->CopiesEmailedToMLG->AdvancedSearch->save(); // CopiesEmailedToMLG
			$this->ContractStillValid->AdvancedSearch->save(); // ContractStillValid
			$this->DeskOfficer->AdvancedSearch->save(); // DeskOfficer
			$this->DeskOfficerDate->AdvancedSearch->save(); // DeskOfficerDate
			$this->SupervisingEngineer->AdvancedSearch->save(); // SupervisingEngineer
			$this->EngineerDate->AdvancedSearch->save(); // EngineerDate
			$this->CouncilSecretary->AdvancedSearch->save(); // CouncilSecretary
			$this->CSDate->AdvancedSearch->save(); // CSDate
			$this->MLGComments->AdvancedSearch->save(); // MLGComments
			$this->ContractType->AdvancedSearch->save(); // ContractType
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
		$this->buildBasicSearchSql($where, $this->ContractNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->RetentionDeductionClause, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DeskOfficer, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->SupervisingEngineer, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->CouncilSecretary, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->MLGComments, $arKeywords, $type);
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
		if ($this->IPCNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ContractNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ContractAuthorizedByAG->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->VATApplied->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ArithmeticCheckDone->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->VariationsApproved->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PerformanceBondValidUntil->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AdvancePaymentBondValidUntil->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RetentionDeductionClause->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RetentionDeducted->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LiquidatedDamagesDeducted->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LiquidatedPenaltiesDeducted->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AdvancedPaymentDeducted->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CurrentProgressReportAttached->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DateOfSiteInspection->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TimeExtensionAuthorized->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LabResultsChecked->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TerminationNoticeGiven->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CopiesEmailedToMLG->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ContractStillValid->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeskOfficer->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeskOfficerDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SupervisingEngineer->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->EngineerDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CouncilSecretary->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CSDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MLGComments->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ContractType->AdvancedSearch->issetSession())
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
		$this->IPCNo->AdvancedSearch->unsetSession();
		$this->ContractNo->AdvancedSearch->unsetSession();
		$this->ContractAuthorizedByAG->AdvancedSearch->unsetSession();
		$this->VATApplied->AdvancedSearch->unsetSession();
		$this->ArithmeticCheckDone->AdvancedSearch->unsetSession();
		$this->VariationsApproved->AdvancedSearch->unsetSession();
		$this->PerformanceBondValidUntil->AdvancedSearch->unsetSession();
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->unsetSession();
		$this->RetentionDeductionClause->AdvancedSearch->unsetSession();
		$this->RetentionDeducted->AdvancedSearch->unsetSession();
		$this->LiquidatedDamagesDeducted->AdvancedSearch->unsetSession();
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->unsetSession();
		$this->AdvancedPaymentDeducted->AdvancedSearch->unsetSession();
		$this->CurrentProgressReportAttached->AdvancedSearch->unsetSession();
		$this->DateOfSiteInspection->AdvancedSearch->unsetSession();
		$this->TimeExtensionAuthorized->AdvancedSearch->unsetSession();
		$this->LabResultsChecked->AdvancedSearch->unsetSession();
		$this->TerminationNoticeGiven->AdvancedSearch->unsetSession();
		$this->CopiesEmailedToMLG->AdvancedSearch->unsetSession();
		$this->ContractStillValid->AdvancedSearch->unsetSession();
		$this->DeskOfficer->AdvancedSearch->unsetSession();
		$this->DeskOfficerDate->AdvancedSearch->unsetSession();
		$this->SupervisingEngineer->AdvancedSearch->unsetSession();
		$this->EngineerDate->AdvancedSearch->unsetSession();
		$this->CouncilSecretary->AdvancedSearch->unsetSession();
		$this->CSDate->AdvancedSearch->unsetSession();
		$this->MLGComments->AdvancedSearch->unsetSession();
		$this->ContractType->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->IPCNo->AdvancedSearch->load();
		$this->ContractNo->AdvancedSearch->load();
		$this->ContractAuthorizedByAG->AdvancedSearch->load();
		$this->VATApplied->AdvancedSearch->load();
		$this->ArithmeticCheckDone->AdvancedSearch->load();
		$this->VariationsApproved->AdvancedSearch->load();
		$this->PerformanceBondValidUntil->AdvancedSearch->load();
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->load();
		$this->RetentionDeductionClause->AdvancedSearch->load();
		$this->RetentionDeducted->AdvancedSearch->load();
		$this->LiquidatedDamagesDeducted->AdvancedSearch->load();
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->load();
		$this->AdvancedPaymentDeducted->AdvancedSearch->load();
		$this->CurrentProgressReportAttached->AdvancedSearch->load();
		$this->DateOfSiteInspection->AdvancedSearch->load();
		$this->TimeExtensionAuthorized->AdvancedSearch->load();
		$this->LabResultsChecked->AdvancedSearch->load();
		$this->TerminationNoticeGiven->AdvancedSearch->load();
		$this->CopiesEmailedToMLG->AdvancedSearch->load();
		$this->ContractStillValid->AdvancedSearch->load();
		$this->DeskOfficer->AdvancedSearch->load();
		$this->DeskOfficerDate->AdvancedSearch->load();
		$this->SupervisingEngineer->AdvancedSearch->load();
		$this->EngineerDate->AdvancedSearch->load();
		$this->CouncilSecretary->AdvancedSearch->load();
		$this->CSDate->AdvancedSearch->load();
		$this->MLGComments->AdvancedSearch->load();
		$this->ContractType->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->IPCNo); // IPCNo
			$this->updateSort($this->ContractNo); // ContractNo
			$this->updateSort($this->ContractAuthorizedByAG); // ContractAuthorizedByAG
			$this->updateSort($this->VATApplied); // VATApplied
			$this->updateSort($this->ArithmeticCheckDone); // ArithmeticCheckDone
			$this->updateSort($this->VariationsApproved); // VariationsApproved
			$this->updateSort($this->PerformanceBondValidUntil); // PerformanceBondValidUntil
			$this->updateSort($this->AdvancePaymentBondValidUntil); // AdvancePaymentBondValidUntil
			$this->updateSort($this->RetentionDeductionClause); // RetentionDeductionClause
			$this->updateSort($this->RetentionDeducted); // RetentionDeducted
			$this->updateSort($this->LiquidatedDamagesDeducted); // LiquidatedDamagesDeducted
			$this->updateSort($this->AdvancedPaymentDeducted); // AdvancedPaymentDeducted
			$this->updateSort($this->CurrentProgressReportAttached); // CurrentProgressReportAttached
			$this->updateSort($this->DateOfSiteInspection); // DateOfSiteInspection
			$this->updateSort($this->TimeExtensionAuthorized); // TimeExtensionAuthorized
			$this->updateSort($this->LabResultsChecked); // LabResultsChecked
			$this->updateSort($this->TerminationNoticeGiven); // TerminationNoticeGiven
			$this->updateSort($this->CopiesEmailedToMLG); // CopiesEmailedToMLG
			$this->updateSort($this->ContractStillValid); // ContractStillValid
			$this->updateSort($this->DeskOfficer); // DeskOfficer
			$this->updateSort($this->DeskOfficerDate); // DeskOfficerDate
			$this->updateSort($this->SupervisingEngineer); // SupervisingEngineer
			$this->updateSort($this->EngineerDate); // EngineerDate
			$this->updateSort($this->CouncilSecretary); // CouncilSecretary
			$this->updateSort($this->CSDate); // CSDate
			$this->updateSort($this->ContractType); // ContractType
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
				$this->ContractNo->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->IPCNo->setSort("");
				$this->ContractNo->setSort("");
				$this->ContractAuthorizedByAG->setSort("");
				$this->VATApplied->setSort("");
				$this->ArithmeticCheckDone->setSort("");
				$this->VariationsApproved->setSort("");
				$this->PerformanceBondValidUntil->setSort("");
				$this->AdvancePaymentBondValidUntil->setSort("");
				$this->RetentionDeductionClause->setSort("");
				$this->RetentionDeducted->setSort("");
				$this->LiquidatedDamagesDeducted->setSort("");
				$this->AdvancedPaymentDeducted->setSort("");
				$this->CurrentProgressReportAttached->setSort("");
				$this->DateOfSiteInspection->setSort("");
				$this->TimeExtensionAuthorized->setSort("");
				$this->LabResultsChecked->setSort("");
				$this->TerminationNoticeGiven->setSort("");
				$this->CopiesEmailedToMLG->setSort("");
				$this->ContractStillValid->setSort("");
				$this->DeskOfficer->setSort("");
				$this->DeskOfficerDate->setSort("");
				$this->SupervisingEngineer->setSort("");
				$this->EngineerDate->setSort("");
				$this->CouncilSecretary->setSort("");
				$this->CSDate->setSort("");
				$this->ContractType->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->IPCNo->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		if (IsMobile())
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"ipc_tracking\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fipc_trackinglistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fipc_trackinglistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fipc_trackinglist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// IPCNo
		if (!$this->isAddOrEdit() && $this->IPCNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IPCNo->AdvancedSearch->SearchValue != "" || $this->IPCNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ContractNo
		if (!$this->isAddOrEdit() && $this->ContractNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ContractNo->AdvancedSearch->SearchValue != "" || $this->ContractNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ContractAuthorizedByAG
		if (!$this->isAddOrEdit() && $this->ContractAuthorizedByAG->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ContractAuthorizedByAG->AdvancedSearch->SearchValue != "" || $this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ContractAuthorizedByAG->AdvancedSearch->SearchValue))
			$this->ContractAuthorizedByAG->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractAuthorizedByAG->AdvancedSearch->SearchValue);
		if (is_array($this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2))
			$this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2);

		// VATApplied
		if (!$this->isAddOrEdit() && $this->VATApplied->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->VATApplied->AdvancedSearch->SearchValue != "" || $this->VATApplied->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->VATApplied->AdvancedSearch->SearchValue))
			$this->VATApplied->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VATApplied->AdvancedSearch->SearchValue);
		if (is_array($this->VATApplied->AdvancedSearch->SearchValue2))
			$this->VATApplied->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VATApplied->AdvancedSearch->SearchValue2);

		// ArithmeticCheckDone
		if (!$this->isAddOrEdit() && $this->ArithmeticCheckDone->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ArithmeticCheckDone->AdvancedSearch->SearchValue != "" || $this->ArithmeticCheckDone->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ArithmeticCheckDone->AdvancedSearch->SearchValue))
			$this->ArithmeticCheckDone->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ArithmeticCheckDone->AdvancedSearch->SearchValue);
		if (is_array($this->ArithmeticCheckDone->AdvancedSearch->SearchValue2))
			$this->ArithmeticCheckDone->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ArithmeticCheckDone->AdvancedSearch->SearchValue2);

		// VariationsApproved
		if (!$this->isAddOrEdit() && $this->VariationsApproved->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->VariationsApproved->AdvancedSearch->SearchValue != "" || $this->VariationsApproved->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->VariationsApproved->AdvancedSearch->SearchValue))
			$this->VariationsApproved->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VariationsApproved->AdvancedSearch->SearchValue);
		if (is_array($this->VariationsApproved->AdvancedSearch->SearchValue2))
			$this->VariationsApproved->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VariationsApproved->AdvancedSearch->SearchValue2);

		// PerformanceBondValidUntil
		if (!$this->isAddOrEdit() && $this->PerformanceBondValidUntil->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PerformanceBondValidUntil->AdvancedSearch->SearchValue != "" || $this->PerformanceBondValidUntil->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AdvancePaymentBondValidUntil
		if (!$this->isAddOrEdit() && $this->AdvancePaymentBondValidUntil->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchValue != "" || $this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RetentionDeductionClause
		if (!$this->isAddOrEdit() && $this->RetentionDeductionClause->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RetentionDeductionClause->AdvancedSearch->SearchValue != "" || $this->RetentionDeductionClause->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RetentionDeducted
		if (!$this->isAddOrEdit() && $this->RetentionDeducted->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RetentionDeducted->AdvancedSearch->SearchValue != "" || $this->RetentionDeducted->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->RetentionDeducted->AdvancedSearch->SearchValue))
			$this->RetentionDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->RetentionDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->RetentionDeducted->AdvancedSearch->SearchValue2))
			$this->RetentionDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->RetentionDeducted->AdvancedSearch->SearchValue2);

		// LiquidatedDamagesDeducted
		if (!$this->isAddOrEdit() && $this->LiquidatedDamagesDeducted->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue != "" || $this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue))
			$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2))
			$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2);

		// LiquidatedPenaltiesDeducted
		if (!$this->isAddOrEdit() && $this->LiquidatedPenaltiesDeducted->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue != "" || $this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue))
			$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2))
			$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2);

		// AdvancedPaymentDeducted
		if (!$this->isAddOrEdit() && $this->AdvancedPaymentDeducted->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue != "" || $this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue))
			$this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2))
			$this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2);

		// CurrentProgressReportAttached
		if (!$this->isAddOrEdit() && $this->CurrentProgressReportAttached->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CurrentProgressReportAttached->AdvancedSearch->SearchValue != "" || $this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->CurrentProgressReportAttached->AdvancedSearch->SearchValue))
			$this->CurrentProgressReportAttached->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CurrentProgressReportAttached->AdvancedSearch->SearchValue);
		if (is_array($this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2))
			$this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2);

		// DateOfSiteInspection
		if (!$this->isAddOrEdit() && $this->DateOfSiteInspection->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DateOfSiteInspection->AdvancedSearch->SearchValue != "" || $this->DateOfSiteInspection->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TimeExtensionAuthorized
		if (!$this->isAddOrEdit() && $this->TimeExtensionAuthorized->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TimeExtensionAuthorized->AdvancedSearch->SearchValue != "" || $this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->TimeExtensionAuthorized->AdvancedSearch->SearchValue))
			$this->TimeExtensionAuthorized->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TimeExtensionAuthorized->AdvancedSearch->SearchValue);
		if (is_array($this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2))
			$this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2);

		// LabResultsChecked
		if (!$this->isAddOrEdit() && $this->LabResultsChecked->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LabResultsChecked->AdvancedSearch->SearchValue != "" || $this->LabResultsChecked->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->LabResultsChecked->AdvancedSearch->SearchValue))
			$this->LabResultsChecked->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LabResultsChecked->AdvancedSearch->SearchValue);
		if (is_array($this->LabResultsChecked->AdvancedSearch->SearchValue2))
			$this->LabResultsChecked->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LabResultsChecked->AdvancedSearch->SearchValue2);

		// TerminationNoticeGiven
		if (!$this->isAddOrEdit() && $this->TerminationNoticeGiven->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TerminationNoticeGiven->AdvancedSearch->SearchValue != "" || $this->TerminationNoticeGiven->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->TerminationNoticeGiven->AdvancedSearch->SearchValue))
			$this->TerminationNoticeGiven->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TerminationNoticeGiven->AdvancedSearch->SearchValue);
		if (is_array($this->TerminationNoticeGiven->AdvancedSearch->SearchValue2))
			$this->TerminationNoticeGiven->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TerminationNoticeGiven->AdvancedSearch->SearchValue2);

		// CopiesEmailedToMLG
		if (!$this->isAddOrEdit() && $this->CopiesEmailedToMLG->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CopiesEmailedToMLG->AdvancedSearch->SearchValue != "" || $this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->CopiesEmailedToMLG->AdvancedSearch->SearchValue))
			$this->CopiesEmailedToMLG->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CopiesEmailedToMLG->AdvancedSearch->SearchValue);
		if (is_array($this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2))
			$this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2);

		// ContractStillValid
		if (!$this->isAddOrEdit() && $this->ContractStillValid->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ContractStillValid->AdvancedSearch->SearchValue != "" || $this->ContractStillValid->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->ContractStillValid->AdvancedSearch->SearchValue))
			$this->ContractStillValid->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractStillValid->AdvancedSearch->SearchValue);
		if (is_array($this->ContractStillValid->AdvancedSearch->SearchValue2))
			$this->ContractStillValid->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractStillValid->AdvancedSearch->SearchValue2);

		// DeskOfficer
		if (!$this->isAddOrEdit() && $this->DeskOfficer->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeskOfficer->AdvancedSearch->SearchValue != "" || $this->DeskOfficer->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DeskOfficerDate
		if (!$this->isAddOrEdit() && $this->DeskOfficerDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeskOfficerDate->AdvancedSearch->SearchValue != "" || $this->DeskOfficerDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SupervisingEngineer
		if (!$this->isAddOrEdit() && $this->SupervisingEngineer->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SupervisingEngineer->AdvancedSearch->SearchValue != "" || $this->SupervisingEngineer->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// EngineerDate
		if (!$this->isAddOrEdit() && $this->EngineerDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->EngineerDate->AdvancedSearch->SearchValue != "" || $this->EngineerDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// CouncilSecretary
		if (!$this->isAddOrEdit() && $this->CouncilSecretary->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CouncilSecretary->AdvancedSearch->SearchValue != "" || $this->CouncilSecretary->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// CSDate
		if (!$this->isAddOrEdit() && $this->CSDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CSDate->AdvancedSearch->SearchValue != "" || $this->CSDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MLGComments
		if (!$this->isAddOrEdit() && $this->MLGComments->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MLGComments->AdvancedSearch->SearchValue != "" || $this->MLGComments->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ContractType
		if (!$this->isAddOrEdit() && $this->ContractType->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ContractType->AdvancedSearch->SearchValue != "" || $this->ContractType->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
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
		$this->DateOfSiteInspection->setDbValue($row['DateOfSiteInspection']);
		$this->TimeExtensionAuthorized->setDbValue($row['TimeExtensionAuthorized']);
		$this->LabResultsChecked->setDbValue($row['LabResultsChecked']);
		$this->LabResults->Upload->DbValue = $row['LabResults'];
		if (is_array($this->LabResults->Upload->DbValue) || is_object($this->LabResults->Upload->DbValue)) // Byte array
			$this->LabResults->Upload->DbValue = BytesToString($this->LabResults->Upload->DbValue);
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
		$row = [];
		$row['IPCNo'] = NULL;
		$row['ContractNo'] = NULL;
		$row['ContractAuthorizedByAG'] = NULL;
		$row['VATApplied'] = NULL;
		$row['ArithmeticCheckDone'] = NULL;
		$row['VariationsApproved'] = NULL;
		$row['PerformanceBondValidUntil'] = NULL;
		$row['AdvancePaymentBondValidUntil'] = NULL;
		$row['RetentionDeductionClause'] = NULL;
		$row['RetentionDeducted'] = NULL;
		$row['LiquidatedDamagesDeducted'] = NULL;
		$row['LiquidatedPenaltiesDeducted'] = NULL;
		$row['AdvancedPaymentDeducted'] = NULL;
		$row['CurrentProgressReportAttached'] = NULL;
		$row['CurrentProgressReport'] = NULL;
		$row['DateOfSiteInspection'] = NULL;
		$row['TimeExtensionAuthorized'] = NULL;
		$row['LabResultsChecked'] = NULL;
		$row['LabResults'] = NULL;
		$row['TerminationNoticeGiven'] = NULL;
		$row['CopiesEmailedToMLG'] = NULL;
		$row['ContractStillValid'] = NULL;
		$row['DeskOfficer'] = NULL;
		$row['DeskOfficerDate'] = NULL;
		$row['SupervisingEngineer'] = NULL;
		$row['EngineerDate'] = NULL;
		$row['CouncilSecretary'] = NULL;
		$row['CSDate'] = NULL;
		$row['MLGComments'] = NULL;
		$row['ContractType'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("IPCNo")) != "")
			$this->IPCNo->OldValue = $this->getKey("IPCNo"); // IPCNo
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
		}

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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->IPCNo->AdvancedSearch->load();
		$this->ContractNo->AdvancedSearch->load();
		$this->ContractAuthorizedByAG->AdvancedSearch->load();
		$this->VATApplied->AdvancedSearch->load();
		$this->ArithmeticCheckDone->AdvancedSearch->load();
		$this->VariationsApproved->AdvancedSearch->load();
		$this->PerformanceBondValidUntil->AdvancedSearch->load();
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->load();
		$this->RetentionDeductionClause->AdvancedSearch->load();
		$this->RetentionDeducted->AdvancedSearch->load();
		$this->LiquidatedDamagesDeducted->AdvancedSearch->load();
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->load();
		$this->AdvancedPaymentDeducted->AdvancedSearch->load();
		$this->CurrentProgressReportAttached->AdvancedSearch->load();
		$this->DateOfSiteInspection->AdvancedSearch->load();
		$this->TimeExtensionAuthorized->AdvancedSearch->load();
		$this->LabResultsChecked->AdvancedSearch->load();
		$this->TerminationNoticeGiven->AdvancedSearch->load();
		$this->CopiesEmailedToMLG->AdvancedSearch->load();
		$this->ContractStillValid->AdvancedSearch->load();
		$this->DeskOfficer->AdvancedSearch->load();
		$this->DeskOfficerDate->AdvancedSearch->load();
		$this->SupervisingEngineer->AdvancedSearch->load();
		$this->EngineerDate->AdvancedSearch->load();
		$this->CouncilSecretary->AdvancedSearch->load();
		$this->CSDate->AdvancedSearch->load();
		$this->MLGComments->AdvancedSearch->load();
		$this->ContractType->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fipc_trackinglist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fipc_trackinglist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fipc_trackinglist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_ipc_tracking" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_ipc_tracking\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fipc_trackinglist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fipc_trackinglistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"ipc_trackingsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"ipc_tracking\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'ipc_trackingsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fipc_trackinglistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "contract") {
			global $contract;
			if (!isset($contract))
				$contract = new contract();
			$rsmaster = $contract->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$contract;
					$contract->exportDocument($doc, $rsmaster);
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
			if ($masterTblVar == "contract") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ContractNo", Get("ContractNo"))) !== NULL) {
					$GLOBALS["contract"]->ContractNo->setQueryStringValue($parm);
					$this->ContractNo->setQueryStringValue($GLOBALS["contract"]->ContractNo->QueryStringValue);
					$this->ContractNo->setSessionValue($this->ContractNo->QueryStringValue);
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
			if ($masterTblVar == "contract") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ContractNo", Post("ContractNo"))) !== NULL) {
					$GLOBALS["contract"]->ContractNo->setFormValue($parm);
					$this->ContractNo->setFormValue($GLOBALS["contract"]->ContractNo->FormValue);
					$this->ContractNo->setSessionValue($this->ContractNo->FormValue);
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
			if ($masterTblVar != "contract") {
				if ($this->ContractNo->CurrentValue == "")
					$this->ContractNo->setSessionValue("");
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