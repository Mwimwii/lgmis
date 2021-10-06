<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class councillorship_search extends councillorship
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'councillorship';

	// Page object name
	public $PageObjName = "councillorship_search";

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

		// Table object (councillorship)
		if (!isset($GLOBALS["councillorship"]) || get_class($GLOBALS["councillorship"]) == PROJECT_NAMESPACE . "councillorship") {
			$GLOBALS["councillorship"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["councillorship"];
		}

		// Table object (councillor)
		if (!isset($GLOBALS['councillor']))
			$GLOBALS['councillor'] = new councillor();

		// Table object (local_authority)
		if (!isset($GLOBALS['local_authority']))
			$GLOBALS['local_authority'] = new local_authority();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'councillorship');

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
		global $councillorship;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($councillorship);
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
					if ($pageName == "councillorshipview.php")
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
			$key .= @$ar['EmployeeID'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['LACode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['PositionInCouncil'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['CouncilTerm'];
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
					$this->terminate(GetUrl("councillorshiplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->PoliticalParty->setVisibility();
		$this->Occupation->setVisibility();
		$this->PositionInCouncil->setVisibility();
		$this->Committee->setVisibility();
		$this->CommitteeRole->setVisibility();
		$this->CouncilTerm->setVisibility();
		$this->DateOfExit->setVisibility();
		$this->Allowance->setVisibility();
		$this->CouncillorTypeType->setVisibility();
		$this->CouncillorshipStatus->Visible = FALSE;
		$this->ExitReason->setVisibility();
		$this->RetirementType->Visible = FALSE;
		$this->CouncillorPhoto->Visible = FALSE;
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
		$this->setupLookupOptions($this->EmployeeID);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->PoliticalParty);
		$this->setupLookupOptions($this->Occupation);
		$this->setupLookupOptions($this->PositionInCouncil);
		$this->setupLookupOptions($this->Committee);
		$this->setupLookupOptions($this->CommitteeRole);
		$this->setupLookupOptions($this->CouncilTerm);
		$this->setupLookupOptions($this->CouncillorTypeType);
		$this->setupLookupOptions($this->CouncillorshipStatus);
		$this->setupLookupOptions($this->ExitReason);
		$this->setupLookupOptions($this->RetirementType);

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
					$srchStr = "councillorshiplist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->EmployeeID); // EmployeeID
		$this->buildSearchUrl($srchUrl, $this->ProvinceCode); // ProvinceCode
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->PoliticalParty); // PoliticalParty
		$this->buildSearchUrl($srchUrl, $this->Occupation); // Occupation
		$this->buildSearchUrl($srchUrl, $this->PositionInCouncil); // PositionInCouncil
		$this->buildSearchUrl($srchUrl, $this->Committee); // Committee
		$this->buildSearchUrl($srchUrl, $this->CommitteeRole); // CommitteeRole
		$this->buildSearchUrl($srchUrl, $this->CouncilTerm); // CouncilTerm
		$this->buildSearchUrl($srchUrl, $this->DateOfExit); // DateOfExit
		$this->buildSearchUrl($srchUrl, $this->Allowance); // Allowance
		$this->buildSearchUrl($srchUrl, $this->CouncillorTypeType); // CouncillorTypeType
		$this->buildSearchUrl($srchUrl, $this->ExitReason); // ExitReason
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
		if ($this->EmployeeID->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ProvinceCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PoliticalParty->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Occupation->AdvancedSearch->post())
			$got = TRUE;
		if ($this->PositionInCouncil->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Committee->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CommitteeRole->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CouncilTerm->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DateOfExit->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Allowance->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CouncillorTypeType->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ExitReason->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// ProvinceCode
		// LACode
		// PoliticalParty
		// Occupation
		// PositionInCouncil
		// Committee
		// CommitteeRole
		// CouncilTerm
		// DateOfExit
		// Allowance
		// CouncillorTypeType
		// CouncillorshipStatus
		// ExitReason
		// RetirementType
		// CouncillorPhoto

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$curVal = strval($this->EmployeeID->CurrentValue);
			if ($curVal != "") {
				$this->EmployeeID->ViewValue = $this->EmployeeID->lookupCacheOption($curVal);
				if ($this->EmployeeID->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`EmployeeID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmployeeID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->EmployeeID->ViewValue = $this->EmployeeID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
					}
				}
			} else {
				$this->EmployeeID->ViewValue = NULL;
			}
			$this->EmployeeID->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
			$curVal = strval($this->ProvinceCode->CurrentValue);
			if ($curVal != "") {
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
					}
				}
			} else {
				$this->ProvinceCode->ViewValue = NULL;
			}
			$this->ProvinceCode->ViewCustomAttributes = "";

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

			// PoliticalParty
			$curVal = strval($this->PoliticalParty->CurrentValue);
			if ($curVal != "") {
				$this->PoliticalParty->ViewValue = $this->PoliticalParty->lookupCacheOption($curVal);
				if ($this->PoliticalParty->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PoliticalParty`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PoliticalParty->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PoliticalParty->ViewValue = $this->PoliticalParty->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PoliticalParty->ViewValue = $this->PoliticalParty->CurrentValue;
					}
				}
			} else {
				$this->PoliticalParty->ViewValue = NULL;
			}
			$this->PoliticalParty->ViewCustomAttributes = "";

			// Occupation
			$curVal = strval($this->Occupation->CurrentValue);
			if ($curVal != "") {
				$this->Occupation->ViewValue = $this->Occupation->lookupCacheOption($curVal);
				if ($this->Occupation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OccupationCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Occupation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Occupation->ViewValue = $this->Occupation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Occupation->ViewValue = $this->Occupation->CurrentValue;
					}
				}
			} else {
				$this->Occupation->ViewValue = NULL;
			}
			$this->Occupation->ViewCustomAttributes = "";

			// PositionInCouncil
			$curVal = strval($this->PositionInCouncil->CurrentValue);
			if ($curVal != "") {
				$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->lookupCacheOption($curVal);
				if ($this->PositionInCouncil->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PositionInCouncil->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->CurrentValue;
					}
				}
			} else {
				$this->PositionInCouncil->ViewValue = NULL;
			}
			$this->PositionInCouncil->ViewCustomAttributes = "";

			// Committee
			$curVal = strval($this->Committee->CurrentValue);
			if ($curVal != "") {
				$this->Committee->ViewValue = $this->Committee->lookupCacheOption($curVal);
				if ($this->Committee->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CommitteCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Committee->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Committee->ViewValue = $this->Committee->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Committee->ViewValue = $this->Committee->CurrentValue;
					}
				}
			} else {
				$this->Committee->ViewValue = NULL;
			}
			$this->Committee->ViewCustomAttributes = "";

			// CommitteeRole
			$curVal = strval($this->CommitteeRole->CurrentValue);
			if ($curVal != "") {
				$this->CommitteeRole->ViewValue = $this->CommitteeRole->lookupCacheOption($curVal);
				if ($this->CommitteeRole->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CommitteeRole`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CommitteeRole->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CommitteeRole->ViewValue = $this->CommitteeRole->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CommitteeRole->ViewValue = $this->CommitteeRole->CurrentValue;
					}
				}
			} else {
				$this->CommitteeRole->ViewValue = NULL;
			}
			$this->CommitteeRole->ViewCustomAttributes = "";

			// CouncilTerm
			$curVal = strval($this->CouncilTerm->CurrentValue);
			if ($curVal != "") {
				$this->CouncilTerm->ViewValue = $this->CouncilTerm->lookupCacheOption($curVal);
				if ($this->CouncilTerm->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TermStartYear`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CouncilTerm->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), Config("DEFAULT_DECIMAL_PRECISION"));
						$this->CouncilTerm->ViewValue = $this->CouncilTerm->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CouncilTerm->ViewValue = $this->CouncilTerm->CurrentValue;
					}
				}
			} else {
				$this->CouncilTerm->ViewValue = NULL;
			}
			$this->CouncilTerm->ViewCustomAttributes = "";

			// DateOfExit
			$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
			$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
			$this->DateOfExit->ViewCustomAttributes = "";

			// Allowance
			$this->Allowance->ViewValue = $this->Allowance->CurrentValue;
			$this->Allowance->CellCssStyle .= "text-align: right;";
			$this->Allowance->ViewCustomAttributes = "";

			// CouncillorTypeType
			$curVal = strval($this->CouncillorTypeType->CurrentValue);
			if ($curVal != "") {
				$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->lookupCacheOption($curVal);
				if ($this->CouncillorTypeType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CouncillorType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CouncillorTypeType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->CurrentValue;
					}
				}
			} else {
				$this->CouncillorTypeType->ViewValue = NULL;
			}
			$this->CouncillorTypeType->ViewCustomAttributes = "";

			// ExitReason
			$curVal = strval($this->ExitReason->CurrentValue);
			if ($curVal != "") {
				$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
				if ($this->ExitReason->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CouncillorsipStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ExitReason->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ExitReason->ViewValue = $this->ExitReason->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ExitReason->ViewValue = $this->ExitReason->CurrentValue;
					}
				}
			} else {
				$this->ExitReason->ViewValue = NULL;
			}
			$this->ExitReason->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// PoliticalParty
			$this->PoliticalParty->LinkCustomAttributes = "";
			$this->PoliticalParty->HrefValue = "";
			$this->PoliticalParty->TooltipValue = "";

			// Occupation
			$this->Occupation->LinkCustomAttributes = "";
			$this->Occupation->HrefValue = "";
			$this->Occupation->TooltipValue = "";

			// PositionInCouncil
			$this->PositionInCouncil->LinkCustomAttributes = "";
			$this->PositionInCouncil->HrefValue = "";
			$this->PositionInCouncil->TooltipValue = "";

			// Committee
			$this->Committee->LinkCustomAttributes = "";
			$this->Committee->HrefValue = "";
			$this->Committee->TooltipValue = "";

			// CommitteeRole
			$this->CommitteeRole->LinkCustomAttributes = "";
			$this->CommitteeRole->HrefValue = "";
			$this->CommitteeRole->TooltipValue = "";

			// CouncilTerm
			$this->CouncilTerm->LinkCustomAttributes = "";
			$this->CouncilTerm->HrefValue = "";
			$this->CouncilTerm->TooltipValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";
			$this->DateOfExit->TooltipValue = "";

			// Allowance
			$this->Allowance->LinkCustomAttributes = "";
			$this->Allowance->HrefValue = "";
			$this->Allowance->TooltipValue = "";

			// CouncillorTypeType
			$this->CouncillorTypeType->LinkCustomAttributes = "";
			$this->CouncillorTypeType->HrefValue = "";
			$this->CouncillorTypeType->TooltipValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";
			$this->ExitReason->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->AdvancedSearch->SearchValue);
			$curVal = strval($this->EmployeeID->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->EmployeeID->EditValue = $this->EmployeeID->lookupCacheOption($curVal);
				if ($this->EmployeeID->EditValue === NULL) { // Lookup from database
					$filterWrk = "`EmployeeID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmployeeID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
						$this->EmployeeID->EditValue = $this->EmployeeID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->EmployeeID->EditValue = NULL;
			}
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->AdvancedSearch->SearchValue);
			$curVal = strval($this->ProvinceCode->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->ProvinceCode->EditValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ProvinceCode->EditValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->ProvinceCode->EditValue = NULL;
			}
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			$curVal = trim(strval($this->LACode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->lookupCacheOption($curVal);
			else
				$this->LACode->AdvancedSearch->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
			if ($this->LACode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LACode`" . SearchString("=", $this->LACode->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->LACode->EditValue = $arwrk;
			}

			// PoliticalParty
			$this->PoliticalParty->EditAttrs["class"] = "form-control";
			$this->PoliticalParty->EditCustomAttributes = "";
			$curVal = trim(strval($this->PoliticalParty->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PoliticalParty->AdvancedSearch->ViewValue = $this->PoliticalParty->lookupCacheOption($curVal);
			else
				$this->PoliticalParty->AdvancedSearch->ViewValue = $this->PoliticalParty->Lookup !== NULL && is_array($this->PoliticalParty->Lookup->Options) ? $curVal : NULL;
			if ($this->PoliticalParty->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PoliticalParty->EditValue = array_values($this->PoliticalParty->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PoliticalParty`" . SearchString("=", $this->PoliticalParty->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PoliticalParty->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PoliticalParty->EditValue = $arwrk;
			}

			// Occupation
			$this->Occupation->EditAttrs["class"] = "form-control";
			$this->Occupation->EditCustomAttributes = "";
			$curVal = trim(strval($this->Occupation->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Occupation->AdvancedSearch->ViewValue = $this->Occupation->lookupCacheOption($curVal);
			else
				$this->Occupation->AdvancedSearch->ViewValue = $this->Occupation->Lookup !== NULL && is_array($this->Occupation->Lookup->Options) ? $curVal : NULL;
			if ($this->Occupation->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Occupation->EditValue = array_values($this->Occupation->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OccupationCode`" . SearchString("=", $this->Occupation->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Occupation->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Occupation->EditValue = $arwrk;
			}

			// PositionInCouncil
			$this->PositionInCouncil->EditAttrs["class"] = "form-control";
			$this->PositionInCouncil->EditCustomAttributes = "";
			$curVal = trim(strval($this->PositionInCouncil->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->PositionInCouncil->AdvancedSearch->ViewValue = $this->PositionInCouncil->lookupCacheOption($curVal);
			else
				$this->PositionInCouncil->AdvancedSearch->ViewValue = $this->PositionInCouncil->Lookup !== NULL && is_array($this->PositionInCouncil->Lookup->Options) ? $curVal : NULL;
			if ($this->PositionInCouncil->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->PositionInCouncil->EditValue = array_values($this->PositionInCouncil->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PositionCode`" . SearchString("=", $this->PositionInCouncil->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->PositionInCouncil->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PositionInCouncil->EditValue = $arwrk;
			}

			// Committee
			$this->Committee->EditAttrs["class"] = "form-control";
			$this->Committee->EditCustomAttributes = "";
			$curVal = trim(strval($this->Committee->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->Committee->AdvancedSearch->ViewValue = $this->Committee->lookupCacheOption($curVal);
			else
				$this->Committee->AdvancedSearch->ViewValue = $this->Committee->Lookup !== NULL && is_array($this->Committee->Lookup->Options) ? $curVal : NULL;
			if ($this->Committee->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->Committee->EditValue = array_values($this->Committee->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CommitteCode`" . SearchString("=", $this->Committee->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Committee->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Committee->EditValue = $arwrk;
			}

			// CommitteeRole
			$this->CommitteeRole->EditAttrs["class"] = "form-control";
			$this->CommitteeRole->EditCustomAttributes = "";
			$curVal = trim(strval($this->CommitteeRole->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->CommitteeRole->AdvancedSearch->ViewValue = $this->CommitteeRole->lookupCacheOption($curVal);
			else
				$this->CommitteeRole->AdvancedSearch->ViewValue = $this->CommitteeRole->Lookup !== NULL && is_array($this->CommitteeRole->Lookup->Options) ? $curVal : NULL;
			if ($this->CommitteeRole->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->CommitteeRole->EditValue = array_values($this->CommitteeRole->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CommitteeRole`" . SearchString("=", $this->CommitteeRole->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CommitteeRole->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CommitteeRole->EditValue = $arwrk;
			}

			// CouncilTerm
			$this->CouncilTerm->EditAttrs["class"] = "form-control";
			$this->CouncilTerm->EditCustomAttributes = "";
			$curVal = trim(strval($this->CouncilTerm->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->CouncilTerm->AdvancedSearch->ViewValue = $this->CouncilTerm->lookupCacheOption($curVal);
			else
				$this->CouncilTerm->AdvancedSearch->ViewValue = $this->CouncilTerm->Lookup !== NULL && is_array($this->CouncilTerm->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncilTerm->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->CouncilTerm->EditValue = array_values($this->CouncilTerm->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`TermStartYear`" . SearchString("=", $this->CouncilTerm->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CouncilTerm->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], Config("DEFAULT_DECIMAL_PRECISION"));
				}
				$this->CouncilTerm->EditValue = $arwrk;
			}

			// DateOfExit
			$this->DateOfExit->EditAttrs["class"] = "form-control";
			$this->DateOfExit->EditCustomAttributes = "";
			$this->DateOfExit->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfExit->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

			// Allowance
			$this->Allowance->EditAttrs["class"] = "form-control";
			$this->Allowance->EditCustomAttributes = "";
			if (!$this->Allowance->Raw)
				$this->Allowance->AdvancedSearch->SearchValue = HtmlDecode($this->Allowance->AdvancedSearch->SearchValue);
			$this->Allowance->EditValue = HtmlEncode($this->Allowance->AdvancedSearch->SearchValue);
			$this->Allowance->PlaceHolder = RemoveHtml($this->Allowance->caption());

			// CouncillorTypeType
			$this->CouncillorTypeType->EditAttrs["class"] = "form-control";
			$this->CouncillorTypeType->EditCustomAttributes = "";
			$curVal = trim(strval($this->CouncillorTypeType->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->CouncillorTypeType->AdvancedSearch->ViewValue = $this->CouncillorTypeType->lookupCacheOption($curVal);
			else
				$this->CouncillorTypeType->AdvancedSearch->ViewValue = $this->CouncillorTypeType->Lookup !== NULL && is_array($this->CouncillorTypeType->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncillorTypeType->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->CouncillorTypeType->EditValue = array_values($this->CouncillorTypeType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CouncillorType`" . SearchString("=", $this->CouncillorTypeType->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CouncillorTypeType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CouncillorTypeType->EditValue = $arwrk;
			}

			// ExitReason
			$this->ExitReason->EditAttrs["class"] = "form-control";
			$this->ExitReason->EditCustomAttributes = "";
			$curVal = trim(strval($this->ExitReason->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ExitReason->AdvancedSearch->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
			else
				$this->ExitReason->AdvancedSearch->ViewValue = $this->ExitReason->Lookup !== NULL && is_array($this->ExitReason->Lookup->Options) ? $curVal : NULL;
			if ($this->ExitReason->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ExitReason->EditValue = array_values($this->ExitReason->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CouncillorsipStatus`" . SearchString("=", $this->ExitReason->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ExitReason->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ExitReason->EditValue = $arwrk;
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
		if (!CheckInteger($this->EmployeeID->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->EmployeeID->errorMessage());
		}
		if (!CheckInteger($this->ProvinceCode->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ProvinceCode->errorMessage());
		}
		if (!CheckDate($this->DateOfExit->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DateOfExit->errorMessage());
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
		$this->EmployeeID->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->PoliticalParty->AdvancedSearch->load();
		$this->Occupation->AdvancedSearch->load();
		$this->PositionInCouncil->AdvancedSearch->load();
		$this->Committee->AdvancedSearch->load();
		$this->CommitteeRole->AdvancedSearch->load();
		$this->CouncilTerm->AdvancedSearch->load();
		$this->DateOfExit->AdvancedSearch->load();
		$this->Allowance->AdvancedSearch->load();
		$this->CouncillorTypeType->AdvancedSearch->load();
		$this->ExitReason->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("councillorshiplist.php"), "", $this->TableVar, TRUE);
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
				case "x_EmployeeID":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_PoliticalParty":
					break;
				case "x_Occupation":
					break;
				case "x_PositionInCouncil":
					break;
				case "x_Committee":
					break;
				case "x_CommitteeRole":
					break;
				case "x_CouncilTerm":
					break;
				case "x_CouncillorTypeType":
					break;
				case "x_CouncillorshipStatus":
					break;
				case "x_ExitReason":
					break;
				case "x_RetirementType":
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
						case "x_EmployeeID":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_PoliticalParty":
							break;
						case "x_Occupation":
							break;
						case "x_PositionInCouncil":
							break;
						case "x_Committee":
							break;
						case "x_CommitteeRole":
							break;
						case "x_CouncilTerm":
							$row[2] = FormatNumber($row[2], Config("DEFAULT_DECIMAL_PRECISION"));
							$row['df2'] = $row[2];
							break;
						case "x_CouncillorTypeType":
							break;
						case "x_CouncillorshipStatus":
							break;
						case "x_ExitReason":
							break;
						case "x_RetirementType":
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