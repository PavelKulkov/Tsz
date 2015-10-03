<script src="/modules/generate/js/jquery.tablednd.js"></script>
<style>
   .markerRequired {color: red;}
   #modalTz td:hover {
   background-color: #FEAB4D;
   cursor: pointer;
   }
   .pagination_bootstrap {
   margin: 20px 0;
   }
   .pagination_bootstrap ul {
   display: inline-block;
   *display: inline;
   margin-bottom: 0;
   margin-left: 0;
   -webkit-border-radius: 4px;
   -moz-border-radius: 4px;
   border-radius: 4px;
   *zoom: 1;
   -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
   -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
   box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
   }
   .pagination_bootstrap ul > li {
   display: inline;
   }
   .pagination_bootstrap ul > li > a,
   .pagination_bootstrap ul > li > span {
   float: left;
   padding: 4px 12px;
   line-height: 20px;
   text-decoration: none;
   background-color: #ffffff;
   border: 1px solid #dddddd;
   border-left-width: 0;
   }
   .pagination_bootstrap ul > li > a:hover,
   .pagination_bootstrap ul > .active > a,
   .pagination_bootstrap ul > .active > span {
   background-color: #f5f5f5;
   }
   .pagination_bootstrap ul > .active > a,
   .pagination_bootstrap ul > .active > span {
   color: #999999;
   cursor: default;
   }
   .pagination_bootstrap ul > .disabled > span,
   .pagination_bootstrap ul > .disabled > a,
   .pagination_bootstrap ul > .disabled > a:hover {
   color: #999999;
   cursor: default;
   background-color: transparent;
   }
   .pagination_bootstrap ul > li:first-child > a,
   .pagination_bootstrap ul > li:first-child > span {
   border-left-width: 1px;
   -webkit-border-bottom-left-radius: 4px;
   border-bottom-left-radius: 4px;
   -webkit-border-top-left-radius: 4px;
   border-top-left-radius: 4px;
   -moz-border-radius-bottomleft: 4px;
   -moz-border-radius-topleft: 4px;
   }
   .pagination_bootstrap ul > li:last-child > a,
   .pagination_bootstrap ul > li:last-child > span {
   -webkit-border-top-right-radius: 4px;
   border-top-right-radius: 4px;
   -webkit-border-bottom-right-radius: 4px;
   border-bottom-right-radius: 4px;
   -moz-border-radius-topright: 4px;
   -moz-border-radius-bottomright: 4px;
   }
   #upload{
   margin:30px 200px; padding:15px;
   font-weight:bold; font-size:1.3em;
   font-family:Arial, Helvetica, sans-serif;
   text-align:center;
   background:#f2f2f2;
   color:#3366cc;
   border:1px solid #ccc;
   width:150px;
   cursor:pointer !important;
   -moz-border-radius:5px; -webkit-border-radius:5px;
   }
   .darkbg{
   background:#ddd !important;
   }
   #status{
   font-family:Arial; padding:5px;
   }
   ul#files{ list-style:none; padding:0; margin:0; }
   ul#files li{ padding:10px; margin-bottom:2px; width:200px; float:left; margin-right:10px;}
   ul#files li img{ max-width:180px; max-height:150px; }
   .success{ background:#99f099; border:1px solid #339933; }
   .error{ background:#f0c6c3; border:1px solid #cc6622; }
   .tDnD_whileDrag { background-color: #FFE6E6 !important; border:1px solid #cc6622; }
   .fields td span:hover { cursor:default !important; }
   .fields th:hover { cursor:default !important; }
   .fields .icon-trash:hover { cursor: pointer; }
   .alert .deleteCondition, .alert .buttonDeleteCloneBlock {
   line-height: 20px;
   position: relative;
   right: -21px;
   top: -2px;
   }
   button.deleteCondition, button.buttonDeleteCloneBlock {
   background: none repeat scroll 0 0 transparent;
   border: 0 none;
   cursor: pointer;
   padding: 0;
   }
   .deleteCondition, .buttonDeleteCloneBlock, .editCloneBlock {
   color: rgb(0, 0, 0);
   float: right;
   font-size: 20px;
   font-weight: bold;
   line-height: 20px;
   opacity: 0.2;
   text-shadow: 0 1px 0 rgb(255, 255, 255);
   }
</style>

<script type="text/javascript">

$(document).ready(function() {
   
response = {};
window.wListFields = "";
window.isEditField = "";
window.responseEditField = "";


$(document).on("change keyup input click", "#addName, #addClass", function() {
    if (this.value.match(/[^A-z0-9]/g)) {
        this.value = this.value.replace(/[^A-z0-9]/g, '');
    }
});


$(document).on("change keyup input click", "#addMaxlength", function() {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
});



$('#modalSubservice').modal({
    keyboard: false
});


$(document).on("click", ".bindField", function() {

    var action = "";

    if ($(this).is(":checked")) {
        $(this).closest("tr").css("background-color", "#FFF6EB");
        action = "bindField";
    } else {
        action = "unbindField";
        $(this).closest("tr").css("background-color", "");
    }

    if ($("#activeStep").val() === "undefined" || $("#activeStep").val() === "") {
        alert("Выберите шаг, на который вы хотите добавить данное поле!");
        $(this).removeAttr("checked");
        return false;
    }

    $.ajax({
        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=" + action + "&idField=" + $(this).attr("id") + "&idStep=" + $("#activeStep").val() + "&idForm=" + $("#idForm").val() + "",

        success: function() {
            $(".fields").tableDnD();
            addSortingFields();
        }
    });


    if ($(this).is(":checked")) {

        var name = $(this).closest("tr").find("td").eq(2).text();

        if (name !== "" && name.indexOf("doc_") >= 0 && name.indexOf("_type") >= 0) {

            $(".fields:visible").find("input[type=checkbox]").not(":checked").each(function() {
                $(this).closest("tr").remove();
            });

            $(".searchStringDocs").val("1");

            if ($(".fields:visible").find("tr:contains('" + name.replace("_type", "") + "_series')").size() == 0) {
                $(".searchString:last").val(name.replace("_type", "") + "_series").keyup();
            }

            if ($(".fields:visible").find("tr:contains('" + name.replace("_type", "") + "_number')").size() == 0) {
                $(".searchString:last").val(name.replace("_type", "") + "_number").keyup();
            }

            if ($(".fields:visible").find("tr:contains('" + name.replace("_type", "") + "_dateIssue')").size() == 0) {
                $(".searchString:last").val(name.replace("_type", "") + "_dateIssue").keyup();
            }

            if ($(".fields:visible").find("tr:contains('" + name.replace("_type", "") + "_organization')").size() == 0) {
                $(".searchString:last").val(name.replace("_type", "") + "_organization").keyup();
            }

            $(".searchStringDocs").val("0");
            $(".searchString").val("");

        }

    }

});


function loadForm() {

    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=loadForm&idForm=" + $("#idForm").val() + "",
        success: function(data) {
            $("#wrapper").html(data);
            $("#fullSource").val(data);
            //loadDictionaries();
        }
    });

}


$(document).on("click", ".addField", function() {


    if ($('#editField').val() == "" || $('#editField').val() == 0) {

        var editField = false;

        var url = "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=" + $("#addLabel").val() + "&addName=" + $("#addName").val() + "&addType=" + $("#addType").val() + "&addClone=" + $("#addClone").val() + "&addRequired=" + $("#addRequired").val() + "&addDisabled=" + $("#addDisabled").val() + "&addMaxlength=" + $("#addMaxlength").val() + "&addFormat=" + $("#addFormat option:selected").val() + "&addClass=" + $("#addClass").val() + "&addDictionary=" + $("#addDictionary").val() + "&addComment=" + $("#addComment").val() + "&addPlaceholder=" + $("#addPlaceholder").val() + "&addValue=" + $("#addValue").val() + "&addHidden=" + $("#addHidden").val() + "&addMask=" + $("#addMask").val() + "&addHeader=" + $("#addHeader").val() + "";

    } else {

        var editField = true;


        $.ajax({

            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=checkEditField&idForm=" + $("#idForm").val() + "&idField=" + $("#editField").val() + "",
            success: function(response) {

                responseEditField = response;

                if (responseEditField != "" && responseEditField != "undefined" && responseEditField != "false") {
                    isEditField = confirm('Данное поле используется в других формах (' + responseEditField + ') Продолжить редактирование ?');
                }

            }
        });


        if (isEditField == true || responseEditField == "false") {

            var url = "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=editField&addLabel=" + $("#addLabel").val() + "&addName=" + $("#addName").val() + "&addType=" + $("#addType").val() + "&addClone=" + $("#addClone").val() + "&addRequired=" + $("#addRequired").val() + "&addDisabled=" + $("#addDisabled").val() + "&addMaxlength=" + $("#addMaxlength").val() + "&addFormat=" + $("#addFormat option:selected").val() + "&addClass=" + $("#addClass").val() + "&addDictionary=" + $("#addDictionary").val() + "&idField=" + $("#editField").val() + "&addComment=" + $("#addComment").val() + "&addPlaceholder=" + $("#addPlaceholder").val() + "&addValue=" + $("#addValue").val() + "&addHidden=" + $("#addHidden").val() + "&addMask=" + $("#addMask").val() + "&addHeader=" + $("#addHeader").val() + "";
        } else {
            $('#modalAddField').modal("hide");
            return false;
        }

    }


    $.ajax({
        type: "GET",
        async: false,
        url: url,

        success: function(data) {

            if (data.indexOf(":document") + 1 > 0) {
                var document = "true";
            }

            if (editField == true) {
                if ($('.bindField[id=' + data + ']').is(":checked")) {
                    var checked = true;
                }

                var id = data;
            }

            fields(data, checked, false);

            if (editField == true) {
                $('.fields:visible .bindField[id=' + id + ']:first').closest("tr").after($('.fields:visible tr:last').clone());
                $('.fields:visible .bindField[id=' + id + ']:first').closest("tr").remove();
                $('.fields:visible tr:last').remove();
            }

            loadForm();

            $(".fields").tableDnD();


            if (document == "true" && editField == false) {

                var parentFieldName = $("#addName").val().replace("_type", "");

                if (confirm("В базе данных уже есть реквизиты для данного поля! Всё равно добавить новые поля с реквизитами ?")) {

                    if ($("#addFormat").val() == "document" && editField == false) {


                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Серия&addName=" + parentFieldName + "_series&addType=textfield&addClass=" + parentFieldName + "_series",

                            success: function(data) {
                                fields(data, false, false);
                            }
                        });


                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Номер&addName=" + parentFieldName + "_number&addType=textfield&addClass=" + parentFieldName + "_number",

                            success: function(data) {
                                fields(data, false, false);
                            }
                        });


                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Дата выдачи&addFormat=datepicker&addName=" + parentFieldName + "_dateIssue&addType=textfield&addClass=" + parentFieldName + "_dateIssue",

                            success: function(data) {
                                fields(data, false, false);
                            }
                        });


                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Кем выдан&addName=" + parentFieldName + "_organization&addType=textarea&addClass=" + parentFieldName + "_organization",

                            success: function(data) {
                                fields(data, false, false);
                            }
                        });
                    }

                } else {


                    $(".searchStringDocs").val("1");

                    $(".searchString:last").val(parentFieldName + "_series").keyup();
                    $(".searchString:last").val(parentFieldName + "_number").keyup();
                    $(".searchString:last").val(parentFieldName + "_dateIssue").keyup();
                    $(".searchString:last").val(parentFieldName + "_organization").keyup();

                    $(".searchStringDocs").val("0");

                    $(".searchString").val("");

                }

            }




            if (document != "true" && editField == false) {

                var parentFieldName = $("#addName").val().replace("_type", "");

                if ($("#addFormat").val() == "document" && editField == false) {

                    $.ajax({
                        type: "GET",
                        async: false,
                        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Серия&addName=" + parentFieldName + "_series&addType=textfield&addClass=" + parentFieldName + "_series",

                        success: function(data) {
                            fields(data, false, false);
                        }
                    });


                    $.ajax({
                        type: "GET",
                        async: false,
                        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Номер&addName=" + parentFieldName + "_number&addType=textfield&addClass=" + parentFieldName + "_number",

                        success: function(data) {
                            fields(data, false, false);
                        }
                    });


                    $.ajax({
                        type: "GET",
                        async: false,
                        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Дата выдачи&addFormat=datepicker&addName=" + parentFieldName + "_dateIssue&addType=textfield&addClass=" + parentFieldName + "_dateIssue",

                        success: function(data) {
                            fields(data, false, false);
                        }
                    });


                    $.ajax({
                        type: "GET",
                        async: false,
                        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addField&addLabel=Кем выдан&addName=" + parentFieldName + "_organization&addType=textarea&addClass=" + parentFieldName + "_organization",

                        success: function(data) {
                            fields(data, false, false);
                        }
                    });

                }


            }


        }


    });


    $('#modalAddField').find("select option:selected").removeAttr("selected");
    $('#modalAddField').find("input[type=checkbox]").removeAttr("checked").val("0");
    $('#modalAddField').find("input[type=text]").val('');
    $('#modalAddField').find("textarea").val('');
    $('#modalAddField').modal("hide");
    $('#editField').val("");


});




