class AlternativeResult {
    constructor() {
        this.initEvent();
    }

    initLoad() {
        this.doLoad();
    }
    doLoad() {
        $('#text_criteria_alternative').text($("#select_criteria_alternatif option:selected").text());
        this.doLoadResult();
    }

    doLoadResult() {
        $('#overlay').css('display', 'block');
        let obj = {
            "criteria":$("#select_criteria_alternatif").val()
        }
        let result = "";
        let eigen = "";
        $.ajax({
            url: "alternative_analyst_result/get_list",
            type: 'GET',
            data: {
                data:JSON.stringify(obj)
            },
            success: function (response) {
                $('#overlay').css('display', 'none');
                if (!isNullOrEmpty(response)) {
                    $.each(response.alternatives, function (key, value) {
                        result += "<tr>";
                        result += "    <td style='width: 10%; font-weight: bold' id='" + value.alternative_analyst_id + "'>" + value.alternative_name + "</td>";
                            $.each(JSON.parse(value.alternative_analyst_value), function (key, data) {
                                result += "<td>"+data.data_value+"</td>";
                            });
                        result += "</tr>";
                    });
                    result += "<tr>";
                    result += "    <td class='font-weight-bold'>Jumlah</td>";
                    $.each(response.alternatives, function (key, value) {
                        result += "<td style='font-weight:bold;'>"+value.total_value+"</td>";
                    });
                    result += "</tr>";
                    $('.tbl_alternative_analyst_result tbody').html(result);

                    //data eigen
                    eigen += "<tr>";
                    eigen += "    <td style='width: 10%; font-weight: bold;writing-mode: vertical-lr' rowspan="+(response.alternatives.length+1)+" > Nilai Eigen</td>";
                    eigen += "</tr>";
                    $.each(response.alternatives, function (key, value) {
                        eigen += "<tr>";
                        $.each(JSON.parse(value.eigen_vertical_value), function (key, data) {
                            eigen += "<td>"+data.eigen_value+"</td>";
                        });
                        eigen += "</tr>";
                    });
                    eigen += "<tr>";
                    eigen += "    <td class='font-weight-bold'>Rata - Rata</td>";
                    $.each(response.alternatives, function (key, value) {
                        eigen += "        <td style='font-weight: bold;'>"+value.average+"</td>";
                    });
                    eigen += "</tr>";
                    $('.tbl_alternative_analyst_result_eigen tbody').html(eigen);

                    //hasil
                    $('#consistency_index').text(response.consistency.consistency_index);
                    $('#ratio_index').text(response.consistency.ratio_index);
                    $('#consistency_ratio').text(response.consistency.consistency_ratio);
                    $('#consistency').text(response.consistency.consistency);
                }
                // if (response == "1") {
                //     hideDialog($("#add_alternative"))
                //     thisClass.doLoad();
                // } else {
                //     alertError(response, "Hasil Perbandingan Alternatif");
                // }
            },
            error: function (e, x, settings, exception) {
                $('#overlay').css('display', 'none');
                let error = errorMessage(e, exception);
                alertError(error, "Hasil Perbandingan Alternatif");
            }
        });
    }

    initEvent() {
        let thisClass = this;
        $('#select_criteria_alternatif').on('change', function (e) {
            $('#text_criteria_alternative').text($("#select_criteria_alternatif option:selected").text());
            thisClass.doLoadResult();
        });
    }
}
