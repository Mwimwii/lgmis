<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class local_authority_edit extends local_authority
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'local_authority';

	// Page object name
	public $PageObjName = "local_authority_edit";

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

		// Table object (local_authority)
		if (!isset($GLOBALS["local_authority"]) || get_class($GLOBALS["local_authority"]) == PROJECT_NAMESPACE . "local_authority") {
			$GLOBALS["local_authority"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["local_authority"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Table object (province)
		if (!isset($GLOBALS['province']))
			$GLOBALS['province'] = new province();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'local_authority');

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
		global $local_authority;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($local_authority);
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
					if ($pageName == "local_authorityview.php")
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
			$key .= @$ar['LACode'];
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
					$this->terminate(GetUrl("local_authoritylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LACode->setVisibility();
		$this->LAName->setVisibility();
		$this->CouncilType->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->Created->Visible = FALSE;
		$this->OpeningDate->Visible = FALSE;
		$this->ClosedDate->Visible = FALSE;
		$this->OrgUnitLevel->Visible = FALSE;
		$this->Mandate->setVisibility();
		$this->Strategy->setVisibility();
		$this->Clients->setVisibility();
		$this->Beneficiaries->setVisibility();
		$this->ExecutiveAuthority->setVisibility();
		$this->ControllingOfficer->setVisibility();
		$this->Comment->setVisibility();
		$this->LastUpdated->Visible = FALSE;
		$this->LastUserId->Visible = FALSE;
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
		$this->setupLookupOptions($this->CouncilType);
		$this->setupLookupOptions($this->ProvinceCode);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("local_authoritylist.php");
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
			if (Get("LACode") !== NULL) {
				$this->LACode->setQueryStringValue(Get("LACode"));
				$this->LACode->setOldValue($this->LACode->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->LACode->setQueryStringValue(Key(0));
				$this->LACode->setOldValue($this->LACode->QueryStringValue);
			} elseif (Post("LACode") !== NULL) {
				$this->LACode->setFormValue(Post("LACode"));
				$this->LACode->setOldValue($this->LACode->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->LACode->setQueryStringValue(Route(2));
				$this->LACode->setOldValue($this->LACode->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_LACode")) {
					$this->LACode->setFormValue($CurrentForm->getValue("x_LACode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("LACode") !== NULL) {
					$this->LACode->setQueryStringValue(Get("LACode"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->LACode->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->LACode->CurrentValue = NULL;
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
				$this->terminate("local_authoritylist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->LACode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->LACode->CurrentValue, $rs->fields('LACode'))) {
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
					$this->terminate("local_authoritylist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "local_authoritylist.php")
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

		// Check field name 'LACode' first before field var 'x_LACode'
		$val = $CurrentForm->hasValue("LACode") ? $CurrentForm->getValue("LACode") : $CurrentForm->getValue("x_LACode");
		if (!$this->LACode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LACode->Visible = FALSE; // Disable update for API request
			else
				$this->LACode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_LACode"))
			$this->LACode->setOldValue($CurrentForm->getValue("o_LACode"));

		// Check field name 'LAName' first before field var 'x_LAName'
		$val = $CurrentForm->hasValue("LAName") ? $CurrentForm->getValue("LAName") : $CurrentForm->getValue("x_LAName");
		if (!$this->LAName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LAName->Visible = FALSE; // Disable update for API request
			else
				$this->LAName->setFormValue($val);
		}

		// Check field name 'CouncilType' first before field var 'x_CouncilType'
		$val = $CurrentForm->hasValue("CouncilType") ? $CurrentForm->getValue("CouncilType") : $CurrentForm->getValue("x_CouncilType");
		if (!$this->CouncilType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CouncilType->Visible = FALSE; // Disable update for API request
			else
				$this->CouncilType->setFormValue($val);
		}

		// Check field name 'ProvinceCode' first before field var 'x_ProvinceCode'
		$val = $CurrentForm->hasValue("ProvinceCode") ? $CurrentForm->getValue("ProvinceCode") : $CurrentForm->getValue("x_ProvinceCode");
		if (!$this->ProvinceCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ProvinceCode->Visible = FALSE; // Disable update for API request
			else
				$this->ProvinceCode->setFormValue($val);
		}

		// Check field name 'Mandate' first before field var 'x_Mandate'
		$val = $CurrentForm->hasValue("Mandate") ? $CurrentForm->getValue("Mandate") : $CurrentForm->getValue("x_Mandate");
		if (!$this->Mandate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Mandate->Visible = FALSE; // Disable update for API request
			else
				$this->Mandate->setFormValue($val);
		}

		// Check field name 'Strategy' first before field var 'x_Strategy'
		$val = $CurrentForm->hasValue("Strategy") ? $CurrentForm->getValue("Strategy") : $CurrentForm->getValue("x_Strategy");
		if (!$this->Strategy->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Strategy->Visible = FALSE; // Disable update for API request
			else
				$this->Strategy->setFormValue($val);
		}

		// Check field name 'Clients' first before field var 'x_Clients'
		$val = $CurrentForm->hasValue("Clients") ? $CurrentForm->getValue("Clients") : $CurrentForm->getValue("x_Clients");
		if (!$this->Clients->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Clients->Visible = FALSE; // Disable update for API request
			else
				$this->Clients->setFormValue($val);
		}

		// Check field name 'Beneficiaries' first before field var 'x_Beneficiaries'
		$val = $CurrentForm->hasValue("Beneficiaries") ? $CurrentForm->getValue("Beneficiaries") : $CurrentForm->getValue("x_Beneficiaries");
		if (!$this->Beneficiaries->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Beneficiaries->Visible = FALSE; // Disable update for API request
			else
				$this->Beneficiaries->setFormValue($val);
		}

		// Check field name 'ExecutiveAuthority' first before field var 'x_ExecutiveAuthority'
		$val = $CurrentForm->hasValue("ExecutiveAuthority") ? $CurrentForm->getValue("ExecutiveAuthority") : $CurrentForm->getValue("x_ExecutiveAuthority");
		if (!$this->ExecutiveAuthority->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ExecutiveAuthority->Visible = FALSE; // Disable update for API request
			else
				$this->ExecutiveAuthority->setFormValue($val);
		}

		// Check field name 'ControllingOfficer' first before field var 'x_ControllingOfficer'
		$val = $CurrentForm->hasValue("ControllingOfficer") ? $CurrentForm->getValue("ControllingOfficer") : $CurrentForm->getValue("x_ControllingOfficer");
		if (!$this->ControllingOfficer->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ControllingOfficer->Visible = FALSE; // Disable update for API request
			else
				$this->ControllingOfficer->setFormValue($val);
		}

		// Check field name 'Comment' first before field var 'x_Comment'
		$val = $CurrentForm->hasValue("Comment") ? $CurrentForm->getValue("Comment") : $CurrentForm->getValue("x_Comment");
		if (!$this->Comment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Comment->Visible = FALSE; // Disable update for API request
			else
				$this->Comment->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->LAName->CurrentValue = $this->LAName->FormValue;
		$this->CouncilType->CurrentValue = $this->CouncilType->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->Mandate->CurrentValue = $this->Mandate->FormValue;
		$this->Strategy->CurrentValue = $this->Strategy->FormValue;
		$this->Clients->CurrentValue = $this->Clients->FormValue;
		$this->Beneficiaries->CurrentValue = $this->Beneficiaries->FormValue;
		$this->ExecutiveAuthority->CurrentValue = $this->ExecutiveAuthority->FormValue;
		$this->ControllingOfficer->CurrentValue = $this->ControllingOfficer->FormValue;
		$this->Comment->CurrentValue = $this->Comment->FormValue;
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
		$this->LACode->setDbValue($row['LACode']);
		$this->LAName->setDbValue($row['LAName']);
		$this->CouncilType->setDbValue($row['CouncilType']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->Created->setDbValue($row['Created']);
		$this->OpeningDate->setDbValue($row['OpeningDate']);
		$this->ClosedDate->setDbValue($row['ClosedDate']);
		$this->OrgUnitLevel->setDbValue($row['OrgUnitLevel']);
		$this->Mandate->setDbValue($row['Mandate']);
		$this->Strategy->setDbValue($row['Strategy']);
		$this->Clients->setDbValue($row['Clients']);
		$this->Beneficiaries->setDbValue($row['Beneficiaries']);
		$this->ExecutiveAuthority->setDbValue($row['ExecutiveAuthority']);
		$this->ControllingOfficer->setDbValue($row['ControllingOfficer']);
		$this->Comment->setDbValue($row['Comment']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->LastUserId->setDbValue($row['LastUserId']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['LACode'] = NULL;
		$row['LAName'] = NULL;
		$row['CouncilType'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['Created'] = NULL;
		$row['OpeningDate'] = NULL;
		$row['ClosedDate'] = NULL;
		$row['OrgUnitLevel'] = NULL;
		$row['Mandate'] = NULL;
		$row['Strategy'] = NULL;
		$row['Clients'] = NULL;
		$row['Beneficiaries'] = NULL;
		$row['ExecutiveAuthority'] = NULL;
		$row['ControllingOfficer'] = NULL;
		$row['Comment'] = NULL;
		$row['LastUpdated'] = NULL;
		$row['LastUserId'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("LACode")) != "")
			$this->LACode->OldValue = $this->getKey("LACode"); // LACode
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
		// LACode
		// LAName
		// CouncilType
		// ProvinceCode
		// Created
		// OpeningDate
		// ClosedDate
		// OrgUnitLevel
		// Mandate
		// Strategy
		// Clients
		// Beneficiaries
		// ExecutiveAuthority
		// ControllingOfficer
		// Comment
		// LastUpdated
		// LastUserId

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// LACode
			$this->LACode->ViewValue = $this->LACode->CurrentValue;
			$this->LACode->ViewCustomAttributes = "";

			// LAName
			$this->LAName->ViewValue = $this->LAName->CurrentValue;
			$this->LAName->ViewCustomAttributes = "";

			// CouncilType
			$curVal = strval($this->CouncilType->CurrentValue);
			if ($curVal != "") {
				$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
				if ($this->CouncilType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LAType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CouncilType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CouncilType->ViewValue = $this->CouncilType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CouncilType->ViewValue = $this->CouncilType->CurrentValue;
					}
				}
			} else {
				$this->CouncilType->ViewValue = NULL;
			}
			$this->CouncilType->ViewCustomAttributes = "";

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

			// Mandate
			$this->Mandate->ViewValue = $this->Mandate->CurrentValue;
			$this->Mandate->ViewCustomAttributes = "";

			// Strategy
			$this->Strategy->ViewValue = $this->Strategy->CurrentValue;
			$this->Strategy->ViewCustomAttributes = "";

			// Clients
			$this->Clients->ViewValue = $this->Clients->CurrentValue;
			$this->Clients->ViewCustomAttributes = "";

			// Beneficiaries
			$this->Beneficiaries->ViewValue = $this->Beneficiaries->CurrentValue;
			$this->Beneficiaries->ViewCustomAttributes = "";

			// ExecutiveAuthority
			$this->ExecutiveAuthority->ViewValue = $this->ExecutiveAuthority->CurrentValue;
			$this->ExecutiveAuthority->ViewCustomAttributes = "";

			// ControllingOfficer
			$this->ControllingOfficer->ViewValue = $this->ControllingOfficer->CurrentValue;
			$this->ControllingOfficer->ViewCustomAttributes = "";

			// Comment
			$this->Comment->ViewValue = $this->Comment->CurrentValue;
			$this->Comment->ViewCustomAttributes = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";
			$this->LAName->TooltipValue = "";

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";
			$this->CouncilType->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// Mandate
			$this->Mandate->LinkCustomAttributes = "";
			$this->Mandate->HrefValue = "";
			$this->Mandate->TooltipValue = "";

			// Strategy
			$this->Strategy->LinkCustomAttributes = "";
			$this->Strategy->HrefValue = "";
			$this->Strategy->TooltipValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";
			$this->Clients->TooltipValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";
			$this->Beneficiaries->TooltipValue = "";

			// ExecutiveAuthority
			$this->ExecutiveAuthority->LinkCustomAttributes = "";
			$this->ExecutiveAuthority->HrefValue = "";
			$this->ExecutiveAuthority->TooltipValue = "";

			// ControllingOfficer
			$this->ControllingOfficer->LinkCustomAttributes = "";
			$this->ControllingOfficer->HrefValue = "";
			$this->ControllingOfficer->TooltipValue = "";

			// Comment
			$this->Comment->LinkCustomAttributes = "";
			$this->Comment->HrefValue = "";
			$this->Comment->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
			if (!$this->LACode->Raw)
				$this->LACode->CurrentValue = HtmlDecode($this->LACode->CurrentValue);
			$this->LACode->EditValue = HtmlEncode($this->LACode->CurrentValue);
			$this->LACode->PlaceHolder = RemoveHtml($this->LACode->caption());

			// LAName
			$this->LAName->EditAttrs["class"] = "form-control";
			$this->LAName->EditCustomAttributes = "";
			if (!$this->LAName->Raw)
				$this->LAName->CurrentValue = HtmlDecode($this->LAName->CurrentValue);
			$this->LAName->EditValue = HtmlEncode($this->LAName->CurrentValue);
			$this->LAName->PlaceHolder = RemoveHtml($this->LAName->caption());

			// CouncilType
			$this->CouncilType->EditAttrs["class"] = "form-control";
			$this->CouncilType->EditCustomAttributes = "";
			$curVal = trim(strval($this->CouncilType->CurrentValue));
			if ($curVal != "")
				$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
			else
				$this->CouncilType->ViewValue = $this->CouncilType->Lookup !== NULL && is_array($this->CouncilType->Lookup->Options) ? $curVal : NULL;
			if ($this->CouncilType->ViewValue !== NULL) { // Load from cache
				$this->CouncilType->EditValue = array_values($this->CouncilType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`LAType`" . SearchString("=", $this->CouncilType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->CouncilType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->CouncilType->EditValue = $arwrk;
			}

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

			// Mandate
			$this->Mandate->EditAttrs["class"] = "form-control";
			$this->Mandate->EditCustomAttributes = "";
			$this->Mandate->EditValue = HtmlEncode($this->Mandate->CurrentValue);
			$this->Mandate->PlaceHolder = RemoveHtml($this->Mandate->caption());

			// Strategy
			$this->Strategy->EditAttrs["class"] = "form-control";
			$this->Strategy->EditCustomAttributes = "";
			$this->Strategy->EditValue = HtmlEncode($this->Strategy->CurrentValue);
			$this->Strategy->PlaceHolder = RemoveHtml($this->Strategy->caption());

			// Clients
			$this->Clients->EditAttrs["class"] = "form-control";
			$this->Clients->EditCustomAttributes = "";
			$this->Clients->EditValue = HtmlEncode($this->Clients->CurrentValue);
			$this->Clients->PlaceHolder = RemoveHtml($this->Clients->caption());

			// Beneficiaries
			$this->Beneficiaries->EditAttrs["class"] = "form-control";
			$this->Beneficiaries->EditCustomAttributes = "";
			$this->Beneficiaries->EditValue = HtmlEncode($this->Beneficiaries->CurrentValue);
			$this->Beneficiaries->PlaceHolder = RemoveHtml($this->Beneficiaries->caption());

			// ExecutiveAuthority
			$this->ExecutiveAuthority->EditAttrs["class"] = "form-control";
			$this->ExecutiveAuthority->EditCustomAttributes = "";
			if (!$this->ExecutiveAuthority->Raw)
				$this->ExecutiveAuthority->CurrentValue = HtmlDecode($this->ExecutiveAuthority->CurrentValue);
			$this->ExecutiveAuthority->EditValue = HtmlEncode($this->ExecutiveAuthority->CurrentValue);
			$this->ExecutiveAuthority->PlaceHolder = RemoveHtml($this->ExecutiveAuthority->caption());

			// ControllingOfficer
			$this->ControllingOfficer->EditAttrs["class"] = "form-control";
			$this->ControllingOfficer->EditCustomAttributes = "";
			if (!$this->ControllingOfficer->Raw)
				$this->ControllingOfficer->CurrentValue = HtmlDecode($this->ControllingOfficer->CurrentValue);
			$this->ControllingOfficer->EditValue = HtmlEncode($this->ControllingOfficer->CurrentValue);
			$this->ControllingOfficer->PlaceHolder = RemoveHtml($this->ControllingOfficer->caption());

			// Comment
			$this->Comment->EditAttrs["class"] = "form-control";
			$this->Comment->EditCustomAttributes = "";
			$this->Comment->EditValue = HtmlEncode($this->Comment->CurrentValue);
			$this->Comment->PlaceHolder = RemoveHtml($this->Comment->caption());

			// Edit refer script
			// LACode

			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// LAName
			$this->LAName->LinkCustomAttributes = "";
			$this->LAName->HrefValue = "";

			// CouncilType
			$this->CouncilType->LinkCustomAttributes = "";
			$this->CouncilType->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// Mandate
			$this->Mandate->LinkCustomAttributes = "";
			$this->Mandate->HrefValue = "";

			// Strategy
			$this->Strategy->LinkCustomAttributes = "";
			$this->Strategy->HrefValue = "";

			// Clients
			$this->Clients->LinkCustomAttributes = "";
			$this->Clients->HrefValue = "";

			// Beneficiaries
			$this->Beneficiaries->LinkCustomAttributes = "";
			$this->Beneficiaries->HrefValue = "";

			// ExecutiveAuthority
			$this->ExecutiveAuthority->LinkCustomAttributes = "";
			$this->ExecutiveAuthority->HrefValue = "";

			// ControllingOfficer
			$this->ControllingOfficer->LinkCustomAttributes = "";
			$this->ControllingOfficer->HrefValue = "";

			// Comment
			$this->Comment->LinkCustomAttributes = "";
			$this->Comment->HrefValue = "";
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
		if ($this->LACode->Required) {
			if (!$this->LACode->IsDetailKey && $this->LACode->FormValue != NULL && $this->LACode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LACode->caption(), $this->LACode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->LACode->FormValue)) {
			AddMessage($FormError, $this->LACode->errorMessage());
		}
		if ($this->LAName->Required) {
			if (!$this->LAName->IsDetailKey && $this->LAName->FormValue != NULL && $this->LAName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LAName->caption(), $this->LAName->RequiredErrorMessage));
			}
		}
		if ($this->CouncilType->Required) {
			if (!$this->CouncilType->IsDetailKey && $this->CouncilType->FormValue != NULL && $this->CouncilType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CouncilType->caption(), $this->CouncilType->RequiredErrorMessage));
			}
		}
		if ($this->ProvinceCode->Required) {
			if (!$this->ProvinceCode->IsDetailKey && $this->ProvinceCode->FormValue != NULL && $this->ProvinceCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ProvinceCode->caption(), $this->ProvinceCode->RequiredErrorMessage));
			}
		}
		if ($this->Mandate->Required) {
			if (!$this->Mandate->IsDetailKey && $this->Mandate->FormValue != NULL && $this->Mandate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Mandate->caption(), $this->Mandate->RequiredErrorMessage));
			}
		}
		if ($this->Strategy->Required) {
			if (!$this->Strategy->IsDetailKey && $this->Strategy->FormValue != NULL && $this->Strategy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Strategy->caption(), $this->Strategy->RequiredErrorMessage));
			}
		}
		if ($this->Clients->Required) {
			if (!$this->Clients->IsDetailKey && $this->Clients->FormValue != NULL && $this->Clients->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Clients->caption(), $this->Clients->RequiredErrorMessage));
			}
		}
		if ($this->Beneficiaries->Required) {
			if (!$this->Beneficiaries->IsDetailKey && $this->Beneficiaries->FormValue != NULL && $this->Beneficiaries->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Beneficiaries->caption(), $this->Beneficiaries->RequiredErrorMessage));
			}
		}
		if ($this->ExecutiveAuthority->Required) {
			if (!$this->ExecutiveAuthority->IsDetailKey && $this->ExecutiveAuthority->FormValue != NULL && $this->ExecutiveAuthority->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExecutiveAuthority->caption(), $this->ExecutiveAuthority->RequiredErrorMessage));
			}
		}
		if ($this->ControllingOfficer->Required) {
			if (!$this->ControllingOfficer->IsDetailKey && $this->ControllingOfficer->FormValue != NULL && $this->ControllingOfficer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ControllingOfficer->caption(), $this->ControllingOfficer->RequiredErrorMessage));
			}
		}
		if ($this->Comment->Required) {
			if (!$this->Comment->IsDetailKey && $this->Comment->FormValue != NULL && $this->Comment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Comment->caption(), $this->Comment->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("department", $detailTblVar) && $GLOBALS["department"]->DetailEdit) {
			if (!isset($GLOBALS["department_grid"]))
				$GLOBALS["department_grid"] = new department_grid(); // Get detail page object
			$GLOBALS["department_grid"]->validateGridForm();
		}
		if (in_array("council_meeting", $detailTblVar) && $GLOBALS["council_meeting"]->DetailEdit) {
			if (!isset($GLOBALS["council_meeting_grid"]))
				$GLOBALS["council_meeting_grid"] = new council_meeting_grid(); // Get detail page object
			$GLOBALS["council_meeting_grid"]->validateGridForm();
		}
		if (in_array("asset", $detailTblVar) && $GLOBALS["asset"]->DetailEdit) {
			if (!isset($GLOBALS["asset_grid"]))
				$GLOBALS["asset_grid"] = new asset_grid(); // Get detail page object
			$GLOBALS["asset_grid"]->validateGridForm();
		}
		if (in_array("ward", $detailTblVar) && $GLOBALS["ward"]->DetailEdit) {
			if (!isset($GLOBALS["ward_grid"]))
				$GLOBALS["ward_grid"] = new ward_grid(); // Get detail page object
			$GLOBALS["ward_grid"]->validateGridForm();
		}
		if (in_array("budget_actual", $detailTblVar) && $GLOBALS["budget_actual"]->DetailEdit) {
			if (!isset($GLOBALS["budget_actual_grid"]))
				$GLOBALS["budget_actual_grid"] = new budget_actual_grid(); // Get detail page object
			$GLOBALS["budget_actual_grid"]->validateGridForm();
		}
		if (in_array("councillorship", $detailTblVar) && $GLOBALS["councillorship"]->DetailEdit) {
			if (!isset($GLOBALS["councillorship_grid"]))
				$GLOBALS["councillorship_grid"] = new councillorship_grid(); // Get detail page object
			$GLOBALS["councillorship_grid"]->validateGridForm();
		}
		if (in_array("monthly_run", $detailTblVar) && $GLOBALS["monthly_run"]->DetailEdit) {
			if (!isset($GLOBALS["monthly_run_grid"]))
				$GLOBALS["monthly_run_grid"] = new monthly_run_grid(); // Get detail page object
			$GLOBALS["monthly_run_grid"]->validateGridForm();
		}
		if (in_array("project", $detailTblVar) && $GLOBALS["project"]->DetailEdit) {
			if (!isset($GLOBALS["project_grid"]))
				$GLOBALS["project_grid"] = new project_grid(); // Get detail page object
			$GLOBALS["project_grid"]->validateGridForm();
		}
		if (in_array("la_bank_account", $detailTblVar) && $GLOBALS["la_bank_account"]->DetailEdit) {
			if (!isset($GLOBALS["la_bank_account_grid"]))
				$GLOBALS["la_bank_account_grid"] = new la_bank_account_grid(); // Get detail page object
			$GLOBALS["la_bank_account_grid"]->validateGridForm();
		}
		if (in_array("strategic_objective", $detailTblVar) && $GLOBALS["strategic_objective"]->DetailEdit) {
			if (!isset($GLOBALS["strategic_objective_grid"]))
				$GLOBALS["strategic_objective_grid"] = new strategic_objective_grid(); // Get detail page object
			$GLOBALS["strategic_objective_grid"]->validateGridForm();
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

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// LAName
			$this->LAName->setDbValueDef($rsnew, $this->LAName->CurrentValue, "", $this->LAName->ReadOnly);

			// CouncilType
			$this->CouncilType->setDbValueDef($rsnew, $this->CouncilType->CurrentValue, NULL, $this->CouncilType->ReadOnly);

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, $this->ProvinceCode->ReadOnly);

			// Mandate
			$this->Mandate->setDbValueDef($rsnew, $this->Mandate->CurrentValue, "", $this->Mandate->ReadOnly);

			// Strategy
			$this->Strategy->setDbValueDef($rsnew, $this->Strategy->CurrentValue, NULL, $this->Strategy->ReadOnly);

			// Clients
			$this->Clients->setDbValueDef($rsnew, $this->Clients->CurrentValue, "", $this->Clients->ReadOnly);

			// Beneficiaries
			$this->Beneficiaries->setDbValueDef($rsnew, $this->Beneficiaries->CurrentValue, "", $this->Beneficiaries->ReadOnly);

			// ExecutiveAuthority
			$this->ExecutiveAuthority->setDbValueDef($rsnew, $this->ExecutiveAuthority->CurrentValue, "", $this->ExecutiveAuthority->ReadOnly);

			// ControllingOfficer
			$this->ControllingOfficer->setDbValueDef($rsnew, $this->ControllingOfficer->CurrentValue, "", $this->ControllingOfficer->ReadOnly);

			// Comment
			$this->Comment->setDbValueDef($rsnew, $this->Comment->CurrentValue, NULL, $this->Comment->ReadOnly);

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
					if (in_array("department", $detailTblVar) && $GLOBALS["department"]->DetailEdit) {
						if (!isset($GLOBALS["department_grid"]))
							$GLOBALS["department_grid"] = new department_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "department"); // Load user level of detail table
						$editRow = $GLOBALS["department_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("council_meeting", $detailTblVar) && $GLOBALS["council_meeting"]->DetailEdit) {
						if (!isset($GLOBALS["council_meeting_grid"]))
							$GLOBALS["council_meeting_grid"] = new council_meeting_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "council_meeting"); // Load user level of detail table
						$editRow = $GLOBALS["council_meeting_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("asset", $detailTblVar) && $GLOBALS["asset"]->DetailEdit) {
						if (!isset($GLOBALS["asset_grid"]))
							$GLOBALS["asset_grid"] = new asset_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "asset"); // Load user level of detail table
						$editRow = $GLOBALS["asset_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("ward", $detailTblVar) && $GLOBALS["ward"]->DetailEdit) {
						if (!isset($GLOBALS["ward_grid"]))
							$GLOBALS["ward_grid"] = new ward_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "ward"); // Load user level of detail table
						$editRow = $GLOBALS["ward_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("budget_actual", $detailTblVar) && $GLOBALS["budget_actual"]->DetailEdit) {
						if (!isset($GLOBALS["budget_actual_grid"]))
							$GLOBALS["budget_actual_grid"] = new budget_actual_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "budget_actual"); // Load user level of detail table
						$editRow = $GLOBALS["budget_actual_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("councillorship", $detailTblVar) && $GLOBALS["councillorship"]->DetailEdit) {
						if (!isset($GLOBALS["councillorship_grid"]))
							$GLOBALS["councillorship_grid"] = new councillorship_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "councillorship"); // Load user level of detail table
						$editRow = $GLOBALS["councillorship_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("monthly_run", $detailTblVar) && $GLOBALS["monthly_run"]->DetailEdit) {
						if (!isset($GLOBALS["monthly_run_grid"]))
							$GLOBALS["monthly_run_grid"] = new monthly_run_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "monthly_run"); // Load user level of detail table
						$editRow = $GLOBALS["monthly_run_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("project", $detailTblVar) && $GLOBALS["project"]->DetailEdit) {
						if (!isset($GLOBALS["project_grid"]))
							$GLOBALS["project_grid"] = new project_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "project"); // Load user level of detail table
						$editRow = $GLOBALS["project_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("la_bank_account", $detailTblVar) && $GLOBALS["la_bank_account"]->DetailEdit) {
						if (!isset($GLOBALS["la_bank_account_grid"]))
							$GLOBALS["la_bank_account_grid"] = new la_bank_account_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "la_bank_account"); // Load user level of detail table
						$editRow = $GLOBALS["la_bank_account_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("strategic_objective", $detailTblVar) && $GLOBALS["strategic_objective"]->DetailEdit) {
						if (!isset($GLOBALS["strategic_objective_grid"]))
							$GLOBALS["strategic_objective_grid"] = new strategic_objective_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "strategic_objective"); // Load user level of detail table
						$editRow = $GLOBALS["strategic_objective_grid"]->gridUpdate();
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
			if ($masterTblVar == "province") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["province"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["province"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["province"]->ProvinceCode->QueryStringValue))
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
			if ($masterTblVar == "province") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["province"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["province"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["province"]->ProvinceCode->FormValue))
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
			if ($masterTblVar != "province") {
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
			if (in_array("department", $detailTblVar)) {
				if (!isset($GLOBALS["department_grid"]))
					$GLOBALS["department_grid"] = new department_grid();
				if ($GLOBALS["department_grid"]->DetailEdit) {
					$GLOBALS["department_grid"]->CurrentMode = "edit";
					$GLOBALS["department_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["department_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["department_grid"]->setStartRecordNumber(1);
					$GLOBALS["department_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["department_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["department_grid"]->LACode->setSessionValue($GLOBALS["department_grid"]->LACode->CurrentValue);
					$GLOBALS["department_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["department_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["department_grid"]->ProvinceCode->setSessionValue($GLOBALS["department_grid"]->ProvinceCode->CurrentValue);
				}
			}
			if (in_array("council_meeting", $detailTblVar)) {
				if (!isset($GLOBALS["council_meeting_grid"]))
					$GLOBALS["council_meeting_grid"] = new council_meeting_grid();
				if ($GLOBALS["council_meeting_grid"]->DetailEdit) {
					$GLOBALS["council_meeting_grid"]->CurrentMode = "edit";
					$GLOBALS["council_meeting_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["council_meeting_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["council_meeting_grid"]->setStartRecordNumber(1);
					$GLOBALS["council_meeting_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["council_meeting_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["council_meeting_grid"]->LACode->setSessionValue($GLOBALS["council_meeting_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("asset", $detailTblVar)) {
				if (!isset($GLOBALS["asset_grid"]))
					$GLOBALS["asset_grid"] = new asset_grid();
				if ($GLOBALS["asset_grid"]->DetailEdit) {
					$GLOBALS["asset_grid"]->CurrentMode = "edit";
					$GLOBALS["asset_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["asset_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["asset_grid"]->setStartRecordNumber(1);
					$GLOBALS["asset_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["asset_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["asset_grid"]->ProvinceCode->setSessionValue($GLOBALS["asset_grid"]->ProvinceCode->CurrentValue);
					$GLOBALS["asset_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["asset_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["asset_grid"]->LACode->setSessionValue($GLOBALS["asset_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("ward", $detailTblVar)) {
				if (!isset($GLOBALS["ward_grid"]))
					$GLOBALS["ward_grid"] = new ward_grid();
				if ($GLOBALS["ward_grid"]->DetailEdit) {
					$GLOBALS["ward_grid"]->CurrentMode = "edit";
					$GLOBALS["ward_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["ward_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ward_grid"]->setStartRecordNumber(1);
					$GLOBALS["ward_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["ward_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["ward_grid"]->ProvinceCode->setSessionValue($GLOBALS["ward_grid"]->ProvinceCode->CurrentValue);
					$GLOBALS["ward_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["ward_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["ward_grid"]->LACode->setSessionValue($GLOBALS["ward_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("budget_actual", $detailTblVar)) {
				if (!isset($GLOBALS["budget_actual_grid"]))
					$GLOBALS["budget_actual_grid"] = new budget_actual_grid();
				if ($GLOBALS["budget_actual_grid"]->DetailEdit) {
					$GLOBALS["budget_actual_grid"]->CurrentMode = "edit";
					$GLOBALS["budget_actual_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["budget_actual_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["budget_actual_grid"]->setStartRecordNumber(1);
					$GLOBALS["budget_actual_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["budget_actual_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["budget_actual_grid"]->LACode->setSessionValue($GLOBALS["budget_actual_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("councillorship", $detailTblVar)) {
				if (!isset($GLOBALS["councillorship_grid"]))
					$GLOBALS["councillorship_grid"] = new councillorship_grid();
				if ($GLOBALS["councillorship_grid"]->DetailEdit) {
					$GLOBALS["councillorship_grid"]->CurrentMode = "edit";
					$GLOBALS["councillorship_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["councillorship_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["councillorship_grid"]->setStartRecordNumber(1);
					$GLOBALS["councillorship_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["councillorship_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["councillorship_grid"]->LACode->setSessionValue($GLOBALS["councillorship_grid"]->LACode->CurrentValue);
					$GLOBALS["councillorship_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["councillorship_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["councillorship_grid"]->ProvinceCode->setSessionValue($GLOBALS["councillorship_grid"]->ProvinceCode->CurrentValue);
					$GLOBALS["councillorship_grid"]->EmployeeID->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("monthly_run", $detailTblVar)) {
				if (!isset($GLOBALS["monthly_run_grid"]))
					$GLOBALS["monthly_run_grid"] = new monthly_run_grid();
				if ($GLOBALS["monthly_run_grid"]->DetailEdit) {
					$GLOBALS["monthly_run_grid"]->CurrentMode = "edit";
					$GLOBALS["monthly_run_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["monthly_run_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["monthly_run_grid"]->setStartRecordNumber(1);
					$GLOBALS["monthly_run_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["monthly_run_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["monthly_run_grid"]->LACode->setSessionValue($GLOBALS["monthly_run_grid"]->LACode->CurrentValue);
					$GLOBALS["monthly_run_grid"]->PeriodCode->setSessionValue(""); // Clear session key
					$GLOBALS["monthly_run_grid"]->Year->setSessionValue(""); // Clear session key
					$GLOBALS["monthly_run_grid"]->RunMonth->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("project", $detailTblVar)) {
				if (!isset($GLOBALS["project_grid"]))
					$GLOBALS["project_grid"] = new project_grid();
				if ($GLOBALS["project_grid"]->DetailEdit) {
					$GLOBALS["project_grid"]->CurrentMode = "edit";
					$GLOBALS["project_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["project_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["project_grid"]->setStartRecordNumber(1);
					$GLOBALS["project_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["project_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["project_grid"]->ProvinceCode->setSessionValue($GLOBALS["project_grid"]->ProvinceCode->CurrentValue);
					$GLOBALS["project_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["project_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["project_grid"]->LACode->setSessionValue($GLOBALS["project_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("la_bank_account", $detailTblVar)) {
				if (!isset($GLOBALS["la_bank_account_grid"]))
					$GLOBALS["la_bank_account_grid"] = new la_bank_account_grid();
				if ($GLOBALS["la_bank_account_grid"]->DetailEdit) {
					$GLOBALS["la_bank_account_grid"]->CurrentMode = "edit";
					$GLOBALS["la_bank_account_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["la_bank_account_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["la_bank_account_grid"]->setStartRecordNumber(1);
					$GLOBALS["la_bank_account_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["la_bank_account_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["la_bank_account_grid"]->LACode->setSessionValue($GLOBALS["la_bank_account_grid"]->LACode->CurrentValue);
				}
			}
			if (in_array("strategic_objective", $detailTblVar)) {
				if (!isset($GLOBALS["strategic_objective_grid"]))
					$GLOBALS["strategic_objective_grid"] = new strategic_objective_grid();
				if ($GLOBALS["strategic_objective_grid"]->DetailEdit) {
					$GLOBALS["strategic_objective_grid"]->CurrentMode = "edit";
					$GLOBALS["strategic_objective_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["strategic_objective_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["strategic_objective_grid"]->setStartRecordNumber(1);
					$GLOBALS["strategic_objective_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["strategic_objective_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["strategic_objective_grid"]->LACode->setSessionValue($GLOBALS["strategic_objective_grid"]->LACode->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("local_authoritylist.php"), "", $this->TableVar, TRUE);
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
				case "x_CouncilType":
					break;
				case "x_ProvinceCode":
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
						case "x_CouncilType":
							break;
						case "x_ProvinceCode":
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