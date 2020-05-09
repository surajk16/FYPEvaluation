$(document).ready(function(){

    $.getJSON( "./data/data.json", jsonLoadedCallback)
    var idx;
    var data;
    var loadedTime, withoutAnchorsTime, withAnchorsTime;

    function jsonLoadedCallback (json_data) {
        var my_data = json_data
        performEvaluation(my_data)
        loadedTime=Date.now();
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

    function submitForm() {
        var post_data = {}
        post_data["index"] = idx
        post_data["without_anchor"] = $("input[name=without-anchor]:checked").val()
        post_data["with_anchor"] = $("input[name=with-anchor]:checked").val()
        post_data["actual_label"] = data["actual_label"] == "<=50K" ? 0 : 1 
        post_data["predicted_label"] = data["predicted_label"] == "<=50K" ? 0 : 1
        post_data["anchors"] = data["anchors"]
        post_data["input_data"] = data["input_data"]
        post_data["without_anchor_reaction_time"] = (withoutAnchorsTime - loadedTime)/1000
        post_data["with_anchor_reaction_time"] = (withAnchorsTime - withoutAnchorsTime)/1000

        $.ajax({
            type: "POST",
            url: "saveEval",
            data: post_data,
            success: onSuccess()
        })
    }

    function onSuccess() {
        if(confirm('Success! Do you want to evaluate another record?')) {
            location.reload();
        } else {
            $("body").html(`<h1 style="text-align: center">Thank you for your valuable time!</h1>`)
        }
    }


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;

        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            submitForm()
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var valid = false;
        if (currentTab == 0 && $("input[name=without-anchor]:checked").val()) {
            valid = true;
        } else if ($("input[name=with-anchor]:checked").val()) {
            valid = true
        }

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
          document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
      }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
          x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }

    $("#prevBtn").click(function() {
        nextPrev(-1)
    })

    $("#nextBtn").click(function() {
        nextPrev(1)
    })

    $("input[name=without-anchor]").change(function() {
        withoutAnchorsTime = Date.now()
    })

    $("input[name=with-anchor]").change(function() {
        withAnchorsTime = Date.now()
    })
});

