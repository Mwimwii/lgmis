<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class lacct_search extends lacct
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'lacct';

	// Page object name
	public $PageObjName = "lacct_search";

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

		// Table object (lacct)
		if (!isset($GLOBALS["lacct"]) || get_class($GLOBALS["lacct"]) == PROJECT_NAMESPACE . "lacct") {
			$GLOBALS["lacct"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["lacct"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'lacct');

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
		global $lacct;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($lacct);
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
					if ($pageName == "lacctview.php")
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
					$this->terminate(GetUrl("lacctlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LACode->setVisibility();
		$this->Code->setVisibility();
		$this->Details->setVisibility();
		$this->Approved_Budget->setVisibility();
		$this->Budget->setVisibility();
		$this->Q1->setVisibility();
		$this->Q2->setVisibility();
		$this->Q3->setVisibility();
		$this->Q4->setVisibility();
		$this->Q1_Q4->setVisibility();
		$this->Percent->setVisibility();
		$this->Balance->setVisibility();
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
					$srchStr = "lacctlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->Code); // Code
		$this->buildSearchUrl($srchUrl, $this->Details); // Details
		$this->buildSearchUrl($srchUrl, $this->Approved_Budget); // Approved Budget
		$this->buildSearchUrl($srchUrl, $this->Budget); // Budget
		$this->buildSearchUrl($srchUrl, $this->Q1); // Q1
		$this->buildSearchUrl($srchUrl, $this->Q2); // Q2
		$this->buildSearchUrl($srchUrl, $this->Q3); // Q3
		$this->buildSearchUrl($srchUrl, $this->Q4); // Q4
		$this->buildSearchUrl($srchUrl, $this->Q1_Q4); // Q1-Q4
		$this->buildSearchUrl($srchUrl, $this->Percent); // Percent
		$this->buildSearchUrl($srchUrl, $this->Balance); // Balance
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
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Code->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Details->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Approved_Budget->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Budget->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Q1->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Q2->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Q3->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Q4->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Q1_Q4->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Percent->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Balance->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Code->FormValue == $this->Code->CurrentValue && is_numeric(ConvertToFloatString($this->Code->CurrentValue)))
			$this->Code->CurrentValue = ConvertToFloatString($this->Code->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Approved_Budget->FormValue == $this->Approved_Budget->CurrentValue && is_numeric(ConvertToFloatString($this->Approved_Budget->CurrentValue)))
			$this->Approved_Budget->CurrentValue = ConvertToFloatString($this->Approved_Budget->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Budget->FormValue == $this->Budget->CurrentValue && is_numeric(ConvertToFloatString($this->Budget->CurrentValue)))
			$this->Budget->CurrentValue = ConvertToFloatString($this->Budget->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Q1->FormValue == $this->Q1->CurrentValue && is_numeric(ConvertToFloatString($this->Q1->CurrentValue)))
			$this->Q1->CurrentValue = ConvertToFloatString($this->Q1->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Q2->FormValue == $this->Q2->CurrentValue && is_numeric(ConvertToFloatString($this->Q2->CurrentValue)))
			$this->Q2->CurrentValue = ConvertToFloatString($this->Q2->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Q3->FormValue == $this->Q3->CurrentValue && is_numeric(ConvertToFloatString($this->Q3->CurrentValue)))
			$this->Q3->CurrentValue = ConvertToFloatString($this->Q3->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Q4->FormValue == $this->Q4->CurrentValue && is_numeric(ConvertToFloatString($this->Q4->CurrentValue)))
			$this->Q4->CurrentValue = ConvertToFloatString($this->Q4->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Q1_Q4->FormValue == $this->Q1_Q4->CurrentValue && is_numeric(ConvertToFloatString($this->Q1_Q4->CurrentValue)))
			$this->Q1_Q4->CurrentValue = ConvertToFloatString($this->Q1_Q4->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Percent->FormValue == $this->Percent->CurrentValue && is_numeric(ConvertToFloatString($this->Percent->CurrentValue)))
			$this->Percent->CurrentValue = ConvertToFloatString($this->Percent->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Balance->FormValue == $this->Balance->CurrentValue && is_numeric(ConvertToFloatString($this->Balance->CurrentValue)))
			$this->Balance->CurrentValue = ConvertToFloatString($this->Balance->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LACode
		// Code
		// Details
		// Approved Budget
		// Budget
		// Q1
		// Q2
		// Q3
		// Q4
		// Q1-Q4
		// Percent
		// Balance

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewValue = FormatNumber($this->LACode->ViewValue, 0, -2, -2, -2);
			$this->LACode->ViewCustomAttributes = "";

			// Code
			$this->Code->ViewValue = $this->Code->CurrentValue;
			$this->Code->ViewValue = FormatNumber($this->Code->ViewValue, 2, -2, -2, -2);
			$this->Code->ViewCustomAttributes = "";

			// Details
			$this->Details->ViewValue = $this->Details->CurrentValue;
			$this->Details->ViewCustomAttributes = "";

			// Approved Budget
			$this->Approved_Budget->ViewValue = $this->Approved_Budget->CurrentValue;
			$this->Approved_Budget->ViewValue = FormatNumber($this->Approved_Budget->ViewValue, 2, -2, -2, -2);
			$this->Approved_Budget->ViewCustomAttributes = "";

			// Budget
			$this->Budget->ViewValue = $this->Budget->CurrentValue;
			$this->Budget->ViewValue = FormatNumber($this->Budget->ViewValue, 2, -2, -2, -2);
			$this->Budget->ViewCustomAttributes = "";

			// Q1
			$this->Q1->ViewValue = $this->Q1->CurrentValue;
			$this->Q1->ViewValue = FormatNumber($this->Q1->ViewValue, 2, -2, -2, -2);
			$this->Q1->ViewCustomAttributes = "";

			// Q2
			$this->Q2->ViewValue = $this->Q2->CurrentValue;
			$this->Q2->ViewValue = FormatNumber($this->Q2->ViewValue, 2, -2, -2, -2);
			$this->Q2->ViewCustomAttributes = "";

			// Q3
			$this->Q3->ViewValue = $this->Q3->CurrentValue;
			$this->Q3->ViewValue = FormatNumber($this->Q3->ViewValue, 2, -2, -2, -2);
			$this->Q3->ViewCustomAttributes = "";

			// Q4
			$this->Q4->ViewValue = $this->Q4->CurrentValue;
			$this->Q4->ViewValue = FormatNumber($this->Q4->ViewValue, 2, -2, -2, -2);
			$this->Q4->ViewCustomAttributes = "";

			// Q1-Q4
			$this->Q1_Q4->ViewValue = $this->Q1_Q4->CurrentValue;
			$this->Q1_Q4->ViewValue = FormatNumber($this->Q1_Q4->ViewValue, 2, -2, -2, -2);
			$this->Q1_Q4->ViewCustomAttributes = "";

			// Percent
			$this->Percent->ViewValue = $this->Percent->CurrentValue;
			$this->Percent->ViewValue = FormatNumber($this->Percent->ViewValue, 2, -2, -2, -2);
			$this->Percent->ViewCustomAttributes = "";

			// Balance
			$this->Balance->ViewValue = $this->Balance->CurrentValue;
			$this->Balance->ViewValue = FormatNumber($this->Balance->ViewValue, 2, -2, -2, -2);
			$this->Balance->ViewCustomAttributes = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// Code
			$this->Code->LinkCustomAttributes = "";
			$this->Code->HrefValue = "";
			$this->Code->TooltipValue = "";

			// Details
			$this->Details->LinkCustomAttributes = "";
			$this->Details->HrefValue = "";
			$this->Details->TooltipValue = "";

			// Approved Budget
			$this->Approved_Budget->LinkCustomAttributes = "";
			$this->Approved_Budget->HrefValue = "";
			$this->Approved_Budget->TooltipValue = "";

			// Budget
			$this->Budget->LinkCustomAttributes = "";
			$this->Budget->HrefValue = "";
			$this->Budget->TooltipValue = "";

			// Q1
			$this->Q1->LinkCustomAttributes = "";
			$this->Q1->HrefValue = "";
			$this->Q1->TooltipValue = "";

			// Q2
			$this->Q2->LinkCustomAttributes = "";
			$this->Q2->HrefValue = "";
			$this->Q2->TooltipValue = "";

			// Q3
			$this->Q3->LinkCustomAttributes = "";
			$this->Q3->HrefValue = "";
			$this->Q3->TooltipValue = "";

			// Q4
			$this->Q4->LinkCustomAttributes = "";
			$this->Q4->HrefValue = "";
			$this->Q4->TooltipValue = "";

			// Q1-Q4
			$this->Q1_Q4->LinkCustomAttributes = "";
			$this->Q1_Q4->HrefValue = "";
			$this->Q1_Q4->TooltipValue = "";

			// Percent
			$this->Percent->LinkCustomAttributes = "";
			$this->Percent->HrefValue = "";
			$this->Percent->TooltipValue = "";

			// Balance
			$this->Balance->LinkCustomAttributes = "";
			$this->Balance->HrefValue = "";
			$this->Balance->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			$this->LACode->EditValue = HtmlEncode($this->LACode->AdvancedSearch->SearchValue);
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// Code
			$this->Code->EditAttrs["class"] = "form-control";
			$this->Code->EditCustomAttributes = "";
			$this->Code->EditValue = HtmlEncode($this->Code->AdvancedSearch->SearchValue);
			$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

			// Details
			$this->Details->EditAttrs["class"] = "form-control";
			$this->Details->EditCustomAttributes = "";
			if (!$this->Details->Raw)
				$this->Details->AdvancedSearch->SearchValue = HtmlDecode($this->Details->AdvancedSearch->SearchValue);
			$this->Details->EditValue = HtmlEncode($this->Details->AdvancedSearch->SearchValue);
			$this->Details->PlaceHolder = RemoveHtml($this->Details->caption());

			// Approved Budget
			$this->Approved_Budget->EditAttrs["class"] = "form-control";
			$this->Approved_Budget->EditCustomAttributes = "";
			$this->Approved_Budget->EditValue = HtmlEncode($this->Approved_Budget->AdvancedSearch->SearchValue);
			$this->Approved_Budget->PlaceHolder = RemoveHtml($this->Approved_Budget->caption());

			// Budget
			$this->Budget->EditAttrs["class"] = "form-control";
			$this->Budget->EditCustomAttributes = "";
			$this->Budget->EditValue = HtmlEncode($this->Budget->AdvancedSearch->SearchValue);
			$this->Budget->PlaceHolder = RemoveHtml($this->Budget->caption());

			// Q1
			$this->Q1->EditAttrs["class"] = "form-control";
			$this->Q1->EditCustomAttributes = "";
			$this->Q1->EditValue = HtmlEncode($this->Q1->AdvancedSearch->SearchValue);
			$this->Q1->PlaceHolder = RemoveHtml($this->Q1->caption());

			// Q2
			$this->Q2->EditAttrs["class"] = "form-control";
			$this->Q2->EditCustomAttributes = "";
			$this->Q2->EditValue = HtmlEncode($this->Q2->AdvancedSearch->SearchValue);
			$this->Q2->PlaceHolder = RemoveHtml($this->Q2->caption());

			// Q3
			$this->Q3->EditAttrs["class"] = "form-control";
			$this->Q3->EditCustomAttributes = "";
			$this->Q3->EditValue = HtmlEncode($this->Q3->AdvancedSearch->SearchValue);
			$this->Q3->PlaceHolder = RemoveHtml($this->Q3->caption());

			// Q4
			$this->Q4->EditAttrs["class"] = "form-control";
			$this->Q4->EditCustomAttributes = "";
			$this->Q4->EditValue = HtmlEncode($this->Q4->AdvancedSearch->SearchValue);
			$this->Q4->PlaceHolder = RemoveHtml($this->Q4->caption());

			// Q1-Q4
			$this->Q1_Q4->EditAttrs["class"] = "form-control";
			$this->Q1_Q4->EditCustomAttributes = "";
			$this->Q1_Q4->EditValue = HtmlEncode($this->Q1_Q4->AdvancedSearch->SearchValue);
			$this->Q1_Q4->PlaceHolder = RemoveHtml($this->Q1_Q4->caption());

			// Percent
			$this->Percent->EditAttrs["class"] = "form-control";
			$this->Percent->EditCustomAttributes = "";
			$this->Percent->EditValue = HtmlEncode($this->Percent->AdvancedSearch->SearchValue);
			$this->Percent->PlaceHolder = RemoveHtml($this->Percent->caption());

			// Balance
			$this->Balance->EditAttrs["class"] = "form-control";
			$this->Balance->EditCustomAttributes = "";
			$this->Balance->EditValue = HtmlEncode($this->Balance->AdvancedSearch->SearchValue);
			$this->Balance->PlaceHolder = RemoveHtml($this->Balance->caption());
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
		if (!CheckInteger($this->LACode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->LACode->errorMessage());
		}
		if (!CheckNumber($this->Code->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Code->errorMessage());
		}
		if (!CheckNumber($this->Approved_Budget->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Approved_Budget->errorMessage());
		}
		if (!CheckNumber($this->Budget->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Budget->errorMessage());
		}
		if (!CheckNumber($this->Q1->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Q1->errorMessage());
		}
		if (!CheckNumber($this->Q2->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Q2->errorMessage());
		}
		if (!CheckNumber($this->Q3->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Q3->errorMessage());
		}
		if (!CheckNumber($this->Q4->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Q4->errorMessage());
		}
		if (!CheckNumber($this->Q1_Q4->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Q1_Q4->errorMessage());
		}
		if (!CheckNumber($this->Percent->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Percent->errorMessage());
		}
		if (!CheckNumber($this->Balance->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Balance->errorMessage());
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
		$this->LACode->AdvancedSearch->load();
		$this->Code->AdvancedSearch->load();
		$this->Details->AdvancedSearch->load();
		$this->Approved_Budget->AdvancedSearch->load();
		$this->Budget->AdvancedSearch->load();
		$this->Q1->AdvancedSearch->load();
		$this->Q2->AdvancedSearch->load();
		$this->Q3->AdvancedSearch->load();
		$this->Q4->AdvancedSearch->load();
		$this->Q1_Q4->AdvancedSearch->load();
		$this->Percent->AdvancedSearch->load();
		$this->Balance->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("lacctlist.php"), "", $this->TableVar, TRUE);
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