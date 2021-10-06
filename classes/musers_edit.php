<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class musers_edit extends musers
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'musers';

	// Page object name
	public $PageObjName = "musers_edit";

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

		// Table object (musers)
		if (!isset($GLOBALS["musers"]) || get_class($GLOBALS["musers"]) == PROJECT_NAMESPACE . "musers") {
			$GLOBALS["musers"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["musers"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'musers');

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
		global $musers;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($musers);
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
					if ($pageName == "musersview.php")
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
			$key .= @$ar['UserName'];
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
		if ($this->isAddOrEdit())
			$this->UserCode->Visible = FALSE;
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
					$this->terminate(GetUrl("muserslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->UserCode->setVisibility();
		$this->UserName->setVisibility();
		$this->Password->setVisibility();
		$this->ConfirmPwd->Visible = FALSE;
		$this->EmployeeID->setVisibility();
		$this->FirstName->setVisibility();
		$this->LastName->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->Level->setVisibility();
		$this->Role->setVisibility();
		$this->Clearance->setVisibility();
		$this->OrganisationLevel->setVisibility();
		$this->Active->setVisibility();
		$this->_Email->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Position->setVisibility();
		$this->ReportsTo->setVisibility();
		$this->Profile->setVisibility();
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
		$this->setupLookupOptions($this->Level);
		$this->setupLookupOptions($this->Role);
		$this->setupLookupOptions($this->Clearance);
		$this->setupLookupOptions($this->Active);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("muserslist.php");
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
			if (Get("UserName") !== NULL) {
				$this->UserName->setQueryStringValue(Get("UserName"));
				$this->UserName->setOldValue($this->UserName->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->UserName->setQueryStringValue(Key(0));
				$this->UserName->setOldValue($this->UserName->QueryStringValue);
			} elseif (Post("UserName") !== NULL) {
				$this->UserName->setFormValue(Post("UserName"));
				$this->UserName->setOldValue($this->UserName->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->UserName->setQueryStringValue(Route(2));
				$this->UserName->setOldValue($this->UserName->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_UserName")) {
					$this->UserName->setFormValue($CurrentForm->getValue("x_UserName"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("UserName") !== NULL) {
					$this->UserName->setQueryStringValue(Get("UserName"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->UserName->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->UserName->CurrentValue = NULL;
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
				$this->terminate("muserslist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->UserName->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->UserName->CurrentValue, $rs->fields('UserName'))) {
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
					$this->terminate("muserslist.php"); // Return to list page
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
				if (GetPageName($returnUrl) == "muserslist.php")
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

		// Check field name 'UserCode' first before field var 'x_UserCode'
		$val = $CurrentForm->hasValue("UserCode") ? $CurrentForm->getValue("UserCode") : $CurrentForm->getValue("x_UserCode");
		if (!$this->UserCode->IsDetailKey)
			$this->UserCode->setFormValue($val);

		// Check field name 'UserName' first before field var 'x_UserName'
		$val = $CurrentForm->hasValue("UserName") ? $CurrentForm->getValue("UserName") : $CurrentForm->getValue("x_UserName");
		if (!$this->UserName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UserName->Visible = FALSE; // Disable update for API request
			else
				$this->UserName->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_UserName"))
			$this->UserName->setOldValue($CurrentForm->getValue("o_UserName"));

		// Check field name 'Password' first before field var 'x_Password'
		$val = $CurrentForm->hasValue("Password") ? $CurrentForm->getValue("Password") : $CurrentForm->getValue("x_Password");
		if (!$this->Password->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Password->Visible = FALSE; // Disable update for API request
			else
				if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
					$this->Password->setRawFormValue($val);
				else
					$this->Password->setFormValue($val);
		}

		// Check field name 'EmployeeID' first before field var 'x_EmployeeID'
		$val = $CurrentForm->hasValue("EmployeeID") ? $CurrentForm->getValue("EmployeeID") : $CurrentForm->getValue("x_EmployeeID");
		if (!$this->EmployeeID->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->EmployeeID->Visible = FALSE; // Disable update for API request
			else
				$this->EmployeeID->setFormValue($val);
		}

		// Check field name 'FirstName' first before field var 'x_FirstName'
		$val = $CurrentForm->hasValue("FirstName") ? $CurrentForm->getValue("FirstName") : $CurrentForm->getValue("x_FirstName");
		if (!$this->FirstName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->FirstName->Visible = FALSE; // Disable update for API request
			else
				$this->FirstName->setFormValue($val);
		}

		// Check field name 'LastName' first before field var 'x_LastName'
		$val = $CurrentForm->hasValue("LastName") ? $CurrentForm->getValue("LastName") : $CurrentForm->getValue("x_LastName");
		if (!$this->LastName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->LastName->Visible = FALSE; // Disable update for API request
			else
				$this->LastName->setFormValue($val);
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

		// Check field name 'Level' first before field var 'x_Level'
		$val = $CurrentForm->hasValue("Level") ? $CurrentForm->getValue("Level") : $CurrentForm->getValue("x_Level");
		if (!$this->Level->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Level->Visible = FALSE; // Disable update for API request
			else
				$this->Level->setFormValue($val);
		}

		// Check field name 'Role' first before field var 'x_Role'
		$val = $CurrentForm->hasValue("Role") ? $CurrentForm->getValue("Role") : $CurrentForm->getValue("x_Role");
		if (!$this->Role->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Role->Visible = FALSE; // Disable update for API request
			else
				$this->Role->setFormValue($val);
		}

		// Check field name 'Clearance' first before field var 'x_Clearance'
		$val = $CurrentForm->hasValue("Clearance") ? $CurrentForm->getValue("Clearance") : $CurrentForm->getValue("x_Clearance");
		if (!$this->Clearance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Clearance->Visible = FALSE; // Disable update for API request
			else
				$this->Clearance->setFormValue($val);
		}

		// Check field name 'OrganisationLevel' first before field var 'x_OrganisationLevel'
		$val = $CurrentForm->hasValue("OrganisationLevel") ? $CurrentForm->getValue("OrganisationLevel") : $CurrentForm->getValue("x_OrganisationLevel");
		if (!$this->OrganisationLevel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->OrganisationLevel->Visible = FALSE; // Disable update for API request
			else
				$this->OrganisationLevel->setFormValue($val);
		}

		// Check field name 'Active' first before field var 'x_Active'
		$val = $CurrentForm->hasValue("Active") ? $CurrentForm->getValue("Active") : $CurrentForm->getValue("x_Active");
		if (!$this->Active->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Active->Visible = FALSE; // Disable update for API request
			else
				$this->Active->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'Telephone' first before field var 'x_Telephone'
		$val = $CurrentForm->hasValue("Telephone") ? $CurrentForm->getValue("Telephone") : $CurrentForm->getValue("x_Telephone");
		if (!$this->Telephone->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Telephone->Visible = FALSE; // Disable update for API request
			else
				$this->Telephone->setFormValue($val);
		}

		// Check field name 'Mobile' first before field var 'x_Mobile'
		$val = $CurrentForm->hasValue("Mobile") ? $CurrentForm->getValue("Mobile") : $CurrentForm->getValue("x_Mobile");
		if (!$this->Mobile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Mobile->Visible = FALSE; // Disable update for API request
			else
				$this->Mobile->setFormValue($val);
		}

		// Check field name 'Position' first before field var 'x_Position'
		$val = $CurrentForm->hasValue("Position") ? $CurrentForm->getValue("Position") : $CurrentForm->getValue("x_Position");
		if (!$this->Position->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Position->Visible = FALSE; // Disable update for API request
			else
				$this->Position->setFormValue($val);
		}

		// Check field name 'ReportsTo' first before field var 'x_ReportsTo'
		$val = $CurrentForm->hasValue("ReportsTo") ? $CurrentForm->getValue("ReportsTo") : $CurrentForm->getValue("x_ReportsTo");
		if (!$this->ReportsTo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ReportsTo->Visible = FALSE; // Disable update for API request
			else
				$this->ReportsTo->setFormValue($val);
		}

		// Check field name 'Profile' first before field var 'x_Profile'
		$val = $CurrentForm->hasValue("Profile") ? $CurrentForm->getValue("Profile") : $CurrentForm->getValue("x_Profile");
		if (!$this->Profile->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Profile->Visible = FALSE; // Disable update for API request
			else
				$this->Profile->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->UserCode->CurrentValue = $this->UserCode->FormValue;
		$this->UserName->CurrentValue = $this->UserName->FormValue;
		$this->Password->CurrentValue = $this->Password->FormValue;
		$this->EmployeeID->CurrentValue = $this->EmployeeID->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->LastName->CurrentValue = $this->LastName->FormValue;
		$this->ProvinceCode->CurrentValue = $this->ProvinceCode->FormValue;
		$this->LACode->CurrentValue = $this->LACode->FormValue;
		$this->Level->CurrentValue = $this->Level->FormValue;
		$this->Role->CurrentValue = $this->Role->FormValue;
		$this->Clearance->CurrentValue = $this->Clearance->FormValue;
		$this->OrganisationLevel->CurrentValue = $this->OrganisationLevel->FormValue;
		$this->Active->CurrentValue = $this->Active->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Telephone->CurrentValue = $this->Telephone->FormValue;
		$this->Mobile->CurrentValue = $this->Mobile->FormValue;
		$this->Position->CurrentValue = $this->Position->FormValue;
		$this->ReportsTo->CurrentValue = $this->ReportsTo->FormValue;
		$this->Profile->CurrentValue = $this->Profile->FormValue;
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
		$this->UserCode->setDbValue($row['UserCode']);
		$this->UserName->setDbValue($row['UserName']);
		$this->Password->setDbValue($row['Password']);
		$this->ConfirmPwd->setDbValue($row['ConfirmPwd']);
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->LastName->setDbValue($row['LastName']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->Level->setDbValue($row['Level']);
		$this->Role->setDbValue($row['Role']);
		$this->Clearance->setDbValue($row['Clearance']);
		$this->OrganisationLevel->setDbValue($row['OrganisationLevel']);
		$this->Active->setDbValue($row['Active']);
		$this->_Email->setDbValue($row['Email']);
		$this->Telephone->setDbValue($row['Telephone']);
		$this->Mobile->setDbValue($row['Mobile']);
		$this->Position->setDbValue($row['Position']);
		$this->ReportsTo->setDbValue($row['ReportsTo']);
		$this->Profile->setDbValue($row['Profile']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['UserCode'] = NULL;
		$row['UserName'] = NULL;
		$row['Password'] = NULL;
		$row['ConfirmPwd'] = NULL;
		$row['EmployeeID'] = NULL;
		$row['FirstName'] = NULL;
		$row['LastName'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['Level'] = NULL;
		$row['Role'] = NULL;
		$row['Clearance'] = NULL;
		$row['OrganisationLevel'] = NULL;
		$row['Active'] = NULL;
		$row['Email'] = NULL;
		$row['Telephone'] = NULL;
		$row['Mobile'] = NULL;
		$row['Position'] = NULL;
		$row['ReportsTo'] = NULL;
		$row['Profile'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("UserName")) != "")
			$this->UserName->OldValue = $this->getKey("UserName"); // UserName
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
		// UserCode
		// UserName
		// Password
		// ConfirmPwd
		// EmployeeID
		// FirstName
		// LastName
		// ProvinceCode
		// LACode
		// Level
		// Role
		// Clearance
		// OrganisationLevel
		// Active
		// Email
		// Telephone
		// Mobile
		// Position
		// ReportsTo
		// Profile

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// UserCode
			$this->UserCode->ViewValue = $this->UserCode->CurrentValue;
			$this->UserCode->ViewCustomAttributes = "";

			// UserName
			$this->UserName->ViewValue = $this->UserName->CurrentValue;
			$this->UserName->ViewCustomAttributes = "";

			// Password
			$this->Password->ViewValue = $Language->phrase("PasswordMask");
			$this->Password->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->ViewCustomAttributes = "";

			// LastName
			$this->LastName->ViewValue = $this->LastName->CurrentValue;
			$this->LastName->ViewCustomAttributes = "";

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

			// Level
			$curVal = strval($this->Level->CurrentValue);
			if ($curVal != "") {
				$this->Level->ViewValue = $this->Level->lookupCacheOption($curVal);
				if ($this->Level->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Level->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Level->ViewValue = $this->Level->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Level->ViewValue = $this->Level->CurrentValue;
					}
				}
			} else {
				$this->Level->ViewValue = NULL;
			}
			$this->Level->ViewCustomAttributes = "";

			// Role
			$curVal = strval($this->Role->CurrentValue);
			if ($curVal != "") {
				$this->Role->ViewValue = $this->Role->lookupCacheOption($curVal);
				if ($this->Role->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Role`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Role->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Role->ViewValue = $this->Role->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Role->ViewValue = $this->Role->CurrentValue;
					}
				}
			} else {
				$this->Role->ViewValue = NULL;
			}
			$this->Role->ViewCustomAttributes = "";

			// Clearance
			if ($Security->canAdmin()) { // System admin
				$curVal = strval($this->Clearance->CurrentValue);
				if ($curVal != "") {
					$this->Clearance->ViewValue = $this->Clearance->lookupCacheOption($curVal);
					if ($this->Clearance->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->Clearance->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Clearance->ViewValue = $this->Clearance->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->Clearance->ViewValue = $this->Clearance->CurrentValue;
						}
					}
				} else {
					$this->Clearance->ViewValue = NULL;
				}
			} else {
				$this->Clearance->ViewValue = $Language->phrase("PasswordMask");
			}
			$this->Clearance->ViewCustomAttributes = "";

			// OrganisationLevel
			$this->OrganisationLevel->ViewValue = $this->OrganisationLevel->CurrentValue;
			$this->OrganisationLevel->ViewCustomAttributes = "";

			// Active
			$curVal = strval($this->Active->CurrentValue);
			if ($curVal != "") {
				$this->Active->ViewValue = $this->Active->lookupCacheOption($curVal);
				if ($this->Active->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Active->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Active->ViewValue = $this->Active->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Active->ViewValue = $this->Active->CurrentValue;
					}
				}
			} else {
				$this->Active->ViewValue = NULL;
			}
			$this->Active->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Telephone
			$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
			$this->Telephone->ViewCustomAttributes = "";

			// Mobile
			$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
			$this->Mobile->ViewCustomAttributes = "";

			// Position
			$this->Position->ViewValue = $this->Position->CurrentValue;
			$this->Position->ViewCustomAttributes = "";

			// ReportsTo
			$this->ReportsTo->ViewValue = $this->ReportsTo->CurrentValue;
			$this->ReportsTo->ViewCustomAttributes = "";

			// Profile
			$this->Profile->ViewValue = $this->Profile->CurrentValue;
			$this->Profile->ViewCustomAttributes = "";

			// UserCode
			$this->UserCode->LinkCustomAttributes = "";
			$this->UserCode->HrefValue = "";
			$this->UserCode->TooltipValue = "";

			// UserName
			$this->UserName->LinkCustomAttributes = "";
			$this->UserName->HrefValue = "";
			$this->UserName->TooltipValue = "";

			// Password
			$this->Password->LinkCustomAttributes = "";
			$this->Password->HrefValue = "";
			$this->Password->TooltipValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";

			// LastName
			$this->LastName->LinkCustomAttributes = "";
			$this->LastName->HrefValue = "";
			$this->LastName->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// Level
			$this->Level->LinkCustomAttributes = "";
			$this->Level->HrefValue = "";
			$this->Level->TooltipValue = "";

			// Role
			$this->Role->LinkCustomAttributes = "";
			$this->Role->HrefValue = "";
			$this->Role->TooltipValue = "";

			// Clearance
			$this->Clearance->LinkCustomAttributes = "";
			$this->Clearance->HrefValue = "";
			$this->Clearance->TooltipValue = "";

			// OrganisationLevel
			$this->OrganisationLevel->LinkCustomAttributes = "";
			$this->OrganisationLevel->HrefValue = "";
			$this->OrganisationLevel->TooltipValue = "";

			// Active
			$this->Active->LinkCustomAttributes = "";
			$this->Active->HrefValue = "";
			$this->Active->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";
			$this->Telephone->TooltipValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";
			$this->Mobile->TooltipValue = "";

			// Position
			$this->Position->LinkCustomAttributes = "";
			$this->Position->HrefValue = "";
			$this->Position->TooltipValue = "";

			// ReportsTo
			$this->ReportsTo->LinkCustomAttributes = "";
			$this->ReportsTo->HrefValue = "";
			$this->ReportsTo->TooltipValue = "";

			// Profile
			$this->Profile->LinkCustomAttributes = "";
			$this->Profile->HrefValue = "";
			$this->Profile->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// UserCode
			$this->UserCode->EditAttrs["class"] = "form-control";
			$this->UserCode->EditCustomAttributes = "";
			$this->UserCode->EditValue = HtmlEncode($this->UserCode->CurrentValue);
			$this->UserCode->PlaceHolder = RemoveHtml($this->UserCode->caption());

			// UserName
			$this->UserName->EditAttrs["class"] = "form-control";
			$this->UserName->EditCustomAttributes = "";
			if (!$this->UserName->Raw)
				$this->UserName->CurrentValue = HtmlDecode($this->UserName->CurrentValue);
			$this->UserName->EditValue = HtmlEncode($this->UserName->CurrentValue);
			$this->UserName->PlaceHolder = RemoveHtml($this->UserName->caption());

			// Password
			$this->Password->EditAttrs["class"] = "form-control ew-password-strength";
			$this->Password->EditCustomAttributes = "";
			$this->Password->EditValue = HtmlEncode($this->Password->CurrentValue);
			$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

			// EmployeeID
			$this->EmployeeID->EditAttrs["class"] = "form-control";
			$this->EmployeeID->EditCustomAttributes = "";
			$this->EmployeeID->EditValue = HtmlEncode($this->EmployeeID->CurrentValue);
			$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// LastName
			$this->LastName->EditAttrs["class"] = "form-control";
			$this->LastName->EditCustomAttributes = "";
			if (!$this->LastName->Raw)
				$this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
			$this->LastName->EditValue = HtmlEncode($this->LastName->CurrentValue);
			$this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

			// ProvinceCode
			$this->ProvinceCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ProvinceCode->CurrentValue));
			if ($curVal != "")
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
			else
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->Lookup !== NULL && is_array($this->ProvinceCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ProvinceCode->ViewValue !== NULL) { // Load from cache
				$this->ProvinceCode->EditValue = array_values($this->ProvinceCode->Lookup->Options);
				if ($this->ProvinceCode->ViewValue == "")
					$this->ProvinceCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ProvinceCode`" . SearchString("=", $this->ProvinceCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ProvinceCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
				} else {
					$this->ProvinceCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ProvinceCode->EditValue = $arwrk;
			}

			// LACode
			$this->LACode->EditCustomAttributes = "";
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

			// Level
			$this->Level->EditAttrs["class"] = "form-control";
			$this->Level->EditCustomAttributes = "";
			$curVal = trim(strval($this->Level->CurrentValue));
			if ($curVal != "")
				$this->Level->ViewValue = $this->Level->lookupCacheOption($curVal);
			else
				$this->Level->ViewValue = $this->Level->Lookup !== NULL && is_array($this->Level->Lookup->Options) ? $curVal : NULL;
			if ($this->Level->ViewValue !== NULL) { // Load from cache
				$this->Level->EditValue = array_values($this->Level->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`userlevelid`" . SearchString("=", $this->Level->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Level->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Level->EditValue = $arwrk;
			}

			// Role
			$this->Role->EditAttrs["class"] = "form-control";
			$this->Role->EditCustomAttributes = "";
			$curVal = trim(strval($this->Role->CurrentValue));
			if ($curVal != "")
				$this->Role->ViewValue = $this->Role->lookupCacheOption($curVal);
			else
				$this->Role->ViewValue = $this->Role->Lookup !== NULL && is_array($this->Role->Lookup->Options) ? $curVal : NULL;
			if ($this->Role->ViewValue !== NULL) { // Load from cache
				$this->Role->EditValue = array_values($this->Role->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Role`" . SearchString("=", $this->Role->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Role->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Role->EditValue = $arwrk;
			}

			// Clearance
			$this->Clearance->EditAttrs["class"] = "form-control";
			$this->Clearance->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->Clearance->EditValue = $Language->phrase("PasswordMask");
			} else {
				$curVal = trim(strval($this->Clearance->CurrentValue));
				if ($curVal != "")
					$this->Clearance->ViewValue = $this->Clearance->lookupCacheOption($curVal);
				else
					$this->Clearance->ViewValue = $this->Clearance->Lookup !== NULL && is_array($this->Clearance->Lookup->Options) ? $curVal : NULL;
				if ($this->Clearance->ViewValue !== NULL) { // Load from cache
					$this->Clearance->EditValue = array_values($this->Clearance->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`userlevelid`" . SearchString("=", $this->Clearance->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->Clearance->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->Clearance->EditValue = $arwrk;
				}
			}

			// OrganisationLevel
			$this->OrganisationLevel->EditAttrs["class"] = "form-control";
			$this->OrganisationLevel->EditCustomAttributes = "";
			$this->OrganisationLevel->EditValue = HtmlEncode($this->OrganisationLevel->CurrentValue);
			$this->OrganisationLevel->PlaceHolder = RemoveHtml($this->OrganisationLevel->caption());

			// Active
			$this->Active->EditCustomAttributes = "";
			$curVal = trim(strval($this->Active->CurrentValue));
			if ($curVal != "")
				$this->Active->ViewValue = $this->Active->lookupCacheOption($curVal);
			else
				$this->Active->ViewValue = $this->Active->Lookup !== NULL && is_array($this->Active->Lookup->Options) ? $curVal : NULL;
			if ($this->Active->ViewValue !== NULL) { // Load from cache
				$this->Active->EditValue = array_values($this->Active->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Active->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Active->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Active->EditValue = $arwrk;
			}

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// Telephone
			$this->Telephone->EditAttrs["class"] = "form-control";
			$this->Telephone->EditCustomAttributes = "";
			if (!$this->Telephone->Raw)
				$this->Telephone->CurrentValue = HtmlDecode($this->Telephone->CurrentValue);
			$this->Telephone->EditValue = HtmlEncode($this->Telephone->CurrentValue);
			$this->Telephone->PlaceHolder = RemoveHtml($this->Telephone->caption());

			// Mobile
			$this->Mobile->EditAttrs["class"] = "form-control";
			$this->Mobile->EditCustomAttributes = "";
			if (!$this->Mobile->Raw)
				$this->Mobile->CurrentValue = HtmlDecode($this->Mobile->CurrentValue);
			$this->Mobile->EditValue = HtmlEncode($this->Mobile->CurrentValue);
			$this->Mobile->PlaceHolder = RemoveHtml($this->Mobile->caption());

			// Position
			$this->Position->EditAttrs["class"] = "form-control";
			$this->Position->EditCustomAttributes = "";
			if (!$this->Position->Raw)
				$this->Position->CurrentValue = HtmlDecode($this->Position->CurrentValue);
			$this->Position->EditValue = HtmlEncode($this->Position->CurrentValue);
			$this->Position->PlaceHolder = RemoveHtml($this->Position->caption());

			// ReportsTo
			$this->ReportsTo->EditAttrs["class"] = "form-control";
			$this->ReportsTo->EditCustomAttributes = "";
			$this->ReportsTo->EditValue = HtmlEncode($this->ReportsTo->CurrentValue);
			$this->ReportsTo->PlaceHolder = RemoveHtml($this->ReportsTo->caption());

			// Profile
			$this->Profile->EditAttrs["class"] = "form-control";
			$this->Profile->EditCustomAttributes = "";
			$this->Profile->EditValue = HtmlEncode($this->Profile->CurrentValue);
			$this->Profile->PlaceHolder = RemoveHtml($this->Profile->caption());

			// Edit refer script
			// UserCode

			$this->UserCode->LinkCustomAttributes = "";
			$this->UserCode->HrefValue = "";

			// UserName
			$this->UserName->LinkCustomAttributes = "";
			$this->UserName->HrefValue = "";

			// Password
			$this->Password->LinkCustomAttributes = "";
			$this->Password->HrefValue = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// LastName
			$this->LastName->LinkCustomAttributes = "";
			$this->LastName->HrefValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";

			// Level
			$this->Level->LinkCustomAttributes = "";
			$this->Level->HrefValue = "";

			// Role
			$this->Role->LinkCustomAttributes = "";
			$this->Role->HrefValue = "";

			// Clearance
			$this->Clearance->LinkCustomAttributes = "";
			$this->Clearance->HrefValue = "";

			// OrganisationLevel
			$this->OrganisationLevel->LinkCustomAttributes = "";
			$this->OrganisationLevel->HrefValue = "";

			// Active
			$this->Active->LinkCustomAttributes = "";
			$this->Active->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";

			// Position
			$this->Position->LinkCustomAttributes = "";
			$this->Position->HrefValue = "";

			// ReportsTo
			$this->ReportsTo->LinkCustomAttributes = "";
			$this->ReportsTo->HrefValue = "";

			// Profile
			$this->Profile->LinkCustomAttributes = "";
			$this->Profile->HrefValue = "";
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
		if ($this->UserCode->Required) {
			if (!$this->UserCode->IsDetailKey && $this->UserCode->FormValue != NULL && $this->UserCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserCode->caption(), $this->UserCode->RequiredErrorMessage));
			}
		}
		if ($this->UserName->Required) {
			if (!$this->UserName->IsDetailKey && $this->UserName->FormValue != NULL && $this->UserName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserName->caption(), $this->UserName->RequiredErrorMessage));
			}
		}
		if ($this->Password->Required) {
			if (!$this->Password->IsDetailKey && $this->Password->FormValue != NULL && $this->Password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Password->caption(), $this->Password->RequiredErrorMessage));
			}
		}
		if ($this->EmployeeID->Required) {
			if (!$this->EmployeeID->IsDetailKey && $this->EmployeeID->FormValue != NULL && $this->EmployeeID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EmployeeID->caption(), $this->EmployeeID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->EmployeeID->FormValue)) {
			AddMessage($FormError, $this->EmployeeID->errorMessage());
		}
		if ($this->FirstName->Required) {
			if (!$this->FirstName->IsDetailKey && $this->FirstName->FormValue != NULL && $this->FirstName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirstName->caption(), $this->FirstName->RequiredErrorMessage));
			}
		}
		if ($this->LastName->Required) {
			if (!$this->LastName->IsDetailKey && $this->LastName->FormValue != NULL && $this->LastName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastName->caption(), $this->LastName->RequiredErrorMessage));
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
		if ($this->Level->Required) {
			if (!$this->Level->IsDetailKey && $this->Level->FormValue != NULL && $this->Level->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Level->caption(), $this->Level->RequiredErrorMessage));
			}
		}
		if ($this->Role->Required) {
			if (!$this->Role->IsDetailKey && $this->Role->FormValue != NULL && $this->Role->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Role->caption(), $this->Role->RequiredErrorMessage));
			}
		}
		if ($this->Clearance->Required) {
			if (!$this->Clearance->IsDetailKey && $this->Clearance->FormValue != NULL && $this->Clearance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Clearance->caption(), $this->Clearance->RequiredErrorMessage));
			}
		}
		if ($this->OrganisationLevel->Required) {
			if (!$this->OrganisationLevel->IsDetailKey && $this->OrganisationLevel->FormValue != NULL && $this->OrganisationLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->OrganisationLevel->caption(), $this->OrganisationLevel->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->OrganisationLevel->FormValue)) {
			AddMessage($FormError, $this->OrganisationLevel->errorMessage());
		}
		if ($this->Active->Required) {
			if ($this->Active->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Active->caption(), $this->Active->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->Telephone->Required) {
			if (!$this->Telephone->IsDetailKey && $this->Telephone->FormValue != NULL && $this->Telephone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Telephone->caption(), $this->Telephone->RequiredErrorMessage));
			}
		}
		if ($this->Mobile->Required) {
			if (!$this->Mobile->IsDetailKey && $this->Mobile->FormValue != NULL && $this->Mobile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Mobile->caption(), $this->Mobile->RequiredErrorMessage));
			}
		}
		if ($this->Position->Required) {
			if (!$this->Position->IsDetailKey && $this->Position->FormValue != NULL && $this->Position->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Position->caption(), $this->Position->RequiredErrorMessage));
			}
		}
		if ($this->ReportsTo->Required) {
			if (!$this->ReportsTo->IsDetailKey && $this->ReportsTo->FormValue != NULL && $this->ReportsTo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ReportsTo->caption(), $this->ReportsTo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ReportsTo->FormValue)) {
			AddMessage($FormError, $this->ReportsTo->errorMessage());
		}
		if ($this->Profile->Required) {
			if (!$this->Profile->IsDetailKey && $this->Profile->FormValue != NULL && $this->Profile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Profile->caption(), $this->Profile->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("security_matrix", $detailTblVar) && $GLOBALS["security_matrix"]->DetailEdit) {
			if (!isset($GLOBALS["security_matrix_grid"]))
				$GLOBALS["security_matrix_grid"] = new security_matrix_grid(); // Get detail page object
			$GLOBALS["security_matrix_grid"]->validateGridForm();
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
		if ($this->EmployeeID->CurrentValue != "") { // Check field with unique index
			$filterChk = "(`EmployeeID` = " . AdjustSql($this->EmployeeID->CurrentValue, $this->Dbid) . ")";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = "";
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->EmployeeID->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->EmployeeID->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
			$rsChk->close();
		}
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

			// UserName
			$this->UserName->setDbValueDef($rsnew, $this->UserName->CurrentValue, "", $this->UserName->ReadOnly);

			// Password
			$this->Password->setDbValueDef($rsnew, $this->Password->CurrentValue, "", $this->Password->ReadOnly || Config("ENCRYPTED_PASSWORD") && $rs->fields('Password') == $this->Password->CurrentValue);

			// EmployeeID
			$this->EmployeeID->setDbValueDef($rsnew, $this->EmployeeID->CurrentValue, NULL, $this->EmployeeID->ReadOnly);

			// FirstName
			$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, "", $this->FirstName->ReadOnly);

			// LastName
			$this->LastName->setDbValueDef($rsnew, $this->LastName->CurrentValue, "", $this->LastName->ReadOnly);

			// ProvinceCode
			$this->ProvinceCode->setDbValueDef($rsnew, $this->ProvinceCode->CurrentValue, NULL, $this->ProvinceCode->ReadOnly);

			// LACode
			$this->LACode->setDbValueDef($rsnew, $this->LACode->CurrentValue, NULL, $this->LACode->ReadOnly);

			// Level
			$this->Level->setDbValueDef($rsnew, $this->Level->CurrentValue, 0, $this->Level->ReadOnly);

			// Role
			$this->Role->setDbValueDef($rsnew, $this->Role->CurrentValue, "", $this->Role->ReadOnly);

			// Clearance
			
			if ($Security->canAdmin()) { // System admin
				
				$this->Clearance->setDbValueDef($rsnew, $this->Clearance->CurrentValue, 0, $this->Clearance->ReadOnly);
				
			}
			

			// OrganisationLevel
			$this->OrganisationLevel->setDbValueDef($rsnew, $this->OrganisationLevel->CurrentValue, NULL, $this->OrganisationLevel->ReadOnly);

			// Active
			$this->Active->setDbValueDef($rsnew, $this->Active->CurrentValue, NULL, $this->Active->ReadOnly);

			// Email
			$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, $this->_Email->ReadOnly);

			// Telephone
			$this->Telephone->setDbValueDef($rsnew, $this->Telephone->CurrentValue, NULL, $this->Telephone->ReadOnly);

			// Mobile
			$this->Mobile->setDbValueDef($rsnew, $this->Mobile->CurrentValue, NULL, $this->Mobile->ReadOnly);

			// Position
			$this->Position->setDbValueDef($rsnew, $this->Position->CurrentValue, NULL, $this->Position->ReadOnly);

			// ReportsTo
			$this->ReportsTo->setDbValueDef($rsnew, $this->ReportsTo->CurrentValue, NULL, $this->ReportsTo->ReadOnly);

			// Profile
			$this->Profile->setDbValueDef($rsnew, $this->Profile->CurrentValue, NULL, $this->Profile->ReadOnly);

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
					if (in_array("security_matrix", $detailTblVar) && $GLOBALS["security_matrix"]->DetailEdit) {
						if (!isset($GLOBALS["security_matrix_grid"]))
							$GLOBALS["security_matrix_grid"] = new security_matrix_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "security_matrix"); // Load user level of detail table
						$editRow = $GLOBALS["security_matrix_grid"]->gridUpdate();
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
			if (in_array("security_matrix", $detailTblVar)) {
				if (!isset($GLOBALS["security_matrix_grid"]))
					$GLOBALS["security_matrix_grid"] = new security_matrix_grid();
				if ($GLOBALS["security_matrix_grid"]->DetailEdit) {
					$GLOBALS["security_matrix_grid"]->CurrentMode = "edit";
					$GLOBALS["security_matrix_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["security_matrix_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["security_matrix_grid"]->setStartRecordNumber(1);
					$GLOBALS["security_matrix_grid"]->UserCode->IsDetailKey = TRUE;
					$GLOBALS["security_matrix_grid"]->UserCode->CurrentValue = $this->UserCode->CurrentValue;
					$GLOBALS["security_matrix_grid"]->UserCode->setSessionValue($GLOBALS["security_matrix_grid"]->UserCode->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("muserslist.php"), "", $this->TableVar, TRUE);
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
				case "x_Level":
					break;
				case "x_Role":
					break;
				case "x_Clearance":
					break;
				case "x_Active":
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
						case "x_Level":
							break;
						case "x_Role":
							break;
						case "x_Clearance":
							break;
						case "x_Active":
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