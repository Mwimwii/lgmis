<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class income_type_list extends income_type
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'income_type';

	// Page object name
	public $PageObjName = "income_type_list";

	// Grid form hidden field names
	public $FormName = "fincome_typelist";
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

		// Table object (income_type)
		if (!isset($GLOBALS["income_type"]) || get_class($GLOBALS["income_type"]) == PROJECT_NAMESPACE . "income_type") {
			$GLOBALS["income_type"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["income_type"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "income_typeadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "income_typedelete.php";
		$this->MultiUpdateUrl = "income_typeupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'income_type');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fincome_typelistsrch";

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
		global $income_type;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($income_type);
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
			$key .= @$ar['IncomeCode'];
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
			$this->IncomeCode->Visible = FALSE;
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
		$this->IncomeCode->setVisibility();
		$this->IncomeName->setVisibility();
		$this->IncomeDescription->setVisibility();
		$this->Division->setVisibility();
		$this->IncomeAmount->setVisibility();
		$this->IncomeBasicRate->setVisibility();
		$this->BaseIncomeCode->setVisibility();
		$this->Taxable->setVisibility();
		$this->AccountNo->setVisibility();
		$this->JobIncluded->setVisibility();
		$this->Application->setVisibility();
		$this->JobExcluded->setVisibility();
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
		$this->setupLookupOptions($this->Division);
		$this->setupLookupOptions($this->BaseIncomeCode);
		$this->setupLookupOptions($this->Taxable);
		$this->setupLookupOptions($this->AccountNo);
		$this->setupLookupOptions($this->JobIncluded);
		$this->setupLookupOptions($this->Application);
		$this->setupLookupOptions($this->JobExcluded);

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
		$this->IncomeAmount->FormValue = ""; // Clear form value
		$this->IncomeBasicRate->FormValue = ""; // Clear form value
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
			$this->IncomeCode->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->IncomeCode->OldValue))
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
					$key .= $this->IncomeCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_IncomeName") && $CurrentForm->hasValue("o_IncomeName") && $this->IncomeName->CurrentValue != $this->IncomeName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IncomeDescription") && $CurrentForm->hasValue("o_IncomeDescription") && $this->IncomeDescription->CurrentValue != $this->IncomeDescription->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Division") && $CurrentForm->hasValue("o_Division") && $this->Division->CurrentValue != $this->Division->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IncomeAmount") && $CurrentForm->hasValue("o_IncomeAmount") && $this->IncomeAmount->CurrentValue != $this->IncomeAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_IncomeBasicRate") && $CurrentForm->hasValue("o_IncomeBasicRate") && $this->IncomeBasicRate->CurrentValue != $this->IncomeBasicRate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BaseIncomeCode") && $CurrentForm->hasValue("o_BaseIncomeCode") && $this->BaseIncomeCode->CurrentValue != $this->BaseIncomeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Taxable") && $CurrentForm->hasValue("o_Taxable") && $this->Taxable->CurrentValue != $this->Taxable->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountNo") && $CurrentForm->hasValue("o_AccountNo") && $this->AccountNo->CurrentValue != $this->AccountNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_JobIncluded") && $CurrentForm->hasValue("o_JobIncluded") && $this->JobIncluded->CurrentValue != $this->JobIncluded->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Application") && $CurrentForm->hasValue("o_Application") && $this->Application->CurrentValue != $this->Application->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_JobExcluded") && $CurrentForm->hasValue("o_JobExcluded") && $this->JobExcluded->CurrentValue != $this->JobExcluded->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fincome_typelistsrch");
		$filterList = Concat($filterList, $this->IncomeCode->AdvancedSearch->toJson(), ","); // Field IncomeCode
		$filterList = Concat($filterList, $this->IncomeName->AdvancedSearch->toJson(), ","); // Field IncomeName
		$filterList = Concat($filterList, $this->IncomeDescription->AdvancedSearch->toJson(), ","); // Field IncomeDescription
		$filterList = Concat($filterList, $this->Division->AdvancedSearch->toJson(), ","); // Field Division
		$filterList = Concat($filterList, $this->IncomeAmount->AdvancedSearch->toJson(), ","); // Field IncomeAmount
		$filterList = Concat($filterList, $this->IncomeBasicRate->AdvancedSearch->toJson(), ","); // Field IncomeBasicRate
		$filterList = Concat($filterList, $this->BaseIncomeCode->AdvancedSearch->toJson(), ","); // Field BaseIncomeCode
		$filterList = Concat($filterList, $this->Taxable->AdvancedSearch->toJson(), ","); // Field Taxable
		$filterList = Concat($filterList, $this->AccountNo->AdvancedSearch->toJson(), ","); // Field AccountNo
		$filterList = Concat($filterList, $this->JobIncluded->AdvancedSearch->toJson(), ","); // Field JobIncluded
		$filterList = Concat($filterList, $this->Application->AdvancedSearch->toJson(), ","); // Field Application
		$filterList = Concat($filterList, $this->JobExcluded->AdvancedSearch->toJson(), ","); // Field JobExcluded
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fincome_typelistsrch", $filters);
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

		// Field IncomeCode
		$this->IncomeCode->AdvancedSearch->SearchValue = @$filter["x_IncomeCode"];
		$this->IncomeCode->AdvancedSearch->SearchOperator = @$filter["z_IncomeCode"];
		$this->IncomeCode->AdvancedSearch->SearchCondition = @$filter["v_IncomeCode"];
		$this->IncomeCode->AdvancedSearch->SearchValue2 = @$filter["y_IncomeCode"];
		$this->IncomeCode->AdvancedSearch->SearchOperator2 = @$filter["w_IncomeCode"];
		$this->IncomeCode->AdvancedSearch->save();

		// Field IncomeName
		$this->IncomeName->AdvancedSearch->SearchValue = @$filter["x_IncomeName"];
		$this->IncomeName->AdvancedSearch->SearchOperator = @$filter["z_IncomeName"];
		$this->IncomeName->AdvancedSearch->SearchCondition = @$filter["v_IncomeName"];
		$this->IncomeName->AdvancedSearch->SearchValue2 = @$filter["y_IncomeName"];
		$this->IncomeName->AdvancedSearch->SearchOperator2 = @$filter["w_IncomeName"];
		$this->IncomeName->AdvancedSearch->save();

		// Field IncomeDescription
		$this->IncomeDescription->AdvancedSearch->SearchValue = @$filter["x_IncomeDescription"];
		$this->IncomeDescription->AdvancedSearch->SearchOperator = @$filter["z_IncomeDescription"];
		$this->IncomeDescription->AdvancedSearch->SearchCondition = @$filter["v_IncomeDescription"];
		$this->IncomeDescription->AdvancedSearch->SearchValue2 = @$filter["y_IncomeDescription"];
		$this->IncomeDescription->AdvancedSearch->SearchOperator2 = @$filter["w_IncomeDescription"];
		$this->IncomeDescription->AdvancedSearch->save();

		// Field Division
		$this->Division->AdvancedSearch->SearchValue = @$filter["x_Division"];
		$this->Division->AdvancedSearch->SearchOperator = @$filter["z_Division"];
		$this->Division->AdvancedSearch->SearchCondition = @$filter["v_Division"];
		$this->Division->AdvancedSearch->SearchValue2 = @$filter["y_Division"];
		$this->Division->AdvancedSearch->SearchOperator2 = @$filter["w_Division"];
		$this->Division->AdvancedSearch->save();

		// Field IncomeAmount
		$this->IncomeAmount->AdvancedSearch->SearchValue = @$filter["x_IncomeAmount"];
		$this->IncomeAmount->AdvancedSearch->SearchOperator = @$filter["z_IncomeAmount"];
		$this->IncomeAmount->AdvancedSearch->SearchCondition = @$filter["v_IncomeAmount"];
		$this->IncomeAmount->AdvancedSearch->SearchValue2 = @$filter["y_IncomeAmount"];
		$this->IncomeAmount->AdvancedSearch->SearchOperator2 = @$filter["w_IncomeAmount"];
		$this->IncomeAmount->AdvancedSearch->save();

		// Field IncomeBasicRate
		$this->IncomeBasicRate->AdvancedSearch->SearchValue = @$filter["x_IncomeBasicRate"];
		$this->IncomeBasicRate->AdvancedSearch->SearchOperator = @$filter["z_IncomeBasicRate"];
		$this->IncomeBasicRate->AdvancedSearch->SearchCondition = @$filter["v_IncomeBasicRate"];
		$this->IncomeBasicRate->AdvancedSearch->SearchValue2 = @$filter["y_IncomeBasicRate"];
		$this->IncomeBasicRate->AdvancedSearch->SearchOperator2 = @$filter["w_IncomeBasicRate"];
		$this->IncomeBasicRate->AdvancedSearch->save();

		// Field BaseIncomeCode
		$this->BaseIncomeCode->AdvancedSearch->SearchValue = @$filter["x_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchOperator = @$filter["z_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchCondition = @$filter["v_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchValue2 = @$filter["y_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchOperator2 = @$filter["w_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->save();

		// Field Taxable
		$this->Taxable->AdvancedSearch->SearchValue = @$filter["x_Taxable"];
		$this->Taxable->AdvancedSearch->SearchOperator = @$filter["z_Taxable"];
		$this->Taxable->AdvancedSearch->SearchCondition = @$filter["v_Taxable"];
		$this->Taxable->AdvancedSearch->SearchValue2 = @$filter["y_Taxable"];
		$this->Taxable->AdvancedSearch->SearchOperator2 = @$filter["w_Taxable"];
		$this->Taxable->AdvancedSearch->save();

		// Field AccountNo
		$this->AccountNo->AdvancedSearch->SearchValue = @$filter["x_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchOperator = @$filter["z_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchCondition = @$filter["v_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchValue2 = @$filter["y_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchOperator2 = @$filter["w_AccountNo"];
		$this->AccountNo->AdvancedSearch->save();

		// Field JobIncluded
		$this->JobIncluded->AdvancedSearch->SearchValue = @$filter["x_JobIncluded"];
		$this->JobIncluded->AdvancedSearch->SearchOperator = @$filter["z_JobIncluded"];
		$this->JobIncluded->AdvancedSearch->SearchCondition = @$filter["v_JobIncluded"];
		$this->JobIncluded->AdvancedSearch->SearchValue2 = @$filter["y_JobIncluded"];
		$this->JobIncluded->AdvancedSearch->SearchOperator2 = @$filter["w_JobIncluded"];
		$this->JobIncluded->AdvancedSearch->save();

		// Field Application
		$this->Application->AdvancedSearch->SearchValue = @$filter["x_Application"];
		$this->Application->AdvancedSearch->SearchOperator = @$filter["z_Application"];
		$this->Application->AdvancedSearch->SearchCondition = @$filter["v_Application"];
		$this->Application->AdvancedSearch->SearchValue2 = @$filter["y_Application"];
		$this->Application->AdvancedSearch->SearchOperator2 = @$filter["w_Application"];
		$this->Application->AdvancedSearch->save();

		// Field JobExcluded
		$this->JobExcluded->AdvancedSearch->SearchValue = @$filter["x_JobExcluded"];
		$this->JobExcluded->AdvancedSearch->SearchOperator = @$filter["z_JobExcluded"];
		$this->JobExcluded->AdvancedSearch->SearchCondition = @$filter["v_JobExcluded"];
		$this->JobExcluded->AdvancedSearch->SearchValue2 = @$filter["y_JobExcluded"];
		$this->JobExcluded->AdvancedSearch->SearchOperator2 = @$filter["w_JobExcluded"];
		$this->JobExcluded->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->IncomeCode, $default, FALSE); // IncomeCode
		$this->buildSearchSql($where, $this->IncomeName, $default, FALSE); // IncomeName
		$this->buildSearchSql($where, $this->IncomeDescription, $default, FALSE); // IncomeDescription
		$this->buildSearchSql($where, $this->Division, $default, TRUE); // Division
		$this->buildSearchSql($where, $this->IncomeAmount, $default, FALSE); // IncomeAmount
		$this->buildSearchSql($where, $this->IncomeBasicRate, $default, FALSE); // IncomeBasicRate
		$this->buildSearchSql($where, $this->BaseIncomeCode, $default, FALSE); // BaseIncomeCode
		$this->buildSearchSql($where, $this->Taxable, $default, FALSE); // Taxable
		$this->buildSearchSql($where, $this->AccountNo, $default, FALSE); // AccountNo
		$this->buildSearchSql($where, $this->JobIncluded, $default, TRUE); // JobIncluded
		$this->buildSearchSql($where, $this->Application, $default, FALSE); // Application
		$this->buildSearchSql($where, $this->JobExcluded, $default, TRUE); // JobExcluded

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->IncomeCode->AdvancedSearch->save(); // IncomeCode
			$this->IncomeName->AdvancedSearch->save(); // IncomeName
			$this->IncomeDescription->AdvancedSearch->save(); // IncomeDescription
			$this->Division->AdvancedSearch->save(); // Division
			$this->IncomeAmount->AdvancedSearch->save(); // IncomeAmount
			$this->IncomeBasicRate->AdvancedSearch->save(); // IncomeBasicRate
			$this->BaseIncomeCode->AdvancedSearch->save(); // BaseIncomeCode
			$this->Taxable->AdvancedSearch->save(); // Taxable
			$this->AccountNo->AdvancedSearch->save(); // AccountNo
			$this->JobIncluded->AdvancedSearch->save(); // JobIncluded
			$this->Application->AdvancedSearch->save(); // Application
			$this->JobExcluded->AdvancedSearch->save(); // JobExcluded
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
		$this->buildBasicSearchSql($where, $this->IncomeCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->IncomeName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->IncomeDescription, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Division, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->BaseIncomeCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AccountNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->JobIncluded, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->JobExcluded, $arKeywords, $type);
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
		if ($this->IncomeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IncomeName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IncomeDescription->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Division->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IncomeAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->IncomeBasicRate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BaseIncomeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Taxable->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AccountNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->JobIncluded->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Application->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->JobExcluded->AdvancedSearch->issetSession())
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
		$this->IncomeCode->AdvancedSearch->unsetSession();
		$this->IncomeName->AdvancedSearch->unsetSession();
		$this->IncomeDescription->AdvancedSearch->unsetSession();
		$this->Division->AdvancedSearch->unsetSession();
		$this->IncomeAmount->AdvancedSearch->unsetSession();
		$this->IncomeBasicRate->AdvancedSearch->unsetSession();
		$this->BaseIncomeCode->AdvancedSearch->unsetSession();
		$this->Taxable->AdvancedSearch->unsetSession();
		$this->AccountNo->AdvancedSearch->unsetSession();
		$this->JobIncluded->AdvancedSearch->unsetSession();
		$this->Application->AdvancedSearch->unsetSession();
		$this->JobExcluded->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->IncomeCode->AdvancedSearch->load();
		$this->IncomeName->AdvancedSearch->load();
		$this->IncomeDescription->AdvancedSearch->load();
		$this->Division->AdvancedSearch->load();
		$this->IncomeAmount->AdvancedSearch->load();
		$this->IncomeBasicRate->AdvancedSearch->load();
		$this->BaseIncomeCode->AdvancedSearch->load();
		$this->Taxable->AdvancedSearch->load();
		$this->AccountNo->AdvancedSearch->load();
		$this->JobIncluded->AdvancedSearch->load();
		$this->Application->AdvancedSearch->load();
		$this->JobExcluded->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->IncomeCode); // IncomeCode
			$this->updateSort($this->IncomeName); // IncomeName
			$this->updateSort($this->IncomeDescription); // IncomeDescription
			$this->updateSort($this->Division); // Division
			$this->updateSort($this->IncomeAmount); // IncomeAmount
			$this->updateSort($this->IncomeBasicRate); // IncomeBasicRate
			$this->updateSort($this->BaseIncomeCode); // BaseIncomeCode
			$this->updateSort($this->Taxable); // Taxable
			$this->updateSort($this->AccountNo); // AccountNo
			$this->updateSort($this->JobIncluded); // JobIncluded
			$this->updateSort($this->Application); // Application
			$this->updateSort($this->JobExcluded); // JobExcluded
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
				$this->IncomeCode->setSort("");
				$this->IncomeName->setSort("");
				$this->IncomeDescription->setSort("");
				$this->Division->setSort("");
				$this->IncomeAmount->setSort("");
				$this->IncomeBasicRate->setSort("");
				$this->BaseIncomeCode->setSort("");
				$this->Taxable->setSort("");
				$this->AccountNo->setSort("");
				$this->JobIncluded->setSort("");
				$this->Application->setSort("");
				$this->JobExcluded->setSort("");
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

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->IncomeCode->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->IncomeCode->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fincome_typelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fincome_typelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fincome_typelist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->IncomeCode->CurrentValue = NULL;
		$this->IncomeCode->OldValue = $this->IncomeCode->CurrentValue;
		$this->IncomeName->CurrentValue = NULL;
		$this->IncomeName->OldValue = $this->IncomeName->CurrentValue;
		$this->IncomeDescription->CurrentValue = NULL;
		$this->IncomeDescription->OldValue = $this->IncomeDescription->CurrentValue;
		$this->Division->CurrentValue = NULL;
		$this->Division->OldValue = $this->Division->CurrentValue;
		$this->IncomeAmount->CurrentValue = 0;
		$this->IncomeAmount->OldValue = $this->IncomeAmount->CurrentValue;
		$this->IncomeBasicRate->CurrentValue = 0;
		$this->IncomeBasicRate->OldValue = $this->IncomeBasicRate->CurrentValue;
		$this->BaseIncomeCode->CurrentValue = "'001'";
		$this->BaseIncomeCode->OldValue = $this->BaseIncomeCode->CurrentValue;
		$this->Taxable->CurrentValue = NULL;
		$this->Taxable->OldValue = $this->Taxable->CurrentValue;
		$this->AccountNo->CurrentValue = NULL;
		$this->AccountNo->OldValue = $this->AccountNo->CurrentValue;
		$this->JobIncluded->CurrentValue = NULL;
		$this->JobIncluded->OldValue = $this->JobIncluded->CurrentValue;
		$this->Application->CurrentValue = NULL;
		$this->Application->OldValue = $this->Application->CurrentValue;
		$this->JobExcluded->CurrentValue = NULL;
		$this->JobExcluded->OldValue = $this->JobExcluded->CurrentValue;
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

		// IncomeCode
		if (!$this->isAddOrEdit() && $this->IncomeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncomeCode->AdvancedSearch->SearchValue != "" || $this->IncomeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IncomeName
		if (!$this->isAddOrEdit() && $this->IncomeName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncomeName->AdvancedSearch->SearchValue != "" || $this->IncomeName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IncomeDescription
		if (!$this->isAddOrEdit() && $this->IncomeDescription->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncomeDescription->AdvancedSearch->SearchValue != "" || $this->IncomeDescription->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Division
		if (!$this->isAddOrEdit() && $this->Division->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Division->AdvancedSearch->SearchValue != "" || $this->Division->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->Division->AdvancedSearch->SearchValue))
			$this->Division->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Division->AdvancedSearch->SearchValue);
		if (is_array($this->Division->AdvancedSearch->SearchValue2))
			$this->Division->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Division->AdvancedSearch->SearchValue2);

		// IncomeAmount
		if (!$this->isAddOrEdit() && $this->IncomeAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncomeAmount->AdvancedSearch->SearchValue != "" || $this->IncomeAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// IncomeBasicRate
		if (!$this->isAddOrEdit() && $this->IncomeBasicRate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->IncomeBasicRate->AdvancedSearch->SearchValue != "" || $this->IncomeBasicRate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BaseIncomeCode
		if (!$this->isAddOrEdit() && $this->BaseIncomeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BaseIncomeCode->AdvancedSearch->SearchValue != "" || $this->BaseIncomeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Taxable
		if (!$this->isAddOrEdit() && $this->Taxable->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Taxable->AdvancedSearch->SearchValue != "" || $this->Taxable->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AccountNo
		if (!$this->isAddOrEdit() && $this->AccountNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AccountNo->AdvancedSearch->SearchValue != "" || $this->AccountNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// JobIncluded
		if (!$this->isAddOrEdit() && $this->JobIncluded->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->JobIncluded->AdvancedSearch->SearchValue != "" || $this->JobIncluded->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->JobIncluded->AdvancedSearch->SearchValue))
			$this->JobIncluded->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobIncluded->AdvancedSearch->SearchValue);
		if (is_array($this->JobIncluded->AdvancedSearch->SearchValue2))
			$this->JobIncluded->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobIncluded->AdvancedSearch->SearchValue2);

		// Application
		if (!$this->isAddOrEdit() && $this->Application->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Application->AdvancedSearch->SearchValue != "" || $this->Application->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// JobExcluded
		if (!$this->isAddOrEdit() && $this->JobExcluded->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->JobExcluded->AdvancedSearch->SearchValue != "" || $this->JobExcluded->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->JobExcluded->AdvancedSearch->SearchValue))
			$this->JobExcluded->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobExcluded->AdvancedSearch->SearchValue);
		if (is_array($this->JobExcluded->AdvancedSearch->SearchValue2))
			$this->JobExcluded->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobExcluded->AdvancedSearch->SearchValue2);
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'IncomeCode' first before field var 'x_IncomeCode'
		$val = $CurrentForm->hasValue("IncomeCode") ? $CurrentForm->getValue("IncomeCode") : $CurrentForm->getValue("x_IncomeCode");
		if (!$this->IncomeCode->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->IncomeCode->setFormValue($val);

		// Check field name 'IncomeName' first before field var 'x_IncomeName'
		$val = $CurrentForm->hasValue("IncomeName") ? $CurrentForm->getValue("IncomeName") : $CurrentForm->getValue("x_IncomeName");
		if (!$this->IncomeName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeName->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IncomeName"))
			$this->IncomeName->setOldValue($CurrentForm->getValue("o_IncomeName"));

		// Check field name 'IncomeDescription' first before field var 'x_IncomeDescription'
		$val = $CurrentForm->hasValue("IncomeDescription") ? $CurrentForm->getValue("IncomeDescription") : $CurrentForm->getValue("x_IncomeDescription");
		if (!$this->IncomeDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeDescription->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeDescription->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IncomeDescription"))
			$this->IncomeDescription->setOldValue($CurrentForm->getValue("o_IncomeDescription"));

		// Check field name 'Division' first before field var 'x_Division'
		$val = $CurrentForm->hasValue("Division") ? $CurrentForm->getValue("Division") : $CurrentForm->getValue("x_Division");
		if (!$this->Division->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Division->Visible = FALSE; // Disable update for API request
			else
				$this->Division->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Division"))
			$this->Division->setOldValue($CurrentForm->getValue("o_Division"));

		// Check field name 'IncomeAmount' first before field var 'x_IncomeAmount'
		$val = $CurrentForm->hasValue("IncomeAmount") ? $CurrentForm->getValue("IncomeAmount") : $CurrentForm->getValue("x_IncomeAmount");
		if (!$this->IncomeAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeAmount->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IncomeAmount"))
			$this->IncomeAmount->setOldValue($CurrentForm->getValue("o_IncomeAmount"));

		// Check field name 'IncomeBasicRate' first before field var 'x_IncomeBasicRate'
		$val = $CurrentForm->hasValue("IncomeBasicRate") ? $CurrentForm->getValue("IncomeBasicRate") : $CurrentForm->getValue("x_IncomeBasicRate");
		if (!$this->IncomeBasicRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeBasicRate->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeBasicRate->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_IncomeBasicRate"))
			$this->IncomeBasicRate->setOldValue($CurrentForm->getValue("o_IncomeBasicRate"));

		// Check field name 'BaseIncomeCode' first before field var 'x_BaseIncomeCode'
		$val = $CurrentForm->hasValue("BaseIncomeCode") ? $CurrentForm->getValue("BaseIncomeCode") : $CurrentForm->getValue("x_BaseIncomeCode");
		if (!$this->BaseIncomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BaseIncomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->BaseIncomeCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BaseIncomeCode"))
			$this->BaseIncomeCode->setOldValue($CurrentForm->getValue("o_BaseIncomeCode"));

		// Check field name 'Taxable' first before field var 'x_Taxable'
		$val = $CurrentForm->hasValue("Taxable") ? $CurrentForm->getValue("Taxable") : $CurrentForm->getValue("x_Taxable");
		if (!$this->Taxable->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Taxable->Visible = FALSE; // Disable update for API request
			else
				$this->Taxable->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Taxable"))
			$this->Taxable->setOldValue($CurrentForm->getValue("o_Taxable"));

		// Check field name 'AccountNo' first before field var 'x_AccountNo'
		$val = $CurrentForm->hasValue("AccountNo") ? $CurrentForm->getValue("AccountNo") : $CurrentForm->getValue("x_AccountNo");
		if (!$this->AccountNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountNo->Visible = FALSE; // Disable update for API request
			else
				$this->AccountNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AccountNo"))
			$this->AccountNo->setOldValue($CurrentForm->getValue("o_AccountNo"));

		// Check field name 'JobIncluded' first before field var 'x_JobIncluded'
		$val = $CurrentForm->hasValue("JobIncluded") ? $CurrentForm->getValue("JobIncluded") : $CurrentForm->getValue("x_JobIncluded");
		if (!$this->JobIncluded->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobIncluded->Visible = FALSE; // Disable update for API request
			else
				$this->JobIncluded->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_JobIncluded"))
			$this->JobIncluded->setOldValue($CurrentForm->getValue("o_JobIncluded"));

		// Check field name 'Application' first before field var 'x_Application'
		$val = $CurrentForm->hasValue("Application") ? $CurrentForm->getValue("Application") : $CurrentForm->getValue("x_Application");
		if (!$this->Application->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Application->Visible = FALSE; // Disable update for API request
			else
				$this->Application->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Application"))
			$this->Application->setOldValue($CurrentForm->getValue("o_Application"));

		// Check field name 'JobExcluded' first before field var 'x_JobExcluded'
		$val = $CurrentForm->hasValue("JobExcluded") ? $CurrentForm->getValue("JobExcluded") : $CurrentForm->getValue("x_JobExcluded");
		if (!$this->JobExcluded->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobExcluded->Visible = FALSE; // Disable update for API request
			else
				$this->JobExcluded->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_JobExcluded"))
			$this->JobExcluded->setOldValue($CurrentForm->getValue("o_JobExcluded"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->IncomeCode->CurrentValue = $this->IncomeCode->FormValue;
		$this->IncomeName->CurrentValue = $this->IncomeName->FormValue;
		$this->IncomeDescription->CurrentValue = $this->IncomeDescription->FormValue;
		$this->Division->CurrentValue = $this->Division->FormValue;
		$this->IncomeAmount->CurrentValue = $this->IncomeAmount->FormValue;
		$this->IncomeBasicRate->CurrentValue = $this->IncomeBasicRate->FormValue;
		$this->BaseIncomeCode->CurrentValue = $this->BaseIncomeCode->FormValue;
		$this->Taxable->CurrentValue = $this->Taxable->FormValue;
		$this->AccountNo->CurrentValue = $this->AccountNo->FormValue;
		$this->JobIncluded->CurrentValue = $this->JobIncluded->FormValue;
		$this->Application->CurrentValue = $this->Application->FormValue;
		$this->JobExcluded->CurrentValue = $this->JobExcluded->FormValue;
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
		$this->IncomeCode->setDbValue($row['IncomeCode']);
		$this->IncomeName->setDbValue($row['IncomeName']);
		$this->IncomeDescription->setDbValue($row['IncomeDescription']);
		$this->Division->setDbValue($row['Division']);
		$this->IncomeAmount->setDbValue($row['IncomeAmount']);
		$this->IncomeBasicRate->setDbValue($row['IncomeBasicRate']);
		$this->BaseIncomeCode->setDbValue($row['BaseIncomeCode']);
		$this->Taxable->setDbValue($row['Taxable']);
		$this->AccountNo->setDbValue($row['AccountNo']);
		$this->JobIncluded->setDbValue($row['JobIncluded']);
		$this->Application->setDbValue($row['Application']);
		$this->JobExcluded->setDbValue($row['JobExcluded']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['IncomeCode'] = $this->IncomeCode->CurrentValue;
		$row['IncomeName'] = $this->IncomeName->CurrentValue;
		$row['IncomeDescription'] = $this->IncomeDescription->CurrentValue;
		$row['Division'] = $this->Division->CurrentValue;
		$row['IncomeAmount'] = $this->IncomeAmount->CurrentValue;
		$row['IncomeBasicRate'] = $this->IncomeBasicRate->CurrentValue;
		$row['BaseIncomeCode'] = $this->BaseIncomeCode->CurrentValue;
		$row['Taxable'] = $this->Taxable->CurrentValue;
		$row['AccountNo'] = $this->AccountNo->CurrentValue;
		$row['JobIncluded'] = $this->JobIncluded->CurrentValue;
		$row['Application'] = $this->Application->CurrentValue;
		$row['JobExcluded'] = $this->JobExcluded->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("IncomeCode")) != "")
			$this->IncomeCode->OldValue = $this->getKey("IncomeCode"); // IncomeCode
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
		if ($this->IncomeAmount->FormValue == $this->IncomeAmount->CurrentValue && is_numeric(ConvertToFloatString($this->IncomeAmount->CurrentValue)))
			$this->IncomeAmount->CurrentValue = ConvertToFloatString($this->IncomeAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->IncomeBasicRate->FormValue == $this->IncomeBasicRate->CurrentValue && is_numeric(ConvertToFloatString($this->IncomeBasicRate->CurrentValue)))
			$this->IncomeBasicRate->CurrentValue = ConvertToFloatString($this->IncomeBasicRate->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// IncomeCode
		// IncomeName
		// IncomeDescription
		// Division
		// IncomeAmount
		// IncomeBasicRate
		// BaseIncomeCode
		// Taxable
		// AccountNo
		// JobIncluded
		// Application
		// JobExcluded

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IncomeCode
			$this->IncomeCode->ViewValue = $this->IncomeCode->CurrentValue;
			$this->IncomeCode->ViewCustomAttributes = "";

			// IncomeName
			$this->IncomeName->ViewValue = $this->IncomeName->CurrentValue;
			$this->IncomeName->ViewCustomAttributes = "";

			// IncomeDescription
			$this->IncomeDescription->ViewValue = $this->IncomeDescription->CurrentValue;
			$this->IncomeDescription->ViewCustomAttributes = "";

			// Division
			$curVal = strval($this->Division->CurrentValue);
			if ($curVal != "") {
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
				if ($this->Division->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->Division->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->Division->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Division->ViewValue->add($this->Division->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->Division->ViewValue = $this->Division->CurrentValue;
					}
				}
			} else {
				$this->Division->ViewValue = NULL;
			}
			$this->Division->ViewCustomAttributes = "";

			// IncomeAmount
			$this->IncomeAmount->ViewValue = $this->IncomeAmount->CurrentValue;
			$this->IncomeAmount->ViewValue = FormatNumber($this->IncomeAmount->ViewValue, 2, -2, -2, -2);
			$this->IncomeAmount->ViewCustomAttributes = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->ViewValue = $this->IncomeBasicRate->CurrentValue;
			$this->IncomeBasicRate->ViewValue = FormatNumber($this->IncomeBasicRate->ViewValue, 2, -2, -2, -2);
			$this->IncomeBasicRate->ViewCustomAttributes = "";

			// BaseIncomeCode
			$curVal = strval($this->BaseIncomeCode->CurrentValue);
			if ($curVal != "") {
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
				if ($this->BaseIncomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IncomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->CurrentValue;
					}
				}
			} else {
				$this->BaseIncomeCode->ViewValue = NULL;
			}
			$this->BaseIncomeCode->ViewCustomAttributes = "";

			// Taxable
			$curVal = strval($this->Taxable->CurrentValue);
			if ($curVal != "") {
				$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
				if ($this->Taxable->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Taxable->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Taxable->ViewValue = $this->Taxable->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Taxable->ViewValue = $this->Taxable->CurrentValue;
					}
				}
			} else {
				$this->Taxable->ViewValue = NULL;
			}
			$this->Taxable->ViewCustomAttributes = "";

			// AccountNo
			$curVal = strval($this->AccountNo->CurrentValue);
			if ($curVal != "") {
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
				if ($this->AccountNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
					}
				}
			} else {
				$this->AccountNo->ViewValue = NULL;
			}
			$this->AccountNo->ViewCustomAttributes = "";

			// JobIncluded
			$curVal = strval($this->JobIncluded->CurrentValue);
			if ($curVal != "") {
				$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
				if ($this->JobIncluded->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobIncluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobIncluded->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobIncluded->ViewValue = $this->JobIncluded->CurrentValue;
					}
				}
			} else {
				$this->JobIncluded->ViewValue = NULL;
			}
			$this->JobIncluded->ViewCustomAttributes = "";

			// Application
			$curVal = strval($this->Application->CurrentValue);
			if ($curVal != "") {
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
				if ($this->Application->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Application->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Application->ViewValue = $this->Application->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Application->ViewValue = $this->Application->CurrentValue;
					}
				}
			} else {
				$this->Application->ViewValue = NULL;
			}
			$this->Application->ViewCustomAttributes = "";

			// JobExcluded
			$curVal = strval($this->JobExcluded->CurrentValue);
			if ($curVal != "") {
				$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
				if ($this->JobExcluded->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobExcluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobExcluded->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobExcluded->ViewValue = $this->JobExcluded->CurrentValue;
					}
				}
			} else {
				$this->JobExcluded->ViewValue = NULL;
			}
			$this->JobExcluded->ViewCustomAttributes = "";

			// IncomeCode
			$this->IncomeCode->LinkCustomAttributes = "";
			$this->IncomeCode->HrefValue = "";
			$this->IncomeCode->TooltipValue = "";
			if (!$this->isExport())
				$this->IncomeCode->ViewValue = $this->highlightValue($this->IncomeCode);

			// IncomeName
			$this->IncomeName->LinkCustomAttributes = "";
			$this->IncomeName->HrefValue = "";
			$this->IncomeName->TooltipValue = "";
			if (!$this->isExport())
				$this->IncomeName->ViewValue = $this->highlightValue($this->IncomeName);

			// IncomeDescription
			$this->IncomeDescription->LinkCustomAttributes = "";
			$this->IncomeDescription->HrefValue = "";
			$this->IncomeDescription->TooltipValue = "";
			if (!$this->isExport())
				$this->IncomeDescription->ViewValue = $this->highlightValue($this->IncomeDescription);

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";
			$this->Division->TooltipValue = "";

			// IncomeAmount
			$this->IncomeAmount->LinkCustomAttributes = "";
			$this->IncomeAmount->HrefValue = "";
			$this->IncomeAmount->TooltipValue = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->LinkCustomAttributes = "";
			$this->IncomeBasicRate->HrefValue = "";
			$this->IncomeBasicRate->TooltipValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";
			$this->BaseIncomeCode->TooltipValue = "";

			// Taxable
			$this->Taxable->LinkCustomAttributes = "";
			$this->Taxable->HrefValue = "";
			$this->Taxable->TooltipValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";
			$this->AccountNo->TooltipValue = "";

			// JobIncluded
			$this->JobIncluded->LinkCustomAttributes = "";
			$this->JobIncluded->HrefValue = "";
			$this->JobIncluded->TooltipValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
			$this->Application->TooltipValue = "";

			// JobExcluded
			$this->JobExcluded->LinkCustomAttributes = "";
			$this->JobExcluded->HrefValue = "";
			$this->JobExcluded->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// IncomeCode
			// IncomeName

			$this->IncomeName->EditAttrs["class"] = "form-control";
			$this->IncomeName->EditCustomAttributes = "";
			if (!$this->IncomeName->Raw)
				$this->IncomeName->CurrentValue = HtmlDecode($this->IncomeName->CurrentValue);
			$this->IncomeName->EditValue = HtmlEncode($this->IncomeName->CurrentValue);
			$this->IncomeName->PlaceHolder = RemoveHtml($this->IncomeName->caption());

			// IncomeDescription
			$this->IncomeDescription->EditAttrs["class"] = "form-control";
			$this->IncomeDescription->EditCustomAttributes = "";
			if (!$this->IncomeDescription->Raw)
				$this->IncomeDescription->CurrentValue = HtmlDecode($this->IncomeDescription->CurrentValue);
			$this->IncomeDescription->EditValue = HtmlEncode($this->IncomeDescription->CurrentValue);
			$this->IncomeDescription->PlaceHolder = RemoveHtml($this->IncomeDescription->caption());

			// Division
			$this->Division->EditCustomAttributes = "";
			$curVal = trim(strval($this->Division->CurrentValue));
			if ($curVal != "")
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
			else
				$this->Division->ViewValue = $this->Division->Lookup !== NULL && is_array($this->Division->Lookup->Options) ? $curVal : NULL;
			if ($this->Division->ViewValue !== NULL) { // Load from cache
				$this->Division->EditValue = array_values($this->Division->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->Division->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Division->EditValue = $arwrk;
			}

			// IncomeAmount
			$this->IncomeAmount->EditAttrs["class"] = "form-control";
			$this->IncomeAmount->EditCustomAttributes = "";
			$this->IncomeAmount->EditValue = HtmlEncode($this->IncomeAmount->CurrentValue);
			$this->IncomeAmount->PlaceHolder = RemoveHtml($this->IncomeAmount->caption());
			if (strval($this->IncomeAmount->EditValue) != "" && is_numeric($this->IncomeAmount->EditValue)) {
				$this->IncomeAmount->EditValue = FormatNumber($this->IncomeAmount->EditValue, -2, -2, -2, -2);
				$this->IncomeAmount->OldValue = $this->IncomeAmount->EditValue;
			}
			

			// IncomeBasicRate
			$this->IncomeBasicRate->EditAttrs["class"] = "form-control";
			$this->IncomeBasicRate->EditCustomAttributes = "";
			$this->IncomeBasicRate->EditValue = HtmlEncode($this->IncomeBasicRate->CurrentValue);
			$this->IncomeBasicRate->PlaceHolder = RemoveHtml($this->IncomeBasicRate->caption());
			if (strval($this->IncomeBasicRate->EditValue) != "" && is_numeric($this->IncomeBasicRate->EditValue)) {
				$this->IncomeBasicRate->EditValue = FormatNumber($this->IncomeBasicRate->EditValue, -2, -2, -2, -2);
				$this->IncomeBasicRate->OldValue = $this->IncomeBasicRate->EditValue;
			}
			

			// BaseIncomeCode
			$this->BaseIncomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseIncomeCode->CurrentValue));
			if ($curVal != "")
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			else
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->Lookup !== NULL && is_array($this->BaseIncomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseIncomeCode->ViewValue !== NULL) { // Load from cache
				$this->BaseIncomeCode->EditValue = array_values($this->BaseIncomeCode->Lookup->Options);
				if ($this->BaseIncomeCode->ViewValue == "")
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IncomeCode`" . SearchString("=", $this->BaseIncomeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
				} else {
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseIncomeCode->EditValue = $arwrk;
			}

			// Taxable
			$this->Taxable->EditAttrs["class"] = "form-control";
			$this->Taxable->EditCustomAttributes = "";
			$curVal = trim(strval($this->Taxable->CurrentValue));
			if ($curVal != "")
				$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
			else
				$this->Taxable->ViewValue = $this->Taxable->Lookup !== NULL && is_array($this->Taxable->Lookup->Options) ? $curVal : NULL;
			if ($this->Taxable->ViewValue !== NULL) { // Load from cache
				$this->Taxable->EditValue = array_values($this->Taxable->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Taxable->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Taxable->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Taxable->EditValue = $arwrk;
			}

			// AccountNo
			$this->AccountNo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountNo->CurrentValue));
			if ($curVal != "")
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			else
				$this->AccountNo->ViewValue = $this->AccountNo->Lookup !== NULL && is_array($this->AccountNo->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountNo->ViewValue !== NULL) { // Load from cache
				$this->AccountNo->EditValue = array_values($this->AccountNo->Lookup->Options);
				if ($this->AccountNo->ViewValue == "")
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountNo->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
				} else {
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountNo->EditValue = $arwrk;
			}

			// JobIncluded
			$this->JobIncluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobIncluded->CurrentValue));
			if ($curVal != "")
				$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
			else
				$this->JobIncluded->ViewValue = $this->JobIncluded->Lookup !== NULL && is_array($this->JobIncluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobIncluded->ViewValue !== NULL) { // Load from cache
				$this->JobIncluded->EditValue = array_values($this->JobIncluded->Lookup->Options);
				if ($this->JobIncluded->ViewValue == "")
					$this->JobIncluded->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobIncluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobIncluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobIncluded->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobIncluded->EditValue = $arwrk;
			}

			// Application
			$this->Application->EditAttrs["class"] = "form-control";
			$this->Application->EditCustomAttributes = "";
			$curVal = trim(strval($this->Application->CurrentValue));
			if ($curVal != "")
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
			else
				$this->Application->ViewValue = $this->Application->Lookup !== NULL && is_array($this->Application->Lookup->Options) ? $curVal : NULL;
			if ($this->Application->ViewValue !== NULL) { // Load from cache
				$this->Application->EditValue = array_values($this->Application->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Application->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Application->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Application->EditValue = $arwrk;
			}

			// JobExcluded
			$this->JobExcluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobExcluded->CurrentValue));
			if ($curVal != "")
				$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
			else
				$this->JobExcluded->ViewValue = $this->JobExcluded->Lookup !== NULL && is_array($this->JobExcluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobExcluded->ViewValue !== NULL) { // Load from cache
				$this->JobExcluded->EditValue = array_values($this->JobExcluded->Lookup->Options);
				if ($this->JobExcluded->ViewValue == "")
					$this->JobExcluded->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobExcluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobExcluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobExcluded->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobExcluded->EditValue = $arwrk;
			}

			// Add refer script
			// IncomeCode

			$this->IncomeCode->LinkCustomAttributes = "";
			$this->IncomeCode->HrefValue = "";

			// IncomeName
			$this->IncomeName->LinkCustomAttributes = "";
			$this->IncomeName->HrefValue = "";

			// IncomeDescription
			$this->IncomeDescription->LinkCustomAttributes = "";
			$this->IncomeDescription->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// IncomeAmount
			$this->IncomeAmount->LinkCustomAttributes = "";
			$this->IncomeAmount->HrefValue = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->LinkCustomAttributes = "";
			$this->IncomeBasicRate->HrefValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";

			// Taxable
			$this->Taxable->LinkCustomAttributes = "";
			$this->Taxable->HrefValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";

			// JobIncluded
			$this->JobIncluded->LinkCustomAttributes = "";
			$this->JobIncluded->HrefValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";

			// JobExcluded
			$this->JobExcluded->LinkCustomAttributes = "";
			$this->JobExcluded->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// IncomeCode
			$this->IncomeCode->EditAttrs["class"] = "form-control";
			$this->IncomeCode->EditCustomAttributes = "";
			$this->IncomeCode->EditValue = $this->IncomeCode->CurrentValue;
			$this->IncomeCode->ViewCustomAttributes = "";

			// IncomeName
			$this->IncomeName->EditAttrs["class"] = "form-control";
			$this->IncomeName->EditCustomAttributes = "";
			if (!$this->IncomeName->Raw)
				$this->IncomeName->CurrentValue = HtmlDecode($this->IncomeName->CurrentValue);
			$this->IncomeName->EditValue = HtmlEncode($this->IncomeName->CurrentValue);
			$this->IncomeName->PlaceHolder = RemoveHtml($this->IncomeName->caption());

			// IncomeDescription
			$this->IncomeDescription->EditAttrs["class"] = "form-control";
			$this->IncomeDescription->EditCustomAttributes = "";
			if (!$this->IncomeDescription->Raw)
				$this->IncomeDescription->CurrentValue = HtmlDecode($this->IncomeDescription->CurrentValue);
			$this->IncomeDescription->EditValue = HtmlEncode($this->IncomeDescription->CurrentValue);
			$this->IncomeDescription->PlaceHolder = RemoveHtml($this->IncomeDescription->caption());

			// Division
			$this->Division->EditCustomAttributes = "";
			$curVal = trim(strval($this->Division->CurrentValue));
			if ($curVal != "")
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
			else
				$this->Division->ViewValue = $this->Division->Lookup !== NULL && is_array($this->Division->Lookup->Options) ? $curVal : NULL;
			if ($this->Division->ViewValue !== NULL) { // Load from cache
				$this->Division->EditValue = array_values($this->Division->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->Division->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Division->EditValue = $arwrk;
			}

			// IncomeAmount
			$this->IncomeAmount->EditAttrs["class"] = "form-control";
			$this->IncomeAmount->EditCustomAttributes = "";
			$this->IncomeAmount->EditValue = HtmlEncode($this->IncomeAmount->CurrentValue);
			$this->IncomeAmount->PlaceHolder = RemoveHtml($this->IncomeAmount->caption());
			if (strval($this->IncomeAmount->EditValue) != "" && is_numeric($this->IncomeAmount->EditValue)) {
				$this->IncomeAmount->EditValue = FormatNumber($this->IncomeAmount->EditValue, -2, -2, -2, -2);
				$this->IncomeAmount->OldValue = $this->IncomeAmount->EditValue;
			}
			

			// IncomeBasicRate
			$this->IncomeBasicRate->EditAttrs["class"] = "form-control";
			$this->IncomeBasicRate->EditCustomAttributes = "";
			$this->IncomeBasicRate->EditValue = HtmlEncode($this->IncomeBasicRate->CurrentValue);
			$this->IncomeBasicRate->PlaceHolder = RemoveHtml($this->IncomeBasicRate->caption());
			if (strval($this->IncomeBasicRate->EditValue) != "" && is_numeric($this->IncomeBasicRate->EditValue)) {
				$this->IncomeBasicRate->EditValue = FormatNumber($this->IncomeBasicRate->EditValue, -2, -2, -2, -2);
				$this->IncomeBasicRate->OldValue = $this->IncomeBasicRate->EditValue;
			}
			

			// BaseIncomeCode
			$this->BaseIncomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseIncomeCode->CurrentValue));
			if ($curVal != "")
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			else
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->Lookup !== NULL && is_array($this->BaseIncomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseIncomeCode->ViewValue !== NULL) { // Load from cache
				$this->BaseIncomeCode->EditValue = array_values($this->BaseIncomeCode->Lookup->Options);
				if ($this->BaseIncomeCode->ViewValue == "")
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IncomeCode`" . SearchString("=", $this->BaseIncomeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
				} else {
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseIncomeCode->EditValue = $arwrk;
			}

			// Taxable
			$this->Taxable->EditAttrs["class"] = "form-control";
			$this->Taxable->EditCustomAttributes = "";
			$curVal = trim(strval($this->Taxable->CurrentValue));
			if ($curVal != "")
				$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
			else
				$this->Taxable->ViewValue = $this->Taxable->Lookup !== NULL && is_array($this->Taxable->Lookup->Options) ? $curVal : NULL;
			if ($this->Taxable->ViewValue !== NULL) { // Load from cache
				$this->Taxable->EditValue = array_values($this->Taxable->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Taxable->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Taxable->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Taxable->EditValue = $arwrk;
			}

			// AccountNo
			$this->AccountNo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountNo->CurrentValue));
			if ($curVal != "")
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			else
				$this->AccountNo->ViewValue = $this->AccountNo->Lookup !== NULL && is_array($this->AccountNo->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountNo->ViewValue !== NULL) { // Load from cache
				$this->AccountNo->EditValue = array_values($this->AccountNo->Lookup->Options);
				if ($this->AccountNo->ViewValue == "")
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountNo->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
				} else {
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountNo->EditValue = $arwrk;
			}

			// JobIncluded
			$this->JobIncluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobIncluded->CurrentValue));
			if ($curVal != "")
				$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
			else
				$this->JobIncluded->ViewValue = $this->JobIncluded->Lookup !== NULL && is_array($this->JobIncluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobIncluded->ViewValue !== NULL) { // Load from cache
				$this->JobIncluded->EditValue = array_values($this->JobIncluded->Lookup->Options);
				if ($this->JobIncluded->ViewValue == "")
					$this->JobIncluded->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobIncluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobIncluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobIncluded->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobIncluded->EditValue = $arwrk;
			}

			// Application
			$this->Application->EditAttrs["class"] = "form-control";
			$this->Application->EditCustomAttributes = "";
			$curVal = trim(strval($this->Application->CurrentValue));
			if ($curVal != "")
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
			else
				$this->Application->ViewValue = $this->Application->Lookup !== NULL && is_array($this->Application->Lookup->Options) ? $curVal : NULL;
			if ($this->Application->ViewValue !== NULL) { // Load from cache
				$this->Application->EditValue = array_values($this->Application->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Application->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Application->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Application->EditValue = $arwrk;
			}

			// JobExcluded
			$this->JobExcluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobExcluded->CurrentValue));
			if ($curVal != "")
				$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
			else
				$this->JobExcluded->ViewValue = $this->JobExcluded->Lookup !== NULL && is_array($this->JobExcluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobExcluded->ViewValue !== NULL) { // Load from cache
				$this->JobExcluded->EditValue = array_values($this->JobExcluded->Lookup->Options);
				if ($this->JobExcluded->ViewValue == "")
					$this->JobExcluded->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobExcluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobExcluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobExcluded->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobExcluded->EditValue = $arwrk;
			}

			// Edit refer script
			// IncomeCode

			$this->IncomeCode->LinkCustomAttributes = "";
			$this->IncomeCode->HrefValue = "";

			// IncomeName
			$this->IncomeName->LinkCustomAttributes = "";
			$this->IncomeName->HrefValue = "";

			// IncomeDescription
			$this->IncomeDescription->LinkCustomAttributes = "";
			$this->IncomeDescription->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// IncomeAmount
			$this->IncomeAmount->LinkCustomAttributes = "";
			$this->IncomeAmount->HrefValue = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->LinkCustomAttributes = "";
			$this->IncomeBasicRate->HrefValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";

			// Taxable
			$this->Taxable->LinkCustomAttributes = "";
			$this->Taxable->HrefValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";

			// JobIncluded
			$this->JobIncluded->LinkCustomAttributes = "";
			$this->JobIncluded->HrefValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";

			// JobExcluded
			$this->JobExcluded->LinkCustomAttributes = "";
			$this->JobExcluded->HrefValue = "";
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
		if ($this->IncomeCode->Required) {
			if (!$this->IncomeCode->IsDetailKey && $this->IncomeCode->FormValue != NULL && $this->IncomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeCode->caption(), $this->IncomeCode->RequiredErrorMessage));
			}
		}
		if ($this->IncomeName->Required) {
			if (!$this->IncomeName->IsDetailKey && $this->IncomeName->FormValue != NULL && $this->IncomeName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeName->caption(), $this->IncomeName->RequiredErrorMessage));
			}
		}
		if ($this->IncomeDescription->Required) {
			if (!$this->IncomeDescription->IsDetailKey && $this->IncomeDescription->FormValue != NULL && $this->IncomeDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeDescription->caption(), $this->IncomeDescription->RequiredErrorMessage));
			}
		}
		if ($this->Division->Required) {
			if ($this->Division->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Division->caption(), $this->Division->RequiredErrorMessage));
			}
		}
		if ($this->IncomeAmount->Required) {
			if (!$this->IncomeAmount->IsDetailKey && $this->IncomeAmount->FormValue != NULL && $this->IncomeAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeAmount->caption(), $this->IncomeAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->IncomeAmount->FormValue)) {
			AddMessage($FormError, $this->IncomeAmount->errorMessage());
		}
		if ($this->IncomeBasicRate->Required) {
			if (!$this->IncomeBasicRate->IsDetailKey && $this->IncomeBasicRate->FormValue != NULL && $this->IncomeBasicRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeBasicRate->caption(), $this->IncomeBasicRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->IncomeBasicRate->FormValue)) {
			AddMessage($FormError, $this->IncomeBasicRate->errorMessage());
		}
		if ($this->BaseIncomeCode->Required) {
			if (!$this->BaseIncomeCode->IsDetailKey && $this->BaseIncomeCode->FormValue != NULL && $this->BaseIncomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BaseIncomeCode->caption(), $this->BaseIncomeCode->RequiredErrorMessage));
			}
		}
		if ($this->Taxable->Required) {
			if (!$this->Taxable->IsDetailKey && $this->Taxable->FormValue != NULL && $this->Taxable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Taxable->caption(), $this->Taxable->RequiredErrorMessage));
			}
		}
		if ($this->AccountNo->Required) {
			if (!$this->AccountNo->IsDetailKey && $this->AccountNo->FormValue != NULL && $this->AccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountNo->caption(), $this->AccountNo->RequiredErrorMessage));
			}
		}
		if ($this->JobIncluded->Required) {
			if ($this->JobIncluded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobIncluded->caption(), $this->JobIncluded->RequiredErrorMessage));
			}
		}
		if ($this->Application->Required) {
			if (!$this->Application->IsDetailKey && $this->Application->FormValue != NULL && $this->Application->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Application->caption(), $this->Application->RequiredErrorMessage));
			}
		}
		if ($this->JobExcluded->Required) {
			if ($this->JobExcluded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobExcluded->caption(), $this->JobExcluded->RequiredErrorMessage));
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
				$thisKey .= $row['IncomeCode'];
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

			// IncomeName
			$this->IncomeName->setDbValueDef($rsnew, $this->IncomeName->CurrentValue, "", $this->IncomeName->ReadOnly);

			// IncomeDescription
			$this->IncomeDescription->setDbValueDef($rsnew, $this->IncomeDescription->CurrentValue, NULL, $this->IncomeDescription->ReadOnly);

			// Division
			$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, NULL, $this->Division->ReadOnly);

			// IncomeAmount
			$this->IncomeAmount->setDbValueDef($rsnew, $this->IncomeAmount->CurrentValue, NULL, $this->IncomeAmount->ReadOnly);

			// IncomeBasicRate
			$this->IncomeBasicRate->setDbValueDef($rsnew, $this->IncomeBasicRate->CurrentValue, NULL, $this->IncomeBasicRate->ReadOnly);

			// BaseIncomeCode
			$this->BaseIncomeCode->setDbValueDef($rsnew, $this->BaseIncomeCode->CurrentValue, NULL, $this->BaseIncomeCode->ReadOnly);

			// Taxable
			$this->Taxable->setDbValueDef($rsnew, $this->Taxable->CurrentValue, 0, $this->Taxable->ReadOnly);

			// AccountNo
			$this->AccountNo->setDbValueDef($rsnew, $this->AccountNo->CurrentValue, NULL, $this->AccountNo->ReadOnly);

			// JobIncluded
			$this->JobIncluded->setDbValueDef($rsnew, $this->JobIncluded->CurrentValue, NULL, $this->JobIncluded->ReadOnly);

			// Application
			$this->Application->setDbValueDef($rsnew, $this->Application->CurrentValue, NULL, $this->Application->ReadOnly);

			// JobExcluded
			$this->JobExcluded->setDbValueDef($rsnew, $this->JobExcluded->CurrentValue, NULL, $this->JobExcluded->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('IncomeName')); // IncomeName
		$hash .= GetFieldHash($rs->fields('IncomeDescription')); // IncomeDescription
		$hash .= GetFieldHash($rs->fields('Division')); // Division
		$hash .= GetFieldHash($rs->fields('IncomeAmount')); // IncomeAmount
		$hash .= GetFieldHash($rs->fields('IncomeBasicRate')); // IncomeBasicRate
		$hash .= GetFieldHash($rs->fields('BaseIncomeCode')); // BaseIncomeCode
		$hash .= GetFieldHash($rs->fields('Taxable')); // Taxable
		$hash .= GetFieldHash($rs->fields('AccountNo')); // AccountNo
		$hash .= GetFieldHash($rs->fields('JobIncluded')); // JobIncluded
		$hash .= GetFieldHash($rs->fields('Application')); // Application
		$hash .= GetFieldHash($rs->fields('JobExcluded')); // JobExcluded
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

		// IncomeName
		$this->IncomeName->setDbValueDef($rsnew, $this->IncomeName->CurrentValue, "", FALSE);

		// IncomeDescription
		$this->IncomeDescription->setDbValueDef($rsnew, $this->IncomeDescription->CurrentValue, NULL, FALSE);

		// Division
		$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, NULL, FALSE);

		// IncomeAmount
		$this->IncomeAmount->setDbValueDef($rsnew, $this->IncomeAmount->CurrentValue, NULL, strval($this->IncomeAmount->CurrentValue) == "");

		// IncomeBasicRate
		$this->IncomeBasicRate->setDbValueDef($rsnew, $this->IncomeBasicRate->CurrentValue, NULL, strval($this->IncomeBasicRate->CurrentValue) == "");

		// BaseIncomeCode
		$this->BaseIncomeCode->setDbValueDef($rsnew, $this->BaseIncomeCode->CurrentValue, NULL, FALSE);

		// Taxable
		$this->Taxable->setDbValueDef($rsnew, $this->Taxable->CurrentValue, 0, strval($this->Taxable->CurrentValue) == "");

		// AccountNo
		$this->AccountNo->setDbValueDef($rsnew, $this->AccountNo->CurrentValue, NULL, FALSE);

		// JobIncluded
		$this->JobIncluded->setDbValueDef($rsnew, $this->JobIncluded->CurrentValue, NULL, FALSE);

		// Application
		$this->Application->setDbValueDef($rsnew, $this->Application->CurrentValue, NULL, FALSE);

		// JobExcluded
		$this->JobExcluded->setDbValueDef($rsnew, $this->JobExcluded->CurrentValue, NULL, FALSE);

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
		$this->IncomeCode->AdvancedSearch->load();
		$this->IncomeName->AdvancedSearch->load();
		$this->IncomeDescription->AdvancedSearch->load();
		$this->Division->AdvancedSearch->load();
		$this->IncomeAmount->AdvancedSearch->load();
		$this->IncomeBasicRate->AdvancedSearch->load();
		$this->BaseIncomeCode->AdvancedSearch->load();
		$this->Taxable->AdvancedSearch->load();
		$this->AccountNo->AdvancedSearch->load();
		$this->JobIncluded->AdvancedSearch->load();
		$this->Application->AdvancedSearch->load();
		$this->JobExcluded->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fincome_typelist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fincome_typelist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fincome_typelist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_income_type" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_income_type\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fincome_typelist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fincome_typelistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"income_typesrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"income_type\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'income_typesrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fincome_typelistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
				case "x_Division":
					break;
				case "x_BaseIncomeCode":
					break;
				case "x_Taxable":
					break;
				case "x_AccountNo":
					break;
				case "x_JobIncluded":
					break;
				case "x_Application":
					break;
				case "x_JobExcluded":
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
						case "x_Division":
							break;
						case "x_BaseIncomeCode":
							break;
						case "x_Taxable":
							break;
						case "x_AccountNo":
							break;
						case "x_JobIncluded":
							break;
						case "x_Application":
							break;
						case "x_JobExcluded":
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