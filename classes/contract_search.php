<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class contract_search extends contract
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'contract';

	// Page object name
	public $PageObjName = "contract_search";

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

		// Table object (contract)
		if (!isset($GLOBALS["contract"]) || get_class($GLOBALS["contract"]) == PROJECT_NAMESPACE . "contract") {
			$GLOBALS["contract"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["contract"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'contract');

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
		global $contract;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($contract);
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
					if ($pageName == "contractview.php")
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
			$key .= @$ar['ContractNo'];
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
					$this->terminate(GetUrl("contractlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->ProjectCode->setVisibility();
		$this->ContractNo->setVisibility();
		$this->ContractName->setVisibility();
		$this->ContractType->setVisibility();
		$this->ContractSum->setVisibility();
		$this->RevisedContractSum->setVisibility();
		$this->ContractorRef->setVisibility();
		$this->SigningDate->setVisibility();
		$this->PlannedStartDate->setVisibility();
		$this->PlannedEndDate->setVisibility();
		$this->ActualStartDate->setVisibility();
		$this->ActualEndDate->setVisibility();
		$this->Duration->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->AdvancePaymentAmount->setVisibility();
		$this->AdvancePaymentdate->setVisibility();
		$this->ContractStatus->setVisibility();
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
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->ProjectCode);
		$this->setupLookupOptions($this->ContractType);
		$this->setupLookupOptions($this->ContractorRef);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->ContractStatus);

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
					$srchStr = "contractlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->DepartmentCode); // DepartmentCode
		$this->buildSearchUrl($srchUrl, $this->SectionCode); // SectionCode
		$this->buildSearchUrl($srchUrl, $this->ProjectCode); // ProjectCode
		$this->buildSearchUrl($srchUrl, $this->ContractNo); // ContractNo
		$this->buildSearchUrl($srchUrl, $this->ContractName); // ContractName
		$this->buildSearchUrl($srchUrl, $this->ContractType); // ContractType
		$this->buildSearchUrl($srchUrl, $this->ContractSum); // ContractSum
		$this->buildSearchUrl($srchUrl, $this->RevisedContractSum); // RevisedContractSum
		$this->buildSearchUrl($srchUrl, $this->ContractorRef); // ContractorRef
		$this->buildSearchUrl($srchUrl, $this->SigningDate); // SigningDate
		$this->buildSearchUrl($srchUrl, $this->PlannedStartDate); // PlannedStartDate
		$this->buildSearchUrl($srchUrl, $this->PlannedEndDate); // PlannedEndDate
		$this->buildSearchUrl($srchUrl, $this->ActualStartDate); // ActualStartDate
		$this->buildSearchUrl($srchUrl, $this->ActualEndDate); // ActualEndDate
		$this->buildSearchUrl($srchUrl, $this->Duration); // Duration
		$this->buildSearchUrl($srchUrl, $this->UnitOfMeasure); // UnitOfMeasure
		$this->buildSearchUrl($srchUrl, $this->AdvancePaymentAmount); // AdvancePaymentAmount
		$this->buildSearchUrl($srchUrl, $this->AdvancePaymentdate); // AdvancePaymentdate
		$this->buildSearchUrl($srchUrl, $this->ContractStatus); // ContractStatus
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
		if ($this->DepartmentCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SectionCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ProjectCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractType->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractSum->AdvancedSearch->post())
			$got = TRUE;
		if ($this->RevisedContractSum->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractorRef->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SigningDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PlannedStartDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PlannedEndDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ActualStartDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ActualEndDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Duration->AdvancedSearch->post())
			$got = TRUE;
		if ($this->UnitOfMeasure->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AdvancePaymentAmount->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AdvancePaymentdate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractStatus->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->ContractSum->FormValue == $this->ContractSum->CurrentValue && is_numeric(ConvertToFloatString($this->ContractSum->CurrentValue)))
			$this->ContractSum->CurrentValue = ConvertToFloatString($this->ContractSum->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RevisedContractSum->FormValue == $this->RevisedContractSum->CurrentValue && is_numeric(ConvertToFloatString($this->RevisedContractSum->CurrentValue)))
			$this->RevisedContractSum->CurrentValue = ConvertToFloatString($this->RevisedContractSum->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Duration->FormValue == $this->Duration->CurrentValue && is_numeric(ConvertToFloatString($this->Duration->CurrentValue)))
			$this->Duration->CurrentValue = ConvertToFloatString($this->Duration->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AdvancePaymentAmount->FormValue == $this->AdvancePaymentAmount->CurrentValue && is_numeric(ConvertToFloatString($this->AdvancePaymentAmount->CurrentValue)))
			$this->AdvancePaymentAmount->CurrentValue = ConvertToFloatString($this->AdvancePaymentAmount->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// LACode
		// DepartmentCode
		// SectionCode
		// ProjectCode
		// ContractNo
		// ContractName
		// ContractType
		// ContractSum
		// RevisedContractSum
		// ContractorRef
		// SigningDate
		// PlannedStartDate
		// PlannedEndDate
		// ActualStartDate
		// ActualEndDate
		// Duration
		// UnitOfMeasure
		// AdvancePaymentAmount
		// AdvancePaymentdate
		// ContractStatus

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// ProjectCode
			$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
			$curVal = strval($this->ProjectCode->CurrentValue);
			if ($curVal != "") {
				$this->ProjectCode->ViewValue = $this->ProjectCode->lookupCacheOption($curVal);
				if ($this->ProjectCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProjectCode->ViewValue = $this->ProjectCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectCode->ViewValue = $this->ProjectCode->CurrentValue;
					}
				}
			} else {
				$this->ProjectCode->ViewValue = NULL;
			}
			$this->ProjectCode->ViewCustomAttributes = "";

			// ContractNo
			$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->ViewCustomAttributes = "";

			// ContractName
			$this->ContractName->ViewValue = $this->ContractName->CurrentValue;
			$this->ContractName->ViewCustomAttributes = "";

			// ContractType
			$curVal = strval($this->ContractType->CurrentValue);
			if ($curVal != "") {
				$this->ContractType->ViewValue = $this->ContractType->lookupCacheOption($curVal);
				if ($this->ContractType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractType->ViewValue = $this->ContractType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
					}
				}
			} else {
				$this->ContractType->ViewValue = NULL;
			}
			$this->ContractType->ViewCustomAttributes = "";

			// ContractSum
			$this->ContractSum->ViewValue = $this->ContractSum->CurrentValue;
			$this->ContractSum->ViewValue = FormatNumber($this->ContractSum->ViewValue, 2, -2, -2, -2);
			$this->ContractSum->CellCssStyle .= "text-align: right;";
			$this->ContractSum->ViewCustomAttributes = "";

			// RevisedContractSum
			$this->RevisedContractSum->ViewValue = $this->RevisedContractSum->CurrentValue;
			$this->RevisedContractSum->ViewValue = FormatNumber($this->RevisedContractSum->ViewValue, 2, -2, -2, -2);
			$this->RevisedContractSum->CellCssStyle .= "text-align: right;";
			$this->RevisedContractSum->ViewCustomAttributes = "";

			// ContractorRef
			$curVal = strval($this->ContractorRef->CurrentValue);
			if ($curVal != "") {
				$this->ContractorRef->ViewValue = $this->ContractorRef->lookupCacheOption($curVal);
				if ($this->ContractorRef->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractorRef`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractorRef->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractorRef->ViewValue = $this->ContractorRef->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractorRef->ViewValue = $this->ContractorRef->CurrentValue;
					}
				}
			} else {
				$this->ContractorRef->ViewValue = NULL;
			}
			$this->ContractorRef->ViewCustomAttributes = "";

			// SigningDate
			$this->SigningDate->ViewValue = $this->SigningDate->CurrentValue;
			$this->SigningDate->ViewValue = FormatDateTime($this->SigningDate->ViewValue, 0);
			$this->SigningDate->ViewCustomAttributes = "";

			// PlannedStartDate
			$this->PlannedStartDate->ViewValue = $this->PlannedStartDate->CurrentValue;
			$this->PlannedStartDate->ViewValue = FormatDateTime($this->PlannedStartDate->ViewValue, 0);
			$this->PlannedStartDate->ViewCustomAttributes = "";

			// PlannedEndDate
			$this->PlannedEndDate->ViewValue = $this->PlannedEndDate->CurrentValue;
			$this->PlannedEndDate->ViewValue = FormatDateTime($this->PlannedEndDate->ViewValue, 0);
			$this->PlannedEndDate->ViewCustomAttributes = "";

			// ActualStartDate
			$this->ActualStartDate->ViewValue = $this->ActualStartDate->CurrentValue;
			$this->ActualStartDate->ViewValue = FormatDateTime($this->ActualStartDate->ViewValue, 0);
			$this->ActualStartDate->ViewCustomAttributes = "";

			// ActualEndDate
			$this->ActualEndDate->ViewValue = $this->ActualEndDate->CurrentValue;
			$this->ActualEndDate->ViewValue = FormatDateTime($this->ActualEndDate->ViewValue, 0);
			$this->ActualEndDate->ViewCustomAttributes = "";

			// Duration
			$this->Duration->ViewValue = $this->Duration->CurrentValue;
			$this->Duration->ViewValue = FormatNumber($this->Duration->ViewValue, 2, -2, -2, -2);
			$this->Duration->ViewCustomAttributes = "";

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

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->ViewValue = $this->AdvancePaymentAmount->CurrentValue;
			$this->AdvancePaymentAmount->ViewValue = FormatNumber($this->AdvancePaymentAmount->ViewValue, 2, -2, -2, -2);
			$this->AdvancePaymentAmount->CellCssStyle .= "text-align: right;";
			$this->AdvancePaymentAmount->ViewCustomAttributes = "";

			// AdvancePaymentdate
			$this->AdvancePaymentdate->ViewValue = $this->AdvancePaymentdate->CurrentValue;
			$this->AdvancePaymentdate->ViewValue = FormatDateTime($this->AdvancePaymentdate->ViewValue, 0);
			$this->AdvancePaymentdate->ViewCustomAttributes = "";

			// ContractStatus
			$curVal = strval($this->ContractStatus->CurrentValue);
			if ($curVal != "") {
				$this->ContractStatus->ViewValue = $this->ContractStatus->lookupCacheOption($curVal);
				if ($this->ContractStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ContractStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ContractStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ContractStatus->ViewValue = $this->ContractStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ContractStatus->ViewValue = $this->ContractStatus->CurrentValue;
					}
				}
			} else {
				$this->ContractStatus->ViewValue = NULL;
			}
			$this->ContractStatus->ViewCustomAttributes = "";

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

			// ProjectCode
			$this->ProjectCode->LinkCustomAttributes = "";
			$this->ProjectCode->HrefValue = "";
			$this->ProjectCode->TooltipValue = "";

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";
			$this->ContractNo->TooltipValue = "";

			// ContractName
			$this->ContractName->LinkCustomAttributes = "";
			$this->ContractName->HrefValue = "";
			$this->ContractName->TooltipValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
			$this->ContractType->TooltipValue = "";

			// ContractSum
			$this->ContractSum->LinkCustomAttributes = "";
			$this->ContractSum->HrefValue = "";
			$this->ContractSum->TooltipValue = "";

			// RevisedContractSum
			$this->RevisedContractSum->LinkCustomAttributes = "";
			$this->RevisedContractSum->HrefValue = "";
			$this->RevisedContractSum->TooltipValue = "";

			// ContractorRef
			$this->ContractorRef->LinkCustomAttributes = "";
			$this->ContractorRef->HrefValue = "";
			$this->ContractorRef->TooltipValue = "";

			// SigningDate
			$this->SigningDate->LinkCustomAttributes = "";
			$this->SigningDate->HrefValue = "";
			$this->SigningDate->TooltipValue = "";

			// PlannedStartDate
			$this->PlannedStartDate->LinkCustomAttributes = "";
			$this->PlannedStartDate->HrefValue = "";
			$this->PlannedStartDate->TooltipValue = "";

			// PlannedEndDate
			$this->PlannedEndDate->LinkCustomAttributes = "";
			$this->PlannedEndDate->HrefValue = "";
			$this->PlannedEndDate->TooltipValue = "";

			// ActualStartDate
			$this->ActualStartDate->LinkCustomAttributes = "";
			$this->ActualStartDate->HrefValue = "";
			$this->ActualStartDate->TooltipValue = "";

			// ActualEndDate
			$this->ActualEndDate->LinkCustomAttributes = "";
			$this->ActualEndDate->HrefValue = "";
			$this->ActualEndDate->TooltipValue = "";

			// Duration
			$this->Duration->LinkCustomAttributes = "";
			$this->Duration->HrefValue = "";
			$this->Duration->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->LinkCustomAttributes = "";
			$this->AdvancePaymentAmount->HrefValue = "";
			$this->AdvancePaymentAmount->TooltipValue = "";

			// AdvancePaymentdate
			$this->AdvancePaymentdate->LinkCustomAttributes = "";
			$this->AdvancePaymentdate->HrefValue = "";
			$this->AdvancePaymentdate->TooltipValue = "";

			// ContractStatus
			$this->ContractStatus->LinkCustomAttributes = "";
			$this->ContractStatus->HrefValue = "";
			$this->ContractStatus->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// LACode
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
				if ($this->LACode->AdvancedSearch->ViewValue == "")
					$this->LACode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->LACode->AdvancedSearch->ViewValue = $this->LACode->displayValue($arwrk);
				} else {
					$this->LACode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
				if ($this->DepartmentCode->AdvancedSearch->ViewValue == "")
					$this->DepartmentCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->DepartmentCode->AdvancedSearch->ViewValue = $this->DepartmentCode->displayValue($arwrk);
				} else {
					$this->DepartmentCode->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
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

			// ProjectCode
			$this->ProjectCode->EditAttrs["class"] = "form-control";
			$this->ProjectCode->EditCustomAttributes = "";
			if (!$this->ProjectCode->Raw)
				$this->ProjectCode->AdvancedSearch->SearchValue = HtmlDecode($this->ProjectCode->AdvancedSearch->SearchValue);
			$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->ProjectCode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ProjectCode->EditValue = $this->ProjectCode->lookupCacheOption($curVal);
				if ($this->ProjectCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProjectCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProjectCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProjectCode->EditValue = $this->ProjectCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProjectCode->EditValue = HtmlEncode($this->ProjectCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ProjectCode->EditValue = NULL;
			}
			$this->ProjectCode->PlaceHolder = RemoveHtml($this->ProjectCode->caption());

			// ContractNo
			$this->ContractNo->EditAttrs["class"] = "form-control";
			$this->ContractNo->EditCustomAttributes = "";
			if (!$this->ContractNo->Raw)
				$this->ContractNo->AdvancedSearch->SearchValue = HtmlDecode($this->ContractNo->AdvancedSearch->SearchValue);
			$this->ContractNo->EditValue = HtmlEncode($this->ContractNo->AdvancedSearch->SearchValue);
			$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());

			// ContractName
			$this->ContractName->EditAttrs["class"] = "form-control";
			$this->ContractName->EditCustomAttributes = "";
			if (!$this->ContractName->Raw)
				$this->ContractName->AdvancedSearch->SearchValue = HtmlDecode($this->ContractName->AdvancedSearch->SearchValue);
			$this->ContractName->EditValue = HtmlEncode($this->ContractName->AdvancedSearch->SearchValue);
			$this->ContractName->PlaceHolder = RemoveHtml($this->ContractName->caption());

			// ContractType
			$this->ContractType->EditAttrs["class"] = "form-control";
			$this->ContractType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractType->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ContractType->AdvancedSearch->ViewValue = $this->ContractType->lookupCacheOption($curVal);
			else
				$this->ContractType->AdvancedSearch->ViewValue = $this->ContractType->Lookup !== NULL && is_array($this->ContractType->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractType->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ContractType->EditValue = array_values($this->ContractType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractType`" . SearchString("=", $this->ContractType->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractType->EditValue = $arwrk;
			}

			// ContractSum
			$this->ContractSum->EditAttrs["class"] = "form-control";
			$this->ContractSum->EditCustomAttributes = "";
			$this->ContractSum->EditValue = HtmlEncode($this->ContractSum->AdvancedSearch->SearchValue);
			$this->ContractSum->PlaceHolder = RemoveHtml($this->ContractSum->caption());

			// RevisedContractSum
			$this->RevisedContractSum->EditAttrs["class"] = "form-control";
			$this->RevisedContractSum->EditCustomAttributes = "";
			$this->RevisedContractSum->EditValue = HtmlEncode($this->RevisedContractSum->AdvancedSearch->SearchValue);
			$this->RevisedContractSum->PlaceHolder = RemoveHtml($this->RevisedContractSum->caption());

			// ContractorRef
			$this->ContractorRef->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractorRef->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ContractorRef->AdvancedSearch->ViewValue = $this->ContractorRef->lookupCacheOption($curVal);
			else
				$this->ContractorRef->AdvancedSearch->ViewValue = $this->ContractorRef->Lookup !== NULL && is_array($this->ContractorRef->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractorRef->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ContractorRef->EditValue = array_values($this->ContractorRef->Lookup->Options);
				if ($this->ContractorRef->AdvancedSearch->ViewValue == "")
					$this->ContractorRef->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractorRef`" . SearchString("=", $this->ContractorRef->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractorRef->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ContractorRef->AdvancedSearch->ViewValue = $this->ContractorRef->displayValue($arwrk);
				} else {
					$this->ContractorRef->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractorRef->EditValue = $arwrk;
			}

			// SigningDate
			$this->SigningDate->EditAttrs["class"] = "form-control";
			$this->SigningDate->EditCustomAttributes = "";
			$this->SigningDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->SigningDate->AdvancedSearch->SearchValue, 0), 8));
			$this->SigningDate->PlaceHolder = RemoveHtml($this->SigningDate->caption());

			// PlannedStartDate
			$this->PlannedStartDate->EditAttrs["class"] = "form-control";
			$this->PlannedStartDate->EditCustomAttributes = "";
			$this->PlannedStartDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->PlannedStartDate->AdvancedSearch->SearchValue, 0), 8));
			$this->PlannedStartDate->PlaceHolder = RemoveHtml($this->PlannedStartDate->caption());

			// PlannedEndDate
			$this->PlannedEndDate->EditAttrs["class"] = "form-control";
			$this->PlannedEndDate->EditCustomAttributes = "";
			$this->PlannedEndDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->PlannedEndDate->AdvancedSearch->SearchValue, 0), 8));
			$this->PlannedEndDate->PlaceHolder = RemoveHtml($this->PlannedEndDate->caption());

			// ActualStartDate
			$this->ActualStartDate->EditAttrs["class"] = "form-control";
			$this->ActualStartDate->EditCustomAttributes = "";
			$this->ActualStartDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ActualStartDate->AdvancedSearch->SearchValue, 0), 8));
			$this->ActualStartDate->PlaceHolder = RemoveHtml($this->ActualStartDate->caption());

			// ActualEndDate
			$this->ActualEndDate->EditAttrs["class"] = "form-control";
			$this->ActualEndDate->EditCustomAttributes = "";
			$this->ActualEndDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ActualEndDate->AdvancedSearch->SearchValue, 0), 8));
			$this->ActualEndDate->PlaceHolder = RemoveHtml($this->ActualEndDate->caption());

			// Duration
			$this->Duration->EditAttrs["class"] = "form-control";
			$this->Duration->EditCustomAttributes = "";
			$this->Duration->EditValue = HtmlEncode($this->Duration->AdvancedSearch->SearchValue);
			$this->Duration->PlaceHolder = RemoveHtml($this->Duration->caption());

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

			// AdvancePaymentAmount
			$this->AdvancePaymentAmount->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentAmount->EditCustomAttributes = "";
			$this->AdvancePaymentAmount->EditValue = HtmlEncode($this->AdvancePaymentAmount->AdvancedSearch->SearchValue);
			$this->AdvancePaymentAmount->PlaceHolder = RemoveHtml($this->AdvancePaymentAmount->caption());

			// AdvancePaymentdate
			$this->AdvancePaymentdate->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentdate->EditCustomAttributes = "";
			$this->AdvancePaymentdate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->AdvancePaymentdate->AdvancedSearch->SearchValue, 0), 8));
			$this->AdvancePaymentdate->PlaceHolder = RemoveHtml($this->AdvancePaymentdate->caption());

			// ContractStatus
			$this->ContractStatus->EditAttrs["class"] = "form-control";
			$this->ContractStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->ContractStatus->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ContractStatus->AdvancedSearch->ViewValue = $this->ContractStatus->lookupCacheOption($curVal);
			else
				$this->ContractStatus->AdvancedSearch->ViewValue = $this->ContractStatus->Lookup !== NULL && is_array($this->ContractStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->ContractStatus->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ContractStatus->EditValue = array_values($this->ContractStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ContractStatus`" . SearchString("=", $this->ContractStatus->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ContractStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ContractStatus->EditValue = $arwrk;
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
		if (!CheckNumber($this->ContractSum->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ContractSum->errorMessage());
		}
		if (!CheckNumber($this->RevisedContractSum->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->RevisedContractSum->errorMessage());
		}
		if (!CheckDate($this->SigningDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->SigningDate->errorMessage());
		}
		if (!CheckDate($this->PlannedStartDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PlannedStartDate->errorMessage());
		}
		if (!CheckDate($this->PlannedEndDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PlannedEndDate->errorMessage());
		}
		if (!CheckDate($this->ActualStartDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ActualStartDate->errorMessage());
		}
		if (!CheckDate($this->ActualEndDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ActualEndDate->errorMessage());
		}
		if (!CheckNumber($this->Duration->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Duration->errorMessage());
		}
		if (!CheckNumber($this->AdvancePaymentAmount->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AdvancePaymentAmount->errorMessage());
		}
		if (!CheckDate($this->AdvancePaymentdate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AdvancePaymentdate->errorMessage());
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
		$this->DepartmentCode->AdvancedSearch->load();
		$this->SectionCode->AdvancedSearch->load();
		$this->ProjectCode->AdvancedSearch->load();
		$this->ContractNo->AdvancedSearch->load();
		$this->ContractName->AdvancedSearch->load();
		$this->ContractType->AdvancedSearch->load();
		$this->ContractSum->AdvancedSearch->load();
		$this->RevisedContractSum->AdvancedSearch->load();
		$this->ContractorRef->AdvancedSearch->load();
		$this->SigningDate->AdvancedSearch->load();
		$this->PlannedStartDate->AdvancedSearch->load();
		$this->PlannedEndDate->AdvancedSearch->load();
		$this->ActualStartDate->AdvancedSearch->load();
		$this->ActualEndDate->AdvancedSearch->load();
		$this->Duration->AdvancedSearch->load();
		$this->UnitOfMeasure->AdvancedSearch->load();
		$this->AdvancePaymentAmount->AdvancedSearch->load();
		$this->AdvancePaymentdate->AdvancedSearch->load();
		$this->ContractStatus->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("contractlist.php"), "", $this->TableVar, TRUE);
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
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_ProjectCode":
					break;
				case "x_ContractType":
					break;
				case "x_ContractorRef":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_ContractStatus":
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
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_ProjectCode":
							break;
						case "x_ContractType":
							break;
						case "x_ContractorRef":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_ContractStatus":
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