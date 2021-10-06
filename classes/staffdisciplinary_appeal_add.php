<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staffdisciplinary_appeal_add extends staffdisciplinary_appeal
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staffdisciplinary_appeal';

	// Page object name
	public $PageObjName = "staffdisciplinary_appeal_add";

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

		// Table object (staffdisciplinary_appeal)
		if (!isset($GLOBALS["staffdisciplinary_appeal"]) || get_class($GLOBALS["staffdisciplinary_appeal"]) == PROJECT_NAMESPACE . "staffdisciplinary_appeal") {
			$GLOBALS["staffdisciplinary_appeal"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["staffdisciplinary_appeal"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (staff)
		if (!isset($GLOBALS['staff']))
			$GLOBALS['staff'] = new staff();

		// Table object (staffdisciplinary_case)
		if (!isset($GLOBALS['staffdisciplinary_case']))
			$GLOBALS['staffdisciplinary_case'] = new staffdisciplinary_case();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staffdisciplinary_appeal');

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
		global $staffdisciplinary_appeal;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staffdisciplinary_appeal);
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
					if ($pageName == "staffdisciplinary_appealview.php")
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
			$key .= @$ar['OffenseCode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['AppealNo'];
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
			$this->AppealNo->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("staffdisciplinary_appeallist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->EmployeeID->setVisibility();
		$this->CaseNo->Visible = FALSE;
		$this->OffenseCode->setVisibility();
		$this->AppealNo->Visible = FALSE;
		$this->DateOfAppealLetter->setVisibility();
		$this->DateAppealReceived->setVisibility();
		$this->DateConcluded->setVisibility();
		$this->AppealStatus->setVisibility();
		$this->LastUpdate->setVisibility();
		$this->AppealNotes->setVisibility();
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
		$this->setupLookupOptions($this->AppealStatus);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("staffdisciplinary_appeallist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("EmployeeID") !== NULL) {
				$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
				$this->setKey("EmployeeID", $this->EmployeeID->CurrentValue); // Set up key
			} else {
				$this->setKey("EmployeeID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("CaseNo") !== NULL) {
				$this->CaseNo->setQueryStringValue(Get("CaseNo"));
				$this->setKey("CaseNo", $this->CaseNo->CurrentValue); // Set up key
			} else {
				$this->setKey("CaseNo", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("OffenseCode") !== NULL) {
				$this->OffenseCode->setQueryStringValue(Get("OffenseCode"));
				$this->setKey("OffenseCode", $this->OffenseCode->CurrentValue); // Set up key
			} else {
				$this->setKey("OffenseCode", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("AppealNo") !== NULL) {
				$this->AppealNo->setQueryStringValue(Get("AppealNo"));
				$this->setKey("AppealNo", $this->AppealNo->CurrentValue); // Set up key
			} else {
				$this->setKey("AppealNo", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("staffdisciplinary_appeallist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->GetAddUrl();
					if (GetPageName($returnUrl) == "staffdisciplinary_appeallist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "staffdisciplinary_appealview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->CaseNo->CurrentValue = NULL;
		$this->CaseNo->OldValue = $this->CaseNo->CurrentValue;
		$this->OffenseCode->CurrentValue = NULL;
		$this->OffenseCode->OldValue = $this->OffenseCode->CurrentValue;
		$this->AppealNo->CurrentValue = NULL;
		$this->AppealNo->OldValue = $this->AppealNo->CurrentValue;
		$this->DateOfAppealLetter->CurrentValue = NULL;
		$this->DateOfAppealLetter->OldValue = $this->DateOfAppealLetter->CurrentValue;
		$this->DateAppealReceived->CurrentValue = NULL;
		$this->DateAppealReceived->OldValue = $this->DateAppealReceived->CurrentValue;
		$this->DateConcluded->CurrentValue = NULL;
		$this->DateConcluded->OldValue = $this->DateConcluded->CurrentValue;
		$this->AppealStatus->CurrentValue = NULL;
		$this->AppealStatus->OldValue = $this->AppealStatus->CurrentValue;
		$this->LastUpdate->CurrentValue = NULL;
		$this->LastUpdate->OldValue = $this->LastUpdate->CurrentValue;
		$this->AppealNotes->CurrentValue = NULL;
		$this->AppealNotes->OldValue = $this->AppealNotes->CurrentValue;
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

		// Check field name 'OffenseCode' first before field var 'x_OffenseCode'
		$val = $CurrentForm->hasValue("OffenseCode") ? $CurrentForm->getValue("OffenseCode") : $CurrentForm->getValue("x_OffenseCode");
		if (!$this->OffenseCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OffenseCode->Visible = FALSE; // Disable update for API request
			else
				$this->OffenseCode->setFormValue($val);
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

		// Check field name 'LastUpdate' first before field var 'x_LastUpdate'
		$val = $CurrentForm->hasValue("LastUpdate") ? $CurrentForm->getValue("LastUpdate") : $CurrentForm->getValue("x_LastUpdate");
		if (!$this->LastUpdate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastUpdate->Visible = FALSE; // Disable update for API request
			else
				$this->LastUpdate->setFormValue($val);
			$this->LastUpdate->CurrentValue = UnFormatDateTime($this->LastUpdate->CurrentValue, 0);
		}

		// Check field name 'AppealNotes' first before field var 'x_AppealNotes'
		$val = $CurrentForm->hasValue("AppealNotes") ? $CurrentForm->getValue("AppealNotes") : $CurrentForm->getValue("x_AppealNotes");
		if (!$this->AppealNotes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AppealNotes->Visible = FALSE; // Disable update for API request
			else
				$this->AppealNotes->setFormValue($val);
		}

		// Check field name 'CaseNo' first before field var 'x_CaseNo'
		$val = $CurrentForm->hasValue("CaseNo") ? $CurrentForm->getValue("CaseNo") : $CurrentForm->getValue("x_CaseNo");
		if (!$this->CaseNo->IsDetailKey)
			$this->CaseNo->setFormValue($val);

		// Check field name 'AppealNo' first before field var 'x_AppealNo'
		$val = $CurrentForm->hasValue("AppealNo") ? $CurrentForm->getValue("AppealNo") : $CurrentForm->getValue("x_AppealNo");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->CaseNo->CurrentValue = $this->CaseNo->FormValue;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->OffenseCode->CurrentValue = $this->OffenseCode->FormValue;
		$this->DateOfAppealLetter->CurrentValue = $this->DateOfAppealLetter->FormValue;
		$this->DateOfAppealLetter->CurrentValue = UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0);
		$this->DateAppealReceived->CurrentValue = $this->DateAppealReceived->FormValue;
		$this->DateAppealReceived->CurrentValue = UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0);
		$this->DateConcluded->CurrentValue = $this->DateConcluded->FormValue;
		$this->DateConcluded->CurrentValue = UnFormatDateTime($this->DateConcluded->CurrentValue, 0);
		$this->AppealStatus->CurrentValue = $this->AppealStatus->FormValue;
		$this->LastUpdate->CurrentValue = $this->LastUpdate->FormValue;
		$this->LastUpdate->CurrentValue = UnFormatDateTime($this->LastUpdate->CurrentValue, 0);
		$this->AppealNotes->CurrentValue = $this->AppealNotes->FormValue;
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
		$this->AppealNo->setDbValue($row['AppealNo']);
		$this->DateOfAppealLetter->setDbValue($row['DateOfAppealLetter']);
		$this->DateAppealReceived->setDbValue($row['DateAppealReceived']);
		$this->DateConcluded->setDbValue($row['DateConcluded']);
		$this->AppealStatus->setDbValue($row['AppealStatus']);
		$this->LastUpdate->setDbValue($row['LastUpdate']);
		$this->AppealNotes->setDbValue($row['AppealNotes']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['CaseNo'] = $this->CaseNo->CurrentValue;
		$row['OffenseCode'] = $this->OffenseCode->CurrentValue;
		$row['AppealNo'] = $this->AppealNo->CurrentValue;
		$row['DateOfAppealLetter'] = $this->DateOfAppealLetter->CurrentValue;
		$row['DateAppealReceived'] = $this->DateAppealReceived->CurrentValue;
		$row['DateConcluded'] = $this->DateConcluded->CurrentValue;
		$row['AppealStatus'] = $this->AppealStatus->CurrentValue;
		$row['LastUpdate'] = $this->LastUpdate->CurrentValue;
		$row['AppealNotes'] = $this->AppealNotes->CurrentValue;
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
		if (strval($this->getKey("AppealNo")) != "")
			$this->AppealNo->OldValue = $this->getKey("AppealNo"); // AppealNo
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
		// AppealNo
		// DateOfAppealLetter
		// DateAppealReceived
		// DateConcluded
		// AppealStatus
		// LastUpdate
		// AppealNotes

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// CaseNo
			$this->CaseNo->ViewValue = $this->CaseNo->CurrentValue;
			$this->CaseNo->ViewCustomAttributes = "";

			// OffenseCode
			$this->OffenseCode->ViewValue = $this->OffenseCode->CurrentValue;
			$this->OffenseCode->ViewCustomAttributes = "";

			// AppealNo
			$this->AppealNo->ViewValue = $this->AppealNo->CurrentValue;
			$this->AppealNo->ViewCustomAttributes = "";

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

			// LastUpdate
			$this->LastUpdate->ViewValue = $this->LastUpdate->CurrentValue;
			$this->LastUpdate->ViewValue = FormatDateTime($this->LastUpdate->ViewValue, 0);
			$this->LastUpdate->ViewCustomAttributes = "";

			// AppealNotes
			$this->AppealNotes->ViewValue = $this->AppealNotes->CurrentValue;
			$this->AppealNotes->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";
			$this->OffenseCode->TooltipValue = "";

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

			// LastUpdate
			$this->LastUpdate->LinkCustomAttributes = "";
			$this->LastUpdate->HrefValue = "";
			$this->LastUpdate->TooltipValue = "";

			// AppealNotes
			$this->AppealNotes->LinkCustomAttributes = "";
			$this->AppealNotes->HrefValue = "";
			$this->AppealNotes->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			if ($this->EmployeeID->getSessionValue() != "") {
				$this->EmployeeID->CurrentValue = $this->EmployeeID->getSessionValue();
				$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
				$this->EmployeeID->ViewCustomAttributes = "";
			} else {
				$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
				$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());
			}

			// OffenseCode
			$this->OffenseCode->EditAttrs["class"] = "form-control";
			$this->OffenseCode->EditCustomAttributes = "";
			if ($this->OffenseCode->getSessionValue() != "") {
				$this->OffenseCode->CurrentValue = $this->OffenseCode->getSessionValue();
				$this->OffenseCode->ViewValue = $this->OffenseCode->CurrentValue;
				$this->OffenseCode->ViewCustomAttributes = "";
			} else {
				$this->OffenseCode->EditValue = HtmlEncode($this->OffenseCode->CurrentValue);
				$this->OffenseCode->PlaceHolder = RemoveHtml($this->OffenseCode->caption());
			}

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

			// LastUpdate
			$this->LastUpdate->EditAttrs["class"] = "form-control";
			$this->LastUpdate->EditCustomAttributes = "";
			$this->LastUpdate->EditValue = HtmlEncode(FormatDateTime($this->LastUpdate->CurrentValue, 8));
			$this->LastUpdate->PlaceHolder = RemoveHtml($this->LastUpdate->caption());

			// AppealNotes
			$this->AppealNotes->EditAttrs["class"] = "form-control";
			$this->AppealNotes->EditCustomAttributes = "";
			$this->AppealNotes->EditValue = HtmlEncode($this->AppealNotes->CurrentValue);
			$this->AppealNotes->PlaceHolder = RemoveHtml($this->AppealNotes->caption());

			// Add refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// OffenseCode
			$this->OffenseCode->LinkCustomAttributes = "";
			$this->OffenseCode->HrefValue = "";

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

			// LastUpdate
			$this->LastUpdate->LinkCustomAttributes = "";
			$this->LastUpdate->HrefValue = "";

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
		if ($this->OffenseCode->Required) {
			if (!$this->OffenseCode->IsDetailKey && $this->OffenseCode->FormValue != NULL && $this->OffenseCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OffenseCode->caption(), $this->OffenseCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OffenseCode->FormValue)) {
			AddMessage($FormError, $this->OffenseCode->errorMessage());
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
		if ($this->LastUpdate->Required) {
			if (!$this->LastUpdate->IsDetailKey && $this->LastUpdate->FormValue != NULL && $this->LastUpdate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastUpdate->caption(), $this->LastUpdate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->LastUpdate->FormValue)) {
			AddMessage($FormError, $this->LastUpdate->errorMessage());
		}
		if ($this->AppealNotes->Required) {
			if (!$this->AppealNotes->IsDetailKey && $this->AppealNotes->FormValue != NULL && $this->AppealNotes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AppealNotes->caption(), $this->AppealNotes->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// OffenseCode
		$this->OffenseCode->setDbValueDef($rsnew, $this->OffenseCode->CurrentValue, 0, FALSE);

		// DateOfAppealLetter
		$this->DateOfAppealLetter->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfAppealLetter->CurrentValue, 0), NULL, FALSE);

		// DateAppealReceived
		$this->DateAppealReceived->setDbValueDef($rsnew, UnFormatDateTime($this->DateAppealReceived->CurrentValue, 0), NULL, FALSE);

		// DateConcluded
		$this->DateConcluded->setDbValueDef($rsnew, UnFormatDateTime($this->DateConcluded->CurrentValue, 0), NULL, FALSE);

		// AppealStatus
		$this->AppealStatus->setDbValueDef($rsnew, $this->AppealStatus->CurrentValue, NULL, FALSE);

		// LastUpdate
		$this->LastUpdate->setDbValueDef($rsnew, UnFormatDateTime($this->LastUpdate->CurrentValue, 0), NULL, FALSE);

		// AppealNotes
		$this->AppealNotes->setDbValueDef($rsnew, $this->AppealNotes->CurrentValue, NULL, FALSE);

		// CaseNo
		if ($this->CaseNo->getSessionValue() != "") {
			$rsnew['CaseNo'] = $this->CaseNo->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['EmployeeID']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['CaseNo']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['OffenseCode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
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
			if ($masterTblVar == "staffdisciplinary_case") {
				$validMaster = TRUE;
				if (($parm = Get("fk_EmployeeID", Get("EmployeeID"))) !== NULL) {
					$GLOBALS["staffdisciplinary_case"]->EmployeeID->setQueryStringValue($parm);
					$this->EmployeeID->setQueryStringValue($GLOBALS["staffdisciplinary_case"]->EmployeeID->QueryStringValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->QueryStringValue);
					if (!is_numeric($GLOBALS["staffdisciplinary_case"]->EmployeeID->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_CaseNo", Get("CaseNo"))) !== NULL) {
					$GLOBALS["staffdisciplinary_case"]->CaseNo->setQueryStringValue($parm);
					$this->CaseNo->setQueryStringValue($GLOBALS["staffdisciplinary_case"]->CaseNo->QueryStringValue);
					$this->CaseNo->setSessionValue($this->CaseNo->QueryStringValue);
					if (!is_numeric($GLOBALS["staffdisciplinary_case"]->CaseNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_OffenseCode", Get("OffenseCode"))) !== NULL) {
					$GLOBALS["staffdisciplinary_case"]->OffenseCode->setQueryStringValue($parm);
					$this->OffenseCode->setQueryStringValue($GLOBALS["staffdisciplinary_case"]->OffenseCode->QueryStringValue);
					$this->OffenseCode->setSessionValue($this->OffenseCode->QueryStringValue);
					if (!is_numeric($GLOBALS["staffdisciplinary_case"]->OffenseCode->QueryStringValue))
						$validMaster = FALSE;
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
			if ($masterTblVar == "staffdisciplinary_case") {
				$validMaster = TRUE;
				if (($parm = Post("fk_EmployeeID", Post("EmployeeID"))) !== NULL) {
					$GLOBALS["staffdisciplinary_case"]->EmployeeID->setFormValue($parm);
					$this->EmployeeID->setFormValue($GLOBALS["staffdisciplinary_case"]->EmployeeID->FormValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->FormValue);
					if (!is_numeric($GLOBALS["staffdisciplinary_case"]->EmployeeID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_CaseNo", Post("CaseNo"))) !== NULL) {
					$GLOBALS["staffdisciplinary_case"]->CaseNo->setFormValue($parm);
					$this->CaseNo->setFormValue($GLOBALS["staffdisciplinary_case"]->CaseNo->FormValue);
					$this->CaseNo->setSessionValue($this->CaseNo->FormValue);
					if (!is_numeric($GLOBALS["staffdisciplinary_case"]->CaseNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_OffenseCode", Post("OffenseCode"))) !== NULL) {
					$GLOBALS["staffdisciplinary_case"]->OffenseCode->setFormValue($parm);
					$this->OffenseCode->setFormValue($GLOBALS["staffdisciplinary_case"]->OffenseCode->FormValue);
					$this->OffenseCode->setSessionValue($this->OffenseCode->FormValue);
					if (!is_numeric($GLOBALS["staffdisciplinary_case"]->OffenseCode->FormValue))
						$validMaster = FALSE;
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

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "staffdisciplinary_case") {
				if ($this->EmployeeID->CurrentValue == "")
					$this->EmployeeID->setSessionValue("");
				if ($this->CaseNo->CurrentValue == "")
					$this->CaseNo->setSessionValue("");
				if ($this->OffenseCode->CurrentValue == "")
					$this->OffenseCode->setSessionValue("");
			}
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("staffdisciplinary_appeallist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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