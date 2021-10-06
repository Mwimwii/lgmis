<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class income_type_edit extends income_type
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'income_type';

	// Page object name
	public $PageObjName = "income_type_edit";

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

		// Table object (income_type)
		if (!isset($GLOBALS["income_type"]) || get_class($GLOBALS["income_type"]) == PROJECT_NAMESPACE . "income_type") {
			$GLOBALS["income_type"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["income_type"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'income_type');

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
		global $income_type;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($income_type);
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
					if ($pageName == "income_typeview.php")
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
			$key .= @$ar['IncomeCode'];
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
			$this->IncomeCode->Visible = FALSE;
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
					$this->terminate(GetUrl("income_typelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->IncomeCode->setVisibility();
		$this->IncomeName->setVisibility();
		$this->IncomeDescription->setVisibility();
		$this->Division->setVisibility();
		$this->IncomeAmount->setVisibility();
		$this->IncomeBasicRate->setVisibility();
		$this->BaseIncomeCode->setVisibility();
		$this->Taxable->setVisibility();
		$this->AccountNo->setVisibility();
		$this->JobIncluded->setVisibility();
		$this->Application->setVisibility();
		$this->JobExcluded->setVisibility();
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
		$this->setupLookupOptions($this->Division);
		$this->setupLookupOptions($this->BaseIncomeCode);
		$this->setupLookupOptions($this->Taxable);
		$this->setupLookupOptions($this->AccountNo);
		$this->setupLookupOptions($this->JobIncluded);
		$this->setupLookupOptions($this->Application);
		$this->setupLookupOptions($this->JobExcluded);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("income_typelist.php");
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
			if (Get("IncomeCode") !== NULL) {
				$this->IncomeCode->setQueryStringValue(Get("IncomeCode"));
				$this->IncomeCode->setOldValue($this->IncomeCode->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->IncomeCode->setQueryStringValue(Key(0));
				$this->IncomeCode->setOldValue($this->IncomeCode->QueryStringValue);
			} elseif (Post("IncomeCode") !== NULL) {
				$this->IncomeCode->setFormValue(Post("IncomeCode"));
				$this->IncomeCode->setOldValue($this->IncomeCode->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->IncomeCode->setQueryStringValue(Route(2));
				$this->IncomeCode->setOldValue($this->IncomeCode->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_IncomeCode")) {
					$this->IncomeCode->setFormValue($CurrentForm->getValue("x_IncomeCode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("IncomeCode") !== NULL) {
					$this->IncomeCode->setQueryStringValue(Get("IncomeCode"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->IncomeCode->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->IncomeCode->CurrentValue = NULL;
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
				$this->terminate("income_typelist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->IncomeCode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->IncomeCode->CurrentValue, $rs->fields('IncomeCode'))) {
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
					$this->terminate("income_typelist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "income_typelist.php")
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

		// Check field name 'IncomeCode' first before field var 'x_IncomeCode'
		$val = $CurrentForm->hasValue("IncomeCode") ? $CurrentForm->getValue("IncomeCode") : $CurrentForm->getValue("x_IncomeCode");
		if (!$this->IncomeCode->IsDetailKey)
			$this->IncomeCode->setFormValue($val);

		// Check field name 'IncomeName' first before field var 'x_IncomeName'
		$val = $CurrentForm->hasValue("IncomeName") ? $CurrentForm->getValue("IncomeName") : $CurrentForm->getValue("x_IncomeName");
		if (!$this->IncomeName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeName->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeName->setFormValue($val);
		}

		// Check field name 'IncomeDescription' first before field var 'x_IncomeDescription'
		$val = $CurrentForm->hasValue("IncomeDescription") ? $CurrentForm->getValue("IncomeDescription") : $CurrentForm->getValue("x_IncomeDescription");
		if (!$this->IncomeDescription->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeDescription->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeDescription->setFormValue($val);
		}

		// Check field name 'Division' first before field var 'x_Division'
		$val = $CurrentForm->hasValue("Division") ? $CurrentForm->getValue("Division") : $CurrentForm->getValue("x_Division");
		if (!$this->Division->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Division->Visible = FALSE; // Disable update for API request
			else
				$this->Division->setFormValue($val);
		}

		// Check field name 'IncomeAmount' first before field var 'x_IncomeAmount'
		$val = $CurrentForm->hasValue("IncomeAmount") ? $CurrentForm->getValue("IncomeAmount") : $CurrentForm->getValue("x_IncomeAmount");
		if (!$this->IncomeAmount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeAmount->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeAmount->setFormValue($val);
		}

		// Check field name 'IncomeBasicRate' first before field var 'x_IncomeBasicRate'
		$val = $CurrentForm->hasValue("IncomeBasicRate") ? $CurrentForm->getValue("IncomeBasicRate") : $CurrentForm->getValue("x_IncomeBasicRate");
		if (!$this->IncomeBasicRate->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->IncomeBasicRate->Visible = FALSE; // Disable update for API request
			else
				$this->IncomeBasicRate->setFormValue($val);
		}

		// Check field name 'BaseIncomeCode' first before field var 'x_BaseIncomeCode'
		$val = $CurrentForm->hasValue("BaseIncomeCode") ? $CurrentForm->getValue("BaseIncomeCode") : $CurrentForm->getValue("x_BaseIncomeCode");
		if (!$this->BaseIncomeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BaseIncomeCode->Visible = FALSE; // Disable update for API request
			else
				$this->BaseIncomeCode->setFormValue($val);
		}

		// Check field name 'Taxable' first before field var 'x_Taxable'
		$val = $CurrentForm->hasValue("Taxable") ? $CurrentForm->getValue("Taxable") : $CurrentForm->getValue("x_Taxable");
		if (!$this->Taxable->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Taxable->Visible = FALSE; // Disable update for API request
			else
				$this->Taxable->setFormValue($val);
		}

		// Check field name 'AccountNo' first before field var 'x_AccountNo'
		$val = $CurrentForm->hasValue("AccountNo") ? $CurrentForm->getValue("AccountNo") : $CurrentForm->getValue("x_AccountNo");
		if (!$this->AccountNo->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AccountNo->Visible = FALSE; // Disable update for API request
			else
				$this->AccountNo->setFormValue($val);
		}

		// Check field name 'JobIncluded' first before field var 'x_JobIncluded'
		$val = $CurrentForm->hasValue("JobIncluded") ? $CurrentForm->getValue("JobIncluded") : $CurrentForm->getValue("x_JobIncluded");
		if (!$this->JobIncluded->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobIncluded->Visible = FALSE; // Disable update for API request
			else
				$this->JobIncluded->setFormValue($val);
		}

		// Check field name 'Application' first before field var 'x_Application'
		$val = $CurrentForm->hasValue("Application") ? $CurrentForm->getValue("Application") : $CurrentForm->getValue("x_Application");
		if (!$this->Application->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Application->Visible = FALSE; // Disable update for API request
			else
				$this->Application->setFormValue($val);
		}

		// Check field name 'JobExcluded' first before field var 'x_JobExcluded'
		$val = $CurrentForm->hasValue("JobExcluded") ? $CurrentForm->getValue("JobExcluded") : $CurrentForm->getValue("x_JobExcluded");
		if (!$this->JobExcluded->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->JobExcluded->Visible = FALSE; // Disable update for API request
			else
				$this->JobExcluded->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->IncomeCode->CurrentValue = $this->IncomeCode->FormValue;
		$this->IncomeName->CurrentValue = $this->IncomeName->FormValue;
		$this->IncomeDescription->CurrentValue = $this->IncomeDescription->FormValue;
		$this->Division->CurrentValue = $this->Division->FormValue;
		$this->IncomeAmount->CurrentValue = $this->IncomeAmount->FormValue;
		$this->IncomeBasicRate->CurrentValue = $this->IncomeBasicRate->FormValue;
		$this->BaseIncomeCode->CurrentValue = $this->BaseIncomeCode->FormValue;
		$this->Taxable->CurrentValue = $this->Taxable->FormValue;
		$this->AccountNo->CurrentValue = $this->AccountNo->FormValue;
		$this->JobIncluded->CurrentValue = $this->JobIncluded->FormValue;
		$this->Application->CurrentValue = $this->Application->FormValue;
		$this->JobExcluded->CurrentValue = $this->JobExcluded->FormValue;
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
		$this->IncomeCode->setDbValue($row['IncomeCode']);
		$this->IncomeName->setDbValue($row['IncomeName']);
		$this->IncomeDescription->setDbValue($row['IncomeDescription']);
		$this->Division->setDbValue($row['Division']);
		$this->IncomeAmount->setDbValue($row['IncomeAmount']);
		$this->IncomeBasicRate->setDbValue($row['IncomeBasicRate']);
		$this->BaseIncomeCode->setDbValue($row['BaseIncomeCode']);
		$this->Taxable->setDbValue($row['Taxable']);
		$this->AccountNo->setDbValue($row['AccountNo']);
		$this->JobIncluded->setDbValue($row['JobIncluded']);
		$this->Application->setDbValue($row['Application']);
		$this->JobExcluded->setDbValue($row['JobExcluded']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['IncomeCode'] = NULL;
		$row['IncomeName'] = NULL;
		$row['IncomeDescription'] = NULL;
		$row['Division'] = NULL;
		$row['IncomeAmount'] = NULL;
		$row['IncomeBasicRate'] = NULL;
		$row['BaseIncomeCode'] = NULL;
		$row['Taxable'] = NULL;
		$row['AccountNo'] = NULL;
		$row['JobIncluded'] = NULL;
		$row['Application'] = NULL;
		$row['JobExcluded'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("IncomeCode")) != "")
			$this->IncomeCode->OldValue = $this->getKey("IncomeCode"); // IncomeCode
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
		// Convert decimal values if posted back

		if ($this->IncomeAmount->FormValue == $this->IncomeAmount->CurrentValue && is_numeric(ConvertToFloatString($this->IncomeAmount->CurrentValue)))
			$this->IncomeAmount->CurrentValue = ConvertToFloatString($this->IncomeAmount->CurrentValue);

		// Convert decimal values if posted back
		if ($this->IncomeBasicRate->FormValue == $this->IncomeBasicRate->CurrentValue && is_numeric(ConvertToFloatString($this->IncomeBasicRate->CurrentValue)))
			$this->IncomeBasicRate->CurrentValue = ConvertToFloatString($this->IncomeBasicRate->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// IncomeCode
		// IncomeName
		// IncomeDescription
		// Division
		// IncomeAmount
		// IncomeBasicRate
		// BaseIncomeCode
		// Taxable
		// AccountNo
		// JobIncluded
		// Application
		// JobExcluded

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// IncomeCode
			$this->IncomeCode->ViewValue = $this->IncomeCode->CurrentValue;
			$this->IncomeCode->ViewCustomAttributes = "";

			// IncomeName
			$this->IncomeName->ViewValue = $this->IncomeName->CurrentValue;
			$this->IncomeName->ViewCustomAttributes = "";

			// IncomeDescription
			$this->IncomeDescription->ViewValue = $this->IncomeDescription->CurrentValue;
			$this->IncomeDescription->ViewCustomAttributes = "";

			// Division
			$curVal = strval($this->Division->CurrentValue);
			if ($curVal != "") {
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
				if ($this->Division->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->Division->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->Division->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->Division->ViewValue->add($this->Division->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->Division->ViewValue = $this->Division->CurrentValue;
					}
				}
			} else {
				$this->Division->ViewValue = NULL;
			}
			$this->Division->ViewCustomAttributes = "";

			// IncomeAmount
			$this->IncomeAmount->ViewValue = $this->IncomeAmount->CurrentValue;
			$this->IncomeAmount->ViewValue = FormatNumber($this->IncomeAmount->ViewValue, 2, -2, -2, -2);
			$this->IncomeAmount->ViewCustomAttributes = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->ViewValue = $this->IncomeBasicRate->CurrentValue;
			$this->IncomeBasicRate->ViewValue = FormatNumber($this->IncomeBasicRate->ViewValue, 2, -2, -2, -2);
			$this->IncomeBasicRate->ViewCustomAttributes = "";

			// BaseIncomeCode
			$curVal = strval($this->BaseIncomeCode->CurrentValue);
			if ($curVal != "") {
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
				if ($this->BaseIncomeCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`IncomeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->CurrentValue;
					}
				}
			} else {
				$this->BaseIncomeCode->ViewValue = NULL;
			}
			$this->BaseIncomeCode->ViewCustomAttributes = "";

			// Taxable
			$curVal = strval($this->Taxable->CurrentValue);
			if ($curVal != "") {
				$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
				if ($this->Taxable->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Taxable->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Taxable->ViewValue = $this->Taxable->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Taxable->ViewValue = $this->Taxable->CurrentValue;
					}
				}
			} else {
				$this->Taxable->ViewValue = NULL;
			}
			$this->Taxable->ViewCustomAttributes = "";

			// AccountNo
			$curVal = strval($this->AccountNo->CurrentValue);
			if ($curVal != "") {
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
				if ($this->AccountNo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AccountNo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AccountNo->ViewValue = $this->AccountNo->CurrentValue;
					}
				}
			} else {
				$this->AccountNo->ViewValue = NULL;
			}
			$this->AccountNo->ViewCustomAttributes = "";

			// JobIncluded
			$curVal = strval($this->JobIncluded->CurrentValue);
			if ($curVal != "") {
				$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
				if ($this->JobIncluded->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobIncluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobIncluded->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobIncluded->ViewValue = $this->JobIncluded->CurrentValue;
					}
				}
			} else {
				$this->JobIncluded->ViewValue = NULL;
			}
			$this->JobIncluded->ViewCustomAttributes = "";

			// Application
			$curVal = strval($this->Application->CurrentValue);
			if ($curVal != "") {
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
				if ($this->Application->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Application->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Application->ViewValue = $this->Application->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Application->ViewValue = $this->Application->CurrentValue;
					}
				}
			} else {
				$this->Application->ViewValue = NULL;
			}
			$this->Application->ViewCustomAttributes = "";

			// JobExcluded
			$curVal = strval($this->JobExcluded->CurrentValue);
			if ($curVal != "") {
				$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
				if ($this->JobExcluded->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->JobExcluded->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->JobExcluded->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->JobExcluded->ViewValue = $this->JobExcluded->CurrentValue;
					}
				}
			} else {
				$this->JobExcluded->ViewValue = NULL;
			}
			$this->JobExcluded->ViewCustomAttributes = "";

			// IncomeCode
			$this->IncomeCode->LinkCustomAttributes = "";
			$this->IncomeCode->HrefValue = "";
			$this->IncomeCode->TooltipValue = "";

			// IncomeName
			$this->IncomeName->LinkCustomAttributes = "";
			$this->IncomeName->HrefValue = "";
			$this->IncomeName->TooltipValue = "";

			// IncomeDescription
			$this->IncomeDescription->LinkCustomAttributes = "";
			$this->IncomeDescription->HrefValue = "";
			$this->IncomeDescription->TooltipValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";
			$this->Division->TooltipValue = "";

			// IncomeAmount
			$this->IncomeAmount->LinkCustomAttributes = "";
			$this->IncomeAmount->HrefValue = "";
			$this->IncomeAmount->TooltipValue = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->LinkCustomAttributes = "";
			$this->IncomeBasicRate->HrefValue = "";
			$this->IncomeBasicRate->TooltipValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";
			$this->BaseIncomeCode->TooltipValue = "";

			// Taxable
			$this->Taxable->LinkCustomAttributes = "";
			$this->Taxable->HrefValue = "";
			$this->Taxable->TooltipValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";
			$this->AccountNo->TooltipValue = "";

			// JobIncluded
			$this->JobIncluded->LinkCustomAttributes = "";
			$this->JobIncluded->HrefValue = "";
			$this->JobIncluded->TooltipValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";
			$this->Application->TooltipValue = "";

			// JobExcluded
			$this->JobExcluded->LinkCustomAttributes = "";
			$this->JobExcluded->HrefValue = "";
			$this->JobExcluded->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// IncomeCode
			$this->IncomeCode->EditAttrs["class"] = "form-control";
			$this->IncomeCode->EditCustomAttributes = "";
			$this->IncomeCode->EditValue = $this->IncomeCode->CurrentValue;
			$this->IncomeCode->ViewCustomAttributes = "";

			// IncomeName
			$this->IncomeName->EditAttrs["class"] = "form-control";
			$this->IncomeName->EditCustomAttributes = "";
			if (!$this->IncomeName->Raw)
				$this->IncomeName->CurrentValue = HtmlDecode($this->IncomeName->CurrentValue);
			$this->IncomeName->EditValue = HtmlEncode($this->IncomeName->CurrentValue);
			$this->IncomeName->PlaceHolder = RemoveHtml($this->IncomeName->caption());

			// IncomeDescription
			$this->IncomeDescription->EditAttrs["class"] = "form-control";
			$this->IncomeDescription->EditCustomAttributes = "";
			if (!$this->IncomeDescription->Raw)
				$this->IncomeDescription->CurrentValue = HtmlDecode($this->IncomeDescription->CurrentValue);
			$this->IncomeDescription->EditValue = HtmlEncode($this->IncomeDescription->CurrentValue);
			$this->IncomeDescription->PlaceHolder = RemoveHtml($this->IncomeDescription->caption());

			// Division
			$this->Division->EditCustomAttributes = "";
			$curVal = trim(strval($this->Division->CurrentValue));
			if ($curVal != "")
				$this->Division->ViewValue = $this->Division->lookupCacheOption($curVal);
			else
				$this->Division->ViewValue = $this->Division->Lookup !== NULL && is_array($this->Division->Lookup->Options) ? $curVal : NULL;
			if ($this->Division->ViewValue !== NULL) { // Load from cache
				$this->Division->EditValue = array_values($this->Division->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`Division`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->Division->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Division->EditValue = $arwrk;
			}

			// IncomeAmount
			$this->IncomeAmount->EditAttrs["class"] = "form-control";
			$this->IncomeAmount->EditCustomAttributes = "";
			$this->IncomeAmount->EditValue = HtmlEncode($this->IncomeAmount->CurrentValue);
			$this->IncomeAmount->PlaceHolder = RemoveHtml($this->IncomeAmount->caption());
			if (strval($this->IncomeAmount->EditValue) != "" && is_numeric($this->IncomeAmount->EditValue))
				$this->IncomeAmount->EditValue = FormatNumber($this->IncomeAmount->EditValue, -2, -2, -2, -2);
			

			// IncomeBasicRate
			$this->IncomeBasicRate->EditAttrs["class"] = "form-control";
			$this->IncomeBasicRate->EditCustomAttributes = "";
			$this->IncomeBasicRate->EditValue = HtmlEncode($this->IncomeBasicRate->CurrentValue);
			$this->IncomeBasicRate->PlaceHolder = RemoveHtml($this->IncomeBasicRate->caption());
			if (strval($this->IncomeBasicRate->EditValue) != "" && is_numeric($this->IncomeBasicRate->EditValue))
				$this->IncomeBasicRate->EditValue = FormatNumber($this->IncomeBasicRate->EditValue, -2, -2, -2, -2);
			

			// BaseIncomeCode
			$this->BaseIncomeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->BaseIncomeCode->CurrentValue));
			if ($curVal != "")
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->lookupCacheOption($curVal);
			else
				$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->Lookup !== NULL && is_array($this->BaseIncomeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->BaseIncomeCode->ViewValue !== NULL) { // Load from cache
				$this->BaseIncomeCode->EditValue = array_values($this->BaseIncomeCode->Lookup->Options);
				if ($this->BaseIncomeCode->ViewValue == "")
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`IncomeCode`" . SearchString("=", $this->BaseIncomeCode->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->BaseIncomeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->BaseIncomeCode->ViewValue = $this->BaseIncomeCode->displayValue($arwrk);
				} else {
					$this->BaseIncomeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->BaseIncomeCode->EditValue = $arwrk;
			}

			// Taxable
			$this->Taxable->EditAttrs["class"] = "form-control";
			$this->Taxable->EditCustomAttributes = "";
			$curVal = trim(strval($this->Taxable->CurrentValue));
			if ($curVal != "")
				$this->Taxable->ViewValue = $this->Taxable->lookupCacheOption($curVal);
			else
				$this->Taxable->ViewValue = $this->Taxable->Lookup !== NULL && is_array($this->Taxable->Lookup->Options) ? $curVal : NULL;
			if ($this->Taxable->ViewValue !== NULL) { // Load from cache
				$this->Taxable->EditValue = array_values($this->Taxable->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Taxable->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Taxable->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Taxable->EditValue = $arwrk;
			}

			// AccountNo
			$this->AccountNo->EditCustomAttributes = "";
			$curVal = trim(strval($this->AccountNo->CurrentValue));
			if ($curVal != "")
				$this->AccountNo->ViewValue = $this->AccountNo->lookupCacheOption($curVal);
			else
				$this->AccountNo->ViewValue = $this->AccountNo->Lookup !== NULL && is_array($this->AccountNo->Lookup->Options) ? $curVal : NULL;
			if ($this->AccountNo->ViewValue !== NULL) { // Load from cache
				$this->AccountNo->EditValue = array_values($this->AccountNo->Lookup->Options);
				if ($this->AccountNo->ViewValue == "")
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->AccountNo->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->AccountNo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->AccountNo->ViewValue = $this->AccountNo->displayValue($arwrk);
				} else {
					$this->AccountNo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->AccountNo->EditValue = $arwrk;
			}

			// JobIncluded
			$this->JobIncluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobIncluded->CurrentValue));
			if ($curVal != "")
				$this->JobIncluded->ViewValue = $this->JobIncluded->lookupCacheOption($curVal);
			else
				$this->JobIncluded->ViewValue = $this->JobIncluded->Lookup !== NULL && is_array($this->JobIncluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobIncluded->ViewValue !== NULL) { // Load from cache
				$this->JobIncluded->EditValue = array_values($this->JobIncluded->Lookup->Options);
				if ($this->JobIncluded->ViewValue == "")
					$this->JobIncluded->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobIncluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobIncluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobIncluded->ViewValue->add($this->JobIncluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobIncluded->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobIncluded->EditValue = $arwrk;
			}

			// Application
			$this->Application->EditAttrs["class"] = "form-control";
			$this->Application->EditCustomAttributes = "";
			$curVal = trim(strval($this->Application->CurrentValue));
			if ($curVal != "")
				$this->Application->ViewValue = $this->Application->lookupCacheOption($curVal);
			else
				$this->Application->ViewValue = $this->Application->Lookup !== NULL && is_array($this->Application->Lookup->Options) ? $curVal : NULL;
			if ($this->Application->ViewValue !== NULL) { // Load from cache
				$this->Application->EditValue = array_values($this->Application->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Application->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Application->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Application->EditValue = $arwrk;
			}

			// JobExcluded
			$this->JobExcluded->EditCustomAttributes = "";
			$curVal = trim(strval($this->JobExcluded->CurrentValue));
			if ($curVal != "")
				$this->JobExcluded->ViewValue = $this->JobExcluded->lookupCacheOption($curVal);
			else
				$this->JobExcluded->ViewValue = $this->JobExcluded->Lookup !== NULL && is_array($this->JobExcluded->Lookup->Options) ? $curVal : NULL;
			if ($this->JobExcluded->ViewValue !== NULL) { // Load from cache
				$this->JobExcluded->EditValue = array_values($this->JobExcluded->Lookup->Options);
				if ($this->JobExcluded->ViewValue == "")
					$this->JobExcluded->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`JobCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->JobExcluded->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->JobExcluded->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->JobExcluded->ViewValue->add($this->JobExcluded->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->JobExcluded->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->JobExcluded->EditValue = $arwrk;
			}

			// Edit refer script
			// IncomeCode

			$this->IncomeCode->LinkCustomAttributes = "";
			$this->IncomeCode->HrefValue = "";

			// IncomeName
			$this->IncomeName->LinkCustomAttributes = "";
			$this->IncomeName->HrefValue = "";

			// IncomeDescription
			$this->IncomeDescription->LinkCustomAttributes = "";
			$this->IncomeDescription->HrefValue = "";

			// Division
			$this->Division->LinkCustomAttributes = "";
			$this->Division->HrefValue = "";

			// IncomeAmount
			$this->IncomeAmount->LinkCustomAttributes = "";
			$this->IncomeAmount->HrefValue = "";

			// IncomeBasicRate
			$this->IncomeBasicRate->LinkCustomAttributes = "";
			$this->IncomeBasicRate->HrefValue = "";

			// BaseIncomeCode
			$this->BaseIncomeCode->LinkCustomAttributes = "";
			$this->BaseIncomeCode->HrefValue = "";

			// Taxable
			$this->Taxable->LinkCustomAttributes = "";
			$this->Taxable->HrefValue = "";

			// AccountNo
			$this->AccountNo->LinkCustomAttributes = "";
			$this->AccountNo->HrefValue = "";

			// JobIncluded
			$this->JobIncluded->LinkCustomAttributes = "";
			$this->JobIncluded->HrefValue = "";

			// Application
			$this->Application->LinkCustomAttributes = "";
			$this->Application->HrefValue = "";

			// JobExcluded
			$this->JobExcluded->LinkCustomAttributes = "";
			$this->JobExcluded->HrefValue = "";
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
		if ($this->IncomeCode->Required) {
			if (!$this->IncomeCode->IsDetailKey && $this->IncomeCode->FormValue != NULL && $this->IncomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeCode->caption(), $this->IncomeCode->RequiredErrorMessage));
			}
		}
		if ($this->IncomeName->Required) {
			if (!$this->IncomeName->IsDetailKey && $this->IncomeName->FormValue != NULL && $this->IncomeName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeName->caption(), $this->IncomeName->RequiredErrorMessage));
			}
		}
		if ($this->IncomeDescription->Required) {
			if (!$this->IncomeDescription->IsDetailKey && $this->IncomeDescription->FormValue != NULL && $this->IncomeDescription->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeDescription->caption(), $this->IncomeDescription->RequiredErrorMessage));
			}
		}
		if ($this->Division->Required) {
			if ($this->Division->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Division->caption(), $this->Division->RequiredErrorMessage));
			}
		}
		if ($this->IncomeAmount->Required) {
			if (!$this->IncomeAmount->IsDetailKey && $this->IncomeAmount->FormValue != NULL && $this->IncomeAmount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeAmount->caption(), $this->IncomeAmount->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->IncomeAmount->FormValue)) {
			AddMessage($FormError, $this->IncomeAmount->errorMessage());
		}
		if ($this->IncomeBasicRate->Required) {
			if (!$this->IncomeBasicRate->IsDetailKey && $this->IncomeBasicRate->FormValue != NULL && $this->IncomeBasicRate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IncomeBasicRate->caption(), $this->IncomeBasicRate->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->IncomeBasicRate->FormValue)) {
			AddMessage($FormError, $this->IncomeBasicRate->errorMessage());
		}
		if ($this->BaseIncomeCode->Required) {
			if (!$this->BaseIncomeCode->IsDetailKey && $this->BaseIncomeCode->FormValue != NULL && $this->BaseIncomeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BaseIncomeCode->caption(), $this->BaseIncomeCode->RequiredErrorMessage));
			}
		}
		if ($this->Taxable->Required) {
			if (!$this->Taxable->IsDetailKey && $this->Taxable->FormValue != NULL && $this->Taxable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Taxable->caption(), $this->Taxable->RequiredErrorMessage));
			}
		}
		if ($this->AccountNo->Required) {
			if (!$this->AccountNo->IsDetailKey && $this->AccountNo->FormValue != NULL && $this->AccountNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AccountNo->caption(), $this->AccountNo->RequiredErrorMessage));
			}
		}
		if ($this->JobIncluded->Required) {
			if ($this->JobIncluded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobIncluded->caption(), $this->JobIncluded->RequiredErrorMessage));
			}
		}
		if ($this->Application->Required) {
			if (!$this->Application->IsDetailKey && $this->Application->FormValue != NULL && $this->Application->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Application->caption(), $this->Application->RequiredErrorMessage));
			}
		}
		if ($this->JobExcluded->Required) {
			if ($this->JobExcluded->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JobExcluded->caption(), $this->JobExcluded->RequiredErrorMessage));
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

			// IncomeName
			$this->IncomeName->setDbValueDef($rsnew, $this->IncomeName->CurrentValue, "", $this->IncomeName->ReadOnly);

			// IncomeDescription
			$this->IncomeDescription->setDbValueDef($rsnew, $this->IncomeDescription->CurrentValue, NULL, $this->IncomeDescription->ReadOnly);

			// Division
			$this->Division->setDbValueDef($rsnew, $this->Division->CurrentValue, NULL, $this->Division->ReadOnly);

			// IncomeAmount
			$this->IncomeAmount->setDbValueDef($rsnew, $this->IncomeAmount->CurrentValue, NULL, $this->IncomeAmount->ReadOnly);

			// IncomeBasicRate
			$this->IncomeBasicRate->setDbValueDef($rsnew, $this->IncomeBasicRate->CurrentValue, NULL, $this->IncomeBasicRate->ReadOnly);

			// BaseIncomeCode
			$this->BaseIncomeCode->setDbValueDef($rsnew, $this->BaseIncomeCode->CurrentValue, NULL, $this->BaseIncomeCode->ReadOnly);

			// Taxable
			$this->Taxable->setDbValueDef($rsnew, $this->Taxable->CurrentValue, 0, $this->Taxable->ReadOnly);

			// AccountNo
			$this->AccountNo->setDbValueDef($rsnew, $this->AccountNo->CurrentValue, NULL, $this->AccountNo->ReadOnly);

			// JobIncluded
			$this->JobIncluded->setDbValueDef($rsnew, $this->JobIncluded->CurrentValue, NULL, $this->JobIncluded->ReadOnly);

			// Application
			$this->Application->setDbValueDef($rsnew, $this->Application->CurrentValue, NULL, $this->Application->ReadOnly);

			// JobExcluded
			$this->JobExcluded->setDbValueDef($rsnew, $this->JobExcluded->CurrentValue, NULL, $this->JobExcluded->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("income_typelist.php"), "", $this->TableVar, TRUE);
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
				case "x_Division":
					break;
				case "x_BaseIncomeCode":
					break;
				case "x_Taxable":
					break;
				case "x_AccountNo":
					break;
				case "x_JobIncluded":
					break;
				case "x_Application":
					break;
				case "x_JobExcluded":
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
						case "x_Division":
							break;
						case "x_BaseIncomeCode":
							break;
						case "x_Taxable":
							break;
						case "x_AccountNo":
							break;
						case "x_JobIncluded":
							break;
						case "x_Application":
							break;
						case "x_JobExcluded":
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