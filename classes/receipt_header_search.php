<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipt_header_search extends receipt_header
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipt_header';

	// Page object name
	public $PageObjName = "receipt_header_search";

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

		// Table object (receipt_header)
		if (!isset($GLOBALS["receipt_header"]) || get_class($GLOBALS["receipt_header"]) == PROJECT_NAMESPACE . "receipt_header") {
			$GLOBALS["receipt_header"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["receipt_header"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipt_header');

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
		global $receipt_header;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipt_header);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "receipt_headerview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ReceiptNo->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
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
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("receipt_headerlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ChargeGroup->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ClientID->setVisibility();
		$this->ClientPostalAddress->setVisibility();
		$this->ClientPhysicalAddress->setVisibility();
		$this->ClientEmail->setVisibility();
		$this->ReceiptPrefix->setVisibility();
		$this->AccountBased->setVisibility();
		$this->Cashier->setVisibility();
		$this->ReceiptNo->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->PaidBy->setVisibility();
		$this->TotalDue->setVisibility();
		$this->AmountTendered->setVisibility();
		$this->Change->setVisibility();
		$this->ClientMessage->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->ChargeGroup);
		$this->setupLookupOptions($this->ClientSerNo);
		$this->setupLookupOptions($this->AccountBased);
		$this->setupLookupOptions($this->PaymentMethod);

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "receipt_headerlist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->ChargeGroup); // ChargeGroup
		$this->buildSearchUrl($srchUrl, $this->ClientSerNo); // ClientSerNo
		$this->buildSearchUrl($srchUrl, $this->ClientID); // ClientID
		$this->buildSearchUrl($srchUrl, $this->ClientPostalAddress); // ClientPostalAddress
		$this->buildSearchUrl($srchUrl, $this->ClientPhysicalAddress); // ClientPhysicalAddress
		$this->buildSearchUrl($srchUrl, $this->ClientEmail); // ClientEmail
		$this->buildSearchUrl($srchUrl, $this->ReceiptPrefix); // ReceiptPrefix
		$this->buildSearchUrl($srchUrl, $this->AccountBased); // AccountBased
		$this->buildSearchUrl($srchUrl, $this->Cashier); // Cashier
		$this->buildSearchUrl($srchUrl, $this->ReceiptNo); // ReceiptNo
		$this->buildSearchUrl($srchUrl, $this->ReceiptDate); // ReceiptDate
		$this->buildSearchUrl($srchUrl, $this->PaymentMethod); // PaymentMethod
		$this->buildSearchUrl($srchUrl, $this->PaidBy); // PaidBy
		$this->buildSearchUrl($srchUrl, $this->TotalDue); // TotalDue
		$this->buildSearchUrl($srchUrl, $this->AmountTendered); // AmountTendered
		$this->buildSearchUrl($srchUrl, $this->Change); // Change
		$this->buildSearchUrl($srchUrl, $this->ClientMessage); // ClientMessage
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->ChargeGroup->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientSerNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientPostalAddress->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientPhysicalAddress->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientEmail->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReceiptPrefix->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AccountBased->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Cashier->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReceiptNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReceiptDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaymentMethod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaidBy->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TotalDue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AmountTendered->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Change->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientMessage->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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
		// ChargeGroup
		// ClientSerNo
		// ClientID
		// ClientPostalAddress
		// ClientPhysicalAddress
		// ClientEmail
		// ReceiptPrefix
		// AccountBased
		// Cashier
		// ReceiptNo
		// ReceiptDate
		// PaymentMethod
		// PaidBy
		// TotalDue
		// AmountTendered
		// Change
		// ClientMessage

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// ClientPostalAddress
			$this->ClientPostalAddress->ViewValue = $this->ClientPostalAddress->CurrentValue;
			$this->ClientPostalAddress->ViewCustomAttributes = "";

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->ViewValue = $this->ClientPhysicalAddress->CurrentValue;
			$this->ClientPhysicalAddress->ViewCustomAttributes = "";

			// ClientEmail
			$this->ClientEmail->ViewValue = $this->ClientEmail->CurrentValue;
			$this->ClientEmail->ViewCustomAttributes = "";

			// ReceiptPrefix
			$this->ReceiptPrefix->ViewValue = $this->ReceiptPrefix->CurrentValue;
			$this->ReceiptPrefix->ViewCustomAttributes = "";

			// AccountBased
			$curVal = strval($this->AccountBased->CurrentValue);
			if ($curVal != "") {
				$this->AccountBased->ViewValue = $this->AccountBased->lookupCacheOption($curVal);
				if ($this->AccountBased->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AccountBased->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountBased->ViewValue = $this->AccountBased->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountBased->ViewValue = $this->AccountBased->CurrentValue;
					}
				}
			} else {
				$this->AccountBased->ViewValue = NULL;
			}
			$this->AccountBased->ViewCustomAttributes = "";

			// Cashier
			$this->Cashier->ViewValue = $this->Cashier->CurrentValue;
			$this->Cashier->ViewCustomAttributes = "";

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// PaidBy
			$this->PaidBy->ViewValue = $this->PaidBy->CurrentValue;
			$this->PaidBy->ViewCustomAttributes = "";

			// TotalDue
			$this->TotalDue->ViewValue = $this->TotalDue->CurrentValue;
			$this->TotalDue->ViewValue = FormatNumber($this->TotalDue->ViewValue, 2, -2, -2, -2);
			$this->TotalDue->ViewCustomAttributes = "";

			// AmountTendered
			$this->AmountTendered->ViewValue = $this->AmountTendered->CurrentValue;
			$this->AmountTendered->ViewValue = FormatNumber($this->AmountTendered->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->AmountTendered->ViewCustomAttributes = "";

			// Change
			$this->Change->ViewValue = $this->Change->CurrentValue;
			$this->Change->ViewValue = FormatNumber($this->Change->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Change->ViewCustomAttributes = "";

			// ClientMessage
			$this->ClientMessage->ViewValue = $this->ClientMessage->CurrentValue;
			$this->ClientMessage->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// ClientPostalAddress
			$this->ClientPostalAddress->LinkCustomAttributes = "";
			$this->ClientPostalAddress->HrefValue = "";
			$this->ClientPostalAddress->TooltipValue = "";

			// ClientPhysicalAddress
			$this->ClientPhysicalAddress->LinkCustomAttributes = "";
			$this->ClientPhysicalAddress->HrefValue = "";
			$this->ClientPhysicalAddress->TooltipValue = "";

			// ClientEmail
			$this->ClientEmail->LinkCustomAttributes = "";
			$this->ClientEmail->HrefValue = "";
			$this->ClientEmail->TooltipValue = "";

			// ReceiptPrefix
			$this->ReceiptPrefix->LinkCustomAttributes = "";
			$this->ReceiptPrefix->HrefValue = "";
			$this->ReceiptPrefix->TooltipValue = "";

			// AccountBased
			$this->AccountBased->LinkCustomAttributes = "";
			$this->AccountBased->HrefValue = "";
			$this->AccountBased->TooltipValue = "";

			// Cashier
			$this->Cashier->LinkCustomAttributes = "";
			$this->Cashier->HrefValue = "";
			$this->Cashier->TooltipValue = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// PaidBy
			$this->PaidBy->LinkCustomAttributes = "";
			$this->PaidBy->HrefValue = "";
			$this->PaidBy->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ChargeGroup
			$this->ChargeGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeGroup->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ChargeGroup->AdvancedSearch->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			else
				$this->ChargeGroup->AdvancedSearch->ViewValue = $this->ChargeGroup->Lookup !== NULL && is_array($this->ChargeGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeGroup->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ChargeGroup->EditValue = array_values($this->ChargeGroup->Lookup->Options);
				if ($this->ChargeGroup->AdvancedSearch->ViewValue == "")
					$this->ChargeGroup->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeGroup`" . SearchString("=", $this->ChargeGroup->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->ChargeGroup->AdvancedSearch->ViewValue = $this->ChargeGroup->displayValue($arwrk);
				} else {
					$this->ChargeGroup->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGroup->EditValue = $arwrk;
			}

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

			// ReceiptPrefix
			$this->ReceiptPrefix->EditAttrs["class"] = "form-control";
			$this->ReceiptPrefix->EditCustomAttributes = "";
			if (!$this->ReceiptPrefix->Raw)
				$this->ReceiptPrefix->AdvancedSearch->SearchValue = HtmlDecode($this->ReceiptPrefix->AdvancedSearch->SearchValue);
			$this->ReceiptPrefix->EditValue = HtmlEncode($this->ReceiptPrefix->AdvancedSearch->SearchValue);
			$this->ReceiptPrefix->PlaceHolder = RemoveHtml($this->ReceiptPrefix->caption());

			// AccountBased
			$this->AccountBased->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountBased->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AccountBased->AdvancedSearch->ViewValue = $this->AccountBased->lookupCacheOption($curVal);
			else
				$this->AccountBased->AdvancedSearch->ViewValue = $this->AccountBased->Lookup !== NULL && is_array($this->AccountBased->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountBased->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AccountBased->EditValue = array_values($this->AccountBased->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->AccountBased->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AccountBased->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountBased->EditValue = $arwrk;
			}

			// Cashier
			$this->Cashier->EditAttrs["class"] = "form-control";
			$this->Cashier->EditCustomAttributes = "";
			if (!$this->Cashier->Raw)
				$this->Cashier->AdvancedSearch->SearchValue = HtmlDecode($this->Cashier->AdvancedSearch->SearchValue);
			$this->Cashier->EditValue = HtmlEncode($this->Cashier->AdvancedSearch->SearchValue);
			$this->Cashier->PlaceHolder = RemoveHtml($this->Cashier->caption());

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
			$this->PaymentMethod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PaymentMethod->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
			else
				$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->Lookup !== NULL && is_array($this->PaymentMethod->Lookup->Options) ? $curVal : NULL;
			if ($this->PaymentMethod->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PaymentMethod->EditValue = array_values($this->PaymentMethod->Lookup->Options);
				if ($this->PaymentMethod->AdvancedSearch->ViewValue == "")
					$this->PaymentMethod->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PaymentMethod`" . SearchString("=", $this->PaymentMethod->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PaymentMethod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->PaymentMethod->AdvancedSearch->ViewValue = $this->PaymentMethod->displayValue($arwrk);
				} else {
					$this->PaymentMethod->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PaymentMethod->EditValue = $arwrk;
			}

			// PaidBy
			$this->PaidBy->EditAttrs["class"] = "form-control";
			$this->PaidBy->EditCustomAttributes = "";
			if (!$this->PaidBy->Raw)
				$this->PaidBy->AdvancedSearch->SearchValue = HtmlDecode($this->PaidBy->AdvancedSearch->SearchValue);
			$this->PaidBy->EditValue = HtmlEncode($this->PaidBy->AdvancedSearch->SearchValue);
			$this->PaidBy->PlaceHolder = RemoveHtml($this->PaidBy->caption());

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
		if (!CheckInteger($this->ReceiptNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReceiptNo->errorMessage());
		}
		if (!CheckEuroDate($this->ReceiptDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReceiptDate->errorMessage());
		}
		if (!CheckEuroDate($this->ReceiptDate->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->ReceiptDate->errorMessage());
		}
		if (!CheckNumber($this->TotalDue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->TotalDue->errorMessage());
		}
		if (!CheckNumber($this->AmountTendered->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AmountTendered->errorMessage());
		}
		if (!CheckNumber($this->Change->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Change->errorMessage());
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
		$this->ChargeGroup->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->ClientPostalAddress->AdvancedSearch->load();
		$this->ClientPhysicalAddress->AdvancedSearch->load();
		$this->ClientEmail->AdvancedSearch->load();
		$this->ReceiptPrefix->AdvancedSearch->load();
		$this->AccountBased->AdvancedSearch->load();
		$this->Cashier->AdvancedSearch->load();
		$this->ReceiptNo->AdvancedSearch->load();
		$this->ReceiptDate->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->PaidBy->AdvancedSearch->load();
		$this->TotalDue->AdvancedSearch->load();
		$this->AmountTendered->AdvancedSearch->load();
		$this->Change->AdvancedSearch->load();
		$this->ClientMessage->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("receipt_headerlist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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
				case "x_ChargeGroup":
					break;
				case "x_ClientSerNo":
					break;
				case "x_AccountBased":
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
						case "x_ChargeGroup":
							break;
						case "x_ClientSerNo":
							break;
						case "x_AccountBased":
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
} // End class
?>