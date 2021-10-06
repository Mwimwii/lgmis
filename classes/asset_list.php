<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class asset_list extends asset
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'asset';

	// Page object name
	public $PageObjName = "asset_list";

	// Grid form hidden field names
	public $FormName = "fassetlist";
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

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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

		// Table object (asset)
		if (!isset($GLOBALS["asset"]) || get_class($GLOBALS["asset"]) == PROJECT_NAMESPACE . "asset") {
			$GLOBALS["asset"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["asset"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "assetadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "assetdelete.php";
		$this->MultiUpdateUrl = "assetupdate.php";

		// Table object (local_authority)
		if (!isset($GLOBALS['local_authority']))
			$GLOBALS['local_authority'] = new local_authority();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'asset');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fassetlistsrch";

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
		global $asset;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($asset);
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
			$key .= @$ar['AssetCode'];
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
		$this->AssetCode->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->AssetTypeCode->setVisibility();
		$this->Supplier->setVisibility();
		$this->PurchasePrice->setVisibility();
		$this->CurrencyCode->setVisibility();
		$this->ConditionCode->setVisibility();
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
		$this->LastUserID->Visible = FALSE;
		$this->LastUpdated->Visible = FALSE;
		$this->ScrapValue->setVisibility();
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
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->AssetTypeCode);
		$this->setupLookupOptions($this->CurrencyCode);
		$this->setupLookupOptions($this->ConditionCode);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->AssetStatus);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "local_authority") {
			global $local_authority;
			$rsmaster = $local_authority->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("local_authoritylist.php"); // Return to master page
			} else {
				$local_authority->loadListRowValues($rsmaster);
				$local_authority->RowType = ROWTYPE_MASTER; // Master row
				$local_authority->renderListRow();
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

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
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
		$this->PurchasePrice->FormValue = ""; // Clear form value
		$this->AssetCapacity->FormValue = ""; // Clear form value
		$this->NewValue->FormValue = ""; // Clear form value
		$this->BookValue->FormValue = ""; // Clear form value
		$this->LastDepreciationAmount->FormValue = ""; // Clear form value
		$this->DepreciationRate->FormValue = ""; // Clear form value
		$this->CumulativeDepreciation->FormValue = ""; // Clear form value
		$this->ScrapValue->FormValue = ""; // Clear form value
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
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
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
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
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
			$this->AssetCode->setOldValue($arKeyFlds[0]);
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
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
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
					$key .= $this->AssetCode->CurrentValue;

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
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_AssetCode") && $CurrentForm->hasValue("o_AssetCode") && $this->AssetCode->CurrentValue != $this->AssetCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ProvinceCode") && $CurrentForm->hasValue("o_ProvinceCode") && $this->ProvinceCode->CurrentValue != $this->ProvinceCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LACode") && $CurrentForm->hasValue("o_LACode") && $this->LACode->CurrentValue != $this->LACode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepartmentCode") && $CurrentForm->hasValue("o_DepartmentCode") && $this->DepartmentCode->CurrentValue != $this->DepartmentCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_SectionCode") && $CurrentForm->hasValue("o_SectionCode") && $this->SectionCode->CurrentValue != $this->SectionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AssetTypeCode") && $CurrentForm->hasValue("o_AssetTypeCode") && $this->AssetTypeCode->CurrentValue != $this->AssetTypeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Supplier") && $CurrentForm->hasValue("o_Supplier") && $this->Supplier->CurrentValue != $this->Supplier->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PurchasePrice") && $CurrentForm->hasValue("o_PurchasePrice") && $this->PurchasePrice->CurrentValue != $this->PurchasePrice->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CurrencyCode") && $CurrentForm->hasValue("o_CurrencyCode") && $this->CurrencyCode->CurrentValue != $this->CurrencyCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ConditionCode") && $CurrentForm->hasValue("o_ConditionCode") && $this->ConditionCode->CurrentValue != $this->ConditionCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfPurchase") && $CurrentForm->hasValue("o_DateOfPurchase") && $this->DateOfPurchase->CurrentValue != $this->DateOfPurchase->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AssetCapacity") && $CurrentForm->hasValue("o_AssetCapacity") && $this->AssetCapacity->CurrentValue != $this->AssetCapacity->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitOfMeasure") && $CurrentForm->hasValue("o_UnitOfMeasure") && $this->UnitOfMeasure->CurrentValue != $this->UnitOfMeasure->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AssetDescription") && $CurrentForm->hasValue("o_AssetDescription") && $this->AssetDescription->CurrentValue != $this->AssetDescription->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DateOfLastRevaluation") && $CurrentForm->hasValue("o_DateOfLastRevaluation") && $this->DateOfLastRevaluation->CurrentValue != $this->DateOfLastRevaluation->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NewValue") && $CurrentForm->hasValue("o_NewValue") && $this->NewValue->CurrentValue != $this->NewValue->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_NameOfValuer") && $CurrentForm->hasValue("o_NameOfValuer") && $this->NameOfValuer->CurrentValue != $this->NameOfValuer->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BookValue") && $CurrentForm->hasValue("o_BookValue") && $this->BookValue->CurrentValue != $this->BookValue->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LastDepreciationDate") && $CurrentForm->hasValue("o_LastDepreciationDate") && $this->LastDepreciationDate->CurrentValue != $this->LastDepreciationDate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_LastDepreciationAmount") && $CurrentForm->hasValue("o_LastDepreciationAmount") && $this->LastDepreciationAmount->CurrentValue != $this->LastDepreciationAmount->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DepreciationRate") && $CurrentForm->hasValue("o_DepreciationRate") && $this->DepreciationRate->CurrentValue != $this->DepreciationRate->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CumulativeDepreciation") && $CurrentForm->hasValue("o_CumulativeDepreciation") && $this->CumulativeDepreciation->CurrentValue != $this->CumulativeDepreciation->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AssetStatus") && $CurrentForm->hasValue("o_AssetStatus") && $this->AssetStatus->CurrentValue != $this->AssetStatus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ScrapValue") && $CurrentForm->hasValue("o_ScrapValue") && $this->ScrapValue->CurrentValue != $this->ScrapValue->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fassetlistsrch");
		$filterList = Concat($filterList, $this->AssetCode->AdvancedSearch->toJson(), ","); // Field AssetCode
		$filterList = Concat($filterList, $this->ProvinceCode->AdvancedSearch->toJson(), ","); // Field ProvinceCode
		$filterList = Concat($filterList, $this->LACode->AdvancedSearch->toJson(), ","); // Field LACode
		$filterList = Concat($filterList, $this->DepartmentCode->AdvancedSearch->toJson(), ","); // Field DepartmentCode
		$filterList = Concat($filterList, $this->SectionCode->AdvancedSearch->toJson(), ","); // Field SectionCode
		$filterList = Concat($filterList, $this->AssetTypeCode->AdvancedSearch->toJson(), ","); // Field AssetTypeCode
		$filterList = Concat($filterList, $this->Supplier->AdvancedSearch->toJson(), ","); // Field Supplier
		$filterList = Concat($filterList, $this->PurchasePrice->AdvancedSearch->toJson(), ","); // Field PurchasePrice
		$filterList = Concat($filterList, $this->CurrencyCode->AdvancedSearch->toJson(), ","); // Field CurrencyCode
		$filterList = Concat($filterList, $this->ConditionCode->AdvancedSearch->toJson(), ","); // Field ConditionCode
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
		$filterList = Concat($filterList, $this->ScrapValue->AdvancedSearch->toJson(), ","); // Field ScrapValue
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fassetlistsrch", $filters);
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

		// Field AssetCode
		$this->AssetCode->AdvancedSearch->SearchValue = @$filter["x_AssetCode"];
		$this->AssetCode->AdvancedSearch->SearchOperator = @$filter["z_AssetCode"];
		$this->AssetCode->AdvancedSearch->SearchCondition = @$filter["v_AssetCode"];
		$this->AssetCode->AdvancedSearch->SearchValue2 = @$filter["y_AssetCode"];
		$this->AssetCode->AdvancedSearch->SearchOperator2 = @$filter["w_AssetCode"];
		$this->AssetCode->AdvancedSearch->save();

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

		// Field SectionCode
		$this->SectionCode->AdvancedSearch->SearchValue = @$filter["x_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchOperator = @$filter["z_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchCondition = @$filter["v_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchValue2 = @$filter["y_SectionCode"];
		$this->SectionCode->AdvancedSearch->SearchOperator2 = @$filter["w_SectionCode"];
		$this->SectionCode->AdvancedSearch->save();

		// Field AssetTypeCode
		$this->AssetTypeCode->AdvancedSearch->SearchValue = @$filter["x_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchOperator = @$filter["z_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchCondition = @$filter["v_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchValue2 = @$filter["y_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->SearchOperator2 = @$filter["w_AssetTypeCode"];
		$this->AssetTypeCode->AdvancedSearch->save();

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

		// Field ConditionCode
		$this->ConditionCode->AdvancedSearch->SearchValue = @$filter["x_ConditionCode"];
		$this->ConditionCode->AdvancedSearch->SearchOperator = @$filter["z_ConditionCode"];
		$this->ConditionCode->AdvancedSearch->SearchCondition = @$filter["v_ConditionCode"];
		$this->ConditionCode->AdvancedSearch->SearchValue2 = @$filter["y_ConditionCode"];
		$this->ConditionCode->AdvancedSearch->SearchOperator2 = @$filter["w_ConditionCode"];
		$this->ConditionCode->AdvancedSearch->save();

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

		// Field ScrapValue
		$this->ScrapValue->AdvancedSearch->SearchValue = @$filter["x_ScrapValue"];
		$this->ScrapValue->AdvancedSearch->SearchOperator = @$filter["z_ScrapValue"];
		$this->ScrapValue->AdvancedSearch->SearchCondition = @$filter["v_ScrapValue"];
		$this->ScrapValue->AdvancedSearch->SearchValue2 = @$filter["y_ScrapValue"];
		$this->ScrapValue->AdvancedSearch->SearchOperator2 = @$filter["w_ScrapValue"];
		$this->ScrapValue->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->AssetCode, $default, FALSE); // AssetCode
		$this->buildSearchSql($where, $this->ProvinceCode, $default, FALSE); // ProvinceCode
		$this->buildSearchSql($where, $this->LACode, $default, FALSE); // LACode
		$this->buildSearchSql($where, $this->DepartmentCode, $default, FALSE); // DepartmentCode
		$this->buildSearchSql($where, $this->SectionCode, $default, FALSE); // SectionCode
		$this->buildSearchSql($where, $this->AssetTypeCode, $default, FALSE); // AssetTypeCode
		$this->buildSearchSql($where, $this->Supplier, $default, FALSE); // Supplier
		$this->buildSearchSql($where, $this->PurchasePrice, $default, FALSE); // PurchasePrice
		$this->buildSearchSql($where, $this->CurrencyCode, $default, FALSE); // CurrencyCode
		$this->buildSearchSql($where, $this->ConditionCode, $default, FALSE); // ConditionCode
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
		$this->buildSearchSql($where, $this->ScrapValue, $default, FALSE); // ScrapValue

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->AssetCode->AdvancedSearch->save(); // AssetCode
			$this->ProvinceCode->AdvancedSearch->save(); // ProvinceCode
			$this->LACode->AdvancedSearch->save(); // LACode
			$this->DepartmentCode->AdvancedSearch->save(); // DepartmentCode
			$this->SectionCode->AdvancedSearch->save(); // SectionCode
			$this->AssetTypeCode->AdvancedSearch->save(); // AssetTypeCode
			$this->Supplier->AdvancedSearch->save(); // Supplier
			$this->PurchasePrice->AdvancedSearch->save(); // PurchasePrice
			$this->CurrencyCode->AdvancedSearch->save(); // CurrencyCode
			$this->ConditionCode->AdvancedSearch->save(); // ConditionCode
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
			$this->ScrapValue->AdvancedSearch->save(); // ScrapValue
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
		$this->buildBasicSearchSql($where, $this->AssetCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LACode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Supplier, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->CurrencyCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->UnitOfMeasure, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AssetDescription, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->NameOfValuer, $arKeywords, $type);
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
		if ($this->AssetCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ProvinceCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LACode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->DepartmentCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->SectionCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AssetTypeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Supplier->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PurchasePrice->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CurrencyCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ConditionCode->AdvancedSearch->issetSession())
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
		if ($this->ScrapValue->AdvancedSearch->issetSession())
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
		$this->AssetCode->AdvancedSearch->unsetSession();
		$this->ProvinceCode->AdvancedSearch->unsetSession();
		$this->LACode->AdvancedSearch->unsetSession();
		$this->DepartmentCode->AdvancedSearch->unsetSession();
		$this->SectionCode->AdvancedSearch->unsetSession();
		$this->AssetTypeCode->AdvancedSearch->unsetSession();
		$this->Supplier->AdvancedSearch->unsetSession();
		$this->PurchasePrice->AdvancedSearch->unsetSession();
		$this->CurrencyCode->AdvancedSearch->unsetSession();
		$this->ConditionCode->AdvancedSearch->unsetSession();
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
		$this->ScrapValue->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->AssetCode->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->AssetTypeCode->AdvancedSearch->load();
		$this->Supplier->AdvancedSearch->load();
		$this->PurchasePrice->AdvancedSearch->load();
		$this->CurrencyCode->AdvancedSearch->load();
		$this->ConditionCode->AdvancedSearch->load();
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
		$this->ScrapValue->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->AssetCode); // AssetCode
			$this->updateSort($this->ProvinceCode); // ProvinceCode
			$this->updateSort($this->LACode); // LACode
			$this->updateSort($this->DepartmentCode); // DepartmentCode
			$this->updateSort($this->SectionCode); // SectionCode
			$this->updateSort($this->AssetTypeCode); // AssetTypeCode
			$this->updateSort($this->Supplier); // Supplier
			$this->updateSort($this->PurchasePrice); // PurchasePrice
			$this->updateSort($this->CurrencyCode); // CurrencyCode
			$this->updateSort($this->ConditionCode); // ConditionCode
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
			$this->updateSort($this->ScrapValue); // ScrapValue
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
				$this->ProvinceCode->setSessionValue("");
				$this->LACode->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->AssetCode->setSort("");
				$this->ProvinceCode->setSort("");
				$this->LACode->setSort("");
				$this->DepartmentCode->setSort("");
				$this->SectionCode->setSort("");
				$this->AssetTypeCode->setSort("");
				$this->Supplier->setSort("");
				$this->PurchasePrice->setSort("");
				$this->CurrencyCode->setSort("");
				$this->ConditionCode->setSort("");
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
				$this->ScrapValue->setSort("");
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->AssetCode->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->AssetCode->CurrentValue . "\">";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fassetlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fassetlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fassetlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->AssetCode->CurrentValue = NULL;
		$this->AssetCode->OldValue = $this->AssetCode->CurrentValue;
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->DepartmentCode->CurrentValue = NULL;
		$this->DepartmentCode->OldValue = $this->DepartmentCode->CurrentValue;
		$this->SectionCode->CurrentValue = NULL;
		$this->SectionCode->OldValue = $this->SectionCode->CurrentValue;
		$this->AssetTypeCode->CurrentValue = NULL;
		$this->AssetTypeCode->OldValue = $this->AssetTypeCode->CurrentValue;
		$this->Supplier->CurrentValue = NULL;
		$this->Supplier->OldValue = $this->Supplier->CurrentValue;
		$this->PurchasePrice->CurrentValue = NULL;
		$this->PurchasePrice->OldValue = $this->PurchasePrice->CurrentValue;
		$this->CurrencyCode->CurrentValue = "ZMW";
		$this->CurrencyCode->OldValue = $this->CurrencyCode->CurrentValue;
		$this->ConditionCode->CurrentValue = NULL;
		$this->ConditionCode->OldValue = $this->ConditionCode->CurrentValue;
		$this->DateOfPurchase->CurrentValue = NULL;
		$this->DateOfPurchase->OldValue = $this->DateOfPurchase->CurrentValue;
		$this->AssetCapacity->CurrentValue = NULL;
		$this->AssetCapacity->OldValue = $this->AssetCapacity->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = NULL;
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->AssetDescription->CurrentValue = NULL;
		$this->AssetDescription->OldValue = $this->AssetDescription->CurrentValue;
		$this->DateOfLastRevaluation->CurrentValue = NULL;
		$this->DateOfLastRevaluation->OldValue = $this->DateOfLastRevaluation->CurrentValue;
		$this->NewValue->CurrentValue = NULL;
		$this->NewValue->OldValue = $this->NewValue->CurrentValue;
		$this->NameOfValuer->CurrentValue = NULL;
		$this->NameOfValuer->OldValue = $this->NameOfValuer->CurrentValue;
		$this->BookValue->CurrentValue = NULL;
		$this->BookValue->OldValue = $this->BookValue->CurrentValue;
		$this->LastDepreciationDate->CurrentValue = NULL;
		$this->LastDepreciationDate->OldValue = $this->LastDepreciationDate->CurrentValue;
		$this->LastDepreciationAmount->CurrentValue = NULL;
		$this->LastDepreciationAmount->OldValue = $this->LastDepreciationAmount->CurrentValue;
		$this->DepreciationRate->CurrentValue = NULL;
		$this->DepreciationRate->OldValue = $this->DepreciationRate->CurrentValue;
		$this->CumulativeDepreciation->CurrentValue = NULL;
		$this->CumulativeDepreciation->OldValue = $this->CumulativeDepreciation->CurrentValue;
		$this->AssetStatus->CurrentValue = NULL;
		$this->AssetStatus->OldValue = $this->AssetStatus->CurrentValue;
		$this->LastUserID->CurrentValue = NULL;
		$this->LastUserID->OldValue = $this->LastUserID->CurrentValue;
		$this->LastUpdated->CurrentValue = NULL;
		$this->LastUpdated->OldValue = $this->LastUpdated->CurrentValue;
		$this->ScrapValue->CurrentValue = NULL;
		$this->ScrapValue->OldValue = $this->ScrapValue->CurrentValue;
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

		// AssetCode
		if (!$this->isAddOrEdit() && $this->AssetCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetCode->AdvancedSearch->SearchValue != "" || $this->AssetCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// SectionCode
		if (!$this->isAddOrEdit() && $this->SectionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->SectionCode->AdvancedSearch->SearchValue != "" || $this->SectionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AssetTypeCode
		if (!$this->isAddOrEdit() && $this->AssetTypeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AssetTypeCode->AdvancedSearch->SearchValue != "" || $this->AssetTypeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// ConditionCode
		if (!$this->isAddOrEdit() && $this->ConditionCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ConditionCode->AdvancedSearch->SearchValue != "" || $this->ConditionCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// ScrapValue
		if (!$this->isAddOrEdit() && $this->ScrapValue->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ScrapValue->AdvancedSearch->SearchValue != "" || $this->ScrapValue->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'AssetCode' first before field var 'x_AssetCode'
		$val = $CurrentForm->hasValue("AssetCode") ? $CurrentForm->getValue("AssetCode") : $CurrentForm->getValue("x_AssetCode");
		if (!$this->AssetCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetCode->Visible = FALSE; // Disable update for API request
			else
				$this->AssetCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AssetCode"))
			$this->AssetCode->setOldValue($CurrentForm->getValue("o_AssetCode"));

		// Check field name 'ProvinceCode' first before field var 'x_ProvinceCode'
		$val = $CurrentForm->hasValue("ProvinceCode") ? $CurrentForm->getValue("ProvinceCode") : $CurrentForm->getValue("x_ProvinceCode");
		if (!$this->ProvinceCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProvinceCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProvinceCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ProvinceCode"))
			$this->ProvinceCode->setOldValue($CurrentForm->getValue("o_ProvinceCode"));

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

		// Check field name 'AssetTypeCode' first before field var 'x_AssetTypeCode'
		$val = $CurrentForm->hasValue("AssetTypeCode") ? $CurrentForm->getValue("AssetTypeCode") : $CurrentForm->getValue("x_AssetTypeCode");
		if (!$this->AssetTypeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetTypeCode->Visible = FALSE; // Disable update for API request
			else
				$this->AssetTypeCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AssetTypeCode"))
			$this->AssetTypeCode->setOldValue($CurrentForm->getValue("o_AssetTypeCode"));

		// Check field name 'Supplier' first before field var 'x_Supplier'
		$val = $CurrentForm->hasValue("Supplier") ? $CurrentForm->getValue("Supplier") : $CurrentForm->getValue("x_Supplier");
		if (!$this->Supplier->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Supplier->Visible = FALSE; // Disable update for API request
			else
				$this->Supplier->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Supplier"))
			$this->Supplier->setOldValue($CurrentForm->getValue("o_Supplier"));

		// Check field name 'PurchasePrice' first before field var 'x_PurchasePrice'
		$val = $CurrentForm->hasValue("PurchasePrice") ? $CurrentForm->getValue("PurchasePrice") : $CurrentForm->getValue("x_PurchasePrice");
		if (!$this->PurchasePrice->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PurchasePrice->Visible = FALSE; // Disable update for API request
			else
				$this->PurchasePrice->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PurchasePrice"))
			$this->PurchasePrice->setOldValue($CurrentForm->getValue("o_PurchasePrice"));

		// Check field name 'CurrencyCode' first before field var 'x_CurrencyCode'
		$val = $CurrentForm->hasValue("CurrencyCode") ? $CurrentForm->getValue("CurrencyCode") : $CurrentForm->getValue("x_CurrencyCode");
		if (!$this->CurrencyCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrencyCode->Visible = FALSE; // Disable update for API request
			else
				$this->CurrencyCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CurrencyCode"))
			$this->CurrencyCode->setOldValue($CurrentForm->getValue("o_CurrencyCode"));

		// Check field name 'ConditionCode' first before field var 'x_ConditionCode'
		$val = $CurrentForm->hasValue("ConditionCode") ? $CurrentForm->getValue("ConditionCode") : $CurrentForm->getValue("x_ConditionCode");
		if (!$this->ConditionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ConditionCode->Visible = FALSE; // Disable update for API request
			else
				$this->ConditionCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ConditionCode"))
			$this->ConditionCode->setOldValue($CurrentForm->getValue("o_ConditionCode"));

		// Check field name 'DateOfPurchase' first before field var 'x_DateOfPurchase'
		$val = $CurrentForm->hasValue("DateOfPurchase") ? $CurrentForm->getValue("DateOfPurchase") : $CurrentForm->getValue("x_DateOfPurchase");
		if (!$this->DateOfPurchase->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfPurchase->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfPurchase->setFormValue($val);
			$this->DateOfPurchase->CurrentValue = UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfPurchase"))
			$this->DateOfPurchase->setOldValue($CurrentForm->getValue("o_DateOfPurchase"));

		// Check field name 'AssetCapacity' first before field var 'x_AssetCapacity'
		$val = $CurrentForm->hasValue("AssetCapacity") ? $CurrentForm->getValue("AssetCapacity") : $CurrentForm->getValue("x_AssetCapacity");
		if (!$this->AssetCapacity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetCapacity->Visible = FALSE; // Disable update for API request
			else
				$this->AssetCapacity->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AssetCapacity"))
			$this->AssetCapacity->setOldValue($CurrentForm->getValue("o_AssetCapacity"));

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

		// Check field name 'AssetDescription' first before field var 'x_AssetDescription'
		$val = $CurrentForm->hasValue("AssetDescription") ? $CurrentForm->getValue("AssetDescription") : $CurrentForm->getValue("x_AssetDescription");
		if (!$this->AssetDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetDescription->Visible = FALSE; // Disable update for API request
			else
				$this->AssetDescription->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AssetDescription"))
			$this->AssetDescription->setOldValue($CurrentForm->getValue("o_AssetDescription"));

		// Check field name 'DateOfLastRevaluation' first before field var 'x_DateOfLastRevaluation'
		$val = $CurrentForm->hasValue("DateOfLastRevaluation") ? $CurrentForm->getValue("DateOfLastRevaluation") : $CurrentForm->getValue("x_DateOfLastRevaluation");
		if (!$this->DateOfLastRevaluation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfLastRevaluation->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfLastRevaluation->setFormValue($val);
			$this->DateOfLastRevaluation->CurrentValue = UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DateOfLastRevaluation"))
			$this->DateOfLastRevaluation->setOldValue($CurrentForm->getValue("o_DateOfLastRevaluation"));

		// Check field name 'NewValue' first before field var 'x_NewValue'
		$val = $CurrentForm->hasValue("NewValue") ? $CurrentForm->getValue("NewValue") : $CurrentForm->getValue("x_NewValue");
		if (!$this->NewValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewValue->Visible = FALSE; // Disable update for API request
			else
				$this->NewValue->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NewValue"))
			$this->NewValue->setOldValue($CurrentForm->getValue("o_NewValue"));

		// Check field name 'NameOfValuer' first before field var 'x_NameOfValuer'
		$val = $CurrentForm->hasValue("NameOfValuer") ? $CurrentForm->getValue("NameOfValuer") : $CurrentForm->getValue("x_NameOfValuer");
		if (!$this->NameOfValuer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NameOfValuer->Visible = FALSE; // Disable update for API request
			else
				$this->NameOfValuer->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_NameOfValuer"))
			$this->NameOfValuer->setOldValue($CurrentForm->getValue("o_NameOfValuer"));

		// Check field name 'BookValue' first before field var 'x_BookValue'
		$val = $CurrentForm->hasValue("BookValue") ? $CurrentForm->getValue("BookValue") : $CurrentForm->getValue("x_BookValue");
		if (!$this->BookValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BookValue->Visible = FALSE; // Disable update for API request
			else
				$this->BookValue->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BookValue"))
			$this->BookValue->setOldValue($CurrentForm->getValue("o_BookValue"));

		// Check field name 'LastDepreciationDate' first before field var 'x_LastDepreciationDate'
		$val = $CurrentForm->hasValue("LastDepreciationDate") ? $CurrentForm->getValue("LastDepreciationDate") : $CurrentForm->getValue("x_LastDepreciationDate");
		if (!$this->LastDepreciationDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastDepreciationDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastDepreciationDate->setFormValue($val);
			$this->LastDepreciationDate->CurrentValue = UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_LastDepreciationDate"))
			$this->LastDepreciationDate->setOldValue($CurrentForm->getValue("o_LastDepreciationDate"));

		// Check field name 'LastDepreciationAmount' first before field var 'x_LastDepreciationAmount'
		$val = $CurrentForm->hasValue("LastDepreciationAmount") ? $CurrentForm->getValue("LastDepreciationAmount") : $CurrentForm->getValue("x_LastDepreciationAmount");
		if (!$this->LastDepreciationAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastDepreciationAmount->Visible = FALSE; // Disable update for API request
			else
				$this->LastDepreciationAmount->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LastDepreciationAmount"))
			$this->LastDepreciationAmount->setOldValue($CurrentForm->getValue("o_LastDepreciationAmount"));

		// Check field name 'DepreciationRate' first before field var 'x_DepreciationRate'
		$val = $CurrentForm->hasValue("DepreciationRate") ? $CurrentForm->getValue("DepreciationRate") : $CurrentForm->getValue("x_DepreciationRate");
		if (!$this->DepreciationRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepreciationRate->Visible = FALSE; // Disable update for API request
			else
				$this->DepreciationRate->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_DepreciationRate"))
			$this->DepreciationRate->setOldValue($CurrentForm->getValue("o_DepreciationRate"));

		// Check field name 'CumulativeDepreciation' first before field var 'x_CumulativeDepreciation'
		$val = $CurrentForm->hasValue("CumulativeDepreciation") ? $CurrentForm->getValue("CumulativeDepreciation") : $CurrentForm->getValue("x_CumulativeDepreciation");
		if (!$this->CumulativeDepreciation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CumulativeDepreciation->Visible = FALSE; // Disable update for API request
			else
				$this->CumulativeDepreciation->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CumulativeDepreciation"))
			$this->CumulativeDepreciation->setOldValue($CurrentForm->getValue("o_CumulativeDepreciation"));

		// Check field name 'AssetStatus' first before field var 'x_AssetStatus'
		$val = $CurrentForm->hasValue("AssetStatus") ? $CurrentForm->getValue("AssetStatus") : $CurrentForm->getValue("x_AssetStatus");
		if (!$this->AssetStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AssetStatus->Visible = FALSE; // Disable update for API request
			else
				$this->AssetStatus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AssetStatus"))
			$this->AssetStatus->setOldValue($CurrentForm->getValue("o_AssetStatus"));

		// Check field name 'ScrapValue' first before field var 'x_ScrapValue'
		$val = $CurrentForm->hasValue("ScrapValue") ? $CurrentForm->getValue("ScrapValue") : $CurrentForm->getValue("x_ScrapValue");
		if (!$this->ScrapValue->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ScrapValue->Visible = FALSE; // Disable update for API request
			else
				$this->ScrapValue->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ScrapValue"))
			$this->ScrapValue->setOldValue($CurrentForm->getValue("o_ScrapValue"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->AssetCode->CurrentValue = $this->AssetCode->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->AssetTypeCode->CurrentValue = $this->AssetTypeCode->FormValue;
		$this->Supplier->CurrentValue = $this->Supplier->FormValue;
		$this->PurchasePrice->CurrentValue = $this->PurchasePrice->FormValue;
		$this->CurrencyCode->CurrentValue = $this->CurrencyCode->FormValue;
		$this->ConditionCode->CurrentValue = $this->ConditionCode->FormValue;
		$this->DateOfPurchase->CurrentValue = $this->DateOfPurchase->FormValue;
		$this->DateOfPurchase->CurrentValue = UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0);
		$this->AssetCapacity->CurrentValue = $this->AssetCapacity->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->AssetDescription->CurrentValue = $this->AssetDescription->FormValue;
		$this->DateOfLastRevaluation->CurrentValue = $this->DateOfLastRevaluation->FormValue;
		$this->DateOfLastRevaluation->CurrentValue = UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0);
		$this->NewValue->CurrentValue = $this->NewValue->FormValue;
		$this->NameOfValuer->CurrentValue = $this->NameOfValuer->FormValue;
		$this->BookValue->CurrentValue = $this->BookValue->FormValue;
		$this->LastDepreciationDate->CurrentValue = $this->LastDepreciationDate->FormValue;
		$this->LastDepreciationDate->CurrentValue = UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0);
		$this->LastDepreciationAmount->CurrentValue = $this->LastDepreciationAmount->FormValue;
		$this->DepreciationRate->CurrentValue = $this->DepreciationRate->FormValue;
		$this->CumulativeDepreciation->CurrentValue = $this->CumulativeDepreciation->FormValue;
		$this->AssetStatus->CurrentValue = $this->AssetStatus->FormValue;
		$this->ScrapValue->CurrentValue = $this->ScrapValue->FormValue;
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
		$this->AssetCode->setDbValue($row['AssetCode']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->AssetTypeCode->setDbValue($row['AssetTypeCode']);
		$this->Supplier->setDbValue($row['Supplier']);
		$this->PurchasePrice->setDbValue($row['PurchasePrice']);
		$this->CurrencyCode->setDbValue($row['CurrencyCode']);
		$this->ConditionCode->setDbValue($row['ConditionCode']);
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
		$this->LastUserID->setDbValue($row['LastUserID']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->ScrapValue->setDbValue($row['ScrapValue']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['AssetCode'] = $this->AssetCode->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['DepartmentCode'] = $this->DepartmentCode->CurrentValue;
		$row['SectionCode'] = $this->SectionCode->CurrentValue;
		$row['AssetTypeCode'] = $this->AssetTypeCode->CurrentValue;
		$row['Supplier'] = $this->Supplier->CurrentValue;
		$row['PurchasePrice'] = $this->PurchasePrice->CurrentValue;
		$row['CurrencyCode'] = $this->CurrencyCode->CurrentValue;
		$row['ConditionCode'] = $this->ConditionCode->CurrentValue;
		$row['DateOfPurchase'] = $this->DateOfPurchase->CurrentValue;
		$row['AssetCapacity'] = $this->AssetCapacity->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['AssetDescription'] = $this->AssetDescription->CurrentValue;
		$row['DateOfLastRevaluation'] = $this->DateOfLastRevaluation->CurrentValue;
		$row['NewValue'] = $this->NewValue->CurrentValue;
		$row['NameOfValuer'] = $this->NameOfValuer->CurrentValue;
		$row['BookValue'] = $this->BookValue->CurrentValue;
		$row['LastDepreciationDate'] = $this->LastDepreciationDate->CurrentValue;
		$row['LastDepreciationAmount'] = $this->LastDepreciationAmount->CurrentValue;
		$row['DepreciationRate'] = $this->DepreciationRate->CurrentValue;
		$row['CumulativeDepreciation'] = $this->CumulativeDepreciation->CurrentValue;
		$row['AssetStatus'] = $this->AssetStatus->CurrentValue;
		$row['LastUserID'] = $this->LastUserID->CurrentValue;
		$row['LastUpdated'] = $this->LastUpdated->CurrentValue;
		$row['ScrapValue'] = $this->ScrapValue->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("AssetCode")) != "")
			$this->AssetCode->OldValue = $this->getKey("AssetCode"); // AssetCode
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

		// Convert decimal values if posted back
		if ($this->ScrapValue->FormValue == $this->ScrapValue->CurrentValue && is_numeric(ConvertToFloatString($this->ScrapValue->CurrentValue)))
			$this->ScrapValue->CurrentValue = ConvertToFloatString($this->ScrapValue->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// AssetCode
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// AssetTypeCode
		// Supplier
		// PurchasePrice
		// CurrencyCode
		// ConditionCode
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
		// LastUserID
		// LastUpdated
		// ScrapValue

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// AssetCode
			$this->AssetCode->ViewValue = $this->AssetCode->CurrentValue;
			$this->AssetCode->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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

			// AssetTypeCode
			$curVal = strval($this->AssetTypeCode->CurrentValue);
			if ($curVal != "") {
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
				if ($this->AssetTypeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AssetTypeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->CurrentValue;
					}
				}
			} else {
				$this->AssetTypeCode->ViewValue = NULL;
			}
			$this->AssetTypeCode->ViewCustomAttributes = "";

			// Supplier
			$this->Supplier->ViewValue = $this->Supplier->CurrentValue;
			$this->Supplier->ViewCustomAttributes = "";

			// PurchasePrice
			$this->PurchasePrice->ViewValue = $this->PurchasePrice->CurrentValue;
			$this->PurchasePrice->ViewValue = FormatNumber($this->PurchasePrice->ViewValue, 2, -2, -2, -2);
			$this->PurchasePrice->CellCssStyle .= "text-align: right;";
			$this->PurchasePrice->ViewCustomAttributes = "";

			// CurrencyCode
			$curVal = strval($this->CurrencyCode->CurrentValue);
			if ($curVal != "") {
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->lookupCacheOption($curVal);
				if ($this->CurrencyCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CurrencyCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->CurrencyCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CurrencyCode->ViewValue = $this->CurrencyCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CurrencyCode->ViewValue = $this->CurrencyCode->CurrentValue;
					}
				}
			} else {
				$this->CurrencyCode->ViewValue = NULL;
			}
			$this->CurrencyCode->ViewCustomAttributes = "";

			// ConditionCode
			$curVal = strval($this->ConditionCode->CurrentValue);
			if ($curVal != "") {
				$this->ConditionCode->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
				if ($this->ConditionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ConditionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ConditionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ConditionCode->ViewValue = $this->ConditionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ConditionCode->ViewValue = $this->ConditionCode->CurrentValue;
					}
				}
			} else {
				$this->ConditionCode->ViewValue = NULL;
			}
			$this->ConditionCode->ViewCustomAttributes = "";

			// DateOfPurchase
			$this->DateOfPurchase->ViewValue = $this->DateOfPurchase->CurrentValue;
			$this->DateOfPurchase->ViewValue = FormatDateTime($this->DateOfPurchase->ViewValue, 0);
			$this->DateOfPurchase->ViewCustomAttributes = "";

			// AssetCapacity
			$this->AssetCapacity->ViewValue = $this->AssetCapacity->CurrentValue;
			$this->AssetCapacity->ViewValue = FormatNumber($this->AssetCapacity->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AssetCapacity->ViewCustomAttributes = "";

			// UnitOfMeasure
			$curVal = strval($this->UnitOfMeasure->CurrentValue);
			if ($curVal != "") {
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
				if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
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
			$this->BookValue->CellCssStyle .= "text-align: right;";
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
			$this->DepreciationRate->ViewValue = FormatPercent($this->DepreciationRate->ViewValue, 2, -2, -2, -2);
			$this->DepreciationRate->CellCssStyle .= "text-align: right;";
			$this->DepreciationRate->ViewCustomAttributes = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->ViewValue = $this->CumulativeDepreciation->CurrentValue;
			$this->CumulativeDepreciation->ViewValue = FormatNumber($this->CumulativeDepreciation->ViewValue, 2, -2, -2, -2);
			$this->CumulativeDepreciation->CellCssStyle .= "text-align: right;";
			$this->CumulativeDepreciation->ViewCustomAttributes = "";

			// AssetStatus
			$curVal = strval($this->AssetStatus->CurrentValue);
			if ($curVal != "") {
				$this->AssetStatus->ViewValue = $this->AssetStatus->lookupCacheOption($curVal);
				if ($this->AssetStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AssetStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AssetStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AssetStatus->ViewValue = $this->AssetStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AssetStatus->ViewValue = $this->AssetStatus->CurrentValue;
					}
				}
			} else {
				$this->AssetStatus->ViewValue = NULL;
			}
			$this->AssetStatus->ViewCustomAttributes = "";

			// ScrapValue
			$this->ScrapValue->ViewValue = $this->ScrapValue->CurrentValue;
			$this->ScrapValue->ViewValue = FormatNumber($this->ScrapValue->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->ScrapValue->ViewCustomAttributes = "";

			// AssetCode
			$this->AssetCode->LinkCustomAttributes = "";
			$this->AssetCode->HrefValue = "";
			$this->AssetCode->TooltipValue = "";
			if (!$this->isExport())
				$this->AssetCode->ViewValue = $this->highlightValue($this->AssetCode);

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";
			if (!$this->isExport())
				$this->ProvinceCode->ViewValue = $this->highlightValue($this->ProvinceCode);

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// AssetTypeCode
			$this->AssetTypeCode->LinkCustomAttributes = "";
			$this->AssetTypeCode->HrefValue = "";
			$this->AssetTypeCode->TooltipValue = "";

			// Supplier
			$this->Supplier->LinkCustomAttributes = "";
			$this->Supplier->HrefValue = "";
			$this->Supplier->TooltipValue = "";
			if (!$this->isExport())
				$this->Supplier->ViewValue = $this->highlightValue($this->Supplier);

			// PurchasePrice
			$this->PurchasePrice->LinkCustomAttributes = "";
			$this->PurchasePrice->HrefValue = "";
			$this->PurchasePrice->TooltipValue = "";

			// CurrencyCode
			$this->CurrencyCode->LinkCustomAttributes = "";
			$this->CurrencyCode->HrefValue = "";
			$this->CurrencyCode->TooltipValue = "";

			// ConditionCode
			$this->ConditionCode->LinkCustomAttributes = "";
			$this->ConditionCode->HrefValue = "";
			$this->ConditionCode->TooltipValue = "";

			// DateOfPurchase
			$this->DateOfPurchase->LinkCustomAttributes = "";
			$this->DateOfPurchase->HrefValue = "";
			$this->DateOfPurchase->TooltipValue = "";

			// AssetCapacity
			$this->AssetCapacity->LinkCustomAttributes = "";
			$this->AssetCapacity->HrefValue = "";
			$this->AssetCapacity->TooltipValue = "";
			if (!$this->isExport())
				$this->AssetCapacity->ViewValue = $this->highlightValue($this->AssetCapacity);

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// AssetDescription
			$this->AssetDescription->LinkCustomAttributes = "";
			$this->AssetDescription->HrefValue = "";
			$this->AssetDescription->TooltipValue = "";
			if (!$this->isExport())
				$this->AssetDescription->ViewValue = $this->highlightValue($this->AssetDescription);

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
			if (!$this->isExport())
				$this->NameOfValuer->ViewValue = $this->highlightValue($this->NameOfValuer);

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

			// ScrapValue
			$this->ScrapValue->LinkCustomAttributes = "";
			$this->ScrapValue->HrefValue = "";
			$this->ScrapValue->TooltipValue = "";
			if (!$this->isExport())
				$this->ScrapValue->ViewValue = $this->highlightValue($this->ScrapValue);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// AssetCode
			$this->AssetCode->EditAttrs["class"] = "form-control";
			$this->AssetCode->EditCustomAttributes = "";
			if (!$this->AssetCode->Raw)
				$this->AssetCode->CurrentValue = HtmlDecode($this->AssetCode->CurrentValue);
			$this->AssetCode->EditValue = HtmlEncode($this->AssetCode->CurrentValue);
			$this->AssetCode->PlaceHolder = RemoveHtml($this->AssetCode->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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
			} else {
				$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
				$curVal = strval($this->ProvinceCode->CurrentValue);
				if ($curVal != "") {
					$this->ProvinceCode->EditValue = $this->ProvinceCode->lookupCacheOption($curVal);
					if ($this->ProvinceCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->ProvinceCode->EditValue = $this->ProvinceCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
						}
					}
				} else {
					$this->ProvinceCode->EditValue = NULL;
				}
				$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());
			}

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->OldValue = $this->LACode->CurrentValue;
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
				$curVal = trim(strval($this->LACode->CurrentValue));
				if ($curVal != "")
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				else
					$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
				if ($this->LACode->ViewValue !== NULL) { // Load from cache
					$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
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

			// AssetTypeCode
			$this->AssetTypeCode->EditAttrs["class"] = "form-control";
			$this->AssetTypeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetTypeCode->CurrentValue));
			if ($curVal != "")
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
			else
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->Lookup !== NULL && is_array($this->AssetTypeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetTypeCode->ViewValue !== NULL) { // Load from cache
				$this->AssetTypeCode->EditValue = array_values($this->AssetTypeCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $this->AssetTypeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetTypeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetTypeCode->EditValue = $arwrk;
			}

			// Supplier
			$this->Supplier->EditAttrs["class"] = "form-control";
			$this->Supplier->EditCustomAttributes = "";
			if (!$this->Supplier->Raw)
				$this->Supplier->CurrentValue = HtmlDecode($this->Supplier->CurrentValue);
			$this->Supplier->EditValue = HtmlEncode($this->Supplier->CurrentValue);
			$this->Supplier->PlaceHolder = RemoveHtml($this->Supplier->caption());

			// PurchasePrice
			$this->PurchasePrice->EditAttrs["class"] = "form-control";
			$this->PurchasePrice->EditCustomAttributes = "";
			$this->PurchasePrice->EditValue = HtmlEncode($this->PurchasePrice->CurrentValue);
			$this->PurchasePrice->PlaceHolder = RemoveHtml($this->PurchasePrice->caption());
			if (strval($this->PurchasePrice->EditValue) != "" && is_numeric($this->PurchasePrice->EditValue)) {
				$this->PurchasePrice->EditValue = FormatNumber($this->PurchasePrice->EditValue, -2, -2, -2, -2);
				$this->PurchasePrice->OldValue = $this->PurchasePrice->EditValue;
			}
			

			// CurrencyCode
			$this->CurrencyCode->EditAttrs["class"] = "form-control";
			$this->CurrencyCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->CurrencyCode->CurrentValue));
			if ($curVal != "")
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->lookupCacheOption($curVal);
			else
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->Lookup !== NULL && is_array($this->CurrencyCode->Lookup->Options) ? $curVal : NULL;
			if ($this->CurrencyCode->ViewValue !== NULL) { // Load from cache
				$this->CurrencyCode->EditValue = array_values($this->CurrencyCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CurrencyCode`" . SearchString("=", $this->CurrencyCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->CurrencyCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CurrencyCode->EditValue = $arwrk;
			}

			// ConditionCode
			$this->ConditionCode->EditAttrs["class"] = "form-control";
			$this->ConditionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ConditionCode->CurrentValue));
			if ($curVal != "")
				$this->ConditionCode->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
			else
				$this->ConditionCode->ViewValue = $this->ConditionCode->Lookup !== NULL && is_array($this->ConditionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ConditionCode->ViewValue !== NULL) { // Load from cache
				$this->ConditionCode->EditValue = array_values($this->ConditionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ConditionCode`" . SearchString("=", $this->ConditionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ConditionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ConditionCode->EditValue = $arwrk;
			}

			// DateOfPurchase
			$this->DateOfPurchase->EditAttrs["class"] = "form-control";
			$this->DateOfPurchase->EditCustomAttributes = "";
			$this->DateOfPurchase->EditValue = HtmlEncode(FormatDateTime($this->DateOfPurchase->CurrentValue, 8));
			$this->DateOfPurchase->PlaceHolder = RemoveHtml($this->DateOfPurchase->caption());

			// AssetCapacity
			$this->AssetCapacity->EditAttrs["class"] = "form-control";
			$this->AssetCapacity->EditCustomAttributes = "";
			$this->AssetCapacity->EditValue = HtmlEncode($this->AssetCapacity->CurrentValue);
			$this->AssetCapacity->PlaceHolder = RemoveHtml($this->AssetCapacity->caption());
			if (strval($this->AssetCapacity->EditValue) != "" && is_numeric($this->AssetCapacity->EditValue)) {
				$this->AssetCapacity->EditValue = FormatNumber($this->AssetCapacity->EditValue, -2, -1, -2, 0);
				$this->AssetCapacity->OldValue = $this->AssetCapacity->EditValue;
			}
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// AssetDescription
			$this->AssetDescription->EditAttrs["class"] = "form-control";
			$this->AssetDescription->EditCustomAttributes = "";
			if (!$this->AssetDescription->Raw)
				$this->AssetDescription->CurrentValue = HtmlDecode($this->AssetDescription->CurrentValue);
			$this->AssetDescription->EditValue = HtmlEncode($this->AssetDescription->CurrentValue);
			$this->AssetDescription->PlaceHolder = RemoveHtml($this->AssetDescription->caption());

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->EditAttrs["class"] = "form-control";
			$this->DateOfLastRevaluation->EditCustomAttributes = "";
			$this->DateOfLastRevaluation->EditValue = HtmlEncode(FormatDateTime($this->DateOfLastRevaluation->CurrentValue, 8));
			$this->DateOfLastRevaluation->PlaceHolder = RemoveHtml($this->DateOfLastRevaluation->caption());

			// NewValue
			$this->NewValue->EditAttrs["class"] = "form-control";
			$this->NewValue->EditCustomAttributes = "";
			$this->NewValue->EditValue = HtmlEncode($this->NewValue->CurrentValue);
			$this->NewValue->PlaceHolder = RemoveHtml($this->NewValue->caption());
			if (strval($this->NewValue->EditValue) != "" && is_numeric($this->NewValue->EditValue)) {
				$this->NewValue->EditValue = FormatNumber($this->NewValue->EditValue, -2, -2, -2, -2);
				$this->NewValue->OldValue = $this->NewValue->EditValue;
			}
			

			// NameOfValuer
			$this->NameOfValuer->EditAttrs["class"] = "form-control";
			$this->NameOfValuer->EditCustomAttributes = "";
			if (!$this->NameOfValuer->Raw)
				$this->NameOfValuer->CurrentValue = HtmlDecode($this->NameOfValuer->CurrentValue);
			$this->NameOfValuer->EditValue = HtmlEncode($this->NameOfValuer->CurrentValue);
			$this->NameOfValuer->PlaceHolder = RemoveHtml($this->NameOfValuer->caption());

			// BookValue
			$this->BookValue->EditAttrs["class"] = "form-control";
			$this->BookValue->EditCustomAttributes = "";
			$this->BookValue->EditValue = HtmlEncode($this->BookValue->CurrentValue);
			$this->BookValue->PlaceHolder = RemoveHtml($this->BookValue->caption());
			if (strval($this->BookValue->EditValue) != "" && is_numeric($this->BookValue->EditValue)) {
				$this->BookValue->EditValue = FormatNumber($this->BookValue->EditValue, -2, -2, -2, -2);
				$this->BookValue->OldValue = $this->BookValue->EditValue;
			}
			

			// LastDepreciationDate
			$this->LastDepreciationDate->EditAttrs["class"] = "form-control";
			$this->LastDepreciationDate->EditCustomAttributes = "";
			$this->LastDepreciationDate->EditValue = HtmlEncode(FormatDateTime($this->LastDepreciationDate->CurrentValue, 8));
			$this->LastDepreciationDate->PlaceHolder = RemoveHtml($this->LastDepreciationDate->caption());

			// LastDepreciationAmount
			$this->LastDepreciationAmount->EditAttrs["class"] = "form-control";
			$this->LastDepreciationAmount->EditCustomAttributes = "";
			$this->LastDepreciationAmount->EditValue = HtmlEncode($this->LastDepreciationAmount->CurrentValue);
			$this->LastDepreciationAmount->PlaceHolder = RemoveHtml($this->LastDepreciationAmount->caption());
			if (strval($this->LastDepreciationAmount->EditValue) != "" && is_numeric($this->LastDepreciationAmount->EditValue)) {
				$this->LastDepreciationAmount->EditValue = FormatNumber($this->LastDepreciationAmount->EditValue, -2, -2, -2, -2);
				$this->LastDepreciationAmount->OldValue = $this->LastDepreciationAmount->EditValue;
			}
			

			// DepreciationRate
			$this->DepreciationRate->EditAttrs["class"] = "form-control";
			$this->DepreciationRate->EditCustomAttributes = "";
			$this->DepreciationRate->EditValue = HtmlEncode($this->DepreciationRate->CurrentValue);
			$this->DepreciationRate->PlaceHolder = RemoveHtml($this->DepreciationRate->caption());
			if (strval($this->DepreciationRate->EditValue) != "" && is_numeric($this->DepreciationRate->EditValue)) {
				$this->DepreciationRate->EditValue = FormatNumber($this->DepreciationRate->EditValue, -2, -1, -2, 0);
				$this->DepreciationRate->OldValue = $this->DepreciationRate->EditValue;
			}
			

			// CumulativeDepreciation
			$this->CumulativeDepreciation->EditAttrs["class"] = "form-control";
			$this->CumulativeDepreciation->EditCustomAttributes = "";
			$this->CumulativeDepreciation->EditValue = HtmlEncode($this->CumulativeDepreciation->CurrentValue);
			$this->CumulativeDepreciation->PlaceHolder = RemoveHtml($this->CumulativeDepreciation->caption());
			if (strval($this->CumulativeDepreciation->EditValue) != "" && is_numeric($this->CumulativeDepreciation->EditValue)) {
				$this->CumulativeDepreciation->EditValue = FormatNumber($this->CumulativeDepreciation->EditValue, -2, -2, -2, -2);
				$this->CumulativeDepreciation->OldValue = $this->CumulativeDepreciation->EditValue;
			}
			

			// AssetStatus
			$this->AssetStatus->EditAttrs["class"] = "form-control";
			$this->AssetStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetStatus->CurrentValue));
			if ($curVal != "")
				$this->AssetStatus->ViewValue = $this->AssetStatus->lookupCacheOption($curVal);
			else
				$this->AssetStatus->ViewValue = $this->AssetStatus->Lookup !== NULL && is_array($this->AssetStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetStatus->ViewValue !== NULL) { // Load from cache
				$this->AssetStatus->EditValue = array_values($this->AssetStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetStatusCode`" . SearchString("=", $this->AssetStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetStatus->EditValue = $arwrk;
			}

			// ScrapValue
			$this->ScrapValue->EditAttrs["class"] = "form-control";
			$this->ScrapValue->EditCustomAttributes = "";
			$this->ScrapValue->EditValue = HtmlEncode($this->ScrapValue->CurrentValue);
			$this->ScrapValue->PlaceHolder = RemoveHtml($this->ScrapValue->caption());
			if (strval($this->ScrapValue->EditValue) != "" && is_numeric($this->ScrapValue->EditValue)) {
				$this->ScrapValue->EditValue = FormatNumber($this->ScrapValue->EditValue, -2, -1, -2, 0);
				$this->ScrapValue->OldValue = $this->ScrapValue->EditValue;
			}
			

			// Add refer script
			// AssetCode

			$this->AssetCode->LinkCustomAttributes = "";
			$this->AssetCode->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// AssetTypeCode
			$this->AssetTypeCode->LinkCustomAttributes = "";
			$this->AssetTypeCode->HrefValue = "";

			// Supplier
			$this->Supplier->LinkCustomAttributes = "";
			$this->Supplier->HrefValue = "";

			// PurchasePrice
			$this->PurchasePrice->LinkCustomAttributes = "";
			$this->PurchasePrice->HrefValue = "";

			// CurrencyCode
			$this->CurrencyCode->LinkCustomAttributes = "";
			$this->CurrencyCode->HrefValue = "";

			// ConditionCode
			$this->ConditionCode->LinkCustomAttributes = "";
			$this->ConditionCode->HrefValue = "";

			// DateOfPurchase
			$this->DateOfPurchase->LinkCustomAttributes = "";
			$this->DateOfPurchase->HrefValue = "";

			// AssetCapacity
			$this->AssetCapacity->LinkCustomAttributes = "";
			$this->AssetCapacity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AssetDescription
			$this->AssetDescription->LinkCustomAttributes = "";
			$this->AssetDescription->HrefValue = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->LinkCustomAttributes = "";
			$this->DateOfLastRevaluation->HrefValue = "";

			// NewValue
			$this->NewValue->LinkCustomAttributes = "";
			$this->NewValue->HrefValue = "";

			// NameOfValuer
			$this->NameOfValuer->LinkCustomAttributes = "";
			$this->NameOfValuer->HrefValue = "";

			// BookValue
			$this->BookValue->LinkCustomAttributes = "";
			$this->BookValue->HrefValue = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->LinkCustomAttributes = "";
			$this->LastDepreciationDate->HrefValue = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->LinkCustomAttributes = "";
			$this->LastDepreciationAmount->HrefValue = "";

			// DepreciationRate
			$this->DepreciationRate->LinkCustomAttributes = "";
			$this->DepreciationRate->HrefValue = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->LinkCustomAttributes = "";
			$this->CumulativeDepreciation->HrefValue = "";

			// AssetStatus
			$this->AssetStatus->LinkCustomAttributes = "";
			$this->AssetStatus->HrefValue = "";

			// ScrapValue
			$this->ScrapValue->LinkCustomAttributes = "";
			$this->ScrapValue->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// AssetCode
			$this->AssetCode->EditAttrs["class"] = "form-control";
			$this->AssetCode->EditCustomAttributes = "";
			if (!$this->AssetCode->Raw)
				$this->AssetCode->CurrentValue = HtmlDecode($this->AssetCode->CurrentValue);
			$this->AssetCode->EditValue = HtmlEncode($this->AssetCode->CurrentValue);
			$this->AssetCode->PlaceHolder = RemoveHtml($this->AssetCode->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
				$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
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
			} else {
				$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
				$curVal = strval($this->ProvinceCode->CurrentValue);
				if ($curVal != "") {
					$this->ProvinceCode->EditValue = $this->ProvinceCode->lookupCacheOption($curVal);
					if ($this->ProvinceCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->ProvinceCode->EditValue = $this->ProvinceCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
						}
					}
				} else {
					$this->ProvinceCode->EditValue = NULL;
				}
				$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());
			}

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->OldValue = $this->LACode->CurrentValue;
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
				$curVal = trim(strval($this->LACode->CurrentValue));
				if ($curVal != "")
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				else
					$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
				if ($this->LACode->ViewValue !== NULL) { // Load from cache
					$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
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

			// AssetTypeCode
			$this->AssetTypeCode->EditAttrs["class"] = "form-control";
			$this->AssetTypeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetTypeCode->CurrentValue));
			if ($curVal != "")
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
			else
				$this->AssetTypeCode->ViewValue = $this->AssetTypeCode->Lookup !== NULL && is_array($this->AssetTypeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetTypeCode->ViewValue !== NULL) { // Load from cache
				$this->AssetTypeCode->EditValue = array_values($this->AssetTypeCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $this->AssetTypeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetTypeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetTypeCode->EditValue = $arwrk;
			}

			// Supplier
			$this->Supplier->EditAttrs["class"] = "form-control";
			$this->Supplier->EditCustomAttributes = "";
			if (!$this->Supplier->Raw)
				$this->Supplier->CurrentValue = HtmlDecode($this->Supplier->CurrentValue);
			$this->Supplier->EditValue = HtmlEncode($this->Supplier->CurrentValue);
			$this->Supplier->PlaceHolder = RemoveHtml($this->Supplier->caption());

			// PurchasePrice
			$this->PurchasePrice->EditAttrs["class"] = "form-control";
			$this->PurchasePrice->EditCustomAttributes = "";
			$this->PurchasePrice->EditValue = HtmlEncode($this->PurchasePrice->CurrentValue);
			$this->PurchasePrice->PlaceHolder = RemoveHtml($this->PurchasePrice->caption());
			if (strval($this->PurchasePrice->EditValue) != "" && is_numeric($this->PurchasePrice->EditValue)) {
				$this->PurchasePrice->EditValue = FormatNumber($this->PurchasePrice->EditValue, -2, -2, -2, -2);
				$this->PurchasePrice->OldValue = $this->PurchasePrice->EditValue;
			}
			

			// CurrencyCode
			$this->CurrencyCode->EditAttrs["class"] = "form-control";
			$this->CurrencyCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->CurrencyCode->CurrentValue));
			if ($curVal != "")
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->lookupCacheOption($curVal);
			else
				$this->CurrencyCode->ViewValue = $this->CurrencyCode->Lookup !== NULL && is_array($this->CurrencyCode->Lookup->Options) ? $curVal : NULL;
			if ($this->CurrencyCode->ViewValue !== NULL) { // Load from cache
				$this->CurrencyCode->EditValue = array_values($this->CurrencyCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CurrencyCode`" . SearchString("=", $this->CurrencyCode->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->CurrencyCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CurrencyCode->EditValue = $arwrk;
			}

			// ConditionCode
			$this->ConditionCode->EditAttrs["class"] = "form-control";
			$this->ConditionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ConditionCode->CurrentValue));
			if ($curVal != "")
				$this->ConditionCode->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
			else
				$this->ConditionCode->ViewValue = $this->ConditionCode->Lookup !== NULL && is_array($this->ConditionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ConditionCode->ViewValue !== NULL) { // Load from cache
				$this->ConditionCode->EditValue = array_values($this->ConditionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ConditionCode`" . SearchString("=", $this->ConditionCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ConditionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ConditionCode->EditValue = $arwrk;
			}

			// DateOfPurchase
			$this->DateOfPurchase->EditAttrs["class"] = "form-control";
			$this->DateOfPurchase->EditCustomAttributes = "";
			$this->DateOfPurchase->EditValue = HtmlEncode(FormatDateTime($this->DateOfPurchase->CurrentValue, 8));
			$this->DateOfPurchase->PlaceHolder = RemoveHtml($this->DateOfPurchase->caption());

			// AssetCapacity
			$this->AssetCapacity->EditAttrs["class"] = "form-control";
			$this->AssetCapacity->EditCustomAttributes = "";
			$this->AssetCapacity->EditValue = HtmlEncode($this->AssetCapacity->CurrentValue);
			$this->AssetCapacity->PlaceHolder = RemoveHtml($this->AssetCapacity->caption());
			if (strval($this->AssetCapacity->EditValue) != "" && is_numeric($this->AssetCapacity->EditValue)) {
				$this->AssetCapacity->EditValue = FormatNumber($this->AssetCapacity->EditValue, -2, -1, -2, 0);
				$this->AssetCapacity->OldValue = $this->AssetCapacity->EditValue;
			}
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// AssetDescription
			$this->AssetDescription->EditAttrs["class"] = "form-control";
			$this->AssetDescription->EditCustomAttributes = "";
			if (!$this->AssetDescription->Raw)
				$this->AssetDescription->CurrentValue = HtmlDecode($this->AssetDescription->CurrentValue);
			$this->AssetDescription->EditValue = HtmlEncode($this->AssetDescription->CurrentValue);
			$this->AssetDescription->PlaceHolder = RemoveHtml($this->AssetDescription->caption());

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->EditAttrs["class"] = "form-control";
			$this->DateOfLastRevaluation->EditCustomAttributes = "";
			$this->DateOfLastRevaluation->EditValue = HtmlEncode(FormatDateTime($this->DateOfLastRevaluation->CurrentValue, 8));
			$this->DateOfLastRevaluation->PlaceHolder = RemoveHtml($this->DateOfLastRevaluation->caption());

			// NewValue
			$this->NewValue->EditAttrs["class"] = "form-control";
			$this->NewValue->EditCustomAttributes = "";
			$this->NewValue->EditValue = HtmlEncode($this->NewValue->CurrentValue);
			$this->NewValue->PlaceHolder = RemoveHtml($this->NewValue->caption());
			if (strval($this->NewValue->EditValue) != "" && is_numeric($this->NewValue->EditValue)) {
				$this->NewValue->EditValue = FormatNumber($this->NewValue->EditValue, -2, -2, -2, -2);
				$this->NewValue->OldValue = $this->NewValue->EditValue;
			}
			

			// NameOfValuer
			$this->NameOfValuer->EditAttrs["class"] = "form-control";
			$this->NameOfValuer->EditCustomAttributes = "";
			if (!$this->NameOfValuer->Raw)
				$this->NameOfValuer->CurrentValue = HtmlDecode($this->NameOfValuer->CurrentValue);
			$this->NameOfValuer->EditValue = HtmlEncode($this->NameOfValuer->CurrentValue);
			$this->NameOfValuer->PlaceHolder = RemoveHtml($this->NameOfValuer->caption());

			// BookValue
			$this->BookValue->EditAttrs["class"] = "form-control";
			$this->BookValue->EditCustomAttributes = "";
			$this->BookValue->EditValue = HtmlEncode($this->BookValue->CurrentValue);
			$this->BookValue->PlaceHolder = RemoveHtml($this->BookValue->caption());
			if (strval($this->BookValue->EditValue) != "" && is_numeric($this->BookValue->EditValue)) {
				$this->BookValue->EditValue = FormatNumber($this->BookValue->EditValue, -2, -2, -2, -2);
				$this->BookValue->OldValue = $this->BookValue->EditValue;
			}
			

			// LastDepreciationDate
			$this->LastDepreciationDate->EditAttrs["class"] = "form-control";
			$this->LastDepreciationDate->EditCustomAttributes = "";
			$this->LastDepreciationDate->EditValue = HtmlEncode(FormatDateTime($this->LastDepreciationDate->CurrentValue, 8));
			$this->LastDepreciationDate->PlaceHolder = RemoveHtml($this->LastDepreciationDate->caption());

			// LastDepreciationAmount
			$this->LastDepreciationAmount->EditAttrs["class"] = "form-control";
			$this->LastDepreciationAmount->EditCustomAttributes = "";
			$this->LastDepreciationAmount->EditValue = HtmlEncode($this->LastDepreciationAmount->CurrentValue);
			$this->LastDepreciationAmount->PlaceHolder = RemoveHtml($this->LastDepreciationAmount->caption());
			if (strval($this->LastDepreciationAmount->EditValue) != "" && is_numeric($this->LastDepreciationAmount->EditValue)) {
				$this->LastDepreciationAmount->EditValue = FormatNumber($this->LastDepreciationAmount->EditValue, -2, -2, -2, -2);
				$this->LastDepreciationAmount->OldValue = $this->LastDepreciationAmount->EditValue;
			}
			

			// DepreciationRate
			$this->DepreciationRate->EditAttrs["class"] = "form-control";
			$this->DepreciationRate->EditCustomAttributes = "";
			$this->DepreciationRate->EditValue = HtmlEncode($this->DepreciationRate->CurrentValue);
			$this->DepreciationRate->PlaceHolder = RemoveHtml($this->DepreciationRate->caption());
			if (strval($this->DepreciationRate->EditValue) != "" && is_numeric($this->DepreciationRate->EditValue)) {
				$this->DepreciationRate->EditValue = FormatNumber($this->DepreciationRate->EditValue, -2, -1, -2, 0);
				$this->DepreciationRate->OldValue = $this->DepreciationRate->EditValue;
			}
			

			// CumulativeDepreciation
			$this->CumulativeDepreciation->EditAttrs["class"] = "form-control";
			$this->CumulativeDepreciation->EditCustomAttributes = "";
			$this->CumulativeDepreciation->EditValue = HtmlEncode($this->CumulativeDepreciation->CurrentValue);
			$this->CumulativeDepreciation->PlaceHolder = RemoveHtml($this->CumulativeDepreciation->caption());
			if (strval($this->CumulativeDepreciation->EditValue) != "" && is_numeric($this->CumulativeDepreciation->EditValue)) {
				$this->CumulativeDepreciation->EditValue = FormatNumber($this->CumulativeDepreciation->EditValue, -2, -2, -2, -2);
				$this->CumulativeDepreciation->OldValue = $this->CumulativeDepreciation->EditValue;
			}
			

			// AssetStatus
			$this->AssetStatus->EditAttrs["class"] = "form-control";
			$this->AssetStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetStatus->CurrentValue));
			if ($curVal != "")
				$this->AssetStatus->ViewValue = $this->AssetStatus->lookupCacheOption($curVal);
			else
				$this->AssetStatus->ViewValue = $this->AssetStatus->Lookup !== NULL && is_array($this->AssetStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetStatus->ViewValue !== NULL) { // Load from cache
				$this->AssetStatus->EditValue = array_values($this->AssetStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetStatusCode`" . SearchString("=", $this->AssetStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetStatus->EditValue = $arwrk;
			}

			// ScrapValue
			$this->ScrapValue->EditAttrs["class"] = "form-control";
			$this->ScrapValue->EditCustomAttributes = "";
			$this->ScrapValue->EditValue = HtmlEncode($this->ScrapValue->CurrentValue);
			$this->ScrapValue->PlaceHolder = RemoveHtml($this->ScrapValue->caption());
			if (strval($this->ScrapValue->EditValue) != "" && is_numeric($this->ScrapValue->EditValue)) {
				$this->ScrapValue->EditValue = FormatNumber($this->ScrapValue->EditValue, -2, -1, -2, 0);
				$this->ScrapValue->OldValue = $this->ScrapValue->EditValue;
			}
			

			// Edit refer script
			// AssetCode

			$this->AssetCode->LinkCustomAttributes = "";
			$this->AssetCode->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// AssetTypeCode
			$this->AssetTypeCode->LinkCustomAttributes = "";
			$this->AssetTypeCode->HrefValue = "";

			// Supplier
			$this->Supplier->LinkCustomAttributes = "";
			$this->Supplier->HrefValue = "";

			// PurchasePrice
			$this->PurchasePrice->LinkCustomAttributes = "";
			$this->PurchasePrice->HrefValue = "";

			// CurrencyCode
			$this->CurrencyCode->LinkCustomAttributes = "";
			$this->CurrencyCode->HrefValue = "";

			// ConditionCode
			$this->ConditionCode->LinkCustomAttributes = "";
			$this->ConditionCode->HrefValue = "";

			// DateOfPurchase
			$this->DateOfPurchase->LinkCustomAttributes = "";
			$this->DateOfPurchase->HrefValue = "";

			// AssetCapacity
			$this->AssetCapacity->LinkCustomAttributes = "";
			$this->AssetCapacity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AssetDescription
			$this->AssetDescription->LinkCustomAttributes = "";
			$this->AssetDescription->HrefValue = "";

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->LinkCustomAttributes = "";
			$this->DateOfLastRevaluation->HrefValue = "";

			// NewValue
			$this->NewValue->LinkCustomAttributes = "";
			$this->NewValue->HrefValue = "";

			// NameOfValuer
			$this->NameOfValuer->LinkCustomAttributes = "";
			$this->NameOfValuer->HrefValue = "";

			// BookValue
			$this->BookValue->LinkCustomAttributes = "";
			$this->BookValue->HrefValue = "";

			// LastDepreciationDate
			$this->LastDepreciationDate->LinkCustomAttributes = "";
			$this->LastDepreciationDate->HrefValue = "";

			// LastDepreciationAmount
			$this->LastDepreciationAmount->LinkCustomAttributes = "";
			$this->LastDepreciationAmount->HrefValue = "";

			// DepreciationRate
			$this->DepreciationRate->LinkCustomAttributes = "";
			$this->DepreciationRate->HrefValue = "";

			// CumulativeDepreciation
			$this->CumulativeDepreciation->LinkCustomAttributes = "";
			$this->CumulativeDepreciation->HrefValue = "";

			// AssetStatus
			$this->AssetStatus->LinkCustomAttributes = "";
			$this->AssetStatus->HrefValue = "";

			// ScrapValue
			$this->ScrapValue->LinkCustomAttributes = "";
			$this->ScrapValue->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// AssetCode
			$this->AssetCode->EditAttrs["class"] = "form-control";
			$this->AssetCode->EditCustomAttributes = "";
			if (!$this->AssetCode->Raw)
				$this->AssetCode->AdvancedSearch->SearchValue = HtmlDecode($this->AssetCode->AdvancedSearch->SearchValue);
			$this->AssetCode->EditValue = HtmlEncode($this->AssetCode->AdvancedSearch->SearchValue);
			$this->AssetCode->PlaceHolder = RemoveHtml($this->AssetCode->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->ProvinceCode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ProvinceCode->EditValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProvinceCode->EditValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ProvinceCode->EditValue = NULL;
			}
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->DepartmentCode->EditValue = $arwrk;
			}

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
			$this->SectionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SectionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->SectionCode->AdvancedSearch->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
			else
				$this->SectionCode->AdvancedSearch->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SectionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SectionCode->EditValue = $arwrk;
			}

			// AssetTypeCode
			$this->AssetTypeCode->EditAttrs["class"] = "form-control";
			$this->AssetTypeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AssetTypeCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AssetTypeCode->AdvancedSearch->ViewValue = $this->AssetTypeCode->lookupCacheOption($curVal);
			else
				$this->AssetTypeCode->AdvancedSearch->ViewValue = $this->AssetTypeCode->Lookup !== NULL && is_array($this->AssetTypeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AssetTypeCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AssetTypeCode->EditValue = array_values($this->AssetTypeCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AssetTypeCode`" . SearchString("=", $this->AssetTypeCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AssetTypeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AssetTypeCode->EditValue = $arwrk;
			}

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

			// ConditionCode
			$this->ConditionCode->EditAttrs["class"] = "form-control";
			$this->ConditionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ConditionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ConditionCode->AdvancedSearch->ViewValue = $this->ConditionCode->lookupCacheOption($curVal);
			else
				$this->ConditionCode->AdvancedSearch->ViewValue = $this->ConditionCode->Lookup !== NULL && is_array($this->ConditionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ConditionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ConditionCode->EditValue = array_values($this->ConditionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ConditionCode`" . SearchString("=", $this->ConditionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ConditionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ConditionCode->EditValue = $arwrk;
			}

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

			// ScrapValue
			$this->ScrapValue->EditAttrs["class"] = "form-control";
			$this->ScrapValue->EditCustomAttributes = "";
			$this->ScrapValue->EditValue = HtmlEncode($this->ScrapValue->AdvancedSearch->SearchValue);
			$this->ScrapValue->PlaceHolder = RemoveHtml($this->ScrapValue->caption());
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
		if (!CheckInteger($this->ProvinceCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ProvinceCode->errorMessage());
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

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->AssetCode->Required) {
			if (!$this->AssetCode->IsDetailKey && $this->AssetCode->FormValue != NULL && $this->AssetCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetCode->caption(), $this->AssetCode->RequiredErrorMessage));
			}
		}
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ProvinceCode->FormValue)) {
			AddMessage($FormError, $this->ProvinceCode->errorMessage());
		}
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
		if ($this->AssetTypeCode->Required) {
			if (!$this->AssetTypeCode->IsDetailKey && $this->AssetTypeCode->FormValue != NULL && $this->AssetTypeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetTypeCode->caption(), $this->AssetTypeCode->RequiredErrorMessage));
			}
		}
		if ($this->Supplier->Required) {
			if (!$this->Supplier->IsDetailKey && $this->Supplier->FormValue != NULL && $this->Supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Supplier->caption(), $this->Supplier->RequiredErrorMessage));
			}
		}
		if ($this->PurchasePrice->Required) {
			if (!$this->PurchasePrice->IsDetailKey && $this->PurchasePrice->FormValue != NULL && $this->PurchasePrice->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PurchasePrice->caption(), $this->PurchasePrice->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->PurchasePrice->FormValue)) {
			AddMessage($FormError, $this->PurchasePrice->errorMessage());
		}
		if ($this->CurrencyCode->Required) {
			if (!$this->CurrencyCode->IsDetailKey && $this->CurrencyCode->FormValue != NULL && $this->CurrencyCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrencyCode->caption(), $this->CurrencyCode->RequiredErrorMessage));
			}
		}
		if ($this->ConditionCode->Required) {
			if (!$this->ConditionCode->IsDetailKey && $this->ConditionCode->FormValue != NULL && $this->ConditionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ConditionCode->caption(), $this->ConditionCode->RequiredErrorMessage));
			}
		}
		if ($this->DateOfPurchase->Required) {
			if (!$this->DateOfPurchase->IsDetailKey && $this->DateOfPurchase->FormValue != NULL && $this->DateOfPurchase->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfPurchase->caption(), $this->DateOfPurchase->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfPurchase->FormValue)) {
			AddMessage($FormError, $this->DateOfPurchase->errorMessage());
		}
		if ($this->AssetCapacity->Required) {
			if (!$this->AssetCapacity->IsDetailKey && $this->AssetCapacity->FormValue != NULL && $this->AssetCapacity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetCapacity->caption(), $this->AssetCapacity->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AssetCapacity->FormValue)) {
			AddMessage($FormError, $this->AssetCapacity->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->AssetDescription->Required) {
			if (!$this->AssetDescription->IsDetailKey && $this->AssetDescription->FormValue != NULL && $this->AssetDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetDescription->caption(), $this->AssetDescription->RequiredErrorMessage));
			}
		}
		if ($this->DateOfLastRevaluation->Required) {
			if (!$this->DateOfLastRevaluation->IsDetailKey && $this->DateOfLastRevaluation->FormValue != NULL && $this->DateOfLastRevaluation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfLastRevaluation->caption(), $this->DateOfLastRevaluation->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfLastRevaluation->FormValue)) {
			AddMessage($FormError, $this->DateOfLastRevaluation->errorMessage());
		}
		if ($this->NewValue->Required) {
			if (!$this->NewValue->IsDetailKey && $this->NewValue->FormValue != NULL && $this->NewValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewValue->caption(), $this->NewValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->NewValue->FormValue)) {
			AddMessage($FormError, $this->NewValue->errorMessage());
		}
		if ($this->NameOfValuer->Required) {
			if (!$this->NameOfValuer->IsDetailKey && $this->NameOfValuer->FormValue != NULL && $this->NameOfValuer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NameOfValuer->caption(), $this->NameOfValuer->RequiredErrorMessage));
			}
		}
		if ($this->BookValue->Required) {
			if (!$this->BookValue->IsDetailKey && $this->BookValue->FormValue != NULL && $this->BookValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BookValue->caption(), $this->BookValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BookValue->FormValue)) {
			AddMessage($FormError, $this->BookValue->errorMessage());
		}
		if ($this->LastDepreciationDate->Required) {
			if (!$this->LastDepreciationDate->IsDetailKey && $this->LastDepreciationDate->FormValue != NULL && $this->LastDepreciationDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastDepreciationDate->caption(), $this->LastDepreciationDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastDepreciationDate->FormValue)) {
			AddMessage($FormError, $this->LastDepreciationDate->errorMessage());
		}
		if ($this->LastDepreciationAmount->Required) {
			if (!$this->LastDepreciationAmount->IsDetailKey && $this->LastDepreciationAmount->FormValue != NULL && $this->LastDepreciationAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastDepreciationAmount->caption(), $this->LastDepreciationAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->LastDepreciationAmount->FormValue)) {
			AddMessage($FormError, $this->LastDepreciationAmount->errorMessage());
		}
		if ($this->DepreciationRate->Required) {
			if (!$this->DepreciationRate->IsDetailKey && $this->DepreciationRate->FormValue != NULL && $this->DepreciationRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepreciationRate->caption(), $this->DepreciationRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->DepreciationRate->FormValue)) {
			AddMessage($FormError, $this->DepreciationRate->errorMessage());
		}
		if ($this->CumulativeDepreciation->Required) {
			if (!$this->CumulativeDepreciation->IsDetailKey && $this->CumulativeDepreciation->FormValue != NULL && $this->CumulativeDepreciation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CumulativeDepreciation->caption(), $this->CumulativeDepreciation->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->CumulativeDepreciation->FormValue)) {
			AddMessage($FormError, $this->CumulativeDepreciation->errorMessage());
		}
		if ($this->AssetStatus->Required) {
			if (!$this->AssetStatus->IsDetailKey && $this->AssetStatus->FormValue != NULL && $this->AssetStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AssetStatus->caption(), $this->AssetStatus->RequiredErrorMessage));
			}
		}
		if ($this->ScrapValue->Required) {
			if (!$this->ScrapValue->IsDetailKey && $this->ScrapValue->FormValue != NULL && $this->ScrapValue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ScrapValue->caption(), $this->ScrapValue->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ScrapValue->FormValue)) {
			AddMessage($FormError, $this->ScrapValue->errorMessage());
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
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

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
				$thisKey .= $row['AssetCode'];
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

			// AssetCode
			$this->AssetCode->setDbValueDef($rsnew, $this->AssetCode->CurrentValue, "", $this->AssetCode->ReadOnly);

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, $this->SectionCode->ReadOnly);

			// AssetTypeCode
			$this->AssetTypeCode->setDbValueDef($rsnew, $this->AssetTypeCode->CurrentValue, NULL, $this->AssetTypeCode->ReadOnly);

			// Supplier
			$this->Supplier->setDbValueDef($rsnew, $this->Supplier->CurrentValue, NULL, $this->Supplier->ReadOnly);

			// PurchasePrice
			$this->PurchasePrice->setDbValueDef($rsnew, $this->PurchasePrice->CurrentValue, NULL, $this->PurchasePrice->ReadOnly);

			// CurrencyCode
			$this->CurrencyCode->setDbValueDef($rsnew, $this->CurrencyCode->CurrentValue, NULL, $this->CurrencyCode->ReadOnly);

			// ConditionCode
			$this->ConditionCode->setDbValueDef($rsnew, $this->ConditionCode->CurrentValue, NULL, $this->ConditionCode->ReadOnly);

			// DateOfPurchase
			$this->DateOfPurchase->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0), NULL, $this->DateOfPurchase->ReadOnly);

			// AssetCapacity
			$this->AssetCapacity->setDbValueDef($rsnew, $this->AssetCapacity->CurrentValue, NULL, $this->AssetCapacity->ReadOnly);

			// UnitOfMeasure
			$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, $this->UnitOfMeasure->ReadOnly);

			// AssetDescription
			$this->AssetDescription->setDbValueDef($rsnew, $this->AssetDescription->CurrentValue, NULL, $this->AssetDescription->ReadOnly);

			// DateOfLastRevaluation
			$this->DateOfLastRevaluation->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0), NULL, $this->DateOfLastRevaluation->ReadOnly);

			// NewValue
			$this->NewValue->setDbValueDef($rsnew, $this->NewValue->CurrentValue, NULL, $this->NewValue->ReadOnly);

			// NameOfValuer
			$this->NameOfValuer->setDbValueDef($rsnew, $this->NameOfValuer->CurrentValue, NULL, $this->NameOfValuer->ReadOnly);

			// BookValue
			$this->BookValue->setDbValueDef($rsnew, $this->BookValue->CurrentValue, NULL, $this->BookValue->ReadOnly);

			// LastDepreciationDate
			$this->LastDepreciationDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0), NULL, $this->LastDepreciationDate->ReadOnly);

			// LastDepreciationAmount
			$this->LastDepreciationAmount->setDbValueDef($rsnew, $this->LastDepreciationAmount->CurrentValue, NULL, $this->LastDepreciationAmount->ReadOnly);

			// DepreciationRate
			$this->DepreciationRate->setDbValueDef($rsnew, $this->DepreciationRate->CurrentValue, NULL, $this->DepreciationRate->ReadOnly);

			// CumulativeDepreciation
			$this->CumulativeDepreciation->setDbValueDef($rsnew, $this->CumulativeDepreciation->CurrentValue, NULL, $this->CumulativeDepreciation->ReadOnly);

			// AssetStatus
			$this->AssetStatus->setDbValueDef($rsnew, $this->AssetStatus->CurrentValue, NULL, $this->AssetStatus->ReadOnly);

			// ScrapValue
			$this->ScrapValue->setDbValueDef($rsnew, $this->ScrapValue->CurrentValue, 0, $this->ScrapValue->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('AssetCode')); // AssetCode
		$hash .= GetFieldHash($rs->fields('ProvinceCode')); // ProvinceCode
		$hash .= GetFieldHash($rs->fields('LACode')); // LACode
		$hash .= GetFieldHash($rs->fields('DepartmentCode')); // DepartmentCode
		$hash .= GetFieldHash($rs->fields('SectionCode')); // SectionCode
		$hash .= GetFieldHash($rs->fields('AssetTypeCode')); // AssetTypeCode
		$hash .= GetFieldHash($rs->fields('Supplier')); // Supplier
		$hash .= GetFieldHash($rs->fields('PurchasePrice')); // PurchasePrice
		$hash .= GetFieldHash($rs->fields('CurrencyCode')); // CurrencyCode
		$hash .= GetFieldHash($rs->fields('ConditionCode')); // ConditionCode
		$hash .= GetFieldHash($rs->fields('DateOfPurchase')); // DateOfPurchase
		$hash .= GetFieldHash($rs->fields('AssetCapacity')); // AssetCapacity
		$hash .= GetFieldHash($rs->fields('UnitOfMeasure')); // UnitOfMeasure
		$hash .= GetFieldHash($rs->fields('AssetDescription')); // AssetDescription
		$hash .= GetFieldHash($rs->fields('DateOfLastRevaluation')); // DateOfLastRevaluation
		$hash .= GetFieldHash($rs->fields('NewValue')); // NewValue
		$hash .= GetFieldHash($rs->fields('NameOfValuer')); // NameOfValuer
		$hash .= GetFieldHash($rs->fields('BookValue')); // BookValue
		$hash .= GetFieldHash($rs->fields('LastDepreciationDate')); // LastDepreciationDate
		$hash .= GetFieldHash($rs->fields('LastDepreciationAmount')); // LastDepreciationAmount
		$hash .= GetFieldHash($rs->fields('DepreciationRate')); // DepreciationRate
		$hash .= GetFieldHash($rs->fields('CumulativeDepreciation')); // CumulativeDepreciation
		$hash .= GetFieldHash($rs->fields('AssetStatus')); // AssetStatus
		$hash .= GetFieldHash($rs->fields('ScrapValue')); // ScrapValue
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

		// AssetCode
		$this->AssetCode->setDbValueDef($rsnew, $this->AssetCode->CurrentValue, "", FALSE);

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, FALSE);

		// DepartmentCode
		$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, FALSE);

		// SectionCode
		$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, FALSE);

		// AssetTypeCode
		$this->AssetTypeCode->setDbValueDef($rsnew, $this->AssetTypeCode->CurrentValue, NULL, FALSE);

		// Supplier
		$this->Supplier->setDbValueDef($rsnew, $this->Supplier->CurrentValue, NULL, FALSE);

		// PurchasePrice
		$this->PurchasePrice->setDbValueDef($rsnew, $this->PurchasePrice->CurrentValue, NULL, FALSE);

		// CurrencyCode
		$this->CurrencyCode->setDbValueDef($rsnew, $this->CurrencyCode->CurrentValue, NULL, strval($this->CurrencyCode->CurrentValue) == "");

		// ConditionCode
		$this->ConditionCode->setDbValueDef($rsnew, $this->ConditionCode->CurrentValue, NULL, FALSE);

		// DateOfPurchase
		$this->DateOfPurchase->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfPurchase->CurrentValue, 0), NULL, FALSE);

		// AssetCapacity
		$this->AssetCapacity->setDbValueDef($rsnew, $this->AssetCapacity->CurrentValue, NULL, FALSE);

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, FALSE);

		// AssetDescription
		$this->AssetDescription->setDbValueDef($rsnew, $this->AssetDescription->CurrentValue, NULL, FALSE);

		// DateOfLastRevaluation
		$this->DateOfLastRevaluation->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfLastRevaluation->CurrentValue, 0), NULL, FALSE);

		// NewValue
		$this->NewValue->setDbValueDef($rsnew, $this->NewValue->CurrentValue, NULL, FALSE);

		// NameOfValuer
		$this->NameOfValuer->setDbValueDef($rsnew, $this->NameOfValuer->CurrentValue, NULL, FALSE);

		// BookValue
		$this->BookValue->setDbValueDef($rsnew, $this->BookValue->CurrentValue, NULL, FALSE);

		// LastDepreciationDate
		$this->LastDepreciationDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastDepreciationDate->CurrentValue, 0), NULL, FALSE);

		// LastDepreciationAmount
		$this->LastDepreciationAmount->setDbValueDef($rsnew, $this->LastDepreciationAmount->CurrentValue, NULL, FALSE);

		// DepreciationRate
		$this->DepreciationRate->setDbValueDef($rsnew, $this->DepreciationRate->CurrentValue, NULL, FALSE);

		// CumulativeDepreciation
		$this->CumulativeDepreciation->setDbValueDef($rsnew, $this->CumulativeDepreciation->CurrentValue, NULL, FALSE);

		// AssetStatus
		$this->AssetStatus->setDbValueDef($rsnew, $this->AssetStatus->CurrentValue, NULL, FALSE);

		// ScrapValue
		$this->ScrapValue->setDbValueDef($rsnew, $this->ScrapValue->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['AssetCode']) == "") {
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
		$this->AssetCode->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->AssetTypeCode->AdvancedSearch->load();
		$this->Supplier->AdvancedSearch->load();
		$this->PurchasePrice->AdvancedSearch->load();
		$this->CurrencyCode->AdvancedSearch->load();
		$this->ConditionCode->AdvancedSearch->load();
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
		$this->ScrapValue->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fassetlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fassetlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fassetlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_asset" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_asset\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fassetlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fassetlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"assetsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"asset\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'assetsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fassetlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "local_authority") {
			global $local_authority;
			if (!isset($local_authority))
				$local_authority = new local_authority();
			$rsmaster = $local_authority->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$local_authority;
					$local_authority->exportDocument($doc, $rsmaster);
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
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["local_authority"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
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
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["local_authority"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["local_authority"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
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
			if ($masterTblVar != "local_authority") {
				if ($this->ProvinceCode->CurrentValue == "")
					$this->ProvinceCode->setSessionValue("");
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_AssetTypeCode":
					break;
				case "x_CurrencyCode":
					break;
				case "x_ConditionCode":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_AssetStatus":
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
						case "x_SectionCode":
							break;
						case "x_AssetTypeCode":
							break;
						case "x_CurrencyCode":
							break;
						case "x_ConditionCode":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_AssetStatus":
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