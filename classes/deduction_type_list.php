<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class deduction_type_list extends deduction_type
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'deduction_type';

	// Page object name
	public $PageObjName = "deduction_type_list";

	// Grid form hidden field names
	public $FormName = "fdeduction_typelist";
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

		// Table object (deduction_type)
		if (!isset($GLOBALS["deduction_type"]) || get_class($GLOBALS["deduction_type"]) == PROJECT_NAMESPACE . "deduction_type") {
			$GLOBALS["deduction_type"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["deduction_type"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "deduction_typeadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "deduction_typedelete.php";
		$this->MultiUpdateUrl = "deduction_typeupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'deduction_type');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fdeduction_typelistsrch";

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
		global $deduction_type;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($deduction_type);
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
			$key .= @$ar['DeductionCode'];
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
			$this->DeductionCode->Visible = FALSE;
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
		$this->DeductionCode->setVisibility();
		$this->DeductionName->setVisibility();
		$this->DeductionDescription->setVisibility();
		$this->Division->setVisibility();
		$this->DeductionAmount->setVisibility();
		$this->DeductionBasicRate->setVisibility();
		$this->RemittedTo->setVisibility();
		$this->AccountNo->setVisibility();
		$this->BaseIncomeCode->setVisibility();
		$this->BaseDeductionCode->setVisibility();
		$this->TaxExempt->setVisibility();
		$this->JobCode->setVisibility();
		$this->MinimumAmount->setVisibility();
		$this->MaximumAmount->setVisibility();
		$this->EmployerContributionRate->setVisibility();
		$this->EmployerContributionAmount->setVisibility();
		$this->Application->setVisibility();
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
		$this->setupLookupOptions($this->AccountNo);
		$this->setupLookupOptions($this->BaseIncomeCode);
		$this->setupLookupOptions($this->BaseDeductionCode);
		$this->setupLookupOptions($this->TaxExempt);
		$this->setupLookupOptions($this->JobCode);
		$this->setupLookupOptions($this->Application);

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
		$this->DeductionAmount->FormValue = ""; // Clear form value
		$this->DeductionBasicRate->FormValue = ""; // Clear form value
		$this->MinimumAmount->FormValue = ""; // Clear form value
		$this->MaximumAmount->FormValue = ""; // Clear form value
		$this->EmployerContributionRate->FormValue = ""; // Clear form value
		$this->EmployerContributionAmount->FormValue = ""; // Clear form value
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
			$this->DeductionCode->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->DeductionCode->OldValue))
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
					$key .= $this->DeductionCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_DeductionName") && $CurrentForm->hasValue("o_DeductionName") && $this->DeductionName->CurrentValue != $this->DeductionName->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeductionDescription") && $CurrentForm->hasValue("o_DeductionDescription") && $this->DeductionDescription->CurrentValue != $this->DeductionDescription->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Division") && $CurrentForm->hasValue("o_Division") && $this->Division->CurrentValue != $this->Division->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeductionAmount") && $CurrentForm->hasValue("o_DeductionAmount") && $this->DeductionAmount->CurrentValue != $this->DeductionAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DeductionBasicRate") && $CurrentForm->hasValue("o_DeductionBasicRate") && $this->DeductionBasicRate->CurrentValue != $this->DeductionBasicRate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_RemittedTo") && $CurrentForm->hasValue("o_RemittedTo") && $this->RemittedTo->CurrentValue != $this->RemittedTo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AccountNo") && $CurrentForm->hasValue("o_AccountNo") && $this->AccountNo->CurrentValue != $this->AccountNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BaseIncomeCode") && $CurrentForm->hasValue("o_BaseIncomeCode") && $this->BaseIncomeCode->CurrentValue != $this->BaseIncomeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BaseDeductionCode") && $CurrentForm->hasValue("o_BaseDeductionCode") && $this->BaseDeductionCode->CurrentValue != $this->BaseDeductionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_TaxExempt") && $CurrentForm->hasValue("o_TaxExempt") && $this->TaxExempt->CurrentValue != $this->TaxExempt->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_JobCode") && $CurrentForm->hasValue("o_JobCode") && $this->JobCode->CurrentValue != $this->JobCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MinimumAmount") && $CurrentForm->hasValue("o_MinimumAmount") && $this->MinimumAmount->CurrentValue != $this->MinimumAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_MaximumAmount") && $CurrentForm->hasValue("o_MaximumAmount") && $this->MaximumAmount->CurrentValue != $this->MaximumAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EmployerContributionRate") && $CurrentForm->hasValue("o_EmployerContributionRate") && $this->EmployerContributionRate->CurrentValue != $this->EmployerContributionRate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_EmployerContributionAmount") && $CurrentForm->hasValue("o_EmployerContributionAmount") && $this->EmployerContributionAmount->CurrentValue != $this->EmployerContributionAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Application") && $CurrentForm->hasValue("o_Application") && $this->Application->CurrentValue != $this->Application->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fdeduction_typelistsrch");
		$filterList = Concat($filterList, $this->DeductionCode->AdvancedSearch->toJson(), ","); // Field DeductionCode
		$filterList = Concat($filterList, $this->DeductionName->AdvancedSearch->toJson(), ","); // Field DeductionName
		$filterList = Concat($filterList, $this->DeductionDescription->AdvancedSearch->toJson(), ","); // Field DeductionDescription
		$filterList = Concat($filterList, $this->Division->AdvancedSearch->toJson(), ","); // Field Division
		$filterList = Concat($filterList, $this->DeductionAmount->AdvancedSearch->toJson(), ","); // Field DeductionAmount
		$filterList = Concat($filterList, $this->DeductionBasicRate->AdvancedSearch->toJson(), ","); // Field DeductionBasicRate
		$filterList = Concat($filterList, $this->RemittedTo->AdvancedSearch->toJson(), ","); // Field RemittedTo
		$filterList = Concat($filterList, $this->AccountNo->AdvancedSearch->toJson(), ","); // Field AccountNo
		$filterList = Concat($filterList, $this->BaseIncomeCode->AdvancedSearch->toJson(), ","); // Field BaseIncomeCode
		$filterList = Concat($filterList, $this->BaseDeductionCode->AdvancedSearch->toJson(), ","); // Field BaseDeductionCode
		$filterList = Concat($filterList, $this->TaxExempt->AdvancedSearch->toJson(), ","); // Field TaxExempt
		$filterList = Concat($filterList, $this->JobCode->AdvancedSearch->toJson(), ","); // Field JobCode
		$filterList = Concat($filterList, $this->MinimumAmount->AdvancedSearch->toJson(), ","); // Field MinimumAmount
		$filterList = Concat($filterList, $this->MaximumAmount->AdvancedSearch->toJson(), ","); // Field MaximumAmount
		$filterList = Concat($filterList, $this->EmployerContributionRate->AdvancedSearch->toJson(), ","); // Field EmployerContributionRate
		$filterList = Concat($filterList, $this->EmployerContributionAmount->AdvancedSearch->toJson(), ","); // Field EmployerContributionAmount
		$filterList = Concat($filterList, $this->Application->AdvancedSearch->toJson(), ","); // Field Application
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fdeduction_typelistsrch", $filters);
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

		// Field DeductionCode
		$this->DeductionCode->AdvancedSearch->SearchValue = @$filter["x_DeductionCode"];
		$this->DeductionCode->AdvancedSearch->SearchOperator = @$filter["z_DeductionCode"];
		$this->DeductionCode->AdvancedSearch->SearchCondition = @$filter["v_DeductionCode"];
		$this->DeductionCode->AdvancedSearch->SearchValue2 = @$filter["y_DeductionCode"];
		$this->DeductionCode->AdvancedSearch->SearchOperator2 = @$filter["w_DeductionCode"];
		$this->DeductionCode->AdvancedSearch->save();

		// Field DeductionName
		$this->DeductionName->AdvancedSearch->SearchValue = @$filter["x_DeductionName"];
		$this->DeductionName->AdvancedSearch->SearchOperator = @$filter["z_DeductionName"];
		$this->DeductionName->AdvancedSearch->SearchCondition = @$filter["v_DeductionName"];
		$this->DeductionName->AdvancedSearch->SearchValue2 = @$filter["y_DeductionName"];
		$this->DeductionName->AdvancedSearch->SearchOperator2 = @$filter["w_DeductionName"];
		$this->DeductionName->AdvancedSearch->save();

		// Field DeductionDescription
		$this->DeductionDescription->AdvancedSearch->SearchValue = @$filter["x_DeductionDescription"];
		$this->DeductionDescription->AdvancedSearch->SearchOperator = @$filter["z_DeductionDescription"];
		$this->DeductionDescription->AdvancedSearch->SearchCondition = @$filter["v_DeductionDescription"];
		$this->DeductionDescription->AdvancedSearch->SearchValue2 = @$filter["y_DeductionDescription"];
		$this->DeductionDescription->AdvancedSearch->SearchOperator2 = @$filter["w_DeductionDescription"];
		$this->DeductionDescription->AdvancedSearch->save();

		// Field Division
		$this->Division->AdvancedSearch->SearchValue = @$filter["x_Division"];
		$this->Division->AdvancedSearch->SearchOperator = @$filter["z_Division"];
		$this->Division->AdvancedSearch->SearchCondition = @$filter["v_Division"];
		$this->Division->AdvancedSearch->SearchValue2 = @$filter["y_Division"];
		$this->Division->AdvancedSearch->SearchOperator2 = @$filter["w_Division"];
		$this->Division->AdvancedSearch->save();

		// Field DeductionAmount
		$this->DeductionAmount->AdvancedSearch->SearchValue = @$filter["x_DeductionAmount"];
		$this->DeductionAmount->AdvancedSearch->SearchOperator = @$filter["z_DeductionAmount"];
		$this->DeductionAmount->AdvancedSearch->SearchCondition = @$filter["v_DeductionAmount"];
		$this->DeductionAmount->AdvancedSearch->SearchValue2 = @$filter["y_DeductionAmount"];
		$this->DeductionAmount->AdvancedSearch->SearchOperator2 = @$filter["w_DeductionAmount"];
		$this->DeductionAmount->AdvancedSearch->save();

		// Field DeductionBasicRate
		$this->DeductionBasicRate->AdvancedSearch->SearchValue = @$filter["x_DeductionBasicRate"];
		$this->DeductionBasicRate->AdvancedSearch->SearchOperator = @$filter["z_DeductionBasicRate"];
		$this->DeductionBasicRate->AdvancedSearch->SearchCondition = @$filter["v_DeductionBasicRate"];
		$this->DeductionBasicRate->AdvancedSearch->SearchValue2 = @$filter["y_DeductionBasicRate"];
		$this->DeductionBasicRate->AdvancedSearch->SearchOperator2 = @$filter["w_DeductionBasicRate"];
		$this->DeductionBasicRate->AdvancedSearch->save();

		// Field RemittedTo
		$this->RemittedTo->AdvancedSearch->SearchValue = @$filter["x_RemittedTo"];
		$this->RemittedTo->AdvancedSearch->SearchOperator = @$filter["z_RemittedTo"];
		$this->RemittedTo->AdvancedSearch->SearchCondition = @$filter["v_RemittedTo"];
		$this->RemittedTo->AdvancedSearch->SearchValue2 = @$filter["y_RemittedTo"];
		$this->RemittedTo->AdvancedSearch->SearchOperator2 = @$filter["w_RemittedTo"];
		$this->RemittedTo->AdvancedSearch->save();

		// Field AccountNo
		$this->AccountNo->AdvancedSearch->SearchValue = @$filter["x_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchOperator = @$filter["z_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchCondition = @$filter["v_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchValue2 = @$filter["y_AccountNo"];
		$this->AccountNo->AdvancedSearch->SearchOperator2 = @$filter["w_AccountNo"];
		$this->AccountNo->AdvancedSearch->save();

		// Field BaseIncomeCode
		$this->BaseIncomeCode->AdvancedSearch->SearchValue = @$filter["x_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchOperator = @$filter["z_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchCondition = @$filter["v_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchValue2 = @$filter["y_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->SearchOperator2 = @$filter["w_BaseIncomeCode"];
		$this->BaseIncomeCode->AdvancedSearch->save();

		// Field BaseDeductionCode
		$this->BaseDeductionCode->AdvancedSearch->SearchValue = @$filter["x_BaseDeductionCode"];
		$this->BaseDeductionCode->AdvancedSearch->SearchOperator = @$filter["z_BaseDeductionCode"];
		$this->BaseDeductionCode->AdvancedSearch->SearchCondition = @$filter["v_BaseDeductionCode"];
		$this->BaseDeductionCode->AdvancedSearch->SearchValue2 = @$filter["y_BaseDeductionCode"];
		$this->BaseDeductionCode->AdvancedSearch->SearchOperator2 = @$filter["w_BaseDeductionCode"];
		$this->BaseDeductionCode->AdvancedSearch->save();

		// Field TaxExempt
		$this->TaxExempt->AdvancedSearch->SearchValue = @$filter["x_TaxExempt"];
		$this->TaxExempt->AdvancedSearch->SearchOperator = @$filter["z_TaxExempt"];
		$this->TaxExempt->AdvancedSearch->SearchCondition = @$filter["v_TaxExempt"];
		$this->TaxExempt->AdvancedSearch->SearchValue2 = @$filter["y_TaxExempt"];
		$this->TaxExempt->AdvancedSearch->SearchOperator2 = @$filter["w_TaxExempt"];
		$this->TaxExempt->AdvancedSearch->save();

		// Field JobCode
		$this->JobCode->AdvancedSearch->SearchValue = @$filter["x_JobCode"];
		$this->JobCode->AdvancedSearch->SearchOperator = @$filter["z_JobCode"];
		$this->JobCode->AdvancedSearch->SearchCondition = @$filter["v_JobCode"];
		$this->JobCode->AdvancedSearch->SearchValue2 = @$filter["y_JobCode"];
		$this->JobCode->AdvancedSearch->SearchOperator2 = @$filter["w_JobCode"];
		$this->JobCode->AdvancedSearch->save();

		// Field MinimumAmount
		$this->MinimumAmount->AdvancedSearch->SearchValue = @$filter["x_MinimumAmount"];
		$this->MinimumAmount->AdvancedSearch->SearchOperator = @$filter["z_MinimumAmount"];
		$this->MinimumAmount->AdvancedSearch->SearchCondition = @$filter["v_MinimumAmount"];
		$this->MinimumAmount->AdvancedSearch->SearchValue2 = @$filter["y_MinimumAmount"];
		$this->MinimumAmount->AdvancedSearch->SearchOperator2 = @$filter["w_MinimumAmount"];
		$this->MinimumAmount->AdvancedSearch->save();

		// Field MaximumAmount
		$this->MaximumAmount->AdvancedSearch->SearchValue = @$filter["x_MaximumAmount"];
		$this->MaximumAmount->AdvancedSearch->SearchOperator = @$filter["z_MaximumAmount"];
		$this->MaximumAmount->AdvancedSearch->SearchCondition = @$filter["v_MaximumAmount"];
		$this->MaximumAmount->AdvancedSearch->SearchValue2 = @$filter["y_MaximumAmount"];
		$this->MaximumAmount->AdvancedSearch->SearchOperator2 = @$filter["w_MaximumAmount"];
		$this->MaximumAmount->AdvancedSearch->save();

		// Field EmployerContributionRate
		$this->EmployerContributionRate->AdvancedSearch->SearchValue = @$filter["x_EmployerContributionRate"];
		$this->EmployerContributionRate->AdvancedSearch->SearchOperator = @$filter["z_EmployerContributionRate"];
		$this->EmployerContributionRate->AdvancedSearch->SearchCondition = @$filter["v_EmployerContributionRate"];
		$this->EmployerContributionRate->AdvancedSearch->SearchValue2 = @$filter["y_EmployerContributionRate"];
		$this->EmployerContributionRate->AdvancedSearch->SearchOperator2 = @$filter["w_EmployerContributionRate"];
		$this->EmployerContributionRate->AdvancedSearch->save();

		// Field EmployerContributionAmount
		$this->EmployerContributionAmount->AdvancedSearch->SearchValue = @$filter["x_EmployerContributionAmount"];
		$this->EmployerContributionAmount->AdvancedSearch->SearchOperator = @$filter["z_EmployerContributionAmount"];
		$this->EmployerContributionAmount->AdvancedSearch->SearchCondition = @$filter["v_EmployerContributionAmount"];
		$this->EmployerContributionAmount->AdvancedSearch->SearchValue2 = @$filter["y_EmployerContributionAmount"];
		$this->EmployerContributionAmount->AdvancedSearch->SearchOperator2 = @$filter["w_EmployerContributionAmount"];
		$this->EmployerContributionAmount->AdvancedSearch->save();

		// Field Application
		$this->Application->AdvancedSearch->SearchValue = @$filter["x_Application"];
		$this->Application->AdvancedSearch->SearchOperator = @$filter["z_Application"];
		$this->Application->AdvancedSearch->SearchCondition = @$filter["v_Application"];
		$this->Application->AdvancedSearch->SearchValue2 = @$filter["y_Application"];
		$this->Application->AdvancedSearch->SearchOperator2 = @$filter["w_Application"];
		$this->Application->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->DeductionCode, $default, FALSE); // DeductionCode
		$this->buildSearchSql($where, $this->DeductionName, $default, FALSE); // DeductionName
		$this->buildSearchSql($where, $this->DeductionDescription, $default, FALSE); // DeductionDescription
		$this->buildSearchSql($where, $this->Division, $default, TRUE); // Division
		$this->buildSearchSql($where, $this->DeductionAmount, $default, FALSE); // DeductionAmount
		$this->buildSearchSql($where, $this->DeductionBasicRate, $default, FALSE); // DeductionBasicRate
		$this->buildSearchSql($where, $this->RemittedTo, $default, FALSE); // RemittedTo
		$this->buildSearchSql($where, $this->AccountNo, $default, FALSE); // AccountNo
		$this->buildSearchSql($where, $this->BaseIncomeCode, $default, FALSE); // BaseIncomeCode
		$this->buildSearchSql($where, $this->BaseDeductionCode, $default, FALSE); // BaseDeductionCode
		$this->buildSearchSql($where, $this->TaxExempt, $default, FALSE); // TaxExempt
		$this->buildSearchSql($where, $this->JobCode, $default, TRUE); // JobCode
		$this->buildSearchSql($where, $this->MinimumAmount, $default, FALSE); // MinimumAmount
		$this->buildSearchSql($where, $this->MaximumAmount, $default, FALSE); // MaximumAmount
		$this->buildSearchSql($where, $this->EmployerContributionRate, $default, FALSE); // EmployerContributionRate
		$this->buildSearchSql($where, $this->EmployerContributionAmount, $default, FALSE); // EmployerContributionAmount
		$this->buildSearchSql($where, $this->Application, $default, FALSE); // Application

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->DeductionCode->AdvancedSearch->save(); // DeductionCode
			$this->DeductionName->AdvancedSearch->save(); // DeductionName
			$this->DeductionDescription->AdvancedSearch->save(); // DeductionDescription
			$this->Division->AdvancedSearch->save(); // Division
			$this->DeductionAmount->AdvancedSearch->save(); // DeductionAmount
			$this->DeductionBasicRate->AdvancedSearch->save(); // DeductionBasicRate
			$this->RemittedTo->AdvancedSearch->save(); // RemittedTo
			$this->AccountNo->AdvancedSearch->save(); // AccountNo
			$this->BaseIncomeCode->AdvancedSearch->save(); // BaseIncomeCode
			$this->BaseDeductionCode->AdvancedSearch->save(); // BaseDeductionCode
			$this->TaxExempt->AdvancedSearch->save(); // TaxExempt
			$this->JobCode->AdvancedSearch->save(); // JobCode
			$this->MinimumAmount->AdvancedSearch->save(); // MinimumAmount
			$this->MaximumAmount->AdvancedSearch->save(); // MaximumAmount
			$this->EmployerContributionRate->AdvancedSearch->save(); // EmployerContributionRate
			$this->EmployerContributionAmount->AdvancedSearch->save(); // EmployerContributionAmount
			$this->Application->AdvancedSearch->save(); // Application
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
		$this->buildBasicSearchSql($where, $this->DeductionCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DeductionName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DeductionDescription, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Division, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->RemittedTo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AccountNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->BaseIncomeCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->BaseDeductionCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->JobCode, $arKeywords, $type);
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
		if ($this->DeductionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeductionName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeductionDescription->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Division->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeductionAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DeductionBasicRate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RemittedTo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AccountNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BaseIncomeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BaseDeductionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->TaxExempt->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->JobCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MinimumAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->MaximumAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->EmployerContributionRate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->EmployerContributionAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Application->AdvancedSearch->issetSession())
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
		$this->DeductionCode->AdvancedSearch->unsetSession();
		$this->DeductionName->AdvancedSearch->unsetSession();
		$this->DeductionDescription->AdvancedSearch->unsetSession();
		$this->Division->AdvancedSearch->unsetSession();
		$this->DeductionAmount->AdvancedSearch->unsetSession();
		$this->DeductionBasicRate->AdvancedSearch->unsetSession();
		$this->RemittedTo->AdvancedSearch->unsetSession();
		$this->AccountNo->AdvancedSearch->unsetSession();
		$this->BaseIncomeCode->AdvancedSearch->unsetSession();
		$this->BaseDeductionCode->AdvancedSearch->unsetSession();
		$this->TaxExempt->AdvancedSearch->unsetSession();
		$this->JobCode->AdvancedSearch->unsetSession();
		$this->MinimumAmount->AdvancedSearch->unsetSession();
		$this->MaximumAmount->AdvancedSearch->unsetSession();
		$this->EmployerContributionRate->AdvancedSearch->unsetSession();
		$this->EmployerContributionAmount->AdvancedSearch->unsetSession();
		$this->Application->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->DeductionCode->AdvancedSearch->load();
		$this->DeductionName->AdvancedSearch->load();
		$this->DeductionDescription->AdvancedSearch->load();
		$this->Division->AdvancedSearch->load();
		$this->DeductionAmount->AdvancedSearch->load();
		$this->DeductionBasicRate->AdvancedSearch->load();
		$this->RemittedTo->AdvancedSearch->load();
		$this->AccountNo->AdvancedSearch->load();
		$this->BaseIncomeCode->AdvancedSearch->load();
		$this->BaseDeductionCode->AdvancedSearch->load();
		$this->TaxExempt->AdvancedSearch->load();
		$this->JobCode->AdvancedSearch->load();
		$this->MinimumAmount->AdvancedSearch->load();
		$this->MaximumAmount->AdvancedSearch->load();
		$this->EmployerContributionRate->AdvancedSearch->load();
		$this->EmployerContributionAmount->AdvancedSearch->load();
		$this->Application->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->DeductionCode); // DeductionCode
			$this->updateSort($this->DeductionName); // DeductionName
			$this->updateSort($this->DeductionDescription); // DeductionDescription
			$this->updateSort($this->Division); // Division
			$this->updateSort($this->DeductionAmount); // DeductionAmount
			$this->updateSort($this->DeductionBasicRate); // DeductionBasicRate
			$this->updateSort($this->RemittedTo); // RemittedTo
			$this->updateSort($this->AccountNo); // AccountNo
			$this->updateSort($this->BaseIncomeCode); // BaseIncomeCode
			$this->updateSort($this->BaseDeductionCode); // BaseDeductionCode
			$this->updateSort($this->TaxExempt); // TaxExempt
			$this->updateSort($this->JobCode); // JobCode
			$this->updateSort($this->MinimumAmount); // MinimumAmount
			$this->updateSort($this->MaximumAmount); // MaximumAmount
			$this->updateSort($this->EmployerContributionRate); // EmployerContributionRate
			$this->updateSort($this->EmployerContributionAmount); // EmployerContributionAmount
			$this->updateSort($this->Application); // Application
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
				$this->DeductionCode->setSort("");
				$this->DeductionName->setSort("");
				$this->DeductionDescription->setSort("");
				$this->Division->setSort("");
				$this->DeductionAmount->setSort("");
				$this->DeductionBasicRate->setSort("");
				$this->RemittedTo->setSort("");
				$this->AccountNo->setSort("");
				$this->BaseIncomeCode->setSort("");
				$this->BaseDeductionCode->setSort("");
				$this->TaxExempt->setSort("");
				$this->JobCode->setSort("");
				$this->MinimumAmount->setSort("");
				$this->MaximumAmount->setSort("");
				$this->EmployerContributionRate->setSort("");
				$this->EmployerContributionAmount->setSort("");
				$this->Application->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->DeductionCode->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->DeductionCode->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fdeduction_typelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdeduction_typelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fdeduction_typelist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->DeductionCode->CurrentValue = NULL;
		$this->DeductionCode->OldValue = $this->DeductionCode->CurrentValue;
		$this->DeductionName->CurrentValue = NULL;
		$this->DeductionName->OldValue = $this->DeductionName->CurrentValue;
		$this->DeductionDescription->CurrentValue = NULL;
		$this->DeductionDescription->OldValue = $this->DeductionDescription->CurrentValue;
		$this->Division->CurrentValue = NULL;
		$this->Division->OldValue = $this->Division->CurrentValue;
		$this->DeductionAmount->CurrentValue = 0;
		$this->DeductionAmount->OldValue = $this->DeductionAmount->CurrentValue;
		$this->DeductionBasicRate->CurrentValue = 0;
		$this->DeductionBasicRate->OldValue = $this->DeductionBasicRate->CurrentValue;
		$this->RemittedTo->CurrentValue = NULL;
		$this->RemittedTo->OldValue = $this->RemittedTo->CurrentValue;
		$this->AccountNo->CurrentValue = NULL;
		$this->AccountNo->OldValue = $this->AccountNo->CurrentValue;
		$this->BaseIncomeCode->CurrentValue = NULL;
		$this->BaseIncomeCode->OldValue = $this->BaseIncomeCode->CurrentValue;
		$this->BaseDeductionCode->CurrentValue = NULL;
		$this->BaseDeductionCode->OldValue = $this->BaseDeductionCode->CurrentValue;
		$this->TaxExempt->CurrentValue = NULL;
		$this->TaxExempt->OldValue = $this->TaxExempt->CurrentValue;
		$this->JobCode->CurrentValue = NULL;
		$this->JobCode->OldValue = $this->JobCode->CurrentValue;
		$this->MinimumAmount->CurrentValue = NULL;
		$this->MinimumAmount->OldValue = $this->MinimumAmount->CurrentValue;
		$this->MaximumAmount->CurrentValue = NULL;
		$this->MaximumAmount->OldValue = $this->MaximumAmount->CurrentValue;
		$this->EmployerContributionRate->CurrentValue = NULL;
		$this->EmployerContributionRate->OldValue = $this->EmployerContributionRate->CurrentValue;
		$this->EmployerContributionAmount->CurrentValue = NULL;
		$this->EmployerContributionAmount->OldValue = $this->EmployerContributionAmount->CurrentValue;
		$this->Application->CurrentValue = NULL;
		$this->Application->OldValue = $this->Application->CurrentValue;
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

		// DeductionCode
		if (!$this->isAddOrEdit() && $this->DeductionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeductionCode->AdvancedSearch->SearchValue != "" || $this->DeductionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DeductionName
		if (!$this->isAddOrEdit() && $this->DeductionName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeductionName->AdvancedSearch->SearchValue != "" || $this->DeductionName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DeductionDescription
		if (!$this->isAddOrEdit() && $this->DeductionDescription->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeductionDescription->AdvancedSearch->SearchValue != "" || $this->DeductionDescription->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// DeductionAmount
		if (!$this->isAddOrEdit() && $this->DeductionAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeductionAmount->AdvancedSearch->SearchValue != "" || $this->DeductionAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DeductionBasicRate
		if (!$this->isAddOrEdit() && $this->DeductionBasicRate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DeductionBasicRate->AdvancedSearch->SearchValue != "" || $this->DeductionBasicRate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RemittedTo
		if (!$this->isAddOrEdit() && $this->RemittedTo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RemittedTo->AdvancedSearch->SearchValue != "" || $this->RemittedTo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AccountNo
		if (!$this->isAddOrEdit() && $this->AccountNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AccountNo->AdvancedSearch->SearchValue != "" || $this->AccountNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BaseIncomeCode
		if (!$this->isAddOrEdit() && $this->BaseIncomeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BaseIncomeCode->AdvancedSearch->SearchValue != "" || $this->BaseIncomeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BaseDeductionCode
		if (!$this->isAddOrEdit() && $this->BaseDeductionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BaseDeductionCode->AdvancedSearch->SearchValue != "" || $this->BaseDeductionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// TaxExempt
		if (!$this->isAddOrEdit() && $this->TaxExempt->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->TaxExempt->AdvancedSearch->SearchValue != "" || $this->TaxExempt->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// JobCode
		if (!$this->isAddOrEdit() && $this->JobCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->JobCode->AdvancedSearch->SearchValue != "" || $this->JobCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->JobCode->AdvancedSearch->SearchValue))
			$this->JobCode->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobCode->AdvancedSearch->SearchValue);
		if (is_array($this->JobCode->AdvancedSearch->SearchValue2))
			$this->JobCode->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobCode->AdvancedSearch->SearchValue2);

		// MinimumAmount
		if (!$this->isAddOrEdit() && $this->MinimumAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MinimumAmount->AdvancedSearch->SearchValue != "" || $this->MinimumAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// MaximumAmount
		if (!$this->isAddOrEdit() && $this->MaximumAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->MaximumAmount->AdvancedSearch->SearchValue != "" || $this->MaximumAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// EmployerContributionRate
		if (!$this->isAddOrEdit() && $this->EmployerContributionRate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->EmployerContributionRate->AdvancedSearch->SearchValue != "" || $this->EmployerContributionRate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// EmployerContributionAmount
		if (!$this->isAddOrEdit() && $this->EmployerContributionAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->EmployerContributionAmount->AdvancedSearch->SearchValue != "" || $this->EmployerContributionAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Application
		if (!$this->isAddOrEdit() && $this->Application->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Application->AdvancedSearch->SearchValue != "" || $this->Application->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'DeductionCode' first before field var 'x_DeductionCode'
		$val = $CurrentForm->hasValue("DeductionCode") ? $CurrentForm->getValue("DeductionCode") : $CurrentForm->getValue("x_DeductionCode");
		if (!$this->DeductionCode->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->DeductionCode->setFormValue($val);

		// Check field name 'DeductionName' first before field var 'x_DeductionName'
		$val = $CurrentForm->hasValue("DeductionName") ? $CurrentForm->getValue("DeductionName") : $CurrentForm->getValue("x_DeductionName");
		if (!$this->DeductionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionName->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeductionName"))
			$this->DeductionName->setOldValue($CurrentForm->getValue("o_DeductionName"));

		// Check field name 'DeductionDescription' first before field var 'x_DeductionDescription'
		$val = $CurrentForm->hasValue("DeductionDescription") ? $CurrentForm->getValue("DeductionDescription") : $CurrentForm->getValue("x_DeductionDescription");
		if (!$this->DeductionDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionDescription->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionDescription->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeductionDescription"))
			$this->DeductionDescription->setOldValue($CurrentForm->getValue("o_DeductionDescription"));

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

		// Check field name 'DeductionAmount' first before field var 'x_DeductionAmount'
		$val = $CurrentForm->hasValue("DeductionAmount") ? $CurrentForm->getValue("DeductionAmount") : $CurrentForm->getValue("x_DeductionAmount");
		if (!$this->DeductionAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionAmount->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeductionAmount"))
			$this->DeductionAmount->setOldValue($CurrentForm->getValue("o_DeductionAmount"));

		// Check field name 'DeductionBasicRate' first before field var 'x_DeductionBasicRate'
		$val = $CurrentForm->hasValue("DeductionBasicRate") ? $CurrentForm->getValue("DeductionBasicRate") : $CurrentForm->getValue("x_DeductionBasicRate");
		if (!$this->DeductionBasicRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DeductionBasicRate->Visible = FALSE; // Disable update for API request
			else
				$this->DeductionBasicRate->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DeductionBasicRate"))
			$this->DeductionBasicRate->setOldValue($CurrentForm->getValue("o_DeductionBasicRate"));

		// Check field name 'RemittedTo' first before field var 'x_RemittedTo'
		$val = $CurrentForm->hasValue("RemittedTo") ? $CurrentForm->getValue("RemittedTo") : $CurrentForm->getValue("x_RemittedTo");
		if (!$this->RemittedTo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RemittedTo->Visible = FALSE; // Disable update for API request
			else
				$this->RemittedTo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_RemittedTo"))
			$this->RemittedTo->setOldValue($CurrentForm->getValue("o_RemittedTo"));

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

		// Check field name 'BaseDeductionCode' first before field var 'x_BaseDeductionCode'
		$val = $CurrentForm->hasValue("BaseDeductionCode") ? $CurrentForm->getValue("BaseDeductionCode") : $CurrentForm->getValue("x_BaseDeductionCode");
		if (!$this->BaseDeductionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BaseDeductionCode->Visible = FALSE; // Disable update for API request
			else
				$this->BaseDeductionCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BaseDeductionCode"))
			$this->BaseDeductionCode->setOldValue($CurrentForm->getValue("o_BaseDeductionCode"));

		// Check field name 'TaxExempt' first before field var 'x_TaxExempt'
		$val = $CurrentForm->hasValue("TaxExempt") ? $CurrentForm->getValue("TaxExempt") : $CurrentForm->getValue("x_TaxExempt");
		if (!$this->TaxExempt->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->TaxExempt->Visible = FALSE; // Disable update for API request
			else
				$this->TaxExempt->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_TaxExempt"))
			$this->TaxExempt->setOldValue($CurrentForm->getValue("o_TaxExempt"));

		// Check field name 'JobCode' first before field var 'x_JobCode'
		$val = $CurrentForm->hasValue("JobCode") ? $CurrentForm->getValue("JobCode") : $CurrentForm->getValue("x_JobCode");
		if (!$this->JobCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobCode->Visible = FALSE; // Disable update for API request
			else
				$this->JobCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_JobCode"))
			$this->JobCode->setOldValue($CurrentForm->getValue("o_JobCode"));

		// Check field name 'MinimumAmount' first before field var 'x_MinimumAmount'
		$val = $CurrentForm->hasValue("MinimumAmount") ? $CurrentForm->getValue("MinimumAmount") : $CurrentForm->getValue("x_MinimumAmount");
		if (!$this->MinimumAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MinimumAmount->Visible = FALSE; // Disable update for API request
			else
				$this->MinimumAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MinimumAmount"))
			$this->MinimumAmount->setOldValue($CurrentForm->getValue("o_MinimumAmount"));

		// Check field name 'MaximumAmount' first before field var 'x_MaximumAmount'
		$val = $CurrentForm->hasValue("MaximumAmount") ? $CurrentForm->getValue("MaximumAmount") : $CurrentForm->getValue("x_MaximumAmount");
		if (!$this->MaximumAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MaximumAmount->Visible = FALSE; // Disable update for API request
			else
				$this->MaximumAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_MaximumAmount"))
			$this->MaximumAmount->setOldValue($CurrentForm->getValue("o_MaximumAmount"));

		// Check field name 'EmployerContributionRate' first before field var 'x_EmployerContributionRate'
		$val = $CurrentForm->hasValue("EmployerContributionRate") ? $CurrentForm->getValue("EmployerContributionRate") : $CurrentForm->getValue("x_EmployerContributionRate");
		if (!$this->EmployerContributionRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployerContributionRate->Visible = FALSE; // Disable update for API request
			else
				$this->EmployerContributionRate->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmployerContributionRate"))
			$this->EmployerContributionRate->setOldValue($CurrentForm->getValue("o_EmployerContributionRate"));

		// Check field name 'EmployerContributionAmount' first before field var 'x_EmployerContributionAmount'
		$val = $CurrentForm->hasValue("EmployerContributionAmount") ? $CurrentForm->getValue("EmployerContributionAmount") : $CurrentForm->getValue("x_EmployerContributionAmount");
		if (!$this->EmployerContributionAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployerContributionAmount->Visible = FALSE; // Disable update for API request
			else
				$this->EmployerContributionAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmployerContributionAmount"))
			$this->EmployerContributionAmount->setOldValue($CurrentForm->getValue("o_EmployerContributionAmount"));

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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->DeductionCode->CurrentValue = $this->DeductionCode->FormValue;
		$this->DeductionName->CurrentValue = $this->DeductionName->FormValue;
		$this->DeductionDescription->CurrentValue = $this->DeductionDescription->FormValue;
		$this->Division->CurrentValue = $this->Division->FormValue;
		$this->DeductionAmount->CurrentValue = $this->DeductionAmount->FormValue;
		$this->DeductionBasicRate->CurrentValue = $this->DeductionBasicRate->FormValue;
		$this->RemittedTo->CurrentValue = $this->RemittedTo->FormValue;
		$this->AccountNo->CurrentValue = $this->AccountNo->FormValue;
		$this->BaseIncomeCode->CurrentValue = $this->BaseIncomeCode->FormValue;
		$this->BaseDeductionCode->CurrentValue = $this->BaseDeductionCode->FormValue;
		$this->TaxExempt->CurrentValue = $this->TaxExempt->FormValue;
		$this->JobCode->CurrentValue = $this->JobCode->FormValue;
		$this->MinimumAmount->CurrentValue = $this->MinimumAmount->FormValue;
		$this->MaximumAmount->CurrentValue = $this->MaximumAmount->FormValue;
		$this->EmployerContributionRate->CurrentValue = $this->EmployerContributionRate->FormValue;
		$this->EmployerContributionAmount->CurrentValue = $this->EmployerContributionAmount->FormValue;
		$this->Application->CurrentValue = $this->Application->FormValue;
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
		$this->DeductionCode->setDbValue($row['DeductionCode']);
		$this->DeductionName->setDbValue($row['DeductionName']);
		$this->DeductionDescription->setDbValue($row['DeductionDescription']);
		$this->Division->setDbValue($row['Division']);
		$this->DeductionAmount->setDbValue($row['DeductionAmount']);
		$this->DeductionBasicRate->setDbValue($row['DeductionBasicRate']);
		$this->RemittedTo->setDbValue($row['RemittedTo']);
		$this->AccountNo->setDbValue($row['AccountNo']);
		$this->BaseIncomeCode->setDbValue($row['BaseIncomeCode']);
		$this->BaseDeductionCode->setDbValue($row['BaseDeductionCode']);
		$this->TaxExempt->setDbValue($row['TaxExempt']);
		$this->JobCode->setDbValue($row['JobCode']);
		$this->MinimumAmount->setDbValue($row['MinimumAmount']);
		$this->MaximumAmount->setDbValue($row['MaximumAmount']);
		$this->EmployerContributionRate->setDbValue($row['EmployerContributionRate']);
		$this->EmployerContributionAmount->setDbValue($row['EmployerContributionAmount']);
		$this->Application->setDbValue($row['Application']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['DeductionCode'] = $this->DeductionCode->CurrentValue;
		$row['DeductionName'] = $this->DeductionName->CurrentValue;
		$row['DeductionDescription'] = $this->DeductionDescription->CurrentValue;
		$row['Division'] = $this->Division->CurrentValue;
		$row['DeductionAmount'] = $this->DeductionAmount->CurrentValue;
		$row['DeductionBasicRate'] = $this->DeductionBasicRate->CurrentValue;
		$row['RemittedTo'] = $this->RemittedTo->CurrentValue;
		$row['AccountNo'] = $this->AccountNo->CurrentValue;
		$row['BaseIncomeCode'] = $this->BaseIncomeCode->CurrentValue;
		$row['BaseDeductionCode'] = $this->BaseDeductionCode->CurrentValue;
		$row['TaxExempt'] = $this->TaxExempt->CurrentValue;
		$row['JobCode'] = $this->JobCode->CurrentValue;
		$row['MinimumAmount'] = $this->MinimumAmount->CurrentValue;
		$row['MaximumAmount'] = $this->MaximumAmount->CurrentValue;
		$row['EmployerContributionRate'] = $this->EmployerContributionRate->CurrentValue;
		$row['EmployerContributionAmount'] = $this->EmployerContributionAmount->CurrentValue;
		$row['Application'] = $this->Application->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("DeductionCode")) != "")
			$this->DeductionCode->OldValue = $this->getKey("DeductionCode"); // DeductionCode
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
		if ($this->DeductionAmount->FormValue == $this->DeductionAmount->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionAmount->CurrentValue)))
			$this->DeductionAmount->CurrentValue = ConvertToFloatString($this->DeductionAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DeductionBasicRate->FormValue == $this->DeductionBasicRate->CurrentValue && is_numeric(ConvertToFloatString($this->DeductionBasicRate->CurrentValue)))
			$this->DeductionBasicRate->CurrentValue = ConvertToFloatString($this->DeductionBasicRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->MinimumAmount->FormValue == $this->MinimumAmount->CurrentValue && is_numeric(ConvertToFloatString($this->MinimumAmount->CurrentValue)))
			$this->MinimumAmount->CurrentValue = ConvertToFloatString($this->MinimumAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->MaximumAmount->FormValue == $this->MaximumAmount->CurrentValue && is_numeric(ConvertToFloatString($this->MaximumAmount->CurrentValue)))
			$this->MaximumAmount->CurrentValue = ConvertToFloatString($this->MaximumAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EmployerContributionRate->FormValue == $this->EmployerContributionRate->CurrentValue && is_numeric(ConvertToFloatString($this->EmployerContributionRate->CurrentValue)))
			$this->EmployerContributionRate->CurrentValue = ConvertToFloatString($this->EmployerContributionRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EmployerContributionAmount->FormValue == $this->EmployerContributionAmount->CurrentValue && is_numeric(ConvertToFloatString($this->EmployerContributionAmount->CurrentValue)))
			$this->EmployerContributionAmount->CurrentValue = ConvertToFloatString($this->EmployerContributionAmount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// DeductionCode
		// DeductionName
		// DeductionDescription
		// Division
		// DeductionAmount
		// DeductionBasicRate
		// RemittedTo
		// AccountNo
		// BaseIncomeCode
		// BaseDeductionCode
		// TaxExempt
		// JobCode
		// MinimumAmount
		// MaximumAmount
		// EmployerContributionRate
		// EmployerContributionAmount
		// Application

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// DeductionCode
			$this->DeductionCode->ViewValue = $this->DeductionCode->CurrentValue;
			$this->DeductionCode->ViewCustomAttributes = "";

			// DeductionName
			$this->DeductionName->ViewValue = $this->DeductionName->CurrentValue;
			$this->DeductionName->ViewCustomAttributes = "";

			// DeductionDescription
			$this->DeductionDescription->ViewValue = $this->DeductionDescription->CurrentValue;
			$this->DeductionDescription->ViewCustomAttributes = "";

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

			// DeductionAmount
			$this->DeductionAmount->ViewValue = $this->DeductionAmount->CurrentValue;
			$this->DeductionAmount->ViewValue = FormatNumber($this->DeductionAmount->ViewValue, 2, -2, -2, -2);
			$this->DeductionAmount->ViewCustomAttributes = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->ViewValue = $this->DeductionBasicRate->CurrentValue;
			$this->DeductionBasicRate->ViewValue = FormatNumber($this->DeductionBasicRate->ViewValue, 2, -2, -2, -2);
			$this->DeductionBasicRate->ViewCustomAttributes = "";

			// RemittedTo
			$this->RemittedTo->ViewValue = $this->RemittedTo->CurrentValue;
			$this->RemittedTo->ViewCustomAttributes = "";

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

			// BaseDeductionCode
			$curVal = strval($this->BaseDeductionCode->CurrentValue);
			if ($curVal != "") {
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
				if ($this->BaseDeductionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DeductionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->CurrentValue;
					}
				}
			} else {
				$this->BaseDeductionCode->ViewValue = NULL;
			}
			$this->BaseDeductionCode->ViewCustomAttributes = "";

			// TaxExempt
			$curVal = strval($this->TaxExempt->CurrentValue);
			if ($curVal != "") {
				$this->TaxExempt->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
				if ($this->TaxExempt->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TaxExempt->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TaxExempt->ViewValue = $this->TaxExempt->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TaxExempt->ViewValue = $this->TaxExempt->CurrentValue;
					}
				}
			} else {
				$this->TaxExempt->ViewValue = NULL;
			}
			$this->TaxExempt->ViewCustomAttributes = "";

			// JobCode
			$curVal = strval($this->JobCode->CurrentValue);
			if ($curVal != "") {
				$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
				if ($this->JobCode->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobCode->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobCode->ViewValue->add($this->JobCode->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
					}
				}
			} else {
				$this->JobCode->ViewValue = NULL;
			}
			$this->JobCode->ViewCustomAttributes = "";

			// MinimumAmount
			$this->MinimumAmount->ViewValue = $this->MinimumAmount->CurrentValue;
			$this->MinimumAmount->ViewValue = FormatNumber($this->MinimumAmount->ViewValue, 2, -2, -2, -2);
			$this->MinimumAmount->ViewCustomAttributes = "";

			// MaximumAmount
			$this->MaximumAmount->ViewValue = $this->MaximumAmount->CurrentValue;
			$this->MaximumAmount->ViewValue = FormatNumber($this->MaximumAmount->ViewValue, 2, -2, -2, -2);
			$this->MaximumAmount->ViewCustomAttributes = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->ViewValue = $this->EmployerContributionRate->CurrentValue;
			$this->EmployerContributionRate->ViewValue = FormatNumber($this->EmployerContributionRate->ViewValue, 2, -2, -2, -2);
			$this->EmployerContributionRate->ViewCustomAttributes = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->ViewValue = $this->EmployerContributionAmount->CurrentValue;
			$this->EmployerContributionAmount->ViewValue = FormatNumber($this->EmployerContributionAmount->ViewValue, 2, -2, -2, -2);
			$this->EmployerContributionAmount->ViewCustomAttributes = "";

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

			// DeductionCode
			$this->DeductionCode->LinkCustomAttributes = "";
			$this->DeductionCode->HrefValue = "";
			$this->DeductionCode->TooltipValue = "";
			if (!$this->isExport())
				$this->DeductionCode->ViewValue = $this->highlightValue($this->DeductionCode);

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";
			$this->DeductionName->TooltipValue = "";
			if (!$this->isExport())
				$this->DeductionName->ViewValue = $this->highlightValue($this->DeductionName);

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";
			$this->DeductionDescription->TooltipValue = "";
			if (!$this->isExport())
				$this->DeductionDescription->ViewValue = $this->highlightValue($this->DeductionDescription);

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";
			$this->Division->TooltipValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";
			$this->DeductionAmount->TooltipValue = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->LinkCustomAttributes = "";
			$this->DeductionBasicRate->HrefValue = "";
			$this->DeductionBasicRate->TooltipValue = "";

			// RemittedTo
			$this->RemittedTo->LinkCustomAttributes = "";
			$this->RemittedTo->HrefValue = "";
			$this->RemittedTo->TooltipValue = "";
			if (!$this->isExport())
				$this->RemittedTo->ViewValue = $this->highlightValue($this->RemittedTo);

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";
			$this->AccountNo->TooltipValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";
			$this->BaseIncomeCode->TooltipValue = "";

			// BaseDeductionCode
			$this->BaseDeductionCode->LinkCustomAttributes = "";
			$this->BaseDeductionCode->HrefValue = "";
			$this->BaseDeductionCode->TooltipValue = "";

			// TaxExempt
			$this->TaxExempt->LinkCustomAttributes = "";
			$this->TaxExempt->HrefValue = "";
			$this->TaxExempt->TooltipValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";
			$this->JobCode->TooltipValue = "";

			// MinimumAmount
			$this->MinimumAmount->LinkCustomAttributes = "";
			$this->MinimumAmount->HrefValue = "";
			$this->MinimumAmount->TooltipValue = "";

			// MaximumAmount
			$this->MaximumAmount->LinkCustomAttributes = "";
			$this->MaximumAmount->HrefValue = "";
			$this->MaximumAmount->TooltipValue = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->LinkCustomAttributes = "";
			$this->EmployerContributionRate->HrefValue = "";
			$this->EmployerContributionRate->TooltipValue = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->LinkCustomAttributes = "";
			$this->EmployerContributionAmount->HrefValue = "";
			$this->EmployerContributionAmount->TooltipValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
			$this->Application->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// DeductionCode
			// DeductionName

			$this->DeductionName->EditAttrs["class"] = "form-control";
			$this->DeductionName->EditCustomAttributes = "";
			if (!$this->DeductionName->Raw)
				$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
			$this->DeductionName->EditValue = HtmlEncode($this->DeductionName->CurrentValue);
			$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

			// DeductionDescription
			$this->DeductionDescription->EditAttrs["class"] = "form-control";
			$this->DeductionDescription->EditCustomAttributes = "";
			$this->DeductionDescription->EditValue = HtmlEncode($this->DeductionDescription->CurrentValue);
			$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

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

			// DeductionAmount
			$this->DeductionAmount->EditAttrs["class"] = "form-control";
			$this->DeductionAmount->EditCustomAttributes = "";
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->CurrentValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
			if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue)) {
				$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
				$this->DeductionAmount->OldValue = $this->DeductionAmount->EditValue;
			}
			

			// DeductionBasicRate
			$this->DeductionBasicRate->EditAttrs["class"] = "form-control";
			$this->DeductionBasicRate->EditCustomAttributes = "";
			$this->DeductionBasicRate->EditValue = HtmlEncode($this->DeductionBasicRate->CurrentValue);
			$this->DeductionBasicRate->PlaceHolder = RemoveHtml($this->DeductionBasicRate->caption());
			if (strval($this->DeductionBasicRate->EditValue) != "" && is_numeric($this->DeductionBasicRate->EditValue)) {
				$this->DeductionBasicRate->EditValue = FormatNumber($this->DeductionBasicRate->EditValue, -2, -2, -2, -2);
				$this->DeductionBasicRate->OldValue = $this->DeductionBasicRate->EditValue;
			}
			

			// RemittedTo
			$this->RemittedTo->EditAttrs["class"] = "form-control";
			$this->RemittedTo->EditCustomAttributes = "";
			if (!$this->RemittedTo->Raw)
				$this->RemittedTo->CurrentValue = HtmlDecode($this->RemittedTo->CurrentValue);
			$this->RemittedTo->EditValue = HtmlEncode($this->RemittedTo->CurrentValue);
			$this->RemittedTo->PlaceHolder = RemoveHtml($this->RemittedTo->caption());

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

			// BaseDeductionCode
			$this->BaseDeductionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseDeductionCode->CurrentValue));
			if ($curVal != "")
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
			else
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->Lookup !== NULL && is_array($this->BaseDeductionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseDeductionCode->ViewValue !== NULL) { // Load from cache
				$this->BaseDeductionCode->EditValue = array_values($this->BaseDeductionCode->Lookup->Options);
				if ($this->BaseDeductionCode->ViewValue == "")
					$this->BaseDeductionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DeductionCode`" . SearchString("=", $this->BaseDeductionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
				} else {
					$this->BaseDeductionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseDeductionCode->EditValue = $arwrk;
			}

			// TaxExempt
			$this->TaxExempt->EditAttrs["class"] = "form-control";
			$this->TaxExempt->EditCustomAttributes = "";
			$curVal = trim(strval($this->TaxExempt->CurrentValue));
			if ($curVal != "")
				$this->TaxExempt->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
			else
				$this->TaxExempt->ViewValue = $this->TaxExempt->Lookup !== NULL && is_array($this->TaxExempt->Lookup->Options) ? $curVal : NULL;
			if ($this->TaxExempt->ViewValue !== NULL) { // Load from cache
				$this->TaxExempt->EditValue = array_values($this->TaxExempt->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->TaxExempt->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TaxExempt->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TaxExempt->EditValue = $arwrk;
			}

			// JobCode
			$this->JobCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobCode->CurrentValue));
			if ($curVal != "")
				$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
			else
				$this->JobCode->ViewValue = $this->JobCode->Lookup !== NULL && is_array($this->JobCode->Lookup->Options) ? $curVal : NULL;
			if ($this->JobCode->ViewValue !== NULL) { // Load from cache
				$this->JobCode->EditValue = array_values($this->JobCode->Lookup->Options);
				if ($this->JobCode->ViewValue == "")
					$this->JobCode->ViewValue = $Language->phrase("PleaseSelect");
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
				$sqlWrk = $this->JobCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobCode->ViewValue->add($this->JobCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobCode->EditValue = $arwrk;
			}

			// MinimumAmount
			$this->MinimumAmount->EditAttrs["class"] = "form-control";
			$this->MinimumAmount->EditCustomAttributes = "";
			$this->MinimumAmount->EditValue = HtmlEncode($this->MinimumAmount->CurrentValue);
			$this->MinimumAmount->PlaceHolder = RemoveHtml($this->MinimumAmount->caption());
			if (strval($this->MinimumAmount->EditValue) != "" && is_numeric($this->MinimumAmount->EditValue)) {
				$this->MinimumAmount->EditValue = FormatNumber($this->MinimumAmount->EditValue, -2, -2, -2, -2);
				$this->MinimumAmount->OldValue = $this->MinimumAmount->EditValue;
			}
			

			// MaximumAmount
			$this->MaximumAmount->EditAttrs["class"] = "form-control";
			$this->MaximumAmount->EditCustomAttributes = "";
			$this->MaximumAmount->EditValue = HtmlEncode($this->MaximumAmount->CurrentValue);
			$this->MaximumAmount->PlaceHolder = RemoveHtml($this->MaximumAmount->caption());
			if (strval($this->MaximumAmount->EditValue) != "" && is_numeric($this->MaximumAmount->EditValue)) {
				$this->MaximumAmount->EditValue = FormatNumber($this->MaximumAmount->EditValue, -2, -2, -2, -2);
				$this->MaximumAmount->OldValue = $this->MaximumAmount->EditValue;
			}
			

			// EmployerContributionRate
			$this->EmployerContributionRate->EditAttrs["class"] = "form-control";
			$this->EmployerContributionRate->EditCustomAttributes = "";
			$this->EmployerContributionRate->EditValue = HtmlEncode($this->EmployerContributionRate->CurrentValue);
			$this->EmployerContributionRate->PlaceHolder = RemoveHtml($this->EmployerContributionRate->caption());
			if (strval($this->EmployerContributionRate->EditValue) != "" && is_numeric($this->EmployerContributionRate->EditValue)) {
				$this->EmployerContributionRate->EditValue = FormatNumber($this->EmployerContributionRate->EditValue, -2, -2, -2, -2);
				$this->EmployerContributionRate->OldValue = $this->EmployerContributionRate->EditValue;
			}
			

			// EmployerContributionAmount
			$this->EmployerContributionAmount->EditAttrs["class"] = "form-control";
			$this->EmployerContributionAmount->EditCustomAttributes = "";
			$this->EmployerContributionAmount->EditValue = HtmlEncode($this->EmployerContributionAmount->CurrentValue);
			$this->EmployerContributionAmount->PlaceHolder = RemoveHtml($this->EmployerContributionAmount->caption());
			if (strval($this->EmployerContributionAmount->EditValue) != "" && is_numeric($this->EmployerContributionAmount->EditValue)) {
				$this->EmployerContributionAmount->EditValue = FormatNumber($this->EmployerContributionAmount->EditValue, -2, -2, -2, -2);
				$this->EmployerContributionAmount->OldValue = $this->EmployerContributionAmount->EditValue;
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

			// Add refer script
			// DeductionCode

			$this->DeductionCode->LinkCustomAttributes = "";
			$this->DeductionCode->HrefValue = "";

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->LinkCustomAttributes = "";
			$this->DeductionBasicRate->HrefValue = "";

			// RemittedTo
			$this->RemittedTo->LinkCustomAttributes = "";
			$this->RemittedTo->HrefValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";

			// BaseDeductionCode
			$this->BaseDeductionCode->LinkCustomAttributes = "";
			$this->BaseDeductionCode->HrefValue = "";

			// TaxExempt
			$this->TaxExempt->LinkCustomAttributes = "";
			$this->TaxExempt->HrefValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";

			// MinimumAmount
			$this->MinimumAmount->LinkCustomAttributes = "";
			$this->MinimumAmount->HrefValue = "";

			// MaximumAmount
			$this->MaximumAmount->LinkCustomAttributes = "";
			$this->MaximumAmount->HrefValue = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->LinkCustomAttributes = "";
			$this->EmployerContributionRate->HrefValue = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->LinkCustomAttributes = "";
			$this->EmployerContributionAmount->HrefValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// DeductionCode
			$this->DeductionCode->EditAttrs["class"] = "form-control";
			$this->DeductionCode->EditCustomAttributes = "";
			$this->DeductionCode->EditValue = $this->DeductionCode->CurrentValue;
			$this->DeductionCode->ViewCustomAttributes = "";

			// DeductionName
			$this->DeductionName->EditAttrs["class"] = "form-control";
			$this->DeductionName->EditCustomAttributes = "";
			if (!$this->DeductionName->Raw)
				$this->DeductionName->CurrentValue = HtmlDecode($this->DeductionName->CurrentValue);
			$this->DeductionName->EditValue = HtmlEncode($this->DeductionName->CurrentValue);
			$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

			// DeductionDescription
			$this->DeductionDescription->EditAttrs["class"] = "form-control";
			$this->DeductionDescription->EditCustomAttributes = "";
			$this->DeductionDescription->EditValue = HtmlEncode($this->DeductionDescription->CurrentValue);
			$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

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

			// DeductionAmount
			$this->DeductionAmount->EditAttrs["class"] = "form-control";
			$this->DeductionAmount->EditCustomAttributes = "";
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->CurrentValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());
			if (strval($this->DeductionAmount->EditValue) != "" && is_numeric($this->DeductionAmount->EditValue)) {
				$this->DeductionAmount->EditValue = FormatNumber($this->DeductionAmount->EditValue, -2, -2, -2, -2);
				$this->DeductionAmount->OldValue = $this->DeductionAmount->EditValue;
			}
			

			// DeductionBasicRate
			$this->DeductionBasicRate->EditAttrs["class"] = "form-control";
			$this->DeductionBasicRate->EditCustomAttributes = "";
			$this->DeductionBasicRate->EditValue = HtmlEncode($this->DeductionBasicRate->CurrentValue);
			$this->DeductionBasicRate->PlaceHolder = RemoveHtml($this->DeductionBasicRate->caption());
			if (strval($this->DeductionBasicRate->EditValue) != "" && is_numeric($this->DeductionBasicRate->EditValue)) {
				$this->DeductionBasicRate->EditValue = FormatNumber($this->DeductionBasicRate->EditValue, -2, -2, -2, -2);
				$this->DeductionBasicRate->OldValue = $this->DeductionBasicRate->EditValue;
			}
			

			// RemittedTo
			$this->RemittedTo->EditAttrs["class"] = "form-control";
			$this->RemittedTo->EditCustomAttributes = "";
			if (!$this->RemittedTo->Raw)
				$this->RemittedTo->CurrentValue = HtmlDecode($this->RemittedTo->CurrentValue);
			$this->RemittedTo->EditValue = HtmlEncode($this->RemittedTo->CurrentValue);
			$this->RemittedTo->PlaceHolder = RemoveHtml($this->RemittedTo->caption());

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

			// BaseDeductionCode
			$this->BaseDeductionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseDeductionCode->CurrentValue));
			if ($curVal != "")
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
			else
				$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->Lookup !== NULL && is_array($this->BaseDeductionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseDeductionCode->ViewValue !== NULL) { // Load from cache
				$this->BaseDeductionCode->EditValue = array_values($this->BaseDeductionCode->Lookup->Options);
				if ($this->BaseDeductionCode->ViewValue == "")
					$this->BaseDeductionCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DeductionCode`" . SearchString("=", $this->BaseDeductionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseDeductionCode->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
				} else {
					$this->BaseDeductionCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseDeductionCode->EditValue = $arwrk;
			}

			// TaxExempt
			$this->TaxExempt->EditAttrs["class"] = "form-control";
			$this->TaxExempt->EditCustomAttributes = "";
			$curVal = trim(strval($this->TaxExempt->CurrentValue));
			if ($curVal != "")
				$this->TaxExempt->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
			else
				$this->TaxExempt->ViewValue = $this->TaxExempt->Lookup !== NULL && is_array($this->TaxExempt->Lookup->Options) ? $curVal : NULL;
			if ($this->TaxExempt->ViewValue !== NULL) { // Load from cache
				$this->TaxExempt->EditValue = array_values($this->TaxExempt->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->TaxExempt->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TaxExempt->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TaxExempt->EditValue = $arwrk;
			}

			// JobCode
			$this->JobCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobCode->CurrentValue));
			if ($curVal != "")
				$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
			else
				$this->JobCode->ViewValue = $this->JobCode->Lookup !== NULL && is_array($this->JobCode->Lookup->Options) ? $curVal : NULL;
			if ($this->JobCode->ViewValue !== NULL) { // Load from cache
				$this->JobCode->EditValue = array_values($this->JobCode->Lookup->Options);
				if ($this->JobCode->ViewValue == "")
					$this->JobCode->ViewValue = $Language->phrase("PleaseSelect");
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
				$sqlWrk = $this->JobCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobCode->ViewValue->add($this->JobCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobCode->EditValue = $arwrk;
			}

			// MinimumAmount
			$this->MinimumAmount->EditAttrs["class"] = "form-control";
			$this->MinimumAmount->EditCustomAttributes = "";
			$this->MinimumAmount->EditValue = HtmlEncode($this->MinimumAmount->CurrentValue);
			$this->MinimumAmount->PlaceHolder = RemoveHtml($this->MinimumAmount->caption());
			if (strval($this->MinimumAmount->EditValue) != "" && is_numeric($this->MinimumAmount->EditValue)) {
				$this->MinimumAmount->EditValue = FormatNumber($this->MinimumAmount->EditValue, -2, -2, -2, -2);
				$this->MinimumAmount->OldValue = $this->MinimumAmount->EditValue;
			}
			

			// MaximumAmount
			$this->MaximumAmount->EditAttrs["class"] = "form-control";
			$this->MaximumAmount->EditCustomAttributes = "";
			$this->MaximumAmount->EditValue = HtmlEncode($this->MaximumAmount->CurrentValue);
			$this->MaximumAmount->PlaceHolder = RemoveHtml($this->MaximumAmount->caption());
			if (strval($this->MaximumAmount->EditValue) != "" && is_numeric($this->MaximumAmount->EditValue)) {
				$this->MaximumAmount->EditValue = FormatNumber($this->MaximumAmount->EditValue, -2, -2, -2, -2);
				$this->MaximumAmount->OldValue = $this->MaximumAmount->EditValue;
			}
			

			// EmployerContributionRate
			$this->EmployerContributionRate->EditAttrs["class"] = "form-control";
			$this->EmployerContributionRate->EditCustomAttributes = "";
			$this->EmployerContributionRate->EditValue = HtmlEncode($this->EmployerContributionRate->CurrentValue);
			$this->EmployerContributionRate->PlaceHolder = RemoveHtml($this->EmployerContributionRate->caption());
			if (strval($this->EmployerContributionRate->EditValue) != "" && is_numeric($this->EmployerContributionRate->EditValue)) {
				$this->EmployerContributionRate->EditValue = FormatNumber($this->EmployerContributionRate->EditValue, -2, -2, -2, -2);
				$this->EmployerContributionRate->OldValue = $this->EmployerContributionRate->EditValue;
			}
			

			// EmployerContributionAmount
			$this->EmployerContributionAmount->EditAttrs["class"] = "form-control";
			$this->EmployerContributionAmount->EditCustomAttributes = "";
			$this->EmployerContributionAmount->EditValue = HtmlEncode($this->EmployerContributionAmount->CurrentValue);
			$this->EmployerContributionAmount->PlaceHolder = RemoveHtml($this->EmployerContributionAmount->caption());
			if (strval($this->EmployerContributionAmount->EditValue) != "" && is_numeric($this->EmployerContributionAmount->EditValue)) {
				$this->EmployerContributionAmount->EditValue = FormatNumber($this->EmployerContributionAmount->EditValue, -2, -2, -2, -2);
				$this->EmployerContributionAmount->OldValue = $this->EmployerContributionAmount->EditValue;
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

			// Edit refer script
			// DeductionCode

			$this->DeductionCode->LinkCustomAttributes = "";
			$this->DeductionCode->HrefValue = "";

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// DeductionAmount
			$this->DeductionAmount->LinkCustomAttributes = "";
			$this->DeductionAmount->HrefValue = "";

			// DeductionBasicRate
			$this->DeductionBasicRate->LinkCustomAttributes = "";
			$this->DeductionBasicRate->HrefValue = "";

			// RemittedTo
			$this->RemittedTo->LinkCustomAttributes = "";
			$this->RemittedTo->HrefValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";

			// BaseDeductionCode
			$this->BaseDeductionCode->LinkCustomAttributes = "";
			$this->BaseDeductionCode->HrefValue = "";

			// TaxExempt
			$this->TaxExempt->LinkCustomAttributes = "";
			$this->TaxExempt->HrefValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";

			// MinimumAmount
			$this->MinimumAmount->LinkCustomAttributes = "";
			$this->MinimumAmount->HrefValue = "";

			// MaximumAmount
			$this->MaximumAmount->LinkCustomAttributes = "";
			$this->MaximumAmount->HrefValue = "";

			// EmployerContributionRate
			$this->EmployerContributionRate->LinkCustomAttributes = "";
			$this->EmployerContributionRate->HrefValue = "";

			// EmployerContributionAmount
			$this->EmployerContributionAmount->LinkCustomAttributes = "";
			$this->EmployerContributionAmount->HrefValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
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
		if ($this->DeductionCode->Required) {
			if (!$this->DeductionCode->IsDetailKey && $this->DeductionCode->FormValue != NULL && $this->DeductionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionCode->caption(), $this->DeductionCode->RequiredErrorMessage));
			}
		}
		if ($this->DeductionName->Required) {
			if (!$this->DeductionName->IsDetailKey && $this->DeductionName->FormValue != NULL && $this->DeductionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionName->caption(), $this->DeductionName->RequiredErrorMessage));
			}
		}
		if ($this->DeductionDescription->Required) {
			if (!$this->DeductionDescription->IsDetailKey && $this->DeductionDescription->FormValue != NULL && $this->DeductionDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionDescription->caption(), $this->DeductionDescription->RequiredErrorMessage));
			}
		}
		if ($this->Division->Required) {
			if ($this->Division->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Division->caption(), $this->Division->RequiredErrorMessage));
			}
		}
		if ($this->DeductionAmount->Required) {
			if (!$this->DeductionAmount->IsDetailKey && $this->DeductionAmount->FormValue != NULL && $this->DeductionAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionAmount->caption(), $this->DeductionAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionAmount->FormValue)) {
			AddMessage($FormError, $this->DeductionAmount->errorMessage());
		}
		if ($this->DeductionBasicRate->Required) {
			if (!$this->DeductionBasicRate->IsDetailKey && $this->DeductionBasicRate->FormValue != NULL && $this->DeductionBasicRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DeductionBasicRate->caption(), $this->DeductionBasicRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DeductionBasicRate->FormValue)) {
			AddMessage($FormError, $this->DeductionBasicRate->errorMessage());
		}
		if ($this->RemittedTo->Required) {
			if (!$this->RemittedTo->IsDetailKey && $this->RemittedTo->FormValue != NULL && $this->RemittedTo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RemittedTo->caption(), $this->RemittedTo->RequiredErrorMessage));
			}
		}
		if ($this->AccountNo->Required) {
			if (!$this->AccountNo->IsDetailKey && $this->AccountNo->FormValue != NULL && $this->AccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountNo->caption(), $this->AccountNo->RequiredErrorMessage));
			}
		}
		if ($this->BaseIncomeCode->Required) {
			if (!$this->BaseIncomeCode->IsDetailKey && $this->BaseIncomeCode->FormValue != NULL && $this->BaseIncomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BaseIncomeCode->caption(), $this->BaseIncomeCode->RequiredErrorMessage));
			}
		}
		if ($this->BaseDeductionCode->Required) {
			if (!$this->BaseDeductionCode->IsDetailKey && $this->BaseDeductionCode->FormValue != NULL && $this->BaseDeductionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BaseDeductionCode->caption(), $this->BaseDeductionCode->RequiredErrorMessage));
			}
		}
		if ($this->TaxExempt->Required) {
			if (!$this->TaxExempt->IsDetailKey && $this->TaxExempt->FormValue != NULL && $this->TaxExempt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TaxExempt->caption(), $this->TaxExempt->RequiredErrorMessage));
			}
		}
		if ($this->JobCode->Required) {
			if ($this->JobCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobCode->caption(), $this->JobCode->RequiredErrorMessage));
			}
		}
		if ($this->MinimumAmount->Required) {
			if (!$this->MinimumAmount->IsDetailKey && $this->MinimumAmount->FormValue != NULL && $this->MinimumAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MinimumAmount->caption(), $this->MinimumAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->MinimumAmount->FormValue)) {
			AddMessage($FormError, $this->MinimumAmount->errorMessage());
		}
		if ($this->MaximumAmount->Required) {
			if (!$this->MaximumAmount->IsDetailKey && $this->MaximumAmount->FormValue != NULL && $this->MaximumAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MaximumAmount->caption(), $this->MaximumAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->MaximumAmount->FormValue)) {
			AddMessage($FormError, $this->MaximumAmount->errorMessage());
		}
		if ($this->EmployerContributionRate->Required) {
			if (!$this->EmployerContributionRate->IsDetailKey && $this->EmployerContributionRate->FormValue != NULL && $this->EmployerContributionRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployerContributionRate->caption(), $this->EmployerContributionRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EmployerContributionRate->FormValue)) {
			AddMessage($FormError, $this->EmployerContributionRate->errorMessage());
		}
		if ($this->EmployerContributionAmount->Required) {
			if (!$this->EmployerContributionAmount->IsDetailKey && $this->EmployerContributionAmount->FormValue != NULL && $this->EmployerContributionAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployerContributionAmount->caption(), $this->EmployerContributionAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EmployerContributionAmount->FormValue)) {
			AddMessage($FormError, $this->EmployerContributionAmount->errorMessage());
		}
		if ($this->Application->Required) {
			if (!$this->Application->IsDetailKey && $this->Application->FormValue != NULL && $this->Application->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Application->caption(), $this->Application->RequiredErrorMessage));
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
				$thisKey .= $row['DeductionCode'];
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

			// DeductionName
			$this->DeductionName->setDbValueDef($rsnew, $this->DeductionName->CurrentValue, "", $this->DeductionName->ReadOnly);

			// DeductionDescription
			$this->DeductionDescription->setDbValueDef($rsnew, $this->DeductionDescription->CurrentValue, NULL, $this->DeductionDescription->ReadOnly);

			// Division
			$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, NULL, $this->Division->ReadOnly);

			// DeductionAmount
			$this->DeductionAmount->setDbValueDef($rsnew, $this->DeductionAmount->CurrentValue, NULL, $this->DeductionAmount->ReadOnly);

			// DeductionBasicRate
			$this->DeductionBasicRate->setDbValueDef($rsnew, $this->DeductionBasicRate->CurrentValue, NULL, $this->DeductionBasicRate->ReadOnly);

			// RemittedTo
			$this->RemittedTo->setDbValueDef($rsnew, $this->RemittedTo->CurrentValue, NULL, $this->RemittedTo->ReadOnly);

			// AccountNo
			$this->AccountNo->setDbValueDef($rsnew, $this->AccountNo->CurrentValue, NULL, $this->AccountNo->ReadOnly);

			// BaseIncomeCode
			$this->BaseIncomeCode->setDbValueDef($rsnew, $this->BaseIncomeCode->CurrentValue, NULL, $this->BaseIncomeCode->ReadOnly);

			// BaseDeductionCode
			$this->BaseDeductionCode->setDbValueDef($rsnew, $this->BaseDeductionCode->CurrentValue, NULL, $this->BaseDeductionCode->ReadOnly);

			// TaxExempt
			$this->TaxExempt->setDbValueDef($rsnew, $this->TaxExempt->CurrentValue, NULL, $this->TaxExempt->ReadOnly);

			// JobCode
			$this->JobCode->setDbValueDef($rsnew, $this->JobCode->CurrentValue, NULL, $this->JobCode->ReadOnly);

			// MinimumAmount
			$this->MinimumAmount->setDbValueDef($rsnew, $this->MinimumAmount->CurrentValue, NULL, $this->MinimumAmount->ReadOnly);

			// MaximumAmount
			$this->MaximumAmount->setDbValueDef($rsnew, $this->MaximumAmount->CurrentValue, NULL, $this->MaximumAmount->ReadOnly);

			// EmployerContributionRate
			$this->EmployerContributionRate->setDbValueDef($rsnew, $this->EmployerContributionRate->CurrentValue, NULL, $this->EmployerContributionRate->ReadOnly);

			// EmployerContributionAmount
			$this->EmployerContributionAmount->setDbValueDef($rsnew, $this->EmployerContributionAmount->CurrentValue, NULL, $this->EmployerContributionAmount->ReadOnly);

			// Application
			$this->Application->setDbValueDef($rsnew, $this->Application->CurrentValue, NULL, $this->Application->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('DeductionName')); // DeductionName
		$hash .= GetFieldHash($rs->fields('DeductionDescription')); // DeductionDescription
		$hash .= GetFieldHash($rs->fields('Division')); // Division
		$hash .= GetFieldHash($rs->fields('DeductionAmount')); // DeductionAmount
		$hash .= GetFieldHash($rs->fields('DeductionBasicRate')); // DeductionBasicRate
		$hash .= GetFieldHash($rs->fields('RemittedTo')); // RemittedTo
		$hash .= GetFieldHash($rs->fields('AccountNo')); // AccountNo
		$hash .= GetFieldHash($rs->fields('BaseIncomeCode')); // BaseIncomeCode
		$hash .= GetFieldHash($rs->fields('BaseDeductionCode')); // BaseDeductionCode
		$hash .= GetFieldHash($rs->fields('TaxExempt')); // TaxExempt
		$hash .= GetFieldHash($rs->fields('JobCode')); // JobCode
		$hash .= GetFieldHash($rs->fields('MinimumAmount')); // MinimumAmount
		$hash .= GetFieldHash($rs->fields('MaximumAmount')); // MaximumAmount
		$hash .= GetFieldHash($rs->fields('EmployerContributionRate')); // EmployerContributionRate
		$hash .= GetFieldHash($rs->fields('EmployerContributionAmount')); // EmployerContributionAmount
		$hash .= GetFieldHash($rs->fields('Application')); // Application
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

		// DeductionName
		$this->DeductionName->setDbValueDef($rsnew, $this->DeductionName->CurrentValue, "", FALSE);

		// DeductionDescription
		$this->DeductionDescription->setDbValueDef($rsnew, $this->DeductionDescription->CurrentValue, NULL, FALSE);

		// Division
		$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, NULL, FALSE);

		// DeductionAmount
		$this->DeductionAmount->setDbValueDef($rsnew, $this->DeductionAmount->CurrentValue, NULL, strval($this->DeductionAmount->CurrentValue) == "");

		// DeductionBasicRate
		$this->DeductionBasicRate->setDbValueDef($rsnew, $this->DeductionBasicRate->CurrentValue, NULL, strval($this->DeductionBasicRate->CurrentValue) == "");

		// RemittedTo
		$this->RemittedTo->setDbValueDef($rsnew, $this->RemittedTo->CurrentValue, NULL, FALSE);

		// AccountNo
		$this->AccountNo->setDbValueDef($rsnew, $this->AccountNo->CurrentValue, NULL, FALSE);

		// BaseIncomeCode
		$this->BaseIncomeCode->setDbValueDef($rsnew, $this->BaseIncomeCode->CurrentValue, NULL, FALSE);

		// BaseDeductionCode
		$this->BaseDeductionCode->setDbValueDef($rsnew, $this->BaseDeductionCode->CurrentValue, NULL, FALSE);

		// TaxExempt
		$this->TaxExempt->setDbValueDef($rsnew, $this->TaxExempt->CurrentValue, NULL, strval($this->TaxExempt->CurrentValue) == "");

		// JobCode
		$this->JobCode->setDbValueDef($rsnew, $this->JobCode->CurrentValue, NULL, FALSE);

		// MinimumAmount
		$this->MinimumAmount->setDbValueDef($rsnew, $this->MinimumAmount->CurrentValue, NULL, FALSE);

		// MaximumAmount
		$this->MaximumAmount->setDbValueDef($rsnew, $this->MaximumAmount->CurrentValue, NULL, FALSE);

		// EmployerContributionRate
		$this->EmployerContributionRate->setDbValueDef($rsnew, $this->EmployerContributionRate->CurrentValue, NULL, FALSE);

		// EmployerContributionAmount
		$this->EmployerContributionAmount->setDbValueDef($rsnew, $this->EmployerContributionAmount->CurrentValue, NULL, FALSE);

		// Application
		$this->Application->setDbValueDef($rsnew, $this->Application->CurrentValue, NULL, FALSE);

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
		$this->DeductionCode->AdvancedSearch->load();
		$this->DeductionName->AdvancedSearch->load();
		$this->DeductionDescription->AdvancedSearch->load();
		$this->Division->AdvancedSearch->load();
		$this->DeductionAmount->AdvancedSearch->load();
		$this->DeductionBasicRate->AdvancedSearch->load();
		$this->RemittedTo->AdvancedSearch->load();
		$this->AccountNo->AdvancedSearch->load();
		$this->BaseIncomeCode->AdvancedSearch->load();
		$this->BaseDeductionCode->AdvancedSearch->load();
		$this->TaxExempt->AdvancedSearch->load();
		$this->JobCode->AdvancedSearch->load();
		$this->MinimumAmount->AdvancedSearch->load();
		$this->MaximumAmount->AdvancedSearch->load();
		$this->EmployerContributionRate->AdvancedSearch->load();
		$this->EmployerContributionAmount->AdvancedSearch->load();
		$this->Application->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fdeduction_typelist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fdeduction_typelist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fdeduction_typelist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_deduction_type" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_deduction_type\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fdeduction_typelist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdeduction_typelistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"deduction_typesrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"deduction_type\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'deduction_typesrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fdeduction_typelistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
				case "x_AccountNo":
					break;
				case "x_BaseIncomeCode":
					break;
				case "x_BaseDeductionCode":
					break;
				case "x_TaxExempt":
					break;
				case "x_JobCode":
					break;
				case "x_Application":
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
						case "x_AccountNo":
							break;
						case "x_BaseIncomeCode":
							break;
						case "x_BaseDeductionCode":
							break;
						case "x_TaxExempt":
							break;
						case "x_JobCode":
							break;
						case "x_Application":
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