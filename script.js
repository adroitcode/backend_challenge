$( document ).ready(function () {




show_users('All');

function show_users(filter){
	var $group = $(".group");
    $group.empty();
    $group.append($('<th>id</th>'));
    $group.append($('<th>name</th>'));
    $group.append($('<th>joined</th>'));

	console.log($group);
	group_id = $group.data('group_id');

	$.getJSON("../backend_challenge/backend.php", { group_id: group_id, filter: filter}, function(json) {
        $.each( json['users'], function( index, user_json ) {
            var $user = $('<tr class="user"></tr>');
            $('<td class="id">' + user_json['user_id'] +'</td>').appendTo($user);
            $('<td class="name">' + user_json['name'] +'</td>').appendTo($user);
            $('<td class="joined_datetime">' + user_json['joined_datetime'] +'</td>').appendTo($user);
            $group.append($user);
        });
    });
}




$( "#member_filter" ).change(function() {
    var filter = $(this).val();
    show_users(filter);

});













});