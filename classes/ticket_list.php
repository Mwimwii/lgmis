<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ticket_list extends ticket
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ticket';

	// Page object name
	public $PageObjName = "ticket_list";

	// Grid form hidden field names
	public $FormName = "fticketlist";
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

		// Table object (ticket)
		if (!isset($GLOBALS["ticket"]) || get_class($GLOBALS["ticket"]) == PROJECT_NAMESPACE . "ticket") {
			$GLOBALS["ticket"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ticket"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "ticketadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "ticketdelete.php";
		$this->MultiUpdateUrl = "ticketupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ticket');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fticketlistsrch";

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
		global $ticket;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ticket);
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
			$key .= @$ar['TicketNumber'];
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
			$this->TicketNumber->Visible = FALSE;
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
		$this->Subject->setVisibility();
		$this->TicketReportDate->setVisibility();
		$this->IncidentDate->setVisibility();
		$this->IncidentTime->setVisibility();
		$this->TicketDescription->Visible = FALSE;
		$this->TicketCategory->setVisibility();
		$this->TicketType->setVisibility();
		$this->ReportedBy->setVisibility();
		$this->TicketStatus->setVisibility();
		$this->TicketNumber->setVisibility();
		$this->ReporterEmail->setVisibility();
		$this->ReporterMobile->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->DeptSection->setVisibility();
		$this->TicketLevel->setVisibility();
		$this->AllocatedTo->setVisibility();
		$this->EscalatedTo->setVisibility();
		$this->TicketSolution->setVisibility();
		$this->Evidence->Visible = FALSE;
		$this->SeverityLevel->setVisibility();
		$this->Days->setVisibility();
		$this->DataLastUpdated->setVisibility();
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
		$this->setupLookupOptions($this->TicketCategory);
		$this->setupLookupOptions($this->TicketType);
		$this->setupLookupOptions($this->ReportedBy);
		$this->setupLookupOptions($this->TicketStatus);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->AllocatedTo);
		$this->setupLookupOptions($this->EscalatedTo);
		$this->setupLookupOptions($this->SeverityLevel);

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
			$this->TicketNumber->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->TicketNumber->OldValue))
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fticketlistsrch");
		$filterList = Concat($filterList, $this->Subject->AdvancedSearch->toJson(), ","); // Field Subject
		$filterList = Concat($filterList, $this->TicketReportDate->AdvancedSearch->toJson(), ","); // Field TicketReportDate
		$filterList = Concat($filterList, $this->IncidentDate->AdvancedSearch->toJson(), ","); // Field IncidentDate
		$filterList = Concat($filterList, $this->IncidentTime->AdvancedSearch->toJson(), ","); // Field IncidentTime
		$filterList = Concat($filterList, $this->TicketDescription->AdvancedSearch->toJson(), ","); // Field TicketDescription
		$filterList = Concat($filterList, $this->TicketCategory->AdvancedSearch->toJson(), ","); // Field TicketCategory
		$filterList = Concat($filterList, $this->TicketType->AdvancedSearch->toJson(), ","); // Field TicketType
		$filterList = Concat($filterList, $this->ReportedBy->AdvancedSearch->toJson(), ","); // Field ReportedBy
		$filterList = Concat($filterList, $this->TicketStatus->AdvancedSearch->toJson(), ","); // Field TicketStatus
		$filterList = Concat($filterList, $this->TicketNumber->AdvancedSearch->toJson(), ","); // Field TicketNumber
		$filterList = Concat($filterList, $this->ReporterEmail->AdvancedSearch->toJson(), ","); // Field ReporterEmail
		$filterList = Concat($filterList, $this->ReporterMobile->AdvancedSearch->toJson(), ","); // Field ReporterMobile
		$filterList = Concat($filterList, $this->ProvinceCode->AdvancedSearch->toJson(), ","); // Field ProvinceCode
		$filterList = Concat($filterList, $this->LACode->AdvancedSearch->toJson(), ","); // Field LACode
		$filterList = Concat($filterList, $this->DepartmentCode->AdvancedSearch->toJson(), ","); // Field DepartmentCode
		$filterList = Concat($filterList, $this->DeptSection->AdvancedSearch->toJson(), ","); // Field DeptSection
		$filterList = Concat($filterList, $this->TicketLevel->AdvancedSearch->toJson(), ","); // Field TicketLevel
		$filterList = Concat($filterList, $this->AllocatedTo->AdvancedSearch->toJson(), ","); // Field AllocatedTo
		$filterList = Concat($filterList, $this->EscalatedTo->AdvancedSearch->toJson(), ","); // Field EscalatedTo
		$filterList = Concat($filterList, $this->TicketSolution->AdvancedSearch->toJson(), ","); // Field TicketSolution
		$filterList = Concat($filterList, $this->SeverityLevel->AdvancedSearch->toJson(), ","); // Field SeverityLevel
		$filterList = Concat($filterList, $this->Days->AdvancedSearch->toJson(), ","); // Field Days
		$filterList = Concat($filterList, $this->DataLastUpdated->AdvancedSearch->toJson(), ","); // Field DataLastUpdated
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fticketlistsrch", $filters);
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

		// Field Subject
		$this->Subject->AdvancedSearch->SearchValue = @$filter["x_Subject"];
		$this->Subject->AdvancedSearch->SearchOperator = @$filter["z_Subject"];
		$this->Subject->AdvancedSearch->SearchCondition = @$filter["v_Subject"];
		$this->Subject->AdvancedSearch->SearchValue2 = @$filter["y_Subject"];
		$this->Subject->AdvancedSearch->SearchOperator2 = @$filter["w_Subject"];
		$this->Subject->AdvancedSearch->save();

		// Field TicketReportDate
		$this->TicketReportDate->AdvancedSearch->SearchValue = @$filter["x_TicketReportDate"];
		$this->TicketReportDate->AdvancedSearch->SearchOperator = @$filter["z_TicketReportDate"];
		$this->TicketReportDate->AdvancedSearch->SearchCondition = @$filter["v_TicketReportDate"];
		$this->TicketReportDate->AdvancedSearch->SearchValue2 = @$filter["y_TicketReportDate"];
		$this->TicketReportDate->AdvancedSearch->SearchOperator2 = @$filter["w_TicketReportDate"];
		$this->TicketReportDate->AdvancedSearch->save();

		// Field IncidentDate
		$this->IncidentDate->AdvancedSearch->SearchValue = @$filter["x_IncidentDate"];
		$this->IncidentDate->AdvancedSearch->SearchOperator = @$filter["z_IncidentDate"];
		$this->IncidentDate->AdvancedSearch->SearchCondition = @$filter["v_IncidentDate"];
		$this->IncidentDate->AdvancedSearch->SearchValue2 = @$filter["y_IncidentDate"];
		$this->IncidentDate->AdvancedSearch->SearchOperator2 = @$filter["w_IncidentDate"];
		$this->IncidentDate->AdvancedSearch->save();

		// Field IncidentTime
		$this->IncidentTime->AdvancedSearch->SearchValue = @$filter["x_IncidentTime"];
		$this->IncidentTime->AdvancedSearch->SearchOperator = @$filter["z_IncidentTime"];
		$this->IncidentTime->AdvancedSearch->SearchCondition = @$filter["v_IncidentTime"];
		$this->IncidentTime->AdvancedSearch->SearchValue2 = @$filter["y_IncidentTime"];
		$this->IncidentTime->AdvancedSearch->SearchOperator2 = @$filter["w_IncidentTime"];
		$this->IncidentTime->AdvancedSearch->save();

		// Field TicketDescription
		$this->TicketDescription->AdvancedSearch->SearchValue = @$filter["x_TicketDescription"];
		$this->TicketDescription->AdvancedSearch->SearchOperator = @$filter["z_TicketDescription"];
		$this->TicketDescription->AdvancedSearch->SearchCondition = @$filter["v_TicketDescription"];
		$this->TicketDescription->AdvancedSearch->SearchValue2 = @$filter["y_TicketDescription"];
		$this->TicketDescription->AdvancedSearch->SearchOperator2 = @$filter["w_TicketDescription"];
		$this->TicketDescription->AdvancedSearch->save();

		// Field TicketCategory
		$this->TicketCategory->AdvancedSearch->SearchValue = @$filter["x_TicketCategory"];
		$this->TicketCategory->AdvancedSearch->SearchOperator = @$filter["z_TicketCategory"];
		$this->TicketCategory->AdvancedSearch->SearchCondition = @$filter["v_TicketCategory"];
		$this->TicketCategory->AdvancedSearch->SearchValue2 = @$filter["y_TicketCategory"];
		$this->TicketCategory->AdvancedSearch->SearchOperator2 = @$filter["w_TicketCategory"];
		$this->TicketCategory->AdvancedSearch->save();

		// Field TicketType
		$this->TicketType->AdvancedSearch->SearchValue = @$filter["x_TicketType"];
		$this->TicketType->AdvancedSearch->SearchOperator = @$filter["z_TicketType"];
		$this->TicketType->AdvancedSearch->SearchCondition = @$filter["v_TicketType"];
		$this->TicketType->AdvancedSearch->SearchValue2 = @$filter["y_TicketType"];
		$this->TicketType->AdvancedSearch->SearchOperator2 = @$filter["w_TicketType"];
		$this->TicketType->AdvancedSearch->save();

		// Field ReportedBy
		$this->ReportedBy->AdvancedSearch->SearchValue = @$filter["x_ReportedBy"];
		$this->ReportedBy->AdvancedSearch->SearchOperator = @$filter["z_ReportedBy"];
		$this->ReportedBy->AdvancedSearch->SearchCondition = @$filter["v_ReportedBy"];
		$this->ReportedBy->AdvancedSearch->SearchValue2 = @$filter["y_ReportedBy"];
		$this->ReportedBy->AdvancedSearch->SearchOperator2 = @$filter["w_ReportedBy"];
		$this->ReportedBy->AdvancedSearch->save();

		// Field TicketStatus
		$this->TicketStatus->AdvancedSearch->SearchValue = @$filter["x_TicketStatus"];
		$this->TicketStatus->AdvancedSearch->SearchOperator = @$filter["z_TicketStatus"];
		$this->TicketStatus->AdvancedSearch->SearchCondition = @$filter["v_TicketStatus"];
		$this->TicketStatus->AdvancedSearch->SearchValue2 = @$filter["y_TicketStatus"];
		$this->TicketStatus->AdvancedSearch->SearchOperator2 = @$filter["w_TicketStatus"];
		$this->TicketStatus->AdvancedSearch->save();

		// Field TicketNumber
		$this->TicketNumber->AdvancedSearch->SearchValue = @$filter["x_TicketNumber"];
		$this->TicketNumber->AdvancedSearch->SearchOperator = @$filter["z_TicketNumber"];
		$this->TicketNumber->AdvancedSearch->SearchCondition = @$filter["v_TicketNumber"];
		$this->TicketNumber->AdvancedSearch->SearchValue2 = @$filter["y_TicketNumber"];
		$this->TicketNumber->AdvancedSearch->SearchOperator2 = @$filter["w_TicketNumber"];
		$this->TicketNumber->AdvancedSearch->save();

		// Field ReporterEmail
		$this->ReporterEmail->AdvancedSearch->SearchValue = @$filter["x_ReporterEmail"];
		$this->ReporterEmail->AdvancedSearch->SearchOperator = @$filter["z_ReporterEmail"];
		$this->ReporterEmail->AdvancedSearch->SearchCondition = @$filter["v_ReporterEmail"];
		$this->ReporterEmail->AdvancedSearch->SearchValue2 = @$filter["y_ReporterEmail"];
		$this->ReporterEmail->AdvancedSearch->SearchOperator2 = @$filter["w_ReporterEmail"];
		$this->ReporterEmail->AdvancedSearch->save();

		// Field ReporterMobile
		$this->ReporterMobile->AdvancedSearch->SearchValue = @$filter["x_ReporterMobile"];
		$this->ReporterMobile->AdvancedSearch->SearchOperator = @$filter["z_ReporterMobile"];
		$this->ReporterMobile->AdvancedSearch->SearchCondition = @$filter["v_ReporterMobile"];
		$this->ReporterMobile->AdvancedSearch->SearchValue2 = @$filter["y_ReporterMobile"];
		$this->ReporterMobile->AdvancedSearch->SearchOperator2 = @$filter["w_ReporterMobile"];
		$this->ReporterMobile->AdvancedSearch->save();

		// Field ProvinceCode
		$this->ProvinceCode->AdvancedSearch->SearchValue = @$filter["x_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchOperator = @$filter["z_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchCondition = @$filter["v_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchValue2 = @$filter["y_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchOperator2 = @$filter["w_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->save();

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

		// Field DeptSection
		$this->DeptSection->AdvancedSearch->SearchValue = @$filter["x_DeptSection"];
		$this->DeptSection->AdvancedSearch->SearchOperator = @$filter["z_DeptSection"];
		$this->DeptSection->AdvancedSearch->SearchCondition = @$filter["v_DeptSection"];
		$this->DeptSection->AdvancedSearch->SearchValue2 = @$filter["y_DeptSection"];
		$this->DeptSection->AdvancedSearch->SearchOperator2 = @$filter["w_DeptSection"];
		$this->DeptSection->AdvancedSearch->save();

		// Field TicketLevel
		$this->TicketLevel->AdvancedSearch->SearchValue = @$filter["x_TicketLevel"];
		$this->TicketLevel->AdvancedSearch->SearchOperator = @$filter["z_TicketLevel"];
		$this->TicketLevel->AdvancedSearch->SearchCondition = @$filter["v_TicketLevel"];
		$this->TicketLevel->AdvancedSearch->SearchValue2 = @$filter["y_TicketLevel"];
		$this->TicketLevel->AdvancedSearch->SearchOperator2 = @$filter["w_TicketLevel"];
		$this->TicketLevel->AdvancedSearch->save();

		// Field AllocatedTo
		$this->AllocatedTo->AdvancedSearch->SearchValue = @$filter["x_AllocatedTo"];
		$this->AllocatedTo->AdvancedSearch->SearchOperator = @$filter["z_AllocatedTo"];
		$this->AllocatedTo->AdvancedSearch->SearchCondition = @$filter["v_AllocatedTo"];
		$this->AllocatedTo->AdvancedSearch->SearchValue2 = @$filter["y_AllocatedTo"];
		$this->AllocatedTo->AdvancedSearch->SearchOperator2 = @$filter["w_AllocatedTo"];
		$this->AllocatedTo->AdvancedSearch->save();

		// Field EscalatedTo
		$this->EscalatedTo->AdvancedSearch->SearchValue = @$filter["x_EscalatedTo"];
		$this->EscalatedTo->AdvancedSearch->SearchOperator = @$filter["z_EscalatedTo"];
		$this->EscalatedTo->AdvancedSearch->SearchCondition = @$filter["v_EscalatedTo"];
		$this->EscalatedTo->AdvancedSearch->SearchValue2 = @$filter["y_EscalatedTo"];
		$this->EscalatedTo->AdvancedSearch->SearchOperator2 = @$filter["w_EscalatedTo"];
		$this->EscalatedTo->AdvancedSearch->save();

		// Field TicketSolution
		$this->TicketSolution->AdvancedSearch->SearchValue = @$filter["x_TicketSolution"];
		$this->TicketSolution->AdvancedSearch->SearchOperator = @$filter["z_TicketSolution"];
		$this->TicketSolution->AdvancedSearch->SearchCondition = @$filter["v_TicketSolution"];
		$this->TicketSolution->AdvancedSearch->SearchValue2 = @$filter["y_TicketSolution"];
		$this->TicketSolution->AdvancedSearch->SearchOperator2 = @$filter["w_TicketSolution"];
		$this->TicketSolution->AdvancedSearch->save();

		// Field SeverityLevel
		$this->SeverityLevel->AdvancedSearch->SearchValue = @$filter["x_SeverityLevel"];
		$this->SeverityLevel->AdvancedSearch->SearchOperator = @$filter["z_SeverityLevel"];
		$this->SeverityLevel->AdvancedSearch->SearchCondition = @$filter["v_SeverityLevel"];
		$this->SeverityLevel->AdvancedSearch->SearchValue2 = @$filter["y_SeverityLevel"];
		$this->SeverityLevel->AdvancedSearch->SearchOperator2 = @$filter["w_SeverityLevel"];
		$this->SeverityLevel->AdvancedSearch->save();

		// Field Days
		$this->Days->AdvancedSearch->SearchValue = @$filter["x_Days"];
		$this->Days->AdvancedSearch->SearchOperator = @$filter["z_Days"];
		$this->Days->AdvancedSearch->SearchCondition = @$filter["v_Days"];
		$this->Days->AdvancedSearch->SearchValue2 = @$filter["y_Days"];
		$this->Days->AdvancedSearch->SearchOperator2 = @$filter["w_Days"];
		$this->Days->AdvancedSearch->save();

		// Field DataLastUpdated
		$this->DataLastUpdated->AdvancedSearch->SearchValue = @$filter["x_DataLastUpdated"];
		$this->DataLastUpdated->AdvancedSearch->SearchOperator = @$filter["z_DataLastUpdated"];
		$this->DataLastUpdated->AdvancedSearch->SearchCondition = @$filter["v_DataLastUpdated"];
		$this->DataLastUpdated->AdvancedSearch->SearchValue2 = @$filter["y_DataLastUpdated"];
		$this->DataLastUpdated->AdvancedSearch->SearchOperator2 = @$filter["w_DataLastUpdated"];
		$this->DataLastUpdated->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->Subject, $default, FALSE); // Subject
		$this->buildSearchSql($where, $this->TicketReportDate, $default, FALSE); // TicketReportDate
		$this->buildSearchSql($where, $this->IncidentDate, $default, FALSE); // IncidentDate
		$this->buildSearchSql($where, $this->IncidentTime, $default, FALSE); // IncidentTime
		$this->buildSearchSql($where, $this->TicketDescription, $default, FALSE); // TicketDescription
		$this->buildSearchSql($where, $this->TicketCategory, $default, FALSE); // TicketCategory
		$this->buildSearchSql($where, $this->TicketType, $default, FALSE); // TicketType
		$this->buildSearchSql($where, $this->ReportedBy, $default, FALSE); // ReportedBy
		$this->buildSearchSql($where, $this->TicketStatus, $default, FALSE); // TicketStatus
		$this->buildSearchSql($where, $this->TicketNumber, $default, FALSE); // TicketNumber
		$this->buildSearchSql($where, $this->ReporterEmail, $default, FALSE); // ReporterEmail
		$this->buildSearchSql($where, $this->ReporterMobile, $default, FALSE); // ReporterMobile
		$this->buildSearchSql($where, $this->ProvinceCode, $default, FALSE); // ProvinceCode
		$this->buildSearchSql($where, $this->LACode, $default, FALSE); // LACode
		$this->buildSearchSql($where, $this->DepartmentCode, $default, FALSE); // DepartmentCode
		$this->buildSearchSql($where, $this->DeptSection, $default, FALSE); // DeptSection
		$this->buildSearchSql($where, $this->TicketLevel, $default, FALSE); // TicketLevel
		$this->buildSearchSql($where, $this->AllocatedTo, $default, FALSE); // AllocatedTo
		$this->buildSearchSql($where, $this->EscalatedTo, $default, FALSE); // EscalatedTo
		$this->buildSearchSql($where, $this->TicketSolution, $default, FALSE); // TicketSolution
		$this->buildSearchSql($where, $this->SeverityLevel, $default, FALSE); // SeverityLevel
		$this->buildSearchSql($where, $this->Days, $default, FALSE); // Days
		$this->buildSearchSql($where, $this->DataLastUpdated, $default, FALSE); // DataLastUpdated

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->Subject->AdvancedSearch->save(); // Subject
			$this->TicketReportDate->AdvancedSearch->save(); // TicketReportDate
			$this->IncidentDate->AdvancedSearch->save(); // IncidentDate
			$this->IncidentTime->AdvancedSearch->save(); // IncidentTime
			$this->TicketDescription->AdvancedSearch->save(); // TicketDescription
			$this->TicketCategory->AdvancedSearch->save(); // TicketCategory
			$this->TicketType->AdvancedSearch->save(); // TicketType
			$this->ReportedBy->AdvancedSearch->save(); // ReportedBy
			$this->TicketStatus->AdvancedSearch->save(); // TicketStatus
			$this->TicketNumber->AdvancedSearch->save(); // TicketNumber
			$this->ReporterEmail->AdvancedSearch->save(); // ReporterEmail
			$this->ReporterMobile->AdvancedSearch->save(); // ReporterMobile
			$this->ProvinceCode->AdvancedSearch->save(); // ProvinceCode
			$this->LACode->AdvancedSearch->save(); // LACode
			$this->DepartmentCode->AdvancedSearch->save(); // DepartmentCode
			$this->DeptSection->AdvancedSearch->save(); // DeptSection
			$this->TicketLevel->AdvancedSearch->save(); // TicketLevel
			$this->AllocatedTo->AdvancedSearch->save(); // AllocatedTo
			$this->EscalatedTo->AdvancedSearch->save(); // EscalatedTo
			$this->TicketSolution->AdvancedSearch->save(); // TicketSolution
			$this->SeverityLevel->AdvancedSearch->save(); // SeverityLevel
			$this->Days->AdvancedSearch->save(); // Days
			$this->DataLastUpdated->AdvancedSearch->save(); // DataLastUpdated
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
		$this->buildBasicSearchSql($where, $this->Subject, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->TicketDescription, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ReporterEmail, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ReporterMobile, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LACode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->TicketSolution, $arKeywords, $type);
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
		if ($this->Subject->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketReportDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IncidentDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IncidentTime->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketDescription->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketCategory->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketType->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReportedBy->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketStatus->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketNumber->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReporterEmail->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReporterMobile->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProvinceCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LACode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DepartmentCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeptSection->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketLevel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AllocatedTo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->EscalatedTo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TicketSolution->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SeverityLevel->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Days->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DataLastUpdated->AdvancedSearch->issetSession())
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
		$this->Subject->AdvancedSearch->unsetSession();
		$this->TicketReportDate->AdvancedSearch->unsetSession();
		$this->IncidentDate->AdvancedSearch->unsetSession();
		$this->IncidentTime->AdvancedSearch->unsetSession();
		$this->TicketDescription->AdvancedSearch->unsetSession();
		$this->TicketCategory->AdvancedSearch->unsetSession();
		$this->TicketType->AdvancedSearch->unsetSession();
		$this->ReportedBy->AdvancedSearch->unsetSession();
		$this->TicketStatus->AdvancedSearch->unsetSession();
		$this->TicketNumber->AdvancedSearch->unsetSession();
		$this->ReporterEmail->AdvancedSearch->unsetSession();
		$this->ReporterMobile->AdvancedSearch->unsetSession();
		$this->ProvinceCode->AdvancedSearch->unsetSession();
		$this->LACode->AdvancedSearch->unsetSession();
		$this->DepartmentCode->AdvancedSearch->unsetSession();
		$this->DeptSection->AdvancedSearch->unsetSession();
		$this->TicketLevel->AdvancedSearch->unsetSession();
		$this->AllocatedTo->AdvancedSearch->unsetSession();
		$this->EscalatedTo->AdvancedSearch->unsetSession();
		$this->TicketSolution->AdvancedSearch->unsetSession();
		$this->SeverityLevel->AdvancedSearch->unsetSession();
		$this->Days->AdvancedSearch->unsetSession();
		$this->DataLastUpdated->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->Subject->AdvancedSearch->load();
		$this->TicketReportDate->AdvancedSearch->load();
		$this->IncidentDate->AdvancedSearch->load();
		$this->IncidentTime->AdvancedSearch->load();
		$this->TicketDescription->AdvancedSearch->load();
		$this->TicketCategory->AdvancedSearch->load();
		$this->TicketType->AdvancedSearch->load();
		$this->ReportedBy->AdvancedSearch->load();
		$this->TicketStatus->AdvancedSearch->load();
		$this->TicketNumber->AdvancedSearch->load();
		$this->ReporterEmail->AdvancedSearch->load();
		$this->ReporterMobile->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->DeptSection->AdvancedSearch->load();
		$this->TicketLevel->AdvancedSearch->load();
		$this->AllocatedTo->AdvancedSearch->load();
		$this->EscalatedTo->AdvancedSearch->load();
		$this->TicketSolution->AdvancedSearch->load();
		$this->SeverityLevel->AdvancedSearch->load();
		$this->Days->AdvancedSearch->load();
		$this->DataLastUpdated->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->Subject); // Subject
			$this->updateSort($this->TicketReportDate); // TicketReportDate
			$this->updateSort($this->IncidentDate); // IncidentDate
			$this->updateSort($this->IncidentTime); // IncidentTime
			$this->updateSort($this->TicketCategory); // TicketCategory
			$this->updateSort($this->TicketType); // TicketType
			$this->updateSort($this->ReportedBy); // ReportedBy
			$this->updateSort($this->TicketStatus); // TicketStatus
			$this->updateSort($this->TicketNumber); // TicketNumber
			$this->updateSort($this->ReporterEmail); // ReporterEmail
			$this->updateSort($this->ReporterMobile); // ReporterMobile
			$this->updateSort($this->ProvinceCode); // ProvinceCode
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->DeptSection); // DeptSection
			$this->updateSort($this->TicketLevel); // TicketLevel
			$this->updateSort($this->AllocatedTo); // AllocatedTo
			$this->updateSort($this->EscalatedTo); // EscalatedTo
			$this->updateSort($this->TicketSolution); // TicketSolution
			$this->updateSort($this->SeverityLevel); // SeverityLevel
			$this->updateSort($this->Days); // Days
			$this->updateSort($this->DataLastUpdated); // DataLastUpdated
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
				$this->Subject->setSort("");
				$this->TicketReportDate->setSort("");
				$this->IncidentDate->setSort("");
				$this->IncidentTime->setSort("");
				$this->TicketCategory->setSort("");
				$this->TicketType->setSort("");
				$this->ReportedBy->setSort("");
				$this->TicketStatus->setSort("");
				$this->TicketNumber->setSort("");
				$this->ReporterEmail->setSort("");
				$this->ReporterMobile->setSort("");
				$this->ProvinceCode->setSort("");
				$this->LACode->setSort("");
				$this->DepartmentCode->setSort("");
				$this->DeptSection->setSort("");
				$this->TicketLevel->setSort("");
				$this->AllocatedTo->setSort("");
				$this->EscalatedTo->setSort("");
				$this->TicketSolution->setSort("");
				$this->SeverityLevel->setSort("");
				$this->Days->setSort("");
				$this->DataLastUpdated->setSort("");
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

		// "detail_ticketmessage"
		$item = &$this->ListOptions->add("detail_ticketmessage");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'ticketmessage') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["ticketmessage_grid"]))
			$GLOBALS["ticketmessage_grid"] = new ticketmessage_grid();

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
		$pages->add("ticketmessage");
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

		// "detail_ticketmessage"
		$opt = $this->ListOptions["detail_ticketmessage"];
		if ($Security->allowList(CurrentProjectID() . 'ticketmessage')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("ticketmessage", "TblCaption");
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("ticketmessagelist.php?" . Config("TABLE_SHOW_MASTER") . "=ticket&fk_TicketNumber=" . urlencode(strval($this->TicketNumber->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["ticketmessage_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'ticket')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "ticketmessage";
			}
			if ($GLOBALS["ticketmessage_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'ticket')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "ticketmessage";
			}
			if ($GLOBALS["ticketmessage_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'ticket')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "ticketmessage";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->TicketNumber->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_ticketmessage");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
		if (!isset($GLOBALS["ticketmessage"]))
			$GLOBALS["ticketmessage"] = new ticketmessage();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["ticketmessage"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["ticketmessage"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'ticket') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "ticketmessage";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fticketlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fticketlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fticketlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$links = "";
		$btngrps = "";
		$sqlwrk = "`TicketNumber`=" . AdjustSql($this->TicketNumber->CurrentValue, $this->Dbid) . "";

		// Column "detail_ticketmessage"
		if ($this->DetailPages && $this->DetailPages["ticketmessage"] && $this->DetailPages["ticketmessage"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_ticketmessage"];
			$url = "ticketmessagepreview.php?t=ticket&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"ticketmessage\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'ticket')) {
				$label = $Language->TablePhrase("ticketmessage", "TblCaption");
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"ticketmessage\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("ticketmessagelist.php?" . Config("TABLE_SHOW_MASTER") . "=ticket&fk_TicketNumber=" . urlencode(strval($this->TicketNumber->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("ticketmessage", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["ticketmessage_grid"]))
				$GLOBALS["ticketmessage_grid"] = new ticketmessage_grid();
			if ($GLOBALS["ticketmessage_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'ticket')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["ticketmessage_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'ticket')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["ticketmessage_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'ticket')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=ticketmessage");
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

		// Subject
		if (!$this->isAddOrEdit() && $this->Subject->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Subject->AdvancedSearch->SearchValue != "" || $this->Subject->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketReportDate
		if (!$this->isAddOrEdit() && $this->TicketReportDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketReportDate->AdvancedSearch->SearchValue != "" || $this->TicketReportDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IncidentDate
		if (!$this->isAddOrEdit() && $this->IncidentDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncidentDate->AdvancedSearch->SearchValue != "" || $this->IncidentDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IncidentTime
		if (!$this->isAddOrEdit() && $this->IncidentTime->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncidentTime->AdvancedSearch->SearchValue != "" || $this->IncidentTime->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketDescription
		if (!$this->isAddOrEdit() && $this->TicketDescription->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketDescription->AdvancedSearch->SearchValue != "" || $this->TicketDescription->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketCategory
		if (!$this->isAddOrEdit() && $this->TicketCategory->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketCategory->AdvancedSearch->SearchValue != "" || $this->TicketCategory->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketType
		if (!$this->isAddOrEdit() && $this->TicketType->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketType->AdvancedSearch->SearchValue != "" || $this->TicketType->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReportedBy
		if (!$this->isAddOrEdit() && $this->ReportedBy->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReportedBy->AdvancedSearch->SearchValue != "" || $this->ReportedBy->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketStatus
		if (!$this->isAddOrEdit() && $this->TicketStatus->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketStatus->AdvancedSearch->SearchValue != "" || $this->TicketStatus->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketNumber
		if (!$this->isAddOrEdit() && $this->TicketNumber->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketNumber->AdvancedSearch->SearchValue != "" || $this->TicketNumber->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReporterEmail
		if (!$this->isAddOrEdit() && $this->ReporterEmail->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReporterEmail->AdvancedSearch->SearchValue != "" || $this->ReporterEmail->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReporterMobile
		if (!$this->isAddOrEdit() && $this->ReporterMobile->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReporterMobile->AdvancedSearch->SearchValue != "" || $this->ReporterMobile->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ProvinceCode
		if (!$this->isAddOrEdit() && $this->ProvinceCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProvinceCode->AdvancedSearch->SearchValue != "" || $this->ProvinceCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// DeptSection
		if (!$this->isAddOrEdit() && $this->DeptSection->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeptSection->AdvancedSearch->SearchValue != "" || $this->DeptSection->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketLevel
		if (!$this->isAddOrEdit() && $this->TicketLevel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketLevel->AdvancedSearch->SearchValue != "" || $this->TicketLevel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AllocatedTo
		if (!$this->isAddOrEdit() && $this->AllocatedTo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AllocatedTo->AdvancedSearch->SearchValue != "" || $this->AllocatedTo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// EscalatedTo
		if (!$this->isAddOrEdit() && $this->EscalatedTo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->EscalatedTo->AdvancedSearch->SearchValue != "" || $this->EscalatedTo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TicketSolution
		if (!$this->isAddOrEdit() && $this->TicketSolution->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TicketSolution->AdvancedSearch->SearchValue != "" || $this->TicketSolution->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SeverityLevel
		if (!$this->isAddOrEdit() && $this->SeverityLevel->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SeverityLevel->AdvancedSearch->SearchValue != "" || $this->SeverityLevel->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Days
		if (!$this->isAddOrEdit() && $this->Days->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Days->AdvancedSearch->SearchValue != "" || $this->Days->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DataLastUpdated
		if (!$this->isAddOrEdit() && $this->DataLastUpdated->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DataLastUpdated->AdvancedSearch->SearchValue != "" || $this->DataLastUpdated->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->Subject->setDbValue($row['Subject']);
		$this->TicketReportDate->setDbValue($row['TicketReportDate']);
		$this->IncidentDate->setDbValue($row['IncidentDate']);
		$this->IncidentTime->setDbValue($row['IncidentTime']);
		$this->TicketDescription->setDbValue($row['TicketDescription']);
		$this->TicketCategory->setDbValue($row['TicketCategory']);
		$this->TicketType->setDbValue($row['TicketType']);
		$this->ReportedBy->setDbValue($row['ReportedBy']);
		$this->TicketStatus->setDbValue($row['TicketStatus']);
		$this->TicketNumber->setDbValue($row['TicketNumber']);
		$this->ReporterEmail->setDbValue($row['ReporterEmail']);
		$this->ReporterMobile->setDbValue($row['ReporterMobile']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->DeptSection->setDbValue($row['DeptSection']);
		$this->TicketLevel->setDbValue($row['TicketLevel']);
		$this->AllocatedTo->setDbValue($row['AllocatedTo']);
		$this->EscalatedTo->setDbValue($row['EscalatedTo']);
		$this->TicketSolution->setDbValue($row['TicketSolution']);
		$this->Evidence->Upload->DbValue = $row['Evidence'];
		if (is_array($this->Evidence->Upload->DbValue) || is_object($this->Evidence->Upload->DbValue)) // Byte array
			$this->Evidence->Upload->DbValue = BytesToString($this->Evidence->Upload->DbValue);
		$this->SeverityLevel->setDbValue($row['SeverityLevel']);
		$this->Days->setDbValue($row['Days']);
		$this->DataLastUpdated->setDbValue($row['DataLastUpdated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['Subject'] = NULL;
		$row['TicketReportDate'] = NULL;
		$row['IncidentDate'] = NULL;
		$row['IncidentTime'] = NULL;
		$row['TicketDescription'] = NULL;
		$row['TicketCategory'] = NULL;
		$row['TicketType'] = NULL;
		$row['ReportedBy'] = NULL;
		$row['TicketStatus'] = NULL;
		$row['TicketNumber'] = NULL;
		$row['ReporterEmail'] = NULL;
		$row['ReporterMobile'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['DeptSection'] = NULL;
		$row['TicketLevel'] = NULL;
		$row['AllocatedTo'] = NULL;
		$row['EscalatedTo'] = NULL;
		$row['TicketSolution'] = NULL;
		$row['Evidence'] = NULL;
		$row['SeverityLevel'] = NULL;
		$row['Days'] = NULL;
		$row['DataLastUpdated'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("TicketNumber")) != "")
			$this->TicketNumber->OldValue = $this->getKey("TicketNumber"); // TicketNumber
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
		if ($this->Days->FormValue == $this->Days->CurrentValue && is_numeric(ConvertToFloatString($this->Days->CurrentValue)))
			$this->Days->CurrentValue = ConvertToFloatString($this->Days->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Subject
		// TicketReportDate
		// IncidentDate
		// IncidentTime
		// TicketDescription
		// TicketCategory
		// TicketType
		// ReportedBy
		// TicketStatus
		// TicketNumber
		// ReporterEmail
		// ReporterMobile
		// ProvinceCode
		// LACode
		// DepartmentCode
		// DeptSection
		// TicketLevel
		// AllocatedTo
		// EscalatedTo
		// TicketSolution
		// Evidence
		// SeverityLevel
		// Days
		// DataLastUpdated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// TicketReportDate
			$this->TicketReportDate->ViewValue = $this->TicketReportDate->CurrentValue;
			$this->TicketReportDate->ViewValue = FormatDateTime($this->TicketReportDate->ViewValue, 0);
			$this->TicketReportDate->ViewCustomAttributes = "";

			// IncidentDate
			$this->IncidentDate->ViewValue = $this->IncidentDate->CurrentValue;
			$this->IncidentDate->ViewValue = FormatDateTime($this->IncidentDate->ViewValue, 0);
			$this->IncidentDate->ViewCustomAttributes = "";

			// IncidentTime
			$this->IncidentTime->ViewValue = $this->IncidentTime->CurrentValue;
			$this->IncidentTime->ViewValue = FormatDateTime($this->IncidentTime->ViewValue, 4);
			$this->IncidentTime->ViewCustomAttributes = "";

			// TicketCategory
			$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
			$curVal = strval($this->TicketCategory->CurrentValue);
			if ($curVal != "") {
				$this->TicketCategory->ViewValue = $this->TicketCategory->lookupCacheOption($curVal);
				if ($this->TicketCategory->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketCategory->ViewValue = $this->TicketCategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
					}
				}
			} else {
				$this->TicketCategory->ViewValue = NULL;
			}
			$this->TicketCategory->ViewCustomAttributes = "";

			// TicketType
			$curVal = strval($this->TicketType->CurrentValue);
			if ($curVal != "") {
				$this->TicketType->ViewValue = $this->TicketType->lookupCacheOption($curVal);
				if ($this->TicketType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketType->ViewValue = $this->TicketType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketType->ViewValue = $this->TicketType->CurrentValue;
					}
				}
			} else {
				$this->TicketType->ViewValue = NULL;
			}
			$this->TicketType->ViewCustomAttributes = "";

			// ReportedBy
			$curVal = strval($this->ReportedBy->CurrentValue);
			if ($curVal != "") {
				$this->ReportedBy->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
				if ($this->ReportedBy->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`UserCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReportedBy->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->ReportedBy->ViewValue = $this->ReportedBy->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReportedBy->ViewValue = $this->ReportedBy->CurrentValue;
					}
				}
			} else {
				$this->ReportedBy->ViewValue = NULL;
			}
			$this->ReportedBy->ViewCustomAttributes = "";

			// TicketStatus
			$curVal = strval($this->TicketStatus->CurrentValue);
			if ($curVal != "") {
				$this->TicketStatus->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
				if ($this->TicketStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`StatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketStatus->ViewValue = $this->TicketStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketStatus->ViewValue = $this->TicketStatus->CurrentValue;
					}
				}
			} else {
				$this->TicketStatus->ViewValue = NULL;
			}
			$this->TicketStatus->ViewCustomAttributes = "";

			// TicketNumber
			$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
			$this->TicketNumber->ViewCustomAttributes = "";

			// ReporterEmail
			$this->ReporterEmail->ViewValue = $this->ReporterEmail->CurrentValue;
			$this->ReporterEmail->ViewCustomAttributes = "";

			// ReporterMobile
			$this->ReporterMobile->ViewValue = $this->ReporterMobile->CurrentValue;
			$this->ReporterMobile->ViewCustomAttributes = "";

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

			// DeptSection
			$this->DeptSection->ViewCustomAttributes = "";

			// TicketLevel
			$this->TicketLevel->ViewValue = $this->TicketLevel->CurrentValue;
			$this->TicketLevel->ViewCustomAttributes = "";

			// AllocatedTo
			$curVal = strval($this->AllocatedTo->CurrentValue);
			if ($curVal != "") {
				$this->AllocatedTo->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
				if ($this->AllocatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AllocatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->CurrentValue;
					}
				}
			} else {
				$this->AllocatedTo->ViewValue = NULL;
			}
			$this->AllocatedTo->ViewCustomAttributes = "";

			// EscalatedTo
			$curVal = strval($this->EscalatedTo->CurrentValue);
			if ($curVal != "") {
				$this->EscalatedTo->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
				if ($this->EscalatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EscalatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->CurrentValue;
					}
				}
			} else {
				$this->EscalatedTo->ViewValue = NULL;
			}
			$this->EscalatedTo->ViewCustomAttributes = "";

			// TicketSolution
			$this->TicketSolution->ViewValue = $this->TicketSolution->CurrentValue;
			$this->TicketSolution->ViewCustomAttributes = "";

			// SeverityLevel
			$curVal = strval($this->SeverityLevel->CurrentValue);
			if ($curVal != "") {
				$this->SeverityLevel->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
				if ($this->SeverityLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SeverityLevelCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SeverityLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->CurrentValue;
					}
				}
			} else {
				$this->SeverityLevel->ViewValue = NULL;
			}
			$this->SeverityLevel->ViewCustomAttributes = "";

			// Days
			$this->Days->ViewValue = $this->Days->CurrentValue;
			$this->Days->ViewValue = FormatNumber($this->Days->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Days->ViewCustomAttributes = "";

			// DataLastUpdated
			$this->DataLastUpdated->ViewValue = $this->DataLastUpdated->CurrentValue;
			$this->DataLastUpdated->ViewValue = FormatDateTime($this->DataLastUpdated->ViewValue, 0);
			$this->DataLastUpdated->ViewCustomAttributes = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";
			if (!$this->isExport())
				$this->Subject->ViewValue = $this->highlightValue($this->Subject);

			// TicketReportDate
			$this->TicketReportDate->LinkCustomAttributes = "";
			$this->TicketReportDate->HrefValue = "";
			$this->TicketReportDate->TooltipValue = "";

			// IncidentDate
			$this->IncidentDate->LinkCustomAttributes = "";
			$this->IncidentDate->HrefValue = "";
			$this->IncidentDate->TooltipValue = "";

			// IncidentTime
			$this->IncidentTime->LinkCustomAttributes = "";
			$this->IncidentTime->HrefValue = "";
			$this->IncidentTime->TooltipValue = "";

			// TicketCategory
			$this->TicketCategory->LinkCustomAttributes = "";
			$this->TicketCategory->HrefValue = "";
			$this->TicketCategory->TooltipValue = "";
			if (!$this->isExport())
				$this->TicketCategory->ViewValue = $this->highlightValue($this->TicketCategory);

			// TicketType
			$this->TicketType->LinkCustomAttributes = "";
			$this->TicketType->HrefValue = "";
			$this->TicketType->TooltipValue = "";

			// ReportedBy
			$this->ReportedBy->LinkCustomAttributes = "";
			$this->ReportedBy->HrefValue = "";
			$this->ReportedBy->TooltipValue = "";

			// TicketStatus
			$this->TicketStatus->LinkCustomAttributes = "";
			$this->TicketStatus->HrefValue = "";
			$this->TicketStatus->TooltipValue = "";

			// TicketNumber
			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";
			$this->TicketNumber->TooltipValue = "";
			if (!$this->isExport())
				$this->TicketNumber->ViewValue = $this->highlightValue($this->TicketNumber);

			// ReporterEmail
			$this->ReporterEmail->LinkCustomAttributes = "";
			$this->ReporterEmail->HrefValue = "";
			$this->ReporterEmail->TooltipValue = "";
			if (!$this->isExport())
				$this->ReporterEmail->ViewValue = $this->highlightValue($this->ReporterEmail);

			// ReporterMobile
			$this->ReporterMobile->LinkCustomAttributes = "";
			$this->ReporterMobile->HrefValue = "";
			$this->ReporterMobile->TooltipValue = "";
			if (!$this->isExport())
				$this->ReporterMobile->ViewValue = $this->highlightValue($this->ReporterMobile);

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

			// DeptSection
			$this->DeptSection->LinkCustomAttributes = "";
			$this->DeptSection->HrefValue = "";
			$this->DeptSection->TooltipValue = "";

			// TicketLevel
			$this->TicketLevel->LinkCustomAttributes = "";
			$this->TicketLevel->HrefValue = "";
			$this->TicketLevel->TooltipValue = "";
			if (!$this->isExport())
				$this->TicketLevel->ViewValue = $this->highlightValue($this->TicketLevel);

			// AllocatedTo
			$this->AllocatedTo->LinkCustomAttributes = "";
			$this->AllocatedTo->HrefValue = "";
			$this->AllocatedTo->TooltipValue = "";

			// EscalatedTo
			$this->EscalatedTo->LinkCustomAttributes = "";
			$this->EscalatedTo->HrefValue = "";
			$this->EscalatedTo->TooltipValue = "";

			// TicketSolution
			$this->TicketSolution->LinkCustomAttributes = "";
			$this->TicketSolution->HrefValue = "";
			$this->TicketSolution->TooltipValue = "";
			if (!$this->isExport())
				$this->TicketSolution->ViewValue = $this->highlightValue($this->TicketSolution);

			// SeverityLevel
			$this->SeverityLevel->LinkCustomAttributes = "";
			$this->SeverityLevel->HrefValue = "";
			$this->SeverityLevel->TooltipValue = "";

			// Days
			$this->Days->LinkCustomAttributes = "";
			$this->Days->HrefValue = "";
			$this->Days->TooltipValue = "";
			if (!$this->isExport())
				$this->Days->ViewValue = $this->highlightValue($this->Days);

			// DataLastUpdated
			$this->DataLastUpdated->LinkCustomAttributes = "";
			$this->DataLastUpdated->HrefValue = "";
			$this->DataLastUpdated->TooltipValue = "";
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
		$this->Subject->AdvancedSearch->load();
		$this->TicketReportDate->AdvancedSearch->load();
		$this->IncidentDate->AdvancedSearch->load();
		$this->IncidentTime->AdvancedSearch->load();
		$this->TicketDescription->AdvancedSearch->load();
		$this->TicketCategory->AdvancedSearch->load();
		$this->TicketType->AdvancedSearch->load();
		$this->ReportedBy->AdvancedSearch->load();
		$this->TicketStatus->AdvancedSearch->load();
		$this->TicketNumber->AdvancedSearch->load();
		$this->ReporterEmail->AdvancedSearch->load();
		$this->ReporterMobile->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->DeptSection->AdvancedSearch->load();
		$this->TicketLevel->AdvancedSearch->load();
		$this->AllocatedTo->AdvancedSearch->load();
		$this->EscalatedTo->AdvancedSearch->load();
		$this->TicketSolution->AdvancedSearch->load();
		$this->SeverityLevel->AdvancedSearch->load();
		$this->Days->AdvancedSearch->load();
		$this->DataLastUpdated->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fticketlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fticketlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fticketlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_ticket" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_ticket\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fticketlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fticketlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"ticketsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"ticket\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'ticketsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fticketlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
				case "x_TicketCategory":
					break;
				case "x_TicketType":
					break;
				case "x_ReportedBy":
					break;
				case "x_TicketStatus":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_AllocatedTo":
					break;
				case "x_EscalatedTo":
					break;
				case "x_SeverityLevel":
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
						case "x_TicketCategory":
							break;
						case "x_TicketType":
							break;
						case "x_ReportedBy":
							break;
						case "x_TicketStatus":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_AllocatedTo":
							break;
						case "x_EscalatedTo":
							break;
						case "x_SeverityLevel":
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