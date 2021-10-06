<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staffqualifications_academic_edit extends staffqualifications_academic
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staffqualifications_academic';

	// Page object name
	public $PageObjName = "staffqualifications_academic_edit";

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

		// Table object (staffqualifications_academic)
		if (!isset($GLOBALS["staffqualifications_academic"]) || get_class($GLOBALS["staffqualifications_academic"]) == PROJECT_NAMESPACE . "staffqualifications_academic") {
			$GLOBALS["staffqualifications_academic"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["staffqualifications_academic"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staffqualifications_academic');

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
		global $staffqualifications_academic;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staffqualifications_academic);
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
					if ($pageName == "staffqualifications_academicview.php")
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
			$key .= @$ar['QualificationLevel'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['YearObtained'];
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
					$this->terminate(GetUrl("staffqualifications_academiclist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->QualificationLevel->setVisibility();
		$this->QualificationRemarks->setVisibility();
		$this->AwardingInstitution->setVisibility();
		$this->FromYear->setVisibility();
		$this->YearObtained->setVisibility();
		$this->AcademicCertificate->setVisibility();
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
		$this->setupLookupOptions($this->QualificationLevel);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("staffqualifications_academiclist.php");
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
			if (Get("QualificationLevel") !== NULL) {
				$this->QualificationLevel->setQueryStringValue(Get("QualificationLevel"));
				$this->QualificationLevel->setOldValue($this->QualificationLevel->QueryStringValue);
			} elseif (Key(1) !== NULL) {
				$this->QualificationLevel->setQueryStringValue(Key(1));
				$this->QualificationLevel->setOldValue($this->QualificationLevel->QueryStringValue);
			} elseif (Post("QualificationLevel") !== NULL) {
				$this->QualificationLevel->setFormValue(Post("QualificationLevel"));
				$this->QualificationLevel->setOldValue($this->QualificationLevel->FormValue);
			} elseif (Route(3) !== NULL) {
				$this->QualificationLevel->setQueryStringValue(Route(3));
				$this->QualificationLevel->setOldValue($this->QualificationLevel->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}
			if (Get("YearObtained") !== NULL) {
				$this->YearObtained->setQueryStringValue(Get("YearObtained"));
				$this->YearObtained->setOldValue($this->YearObtained->QueryStringValue);
			} elseif (Key(2) !== NULL) {
				$this->YearObtained->setQueryStringValue(Key(2));
				$this->YearObtained->setOldValue($this->YearObtained->QueryStringValue);
			} elseif (Post("YearObtained") !== NULL) {
				$this->YearObtained->setFormValue(Post("YearObtained"));
				$this->YearObtained->setOldValue($this->YearObtained->FormValue);
			} elseif (Route(4) !== NULL) {
				$this->YearObtained->setQueryStringValue(Route(4));
				$this->YearObtained->setOldValue($this->YearObtained->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_QualificationLevel")) {
					$this->QualificationLevel->setFormValue($CurrentForm->getValue("x_QualificationLevel"));
				}
				if ($CurrentForm->hasValue("x_YearObtained")) {
					$this->YearObtained->setFormValue($CurrentForm->getValue("x_YearObtained"));
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
				if (Get("QualificationLevel") !== NULL) {
					$this->QualificationLevel->setQueryStringValue(Get("QualificationLevel"));
					$loadByQuery = TRUE;
				} elseif (Route(3) !== NULL) {
					$this->QualificationLevel->setQueryStringValue(Route(3));
					$loadByQuery = TRUE;
				} else {
					$this->QualificationLevel->CurrentValue = NULL;
				}
				if (Get("YearObtained") !== NULL) {
					$this->YearObtained->setQueryStringValue(Get("YearObtained"));
					$loadByQuery = TRUE;
				} elseif (Route(4) !== NULL) {
					$this->YearObtained->setQueryStringValue(Route(4));
					$loadByQuery = TRUE;
				} else {
					$this->YearObtained->CurrentValue = NULL;
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
				$this->terminate("staffqualifications_academiclist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->EmployeeID->CurrentValue != NULL && $this->QualificationLevel->CurrentValue != NULL && $this->YearObtained->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->EmployeeID->CurrentValue, $rs->fields('EmployeeID')) && SameString($this->QualificationLevel->CurrentValue, $rs->fields('QualificationLevel')) && SameString($this->YearObtained->CurrentValue, $rs->fields('YearObtained'))) {
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
					$this->terminate("staffqualifications_academiclist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "staffqualifications_academiclist.php")
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
		$this->AcademicCertificate->Upload->Index = $CurrentForm->Index;
		$this->AcademicCertificate->Upload->uploadFile();
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

		// Check field name 'QualificationLevel' first before field var 'x_QualificationLevel'
		$val = $CurrentForm->hasValue("QualificationLevel") ? $CurrentForm->getValue("QualificationLevel") : $CurrentForm->getValue("x_QualificationLevel");
		if (!$this->QualificationLevel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->QualificationLevel->Visible = FALSE; // Disable update for API request
			else
				$this->QualificationLevel->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_QualificationLevel"))
			$this->QualificationLevel->setOldValue($CurrentForm->getValue("o_QualificationLevel"));

		// Check field name 'QualificationRemarks' first before field var 'x_QualificationRemarks'
		$val = $CurrentForm->hasValue("QualificationRemarks") ? $CurrentForm->getValue("QualificationRemarks") : $CurrentForm->getValue("x_QualificationRemarks");
		if (!$this->QualificationRemarks->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->QualificationRemarks->Visible = FALSE; // Disable update for API request
			else
				$this->QualificationRemarks->setFormValue($val);
		}

		// Check field name 'AwardingInstitution' first before field var 'x_AwardingInstitution'
		$val = $CurrentForm->hasValue("AwardingInstitution") ? $CurrentForm->getValue("AwardingInstitution") : $CurrentForm->getValue("x_AwardingInstitution");
		if (!$this->AwardingInstitution->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AwardingInstitution->Visible = FALSE; // Disable update for API request
			else
				$this->AwardingInstitution->setFormValue($val);
		}

		// Check field name 'FromYear' first before field var 'x_FromYear'
		$val = $CurrentForm->hasValue("FromYear") ? $CurrentForm->getValue("FromYear") : $CurrentForm->getValue("x_FromYear");
		if (!$this->FromYear->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FromYear->Visible = FALSE; // Disable update for API request
			else
				$this->FromYear->setFormValue($val);
		}

		// Check field name 'YearObtained' first before field var 'x_YearObtained'
		$val = $CurrentForm->hasValue("YearObtained") ? $CurrentForm->getValue("YearObtained") : $CurrentForm->getValue("x_YearObtained");
		if (!$this->YearObtained->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->YearObtained->Visible = FALSE; // Disable update for API request
			else
				$this->YearObtained->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_YearObtained"))
			$this->YearObtained->setOldValue($CurrentForm->getValue("o_YearObtained"));
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->QualificationLevel->CurrentValue = $this->QualificationLevel->FormValue;
		$this->QualificationRemarks->CurrentValue = $this->QualificationRemarks->FormValue;
		$this->AwardingInstitution->CurrentValue = $this->AwardingInstitution->FormValue;
		$this->FromYear->CurrentValue = $this->FromYear->FormValue;
		$this->YearObtained->CurrentValue = $this->YearObtained->FormValue;
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
		$this->QualificationLevel->setDbValue($row['QualificationLevel']);
		$this->QualificationRemarks->setDbValue($row['QualificationRemarks']);
		$this->AwardingInstitution->setDbValue($row['AwardingInstitution']);
		$this->FromYear->setDbValue($row['FromYear']);
		$this->YearObtained->setDbValue($row['YearObtained']);
		$this->AcademicCertificate->Upload->DbValue = $row['AcademicCertificate'];
		if (is_array($this->AcademicCertificate->Upload->DbValue) || is_object($this->AcademicCertificate->Upload->DbValue)) // Byte array
			$this->AcademicCertificate->Upload->DbValue = BytesToString($this->AcademicCertificate->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['QualificationLevel'] = NULL;
		$row['QualificationRemarks'] = NULL;
		$row['AwardingInstitution'] = NULL;
		$row['FromYear'] = NULL;
		$row['YearObtained'] = NULL;
		$row['AcademicCertificate'] = NULL;
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
		if (strval($this->getKey("QualificationLevel")) != "")
			$this->QualificationLevel->OldValue = $this->getKey("QualificationLevel"); // QualificationLevel
		else
			$validKey = FALSE;
		if (strval($this->getKey("YearObtained")) != "")
			$this->YearObtained->OldValue = $this->getKey("YearObtained"); // YearObtained
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
		// QualificationLevel
		// QualificationRemarks
		// AwardingInstitution
		// FromYear
		// YearObtained
		// AcademicCertificate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// QualificationLevel
			$curVal = strval($this->QualificationLevel->CurrentValue);
			if ($curVal != "") {
				$this->QualificationLevel->ViewValue = $this->QualificationLevel->lookupCacheOption($curVal);
				if ($this->QualificationLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->QualificationLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->QualificationLevel->ViewValue = $this->QualificationLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->QualificationLevel->ViewValue = $this->QualificationLevel->CurrentValue;
					}
				}
			} else {
				$this->QualificationLevel->ViewValue = NULL;
			}
			$this->QualificationLevel->ViewCustomAttributes = "";

			// QualificationRemarks
			$this->QualificationRemarks->ViewValue = $this->QualificationRemarks->CurrentValue;
			$this->QualificationRemarks->ViewCustomAttributes = "";

			// AwardingInstitution
			$this->AwardingInstitution->ViewValue = $this->AwardingInstitution->CurrentValue;
			$this->AwardingInstitution->ViewCustomAttributes = "";

			// FromYear
			$this->FromYear->ViewValue = $this->FromYear->CurrentValue;
			$this->FromYear->ViewCustomAttributes = "";

			// YearObtained
			$this->YearObtained->ViewValue = $this->YearObtained->CurrentValue;
			$this->YearObtained->ViewCustomAttributes = "";

			// AcademicCertificate
			if (!EmptyValue($this->AcademicCertificate->Upload->DbValue)) {
				$this->AcademicCertificate->ViewValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->QualificationLevel->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->YearObtained->CurrentValue;
				$this->AcademicCertificate->IsBlobImage = IsImageFile(ContentExtension($this->AcademicCertificate->Upload->DbValue));
			} else {
				$this->AcademicCertificate->ViewValue = "";
			}
			$this->AcademicCertificate->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// QualificationLevel
			$this->QualificationLevel->LinkCustomAttributes = "";
			$this->QualificationLevel->HrefValue = "";
			$this->QualificationLevel->TooltipValue = "";

			// QualificationRemarks
			$this->QualificationRemarks->LinkCustomAttributes = "";
			$this->QualificationRemarks->HrefValue = "";
			$this->QualificationRemarks->TooltipValue = "";

			// AwardingInstitution
			$this->AwardingInstitution->LinkCustomAttributes = "";
			$this->AwardingInstitution->HrefValue = "";
			$this->AwardingInstitution->TooltipValue = "";

			// FromYear
			$this->FromYear->LinkCustomAttributes = "";
			$this->FromYear->HrefValue = "";
			$this->FromYear->TooltipValue = "";

			// YearObtained
			$this->YearObtained->LinkCustomAttributes = "";
			$this->YearObtained->HrefValue = "";
			$this->YearObtained->TooltipValue = "";

			// AcademicCertificate
			$this->AcademicCertificate->LinkCustomAttributes = "";
			if (!empty($this->AcademicCertificate->Upload->DbValue)) {
				$this->AcademicCertificate->HrefValue = GetFileUploadUrl($this->AcademicCertificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->QualificationLevel->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->YearObtained->CurrentValue);
				$this->AcademicCertificate->LinkAttrs["target"] = "";
				if ($this->AcademicCertificate->IsBlobImage && empty($this->AcademicCertificate->LinkAttrs["target"]))
					$this->AcademicCertificate->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->AcademicCertificate->HrefValue = FullUrl($this->AcademicCertificate->HrefValue, "href");
			} else {
				$this->AcademicCertificate->HrefValue = "";
			}
			$this->AcademicCertificate->ExportHrefValue = GetFileUploadUrl($this->AcademicCertificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->QualificationLevel->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->YearObtained->CurrentValue);
			$this->AcademicCertificate->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// QualificationLevel
			$this->QualificationLevel->EditCustomAttributes = "";
			$curVal = trim(strval($this->QualificationLevel->CurrentValue));
			if ($curVal != "")
				$this->QualificationLevel->ViewValue = $this->QualificationLevel->lookupCacheOption($curVal);
			else
				$this->QualificationLevel->ViewValue = $this->QualificationLevel->Lookup !== NULL && is_array($this->QualificationLevel->Lookup->Options) ? $curVal : NULL;
			if ($this->QualificationLevel->ViewValue !== NULL) { // Load from cache
				$this->QualificationLevel->EditValue = array_values($this->QualificationLevel->Lookup->Options);
				if ($this->QualificationLevel->ViewValue == "")
					$this->QualificationLevel->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $this->QualificationLevel->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->QualificationLevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->QualificationLevel->ViewValue = $this->QualificationLevel->displayValue($arwrk);
				} else {
					$this->QualificationLevel->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->QualificationLevel->EditValue = $arwrk;
			}

			// QualificationRemarks
			$this->QualificationRemarks->EditAttrs["class"] = "form-control";
			$this->QualificationRemarks->EditCustomAttributes = "";
			if (!$this->QualificationRemarks->Raw)
				$this->QualificationRemarks->CurrentValue = HtmlDecode($this->QualificationRemarks->CurrentValue);
			$this->QualificationRemarks->EditValue = HtmlEncode($this->QualificationRemarks->CurrentValue);
			$this->QualificationRemarks->PlaceHolder = RemoveHtml($this->QualificationRemarks->caption());

			// AwardingInstitution
			$this->AwardingInstitution->EditAttrs["class"] = "form-control";
			$this->AwardingInstitution->EditCustomAttributes = "";
			if (!$this->AwardingInstitution->Raw)
				$this->AwardingInstitution->CurrentValue = HtmlDecode($this->AwardingInstitution->CurrentValue);
			$this->AwardingInstitution->EditValue = HtmlEncode($this->AwardingInstitution->CurrentValue);
			$this->AwardingInstitution->PlaceHolder = RemoveHtml($this->AwardingInstitution->caption());

			// FromYear
			$this->FromYear->EditAttrs["class"] = "form-control";
			$this->FromYear->EditCustomAttributes = "";
			$this->FromYear->EditValue = HtmlEncode($this->FromYear->CurrentValue);
			$this->FromYear->PlaceHolder = RemoveHtml($this->FromYear->caption());

			// YearObtained
			$this->YearObtained->EditAttrs["class"] = "form-control";
			$this->YearObtained->EditCustomAttributes = "";
			$this->YearObtained->EditValue = HtmlEncode($this->YearObtained->CurrentValue);
			$this->YearObtained->PlaceHolder = RemoveHtml($this->YearObtained->caption());

			// AcademicCertificate
			$this->AcademicCertificate->EditAttrs["class"] = "form-control";
			$this->AcademicCertificate->EditCustomAttributes = "";
			if (!EmptyValue($this->AcademicCertificate->Upload->DbValue)) {
				$this->AcademicCertificate->EditValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->QualificationLevel->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->YearObtained->CurrentValue;
				$this->AcademicCertificate->IsBlobImage = IsImageFile(ContentExtension($this->AcademicCertificate->Upload->DbValue));
			} else {
				$this->AcademicCertificate->EditValue = "";
			}
			if ($this->isShow())
				RenderUploadField($this->AcademicCertificate);

			// Edit refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// QualificationLevel
			$this->QualificationLevel->LinkCustomAttributes = "";
			$this->QualificationLevel->HrefValue = "";

			// QualificationRemarks
			$this->QualificationRemarks->LinkCustomAttributes = "";
			$this->QualificationRemarks->HrefValue = "";

			// AwardingInstitution
			$this->AwardingInstitution->LinkCustomAttributes = "";
			$this->AwardingInstitution->HrefValue = "";

			// FromYear
			$this->FromYear->LinkCustomAttributes = "";
			$this->FromYear->HrefValue = "";

			// YearObtained
			$this->YearObtained->LinkCustomAttributes = "";
			$this->YearObtained->HrefValue = "";

			// AcademicCertificate
			$this->AcademicCertificate->LinkCustomAttributes = "";
			if (!empty($this->AcademicCertificate->Upload->DbValue)) {
				$this->AcademicCertificate->HrefValue = GetFileUploadUrl($this->AcademicCertificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->QualificationLevel->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->YearObtained->CurrentValue);
				$this->AcademicCertificate->LinkAttrs["target"] = "";
				if ($this->AcademicCertificate->IsBlobImage && empty($this->AcademicCertificate->LinkAttrs["target"]))
					$this->AcademicCertificate->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->AcademicCertificate->HrefValue = FullUrl($this->AcademicCertificate->HrefValue, "href");
			} else {
				$this->AcademicCertificate->HrefValue = "";
			}
			$this->AcademicCertificate->ExportHrefValue = GetFileUploadUrl($this->AcademicCertificate, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->QualificationLevel->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->YearObtained->CurrentValue);
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
		if ($this->QualificationLevel->Required) {
			if (!$this->QualificationLevel->IsDetailKey && $this->QualificationLevel->FormValue != NULL && $this->QualificationLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->QualificationLevel->caption(), $this->QualificationLevel->RequiredErrorMessage));
			}
		}
		if ($this->QualificationRemarks->Required) {
			if (!$this->QualificationRemarks->IsDetailKey && $this->QualificationRemarks->FormValue != NULL && $this->QualificationRemarks->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->QualificationRemarks->caption(), $this->QualificationRemarks->RequiredErrorMessage));
			}
		}
		if ($this->AwardingInstitution->Required) {
			if (!$this->AwardingInstitution->IsDetailKey && $this->AwardingInstitution->FormValue != NULL && $this->AwardingInstitution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AwardingInstitution->caption(), $this->AwardingInstitution->RequiredErrorMessage));
			}
		}
		if ($this->FromYear->Required) {
			if (!$this->FromYear->IsDetailKey && $this->FromYear->FormValue != NULL && $this->FromYear->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FromYear->caption(), $this->FromYear->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FromYear->FormValue)) {
			AddMessage($FormError, $this->FromYear->errorMessage());
		}
		if ($this->YearObtained->Required) {
			if (!$this->YearObtained->IsDetailKey && $this->YearObtained->FormValue != NULL && $this->YearObtained->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->YearObtained->caption(), $this->YearObtained->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->YearObtained->FormValue)) {
			AddMessage($FormError, $this->YearObtained->errorMessage());
		}
		if ($this->AcademicCertificate->Required) {
			if ($this->AcademicCertificate->Upload->FileName == "" && !$this->AcademicCertificate->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->AcademicCertificate->caption(), $this->AcademicCertificate->RequiredErrorMessage));
			}
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

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// EmployeeID
			$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, $this->EmployeeID->ReadOnly);

			// QualificationLevel
			$this->QualificationLevel->setDbValueDef($rsnew, $this->QualificationLevel->CurrentValue, "", $this->QualificationLevel->ReadOnly);

			// QualificationRemarks
			$this->QualificationRemarks->setDbValueDef($rsnew, $this->QualificationRemarks->CurrentValue, NULL, $this->QualificationRemarks->ReadOnly);

			// AwardingInstitution
			$this->AwardingInstitution->setDbValueDef($rsnew, $this->AwardingInstitution->CurrentValue, NULL, $this->AwardingInstitution->ReadOnly);

			// FromYear
			$this->FromYear->setDbValueDef($rsnew, $this->FromYear->CurrentValue, NULL, $this->FromYear->ReadOnly);

			// YearObtained
			$this->YearObtained->setDbValueDef($rsnew, $this->YearObtained->CurrentValue, 0, $this->YearObtained->ReadOnly);

			// AcademicCertificate
			if ($this->AcademicCertificate->Visible && !$this->AcademicCertificate->ReadOnly && !$this->AcademicCertificate->Upload->KeepFile) {
				if ($this->AcademicCertificate->Upload->Value == NULL) {
					$rsnew['AcademicCertificate'] = NULL;
				} else {
					$rsnew['AcademicCertificate'] = $this->AcademicCertificate->Upload->Value;
				}
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

			// AcademicCertificate
			CleanUploadTempPath($this->AcademicCertificate, $this->AcademicCertificate->Upload->Index);
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("staffqualifications_academiclist.php"), "", $this->TableVar, TRUE);
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
				case "x_QualificationLevel":
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
						case "x_QualificationLevel":
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