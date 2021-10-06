/**
 * Detail Preview Extension for PHPMaker 2020
 * @license (C) 2020 e.World Technology Ltd.
 */
ew.PREVIEW_LOADING_HTML='<div class="'+ew.spinnerClass+' m-3 ew-loading" role="status"><span class="sr-only">'+ew.language.phrase("Loading")+"</span></div>",ew.PREVIEW_BUTTON_SELECTOR=".ew-preview-row-btn",ew.PREVIEW_OVERLAY_WIDTH=1e3,ew.addRowToTable=function(e){var t,a=jQuery,r=a(e),o=0,i=r.closest("tbody");ew.PREVIEW_SINGLE_ROW&&i.find("tr.ew-table-preview-row").remove(),a(e.cells).each(function(){o+=this.colSpan});var s=r.nextAll("tr[data-rowindex!="+r.data("rowindex")+"]").first();return s.hasClass("ew-table-preview-row")?s[0]:((t=i[0].insertRow(s[0]?s[0].sectionRowIndex:-1))&&(a(t).addClass("ew-table-preview-row"),a(t.insertCell(0)).addClass("ew-table-last-col").prop("colSpan",o)),t)},ew.showDetails=function(e){var t=jQuery,a=t(this),r=a.is("tr[data-rowindex]")?a:a.closest("tr[data-rowindex]"),o=r.closest("table");if(r[0]){if(r.data("preview")){var i=r.nextAll("tr[data-rowindex!='"+r.data("rowindex")+"']").first();i.hasClass("ew-table-preview-row")&&i.remove(),r.data("preview",!1).find(ew.PREVIEW_BUTTON_SELECTOR).addClass("icon-expand").removeClass("icon-collapse")}else{var s=t(ew.addRowToTable(r[0]).cells[0]),n=r.find("[class$=_preview] div.ew-preview");s.empty(),s.append(t("#ew-preview").contents().clone()).find(".nav-tabs").append(n.find("li:has([data-toggle='tab'])").clone(!0)).find("[data-toggle='tab']").attr("data-target","#"+s.find(".tab-pane").attr("id",ew.random()).attr("id")).first().tab("show"),(ew.PREVIEW_SINGLE_ROW?o:r).find(ew.PREVIEW_BUTTON_SELECTOR).addClass("icon-expand").removeClass("icon-collapse"),r.data("preview",!0).find(ew.PREVIEW_BUTTON_SELECTOR).addClass("icon-collapse").removeClass("icon-expand")}ew.setupTable(-1,o[0],!0),!1===r.data("preview")&&ew.fixLayoutHeight()}},ew.detail=function(e,t){var a=jQuery,r=a(t),o=r.closest(".ew-list-option-body"),i=r.data("placement")||ew.PREVIEW_PLACEMENT,s=o.find(".dropdown-menu"),n=o.find(".btn-group");if(s.mouseenter(function(e){e.stopPropagation()}),n[0]&&("right"==i&&s.addClass("float-right"),r=n.first()),!r.data("bs.popover")){r.popover({html:!0,delay:{show:100,hide:250},placement:i,trigger:"hover",container:a("#ew-tooltip")[0],content:ew.PREVIEW_LOADING_HTML,sanitizeFn:ew.sanitizeFn}).on("shown.bs.popover",function(e){var t=ew.PREVIEW_OVERLAY_WIDTH,s=a(r.data("bs.popover").getTipElement()).css("max-width",t+"px");if("left"==i){var n=r.closest(".btn-group").offset();s.css({"min-width":t+"px",transform:"none",left:n.left-t-s.find(".arrow").width(),top:n.top})}else s.css("min-width","200px");s.find(".popover-body").html(a("#ew-preview").html()),s.find(".nav-tabs").append(o.find("li:has([data-toggle='tab'])").clone(!0)),s.find("[data-toggle='tab']").attr("data-target","#"+s.find(".tab-pane").attr("id",ew.random()).attr("id")).data("$element",r).first().tab("show")});var d=r.data("bs.popover");a(d.getTipElement()).mouseenter(function(e){clearTimeout(d._timeout)}).mouseleave(function(e){a(d.getTipElement()).html().includes(ew.PREVIEW_LOADING_HTML)||(d._timeout=setTimeout(function(){d.hide()},d.config.delay.hide))})}},ew.tabShow=function(e){var t,a=jQuery,r=a(e.currentTarget),o=r.data("target"),i=a(o),s=r.data("table"),n="";i[0]&&(r.data("url")?((t=i.data(s)||{}).url=url=r.data("url"),start=t.start||1,sort=t.sort,sortOrder=t.sortOrder):r.data("start")?(r.tooltip&&r.tooltip("hide"),t=i.data(s),url=t.url,t.start=start=r.data("start")||1,sort=t.sort,sortOrder=t.sortOrder):r.data("sort")&&(t=i.data(s),url=t.url,start=t.start||1,t.sort=sort=r.data("sort"),t.sortOrder=sortOrder=r.data("sortOrder"),sort===t.sort&&sortOrder===t.sortOrder||(t.start=start=1,t.sortOrder=sortOrder="")),i.data(s,t).empty().html(ew.PREVIEW_LOADING_HTML),a.isNumber(start)&&(n+="&start="+start),sort&&(n+="&sort="+encodeURIComponent(sort),"ASC"!=sortOrder&&"DESC"!=sortOrder||(n+="&sortorder="+sortOrder)),a.get(url+n,function(e){i.empty().html(e).append(a("div[data-table='"+s+"'][data-url='"+url+"']:first").clone()),i.find(".ew-pager .btn:not(.disabled), .ew-table-header > th > div[data-sort]").data({target:o,table:s}).click(ew.tabShow),a(document).trigger("preview",[{$tabpane:i}])}))},ew.preview=function(e,t){var a=jQuery,r=t.$tabpane;e=a.Event("preview",{target:r});r.find("table.ew-table").each(ew.setupTable),ew.initTooltips(e),ew.initLightboxes(e),ew.initIcons(e),ew.lazyLoad(e),ew.fixLayoutHeight()},jQuery(function(e){e(document).on("preview",ew.preview),ew.PREVIEW_OVERLAY&&e("div.ew-preview").each(function(){e(this).parent().find("[data-action='view'],[data-action='list']").each(ew.detail)}),e(ew.PREVIEW_BUTTON_SELECTOR).click(ew.showDetails),e("div.ew-preview [data-toggle='tab']").on("show.bs.tab",ew.tabShow)});