$("#stepName").keyup(function(event) {

    searchStep(event);

});

function searchStep(event) {

    if ($("#stepName").val().length >= 3 && event.which !== 8 && event.which !== 38 && event.which !== 40) {

        var stepName = $("#stepName").val();

        $.ajax({
            dataType: "json",
            contentType: "application/json",
            cache: false,
            type: "GET",
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=searchStep&stepName=" + stepName + "",
            success: function(data) {
                response = data;
                var arr = new Array();
                var value;
                $("#stepsList").html('');

                if (response !== null) {
                    for (i = 0; i < response.data.length; i++) {
                        arr[i] = value = response.data[i].label;
                        $("#stepsList").append("<li id=" + response.data[i].id + ">" + value + "</li>");
                    }

                    var availableTags = arr;
                    $("#stepName").autocomplete({
                        source: availableTags
                    });

                    $("#stepName").trigger($.Event("keydown", {
                        keyCode: 39
                    }));

                }

            }

        });
    }

}


$(".searchString").keyup(function(event) {

    if ($(this).val().length >= 3 && event.which !== 8 && event.which !== 38 && event.which !== 40) {

        $("#showMoreFields").hide();

        $.ajax({
            cache: false,
            async: false,
            type: "GET",
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=searchField&searchString=" + $(this).val() + "&start=" + $(".fields:visible").find(".searchField").size() + "",
            success: function(data) {

                $(".fields:visible tbody").find("tr").removeClass("searchField");

                if ($(".searchStringDocs").val() != 1) {
                    $(".fields:visible").find("input[type=checkbox]").not(":checked").each(function() {
                        $(this).closest("tr").remove();
                    });
                }

                $(".fields:visible tbody").append(data);
                $(".fields:visible").find(".searchField").closest("tr").hide();
                $(".fields:visible").find(".searchField:hidden").slice(0, 10).closest("tr").show();

                if ($(".fields:visible").find(".searchField").size() > 10) {
                    $("#showMoreFields").text("Показать ещё найденные поля  (всего " + $(".fields:visible").find(".searchField").size() + ")").show();
                }

            }
        });

    }

});


$(document).on("click", "#showMoreFields", function() {

    $(".fields:visible").find(".searchField:hidden").slice(-10).closest("tr").show();

    if ($(".fields:visible").find(".searchField:visible").size() == $(".fields:visible").find(".searchField").size()) {
        $("#showMoreFields").hide();
    }

});


$(document).on("click", "#modalTz table td", function(event) {

    $("#nameSubservice:visible").val($(this).text());

    if ($("#modalAddField:hidden").size() > 0 && $("#modalAddStep:hidden").size() > 0) {

        $("#showMoreFields").hide();

        $.ajax({
            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=searchField&searchString=" + $(this).text().replace("#", "") + "",

            success: function(data) {

                $(".fields:visible").find("input[type=checkbox]").not(":checked").each(function() {
                    $(this).closest("tr").remove();
                });

                $(".fields:visible tbody").find("tr").removeClass("searchField");

                $(".fields:visible tbody").append(data);
                $(".fields:visible").find(".searchField").closest("tr").hide();
                $(".fields:visible").find(".searchField:hidden").slice(0, 10).closest("tr").show();

                if ($(".fields:visible").find(".searchField").size() > 10) {
                    $("#showMoreFields").text("Показать ещё найденные поля  (всего " + $(".fields:visible").find(".searchField").size() + ")").show();
                }
            }
        });

    }


    if ($("#modalAddField:hidden").size() < 1) {

        $("#addType option[value='" + $(this).text().trim() + "']").attr("selected", true);

        if ($(this).text().indexOf('#') + 1) {
            $("#addName").val($(this).text().replace("#", ""));
            $("#addClass").val($(this).text().replace("#", ""));
        }

        if ($(this).text().indexOf('+') + 1) {
            if (!$("#addRequired").is(":checked")) {
                $("#addRequired").attr("checked", true).val("1");
            }
        }


        if ($(this).text().trim() !== '-' && $(this).text().indexOf('#') < 0 && $(this).text().indexOf('+') < 0 && $("#addType option[value='" + $(this).text().trim() + "']").length < 1) {
            $("#addLabel").val($(this).text());
        }

    }


    if ($("#modalAddStep:visible").size() > 0) {

        $("#stepName").val($(this).text());
        searchStep(event = "searchStep");

    }

});



