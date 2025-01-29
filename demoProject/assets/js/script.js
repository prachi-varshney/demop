function tabActiveInactive(tabButtonId) {
    $('.tab-pane').removeClass('show active');
    $('.nav-link').removeClass('active');
    var contentId = $('#' + tabButtonId).attr('data-bs-target').substring(1);
    $('#' + contentId).addClass('show active');
    $('#' + tabButtonId).addClass('active');
}

function formValidation() {
    $("#dataFrom").find('.error').remove();
    let isValid = true;
    $("#dataFrom").find(':input[required]').each(function () {
        if (!this.checkValidity()) {
            $(this).after('<div class="error" style="color: red; font-size: 12px;">This field is required</div>');
            isValid = false;
        }
    });

    return isValid;
}

function resetValidation() {
    $('#dataFrom').on('reset', function () {
        $(this).find('.error').remove();
    });
}

function loadTable(type) {
    var url = $("#url").val();
    $.ajax({
        url: url + '.php',
        type: "POST",
        data: {
            type: type
        },
        success: function (data) {
            $("#table_record").html(data);
        }
    });
}


function addUpdate(type) {
    if (!formValidation()) {
        return;
    }
    var url = $("#url").val();

    var formElem = document.getElementById('dataFrom');
    var formData = new FormData(formElem);

    formData.append('type', type);
    $.ajax({
        type: 'POST',
        url: url + '.php',
        data: formData,
        processData: false,
        contentType: false,
        async: false,
        dataType: "json",
        success: function (result) {
            if (result.success == 'false' || result.success == false) {
                alert(result.message);
            } else {
                alert(result.message);
                loadTable('list');
                tabActiveInactive('pills-home-tab');
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        }
    });
}


function getFromData(id) {
    var url = $("#url").val();
    $.ajax({
        type: 'POST',
        url: url + '.php',
        data: {
            type: 'get_record',
            id: id
        },
        dataType: "json",
        success: function (result) {
            $.each(result.data, function (name, value) {
                $('#dataFrom').find('[name="' + name + '"]').each(function () {
                    if ($(this).is('input') || $(this).is('textarea')) {
                        $(this).val(value);
                    }
                    else if ($(this).is('select')) {
                            if(name == 'state'){
                                var state_id = value;
                                $(this).val(value);
                                cityList(state_id);
                            }
                            if(name == 'city'){
                                setTimeout(() => {
                                    $(this).val(value).change();
                                }, 20);
                            }
                    }
                    else if ($(this).is('input[type="checkbox"]') || $(this).is('input[type="radio"]')) {
                        if ($(this).val() == value) {
                            $(this).prop('checked', true);
                        }
                    }

                    

                });

               
            });

            tabActiveInactive('pills-profile-tab');
        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error ');
        }
    });
}


function deleteRecords(delId){
    var url = $("#url").val();
    $.ajax({
        url: url + '.php',
        type: "POST",
        data: {
            type: "delete_record",
            id: delId
        },
        dataType: "json",
        success: function (result) {
            console.log(result.success)
            if(result.success == true || result.success == "true"){
                loadTable('list')
                tabActiveInactive('pills-home-tab');
                alert(result.message)

            }
        }
    });
}

function stateList() {
    var url = $("#url").val();
    $.ajax({
        url: url+'.php',
        type: 'POST',
        data: { 
            type: 'state_list'
        },
        success: function (data) {
            $('#state').html('<option value="">Select</option>'+data);
        }
    });
};

function getStateCity(){
    var state_id = $("#state").val();
    cityList(state_id)
}

function cityList(state_id) {
    var url = $("#url").val();
    $.ajax({
        url: url+'.php',
        type: 'POST',
        data: { 
            type: 'city_list',
            state_id:state_id
        },
        success: function (data) {
            $('#city').html('<option value="">Select</option>'+data);
        }
    });
};


