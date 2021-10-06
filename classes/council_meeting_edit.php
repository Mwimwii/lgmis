<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class council_meeting_edit extends council_meeting
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'council_meeting';

	// Page object name
	public $PageObjName = "council_meeting_edit";

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

		// Table object (council_meeting)
		if (!isset($GLOBALS["council_meeting"]) || get_class($GLOBALS["council_meeting"]) == PROJECT_NAMESPACE . "council_meeting") {
			$GLOBALS["council_meeting"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["council_meeting"];
		}

		// Table object (local_authority)
		if (!isset($GLOBALS['local_authority']))
			$GLOBALS['local_authority'] = new local_authority();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'council_meeting');

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
		global $council_meeting;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($council_meeting);
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
					if ($pageName == "council_meetingview.php")
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
			$key .= @$ar['MeetingNo'];
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
					$this->terminate(GetUrl("council_meetinglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->MeetingNo->setVisibility();
		$this->MeetingRef->setVisibility();
		$this->MeetingType->setVisibility();
		$this->LACode->setVisibility();
		$this->PlannedDate->setVisibility();
		$this->ActualDate->setVisibility();
		$this->DateAuthorisedByPLGO->Visible = FALSE;
		$this->Attendance->setVisibility();
		$this->ChairedBy->setVisibility();
		$this->Minutes->setVisibility();
		$this->MinutesUploaded->setVisibility();
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
		$this->setupLookupOptions($this->MeetingType);
		$this->setupLookupOptions($this->LACode);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("council_meetinglist.php");
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
			if (Get("MeetingNo") !== NULL) {
				$this->MeetingNo->setQueryStringValue(Get("MeetingNo"));
				$this->MeetingNo->setOldValue($this->MeetingNo->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->MeetingNo->setQueryStringValue(Key(0));
				$this->MeetingNo->setOldValue($this->MeetingNo->QueryStringValue);
			} elseif (Post("MeetingNo") !== NULL) {
				$this->MeetingNo->setFormValue(Post("MeetingNo"));
				$this->MeetingNo->setOldValue($this->MeetingNo->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->MeetingNo->setQueryStringValue(Route(2));
				$this->MeetingNo->setOldValue($this->MeetingNo->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_MeetingNo")) {
					$this->MeetingNo->setFormValue($CurrentForm->getValue("x_MeetingNo"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("MeetingNo") !== NULL) {
					$this->MeetingNo->setQueryStringValue(Get("MeetingNo"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->MeetingNo->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->MeetingNo->CurrentValue = NULL;
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
				$this->terminate("council_meetinglist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->MeetingNo->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->MeetingNo->CurrentValue, $rs->fields('MeetingNo'))) {
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
					$this->terminate("council_meetinglist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "council_meetinglist.php")
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
		$this->MinutesUploaded->Upload->Index = $CurrentForm->Index;
		$this->MinutesUploaded->Upload->uploadFile();
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'MeetingNo' first before field var 'x_MeetingNo'
		$val = $CurrentForm->hasValue("MeetingNo") ? $CurrentForm->getValue("MeetingNo") : $CurrentForm->getValue("x_MeetingNo");
		if (!$this->MeetingNo->IsDetailKey)
			$this->MeetingNo->setFormValue($val);

		// Check field name 'MeetingRef' first before field var 'x_MeetingRef'
		$val = $CurrentForm->hasValue("MeetingRef") ? $CurrentForm->getValue("MeetingRef") : $CurrentForm->getValue("x_MeetingRef");
		if (!$this->MeetingRef->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MeetingRef->Visible = FALSE; // Disable update for API request
			else
				$this->MeetingRef->setFormValue($val);
		}

		// Check field name 'MeetingType' first before field var 'x_MeetingType'
		$val = $CurrentForm->hasValue("MeetingType") ? $CurrentForm->getValue("MeetingType") : $CurrentForm->getValue("x_MeetingType");
		if (!$this->MeetingType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MeetingType->Visible = FALSE; // Disable update for API request
			else
				$this->MeetingType->setFormValue($val);
		}

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}

		// Check field name 'PlannedDate' first before field var 'x_PlannedDate'
		$val = $CurrentForm->hasValue("PlannedDate") ? $CurrentForm->getValue("PlannedDate") : $CurrentForm->getValue("x_PlannedDate");
		if (!$this->PlannedDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PlannedDate->Visible = FALSE; // Disable update for API request
			else
				$this->PlannedDate->setFormValue($val);
			$this->PlannedDate->CurrentValue = UnFormatDateTime($this->PlannedDate->CurrentValue, 0);
		}

		// Check field name 'ActualDate' first before field var 'x_ActualDate'
		$val = $CurrentForm->hasValue("ActualDate") ? $CurrentForm->getValue("ActualDate") : $CurrentForm->getValue("x_ActualDate");
		if (!$this->ActualDate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ActualDate->Visible = FALSE; // Disable update for API request
			else
				$this->ActualDate->setFormValue($val);
			$this->ActualDate->CurrentValue = UnFormatDateTime($this->ActualDate->CurrentValue, 0);
		}

		// Check field name 'Attendance' first before field var 'x_Attendance'
		$val = $CurrentForm->hasValue("Attendance") ? $CurrentForm->getValue("Attendance") : $CurrentForm->getValue("x_Attendance");
		if (!$this->Attendance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Attendance->Visible = FALSE; // Disable update for API request
			else
				$this->Attendance->setFormValue($val);
		}

		// Check field name 'ChairedBy' first before field var 'x_ChairedBy'
		$val = $CurrentForm->hasValue("ChairedBy") ? $CurrentForm->getValue("ChairedBy") : $CurrentForm->getValue("x_ChairedBy");
		if (!$this->ChairedBy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChairedBy->Visible = FALSE; // Disable update for API request
			else
				$this->ChairedBy->setFormValue($val);
		}

		// Check field name 'Minutes' first before field var 'x_Minutes'
		$val = $CurrentForm->hasValue("Minutes") ? $CurrentForm->getValue("Minutes") : $CurrentForm->getValue("x_Minutes");
		if (!$this->Minutes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Minutes->Visible = FALSE; // Disable update for API request
			else
				$this->Minutes->setFormValue($val);
		}
		$this->getUploadFiles(); // Get upload files
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->MeetingNo->CurrentValue = $this->MeetingNo->FormValue;
		$this->MeetingRef->CurrentValue = $this->MeetingRef->FormValue;
		$this->MeetingType->CurrentValue = $this->MeetingType->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->PlannedDate->CurrentValue = $this->PlannedDate->FormValue;
		$this->PlannedDate->CurrentValue = UnFormatDateTime($this->PlannedDate->CurrentValue, 0);
		$this->ActualDate->CurrentValue = $this->ActualDate->FormValue;
		$this->ActualDate->CurrentValue = UnFormatDateTime($this->ActualDate->CurrentValue, 0);
		$this->Attendance->CurrentValue = $this->Attendance->FormValue;
		$this->ChairedBy->CurrentValue = $this->ChairedBy->FormValue;
		$this->Minutes->CurrentValue = $this->Minutes->FormValue;
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
		$this->MeetingNo->setDbValue($row['MeetingNo']);
		$this->MeetingRef->setDbValue($row['MeetingRef']);
		$this->MeetingType->setDbValue($row['MeetingType']);
		$this->LACode->setDbValue($row['LACode']);
		$this->PlannedDate->setDbValue($row['PlannedDate']);
		$this->ActualDate->setDbValue($row['ActualDate']);
		$this->DateAuthorisedByPLGO->setDbValue($row['DateAuthorisedByPLGO']);
		$this->Attendance->setDbValue($row['Attendance']);
		$this->ChairedBy->setDbValue($row['ChairedBy']);
		$this->Minutes->setDbValue($row['Minutes']);
		$this->MinutesUploaded->Upload->DbValue = $row['MinutesUploaded'];
		if (is_array($this->MinutesUploaded->Upload->DbValue) || is_object($this->MinutesUploaded->Upload->DbValue)) // Byte array
			$this->MinutesUploaded->Upload->DbValue = BytesToString($this->MinutesUploaded->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['MeetingNo'] = NULL;
		$row['MeetingRef'] = NULL;
		$row['MeetingType'] = NULL;
		$row['LACode'] = NULL;
		$row['PlannedDate'] = NULL;
		$row['ActualDate'] = NULL;
		$row['DateAuthorisedByPLGO'] = NULL;
		$row['Attendance'] = NULL;
		$row['ChairedBy'] = NULL;
		$row['Minutes'] = NULL;
		$row['MinutesUploaded'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("MeetingNo")) != "")
			$this->MeetingNo->OldValue = $this->getKey("MeetingNo"); // MeetingNo
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
		// MeetingNo
		// MeetingRef
		// MeetingType
		// LACode
		// PlannedDate
		// ActualDate
		// DateAuthorisedByPLGO
		// Attendance
		// ChairedBy
		// Minutes
		// MinutesUploaded

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// MeetingNo
			$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
			$this->MeetingNo->ViewCustomAttributes = "";

			// MeetingRef
			$this->MeetingRef->ViewValue = $this->MeetingRef->CurrentValue;
			$this->MeetingRef->ViewCustomAttributes = "";

			// MeetingType
			$curVal = strval($this->MeetingType->CurrentValue);
			if ($curVal != "") {
				$this->MeetingType->ViewValue = $this->MeetingType->lookupCacheOption($curVal);
				if ($this->MeetingType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MeetingType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeetingType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MeetingType->ViewValue = $this->MeetingType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeetingType->ViewValue = $this->MeetingType->CurrentValue;
					}
				}
			} else {
				$this->MeetingType->ViewValue = NULL;
			}
			$this->MeetingType->ViewCustomAttributes = "";

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

			// PlannedDate
			$this->PlannedDate->ViewValue = $this->PlannedDate->CurrentValue;
			$this->PlannedDate->ViewValue = FormatDateTime($this->PlannedDate->ViewValue, 0);
			$this->PlannedDate->ViewCustomAttributes = "";

			// ActualDate
			$this->ActualDate->ViewValue = $this->ActualDate->CurrentValue;
			$this->ActualDate->ViewValue = FormatDateTime($this->ActualDate->ViewValue, 0);
			$this->ActualDate->ViewCustomAttributes = "";

			// Attendance
			$this->Attendance->ViewValue = $this->Attendance->CurrentValue;
			$this->Attendance->ViewCustomAttributes = "";

			// ChairedBy
			$this->ChairedBy->ViewValue = $this->ChairedBy->CurrentValue;
			$this->ChairedBy->ViewCustomAttributes = "";

			// Minutes
			$this->Minutes->ViewValue = $this->Minutes->CurrentValue;
			$this->Minutes->ViewCustomAttributes = "";

			// MinutesUploaded
			if (!EmptyValue($this->MinutesUploaded->Upload->DbValue)) {
				$this->MinutesUploaded->ViewValue = $this->MeetingNo->CurrentValue;
				$this->MinutesUploaded->IsBlobImage = IsImageFile(ContentExtension($this->MinutesUploaded->Upload->DbValue));
			} else {
				$this->MinutesUploaded->ViewValue = "";
			}
			$this->MinutesUploaded->ViewCustomAttributes = "";

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

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// PlannedDate
			$this->PlannedDate->LinkCustomAttributes = "";
			$this->PlannedDate->HrefValue = "";
			$this->PlannedDate->TooltipValue = "";

			// ActualDate
			$this->ActualDate->LinkCustomAttributes = "";
			$this->ActualDate->HrefValue = "";
			$this->ActualDate->TooltipValue = "";

			// Attendance
			$this->Attendance->LinkCustomAttributes = "";
			$this->Attendance->HrefValue = "";
			$this->Attendance->TooltipValue = "";

			// ChairedBy
			$this->ChairedBy->LinkCustomAttributes = "";
			$this->ChairedBy->HrefValue = "";
			$this->ChairedBy->TooltipValue = "";

			// Minutes
			$this->Minutes->LinkCustomAttributes = "";
			$this->Minutes->HrefValue = "";
			$this->Minutes->TooltipValue = "";

			// MinutesUploaded
			$this->MinutesUploaded->LinkCustomAttributes = "";
			if (!empty($this->MinutesUploaded->Upload->DbValue)) {
				$this->MinutesUploaded->HrefValue = GetFileUploadUrl($this->MinutesUploaded, $this->MeetingNo->CurrentValue);
				$this->MinutesUploaded->LinkAttrs["target"] = "";
				if ($this->MinutesUploaded->IsBlobImage && empty($this->MinutesUploaded->LinkAttrs["target"]))
					$this->MinutesUploaded->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->MinutesUploaded->HrefValue = FullUrl($this->MinutesUploaded->HrefValue, "href");
			} else {
				$this->MinutesUploaded->HrefValue = "";
			}
			$this->MinutesUploaded->ExportHrefValue = GetFileUploadUrl($this->MinutesUploaded, $this->MeetingNo->CurrentValue);
			$this->MinutesUploaded->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// MeetingNo
			$this->MeetingNo->EditAttrs["class"] = "form-control";
			$this->MeetingNo->EditCustomAttributes = "";
			$this->MeetingNo->EditValue = $this->MeetingNo->CurrentValue;
			$this->MeetingNo->ViewCustomAttributes = "";

			// MeetingRef
			$this->MeetingRef->EditAttrs["class"] = "form-control";
			$this->MeetingRef->EditCustomAttributes = "";
			if (!$this->MeetingRef->Raw)
				$this->MeetingRef->CurrentValue = HtmlDecode($this->MeetingRef->CurrentValue);
			$this->MeetingRef->EditValue = HtmlEncode($this->MeetingRef->CurrentValue);
			$this->MeetingRef->PlaceHolder = RemoveHtml($this->MeetingRef->caption());

			// MeetingType
			$this->MeetingType->EditAttrs["class"] = "form-control";
			$this->MeetingType->EditCustomAttributes = "";
			$curVal = trim(strval($this->MeetingType->CurrentValue));
			if ($curVal != "")
				$this->MeetingType->ViewValue = $this->MeetingType->lookupCacheOption($curVal);
			else
				$this->MeetingType->ViewValue = $this->MeetingType->Lookup !== NULL && is_array($this->MeetingType->Lookup->Options) ? $curVal : NULL;
			if ($this->MeetingType->ViewValue !== NULL) { // Load from cache
				$this->MeetingType->EditValue = array_values($this->MeetingType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`MeetingType`" . SearchString("=", $this->MeetingType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->MeetingType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->MeetingType->EditValue = $arwrk;
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

			// PlannedDate
			$this->PlannedDate->EditAttrs["class"] = "form-control";
			$this->PlannedDate->EditCustomAttributes = "";
			$this->PlannedDate->EditValue = HtmlEncode(FormatDateTime($this->PlannedDate->CurrentValue, 8));
			$this->PlannedDate->PlaceHolder = RemoveHtml($this->PlannedDate->caption());

			// ActualDate
			$this->ActualDate->EditAttrs["class"] = "form-control";
			$this->ActualDate->EditCustomAttributes = "";
			$this->ActualDate->EditValue = HtmlEncode(FormatDateTime($this->ActualDate->CurrentValue, 8));
			$this->ActualDate->PlaceHolder = RemoveHtml($this->ActualDate->caption());

			// Attendance
			$this->Attendance->EditAttrs["class"] = "form-control";
			$this->Attendance->EditCustomAttributes = "";
			if (!$this->Attendance->Raw)
				$this->Attendance->CurrentValue = HtmlDecode($this->Attendance->CurrentValue);
			$this->Attendance->EditValue = HtmlEncode($this->Attendance->CurrentValue);
			$this->Attendance->PlaceHolder = RemoveHtml($this->Attendance->caption());

			// ChairedBy
			$this->ChairedBy->EditAttrs["class"] = "form-control";
			$this->ChairedBy->EditCustomAttributes = "";
			if (!$this->ChairedBy->Raw)
				$this->ChairedBy->CurrentValue = HtmlDecode($this->ChairedBy->CurrentValue);
			$this->ChairedBy->EditValue = HtmlEncode($this->ChairedBy->CurrentValue);
			$this->ChairedBy->PlaceHolder = RemoveHtml($this->ChairedBy->caption());

			// Minutes
			$this->Minutes->EditAttrs["class"] = "form-control";
			$this->Minutes->EditCustomAttributes = "";
			$this->Minutes->EditValue = HtmlEncode($this->Minutes->CurrentValue);
			$this->Minutes->PlaceHolder = RemoveHtml($this->Minutes->caption());

			// MinutesUploaded
			$this->MinutesUploaded->EditAttrs["class"] = "form-control";
			$this->MinutesUploaded->EditCustomAttributes = "";
			if (!EmptyValue($this->MinutesUploaded->Upload->DbValue)) {
				$this->MinutesUploaded->EditValue = $this->MeetingNo->CurrentValue;
				$this->MinutesUploaded->IsBlobImage = IsImageFile(ContentExtension($this->MinutesUploaded->Upload->DbValue));
			} else {
				$this->MinutesUploaded->EditValue = "";
			}
			if ($this->isShow())
				RenderUploadField($this->MinutesUploaded);

			// Edit refer script
			// MeetingNo

			$this->MeetingNo->LinkCustomAttributes = "";
			$this->MeetingNo->HrefValue = "";

			// MeetingRef
			$this->MeetingRef->LinkCustomAttributes = "";
			$this->MeetingRef->HrefValue = "";

			// MeetingType
			$this->MeetingType->LinkCustomAttributes = "";
			$this->MeetingType->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// PlannedDate
			$this->PlannedDate->LinkCustomAttributes = "";
			$this->PlannedDate->HrefValue = "";

			// ActualDate
			$this->ActualDate->LinkCustomAttributes = "";
			$this->ActualDate->HrefValue = "";

			// Attendance
			$this->Attendance->LinkCustomAttributes = "";
			$this->Attendance->HrefValue = "";

			// ChairedBy
			$this->ChairedBy->LinkCustomAttributes = "";
			$this->ChairedBy->HrefValue = "";

			// Minutes
			$this->Minutes->LinkCustomAttributes = "";
			$this->Minutes->HrefValue = "";

			// MinutesUploaded
			$this->MinutesUploaded->LinkCustomAttributes = "";
			if (!empty($this->MinutesUploaded->Upload->DbValue)) {
				$this->MinutesUploaded->HrefValue = GetFileUploadUrl($this->MinutesUploaded, $this->MeetingNo->CurrentValue);
				$this->MinutesUploaded->LinkAttrs["target"] = "";
				if ($this->MinutesUploaded->IsBlobImage && empty($this->MinutesUploaded->LinkAttrs["target"]))
					$this->MinutesUploaded->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->MinutesUploaded->HrefValue = FullUrl($this->MinutesUploaded->HrefValue, "href");
			} else {
				$this->MinutesUploaded->HrefValue = "";
			}
			$this->MinutesUploaded->ExportHrefValue = GetFileUploadUrl($this->MinutesUploaded, $this->MeetingNo->CurrentValue);
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
		if ($this->MeetingNo->Required) {
			if (!$this->MeetingNo->IsDetailKey && $this->MeetingNo->FormValue != NULL && $this->MeetingNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MeetingNo->caption(), $this->MeetingNo->RequiredErrorMessage));
			}
		}
		if ($this->MeetingRef->Required) {
			if (!$this->MeetingRef->IsDetailKey && $this->MeetingRef->FormValue != NULL && $this->MeetingRef->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MeetingRef->caption(), $this->MeetingRef->RequiredErrorMessage));
			}
		}
		if ($this->MeetingType->Required) {
			if (!$this->MeetingType->IsDetailKey && $this->MeetingType->FormValue != NULL && $this->MeetingType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MeetingType->caption(), $this->MeetingType->RequiredErrorMessage));
			}
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->PlannedDate->Required) {
			if (!$this->PlannedDate->IsDetailKey && $this->PlannedDate->FormValue != NULL && $this->PlannedDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PlannedDate->caption(), $this->PlannedDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->PlannedDate->FormValue)) {
			AddMessage($FormError, $this->PlannedDate->errorMessage());
		}
		if ($this->ActualDate->Required) {
			if (!$this->ActualDate->IsDetailKey && $this->ActualDate->FormValue != NULL && $this->ActualDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualDate->caption(), $this->ActualDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActualDate->FormValue)) {
			AddMessage($FormError, $this->ActualDate->errorMessage());
		}
		if ($this->Attendance->Required) {
			if (!$this->Attendance->IsDetailKey && $this->Attendance->FormValue != NULL && $this->Attendance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Attendance->caption(), $this->Attendance->RequiredErrorMessage));
			}
		}
		if ($this->ChairedBy->Required) {
			if (!$this->ChairedBy->IsDetailKey && $this->ChairedBy->FormValue != NULL && $this->ChairedBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChairedBy->caption(), $this->ChairedBy->RequiredErrorMessage));
			}
		}
		if ($this->Minutes->Required) {
			if (!$this->Minutes->IsDetailKey && $this->Minutes->FormValue != NULL && $this->Minutes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Minutes->caption(), $this->Minutes->RequiredErrorMessage));
			}
		}
		if ($this->MinutesUploaded->Required) {
			if ($this->MinutesUploaded->Upload->FileName == "" && !$this->MinutesUploaded->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->MinutesUploaded->caption(), $this->MinutesUploaded->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("council_resolution", $detailTblVar) && $GLOBALS["council_resolution"]->DetailEdit) {
			if (!isset($GLOBALS["council_resolution_grid"]))
				$GLOBALS["council_resolution_grid"] = new council_resolution_grid(); // Get detail page object
			$GLOBALS["council_resolution_grid"]->validateGridForm();
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

			// MeetingRef
			$this->MeetingRef->setDbValueDef($rsnew, $this->MeetingRef->CurrentValue, NULL, $this->MeetingRef->ReadOnly);

			// MeetingType
			$this->MeetingType->setDbValueDef($rsnew, $this->MeetingType->CurrentValue, 0, $this->MeetingType->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// PlannedDate
			$this->PlannedDate->setDbValueDef($rsnew, UnFormatDateTime($this->PlannedDate->CurrentValue, 0), CurrentDate(), $this->PlannedDate->ReadOnly);

			// ActualDate
			$this->ActualDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActualDate->CurrentValue, 0), NULL, $this->ActualDate->ReadOnly);

			// Attendance
			$this->Attendance->setDbValueDef($rsnew, $this->Attendance->CurrentValue, NULL, $this->Attendance->ReadOnly);

			// ChairedBy
			$this->ChairedBy->setDbValueDef($rsnew, $this->ChairedBy->CurrentValue, NULL, $this->ChairedBy->ReadOnly);

			// Minutes
			$this->Minutes->setDbValueDef($rsnew, $this->Minutes->CurrentValue, NULL, $this->Minutes->ReadOnly);

			// MinutesUploaded
			if ($this->MinutesUploaded->Visible && !$this->MinutesUploaded->ReadOnly && !$this->MinutesUploaded->Upload->KeepFile) {
				if ($this->MinutesUploaded->Upload->Value == NULL) {
					$rsnew['MinutesUploaded'] = NULL;
				} else {
					$rsnew['MinutesUploaded'] = $this->MinutesUploaded->Upload->Value;
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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("council_resolution", $detailTblVar) && $GLOBALS["council_resolution"]->DetailEdit) {
						if (!isset($GLOBALS["council_resolution_grid"]))
							$GLOBALS["council_resolution_grid"] = new council_resolution_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "council_resolution"); // Load user level of detail table
						$editRow = $GLOBALS["council_resolution_grid"]->gridUpdate();
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

			// MinutesUploaded
			CleanUploadTempPath($this->MinutesUploaded, $this->MinutesUploaded->Upload->Index);
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
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["local_authority"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
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
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["local_authority"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
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
			if ($masterTblVar != "local_authority") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
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
			if (in_array("council_resolution", $detailTblVar)) {
				if (!isset($GLOBALS["council_resolution_grid"]))
					$GLOBALS["council_resolution_grid"] = new council_resolution_grid();
				if ($GLOBALS["council_resolution_grid"]->DetailEdit) {
					$GLOBALS["council_resolution_grid"]->CurrentMode = "edit";
					$GLOBALS["council_resolution_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["council_resolution_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["council_resolution_grid"]->setStartRecordNumber(1);
					$GLOBALS["council_resolution_grid"]->MeetingNo->IsDetailKey = TRUE;
					$GLOBALS["council_resolution_grid"]->MeetingNo->CurrentValue = $this->MeetingNo->CurrentValue;
					$GLOBALS["council_resolution_grid"]->MeetingNo->setSessionValue($GLOBALS["council_resolution_grid"]->MeetingNo->CurrentValue);
					$GLOBALS["council_resolution_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["council_resolution_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["council_resolution_grid"]->LACode->setSessionValue($GLOBALS["council_resolution_grid"]->LACode->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("council_meetinglist.php"), "", $this->TableVar, TRUE);
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
				case "x_MeetingType":
					break;
				case "x_LACode":
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
						case "x_MeetingType":
							break;
						case "x_LACode":
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