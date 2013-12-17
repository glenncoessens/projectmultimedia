/*$(document).bind("mobileinit", function(){
 $.mobile.ajaxEnabled = false;
 alert('mobileinit binded');
 });*/

$(document).on("pageinit", "#page4", function() {
    /*team page*/
// code to create collapsibles (based on slider)
    var numberOfMembers = $("#slider1").val();
    var maxNumber = $("#slider1").attr("max");
    for (var i = 0; i <= maxNumber; i++)
    {
        var index = (maxNumber - (i - 1));
        $("#createTeamDiv").prepend('<div id="Teamlid_' + index + '" data-role="collapsible" data-collapsed="false"><h3>' +
                'Teamlid' + index +
                '</h3>' +
                '<div data-role="fieldcontain" data-controltype="textinput">' +
                '<label for="textinput' + index + '" id="memberfield' + index + '">' +
                'Naam' +
                '</label>' +
                '<input name="" id="membertextinput' + index + '" placeholder="" value="" type="text" required>' +
                '</div>' +
                '</div>');
        // initialy value = number of collapsibles
        if (index > numberOfMembers)
        {
            $('#Teamlid_' + index).remove();
            $('#memberfield' + index).remove();
            $('#membertextinput' + index).remove();
        }
        //opens first one


    }
    ;

});
/*eventhandler for slider -> changing number of callapsibles*/
$("#page4").live("pageinit", function(event) {
    $("#slider1").on("slidestop", function(event) {
        $("#createTeamDiv").children().remove();
        var numberOfMembers = $("#slider1").val();
        var maxNumber = $("#slider1").attr("max");
        for (var i = 0; i <= maxNumber; i++)
        {
            var index = (maxNumber - (i - 1));
            $("#createTeamDiv").prepend('<div id="Teamlid_' + index + '" data-role="collapsible" data-collapsed="false"><h3>' +
                    'Teamlid' + index +
                    '</h3>' +
                    '<div data-role="fieldcontain" data-controltype="textinput">' +
                    '<label for="textinput' + index + '" id="memberfield' + index + '">' +
                    'Naam' +
                    '</label>' +
                    '<input name="" id="membertextinput' + index + '" placeholder="" value="" type="text" required>' +
                    '</div>' +
                    '</div>');
            $("#createTeamDiv").collapsible().trigger('create'); //-> niet meer nodig met jquery mobile + angular adapter
            // initialy value = number of collapsibles

            if (index > numberOfMembers)
            {
                $('#Teamlid_' + index).remove();
                $('#memberfield' + index).remove();
                $('#membertextinput' + index).remove();
            }
        }
    }
    );
});
// routeselection
$("#page6").live("pageinit", function() {
    $("#infoRoute").hide(); // first time initialization off page


});
$("#page6").live("pageshow", function(event) {

    // function when expanded
    $('div.onClickChangeMap').on("expand", function() {
        var image = $(this).attr("id");
        var delimit = image.lastIndexOf('_');
        var link = 'images/gf' + image.substring(delimit + 1) + '.png'; // this is name of the image that has to be looked up in /images
        $('#dynImg').attr('src', link);
        $('#infoRoute').show('5');
    });
    // function when dynImg's target is being collapsed
    $('div.onClickChangeMap').on("collapse", function() {
        var currentImg = $('#dynImg').attr('src');
        var delimit = currentImg.lastIndexOf('.');
        currentImg = currentImg.substring(9, delimit);
        if ($(this).attr('id') === 'gotoRoute_' + currentImg)
        {
            $('#infoRoute').hide('5');
        }
    });


});

$(document).on("pageinit", "#page1", function() {

    $("#fbbtn").click(function(e) {
        FB.login(function(response) {
        });
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "Dit veld is verplicht.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });



});
$(document).on("pageshow", "#page3", function() {

    FB.api('/me', function(response) {
        $("#textinput10").val(response.name);
    });

});
$(document).on("pageinit", "#page3", function() {

    $("#regalleen").click(function() {

        $("#registreer").validate({
//              rules: {
//            textinput10:{
//                required:true,
//                minlength:2
//            }
//        },
//             messages: {
//            textinput10: "Vul een gebruikersnaam in!!!"
//        },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().parent().after());
            }




        });

        if ($('#registreer').valid()) {
            localStorage.setItem("naam", $('#textinput10').val());
            localStorage.setItem("groep", "false");
            $.mobile.changePage("#page6");
        }
    });
});

$(document).on("pageinit", "#page4", function() {

    $("#reggroep").click(function() {
        $("#registreer2").validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent().parent().after());
            }
        });
        if ($('#registreer2').valid()) {
            var namen = [];
            var teller = 0;
            localStorage.setItem("groepsnaam", $('#textinput13').val());
            localStorage.setItem("groep", "true");
            $('#createTeamDiv').children('div[id^="Teamlid"]:visible').each(function() {
                teller++;
                namen[teller] = $('#membertextinput' + teller).val();
            });
            localStorage["naam"] = JSON.stringify(namen);
            localStorage.setItem("teller", teller);
            $.mobile.changePage("#page6");
        }
    });
});

$(document).on("pageinit", "#page7", function() {

    $("#neemFoto").click(function() {
    
        
        $("#takePictureField").trigger('click');
    });

});

function readURL(input)
{

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var img = new Image();
        reader.onload = function(e) {
            var storageFiles = JSON.parse(localStorage.getItem("storageFiles")) || {};
            img.src = e.target.result;
            var canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            $(canvas).attr('hidden', 'true');
            document.body.appendChild(canvas);
            var context = canvas.getContext('2d');
            context.drawImage(img, 0, 0);
            var objectSeq = $('#objectSeq p').html();
            localStorage.setItem(objectSeq,canvas.toDataURL("image/png"));
            storageFiles[objectSeq] = objectSeq;
            localStorage.setItem("storageFiles", JSON.stringify(storageFiles));
        };
        reader.readAsDataURL(input.files[0]);

    }
}
;









