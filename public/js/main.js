$(document).ready(function(){

    $.getJSON( "../data/data.json", jsonLoadedCallback)
    var idx;
    var data;

    function jsonLoadedCallback (json_data) {
        var my_data = json_data
        performEvaluation(my_data)
    }

    function performEvaluation (my_data) {
        idx = Math.floor((Math.random() * 1569));
        data = my_data[idx]

        addInputToTable(data['input_data'])
        addAnchorsToCollection(data['anchors'])
    }

    function addInputToTable (input_data) {
        var table_html = "<table>"
        for (property in input_data) {
            var row = "<tr>"
            row = row.concat(`<th>${property}</th> <td>${input_data[property]}</td>`)
            row = row.concat("<tr>")
            table_html = table_html.concat(row)
        }

        table_html.concat("</table>")

        $("#example").append(table_html)
    }

    function addAnchorsToCollection (anchors) {
        var collection_html = `<ul class="collection">`
        
        anchors.forEach(function(item, index) {
            collection_html = collection_html.concat(`<li class="collection-item">${item}</li>`)
        })
        collection_html = collection_html.concat("</ul>")

        $("#anchors").append(collection_html)
    }

    $("#submit").click(function() {

        var post_data = {}
        post_data["index"] = idx
        post_data["without_anchor"] = $("input[name=without-anchor]:checked").val()
        post_data["with_anchor"] = $("input[name=with-anchor]:checked").val()
        post_data["actual_label"] = 0 ? data["actual_label"] == "<=50K" : 1
        post_data["predicted_label"] = 0 ? data["predicted_label"] == "<=50K" : 1
        post_data["anchors"] = data["anchors"]
        post_data["input_data"] = data["input_data"]

        $.ajax({
            type: "POST",
            url: "saveEval",
            data: post_data,
            success: onSuccess()
        })
    })

    $("input[name=without-anchor]").change(function() {
        if (checkValues())
            $("#submit").removeClass("disabled")
    })

    $("input[name=with-anchor]").change(function() {
        if (checkValues())
            $("#submit").removeClass("disabled")
    })

    function checkValues() {
        if ($("input[name=without-anchor]:checked").val() && $("input[name=with-anchor]:checked").val()) 
            return true
        
        return  false
    }

    function onSuccess() {
        if(confirm('Success! Do you want to evaluate another record?')) {
            location.reload();
        } else {
            $("body").html(`<h1 style="text-align: center">Thank you for your valuable time!</h1>`)
        }
    }
});

