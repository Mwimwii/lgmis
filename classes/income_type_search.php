<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class income_type_search extends income_type
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'income_type';

	// Page object name
	public $PageObjName = "income_type_search";

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

		// Table object (income_type)
		if (!isset($GLOBALS["income_type"]) || get_class($GLOBALS["income_type"]) == PROJECT_NAMESPACE . "income_type") {
			$GLOBALS["income_type"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["income_type"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'income_type');

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
		global $income_type;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($income_type);
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
					if ($pageName == "income_typeview.php")
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
			$key .= @$ar['IncomeCode'];
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
			$this->IncomeCode->Visible = FALSE;
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
					$this->terminate(GetUrl("income_typelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->IncomeCode->setVisibility();
		$this->IncomeName->setVisibility();
		$this->IncomeDescription->setVisibility();
		$this->Division->setVisibility();
		$this->IncomeAmount->setVisibility();
		$this->IncomeBasicRate->setVisibility();
		$this->BaseIncomeCode->setVisibility();
		$this->Taxable->setVisibility();
		$this->AccountNo->setVisibility();
		$this->JobIncluded->setVisibility();
		$this->Application->setVisibility();
		$this->JobExcluded->setVisibility();
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
		$this->setupLookupOptions($this->BaseIncomeCode);
		$this->setupLookupOptions($this->Taxable);
		$this->setupLookupOptions($this->AccountNo);
		$this->setupLookupOptions($this->JobIncluded);
		$this->setupLookupOptions($this->Application);
		$this->setupLookupOptions($this->JobExcluded);

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
					$srchStr = "income_typelist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->IncomeCode); // IncomeCode
		$this->buildSearchUrl($srchUrl, $this->IncomeName); // IncomeName
		$this->buildSearchUrl($srchUrl, $this->IncomeDescription); // IncomeDescription
		$this->buildSearchUrl($srchUrl, $this->Division); // Division
		$this->buildSearchUrl($srchUrl, $this->IncomeAmount); // IncomeAmount
		$this->buildSearchUrl($srchUrl, $this->IncomeBasicRate); // IncomeBasicRate
		$this->buildSearchUrl($srchUrl, $this->BaseIncomeCode); // BaseIncomeCode
		$this->buildSearchUrl($srchUrl, $this->Taxable); // Taxable
		$this->buildSearchUrl($srchUrl, $this->AccountNo); // AccountNo
		$this->buildSearchUrl($srchUrl, $this->JobIncluded); // JobIncluded
		$this->buildSearchUrl($srchUrl, $this->Application); // Application
		$this->buildSearchUrl($srchUrl, $this->JobExcluded); // JobExcluded
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
		if ($this->IncomeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->IncomeName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->IncomeDescription->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Division->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->Division->AdvancedSearch->SearchValue))
			$this->Division->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Division->AdvancedSearch->SearchValue);
		if (is_array($this->Division->AdvancedSearch->SearchValue2))
			$this->Division->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Division->AdvancedSearch->SearchValue2);
		if ($this->IncomeAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->IncomeBasicRate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BaseIncomeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Taxable->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AccountNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->JobIncluded->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->JobIncluded->AdvancedSearch->SearchValue))
			$this->JobIncluded->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobIncluded->AdvancedSearch->SearchValue);
		if (is_array($this->JobIncluded->AdvancedSearch->SearchValue2))
			$this->JobIncluded->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobIncluded->AdvancedSearch->SearchValue2);
		if ($this->Application->AdvancedSearch->post())
			$got = TRUE;
		if ($this->JobExcluded->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->JobExcluded->AdvancedSearch->SearchValue))
			$this->JobExcluded->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobExcluded->AdvancedSearch->SearchValue);
		if (is_array($this->JobExcluded->AdvancedSearch->SearchValue2))
			$this->JobExcluded->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->JobExcluded->AdvancedSearch->SearchValue2);
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->IncomeAmount->FormValue == $this->IncomeAmount->CurrentValue && is_numeric(ConvertToFloatString($this->IncomeAmount->CurrentValue)))
			$this->IncomeAmount->CurrentValue = ConvertToFloatString($this->IncomeAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->IncomeBasicRate->FormValue == $this->IncomeBasicRate->CurrentValue && is_numeric(ConvertToFloatString($this->IncomeBasicRate->CurrentValue)))
			$this->IncomeBasicRate->CurrentValue = ConvertToFloatString($this->IncomeBasicRate->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// IncomeCode
		// IncomeName
		// IncomeDescription
		// Division
		// IncomeAmount
		// IncomeBasicRate
		// BaseIncomeCode
		// Taxable
		// AccountNo
		// JobIncluded
		// Application
		// JobExcluded

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IncomeCode
			$this->IncomeCode->ViewValue = $this->IncomeCode->CurrentValue;
			$this->IncomeCode->ViewCustomAttributes = "";

			// IncomeName
			$this->IncomeName->ViewValue = $this->IncomeName->CurrentValue;
			$this->IncomeName->ViewCustomAttributes = "";

			// IncomeDescription
			$this->IncomeDescription->ViewValue = $this->IncomeDescription->CurrentValue;
			$this->IncomeDescription->ViewCustomAttributes = "";

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

			// IncomeAmount
			$this->IncomeAmount->ViewValue = $this->IncomeAmount->CurrentValue;
			$this->IncomeAmount->ViewValue = FormatNumber($this->IncomeAmount->ViewValue, 2, -2, -2, -2);
			$this->IncomeAmount->ViewCustomAttributes = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->ViewValue = $this->IncomeBasicRate->CurrentValue;
			$this->IncomeBasicRate->ViewValue = FormatNumber($this->IncomeBasicRate->ViewValue, 2, -2, -2, -2);
			$this->IncomeBasicRate->ViewCustomAttributes = "";

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

			// Taxable
			$curVal = strval($this->Taxable->CurrentValue);
			if ($curVal != "") {
				$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
				if ($this->Taxable->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Taxable->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Taxable->ViewValue = $this->Taxable->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Taxable->ViewValue = $this->Taxable->CurrentValue;
					}
				}
			} else {
				$this->Taxable->ViewValue = NULL;
			}
			$this->Taxable->ViewCustomAttributes = "";

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

			// JobIncluded
			$curVal = strval($this->JobIncluded->CurrentValue);
			if ($curVal != "") {
				$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
				if ($this->JobIncluded->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobIncluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobIncluded->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobIncluded->ViewValue = $this->JobIncluded->CurrentValue;
					}
				}
			} else {
				$this->JobIncluded->ViewValue = NULL;
			}
			$this->JobIncluded->ViewCustomAttributes = "";

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

			// JobExcluded
			$curVal = strval($this->JobExcluded->CurrentValue);
			if ($curVal != "") {
				$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
				if ($this->JobExcluded->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobExcluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobExcluded->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobExcluded->ViewValue = $this->JobExcluded->CurrentValue;
					}
				}
			} else {
				$this->JobExcluded->ViewValue = NULL;
			}
			$this->JobExcluded->ViewCustomAttributes = "";

			// IncomeCode
			$this->IncomeCode->LinkCustomAttributes = "";
			$this->IncomeCode->HrefValue = "";
			$this->IncomeCode->TooltipValue = "";

			// IncomeName
			$this->IncomeName->LinkCustomAttributes = "";
			$this->IncomeName->HrefValue = "";
			$this->IncomeName->TooltipValue = "";

			// IncomeDescription
			$this->IncomeDescription->LinkCustomAttributes = "";
			$this->IncomeDescription->HrefValue = "";
			$this->IncomeDescription->TooltipValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";
			$this->Division->TooltipValue = "";

			// IncomeAmount
			$this->IncomeAmount->LinkCustomAttributes = "";
			$this->IncomeAmount->HrefValue = "";
			$this->IncomeAmount->TooltipValue = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->LinkCustomAttributes = "";
			$this->IncomeBasicRate->HrefValue = "";
			$this->IncomeBasicRate->TooltipValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";
			$this->BaseIncomeCode->TooltipValue = "";

			// Taxable
			$this->Taxable->LinkCustomAttributes = "";
			$this->Taxable->HrefValue = "";
			$this->Taxable->TooltipValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";
			$this->AccountNo->TooltipValue = "";

			// JobIncluded
			$this->JobIncluded->LinkCustomAttributes = "";
			$this->JobIncluded->HrefValue = "";
			$this->JobIncluded->TooltipValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
			$this->Application->TooltipValue = "";

			// JobExcluded
			$this->JobExcluded->LinkCustomAttributes = "";
			$this->JobExcluded->HrefValue = "";
			$this->JobExcluded->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// IncomeCode
			$this->IncomeCode->EditAttrs["class"] = "form-control";
			$this->IncomeCode->EditCustomAttributes = "";
			$this->IncomeCode->EditValue = HtmlEncode($this->IncomeCode->AdvancedSearch->SearchValue);
			$this->IncomeCode->PlaceHolder = RemoveHtml($this->IncomeCode->caption());

			// IncomeName
			$this->IncomeName->EditAttrs["class"] = "form-control";
			$this->IncomeName->EditCustomAttributes = "";
			if (!$this->IncomeName->Raw)
				$this->IncomeName->AdvancedSearch->SearchValue = HtmlDecode($this->IncomeName->AdvancedSearch->SearchValue);
			$this->IncomeName->EditValue = HtmlEncode($this->IncomeName->AdvancedSearch->SearchValue);
			$this->IncomeName->PlaceHolder = RemoveHtml($this->IncomeName->caption());

			// IncomeDescription
			$this->IncomeDescription->EditAttrs["class"] = "form-control";
			$this->IncomeDescription->EditCustomAttributes = "";
			if (!$this->IncomeDescription->Raw)
				$this->IncomeDescription->AdvancedSearch->SearchValue = HtmlDecode($this->IncomeDescription->AdvancedSearch->SearchValue);
			$this->IncomeDescription->EditValue = HtmlEncode($this->IncomeDescription->AdvancedSearch->SearchValue);
			$this->IncomeDescription->PlaceHolder = RemoveHtml($this->IncomeDescription->caption());

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

			// IncomeAmount
			$this->IncomeAmount->EditAttrs["class"] = "form-control";
			$this->IncomeAmount->EditCustomAttributes = "";
			$this->IncomeAmount->EditValue = HtmlEncode($this->IncomeAmount->AdvancedSearch->SearchValue);
			$this->IncomeAmount->PlaceHolder = RemoveHtml($this->IncomeAmount->caption());

			// IncomeBasicRate
			$this->IncomeBasicRate->EditAttrs["class"] = "form-control";
			$this->IncomeBasicRate->EditCustomAttributes = "";
			$this->IncomeBasicRate->EditValue = HtmlEncode($this->IncomeBasicRate->AdvancedSearch->SearchValue);
			$this->IncomeBasicRate->PlaceHolder = RemoveHtml($this->IncomeBasicRate->caption());

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

			// Taxable
			$this->Taxable->EditAttrs["class"] = "form-control";
			$this->Taxable->EditCustomAttributes = "";
			$curVal = trim(strval($this->Taxable->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Taxable->AdvancedSearch->ViewValue = $this->Taxable->lookupCacheOption($curVal);
			else
				$this->Taxable->AdvancedSearch->ViewValue = $this->Taxable->Lookup !== NULL && is_array($this->Taxable->Lookup->Options) ? $curVal : NULL;
			if ($this->Taxable->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Taxable->EditValue = array_values($this->Taxable->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Taxable->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Taxable->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Taxable->EditValue = $arwrk;
			}

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

			// JobIncluded
			$this->JobIncluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobIncluded->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->JobIncluded->AdvancedSearch->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
			else
				$this->JobIncluded->AdvancedSearch->ViewValue = $this->JobIncluded->Lookup !== NULL && is_array($this->JobIncluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobIncluded->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->JobIncluded->EditValue = array_values($this->JobIncluded->Lookup->Options);
				if ($this->JobIncluded->AdvancedSearch->ViewValue == "")
					$this->JobIncluded->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
				$sqlWrk = $this->JobIncluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobIncluded->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobIncluded->AdvancedSearch->ViewValue->add($this->JobIncluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobIncluded->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobIncluded->EditValue = $arwrk;
			}

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

			// JobExcluded
			$this->JobExcluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobExcluded->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->JobExcluded->AdvancedSearch->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
			else
				$this->JobExcluded->AdvancedSearch->ViewValue = $this->JobExcluded->Lookup !== NULL && is_array($this->JobExcluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobExcluded->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->JobExcluded->EditValue = array_values($this->JobExcluded->Lookup->Options);
				if ($this->JobExcluded->AdvancedSearch->ViewValue == "")
					$this->JobExcluded->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
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
				$sqlWrk = $this->JobExcluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobExcluded->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobExcluded->AdvancedSearch->ViewValue->add($this->JobExcluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobExcluded->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobExcluded->EditValue = $arwrk;
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
		if (!CheckNumber($this->IncomeAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->IncomeAmount->errorMessage());
		}
		if (!CheckNumber($this->IncomeBasicRate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->IncomeBasicRate->errorMessage());
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
		$this->IncomeCode->AdvancedSearch->load();
		$this->IncomeName->AdvancedSearch->load();
		$this->IncomeDescription->AdvancedSearch->load();
		$this->Division->AdvancedSearch->load();
		$this->IncomeAmount->AdvancedSearch->load();
		$this->IncomeBasicRate->AdvancedSearch->load();
		$this->BaseIncomeCode->AdvancedSearch->load();
		$this->Taxable->AdvancedSearch->load();
		$this->AccountNo->AdvancedSearch->load();
		$this->JobIncluded->AdvancedSearch->load();
		$this->Application->AdvancedSearch->load();
		$this->JobExcluded->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("income_typelist.php"), "", $this->TableVar, TRUE);
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
				case "x_BaseIncomeCode":
					break;
				case "x_Taxable":
					break;
				case "x_AccountNo":
					break;
				case "x_JobIncluded":
					break;
				case "x_Application":
					break;
				case "x_JobExcluded":
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
						case "x_BaseIncomeCode":
							break;
						case "x_Taxable":
							break;
						case "x_AccountNo":
							break;
						case "x_JobIncluded":
							break;
						case "x_Application":
							break;
						case "x_JobExcluded":
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