<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class council_resolution_edit extends council_resolution
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'council_resolution';

	// Page object name
	public $PageObjName = "council_resolution_edit";

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

		// Table object (council_resolution)
		if (!isset($GLOBALS["council_resolution"]) || get_class($GLOBALS["council_resolution"]) == PROJECT_NAMESPACE . "council_resolution") {
			$GLOBALS["council_resolution"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["council_resolution"];
		}

		// Table object (council_meeting)
		if (!isset($GLOBALS['council_meeting']))
			$GLOBALS['council_meeting'] = new council_meeting();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'council_resolution');

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
		global $council_resolution;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($council_resolution);
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
					if ($pageName == "council_resolutionview.php")
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
					$this->terminate(GetUrl("council_resolutionlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->MeetingNo->setVisibility();
		$this->MinuteNumber->setVisibility();
		$this->Subject->setVisibility();
		$this->Resolutionccategory->setVisibility();
		$this->LACode->setVisibility();
		$this->ResolutionNo->setVisibility();
		$this->Resolution->setVisibility();
		$this->Responsibility->setVisibility();
		$this->ActionDate->setVisibility();
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
		$this->setupLookupOptions($this->MeetingNo);
		$this->setupLookupOptions($this->Resolutionccategory);
		$this->setupLookupOptions($this->LACode);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("council_resolutionlist.php");
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
			if (Get("ResolutionNo") !== NULL) {
				$this->ResolutionNo->setQueryStringValue(Get("ResolutionNo"));
				$this->ResolutionNo->setOldValue($this->ResolutionNo->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->ResolutionNo->setQueryStringValue(Key(0));
				$this->ResolutionNo->setOldValue($this->ResolutionNo->QueryStringValue);
			} elseif (Post("ResolutionNo") !== NULL) {
				$this->ResolutionNo->setFormValue(Post("ResolutionNo"));
				$this->ResolutionNo->setOldValue($this->ResolutionNo->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->ResolutionNo->setQueryStringValue(Route(2));
				$this->ResolutionNo->setOldValue($this->ResolutionNo->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_ResolutionNo")) {
					$this->ResolutionNo->setFormValue($CurrentForm->getValue("x_ResolutionNo"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("ResolutionNo") !== NULL) {
					$this->ResolutionNo->setQueryStringValue(Get("ResolutionNo"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->ResolutionNo->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->ResolutionNo->CurrentValue = NULL;
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
				$this->terminate("council_resolutionlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->ResolutionNo->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->ResolutionNo->CurrentValue, $rs->fields('ResolutionNo'))) {
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
					$this->terminate("council_resolutionlist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "council_resolutionlist.php")
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

		// Check field name 'MeetingNo' first before field var 'x_MeetingNo'
		$val = $CurrentForm->hasValue("MeetingNo") ? $CurrentForm->getValue("MeetingNo") : $CurrentForm->getValue("x_MeetingNo");
		if (!$this->MeetingNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MeetingNo->Visible = FALSE; // Disable update for API request
			else
				$this->MeetingNo->setFormValue($val);
		}

		// Check field name 'MinuteNumber' first before field var 'x_MinuteNumber'
		$val = $CurrentForm->hasValue("MinuteNumber") ? $CurrentForm->getValue("MinuteNumber") : $CurrentForm->getValue("x_MinuteNumber");
		if (!$this->MinuteNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->MinuteNumber->Visible = FALSE; // Disable update for API request
			else
				$this->MinuteNumber->setFormValue($val);
		}

		// Check field name 'Subject' first before field var 'x_Subject'
		$val = $CurrentForm->hasValue("Subject") ? $CurrentForm->getValue("Subject") : $CurrentForm->getValue("x_Subject");
		if (!$this->Subject->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Subject->Visible = FALSE; // Disable update for API request
			else
				$this->Subject->setFormValue($val);
		}

		// Check field name 'Resolutionccategory' first before field var 'x_Resolutionccategory'
		$val = $CurrentForm->hasValue("Resolutionccategory") ? $CurrentForm->getValue("Resolutionccategory") : $CurrentForm->getValue("x_Resolutionccategory");
		if (!$this->Resolutionccategory->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Resolutionccategory->Visible = FALSE; // Disable update for API request
			else
				$this->Resolutionccategory->setFormValue($val);
		}

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}

		// Check field name 'ResolutionNo' first before field var 'x_ResolutionNo'
		$val = $CurrentForm->hasValue("ResolutionNo") ? $CurrentForm->getValue("ResolutionNo") : $CurrentForm->getValue("x_ResolutionNo");
		if (!$this->ResolutionNo->IsDetailKey)
			$this->ResolutionNo->setFormValue($val);

		// Check field name 'Resolution' first before field var 'x_Resolution'
		$val = $CurrentForm->hasValue("Resolution") ? $CurrentForm->getValue("Resolution") : $CurrentForm->getValue("x_Resolution");
		if (!$this->Resolution->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Resolution->Visible = FALSE; // Disable update for API request
			else
				$this->Resolution->setFormValue($val);
		}

		// Check field name 'Responsibility' first before field var 'x_Responsibility'
		$val = $CurrentForm->hasValue("Responsibility") ? $CurrentForm->getValue("Responsibility") : $CurrentForm->getValue("x_Responsibility");
		if (!$this->Responsibility->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Responsibility->Visible = FALSE; // Disable update for API request
			else
				$this->Responsibility->setFormValue($val);
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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->MeetingNo->CurrentValue = $this->MeetingNo->FormValue;
		$this->MinuteNumber->CurrentValue = $this->MinuteNumber->FormValue;
		$this->Subject->CurrentValue = $this->Subject->FormValue;
		$this->Resolutionccategory->CurrentValue = $this->Resolutionccategory->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->ResolutionNo->CurrentValue = $this->ResolutionNo->FormValue;
		$this->Resolution->CurrentValue = $this->Resolution->FormValue;
		$this->Responsibility->CurrentValue = $this->Responsibility->FormValue;
		$this->ActionDate->CurrentValue = $this->ActionDate->FormValue;
		$this->ActionDate->CurrentValue = UnFormatDateTime($this->ActionDate->CurrentValue, 0);
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
		$this->MinuteNumber->setDbValue($row['MinuteNumber']);
		$this->Subject->setDbValue($row['Subject']);
		$this->Resolutionccategory->setDbValue($row['Resolutionccategory']);
		$this->LACode->setDbValue($row['LACode']);
		$this->ResolutionNo->setDbValue($row['ResolutionNo']);
		$this->Resolution->setDbValue($row['Resolution']);
		$this->Responsibility->setDbValue($row['Responsibility']);
		$this->ActionDate->setDbValue($row['ActionDate']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['MeetingNo'] = NULL;
		$row['MinuteNumber'] = NULL;
		$row['Subject'] = NULL;
		$row['Resolutionccategory'] = NULL;
		$row['LACode'] = NULL;
		$row['ResolutionNo'] = NULL;
		$row['Resolution'] = NULL;
		$row['Responsibility'] = NULL;
		$row['ActionDate'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ResolutionNo")) != "")
			$this->ResolutionNo->OldValue = $this->getKey("ResolutionNo"); // ResolutionNo
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
		// MinuteNumber
		// Subject
		// Resolutionccategory
		// LACode
		// ResolutionNo
		// Resolution
		// Responsibility
		// ActionDate

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// MeetingNo
			$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
			$curVal = strval($this->MeetingNo->CurrentValue);
			if ($curVal != "") {
				$this->MeetingNo->ViewValue = $this->MeetingNo->lookupCacheOption($curVal);
				if ($this->MeetingNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MeetingNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MeetingNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
						$this->MeetingNo->ViewValue = $this->MeetingNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
					}
				}
			} else {
				$this->MeetingNo->ViewValue = NULL;
			}
			$this->MeetingNo->ViewCustomAttributes = "";

			// MinuteNumber
			$this->MinuteNumber->ViewValue = $this->MinuteNumber->CurrentValue;
			$this->MinuteNumber->ViewCustomAttributes = "";

			// Subject
			$this->Subject->ViewValue = $this->Subject->CurrentValue;
			$this->Subject->ViewCustomAttributes = "";

			// Resolutionccategory
			$curVal = strval($this->Resolutionccategory->CurrentValue);
			if ($curVal != "") {
				$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->lookupCacheOption($curVal);
				if ($this->Resolutionccategory->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ResolutionCategoryCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Resolutionccategory->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->CurrentValue;
					}
				}
			} else {
				$this->Resolutionccategory->ViewValue = NULL;
			}
			$this->Resolutionccategory->ViewCustomAttributes = "";

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

			// MeetingNo
			$this->MeetingNo->LinkCustomAttributes = "";
			$this->MeetingNo->HrefValue = "";
			$this->MeetingNo->TooltipValue = "";

			// MinuteNumber
			$this->MinuteNumber->LinkCustomAttributes = "";
			$this->MinuteNumber->HrefValue = "";
			$this->MinuteNumber->TooltipValue = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";
			$this->Subject->TooltipValue = "";

			// Resolutionccategory
			$this->Resolutionccategory->LinkCustomAttributes = "";
			$this->Resolutionccategory->HrefValue = "";
			$this->Resolutionccategory->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// MeetingNo
			$this->MeetingNo->EditAttrs["class"] = "form-control";
			$this->MeetingNo->EditCustomAttributes = "";
			if ($this->MeetingNo->getSessionValue() != "") {
				$this->MeetingNo->CurrentValue = $this->MeetingNo->getSessionValue();
				$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
				$curVal = strval($this->MeetingNo->CurrentValue);
				if ($curVal != "") {
					$this->MeetingNo->ViewValue = $this->MeetingNo->lookupCacheOption($curVal);
					if ($this->MeetingNo->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`MeetingNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->MeetingNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = FormatDateTime($rswrk->fields('df2'), 0);
							$this->MeetingNo->ViewValue = $this->MeetingNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->MeetingNo->ViewValue = $this->MeetingNo->CurrentValue;
						}
					}
				} else {
					$this->MeetingNo->ViewValue = NULL;
				}
				$this->MeetingNo->ViewCustomAttributes = "";
			} else {
				$this->MeetingNo->EditValue = HtmlEncode($this->MeetingNo->CurrentValue);
				$curVal = strval($this->MeetingNo->CurrentValue);
				if ($curVal != "") {
					$this->MeetingNo->EditValue = $this->MeetingNo->lookupCacheOption($curVal);
					if ($this->MeetingNo->EditValue === NULL) { // Lookup from database
						$filterWrk = "`MeetingNo`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->MeetingNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$arwrk[2] = HtmlEncode(FormatDateTime($rswrk->fields('df2'), 0));
							$this->MeetingNo->EditValue = $this->MeetingNo->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->MeetingNo->EditValue = HtmlEncode($this->MeetingNo->CurrentValue);
						}
					}
				} else {
					$this->MeetingNo->EditValue = NULL;
				}
				$this->MeetingNo->PlaceHolder = RemoveHtml($this->MeetingNo->caption());
			}

			// MinuteNumber
			$this->MinuteNumber->EditAttrs["class"] = "form-control";
			$this->MinuteNumber->EditCustomAttributes = "";
			if (!$this->MinuteNumber->Raw)
				$this->MinuteNumber->CurrentValue = HtmlDecode($this->MinuteNumber->CurrentValue);
			$this->MinuteNumber->EditValue = HtmlEncode($this->MinuteNumber->CurrentValue);
			$this->MinuteNumber->PlaceHolder = RemoveHtml($this->MinuteNumber->caption());

			// Subject
			$this->Subject->EditAttrs["class"] = "form-control";
			$this->Subject->EditCustomAttributes = "";
			$this->Subject->EditValue = HtmlEncode($this->Subject->CurrentValue);
			$this->Subject->PlaceHolder = RemoveHtml($this->Subject->caption());

			// Resolutionccategory
			$this->Resolutionccategory->EditAttrs["class"] = "form-control";
			$this->Resolutionccategory->EditCustomAttributes = "";
			$curVal = trim(strval($this->Resolutionccategory->CurrentValue));
			if ($curVal != "")
				$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->lookupCacheOption($curVal);
			else
				$this->Resolutionccategory->ViewValue = $this->Resolutionccategory->Lookup !== NULL && is_array($this->Resolutionccategory->Lookup->Options) ? $curVal : NULL;
			if ($this->Resolutionccategory->ViewValue !== NULL) { // Load from cache
				$this->Resolutionccategory->EditValue = array_values($this->Resolutionccategory->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ResolutionCategoryCode`" . SearchString("=", $this->Resolutionccategory->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Resolutionccategory->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Resolutionccategory->EditValue = $arwrk;
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

			// ResolutionNo
			$this->ResolutionNo->EditAttrs["class"] = "form-control";
			$this->ResolutionNo->EditCustomAttributes = "";
			$this->ResolutionNo->EditValue = $this->ResolutionNo->CurrentValue;
			$this->ResolutionNo->ViewCustomAttributes = "";

			// Resolution
			$this->Resolution->EditAttrs["class"] = "form-control";
			$this->Resolution->EditCustomAttributes = "";
			$this->Resolution->EditValue = HtmlEncode($this->Resolution->CurrentValue);
			$this->Resolution->PlaceHolder = RemoveHtml($this->Resolution->caption());

			// Responsibility
			$this->Responsibility->EditAttrs["class"] = "form-control";
			$this->Responsibility->EditCustomAttributes = "";
			if (!$this->Responsibility->Raw)
				$this->Responsibility->CurrentValue = HtmlDecode($this->Responsibility->CurrentValue);
			$this->Responsibility->EditValue = HtmlEncode($this->Responsibility->CurrentValue);
			$this->Responsibility->PlaceHolder = RemoveHtml($this->Responsibility->caption());

			// ActionDate
			$this->ActionDate->EditAttrs["class"] = "form-control";
			$this->ActionDate->EditCustomAttributes = "";
			$this->ActionDate->EditValue = HtmlEncode(FormatDateTime($this->ActionDate->CurrentValue, 8));
			$this->ActionDate->PlaceHolder = RemoveHtml($this->ActionDate->caption());

			// Edit refer script
			// MeetingNo

			$this->MeetingNo->LinkCustomAttributes = "";
			$this->MeetingNo->HrefValue = "";

			// MinuteNumber
			$this->MinuteNumber->LinkCustomAttributes = "";
			$this->MinuteNumber->HrefValue = "";

			// Subject
			$this->Subject->LinkCustomAttributes = "";
			$this->Subject->HrefValue = "";

			// Resolutionccategory
			$this->Resolutionccategory->LinkCustomAttributes = "";
			$this->Resolutionccategory->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// ResolutionNo
			$this->ResolutionNo->LinkCustomAttributes = "";
			$this->ResolutionNo->HrefValue = "";

			// Resolution
			$this->Resolution->LinkCustomAttributes = "";
			$this->Resolution->HrefValue = "";

			// Responsibility
			$this->Responsibility->LinkCustomAttributes = "";
			$this->Responsibility->HrefValue = "";

			// ActionDate
			$this->ActionDate->LinkCustomAttributes = "";
			$this->ActionDate->HrefValue = "";
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
		if (!CheckInteger($this->MeetingNo->FormValue)) {
			AddMessage($FormError, $this->MeetingNo->errorMessage());
		}
		if ($this->MinuteNumber->Required) {
			if (!$this->MinuteNumber->IsDetailKey && $this->MinuteNumber->FormValue != NULL && $this->MinuteNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MinuteNumber->caption(), $this->MinuteNumber->RequiredErrorMessage));
			}
		}
		if ($this->Subject->Required) {
			if (!$this->Subject->IsDetailKey && $this->Subject->FormValue != NULL && $this->Subject->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Subject->caption(), $this->Subject->RequiredErrorMessage));
			}
		}
		if ($this->Resolutionccategory->Required) {
			if (!$this->Resolutionccategory->IsDetailKey && $this->Resolutionccategory->FormValue != NULL && $this->Resolutionccategory->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Resolutionccategory->caption(), $this->Resolutionccategory->RequiredErrorMessage));
			}
		}
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if ($this->ResolutionNo->Required) {
			if (!$this->ResolutionNo->IsDetailKey && $this->ResolutionNo->FormValue != NULL && $this->ResolutionNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ResolutionNo->caption(), $this->ResolutionNo->RequiredErrorMessage));
			}
		}
		if ($this->Resolution->Required) {
			if (!$this->Resolution->IsDetailKey && $this->Resolution->FormValue != NULL && $this->Resolution->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Resolution->caption(), $this->Resolution->RequiredErrorMessage));
			}
		}
		if ($this->Responsibility->Required) {
			if (!$this->Responsibility->IsDetailKey && $this->Responsibility->FormValue != NULL && $this->Responsibility->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Responsibility->caption(), $this->Responsibility->RequiredErrorMessage));
			}
		}
		if ($this->ActionDate->Required) {
			if (!$this->ActionDate->IsDetailKey && $this->ActionDate->FormValue != NULL && $this->ActionDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActionDate->caption(), $this->ActionDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ActionDate->FormValue)) {
			AddMessage($FormError, $this->ActionDate->errorMessage());
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

			// MeetingNo
			$this->MeetingNo->setDbValueDef($rsnew, $this->MeetingNo->CurrentValue, 0, $this->MeetingNo->ReadOnly);

			// MinuteNumber
			$this->MinuteNumber->setDbValueDef($rsnew, $this->MinuteNumber->CurrentValue, "", $this->MinuteNumber->ReadOnly);

			// Subject
			$this->Subject->setDbValueDef($rsnew, $this->Subject->CurrentValue, "", $this->Subject->ReadOnly);

			// Resolutionccategory
			$this->Resolutionccategory->setDbValueDef($rsnew, $this->Resolutionccategory->CurrentValue, 0, $this->Resolutionccategory->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// Resolution
			$this->Resolution->setDbValueDef($rsnew, $this->Resolution->CurrentValue, NULL, $this->Resolution->ReadOnly);

			// Responsibility
			$this->Responsibility->setDbValueDef($rsnew, $this->Responsibility->CurrentValue, "", $this->Responsibility->ReadOnly);

			// ActionDate
			$this->ActionDate->setDbValueDef($rsnew, UnFormatDateTime($this->ActionDate->CurrentValue, 0), CurrentDate(), $this->ActionDate->ReadOnly);

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
			if ($masterTblVar == "council_meeting") {
				$validMaster = TRUE;
				if (($parm = Get("fk_MeetingNo", Get("MeetingNo"))) !== NULL) {
					$GLOBALS["council_meeting"]->MeetingNo->setQueryStringValue($parm);
					$this->MeetingNo->setQueryStringValue($GLOBALS["council_meeting"]->MeetingNo->QueryStringValue);
					$this->MeetingNo->setSessionValue($this->MeetingNo->QueryStringValue);
					if (!is_numeric($GLOBALS["council_meeting"]->MeetingNo->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["council_meeting"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["council_meeting"]->LACode->QueryStringValue);
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
			if ($masterTblVar == "council_meeting") {
				$validMaster = TRUE;
				if (($parm = Post("fk_MeetingNo", Post("MeetingNo"))) !== NULL) {
					$GLOBALS["council_meeting"]->MeetingNo->setFormValue($parm);
					$this->MeetingNo->setFormValue($GLOBALS["council_meeting"]->MeetingNo->FormValue);
					$this->MeetingNo->setSessionValue($this->MeetingNo->FormValue);
					if (!is_numeric($GLOBALS["council_meeting"]->MeetingNo->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["council_meeting"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["council_meeting"]->LACode->FormValue);
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
			if ($masterTblVar != "council_meeting") {
				if ($this->MeetingNo->CurrentValue == "")
					$this->MeetingNo->setSessionValue("");
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("council_resolutionlist.php"), "", $this->TableVar, TRUE);
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
				case "x_MeetingNo":
					break;
				case "x_Resolutionccategory":
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
						case "x_MeetingNo":
							$row[2] = FormatDateTime($row[2], 0);
							$row['df2'] = $row[2];
							break;
						case "x_Resolutionccategory":
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