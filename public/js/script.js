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
});
$(document).on('change', '#contributorId', function (e) {
    e.preventDefault();
    console.log('getting user contributions');
    var key = $('#contributorId').val();
    $.get('/getUserContributions', {id: key}, function (data) {
        console.log(data);
        $.each(data, function (i, value) {
            $('#contributionId').append($('<option>').text(value.dateOfContribution + " => GHC " + value.contributionAmount).attr('value', value.contributionId));
        });
    });

});