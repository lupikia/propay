/* sub_form

Used to add validation to sub forms
*/

$(document).ready(function(){

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        }
    );
    console.log("eish");
    console.log("jo");
    if( typeof form_name !=="undefined" && typeof form_validation !=="undefined")
    {
        configure_form_validation("form-"+form_name,form_validation);
    }

    //-->check for popups
    var pops= get_url_params();
    if(pops.hasOwnProperty("display"))
    {
        //-->error pop message
        if(pops.display)
        {
            $('#pop-up').modal('show');
        }
    }

});


function invoke_pop_up(class_type,title,message,contact)
{
    $('#pop-up .modal-header').addClass(class_type);
    $('#pop-up').modal('show');

    if(class_type=="error-pop")
    {
        $('#pop-up .modal-header').removeClass("success-pop");
        title="Error code: "+ title;
        contact= contact;
    }

    $('#footer-modal-title').text(title);
    $('#footer-modal-message').text(message);
    $('#footer-modal-contact').text(contact);
}


function configure_form_validation(form_name,data)
{
    f =data;
    h =form_name;
    console.log(form_name);
    console.log(data);
    //-->remove any existing validations
    var form="form[name="+form_name+"]";
    $(form).validate(data).destroy();
    $(form).validate(data);
}

function get_form_data_json(form_name)
{
    var $inputs = $("form[name="+form_name+"] :input");

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var values = {};
    $inputs.each(function() {
        if(this.name!=="")
        {
            values[this.name] = $(this).val();
        }
    });
    return values;
}

//-->general function to make service calls
function ajax_call(url,request_type,body,callaback)
{
    $.ajax({
        type: request_type,
        url: url,
        data: body,
        dataType: 'json',
        contentType: 'application/json',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        success: function (data, textStatus, jqXHR)
        {
            callaback(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Unexpected error");
        }
    });

}


function get_url_params()
{
    var url=location.href;
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // we'll store the parameters here
    var obj = {};

    // if query string exists
    if (queryString) {

        // stuff after # is not part of query string, so get rid of it
        queryString = queryString.split('#')[0];

        // split our query string into its component parts
        var arr = queryString.split('&');

        for (var i=0; i<arr.length; i++) {
            // separate the keys and the values
            var a = arr[i].split('=');

            // in case params look like: list[]=thing1&list[]=thing2
            var paramNum = undefined;
            var paramName = a[0].replace(/\[\d*\]/, function(v) {
                paramNum = v.slice(1,-1);
                return '';
            });

            // set parameter value (use 'true' if empty)
            var paramValue = typeof(a[1])==='undefined' ? true : a[1];

            // (optional) keep case consistent
            paramName = paramName;
            paramValue = paramValue;

            // if parameter name already exists
            if (obj[paramName]) {
                // convert value to array (if still string)
                if (typeof obj[paramName] === 'string') {
                    obj[paramName] = [obj[paramName]];
                }
                // if no array index number specified...
                if (typeof paramNum === 'undefined') {
                    // put the value on the end of the array
                    obj[paramName].push(paramValue);
                }
                // if array index number specified...
                else {
                    // put the value at that index number
                    obj[paramName][paramNum] = paramValue;
                }
            }
            // if param name doesn't exist yet, set it
            else {
                obj[paramName] = paramValue;
            }
        }
    }

    return obj;
}