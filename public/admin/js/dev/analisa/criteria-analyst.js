class CriteriaAnalyst {
    constructor() {
        this.initEvent();
    }

    initLoad() {
        this.doLoad();
    }
    doLoad() {
        let thisClass = this;

        // $.ajax({
		//     url: "criteria_analyst/get_list_criteria",
        //     type: 'GET',
        //     success: function (response) {

        //         var cols = response.length,
	    //         rows = response.length,
        //         $table = $('#tbl_criteria_analyst');
        //         console.log(response.length)

        //             $.each(response, function(key, value){
        //                 // for (let r = 0; r < (key+1); r++) {
        //                     var row = $('<tr><td>'+  value.criteria_name + '</td></tr>')

        //                     for(let c = 0; c < cols; c++){
        //                         var col = $('<td></td>')
        //                         if(c==row) col.addClass('kolorek') // col[r][c] is undefined. This matches the same column and row numbers
        //                         row.append(col)
        //                     }
        //                     $table.append(row);
        //                 // }
        //             });


	    //     },
        //     error: function (e, x, settings, exception) {
        //         let error = errorMessage(e, exception);
        //     }
		// });
    }

    initEvent() {
        let thisClass = this;

        $('#btn_analyst_proses').on("click", function () {
            let ref = $('#tbl_criteria_analyst').dataTable({ "destroy": false,"bPaginate": false,"bLengthChange": false,"bFilter": false,"bInfo": false,"bAutoWidth": false,"ordering": false}).fnGetNodes();

            let arrayH = [];
            $('table > tbody  > tr').each(function(index, tr) {
                // console.log("index "+index);

                // console.log(ref[index].children[0].id);
                let totalHorizontal = 0;
                let header;
                let array = [];
                for (var i = 0; i < ref.length; i++) {
                    // console.log("data ke "+$(ref[i]).children("td:nth-child("+(index+2)+")").children("input").val()+"--"+(index+2));

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
                        "criteria":ref[index].children[0].id
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

            // console.log("total "+ JSON.stringify(obj));
            // $.ajax({
            //     url: "criteria_analyst/addCriteriaAnalyst",
            //     type: 'POST',
            //     data: {
            //         data:JSON.stringify(obj)
            //     },
            //     success: function (response) {
            //         window.location.href = 'criteria_analyst_result'
            //         console.log("hasil "+ JSON.stringify(response));
            //     },
            //     error: function (e, x, settings, exception) {
            //         let error = errorMessage(e, exception);
            //         console.log("error "+ error);
            //     }
            // });
            // $.ajax({
            //     url: "criteria_analyst/get_list_criteria",
            //     type: 'GET',
            //     success: function (response) {
            //         console.log(response)
            //     }
            // });

            let arraybottom = [];
            var table = document.getElementById('tbl_criteria_analyst');
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
                // console.log("objek ", row.cells[i]);
                // console.log("total ", totalHorizontal);
            }
            for ( var i in arrayH) {
                // let header = {
                //     "detail": detail
                // }
                // arrayH[].push(header)
                // console.log(JSON.stringify(detail))
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
                "analyst":filtered
            }
            // console.log("data cell ", JSON.stringify(obj));
            $.ajax({
                url: "criteria_analyst/addCriteriaAnalyst",
                type: 'POST',
                data: {
                    data:JSON.stringify(obj)
                },
                success: function (response) {
                    window.location.href = 'criteria_analyst_result';
                    console.log("hasil "+ JSON.stringify(response));
                },
                error: function (e, x, settings, exception) {
                    let error = errorMessage(e, exception);
                    console.log("error "+ error);
                }
            });
        });

        $('#btn_analyst_nomalize').on("click", function () {
            window.location.href = 'criteria_analyst/normalize';
        });

    }
}
