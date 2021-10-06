<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class property_list extends property
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'property';

	// Page object name
	public $PageObjName = "property_list";

	// Grid form hidden field names
	public $FormName = "fpropertylist";
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

		// Table object (property)
		if (!isset($GLOBALS["property"]) || get_class($GLOBALS["property"]) == PROJECT_NAMESPACE . "property") {
			$GLOBALS["property"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["property"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "propertyadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "propertydelete.php";
		$this->MultiUpdateUrl = "propertyupdate.php";

		// Table object (client)
		if (!isset($GLOBALS['client']))
			$GLOBALS['client'] = new client();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'property');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fpropertylistsrch";

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
		global $property;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($property);
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
			$key .= @$ar['ValuationNo'];
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
			$this->ValuationNo->Visible = FALSE;
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
		$this->PropertyNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->PropertyGroup->setVisibility();
		$this->PropertyType->setVisibility();
		$this->Location->setVisibility();
		$this->PropertyStatus->setVisibility();
		$this->PropertyUse->setVisibility();
		$this->LandExtentInHA->setVisibility();
		$this->RateableValue->setVisibility();
		$this->SupplementaryValue->setVisibility();
		$this->ExemptCode->setVisibility();
		$this->Improvements->setVisibility();
		$this->StreetAddress->setVisibility();
		$this->Longitude->setVisibility();
		$this->Latitude->setVisibility();
		$this->Incumberance->setVisibility();
		$this->SubDivisionOf->setVisibility();
		$this->LastUpdatedBy->setVisibility();
		$this->LastUpdateDate->setVisibility();
		$this->ValuationNo->setVisibility();
		$this->LandValue->setVisibility();
		$this->ImprovementsValue->setVisibility();
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
		$this->setupLookupOptions($this->ClientSerNo);
		$this->setupLookupOptions($this->ClientID);
		$this->setupLookupOptions($this->PropertyGroup);
		$this->setupLookupOptions($this->PropertyType);
		$this->setupLookupOptions($this->Location);
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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "client") {
			global $client;
			$rsmaster = $client->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("clientlist.php"); // Return to master page
			} else {
				$client->loadListRowValues($rsmaster);
				$client->RowType = ROWTYPE_MASTER; // Master row
				$client->renderListRow();
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
			$this->ValuationNo->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ValuationNo->OldValue))
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fpropertylistsrch");
		$filterList = Concat($filterList, $this->PropertyNo->AdvancedSearch->toJson(), ","); // Field PropertyNo
		$filterList = Concat($filterList, $this->ClientSerNo->AdvancedSearch->toJson(), ","); // Field ClientSerNo
		$filterList = Concat($filterList, $this->ClientID->AdvancedSearch->toJson(), ","); // Field ClientID
		$filterList = Concat($filterList, $this->PropertyGroup->AdvancedSearch->toJson(), ","); // Field PropertyGroup
		$filterList = Concat($filterList, $this->PropertyType->AdvancedSearch->toJson(), ","); // Field PropertyType
		$filterList = Concat($filterList, $this->Location->AdvancedSearch->toJson(), ","); // Field Location
		$filterList = Concat($filterList, $this->PropertyStatus->AdvancedSearch->toJson(), ","); // Field PropertyStatus
		$filterList = Concat($filterList, $this->PropertyUse->AdvancedSearch->toJson(), ","); // Field PropertyUse
		$filterList = Concat($filterList, $this->LandExtentInHA->AdvancedSearch->toJson(), ","); // Field LandExtentInHA
		$filterList = Concat($filterList, $this->RateableValue->AdvancedSearch->toJson(), ","); // Field RateableValue
		$filterList = Concat($filterList, $this->SupplementaryValue->AdvancedSearch->toJson(), ","); // Field SupplementaryValue
		$filterList = Concat($filterList, $this->ExemptCode->AdvancedSearch->toJson(), ","); // Field ExemptCode
		$filterList = Concat($filterList, $this->Improvements->AdvancedSearch->toJson(), ","); // Field Improvements
		$filterList = Concat($filterList, $this->StreetAddress->AdvancedSearch->toJson(), ","); // Field StreetAddress
		$filterList = Concat($filterList, $this->Longitude->AdvancedSearch->toJson(), ","); // Field Longitude
		$filterList = Concat($filterList, $this->Latitude->AdvancedSearch->toJson(), ","); // Field Latitude
		$filterList = Concat($filterList, $this->Incumberance->AdvancedSearch->toJson(), ","); // Field Incumberance
		$filterList = Concat($filterList, $this->SubDivisionOf->AdvancedSearch->toJson(), ","); // Field SubDivisionOf
		$filterList = Concat($filterList, $this->LastUpdatedBy->AdvancedSearch->toJson(), ","); // Field LastUpdatedBy
		$filterList = Concat($filterList, $this->LastUpdateDate->AdvancedSearch->toJson(), ","); // Field LastUpdateDate
		$filterList = Concat($filterList, $this->ValuationNo->AdvancedSearch->toJson(), ","); // Field ValuationNo
		$filterList = Concat($filterList, $this->LandValue->AdvancedSearch->toJson(), ","); // Field LandValue
		$filterList = Concat($filterList, $this->ImprovementsValue->AdvancedSearch->toJson(), ","); // Field ImprovementsValue
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fpropertylistsrch", $filters);
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

		// Field PropertyGroup
		$this->PropertyGroup->AdvancedSearch->SearchValue = @$filter["x_PropertyGroup"];
		$this->PropertyGroup->AdvancedSearch->SearchOperator = @$filter["z_PropertyGroup"];
		$this->PropertyGroup->AdvancedSearch->SearchCondition = @$filter["v_PropertyGroup"];
		$this->PropertyGroup->AdvancedSearch->SearchValue2 = @$filter["y_PropertyGroup"];
		$this->PropertyGroup->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyGroup"];
		$this->PropertyGroup->AdvancedSearch->save();

		// Field PropertyType
		$this->PropertyType->AdvancedSearch->SearchValue = @$filter["x_PropertyType"];
		$this->PropertyType->AdvancedSearch->SearchOperator = @$filter["z_PropertyType"];
		$this->PropertyType->AdvancedSearch->SearchCondition = @$filter["v_PropertyType"];
		$this->PropertyType->AdvancedSearch->SearchValue2 = @$filter["y_PropertyType"];
		$this->PropertyType->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyType"];
		$this->PropertyType->AdvancedSearch->save();

		// Field Location
		$this->Location->AdvancedSearch->SearchValue = @$filter["x_Location"];
		$this->Location->AdvancedSearch->SearchOperator = @$filter["z_Location"];
		$this->Location->AdvancedSearch->SearchCondition = @$filter["v_Location"];
		$this->Location->AdvancedSearch->SearchValue2 = @$filter["y_Location"];
		$this->Location->AdvancedSearch->SearchOperator2 = @$filter["w_Location"];
		$this->Location->AdvancedSearch->save();

		// Field PropertyStatus
		$this->PropertyStatus->AdvancedSearch->SearchValue = @$filter["x_PropertyStatus"];
		$this->PropertyStatus->AdvancedSearch->SearchOperator = @$filter["z_PropertyStatus"];
		$this->PropertyStatus->AdvancedSearch->SearchCondition = @$filter["v_PropertyStatus"];
		$this->PropertyStatus->AdvancedSearch->SearchValue2 = @$filter["y_PropertyStatus"];
		$this->PropertyStatus->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyStatus"];
		$this->PropertyStatus->AdvancedSearch->save();

		// Field PropertyUse
		$this->PropertyUse->AdvancedSearch->SearchValue = @$filter["x_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchOperator = @$filter["z_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchCondition = @$filter["v_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchValue2 = @$filter["y_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->SearchOperator2 = @$filter["w_PropertyUse"];
		$this->PropertyUse->AdvancedSearch->save();

		// Field LandExtentInHA
		$this->LandExtentInHA->AdvancedSearch->SearchValue = @$filter["x_LandExtentInHA"];
		$this->LandExtentInHA->AdvancedSearch->SearchOperator = @$filter["z_LandExtentInHA"];
		$this->LandExtentInHA->AdvancedSearch->SearchCondition = @$filter["v_LandExtentInHA"];
		$this->LandExtentInHA->AdvancedSearch->SearchValue2 = @$filter["y_LandExtentInHA"];
		$this->LandExtentInHA->AdvancedSearch->SearchOperator2 = @$filter["w_LandExtentInHA"];
		$this->LandExtentInHA->AdvancedSearch->save();

		// Field RateableValue
		$this->RateableValue->AdvancedSearch->SearchValue = @$filter["x_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchOperator = @$filter["z_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchCondition = @$filter["v_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchValue2 = @$filter["y_RateableValue"];
		$this->RateableValue->AdvancedSearch->SearchOperator2 = @$filter["w_RateableValue"];
		$this->RateableValue->AdvancedSearch->save();

		// Field SupplementaryValue
		$this->SupplementaryValue->AdvancedSearch->SearchValue = @$filter["x_SupplementaryValue"];
		$this->SupplementaryValue->AdvancedSearch->SearchOperator = @$filter["z_SupplementaryValue"];
		$this->SupplementaryValue->AdvancedSearch->SearchCondition = @$filter["v_SupplementaryValue"];
		$this->SupplementaryValue->AdvancedSearch->SearchValue2 = @$filter["y_SupplementaryValue"];
		$this->SupplementaryValue->AdvancedSearch->SearchOperator2 = @$filter["w_SupplementaryValue"];
		$this->SupplementaryValue->AdvancedSearch->save();

		// Field ExemptCode
		$this->ExemptCode->AdvancedSearch->SearchValue = @$filter["x_ExemptCode"];
		$this->ExemptCode->AdvancedSearch->SearchOperator = @$filter["z_ExemptCode"];
		$this->ExemptCode->AdvancedSearch->SearchCondition = @$filter["v_ExemptCode"];
		$this->ExemptCode->AdvancedSearch->SearchValue2 = @$filter["y_ExemptCode"];
		$this->ExemptCode->AdvancedSearch->SearchOperator2 = @$filter["w_ExemptCode"];
		$this->ExemptCode->AdvancedSearch->save();

		// Field Improvements
		$this->Improvements->AdvancedSearch->SearchValue = @$filter["x_Improvements"];
		$this->Improvements->AdvancedSearch->SearchOperator = @$filter["z_Improvements"];
		$this->Improvements->AdvancedSearch->SearchCondition = @$filter["v_Improvements"];
		$this->Improvements->AdvancedSearch->SearchValue2 = @$filter["y_Improvements"];
		$this->Improvements->AdvancedSearch->SearchOperator2 = @$filter["w_Improvements"];
		$this->Improvements->AdvancedSearch->save();

		// Field StreetAddress
		$this->StreetAddress->AdvancedSearch->SearchValue = @$filter["x_StreetAddress"];
		$this->StreetAddress->AdvancedSearch->SearchOperator = @$filter["z_StreetAddress"];
		$this->StreetAddress->AdvancedSearch->SearchCondition = @$filter["v_StreetAddress"];
		$this->StreetAddress->AdvancedSearch->SearchValue2 = @$filter["y_StreetAddress"];
		$this->StreetAddress->AdvancedSearch->SearchOperator2 = @$filter["w_StreetAddress"];
		$this->StreetAddress->AdvancedSearch->save();

		// Field Longitude
		$this->Longitude->AdvancedSearch->SearchValue = @$filter["x_Longitude"];
		$this->Longitude->AdvancedSearch->SearchOperator = @$filter["z_Longitude"];
		$this->Longitude->AdvancedSearch->SearchCondition = @$filter["v_Longitude"];
		$this->Longitude->AdvancedSearch->SearchValue2 = @$filter["y_Longitude"];
		$this->Longitude->AdvancedSearch->SearchOperator2 = @$filter["w_Longitude"];
		$this->Longitude->AdvancedSearch->save();

		// Field Latitude
		$this->Latitude->AdvancedSearch->SearchValue = @$filter["x_Latitude"];
		$this->Latitude->AdvancedSearch->SearchOperator = @$filter["z_Latitude"];
		$this->Latitude->AdvancedSearch->SearchCondition = @$filter["v_Latitude"];
		$this->Latitude->AdvancedSearch->SearchValue2 = @$filter["y_Latitude"];
		$this->Latitude->AdvancedSearch->SearchOperator2 = @$filter["w_Latitude"];
		$this->Latitude->AdvancedSearch->save();

		// Field Incumberance
		$this->Incumberance->AdvancedSearch->SearchValue = @$filter["x_Incumberance"];
		$this->Incumberance->AdvancedSearch->SearchOperator = @$filter["z_Incumberance"];
		$this->Incumberance->AdvancedSearch->SearchCondition = @$filter["v_Incumberance"];
		$this->Incumberance->AdvancedSearch->SearchValue2 = @$filter["y_Incumberance"];
		$this->Incumberance->AdvancedSearch->SearchOperator2 = @$filter["w_Incumberance"];
		$this->Incumberance->AdvancedSearch->save();

		// Field SubDivisionOf
		$this->SubDivisionOf->AdvancedSearch->SearchValue = @$filter["x_SubDivisionOf"];
		$this->SubDivisionOf->AdvancedSearch->SearchOperator = @$filter["z_SubDivisionOf"];
		$this->SubDivisionOf->AdvancedSearch->SearchCondition = @$filter["v_SubDivisionOf"];
		$this->SubDivisionOf->AdvancedSearch->SearchValue2 = @$filter["y_SubDivisionOf"];
		$this->SubDivisionOf->AdvancedSearch->SearchOperator2 = @$filter["w_SubDivisionOf"];
		$this->SubDivisionOf->AdvancedSearch->save();

		// Field LastUpdatedBy
		$this->LastUpdatedBy->AdvancedSearch->SearchValue = @$filter["x_LastUpdatedBy"];
		$this->LastUpdatedBy->AdvancedSearch->SearchOperator = @$filter["z_LastUpdatedBy"];
		$this->LastUpdatedBy->AdvancedSearch->SearchCondition = @$filter["v_LastUpdatedBy"];
		$this->LastUpdatedBy->AdvancedSearch->SearchValue2 = @$filter["y_LastUpdatedBy"];
		$this->LastUpdatedBy->AdvancedSearch->SearchOperator2 = @$filter["w_LastUpdatedBy"];
		$this->LastUpdatedBy->AdvancedSearch->save();

		// Field LastUpdateDate
		$this->LastUpdateDate->AdvancedSearch->SearchValue = @$filter["x_LastUpdateDate"];
		$this->LastUpdateDate->AdvancedSearch->SearchOperator = @$filter["z_LastUpdateDate"];
		$this->LastUpdateDate->AdvancedSearch->SearchCondition = @$filter["v_LastUpdateDate"];
		$this->LastUpdateDate->AdvancedSearch->SearchValue2 = @$filter["y_LastUpdateDate"];
		$this->LastUpdateDate->AdvancedSearch->SearchOperator2 = @$filter["w_LastUpdateDate"];
		$this->LastUpdateDate->AdvancedSearch->save();

		// Field ValuationNo
		$this->ValuationNo->AdvancedSearch->SearchValue = @$filter["x_ValuationNo"];
		$this->ValuationNo->AdvancedSearch->SearchOperator = @$filter["z_ValuationNo"];
		$this->ValuationNo->AdvancedSearch->SearchCondition = @$filter["v_ValuationNo"];
		$this->ValuationNo->AdvancedSearch->SearchValue2 = @$filter["y_ValuationNo"];
		$this->ValuationNo->AdvancedSearch->SearchOperator2 = @$filter["w_ValuationNo"];
		$this->ValuationNo->AdvancedSearch->save();

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
		$this->buildSearchSql($where, $this->ClientSerNo, $default, FALSE); // ClientSerNo
		$this->buildSearchSql($where, $this->ClientID, $default, FALSE); // ClientID
		$this->buildSearchSql($where, $this->PropertyGroup, $default, FALSE); // PropertyGroup
		$this->buildSearchSql($where, $this->PropertyType, $default, FALSE); // PropertyType
		$this->buildSearchSql($where, $this->Location, $default, TRUE); // Location
		$this->buildSearchSql($where, $this->PropertyStatus, $default, FALSE); // PropertyStatus
		$this->buildSearchSql($where, $this->PropertyUse, $default, TRUE); // PropertyUse
		$this->buildSearchSql($where, $this->LandExtentInHA, $default, FALSE); // LandExtentInHA
		$this->buildSearchSql($where, $this->RateableValue, $default, FALSE); // RateableValue
		$this->buildSearchSql($where, $this->SupplementaryValue, $default, FALSE); // SupplementaryValue
		$this->buildSearchSql($where, $this->ExemptCode, $default, FALSE); // ExemptCode
		$this->buildSearchSql($where, $this->Improvements, $default, FALSE); // Improvements
		$this->buildSearchSql($where, $this->StreetAddress, $default, FALSE); // StreetAddress
		$this->buildSearchSql($where, $this->Longitude, $default, FALSE); // Longitude
		$this->buildSearchSql($where, $this->Latitude, $default, FALSE); // Latitude
		$this->buildSearchSql($where, $this->Incumberance, $default, FALSE); // Incumberance
		$this->buildSearchSql($where, $this->SubDivisionOf, $default, FALSE); // SubDivisionOf
		$this->buildSearchSql($where, $this->LastUpdatedBy, $default, FALSE); // LastUpdatedBy
		$this->buildSearchSql($where, $this->LastUpdateDate, $default, FALSE); // LastUpdateDate
		$this->buildSearchSql($where, $this->ValuationNo, $default, FALSE); // ValuationNo
		$this->buildSearchSql($where, $this->LandValue, $default, FALSE); // LandValue
		$this->buildSearchSql($where, $this->ImprovementsValue, $default, FALSE); // ImprovementsValue

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->PropertyNo->AdvancedSearch->save(); // PropertyNo
			$this->ClientSerNo->AdvancedSearch->save(); // ClientSerNo
			$this->ClientID->AdvancedSearch->save(); // ClientID
			$this->PropertyGroup->AdvancedSearch->save(); // PropertyGroup
			$this->PropertyType->AdvancedSearch->save(); // PropertyType
			$this->Location->AdvancedSearch->save(); // Location
			$this->PropertyStatus->AdvancedSearch->save(); // PropertyStatus
			$this->PropertyUse->AdvancedSearch->save(); // PropertyUse
			$this->LandExtentInHA->AdvancedSearch->save(); // LandExtentInHA
			$this->RateableValue->AdvancedSearch->save(); // RateableValue
			$this->SupplementaryValue->AdvancedSearch->save(); // SupplementaryValue
			$this->ExemptCode->AdvancedSearch->save(); // ExemptCode
			$this->Improvements->AdvancedSearch->save(); // Improvements
			$this->StreetAddress->AdvancedSearch->save(); // StreetAddress
			$this->Longitude->AdvancedSearch->save(); // Longitude
			$this->Latitude->AdvancedSearch->save(); // Latitude
			$this->Incumberance->AdvancedSearch->save(); // Incumberance
			$this->SubDivisionOf->AdvancedSearch->save(); // SubDivisionOf
			$this->LastUpdatedBy->AdvancedSearch->save(); // LastUpdatedBy
			$this->LastUpdateDate->AdvancedSearch->save(); // LastUpdateDate
			$this->ValuationNo->AdvancedSearch->save(); // ValuationNo
			$this->LandValue->AdvancedSearch->save(); // LandValue
			$this->ImprovementsValue->AdvancedSearch->save(); // ImprovementsValue
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
		$this->buildBasicSearchSql($where, $this->ClientID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Location, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Improvements, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->StreetAddress, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Incumberance, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LastUpdatedBy, $arKeywords, $type);
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
		if ($this->ClientSerNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PropertyGroup->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PropertyType->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Location->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PropertyStatus->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PropertyUse->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LandExtentInHA->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->RateableValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SupplementaryValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ExemptCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Improvements->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->StreetAddress->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Longitude->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Latitude->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Incumberance->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SubDivisionOf->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastUpdatedBy->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastUpdateDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ValuationNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LandValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ImprovementsValue->AdvancedSearch->issetSession())
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
		$this->ClientSerNo->AdvancedSearch->unsetSession();
		$this->ClientID->AdvancedSearch->unsetSession();
		$this->PropertyGroup->AdvancedSearch->unsetSession();
		$this->PropertyType->AdvancedSearch->unsetSession();
		$this->Location->AdvancedSearch->unsetSession();
		$this->PropertyStatus->AdvancedSearch->unsetSession();
		$this->PropertyUse->AdvancedSearch->unsetSession();
		$this->LandExtentInHA->AdvancedSearch->unsetSession();
		$this->RateableValue->AdvancedSearch->unsetSession();
		$this->SupplementaryValue->AdvancedSearch->unsetSession();
		$this->ExemptCode->AdvancedSearch->unsetSession();
		$this->Improvements->AdvancedSearch->unsetSession();
		$this->StreetAddress->AdvancedSearch->unsetSession();
		$this->Longitude->AdvancedSearch->unsetSession();
		$this->Latitude->AdvancedSearch->unsetSession();
		$this->Incumberance->AdvancedSearch->unsetSession();
		$this->SubDivisionOf->AdvancedSearch->unsetSession();
		$this->LastUpdatedBy->AdvancedSearch->unsetSession();
		$this->LastUpdateDate->AdvancedSearch->unsetSession();
		$this->ValuationNo->AdvancedSearch->unsetSession();
		$this->LandValue->AdvancedSearch->unsetSession();
		$this->ImprovementsValue->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->PropertyNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PropertyGroup->AdvancedSearch->load();
		$this->PropertyType->AdvancedSearch->load();
		$this->Location->AdvancedSearch->load();
		$this->PropertyStatus->AdvancedSearch->load();
		$this->PropertyUse->AdvancedSearch->load();
		$this->LandExtentInHA->AdvancedSearch->load();
		$this->RateableValue->AdvancedSearch->load();
		$this->SupplementaryValue->AdvancedSearch->load();
		$this->ExemptCode->AdvancedSearch->load();
		$this->Improvements->AdvancedSearch->load();
		$this->StreetAddress->AdvancedSearch->load();
		$this->Longitude->AdvancedSearch->load();
		$this->Latitude->AdvancedSearch->load();
		$this->Incumberance->AdvancedSearch->load();
		$this->SubDivisionOf->AdvancedSearch->load();
		$this->LastUpdatedBy->AdvancedSearch->load();
		$this->LastUpdateDate->AdvancedSearch->load();
		$this->ValuationNo->AdvancedSearch->load();
		$this->LandValue->AdvancedSearch->load();
		$this->ImprovementsValue->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->PropertyNo); // PropertyNo
			$this->updateSort($this->ClientSerNo); // ClientSerNo
			$this->updateSort($this->ClientID); // ClientID
			$this->updateSort($this->PropertyGroup); // PropertyGroup
			$this->updateSort($this->PropertyType); // PropertyType
			$this->updateSort($this->Location); // Location
			$this->updateSort($this->PropertyStatus); // PropertyStatus
			$this->updateSort($this->PropertyUse); // PropertyUse
			$this->updateSort($this->LandExtentInHA); // LandExtentInHA
			$this->updateSort($this->RateableValue); // RateableValue
			$this->updateSort($this->SupplementaryValue); // SupplementaryValue
			$this->updateSort($this->ExemptCode); // ExemptCode
			$this->updateSort($this->Improvements); // Improvements
			$this->updateSort($this->StreetAddress); // StreetAddress
			$this->updateSort($this->Longitude); // Longitude
			$this->updateSort($this->Latitude); // Latitude
			$this->updateSort($this->Incumberance); // Incumberance
			$this->updateSort($this->SubDivisionOf); // SubDivisionOf
			$this->updateSort($this->LastUpdatedBy); // LastUpdatedBy
			$this->updateSort($this->LastUpdateDate); // LastUpdateDate
			$this->updateSort($this->ValuationNo); // ValuationNo
			$this->updateSort($this->LandValue); // LandValue
			$this->updateSort($this->ImprovementsValue); // ImprovementsValue
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
				$this->ClientSerNo->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->PropertyNo->setSort("");
				$this->ClientSerNo->setSort("");
				$this->ClientID->setSort("");
				$this->PropertyGroup->setSort("");
				$this->PropertyType->setSort("");
				$this->Location->setSort("");
				$this->PropertyStatus->setSort("");
				$this->PropertyUse->setSort("");
				$this->LandExtentInHA->setSort("");
				$this->RateableValue->setSort("");
				$this->SupplementaryValue->setSort("");
				$this->ExemptCode->setSort("");
				$this->Improvements->setSort("");
				$this->StreetAddress->setSort("");
				$this->Longitude->setSort("");
				$this->Latitude->setSort("");
				$this->Incumberance->setSort("");
				$this->SubDivisionOf->setSort("");
				$this->LastUpdatedBy->setSort("");
				$this->LastUpdateDate->setSort("");
				$this->ValuationNo->setSort("");
				$this->LandValue->setSort("");
				$this->ImprovementsValue->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ValuationNo->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fpropertylistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpropertylistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fpropertylist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// PropertyNo
		if (!$this->isAddOrEdit() && $this->PropertyNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyNo->AdvancedSearch->SearchValue != "" || $this->PropertyNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// PropertyGroup
		if (!$this->isAddOrEdit() && $this->PropertyGroup->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyGroup->AdvancedSearch->SearchValue != "" || $this->PropertyGroup->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PropertyType
		if (!$this->isAddOrEdit() && $this->PropertyType->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyType->AdvancedSearch->SearchValue != "" || $this->PropertyType->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Location
		if (!$this->isAddOrEdit() && $this->Location->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Location->AdvancedSearch->SearchValue != "" || $this->Location->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->Location->AdvancedSearch->SearchValue))
			$this->Location->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Location->AdvancedSearch->SearchValue);
		if (is_array($this->Location->AdvancedSearch->SearchValue2))
			$this->Location->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Location->AdvancedSearch->SearchValue2);

		// PropertyStatus
		if (!$this->isAddOrEdit() && $this->PropertyStatus->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyStatus->AdvancedSearch->SearchValue != "" || $this->PropertyStatus->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PropertyUse
		if (!$this->isAddOrEdit() && $this->PropertyUse->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PropertyUse->AdvancedSearch->SearchValue != "" || $this->PropertyUse->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		if (is_array($this->PropertyUse->AdvancedSearch->SearchValue))
			$this->PropertyUse->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->PropertyUse->AdvancedSearch->SearchValue);
		if (is_array($this->PropertyUse->AdvancedSearch->SearchValue2))
			$this->PropertyUse->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->PropertyUse->AdvancedSearch->SearchValue2);

		// LandExtentInHA
		if (!$this->isAddOrEdit() && $this->LandExtentInHA->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LandExtentInHA->AdvancedSearch->SearchValue != "" || $this->LandExtentInHA->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// RateableValue
		if (!$this->isAddOrEdit() && $this->RateableValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->RateableValue->AdvancedSearch->SearchValue != "" || $this->RateableValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SupplementaryValue
		if (!$this->isAddOrEdit() && $this->SupplementaryValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SupplementaryValue->AdvancedSearch->SearchValue != "" || $this->SupplementaryValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ExemptCode
		if (!$this->isAddOrEdit() && $this->ExemptCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ExemptCode->AdvancedSearch->SearchValue != "" || $this->ExemptCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Improvements
		if (!$this->isAddOrEdit() && $this->Improvements->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Improvements->AdvancedSearch->SearchValue != "" || $this->Improvements->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// StreetAddress
		if (!$this->isAddOrEdit() && $this->StreetAddress->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->StreetAddress->AdvancedSearch->SearchValue != "" || $this->StreetAddress->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Longitude
		if (!$this->isAddOrEdit() && $this->Longitude->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Longitude->AdvancedSearch->SearchValue != "" || $this->Longitude->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Latitude
		if (!$this->isAddOrEdit() && $this->Latitude->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Latitude->AdvancedSearch->SearchValue != "" || $this->Latitude->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Incumberance
		if (!$this->isAddOrEdit() && $this->Incumberance->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Incumberance->AdvancedSearch->SearchValue != "" || $this->Incumberance->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// SubDivisionOf
		if (!$this->isAddOrEdit() && $this->SubDivisionOf->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SubDivisionOf->AdvancedSearch->SearchValue != "" || $this->SubDivisionOf->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LastUpdatedBy
		if (!$this->isAddOrEdit() && $this->LastUpdatedBy->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LastUpdatedBy->AdvancedSearch->SearchValue != "" || $this->LastUpdatedBy->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LastUpdateDate
		if (!$this->isAddOrEdit() && $this->LastUpdateDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LastUpdateDate->AdvancedSearch->SearchValue != "" || $this->LastUpdateDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ValuationNo
		if (!$this->isAddOrEdit() && $this->ValuationNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ValuationNo->AdvancedSearch->SearchValue != "" || $this->ValuationNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->PropertyNo->setDbValue($row['PropertyNo']);
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PropertyGroup->setDbValue($row['PropertyGroup']);
		$this->PropertyType->setDbValue($row['PropertyType']);
		$this->Location->setDbValue($row['Location']);
		$this->PropertyStatus->setDbValue($row['PropertyStatus']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
		$this->LandExtentInHA->setDbValue($row['LandExtentInHA']);
		$this->RateableValue->setDbValue($row['RateableValue']);
		$this->SupplementaryValue->setDbValue($row['SupplementaryValue']);
		$this->ExemptCode->setDbValue($row['ExemptCode']);
		$this->Improvements->setDbValue($row['Improvements']);
		$this->StreetAddress->setDbValue($row['StreetAddress']);
		$this->Longitude->setDbValue($row['Longitude']);
		$this->Latitude->setDbValue($row['Latitude']);
		$this->Incumberance->setDbValue($row['Incumberance']);
		$this->SubDivisionOf->setDbValue($row['SubDivisionOf']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
		$this->ValuationNo->setDbValue($row['ValuationNo']);
		$this->LandValue->setDbValue($row['LandValue']);
		$this->ImprovementsValue->setDbValue($row['ImprovementsValue']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['PropertyNo'] = NULL;
		$row['ClientSerNo'] = NULL;
		$row['ClientID'] = NULL;
		$row['PropertyGroup'] = NULL;
		$row['PropertyType'] = NULL;
		$row['Location'] = NULL;
		$row['PropertyStatus'] = NULL;
		$row['PropertyUse'] = NULL;
		$row['LandExtentInHA'] = NULL;
		$row['RateableValue'] = NULL;
		$row['SupplementaryValue'] = NULL;
		$row['ExemptCode'] = NULL;
		$row['Improvements'] = NULL;
		$row['StreetAddress'] = NULL;
		$row['Longitude'] = NULL;
		$row['Latitude'] = NULL;
		$row['Incumberance'] = NULL;
		$row['SubDivisionOf'] = NULL;
		$row['LastUpdatedBy'] = NULL;
		$row['LastUpdateDate'] = NULL;
		$row['ValuationNo'] = NULL;
		$row['LandValue'] = NULL;
		$row['ImprovementsValue'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ValuationNo")) != "")
			$this->ValuationNo->OldValue = $this->getKey("ValuationNo"); // ValuationNo
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
		if ($this->LandExtentInHA->FormValue == $this->LandExtentInHA->CurrentValue && is_numeric(ConvertToFloatString($this->LandExtentInHA->CurrentValue)))
			$this->LandExtentInHA->CurrentValue = ConvertToFloatString($this->LandExtentInHA->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RateableValue->FormValue == $this->RateableValue->CurrentValue && is_numeric(ConvertToFloatString($this->RateableValue->CurrentValue)))
			$this->RateableValue->CurrentValue = ConvertToFloatString($this->RateableValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SupplementaryValue->FormValue == $this->SupplementaryValue->CurrentValue && is_numeric(ConvertToFloatString($this->SupplementaryValue->CurrentValue)))
			$this->SupplementaryValue->CurrentValue = ConvertToFloatString($this->SupplementaryValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Longitude->FormValue == $this->Longitude->CurrentValue && is_numeric(ConvertToFloatString($this->Longitude->CurrentValue)))
			$this->Longitude->CurrentValue = ConvertToFloatString($this->Longitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Latitude->FormValue == $this->Latitude->CurrentValue && is_numeric(ConvertToFloatString($this->Latitude->CurrentValue)))
			$this->Latitude->CurrentValue = ConvertToFloatString($this->Latitude->CurrentValue);

		// Convert decimal values if posted back
		if ($this->LandValue->FormValue == $this->LandValue->CurrentValue && is_numeric(ConvertToFloatString($this->LandValue->CurrentValue)))
			$this->LandValue->CurrentValue = ConvertToFloatString($this->LandValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ImprovementsValue->FormValue == $this->ImprovementsValue->CurrentValue && is_numeric(ConvertToFloatString($this->ImprovementsValue->CurrentValue)))
			$this->ImprovementsValue->CurrentValue = ConvertToFloatString($this->ImprovementsValue->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// PropertyNo
		// ClientSerNo
		// ClientID
		// PropertyGroup
		// PropertyType
		// Location
		// PropertyStatus
		// PropertyUse
		// LandExtentInHA
		// RateableValue
		// SupplementaryValue
		// ExemptCode
		// Improvements
		// StreetAddress
		// Longitude
		// Latitude
		// Incumberance
		// SubDivisionOf
		// LastUpdatedBy
		// LastUpdateDate
		// ValuationNo
		// LandValue
		// ImprovementsValue

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PropertyNo
			$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
			$this->PropertyNo->ViewCustomAttributes = "";

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
			$curVal = strval($this->ClientID->CurrentValue);
			if ($curVal != "") {
				$this->ClientID->ViewValue = $this->ClientID->lookupCacheOption($curVal);
				if ($this->ClientID->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ClientID`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ClientID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ClientID->ViewValue = $this->ClientID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
					}
				}
			} else {
				$this->ClientID->ViewValue = NULL;
			}
			$this->ClientID->ViewCustomAttributes = "";

			// PropertyGroup
			$curVal = strval($this->PropertyGroup->CurrentValue);
			if ($curVal != "") {
				$this->PropertyGroup->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
				if ($this->PropertyGroup->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyGroup`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyGroup->ViewValue = $this->PropertyGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
					}
				}
			} else {
				$this->PropertyGroup->ViewValue = NULL;
			}
			$this->PropertyGroup->ViewCustomAttributes = "";

			// PropertyType
			$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
			$curVal = strval($this->PropertyType->CurrentValue);
			if ($curVal != "") {
				$this->PropertyType->ViewValue = $this->PropertyType->lookupCacheOption($curVal);
				if ($this->PropertyType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyType->ViewValue = $this->PropertyType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyType->ViewValue = $this->PropertyType->CurrentValue;
					}
				}
			} else {
				$this->PropertyType->ViewValue = NULL;
			}
			$this->PropertyType->ViewCustomAttributes = "";

			// Location
			$curVal = strval($this->Location->CurrentValue);
			if ($curVal != "") {
				$this->Location->ViewValue = $this->Location->lookupCacheOption($curVal);
				if ($this->Location->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->Location->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Location->ViewValue->add($this->Location->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->Location->ViewValue = $this->Location->CurrentValue;
					}
				}
			} else {
				$this->Location->ViewValue = NULL;
			}
			$this->Location->ViewCustomAttributes = "";

			// PropertyStatus
			$this->PropertyStatus->ViewValue = $this->PropertyStatus->CurrentValue;
			$this->PropertyStatus->ViewCustomAttributes = "";

			// PropertyUse
			$curVal = strval($this->PropertyUse->CurrentValue);
			if ($curVal != "") {
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
				if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->PropertyUse->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->PropertyUse->ViewValue->add($this->PropertyUse->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
					}
				}
			} else {
				$this->PropertyUse->ViewValue = NULL;
			}
			$this->PropertyUse->ViewCustomAttributes = "";

			// LandExtentInHA
			$this->LandExtentInHA->ViewValue = $this->LandExtentInHA->CurrentValue;
			$this->LandExtentInHA->ViewValue = FormatNumber($this->LandExtentInHA->ViewValue, 4, -2, -2, -2);
			$this->LandExtentInHA->CellCssStyle .= "text-align: right;";
			$this->LandExtentInHA->ViewCustomAttributes = "";

			// RateableValue
			$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
			$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
			$this->RateableValue->CellCssStyle .= "text-align: right;";
			$this->RateableValue->ViewCustomAttributes = "";

			// SupplementaryValue
			$this->SupplementaryValue->ViewValue = $this->SupplementaryValue->CurrentValue;
			$this->SupplementaryValue->ViewValue = FormatNumber($this->SupplementaryValue->ViewValue, 2, -2, -2, -2);
			$this->SupplementaryValue->CellCssStyle .= "text-align: right;";
			$this->SupplementaryValue->ViewCustomAttributes = "";

			// ExemptCode
			$this->ExemptCode->ViewValue = $this->ExemptCode->CurrentValue;
			$this->ExemptCode->ViewCustomAttributes = "";

			// Improvements
			$this->Improvements->ViewValue = $this->Improvements->CurrentValue;
			$this->Improvements->ViewCustomAttributes = "";

			// StreetAddress
			$this->StreetAddress->ViewValue = $this->StreetAddress->CurrentValue;
			$this->StreetAddress->ViewCustomAttributes = "";

			// Longitude
			$this->Longitude->ViewValue = $this->Longitude->CurrentValue;
			$this->Longitude->ViewValue = FormatNumber($this->Longitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Longitude->ViewCustomAttributes = "";

			// Latitude
			$this->Latitude->ViewValue = $this->Latitude->CurrentValue;
			$this->Latitude->ViewValue = FormatNumber($this->Latitude->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Latitude->ViewCustomAttributes = "";

			// Incumberance
			$this->Incumberance->ViewValue = $this->Incumberance->CurrentValue;
			$this->Incumberance->ViewCustomAttributes = "";

			// SubDivisionOf
			$this->SubDivisionOf->ViewValue = $this->SubDivisionOf->CurrentValue;
			$this->SubDivisionOf->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// ValuationNo
			$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
			$this->ValuationNo->ViewCustomAttributes = "";

			// LandValue
			$this->LandValue->ViewValue = $this->LandValue->CurrentValue;
			$this->LandValue->ViewValue = FormatNumber($this->LandValue->ViewValue, 2, -2, -2, -2);
			$this->LandValue->ViewCustomAttributes = "";

			// ImprovementsValue
			$this->ImprovementsValue->ViewValue = $this->ImprovementsValue->CurrentValue;
			$this->ImprovementsValue->ViewValue = FormatNumber($this->ImprovementsValue->ViewValue, 2, -2, -2, -2);
			$this->ImprovementsValue->ViewCustomAttributes = "";

			// PropertyNo
			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";
			$this->PropertyNo->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyNo->ViewValue = $this->highlightValue($this->PropertyNo);

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientSerNo->ViewValue = $this->highlightValue($this->ClientSerNo);

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientID->ViewValue = $this->highlightValue($this->ClientID);

			// PropertyGroup
			$this->PropertyGroup->LinkCustomAttributes = "";
			$this->PropertyGroup->HrefValue = "";
			$this->PropertyGroup->TooltipValue = "";

			// PropertyType
			$this->PropertyType->LinkCustomAttributes = "";
			$this->PropertyType->HrefValue = "";
			$this->PropertyType->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyType->ViewValue = $this->highlightValue($this->PropertyType);

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";

			// PropertyStatus
			$this->PropertyStatus->LinkCustomAttributes = "";
			$this->PropertyStatus->HrefValue = "";
			$this->PropertyStatus->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyStatus->ViewValue = $this->highlightValue($this->PropertyStatus);

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";

			// LandExtentInHA
			$this->LandExtentInHA->LinkCustomAttributes = "";
			$this->LandExtentInHA->HrefValue = "";
			$this->LandExtentInHA->TooltipValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";
			$this->RateableValue->TooltipValue = "";

			// SupplementaryValue
			$this->SupplementaryValue->LinkCustomAttributes = "";
			$this->SupplementaryValue->HrefValue = "";
			$this->SupplementaryValue->TooltipValue = "";

			// ExemptCode
			$this->ExemptCode->LinkCustomAttributes = "";
			$this->ExemptCode->HrefValue = "";
			$this->ExemptCode->TooltipValue = "";
			if (!$this->isExport())
				$this->ExemptCode->ViewValue = $this->highlightValue($this->ExemptCode);

			// Improvements
			$this->Improvements->LinkCustomAttributes = "";
			$this->Improvements->HrefValue = "";
			$this->Improvements->TooltipValue = "";
			if (!$this->isExport())
				$this->Improvements->ViewValue = $this->highlightValue($this->Improvements);

			// StreetAddress
			$this->StreetAddress->LinkCustomAttributes = "";
			$this->StreetAddress->HrefValue = "";
			$this->StreetAddress->TooltipValue = "";
			if (!$this->isExport())
				$this->StreetAddress->ViewValue = $this->highlightValue($this->StreetAddress);

			// Longitude
			$this->Longitude->LinkCustomAttributes = "";
			$this->Longitude->HrefValue = "";
			$this->Longitude->TooltipValue = "";
			if (!$this->isExport())
				$this->Longitude->ViewValue = $this->highlightValue($this->Longitude);

			// Latitude
			$this->Latitude->LinkCustomAttributes = "";
			$this->Latitude->HrefValue = "";
			$this->Latitude->TooltipValue = "";
			if (!$this->isExport())
				$this->Latitude->ViewValue = $this->highlightValue($this->Latitude);

			// Incumberance
			$this->Incumberance->LinkCustomAttributes = "";
			$this->Incumberance->HrefValue = "";
			$this->Incumberance->TooltipValue = "";
			if (!$this->isExport())
				$this->Incumberance->ViewValue = $this->highlightValue($this->Incumberance);

			// SubDivisionOf
			$this->SubDivisionOf->LinkCustomAttributes = "";
			$this->SubDivisionOf->HrefValue = "";
			$this->SubDivisionOf->TooltipValue = "";
			if (!$this->isExport())
				$this->SubDivisionOf->ViewValue = $this->highlightValue($this->SubDivisionOf);

			// LastUpdatedBy
			$this->LastUpdatedBy->LinkCustomAttributes = "";
			$this->LastUpdatedBy->HrefValue = "";
			$this->LastUpdatedBy->TooltipValue = "";
			if (!$this->isExport())
				$this->LastUpdatedBy->ViewValue = $this->highlightValue($this->LastUpdatedBy);

			// LastUpdateDate
			$this->LastUpdateDate->LinkCustomAttributes = "";
			$this->LastUpdateDate->HrefValue = "";
			$this->LastUpdateDate->TooltipValue = "";

			// ValuationNo
			$this->ValuationNo->LinkCustomAttributes = "";
			$this->ValuationNo->HrefValue = "";
			$this->ValuationNo->TooltipValue = "";
			if (!$this->isExport())
				$this->ValuationNo->ViewValue = $this->highlightValue($this->ValuationNo);

			// LandValue
			$this->LandValue->LinkCustomAttributes = "";
			$this->LandValue->HrefValue = "";
			$this->LandValue->TooltipValue = "";

			// ImprovementsValue
			$this->ImprovementsValue->LinkCustomAttributes = "";
			$this->ImprovementsValue->HrefValue = "";
			$this->ImprovementsValue->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// PropertyNo
			$this->PropertyNo->EditAttrs["class"] = "form-control";
			$this->PropertyNo->EditCustomAttributes = "";
			if (!$this->PropertyNo->Raw)
				$this->PropertyNo->AdvancedSearch->SearchValue = HtmlDecode($this->PropertyNo->AdvancedSearch->SearchValue);
			$this->PropertyNo->EditValue = HtmlEncode($this->PropertyNo->AdvancedSearch->SearchValue);
			$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

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

			// PropertyGroup
			$this->PropertyGroup->EditAttrs["class"] = "form-control";
			$this->PropertyGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyGroup->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PropertyGroup->AdvancedSearch->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
			else
				$this->PropertyGroup->AdvancedSearch->ViewValue = $this->PropertyGroup->Lookup !== NULL && is_array($this->PropertyGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyGroup->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PropertyGroup->EditValue = array_values($this->PropertyGroup->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PropertyGroup`" . SearchString("=", $this->PropertyGroup->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PropertyGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyGroup->EditValue = $arwrk;
			}

			// PropertyType
			$this->PropertyType->EditAttrs["class"] = "form-control";
			$this->PropertyType->EditCustomAttributes = "";
			$this->PropertyType->EditValue = HtmlEncode($this->PropertyType->AdvancedSearch->SearchValue);
			$this->PropertyType->PlaceHolder = RemoveHtml($this->PropertyType->caption());

			// Location
			$this->Location->EditCustomAttributes = "";
			$curVal = trim(strval($this->Location->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Location->AdvancedSearch->ViewValue = $this->Location->lookupCacheOption($curVal);
			else
				$this->Location->AdvancedSearch->ViewValue = $this->Location->Lookup !== NULL && is_array($this->Location->Lookup->Options) ? $curVal : NULL;
			if ($this->Location->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Location->EditValue = array_values($this->Location->Lookup->Options);
				if ($this->Location->AdvancedSearch->ViewValue == "")
					$this->Location->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->Location->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Location->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Location->AdvancedSearch->ViewValue->add($this->Location->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->Location->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Location->EditValue = $arwrk;
			}

			// PropertyStatus
			$this->PropertyStatus->EditAttrs["class"] = "form-control";
			$this->PropertyStatus->EditCustomAttributes = "";
			$this->PropertyStatus->EditValue = HtmlEncode($this->PropertyStatus->AdvancedSearch->SearchValue);
			$this->PropertyStatus->PlaceHolder = RemoveHtml($this->PropertyStatus->caption());

			// PropertyUse
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PropertyUse->AdvancedSearch->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->AdvancedSearch->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
				if ($this->PropertyUse->AdvancedSearch->ViewValue == "")
					$this->PropertyUse->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->PropertyUse->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PropertyUse->AdvancedSearch->ViewValue->add($this->PropertyUse->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->PropertyUse->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// LandExtentInHA
			$this->LandExtentInHA->EditAttrs["class"] = "form-control";
			$this->LandExtentInHA->EditCustomAttributes = "";
			$this->LandExtentInHA->EditValue = HtmlEncode($this->LandExtentInHA->AdvancedSearch->SearchValue);
			$this->LandExtentInHA->PlaceHolder = RemoveHtml($this->LandExtentInHA->caption());

			// RateableValue
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue = HtmlEncode($this->RateableValue->AdvancedSearch->SearchValue);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue2 = HtmlEncode($this->RateableValue->AdvancedSearch->SearchValue2);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());

			// SupplementaryValue
			$this->SupplementaryValue->EditAttrs["class"] = "form-control";
			$this->SupplementaryValue->EditCustomAttributes = "";
			$this->SupplementaryValue->EditValue = HtmlEncode($this->SupplementaryValue->AdvancedSearch->SearchValue);
			$this->SupplementaryValue->PlaceHolder = RemoveHtml($this->SupplementaryValue->caption());

			// ExemptCode
			$this->ExemptCode->EditAttrs["class"] = "form-control";
			$this->ExemptCode->EditCustomAttributes = "";
			if (!$this->ExemptCode->Raw)
				$this->ExemptCode->AdvancedSearch->SearchValue = HtmlDecode($this->ExemptCode->AdvancedSearch->SearchValue);
			$this->ExemptCode->EditValue = HtmlEncode($this->ExemptCode->AdvancedSearch->SearchValue);
			$this->ExemptCode->PlaceHolder = RemoveHtml($this->ExemptCode->caption());

			// Improvements
			$this->Improvements->EditAttrs["class"] = "form-control";
			$this->Improvements->EditCustomAttributes = "";
			$this->Improvements->EditValue = HtmlEncode($this->Improvements->AdvancedSearch->SearchValue);
			$this->Improvements->PlaceHolder = RemoveHtml($this->Improvements->caption());

			// StreetAddress
			$this->StreetAddress->EditAttrs["class"] = "form-control";
			$this->StreetAddress->EditCustomAttributes = "";
			$this->StreetAddress->EditValue = HtmlEncode($this->StreetAddress->AdvancedSearch->SearchValue);
			$this->StreetAddress->PlaceHolder = RemoveHtml($this->StreetAddress->caption());

			// Longitude
			$this->Longitude->EditAttrs["class"] = "form-control";
			$this->Longitude->EditCustomAttributes = "";
			$this->Longitude->EditValue = HtmlEncode($this->Longitude->AdvancedSearch->SearchValue);
			$this->Longitude->PlaceHolder = RemoveHtml($this->Longitude->caption());

			// Latitude
			$this->Latitude->EditAttrs["class"] = "form-control";
			$this->Latitude->EditCustomAttributes = "";
			$this->Latitude->EditValue = HtmlEncode($this->Latitude->AdvancedSearch->SearchValue);
			$this->Latitude->PlaceHolder = RemoveHtml($this->Latitude->caption());

			// Incumberance
			$this->Incumberance->EditAttrs["class"] = "form-control";
			$this->Incumberance->EditCustomAttributes = "";
			if (!$this->Incumberance->Raw)
				$this->Incumberance->AdvancedSearch->SearchValue = HtmlDecode($this->Incumberance->AdvancedSearch->SearchValue);
			$this->Incumberance->EditValue = HtmlEncode($this->Incumberance->AdvancedSearch->SearchValue);
			$this->Incumberance->PlaceHolder = RemoveHtml($this->Incumberance->caption());

			// SubDivisionOf
			$this->SubDivisionOf->EditAttrs["class"] = "form-control";
			$this->SubDivisionOf->EditCustomAttributes = "";
			$this->SubDivisionOf->EditValue = HtmlEncode($this->SubDivisionOf->AdvancedSearch->SearchValue);
			$this->SubDivisionOf->PlaceHolder = RemoveHtml($this->SubDivisionOf->caption());

			// LastUpdatedBy
			$this->LastUpdatedBy->EditAttrs["class"] = "form-control";
			$this->LastUpdatedBy->EditCustomAttributes = "";
			if (!$this->LastUpdatedBy->Raw)
				$this->LastUpdatedBy->AdvancedSearch->SearchValue = HtmlDecode($this->LastUpdatedBy->AdvancedSearch->SearchValue);
			$this->LastUpdatedBy->EditValue = HtmlEncode($this->LastUpdatedBy->AdvancedSearch->SearchValue);
			$this->LastUpdatedBy->PlaceHolder = RemoveHtml($this->LastUpdatedBy->caption());

			// LastUpdateDate
			$this->LastUpdateDate->EditAttrs["class"] = "form-control";
			$this->LastUpdateDate->EditCustomAttributes = "";
			$this->LastUpdateDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->LastUpdateDate->AdvancedSearch->SearchValue, 0), 8));
			$this->LastUpdateDate->PlaceHolder = RemoveHtml($this->LastUpdateDate->caption());

			// ValuationNo
			$this->ValuationNo->EditAttrs["class"] = "form-control";
			$this->ValuationNo->EditCustomAttributes = "";
			$this->ValuationNo->EditValue = HtmlEncode($this->ValuationNo->AdvancedSearch->SearchValue);
			$this->ValuationNo->PlaceHolder = RemoveHtml($this->ValuationNo->caption());

			// LandValue
			$this->LandValue->EditAttrs["class"] = "form-control";
			$this->LandValue->EditCustomAttributes = "";
			$this->LandValue->EditValue = HtmlEncode($this->LandValue->AdvancedSearch->SearchValue);
			$this->LandValue->PlaceHolder = RemoveHtml($this->LandValue->caption());

			// ImprovementsValue
			$this->ImprovementsValue->EditAttrs["class"] = "form-control";
			$this->ImprovementsValue->EditCustomAttributes = "";
			$this->ImprovementsValue->EditValue = HtmlEncode($this->ImprovementsValue->AdvancedSearch->SearchValue);
			$this->ImprovementsValue->PlaceHolder = RemoveHtml($this->ImprovementsValue->caption());
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
		if (!CheckInteger($this->ClientSerNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ClientSerNo->errorMessage());
		}
		if (!CheckNumber($this->RateableValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->RateableValue->errorMessage());
		}
		if (!CheckNumber($this->RateableValue->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->RateableValue->errorMessage());
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
		$this->PropertyNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PropertyGroup->AdvancedSearch->load();
		$this->PropertyType->AdvancedSearch->load();
		$this->Location->AdvancedSearch->load();
		$this->PropertyStatus->AdvancedSearch->load();
		$this->PropertyUse->AdvancedSearch->load();
		$this->LandExtentInHA->AdvancedSearch->load();
		$this->RateableValue->AdvancedSearch->load();
		$this->SupplementaryValue->AdvancedSearch->load();
		$this->ExemptCode->AdvancedSearch->load();
		$this->Improvements->AdvancedSearch->load();
		$this->StreetAddress->AdvancedSearch->load();
		$this->Longitude->AdvancedSearch->load();
		$this->Latitude->AdvancedSearch->load();
		$this->Incumberance->AdvancedSearch->load();
		$this->SubDivisionOf->AdvancedSearch->load();
		$this->LastUpdatedBy->AdvancedSearch->load();
		$this->LastUpdateDate->AdvancedSearch->load();
		$this->ValuationNo->AdvancedSearch->load();
		$this->LandValue->AdvancedSearch->load();
		$this->ImprovementsValue->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fpropertylist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fpropertylist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fpropertylist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_property" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_property\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fpropertylist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpropertylistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"propertysrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"property\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'propertysrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fpropertylistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "client") {
			global $client;
			if (!isset($client))
				$client = new client();
			$rsmaster = $client->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$client;
					$client->exportDocument($doc, $rsmaster);
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
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ClientSerNo", Get("ClientSerNo"))) !== NULL) {
					$GLOBALS["client"]->ClientSerNo->setQueryStringValue($parm);
					$this->ClientSerNo->setQueryStringValue($GLOBALS["client"]->ClientSerNo->QueryStringValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->QueryStringValue);
					if (!is_numeric($GLOBALS["client"]->ClientSerNo->QueryStringValue))
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
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ClientSerNo", Post("ClientSerNo"))) !== NULL) {
					$GLOBALS["client"]->ClientSerNo->setFormValue($parm);
					$this->ClientSerNo->setFormValue($GLOBALS["client"]->ClientSerNo->FormValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->FormValue);
					if (!is_numeric($GLOBALS["client"]->ClientSerNo->FormValue))
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
			if ($masterTblVar != "client") {
				if ($this->ClientSerNo->CurrentValue == "")
					$this->ClientSerNo->setSessionValue("");
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
				case "x_ClientSerNo":
					break;
				case "x_ClientID":
					break;
				case "x_PropertyGroup":
					break;
				case "x_PropertyType":
					break;
				case "x_Location":
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
						case "x_ClientSerNo":
							break;
						case "x_ClientID":
							break;
						case "x_PropertyGroup":
							break;
						case "x_PropertyType":
							break;
						case "x_Location":
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