<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class receipts_view_search extends receipts_view
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'receipts_view';

	// Page object name
	public $PageObjName = "receipts_view_search";

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

		// Table object (receipts_view)
		if (!isset($GLOBALS["receipts_view"]) || get_class($GLOBALS["receipts_view"]) == PROJECT_NAMESPACE . "receipts_view") {
			$GLOBALS["receipts_view"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["receipts_view"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (_property_account_view)
		if (!isset($GLOBALS['_property_account_view']))
			$GLOBALS['_property_account_view'] = new _property_account_view();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'receipts_view');

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
		global $receipts_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($receipts_view);
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
					if ($pageName == "receipts_viewview.php")
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
			$key .= @$ar['ReceiptNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ClientSerNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ChargeCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ItemID'];
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
					$this->terminate(GetUrl("receipts_viewlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ReceiptNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ReceiptDate->setVisibility();
		$this->ItemID->setVisibility();
		$this->UnitCost->setVisibility();
		$this->Quantity->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->PaymentRef->setVisibility();
		$this->CashierNo->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->BillYear->setVisibility();
		$this->PaymentFor->setVisibility();
		$this->AdditionalInformation->setVisibility();
		$this->ChargeGroup->setVisibility();
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
		$this->setupLookupOptions($this->ClientSerNo);
		$this->setupLookupOptions($this->ChargeCode);
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
					$srchStr = "receipts_viewlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->ReceiptNo); // ReceiptNo
		$this->buildSearchUrl($srchUrl, $this->ClientSerNo); // ClientSerNo
		$this->buildSearchUrl($srchUrl, $this->ChargeCode); // ChargeCode
		$this->buildSearchUrl($srchUrl, $this->ReceiptDate); // ReceiptDate
		$this->buildSearchUrl($srchUrl, $this->ItemID); // ItemID
		$this->buildSearchUrl($srchUrl, $this->UnitCost); // UnitCost
		$this->buildSearchUrl($srchUrl, $this->Quantity); // Quantity
		$this->buildSearchUrl($srchUrl, $this->UnitOfMeasure); // UnitOfMeasure
		$this->buildSearchUrl($srchUrl, $this->AmountPaid); // AmountPaid
		$this->buildSearchUrl($srchUrl, $this->PaymentMethod); // PaymentMethod
		$this->buildSearchUrl($srchUrl, $this->PaymentRef); // PaymentRef
		$this->buildSearchUrl($srchUrl, $this->CashierNo); // CashierNo
		$this->buildSearchUrl($srchUrl, $this->BillPeriod); // BillPeriod
		$this->buildSearchUrl($srchUrl, $this->BillYear); // BillYear
		$this->buildSearchUrl($srchUrl, $this->PaymentFor); // PaymentFor
		$this->buildSearchUrl($srchUrl, $this->AdditionalInformation); // AdditionalInformation
		$this->buildSearchUrl($srchUrl, $this->ChargeGroup); // ChargeGroup
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
		if ($this->ReceiptNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientSerNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ChargeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReceiptDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ItemID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->UnitCost->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Quantity->AdvancedSearch->post())
			$got = TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AmountPaid->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaymentMethod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaymentRef->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CashierNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BillPeriod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BillYear->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaymentFor->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AdditionalInformation->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ChargeGroup->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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
		// ReceiptNo
		// ClientSerNo
		// ChargeCode
		// ReceiptDate
		// ItemID
		// UnitCost
		// Quantity
		// UnitOfMeasure
		// AmountPaid
		// PaymentMethod
		// PaymentRef
		// CashierNo
		// BillPeriod
		// BillYear
		// PaymentFor
		// AdditionalInformation
		// ChargeGroup

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ReceiptNo
			$this->ReceiptNo->ViewValue = $this->ReceiptNo->CurrentValue;
			$this->ReceiptNo->ViewCustomAttributes = "";

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

			// ChargeCode
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
						$arwrk[2] = $rswrk->fields('df2');
						$this->ChargeCode->ViewValue = $this->ChargeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
					}
				}
			} else {
				$this->ChargeCode->ViewValue = NULL;
			}
			$this->ChargeCode->ViewCustomAttributes = "";

			// ReceiptDate
			$this->ReceiptDate->ViewValue = $this->ReceiptDate->CurrentValue;
			$this->ReceiptDate->ViewValue = FormatDateTime($this->ReceiptDate->ViewValue, 0);
			$this->ReceiptDate->ViewCustomAttributes = "";

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
			$this->AmountPaid->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
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

			// CashierNo
			$this->CashierNo->ViewValue = $this->CashierNo->CurrentValue;
			$this->CashierNo->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewCustomAttributes = "";

			// BillYear
			$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
			$this->BillYear->ViewCustomAttributes = "";

			// PaymentFor
			$this->PaymentFor->ViewValue = $this->PaymentFor->CurrentValue;
			$this->PaymentFor->ViewCustomAttributes = "";

			// AdditionalInformation
			$this->AdditionalInformation->ViewValue = $this->AdditionalInformation->CurrentValue;
			$this->AdditionalInformation->ViewCustomAttributes = "";

			// ChargeGroup
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ReceiptNo
			$this->ReceiptNo->LinkCustomAttributes = "";
			$this->ReceiptNo->HrefValue = "";
			$this->ReceiptNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ReceiptDate
			$this->ReceiptDate->LinkCustomAttributes = "";
			$this->ReceiptDate->HrefValue = "";
			$this->ReceiptDate->TooltipValue = "";

			// ItemID
			$this->ItemID->LinkCustomAttributes = "";
			$this->ItemID->HrefValue = "";
			$this->ItemID->TooltipValue = "";

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

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// PaymentRef
			$this->PaymentRef->LinkCustomAttributes = "";
			$this->PaymentRef->HrefValue = "";
			$this->PaymentRef->TooltipValue = "";

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

			// PaymentFor
			$this->PaymentFor->LinkCustomAttributes = "";
			$this->PaymentFor->HrefValue = "";
			$this->PaymentFor->TooltipValue = "";

			// AdditionalInformation
			$this->AdditionalInformation->LinkCustomAttributes = "";
			$this->AdditionalInformation->HrefValue = "";
			$this->AdditionalInformation->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ReceiptNo
			$this->ReceiptNo->EditAttrs["class"] = "form-control";
			$this->ReceiptNo->EditCustomAttributes = "";
			$this->ReceiptNo->EditValue = HtmlEncode($this->ReceiptNo->AdvancedSearch->SearchValue);
			$this->ReceiptNo->PlaceHolder = RemoveHtml($this->ReceiptNo->caption());

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

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->ChargeCode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ChargeCode->EditValue = $this->ChargeCode->lookupCacheOption($curVal);
				if ($this->ChargeCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ChargeCode->EditValue = $this->ChargeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeCode->EditValue = HtmlEncode($this->ChargeCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ChargeCode->EditValue = NULL;
			}
			$this->ChargeCode->PlaceHolder = RemoveHtml($this->ChargeCode->caption());

			// ReceiptDate
			$this->ReceiptDate->EditAttrs["class"] = "form-control";
			$this->ReceiptDate->EditCustomAttributes = "";
			$this->ReceiptDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ReceiptDate->AdvancedSearch->SearchValue, 0), 8));
			$this->ReceiptDate->PlaceHolder = RemoveHtml($this->ReceiptDate->caption());

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

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->AdvancedSearch->SearchValue = HtmlDecode($this->PaymentMethod->AdvancedSearch->SearchValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->AdvancedSearch->SearchValue);
			$curVal = strval($this->PaymentMethod->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->PaymentMethod->EditValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->EditValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PaymentMethod->EditValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->PaymentMethod->EditValue = NULL;
			}
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

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

			// PaymentFor
			$this->PaymentFor->EditAttrs["class"] = "form-control";
			$this->PaymentFor->EditCustomAttributes = "";
			if (!$this->PaymentFor->Raw)
				$this->PaymentFor->AdvancedSearch->SearchValue = HtmlDecode($this->PaymentFor->AdvancedSearch->SearchValue);
			$this->PaymentFor->EditValue = HtmlEncode($this->PaymentFor->AdvancedSearch->SearchValue);
			$this->PaymentFor->PlaceHolder = RemoveHtml($this->PaymentFor->caption());

			// AdditionalInformation
			$this->AdditionalInformation->EditAttrs["class"] = "form-control";
			$this->AdditionalInformation->EditCustomAttributes = "";
			$this->AdditionalInformation->EditValue = HtmlEncode($this->AdditionalInformation->AdvancedSearch->SearchValue);
			$this->AdditionalInformation->PlaceHolder = RemoveHtml($this->AdditionalInformation->caption());

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			if (!$this->ChargeGroup->Raw)
				$this->ChargeGroup->AdvancedSearch->SearchValue = HtmlDecode($this->ChargeGroup->AdvancedSearch->SearchValue);
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->AdvancedSearch->SearchValue);
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());
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
		if (!CheckInteger($this->ReceiptNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReceiptNo->errorMessage());
		}
		if (!CheckInteger($this->ClientSerNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ClientSerNo->errorMessage());
		}
		if (!CheckInteger($this->ChargeCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ChargeCode->errorMessage());
		}
		if (!CheckDate($this->ReceiptDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReceiptDate->errorMessage());
		}
		if (!CheckNumber($this->UnitCost->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->UnitCost->errorMessage());
		}
		if (!CheckNumber($this->Quantity->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Quantity->errorMessage());
		}
		if (!CheckNumber($this->AmountPaid->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AmountPaid->errorMessage());
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

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->ReceiptNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->ChargeCode->AdvancedSearch->load();
		$this->ReceiptDate->AdvancedSearch->load();
		$this->ItemID->AdvancedSearch->load();
		$this->UnitCost->AdvancedSearch->load();
		$this->Quantity->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AmountPaid->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->PaymentRef->AdvancedSearch->load();
		$this->CashierNo->AdvancedSearch->load();
		$this->BillPeriod->AdvancedSearch->load();
		$this->BillYear->AdvancedSearch->load();
		$this->PaymentFor->AdvancedSearch->load();
		$this->AdditionalInformation->AdvancedSearch->load();
		$this->ChargeGroup->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("receipts_viewlist.php"), "", $this->TableVar, TRUE);
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