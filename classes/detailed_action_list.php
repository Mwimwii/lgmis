<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class detailed_action_list extends detailed_action
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'detailed_action';

	// Page object name
	public $PageObjName = "detailed_action_list";

	// Grid form hidden field names
	public $FormName = "fdetailed_actionlist";
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

		// Table object (detailed_action)
		if (!isset($GLOBALS["detailed_action"]) || get_class($GLOBALS["detailed_action"]) == PROJECT_NAMESPACE . "detailed_action") {
			$GLOBALS["detailed_action"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["detailed_action"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "detailed_actionadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "detailed_actiondelete.php";
		$this->MultiUpdateUrl = "detailed_actionupdate.php";

		// Table object (_action)
		if (!isset($GLOBALS['_action']))
			$GLOBALS['_action'] = new _action();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'detailed_action');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fdetailed_actionlistsrch";

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
		global $detailed_action;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($detailed_action);
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
			$key .= @$ar['DetailedActionCode'];
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
			$this->DetailedActionCode->Visible = FALSE;
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
	public $budget_Count;
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
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->OutcomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ActionCode->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->DetailedActionCode->setVisibility();
		$this->DetailedActionName->setVisibility();
		$this->DetailedActionLocation->setVisibility();
		$this->PlannedStartDate->setVisibility();
		$this->PlannedEndDate->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->ActualEndDate->setVisibility();
		$this->Ward->setVisibility();
		$this->ExpectedResult->setVisibility();
		$this->Comments->setVisibility();
		$this->ProgressStatus->setVisibility();
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
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ActionCode);
		$this->setupLookupOptions($this->ProgressStatus);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "_action") {
			global $_action;
			$rsmaster = $_action->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("_actionlist.php"); // Return to master page
			} else {
				$_action->loadListRowValues($rsmaster);
				$_action->RowType = ROWTYPE_MASTER; // Master row
				$_action->renderListRow();
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
			$this->DetailedActionCode->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->DetailedActionCode->OldValue))
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
					$key .= $this->DetailedActionCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_DepartmentCode") && $CurrentForm->hasValue("o_DepartmentCode") && $this->DepartmentCode->CurrentValue != $this->DepartmentCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SectionCode") && $CurrentForm->hasValue("o_SectionCode") && $this->SectionCode->CurrentValue != $this->SectionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProgramCode") && $CurrentForm->hasValue("o_ProgramCode") && $this->ProgramCode->CurrentValue != $this->ProgramCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SubProgramCode") && $CurrentForm->hasValue("o_SubProgramCode") && $this->SubProgramCode->CurrentValue != $this->SubProgramCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutcomeCode") && $CurrentForm->hasValue("o_OutcomeCode") && $this->OutcomeCode->CurrentValue != $this->OutcomeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_OutputCode") && $CurrentForm->hasValue("o_OutputCode") && $this->OutputCode->CurrentValue != $this->OutputCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActionCode") && $CurrentForm->hasValue("o_ActionCode") && $this->ActionCode->CurrentValue != $this->ActionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_FinancialYear") && $CurrentForm->hasValue("o_FinancialYear") && $this->FinancialYear->CurrentValue != $this->FinancialYear->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DetailedActionName") && $CurrentForm->hasValue("o_DetailedActionName") && $this->DetailedActionName->CurrentValue != $this->DetailedActionName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DetailedActionLocation") && $CurrentForm->hasValue("o_DetailedActionLocation") && $this->DetailedActionLocation->CurrentValue != $this->DetailedActionLocation->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PlannedStartDate") && $CurrentForm->hasValue("o_PlannedStartDate") && $this->PlannedStartDate->CurrentValue != $this->PlannedStartDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PlannedEndDate") && $CurrentForm->hasValue("o_PlannedEndDate") && $this->PlannedEndDate->CurrentValue != $this->PlannedEndDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActualStartDate") && $CurrentForm->hasValue("o_ActualStartDate") && $this->ActualStartDate->CurrentValue != $this->ActualStartDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ActualEndDate") && $CurrentForm->hasValue("o_ActualEndDate") && $this->ActualEndDate->CurrentValue != $this->ActualEndDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Ward") && $CurrentForm->hasValue("o_Ward") && $this->Ward->CurrentValue != $this->Ward->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ExpectedResult") && $CurrentForm->hasValue("o_ExpectedResult") && $this->ExpectedResult->CurrentValue != $this->ExpectedResult->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Comments") && $CurrentForm->hasValue("o_Comments") && $this->Comments->CurrentValue != $this->Comments->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProgressStatus") && $CurrentForm->hasValue("o_ProgressStatus") && $this->ProgressStatus->CurrentValue != $this->ProgressStatus->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fdetailed_actionlistsrch");
		$filterList = Concat($filterList, $this->LACode->AdvancedSearch->toJson(), ","); // Field LACode
		$filterList = Concat($filterList, $this->DepartmentCode->AdvancedSearch->toJson(), ","); // Field DepartmentCode
		$filterList = Concat($filterList, $this->SectionCode->AdvancedSearch->toJson(), ","); // Field SectionCode
		$filterList = Concat($filterList, $this->ProgramCode->AdvancedSearch->toJson(), ","); // Field ProgramCode
		$filterList = Concat($filterList, $this->SubProgramCode->AdvancedSearch->toJson(), ","); // Field SubProgramCode
		$filterList = Concat($filterList, $this->OutcomeCode->AdvancedSearch->toJson(), ","); // Field OutcomeCode
		$filterList = Concat($filterList, $this->OutputCode->AdvancedSearch->toJson(), ","); // Field OutputCode
		$filterList = Concat($filterList, $this->ActionCode->AdvancedSearch->toJson(), ","); // Field ActionCode
		$filterList = Concat($filterList, $this->FinancialYear->AdvancedSearch->toJson(), ","); // Field FinancialYear
		$filterList = Concat($filterList, $this->DetailedActionCode->AdvancedSearch->toJson(), ","); // Field DetailedActionCode
		$filterList = Concat($filterList, $this->DetailedActionName->AdvancedSearch->toJson(), ","); // Field DetailedActionName
		$filterList = Concat($filterList, $this->DetailedActionLocation->AdvancedSearch->toJson(), ","); // Field DetailedActionLocation
		$filterList = Concat($filterList, $this->PlannedStartDate->AdvancedSearch->toJson(), ","); // Field PlannedStartDate
		$filterList = Concat($filterList, $this->PlannedEndDate->AdvancedSearch->toJson(), ","); // Field PlannedEndDate
		$filterList = Concat($filterList, $this->ActualStartDate->AdvancedSearch->toJson(), ","); // Field ActualStartDate
		$filterList = Concat($filterList, $this->ActualEndDate->AdvancedSearch->toJson(), ","); // Field ActualEndDate
		$filterList = Concat($filterList, $this->Ward->AdvancedSearch->toJson(), ","); // Field Ward
		$filterList = Concat($filterList, $this->ExpectedResult->AdvancedSearch->toJson(), ","); // Field ExpectedResult
		$filterList = Concat($filterList, $this->Comments->AdvancedSearch->toJson(), ","); // Field Comments
		$filterList = Concat($filterList, $this->ProgressStatus->AdvancedSearch->toJson(), ","); // Field ProgressStatus
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fdetailed_actionlistsrch", $filters);
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

		// Field FinancialYear
		$this->FinancialYear->AdvancedSearch->SearchValue = @$filter["x_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchOperator = @$filter["z_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchCondition = @$filter["v_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchValue2 = @$filter["y_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->SearchOperator2 = @$filter["w_FinancialYear"];
		$this->FinancialYear->AdvancedSearch->save();

		// Field DetailedActionCode
		$this->DetailedActionCode->AdvancedSearch->SearchValue = @$filter["x_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchOperator = @$filter["z_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchCondition = @$filter["v_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchValue2 = @$filter["y_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->SearchOperator2 = @$filter["w_DetailedActionCode"];
		$this->DetailedActionCode->AdvancedSearch->save();

		// Field DetailedActionName
		$this->DetailedActionName->AdvancedSearch->SearchValue = @$filter["x_DetailedActionName"];
		$this->DetailedActionName->AdvancedSearch->SearchOperator = @$filter["z_DetailedActionName"];
		$this->DetailedActionName->AdvancedSearch->SearchCondition = @$filter["v_DetailedActionName"];
		$this->DetailedActionName->AdvancedSearch->SearchValue2 = @$filter["y_DetailedActionName"];
		$this->DetailedActionName->AdvancedSearch->SearchOperator2 = @$filter["w_DetailedActionName"];
		$this->DetailedActionName->AdvancedSearch->save();

		// Field DetailedActionLocation
		$this->DetailedActionLocation->AdvancedSearch->SearchValue = @$filter["x_DetailedActionLocation"];
		$this->DetailedActionLocation->AdvancedSearch->SearchOperator = @$filter["z_DetailedActionLocation"];
		$this->DetailedActionLocation->AdvancedSearch->SearchCondition = @$filter["v_DetailedActionLocation"];
		$this->DetailedActionLocation->AdvancedSearch->SearchValue2 = @$filter["y_DetailedActionLocation"];
		$this->DetailedActionLocation->AdvancedSearch->SearchOperator2 = @$filter["w_DetailedActionLocation"];
		$this->DetailedActionLocation->AdvancedSearch->save();

		// Field PlannedStartDate
		$this->PlannedStartDate->AdvancedSearch->SearchValue = @$filter["x_PlannedStartDate"];
		$this->PlannedStartDate->AdvancedSearch->SearchOperator = @$filter["z_PlannedStartDate"];
		$this->PlannedStartDate->AdvancedSearch->SearchCondition = @$filter["v_PlannedStartDate"];
		$this->PlannedStartDate->AdvancedSearch->SearchValue2 = @$filter["y_PlannedStartDate"];
		$this->PlannedStartDate->AdvancedSearch->SearchOperator2 = @$filter["w_PlannedStartDate"];
		$this->PlannedStartDate->AdvancedSearch->save();

		// Field PlannedEndDate
		$this->PlannedEndDate->AdvancedSearch->SearchValue = @$filter["x_PlannedEndDate"];
		$this->PlannedEndDate->AdvancedSearch->SearchOperator = @$filter["z_PlannedEndDate"];
		$this->PlannedEndDate->AdvancedSearch->SearchCondition = @$filter["v_PlannedEndDate"];
		$this->PlannedEndDate->AdvancedSearch->SearchValue2 = @$filter["y_PlannedEndDate"];
		$this->PlannedEndDate->AdvancedSearch->SearchOperator2 = @$filter["w_PlannedEndDate"];
		$this->PlannedEndDate->AdvancedSearch->save();

		// Field ActualStartDate
		$this->ActualStartDate->AdvancedSearch->SearchValue = @$filter["x_ActualStartDate"];
		$this->ActualStartDate->AdvancedSearch->SearchOperator = @$filter["z_ActualStartDate"];
		$this->ActualStartDate->AdvancedSearch->SearchCondition = @$filter["v_ActualStartDate"];
		$this->ActualStartDate->AdvancedSearch->SearchValue2 = @$filter["y_ActualStartDate"];
		$this->ActualStartDate->AdvancedSearch->SearchOperator2 = @$filter["w_ActualStartDate"];
		$this->ActualStartDate->AdvancedSearch->save();

		// Field ActualEndDate
		$this->ActualEndDate->AdvancedSearch->SearchValue = @$filter["x_ActualEndDate"];
		$this->ActualEndDate->AdvancedSearch->SearchOperator = @$filter["z_ActualEndDate"];
		$this->ActualEndDate->AdvancedSearch->SearchCondition = @$filter["v_ActualEndDate"];
		$this->ActualEndDate->AdvancedSearch->SearchValue2 = @$filter["y_ActualEndDate"];
		$this->ActualEndDate->AdvancedSearch->SearchOperator2 = @$filter["w_ActualEndDate"];
		$this->ActualEndDate->AdvancedSearch->save();

		// Field Ward
		$this->Ward->AdvancedSearch->SearchValue = @$filter["x_Ward"];
		$this->Ward->AdvancedSearch->SearchOperator = @$filter["z_Ward"];
		$this->Ward->AdvancedSearch->SearchCondition = @$filter["v_Ward"];
		$this->Ward->AdvancedSearch->SearchValue2 = @$filter["y_Ward"];
		$this->Ward->AdvancedSearch->SearchOperator2 = @$filter["w_Ward"];
		$this->Ward->AdvancedSearch->save();

		// Field ExpectedResult
		$this->ExpectedResult->AdvancedSearch->SearchValue = @$filter["x_ExpectedResult"];
		$this->ExpectedResult->AdvancedSearch->SearchOperator = @$filter["z_ExpectedResult"];
		$this->ExpectedResult->AdvancedSearch->SearchCondition = @$filter["v_ExpectedResult"];
		$this->ExpectedResult->AdvancedSearch->SearchValue2 = @$filter["y_ExpectedResult"];
		$this->ExpectedResult->AdvancedSearch->SearchOperator2 = @$filter["w_ExpectedResult"];
		$this->ExpectedResult->AdvancedSearch->save();

		// Field Comments
		$this->Comments->AdvancedSearch->SearchValue = @$filter["x_Comments"];
		$this->Comments->AdvancedSearch->SearchOperator = @$filter["z_Comments"];
		$this->Comments->AdvancedSearch->SearchCondition = @$filter["v_Comments"];
		$this->Comments->AdvancedSearch->SearchValue2 = @$filter["y_Comments"];
		$this->Comments->AdvancedSearch->SearchOperator2 = @$filter["w_Comments"];
		$this->Comments->AdvancedSearch->save();

		// Field ProgressStatus
		$this->ProgressStatus->AdvancedSearch->SearchValue = @$filter["x_ProgressStatus"];
		$this->ProgressStatus->AdvancedSearch->SearchOperator = @$filter["z_ProgressStatus"];
		$this->ProgressStatus->AdvancedSearch->SearchCondition = @$filter["v_ProgressStatus"];
		$this->ProgressStatus->AdvancedSearch->SearchValue2 = @$filter["y_ProgressStatus"];
		$this->ProgressStatus->AdvancedSearch->SearchOperator2 = @$filter["w_ProgressStatus"];
		$this->ProgressStatus->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->LACode, $default, FALSE); // LACode
		$this->buildSearchSql($where, $this->DepartmentCode, $default, FALSE); // DepartmentCode
		$this->buildSearchSql($where, $this->SectionCode, $default, FALSE); // SectionCode
		$this->buildSearchSql($where, $this->ProgramCode, $default, FALSE); // ProgramCode
		$this->buildSearchSql($where, $this->SubProgramCode, $default, FALSE); // SubProgramCode
		$this->buildSearchSql($where, $this->OutcomeCode, $default, FALSE); // OutcomeCode
		$this->buildSearchSql($where, $this->OutputCode, $default, FALSE); // OutputCode
		$this->buildSearchSql($where, $this->ActionCode, $default, FALSE); // ActionCode
		$this->buildSearchSql($where, $this->FinancialYear, $default, FALSE); // FinancialYear
		$this->buildSearchSql($where, $this->DetailedActionCode, $default, FALSE); // DetailedActionCode
		$this->buildSearchSql($where, $this->DetailedActionName, $default, FALSE); // DetailedActionName
		$this->buildSearchSql($where, $this->DetailedActionLocation, $default, FALSE); // DetailedActionLocation
		$this->buildSearchSql($where, $this->PlannedStartDate, $default, FALSE); // PlannedStartDate
		$this->buildSearchSql($where, $this->PlannedEndDate, $default, FALSE); // PlannedEndDate
		$this->buildSearchSql($where, $this->ActualStartDate, $default, FALSE); // ActualStartDate
		$this->buildSearchSql($where, $this->ActualEndDate, $default, FALSE); // ActualEndDate
		$this->buildSearchSql($where, $this->Ward, $default, FALSE); // Ward
		$this->buildSearchSql($where, $this->ExpectedResult, $default, FALSE); // ExpectedResult
		$this->buildSearchSql($where, $this->Comments, $default, FALSE); // Comments
		$this->buildSearchSql($where, $this->ProgressStatus, $default, FALSE); // ProgressStatus

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->LACode->AdvancedSearch->save(); // LACode
			$this->DepartmentCode->AdvancedSearch->save(); // DepartmentCode
			$this->SectionCode->AdvancedSearch->save(); // SectionCode
			$this->ProgramCode->AdvancedSearch->save(); // ProgramCode
			$this->SubProgramCode->AdvancedSearch->save(); // SubProgramCode
			$this->OutcomeCode->AdvancedSearch->save(); // OutcomeCode
			$this->OutputCode->AdvancedSearch->save(); // OutputCode
			$this->ActionCode->AdvancedSearch->save(); // ActionCode
			$this->FinancialYear->AdvancedSearch->save(); // FinancialYear
			$this->DetailedActionCode->AdvancedSearch->save(); // DetailedActionCode
			$this->DetailedActionName->AdvancedSearch->save(); // DetailedActionName
			$this->DetailedActionLocation->AdvancedSearch->save(); // DetailedActionLocation
			$this->PlannedStartDate->AdvancedSearch->save(); // PlannedStartDate
			$this->PlannedEndDate->AdvancedSearch->save(); // PlannedEndDate
			$this->ActualStartDate->AdvancedSearch->save(); // ActualStartDate
			$this->ActualEndDate->AdvancedSearch->save(); // ActualEndDate
			$this->Ward->AdvancedSearch->save(); // Ward
			$this->ExpectedResult->AdvancedSearch->save(); // ExpectedResult
			$this->Comments->AdvancedSearch->save(); // Comments
			$this->ProgressStatus->AdvancedSearch->save(); // ProgressStatus
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
		$this->buildBasicSearchSql($where, $this->DetailedActionName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DetailedActionLocation, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Ward, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ExpectedResult, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Comments, $arKeywords, $type);
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
		if ($this->LACode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DepartmentCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SectionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProgramCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SubProgramCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->OutcomeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->OutputCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->FinancialYear->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DetailedActionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DetailedActionName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DetailedActionLocation->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PlannedStartDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PlannedEndDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActualStartDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ActualEndDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Ward->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ExpectedResult->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Comments->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProgressStatus->AdvancedSearch->issetSession())
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
		$this->LACode->AdvancedSearch->unsetSession();
		$this->DepartmentCode->AdvancedSearch->unsetSession();
		$this->SectionCode->AdvancedSearch->unsetSession();
		$this->ProgramCode->AdvancedSearch->unsetSession();
		$this->SubProgramCode->AdvancedSearch->unsetSession();
		$this->OutcomeCode->AdvancedSearch->unsetSession();
		$this->OutputCode->AdvancedSearch->unsetSession();
		$this->ActionCode->AdvancedSearch->unsetSession();
		$this->FinancialYear->AdvancedSearch->unsetSession();
		$this->DetailedActionCode->AdvancedSearch->unsetSession();
		$this->DetailedActionName->AdvancedSearch->unsetSession();
		$this->DetailedActionLocation->AdvancedSearch->unsetSession();
		$this->PlannedStartDate->AdvancedSearch->unsetSession();
		$this->PlannedEndDate->AdvancedSearch->unsetSession();
		$this->ActualStartDate->AdvancedSearch->unsetSession();
		$this->ActualEndDate->AdvancedSearch->unsetSession();
		$this->Ward->AdvancedSearch->unsetSession();
		$this->ExpectedResult->AdvancedSearch->unsetSession();
		$this->Comments->AdvancedSearch->unsetSession();
		$this->ProgressStatus->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->ProgramCode->AdvancedSearch->load();
		$this->SubProgramCode->AdvancedSearch->load();
		$this->OutcomeCode->AdvancedSearch->load();
		$this->OutputCode->AdvancedSearch->load();
		$this->ActionCode->AdvancedSearch->load();
		$this->FinancialYear->AdvancedSearch->load();
		$this->DetailedActionCode->AdvancedSearch->load();
		$this->DetailedActionName->AdvancedSearch->load();
		$this->DetailedActionLocation->AdvancedSearch->load();
		$this->PlannedStartDate->AdvancedSearch->load();
		$this->PlannedEndDate->AdvancedSearch->load();
		$this->ActualStartDate->AdvancedSearch->load();
		$this->ActualEndDate->AdvancedSearch->load();
		$this->Ward->AdvancedSearch->load();
		$this->ExpectedResult->AdvancedSearch->load();
		$this->Comments->AdvancedSearch->load();
		$this->ProgressStatus->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->SectionCode); // SectionCode
			$this->updateSort($this->ProgramCode); // ProgramCode
			$this->updateSort($this->SubProgramCode); // SubProgramCode
			$this->updateSort($this->OutcomeCode); // OutcomeCode
			$this->updateSort($this->OutputCode); // OutputCode
			$this->updateSort($this->ActionCode); // ActionCode
			$this->updateSort($this->FinancialYear); // FinancialYear
			$this->updateSort($this->DetailedActionCode); // DetailedActionCode
			$this->updateSort($this->DetailedActionName); // DetailedActionName
			$this->updateSort($this->DetailedActionLocation); // DetailedActionLocation
			$this->updateSort($this->PlannedStartDate); // PlannedStartDate
			$this->updateSort($this->PlannedEndDate); // PlannedEndDate
			$this->updateSort($this->ActualStartDate); // ActualStartDate
			$this->updateSort($this->ActualEndDate); // ActualEndDate
			$this->updateSort($this->Ward); // Ward
			$this->updateSort($this->ExpectedResult); // ExpectedResult
			$this->updateSort($this->Comments); // Comments
			$this->updateSort($this->ProgressStatus); // ProgressStatus
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
				$this->ProgramCode->setSessionValue("");
				$this->OutcomeCode->setSessionValue("");
				$this->OutputCode->setSessionValue("");
				$this->ActionCode->setSessionValue("");
				$this->FinancialYear->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->LACode->setSort("");
				$this->DepartmentCode->setSort("");
				$this->SectionCode->setSort("");
				$this->ProgramCode->setSort("");
				$this->SubProgramCode->setSort("");
				$this->OutcomeCode->setSort("");
				$this->OutputCode->setSort("");
				$this->ActionCode->setSort("");
				$this->FinancialYear->setSort("");
				$this->DetailedActionCode->setSort("");
				$this->DetailedActionName->setSort("");
				$this->DetailedActionLocation->setSort("");
				$this->PlannedStartDate->setSort("");
				$this->PlannedEndDate->setSort("");
				$this->ActualStartDate->setSort("");
				$this->ActualEndDate->setSort("");
				$this->Ward->setSort("");
				$this->ExpectedResult->setSort("");
				$this->Comments->setSort("");
				$this->ProgressStatus->setSort("");
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

		// "detail_budget"
		$item = &$this->ListOptions->add("detail_budget");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'budget') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["budget_grid"]))
			$GLOBALS["budget_grid"] = new budget_grid();

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
		$pages->add("budget");
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"detailed_action\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
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

		// "detail_budget"
		$opt = $this->ListOptions["detail_budget"];
		if ($Security->allowList(CurrentProjectID() . 'budget')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("budget", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->budget_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("budgetlist.php?" . Config("TABLE_SHOW_MASTER") . "=detailed_action&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "&fk_DepartmentCode=" . urlencode(strval($this->DepartmentCode->CurrentValue)) . "&fk_FinancialYear=" . urlencode(strval($this->FinancialYear->CurrentValue)) . "&fk_ActionCode=" . urlencode(strval($this->ActionCode->CurrentValue)) . "&fk_OutcomeCode=" . urlencode(strval($this->OutcomeCode->CurrentValue)) . "&fk_OutputCode=" . urlencode(strval($this->OutputCode->CurrentValue)) . "&fk_DetailedActionCode=" . urlencode(strval($this->DetailedActionCode->CurrentValue)) . "&fk_ProgramCode=" . urlencode(strval($this->ProgramCode->CurrentValue)) . "&fk_SubProgramCode=" . urlencode(strval($this->SubProgramCode->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["budget_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'detailed_action')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "budget";
			}
			if ($GLOBALS["budget_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'detailed_action')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "budget";
			}
			if ($GLOBALS["budget_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'detailed_action')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "budget";
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->DetailedActionCode->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->DetailedActionCode->CurrentValue . "\">";
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
		$item = &$option->add("detailadd_budget");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
		if (!isset($GLOBALS["budget"]))
			$GLOBALS["budget"] = new budget();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["budget"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["budget"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'detailed_action') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "budget";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fdetailed_actionlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdetailed_actionlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fdetailed_actionlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$sqlwrk = "`LACode`='" . AdjustSql($this->LACode->CurrentValue, $this->Dbid) . "'";
		$sqlwrk = $sqlwrk . " AND " . "`DepartmentCode`=" . AdjustSql($this->DepartmentCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`FinancialYear`=" . AdjustSql($this->FinancialYear->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`ActionCode`=" . AdjustSql($this->ActionCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`OutcomeCode`=" . AdjustSql($this->OutcomeCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`OutputCode`=" . AdjustSql($this->OutputCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`DetailedActionCode`=" . AdjustSql($this->DetailedActionCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`ProgramCode`=" . AdjustSql($this->ProgramCode->CurrentValue, $this->Dbid) . "";
		$sqlwrk = $sqlwrk . " AND " . "`SubProgramCode`=" . AdjustSql($this->SubProgramCode->CurrentValue, $this->Dbid) . "";

		// Column "detail_budget"
		if ($this->DetailPages && $this->DetailPages["budget"] && $this->DetailPages["budget"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_budget"];
			$url = "budgetpreview.php?t=detailed_action&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"budget\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'detailed_action')) {
				$label = $Language->TablePhrase("budget", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->budget_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"budget\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("budgetlist.php?" . Config("TABLE_SHOW_MASTER") . "=detailed_action&fk_LACode=" . urlencode(strval($this->LACode->CurrentValue)) . "&fk_DepartmentCode=" . urlencode(strval($this->DepartmentCode->CurrentValue)) . "&fk_FinancialYear=" . urlencode(strval($this->FinancialYear->CurrentValue)) . "&fk_ActionCode=" . urlencode(strval($this->ActionCode->CurrentValue)) . "&fk_OutcomeCode=" . urlencode(strval($this->OutcomeCode->CurrentValue)) . "&fk_OutputCode=" . urlencode(strval($this->OutputCode->CurrentValue)) . "&fk_DetailedActionCode=" . urlencode(strval($this->DetailedActionCode->CurrentValue)) . "&fk_ProgramCode=" . urlencode(strval($this->ProgramCode->CurrentValue)) . "&fk_SubProgramCode=" . urlencode(strval($this->SubProgramCode->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("budget", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["budget_grid"]))
				$GLOBALS["budget_grid"] = new budget_grid();
			if ($GLOBALS["budget_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'detailed_action')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["budget_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'detailed_action')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["budget_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'detailed_action')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=budget");
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
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->ProgramCode->CurrentValue = NULL;
		$this->ProgramCode->OldValue = $this->ProgramCode->CurrentValue;
		$this->SubProgramCode->CurrentValue = NULL;
		$this->SubProgramCode->OldValue = $this->SubProgramCode->CurrentValue;
		$this->OutcomeCode->CurrentValue = NULL;
		$this->OutcomeCode->OldValue = $this->OutcomeCode->CurrentValue;
		$this->OutputCode->CurrentValue = NULL;
		$this->OutputCode->OldValue = $this->OutputCode->CurrentValue;
		$this->ActionCode->CurrentValue = NULL;
		$this->ActionCode->OldValue = $this->ActionCode->CurrentValue;
		$this->FinancialYear->CurrentValue = NULL;
		$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
		$this->DetailedActionCode->CurrentValue = NULL;
		$this->DetailedActionCode->OldValue = $this->DetailedActionCode->CurrentValue;
		$this->DetailedActionName->CurrentValue = NULL;
		$this->DetailedActionName->OldValue = $this->DetailedActionName->CurrentValue;
		$this->DetailedActionLocation->CurrentValue = NULL;
		$this->DetailedActionLocation->OldValue = $this->DetailedActionLocation->CurrentValue;
		$this->PlannedStartDate->CurrentValue = NULL;
		$this->PlannedStartDate->OldValue = $this->PlannedStartDate->CurrentValue;
		$this->PlannedEndDate->CurrentValue = NULL;
		$this->PlannedEndDate->OldValue = $this->PlannedEndDate->CurrentValue;
		$this->ActualStartDate->CurrentValue = NULL;
		$this->ActualStartDate->OldValue = $this->ActualStartDate->CurrentValue;
		$this->ActualEndDate->CurrentValue = NULL;
		$this->ActualEndDate->OldValue = $this->ActualEndDate->CurrentValue;
		$this->Ward->CurrentValue = NULL;
		$this->Ward->OldValue = $this->Ward->CurrentValue;
		$this->ExpectedResult->CurrentValue = NULL;
		$this->ExpectedResult->OldValue = $this->ExpectedResult->CurrentValue;
		$this->Comments->CurrentValue = NULL;
		$this->Comments->OldValue = $this->Comments->CurrentValue;
		$this->ProgressStatus->CurrentValue = NULL;
		$this->ProgressStatus->OldValue = $this->ProgressStatus->CurrentValue;
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

		// FinancialYear
		if (!$this->isAddOrEdit() && $this->FinancialYear->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->FinancialYear->AdvancedSearch->SearchValue != "" || $this->FinancialYear->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DetailedActionCode
		if (!$this->isAddOrEdit() && $this->DetailedActionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DetailedActionCode->AdvancedSearch->SearchValue != "" || $this->DetailedActionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DetailedActionName
		if (!$this->isAddOrEdit() && $this->DetailedActionName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DetailedActionName->AdvancedSearch->SearchValue != "" || $this->DetailedActionName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DetailedActionLocation
		if (!$this->isAddOrEdit() && $this->DetailedActionLocation->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DetailedActionLocation->AdvancedSearch->SearchValue != "" || $this->DetailedActionLocation->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PlannedStartDate
		if (!$this->isAddOrEdit() && $this->PlannedStartDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PlannedStartDate->AdvancedSearch->SearchValue != "" || $this->PlannedStartDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PlannedEndDate
		if (!$this->isAddOrEdit() && $this->PlannedEndDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PlannedEndDate->AdvancedSearch->SearchValue != "" || $this->PlannedEndDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ActualStartDate
		if (!$this->isAddOrEdit() && $this->ActualStartDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ActualStartDate->AdvancedSearch->SearchValue != "" || $this->ActualStartDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ActualEndDate
		if (!$this->isAddOrEdit() && $this->ActualEndDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ActualEndDate->AdvancedSearch->SearchValue != "" || $this->ActualEndDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Ward
		if (!$this->isAddOrEdit() && $this->Ward->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Ward->AdvancedSearch->SearchValue != "" || $this->Ward->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ExpectedResult
		if (!$this->isAddOrEdit() && $this->ExpectedResult->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ExpectedResult->AdvancedSearch->SearchValue != "" || $this->ExpectedResult->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Comments
		if (!$this->isAddOrEdit() && $this->Comments->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Comments->AdvancedSearch->SearchValue != "" || $this->Comments->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ProgressStatus
		if (!$this->isAddOrEdit() && $this->ProgressStatus->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProgressStatus->AdvancedSearch->SearchValue != "" || $this->ProgressStatus->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'DetailedActionCode' first before field var 'x_DetailedActionCode'
		$val = $CurrentForm->hasValue("DetailedActionCode") ? $CurrentForm->getValue("DetailedActionCode") : $CurrentForm->getValue("x_DetailedActionCode");
		if (!$this->DetailedActionCode->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->DetailedActionCode->setFormValue($val);

		// Check field name 'DetailedActionName' first before field var 'x_DetailedActionName'
		$val = $CurrentForm->hasValue("DetailedActionName") ? $CurrentForm->getValue("DetailedActionName") : $CurrentForm->getValue("x_DetailedActionName");
		if (!$this->DetailedActionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DetailedActionName->Visible = FALSE; // Disable update for API request
			else
				$this->DetailedActionName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DetailedActionName"))
			$this->DetailedActionName->setOldValue($CurrentForm->getValue("o_DetailedActionName"));

		// Check field name 'DetailedActionLocation' first before field var 'x_DetailedActionLocation'
		$val = $CurrentForm->hasValue("DetailedActionLocation") ? $CurrentForm->getValue("DetailedActionLocation") : $CurrentForm->getValue("x_DetailedActionLocation");
		if (!$this->DetailedActionLocation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DetailedActionLocation->Visible = FALSE; // Disable update for API request
			else
				$this->DetailedActionLocation->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DetailedActionLocation"))
			$this->DetailedActionLocation->setOldValue($CurrentForm->getValue("o_DetailedActionLocation"));

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

		// Check field name 'Ward' first before field var 'x_Ward'
		$val = $CurrentForm->hasValue("Ward") ? $CurrentForm->getValue("Ward") : $CurrentForm->getValue("x_Ward");
		if (!$this->Ward->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Ward->Visible = FALSE; // Disable update for API request
			else
				$this->Ward->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Ward"))
			$this->Ward->setOldValue($CurrentForm->getValue("o_Ward"));

		// Check field name 'ExpectedResult' first before field var 'x_ExpectedResult'
		$val = $CurrentForm->hasValue("ExpectedResult") ? $CurrentForm->getValue("ExpectedResult") : $CurrentForm->getValue("x_ExpectedResult");
		if (!$this->ExpectedResult->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExpectedResult->Visible = FALSE; // Disable update for API request
			else
				$this->ExpectedResult->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ExpectedResult"))
			$this->ExpectedResult->setOldValue($CurrentForm->getValue("o_ExpectedResult"));

		// Check field name 'Comments' first before field var 'x_Comments'
		$val = $CurrentForm->hasValue("Comments") ? $CurrentForm->getValue("Comments") : $CurrentForm->getValue("x_Comments");
		if (!$this->Comments->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Comments->Visible = FALSE; // Disable update for API request
			else
				$this->Comments->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Comments"))
			$this->Comments->setOldValue($CurrentForm->getValue("o_Comments"));

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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->ProgramCode->CurrentValue = $this->ProgramCode->FormValue;
		$this->SubProgramCode->CurrentValue = $this->SubProgramCode->FormValue;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->OutputCode->CurrentValue = $this->OutputCode->FormValue;
		$this->ActionCode->CurrentValue = $this->ActionCode->FormValue;
		$this->FinancialYear->CurrentValue = $this->FinancialYear->FormValue;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->DetailedActionCode->CurrentValue = $this->DetailedActionCode->FormValue;
		$this->DetailedActionName->CurrentValue = $this->DetailedActionName->FormValue;
		$this->DetailedActionLocation->CurrentValue = $this->DetailedActionLocation->FormValue;
		$this->PlannedStartDate->CurrentValue = $this->PlannedStartDate->FormValue;
		$this->PlannedStartDate->CurrentValue = UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0);
		$this->PlannedEndDate->CurrentValue = $this->PlannedEndDate->FormValue;
		$this->PlannedEndDate->CurrentValue = UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0);
		$this->ActualStartDate->CurrentValue = $this->ActualStartDate->FormValue;
		$this->ActualStartDate->CurrentValue = UnFormatDateTime($this->ActualStartDate->CurrentValue, 0);
		$this->ActualEndDate->CurrentValue = $this->ActualEndDate->FormValue;
		$this->ActualEndDate->CurrentValue = UnFormatDateTime($this->ActualEndDate->CurrentValue, 0);
		$this->Ward->CurrentValue = $this->Ward->FormValue;
		$this->ExpectedResult->CurrentValue = $this->ExpectedResult->FormValue;
		$this->Comments->CurrentValue = $this->Comments->FormValue;
		$this->ProgressStatus->CurrentValue = $this->ProgressStatus->FormValue;
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
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->ProgramCode->setDbValue($row['ProgramCode']);
		$this->SubProgramCode->setDbValue($row['SubProgramCode']);
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->OutputCode->setDbValue($row['OutputCode']);
		$this->ActionCode->setDbValue($row['ActionCode']);
		$this->FinancialYear->setDbValue($row['FinancialYear']);
		$this->DetailedActionCode->setDbValue($row['DetailedActionCode']);
		$this->DetailedActionName->setDbValue($row['DetailedActionName']);
		$this->DetailedActionLocation->setDbValue($row['DetailedActionLocation']);
		$this->PlannedStartDate->setDbValue($row['PlannedStartDate']);
		$this->PlannedEndDate->setDbValue($row['PlannedEndDate']);
		$this->ActualStartDate->setDbValue($row['ActualStartDate']);
		$this->ActualEndDate->setDbValue($row['ActualEndDate']);
		$this->Ward->setDbValue($row['Ward']);
		$this->ExpectedResult->setDbValue($row['ExpectedResult']);
		$this->Comments->setDbValue($row['Comments']);
		$this->ProgressStatus->setDbValue($row['ProgressStatus']);
		if (!isset($GLOBALS["budget_grid"]))
			$GLOBALS["budget_grid"] = new budget_grid();
		$detailFilter = $GLOBALS["budget"]->sqlDetailFilter_detailed_action();
		$detailFilter = str_replace("@LACode@", AdjustSql($this->LACode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@DepartmentCode@", AdjustSql($this->DepartmentCode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@FinancialYear@", AdjustSql($this->FinancialYear->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@ActionCode@", AdjustSql($this->ActionCode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@OutcomeCode@", AdjustSql($this->OutcomeCode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@OutputCode@", AdjustSql($this->OutputCode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@DetailedActionCode@", AdjustSql($this->DetailedActionCode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@ProgramCode@", AdjustSql($this->ProgramCode->DbValue, "DB"), $detailFilter);
		$detailFilter = str_replace("@SubProgramCode@", AdjustSql($this->SubProgramCode->DbValue, "DB"), $detailFilter);
		$GLOBALS["budget"]->setCurrentMasterTable("detailed_action");
		$detailFilter = $GLOBALS["budget"]->applyUserIDFilters($detailFilter);
		$this->budget_Count = $GLOBALS["budget"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['ProgramCode'] = $this->ProgramCode->CurrentValue;
		$row['SubProgramCode'] = $this->SubProgramCode->CurrentValue;
		$row['OutcomeCode'] = $this->OutcomeCode->CurrentValue;
		$row['OutputCode'] = $this->OutputCode->CurrentValue;
		$row['ActionCode'] = $this->ActionCode->CurrentValue;
		$row['FinancialYear'] = $this->FinancialYear->CurrentValue;
		$row['DetailedActionCode'] = $this->DetailedActionCode->CurrentValue;
		$row['DetailedActionName'] = $this->DetailedActionName->CurrentValue;
		$row['DetailedActionLocation'] = $this->DetailedActionLocation->CurrentValue;
		$row['PlannedStartDate'] = $this->PlannedStartDate->CurrentValue;
		$row['PlannedEndDate'] = $this->PlannedEndDate->CurrentValue;
		$row['ActualStartDate'] = $this->ActualStartDate->CurrentValue;
		$row['ActualEndDate'] = $this->ActualEndDate->CurrentValue;
		$row['Ward'] = $this->Ward->CurrentValue;
		$row['ExpectedResult'] = $this->ExpectedResult->CurrentValue;
		$row['Comments'] = $this->Comments->CurrentValue;
		$row['ProgressStatus'] = $this->ProgressStatus->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("DetailedActionCode")) != "")
			$this->DetailedActionCode->OldValue = $this->getKey("DetailedActionCode"); // DetailedActionCode
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
		// LACode
		// DepartmentCode
		// SectionCode
		// ProgramCode
		// SubProgramCode
		// OutcomeCode
		// OutputCode
		// ActionCode
		// FinancialYear
		// DetailedActionCode
		// DetailedActionName
		// DetailedActionLocation
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Ward
		// ExpectedResult
		// Comments
		// ProgressStatus

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

			// FinancialYear
			$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
			$this->FinancialYear->ViewCustomAttributes = "";

			// DetailedActionCode
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
			$this->DetailedActionCode->ViewCustomAttributes = "";

			// DetailedActionName
			$this->DetailedActionName->ViewValue = $this->DetailedActionName->CurrentValue;
			$this->DetailedActionName->ViewCustomAttributes = "";

			// DetailedActionLocation
			$this->DetailedActionLocation->ViewValue = $this->DetailedActionLocation->CurrentValue;
			$this->DetailedActionLocation->ViewCustomAttributes = "";

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

			// Ward
			$this->Ward->ViewValue = $this->Ward->CurrentValue;
			$this->Ward->ViewCustomAttributes = "";

			// ExpectedResult
			$this->ExpectedResult->ViewValue = $this->ExpectedResult->CurrentValue;
			$this->ExpectedResult->ViewCustomAttributes = "";

			// Comments
			$this->Comments->ViewValue = $this->Comments->CurrentValue;
			$this->Comments->ViewCustomAttributes = "";

			// ProgressStatus
			$curVal = strval($this->ProgressStatus->CurrentValue);
			if ($curVal != "") {
				$this->ProgressStatus->ViewValue = $this->ProgressStatus->lookupCacheOption($curVal);
				if ($this->ProgressStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

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

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";
			if (!$this->isExport())
				$this->FinancialYear->ViewValue = $this->highlightValue($this->FinancialYear);

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";
			$this->DetailedActionCode->TooltipValue = "";
			if (!$this->isExport())
				$this->DetailedActionCode->ViewValue = $this->highlightValue($this->DetailedActionCode);

			// DetailedActionName
			$this->DetailedActionName->LinkCustomAttributes = "";
			$this->DetailedActionName->HrefValue = "";
			$this->DetailedActionName->TooltipValue = "";
			if (!$this->isExport())
				$this->DetailedActionName->ViewValue = $this->highlightValue($this->DetailedActionName);

			// DetailedActionLocation
			$this->DetailedActionLocation->LinkCustomAttributes = "";
			$this->DetailedActionLocation->HrefValue = "";
			$this->DetailedActionLocation->TooltipValue = "";
			if (!$this->isExport())
				$this->DetailedActionLocation->ViewValue = $this->highlightValue($this->DetailedActionLocation);

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

			// Ward
			$this->Ward->LinkCustomAttributes = "";
			$this->Ward->HrefValue = "";
			$this->Ward->TooltipValue = "";
			if (!$this->isExport())
				$this->Ward->ViewValue = $this->highlightValue($this->Ward);

			// ExpectedResult
			$this->ExpectedResult->LinkCustomAttributes = "";
			$this->ExpectedResult->HrefValue = "";
			$this->ExpectedResult->TooltipValue = "";
			if (!$this->isExport())
				$this->ExpectedResult->ViewValue = $this->highlightValue($this->ExpectedResult);

			// Comments
			$this->Comments->LinkCustomAttributes = "";
			$this->Comments->HrefValue = "";
			$this->Comments->TooltipValue = "";
			if (!$this->isExport())
				$this->Comments->ViewValue = $this->highlightValue($this->Comments);

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";
			$this->ProgressStatus->TooltipValue = "";
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

			// ProgramCode
			$this->ProgramCode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProgramCode`" . SearchString("=", $this->ProgramCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProgramCode->EditValue = $arwrk;
				}
			}

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
					if ($this->ActionCode->ViewValue == "")
						$this->ActionCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ActionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
					} else {
						$this->ActionCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ActionCode->EditValue = $arwrk;
				}
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			if ($this->FinancialYear->getSessionValue() != "") {
				$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
				$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
				$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
				$this->FinancialYear->ViewCustomAttributes = "";
			} else {
				$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
				$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());
			}

			// DetailedActionCode
			// DetailedActionName

			$this->DetailedActionName->EditAttrs["class"] = "form-control";
			$this->DetailedActionName->EditCustomAttributes = "";
			if (!$this->DetailedActionName->Raw)
				$this->DetailedActionName->CurrentValue = HtmlDecode($this->DetailedActionName->CurrentValue);
			$this->DetailedActionName->EditValue = HtmlEncode($this->DetailedActionName->CurrentValue);
			$this->DetailedActionName->PlaceHolder = RemoveHtml($this->DetailedActionName->caption());

			// DetailedActionLocation
			$this->DetailedActionLocation->EditAttrs["class"] = "form-control";
			$this->DetailedActionLocation->EditCustomAttributes = "";
			if (!$this->DetailedActionLocation->Raw)
				$this->DetailedActionLocation->CurrentValue = HtmlDecode($this->DetailedActionLocation->CurrentValue);
			$this->DetailedActionLocation->EditValue = HtmlEncode($this->DetailedActionLocation->CurrentValue);
			$this->DetailedActionLocation->PlaceHolder = RemoveHtml($this->DetailedActionLocation->caption());

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

			// Ward
			$this->Ward->EditAttrs["class"] = "form-control";
			$this->Ward->EditCustomAttributes = "";
			if (!$this->Ward->Raw)
				$this->Ward->CurrentValue = HtmlDecode($this->Ward->CurrentValue);
			$this->Ward->EditValue = HtmlEncode($this->Ward->CurrentValue);
			$this->Ward->PlaceHolder = RemoveHtml($this->Ward->caption());

			// ExpectedResult
			$this->ExpectedResult->EditAttrs["class"] = "form-control";
			$this->ExpectedResult->EditCustomAttributes = "";
			$this->ExpectedResult->EditValue = HtmlEncode($this->ExpectedResult->CurrentValue);
			$this->ExpectedResult->PlaceHolder = RemoveHtml($this->ExpectedResult->caption());

			// Comments
			$this->Comments->EditAttrs["class"] = "form-control";
			$this->Comments->EditCustomAttributes = "";
			$this->Comments->EditValue = HtmlEncode($this->Comments->CurrentValue);
			$this->Comments->PlaceHolder = RemoveHtml($this->Comments->caption());

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
					$filterWrk = "`ProgressCode`" . SearchString("=", $this->ProgressStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProgressStatus->EditValue = $arwrk;
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

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";

			// DetailedActionName
			$this->DetailedActionName->LinkCustomAttributes = "";
			$this->DetailedActionName->HrefValue = "";

			// DetailedActionLocation
			$this->DetailedActionLocation->LinkCustomAttributes = "";
			$this->DetailedActionLocation->HrefValue = "";

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

			// Ward
			$this->Ward->LinkCustomAttributes = "";
			$this->Ward->HrefValue = "";

			// ExpectedResult
			$this->ExpectedResult->LinkCustomAttributes = "";
			$this->ExpectedResult->HrefValue = "";

			// Comments
			$this->Comments->LinkCustomAttributes = "";
			$this->Comments->HrefValue = "";

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";
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

			// ProgramCode
			$this->ProgramCode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProgramCode`" . SearchString("=", $this->ProgramCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProgramCode->EditValue = $arwrk;
				}
			}

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
					if ($this->ActionCode->ViewValue == "")
						$this->ActionCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ActionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
					} else {
						$this->ActionCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ActionCode->EditValue = $arwrk;
				}
			}

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			if ($this->FinancialYear->getSessionValue() != "") {
				$this->FinancialYear->CurrentValue = $this->FinancialYear->getSessionValue();
				$this->FinancialYear->OldValue = $this->FinancialYear->CurrentValue;
				$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
				$this->FinancialYear->ViewCustomAttributes = "";
			} else {
				$this->FinancialYear->EditValue = HtmlEncode($this->FinancialYear->CurrentValue);
				$this->FinancialYear->PlaceHolder = RemoveHtml($this->FinancialYear->caption());
			}

			// DetailedActionCode
			$this->DetailedActionCode->EditAttrs["class"] = "form-control";
			$this->DetailedActionCode->EditCustomAttributes = "";
			$this->DetailedActionCode->EditValue = $this->DetailedActionCode->CurrentValue;
			$this->DetailedActionCode->ViewCustomAttributes = "";

			// DetailedActionName
			$this->DetailedActionName->EditAttrs["class"] = "form-control";
			$this->DetailedActionName->EditCustomAttributes = "";
			if (!$this->DetailedActionName->Raw)
				$this->DetailedActionName->CurrentValue = HtmlDecode($this->DetailedActionName->CurrentValue);
			$this->DetailedActionName->EditValue = HtmlEncode($this->DetailedActionName->CurrentValue);
			$this->DetailedActionName->PlaceHolder = RemoveHtml($this->DetailedActionName->caption());

			// DetailedActionLocation
			$this->DetailedActionLocation->EditAttrs["class"] = "form-control";
			$this->DetailedActionLocation->EditCustomAttributes = "";
			if (!$this->DetailedActionLocation->Raw)
				$this->DetailedActionLocation->CurrentValue = HtmlDecode($this->DetailedActionLocation->CurrentValue);
			$this->DetailedActionLocation->EditValue = HtmlEncode($this->DetailedActionLocation->CurrentValue);
			$this->DetailedActionLocation->PlaceHolder = RemoveHtml($this->DetailedActionLocation->caption());

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

			// Ward
			$this->Ward->EditAttrs["class"] = "form-control";
			$this->Ward->EditCustomAttributes = "";
			if (!$this->Ward->Raw)
				$this->Ward->CurrentValue = HtmlDecode($this->Ward->CurrentValue);
			$this->Ward->EditValue = HtmlEncode($this->Ward->CurrentValue);
			$this->Ward->PlaceHolder = RemoveHtml($this->Ward->caption());

			// ExpectedResult
			$this->ExpectedResult->EditAttrs["class"] = "form-control";
			$this->ExpectedResult->EditCustomAttributes = "";
			$this->ExpectedResult->EditValue = HtmlEncode($this->ExpectedResult->CurrentValue);
			$this->ExpectedResult->PlaceHolder = RemoveHtml($this->ExpectedResult->caption());

			// Comments
			$this->Comments->EditAttrs["class"] = "form-control";
			$this->Comments->EditCustomAttributes = "";
			$this->Comments->EditValue = HtmlEncode($this->Comments->CurrentValue);
			$this->Comments->PlaceHolder = RemoveHtml($this->Comments->caption());

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
					$filterWrk = "`ProgressCode`" . SearchString("=", $this->ProgressStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProgressStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProgressStatus->EditValue = $arwrk;
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

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";

			// DetailedActionName
			$this->DetailedActionName->LinkCustomAttributes = "";
			$this->DetailedActionName->HrefValue = "";

			// DetailedActionLocation
			$this->DetailedActionLocation->LinkCustomAttributes = "";
			$this->DetailedActionLocation->HrefValue = "";

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

			// Ward
			$this->Ward->LinkCustomAttributes = "";
			$this->Ward->HrefValue = "";

			// ExpectedResult
			$this->ExpectedResult->LinkCustomAttributes = "";
			$this->ExpectedResult->HrefValue = "";

			// Comments
			$this->Comments->LinkCustomAttributes = "";
			$this->Comments->HrefValue = "";

			// ProgressStatus
			$this->ProgressStatus->LinkCustomAttributes = "";
			$this->ProgressStatus->HrefValue = "";
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
		if ($this->FinancialYear->Required) {
			if (!$this->FinancialYear->IsDetailKey && $this->FinancialYear->FormValue != NULL && $this->FinancialYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FinancialYear->caption(), $this->FinancialYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FinancialYear->FormValue)) {
			AddMessage($FormError, $this->FinancialYear->errorMessage());
		}
		if ($this->DetailedActionCode->Required) {
			if (!$this->DetailedActionCode->IsDetailKey && $this->DetailedActionCode->FormValue != NULL && $this->DetailedActionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DetailedActionCode->caption(), $this->DetailedActionCode->RequiredErrorMessage));
			}
		}
		if ($this->DetailedActionName->Required) {
			if (!$this->DetailedActionName->IsDetailKey && $this->DetailedActionName->FormValue != NULL && $this->DetailedActionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DetailedActionName->caption(), $this->DetailedActionName->RequiredErrorMessage));
			}
		}
		if ($this->DetailedActionLocation->Required) {
			if (!$this->DetailedActionLocation->IsDetailKey && $this->DetailedActionLocation->FormValue != NULL && $this->DetailedActionLocation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DetailedActionLocation->caption(), $this->DetailedActionLocation->RequiredErrorMessage));
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
		if ($this->Ward->Required) {
			if (!$this->Ward->IsDetailKey && $this->Ward->FormValue != NULL && $this->Ward->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Ward->caption(), $this->Ward->RequiredErrorMessage));
			}
		}
		if ($this->ExpectedResult->Required) {
			if (!$this->ExpectedResult->IsDetailKey && $this->ExpectedResult->FormValue != NULL && $this->ExpectedResult->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExpectedResult->caption(), $this->ExpectedResult->RequiredErrorMessage));
			}
		}
		if ($this->Comments->Required) {
			if (!$this->Comments->IsDetailKey && $this->Comments->FormValue != NULL && $this->Comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Comments->caption(), $this->Comments->RequiredErrorMessage));
			}
		}
		if ($this->ProgressStatus->Required) {
			if (!$this->ProgressStatus->IsDetailKey && $this->ProgressStatus->FormValue != NULL && $this->ProgressStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProgressStatus->caption(), $this->ProgressStatus->RequiredErrorMessage));
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
				$thisKey .= $row['DetailedActionCode'];
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
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, 0, $this->SectionCode->ReadOnly);

			// ProgramCode
			$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, 0, $this->ProgramCode->ReadOnly);

			// SubProgramCode
			$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, NULL, $this->SubProgramCode->ReadOnly);

			// OutcomeCode
			$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, $this->OutcomeCode->ReadOnly);

			// OutputCode
			$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, $this->OutputCode->ReadOnly);

			// ActionCode
			$this->ActionCode->setDbValueDef($rsnew, $this->ActionCode->CurrentValue, 0, $this->ActionCode->ReadOnly);

			// FinancialYear
			$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, $this->FinancialYear->ReadOnly);

			// DetailedActionName
			$this->DetailedActionName->setDbValueDef($rsnew, $this->DetailedActionName->CurrentValue, "", $this->DetailedActionName->ReadOnly);

			// DetailedActionLocation
			$this->DetailedActionLocation->setDbValueDef($rsnew, $this->DetailedActionLocation->CurrentValue, NULL, $this->DetailedActionLocation->ReadOnly);

			// PlannedStartDate
			$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), $this->PlannedStartDate->ReadOnly);

			// PlannedEndDate
			$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0), CurrentDate(), $this->PlannedEndDate->ReadOnly);

			// ActualStartDate
			$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, $this->ActualStartDate->ReadOnly);

			// ActualEndDate
			$this->ActualEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEndDate->CurrentValue, 0), NULL, $this->ActualEndDate->ReadOnly);

			// Ward
			$this->Ward->setDbValueDef($rsnew, $this->Ward->CurrentValue, NULL, $this->Ward->ReadOnly);

			// ExpectedResult
			$this->ExpectedResult->setDbValueDef($rsnew, $this->ExpectedResult->CurrentValue, "", $this->ExpectedResult->ReadOnly);

			// Comments
			$this->Comments->setDbValueDef($rsnew, $this->Comments->CurrentValue, NULL, $this->Comments->ReadOnly);

			// ProgressStatus
			$this->ProgressStatus->setDbValueDef($rsnew, $this->ProgressStatus->CurrentValue, NULL, $this->ProgressStatus->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('DepartmentCode')); // DepartmentCode
		$hash .= GetFieldHash($rs->fields('SectionCode')); // SectionCode
		$hash .= GetFieldHash($rs->fields('ProgramCode')); // ProgramCode
		$hash .= GetFieldHash($rs->fields('SubProgramCode')); // SubProgramCode
		$hash .= GetFieldHash($rs->fields('OutcomeCode')); // OutcomeCode
		$hash .= GetFieldHash($rs->fields('OutputCode')); // OutputCode
		$hash .= GetFieldHash($rs->fields('ActionCode')); // ActionCode
		$hash .= GetFieldHash($rs->fields('FinancialYear')); // FinancialYear
		$hash .= GetFieldHash($rs->fields('DetailedActionName')); // DetailedActionName
		$hash .= GetFieldHash($rs->fields('DetailedActionLocation')); // DetailedActionLocation
		$hash .= GetFieldHash($rs->fields('PlannedStartDate')); // PlannedStartDate
		$hash .= GetFieldHash($rs->fields('PlannedEndDate')); // PlannedEndDate
		$hash .= GetFieldHash($rs->fields('ActualStartDate')); // ActualStartDate
		$hash .= GetFieldHash($rs->fields('ActualEndDate')); // ActualEndDate
		$hash .= GetFieldHash($rs->fields('Ward')); // Ward
		$hash .= GetFieldHash($rs->fields('ExpectedResult')); // ExpectedResult
		$hash .= GetFieldHash($rs->fields('Comments')); // Comments
		$hash .= GetFieldHash($rs->fields('ProgressStatus')); // ProgressStatus
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

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, 0, FALSE);

		// ProgramCode
		$this->ProgramCode->setDbValueDef($rsnew, $this->ProgramCode->CurrentValue, 0, FALSE);

		// SubProgramCode
		$this->SubProgramCode->setDbValueDef($rsnew, $this->SubProgramCode->CurrentValue, NULL, FALSE);

		// OutcomeCode
		$this->OutcomeCode->setDbValueDef($rsnew, $this->OutcomeCode->CurrentValue, 0, FALSE);

		// OutputCode
		$this->OutputCode->setDbValueDef($rsnew, $this->OutputCode->CurrentValue, 0, FALSE);

		// ActionCode
		$this->ActionCode->setDbValueDef($rsnew, $this->ActionCode->CurrentValue, 0, FALSE);

		// FinancialYear
		$this->FinancialYear->setDbValueDef($rsnew, $this->FinancialYear->CurrentValue, 0, FALSE);

		// DetailedActionName
		$this->DetailedActionName->setDbValueDef($rsnew, $this->DetailedActionName->CurrentValue, "", FALSE);

		// DetailedActionLocation
		$this->DetailedActionLocation->setDbValueDef($rsnew, $this->DetailedActionLocation->CurrentValue, NULL, FALSE);

		// PlannedStartDate
		$this->PlannedStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedStartDate->CurrentValue, 0), CurrentDate(), FALSE);

		// PlannedEndDate
		$this->PlannedEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedEndDate->CurrentValue, 0), CurrentDate(), FALSE);

		// ActualStartDate
		$this->ActualStartDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualStartDate->CurrentValue, 0), NULL, FALSE);

		// ActualEndDate
		$this->ActualEndDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualEndDate->CurrentValue, 0), NULL, FALSE);

		// Ward
		$this->Ward->setDbValueDef($rsnew, $this->Ward->CurrentValue, NULL, FALSE);

		// ExpectedResult
		$this->ExpectedResult->setDbValueDef($rsnew, $this->ExpectedResult->CurrentValue, "", FALSE);

		// Comments
		$this->Comments->setDbValueDef($rsnew, $this->Comments->CurrentValue, NULL, FALSE);

		// ProgressStatus
		$this->ProgressStatus->setDbValueDef($rsnew, $this->ProgressStatus->CurrentValue, NULL, FALSE);

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
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->ProgramCode->AdvancedSearch->load();
		$this->SubProgramCode->AdvancedSearch->load();
		$this->OutcomeCode->AdvancedSearch->load();
		$this->OutputCode->AdvancedSearch->load();
		$this->ActionCode->AdvancedSearch->load();
		$this->FinancialYear->AdvancedSearch->load();
		$this->DetailedActionCode->AdvancedSearch->load();
		$this->DetailedActionName->AdvancedSearch->load();
		$this->DetailedActionLocation->AdvancedSearch->load();
		$this->PlannedStartDate->AdvancedSearch->load();
		$this->PlannedEndDate->AdvancedSearch->load();
		$this->ActualStartDate->AdvancedSearch->load();
		$this->ActualEndDate->AdvancedSearch->load();
		$this->Ward->AdvancedSearch->load();
		$this->ExpectedResult->AdvancedSearch->load();
		$this->Comments->AdvancedSearch->load();
		$this->ProgressStatus->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fdetailed_actionlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fdetailed_actionlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fdetailed_actionlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_detailed_action" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_detailed_action\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fdetailed_actionlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdetailed_actionlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"detailed_actionsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"detailed_action\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'detailed_actionsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fdetailed_actionlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "_action") {
			global $_action;
			if (!isset($_action))
				$_action = new _action();
			$rsmaster = $_action->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$_action;
					$_action->exportDocument($doc, $rsmaster);
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
			if ($masterTblVar == "_action") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["_action"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["_action"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["_action"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["_action"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["_action"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProgramCode", Get("ProgramCode"))) !== NULL) {
					$GLOBALS["_action"]->ProgramCode->setQueryStringValue($parm);
					$this->ProgramCode->setQueryStringValue($GLOBALS["_action"]->ProgramCode->QueryStringValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->QueryStringValue);
					if (!is_numeric($GLOBALS["_action"]->ProgramCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OucomeCode", Get("OutcomeCode"))) !== NULL) {
					$GLOBALS["_action"]->OucomeCode->setQueryStringValue($parm);
					$this->OutcomeCode->setQueryStringValue($GLOBALS["_action"]->OucomeCode->QueryStringValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->QueryStringValue);
					if (!is_numeric($GLOBALS["_action"]->OucomeCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OutputCode", Get("OutputCode"))) !== NULL) {
					$GLOBALS["_action"]->OutputCode->setQueryStringValue($parm);
					$this->OutputCode->setQueryStringValue($GLOBALS["_action"]->OutputCode->QueryStringValue);
					$this->OutputCode->setSessionValue($this->OutputCode->QueryStringValue);
					if (!is_numeric($GLOBALS["_action"]->OutputCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ActionCode", Get("ActionCode"))) !== NULL) {
					$GLOBALS["_action"]->ActionCode->setQueryStringValue($parm);
					$this->ActionCode->setQueryStringValue($GLOBALS["_action"]->ActionCode->QueryStringValue);
					$this->ActionCode->setSessionValue($this->ActionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["_action"]->ActionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_FinancialYear", Get("FinancialYear"))) !== NULL) {
					$GLOBALS["_action"]->FinancialYear->setQueryStringValue($parm);
					$this->FinancialYear->setQueryStringValue($GLOBALS["_action"]->FinancialYear->QueryStringValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->QueryStringValue);
					if (!is_numeric($GLOBALS["_action"]->FinancialYear->QueryStringValue))
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
			if ($masterTblVar == "_action") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["_action"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["_action"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["_action"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["_action"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["_action"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProgramCode", Post("ProgramCode"))) !== NULL) {
					$GLOBALS["_action"]->ProgramCode->setFormValue($parm);
					$this->ProgramCode->setFormValue($GLOBALS["_action"]->ProgramCode->FormValue);
					$this->ProgramCode->setSessionValue($this->ProgramCode->FormValue);
					if (!is_numeric($GLOBALS["_action"]->ProgramCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OucomeCode", Post("OutcomeCode"))) !== NULL) {
					$GLOBALS["_action"]->OucomeCode->setFormValue($parm);
					$this->OutcomeCode->setFormValue($GLOBALS["_action"]->OucomeCode->FormValue);
					$this->OutcomeCode->setSessionValue($this->OutcomeCode->FormValue);
					if (!is_numeric($GLOBALS["_action"]->OucomeCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OutputCode", Post("OutputCode"))) !== NULL) {
					$GLOBALS["_action"]->OutputCode->setFormValue($parm);
					$this->OutputCode->setFormValue($GLOBALS["_action"]->OutputCode->FormValue);
					$this->OutputCode->setSessionValue($this->OutputCode->FormValue);
					if (!is_numeric($GLOBALS["_action"]->OutputCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ActionCode", Post("ActionCode"))) !== NULL) {
					$GLOBALS["_action"]->ActionCode->setFormValue($parm);
					$this->ActionCode->setFormValue($GLOBALS["_action"]->ActionCode->FormValue);
					$this->ActionCode->setSessionValue($this->ActionCode->FormValue);
					if (!is_numeric($GLOBALS["_action"]->ActionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_FinancialYear", Post("FinancialYear"))) !== NULL) {
					$GLOBALS["_action"]->FinancialYear->setFormValue($parm);
					$this->FinancialYear->setFormValue($GLOBALS["_action"]->FinancialYear->FormValue);
					$this->FinancialYear->setSessionValue($this->FinancialYear->FormValue);
					if (!is_numeric($GLOBALS["_action"]->FinancialYear->FormValue))
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
			if ($masterTblVar != "_action") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->ProgramCode->CurrentValue == "")
					$this->ProgramCode->setSessionValue("");
				if ($this->OutcomeCode->CurrentValue == "")
					$this->OutcomeCode->setSessionValue("");
				if ($this->OutputCode->CurrentValue == "")
					$this->OutputCode->setSessionValue("");
				if ($this->ActionCode->CurrentValue == "")
					$this->ActionCode->setSessionValue("");
				if ($this->FinancialYear->CurrentValue == "")
					$this->FinancialYear->setSessionValue("");
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
				case "x_OutcomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ActionCode":
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
						case "x_OutcomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ActionCode":
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