/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }).ajaxStart(function () {
        $("#ajaxSpinnerContainer").show();
    })
    .ajaxStop(function () {
        $("#ajaxSpinnerContainer").hide();
    });
$(document).on('change', '#contributorId', function (e) {
    e.preventDefault();
    console.log('getting user contributions');
    var key = $('#contributorId').val();
    $.get('/getUserContributions', {
        id: key
    }, function (data) {
        console.log(data);
        $.each(data, function (i, value) {
            $('#contributionId').append($('<option>').text(value.dateOfContribution + " => GHC " + value.contributionAmount).attr('value', value.contributionId));
        });
    });

});

$(document).on('click', '#show-reg', function () {
    console.log('show reg details ');
    $('#registration-show').modal();
    var registrationId = $(this).val();
    $.get("/show-registrationdetails", {
        registrationId: registrationId
    }, function (data) {
        $('#firstName').val(data.firstName);
        $('#lastName').val(data.lastName);
        $('#otherNames').val(data.otherNames);
        $('#email').val(data.email);
        $('#phoneNumber').val(data.phoneNumber);
        $('#gender').val(data.gender);
        $('#nextOfKin').val(data.nextOfKin);
        $('#nextOfKinTelephone').val(data.nextOfKinTelephone);
        $('#residentialAddress').val(data.residentialAddress);
        $('#occupation').val(data.occupation);
        $('#purposeOfInvesting').val(data.purposeOfInvesting);
        $('#isApproved').val(data.isApproved);
        $('#dateOfApproval').val(data.dateOfApproval);
        $('#registrationId').val(data.registrationId);
        $('#names').val(data.firstName + " " + data.lastName);

    });
});
$(document).on('click', '#show-cont', function () {
    $('#contribution-show').modal();
    var contributionId = $(this).val();
    $.get("/show-contributiondetails", {
        contributionId: contributionId
    }, function (data) {
        $('#firstName').val(data.firstName);
        $('#lastName').val(data.lastName);
        $('#otherNames').val(data.otherNames);
        $('#modeOfPayment').val(data.modeOfPayment);
        $('#sourceOfPayment').val(data.sourceOfPayment);
        $('#vendorName').val(data.vendorName);
        $('#dateOfContribution').val(data.dateOfContribution);
        $('#contributionAmount').val(data.contributionAmount);
        $('#isApproved').val(data.isApproved);
        $('#occupation').val(data.occupation);
        $('#dateOfApproval').val(data.dateOfApproval);
        $('#contributionId').val(data.contributionId);
        $('#names').val(data.firstName + " " + data.lastName);

    });
});



//    function validation() {
//
//        var contId = document.getElementById('contributionId').value;
//        var interest = document.getElementById('interestRate').value;
//        var indate = document.getElementById('dateOfInvestment').value;
//
//        if((contId  != '') && (interest!='') && (indate!='')){
//            swal("Good job!", "Investment saved successfully!", "success");
//            return true;
//        }
//
//}

$(document).on('click', '.edit_user', function (e) {
    console.log('dataclicked');
    $('#user-show').modal('show');
    var id = $(this).val();
    $.get("/edit-user", {
        id: id
    }, function (data) {
        $('#fullname-edit').val(data.name);
        $('#username-edit').val(data.username);
        $('#email-edit').val(data.email);
        $('#user-id-edit').val(data.id);

    });
});
$('.btn-update-user').on('click', function (e) {
    e.preventDefault();
    var data = $('#frm-update-user').serialize();
    var updateUser = $.post("/update-user", data, function (data) {
        $('#user-show').modal('hide');

        swal('ZESTED',
            'User ' + data.name + ' updated successfully',
            'success');
    }).fail(function () {
        swal('ZESTED',
            'An error occured',
            'error');
    });

});