$("#cloneStep").click(function() {
    if ($(this).is(":checked")) {
        $(this).val('1');
        $("#cloneBlockMin").val('1').show();
        $("#cloneBlockMax").val('').show();
        $("#cloneBlockName").val('').show();
    } else {
        $(this).val('0');
        $("#cloneBlockMin").val('').hide();
        $("#cloneBlockMax").val('').hide();
        $("#cloneBlockName").val('').hide();
    }
});


$("span").click(function() {
    $(this).find('input[type=checkbox]').val('0');
    $(this).find('input[type=checkbox]:checked').val('1');
});


function fields(idField, checked, editForm, idStep) {

    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=queryFields&idForm=" + $("#idForm").val() + "&idField=" + idField + "&checked=" + checked + "&editForm=" + editForm + "&idStep=" + idStep + "",
        success: function(data) {

            if (idField !== "" && idField !== "undefined" && editForm != true) {
                $(".fields:visible:last tbody").append(data);
            }

            if (editForm === true) {
                $(".fields:last tbody").append(data);
            }

        }

    });

}


$(document).on("click", ".searchSubservice", function() {

    $.ajax({
        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=searchSubservice&searchSubserviceString=" + $("#searchSubserviceString").val() + "&nameSubservice=" + $("#nameSubservice").val() + "",

        success: function(data) {
            $('#modalSubservice').find("input[type=text]").val('');
            $("#modalSubservice").modal("hide");

            if (data.indexOf("error") >= 0) {
                alert(data.split(":")[1]);
                document.location.reload();
                return false;
            }

            if (data.indexOf("edit") >= 0) {

                if (confirm('Для данной услуги уже создана форма! Перейти в режим редактирования формы ?')) {
                    data = (data.split(":")[1]);
                    $("#idForm").val(data);

                    loadForm();

                    $("#myTab li").each(function() {

                        $("#blocksFields .table:last").after($("#blocksFields .table:first").clone());
                        $("#blocksFields .table:last").addClass("fields");

                        fields(null, null, true, $(this).find("a").attr("id"));

                    });

                } else {
                    document.location.reload();
                    return false;
                }

            } else {

                $("#applicant").modal("show");

            }

            $("#idForm").val(data);
            $("#myTab").find("a:first").click();
            $(".fields").tableDnD();

        }

    });

});



$("#modalSubservice").keypress(function(e) {
    if (e.keyCode == 13) {
        $(".searchSubservice").click();
    }
});




$(document).on("click", "a[href=#modalAddField]", function() {
    $('#modalAddField').find("select option:selected").removeAttr("selected");
    $('#modalAddField').find("input[type=checkbox]").removeAttr("checked").val("0");
    $('#modalAddField').find("input[type=text]").val('');
    $('#modalAddField').find("textarea").val('');
    $('#editField').val("");
});


$(document).on("click", ".icon-pencil", function() {

    $('#modalAddField').find("select option:selected").removeAttr("selected");
    $('#modalAddField').find("input[type=checkbox]").removeAttr("checked").val("0");
    $('#modalAddField').find("input[type=text]").val('');
    $('#modalAddField').find("textarea").val('');
    $('#editField').val("");

    var id = $(this).closest("tr").find("input").attr("id");

    $.ajax({
        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=queryEditField&idField=" + id + "",

        success: function(data) {
            response = JSON.parse(data);
            $('#modalAddField').modal("show");
            $('#addLabel').val(response.data[0].label);
            $('#addName').val(response.data[0].name);
            $('#addClass').val(response.data[0].class);
            $('#addMaxlength').val(response.data[0].maxlength);
            $('#addDictionary').val(response.data[0].dictionary);
            $('#addComment').val(response.data[0].comment);
            $('#addPlaceholder').val(response.data[0].placeholder);
            $('#addValue').val(response.data[0].value);
            $('#addMask').val(response.data[0].mask);

            $("#addType option[value='" + response.data[0].type + "']").attr("selected", true);
            $("#addFormat option[value='" + response.data[0].format + "']").attr("selected", true);

            if (response.data[0].clone == 1) {
                $('#addClone').val("1").attr("checked", true);
            } else {
                $('#addClone').val("0").attr("checked", false);
            }

            if (response.data[0].required == 1) {
                $('#addRequired').val("1").attr("checked", true);
            } else {
                $('#addRequired').val("0").attr("checked", false);
            }

            if (response.data[0].disabled == 1) {
                $('#addDisabled').val("1").attr("checked", true);
            } else {
                $('#addDisabled').val("0").attr("checked", false);
            }

            if (response.data[0].hidden == 1) {
                $('#addHidden').val("1").attr("checked", true);
            } else {
                $('#addHidden').val("0").attr("checked", false);
            }

            if (response.data[0].header == 1) {
                $('#addHeader').val("1").attr("checked", true);
            } else {
                $('#addHeader').val("0").attr("checked", false);
            }

            $('#editField').val(id);

        }
    });

});



$(document).on("click", ".addStep", function() {

    var createStep = "true";

    if ($("#stepsList li:contains(" + $("#stepName").val() + ")").length > 0) {
        var tieStep = "true";
        createStep = "false";
        var idStep = $("#stepsList li:contains(" + $("#stepName").val() + ")").attr("id");
    }


    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addStep&idStep=" + idStep + "&tieStep=" + tieStep + "&createStep=" + createStep + "&stepName=" + $("#stepName").val() + "&idForm=" + $("#idForm").val() + "&cloneStep=" + $("#cloneStep").val() + "&cloneBlockMin=" + $("#cloneBlockMin").val() + "&cloneBlockMax=" + $("#cloneBlockMax").val() + "&cloneBlockName=" + $("#cloneBlockName").val() + "",
        success: function(data) {

            $('#modalAddStep').find("input[type=text]").val('');
            $('#modalAddStep').modal("hide");

            loadForm();

            alert("Шаг успешно добавлен!");

            $(".fields").hide();
            $("#myTab").find("li:last").click();
            $("#myTab").find("a:last").click();

            if (idStep != "undefined") {
                $('#activeStep').val(idStep);
            }

            if (data != "undefined" && data != "") {
                $('#activeStep').val(data);
            }


            $("#blocksFields .table:last").after($("#blocksFields .table:first").clone());
            $("#blocksFields .table:last").addClass("fields");
            $("#myTab a:last").click();


        }
    });
});


$(document).on("click", "#myTab a", function(e) {

    if (!$(this).is("span")) {
        $('#activeStep').val($(this).attr('id'));
        $(".fields").hide();
        $(".fields").eq($(this).closest("li").index()).show();

        if ($(".fields:visible tr").size() > 10) {
            $(".search-buttons_block").show();
        } else {
            $(".search-buttons_block").hide();
        }

    }
});



$(document).on("click", ".deleteStep", function() {

    if (confirm('Удалить шаг "' + $(this).prevAll("a").text() + '" ?')) {

        $.ajax({
            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=deleteStep&idStep=" + $(this).prevAll("a").attr("id") + "&idForm=" + $("#idForm").val() + "",
            success: function() {
                $(".fields").eq($(this).closest("li").index()).remove();
                loadForm();
                $("#myTab a:first").click();
            }
        });

    } else {
        return false;
    }

});


$('#startUploadTz').click(function(e) {

    e.preventDefault();

    var fd = new FormData();
    fd.append('fileTz', $('#fileTz')[0].files[0]);

    $.ajax({
        type: 'POST',
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=uploadTz",
        data: fd,
        async: false,
        beforeSend: function() {
            $("#startUploadTz").attr("disabled", "disabled");
        },
        processData: false,
        contentType: false,
        success: function(data) {
            $("#modalTz .modal-body").html(data);
        }
    });

    $("#startUploadTz").removeAttr("disabled");

});


function addSortingFields() {

    var listFields = "";

    $(".fields:visible input:checked").each(function() {
        listFields += $(this).attr("id") + ",";
    });

    if (wListFields != listFields) {
        $.ajax({

            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addSortingFields&idForm=" + $("#idForm").val() + "&idStep=" + $("#activeStep").val() + "&listFields=" + listFields + "",
            success: function(data) {
                loadForm();
            }

        });
    }

    wListFields = listFields;
}


function addSortingSteps() {

    var listSteps = "";

    $(".listSteps:visible tr").each(function() {
        listSteps += $(this).attr("id") + ",";
    });

    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addSortingSteps&idForm=" + $("#idForm").val() + "&listSteps=" + listSteps + "",
        success: function(data) {
            loadForm();

            $("#blocksFields").find(".fields").remove();

            $("#myTab li").each(function() {

                $("#blocksFields .table:last").after($("#blocksFields .table:first").clone());
                $("#blocksFields .table:last").addClass("fields");

                fields(null, null, true, $(this).find("a").attr("id"));

            });

            $("#generateForm #myTab a:first").tab("show");

        }

    });

}



