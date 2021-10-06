<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class staff_view extends staff
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'staff';

	// Page object name
	public $PageObjName = "staff_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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

		// Table object (staff)
		if (!isset($GLOBALS["staff"]) || get_class($GLOBALS["staff"]) == PROJECT_NAMESPACE . "staff") {
			$GLOBALS["staff"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["staff"];
		}
		$keyUrl = "";
		if (Get("EmployeeID") !== NULL) {
			$this->RecKey["EmployeeID"] = Get("EmployeeID");
			$keyUrl .= "&amp;EmployeeID=" . urlencode($this->RecKey["EmployeeID"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'staff');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
		global $staff;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($staff);
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
					if ($pageName == "staffview.php")
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
			$key .= @$ar['EmployeeID'];
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
			$this->EmployeeID->Visible = FALSE;
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;
	public $staffchildren_Count;
	public $staffdisciplinary_action_Count;
	public $staffdisciplinary_appeal_Count;
	public $staffdisciplinary_case_Count;
	public $staffexperience_Count;
	public $staffprofbodies_Count;
	public $staffqualifications_academic_Count;
	public $staffqualifications_prof_Count;
	public $employment_Count;
	public $DetailPages; // Detail pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
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
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("stafflist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header
		if (Get("EmployeeID") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("EmployeeID");
		}

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();
		$this->EmployeeID->setVisibility();
		$this->LACode->setVisibility();
		$this->FormerFileNumber->setVisibility();
		$this->NRC->setVisibility();
		$this->Title->setVisibility();
		$this->Surname->setVisibility();
		$this->FirstName->setVisibility();
		$this->MiddleName->setVisibility();
		$this->Sex->setVisibility();
		$this->StaffPhoto->setVisibility();
		$this->MaritalStatus->setVisibility();
		$this->MaidenName->setVisibility();
		$this->DateOfBirth->setVisibility();
		$this->AcademicQualification->setVisibility();
		$this->ProfessionalQualification->setVisibility();
		$this->MedicalCondition->setVisibility();
		$this->OtherMedicalConditions->setVisibility();
		$this->PhysicalChallenge->setVisibility();
		$this->PostalAddress->setVisibility();
		$this->PhysicalAddress->setVisibility();
		$this->TownOrVillage->setVisibility();
		$this->Telephone->setVisibility();
		$this->Mobile->setVisibility();
		$this->Fax->setVisibility();
		$this->_Email->setVisibility();
		$this->NumberOfBiologicalChildren->setVisibility();
		$this->NumberOfDependants->setVisibility();
		$this->NextOfKin->setVisibility();
		$this->RelationshipCode->setVisibility();
		$this->NextOfKinMobile->setVisibility();
		$this->NextOfKinEmail->setVisibility();
		$this->SpouseName->setVisibility();
		$this->SpouseNRC->setVisibility();
		$this->SpouseMobile->setVisibility();
		$this->SpouseEmail->setVisibility();
		$this->SpouseResidentialAddress->setVisibility();
		$this->AdditionalInformation->setVisibility();
		$this->LastUserID->setVisibility();
		$this->LastUpdated->setVisibility();
		$this->BankAccountNo->setVisibility();
		$this->PaymentMethod->setVisibility();
		$this->BankBranchCode->setVisibility();
		$this->TaxNumber->setVisibility();
		$this->PensionNumber->setVisibility();
		$this->SocialSecurityNo->setVisibility();
		$this->ThirdParties->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

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
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->Title);
		$this->setupLookupOptions($this->Sex);
		$this->setupLookupOptions($this->MaritalStatus);
		$this->setupLookupOptions($this->AcademicQualification);
		$this->setupLookupOptions($this->ProfessionalQualification);
		$this->setupLookupOptions($this->MedicalCondition);
		$this->setupLookupOptions($this->OtherMedicalConditions);
		$this->setupLookupOptions($this->PhysicalChallenge);
		$this->setupLookupOptions($this->RelationshipCode);
		$this->setupLookupOptions($this->PaymentMethod);
		$this->setupLookupOptions($this->BankBranchCode);
		$this->setupLookupOptions($this->ThirdParties);

		// Check permission
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("stafflist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("EmployeeID") !== NULL) {
				$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->EmployeeID->setQueryStringValue(Key(0));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->QueryStringValue;
			} elseif (Post("EmployeeID") !== NULL) {
				$this->EmployeeID->setFormValue(Post("EmployeeID"));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->EmployeeID->setFormValue(Route(2));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display
					$this->StartRecord = 1; // Initialize start position
					if ($this->Recordset = $this->loadRecordset()) // Load records
						$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecords <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$this->terminate("stafflist.php"); // Return to list page
					} elseif ($loadCurrentRecord) { // Load current record position
						$this->setupStartRecord(); // Set up start record position

						// Point to current record
						if ($this->StartRecord <= $this->TotalRecords) {
							$matchRecord = TRUE;
							$this->Recordset->move($this->StartRecord - 1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (SameString($this->EmployeeID->CurrentValue, $this->Recordset->fields('EmployeeID'))) {
								$this->setStartRecordNumber($this->StartRecord); // Save record position
								$matchRecord = TRUE;
								break;
							} else {
								$this->StartRecord++;
								$this->Recordset->moveNext();
							}
						}
					}
					if (!$matchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "stafflist.php"; // No matching record, return to list
					} else {
						$this->loadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "stafflist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Set up detail parameters
		$this->setupDetailParms();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit());

		// Copy
		$item = &$option->add("copy");
		$copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl != "" && $Security->canAdd());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());
		$option = $options["detail"];
		$detailTableLink = "";
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_staffchildren"
		$item = &$option->add("detail_staffchildren");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffchildren", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffchildren_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffchildrenlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffchildren_grid"]))
			$GLOBALS["staffchildren_grid"] = new staffchildren_grid();
		if ($GLOBALS["staffchildren_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffchildren";
		}
		if ($GLOBALS["staffchildren_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffchildren";
		}
		if ($GLOBALS["staffchildren_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffchildren")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffchildren";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffchildren');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffchildren";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffdisciplinary_action"
		$item = &$option->add("detail_staffdisciplinary_action");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffdisciplinary_action", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffdisciplinary_action_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffdisciplinary_actionlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
			$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
		if ($GLOBALS["staffdisciplinary_action_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffdisciplinary_action";
		}
		if ($GLOBALS["staffdisciplinary_action_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffdisciplinary_action";
		}
		if ($GLOBALS["staffdisciplinary_action_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_action")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffdisciplinary_action";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffdisciplinary_action');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffdisciplinary_action";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffdisciplinary_appeal"
		$item = &$option->add("detail_staffdisciplinary_appeal");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffdisciplinary_appeal", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffdisciplinary_appeal_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffdisciplinary_appeallist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
			$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
		if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffdisciplinary_appeal";
		}
		if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffdisciplinary_appeal";
		}
		if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_appeal")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffdisciplinary_appeal";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffdisciplinary_appeal');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffdisciplinary_appeal";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffdisciplinary_case"
		$item = &$option->add("detail_staffdisciplinary_case");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffdisciplinary_case", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffdisciplinary_case_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffdisciplinary_caselist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
			$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();
		if ($GLOBALS["staffdisciplinary_case_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffdisciplinary_case";
		}
		if ($GLOBALS["staffdisciplinary_case_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffdisciplinary_case";
		}
		if ($GLOBALS["staffdisciplinary_case_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffdisciplinary_case")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffdisciplinary_case";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffdisciplinary_case');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffdisciplinary_case";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffexperience"
		$item = &$option->add("detail_staffexperience");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffexperience", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffexperience_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffexperiencelist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffexperience_grid"]))
			$GLOBALS["staffexperience_grid"] = new staffexperience_grid();
		if ($GLOBALS["staffexperience_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffexperience";
		}
		if ($GLOBALS["staffexperience_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffexperience";
		}
		if ($GLOBALS["staffexperience_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffexperience")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffexperience";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffexperience');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffexperience";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffprofbodies"
		$item = &$option->add("detail_staffprofbodies");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffprofbodies", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffprofbodies_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffprofbodieslist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffprofbodies_grid"]))
			$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();
		if ($GLOBALS["staffprofbodies_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffprofbodies";
		}
		if ($GLOBALS["staffprofbodies_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffprofbodies";
		}
		if ($GLOBALS["staffprofbodies_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffprofbodies")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffprofbodies";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffprofbodies');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffprofbodies";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffqualifications_academic"
		$item = &$option->add("detail_staffqualifications_academic");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffqualifications_academic", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffqualifications_academic_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffqualifications_academiclist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffqualifications_academic_grid"]))
			$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();
		if ($GLOBALS["staffqualifications_academic_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffqualifications_academic";
		}
		if ($GLOBALS["staffqualifications_academic_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffqualifications_academic";
		}
		if ($GLOBALS["staffqualifications_academic_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_academic")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffqualifications_academic";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffqualifications_academic');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffqualifications_academic";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_staffqualifications_prof"
		$item = &$option->add("detail_staffqualifications_prof");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("staffqualifications_prof", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->staffqualifications_prof_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("staffqualifications_proflist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["staffqualifications_prof_grid"]))
			$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();
		if ($GLOBALS["staffqualifications_prof_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "staffqualifications_prof";
		}
		if ($GLOBALS["staffqualifications_prof_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "staffqualifications_prof";
		}
		if ($GLOBALS["staffqualifications_prof_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=staffqualifications_prof")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "staffqualifications_prof";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'staffqualifications_prof');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "staffqualifications_prof";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_employment"
		$item = &$option->add("detail_employment");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("employment", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->employment_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("employmentlist.php?" . Config("TABLE_SHOW_MASTER") . "=staff&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["employment_grid"]))
			$GLOBALS["employment_grid"] = new employment_grid();
		if ($GLOBALS["employment_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=employment")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "employment";
		}
		if ($GLOBALS["employment_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=employment")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "employment";
		}
		if ($GLOBALS["employment_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'staff')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=employment")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "employment";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'employment');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "employment";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$item = &$option->add("details");
			$item->Body = $body;
		}

		// Set up detail default
		$option = $options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$ar = explode(",", $detailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = TRUE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
		$this->LACode->setDbValue($row['LACode']);
		$this->FormerFileNumber->setDbValue($row['FormerFileNumber']);
		$this->NRC->setDbValue($row['NRC']);
		$this->Title->setDbValue($row['Title']);
		$this->Surname->setDbValue($row['Surname']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->MiddleName->setDbValue($row['MiddleName']);
		$this->Sex->setDbValue($row['Sex']);
		$this->StaffPhoto->Upload->DbValue = $row['StaffPhoto'];
		if (is_array($this->StaffPhoto->Upload->DbValue) || is_object($this->StaffPhoto->Upload->DbValue)) // Byte array
			$this->StaffPhoto->Upload->DbValue = BytesToString($this->StaffPhoto->Upload->DbValue);
		$this->MaritalStatus->setDbValue($row['MaritalStatus']);
		$this->MaidenName->setDbValue($row['MaidenName']);
		$this->DateOfBirth->setDbValue($row['DateOfBirth']);
		$this->AcademicQualification->setDbValue($row['AcademicQualification']);
		$this->ProfessionalQualification->setDbValue($row['ProfessionalQualification']);
		$this->MedicalCondition->setDbValue($row['MedicalCondition']);
		$this->OtherMedicalConditions->setDbValue($row['OtherMedicalConditions']);
		$this->PhysicalChallenge->setDbValue($row['PhysicalChallenge']);
		$this->PostalAddress->setDbValue($row['PostalAddress']);
		$this->PhysicalAddress->setDbValue($row['PhysicalAddress']);
		$this->TownOrVillage->setDbValue($row['TownOrVillage']);
		$this->Telephone->setDbValue($row['Telephone']);
		$this->Mobile->setDbValue($row['Mobile']);
		$this->Fax->setDbValue($row['Fax']);
		$this->_Email->setDbValue($row['Email']);
		$this->NumberOfBiologicalChildren->setDbValue($row['NumberOfBiologicalChildren']);
		$this->NumberOfDependants->setDbValue($row['NumberOfDependants']);
		$this->NextOfKin->setDbValue($row['NextOfKin']);
		$this->RelationshipCode->setDbValue($row['RelationshipCode']);
		$this->NextOfKinMobile->setDbValue($row['NextOfKinMobile']);
		$this->NextOfKinEmail->setDbValue($row['NextOfKinEmail']);
		$this->SpouseName->setDbValue($row['SpouseName']);
		$this->SpouseNRC->setDbValue($row['SpouseNRC']);
		$this->SpouseMobile->setDbValue($row['SpouseMobile']);
		$this->SpouseEmail->setDbValue($row['SpouseEmail']);
		$this->SpouseResidentialAddress->setDbValue($row['SpouseResidentialAddress']);
		$this->AdditionalInformation->setDbValue($row['AdditionalInformation']);
		$this->LastUserID->setDbValue($row['LastUserID']);
		$this->LastUpdated->setDbValue($row['LastUpdated']);
		$this->BankAccountNo->setDbValue($row['BankAccountNo']);
		$this->PaymentMethod->setDbValue($row['PaymentMethod']);
		$this->BankBranchCode->setDbValue($row['BankBranchCode']);
		$this->TaxNumber->setDbValue($row['TaxNumber']);
		$this->PensionNumber->setDbValue($row['PensionNumber']);
		$this->SocialSecurityNo->setDbValue($row['SocialSecurityNo']);
		$this->ThirdParties->setDbValue($row['ThirdParties']);
		if (!isset($GLOBALS["staffchildren_grid"]))
			$GLOBALS["staffchildren_grid"] = new staffchildren_grid();
		$detailFilter = $GLOBALS["staffchildren"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffchildren"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffchildren"]->applyUserIDFilters($detailFilter);
		$this->staffchildren_Count = $GLOBALS["staffchildren"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
			$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
		$detailFilter = $GLOBALS["staffdisciplinary_action"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffdisciplinary_action"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffdisciplinary_action"]->applyUserIDFilters($detailFilter);
		$this->staffdisciplinary_action_Count = $GLOBALS["staffdisciplinary_action"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
			$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
		$detailFilter = $GLOBALS["staffdisciplinary_appeal"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffdisciplinary_appeal"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffdisciplinary_appeal"]->applyUserIDFilters($detailFilter);
		$this->staffdisciplinary_appeal_Count = $GLOBALS["staffdisciplinary_appeal"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
			$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();
		$detailFilter = $GLOBALS["staffdisciplinary_case"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffdisciplinary_case"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffdisciplinary_case"]->applyUserIDFilters($detailFilter);
		$this->staffdisciplinary_case_Count = $GLOBALS["staffdisciplinary_case"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffexperience_grid"]))
			$GLOBALS["staffexperience_grid"] = new staffexperience_grid();
		$detailFilter = $GLOBALS["staffexperience"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffexperience"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffexperience"]->applyUserIDFilters($detailFilter);
		$this->staffexperience_Count = $GLOBALS["staffexperience"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffprofbodies_grid"]))
			$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();
		$detailFilter = $GLOBALS["staffprofbodies"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffprofbodies"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffprofbodies"]->applyUserIDFilters($detailFilter);
		$this->staffprofbodies_Count = $GLOBALS["staffprofbodies"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffqualifications_academic_grid"]))
			$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();
		$detailFilter = $GLOBALS["staffqualifications_academic"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffqualifications_academic"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffqualifications_academic"]->applyUserIDFilters($detailFilter);
		$this->staffqualifications_academic_Count = $GLOBALS["staffqualifications_academic"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["staffqualifications_prof_grid"]))
			$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();
		$detailFilter = $GLOBALS["staffqualifications_prof"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["staffqualifications_prof"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["staffqualifications_prof"]->applyUserIDFilters($detailFilter);
		$this->staffqualifications_prof_Count = $GLOBALS["staffqualifications_prof"]->loadRecordCount($detailFilter);
		if (!isset($GLOBALS["employment_grid"]))
			$GLOBALS["employment_grid"] = new employment_grid();
		$detailFilter = $GLOBALS["employment"]->sqlDetailFilter_staff();
		$detailFilter = str_replace("@EmployeeID@", AdjustSql($this->EmployeeID->DbValue, "DB"), $detailFilter);
		$GLOBALS["employment"]->setCurrentMasterTable("staff");
		$detailFilter = $GLOBALS["employment"]->applyUserIDFilters($detailFilter);
		$this->employment_Count = $GLOBALS["employment"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['LACode'] = NULL;
		$row['FormerFileNumber'] = NULL;
		$row['NRC'] = NULL;
		$row['Title'] = NULL;
		$row['Surname'] = NULL;
		$row['FirstName'] = NULL;
		$row['MiddleName'] = NULL;
		$row['Sex'] = NULL;
		$row['StaffPhoto'] = NULL;
		$row['MaritalStatus'] = NULL;
		$row['MaidenName'] = NULL;
		$row['DateOfBirth'] = NULL;
		$row['AcademicQualification'] = NULL;
		$row['ProfessionalQualification'] = NULL;
		$row['MedicalCondition'] = NULL;
		$row['OtherMedicalConditions'] = NULL;
		$row['PhysicalChallenge'] = NULL;
		$row['PostalAddress'] = NULL;
		$row['PhysicalAddress'] = NULL;
		$row['TownOrVillage'] = NULL;
		$row['Telephone'] = NULL;
		$row['Mobile'] = NULL;
		$row['Fax'] = NULL;
		$row['Email'] = NULL;
		$row['NumberOfBiologicalChildren'] = NULL;
		$row['NumberOfDependants'] = NULL;
		$row['NextOfKin'] = NULL;
		$row['RelationshipCode'] = NULL;
		$row['NextOfKinMobile'] = NULL;
		$row['NextOfKinEmail'] = NULL;
		$row['SpouseName'] = NULL;
		$row['SpouseNRC'] = NULL;
		$row['SpouseMobile'] = NULL;
		$row['SpouseEmail'] = NULL;
		$row['SpouseResidentialAddress'] = NULL;
		$row['AdditionalInformation'] = NULL;
		$row['LastUserID'] = NULL;
		$row['LastUpdated'] = NULL;
		$row['BankAccountNo'] = NULL;
		$row['PaymentMethod'] = NULL;
		$row['BankBranchCode'] = NULL;
		$row['TaxNumber'] = NULL;
		$row['PensionNumber'] = NULL;
		$row['SocialSecurityNo'] = NULL;
		$row['ThirdParties'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// LACode
		// FormerFileNumber
		// NRC
		// Title
		// Surname
		// FirstName
		// MiddleName
		// Sex
		// StaffPhoto
		// MaritalStatus
		// MaidenName
		// DateOfBirth
		// AcademicQualification
		// ProfessionalQualification
		// MedicalCondition
		// OtherMedicalConditions
		// PhysicalChallenge
		// PostalAddress
		// PhysicalAddress
		// TownOrVillage
		// Telephone
		// Mobile
		// Fax
		// Email
		// NumberOfBiologicalChildren
		// NumberOfDependants
		// NextOfKin
		// RelationshipCode
		// NextOfKinMobile
		// NextOfKinEmail
		// SpouseName
		// SpouseNRC
		// SpouseMobile
		// SpouseEmail
		// SpouseResidentialAddress
		// AdditionalInformation
		// LastUserID
		// LastUpdated
		// BankAccountNo
		// PaymentMethod
		// BankBranchCode
		// TaxNumber
		// PensionNumber
		// SocialSecurityNo
		// ThirdParties

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$this->EmployeeID->ViewCustomAttributes = "";

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// FormerFileNumber
			$this->FormerFileNumber->ViewValue = $this->FormerFileNumber->CurrentValue;
			$this->FormerFileNumber->ViewCustomAttributes = "";

			// NRC
			$this->NRC->ViewValue = $this->NRC->CurrentValue;
			$this->NRC->ViewCustomAttributes = "";

			// Title
			$curVal = strval($this->Title->CurrentValue);
			if ($curVal != "") {
				$this->Title->ViewValue = $this->Title->lookupCacheOption($curVal);
				if ($this->Title->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Title`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Title->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->Title->ViewValue = $this->Title->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Title->ViewValue = $this->Title->CurrentValue;
					}
				}
			} else {
				$this->Title->ViewValue = NULL;
			}
			$this->Title->ViewCustomAttributes = "";

			// Surname
			$this->Surname->ViewValue = $this->Surname->CurrentValue;
			$this->Surname->ViewCustomAttributes = "";

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->ViewCustomAttributes = "";

			// MiddleName
			$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
			$this->MiddleName->ViewCustomAttributes = "";

			// Sex
			$curVal = strval($this->Sex->CurrentValue);
			if ($curVal != "") {
				$this->Sex->ViewValue = $this->Sex->lookupCacheOption($curVal);
				if ($this->Sex->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Sex`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Sex->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Sex->ViewValue = $this->Sex->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Sex->ViewValue = $this->Sex->CurrentValue;
					}
				}
			} else {
				$this->Sex->ViewValue = NULL;
			}
			$this->Sex->ViewCustomAttributes = "";

			// StaffPhoto
			if (!EmptyValue($this->StaffPhoto->Upload->DbValue)) {
				$this->StaffPhoto->ViewValue = $this->EmployeeID->CurrentValue;
				$this->StaffPhoto->IsBlobImage = IsImageFile(ContentExtension($this->StaffPhoto->Upload->DbValue));
			} else {
				$this->StaffPhoto->ViewValue = "";
			}
			$this->StaffPhoto->ViewCustomAttributes = "";

			// MaritalStatus
			$curVal = strval($this->MaritalStatus->CurrentValue);
			if ($curVal != "") {
				$this->MaritalStatus->ViewValue = $this->MaritalStatus->lookupCacheOption($curVal);
				if ($this->MaritalStatus->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MaritalStatusCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->MaritalStatus->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MaritalStatus->ViewValue = $this->MaritalStatus->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MaritalStatus->ViewValue = $this->MaritalStatus->CurrentValue;
					}
				}
			} else {
				$this->MaritalStatus->ViewValue = NULL;
			}
			$this->MaritalStatus->ViewCustomAttributes = "";

			// MaidenName
			$this->MaidenName->ViewValue = $this->MaidenName->CurrentValue;
			$this->MaidenName->ViewCustomAttributes = "";

			// DateOfBirth
			$this->DateOfBirth->ViewValue = $this->DateOfBirth->CurrentValue;
			$this->DateOfBirth->ViewValue = FormatDateTime($this->DateOfBirth->ViewValue, 0);
			$this->DateOfBirth->ViewCustomAttributes = "";

			// AcademicQualification
			$curVal = strval($this->AcademicQualification->CurrentValue);
			if ($curVal != "") {
				$this->AcademicQualification->ViewValue = $this->AcademicQualification->lookupCacheOption($curVal);
				if ($this->AcademicQualification->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`AcademicQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->AcademicQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->AcademicQualification->ViewValue = $this->AcademicQualification->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->AcademicQualification->ViewValue = $this->AcademicQualification->CurrentValue;
					}
				}
			} else {
				$this->AcademicQualification->ViewValue = NULL;
			}
			$this->AcademicQualification->ViewCustomAttributes = "";

			// ProfessionalQualification
			$curVal = strval($this->ProfessionalQualification->CurrentValue);
			if ($curVal != "") {
				$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->lookupCacheOption($curVal);
				if ($this->ProfessionalQualification->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProfessionalQualifications`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->ProfessionalQualification->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProfessionalQualification->ViewValue = $this->ProfessionalQualification->CurrentValue;
					}
				}
			} else {
				$this->ProfessionalQualification->ViewValue = NULL;
			}
			$this->ProfessionalQualification->ViewCustomAttributes = "";

			// MedicalCondition
			$curVal = strval($this->MedicalCondition->CurrentValue);
			if ($curVal != "") {
				$this->MedicalCondition->ViewValue = $this->MedicalCondition->lookupCacheOption($curVal);
				if ($this->MedicalCondition->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MedicalCondition`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->MedicalCondition->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->MedicalCondition->ViewValue = $this->MedicalCondition->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->MedicalCondition->ViewValue = $this->MedicalCondition->CurrentValue;
					}
				}
			} else {
				$this->MedicalCondition->ViewValue = NULL;
			}
			$this->MedicalCondition->ViewCustomAttributes = "";

			// OtherMedicalConditions
			$curVal = strval($this->OtherMedicalConditions->CurrentValue);
			if ($curVal != "") {
				$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->lookupCacheOption($curVal);
				if ($this->OtherMedicalConditions->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`MedicalCondition`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->OtherMedicalConditions->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->OtherMedicalConditions->ViewValue = $this->OtherMedicalConditions->CurrentValue;
					}
				}
			} else {
				$this->OtherMedicalConditions->ViewValue = NULL;
			}
			$this->OtherMedicalConditions->ViewCustomAttributes = "";

			// PhysicalChallenge
			$curVal = strval($this->PhysicalChallenge->CurrentValue);
			if ($curVal != "") {
				$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->lookupCacheOption($curVal);
				if ($this->PhysicalChallenge->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PhysicalChallenge`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PhysicalChallenge->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PhysicalChallenge->ViewValue = $this->PhysicalChallenge->CurrentValue;
					}
				}
			} else {
				$this->PhysicalChallenge->ViewValue = NULL;
			}
			$this->PhysicalChallenge->ViewCustomAttributes = "";

			// PostalAddress
			$this->PostalAddress->ViewValue = $this->PostalAddress->CurrentValue;
			$this->PostalAddress->ViewCustomAttributes = "";

			// PhysicalAddress
			$this->PhysicalAddress->ViewValue = $this->PhysicalAddress->CurrentValue;
			$this->PhysicalAddress->ViewCustomAttributes = "";

			// TownOrVillage
			$this->TownOrVillage->ViewValue = $this->TownOrVillage->CurrentValue;
			$this->TownOrVillage->ViewCustomAttributes = "";

			// Telephone
			$this->Telephone->ViewValue = $this->Telephone->CurrentValue;
			$this->Telephone->ViewCustomAttributes = "";

			// Mobile
			$this->Mobile->ViewValue = $this->Mobile->CurrentValue;
			$this->Mobile->ViewCustomAttributes = "";

			// Fax
			$this->Fax->ViewValue = $this->Fax->CurrentValue;
			$this->Fax->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->ViewValue = $this->NumberOfBiologicalChildren->CurrentValue;
			$this->NumberOfBiologicalChildren->ViewValue = FormatNumber($this->NumberOfBiologicalChildren->ViewValue, 0, -2, -2, -2);
			$this->NumberOfBiologicalChildren->ViewCustomAttributes = "";

			// NumberOfDependants
			$this->NumberOfDependants->ViewValue = $this->NumberOfDependants->CurrentValue;
			$this->NumberOfDependants->ViewValue = FormatNumber($this->NumberOfDependants->ViewValue, 0, -2, -2, -2);
			$this->NumberOfDependants->ViewCustomAttributes = "";

			// NextOfKin
			$this->NextOfKin->ViewValue = $this->NextOfKin->CurrentValue;
			$this->NextOfKin->ViewCustomAttributes = "";

			// RelationshipCode
			$curVal = strval($this->RelationshipCode->CurrentValue);
			if ($curVal != "") {
				$this->RelationshipCode->ViewValue = $this->RelationshipCode->lookupCacheOption($curVal);
				if ($this->RelationshipCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`RelationshipCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->RelationshipCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->RelationshipCode->ViewValue = $this->RelationshipCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->RelationshipCode->ViewValue = $this->RelationshipCode->CurrentValue;
					}
				}
			} else {
				$this->RelationshipCode->ViewValue = NULL;
			}
			$this->RelationshipCode->ViewCustomAttributes = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->ViewValue = $this->NextOfKinMobile->CurrentValue;
			$this->NextOfKinMobile->ViewCustomAttributes = "";

			// NextOfKinEmail
			$this->NextOfKinEmail->ViewValue = $this->NextOfKinEmail->CurrentValue;
			$this->NextOfKinEmail->ViewCustomAttributes = "";

			// SpouseName
			$this->SpouseName->ViewValue = $this->SpouseName->CurrentValue;
			$this->SpouseName->ViewCustomAttributes = "";

			// SpouseNRC
			$this->SpouseNRC->ViewValue = $this->SpouseNRC->CurrentValue;
			$this->SpouseNRC->ViewCustomAttributes = "";

			// SpouseMobile
			$this->SpouseMobile->ViewValue = $this->SpouseMobile->CurrentValue;
			$this->SpouseMobile->ViewCustomAttributes = "";

			// SpouseEmail
			$this->SpouseEmail->ViewValue = $this->SpouseEmail->CurrentValue;
			$this->SpouseEmail->ViewCustomAttributes = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->ViewValue = $this->SpouseResidentialAddress->CurrentValue;
			$this->SpouseResidentialAddress->ViewCustomAttributes = "";

			// AdditionalInformation
			$this->AdditionalInformation->ViewValue = $this->AdditionalInformation->CurrentValue;
			$this->AdditionalInformation->ViewCustomAttributes = "";

			// BankAccountNo
			$this->BankAccountNo->ViewValue = $this->BankAccountNo->CurrentValue;
			$this->BankAccountNo->ViewCustomAttributes = "";

			// PaymentMethod
			$curVal = strval($this->PaymentMethod->CurrentValue);
			if ($curVal != "") {
				$this->PaymentMethod->ViewValue = $this->PaymentMethod->lookupCacheOption($curVal);
				if ($this->PaymentMethod->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PaymentMethod`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PaymentMethod->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PaymentMethod->ViewValue = $this->PaymentMethod->CurrentValue;
					}
				}
			} else {
				$this->PaymentMethod->ViewValue = NULL;
			}
			$this->PaymentMethod->ViewCustomAttributes = "";

			// BankBranchCode
			$curVal = strval($this->BankBranchCode->CurrentValue);
			if ($curVal != "") {
				$this->BankBranchCode->ViewValue = $this->BankBranchCode->lookupCacheOption($curVal);
				if ($this->BankBranchCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`BranchCode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->BankBranchCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->BankBranchCode->ViewValue = $this->BankBranchCode->CurrentValue;
					}
				}
			} else {
				$this->BankBranchCode->ViewValue = NULL;
			}
			$this->BankBranchCode->ViewCustomAttributes = "";

			// TaxNumber
			$this->TaxNumber->ViewValue = $this->TaxNumber->CurrentValue;
			$this->TaxNumber->ViewCustomAttributes = "";

			// PensionNumber
			$this->PensionNumber->ViewValue = $this->PensionNumber->CurrentValue;
			$this->PensionNumber->ViewCustomAttributes = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->ViewValue = $this->SocialSecurityNo->CurrentValue;
			$this->SocialSecurityNo->ViewCustomAttributes = "";

			// ThirdParties
			$curVal = strval($this->ThirdParties->CurrentValue);
			if ($curVal != "") {
				$this->ThirdParties->ViewValue = $this->ThirdParties->lookupCacheOption($curVal);
				if ($this->ThirdParties->ViewValue === NULL) { // Lookup from database
					$arwrk = explode(",", $curVal);
					$filterWrk = "";
					foreach ($arwrk as $wrk) {
						if ($filterWrk != "")
							$filterWrk .= " OR ";
						$filterWrk .= "`DeductionCode`" . SearchString("=", trim($wrk), DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ThirdParties->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$this->ThirdParties->ViewValue = new OptionValues();
						$ari = 0;
						while (!$rswrk->EOF) {
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->ThirdParties->ViewValue->add($this->ThirdParties->displayValue($arwrk));
							$rswrk->MoveNext();
							$ari++;
						}
						$rswrk->Close();
					} else {
						$this->ThirdParties->ViewValue = $this->ThirdParties->CurrentValue;
					}
				}
			} else {
				$this->ThirdParties->ViewValue = NULL;
			}
			$this->ThirdParties->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// FormerFileNumber
			$this->FormerFileNumber->LinkCustomAttributes = "";
			$this->FormerFileNumber->HrefValue = "";
			$this->FormerFileNumber->TooltipValue = "";

			// NRC
			$this->NRC->LinkCustomAttributes = "";
			$this->NRC->HrefValue = "";
			$this->NRC->TooltipValue = "";

			// Title
			$this->Title->LinkCustomAttributes = "";
			$this->Title->HrefValue = "";
			$this->Title->TooltipValue = "";

			// Surname
			$this->Surname->LinkCustomAttributes = "";
			$this->Surname->HrefValue = "";
			$this->Surname->TooltipValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";

			// MiddleName
			$this->MiddleName->LinkCustomAttributes = "";
			$this->MiddleName->HrefValue = "";
			$this->MiddleName->TooltipValue = "";

			// Sex
			$this->Sex->LinkCustomAttributes = "";
			$this->Sex->HrefValue = "";
			$this->Sex->TooltipValue = "";

			// StaffPhoto
			$this->StaffPhoto->LinkCustomAttributes = "";
			if (!empty($this->StaffPhoto->Upload->DbValue)) {
				$this->StaffPhoto->HrefValue = GetFileUploadUrl($this->StaffPhoto, $this->EmployeeID->CurrentValue);
				$this->StaffPhoto->LinkAttrs["target"] = "";
				if ($this->StaffPhoto->IsBlobImage && empty($this->StaffPhoto->LinkAttrs["target"]))
					$this->StaffPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->StaffPhoto->HrefValue = FullUrl($this->StaffPhoto->HrefValue, "href");
			} else {
				$this->StaffPhoto->HrefValue = "";
			}
			$this->StaffPhoto->ExportHrefValue = GetFileUploadUrl($this->StaffPhoto, $this->EmployeeID->CurrentValue);
			$this->StaffPhoto->TooltipValue = "";

			// MaritalStatus
			$this->MaritalStatus->LinkCustomAttributes = "";
			$this->MaritalStatus->HrefValue = "";
			$this->MaritalStatus->TooltipValue = "";

			// MaidenName
			$this->MaidenName->LinkCustomAttributes = "";
			$this->MaidenName->HrefValue = "";
			$this->MaidenName->TooltipValue = "";

			// DateOfBirth
			$this->DateOfBirth->LinkCustomAttributes = "";
			$this->DateOfBirth->HrefValue = "";
			$this->DateOfBirth->TooltipValue = "";

			// AcademicQualification
			$this->AcademicQualification->LinkCustomAttributes = "";
			$this->AcademicQualification->HrefValue = "";
			$this->AcademicQualification->TooltipValue = "";

			// ProfessionalQualification
			$this->ProfessionalQualification->LinkCustomAttributes = "";
			$this->ProfessionalQualification->HrefValue = "";
			$this->ProfessionalQualification->TooltipValue = "";

			// MedicalCondition
			$this->MedicalCondition->LinkCustomAttributes = "";
			$this->MedicalCondition->HrefValue = "";
			$this->MedicalCondition->TooltipValue = "";

			// OtherMedicalConditions
			$this->OtherMedicalConditions->LinkCustomAttributes = "";
			$this->OtherMedicalConditions->HrefValue = "";
			$this->OtherMedicalConditions->TooltipValue = "";

			// PhysicalChallenge
			$this->PhysicalChallenge->LinkCustomAttributes = "";
			$this->PhysicalChallenge->HrefValue = "";
			$this->PhysicalChallenge->TooltipValue = "";

			// PostalAddress
			$this->PostalAddress->LinkCustomAttributes = "";
			$this->PostalAddress->HrefValue = "";
			$this->PostalAddress->TooltipValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";
			$this->PhysicalAddress->TooltipValue = "";

			// TownOrVillage
			$this->TownOrVillage->LinkCustomAttributes = "";
			$this->TownOrVillage->HrefValue = "";
			$this->TownOrVillage->TooltipValue = "";

			// Telephone
			$this->Telephone->LinkCustomAttributes = "";
			$this->Telephone->HrefValue = "";
			$this->Telephone->TooltipValue = "";

			// Mobile
			$this->Mobile->LinkCustomAttributes = "";
			$this->Mobile->HrefValue = "";
			$this->Mobile->TooltipValue = "";

			// Fax
			$this->Fax->LinkCustomAttributes = "";
			$this->Fax->HrefValue = "";
			$this->Fax->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// NumberOfBiologicalChildren
			$this->NumberOfBiologicalChildren->LinkCustomAttributes = "";
			$this->NumberOfBiologicalChildren->HrefValue = "";
			$this->NumberOfBiologicalChildren->TooltipValue = "";

			// NumberOfDependants
			$this->NumberOfDependants->LinkCustomAttributes = "";
			$this->NumberOfDependants->HrefValue = "";
			$this->NumberOfDependants->TooltipValue = "";

			// NextOfKin
			$this->NextOfKin->LinkCustomAttributes = "";
			$this->NextOfKin->HrefValue = "";
			$this->NextOfKin->TooltipValue = "";

			// RelationshipCode
			$this->RelationshipCode->LinkCustomAttributes = "";
			$this->RelationshipCode->HrefValue = "";
			$this->RelationshipCode->TooltipValue = "";

			// NextOfKinMobile
			$this->NextOfKinMobile->LinkCustomAttributes = "";
			$this->NextOfKinMobile->HrefValue = "";
			$this->NextOfKinMobile->TooltipValue = "";

			// NextOfKinEmail
			$this->NextOfKinEmail->LinkCustomAttributes = "";
			$this->NextOfKinEmail->HrefValue = "";
			$this->NextOfKinEmail->TooltipValue = "";

			// SpouseName
			$this->SpouseName->LinkCustomAttributes = "";
			$this->SpouseName->HrefValue = "";
			$this->SpouseName->TooltipValue = "";

			// SpouseNRC
			$this->SpouseNRC->LinkCustomAttributes = "";
			$this->SpouseNRC->HrefValue = "";
			$this->SpouseNRC->TooltipValue = "";

			// SpouseMobile
			$this->SpouseMobile->LinkCustomAttributes = "";
			$this->SpouseMobile->HrefValue = "";
			$this->SpouseMobile->TooltipValue = "";

			// SpouseEmail
			$this->SpouseEmail->LinkCustomAttributes = "";
			$this->SpouseEmail->HrefValue = "";
			$this->SpouseEmail->TooltipValue = "";

			// SpouseResidentialAddress
			$this->SpouseResidentialAddress->LinkCustomAttributes = "";
			$this->SpouseResidentialAddress->HrefValue = "";
			$this->SpouseResidentialAddress->TooltipValue = "";

			// AdditionalInformation
			$this->AdditionalInformation->LinkCustomAttributes = "";
			$this->AdditionalInformation->HrefValue = "";
			$this->AdditionalInformation->TooltipValue = "";

			// BankAccountNo
			$this->BankAccountNo->LinkCustomAttributes = "";
			$this->BankAccountNo->HrefValue = "";
			$this->BankAccountNo->TooltipValue = "";

			// PaymentMethod
			$this->PaymentMethod->LinkCustomAttributes = "";
			$this->PaymentMethod->HrefValue = "";
			$this->PaymentMethod->TooltipValue = "";

			// BankBranchCode
			$this->BankBranchCode->LinkCustomAttributes = "";
			$this->BankBranchCode->HrefValue = "";
			$this->BankBranchCode->TooltipValue = "";

			// TaxNumber
			$this->TaxNumber->LinkCustomAttributes = "";
			$this->TaxNumber->HrefValue = "";
			$this->TaxNumber->TooltipValue = "";

			// PensionNumber
			$this->PensionNumber->LinkCustomAttributes = "";
			$this->PensionNumber->HrefValue = "";
			$this->PensionNumber->TooltipValue = "";

			// SocialSecurityNo
			$this->SocialSecurityNo->LinkCustomAttributes = "";
			$this->SocialSecurityNo->HrefValue = "";
			$this->SocialSecurityNo->TooltipValue = "";

			// ThirdParties
			$this->ThirdParties->LinkCustomAttributes = "";
			$this->ThirdParties->HrefValue = "";
			$this->ThirdParties->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fstaffview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fstaffview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fstaffview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_staff" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_staff\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fstaffview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = FALSE;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");

		// Export detail records (staffchildren)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffchildren", explode(",", $this->getCurrentDetailTable()))) {
			global $staffchildren;
			if (!isset($staffchildren))
				$staffchildren = new staffchildren();
			$rsdetail = $staffchildren->loadRs($staffchildren->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffchildren;
					$staffchildren->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffdisciplinary_action)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffdisciplinary_action", explode(",", $this->getCurrentDetailTable()))) {
			global $staffdisciplinary_action;
			if (!isset($staffdisciplinary_action))
				$staffdisciplinary_action = new staffdisciplinary_action();
			$rsdetail = $staffdisciplinary_action->loadRs($staffdisciplinary_action->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffdisciplinary_action;
					$staffdisciplinary_action->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffdisciplinary_appeal)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffdisciplinary_appeal", explode(",", $this->getCurrentDetailTable()))) {
			global $staffdisciplinary_appeal;
			if (!isset($staffdisciplinary_appeal))
				$staffdisciplinary_appeal = new staffdisciplinary_appeal();
			$rsdetail = $staffdisciplinary_appeal->loadRs($staffdisciplinary_appeal->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffdisciplinary_appeal;
					$staffdisciplinary_appeal->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffdisciplinary_case)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffdisciplinary_case", explode(",", $this->getCurrentDetailTable()))) {
			global $staffdisciplinary_case;
			if (!isset($staffdisciplinary_case))
				$staffdisciplinary_case = new staffdisciplinary_case();
			$rsdetail = $staffdisciplinary_case->loadRs($staffdisciplinary_case->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffdisciplinary_case;
					$staffdisciplinary_case->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffexperience)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffexperience", explode(",", $this->getCurrentDetailTable()))) {
			global $staffexperience;
			if (!isset($staffexperience))
				$staffexperience = new staffexperience();
			$rsdetail = $staffexperience->loadRs($staffexperience->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffexperience;
					$staffexperience->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffprofbodies)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffprofbodies", explode(",", $this->getCurrentDetailTable()))) {
			global $staffprofbodies;
			if (!isset($staffprofbodies))
				$staffprofbodies = new staffprofbodies();
			$rsdetail = $staffprofbodies->loadRs($staffprofbodies->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffprofbodies;
					$staffprofbodies->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffqualifications_academic)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffqualifications_academic", explode(",", $this->getCurrentDetailTable()))) {
			global $staffqualifications_academic;
			if (!isset($staffqualifications_academic))
				$staffqualifications_academic = new staffqualifications_academic();
			$rsdetail = $staffqualifications_academic->loadRs($staffqualifications_academic->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffqualifications_academic;
					$staffqualifications_academic->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (staffqualifications_prof)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("staffqualifications_prof", explode(",", $this->getCurrentDetailTable()))) {
			global $staffqualifications_prof;
			if (!isset($staffqualifications_prof))
				$staffqualifications_prof = new staffqualifications_prof();
			$rsdetail = $staffqualifications_prof->loadRs($staffqualifications_prof->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $staffqualifications_prof;
					$staffqualifications_prof->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (employment)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("employment", explode(",", $this->getCurrentDetailTable()))) {
			global $employment;
			if (!isset($employment))
				$employment = new employment();
			$rsdetail = $employment->loadRs($employment->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $employment;
					$employment->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
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
			if (in_array("staffchildren", $detailTblVar)) {
				if (!isset($GLOBALS["staffchildren_grid"]))
					$GLOBALS["staffchildren_grid"] = new staffchildren_grid();
				if ($GLOBALS["staffchildren_grid"]->DetailView) {
					$GLOBALS["staffchildren_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffchildren_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffchildren_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffchildren_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffchildren_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffchildren_grid"]->EmployeeID->setSessionValue($GLOBALS["staffchildren_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffdisciplinary_action", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_action_grid"]))
					$GLOBALS["staffdisciplinary_action_grid"] = new staffdisciplinary_action_grid();
				if ($GLOBALS["staffdisciplinary_action_grid"]->DetailView) {
					$GLOBALS["staffdisciplinary_action_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_action_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_action_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_action_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["staffdisciplinary_action_grid"]->CaseNo->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("staffdisciplinary_appeal", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_appeal_grid"]))
					$GLOBALS["staffdisciplinary_appeal_grid"] = new staffdisciplinary_appeal_grid();
				if ($GLOBALS["staffdisciplinary_appeal_grid"]->DetailView) {
					$GLOBALS["staffdisciplinary_appeal_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_appeal_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_appeal_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_appeal_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["staffdisciplinary_appeal_grid"]->CaseNo->setSessionValue(""); // Clear session key
					$GLOBALS["staffdisciplinary_appeal_grid"]->OffenseCode->setSessionValue(""); // Clear session key
				}
			}
			if (in_array("staffdisciplinary_case", $detailTblVar)) {
				if (!isset($GLOBALS["staffdisciplinary_case_grid"]))
					$GLOBALS["staffdisciplinary_case_grid"] = new staffdisciplinary_case_grid();
				if ($GLOBALS["staffdisciplinary_case_grid"]->DetailView) {
					$GLOBALS["staffdisciplinary_case_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffdisciplinary_case_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffdisciplinary_case_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->setSessionValue($GLOBALS["staffdisciplinary_case_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffexperience", $detailTblVar)) {
				if (!isset($GLOBALS["staffexperience_grid"]))
					$GLOBALS["staffexperience_grid"] = new staffexperience_grid();
				if ($GLOBALS["staffexperience_grid"]->DetailView) {
					$GLOBALS["staffexperience_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffexperience_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffexperience_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffexperience_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffexperience_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffexperience_grid"]->EmployeeID->setSessionValue($GLOBALS["staffexperience_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffprofbodies", $detailTblVar)) {
				if (!isset($GLOBALS["staffprofbodies_grid"]))
					$GLOBALS["staffprofbodies_grid"] = new staffprofbodies_grid();
				if ($GLOBALS["staffprofbodies_grid"]->DetailView) {
					$GLOBALS["staffprofbodies_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffprofbodies_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffprofbodies_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffprofbodies_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffprofbodies_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffprofbodies_grid"]->EmployeeID->setSessionValue($GLOBALS["staffprofbodies_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffqualifications_academic", $detailTblVar)) {
				if (!isset($GLOBALS["staffqualifications_academic_grid"]))
					$GLOBALS["staffqualifications_academic_grid"] = new staffqualifications_academic_grid();
				if ($GLOBALS["staffqualifications_academic_grid"]->DetailView) {
					$GLOBALS["staffqualifications_academic_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffqualifications_academic_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffqualifications_academic_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffqualifications_academic_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffqualifications_academic_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffqualifications_academic_grid"]->EmployeeID->setSessionValue($GLOBALS["staffqualifications_academic_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("staffqualifications_prof", $detailTblVar)) {
				if (!isset($GLOBALS["staffqualifications_prof_grid"]))
					$GLOBALS["staffqualifications_prof_grid"] = new staffqualifications_prof_grid();
				if ($GLOBALS["staffqualifications_prof_grid"]->DetailView) {
					$GLOBALS["staffqualifications_prof_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["staffqualifications_prof_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["staffqualifications_prof_grid"]->setStartRecordNumber(1);
					$GLOBALS["staffqualifications_prof_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["staffqualifications_prof_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["staffqualifications_prof_grid"]->EmployeeID->setSessionValue($GLOBALS["staffqualifications_prof_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("employment", $detailTblVar)) {
				if (!isset($GLOBALS["employment_grid"]))
					$GLOBALS["employment_grid"] = new employment_grid();
				if ($GLOBALS["employment_grid"]->DetailView) {
					$GLOBALS["employment_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["employment_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["employment_grid"]->setStartRecordNumber(1);
					$GLOBALS["employment_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["employment_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["employment_grid"]->EmployeeID->setSessionValue($GLOBALS["employment_grid"]->EmployeeID->CurrentValue);
					$GLOBALS["employment_grid"]->SubstantivePosition->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->SectionCode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->DepartmentCode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->LACode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->ProvinceCode->setSessionValue(""); // Clear session key
					$GLOBALS["employment_grid"]->SalaryScale->setSessionValue(""); // Clear session key
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("stafflist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('staffchildren');
		$pages->add('staffdisciplinary_action');
		$pages->add('staffdisciplinary_appeal');
		$pages->add('staffdisciplinary_case');
		$pages->add('staffexperience');
		$pages->add('staffprofbodies');
		$pages->add('staffqualifications_academic');
		$pages->add('staffqualifications_prof');
		$pages->add('employment');
		$this->DetailPages = $pages;
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
				case "x_LACode":
					break;
				case "x_Title":
					break;
				case "x_Sex":
					break;
				case "x_MaritalStatus":
					break;
				case "x_AcademicQualification":
					break;
				case "x_ProfessionalQualification":
					break;
				case "x_MedicalCondition":
					break;
				case "x_OtherMedicalConditions":
					break;
				case "x_PhysicalChallenge":
					break;
				case "x_RelationshipCode":
					break;
				case "x_PaymentMethod":
					break;
				case "x_BankBranchCode":
					break;
				case "x_ThirdParties":
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
						case "x_LACode":
							break;
						case "x_Title":
							break;
						case "x_Sex":
							break;
						case "x_MaritalStatus":
							break;
						case "x_AcademicQualification":
							break;
						case "x_ProfessionalQualification":
							break;
						case "x_MedicalCondition":
							break;
						case "x_OtherMedicalConditions":
							break;
						case "x_PhysicalChallenge":
							break;
						case "x_RelationshipCode":
							break;
						case "x_PaymentMethod":
							break;
						case "x_BankBranchCode":
							break;
						case "x_ThirdParties":
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>