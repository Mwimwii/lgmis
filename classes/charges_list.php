<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class charges_list extends charges
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'charges';

	// Page object name
	public $PageObjName = "charges_list";

	// Grid form hidden field names
	public $FormName = "fchargeslist";
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

		// Table object (charges)
		if (!isset($GLOBALS["charges"]) || get_class($GLOBALS["charges"]) == PROJECT_NAMESPACE . "charges") {
			$GLOBALS["charges"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["charges"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "chargesadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "chargesdelete.php";
		$this->MultiUpdateUrl = "chargesupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'charges');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fchargeslistsrch";

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
		global $charges;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($charges);
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
			$key .= @$ar['ChargeCode'];
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
			$this->ChargeCode->Visible = FALSE;
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
		$this->ChargeCode->setVisibility();
		$this->ChargeDesc->setVisibility();
		$this->Fee->setVisibility();
		$this->ChargeType->setVisibility();
		$this->Frequency->setVisibility();
		$this->Installment->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->GLAccount->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Factor->setVisibility();
		$this->PeriodType->setVisibility();
		$this->ClearedChargeCode->setVisibility();
		$this->PropertyUse->setVisibility();
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
		$this->setupLookupOptions($this->ChargeType);
		$this->setupLookupOptions($this->Installment);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->GLAccount);
		$this->setupLookupOptions($this->ChargeGroup);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PeriodType);
		$this->setupLookupOptions($this->ClearedChargeCode);
		$this->setupLookupOptions($this->PropertyUse);

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

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

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
		}

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
		$this->Fee->FormValue = ""; // Clear form value
		$this->Frequency->FormValue = ""; // Clear form value
		$this->Factor->FormValue = ""; // Clear form value
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
			$this->ChargeCode->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ChargeCode->OldValue))
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
					$key .= $this->ChargeCode->CurrentValue;

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
		if ($CurrentForm->hasValue("x_ChargeDesc") && $CurrentForm->hasValue("o_ChargeDesc") && $this->ChargeDesc->CurrentValue != $this->ChargeDesc->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Fee") && $CurrentForm->hasValue("o_Fee") && $this->Fee->CurrentValue != $this->Fee->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeType") && $CurrentForm->hasValue("o_ChargeType") && $this->ChargeType->CurrentValue != $this->ChargeType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Frequency") && $CurrentForm->hasValue("o_Frequency") && $this->Frequency->CurrentValue != $this->Frequency->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Installment") && $CurrentForm->hasValue("o_Installment") && $this->Installment->CurrentValue != $this->Installment->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepartmentCode") && $CurrentForm->hasValue("o_DepartmentCode") && $this->DepartmentCode->CurrentValue != $this->DepartmentCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_GLAccount") && $CurrentForm->hasValue("o_GLAccount") && $this->GLAccount->CurrentValue != $this->GLAccount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeGroup") && $CurrentForm->hasValue("o_ChargeGroup") && $this->ChargeGroup->CurrentValue != $this->ChargeGroup->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitOfMeasure") && $CurrentForm->hasValue("o_UnitOfMeasure") && $this->UnitOfMeasure->CurrentValue != $this->UnitOfMeasure->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Factor") && $CurrentForm->hasValue("o_Factor") && $this->Factor->CurrentValue != $this->Factor->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PeriodType") && $CurrentForm->hasValue("o_PeriodType") && $this->PeriodType->CurrentValue != $this->PeriodType->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ClearedChargeCode") && $CurrentForm->hasValue("o_ClearedChargeCode") && $this->ClearedChargeCode->CurrentValue != $this->ClearedChargeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PropertyUse") && $CurrentForm->hasValue("o_PropertyUse") && $this->PropertyUse->CurrentValue != $this->PropertyUse->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fchargeslistsrch");
		$filterList = Concat($filterList, $this->ChargeCode->AdvancedSearch->toJson(), ","); // Field ChargeCode
		$filterList = Concat($filterList, $this->ChargeDesc->AdvancedSearch->toJson(), ","); // Field ChargeDesc
		$filterList = Concat($filterList, $this->Fee->AdvancedSearch->toJson(), ","); // Field Fee
		$filterList = Concat($filterList, $this->ChargeType->AdvancedSearch->toJson(), ","); // Field ChargeType
		$filterList = Concat($filterList, $this->Frequency->AdvancedSearch->toJson(), ","); // Field Frequency
		$filterList = Concat($filterList, $this->Installment->AdvancedSearch->toJson(), ","); // Field Installment
		$filterList = Concat($filterList, $this->DepartmentCode->AdvancedSearch->toJson(), ","); // Field DepartmentCode
		$filterList = Concat($filterList, $this->GLAccount->AdvancedSearch->toJson(), ","); // Field GLAccount
		$filterList = Concat($filterList, $this->ChargeGroup->AdvancedSearch->toJson(), ","); // Field ChargeGroup
		$filterList = Concat($filterList, $this->UnitOfMeasure->AdvancedSearch->toJson(), ","); // Field UnitOfMeasure
		$filterList = Concat($filterList, $this->Factor->AdvancedSearch->toJson(), ","); // Field Factor
		$filterList = Concat($filterList, $this->PeriodType->AdvancedSearch->toJson(), ","); // Field PeriodType
		$filterList = Concat($filterList, $this->ClearedChargeCode->AdvancedSearch->toJson(), ","); // Field ClearedChargeCode
		$filterList = Concat($filterList, $this->PropertyUse->AdvancedSearch->toJson(), ","); // Field PropertyUse
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fchargeslistsrch", $filters);
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

		// Field ChargeCode
		$this->ChargeCode->AdvancedSearch->SearchValue = @$filter["x_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchOperator = @$filter["z_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchCondition = @$filter["v_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchValue2 = @$filter["y_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->save();

		// Field ChargeDesc
		$this->ChargeDesc->AdvancedSearch->SearchValue = @$filter["x_ChargeDesc"];
		$this->ChargeDesc->AdvancedSearch->SearchOperator = @$filter["z_ChargeDesc"];
		$this->ChargeDesc->AdvancedSearch->SearchCondition = @$filter["v_ChargeDesc"];
		$this->ChargeDesc->AdvancedSearch->SearchValue2 = @$filter["y_ChargeDesc"];
		$this->ChargeDesc->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeDesc"];
		$this->ChargeDesc->AdvancedSearch->save();

		// Field Fee
		$this->Fee->AdvancedSearch->SearchValue = @$filter["x_Fee"];
		$this->Fee->AdvancedSearch->SearchOperator = @$filter["z_Fee"];
		$this->Fee->AdvancedSearch->SearchCondition = @$filter["v_Fee"];
		$this->Fee->AdvancedSearch->SearchValue2 = @$filter["y_Fee"];
		$this->Fee->AdvancedSearch->SearchOperator2 = @$filter["w_Fee"];
		$this->Fee->AdvancedSearch->save();

		// Field ChargeType
		$this->ChargeType->AdvancedSearch->SearchValue = @$filter["x_ChargeType"];
		$this->ChargeType->AdvancedSearch->SearchOperator = @$filter["z_ChargeType"];
		$this->ChargeType->AdvancedSearch->SearchCondition = @$filter["v_ChargeType"];
		$this->ChargeType->AdvancedSearch->SearchValue2 = @$filter["y_ChargeType"];
		$this->ChargeType->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeType"];
		$this->ChargeType->AdvancedSearch->save();

		// Field Frequency
		$this->Frequency->AdvancedSearch->SearchValue = @$filter["x_Frequency"];
		$this->Frequency->AdvancedSearch->SearchOperator = @$filter["z_Frequency"];
		$this->Frequency->AdvancedSearch->SearchCondition = @$filter["v_Frequency"];
		$this->Frequency->AdvancedSearch->SearchValue2 = @$filter["y_Frequency"];
		$this->Frequency->AdvancedSearch->SearchOperator2 = @$filter["w_Frequency"];
		$this->Frequency->AdvancedSearch->save();

		// Field Installment
		$this->Installment->AdvancedSearch->SearchValue = @$filter["x_Installment"];
		$this->Installment->AdvancedSearch->SearchOperator = @$filter["z_Installment"];
		$this->Installment->AdvancedSearch->SearchCondition = @$filter["v_Installment"];
		$this->Installment->AdvancedSearch->SearchValue2 = @$filter["y_Installment"];
		$this->Installment->AdvancedSearch->SearchOperator2 = @$filter["w_Installment"];
		$this->Installment->AdvancedSearch->save();

		// Field DepartmentCode
		$this->DepartmentCode->AdvancedSearch->SearchValue = @$filter["x_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchOperator = @$filter["z_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchCondition = @$filter["v_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchValue2 = @$filter["y_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchOperator2 = @$filter["w_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->save();

		// Field GLAccount
		$this->GLAccount->AdvancedSearch->SearchValue = @$filter["x_GLAccount"];
		$this->GLAccount->AdvancedSearch->SearchOperator = @$filter["z_GLAccount"];
		$this->GLAccount->AdvancedSearch->SearchCondition = @$filter["v_GLAccount"];
		$this->GLAccount->AdvancedSearch->SearchValue2 = @$filter["y_GLAccount"];
		$this->GLAccount->AdvancedSearch->SearchOperator2 = @$filter["w_GLAccount"];
		$this->GLAccount->AdvancedSearch->save();

		// Field ChargeGroup
		$this->ChargeGroup->AdvancedSearch->SearchValue = @$filter["x_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchOperator = @$filter["z_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchCondition = @$filter["v_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchValue2 = @$filter["y_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->save();

		// Field UnitOfMeasure
		$this->UnitOfMeasure->AdvancedSearch->SearchValue = @$filter["x_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator = @$filter["z_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchCondition = @$filter["v_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchValue2 = @$filter["y_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator2 = @$filter["w_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->save();

		// Field Factor
		$this->Factor->AdvancedSearch->SearchValue = @$filter["x_Factor"];
		$this->Factor->AdvancedSearch->SearchOperator = @$filter["z_Factor"];
		$this->Factor->AdvancedSearch->SearchCondition = @$filter["v_Factor"];
		$this->Factor->AdvancedSearch->SearchValue2 = @$filter["y_Factor"];
		$this->Factor->AdvancedSearch->SearchOperator2 = @$filter["w_Factor"];
		$this->Factor->AdvancedSearch->save();

		// Field PeriodType
		$this->PeriodType->AdvancedSearch->SearchValue = @$filter["x_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchOperator = @$filter["z_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchCondition = @$filter["v_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchValue2 = @$filter["y_PeriodType"];
		$this->PeriodType->AdvancedSearch->SearchOperator2 = @$filter["w_PeriodType"];
		$this->PeriodType->AdvancedSearch->save();

		// Field ClearedChargeCode
		$this->ClearedChargeCode->AdvancedSearch->SearchValue = @$filter["x_ClearedChargeCode"];
		$this->ClearedChargeCode->AdvancedSearch->SearchOperator = @$filter["z_ClearedChargeCode"];
		$this->ClearedChargeCode->AdvancedSearch->SearchCondition = @$filter["v_ClearedChargeCode"];
		$this->ClearedChargeCode->AdvancedSearch->SearchValue2 = @$filter["y_ClearedChargeCode"];
		$this->ClearedChargeCode->AdvancedSearch->SearchOperator2 = @$filter["w_ClearedChargeCode"];
		$this->ClearedChargeCode->AdvancedSearch->save();

		// Field PropertyUse
		$this->PropertyUse->AdvancedSearch->SearchValue = @$filter["x_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchOperator = @$filter["z_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchCondition = @$filter["v_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchValue2 = @$filter["y_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->ChargeDesc, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->GLAccount, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->UnitOfMeasure, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PeriodType, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ClearedChargeCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PropertyUse, $arKeywords, $type);
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

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->ChargeCode); // ChargeCode
			$this->updateSort($this->ChargeDesc); // ChargeDesc
			$this->updateSort($this->Fee); // Fee
			$this->updateSort($this->ChargeType); // ChargeType
			$this->updateSort($this->Frequency); // Frequency
			$this->updateSort($this->Installment); // Installment
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->GLAccount); // GLAccount
			$this->updateSort($this->ChargeGroup); // ChargeGroup
			$this->updateSort($this->UnitOfMeasure); // UnitOfMeasure
			$this->updateSort($this->Factor); // Factor
			$this->updateSort($this->PeriodType); // PeriodType
			$this->updateSort($this->ClearedChargeCode); // ClearedChargeCode
			$this->updateSort($this->PropertyUse); // PropertyUse
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
				$this->ChargeCode->setSort("");
				$this->ChargeDesc->setSort("");
				$this->Fee->setSort("");
				$this->ChargeType->setSort("");
				$this->Frequency->setSort("");
				$this->Installment->setSort("");
				$this->DepartmentCode->setSort("");
				$this->GLAccount->setSort("");
				$this->ChargeGroup->setSort("");
				$this->UnitOfMeasure->setSort("");
				$this->Factor->setSort("");
				$this->PeriodType->setSort("");
				$this->ClearedChargeCode->setSort("");
				$this->PropertyUse->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ChargeCode->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->ChargeCode->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fchargeslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fchargeslistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fchargeslist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->ChargeCode->CurrentValue = NULL;
		$this->ChargeCode->OldValue = $this->ChargeCode->CurrentValue;
		$this->ChargeDesc->CurrentValue = NULL;
		$this->ChargeDesc->OldValue = $this->ChargeDesc->CurrentValue;
		$this->Fee->CurrentValue = NULL;
		$this->Fee->OldValue = $this->Fee->CurrentValue;
		$this->ChargeType->CurrentValue = NULL;
		$this->ChargeType->OldValue = $this->ChargeType->CurrentValue;
		$this->Frequency->CurrentValue = NULL;
		$this->Frequency->OldValue = $this->Frequency->CurrentValue;
		$this->Installment->CurrentValue = NULL;
		$this->Installment->OldValue = $this->Installment->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->GLAccount->CurrentValue = NULL;
		$this->GLAccount->OldValue = $this->GLAccount->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->Factor->CurrentValue = NULL;
		$this->Factor->OldValue = $this->Factor->CurrentValue;
		$this->PeriodType->CurrentValue = "1";
		$this->PeriodType->OldValue = $this->PeriodType->CurrentValue;
		$this->ClearedChargeCode->CurrentValue = NULL;
		$this->ClearedChargeCode->OldValue = $this->ClearedChargeCode->CurrentValue;
		$this->PropertyUse->CurrentValue = NULL;
		$this->PropertyUse->OldValue = $this->PropertyUse->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->ChargeCode->setFormValue($val);

		// Check field name 'ChargeDesc' first before field var 'x_ChargeDesc'
		$val = $CurrentForm->hasValue("ChargeDesc") ? $CurrentForm->getValue("ChargeDesc") : $CurrentForm->getValue("x_ChargeDesc");
		if (!$this->ChargeDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeDesc->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeDesc->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeDesc"))
			$this->ChargeDesc->setOldValue($CurrentForm->getValue("o_ChargeDesc"));

		// Check field name 'Fee' first before field var 'x_Fee'
		$val = $CurrentForm->hasValue("Fee") ? $CurrentForm->getValue("Fee") : $CurrentForm->getValue("x_Fee");
		if (!$this->Fee->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Fee->Visible = FALSE; // Disable update for API request
			else
				$this->Fee->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Fee"))
			$this->Fee->setOldValue($CurrentForm->getValue("o_Fee"));

		// Check field name 'ChargeType' first before field var 'x_ChargeType'
		$val = $CurrentForm->hasValue("ChargeType") ? $CurrentForm->getValue("ChargeType") : $CurrentForm->getValue("x_ChargeType");
		if (!$this->ChargeType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeType->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeType"))
			$this->ChargeType->setOldValue($CurrentForm->getValue("o_ChargeType"));

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

		// Check field name 'Installment' first before field var 'x_Installment'
		$val = $CurrentForm->hasValue("Installment") ? $CurrentForm->getValue("Installment") : $CurrentForm->getValue("x_Installment");
		if (!$this->Installment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Installment->Visible = FALSE; // Disable update for API request
			else
				$this->Installment->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Installment"))
			$this->Installment->setOldValue($CurrentForm->getValue("o_Installment"));

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

		// Check field name 'GLAccount' first before field var 'x_GLAccount'
		$val = $CurrentForm->hasValue("GLAccount") ? $CurrentForm->getValue("GLAccount") : $CurrentForm->getValue("x_GLAccount");
		if (!$this->GLAccount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->GLAccount->Visible = FALSE; // Disable update for API request
			else
				$this->GLAccount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_GLAccount"))
			$this->GLAccount->setOldValue($CurrentForm->getValue("o_GLAccount"));

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeGroup"))
			$this->ChargeGroup->setOldValue($CurrentForm->getValue("o_ChargeGroup"));

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

		// Check field name 'Factor' first before field var 'x_Factor'
		$val = $CurrentForm->hasValue("Factor") ? $CurrentForm->getValue("Factor") : $CurrentForm->getValue("x_Factor");
		if (!$this->Factor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Factor->Visible = FALSE; // Disable update for API request
			else
				$this->Factor->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Factor"))
			$this->Factor->setOldValue($CurrentForm->getValue("o_Factor"));

		// Check field name 'PeriodType' first before field var 'x_PeriodType'
		$val = $CurrentForm->hasValue("PeriodType") ? $CurrentForm->getValue("PeriodType") : $CurrentForm->getValue("x_PeriodType");
		if (!$this->PeriodType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodType->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodType->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PeriodType"))
			$this->PeriodType->setOldValue($CurrentForm->getValue("o_PeriodType"));

		// Check field name 'ClearedChargeCode' first before field var 'x_ClearedChargeCode'
		$val = $CurrentForm->hasValue("ClearedChargeCode") ? $CurrentForm->getValue("ClearedChargeCode") : $CurrentForm->getValue("x_ClearedChargeCode");
		if (!$this->ClearedChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClearedChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ClearedChargeCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ClearedChargeCode"))
			$this->ClearedChargeCode->setOldValue($CurrentForm->getValue("o_ClearedChargeCode"));

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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ChargeDesc->CurrentValue = $this->ChargeDesc->FormValue;
		$this->Fee->CurrentValue = $this->Fee->FormValue;
		$this->ChargeType->CurrentValue = $this->ChargeType->FormValue;
		$this->Frequency->CurrentValue = $this->Frequency->FormValue;
		$this->Installment->CurrentValue = $this->Installment->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->GLAccount->CurrentValue = $this->GLAccount->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->Factor->CurrentValue = $this->Factor->FormValue;
		$this->PeriodType->CurrentValue = $this->PeriodType->FormValue;
		$this->ClearedChargeCode->CurrentValue = $this->ClearedChargeCode->FormValue;
		$this->PropertyUse->CurrentValue = $this->PropertyUse->FormValue;
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
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		$this->ChargeDesc->setDbValue($row['ChargeDesc']);
		$this->Fee->setDbValue($row['Fee']);
		$this->ChargeType->setDbValue($row['ChargeType']);
		$this->Frequency->setDbValue($row['Frequency']);
		$this->Installment->setDbValue($row['Installment']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->GLAccount->setDbValue($row['GLAccount']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->Factor->setDbValue($row['Factor']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->ClearedChargeCode->setDbValue($row['ClearedChargeCode']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ChargeCode'] = $this->ChargeCode->CurrentValue;
		$row['ChargeDesc'] = $this->ChargeDesc->CurrentValue;
		$row['Fee'] = $this->Fee->CurrentValue;
		$row['ChargeType'] = $this->ChargeType->CurrentValue;
		$row['Frequency'] = $this->Frequency->CurrentValue;
		$row['Installment'] = $this->Installment->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['GLAccount'] = $this->GLAccount->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['Factor'] = $this->Factor->CurrentValue;
		$row['PeriodType'] = $this->PeriodType->CurrentValue;
		$row['ClearedChargeCode'] = $this->ClearedChargeCode->CurrentValue;
		$row['PropertyUse'] = $this->PropertyUse->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ChargeCode")) != "")
			$this->ChargeCode->OldValue = $this->getKey("ChargeCode"); // ChargeCode
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
		if ($this->Fee->FormValue == $this->Fee->CurrentValue && is_numeric(ConvertToFloatString($this->Fee->CurrentValue)))
			$this->Fee->CurrentValue = ConvertToFloatString($this->Fee->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Frequency->FormValue == $this->Frequency->CurrentValue && is_numeric(ConvertToFloatString($this->Frequency->CurrentValue)))
			$this->Frequency->CurrentValue = ConvertToFloatString($this->Frequency->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Factor->FormValue == $this->Factor->CurrentValue && is_numeric(ConvertToFloatString($this->Factor->CurrentValue)))
			$this->Factor->CurrentValue = ConvertToFloatString($this->Factor->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ChargeCode
		// ChargeDesc
		// Fee
		// ChargeType
		// Frequency
		// Installment
		// DepartmentCode
		// GLAccount
		// ChargeGroup
		// UnitOfMeasure
		// Factor
		// PeriodType
		// ClearedChargeCode
		// PropertyUse

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ChargeCode
			$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
			$this->ChargeCode->ViewCustomAttributes = "";

			// ChargeDesc
			$this->ChargeDesc->ViewValue = $this->ChargeDesc->CurrentValue;
			$this->ChargeDesc->ViewCustomAttributes = "";

			// Fee
			$this->Fee->ViewValue = $this->Fee->CurrentValue;
			$this->Fee->ViewValue = FormatNumber($this->Fee->ViewValue, 2, -2, -2, -2);
			$this->Fee->CellCssStyle .= "text-align: right;";
			$this->Fee->ViewCustomAttributes = "";

			// ChargeType
			$curVal = strval($this->ChargeType->CurrentValue);
			if ($curVal != "") {
				$this->ChargeType->ViewValue = $this->ChargeType->lookupCacheOption($curVal);
				if ($this->ChargeType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ChargeType->ViewValue = $this->ChargeType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeType->ViewValue = $this->ChargeType->CurrentValue;
					}
				}
			} else {
				$this->ChargeType->ViewValue = NULL;
			}
			$this->ChargeType->ViewCustomAttributes = "";

			// Frequency
			$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
			$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Frequency->ViewCustomAttributes = "";

			// Installment
			$curVal = strval($this->Installment->CurrentValue);
			if ($curVal != "") {
				$this->Installment->ViewValue = $this->Installment->lookupCacheOption($curVal);
				if ($this->Installment->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Installment->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Installment->ViewValue = $this->Installment->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Installment->ViewValue = $this->Installment->CurrentValue;
					}
				}
			} else {
				$this->Installment->ViewValue = NULL;
			}
			$this->Installment->ViewCustomAttributes = "";

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

			// GLAccount
			$curVal = strval($this->GLAccount->CurrentValue);
			if ($curVal != "") {
				$this->GLAccount->ViewValue = $this->GLAccount->lookupCacheOption($curVal);
				if ($this->GLAccount->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->GLAccount->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->GLAccount->ViewValue = $this->GLAccount->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->GLAccount->ViewValue = $this->GLAccount->CurrentValue;
					}
				}
			} else {
				$this->GLAccount->ViewValue = NULL;
			}
			$this->GLAccount->ViewCustomAttributes = "";

			// ChargeGroup
			$curVal = strval($this->ChargeGroup->CurrentValue);
			if ($curVal != "") {
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
				if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeGroup`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ChargeGroup->ViewValue = $this->ChargeGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
					}
				}
			} else {
				$this->ChargeGroup->ViewValue = NULL;
			}
			$this->ChargeGroup->ViewCustomAttributes = "";

			// UnitOfMeasure
			$curVal = strval($this->UnitOfMeasure->CurrentValue);
			if ($curVal != "") {
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
				if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`UnitOfMeasure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
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

			// Factor
			$this->Factor->ViewValue = $this->Factor->CurrentValue;
			$this->Factor->ViewValue = FormatNumber($this->Factor->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Factor->ViewCustomAttributes = "";

			// PeriodType
			$curVal = strval($this->PeriodType->CurrentValue);
			if ($curVal != "") {
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
				if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
					}
				}
			} else {
				$this->PeriodType->ViewValue = NULL;
			}
			$this->PeriodType->ViewCustomAttributes = "";

			// ClearedChargeCode
			$curVal = strval($this->ClearedChargeCode->CurrentValue);
			if ($curVal != "") {
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->lookupCacheOption($curVal);
				if ($this->ClearedChargeCode->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ClearedChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->ClearedChargeCode->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2);
							$this->ClearedChargeCode->ViewValue->add($this->ClearedChargeCode->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->CurrentValue;
					}
				}
			} else {
				$this->ClearedChargeCode->ViewValue = NULL;
			}
			$this->ClearedChargeCode->ViewCustomAttributes = "";

			// PropertyUse
			$curVal = strval($this->PropertyUse->CurrentValue);
			if ($curVal != "") {
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
				if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyUse`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyUse->ViewValue = $this->PropertyUse->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
					}
				}
			} else {
				$this->PropertyUse->ViewValue = NULL;
			}
			$this->PropertyUse->ViewCustomAttributes = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ChargeDesc
			$this->ChargeDesc->LinkCustomAttributes = "";
			$this->ChargeDesc->HrefValue = "";
			$this->ChargeDesc->TooltipValue = "";

			// Fee
			$this->Fee->LinkCustomAttributes = "";
			$this->Fee->HrefValue = "";
			$this->Fee->TooltipValue = "";

			// ChargeType
			$this->ChargeType->LinkCustomAttributes = "";
			$this->ChargeType->HrefValue = "";
			$this->ChargeType->TooltipValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";
			$this->Frequency->TooltipValue = "";

			// Installment
			$this->Installment->LinkCustomAttributes = "";
			$this->Installment->HrefValue = "";
			$this->Installment->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// GLAccount
			$this->GLAccount->LinkCustomAttributes = "";
			$this->GLAccount->HrefValue = "";
			$this->GLAccount->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Factor
			$this->Factor->LinkCustomAttributes = "";
			$this->Factor->HrefValue = "";
			$this->Factor->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// ClearedChargeCode
			$this->ClearedChargeCode->LinkCustomAttributes = "";
			$this->ClearedChargeCode->HrefValue = "";
			$this->ClearedChargeCode->TooltipValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ChargeCode
			// ChargeDesc

			$this->ChargeDesc->EditAttrs["class"] = "form-control";
			$this->ChargeDesc->EditCustomAttributes = "";
			if (!$this->ChargeDesc->Raw)
				$this->ChargeDesc->CurrentValue = HtmlDecode($this->ChargeDesc->CurrentValue);
			$this->ChargeDesc->EditValue = HtmlEncode($this->ChargeDesc->CurrentValue);
			$this->ChargeDesc->PlaceHolder = RemoveHtml($this->ChargeDesc->caption());

			// Fee
			$this->Fee->EditAttrs["class"] = "form-control";
			$this->Fee->EditCustomAttributes = "";
			$this->Fee->EditValue = HtmlEncode($this->Fee->CurrentValue);
			$this->Fee->PlaceHolder = RemoveHtml($this->Fee->caption());
			if (strval($this->Fee->EditValue) != "" && is_numeric($this->Fee->EditValue)) {
				$this->Fee->EditValue = FormatNumber($this->Fee->EditValue, -2, -2, -2, -2);
				$this->Fee->OldValue = $this->Fee->EditValue;
			}
			

			// ChargeType
			$this->ChargeType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeType->CurrentValue));
			if ($curVal != "")
				$this->ChargeType->ViewValue = $this->ChargeType->lookupCacheOption($curVal);
			else
				$this->ChargeType->ViewValue = $this->ChargeType->Lookup !== NULL && is_array($this->ChargeType->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeType->ViewValue !== NULL) { // Load from cache
				$this->ChargeType->EditValue = array_values($this->ChargeType->Lookup->Options);
				if ($this->ChargeType->ViewValue == "")
					$this->ChargeType->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeType`" . SearchString("=", $this->ChargeType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ChargeType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ChargeType->ViewValue = $this->ChargeType->displayValue($arwrk);
				} else {
					$this->ChargeType->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeType->EditValue = $arwrk;
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
			

			// Installment
			$this->Installment->EditAttrs["class"] = "form-control";
			$this->Installment->EditCustomAttributes = "";
			$curVal = trim(strval($this->Installment->CurrentValue));
			if ($curVal != "")
				$this->Installment->ViewValue = $this->Installment->lookupCacheOption($curVal);
			else
				$this->Installment->ViewValue = $this->Installment->Lookup !== NULL && is_array($this->Installment->Lookup->Options) ? $curVal : NULL;
			if ($this->Installment->ViewValue !== NULL) { // Load from cache
				$this->Installment->EditValue = array_values($this->Installment->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Installment->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Installment->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Installment->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->CurrentValue));
			if ($curVal != "")
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
				if ($this->DepartmentCode->ViewValue == "")
					$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
				} else {
					$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->DepartmentCode->EditValue = $arwrk;
			}

			// GLAccount
			$this->GLAccount->EditCustomAttributes = "";
			$curVal = trim(strval($this->GLAccount->CurrentValue));
			if ($curVal != "")
				$this->GLAccount->ViewValue = $this->GLAccount->lookupCacheOption($curVal);
			else
				$this->GLAccount->ViewValue = $this->GLAccount->Lookup !== NULL && is_array($this->GLAccount->Lookup->Options) ? $curVal : NULL;
			if ($this->GLAccount->ViewValue !== NULL) { // Load from cache
				$this->GLAccount->EditValue = array_values($this->GLAccount->Lookup->Options);
				if ($this->GLAccount->ViewValue == "")
					$this->GLAccount->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->GLAccount->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->GLAccount->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->GLAccount->ViewValue = $this->GLAccount->displayValue($arwrk);
				} else {
					$this->GLAccount->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GLAccount->EditValue = $arwrk;
			}

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeGroup->CurrentValue));
			if ($curVal != "")
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			else
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->Lookup !== NULL && is_array($this->ChargeGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeGroup->ViewValue !== NULL) { // Load from cache
				$this->ChargeGroup->EditValue = array_values($this->ChargeGroup->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeGroup`" . SearchString("=", $this->ChargeGroup->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGroup->EditValue = $arwrk;
			}

			// UnitOfMeasure
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
				if ($this->UnitOfMeasure->ViewValue == "")
					$this->UnitOfMeasure->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`UnitOfMeasure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
				} else {
					$this->UnitOfMeasure->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// Factor
			$this->Factor->EditAttrs["class"] = "form-control";
			$this->Factor->EditCustomAttributes = "";
			$this->Factor->EditValue = HtmlEncode($this->Factor->CurrentValue);
			$this->Factor->PlaceHolder = RemoveHtml($this->Factor->caption());
			if (strval($this->Factor->EditValue) != "" && is_numeric($this->Factor->EditValue)) {
				$this->Factor->EditValue = FormatNumber($this->Factor->EditValue, -2, -1, -2, 0);
				$this->Factor->OldValue = $this->Factor->EditValue;
			}
			

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			$curVal = trim(strval($this->PeriodType->CurrentValue));
			if ($curVal != "")
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			else
				$this->PeriodType->ViewValue = $this->PeriodType->Lookup !== NULL && is_array($this->PeriodType->Lookup->Options) ? $curVal : NULL;
			if ($this->PeriodType->ViewValue !== NULL) { // Load from cache
				$this->PeriodType->EditValue = array_values($this->PeriodType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Period_Type`" . SearchString("=", $this->PeriodType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PeriodType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PeriodType->EditValue = $arwrk;
			}

			// ClearedChargeCode
			$this->ClearedChargeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ClearedChargeCode->CurrentValue));
			if ($curVal != "")
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->lookupCacheOption($curVal);
			else
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->Lookup !== NULL && is_array($this->ClearedChargeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ClearedChargeCode->ViewValue !== NULL) { // Load from cache
				$this->ClearedChargeCode->EditValue = array_values($this->ClearedChargeCode->Lookup->Options);
				if ($this->ClearedChargeCode->ViewValue == "")
					$this->ClearedChargeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ClearedChargeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ClearedChargeCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode(FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2));
						$this->ClearedChargeCode->ViewValue->add($this->ClearedChargeCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ClearedChargeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][3] = FormatNumber($arwrk[$i][3], 2, -2, -2, -2);
				}
				$this->ClearedChargeCode->EditValue = $arwrk;
			}

			// PropertyUse
			$this->PropertyUse->EditAttrs["class"] = "form-control";
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->CurrentValue));
			if ($curVal != "")
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PropertyUse`" . SearchString("=", $this->PropertyUse->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// Add refer script
			// ChargeCode

			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ChargeDesc
			$this->ChargeDesc->LinkCustomAttributes = "";
			$this->ChargeDesc->HrefValue = "";

			// Fee
			$this->Fee->LinkCustomAttributes = "";
			$this->Fee->HrefValue = "";

			// ChargeType
			$this->ChargeType->LinkCustomAttributes = "";
			$this->ChargeType->HrefValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";

			// Installment
			$this->Installment->LinkCustomAttributes = "";
			$this->Installment->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// GLAccount
			$this->GLAccount->LinkCustomAttributes = "";
			$this->GLAccount->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Factor
			$this->Factor->LinkCustomAttributes = "";
			$this->Factor->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// ClearedChargeCode
			$this->ClearedChargeCode->LinkCustomAttributes = "";
			$this->ClearedChargeCode->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
			$this->ChargeCode->ViewCustomAttributes = "";

			// ChargeDesc
			$this->ChargeDesc->EditAttrs["class"] = "form-control";
			$this->ChargeDesc->EditCustomAttributes = "";
			if (!$this->ChargeDesc->Raw)
				$this->ChargeDesc->CurrentValue = HtmlDecode($this->ChargeDesc->CurrentValue);
			$this->ChargeDesc->EditValue = HtmlEncode($this->ChargeDesc->CurrentValue);
			$this->ChargeDesc->PlaceHolder = RemoveHtml($this->ChargeDesc->caption());

			// Fee
			$this->Fee->EditAttrs["class"] = "form-control";
			$this->Fee->EditCustomAttributes = "";
			$this->Fee->EditValue = HtmlEncode($this->Fee->CurrentValue);
			$this->Fee->PlaceHolder = RemoveHtml($this->Fee->caption());
			if (strval($this->Fee->EditValue) != "" && is_numeric($this->Fee->EditValue)) {
				$this->Fee->EditValue = FormatNumber($this->Fee->EditValue, -2, -2, -2, -2);
				$this->Fee->OldValue = $this->Fee->EditValue;
			}
			

			// ChargeType
			$this->ChargeType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeType->CurrentValue));
			if ($curVal != "")
				$this->ChargeType->ViewValue = $this->ChargeType->lookupCacheOption($curVal);
			else
				$this->ChargeType->ViewValue = $this->ChargeType->Lookup !== NULL && is_array($this->ChargeType->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeType->ViewValue !== NULL) { // Load from cache
				$this->ChargeType->EditValue = array_values($this->ChargeType->Lookup->Options);
				if ($this->ChargeType->ViewValue == "")
					$this->ChargeType->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeType`" . SearchString("=", $this->ChargeType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ChargeType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ChargeType->ViewValue = $this->ChargeType->displayValue($arwrk);
				} else {
					$this->ChargeType->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeType->EditValue = $arwrk;
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
			

			// Installment
			$this->Installment->EditAttrs["class"] = "form-control";
			$this->Installment->EditCustomAttributes = "";
			$curVal = trim(strval($this->Installment->CurrentValue));
			if ($curVal != "")
				$this->Installment->ViewValue = $this->Installment->lookupCacheOption($curVal);
			else
				$this->Installment->ViewValue = $this->Installment->Lookup !== NULL && is_array($this->Installment->Lookup->Options) ? $curVal : NULL;
			if ($this->Installment->ViewValue !== NULL) { // Load from cache
				$this->Installment->EditValue = array_values($this->Installment->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Installment->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Installment->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Installment->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->CurrentValue));
			if ($curVal != "")
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
				if ($this->DepartmentCode->ViewValue == "")
					$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
				} else {
					$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->DepartmentCode->EditValue = $arwrk;
			}

			// GLAccount
			$this->GLAccount->EditCustomAttributes = "";
			$curVal = trim(strval($this->GLAccount->CurrentValue));
			if ($curVal != "")
				$this->GLAccount->ViewValue = $this->GLAccount->lookupCacheOption($curVal);
			else
				$this->GLAccount->ViewValue = $this->GLAccount->Lookup !== NULL && is_array($this->GLAccount->Lookup->Options) ? $curVal : NULL;
			if ($this->GLAccount->ViewValue !== NULL) { // Load from cache
				$this->GLAccount->EditValue = array_values($this->GLAccount->Lookup->Options);
				if ($this->GLAccount->ViewValue == "")
					$this->GLAccount->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->GLAccount->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->GLAccount->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->GLAccount->ViewValue = $this->GLAccount->displayValue($arwrk);
				} else {
					$this->GLAccount->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GLAccount->EditValue = $arwrk;
			}

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeGroup->CurrentValue));
			if ($curVal != "")
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			else
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->Lookup !== NULL && is_array($this->ChargeGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeGroup->ViewValue !== NULL) { // Load from cache
				$this->ChargeGroup->EditValue = array_values($this->ChargeGroup->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeGroup`" . SearchString("=", $this->ChargeGroup->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGroup->EditValue = $arwrk;
			}

			// UnitOfMeasure
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
				if ($this->UnitOfMeasure->ViewValue == "")
					$this->UnitOfMeasure->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`UnitOfMeasure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
				} else {
					$this->UnitOfMeasure->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// Factor
			$this->Factor->EditAttrs["class"] = "form-control";
			$this->Factor->EditCustomAttributes = "";
			$this->Factor->EditValue = HtmlEncode($this->Factor->CurrentValue);
			$this->Factor->PlaceHolder = RemoveHtml($this->Factor->caption());
			if (strval($this->Factor->EditValue) != "" && is_numeric($this->Factor->EditValue)) {
				$this->Factor->EditValue = FormatNumber($this->Factor->EditValue, -2, -1, -2, 0);
				$this->Factor->OldValue = $this->Factor->EditValue;
			}
			

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			$curVal = trim(strval($this->PeriodType->CurrentValue));
			if ($curVal != "")
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			else
				$this->PeriodType->ViewValue = $this->PeriodType->Lookup !== NULL && is_array($this->PeriodType->Lookup->Options) ? $curVal : NULL;
			if ($this->PeriodType->ViewValue !== NULL) { // Load from cache
				$this->PeriodType->EditValue = array_values($this->PeriodType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Period_Type`" . SearchString("=", $this->PeriodType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PeriodType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PeriodType->EditValue = $arwrk;
			}

			// ClearedChargeCode
			$this->ClearedChargeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ClearedChargeCode->CurrentValue));
			if ($curVal != "")
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->lookupCacheOption($curVal);
			else
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->Lookup !== NULL && is_array($this->ClearedChargeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ClearedChargeCode->ViewValue !== NULL) { // Load from cache
				$this->ClearedChargeCode->EditValue = array_values($this->ClearedChargeCode->Lookup->Options);
				if ($this->ClearedChargeCode->ViewValue == "")
					$this->ClearedChargeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ClearedChargeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ClearedChargeCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode(FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2));
						$this->ClearedChargeCode->ViewValue->add($this->ClearedChargeCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ClearedChargeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][3] = FormatNumber($arwrk[$i][3], 2, -2, -2, -2);
				}
				$this->ClearedChargeCode->EditValue = $arwrk;
			}

			// PropertyUse
			$this->PropertyUse->EditAttrs["class"] = "form-control";
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->CurrentValue));
			if ($curVal != "")
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PropertyUse`" . SearchString("=", $this->PropertyUse->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// Edit refer script
			// ChargeCode

			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ChargeDesc
			$this->ChargeDesc->LinkCustomAttributes = "";
			$this->ChargeDesc->HrefValue = "";

			// Fee
			$this->Fee->LinkCustomAttributes = "";
			$this->Fee->HrefValue = "";

			// ChargeType
			$this->ChargeType->LinkCustomAttributes = "";
			$this->ChargeType->HrefValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";

			// Installment
			$this->Installment->LinkCustomAttributes = "";
			$this->Installment->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// GLAccount
			$this->GLAccount->LinkCustomAttributes = "";
			$this->GLAccount->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Factor
			$this->Factor->LinkCustomAttributes = "";
			$this->Factor->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// ClearedChargeCode
			$this->ClearedChargeCode->LinkCustomAttributes = "";
			$this->ClearedChargeCode->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
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

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if ($this->ChargeDesc->Required) {
			if (!$this->ChargeDesc->IsDetailKey && $this->ChargeDesc->FormValue != NULL && $this->ChargeDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeDesc->caption(), $this->ChargeDesc->RequiredErrorMessage));
			}
		}
		if ($this->Fee->Required) {
			if (!$this->Fee->IsDetailKey && $this->Fee->FormValue != NULL && $this->Fee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fee->caption(), $this->Fee->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Fee->FormValue)) {
			AddMessage($FormError, $this->Fee->errorMessage());
		}
		if ($this->ChargeType->Required) {
			if (!$this->ChargeType->IsDetailKey && $this->ChargeType->FormValue != NULL && $this->ChargeType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeType->caption(), $this->ChargeType->RequiredErrorMessage));
			}
		}
		if ($this->Frequency->Required) {
			if (!$this->Frequency->IsDetailKey && $this->Frequency->FormValue != NULL && $this->Frequency->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Frequency->caption(), $this->Frequency->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Frequency->FormValue)) {
			AddMessage($FormError, $this->Frequency->errorMessage());
		}
		if ($this->Installment->Required) {
			if (!$this->Installment->IsDetailKey && $this->Installment->FormValue != NULL && $this->Installment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Installment->caption(), $this->Installment->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentCode->Required) {
			if (!$this->DepartmentCode->IsDetailKey && $this->DepartmentCode->FormValue != NULL && $this->DepartmentCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentCode->caption(), $this->DepartmentCode->RequiredErrorMessage));
			}
		}
		if ($this->GLAccount->Required) {
			if (!$this->GLAccount->IsDetailKey && $this->GLAccount->FormValue != NULL && $this->GLAccount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->GLAccount->caption(), $this->GLAccount->RequiredErrorMessage));
			}
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->Factor->Required) {
			if (!$this->Factor->IsDetailKey && $this->Factor->FormValue != NULL && $this->Factor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Factor->caption(), $this->Factor->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Factor->FormValue)) {
			AddMessage($FormError, $this->Factor->errorMessage());
		}
		if ($this->PeriodType->Required) {
			if (!$this->PeriodType->IsDetailKey && $this->PeriodType->FormValue != NULL && $this->PeriodType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodType->caption(), $this->PeriodType->RequiredErrorMessage));
			}
		}
		if ($this->ClearedChargeCode->Required) {
			if ($this->ClearedChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClearedChargeCode->caption(), $this->ClearedChargeCode->RequiredErrorMessage));
			}
		}
		if ($this->PropertyUse->Required) {
			if (!$this->PropertyUse->IsDetailKey && $this->PropertyUse->FormValue != NULL && $this->PropertyUse->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyUse->caption(), $this->PropertyUse->RequiredErrorMessage));
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
				$thisKey .= $row['ChargeCode'];
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

			// ChargeDesc
			$this->ChargeDesc->setDbValueDef($rsnew, $this->ChargeDesc->CurrentValue, "", $this->ChargeDesc->ReadOnly);

			// Fee
			$this->Fee->setDbValueDef($rsnew, $this->Fee->CurrentValue, NULL, $this->Fee->ReadOnly);

			// ChargeType
			$this->ChargeType->setDbValueDef($rsnew, $this->ChargeType->CurrentValue, NULL, $this->ChargeType->ReadOnly);

			// Frequency
			$this->Frequency->setDbValueDef($rsnew, $this->Frequency->CurrentValue, NULL, $this->Frequency->ReadOnly);

			// Installment
			$this->Installment->setDbValueDef($rsnew, $this->Installment->CurrentValue, NULL, $this->Installment->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// GLAccount
			$this->GLAccount->setDbValueDef($rsnew, $this->GLAccount->CurrentValue, NULL, $this->GLAccount->ReadOnly);

			// ChargeGroup
			$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, $this->ChargeGroup->ReadOnly);

			// UnitOfMeasure
			$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, $this->UnitOfMeasure->ReadOnly);

			// Factor
			$this->Factor->setDbValueDef($rsnew, $this->Factor->CurrentValue, NULL, $this->Factor->ReadOnly);

			// PeriodType
			$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, $this->PeriodType->ReadOnly);

			// ClearedChargeCode
			$this->ClearedChargeCode->setDbValueDef($rsnew, $this->ClearedChargeCode->CurrentValue, NULL, $this->ClearedChargeCode->ReadOnly);

			// PropertyUse
			$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, NULL, $this->PropertyUse->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('ChargeDesc')); // ChargeDesc
		$hash .= GetFieldHash($rs->fields('Fee')); // Fee
		$hash .= GetFieldHash($rs->fields('ChargeType')); // ChargeType
		$hash .= GetFieldHash($rs->fields('Frequency')); // Frequency
		$hash .= GetFieldHash($rs->fields('Installment')); // Installment
		$hash .= GetFieldHash($rs->fields('DepartmentCode')); // DepartmentCode
		$hash .= GetFieldHash($rs->fields('GLAccount')); // GLAccount
		$hash .= GetFieldHash($rs->fields('ChargeGroup')); // ChargeGroup
		$hash .= GetFieldHash($rs->fields('UnitOfMeasure')); // UnitOfMeasure
		$hash .= GetFieldHash($rs->fields('Factor')); // Factor
		$hash .= GetFieldHash($rs->fields('PeriodType')); // PeriodType
		$hash .= GetFieldHash($rs->fields('ClearedChargeCode')); // ClearedChargeCode
		$hash .= GetFieldHash($rs->fields('PropertyUse')); // PropertyUse
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

		// ChargeDesc
		$this->ChargeDesc->setDbValueDef($rsnew, $this->ChargeDesc->CurrentValue, "", FALSE);

		// Fee
		$this->Fee->setDbValueDef($rsnew, $this->Fee->CurrentValue, NULL, FALSE);

		// ChargeType
		$this->ChargeType->setDbValueDef($rsnew, $this->ChargeType->CurrentValue, NULL, FALSE);

		// Frequency
		$this->Frequency->setDbValueDef($rsnew, $this->Frequency->CurrentValue, NULL, FALSE);

		// Installment
		$this->Installment->setDbValueDef($rsnew, $this->Installment->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// GLAccount
		$this->GLAccount->setDbValueDef($rsnew, $this->GLAccount->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, FALSE);

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, FALSE);

		// Factor
		$this->Factor->setDbValueDef($rsnew, $this->Factor->CurrentValue, NULL, FALSE);

		// PeriodType
		$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, strval($this->PeriodType->CurrentValue) == "");

		// ClearedChargeCode
		$this->ClearedChargeCode->setDbValueDef($rsnew, $this->ClearedChargeCode->CurrentValue, NULL, FALSE);

		// PropertyUse
		$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, NULL, FALSE);

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

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fchargeslist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fchargeslist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fchargeslist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_charges" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_charges\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fchargeslist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fchargeslistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

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
				case "x_ChargeType":
					break;
				case "x_Installment":
					break;
				case "x_DepartmentCode":
					break;
				case "x_GLAccount":
					break;
				case "x_ChargeGroup":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PeriodType":
					break;
				case "x_ClearedChargeCode":
					break;
				case "x_PropertyUse":
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
						case "x_ChargeType":
							break;
						case "x_Installment":
							break;
						case "x_DepartmentCode":
							break;
						case "x_GLAccount":
							break;
						case "x_ChargeGroup":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PeriodType":
							break;
						case "x_ClearedChargeCode":
							$row[3] = FormatNumber($row[3], 2, -2, -2, -2);
							$row['df3'] = $row[3];
							break;
						case "x_PropertyUse":
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