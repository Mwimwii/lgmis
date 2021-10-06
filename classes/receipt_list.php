<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipt_list extends receipt
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipt';

	// Page object name
	public $PageObjName = "receipt_list";

	// Grid form hidden field names
	public $FormName = "freceiptlist";
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

		// Table object (receipt)
		if (!isset($GLOBALS["receipt"]) || get_class($GLOBALS["receipt"]) == PROJECT_NAMESPACE . "receipt") {
			$GLOBALS["receipt"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["receipt"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "receiptadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "receiptdelete.php";
		$this->MultiUpdateUrl = "receiptupdate.php";

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (receipt_header)
		if (!isset($GLOBALS['receipt_header']))
			$GLOBALS['receipt_header'] = new receipt_header();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipt');

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
		$this->FilterOptions->TagClassName = "ew-filter-option freceiptlistsrch";

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
		global $receipt;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipt);
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
			$key .= @$ar['ClientSerNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ChargeCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ItemID'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ReceiptNo'];
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
		if ($this->isAddOrEdit())
			$this->ReceiptDate->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->CashierNo->Visible = FALSE;
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
		$this->ClientSerNo->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ItemID->setVisibility();
		$this->UnitCost->setVisibility();
		$this->Quantity->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->ReceiptNo->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->PaymentRef->setVisibility();
		$this->AdditionalInformation->Visible = FALSE;
		$this->LastUpdatedBy->Visible = FALSE;
		$this->LastUpdateDate->Visible = FALSE;
		$this->CashierNo->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->BillYear->setVisibility();
		$this->PaymentFor->Visible = FALSE;
		$this->ChargeGroup->setVisibility();
		$this->ClientID->setVisibility();
		$this->PrintedReceipt->Visible = FALSE;
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
		$this->setupLookupOptions($this->ChargeCode);
		$this->setupLookupOptions($this->PaymentMethod);

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

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "receipt_header") {
			global $receipt_header;
			$rsmaster = $receipt_header->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("receipt_headerlist.php"); // Return to master page
			} else {
				$receipt_header->loadListRowValues($rsmaster);
				$receipt_header->RowType = ROWTYPE_MASTER; // Master row
				$receipt_header->renderListRow();
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
		$this->UnitCost->FormValue = ""; // Clear form value
		$this->Quantity->FormValue = ""; // Clear form value
		$this->AmountPaid->FormValue = ""; // Clear form value
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
		if (count($arKeyFlds) >= 4) {
			$this->ClientSerNo->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ClientSerNo->OldValue))
				return FALSE;
			$this->ChargeCode->setOldValue($arKeyFlds[1]);
			if (!is_numeric($this->ChargeCode->OldValue))
				return FALSE;
			$this->ItemID->setOldValue($arKeyFlds[2]);
			$this->ReceiptNo->setOldValue($arKeyFlds[3]);
			if (!is_numeric($this->ReceiptNo->OldValue))
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
					$key .= $this->ClientSerNo->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ChargeCode->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ItemID->CurrentValue;
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->ReceiptNo->CurrentValue;

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
		if ($CurrentForm->hasValue("x_ClientSerNo") && $CurrentForm->hasValue("o_ClientSerNo") && $this->ClientSerNo->CurrentValue != $this->ClientSerNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeCode") && $CurrentForm->hasValue("o_ChargeCode") && $this->ChargeCode->CurrentValue != $this->ChargeCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ItemID") && $CurrentForm->hasValue("o_ItemID") && $this->ItemID->CurrentValue != $this->ItemID->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitCost") && $CurrentForm->hasValue("o_UnitCost") && $this->UnitCost->CurrentValue != $this->UnitCost->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Quantity") && $CurrentForm->hasValue("o_Quantity") && $this->Quantity->CurrentValue != $this->Quantity->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_UnitOfMeasure") && $CurrentForm->hasValue("o_UnitOfMeasure") && $this->UnitOfMeasure->CurrentValue != $this->UnitOfMeasure->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AmountPaid") && $CurrentForm->hasValue("o_AmountPaid") && $this->AmountPaid->CurrentValue != $this->AmountPaid->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ReceiptNo") && $CurrentForm->hasValue("o_ReceiptNo") && $this->ReceiptNo->CurrentValue != $this->ReceiptNo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentMethod") && $CurrentForm->hasValue("o_PaymentMethod") && $this->PaymentMethod->CurrentValue != $this->PaymentMethod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PaymentRef") && $CurrentForm->hasValue("o_PaymentRef") && $this->PaymentRef->CurrentValue != $this->PaymentRef->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BillPeriod") && $CurrentForm->hasValue("o_BillPeriod") && $this->BillPeriod->CurrentValue != $this->BillPeriod->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BillYear") && $CurrentForm->hasValue("o_BillYear") && $this->BillYear->CurrentValue != $this->BillYear->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeGroup") && $CurrentForm->hasValue("o_ChargeGroup") && $this->ChargeGroup->CurrentValue != $this->ChargeGroup->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ClientID") && $CurrentForm->hasValue("o_ClientID") && $this->ClientID->CurrentValue != $this->ClientID->OldValue)
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
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "freceiptlistsrch");
		$filterList = Concat($filterList, $this->ClientSerNo->AdvancedSearch->toJson(), ","); // Field ClientSerNo
		$filterList = Concat($filterList, $this->ChargeCode->AdvancedSearch->toJson(), ","); // Field ChargeCode
		$filterList = Concat($filterList, $this->ItemID->AdvancedSearch->toJson(), ","); // Field ItemID
		$filterList = Concat($filterList, $this->UnitCost->AdvancedSearch->toJson(), ","); // Field UnitCost
		$filterList = Concat($filterList, $this->Quantity->AdvancedSearch->toJson(), ","); // Field Quantity
		$filterList = Concat($filterList, $this->UnitOfMeasure->AdvancedSearch->toJson(), ","); // Field UnitOfMeasure
		$filterList = Concat($filterList, $this->AmountPaid->AdvancedSearch->toJson(), ","); // Field AmountPaid
		$filterList = Concat($filterList, $this->ReceiptNo->AdvancedSearch->toJson(), ","); // Field ReceiptNo
		$filterList = Concat($filterList, $this->ReceiptDate->AdvancedSearch->toJson(), ","); // Field ReceiptDate
		$filterList = Concat($filterList, $this->PaymentMethod->AdvancedSearch->toJson(), ","); // Field PaymentMethod
		$filterList = Concat($filterList, $this->PaymentRef->AdvancedSearch->toJson(), ","); // Field PaymentRef
		$filterList = Concat($filterList, $this->AdditionalInformation->AdvancedSearch->toJson(), ","); // Field AdditionalInformation
		$filterList = Concat($filterList, $this->LastUpdatedBy->AdvancedSearch->toJson(), ","); // Field LastUpdatedBy
		$filterList = Concat($filterList, $this->LastUpdateDate->AdvancedSearch->toJson(), ","); // Field LastUpdateDate
		$filterList = Concat($filterList, $this->CashierNo->AdvancedSearch->toJson(), ","); // Field CashierNo
		$filterList = Concat($filterList, $this->BillPeriod->AdvancedSearch->toJson(), ","); // Field BillPeriod
		$filterList = Concat($filterList, $this->BillYear->AdvancedSearch->toJson(), ","); // Field BillYear
		$filterList = Concat($filterList, $this->PaymentFor->AdvancedSearch->toJson(), ","); // Field PaymentFor
		$filterList = Concat($filterList, $this->ChargeGroup->AdvancedSearch->toJson(), ","); // Field ChargeGroup
		$filterList = Concat($filterList, $this->ClientID->AdvancedSearch->toJson(), ","); // Field ClientID
		$filterList = Concat($filterList, $this->PrintedReceipt->AdvancedSearch->toJson(), ","); // Field PrintedReceipt
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
			$UserProfile->setSearchFilters(CurrentUserName(), "freceiptlistsrch", $filters);
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

		// Field ClientSerNo
		$this->ClientSerNo->AdvancedSearch->SearchValue = @$filter["x_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchOperator = @$filter["z_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchCondition = @$filter["v_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchValue2 = @$filter["y_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->SearchOperator2 = @$filter["w_ClientSerNo"];
		$this->ClientSerNo->AdvancedSearch->save();

		// Field ChargeCode
		$this->ChargeCode->AdvancedSearch->SearchValue = @$filter["x_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchOperator = @$filter["z_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchCondition = @$filter["v_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchValue2 = @$filter["y_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeCode"];
		$this->ChargeCode->AdvancedSearch->save();

		// Field ItemID
		$this->ItemID->AdvancedSearch->SearchValue = @$filter["x_ItemID"];
		$this->ItemID->AdvancedSearch->SearchOperator = @$filter["z_ItemID"];
		$this->ItemID->AdvancedSearch->SearchCondition = @$filter["v_ItemID"];
		$this->ItemID->AdvancedSearch->SearchValue2 = @$filter["y_ItemID"];
		$this->ItemID->AdvancedSearch->SearchOperator2 = @$filter["w_ItemID"];
		$this->ItemID->AdvancedSearch->save();

		// Field UnitCost
		$this->UnitCost->AdvancedSearch->SearchValue = @$filter["x_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchOperator = @$filter["z_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchCondition = @$filter["v_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchValue2 = @$filter["y_UnitCost"];
		$this->UnitCost->AdvancedSearch->SearchOperator2 = @$filter["w_UnitCost"];
		$this->UnitCost->AdvancedSearch->save();

		// Field Quantity
		$this->Quantity->AdvancedSearch->SearchValue = @$filter["x_Quantity"];
		$this->Quantity->AdvancedSearch->SearchOperator = @$filter["z_Quantity"];
		$this->Quantity->AdvancedSearch->SearchCondition = @$filter["v_Quantity"];
		$this->Quantity->AdvancedSearch->SearchValue2 = @$filter["y_Quantity"];
		$this->Quantity->AdvancedSearch->SearchOperator2 = @$filter["w_Quantity"];
		$this->Quantity->AdvancedSearch->save();

		// Field UnitOfMeasure
		$this->UnitOfMeasure->AdvancedSearch->SearchValue = @$filter["x_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator = @$filter["z_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchCondition = @$filter["v_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchValue2 = @$filter["y_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->SearchOperator2 = @$filter["w_UnitOfMeasure"];
		$this->UnitOfMeasure->AdvancedSearch->save();

		// Field AmountPaid
		$this->AmountPaid->AdvancedSearch->SearchValue = @$filter["x_AmountPaid"];
		$this->AmountPaid->AdvancedSearch->SearchOperator = @$filter["z_AmountPaid"];
		$this->AmountPaid->AdvancedSearch->SearchCondition = @$filter["v_AmountPaid"];
		$this->AmountPaid->AdvancedSearch->SearchValue2 = @$filter["y_AmountPaid"];
		$this->AmountPaid->AdvancedSearch->SearchOperator2 = @$filter["w_AmountPaid"];
		$this->AmountPaid->AdvancedSearch->save();

		// Field ReceiptNo
		$this->ReceiptNo->AdvancedSearch->SearchValue = @$filter["x_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchOperator = @$filter["z_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchCondition = @$filter["v_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchValue2 = @$filter["y_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->SearchOperator2 = @$filter["w_ReceiptNo"];
		$this->ReceiptNo->AdvancedSearch->save();

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

		// Field PaymentRef
		$this->PaymentRef->AdvancedSearch->SearchValue = @$filter["x_PaymentRef"];
		$this->PaymentRef->AdvancedSearch->SearchOperator = @$filter["z_PaymentRef"];
		$this->PaymentRef->AdvancedSearch->SearchCondition = @$filter["v_PaymentRef"];
		$this->PaymentRef->AdvancedSearch->SearchValue2 = @$filter["y_PaymentRef"];
		$this->PaymentRef->AdvancedSearch->SearchOperator2 = @$filter["w_PaymentRef"];
		$this->PaymentRef->AdvancedSearch->save();

		// Field AdditionalInformation
		$this->AdditionalInformation->AdvancedSearch->SearchValue = @$filter["x_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchOperator = @$filter["z_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchCondition = @$filter["v_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchValue2 = @$filter["y_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->SearchOperator2 = @$filter["w_AdditionalInformation"];
		$this->AdditionalInformation->AdvancedSearch->save();

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

		// Field CashierNo
		$this->CashierNo->AdvancedSearch->SearchValue = @$filter["x_CashierNo"];
		$this->CashierNo->AdvancedSearch->SearchOperator = @$filter["z_CashierNo"];
		$this->CashierNo->AdvancedSearch->SearchCondition = @$filter["v_CashierNo"];
		$this->CashierNo->AdvancedSearch->SearchValue2 = @$filter["y_CashierNo"];
		$this->CashierNo->AdvancedSearch->SearchOperator2 = @$filter["w_CashierNo"];
		$this->CashierNo->AdvancedSearch->save();

		// Field BillPeriod
		$this->BillPeriod->AdvancedSearch->SearchValue = @$filter["x_BillPeriod"];
		$this->BillPeriod->AdvancedSearch->SearchOperator = @$filter["z_BillPeriod"];
		$this->BillPeriod->AdvancedSearch->SearchCondition = @$filter["v_BillPeriod"];
		$this->BillPeriod->AdvancedSearch->SearchValue2 = @$filter["y_BillPeriod"];
		$this->BillPeriod->AdvancedSearch->SearchOperator2 = @$filter["w_BillPeriod"];
		$this->BillPeriod->AdvancedSearch->save();

		// Field BillYear
		$this->BillYear->AdvancedSearch->SearchValue = @$filter["x_BillYear"];
		$this->BillYear->AdvancedSearch->SearchOperator = @$filter["z_BillYear"];
		$this->BillYear->AdvancedSearch->SearchCondition = @$filter["v_BillYear"];
		$this->BillYear->AdvancedSearch->SearchValue2 = @$filter["y_BillYear"];
		$this->BillYear->AdvancedSearch->SearchOperator2 = @$filter["w_BillYear"];
		$this->BillYear->AdvancedSearch->save();

		// Field PaymentFor
		$this->PaymentFor->AdvancedSearch->SearchValue = @$filter["x_PaymentFor"];
		$this->PaymentFor->AdvancedSearch->SearchOperator = @$filter["z_PaymentFor"];
		$this->PaymentFor->AdvancedSearch->SearchCondition = @$filter["v_PaymentFor"];
		$this->PaymentFor->AdvancedSearch->SearchValue2 = @$filter["y_PaymentFor"];
		$this->PaymentFor->AdvancedSearch->SearchOperator2 = @$filter["w_PaymentFor"];
		$this->PaymentFor->AdvancedSearch->save();

		// Field ChargeGroup
		$this->ChargeGroup->AdvancedSearch->SearchValue = @$filter["x_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchOperator = @$filter["z_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchCondition = @$filter["v_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchValue2 = @$filter["y_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->SearchOperator2 = @$filter["w_ChargeGroup"];
		$this->ChargeGroup->AdvancedSearch->save();

		// Field ClientID
		$this->ClientID->AdvancedSearch->SearchValue = @$filter["x_ClientID"];
		$this->ClientID->AdvancedSearch->SearchOperator = @$filter["z_ClientID"];
		$this->ClientID->AdvancedSearch->SearchCondition = @$filter["v_ClientID"];
		$this->ClientID->AdvancedSearch->SearchValue2 = @$filter["y_ClientID"];
		$this->ClientID->AdvancedSearch->SearchOperator2 = @$filter["w_ClientID"];
		$this->ClientID->AdvancedSearch->save();

		// Field PrintedReceipt
		$this->PrintedReceipt->AdvancedSearch->SearchValue = @$filter["x_PrintedReceipt"];
		$this->PrintedReceipt->AdvancedSearch->SearchOperator = @$filter["z_PrintedReceipt"];
		$this->PrintedReceipt->AdvancedSearch->SearchCondition = @$filter["v_PrintedReceipt"];
		$this->PrintedReceipt->AdvancedSearch->SearchValue2 = @$filter["y_PrintedReceipt"];
		$this->PrintedReceipt->AdvancedSearch->SearchOperator2 = @$filter["w_PrintedReceipt"];
		$this->PrintedReceipt->AdvancedSearch->save();
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
		$this->buildSearchSql($where, $this->ClientSerNo, $default, FALSE); // ClientSerNo
		$this->buildSearchSql($where, $this->ChargeCode, $default, FALSE); // ChargeCode
		$this->buildSearchSql($where, $this->ItemID, $default, FALSE); // ItemID
		$this->buildSearchSql($where, $this->UnitCost, $default, FALSE); // UnitCost
		$this->buildSearchSql($where, $this->Quantity, $default, FALSE); // Quantity
		$this->buildSearchSql($where, $this->UnitOfMeasure, $default, FALSE); // UnitOfMeasure
		$this->buildSearchSql($where, $this->AmountPaid, $default, FALSE); // AmountPaid
		$this->buildSearchSql($where, $this->ReceiptNo, $default, FALSE); // ReceiptNo
		$this->buildSearchSql($where, $this->ReceiptDate, $default, FALSE); // ReceiptDate
		$this->buildSearchSql($where, $this->PaymentMethod, $default, FALSE); // PaymentMethod
		$this->buildSearchSql($where, $this->PaymentRef, $default, FALSE); // PaymentRef
		$this->buildSearchSql($where, $this->AdditionalInformation, $default, FALSE); // AdditionalInformation
		$this->buildSearchSql($where, $this->LastUpdatedBy, $default, FALSE); // LastUpdatedBy
		$this->buildSearchSql($where, $this->LastUpdateDate, $default, FALSE); // LastUpdateDate
		$this->buildSearchSql($where, $this->CashierNo, $default, FALSE); // CashierNo
		$this->buildSearchSql($where, $this->BillPeriod, $default, FALSE); // BillPeriod
		$this->buildSearchSql($where, $this->BillYear, $default, FALSE); // BillYear
		$this->buildSearchSql($where, $this->PaymentFor, $default, FALSE); // PaymentFor
		$this->buildSearchSql($where, $this->ChargeGroup, $default, FALSE); // ChargeGroup
		$this->buildSearchSql($where, $this->ClientID, $default, FALSE); // ClientID
		$this->buildSearchSql($where, $this->PrintedReceipt, $default, FALSE); // PrintedReceipt

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->ClientSerNo->AdvancedSearch->save(); // ClientSerNo
			$this->ChargeCode->AdvancedSearch->save(); // ChargeCode
			$this->ItemID->AdvancedSearch->save(); // ItemID
			$this->UnitCost->AdvancedSearch->save(); // UnitCost
			$this->Quantity->AdvancedSearch->save(); // Quantity
			$this->UnitOfMeasure->AdvancedSearch->save(); // UnitOfMeasure
			$this->AmountPaid->AdvancedSearch->save(); // AmountPaid
			$this->ReceiptNo->AdvancedSearch->save(); // ReceiptNo
			$this->ReceiptDate->AdvancedSearch->save(); // ReceiptDate
			$this->PaymentMethod->AdvancedSearch->save(); // PaymentMethod
			$this->PaymentRef->AdvancedSearch->save(); // PaymentRef
			$this->AdditionalInformation->AdvancedSearch->save(); // AdditionalInformation
			$this->LastUpdatedBy->AdvancedSearch->save(); // LastUpdatedBy
			$this->LastUpdateDate->AdvancedSearch->save(); // LastUpdateDate
			$this->CashierNo->AdvancedSearch->save(); // CashierNo
			$this->BillPeriod->AdvancedSearch->save(); // BillPeriod
			$this->BillYear->AdvancedSearch->save(); // BillYear
			$this->PaymentFor->AdvancedSearch->save(); // PaymentFor
			$this->ChargeGroup->AdvancedSearch->save(); // ChargeGroup
			$this->ClientID->AdvancedSearch->save(); // ClientID
			$this->PrintedReceipt->AdvancedSearch->save(); // PrintedReceipt
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
		$this->buildBasicSearchSql($where, $this->ItemID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->UnitOfMeasure, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ReceiptNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PaymentMethod, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PaymentRef, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->AdditionalInformation, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->LastUpdatedBy, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PaymentFor, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ChargeGroup, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->ClientID, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->PrintedReceipt, $arKeywords, $type);
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
		if ($this->ClientSerNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ChargeCode->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ItemID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UnitCost->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->Quantity->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AmountPaid->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReceiptNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ReceiptDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PaymentMethod->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PaymentRef->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->AdditionalInformation->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastUpdatedBy->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->LastUpdateDate->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->CashierNo->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BillPeriod->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->BillYear->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PaymentFor->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ChargeGroup->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ClientID->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->PrintedReceipt->AdvancedSearch->issetSession())
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
		$this->ClientSerNo->AdvancedSearch->unsetSession();
		$this->ChargeCode->AdvancedSearch->unsetSession();
		$this->ItemID->AdvancedSearch->unsetSession();
		$this->UnitCost->AdvancedSearch->unsetSession();
		$this->Quantity->AdvancedSearch->unsetSession();
		$this->UnitOfMeasure->AdvancedSearch->unsetSession();
		$this->AmountPaid->AdvancedSearch->unsetSession();
		$this->ReceiptNo->AdvancedSearch->unsetSession();
		$this->ReceiptDate->AdvancedSearch->unsetSession();
		$this->PaymentMethod->AdvancedSearch->unsetSession();
		$this->PaymentRef->AdvancedSearch->unsetSession();
		$this->AdditionalInformation->AdvancedSearch->unsetSession();
		$this->LastUpdatedBy->AdvancedSearch->unsetSession();
		$this->LastUpdateDate->AdvancedSearch->unsetSession();
		$this->CashierNo->AdvancedSearch->unsetSession();
		$this->BillPeriod->AdvancedSearch->unsetSession();
		$this->BillYear->AdvancedSearch->unsetSession();
		$this->PaymentFor->AdvancedSearch->unsetSession();
		$this->ChargeGroup->AdvancedSearch->unsetSession();
		$this->ClientID->AdvancedSearch->unsetSession();
		$this->PrintedReceipt->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ChargeCode->AdvancedSearch->load();
		$this->ItemID->AdvancedSearch->load();
		$this->UnitCost->AdvancedSearch->load();
		$this->Quantity->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AmountPaid->AdvancedSearch->load();
		$this->ReceiptNo->AdvancedSearch->load();
		$this->ReceiptDate->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->PaymentRef->AdvancedSearch->load();
		$this->AdditionalInformation->AdvancedSearch->load();
		$this->LastUpdatedBy->AdvancedSearch->load();
		$this->LastUpdateDate->AdvancedSearch->load();
		$this->CashierNo->AdvancedSearch->load();
		$this->BillPeriod->AdvancedSearch->load();
		$this->BillYear->AdvancedSearch->load();
		$this->PaymentFor->AdvancedSearch->load();
		$this->ChargeGroup->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PrintedReceipt->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->ClientSerNo); // ClientSerNo
			$this->updateSort($this->ChargeCode); // ChargeCode
			$this->updateSort($this->ItemID); // ItemID
			$this->updateSort($this->UnitCost); // UnitCost
			$this->updateSort($this->Quantity); // Quantity
			$this->updateSort($this->UnitOfMeasure); // UnitOfMeasure
			$this->updateSort($this->AmountPaid); // AmountPaid
			$this->updateSort($this->ReceiptNo); // ReceiptNo
			$this->updateSort($this->ReceiptDate); // ReceiptDate
			$this->updateSort($this->PaymentMethod); // PaymentMethod
			$this->updateSort($this->PaymentRef); // PaymentRef
			$this->updateSort($this->CashierNo); // CashierNo
			$this->updateSort($this->BillPeriod); // BillPeriod
			$this->updateSort($this->BillYear); // BillYear
			$this->updateSort($this->ChargeGroup); // ChargeGroup
			$this->updateSort($this->ClientID); // ClientID
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
				$this->ReceiptNo->setSessionValue("");
				$this->PaymentMethod->setSessionValue("");
				$this->ChargeGroup->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
				$this->ClientSerNo->setSort("");
				$this->ChargeCode->setSort("");
				$this->ItemID->setSort("");
				$this->UnitCost->setSort("");
				$this->Quantity->setSort("");
				$this->UnitOfMeasure->setSort("");
				$this->AmountPaid->setSort("");
				$this->ReceiptNo->setSort("");
				$this->ReceiptDate->setSort("");
				$this->PaymentMethod->setSort("");
				$this->PaymentRef->setSort("");
				$this->CashierNo->setSort("");
				$this->BillPeriod->setSort("");
				$this->BillYear->setSort("");
				$this->ChargeGroup->setSort("");
				$this->ClientID->setSort("");
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
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
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
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ClientSerNo->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->ChargeCode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->ItemID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->ReceiptNo->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"freceiptlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"freceiptlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.freceiptlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->ClientSerNo->CurrentValue = NULL;
		$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
		$this->ChargeCode->CurrentValue = NULL;
		$this->ChargeCode->OldValue = $this->ChargeCode->CurrentValue;
		$this->ItemID->CurrentValue = NULL;
		$this->ItemID->OldValue = $this->ItemID->CurrentValue;
		$this->UnitCost->CurrentValue = NULL;
		$this->UnitCost->OldValue = $this->UnitCost->CurrentValue;
		$this->Quantity->CurrentValue = 1;
		$this->Quantity->OldValue = $this->Quantity->CurrentValue;
		$this->UnitOfMeasure->CurrentValue = "Each";
		$this->UnitOfMeasure->OldValue = $this->UnitOfMeasure->CurrentValue;
		$this->AmountPaid->CurrentValue = NULL;
		$this->AmountPaid->OldValue = $this->AmountPaid->CurrentValue;
		$this->ReceiptNo->CurrentValue = NULL;
		$this->ReceiptNo->OldValue = $this->ReceiptNo->CurrentValue;
		$this->ReceiptDate->CurrentValue = NULL;
		$this->ReceiptDate->OldValue = $this->ReceiptDate->CurrentValue;
		$this->PaymentMethod->CurrentValue = NULL;
		$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
		$this->PaymentRef->CurrentValue = NULL;
		$this->PaymentRef->OldValue = $this->PaymentRef->CurrentValue;
		$this->AdditionalInformation->CurrentValue = NULL;
		$this->AdditionalInformation->OldValue = $this->AdditionalInformation->CurrentValue;
		$this->LastUpdatedBy->CurrentValue = NULL;
		$this->LastUpdatedBy->OldValue = $this->LastUpdatedBy->CurrentValue;
		$this->LastUpdateDate->CurrentValue = NULL;
		$this->LastUpdateDate->OldValue = $this->LastUpdateDate->CurrentValue;
		$this->CashierNo->CurrentValue = NULL;
		$this->CashierNo->OldValue = $this->CashierNo->CurrentValue;
		$this->BillPeriod->CurrentValue = NULL;
		$this->BillPeriod->OldValue = $this->BillPeriod->CurrentValue;
		$this->BillYear->CurrentValue = NULL;
		$this->BillYear->OldValue = $this->BillYear->CurrentValue;
		$this->PaymentFor->CurrentValue = NULL;
		$this->PaymentFor->OldValue = $this->PaymentFor->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
		$this->ClientID->CurrentValue = NULL;
		$this->ClientID->OldValue = $this->ClientID->CurrentValue;
		$this->PrintedReceipt->CurrentValue = NULL;
		$this->PrintedReceipt->OldValue = $this->PrintedReceipt->CurrentValue;
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

		// ClientSerNo
		if (!$this->isAddOrEdit() && $this->ClientSerNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientSerNo->AdvancedSearch->SearchValue != "" || $this->ClientSerNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ChargeCode
		if (!$this->isAddOrEdit() && $this->ChargeCode->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ChargeCode->AdvancedSearch->SearchValue != "" || $this->ChargeCode->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ItemID
		if (!$this->isAddOrEdit() && $this->ItemID->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ItemID->AdvancedSearch->SearchValue != "" || $this->ItemID->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// UnitCost
		if (!$this->isAddOrEdit() && $this->UnitCost->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UnitCost->AdvancedSearch->SearchValue != "" || $this->UnitCost->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// Quantity
		if (!$this->isAddOrEdit() && $this->Quantity->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->Quantity->AdvancedSearch->SearchValue != "" || $this->Quantity->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// UnitOfMeasure
		if (!$this->isAddOrEdit() && $this->UnitOfMeasure->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->UnitOfMeasure->AdvancedSearch->SearchValue != "" || $this->UnitOfMeasure->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AmountPaid
		if (!$this->isAddOrEdit() && $this->AmountPaid->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AmountPaid->AdvancedSearch->SearchValue != "" || $this->AmountPaid->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ReceiptNo
		if (!$this->isAddOrEdit() && $this->ReceiptNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ReceiptNo->AdvancedSearch->SearchValue != "" || $this->ReceiptNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// PaymentRef
		if (!$this->isAddOrEdit() && $this->PaymentRef->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PaymentRef->AdvancedSearch->SearchValue != "" || $this->PaymentRef->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// AdditionalInformation
		if (!$this->isAddOrEdit() && $this->AdditionalInformation->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->AdditionalInformation->AdvancedSearch->SearchValue != "" || $this->AdditionalInformation->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
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

		// CashierNo
		if (!$this->isAddOrEdit() && $this->CashierNo->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->CashierNo->AdvancedSearch->SearchValue != "" || $this->CashierNo->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BillPeriod
		if (!$this->isAddOrEdit() && $this->BillPeriod->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BillPeriod->AdvancedSearch->SearchValue != "" || $this->BillPeriod->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// BillYear
		if (!$this->isAddOrEdit() && $this->BillYear->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->BillYear->AdvancedSearch->SearchValue != "" || $this->BillYear->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PaymentFor
		if (!$this->isAddOrEdit() && $this->PaymentFor->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PaymentFor->AdvancedSearch->SearchValue != "" || $this->PaymentFor->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ChargeGroup
		if (!$this->isAddOrEdit() && $this->ChargeGroup->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ChargeGroup->AdvancedSearch->SearchValue != "" || $this->ChargeGroup->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ClientID
		if (!$this->isAddOrEdit() && $this->ClientID->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ClientID->AdvancedSearch->SearchValue != "" || $this->ClientID->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// PrintedReceipt
		if (!$this->isAddOrEdit() && $this->PrintedReceipt->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->PrintedReceipt->AdvancedSearch->SearchValue != "" || $this->PrintedReceipt->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ClientSerNo' first before field var 'x_ClientSerNo'
		$val = $CurrentForm->hasValue("ClientSerNo") ? $CurrentForm->getValue("ClientSerNo") : $CurrentForm->getValue("x_ClientSerNo");
		if (!$this->ClientSerNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientSerNo->Visible = FALSE; // Disable update for API request
			else
				$this->ClientSerNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ClientSerNo"))
			$this->ClientSerNo->setOldValue($CurrentForm->getValue("o_ClientSerNo"));

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeCode"))
			$this->ChargeCode->setOldValue($CurrentForm->getValue("o_ChargeCode"));

		// Check field name 'ItemID' first before field var 'x_ItemID'
		$val = $CurrentForm->hasValue("ItemID") ? $CurrentForm->getValue("ItemID") : $CurrentForm->getValue("x_ItemID");
		if (!$this->ItemID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ItemID->Visible = FALSE; // Disable update for API request
			else
				$this->ItemID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ItemID"))
			$this->ItemID->setOldValue($CurrentForm->getValue("o_ItemID"));

		// Check field name 'UnitCost' first before field var 'x_UnitCost'
		$val = $CurrentForm->hasValue("UnitCost") ? $CurrentForm->getValue("UnitCost") : $CurrentForm->getValue("x_UnitCost");
		if (!$this->UnitCost->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitCost->Visible = FALSE; // Disable update for API request
			else
				$this->UnitCost->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_UnitCost"))
			$this->UnitCost->setOldValue($CurrentForm->getValue("o_UnitCost"));

		// Check field name 'Quantity' first before field var 'x_Quantity'
		$val = $CurrentForm->hasValue("Quantity") ? $CurrentForm->getValue("Quantity") : $CurrentForm->getValue("x_Quantity");
		if (!$this->Quantity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Quantity->Visible = FALSE; // Disable update for API request
			else
				$this->Quantity->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Quantity"))
			$this->Quantity->setOldValue($CurrentForm->getValue("o_Quantity"));

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

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AmountPaid"))
			$this->AmountPaid->setOldValue($CurrentForm->getValue("o_AmountPaid"));

		// Check field name 'ReceiptNo' first before field var 'x_ReceiptNo'
		$val = $CurrentForm->hasValue("ReceiptNo") ? $CurrentForm->getValue("ReceiptNo") : $CurrentForm->getValue("x_ReceiptNo");
		if (!$this->ReceiptNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptNo->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ReceiptNo"))
			$this->ReceiptNo->setOldValue($CurrentForm->getValue("o_ReceiptNo"));

		// Check field name 'ReceiptDate' first before field var 'x_ReceiptDate'
		$val = $CurrentForm->hasValue("ReceiptDate") ? $CurrentForm->getValue("ReceiptDate") : $CurrentForm->getValue("x_ReceiptDate");
		if (!$this->ReceiptDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReceiptDate->Visible = FALSE; // Disable update for API request
			else
				$this->ReceiptDate->setFormValue($val);
			$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 7);
		}
		if ($CurrentForm->hasValue("o_ReceiptDate"))
			$this->ReceiptDate->setOldValue($CurrentForm->getValue("o_ReceiptDate"));

		// Check field name 'PaymentMethod' first before field var 'x_PaymentMethod'
		$val = $CurrentForm->hasValue("PaymentMethod") ? $CurrentForm->getValue("PaymentMethod") : $CurrentForm->getValue("x_PaymentMethod");
		if (!$this->PaymentMethod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentMethod->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentMethod->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PaymentMethod"))
			$this->PaymentMethod->setOldValue($CurrentForm->getValue("o_PaymentMethod"));

		// Check field name 'PaymentRef' first before field var 'x_PaymentRef'
		$val = $CurrentForm->hasValue("PaymentRef") ? $CurrentForm->getValue("PaymentRef") : $CurrentForm->getValue("x_PaymentRef");
		if (!$this->PaymentRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PaymentRef->Visible = FALSE; // Disable update for API request
			else
				$this->PaymentRef->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PaymentRef"))
			$this->PaymentRef->setOldValue($CurrentForm->getValue("o_PaymentRef"));

		// Check field name 'CashierNo' first before field var 'x_CashierNo'
		$val = $CurrentForm->hasValue("CashierNo") ? $CurrentForm->getValue("CashierNo") : $CurrentForm->getValue("x_CashierNo");
		if (!$this->CashierNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CashierNo->Visible = FALSE; // Disable update for API request
			else
				$this->CashierNo->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CashierNo"))
			$this->CashierNo->setOldValue($CurrentForm->getValue("o_CashierNo"));

		// Check field name 'BillPeriod' first before field var 'x_BillPeriod'
		$val = $CurrentForm->hasValue("BillPeriod") ? $CurrentForm->getValue("BillPeriod") : $CurrentForm->getValue("x_BillPeriod");
		if (!$this->BillPeriod->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillPeriod->Visible = FALSE; // Disable update for API request
			else
				$this->BillPeriod->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BillPeriod"))
			$this->BillPeriod->setOldValue($CurrentForm->getValue("o_BillPeriod"));

		// Check field name 'BillYear' first before field var 'x_BillYear'
		$val = $CurrentForm->hasValue("BillYear") ? $CurrentForm->getValue("BillYear") : $CurrentForm->getValue("x_BillYear");
		if (!$this->BillYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BillYear->Visible = FALSE; // Disable update for API request
			else
				$this->BillYear->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BillYear"))
			$this->BillYear->setOldValue($CurrentForm->getValue("o_BillYear"));

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

		// Check field name 'ClientID' first before field var 'x_ClientID'
		$val = $CurrentForm->hasValue("ClientID") ? $CurrentForm->getValue("ClientID") : $CurrentForm->getValue("x_ClientID");
		if (!$this->ClientID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientID->Visible = FALSE; // Disable update for API request
			else
				$this->ClientID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ClientID"))
			$this->ClientID->setOldValue($CurrentForm->getValue("o_ClientID"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ClientSerNo->CurrentValue = $this->ClientSerNo->FormValue;
		$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ItemID->CurrentValue = $this->ItemID->FormValue;
		$this->UnitCost->CurrentValue = $this->UnitCost->FormValue;
		$this->Quantity->CurrentValue = $this->Quantity->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->ReceiptNo->CurrentValue = $this->ReceiptNo->FormValue;
		$this->ReceiptDate->CurrentValue = $this->ReceiptDate->FormValue;
		$this->ReceiptDate->CurrentValue = UnFormatDateTime($this->ReceiptDate->CurrentValue, 7);
		$this->PaymentMethod->CurrentValue = $this->PaymentMethod->FormValue;
		$this->PaymentRef->CurrentValue = $this->PaymentRef->FormValue;
		$this->CashierNo->CurrentValue = $this->CashierNo->FormValue;
		$this->BillPeriod->CurrentValue = $this->BillPeriod->FormValue;
		$this->BillYear->CurrentValue = $this->BillYear->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->ClientID->CurrentValue = $this->ClientID->FormValue;
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
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
		$this->ClientSerNo->setDbValue($row['ClientSerNo']);
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		if (array_key_exists('EV__ChargeCode', $rs->fields)) {
			$this->ChargeCode->VirtualValue = $rs->fields('EV__ChargeCode'); // Set up virtual field value
		} else {
			$this->ChargeCode->VirtualValue = ""; // Clear value
		}
		$this->ItemID->setDbValue($row['ItemID']);
		$this->UnitCost->setDbValue($row['UnitCost']);
		$this->Quantity->setDbValue($row['Quantity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->ReceiptNo->setDbValue($row['ReceiptNo']);
		$this->ReceiptDate->setDbValue($row['ReceiptDate']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->PaymentRef->setDbValue($row['PaymentRef']);
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->LastUpdatedBy->setDbValue($row['LastUpdatedBy']);
		$this->LastUpdateDate->setDbValue($row['LastUpdateDate']);
		$this->CashierNo->setDbValue($row['CashierNo']);
		$this->BillPeriod->setDbValue($row['BillPeriod']);
		$this->BillYear->setDbValue($row['BillYear']);
		$this->PaymentFor->setDbValue($row['PaymentFor']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->ClientID->setDbValue($row['ClientID']);
		$this->PrintedReceipt->setDbValue($row['PrintedReceipt']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ClientSerNo'] = $this->ClientSerNo->CurrentValue;
		$row['ChargeCode'] = $this->ChargeCode->CurrentValue;
		$row['ItemID'] = $this->ItemID->CurrentValue;
		$row['UnitCost'] = $this->UnitCost->CurrentValue;
		$row['Quantity'] = $this->Quantity->CurrentValue;
		$row['UnitOfMeasure'] = $this->UnitOfMeasure->CurrentValue;
		$row['AmountPaid'] = $this->AmountPaid->CurrentValue;
		$row['ReceiptNo'] = $this->ReceiptNo->CurrentValue;
		$row['ReceiptDate'] = $this->ReceiptDate->CurrentValue;
		$row['PaymentMethod'] = $this->PaymentMethod->CurrentValue;
		$row['PaymentRef'] = $this->PaymentRef->CurrentValue;
		$row['AdditionalInformation'] = $this->AdditionalInformation->CurrentValue;
		$row['LastUpdatedBy'] = $this->LastUpdatedBy->CurrentValue;
		$row['LastUpdateDate'] = $this->LastUpdateDate->CurrentValue;
		$row['CashierNo'] = $this->CashierNo->CurrentValue;
		$row['BillPeriod'] = $this->BillPeriod->CurrentValue;
		$row['BillYear'] = $this->BillYear->CurrentValue;
		$row['PaymentFor'] = $this->PaymentFor->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		$row['ClientID'] = $this->ClientID->CurrentValue;
		$row['PrintedReceipt'] = $this->PrintedReceipt->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ClientSerNo")) != "")
			$this->ClientSerNo->OldValue = $this->getKey("ClientSerNo"); // ClientSerNo
		else
			$validKey = FALSE;
		if (strval($this->getKey("ChargeCode")) != "")
			$this->ChargeCode->OldValue = $this->getKey("ChargeCode"); // ChargeCode
		else
			$validKey = FALSE;
		if (strval($this->getKey("ItemID")) != "")
			$this->ItemID->OldValue = $this->getKey("ItemID"); // ItemID
		else
			$validKey = FALSE;
		if (strval($this->getKey("ReceiptNo")) != "")
			$this->ReceiptNo->OldValue = $this->getKey("ReceiptNo"); // ReceiptNo
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
		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ClientSerNo
		// ChargeCode
		// ItemID
		// UnitCost
		// Quantity
		// UnitOfMeasure
		// AmountPaid
		// ReceiptNo
		// ReceiptDate
		// PaymentMethod
		// PaymentRef
		// AdditionalInformation
		// LastUpdatedBy
		// LastUpdateDate
		// CashierNo
		// BillPeriod
		// BillYear
		// PaymentFor
		// ChargeGroup
		// ClientID
		// PrintedReceipt
		// Accumulate aggregate value

		if ($this->RowType != ROWTYPE_AGGREGATEINIT && $this->RowType != ROWTYPE_AGGREGATE) {
			if (is_numeric($this->AmountPaid->CurrentValue))
				$this->AmountPaid->Total += $this->AmountPaid->CurrentValue; // Accumulate total
		}
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ClientSerNo
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

			// ChargeCode
			if ($this->ChargeCode->VirtualValue != "") {
				$this->ChargeCode->ViewValue = $this->ChargeCode->VirtualValue;
			} else {
				$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
				$curVal = strval($this->ChargeCode->CurrentValue);
				if ($curVal != "") {
					$this->ChargeCode->ViewValue = $this->ChargeCode->lookupCacheOption($curVal);
					if ($this->ChargeCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
						}
					}
				} else {
					$this->ChargeCode->ViewValue = NULL;
				}
			}
			$this->ChargeCode->ViewCustomAttributes = "";

			// ItemID
			$this->ItemID->ViewValue = $this->ItemID->CurrentValue;
			$this->ItemID->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->ViewCustomAttributes = "";

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
			$this->Quantity->ViewCustomAttributes = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->CellCssStyle .= "text-align: right;";
			$this->AmountPaid->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$this->ReceiptNo->ViewCustomAttributes = "";

			// ReceiptDate
			$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
			$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 7);
			$this->ReceiptDate->ViewCustomAttributes = "";

			// PaymentMethod
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
					}
				}
			} else {
				$this->PaymentMethod->ViewValue = NULL;
			}
			$this->PaymentMethod->ViewCustomAttributes = "";

			// PaymentRef
			$this->PaymentRef->ViewValue = $this->PaymentRef->CurrentValue;
			$this->PaymentRef->ViewCustomAttributes = "";

			// LastUpdatedBy
			$this->LastUpdatedBy->ViewValue = $this->LastUpdatedBy->CurrentValue;
			$this->LastUpdatedBy->ViewCustomAttributes = "";

			// LastUpdateDate
			$this->LastUpdateDate->ViewValue = $this->LastUpdateDate->CurrentValue;
			$this->LastUpdateDate->ViewValue = FormatDateTime($this->LastUpdateDate->ViewValue, 0);
			$this->LastUpdateDate->ViewCustomAttributes = "";

			// CashierNo
			$this->CashierNo->ViewValue = $this->CashierNo->CurrentValue;
			$this->CashierNo->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewValue = FormatNumber($this->BillPeriod->ViewValue, 0, -2, -2, -2);
			$this->BillPeriod->ViewCustomAttributes = "";

			// BillYear
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewCustomAttributes = "";

			// PaymentFor
			$this->PaymentFor->ViewValue = $this->PaymentFor->CurrentValue;
			$this->PaymentFor->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";
			if (!$this->isExport())
				$this->ChargeCode->ViewValue = $this->highlightValue($this->ChargeCode);

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";
			$this->ItemID->TooltipValue = "";
			if (!$this->isExport())
				$this->ItemID->ViewValue = $this->highlightValue($this->ItemID);

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";
			if (!$this->isExport())
				$this->UnitOfMeasure->ViewValue = $this->highlightValue($this->UnitOfMeasure);

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";
			if (!$this->isExport())
				$this->ReceiptNo->ViewValue = $this->highlightValue($this->ReceiptNo);

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";
			$this->PaymentRef->TooltipValue = "";
			if (!$this->isExport())
				$this->PaymentRef->ViewValue = $this->highlightValue($this->PaymentRef);

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";
			$this->CashierNo->TooltipValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";
			$this->BillPeriod->TooltipValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";
			$this->BillYear->TooltipValue = "";
			if (!$this->isExport())
				$this->BillYear->ViewValue = $this->highlightValue($this->BillYear);

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";
			if (!$this->isExport())
				$this->ChargeGroup->ViewValue = $this->highlightValue($this->ChargeGroup);

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";
			if (!$this->isExport())
				$this->ClientID->ViewValue = $this->highlightValue($this->ClientID);
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ClientSerNo
			$this->ClientSerNo->EditCustomAttributes = "";
			if ($this->ClientSerNo->getSessionValue() != "") {
				$this->ClientSerNo->CurrentValue = $this->ClientSerNo->getSessionValue();
				$this->ClientSerNo->OldValue = $this->ClientSerNo->CurrentValue;
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
			} else {
				$curVal = trim(strval($this->ClientSerNo->CurrentValue));
				if ($curVal != "")
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->lookupCacheOption($curVal);
				else
					$this->ClientSerNo->ViewValue = $this->ClientSerNo->Lookup !== NULL && is_array($this->ClientSerNo->Lookup->Options) ? $curVal : NULL;
				if ($this->ClientSerNo->ViewValue !== NULL) { // Load from cache
					$this->ClientSerNo->EditValue = array_values($this->ClientSerNo->Lookup->Options);
					if ($this->ClientSerNo->ViewValue == "")
						$this->ClientSerNo->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ClientSerNo`" . SearchString("=", $this->ClientSerNo->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ClientSerNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ClientSerNo->ViewValue = $this->ClientSerNo->displayValue($arwrk);
					} else {
						$this->ClientSerNo->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ClientSerNo->EditValue = $arwrk;
				}
			}

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
			$curVal = strval($this->ChargeCode->CurrentValue);
			if ($curVal != "") {
				$this->ChargeCode->EditValue = $this->ChargeCode->lookupCacheOption($curVal);
				if ($this->ChargeCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ChargeCode->EditValue = $this->ChargeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->CurrentValue);
					}
				}
			} else {
				$this->ChargeCode->EditValue = NULL;
			}
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ItemID
			$this->ItemID->EditAttrs["class"] = "form-control";
			$this->ItemID->EditCustomAttributes = "";
			if (!$this->ItemID->Raw)
				$this->ItemID->CurrentValue = HtmlDecode($this->ItemID->CurrentValue);
			$this->ItemID->EditValue = HtmlEncode($this->ItemID->CurrentValue);
			$this->ItemID->PlaceHolder = RemoveHtml($this->ItemID->caption());

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->CurrentValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());
			if (strval($this->UnitCost->EditValue) != "" && is_numeric($this->UnitCost->EditValue)) {
				$this->UnitCost->EditValue = FormatNumber($this->UnitCost->EditValue, -2, -2, -2, -2);
				$this->UnitCost->OldValue = $this->UnitCost->EditValue;
			}
			

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->CurrentValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());
			if (strval($this->Quantity->EditValue) != "" && is_numeric($this->Quantity->EditValue)) {
				$this->Quantity->EditValue = FormatNumber($this->Quantity->EditValue, -2, -2, -2, -2);
				$this->Quantity->OldValue = $this->Quantity->EditValue;
			}
			

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			if (!$this->UnitOfMeasure->Raw)
				$this->UnitOfMeasure->CurrentValue = HtmlDecode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->EditValue = HtmlEncode($this->UnitOfMeasure->CurrentValue);
			$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue)) {
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -2, -2, -2);
				$this->AmountPaid->OldValue = $this->AmountPaid->EditValue;
			}
			

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			if ($this->ReceiptNo->getSessionValue() != "") {
				$this->ReceiptNo->CurrentValue = $this->ReceiptNo->getSessionValue();
				$this->ReceiptNo->OldValue = $this->ReceiptNo->CurrentValue;
				$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
				$this->ReceiptNo->ViewCustomAttributes = "";
			} else {
				$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->CurrentValue);
				$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());
			}

			// ReceiptDate
			// PaymentMethod

			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if ($this->PaymentMethod->getSessionValue() != "") {
				$this->PaymentMethod->CurrentValue = $this->PaymentMethod->getSessionValue();
				$this->PaymentMethod->OldValue = $this->PaymentMethod->CurrentValue;
				$curVal = strval($this->PaymentMethod->CurrentValue);
				if ($curVal != "") {
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
					if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
						}
					}
				} else {
					$this->PaymentMethod->ViewValue = NULL;
				}
				$this->PaymentMethod->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->PaymentMethod->CurrentValue));
				if ($curVal != "")
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				else
					$this->PaymentMethod->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
				if ($this->PaymentMethod->ViewValue !== NULL) { // Load from cache
					$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->PaymentMethod->EditValue = $arwrk;
				}
			}

			// PaymentRef
			$this->PaymentRef->EditAttrs["class"] = "form-control";
			$this->PaymentRef->EditCustomAttributes = "";
			if (!$this->PaymentRef->Raw)
				$this->PaymentRef->CurrentValue = HtmlDecode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->EditValue = HtmlEncode($this->PaymentRef->CurrentValue);
			$this->PaymentRef->PlaceHolder = RemoveHtml($this->PaymentRef->caption());

			// CashierNo
			// BillPeriod

			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->CurrentValue);
			$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			$this->BillYear->EditValue = HtmlEncode($this->BillYear->CurrentValue);
			$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if ($this->ChargeGroup->getSessionValue() != "") {
				$this->ChargeGroup->CurrentValue = $this->ChargeGroup->getSessionValue();
				$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
				$this->ChargeGroup->ViewCustomAttributes = "";
			} else {
				if (!$this->ChargeGroup->Raw)
					$this->ChargeGroup->CurrentValue = HtmlDecode($this->ChargeGroup->CurrentValue);
				$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
				$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->CurrentValue = HtmlDecode($this->ClientID->CurrentValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->CurrentValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// Add refer script
			// ClientSerNo

			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";

			// CashierNo
			$this->CashierNo->LinkCustomAttributes = "";
			$this->CashierNo->HrefValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ClientSerNo
			$this->ClientSerNo->EditAttrs["class"] = "form-control";
			$this->ClientSerNo->EditCustomAttributes = "";

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->AdvancedSearch->SearchValue);
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ItemID
			$this->ItemID->EditAttrs["class"] = "form-control";
			$this->ItemID->EditCustomAttributes = "";
			if (!$this->ItemID->Raw)
				$this->ItemID->AdvancedSearch->SearchValue = HtmlDecode($this->ItemID->AdvancedSearch->SearchValue);
			$this->ItemID->EditValue = HtmlEncode($this->ItemID->AdvancedSearch->SearchValue);
			$this->ItemID->PlaceHolder = RemoveHtml($this->ItemID->caption());

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->AdvancedSearch->SearchValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->AdvancedSearch->SearchValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			if (!$this->UnitOfMeasure->Raw)
				$this->UnitOfMeasure->AdvancedSearch->SearchValue = HtmlDecode($this->UnitOfMeasure->AdvancedSearch->SearchValue);
			$this->UnitOfMeasure->EditValue = HtmlEncode($this->UnitOfMeasure->AdvancedSearch->SearchValue);
			$this->UnitOfMeasure->PlaceHolder = RemoveHtml($this->UnitOfMeasure->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->AdvancedSearch->SearchValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->AdvancedSearch->SearchValue);
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

			// ReceiptDate
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ReceiptDate->AdvancedSearch->SearchValue, 7), 7));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ReceiptDate->AdvancedSearch->SearchValue2, 7), 7));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PaymentMethod->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			else
				$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->PaymentMethod->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PaymentMethod->EditValue = $arwrk;
			}

			// PaymentRef
			$this->PaymentRef->EditAttrs["class"] = "form-control";
			$this->PaymentRef->EditCustomAttributes = "";
			if (!$this->PaymentRef->Raw)
				$this->PaymentRef->AdvancedSearch->SearchValue = HtmlDecode($this->PaymentRef->AdvancedSearch->SearchValue);
			$this->PaymentRef->EditValue = HtmlEncode($this->PaymentRef->AdvancedSearch->SearchValue);
			$this->PaymentRef->PlaceHolder = RemoveHtml($this->PaymentRef->caption());

			// CashierNo
			$this->CashierNo->EditAttrs["class"] = "form-control";
			$this->CashierNo->EditCustomAttributes = "";
			if (!$this->CashierNo->Raw)
				$this->CashierNo->AdvancedSearch->SearchValue = HtmlDecode($this->CashierNo->AdvancedSearch->SearchValue);
			$this->CashierNo->EditValue = HtmlEncode($this->CashierNo->AdvancedSearch->SearchValue);
			$this->CashierNo->PlaceHolder = RemoveHtml($this->CashierNo->caption());

			// BillPeriod
			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->AdvancedSearch->SearchValue);
			$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			$this->BillYear->EditValue = HtmlEncode($this->BillYear->AdvancedSearch->SearchValue);
			$this->BillYear->PlaceHolder = RemoveHtml($this->BillYear->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if (!$this->ChargeGroup->Raw)
				$this->ChargeGroup->AdvancedSearch->SearchValue = HtmlDecode($this->ChargeGroup->AdvancedSearch->SearchValue);
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->AdvancedSearch->SearchValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->AdvancedSearch->SearchValue = HtmlDecode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());
		} elseif ($this->RowType == ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->AmountPaid->Total = 0; // Initialize total
		} elseif ($this->RowType == ROWTYPE_AGGREGATE) { // Aggregate row
			$this->AmountPaid->CurrentValue = $this->AmountPaid->Total;
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->CellCssStyle .= "text-align: right;";
			$this->AmountPaid->ViewCustomAttributes = "";
			$this->AmountPaid->HrefValue = ""; // Clear href value
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
		if (!CheckEuroDate($this->ReceiptDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReceiptDate->errorMessage());
		}
		if (!CheckEuroDate($this->ReceiptDate->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->ReceiptDate->errorMessage());
		}
		if (!CheckInteger($this->BillPeriod->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BillPeriod->errorMessage());
		}
		if (!CheckInteger($this->BillYear->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BillYear->errorMessage());
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
		if ($this->ClientSerNo->Required) {
			if (!$this->ClientSerNo->IsDetailKey && $this->ClientSerNo->FormValue != NULL && $this->ClientSerNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientSerNo->caption(), $this->ClientSerNo->RequiredErrorMessage));
			}
		}
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if ($this->ItemID->Required) {
			if (!$this->ItemID->IsDetailKey && $this->ItemID->FormValue != NULL && $this->ItemID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ItemID->caption(), $this->ItemID->RequiredErrorMessage));
			}
		}
		if ($this->UnitCost->Required) {
			if (!$this->UnitCost->IsDetailKey && $this->UnitCost->FormValue != NULL && $this->UnitCost->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitCost->caption(), $this->UnitCost->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->UnitCost->FormValue)) {
			AddMessage($FormError, $this->UnitCost->errorMessage());
		}
		if ($this->Quantity->Required) {
			if (!$this->Quantity->IsDetailKey && $this->Quantity->FormValue != NULL && $this->Quantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Quantity->caption(), $this->Quantity->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Quantity->FormValue)) {
			AddMessage($FormError, $this->Quantity->errorMessage());
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->ReceiptNo->Required) {
			if (!$this->ReceiptNo->IsDetailKey && $this->ReceiptNo->FormValue != NULL && $this->ReceiptNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptNo->caption(), $this->ReceiptNo->RequiredErrorMessage));
			}
		}
		if ($this->ReceiptDate->Required) {
			if (!$this->ReceiptDate->IsDetailKey && $this->ReceiptDate->FormValue != NULL && $this->ReceiptDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReceiptDate->caption(), $this->ReceiptDate->RequiredErrorMessage));
			}
		}
		if ($this->PaymentMethod->Required) {
			if (!$this->PaymentMethod->IsDetailKey && $this->PaymentMethod->FormValue != NULL && $this->PaymentMethod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentMethod->caption(), $this->PaymentMethod->RequiredErrorMessage));
			}
		}
		if ($this->PaymentRef->Required) {
			if (!$this->PaymentRef->IsDetailKey && $this->PaymentRef->FormValue != NULL && $this->PaymentRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PaymentRef->caption(), $this->PaymentRef->RequiredErrorMessage));
			}
		}
		if ($this->CashierNo->Required) {
			if (!$this->CashierNo->IsDetailKey && $this->CashierNo->FormValue != NULL && $this->CashierNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CashierNo->caption(), $this->CashierNo->RequiredErrorMessage));
			}
		}
		if ($this->BillPeriod->Required) {
			if (!$this->BillPeriod->IsDetailKey && $this->BillPeriod->FormValue != NULL && $this->BillPeriod->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillPeriod->caption(), $this->BillPeriod->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillPeriod->FormValue)) {
			AddMessage($FormError, $this->BillPeriod->errorMessage());
		}
		if ($this->BillYear->Required) {
			if (!$this->BillYear->IsDetailKey && $this->BillYear->FormValue != NULL && $this->BillYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillYear->caption(), $this->BillYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->BillYear->FormValue)) {
			AddMessage($FormError, $this->BillYear->errorMessage());
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if ($this->ClientID->Required) {
			if (!$this->ClientID->IsDetailKey && $this->ClientID->FormValue != NULL && $this->ClientID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientID->caption(), $this->ClientID->RequiredErrorMessage));
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
				$thisKey .= $row['ClientSerNo'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ChargeCode'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ItemID'];
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ReceiptNo'];
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check referential integrity for master table 'receipt'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_receipt_header();
		if (strval($this->ClientSerNo->CurrentValue) != "") {
			$masterFilter = str_replace("@ClientSerNo@", AdjustSql($this->ClientSerNo->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->ReceiptNo->CurrentValue) != "") {
			$masterFilter = str_replace("@ReceiptNo@", AdjustSql($this->ReceiptNo->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->PaymentMethod->CurrentValue) != "") {
			$masterFilter = str_replace("@PaymentMethod@", AdjustSql($this->PaymentMethod->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if (strval($this->ChargeGroup->CurrentValue) != "") {
			$masterFilter = str_replace("@ChargeGroup@", AdjustSql($this->ChargeGroup->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["receipt_header"]))
				$GLOBALS["receipt_header"] = new receipt_header();
			$rsmaster = $GLOBALS["receipt_header"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "receipt_header", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ClientSerNo
		$this->ClientSerNo->setDbValueDef($rsnew, $this->ClientSerNo->CurrentValue, 0, FALSE);

		// ChargeCode
		$this->ChargeCode->setDbValueDef($rsnew, $this->ChargeCode->CurrentValue, 0, FALSE);

		// ItemID
		$this->ItemID->setDbValueDef($rsnew, $this->ItemID->CurrentValue, "", FALSE);

		// UnitCost
		$this->UnitCost->setDbValueDef($rsnew, $this->UnitCost->CurrentValue, NULL, FALSE);

		// Quantity
		$this->Quantity->setDbValueDef($rsnew, $this->Quantity->CurrentValue, NULL, strval($this->Quantity->CurrentValue) == "");

		// UnitOfMeasure
		$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, strval($this->UnitOfMeasure->CurrentValue) == "");

		// AmountPaid
		$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, NULL, FALSE);

		// ReceiptNo
		$this->ReceiptNo->setDbValueDef($rsnew, $this->ReceiptNo->CurrentValue, 0, FALSE);

		// ReceiptDate
		$this->ReceiptDate->CurrentValue = CurrentDate();
		$this->ReceiptDate->setDbValueDef($rsnew, $this->ReceiptDate->CurrentValue, NULL);

		// PaymentMethod
		$this->PaymentMethod->setDbValueDef($rsnew, $this->PaymentMethod->CurrentValue, "", FALSE);

		// PaymentRef
		$this->PaymentRef->setDbValueDef($rsnew, $this->PaymentRef->CurrentValue, NULL, FALSE);

		// CashierNo
		$this->CashierNo->CurrentValue = CurrentUserName();
		$this->CashierNo->setDbValueDef($rsnew, $this->CashierNo->CurrentValue, NULL);

		// BillPeriod
		$this->BillPeriod->setDbValueDef($rsnew, $this->BillPeriod->CurrentValue, NULL, FALSE);

		// BillYear
		$this->BillYear->setDbValueDef($rsnew, $this->BillYear->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, "", FALSE);

		// ClientID
		$this->ClientID->setDbValueDef($rsnew, $this->ClientID->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ClientSerNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ChargeCode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ItemID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['ReceiptNo']) == "") {
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
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ChargeCode->AdvancedSearch->load();
		$this->ItemID->AdvancedSearch->load();
		$this->UnitCost->AdvancedSearch->load();
		$this->Quantity->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AmountPaid->AdvancedSearch->load();
		$this->ReceiptNo->AdvancedSearch->load();
		$this->ReceiptDate->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->PaymentRef->AdvancedSearch->load();
		$this->AdditionalInformation->AdvancedSearch->load();
		$this->LastUpdatedBy->AdvancedSearch->load();
		$this->LastUpdateDate->AdvancedSearch->load();
		$this->CashierNo->AdvancedSearch->load();
		$this->BillPeriod->AdvancedSearch->load();
		$this->BillYear->AdvancedSearch->load();
		$this->PaymentFor->AdvancedSearch->load();
		$this->ChargeGroup->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->PrintedReceipt->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.freceiptlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.freceiptlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.freceiptlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_receipt" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_receipt\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.freceiptlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"freceiptlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"receiptsrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"receipt\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'receiptsrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<a class=\"btn btn-default ew-highlight active\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"freceiptlistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</a>";
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
		if (Config("EXPORT_MASTER_RECORD") && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "receipt_header") {
			global $receipt_header;
			if (!isset($receipt_header))
				$receipt_header = new receipt_header();
			$rsmaster = $receipt_header->loadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if (!$this->isExport("csv") || Config("EXPORT_MASTER_RECORD_FOR_CSV")) {
					$doc->Table = &$receipt_header;
					$receipt_header->exportDocument($doc, $rsmaster);
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
			if ($masterTblVar == "receipt_header") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ClientSerNo", Get("ClientSerNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ClientSerNo->setQueryStringValue($parm);
					$this->ClientSerNo->setQueryStringValue($GLOBALS["receipt_header"]->ClientSerNo->QueryStringValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->QueryStringValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ClientSerNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ReceiptNo", Get("ReceiptNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ReceiptNo->setQueryStringValue($parm);
					$this->ReceiptNo->setQueryStringValue($GLOBALS["receipt_header"]->ReceiptNo->QueryStringValue);
					$this->ReceiptNo->setSessionValue($this->ReceiptNo->QueryStringValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ReceiptNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_PaymentMethod", Get("PaymentMethod"))) !== NULL) {
					$GLOBALS["receipt_header"]->PaymentMethod->setQueryStringValue($parm);
					$this->PaymentMethod->setQueryStringValue($GLOBALS["receipt_header"]->PaymentMethod->QueryStringValue);
					$this->PaymentMethod->setSessionValue($this->PaymentMethod->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ChargeGroup", Get("ChargeGroup"))) !== NULL) {
					$GLOBALS["receipt_header"]->ChargeGroup->setQueryStringValue($parm);
					$this->ChargeGroup->setQueryStringValue($GLOBALS["receipt_header"]->ChargeGroup->QueryStringValue);
					$this->ChargeGroup->setSessionValue($this->ChargeGroup->QueryStringValue);
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
			if ($masterTblVar == "receipt_header") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ClientSerNo", Post("ClientSerNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ClientSerNo->setFormValue($parm);
					$this->ClientSerNo->setFormValue($GLOBALS["receipt_header"]->ClientSerNo->FormValue);
					$this->ClientSerNo->setSessionValue($this->ClientSerNo->FormValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ClientSerNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ReceiptNo", Post("ReceiptNo"))) !== NULL) {
					$GLOBALS["receipt_header"]->ReceiptNo->setFormValue($parm);
					$this->ReceiptNo->setFormValue($GLOBALS["receipt_header"]->ReceiptNo->FormValue);
					$this->ReceiptNo->setSessionValue($this->ReceiptNo->FormValue);
					if (!is_numeric($GLOBALS["receipt_header"]->ReceiptNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_PaymentMethod", Post("PaymentMethod"))) !== NULL) {
					$GLOBALS["receipt_header"]->PaymentMethod->setFormValue($parm);
					$this->PaymentMethod->setFormValue($GLOBALS["receipt_header"]->PaymentMethod->FormValue);
					$this->PaymentMethod->setSessionValue($this->PaymentMethod->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ChargeGroup", Post("ChargeGroup"))) !== NULL) {
					$GLOBALS["receipt_header"]->ChargeGroup->setFormValue($parm);
					$this->ChargeGroup->setFormValue($GLOBALS["receipt_header"]->ChargeGroup->FormValue);
					$this->ChargeGroup->setSessionValue($this->ChargeGroup->FormValue);
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
			if ($masterTblVar != "receipt_header") {
				if ($this->ClientSerNo->CurrentValue == "")
					$this->ClientSerNo->setSessionValue("");
				if ($this->ReceiptNo->CurrentValue == "")
					$this->ReceiptNo->setSessionValue("");
				if ($this->PaymentMethod->CurrentValue == "")
					$this->PaymentMethod->setSessionValue("");
				if ($this->ChargeGroup->CurrentValue == "")
					$this->ChargeGroup->setSessionValue("");
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
				case "x_ChargeCode":
					break;
				case "x_PaymentMethod":
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
						case "x_ChargeCode":
							break;
						case "x_PaymentMethod":
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
		//$this->ListOptions->Items["new"]->Body = "xxx";
		//$this->ChargeCode->CurrentValue = 46)

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