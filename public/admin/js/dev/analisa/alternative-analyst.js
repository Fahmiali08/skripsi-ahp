class AlternativeAnalyst {
    constructor() {
        this.initEvent();
    }

    initLoad() {
        this.doLoad();
    }
    doLoad() {
        let thisClass = this;
        $('#text_criteria').text($("#select_criteria option:selected").text());
    }

    initEvent() {
        let thisClass = this;

        $('#btn_alternative_analyst_proses').on("click", function () {
            let ref = $('#tbl_alternative_analyst').dataTable({ "destroy": true,"bPaginate": false,"bLengthChange": false,"bFilter": false,"bInfo": false,"bAutoWidth": false,"ordering": false}).fnGetNodes();

            let arrayH = [];
            $('table > tbody  > tr').each(function(index, tr) {
                let totalHorizontal = 0;
                let header;
                let array = [];
                for (var i = 0; i < ref.length; i++) {
                    let data_value = 0;
                    let bulat = 0;
                    let data = "";
                    let param;

                    if ($(ref[i]).children("td:nth-child("+(index+2)+")").children("input").val().indexOf("/") > -1) {
                        let a = $(ref[i]).children("td:nth-child("+(index+2)+")").children("input").val().split("/");
                        data_value = parseFloat(data_value + (a[0] / a[1]).toFixed(6));
                        data = (a[0] / a[1]).toFixed(6);
                    } else {
                        data_value =  data_value + Number($(ref[i]).children("td:nth-child("+(index+2)+")").children("input").val());
                        data = Number($(ref[i]).children("td:nth-child("+(index+2)+")").children("input").val());
                    }
                    totalHorizontal = totalHorizontal + data_value;
                    param = {
                        "data_value": data,
                        "alternative":ref[index].children[0].id
                    }
                    array.push(param);
                }
                header = {
                    "key": ref[index].children[0].id,
                    "detail": array,
                    "total":totalHorizontal
                }
                arrayH.push(header)
            });

            let arraybottom = [];
            var table = document.getElementById('tbl_alternative_analyst');
            for (let i = 1, row; row = table.rows[i]; i++) {
            //iterate trough columns
                let totalHorizontal = 0;
                let array = [];
                let header;
                for (let j = 1, col; col = row.cells[j]; j++) {
                // do something
                    let dec = 0;
                    let bulat = 0;
                    let data = "";
                     let param;
                    if (col.children[0].value.indexOf("/") > -1) {
                        let a = col.children[0].value.split("/");
                        dec = dec + (a[0] / a[1]).toFixed(6);
                        data = (a[0] / a[1]).toFixed(6);
                    } else {
                        bulat =  bulat + Number(col.children[0].value);
                        data = Number(col.children[0].value);
                    }
                    totalHorizontal = totalHorizontal + bulat + parseFloat(dec);
                    param = {
                        "data_value":data
                    }
                    array.push(param);
                }
                header = {
                    "detail": array
                }
                arraybottom.push(header)
            }
            for ( var i in arrayH) {
                let key = arrayH[i].key;
                let total = arrayH[i].total;
                let detail_vertical = arrayH[i].detail;
                let header;
                let array_vertical_eigen = [];
                let total_eigen = 0;
                for (let k in detail_vertical) {

                    let value = detail_vertical[k]['data_value']/total;
                    // console.log("data eigen " + value);
                    let eigen = {
                        "eigen_value":value.toFixed(6)
                    }
                    total_eigen = total_eigen + value;
                    array_vertical_eigen.push(eigen);
                }
                delete arrayH[i];
                for (let j in arraybottom) {
                    let detail_horizontal = arraybottom[i].detail;

                    header = {
                        "key":  key,
                        "horizontal_value": detail_horizontal,
                        "vertical_value": detail_vertical,
                        "eigen_vertical":array_vertical_eigen,
                        "total": total,
                        "total_eigen":total_eigen
                    }

                }
                arrayH.push(header);
            }
            var filtered = arrayH.filter(function (el) {
            return el != null;
            });
            let obj = {
                "analyst": filtered,
                "criteria":$("#select_criteria").val()
            }
            // console.log("data cell ", JSON.stringify(obj));
            $('#overlay').css('display', 'block');
            $.ajax({
                url: "alternative_analyst/addAlternativeAnalyst",
                type: 'POST',
                data: {
                    data:JSON.stringify(obj)
                },
                success: function (response) {
                    $('#overlay').css('display', 'none');
                    // window.location.href = 'alternative_analyst_result';
                    if (response == '1') {
                        alertError('Analisa Data berhasil.', "Analisa Data Alternatif");
                    } else {
                        alertError(response, "Analisa Data Alternatif");
                    }

                },
                error: function (e, x, settings, exception) {
                    $('#overlay').css('display', 'none');
                    let error = errorMessage(e, exception);
                    alertError(error, "Analisa Data Alternatif");
                }
            });
        });

        $('#select_criteria').on('change', function (e) {
            let ref = $('#tbl_alternative_analyst').dataTable({ "destroy": true,"bPaginate": false,"bLengthChange": false,"bFilter": false,"bInfo": false,"bAutoWidth": false,"ordering": false}).fnGetNodes();

            $('table > tbody  > tr').each(function (index, tr) {
                for (var i = 0; i < ref.length; i++) {
                    $(ref[i]).children("td:nth-child(" + (index + 2) + ")").children("input").val('');
                }
            });

            let tbl = document.getElementById('tbl_alternative_analyst');
            for (let i = 1; i < tbl.rows.length; i++) {
                let rows = tbl.rows[i];
                rows.cells[i].children[0].value = '1';
            }
            $('#text_criteria').text($("#select_criteria option:selected").text());
            $('#tbl_alternative_analyst').addClass("mt-4");
        });
    }
}
