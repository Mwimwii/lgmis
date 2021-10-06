<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class councillorship_history_edit extends councillorship_history
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'councillorship_history';

	// Page object name
	public $PageObjName = "councillorship_history_edit";

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

		// Table object (councillorship_history)
		if (!isset($GLOBALS["councillorship_history"]) || get_class($GLOBALS["councillorship_history"]) == PROJECT_NAMESPACE . "councillorship_history") {
			$GLOBALS["councillorship_history"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["councillorship_history"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'councillorship_history');

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
		global $councillorship_history;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($councillorship_history);
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
					if ($pageName == "councillorship_historyview.php")
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
			$key .= @$ar['PositionInCouncil'];
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
					$this->terminate(GetUrl("councillorship_historylist.php"));
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
		$this->CouncilTerm->setVisibility();
		$this->DateOfExit->setVisibility();
		$this->Allowance->setVisibility();
		$this->CouncillorTypeType->setVisibility();
		$this->CouncillorshipStatus->setVisibility();
		$this->ExitReason->setVisibility();
		$this->RetirementType->setVisibility();
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
		// Check permission

		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("councillorship_historylist.php");
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
			if (Get("PositionInCouncil") !== NULL) {
				$this->PositionInCouncil->setQueryStringValue(Get("PositionInCouncil"));
				$this->PositionInCouncil->setOldValue($this->PositionInCouncil->QueryStringValue);
			} elseif (Key(1) !== NULL) {
				$this->PositionInCouncil->setQueryStringValue(Key(1));
				$this->PositionInCouncil->setOldValue($this->PositionInCouncil->QueryStringValue);
			} elseif (Post("PositionInCouncil") !== NULL) {
				$this->PositionInCouncil->setFormValue(Post("PositionInCouncil"));
				$this->PositionInCouncil->setOldValue($this->PositionInCouncil->FormValue);
			} elseif (Route(3) !== NULL) {
				$this->PositionInCouncil->setQueryStringValue(Route(3));
				$this->PositionInCouncil->setOldValue($this->PositionInCouncil->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_PositionInCouncil")) {
					$this->PositionInCouncil->setFormValue($CurrentForm->getValue("x_PositionInCouncil"));
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
				if (Get("PositionInCouncil") !== NULL) {
					$this->PositionInCouncil->setQueryStringValue(Get("PositionInCouncil"));
					$loadByQuery = TRUE;
				} elseif (Route(3) !== NULL) {
					$this->PositionInCouncil->setQueryStringValue(Route(3));
					$loadByQuery = TRUE;
				} else {
					$this->PositionInCouncil->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("councillorship_historylist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->EmployeeID->CurrentValue != NULL && $this->PositionInCouncil->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->EmployeeID->CurrentValue, $rs->fields('EmployeeID')) && SameString($this->PositionInCouncil->CurrentValue, $rs->fields('PositionInCouncil'))) {
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
					$this->terminate("councillorship_historylist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "councillorship_historylist.php")
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
		if ($CurrentForm->hasValue("o_PositionInCouncil"))
			$this->PositionInCouncil->setOldValue($CurrentForm->getValue("o_PositionInCouncil"));

		// Check field name 'Committee' first before field var 'x_Committee'
		$val = $CurrentForm->hasValue("Committee") ? $CurrentForm->getValue("Committee") : $CurrentForm->getValue("x_Committee");
		if (!$this->Committee->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Committee->Visible = FALSE; // Disable update for API request
			else
				$this->Committee->setFormValue($val);
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

		// Check field name 'CouncillorshipStatus' first before field var 'x_CouncillorshipStatus'
		$val = $CurrentForm->hasValue("CouncillorshipStatus") ? $CurrentForm->getValue("CouncillorshipStatus") : $CurrentForm->getValue("x_CouncillorshipStatus");
		if (!$this->CouncillorshipStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CouncillorshipStatus->Visible = FALSE; // Disable update for API request
			else
				$this->CouncillorshipStatus->setFormValue($val);
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
		$this->CouncilTerm->CurrentValue = $this->CouncilTerm->FormValue;
		$this->DateOfExit->CurrentValue = $this->DateOfExit->FormValue;
		$this->DateOfExit->CurrentValue = UnFormatDateTime($this->DateOfExit->CurrentValue, 0);
		$this->Allowance->CurrentValue = $this->Allowance->FormValue;
		$this->CouncillorTypeType->CurrentValue = $this->CouncillorTypeType->FormValue;
		$this->CouncillorshipStatus->CurrentValue = $this->CouncillorshipStatus->FormValue;
		$this->ExitReason->CurrentValue = $this->ExitReason->FormValue;
		$this->RetirementType->CurrentValue = $this->RetirementType->FormValue;
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
		$this->PoliticalParty->setDbValue($row['PoliticalParty']);
		$this->Occupation->setDbValue($row['Occupation']);
		$this->PositionInCouncil->setDbValue($row['PositionInCouncil']);
		$this->Committee->setDbValue($row['Committee']);
		$this->CouncilTerm->setDbValue($row['CouncilTerm']);
		$this->DateOfExit->setDbValue($row['DateOfExit']);
		$this->Allowance->setDbValue($row['Allowance']);
		$this->CouncillorTypeType->setDbValue($row['CouncillorTypeType']);
		$this->CouncillorshipStatus->setDbValue($row['CouncillorshipStatus']);
		$this->ExitReason->setDbValue($row['ExitReason']);
		$this->RetirementType->setDbValue($row['RetirementType']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['PoliticalParty'] = NULL;
		$row['Occupation'] = NULL;
		$row['PositionInCouncil'] = NULL;
		$row['Committee'] = NULL;
		$row['CouncilTerm'] = NULL;
		$row['DateOfExit'] = NULL;
		$row['Allowance'] = NULL;
		$row['CouncillorTypeType'] = NULL;
		$row['CouncillorshipStatus'] = NULL;
		$row['ExitReason'] = NULL;
		$row['RetirementType'] = NULL;
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
		if (strval($this->getKey("PositionInCouncil")) != "")
			$this->PositionInCouncil->OldValue = $this->getKey("PositionInCouncil"); // PositionInCouncil
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
		// CouncilTerm
		// DateOfExit
		// Allowance
		// CouncillorTypeType
		// CouncillorshipStatus
		// ExitReason
		// RetirementType

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
			$this->ProvinceCode->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewCustomAttributes = "";

			// PoliticalParty
			$this->PoliticalParty->ViewValue = $this->PoliticalParty->CurrentValue;
			$this->PoliticalParty->ViewCustomAttributes = "";

			// Occupation
			$this->Occupation->ViewValue = $this->Occupation->CurrentValue;
			$this->Occupation->ViewCustomAttributes = "";

			// PositionInCouncil
			$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->CurrentValue;
			$this->PositionInCouncil->ViewCustomAttributes = "";

			// Committee
			$this->Committee->ViewValue = $this->Committee->CurrentValue;
			$this->Committee->ViewCustomAttributes = "";

			// CouncilTerm
			$this->CouncilTerm->ViewValue = $this->CouncilTerm->CurrentValue;
			$this->CouncilTerm->ViewCustomAttributes = "";

			// DateOfExit
			$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
			$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
			$this->DateOfExit->ViewCustomAttributes = "";

			// Allowance
			$this->Allowance->ViewValue = $this->Allowance->CurrentValue;
			$this->Allowance->ViewCustomAttributes = "";

			// CouncillorTypeType
			$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->CurrentValue;
			$this->CouncillorTypeType->ViewCustomAttributes = "";

			// CouncillorshipStatus
			$this->CouncillorshipStatus->ViewValue = $this->CouncillorshipStatus->CurrentValue;
			$this->CouncillorshipStatus->ViewCustomAttributes = "";

			// ExitReason
			$this->ExitReason->ViewValue = $this->ExitReason->CurrentValue;
			$this->ExitReason->ViewCustomAttributes = "";

			// RetirementType
			$this->RetirementType->ViewValue = $this->RetirementType->CurrentValue;
			$this->RetirementType->ViewCustomAttributes = "";

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

			// CouncillorshipStatus
			$this->CouncillorshipStatus->LinkCustomAttributes = "";
			$this->CouncillorshipStatus->HrefValue = "";
			$this->CouncillorshipStatus->TooltipValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";
			$this->ExitReason->TooltipValue = "";

			// RetirementType
			$this->RetirementType->LinkCustomAttributes = "";
			$this->RetirementType->HrefValue = "";
			$this->RetirementType->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
			$this->ProvinceCode->EditValue = HtmlEncode($this->ProvinceCode->CurrentValue);
			$this->ProvinceCode->PlaceHolder = RemoveHtml($this->ProvinceCode->caption());

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if (!$this->LACode->Raw)
				$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
			$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// PoliticalParty
			$this->PoliticalParty->EditAttrs["class"] = "form-control";
			$this->PoliticalParty->EditCustomAttributes = "";
			$this->PoliticalParty->EditValue = HtmlEncode($this->PoliticalParty->CurrentValue);
			$this->PoliticalParty->PlaceHolder = RemoveHtml($this->PoliticalParty->caption());

			// Occupation
			$this->Occupation->EditAttrs["class"] = "form-control";
			$this->Occupation->EditCustomAttributes = "";
			$this->Occupation->EditValue = HtmlEncode($this->Occupation->CurrentValue);
			$this->Occupation->PlaceHolder = RemoveHtml($this->Occupation->caption());

			// PositionInCouncil
			$this->PositionInCouncil->EditAttrs["class"] = "form-control";
			$this->PositionInCouncil->EditCustomAttributes = "";
			$this->PositionInCouncil->EditValue = HtmlEncode($this->PositionInCouncil->CurrentValue);
			$this->PositionInCouncil->PlaceHolder = RemoveHtml($this->PositionInCouncil->caption());

			// Committee
			$this->Committee->EditAttrs["class"] = "form-control";
			$this->Committee->EditCustomAttributes = "";
			if (!$this->Committee->Raw)
				$this->Committee->CurrentValue = HtmlDecode($this->Committee->CurrentValue);
			$this->Committee->EditValue = HtmlEncode($this->Committee->CurrentValue);
			$this->Committee->PlaceHolder = RemoveHtml($this->Committee->caption());

			// CouncilTerm
			$this->CouncilTerm->EditAttrs["class"] = "form-control";
			$this->CouncilTerm->EditCustomAttributes = "";
			$this->CouncilTerm->EditValue = HtmlEncode($this->CouncilTerm->CurrentValue);
			$this->CouncilTerm->PlaceHolder = RemoveHtml($this->CouncilTerm->caption());

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
			$this->CouncillorTypeType->EditValue = HtmlEncode($this->CouncillorTypeType->CurrentValue);
			$this->CouncillorTypeType->PlaceHolder = RemoveHtml($this->CouncillorTypeType->caption());

			// CouncillorshipStatus
			$this->CouncillorshipStatus->EditAttrs["class"] = "form-control";
			$this->CouncillorshipStatus->EditCustomAttributes = "";
			$this->CouncillorshipStatus->EditValue = HtmlEncode($this->CouncillorshipStatus->CurrentValue);
			$this->CouncillorshipStatus->PlaceHolder = RemoveHtml($this->CouncillorshipStatus->caption());

			// ExitReason
			$this->ExitReason->EditAttrs["class"] = "form-control";
			$this->ExitReason->EditCustomAttributes = "";
			$this->ExitReason->EditValue = HtmlEncode($this->ExitReason->CurrentValue);
			$this->ExitReason->PlaceHolder = RemoveHtml($this->ExitReason->caption());

			// RetirementType
			$this->RetirementType->EditAttrs["class"] = "form-control";
			$this->RetirementType->EditCustomAttributes = "";
			$this->RetirementType->EditValue = HtmlEncode($this->RetirementType->CurrentValue);
			$this->RetirementType->PlaceHolder = RemoveHtml($this->RetirementType->caption());

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

			// CouncillorshipStatus
			$this->CouncillorshipStatus->LinkCustomAttributes = "";
			$this->CouncillorshipStatus->HrefValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";

			// RetirementType
			$this->RetirementType->LinkCustomAttributes = "";
			$this->RetirementType->HrefValue = "";
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
		if (!CheckInteger($this->PoliticalParty->FormValue)) {
			AddMessage($FormError, $this->PoliticalParty->errorMessage());
		}
		if ($this->Occupation->Required) {
			if (!$this->Occupation->IsDetailKey && $this->Occupation->FormValue != NULL && $this->Occupation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Occupation->caption(), $this->Occupation->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Occupation->FormValue)) {
			AddMessage($FormError, $this->Occupation->errorMessage());
		}
		if ($this->PositionInCouncil->Required) {
			if (!$this->PositionInCouncil->IsDetailKey && $this->PositionInCouncil->FormValue != NULL && $this->PositionInCouncil->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PositionInCouncil->caption(), $this->PositionInCouncil->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->PositionInCouncil->FormValue)) {
			AddMessage($FormError, $this->PositionInCouncil->errorMessage());
		}
		if ($this->Committee->Required) {
			if (!$this->Committee->IsDetailKey && $this->Committee->FormValue != NULL && $this->Committee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Committee->caption(), $this->Committee->RequiredErrorMessage));
			}
		}
		if ($this->CouncilTerm->Required) {
			if (!$this->CouncilTerm->IsDetailKey && $this->CouncilTerm->FormValue != NULL && $this->CouncilTerm->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncilTerm->caption(), $this->CouncilTerm->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->CouncilTerm->FormValue)) {
			AddMessage($FormError, $this->CouncilTerm->errorMessage());
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
		if (!CheckInteger($this->CouncillorTypeType->FormValue)) {
			AddMessage($FormError, $this->CouncillorTypeType->errorMessage());
		}
		if ($this->CouncillorshipStatus->Required) {
			if (!$this->CouncillorshipStatus->IsDetailKey && $this->CouncillorshipStatus->FormValue != NULL && $this->CouncillorshipStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncillorshipStatus->caption(), $this->CouncillorshipStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->CouncillorshipStatus->FormValue)) {
			AddMessage($FormError, $this->CouncillorshipStatus->errorMessage());
		}
		if ($this->ExitReason->Required) {
			if (!$this->ExitReason->IsDetailKey && $this->ExitReason->FormValue != NULL && $this->ExitReason->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExitReason->caption(), $this->ExitReason->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ExitReason->FormValue)) {
			AddMessage($FormError, $this->ExitReason->errorMessage());
		}
		if ($this->RetirementType->Required) {
			if (!$this->RetirementType->IsDetailKey && $this->RetirementType->FormValue != NULL && $this->RetirementType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RetirementType->caption(), $this->RetirementType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->RetirementType->FormValue)) {
			AddMessage($FormError, $this->RetirementType->errorMessage());
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

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// PoliticalParty
			$this->PoliticalParty->setDbValueDef($rsnew, $this->PoliticalParty->CurrentValue, NULL, $this->PoliticalParty->ReadOnly);

			// Occupation
			$this->Occupation->setDbValueDef($rsnew, $this->Occupation->CurrentValue, NULL, $this->Occupation->ReadOnly);

			// PositionInCouncil
			$this->PositionInCouncil->setDbValueDef($rsnew, $this->PositionInCouncil->CurrentValue, 0, $this->PositionInCouncil->ReadOnly);

			// Committee
			$this->Committee->setDbValueDef($rsnew, $this->Committee->CurrentValue, NULL, $this->Committee->ReadOnly);

			// CouncilTerm
			$this->CouncilTerm->setDbValueDef($rsnew, $this->CouncilTerm->CurrentValue, 0, $this->CouncilTerm->ReadOnly);

			// DateOfExit
			$this->DateOfExit->setDbValueDef($rsnew, UnFormatDateTime($this->DateOfExit->CurrentValue, 0), NULL, $this->DateOfExit->ReadOnly);

			// Allowance
			$this->Allowance->setDbValueDef($rsnew, $this->Allowance->CurrentValue, "", $this->Allowance->ReadOnly);

			// CouncillorTypeType
			$this->CouncillorTypeType->setDbValueDef($rsnew, $this->CouncillorTypeType->CurrentValue, 0, $this->CouncillorTypeType->ReadOnly);

			// CouncillorshipStatus
			$this->CouncillorshipStatus->setDbValueDef($rsnew, $this->CouncillorshipStatus->CurrentValue, 0, $this->CouncillorshipStatus->ReadOnly);

			// ExitReason
			$this->ExitReason->setDbValueDef($rsnew, $this->ExitReason->CurrentValue, NULL, $this->ExitReason->ReadOnly);

			// RetirementType
			$this->RetirementType->setDbValueDef($rsnew, $this->RetirementType->CurrentValue, NULL, $this->RetirementType->ReadOnly);

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
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("councillorship_historylist.php"), "", $this->TableVar, TRUE);
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