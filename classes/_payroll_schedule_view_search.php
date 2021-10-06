<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class _payroll_schedule_view_search extends _payroll_schedule_view
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'payroll_schedule_view';

	// Page object name
	public $PageObjName = "_payroll_schedule_view_search";

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

		// Table object (_payroll_schedule_view)
		if (!isset($GLOBALS["_payroll_schedule_view"]) || get_class($GLOBALS["_payroll_schedule_view"]) == PROJECT_NAMESPACE . "_payroll_schedule_view") {
			$GLOBALS["_payroll_schedule_view"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["_payroll_schedule_view"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'payroll_schedule_view');

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
		global $_payroll_schedule_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($_payroll_schedule_view);
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
					if ($pageName == "_payroll_schedule_viewview.php")
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
			$key .= @$ar['PayrollPeriod'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['pCode'];
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
					$this->terminate(GetUrl("_payroll_schedule_viewlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LocalAuthority->setVisibility();
		$this->PayrollPeriod->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->PositionName->setVisibility();
		$this->pCode->setVisibility();
		$this->pName->setVisibility();
		$this->Amount->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->BankBranchCode->setVisibility();
		$this->BankAccountNo->setVisibility();
		$this->ThirdPartyPayMethod->setVisibility();
		$this->ThirdPartyBank->setVisibility();
		$this->ThirdPartyAccount->setVisibility();
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
		$this->setupLookupOptions($this->LocalAuthority);
		$this->setupLookupOptions($this->PayrollPeriod);

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
					$srchStr = "_payroll_schedule_viewlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->LocalAuthority); // LocalAuthority
		$this->buildSearchUrl($srchUrl, $this->PayrollPeriod); // PayrollPeriod
		$this->buildSearchUrl($srchUrl, $this->Title); // Title
		$this->buildSearchUrl($srchUrl, $this->Surname); // Surname
		$this->buildSearchUrl($srchUrl, $this->FirstName); // FirstName
		$this->buildSearchUrl($srchUrl, $this->MiddleName); // MiddleName
		$this->buildSearchUrl($srchUrl, $this->PositionName); // PositionName
		$this->buildSearchUrl($srchUrl, $this->pCode); // pCode
		$this->buildSearchUrl($srchUrl, $this->pName); // pName
		$this->buildSearchUrl($srchUrl, $this->Amount); // Amount
		$this->buildSearchUrl($srchUrl, $this->PaymentMethod); // PaymentMethod
		$this->buildSearchUrl($srchUrl, $this->BankBranchCode); // BankBranchCode
		$this->buildSearchUrl($srchUrl, $this->BankAccountNo); // BankAccountNo
		$this->buildSearchUrl($srchUrl, $this->ThirdPartyPayMethod); // ThirdPartyPayMethod
		$this->buildSearchUrl($srchUrl, $this->ThirdPartyBank); // ThirdPartyBank
		$this->buildSearchUrl($srchUrl, $this->ThirdPartyAccount); // ThirdPartyAccount
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
		if ($this->LocalAuthority->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PayrollPeriod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Title->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Surname->AdvancedSearch->post())
			$got = TRUE;
		if ($this->FirstName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MiddleName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PositionName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Amount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PaymentMethod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BankBranchCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BankAccountNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ThirdPartyPayMethod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ThirdPartyBank->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ThirdPartyAccount->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Amount->FormValue == $this->Amount->CurrentValue && is_numeric(ConvertToFloatString($this->Amount->CurrentValue)))
			$this->Amount->CurrentValue = ConvertToFloatString($this->Amount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LocalAuthority
		// PayrollPeriod
		// Title
		// Surname
		// FirstName
		// MiddleName
		// PositionName
		// pCode
		// pName
		// Amount
		// PaymentMethod
		// BankBranchCode
		// BankAccountNo
		// ThirdPartyPayMethod
		// ThirdPartyBank
		// ThirdPartyAccount

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LocalAuthority
			$curVal = strval($this->LocalAuthority->CurrentValue);
			if ($curVal != "") {
				$this->LocalAuthority->ViewValue = $this->LocalAuthority->lookupCacheOption($curVal);
				if ($this->LocalAuthority->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LocalAuthority->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LocalAuthority->ViewValue = $this->LocalAuthority->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LocalAuthority->ViewValue = $this->LocalAuthority->CurrentValue;
					}
				}
			} else {
				$this->LocalAuthority->ViewValue = NULL;
			}
			$this->LocalAuthority->ViewCustomAttributes = "";

			// PayrollPeriod
			$curVal = strval($this->PayrollPeriod->CurrentValue);
			if ($curVal != "") {
				$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
				if ($this->PayrollPeriod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PeriodCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PayrollPeriod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PayrollPeriod->ViewValue = $this->PayrollPeriod->CurrentValue;
					}
				}
			} else {
				$this->PayrollPeriod->ViewValue = NULL;
			}
			$this->PayrollPeriod->ViewCustomAttributes = "";

			// Title
			$this->Title->ViewValue = $this->Title->CurrentValue;
			$this->Title->ViewCustomAttributes = "";

			// Surname
			$this->Surname->ViewValue = $this->Surname->CurrentValue;
			$this->Surname->ViewCustomAttributes = "";

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->ViewCustomAttributes = "";

			// MiddleName
			$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
			$this->MiddleName->ViewCustomAttributes = "";

			// PositionName
			$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
			$this->PositionName->ViewCustomAttributes = "";

			// pCode
			$this->pCode->ViewValue = $this->pCode->CurrentValue;
			$this->pCode->ViewCustomAttributes = "";

			// pName
			$this->pName->ViewValue = $this->pName->CurrentValue;
			$this->pName->ViewCustomAttributes = "";

			// Amount
			$this->Amount->ViewValue = $this->Amount->CurrentValue;
			$this->Amount->ViewValue = FormatNumber($this->Amount->ViewValue, 2, -2, -2, -2);
			$this->Amount->ViewCustomAttributes = "";

			// PaymentMethod
			$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
			$this->PaymentMethod->ViewCustomAttributes = "";

			// BankBranchCode
			$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
			$this->BankBranchCode->ViewCustomAttributes = "";

			// BankAccountNo
			$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
			$this->BankAccountNo->ViewCustomAttributes = "";

			// ThirdPartyPayMethod
			$this->ThirdPartyPayMethod->ViewValue = $this->ThirdPartyPayMethod->CurrentValue;
			$this->ThirdPartyPayMethod->ViewCustomAttributes = "";

			// ThirdPartyBank
			$this->ThirdPartyBank->ViewValue = $this->ThirdPartyBank->CurrentValue;
			$this->ThirdPartyBank->ViewCustomAttributes = "";

			// ThirdPartyAccount
			$this->ThirdPartyAccount->ViewValue = $this->ThirdPartyAccount->CurrentValue;
			$this->ThirdPartyAccount->ViewCustomAttributes = "";

			// LocalAuthority
			$this->LocalAuthority->LinkCustomAttributes = "";
			$this->LocalAuthority->HrefValue = "";
			$this->LocalAuthority->TooltipValue = "";

			// PayrollPeriod
			$this->PayrollPeriod->LinkCustomAttributes = "";
			$this->PayrollPeriod->HrefValue = "";
			$this->PayrollPeriod->TooltipValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";
			$this->Title->TooltipValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";
			$this->Surname->TooltipValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";
			$this->MiddleName->TooltipValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";
			$this->PositionName->TooltipValue = "";

			// pCode
			$this->pCode->LinkCustomAttributes = "";
			$this->pCode->HrefValue = "";
			$this->pCode->TooltipValue = "";

			// pName
			$this->pName->LinkCustomAttributes = "";
			$this->pName->HrefValue = "";
			$this->pName->TooltipValue = "";

			// Amount
			$this->Amount->LinkCustomAttributes = "";
			$this->Amount->HrefValue = "";
			$this->Amount->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";
			$this->BankBranchCode->TooltipValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
			$this->BankAccountNo->TooltipValue = "";

			// ThirdPartyPayMethod
			$this->ThirdPartyPayMethod->LinkCustomAttributes = "";
			$this->ThirdPartyPayMethod->HrefValue = "";
			$this->ThirdPartyPayMethod->TooltipValue = "";

			// ThirdPartyBank
			$this->ThirdPartyBank->LinkCustomAttributes = "";
			$this->ThirdPartyBank->HrefValue = "";
			$this->ThirdPartyBank->TooltipValue = "";

			// ThirdPartyAccount
			$this->ThirdPartyAccount->LinkCustomAttributes = "";
			$this->ThirdPartyAccount->HrefValue = "";
			$this->ThirdPartyAccount->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// LocalAuthority
			$this->LocalAuthority->EditCustomAttributes = "";
			$curVal = trim(strval($this->LocalAuthority->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LocalAuthority->AdvancedSearch->ViewValue = $this->LocalAuthority->lookupCacheOption($curVal);
			else
				$this->LocalAuthority->AdvancedSearch->ViewValue = $this->LocalAuthority->Lookup !== NULL && is_array($this->LocalAuthority->Lookup->Options) ? $curVal : NULL;
			if ($this->LocalAuthority->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LocalAuthority->EditValue = array_values($this->LocalAuthority->Lookup->Options);
				if ($this->LocalAuthority->AdvancedSearch->ViewValue == "")
					$this->LocalAuthority->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LocalAuthority->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LocalAuthority->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->LocalAuthority->AdvancedSearch->ViewValue = $this->LocalAuthority->displayValue($arwrk);
				} else {
					$this->LocalAuthority->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LocalAuthority->EditValue = $arwrk;
			}

			// PayrollPeriod
			$this->PayrollPeriod->EditCustomAttributes = "";
			$curVal = trim(strval($this->PayrollPeriod->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PayrollPeriod->AdvancedSearch->ViewValue = $this->PayrollPeriod->lookupCacheOption($curVal);
			else
				$this->PayrollPeriod->AdvancedSearch->ViewValue = $this->PayrollPeriod->Lookup !== NULL && is_array($this->PayrollPeriod->Lookup->Options) ? $curVal : NULL;
			if ($this->PayrollPeriod->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PayrollPeriod->EditValue = array_values($this->PayrollPeriod->Lookup->Options);
				if ($this->PayrollPeriod->AdvancedSearch->ViewValue == "")
					$this->PayrollPeriod->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PeriodCode`" . SearchString("=", $this->PayrollPeriod->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PayrollPeriod->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
					$this->PayrollPeriod->AdvancedSearch->ViewValue = $this->PayrollPeriod->displayValue($arwrk);
				} else {
					$this->PayrollPeriod->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PayrollPeriod->EditValue = $arwrk;
			}

			// Title
			$this->Title->EditAttrs["class"] = "form-control";
			$this->Title->EditCustomAttributes = "";
			if (!$this->Title->Raw)
				$this->Title->AdvancedSearch->SearchValue = HtmlDecode($this->Title->AdvancedSearch->SearchValue);
			$this->Title->EditValue = HtmlEncode($this->Title->AdvancedSearch->SearchValue);
			$this->Title->PlaceHolder = RemoveHtml($this->Title->caption());

			// Surname
			$this->Surname->EditAttrs["class"] = "form-control";
			$this->Surname->EditCustomAttributes = "";
			if (!$this->Surname->Raw)
				$this->Surname->AdvancedSearch->SearchValue = HtmlDecode($this->Surname->AdvancedSearch->SearchValue);
			$this->Surname->EditValue = HtmlEncode($this->Surname->AdvancedSearch->SearchValue);
			$this->Surname->PlaceHolder = RemoveHtml($this->Surname->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->AdvancedSearch->SearchValue = HtmlDecode($this->FirstName->AdvancedSearch->SearchValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->AdvancedSearch->SearchValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// MiddleName
			$this->MiddleName->EditAttrs["class"] = "form-control";
			$this->MiddleName->EditCustomAttributes = "";
			if (!$this->MiddleName->Raw)
				$this->MiddleName->AdvancedSearch->SearchValue = HtmlDecode($this->MiddleName->AdvancedSearch->SearchValue);
			$this->MiddleName->EditValue = HtmlEncode($this->MiddleName->AdvancedSearch->SearchValue);
			$this->MiddleName->PlaceHolder = RemoveHtml($this->MiddleName->caption());

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->AdvancedSearch->SearchValue = HtmlDecode($this->PositionName->AdvancedSearch->SearchValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->AdvancedSearch->SearchValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// pCode
			$this->pCode->EditAttrs["class"] = "form-control";
			$this->pCode->EditCustomAttributes = "";
			if (!$this->pCode->Raw)
				$this->pCode->AdvancedSearch->SearchValue = HtmlDecode($this->pCode->AdvancedSearch->SearchValue);
			$this->pCode->EditValue = HtmlEncode($this->pCode->AdvancedSearch->SearchValue);
			$this->pCode->PlaceHolder = RemoveHtml($this->pCode->caption());

			// pName
			$this->pName->EditAttrs["class"] = "form-control";
			$this->pName->EditCustomAttributes = "";
			if (!$this->pName->Raw)
				$this->pName->AdvancedSearch->SearchValue = HtmlDecode($this->pName->AdvancedSearch->SearchValue);
			$this->pName->EditValue = HtmlEncode($this->pName->AdvancedSearch->SearchValue);
			$this->pName->PlaceHolder = RemoveHtml($this->pName->caption());

			// Amount
			$this->Amount->EditAttrs["class"] = "form-control";
			$this->Amount->EditCustomAttributes = "";
			$this->Amount->EditValue = HtmlEncode($this->Amount->AdvancedSearch->SearchValue);
			$this->Amount->PlaceHolder = RemoveHtml($this->Amount->caption());

			// PaymentMethod
			$this->PaymentMethod->EditAttrs["class"] = "form-control";
			$this->PaymentMethod->EditCustomAttributes = "";
			if (!$this->PaymentMethod->Raw)
				$this->PaymentMethod->AdvancedSearch->SearchValue = HtmlDecode($this->PaymentMethod->AdvancedSearch->SearchValue);
			$this->PaymentMethod->EditValue = HtmlEncode($this->PaymentMethod->AdvancedSearch->SearchValue);
			$this->PaymentMethod->PlaceHolder = RemoveHtml($this->PaymentMethod->caption());

			// BankBranchCode
			$this->BankBranchCode->EditAttrs["class"] = "form-control";
			$this->BankBranchCode->EditCustomAttributes = "";
			if (!$this->BankBranchCode->Raw)
				$this->BankBranchCode->AdvancedSearch->SearchValue = HtmlDecode($this->BankBranchCode->AdvancedSearch->SearchValue);
			$this->BankBranchCode->EditValue = HtmlEncode($this->BankBranchCode->AdvancedSearch->SearchValue);
			$this->BankBranchCode->PlaceHolder = RemoveHtml($this->BankBranchCode->caption());

			// BankAccountNo
			$this->BankAccountNo->EditAttrs["class"] = "form-control";
			$this->BankAccountNo->EditCustomAttributes = "";
			if (!$this->BankAccountNo->Raw)
				$this->BankAccountNo->AdvancedSearch->SearchValue = HtmlDecode($this->BankAccountNo->AdvancedSearch->SearchValue);
			$this->BankAccountNo->EditValue = HtmlEncode($this->BankAccountNo->AdvancedSearch->SearchValue);
			$this->BankAccountNo->PlaceHolder = RemoveHtml($this->BankAccountNo->caption());

			// ThirdPartyPayMethod
			$this->ThirdPartyPayMethod->EditAttrs["class"] = "form-control";
			$this->ThirdPartyPayMethod->EditCustomAttributes = "";
			if (!$this->ThirdPartyPayMethod->Raw)
				$this->ThirdPartyPayMethod->AdvancedSearch->SearchValue = HtmlDecode($this->ThirdPartyPayMethod->AdvancedSearch->SearchValue);
			$this->ThirdPartyPayMethod->EditValue = HtmlEncode($this->ThirdPartyPayMethod->AdvancedSearch->SearchValue);
			$this->ThirdPartyPayMethod->PlaceHolder = RemoveHtml($this->ThirdPartyPayMethod->caption());

			// ThirdPartyBank
			$this->ThirdPartyBank->EditAttrs["class"] = "form-control";
			$this->ThirdPartyBank->EditCustomAttributes = "";
			if (!$this->ThirdPartyBank->Raw)
				$this->ThirdPartyBank->AdvancedSearch->SearchValue = HtmlDecode($this->ThirdPartyBank->AdvancedSearch->SearchValue);
			$this->ThirdPartyBank->EditValue = HtmlEncode($this->ThirdPartyBank->AdvancedSearch->SearchValue);
			$this->ThirdPartyBank->PlaceHolder = RemoveHtml($this->ThirdPartyBank->caption());

			// ThirdPartyAccount
			$this->ThirdPartyAccount->EditAttrs["class"] = "form-control";
			$this->ThirdPartyAccount->EditCustomAttributes = "";
			if (!$this->ThirdPartyAccount->Raw)
				$this->ThirdPartyAccount->AdvancedSearch->SearchValue = HtmlDecode($this->ThirdPartyAccount->AdvancedSearch->SearchValue);
			$this->ThirdPartyAccount->EditValue = HtmlEncode($this->ThirdPartyAccount->AdvancedSearch->SearchValue);
			$this->ThirdPartyAccount->PlaceHolder = RemoveHtml($this->ThirdPartyAccount->caption());
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
		if (!CheckNumber($this->Amount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Amount->errorMessage());
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
		$this->LocalAuthority->AdvancedSearch->load();
		$this->PayrollPeriod->AdvancedSearch->load();
		$this->Title->AdvancedSearch->load();
		$this->Surname->AdvancedSearch->load();
		$this->FirstName->AdvancedSearch->load();
		$this->MiddleName->AdvancedSearch->load();
		$this->PositionName->AdvancedSearch->load();
		$this->pCode->AdvancedSearch->load();
		$this->pName->AdvancedSearch->load();
		$this->Amount->AdvancedSearch->load();
		$this->PaymentMethod->AdvancedSearch->load();
		$this->BankBranchCode->AdvancedSearch->load();
		$this->BankAccountNo->AdvancedSearch->load();
		$this->ThirdPartyPayMethod->AdvancedSearch->load();
		$this->ThirdPartyBank->AdvancedSearch->load();
		$this->ThirdPartyAccount->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("_payroll_schedule_viewlist.php"), "", $this->TableVar, TRUE);
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
				case "x_LocalAuthority":
					break;
				case "x_PayrollPeriod":
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
						case "x_LocalAuthority":
							break;
						case "x_PayrollPeriod":
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