<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class councillorship_add extends councillorship
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'councillorship';

	// Page object name
	public $PageObjName = "councillorship_add";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
		$this->CouncillorPhoto->setVisibility();
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

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("councillorshiplist.php");
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
			if (Get("LACode") !== NULL) {
				$this->LACode->setQueryStringValue(Get("LACode"));
				$this->setKey("LACode", $this->LACode->CurrentValue); // Set up key
			} else {
				$this->setKey("LACode", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("PositionInCouncil") !== NULL) {
				$this->PositionInCouncil->setQueryStringValue(Get("PositionInCouncil"));
				$this->setKey("PositionInCouncil", $this->PositionInCouncil->CurrentValue); // Set up key
			} else {
				$this->setKey("PositionInCouncil", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("CouncilTerm") !== NULL) {
				$this->CouncilTerm->setQueryStringValue(Get("CouncilTerm"));
				$this->setKey("CouncilTerm", $this->CouncilTerm->CurrentValue); // Set up key
			} else {
				$this->setKey("CouncilTerm", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("councillorshiplist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "councillorshiplist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "councillorshipview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->CouncillorPhoto->Upload->Index = $CurrentForm->Index;
		$this->CouncillorPhoto->Upload->uploadFile();
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->EmployeeID->CurrentValue = NULL;
		$this->EmployeeID->OldValue = $this->EmployeeID->CurrentValue;
		$this->ProvinceCode->CurrentValue = NULL;
		$this->ProvinceCode->OldValue = $this->ProvinceCode->CurrentValue;
		$this->LACode->CurrentValue = NULL;
		$this->LACode->OldValue = $this->LACode->CurrentValue;
		$this->PoliticalParty->CurrentValue = NULL;
		$this->PoliticalParty->OldValue = $this->PoliticalParty->CurrentValue;
		$this->Occupation->CurrentValue = NULL;
		$this->Occupation->OldValue = $this->Occupation->CurrentValue;
		$this->PositionInCouncil->CurrentValue = NULL;
		$this->PositionInCouncil->OldValue = $this->PositionInCouncil->CurrentValue;
		$this->Committee->CurrentValue = NULL;
		$this->Committee->OldValue = $this->Committee->CurrentValue;
		$this->CommitteeRole->CurrentValue = NULL;
		$this->CommitteeRole->OldValue = $this->CommitteeRole->CurrentValue;
		$this->CouncilTerm->CurrentValue = NULL;
		$this->CouncilTerm->OldValue = $this->CouncilTerm->CurrentValue;
		$this->DateOfExit->CurrentValue = NULL;
		$this->DateOfExit->OldValue = $this->DateOfExit->CurrentValue;
		$this->Allowance->CurrentValue = NULL;
		$this->Allowance->OldValue = $this->Allowance->CurrentValue;
		$this->CouncillorTypeType->CurrentValue = NULL;
		$this->CouncillorTypeType->OldValue = $this->CouncillorTypeType->CurrentValue;
		$this->CouncillorshipStatus->CurrentValue = NULL;
		$this->CouncillorshipStatus->OldValue = $this->CouncillorshipStatus->CurrentValue;
		$this->ExitReason->CurrentValue = NULL;
		$this->ExitReason->OldValue = $this->ExitReason->CurrentValue;
		$this->RetirementType->CurrentValue = NULL;
		$this->RetirementType->OldValue = $this->RetirementType->CurrentValue;
		$this->CouncillorPhoto->Upload->DbValue = NULL;
		$this->CouncillorPhoto->OldValue = $this->CouncillorPhoto->Upload->DbValue;
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

		// Check field name 'PoliticalParty' first before field var 'x_PoliticalParty'
		$val = $CurrentForm->hasValue("PoliticalParty") ? $CurrentForm->getValue("PoliticalParty") : $CurrentForm->getValue("x_PoliticalParty");
		if (!$this->PoliticalParty->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PoliticalParty->Visible = FALSE; // Disable update for API request
			else
				$this->PoliticalParty->setFormValue($val);
		}

		// Check field name 'Occupation' first before field var 'x_Occupation'
		$val = $CurrentForm->hasValue("Occupation") ? $CurrentForm->getValue("Occupation") : $CurrentForm->getValue("x_Occupation");
		if (!$this->Occupation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Occupation->Visible = FALSE; // Disable update for API request
			else
				$this->Occupation->setFormValue($val);
		}

		// Check field name 'PositionInCouncil' first before field var 'x_PositionInCouncil'
		$val = $CurrentForm->hasValue("PositionInCouncil") ? $CurrentForm->getValue("PositionInCouncil") : $CurrentForm->getValue("x_PositionInCouncil");
		if (!$this->PositionInCouncil->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PositionInCouncil->Visible = FALSE; // Disable update for API request
			else
				$this->PositionInCouncil->setFormValue($val);
		}

		// Check field name 'Committee' first before field var 'x_Committee'
		$val = $CurrentForm->hasValue("Committee") ? $CurrentForm->getValue("Committee") : $CurrentForm->getValue("x_Committee");
		if (!$this->Committee->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Committee->Visible = FALSE; // Disable update for API request
			else
				$this->Committee->setFormValue($val);
		}

		// Check field name 'CommitteeRole' first before field var 'x_CommitteeRole'
		$val = $CurrentForm->hasValue("CommitteeRole") ? $CurrentForm->getValue("CommitteeRole") : $CurrentForm->getValue("x_CommitteeRole");
		if (!$this->CommitteeRole->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CommitteeRole->Visible = FALSE; // Disable update for API request
			else
				$this->CommitteeRole->setFormValue($val);
		}

		// Check field name 'CouncilTerm' first before field var 'x_CouncilTerm'
		$val = $CurrentForm->hasValue("CouncilTerm") ? $CurrentForm->getValue("CouncilTerm") : $CurrentForm->getValue("x_CouncilTerm");
		if (!$this->CouncilTerm->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CouncilTerm->Visible = FALSE; // Disable update for API request
			else
				$this->CouncilTerm->setFormValue($val);
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

		// Check field name 'Allowance' first before field var 'x_Allowance'
		$val = $CurrentForm->hasValue("Allowance") ? $CurrentForm->getValue("Allowance") : $CurrentForm->getValue("x_Allowance");
		if (!$this->Allowance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Allowance->Visible = FALSE; // Disable update for API request
			else
				$this->Allowance->setFormValue($val);
		}

		// Check field name 'CouncillorTypeType' first before field var 'x_CouncillorTypeType'
		$val = $CurrentForm->hasValue("CouncillorTypeType") ? $CurrentForm->getValue("CouncillorTypeType") : $CurrentForm->getValue("x_CouncillorTypeType");
		if (!$this->CouncillorTypeType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CouncillorTypeType->Visible = FALSE; // Disable update for API request
			else
				$this->CouncillorTypeType->setFormValue($val);
		}

		// Check field name 'ExitReason' first before field var 'x_ExitReason'
		$val = $CurrentForm->hasValue("ExitReason") ? $CurrentForm->getValue("ExitReason") : $CurrentForm->getValue("x_ExitReason");
		if (!$this->ExitReason->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExitReason->Visible = FALSE; // Disable update for API request
			else
				$this->ExitReason->setFormValue($val);
		}
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->PoliticalParty->CurrentValue = $this->PoliticalParty->FormValue;
		$this->Occupation->CurrentValue = $this->Occupation->FormValue;
		$this->PositionInCouncil->CurrentValue = $this->PositionInCouncil->FormValue;
		$this->Committee->CurrentValue = $this->Committee->FormValue;
		$this->CommitteeRole->CurrentValue = $this->CommitteeRole->FormValue;
		$this->CouncilTerm->CurrentValue = $this->CouncilTerm->FormValue;
		$this->DateOfExit->CurrentValue = $this->DateOfExit->FormValue;
		$this->DateOfExit->CurrentValue = UnFormatDateTime($this->DateOfExit->CurrentValue, 0);
		$this->Allowance->CurrentValue = $this->Allowance->FormValue;
		$this->CouncillorTypeType->CurrentValue = $this->CouncillorTypeType->FormValue;
		$this->ExitReason->CurrentValue = $this->ExitReason->FormValue;
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
		$this->PoliticalParty->setDbValue($row['PoliticalParty']);
		$this->Occupation->setDbValue($row['Occupation']);
		$this->PositionInCouncil->setDbValue($row['PositionInCouncil']);
		$this->Committee->setDbValue($row['Committee']);
		$this->CommitteeRole->setDbValue($row['CommitteeRole']);
		$this->CouncilTerm->setDbValue($row['CouncilTerm']);
		$this->DateOfExit->setDbValue($row['DateOfExit']);
		$this->Allowance->setDbValue($row['Allowance']);
		$this->CouncillorTypeType->setDbValue($row['CouncillorTypeType']);
		$this->CouncillorshipStatus->setDbValue($row['CouncillorshipStatus']);
		$this->ExitReason->setDbValue($row['ExitReason']);
		$this->RetirementType->setDbValue($row['RetirementType']);
		$this->CouncillorPhoto->Upload->DbValue = $row['CouncillorPhoto'];
		if (is_array($this->CouncillorPhoto->Upload->DbValue) || is_object($this->CouncillorPhoto->Upload->DbValue)) // Byte array
			$this->CouncillorPhoto->Upload->DbValue = BytesToString($this->CouncillorPhoto->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['EmployeeID'] = $this->EmployeeID->CurrentValue;
		$row['ProvinceCode'] = $this->ProvinceCode->CurrentValue;
		$row['LACode'] = $this->LACode->CurrentValue;
		$row['PoliticalParty'] = $this->PoliticalParty->CurrentValue;
		$row['Occupation'] = $this->Occupation->CurrentValue;
		$row['PositionInCouncil'] = $this->PositionInCouncil->CurrentValue;
		$row['Committee'] = $this->Committee->CurrentValue;
		$row['CommitteeRole'] = $this->CommitteeRole->CurrentValue;
		$row['CouncilTerm'] = $this->CouncilTerm->CurrentValue;
		$row['DateOfExit'] = $this->DateOfExit->CurrentValue;
		$row['Allowance'] = $this->Allowance->CurrentValue;
		$row['CouncillorTypeType'] = $this->CouncillorTypeType->CurrentValue;
		$row['CouncillorshipStatus'] = $this->CouncillorshipStatus->CurrentValue;
		$row['ExitReason'] = $this->ExitReason->CurrentValue;
		$row['RetirementType'] = $this->RetirementType->CurrentValue;
		$row['CouncillorPhoto'] = $this->CouncillorPhoto->Upload->DbValue;
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
		if (strval($this->getKey("LACode")) != "")
			$this->LACode->OldValue = $this->getKey("LACode"); // LACode
		else
			$validKey = FALSE;
		if (strval($this->getKey("PositionInCouncil")) != "")
			$this->PositionInCouncil->OldValue = $this->getKey("PositionInCouncil"); // PositionInCouncil
		else
			$validKey = FALSE;
		if (strval($this->getKey("CouncilTerm")) != "")
			$this->CouncilTerm->OldValue = $this->getKey("CouncilTerm"); // CouncilTerm
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

			// CouncillorPhoto
			if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
				$this->CouncillorPhoto->ViewValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue;
				$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
			} else {
				$this->CouncillorPhoto->ViewValue = "";
			}
			$this->CouncillorPhoto->ViewCustomAttributes = "";

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

			// CouncillorPhoto
			$this->CouncillorPhoto->LinkCustomAttributes = "";
			if (!empty($this->CouncillorPhoto->Upload->DbValue)) {
				$this->CouncillorPhoto->HrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
				$this->CouncillorPhoto->LinkAttrs["target"] = "";
				if ($this->CouncillorPhoto->IsBlobImage && empty($this->CouncillorPhoto->LinkAttrs["target"]))
					$this->CouncillorPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->CouncillorPhoto->HrefValue = FullUrl($this->CouncillorPhoto->HrefValue, "href");
			} else {
				$this->CouncillorPhoto->HrefValue = "";
			}
			$this->CouncillorPhoto->ExportHrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
			$this->CouncillorPhoto->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			if ($this->EmployeeID->getSessionValue() != "") {
				$this->EmployeeID->CurrentValue = $this->EmployeeID->getSessionValue();
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
			} else {
				$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
				$curVal = strval($this->EmployeeID->CurrentValue);
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
							$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
						}
					}
				} else {
					$this->EmployeeID->EditValue = NULL;
				}
				$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());
			}

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			if ($this->ProvinceCode->getSessionValue() != "") {
				$this->ProvinceCode->CurrentValue = $this->ProvinceCode->getSessionValue();
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
			} else {
				$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
				$curVal = strval($this->ProvinceCode->CurrentValue);
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
							$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
						}
					}
				} else {
					$this->ProvinceCode->EditValue = NULL;
				}
				$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());
			}

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`LACode`" . SearchString("=", $this->LACode->CurrentValue, DATATYPE_STRING, "");
					}
					$sqlWrk = $this->LACode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->LACode->EditValue = $arwrk;
				}
			}

			// PoliticalParty
			$this->PoliticalParty->EditAttrs["class"] = "form-control";
			$this->PoliticalParty->EditCustomAttributes = "";
			$curVal = trim(strval($this->PoliticalParty->CurrentValue));
			if ($curVal != "")
				$this->PoliticalParty->ViewValue = $this->PoliticalParty->lookupCacheOption($curVal);
			else
				$this->PoliticalParty->ViewValue = $this->PoliticalParty->Lookup !== NULL && is_array($this->PoliticalParty->Lookup->Options) ? $curVal : NULL;
			if ($this->PoliticalParty->ViewValue !== NULL) { // Load from cache
				$this->PoliticalParty->EditValue = array_values($this->PoliticalParty->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PoliticalParty`" . SearchString("=", $this->PoliticalParty->CurrentValue, DATATYPE_STRING, "");
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
			$curVal = trim(strval($this->Occupation->CurrentValue));
			if ($curVal != "")
				$this->Occupation->ViewValue = $this->Occupation->lookupCacheOption($curVal);
			else
				$this->Occupation->ViewValue = $this->Occupation->Lookup !== NULL && is_array($this->Occupation->Lookup->Options) ? $curVal : NULL;
			if ($this->Occupation->ViewValue !== NULL) { // Load from cache
				$this->Occupation->EditValue = array_values($this->Occupation->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`OccupationCode`" . SearchString("=", $this->Occupation->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->PositionInCouncil->CurrentValue));
			if ($curVal != "")
				$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->lookupCacheOption($curVal);
			else
				$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->Lookup !== NULL && is_array($this->PositionInCouncil->Lookup->Options) ? $curVal : NULL;
			if ($this->PositionInCouncil->ViewValue !== NULL) { // Load from cache
				$this->PositionInCouncil->EditValue = array_values($this->PositionInCouncil->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PositionCode`" . SearchString("=", $this->PositionInCouncil->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->Committee->CurrentValue));
			if ($curVal != "")
				$this->Committee->ViewValue = $this->Committee->lookupCacheOption($curVal);
			else
				$this->Committee->ViewValue = $this->Committee->Lookup !== NULL && is_array($this->Committee->Lookup->Options) ? $curVal : NULL;
			if ($this->Committee->ViewValue !== NULL) { // Load from cache
				$this->Committee->EditValue = array_values($this->Committee->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CommitteCode`" . SearchString("=", $this->Committee->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->CommitteeRole->CurrentValue));
			if ($curVal != "")
				$this->CommitteeRole->ViewValue = $this->CommitteeRole->lookupCacheOption($curVal);
			else
				$this->CommitteeRole->ViewValue = $this->CommitteeRole->Lookup !== NULL && is_array($this->CommitteeRole->Lookup->Options) ? $curVal : NULL;
			if ($this->CommitteeRole->ViewValue !== NULL) { // Load from cache
				$this->CommitteeRole->EditValue = array_values($this->CommitteeRole->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CommitteeRole`" . SearchString("=", $this->CommitteeRole->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->CouncilTerm->CurrentValue));
			if ($curVal != "")
				$this->CouncilTerm->ViewValue = $this->CouncilTerm->lookupCacheOption($curVal);
			else
				$this->CouncilTerm->ViewValue = $this->CouncilTerm->Lookup !== NULL && is_array($this->CouncilTerm->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncilTerm->ViewValue !== NULL) { // Load from cache
				$this->CouncilTerm->EditValue = array_values($this->CouncilTerm->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`TermStartYear`" . SearchString("=", $this->CouncilTerm->CurrentValue, DATATYPE_NUMBER, "");
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
			$this->DateOfExit->EditValue = HtmlEncode(FormatDateTime($this->DateOfExit->CurrentValue, 8));
			$this->DateOfExit->PlaceHolder = RemoveHtml($this->DateOfExit->caption());

			// Allowance
			$this->Allowance->EditAttrs["class"] = "form-control";
			$this->Allowance->EditCustomAttributes = "";
			if (!$this->Allowance->Raw)
				$this->Allowance->CurrentValue = HtmlDecode($this->Allowance->CurrentValue);
			$this->Allowance->EditValue = HtmlEncode($this->Allowance->CurrentValue);
			$this->Allowance->PlaceHolder = RemoveHtml($this->Allowance->caption());

			// CouncillorTypeType
			$this->CouncillorTypeType->EditAttrs["class"] = "form-control";
			$this->CouncillorTypeType->EditCustomAttributes = "";
			$curVal = trim(strval($this->CouncillorTypeType->CurrentValue));
			if ($curVal != "")
				$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->lookupCacheOption($curVal);
			else
				$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->Lookup !== NULL && is_array($this->CouncillorTypeType->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncillorTypeType->ViewValue !== NULL) { // Load from cache
				$this->CouncillorTypeType->EditValue = array_values($this->CouncillorTypeType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`CouncillorType`" . SearchString("=", $this->CouncillorTypeType->CurrentValue, DATATYPE_NUMBER, "");
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
					$filterWrk = "`CouncillorsipStatus`" . SearchString("=", $this->ExitReason->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ExitReason->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ExitReason->EditValue = $arwrk;
			}

			// CouncillorPhoto
			$this->CouncillorPhoto->EditAttrs["class"] = "form-control";
			$this->CouncillorPhoto->EditCustomAttributes = "";
			if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
				$this->CouncillorPhoto->EditValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue;
				$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
			} else {
				$this->CouncillorPhoto->EditValue = "";
			}
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->CouncillorPhoto);

			// Add refer script
			// EmployeeID

			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// PoliticalParty
			$this->PoliticalParty->LinkCustomAttributes = "";
			$this->PoliticalParty->HrefValue = "";

			// Occupation
			$this->Occupation->LinkCustomAttributes = "";
			$this->Occupation->HrefValue = "";

			// PositionInCouncil
			$this->PositionInCouncil->LinkCustomAttributes = "";
			$this->PositionInCouncil->HrefValue = "";

			// Committee
			$this->Committee->LinkCustomAttributes = "";
			$this->Committee->HrefValue = "";

			// CommitteeRole
			$this->CommitteeRole->LinkCustomAttributes = "";
			$this->CommitteeRole->HrefValue = "";

			// CouncilTerm
			$this->CouncilTerm->LinkCustomAttributes = "";
			$this->CouncilTerm->HrefValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";

			// Allowance
			$this->Allowance->LinkCustomAttributes = "";
			$this->Allowance->HrefValue = "";

			// CouncillorTypeType
			$this->CouncillorTypeType->LinkCustomAttributes = "";
			$this->CouncillorTypeType->HrefValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";

			// CouncillorPhoto
			$this->CouncillorPhoto->LinkCustomAttributes = "";
			if (!empty($this->CouncillorPhoto->Upload->DbValue)) {
				$this->CouncillorPhoto->HrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
				$this->CouncillorPhoto->LinkAttrs["target"] = "";
				if ($this->CouncillorPhoto->IsBlobImage && empty($this->CouncillorPhoto->LinkAttrs["target"]))
					$this->CouncillorPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->CouncillorPhoto->HrefValue = FullUrl($this->CouncillorPhoto->HrefValue, "href");
			} else {
				$this->CouncillorPhoto->HrefValue = "";
			}
			$this->CouncillorPhoto->ExportHrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
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
		if (!CheckInteger($this->ProvinceCode->FormValue)) {
			AddMessage($FormError, $this->ProvinceCode->errorMessage());
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->PoliticalParty->Required) {
			if (!$this->PoliticalParty->IsDetailKey && $this->PoliticalParty->FormValue != NULL && $this->PoliticalParty->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PoliticalParty->caption(), $this->PoliticalParty->RequiredErrorMessage));
			}
		}
		if ($this->Occupation->Required) {
			if (!$this->Occupation->IsDetailKey && $this->Occupation->FormValue != NULL && $this->Occupation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Occupation->caption(), $this->Occupation->RequiredErrorMessage));
			}
		}
		if ($this->PositionInCouncil->Required) {
			if (!$this->PositionInCouncil->IsDetailKey && $this->PositionInCouncil->FormValue != NULL && $this->PositionInCouncil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PositionInCouncil->caption(), $this->PositionInCouncil->RequiredErrorMessage));
			}
		}
		if ($this->Committee->Required) {
			if (!$this->Committee->IsDetailKey && $this->Committee->FormValue != NULL && $this->Committee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Committee->caption(), $this->Committee->RequiredErrorMessage));
			}
		}
		if ($this->CommitteeRole->Required) {
			if (!$this->CommitteeRole->IsDetailKey && $this->CommitteeRole->FormValue != NULL && $this->CommitteeRole->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CommitteeRole->caption(), $this->CommitteeRole->RequiredErrorMessage));
			}
		}
		if ($this->CouncilTerm->Required) {
			if (!$this->CouncilTerm->IsDetailKey && $this->CouncilTerm->FormValue != NULL && $this->CouncilTerm->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncilTerm->caption(), $this->CouncilTerm->RequiredErrorMessage));
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
		if ($this->Allowance->Required) {
			if (!$this->Allowance->IsDetailKey && $this->Allowance->FormValue != NULL && $this->Allowance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Allowance->caption(), $this->Allowance->RequiredErrorMessage));
			}
		}
		if ($this->CouncillorTypeType->Required) {
			if (!$this->CouncillorTypeType->IsDetailKey && $this->CouncillorTypeType->FormValue != NULL && $this->CouncillorTypeType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncillorTypeType->caption(), $this->CouncillorTypeType->RequiredErrorMessage));
			}
		}
		if ($this->ExitReason->Required) {
			if (!$this->ExitReason->IsDetailKey && $this->ExitReason->FormValue != NULL && $this->ExitReason->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExitReason->caption(), $this->ExitReason->RequiredErrorMessage));
			}
		}
		if ($this->CouncillorPhoto->Required) {
			if ($this->CouncillorPhoto->Upload->FileName == "" && !$this->CouncillorPhoto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->CouncillorPhoto->caption(), $this->CouncillorPhoto->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("councillor_allowance", $detailTblVar) && $GLOBALS["councillor_allowance"]->DetailAdd) {
			if (!isset($GLOBALS["councillor_allowance_grid"]))
				$GLOBALS["councillor_allowance_grid"] = new councillor_allowance_grid(); // Get detail page object
			$GLOBALS["councillor_allowance_grid"]->validateGridForm();
		}
		if (in_array("committee_appointed", $detailTblVar) && $GLOBALS["committee_appointed"]->DetailAdd) {
			if (!isset($GLOBALS["committee_appointed_grid"]))
				$GLOBALS["committee_appointed_grid"] = new committee_appointed_grid(); // Get detail page object
			$GLOBALS["committee_appointed_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// EmployeeID
		$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, 0, FALSE);

		// ProvinceCode
		$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, FALSE);

		// LACode
		$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", FALSE);

		// PoliticalParty
		$this->PoliticalParty->setDbValueDef($rsnew, $this->PoliticalParty->CurrentValue, NULL, FALSE);

		// Occupation
		$this->Occupation->setDbValueDef($rsnew, $this->Occupation->CurrentValue, NULL, FALSE);

		// PositionInCouncil
		$this->PositionInCouncil->setDbValueDef($rsnew, $this->PositionInCouncil->CurrentValue, 0, FALSE);

		// Committee
		$this->Committee->setDbValueDef($rsnew, $this->Committee->CurrentValue, NULL, FALSE);

		// CommitteeRole
		$this->CommitteeRole->setDbValueDef($rsnew, $this->CommitteeRole->CurrentValue, 0, FALSE);

		// CouncilTerm
		$this->CouncilTerm->setDbValueDef($rsnew, $this->CouncilTerm->CurrentValue, 0, FALSE);

		// DateOfExit
		$this->DateOfExit->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfExit->CurrentValue, 0), NULL, FALSE);

		// Allowance
		$this->Allowance->setDbValueDef($rsnew, $this->Allowance->CurrentValue, "", FALSE);

		// CouncillorTypeType
		$this->CouncillorTypeType->setDbValueDef($rsnew, $this->CouncillorTypeType->CurrentValue, 0, FALSE);

		// ExitReason
		$this->ExitReason->setDbValueDef($rsnew, $this->ExitReason->CurrentValue, NULL, FALSE);

		// CouncillorPhoto
		if ($this->CouncillorPhoto->Visible && !$this->CouncillorPhoto->Upload->KeepFile) {
			if ($this->CouncillorPhoto->Upload->Value == NULL) {
				$rsnew['CouncillorPhoto'] = NULL;
			} else {
				$rsnew['CouncillorPhoto'] = $this->CouncillorPhoto->Upload->Value;
			}
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
		if ($insertRow && $this->ValidateKey && strval($rsnew['LACode']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['PositionInCouncil']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['CouncilTerm']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter($rsnew);
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("councillor_allowance", $detailTblVar) && $GLOBALS["councillor_allowance"]->DetailAdd) {
				$GLOBALS["councillor_allowance"]->EmployeeID->setSessionValue($this->EmployeeID->CurrentValue); // Set master key
				if (!isset($GLOBALS["councillor_allowance_grid"]))
					$GLOBALS["councillor_allowance_grid"] = new councillor_allowance_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "councillor_allowance"); // Load user level of detail table
				$addRow = $GLOBALS["councillor_allowance_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["councillor_allowance"]->EmployeeID->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("committee_appointed", $detailTblVar) && $GLOBALS["committee_appointed"]->DetailAdd) {
				$GLOBALS["committee_appointed"]->EmployeeID->setSessionValue($this->EmployeeID->CurrentValue); // Set master key
				if (!isset($GLOBALS["committee_appointed_grid"]))
					$GLOBALS["committee_appointed_grid"] = new committee_appointed_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "committee_appointed"); // Load user level of detail table
				$addRow = $GLOBALS["committee_appointed_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["committee_appointed"]->EmployeeID->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {

			// CouncillorPhoto
			CleanUploadTempPath($this->CouncillorPhoto, $this->CouncillorPhoto->Upload->Index);
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
			if ($masterTblVar == "councillor") {
				$validMaster = TRUE;
				if (($parm = Get("fk_EmployeeID", Get("EmployeeID"))) !== NULL) {
					$GLOBALS["councillor"]->EmployeeID->setQueryStringValue($parm);
					$this->EmployeeID->setQueryStringValue($GLOBALS["councillor"]->EmployeeID->QueryStringValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->QueryStringValue);
					if (!is_numeric($GLOBALS["councillor"]->EmployeeID->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["local_authority"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue))
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
			if ($masterTblVar == "councillor") {
				$validMaster = TRUE;
				if (($parm = Post("fk_EmployeeID", Post("EmployeeID"))) !== NULL) {
					$GLOBALS["councillor"]->EmployeeID->setFormValue($parm);
					$this->EmployeeID->setFormValue($GLOBALS["councillor"]->EmployeeID->FormValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->FormValue);
					if (!is_numeric($GLOBALS["councillor"]->EmployeeID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["local_authority"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["local_authority"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->FormValue))
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
			if ($masterTblVar != "councillor") {
				if ($this->EmployeeID->CurrentValue == "")
					$this->EmployeeID->setSessionValue("");
			}
			if ($masterTblVar != "local_authority") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->ProvinceCode->CurrentValue == "")
					$this->ProvinceCode->setSessionValue("");
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
			if (in_array("councillor_allowance", $detailTblVar)) {
				if (!isset($GLOBALS["councillor_allowance_grid"]))
					$GLOBALS["councillor_allowance_grid"] = new councillor_allowance_grid();
				if ($GLOBALS["councillor_allowance_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["councillor_allowance_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["councillor_allowance_grid"]->CurrentMode = "add";
					$GLOBALS["councillor_allowance_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["councillor_allowance_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["councillor_allowance_grid"]->setStartRecordNumber(1);
					$GLOBALS["councillor_allowance_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["councillor_allowance_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["councillor_allowance_grid"]->EmployeeID->setSessionValue($GLOBALS["councillor_allowance_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("committee_appointed", $detailTblVar)) {
				if (!isset($GLOBALS["committee_appointed_grid"]))
					$GLOBALS["committee_appointed_grid"] = new committee_appointed_grid();
				if ($GLOBALS["committee_appointed_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["committee_appointed_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["committee_appointed_grid"]->CurrentMode = "add";
					$GLOBALS["committee_appointed_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["committee_appointed_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["committee_appointed_grid"]->setStartRecordNumber(1);
					$GLOBALS["committee_appointed_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["committee_appointed_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["committee_appointed_grid"]->EmployeeID->setSessionValue($GLOBALS["committee_appointed_grid"]->EmployeeID->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("councillorshiplist.php"), "", $this->TableVar, TRUE);
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