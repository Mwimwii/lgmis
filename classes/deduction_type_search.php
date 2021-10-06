<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class deduction_type_search extends deduction_type
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'deduction_type';

	// Page object name
	public $PageObjName = "deduction_type_search";

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

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "deduction_typeview.php")
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
					$this->terminate(GetUrl("deduction_typelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
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
		$this->setupLookupOptions($this->Division);
		$this->setupLookupOptions($this->AccountNo);
		$this->setupLookupOptions($this->BaseIncomeCode);
		$this->setupLookupOptions($this->BaseDeductionCode);
		$this->setupLookupOptions($this->TaxExempt);
		$this->setupLookupOptions($this->JobCode);
		$this->setupLookupOptions($this->Application);

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
					$srchStr = "deduction_typelist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->DeductionCode); // DeductionCode
		$this->buildSearchUrl($srchUrl, $this->DeductionName); // DeductionName
		$this->buildSearchUrl($srchUrl, $this->DeductionDescription); // DeductionDescription
		$this->buildSearchUrl($srchUrl, $this->Division); // Division
		$this->buildSearchUrl($srchUrl, $this->DeductionAmount); // DeductionAmount
		$this->buildSearchUrl($srchUrl, $this->DeductionBasicRate); // DeductionBasicRate
		$this->buildSearchUrl($srchUrl, $this->RemittedTo); // RemittedTo
		$this->buildSearchUrl($srchUrl, $this->AccountNo); // AccountNo
		$this->buildSearchUrl($srchUrl, $this->BaseIncomeCode); // BaseIncomeCode
		$this->buildSearchUrl($srchUrl, $this->BaseDeductionCode); // BaseDeductionCode
		$this->buildSearchUrl($srchUrl, $this->TaxExempt); // TaxExempt
		$this->buildSearchUrl($srchUrl, $this->JobCode); // JobCode
		$this->buildSearchUrl($srchUrl, $this->MinimumAmount); // MinimumAmount
		$this->buildSearchUrl($srchUrl, $this->MaximumAmount); // MaximumAmount
		$this->buildSearchUrl($srchUrl, $this->EmployerContributionRate); // EmployerContributionRate
		$this->buildSearchUrl($srchUrl, $this->EmployerContributionAmount); // EmployerContributionAmount
		$this->buildSearchUrl($srchUrl, $this->Application); // Application
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
		if ($this->DeductionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DeductionName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DeductionDescription->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Division->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->Division->AdvancedSearch->SearchValue))
			$this->Division->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Division->AdvancedSearch->SearchValue);
		if (is_array($this->Division->AdvancedSearch->SearchValue2))
			$this->Division->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Division->AdvancedSearch->SearchValue2);
		if ($this->DeductionAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DeductionBasicRate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->RemittedTo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AccountNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BaseIncomeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BaseDeductionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TaxExempt->AdvancedSearch->post())
			$got = TRUE;
		if ($this->JobCode->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->JobCode->AdvancedSearch->SearchValue))
			$this->JobCode->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobCode->AdvancedSearch->SearchValue);
		if (is_array($this->JobCode->AdvancedSearch->SearchValue2))
			$this->JobCode->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobCode->AdvancedSearch->SearchValue2);
		if ($this->MinimumAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MaximumAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->EmployerContributionRate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->EmployerContributionAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Application->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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

			// DeductionName
			$this->DeductionName->LinkCustomAttributes = "";
			$this->DeductionName->HrefValue = "";
			$this->DeductionName->TooltipValue = "";

			// DeductionDescription
			$this->DeductionDescription->LinkCustomAttributes = "";
			$this->DeductionDescription->HrefValue = "";
			$this->DeductionDescription->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// DeductionCode
			$this->DeductionCode->EditAttrs["class"] = "form-control";
			$this->DeductionCode->EditCustomAttributes = "";
			$this->DeductionCode->EditValue = HtmlEncode($this->DeductionCode->AdvancedSearch->SearchValue);
			$this->DeductionCode->PlaceHolder = RemoveHtml($this->DeductionCode->caption());

			// DeductionName
			$this->DeductionName->EditAttrs["class"] = "form-control";
			$this->DeductionName->EditCustomAttributes = "";
			if (!$this->DeductionName->Raw)
				$this->DeductionName->AdvancedSearch->SearchValue = HtmlDecode($this->DeductionName->AdvancedSearch->SearchValue);
			$this->DeductionName->EditValue = HtmlEncode($this->DeductionName->AdvancedSearch->SearchValue);
			$this->DeductionName->PlaceHolder = RemoveHtml($this->DeductionName->caption());

			// DeductionDescription
			$this->DeductionDescription->EditAttrs["class"] = "form-control";
			$this->DeductionDescription->EditCustomAttributes = "";
			$this->DeductionDescription->EditValue = HtmlEncode($this->DeductionDescription->AdvancedSearch->SearchValue);
			$this->DeductionDescription->PlaceHolder = RemoveHtml($this->DeductionDescription->caption());

			// Division
			$this->Division->EditCustomAttributes = "";
			$curVal = trim(strval($this->Division->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Division->AdvancedSearch->ViewValue = $this->Division->lookupCacheOption($curVal);
			else
				$this->Division->AdvancedSearch->ViewValue = $this->Division->Lookup !== NULL && is_array($this->Division->Lookup->Options) ? $curVal : NULL;
			if ($this->Division->AdvancedSearch->ViewValue !== NULL) { // Load from cache
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
			$this->DeductionAmount->EditValue = HtmlEncode($this->DeductionAmount->AdvancedSearch->SearchValue);
			$this->DeductionAmount->PlaceHolder = RemoveHtml($this->DeductionAmount->caption());

			// DeductionBasicRate
			$this->DeductionBasicRate->EditAttrs["class"] = "form-control";
			$this->DeductionBasicRate->EditCustomAttributes = "";
			$this->DeductionBasicRate->EditValue = HtmlEncode($this->DeductionBasicRate->AdvancedSearch->SearchValue);
			$this->DeductionBasicRate->PlaceHolder = RemoveHtml($this->DeductionBasicRate->caption());

			// RemittedTo
			$this->RemittedTo->EditAttrs["class"] = "form-control";
			$this->RemittedTo->EditCustomAttributes = "";
			if (!$this->RemittedTo->Raw)
				$this->RemittedTo->AdvancedSearch->SearchValue = HtmlDecode($this->RemittedTo->AdvancedSearch->SearchValue);
			$this->RemittedTo->EditValue = HtmlEncode($this->RemittedTo->AdvancedSearch->SearchValue);
			$this->RemittedTo->PlaceHolder = RemoveHtml($this->RemittedTo->caption());

			// AccountNo
			$this->AccountNo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountNo->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AccountNo->AdvancedSearch->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			else
				$this->AccountNo->AdvancedSearch->ViewValue = $this->AccountNo->Lookup !== NULL && is_array($this->AccountNo->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountNo->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AccountNo->EditValue = array_values($this->AccountNo->Lookup->Options);
				if ($this->AccountNo->AdvancedSearch->ViewValue == "")
					$this->AccountNo->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountNo->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->AccountNo->AdvancedSearch->ViewValue = $this->AccountNo->displayValue($arwrk);
				} else {
					$this->AccountNo->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountNo->EditValue = $arwrk;
			}

			// BaseIncomeCode
			$this->BaseIncomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseIncomeCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->BaseIncomeCode->AdvancedSearch->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			else
				$this->BaseIncomeCode->AdvancedSearch->ViewValue = $this->BaseIncomeCode->Lookup !== NULL && is_array($this->BaseIncomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseIncomeCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->BaseIncomeCode->EditValue = array_values($this->BaseIncomeCode->Lookup->Options);
				if ($this->BaseIncomeCode->AdvancedSearch->ViewValue == "")
					$this->BaseIncomeCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IncomeCode`" . SearchString("=", $this->BaseIncomeCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseIncomeCode->AdvancedSearch->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
				} else {
					$this->BaseIncomeCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseIncomeCode->EditValue = $arwrk;
			}

			// BaseDeductionCode
			$this->BaseDeductionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseDeductionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->BaseDeductionCode->AdvancedSearch->ViewValue = $this->BaseDeductionCode->lookupCacheOption($curVal);
			else
				$this->BaseDeductionCode->AdvancedSearch->ViewValue = $this->BaseDeductionCode->Lookup !== NULL && is_array($this->BaseDeductionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseDeductionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->BaseDeductionCode->EditValue = array_values($this->BaseDeductionCode->Lookup->Options);
				if ($this->BaseDeductionCode->AdvancedSearch->ViewValue == "")
					$this->BaseDeductionCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DeductionCode`" . SearchString("=", $this->BaseDeductionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseDeductionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseDeductionCode->AdvancedSearch->ViewValue = $this->BaseDeductionCode->displayValue($arwrk);
				} else {
					$this->BaseDeductionCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseDeductionCode->EditValue = $arwrk;
			}

			// TaxExempt
			$this->TaxExempt->EditAttrs["class"] = "form-control";
			$this->TaxExempt->EditCustomAttributes = "";
			$curVal = trim(strval($this->TaxExempt->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->TaxExempt->AdvancedSearch->ViewValue = $this->TaxExempt->lookupCacheOption($curVal);
			else
				$this->TaxExempt->AdvancedSearch->ViewValue = $this->TaxExempt->Lookup !== NULL && is_array($this->TaxExempt->Lookup->Options) ? $curVal : NULL;
			if ($this->TaxExempt->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->TaxExempt->EditValue = array_values($this->TaxExempt->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->TaxExempt->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->JobCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->JobCode->AdvancedSearch->ViewValue = $this->JobCode->lookupCacheOption($curVal);
			else
				$this->JobCode->AdvancedSearch->ViewValue = $this->JobCode->Lookup !== NULL && is_array($this->JobCode->Lookup->Options) ? $curVal : NULL;
			if ($this->JobCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->JobCode->EditValue = array_values($this->JobCode->Lookup->Options);
				if ($this->JobCode->AdvancedSearch->ViewValue == "")
					$this->JobCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
					$this->JobCode->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobCode->AdvancedSearch->ViewValue->add($this->JobCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobCode->EditValue = $arwrk;
			}

			// MinimumAmount
			$this->MinimumAmount->EditAttrs["class"] = "form-control";
			$this->MinimumAmount->EditCustomAttributes = "";
			$this->MinimumAmount->EditValue = HtmlEncode($this->MinimumAmount->AdvancedSearch->SearchValue);
			$this->MinimumAmount->PlaceHolder = RemoveHtml($this->MinimumAmount->caption());

			// MaximumAmount
			$this->MaximumAmount->EditAttrs["class"] = "form-control";
			$this->MaximumAmount->EditCustomAttributes = "";
			$this->MaximumAmount->EditValue = HtmlEncode($this->MaximumAmount->AdvancedSearch->SearchValue);
			$this->MaximumAmount->PlaceHolder = RemoveHtml($this->MaximumAmount->caption());

			// EmployerContributionRate
			$this->EmployerContributionRate->EditAttrs["class"] = "form-control";
			$this->EmployerContributionRate->EditCustomAttributes = "";
			$this->EmployerContributionRate->EditValue = HtmlEncode($this->EmployerContributionRate->AdvancedSearch->SearchValue);
			$this->EmployerContributionRate->PlaceHolder = RemoveHtml($this->EmployerContributionRate->caption());

			// EmployerContributionAmount
			$this->EmployerContributionAmount->EditAttrs["class"] = "form-control";
			$this->EmployerContributionAmount->EditCustomAttributes = "";
			$this->EmployerContributionAmount->EditValue = HtmlEncode($this->EmployerContributionAmount->AdvancedSearch->SearchValue);
			$this->EmployerContributionAmount->PlaceHolder = RemoveHtml($this->EmployerContributionAmount->caption());

			// Application
			$this->Application->EditAttrs["class"] = "form-control";
			$this->Application->EditCustomAttributes = "";
			$curVal = trim(strval($this->Application->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Application->AdvancedSearch->ViewValue = $this->Application->lookupCacheOption($curVal);
			else
				$this->Application->AdvancedSearch->ViewValue = $this->Application->Lookup !== NULL && is_array($this->Application->Lookup->Options) ? $curVal : NULL;
			if ($this->Application->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Application->EditValue = array_values($this->Application->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Application->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Application->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Application->EditValue = $arwrk;
			}
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
		if (!CheckNumber($this->DeductionAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DeductionAmount->errorMessage());
		}
		if (!CheckNumber($this->DeductionBasicRate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DeductionBasicRate->errorMessage());
		}
		if (!CheckNumber($this->MinimumAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->MinimumAmount->errorMessage());
		}
		if (!CheckNumber($this->MaximumAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->MaximumAmount->errorMessage());
		}
		if (!CheckNumber($this->EmployerContributionRate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->EmployerContributionRate->errorMessage());
		}
		if (!CheckNumber($this->EmployerContributionAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->EmployerContributionAmount->errorMessage());
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("deduction_typelist.php"), "", $this->TableVar, TRUE);
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