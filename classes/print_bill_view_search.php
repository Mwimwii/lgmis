<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class print_bill_view_search extends print_bill_view
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'print_bill_view';

	// Page object name
	public $PageObjName = "print_bill_view_search";

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

		// Table object (print_bill_view)
		if (!isset($GLOBALS["print_bill_view"]) || get_class($GLOBALS["print_bill_view"]) == PROJECT_NAMESPACE . "print_bill_view") {
			$GLOBALS["print_bill_view"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["print_bill_view"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'print_bill_view');

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
		global $print_bill_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($print_bill_view);
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
					if ($pageName == "print_bill_viewview.php")
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
			$key .= @$ar['ValuationNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ReferenceNo'];
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
			$this->ValuationNo->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ReferenceNo->Visible = FALSE;
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
					$this->terminate(GetUrl("print_bill_viewlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ValuationNo->setVisibility();
		$this->PropertyNo->setVisibility();
		$this->ClientSerNo->setVisibility();
		$this->PropertyGroup->setVisibility();
		$this->Location->setVisibility();
		$this->PropertyUse->setVisibility();
		$this->RateableValue->setVisibility();
		$this->ReferenceNo->setVisibility();
		$this->ChargeCode->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->ClientID->setVisibility();
		$this->BillYear->setVisibility();
		$this->BillPeriod->setVisibility();
		$this->StartDate->setVisibility();
		$this->EndDate->setVisibility();
		$this->BalanceBF->setVisibility();
		$this->AmountDue->setVisibility();
		$this->VAT->setVisibility();
		$this->SalesTax->setVisibility();
		$this->AmountPaid->setVisibility();
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
		$this->setupLookupOptions($this->PropertyGroup);
		$this->setupLookupOptions($this->Location);
		$this->setupLookupOptions($this->PropertyUse);
		$this->setupLookupOptions($this->ChargeCode);
		$this->setupLookupOptions($this->ChargeGroup);
		$this->setupLookupOptions($this->BillYear);

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
					$srchStr = "print_bill_viewlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->ValuationNo); // ValuationNo
		$this->buildSearchUrl($srchUrl, $this->PropertyNo); // PropertyNo
		$this->buildSearchUrl($srchUrl, $this->ClientSerNo); // ClientSerNo
		$this->buildSearchUrl($srchUrl, $this->PropertyGroup); // PropertyGroup
		$this->buildSearchUrl($srchUrl, $this->Location); // Location
		$this->buildSearchUrl($srchUrl, $this->PropertyUse); // PropertyUse
		$this->buildSearchUrl($srchUrl, $this->RateableValue); // RateableValue
		$this->buildSearchUrl($srchUrl, $this->ReferenceNo); // ReferenceNo
		$this->buildSearchUrl($srchUrl, $this->ChargeCode); // ChargeCode
		$this->buildSearchUrl($srchUrl, $this->ChargeGroup); // ChargeGroup
		$this->buildSearchUrl($srchUrl, $this->ClientID); // ClientID
		$this->buildSearchUrl($srchUrl, $this->BillYear); // BillYear
		$this->buildSearchUrl($srchUrl, $this->BillPeriod); // BillPeriod
		$this->buildSearchUrl($srchUrl, $this->StartDate); // StartDate
		$this->buildSearchUrl($srchUrl, $this->EndDate); // EndDate
		$this->buildSearchUrl($srchUrl, $this->BalanceBF); // BalanceBF
		$this->buildSearchUrl($srchUrl, $this->AmountDue); // AmountDue
		$this->buildSearchUrl($srchUrl, $this->VAT); // VAT
		$this->buildSearchUrl($srchUrl, $this->SalesTax); // SalesTax
		$this->buildSearchUrl($srchUrl, $this->AmountPaid); // AmountPaid
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
		if ($this->ValuationNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PropertyNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ClientSerNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PropertyGroup->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Location->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->Location->AdvancedSearch->SearchValue))
			$this->Location->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Location->AdvancedSearch->SearchValue);
		if (is_array($this->Location->AdvancedSearch->SearchValue2))
			$this->Location->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->Location->AdvancedSearch->SearchValue2);
		if ($this->PropertyUse->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->PropertyUse->AdvancedSearch->SearchValue))
			$this->PropertyUse->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->PropertyUse->AdvancedSearch->SearchValue);
		if (is_array($this->PropertyUse->AdvancedSearch->SearchValue2))
			$this->PropertyUse->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->PropertyUse->AdvancedSearch->SearchValue2);
		if ($this->RateableValue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReferenceNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ChargeCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ChargeGroup->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->ChargeGroup->AdvancedSearch->SearchValue))
			$this->ChargeGroup->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ChargeGroup->AdvancedSearch->SearchValue);
		if (is_array($this->ChargeGroup->AdvancedSearch->SearchValue2))
			$this->ChargeGroup->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ChargeGroup->AdvancedSearch->SearchValue2);
		if ($this->ClientID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BillYear->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BillPeriod->AdvancedSearch->post())
			$got = TRUE;
		if ($this->StartDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->EndDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->BalanceBF->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AmountDue->AdvancedSearch->post())
			$got = TRUE;
		if ($this->VAT->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SalesTax->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AmountPaid->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->RateableValue->FormValue == $this->RateableValue->CurrentValue && is_numeric(ConvertToFloatString($this->RateableValue->CurrentValue)))
			$this->RateableValue->CurrentValue = ConvertToFloatString($this->RateableValue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BalanceBF->FormValue == $this->BalanceBF->CurrentValue && is_numeric(ConvertToFloatString($this->BalanceBF->CurrentValue)))
			$this->BalanceBF->CurrentValue = ConvertToFloatString($this->BalanceBF->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountDue->FormValue == $this->AmountDue->CurrentValue && is_numeric(ConvertToFloatString($this->AmountDue->CurrentValue)))
			$this->AmountDue->CurrentValue = ConvertToFloatString($this->AmountDue->CurrentValue);

		// Convert decimal values if posted back
		if ($this->VAT->FormValue == $this->VAT->CurrentValue && is_numeric(ConvertToFloatString($this->VAT->CurrentValue)))
			$this->VAT->CurrentValue = ConvertToFloatString($this->VAT->CurrentValue);

		// Convert decimal values if posted back
		if ($this->SalesTax->FormValue == $this->SalesTax->CurrentValue && is_numeric(ConvertToFloatString($this->SalesTax->CurrentValue)))
			$this->SalesTax->CurrentValue = ConvertToFloatString($this->SalesTax->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ValuationNo
		// PropertyNo
		// ClientSerNo
		// PropertyGroup
		// Location
		// PropertyUse
		// RateableValue
		// ReferenceNo
		// ChargeCode
		// ChargeGroup
		// ClientID
		// BillYear
		// BillPeriod
		// StartDate
		// EndDate
		// BalanceBF
		// AmountDue
		// VAT
		// SalesTax
		// AmountPaid

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ValuationNo
			$this->ValuationNo->ViewValue = $this->ValuationNo->CurrentValue;
			$this->ValuationNo->ViewCustomAttributes = "";

			// PropertyNo
			$this->PropertyNo->ViewValue = $this->PropertyNo->CurrentValue;
			$this->PropertyNo->ViewCustomAttributes = "";

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

			// PropertyGroup
			$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
			$curVal = strval($this->PropertyGroup->CurrentValue);
			if ($curVal != "") {
				$this->PropertyGroup->ViewValue = $this->PropertyGroup->lookupCacheOption($curVal);
				if ($this->PropertyGroup->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyGroup`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyGroup->ViewValue = $this->PropertyGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyGroup->ViewValue = $this->PropertyGroup->CurrentValue;
					}
				}
			} else {
				$this->PropertyGroup->ViewValue = NULL;
			}
			$this->PropertyGroup->ViewCustomAttributes = "";

			// Location
			$curVal = strval($this->Location->CurrentValue);
			if ($curVal != "") {
				$this->Location->ViewValue = $this->Location->lookupCacheOption($curVal);
				if ($this->Location->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->Location->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Location->ViewValue->add($this->Location->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->Location->ViewValue = $this->Location->CurrentValue;
					}
				}
			} else {
				$this->Location->ViewValue = NULL;
			}
			$this->Location->ViewCustomAttributes = "";

			// PropertyUse
			$curVal = strval($this->PropertyUse->CurrentValue);
			if ($curVal != "") {
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
				if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->PropertyUse->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->PropertyUse->ViewValue->add($this->PropertyUse->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
					}
				}
			} else {
				$this->PropertyUse->ViewValue = NULL;
			}
			$this->PropertyUse->ViewCustomAttributes = "";

			// RateableValue
			$this->RateableValue->ViewValue = $this->RateableValue->CurrentValue;
			$this->RateableValue->ViewValue = FormatNumber($this->RateableValue->ViewValue, 2, -2, -2, -2);
			$this->RateableValue->ViewCustomAttributes = "";

			// ReferenceNo
			$this->ReferenceNo->ViewValue = $this->ReferenceNo->CurrentValue;
			$this->ReferenceNo->ViewCustomAttributes = "";

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

			// ChargeGroup
			$curVal = strval($this->ChargeGroup->CurrentValue);
			if ($curVal != "") {
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
				if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeGroup`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
					$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->ChargeGroup->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->ChargeGroup->ViewValue->add($this->ChargeGroup->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
					}
				}
			} else {
				$this->ChargeGroup->ViewValue = NULL;
			}
			$this->ChargeGroup->ViewCustomAttributes = "";

			// ClientID
			$this->ClientID->ViewValue = $this->ClientID->CurrentValue;
			$this->ClientID->ViewCustomAttributes = "";

			// BillYear
			$curVal = strval($this->BillYear->CurrentValue);
			if ($curVal != "") {
				$this->BillYear->ViewValue = $this->BillYear->lookupCacheOption($curVal);
				if ($this->BillYear->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Year`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BillYear->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->BillYear->ViewValue = $this->BillYear->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BillYear->ViewValue = $this->BillYear->CurrentValue;
					}
				}
			} else {
				$this->BillYear->ViewValue = NULL;
			}
			$this->BillYear->ViewCustomAttributes = "";

			// BillPeriod
			$this->BillPeriod->ViewValue = $this->BillPeriod->CurrentValue;
			$this->BillPeriod->ViewValue = FormatNumber($this->BillPeriod->ViewValue, 0, -2, -2, -2);
			$this->BillPeriod->ViewCustomAttributes = "";

			// StartDate
			$this->StartDate->ViewValue = $this->StartDate->CurrentValue;
			$this->StartDate->ViewValue = FormatDateTime($this->StartDate->ViewValue, 0);
			$this->StartDate->ViewCustomAttributes = "";

			// EndDate
			$this->EndDate->ViewValue = $this->EndDate->CurrentValue;
			$this->EndDate->ViewValue = FormatDateTime($this->EndDate->ViewValue, 0);
			$this->EndDate->ViewCustomAttributes = "";

			// BalanceBF
			$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
			$this->BalanceBF->ViewValue = FormatNumber($this->BalanceBF->ViewValue, 2, -2, -2, -2);
			$this->BalanceBF->ViewCustomAttributes = "";

			// AmountDue
			$this->AmountDue->ViewValue = $this->AmountDue->CurrentValue;
			$this->AmountDue->ViewValue = FormatNumber($this->AmountDue->ViewValue, 2, -2, -2, -2);
			$this->AmountDue->ViewCustomAttributes = "";

			// VAT
			$this->VAT->ViewValue = $this->VAT->CurrentValue;
			$this->VAT->ViewValue = FormatNumber($this->VAT->ViewValue, 2, -2, -2, -2);
			$this->VAT->ViewCustomAttributes = "";

			// SalesTax
			$this->SalesTax->ViewValue = $this->SalesTax->CurrentValue;
			$this->SalesTax->ViewValue = FormatNumber($this->SalesTax->ViewValue, 2, -2, -2, -2);
			$this->SalesTax->ViewCustomAttributes = "";

			// AmountPaid
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatNumber($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->ViewCustomAttributes = "";

			// ValuationNo
			$this->ValuationNo->LinkCustomAttributes = "";
			$this->ValuationNo->HrefValue = "";
			$this->ValuationNo->TooltipValue = "";

			// PropertyNo
			$this->PropertyNo->LinkCustomAttributes = "";
			$this->PropertyNo->HrefValue = "";
			$this->PropertyNo->TooltipValue = "";

			// ClientSerNo
			$this->ClientSerNo->LinkCustomAttributes = "";
			$this->ClientSerNo->HrefValue = "";
			$this->ClientSerNo->TooltipValue = "";

			// PropertyGroup
			$this->PropertyGroup->LinkCustomAttributes = "";
			$this->PropertyGroup->HrefValue = "";
			$this->PropertyGroup->TooltipValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";

			// RateableValue
			$this->RateableValue->LinkCustomAttributes = "";
			$this->RateableValue->HrefValue = "";
			$this->RateableValue->TooltipValue = "";

			// ReferenceNo
			$this->ReferenceNo->LinkCustomAttributes = "";
			$this->ReferenceNo->HrefValue = "";
			$this->ReferenceNo->TooltipValue = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// ClientID
			$this->ClientID->LinkCustomAttributes = "";
			$this->ClientID->HrefValue = "";
			$this->ClientID->TooltipValue = "";

			// BillYear
			$this->BillYear->LinkCustomAttributes = "";
			$this->BillYear->HrefValue = "";
			$this->BillYear->TooltipValue = "";

			// BillPeriod
			$this->BillPeriod->LinkCustomAttributes = "";
			$this->BillPeriod->HrefValue = "";
			$this->BillPeriod->TooltipValue = "";

			// StartDate
			$this->StartDate->LinkCustomAttributes = "";
			$this->StartDate->HrefValue = "";
			$this->StartDate->TooltipValue = "";

			// EndDate
			$this->EndDate->LinkCustomAttributes = "";
			$this->EndDate->HrefValue = "";
			$this->EndDate->TooltipValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";
			$this->BalanceBF->TooltipValue = "";

			// AmountDue
			$this->AmountDue->LinkCustomAttributes = "";
			$this->AmountDue->HrefValue = "";
			$this->AmountDue->TooltipValue = "";

			// VAT
			$this->VAT->LinkCustomAttributes = "";
			$this->VAT->HrefValue = "";
			$this->VAT->TooltipValue = "";

			// SalesTax
			$this->SalesTax->LinkCustomAttributes = "";
			$this->SalesTax->HrefValue = "";
			$this->SalesTax->TooltipValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// ValuationNo
			$this->ValuationNo->EditAttrs["class"] = "form-control";
			$this->ValuationNo->EditCustomAttributes = "";
			$this->ValuationNo->EditValue = HtmlEncode($this->ValuationNo->AdvancedSearch->SearchValue);
			$this->ValuationNo->PlaceHolder = RemoveHtml($this->ValuationNo->caption());

			// PropertyNo
			$this->PropertyNo->EditAttrs["class"] = "form-control";
			$this->PropertyNo->EditCustomAttributes = "";
			if (!$this->PropertyNo->Raw)
				$this->PropertyNo->AdvancedSearch->SearchValue = HtmlDecode($this->PropertyNo->AdvancedSearch->SearchValue);
			$this->PropertyNo->EditValue = HtmlEncode($this->PropertyNo->AdvancedSearch->SearchValue);
			$this->PropertyNo->PlaceHolder = RemoveHtml($this->PropertyNo->caption());

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

			// PropertyGroup
			$this->PropertyGroup->EditAttrs["class"] = "form-control";
			$this->PropertyGroup->EditCustomAttributes = "";
			$this->PropertyGroup->EditValue = HtmlEncode($this->PropertyGroup->AdvancedSearch->SearchValue);
			$curVal = strval($this->PropertyGroup->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->PropertyGroup->EditValue = $this->PropertyGroup->lookupCacheOption($curVal);
				if ($this->PropertyGroup->EditValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyGroup`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PropertyGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PropertyGroup->EditValue = $this->PropertyGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyGroup->EditValue = HtmlEncode($this->PropertyGroup->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->PropertyGroup->EditValue = NULL;
			}
			$this->PropertyGroup->PlaceHolder = RemoveHtml($this->PropertyGroup->caption());

			// Location
			$this->Location->EditCustomAttributes = "";
			$curVal = trim(strval($this->Location->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Location->AdvancedSearch->ViewValue = $this->Location->lookupCacheOption($curVal);
			else
				$this->Location->AdvancedSearch->ViewValue = $this->Location->Lookup !== NULL && is_array($this->Location->Lookup->Options) ? $curVal : NULL;
			if ($this->Location->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Location->EditValue = array_values($this->Location->Lookup->Options);
				if ($this->Location->AdvancedSearch->ViewValue == "")
					$this->Location->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`AreaName`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->Location->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->Location->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->Location->AdvancedSearch->ViewValue->add($this->Location->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->Location->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Location->EditValue = $arwrk;
			}

			// PropertyUse
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PropertyUse->AdvancedSearch->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->AdvancedSearch->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
				if ($this->PropertyUse->AdvancedSearch->ViewValue == "")
					$this->PropertyUse->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`PropertyUse`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->PropertyUse->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->PropertyUse->AdvancedSearch->ViewValue->add($this->PropertyUse->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->PropertyUse->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// RateableValue
			$this->RateableValue->EditAttrs["class"] = "form-control";
			$this->RateableValue->EditCustomAttributes = "";
			$this->RateableValue->EditValue = HtmlEncode($this->RateableValue->AdvancedSearch->SearchValue);
			$this->RateableValue->PlaceHolder = RemoveHtml($this->RateableValue->caption());

			// ReferenceNo
			$this->ReferenceNo->EditAttrs["class"] = "form-control";
			$this->ReferenceNo->EditCustomAttributes = "";
			$this->ReferenceNo->EditValue = HtmlEncode($this->ReferenceNo->AdvancedSearch->SearchValue);
			$this->ReferenceNo->PlaceHolder = RemoveHtml($this->ReferenceNo->caption());
			$this->ReferenceNo->EditAttrs["class"] = "form-control";
			$this->ReferenceNo->EditCustomAttributes = "";
			$this->ReferenceNo->EditValue2 = HtmlEncode($this->ReferenceNo->AdvancedSearch->SearchValue2);
			$this->ReferenceNo->PlaceHolder = RemoveHtml($this->ReferenceNo->caption());

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
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeGroup`" . SearchString("=", trim($wrk), DATATYPE_STRING, "");
					}
				}
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ChargeGroup->AdvancedSearch->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ChargeGroup->AdvancedSearch->ViewValue->add($this->ChargeGroup->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ChargeGroup->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGroup->EditValue = $arwrk;
			}

			// ClientID
			$this->ClientID->EditAttrs["class"] = "form-control";
			$this->ClientID->EditCustomAttributes = "";
			if (!$this->ClientID->Raw)
				$this->ClientID->AdvancedSearch->SearchValue = HtmlDecode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->EditValue = HtmlEncode($this->ClientID->AdvancedSearch->SearchValue);
			$this->ClientID->PlaceHolder = RemoveHtml($this->ClientID->caption());

			// BillYear
			$this->BillYear->EditAttrs["class"] = "form-control";
			$this->BillYear->EditCustomAttributes = "";
			$curVal = trim(strval($this->BillYear->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->BillYear->AdvancedSearch->ViewValue = $this->BillYear->lookupCacheOption($curVal);
			else
				$this->BillYear->AdvancedSearch->ViewValue = $this->BillYear->Lookup !== NULL && is_array($this->BillYear->Lookup->Options) ? $curVal : NULL;
			if ($this->BillYear->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->BillYear->EditValue = array_values($this->BillYear->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Year`" . SearchString("=", $this->BillYear->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BillYear->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BillYear->EditValue = $arwrk;
			}

			// BillPeriod
			$this->BillPeriod->EditAttrs["class"] = "form-control";
			$this->BillPeriod->EditCustomAttributes = "";
			$this->BillPeriod->EditValue = HtmlEncode($this->BillPeriod->AdvancedSearch->SearchValue);
			$this->BillPeriod->PlaceHolder = RemoveHtml($this->BillPeriod->caption());

			// StartDate
			$this->StartDate->EditAttrs["class"] = "form-control";
			$this->StartDate->EditCustomAttributes = "";
			$this->StartDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->StartDate->AdvancedSearch->SearchValue, 0), 8));
			$this->StartDate->PlaceHolder = RemoveHtml($this->StartDate->caption());

			// EndDate
			$this->EndDate->EditAttrs["class"] = "form-control";
			$this->EndDate->EditCustomAttributes = "";
			$this->EndDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->EndDate->AdvancedSearch->SearchValue, 0), 8));
			$this->EndDate->PlaceHolder = RemoveHtml($this->EndDate->caption());

			// BalanceBF
			$this->BalanceBF->EditAttrs["class"] = "form-control";
			$this->BalanceBF->EditCustomAttributes = "";
			$this->BalanceBF->EditValue = HtmlEncode($this->BalanceBF->AdvancedSearch->SearchValue);
			$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());

			// AmountDue
			$this->AmountDue->EditAttrs["class"] = "form-control";
			$this->AmountDue->EditCustomAttributes = "";
			$this->AmountDue->EditValue = HtmlEncode($this->AmountDue->AdvancedSearch->SearchValue);
			$this->AmountDue->PlaceHolder = RemoveHtml($this->AmountDue->caption());

			// VAT
			$this->VAT->EditAttrs["class"] = "form-control";
			$this->VAT->EditCustomAttributes = "";
			$this->VAT->EditValue = HtmlEncode($this->VAT->AdvancedSearch->SearchValue);
			$this->VAT->PlaceHolder = RemoveHtml($this->VAT->caption());

			// SalesTax
			$this->SalesTax->EditAttrs["class"] = "form-control";
			$this->SalesTax->EditCustomAttributes = "";
			$this->SalesTax->EditValue = HtmlEncode($this->SalesTax->AdvancedSearch->SearchValue);
			$this->SalesTax->PlaceHolder = RemoveHtml($this->SalesTax->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->AdvancedSearch->SearchValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
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
		if (!CheckInteger($this->ValuationNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ValuationNo->errorMessage());
		}
		if (!CheckInteger($this->PropertyGroup->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PropertyGroup->errorMessage());
		}
		if (!CheckNumber($this->RateableValue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->RateableValue->errorMessage());
		}
		if (!CheckInteger($this->ReferenceNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ReferenceNo->errorMessage());
		}
		if (!CheckInteger($this->ReferenceNo->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->ReferenceNo->errorMessage());
		}
		if (!CheckInteger($this->ChargeCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ChargeCode->errorMessage());
		}
		if (!CheckInteger($this->BillPeriod->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BillPeriod->errorMessage());
		}
		if (!CheckDate($this->StartDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->StartDate->errorMessage());
		}
		if (!CheckDate($this->EndDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->EndDate->errorMessage());
		}
		if (!CheckNumber($this->BalanceBF->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->BalanceBF->errorMessage());
		}
		if (!CheckNumber($this->AmountDue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AmountDue->errorMessage());
		}
		if (!CheckNumber($this->VAT->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->VAT->errorMessage());
		}
		if (!CheckNumber($this->SalesTax->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->SalesTax->errorMessage());
		}
		if (!CheckNumber($this->AmountPaid->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AmountPaid->errorMessage());
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
		$this->ValuationNo->AdvancedSearch->load();
		$this->PropertyNo->AdvancedSearch->load();
		$this->ClientSerNo->AdvancedSearch->load();
		$this->PropertyGroup->AdvancedSearch->load();
		$this->Location->AdvancedSearch->load();
		$this->PropertyUse->AdvancedSearch->load();
		$this->RateableValue->AdvancedSearch->load();
		$this->ReferenceNo->AdvancedSearch->load();
		$this->ChargeCode->AdvancedSearch->load();
		$this->ChargeGroup->AdvancedSearch->load();
		$this->ClientID->AdvancedSearch->load();
		$this->BillYear->AdvancedSearch->load();
		$this->BillPeriod->AdvancedSearch->load();
		$this->StartDate->AdvancedSearch->load();
		$this->EndDate->AdvancedSearch->load();
		$this->BalanceBF->AdvancedSearch->load();
		$this->AmountDue->AdvancedSearch->load();
		$this->VAT->AdvancedSearch->load();
		$this->SalesTax->AdvancedSearch->load();
		$this->AmountPaid->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("print_bill_viewlist.php"), "", $this->TableVar, TRUE);
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
				case "x_PropertyGroup":
					break;
				case "x_Location":
					break;
				case "x_PropertyUse":
					break;
				case "x_ChargeCode":
					break;
				case "x_ChargeGroup":
					break;
				case "x_BillYear":
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
						case "x_PropertyGroup":
							break;
						case "x_Location":
							break;
						case "x_PropertyUse":
							break;
						case "x_ChargeCode":
							break;
						case "x_ChargeGroup":
							break;
						case "x_BillYear":
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