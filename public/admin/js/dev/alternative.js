let thisAlternative;
class Alternative {

    constructor() {
        thisAlternative = this;
        this.initEvent();
    }

    initLoad() {
        this.doLoad();
    }
    doLoad() {
        let thisClass = this;
        doDestroyDatatable("tbl_alternative");
        let result = "";
        $(".tbl_alternative tbody").empty();

        let param = {
            filter: $("#find_alternative").val(),
            status: $("#select_alternative_status").val(),
        };
        $('#overlay').css('display', 'block');
        $.ajax({
		    url: "alternative/get_list_alternative",
            type: 'GET',
			data : {
				data:JSON.stringify(param)
			},
            success: function (response) {
                $('#overlay').css('display', 'none');
                $.each(response, function(key, value){
                    result += thisClass.doAddRow(key, value);
                });

                $('.tbl_alternative tbody').html(result);
                doSetDatatable('tbl_alternative');
	        },
            error: function (e, x, settings, exception) {
                $('#overlay').css('display', 'none');
                let error = errorMessage(e, exception);
                doSetDatatable("tbl_alternative");
            }
		});
    }

    doAddRow(key, value) {
        let table = "";

        table += "<tr>";
        table += "  <td style='width: 2%;'>" + (key + 1) + "</td>";
        table += "  <td style='width: 15%;'>"+value.alternative_id+"</td>";
        table += "  <td style='width: auto;'>"+value.alternative_name+"</td>";
        table += "  <td style='width: 12%;text-align:center;'>";
        table +="        <button title='Edit' class='btn btn-warning mt-1 text-white' onclick='thisAlternative.doUpdateAlternative("+JSON.stringify(value)+")'><i class='fas fa-pen'></i></button>";
        table +="        <button title='Hapus' class='btn btn-danger mt-1 text-white' onclick='thisAlternative.doDeleteAlternative("+JSON.stringify(value)+")'><i class='fas fa-trash'></i></button>";
        table +="   </td>";
        table += "  <td class='d-none' style='width: 12%;'></td>";
        table += "</tr>";

        return table;
    }

    doAddAlternative() {
        $("#alternative_id").val(0);
        $("#alternative").val('');
        $('#alternative').removeClass("is-invalid");
        $("#add_alternative").modal('show');
    }
    doUpdateAlternative(value) {
        $("#alternative_id").val(value.alternative_id);
        $("#alternative").val(value.alternative_name);
        $('#alternative').removeClass("is-invalid");
        $("#add_alternative").modal('show');
    }

    doDeleteAlternative(value){
        boot4.confirm({
            msg:"Apakah alternatif ''"+value.alternative_name+"'' ingin dihapus?",
            title:"Hapus Alternatif",
            style: {
                "background-color": "#4750b3",
                color: "white",
                "font-weight": "bold"
              },
            callback:function(result) {
                if(result){
                  thisAlternative.deleteAlternative(value);
                }else{
                  console.log("cancel");
                }
            }
        });
    }

    deleteAlternative(value){
        let thisClass = this;
        let obj = {
            "alternative_id":value.alternative_id,
            "alternative_name": value.alternative_name
        }
        $('#overlay').css('display', 'block');
        $.ajax({
            url: "alternative/delAlternative",
            type: 'POST',
            data: {
                data:JSON.stringify(obj)
            },
            success: function (response) {
                $('#overlay').css('display', 'none');
                if (response == "1") {
                    thisClass.doLoad();
                } else {
                    alertError(response, "Hapus Data Alternatif");
                }
            },
            error: function (e, x, settings, exception) {
                $('#overlay').css('display', 'none');
                let error = errorMessage(e, exception);
                alertError(error, "Hapus Data Alternatif");
            }
        });
    }

    doValidate(){
		let bitResult = true;

		if($('#alternative').val().length == 0){
            $('#alternative').addClass("is-invalid");
			$('#alternativeError').html("Nama Alternatif tidak boleh kosong.");
			return false;
		}

		return bitResult;
	}

    doSaveAlternative() {
        let thisClass = this;

        if(thisClass.doValidate()==false){
			return;
        }else{
            let obj = {
                "alternative_id":$("#alternative_id").val(),
                "alternative_name": $("#alternative").val()
            }

            $('#overlay').css('display', 'block');
            if($("#alternative_id").val() == 0){
                $.ajax({
                    url: "alternative/addAlternative",
                    type: 'POST',
                    data: {
                        data:JSON.stringify(obj)
                    },
                    success: function (response) {
                        $('#overlay').css('display', 'none');
                        if (response == "1") {
                            hideDialog($("#add_alternative"))
                            thisClass.doLoad();
                        } else {
                            alertError(response, "Simpan Data Alternatif");
                        }
                    },
                    error: function (e, x, settings, exception) {
                        $('#overlay').css('display', 'none');
                        let error = errorMessage(e, exception);
                        alertError(error, "Simpan Data Alternatif");
                    }
                });
            } else {
                $('#overlay').css('display', 'block');
                $.ajax({
                    url: "alternative/updAlternative",
                    type: 'POST',
                    data: {
                        data:JSON.stringify(obj)
                    },
                    success: function (response) {
                        $('#overlay').css('display', 'none');
                        if (response == "1") {
                            hideDialog($("#add_alternative"))
                            thisClass.doLoad();
                        } else {
                            alertError(response, "Update Data Alternatif");
                        }
                    },
                    error: function (e, x, settings, exception) {
                        $('#overlay').css('display', 'none');
                        let error = errorMessage(e, exception);
                        alertError(error, "Update Data Alternatif");
                    }
                });
            }
        }
    }

    initEvent() {
        let thisClass = this;
        $("#btn_find_alternative").on("click", function () {
            thisClass.doLoad();
        });

        $("#btn_add_alternative").on("click", function () {
            thisClass.doAddAlternative();
        });

        $("#addAlternative").on("click", function () {
            thisClass.doSaveAlternative();
        });
    }
}
