<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ticket_search extends ticket
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ticket';

	// Page object name
	public $PageObjName = "ticket_search";

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

		// Table object (ticket)
		if (!isset($GLOBALS["ticket"]) || get_class($GLOBALS["ticket"]) == PROJECT_NAMESPACE . "ticket") {
			$GLOBALS["ticket"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ticket"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ticket');

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
		global $ticket;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ticket);
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
					if ($pageName == "ticketview.php")
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
			$key .= @$ar['TicketNumber'];
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
			$this->TicketNumber->Visible = FALSE;
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
					$this->terminate(GetUrl("ticketlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Subject->setVisibility();
		$this->TicketReportDate->setVisibility();
		$this->IncidentDate->setVisibility();
		$this->IncidentTime->setVisibility();
		$this->TicketDescription->setVisibility();
		$this->TicketCategory->setVisibility();
		$this->TicketType->setVisibility();
		$this->ReportedBy->setVisibility();
		$this->TicketStatus->setVisibility();
		$this->TicketNumber->setVisibility();
		$this->ReporterEmail->setVisibility();
		$this->ReporterMobile->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->DeptSection->setVisibility();
		$this->TicketLevel->setVisibility();
		$this->AllocatedTo->setVisibility();
		$this->EscalatedTo->setVisibility();
		$this->TicketSolution->setVisibility();
		$this->Evidence->Visible = FALSE;
		$this->SeverityLevel->setVisibility();
		$this->Days->setVisibility();
		$this->DataLastUpdated->setVisibility();
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
		$this->setupLookupOptions($this->TicketCategory);
		$this->setupLookupOptions($this->TicketType);
		$this->setupLookupOptions($this->ReportedBy);
		$this->setupLookupOptions($this->TicketStatus);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->AllocatedTo);
		$this->setupLookupOptions($this->EscalatedTo);
		$this->setupLookupOptions($this->SeverityLevel);

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
					$srchStr = "ticketlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->Subject); // Subject
		$this->buildSearchUrl($srchUrl, $this->TicketReportDate); // TicketReportDate
		$this->buildSearchUrl($srchUrl, $this->IncidentDate); // IncidentDate
		$this->buildSearchUrl($srchUrl, $this->IncidentTime); // IncidentTime
		$this->buildSearchUrl($srchUrl, $this->TicketDescription); // TicketDescription
		$this->buildSearchUrl($srchUrl, $this->TicketCategory); // TicketCategory
		$this->buildSearchUrl($srchUrl, $this->TicketType); // TicketType
		$this->buildSearchUrl($srchUrl, $this->ReportedBy); // ReportedBy
		$this->buildSearchUrl($srchUrl, $this->TicketStatus); // TicketStatus
		$this->buildSearchUrl($srchUrl, $this->TicketNumber); // TicketNumber
		$this->buildSearchUrl($srchUrl, $this->ReporterEmail); // ReporterEmail
		$this->buildSearchUrl($srchUrl, $this->ReporterMobile); // ReporterMobile
		$this->buildSearchUrl($srchUrl, $this->ProvinceCode); // ProvinceCode
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->DepartmentCode); // DepartmentCode
		$this->buildSearchUrl($srchUrl, $this->DeptSection); // DeptSection
		$this->buildSearchUrl($srchUrl, $this->TicketLevel); // TicketLevel
		$this->buildSearchUrl($srchUrl, $this->AllocatedTo); // AllocatedTo
		$this->buildSearchUrl($srchUrl, $this->EscalatedTo); // EscalatedTo
		$this->buildSearchUrl($srchUrl, $this->TicketSolution); // TicketSolution
		$this->buildSearchUrl($srchUrl, $this->SeverityLevel); // SeverityLevel
		$this->buildSearchUrl($srchUrl, $this->Days); // Days
		$this->buildSearchUrl($srchUrl, $this->DataLastUpdated); // DataLastUpdated
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
		if ($this->Subject->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketReportDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->IncidentDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->IncidentTime->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketDescription->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketCategory->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketType->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReportedBy->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketStatus->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketNumber->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReporterEmail->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ReporterMobile->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ProvinceCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DepartmentCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DeptSection->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketLevel->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AllocatedTo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->EscalatedTo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TicketSolution->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SeverityLevel->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Days->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DataLastUpdated->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Days->FormValue == $this->Days->CurrentValue && is_numeric(ConvertToFloatString($this->Days->CurrentValue)))
			$this->Days->CurrentValue = ConvertToFloatString($this->Days->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// Subject
		// TicketReportDate
		// IncidentDate
		// IncidentTime
		// TicketDescription
		// TicketCategory
		// TicketType
		// ReportedBy
		// TicketStatus
		// TicketNumber
		// ReporterEmail
		// ReporterMobile
		// ProvinceCode
		// LACode
		// DepartmentCode
		// DeptSection
		// TicketLevel
		// AllocatedTo
		// EscalatedTo
		// TicketSolution
		// Evidence
		// SeverityLevel
		// Days
		// DataLastUpdated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// TicketReportDate
			$this->TicketReportDate->ViewValue = $this->TicketReportDate->CurrentValue;
			$this->TicketReportDate->ViewValue = FormatDateTime($this->TicketReportDate->ViewValue, 0);
			$this->TicketReportDate->ViewCustomAttributes = "";

			// IncidentDate
			$this->IncidentDate->ViewValue = $this->IncidentDate->CurrentValue;
			$this->IncidentDate->ViewValue = FormatDateTime($this->IncidentDate->ViewValue, 0);
			$this->IncidentDate->ViewCustomAttributes = "";

			// IncidentTime
			$this->IncidentTime->ViewValue = $this->IncidentTime->CurrentValue;
			$this->IncidentTime->ViewValue = FormatDateTime($this->IncidentTime->ViewValue, 4);
			$this->IncidentTime->ViewCustomAttributes = "";

			// TicketDescription
			$this->TicketDescription->ViewValue = $this->TicketDescription->CurrentValue;
			$this->TicketDescription->ViewCustomAttributes = "";

			// TicketCategory
			$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
			$curVal = strval($this->TicketCategory->CurrentValue);
			if ($curVal != "") {
				$this->TicketCategory->ViewValue = $this->TicketCategory->lookupCacheOption($curVal);
				if ($this->TicketCategory->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketCategory->ViewValue = $this->TicketCategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketCategory->ViewValue = $this->TicketCategory->CurrentValue;
					}
				}
			} else {
				$this->TicketCategory->ViewValue = NULL;
			}
			$this->TicketCategory->ViewCustomAttributes = "";

			// TicketType
			$curVal = strval($this->TicketType->CurrentValue);
			if ($curVal != "") {
				$this->TicketType->ViewValue = $this->TicketType->lookupCacheOption($curVal);
				if ($this->TicketType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TicketType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketType->ViewValue = $this->TicketType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketType->ViewValue = $this->TicketType->CurrentValue;
					}
				}
			} else {
				$this->TicketType->ViewValue = NULL;
			}
			$this->TicketType->ViewCustomAttributes = "";

			// ReportedBy
			$curVal = strval($this->ReportedBy->CurrentValue);
			if ($curVal != "") {
				$this->ReportedBy->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
				if ($this->ReportedBy->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`UserCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ReportedBy->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->ReportedBy->ViewValue = $this->ReportedBy->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ReportedBy->ViewValue = $this->ReportedBy->CurrentValue;
					}
				}
			} else {
				$this->ReportedBy->ViewValue = NULL;
			}
			$this->ReportedBy->ViewCustomAttributes = "";

			// TicketStatus
			$curVal = strval($this->TicketStatus->CurrentValue);
			if ($curVal != "") {
				$this->TicketStatus->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
				if ($this->TicketStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`StatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->TicketStatus->ViewValue = $this->TicketStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketStatus->ViewValue = $this->TicketStatus->CurrentValue;
					}
				}
			} else {
				$this->TicketStatus->ViewValue = NULL;
			}
			$this->TicketStatus->ViewCustomAttributes = "";

			// TicketNumber
			$this->TicketNumber->ViewValue = $this->TicketNumber->CurrentValue;
			$this->TicketNumber->ViewCustomAttributes = "";

			// ReporterEmail
			$this->ReporterEmail->ViewValue = $this->ReporterEmail->CurrentValue;
			$this->ReporterEmail->ViewCustomAttributes = "";

			// ReporterMobile
			$this->ReporterMobile->ViewValue = $this->ReporterMobile->CurrentValue;
			$this->ReporterMobile->ViewCustomAttributes = "";

			// ProvinceCode
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

			// DeptSection
			$this->DeptSection->ViewCustomAttributes = "";

			// TicketLevel
			$this->TicketLevel->ViewValue = $this->TicketLevel->CurrentValue;
			$this->TicketLevel->ViewCustomAttributes = "";

			// AllocatedTo
			$curVal = strval($this->AllocatedTo->CurrentValue);
			if ($curVal != "") {
				$this->AllocatedTo->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
				if ($this->AllocatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AllocatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AllocatedTo->ViewValue = $this->AllocatedTo->CurrentValue;
					}
				}
			} else {
				$this->AllocatedTo->ViewValue = NULL;
			}
			$this->AllocatedTo->ViewCustomAttributes = "";

			// EscalatedTo
			$curVal = strval($this->EscalatedTo->CurrentValue);
			if ($curVal != "") {
				$this->EscalatedTo->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
				if ($this->EscalatedTo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EscalatedTo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EscalatedTo->ViewValue = $this->EscalatedTo->CurrentValue;
					}
				}
			} else {
				$this->EscalatedTo->ViewValue = NULL;
			}
			$this->EscalatedTo->ViewCustomAttributes = "";

			// TicketSolution
			$this->TicketSolution->ViewValue = $this->TicketSolution->CurrentValue;
			$this->TicketSolution->ViewCustomAttributes = "";

			// SeverityLevel
			$curVal = strval($this->SeverityLevel->CurrentValue);
			if ($curVal != "") {
				$this->SeverityLevel->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
				if ($this->SeverityLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SeverityLevelCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SeverityLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SeverityLevel->ViewValue = $this->SeverityLevel->CurrentValue;
					}
				}
			} else {
				$this->SeverityLevel->ViewValue = NULL;
			}
			$this->SeverityLevel->ViewCustomAttributes = "";

			// Days
			$this->Days->ViewValue = $this->Days->CurrentValue;
			$this->Days->ViewValue = FormatNumber($this->Days->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Days->ViewCustomAttributes = "";

			// DataLastUpdated
			$this->DataLastUpdated->ViewValue = $this->DataLastUpdated->CurrentValue;
			$this->DataLastUpdated->ViewValue = FormatDateTime($this->DataLastUpdated->ViewValue, 0);
			$this->DataLastUpdated->ViewCustomAttributes = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";

			// TicketReportDate
			$this->TicketReportDate->LinkCustomAttributes = "";
			$this->TicketReportDate->HrefValue = "";
			$this->TicketReportDate->TooltipValue = "";

			// IncidentDate
			$this->IncidentDate->LinkCustomAttributes = "";
			$this->IncidentDate->HrefValue = "";
			$this->IncidentDate->TooltipValue = "";

			// IncidentTime
			$this->IncidentTime->LinkCustomAttributes = "";
			$this->IncidentTime->HrefValue = "";
			$this->IncidentTime->TooltipValue = "";

			// TicketDescription
			$this->TicketDescription->LinkCustomAttributes = "";
			$this->TicketDescription->HrefValue = "";
			$this->TicketDescription->TooltipValue = "";

			// TicketCategory
			$this->TicketCategory->LinkCustomAttributes = "";
			$this->TicketCategory->HrefValue = "";
			$this->TicketCategory->TooltipValue = "";

			// TicketType
			$this->TicketType->LinkCustomAttributes = "";
			$this->TicketType->HrefValue = "";
			$this->TicketType->TooltipValue = "";

			// ReportedBy
			$this->ReportedBy->LinkCustomAttributes = "";
			$this->ReportedBy->HrefValue = "";
			$this->ReportedBy->TooltipValue = "";

			// TicketStatus
			$this->TicketStatus->LinkCustomAttributes = "";
			$this->TicketStatus->HrefValue = "";
			$this->TicketStatus->TooltipValue = "";

			// TicketNumber
			$this->TicketNumber->LinkCustomAttributes = "";
			$this->TicketNumber->HrefValue = "";
			$this->TicketNumber->TooltipValue = "";

			// ReporterEmail
			$this->ReporterEmail->LinkCustomAttributes = "";
			$this->ReporterEmail->HrefValue = "";
			$this->ReporterEmail->TooltipValue = "";

			// ReporterMobile
			$this->ReporterMobile->LinkCustomAttributes = "";
			$this->ReporterMobile->HrefValue = "";
			$this->ReporterMobile->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// DeptSection
			$this->DeptSection->LinkCustomAttributes = "";
			$this->DeptSection->HrefValue = "";
			$this->DeptSection->TooltipValue = "";

			// TicketLevel
			$this->TicketLevel->LinkCustomAttributes = "";
			$this->TicketLevel->HrefValue = "";
			$this->TicketLevel->TooltipValue = "";

			// AllocatedTo
			$this->AllocatedTo->LinkCustomAttributes = "";
			$this->AllocatedTo->HrefValue = "";
			$this->AllocatedTo->TooltipValue = "";

			// EscalatedTo
			$this->EscalatedTo->LinkCustomAttributes = "";
			$this->EscalatedTo->HrefValue = "";
			$this->EscalatedTo->TooltipValue = "";

			// TicketSolution
			$this->TicketSolution->LinkCustomAttributes = "";
			$this->TicketSolution->HrefValue = "";
			$this->TicketSolution->TooltipValue = "";

			// SeverityLevel
			$this->SeverityLevel->LinkCustomAttributes = "";
			$this->SeverityLevel->HrefValue = "";
			$this->SeverityLevel->TooltipValue = "";

			// Days
			$this->Days->LinkCustomAttributes = "";
			$this->Days->HrefValue = "";
			$this->Days->TooltipValue = "";

			// DataLastUpdated
			$this->DataLastUpdated->LinkCustomAttributes = "";
			$this->DataLastUpdated->HrefValue = "";
			$this->DataLastUpdated->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// Subject
			$this->Subject->EditAttrs["class"] = "form-control";
			$this->Subject->EditCustomAttributes = "";
			if (!$this->Subject->Raw)
				$this->Subject->AdvancedSearch->SearchValue = HtmlDecode($this->Subject->AdvancedSearch->SearchValue);
			$this->Subject->EditValue = HtmlEncode($this->Subject->AdvancedSearch->SearchValue);
			$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

			// TicketReportDate
			$this->TicketReportDate->EditAttrs["class"] = "form-control";
			$this->TicketReportDate->EditCustomAttributes = "";
			$this->TicketReportDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->TicketReportDate->AdvancedSearch->SearchValue, 0), 8));
			$this->TicketReportDate->PlaceHolder = RemoveHtml($this->TicketReportDate->caption());

			// IncidentDate
			$this->IncidentDate->EditAttrs["class"] = "form-control";
			$this->IncidentDate->EditCustomAttributes = "";
			$this->IncidentDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->IncidentDate->AdvancedSearch->SearchValue, 0), 8));
			$this->IncidentDate->PlaceHolder = RemoveHtml($this->IncidentDate->caption());

			// IncidentTime
			$this->IncidentTime->EditAttrs["class"] = "form-control";
			$this->IncidentTime->EditCustomAttributes = "";
			$this->IncidentTime->EditValue = HtmlEncode(UnFormatDateTime($this->IncidentTime->AdvancedSearch->SearchValue, 4));
			$this->IncidentTime->PlaceHolder = RemoveHtml($this->IncidentTime->caption());

			// TicketDescription
			$this->TicketDescription->EditAttrs["class"] = "form-control";
			$this->TicketDescription->EditCustomAttributes = "";
			$this->TicketDescription->EditValue = HtmlEncode($this->TicketDescription->AdvancedSearch->SearchValue);
			$this->TicketDescription->PlaceHolder = RemoveHtml($this->TicketDescription->caption());

			// TicketCategory
			$this->TicketCategory->EditAttrs["class"] = "form-control";
			$this->TicketCategory->EditCustomAttributes = "";
			$this->TicketCategory->EditValue = HtmlEncode($this->TicketCategory->AdvancedSearch->SearchValue);
			$curVal = strval($this->TicketCategory->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->TicketCategory->EditValue = $this->TicketCategory->lookupCacheOption($curVal);
				if ($this->TicketCategory->EditValue === NULL) { // Lookup from database
					$filterWrk = "`TicketCategory`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->TicketCategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->TicketCategory->EditValue = $this->TicketCategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->TicketCategory->EditValue = HtmlEncode($this->TicketCategory->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->TicketCategory->EditValue = NULL;
			}
			$this->TicketCategory->PlaceHolder = RemoveHtml($this->TicketCategory->caption());

			// TicketType
			$this->TicketType->EditAttrs["class"] = "form-control";
			$this->TicketType->EditCustomAttributes = "";
			$curVal = trim(strval($this->TicketType->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->TicketType->AdvancedSearch->ViewValue = $this->TicketType->lookupCacheOption($curVal);
			else
				$this->TicketType->AdvancedSearch->ViewValue = $this->TicketType->Lookup !== NULL && is_array($this->TicketType->Lookup->Options) ? $curVal : NULL;
			if ($this->TicketType->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->TicketType->EditValue = array_values($this->TicketType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`TicketType`" . SearchString("=", $this->TicketType->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TicketType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TicketType->EditValue = $arwrk;
			}

			// ReportedBy
			$this->ReportedBy->EditCustomAttributes = "";
			$curVal = trim(strval($this->ReportedBy->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ReportedBy->AdvancedSearch->ViewValue = $this->ReportedBy->lookupCacheOption($curVal);
			else
				$this->ReportedBy->AdvancedSearch->ViewValue = $this->ReportedBy->Lookup !== NULL && is_array($this->ReportedBy->Lookup->Options) ? $curVal : NULL;
			if ($this->ReportedBy->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ReportedBy->EditValue = array_values($this->ReportedBy->Lookup->Options);
				if ($this->ReportedBy->AdvancedSearch->ViewValue == "")
					$this->ReportedBy->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`UserCode`" . SearchString("=", $this->ReportedBy->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ReportedBy->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$arwrk[3] = HtmlEncode($rswrk->fields('df3'));
					$this->ReportedBy->AdvancedSearch->ViewValue = $this->ReportedBy->displayValue($arwrk);
				} else {
					$this->ReportedBy->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ReportedBy->EditValue = $arwrk;
			}

			// TicketStatus
			$this->TicketStatus->EditAttrs["class"] = "form-control";
			$this->TicketStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->TicketStatus->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->TicketStatus->AdvancedSearch->ViewValue = $this->TicketStatus->lookupCacheOption($curVal);
			else
				$this->TicketStatus->AdvancedSearch->ViewValue = $this->TicketStatus->Lookup !== NULL && is_array($this->TicketStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->TicketStatus->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->TicketStatus->EditValue = array_values($this->TicketStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`StatusCode`" . SearchString("=", $this->TicketStatus->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->TicketStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->TicketStatus->EditValue = $arwrk;
			}

			// TicketNumber
			$this->TicketNumber->EditAttrs["class"] = "form-control";
			$this->TicketNumber->EditCustomAttributes = "";
			$this->TicketNumber->EditValue = HtmlEncode($this->TicketNumber->AdvancedSearch->SearchValue);
			$this->TicketNumber->PlaceHolder = RemoveHtml($this->TicketNumber->caption());

			// ReporterEmail
			$this->ReporterEmail->EditAttrs["class"] = "form-control";
			$this->ReporterEmail->EditCustomAttributes = "";
			if (!$this->ReporterEmail->Raw)
				$this->ReporterEmail->AdvancedSearch->SearchValue = HtmlDecode($this->ReporterEmail->AdvancedSearch->SearchValue);
			$this->ReporterEmail->EditValue = HtmlEncode($this->ReporterEmail->AdvancedSearch->SearchValue);
			$this->ReporterEmail->PlaceHolder = RemoveHtml($this->ReporterEmail->caption());

			// ReporterMobile
			$this->ReporterMobile->EditAttrs["class"] = "form-control";
			$this->ReporterMobile->EditCustomAttributes = "";
			if (!$this->ReporterMobile->Raw)
				$this->ReporterMobile->AdvancedSearch->SearchValue = HtmlDecode($this->ReporterMobile->AdvancedSearch->SearchValue);
			$this->ReporterMobile->EditValue = HtmlEncode($this->ReporterMobile->AdvancedSearch->SearchValue);
			$this->ReporterMobile->PlaceHolder = RemoveHtml($this->ReporterMobile->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProvinceCode->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->ProvinceCode->AdvancedSearch->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			else
				$this->ProvinceCode->AdvancedSearch->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProvinceCode->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProvinceCode->EditValue = $arwrk;
			}

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

			// DeptSection
			$this->DeptSection->EditAttrs["class"] = "form-control";
			$this->DeptSection->EditCustomAttributes = "";

			// TicketLevel
			$this->TicketLevel->EditAttrs["class"] = "form-control";
			$this->TicketLevel->EditCustomAttributes = "";
			$this->TicketLevel->EditValue = HtmlEncode($this->TicketLevel->AdvancedSearch->SearchValue);
			$this->TicketLevel->PlaceHolder = RemoveHtml($this->TicketLevel->caption());

			// AllocatedTo
			$this->AllocatedTo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AllocatedTo->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->AllocatedTo->AdvancedSearch->ViewValue = $this->AllocatedTo->lookupCacheOption($curVal);
			else
				$this->AllocatedTo->AdvancedSearch->ViewValue = $this->AllocatedTo->Lookup !== NULL && is_array($this->AllocatedTo->Lookup->Options) ? $curVal : NULL;
			if ($this->AllocatedTo->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->AllocatedTo->EditValue = array_values($this->AllocatedTo->Lookup->Options);
				if ($this->AllocatedTo->AdvancedSearch->ViewValue == "")
					$this->AllocatedTo->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $this->AllocatedTo->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AllocatedTo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->AllocatedTo->AdvancedSearch->ViewValue = $this->AllocatedTo->displayValue($arwrk);
				} else {
					$this->AllocatedTo->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AllocatedTo->EditValue = $arwrk;
			}

			// EscalatedTo
			$this->EscalatedTo->EditCustomAttributes = "";
			$curVal = trim(strval($this->EscalatedTo->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->EscalatedTo->AdvancedSearch->ViewValue = $this->EscalatedTo->lookupCacheOption($curVal);
			else
				$this->EscalatedTo->AdvancedSearch->ViewValue = $this->EscalatedTo->Lookup !== NULL && is_array($this->EscalatedTo->Lookup->Options) ? $curVal : NULL;
			if ($this->EscalatedTo->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->EscalatedTo->EditValue = array_values($this->EscalatedTo->Lookup->Options);
				if ($this->EscalatedTo->AdvancedSearch->ViewValue == "")
					$this->EscalatedTo->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ServiceProviderID`" . SearchString("=", $this->EscalatedTo->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EscalatedTo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->EscalatedTo->AdvancedSearch->ViewValue = $this->EscalatedTo->displayValue($arwrk);
				} else {
					$this->EscalatedTo->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EscalatedTo->EditValue = $arwrk;
			}

			// TicketSolution
			$this->TicketSolution->EditAttrs["class"] = "form-control";
			$this->TicketSolution->EditCustomAttributes = "";
			$this->TicketSolution->EditValue = HtmlEncode($this->TicketSolution->AdvancedSearch->SearchValue);
			$this->TicketSolution->PlaceHolder = RemoveHtml($this->TicketSolution->caption());

			// SeverityLevel
			$this->SeverityLevel->EditAttrs["class"] = "form-control";
			$this->SeverityLevel->EditCustomAttributes = "";
			$curVal = trim(strval($this->SeverityLevel->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->SeverityLevel->AdvancedSearch->ViewValue = $this->SeverityLevel->lookupCacheOption($curVal);
			else
				$this->SeverityLevel->AdvancedSearch->ViewValue = $this->SeverityLevel->Lookup !== NULL && is_array($this->SeverityLevel->Lookup->Options) ? $curVal : NULL;
			if ($this->SeverityLevel->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->SeverityLevel->EditValue = array_values($this->SeverityLevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SeverityLevelCode`" . SearchString("=", $this->SeverityLevel->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SeverityLevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SeverityLevel->EditValue = $arwrk;
			}

			// Days
			$this->Days->EditAttrs["class"] = "form-control";
			$this->Days->EditCustomAttributes = "";
			$this->Days->EditValue = HtmlEncode($this->Days->AdvancedSearch->SearchValue);
			$this->Days->PlaceHolder = RemoveHtml($this->Days->caption());

			// DataLastUpdated
			$this->DataLastUpdated->EditAttrs["class"] = "form-control";
			$this->DataLastUpdated->EditCustomAttributes = "";
			$this->DataLastUpdated->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DataLastUpdated->AdvancedSearch->SearchValue, 0), 8));
			$this->DataLastUpdated->PlaceHolder = RemoveHtml($this->DataLastUpdated->caption());
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
		if (!CheckDate($this->TicketReportDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->TicketReportDate->errorMessage());
		}
		if (!CheckDate($this->IncidentDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->IncidentDate->errorMessage());
		}
		if (!CheckTime($this->IncidentTime->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->IncidentTime->errorMessage());
		}
		if (!CheckInteger($this->TicketCategory->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->TicketCategory->errorMessage());
		}
		if (!CheckInteger($this->TicketNumber->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->TicketNumber->errorMessage());
		}
		if (!CheckInteger($this->TicketLevel->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->TicketLevel->errorMessage());
		}
		if (!CheckNumber($this->Days->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->Days->errorMessage());
		}
		if (!CheckDate($this->DataLastUpdated->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DataLastUpdated->errorMessage());
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
		$this->Subject->AdvancedSearch->load();
		$this->TicketReportDate->AdvancedSearch->load();
		$this->IncidentDate->AdvancedSearch->load();
		$this->IncidentTime->AdvancedSearch->load();
		$this->TicketDescription->AdvancedSearch->load();
		$this->TicketCategory->AdvancedSearch->load();
		$this->TicketType->AdvancedSearch->load();
		$this->ReportedBy->AdvancedSearch->load();
		$this->TicketStatus->AdvancedSearch->load();
		$this->TicketNumber->AdvancedSearch->load();
		$this->ReporterEmail->AdvancedSearch->load();
		$this->ReporterMobile->AdvancedSearch->load();
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->DepartmentCode->AdvancedSearch->load();
		$this->DeptSection->AdvancedSearch->load();
		$this->TicketLevel->AdvancedSearch->load();
		$this->AllocatedTo->AdvancedSearch->load();
		$this->EscalatedTo->AdvancedSearch->load();
		$this->TicketSolution->AdvancedSearch->load();
		$this->SeverityLevel->AdvancedSearch->load();
		$this->Days->AdvancedSearch->load();
		$this->DataLastUpdated->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ticketlist.php"), "", $this->TableVar, TRUE);
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
				case "x_TicketCategory":
					break;
				case "x_TicketType":
					break;
				case "x_ReportedBy":
					break;
				case "x_TicketStatus":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_AllocatedTo":
					break;
				case "x_EscalatedTo":
					break;
				case "x_SeverityLevel":
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
						case "x_TicketCategory":
							break;
						case "x_TicketType":
							break;
						case "x_ReportedBy":
							break;
						case "x_TicketStatus":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_AllocatedTo":
							break;
						case "x_EscalatedTo":
							break;
						case "x_SeverityLevel":
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