$(document).on("mouseup", ".fields td", function() {
    if ($(this).find("input").size() > 0) {
        return false;
    }
    addSortingFields();
});


$(document).on("mouseup", ".listSteps td", function() {
    addSortingSteps();
});


$(document).on("click", "#showSource", function() {

    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=loadSource&idForm=" + $("#idForm").val() + "",
        success: function(data) {
            $("#source").val(data);
        }
    });

});



$(".fullSource").toggle(
    function() {
        $("#source").closest("pre").hide();
        $("#fullSource").closest("pre").show();
        $(".fullSource").removeClass("btn btn-primary").addClass("btn btn-danger");
    },
    function() {
        $("#source").closest("pre").show();
        $("#fullSource").closest("pre").hide();
        $(".fullSource").removeClass("btn btn-danger").addClass("btn btn-primary");
    }
);


$(document).on("click", ".saveSource", function() {

    $.ajax({

        type: "POST",
        async: false,
        data: {
            "action": "saveSource",
            "idForm": $("#idForm").val(),
            "source": $("#source").val()
        },
        url: "/modules/auth/ajax.php"
    });

    $("#modalSource").modal("hide");
});


$(document).on("click", ".saveApplicant", function() {

    if ($("#idForm").val() == "" || $("#idForm").val() == "undefined") {
        alert("Форма не найдена!");
        document.location.reload();
        return false;
    }

    if ($("#applicant input:checked").size() > 1) {

        var applicants = "";

        $("#applicant input:checked").each(function() {
            applicants += $(this).val() + ",";
        });

        $.ajax({
            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addStepsApplicants&applicants=" + applicants + "&idForm=" + $("#idForm").val() + "",
            success: function() {

                loadForm();

                $("#myTab li").each(function() {

                    $("#blocksFields .table:last").after($("#blocksFields .table:first").clone());
                    $("#blocksFields .table:last").addClass("fields");

                    fields(null, null, true, $(this).find("a").attr("id"));

                });


            }
        });

    }

    $("#applicant").modal("hide");

});


$(document).on("click", ".icon-trash", function() {
    $(".fields:visible input").not(":checked").closest("tr").remove();
    $(".searchString").val("");
    $("#showMoreFields").hide();

    if ($(".fields:visible tr").size() > 10) {
        $(".search-buttons_block").show();
    } else {
        $(".search-buttons_block").hide();
    }

});



$(document).on("click", ".condition:visible .listFields:first option", function() {

    if ($("#modalSearchConditions:visible").size() > 0) {

        $.ajax({

            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=searchConditions&element=" + $(this).val() + "",
            success: function(data) {

                $(".blockSearchConditions").html("");
                $(".blockSearchConditions").prepend(data);
            }
        });
    }

});



$(document).on("dblclick", ".searchCondition ", function() {

    var selectedField = $(".condition:visible").find("option:selected").val();

    if ($(this).hasClass("conditionAdded")) {
        return false;
    }

    $.ajax({
        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addCondition&idForm=" + $("#idForm").val() + "&element=" + $(this).find(".searchConditionElement").val() + "&actionElement=" + $(this).find(".searchConditionAction").val() + "&condition=" + $(this).find(".searchConditionSource").val() + ""
    });

    $(this).css("opacity", "0.2").addClass("conditionAdded");



    $(".loadCondition").remove();
    $(".condition").not(":first").remove();

    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=loadConditions&idForm=" + $("#idForm").val() + "",
        success: function(data) {
            $(".blockConditions").prepend(data);
        }
    });

    $(".addCondition").click();
    $(".condition:visible:last").find("option[value='" + selectedField + "']").attr("selected", true);

});



$(document).on("click", "#showConditions", function() {

    $(".blockSearchConditions").html("");
    $(".loadCondition").remove();
    $(".condition").not(":first").remove();

    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=loadConditions&idForm=" + $("#idForm").val() + "",
        success: function(data) {
            $(".blockConditions").prepend(data);
        }
    });


    $(".listFields .header_clone_blocks").remove();
    $(".listFields .field_clone_block").remove();
    $(".listFields .header_statictext").remove();
    $(".listFields .field_statictext").remove();
    $(".listFields .header_steps").remove();
    $(".listFields .field_steps").remove();

    $(".listFields option").not(":first").remove();

    $(".fields .bindField:checked").each(function() {

        var title = $(this).closest("tr").find("td").eq(1).text();

        var text = $(this).closest("tr").find("td").eq(1).text().substr(0, 50);

        var value = $(this).closest("tr").find("td").eq(2).text();

        if ($(this).closest("tr").find("td").eq(3).text() != "statictext document") {

            $(".listFields").append("<option value='[" + value + "]' title='" + title + "'>" + text + "... <strong>[ " + value + " ]<strong></option>");

        }

    });


    //Сортировка по алфавиту    <<<
    /*
        var mylist = $('.listFields');
        var listitems = mylist.children('option').get();
        listitems.sort(function (a, b) {
            var compA = $(a).text().toUpperCase();
            var compB = $(b).text().toUpperCase();
            return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
        })
        $.each(listitems, function (idx, itm) {
            mylist.append(itm);
        });
		*/
    //  >>>


    $(".listFields:first").each(function() {

        $(this).find("option").each(function() {

            if ($(".listFields:first").find("option[value='" + $(this).val() + "']").size() > 1) {
                $(".listFields:first").find("option[value='" + $(this).val() + "']:last").remove();
            }

        });

    });


    $(".listFields:last").each(function() {

        $(this).find("option").each(function() {

            if ($(".listFields:last").find("option[value='" + $(this).val() + "']").size() > 1) {
                $(".listFields:last").find("option[value='" + $(this).val() + "']:last").remove();
            }

        });

    });




    $(".condition:first").find(".listFields").prepend("<option class='header_steps' disabled='disabled' style='background-color: #BFB340; color: #FFFFFF; font-weight: bold;'>--- шаги ---</option>");

    $("#myTab a").each(function() {
        $(".condition:first").find(".listFields .header_steps").after("<option class='field_steps' style='background-color: #BFB340; color: #FFFFFF;' value='" + $(this).text() + "' title='" + $(this).text() + "'>" + $(this).text() + "</option>");
    });


    $(".condition:first").find(".listFields").prepend("<option class='header_statictext' disabled='disabled' style='background-color: #3A87AD; color: #FFFFFF; font-weight: bold;'>--- заголовки ---</option>");

    $("#generateForm div.statictext").each(function() {
        $(".condition:first").find(".listFields .header_statictext").after("<option class='field_statictext' style='background-color: #3A87AD; color: #FFFFFF;' value='" + $(this).text() + "' title='" + $(this).text() + "'>" + $(this).text() + "</option>");
    });




    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=queryConditionCloneBlock&idForm=" + $("#idForm").val() + "",

        success: function(data) {

            if (data.length > 0) {
                response = JSON.parse(data);

                $(".condition:first").find(".listFields").prepend("<option class='header_clone_blocks' disabled='disabled' style='background-color: #008000; color: #FFFFFF; font-weight: bold;'>--- клонируемые блоки ---</option>");

                for (i = 0; i < response.data.length; i++) {
                    $(".condition:first").find(".listFields .header_clone_blocks").after("<option class='field_clone_block' style='background-color: #008000; color: #FFFFFF;'>" + response.data[i].name + "</option>");
                }
            }

        }
    });

});


$(document).on("click", ".addCondition", function() {

    $(".condition:last").after($(".condition:first").clone());
    $(".condition").not(":first").show();
    //$(".condition:last").css("margin-bottom","240px");

    $("#modalConditions .modal-body").animate({
        "scrollTop": $("#modalConditions .blockConditions").height()
    }, "0.1");


});


$(document).on("click", ".condition .icon-plus", function() {

    $(this).closest(".condition").find(".clone_condition:last").after($(".clone_condition:first").clone());
    $(this).closest(".condition").find(".icon-retweet").not(":first").show();
    $(this).closest(".condition").find(".icon-remove-sign").not(":first").show();
    $(this).closest(".condition").find(".icon-plus").not(":last").hide();
    $(this).closest(".condition").find(".additional_condition").not(":first").show();

    $("#modalConditions .modal-body").animate({
        "scrollTop": $("#modalConditions .blockConditions").height()
    }, "0.1");

});


$(document).on("click", ".condition .icon-remove-sign", function() {
    $(this).closest(".clone_condition").remove();
    $(".condition").find(".icon-plus:last").show();
});


$(document).on("change", ".searchListFields", function() {

    var searchListFields = $(this).val();

    $(this).nextAll(".listFields:first option").each(function() {
        if ($(this).text() == searchListFields || $(this).val() == searchListFields) {
            $(this).attr("selected", true);
        }
    });

});


