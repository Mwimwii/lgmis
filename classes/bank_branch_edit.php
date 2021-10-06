<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class bank_branch_edit extends bank_branch
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'bank_branch';

	// Page object name
	public $PageObjName = "bank_branch_edit";

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

		// Table object (bank_branch)
		if (!isset($GLOBALS["bank_branch"]) || get_class($GLOBALS["bank_branch"]) == PROJECT_NAMESPACE . "bank_branch") {
			$GLOBALS["bank_branch"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["bank_branch"];
		}

		// Table object (bank)
		if (!isset($GLOBALS['bank']))
			$GLOBALS['bank'] = new bank();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'bank_branch');

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
		global $bank_branch;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($bank_branch);
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
					if ($pageName == "bank_branchview.php")
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
			$key .= @$ar['BranchCode'];
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
					$this->terminate(GetUrl("bank_branchlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->BranchCode->setVisibility();
		$this->BranchName->setVisibility();
		$this->BankCode->setVisibility();
		$this->AreaCode->setVisibility();
		$this->BranchNo->setVisibility();
		$this->BranchAddress->setVisibility();
		$this->BranchTel->setVisibility();
		$this->BranchEmail->setVisibility();
		$this->BranchFax->setVisibility();
		$this->SWIFT->setVisibility();
		$this->IBAN->setVisibility();
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
			$this->terminate("bank_branchlist.php");
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
			if (Get("BranchCode") !== NULL) {
				$this->BranchCode->setQueryStringValue(Get("BranchCode"));
				$this->BranchCode->setOldValue($this->BranchCode->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->BranchCode->setQueryStringValue(Key(0));
				$this->BranchCode->setOldValue($this->BranchCode->QueryStringValue);
			} elseif (Post("BranchCode") !== NULL) {
				$this->BranchCode->setFormValue(Post("BranchCode"));
				$this->BranchCode->setOldValue($this->BranchCode->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->BranchCode->setQueryStringValue(Route(2));
				$this->BranchCode->setOldValue($this->BranchCode->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_BranchCode")) {
					$this->BranchCode->setFormValue($CurrentForm->getValue("x_BranchCode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("BranchCode") !== NULL) {
					$this->BranchCode->setQueryStringValue(Get("BranchCode"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->BranchCode->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->BranchCode->CurrentValue = NULL;
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
				$this->terminate("bank_branchlist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->BranchCode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->BranchCode->CurrentValue, $rs->fields('BranchCode'))) {
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
					$this->terminate("bank_branchlist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "bank_branchlist.php")
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

		// Check field name 'BranchCode' first before field var 'x_BranchCode'
		$val = $CurrentForm->hasValue("BranchCode") ? $CurrentForm->getValue("BranchCode") : $CurrentForm->getValue("x_BranchCode");
		if (!$this->BranchCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchCode->Visible = FALSE; // Disable update for API request
			else
				$this->BranchCode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BranchCode"))
			$this->BranchCode->setOldValue($CurrentForm->getValue("o_BranchCode"));

		// Check field name 'BranchName' first before field var 'x_BranchName'
		$val = $CurrentForm->hasValue("BranchName") ? $CurrentForm->getValue("BranchName") : $CurrentForm->getValue("x_BranchName");
		if (!$this->BranchName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchName->Visible = FALSE; // Disable update for API request
			else
				$this->BranchName->setFormValue($val);
		}

		// Check field name 'BankCode' first before field var 'x_BankCode'
		$val = $CurrentForm->hasValue("BankCode") ? $CurrentForm->getValue("BankCode") : $CurrentForm->getValue("x_BankCode");
		if (!$this->BankCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BankCode->Visible = FALSE; // Disable update for API request
			else
				$this->BankCode->setFormValue($val);
		}

		// Check field name 'AreaCode' first before field var 'x_AreaCode'
		$val = $CurrentForm->hasValue("AreaCode") ? $CurrentForm->getValue("AreaCode") : $CurrentForm->getValue("x_AreaCode");
		if (!$this->AreaCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AreaCode->Visible = FALSE; // Disable update for API request
			else
				$this->AreaCode->setFormValue($val);
		}

		// Check field name 'BranchNo' first before field var 'x_BranchNo'
		$val = $CurrentForm->hasValue("BranchNo") ? $CurrentForm->getValue("BranchNo") : $CurrentForm->getValue("x_BranchNo");
		if (!$this->BranchNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchNo->Visible = FALSE; // Disable update for API request
			else
				$this->BranchNo->setFormValue($val);
		}

		// Check field name 'BranchAddress' first before field var 'x_BranchAddress'
		$val = $CurrentForm->hasValue("BranchAddress") ? $CurrentForm->getValue("BranchAddress") : $CurrentForm->getValue("x_BranchAddress");
		if (!$this->BranchAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchAddress->Visible = FALSE; // Disable update for API request
			else
				$this->BranchAddress->setFormValue($val);
		}

		// Check field name 'BranchTel' first before field var 'x_BranchTel'
		$val = $CurrentForm->hasValue("BranchTel") ? $CurrentForm->getValue("BranchTel") : $CurrentForm->getValue("x_BranchTel");
		if (!$this->BranchTel->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchTel->Visible = FALSE; // Disable update for API request
			else
				$this->BranchTel->setFormValue($val);
		}

		// Check field name 'BranchEmail' first before field var 'x_BranchEmail'
		$val = $CurrentForm->hasValue("BranchEmail") ? $CurrentForm->getValue("BranchEmail") : $CurrentForm->getValue("x_BranchEmail");
		if (!$this->BranchEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchEmail->Visible = FALSE; // Disable update for API request
			else
				$this->BranchEmail->setFormValue($val);
		}

		// Check field name 'BranchFax' first before field var 'x_BranchFax'
		$val = $CurrentForm->hasValue("BranchFax") ? $CurrentForm->getValue("BranchFax") : $CurrentForm->getValue("x_BranchFax");
		if (!$this->BranchFax->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BranchFax->Visible = FALSE; // Disable update for API request
			else
				$this->BranchFax->setFormValue($val);
		}

		// Check field name 'SWIFT' first before field var 'x_SWIFT'
		$val = $CurrentForm->hasValue("SWIFT") ? $CurrentForm->getValue("SWIFT") : $CurrentForm->getValue("x_SWIFT");
		if (!$this->SWIFT->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->SWIFT->Visible = FALSE; // Disable update for API request
			else
				$this->SWIFT->setFormValue($val);
		}

		// Check field name 'IBAN' first before field var 'x_IBAN'
		$val = $CurrentForm->hasValue("IBAN") ? $CurrentForm->getValue("IBAN") : $CurrentForm->getValue("x_IBAN");
		if (!$this->IBAN->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IBAN->Visible = FALSE; // Disable update for API request
			else
				$this->IBAN->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->BranchCode->CurrentValue = $this->BranchCode->FormValue;
		$this->BranchName->CurrentValue = $this->BranchName->FormValue;
		$this->BankCode->CurrentValue = $this->BankCode->FormValue;
		$this->AreaCode->CurrentValue = $this->AreaCode->FormValue;
		$this->BranchNo->CurrentValue = $this->BranchNo->FormValue;
		$this->BranchAddress->CurrentValue = $this->BranchAddress->FormValue;
		$this->BranchTel->CurrentValue = $this->BranchTel->FormValue;
		$this->BranchEmail->CurrentValue = $this->BranchEmail->FormValue;
		$this->BranchFax->CurrentValue = $this->BranchFax->FormValue;
		$this->SWIFT->CurrentValue = $this->SWIFT->FormValue;
		$this->IBAN->CurrentValue = $this->IBAN->FormValue;
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
		$this->BranchCode->setDbValue($row['BranchCode']);
		$this->BranchName->setDbValue($row['BranchName']);
		$this->BankCode->setDbValue($row['BankCode']);
		$this->AreaCode->setDbValue($row['AreaCode']);
		$this->BranchNo->setDbValue($row['BranchNo']);
		$this->BranchAddress->setDbValue($row['BranchAddress']);
		$this->BranchTel->setDbValue($row['BranchTel']);
		$this->BranchEmail->setDbValue($row['BranchEmail']);
		$this->BranchFax->setDbValue($row['BranchFax']);
		$this->SWIFT->setDbValue($row['SWIFT']);
		$this->IBAN->setDbValue($row['IBAN']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['BranchCode'] = NULL;
		$row['BranchName'] = NULL;
		$row['BankCode'] = NULL;
		$row['AreaCode'] = NULL;
		$row['BranchNo'] = NULL;
		$row['BranchAddress'] = NULL;
		$row['BranchTel'] = NULL;
		$row['BranchEmail'] = NULL;
		$row['BranchFax'] = NULL;
		$row['SWIFT'] = NULL;
		$row['IBAN'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("BranchCode")) != "")
			$this->BranchCode->OldValue = $this->getKey("BranchCode"); // BranchCode
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
		// BranchCode
		// BranchName
		// BankCode
		// AreaCode
		// BranchNo
		// BranchAddress
		// BranchTel
		// BranchEmail
		// BranchFax
		// SWIFT
		// IBAN

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// BranchCode
			$this->BranchCode->ViewValue = $this->BranchCode->CurrentValue;
			$this->BranchCode->ViewCustomAttributes = "";

			// BranchName
			$this->BranchName->ViewValue = $this->BranchName->CurrentValue;
			$this->BranchName->ViewCustomAttributes = "";

			// BankCode
			$this->BankCode->ViewValue = $this->BankCode->CurrentValue;
			$this->BankCode->ViewCustomAttributes = "";

			// AreaCode
			$this->AreaCode->ViewValue = $this->AreaCode->CurrentValue;
			$this->AreaCode->ViewCustomAttributes = "";

			// BranchNo
			$this->BranchNo->ViewValue = $this->BranchNo->CurrentValue;
			$this->BranchNo->ViewCustomAttributes = "";

			// BranchAddress
			$this->BranchAddress->ViewValue = $this->BranchAddress->CurrentValue;
			$this->BranchAddress->ViewCustomAttributes = "";

			// BranchTel
			$this->BranchTel->ViewValue = $this->BranchTel->CurrentValue;
			$this->BranchTel->ViewCustomAttributes = "";

			// BranchEmail
			$this->BranchEmail->ViewValue = $this->BranchEmail->CurrentValue;
			$this->BranchEmail->ViewCustomAttributes = "";

			// BranchFax
			$this->BranchFax->ViewValue = $this->BranchFax->CurrentValue;
			$this->BranchFax->ViewCustomAttributes = "";

			// SWIFT
			$this->SWIFT->ViewValue = $this->SWIFT->CurrentValue;
			$this->SWIFT->ViewCustomAttributes = "";

			// IBAN
			$this->IBAN->ViewValue = $this->IBAN->CurrentValue;
			$this->IBAN->ViewCustomAttributes = "";

			// BranchCode
			$this->BranchCode->LinkCustomAttributes = "";
			$this->BranchCode->HrefValue = "";
			$this->BranchCode->TooltipValue = "";

			// BranchName
			$this->BranchName->LinkCustomAttributes = "";
			$this->BranchName->HrefValue = "";
			$this->BranchName->TooltipValue = "";

			// BankCode
			$this->BankCode->LinkCustomAttributes = "";
			$this->BankCode->HrefValue = "";
			$this->BankCode->TooltipValue = "";

			// AreaCode
			$this->AreaCode->LinkCustomAttributes = "";
			$this->AreaCode->HrefValue = "";
			$this->AreaCode->TooltipValue = "";

			// BranchNo
			$this->BranchNo->LinkCustomAttributes = "";
			$this->BranchNo->HrefValue = "";
			$this->BranchNo->TooltipValue = "";

			// BranchAddress
			$this->BranchAddress->LinkCustomAttributes = "";
			$this->BranchAddress->HrefValue = "";
			$this->BranchAddress->TooltipValue = "";

			// BranchTel
			$this->BranchTel->LinkCustomAttributes = "";
			$this->BranchTel->HrefValue = "";
			$this->BranchTel->TooltipValue = "";

			// BranchEmail
			$this->BranchEmail->LinkCustomAttributes = "";
			$this->BranchEmail->HrefValue = "";
			$this->BranchEmail->TooltipValue = "";

			// BranchFax
			$this->BranchFax->LinkCustomAttributes = "";
			$this->BranchFax->HrefValue = "";
			$this->BranchFax->TooltipValue = "";

			// SWIFT
			$this->SWIFT->LinkCustomAttributes = "";
			$this->SWIFT->HrefValue = "";
			$this->SWIFT->TooltipValue = "";

			// IBAN
			$this->IBAN->LinkCustomAttributes = "";
			$this->IBAN->HrefValue = "";
			$this->IBAN->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// BranchCode
			$this->BranchCode->EditAttrs["class"] = "form-control";
			$this->BranchCode->EditCustomAttributes = "";
			if (!$this->BranchCode->Raw)
				$this->BranchCode->CurrentValue = HtmlDecode($this->BranchCode->CurrentValue);
			$this->BranchCode->EditValue = HtmlEncode($this->BranchCode->CurrentValue);
			$this->BranchCode->PlaceHolder = RemoveHtml($this->BranchCode->caption());

			// BranchName
			$this->BranchName->EditAttrs["class"] = "form-control";
			$this->BranchName->EditCustomAttributes = "";
			if (!$this->BranchName->Raw)
				$this->BranchName->CurrentValue = HtmlDecode($this->BranchName->CurrentValue);
			$this->BranchName->EditValue = HtmlEncode($this->BranchName->CurrentValue);
			$this->BranchName->PlaceHolder = RemoveHtml($this->BranchName->caption());

			// BankCode
			$this->BankCode->EditAttrs["class"] = "form-control";
			$this->BankCode->EditCustomAttributes = "";
			if ($this->BankCode->getSessionValue() != "") {
				$this->BankCode->CurrentValue = $this->BankCode->getSessionValue();
				$this->BankCode->ViewValue = $this->BankCode->CurrentValue;
				$this->BankCode->ViewCustomAttributes = "";
			} else {
				if (!$this->BankCode->Raw)
					$this->BankCode->CurrentValue = HtmlDecode($this->BankCode->CurrentValue);
				$this->BankCode->EditValue = HtmlEncode($this->BankCode->CurrentValue);
				$this->BankCode->PlaceHolder = RemoveHtml($this->BankCode->caption());
			}

			// AreaCode
			$this->AreaCode->EditAttrs["class"] = "form-control";
			$this->AreaCode->EditCustomAttributes = "";
			if (!$this->AreaCode->Raw)
				$this->AreaCode->CurrentValue = HtmlDecode($this->AreaCode->CurrentValue);
			$this->AreaCode->EditValue = HtmlEncode($this->AreaCode->CurrentValue);
			$this->AreaCode->PlaceHolder = RemoveHtml($this->AreaCode->caption());

			// BranchNo
			$this->BranchNo->EditAttrs["class"] = "form-control";
			$this->BranchNo->EditCustomAttributes = "";
			if (!$this->BranchNo->Raw)
				$this->BranchNo->CurrentValue = HtmlDecode($this->BranchNo->CurrentValue);
			$this->BranchNo->EditValue = HtmlEncode($this->BranchNo->CurrentValue);
			$this->BranchNo->PlaceHolder = RemoveHtml($this->BranchNo->caption());

			// BranchAddress
			$this->BranchAddress->EditAttrs["class"] = "form-control";
			$this->BranchAddress->EditCustomAttributes = "";
			if (!$this->BranchAddress->Raw)
				$this->BranchAddress->CurrentValue = HtmlDecode($this->BranchAddress->CurrentValue);
			$this->BranchAddress->EditValue = HtmlEncode($this->BranchAddress->CurrentValue);
			$this->BranchAddress->PlaceHolder = RemoveHtml($this->BranchAddress->caption());

			// BranchTel
			$this->BranchTel->EditAttrs["class"] = "form-control";
			$this->BranchTel->EditCustomAttributes = "";
			if (!$this->BranchTel->Raw)
				$this->BranchTel->CurrentValue = HtmlDecode($this->BranchTel->CurrentValue);
			$this->BranchTel->EditValue = HtmlEncode($this->BranchTel->CurrentValue);
			$this->BranchTel->PlaceHolder = RemoveHtml($this->BranchTel->caption());

			// BranchEmail
			$this->BranchEmail->EditAttrs["class"] = "form-control";
			$this->BranchEmail->EditCustomAttributes = "";
			if (!$this->BranchEmail->Raw)
				$this->BranchEmail->CurrentValue = HtmlDecode($this->BranchEmail->CurrentValue);
			$this->BranchEmail->EditValue = HtmlEncode($this->BranchEmail->CurrentValue);
			$this->BranchEmail->PlaceHolder = RemoveHtml($this->BranchEmail->caption());

			// BranchFax
			$this->BranchFax->EditAttrs["class"] = "form-control";
			$this->BranchFax->EditCustomAttributes = "";
			if (!$this->BranchFax->Raw)
				$this->BranchFax->CurrentValue = HtmlDecode($this->BranchFax->CurrentValue);
			$this->BranchFax->EditValue = HtmlEncode($this->BranchFax->CurrentValue);
			$this->BranchFax->PlaceHolder = RemoveHtml($this->BranchFax->caption());

			// SWIFT
			$this->SWIFT->EditAttrs["class"] = "form-control";
			$this->SWIFT->EditCustomAttributes = "";
			if (!$this->SWIFT->Raw)
				$this->SWIFT->CurrentValue = HtmlDecode($this->SWIFT->CurrentValue);
			$this->SWIFT->EditValue = HtmlEncode($this->SWIFT->CurrentValue);
			$this->SWIFT->PlaceHolder = RemoveHtml($this->SWIFT->caption());

			// IBAN
			$this->IBAN->EditAttrs["class"] = "form-control";
			$this->IBAN->EditCustomAttributes = "";
			if (!$this->IBAN->Raw)
				$this->IBAN->CurrentValue = HtmlDecode($this->IBAN->CurrentValue);
			$this->IBAN->EditValue = HtmlEncode($this->IBAN->CurrentValue);
			$this->IBAN->PlaceHolder = RemoveHtml($this->IBAN->caption());

			// Edit refer script
			// BranchCode

			$this->BranchCode->LinkCustomAttributes = "";
			$this->BranchCode->HrefValue = "";

			// BranchName
			$this->BranchName->LinkCustomAttributes = "";
			$this->BranchName->HrefValue = "";

			// BankCode
			$this->BankCode->LinkCustomAttributes = "";
			$this->BankCode->HrefValue = "";

			// AreaCode
			$this->AreaCode->LinkCustomAttributes = "";
			$this->AreaCode->HrefValue = "";

			// BranchNo
			$this->BranchNo->LinkCustomAttributes = "";
			$this->BranchNo->HrefValue = "";

			// BranchAddress
			$this->BranchAddress->LinkCustomAttributes = "";
			$this->BranchAddress->HrefValue = "";

			// BranchTel
			$this->BranchTel->LinkCustomAttributes = "";
			$this->BranchTel->HrefValue = "";

			// BranchEmail
			$this->BranchEmail->LinkCustomAttributes = "";
			$this->BranchEmail->HrefValue = "";

			// BranchFax
			$this->BranchFax->LinkCustomAttributes = "";
			$this->BranchFax->HrefValue = "";

			// SWIFT
			$this->SWIFT->LinkCustomAttributes = "";
			$this->SWIFT->HrefValue = "";

			// IBAN
			$this->IBAN->LinkCustomAttributes = "";
			$this->IBAN->HrefValue = "";
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
		if ($this->BranchCode->Required) {
			if (!$this->BranchCode->IsDetailKey && $this->BranchCode->FormValue != NULL && $this->BranchCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchCode->caption(), $this->BranchCode->RequiredErrorMessage));
			}
		}
		if ($this->BranchName->Required) {
			if (!$this->BranchName->IsDetailKey && $this->BranchName->FormValue != NULL && $this->BranchName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchName->caption(), $this->BranchName->RequiredErrorMessage));
			}
		}
		if ($this->BankCode->Required) {
			if (!$this->BankCode->IsDetailKey && $this->BankCode->FormValue != NULL && $this->BankCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BankCode->caption(), $this->BankCode->RequiredErrorMessage));
			}
		}
		if ($this->AreaCode->Required) {
			if (!$this->AreaCode->IsDetailKey && $this->AreaCode->FormValue != NULL && $this->AreaCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AreaCode->caption(), $this->AreaCode->RequiredErrorMessage));
			}
		}
		if ($this->BranchNo->Required) {
			if (!$this->BranchNo->IsDetailKey && $this->BranchNo->FormValue != NULL && $this->BranchNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchNo->caption(), $this->BranchNo->RequiredErrorMessage));
			}
		}
		if ($this->BranchAddress->Required) {
			if (!$this->BranchAddress->IsDetailKey && $this->BranchAddress->FormValue != NULL && $this->BranchAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchAddress->caption(), $this->BranchAddress->RequiredErrorMessage));
			}
		}
		if ($this->BranchTel->Required) {
			if (!$this->BranchTel->IsDetailKey && $this->BranchTel->FormValue != NULL && $this->BranchTel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchTel->caption(), $this->BranchTel->RequiredErrorMessage));
			}
		}
		if ($this->BranchEmail->Required) {
			if (!$this->BranchEmail->IsDetailKey && $this->BranchEmail->FormValue != NULL && $this->BranchEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchEmail->caption(), $this->BranchEmail->RequiredErrorMessage));
			}
		}
		if ($this->BranchFax->Required) {
			if (!$this->BranchFax->IsDetailKey && $this->BranchFax->FormValue != NULL && $this->BranchFax->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BranchFax->caption(), $this->BranchFax->RequiredErrorMessage));
			}
		}
		if ($this->SWIFT->Required) {
			if (!$this->SWIFT->IsDetailKey && $this->SWIFT->FormValue != NULL && $this->SWIFT->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SWIFT->caption(), $this->SWIFT->RequiredErrorMessage));
			}
		}
		if ($this->IBAN->Required) {
			if (!$this->IBAN->IsDetailKey && $this->IBAN->FormValue != NULL && $this->IBAN->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IBAN->caption(), $this->IBAN->RequiredErrorMessage));
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

			// BranchCode
			$this->BranchCode->setDbValueDef($rsnew, $this->BranchCode->CurrentValue, "", $this->BranchCode->ReadOnly);

			// BranchName
			$this->BranchName->setDbValueDef($rsnew, $this->BranchName->CurrentValue, "", $this->BranchName->ReadOnly);

			// BankCode
			$this->BankCode->setDbValueDef($rsnew, $this->BankCode->CurrentValue, "", $this->BankCode->ReadOnly);

			// AreaCode
			$this->AreaCode->setDbValueDef($rsnew, $this->AreaCode->CurrentValue, "", $this->AreaCode->ReadOnly);

			// BranchNo
			$this->BranchNo->setDbValueDef($rsnew, $this->BranchNo->CurrentValue, "", $this->BranchNo->ReadOnly);

			// BranchAddress
			$this->BranchAddress->setDbValueDef($rsnew, $this->BranchAddress->CurrentValue, NULL, $this->BranchAddress->ReadOnly);

			// BranchTel
			$this->BranchTel->setDbValueDef($rsnew, $this->BranchTel->CurrentValue, NULL, $this->BranchTel->ReadOnly);

			// BranchEmail
			$this->BranchEmail->setDbValueDef($rsnew, $this->BranchEmail->CurrentValue, NULL, $this->BranchEmail->ReadOnly);

			// BranchFax
			$this->BranchFax->setDbValueDef($rsnew, $this->BranchFax->CurrentValue, NULL, $this->BranchFax->ReadOnly);

			// SWIFT
			$this->SWIFT->setDbValueDef($rsnew, $this->SWIFT->CurrentValue, NULL, $this->SWIFT->ReadOnly);

			// IBAN
			$this->IBAN->setDbValueDef($rsnew, $this->IBAN->CurrentValue, NULL, $this->IBAN->ReadOnly);

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
			if ($masterTblVar == "bank") {
				$validMaster = TRUE;
				if (($parm = Get("fk_BankCode", Get("BankCode"))) !== NULL) {
					$GLOBALS["bank"]->BankCode->setQueryStringValue($parm);
					$this->BankCode->setQueryStringValue($GLOBALS["bank"]->BankCode->QueryStringValue);
					$this->BankCode->setSessionValue($this->BankCode->QueryStringValue);
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
			if ($masterTblVar == "bank") {
				$validMaster = TRUE;
				if (($parm = Post("fk_BankCode", Post("BankCode"))) !== NULL) {
					$GLOBALS["bank"]->BankCode->setFormValue($parm);
					$this->BankCode->setFormValue($GLOBALS["bank"]->BankCode->FormValue);
					$this->BankCode->setSessionValue($this->BankCode->FormValue);
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
			if ($masterTblVar != "bank") {
				if ($this->BankCode->CurrentValue == "")
					$this->BankCode->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("bank_branchlist.php"), "", $this->TableVar, TRUE);
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