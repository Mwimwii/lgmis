<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipt_header_reverse_list extends receipt_header_reverse
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipt_header_reverse';

	// Page object name
	public $PageObjName = "receipt_header_reverse_list";

	// Grid form hidden field names
	public $FormName = "freceipt_header_reverselist";
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

		// Table object (receipt_header_reverse)
		if (!isset($GLOBALS["receipt_header_reverse"]) || get_class($GLOBALS["receipt_header_reverse"]) == PROJECT_NAMESPACE . "receipt_header_reverse") {
			$GLOBALS["receipt_header_reverse"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["receipt_header_reverse"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "receipt_header_reverseadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "receipt_header_reversedelete.php";
		$this->MultiUpdateUrl = "receipt_header_reverseupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipt_header_reverse');

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
		$this->FilterOptions->TagClassName = "ew-filter-option freceipt_header_reverselistsrch";

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
		global $receipt_header_reverse;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipt_header_reverse);
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
			$key .= @$ar['ReversalRef'];
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
			$this->ReversalRef->Visible = FALSE;
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
		$this->ReceiptNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->PaidBy->setVisibility();
		$this->ClientPostalAddress->setVisibility();
		$this->ClientPhysicalAddress->setVisibility();
		$this->ClientEmail->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->ReceiptPrefix->setVisibility();
		$this->AccountBased->setVisibility();
		$this->Cashier->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->TotalDue->setVisibility();
		$this->AmountTendered->setVisibility();
		$this->Change->setVisibility();
		$this->ClientMessage->setVisibility();
		$this->Reasons->Visible = FALSE;
		$this->ReversalRef->setVisibility();
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
		$this->setupLookupOptions($this->ReceiptNo);
		$this->setupLookupOptions($this->ClientSerNo);

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
			$this->ReversalRef->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ReversalRef->OldValue))
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "freceipt_header_reverselistsrch");
		$filterList = Concat($filterList, $this->ReceiptNo->AdvancedSearch->toJson(), ","); // Field ReceiptNo
		$filterList = Concat($filterList, $this->ClientSerNo->AdvancedSearch->toJson(), ","); // Field ClientSerNo
		$filterList = Concat($filterList, $this->ClientID->AdvancedSearch->toJson(), ","); // Field ClientID
		$filterList = Concat($filterList, $this->PaidBy->AdvancedSearch->toJson(), ","); // Field PaidBy
		$filterList = Concat($filterList, $this->ClientPostalAddress->AdvancedSearch->toJson(), ","); // Field ClientPostalAddress
		$filterList = Concat($filterList, $this->ClientPhysicalAddress->AdvancedSearch->toJson(), ","); // Field ClientPhysicalAddress
		$filterList = Concat($filterList, $this->ClientEmail->AdvancedSearch->toJson(), ","); // Field ClientEmail
		$filterList = Concat($filterList, $this->ChargeGroup->AdvancedSearch->toJson(), ","); // Field ChargeGroup
		$filterList = Concat($filterList, $this->ReceiptPrefix->AdvancedSearch->toJson(), ","); // Field ReceiptPrefix
		$filterList = Concat($filterList, $this->AccountBased->AdvancedSearch->toJson(), ","); // Field AccountBased
		$filterList = Concat($filterList, $this->Cashier->AdvancedSearch->toJson(), ","); // Field Cashier
		$filterList = Concat($filterList, $this->ReceiptDate->AdvancedSearch->toJson(), ","); // Field ReceiptDate
		$filterList = Concat($filterList, $this->PaymentMethod->AdvancedSearch->toJson(), ","); // Field PaymentMethod
		$filterList = Concat($filterList, $this->TotalDue->AdvancedSearch->toJson(), ","); // Field TotalDue
		$filterList = Concat($filterList, $this->AmountTendered->AdvancedSearch->toJson(), ","); // Field AmountTendered
		$filterList = Concat($filterList, $this->Change->AdvancedSearch->toJson(), ","); // Field Change
		$filterList = Concat($filterList, $this->ClientMessage->AdvancedSearch->toJson(), ","); // Field ClientMessage
		$filterList = Concat($filterList, $this->Reasons->AdvancedSearch->toJson(), ","); // Field Reasons
		$filterList = Concat($filterList, $this->ReversalRef->AdvancedSearch->toJson(), ","); // Field ReversalRef
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
			$UserProfile->setSearchFilters(CurrentUserName(), "freceipt_header_reverselistsrch", $filters);
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

		// Field ReceiptNo
		$this->ReceiptNo->AdvancedSearch->SearchValue = @$filter["x_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchOperator = @$filter["z_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchCondition = @$filter["v_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchValue2 = @$filter["y_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchOperator2 = @$filter["w_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->save();

		// Field ClientSerNo
		$this->ClientSerNo->AdvancedSearch->SearchValue = @$filter["x_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchOperator = @$filter["z_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchCondition = @$filter["v_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchValue2 = @$filter["y_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchOperator2 = @$filter["w_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->save();

		// Field ClientID
		$this->ClientID->AdvancedSearch->SearchValue = @$filter["x_ClientID"];
		$this->ClientID->AdvancedSearch->SearchOperator = @$filter["z_ClientID"];
		$this->ClientID->AdvancedSearch->SearchCondition = @$filter["v_ClientID"];
		$this->ClientID->AdvancedSearch->SearchValue2 = @$filter["y_ClientID"];
		$this->ClientID->AdvancedSearch->SearchOperator2 = @$filter["w_ClientID"];
		$this->ClientID->AdvancedSearch->save();

		// Field PaidBy
		$this->PaidBy->AdvancedSearch->SearchValue = @$filter["x_PaidBy"];
		$this->PaidBy->AdvancedSearch->SearchOperator = @$filter["z_PaidBy"];
		$this->PaidBy->AdvancedSearch->SearchCondition = @$filter["v_PaidBy"];
		$this->PaidBy->AdvancedSearch->SearchValue2 = @$filter["y_PaidBy"];
		$this->PaidBy->AdvancedSearch->SearchOperator2 = @$filter["w_PaidBy"];
		$this->PaidBy->AdvancedSearch->save();

		// Field ClientPostalAddress
		$this->ClientPostalAddress->AdvancedSearch->SearchValue = @$filter["x_ClientPostalAddress"];
		$this->ClientPostalAddress->AdvancedSearch->SearchOperator = @$filter["z_ClientPostalAddress"];
		$this->ClientPostalAddress->AdvancedSearch->SearchCondition = @$filter["v_ClientPostalAddress"];
		$this->ClientPostalAddress->AdvancedSearch->SearchValue2 = @$filter["y_ClientPostalAddress"];
		$this->ClientPostalAddress->AdvancedSearch->SearchOperator2 = @$filter["w_ClientPostalAddress"];
		$this->ClientPostalAddress->AdvancedSearch->save();

		// Field ClientPhysicalAddress
		$this->ClientPhysicalAddress->AdvancedSearch->SearchValue = @$filter["x_ClientPhysicalAddress"];
		$this->ClientPhysicalAddress->AdvancedSearch->SearchOperator = @$filter["z_ClientPhysicalAddress"];
		$this->ClientPhysicalAddress->AdvancedSearch->SearchCondition = @$filter["v_ClientPhysicalAddress"];
		$this->ClientPhysicalAddress->AdvancedSearch->SearchValue2 = @$filter["y_ClientPhysicalAddress"];
		$this->ClientPhysicalAddress->AdvancedSearch->SearchOperator2 = @$filter["w_ClientPhysicalAddress"];
		$this->ClientPhysicalAddress->AdvancedSearch->save();

		// Field ClientEmail
		$this->ClientEmail->AdvancedSearch->SearchValue = @$filter["x_ClientEmail"];
		$this->ClientEmail->AdvancedSearch->SearchOperator = @$filter["z_ClientEmail"];
		$this->ClientEmail->AdvancedSearch->SearchCondition = @$filter["v_ClientEmail"];
		$this->ClientEmail->AdvancedSearch->SearchValue2 = @$filter["y_ClientEmail"];
		$this->ClientEmail->AdvancedSearch->SearchOperator2 = @$filter["w_ClientEmail"];
		$this->ClientEmail->AdvancedSearch->save();

		// Field ChargeGroup
		$this->ChargeGroup->AdvancedSearch->SearchValue = @$filter["x_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchOperator = @$filter["z_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchCondition = @$filter["v_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchValue2 = @$filter["y_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->save();

		// Field ReceiptPrefix
		$this->ReceiptPrefix->AdvancedSearch->SearchValue = @$filter["x_ReceiptPrefix"];
		$this->ReceiptPrefix->AdvancedSearch->SearchOperator = @$filter["z_ReceiptPrefix"];
		$this->ReceiptPrefix->AdvancedSearch->SearchCondition = @$filter["v_ReceiptPrefix"];
		$this->ReceiptPrefix->AdvancedSearch->SearchValue2 = @$filter["y_ReceiptPrefix"];
		$this->ReceiptPrefix->AdvancedSearch->SearchOperator2 = @$filter["w_ReceiptPrefix"];
		$this->ReceiptPrefix->AdvancedSearch->save();

		// Field AccountBased
		$this->AccountBased->AdvancedSearch->SearchValue = @$filter["x_AccountBased"];
		$this->AccountBased->AdvancedSearch->SearchOperator = @$filter["z_AccountBased"];
		$this->AccountBased->AdvancedSearch->SearchCondition = @$filter["v_AccountBased"];
		$this->AccountBased->AdvancedSearch->SearchValue2 = @$filter["y_AccountBased"];
		$this->AccountBased->AdvancedSearch->SearchOperator2 = @$filter["w_AccountBased"];
		$this->AccountBased->AdvancedSearch->save();

		// Field Cashier
		$this->Cashier->AdvancedSearch->SearchValue = @$filter["x_Cashier"];
		$this->Cashier->AdvancedSearch->SearchOperator = @$filter["z_Cashier"];
		$this->Cashier->AdvancedSearch->SearchCondition = @$filter["v_Cashier"];
		$this->Cashier->AdvancedSearch->SearchValue2 = @$filter["y_Cashier"];
		$this->Cashier->AdvancedSearch->SearchOperator2 = @$filter["w_Cashier"];
		$this->Cashier->AdvancedSearch->save();

		// Field ReceiptDate
		$this->ReceiptDate->AdvancedSearch->SearchValue = @$filter["x_ReceiptDate"];
		$this->ReceiptDate->AdvancedSearch->SearchOperator = @$filter["z_ReceiptDate"];
		$this->ReceiptDate->AdvancedSearch->SearchCondition = @$filter["v_ReceiptDate"];
		$this->ReceiptDate->AdvancedSearch->SearchValue2 = @$filter["y_ReceiptDate"];
		$this->ReceiptDate->AdvancedSearch->SearchOperator2 = @$filter["w_ReceiptDate"];
		$this->ReceiptDate->AdvancedSearch->save();

		// Field PaymentMethod
		$this->PaymentMethod->AdvancedSearch->SearchValue = @$filter["x_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchOperator = @$filter["z_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchCondition = @$filter["v_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchValue2 = @$filter["y_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->SearchOperator2 = @$filter["w_PaymentMethod"];
		$this->PaymentMethod->AdvancedSearch->save();

		// Field TotalDue
		$this->TotalDue->AdvancedSearch->SearchValue = @$filter["x_TotalDue"];
		$this->TotalDue->AdvancedSearch->SearchOperator = @$filter["z_TotalDue"];
		$this->TotalDue->AdvancedSearch->SearchCondition = @$filter["v_TotalDue"];
		$this->TotalDue->AdvancedSearch->SearchValue2 = @$filter["y_TotalDue"];
		$this->TotalDue->AdvancedSearch->SearchOperator2 = @$filter["w_TotalDue"];
		$this->TotalDue->AdvancedSearch->save();

		// Field AmountTendered
		$this->AmountTendered->AdvancedSearch->SearchValue = @$filter["x_AmountTendered"];
		$this->AmountTendered->AdvancedSearch->SearchOperator = @$filter["z_AmountTendered"];
		$this->AmountTendered->AdvancedSearch->SearchCondition = @$filter["v_AmountTendered"];
		$this->AmountTendered->AdvancedSearch->SearchValue2 = @$filter["y_AmountTendered"];
		$this->AmountTendered->AdvancedSearch->SearchOperator2 = @$filter["w_AmountTendered"];
		$this->AmountTendered->AdvancedSearch->save();

		// Field Change
		$this->Change->AdvancedSearch->SearchValue = @$filter["x_Change"];
		$this->Change->AdvancedSearch->SearchOperator = @$filter["z_Change"];
		$this->Change->AdvancedSearch->SearchCondition = @$filter["v_Change"];
		$this->Change->AdvancedSearch->SearchValue2 = @$filter["y_Change"];
		$this->Change->AdvancedSearch->SearchOperator2 = @$filter["w_Change"];
		$this->Change->AdvancedSearch->save();

		// Field ClientMessage
		$this->ClientMessage->AdvancedSearch->SearchValue = @$filter["x_ClientMessage"];
		$this->ClientMessage->AdvancedSearch->SearchOperator = @$filter["z_ClientMessage"];
		$this->ClientMessage->AdvancedSearch->SearchCondition = @$filter["v_ClientMessage"];
		$this->ClientMessage->AdvancedSearch->SearchValue2 = @$filter["y_ClientMessage"];
		$this->ClientMessage->AdvancedSearch->SearchOperator2 = @$filter["w_ClientMessage"];
		$this->ClientMessage->AdvancedSearch->save();

		// Field Reasons
		$this->Reasons->AdvancedSearch->SearchValue = @$filter["x_Reasons"];
		$this->Reasons->AdvancedSearch->SearchOperator = @$filter["z_Reasons"];
		$this->Reasons->AdvancedSearch->SearchCondition = @$filter["v_Reasons"];
		$this->Reasons->AdvancedSearch->SearchValue2 = @$filter["y_Reasons"];
		$this->Reasons->AdvancedSearch->SearchOperator2 = @$filter["w_Reasons"];
		$this->Reasons->AdvancedSearch->save();

		// Field ReversalRef
		$this->ReversalRef->AdvancedSearch->SearchValue = @$filter["x_ReversalRef"];
		$this->ReversalRef->AdvancedSearch->SearchOperator = @$filter["z_ReversalRef"];
		$this->ReversalRef->AdvancedSearch->SearchCondition = @$filter["v_ReversalRef"];
		$this->ReversalRef->AdvancedSearch->SearchValue2 = @$filter["y_ReversalRef"];
		$this->ReversalRef->AdvancedSearch->SearchOperator2 = @$filter["w_ReversalRef"];
		$this->ReversalRef->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->ReceiptNo, $default, FALSE); // ReceiptNo
		$this->buildSearchSql($where, $this->ClientSerNo, $default, FALSE); // ClientSerNo
		$this->buildSearchSql($where, $this->ClientID, $default, FALSE); // ClientID
		$this->buildSearchSql($where, $this->PaidBy, $default, FALSE); // PaidBy
		$this->buildSearchSql($where, $this->ClientPostalAddress, $default, FALSE); // ClientPostalAddress
		$this->buildSearchSql($where, $this->ClientPhysicalAddress, $default, FALSE); // ClientPhysicalAddress
		$this->buildSearchSql($where, $this->ClientEmail, $default, FALSE); // ClientEmail
		$this->buildSearchSql($where, $this->ChargeGroup, $default, FALSE); // ChargeGroup
		$this->buildSearchSql($where, $this->ReceiptPrefix, $default, FALSE); // ReceiptPrefix
		$this->buildSearchSql($where, $this->AccountBased, $default, FALSE); // AccountBased
		$this->buildSearchSql($where, $this->Cashier, $default, FALSE); // Cashier
		$this->buildSearchSql($where, $this->ReceiptDate, $default, FALSE); // ReceiptDate
		$this->buildSearchSql($where, $this->PaymentMethod, $default, FALSE); // PaymentMethod
		$this->buildSearchSql($where, $this->TotalDue, $default, FALSE); // TotalDue
		$this->buildSearchSql($where, $this->AmountTendered, $default, FALSE); // AmountTendered
		$this->buildSearchSql($where, $this->Change, $default, FALSE); // Change
		$this->buildSearchSql($where, $this->ClientMessage, $default, FALSE); // ClientMessage
		$this->buildSearchSql($where, $this->Reasons, $default, FALSE); // Reasons
		$this->buildSearchSql($where, $this->ReversalRef, $default, FALSE); // ReversalRef

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->ReceiptNo->AdvancedSearch->save(); // ReceiptNo
			$this->ClientSerNo->AdvancedSearch->save(); // ClientSerNo
			$this->ClientID->AdvancedSearch->save(); // ClientID
			$this->PaidBy->AdvancedSearch->save(); // PaidBy
			$this->ClientPostalAddress->AdvancedSearch->save(); // ClientPostalAddress
			$this->ClientPhysicalAddress->AdvancedSearch->save(); // ClientPhysicalAddress
			$this->ClientEmail->AdvancedSearch->save(); // ClientEmail
			$this->ChargeGroup->AdvancedSearch->save(); // ChargeGroup
			$this->ReceiptPrefix->AdvancedSearch->save(); // ReceiptPrefix
			$this->AccountBased->AdvancedSearch->save(); // AccountBased
			$this->Cashier->AdvancedSearch->save(); // Cashier
			$this->ReceiptDate->AdvancedSearch->save(); // ReceiptDate
			$this->PaymentMethod->AdvancedSearch->save(); // PaymentMethod
			$this->TotalDue->AdvancedSearch->save(); // TotalDue
			$this->AmountTendered->AdvancedSearch->save(); // AmountTendered
			$this->Change->AdvancedSearch->save(); // Change
			$this->ClientMessage->AdvancedSearch->save(); // ClientMessage
			$this->Reasons->AdvancedSearch->save(); // Reasons
			$this->ReversalRef->AdvancedSearch->save(); // ReversalRef
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
		$this->buildBasicSearchSql($where, $this->ClientID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PaidBy, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ClientPostalAddress, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ClientPhysicalAddress, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ClientEmail, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ChargeGroup, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ReceiptPrefix, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Cashier, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PaymentMethod, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ClientMessage, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Reasons, $arKeywords, $type);
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
		if ($this->ReceiptNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientSerNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PaidBy->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientPostalAddress->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientPhysicalAddress->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientEmail->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ChargeGroup->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReceiptPrefix->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AccountBased->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Cashier->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReceiptDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PaymentMethod->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TotalDue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AmountTendered->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Change->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientMessage->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Reasons->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReversalRef->AdvancedSearch->issetSession())
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
		$this->ReceiptNo->AdvancedSearch->unsetSession();
		$this->ClientSerNo->AdvancedSearch->unsetSession();
		$this->ClientID->AdvancedSearch->unsetSession();
		$this->PaidBy->AdvancedSearch->unsetSession();
		$this->ClientPostalAddress->AdvancedSearch->unsetSession();
		$this->ClientPhysicalAddress->AdvancedSearch->unsetSession();
		$this->ClientEmail->AdvancedSearch->unsetSession();
		$this->ChargeGroup->AdvancedSearch->unsetSession();
		$this->ReceiptPrefix->AdvancedSearch->unsetSession();
		$this->AccountBased->AdvancedSearch->unsetSession();
		$this->Cashier->AdvancedSearch->unsetSession();
		$this->ReceiptDate->AdvancedSearch->unsetSession();
		$this->PaymentMethod->AdvancedSearch->unsetSession();
		$this->TotalDue->AdvancedSearch->unsetSession();
		$this->AmountTendered->AdvancedSearch->unsetSession();
		$this->Change->AdvancedSearch->unsetSession();
		$this->ClientMessage->AdvancedSearch->unsetSession();
		$this->Reasons->AdvancedSearch->unsetSession();
		$this->ReversalRef->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->ReceiptNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PaidBy->AdvancedSearch->load();
		$this->ClientPostalAddress->AdvancedSearch->load();
		$this->ClientPhysicalAddress->AdvancedSearch->load();
		$this->ClientEmail->AdvancedSearch->load();
		$this->ChargeGroup->AdvancedSearch->load();
		$this->ReceiptPrefix->AdvancedSearch->load();
		$this->AccountBased->AdvancedSearch->load();
		$this->Cashier->AdvancedSearch->load();
		$this->ReceiptDate->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->TotalDue->AdvancedSearch->load();
		$this->AmountTendered->AdvancedSearch->load();
		$this->Change->AdvancedSearch->load();
		$this->ClientMessage->AdvancedSearch->load();
		$this->Reasons->AdvancedSearch->load();
		$this->ReversalRef->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->ReceiptNo); // ReceiptNo
			$this->updateSort($this->ClientSerNo); // ClientSerNo
			$this->updateSort($this->ClientID); // ClientID
			$this->updateSort($this->PaidBy); // PaidBy
			$this->updateSort($this->ClientPostalAddress); // ClientPostalAddress
			$this->updateSort($this->ClientPhysicalAddress); // ClientPhysicalAddress
			$this->updateSort($this->ClientEmail); // ClientEmail
			$this->updateSort($this->ChargeGroup); // ChargeGroup
			$this->updateSort($this->ReceiptPrefix); // ReceiptPrefix
			$this->updateSort($this->AccountBased); // AccountBased
			$this->updateSort($this->Cashier); // Cashier
			$this->updateSort($this->ReceiptDate); // ReceiptDate
			$this->updateSort($this->PaymentMethod); // PaymentMethod
			$this->updateSort($this->TotalDue); // TotalDue
			$this->updateSort($this->AmountTendered); // AmountTendered
			$this->updateSort($this->Change); // Change
			$this->updateSort($this->ClientMessage); // ClientMessage
			$this->updateSort($this->ReversalRef); // ReversalRef
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
				$this->ReceiptNo->setSort("");
				$this->ClientSerNo->setSort("");
				$this->ClientID->setSort("");
				$this->PaidBy->setSort("");
				$this->ClientPostalAddress->setSort("");
				$this->ClientPhysicalAddress->setSort("");
				$this->ClientEmail->setSort("");
				$this->ChargeGroup->setSort("");
				$this->ReceiptPrefix->setSort("");
				$this->AccountBased->setSort("");
				$this->Cashier->setSort("");
				$this->ReceiptDate->setSort("");
				$this->PaymentMethod->setSort("");
				$this->TotalDue->setSort("");
				$this->AmountTendered->setSort("");
				$this->Change->setSort("");
				$this->ClientMessage->setSort("");
				$this->ReversalRef->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ReversalRef->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"freceipt_header_reverselistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"freceipt_header_reverselistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.freceipt_header_reverselist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// ReceiptNo
		if (!$this->isAddOrEdit() && $this->ReceiptNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReceiptNo->AdvancedSearch->SearchValue != "" || $this->ReceiptNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientSerNo
		if (!$this->isAddOrEdit() && $this->ClientSerNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientSerNo->AdvancedSearch->SearchValue != "" || $this->ClientSerNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientID
		if (!$this->isAddOrEdit() && $this->ClientID->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientID->AdvancedSearch->SearchValue != "" || $this->ClientID->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PaidBy
		if (!$this->isAddOrEdit() && $this->PaidBy->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PaidBy->AdvancedSearch->SearchValue != "" || $this->PaidBy->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientPostalAddress
		if (!$this->isAddOrEdit() && $this->ClientPostalAddress->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientPostalAddress->AdvancedSearch->SearchValue != "" || $this->ClientPostalAddress->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientPhysicalAddress
		if (!$this->isAddOrEdit() && $this->ClientPhysicalAddress->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientPhysicalAddress->AdvancedSearch->SearchValue != "" || $this->ClientPhysicalAddress->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientEmail
		if (!$this->isAddOrEdit() && $this->ClientEmail->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientEmail->AdvancedSearch->SearchValue != "" || $this->ClientEmail->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ChargeGroup
		if (!$this->isAddOrEdit() && $this->ChargeGroup->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ChargeGroup->AdvancedSearch->SearchValue != "" || $this->ChargeGroup->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReceiptPrefix
		if (!$this->isAddOrEdit() && $this->ReceiptPrefix->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReceiptPrefix->AdvancedSearch->SearchValue != "" || $this->ReceiptPrefix->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AccountBased
		if (!$this->isAddOrEdit() && $this->AccountBased->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AccountBased->AdvancedSearch->SearchValue != "" || $this->AccountBased->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->AccountBased->AdvancedSearch->SearchValue))
			$this->AccountBased->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AccountBased->AdvancedSearch->SearchValue);
		if (is_array($this->AccountBased->AdvancedSearch->SearchValue2))
			$this->AccountBased->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AccountBased->AdvancedSearch->SearchValue2);

		// Cashier
		if (!$this->isAddOrEdit() && $this->Cashier->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Cashier->AdvancedSearch->SearchValue != "" || $this->Cashier->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReceiptDate
		if (!$this->isAddOrEdit() && $this->ReceiptDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReceiptDate->AdvancedSearch->SearchValue != "" || $this->ReceiptDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PaymentMethod
		if (!$this->isAddOrEdit() && $this->PaymentMethod->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PaymentMethod->AdvancedSearch->SearchValue != "" || $this->PaymentMethod->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TotalDue
		if (!$this->isAddOrEdit() && $this->TotalDue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TotalDue->AdvancedSearch->SearchValue != "" || $this->TotalDue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AmountTendered
		if (!$this->isAddOrEdit() && $this->AmountTendered->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AmountTendered->AdvancedSearch->SearchValue != "" || $this->AmountTendered->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Change
		if (!$this->isAddOrEdit() && $this->Change->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Change->AdvancedSearch->SearchValue != "" || $this->Change->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientMessage
		if (!$this->isAddOrEdit() && $this->ClientMessage->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientMessage->AdvancedSearch->SearchValue != "" || $this->ClientMessage->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Reasons
		if (!$this->isAddOrEdit() && $this->Reasons->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Reasons->AdvancedSearch->SearchValue != "" || $this->Reasons->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReversalRef
		if (!$this->isAddOrEdit() && $this->ReversalRef->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReversalRef->AdvancedSearch->SearchValue != "" || $this->ReversalRef->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->ReceiptNo->setDbValue($row['ReceiptNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PaidBy->setDbValue($row['PaidBy']);
		$this->ClientPostalAddress->setDbValue($row['ClientPostalAddress']);
		$this->ClientPhysicalAddress->setDbValue($row['ClientPhysicalAddress']);
		$this->ClientEmail->setDbValue($row['ClientEmail']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->ReceiptPrefix->setDbValue($row['ReceiptPrefix']);
		$this->AccountBased->setDbValue($row['AccountBased']);
		$this->Cashier->setDbValue($row['Cashier']);
		$this->ReceiptDate->setDbValue($row['ReceiptDate']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->TotalDue->setDbValue($row['TotalDue']);
		$this->AmountTendered->setDbValue($row['AmountTendered']);
		$this->Change->setDbValue($row['Change']);
		$this->ClientMessage->setDbValue($row['ClientMessage']);
		$this->Reasons->setDbValue($row['Reasons']);
		$this->ReversalRef->setDbValue($row['ReversalRef']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ReceiptNo'] = NULL;
		$row['ClientSerNo'] = NULL;
		$row['ClientID'] = NULL;
		$row['PaidBy'] = NULL;
		$row['ClientPostalAddress'] = NULL;
		$row['ClientPhysicalAddress'] = NULL;
		$row['ClientEmail'] = NULL;
		$row['ChargeGroup'] = NULL;
		$row['ReceiptPrefix'] = NULL;
		$row['AccountBased'] = NULL;
		$row['Cashier'] = NULL;
		$row['ReceiptDate'] = NULL;
		$row['PaymentMethod'] = NULL;
		$row['TotalDue'] = NULL;
		$row['AmountTendered'] = NULL;
		$row['Change'] = NULL;
		$row['ClientMessage'] = NULL;
		$row['Reasons'] = NULL;
		$row['ReversalRef'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ReversalRef")) != "")
			$this->ReversalRef->OldValue = $this->getKey("ReversalRef"); // ReversalRef
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
		if ($this->TotalDue->FormValue == $this->TotalDue->CurrentValue && is_numeric(ConvertToFloatString($this->TotalDue->CurrentValue)))
			$this->TotalDue->CurrentValue = ConvertToFloatString($this->TotalDue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountTendered->FormValue == $this->AmountTendered->CurrentValue && is_numeric(ConvertToFloatString($this->AmountTendered->CurrentValue)))
			$this->AmountTendered->CurrentValue = ConvertToFloatString($this->AmountTendered->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Change->FormValue == $this->Change->CurrentValue && is_numeric(ConvertToFloatString($this->Change->CurrentValue)))
			$this->Change->CurrentValue = ConvertToFloatString($this->Change->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ReceiptNo
		// ClientSerNo
		// ClientID
		// PaidBy
		// ClientPostalAddress
		// ClientPhysicalAddress
		// ClientEmail
		// ChargeGroup
		// ReceiptPrefix
		// AccountBased
		// Cashier
		// ReceiptDate
		// PaymentMethod
		// TotalDue
		// AmountTendered
		// Change
		// ClientMessage
		// Reasons
		// ReversalRef

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$curVal = strval($this->ReceiptNo->CurrentValue);
			if ($curVal != "") {
				$this->ReceiptNo->ViewValue = $this->ReceiptNo->lookupCacheOption($curVal);
				if ($this->ReceiptNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ReceiptNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReceiptNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 7);
						$arwrk[3] = $rswrk->fields('df3');
						$this->ReceiptNo->ViewValue = $this->ReceiptNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
					}
				}
			} else {
				$this->ReceiptNo->ViewValue = NULL;
			}
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

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// PaidBy
			$this->PaidBy->ViewValue = $this->PaidBy->CurrentValue;
			$this->PaidBy->ViewCustomAttributes = "";

			// ClientPostalAddress
			$this->ClientPostalAddress->ViewValue = $this->ClientPostalAddress->CurrentValue;
			$this->ClientPostalAddress->ViewCustomAttributes = "";

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->ViewValue = $this->ClientPhysicalAddress->CurrentValue;
			$this->ClientPhysicalAddress->ViewCustomAttributes = "";

			// ClientEmail
			$this->ClientEmail->ViewValue = $this->ClientEmail->CurrentValue;
			$this->ClientEmail->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ReceiptPrefix
			$this->ReceiptPrefix->ViewValue = $this->ReceiptPrefix->CurrentValue;
			$this->ReceiptPrefix->ViewCustomAttributes = "";

			// AccountBased
			if (ConvertToBool($this->AccountBased->CurrentValue)) {
				$this->AccountBased->ViewValue = $this->AccountBased->tagCaption(1) != "" ? $this->AccountBased->tagCaption(1) : "Yes";
			} else {
				$this->AccountBased->ViewValue = $this->AccountBased->tagCaption(2) != "" ? $this->AccountBased->tagCaption(2) : "No";
			}
			$this->AccountBased->ViewCustomAttributes = "";

			// Cashier
			$this->Cashier->ViewValue = $this->Cashier->CurrentValue;
			$this->Cashier->ViewCustomAttributes = "";

			// ReceiptDate
			$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
			$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 0);
			$this->ReceiptDate->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
			$this->PaymentMethod->ViewCustomAttributes = "";

			// TotalDue
			$this->TotalDue->ViewValue = $this->TotalDue->CurrentValue;
			$this->TotalDue->ViewValue = FormatNumber($this->TotalDue->ViewValue, 2, -2, -2, -2);
			$this->TotalDue->ViewCustomAttributes = "";

			// AmountTendered
			$this->AmountTendered->ViewValue = $this->AmountTendered->CurrentValue;
			$this->AmountTendered->ViewValue = FormatNumber($this->AmountTendered->ViewValue, 2, -2, -2, -2);
			$this->AmountTendered->ViewCustomAttributes = "";

			// Change
			$this->Change->ViewValue = $this->Change->CurrentValue;
			$this->Change->ViewValue = FormatNumber($this->Change->ViewValue, 2, -2, -2, -2);
			$this->Change->ViewCustomAttributes = "";

			// ClientMessage
			$this->ClientMessage->ViewValue = $this->ClientMessage->CurrentValue;
			$this->ClientMessage->ViewCustomAttributes = "";

			// ReversalRef
			$this->ReversalRef->ViewValue = $this->ReversalRef->CurrentValue;
			$this->ReversalRef->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientID->ViewValue = $this->highlightValue($this->ClientID);

			// PaidBy
			$this->PaidBy->LinkCustomAttributes = "";
			$this->PaidBy->HrefValue = "";
			$this->PaidBy->TooltipValue = "";
			if (!$this->isExport())
				$this->PaidBy->ViewValue = $this->highlightValue($this->PaidBy);

			// ClientPostalAddress
			$this->ClientPostalAddress->LinkCustomAttributes = "";
			$this->ClientPostalAddress->HrefValue = "";
			$this->ClientPostalAddress->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientPostalAddress->ViewValue = $this->highlightValue($this->ClientPostalAddress);

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->LinkCustomAttributes = "";
			$this->ClientPhysicalAddress->HrefValue = "";
			$this->ClientPhysicalAddress->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientPhysicalAddress->ViewValue = $this->highlightValue($this->ClientPhysicalAddress);

			// ClientEmail
			$this->ClientEmail->LinkCustomAttributes = "";
			$this->ClientEmail->HrefValue = "";
			$this->ClientEmail->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientEmail->ViewValue = $this->highlightValue($this->ClientEmail);

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";
			if (!$this->isExport())
				$this->ChargeGroup->ViewValue = $this->highlightValue($this->ChargeGroup);

			// ReceiptPrefix
			$this->ReceiptPrefix->LinkCustomAttributes = "";
			$this->ReceiptPrefix->HrefValue = "";
			$this->ReceiptPrefix->TooltipValue = "";
			if (!$this->isExport())
				$this->ReceiptPrefix->ViewValue = $this->highlightValue($this->ReceiptPrefix);

			// AccountBased
			$this->AccountBased->LinkCustomAttributes = "";
			$this->AccountBased->HrefValue = "";
			$this->AccountBased->TooltipValue = "";

			// Cashier
			$this->Cashier->LinkCustomAttributes = "";
			$this->Cashier->HrefValue = "";
			$this->Cashier->TooltipValue = "";
			if (!$this->isExport())
				$this->Cashier->ViewValue = $this->highlightValue($this->Cashier);

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";
			if (!$this->isExport())
				$this->PaymentMethod->ViewValue = $this->highlightValue($this->PaymentMethod);

			// TotalDue
			$this->TotalDue->LinkCustomAttributes = "";
			$this->TotalDue->HrefValue = "";
			$this->TotalDue->TooltipValue = "";

			// AmountTendered
			$this->AmountTendered->LinkCustomAttributes = "";
			$this->AmountTendered->HrefValue = "";
			$this->AmountTendered->TooltipValue = "";

			// Change
			$this->Change->LinkCustomAttributes = "";
			$this->Change->HrefValue = "";
			$this->Change->TooltipValue = "";

			// ClientMessage
			$this->ClientMessage->LinkCustomAttributes = "";
			$this->ClientMessage->HrefValue = "";
			$this->ClientMessage->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientMessage->ViewValue = $this->highlightValue($this->ClientMessage);

			// ReversalRef
			$this->ReversalRef->LinkCustomAttributes = "";
			$this->ReversalRef->HrefValue = "";
			$this->ReversalRef->TooltipValue = "";
			if (!$this->isExport())
				$this->ReversalRef->ViewValue = $this->highlightValue($this->ReversalRef);
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->AdvancedSearch->SearchValue);
			$curVal = strval($this->ReceiptNo->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ReceiptNo->EditValue = $this->ReceiptNo->lookupCacheOption($curVal);
				if ($this->ReceiptNo->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ReceiptNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReceiptNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode(FormatDateTime($rswrk->fields('df2'), 7));
						$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
						$this->ReceiptNo->EditValue = $this->ReceiptNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ReceiptNo->EditValue = NULL;
			}
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";
			$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->AdvancedSearch->SearchValue);
			$curVal = strval($this->ClientSerNo->AdvancedSearch->SearchValue);
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
						$this->ClientSerNo->EditValue = HtmlEncode($this->ClientSerNo->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ClientSerNo->EditValue = NULL;
			}
			$this->ClientSerNo->PlaceHolder = RemoveHtml($this->ClientSerNo->caption());

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->AdvancedSearch->SearchValue = HtmlDecode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// PaidBy
			$this->PaidBy->EditAttrs["class"] = "form-control";
			$this->PaidBy->EditCustomAttributes = "";
			if (!$this->PaidBy->Raw)
				$this->PaidBy->AdvancedSearch->SearchValue = HtmlDecode($this->PaidBy->AdvancedSearch->SearchValue);
			$this->PaidBy->EditValue = HtmlEncode($this->PaidBy->AdvancedSearch->SearchValue);
			$this->PaidBy->PlaceHolder = RemoveHtml($this->PaidBy->caption());

			// ClientPostalAddress
			$this->ClientPostalAddress->EditAttrs["class"] = "form-control";
			$this->ClientPostalAddress->EditCustomAttributes = "";
			if (!$this->ClientPostalAddress->Raw)
				$this->ClientPostalAddress->AdvancedSearch->SearchValue = HtmlDecode($this->ClientPostalAddress->AdvancedSearch->SearchValue);
			$this->ClientPostalAddress->EditValue = HtmlEncode($this->ClientPostalAddress->AdvancedSearch->SearchValue);
			$this->ClientPostalAddress->PlaceHolder = RemoveHtml($this->ClientPostalAddress->caption());

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->EditAttrs["class"] = "form-control";
			$this->ClientPhysicalAddress->EditCustomAttributes = "";
			if (!$this->ClientPhysicalAddress->Raw)
				$this->ClientPhysicalAddress->AdvancedSearch->SearchValue = HtmlDecode($this->ClientPhysicalAddress->AdvancedSearch->SearchValue);
			$this->ClientPhysicalAddress->EditValue = HtmlEncode($this->ClientPhysicalAddress->AdvancedSearch->SearchValue);
			$this->ClientPhysicalAddress->PlaceHolder = RemoveHtml($this->ClientPhysicalAddress->caption());

			// ClientEmail
			$this->ClientEmail->EditAttrs["class"] = "form-control";
			$this->ClientEmail->EditCustomAttributes = "";
			if (!$this->ClientEmail->Raw)
				$this->ClientEmail->AdvancedSearch->SearchValue = HtmlDecode($this->ClientEmail->AdvancedSearch->SearchValue);
			$this->ClientEmail->EditValue = HtmlEncode($this->ClientEmail->AdvancedSearch->SearchValue);
			$this->ClientEmail->PlaceHolder = RemoveHtml($this->ClientEmail->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if (!$this->ChargeGroup->Raw)
				$this->ChargeGroup->AdvancedSearch->SearchValue = HtmlDecode($this->ChargeGroup->AdvancedSearch->SearchValue);
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->AdvancedSearch->SearchValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// ReceiptPrefix
			$this->ReceiptPrefix->EditAttrs["class"] = "form-control";
			$this->ReceiptPrefix->EditCustomAttributes = "";
			if (!$this->ReceiptPrefix->Raw)
				$this->ReceiptPrefix->AdvancedSearch->SearchValue = HtmlDecode($this->ReceiptPrefix->AdvancedSearch->SearchValue);
			$this->ReceiptPrefix->EditValue = HtmlEncode($this->ReceiptPrefix->AdvancedSearch->SearchValue);
			$this->ReceiptPrefix->PlaceHolder = RemoveHtml($this->ReceiptPrefix->caption());

			// AccountBased
			$this->AccountBased->EditCustomAttributes = "";
			$this->AccountBased->EditValue = $this->AccountBased->options(FALSE);

			// Cashier
			$this->Cashier->EditAttrs["class"] = "form-control";
			$this->Cashier->EditCustomAttributes = "";
			if (!$this->Cashier->Raw)
				$this->Cashier->AdvancedSearch->SearchValue = HtmlDecode($this->Cashier->AdvancedSearch->SearchValue);
			$this->Cashier->EditValue = HtmlEncode($this->Cashier->AdvancedSearch->SearchValue);
			$this->Cashier->PlaceHolder = RemoveHtml($this->Cashier->caption());

			// ReceiptDate
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ReceiptDate->AdvancedSearch->SearchValue, 0), 8));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->AdvancedSearch->SearchValue = HtmlDecode($this->PaymentMethod->AdvancedSearch->SearchValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->AdvancedSearch->SearchValue);
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// TotalDue
			$this->TotalDue->EditAttrs["class"] = "form-control";
			$this->TotalDue->EditCustomAttributes = "";
			$this->TotalDue->EditValue = HtmlEncode($this->TotalDue->AdvancedSearch->SearchValue);
			$this->TotalDue->PlaceHolder = RemoveHtml($this->TotalDue->caption());

			// AmountTendered
			$this->AmountTendered->EditAttrs["class"] = "form-control";
			$this->AmountTendered->EditCustomAttributes = "";
			$this->AmountTendered->EditValue = HtmlEncode($this->AmountTendered->AdvancedSearch->SearchValue);
			$this->AmountTendered->PlaceHolder = RemoveHtml($this->AmountTendered->caption());

			// Change
			$this->Change->EditAttrs["class"] = "form-control";
			$this->Change->EditCustomAttributes = "";
			$this->Change->EditValue = HtmlEncode($this->Change->AdvancedSearch->SearchValue);
			$this->Change->PlaceHolder = RemoveHtml($this->Change->caption());

			// ClientMessage
			$this->ClientMessage->EditAttrs["class"] = "form-control";
			$this->ClientMessage->EditCustomAttributes = "";
			if (!$this->ClientMessage->Raw)
				$this->ClientMessage->AdvancedSearch->SearchValue = HtmlDecode($this->ClientMessage->AdvancedSearch->SearchValue);
			$this->ClientMessage->EditValue = HtmlEncode($this->ClientMessage->AdvancedSearch->SearchValue);
			$this->ClientMessage->PlaceHolder = RemoveHtml($this->ClientMessage->caption());

			// ReversalRef
			$this->ReversalRef->EditAttrs["class"] = "form-control";
			$this->ReversalRef->EditCustomAttributes = "";
			$this->ReversalRef->EditValue = HtmlEncode($this->ReversalRef->AdvancedSearch->SearchValue);
			$this->ReversalRef->PlaceHolder = RemoveHtml($this->ReversalRef->caption());
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
		if (!CheckInteger($this->ReceiptNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReceiptNo->errorMessage());
		}
		if (!CheckInteger($this->ClientSerNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ClientSerNo->errorMessage());
		}

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
		$this->ReceiptNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PaidBy->AdvancedSearch->load();
		$this->ClientPostalAddress->AdvancedSearch->load();
		$this->ClientPhysicalAddress->AdvancedSearch->load();
		$this->ClientEmail->AdvancedSearch->load();
		$this->ChargeGroup->AdvancedSearch->load();
		$this->ReceiptPrefix->AdvancedSearch->load();
		$this->AccountBased->AdvancedSearch->load();
		$this->Cashier->AdvancedSearch->load();
		$this->ReceiptDate->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->TotalDue->AdvancedSearch->load();
		$this->AmountTendered->AdvancedSearch->load();
		$this->Change->AdvancedSearch->load();
		$this->ClientMessage->AdvancedSearch->load();
		$this->Reasons->AdvancedSearch->load();
		$this->ReversalRef->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.freceipt_header_reverselist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.freceipt_header_reverselist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.freceipt_header_reverselist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_receipt_header_reverse" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_receipt_header_reverse\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.freceipt_header_reverselist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"freceipt_header_reverselistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"receipt_header_reversesrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"receipt_header_reverse\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'receipt_header_reversesrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"freceipt_header_reverselistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
				case "x_ReceiptNo":
					break;
				case "x_ClientSerNo":
					break;
				case "x_AccountBased":
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
						case "x_ReceiptNo":
							$row[2] = FormatDateTime($row[2], 7);
							$row['df2'] = $row[2];
							break;
						case "x_ClientSerNo":
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