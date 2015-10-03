$(document).ready(function () {

    /*

	Функция проверки полей

	ИНН ип - maxlength="12"
	ИНН физ -maxlength="12"
	ИНН юр - maxlength="10"
	ОГРН ип - maxlength="15"
	ОГРН физ -maxlength="15"
	ОГРН юр - maxlength="13"
	КПП юр - maxlength="9"
	ОКАТО ип - maxlength="11"
	ОКАТО физ - maxlength="11"
	ОКАТО юр - maxlength="11"
	ОКТМО ип - maxlength="11"
	ОКТМО физ - maxlength="11"
	ОКТМО юр – maxlength="11"

	*/

	
    $('.tab-content').find("input[type=text]").each(function () {
        $(this).attr('onkeydown', 'javascript:if(13==event.keyCode){return false;}');
    });
 
 
    function reloadMask() {
        $('#generateForm input[mask]').each(function () {
            $(this).mask($(this).attr('mask'));
        });
    }

    $(document).on("change", "input[type=file]", function () {

        var file = $(this).val();
        var exts = ['zip', 'jpg', 'jpeg', 'bmp', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'tar', 'ods'];

        if (file) {

            var get_ext = file.split('.');
            get_ext = get_ext.reverse();

            if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
                return true;
            } else {

                $(this).val("");
                alert("Выбран недопустимый тип файла!");
                return false;
            }

        }

    });



    //Снимаем класс error
    $(document).on("focus", "select, input, textarea", function () {
        $(this).removeClass("error").closest("div").removeClass("error");
    });

    //Запрещаем ввод букв в определенный набор полей
    $(document).on("change keyup input click", "input[name=INN], input[name=KPP], input[name=OKTMO], input[name=OGRN], input[name=OKATO], input[name=phone]", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });

    //Функция валидации e-mail адреса

    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }

    //По событию, запуск проверки опредленного набора полей
    $(document).on("blur", "input[name=INN], input[name=KPP], input[name=OKTMO], input[name=OGRN], input[name=OKATO], input[name=phone], input[name=eMail], input[name=SNILS]", function () {

        if ($(this).attr("name") === "eMail" && $(this).val() !== "") {
            if (!isValidEmailAddress($(this).val())) {
                $(this).addClass("error");
                alert('Адрес электронной почты введен неверно!');
                return false;
            }
        }

        if ($(this).val().length < $(this).attr("maxlength") && $(this).val().length > 0) {
            var maxlength = $(this).attr("maxlength");
            var field = $(this).closest("tr").text().replace(/\*/g, "").replace(/:/g, "").trim();
            $(this).addClass("error");
            alert('Поле "' + field + '" должно содержать ' + maxlength + ' символов!');
            return false;
        }

    });


    //Переход по шагам + проверка обязательных полей во время перехода
    $(document).on("click", ".stepNext, .stepPrev, button[type=submit]", function () {

        id = $(this).closest(".tab-pane").attr("id");

        $(this).closest(".tab-pane").find("*[required=required]:visible").not(":disabled").each(function () {
		
			if ($(this).is("input[type=checkbox]:not(:checked)")) {
				$(this).closest("div").addClass("error").css("width","13");
			}
				
            if (($(this).val() == "") || ($(this).find("option:selected").val() == "")) {
                $(this).addClass("error");
            }
            if ($(this).attr('name') == 'FIO') {
                if (/[a-z0-9]+/i.test($(this).val())) {
                    alert("Фамилия, Имя, Отчество заявителя должны состоять только из русских букв!");
                    $(this).addClass("error");
                }
            }

        });

        if ($(this).hasClass("stepPrev")) {
            $('#myTab a[href="#' + id + '"]').parent("li").prevAll("li:visible:first").find("a").tab('show');
        }

        if ($(this).closest(".tab-pane").find(".error:visible").not(":disabled").length > 0) {
            alert("Пожалуйста, заполните все обязательные поля!");
            $('#myTab a[href="#' + id + '"]').tab('show');
            return false;
        }


        if ($(this).hasClass("stepNext")) {

            //Очищаем значения у всех невидимых полей на текущем шаге
            $(this).closest(".tab-pane").find("input[type=text]:hidden, input[type=checkbox]:hidden, input[type=file]:hidden, textarea:hidden").val('').attr("checked", false);
            $(this).closest(".tab-pane").find("select:hidden option").removeAttr("selected");
            $('#myTab a[href="#' + id + '"]').parent("li").nextAll("li:visible:first").find("a").tab('show');

            if ($("#myTab").find(".active").nextAll("li:visible").size() < 1 && $(".tab-content").find(".active").find("#submit").size() < 1) {
                $("#generateForm").find(".tab-content").find(".active").find(".stepNext").remove();
                $("#generateForm").find(".tab-content").find(".active").find(".stepPrev").closest("div").append("<button id='submit' class='btn btn-success' type='submit' style='float: right;'>Отправить</button>");
            }

        }


        if ($(this).is("button[type=submit]")) {


            if ($("#generateForm #applicantType").val() === "N1") {
                $("#generateForm #tab-3").remove();
                $("#generateForm #tab-4").remove();
            }

            if ($("#generateForm #applicantType").val() === "N2") {
                $("#generateForm #tab-2").remove();
                $("#generateForm #tab-4").remove();
            }

            if ($("#generateForm #applicantType").val() === "N3") {
                $("#generateForm #tab-2").remove();
                $("#generateForm #tab-3").remove();
            }

            $(".templateCloneBlockStep").remove();

			
			$(".tab-pane").each(function () {
			
				$(this).find(".cloneBlockStep").each(function (i) {

					i++;

					var clone_block_name = $(this).closest(".tab-pane").find(".clone_block_name").attr("name").split("_").pop();

					$(this).find("input, textarea, select").each(function () {
						$(this).attr("name", clone_block_name + "_" + $(this).attr("name") + "_" + i);
					});

				});

				$(this).find("input.clone_block_name").val($(this).find(".cloneBlockStep").size());

			});
			

            var cloneBlocks = new Array();

            $("table.cloneBlock").each(function () {

                if ($.inArray("" + $(this).attr("block") + "", cloneBlocks) < 0) {

                    var blockName = "";

                    if (!$(this).is("[block^='tmp_']")) {
                        blockName = $(this).attr("block") + "_";
                    }

                    $("table.cloneBlock[block=" + $(this).attr("block") + "]").each(function (i) {

                        i++;

                        $(this).find("input, textarea, select").each(function () {
                            $(this).attr("name", $(this).attr("name") + "_" + i);
                        });

                    });

                    $("table.cloneBlock[block=" + $(this).attr("block") + "]").closest("form").append("<input type='hidden' name='" + $("table.cloneBlock[block=" + $(this).attr("block") + "]").attr("block") + "' value='" + $("table.cloneBlock[block=" + $(this).attr("block") + "]").size() + "'>");

                }

                cloneBlocks.push($(this).attr("block"));

            });


            $(".addCloneField").closest("td").each(function () {

                $(this).find("input, textarea, select").each(function (i) {
                    i++;
                    $(this).attr("name", $(this).attr("name") + "_" + $(this).attr("name") + "_" + i);
                });

                reloadMask();

            });


            $(".addCloneField").closest("td").each(function () {
                var cloneFieldName = $(this).find("input:first, select:first, textarea:first").attr("name").split("_")[0];
                var length = 0;
                $(this).find("input, select, textarea").each(function () {
                    if ($(this).val() != '') {
                        length++;
                    }
                });
                $(this).append("<input hidden='hidden' id=\"" + cloneFieldName + "\" name=\"" + cloneFieldName + "\" value=\"" + length + "\"/>");
            });


            //Очищаем значения у всех невидимых полей на текущем шаге
            $(this).closest(".tab-pane").find("input[type=text]:hidden, input[type=checkbox]:hidden, input[type=file]:hidden, textarea:hidden").val('').attr("checked", false);
            $(this).closest(".tab-pane").find("select:hidden option").removeAttr("selected");

        }
    });


    //FOR GENERATE FORMS



    $(document).on("change", "#applicantType", function () {

        if ($(this).val() == "N1") {
            $("#myTab a[id=2]").closest("li").show();
            $("#myTab a[id=3]").closest("li").hide();
            $("#myTab a[id=4]").closest("li").hide();
        }

        if ($(this).val() == "N2") {
            $("#myTab a[id=3]").closest("li").show();
            $("#myTab a[id=2]").closest("li").hide();
            $("#myTab a[id=4]").closest("li").hide();
        }

        if ($(this).val() == "N3") {
            $("#myTab a[id=4]").closest("li").show();
            $("#myTab a[id=3]").closest("li").hide();
            $("#myTab a[id=2]").closest("li").hide();
        }

    });


    $(document).on("click", ".addCloneBlock", function () {

        var block = $(this).closest("table.cloneBlock").attr("block");

        $('.datepicker').datepicker("destroy").removeAttr("id");

        $(this).closest(".tab-pane.active").find("table[block='" + block + "']:last").after($("table[template_block='" + block + "']").clone());
         $(this).closest(".tab-pane.active").find("table[template_block='" + block + "']:last").removeAttr("template_block").attr("block", block).show();

        $(this).closest(".tab-pane.active").find("table[block='" + block + "']:last").find("input", "textarea").not("[type='hidden']").each(function () {

            if ($(this).is("input[type=checkbox]")) {
                $(this).attr("checked", false);
            } else {
                $(this).val("");
            }

        });

        $('.datepicker').datepicker();

        $(this).closest(".tab-pane.active").find("table[block='" + block + "']").find(".deleteCloneBlock, .addCloneBlock").hide();
        $(this).closest(".tab-pane.active").find("table[block='" + block + "']").not(":first").find(".deleteCloneBlock").show();
        $(this).closest(".tab-pane.active").find("table[block='" + block + "']:last").find(".deleteCloneBlock, .addCloneBlock").show();

        reloadMask();

    });

    $(document).on("click", ".deleteCloneBlock", function () {

        var block = $(this).closest("table.cloneBlock").attr("block");
        var tab = $(this).closest(".tab-pane.active");

        $(this).closest(".cloneBlock").remove();

        tab.find("table[block='" + block + "']:last").find(".deleteCloneBlock, .addCloneBlock").show();
        tab.find("table[block='" + block + "']:visible:first").find(".deleteCloneBlock").hide();


    });




    $(document).on("click", ".addCloneBlockStep", function () {
		
		var tab = $(this).closest(".tab-pane");
		
        var clone_block_min = tab.find(".clone_block_min").val();
        var clone_block_max = tab.find(".clone_block_max").val();
        var clone_block_name = tab.find(".clone_block_name").attr("name").split("_").pop();

        if (clone_block_max != "" && tab.find(".cloneBlockStep").size() >= clone_block_max) {
            return false;
        }

        $('.datepicker').datepicker("destroy").removeAttr("id");

        tab.find(".cloneBlockStep:last").after(tab.find(".templateCloneBlockStep").clone().show().addClass("cloneBlockStep").removeClass("templateCloneBlockStep"));

        tab.find(".cloneBlockStep:last").find("input", "textarea").not("[type='checkbox']").each(function () {
            $(this).val("").attr("checked", false);
        });

        tab.find(".cloneBlockStep:last").find("input[type='checkbox']", "textarea").each(function () {
            $(this).attr("checked", false);
        });

        $('.datepicker').datepicker();

        tab.find(".addCloneBlockStep").hide();
        tab.find(".deleteCloneBlockStep:last, .addCloneBlockStep:last").show();

        reloadMask();

    });

    $(document).on("click", ".deleteCloneBlockStep", function () {

		var tab = $(this).closest(".tab-pane");
		
		$(this).closest(".cloneBlockStep").remove();
		
        tab.find(".deleteCloneBlockStep").hide();
        tab.find(".deleteCloneBlockStep:not(:eq(1))").show();
        tab.find(".addCloneBlockStep:last").show();
		
    });


    $(document).on("click", ".addCloneField", function () {

        $(this).closest("td").find("div:last").after($(this).closest("td").find("div:first").clone());
        $(this).closest("td").find("div:last").find("input, textarea, select").val("").removeAttr("selected");
        $(this).closest("td").find(".addCloneField").hide();
        $(this).closest("td").find(".addCloneField:last").show();
        $(this).closest("td").find(".deleteCloneField").not(":first").show();

        reloadMask();


    });


    $(document).on("click", ".deleteCloneField", function () {

        var td = $(this).closest("td");
        $(this).closest("div").remove();
        td.find(".addCloneField").hide();
        td.find(".addCloneField:last").show();
        td.find(".deleteCloneField").not(":first").show();

    });

});