$(document).on("click", ".saveConditions", function() {


    $(".condition input[type=text]:visible").not("input.values").each(function() {

        if ($(this).val() !== "true" && $(this).val() != "false" && $(this).val() != "" && isNaN($(this).val())) {
            $(this).val("'" + $(this).val() + "'");
        }

    });


    $(".condition:visible").each(function() {

        var blockCondition = $(this);

        condition = "";

        $(this).find(".clone_condition:visible").each(function() {

            $(this).find("*:visible").each(function() {
                if ($(this).is("select")) {
                    condition += " " + $(this).val();
                }

                if ($(this).is("input")) {
                    condition += " " + $(this).val();
                }

            });

        });



        $(this).find(".listFields:first option:selected").each(function() {

            element = $(this).val();

            blockCondition.find(".action option:selected").each(function() {

                action = $(this).val();

                if (action == "hidden") {

                    if ($(this).closest(".condition").find(".clone_condition:visible").size() > 0) {
                        condition = blockCondition.find("input.values").val() + " if" + condition;
                    } else {
                        condition += " " + blockCondition.find("input.values").val();
                    }

                }

                $.ajax({
                    type: "GET",
                    async: false,
                    url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=addCondition&idForm=" + $("#idForm").val() + "&element=" + element + "&actionElement=" + action + "&condition=" + condition + ""
                });

            });

        });

    });


    $("#modalConditions").modal("hide");

});


$(document).on("click", ".deleteCondition", function() {

    if (confirm('Удалить это условие?')) {

        $.ajax({
            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=deleteCondition&idCondition=" + $(this).closest(".loadCondition").attr("id") + "&idForm=" + $("#idForm").val() + ""
        });

        $(this).closest(".loadCondition").remove();

    } else {
        return false;
    }

});



$(document).on("click", ".icon-chevron-right", function() {
    $("#modalConditions").attr("style", "width: 1000px; left: 20%; top: 30%;");
    $("#modalSearchConditions").show();
    $(".icon-chevron-left").show();
    $(this).hide();
});


$(document).on("click", ".icon-chevron-left", function() {
    $("#modalConditions").attr("style", "width: 1000px; left: 40%; top: 30%;");
    $("#modalSearchConditions").hide();
    $(".icon-chevron-right").show();
    $(this).hide();
});



$(document).on("change", ".action", function() {

    if ($(this).find("option:selected").val() == "hidden") {

        $(this).closest(".condition").find(".values").hide().val("").find("option").remove();

        var element = $(this).closest(".condition").find(".listFields:first option:selected").val().replace("[", "").replace("]", "");

        var html = $("select[name=" + element + "]").html();

        if (html != "" && html != undefined) {

            $(this).closest(".condition").find("select.values").html(html).show().find("option:first").remove();
            $(this).closest(".condition").find("input.values").show();

            $(this).closest(".condition").find("input.values").width($(this).closest(".condition").find("select.values").width());

            $(this).closest(".condition").find(".clone_condition").hide();

        } else {
            $(this).closest(".condition").find("input.values").show();
            $(this).closest(".condition").find("select.values").hide();
            $(this).closest(".condition").find(".clone_condition").hide();
        }

    } else {

        $(this).closest(".condition").find(".values").hide().val("").find("option").remove();
        $(this).closest(".condition").find(".clone_condition").show();

    }

});



$(document).on("click", ".if", function() {
    if ($(this).closest(".condition").find(".action").val() == "hidden") {
        $(this).closest(".condition").find(".clone_condition").show();
    }
});



$(document).on("change", "#autoCreateCloneBlock", function() {

    var cloneBlockName = $("#autoCreateCloneBlock").val().replace('_type', '').replace('#', '').trim();
    $(".listFields_cloneBlocks").find("option[value^='" + cloneBlockName + "']").attr("selected", true).change();
    $(".listFields_cloneBlocks").find("option[value='" + cloneBlockName + "_provide']").attr("selected", false).change();
    $("#modalCloneBlocks .position").find("option[value='" + cloneBlockName + "_organization']");
    $("#autoCreateCloneBlock").val("");
    $(".blockName").val(cloneBlockName);

    if ($("#generateForm").find("select[name='" + cloneBlockName + "_type']").size() < 1) {
        $(".listFields_cloneBlocks").find("option[value='" + cloneBlockName + "_type']").attr("selected", false).change();
    }

});


$(document).on("change", "select[multiple=multiple].values", function() {

    $("#modalCloneBlocks").find("textarea.values option").show();

    var values = "";

    $(this).find("option[value != '']:selected").each(function() {
        values += $(this).val().replace(/,/gi, '|').trim() + ", ";
        //$("#modalCloneBlocks").find("select.position option[value='" + $(this).val() + "']").hide();
    });

    $(this).closest(".condition").find("input.values").val(values.slice(0, -2).trim());
    $(this).closest("#modalCloneBlocks").find("textarea.values").val(values.slice(0, -2).trim());

});




$(document).on("click", "#showCloneBlocks", function() {

    $(".loadCloneBlock").remove();

    $("#modalCloneBlocks").find("*").each(function() {
        $(this).val("").attr("checked", false).attr("selected", false);
    });


    $.ajax({

        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=loadCloneBlocks&idForm=" + $("#idForm").val() + "&idStep=" + $("#activeStep").val() + "",
        success: function(data) {
            $("#modalCloneBlocks .modal-body").prepend(data);
        }
    });


    $(".listFields_cloneBlocks option").remove();


    $(".fields:visible .bindField:checked").each(function() {

        var title = $(this).closest("tr").find("td").eq(1).text();

        var text = $(this).closest("tr").find("td").eq(1).text().substr(0, 50);

        var value = $(this).closest("tr").find("td").eq(2).text();

        if (value == "") {

            value = $(this).closest("tr").find("td").eq(1).text();

        }

        $(".listFields_cloneBlocks").append("<option value='" + value.trim() + "' title='" + title + "'>" + text + "...[ " + value + " ]</option>");

    });

    $(".listFields_cloneBlocks:last").prepend("<option value='after' selected='selected'>разместить блок в самом низу</option><option value='before'>разместить блок в самом верху</option>");


    $(".listFields_cloneBlocks:first").each(function() {

        $(this).find("option").each(function() {

            if ($(".listFields_cloneBlocks:first").find("option[value='" + $(this).val() + "']").size() > 1) {
                $(".listFields_cloneBlocks:first").find("option[value='" + $(this).val() + "']:last").remove();
            }

        });

    });

    $("#modalCloneBlocks .modal-body").animate({
        "scrollTop": $("#modalCloneBlocks .modal-body").height() + 10000
    }, "0.1");


});


$(document).on("click", ".saveCloneBlocks", function() {

    var fields = $("#modalCloneBlocks").find("textarea.values").val();
    var position = $("#modalCloneBlocks").find("select.position option:selected").val();
    var name = $("#modalCloneBlocks").find(".blockName").val();

    if ($("#idCloneBlock").val() != "") {
        var action = "editCloneBlock";
    } else {
        var action = "addCloneBlock";
    }



    $.ajax({
        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=" + action + "&idForm=" + $("#idForm").val() + "&idStep=" + $("#activeStep").val() + "&fields=" + fields + "&blockName=" + name + "&position=" + position + "&idCloneBlock=" + $("#idCloneBlock").val() + ""
    });

    $("#modalCloneBlocks").modal("hide");

});




