function addNotify(message, type) {
  console.log(message, type);
  // Create a div element for the notification
  var notifyDiv = $(`
    <div class="toast align-items-center border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true" style="">
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button onclick="removeNotify()" type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    `);
  notifyDiv.addClass("");

  // Add the appropriate class based on the type
  switch (type) {
    case "success":
      notifyDiv.addClass("text-bg-success");
      break;
    case "error":
      notifyDiv.addClass("text-bg-danger");
      break;
    case "info":
      notifyDiv.addClass("text-bg-info");
      break;
    case "warning":
      notifyDiv.addClass("text-bg-warning");
      break;
    default:
      notifyDiv.addClass("text-bg-primary");
  }

  // Set the message

  // Append the notification to the notify div
  $("#notify").append(notifyDiv);

  // After 5 seconds, remove the notification with fade out effect
  setTimeout(function () {
    notifyDiv.fadeOut(500, function () {
      $(this).remove();
    });
  }, 5000);

  notifyDiv.find(".btn-close").on("click", function () {
    notifyDiv.fadeOut(500, function () {
      $(this).remove();
    });
  });
}

addNotify("This is a success message!", "success");
addNotify("This is an error message!", "error");
addNotify("This is an info message!", "info");
addNotify("This is a warning message!", "warning");
