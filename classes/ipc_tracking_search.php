<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class ipc_tracking_search extends ipc_tracking
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'ipc_tracking';

	// Page object name
	public $PageObjName = "ipc_tracking_search";

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

		// Table object (ipc_tracking)
		if (!isset($GLOBALS["ipc_tracking"]) || get_class($GLOBALS["ipc_tracking"]) == PROJECT_NAMESPACE . "ipc_tracking") {
			$GLOBALS["ipc_tracking"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ipc_tracking"];
		}

		// Table object (contract)
		if (!isset($GLOBALS['contract']))
			$GLOBALS['contract'] = new contract();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ipc_tracking');

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
		global $ipc_tracking;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ipc_tracking);
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
					if ($pageName == "ipc_trackingview.php")
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
			$key .= @$ar['IPCNo'];
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
			$this->IPCNo->Visible = FALSE;
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
					$this->terminate(GetUrl("ipc_trackinglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->IPCNo->setVisibility();
		$this->ContractNo->setVisibility();
		$this->ContractAuthorizedByAG->setVisibility();
		$this->VATApplied->setVisibility();
		$this->ArithmeticCheckDone->setVisibility();
		$this->VariationsApproved->setVisibility();
		$this->PerformanceBondValidUntil->setVisibility();
		$this->AdvancePaymentBondValidUntil->setVisibility();
		$this->RetentionDeductionClause->setVisibility();
		$this->RetentionDeducted->setVisibility();
		$this->LiquidatedDamagesDeducted->setVisibility();
		$this->LiquidatedPenaltiesDeducted->setVisibility();
		$this->AdvancedPaymentDeducted->setVisibility();
		$this->CurrentProgressReportAttached->setVisibility();
		$this->CurrentProgressReport->Visible = FALSE;
		$this->DateOfSiteInspection->setVisibility();
		$this->TimeExtensionAuthorized->setVisibility();
		$this->LabResultsChecked->setVisibility();
		$this->LabResults->Visible = FALSE;
		$this->TerminationNoticeGiven->setVisibility();
		$this->CopiesEmailedToMLG->setVisibility();
		$this->ContractStillValid->setVisibility();
		$this->DeskOfficer->setVisibility();
		$this->DeskOfficerDate->setVisibility();
		$this->SupervisingEngineer->setVisibility();
		$this->EngineerDate->setVisibility();
		$this->CouncilSecretary->setVisibility();
		$this->CSDate->setVisibility();
		$this->MLGComments->setVisibility();
		$this->ContractType->setVisibility();
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
					$srchStr = "ipc_trackinglist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->IPCNo); // IPCNo
		$this->buildSearchUrl($srchUrl, $this->ContractNo); // ContractNo
		$this->buildSearchUrl($srchUrl, $this->ContractAuthorizedByAG, TRUE); // ContractAuthorizedByAG
		$this->buildSearchUrl($srchUrl, $this->VATApplied, TRUE); // VATApplied
		$this->buildSearchUrl($srchUrl, $this->ArithmeticCheckDone, TRUE); // ArithmeticCheckDone
		$this->buildSearchUrl($srchUrl, $this->VariationsApproved, TRUE); // VariationsApproved
		$this->buildSearchUrl($srchUrl, $this->PerformanceBondValidUntil); // PerformanceBondValidUntil
		$this->buildSearchUrl($srchUrl, $this->AdvancePaymentBondValidUntil); // AdvancePaymentBondValidUntil
		$this->buildSearchUrl($srchUrl, $this->RetentionDeductionClause); // RetentionDeductionClause
		$this->buildSearchUrl($srchUrl, $this->RetentionDeducted, TRUE); // RetentionDeducted
		$this->buildSearchUrl($srchUrl, $this->LiquidatedDamagesDeducted, TRUE); // LiquidatedDamagesDeducted
		$this->buildSearchUrl($srchUrl, $this->LiquidatedPenaltiesDeducted, TRUE); // LiquidatedPenaltiesDeducted
		$this->buildSearchUrl($srchUrl, $this->AdvancedPaymentDeducted, TRUE); // AdvancedPaymentDeducted
		$this->buildSearchUrl($srchUrl, $this->CurrentProgressReportAttached, TRUE); // CurrentProgressReportAttached
		$this->buildSearchUrl($srchUrl, $this->DateOfSiteInspection); // DateOfSiteInspection
		$this->buildSearchUrl($srchUrl, $this->TimeExtensionAuthorized, TRUE); // TimeExtensionAuthorized
		$this->buildSearchUrl($srchUrl, $this->LabResultsChecked, TRUE); // LabResultsChecked
		$this->buildSearchUrl($srchUrl, $this->TerminationNoticeGiven, TRUE); // TerminationNoticeGiven
		$this->buildSearchUrl($srchUrl, $this->CopiesEmailedToMLG, TRUE); // CopiesEmailedToMLG
		$this->buildSearchUrl($srchUrl, $this->ContractStillValid, TRUE); // ContractStillValid
		$this->buildSearchUrl($srchUrl, $this->DeskOfficer); // DeskOfficer
		$this->buildSearchUrl($srchUrl, $this->DeskOfficerDate); // DeskOfficerDate
		$this->buildSearchUrl($srchUrl, $this->SupervisingEngineer); // SupervisingEngineer
		$this->buildSearchUrl($srchUrl, $this->EngineerDate); // EngineerDate
		$this->buildSearchUrl($srchUrl, $this->CouncilSecretary); // CouncilSecretary
		$this->buildSearchUrl($srchUrl, $this->CSDate); // CSDate
		$this->buildSearchUrl($srchUrl, $this->MLGComments); // MLGComments
		$this->buildSearchUrl($srchUrl, $this->ContractType); // ContractType
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
		if ($this->IPCNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractNo->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractAuthorizedByAG->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->ContractAuthorizedByAG->AdvancedSearch->SearchValue))
			$this->ContractAuthorizedByAG->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractAuthorizedByAG->AdvancedSearch->SearchValue);
		if (is_array($this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2))
			$this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractAuthorizedByAG->AdvancedSearch->SearchValue2);
		if ($this->VATApplied->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->VATApplied->AdvancedSearch->SearchValue))
			$this->VATApplied->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VATApplied->AdvancedSearch->SearchValue);
		if (is_array($this->VATApplied->AdvancedSearch->SearchValue2))
			$this->VATApplied->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VATApplied->AdvancedSearch->SearchValue2);
		if ($this->ArithmeticCheckDone->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->ArithmeticCheckDone->AdvancedSearch->SearchValue))
			$this->ArithmeticCheckDone->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ArithmeticCheckDone->AdvancedSearch->SearchValue);
		if (is_array($this->ArithmeticCheckDone->AdvancedSearch->SearchValue2))
			$this->ArithmeticCheckDone->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ArithmeticCheckDone->AdvancedSearch->SearchValue2);
		if ($this->VariationsApproved->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->VariationsApproved->AdvancedSearch->SearchValue))
			$this->VariationsApproved->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VariationsApproved->AdvancedSearch->SearchValue);
		if (is_array($this->VariationsApproved->AdvancedSearch->SearchValue2))
			$this->VariationsApproved->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->VariationsApproved->AdvancedSearch->SearchValue2);
		if ($this->PerformanceBondValidUntil->AdvancedSearch->post())
			$got = TRUE;
		if ($this->AdvancePaymentBondValidUntil->AdvancedSearch->post())
			$got = TRUE;
		if ($this->RetentionDeductionClause->AdvancedSearch->post())
			$got = TRUE;
		if ($this->RetentionDeducted->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->RetentionDeducted->AdvancedSearch->SearchValue))
			$this->RetentionDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->RetentionDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->RetentionDeducted->AdvancedSearch->SearchValue2))
			$this->RetentionDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->RetentionDeducted->AdvancedSearch->SearchValue2);
		if ($this->LiquidatedDamagesDeducted->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue))
			$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2))
			$this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue2);
		if ($this->LiquidatedPenaltiesDeducted->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue))
			$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2))
			$this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue2);
		if ($this->AdvancedPaymentDeducted->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue))
			$this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue);
		if (is_array($this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2))
			$this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->AdvancedPaymentDeducted->AdvancedSearch->SearchValue2);
		if ($this->CurrentProgressReportAttached->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->CurrentProgressReportAttached->AdvancedSearch->SearchValue))
			$this->CurrentProgressReportAttached->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CurrentProgressReportAttached->AdvancedSearch->SearchValue);
		if (is_array($this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2))
			$this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CurrentProgressReportAttached->AdvancedSearch->SearchValue2);
		if ($this->DateOfSiteInspection->AdvancedSearch->post())
			$got = TRUE;
		if ($this->TimeExtensionAuthorized->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->TimeExtensionAuthorized->AdvancedSearch->SearchValue))
			$this->TimeExtensionAuthorized->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TimeExtensionAuthorized->AdvancedSearch->SearchValue);
		if (is_array($this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2))
			$this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TimeExtensionAuthorized->AdvancedSearch->SearchValue2);
		if ($this->LabResultsChecked->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->LabResultsChecked->AdvancedSearch->SearchValue))
			$this->LabResultsChecked->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LabResultsChecked->AdvancedSearch->SearchValue);
		if (is_array($this->LabResultsChecked->AdvancedSearch->SearchValue2))
			$this->LabResultsChecked->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->LabResultsChecked->AdvancedSearch->SearchValue2);
		if ($this->TerminationNoticeGiven->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->TerminationNoticeGiven->AdvancedSearch->SearchValue))
			$this->TerminationNoticeGiven->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TerminationNoticeGiven->AdvancedSearch->SearchValue);
		if (is_array($this->TerminationNoticeGiven->AdvancedSearch->SearchValue2))
			$this->TerminationNoticeGiven->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->TerminationNoticeGiven->AdvancedSearch->SearchValue2);
		if ($this->CopiesEmailedToMLG->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->CopiesEmailedToMLG->AdvancedSearch->SearchValue))
			$this->CopiesEmailedToMLG->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CopiesEmailedToMLG->AdvancedSearch->SearchValue);
		if (is_array($this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2))
			$this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->CopiesEmailedToMLG->AdvancedSearch->SearchValue2);
		if ($this->ContractStillValid->AdvancedSearch->post())
			$got = TRUE;
		if (is_array($this->ContractStillValid->AdvancedSearch->SearchValue))
			$this->ContractStillValid->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractStillValid->AdvancedSearch->SearchValue);
		if (is_array($this->ContractStillValid->AdvancedSearch->SearchValue2))
			$this->ContractStillValid->AdvancedSearch->SearchValue2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->ContractStillValid->AdvancedSearch->SearchValue2);
		if ($this->DeskOfficer->AdvancedSearch->post())
			$got = TRUE;
		if ($this->DeskOfficerDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->SupervisingEngineer->AdvancedSearch->post())
			$got = TRUE;
		if ($this->EngineerDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CouncilSecretary->AdvancedSearch->post())
			$got = TRUE;
		if ($this->CSDate->AdvancedSearch->post())
			$got = TRUE;
		if ($this->MLGComments->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ContractType->AdvancedSearch->post())
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
		// IPCNo
		// ContractNo
		// ContractAuthorizedByAG
		// VATApplied
		// ArithmeticCheckDone
		// VariationsApproved
		// PerformanceBondValidUntil
		// AdvancePaymentBondValidUntil
		// RetentionDeductionClause
		// RetentionDeducted
		// LiquidatedDamagesDeducted
		// LiquidatedPenaltiesDeducted
		// AdvancedPaymentDeducted
		// CurrentProgressReportAttached
		// CurrentProgressReport
		// DateOfSiteInspection
		// TimeExtensionAuthorized
		// LabResultsChecked
		// LabResults
		// TerminationNoticeGiven
		// CopiesEmailedToMLG
		// ContractStillValid
		// DeskOfficer
		// DeskOfficerDate
		// SupervisingEngineer
		// EngineerDate
		// CouncilSecretary
		// CSDate
		// MLGComments
		// ContractType

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IPCNo
			$this->IPCNo->ViewValue = $this->IPCNo->CurrentValue;
			$this->IPCNo->ViewCustomAttributes = "";

			// ContractNo
			$this->ContractNo->ViewValue = $this->ContractNo->CurrentValue;
			$this->ContractNo->ViewCustomAttributes = "";

			// ContractAuthorizedByAG
			if (ConvertToBool($this->ContractAuthorizedByAG->CurrentValue)) {
				$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(1) != "" ? $this->ContractAuthorizedByAG->tagCaption(1) : "Yes";
			} else {
				$this->ContractAuthorizedByAG->ViewValue = $this->ContractAuthorizedByAG->tagCaption(2) != "" ? $this->ContractAuthorizedByAG->tagCaption(2) : "No";
			}
			$this->ContractAuthorizedByAG->ViewCustomAttributes = "";

			// VATApplied
			if (ConvertToBool($this->VATApplied->CurrentValue)) {
				$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(1) != "" ? $this->VATApplied->tagCaption(1) : "Yes";
			} else {
				$this->VATApplied->ViewValue = $this->VATApplied->tagCaption(2) != "" ? $this->VATApplied->tagCaption(2) : "No";
			}
			$this->VATApplied->ViewCustomAttributes = "";

			// ArithmeticCheckDone
			if (ConvertToBool($this->ArithmeticCheckDone->CurrentValue)) {
				$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(1) != "" ? $this->ArithmeticCheckDone->tagCaption(1) : "Yes";
			} else {
				$this->ArithmeticCheckDone->ViewValue = $this->ArithmeticCheckDone->tagCaption(2) != "" ? $this->ArithmeticCheckDone->tagCaption(2) : "No";
			}
			$this->ArithmeticCheckDone->ViewCustomAttributes = "";

			// VariationsApproved
			if (ConvertToBool($this->VariationsApproved->CurrentValue)) {
				$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(1) != "" ? $this->VariationsApproved->tagCaption(1) : "Yes";
			} else {
				$this->VariationsApproved->ViewValue = $this->VariationsApproved->tagCaption(2) != "" ? $this->VariationsApproved->tagCaption(2) : "No";
			}
			$this->VariationsApproved->ViewCustomAttributes = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->ViewValue = $this->PerformanceBondValidUntil->CurrentValue;
			$this->PerformanceBondValidUntil->ViewValue = FormatDateTime($this->PerformanceBondValidUntil->ViewValue, 0);
			$this->PerformanceBondValidUntil->ViewCustomAttributes = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->ViewValue = $this->AdvancePaymentBondValidUntil->CurrentValue;
			$this->AdvancePaymentBondValidUntil->ViewValue = FormatDateTime($this->AdvancePaymentBondValidUntil->ViewValue, 0);
			$this->AdvancePaymentBondValidUntil->ViewCustomAttributes = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->ViewValue = $this->RetentionDeductionClause->CurrentValue;
			$this->RetentionDeductionClause->ViewCustomAttributes = "";

			// RetentionDeducted
			if (ConvertToBool($this->RetentionDeducted->CurrentValue)) {
				$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(1) != "" ? $this->RetentionDeducted->tagCaption(1) : "Yes";
			} else {
				$this->RetentionDeducted->ViewValue = $this->RetentionDeducted->tagCaption(2) != "" ? $this->RetentionDeducted->tagCaption(2) : "No";
			}
			$this->RetentionDeducted->ViewCustomAttributes = "";

			// LiquidatedDamagesDeducted
			if (ConvertToBool($this->LiquidatedDamagesDeducted->CurrentValue)) {
				$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(1) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(1) : "Yes";
			} else {
				$this->LiquidatedDamagesDeducted->ViewValue = $this->LiquidatedDamagesDeducted->tagCaption(2) != "" ? $this->LiquidatedDamagesDeducted->tagCaption(2) : "No";
			}
			$this->LiquidatedDamagesDeducted->ViewCustomAttributes = "";

			// LiquidatedPenaltiesDeducted
			if (ConvertToBool($this->LiquidatedPenaltiesDeducted->CurrentValue)) {
				$this->LiquidatedPenaltiesDeducted->ViewValue = $this->LiquidatedPenaltiesDeducted->tagCaption(1) != "" ? $this->LiquidatedPenaltiesDeducted->tagCaption(1) : "Yes";
			} else {
				$this->LiquidatedPenaltiesDeducted->ViewValue = $this->LiquidatedPenaltiesDeducted->tagCaption(2) != "" ? $this->LiquidatedPenaltiesDeducted->tagCaption(2) : "No";
			}
			$this->LiquidatedPenaltiesDeducted->ViewCustomAttributes = "";

			// AdvancedPaymentDeducted
			if (ConvertToBool($this->AdvancedPaymentDeducted->CurrentValue)) {
				$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(1) != "" ? $this->AdvancedPaymentDeducted->tagCaption(1) : "Yes";
			} else {
				$this->AdvancedPaymentDeducted->ViewValue = $this->AdvancedPaymentDeducted->tagCaption(2) != "" ? $this->AdvancedPaymentDeducted->tagCaption(2) : "No";
			}
			$this->AdvancedPaymentDeducted->ViewCustomAttributes = "";

			// CurrentProgressReportAttached
			if (ConvertToBool($this->CurrentProgressReportAttached->CurrentValue)) {
				$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(1) != "" ? $this->CurrentProgressReportAttached->tagCaption(1) : "Yes";
			} else {
				$this->CurrentProgressReportAttached->ViewValue = $this->CurrentProgressReportAttached->tagCaption(2) != "" ? $this->CurrentProgressReportAttached->tagCaption(2) : "No";
			}
			$this->CurrentProgressReportAttached->ViewCustomAttributes = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->ViewValue = $this->DateOfSiteInspection->CurrentValue;
			$this->DateOfSiteInspection->ViewValue = FormatDateTime($this->DateOfSiteInspection->ViewValue, 0);
			$this->DateOfSiteInspection->ViewCustomAttributes = "";

			// TimeExtensionAuthorized
			if (ConvertToBool($this->TimeExtensionAuthorized->CurrentValue)) {
				$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(1) != "" ? $this->TimeExtensionAuthorized->tagCaption(1) : "Yes";
			} else {
				$this->TimeExtensionAuthorized->ViewValue = $this->TimeExtensionAuthorized->tagCaption(2) != "" ? $this->TimeExtensionAuthorized->tagCaption(2) : "No";
			}
			$this->TimeExtensionAuthorized->ViewCustomAttributes = "";

			// LabResultsChecked
			if (ConvertToBool($this->LabResultsChecked->CurrentValue)) {
				$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(1) != "" ? $this->LabResultsChecked->tagCaption(1) : "Yes";
			} else {
				$this->LabResultsChecked->ViewValue = $this->LabResultsChecked->tagCaption(2) != "" ? $this->LabResultsChecked->tagCaption(2) : "No";
			}
			$this->LabResultsChecked->ViewCustomAttributes = "";

			// TerminationNoticeGiven
			if (ConvertToBool($this->TerminationNoticeGiven->CurrentValue)) {
				$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(1) != "" ? $this->TerminationNoticeGiven->tagCaption(1) : "Yes";
			} else {
				$this->TerminationNoticeGiven->ViewValue = $this->TerminationNoticeGiven->tagCaption(2) != "" ? $this->TerminationNoticeGiven->tagCaption(2) : "No";
			}
			$this->TerminationNoticeGiven->ViewCustomAttributes = "";

			// CopiesEmailedToMLG
			if (ConvertToBool($this->CopiesEmailedToMLG->CurrentValue)) {
				$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(1) != "" ? $this->CopiesEmailedToMLG->tagCaption(1) : "Yes";
			} else {
				$this->CopiesEmailedToMLG->ViewValue = $this->CopiesEmailedToMLG->tagCaption(2) != "" ? $this->CopiesEmailedToMLG->tagCaption(2) : "No";
			}
			$this->CopiesEmailedToMLG->ViewCustomAttributes = "";

			// ContractStillValid
			if (ConvertToBool($this->ContractStillValid->CurrentValue)) {
				$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(1) != "" ? $this->ContractStillValid->tagCaption(1) : "Yes";
			} else {
				$this->ContractStillValid->ViewValue = $this->ContractStillValid->tagCaption(2) != "" ? $this->ContractStillValid->tagCaption(2) : "No";
			}
			$this->ContractStillValid->ViewCustomAttributes = "";

			// DeskOfficer
			$this->DeskOfficer->ViewValue = $this->DeskOfficer->CurrentValue;
			$this->DeskOfficer->ViewCustomAttributes = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->ViewValue = $this->DeskOfficerDate->CurrentValue;
			$this->DeskOfficerDate->ViewValue = FormatDateTime($this->DeskOfficerDate->ViewValue, 0);
			$this->DeskOfficerDate->ViewCustomAttributes = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->ViewValue = $this->SupervisingEngineer->CurrentValue;
			$this->SupervisingEngineer->ViewCustomAttributes = "";

			// EngineerDate
			$this->EngineerDate->ViewValue = $this->EngineerDate->CurrentValue;
			$this->EngineerDate->ViewValue = FormatDateTime($this->EngineerDate->ViewValue, 0);
			$this->EngineerDate->ViewCustomAttributes = "";

			// CouncilSecretary
			$this->CouncilSecretary->ViewValue = $this->CouncilSecretary->CurrentValue;
			$this->CouncilSecretary->ViewCustomAttributes = "";

			// CSDate
			$this->CSDate->ViewValue = $this->CSDate->CurrentValue;
			$this->CSDate->ViewValue = FormatDateTime($this->CSDate->ViewValue, 0);
			$this->CSDate->ViewCustomAttributes = "";

			// MLGComments
			$this->MLGComments->ViewValue = $this->MLGComments->CurrentValue;
			$this->MLGComments->ViewCustomAttributes = "";

			// ContractType
			$this->ContractType->ViewValue = $this->ContractType->CurrentValue;
			$this->ContractType->ViewValue = FormatNumber($this->ContractType->ViewValue, 0, -2, -2, -2);
			$this->ContractType->ViewCustomAttributes = "";

			// IPCNo
			$this->IPCNo->LinkCustomAttributes = "";
			$this->IPCNo->HrefValue = "";
			$this->IPCNo->TooltipValue = "";

			// ContractNo
			$this->ContractNo->LinkCustomAttributes = "";
			$this->ContractNo->HrefValue = "";
			$this->ContractNo->TooltipValue = "";

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->LinkCustomAttributes = "";
			$this->ContractAuthorizedByAG->HrefValue = "";
			$this->ContractAuthorizedByAG->TooltipValue = "";

			// VATApplied
			$this->VATApplied->LinkCustomAttributes = "";
			$this->VATApplied->HrefValue = "";
			$this->VATApplied->TooltipValue = "";

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->LinkCustomAttributes = "";
			$this->ArithmeticCheckDone->HrefValue = "";
			$this->ArithmeticCheckDone->TooltipValue = "";

			// VariationsApproved
			$this->VariationsApproved->LinkCustomAttributes = "";
			$this->VariationsApproved->HrefValue = "";
			$this->VariationsApproved->TooltipValue = "";

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->LinkCustomAttributes = "";
			$this->PerformanceBondValidUntil->HrefValue = "";
			$this->PerformanceBondValidUntil->TooltipValue = "";

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->LinkCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->HrefValue = "";
			$this->AdvancePaymentBondValidUntil->TooltipValue = "";

			// RetentionDeductionClause
			$this->RetentionDeductionClause->LinkCustomAttributes = "";
			$this->RetentionDeductionClause->HrefValue = "";
			$this->RetentionDeductionClause->TooltipValue = "";

			// RetentionDeducted
			$this->RetentionDeducted->LinkCustomAttributes = "";
			$this->RetentionDeducted->HrefValue = "";
			$this->RetentionDeducted->TooltipValue = "";

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->LinkCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->HrefValue = "";
			$this->LiquidatedDamagesDeducted->TooltipValue = "";

			// LiquidatedPenaltiesDeducted
			$this->LiquidatedPenaltiesDeducted->LinkCustomAttributes = "";
			$this->LiquidatedPenaltiesDeducted->HrefValue = "";
			$this->LiquidatedPenaltiesDeducted->TooltipValue = "";

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->LinkCustomAttributes = "";
			$this->AdvancedPaymentDeducted->HrefValue = "";
			$this->AdvancedPaymentDeducted->TooltipValue = "";

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->LinkCustomAttributes = "";
			$this->CurrentProgressReportAttached->HrefValue = "";
			$this->CurrentProgressReportAttached->TooltipValue = "";

			// DateOfSiteInspection
			$this->DateOfSiteInspection->LinkCustomAttributes = "";
			$this->DateOfSiteInspection->HrefValue = "";
			$this->DateOfSiteInspection->TooltipValue = "";

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->LinkCustomAttributes = "";
			$this->TimeExtensionAuthorized->HrefValue = "";
			$this->TimeExtensionAuthorized->TooltipValue = "";

			// LabResultsChecked
			$this->LabResultsChecked->LinkCustomAttributes = "";
			$this->LabResultsChecked->HrefValue = "";
			$this->LabResultsChecked->TooltipValue = "";

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->LinkCustomAttributes = "";
			$this->TerminationNoticeGiven->HrefValue = "";
			$this->TerminationNoticeGiven->TooltipValue = "";

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->LinkCustomAttributes = "";
			$this->CopiesEmailedToMLG->HrefValue = "";
			$this->CopiesEmailedToMLG->TooltipValue = "";

			// ContractStillValid
			$this->ContractStillValid->LinkCustomAttributes = "";
			$this->ContractStillValid->HrefValue = "";
			$this->ContractStillValid->TooltipValue = "";

			// DeskOfficer
			$this->DeskOfficer->LinkCustomAttributes = "";
			$this->DeskOfficer->HrefValue = "";
			$this->DeskOfficer->TooltipValue = "";

			// DeskOfficerDate
			$this->DeskOfficerDate->LinkCustomAttributes = "";
			$this->DeskOfficerDate->HrefValue = "";
			$this->DeskOfficerDate->TooltipValue = "";

			// SupervisingEngineer
			$this->SupervisingEngineer->LinkCustomAttributes = "";
			$this->SupervisingEngineer->HrefValue = "";
			$this->SupervisingEngineer->TooltipValue = "";

			// EngineerDate
			$this->EngineerDate->LinkCustomAttributes = "";
			$this->EngineerDate->HrefValue = "";
			$this->EngineerDate->TooltipValue = "";

			// CouncilSecretary
			$this->CouncilSecretary->LinkCustomAttributes = "";
			$this->CouncilSecretary->HrefValue = "";
			$this->CouncilSecretary->TooltipValue = "";

			// CSDate
			$this->CSDate->LinkCustomAttributes = "";
			$this->CSDate->HrefValue = "";
			$this->CSDate->TooltipValue = "";

			// MLGComments
			$this->MLGComments->LinkCustomAttributes = "";
			$this->MLGComments->HrefValue = "";
			$this->MLGComments->TooltipValue = "";

			// ContractType
			$this->ContractType->LinkCustomAttributes = "";
			$this->ContractType->HrefValue = "";
			$this->ContractType->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// IPCNo
			$this->IPCNo->EditAttrs["class"] = "form-control";
			$this->IPCNo->EditCustomAttributes = "";
			$this->IPCNo->EditValue = HtmlEncode($this->IPCNo->AdvancedSearch->SearchValue);
			$this->IPCNo->PlaceHolder = RemoveHtml($this->IPCNo->caption());

			// ContractNo
			$this->ContractNo->EditAttrs["class"] = "form-control";
			$this->ContractNo->EditCustomAttributes = "";
			if (!$this->ContractNo->Raw)
				$this->ContractNo->AdvancedSearch->SearchValue = HtmlDecode($this->ContractNo->AdvancedSearch->SearchValue);
			$this->ContractNo->EditValue = HtmlEncode($this->ContractNo->AdvancedSearch->SearchValue);
			$this->ContractNo->PlaceHolder = RemoveHtml($this->ContractNo->caption());

			// ContractAuthorizedByAG
			$this->ContractAuthorizedByAG->EditCustomAttributes = "";
			$this->ContractAuthorizedByAG->EditValue = $this->ContractAuthorizedByAG->options(FALSE);

			// VATApplied
			$this->VATApplied->EditCustomAttributes = "";
			$this->VATApplied->EditValue = $this->VATApplied->options(FALSE);

			// ArithmeticCheckDone
			$this->ArithmeticCheckDone->EditCustomAttributes = "";
			$this->ArithmeticCheckDone->EditValue = $this->ArithmeticCheckDone->options(FALSE);

			// VariationsApproved
			$this->VariationsApproved->EditCustomAttributes = "";
			$this->VariationsApproved->EditValue = $this->VariationsApproved->options(FALSE);

			// PerformanceBondValidUntil
			$this->PerformanceBondValidUntil->EditAttrs["class"] = "form-control";
			$this->PerformanceBondValidUntil->EditCustomAttributes = "";
			$this->PerformanceBondValidUntil->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->PerformanceBondValidUntil->AdvancedSearch->SearchValue, 0), 8));
			$this->PerformanceBondValidUntil->PlaceHolder = RemoveHtml($this->PerformanceBondValidUntil->caption());

			// AdvancePaymentBondValidUntil
			$this->AdvancePaymentBondValidUntil->EditAttrs["class"] = "form-control";
			$this->AdvancePaymentBondValidUntil->EditCustomAttributes = "";
			$this->AdvancePaymentBondValidUntil->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchValue, 0), 8));
			$this->AdvancePaymentBondValidUntil->PlaceHolder = RemoveHtml($this->AdvancePaymentBondValidUntil->caption());

			// RetentionDeductionClause
			$this->RetentionDeductionClause->EditAttrs["class"] = "form-control";
			$this->RetentionDeductionClause->EditCustomAttributes = "";
			if (!$this->RetentionDeductionClause->Raw)
				$this->RetentionDeductionClause->AdvancedSearch->SearchValue = HtmlDecode($this->RetentionDeductionClause->AdvancedSearch->SearchValue);
			$this->RetentionDeductionClause->EditValue = HtmlEncode($this->RetentionDeductionClause->AdvancedSearch->SearchValue);
			$this->RetentionDeductionClause->PlaceHolder = RemoveHtml($this->RetentionDeductionClause->caption());

			// RetentionDeducted
			$this->RetentionDeducted->EditCustomAttributes = "";
			$this->RetentionDeducted->EditValue = $this->RetentionDeducted->options(FALSE);

			// LiquidatedDamagesDeducted
			$this->LiquidatedDamagesDeducted->EditCustomAttributes = "";
			$this->LiquidatedDamagesDeducted->EditValue = $this->LiquidatedDamagesDeducted->options(FALSE);

			// LiquidatedPenaltiesDeducted
			$this->LiquidatedPenaltiesDeducted->EditCustomAttributes = "";
			$this->LiquidatedPenaltiesDeducted->EditValue = $this->LiquidatedPenaltiesDeducted->options(FALSE);

			// AdvancedPaymentDeducted
			$this->AdvancedPaymentDeducted->EditCustomAttributes = "";
			$this->AdvancedPaymentDeducted->EditValue = $this->AdvancedPaymentDeducted->options(FALSE);

			// CurrentProgressReportAttached
			$this->CurrentProgressReportAttached->EditCustomAttributes = "";
			$this->CurrentProgressReportAttached->EditValue = $this->CurrentProgressReportAttached->options(FALSE);

			// DateOfSiteInspection
			$this->DateOfSiteInspection->EditAttrs["class"] = "form-control";
			$this->DateOfSiteInspection->EditCustomAttributes = "";
			$this->DateOfSiteInspection->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DateOfSiteInspection->AdvancedSearch->SearchValue, 0), 8));
			$this->DateOfSiteInspection->PlaceHolder = RemoveHtml($this->DateOfSiteInspection->caption());

			// TimeExtensionAuthorized
			$this->TimeExtensionAuthorized->EditCustomAttributes = "";
			$this->TimeExtensionAuthorized->EditValue = $this->TimeExtensionAuthorized->options(FALSE);

			// LabResultsChecked
			$this->LabResultsChecked->EditCustomAttributes = "";
			$this->LabResultsChecked->EditValue = $this->LabResultsChecked->options(FALSE);

			// TerminationNoticeGiven
			$this->TerminationNoticeGiven->EditCustomAttributes = "";
			$this->TerminationNoticeGiven->EditValue = $this->TerminationNoticeGiven->options(FALSE);

			// CopiesEmailedToMLG
			$this->CopiesEmailedToMLG->EditCustomAttributes = "";
			$this->CopiesEmailedToMLG->EditValue = $this->CopiesEmailedToMLG->options(FALSE);

			// ContractStillValid
			$this->ContractStillValid->EditCustomAttributes = "";
			$this->ContractStillValid->EditValue = $this->ContractStillValid->options(FALSE);

			// DeskOfficer
			$this->DeskOfficer->EditAttrs["class"] = "form-control";
			$this->DeskOfficer->EditCustomAttributes = "";
			if (!$this->DeskOfficer->Raw)
				$this->DeskOfficer->AdvancedSearch->SearchValue = HtmlDecode($this->DeskOfficer->AdvancedSearch->SearchValue);
			$this->DeskOfficer->EditValue = HtmlEncode($this->DeskOfficer->AdvancedSearch->SearchValue);
			$this->DeskOfficer->PlaceHolder = RemoveHtml($this->DeskOfficer->caption());

			// DeskOfficerDate
			$this->DeskOfficerDate->EditAttrs["class"] = "form-control";
			$this->DeskOfficerDate->EditCustomAttributes = "";
			$this->DeskOfficerDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DeskOfficerDate->AdvancedSearch->SearchValue, 0), 8));
			$this->DeskOfficerDate->PlaceHolder = RemoveHtml($this->DeskOfficerDate->caption());

			// SupervisingEngineer
			$this->SupervisingEngineer->EditAttrs["class"] = "form-control";
			$this->SupervisingEngineer->EditCustomAttributes = "";
			if (!$this->SupervisingEngineer->Raw)
				$this->SupervisingEngineer->AdvancedSearch->SearchValue = HtmlDecode($this->SupervisingEngineer->AdvancedSearch->SearchValue);
			$this->SupervisingEngineer->EditValue = HtmlEncode($this->SupervisingEngineer->AdvancedSearch->SearchValue);
			$this->SupervisingEngineer->PlaceHolder = RemoveHtml($this->SupervisingEngineer->caption());

			// EngineerDate
			$this->EngineerDate->EditAttrs["class"] = "form-control";
			$this->EngineerDate->EditCustomAttributes = "";
			$this->EngineerDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->EngineerDate->AdvancedSearch->SearchValue, 0), 8));
			$this->EngineerDate->PlaceHolder = RemoveHtml($this->EngineerDate->caption());

			// CouncilSecretary
			$this->CouncilSecretary->EditAttrs["class"] = "form-control";
			$this->CouncilSecretary->EditCustomAttributes = "";
			if (!$this->CouncilSecretary->Raw)
				$this->CouncilSecretary->AdvancedSearch->SearchValue = HtmlDecode($this->CouncilSecretary->AdvancedSearch->SearchValue);
			$this->CouncilSecretary->EditValue = HtmlEncode($this->CouncilSecretary->AdvancedSearch->SearchValue);
			$this->CouncilSecretary->PlaceHolder = RemoveHtml($this->CouncilSecretary->caption());

			// CSDate
			$this->CSDate->EditAttrs["class"] = "form-control";
			$this->CSDate->EditCustomAttributes = "";
			$this->CSDate->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CSDate->AdvancedSearch->SearchValue, 0), 8));
			$this->CSDate->PlaceHolder = RemoveHtml($this->CSDate->caption());

			// MLGComments
			$this->MLGComments->EditAttrs["class"] = "form-control";
			$this->MLGComments->EditCustomAttributes = "";
			$this->MLGComments->EditValue = HtmlEncode($this->MLGComments->AdvancedSearch->SearchValue);
			$this->MLGComments->PlaceHolder = RemoveHtml($this->MLGComments->caption());

			// ContractType
			$this->ContractType->EditAttrs["class"] = "form-control";
			$this->ContractType->EditCustomAttributes = "";
			$this->ContractType->EditValue = HtmlEncode($this->ContractType->AdvancedSearch->SearchValue);
			$this->ContractType->PlaceHolder = RemoveHtml($this->ContractType->caption());
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
		if (!CheckInteger($this->IPCNo->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->IPCNo->errorMessage());
		}
		if (!CheckDate($this->PerformanceBondValidUntil->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->PerformanceBondValidUntil->errorMessage());
		}
		if (!CheckDate($this->AdvancePaymentBondValidUntil->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->AdvancePaymentBondValidUntil->errorMessage());
		}
		if (!CheckDate($this->DateOfSiteInspection->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DateOfSiteInspection->errorMessage());
		}
		if (!CheckDate($this->DeskOfficerDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->DeskOfficerDate->errorMessage());
		}
		if (!CheckDate($this->EngineerDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->EngineerDate->errorMessage());
		}
		if (!CheckDate($this->CSDate->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->CSDate->errorMessage());
		}
		if (!CheckInteger($this->ContractType->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ContractType->errorMessage());
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
		$this->IPCNo->AdvancedSearch->load();
		$this->ContractNo->AdvancedSearch->load();
		$this->ContractAuthorizedByAG->AdvancedSearch->load();
		$this->VATApplied->AdvancedSearch->load();
		$this->ArithmeticCheckDone->AdvancedSearch->load();
		$this->VariationsApproved->AdvancedSearch->load();
		$this->PerformanceBondValidUntil->AdvancedSearch->load();
		$this->AdvancePaymentBondValidUntil->AdvancedSearch->load();
		$this->RetentionDeductionClause->AdvancedSearch->load();
		$this->RetentionDeducted->AdvancedSearch->load();
		$this->LiquidatedDamagesDeducted->AdvancedSearch->load();
		$this->LiquidatedPenaltiesDeducted->AdvancedSearch->load();
		$this->AdvancedPaymentDeducted->AdvancedSearch->load();
		$this->CurrentProgressReportAttached->AdvancedSearch->load();
		$this->DateOfSiteInspection->AdvancedSearch->load();
		$this->TimeExtensionAuthorized->AdvancedSearch->load();
		$this->LabResultsChecked->AdvancedSearch->load();
		$this->TerminationNoticeGiven->AdvancedSearch->load();
		$this->CopiesEmailedToMLG->AdvancedSearch->load();
		$this->ContractStillValid->AdvancedSearch->load();
		$this->DeskOfficer->AdvancedSearch->load();
		$this->DeskOfficerDate->AdvancedSearch->load();
		$this->SupervisingEngineer->AdvancedSearch->load();
		$this->EngineerDate->AdvancedSearch->load();
		$this->CouncilSecretary->AdvancedSearch->load();
		$this->CSDate->AdvancedSearch->load();
		$this->MLGComments->AdvancedSearch->load();
		$this->ContractType->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ipc_trackinglist.php"), "", $this->TableVar, TRUE);
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
				case "x_ContractAuthorizedByAG":
					break;
				case "x_VATApplied":
					break;
				case "x_ArithmeticCheckDone":
					break;
				case "x_VariationsApproved":
					break;
				case "x_RetentionDeducted":
					break;
				case "x_LiquidatedDamagesDeducted":
					break;
				case "x_LiquidatedPenaltiesDeducted":
					break;
				case "x_AdvancedPaymentDeducted":
					break;
				case "x_CurrentProgressReportAttached":
					break;
				case "x_TimeExtensionAuthorized":
					break;
				case "x_LabResultsChecked":
					break;
				case "x_TerminationNoticeGiven":
					break;
				case "x_CopiesEmailedToMLG":
					break;
				case "x_ContractStillValid":
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