$(document).on("click", ".editCloneBlock", function() {

    var id = $(this).closest(".loadCloneBlock").attr("id");

    $.ajax({
        type: "GET",
        async: false,
        url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=queryEditCloneBlock&idCloneBlock=" + id + "",

        success: function(data) {
            response = JSON.parse(data);

            $("#modalCloneBlocks").find("textarea.values").val(response.data[0].fields);
            $("#modalCloneBlocks").find(".blockName").val(response.data[0].name);

            var arr = response.data[0].fields.split(",");

            $("#modalCloneBlocks").find("select.values option").attr("selected", false);

            for (var i = 0, len = arr.length; i < len; i++) {
                $("#modalCloneBlocks").find("select.values option[value='" + arr[i].replace(/&#44/gi, ',').trim() + "']").attr("selected", true);
            }

            $("#modalCloneBlocks").find("select.position option[value='" + response.data[0].position + "']").attr("selected", true);

            $('#idCloneBlock').val(id);

        }
    });

});




$(document).on("click", ".buttonDeleteCloneBlock", function() {

    if (confirm('Удалить клонируемый блок?')) {

        $.ajax({
            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=deleteCloneBlock&idCloneBlock=" + $(this).closest(".loadCloneBlock").attr("id") + ""
        });

        $("#modalCloneBlocks").modal("hide");


    } else {
        return false;
    }

});



$(document).on("click", ".copyConditions", function() {
    if ($(this).is(":checked")) {
        $(this).val("true");
    } else {
        $(this).val("");
    }
});


$(document).on("click", ".copyCloneBlocks", function() {
    if ($(this).is(":checked")) {
        $(this).val("true");
    } else {
        $(this).val("");
    }
});


$(document).on("click", ".startCopyForm", function() {

    if ($(".copySubservice").val().length > 0) {

        $.ajax({
            type: "GET",
            async: false,
            url: "/modules/auth/ajax.php?module_name=webservice&name=generateForms&action=copyForm&idForm=" + $("#idForm").val() + "&copySubservice=" + $(".copySubservice").val().trim() + "&copyConditions=" + $(".copyConditions").val().trim() + "&copyCloneBlocks=" + $(".copyCloneBlocks").val().trim() + ""
        });

        document.location.reload();

    } else {
        $(".copySubservice").addClass("error");
        return false;
    }

});




$(document).on("click", ".clone_condition .icon-retweet", function() {

    var values = prompt("Значения для условий");

    if (values != null && values != "") {

        var arr = values.trim().split(" ");

        for (var i = 0, len = arr.length; i < len; i++) {

            $(".clone_condition:last").after($(this).closest(".clone_condition").clone());

            $(".clone_condition:last .additional_condition").
            find("option[value='" + $(this).closest(".clone_condition").find(".additional_condition option:selected").val() + "']").attr("selected", true);

            $(".clone_condition:last .listFields").
            find("option[value='" + $(this).closest(".clone_condition").find(".listFields option:selected").val() + "']").attr("selected", true);

            $(".clone_condition:last select:last").
            find("option[value='" + $(this).closest(".clone_condition").find("select:last option:selected").val() + "']").attr("selected", true);

            $(".clone_condition:last input").val(arr[i].trim());
        }
        $("#modalConditions .modal-body").animate({
            "scrollTop": $("#modalConditions .blockConditions").height()
        }, "0.1");

    }

});


$(document).on("click", "a[href=#modalAddStep]", function() {

    $(".listSteps tbody tr").remove();

    $("#myTab").find("a").each(function() {
        $(".listSteps tbody").append("<tr id='" + $(this).attr("id") + "'><td>" + $(this).text() + "</td></tr>");
    });

    $(".listSteps").tableDnD();

});


$(document).on("click", "#showRoute", function() {

    var route = "";
    var listFields = [];

    $("#generateForm").find("*").each(function() {

        if ($(this).is("select[dictionary]") && $(this).closest(".cloneBlock").size() < 1 && listFields.indexOf($(this).attr("name")) < 0) {

            route += '<activiti:formProperty id="' + $(this).attr("name") + '" name="' + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + '" type="directory" variable="' + $(this).attr("name") + '">\n\t<activiti:value id="directory_id" name="' + $(this).attr("dictionary") + '"></activiti:value>\n</activiti:formProperty>\n';

        }

        if ($(this).is("input[type=text]") && $(this).hasClass("datepicker") && $(this).closest(".cloneBlock").size() < 1 && listFields.indexOf($(this).attr("name")) < 0) {

            route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='date' variable='" + $(this).attr("name") + "'></activiti:formProperty>\n";

        }


        if ($(this).is("input[type=hidden]") && $(this).hasClass("document_value") && $(this).closest(".cloneBlock").size() < 1 && listFields.indexOf($(this).attr("name")) < 0) {

            route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='enum' variable='" + $(this).attr("name") + "' default='" + $(this).val() + "' writable='false'>\n\t<activiti:value id='" + $(this).val() + "' name=''></activiti:value>\n\t</activiti:formProperty>\n";

        }


        if (($(this).is("input[type=text]") || $(this).is("textarea")) && !$(this).hasClass("datepicker") && $(this).closest(".cloneBlock").size() < 1 && listFields.indexOf($(this).attr("name")) < 0) {

            route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='string' variable='" + $(this).attr("name") + "'></activiti:formProperty>\n";

        }

        if ($(this).is("input[type=checkbox]") && $(this).closest(".cloneBlock").size() < 1 && listFields.indexOf($(this).attr("name")) < 0) {

            route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='boolean' variable='" + $(this).attr("name") + "'></activiti:formProperty>\n";

        }


        if ($(this).is("table[block]")) {
            route += "<activiti:formProperty id='+" + $(this).attr("block") + "' name='' variable='" + $(this).attr("block") + "' default='1'></activiti:formProperty>\n";


            $(this).find("*").each(function() {

                if ($(this).is("select[dictionary]")) {

                    route += '<activiti:formProperty id="' + $(this).attr("name") + '" name="' + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + '" type="directory" variable="' + $(this).attr("name") + '">\n\t<activiti:value id="directory_id" name="' + $(this).attr("dictionary") + '"></activiti:value>\n</activiti:formProperty>\n';

                }


                if ($(this).is("input[type=hidden]") && $(this).hasClass("document_value")) {

                    route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='enum' variable='" + $(this).attr("name") + "' default='" + $(this).val() + "' writable='false'>\n\t<activiti:value id='" + $(this).val() + "' name=''></activiti:value>\n\t</activiti:formProperty>\n";

                }

                if ($(this).is("input[type=text]") && $(this).hasClass("datepicker")) {

                    route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='date' variable='" + $(this).attr("name") + "'></activiti:formProperty>\n";

                }

                if (($(this).is("input[type=text]") || $(this).is("textarea")) && !$(this).hasClass("datepicker")) {

                    route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='string' variable='" + $(this).attr("name") + "'></activiti:formProperty>\n";

                }

                if ($(this).is("input[type=checkbox]")) {

                    route += "<activiti:formProperty id='" + $(this).attr("name") + "' name='" + $(this).closest("tr").find("td:first").text().replace('*', '').trim() + "' type='boolean' variable='" + $(this).attr("name") + "'></activiti:formProperty>\n";

                }

            });


            route += "<activiti:formProperty id='-" + $(this).attr("block") + "'></activiti:formProperty>\n";
        }

        if ($(this).attr("name") != undefined && $(this).attr("name") != "") {
            listFields.push($(this).attr("name"));
        }

    });

    $("#route").val(route.replace(/'/g, '"')).select();

});


$(document).on("click", ".createDublicateService", function() {
    $("#duplicateService").modal("show");
});




$(document).on("click", "#showExternalForm", function() {


    window.externalFormSource = "";

    if ($("#generateForm").find("select[dictionary!='']").size() > 0) {

        externalFormSource += '\tvar dictionaries = {\r\n\r\n';

        $("#generateForm").find("select[dictionary!='']").each(function() {
            externalFormSource += '\t\t"' + $(this).attr('dictionary') + '" : ["' + $(this).attr('name') + '"],\n';
        });

        externalFormSource += '\r\n\t}';


    }



    if ($("#generateForm").find("input.document_value").size() > 0) {

        externalFormSource += '\r\n\r\n\tvar emuns = {\r\n\r\n';

        $("#generateForm").find("input.document_value").each(function() {
            externalFormSource += '\t\t[{key : "' + $(this).attr('value') + '", name : "' + $(this).closest('tr').prev('tr').find('div.statictext').attr('name') + '"}],\r\n'
        });

        externalFormSource += '\r\n\t}';


    }

    $("#externalFormSource").val(externalFormSource);



    $(".externalFormListFields option").not(":first").remove();

    $(".fields .bindField:checked").each(function() {

        var title = $(this).closest("tr").find("td").eq(1).text();

        var text = $(this).closest("tr").find("td").eq(1).text().substr(0, 50);

        var value = $(this).closest("tr").find("td").eq(2).text();

        if ($(this).closest("tr").find("td").eq(3).text() != "statictext document") {

            $(".externalFormListFields").append("<option value='[" + value + "]' title='" + title + "'>" + text + "... <strong>[ " + value + " ]<strong></option>");

        }

    });



});

});
   
</script>
<input placeholder="Поиск полей" type="text" class="searchString" name="searchString" style="width: 350px;"> <span class="icon-trash" style="cursor: pointer;"></span>
<input type="hidden" class="searchStringDocs">
<div style="float: right; text-align: left;">
   <a href="#modalCloneBlocks" id="showCloneBlocks" role="button" class="btn" data-toggle="modal">Клонируемые блоки</a>
   <a href="#modalConditions" id="showConditions" role="button" class="btn" data-toggle="modal">Условия для полей</a>
   <a href="#modalAddField" role="button" class="btn" data-toggle="modal">Добавить поле</a>
   <a href="#modalAddStep" role="button" class="btn" data-toggle="modal">Добавить шаг</a> 
   <a href="#modalTz" role="button" class="btn" data-toggle="modal">Открыть ТЗ</a>
   <a href="#modalSource" id="showSource" role="button" class="btn" data-toggle="modal">Исходный код</a>
   <!-- <a href="#modalRoute" id="showRoute" role="button" class="btn" data-toggle="modal">Маршрут</a> -->
   <a href="#modalCopyForm" role="button" class="btn" data-toggle="modal">Копировать форму</a>
   <a href="#modalExternalForm" id="showExternalForm" role="button" class="btn" data-toggle="modal">Внешняя форма</a>
</div>
<div class="modal" id="modalExternalForm" style="display: none; width: 1200px; margin-bottom: 30px; left: 30%; top: 30%;" tabindex="-1" role="dialog" aria-labelledby="modalExternalForm" aria-hidden="true">
   <div class="modal-header">
      <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      <h3>Внешняя форма</h3>
   </div>
   <div class="modal-body" style="text-valign: top; max-height: 700px;">
      <!-- 
         <select class="externalFormListFields" style="width: auto; font-size: 16px; height: 250px;" multiple="multiple">
                   <option style='background-color: #646464; color: #FFFFFF;' value="" disabled="disabled">--- поля ---</option>
               </select> 
         -->
      <pre><textarea style="height: 300px; width: 98%; margin: 5px;" id="externalFormSource"></textarea></pre>
   </div>
   <div class="modal-footer">
      <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button> -->
      <!-- <button class="btn btn-primary">Начать</button> -->
   </div>
</div>
<div class="modal" id="modalCopyForm" style="display: none; width: 550px; margin-bottom: 30px;" tabindex="-1" role="dialog" aria-labelledby="modalCopyForm" aria-hidden="true">
   <div class="modal-header">
      <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      <h3>Копирование формы</h3>
   </div>
   <div class="modal-body" style="text-valign: top;">
      <input type='checkbox' checked="checked" disabled="disabled" name="" style="margin-right: 20px;">Копирование шагов<br>
      <input type='checkbox' checked="checked" disabled="disabled" name="" style="margin-right: 20px;">Копирование полей<br>
      <input type='checkbox' checked="checked" value="true" class="copyConditions" name="copyConditions" style="margin-right: 20px;">Копирование условий<br>
      <input type='checkbox' checked="checked" value="true" class="copyCloneBlocks" name="copyCloneBlocks" style="margin-right: 20px;">Копирование клонируемых блоков
      <br><br>    
      <input placeholder="Реестровый номер копируемой подуслуги" type="text" name="copySubservice" class="copySubservice" style="width: 300px;">
   </div>
   <div class="modal-footer">
      <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button> -->
      <button class="btn btn-primary startCopyForm">Начать</button>
   </div>
</div>
<div class="modal" id="modalCloneBlocks" style="display: none; width: 845px; left: 40%; top: 30%;" tabindex="-1" role="dialog" aria-labelledby="createCloneBlock" aria-hidden="true" data-backdrop="static">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Клонируемые блоки</h3>
   </div>
   <div class="modal-body" style="text-valign: top; max-height: 700px;">
      <br>
      <input id="autoCreateCloneBlock" type="text" placeholder="Создать клон-блок по исходному названию поля" style="width: 785px;"> 
      <select class="listFields_cloneBlocks values" style="width: 800px; height: 200px; font-size: 16px;" multiple="multiple"></select><br><br>
      <textarea style="width: 785px; height: 100px;" class="values" placeholder="Список полей через запятую"></textarea>
      <br><br>
      <input placeholder="Название клонируемого-блока" type="text" class="blockName" style="width: 210px; text-align: center;">
      <!-- <input placeholder="min - кол-во блоков" type="text" class="cloneBlockMin" style="width: 210px; text-align: center;"> -->
      <!-- <input placeholder="max - кол-во блоков" type="text" class="cloneBlockMax" style="width: 210px; text-align: center;"> -->
      </br></br>
      <select class="listFields_cloneBlocks values position" style="width: 800px; font-size: 16px;">
         <option value="" selected="selected">--- разместить блок после поля ---</option>
         <option value="append">в самом низу</option>
         <option value="prepend">в самом верху</option>
      </select>
      <br><br>
      <input type="hidden" id="idCloneBlock" value=""> 
   </div>
   <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
      <button class="btn btn-primary saveCloneBlocks">Сохранить</button>
   </div>
</div>
<div class="modal" id="modalConditions" data-backdrop="static" style="display: none; width: 1000px; left: 40%; top: 30%;" tabindex="-1" role="dialog" aria-labelledby="modalConditions" aria-hidden="true">
   <div class="modal-header">
      <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      <h3 style="display: inline;">Условия для полей</h3>
      <span class="icon-chevron-right" style="float: right; cursor: pointer;" title="Поиск условий"></span>
      <span class="icon-chevron-left" style="float: right; cursor: pointer; display: none;" title="Поиск условий"></span>
   </div>
   <div class="modal-body" style="text-valign: top; max-height: 700px;">
      <div class="blockConditions">
         <div class="condition alert alert-info" style="display: none;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <!-- <input placeholder="Найти и выбрать поле" class="searchListFields" type="text"><br> -->
            <select class="listFields" style="width: auto; font-size: 16px; height: 250px;" multiple="multiple">
               <option style='background-color: #646464; color: #FFFFFF;' value="" disabled="disabled">--- поля ---</option>
            </select>
            <br>
            <select style="width: auto; font-size: 16px;" class="action" multiple="multiple">
               <option value="show">показать</option>
               <option value="required">обязательное</option>
               <option value="hidden">скрыть значения</option>
            </select>
            <span class="if"><strong>если</strong></span>
            <br>
            <select style="width: auto; font-size: 16px; height: 300px; max-width: 600px; min-width: 300px; display: none;" class="values" multiple="multiple"></select>
            <div><input placeholder="Значения через запятую" style="display: none;" class="values" type="text"></div>
            <div class="clone_condition">
               <select class="additional_condition" style="width: auto; font-size: 16px; display: none;">
                  <option value="" selected="selected">--- доп. условие ---</option>
                  <option value="AND">И</option>
                  <option value="||">ИЛИ</option>
               </select>
               <br>
               <select class="listFields" style="width: auto; font-size: 16px;">
                  <option value="" selected="selected">--- поле ---</option>
               </select>
               <br>
               <select style="width: auto; font-size: 16px;">
                  <option value="" disabled="disabled">--- условие ---</option>
                  <option selected="selected" value="==">равно</option>
                  <option value="!=">не равно</option>
                  <option value="><">больше или меньше</option>
                  <option value="<=">меньше или равно</option>
                  <option value=">=">больше или равно</option>
               </select>
               <input placeholder="значение" type="text">
               <span class="icon-retweet" style="cursor: pointer; display: none;"></span>
               <span class="icon-remove-sign" style="background-position: -456px 0; cursor: pointer; display: none;"></span>
               <span class="icon-plus" style="cursor: pointer;"></span>
            </div>
         </div>
      </div>
   </div>
   <div class="modal-footer">
      <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button> -->
      <button class="btn btn-primary saveConditions" style="float: right;">Сохранить</button>
      <span class="addCondition btn btn-success" style="font-size: 17px; float: right; margin-right: 30px;">Добавить</span>
   </div>
   <div class="modal" id="modalSearchConditions" data-backdrop="static" style="display: none; width: 750px; left: 73%; top: 30%;" tabindex="-1" role="dialog" aria-labelledby="modalSearchConditions" aria-hidden="true">
      <div class="modal-header">
         <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
         <h3 style="display: inline;">Поиск условий</h3>
      </div>
      <div class="modal-body" style="text-valign: top; max-height: 700px;">
         <div class="blockSearchConditions">
            <div class="searchCondition alert alert-info" style="display: none;">
               <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
         </div>
      </div>
   </div>
</div>
<div data-backdrop="static" class="modal" id="modalSubservice" style="display: none; width: 550px; margin-bottom: 30px;" tabindex="-1" role="dialog" aria-labelledby="modalAddFieldLabel" aria-hidden="true">
   <div class="modal-header">
      <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      <h3 id="modalAddFieldLabel">Выбор подуслуги</h3>
   </div>
   <div class="modal-body" style="text-valign: top;">
      <input placeholder="Введите реестровый номер подуслуги" type="text" id="searchSubserviceString" value="4818" name="searchSubserviceString" class="add" style="width: 500px;">
      <textarea placeholder="Введите название подуслуги" type="text" id="nameSubservice" name="nameSubservice" class="add" style="width: 500px;"></textarea>
   </div>
   <div class="modal-footer">
      <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button> -->
      <button class="btn btn-primary searchSubservice">Найти</button>
   </div>
</div>
<div class="modal" id="modalSource" style="display: none; width: 70%; top: 5%; height: 90%; left: 30%; margin-top: 0px;" tabindex="-1" role="dialog" aria-labelledby="modalSource" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Исходный код формы</h3>
   </div>
   <div class="modal-body" style="text-valign: top; max-height: none;">
      <pre><textarea style="height: 635px; width: 98%; margin: 5px;" id="source"></textarea></pre>
      <pre style="display: none;"><textarea style="height: 635px; width: 98%; margin: 5px;" id="fullSource"></textarea></pre>
   </div>
   <div class="modal-footer">
      <button class="btn btn-primary fullSource">Full code</button>
      <button class="btn btn-primary saveSource">Сохранить</button>
   </div>
</div>
<div class="modal" id="modalRoute" style="display: none; width: 70%; top: 5%; height: 90%; left: 30%; margin-top: 0px;" tabindex="-1" role="dialog" aria-labelledby="modalRoute" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Маршрут</h3>
   </div>
   <div class="modal-body" style="text-valign: top; max-height: none;">
      <pre><textarea style="height: 635px; width: 98%; margin: 5px;" id="route"></textarea></pre>
   </div>
   <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
   </div>
</div>
<div class="modal" id="applicant" style="display: none; width: 550px; margin-bottom: 30px;" tabindex="-1" role="dialog" aria-labelledby="applicant" aria-hidden="true">
   <div class="modal-header">
      <h3>Тип заявителя</h3>
   </div>
   <div class="modal-body" style="text-valign: top; max-height: none;">
      <label class="checkbox"><input type="checkbox" value="UL"> Юридическое лицо</label>
      <label class="checkbox"><input type="checkbox" value="IP"> Индивидуальный предприниматель</label>
      <label class="checkbox"><input type="checkbox" value="FL"> Физическое лицо</label>
   </div>
   <div class="modal-footer">
      <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button> -->
      <button class="btn btn-primary saveApplicant">Продолжить</button>
   </div>
</div>
<div class="modal" id="modalAddField" style="display: none; width: 730px; top: 30%" tabindex="-1" role="dialog" aria-labelledby="modalAddFieldLabel" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="modalAddFieldLabel">Параметры поля</h3>
   </div>
   <div class="modal-body" style="text-valign: top;">
      <textarea placeholder="Название" type="text" id="addLabel" name="addLabel" style="width: 670px; height: 70px; resize: none;"></textarea>
      <select id="addType" name="addType">
         <option value="">--- тип поля ---</option>
         <option value="textfield">Текстовое поле - input</option>
         <option value="textarea">Текстовая область - textarea</option>
         <option value="checkbox">Флажок - checkbox</option>
         ъ
         <option value="statictext">Статичный текст - statictext</option>
         <option value="customLookup">Список - customLookup</option>
         <option value="fileload">Файл - fileload</option>
         <option value="radio">Радиокнопка</option>
      </select>
      <select id="addFormat" name="addFormat">
         <option value="">--- формат поля ---</option>
         <option value="document">Документ</option>
         <option value="datepicker">Дата</option>
      </select>
      <br>
      <span>
      <label style="display: inline;" for="addRequired">Обязательное</label> 
      <input type='checkbox' id="addRequired" name="addRequired" style="margin-right: 20px;">
      </span>
      <span>
      <label style="display: inline;" for="addClone">Клонируемое</label> 
      <input type='checkbox' id="addClone" name="addClone" style="margin-right: 20px;">
      </span>
      <span>
      <label style="display: inline;" for="addDisabled">Нередактируемое</label> 
      <input type='checkbox' id="addDisabled" name="addDisabled" style="margin-right: 20px;">
      </span>
      <span>
      <label style="display: inline;" for="addHidden">Скрытое</label> 
      <input type='checkbox' id="addHidden" name="addHidden" style="margin-right: 20px;">
      </span>
      <span>
      <label style="display: inline;" for="addHeader">Заголовок</label> 
      <input type='checkbox' id="addHeader" name="addHeader">
      </span>
      <br><br>
      <input placeholder="Имя поля - виджет" title="Имя поля - виджет" type="text" id="addName" name="addName" style="width: 206px;">
      <input placeholder="Класс поля" title="Класс поля" type="text" id="addClass" name="addClass" style="width: 206px;">
      <input placeholder="Справочник" title="Справочник" type="text" id="addDictionary" name="addDictionary" style="width: 206px;">
      <input placeholder="Значение" title="Значение" type="text" id="addValue" name="addValue" style="width: 206px;">
      <input placeholder="Количество символов" title="Количество символов" type="text" id="addMaxlength" name="addMaxlength" style="width: 206px;">
      <input placeholder="Маска (пример: 999-99-999)" title="Маска" type="text" id="addMask" name="addMask" style="width: 206px;">
      <input placeholder="Комментарий" title="Комментарий" type="text" id="addComment" name="addComment" style="width: 206px;">
      <input placeholder="Подсказка" title="Подсказка" type="text" id="addPlaceholder" name="addPlaceholder" style="width: 206px;">
      <input type="hidden" id="editField" value="0">
   </div>
   <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
      <button class="btn btn-primary addField">Добавить</button>
   </div>
</div>
<div class="modal" id="modalAddStep" style="display: none; width: 585px;" tabindex="-1" role="dialog" aria-labelledby="modalAddFieldLabel" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="modalAddFieldLabel">Добавление нового шага</h3>
   </div>
   <div class="modal-body" style="text-valign: top;">
      <input placeholder="Введите название шага" type="text" id="stepName" name="stepName" class="add" style="width: 535px;">
      <span style="padding-left: 5px;">
      <label style="display: inline;" for="cloneStep">Клонируемый</label>
      <input type='checkbox' id="cloneStep" name="cloneStep" value="0">
      <input placeholder="min - кол-во блоков" type="text" id="cloneBlockMin" style="display: none; width: 130px; text-align: center;">
      <input placeholder="max - кол-во блоков" type="text" id="cloneBlockMax" style="display: none; width: 130px; text-align: center;">
      <input placeholder="Название клон-блока" type="text" id="cloneBlockName" style="display: none; width: 130px; text-align: center;">
      </span>
   </div>
   <div style="text-valign: top;">
      <br>
      <table class="table-bordered table-stripe-d table listSteps" style="">
         <tbody>
         </tbody>
      </table>
   </div>
   <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
      <button class="btn btn-primary addStep">Добавить</button>
   </div>
</div>
<div class="modal" id="modalTz" style="display: none; width: 100%; left: 0px; margin: 100px 0 0; top: 40%; min-height: 450px;" tabindex="-1" role="dialog" aria-labelledby="modalAddFieldLabel" aria-hidden="true" data-backdrop="false">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <!--
         <div class="pagination_bootstrap">
         	Страницы: 
         	<ul>
         		<li><a href="#">1</a></li>
         		<li><a href="#">2</a></li>
         		<li><a href="#">3</a></li>
         		<li><a href="#">4</a></li>
         	</ul>
         </div>
         -->
      <form id="uploadTz" name="uploadTz" method="post" enctype="multipart/form-data">
         Выберите ТЗ: <input type="file" id="fileTz" />
         <input id="startUploadTz" type="submit" value="Загрузить ТЗ" />
         <a class="btn" data-toggle="modal" role="button" href="#modalAddField" style="float: right; margin-right: 20px;">Добавить поле</a>
      </form>
   </div>
   <div class="modal-body" style="text-valign: top;">
   </div>
</div>
<div id="blocksFields">
   <table class="table-bordered table-stripe-d table" style="display: none; margin-top: 15px;">
      <thead>
         <th>id</th>
         <th>Имя поля</th>
         <th>Элемент в генераторе</th>
         <th>Виджет</th>
         <th><span class="icon-trash"></span></th>
      </thead>
      <tbody>
      </tbody>
   </table>
   <button class="btn" id="showMoreFields" style="display: none; margin-bottom: 20px;"></button>
</div>
<div class="search-buttons_block" style="display: none;">
   <input placeholder="Поиск полей" type="text" class="searchString" name="searchString" style="width: 350px;"> <span class="icon-trash" style="cursor: pointer;"></span>
   <div style="float: right; text-align: left;">
      <a href="#modalCloneBlocks" id="showCloneBlocks" role="button" class="btn" data-toggle="modal">Клонируемые блоки</a>
      <a href="#modalConditions" id="showConditions" role="button" class="btn" data-toggle="modal">Условия для полей</a>
      <a href="#modalAddField" role="button" class="btn" data-toggle="modal">Добавить поле</a>
      <a href="#modalAddStep" role="button" class="btn" data-toggle="modal">Добавить шаг</a> 
      <a href="#modalTz" role="button" class="btn" data-toggle="modal">Открыть ТЗ</a>
      <a href="#modalSource" id="showSource" role="button" class="btn" data-toggle="modal">Исходный код</a>
      <!-- <a href="#modalRoute" id="showRoute" role="button" class="btn" data-toggle="modal">Маршрут</a> -->
      <a href="#modalCopyForm" role="button" class="btn" data-toggle="modal">Копировать форму</a>
      <a href="#modalExternalForm" id="showExternalForm" role="button" class="btn" data-toggle="modal">Внешняя форма</a>
   </div>
</div>
<div id="bodyForm" align="center">
   <div id="wrapper">
   </div>
</div>
<input type="hidden" id="activeStep">
<input type="hidden" id="idForm">
<ul id="stepsList" style="display: none;"></ul>