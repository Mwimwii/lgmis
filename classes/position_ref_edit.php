<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class position_ref_edit extends position_ref
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'position_ref';

	// Page object name
	public $PageObjName = "position_ref_edit";

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

		// Table object (position_ref)
		if (!isset($GLOBALS["position_ref"]) || get_class($GLOBALS["position_ref"]) == PROJECT_NAMESPACE . "position_ref") {
			$GLOBALS["position_ref"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["position_ref"];
		}

		// Table object (dept_section)
		if (!isset($GLOBALS['dept_section']))
			$GLOBALS['dept_section'] = new dept_section();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'position_ref');

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
		global $position_ref;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($position_ref);
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
					if ($pageName == "position_refview.php")
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
			$key .= @$ar['PositionCode'];
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
			$this->PositionCode->Visible = FALSE;
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
					$this->terminate(GetUrl("position_reflist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->PositionCode->setVisibility();
		$this->PositionName->setVisibility();
		$this->RequisiteQualification->setVisibility();
		$this->JobCode->setVisibility();
		$this->SalaryScale->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->CouncilType->Visible = FALSE;
		$this->DepartmentCode->setVisibility();
		$this->SectionCode->setVisibility();
		$this->FieldQualified->setVisibility();
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
		$this->setupLookupOptions($this->RequisiteQualification);
		$this->setupLookupOptions($this->JobCode);
		$this->setupLookupOptions($this->SalaryScale);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->CouncilType);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->SectionCode);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("position_reflist.php");
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
			if (Get("PositionCode") !== NULL) {
				$this->PositionCode->setQueryStringValue(Get("PositionCode"));
				$this->PositionCode->setOldValue($this->PositionCode->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->PositionCode->setQueryStringValue(Key(0));
				$this->PositionCode->setOldValue($this->PositionCode->QueryStringValue);
			} elseif (Post("PositionCode") !== NULL) {
				$this->PositionCode->setFormValue(Post("PositionCode"));
				$this->PositionCode->setOldValue($this->PositionCode->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->PositionCode->setQueryStringValue(Route(2));
				$this->PositionCode->setOldValue($this->PositionCode->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_PositionCode")) {
					$this->PositionCode->setFormValue($CurrentForm->getValue("x_PositionCode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("PositionCode") !== NULL) {
					$this->PositionCode->setQueryStringValue(Get("PositionCode"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->PositionCode->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->PositionCode->CurrentValue = NULL;
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
				$this->terminate("position_reflist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->PositionCode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->PositionCode->CurrentValue, $rs->fields('PositionCode'))) {
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
					$this->terminate("position_reflist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "position_reflist.php")
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

		// Check field name 'PositionCode' first before field var 'x_PositionCode'
		$val = $CurrentForm->hasValue("PositionCode") ? $CurrentForm->getValue("PositionCode") : $CurrentForm->getValue("x_PositionCode");
		if (!$this->PositionCode->IsDetailKey)
			$this->PositionCode->setFormValue($val);

		// Check field name 'PositionName' first before field var 'x_PositionName'
		$val = $CurrentForm->hasValue("PositionName") ? $CurrentForm->getValue("PositionName") : $CurrentForm->getValue("x_PositionName");
		if (!$this->PositionName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PositionName->Visible = FALSE; // Disable update for API request
			else
				$this->PositionName->setFormValue($val);
		}

		// Check field name 'RequisiteQualification' first before field var 'x_RequisiteQualification'
		$val = $CurrentForm->hasValue("RequisiteQualification") ? $CurrentForm->getValue("RequisiteQualification") : $CurrentForm->getValue("x_RequisiteQualification");
		if (!$this->RequisiteQualification->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->RequisiteQualification->Visible = FALSE; // Disable update for API request
			else
				$this->RequisiteQualification->setFormValue($val);
		}

		// Check field name 'JobCode' first before field var 'x_JobCode'
		$val = $CurrentForm->hasValue("JobCode") ? $CurrentForm->getValue("JobCode") : $CurrentForm->getValue("x_JobCode");
		if (!$this->JobCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobCode->Visible = FALSE; // Disable update for API request
			else
				$this->JobCode->setFormValue($val);
		}

		// Check field name 'SalaryScale' first before field var 'x_SalaryScale'
		$val = $CurrentForm->hasValue("SalaryScale") ? $CurrentForm->getValue("SalaryScale") : $CurrentForm->getValue("x_SalaryScale");
		if (!$this->SalaryScale->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SalaryScale->Visible = FALSE; // Disable update for API request
			else
				$this->SalaryScale->setFormValue($val);
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

		// Check field name 'FieldQualified' first before field var 'x_FieldQualified'
		$val = $CurrentForm->hasValue("FieldQualified") ? $CurrentForm->getValue("FieldQualified") : $CurrentForm->getValue("x_FieldQualified");
		if (!$this->FieldQualified->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FieldQualified->Visible = FALSE; // Disable update for API request
			else
				$this->FieldQualified->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->PositionCode->CurrentValue = $this->PositionCode->FormValue;
		$this->PositionName->CurrentValue = $this->PositionName->FormValue;
		$this->RequisiteQualification->CurrentValue = $this->RequisiteQualification->FormValue;
		$this->JobCode->CurrentValue = $this->JobCode->FormValue;
		$this->SalaryScale->CurrentValue = $this->SalaryScale->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->SectionCode->CurrentValue = $this->SectionCode->FormValue;
		$this->FieldQualified->CurrentValue = $this->FieldQualified->FormValue;
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
		$this->PositionCode->setDbValue($row['PositionCode']);
		$this->PositionName->setDbValue($row['PositionName']);
		$this->RequisiteQualification->setDbValue($row['RequisiteQualification']);
		$this->JobCode->setDbValue($row['JobCode']);
		$this->SalaryScale->setDbValue($row['SalaryScale']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->CouncilType->setDbValue($row['CouncilType']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->SectionCode->setDbValue($row['SectionCode']);
		$this->FieldQualified->setDbValue($row['FieldQualified']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['PositionCode'] = NULL;
		$row['PositionName'] = NULL;
		$row['RequisiteQualification'] = NULL;
		$row['JobCode'] = NULL;
		$row['SalaryScale'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['CouncilType'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['SectionCode'] = NULL;
		$row['FieldQualified'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("PositionCode")) != "")
			$this->PositionCode->OldValue = $this->getKey("PositionCode"); // PositionCode
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
		// PositionCode
		// PositionName
		// RequisiteQualification
		// JobCode
		// SalaryScale
		// ProvinceCode
		// LACode
		// CouncilType
		// DepartmentCode
		// SectionCode
		// FieldQualified

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PositionCode
			$this->PositionCode->ViewValue = $this->PositionCode->CurrentValue;
			$this->PositionCode->ViewCustomAttributes = "";

			// PositionName
			$this->PositionName->ViewValue = $this->PositionName->CurrentValue;
			$this->PositionName->ViewCustomAttributes = "";

			// RequisiteQualification
			$curVal = strval($this->RequisiteQualification->CurrentValue);
			if ($curVal != "") {
				$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->lookupCacheOption($curVal);
				if ($this->RequisiteQualification->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->RequisiteQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->CurrentValue;
					}
				}
			} else {
				$this->RequisiteQualification->ViewValue = NULL;
			}
			$this->RequisiteQualification->ViewCustomAttributes = "";

			// JobCode
			$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
			$curVal = strval($this->JobCode->CurrentValue);
			if ($curVal != "") {
				$this->JobCode->ViewValue = $this->JobCode->lookupCacheOption($curVal);
				if ($this->JobCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`JobCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->JobCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->JobCode->ViewValue = $this->JobCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->JobCode->ViewValue = $this->JobCode->CurrentValue;
					}
				}
			} else {
				$this->JobCode->ViewValue = NULL;
			}
			$this->JobCode->ViewCustomAttributes = "";

			// SalaryScale
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

			// CouncilType
			$curVal = strval($this->CouncilType->CurrentValue);
			if ($curVal != "") {
				$this->CouncilType->ViewValue = $this->CouncilType->lookupCacheOption($curVal);
				if ($this->CouncilType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CouncilType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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
						$arwrk[2] = $rswrk->fields('df2');
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
						$arwrk[2] = $rswrk->fields('df2');
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

			// FieldQualified
			$this->FieldQualified->ViewValue = $this->FieldQualified->CurrentValue;
			$this->FieldQualified->ViewCustomAttributes = "";

			// PositionCode
			$this->PositionCode->LinkCustomAttributes = "";
			$this->PositionCode->HrefValue = "";
			$this->PositionCode->TooltipValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";
			$this->PositionName->TooltipValue = "";

			// RequisiteQualification
			$this->RequisiteQualification->LinkCustomAttributes = "";
			$this->RequisiteQualification->HrefValue = "";
			$this->RequisiteQualification->TooltipValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";
			$this->JobCode->TooltipValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";
			$this->SalaryScale->TooltipValue = "";

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

			// FieldQualified
			$this->FieldQualified->LinkCustomAttributes = "";
			$this->FieldQualified->HrefValue = "";
			$this->FieldQualified->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// PositionCode
			$this->PositionCode->EditAttrs["class"] = "form-control";
			$this->PositionCode->EditCustomAttributes = "";
			$this->PositionCode->EditValue = $this->PositionCode->CurrentValue;
			$this->PositionCode->ViewCustomAttributes = "";

			// PositionName
			$this->PositionName->EditAttrs["class"] = "form-control";
			$this->PositionName->EditCustomAttributes = "";
			if (!$this->PositionName->Raw)
				$this->PositionName->CurrentValue = HtmlDecode($this->PositionName->CurrentValue);
			$this->PositionName->EditValue = HtmlEncode($this->PositionName->CurrentValue);
			$this->PositionName->PlaceHolder = RemoveHtml($this->PositionName->caption());

			// RequisiteQualification
			$this->RequisiteQualification->EditAttrs["class"] = "form-control";
			$this->RequisiteQualification->EditCustomAttributes = "";
			$curVal = trim(strval($this->RequisiteQualification->CurrentValue));
			if ($curVal != "")
				$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->lookupCacheOption($curVal);
			else
				$this->RequisiteQualification->ViewValue = $this->RequisiteQualification->Lookup !== NULL && is_array($this->RequisiteQualification->Lookup->Options) ? $curVal : NULL;
			if ($this->RequisiteQualification->ViewValue !== NULL) { // Load from cache
				$this->RequisiteQualification->EditValue = array_values($this->RequisiteQualification->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $this->RequisiteQualification->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->RequisiteQualification->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->RequisiteQualification->EditValue = $arwrk;
			}

			// JobCode
			$this->JobCode->EditAttrs["class"] = "form-control";
			$this->JobCode->EditCustomAttributes = "";
			$this->JobCode->EditValue = HtmlEncode($this->JobCode->CurrentValue);
			$curVal = strval($this->JobCode->CurrentValue);
			if ($curVal != "") {
				$this->JobCode->EditValue = $this->JobCode->lookupCacheOption($curVal);
				if ($this->JobCode->EditValue === NULL) { // Lookup from database
					$filterWrk = "`JobCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->JobCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobCode->EditValue = $this->JobCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->JobCode->EditValue = HtmlEncode($this->JobCode->CurrentValue);
					}
				}
			} else {
				$this->JobCode->EditValue = NULL;
			}
			$this->JobCode->PlaceHolder = RemoveHtml($this->JobCode->caption());

			// SalaryScale
			$this->SalaryScale->EditAttrs["class"] = "form-control";
			$this->SalaryScale->EditCustomAttributes = "";
			$curVal = trim(strval($this->SalaryScale->CurrentValue));
			if ($curVal != "")
				$this->SalaryScale->ViewValue = $this->SalaryScale->lookupCacheOption($curVal);
			else
				$this->SalaryScale->ViewValue = $this->SalaryScale->Lookup !== NULL && is_array($this->SalaryScale->Lookup->Options) ? $curVal : NULL;
			if ($this->SalaryScale->ViewValue !== NULL) { // Load from cache
				$this->SalaryScale->EditValue = array_values($this->SalaryScale->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`SalaryScale`" . SearchString("=", $this->SalaryScale->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->SalaryScale->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->SalaryScale->EditValue = $arwrk;
			}

			// ProvinceCode
			$this->ProvinceCode->EditAttrs["class"] = "form-control";
			$this->ProvinceCode->EditCustomAttributes = "";
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

			// LACode
			$this->LACode->EditAttrs["class"] = "form-control";
			$this->LACode->EditCustomAttributes = "";
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

			// DepartmentCode
			$this->DepartmentCode->EditAttrs["class"] = "form-control";
			$this->DepartmentCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->DepartmentCode->CurrentValue));
			if ($curVal != "")
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->lookupCacheOption($curVal);
			else
				$this->DepartmentCode->ViewValue = $this->DepartmentCode->Lookup !== NULL && is_array($this->DepartmentCode->Lookup->Options) ? $curVal : NULL;
			if ($this->DepartmentCode->ViewValue !== NULL) { // Load from cache
				$this->DepartmentCode->EditValue = array_values($this->DepartmentCode->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`DepartmentCode`" . SearchString("=", $this->DepartmentCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->DepartmentCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->DepartmentCode->EditValue = $arwrk;
			}

			// SectionCode
			$this->SectionCode->EditAttrs["class"] = "form-control";
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
							$arwrk[2] = $rswrk->fields('df2');
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
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`SectionCode`" . SearchString("=", $this->SectionCode->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->SectionCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->SectionCode->EditValue = $arwrk;
				}
			}

			// FieldQualified
			$this->FieldQualified->EditAttrs["class"] = "form-control";
			$this->FieldQualified->EditCustomAttributes = "";
			$this->FieldQualified->EditValue = HtmlEncode($this->FieldQualified->CurrentValue);
			$this->FieldQualified->PlaceHolder = RemoveHtml($this->FieldQualified->caption());

			// Edit refer script
			// PositionCode

			$this->PositionCode->LinkCustomAttributes = "";
			$this->PositionCode->HrefValue = "";

			// PositionName
			$this->PositionName->LinkCustomAttributes = "";
			$this->PositionName->HrefValue = "";

			// RequisiteQualification
			$this->RequisiteQualification->LinkCustomAttributes = "";
			$this->RequisiteQualification->HrefValue = "";

			// JobCode
			$this->JobCode->LinkCustomAttributes = "";
			$this->JobCode->HrefValue = "";

			// SalaryScale
			$this->SalaryScale->LinkCustomAttributes = "";
			$this->SalaryScale->HrefValue = "";

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

			// FieldQualified
			$this->FieldQualified->LinkCustomAttributes = "";
			$this->FieldQualified->HrefValue = "";
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
		if ($this->PositionCode->Required) {
			if (!$this->PositionCode->IsDetailKey && $this->PositionCode->FormValue != NULL && $this->PositionCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PositionCode->caption(), $this->PositionCode->RequiredErrorMessage));
			}
		}
		if ($this->PositionName->Required) {
			if (!$this->PositionName->IsDetailKey && $this->PositionName->FormValue != NULL && $this->PositionName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PositionName->caption(), $this->PositionName->RequiredErrorMessage));
			}
		}
		if ($this->RequisiteQualification->Required) {
			if (!$this->RequisiteQualification->IsDetailKey && $this->RequisiteQualification->FormValue != NULL && $this->RequisiteQualification->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RequisiteQualification->caption(), $this->RequisiteQualification->RequiredErrorMessage));
			}
		}
		if ($this->JobCode->Required) {
			if (!$this->JobCode->IsDetailKey && $this->JobCode->FormValue != NULL && $this->JobCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobCode->caption(), $this->JobCode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->JobCode->FormValue)) {
			AddMessage($FormError, $this->JobCode->errorMessage());
		}
		if ($this->SalaryScale->Required) {
			if (!$this->SalaryScale->IsDetailKey && $this->SalaryScale->FormValue != NULL && $this->SalaryScale->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SalaryScale->caption(), $this->SalaryScale->RequiredErrorMessage));
			}
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
		if ($this->FieldQualified->Required) {
			if (!$this->FieldQualified->IsDetailKey && $this->FieldQualified->FormValue != NULL && $this->FieldQualified->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FieldQualified->caption(), $this->FieldQualified->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->FieldQualified->FormValue)) {
			AddMessage($FormError, $this->FieldQualified->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("employment", $detailTblVar) && $GLOBALS["employment"]->DetailEdit) {
			if (!isset($GLOBALS["employment_grid"]))
				$GLOBALS["employment_grid"] = new employment_grid(); // Get detail page object
			$GLOBALS["employment_grid"]->validateGridForm();
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

			// PositionName
			$this->PositionName->setDbValueDef($rsnew, $this->PositionName->CurrentValue, "", $this->PositionName->ReadOnly);

			// RequisiteQualification
			$this->RequisiteQualification->setDbValueDef($rsnew, $this->RequisiteQualification->CurrentValue, NULL, $this->RequisiteQualification->ReadOnly);

			// JobCode
			$this->JobCode->setDbValueDef($rsnew, $this->JobCode->CurrentValue, NULL, $this->JobCode->ReadOnly);

			// SalaryScale
			$this->SalaryScale->setDbValueDef($rsnew, $this->SalaryScale->CurrentValue, "", $this->SalaryScale->ReadOnly);

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, 0, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, "", $this->LACode->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, 0, $this->DepartmentCode->ReadOnly);

			// SectionCode
			$this->SectionCode->setDbValueDef($rsnew, $this->SectionCode->CurrentValue, 0, $this->SectionCode->ReadOnly);

			// FieldQualified
			$this->FieldQualified->setDbValueDef($rsnew, $this->FieldQualified->CurrentValue, NULL, $this->FieldQualified->ReadOnly);

			// Check referential integrity for master table 'dept_section'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_dept_section();
			$keyValue = isset($rsnew['SectionCode']) ? $rsnew['SectionCode'] : $rsold['SectionCode'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@SectionCode@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["dept_section"]))
					$GLOBALS["dept_section"] = new dept_section();
				$rsmaster = $GLOBALS["dept_section"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "dept_section", $Language->phrase("RelatedRecordRequired"));
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
					if (in_array("employment", $detailTblVar) && $GLOBALS["employment"]->DetailEdit) {
						if (!isset($GLOBALS["employment_grid"]))
							$GLOBALS["employment_grid"] = new employment_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "employment"); // Load user level of detail table
						$editRow = $GLOBALS["employment_grid"]->gridUpdate();
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
			if ($masterTblVar == "dept_section") {
				$validMaster = TRUE;
				if (($parm = Get("fk_SectionCode", Get("SectionCode"))) !== NULL) {
					$GLOBALS["dept_section"]->SectionCode->setQueryStringValue($parm);
					$this->SectionCode->setQueryStringValue($GLOBALS["dept_section"]->SectionCode->QueryStringValue);
					$this->SectionCode->setSessionValue($this->SectionCode->QueryStringValue);
					if (!is_numeric($GLOBALS["dept_section"]->SectionCode->QueryStringValue))
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
			if ($masterTblVar == "dept_section") {
				$validMaster = TRUE;
				if (($parm = Post("fk_SectionCode", Post("SectionCode"))) !== NULL) {
					$GLOBALS["dept_section"]->SectionCode->setFormValue($parm);
					$this->SectionCode->setFormValue($GLOBALS["dept_section"]->SectionCode->FormValue);
					$this->SectionCode->setSessionValue($this->SectionCode->FormValue);
					if (!is_numeric($GLOBALS["dept_section"]->SectionCode->FormValue))
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
			if ($masterTblVar != "dept_section") {
				if ($this->SectionCode->CurrentValue == "")
					$this->SectionCode->setSessionValue("");
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
			if (in_array("employment", $detailTblVar)) {
				if (!isset($GLOBALS["employment_grid"]))
					$GLOBALS["employment_grid"] = new employment_grid();
				if ($GLOBALS["employment_grid"]->DetailEdit) {
					$GLOBALS["employment_grid"]->CurrentMode = "edit";
					$GLOBALS["employment_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["employment_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["employment_grid"]->setStartRecordNumber(1);
					$GLOBALS["employment_grid"]->SubstantivePosition->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->SubstantivePosition->CurrentValue = $this->PositionCode->CurrentValue;
					$GLOBALS["employment_grid"]->SubstantivePosition->setSessionValue($GLOBALS["employment_grid"]->SubstantivePosition->CurrentValue);
					$GLOBALS["employment_grid"]->SectionCode->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->SectionCode->CurrentValue = $this->SectionCode->CurrentValue;
					$GLOBALS["employment_grid"]->SectionCode->setSessionValue($GLOBALS["employment_grid"]->SectionCode->CurrentValue);
					$GLOBALS["employment_grid"]->DepartmentCode->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->DepartmentCode->CurrentValue = $this->DepartmentCode->CurrentValue;
					$GLOBALS["employment_grid"]->DepartmentCode->setSessionValue($GLOBALS["employment_grid"]->DepartmentCode->CurrentValue);
					$GLOBALS["employment_grid"]->LACode->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->LACode->CurrentValue = $this->LACode->CurrentValue;
					$GLOBALS["employment_grid"]->LACode->setSessionValue($GLOBALS["employment_grid"]->LACode->CurrentValue);
					$GLOBALS["employment_grid"]->ProvinceCode->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->ProvinceCode->CurrentValue = $this->ProvinceCode->CurrentValue;
					$GLOBALS["employment_grid"]->ProvinceCode->setSessionValue($GLOBALS["employment_grid"]->ProvinceCode->CurrentValue);
					$GLOBALS["employment_grid"]->SalaryScale->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->SalaryScale->CurrentValue = $this->SalaryScale->CurrentValue;
					$GLOBALS["employment_grid"]->SalaryScale->setSessionValue($GLOBALS["employment_grid"]->SalaryScale->CurrentValue);
					$GLOBALS["employment_grid"]->EmployeeID->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("position_reflist.php"), "", $this->TableVar, TRUE);
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
				case "x_RequisiteQualification":
					break;
				case "x_JobCode":
					break;
				case "x_SalaryScale":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_CouncilType":
					break;
				case "x_DepartmentCode":
					break;
				case "x_SectionCode":
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
						case "x_RequisiteQualification":
							break;
						case "x_JobCode":
							break;
						case "x_SalaryScale":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_CouncilType":
							break;
						case "x_DepartmentCode":
							break;
						case "x_SectionCode":
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