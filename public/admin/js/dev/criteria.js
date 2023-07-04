let thisCriteria;
class Criteria {

    constructor() {
        thisCriteria = this;
        this.initEvent();
    }

    initLoad() {
        this.doLoad();
    }
    doLoad() {
        let thisClass = this;
        doDestroyDatatable("tbl_criteria");
        let result = "";
        $(".tbl_criteria tbody").empty();

        let param = {
            filter: $("#find_criteria").val(),
            status: $("#select_criteria_status").val(),
        };
        $('#overlay').css('display', 'block');
        $.ajax({
		    url: "criteria/get_list_criteria",
            type: 'GET',
			data : {
				data:JSON.stringify(param)
			},
            success: function (response) {
                $('#overlay').css('display', 'none');
                $.each(response, function(key, value){
                    result += thisClass.doAddRow(key, value);
                });

                $('.tbl_criteria tbody').html(result);
                doSetDatatable('tbl_criteria');
	        },
            error: function (e, x, settings, exception) {
                $('#overlay').css('display', 'none');
                let error = errorMessage(e, exception);
                doSetDatatable("tbl_criteria");
            }
		});
    }

    doAddRow(key, value) {
        let table = "";

        table += "<tr>";
        table += "  <td style='width: 2%;'>" + (key + 1) + "</td>";
        table += "  <td style='width: 15%;'>"+value.criteria_id+"</td>";
        table += "  <td style='width: auto;'>"+value.criteria_name+"</td>";
        table += "  <td style='width: 12%;text-align:center;'>";
        table +="        <button title='Edit' class='btn btn-warning mt-1 text-white' onclick='thisCriteria.doUpdateCriteria("+JSON.stringify(value)+")'><i class='fas fa-pen'></i></button>";
        table +="        <button title='Hapus' class='btn btn-danger mt-1 text-white' onclick='thisCriteria.doDeleteCriteria("+JSON.stringify(value)+")'><i class='fas fa-trash'></i></button>";
        table +="   </td>";
        table += "  <td class='d-none' style='width: 12%;'></td>";
        table += "</tr>";

        return table;
    }

    doAddCriteria() {
        $("#criteria_id").val(0);
        $("#criteria").val('');
        $('#criteria').removeClass("is-invalid");
        $("#add_criteria").modal('show');
    }
    doUpdateCriteria(value) {
        $("#criteria_id").val(value.criteria_id);
        $("#criteria").val(value.criteria_name);
        $('#criteria').removeClass("is-invalid");
        $("#add_criteria").modal('show');
    }

    doDeleteCriteria(value){
        boot4.confirm({
            msg:"Apakah kriteria ''"+value.criteria_name+"'' ingin dihapus?",
            title:"Hapus Kriteria",
            style: {
                "background-color": "#4750b3",
                color: "white",
                "font-weight": "bold"
              },
            callback:function(result) {
                if(result){
                  thisCriteria.deleteCriteria(value);
                }else{
                  console.log("cancel");
                }
            }
        });
    }

    deleteCriteria(value){
        let obj = {
            "criteria_id":value.criteria_id,
            "criteria_name": value.criteria_name
        }
        $('#overlay').css('display', 'block');
        $.ajax({
            url: "criteria/delCriteria",
            type: 'POST',
            data: {
                data:JSON.stringify(obj)
            },
            success: function (response) {
                $('#overlay').css('display', 'none');
                if (response == "1") {
                    thisCriteria.doLoad();
                } else {
                    alertError(response);
                }
            },
            error: function (e, x, settings, exception) {
                $('#overlay').css('display', 'none');
                let error = errorMessage(e, exception);
                alertError(error);
            }
        });
    }

    doValidate(){
		let bitResult = true;

		if($('#criteria').val().length == 0){
            $('#criteria').addClass("is-invalid");
			$('#criteriaError').html("Nama kriteria tidak boleh kosong.");
			return false;
		}

		return bitResult;
	}

    doSaveCriteria() {
        let thisClass = this;

        if(thisClass.doValidate()==false){
			return;
        }else{
            let obj = {
                "criteria_id":$("#criteria_id").val(),
                "criteria_name": $("#criteria").val()
            }
            $('#overlay').css('display', 'block');
            if($("#criteria_id").val() == 0){
                $.ajax({
                    url: "criteria/addCriteria",
                    type: 'POST',
                    data: {
                        data:JSON.stringify(obj)
                    },
                    success: function (response) {
                        $('#overlay').css('display', 'none');
                        if (response == "1") {
                            hideDialog($("#add_criteria"))
                            thisClass.doLoad();
                        } else {
                            alertError(response);
                        }
                    },
                    error: function (e, x, settings, exception) {
                        $('#overlay').css('display', 'none');
                        let error = errorMessage(e, exception);
                        alertError(error);
                    }
                });
            } else {
                $('#overlay').css('display', 'block');
                $.ajax({
                    url: "criteria/updCriteria",
                    type: 'POST',
                    data: {
                        data:JSON.stringify(obj)
                    },
                    success: function(response) {
                        $('#overlay').css('display', 'none');
                        if (response == "1") {
                            hideDialog($("#add_criteria"))
                            thisClass.doLoad();
                        } else {
                            alertError(response);
                        }
                    },
                    error: function (e, x, settings, exception) {
                        $('#overlay').css('display', 'none');
                        let error = errorMessage(e, exception);
                        alertError(error);
                    }
                });
            }
        }
    }

    initEvent() {
        let thisClass = this;
        $("#btn_find_criteria").on("click", function () {
            thisClass.doLoad();
        });

        $("#btn_add_criteria").on("click", function () {
            thisClass.doAddCriteria();
        });

        $("#addCriteria").on("click", function () {
            thisClass.doSaveCriteria();
        });
    }
}
