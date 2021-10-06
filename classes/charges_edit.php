<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class charges_edit extends charges
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'charges';

	// Page object name
	public $PageObjName = "charges_edit";

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

		// Table object (charges)
		if (!isset($GLOBALS["charges"]) || get_class($GLOBALS["charges"]) == PROJECT_NAMESPACE . "charges") {
			$GLOBALS["charges"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["charges"];
		}

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'charges');

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
		global $charges;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($charges);
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
					if ($pageName == "chargesview.php")
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
			$key .= @$ar['ChargeCode'];
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
			$this->ChargeCode->Visible = FALSE;
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
					$this->terminate(GetUrl("chargeslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ChargeCode->setVisibility();
		$this->ChargeDesc->setVisibility();
		$this->Fee->setVisibility();
		$this->ChargeType->setVisibility();
		$this->Frequency->setVisibility();
		$this->Installment->setVisibility();
		$this->DepartmentCode->setVisibility();
		$this->GLAccount->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->UnitOfMeasure->setVisibility();
		$this->Factor->setVisibility();
		$this->PeriodType->setVisibility();
		$this->ClearedChargeCode->setVisibility();
		$this->PropertyUse->setVisibility();
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
		$this->setupLookupOptions($this->ChargeType);
		$this->setupLookupOptions($this->Installment);
		$this->setupLookupOptions($this->DepartmentCode);
		$this->setupLookupOptions($this->GLAccount);
		$this->setupLookupOptions($this->ChargeGroup);
		$this->setupLookupOptions($this->UnitOfMeasure);
		$this->setupLookupOptions($this->PeriodType);
		$this->setupLookupOptions($this->ClearedChargeCode);
		$this->setupLookupOptions($this->PropertyUse);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("chargeslist.php");
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
			if (Get("ChargeCode") !== NULL) {
				$this->ChargeCode->setQueryStringValue(Get("ChargeCode"));
				$this->ChargeCode->setOldValue($this->ChargeCode->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->ChargeCode->setQueryStringValue(Key(0));
				$this->ChargeCode->setOldValue($this->ChargeCode->QueryStringValue);
			} elseif (Post("ChargeCode") !== NULL) {
				$this->ChargeCode->setFormValue(Post("ChargeCode"));
				$this->ChargeCode->setOldValue($this->ChargeCode->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->ChargeCode->setQueryStringValue(Route(2));
				$this->ChargeCode->setOldValue($this->ChargeCode->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_ChargeCode")) {
					$this->ChargeCode->setFormValue($CurrentForm->getValue("x_ChargeCode"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("ChargeCode") !== NULL) {
					$this->ChargeCode->setQueryStringValue(Get("ChargeCode"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->ChargeCode->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->ChargeCode->CurrentValue = NULL;
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
				$this->terminate("chargeslist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->ChargeCode->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->ChargeCode->CurrentValue, $rs->fields('ChargeCode'))) {
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
					$this->terminate("chargeslist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "chargeslist.php")
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

		// Check field name 'ChargeCode' first before field var 'x_ChargeCode'
		$val = $CurrentForm->hasValue("ChargeCode") ? $CurrentForm->getValue("ChargeCode") : $CurrentForm->getValue("x_ChargeCode");
		if (!$this->ChargeCode->IsDetailKey)
			$this->ChargeCode->setFormValue($val);

		// Check field name 'ChargeDesc' first before field var 'x_ChargeDesc'
		$val = $CurrentForm->hasValue("ChargeDesc") ? $CurrentForm->getValue("ChargeDesc") : $CurrentForm->getValue("x_ChargeDesc");
		if (!$this->ChargeDesc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeDesc->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeDesc->setFormValue($val);
		}

		// Check field name 'Fee' first before field var 'x_Fee'
		$val = $CurrentForm->hasValue("Fee") ? $CurrentForm->getValue("Fee") : $CurrentForm->getValue("x_Fee");
		if (!$this->Fee->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Fee->Visible = FALSE; // Disable update for API request
			else
				$this->Fee->setFormValue($val);
		}

		// Check field name 'ChargeType' first before field var 'x_ChargeType'
		$val = $CurrentForm->hasValue("ChargeType") ? $CurrentForm->getValue("ChargeType") : $CurrentForm->getValue("x_ChargeType");
		if (!$this->ChargeType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeType->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeType->setFormValue($val);
		}

		// Check field name 'Frequency' first before field var 'x_Frequency'
		$val = $CurrentForm->hasValue("Frequency") ? $CurrentForm->getValue("Frequency") : $CurrentForm->getValue("x_Frequency");
		if (!$this->Frequency->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Frequency->Visible = FALSE; // Disable update for API request
			else
				$this->Frequency->setFormValue($val);
		}

		// Check field name 'Installment' first before field var 'x_Installment'
		$val = $CurrentForm->hasValue("Installment") ? $CurrentForm->getValue("Installment") : $CurrentForm->getValue("x_Installment");
		if (!$this->Installment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Installment->Visible = FALSE; // Disable update for API request
			else
				$this->Installment->setFormValue($val);
		}

		// Check field name 'DepartmentCode' first before field var 'x_DepartmentCode'
		$val = $CurrentForm->hasValue("DepartmentCode") ? $CurrentForm->getValue("DepartmentCode") : $CurrentForm->getValue("x_DepartmentCode");
		if (!$this->DepartmentCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DepartmentCode->Visible = FALSE; // Disable update for API request
			else
				$this->DepartmentCode->setFormValue($val);
		}

		// Check field name 'GLAccount' first before field var 'x_GLAccount'
		$val = $CurrentForm->hasValue("GLAccount") ? $CurrentForm->getValue("GLAccount") : $CurrentForm->getValue("x_GLAccount");
		if (!$this->GLAccount->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->GLAccount->Visible = FALSE; // Disable update for API request
			else
				$this->GLAccount->setFormValue($val);
		}

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}

		// Check field name 'UnitOfMeasure' first before field var 'x_UnitOfMeasure'
		$val = $CurrentForm->hasValue("UnitOfMeasure") ? $CurrentForm->getValue("UnitOfMeasure") : $CurrentForm->getValue("x_UnitOfMeasure");
		if (!$this->UnitOfMeasure->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->UnitOfMeasure->Visible = FALSE; // Disable update for API request
			else
				$this->UnitOfMeasure->setFormValue($val);
		}

		// Check field name 'Factor' first before field var 'x_Factor'
		$val = $CurrentForm->hasValue("Factor") ? $CurrentForm->getValue("Factor") : $CurrentForm->getValue("x_Factor");
		if (!$this->Factor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Factor->Visible = FALSE; // Disable update for API request
			else
				$this->Factor->setFormValue($val);
		}

		// Check field name 'PeriodType' first before field var 'x_PeriodType'
		$val = $CurrentForm->hasValue("PeriodType") ? $CurrentForm->getValue("PeriodType") : $CurrentForm->getValue("x_PeriodType");
		if (!$this->PeriodType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PeriodType->Visible = FALSE; // Disable update for API request
			else
				$this->PeriodType->setFormValue($val);
		}

		// Check field name 'ClearedChargeCode' first before field var 'x_ClearedChargeCode'
		$val = $CurrentForm->hasValue("ClearedChargeCode") ? $CurrentForm->getValue("ClearedChargeCode") : $CurrentForm->getValue("x_ClearedChargeCode");
		if (!$this->ClearedChargeCode->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClearedChargeCode->Visible = FALSE; // Disable update for API request
			else
				$this->ClearedChargeCode->setFormValue($val);
		}

		// Check field name 'PropertyUse' first before field var 'x_PropertyUse'
		$val = $CurrentForm->hasValue("PropertyUse") ? $CurrentForm->getValue("PropertyUse") : $CurrentForm->getValue("x_PropertyUse");
		if (!$this->PropertyUse->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyUse->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyUse->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ChargeCode->CurrentValue = $this->ChargeCode->FormValue;
		$this->ChargeDesc->CurrentValue = $this->ChargeDesc->FormValue;
		$this->Fee->CurrentValue = $this->Fee->FormValue;
		$this->ChargeType->CurrentValue = $this->ChargeType->FormValue;
		$this->Frequency->CurrentValue = $this->Frequency->FormValue;
		$this->Installment->CurrentValue = $this->Installment->FormValue;
		$this->DepartmentCode->CurrentValue = $this->DepartmentCode->FormValue;
		$this->GLAccount->CurrentValue = $this->GLAccount->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->UnitOfMeasure->CurrentValue = $this->UnitOfMeasure->FormValue;
		$this->Factor->CurrentValue = $this->Factor->FormValue;
		$this->PeriodType->CurrentValue = $this->PeriodType->FormValue;
		$this->ClearedChargeCode->CurrentValue = $this->ClearedChargeCode->FormValue;
		$this->PropertyUse->CurrentValue = $this->PropertyUse->FormValue;
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
		$this->ChargeCode->setDbValue($row['ChargeCode']);
		$this->ChargeDesc->setDbValue($row['ChargeDesc']);
		$this->Fee->setDbValue($row['Fee']);
		$this->ChargeType->setDbValue($row['ChargeType']);
		$this->Frequency->setDbValue($row['Frequency']);
		$this->Installment->setDbValue($row['Installment']);
		$this->DepartmentCode->setDbValue($row['DepartmentCode']);
		$this->GLAccount->setDbValue($row['GLAccount']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->UnitOfMeasure->setDbValue($row['UnitOfMeasure']);
		$this->Factor->setDbValue($row['Factor']);
		$this->PeriodType->setDbValue($row['PeriodType']);
		$this->ClearedChargeCode->setDbValue($row['ClearedChargeCode']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ChargeCode'] = NULL;
		$row['ChargeDesc'] = NULL;
		$row['Fee'] = NULL;
		$row['ChargeType'] = NULL;
		$row['Frequency'] = NULL;
		$row['Installment'] = NULL;
		$row['DepartmentCode'] = NULL;
		$row['GLAccount'] = NULL;
		$row['ChargeGroup'] = NULL;
		$row['UnitOfMeasure'] = NULL;
		$row['Factor'] = NULL;
		$row['PeriodType'] = NULL;
		$row['ClearedChargeCode'] = NULL;
		$row['PropertyUse'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ChargeCode")) != "")
			$this->ChargeCode->OldValue = $this->getKey("ChargeCode"); // ChargeCode
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

		if ($this->Fee->FormValue == $this->Fee->CurrentValue && is_numeric(ConvertToFloatString($this->Fee->CurrentValue)))
			$this->Fee->CurrentValue = ConvertToFloatString($this->Fee->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Frequency->FormValue == $this->Frequency->CurrentValue && is_numeric(ConvertToFloatString($this->Frequency->CurrentValue)))
			$this->Frequency->CurrentValue = ConvertToFloatString($this->Frequency->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Factor->FormValue == $this->Factor->CurrentValue && is_numeric(ConvertToFloatString($this->Factor->CurrentValue)))
			$this->Factor->CurrentValue = ConvertToFloatString($this->Factor->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ChargeCode
		// ChargeDesc
		// Fee
		// ChargeType
		// Frequency
		// Installment
		// DepartmentCode
		// GLAccount
		// ChargeGroup
		// UnitOfMeasure
		// Factor
		// PeriodType
		// ClearedChargeCode
		// PropertyUse

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ChargeCode
			$this->ChargeCode->ViewValue = $this->ChargeCode->CurrentValue;
			$this->ChargeCode->ViewCustomAttributes = "";

			// ChargeDesc
			$this->ChargeDesc->ViewValue = $this->ChargeDesc->CurrentValue;
			$this->ChargeDesc->ViewCustomAttributes = "";

			// Fee
			$this->Fee->ViewValue = $this->Fee->CurrentValue;
			$this->Fee->ViewValue = FormatNumber($this->Fee->ViewValue, 2, -2, -2, -2);
			$this->Fee->CellCssStyle .= "text-align: right;";
			$this->Fee->ViewCustomAttributes = "";

			// ChargeType
			$curVal = strval($this->ChargeType->CurrentValue);
			if ($curVal != "") {
				$this->ChargeType->ViewValue = $this->ChargeType->lookupCacheOption($curVal);
				if ($this->ChargeType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ChargeType->ViewValue = $this->ChargeType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeType->ViewValue = $this->ChargeType->CurrentValue;
					}
				}
			} else {
				$this->ChargeType->ViewValue = NULL;
			}
			$this->ChargeType->ViewCustomAttributes = "";

			// Frequency
			$this->Frequency->ViewValue = $this->Frequency->CurrentValue;
			$this->Frequency->ViewValue = FormatNumber($this->Frequency->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Frequency->ViewCustomAttributes = "";

			// Installment
			$curVal = strval($this->Installment->CurrentValue);
			if ($curVal != "") {
				$this->Installment->ViewValue = $this->Installment->lookupCacheOption($curVal);
				if ($this->Installment->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChoiceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Installment->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Installment->ViewValue = $this->Installment->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Installment->ViewValue = $this->Installment->CurrentValue;
					}
				}
			} else {
				$this->Installment->ViewValue = NULL;
			}
			$this->Installment->ViewCustomAttributes = "";

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

			// GLAccount
			$curVal = strval($this->GLAccount->CurrentValue);
			if ($curVal != "") {
				$this->GLAccount->ViewValue = $this->GLAccount->lookupCacheOption($curVal);
				if ($this->GLAccount->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AccountCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->GLAccount->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->GLAccount->ViewValue = $this->GLAccount->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->GLAccount->ViewValue = $this->GLAccount->CurrentValue;
					}
				}
			} else {
				$this->GLAccount->ViewValue = NULL;
			}
			$this->GLAccount->ViewCustomAttributes = "";

			// ChargeGroup
			$curVal = strval($this->ChargeGroup->CurrentValue);
			if ($curVal != "") {
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
				if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeGroup`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ChargeGroup->ViewValue = $this->ChargeGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
					}
				}
			} else {
				$this->ChargeGroup->ViewValue = NULL;
			}
			$this->ChargeGroup->ViewCustomAttributes = "";

			// UnitOfMeasure
			$curVal = strval($this->UnitOfMeasure->CurrentValue);
			if ($curVal != "") {
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
				if ($this->UnitOfMeasure->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`UnitOfMeasure`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->CurrentValue;
					}
				}
			} else {
				$this->UnitOfMeasure->ViewValue = NULL;
			}
			$this->UnitOfMeasure->ViewCustomAttributes = "";

			// Factor
			$this->Factor->ViewValue = $this->Factor->CurrentValue;
			$this->Factor->ViewValue = FormatNumber($this->Factor->ViewValue, Config("DEFAULT_DECIMAL_PRECISION"));
			$this->Factor->ViewCustomAttributes = "";

			// PeriodType
			$curVal = strval($this->PeriodType->CurrentValue);
			if ($curVal != "") {
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
				if ($this->PeriodType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Period_Type`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PeriodType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->PeriodType->ViewValue = $this->PeriodType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PeriodType->ViewValue = $this->PeriodType->CurrentValue;
					}
				}
			} else {
				$this->PeriodType->ViewValue = NULL;
			}
			$this->PeriodType->ViewCustomAttributes = "";

			// ClearedChargeCode
			$curVal = strval($this->ClearedChargeCode->CurrentValue);
			if ($curVal != "") {
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->lookupCacheOption($curVal);
				if ($this->ClearedChargeCode->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ClearedChargeCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->ClearedChargeCode->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$arwrk[3] = FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2);
							$this->ClearedChargeCode->ViewValue->add($this->ClearedChargeCode->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->CurrentValue;
					}
				}
			} else {
				$this->ClearedChargeCode->ViewValue = NULL;
			}
			$this->ClearedChargeCode->ViewCustomAttributes = "";

			// PropertyUse
			$curVal = strval($this->PropertyUse->CurrentValue);
			if ($curVal != "") {
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
				if ($this->PropertyUse->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PropertyUse`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PropertyUse->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PropertyUse->ViewValue = $this->PropertyUse->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
					}
				}
			} else {
				$this->PropertyUse->ViewValue = NULL;
			}
			$this->PropertyUse->ViewCustomAttributes = "";

			// ChargeCode
			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";
			$this->ChargeCode->TooltipValue = "";

			// ChargeDesc
			$this->ChargeDesc->LinkCustomAttributes = "";
			$this->ChargeDesc->HrefValue = "";
			$this->ChargeDesc->TooltipValue = "";

			// Fee
			$this->Fee->LinkCustomAttributes = "";
			$this->Fee->HrefValue = "";
			$this->Fee->TooltipValue = "";

			// ChargeType
			$this->ChargeType->LinkCustomAttributes = "";
			$this->ChargeType->HrefValue = "";
			$this->ChargeType->TooltipValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";
			$this->Frequency->TooltipValue = "";

			// Installment
			$this->Installment->LinkCustomAttributes = "";
			$this->Installment->HrefValue = "";
			$this->Installment->TooltipValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";
			$this->DepartmentCode->TooltipValue = "";

			// GLAccount
			$this->GLAccount->LinkCustomAttributes = "";
			$this->GLAccount->HrefValue = "";
			$this->GLAccount->TooltipValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";
			$this->ChargeGroup->TooltipValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";
			$this->UnitOfMeasure->TooltipValue = "";

			// Factor
			$this->Factor->LinkCustomAttributes = "";
			$this->Factor->HrefValue = "";
			$this->Factor->TooltipValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";
			$this->PeriodType->TooltipValue = "";

			// ClearedChargeCode
			$this->ClearedChargeCode->LinkCustomAttributes = "";
			$this->ClearedChargeCode->HrefValue = "";
			$this->ClearedChargeCode->TooltipValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ChargeCode
			$this->ChargeCode->EditAttrs["class"] = "form-control";
			$this->ChargeCode->EditCustomAttributes = "";
			$this->ChargeCode->EditValue = $this->ChargeCode->CurrentValue;
			$this->ChargeCode->ViewCustomAttributes = "";

			// ChargeDesc
			$this->ChargeDesc->EditAttrs["class"] = "form-control";
			$this->ChargeDesc->EditCustomAttributes = "";
			if (!$this->ChargeDesc->Raw)
				$this->ChargeDesc->CurrentValue = HtmlDecode($this->ChargeDesc->CurrentValue);
			$this->ChargeDesc->EditValue = HtmlEncode($this->ChargeDesc->CurrentValue);
			$this->ChargeDesc->PlaceHolder = RemoveHtml($this->ChargeDesc->caption());

			// Fee
			$this->Fee->EditAttrs["class"] = "form-control";
			$this->Fee->EditCustomAttributes = "";
			$this->Fee->EditValue = HtmlEncode($this->Fee->CurrentValue);
			$this->Fee->PlaceHolder = RemoveHtml($this->Fee->caption());
			if (strval($this->Fee->EditValue) != "" && is_numeric($this->Fee->EditValue))
				$this->Fee->EditValue = FormatNumber($this->Fee->EditValue, -2, -2, -2, -2);
			

			// ChargeType
			$this->ChargeType->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeType->CurrentValue));
			if ($curVal != "")
				$this->ChargeType->ViewValue = $this->ChargeType->lookupCacheOption($curVal);
			else
				$this->ChargeType->ViewValue = $this->ChargeType->Lookup !== NULL && is_array($this->ChargeType->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeType->ViewValue !== NULL) { // Load from cache
				$this->ChargeType->EditValue = array_values($this->ChargeType->Lookup->Options);
				if ($this->ChargeType->ViewValue == "")
					$this->ChargeType->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeType`" . SearchString("=", $this->ChargeType->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ChargeType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ChargeType->ViewValue = $this->ChargeType->displayValue($arwrk);
				} else {
					$this->ChargeType->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeType->EditValue = $arwrk;
			}

			// Frequency
			$this->Frequency->EditAttrs["class"] = "form-control";
			$this->Frequency->EditCustomAttributes = "";
			$this->Frequency->EditValue = HtmlEncode($this->Frequency->CurrentValue);
			$this->Frequency->PlaceHolder = RemoveHtml($this->Frequency->caption());
			if (strval($this->Frequency->EditValue) != "" && is_numeric($this->Frequency->EditValue))
				$this->Frequency->EditValue = FormatNumber($this->Frequency->EditValue, -2, -1, -2, 0);
			

			// Installment
			$this->Installment->EditAttrs["class"] = "form-control";
			$this->Installment->EditCustomAttributes = "";
			$curVal = trim(strval($this->Installment->CurrentValue));
			if ($curVal != "")
				$this->Installment->ViewValue = $this->Installment->lookupCacheOption($curVal);
			else
				$this->Installment->ViewValue = $this->Installment->Lookup !== NULL && is_array($this->Installment->Lookup->Options) ? $curVal : NULL;
			if ($this->Installment->ViewValue !== NULL) { // Load from cache
				$this->Installment->EditValue = array_values($this->Installment->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChoiceCode`" . SearchString("=", $this->Installment->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->Installment->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->Installment->EditValue = $arwrk;
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

			// GLAccount
			$this->GLAccount->EditCustomAttributes = "";
			$curVal = trim(strval($this->GLAccount->CurrentValue));
			if ($curVal != "")
				$this->GLAccount->ViewValue = $this->GLAccount->lookupCacheOption($curVal);
			else
				$this->GLAccount->ViewValue = $this->GLAccount->Lookup !== NULL && is_array($this->GLAccount->Lookup->Options) ? $curVal : NULL;
			if ($this->GLAccount->ViewValue !== NULL) { // Load from cache
				$this->GLAccount->EditValue = array_values($this->GLAccount->Lookup->Options);
				if ($this->GLAccount->ViewValue == "")
					$this->GLAccount->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`AccountCode`" . SearchString("=", $this->GLAccount->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->GLAccount->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->GLAccount->ViewValue = $this->GLAccount->displayValue($arwrk);
				} else {
					$this->GLAccount->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->GLAccount->EditValue = $arwrk;
			}

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeGroup->CurrentValue));
			if ($curVal != "")
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			else
				$this->ChargeGroup->ViewValue = $this->ChargeGroup->Lookup !== NULL && is_array($this->ChargeGroup->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeGroup->ViewValue !== NULL) { // Load from cache
				$this->ChargeGroup->EditValue = array_values($this->ChargeGroup->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeGroup`" . SearchString("=", $this->ChargeGroup->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGroup->EditValue = $arwrk;
			}

			// UnitOfMeasure
			$this->UnitOfMeasure->EditCustomAttributes = "";
			$curVal = trim(strval($this->UnitOfMeasure->CurrentValue));
			if ($curVal != "")
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->lookupCacheOption($curVal);
			else
				$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->Lookup !== NULL && is_array($this->UnitOfMeasure->Lookup->Options) ? $curVal : NULL;
			if ($this->UnitOfMeasure->ViewValue !== NULL) { // Load from cache
				$this->UnitOfMeasure->EditValue = array_values($this->UnitOfMeasure->Lookup->Options);
				if ($this->UnitOfMeasure->ViewValue == "")
					$this->UnitOfMeasure->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`UnitOfMeasure`" . SearchString("=", $this->UnitOfMeasure->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->UnitOfMeasure->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->UnitOfMeasure->ViewValue = $this->UnitOfMeasure->displayValue($arwrk);
				} else {
					$this->UnitOfMeasure->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->UnitOfMeasure->EditValue = $arwrk;
			}

			// Factor
			$this->Factor->EditAttrs["class"] = "form-control";
			$this->Factor->EditCustomAttributes = "";
			$this->Factor->EditValue = HtmlEncode($this->Factor->CurrentValue);
			$this->Factor->PlaceHolder = RemoveHtml($this->Factor->caption());
			if (strval($this->Factor->EditValue) != "" && is_numeric($this->Factor->EditValue))
				$this->Factor->EditValue = FormatNumber($this->Factor->EditValue, -2, -1, -2, 0);
			

			// PeriodType
			$this->PeriodType->EditAttrs["class"] = "form-control";
			$this->PeriodType->EditCustomAttributes = "";
			$curVal = trim(strval($this->PeriodType->CurrentValue));
			if ($curVal != "")
				$this->PeriodType->ViewValue = $this->PeriodType->lookupCacheOption($curVal);
			else
				$this->PeriodType->ViewValue = $this->PeriodType->Lookup !== NULL && is_array($this->PeriodType->Lookup->Options) ? $curVal : NULL;
			if ($this->PeriodType->ViewValue !== NULL) { // Load from cache
				$this->PeriodType->EditValue = array_values($this->PeriodType->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Period_Type`" . SearchString("=", $this->PeriodType->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PeriodType->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PeriodType->EditValue = $arwrk;
			}

			// ClearedChargeCode
			$this->ClearedChargeCode->EditCustomAttributes = "";
			$curVal = trim(strval($this->ClearedChargeCode->CurrentValue));
			if ($curVal != "")
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->lookupCacheOption($curVal);
			else
				$this->ClearedChargeCode->ViewValue = $this->ClearedChargeCode->Lookup !== NULL && is_array($this->ClearedChargeCode->Lookup->Options) ? $curVal : NULL;
			if ($this->ClearedChargeCode->ViewValue !== NULL) { // Load from cache
				$this->ClearedChargeCode->EditValue = array_values($this->ClearedChargeCode->Lookup->Options);
				if ($this->ClearedChargeCode->ViewValue == "")
					$this->ClearedChargeCode->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`ChargeCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
				}
				$sqlWrk = $this->ClearedChargeCode->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$this->ClearedChargeCode->ViewValue = new OptionValues();
					$ari = 0;
					while (!$rswrk->EOF) {
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$arwrk[3] = HtmlEncode(FormatNumber($rswrk->fields('df3'), 2, -2, -2, -2));
						$this->ClearedChargeCode->ViewValue->add($this->ClearedChargeCode->displayValue($arwrk));
						$rswrk->MoveNext();
						$ari++;
					}
					$rswrk->MoveFirst();
				} else {
					$this->ClearedChargeCode->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][3] = FormatNumber($arwrk[$i][3], 2, -2, -2, -2);
				}
				$this->ClearedChargeCode->EditValue = $arwrk;
			}

			// PropertyUse
			$this->PropertyUse->EditAttrs["class"] = "form-control";
			$this->PropertyUse->EditCustomAttributes = "";
			$curVal = trim(strval($this->PropertyUse->CurrentValue));
			if ($curVal != "")
				$this->PropertyUse->ViewValue = $this->PropertyUse->lookupCacheOption($curVal);
			else
				$this->PropertyUse->ViewValue = $this->PropertyUse->Lookup !== NULL && is_array($this->PropertyUse->Lookup->Options) ? $curVal : NULL;
			if ($this->PropertyUse->ViewValue !== NULL) { // Load from cache
				$this->PropertyUse->EditValue = array_values($this->PropertyUse->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`PropertyUse`" . SearchString("=", $this->PropertyUse->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->PropertyUse->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->PropertyUse->EditValue = $arwrk;
			}

			// Edit refer script
			// ChargeCode

			$this->ChargeCode->LinkCustomAttributes = "";
			$this->ChargeCode->HrefValue = "";

			// ChargeDesc
			$this->ChargeDesc->LinkCustomAttributes = "";
			$this->ChargeDesc->HrefValue = "";

			// Fee
			$this->Fee->LinkCustomAttributes = "";
			$this->Fee->HrefValue = "";

			// ChargeType
			$this->ChargeType->LinkCustomAttributes = "";
			$this->ChargeType->HrefValue = "";

			// Frequency
			$this->Frequency->LinkCustomAttributes = "";
			$this->Frequency->HrefValue = "";

			// Installment
			$this->Installment->LinkCustomAttributes = "";
			$this->Installment->HrefValue = "";

			// DepartmentCode
			$this->DepartmentCode->LinkCustomAttributes = "";
			$this->DepartmentCode->HrefValue = "";

			// GLAccount
			$this->GLAccount->LinkCustomAttributes = "";
			$this->GLAccount->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// UnitOfMeasure
			$this->UnitOfMeasure->LinkCustomAttributes = "";
			$this->UnitOfMeasure->HrefValue = "";

			// Factor
			$this->Factor->LinkCustomAttributes = "";
			$this->Factor->HrefValue = "";

			// PeriodType
			$this->PeriodType->LinkCustomAttributes = "";
			$this->PeriodType->HrefValue = "";

			// ClearedChargeCode
			$this->ClearedChargeCode->LinkCustomAttributes = "";
			$this->ClearedChargeCode->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
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
		if ($this->ChargeCode->Required) {
			if (!$this->ChargeCode->IsDetailKey && $this->ChargeCode->FormValue != NULL && $this->ChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeCode->caption(), $this->ChargeCode->RequiredErrorMessage));
			}
		}
		if ($this->ChargeDesc->Required) {
			if (!$this->ChargeDesc->IsDetailKey && $this->ChargeDesc->FormValue != NULL && $this->ChargeDesc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeDesc->caption(), $this->ChargeDesc->RequiredErrorMessage));
			}
		}
		if ($this->Fee->Required) {
			if (!$this->Fee->IsDetailKey && $this->Fee->FormValue != NULL && $this->Fee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Fee->caption(), $this->Fee->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Fee->FormValue)) {
			AddMessage($FormError, $this->Fee->errorMessage());
		}
		if ($this->ChargeType->Required) {
			if (!$this->ChargeType->IsDetailKey && $this->ChargeType->FormValue != NULL && $this->ChargeType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeType->caption(), $this->ChargeType->RequiredErrorMessage));
			}
		}
		if ($this->Frequency->Required) {
			if (!$this->Frequency->IsDetailKey && $this->Frequency->FormValue != NULL && $this->Frequency->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Frequency->caption(), $this->Frequency->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Frequency->FormValue)) {
			AddMessage($FormError, $this->Frequency->errorMessage());
		}
		if ($this->Installment->Required) {
			if (!$this->Installment->IsDetailKey && $this->Installment->FormValue != NULL && $this->Installment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Installment->caption(), $this->Installment->RequiredErrorMessage));
			}
		}
		if ($this->DepartmentCode->Required) {
			if (!$this->DepartmentCode->IsDetailKey && $this->DepartmentCode->FormValue != NULL && $this->DepartmentCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DepartmentCode->caption(), $this->DepartmentCode->RequiredErrorMessage));
			}
		}
		if ($this->GLAccount->Required) {
			if (!$this->GLAccount->IsDetailKey && $this->GLAccount->FormValue != NULL && $this->GLAccount->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->GLAccount->caption(), $this->GLAccount->RequiredErrorMessage));
			}
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if ($this->UnitOfMeasure->Required) {
			if (!$this->UnitOfMeasure->IsDetailKey && $this->UnitOfMeasure->FormValue != NULL && $this->UnitOfMeasure->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UnitOfMeasure->caption(), $this->UnitOfMeasure->RequiredErrorMessage));
			}
		}
		if ($this->Factor->Required) {
			if (!$this->Factor->IsDetailKey && $this->Factor->FormValue != NULL && $this->Factor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Factor->caption(), $this->Factor->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Factor->FormValue)) {
			AddMessage($FormError, $this->Factor->errorMessage());
		}
		if ($this->PeriodType->Required) {
			if (!$this->PeriodType->IsDetailKey && $this->PeriodType->FormValue != NULL && $this->PeriodType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PeriodType->caption(), $this->PeriodType->RequiredErrorMessage));
			}
		}
		if ($this->ClearedChargeCode->Required) {
			if ($this->ClearedChargeCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClearedChargeCode->caption(), $this->ClearedChargeCode->RequiredErrorMessage));
			}
		}
		if ($this->PropertyUse->Required) {
			if (!$this->PropertyUse->IsDetailKey && $this->PropertyUse->FormValue != NULL && $this->PropertyUse->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyUse->caption(), $this->PropertyUse->RequiredErrorMessage));
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

			// ChargeDesc
			$this->ChargeDesc->setDbValueDef($rsnew, $this->ChargeDesc->CurrentValue, "", $this->ChargeDesc->ReadOnly);

			// Fee
			$this->Fee->setDbValueDef($rsnew, $this->Fee->CurrentValue, NULL, $this->Fee->ReadOnly);

			// ChargeType
			$this->ChargeType->setDbValueDef($rsnew, $this->ChargeType->CurrentValue, NULL, $this->ChargeType->ReadOnly);

			// Frequency
			$this->Frequency->setDbValueDef($rsnew, $this->Frequency->CurrentValue, NULL, $this->Frequency->ReadOnly);

			// Installment
			$this->Installment->setDbValueDef($rsnew, $this->Installment->CurrentValue, NULL, $this->Installment->ReadOnly);

			// DepartmentCode
			$this->DepartmentCode->setDbValueDef($rsnew, $this->DepartmentCode->CurrentValue, NULL, $this->DepartmentCode->ReadOnly);

			// GLAccount
			$this->GLAccount->setDbValueDef($rsnew, $this->GLAccount->CurrentValue, NULL, $this->GLAccount->ReadOnly);

			// ChargeGroup
			$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, $this->ChargeGroup->ReadOnly);

			// UnitOfMeasure
			$this->UnitOfMeasure->setDbValueDef($rsnew, $this->UnitOfMeasure->CurrentValue, NULL, $this->UnitOfMeasure->ReadOnly);

			// Factor
			$this->Factor->setDbValueDef($rsnew, $this->Factor->CurrentValue, NULL, $this->Factor->ReadOnly);

			// PeriodType
			$this->PeriodType->setDbValueDef($rsnew, $this->PeriodType->CurrentValue, NULL, $this->PeriodType->ReadOnly);

			// ClearedChargeCode
			$this->ClearedChargeCode->setDbValueDef($rsnew, $this->ClearedChargeCode->CurrentValue, NULL, $this->ClearedChargeCode->ReadOnly);

			// PropertyUse
			$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, NULL, $this->PropertyUse->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("chargeslist.php"), "", $this->TableVar, TRUE);
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
				case "x_ChargeType":
					break;
				case "x_Installment":
					break;
				case "x_DepartmentCode":
					break;
				case "x_GLAccount":
					break;
				case "x_ChargeGroup":
					break;
				case "x_UnitOfMeasure":
					break;
				case "x_PeriodType":
					break;
				case "x_ClearedChargeCode":
					break;
				case "x_PropertyUse":
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
						case "x_ChargeType":
							break;
						case "x_Installment":
							break;
						case "x_DepartmentCode":
							break;
						case "x_GLAccount":
							break;
						case "x_ChargeGroup":
							break;
						case "x_UnitOfMeasure":
							break;
						case "x_PeriodType":
							break;
						case "x_ClearedChargeCode":
							$row[3] = FormatNumber($row[3], 2, -2, -2, -2);
							$row['df3'] = $row[3];
							break;
						case "x_PropertyUse":
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