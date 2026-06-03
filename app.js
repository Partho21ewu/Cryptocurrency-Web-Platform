// Define the URL for the PHP script that retrieves messages
var messageUrl = "get_messages.php";

// Set the interval for refreshing the message history in milliseconds
var refreshInterval = 1000;

// On document ready, start the interval for refreshing the message history
$(document).ready(function() {
	setInterval(getMessages, refreshInterval);
});

// When the message form is submitted, prevent the default action,
// retrieve the message text, and send an AJAX POST request to the PHP script
$("#message-form").submit(function(event) {
	event.preventDefault();
	var messageText = $("input[name='message']").val();
	$.post("send_message.php", {message: messageText}, function(data) {
		$("input[name='message']").val("");
		getMessages();
	});
});

// Retrieve the message history from the PHP script and display it on the page
function getMessages() {
	$.get(messageUrl, function(data) {
		$("#message-container").html(data);
	});
}
