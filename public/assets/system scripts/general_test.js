var manageMemberTable;
var id = null;
var lastused_data = {
    'REQ_DATE': "",
    'CARD_ID':"",
    'CUS_ID': "",
    'REQ_TYPE': "",
    'REQ_STATUS': ""
    
};
var url=window.location.href;
    var capture=/CARD_NO=([^&]+)/.exec(url)[1];
    var CARD_NO=capture ? capture :null;
var auto_refresh=setInterval(function()
{
    
    var counter=$.ajax({
        url:'http://10.1.50.189:8001/patient/count?CARD_NO='+CARD_NO,
        cache:!1,
        data: "",
        dataType:'json',
        contentType:'application/json; charset=utf-8',
        contentType:'application/json; charset=utf-8',
        success:function(response){
        
            $('#lab_t').html(response.lab_t);
            $('#lab_c').html(response.lab_c);
            $('#lab_p').html(response.lab_p)
            $('#imi_t').html(response.imi_t);
            $('#imi_c').html(response.imi_c);
            $('#imi_p').html(response.imi_p)
        }
    });
   },6000)
$(document).ready(function() {

    
    

});

function general_test(){
var GEN='GEN';
    $.ajax({
        url:"http://10.1.50.189:8001/patient/dispatch?CARD_NO="+CARD_NO+"&REQUEST="+GEN,
        type: 'get',
        data: {
            REQUEST: 'GEN'
        },
        contentType:'application/json; charset=utf-8',
        success:function(response){
            $("#show_page").html(response)
        }
        }
        );

}
function lab_test(){
    var LAB='LAB';
        $.ajax({
            url:"http://10.1.50.189:8001/patient/dispatch?CARD_NO="+CARD_NO+"&REQUEST="+LAB,
            type: 'get',
            data: {
                REQUEST: 'LAB'
            },
            contentType:'application/json; charset=utf-8',
            success:function(response){
                $("#show_page").html(response)
            }
            }
            );
    
    }
    function imi_test(){
        var IMI='IMI';
            $.ajax({
                url:"http://10.1.50.189:8001/patient/dispatch?CARD_NO="+CARD_NO+"&REQUEST="+IMI,
                type: 'get',
                data: {
                    REQUEST: 'IMI'
                },
                contentType:'application/json; charset=utf-8',
                success:function(response){
                    $("#show_page").html(response)
                }
                }
                );
        
        }

    function showUser(USER_ID) {
        if (USER_ID) {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/singleUserData',
                type: 'post',
                data: {
                    USER_ID: USER_ID
                },
                dataType: 'json',
         
                success: function(response) {
                    $("#USER_ID").val(response.USER_ID);
                    $("#FULL_NAME").val(response.FULL_NAME);
                    $("#SEX").val(response.SEX);
                    $("#PHONENO").val(response.PHONENO);
                    $("#MAJOR_ACTOR").val(response.MAJOR_ACTOR);
                    $("#PROFESSION").val(response.PROFESSION);
                
                }
            })
        } else {
          
            successtoaster('error','Refresh the page again','Operation Failed')
        }
    }

    function get_user_data(CUS_ID) {
        if (CUS_ID) {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/singleCusData',
                type: 'post',
                data: {
                    CUS_ID: CUS_ID
                },
                dataType: 'json',
                
                success: function(response) {
                    $("#CUS_IDV").val(response.CUS_ID);
                    $("#CUS_NAME").val(response.CUS_NAME);
                    $("#SEXV").val(response.SEX);
                    $("#AGE").val(response.AGE);
                    $("#PHONENOV").val(response.PHONENO);
                    $("#REG_DATE").val(response.REG_DATE);
                
                }
            })
        } else {
            successtoaster('error','Refresh the page again','Operation Failed')

        }
    }


    function get_ser_data(SERVICE_CODE) {
        if (CUS_ID) {
            $.ajax({
                url: 'http://10.1.50.189:8001/customer/singleServiceData',
                type: 'post',
                data: {
                    SERVICE_CODE: SERVICE_CODE
                },
                dataType: 'json',
                
                success: function(response) {
                    $("#SERVICE_CODE").val(response.SERVICE_CODE);
                    $("#SERVICE_NAME").val(response.SERVICE_NAME);
                    $("#MAJOR_SER_CODE").val(response.MAJOR_SER_CODE);
                    $("#SER_NAME").val(response.SER_NAME);
                    $("#DESCI").val(response.DESCI);
                   
                
                }
            })
        } else {
            successtoaster('error','Refresh the page again','Operation Failed')

        }
    }
    


function successtoaster( type, header, message){
    toastr.options.progressBar = true; 
    var $toast = toastr[type](header, message)
}




