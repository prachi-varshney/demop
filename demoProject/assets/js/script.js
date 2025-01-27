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
    $("#dataFrom").find(':input[required]').each(function() {
      if (!this.checkValidity()) {
        $(this).after('<div class="error" style="color: red; font-size: 12px;">This field is required</div>');
        isValid = false; 
      }
    });
  
    return isValid;  
  }

  function resetValidation(){
    $('#dataFrom').on('reset', function() {
        $(this).find('.error').remove();
      });
  }

function loadTable(type) {
    var url = $("#url").val();
    $.ajax({
        url: url+'.php',
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
    if(!formValidation()){
        return;
    }
    var url = $("#url").val();

    var formElem = document.getElementById('dataFrom');
    var formData = new FormData(formElem);

    formData.append('type', type);
    $.ajax({
        type: 'POST',
        url: url +'.php',
        data: formData,
        processData: false,
        contentType: false,
        async: false,
        dataType: "json",
        success: function(result) {
            if (result.success == 'false' || result.success == false) {
                alert(result.message);
            } else {
                alert(result.message);
                tableList();
                tabChange('pills-home-tab');
            }
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
}


function getFromData(id) {
    var url = $("#url").val();
    $.ajax({
        type: 'POST',
        url: url+'.php',
        data: {
            type: 'get_record',
            id:id
        },
        dataType: "json",
        success: function(result) {
            // console.log(result.data['name'])
            // $('#dataForm').each(function() {
            //     var name = $(this).attr('name');
            //     if (result.data[name] !== undefined) {
            //         if ($(this).is('input[type="text"], input[type="number"], input[type="email"], input[type="date"], input[type="password"], textarea')) {
            //             $(this).val(result.data[name]);
            //         }
            //         else if ($(this).is('input[type="radio"], input[type="checkbox"]')) {
            //             if ($(this).val() === result.data[name]) {
            //                 $(this).prop('checked', true);
            //             }
            //         }
            //         else if ($(this).is('select')) {
            //             $(this).val(result.data[name]);
            //         }
            //     }
            // });

            // $("#state").val(result.data.state);
            // cityList(result.data.state); 
            // setTimeout(() => {
            //     $("#city").val(result.data.city);
            // }, 500);

            tabActiveInactive('pills-profile-tab');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert('Error ');
        }
    });
}
