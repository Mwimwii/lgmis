<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class budget_search extends budget
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'budget';

	// Page object name
	public $PageObjName = "budget_search";

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

		// Table object (budget)
		if (!isset($GLOBALS["budget"]) || get_class($GLOBALS["budget"]) == PROJECT_NAMESPACE . "budget") {
			$GLOBALS["budget"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["budget"];
		}

		// Table object (detailed_action)
		if (!isset($GLOBALS['detailed_action']))
			$GLOBALS['detailed_action'] = new detailed_action();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'budget');

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
		global $budget;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($budget);
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
					if ($pageName == "budgetview.php")
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
			$key .= @$ar['BudgetLine'];
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
			$this->BudgetLine->Visible = FALSE;
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
					$this->terminate(GetUrl("budgetlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->OutcomeCode->setVisibility();
		$this->OutputCode->setVisibility();
		$this->ActionCode->setVisibility();
		$this->DetailedActionCode->setVisibility();
		$this->FinancialYear->setVisibility();
		$this->AccountCode->setVisibility();
		$this->ItemCode->Visible = FALSE;
		$this->MeansOfImplementation->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Quantity->setVisibility();
		$this->PeriodType->setVisibility();
		$this->PeriodLength->setVisibility();
		$this->Frequency->setVisibility();
		$this->UnitCost->setVisibility();
		$this->BudgetEstimate->setVisibility();
		$this->ActualAmount->setVisibility();
		$this->Status->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->BudgetLine->setVisibility();
		$this->ProgramCode->setVisibility();
		$this->SubProgramCode->setVisibility();
		$this->ApprovedBudget->setVisibility();
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
		$this->setupLookupOptions($this->OutcomeCode);
		$this->setupLookupOptions($this->OutputCode);
		$this->setupLookupOptions($this->ActionCode);
		$this->setupLookupOptions($this->DetailedActionCode);
		$this->setupLookupOptions($this->FinancialYear);
		$this->setupLookupOptions($this->AccountCode);
		$this->setupLookupOptions($this->MeansOfImplementation);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PeriodType);
		$this->setupLookupOptions($this->Status);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProgramCode);
		$this->setupLookupOptions($this->SubProgramCode);

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
					$srchStr = "budgetlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->OutcomeCode); // OutcomeCode
		$this->buildSearchUrl($srchUrl, $this->OutputCode); // OutputCode
		$this->buildSearchUrl($srchUrl, $this->ActionCode); // ActionCode
		$this->buildSearchUrl($srchUrl, $this->DetailedActionCode); // DetailedActionCode
		$this->buildSearchUrl($srchUrl, $this->FinancialYear); // FinancialYear
		$this->buildSearchUrl($srchUrl, $this->AccountCode); // AccountCode
		$this->buildSearchUrl($srchUrl, $this->MeansOfImplementation); // MeansOfImplementation
		$this->buildSearchUrl($srchUrl, $this->UnitOfMeasure); // UnitOfMeasure
		$this->buildSearchUrl($srchUrl, $this->Quantity); // Quantity
		$this->buildSearchUrl($srchUrl, $this->PeriodType); // PeriodType
		$this->buildSearchUrl($srchUrl, $this->PeriodLength); // PeriodLength
		$this->buildSearchUrl($srchUrl, $this->Frequency); // Frequency
		$this->buildSearchUrl($srchUrl, $this->UnitCost); // UnitCost
		$this->buildSearchUrl($srchUrl, $this->BudgetEstimate); // BudgetEstimate
		$this->buildSearchUrl($srchUrl, $this->ActualAmount); // ActualAmount
		$this->buildSearchUrl($srchUrl, $this->Status); // Status
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->DepartmentCode); // DepartmentCode
		$this->buildSearchUrl($srchUrl, $this->SectionCode); // SectionCode
		$this->buildSearchUrl($srchUrl, $this->BudgetLine); // BudgetLine
		$this->buildSearchUrl($srchUrl, $this->ProgramCode); // ProgramCode
		$this->buildSearchUrl($srchUrl, $this->SubProgramCode); // SubProgramCode
		$this->buildSearchUrl($srchUrl, $this->ApprovedBudget); // ApprovedBudget
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
		if ($this->OutcomeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->OutputCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ActionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DetailedActionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->FinancialYear->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AccountCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MeansOfImplementation->AdvancedSearch->post())
			$got = TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Quantity->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PeriodType->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PeriodLength->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Frequency->AdvancedSearch->post())
			$got = TRUE;
		if ($this->UnitCost->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BudgetEstimate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ActualAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Status->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DepartmentCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SectionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BudgetLine->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ProgramCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SubProgramCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ApprovedBudget->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Quantity->FormValue == $this->Quantity->CurrentValue && is_numeric(ConvertToFloatString($this->Quantity->CurrentValue)))
			$this->Quantity->CurrentValue = ConvertToFloatString($this->Quantity->CurrentValue);

		// Convert decimal values if posted back
		if ($this->PeriodLength->FormValue == $this->PeriodLength->CurrentValue && is_numeric(ConvertToFloatString($this->PeriodLength->CurrentValue)))
			$this->PeriodLength->CurrentValue = ConvertToFloatString($this->PeriodLength->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Frequency->FormValue == $this->Frequency->CurrentValue && is_numeric(ConvertToFloatString($this->Frequency->CurrentValue)))
			$this->Frequency->CurrentValue = ConvertToFloatString($this->Frequency->CurrentValue);

		// Convert decimal values if posted back
		if ($this->UnitCost->FormValue == $this->UnitCost->CurrentValue && is_numeric(ConvertToFloatString($this->UnitCost->CurrentValue)))
			$this->UnitCost->CurrentValue = ConvertToFloatString($this->UnitCost->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BudgetEstimate->FormValue == $this->BudgetEstimate->CurrentValue && is_numeric(ConvertToFloatString($this->BudgetEstimate->CurrentValue)))
			$this->BudgetEstimate->CurrentValue = ConvertToFloatString($this->BudgetEstimate->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ActualAmount->FormValue == $this->ActualAmount->CurrentValue && is_numeric(ConvertToFloatString($this->ActualAmount->CurrentValue)))
			$this->ActualAmount->CurrentValue = ConvertToFloatString($this->ActualAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ApprovedBudget->FormValue == $this->ApprovedBudget->CurrentValue && is_numeric(ConvertToFloatString($this->ApprovedBudget->CurrentValue)))
			$this->ApprovedBudget->CurrentValue = ConvertToFloatString($this->ApprovedBudget->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// OutcomeCode
		// OutputCode
		// ActionCode
		// DetailedActionCode
		// FinancialYear
		// AccountCode
		// ItemCode
		// MeansOfImplementation
		// UnitOfMeasure
		// Quantity
		// PeriodType
		// PeriodLength
		// Frequency
		// UnitCost
		// BudgetEstimate
		// ActualAmount
		// Status
		// LACode
		// DepartmentCode
		// SectionCode
		// BudgetLine
		// ProgramCode
		// SubProgramCode
		// ApprovedBudget

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OutcomeCode
			$curVal = strval($this->OutcomeCode->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeCode->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
				if ($this->OutcomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutcomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
					}
				}
			} else {
				$this->OutcomeCode->ViewValue = NULL;
			}
			$this->OutcomeCode->ViewCustomAttributes = "";

			// OutputCode
			$curVal = strval($this->OutputCode->CurrentValue);
			if ($curVal != "") {
				$this->OutputCode->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
				if ($this->OutputCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OutputCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutputCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutputCode->ViewValue = $this->OutputCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutputCode->ViewValue = $this->OutputCode->CurrentValue;
					}
				}
			} else {
				$this->OutputCode->ViewValue = NULL;
			}
			$this->OutputCode->ViewCustomAttributes = "";

			// ActionCode
			$curVal = strval($this->ActionCode->CurrentValue);
			if ($curVal != "") {
				$this->ActionCode->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
				if ($this->ActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionCode->ViewValue = $this->ActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionCode->ViewValue = $this->ActionCode->CurrentValue;
					}
				}
			} else {
				$this->ActionCode->ViewValue = NULL;
			}
			$this->ActionCode->ViewCustomAttributes = "";

			// DetailedActionCode
			$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
			$curVal = strval($this->DetailedActionCode->CurrentValue);
			if ($curVal != "") {
				$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->lookupCacheOption($curVal);
				if ($this->DetailedActionCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DetailedActionCode->ViewValue = $this->DetailedActionCode->CurrentValue;
					}
				}
			} else {
				$this->DetailedActionCode->ViewValue = NULL;
			}
			$this->DetailedActionCode->ViewCustomAttributes = "";

			// FinancialYear
			$curVal = strval($this->FinancialYear->CurrentValue);
			if ($curVal != "") {
				$this->FinancialYear->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
				if ($this->FinancialYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->FinancialYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->FinancialYear->ViewValue = $this->FinancialYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->FinancialYear->ViewValue = $this->FinancialYear->CurrentValue;
					}
				}
			} else {
				$this->FinancialYear->ViewValue = NULL;
			}
			$this->FinancialYear->ViewCustomAttributes = "";

			// AccountCode
			$curVal = strval($this->AccountCode->CurrentValue);
			if ($curVal != "") {
				$this->AccountCode->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
				if ($this->AccountCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AccountCode->ViewValue = $this->AccountCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountCode->ViewValue = $this->AccountCode->CurrentValue;
					}
				}
			} else {
				$this->AccountCode->ViewValue = NULL;
			}
			$this->AccountCode->ViewCustomAttributes = "";

			// MeansOfImplementation
			$curVal = strval($this->MeansOfImplementation->CurrentValue);
			if ($curVal != "") {
				$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
				if ($this->MeansOfImplementation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`moimp_code`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeansOfImplementation->ViewValue = $this->MeansOfImplementation->CurrentValue;
					}
				}
			} else {
				$this->MeansOfImplementation->ViewValue = NULL;
			}
			$this->MeansOfImplementation->ViewCustomAttributes = "";

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

			// Quantity
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = FormatNumber($this->Quantity->ViewValue, 4, -2, -2, -2);
			$this->Quantity->CellCssStyle .= "text-align: right;";
			$this->Quantity->ViewCustomAttributes = "";

			// PeriodType
			$curVal = strval($this->PeriodType->CurrentValue);
			if ($curVal != "") {
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
				if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
					}
				}
			} else {
				$this->PeriodType->ViewValue = NULL;
			}
			$this->PeriodType->ViewCustomAttributes = "";

			// PeriodLength
			$this->PeriodLength->ViewValue = $this->PeriodLength->CurrentValue;
			$this->PeriodLength->ViewValue = FormatNumber($this->PeriodLength->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->PeriodLength->ViewCustomAttributes = "";

			// Frequency
			$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
			$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Frequency->ViewCustomAttributes = "";

			// UnitCost
			$this->UnitCost->ViewValue = $this->UnitCost->CurrentValue;
			$this->UnitCost->ViewValue = FormatNumber($this->UnitCost->ViewValue, 2, -2, -2, -2);
			$this->UnitCost->CellCssStyle .= "text-align: right;";
			$this->UnitCost->ViewCustomAttributes = "";

			// BudgetEstimate
			$this->BudgetEstimate->ViewValue = $this->BudgetEstimate->CurrentValue;
			$this->BudgetEstimate->ViewValue = FormatNumber($this->BudgetEstimate->ViewValue, 2, -2, -2, -2);
			$this->BudgetEstimate->CellCssStyle .= "text-align: right;";
			$this->BudgetEstimate->ViewCustomAttributes = "";

			// ActualAmount
			$this->ActualAmount->ViewValue = $this->ActualAmount->CurrentValue;
			$this->ActualAmount->ViewValue = FormatNumber($this->ActualAmount->ViewValue, 2, -2, -2, -2);
			$this->ActualAmount->CellCssStyle .= "text-align: right;";
			$this->ActualAmount->ViewCustomAttributes = "";

			// Status
			$this->Status->ViewValue = $this->Status->CurrentValue;
			$curVal = strval($this->Status->CurrentValue);
			if ($curVal != "") {
				$this->Status->ViewValue = $this->Status->lookupCacheOption($curVal);
				if ($this->Status->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Status->ViewValue = $this->Status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Status->ViewValue = $this->Status->CurrentValue;
					}
				}
			} else {
				$this->Status->ViewValue = NULL;
			}
			$this->Status->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
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

			// BudgetLine
			$this->BudgetLine->ViewValue = $this->BudgetLine->CurrentValue;
			$this->BudgetLine->ViewCustomAttributes = "";

			// ProgramCode
			$curVal = strval($this->ProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->ProgramCode->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
				if ($this->ProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProgramCode->ViewValue = $this->ProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProgramCode->ViewValue = $this->ProgramCode->CurrentValue;
					}
				}
			} else {
				$this->ProgramCode->ViewValue = NULL;
			}
			$this->ProgramCode->ViewCustomAttributes = "";

			// SubProgramCode
			$curVal = strval($this->SubProgramCode->CurrentValue);
			if ($curVal != "") {
				$this->SubProgramCode->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
				if ($this->SubProgramCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SubProgramCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubProgramCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubProgramCode->ViewValue = $this->SubProgramCode->CurrentValue;
					}
				}
			} else {
				$this->SubProgramCode->ViewValue = NULL;
			}
			$this->SubProgramCode->ViewCustomAttributes = "";

			// ApprovedBudget
			$this->ApprovedBudget->ViewValue = $this->ApprovedBudget->CurrentValue;
			$this->ApprovedBudget->ViewValue = FormatNumber($this->ApprovedBudget->ViewValue, 2, -2, -2, -2);
			$this->ApprovedBudget->ViewCustomAttributes = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// OutputCode
			$this->OutputCode->LinkCustomAttributes = "";
			$this->OutputCode->HrefValue = "";
			$this->OutputCode->TooltipValue = "";

			// ActionCode
			$this->ActionCode->LinkCustomAttributes = "";
			$this->ActionCode->HrefValue = "";
			$this->ActionCode->TooltipValue = "";

			// DetailedActionCode
			$this->DetailedActionCode->LinkCustomAttributes = "";
			$this->DetailedActionCode->HrefValue = "";
			$this->DetailedActionCode->TooltipValue = "";

			// FinancialYear
			$this->FinancialYear->LinkCustomAttributes = "";
			$this->FinancialYear->HrefValue = "";
			$this->FinancialYear->TooltipValue = "";

			// AccountCode
			$this->AccountCode->LinkCustomAttributes = "";
			$this->AccountCode->HrefValue = "";
			$this->AccountCode->TooltipValue = "";

			// MeansOfImplementation
			$this->MeansOfImplementation->LinkCustomAttributes = "";
			$this->MeansOfImplementation->HrefValue = "";
			$this->MeansOfImplementation->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Quantity
			$this->Quantity->LinkCustomAttributes = "";
			$this->Quantity->HrefValue = "";
			$this->Quantity->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// PeriodLength
			$this->PeriodLength->LinkCustomAttributes = "";
			$this->PeriodLength->HrefValue = "";
			$this->PeriodLength->TooltipValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";
			$this->Frequency->TooltipValue = "";

			// UnitCost
			$this->UnitCost->LinkCustomAttributes = "";
			$this->UnitCost->HrefValue = "";
			$this->UnitCost->TooltipValue = "";

			// BudgetEstimate
			$this->BudgetEstimate->LinkCustomAttributes = "";
			$this->BudgetEstimate->HrefValue = "";
			$this->BudgetEstimate->TooltipValue = "";

			// ActualAmount
			$this->ActualAmount->LinkCustomAttributes = "";
			$this->ActualAmount->HrefValue = "";
			$this->ActualAmount->TooltipValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
			$this->Status->TooltipValue = "";

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

			// BudgetLine
			$this->BudgetLine->LinkCustomAttributes = "";
			$this->BudgetLine->HrefValue = "";
			$this->BudgetLine->TooltipValue = "";

			// ProgramCode
			$this->ProgramCode->LinkCustomAttributes = "";
			$this->ProgramCode->HrefValue = "";
			$this->ProgramCode->TooltipValue = "";

			// SubProgramCode
			$this->SubProgramCode->LinkCustomAttributes = "";
			$this->SubProgramCode->HrefValue = "";
			$this->SubProgramCode->TooltipValue = "";

			// ApprovedBudget
			$this->ApprovedBudget->LinkCustomAttributes = "";
			$this->ApprovedBudget->HrefValue = "";
			$this->ApprovedBudget->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// OutcomeCode
			$this->OutcomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutcomeCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->OutcomeCode->AdvancedSearch->ViewValue = $this->OutcomeCode->lookupCacheOption($curVal);
			else
				$this->OutcomeCode->AdvancedSearch->ViewValue = $this->OutcomeCode->Lookup !== NULL && is_array($this->OutcomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OutcomeCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->OutcomeCode->EditValue = array_values($this->OutcomeCode->Lookup->Options);
				if ($this->OutcomeCode->AdvancedSearch->ViewValue == "")
					$this->OutcomeCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutcomeCode`" . SearchString("=", $this->OutcomeCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutcomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->OutcomeCode->AdvancedSearch->ViewValue = $this->OutcomeCode->displayValue($arwrk);
				} else {
					$this->OutcomeCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutcomeCode->EditValue = $arwrk;
			}

			// OutputCode
			$this->OutputCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutputCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->OutputCode->AdvancedSearch->ViewValue = $this->OutputCode->lookupCacheOption($curVal);
			else
				$this->OutputCode->AdvancedSearch->ViewValue = $this->OutputCode->Lookup !== NULL && is_array($this->OutputCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OutputCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->OutputCode->EditValue = array_values($this->OutputCode->Lookup->Options);
				if ($this->OutputCode->AdvancedSearch->ViewValue == "")
					$this->OutputCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OutputCode`" . SearchString("=", $this->OutputCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutputCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->OutputCode->AdvancedSearch->ViewValue = $this->OutputCode->displayValue($arwrk);
				} else {
					$this->OutputCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutputCode->EditValue = $arwrk;
			}

			// ActionCode
			$this->ActionCode->EditAttrs["class"] = "form-control";
			$this->ActionCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ActionCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ActionCode->AdvancedSearch->ViewValue = $this->ActionCode->lookupCacheOption($curVal);
			else
				$this->ActionCode->AdvancedSearch->ViewValue = $this->ActionCode->Lookup !== NULL && is_array($this->ActionCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ActionCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ActionCode->EditValue = array_values($this->ActionCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ActionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ActionCode->EditValue = $arwrk;
			}

			// DetailedActionCode
			$this->DetailedActionCode->EditAttrs["class"] = "form-control";
			$this->DetailedActionCode->EditCustomAttributes = "";
			$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->DetailedActionCode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->DetailedActionCode->EditValue = $this->DetailedActionCode->lookupCacheOption($curVal);
				if ($this->DetailedActionCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`DetailedActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->DetailedActionCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DetailedActionCode->EditValue = $this->DetailedActionCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->DetailedActionCode->EditValue = HtmlEncode($this->DetailedActionCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->DetailedActionCode->EditValue = NULL;
			}
			$this->DetailedActionCode->PlaceHolder = RemoveHtml($this->DetailedActionCode->caption());

			// FinancialYear
			$this->FinancialYear->EditAttrs["class"] = "form-control";
			$this->FinancialYear->EditCustomAttributes = "";
			$curVal = trim(strval($this->FinancialYear->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->FinancialYear->AdvancedSearch->ViewValue = $this->FinancialYear->lookupCacheOption($curVal);
			else
				$this->FinancialYear->AdvancedSearch->ViewValue = $this->FinancialYear->Lookup !== NULL && is_array($this->FinancialYear->Lookup->Options) ? $curVal : NULL;
			if ($this->FinancialYear->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->FinancialYear->EditValue = array_values($this->FinancialYear->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Year`" . SearchString("=", $this->FinancialYear->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->FinancialYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->FinancialYear->EditValue = $arwrk;
			}

			// AccountCode
			$this->AccountCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AccountCode->AdvancedSearch->ViewValue = $this->AccountCode->lookupCacheOption($curVal);
			else
				$this->AccountCode->AdvancedSearch->ViewValue = $this->AccountCode->Lookup !== NULL && is_array($this->AccountCode->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AccountCode->EditValue = array_values($this->AccountCode->Lookup->Options);
				if ($this->AccountCode->AdvancedSearch->ViewValue == "")
					$this->AccountCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountCode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AccountCode->AdvancedSearch->ViewValue = $this->AccountCode->displayValue($arwrk);
				} else {
					$this->AccountCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountCode->EditValue = $arwrk;
			}

			// MeansOfImplementation
			$this->MeansOfImplementation->EditCustomAttributes = "";
			$curVal = trim(strval($this->MeansOfImplementation->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->MeansOfImplementation->AdvancedSearch->ViewValue = $this->MeansOfImplementation->lookupCacheOption($curVal);
			else
				$this->MeansOfImplementation->AdvancedSearch->ViewValue = $this->MeansOfImplementation->Lookup !== NULL && is_array($this->MeansOfImplementation->Lookup->Options) ? $curVal : NULL;
			if ($this->MeansOfImplementation->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->MeansOfImplementation->EditValue = array_values($this->MeansOfImplementation->Lookup->Options);
				if ($this->MeansOfImplementation->AdvancedSearch->ViewValue == "")
					$this->MeansOfImplementation->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`moimp_code`" . SearchString("=", $this->MeansOfImplementation->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MeansOfImplementation->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->MeansOfImplementation->AdvancedSearch->ViewValue = $this->MeansOfImplementation->displayValue($arwrk);
				} else {
					$this->MeansOfImplementation->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MeansOfImplementation->EditValue = $arwrk;
			}

			// UnitOfMeasure
			$this->UnitOfMeasure->EditAttrs["class"] = "form-control";
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->UnitOfMeasure->AdvancedSearch->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->AdvancedSearch->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Unit_of_measure`" . SearchString("=", $this->UnitOfMeasure->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// Quantity
			$this->Quantity->EditAttrs["class"] = "form-control";
			$this->Quantity->EditCustomAttributes = "";
			$this->Quantity->EditValue = HtmlEncode($this->Quantity->AdvancedSearch->SearchValue);
			$this->Quantity->PlaceHolder = RemoveHtml($this->Quantity->caption());

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			$curVal = trim(strval($this->PeriodType->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PeriodType->AdvancedSearch->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			else
				$this->PeriodType->AdvancedSearch->ViewValue = $this->PeriodType->Lookup !== NULL && is_array($this->PeriodType->Lookup->Options) ? $curVal : NULL;
			if ($this->PeriodType->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PeriodType->EditValue = array_values($this->PeriodType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Period_Type`" . SearchString("=", $this->PeriodType->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PeriodType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PeriodType->EditValue = $arwrk;
			}

			// PeriodLength
			$this->PeriodLength->EditAttrs["class"] = "form-control";
			$this->PeriodLength->EditCustomAttributes = "";
			$this->PeriodLength->EditValue = HtmlEncode($this->PeriodLength->AdvancedSearch->SearchValue);
			$this->PeriodLength->PlaceHolder = RemoveHtml($this->PeriodLength->caption());

			// Frequency
			$this->Frequency->EditAttrs["class"] = "form-control";
			$this->Frequency->EditCustomAttributes = "";
			$this->Frequency->EditValue = HtmlEncode($this->Frequency->AdvancedSearch->SearchValue);
			$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());

			// UnitCost
			$this->UnitCost->EditAttrs["class"] = "form-control";
			$this->UnitCost->EditCustomAttributes = "";
			$this->UnitCost->EditValue = HtmlEncode($this->UnitCost->AdvancedSearch->SearchValue);
			$this->UnitCost->PlaceHolder = RemoveHtml($this->UnitCost->caption());

			// BudgetEstimate
			$this->BudgetEstimate->EditAttrs["class"] = "form-control";
			$this->BudgetEstimate->EditCustomAttributes = "";
			$this->BudgetEstimate->EditValue = HtmlEncode($this->BudgetEstimate->AdvancedSearch->SearchValue);
			$this->BudgetEstimate->PlaceHolder = RemoveHtml($this->BudgetEstimate->caption());

			// ActualAmount
			$this->ActualAmount->EditAttrs["class"] = "form-control";
			$this->ActualAmount->EditCustomAttributes = "";
			$this->ActualAmount->EditValue = HtmlEncode($this->ActualAmount->AdvancedSearch->SearchValue);
			$this->ActualAmount->PlaceHolder = RemoveHtml($this->ActualAmount->caption());

			// Status
			$this->Status->EditAttrs["class"] = "form-control";
			$this->Status->EditCustomAttributes = "";
			if (!$this->Status->Raw)
				$this->Status->AdvancedSearch->SearchValue = HtmlDecode($this->Status->AdvancedSearch->SearchValue);
			$this->Status->EditValue = HtmlEncode($this->Status->AdvancedSearch->SearchValue);
			$curVal = strval($this->Status->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->Status->EditValue = $this->Status->lookupCacheOption($curVal);
				if ($this->Status->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Status->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Status->EditValue = $this->Status->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Status->EditValue = HtmlEncode($this->Status->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->Status->EditValue = NULL;
			}
			$this->Status->PlaceHolder = RemoveHtml($this->Status->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if (!$this->LACode->Raw)
				$this->LACode->AdvancedSearch->SearchValue = HtmlDecode($this->LACode->AdvancedSearch->SearchValue);
			$this->LACode->EditValue = HtmlEncode($this->LACode->AdvancedSearch->SearchValue);
			$curVal = strval($this->LACode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->LACode->EditValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->LACode->EditValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->EditValue = HtmlEncode($this->LACode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->LACode->EditValue = NULL;
			}
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

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

			// BudgetLine
			$this->BudgetLine->EditAttrs["class"] = "form-control";
			$this->BudgetLine->EditCustomAttributes = "";
			$this->BudgetLine->EditValue = HtmlEncode($this->BudgetLine->AdvancedSearch->SearchValue);
			$this->BudgetLine->PlaceHolder = RemoveHtml($this->BudgetLine->caption());

			// ProgramCode
			$this->ProgramCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProgramCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ProgramCode->AdvancedSearch->ViewValue = $this->ProgramCode->lookupCacheOption($curVal);
			else
				$this->ProgramCode->AdvancedSearch->ViewValue = $this->ProgramCode->Lookup !== NULL && is_array($this->ProgramCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProgramCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ProgramCode->EditValue = array_values($this->ProgramCode->Lookup->Options);
				if ($this->ProgramCode->AdvancedSearch->ViewValue == "")
					$this->ProgramCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProgramCode`" . SearchString("=", $this->ProgramCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProgramCode->AdvancedSearch->ViewValue = $this->ProgramCode->displayValue($arwrk);
				} else {
					$this->ProgramCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProgramCode->EditValue = $arwrk;
			}

			// SubProgramCode
			$this->SubProgramCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubProgramCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->SubProgramCode->AdvancedSearch->ViewValue = $this->SubProgramCode->lookupCacheOption($curVal);
			else
				$this->SubProgramCode->AdvancedSearch->ViewValue = $this->SubProgramCode->Lookup !== NULL && is_array($this->SubProgramCode->Lookup->Options) ? $curVal : NULL;
			if ($this->SubProgramCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->SubProgramCode->EditValue = array_values($this->SubProgramCode->Lookup->Options);
				if ($this->SubProgramCode->AdvancedSearch->ViewValue == "")
					$this->SubProgramCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SubProgramCode`" . SearchString("=", $this->SubProgramCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SubProgramCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->SubProgramCode->AdvancedSearch->ViewValue = $this->SubProgramCode->displayValue($arwrk);
				} else {
					$this->SubProgramCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubProgramCode->EditValue = $arwrk;
			}

			// ApprovedBudget
			$this->ApprovedBudget->EditAttrs["class"] = "form-control";
			$this->ApprovedBudget->EditCustomAttributes = "";
			$this->ApprovedBudget->EditValue = HtmlEncode($this->ApprovedBudget->AdvancedSearch->SearchValue);
			$this->ApprovedBudget->PlaceHolder = RemoveHtml($this->ApprovedBudget->caption());
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
		if (!CheckInteger($this->DetailedActionCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DetailedActionCode->errorMessage());
		}
		if (!CheckInteger($this->Quantity->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Quantity->errorMessage());
		}
		if (!CheckInteger($this->Frequency->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Frequency->errorMessage());
		}
		if (!CheckNumber($this->UnitCost->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->UnitCost->errorMessage());
		}
		if (!CheckNumber($this->BudgetEstimate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BudgetEstimate->errorMessage());
		}
		if (!CheckNumber($this->ActualAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ActualAmount->errorMessage());
		}
		if (!CheckInteger($this->BudgetLine->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BudgetLine->errorMessage());
		}
		if (!CheckNumber($this->ApprovedBudget->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ApprovedBudget->errorMessage());
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
		$this->OutcomeCode->AdvancedSearch->load();
		$this->OutputCode->AdvancedSearch->load();
		$this->ActionCode->AdvancedSearch->load();
		$this->DetailedActionCode->AdvancedSearch->load();
		$this->FinancialYear->AdvancedSearch->load();
		$this->AccountCode->AdvancedSearch->load();
		$this->MeansOfImplementation->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->Quantity->AdvancedSearch->load();
		$this->PeriodType->AdvancedSearch->load();
		$this->PeriodLength->AdvancedSearch->load();
		$this->Frequency->AdvancedSearch->load();
		$this->UnitCost->AdvancedSearch->load();
		$this->BudgetEstimate->AdvancedSearch->load();
		$this->ActualAmount->AdvancedSearch->load();
		$this->Status->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->BudgetLine->AdvancedSearch->load();
		$this->ProgramCode->AdvancedSearch->load();
		$this->SubProgramCode->AdvancedSearch->load();
		$this->ApprovedBudget->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("budgetlist.php"), "", $this->TableVar, TRUE);
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
				case "x_OutcomeCode":
					break;
				case "x_OutputCode":
					break;
				case "x_ActionCode":
					break;
				case "x_DetailedActionCode":
					break;
				case "x_FinancialYear":
					break;
				case "x_AccountCode":
					break;
				case "x_MeansOfImplementation":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PeriodType":
					break;
				case "x_Status":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProgramCode":
					break;
				case "x_SubProgramCode":
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
						case "x_OutcomeCode":
							break;
						case "x_OutputCode":
							break;
						case "x_ActionCode":
							break;
						case "x_DetailedActionCode":
							break;
						case "x_FinancialYear":
							break;
						case "x_AccountCode":
							break;
						case "x_MeansOfImplementation":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PeriodType":
							break;
						case "x_Status":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProgramCode":
							break;
						case "x_SubProgramCode":
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