<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class resolution_view_search extends resolution_view
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'resolution_view';

	// Page object name
	public $PageObjName = "resolution_view_search";

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

		// Table object (resolution_view)
		if (!isset($GLOBALS["resolution_view"]) || get_class($GLOBALS["resolution_view"]) == PROJECT_NAMESPACE . "resolution_view") {
			$GLOBALS["resolution_view"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["resolution_view"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'resolution_view');

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
		global $resolution_view;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($resolution_view);
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
					if ($pageName == "resolution_viewview.php")
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
			$key .= @$ar['ProvinceCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['LACode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['MeetingNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['ResolutionNo'];
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
			$this->MeetingNo->Visible = FALSE;
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ResolutionNo->Visible = FALSE;
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
					$this->terminate(GetUrl("resolution_viewlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->LAName->setVisibility();
		$this->MeetingNo->setVisibility();
		$this->MeetingRef->setVisibility();
		$this->MeetingType->setVisibility();
		$this->ActualDate->setVisibility();
		$this->MeetingTypeName->setVisibility();
		$this->ResolutionNo->setVisibility();
		$this->Resolution->setVisibility();
		$this->Responsibility->setVisibility();
		$this->ActionDate->setVisibility();
		$this->ResolutionCategoryName->setVisibility();
		$this->MinuteNumber->setVisibility();
		$this->Subject->setVisibility();
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
		$this->setupLookupOptions($this->ProvinceCode);

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
					$srchStr = "resolution_viewlist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->ProvinceCode); // ProvinceCode
		$this->buildSearchUrl($srchUrl, $this->LACode); // LACode
		$this->buildSearchUrl($srchUrl, $this->LAName); // LAName
		$this->buildSearchUrl($srchUrl, $this->MeetingNo); // MeetingNo
		$this->buildSearchUrl($srchUrl, $this->MeetingRef); // MeetingRef
		$this->buildSearchUrl($srchUrl, $this->MeetingType); // MeetingType
		$this->buildSearchUrl($srchUrl, $this->ActualDate); // ActualDate
		$this->buildSearchUrl($srchUrl, $this->MeetingTypeName); // MeetingTypeName
		$this->buildSearchUrl($srchUrl, $this->ResolutionNo); // ResolutionNo
		$this->buildSearchUrl($srchUrl, $this->Resolution); // Resolution
		$this->buildSearchUrl($srchUrl, $this->Responsibility); // Responsibility
		$this->buildSearchUrl($srchUrl, $this->ActionDate); // ActionDate
		$this->buildSearchUrl($srchUrl, $this->ResolutionCategoryName); // ResolutionCategoryName
		$this->buildSearchUrl($srchUrl, $this->MinuteNumber); // MinuteNumber
		$this->buildSearchUrl($srchUrl, $this->Subject); // Subject
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
		if ($this->ProvinceCode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LACode->AdvancedSearch->post())
			$got = TRUE;
		if ($this->LAName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MeetingNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MeetingRef->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MeetingType->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ActualDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MeetingTypeName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ResolutionNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Resolution->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Responsibility->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ActionDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ResolutionCategoryName->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MinuteNumber->AdvancedSearch->post())
			$got = TRUE;
		if ($this->Subject->AdvancedSearch->post())
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
		// ProvinceCode
		// LACode
		// LAName
		// MeetingNo
		// MeetingRef
		// MeetingType
		// ActualDate
		// MeetingTypeName
		// ResolutionNo
		// Resolution
		// Responsibility
		// ActionDate
		// ResolutionCategoryName
		// MinuteNumber
		// Subject

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewCustomAttributes = "";

			// LAName
			$this->LAName->ViewValue = $this->LAName->CurrentValue;
			$this->LAName->ViewCustomAttributes = "";

			// MeetingNo
			$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
			$this->MeetingNo->ViewCustomAttributes = "";

			// MeetingRef
			$this->MeetingRef->ViewValue = $this->MeetingRef->CurrentValue;
			$this->MeetingRef->ViewCustomAttributes = "";

			// MeetingType
			$this->MeetingType->ViewValue = $this->MeetingType->CurrentValue;
			$this->MeetingType->ViewCustomAttributes = "";

			// ActualDate
			$this->ActualDate->ViewValue = $this->ActualDate->CurrentValue;
			$this->ActualDate->ViewValue = FormatDateTime($this->ActualDate->ViewValue, 0);
			$this->ActualDate->ViewCustomAttributes = "";

			// MeetingTypeName
			$this->MeetingTypeName->ViewValue = $this->MeetingTypeName->CurrentValue;
			$this->MeetingTypeName->ViewCustomAttributes = "";

			// ResolutionNo
			$this->ResolutionNo->ViewValue = $this->ResolutionNo->CurrentValue;
			$this->ResolutionNo->ViewCustomAttributes = "";

			// Resolution
			$this->Resolution->ViewValue = $this->Resolution->CurrentValue;
			$this->Resolution->ViewCustomAttributes = "";

			// Responsibility
			$this->Responsibility->ViewValue = $this->Responsibility->CurrentValue;
			$this->Responsibility->ViewCustomAttributes = "";

			// ActionDate
			$this->ActionDate->ViewValue = $this->ActionDate->CurrentValue;
			$this->ActionDate->ViewValue = FormatDateTime($this->ActionDate->ViewValue, 0);
			$this->ActionDate->ViewCustomAttributes = "";

			// ResolutionCategoryName
			$this->ResolutionCategoryName->ViewValue = $this->ResolutionCategoryName->CurrentValue;
			$this->ResolutionCategoryName->ViewCustomAttributes = "";

			// MinuteNumber
			$this->MinuteNumber->ViewValue = $this->MinuteNumber->CurrentValue;
			$this->MinuteNumber->ViewCustomAttributes = "";

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";
			$this->LAName->TooltipValue = "";

			// MeetingNo
			$this->MeetingNo->LinkCustomAttributes = "";
			$this->MeetingNo->HrefValue = "";
			$this->MeetingNo->TooltipValue = "";

			// MeetingRef
			$this->MeetingRef->LinkCustomAttributes = "";
			$this->MeetingRef->HrefValue = "";
			$this->MeetingRef->TooltipValue = "";

			// MeetingType
			$this->MeetingType->LinkCustomAttributes = "";
			$this->MeetingType->HrefValue = "";
			$this->MeetingType->TooltipValue = "";

			// ActualDate
			$this->ActualDate->LinkCustomAttributes = "";
			$this->ActualDate->HrefValue = "";
			$this->ActualDate->TooltipValue = "";

			// MeetingTypeName
			$this->MeetingTypeName->LinkCustomAttributes = "";
			$this->MeetingTypeName->HrefValue = "";
			$this->MeetingTypeName->TooltipValue = "";

			// ResolutionNo
			$this->ResolutionNo->LinkCustomAttributes = "";
			$this->ResolutionNo->HrefValue = "";
			$this->ResolutionNo->TooltipValue = "";

			// Resolution
			$this->Resolution->LinkCustomAttributes = "";
			$this->Resolution->HrefValue = "";
			$this->Resolution->TooltipValue = "";

			// Responsibility
			$this->Responsibility->LinkCustomAttributes = "";
			$this->Responsibility->HrefValue = "";
			$this->Responsibility->TooltipValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";
			$this->ActionDate->TooltipValue = "";

			// ResolutionCategoryName
			$this->ResolutionCategoryName->LinkCustomAttributes = "";
			$this->ResolutionCategoryName->HrefValue = "";
			$this->ResolutionCategoryName->TooltipValue = "";

			// MinuteNumber
			$this->MinuteNumber->LinkCustomAttributes = "";
			$this->MinuteNumber->HrefValue = "";
			$this->MinuteNumber->TooltipValue = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

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
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if (!$this->LACode->Raw)
				$this->LACode->AdvancedSearch->SearchValue = HtmlDecode($this->LACode->AdvancedSearch->SearchValue);
			$this->LACode->EditValue = HtmlEncode($this->LACode->AdvancedSearch->SearchValue);
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->AdvancedSearch->SearchValue = HtmlDecode($this->LAName->AdvancedSearch->SearchValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->AdvancedSearch->SearchValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// MeetingNo
			$this->MeetingNo->EditAttrs["class"] = "form-control";
			$this->MeetingNo->EditCustomAttributes = "";
			$this->MeetingNo->EditValue = HtmlEncode($this->MeetingNo->AdvancedSearch->SearchValue);
			$this->MeetingNo->PlaceHolder = RemoveHtml($this->MeetingNo->caption());

			// MeetingRef
			$this->MeetingRef->EditAttrs["class"] = "form-control";
			$this->MeetingRef->EditCustomAttributes = "";
			if (!$this->MeetingRef->Raw)
				$this->MeetingRef->AdvancedSearch->SearchValue = HtmlDecode($this->MeetingRef->AdvancedSearch->SearchValue);
			$this->MeetingRef->EditValue = HtmlEncode($this->MeetingRef->AdvancedSearch->SearchValue);
			$this->MeetingRef->PlaceHolder = RemoveHtml($this->MeetingRef->caption());

			// MeetingType
			$this->MeetingType->EditAttrs["class"] = "form-control";
			$this->MeetingType->EditCustomAttributes = "";
			$this->MeetingType->EditValue = HtmlEncode($this->MeetingType->AdvancedSearch->SearchValue);
			$this->MeetingType->PlaceHolder = RemoveHtml($this->MeetingType->caption());

			// ActualDate
			$this->ActualDate->EditAttrs["class"] = "form-control";
			$this->ActualDate->EditCustomAttributes = "";
			$this->ActualDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ActualDate->AdvancedSearch->SearchValue, 0), 8));
			$this->ActualDate->PlaceHolder = RemoveHtml($this->ActualDate->caption());

			// MeetingTypeName
			$this->MeetingTypeName->EditAttrs["class"] = "form-control";
			$this->MeetingTypeName->EditCustomAttributes = "";
			if (!$this->MeetingTypeName->Raw)
				$this->MeetingTypeName->AdvancedSearch->SearchValue = HtmlDecode($this->MeetingTypeName->AdvancedSearch->SearchValue);
			$this->MeetingTypeName->EditValue = HtmlEncode($this->MeetingTypeName->AdvancedSearch->SearchValue);
			$this->MeetingTypeName->PlaceHolder = RemoveHtml($this->MeetingTypeName->caption());

			// ResolutionNo
			$this->ResolutionNo->EditAttrs["class"] = "form-control";
			$this->ResolutionNo->EditCustomAttributes = "";
			$this->ResolutionNo->EditValue = HtmlEncode($this->ResolutionNo->AdvancedSearch->SearchValue);
			$this->ResolutionNo->PlaceHolder = RemoveHtml($this->ResolutionNo->caption());

			// Resolution
			$this->Resolution->EditAttrs["class"] = "form-control";
			$this->Resolution->EditCustomAttributes = "";
			$this->Resolution->EditValue = HtmlEncode($this->Resolution->AdvancedSearch->SearchValue);
			$this->Resolution->PlaceHolder = RemoveHtml($this->Resolution->caption());

			// Responsibility
			$this->Responsibility->EditAttrs["class"] = "form-control";
			$this->Responsibility->EditCustomAttributes = "";
			if (!$this->Responsibility->Raw)
				$this->Responsibility->AdvancedSearch->SearchValue = HtmlDecode($this->Responsibility->AdvancedSearch->SearchValue);
			$this->Responsibility->EditValue = HtmlEncode($this->Responsibility->AdvancedSearch->SearchValue);
			$this->Responsibility->PlaceHolder = RemoveHtml($this->Responsibility->caption());

			// ActionDate
			$this->ActionDate->EditAttrs["class"] = "form-control";
			$this->ActionDate->EditCustomAttributes = "";
			$this->ActionDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->ActionDate->AdvancedSearch->SearchValue, 0), 8));
			$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

			// ResolutionCategoryName
			$this->ResolutionCategoryName->EditAttrs["class"] = "form-control";
			$this->ResolutionCategoryName->EditCustomAttributes = "";
			if (!$this->ResolutionCategoryName->Raw)
				$this->ResolutionCategoryName->AdvancedSearch->SearchValue = HtmlDecode($this->ResolutionCategoryName->AdvancedSearch->SearchValue);
			$this->ResolutionCategoryName->EditValue = HtmlEncode($this->ResolutionCategoryName->AdvancedSearch->SearchValue);
			$this->ResolutionCategoryName->PlaceHolder = RemoveHtml($this->ResolutionCategoryName->caption());

			// MinuteNumber
			$this->MinuteNumber->EditAttrs["class"] = "form-control";
			$this->MinuteNumber->EditCustomAttributes = "";
			if (!$this->MinuteNumber->Raw)
				$this->MinuteNumber->AdvancedSearch->SearchValue = HtmlDecode($this->MinuteNumber->AdvancedSearch->SearchValue);
			$this->MinuteNumber->EditValue = HtmlEncode($this->MinuteNumber->AdvancedSearch->SearchValue);
			$this->MinuteNumber->PlaceHolder = RemoveHtml($this->MinuteNumber->caption());

			// Subject
			$this->Subject->EditAttrs["class"] = "form-control";
			$this->Subject->EditCustomAttributes = "";
			if (!$this->Subject->Raw)
				$this->Subject->AdvancedSearch->SearchValue = HtmlDecode($this->Subject->AdvancedSearch->SearchValue);
			$this->Subject->EditValue = HtmlEncode($this->Subject->AdvancedSearch->SearchValue);
			$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());
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
		if (!CheckInteger($this->MeetingNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->MeetingNo->errorMessage());
		}
		if (!CheckInteger($this->MeetingType->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->MeetingType->errorMessage());
		}
		if (!CheckDate($this->ActualDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ActualDate->errorMessage());
		}
		if (!CheckInteger($this->ResolutionNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ResolutionNo->errorMessage());
		}
		if (!CheckDate($this->ActionDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ActionDate->errorMessage());
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
		$this->ProvinceCode->AdvancedSearch->load();
		$this->LACode->AdvancedSearch->load();
		$this->LAName->AdvancedSearch->load();
		$this->MeetingNo->AdvancedSearch->load();
		$this->MeetingRef->AdvancedSearch->load();
		$this->MeetingType->AdvancedSearch->load();
		$this->ActualDate->AdvancedSearch->load();
		$this->MeetingTypeName->AdvancedSearch->load();
		$this->ResolutionNo->AdvancedSearch->load();
		$this->Resolution->AdvancedSearch->load();
		$this->Responsibility->AdvancedSearch->load();
		$this->ActionDate->AdvancedSearch->load();
		$this->ResolutionCategoryName->AdvancedSearch->load();
		$this->MinuteNumber->AdvancedSearch->load();
		$this->Subject->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("resolution_viewlist.php"), "", $this->TableVar, TRUE);
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
				case "x_ProvinceCode":
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
						case "x_ProvinceCode":
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