<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class _asset_view_list extends _asset_view
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'asset_view';

	// Page object name
	public $PageObjName = "_asset_view_list";

	// Grid form hidden field names
	public $FormName = "f_asset_viewlist";
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

		// Table object (_asset_view)
		if (!isset($GLOBALS["_asset_view"]) || get_class($GLOBALS["_asset_view"]) == PROJECT_NAMESPACE . "_asset_view") {
			$GLOBALS["_asset_view"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["_asset_view"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "_asset_viewadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "_asset_viewdelete.php";
		$this->MultiUpdateUrl = "_asset_viewupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'asset_view');

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
		$this->FilterOptions->TagClassName = "ew-filter-option f_asset_viewlistsrch";

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
		global $_asset_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($_asset_view);
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
			$key .= @$ar['ProvinceCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['LACode'];
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
		$this->ProvinceCode->setVisibility();
		$this->ProvinceName->setVisibility();
		$this->LACode->Visible = FALSE;
		$this->LAName->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->AssetTypeCode->Visible = FALSE;
		$this->AssetTypeName->setVisibility();
		$this->Supplier->setVisibility();
		$this->PurchasePrice->setVisibility();
		$this->CurrencyCode->setVisibility();
		$this->ConditionDesc->setVisibility();
		$this->DateOfPurchase->setVisibility();
		$this->AssetCapacity->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AssetDescription->setVisibility();
		$this->DateOfLastRevaluation->setVisibility();
		$this->NewValue->setVisibility();
		$this->NameOfValuer->setVisibility();
		$this->BookValue->setVisibility();
		$this->LastDepreciationDate->setVisibility();
		$this->LastDepreciationAmount->setVisibility();
		$this->DepreciationRate->setVisibility();
		$this->CumulativeDepreciation->setVisibility();
		$this->AssetStatus->setVisibility();
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
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);

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
		if (count($arKeyFlds) >= 2) {
			$this->ProvinceCode->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ProvinceCode->OldValue))
				return FALSE;
			$this->LACode->setOldValue($arKeyFlds[1]);
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "f_asset_viewlistsrch");
		$filterList = Concat($filterList, $this->ProvinceCode->AdvancedSearch->toJson(), ","); // Field ProvinceCode
		$filterList = Concat($filterList, $this->ProvinceName->AdvancedSearch->toJson(), ","); // Field ProvinceName
		$filterList = Concat($filterList, $this->LACode->AdvancedSearch->toJson(), ","); // Field LACode
		$filterList = Concat($filterList, $this->LAName->AdvancedSearch->toJson(), ","); // Field LAName
		$filterList = Concat($filterList, $this->DepartmentCode->AdvancedSearch->toJson(), ","); // Field DepartmentCode
		$filterList = Concat($filterList, $this->AssetTypeCode->AdvancedSearch->toJson(), ","); // Field AssetTypeCode
		$filterList = Concat($filterList, $this->AssetTypeName->AdvancedSearch->toJson(), ","); // Field AssetTypeName
		$filterList = Concat($filterList, $this->Supplier->AdvancedSearch->toJson(), ","); // Field Supplier
		$filterList = Concat($filterList, $this->PurchasePrice->AdvancedSearch->toJson(), ","); // Field PurchasePrice
		$filterList = Concat($filterList, $this->CurrencyCode->AdvancedSearch->toJson(), ","); // Field CurrencyCode
		$filterList = Concat($filterList, $this->ConditionDesc->AdvancedSearch->toJson(), ","); // Field ConditionDesc
		$filterList = Concat($filterList, $this->DateOfPurchase->AdvancedSearch->toJson(), ","); // Field DateOfPurchase
		$filterList = Concat($filterList, $this->AssetCapacity->AdvancedSearch->toJson(), ","); // Field AssetCapacity
		$filterList = Concat($filterList, $this->UnitOfMeasure->AdvancedSearch->toJson(), ","); // Field UnitOfMeasure
		$filterList = Concat($filterList, $this->AssetDescription->AdvancedSearch->toJson(), ","); // Field AssetDescription
		$filterList = Concat($filterList, $this->DateOfLastRevaluation->AdvancedSearch->toJson(), ","); // Field DateOfLastRevaluation
		$filterList = Concat($filterList, $this->NewValue->AdvancedSearch->toJson(), ","); // Field NewValue
		$filterList = Concat($filterList, $this->NameOfValuer->AdvancedSearch->toJson(), ","); // Field NameOfValuer
		$filterList = Concat($filterList, $this->BookValue->AdvancedSearch->toJson(), ","); // Field BookValue
		$filterList = Concat($filterList, $this->LastDepreciationDate->AdvancedSearch->toJson(), ","); // Field LastDepreciationDate
		$filterList = Concat($filterList, $this->LastDepreciationAmount->AdvancedSearch->toJson(), ","); // Field LastDepreciationAmount
		$filterList = Concat($filterList, $this->DepreciationRate->AdvancedSearch->toJson(), ","); // Field DepreciationRate
		$filterList = Concat($filterList, $this->CumulativeDepreciation->AdvancedSearch->toJson(), ","); // Field CumulativeDepreciation
		$filterList = Concat($filterList, $this->AssetStatus->AdvancedSearch->toJson(), ","); // Field AssetStatus
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
			$UserProfile->setSearchFilters(CurrentUserName(), "f_asset_viewlistsrch", $filters);
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

		// Field ProvinceCode
		$this->ProvinceCode->AdvancedSearch->SearchValue = @$filter["x_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchOperator = @$filter["z_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchCondition = @$filter["v_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchValue2 = @$filter["y_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->SearchOperator2 = @$filter["w_ProvinceCode"];
		$this->ProvinceCode->AdvancedSearch->save();

		// Field ProvinceName
		$this->ProvinceName->AdvancedSearch->SearchValue = @$filter["x_ProvinceName"];
		$this->ProvinceName->AdvancedSearch->SearchOperator = @$filter["z_ProvinceName"];
		$this->ProvinceName->AdvancedSearch->SearchCondition = @$filter["v_ProvinceName"];
		$this->ProvinceName->AdvancedSearch->SearchValue2 = @$filter["y_ProvinceName"];
		$this->ProvinceName->AdvancedSearch->SearchOperator2 = @$filter["w_ProvinceName"];
		$this->ProvinceName->AdvancedSearch->save();

		// Field LACode
		$this->LACode->AdvancedSearch->SearchValue = @$filter["x_LACode"];
		$this->LACode->AdvancedSearch->SearchOperator = @$filter["z_LACode"];
		$this->LACode->AdvancedSearch->SearchCondition = @$filter["v_LACode"];
		$this->LACode->AdvancedSearch->SearchValue2 = @$filter["y_LACode"];
		$this->LACode->AdvancedSearch->SearchOperator2 = @$filter["w_LACode"];
		$this->LACode->AdvancedSearch->save();

		// Field LAName
		$this->LAName->AdvancedSearch->SearchValue = @$filter["x_LAName"];
		$this->LAName->AdvancedSearch->SearchOperator = @$filter["z_LAName"];
		$this->LAName->AdvancedSearch->SearchCondition = @$filter["v_LAName"];
		$this->LAName->AdvancedSearch->SearchValue2 = @$filter["y_LAName"];
		$this->LAName->AdvancedSearch->SearchOperator2 = @$filter["w_LAName"];
		$this->LAName->AdvancedSearch->save();

		// Field DepartmentCode
		$this->DepartmentCode->AdvancedSearch->SearchValue = @$filter["x_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchOperator = @$filter["z_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchCondition = @$filter["v_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchValue2 = @$filter["y_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->SearchOperator2 = @$filter["w_DepartmentCode"];
		$this->DepartmentCode->AdvancedSearch->save();

		// Field AssetTypeCode
		$this->AssetTypeCode->AdvancedSearch->SearchValue = @$filter["x_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchOperator = @$filter["z_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchCondition = @$filter["v_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchValue2 = @$filter["y_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchOperator2 = @$filter["w_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->save();

		// Field AssetTypeName
		$this->AssetTypeName->AdvancedSearch->SearchValue = @$filter["x_AssetTypeName"];
		$this->AssetTypeName->AdvancedSearch->SearchOperator = @$filter["z_AssetTypeName"];
		$this->AssetTypeName->AdvancedSearch->SearchCondition = @$filter["v_AssetTypeName"];
		$this->AssetTypeName->AdvancedSearch->SearchValue2 = @$filter["y_AssetTypeName"];
		$this->AssetTypeName->AdvancedSearch->SearchOperator2 = @$filter["w_AssetTypeName"];
		$this->AssetTypeName->AdvancedSearch->save();

		// Field Supplier
		$this->Supplier->AdvancedSearch->SearchValue = @$filter["x_Supplier"];
		$this->Supplier->AdvancedSearch->SearchOperator = @$filter["z_Supplier"];
		$this->Supplier->AdvancedSearch->SearchCondition = @$filter["v_Supplier"];
		$this->Supplier->AdvancedSearch->SearchValue2 = @$filter["y_Supplier"];
		$this->Supplier->AdvancedSearch->SearchOperator2 = @$filter["w_Supplier"];
		$this->Supplier->AdvancedSearch->save();

		// Field PurchasePrice
		$this->PurchasePrice->AdvancedSearch->SearchValue = @$filter["x_PurchasePrice"];
		$this->PurchasePrice->AdvancedSearch->SearchOperator = @$filter["z_PurchasePrice"];
		$this->PurchasePrice->AdvancedSearch->SearchCondition = @$filter["v_PurchasePrice"];
		$this->PurchasePrice->AdvancedSearch->SearchValue2 = @$filter["y_PurchasePrice"];
		$this->PurchasePrice->AdvancedSearch->SearchOperator2 = @$filter["w_PurchasePrice"];
		$this->PurchasePrice->AdvancedSearch->save();

		// Field CurrencyCode
		$this->CurrencyCode->AdvancedSearch->SearchValue = @$filter["x_CurrencyCode"];
		$this->CurrencyCode->AdvancedSearch->SearchOperator = @$filter["z_CurrencyCode"];
		$this->CurrencyCode->AdvancedSearch->SearchCondition = @$filter["v_CurrencyCode"];
		$this->CurrencyCode->AdvancedSearch->SearchValue2 = @$filter["y_CurrencyCode"];
		$this->CurrencyCode->AdvancedSearch->SearchOperator2 = @$filter["w_CurrencyCode"];
		$this->CurrencyCode->AdvancedSearch->save();

		// Field ConditionDesc
		$this->ConditionDesc->AdvancedSearch->SearchValue = @$filter["x_ConditionDesc"];
		$this->ConditionDesc->AdvancedSearch->SearchOperator = @$filter["z_ConditionDesc"];
		$this->ConditionDesc->AdvancedSearch->SearchCondition = @$filter["v_ConditionDesc"];
		$this->ConditionDesc->AdvancedSearch->SearchValue2 = @$filter["y_ConditionDesc"];
		$this->ConditionDesc->AdvancedSearch->SearchOperator2 = @$filter["w_ConditionDesc"];
		$this->ConditionDesc->AdvancedSearch->save();

		// Field DateOfPurchase
		$this->DateOfPurchase->AdvancedSearch->SearchValue = @$filter["x_DateOfPurchase"];
		$this->DateOfPurchase->AdvancedSearch->SearchOperator = @$filter["z_DateOfPurchase"];
		$this->DateOfPurchase->AdvancedSearch->SearchCondition = @$filter["v_DateOfPurchase"];
		$this->DateOfPurchase->AdvancedSearch->SearchValue2 = @$filter["y_DateOfPurchase"];
		$this->DateOfPurchase->AdvancedSearch->SearchOperator2 = @$filter["w_DateOfPurchase"];
		$this->DateOfPurchase->AdvancedSearch->save();

		// Field AssetCapacity
		$this->AssetCapacity->AdvancedSearch->SearchValue = @$filter["x_AssetCapacity"];
		$this->AssetCapacity->AdvancedSearch->SearchOperator = @$filter["z_AssetCapacity"];
		$this->AssetCapacity->AdvancedSearch->SearchCondition = @$filter["v_AssetCapacity"];
		$this->AssetCapacity->AdvancedSearch->SearchValue2 = @$filter["y_AssetCapacity"];
		$this->AssetCapacity->AdvancedSearch->SearchOperator2 = @$filter["w_AssetCapacity"];
		$this->AssetCapacity->AdvancedSearch->save();

		// Field UnitOfMeasure
		$this->UnitOfMeasure->AdvancedSearch->SearchValue = @$filter["x_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator = @$filter["z_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchCondition = @$filter["v_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchValue2 = @$filter["y_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator2 = @$filter["w_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->save();

		// Field AssetDescription
		$this->AssetDescription->AdvancedSearch->SearchValue = @$filter["x_AssetDescription"];
		$this->AssetDescription->AdvancedSearch->SearchOperator = @$filter["z_AssetDescription"];
		$this->AssetDescription->AdvancedSearch->SearchCondition = @$filter["v_AssetDescription"];
		$this->AssetDescription->AdvancedSearch->SearchValue2 = @$filter["y_AssetDescription"];
		$this->AssetDescription->AdvancedSearch->SearchOperator2 = @$filter["w_AssetDescription"];
		$this->AssetDescription->AdvancedSearch->save();

		// Field DateOfLastRevaluation
		$this->DateOfLastRevaluation->AdvancedSearch->SearchValue = @$filter["x_DateOfLastRevaluation"];
		$this->DateOfLastRevaluation->AdvancedSearch->SearchOperator = @$filter["z_DateOfLastRevaluation"];
		$this->DateOfLastRevaluation->AdvancedSearch->SearchCondition = @$filter["v_DateOfLastRevaluation"];
		$this->DateOfLastRevaluation->AdvancedSearch->SearchValue2 = @$filter["y_DateOfLastRevaluation"];
		$this->DateOfLastRevaluation->AdvancedSearch->SearchOperator2 = @$filter["w_DateOfLastRevaluation"];
		$this->DateOfLastRevaluation->AdvancedSearch->save();

		// Field NewValue
		$this->NewValue->AdvancedSearch->SearchValue = @$filter["x_NewValue"];
		$this->NewValue->AdvancedSearch->SearchOperator = @$filter["z_NewValue"];
		$this->NewValue->AdvancedSearch->SearchCondition = @$filter["v_NewValue"];
		$this->NewValue->AdvancedSearch->SearchValue2 = @$filter["y_NewValue"];
		$this->NewValue->AdvancedSearch->SearchOperator2 = @$filter["w_NewValue"];
		$this->NewValue->AdvancedSearch->save();

		// Field NameOfValuer
		$this->NameOfValuer->AdvancedSearch->SearchValue = @$filter["x_NameOfValuer"];
		$this->NameOfValuer->AdvancedSearch->SearchOperator = @$filter["z_NameOfValuer"];
		$this->NameOfValuer->AdvancedSearch->SearchCondition = @$filter["v_NameOfValuer"];
		$this->NameOfValuer->AdvancedSearch->SearchValue2 = @$filter["y_NameOfValuer"];
		$this->NameOfValuer->AdvancedSearch->SearchOperator2 = @$filter["w_NameOfValuer"];
		$this->NameOfValuer->AdvancedSearch->save();

		// Field BookValue
		$this->BookValue->AdvancedSearch->SearchValue = @$filter["x_BookValue"];
		$this->BookValue->AdvancedSearch->SearchOperator = @$filter["z_BookValue"];
		$this->BookValue->AdvancedSearch->SearchCondition = @$filter["v_BookValue"];
		$this->BookValue->AdvancedSearch->SearchValue2 = @$filter["y_BookValue"];
		$this->BookValue->AdvancedSearch->SearchOperator2 = @$filter["w_BookValue"];
		$this->BookValue->AdvancedSearch->save();

		// Field LastDepreciationDate
		$this->LastDepreciationDate->AdvancedSearch->SearchValue = @$filter["x_LastDepreciationDate"];
		$this->LastDepreciationDate->AdvancedSearch->SearchOperator = @$filter["z_LastDepreciationDate"];
		$this->LastDepreciationDate->AdvancedSearch->SearchCondition = @$filter["v_LastDepreciationDate"];
		$this->LastDepreciationDate->AdvancedSearch->SearchValue2 = @$filter["y_LastDepreciationDate"];
		$this->LastDepreciationDate->AdvancedSearch->SearchOperator2 = @$filter["w_LastDepreciationDate"];
		$this->LastDepreciationDate->AdvancedSearch->save();

		// Field LastDepreciationAmount
		$this->LastDepreciationAmount->AdvancedSearch->SearchValue = @$filter["x_LastDepreciationAmount"];
		$this->LastDepreciationAmount->AdvancedSearch->SearchOperator = @$filter["z_LastDepreciationAmount"];
		$this->LastDepreciationAmount->AdvancedSearch->SearchCondition = @$filter["v_LastDepreciationAmount"];
		$this->LastDepreciationAmount->AdvancedSearch->SearchValue2 = @$filter["y_LastDepreciationAmount"];
		$this->LastDepreciationAmount->AdvancedSearch->SearchOperator2 = @$filter["w_LastDepreciationAmount"];
		$this->LastDepreciationAmount->AdvancedSearch->save();

		// Field DepreciationRate
		$this->DepreciationRate->AdvancedSearch->SearchValue = @$filter["x_DepreciationRate"];
		$this->DepreciationRate->AdvancedSearch->SearchOperator = @$filter["z_DepreciationRate"];
		$this->DepreciationRate->AdvancedSearch->SearchCondition = @$filter["v_DepreciationRate"];
		$this->DepreciationRate->AdvancedSearch->SearchValue2 = @$filter["y_DepreciationRate"];
		$this->DepreciationRate->AdvancedSearch->SearchOperator2 = @$filter["w_DepreciationRate"];
		$this->DepreciationRate->AdvancedSearch->save();

		// Field CumulativeDepreciation
		$this->CumulativeDepreciation->AdvancedSearch->SearchValue = @$filter["x_CumulativeDepreciation"];
		$this->CumulativeDepreciation->AdvancedSearch->SearchOperator = @$filter["z_CumulativeDepreciation"];
		$this->CumulativeDepreciation->AdvancedSearch->SearchCondition = @$filter["v_CumulativeDepreciation"];
		$this->CumulativeDepreciation->AdvancedSearch->SearchValue2 = @$filter["y_CumulativeDepreciation"];
		$this->CumulativeDepreciation->AdvancedSearch->SearchOperator2 = @$filter["w_CumulativeDepreciation"];
		$this->CumulativeDepreciation->AdvancedSearch->save();

		// Field AssetStatus
		$this->AssetStatus->AdvancedSearch->SearchValue = @$filter["x_AssetStatus"];
		$this->AssetStatus->AdvancedSearch->SearchOperator = @$filter["z_AssetStatus"];
		$this->AssetStatus->AdvancedSearch->SearchCondition = @$filter["v_AssetStatus"];
		$this->AssetStatus->AdvancedSearch->SearchValue2 = @$filter["y_AssetStatus"];
		$this->AssetStatus->AdvancedSearch->SearchOperator2 = @$filter["w_AssetStatus"];
		$this->AssetStatus->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->ProvinceCode, $default, FALSE); // ProvinceCode
		$this->buildSearchSql($where, $this->ProvinceName, $default, FALSE); // ProvinceName
		$this->buildSearchSql($where, $this->LACode, $default, FALSE); // LACode
		$this->buildSearchSql($where, $this->LAName, $default, FALSE); // LAName
		$this->buildSearchSql($where, $this->DepartmentCode, $default, FALSE); // DepartmentCode
		$this->buildSearchSql($where, $this->AssetTypeCode, $default, FALSE); // AssetTypeCode
		$this->buildSearchSql($where, $this->AssetTypeName, $default, FALSE); // AssetTypeName
		$this->buildSearchSql($where, $this->Supplier, $default, FALSE); // Supplier
		$this->buildSearchSql($where, $this->PurchasePrice, $default, FALSE); // PurchasePrice
		$this->buildSearchSql($where, $this->CurrencyCode, $default, FALSE); // CurrencyCode
		$this->buildSearchSql($where, $this->ConditionDesc, $default, FALSE); // ConditionDesc
		$this->buildSearchSql($where, $this->DateOfPurchase, $default, FALSE); // DateOfPurchase
		$this->buildSearchSql($where, $this->AssetCapacity, $default, FALSE); // AssetCapacity
		$this->buildSearchSql($where, $this->UnitOfMeasure, $default, FALSE); // UnitOfMeasure
		$this->buildSearchSql($where, $this->AssetDescription, $default, FALSE); // AssetDescription
		$this->buildSearchSql($where, $this->DateOfLastRevaluation, $default, FALSE); // DateOfLastRevaluation
		$this->buildSearchSql($where, $this->NewValue, $default, FALSE); // NewValue
		$this->buildSearchSql($where, $this->NameOfValuer, $default, FALSE); // NameOfValuer
		$this->buildSearchSql($where, $this->BookValue, $default, FALSE); // BookValue
		$this->buildSearchSql($where, $this->LastDepreciationDate, $default, FALSE); // LastDepreciationDate
		$this->buildSearchSql($where, $this->LastDepreciationAmount, $default, FALSE); // LastDepreciationAmount
		$this->buildSearchSql($where, $this->DepreciationRate, $default, FALSE); // DepreciationRate
		$this->buildSearchSql($where, $this->CumulativeDepreciation, $default, FALSE); // CumulativeDepreciation
		$this->buildSearchSql($where, $this->AssetStatus, $default, FALSE); // AssetStatus

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->ProvinceCode->AdvancedSearch->save(); // ProvinceCode
			$this->ProvinceName->AdvancedSearch->save(); // ProvinceName
			$this->LACode->AdvancedSearch->save(); // LACode
			$this->LAName->AdvancedSearch->save(); // LAName
			$this->DepartmentCode->AdvancedSearch->save(); // DepartmentCode
			$this->AssetTypeCode->AdvancedSearch->save(); // AssetTypeCode
			$this->AssetTypeName->AdvancedSearch->save(); // AssetTypeName
			$this->Supplier->AdvancedSearch->save(); // Supplier
			$this->PurchasePrice->AdvancedSearch->save(); // PurchasePrice
			$this->CurrencyCode->AdvancedSearch->save(); // CurrencyCode
			$this->ConditionDesc->AdvancedSearch->save(); // ConditionDesc
			$this->DateOfPurchase->AdvancedSearch->save(); // DateOfPurchase
			$this->AssetCapacity->AdvancedSearch->save(); // AssetCapacity
			$this->UnitOfMeasure->AdvancedSearch->save(); // UnitOfMeasure
			$this->AssetDescription->AdvancedSearch->save(); // AssetDescription
			$this->DateOfLastRevaluation->AdvancedSearch->save(); // DateOfLastRevaluation
			$this->NewValue->AdvancedSearch->save(); // NewValue
			$this->NameOfValuer->AdvancedSearch->save(); // NameOfValuer
			$this->BookValue->AdvancedSearch->save(); // BookValue
			$this->LastDepreciationDate->AdvancedSearch->save(); // LastDepreciationDate
			$this->LastDepreciationAmount->AdvancedSearch->save(); // LastDepreciationAmount
			$this->DepreciationRate->AdvancedSearch->save(); // DepreciationRate
			$this->CumulativeDepreciation->AdvancedSearch->save(); // CumulativeDepreciation
			$this->AssetStatus->AdvancedSearch->save(); // AssetStatus
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
		$this->buildBasicSearchSql($where, $this->ProvinceName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LAName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AssetTypeName, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Supplier, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->CurrencyCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ConditionDesc, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->UnitOfMeasure, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AssetDescription, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->NameOfValuer, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AssetStatus, $arKeywords, $type);
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
		if ($this->ProvinceCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProvinceName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LACode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LAName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DepartmentCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AssetTypeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AssetTypeName->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Supplier->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PurchasePrice->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CurrencyCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ConditionDesc->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DateOfPurchase->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AssetCapacity->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AssetDescription->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DateOfLastRevaluation->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NewValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->NameOfValuer->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BookValue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastDepreciationDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastDepreciationAmount->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DepreciationRate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CumulativeDepreciation->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AssetStatus->AdvancedSearch->issetSession())
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
		$this->ProvinceCode->AdvancedSearch->unsetSession();
		$this->ProvinceName->AdvancedSearch->unsetSession();
		$this->LACode->AdvancedSearch->unsetSession();
		$this->LAName->AdvancedSearch->unsetSession();
		$this->DepartmentCode->AdvancedSearch->unsetSession();
		$this->AssetTypeCode->AdvancedSearch->unsetSession();
		$this->AssetTypeName->AdvancedSearch->unsetSession();
		$this->Supplier->AdvancedSearch->unsetSession();
		$this->PurchasePrice->AdvancedSearch->unsetSession();
		$this->CurrencyCode->AdvancedSearch->unsetSession();
		$this->ConditionDesc->AdvancedSearch->unsetSession();
		$this->DateOfPurchase->AdvancedSearch->unsetSession();
		$this->AssetCapacity->AdvancedSearch->unsetSession();
		$this->UnitOfMeasure->AdvancedSearch->unsetSession();
		$this->AssetDescription->AdvancedSearch->unsetSession();
		$this->DateOfLastRevaluation->AdvancedSearch->unsetSession();
		$this->NewValue->AdvancedSearch->unsetSession();
		$this->NameOfValuer->AdvancedSearch->unsetSession();
		$this->BookValue->AdvancedSearch->unsetSession();
		$this->LastDepreciationDate->AdvancedSearch->unsetSession();
		$this->LastDepreciationAmount->AdvancedSearch->unsetSession();
		$this->DepreciationRate->AdvancedSearch->unsetSession();
		$this->CumulativeDepreciation->AdvancedSearch->unsetSession();
		$this->AssetStatus->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->ProvinceCode->AdvancedSearch->load();
		$this->ProvinceName->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->LAName->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->AssetTypeCode->AdvancedSearch->load();
		$this->AssetTypeName->AdvancedSearch->load();
		$this->Supplier->AdvancedSearch->load();
		$this->PurchasePrice->AdvancedSearch->load();
		$this->CurrencyCode->AdvancedSearch->load();
		$this->ConditionDesc->AdvancedSearch->load();
		$this->DateOfPurchase->AdvancedSearch->load();
		$this->AssetCapacity->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AssetDescription->AdvancedSearch->load();
		$this->DateOfLastRevaluation->AdvancedSearch->load();
		$this->NewValue->AdvancedSearch->load();
		$this->NameOfValuer->AdvancedSearch->load();
		$this->BookValue->AdvancedSearch->load();
		$this->LastDepreciationDate->AdvancedSearch->load();
		$this->LastDepreciationAmount->AdvancedSearch->load();
		$this->DepreciationRate->AdvancedSearch->load();
		$this->CumulativeDepreciation->AdvancedSearch->load();
		$this->AssetStatus->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->ProvinceCode); // ProvinceCode
			$this->updateSort($this->ProvinceName); // ProvinceName
			$this->updateSort($this->LAName); // LAName
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->AssetTypeName); // AssetTypeName
			$this->updateSort($this->Supplier); // Supplier
			$this->updateSort($this->PurchasePrice); // PurchasePrice
			$this->updateSort($this->CurrencyCode); // CurrencyCode
			$this->updateSort($this->ConditionDesc); // ConditionDesc
			$this->updateSort($this->DateOfPurchase); // DateOfPurchase
			$this->updateSort($this->AssetCapacity); // AssetCapacity
			$this->updateSort($this->UnitOfMeasure); // UnitOfMeasure
			$this->updateSort($this->AssetDescription); // AssetDescription
			$this->updateSort($this->DateOfLastRevaluation); // DateOfLastRevaluation
			$this->updateSort($this->NewValue); // NewValue
			$this->updateSort($this->NameOfValuer); // NameOfValuer
			$this->updateSort($this->BookValue); // BookValue
			$this->updateSort($this->LastDepreciationDate); // LastDepreciationDate
			$this->updateSort($this->LastDepreciationAmount); // LastDepreciationAmount
			$this->updateSort($this->DepreciationRate); // DepreciationRate
			$this->updateSort($this->CumulativeDepreciation); // CumulativeDepreciation
			$this->updateSort($this->AssetStatus); // AssetStatus
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
				$this->ProvinceCode->setSort("");
				$this->ProvinceName->setSort("");
				$this->LAName->setSort("");
				$this->DepartmentCode->setSort("");
				$this->AssetTypeName->setSort("");
				$this->Supplier->setSort("");
				$this->PurchasePrice->setSort("");
				$this->CurrencyCode->setSort("");
				$this->ConditionDesc->setSort("");
				$this->DateOfPurchase->setSort("");
				$this->AssetCapacity->setSort("");
				$this->UnitOfMeasure->setSort("");
				$this->AssetDescription->setSort("");
				$this->DateOfLastRevaluation->setSort("");
				$this->NewValue->setSort("");
				$this->NameOfValuer->setSort("");
				$this->BookValue->setSort("");
				$this->LastDepreciationDate->setSort("");
				$this->LastDepreciationAmount->setSort("");
				$this->DepreciationRate->setSort("");
				$this->CumulativeDepreciation->setSort("");
				$this->AssetStatus->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ProvinceCode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"f_asset_viewlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"f_asset_viewlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.f_asset_viewlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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

		// ProvinceCode
		if (!$this->isAddOrEdit() && $this->ProvinceCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProvinceCode->AdvancedSearch->SearchValue != "" || $this->ProvinceCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ProvinceName
		if (!$this->isAddOrEdit() && $this->ProvinceName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ProvinceName->AdvancedSearch->SearchValue != "" || $this->ProvinceName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LACode
		if (!$this->isAddOrEdit() && $this->LACode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LACode->AdvancedSearch->SearchValue != "" || $this->LACode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LAName
		if (!$this->isAddOrEdit() && $this->LAName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LAName->AdvancedSearch->SearchValue != "" || $this->LAName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DepartmentCode
		if (!$this->isAddOrEdit() && $this->DepartmentCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DepartmentCode->AdvancedSearch->SearchValue != "" || $this->DepartmentCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AssetTypeCode
		if (!$this->isAddOrEdit() && $this->AssetTypeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetTypeCode->AdvancedSearch->SearchValue != "" || $this->AssetTypeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AssetTypeName
		if (!$this->isAddOrEdit() && $this->AssetTypeName->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetTypeName->AdvancedSearch->SearchValue != "" || $this->AssetTypeName->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Supplier
		if (!$this->isAddOrEdit() && $this->Supplier->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Supplier->AdvancedSearch->SearchValue != "" || $this->Supplier->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PurchasePrice
		if (!$this->isAddOrEdit() && $this->PurchasePrice->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PurchasePrice->AdvancedSearch->SearchValue != "" || $this->PurchasePrice->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// CurrencyCode
		if (!$this->isAddOrEdit() && $this->CurrencyCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CurrencyCode->AdvancedSearch->SearchValue != "" || $this->CurrencyCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ConditionDesc
		if (!$this->isAddOrEdit() && $this->ConditionDesc->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ConditionDesc->AdvancedSearch->SearchValue != "" || $this->ConditionDesc->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DateOfPurchase
		if (!$this->isAddOrEdit() && $this->DateOfPurchase->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DateOfPurchase->AdvancedSearch->SearchValue != "" || $this->DateOfPurchase->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AssetCapacity
		if (!$this->isAddOrEdit() && $this->AssetCapacity->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetCapacity->AdvancedSearch->SearchValue != "" || $this->AssetCapacity->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// UnitOfMeasure
		if (!$this->isAddOrEdit() && $this->UnitOfMeasure->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UnitOfMeasure->AdvancedSearch->SearchValue != "" || $this->UnitOfMeasure->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AssetDescription
		if (!$this->isAddOrEdit() && $this->AssetDescription->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetDescription->AdvancedSearch->SearchValue != "" || $this->AssetDescription->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DateOfLastRevaluation
		if (!$this->isAddOrEdit() && $this->DateOfLastRevaluation->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DateOfLastRevaluation->AdvancedSearch->SearchValue != "" || $this->DateOfLastRevaluation->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NewValue
		if (!$this->isAddOrEdit() && $this->NewValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NewValue->AdvancedSearch->SearchValue != "" || $this->NewValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// NameOfValuer
		if (!$this->isAddOrEdit() && $this->NameOfValuer->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->NameOfValuer->AdvancedSearch->SearchValue != "" || $this->NameOfValuer->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BookValue
		if (!$this->isAddOrEdit() && $this->BookValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BookValue->AdvancedSearch->SearchValue != "" || $this->BookValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LastDepreciationDate
		if (!$this->isAddOrEdit() && $this->LastDepreciationDate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LastDepreciationDate->AdvancedSearch->SearchValue != "" || $this->LastDepreciationDate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// LastDepreciationAmount
		if (!$this->isAddOrEdit() && $this->LastDepreciationAmount->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->LastDepreciationAmount->AdvancedSearch->SearchValue != "" || $this->LastDepreciationAmount->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// DepreciationRate
		if (!$this->isAddOrEdit() && $this->DepreciationRate->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->DepreciationRate->AdvancedSearch->SearchValue != "" || $this->DepreciationRate->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// CumulativeDepreciation
		if (!$this->isAddOrEdit() && $this->CumulativeDepreciation->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CumulativeDepreciation->AdvancedSearch->SearchValue != "" || $this->CumulativeDepreciation->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AssetStatus
		if (!$this->isAddOrEdit() && $this->AssetStatus->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetStatus->AdvancedSearch->SearchValue != "" || $this->AssetStatus->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->ProvinceName->setDbValue($row['ProvinceName']);
		$this->LACode->setDbValue($row['LACode']);
		$this->LAName->setDbValue($row['LAName']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->AssetTypeCode->setDbValue($row['AssetTypeCode']);
		$this->AssetTypeName->setDbValue($row['AssetTypeName']);
		$this->Supplier->setDbValue($row['Supplier']);
		$this->PurchasePrice->setDbValue($row['PurchasePrice']);
		$this->CurrencyCode->setDbValue($row['CurrencyCode']);
		$this->ConditionDesc->setDbValue($row['ConditionDesc']);
		$this->DateOfPurchase->setDbValue($row['DateOfPurchase']);
		$this->AssetCapacity->setDbValue($row['AssetCapacity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->AssetDescription->setDbValue($row['AssetDescription']);
		$this->DateOfLastRevaluation->setDbValue($row['DateOfLastRevaluation']);
		$this->NewValue->setDbValue($row['NewValue']);
		$this->NameOfValuer->setDbValue($row['NameOfValuer']);
		$this->BookValue->setDbValue($row['BookValue']);
		$this->LastDepreciationDate->setDbValue($row['LastDepreciationDate']);
		$this->LastDepreciationAmount->setDbValue($row['LastDepreciationAmount']);
		$this->DepreciationRate->setDbValue($row['DepreciationRate']);
		$this->CumulativeDepreciation->setDbValue($row['CumulativeDepreciation']);
		$this->AssetStatus->setDbValue($row['AssetStatus']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ProvinceCode'] = NULL;
		$row['ProvinceName'] = NULL;
		$row['LACode'] = NULL;
		$row['LAName'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['AssetTypeCode'] = NULL;
		$row['AssetTypeName'] = NULL;
		$row['Supplier'] = NULL;
		$row['PurchasePrice'] = NULL;
		$row['CurrencyCode'] = NULL;
		$row['ConditionDesc'] = NULL;
		$row['DateOfPurchase'] = NULL;
		$row['AssetCapacity'] = NULL;
		$row['UnitOfMeasure'] = NULL;
		$row['AssetDescription'] = NULL;
		$row['DateOfLastRevaluation'] = NULL;
		$row['NewValue'] = NULL;
		$row['NameOfValuer'] = NULL;
		$row['BookValue'] = NULL;
		$row['LastDepreciationDate'] = NULL;
		$row['LastDepreciationAmount'] = NULL;
		$row['DepreciationRate'] = NULL;
		$row['CumulativeDepreciation'] = NULL;
		$row['AssetStatus'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ProvinceCode")) != "")
			$this->ProvinceCode->OldValue = $this->getKey("ProvinceCode"); // ProvinceCode
		else
			$validKey = FALSE;
		if (strval($this->getKey("LACode")) != "")
			$this->LACode->OldValue = $this->getKey("LACode"); // LACode
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
		if ($this->PurchasePrice->FormValue == $this->PurchasePrice->CurrentValue && is_numeric(ConvertToFloatString($this->PurchasePrice->CurrentValue)))
			$this->PurchasePrice->CurrentValue = ConvertToFloatString($this->PurchasePrice->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AssetCapacity->FormValue == $this->AssetCapacity->CurrentValue && is_numeric(ConvertToFloatString($this->AssetCapacity->CurrentValue)))
			$this->AssetCapacity->CurrentValue = ConvertToFloatString($this->AssetCapacity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->NewValue->FormValue == $this->NewValue->CurrentValue && is_numeric(ConvertToFloatString($this->NewValue->CurrentValue)))
			$this->NewValue->CurrentValue = ConvertToFloatString($this->NewValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BookValue->FormValue == $this->BookValue->CurrentValue && is_numeric(ConvertToFloatString($this->BookValue->CurrentValue)))
			$this->BookValue->CurrentValue = ConvertToFloatString($this->BookValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->LastDepreciationAmount->FormValue == $this->LastDepreciationAmount->CurrentValue && is_numeric(ConvertToFloatString($this->LastDepreciationAmount->CurrentValue)))
			$this->LastDepreciationAmount->CurrentValue = ConvertToFloatString($this->LastDepreciationAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->DepreciationRate->FormValue == $this->DepreciationRate->CurrentValue && is_numeric(ConvertToFloatString($this->DepreciationRate->CurrentValue)))
			$this->DepreciationRate->CurrentValue = ConvertToFloatString($this->DepreciationRate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->CumulativeDepreciation->FormValue == $this->CumulativeDepreciation->CurrentValue && is_numeric(ConvertToFloatString($this->CumulativeDepreciation->CurrentValue)))
			$this->CumulativeDepreciation->CurrentValue = ConvertToFloatString($this->CumulativeDepreciation->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ProvinceCode
		// ProvinceName
		// LACode
		// LAName
		// DepartmentCode
		// AssetTypeCode
		// AssetTypeName
		// Supplier
		// PurchasePrice
		// CurrencyCode
		// ConditionDesc
		// DateOfPurchase
		// AssetCapacity
		// UnitOfMeasure
		// AssetDescription
		// DateOfLastRevaluation
		// NewValue
		// NameOfValuer
		// BookValue
		// LastDepreciationDate
		// LastDepreciationAmount
		// DepreciationRate
		// CumulativeDepreciation
		// AssetStatus

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// ProvinceName
			$this->ProvinceName->ViewValue = $this->ProvinceName->CurrentValue;
			$this->ProvinceName->ViewCustomAttributes = "";

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

			// LAName
			$this->LAName->ViewValue = $this->LAName->CurrentValue;
			$this->LAName->ViewCustomAttributes = "";

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

			// AssetTypeCode
			$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->CurrentValue;
			$this->AssetTypeCode->ViewCustomAttributes = "";

			// AssetTypeName
			$this->AssetTypeName->ViewValue = $this->AssetTypeName->CurrentValue;
			$this->AssetTypeName->ViewCustomAttributes = "";

			// Supplier
			$this->Supplier->ViewValue = $this->Supplier->CurrentValue;
			$this->Supplier->ViewCustomAttributes = "";

			// PurchasePrice
			$this->PurchasePrice->ViewValue = $this->PurchasePrice->CurrentValue;
			$this->PurchasePrice->ViewValue = FormatNumber($this->PurchasePrice->ViewValue, 0, -2, -2, -2);
			$this->PurchasePrice->CellCssStyle .= "text-align: right;";
			$this->PurchasePrice->ViewCustomAttributes = "";

			// CurrencyCode
			$this->CurrencyCode->ViewValue = $this->CurrencyCode->CurrentValue;
			$this->CurrencyCode->ViewCustomAttributes = "";

			// ConditionDesc
			$this->ConditionDesc->ViewValue = $this->ConditionDesc->CurrentValue;
			$this->ConditionDesc->ViewCustomAttributes = "";

			// DateOfPurchase
			$this->DateOfPurchase->ViewValue = $this->DateOfPurchase->CurrentValue;
			$this->DateOfPurchase->ViewValue = FormatDateTime($this->DateOfPurchase->ViewValue, 0);
			$this->DateOfPurchase->ViewCustomAttributes = "";

			// AssetCapacity
			$this->AssetCapacity->ViewValue = $this->AssetCapacity->CurrentValue;
			$this->AssetCapacity->ViewValue = FormatNumber($this->AssetCapacity->ViewValue, 2, -2, -2, -2);
			$this->AssetCapacity->ViewCustomAttributes = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// AssetDescription
			$this->AssetDescription->ViewValue = $this->AssetDescription->CurrentValue;
			$this->AssetDescription->ViewCustomAttributes = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->ViewValue = $this->DateOfLastRevaluation->CurrentValue;
			$this->DateOfLastRevaluation->ViewValue = FormatDateTime($this->DateOfLastRevaluation->ViewValue, 0);
			$this->DateOfLastRevaluation->ViewCustomAttributes = "";

			// NewValue
			$this->NewValue->ViewValue = $this->NewValue->CurrentValue;
			$this->NewValue->ViewValue = FormatNumber($this->NewValue->ViewValue, 2, -2, -2, -2);
			$this->NewValue->CellCssStyle .= "text-align: right;";
			$this->NewValue->ViewCustomAttributes = "";

			// NameOfValuer
			$this->NameOfValuer->ViewValue = $this->NameOfValuer->CurrentValue;
			$this->NameOfValuer->ViewCustomAttributes = "";

			// BookValue
			$this->BookValue->ViewValue = $this->BookValue->CurrentValue;
			$this->BookValue->ViewValue = FormatNumber($this->BookValue->ViewValue, 2, -2, -2, -2);
			$this->BookValue->ViewCustomAttributes = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->ViewValue = $this->LastDepreciationDate->CurrentValue;
			$this->LastDepreciationDate->ViewValue = FormatDateTime($this->LastDepreciationDate->ViewValue, 0);
			$this->LastDepreciationDate->ViewCustomAttributes = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->ViewValue = $this->LastDepreciationAmount->CurrentValue;
			$this->LastDepreciationAmount->ViewValue = FormatNumber($this->LastDepreciationAmount->ViewValue, 2, -2, -2, -2);
			$this->LastDepreciationAmount->CellCssStyle .= "text-align: right;";
			$this->LastDepreciationAmount->ViewCustomAttributes = "";

			// DepreciationRate
			$this->DepreciationRate->ViewValue = $this->DepreciationRate->CurrentValue;
			$this->DepreciationRate->ViewValue = FormatNumber($this->DepreciationRate->ViewValue, 2, -2, -2, -2);
			$this->DepreciationRate->CellCssStyle .= "text-align: right;";
			$this->DepreciationRate->ViewCustomAttributes = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->ViewValue = $this->CumulativeDepreciation->CurrentValue;
			$this->CumulativeDepreciation->ViewValue = FormatNumber($this->CumulativeDepreciation->ViewValue, 2, -2, -2, -2);
			$this->CumulativeDepreciation->CellCssStyle .= "text-align: right;";
			$this->CumulativeDepreciation->ViewCustomAttributes = "";

			// AssetStatus
			$this->AssetStatus->ViewValue = $this->AssetStatus->CurrentValue;
			$this->AssetStatus->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// ProvinceName
			$this->ProvinceName->LinkCustomAttributes = "";
			$this->ProvinceName->HrefValue = "";
			$this->ProvinceName->TooltipValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";
			$this->LAName->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// AssetTypeName
			$this->AssetTypeName->LinkCustomAttributes = "";
			$this->AssetTypeName->HrefValue = "";
			$this->AssetTypeName->TooltipValue = "";

			// Supplier
			$this->Supplier->LinkCustomAttributes = "";
			$this->Supplier->HrefValue = "";
			$this->Supplier->TooltipValue = "";

			// PurchasePrice
			$this->PurchasePrice->LinkCustomAttributes = "";
			$this->PurchasePrice->HrefValue = "";
			$this->PurchasePrice->TooltipValue = "";

			// CurrencyCode
			$this->CurrencyCode->LinkCustomAttributes = "";
			$this->CurrencyCode->HrefValue = "";
			$this->CurrencyCode->TooltipValue = "";

			// ConditionDesc
			$this->ConditionDesc->LinkCustomAttributes = "";
			$this->ConditionDesc->HrefValue = "";
			$this->ConditionDesc->TooltipValue = "";

			// DateOfPurchase
			$this->DateOfPurchase->LinkCustomAttributes = "";
			$this->DateOfPurchase->HrefValue = "";
			$this->DateOfPurchase->TooltipValue = "";

			// AssetCapacity
			$this->AssetCapacity->LinkCustomAttributes = "";
			$this->AssetCapacity->HrefValue = "";
			$this->AssetCapacity->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// AssetDescription
			$this->AssetDescription->LinkCustomAttributes = "";
			$this->AssetDescription->HrefValue = "";
			$this->AssetDescription->TooltipValue = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->LinkCustomAttributes = "";
			$this->DateOfLastRevaluation->HrefValue = "";
			$this->DateOfLastRevaluation->TooltipValue = "";

			// NewValue
			$this->NewValue->LinkCustomAttributes = "";
			$this->NewValue->HrefValue = "";
			$this->NewValue->TooltipValue = "";

			// NameOfValuer
			$this->NameOfValuer->LinkCustomAttributes = "";
			$this->NameOfValuer->HrefValue = "";
			$this->NameOfValuer->TooltipValue = "";

			// BookValue
			$this->BookValue->LinkCustomAttributes = "";
			$this->BookValue->HrefValue = "";
			$this->BookValue->TooltipValue = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->LinkCustomAttributes = "";
			$this->LastDepreciationDate->HrefValue = "";
			$this->LastDepreciationDate->TooltipValue = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->LinkCustomAttributes = "";
			$this->LastDepreciationAmount->HrefValue = "";
			$this->LastDepreciationAmount->TooltipValue = "";

			// DepreciationRate
			$this->DepreciationRate->LinkCustomAttributes = "";
			$this->DepreciationRate->HrefValue = "";
			$this->DepreciationRate->TooltipValue = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->LinkCustomAttributes = "";
			$this->CumulativeDepreciation->HrefValue = "";
			$this->CumulativeDepreciation->TooltipValue = "";

			// AssetStatus
			$this->AssetStatus->LinkCustomAttributes = "";
			$this->AssetStatus->HrefValue = "";
			$this->AssetStatus->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProvinceCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ProvinceCode->AdvancedSearch->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			else
				$this->ProvinceCode->AdvancedSearch->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProvinceCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProvinceCode->EditValue = $arwrk;
			}

			// ProvinceName
			$this->ProvinceName->EditAttrs["class"] = "form-control";
			$this->ProvinceName->EditCustomAttributes = "";
			if (!$this->ProvinceName->Raw)
				$this->ProvinceName->AdvancedSearch->SearchValue = HtmlDecode($this->ProvinceName->AdvancedSearch->SearchValue);
			$this->ProvinceName->EditValue = HtmlEncode($this->ProvinceName->AdvancedSearch->SearchValue);
			$this->ProvinceName->PlaceHolder = RemoveHtml($this->ProvinceName->caption());

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->AdvancedSearch->SearchValue = HtmlDecode($this->LAName->AdvancedSearch->SearchValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->AdvancedSearch->SearchValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";

			// AssetTypeName
			$this->AssetTypeName->EditAttrs["class"] = "form-control";
			$this->AssetTypeName->EditCustomAttributes = "";
			if (!$this->AssetTypeName->Raw)
				$this->AssetTypeName->AdvancedSearch->SearchValue = HtmlDecode($this->AssetTypeName->AdvancedSearch->SearchValue);
			$this->AssetTypeName->EditValue = HtmlEncode($this->AssetTypeName->AdvancedSearch->SearchValue);
			$this->AssetTypeName->PlaceHolder = RemoveHtml($this->AssetTypeName->caption());

			// Supplier
			$this->Supplier->EditAttrs["class"] = "form-control";
			$this->Supplier->EditCustomAttributes = "";
			if (!$this->Supplier->Raw)
				$this->Supplier->AdvancedSearch->SearchValue = HtmlDecode($this->Supplier->AdvancedSearch->SearchValue);
			$this->Supplier->EditValue = HtmlEncode($this->Supplier->AdvancedSearch->SearchValue);
			$this->Supplier->PlaceHolder = RemoveHtml($this->Supplier->caption());

			// PurchasePrice
			$this->PurchasePrice->EditAttrs["class"] = "form-control";
			$this->PurchasePrice->EditCustomAttributes = "";
			$this->PurchasePrice->EditValue = HtmlEncode($this->PurchasePrice->AdvancedSearch->SearchValue);
			$this->PurchasePrice->PlaceHolder = RemoveHtml($this->PurchasePrice->caption());

			// CurrencyCode
			$this->CurrencyCode->EditAttrs["class"] = "form-control";
			$this->CurrencyCode->EditCustomAttributes = "";
			if (!$this->CurrencyCode->Raw)
				$this->CurrencyCode->AdvancedSearch->SearchValue = HtmlDecode($this->CurrencyCode->AdvancedSearch->SearchValue);
			$this->CurrencyCode->EditValue = HtmlEncode($this->CurrencyCode->AdvancedSearch->SearchValue);
			$this->CurrencyCode->PlaceHolder = RemoveHtml($this->CurrencyCode->caption());

			// ConditionDesc
			$this->ConditionDesc->EditAttrs["class"] = "form-control";
			$this->ConditionDesc->EditCustomAttributes = "";
			if (!$this->ConditionDesc->Raw)
				$this->ConditionDesc->AdvancedSearch->SearchValue = HtmlDecode($this->ConditionDesc->AdvancedSearch->SearchValue);
			$this->ConditionDesc->EditValue = HtmlEncode($this->ConditionDesc->AdvancedSearch->SearchValue);
			$this->ConditionDesc->PlaceHolder = RemoveHtml($this->ConditionDesc->caption());

			// DateOfPurchase
			$this->DateOfPurchase->EditAttrs["class"] = "form-control";
			$this->DateOfPurchase->EditCustomAttributes = "";
			$this->DateOfPurchase->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfPurchase->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfPurchase->PlaceHolder = RemoveHtml($this->DateOfPurchase->caption());

			// AssetCapacity
			$this->AssetCapacity->EditAttrs["class"] = "form-control";
			$this->AssetCapacity->EditCustomAttributes = "";
			$this->AssetCapacity->EditValue = HtmlEncode($this->AssetCapacity->AdvancedSearch->SearchValue);
			$this->AssetCapacity->PlaceHolder = RemoveHtml($this->AssetCapacity->caption());

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			if (!$this->UnitOfMeasure->Raw)
				$this->UnitOfMeasure->AdvancedSearch->SearchValue = HtmlDecode($this->UnitOfMeasure->AdvancedSearch->SearchValue);
			$this->UnitOfMeasure->EditValue = HtmlEncode($this->UnitOfMeasure->AdvancedSearch->SearchValue);
			$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

			// AssetDescription
			$this->AssetDescription->EditAttrs["class"] = "form-control";
			$this->AssetDescription->EditCustomAttributes = "";
			if (!$this->AssetDescription->Raw)
				$this->AssetDescription->AdvancedSearch->SearchValue = HtmlDecode($this->AssetDescription->AdvancedSearch->SearchValue);
			$this->AssetDescription->EditValue = HtmlEncode($this->AssetDescription->AdvancedSearch->SearchValue);
			$this->AssetDescription->PlaceHolder = RemoveHtml($this->AssetDescription->caption());

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->EditAttrs["class"] = "form-control";
			$this->DateOfLastRevaluation->EditCustomAttributes = "";
			$this->DateOfLastRevaluation->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfLastRevaluation->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfLastRevaluation->PlaceHolder = RemoveHtml($this->DateOfLastRevaluation->caption());

			// NewValue
			$this->NewValue->EditAttrs["class"] = "form-control";
			$this->NewValue->EditCustomAttributes = "";
			$this->NewValue->EditValue = HtmlEncode($this->NewValue->AdvancedSearch->SearchValue);
			$this->NewValue->PlaceHolder = RemoveHtml($this->NewValue->caption());

			// NameOfValuer
			$this->NameOfValuer->EditAttrs["class"] = "form-control";
			$this->NameOfValuer->EditCustomAttributes = "";
			if (!$this->NameOfValuer->Raw)
				$this->NameOfValuer->AdvancedSearch->SearchValue = HtmlDecode($this->NameOfValuer->AdvancedSearch->SearchValue);
			$this->NameOfValuer->EditValue = HtmlEncode($this->NameOfValuer->AdvancedSearch->SearchValue);
			$this->NameOfValuer->PlaceHolder = RemoveHtml($this->NameOfValuer->caption());

			// BookValue
			$this->BookValue->EditAttrs["class"] = "form-control";
			$this->BookValue->EditCustomAttributes = "";
			$this->BookValue->EditValue = HtmlEncode($this->BookValue->AdvancedSearch->SearchValue);
			$this->BookValue->PlaceHolder = RemoveHtml($this->BookValue->caption());

			// LastDepreciationDate
			$this->LastDepreciationDate->EditAttrs["class"] = "form-control";
			$this->LastDepreciationDate->EditCustomAttributes = "";
			$this->LastDepreciationDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->LastDepreciationDate->AdvancedSearch->SearchValue, 0), 8));
			$this->LastDepreciationDate->PlaceHolder = RemoveHtml($this->LastDepreciationDate->caption());

			// LastDepreciationAmount
			$this->LastDepreciationAmount->EditAttrs["class"] = "form-control";
			$this->LastDepreciationAmount->EditCustomAttributes = "";
			$this->LastDepreciationAmount->EditValue = HtmlEncode($this->LastDepreciationAmount->AdvancedSearch->SearchValue);
			$this->LastDepreciationAmount->PlaceHolder = RemoveHtml($this->LastDepreciationAmount->caption());

			// DepreciationRate
			$this->DepreciationRate->EditAttrs["class"] = "form-control";
			$this->DepreciationRate->EditCustomAttributes = "";
			$this->DepreciationRate->EditValue = HtmlEncode($this->DepreciationRate->AdvancedSearch->SearchValue);
			$this->DepreciationRate->PlaceHolder = RemoveHtml($this->DepreciationRate->caption());

			// CumulativeDepreciation
			$this->CumulativeDepreciation->EditAttrs["class"] = "form-control";
			$this->CumulativeDepreciation->EditCustomAttributes = "";
			$this->CumulativeDepreciation->EditValue = HtmlEncode($this->CumulativeDepreciation->AdvancedSearch->SearchValue);
			$this->CumulativeDepreciation->PlaceHolder = RemoveHtml($this->CumulativeDepreciation->caption());

			// AssetStatus
			$this->AssetStatus->EditAttrs["class"] = "form-control";
			$this->AssetStatus->EditCustomAttributes = "";
			if (!$this->AssetStatus->Raw)
				$this->AssetStatus->AdvancedSearch->SearchValue = HtmlDecode($this->AssetStatus->AdvancedSearch->SearchValue);
			$this->AssetStatus->EditValue = HtmlEncode($this->AssetStatus->AdvancedSearch->SearchValue);
			$this->AssetStatus->PlaceHolder = RemoveHtml($this->AssetStatus->caption());
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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->ProvinceCode->AdvancedSearch->load();
		$this->ProvinceName->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->LAName->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->AssetTypeCode->AdvancedSearch->load();
		$this->AssetTypeName->AdvancedSearch->load();
		$this->Supplier->AdvancedSearch->load();
		$this->PurchasePrice->AdvancedSearch->load();
		$this->CurrencyCode->AdvancedSearch->load();
		$this->ConditionDesc->AdvancedSearch->load();
		$this->DateOfPurchase->AdvancedSearch->load();
		$this->AssetCapacity->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AssetDescription->AdvancedSearch->load();
		$this->DateOfLastRevaluation->AdvancedSearch->load();
		$this->NewValue->AdvancedSearch->load();
		$this->NameOfValuer->AdvancedSearch->load();
		$this->BookValue->AdvancedSearch->load();
		$this->LastDepreciationDate->AdvancedSearch->load();
		$this->LastDepreciationAmount->AdvancedSearch->load();
		$this->DepreciationRate->AdvancedSearch->load();
		$this->CumulativeDepreciation->AdvancedSearch->load();
		$this->AssetStatus->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.f_asset_viewlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.f_asset_viewlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.f_asset_viewlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf__asset_view" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf__asset_view\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.f_asset_viewlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"f_asset_viewlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
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
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
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