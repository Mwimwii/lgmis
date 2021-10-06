<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class outcome_edit extends outcome
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'outcome';

	// Page object name
	public $PageObjName = "outcome_edit";

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

		// Table object (outcome)
		if (!isset($GLOBALS["outcome"]) || get_class($GLOBALS["outcome"]) == PROJECT_NAMESPACE . "outcome") {
			$GLOBALS["outcome"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["outcome"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (strategic_objective)
		if (!isset($GLOBALS['strategic_objective']))
			$GLOBALS['strategic_objective'] = new strategic_objective();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'outcome');

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
		global $outcome;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($outcome);
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
					if ($pageName == "outcomeview.php")
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
			$key .= @$ar['OutcomeCode'];
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
			$this->OutcomeCode->Visible = FALSE;
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
					$this->terminate(GetUrl("outcomelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->OutcomeCode->setVisibility();
		$this->OutcomeName->setVisibility();
		$this->StrategicObjectiveCode->setVisibility();
		$this->LACode->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->ResultAreaCode->Visible = FALSE;
		$this->OutcomeKPI->setVisibility();
		$this->Assumptions->setVisibility();
		$this->ResponsibleOfficer->setVisibility();
		$this->OutcomeStatus->setVisibility();
		$this->LockStatus->Visible = FALSE;
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
		$this->setupLookupOptions($this->StrategicObjectiveCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->ResultAreaCode);
		$this->setupLookupOptions($this->OutcomeStatus);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("outcomelist.php");
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
			if (Get("OutcomeCode") !== NULL) {
				$this->OutcomeCode->setQueryStringValue(Get("OutcomeCode"));
				$this->OutcomeCode->setOldValue($this->OutcomeCode->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->OutcomeCode->setQueryStringValue(Key(0));
				$this->OutcomeCode->setOldValue($this->OutcomeCode->QueryStringValue);
			} elseif (Post("OutcomeCode") !== NULL) {
				$this->OutcomeCode->setFormValue(Post("OutcomeCode"));
				$this->OutcomeCode->setOldValue($this->OutcomeCode->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->OutcomeCode->setQueryStringValue(Route(2));
				$this->OutcomeCode->setOldValue($this->OutcomeCode->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_OutcomeCode")) {
					$this->OutcomeCode->setFormValue($CurrentForm->getValue("x_OutcomeCode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("OutcomeCode") !== NULL) {
					$this->OutcomeCode->setQueryStringValue(Get("OutcomeCode"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->OutcomeCode->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->OutcomeCode->CurrentValue = NULL;
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
				$this->terminate("outcomelist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->OutcomeCode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->OutcomeCode->CurrentValue, $rs->fields('OutcomeCode'))) {
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
					$this->terminate("outcomelist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "outcomelist.php")
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

		// Check field name 'OutcomeCode' first before field var 'x_OutcomeCode'
		$val = $CurrentForm->hasValue("OutcomeCode") ? $CurrentForm->getValue("OutcomeCode") : $CurrentForm->getValue("x_OutcomeCode");
		if (!$this->OutcomeCode->IsDetailKey)
			$this->OutcomeCode->setFormValue($val);

		// Check field name 'OutcomeName' first before field var 'x_OutcomeName'
		$val = $CurrentForm->hasValue("OutcomeName") ? $CurrentForm->getValue("OutcomeName") : $CurrentForm->getValue("x_OutcomeName");
		if (!$this->OutcomeName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeName->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeName->setFormValue($val);
		}

		// Check field name 'StrategicObjectiveCode' first before field var 'x_StrategicObjectiveCode'
		$val = $CurrentForm->hasValue("StrategicObjectiveCode") ? $CurrentForm->getValue("StrategicObjectiveCode") : $CurrentForm->getValue("x_StrategicObjectiveCode");
		if (!$this->StrategicObjectiveCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->StrategicObjectiveCode->Visible = FALSE; // Disable update for API request
			else
				$this->StrategicObjectiveCode->setFormValue($val);
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

		// Check field name 'OutcomeKPI' first before field var 'x_OutcomeKPI'
		$val = $CurrentForm->hasValue("OutcomeKPI") ? $CurrentForm->getValue("OutcomeKPI") : $CurrentForm->getValue("x_OutcomeKPI");
		if (!$this->OutcomeKPI->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeKPI->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeKPI->setFormValue($val);
		}

		// Check field name 'Assumptions' first before field var 'x_Assumptions'
		$val = $CurrentForm->hasValue("Assumptions") ? $CurrentForm->getValue("Assumptions") : $CurrentForm->getValue("x_Assumptions");
		if (!$this->Assumptions->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Assumptions->Visible = FALSE; // Disable update for API request
			else
				$this->Assumptions->setFormValue($val);
		}

		// Check field name 'ResponsibleOfficer' first before field var 'x_ResponsibleOfficer'
		$val = $CurrentForm->hasValue("ResponsibleOfficer") ? $CurrentForm->getValue("ResponsibleOfficer") : $CurrentForm->getValue("x_ResponsibleOfficer");
		if (!$this->ResponsibleOfficer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ResponsibleOfficer->Visible = FALSE; // Disable update for API request
			else
				$this->ResponsibleOfficer->setFormValue($val);
		}

		// Check field name 'OutcomeStatus' first before field var 'x_OutcomeStatus'
		$val = $CurrentForm->hasValue("OutcomeStatus") ? $CurrentForm->getValue("OutcomeStatus") : $CurrentForm->getValue("x_OutcomeStatus");
		if (!$this->OutcomeStatus->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OutcomeStatus->Visible = FALSE; // Disable update for API request
			else
				$this->OutcomeStatus->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->OutcomeCode->CurrentValue = $this->OutcomeCode->FormValue;
		$this->OutcomeName->CurrentValue = $this->OutcomeName->FormValue;
		$this->StrategicObjectiveCode->CurrentValue = $this->StrategicObjectiveCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->OutcomeKPI->CurrentValue = $this->OutcomeKPI->FormValue;
		$this->Assumptions->CurrentValue = $this->Assumptions->FormValue;
		$this->ResponsibleOfficer->CurrentValue = $this->ResponsibleOfficer->FormValue;
		$this->OutcomeStatus->CurrentValue = $this->OutcomeStatus->FormValue;
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
		$this->OutcomeCode->setDbValue($row['OutcomeCode']);
		$this->OutcomeName->setDbValue($row['OutcomeName']);
		$this->StrategicObjectiveCode->setDbValue($row['StrategicObjectiveCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->ResultAreaCode->setDbValue($row['ResultAreaCode']);
		$this->OutcomeKPI->setDbValue($row['OutcomeKPI']);
		$this->Assumptions->setDbValue($row['Assumptions']);
		$this->ResponsibleOfficer->setDbValue($row['ResponsibleOfficer']);
		$this->OutcomeStatus->setDbValue($row['OutcomeStatus']);
		$this->LockStatus->setDbValue($row['LockStatus']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['OutcomeCode'] = NULL;
		$row['OutcomeName'] = NULL;
		$row['StrategicObjectiveCode'] = NULL;
		$row['LACode'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['ResultAreaCode'] = NULL;
		$row['OutcomeKPI'] = NULL;
		$row['Assumptions'] = NULL;
		$row['ResponsibleOfficer'] = NULL;
		$row['OutcomeStatus'] = NULL;
		$row['LockStatus'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("OutcomeCode")) != "")
			$this->OutcomeCode->OldValue = $this->getKey("OutcomeCode"); // OutcomeCode
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
		// OutcomeCode
		// OutcomeName
		// StrategicObjectiveCode
		// LACode
		// DepartmentCode
		// ResultAreaCode
		// OutcomeKPI
		// Assumptions
		// ResponsibleOfficer
		// OutcomeStatus
		// LockStatus

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// OutcomeCode
			$this->OutcomeCode->ViewValue = $this->OutcomeCode->CurrentValue;
			$this->OutcomeCode->ViewCustomAttributes = "";

			// OutcomeName
			$this->OutcomeName->ViewValue = $this->OutcomeName->CurrentValue;
			$this->OutcomeName->ViewCustomAttributes = "";

			// StrategicObjectiveCode
			$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
			$curVal = strval($this->StrategicObjectiveCode->CurrentValue);
			if ($curVal != "") {
				$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->lookupCacheOption($curVal);
				if ($this->StrategicObjectiveCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`StrategicObjectiveCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->StrategicObjectiveCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
					}
				}
			} else {
				$this->StrategicObjectiveCode->ViewValue = NULL;
			}
			$this->StrategicObjectiveCode->ViewCustomAttributes = "";

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
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

			// OutcomeKPI
			$this->OutcomeKPI->ViewValue = $this->OutcomeKPI->CurrentValue;
			$this->OutcomeKPI->ViewCustomAttributes = "";

			// Assumptions
			$this->Assumptions->ViewValue = $this->Assumptions->CurrentValue;
			$this->Assumptions->ViewCustomAttributes = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->ViewValue = $this->ResponsibleOfficer->CurrentValue;
			$this->ResponsibleOfficer->ViewCustomAttributes = "";

			// OutcomeStatus
			$curVal = strval($this->OutcomeStatus->CurrentValue);
			if ($curVal != "") {
				$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->lookupCacheOption($curVal);
				if ($this->OutcomeStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProgressCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->OutcomeStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->CurrentValue;
					}
				}
			} else {
				$this->OutcomeStatus->ViewValue = NULL;
			}
			$this->OutcomeStatus->ViewCustomAttributes = "";

			// LockStatus
			$this->LockStatus->ViewValue = $this->LockStatus->CurrentValue;
			$this->LockStatus->ViewCustomAttributes = "";

			// OutcomeCode
			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";
			$this->OutcomeCode->TooltipValue = "";

			// OutcomeName
			$this->OutcomeName->LinkCustomAttributes = "";
			$this->OutcomeName->HrefValue = "";
			$this->OutcomeName->TooltipValue = "";

			// StrategicObjectiveCode
			$this->StrategicObjectiveCode->LinkCustomAttributes = "";
			$this->StrategicObjectiveCode->HrefValue = "";
			$this->StrategicObjectiveCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// OutcomeKPI
			$this->OutcomeKPI->LinkCustomAttributes = "";
			$this->OutcomeKPI->HrefValue = "";
			$this->OutcomeKPI->TooltipValue = "";

			// Assumptions
			$this->Assumptions->LinkCustomAttributes = "";
			$this->Assumptions->HrefValue = "";
			$this->Assumptions->TooltipValue = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";
			$this->ResponsibleOfficer->TooltipValue = "";

			// OutcomeStatus
			$this->OutcomeStatus->LinkCustomAttributes = "";
			$this->OutcomeStatus->HrefValue = "";
			$this->OutcomeStatus->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// OutcomeCode
			$this->OutcomeCode->EditAttrs["class"] = "form-control";
			$this->OutcomeCode->EditCustomAttributes = "";
			$this->OutcomeCode->EditValue = $this->OutcomeCode->CurrentValue;
			$this->OutcomeCode->ViewCustomAttributes = "";

			// OutcomeName
			$this->OutcomeName->EditAttrs["class"] = "form-control";
			$this->OutcomeName->EditCustomAttributes = "";
			$this->OutcomeName->EditValue = HtmlEncode($this->OutcomeName->CurrentValue);
			$this->OutcomeName->PlaceHolder = RemoveHtml($this->OutcomeName->caption());

			// StrategicObjectiveCode
			$this->StrategicObjectiveCode->EditAttrs["class"] = "form-control";
			$this->StrategicObjectiveCode->EditCustomAttributes = "";
			if ($this->StrategicObjectiveCode->getSessionValue() != "") {
				$this->StrategicObjectiveCode->CurrentValue = $this->StrategicObjectiveCode->getSessionValue();
				$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
				$curVal = strval($this->StrategicObjectiveCode->CurrentValue);
				if ($curVal != "") {
					$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->lookupCacheOption($curVal);
					if ($this->StrategicObjectiveCode->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`StrategicObjectiveCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->StrategicObjectiveCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->StrategicObjectiveCode->ViewValue = $this->StrategicObjectiveCode->CurrentValue;
						}
					}
				} else {
					$this->StrategicObjectiveCode->ViewValue = NULL;
				}
				$this->StrategicObjectiveCode->ViewCustomAttributes = "";
			} else {
				$this->StrategicObjectiveCode->EditValue = HtmlEncode($this->StrategicObjectiveCode->CurrentValue);
				$curVal = strval($this->StrategicObjectiveCode->CurrentValue);
				if ($curVal != "") {
					$this->StrategicObjectiveCode->EditValue = $this->StrategicObjectiveCode->lookupCacheOption($curVal);
					if ($this->StrategicObjectiveCode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`StrategicObjectiveCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->StrategicObjectiveCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->StrategicObjectiveCode->EditValue = $this->StrategicObjectiveCode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->StrategicObjectiveCode->EditValue = HtmlEncode($this->StrategicObjectiveCode->CurrentValue);
						}
					}
				} else {
					$this->StrategicObjectiveCode->EditValue = NULL;
				}
				$this->StrategicObjectiveCode->PlaceHolder = RemoveHtml($this->StrategicObjectiveCode->caption());
			}

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if ($this->LACode->getSessionValue() != "") {
				$this->LACode->CurrentValue = $this->LACode->getSessionValue();
				$this->LACode->ViewValue = $this->LACode->CurrentValue;
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
				if (!$this->LACode->Raw)
					$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
				$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
				$curVal = strval($this->LACode->CurrentValue);
				if ($curVal != "") {
					$this->LACode->EditValue = $this->LACode->lookupCacheOption($curVal);
					if ($this->LACode->EditValue === NULL) { // Lookup from database
						$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
						$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->LACode->EditValue = $this->LACode->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
						}
					}
				} else {
					$this->LACode->EditValue = NULL;
				}
				$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());
			}

			// DepartmentCode
			$this->DepartmentCode->EditCustomAttributes = "";
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

			// OutcomeKPI
			$this->OutcomeKPI->EditAttrs["class"] = "form-control";
			$this->OutcomeKPI->EditCustomAttributes = "";
			$this->OutcomeKPI->EditValue = HtmlEncode($this->OutcomeKPI->CurrentValue);
			$this->OutcomeKPI->PlaceHolder = RemoveHtml($this->OutcomeKPI->caption());

			// Assumptions
			$this->Assumptions->EditAttrs["class"] = "form-control";
			$this->Assumptions->EditCustomAttributes = "";
			$this->Assumptions->EditValue = HtmlEncode($this->Assumptions->CurrentValue);
			$this->Assumptions->PlaceHolder = RemoveHtml($this->Assumptions->caption());

			// ResponsibleOfficer
			$this->ResponsibleOfficer->EditAttrs["class"] = "form-control";
			$this->ResponsibleOfficer->EditCustomAttributes = "";
			if (!$this->ResponsibleOfficer->Raw)
				$this->ResponsibleOfficer->CurrentValue = HtmlDecode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->EditValue = HtmlEncode($this->ResponsibleOfficer->CurrentValue);
			$this->ResponsibleOfficer->PlaceHolder = RemoveHtml($this->ResponsibleOfficer->caption());

			// OutcomeStatus
			$this->OutcomeStatus->EditAttrs["class"] = "form-control";
			$this->OutcomeStatus->EditCustomAttributes = "";
			$curVal = trim(strval($this->OutcomeStatus->CurrentValue));
			if ($curVal != "")
				$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->lookupCacheOption($curVal);
			else
				$this->OutcomeStatus->ViewValue = $this->OutcomeStatus->Lookup !== NULL && is_array($this->OutcomeStatus->Lookup->Options) ? $curVal : NULL;
			if ($this->OutcomeStatus->ViewValue !== NULL) { // Load from cache
				$this->OutcomeStatus->EditValue = array_values($this->OutcomeStatus->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProgressCode`" . SearchString("=", $this->OutcomeStatus->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->OutcomeStatus->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->OutcomeStatus->EditValue = $arwrk;
			}

			// Edit refer script
			// OutcomeCode

			$this->OutcomeCode->LinkCustomAttributes = "";
			$this->OutcomeCode->HrefValue = "";

			// OutcomeName
			$this->OutcomeName->LinkCustomAttributes = "";
			$this->OutcomeName->HrefValue = "";

			// StrategicObjectiveCode
			$this->StrategicObjectiveCode->LinkCustomAttributes = "";
			$this->StrategicObjectiveCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// OutcomeKPI
			$this->OutcomeKPI->LinkCustomAttributes = "";
			$this->OutcomeKPI->HrefValue = "";

			// Assumptions
			$this->Assumptions->LinkCustomAttributes = "";
			$this->Assumptions->HrefValue = "";

			// ResponsibleOfficer
			$this->ResponsibleOfficer->LinkCustomAttributes = "";
			$this->ResponsibleOfficer->HrefValue = "";

			// OutcomeStatus
			$this->OutcomeStatus->LinkCustomAttributes = "";
			$this->OutcomeStatus->HrefValue = "";
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
		if ($this->OutcomeCode->Required) {
			if (!$this->OutcomeCode->IsDetailKey && $this->OutcomeCode->FormValue != NULL && $this->OutcomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeCode->caption(), $this->OutcomeCode->RequiredErrorMessage));
			}
		}
		if ($this->OutcomeName->Required) {
			if (!$this->OutcomeName->IsDetailKey && $this->OutcomeName->FormValue != NULL && $this->OutcomeName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeName->caption(), $this->OutcomeName->RequiredErrorMessage));
			}
		}
		if ($this->StrategicObjectiveCode->Required) {
			if (!$this->StrategicObjectiveCode->IsDetailKey && $this->StrategicObjectiveCode->FormValue != NULL && $this->StrategicObjectiveCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->StrategicObjectiveCode->caption(), $this->StrategicObjectiveCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->StrategicObjectiveCode->FormValue)) {
			AddMessage($FormError, $this->StrategicObjectiveCode->errorMessage());
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
		if ($this->OutcomeKPI->Required) {
			if (!$this->OutcomeKPI->IsDetailKey && $this->OutcomeKPI->FormValue != NULL && $this->OutcomeKPI->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeKPI->caption(), $this->OutcomeKPI->RequiredErrorMessage));
			}
		}
		if ($this->Assumptions->Required) {
			if (!$this->Assumptions->IsDetailKey && $this->Assumptions->FormValue != NULL && $this->Assumptions->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Assumptions->caption(), $this->Assumptions->RequiredErrorMessage));
			}
		}
		if ($this->ResponsibleOfficer->Required) {
			if (!$this->ResponsibleOfficer->IsDetailKey && $this->ResponsibleOfficer->FormValue != NULL && $this->ResponsibleOfficer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ResponsibleOfficer->caption(), $this->ResponsibleOfficer->RequiredErrorMessage));
			}
		}
		if ($this->OutcomeStatus->Required) {
			if (!$this->OutcomeStatus->IsDetailKey && $this->OutcomeStatus->FormValue != NULL && $this->OutcomeStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OutcomeStatus->caption(), $this->OutcomeStatus->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("output", $detailTblVar) && $GLOBALS["output"]->DetailEdit) {
			if (!isset($GLOBALS["output_grid"]))
				$GLOBALS["output_grid"] = new output_grid(); // Get detail page object
			$GLOBALS["output_grid"]->validateGridForm();
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

			// OutcomeName
			$this->OutcomeName->setDbValueDef($rsnew, $this->OutcomeName->CurrentValue, "", $this->OutcomeName->ReadOnly);

			// StrategicObjectiveCode
			$this->StrategicObjectiveCode->setDbValueDef($rsnew, $this->StrategicObjectiveCode->CurrentValue, 0, $this->StrategicObjectiveCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, $this->DepartmentCode->ReadOnly);

			// OutcomeKPI
			$this->OutcomeKPI->setDbValueDef($rsnew, $this->OutcomeKPI->CurrentValue, NULL, $this->OutcomeKPI->ReadOnly);

			// Assumptions
			$this->Assumptions->setDbValueDef($rsnew, $this->Assumptions->CurrentValue, NULL, $this->Assumptions->ReadOnly);

			// ResponsibleOfficer
			$this->ResponsibleOfficer->setDbValueDef($rsnew, $this->ResponsibleOfficer->CurrentValue, NULL, $this->ResponsibleOfficer->ReadOnly);

			// OutcomeStatus
			$this->OutcomeStatus->setDbValueDef($rsnew, $this->OutcomeStatus->CurrentValue, NULL, $this->OutcomeStatus->ReadOnly);

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
					if (in_array("output", $detailTblVar) && $GLOBALS["output"]->DetailEdit) {
						if (!isset($GLOBALS["output_grid"]))
							$GLOBALS["output_grid"] = new output_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "output"); // Load user level of detail table
						$editRow = $GLOBALS["output_grid"]->gridUpdate();
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
			if ($masterTblVar == "strategic_objective") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["strategic_objective"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["strategic_objective"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_StrategicObjectiveCode", Get("StrategicObjectiveCode"))) !== NULL) {
					$GLOBALS["strategic_objective"]->StrategicObjectiveCode->setQueryStringValue($parm);
					$this->StrategicObjectiveCode->setQueryStringValue($GLOBALS["strategic_objective"]->StrategicObjectiveCode->QueryStringValue);
					$this->StrategicObjectiveCode->setSessionValue($this->StrategicObjectiveCode->QueryStringValue);
					if (!is_numeric($GLOBALS["strategic_objective"]->StrategicObjectiveCode->QueryStringValue))
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
			if ($masterTblVar == "strategic_objective") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["strategic_objective"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["strategic_objective"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_StrategicObjectiveCode", Post("StrategicObjectiveCode"))) !== NULL) {
					$GLOBALS["strategic_objective"]->StrategicObjectiveCode->setFormValue($parm);
					$this->StrategicObjectiveCode->setFormValue($GLOBALS["strategic_objective"]->StrategicObjectiveCode->FormValue);
					$this->StrategicObjectiveCode->setSessionValue($this->StrategicObjectiveCode->FormValue);
					if (!is_numeric($GLOBALS["strategic_objective"]->StrategicObjectiveCode->FormValue))
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
			if ($masterTblVar != "strategic_objective") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->StrategicObjectiveCode->CurrentValue == "")
					$this->StrategicObjectiveCode->setSessionValue("");
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
			if (in_array("output", $detailTblVar)) {
				if (!isset($GLOBALS["output_grid"]))
					$GLOBALS["output_grid"] = new output_grid();
				if ($GLOBALS["output_grid"]->DetailEdit) {
					$GLOBALS["output_grid"]->CurrentMode = "edit";
					$GLOBALS["output_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["output_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["output_grid"]->setStartRecordNumber(1);
					$GLOBALS["output_grid"]->OutcomeCode->IsDetailKey = TRUE;
					$GLOBALS["output_grid"]->OutcomeCode->CurrentValue = $this->OutcomeCode->CurrentValue;
					$GLOBALS["output_grid"]->OutcomeCode->setSessionValue($GLOBALS["output_grid"]->OutcomeCode->CurrentValue);
					$GLOBALS["output_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["output_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["output_grid"]->LACode->setSessionValue($GLOBALS["output_grid"]->LACode->CurrentValue);
					$GLOBALS["output_grid"]->DepartmentCode->IsDetailKey = TRUE;
					$GLOBALS["output_grid"]->DepartmentCode->CurrentValue = $this->DepartmentCode->CurrentValue;
					$GLOBALS["output_grid"]->DepartmentCode->setSessionValue($GLOBALS["output_grid"]->DepartmentCode->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("outcomelist.php"), "", $this->TableVar, TRUE);
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
				case "x_StrategicObjectiveCode":
					break;
				case "x_LACode":
					break;
				case "x_DepartmentCode":
					break;
				case "x_ResultAreaCode":
					break;
				case "x_OutcomeStatus":
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
						case "x_StrategicObjectiveCode":
							break;
						case "x_LACode":
							break;
						case "x_DepartmentCode":
							break;
						case "x_ResultAreaCode":
							break;
						case "x_OutcomeStatus":
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