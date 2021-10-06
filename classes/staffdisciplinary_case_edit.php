<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staffdisciplinary_case_edit extends staffdisciplinary_case
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staffdisciplinary_case';

	// Page object name
	public $PageObjName = "staffdisciplinary_case_edit";

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

		// Table object (staffdisciplinary_case)
		if (!isset($GLOBALS["staffdisciplinary_case"]) || get_class($GLOBALS["staffdisciplinary_case"]) == PROJECT_NAMESPACE . "staffdisciplinary_case") {
			$GLOBALS["staffdisciplinary_case"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["staffdisciplinary_case"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (staff)
		if (!isset($GLOBALS['staff']))
			$GLOBALS['staff'] = new staff();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staffdisciplinary_case');

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
		global $staffdisciplinary_case;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staffdisciplinary_case);
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
					if ($pageName == "staffdisciplinary_caseview.php")
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
			$key .= @$ar['CaseNo'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['OffenseCode'];
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
			$this->CaseNo->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecords = 1;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecordCount;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("staffdisciplinary_caselist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->CaseNo->setVisibility();
		$this->OffenseCode->setVisibility();
		$this->CaseDescription->setVisibility();
		$this->ActionTaken->setVisibility();
		$this->OffenseDate->setVisibility();
		$this->ActionDate->setVisibility();
		$this->PenaltyQuantity->Visible = FALSE;
		$this->UnitOfMeasure->Visible = FALSE;
		$this->DateOfAppealLetter->setVisibility();
		$this->DateAppealReceived->setVisibility();
		$this->DateConcluded->setVisibility();
		$this->AppealStatus->setVisibility();
		$this->DiciplinaryHearing->setVisibility();
		$this->AppealNotes->setVisibility();
		$this->LastUpdate->Visible = FALSE;
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
		$this->setupLookupOptions($this->OffenseCode);
		$this->setupLookupOptions($this->ActionTaken);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->AppealStatus);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("staffdisciplinary_caselist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("EmployeeID") !== NULL) {
				$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
				$this->EmployeeID->setOldValue($this->EmployeeID->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->EmployeeID->setQueryStringValue(Key(0));
				$this->EmployeeID->setOldValue($this->EmployeeID->QueryStringValue);
			} elseif (Post("EmployeeID") !== NULL) {
				$this->EmployeeID->setFormValue(Post("EmployeeID"));
				$this->EmployeeID->setOldValue($this->EmployeeID->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->EmployeeID->setQueryStringValue(Route(2));
				$this->EmployeeID->setOldValue($this->EmployeeID->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}
			if (Get("CaseNo") !== NULL) {
				$this->CaseNo->setQueryStringValue(Get("CaseNo"));
				$this->CaseNo->setOldValue($this->CaseNo->QueryStringValue);
			} elseif (Key(1) !== NULL) {
				$this->CaseNo->setQueryStringValue(Key(1));
				$this->CaseNo->setOldValue($this->CaseNo->QueryStringValue);
			} elseif (Post("CaseNo") !== NULL) {
				$this->CaseNo->setFormValue(Post("CaseNo"));
				$this->CaseNo->setOldValue($this->CaseNo->FormValue);
			} elseif (Route(3) !== NULL) {
				$this->CaseNo->setQueryStringValue(Route(3));
				$this->CaseNo->setOldValue($this->CaseNo->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}
			if (Get("OffenseCode") !== NULL) {
				$this->OffenseCode->setQueryStringValue(Get("OffenseCode"));
				$this->OffenseCode->setOldValue($this->OffenseCode->QueryStringValue);
			} elseif (Key(2) !== NULL) {
				$this->OffenseCode->setQueryStringValue(Key(2));
				$this->OffenseCode->setOldValue($this->OffenseCode->QueryStringValue);
			} elseif (Post("OffenseCode") !== NULL) {
				$this->OffenseCode->setFormValue(Post("OffenseCode"));
				$this->OffenseCode->setOldValue($this->OffenseCode->FormValue);
			} elseif (Route(4) !== NULL) {
				$this->OffenseCode->setQueryStringValue(Route(4));
				$this->OffenseCode->setOldValue($this->OffenseCode->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_EmployeeID")) {
					$this->EmployeeID->setFormValue($CurrentForm->getValue("x_EmployeeID"));
				}
				if ($CurrentForm->hasValue("x_CaseNo")) {
					$this->CaseNo->setFormValue($CurrentForm->getValue("x_CaseNo"));
				}
				if ($CurrentForm->hasValue("x_OffenseCode")) {
					$this->OffenseCode->setFormValue($CurrentForm->getValue("x_OffenseCode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("EmployeeID") !== NULL) {
					$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->EmployeeID->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->EmployeeID->CurrentValue = NULL;
				}
				if (Get("CaseNo") !== NULL) {
					$this->CaseNo->setQueryStringValue(Get("CaseNo"));
					$loadByQuery = TRUE;
				} elseif (Route(3) !== NULL) {
					$this->CaseNo->setQueryStringValue(Route(3));
					$loadByQuery = TRUE;
				} else {
					$this->CaseNo->CurrentValue = NULL;
				}
				if (Get("OffenseCode") !== NULL) {
					$this->OffenseCode->setQueryStringValue(Get("OffenseCode"));
					$loadByQuery = TRUE;
				} elseif (Route(4) !== NULL) {
					$this->OffenseCode->setQueryStringValue(Route(4));
					$loadByQuery = TRUE;
				} else {
					$this->OffenseCode->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("staffdisciplinary_caselist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->EmployeeID->CurrentValue != NULL && $this->CaseNo->CurrentValue != NULL && $this->OffenseCode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->EmployeeID->CurrentValue, $rs->fields('EmployeeID')) && SameString($this->CaseNo->CurrentValue, $rs->fields('CaseNo')) && SameString($this->OffenseCode->CurrentValue, $rs->fields('OffenseCode'))) {
							$this->setStartRecordNumber($this->StartRecord); // Save record position
							$loaded = TRUE;
							break;
						} else {
							$this->StartRecord++;
							$rs->moveNext();
						}
					}
				}
			}

			// Load current row values
			if ($loaded)
				$this->loadRowValues($rs);
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("staffdisciplinary_caselist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "staffdisciplinary_caselist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_EmployeeID"))
			$this->EmployeeID->setOldValue($CurrentForm->getValue("o_EmployeeID"));

		// Check field name 'CaseNo' first before field var 'x_CaseNo'
		$val = $CurrentForm->hasValue("CaseNo") ? $CurrentForm->getValue("CaseNo") : $CurrentForm->getValue("x_CaseNo");
		if (!$this->CaseNo->IsDetailKey)
			$this->CaseNo->setFormValue($val);

		// Check field name 'OffenseCode' first before field var 'x_OffenseCode'
		$val = $CurrentForm->hasValue("OffenseCode") ? $CurrentForm->getValue("OffenseCode") : $CurrentForm->getValue("x_OffenseCode");
		if (!$this->OffenseCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OffenseCode->Visible = FALSE; // Disable update for API request
			else
				$this->OffenseCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_OffenseCode"))
			$this->OffenseCode->setOldValue($CurrentForm->getValue("o_OffenseCode"));

		// Check field name 'CaseDescription' first before field var 'x_CaseDescription'
		$val = $CurrentForm->hasValue("CaseDescription") ? $CurrentForm->getValue("CaseDescription") : $CurrentForm->getValue("x_CaseDescription");
		if (!$this->CaseDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CaseDescription->Visible = FALSE; // Disable update for API request
			else
				$this->CaseDescription->setFormValue($val);
		}

		// Check field name 'ActionTaken' first before field var 'x_ActionTaken'
		$val = $CurrentForm->hasValue("ActionTaken") ? $CurrentForm->getValue("ActionTaken") : $CurrentForm->getValue("x_ActionTaken");
		if (!$this->ActionTaken->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionTaken->Visible = FALSE; // Disable update for API request
			else
				$this->ActionTaken->setFormValue($val);
		}

		// Check field name 'OffenseDate' first before field var 'x_OffenseDate'
		$val = $CurrentForm->hasValue("OffenseDate") ? $CurrentForm->getValue("OffenseDate") : $CurrentForm->getValue("x_OffenseDate");
		if (!$this->OffenseDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OffenseDate->Visible = FALSE; // Disable update for API request
			else
				$this->OffenseDate->setFormValue($val);
			$this->OffenseDate->CurrentValue = UnFormatDateTime($this->OffenseDate->CurrentValue, 0);
		}

		// Check field name 'ActionDate' first before field var 'x_ActionDate'
		$val = $CurrentForm->hasValue("ActionDate") ? $CurrentForm->getValue("ActionDate") : $CurrentForm->getValue("x_ActionDate");
		if (!$this->ActionDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActionDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActionDate->setFormValue($val);
			$this->ActionDate->CurrentValue = UnFormatDateTime($this->ActionDate->CurrentValue, 0);
		}

		// Check field name 'DateOfAppealLetter' first before field var 'x_DateOfAppealLetter'
		$val = $CurrentForm->hasValue("DateOfAppealLetter") ? $CurrentForm->getValue("DateOfAppealLetter") : $CurrentForm->getValue("x_DateOfAppealLetter");
		if (!$this->DateOfAppealLetter->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfAppealLetter->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfAppealLetter->setFormValue($val);
			$this->DateOfAppealLetter->CurrentValue = UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0);
		}

		// Check field name 'DateAppealReceived' first before field var 'x_DateAppealReceived'
		$val = $CurrentForm->hasValue("DateAppealReceived") ? $CurrentForm->getValue("DateAppealReceived") : $CurrentForm->getValue("x_DateAppealReceived");
		if (!$this->DateAppealReceived->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateAppealReceived->Visible = FALSE; // Disable update for API request
			else
				$this->DateAppealReceived->setFormValue($val);
			$this->DateAppealReceived->CurrentValue = UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0);
		}

		// Check field name 'DateConcluded' first before field var 'x_DateConcluded'
		$val = $CurrentForm->hasValue("DateConcluded") ? $CurrentForm->getValue("DateConcluded") : $CurrentForm->getValue("x_DateConcluded");
		if (!$this->DateConcluded->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateConcluded->Visible = FALSE; // Disable update for API request
			else
				$this->DateConcluded->setFormValue($val);
			$this->DateConcluded->CurrentValue = UnFormatDateTime($this->DateConcluded->CurrentValue, 0);
		}

		// Check field name 'AppealStatus' first before field var 'x_AppealStatus'
		$val = $CurrentForm->hasValue("AppealStatus") ? $CurrentForm->getValue("AppealStatus") : $CurrentForm->getValue("x_AppealStatus");
		if (!$this->AppealStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AppealStatus->Visible = FALSE; // Disable update for API request
			else
				$this->AppealStatus->setFormValue($val);
		}

		// Check field name 'DiciplinaryHearing' first before field var 'x_DiciplinaryHearing'
		$val = $CurrentForm->hasValue("DiciplinaryHearing") ? $CurrentForm->getValue("DiciplinaryHearing") : $CurrentForm->getValue("x_DiciplinaryHearing");
		if (!$this->DiciplinaryHearing->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DiciplinaryHearing->Visible = FALSE; // Disable update for API request
			else
				$this->DiciplinaryHearing->setFormValue($val);
		}

		// Check field name 'AppealNotes' first before field var 'x_AppealNotes'
		$val = $CurrentForm->hasValue("AppealNotes") ? $CurrentForm->getValue("AppealNotes") : $CurrentForm->getValue("x_AppealNotes");
		if (!$this->AppealNotes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AppealNotes->Visible = FALSE; // Disable update for API request
			else
				$this->AppealNotes->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->CaseNo->CurrentValue = $this->CaseNo->FormValue;
		$this->OffenseCode->CurrentValue = $this->OffenseCode->FormValue;
		$this->CaseDescription->CurrentValue = $this->CaseDescription->FormValue;
		$this->ActionTaken->CurrentValue = $this->ActionTaken->FormValue;
		$this->OffenseDate->CurrentValue = $this->OffenseDate->FormValue;
		$this->OffenseDate->CurrentValue = UnFormatDateTime($this->OffenseDate->CurrentValue, 0);
		$this->ActionDate->CurrentValue = $this->ActionDate->FormValue;
		$this->ActionDate->CurrentValue = UnFormatDateTime($this->ActionDate->CurrentValue, 0);
		$this->DateOfAppealLetter->CurrentValue = $this->DateOfAppealLetter->FormValue;
		$this->DateOfAppealLetter->CurrentValue = UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0);
		$this->DateAppealReceived->CurrentValue = $this->DateAppealReceived->FormValue;
		$this->DateAppealReceived->CurrentValue = UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0);
		$this->DateConcluded->CurrentValue = $this->DateConcluded->FormValue;
		$this->DateConcluded->CurrentValue = UnFormatDateTime($this->DateConcluded->CurrentValue, 0);
		$this->AppealStatus->CurrentValue = $this->AppealStatus->FormValue;
		$this->DiciplinaryHearing->CurrentValue = $this->DiciplinaryHearing->FormValue;
		$this->AppealNotes->CurrentValue = $this->AppealNotes->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->CaseNo->setDbValue($row['CaseNo']);
		$this->OffenseCode->setDbValue($row['OffenseCode']);
		$this->CaseDescription->setDbValue($row['CaseDescription']);
		$this->ActionTaken->setDbValue($row['ActionTaken']);
		$this->OffenseDate->setDbValue($row['OffenseDate']);
		$this->ActionDate->setDbValue($row['ActionDate']);
		$this->PenaltyQuantity->setDbValue($row['PenaltyQuantity']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->DateOfAppealLetter->setDbValue($row['DateOfAppealLetter']);
		$this->DateAppealReceived->setDbValue($row['DateAppealReceived']);
		$this->DateConcluded->setDbValue($row['DateConcluded']);
		$this->AppealStatus->setDbValue($row['AppealStatus']);
		$this->DiciplinaryHearing->setDbValue($row['DiciplinaryHearing']);
		$this->AppealNotes->setDbValue($row['AppealNotes']);
		$this->LastUpdate->setDbValue($row['LastUpdate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['CaseNo'] = NULL;
		$row['OffenseCode'] = NULL;
		$row['CaseDescription'] = NULL;
		$row['ActionTaken'] = NULL;
		$row['OffenseDate'] = NULL;
		$row['ActionDate'] = NULL;
		$row['PenaltyQuantity'] = NULL;
		$row['UnitOfMeasure'] = NULL;
		$row['DateOfAppealLetter'] = NULL;
		$row['DateAppealReceived'] = NULL;
		$row['DateConcluded'] = NULL;
		$row['AppealStatus'] = NULL;
		$row['DiciplinaryHearing'] = NULL;
		$row['AppealNotes'] = NULL;
		$row['LastUpdate'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("EmployeeID")) != "")
			$this->EmployeeID->OldValue = $this->getKey("EmployeeID"); // EmployeeID
		else
			$validKey = FALSE;
		if (strval($this->getKey("CaseNo")) != "")
			$this->CaseNo->OldValue = $this->getKey("CaseNo"); // CaseNo
		else
			$validKey = FALSE;
		if (strval($this->getKey("OffenseCode")) != "")
			$this->OffenseCode->OldValue = $this->getKey("OffenseCode"); // OffenseCode
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
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
		// CaseNo
		// OffenseCode
		// CaseDescription
		// ActionTaken
		// OffenseDate
		// ActionDate
		// PenaltyQuantity
		// UnitOfMeasure
		// DateOfAppealLetter
		// DateAppealReceived
		// DateConcluded
		// AppealStatus
		// DiciplinaryHearing
		// AppealNotes
		// LastUpdate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// CaseNo
			$this->CaseNo->ViewValue = $this->CaseNo->CurrentValue;
			$this->CaseNo->ViewCustomAttributes = "";

			// OffenseCode
			$curVal = strval($this->OffenseCode->CurrentValue);
			if ($curVal != "") {
				$this->OffenseCode->ViewValue = $this->OffenseCode->lookupCacheOption($curVal);
				if ($this->OffenseCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OffenseCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OffenseCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->OffenseCode->ViewValue = $this->OffenseCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OffenseCode->ViewValue = $this->OffenseCode->CurrentValue;
					}
				}
			} else {
				$this->OffenseCode->ViewValue = NULL;
			}
			$this->OffenseCode->ViewCustomAttributes = "";

			// CaseDescription
			$this->CaseDescription->ViewValue = $this->CaseDescription->CurrentValue;
			$this->CaseDescription->ViewCustomAttributes = "";

			// ActionTaken
			$curVal = strval($this->ActionTaken->CurrentValue);
			if ($curVal != "") {
				$this->ActionTaken->ViewValue = $this->ActionTaken->lookupCacheOption($curVal);
				if ($this->ActionTaken->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ActionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ActionTaken->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ActionTaken->ViewValue = $this->ActionTaken->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ActionTaken->ViewValue = $this->ActionTaken->CurrentValue;
					}
				}
			} else {
				$this->ActionTaken->ViewValue = NULL;
			}
			$this->ActionTaken->ViewCustomAttributes = "";

			// OffenseDate
			$this->OffenseDate->ViewValue = $this->OffenseDate->CurrentValue;
			$this->OffenseDate->ViewValue = FormatDateTime($this->OffenseDate->ViewValue, 0);
			$this->OffenseDate->ViewCustomAttributes = "";

			// ActionDate
			$this->ActionDate->ViewValue = $this->ActionDate->CurrentValue;
			$this->ActionDate->ViewValue = FormatDateTime($this->ActionDate->ViewValue, 0);
			$this->ActionDate->ViewCustomAttributes = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->ViewValue = $this->DateOfAppealLetter->CurrentValue;
			$this->DateOfAppealLetter->ViewValue = FormatDateTime($this->DateOfAppealLetter->ViewValue, 0);
			$this->DateOfAppealLetter->ViewCustomAttributes = "";

			// DateAppealReceived
			$this->DateAppealReceived->ViewValue = $this->DateAppealReceived->CurrentValue;
			$this->DateAppealReceived->ViewValue = FormatDateTime($this->DateAppealReceived->ViewValue, 0);
			$this->DateAppealReceived->ViewCustomAttributes = "";

			// DateConcluded
			$this->DateConcluded->ViewValue = $this->DateConcluded->CurrentValue;
			$this->DateConcluded->ViewValue = FormatDateTime($this->DateConcluded->ViewValue, 0);
			$this->DateConcluded->ViewCustomAttributes = "";

			// AppealStatus
			$curVal = strval($this->AppealStatus->CurrentValue);
			if ($curVal != "") {
				$this->AppealStatus->ViewValue = $this->AppealStatus->lookupCacheOption($curVal);
				if ($this->AppealStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AppealStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AppealStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AppealStatus->ViewValue = $this->AppealStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AppealStatus->ViewValue = $this->AppealStatus->CurrentValue;
					}
				}
			} else {
				$this->AppealStatus->ViewValue = NULL;
			}
			$this->AppealStatus->ViewCustomAttributes = "";

			// DiciplinaryHearing
			$this->DiciplinaryHearing->ViewValue = $this->DiciplinaryHearing->CurrentValue;
			$this->DiciplinaryHearing->ViewCustomAttributes = "";

			// AppealNotes
			$this->AppealNotes->ViewValue = $this->AppealNotes->CurrentValue;
			$this->AppealNotes->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// CaseNo
			$this->CaseNo->LinkCustomAttributes = "";
			$this->CaseNo->HrefValue = "";
			$this->CaseNo->TooltipValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";
			$this->OffenseCode->TooltipValue = "";

			// CaseDescription
			$this->CaseDescription->LinkCustomAttributes = "";
			$this->CaseDescription->HrefValue = "";
			$this->CaseDescription->TooltipValue = "";

			// ActionTaken
			$this->ActionTaken->LinkCustomAttributes = "";
			$this->ActionTaken->HrefValue = "";
			$this->ActionTaken->TooltipValue = "";

			// OffenseDate
			$this->OffenseDate->LinkCustomAttributes = "";
			$this->OffenseDate->HrefValue = "";
			$this->OffenseDate->TooltipValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";
			$this->ActionDate->TooltipValue = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->LinkCustomAttributes = "";
			$this->DateOfAppealLetter->HrefValue = "";
			$this->DateOfAppealLetter->TooltipValue = "";

			// DateAppealReceived
			$this->DateAppealReceived->LinkCustomAttributes = "";
			$this->DateAppealReceived->HrefValue = "";
			$this->DateAppealReceived->TooltipValue = "";

			// DateConcluded
			$this->DateConcluded->LinkCustomAttributes = "";
			$this->DateConcluded->HrefValue = "";
			$this->DateConcluded->TooltipValue = "";

			// AppealStatus
			$this->AppealStatus->LinkCustomAttributes = "";
			$this->AppealStatus->HrefValue = "";
			$this->AppealStatus->TooltipValue = "";

			// DiciplinaryHearing
			$this->DiciplinaryHearing->LinkCustomAttributes = "";
			$this->DiciplinaryHearing->HrefValue = "";
			$this->DiciplinaryHearing->TooltipValue = "";

			// AppealNotes
			$this->AppealNotes->LinkCustomAttributes = "";
			$this->AppealNotes->HrefValue = "";
			$this->AppealNotes->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// CaseNo
			$this->CaseNo->EditAttrs["class"] = "form-control";
			$this->CaseNo->EditCustomAttributes = "";
			$this->CaseNo->EditValue = $this->CaseNo->CurrentValue;
			$this->CaseNo->ViewCustomAttributes = "";

			// OffenseCode
			$this->OffenseCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->OffenseCode->CurrentValue));
			if ($curVal != "")
				$this->OffenseCode->ViewValue = $this->OffenseCode->lookupCacheOption($curVal);
			else
				$this->OffenseCode->ViewValue = $this->OffenseCode->Lookup !== NULL && is_array($this->OffenseCode->Lookup->Options) ? $curVal : NULL;
			if ($this->OffenseCode->ViewValue !== NULL) { // Load from cache
				$this->OffenseCode->EditValue = array_values($this->OffenseCode->Lookup->Options);
				if ($this->OffenseCode->ViewValue == "")
					$this->OffenseCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OffenseCode`" . SearchString("=", $this->OffenseCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OffenseCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->OffenseCode->ViewValue = $this->OffenseCode->displayValue($arwrk);
				} else {
					$this->OffenseCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OffenseCode->EditValue = $arwrk;
			}

			// CaseDescription
			$this->CaseDescription->EditAttrs["class"] = "form-control";
			$this->CaseDescription->EditCustomAttributes = "";
			$this->CaseDescription->EditValue = HtmlEncode($this->CaseDescription->CurrentValue);
			$this->CaseDescription->PlaceHolder = RemoveHtml($this->CaseDescription->caption());

			// ActionTaken
			$this->ActionTaken->EditAttrs["class"] = "form-control";
			$this->ActionTaken->EditCustomAttributes = "";
			$curVal = trim(strval($this->ActionTaken->CurrentValue));
			if ($curVal != "")
				$this->ActionTaken->ViewValue = $this->ActionTaken->lookupCacheOption($curVal);
			else
				$this->ActionTaken->ViewValue = $this->ActionTaken->Lookup !== NULL && is_array($this->ActionTaken->Lookup->Options) ? $curVal : NULL;
			if ($this->ActionTaken->ViewValue !== NULL) { // Load from cache
				$this->ActionTaken->EditValue = array_values($this->ActionTaken->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ActionCode`" . SearchString("=", $this->ActionTaken->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ActionTaken->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ActionTaken->EditValue = $arwrk;
			}

			// OffenseDate
			$this->OffenseDate->EditAttrs["class"] = "form-control";
			$this->OffenseDate->EditCustomAttributes = "";
			$this->OffenseDate->EditValue = HtmlEncode(FormatDateTime($this->OffenseDate->CurrentValue, 8));
			$this->OffenseDate->PlaceHolder = RemoveHtml($this->OffenseDate->caption());

			// ActionDate
			$this->ActionDate->EditAttrs["class"] = "form-control";
			$this->ActionDate->EditCustomAttributes = "";
			$this->ActionDate->EditValue = HtmlEncode(FormatDateTime($this->ActionDate->CurrentValue, 8));
			$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

			// DateOfAppealLetter
			$this->DateOfAppealLetter->EditAttrs["class"] = "form-control";
			$this->DateOfAppealLetter->EditCustomAttributes = "";
			$this->DateOfAppealLetter->EditValue = HtmlEncode(FormatDateTime($this->DateOfAppealLetter->CurrentValue, 8));
			$this->DateOfAppealLetter->PlaceHolder = RemoveHtml($this->DateOfAppealLetter->caption());

			// DateAppealReceived
			$this->DateAppealReceived->EditAttrs["class"] = "form-control";
			$this->DateAppealReceived->EditCustomAttributes = "";
			$this->DateAppealReceived->EditValue = HtmlEncode(FormatDateTime($this->DateAppealReceived->CurrentValue, 8));
			$this->DateAppealReceived->PlaceHolder = RemoveHtml($this->DateAppealReceived->caption());

			// DateConcluded
			$this->DateConcluded->EditAttrs["class"] = "form-control";
			$this->DateConcluded->EditCustomAttributes = "";
			$this->DateConcluded->EditValue = HtmlEncode(FormatDateTime($this->DateConcluded->CurrentValue, 8));
			$this->DateConcluded->PlaceHolder = RemoveHtml($this->DateConcluded->caption());

			// AppealStatus
			$this->AppealStatus->EditAttrs["class"] = "form-control";
			$this->AppealStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AppealStatus->CurrentValue));
			if ($curVal != "")
				$this->AppealStatus->ViewValue = $this->AppealStatus->lookupCacheOption($curVal);
			else
				$this->AppealStatus->ViewValue = $this->AppealStatus->Lookup !== NULL && is_array($this->AppealStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AppealStatus->ViewValue !== NULL) { // Load from cache
				$this->AppealStatus->EditValue = array_values($this->AppealStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AppealStatusCode`" . SearchString("=", $this->AppealStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AppealStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AppealStatus->EditValue = $arwrk;
			}

			// DiciplinaryHearing
			$this->DiciplinaryHearing->EditAttrs["class"] = "form-control";
			$this->DiciplinaryHearing->EditCustomAttributes = "";
			$this->DiciplinaryHearing->EditValue = HtmlEncode($this->DiciplinaryHearing->CurrentValue);
			$this->DiciplinaryHearing->PlaceHolder = RemoveHtml($this->DiciplinaryHearing->caption());

			// AppealNotes
			$this->AppealNotes->EditAttrs["class"] = "form-control";
			$this->AppealNotes->EditCustomAttributes = "";
			$this->AppealNotes->EditValue = HtmlEncode($this->AppealNotes->CurrentValue);
			$this->AppealNotes->PlaceHolder = RemoveHtml($this->AppealNotes->caption());

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// CaseNo
			$this->CaseNo->LinkCustomAttributes = "";
			$this->CaseNo->HrefValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";

			// CaseDescription
			$this->CaseDescription->LinkCustomAttributes = "";
			$this->CaseDescription->HrefValue = "";

			// ActionTaken
			$this->ActionTaken->LinkCustomAttributes = "";
			$this->ActionTaken->HrefValue = "";

			// OffenseDate
			$this->OffenseDate->LinkCustomAttributes = "";
			$this->OffenseDate->HrefValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";

			// DateOfAppealLetter
			$this->DateOfAppealLetter->LinkCustomAttributes = "";
			$this->DateOfAppealLetter->HrefValue = "";

			// DateAppealReceived
			$this->DateAppealReceived->LinkCustomAttributes = "";
			$this->DateAppealReceived->HrefValue = "";

			// DateConcluded
			$this->DateConcluded->LinkCustomAttributes = "";
			$this->DateConcluded->HrefValue = "";

			// AppealStatus
			$this->AppealStatus->LinkCustomAttributes = "";
			$this->AppealStatus->HrefValue = "";

			// DiciplinaryHearing
			$this->DiciplinaryHearing->LinkCustomAttributes = "";
			$this->DiciplinaryHearing->HrefValue = "";

			// AppealNotes
			$this->AppealNotes->LinkCustomAttributes = "";
			$this->AppealNotes->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->CaseNo->Required) {
			if (!$this->CaseNo->IsDetailKey && $this->CaseNo->FormValue != NULL && $this->CaseNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CaseNo->caption(), $this->CaseNo->RequiredErrorMessage));
			}
		}
		if ($this->OffenseCode->Required) {
			if ($this->OffenseCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OffenseCode->caption(), $this->OffenseCode->RequiredErrorMessage));
			}
		}
		if ($this->CaseDescription->Required) {
			if (!$this->CaseDescription->IsDetailKey && $this->CaseDescription->FormValue != NULL && $this->CaseDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CaseDescription->caption(), $this->CaseDescription->RequiredErrorMessage));
			}
		}
		if ($this->ActionTaken->Required) {
			if (!$this->ActionTaken->IsDetailKey && $this->ActionTaken->FormValue != NULL && $this->ActionTaken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionTaken->caption(), $this->ActionTaken->RequiredErrorMessage));
			}
		}
		if ($this->OffenseDate->Required) {
			if (!$this->OffenseDate->IsDetailKey && $this->OffenseDate->FormValue != NULL && $this->OffenseDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OffenseDate->caption(), $this->OffenseDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->OffenseDate->FormValue)) {
			AddMessage($FormError, $this->OffenseDate->errorMessage());
		}
		if ($this->ActionDate->Required) {
			if (!$this->ActionDate->IsDetailKey && $this->ActionDate->FormValue != NULL && $this->ActionDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionDate->caption(), $this->ActionDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActionDate->FormValue)) {
			AddMessage($FormError, $this->ActionDate->errorMessage());
		}
		if ($this->DateOfAppealLetter->Required) {
			if (!$this->DateOfAppealLetter->IsDetailKey && $this->DateOfAppealLetter->FormValue != NULL && $this->DateOfAppealLetter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfAppealLetter->caption(), $this->DateOfAppealLetter->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfAppealLetter->FormValue)) {
			AddMessage($FormError, $this->DateOfAppealLetter->errorMessage());
		}
		if ($this->DateAppealReceived->Required) {
			if (!$this->DateAppealReceived->IsDetailKey && $this->DateAppealReceived->FormValue != NULL && $this->DateAppealReceived->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateAppealReceived->caption(), $this->DateAppealReceived->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateAppealReceived->FormValue)) {
			AddMessage($FormError, $this->DateAppealReceived->errorMessage());
		}
		if ($this->DateConcluded->Required) {
			if (!$this->DateConcluded->IsDetailKey && $this->DateConcluded->FormValue != NULL && $this->DateConcluded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateConcluded->caption(), $this->DateConcluded->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateConcluded->FormValue)) {
			AddMessage($FormError, $this->DateConcluded->errorMessage());
		}
		if ($this->AppealStatus->Required) {
			if (!$this->AppealStatus->IsDetailKey && $this->AppealStatus->FormValue != NULL && $this->AppealStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AppealStatus->caption(), $this->AppealStatus->RequiredErrorMessage));
			}
		}
		if ($this->DiciplinaryHearing->Required) {
			if (!$this->DiciplinaryHearing->IsDetailKey && $this->DiciplinaryHearing->FormValue != NULL && $this->DiciplinaryHearing->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DiciplinaryHearing->caption(), $this->DiciplinaryHearing->RequiredErrorMessage));
			}
		}
		if ($this->AppealNotes->Required) {
			if (!$this->AppealNotes->IsDetailKey && $this->AppealNotes->FormValue != NULL && $this->AppealNotes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AppealNotes->caption(), $this->AppealNotes->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("staffdisciplinary_appeal", $detailTblVar) && $GLOBALS["staffdisciplinary_appeal"]->DetailEdit) {
			if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
				$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid(); // Get detail page object
			$GLOBALS["staffdisciplinary_appeal_grid"]->validateGridForm();
		}
		if (in_array("staffdisciplinary_action", $detailTblVar) && $GLOBALS["staffdisciplinary_action"]->DetailEdit) {
			if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
				$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid(); // Get detail page object
			$GLOBALS["staffdisciplinary_action_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// EmployeeID
			$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, $this->EmployeeID->ReadOnly);

			// OffenseCode
			$this->OffenseCode->setDbValueDef($rsnew, $this->OffenseCode->CurrentValue, 0, $this->OffenseCode->ReadOnly);

			// CaseDescription
			$this->CaseDescription->setDbValueDef($rsnew, $this->CaseDescription->CurrentValue, NULL, $this->CaseDescription->ReadOnly);

			// ActionTaken
			$this->ActionTaken->setDbValueDef($rsnew, $this->ActionTaken->CurrentValue, NULL, $this->ActionTaken->ReadOnly);

			// OffenseDate
			$this->OffenseDate->setDbValueDef($rsnew, UnFormatDateTime($this->OffenseDate->CurrentValue, 0), CurrentDate(), $this->OffenseDate->ReadOnly);

			// ActionDate
			$this->ActionDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActionDate->CurrentValue, 0), NULL, $this->ActionDate->ReadOnly);

			// DateOfAppealLetter
			$this->DateOfAppealLetter->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0), NULL, $this->DateOfAppealLetter->ReadOnly);

			// DateAppealReceived
			$this->DateAppealReceived->setDbValueDef($rsnew, UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0), NULL, $this->DateAppealReceived->ReadOnly);

			// DateConcluded
			$this->DateConcluded->setDbValueDef($rsnew, UnFormatDateTime($this->DateConcluded->CurrentValue, 0), NULL, $this->DateConcluded->ReadOnly);

			// AppealStatus
			$this->AppealStatus->setDbValueDef($rsnew, $this->AppealStatus->CurrentValue, NULL, $this->AppealStatus->ReadOnly);

			// DiciplinaryHearing
			$this->DiciplinaryHearing->setDbValueDef($rsnew, $this->DiciplinaryHearing->CurrentValue, NULL, $this->DiciplinaryHearing->ReadOnly);

			// AppealNotes
			$this->AppealNotes->setDbValueDef($rsnew, $this->AppealNotes->CurrentValue, NULL, $this->AppealNotes->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("staffdisciplinary_appeal", $detailTblVar) && $GLOBALS["staffdisciplinary_appeal"]->DetailEdit) {
						if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
							$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffdisciplinary_appeal"); // Load user level of detail table
						$editRow = $GLOBALS["staffdisciplinary_appeal_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("staffdisciplinary_action", $detailTblVar) && $GLOBALS["staffdisciplinary_action"]->DetailEdit) {
						if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
							$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "staffdisciplinary_action"); // Load user level of detail table
						$editRow = $GLOBALS["staffdisciplinary_action_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "staff") {
				$validMaster = TRUE;
				if (($parm = Get("fk_EmployeeID", Get("EmployeeID"))) !== NULL) {
					$GLOBALS["staff"]->EmployeeID->setQueryStringValue($parm);
					$this->EmployeeID->setQueryStringValue($GLOBALS["staff"]->EmployeeID->QueryStringValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->QueryStringValue);
					if (!is_numeric($GLOBALS["staff"]->EmployeeID->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "staff") {
				$validMaster = TRUE;
				if (($parm = Post("fk_EmployeeID", Post("EmployeeID"))) !== NULL) {
					$GLOBALS["staff"]->EmployeeID->setFormValue($parm);
					$this->EmployeeID->setFormValue($GLOBALS["staff"]->EmployeeID->FormValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->FormValue);
					if (!is_numeric($GLOBALS["staff"]->EmployeeID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "staff") {
				if ($this->EmployeeID->CurrentValue == "")
					$this->EmployeeID->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("staffdisciplinary_appeal", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
					$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
				if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailEdit) {
					$GLOBALS["staffdisciplinary_appeal_grid"]->CurrentMode = "edit";
					$GLOBALS["staffdisciplinary_appeal_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_appeal_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_appeal_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["staffdisciplinary_appeal_grid"]->CaseNo->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_appeal_grid"]->CaseNo->CurrentValue = $this->CaseNo->CurrentValue;
					$GLOBALS["staffdisciplinary_appeal_grid"]->CaseNo->setSessionValue($GLOBALS["staffdisciplinary_appeal_grid"]->CaseNo->CurrentValue);
					$GLOBALS["staffdisciplinary_appeal_grid"]->OffenseCode->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_appeal_grid"]->OffenseCode->CurrentValue = $this->OffenseCode->CurrentValue;
					$GLOBALS["staffdisciplinary_appeal_grid"]->OffenseCode->setSessionValue($GLOBALS["staffdisciplinary_appeal_grid"]->OffenseCode->CurrentValue);
				}
			}
			if (in_array("staffdisciplinary_action", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
					$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
				if ($GLOBALS["staffdisciplinary_action_grid"]->DetailEdit) {
					$GLOBALS["staffdisciplinary_action_grid"]->CurrentMode = "edit";
					$GLOBALS["staffdisciplinary_action_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_action_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_action_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["staffdisciplinary_action_grid"]->CaseNo->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_action_grid"]->CaseNo->CurrentValue = $this->CaseNo->CurrentValue;
					$GLOBALS["staffdisciplinary_action_grid"]->CaseNo->setSessionValue($GLOBALS["staffdisciplinary_action_grid"]->CaseNo->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("staffdisciplinary_caselist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_OffenseCode":
					break;
				case "x_ActionTaken":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_AppealStatus":
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
						case "x_OffenseCode":
							break;
						case "x_ActionTaken":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_AppealStatus":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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