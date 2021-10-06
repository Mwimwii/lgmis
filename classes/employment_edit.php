<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class employment_edit extends employment
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'employment';

	// Page object name
	public $PageObjName = "employment_edit";

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

		// Table object (employment)
		if (!isset($GLOBALS["employment"]) || get_class($GLOBALS["employment"]) == PROJECT_NAMESPACE . "employment") {
			$GLOBALS["employment"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["employment"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (position_ref)
		if (!isset($GLOBALS['position_ref']))
			$GLOBALS['position_ref'] = new position_ref();

		// Table object (staff)
		if (!isset($GLOBALS['staff']))
			$GLOBALS['staff'] = new staff();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'employment');

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
		global $employment;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($employment);
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
					if ($pageName == "employmentview.php")
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
			$key .= @$ar['SubstantivePosition'];
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
					$this->terminate(GetUrl("employmentlist.php"));
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
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->SubstantivePosition->setVisibility();
		$this->DateOfCurrentAppointment->setVisibility();
		$this->LastAppraisalDate->setVisibility();
		$this->AppraisalStatus->setVisibility();
		$this->DateOfExit->setVisibility();
		$this->SalaryScale->setVisibility();
		$this->EmploymentType->setVisibility();
		$this->EmploymentStatus->setVisibility();
		$this->ExitReason->setVisibility();
		$this->RetirementType->setVisibility();
		$this->EmployeeNumber->setVisibility();
		$this->SalaryNotch->setVisibility();
		$this->BasicMonthlySalary->setVisibility();
		$this->ThirdParties->setVisibility();
		$this->PayrollCode->setVisibility();
		$this->DateOfConfirmation->setVisibility();
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
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);
		$this->setupLookupOptions($this->SubstantivePosition);
		$this->setupLookupOptions($this->AppraisalStatus);
		$this->setupLookupOptions($this->SalaryScale);
		$this->setupLookupOptions($this->EmploymentType);
		$this->setupLookupOptions($this->EmploymentStatus);
		$this->setupLookupOptions($this->ExitReason);
		$this->setupLookupOptions($this->RetirementType);
		$this->setupLookupOptions($this->SalaryNotch);
		$this->setupLookupOptions($this->ThirdParties);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("employmentlist.php");
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
			if (Get("SubstantivePosition") !== NULL) {
				$this->SubstantivePosition->setQueryStringValue(Get("SubstantivePosition"));
				$this->SubstantivePosition->setOldValue($this->SubstantivePosition->QueryStringValue);
			} elseif (Key(1) !== NULL) {
				$this->SubstantivePosition->setQueryStringValue(Key(1));
				$this->SubstantivePosition->setOldValue($this->SubstantivePosition->QueryStringValue);
			} elseif (Post("SubstantivePosition") !== NULL) {
				$this->SubstantivePosition->setFormValue(Post("SubstantivePosition"));
				$this->SubstantivePosition->setOldValue($this->SubstantivePosition->FormValue);
			} elseif (Route(3) !== NULL) {
				$this->SubstantivePosition->setQueryStringValue(Route(3));
				$this->SubstantivePosition->setOldValue($this->SubstantivePosition->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_SubstantivePosition")) {
					$this->SubstantivePosition->setFormValue($CurrentForm->getValue("x_SubstantivePosition"));
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
				if (Get("SubstantivePosition") !== NULL) {
					$this->SubstantivePosition->setQueryStringValue(Get("SubstantivePosition"));
					$loadByQuery = TRUE;
				} elseif (Route(3) !== NULL) {
					$this->SubstantivePosition->setQueryStringValue(Route(3));
					$loadByQuery = TRUE;
				} else {
					$this->SubstantivePosition->CurrentValue = NULL;
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
				$this->terminate("employmentlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->EmployeeID->CurrentValue != NULL && $this->SubstantivePosition->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->EmployeeID->CurrentValue, $rs->fields('EmployeeID')) && SameString($this->SubstantivePosition->CurrentValue, $rs->fields('SubstantivePosition'))) {
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
					$this->terminate("employmentlist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "employmentlist.php")
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

		// Check field name 'ProvinceCode' first before field var 'x_ProvinceCode'
		$val = $CurrentForm->hasValue("ProvinceCode") ? $CurrentForm->getValue("ProvinceCode") : $CurrentForm->getValue("x_ProvinceCode");
		if (!$this->ProvinceCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProvinceCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProvinceCode->setFormValue($val);
		}

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}

		// Check field name 'DepartmentCode' first before field var 'x_DepartmentCode'
		$val = $CurrentForm->hasValue("DepartmentCode") ? $CurrentForm->getValue("DepartmentCode") : $CurrentForm->getValue("x_DepartmentCode");
		if (!$this->DepartmentCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepartmentCode->Visible = FALSE; // Disable update for API request
			else
				$this->DepartmentCode->setFormValue($val);
		}

		// Check field name 'SectionCode' first before field var 'x_SectionCode'
		$val = $CurrentForm->hasValue("SectionCode") ? $CurrentForm->getValue("SectionCode") : $CurrentForm->getValue("x_SectionCode");
		if (!$this->SectionCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SectionCode->Visible = FALSE; // Disable update for API request
			else
				$this->SectionCode->setFormValue($val);
		}

		// Check field name 'SubstantivePosition' first before field var 'x_SubstantivePosition'
		$val = $CurrentForm->hasValue("SubstantivePosition") ? $CurrentForm->getValue("SubstantivePosition") : $CurrentForm->getValue("x_SubstantivePosition");
		if (!$this->SubstantivePosition->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SubstantivePosition->Visible = FALSE; // Disable update for API request
			else
				$this->SubstantivePosition->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_SubstantivePosition"))
			$this->SubstantivePosition->setOldValue($CurrentForm->getValue("o_SubstantivePosition"));

		// Check field name 'DateOfCurrentAppointment' first before field var 'x_DateOfCurrentAppointment'
		$val = $CurrentForm->hasValue("DateOfCurrentAppointment") ? $CurrentForm->getValue("DateOfCurrentAppointment") : $CurrentForm->getValue("x_DateOfCurrentAppointment");
		if (!$this->DateOfCurrentAppointment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfCurrentAppointment->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfCurrentAppointment->setFormValue($val);
			$this->DateOfCurrentAppointment->CurrentValue = UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0);
		}

		// Check field name 'LastAppraisalDate' first before field var 'x_LastAppraisalDate'
		$val = $CurrentForm->hasValue("LastAppraisalDate") ? $CurrentForm->getValue("LastAppraisalDate") : $CurrentForm->getValue("x_LastAppraisalDate");
		if (!$this->LastAppraisalDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastAppraisalDate->Visible = FALSE; // Disable update for API request
			else
				$this->LastAppraisalDate->setFormValue($val);
			$this->LastAppraisalDate->CurrentValue = UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0);
		}

		// Check field name 'AppraisalStatus' first before field var 'x_AppraisalStatus'
		$val = $CurrentForm->hasValue("AppraisalStatus") ? $CurrentForm->getValue("AppraisalStatus") : $CurrentForm->getValue("x_AppraisalStatus");
		if (!$this->AppraisalStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AppraisalStatus->Visible = FALSE; // Disable update for API request
			else
				$this->AppraisalStatus->setFormValue($val);
		}

		// Check field name 'DateOfExit' first before field var 'x_DateOfExit'
		$val = $CurrentForm->hasValue("DateOfExit") ? $CurrentForm->getValue("DateOfExit") : $CurrentForm->getValue("x_DateOfExit");
		if (!$this->DateOfExit->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfExit->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfExit->setFormValue($val);
			$this->DateOfExit->CurrentValue = UnFormatDateTime($this->DateOfExit->CurrentValue, 0);
		}

		// Check field name 'SalaryScale' first before field var 'x_SalaryScale'
		$val = $CurrentForm->hasValue("SalaryScale") ? $CurrentForm->getValue("SalaryScale") : $CurrentForm->getValue("x_SalaryScale");
		if (!$this->SalaryScale->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SalaryScale->Visible = FALSE; // Disable update for API request
			else
				$this->SalaryScale->setFormValue($val);
		}

		// Check field name 'EmploymentType' first before field var 'x_EmploymentType'
		$val = $CurrentForm->hasValue("EmploymentType") ? $CurrentForm->getValue("EmploymentType") : $CurrentForm->getValue("x_EmploymentType");
		if (!$this->EmploymentType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmploymentType->Visible = FALSE; // Disable update for API request
			else
				$this->EmploymentType->setFormValue($val);
		}

		// Check field name 'EmploymentStatus' first before field var 'x_EmploymentStatus'
		$val = $CurrentForm->hasValue("EmploymentStatus") ? $CurrentForm->getValue("EmploymentStatus") : $CurrentForm->getValue("x_EmploymentStatus");
		if (!$this->EmploymentStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmploymentStatus->Visible = FALSE; // Disable update for API request
			else
				$this->EmploymentStatus->setFormValue($val);
		}

		// Check field name 'ExitReason' first before field var 'x_ExitReason'
		$val = $CurrentForm->hasValue("ExitReason") ? $CurrentForm->getValue("ExitReason") : $CurrentForm->getValue("x_ExitReason");
		if (!$this->ExitReason->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExitReason->Visible = FALSE; // Disable update for API request
			else
				$this->ExitReason->setFormValue($val);
		}

		// Check field name 'RetirementType' first before field var 'x_RetirementType'
		$val = $CurrentForm->hasValue("RetirementType") ? $CurrentForm->getValue("RetirementType") : $CurrentForm->getValue("x_RetirementType");
		if (!$this->RetirementType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RetirementType->Visible = FALSE; // Disable update for API request
			else
				$this->RetirementType->setFormValue($val);
		}

		// Check field name 'EmployeeNumber' first before field var 'x_EmployeeNumber'
		$val = $CurrentForm->hasValue("EmployeeNumber") ? $CurrentForm->getValue("EmployeeNumber") : $CurrentForm->getValue("x_EmployeeNumber");
		if (!$this->EmployeeNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeNumber->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeNumber->setFormValue($val);
		}

		// Check field name 'SalaryNotch' first before field var 'x_SalaryNotch'
		$val = $CurrentForm->hasValue("SalaryNotch") ? $CurrentForm->getValue("SalaryNotch") : $CurrentForm->getValue("x_SalaryNotch");
		if (!$this->SalaryNotch->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SalaryNotch->Visible = FALSE; // Disable update for API request
			else
				$this->SalaryNotch->setFormValue($val);
		}

		// Check field name 'BasicMonthlySalary' first before field var 'x_BasicMonthlySalary'
		$val = $CurrentForm->hasValue("BasicMonthlySalary") ? $CurrentForm->getValue("BasicMonthlySalary") : $CurrentForm->getValue("x_BasicMonthlySalary");
		if (!$this->BasicMonthlySalary->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BasicMonthlySalary->Visible = FALSE; // Disable update for API request
			else
				$this->BasicMonthlySalary->setFormValue($val);
		}

		// Check field name 'ThirdParties' first before field var 'x_ThirdParties'
		$val = $CurrentForm->hasValue("ThirdParties") ? $CurrentForm->getValue("ThirdParties") : $CurrentForm->getValue("x_ThirdParties");
		if (!$this->ThirdParties->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ThirdParties->Visible = FALSE; // Disable update for API request
			else
				$this->ThirdParties->setFormValue($val);
		}

		// Check field name 'PayrollCode' first before field var 'x_PayrollCode'
		$val = $CurrentForm->hasValue("PayrollCode") ? $CurrentForm->getValue("PayrollCode") : $CurrentForm->getValue("x_PayrollCode");
		if (!$this->PayrollCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PayrollCode->Visible = FALSE; // Disable update for API request
			else
				$this->PayrollCode->setFormValue($val);
		}

		// Check field name 'DateOfConfirmation' first before field var 'x_DateOfConfirmation'
		$val = $CurrentForm->hasValue("DateOfConfirmation") ? $CurrentForm->getValue("DateOfConfirmation") : $CurrentForm->getValue("x_DateOfConfirmation");
		if (!$this->DateOfConfirmation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DateOfConfirmation->Visible = FALSE; // Disable update for API request
			else
				$this->DateOfConfirmation->setFormValue($val);
			$this->DateOfConfirmation->CurrentValue = UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->SubstantivePosition->CurrentValue = $this->SubstantivePosition->FormValue;
		$this->DateOfCurrentAppointment->CurrentValue = $this->DateOfCurrentAppointment->FormValue;
		$this->DateOfCurrentAppointment->CurrentValue = UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0);
		$this->LastAppraisalDate->CurrentValue = $this->LastAppraisalDate->FormValue;
		$this->LastAppraisalDate->CurrentValue = UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0);
		$this->AppraisalStatus->CurrentValue = $this->AppraisalStatus->FormValue;
		$this->DateOfExit->CurrentValue = $this->DateOfExit->FormValue;
		$this->DateOfExit->CurrentValue = UnFormatDateTime($this->DateOfExit->CurrentValue, 0);
		$this->SalaryScale->CurrentValue = $this->SalaryScale->FormValue;
		$this->EmploymentType->CurrentValue = $this->EmploymentType->FormValue;
		$this->EmploymentStatus->CurrentValue = $this->EmploymentStatus->FormValue;
		$this->ExitReason->CurrentValue = $this->ExitReason->FormValue;
		$this->RetirementType->CurrentValue = $this->RetirementType->FormValue;
		$this->EmployeeNumber->CurrentValue = $this->EmployeeNumber->FormValue;
		$this->SalaryNotch->CurrentValue = $this->SalaryNotch->FormValue;
		$this->BasicMonthlySalary->CurrentValue = $this->BasicMonthlySalary->FormValue;
		$this->ThirdParties->CurrentValue = $this->ThirdParties->FormValue;
		$this->PayrollCode->CurrentValue = $this->PayrollCode->FormValue;
		$this->DateOfConfirmation->CurrentValue = $this->DateOfConfirmation->FormValue;
		$this->DateOfConfirmation->CurrentValue = UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0);
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
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->SubstantivePosition->setDbValue($row['SubstantivePosition']);
		$this->DateOfCurrentAppointment->setDbValue($row['DateOfCurrentAppointment']);
		$this->LastAppraisalDate->setDbValue($row['LastAppraisalDate']);
		$this->AppraisalStatus->setDbValue($row['AppraisalStatus']);
		$this->DateOfExit->setDbValue($row['DateOfExit']);
		$this->SalaryScale->setDbValue($row['SalaryScale']);
		$this->EmploymentType->setDbValue($row['EmploymentType']);
		$this->EmploymentStatus->setDbValue($row['EmploymentStatus']);
		$this->ExitReason->setDbValue($row['ExitReason']);
		$this->RetirementType->setDbValue($row['RetirementType']);
		$this->EmployeeNumber->setDbValue($row['EmployeeNumber']);
		$this->SalaryNotch->setDbValue($row['SalaryNotch']);
		$this->BasicMonthlySalary->setDbValue($row['BasicMonthlySalary']);
		$this->ThirdParties->setDbValue($row['ThirdParties']);
		$this->PayrollCode->setDbValue($row['PayrollCode']);
		$this->DateOfConfirmation->setDbValue($row['DateOfConfirmation']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['SectionCode'] = NULL;
		$row['SubstantivePosition'] = NULL;
		$row['DateOfCurrentAppointment'] = NULL;
		$row['LastAppraisalDate'] = NULL;
		$row['AppraisalStatus'] = NULL;
		$row['DateOfExit'] = NULL;
		$row['SalaryScale'] = NULL;
		$row['EmploymentType'] = NULL;
		$row['EmploymentStatus'] = NULL;
		$row['ExitReason'] = NULL;
		$row['RetirementType'] = NULL;
		$row['EmployeeNumber'] = NULL;
		$row['SalaryNotch'] = NULL;
		$row['BasicMonthlySalary'] = NULL;
		$row['ThirdParties'] = NULL;
		$row['PayrollCode'] = NULL;
		$row['DateOfConfirmation'] = NULL;
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
		if (strval($this->getKey("SubstantivePosition")) != "")
			$this->SubstantivePosition->OldValue = $this->getKey("SubstantivePosition"); // SubstantivePosition
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
		// Convert decimal values if posted back

		if ($this->BasicMonthlySalary->FormValue == $this->BasicMonthlySalary->CurrentValue && is_numeric(ConvertToFloatString($this->BasicMonthlySalary->CurrentValue)))
			$this->BasicMonthlySalary->CurrentValue = ConvertToFloatString($this->BasicMonthlySalary->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// ProvinceCode
		// LACode
		// DepartmentCode
		// SectionCode
		// SubstantivePosition
		// DateOfCurrentAppointment
		// LastAppraisalDate
		// AppraisalStatus
		// DateOfExit
		// SalaryScale
		// EmploymentType
		// EmploymentStatus
		// ExitReason
		// RetirementType
		// EmployeeNumber
		// SalaryNotch
		// BasicMonthlySalary
		// ThirdParties
		// PayrollCode
		// DateOfConfirmation

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

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

			// SubstantivePosition
			$curVal = strval($this->SubstantivePosition->CurrentValue);
			if ($curVal != "") {
				$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
				if ($this->SubstantivePosition->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SubstantivePosition->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->CurrentValue;
					}
				}
			} else {
				$this->SubstantivePosition->ViewValue = NULL;
			}
			$this->SubstantivePosition->ViewCustomAttributes = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->ViewValue = $this->DateOfCurrentAppointment->CurrentValue;
			$this->DateOfCurrentAppointment->ViewValue = FormatDateTime($this->DateOfCurrentAppointment->ViewValue, 0);
			$this->DateOfCurrentAppointment->ViewCustomAttributes = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->ViewValue = $this->LastAppraisalDate->CurrentValue;
			$this->LastAppraisalDate->ViewValue = FormatDateTime($this->LastAppraisalDate->ViewValue, 0);
			$this->LastAppraisalDate->ViewCustomAttributes = "";

			// AppraisalStatus
			$curVal = strval($this->AppraisalStatus->CurrentValue);
			if ($curVal != "") {
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->lookupCacheOption($curVal);
				if ($this->AppraisalStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AppraisalStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->AppraisalStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->CurrentValue;
					}
				}
			} else {
				$this->AppraisalStatus->ViewValue = NULL;
			}
			$this->AppraisalStatus->ViewCustomAttributes = "";

			// DateOfExit
			$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
			$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
			$this->DateOfExit->ViewCustomAttributes = "";

			// SalaryScale
			$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
			$curVal = strval($this->SalaryScale->CurrentValue);
			if ($curVal != "") {
				$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
				if ($this->SalaryScale->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->SalaryScale->ViewValue = $this->SalaryScale->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
					}
				}
			} else {
				$this->SalaryScale->ViewValue = NULL;
			}
			$this->SalaryScale->ViewCustomAttributes = "";

			// EmploymentType
			$curVal = strval($this->EmploymentType->CurrentValue);
			if ($curVal != "") {
				$this->EmploymentType->ViewValue = $this->EmploymentType->lookupCacheOption($curVal);
				if ($this->EmploymentType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`EmploymentType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmploymentType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EmploymentType->ViewValue = $this->EmploymentType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmploymentType->ViewValue = $this->EmploymentType->CurrentValue;
					}
				}
			} else {
				$this->EmploymentType->ViewValue = NULL;
			}
			$this->EmploymentType->ViewCustomAttributes = "";

			// EmploymentStatus
			$curVal = strval($this->EmploymentStatus->CurrentValue);
			if ($curVal != "") {
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->lookupCacheOption($curVal);
				if ($this->EmploymentStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`EmploymentStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmploymentStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->CurrentValue;
					}
				}
			} else {
				$this->EmploymentStatus->ViewValue = NULL;
			}
			$this->EmploymentStatus->ViewCustomAttributes = "";

			// ExitReason
			$curVal = strval($this->ExitReason->CurrentValue);
			if ($curVal != "") {
				$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
				if ($this->ExitReason->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ExitCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

			// RetirementType
			$curVal = strval($this->RetirementType->CurrentValue);
			if ($curVal != "") {
				$this->RetirementType->ViewValue = $this->RetirementType->lookupCacheOption($curVal);
				if ($this->RetirementType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`RetirementCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->RetirementType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RetirementType->ViewValue = $this->RetirementType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RetirementType->ViewValue = $this->RetirementType->CurrentValue;
					}
				}
			} else {
				$this->RetirementType->ViewValue = NULL;
			}
			$this->RetirementType->ViewCustomAttributes = "";

			// EmployeeNumber
			$this->EmployeeNumber->ViewValue = $this->EmployeeNumber->CurrentValue;
			$this->EmployeeNumber->ViewCustomAttributes = "";

			// SalaryNotch
			$curVal = strval($this->SalaryNotch->CurrentValue);
			if ($curVal != "") {
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->lookupCacheOption($curVal);
				if ($this->SalaryNotch->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Notch`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->SalaryNotch->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2);
						$this->SalaryNotch->ViewValue = $this->SalaryNotch->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->SalaryNotch->ViewValue = $this->SalaryNotch->CurrentValue;
					}
				}
			} else {
				$this->SalaryNotch->ViewValue = NULL;
			}
			$this->SalaryNotch->ViewCustomAttributes = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->ViewValue = $this->BasicMonthlySalary->CurrentValue;
			$this->BasicMonthlySalary->ViewValue = FormatNumber($this->BasicMonthlySalary->ViewValue, 2, -2, -2, -2);
			$this->BasicMonthlySalary->ViewCustomAttributes = "";

			// ThirdParties
			$curVal = strval($this->ThirdParties->CurrentValue);
			if ($curVal != "") {
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
				if ($this->ThirdParties->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ThirdParties->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->ThirdParties->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->ThirdParties->ViewValue = $this->ThirdParties->CurrentValue;
					}
				}
			} else {
				$this->ThirdParties->ViewValue = NULL;
			}
			$this->ThirdParties->ViewCustomAttributes = "";

			// PayrollCode
			$this->PayrollCode->ViewValue = $this->PayrollCode->CurrentValue;
			$this->PayrollCode->ViewValue = FormatNumber($this->PayrollCode->ViewValue, 0, -2, -2, -2);
			$this->PayrollCode->ViewCustomAttributes = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->ViewValue = $this->DateOfConfirmation->CurrentValue;
			$this->DateOfConfirmation->ViewValue = FormatDateTime($this->DateOfConfirmation->ViewValue, 0);
			$this->DateOfConfirmation->ViewCustomAttributes = "";

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

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";
			$this->SectionCode->TooltipValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->LinkCustomAttributes = "";
			$this->SubstantivePosition->HrefValue = "";
			$this->SubstantivePosition->TooltipValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
			$this->DateOfCurrentAppointment->HrefValue = "";
			$this->DateOfCurrentAppointment->TooltipValue = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->LinkCustomAttributes = "";
			$this->LastAppraisalDate->HrefValue = "";
			$this->LastAppraisalDate->TooltipValue = "";

			// AppraisalStatus
			$this->AppraisalStatus->LinkCustomAttributes = "";
			$this->AppraisalStatus->HrefValue = "";
			$this->AppraisalStatus->TooltipValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";
			$this->DateOfExit->TooltipValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";
			$this->SalaryScale->TooltipValue = "";

			// EmploymentType
			$this->EmploymentType->LinkCustomAttributes = "";
			$this->EmploymentType->HrefValue = "";
			$this->EmploymentType->TooltipValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";
			$this->EmploymentStatus->TooltipValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";
			$this->ExitReason->TooltipValue = "";

			// RetirementType
			$this->RetirementType->LinkCustomAttributes = "";
			$this->RetirementType->HrefValue = "";
			$this->RetirementType->TooltipValue = "";

			// EmployeeNumber
			$this->EmployeeNumber->LinkCustomAttributes = "";
			$this->EmployeeNumber->HrefValue = "";
			$this->EmployeeNumber->TooltipValue = "";

			// SalaryNotch
			$this->SalaryNotch->LinkCustomAttributes = "";
			$this->SalaryNotch->HrefValue = "";
			$this->SalaryNotch->TooltipValue = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->LinkCustomAttributes = "";
			$this->BasicMonthlySalary->HrefValue = "";
			$this->BasicMonthlySalary->TooltipValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
			$this->ThirdParties->TooltipValue = "";

			// PayrollCode
			$this->PayrollCode->LinkCustomAttributes = "";
			$this->PayrollCode->HrefValue = "";
			$this->PayrollCode->TooltipValue = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->LinkCustomAttributes = "";
			$this->DateOfConfirmation->HrefValue = "";
			$this->DateOfConfirmation->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
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
			} else {
				$curVal = trim(strval($this->ProvinceCode->CurrentValue));
				if ($curVal != "")
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				else
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
				if ($this->ProvinceCode->ViewValue !== NULL) { // Load from cache
					$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ProvinceCode->EditValue = $arwrk;
				}
			}

			// LACode
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
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
			} else {
				$curVal = trim(strval($this->LACode->CurrentValue));
				if ($curVal != "")
					$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				else
					$this->LACode->ViewValue = $this->LACode->Lookup !== NULL && is_array($this->LACode->Lookup->Options) ? $curVal : NULL;
				if ($this->LACode->ViewValue !== NULL) { // Load from cache
					$this->LACode->EditValue = array_values($this->LACode->Lookup->Options);
					if ($this->LACode->ViewValue == "")
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
					} else {
						$this->LACode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
			if ($this->DepartmentCode->getSessionValue() != "") {
				$this->DepartmentCode->CurrentValue = $this->DepartmentCode->getSessionValue();
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
			} else {
				$curVal = trim(strval($this->DepartmentCode->CurrentValue));
				if ($curVal != "")
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
				else
					$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
				if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
					$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
					if ($this->DepartmentCode->ViewValue == "")
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->DepartmentCode->ViewValue = $this->DepartmentCode->displayValue($arwrk);
					} else {
						$this->DepartmentCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->DepartmentCode->EditValue = $arwrk;
				}
			}

			// SectionCode
			$this->SectionCode->EditCustomAttributes = "";
			if ($this->SectionCode->getSessionValue() != "") {
				$this->SectionCode->CurrentValue = $this->SectionCode->getSessionValue();
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
			} else {
				$curVal = trim(strval($this->SectionCode->CurrentValue));
				if ($curVal != "")
					$this->SectionCode->ViewValue = $this->SectionCode->lookupCacheOption($curVal);
				else
					$this->SectionCode->ViewValue = $this->SectionCode->Lookup !== NULL && is_array($this->SectionCode->Lookup->Options) ? $curVal : NULL;
				if ($this->SectionCode->ViewValue !== NULL) { // Load from cache
					$this->SectionCode->EditValue = array_values($this->SectionCode->Lookup->Options);
					if ($this->SectionCode->ViewValue == "")
						$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->SectionCode->ViewValue = $this->SectionCode->displayValue($arwrk);
					} else {
						$this->SectionCode->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->SectionCode->EditValue = $arwrk;
				}
			}

			// SubstantivePosition
			$this->SubstantivePosition->EditCustomAttributes = "";
			$curVal = trim(strval($this->SubstantivePosition->CurrentValue));
			if ($curVal != "")
				$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->lookupCacheOption($curVal);
			else
				$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->Lookup !== NULL && is_array($this->SubstantivePosition->Lookup->Options) ? $curVal : NULL;
			if ($this->SubstantivePosition->ViewValue !== NULL) { // Load from cache
				$this->SubstantivePosition->EditValue = array_values($this->SubstantivePosition->Lookup->Options);
				if ($this->SubstantivePosition->ViewValue == "")
					$this->SubstantivePosition->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PositionCode`" . SearchString("=", $this->SubstantivePosition->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SubstantivePosition->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->SubstantivePosition->ViewValue = $this->SubstantivePosition->displayValue($arwrk);
				} else {
					$this->SubstantivePosition->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SubstantivePosition->EditValue = $arwrk;
			}

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->EditAttrs["class"] = "form-control";
			$this->DateOfCurrentAppointment->EditCustomAttributes = "";
			$this->DateOfCurrentAppointment->EditValue = HtmlEncode(FormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 8));
			$this->DateOfCurrentAppointment->PlaceHolder = RemoveHtml($this->DateOfCurrentAppointment->caption());

			// LastAppraisalDate
			$this->LastAppraisalDate->EditAttrs["class"] = "form-control";
			$this->LastAppraisalDate->EditCustomAttributes = "";
			$this->LastAppraisalDate->EditValue = HtmlEncode(FormatDateTime($this->LastAppraisalDate->CurrentValue, 8));
			$this->LastAppraisalDate->PlaceHolder = RemoveHtml($this->LastAppraisalDate->caption());

			// AppraisalStatus
			$this->AppraisalStatus->EditAttrs["class"] = "form-control";
			$this->AppraisalStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->AppraisalStatus->CurrentValue));
			if ($curVal != "")
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->lookupCacheOption($curVal);
			else
				$this->AppraisalStatus->ViewValue = $this->AppraisalStatus->Lookup !== NULL && is_array($this->AppraisalStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->AppraisalStatus->ViewValue !== NULL) { // Load from cache
				$this->AppraisalStatus->EditValue = array_values($this->AppraisalStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AppraisalStatus`" . SearchString("=", $this->AppraisalStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->AppraisalStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AppraisalStatus->EditValue = $arwrk;
			}

			// DateOfExit
			$this->DateOfExit->EditAttrs["class"] = "form-control";
			$this->DateOfExit->EditCustomAttributes = "";
			$this->DateOfExit->EditValue = HtmlEncode(FormatDateTime($this->DateOfExit->CurrentValue, 8));
			$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

			// SalaryScale
			$this->SalaryScale->EditAttrs["class"] = "form-control";
			$this->SalaryScale->EditCustomAttributes = "";
			if ($this->SalaryScale->getSessionValue() != "") {
				$this->SalaryScale->CurrentValue = $this->SalaryScale->getSessionValue();
				$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
				$curVal = strval($this->SalaryScale->CurrentValue);
				if ($curVal != "") {
					$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
					if ($this->SalaryScale->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->SalaryScale->ViewValue = $this->SalaryScale->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->SalaryScale->ViewValue = $this->SalaryScale->CurrentValue;
						}
					}
				} else {
					$this->SalaryScale->ViewValue = NULL;
				}
				$this->SalaryScale->ViewCustomAttributes = "";
			} else {
				if (!$this->SalaryScale->Raw)
					$this->SalaryScale->CurrentValue = HtmlDecode($this->SalaryScale->CurrentValue);
				$this->SalaryScale->EditValue = HtmlEncode($this->SalaryScale->CurrentValue);
				$curVal = strval($this->SalaryScale->CurrentValue);
				if ($curVal != "") {
					$this->SalaryScale->EditValue = $this->SalaryScale->lookupCacheOption($curVal);
					if ($this->SalaryScale->EditValue === NULL) { // Lookup from database
						$filterWrk = "`SalaryScale`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->SalaryScale->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->SalaryScale->EditValue = $this->SalaryScale->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->SalaryScale->EditValue = HtmlEncode($this->SalaryScale->CurrentValue);
						}
					}
				} else {
					$this->SalaryScale->EditValue = NULL;
				}
				$this->SalaryScale->PlaceHolder = RemoveHtml($this->SalaryScale->caption());
			}

			// EmploymentType
			$this->EmploymentType->EditAttrs["class"] = "form-control";
			$this->EmploymentType->EditCustomAttributes = "";
			$curVal = trim(strval($this->EmploymentType->CurrentValue));
			if ($curVal != "")
				$this->EmploymentType->ViewValue = $this->EmploymentType->lookupCacheOption($curVal);
			else
				$this->EmploymentType->ViewValue = $this->EmploymentType->Lookup !== NULL && is_array($this->EmploymentType->Lookup->Options) ? $curVal : NULL;
			if ($this->EmploymentType->ViewValue !== NULL) { // Load from cache
				$this->EmploymentType->EditValue = array_values($this->EmploymentType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`EmploymentType`" . SearchString("=", $this->EmploymentType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EmploymentType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EmploymentType->EditValue = $arwrk;
			}

			// EmploymentStatus
			$this->EmploymentStatus->EditAttrs["class"] = "form-control";
			$this->EmploymentStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->EmploymentStatus->CurrentValue));
			if ($curVal != "")
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->lookupCacheOption($curVal);
			else
				$this->EmploymentStatus->ViewValue = $this->EmploymentStatus->Lookup !== NULL && is_array($this->EmploymentStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->EmploymentStatus->ViewValue !== NULL) { // Load from cache
				$this->EmploymentStatus->EditValue = array_values($this->EmploymentStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`EmploymentStatus`" . SearchString("=", $this->EmploymentStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->EmploymentStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->EmploymentStatus->EditValue = $arwrk;
			}

			// ExitReason
			$this->ExitReason->EditAttrs["class"] = "form-control";
			$this->ExitReason->EditCustomAttributes = "";
			$curVal = trim(strval($this->ExitReason->CurrentValue));
			if ($curVal != "")
				$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
			else
				$this->ExitReason->ViewValue = $this->ExitReason->Lookup !== NULL && is_array($this->ExitReason->Lookup->Options) ? $curVal : NULL;
			if ($this->ExitReason->ViewValue !== NULL) { // Load from cache
				$this->ExitReason->EditValue = array_values($this->ExitReason->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ExitCode`" . SearchString("=", $this->ExitReason->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ExitReason->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ExitReason->EditValue = $arwrk;
			}

			// RetirementType
			$this->RetirementType->EditAttrs["class"] = "form-control";
			$this->RetirementType->EditCustomAttributes = "";
			$curVal = trim(strval($this->RetirementType->CurrentValue));
			if ($curVal != "")
				$this->RetirementType->ViewValue = $this->RetirementType->lookupCacheOption($curVal);
			else
				$this->RetirementType->ViewValue = $this->RetirementType->Lookup !== NULL && is_array($this->RetirementType->Lookup->Options) ? $curVal : NULL;
			if ($this->RetirementType->ViewValue !== NULL) { // Load from cache
				$this->RetirementType->EditValue = array_values($this->RetirementType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`RetirementCode`" . SearchString("=", $this->RetirementType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->RetirementType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RetirementType->EditValue = $arwrk;
			}

			// EmployeeNumber
			$this->EmployeeNumber->EditAttrs["class"] = "form-control";
			$this->EmployeeNumber->EditCustomAttributes = "";
			if (!$this->EmployeeNumber->Raw)
				$this->EmployeeNumber->CurrentValue = HtmlDecode($this->EmployeeNumber->CurrentValue);
			$this->EmployeeNumber->EditValue = HtmlEncode($this->EmployeeNumber->CurrentValue);
			$this->EmployeeNumber->PlaceHolder = RemoveHtml($this->EmployeeNumber->caption());

			// SalaryNotch
			$this->SalaryNotch->EditCustomAttributes = "";
			$curVal = trim(strval($this->SalaryNotch->CurrentValue));
			if ($curVal != "")
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->lookupCacheOption($curVal);
			else
				$this->SalaryNotch->ViewValue = $this->SalaryNotch->Lookup !== NULL && is_array($this->SalaryNotch->Lookup->Options) ? $curVal : NULL;
			if ($this->SalaryNotch->ViewValue !== NULL) { // Load from cache
				$this->SalaryNotch->EditValue = array_values($this->SalaryNotch->Lookup->Options);
				if ($this->SalaryNotch->ViewValue == "")
					$this->SalaryNotch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Notch`" . SearchString("=", $this->SalaryNotch->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->SalaryNotch->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode(FormatNumber($rswrk->fields('df'), 0, -2, -2, -2));
					$arwrk[2] = HtmlEncode(FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2));
					$this->SalaryNotch->ViewValue = $this->SalaryNotch->displayValue($arwrk);
				} else {
					$this->SalaryNotch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatNumber($arwrk[$i][1], 0, -2, -2, -2);
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 2, -2, -2, -2);
				}
				$this->SalaryNotch->EditValue = $arwrk;
			}

			// BasicMonthlySalary
			$this->BasicMonthlySalary->EditAttrs["class"] = "form-control";
			$this->BasicMonthlySalary->EditCustomAttributes = "";
			$this->BasicMonthlySalary->EditValue = HtmlEncode($this->BasicMonthlySalary->CurrentValue);
			$this->BasicMonthlySalary->PlaceHolder = RemoveHtml($this->BasicMonthlySalary->caption());
			if (strval($this->BasicMonthlySalary->EditValue) != "" && is_numeric($this->BasicMonthlySalary->EditValue))
				$this->BasicMonthlySalary->EditValue = FormatNumber($this->BasicMonthlySalary->EditValue, -2, -2, -2, -2);
			

			// ThirdParties
			$this->ThirdParties->EditCustomAttributes = "";
			$curVal = trim(strval($this->ThirdParties->CurrentValue));
			if ($curVal != "")
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
			else
				$this->ThirdParties->ViewValue = $this->ThirdParties->Lookup !== NULL && is_array($this->ThirdParties->Lookup->Options) ? $curVal : NULL;
			if ($this->ThirdParties->ViewValue !== NULL) { // Load from cache
				$this->ThirdParties->EditValue = array_values($this->ThirdParties->Lookup->Options);
				if ($this->ThirdParties->ViewValue == "")
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ThirdParties->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ThirdParties->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ThirdParties->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ThirdParties->EditValue = $arwrk;
			}

			// PayrollCode
			$this->PayrollCode->EditAttrs["class"] = "form-control";
			$this->PayrollCode->EditCustomAttributes = "";
			$this->PayrollCode->EditValue = HtmlEncode($this->PayrollCode->CurrentValue);
			$this->PayrollCode->PlaceHolder = RemoveHtml($this->PayrollCode->caption());

			// DateOfConfirmation
			$this->DateOfConfirmation->EditAttrs["class"] = "form-control";
			$this->DateOfConfirmation->EditCustomAttributes = "";
			$this->DateOfConfirmation->EditValue = HtmlEncode(FormatDateTime($this->DateOfConfirmation->CurrentValue, 8));
			$this->DateOfConfirmation->PlaceHolder = RemoveHtml($this->DateOfConfirmation->caption());

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// SectionCode
			$this->SectionCode->LinkCustomAttributes = "";
			$this->SectionCode->HrefValue = "";

			// SubstantivePosition
			$this->SubstantivePosition->LinkCustomAttributes = "";
			$this->SubstantivePosition->HrefValue = "";

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->LinkCustomAttributes = "";
			$this->DateOfCurrentAppointment->HrefValue = "";

			// LastAppraisalDate
			$this->LastAppraisalDate->LinkCustomAttributes = "";
			$this->LastAppraisalDate->HrefValue = "";

			// AppraisalStatus
			$this->AppraisalStatus->LinkCustomAttributes = "";
			$this->AppraisalStatus->HrefValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";

			// EmploymentType
			$this->EmploymentType->LinkCustomAttributes = "";
			$this->EmploymentType->HrefValue = "";

			// EmploymentStatus
			$this->EmploymentStatus->LinkCustomAttributes = "";
			$this->EmploymentStatus->HrefValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";

			// RetirementType
			$this->RetirementType->LinkCustomAttributes = "";
			$this->RetirementType->HrefValue = "";

			// EmployeeNumber
			$this->EmployeeNumber->LinkCustomAttributes = "";
			$this->EmployeeNumber->HrefValue = "";

			// SalaryNotch
			$this->SalaryNotch->LinkCustomAttributes = "";
			$this->SalaryNotch->HrefValue = "";

			// BasicMonthlySalary
			$this->BasicMonthlySalary->LinkCustomAttributes = "";
			$this->BasicMonthlySalary->HrefValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";

			// PayrollCode
			$this->PayrollCode->LinkCustomAttributes = "";
			$this->PayrollCode->HrefValue = "";

			// DateOfConfirmation
			$this->DateOfConfirmation->LinkCustomAttributes = "";
			$this->DateOfConfirmation->HrefValue = "";
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
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentCode->Required) {
			if (!$this->DepartmentCode->IsDetailKey && $this->DepartmentCode->FormValue != NULL && $this->DepartmentCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentCode->caption(), $this->DepartmentCode->RequiredErrorMessage));
			}
		}
		if ($this->SectionCode->Required) {
			if (!$this->SectionCode->IsDetailKey && $this->SectionCode->FormValue != NULL && $this->SectionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SectionCode->caption(), $this->SectionCode->RequiredErrorMessage));
			}
		}
		if ($this->SubstantivePosition->Required) {
			if (!$this->SubstantivePosition->IsDetailKey && $this->SubstantivePosition->FormValue != NULL && $this->SubstantivePosition->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SubstantivePosition->caption(), $this->SubstantivePosition->RequiredErrorMessage));
			}
		}
		if ($this->DateOfCurrentAppointment->Required) {
			if (!$this->DateOfCurrentAppointment->IsDetailKey && $this->DateOfCurrentAppointment->FormValue != NULL && $this->DateOfCurrentAppointment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfCurrentAppointment->caption(), $this->DateOfCurrentAppointment->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfCurrentAppointment->FormValue)) {
			AddMessage($FormError, $this->DateOfCurrentAppointment->errorMessage());
		}
		if ($this->LastAppraisalDate->Required) {
			if (!$this->LastAppraisalDate->IsDetailKey && $this->LastAppraisalDate->FormValue != NULL && $this->LastAppraisalDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastAppraisalDate->caption(), $this->LastAppraisalDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastAppraisalDate->FormValue)) {
			AddMessage($FormError, $this->LastAppraisalDate->errorMessage());
		}
		if ($this->AppraisalStatus->Required) {
			if (!$this->AppraisalStatus->IsDetailKey && $this->AppraisalStatus->FormValue != NULL && $this->AppraisalStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AppraisalStatus->caption(), $this->AppraisalStatus->RequiredErrorMessage));
			}
		}
		if ($this->DateOfExit->Required) {
			if (!$this->DateOfExit->IsDetailKey && $this->DateOfExit->FormValue != NULL && $this->DateOfExit->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfExit->caption(), $this->DateOfExit->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfExit->FormValue)) {
			AddMessage($FormError, $this->DateOfExit->errorMessage());
		}
		if ($this->SalaryScale->Required) {
			if (!$this->SalaryScale->IsDetailKey && $this->SalaryScale->FormValue != NULL && $this->SalaryScale->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SalaryScale->caption(), $this->SalaryScale->RequiredErrorMessage));
			}
		}
		if ($this->EmploymentType->Required) {
			if (!$this->EmploymentType->IsDetailKey && $this->EmploymentType->FormValue != NULL && $this->EmploymentType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmploymentType->caption(), $this->EmploymentType->RequiredErrorMessage));
			}
		}
		if ($this->EmploymentStatus->Required) {
			if (!$this->EmploymentStatus->IsDetailKey && $this->EmploymentStatus->FormValue != NULL && $this->EmploymentStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmploymentStatus->caption(), $this->EmploymentStatus->RequiredErrorMessage));
			}
		}
		if ($this->ExitReason->Required) {
			if (!$this->ExitReason->IsDetailKey && $this->ExitReason->FormValue != NULL && $this->ExitReason->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExitReason->caption(), $this->ExitReason->RequiredErrorMessage));
			}
		}
		if ($this->RetirementType->Required) {
			if (!$this->RetirementType->IsDetailKey && $this->RetirementType->FormValue != NULL && $this->RetirementType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RetirementType->caption(), $this->RetirementType->RequiredErrorMessage));
			}
		}
		if ($this->EmployeeNumber->Required) {
			if (!$this->EmployeeNumber->IsDetailKey && $this->EmployeeNumber->FormValue != NULL && $this->EmployeeNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeNumber->caption(), $this->EmployeeNumber->RequiredErrorMessage));
			}
		}
		if ($this->SalaryNotch->Required) {
			if (!$this->SalaryNotch->IsDetailKey && $this->SalaryNotch->FormValue != NULL && $this->SalaryNotch->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SalaryNotch->caption(), $this->SalaryNotch->RequiredErrorMessage));
			}
		}
		if ($this->BasicMonthlySalary->Required) {
			if (!$this->BasicMonthlySalary->IsDetailKey && $this->BasicMonthlySalary->FormValue != NULL && $this->BasicMonthlySalary->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BasicMonthlySalary->caption(), $this->BasicMonthlySalary->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BasicMonthlySalary->FormValue)) {
			AddMessage($FormError, $this->BasicMonthlySalary->errorMessage());
		}
		if ($this->ThirdParties->Required) {
			if ($this->ThirdParties->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ThirdParties->caption(), $this->ThirdParties->RequiredErrorMessage));
			}
		}
		if ($this->PayrollCode->Required) {
			if (!$this->PayrollCode->IsDetailKey && $this->PayrollCode->FormValue != NULL && $this->PayrollCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PayrollCode->caption(), $this->PayrollCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PayrollCode->FormValue)) {
			AddMessage($FormError, $this->PayrollCode->errorMessage());
		}
		if ($this->DateOfConfirmation->Required) {
			if (!$this->DateOfConfirmation->IsDetailKey && $this->DateOfConfirmation->FormValue != NULL && $this->DateOfConfirmation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateOfConfirmation->caption(), $this->DateOfConfirmation->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateOfConfirmation->FormValue)) {
			AddMessage($FormError, $this->DateOfConfirmation->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("leave_record", $detailTblVar) && $GLOBALS["leave_record"]->DetailEdit) {
			if (!isset($GLOBALS["leave_record_grid"]))
				$GLOBALS["leave_record_grid"] = new leave_record_grid(); // Get detail page object
			$GLOBALS["leave_record_grid"]->validateGridForm();
		}
		if (in_array("leave_taken", $detailTblVar) && $GLOBALS["leave_taken"]->DetailEdit) {
			if (!isset($GLOBALS["leave_taken_grid"]))
				$GLOBALS["leave_taken_grid"] = new leave_taken_grid(); // Get detail page object
			$GLOBALS["leave_taken_grid"]->validateGridForm();
		}
		if (in_array("employee_obligation", $detailTblVar) && $GLOBALS["employee_obligation"]->DetailEdit) {
			if (!isset($GLOBALS["employee_obligation_grid"]))
				$GLOBALS["employee_obligation_grid"] = new employee_obligation_grid(); // Get detail page object
			$GLOBALS["employee_obligation_grid"]->validateGridForm();
		}
		if (in_array("employee_income", $detailTblVar) && $GLOBALS["employee_income"]->DetailEdit) {
			if (!isset($GLOBALS["employee_income_grid"]))
				$GLOBALS["employee_income_grid"] = new employee_income_grid(); // Get detail page object
			$GLOBALS["employee_income_grid"]->validateGridForm();
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

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, NULL, $this->SectionCode->ReadOnly);

			// SubstantivePosition
			$this->SubstantivePosition->setDbValueDef($rsnew, $this->SubstantivePosition->CurrentValue, 0, $this->SubstantivePosition->ReadOnly);

			// DateOfCurrentAppointment
			$this->DateOfCurrentAppointment->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfCurrentAppointment->CurrentValue, 0), CurrentDate(), $this->DateOfCurrentAppointment->ReadOnly);

			// LastAppraisalDate
			$this->LastAppraisalDate->setDbValueDef($rsnew, UnFormatDateTime($this->LastAppraisalDate->CurrentValue, 0), NULL, $this->LastAppraisalDate->ReadOnly);

			// AppraisalStatus
			$this->AppraisalStatus->setDbValueDef($rsnew, $this->AppraisalStatus->CurrentValue, NULL, $this->AppraisalStatus->ReadOnly);

			// DateOfExit
			$this->DateOfExit->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfExit->CurrentValue, 0), NULL, $this->DateOfExit->ReadOnly);

			// SalaryScale
			$this->SalaryScale->setDbValueDef($rsnew, $this->SalaryScale->CurrentValue, "", $this->SalaryScale->ReadOnly);

			// EmploymentType
			$this->EmploymentType->setDbValueDef($rsnew, $this->EmploymentType->CurrentValue, 0, $this->EmploymentType->ReadOnly);

			// EmploymentStatus
			$this->EmploymentStatus->setDbValueDef($rsnew, $this->EmploymentStatus->CurrentValue, 0, $this->EmploymentStatus->ReadOnly);

			// ExitReason
			$this->ExitReason->setDbValueDef($rsnew, $this->ExitReason->CurrentValue, NULL, $this->ExitReason->ReadOnly);

			// RetirementType
			$this->RetirementType->setDbValueDef($rsnew, $this->RetirementType->CurrentValue, NULL, $this->RetirementType->ReadOnly);

			// EmployeeNumber
			$this->EmployeeNumber->setDbValueDef($rsnew, $this->EmployeeNumber->CurrentValue, NULL, $this->EmployeeNumber->ReadOnly);

			// SalaryNotch
			$this->SalaryNotch->setDbValueDef($rsnew, $this->SalaryNotch->CurrentValue, 0, $this->SalaryNotch->ReadOnly);

			// BasicMonthlySalary
			$this->BasicMonthlySalary->setDbValueDef($rsnew, $this->BasicMonthlySalary->CurrentValue, 0, $this->BasicMonthlySalary->ReadOnly);

			// ThirdParties
			$this->ThirdParties->setDbValueDef($rsnew, $this->ThirdParties->CurrentValue, "", $this->ThirdParties->ReadOnly);

			// PayrollCode
			$this->PayrollCode->setDbValueDef($rsnew, $this->PayrollCode->CurrentValue, 0, $this->PayrollCode->ReadOnly);

			// DateOfConfirmation
			$this->DateOfConfirmation->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfConfirmation->CurrentValue, 0), NULL, $this->DateOfConfirmation->ReadOnly);

			// Check referential integrity for master table 'position_ref'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_position_ref();
			$keyValue = isset($rsnew['SubstantivePosition']) ? $rsnew['SubstantivePosition'] : $rsold['SubstantivePosition'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@PositionCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['SectionCode']) ? $rsnew['SectionCode'] : $rsold['SectionCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@SectionCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['DepartmentCode']) ? $rsnew['DepartmentCode'] : $rsold['DepartmentCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@DepartmentCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['LACode']) ? $rsnew['LACode'] : $rsold['LACode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@LACode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['ProvinceCode']) ? $rsnew['ProvinceCode'] : $rsold['ProvinceCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@ProvinceCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			$keyValue = isset($rsnew['SalaryScale']) ? $rsnew['SalaryScale'] : $rsold['SalaryScale'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@SalaryScale@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["position_ref"]))
					$GLOBALS["position_ref"] = new position_ref();
				$rsmaster = $GLOBALS["position_ref"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "position_ref", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Check referential integrity for master table 'staff'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_staff();
			$keyValue = isset($rsnew['EmployeeID']) ? $rsnew['EmployeeID'] : $rsold['EmployeeID'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@EmployeeID@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["staff"]))
					$GLOBALS["staff"] = new staff();
				$rsmaster = $GLOBALS["staff"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "staff", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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
					if (in_array("leave_record", $detailTblVar) && $GLOBALS["leave_record"]->DetailEdit) {
						if (!isset($GLOBALS["leave_record_grid"]))
							$GLOBALS["leave_record_grid"] = new leave_record_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "leave_record"); // Load user level of detail table
						$editRow = $GLOBALS["leave_record_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("leave_taken", $detailTblVar) && $GLOBALS["leave_taken"]->DetailEdit) {
						if (!isset($GLOBALS["leave_taken_grid"]))
							$GLOBALS["leave_taken_grid"] = new leave_taken_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "leave_taken"); // Load user level of detail table
						$editRow = $GLOBALS["leave_taken_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("employee_obligation", $detailTblVar) && $GLOBALS["employee_obligation"]->DetailEdit) {
						if (!isset($GLOBALS["employee_obligation_grid"]))
							$GLOBALS["employee_obligation_grid"] = new employee_obligation_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "employee_obligation"); // Load user level of detail table
						$editRow = $GLOBALS["employee_obligation_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("employee_income", $detailTblVar) && $GLOBALS["employee_income"]->DetailEdit) {
						if (!isset($GLOBALS["employee_income_grid"]))
							$GLOBALS["employee_income_grid"] = new employee_income_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "employee_income"); // Load user level of detail table
						$editRow = $GLOBALS["employee_income_grid"]->gridUpdate();
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
			if ($masterTblVar == "position_ref") {
				$validMaster = TRUE;
				if (($parm = Get("fk_PositionCode", Get("SubstantivePosition"))) !== NULL) {
					$GLOBALS["position_ref"]->PositionCode->setQueryStringValue($parm);
					$this->SubstantivePosition->setQueryStringValue($GLOBALS["position_ref"]->PositionCode->QueryStringValue);
					$this->SubstantivePosition->setSessionValue($this->SubstantivePosition->QueryStringValue);
					if (!is_numeric($GLOBALS["position_ref"]->PositionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_SectionCode", Get("SectionCode"))) !== NULL) {
					$GLOBALS["position_ref"]->SectionCode->setQueryStringValue($parm);
					$this->SectionCode->setQueryStringValue($GLOBALS["position_ref"]->SectionCode->QueryStringValue);
					$this->SectionCode->setSessionValue($this->SectionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["position_ref"]->SectionCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_DepartmentCode", Get("DepartmentCode"))) !== NULL) {
					$GLOBALS["position_ref"]->DepartmentCode->setQueryStringValue($parm);
					$this->DepartmentCode->setQueryStringValue($GLOBALS["position_ref"]->DepartmentCode->QueryStringValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->QueryStringValue);
					if (!is_numeric($GLOBALS["position_ref"]->DepartmentCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["position_ref"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["position_ref"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["position_ref"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["position_ref"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["position_ref"]->ProvinceCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_SalaryScale", Get("SalaryScale"))) !== NULL) {
					$GLOBALS["position_ref"]->SalaryScale->setQueryStringValue($parm);
					$this->SalaryScale->setQueryStringValue($GLOBALS["position_ref"]->SalaryScale->QueryStringValue);
					$this->SalaryScale->setSessionValue($this->SalaryScale->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
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
			if ($masterTblVar == "position_ref") {
				$validMaster = TRUE;
				if (($parm = Post("fk_PositionCode", Post("SubstantivePosition"))) !== NULL) {
					$GLOBALS["position_ref"]->PositionCode->setFormValue($parm);
					$this->SubstantivePosition->setFormValue($GLOBALS["position_ref"]->PositionCode->FormValue);
					$this->SubstantivePosition->setSessionValue($this->SubstantivePosition->FormValue);
					if (!is_numeric($GLOBALS["position_ref"]->PositionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_SectionCode", Post("SectionCode"))) !== NULL) {
					$GLOBALS["position_ref"]->SectionCode->setFormValue($parm);
					$this->SectionCode->setFormValue($GLOBALS["position_ref"]->SectionCode->FormValue);
					$this->SectionCode->setSessionValue($this->SectionCode->FormValue);
					if (!is_numeric($GLOBALS["position_ref"]->SectionCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_DepartmentCode", Post("DepartmentCode"))) !== NULL) {
					$GLOBALS["position_ref"]->DepartmentCode->setFormValue($parm);
					$this->DepartmentCode->setFormValue($GLOBALS["position_ref"]->DepartmentCode->FormValue);
					$this->DepartmentCode->setSessionValue($this->DepartmentCode->FormValue);
					if (!is_numeric($GLOBALS["position_ref"]->DepartmentCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["position_ref"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["position_ref"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["position_ref"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["position_ref"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["position_ref"]->ProvinceCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_SalaryScale", Post("SalaryScale"))) !== NULL) {
					$GLOBALS["position_ref"]->SalaryScale->setFormValue($parm);
					$this->SalaryScale->setFormValue($GLOBALS["position_ref"]->SalaryScale->FormValue);
					$this->SalaryScale->setSessionValue($this->SalaryScale->FormValue);
				} else {
					$validMaster = FALSE;
				}
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
			if ($masterTblVar != "position_ref") {
				if ($this->SubstantivePosition->CurrentValue == "")
					$this->SubstantivePosition->setSessionValue("");
				if ($this->SectionCode->CurrentValue == "")
					$this->SectionCode->setSessionValue("");
				if ($this->DepartmentCode->CurrentValue == "")
					$this->DepartmentCode->setSessionValue("");
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->ProvinceCode->CurrentValue == "")
					$this->ProvinceCode->setSessionValue("");
				if ($this->SalaryScale->CurrentValue == "")
					$this->SalaryScale->setSessionValue("");
			}
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
			if (in_array("leave_record", $detailTblVar)) {
				if (!isset($GLOBALS["leave_record_grid"]))
					$GLOBALS["leave_record_grid"] = new leave_record_grid();
				if ($GLOBALS["leave_record_grid"]->DetailEdit) {
					$GLOBALS["leave_record_grid"]->CurrentMode = "edit";
					$GLOBALS["leave_record_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["leave_record_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["leave_record_grid"]->setStartRecordNumber(1);
					$GLOBALS["leave_record_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["leave_record_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["leave_record_grid"]->EmployeeID->setSessionValue($GLOBALS["leave_record_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("leave_taken", $detailTblVar)) {
				if (!isset($GLOBALS["leave_taken_grid"]))
					$GLOBALS["leave_taken_grid"] = new leave_taken_grid();
				if ($GLOBALS["leave_taken_grid"]->DetailEdit) {
					$GLOBALS["leave_taken_grid"]->CurrentMode = "edit";
					$GLOBALS["leave_taken_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["leave_taken_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["leave_taken_grid"]->setStartRecordNumber(1);
					$GLOBALS["leave_taken_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["leave_taken_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["leave_taken_grid"]->EmployeeID->setSessionValue($GLOBALS["leave_taken_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("employee_obligation", $detailTblVar)) {
				if (!isset($GLOBALS["employee_obligation_grid"]))
					$GLOBALS["employee_obligation_grid"] = new employee_obligation_grid();
				if ($GLOBALS["employee_obligation_grid"]->DetailEdit) {
					$GLOBALS["employee_obligation_grid"]->CurrentMode = "edit";
					$GLOBALS["employee_obligation_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["employee_obligation_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["employee_obligation_grid"]->setStartRecordNumber(1);
					$GLOBALS["employee_obligation_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["employee_obligation_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["employee_obligation_grid"]->EmployeeID->setSessionValue($GLOBALS["employee_obligation_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("employee_income", $detailTblVar)) {
				if (!isset($GLOBALS["employee_income_grid"]))
					$GLOBALS["employee_income_grid"] = new employee_income_grid();
				if ($GLOBALS["employee_income_grid"]->DetailEdit) {
					$GLOBALS["employee_income_grid"]->CurrentMode = "edit";
					$GLOBALS["employee_income_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["employee_income_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["employee_income_grid"]->setStartRecordNumber(1);
					$GLOBALS["employee_income_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["employee_income_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["employee_income_grid"]->EmployeeID->setSessionValue($GLOBALS["employee_income_grid"]->EmployeeID->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("employmentlist.php"), "", $this->TableVar, TRUE);
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
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
					break;
				case "x_SubstantivePosition":
					break;
				case "x_AppraisalStatus":
					break;
				case "x_SalaryScale":
					break;
				case "x_EmploymentType":
					break;
				case "x_EmploymentStatus":
					break;
				case "x_ExitReason":
					break;
				case "x_RetirementType":
					break;
				case "x_SalaryNotch":
					break;
				case "x_ThirdParties":
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
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
							break;
						case "x_SubstantivePosition":
							break;
						case "x_AppraisalStatus":
							break;
						case "x_SalaryScale":
							break;
						case "x_EmploymentType":
							break;
						case "x_EmploymentStatus":
							break;
						case "x_ExitReason":
							break;
						case "x_RetirementType":
							break;
						case "x_SalaryNotch":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							$row[2] = FormatNumber($row[2], 2, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_ThirdParties":
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

		$rs = $this->GetFieldValues("FormValue");

	/*	if ($rs["EmploymentStatus"] == 3){
			$(this).fields("ExitReason").visible(true);
			$(this).fields("RetirementType").visible(true);
			} */
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